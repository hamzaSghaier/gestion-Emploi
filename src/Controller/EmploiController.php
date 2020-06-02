<?php

namespace App\Controller;

use App\Entity\Affecter;
use App\Entity\Emploi;
use App\Entity\Matiere;
use App\Entity\DetailsEmploi;
use App\Form\MatiereType;
use App\Form\EmploiType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilderInterface;


class EmploiController extends AbstractController
{

    /**
     * @Route("/emploi", name="emploi" , methods={"GET","HEAD"})
     */
    public function emploi()
     {
        $emp = $this->getDoctrine()->getRepository(Emploi::class);
        $results = $emp->findBy(array(),array('id'=>'DESC'),1,0);
        $unemp = $results[0] ;
    
    $DetailsEmploi = new DetailsEmploi() ;
    $DetailsEmploi->setEmlpoi($unemp);
    $mat = new Matiere();    
         return $this->render('emploi/index.html.twig', [
            'emploi'=>$unemp
            ,'dtemploi'=>$DetailsEmploi,
         ]);
    }
 /**
     * @Route("/emploi/{id}", name="Modiferemploi" , methods={"GET","HEAD"})
     */
    public function Modiferemploi(int $id)
     {
        $emp = $this->getDoctrine()->getRepository(Emploi::class);
        $results = $emp->find($id);
        $unemp = $results;
    
    $DetailsEmploi = new DetailsEmploi() ;
    $DetailsEmploi->setEmlpoi($unemp);
    $mat = new Matiere();    
         return $this->render('emploi/index.html.twig', [
            'emploi'=>$unemp
            ,'dtemploi'=>$DetailsEmploi,
         ]);
    }
    public function index()
{
    return $this->redirect('emploi');
}


    /**
     * @Route("/emplois", name="emplois" , methods={"GET","HEAD"})
     */
    public function Listemploi()
     {
        $emp = $this->getDoctrine()->getRepository(Emploi::class);
        $results = $emp->findAll();
        
    
  
         return $this->render('emploi/list.html.twig', [
            'emplois'=>$results
         ]);
    }




}
