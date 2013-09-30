<?php

namespace Nms\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nms\AdminBundle\Entity\Notice;
use Nms\AdminBundle\Form\NoticeType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Notice controller.
 *
 */
class NoticeController extends Controller {

    /**
     * Lists all Notice entities.
     *
     */
    public function indexAction()
    {
        if (false === $this->get('security.context')->isGranted('ROLE_COMP')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $notices = $em->getRepository('NmsAdminBundle:Notice')
            ->filteredFind($this->get('request')->query->get('sort', 'n.id'),
                $this->get('request')->query->get('direction', 'ASC'),
                $this->get('request')->query->get('filterField', null),
                $this->get('request')->query->get('filterValue', null)
        );

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $notices,
            $this->get('request')->query->get('page', 1)/* page number */,
            10/* limit per page */,
            array()
        );

        $fields = array('n.title' => 'Title', 'n.publish' => 'Publish date');

        return $this->render('NmsAdminBundle:Notice:index.html.twig', array(
            'pagination' => $pagination,
            'fields' => $fields,
        ));
    }

    /**
     * Creates a new Notice entity.
     *
     */
    public function createAction(Request $request)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_COMP')) {
            throw new AccessDeniedException();
        }

        $entity = new Notice();
        $form = $this->createForm(new NoticeType(), $entity);

        $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                $this->get('session')->getFlashBag()->set('success', 'Notice record saved!');

                return $this->redirect($this->generateUrl('notice_show', array('id' => $entity->getId())));
            }

        return $this->render('NmsAdminBundle:Notice:new.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Notice entity.
     *
     */
    public function newAction()
    {
        if (false === $this->get('security.context')->isGranted('ROLE_COMP')) {
            throw new AccessDeniedException();
        }

        $entity = new Notice();
        $form = $this->createForm(new NoticeType(), $entity);

        return $this->render('NmsAdminBundle:Notice:new.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Notice entity.
     *
     */
    public function showAction($id)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_COMP')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NmsAdminBundle:Notice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notice entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NmsAdminBundle:Notice:show.html.twig', array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Notice entity.
     *
     */
    public function editAction($id)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_COMP')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NmsAdminBundle:Notice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notice entity.');
        }

        $editForm = $this->createForm(new NoticeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NmsAdminBundle:Notice:edit.html.twig', array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Notice entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_COMP')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NmsAdminBundle:Notice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notice entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new NoticeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'Notice record updated!');

            return $this->redirect($this->generateUrl('notice_edit', array('id' => $id)));
        }

        return $this->render('NmsAdminBundle:Notice:edit.html.twig', array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Notice entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_COMP')) {
            throw new AccessDeniedException();
        }

        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NmsAdminBundle:Notice')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Notice entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->set('warning', 'Notice record deleted!');

        }

        return $this->redirect($this->generateUrl('notice'));
    }

    /**
     * Creates a form to delete a Notice entity by id.
     * @param mixed $id The entity id
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
                ->add('id', 'hidden')
                ->getForm()
        ;
    }


    /**
     * Lists all display Notice entities.
     *
     */
    public function publishedAction()
    {
        $em = $this->getDoctrine()->getManager();

        $notices = $em->getRepository('NmsAdminBundle:Notice')
            ->published();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $notices,
            $this->get('request')->query->get('page', 1)/* page number */,
            10/* limit per page */,
            array()
        );


        return $this->render('NmsAdminBundle:Notice:publish.html.twig', array(
                'pagination' => $pagination,
        ));
    }

}
