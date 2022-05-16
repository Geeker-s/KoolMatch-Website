<?php

namespace App\Controller;

use App\Entity\Conversation;
use App\Form\ConversationType;
use App\Repository\ConversationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConversationController extends AbstractController
{
    /**
     * @Route("/conversation", name="app_conversation")
     */
    public function index(): Response
    {
        return $this->render('conversation/index.html.twig', [
            'controller_name' => 'ConversationController',
        ]);
    }

    /**
     *
     * @Route ("/newconv" , name="createcon")
     *
     */
    public function create(Request $request)
    {
        $msg = new Conversation(); // construct vide
        $form = $this->createForm(ConversationType::class, $msg);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($msg); // add Product
            $em->flush(); // commit
            return $this->redirectToRoute('createcon');
        }
        return $this->render('/conversation/create.html.twig', array('f' => $form->createView()));
//        return $this->render('message/index.html.twig' , array('convf'=>$form->createView(),'controller_name' => 'MessageController'));

    }

//    /**
//     * @Route("/affichageconv", name="affichageconv")
//     */

    public function affichageconv()
    {
        $msg = $this->getDoctrine()->getManager()->getRepository(Conversation::class)->findall(); // select * from Message where archive = 0

//        return $this->render("/conversation/afficherconv.html.twig",array("conv"=>$msg));
        return $this->render("message/index.html.twig", array("conv" => $msg));
    }

    /**
     * @Route("/affichageconv", name="affichageconv")
     */

    public function affichageconversation(Request $request, ConversationRepository $co)
    {
        $session = $request->getSession();
        $tb = $session->get('usr');
        $msg = $this->getDoctrine()->getRepository(Conversation::class)->findBy(['idUser1'=>$tb->getIdUser()]);

        return $this->render("conversation/test.html.twig", array("conv" => $msg));
    }

    /**
     * @Route("/updateconv/{idConversation}", name="updateconv")
     */
    public function updateconv(Request $request, $idConversation, Conversation $con)
    {
        $msg = $this->getDoctrine()->getRepository(Conversation::class)->find($idConversation);  //ta3mel search
        $form = $this->createForm(ConversationType::class, $msg);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute("affichageconv");
        }
        return $this->render('/conversation/create.html.twig', array("f" => $form->createView()));
    }

    /**
     * @Route("/deleteconv/{idConversation}", name="deleteconv")
     */
    public function deleteconv(Request $request, $idConversation, Conversation $message)
    {

        $em = $this->getDoctrine()->getManager();
        $i = $em->getRepository(Conversation::class)->find($idConversation);
        $em->remove($i);
        $em->flush();

        return $this->redirectToRoute("affichageconv");
    }
}
