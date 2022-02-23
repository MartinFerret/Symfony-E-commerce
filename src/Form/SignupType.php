<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SignupType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                "label" => "Firstname",
                "constraints" => new Length([
                    "min" => 2,
                    "max" => 30
                ]),
                "attr" => [
                "placeholder" => "Enter your firstname" 
            ]])
            ->add('lastname', TextType::class, [
                "label" => "Lastname",
                "constraints" => new Length([
                    "min" => 2,
                    "max" => 30
                ]),
                "attr" => [
                "placeholder" => "Enter your lastname" 
            ]])
            ->add('email', EmailType::class, [
                "label" => "Email",
                "constraints" => new NotBlank(),
                "attr" => [
                    "placeholder" => "Enter your email address"
                ]
            ])
            ->add('password', RepeatedType::class, [
                "type" => PasswordType::class,
                "constraints" => new Length([
                    "min" => 8,
                    "max" => 30
                ]),
                "invalid_message" => "Your passwords doesn't match",
                "required" => true,
                "first_options" => ['label' => 'Password (8 characters min.)',
                "attr" => [
                    "placeholder" => "Enter your password"
                ]],
                "second_options" => ['label' => "Confirm your password",
                "attr" => [
                    "placeholder" => "Confirm your password"
                ]]
            ])
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
