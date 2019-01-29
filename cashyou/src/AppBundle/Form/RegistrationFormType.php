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

class RegistrationFormType extends AbstractType
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
//                'expanded' => true,
            ])
            ->add('birthDate', DateType::class, [
                'label' => 'Дата рождения',
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
            ])
            ->add('phone', TelType::class, [
                'label' => 'Номер телефона',
            ])
            ->add('email', RepeatedType::class, array(
                'type' => EmailType::class,
                'invalid_message' => 'Поля E-mail не совпадают.',
                'first_options'  => array('label' => 'E-mail'),
                'second_options' => array('label' => 'Повторите E-mail'),
            ))
            ->add('secretQuestion', EnumType::class, [
                'label' => 'Секретный вопрос',
                'choices' => SecretQuestion::toArray(),
                'class_name' => SecretQuestion::class,
                'placeholder' => 'Выберите вариант',
            ])
            ->add('secretAnswer', TextType::class, [
                'label' => 'Ответ на секретный вопрос',
            ])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Пароли не совпадают.',
                'first_options'  => array('label' => 'Пароль', 'always_empty' => false),
                'second_options' => array('label' => 'Повторите пароль', 'always_empty' => false),
            ))
            ->add('maritalStatus', EnumType::class, [
                'label' => 'Семейное положение',
                'choices' => MaritalStatus::toArray(),
                'class_name' => MaritalStatus::class,
//                'expanded' => true,
            ])
            ->add('numberOfDependents', EnumType::class, [
                'label' => 'Количество людей на содержании',
                'choices' => NumberOfDependents::toArray(),
                'class_name' => NumberOfDependents::class,
//                'expanded' => true,
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
            ->add('address', AddressType::class, [
                'label' => false,
            ])
            ->add('secondAddress', Address2Type::class, [
                'label' => false,
            ])
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
//                'expanded' => true,
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
            ])
            ->add('totalExperience', EnumType::class, [
                'label' => 'Общий стаж работы',
                'choices' => WorkingExperience::toArray(),
                'class_name' => WorkingExperience::class,
                'placeholder' => 'Выберите вариант',
            ])
            ->add('workPhone', TelType::class, [
                'label' => 'Служебный телефон',
            ])
            ->add('carOwner', EnumType::class, [
                'label' => 'Владеете ли вы машиной?',
                'choices' => YesNo::toArray(),
                'class_name' => YesNo::class,
//                'expanded' => true,
            ])
            ->add('realEstateOwner', EnumType::class, [
                'label' => 'Владеете ли вы недвижимостью?',
                'choices' => YesNo::toArray(),
                'class_name' => YesNo::class,
//                'expanded' => true,
            ])
            ->add('docPassport1Json', UploadDocumentType::class, [
                'label' => 'Загрузите фото 1й страницы Вашего паспорта',
                'required' => true,
            ])
            ->add('docPassport2Json', UploadDocumentType::class, [
                'label' => 'Загрузите фото 2й страницы Вашего паспорта',
                'required' => true,
            ])
            ->add('docPassport3Json', UploadDocumentType::class, [
                'label' => 'Загрузите фото страницы прописки',
                'required' => true,
            ])
            ->add('docIpnJson', UploadDocumentType::class, [
                'label' => 'Загрузите фото Вашего ИНН',
                'required' => false,
            ])
            ->add('docsJson', UploadDocumentType::class, [
                'label' => 'Дополнительные документы',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
            'validation_groups' => array('Default', 'Registration'),
        ));
    }

}