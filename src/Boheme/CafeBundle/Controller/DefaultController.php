<?php

namespace Boheme\CafeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $name = 'Darren';
        return $this->render('BohemeCafeBundle:Default:index.html.twig',
                array('name' => $name));
    }

    public function mealAction()
    {
        $name = 'Darren';
        return $this->render('BohemeCafeBundle:Default:meal.html.twig',
                array('name' => $name));
    }

    public function wineAction()
    {
        $name = 'Darren';
        return $this->render('BohemeCafeBundle:Default:wine.html.twig',
                array('name' => $name));
    }

    public function contactAction()
    {
        $name = 'Darren';
        return $this->render('BohemeCafeBundle:Default:contact.html.twig',
                array('name' => $name));
    }
}
