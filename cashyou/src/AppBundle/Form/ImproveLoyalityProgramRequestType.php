<?php

namespace AppBundle\Form;

use AppBundle\Entity\BonusesDegree;
use AppBundle\Entity\ImproveLoyalityProgramRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImproveLoyalityProgramRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxAmountDegree', HiddenEnumType::class, [
                'choices' => BonusesDegree::toArray(),
                'class_name' => BonusesDegree::class,
            ])
            ->add('maxTermDegree', HiddenEnumType::class, [
                'choices' => BonusesDegree::toArray(),
                'class_name' => BonusesDegree::class,
            ])
            ->add('interestRateDegree', HiddenEnumType::class, [
                'choices' => BonusesDegree::toArray(),
                'class_name' => BonusesDegree::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ImproveLoyalityProgramRequest::class,
        ));
    }
}