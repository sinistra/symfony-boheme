<?php

namespace Nms\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NoticeType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content', null, array('label' => 'Content','required' => false))
            ->add('publish', 'date', array('widget' => 'single_text',
                                        'input' => 'datetime',
                                        'format' => 'dd-MM-yyyy',
                                        'attr'=> array('class'=>'m-wrap m-ctrl-medium date-picker')
                ))
            ->add('expire', 'date', array('widget' => 'single_text',
                                        'input' => 'datetime',
                                        'format' => 'dd-MM-yyyy',
                                        'attr'=> array('class'=>'m-wrap m-ctrl-medium date-picker')
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nms\AdminBundle\Entity\Notice'
        ));
    }

    public function getName()
    {
        return 'nms_adminbundle_noticetype';
    }
}
