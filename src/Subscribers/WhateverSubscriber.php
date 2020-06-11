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
   private   $empMa;
   private   $empPROF;
  

    public function __construct(UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $entityManager ,DisponibileRepository $Repository ,DetailsEmploiRepository $RepositoryMa,AffecterRepository $Repositoryprof, RouterInterface $router )     {
         $this->passwordEncoder = $passwordEncoder;
         $this->emp = $Repository;
         $this->entitym = $entityManager;
         $this->route = $router;
         $this->empMa = $RepositoryMa;
         $this->empPROF = $Repositoryprof;
        }


    public static function getSubscribedEvents()
    {
        return [
            EasyAdminEvents::PRE_PERSIST => ['preUpdate'],
            EasyAdminEvents::PRE_UPDATE => ['preUpdate'],
            EasyAdminEvents::POST_UPDATE => ['POSTUpdate'],
            EasyAdminEvents::POST_PERSIST => ['postpersist'],
           

            

        ];
    }


    // public function preDelete(GenericEvent $event)
    // {
    //     $entity = $event->getSubject();

    //     if (($entity instanceof App\Entity\Matiere )) {
    //         var_dump($entity); die();
    //     }

    //    var_dump("hhhh"); die();
    // }

    public function preUpdate(GenericEvent $event)
    {

       if (method_exists($event->getSubject(), 'setPassword')) {

         $event->getSubject()->setPassword($this->passwordEncoder->encodePassword($event->getSubject(),$event->getSubject()->getPassword()));
        }

        if (method_exists($event->getSubject(), 'setMatiere')) {
           if ( $event->getSubject()->getMatiere() != null) {
               # code...
           
            $mat =  $event->getSubject()->getMatiere()->getNhTotal();
            $ListMTaDet= $this->empMa->findAll();
            $ListempPROF= $this->empPROF->findAll();
            $max=0; 
            foreach ($ListempPROF as $variable) {
               if( $event->getSubject()->getMatiere() == $variable->getMatiere())
               {
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
                 
            if($max<=$mat){
            $event->getSubject()->setNbHeureR($max+1.5);
               // 
               $this->entitym->persist($event->getSubject());
               // actually executes the queries (i.e. the INSERT query)
                     $this->entitym->flush();
            }else{
                $event->getSubject()->setMatiere(null);
                $this->entitym->persist($event->getSubject());
                 $this->entitym->flush();

            }
          //  $this->addFlash('error', 'You cannot delete admin users.');
          
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

          $id=  $event->getSubject()->getId();
          $DispoSenceJour= $this->emp->findAll();
       foreach ($DispoSenceJour as $variable) {
      
           
            $DetailsEmploi = new DetailsEmploi() ;
            $DetailsEmploi->setEmlpoi($event->getSubject());
            $DetailsEmploi->setSeance($variable);
            
            $this->entitym->persist($DetailsEmploi);
        // actually executes the queries (i.e. the INSERT query)
              $this->entitym->flush();
              
          }

    }
    
}}