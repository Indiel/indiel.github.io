<?php

namespace AppBundle\Form;

use AppBundle\Entity\Gender;
use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilePersonalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Имя',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Фамилия',
            ])
            ->add('middleName', TextType::class, [
                'label' => 'Отчество',
            ])
            ->add('gender', EnumType::class, [
                'label' => 'Пол',
                'choices' => Gender::toArray(),
                'class_name' => Gender::class,
                'placeholder' => 'Выберите вариант',
            ])
            ->add('birthDate', DateType::class, [
                'label' => 'Дата рождения',
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
            ])
            ->add('phone', TelType::class, [
                'label' => 'Номер телефона',
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
            'validation_groups' => array('Default', 'Profile'),
        ));
    }

}