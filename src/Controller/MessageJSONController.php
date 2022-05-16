<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\ConversationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class MessageJSONController extends AbstractController
{
    /**
     * @Route("/message/j/s/o/n", name="app_message_j_s_o_n")
     */
    public function index(SerializerInterface $serializerInterface) : Response
    {
//        $message = $this->getDoctrine()->getManager()
//            ->getRepository(Message::class)
//            ->findbyarchive();
        $G = $this->getDoctrine()
            ->getRepository(Message::class)
            ->findAll();
        $serializer = new Serializer(
            array(
                new ObjectNormalizer()
            )
        );
        $json = $serializer->normalize($G , 'json', [AbstractNormalizer::ATTRIBUTES => ['idMessage','msgMessage','dateMessage','idConversation', 'archive']]);
        return new JsonResponse($json);
    }
//    /**
//     * @Route("/ajouter/Message" , name="Message_ajout" ,  methods={"GET", "POST"}, requirements={"id":"\d+"})
//     */
//    public function ajouter(Request $request,SerializerInterface $serializer)
//    {
//
//        $message = new Message();
    //        $msg=$request->query->get('msgMessage');
    //        $dateMessage=$request->query->get('dateMessage');
//        $em=$this->getDoctrine()->getManager();
//        $message->setmsgMessage($msg);
//        $message->setdateMessage($dateMessage);
//        $em->persist($message);
//        $em->flush();
//        $serializer=new Serializer([new ObjectNormalizer()]);
//        $formatted=$serializer->normalize($message);
//        return new JsonResponse($formatted);
//    }
    /**
     * @Route("/addmessage", name="addmessage"  , methods={"POST"})
     */

    public function addmessage(Request $request, NormalizerInterface $normalizer)
    {

        $message = new Message();
        $message->setMsgMessage($request->get("msgMessage"));
        $message->setIdConversation($request->get('idConversation'));
        $message->setDateMessage(new \DateTime());
        $message->setArchive(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
            $jsonContent = $normalizer->normalize($message,'json',['groups'=>'Message']);
            return new Response("Message added Successfully ".json_encode($jsonContent));
        }

    /**
     * @Route("/modifymessage", name="modifymessage"  ,   methods={"GET", "POST"}, requirements={"id":"\d+"})
     */
    public function modifierMessage(Request $request): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $message = $this->getDoctrine()->getManager()
            ->getRepository(Message::class)
            ->find($request->get("idMessage"));

        $message->setMsgMessage($request->get("msgMessage"));
//        $message->setIdConversation($request->get('idConversation'));
//        $message->setDateMessage(new \DateTime($request->get("dateMessage")));
//        $message->setArchive($request->get('archive'));
        $em->persist($message);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize("message updated successfully");
        return new JsonResponse($formatted);
    }

    /**
     * @Route("/json/removemessage/{idMessage}", name="suprimer_Message", methods={"DELETE"})
     */
    public function supprimerMessage(NormalizerInterface $Normalizer, Message $message): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($message);
        $em->flush();
        $jsonContent = $Normalizer->normalize($message, 'json');
        return new Response("Admin Suprrimé avec succes! ".json_encode($jsonContent));
    }

    /**
     * @Route("/json/conversation/{idUser}", name="get-conver")
     */
    public function getConversation(NormalizerInterface $Normalizer, int $idUser , ConversationRepository $repository, UserRepository $userRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $conversations = $repository->findBy(['idUser1' => $userRepository->find($idUser)]);
        $json = [];
        foreach ($conversations as $conversation){
            $json[] = [
                'id' => $conversation->getIdConversation(),
                'title'=>$conversation->getTitreConversation(),
                'user'=>$conversation->getIdUser2()
            ];

        }
        return $this->json($json);
    }



}

