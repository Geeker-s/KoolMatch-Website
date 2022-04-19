<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reservation;
use App\Form\ReservationType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Psr7\UploadedFile;
use Twilio\Rest\Client; 
class ReservationController extends AbstractController
{
    /**
     * @Route("/", name="reservation_app")
     */
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }
/**
     * @Route("/listreservation", name="listereservation")
     */
    public function listreservation()
    {
        $reservation=$this->getDoctrine()->getRepository(Reservation::class)->findAll();
        return $this->render("reservation/listreservation.html.twig",array("Reservation"=>$reservation));
    }
    /**
     * @Route("/listback", name="back_list")
     */
    public function listback()
    {
        $reservation=$this->getDoctrine()->getRepository(Reservation::class)->findAll();
        return $this->render("back/list_back_resevation.html.twig",array("Reservation"=>$reservation));
    }



     /**
     * @Route("/addreservation", name="reservation_app")
     */
    public function addreservation(\Symfony\Component\HttpFoundation\Request $request)
    {
        $reservation=new Reservation();
        $reservation->setArchive(0);
        $reservation->setIdUser(1);
        $reservation->setImage('aaaaaaa');
       

        $form=$this->createForm(reservationType::class,$reservation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute("reservation_app");
        }
        return $this->render('reservation/reservation.html.twig',array("forms"=>$form->createView()));
    }






  






    
     /**
     * @Route("/delete1/{idReservation}", name="delete1")
     */
    public function delete($idReservation)
    {
        $Reservation=$this->getDoctrine()->getRepository(Reservation::class)->find($idReservation);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Reservation);
        $em->flush();
        return $this->redirectToRoute("listereservation");
   }
   /**
     * @Route("/update1/{idReservation}", name="update1")
     */
    public function update(Request $request,$idReservation)
    {
        $Reservation=$this->getDoctrine()->getRepository(Reservation::class)->find($idReservation);
        $form=$this->createForm(ReservationType::class,$Reservation);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
    
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute("reservation_app");
        }
        return $this->render("reservation/reservation.html.twig",array("forms"=>$form->createView()));
    }



}
