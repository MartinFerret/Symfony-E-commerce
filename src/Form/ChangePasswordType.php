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
use Symfony\Component\Validator\Constraints\Length;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                "disabled" => true,
                "label" => "My email address"
            ])
            ->add('old_password', PasswordType::class, [
                "label" => "My current password",
                "mapped" => false,
                "attr" => [
                    "placeholder" => "Please, type your current password"
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                "type" => PasswordType::class,
                "mapped" => false,
                "constraints" => new Length([
                    "min" => 8,
                    "max" => 30
                ]),
                "invalid_message" => "Your passwords doesn't match",
                "required" => true,
                "first_options" => ['label' => 'My new password (8 characters min.)',
                "attr" => [
                    "placeholder" => "My new password"
                ]],
                "second_options" => ['label' => "Confirm my new password",
                "attr" => [
                    "placeholder" => "Confirm my new password"
                ]]
            ])
            ->add('firstname', TextType::class, [
                "disabled" => true,
                "label" => "My firstname"
            ])
            ->add('lastname', TextType::class, [
                "disabled" => true,
                "label" => "My lastname"
            ])
            ->add('Update', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
