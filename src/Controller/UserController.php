<?php

namespace App\Controller;

use App\Entity\Recherche;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\ConnexionUserType;
use App\Form\EmailPassForgottenType;
use App\Form\PassType;
use App\Form\UserType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="display_user", methods={"GET","POST"})
     */
    public function index(PaginatorInterface $paginator, Request $request, UserRepository $userRepository): Response
    {
        $allusers = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        $user = new Recherche();
        $searchform = $this->createFormBuilder($user)
            ->add('nomUser', TextType::class, array('attr' => array('class' => 'form-control')))
            ->getForm();

        $searchform->handleRequest($request);
        if ($searchform->isSubmitted() && $searchform->isValid()) {
            $term = $user->getNomUser();
            $allusers = $userRepository->search($term);
        } else {
            $allusers = $userRepository->findAll();
            $allusers = $userRepository->orderByNom();
        }
        $user = $paginator->paginate(
            // Doctrine Query, not results
            $allusers,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'searchform' => $searchform->createView(),
            'usr' => $user
        ]);
    }

    /**
     * @Route("/loginUser", name="user_login")
     */
    public function loginUser(Request $request, UserRepository $userRepository): Response
    {
        $session = $request->getSession();
        $session->clear();
        $user = new User();
        $form = $this->createForm(ConnexionUserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $username = $form["emailUser"]->getData();
            $password = $form["passwordUser"]->getData();
            $archive = $request->request->get("archive");
            $test = $this->getDoctrine()->getRepository(User::class)->findOneBy(array('emailUser' => $username, 'passwordUser' => $password, 'archive' => 0));
            if (!$test) {

                $this->get('session')->getFlashBag()->add(
                    'info',
                    'Login Incorrecte Vérifier Votre Login'
                );
            } else {
                if (!$session->has('usr')) {
                    $session->set('usr', $test);
                    $u = $session->get('usr');

                    return $this->render('user/profile.html.twig', [
                        'usr' => $u

                    ]);
                } else {
                    $u = $session->get('usr');
                    return $this->render('user/profile.html.twig', [
                        'usr' => $u

                    ]);
                }
            }
        }
        return $this->render('user/loginUser.html.twig', ['u' => $form->createView()]);
    }

    /**
     * @Route("/removeuser/{idUser}", name="suprimer_user")
     */
    public function supprimeruser(User $user): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('display_user');
    }

    /**
     * @Route("/blocuser/{idUser}", name="blocuser")
     */
    public function BlocUser(Request $request, $idUser): Response
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($idUser);
        $user->setArchive(1);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash('success', 'Utilisateur Bloqué');
        return $this->redirectToRoute('display_user');
    }

    /**
     * @Route("/inblocUser/{idUser}", name="inblocuser")
     */
    public function InBlocUser(Request $request, $idUser): Response
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($idUser);
        $user->setArchive(0);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash('success', 'Utilisateur débloqué');
        return $this->redirectToRoute('display_user');
    }

    /**
     * @Route("/forgotten_pass", name="app_forgotten_password")
     */
    public function forgottenPass(Request $request, UserRepository $userRepo, MailerInterface $mailer, TokenGeneratorInterface $tokenGenerator)
    {

        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }
        $form = $this->createForm(EmailPassForgottenType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $donnees = $form->get('email')->getData();
            $user = $this->getDoctrine()->getRepository(User::class)->findOneByEmail($donnees);
            if (!$user) {
                $this->addFlash('danger', 'cettte adresse n\exsite pas');
                return $this->render('user/passforgotten.html.twig', ['form' => $form->createView(), 'Message' => "Entrez Votre Email!"]);
            }
            $token = $tokenGenerator->generateToken();
            try {
                $user->setResetToken($token);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', 'une erreur est servenue : ' . $e->getMessage());
                return $this->render('user/passforgotten.html.twig', ['form' => $form->createView(), 'Message' => "Entrez Votre Email!"]);
            }
            $url = $this->generateUrl('app_reset_password', ['token' => $token]);
            $message = (new TemplatedEmail())
                ->from('koolmatch2@gmail.com')
                ->to($user->getEmailUser())
                ->html(
                    "<p> bonjour ,</p><p></p> une demande de réinitialisation de mot de passe à été effectué pour l'application KoolMatch.
                            veuillez cliquer sur le lien suivant: localhost:8000" . $url . "</p>"
                );

            $mailer->send($message);
            $this->addFlash('message', "un e_mail de renitialisation de mot de passe  vous a ete envoye");
            return $this->redirectToRoute('user_login');
        }
        return $this->render('user/passforgotten.html.twig', ['form' => $form->createView(), 'Message' => "Entrez Votre Email!"]);
    }

    /**
     * @Route ("/reset_pass/{token}" , name="app_reset_password")
     */
    public function resetpass(Request $request, $token, EntityManagerInterface $entityManager)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findytoken($token);
        if (!$user) {
            return $this->redirectToRoute("user_login");
        }
        $form = $this->createForm(PassType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $user->setPasswordUser(

                $form->get('passwordUser')->getData()

            );
            $entityManager->flush();
            return $this->redirectToRoute("user_login");
        }
        return $this->render('user/passforgotten.html.twig', ['form' => $form->createView(), 'Message' => "Entrez Votre Nouveau mot de passe!"]);
    }

    /**
     * @Route("/profile", name="user_show", methods={"GET"})
     */
    public function show(Request $request): Response
    {
        $session = $request->getSession();
        $user = $session->get('usr');
        return $this->render('user/profile.html.twig', [
            'usr' => $user,
        ]);
    }

    /**
     * @Route("/{idUser}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $session = $request->getSession();
        $user = $session->get('usr');
        $user->setPhotoUser("");
        $form = $this->createForm(UserType::class, $user);
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
            $em = $this->getDoctrine()->getManager();
            $user->setPhotoUser($filename);
            $em->flush();

            return $this->redirectToRoute('user_show');
        } else {
            return $this->render('user/edit.html.twig', [

                'form' => $form->createView(),
                'usr' => $user,
            ]);
        }
    }
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        $this->redirectToRoute("/loginUser");
    }
}
