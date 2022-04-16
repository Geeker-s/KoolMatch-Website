<?php

namespace App\Controller;


use App\Entity\Invitation;

use App\Form\InvitationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvitationController extends AbstractController
{
    /**
     * @Route("/invitation", name="afficher_invitation")
     */
    public function index(): Response
    {
        $invs =  $this->getDoctrine()->getManager()->getRepository(Invitation::class)->findAll();
        return $this->render('invitation/index.html.twig', [
            'i'=>$invs

        ]);
    }


    /**
     * @Route("/addinv", name="addinv")
     */
    public function Addinv(Request $request): Response
    {
        $inv = new Invitation();
        $form = $this->createForm(InvitationType::class,$inv);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($inv);
            $em->flush();

            return $this->redirectToRoute('afficher_invitation');
        }
        return $this->render('invitation/createinv.html.twig',['fi'=>$form->createView()]);

    }

    /**
     * @Route("/Suppinv/{idInvitation}", name="supp_inv")
     */
    public function Suppinv(Invitation $invitation): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($invitation);
        $em->flush();

        return $this->redirectToRoute('afficher_invitation');

    }

    /**
     * @Route("/modifinv/{idInvitation}", name="modif_inv")
     */
    public function modifinv(Request $request,$idInvitation): Response
    {
        $inv = $this->getDoctrine()->getManager()->getRepository(Invitation::class)->find($idInvitation);
        $form = $this->createForm(InvitationType::class,$inv);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();

            $em->flush();

            return $this->redirectToRoute('afficher_invitation');
        }
        return $this->render('invitation/updateinv.html.twig',['fi'=>$form->createView()]);

    }




}
