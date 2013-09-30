<?php

namespace Nms\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('url')
            ->add('icon')
            ->add('parent')
            ->add('seq')
            ->add('secured', 'checkbox', array('required' => false))
            ->add('external', 'checkbox', array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nms\AdminBundle\Entity\Menu'
        ));
    }

    public function getName()
    {
        return 'nms_adminbundle_menutype';
    }
}
