<?php

namespace App\Controller;
use App\Entity\Restaurant;
use App\Form\RestaurantsType;
use App\Entity\Reservation;
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
class RestaurantsController extends AbstractController
{
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
    public function liste()
    {
       
        $Restaurant=$this->getDoctrine()->getRepository(Restaurant::class)->findAll();
        return $this->render("back/affichage_table_restaurant.html.twig",array("Restaurant"=>$Restaurant));
    }

     /**
     * @Route("/list_front", name="liste")
     */
    public function listfront(\Symfony\Component\HttpFoundation\Request $request,PaginatorInterface $paginator)
    {
        $Restaurant=$paginator->paginate(
        $Restaurant=$this->getDoctrine()->getRepository(Restaurant::class)->findAll(),
        $request->query->getInt('page',1),2);
        return $this->render("Restaurants/list.html.twig",array("Restaurant"=>$Restaurant));
    }
   
     

    /**
     * @Route("/detail/{idRestaurant}", name="list_detai")
     */
    public function show(Request $request,$idRestaurant)
    {
        $detaild=$this->getDoctrine()->getRepository(Restaurant::class)->find($idRestaurant);
      
         $data = array(    
         'detailE' => $detaild,
        );
        return $this->render('back/listdetail.html.twig', $data);
    }

      /**
     * @Route("/detail_resto/{idRestaurant}", name="list_detai_resto")
     */
    public function show1(\Symfony\Component\HttpFoundation\Request $request,$idRestaurant)
    {
        $detaild=$this->getDoctrine()->getRepository(Restaurant::class)->find($idRestaurant);
        $reservation=new Reservation();
        $reservation->setArchive(0);
        $reservation->setIdUser(1);
        $reservation->setImage('aaaaaaa');
       
       

        $form=$this->createForm(reservationType::class,$reservation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute("reservation_app");
        }
        
        return $this->render('back/list_reservation.html.twig',array('detailE' => $detaild,"forms"=>$form->createView()));
    }

    

     /**
     * @Route("/delete/{idRestaurant}", name="delete")
     */
    public function delete($idRestaurant)
    {
        $Restaurant=$this->getDoctrine()->getRepository(Restaurant::class)->find($idRestaurant);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Restaurant);
        $em->flush();
        return $this->redirectToRoute("liste1");
   }
     /**
     * @Route("/add", name="restaurant_app")
     */
   public function add(\Symfony\Component\HttpFoundation\Request $request)
    {
        $Restaurant=new Restaurant();

        $form=$this->createForm(RestaurantsType::class,$Restaurant);
        $form->handleRequest($request);
           

        if($form->isSubmitted()&& $form->isValid())
        {
           
    $sid    = "AC74900876b5c27e0c2c667afe542f6934"; 
$token  = "d44b6dbc8237514b3c000e08f3f805ff"; 
$twilio = new Client($sid, $token); 

$message = $twilio->messages 
          ->create("+21658658857", // to 
                   array(  
                       "messagingServiceSid" => "MG1af988a0efdfac8890ae76afd693760a",      
                       "body" => "votre réservation a été effectué avec succès" 
                   ) 
          ); 

print($message->sid); 
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
            $em=$this->getDoctrine()->getManager();
            $em->persist($Restaurant);
            $em->flush();
            $this->addFlash('success','Restaurant a ete ajouter');

            return $this->redirectToRoute("liste1");
        }
        return $this->render('back/resto.html.twig',array("forms"=>$form->createView()));
    }



    
     
     /**
     * @Route("/updateStudent/{idRestaurant}", name="update")
     */
    public function updateStudent(Request $request,$idRestaurant)
    {
        $Restaurant=$this->getDoctrine()->getRepository(Restaurant::class)->find($idRestaurant);
        $form=$this->createForm(RestaurantsType::class,$Restaurant);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $file = $form['image']->getData();
            $em=$this->getDoctrine()->getManager();
            $file->move("back/assets/img/users/",$file->getClientOriginalName());
            $Restaurant->setImage("back/assets/img/users/" . $file->getClientOriginalName());
            $em->persist($Restaurant);
            $em->flush();
            return $this->redirectToRoute("liste1");
        }
        return $this->render("back/resto.html.twig",array("forms"=>$form->createView()));
    }

     
        
    
}