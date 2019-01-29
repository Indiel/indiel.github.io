<?php

namespace AppBundle\Form;

use AppBundle\Entity\BankCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BankCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cardHolderName', TextType::class, [
                'label' => 'Имя и фамилия держателя карты',
            ])
            ->add('number', TextType::class, [
                'label' => 'Номер карты',
            ])
            ->add('expirationMonth', TextType::class, [
                'label' => 'Действительна до',
            ])
            ->add('expirationYear', TextType::class, [
                'label' => '',
            ])
            ->add('cvv', TextType::class, [
                'label' => 'CVV карты',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BankCard::class,
        ]);
    }
}