<?php

namespace Boheme\CafeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MealType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('sitting')
            ->add('menugroup')
            ->add('price')
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

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boheme\CafeBundle\Entity\Meal'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'boheme_cafebundle_meal';
    }
}
