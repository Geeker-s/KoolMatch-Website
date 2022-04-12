<?php

namespace App\Controller;

use App\Entity\Interaction;
use App\Entity\User;
use App\Form\InteractionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InteractionController extends AbstractController
{
    /**
     * @Route("/interaction", name="app_interaction")
     */
    public function index(Request $request): Response
    {
        $interactions = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('interaction/index.html.twig' ,
            array('interactions' =>$interactions)
        );
    }



    /**
     * @Route ("/addInteraction", name="addInteraction")
     */
    public function addInteraction(Request $request){

        $interactions = $this->getDoctrine()->getRepository(User::class)->findAll();
        $em = $this->getDoctrine()->getManager();
        $interaction = new Interaction();
        $interaction ->setIdUser1(1);
        $interaction-> setDateInteraction(new \DateTime("now", new \DateTimeZone('+0100')));
        if($request->isXmlHttpRequest())
        {
            $type=$request->request->get("type");
            $id_user=$request->request->get("iduser");
            $interaction->setIdUser2($id_user);
            $interaction->setTypeInteraction($type);
            $em->persist($interaction);
            $em->flush();
        }
        return $this->render('interaction/addInteraction.html.twig',
            array('interactions' =>$interactions));
    }




    /**
     * @Route("/back/interaction", name="back_interaction")
     */
    public  function InteractionBack(){
        $interactions = $this->getDoctrine()->getRepository(Interaction::class)->findAll();
        return $this->render('/back/interaction.html.twig',
            array('interactions' =>$interactions)
        );
    }


    /**
     * @param $id
     * @Route ("/deleteInteraction/{id}",name="deleteInteraction")
     */
    public function deleteInteraction($id){
        $interaction = $this->getDoctrine()->getRepository(Interaction::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($interaction);
        $em->flush();
        return $this->redirectToRoute("back_interaction");
    }

    /**
     * @Route ("/updateInteraction/{id}",name="updateInteraction")
     */
    public function updateInteraction(Request $request, $id){
        $interaction = $this->getDoctrine()->getRepository(Interaction::class)->find($id);
        $form = $this->createForm(InteractionType::class,$interaction);
        $form->handleRequest($request);
        if ( $form->isSubmitted() && $form->isValid() ){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("back_interaction");
        }
        return $this->render("back/updateInteraction.html.twig", array("formInteraction"=>$form->createView()));
    }



}
