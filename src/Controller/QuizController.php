<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Form\QuizType;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $quiz = $repo->findBy(["archive" =>0]);
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
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($quiz);
            $em->flush();
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
    public function Modifierq($id,Request $request){
        $quiz=$this->getDoctrine()->getRepository(Quiz::class)->find($id);
        $form=$this->createForm(QuizType::class,$quiz);
        $form->add("Modifier",SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("Afficherq");

        }
        return $this->render("quiz/update.html.twig",["form"=>$form->createView()]);

    }

}
