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
            ->add('variety')
            ->add('region')
            ->add('glassvolume')
            ->add('glassprice')
            ->add('carafevolume')
            ->add('carafeprice')
            ->add('bottlevolume')
            ->add('bottleprice')
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
