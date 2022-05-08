<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Dompdf\Dompdf;
use Dompdf\Options;
use GuzzleHttp\Psr7\UploadedFile;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;


class RecetteController extends AbstractController
{
    /**
     * @Route("/recette", name="app_recette")
     */
    public function index(): Response
    {
        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecetteController',
        ]);
    }

    /**
     * @return Response
     * @Route("/AfficherR", name="afficherR")
     */
    public function Afficher()
    {
        $repo = $this->getDoctrine()->getRepository(Recette::class);
        $recette = $repo->findBy(["archive" => 0]);
        return $this->render('recette/Afficher.html.twig', array("recette" => $recette));
    }

    /**
     * @return Response
     * @Route("/FAfficherR", name="FafficherR")
     */
    public function AfficherFR()
    {
        $repo = $this->getDoctrine()->getRepository(Recette::class);
        $recette = $repo->findBy(["archive" => 0]);
        return $this->render('front/AfficherRecette.html.twig', array("recette" => $recette));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/supprimer/{id}",name="suppR")
     */
    public function Supprimer($id)
    {
        $repo = $this->getDoctrine()->getRepository(Recette::class);
        $recette = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($recette);
        $em->flush();
        $this->addFlash('info', 'Recette Supprimé!');
        return $this->redirectToRoute('afficherR');


    }

    /**
     * @Route("/addRecette",name="ajouter")
     */

    public function add(Request $request)
    {
        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette);
        $form->add('Ajouter', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['photoRecette']->getData();

            $recette = $form->getData();
            $file->move('back/assets/img/users/', $file->getClientOriginalName());
            $recette->setPhotoRecette("back/assets/img/users/" . $file->getClientOriginalName());

            $em = $this->getDoctrine()->getManager();
            $em->persist($recette);
            $em->flush();
            $this->addFlash('info', 'Recette Ajouté!');
            return $this->redirectToRoute("afficherR");
        }
        return $this->render("recette/add.html.twig", array("formrecette" => $form->createView()));
    }

    /**
     * @Route("recette/update/{id}",name="updateR")
     */
    public function Modifier(RecetteRepository $repository, $id, Request $request)
    {
        $recette = $repository->find($id);
        $form = $this->createForm(RecetteType::class, $recette);
        $form->add("Modifier", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['photoRecette']->getData();

            $recette = $form->getData();
            $file->move('back/assets/img/users/', $file->getClientOriginalName());
            $recette->setPhotoRecette("back/assets/img/users/" . $file->getClientOriginalName());
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('info', 'Recette Modifié!');
            return $this->redirectToRoute("afficherR");

        }
        return $this->render("recette/update.html.twig", ["form" => $form->createView()]);

    }

    /**
     * @return void
     * @Route("/rechecher",name="recherche")
     */
    public function Recherche(RecetteRepository $repository, Request $request)
    {
        $data = $request->get('search');
        $recette = $repository->findBy(['nom_recette' => $data]);
        return $this->render('recette/AfficherR.html.twig', array("recette" => $recette));

    }

    /**
     * @param RecetteRepository $repository
     * @return Response
     * @Route ("imp",name="ir")
     */
    public function imprimeRecette(RecetteRepository $repository): Response
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($pdfOptions);
        $recette = $repository->findAll();
        $html = $this->renderView('recette/pdf.html.twig', [
            'recette' => $recette,
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Liste  des Recette.pdf", [
            "Attachment" => true
        ]);
        return $this->redirectToRoute('FafficherR');
    }

    /**
     * @param RecetteRepository $repository
     * @param $id
     * @return Response
     * @Route("/qr/{id}",name="q")
     */
    public function show(RecetteRepository $repository, $id)
    {
        $recette = $repository->find($id);
        $myurl = 'https://www.youtube.com/results?search_query=' . $recette->getNomRecette();
        return $this->render('front/details.html.twig', [
            'recette' => $recette,
            'myurl' => $myurl,
        ]);
    }

    /************************************Json  */
    /**
     * @return Response
     * @Route("/AfficherJ", name="afficherRJS")
     */
    public function AfficherJson(NormalizerInterface $normalizer)
    {
        $repo = $this->getDoctrine()->getRepository(Recette::class);
        $recette = $repo->findBy(["archive" => 0]);
        $json = $normalizer->normalize($recette, 'json', ['groups' => 'post:read']);
        return new Response(json_encode($json));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/supprimerJ/{id}",name="suppJS")
     */
    public function SupprimerJ($id, NormalizerInterface $normalizer)
    {
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($id);
        $em->remove($recette);
        $em->flush();
        $json = $normalizer->normalize($recette, 'json', ['groups' => 'post:read']);
        return new Response("Supprimer!" . json_encode($json));


    }

    /**
     * @Route("/addRecetteJ/new",name="ajouterJs")
     */

    public function addJ(Request $request, NormalizerInterface $normalizer)
    {
        $recette = new Recette();


        $em = $this->getDoctrine()->getManager();
        $recette->setCategorieRecette($request->get('CategorieRecette'));
        $recette->setDescriptionRecette($request->get('DescriptionRecette'));
        $recette->setNomRecette($request->get('NomRecette'));
        $recette->setDureeRecette($request->get('DureeRecette'));
        $recette->setPhotoRecette($request->get('PhotoRecette'));
        $em->persist($recette);
        $em->flush();
        $json = $normalizer->normalize($recette, 'json', ['groups' => 'post:read']);
        return new Response(json_encode($json));


    }

    /**
     * @Route("updateJ/{id}",name="updateJs")
     */
    public function ModifierJ(NormalizerInterface $normalizer, $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($id);
        $recette->setCategorieRecette($request->get('CategorieRecette'));
        $recette->setDescriptionRecette($request->get('DescriptionRecette'));
        $recette->setNomRecette($request->get('NomRecette'));
        $recette->setDureeRecette($request->get('DureeRecette'));
        $recette->setPhotoRecette($request->get('PhotoRecette'));
        $em->flush();
        $json = $normalizer->normalize($recette, 'json', ['groups' => 'post:read']);
        return new Response("Modifier!" . json_encode($json));
    }
}