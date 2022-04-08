<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnexionFrontController extends AbstractController
{
    /**
     * @Route("/connexion/front", name="app_connexion_front")
     */
    public function index(): Response
    {
        return $this->render('connexion_front/index.html.twig', [
            'controller_name' => 'ConnexionFrontController',
        ]);
    }
}
