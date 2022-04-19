<?php

namespace App\Controller;
use App\Entity\Gerant;
use App\Form\ConnexionGerantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class GerantController extends AbstractController
{
    /**
     * @Route("/gerant", name="app_gerant")
     */
    public function index(): Response
    {
        return $this->render('gerant/index.html.twig', [
            'controller_name' => 'GerantController',
        ]);
    }
    /**
     * @Route("/loginGerant", name="gerant_login")
     */
    public function loginGerant(Request $request): Response
    {
        $gerant= new Gerant();
        $form = $this ->createForm(ConnexionGerantType::class,$gerant);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $username = $form["emailGerant"]->getData();
            $password = $form["passwordGerant"]->getData();
            $test=$this->getDoctrine()->getRepository(Gerant::class)->findBy(array('emailGerant' =>$username,'passwordGerant' =>$password));
            if ($test){
                return $this->redirectToRoute('app_back');

            }
        }
        return $this->render('gerant/loginGerant.html.twig',['g'=>$form->createView()]);
    }
}
