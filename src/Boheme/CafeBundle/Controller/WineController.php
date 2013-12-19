<?php

namespace Boheme\CafeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boheme\CafeBundle\Entity\Wine;
use Boheme\CafeBundle\Form\WineType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Wine controller.
 *
 */
class WineController extends Controller
{

    /**
     * Lists all Wine entities.
     *
     */
    public function indexAction()
    {
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $wines = $em->getRepository('BohemeCafeBundle:Wine')
                ->filteredFind(
                $this->get('request')->query->get('sort', 'w.id'),
                $this->get('request')->query->get('direction', 'ASC'),
                $this->get('request')->query->get('filterField', null),
                $this->get('request')->query->get('filterValue', null)
        );

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $wines, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */, array()
        );

        $fields = array(
            'w.title' => 'Title',
            'w.note' => 'Notes',
        );

        return $this->render('BohemeCafeBundle:Wine:index.html.twig', array(
            'pagination' => $pagination,
            'fields' => $fields,
        ));

    }
    /**
     * Creates a new Wine entity.
     *
     */
    public function createAction(Request $request)
    {
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw new AccessDeniedException();
        }

        $entity = new Wine();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'Wine record saved!');
            return $this->redirect($this->generateUrl('wine_show', array('id' => $entity->getId())));
        }

        return $this->render('BohemeCafeBundle:Wine:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Wine entity.
    *
    * @param Wine $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Wine $entity)
    {
        $form = $this->createForm(new WineType(), $entity, array(
            'action' => $this->generateUrl('wine_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Wine entity.
     *
     */
    public function newAction()
    {
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw new AccessDeniedException();
        }

        $entity = new Wine();
        $form   = $this->createCreateForm($entity);

        return $this->render('BohemeCafeBundle:Wine:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Wine entity.
     *
     */
    public function showAction($id)
    {
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BohemeCafeBundle:Wine')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Wine entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BohemeCafeBundle:Wine:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing Wine entity.
     *
     */
    public function editAction($id)
    {
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BohemeCafeBundle:Wine')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Wine entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BohemeCafeBundle:Wine:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Wine entity.
    *
    * @param Wine $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Wine $entity)
    {
        $form = $this->createForm(new WineType(), $entity, array(
            'action' => $this->generateUrl('wine_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Wine entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BohemeCafeBundle:Wine')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Wine entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Wine record updated!');

            return $this->redirect($this->generateUrl('wine_edit', array('id' => $id)));
        }

        return $this->render('BohemeCafeBundle:Wine:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Wine entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BohemeCafeBundle:Wine')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Wine entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Wine record deleted!');
        }

        return $this->redirect($this->generateUrl('wine'));
    }

    /**
     * Creates a form to delete a Wine entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('wine_delete', array('id' => $id)))
            ->setMethod('DELETE')
//            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
