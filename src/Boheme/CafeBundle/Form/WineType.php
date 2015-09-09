<?php

namespace Boheme\CafeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WineType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('note')
            ->add('glassvolume', null, array(
                'label' => 'Glass volume',
            ))
            ->add('glassprice', null, array(
                'label' => 'Glass price',
            ))
            ->add('carafevolume', null, array(
                'label' => 'Carafe volume',
            ))
            ->add('carafeprice', null, array(
                'label' => 'Carafe price',
            ))
            ->add('bottlevolume', null, array(
                'label' => 'Bottle volume',
            ))
            ->add('bottleprice', null, array(
                'label' => 'Bottle price',
            ))
            ->add('type')
            ->add('variety')
            ->add('region')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boheme\CafeBundle\Entity\Wine'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'boheme_cafebundle_wine';
    }
}
