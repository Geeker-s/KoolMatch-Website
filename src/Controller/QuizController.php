<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Entity\Recette;
use App\Form\QuizType;
use App\Repository\QuizRepository;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="app_quiz")
     */
    public function index(): Response
    {
        return $this->render('quiz/index.html.twig', [
            'controller_name' => 'QuizController',
        ]);
    }

    /**
     * @return Response
     * @Route("/Afficherq",name="Afficherq")
     */
    public function Afficher()
    {
        $repo = $this->getDoctrine()->getRepository(Quiz::class);
        $quiz = $repo->findBy(["archive" => 0]);
        return $this->render('quiz/Afficher.html.twig', array("Quiz" => $quiz));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/supprimerQ/{id}",name="sq")
     */
    public function Supprimer($id)
    {
        $repo = $this->getDoctrine()->getRepository(Quiz::class);
        $jeu = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($jeu);
        $em->flush();
        $this->addFlash('info', 'Quiz Supprimer!');
        return $this->redirectToRoute("Afficherq");
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/addquiz",name="addq")
     */
    public function add(Request $request)
    {
        $quiz = new Quiz();
        $form = $this->createForm(QuizType::class, $quiz);
        $form->add('Ajouter', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($quiz);
            $em->flush();
            $this->addFlash('info', 'Quiz Ajouté!');
            return $this->redirectToRoute("Afficherq");
        }
        return $this->render("quiz/add.html.twig", array("formq" => $form->createView()));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("quiz/mod/{id}",name="u")
     */
    public function Modifierq($id, Request $request)
    {
        $quiz = $this->getDoctrine()->getRepository(Quiz::class)->find($id);
        $form = $this->createForm(QuizType::class, $quiz);
        $form->add("Modifier", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("Afficherq");

        }
        return $this->render("quiz/update.html.twig", ["form" => $form->createView()]);

    }
    /**************************************Json*******************************/
    /**
     * @return Response
     * @Route("/AfficherqJ",name="AfficherqJ")
     */
    public function AfficherJ(NormalizerInterface $normalizer)
    {
        $repo = $this->getDoctrine()->getRepository(Quiz::class);
        $quiz = $repo->findBy(["archive" => 0]);
        $json = $normalizer->normalize($quiz, 'json', ['groups' => 'post:read']);
        return new Response(json_encode($json));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/supprimerQJ/{id}",name="sqJs")
     */
    public function SupprimerJ($id, NormalizerInterface $normalizer)
    {
        $repo = $this->getDoctrine()->getRepository(Quiz::class);
        $jeu = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($jeu);
        $em->flush();
        $json = $normalizer->normalize($jeu, 'json', ['groups' => 'post:read']);
        return new Response("Supprimer!" . json_encode($json));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/addquizJ/new",name="addqJ")
     */
    public function addJ(Request $request, NormalizerInterface $normalizer)
    {
        $quiz = new Quiz();


        $em = $this->getDoctrine()->getManager();
        $quiz->setQ1($request->get('Q1'));
        $quiz->setQ2($request->get('Q2'));
        $quiz->setQ3($request->get('Q3'));
        $quiz->setRc1($request->get('Rc1'));
        $quiz->setRf11($request->get('Rf11'));
        $quiz->setRf12($request->get('Rf12'));
        $quiz->setRf13($request->get('Rf13'));
        $quiz->setRc2($request->get('Rc2'));
        $quiz->setRf21($request->get('Rf21'));
        $quiz->setRf22($request->get('Rf22'));
        $quiz->setRf23($request->get('Rf23'));
        $quiz->setRc3($request->get('Rc3'));
        $quiz->setRf31($request->get('Rf31'));
        $quiz->setRf32($request->get('Rf32'));
        $quiz->setRf33($request->get('Rf33'));
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($request->get('IdRecette'));
        $quiz->setIdRecette($recette);
        $em->persist($quiz);
        $em->flush();
        $json = $normalizer->normalize($quiz, 'json', ['groups' => 'post:read']);
        return new Response(json_encode($json));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("quiz/modJ/{id}",name="uJ")
     */
    public function ModifierqJ($id, Request $request, NormalizerInterface $normalizer)
    {
        $em = $this->getDoctrine()->getManager();
        $quiz = $em->getRepository(Quiz::class)->find($id);
        $quiz->setQ1($request->get('Q1'));
        $quiz->setQ2($request->get('Q2'));
        $quiz->setQ3($request->get('Q3'));
        $quiz->setRc1($request->get('Rc1'));
        $quiz->setRf11($request->get('Rf11'));
        $quiz->setRf12($request->get('Rf12'));
        $quiz->setRf13($request->get('Rf13'));
        $quiz->setRc2($request->get('Rc2'));
        $quiz->setRf21($request->get('Rf21'));
        $quiz->setRf22($request->get('Rf22'));
        $quiz->setRf23($request->get('Rf23'));
        $quiz->setRc3($request->get('Rc3'));
        $quiz->setRf31($request->get('Rf31'));
        $quiz->setRf32($request->get('Rf32'));
        $quiz->setRf33($request->get('Rf33'));
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($request->get('IdRecette'));
        $quiz->setIdRecette($recette);

        $em->flush();
        $json = $normalizer->normalize($quiz, 'json', ['groups' => 'post:read']);
        return new Response(json_encode($json));

    }

}