<?php
// src/Nms/AdminBundle/Form/Type/RegistrationFormType.php

namespace Nms\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('name');
    }

    public function getName() {
        return 'nms_admin_registration';
    }

}
