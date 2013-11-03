<?php

namespace Nms\AdminBundle\Listener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Nms\AdminBundle\Entity\User;


/**
 * Custom login listener.
 */

class LoginListener {

    /** @var \Symfony\Component\Security\Core\SecurityContext */
    private $securityContext;

    /** @var \Doctrine\ORM\EntityManager */
    private $em;

    /**
     * Constructor
     *
     * @param SecurityContext   $securityContext
     * @param Service Container $container
     * @param Doctrine          $doctrine
     */
    public function __construct(SecurityContext $securityContext, \Symfony\Component\DependencyInjection\Container $container, Doctrine $doctrine) {
        $this->securityContext = $securityContext;
        $this->em = $doctrine->getManager();
        $this->container = $container;
    }

    /**
     * Do the magic.
     *
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event) {
        $logger = $this->container->get('logger');
        if ($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            // user has just logged in
//            $logger->info('user has just logged in');
        }

        if ($this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            // user has logged in using remember_me cookie
//            $logger->info('user has logged in using remember_me cookie');
        }

        // do some other magic here
        $user = $event->getAuthenticationToken()->getUser();
//        $logger->info('user='.print_r($user,true));

        $logins = $user->getLogins();
        $user->setLogins($logins+1);
        $this->em->persist($user);
        $this->em->flush();

//        $entity = $this->em->getRepository('NmsAdminBundle:User')->find($user->id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find User entity.');
//        }

    }

}