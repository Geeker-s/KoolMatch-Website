<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Restaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateReservation')
            ->add('nbplaceReservation')
            ->add('idRestaurant',EntityType::class,['class'=>Restaurant::class,'choice_label'=>'nomRestaurant','label'=>'choisissez le nom de votre restaurant'])
            //->add('idUser')
            //->add('archive')
            //->add('nomResto')
            //->add('image')
            //->add('adresse')
            ->add("save",SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
