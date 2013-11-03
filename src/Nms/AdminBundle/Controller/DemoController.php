<?php

//// file: src/Nms/AdminBundle/Controller/DemoController.php
// include this code portion

namespace Nms\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nms\AdminBundle\Entity\BlogPost;

/**
 * Group controller.
 *
 */
class DemoController extends Controller {

    /**
     * Route("/posts", name="_demo_posts")
     */
    public function postsAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('NmsAdminBundle:BlogPost');
// create some posts in case if there aren't any
        if (!$repository->findOneById('hello_world')) {
            $post = new \Nms\AdminBundle\Entity\BlogPost();
            $post->setTitle('Hello world');

            $next = new \Nms\AdminBundle\Entity\BlogPost();
            $next->setTitle('Doctrine extensions');

            $em->persist($post);
            $em->persist($next);
            $em->flush();
        }
        $posts = $em
            ->createQuery('SELECT p FROM NmsAdminBundle:BlogPost p')
            ->getArrayResult()
        ;
        die(var_dump($posts));
    }

    public function updateAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('NmsAdminBundle:BlogPost');
// create some posts in case if there aren't any
        if ($post = $repository->findOneById('hello_world')) {
            $update_text = 'Hello world update - ' . date('Y-m-d');
            $post->setTitle($update_text);
        }

        if ($next = $repository->findOneById('doctrine_extensions')) {
            $next->setTitle('More doctrine extensions');
        }

        $em->persist($post);
        $em->persist($next);
        $em->flush();
        $posts = $em
            ->createQuery('SELECT p FROM NmsAdminBundle:BlogPost p')
            ->getArrayResult()
        ;
        die(var_dump($posts));
    }

}