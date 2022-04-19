<?php

namespace App\Controller;
use App\Entity\Admin;
use App\Form\ConnexionAdminType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/loginAdmin", name="admin_login")
     */
    public function loginAdmin(Request $request): Response
    {
        $admin= new Admin();
        $form = $this ->createForm(ConnexionAdminType::class,$admin);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $username = $form["loginAdmin"]->getData();
            $password = $form["passwordAdmin"]->getData();
            $test=$this->getDoctrine()->getRepository(Admin::class)->findBy(array('loginAdmin' =>$username,'passwordAdmin' =>$password));
            if ($test){
                return $this->redirectToRoute('app_back');

            }
        }
        return $this->render('admin/loginAdmin.html.twig',['f'=>$form->createView()]);
    }
}
