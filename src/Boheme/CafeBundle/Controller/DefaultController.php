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

    public function foodAction()
    {
        $em = $this->getDoctrine()->getManager();

        $meals = $em->getRepository('BohemeCafeBundle:Meal')->menu();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $meals, $this->get('request')->query->get('page', 1)/* page number */, 20/* limit per page */, array()
        );

        return $this->render('BohemeCafeBundle:Default:food.html.twig',
                array(
                    'pagination' => $pagination,
        ));

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
