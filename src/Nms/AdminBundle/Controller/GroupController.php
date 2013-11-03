<?php

namespace Nms\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nms\AdminBundle\Entity\Group;
use Nms\AdminBundle\Form\GroupType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Group controller.
 *
 */
class GroupController extends Controller {

    /**
     * Lists all Group entities.
     *
     */
    public function indexAction() {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $groups = $em->getRepository('NmsAdminBundle:Group')
                ->filteredFind($this->get('request')->query->get('sort', 'g.id'),
                        $this->get('request')->query->get('direction', 'ASC'),
                        $this->get('request')->query->get('filterField', null),
                        $this->get('request')->query->get('filterValue', null)
                    );

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $groups,
            $this->get('request')->query->get('page', 1)/* page number */,
            10/* limit per page */,
            array()
        );

        $fields = array('g.name' => 'Name', 'g.role' => 'Role');

        return $this->render('NmsAdminBundle:Group:index.html.twig', array(
                'pagination' => $pagination,
                'fields' => $fields,
        ));
    }

    /**
     * Creates a new Group entity.
     *
     */
    public function createAction(Request $request) {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $entity = new Group();
        $form = $this->createForm(new GroupType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Group record added!');

            return $this->redirect($this->generateUrl('group_show', array('id' => $entity->getId())));
        }

        return $this->render('NmsAdminBundle:Group:new.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Group entity.
     *
     */
    public function newAction() {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $entity = new Group();
        $form = $this->createForm(new GroupType(), $entity);

        return $this->render('NmsAdminBundle:Group:new.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Group entity.
     *
     */
    public function showAction($id) {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NmsAdminBundle:Group')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Group entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NmsAdminBundle:Group:show.html.twig', array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Group entity.
     *
     */
    public function editAction($id) {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NmsAdminBundle:Group')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Group entity.');
        }

        $editForm = $this->createForm(new GroupType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NmsAdminBundle:Group:edit.html.twig', array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Group entity.
     *
     */
    public function updateAction(Request $request, $id) {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NmsAdminBundle:Group')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Group entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new GroupType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Group record updated!');

            return $this->redirect($this->generateUrl('group_edit', array('id' => $id)));
        }

        return $this->render('NmsAdminBundle:Group:edit.html.twig', array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Group entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NmsAdminBundle:Group')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Group record.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Group record deleted!');

        } else {
            $this->get('session')->getFlashBag()->set('error', 'Group record was not deleted!');
        }

        return $this->redirect($this->generateUrl('group_list'));
    }

    /**
     * Creates a form to delete a Group entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                ->add('id', 'hidden')
                ->getForm()
        ;
    }
}
