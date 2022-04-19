<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\ConnexionUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="app_user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    /**
     * @Route("/loginUser", name="user_login")
     */
    public function loginUser (Request $request): Response
    {
        $user= new User();
        $form = $this ->createForm(ConnexionUserType::class,$user);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $username = $form["emailUser"]->getData();
            $password = $form["passwordUser"]->getData();
            $test=$this->getDoctrine()->getRepository(User::class)->findBy(array('emailUser' =>$username,'passwordUser' =>$password));
            if ($test){
                return $this->redirectToRoute('app_front');

            }
        }
        return $this->render('user/loginUser.html.twig',['u'=>$form->createView()]);
    }
}
