<?php

namespace Nms\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
{
//        $builder
//            ->add('email', 'email')
//            ->add('rawPassword', 'repeated', array(
//                'type' => 'password',
//                'first_options' => array('label' => 'Password'),
//                'second_options' => array('label' => 'Confirmation')
//            ))
//        ;
        $builder
            ->add('username', null, array(
                'label' => 'Username',
                'required' => true)
            )
            ->add('name', null, array(
                'label' => 'Name',
                'required' => true)
            )
            ->add('email', null, array(
                'label' => 'Email address',
                'required' => 'true')
            )
            ->add('isActive', 'choice', array(
                'label' => 'Active?',
                'required' => 'true',
                'choices' => array(0 => 'No', 1 => 'Yes'),
                'preferred_choices' => array(1)
                )
            )
            ->add('club')
            ->add('groups', null, array(
                'label' => 'Role groups',
                'required' => 'true',
                'expanded' => 'true',
                'label_attr' => array('class' => 'checkbox inline')
                )
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nms\AdminBundle\Entity\User',
            'error_mapping' => array(
                'passwordValid' => 'rawPassword'
            )
        ));
    }

    public function getName() {
        return 'user_form';
    }

}
