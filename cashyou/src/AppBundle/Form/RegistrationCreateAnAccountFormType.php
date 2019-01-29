<?php

namespace AppBundle\Form;

use AppBundle\Entity\BusinessType;
use AppBundle\Entity\Education;
use AppBundle\Entity\Gender;
use AppBundle\Entity\IncomeType;
use AppBundle\Entity\MaritalStatus;
use AppBundle\Entity\MonthlyIncome;
use AppBundle\Entity\NumberOfDependents;
use AppBundle\Entity\Position;
use AppBundle\Entity\SecretQuestion;
use AppBundle\Entity\User;
use AppBundle\Entity\WorkingExperience;
use AppBundle\Entity\YesNo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Date;

class RegistrationCreateAnAccountFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Имя',
                'constraints' => [
                    new NotBlank(),                    
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Фамилия',
                'constraints' => [
                    new NotBlank(),                    
                ]
            ])
            ->add('middleName', TextType::class, [
                'label' => 'Отчество',
                'constraints' => [
                    new NotBlank(),                    
                ]
            ])
            ->add('gender', EnumType::class, [
                'label' => 'Пол',
                'choices' => Gender::toArray(),
                'class_name' => Gender::class,
//                'expanded' => true,                
                'constraints' => [
                    new NotBlank(),                    
                ]
            ])
            ->add('birthDate', DateType::class, [
                'label' => 'Дата рождения',
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',                
                'constraints' => [
                    new NotBlank(), 
                    new Date()                   
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Номер телефона',                
                'constraints' => [
                    new NotBlank(),                    
                ]
            ])
            ->add('email', RepeatedType::class, array(
                'type' => EmailType::class,
                'invalid_message' => 'Поля E-mail не совпадают.',
                'first_options'  => array('label' => 'E-mail'),
                'second_options' => array('label' => 'Повторите E-mail'),                
                'constraints' => [
                    new NotBlank(),
                    new Email()                    
                ]
            ))
            ->add('secretQuestion', EnumType::class, [
                'label' => 'Секретный вопрос',
                'choices' => SecretQuestion::toArray(),
                'class_name' => SecretQuestion::class,
                'placeholder' => 'Выберите вариант',
                'constraints' => [
                    new NotBlank(),                                    
                ]
            ])
            ->add('secretAnswer', TextType::class, [
                'label' => 'Ответ на секретный вопрос',
                'constraints' => [
                    new NotBlank(),                                    
                ]
            ])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Пароли не совпадают.',
                'first_options'  => array('label' => 'Пароль', 'always_empty' => false),
                'second_options' => array('label' => 'Повторите пароль', 'always_empty' => false),
                'constraints' => [
                    new NotBlank(),                                    
                ]
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
            'validation_groups' => array('Default', 'Registration'),
        ));
    }

}