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


class pdfController extends AbstractController
{
    /**
     *@Route("/pdf/{id}", name="Pdf" , methods={"GET","HEAD"})
     */
 

    public function Pdf(int $id)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
 
        $emp = $this->getDoctrine()->getRepository(Emploi::class);
        $results = $emp->find($id);
        $unemp = $results ;
    
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