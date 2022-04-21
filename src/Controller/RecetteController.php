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
use Dompdf\Dompdf;
use Dompdf\Options;
use GuzzleHttp\Psr7\UploadedFile;


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
        $recette = $repo->findBy(["archive" =>0]);
        return $this->render('recette/Afficher.html.twig', array("recette" => $recette));
    }
    /**
     * @return Response
     * @Route("/FAfficherR", name="FafficherR")
     */
    public function AfficherFR()
    {
        $repo = $this->getDoctrine()->getRepository(Recette::class);
        $recette = $repo->findBy(["archive" =>0]);
        return $this->render('front/AfficherRecette.html.twig', array("recette" => $recette));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/supprimer/{id}",name="supp")
     */
    public function Supprimer($id)
    {
        $repo = $this->getDoctrine()->getRepository(Recette::class);
        $recette = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($recette);
        $em->flush();
        return $this->redirectToRoute('afficherR');


    }

    /**
     *@Route("/addRecette",name="ajouter")
     */

    public function add(Request $request)
    {
        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['photoRecette']->getData();

            $recette = $form->getData();
            $file->move('back/assets/img/users/', $file->getClientOriginalName());
            $recette->setPhotoRecette("back/assets/img/users/" . $file->getClientOriginalName());

            $em = $this->getDoctrine()->getManager();
            $em->persist($recette);
            $em->flush();
            return $this->redirectToRoute("afficherR");
        }
        return $this->render("recette/add.html.twig", array("formrecette" => $form->createView()));
    }

    /**
     * @Route("recette/update/{id}",name="update")
     */
    public function Modifier(RecetteRepository $repository,$id,Request $request){
     $recette=$repository->find($id);
     $form=$this->createForm(RecetteType::class,$recette);
     $form->add("Modifier",SubmitType::class);
     $form->handleRequest($request);
     if($form->isSubmitted() && $form->isValid())
     {
         $file = $form['photoRecette']->getData();

         $recette = $form->getData();
         $file->move('back/assets/img/users/', $file->getClientOriginalName());
         $recette->setPhotoRecette("back/assets/img/users/" . $file->getClientOriginalName());
         $em=$this->getDoctrine()->getManager();
         $em->flush();
         return $this->redirectToRoute("afficherR");

     }
     return $this->render("recette/update.html.twig",["form"=>$form->createView()]);

    }

    /**
     * @return void
     * @Route("/rechecher",name="recherche")
     */
    public function Recherche(RecetteRepository  $repository,Request $request){
        $data=$request->get('search');
        $recette=$repository->findBy(['nom_recette'=>$data]);
        return $this-> render('recette/AfficherR.html.twig', array("recette" => $recette));

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
        return $this->redirectToRoute('imprimer_com');
    }

    /**
     * @param RecetteRepository $repository
     * @param $id
     * @return Response
     * @Route("/qr/{id}",name="q")
     */
public function show(RecetteRepository $repository,$id)
{ $recette=$repository->find($id);
    $myurl = 'https://www.youtube.com/results?search_query='.$recette->getNomRecette();
    return $this->render('front/details.html.twig', [
        'recette' => $recette,
        'myurl' => $myurl,
    ]);
}


}

