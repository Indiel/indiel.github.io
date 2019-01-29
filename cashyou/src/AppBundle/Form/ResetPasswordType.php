<?php

namespace AppBundle\Form;

use AppBundle\Entity\ResetPasswordForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Пароли не совпадают.',
                'first_options'  => array('label' => 'Новый пароль', 'always_empty' => false),
                'second_options' => array('label' => 'Повторите пароль', 'always_empty' => false),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'attr' => array('novalidate' => 'novalidate'),
            'data_class' => ResetPasswordForm::class,
            'csrf_protection' => true,
        ));
    }
}