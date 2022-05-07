<?php

namespace App\Controller;

use App\Entity\Gerant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Annotation\Groups;

class GerantJsonController extends AbstractController
{
    /**
     * @Route("/gerant/json", name="app_gerant_json", methods={"Post","GET"})
     */
    public function index(SerializerInterface $serializerInterface): Response
    {
        $G = $this->getDoctrine()
            ->getRepository(Gerant::class)
            ->findAll();
        $serializer = new Serializer(
            array(
                new DateTimeNormalizer(array('datetime_format' => 'Y-m-d')),
                new ObjectNormalizer()
            )
        );
        $json = $serializer->normalize($G , 'json', [AbstractNormalizer::ATTRIBUTES => ['idGerant','nomGerant','prenomGerant','emailGerant','passwordGerant','telephoneGerant','ddAbonnement','dfAbonnement']]);
        return new JsonResponse($json);
    }
    /**
     * @Route("/json/addgerant", name="addgerant", methods={"POST","GET"}, requirements={"idGerant":"\d+"})
     */
    public function addgerant(Request $request)
    {
        $G = new Gerant();
        $nomGerant = $request->query->get("nomGerant");
        $prenomGerant = $request->query->get("prenomGerant");
        $emailGerant = $request->query->get("emailGerant");
        $passwordGerant = $request->query->get("passwordGerant");
        $telephoneGerant = $request->query->get("telephoneGerant");
        $ddAbonnement = $request->query->get("ddAbonnement");
        $dfAbonnement = $request->query->get("dfAbonnement");
        $em = $this->getDoctrine()->getManager();
        $G->setNomGerant($nomGerant);
        $G->setPrenomGerant($prenomGerant);
        $G->setEmailGerant($emailGerant);
        $G->setPasswordGerant($passwordGerant);
        $G->setTelephoneGerant($telephoneGerant);
        $G->setDdAbonnement (new \DateTime($request->get("ddAbonnement")));
        $G->setDfAbonnement (new \DateTime($request->get("dfAbonnement")));
        $em->persist($G);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize("Gerant added successfully");
        return new JsonResponse($formatted);

    }
    /**
     * @Route("/json/removegerant/{idGerant}", name="suprimer_gerant", methods={"DELETE"})
     */
    public function supprimergerant(NormalizerInterface $Normalizer, Gerant $gerant): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($gerant);
        $em->flush();
        $jsonContent = $Normalizer->normalize($gerant, 'json');
        return new Response("Gerant Suprrimé avec succes! ".json_encode($jsonContent));
    }
    /**
     * @Route("/json/modifgerant/{idGerant}", name="modifgerant" , methods={"PUT"})
     */
    public function modifiergerant(Request $request): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $gerant = $this->getDoctrine()->getManager()
            ->getRepository(Gerant::class)
            ->find($request->get("idGerant"));

        $gerant->setNomGerant($request->get("nomGerant"));
        $gerant->setPrenomGerant($request->get("prenomGerant"));
        $gerant->setEmailGerant($request->get("emailGerant"));
        $gerant->setPasswordGerant($request->get("passwordGerant"));
        $gerant->setTelephoneGerant($request->get("telephoneGerant"));
        $gerant->setDdAbonnement (new \DateTime($request->get("ddAbonnement")));
        $gerant->setDfAbonnement (new \DateTime($request->get("dfAbonnement")));

        $em->persist($gerant);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize("Gerant updated successfully");
        return new JsonResponse($formatted);
    }
}