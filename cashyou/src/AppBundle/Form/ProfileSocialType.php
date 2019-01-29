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

class ProfileSocialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maritalStatus', EnumType::class, [
                'label' => 'Семейное положение',
                'choices' => MaritalStatus::toArray(),
                'class_name' => MaritalStatus::class,
                'placeholder' => 'Выберите вариант',
            ])
            ->add('numberOfDependents', EnumType::class, [
                'label' => 'Количество людей на содержании',
                'choices' => NumberOfDependents::toArray(),
                'class_name' => NumberOfDependents::class,
                'placeholder' => 'Выберите вариант',
            ])
            ->add('education', EnumType::class, [
                'label' => 'Образование',
                'choices' => Education::toArray(),
                'class_name' => Education::class,
                'placeholder' => 'Выберите вариант',
            ])
            ->add('citizenship', EnumType::class, [
                'label' => 'Украинское гражданство',
                'choices' => YesNo::toArray(),
                'class_name' => YesNo::class,
                'placeholder' => 'Выберите вариант',
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