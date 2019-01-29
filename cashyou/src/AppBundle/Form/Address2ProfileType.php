<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;

class Address2ProfileType extends AddressProfileType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->remove('residentialMatchesRegistration' )
        ;

    }
}