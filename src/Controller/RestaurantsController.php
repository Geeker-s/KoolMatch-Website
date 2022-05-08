<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Form\RestaurantsType;
use App\Entity\Reservation;
use App\Repository\RestaurantRepository;
use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use GuzzleHttp\Psr7\UploadedFile;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Twilio\Rest\Client;
use Knp\Component\Pager\PaginatorInterface;
use \Statickidz\GoogleTranslate;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class RestaurantsController extends AbstractController
{
    const  ATTRIBUTES_TO_SERIALIZE = ['idRestaurant', 'nomRestaurant', 'adresseRestaurant', 'telephoneRestaurant', 'sitewebRestaurant', 'specialiteRestaurant', 'idGerant', 'image', 'archive', 'nbPlaceresto', 'image_structure_resturant ', 'description', 'lien'];

    /**
     * @Route("add", name="restaurant_app")
     */
    public function index(): Response
    {
        return $this->render('restaurants/resto.html.twig', [
            'controller_name' => 'RestaurantsController',
        ]);
    }


    /**
     * @Route("/list_back", name="liste1")
     */
    public function liste(Request $request)
    {
        $Restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->orderByNb();
        $em = $this->getDoctrine()->getManager();
        return $this->render("back/affichage_table_restaurant.html.twig", array("Restaurant" => $Restaurant));
    }

    /**
     * @Route("/list_front", name="liste")
     */
    public function listfront(\Symfony\Component\HttpFoundation\Request $request, PaginatorInterface $paginator)
    {
        $Restaurant = $paginator->paginate(
            $Restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->findAll(),
            $request->query->getInt('page', 1), 3);
        return $this->render("Restaurants/list.html.twig", array("Restaurant" => $Restaurant));
    }


    /**
     * @Route("/detail/{idRestaurant}", name="list_detai")
     */
    public function show(Request $request, $idRestaurant)
    {
        $detaild = $this->getDoctrine()->getRepository(Restaurant::class)->find($idRestaurant);

        $data = array(
            'detailE' => $detaild,
        );
        return $this->render('back/list_reservation.html.twig', $data);
    }

    /**
     * @Route("/detail_resto/{idRestaurant}", name="list_detai_resto")
     */
    public function show1(\Symfony\Component\HttpFoundation\Request $request, $idRestaurant)
    {
        $detaild = $this->getDoctrine()->getRepository(Restaurant::class)->find($idRestaurant);
        $reservation = new Reservation();
        $reservation->setArchive(0);
        $reservation->setIdUser(1);
        $reservation->setImage('aaaaaaa');
        $reservation->setnomResto($detaild->getNomRestaurant());
        $reservation->setadresse('aaaaaaa');

        $form = $this->createForm(reservationType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $sid = $_ENV["TWILIO_ACCOUNT_SID"];
            $token = $_ENV["TWILIO_AUTH_TOKEN"];
            $twilio = new Client($sid, $token);
           // print($message->sid);
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            /*$twilio->messages->create(
                '+21653356020', // to
                [
                    'from' => '+18565531869', // From a valid Twilio number
                    'body' => 'votre réservation a bien été prise en compte'
                ]
            );*/



            return $this->redirectToRoute("listereservation");
        }

        return $this->render('back/listdetail.html.twig', array('detailE' => $detaild, "forms" => $form->createView()));
    }


    /**
     * @Route("/delete/{idRestaurant}", name="delete")
     */
    public function delete($idRestaurant)
    {
        $Restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($idRestaurant);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Restaurant);
        $em->flush();
        return $this->redirectToRoute("liste1");
    }

    /**
     * @Route("/add", name="restaurant_app")
     */
    public function add(\Symfony\Component\HttpFoundation\Request $request)
    {
        $Restaurant = new Restaurant();

        $form = $this->createForm(RestaurantsType::class, $Restaurant);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


            /**
             * @var UploadedFile $file
             */

            $file = $form['image']->getData();

            $Restaurant = $form->getData();
            $file->move('back/assets/img/users/', $file->getClientOriginalName());
            $Restaurant->setImage("back/assets/img/users/" . $file->getClientOriginalName());
            $Restaurant->setArchive(0);
            $Restaurant->setIdGerant(1);
            $Restaurant->setImageStructureResturant('hhhhhhhh');
            $em = $this->getDoctrine()->getManager();
            $em->persist($Restaurant);
            $em->flush();
            $this->addFlash('success', 'Restaurant a ete ajouter');

            return $this->redirectToRoute("liste1");
        }
        return $this->render('back/resto.html.twig', array("forms" => $form->createView()));
    }


    /**
     * @Route("/updateStudent/{idRestaurant}", name="update")
     */
    public function updateStudent(Request $request, $idRestaurant)
    {
        $Restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($idRestaurant);
        $form = $this->createForm(RestaurantsType::class, $Restaurant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['image']->getData();
            $em = $this->getDoctrine()->getManager();
            $file->move("back/assets/img/users/", $file->getClientOriginalName());
            $Restaurant->setImage("back/assets/img/users/" . $file->getClientOriginalName());
            $em->persist($Restaurant);
            $em->flush();
            return $this->redirectToRoute("liste1");
        }
        return $this->render("back/resto.html.twig", array("forms" => $form->createView()));
    }


    public function translateajaxAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $idRestaurant = $request->get('idRestaurant');
            $rows = $em->getRepository(Restaurant::class)->findBy(array('id' => $idRestaurant));
            $tabEnsembles = array();
            $i = 0;
            foreach ($rows as $ensemble) {
                $source = 'english';
                $target = 'fr';
                $text = $ensemble->getDescription();
                $trans = new GoogleTranslate();
                $result = $trans->translate($source, $target, $text);
                $tabEnsembles[$i]['new'] = $result;
                $tabEnsembles[$i]['old'] = $ensemble->getDescription();
                $i++;
            }
            $data = json_encode($tabEnsembles);
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            return $response;

        }
        return new Response("Erreur: Ce n'est pas une requete ajax", 400);
    }

    public function rechercheAjaxAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        if ($request->isXmlHttpRequest()) {
            $search = $request->get('search');
            dump($search);
            $event = new Evenement();
            $repo = $em->getRepository(Restaurant::class);
            $event = $repo->findAjax($search);
            return $this->render('back/affichage_table_restaurant.html.twig', array('events' => $event));
        }


    }

    /**
     * @Route("resto/ajouter/resto" , name="rseto_ajouter" ,  methods={"GET", "POST"}, requirements={"idRestaurant":"\d+"})
     */
    public function ajouter(Request $request, SerializerInterface $serializer)
    {

        $Restaurant = new Restaurant();
        $nomRestaurant = $request->query->get('nomRestaurant');
        $adresseRestaurant = $request->query->get('adresseRestaurant');
        $telephoneRestaurant = $request->query->get('telephoneRestaurant');
        $sitewebRestaurant = $request->query->get('sitewebRestaurant');
        $specialiteRestaurant = $request->query->get('specialiteRestaurant');
        $imageStructureResturant = $request->query->get('imageStructureResturant');
        $idGerant = $request->query->get('idGerant');
        $image = $request->query->get('image');
        $nbPlaceresto = $request->query->get('nbPlaceresto');
        $description = $request->query->get('description');
        $lien = $request->query->get('lien');
        $em = $this->getDoctrine()->getManager();

        $Restaurant->setNomRestaurant($nomRestaurant);
        $Restaurant->setAdresseRestaurant($adresseRestaurant);
        $Restaurant->setTelephoneRestaurant($telephoneRestaurant);
        $Restaurant->setSitewebRestaurant($sitewebRestaurant);
        $Restaurant->setSpecialiteRestaurant($specialiteRestaurant);
        $Restaurant->setIdGerant($idGerant);
        $Restaurant->setImageStructureResturant($imageStructureResturant);
        $Restaurant->setImage($image);
        $Restaurant->setNbPlaceresto($nbPlaceresto);
        $Restaurant->setDescription($description);
        $Restaurant->setLien($lien);


        $em->persist($Restaurant);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Restaurant);
        return new JsonResponse($formatted);
    }

    /**
     * @Route("/afficher/RESTO" , name="resto_afficher" ,  methods={"GET", "POST"}, requirements={"idRestaurant":"\d+"})
     */

    public function afficher(Request $request, SerializerInterface $serializer)
    {
        $repo = $this->getDoctrine()->getRepository(Restaurant::class);
        $Restaurant = $repo->findAll(["archive" => 0]);
        $json = $serializer->serialize($Restaurant, 'json', ['groups' => ['Restaurant']]);
        //tbadel lite hebergement badlou forme jsn


        return $this->json(['Restaurant' => $Restaurant], Response::HTTP_OK, [], [
            'attributes' => self::ATTRIBUTES_TO_SERIALIZE
        ]);
    }

    /**
     * @Route("/modifier/resto/{idRestaurant}" , name="resto_modifier" ,  methods={"GET", "POST"}, requirements={"idRestaurant":"\d+"})
     */

    public function modifier1(Request $request, SerializerInterface $serializer, $idRestaurant)
    {


        $em = $this->getDoctrine()->getManager();
        $Restaurant = $em->getRepository(Restaurant::class)->find($idRestaurant);
        $Restaurant->setNomRestaurant($request->get('nomRestaurant'));
        $Restaurant->setAdresseRestaurant($request->get('adresseRestaurant'));
        $Restaurant->setTelephoneRestaurant($request->get('telephoneRestaurant'));
        $Restaurant->setSitewebRestaurant($request->get('sitewebRestaurant'));
        $Restaurant->setSpecialiteRestaurant($request->get('specialiteRestaurant'));
        $Restaurant->setIdGerant($request->get('idGerant'));
        $Restaurant->setImageStructureResturant($request->get('imageStructureResturant'));
        $Restaurant->setImage($request->get('image'));
        $Restaurant->setNbPlaceresto($request->get('nbPlaceresto'));
        $Restaurant->setDescription($request->get('description'));
        $Restaurant->setLien($request->get('lien'));
        $em->persist($Restaurant);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Restaurant);
        return new JsonResponse($formatted);
    }

    /**
     * @Route("/delete/resto/{idRestaurant}" , name="reservation_delete" ,  methods={"GET", "POST"}, requirements={"idRestaurant":"\d+"})
     */

    public function Deletee(Request $request, SerializerInterface $serializer, $idRestaurant)
    {


        $em = $this->getDoctrine()->getManager();
        $Restaurant = $em->getRepository(Restaurant::class)->find($idRestaurant);

        $em->remove($Restaurant);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Restaurant);
        return new JsonResponse($formatted);
    }

}