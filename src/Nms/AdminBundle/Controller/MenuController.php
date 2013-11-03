<?php

namespace Nms\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nms\AdminBundle\Entity\Menu;
use Nms\AdminBundle\Form\MenuType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Menu controller.
 *
 */
class MenuController extends Controller {

    /**
     * Lists all Menu entities.
     *
     */
    public function indexAction()
    {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $menus = $em->getRepository('NmsAdminBundle:Menu')
            ->filteredFind($this->get('request')->query->get('sort', 'm.id'),
                            $this->get('request')->query->get('direction', 'ASC'),
                            $this->get('request')->query->get('filterField', null),
                            $this->get('request')->query->get('filterValue', null)
        );

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $menus,
            $this->get('request')->query->get('page', 1)/* page number */,
            10/* limit per page */,
            array()
        );

        $fields = array('m.title' => 'Title',
            'm.url' => 'URL',
            );

        return $this->render('NmsAdminBundle:Menu:index.html.twig', array(
            'pagination' => $pagination,
            'fields' => $fields,
        ));
    }

    /**
     * Creates a new Menu entity.
     *
     */
    public function createAction(Request $request) {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $entity = new Menu();
        $form = $this->createForm(new MenuType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'Menu record saved!');

            return $this->redirect($this->generateUrl('menu_show', array('id' => $entity->getId())));
        }

        return $this->render('NmsAdminBundle:Menu:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Menu entity.
     *
     */
    public function newAction()
    {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $entity = new Menu();
        $form = $this->createForm(new MenuType(), $entity);

        return $this->render('NmsAdminBundle:Menu:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Menu entity.
     *
     */
    public function showAction($id)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NmsAdminBundle:Menu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Menu re cord.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NmsAdminBundle:Menu:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing Menu entity.
     *
     */
    public function editAction($id)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NmsAdminBundle:Menu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }

        $editForm = $this->createForm(new MenuType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NmsAdminBundle:Menu:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Menu entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NmsAdminBundle:Menu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new MenuType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'Menu record saved!');

            return $this->redirect($this->generateUrl('menu_edit', array('id' => $id)));
        }

        return $this->render('NmsAdminBundle:Menu:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Menu entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NmsAdminBundle:Menu')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Menu entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'Menu record deleted!');
        }

        return $this->redirect($this->generateUrl('menu'));
    }

    /**
     * Creates a form to delete a Menu entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

}
