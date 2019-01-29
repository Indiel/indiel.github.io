<?php

namespace AppBundle\Form;

use AppBundle\Entity\Enum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $className = $options['class_name'];

        $builder->addModelTransformer(new CallbackTransformer(
            function (Enum $enum = null) {
                return !empty($enum) ? $enum->getValue() : null;
            },
            function ($value) use ($className) {
                return !empty($value) ? new $className($value) : null;
            }
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('class_name');
        $resolver->setDefaults([
            'choice_translation_domain' => 'enum',
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}