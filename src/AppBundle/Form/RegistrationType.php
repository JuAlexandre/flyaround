<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 09/05/18
 * Time: 19:37
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName');
        $builder->add('lastName');
        $builder->add('phoneNumber');
        $builder->add('birthDate');
        $builder->add('creationDate');
        $builder->add('note');
        $builder->add('isACertifiedPilot');
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
