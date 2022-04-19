<?php

namespace App\Form;

use App\Entity\Quiz;
use App\Entity\Recette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('q1')
            ->add('rc1')
            ->add('rf11')
            ->add('rf12')
            ->add('rf13')
            ->add('q2')
            ->add('rc2')
            ->add('rf21')
            ->add('rf22')
            ->add('rf23')
            ->add('q3')
            ->add('rc3')
            ->add('rf31')
            ->add('rf32')
            ->add('rf33')
            ->add('archive')
            ->add('id_recette',EntityType::class,
                ['class'=>Recette::class,
                    'choice_label'=>'nom_recette'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
        ]);
    }
}
