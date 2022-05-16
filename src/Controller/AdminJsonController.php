<?php

namespace App\Controller;

use App\Entity\Admin;
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

class AdminJsonController extends AbstractController
{
    /**
     * @Route("/admin/json", name="app_admin_json")
     */
    public function index(SerializerInterface $serializerInterface): Response
    {
        $G = $this->getDoctrine()
            ->getRepository(Admin::class)
            ->findAll();
        $serializer = new Serializer(
            array(
                new ObjectNormalizer()
            )
        );
        $json = $serializer->normalize($G , 'json', [AbstractNormalizer::ATTRIBUTES => ['idAdmin','loginAdmin','passwordAdmin']]);
        return new JsonResponse($json);
    }
    /**
     * @Route("/json/addadmin", name="addadmin", methods={"POST","GET"}, requirements={"idAdmin":"\d+"})
     */
    public function addadmin(Request $request)
    {
        $A = new Admin();
        $loginAdmin = $request->query->get("loginAdmin");
        $passwordAdmin = $request->query->get("passwordAdmin");
        $em = $this->getDoctrine()->getManager();
        $A->setLoginAdmin($loginAdmin);
        $A->setPasswordAdmin($passwordAdmin);
        $em->persist($A);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize("Admin added successfully");
        return new JsonResponse($formatted);

    }
    /**
     * @Route("/json/removeadmin/{idAdmin}", name="suprimer_admin", methods={"DELETE"})
     */
    public function supprimeradmin(NormalizerInterface $Normalizer, Admin $admin): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($admin);
        $em->flush();
        $jsonContent = $Normalizer->normalize($admin, 'json');
        return new Response("Admin Suprrimé avec succes! ".json_encode($jsonContent));
    }
    /**
     * @Route("/json/modifadmin/{idAdmin}", name="modifadmin" , methods={"PUT"})
     */
    public function modifieradmin(Request $request): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $admin = $this->getDoctrine()->getManager()
            ->getRepository(Admin::class)
            ->find($request->get("idAdmin"));

        $admin->setLoginAdmin($request->get("loginAdmin"));
        $admin->setPasswordAdmin($request->get("passwordAdmin"));
        $em->persist($admin);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize("Admin updated successfully");
        return new JsonResponse($formatted);
    }
}
