<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
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

class UserJsonController extends AbstractController
{
    /**
     * @Route("/user/json", name="app_user_json")
     */
    public function index(): Response
    {
        $U = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();
        $serializer = new Serializer(
            array(
                new DateTimeNormalizer(array('datetime_format' => 'Y-m-d')),
                new ObjectNormalizer()
            )
        );
        $json = $serializer->normalize($U , 'json', [AbstractNormalizer::ATTRIBUTES => ['idUser','emailUser','passwordUser','nomUser','prenomUser','datenaissanceUser','sexeUser','telephoneUser','photoUser','descriptionUser','maxdistanceUser','preferredminageUser','preferredmaxageUser','adresseUser','latitude','longitude','interetUser']]);
        return new JsonResponse($json);
    }

    /**
     * @Route("/json/adduser", name="adduser", methods={"POST","GET"}, requirements={"idUser":"\d+"})
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function adduser(Request $request,MailerInterface $mailer)
    {
        $U = new User();
        $emailUser = $request->query->get("emailUser");
        $passwordUser = $request->query->get("passwordUser");
        $nomUser = $request->query->get("nomUser");
        $prenomUser = $request->query->get("prenomUser");
        $datenaissanceUser = $request->query->get("datenaissanceUser");
        $sexeUser = $request->query->get("sexeUser");
        $telephoneUser = $request->query->get("telephoneUser");
        $maxdistanceUser = $request->query->get("maxdistanceUser");
        $preferredminageUser = $request->query->get("preferredminageUser");
        $preferredmaxageUser = $request->query->get("preferredmaxageUser");
        $adresseUser = $request->query->get("adresseUser");
        $latitude = $request->query->get("latitude");
        $longitude = $request->query->get("longitude");
        $interetUser = $request->query->get("interetUser");
        $em = $this->getDoctrine()->getManager();
        $U->setEmailUser($emailUser);
        $U->setPasswordUser($passwordUser);
        $U->setNomUser($nomUser);
        $U->setPrenomUser($prenomUser);
        $U->setDatenaissanceUser(new \DateTime($datenaissanceUser));
        $U->setSexeUser($sexeUser);
        $U->setTelephoneUser($telephoneUser);
        $U->setPhotoUser("none");
        $U->setDescriptionUser("No Description");
        $U->setMaxdistanceUser($maxdistanceUser);
        $U->setPreferredminageUser($preferredminageUser);
        $U->setPreferredmaxageUser($preferredmaxageUser);
        $U->setAdresseUser($adresseUser);
        $U->setLatitude($latitude);
        $U->setLongitude($longitude);
        $U->setInteretUser($interetUser);
        $em->persist($U);
        $em->flush();

        $message = (new TemplatedEmail())
            ->from('koolmatch2@gmail.com')
            ->to($U->getEmailUser())
            ->html(
                "Votre Compte à été crée"
            );

        $mailer->send($message);

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize("User added successfully");
        return new JsonResponse($formatted);

    }
    /**
     * @Route("/json/signin")
     */
    public function signinMobile(Request $request){
        $username = $request->request->get("email");
        $password = $request->request->get("password");
        $test = $this->getDoctrine()->getRepository(User::class)->findOneBy(array('emailUser' => $username, 'passwordUser' => $password, 'archive' => 0));
        if (!$test) {
            return $this->json("0");
        } else {
            return $this->json(["id"=>$test->getIdUser(),"email" => $test->getEmailUser()]); //TODO : Kamel les valeurs
        }
    }
    /**
     * @Route("/json/removeuser/{idUser}", name="suprimer_user", methods={"DELETE"})
     */
    public function supprimeruser(NormalizerInterface $Normalizer, User $user): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        $jsonContent = $Normalizer->normalize($user, 'json');
        return new Response("User Suprrimé avec succes! ".json_encode($jsonContent));
    }
    /**
     * @Route("/json/modifuser/{idUser}", name="modifuser" , methods={"PUT"})
     */
    public function modifieruser(Request $request): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getManager()
            ->getRepository(User::class)
            ->find($request->get("idUser"));

        $user->setEmailUser($request->get("emailUser"));
        $user->setPasswordUser($request->get("passwordUser"));
        $user->setNomUser($request->get("nomUser"));
        $user->setPrenomUser($request->get("prenomUser"));
        $user->setDatenaissanceUser (new \DateTime($request->get("datenaissanceUser")));
        $user->setSexeUser($request->get("sexeUser"));
        $user->setTelephoneUser($request->get("telephoneUser"));
        $user->setPhotoUser($request->get("photoUser"));
        $user->setDescriptionUser($request->get("descriptionUser"));
        $user->setMaxdistanceUser($request->get("maxdistanceUser"));
        $user->setPreferredminageUser($request->get("preferredminageUser"));
        $user->setPreferredmaxageUser($request->get("preferredmaxageUser"));
        $user->setAdresseUser($request->get("adresseUser"));
        $user->setLatitude($request->get("latitude"));
        $user->setLongitude($request->get("longitude"));
        $user->setInteretUser($request->get("interetUser"));

        $em->persist($user);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize("User updated successfully");
        return new JsonResponse($formatted);
    }
}
