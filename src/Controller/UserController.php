<?php

namespace App\Controller;
use App\Entity\Recherche;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\ConnexionUserType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="display_user", methods={"GET","POST"})
     */
    public function index(PaginatorInterface $paginator,Request $request, UserRepository $userRepository): Response
    {
        $allusers= $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        $user= new Recherche();
        $searchform = $this->createFormBuilder($user)
            ->add('nomUser',TextType::class,array('attr'=>array('class'=>'form-control')))
            ->getForm();

        $searchform->handleRequest($request);
        if($searchform->isSubmitted() && $searchform->isValid()){
            $term = $user->getNomUser();
            $allusers = $userRepository->search($term);
        }
        else{
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
            'usr'=>$user
        ]);
    }
    /**
     * @Route("/loginUser", name="user_login")
     */
    public function loginUser (Request $request): Response
    {
        $user= new User();
        $form = $this ->createForm(ConnexionUserType::class,$user);
        $form -> handleRequest($request);
        if($form->isSubmitted() ){
            $username = $form["emailUser"]->getData();
            $password = $form["passwordUser"]->getData();
            $archive = $request->request->get("archive");
            $test=$this->getDoctrine()->getRepository(User::class)->findBy(array('emailUser' =>$username,'passwordUser' =>$password,'archive'=>0));
            if ($test){

                return $this->redirectToRoute('app_front');
            }
        }
        return $this->render('user/loginUser.html.twig',['u'=>$form->createView()]);
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
    public function BlocUser (Request $request,$idUser): Response{
        $user= $this->getDoctrine()->getManager()->getRepository(User::class)->find($idUser);
        $user->setArchive(1);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash('success','Utilisateur Bloqué');
        return $this->redirectToRoute('display_user');
    }
    /**
     * @Route("/inblocUser/{idUser}", name="inblocuser")
     */
    public function InBlocUser (Request $request,$idUser): Response{
        $user= $this->getDoctrine()->getManager()->getRepository(User::class)->find($idUser);
        $user->setArchive(0);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash('success','Utilisateur débloqué');
        return $this->redirectToRoute('display_user');
    }
}
