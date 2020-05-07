<?php

namespace App\Subscribers;

use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class WhateverSubscriber implements EventSubscriberInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)     {
         $this->passwordEncoder = $passwordEncoder;
     }


    public static function getSubscribedEvents()
    {
        return [
            EasyAdminEvents::PRE_PERSIST => ['preUpdate'],
            EasyAdminEvents::PRE_UPDATE => ['preUpdate']
        ];
    }


    public function preUpdate(GenericEvent $event)
    {

       if (method_exists($event->getSubject(), 'setPassword')) {



         $event->getSubject()->setPassword($this->passwordEncoder->encodePassword($event->getSubject(),$event->getSubject()->getPassword()));
        }
    }
}