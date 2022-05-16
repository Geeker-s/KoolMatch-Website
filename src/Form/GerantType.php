<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GerantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomGerant')
            ->add('prenomGerant')
            ->add('emailGerant')
            ->add('passwordGerant', PasswordType::class)
            ->add('telephoneGerant')
            ->add('ddAbonnement', \Symfony\Component\Form\Extension\Core\Type\DateType::class, [
                'widget' => 'single_text',
                'empty_data' => null,
                'format' => 'yyyy-MM-dd',

            ])
            ->add('dfAbonnement', \Symfony\Component\Form\Extension\Core\Type\DateType::class, [
                'widget' => 'single_text',
                'empty_data' => null,
                'format' => 'yyyy-MM-dd',
            ])
            ->add('ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
