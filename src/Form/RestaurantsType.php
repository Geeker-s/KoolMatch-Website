<?php

namespace App\Form;
use App\Entity\Restaurant;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\File;

class RestaurantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomRestaurant',TextType::class, [
                'required'=>true,
                'constraints'=>[new Length(['min'=>3 ])]
                ])

            ->add('adresseRestaurant')
            ->add('telephoneRestaurant',TextType::class,
            ['required'=>true,
             'constraints'=>[new Length(['max'=>8 ])]])
            ->add('sitewebRestaurant')
            ->add('specialiteRestaurant')
           // ->add('idGerant')
           ->add('image', FileType::class, array('data_class' => null))


            //->add('archive')
            ->add('nbPlaceresto')
            //->add('imageStructureResturant',textType::class,['required'=>true, 'constraints'=>[new Length(['min'=>3 ])]
            ->add('description')
            ->add('lien')
            ->add("save",SubmitType::class)
            ;
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
