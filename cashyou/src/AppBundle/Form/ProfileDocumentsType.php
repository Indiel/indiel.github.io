<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileDocumentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('docPassport1Json', UploadDocumentType::class, [
                'label' => 'Загрузите фото 1й страницы Вашего паспорта',
                'required' => true,
            ])
            ->add('docPassport2Json', UploadDocumentType::class, [
                'label' => 'Загрузите фото 1й страницы Вашего паспорта',
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
            'validation_groups' => array('Default', 'Profile'),
        ));
    }
}