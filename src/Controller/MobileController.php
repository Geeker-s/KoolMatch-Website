<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Invitation;
use App\Repository\EventRepo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Routing\Annotation\Route;

class MobileController extends AbstractController
{
    /**
     * @Route("/mobile", name="app_mobile")
     */
    public function index(): Response
    {
        return $this->render('mobile/index.html.twig', [
            'controller_name' => 'MobileController',
        ]);
    }
    /**
     * @Route("/listeventmobile", name="listeventmobile")
     */

    public function listevent(Request $request,NormalizerInterface $normalizer  ):Response
    {
        $repository=$this->getDoctrine()->getRepository(Evenement::class);
        $event=$repository->findAll();
        $jsonContent = $normalizer->normalize($event,'json',['groups'=>'Evenement']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/addeventM", name="addeventM"  , methods={"POST"})
     */

    public function addevent(Request $request, NormalizerInterface $normalizer)
    {

        $event = new Evenement();



        $event->setNomEvent($request->get("nomEvent"));
        $event->setDdEvent(new \DateTime($request->get("ddEvent")));
        $event->setDfEvent(new \DateTime($request->get("dfEvent")));
        $event->setThemeEvent($request->get("themeEvent"));
        $event->setAdresseEvent($request->get("adresseEvent"));
        $event->setTelephone($request->get("telephone"));



        $em = $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();

        $jsonContent = $normalizer->normalize($event,'json',['groups'=>'Evenement']);
        return new Response("Evenement added Successfully ".json_encode($jsonContent));
    }

    /**
     * @Route("/updateeventM",name="updateeventM")
     */
    public function updateeventM(Request $request,NormalizerInterface $normalizer)
    {
        $id = $request->get("idEvent");


        $event = $this->getDoctrine()->getRepository(Evenement::class)->find($id);
        $event->setNomEvent($request->get("nomEvent"));
        $event->setDdEvent(new \DateTime($request->get("ddEvent")));
        $event->setDfEvent(new \DateTime($request->get("dfEvent")));
        $event->setThemeEvent($request->get("themeEvent"));
        $event->setAdresseEvent($request->get("adresseEvent"));
        $event->setTelephone($request->get("telephone"));

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $jsonContent = $normalizer->normalize($event, 'json', ['groups' => 'Evenement']);

        return new Response("event updated Successfully ".json_encode($jsonContent));
    }

    /**
     * @Route("/deleventM/{idEvent}", name="deleventM")
     */
    public function deleventM(Request $request,NormalizerInterface $normalizer,$idEvent):Response
    {


        $em= $this->getDoctrine()->getManager();
        $event=$em->getRepository(Evenement::class)->find($idEvent);
        $em->remove($event);
        $em->flush();
        $jsonContent = $normalizer->normalize($event,'json',['groups'=>'Evenement']);
        return new Response("Event deleted Successfully ".json_encode($jsonContent));
    }


    /**
     * @Route("/listinvmobile", name="listinvmobile")
     */

    public function listinv(Request $request,NormalizerInterface $normalizer  ):Response
    {
        $repository=$this->getDoctrine()->getRepository(Invitation::class);
        $event=$repository->findAll();
        $jsonContent = $normalizer->normalize($event,'json',['groups'=>'Invitation']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/addinvM", name="addinvM"  , methods={"POST"})
     */

    public function addinvM(Request $request, NormalizerInterface $normalizer)
    {

        $inv = new Invitation();

        $inv->setIdUser($request->get("idUser"));

        $inv->setNomEvent($request->get("nomEvent"));


        $em = $this->getDoctrine()->getManager();
        $em->persist($inv);
        $em->flush();

        $jsonContent = $normalizer->normalize($inv,'json',['groups'=>'Invitation']);
        return new Response("Invitation added Successfully ".json_encode($jsonContent));
    }

    /**
     * @Route("/updatinvM",name="updatinvM")
     */
    public function updatinvM(Request $request,NormalizerInterface $normalizer)
    {
        $id = $request->get("idInvitation");


        $inv = $this->getDoctrine()->getRepository(Invitation::class)->find($id);
        $inv->setIdUser($request->get("idUser"));

        $inv->setNomEvent($request->get("nomEvent"));

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $jsonContent = $normalizer->normalize($inv, 'json', ['groups' => 'Invitation']);

        return new Response("Invitation updated Successfully ".json_encode($jsonContent));
    }

    /**
     * @Route("/delinvM/{idInvitation}", name="delinvM")
     */
    public function delinvM(Request $request,NormalizerInterface $normalizer,$idInvitation):Response
    {


        $em= $this->getDoctrine()->getManager();
        $inv=$em->getRepository(Invitation::class)->find($idInvitation);
        $em->remove($inv);
        $em->flush();
        $jsonContent = $normalizer->normalize($inv,'json',['groups'=>'Invitation']);
        return new Response("Invitation deleted Successfully ".json_encode($jsonContent));
    }


}
