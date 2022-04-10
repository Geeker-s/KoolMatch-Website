<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InteractionController extends AbstractController
{
    /**
     * @Route("/interaction", name="app_interaction")
     */
    public function index(): Response
    {

        $interactions = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('interaction/index.html.twig' ,
            array('interactions' =>$interactions)
        );
    }
}
