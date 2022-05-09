<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\ConnexionAdminType;
use App\Repository\AdminRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/loginAdmin", name="admin_login")
     */
    public function loginAdmin(Request $request, AdminRepository $adminRepository): Response
    {
        $session = $request->getSession();
        $session->clear();
        $admin = new Admin();
        $form = $this->createForm(ConnexionAdminType::class, $admin);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $username = $form["loginAdmin"]->getData();
            $password = $form["passwordAdmin"]->getData();
            $test = $this->getDoctrine()->getRepository(Admin::class)->findOneBy(array('loginAdmin' => $username, 'passwordAdmin' => $password));
            if (!$test) {
                $this->get('session')->getFlashBag()->add('info',
                    'Login Incorrecte Vérifier Votre Login');

            } else {
                if (!$session->has('nom')) {
                    $session->set('nom', $test);
                    $name = $session->get('nom');

                    return $this->render('back/index.html.twig', [
                        'nom' => $name
                    ]);
                }
                else
                {
                    $name = $session->get('nom');
                    return $this->render('back/index.html.twig', [
                        'nom' => $name
                    ]);
                }

            }
        }
        return $this->render('admin/loginAdmin.html.twig', ['f' => $form->createView()]);
    }
}
