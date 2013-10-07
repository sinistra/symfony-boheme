<?php

namespace Boheme\CafeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boheme\CafeBundle\Entity\Meal;
use Boheme\CafeBundle\Form\MealType;

/**
 * Meal controller.
 *
 */
class MealController extends Controller
{

    /**
     * Lists all Meal entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BohemeCafeBundle:Meal')->findAll();

        return $this->render('BohemeCafeBundle:Meal:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Meal entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Meal();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('meal_show', array('id' => $entity->getId())));
        }

        return $this->render('BohemeCafeBundle:Meal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Meal entity.
    *
    * @param Meal $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Meal $entity)
    {
        $form = $this->createForm(new MealType(), $entity, array(
            'action' => $this->generateUrl('meal_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Meal entity.
     *
     */
    public function newAction()
    {
        $entity = new Meal();
        $form   = $this->createCreateForm($entity);

        return $this->render('BohemeCafeBundle:Meal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Meal entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BohemeCafeBundle:Meal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BohemeCafeBundle:Meal:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing Meal entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BohemeCafeBundle:Meal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meal entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BohemeCafeBundle:Meal:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Meal entity.
    *
    * @param Meal $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Meal $entity)
    {
        $form = $this->createForm(new MealType(), $entity, array(
            'action' => $this->generateUrl('meal_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Meal entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BohemeCafeBundle:Meal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Meal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('meal_edit', array('id' => $id)));
        }

        return $this->render('BohemeCafeBundle:Meal:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Meal entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BohemeCafeBundle:Meal')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Meal entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('meal'));
    }

    /**
     * Creates a form to delete a Meal entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('meal_delete', array('id' => $id)))
            ->setMethod('DELETE')
//            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
