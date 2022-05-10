<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use symfony\mailer;
use Symfony\Component\Mime\Email;


class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function register(Request $request, MailerInterface $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $user->getPhotoUser();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $filename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $geocoder = new \OpenCage\Geocoder\Geocoder('1d6b2244086f43a5af7f645a47a06fa7');
            $result = $geocoder->geocode($user->getAdresseUser());
            $first = $result['results'][0];
            $user->setLatitude($first['geometry']['lat']);
            $user->setLongitude($first['geometry']['lng']);

            $entityManager = $this->getDoctrine()->getManager();
            $user->setPhotoUser($filename);
            $to = $form["emailUser"]->getData();
            $email = (new Email())
                ->from('koolmatch2@gmail.com')
                ->to($to)
                ->subject('Inscription avec succé')
                ->text('Bienvenue parmi nous! vous êtes inscrit avec succé');
            $mailer->send($email);
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'votre comte est créer avec sucés');
            return $this->redirectToRoute('user_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
