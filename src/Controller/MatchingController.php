<?php

namespace App\Controller;

use App\Entity\Matching;
use App\Form\MatchingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchingController extends AbstractController
{
    /**
     * @Route("/matching", name="app_matching")
     */
    public function index(): Response
    {
        return $this->render('matching/index.html.twig', [
            'controller_name' => 'MatchingController',
        ]);
    }


    /**
     * @Route ("/back/matching",name="back_matching")
     */
    public function listMatching(){
        return $this->render('back/matching.html.twig', [
            'controller_name' => 'MatchingController',
        ]);
    }

    public function ajouterMatching($m){
        $em=$this->getDoctrine()->getManager();
        $em->persist($m);
        $em->flush();
    }

    /**
     * @param $id
     * @Route ("/deleteMatching/{id}",name="deleteMatching")
     */
    public function deleteMatching($id){
        $match = $this->getDoctrine()->getRepository(Matching::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($match);
        $em->flush();
        return $this->redirectToRoute("back_interaction");
    }

    /**
     * @Route ("/updateMatching/{id}",name="updateMatching")
     */
    public function updateMatching(Request $request, $id){
        $match = $this->getDoctrine()->getRepository(Matching::class)->find($id);
        $form = $this->createForm(MatchingType::class,$match);
        $form->handleRequest($request);
        if ( $form->isSubmitted() && $form->isValid() ){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("back_interaction");
        }
        return $this->render("back/updateMatching.html.twig", array("formMatching"=>$form->createView()));
    }

    
}
