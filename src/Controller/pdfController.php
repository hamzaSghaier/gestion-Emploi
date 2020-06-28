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
use WhiteOctober\TCPDFBundle\WhiteOctoberTCPDFBundle;


class pdfController extends AbstractController
{
    /**
     *@Route("/pdf/{id}", name="Pdf" , methods={"GET","HEAD"})
     */
 

    public function Pdf(int $id)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
   
       
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
        $dompdf->stream('invoice.pdf',array('Attachment'=>0));
    }
 /**
     * This is a regular Controller action.
     * 
     * @Route("/pdff/{id}" ,name="PDFF")
     */
    public function pdfAction(int $id)
    {
        // use $pdf like example below
      
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
     
       $this->returnPDFResponseFromHTML($html);
        
     
    }
    public function returnPDFResponseFromHTML($html){
        //set_time_limit(30); uncomment this line according to your needs
        // If you are not in a controller, retrieve of some way the service container and then retrieve it
        //$pdf = $this->container->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //if you are in a controlller use :
        $pdf = $this->get("white_october.tcpdf")->create();
        $pdf->SetAuthor('Our Code World');
        $pdf->SetTitle(('Our Code World Title'));
        $pdf->SetSubject('Our Code World Subject');
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        //$pdf->SetMargins(20,20,40, true);
        $pdf->AddPage();
        
        $filename = 'ourcodeworld_pdf_demo';
        
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($filename.".pdf",'I'); // This will output the PDF as a response directly
}
    }