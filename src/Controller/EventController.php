<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EventType;

use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/event", name="afficher_event")
     */
    public function index(Request $request,PaginatorInterface $paginator ): Response
    {
        $events = $this->getDoctrine()->getManager()->getRepository(Evenement::class)->findAll();

        $donnees = $paginator->paginate(
            $events ,
            $request ->query->getInt('page',1),4

        );


        return $this->render('event/EventFront.html.twig', [
            'e'=>$donnees
        ]);
    }

    /**
     * @Route("/backevent", name="afficher_eventBack")
     */
    public function index_back()
    {
        $events = $this->getDoctrine()->getManager()->getRepository(Evenement::class)->findAll();




        return $this->render('event/index.html.twig', [
            'ev'=>$events
        ]);
    }



    /**
     * @Route("/addevent", name="addevent")
     */
    public function Addevent(Request $request , FlashyNotifier $flashy): Response
    {
        $event = new Evenement();
        $form = $this->createForm(EventType::class,$event);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            $this->addFlash('info','added successfully!');

            //return $this->redirectToRoute('afficher_event');
        }
        return $this->render('event/createevent.html.twig',['f'=>$form->createView()]);

    }


    /**
     * @Route("/Suppevent/{idEvent}", name="supp_event")
     */
    public function Suppevent(Evenement $evenement): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($evenement);
        $em->flush();
        $this->addFlash('info2','deleted successfully!');

        return $this->redirectToRoute('afficher_eventBack');

    }

    /**
     * @Route("/modifevent/{idEvent}", name="modifevent")
     */
    public function modifevent(Request $request,$idEvent): Response
    {
        $event = $this->getDoctrine()->getManager()->getRepository(Evenement::class)->find($idEvent);
        $form = $this->createForm(EventType::class,$event);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            $this->addFlash('info3','updated successfully!');

            //return $this->redirectToRoute('afficher_event');
        }
        return $this->render('event/updateevent.html.twig',['f'=>$form->createView()]);

    }


}
