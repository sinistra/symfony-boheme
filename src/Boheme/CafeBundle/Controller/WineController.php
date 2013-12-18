<?php

namespace Boheme\CafeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boheme\CafeBundle\Entity\Wine;
use Boheme\CafeBundle\Form\WineType;

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
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BohemeCafeBundle:Wine')->findAll();

        return $this->render('BohemeCafeBundle:Wine:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Wine entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Wine();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

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

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Wine entity.
     *
     */
    public function newAction()
    {
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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BohemeCafeBundle:Wine')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Wine entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BohemeCafeBundle:Wine:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Wine entity.
     *
     */
    public function editAction($id)
    {
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

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Wine entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
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
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
