<?php

namespace App\Controller;

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
     * @Route ("/back/matching",name="back_matching")
     */
    public function listMatching(){
        return $this->render('back/matching.html.twig', [
            'controller_name' => 'MatchingController',
        ]);
    }
}
