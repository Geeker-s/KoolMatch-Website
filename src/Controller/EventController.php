<?php

namespace App\Controller;

use App\api\MailerApi;
use App\api\TwilioApi;
use App\Entity\Evenement;
use App\Form\EventType;
use Dompdf\Adapter\CPDF;

use Dompdf\Exception;
use App\Repository\EventRepo;
use App\Repository\MoyenDeTransportRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/afficher_event", name="afficher_event")
     */
    public function index(EventRepo $eventRepo, PaginatorInterface $paginator, Request $request): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Evenement::class)->findBy([], ['nomEvent' => 'asc']);

        $event = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page

        );
        return $this->render('event/EventFront.html.twig', [
            'e' => $event
        ]);
    }

    /**
     * @Route("/backevent", name="afficher_eventBack")
     */
    public function index_back()
    {
        $events = $this->getDoctrine()->getManager()->getRepository(Evenement::class)->findAll();


        return $this->render('event/index.html.twig', [
            'ev' => $events
        ]);
    }


    /**
     * @Route("/addevent", name="addevent")
     */
    public function Addevent(Request $request, MailerInterface $mailer): Response
    {
        $event = new Evenement();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            $email = new MailerApi();
            $twilio = new TwilioApi('AC92e02dedbc8f9ca3c0b4de044dc4e98b', 'acad302bb346f33c23a74197f223a650', '+19896324887');
            $twilio->sendSMS('+21699474824', ' Une evenement a été ajouter ');
            $email->sendEmail($mailer, 'testapimail63@gmail.com', 'bayrem.hamdi@esprit.tn', 'Event creation ', 'Une evenement a été ajouter');
            $this->addFlash(
                'info', ' added successfully !');


            //return $this->redirectToRoute('afficher_event');
        }
        return $this->render('event/createevent.html.twig', ['f' => $form->createView()]);

    }

    /**
     * @Route("/ListEvent", name="event_list", methods={"GET"})
     */
    public function listEvent(EventRepo $eventRepo): Response
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Courier');
        $pdfOptions->setIsRemoteEnabled(true);
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $event = $eventRepo->findAll();
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('event/ListEvent.html.twig', [
            'event' => $event
        ]);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Event.pdf", [
            "Attachment" => true
        ]);
        return $this->render('event/ListEvent.html.twig', [
            'event' => $event
        ]);
    }

    /**
     * @Route("/Suppevent/{idEvent}", name="supp_event")
     */
    public function Suppevent(Evenement $evenement): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($evenement);
        $em->flush();
        $this->addFlash('info2', 'deleted successfully!');

        return $this->redirectToRoute('afficher_eventBack');

    }

    /**
     * @Route("/modifevent/{idEvent}", name="modifevent")
     */
    public function modifevent(Request $request, $idEvent): Response
    {
        $event = $this->getDoctrine()->getManager()->getRepository(Evenement::class)->find($idEvent);
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->flush();
            $this->addFlash('info3', 'updated successfully!');

            //return $this->redirectToRoute('afficher_event');
        }
        return $this->render('event/updateevent.html.twig', ['f' => $form->createView()]);

    }


}
