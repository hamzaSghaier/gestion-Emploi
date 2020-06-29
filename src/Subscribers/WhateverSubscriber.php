<?php

namespace App\Subscribers;

use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Matiere;
use App\Entity\DetailsEmploi;


use App\Entity\Disponibile;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DisponibileRepository;
use App\Repository\AffecterRepository;
use App\Repository\EmploiRepository;
use App\Repository\MatiereRepository;
use App\Repository\EnseignantRepository;


use App\Repository\DetailsEmploiRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use App\Controller\EmploiController;



class WhateverSubscriber implements EventSubscriberInterface
{
    private $passwordEncoder;
    private   $emp;
   private $entitym;
   private $route;
   private   $empDetailsEmploi;
   private   $empPROF;
   private   $listeMatiereSelect;
   private   $emprof;
  

    public function __construct(UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $entityManager ,DisponibileRepository $Repository ,DetailsEmploiRepository $RepositoryDetailsEmploi,AffecterRepository $Repositoryprof, RouterInterface $router,  MatiereRepository $RepositoryMatiere,EnseignantRepository $emProfRepo)     {
         $this->passwordEncoder = $passwordEncoder;
         $this->emp = $Repository;
         $this->entitym = $entityManager;
         $this->route = $router;
         $this->empDetailsEmploi = $RepositoryDetailsEmploi;
         $this->empPROF = $Repositoryprof;
         $this->listeMatiereSelect = $RepositoryMatiere;
         $this->emprof = $emProfRepo;

        }


    public static function getSubscribedEvents()
    {
        return [
            EasyAdminEvents::PRE_PERSIST => ['preUpdate'],
            EasyAdminEvents::PRE_UPDATE => ['preUpdate'],
            EasyAdminEvents::POST_UPDATE => ['POSTUpdate'],
            EasyAdminEvents::PRE_EDIT => ['PREEdit'],
            EasyAdminEvents::POST_PERSIST => ['postpersist'],
           

            

        ];
    }


    public function PREEdit(GenericEvent $event)
    {
        $entity = $event->getSubject();
if($entity['name']=="DetailsEmploi")
{
    
    
    
    // dump($entity); die();

}



    
       
    }

    public function preUpdate(GenericEvent $event)
    {

       if (method_exists($event->getSubject(), 'setPassword')) {

         $event->getSubject()->setPassword($this->passwordEncoder->encodePassword($event->getSubject(),$event->getSubject()->getPassword()));
        }

        if (method_exists($event->getSubject(), 'setAutre')) {
           
           if ( $event->getSubject()->getMatiere() != null) {
               # code...
           
            $mat =  $event->getSubject()->getMatiere()->getNhTotal();
            $ListMTaDet= $this->empDetailsEmploi->findAll();
            $ListempPROF= $this->empPROF->findAll();
            $ListDiponible= $this->emp->findAll();
            $max=0; 
            foreach ($ListempPROF as $variable) {
               if( $event->getSubject()->getMatiere() == $variable->getMatiere())
               {
                   //dump( $this->emprof->find($variable->getEnseignant()->getId())->getDisponibiles());die;
                  // if($event->getSubject()->getEnseignant()->getDisponibiles())
                $event->getSubject()->setEnseignant($variable->getEnseignant());
               }
            }
            
            foreach ($ListMTaDet as $variable) {
                if(($event->getSubject()->getMatiere() == $variable->getMatiere()) &&($event->getSubject()->getEmlpoi() == $variable->getEmlpoi()))
                {
                    if($variable->getNbHeureR()>$max)
                    {
                        $max=$variable->getNbHeureR();
                    }

                }

                }
               $b = false;
                foreach ($ListDiponible as $var) {
                    if($var ==$event->getSubject()->getSeance() ){

                    foreach($var->getEnseignants()->getValues() as $vart) {
                       
                        if($vart->getNomEnseignant() ==$event->getSubject()->getEnseignant()->getNomEnseignant() )
                        {  
                            
                                  $b=true;
            
                        }
                    }
                  
            }
        }

if($b){
       
                if($max+1.5<=$mat)  {

                    $event->getSubject()->setNbHeureR($max+1.5);
                    
                      
                       $this->entitym->persist($event->getSubject());
                       // actually executes the queries (i.e. the INSERT query)
                             $this->entitym->flush();
                    }else{
                        $event->getSubject()->setMatiere(null);
                        $event->getSubject()->setAlert(" nombre d'heures terminer");
                        $this->entitym->persist($event->getSubject());
                         $this->entitym->flush();
        
                    }
                }
                else{
                  
                    $event->getSubject()->setMatiere(null);
                        $event->getSubject()->setAlert("Enseignant non disponible");
                        $this->entitym->persist($event->getSubject());
                         $this->entitym->flush(); 
                }
         
          
        }
               

           }
    }

    public function POSTUpdate(GenericEvent $event)
    {

       if (method_exists($event->getSubject(), 'setMatiere')) {
      
        $emploiController = new EmploiController();
      
$emploiController-> index();
           
    }
    }



    public function postpersist(GenericEvent $event)
    { 
        if (method_exists($event->getSubject(), 'setDateDebut')) {


      
           $dB= $event->getSubject()->getDateDebut();
           $result = $dB->format('Y-m-d');

            $d1=date('Y-m-d', strtotime($result. ' + 7 days'));
            $date = \DateTime::createFromFormat('Y-m-d', $d1);
            $event->getSubject()->setDateFin($date);

            



          $id=  $event->getSubject()->getId();
          $DispoSenceJour= $this->emp->findAll();
        //  $listeMatieres = $this->listeMatiereSelect->findAll();







       foreach ($DispoSenceJour as $variable) {
      





            $DetailsEmploi = new DetailsEmploi() ;
            $DetailsEmploi->setEmlpoi($event->getSubject());
            $DetailsEmploi->setSeance($variable);
            $araayy= [] ;
            // foreach ($listeMatieres as $var) {
      

            //   array_push($araayy, $var->getNomMatiere());
            //    // $araayy[$var->getNomMatiere()]= $var->getNomMatiere() ; 
    
            // }
            //   $DetailsEmploi->setMatieres($araayy);
            
            $this->entitym->persist($DetailsEmploi);
        // actually executes the queries (i.e. the INSERT query)
              $this->entitym->flush();
              
          }

    }
    
}}