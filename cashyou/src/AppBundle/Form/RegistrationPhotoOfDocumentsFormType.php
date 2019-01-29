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
use Symfony\Component\Validator\Constraints\Length;

class RegistrationPhotoOfDocumentsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            
            ->add('docPassport1Json', UploadDocumentType::class, [
                'label' => 'Загрузите фото 1й страницы Вашего паспорта',
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 8,
                        'minMessage' => "Пожалуйста загрузите фото 1й страницы Вашего паспорта",
                    ]),                    
                ]
            ])
            ->add('docPassport2Json', UploadDocumentType::class, [
                'label' => 'Загрузите фото 2й страницы Вашего паспорта',
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 8,
                        'minMessage' => "Пожалуйста загрузите фото 2й страницы Вашего паспорта",
                    ]),                    
                ]
            ])
            ->add('docPassport3Json', UploadDocumentType::class, [
                'label' => 'Загрузите фото страницы прописки',
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 8,
                        'minMessage' => "Пожалуйста загрузите фото страницы прописки",
                    ]),                    
                ]
            ])
            ->add('docIpnJson', UploadDocumentType::class, [
                'label' => 'Загрузите фото Вашего ИНН',
                'required' => false,
            ])
            ->add('docsJson', UploadDocumentType::class, [
                'label' => 'Дополнительные документы',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
            'validation_groups' => array('Default', 'RegistrationPhotoOfDocuments'),
        ));
    }

}