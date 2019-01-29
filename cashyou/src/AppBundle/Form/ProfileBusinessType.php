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

class ProfileBusinessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('incomeType', EnumType::class, [
                'label' => 'Занятость',
                'choices' => IncomeType::toArray(),
                'class_name' => IncomeType::class,
                'placeholder' => 'Выберите вариант',
            ])
            ->add('monthlyIncome', EnumType::class, [
                'label' => 'Ежемесячный доход',
                'choices' => MonthlyIncome::toArray(),
                'class_name' => MonthlyIncome::class,
                'placeholder' => 'Выберите вариант',
            ])
            ->add('companyName', TextType::class, [
                'label' => 'Название организации',
            ])
            ->add('position', EnumType::class, [
                'label' => 'Должность',
                'choices' => Position::toArray(),
                'class_name' => Position::class,
                'placeholder' => 'Выберите вариант',
            ])
            ->add('businessType', EnumType::class, [
                'label' => 'Вид деятельности',
                'choices' => BusinessType::toArray(),
                'class_name' => BusinessType::class,
                'placeholder' => 'Выберите вариант',
            ])
            ->add('lastExperience', EnumType::class, [
                'label' => 'Стаж работы на последнем месте',
                'choices' => WorkingExperience::toArray(),
                'class_name' => WorkingExperience::class,
                'placeholder' => 'Выберите вариант',
                'data' => new WorkingExperience(WorkingExperience::FROM_0_TO_2_YEARS),
            ])
            ->add('totalExperience', EnumType::class, [
                'label' => 'Общий стаж работы',
                'choices' => WorkingExperience::toArray(),
                'class_name' => WorkingExperience::class,
                'placeholder' => 'Выберите вариант',
                'data' => new WorkingExperience(WorkingExperience::FROM_0_TO_2_YEARS),
            ])
            ->add('workPhone', TelType::class, [
                'label' => 'Служебный телефон',
            ])
            ->add('carOwner', EnumType::class, [
                'label' => 'Владеете ли вы машиной?',
                'choices' => YesNo::toArray(),
                'class_name' => YesNo::class,
                'placeholder' => 'Выберите вариант',
                'data' => new YesNo(YesNo::NO)
            ])
            ->add('realEstateOwner', EnumType::class, [
                'label' => 'Владеете ли вы недвижимостью?',
                'choices' => YesNo::toArray(),
                'class_name' => YesNo::class,
                'placeholder' => 'Выберите вариант',
                'data' => new YesNo(YesNo::NO)
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