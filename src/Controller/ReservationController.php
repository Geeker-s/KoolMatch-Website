<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Controller\ReservationRepository;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Psr7\UploadedFile;
use Twilio\Rest\Client;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class ReservationController extends AbstractController
{
    const  ATTRIBUTES_TO_SERIALIZE = ['idReservation', 'dateReservation', 'nbPlaceReservation', 'idRestaurant', 'idUser', 'archive', 'image ', 'nomResto', 'adresse'];

    /**
     * @Route("/", name="reservation_app")
     */
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }

    /**
     * @Route("/listreservation", name="listereservation")
     */
    public function listreservation()
    {
        $reservation = $this->getDoctrine()->getRepository(Reservation::class)->findAll();
        return $this->render("reservation/listreservation.html.twig", array("Reservation" => $reservation));
    }

    /**
     * @Route("/listback", name="back_list")
     */
    public function listback()
    {
        $reservation = $this->getDoctrine()->getRepository(Reservation::class)->findAll();
        return $this->render("back/list_back_resevation.html.twig", array("Reservation" => $reservation));
    }


    /**
     * @Route("/addreservation", name="reservation_app")
     */
    public function addreservation(\Symfony\Component\HttpFoundation\Request $request)
    {
        $reservation = new Reservation();
        $reservation->setArchive(0);
        $reservation->setIdUser(1);
        $reservation->setImage('aaaaaaa');

        $form = $this->createForm(reservationType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute("reservation_app");
        }
        return $this->render('reservation/reservation.html.twig', array("forms" => $form->createView()));
    }

    /**
     * @Route("/delete1/{idReservation}", name="delete1")
     */
    public function delete($idReservation)
    {
        $Reservation = $this->getDoctrine()->getRepository(Reservation::class)->find($idReservation);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Reservation);
        $em->flush();
        return $this->redirectToRoute("listereservation");
    }

    /**
     * @Route("/update1/{idReservation}", name="update1")
     */
    public function update(Request $request, $idReservation)
    {
        $Reservation = $this->getDoctrine()->getRepository(Reservation::class)->find($idReservation);
        $form = $this->createForm(ReservationType::class, $Reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute("listereservation");
        }
        return $this->render("reservation/reservation.html.twig", array("forms" => $form->createView()));
    }


    /**
     * @Route("/stat", name="stat")
     */
    public function indexAction()
    {
        $pieChart = new pieChart();
        $em = $this->getDoctrine();
        $e = $em->getRepository(Reservation::class)->findAll();
        $totaleq = 0;
        foreach ($e as $Reservation) {
            $totaleq = $totaleq + $Reservation->getNbplaceReservation();
        }
        $data = array();
        $stat = ['NbplaceReservationout', 'NomResto'];
        $nb = 0;
        array_push($data, $stat);
        foreach ($e as $Reservation) {
            $stat = array();
            array_push($stat, $Reservation->getNomResto(), (($Reservation->getNbplaceReservation()) * $totaleq) / 100);
            $nb = ($Reservation->getNbplaceReservation() * $totaleq) / 100;


            $stat = [$Reservation->getNomResto(), $nb];
            array_push($data, $stat);
        }
        $pieChart->getData()->setArrayToDataTable($data);
        $pieChart->getOptions()->setTitle('Pourcentage de places selon les restaurants disponibles');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('back/stats.html.twig', array('piechart' => $pieChart));
    }

    /**
     * @Route("/DownloadreservationsData", name="DownloadreservationsData")
     */
    public function DownloadreservationsData()
    {
        $Reservation = $this->getDoctrine()->getRepository(Reservation::class)->findAll();

        // On définit les options du PDF
        $pdfOptions = new Options();
        // Police par défaut
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);

        // On instancie Dompdf
        $dompdf = new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($context);

        // On génère le html
        $html = $this->renderView('back/download.html.twig',
            ['Reservation' => $Reservation]);


        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // On génère un nom de fichier
        $fichier = 'Tableau des Reservation.pdf';

        // On envoie le PDF au navigateur
        $dompdf->stream($fichier, [
            'Attachment' => true
        ]);

        return new Response();
    }


    /**
     * @Route("reservation/ajouter/reservation" , methods={"POST"}, name="reservation_ajouter--1")
     */
    public function ajouter(Request $request, SerializerInterface $serializer)
    {

        $Reservation = new Reservation();
        $nomResto = $request->request->get("nomResto");
        $nbplaceReservation = $request->request->get('nbplaceReservation');
        $idUser = $request->request->get('idUser');
        $adresse = $request->request->get('adresse');
        $image = $request->request->get('image');
        $dateReservation = $request->request->get('dateReservation');

        $em = $this->getDoctrine()->getManager();

        $Reservation->setNomResto($nomResto);
        $Reservation->setNbplaceReservation($nbplaceReservation);
        $Reservation->setIdUser($idUser);
        $Reservation->setAdresse($adresse);
        $Reservation->setImage($image);
        $Reservation->setDateReservation(new \DateTime());

        $em->persist($Reservation);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Reservation);
        return new JsonResponse($formatted);
    }


    /**
     * @Route("/afficher/reservation" , name="reservation_afficher" ,  methods={"GET", "POST"}, requirements={"idReservation":"\d+"})
     */

    public function afficher(Request $request, SerializerInterface $serializer)
    {
        $repo = $this->getDoctrine()->getRepository(Reservation::class);
        $Reservation = $repo->findAll(["archive" => 0]);
        $json = $serializer->serialize($Reservation, 'json', ['groups' => ['Reservation']]);
        //tbadel lite hebergement badlou forme jsn


        return $this->json($Reservation, Response::HTTP_OK, [], [
            'attributes' => self::ATTRIBUTES_TO_SERIALIZE
        ]);
    }

    /**
     * @Route("/modifier/reservation/{idReservation}" , name="reservation_modifier" ,  methods={"GET", "POST"}, requirements={"idReservation":"\d+"})
     */

    public function modifier(Request $request, SerializerInterface $serializer, $idReservation)
    {


        $em = $this->getDoctrine()->getManager();
        $Reservation = $em->getRepository(Reservation::class)->find($idReservation);
        $Reservation->setNomResto($request->get('nomResto'));
        $Reservation->setNbplaceReservation($request->get('nbplaceReservation'));
        $Reservation->setIdUser($request->get('idUser'));
        $Reservation->setAdresse($request->get('adresse'));
        $Reservation->setImage($request->get('image'));
        $Reservation->setDateReservation(new \DateTime());
        $em->persist($Reservation);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Reservation);
        return new JsonResponse($formatted);
    }

    /**
     * @Route("/delete/reservation/{idReservation}" , name="reservation_delete" ,  methods={"GET", "POST"}, requirements={"idReservation":"\d+"})
     */

    public function Deletee(Request $request, SerializerInterface $serializer, $idReservation)
    {


        $em = $this->getDoctrine()->getManager();
        $Reservation = $em->getRepository(Reservation::class)->find($idReservation);

        $em->remove($Reservation);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Reservation);
        return new JsonResponse($formatted);
    }

}



