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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationSocialInfoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maritalStatus', EnumType::class, [
                'label' => 'Семейное положение',
                'choices' => MaritalStatus::toArray(),
                'class_name' => MaritalStatus::class,
                'data' => new MaritalStatus(MaritalStatus::UNMARRIED)
//                'expanded' => true,
            ])
            ->add('numberOfDependents', EnumType::class, [
                'label' => 'Количество людей на содержании',
                'choices' => NumberOfDependents::toArray(),
                'class_name' => NumberOfDependents::class,
                'data' => new NumberOfDependents(NumberOfDependents::NONE)
//                'expanded' => true,
            ])
            ->add('education', EnumType::class, [
                'label' => 'Образование',
                'choices' => Education::toArray(),
                'class_name' => Education::class,
                'placeholder' => 'Выберите вариант',
                'data' => new Education(Education::HIGHER)
            ])
            ->add('citizenship', EnumType::class, [
                'label' => 'Украинское гражданство',
                'choices' => YesNo::toArray(),
                'class_name' => YesNo::class,
                'data' => new YesNo(YesNo::YES)
//                'expanded' => true,
            ])
            ->add('isPassportNewType', EnumType::class, [
                'label' => 'Паспорт нового образца',
                'choices' => YesNo::toArray(),
                'class_name' => YesNo::class,
                'expanded' => true,
            ])
            ->add('passport', TextType::class, [
                'label' => 'Серия и номер',
            ])
            ->add('documentNumber', IntegerType::class, [
                'label' => 'Номер документа',                
            ])
            ->add('passportRegistration', DateType::class, [
                'label' => 'Когда выдан?',
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
            ])
            ->add('passportIssuedBy', TextType::class, [
                'label' => 'Кем выдан?',
            ])
            ->add('passportIssuedByNumber', IntegerType::class, [
                'label' => 'Кем выдан?',
            ])
            ->add('passportValidDate', DateType::class, [
                'label' => 'Срок действия',
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
            ])
            ->add('passportRecordNumber', TelType::class, [
                'label' => 'Номер записи',
            ])            
            ->add('socialSecurityNumber', IntegerType::class, [
                'label' => 'ИНН',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
            'validation_groups' => array('Default', 'RegistrationSocialInfo'),
        ));
    }

}