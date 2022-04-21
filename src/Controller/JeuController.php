<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Entity\Quiz;
use App\Form\JeuType;
use App\Repository\JeuRepository;
use App\Repository\QuizRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use phpDocumentor\Reflection\Types\Null_;
use PHPUnit\Framework\Constraint\IsNull;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JeuController extends AbstractController
{
    /**
     * @Route("/jeu", name="app_jeu")
     */
    public function index(): Response
    {
        return $this->render('jeu/index.html.twig', [
            'controller_name' => 'JeuController',
        ]);
    }

    /**
     * @return Response
     *  @Route("/Affichejeu",name="Affichejeu")
     */
     public function Afficher(JeuRepository $jeuRepository){
         {$repository = $this->getDoctrine()->getRepository(Jeu::class);
             $jeux = $repository->findBy(["archive" =>0]);
             $r1=0;
             $r2=0;
             $r3=0;
             foreach ($jeux as $jeu)
             {
                 if ( $jeu->getScoreJeu() <50)  :

                     $r1+=1;
                 elseif ( $jeu->getScoreJeu() >50 && $jeu->getScoreJeu() <100) :
                     $r2+=1;
                 else:

                     $r3+=1;


                 endif;

             }

             $pieChart = new PieChart();
             $pieChart->getData()->setArrayToDataTable(
                 [['Niveau', 'nombre'],
                     ['debutant', $r1],
                     ['Moyen', $r2],
                     ['Pro', $r3],
                 ]
             );
             $pieChart->getOptions()->setHeight(500);
             $pieChart->getOptions()->setWidth(900);
             $pieChart->getOptions()->setBackgroundColor('#191c24');
             $pieChart->getOptions()->getLegend()->getTextStyle()->setColor('#FFFFFF');
             $pieChart->getOptions()->getLegend()->setPosition('bottom');




             return $this->render('jeu/Affichej.html.twig',[
                 "jeu"=>  $jeuRepository->orderBys(),'piechart' => $pieChart
             ]);
         }
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/Supp/{id}",name="s")
     */
    public function Supprimer($id){
        $repo=$this->getDoctrine()->getRepository(Jeu::class);
        $jeu=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($jeu);
        $em->flush();
        return $this->redirectToRoute('Affichejeu');


    }

    /**
     *
     * @return Response
     * @Route ("/aa/{id}",name="b")
     */
    public function getq(QuizRepository  $repository,$id)
    {
        $repo = $this->getDoctrine()->getRepository(Quiz::class);
        $jeu = $repo->findOneBy(['idRecette' => $id]);
        return $this->render("jeu/participer.html.twig", array("jeu" => $jeu));
    }

    /**
     * @param QuizRepository $repository
     * @param Request $request
     * @return Response
     * @Route ("/va/{id}",name="va")
     */
    public function Calcule($id,JeuRepository $repo){
        $jeu = new Jeu();
        $repo = $this->getDoctrine()->getRepository(Jeu::class);
         $jeu=$repo->findOneBy(['idUser' => 4]); /*Current user*/

         if(empty($jeu))
         {   $jeu1 = new Jeu();
             $jeu1->setScoreJeu($id);
             $jeu1->setIdUser(4);
             $em = $this->getDoctrine()->getManager();
             $em->persist($jeu1);
             $em->flush();
             return $this->redirectToRoute("FafficherR");
         }
         else {
               $score= $jeu->getScoreJeu()+ $id;
             $jeu->setScoreJeu($score);
             $em = $this->getDoctrine()->getManager();
             $em->flush();
         }
        return $this->redirectToRoute("FafficherR");


    }
}
