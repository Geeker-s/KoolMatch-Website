<?php

namespace App\Controller;
use App\Entity\Gerant;
use App\Entity\Recherche;
use App\Repository\GerantRepository;
use App\Form\GerantType;
use App\Form\ConnexionGerantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;




class GerantController extends AbstractController
{
    /**
     * @Route("/gerant", name="display_gerant" , methods={"GET","POST"} )
     */
    public function index(PaginatorInterface $paginator,Request $request, GerantRepository $gerantRepository): Response
    {
        $allgerants= $this->getDoctrine()->getManager()->getRepository(Gerant::class)->findAll();
        $gerant= new Recherche();
        $searchform = $this->createFormBuilder($gerant)
            ->add('nomGerant',TextType::class,array('attr'=>array('class'=>'form-control')))
            ->getForm();

        $searchform->handleRequest($request);
        if($searchform->isSubmitted() && $searchform->isValid()){
            $term = $gerant->getNomGerant();
            $allgerants = $gerantRepository->search($term);
        }
        else{
            $allgerants = $gerantRepository->findAll();
        }
        $gerant = $paginator->paginate(
        // Doctrine Query, not results
            $allgerants,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );
        return $this->render('gerant/index.html.twig', [
            'searchform' => $searchform->createView(),
            'gr'=>$gerant
             ]);
    }
    /**
     * @Route("/loginGerant", name="gerant_login")
     */
    public function loginGerant(Request $request): Response
    {
        $gerant= new Gerant();
        $form = $this ->createForm(ConnexionGerantType::class,$gerant);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $username = $form["emailGerant"]->getData();
            $password = $form["passwordGerant"]->getData();
            $test=$this->getDoctrine()->getRepository(Gerant::class)->findBy(array('emailGerant' =>$username,'passwordGerant' =>$password));
            if ($test){
                return $this->redirectToRoute('app_back');

            }
        }
        return $this->render('gerant/loginGerant.html.twig',['g'=>$form->createView()]);
    }
    /**
     * @Route("/addgerant", name="addgerant")
     */
    public function addgerant(Request $request): Response
    {
        $gerant= new Gerant();
        $form = $this ->createForm(GerantType::class,$gerant);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($gerant);
            $em->flush();
            return $this->redirectToRoute('display_gerant');
        }
        return $this->render('gerant/creatGerant.html.twig',['ger'=>$form->createView()]);
    }
    /**
     * @Route("/removegerant/{idGerant}", name="suprimer_gerant")
     */
    public function supprimergerant(Gerant $gerant): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($gerant);
        $em->flush();
        return $this->redirectToRoute('display_gerant');
    }
    /**
     * @Route("/modifgerant/{idGerant}", name="modifgerant")
     */
    public function modifiergerant(Request $request,$idGerant): Response
    {
        $gerant= $this->getDoctrine()->getManager()->getRepository(Gerant::class)->find($idGerant);
        $form = $this ->createForm(GerantType::class,$gerant);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('display_gerant');
        }
        return $this->render('gerant/updateGerant.html.twig',['ger'=>$form->createView()]);
    }
}
