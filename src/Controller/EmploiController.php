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
use Dompdf\Dompdf;
use Dompdf\Options;


class EmploiController extends AbstractController
{


   

//  /**
//      * @Route("/emploi/{id}", name="Modiferemploi" , methods={"GET","HEAD"})
//      */
//     public function Modiferemploi(int $id)
//      {
//         $emp = $this->getDoctrine()->getRepository(Emploi::class);
//         $results = $emp->find($id);
//         $unemp = $results;
//     $DetailsEmploi = new DetailsEmploi() ;
//     $DetailsEmploi->setEmlpoi($unemp);
//     $mat = new Matiere();    
//          return $this->render('emploi/index.html.twig', [
//             'emploi'=>$unemp
//             ,'dtemploi'=>$DetailsEmploi,
//          ]);
    
    
    
    
    
    
    
    
    
    
     // }










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


   
 /**
     * @Route("/emploi/{id}", name="Modiferemploi" , methods={"GET","HEAD"})
     */
    public function Modiferemploi(int $id)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
 
        $emp = $this->getDoctrine()->getRepository(Emploi::class);
        $results = $emp->findBy(array(),array('id'=>'DESC'),1,0);
        $unemp = $results[0] ;
    
    $DetailsEmploi = new DetailsEmploi() ;
    $DetailsEmploi->setEmlpoi($unemp);
    $mat = new Matiere();   
 
 
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('emploi/pdf.html.twig', [
          'emploi'=>$unemp
          ,'dtemploi'=>$DetailsEmploi,
       ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
 
        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
 


}
