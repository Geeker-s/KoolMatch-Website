<?php

namespace App\Controller;

use App\Entity\Conversation;
use App\Entity\Message;
use App\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="app_message")
     */
    public function index(): Response
    {

        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
        ]);
    }

    /**
     *
     * @Route ("/message/new" , name="createmsg")
     *
     */
    public function create(Request $request)
    {
        $msg = new Message(); // construct vide
        $form = $this->createForm(MessageType::class, $msg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $msg->setDateMessage(new \DateTime());
            $msg->setArchive(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($msg); // add Product
            $em->flush(); // commit
            return $this->redirectToRoute('createmsg');
        }
        return $this->render('message/create.html.twig', array('f' => $form->createView()));
//        return $this->render('message/index.html.twig' , array('f'=>$form->createView(),'controller_name' => 'MessageController'));
    }


    /**
     * @Route("/affichage_Message/{idConversation}", name="affichageMessage")
     */

    public function affichageMessage($idConversation, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $msg = $em->getRepository(Message::class)->findBy(array('idConversation' => $idConversation));

//        $msg = $this->getDoctrine()->getManager()->getRepository(Message::class)->find($idConversation); // select * from Message where archive = 0
        $conv = $this->getDoctrine()->getManager()->getRepository(Conversation::class)->find($idConversation);

        dump($request);
        if ($request->query->count() > 0) {
            $ms = new Message();
            $ms->setMsgMessage($request->query->get("msgmsg"))
                ->setIdConversation($idConversation)
                ->setArchive(0)
                ->setDateMessage(new \DateTime());
            $em->persist($ms);
            $em->flush();

        }
//        $form = $this->createForm(MessageType::class,$ms);
//        $form->handleRequest($request);
//        if($form->isSubmitted() && $form->isValid()) {
//            $ms->setIdConversation($idConversation);
//            $ms->setDateMessage(new \DateTime());
//            $ms->setArchive(0);
//
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($msg); // add Product
//            $em->flush(); // commit
//            return $this->redirectToRoute('affichageMessage');
//        }
//        return $this->render("/Message/afficher_Message.html.twig",array("Message"=>$msg));
//        return $this->render("message/index.html.twig",array("messages"=>$msg , "con"=>$conv ,'f'=>$form->createView()));
        return $this->render("message/index.html.twig", array("messages" => $msg, "con" => $conv));
    }

    /**
     * @Route("/updateMessage/{idMessage}", name="updateMessage")
     */
    public function updateMessage(Request $request, $idMessage)
    {
        $msg = $this->getDoctrine()->getRepository(Message::class)->find($idMessage);  //ta3mel search
        $form = $this->createForm(MessageType::class, $msg);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute("affichageMessage");
        }
        return $this->render('/Message/create.html.twig', array("f" => $form->createView()));
    }

    /**
     * @Route("/deleteMessage/{idMessage}", name="deleteMessage")
     */
    public function deleteMessage(Request $request, $idMessage, Message $message)
    {

        $em = $this->getDoctrine()->getManager();
        $i = $em->getRepository(Message::class)->find($idMessage);
        $em->remove($i);
        $em->flush();

        return $this->redirectToRoute("affichageMessage");
//        $msg=$this->getDoctrine()->getRepository(Message::class)->find($idMessage);
//        $em=$this->getDoctrine()->getManager();
//        $em->getRepository(Message::class)->find($id);
//        $em->remove($msg);
//        $em->flush();
//        return $this->redirectToRoute("affichageMessage");
    }


}
