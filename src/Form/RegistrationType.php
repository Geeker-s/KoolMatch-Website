<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomUser')
            ->add('prenomUser')
            ->add('emailUser')
            ->add('passwordUser', PasswordType::class)
            ->add('dateNaissance_user', \Symfony\Component\Form\Extension\Core\Type\DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'empty_data' => '',
            ])
            ->add('sexeUser', ChoiceType::class, [
                'choices'  => [
                    'Homme' => 'homme',
                    'Femme' => 'femme',

                ],
            ])
            ->add('telephone_user')
            ->add('photo_user',FileType::class)
            ->add('description_user')
            ->add('adresse_user')
            ->add('maxDistance_user')
            ->add('preferredMinAge_user')
            ->add('preferredMaxAge_user')
            ->add('latitude')
            ->add('longitude')
            ->add('Interet_user')
            ->add('register', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
