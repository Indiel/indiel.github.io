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

class ProfilePassportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isPassportNewType', EnumType::class, [
                'label' => 'Паспорт нового образца',
                'choices' => YesNo::toArray(),
                'class_name' => YesNo::class,
            ])
            ->add('passport', TextType::class, [
                'label' => 'Серия и номер',
            ])
            ->add('documentNumber', TextType::class, [
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
            ->add('passportIssuedByNumber', TextType::class, [
                'label' => 'Кем выдан?',
            ])
            ->add('passportValidDate', DateType::class, [
                'label' => 'Срок действия',
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
            ])
            ->add('passportRecordNumber', TextType::class, [
                'label' => 'Номер записи',
            ])
            ->add('socialSecurityNumber', TextType::class, [
                'label' => 'ИНН',
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