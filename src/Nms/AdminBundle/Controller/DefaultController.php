<?php

namespace Nms\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller {

    public function indexAction($name = 'Paul') {
//        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
//            throw new AccessDeniedException();
//        }

        return $this->render('NmsAdminBundle:Default:index.html.twig', array('name' => $name));
    }

    public function aboutAction($name = 'Paul') {
//        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
//            throw new AccessDeniedException();
//        }

        return $this->render('NmsAdminBundle:Default:index.html.twig', array('name' => $name));
    }

}
