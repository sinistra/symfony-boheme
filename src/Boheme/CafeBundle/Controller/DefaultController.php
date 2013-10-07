<?php

namespace Boheme\CafeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $name = '
            Darren';
        return $this->render('BohemeCafeBundle:Default:index.html.twig',
                array('name' => $name));
    }
}
