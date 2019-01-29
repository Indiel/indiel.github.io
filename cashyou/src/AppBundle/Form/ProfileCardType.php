<?php

namespace AppBundle\Form;

use AppBundle\Entity\Card;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cardType', TextType::class, [
                'label' => 'Платежная система',
            ])
            ->add('cardPan', TextType::class, [
                'label' => 'Номер',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Card::class,
            'validation_groups' => array('Default', 'Profile'),
        ));
    }
}