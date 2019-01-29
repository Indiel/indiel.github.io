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
use AppBundle\Entity\RealEstate;
use AppBundle\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationAddressFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $addr = new Address();
        $addr->setRealEstate(new RealEstate(RealEstate::PURCHASED));

        $builder
        ->add('address', AddressType::class, [
            'label' => false,
            //'data' => $addr
        ])
        ->add('secondAddress', Address2Type::class, [
            'label' => false,
            //'data' => $addr
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
            'validation_groups' => array('Default', 'RegistrationAddress'),
        ));
    }

}