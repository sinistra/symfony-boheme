<?php

namespace Nms\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nms\AdminBundle\Entity\User;
use Nms\AdminBundle\Form\UserType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * User controller.
 *
 */
class UserController extends Controller {

    /**
     * Lists all User entities.
     *
     */
    public function indexAction() {
        if (false === $this->get('security.context')->isGranted('ROLE_CLUB')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('NmsAdminBundle:User')
                ->filteredFind(
                        $this->get('request')->query->get('sort', 'u.id'),
                        $this->get('request')->query->get('direction', 'ASC'),
                        $this->get('request')->query->get('filterField', null), $this->get('request')->query->get('filterValue', null)
        );

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($users, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */, array()
        );

        $fields = array('u.username' => 'Username',
            'u.name' => 'Name',
            'u.email' => 'Email',
        );

        return $this->render('NmsAdminBundle:User:index.html.twig', array(
//                'entities' => $entities,
                    'pagination' => $pagination,
                    'fields' => $fields,
        ));
    }

    /**
     * Creates a new User entity.
     *
     */
    public function createAction(Request $request) {
        if (false === $this->get('security.context')->isGranted('ROLE_CLUB')) {
            throw new AccessDeniedException();
        }

        $entity = new User();
        $form = $this->createForm(new UserType(), $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($entity);
//                $entity->encodePassword($encoder);
            $entity->setPassword($encoder->encodePassword('buddha', $entity->getSalt()));

//                set the number of logins to zero
            $entity->setLogins(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'User record saved!');

            $message = \Swift_Message::newInstance()
                    ->setSubject('Welcome to Buddha')
                    ->setFrom('admin@nms.com.au')
                    ->setTo($entity->getEmail())
                    ->setBody(
                        $this->renderView('NmsAdminBundle:User:welcome.txt.twig', array(
                            'user' => $entity
                            ))
                    );
            $this->get('mailer')->send($message);

            return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
        }

        return $this->render('NmsAdminBundle:User:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction()
    {
        if (false === $this->get('security.context')->isGranted('ROLE_CLUB')) {
            throw new AccessDeniedException();
        }

        $entity = new User();
        $form = $this->createForm(new UserType(), $entity);

        return $this->render('NmsAdminBundle:User:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NmsAdminBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NmsAdminBundle:User:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id) {
        if (false === $this->get('security.context')->isGranted('ROLE_CLUB')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NmsAdminBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createForm(new UserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NmsAdminBundle:User:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $id) {
        if (false === $this->get('security.context')->isGranted('ROLE_CLUB')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NmsAdminBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UserType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'User record updated!');

            return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
        }

        return $this->render('NmsAdminBundle:User:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        if (false === $this->get('security.context')->isGranted('ROLE_CLUB')) {
            throw new AccessDeniedException();
        }

        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NmsAdminBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->set('warning', 'User record deleted!');
        }

        return $this->redirect($this->generateUrl('user_list'));
    }

    /**
     * Creates a form to delete a User entity by id.
     * @param mixed $id The entity id
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                    ->add('id', 'hidden')
                    ->getForm();
    }

    /**
     * Reset current user password.
     *
     */
    public function passwordAction()
    {
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

        $current_user = $this->get('security.context')->getToken()->getUser();
        $id = $current_user->getId();

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('NmsAdminBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $request = $this->get('request');

        $form = $this->createFormBuilder()
                ->add('old', 'password', array(
                    'always_empty' => true,
                    'required' => true,
                    'label' => 'Old password')
                )
                ->add('new', 'repeated', array(
                    'type' => 'password',
                    'required' => true,
                    'invalid_message' => 'The password fields must match',
                    'first_options' => array('label' => 'New password'),
                    'second_options' => array('label' => 'Repeat the new password'))
                )
                ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                if ($user->getPassword() !== $encoder->encodePassword($form->get('old')->getData(), $user->getSalt())) {
                    $this->get('session')->getFlashBag()->add('error', 'The old password is invalid!');
                    return $this->render('NmsAdminBundle:User:password.html.twig', array(
                                'user' => $user,
                                'form' => $form->createView(),
                    ));
                }

                if (strlen($form->get('new')->getData()) < 6) {
                    $this->get('session')->getFlashBag()->add('error', 'The new password is not long enough, 8 characters minimum !');
                    return $this->render('NmsAdminBundle:User:password.html.twig', array(
                                'user' => $user,
                                'form' => $form->createView(),
                    ));
                }

                $newpassword = $encoder->encodePassword($form->get('new')->getData(), $user->getSalt());
                $user->setPassword($newpassword);

                $em->persist($user);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Your password was updated !');
            }
        }

        return $this->render('NmsAdminBundle:User:password.html.twig', array(
                    'user' => $user,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Request a password reset.
     *
     */
    public function requestAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $logger = $this->get('logger');
//        $logger->info('\$_GET='.print_r($_GET,1));

        if (isset($_GET['username'])) {
            $username = $_GET['username'];
            $logger->info('\$username='.$username);
            $user = $em->getRepository('NmsAdminBundle:User')->loadUserByUsername($username);
        } elseif (isset($_GET['id'])) {
            $id = $_GET['id'];
            $logger->info('\$id='.$id);
            $user = $em->getRepository('NmsAdminBundle:User')->find($id);
        } else {
            $this->get('session')->getFlashBag()->set('error', 'I cannot reset a User password without user identification.');
            return $this->redirect($this->generateUrl('NmsAdminBundle_homepage'));
        }

        if (!$user) {
            $this->get('session')->getFlashBag()->set('error', 'User record not found!');
            return $this->redirect($this->generateUrl('NmsAdminBundle_homepage'));
        } else {
            $token = uniqid('b3');
            $user->setToken($token);
            $logger->info('token='.$token);

            $em->persist($user);
            $em->flush();

            $message = \Swift_Message::newInstance()
                    ->setSubject('Buddha password reset')
                    ->setFrom('admin@nms.com.au')
                    ->setTo($user->getEmail())
                    ->setBody(
                        $this->renderView('NmsAdminBundle:User:request.txt.twig', array(
                            'user' => $user
                            ))
                    );

            $this->get('mailer')->send($message);
            $this->get('session')->getFlashBag()->set('success', 'Password reset emailed to ' . $user->getEmail());
            return $this->redirect($this->generateUrl('user_show', array('id' => $user->getId())));
        }

    }

    public function resetAction(Request $request, $token) {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('NmsAdminBundle:User')->findOneBy(array('token' => $token));

        if (!$user) {
            throw $this->createNotFoundException('Unable to find User record with reset token.');
        }

        $form = $this->createFormBuilder()
                ->add('new', 'repeated', array(
                    'type' => 'password',
                    'required' => true,
                    'invalid_message' => 'The password fields must match',
                    'first_options' => array('label' => 'New password'),
                    'second_options' => array('label' => 'Repeat the new password'))
                )
                ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);

                if (strlen($form->get('new')->getData()) < 6) {
                    $this->get('session')->getFlashBag()->add('error', 'The new password is not long enough, 8 characters minimum !');
                    return $this->render('NmsAdminBundle:User:reset.html.twig', array(
                                'user' => $user,
                                'token' => $token,
                                'form' => $form->createView(),
                    ));
                }

                $newpassword = $encoder->encodePassword($form->get('new')->getData(), $user->getSalt());
                $user->setPassword($newpassword);
                $user->setToken(null);

//                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Your password was updated !');
            }
        }

        return $this->render('NmsAdminBundle:User:reset.html.twig', array(
                    'user' => $user,
                    'token' => $token,
                    'form' => $form->createView(),
        ));
    }

}
