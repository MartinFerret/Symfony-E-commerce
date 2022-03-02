<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Country;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Name",
                "attr" => [
                    "placeholder" => "Enter your name"
                ]
            ])
            ->add('firstname', TextType::class, [
                "label" => "Firstname",
                "attr" => [
                    "placeholder" => "Enter your firstname"
                ]
            ])
            ->add('lastname', TextType::class, [
                "label" => "Lastname",
                "attr" => [
                    "placeholder" => "Enter your lastname"
                ]
            ])
            ->add('company', TextType::class, [
                "label" => "Company (optionnal)",
                "attr" => [
                    "placeholder" => "Enter your company"
                ]
            ])
            ->add('address', TextType::class, [
                "label" => "Address",
                "attr" => [
                    "placeholder" => "Enter your address"
                ]
            ])
            ->add('zipCode', TextType::class, [
                "label" => "Zip code",
                "attr" => [
                    "placeholder" => "Enter your Zip code"
                ]
            ])
            ->add('city', TextType::class, [
                "label" => "City",
                "attr" => [
                    "placeholder" => "Enter your city"
                ]
            ])
            ->add('country', CountryType::class, [
                "label" => "Country",
                "attr" => [
                    "placeholder" => "Enter your country"
                ]
            ])
            ->add('phone', TelType::class, [
                "label" => "Phone",
                "attr" => [
                    "placeholder" => "Enter your phone"
                ]
            ])
            ->add('submit', SubmitType::class, [
                "label" => "Add an address",
                "attr" => [
                    "class" => "btn-block btn-info"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
