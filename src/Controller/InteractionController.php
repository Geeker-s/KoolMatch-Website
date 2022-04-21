<?php

namespace App\Controller;

use App\Entity\Interaction;
use App\Entity\Matching;
use App\Entity\User;
use App\Form\InteractionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\matches;

class InteractionController extends AbstractController
{
    /**
     * @Route("/interaction", name="app_interaction")
     */
    public function index(Request $request): Response
    {
        $interactions = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('interaction/index.html.twig',
            array('interactions' => $interactions)
        );
    }


    //Function Algorithm qui retourne une liste des utilisateurs selon l'interet d'un User
    public function algorithm(User $u): array
    {
        $query = $this->getDoctrine()->getManager()
            ->createQuery('SELECT u
            FROM App\Entity\User u
            WHERE u.idUser NOT LIKE :id_user AND u.archive = 0 AND Upper(u.sexeUser) NOT LIKE Upper(:sexe_user)
            ORDER BY ABS(u.interetUser - :Interet_user)')
            ->setParameter('id_user', $u->getIdUser())
            ->setParameter('sexe_user', $u->getSexeUser())
            ->setParameter('Interet_user', $u->getInteretUser());
        // returns an array of User objects
        return $query->getResult();
    }

    //Convertir un String suite de binaire en nombre decimale
    function hex($s)
    {
        $i = 0;
        $res = "";
        while ($i <= strlen($s) - 3) {
            $res += strval(intval(substr($s, $i, $i + 3 - $i), 2));
            $i += 3;
        }
        return intval($res);
    }

    //Calculate Age of user
    function Age(User $u)
    {
        $today = date("Y-m-d");
        $diff = date_diff(date_create($u->getDatenaissanceUser()), date_create($today));
        return $diff->format('%y');
    }

    /**
     * @Route ("/addInteraction", name="addInteraction")
     */
    public function addInteraction(Request $request)
    {
        //This will be replaced by session
        $connectedUser = $this->getDoctrine()->getRepository(User::class)->find(23);
        $interactions = $this->algorithm($connectedUser);
        $em = $this->getDoctrine()->getManager();
        $interaction = new Interaction();
        $interaction->setIdUser1($connectedUser);
        $interaction->setDateInteraction(new \DateTime("now", new \DateTimeZone('+0100')));
        if ($request->isXmlHttpRequest()) {
            $type = $request->request->get("type");
            $id_user = $request->request->get("iduser");
            $interaction->setIdUser2($this->getDoctrine()->getRepository(User::class)->find($id_user));
            $interaction->setTypeInteraction($type);
            if ( $type = "x") {

            }
            //Auto Matching chaque interaction
            $sql = $this->getDoctrine()->getManager()
                ->createQuery('SELECT i
            FROM App\Entity\Interaction i
            WHERE i.idUser1 = :id_user1 AND i.idUser2 = :id_user2 AND i.typeInteraction = :typeInteraction')
                ->setParameter('id_user1', $id_user)
                ->setParameter('id_user2', $connectedUser->getIdUser())
                ->setParameter('typeInteraction', "o");
            $isMatched = $sql->getResult();

            if (empty($isMatched)) {
                $em->persist($interaction);
                $em->flush();
            } else {
                $em = $this->getDoctrine()->getManager();
                foreach ($isMatched as $item) {
                    $em->remove($item);
                }
                $em->flush();
                $match = new Matching();
                $match->setIdUser1($connectedUser);
                $hasbeenReacted = $this->getDoctrine()->getRepository(User::class)->find($id_user);
                $match->setIdUser2($hasbeenReacted);
                $match->setDateMatching(new \DateTime("now", new \DateTimeZone('+0100')));
                $this->forward('App\Controller\MatchingController::ajouterMatching', [
                    'm'  => $match,
                ]);

            }

        }
        return $this->render('interaction/addInteraction.html.twig',
            array('interactions' => $interactions, 'lat' => $connectedUser->getLatitude(), 'lon' => $connectedUser->getLongitude()));
    }

    /**
     * @Route("/back/interaction", name="back_interaction")
     */
    public function InteractionBack()
    {
        $interactions = $this->getDoctrine()->getRepository(Interaction::class)->findAll();
        $matches = $this->getDoctrine()->getRepository(Matching::class)->findAll();

        return $this->render('/back/interaction.html.twig',
            array('interactions' => $interactions, 'matches' => $matches)
        );
    }

    /**
     * @param $id
     * @Route ("/deleteInteraction/{id}",name="deleteInteraction")
     */
    public function deleteInteraction($id)
    {
        $interaction = $this->getDoctrine()->getRepository(Interaction::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($interaction);
        $em->flush();
        return $this->redirectToRoute("back_interaction");
    }

    /**
     * @Route ("/updateInteraction/{id}",name="updateInteraction")
     */
    public function updateInteraction(Request $request, $id)
    {
        $interaction = $this->getDoctrine()->getRepository(Interaction::class)->find($id);
        $form = $this->createForm(InteractionType::class, $interaction);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("back_interaction");
        }
        return $this->render("back/updateInteraction.html.twig", array("formInteraction" => $form->createView()));
    }

    /**
     * @Route ("/autoMatching",name="automatching")
     */
    public function autoMatching()
    {


        return $this->redirectToRoute("back_interaction");
    }


}
