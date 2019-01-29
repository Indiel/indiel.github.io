<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;

class Address2Type extends AddressType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->remove('residentialMatchesRegistration' )
        ;

    }
}