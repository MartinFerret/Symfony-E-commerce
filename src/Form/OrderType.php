<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Carrier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $user = $options['user'];
        $builder
            ->add('addresses', EntityType::class, [
                "label" => "Choose your delivery address",
                'required' => true,
                "class" => Address::class,
                'choices'=> $user->getAddresses(),
                "multiple" =>  false,
                "expanded" => true
            ])
            ->add('carriers', EntityType::class, [
                "label" => "Choose your carrier",
                'required' => true,
                "class" => Carrier::class,
                "multiple" =>  false,
                "expanded" => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "user" => []
        ]);
    }
}
