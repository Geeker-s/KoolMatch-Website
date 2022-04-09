<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route ("/afficherMatching", name="afficher_matching")
     */
    public function afficher(){

    $matches = $this->getDoctrine()->getRepository(User::class)->findAll();
    return $this->render("matching/matches.html.twig",array('matches' =>$matches));

    }



}
