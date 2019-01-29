<?php

namespace AppBundle\Form;

use AppBundle\Entity\Address;
use AppBundle\Entity\RealEstate;
use AppBundle\Entity\TypeOfSettlement;
use AppBundle\Entity\YesNo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('street', TextType::class,[
                'label' => 'Улица',
            ])
            ->add('state', TextType::class,[
                'label' => 'Область',
            ])
            ->add('typeOfSettlement', EnumType::class,[
                'label' => 'Тип населенного пункта',
                'choices' => TypeOfSettlement::toArray(),
                'class_name' => TypeOfSettlement::class,
                'placeholder' => 'Выберите вариант',
            ])
            ->add('city', TextType::class,[
                'label' => 'Населенный пункт',
            ])
            ->add('house', TextType::class,[
                'label' => 'Дом',
            ])
            ->add('building', TextType::class,[
                'label' => 'Корпус',
                'required' => false,
            ])
            ->add('apartment', TextType::class,[
                'label' => 'Квартира',
                'required' => false,
            ])
            ->add('zipCode', TextType::class,[
                'label' => 'Почтовый индекс',
            ])
            ->add('realEstate', EnumType::class,[
                'label' => 'Недвижимость',
                'choices' => RealEstate::toArray(),
                'class_name' => RealEstate::class,
                'placeholder' => 'Выберите вариант',
                'data' => new RealEstate(RealEstate::PURCHASED),
            ])
            ->add('residentialMatchesRegistration', EnumType::class, [
                'label' => 'Адрес проживания соответствует адресу регистрации?',
                'choices' => YesNo::toArray(),
                'class_name' => YesNo::class,
                'placeholder' => 'Выберите вариант',
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Address::class,
        ));
    }
}