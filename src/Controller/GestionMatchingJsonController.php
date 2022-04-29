<?php

namespace App\Controller;

use App\Entity\Interaction;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;


class GestionMatchingJsonController extends AbstractController
{
    /**
     * @Route("/gestion/matching/json", name="app_gestion_matching_json")
     */
    public function index(): Response
    {
        return $this->render('gestion_matching_json/index.html.twig', [
            'controller_name' => 'GestionMatchingJsonController',
        ]);
    }

    /**
     * @param User $id
     * @Route ("/json/algorithme/{id}",name="algorithme")
     */
    public function algorithm(Request $request, NormalizerInterface $Normalizer, $id)
    {
        $u = $this->getDoctrine()->getRepository(User::class)->find($id);
        $today = new \DateTime("now", new \DateTimeZone('+0100'));
        $query = $this->getDoctrine()->getManager()
            ->createQuery('SELECT u
            FROM App\Entity\User u
            WHERE u.idUser NOT LIKE :id_user AND u.archive = 0 AND Upper(u.sexeUser) NOT LIKE Upper(:sexe_user)
            and Year(:CURRENT_DATE) - Year(u.datenaissanceUser) > :minAge and Year(:CURRENT_DATE) - Year(u.datenaissanceUser) < :maxAge 
            and ((((ACOS ( SIN((u.latitude*PI()/180))*SIN((:lat *PI()/180))+COS((u.latitude*PI()/180))*COS((:lat*PI()/180))*COS((u.longitude-:long)*PI()/180))))*180/PI())*60*1.1515*1.609344) <= :prefDistance
            ORDER BY ABS(u.interetUser - :Interet_user)')
            //composer for datetime and numeric functions
            ->setParameter('id_user', $u->getIdUser())
            ->setParameter('sexe_user', $u->getSexeUser())
            ->setParameter('Interet_user', $u->getInteretUser())
            ->setParameter('CURRENT_DATE', $today)
            ->setParameter('minAge', $u->getPreferredminageUser())
            ->setParameter('maxAge', $u->getPreferredmaxageUser())
            ->setParameter('lat', $u->getLatitude())
            ->setParameter('long', $u->getLongitude())
            ->setParameter('prefDistance', $u->getMaxdistanceUser());
        // returns an array of User objects
        $listUser = $query->getResult();
        $jsonContent = $Normalizer->normalize($listUser, 'json', ['groups' => 'algorithme']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @param Request $request
     * @param NormalizerInterface $Normalizer
     * @Route ("/json/addInteraction/new",name="addInteractionJson")
     * @return void
     */
    public function ajouterInteraction(Request $request, NormalizerInterface $Normalizer)
    {
        $idUser1 = $request->get('connectedUser');
        $user1 = $this->getDoctrine()->getRepository(User::class)->find($idUser1);
        $idUser2 = $request->get('user');
        $user2 = $this->getDoctrine()->getRepository(User::class)->find($idUser2);
        $em = $this->getDoctrine()->getManager();
        $interaction = new Interaction();
        $interaction->setDateInteraction(new \DateTime("now", new \DateTimeZone('+0100')));
        $interaction->setIdUser1($user1);
        $interaction->setIdUser2($user2);
        $interaction->setTypeInteraction($request->get('type'));
        $em->persist($interaction);
        $em->flush();
        $jsonContent = $Normalizer->normalize($interaction, 'json');
        return new Response(json_encode($jsonContent));
    }

    /**
     * @param NormalizerInterface $Normalizer
     * @param $id
     * @Route ("/json/deleteInteraction/{id}", name="deleteInteractionJson")
     * @return Response
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function deleteInteraction(NormalizerInterface $Normalizer, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $interaction = $em->getRepository(Interaction::class)->find($id);
        $em->remove($interaction);
        $em->flush();
        $jsonContent = $Normalizer->normalize($interaction, 'json');
        return new Response("Interaction Suprrimé avec succes! ".json_encode($jsonContent));
    }

}
