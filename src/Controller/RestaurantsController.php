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
    public function liste(Request $request)
    {
        $Restaurant=$this->getDoctrine()->getRepository(Restaurant::class)->orderByNb();
        $em=$this->getDoctrine()->getManager();
        return $this->render("back/affichage_table_restaurant.html.twig",array("Restaurant"=>$Restaurant));
    }
    
     /**
     * @Route("/list_front", name="liste")
     */
    public function listfront(\Symfony\Component\HttpFoundation\Request $request,PaginatorInterface $paginator)
    {
        $Restaurant=$paginator->paginate(
        $Restaurant=$this->getDoctrine()->getRepository(Restaurant::class)->findAll(),
        $request->query->getInt('page',1),3);
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
        return $this->render('back/list_reservation.html.twig', $data);
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
        $reservation->setnomResto($detaild->getNomRestaurant());
        $reservation->setadresse('aaaaaaa');

        $form=$this->createForm(reservationType::class,$reservation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $sid    = "AC2948f9de09ac7c277c45360f325056f8"; 
            $token  = "81bf370433d6915626b0b7dcb3db7b31"; 
            $twilio = new Client($sid, $token); 
             
            $message = $twilio->messages 
                              ->create("+21698486031", // to 
                                       array(  
                                           "messagingServiceSid" => "MGaa2b84aa2f0e81be7e1476fe43390036",      
                                           "body" => " votre réservation a bien été prise en compte" 
                                       ) 
                              ); 
             
            print($message->sid);
            $em=$this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            
            return $this->redirectToRoute("listereservation");
        }
        
        return $this->render('back/listdetail.html.twig',array('detailE' => $detaild,"forms"=>$form->createView()));
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



    public function translateajaxAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $em = $this->getDoctrine()->getManager();
            $idRestaurant=$request->get('idRestaurant');
            $rows = $em->getRepository(Restaurant::class)->findBy(array('id'=>$idRestaurant));
            $tabEnsembles = array();
            $i = 0;
            foreach($rows as $ensemble) {
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
    return new Response("Erreur: Ce n'est pas une requete ajax",400);
}       
public function rechercheAjaxAction(Request $request)
{
  
    $em=$this->getDoctrine()->getManager();

    if ($request->isXmlHttpRequest()) {
        $search  = $request->get('search');
        dump($search);
        $event = new Evenement();
        $repo  = $em->getRepository(Restaurant::class);
        $event = $repo->findAjax($search);
        return $this->render('back/affichage_table_restaurant.html.twig',array('events' => $event));
    }


}



}