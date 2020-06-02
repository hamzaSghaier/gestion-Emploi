<?php

namespace App\Subscribers;

use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\DetailsEmploi;
use App\Entity\Disponibile;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DisponibileRepository;
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
  

    public function __construct(UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $entityManager ,DisponibileRepository $Repository , RouterInterface $router )     {
         $this->passwordEncoder = $passwordEncoder;
         $this->emp = $Repository;
         $this->entitym = $entityManager;
         $this->route = $router;
        }


    public static function getSubscribedEvents()
    {
        return [
            EasyAdminEvents::PRE_PERSIST => ['preUpdate'],
            EasyAdminEvents::PRE_UPDATE => ['preUpdate'],
            EasyAdminEvents::POST_UPDATE => ['POSTUpdate'],
            EasyAdminEvents::POST_PERSIST => ['postpersist']
        ];
    }


    public function preUpdate(GenericEvent $event)
    {

       if (method_exists($event->getSubject(), 'setPassword')) {

         $event->getSubject()->setPassword($this->passwordEncoder->encodePassword($event->getSubject(),$event->getSubject()->getPassword()));
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