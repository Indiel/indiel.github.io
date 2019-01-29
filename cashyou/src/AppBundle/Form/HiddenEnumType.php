<?php

namespace AppBundle\Form;

use AppBundle\Entity\Enum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HiddenEnumType extends AbstractType
{
    public function getBlockPrefix()
    {
        return 'hidden';
    }

    public function getParent()
    {
        return EnumType::class;
    }
}