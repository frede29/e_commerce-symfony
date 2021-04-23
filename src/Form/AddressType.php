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

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
               'label' =>'Quel nom souhaitez vous donner à votre adresse',
                'attr'=> [
                    'placeholder'=>'votre adresse'
                ]

                ])
            ->add('lastname',TextType::class,[
                'label' =>'votre prenom',
                'attr'=> [
                    'placeholder'=>'votre prenom'
                    ]
                ])
            ->add('firstname',TextType::class,[
                'label' =>'votre nom',
                'attr'=> [
                    'placeholder'=>'votre nom'
                    ]
                ])
            ->add('company',TextType::class,[
                'label' =>'votre compagnie',
                'required'=>false,
                'attr'=> [
                    'placeholder'=>'votre compagnie'
                    ]
                ])
            ->add('adress',TextType::class,[
                'label' =>'votre adresse',
                'attr'=> [
                    'placeholder'=>'votre adresse'
                    ]
                ])
            ->add('postal',TextType::class,[
                'label' =>'votre code postal',
                'attr'=> [
                    'placeholder'=>'votre code postal'
                    ]
                ])
            ->add('city',TextType::class,[
                'label' =>'votre ville',
                'attr'=> [
                    'placeholder'=>'votre ville'
                    ]
                ])
            ->add('country',CountryType::class,[
                'label' =>'votre pays',
                'attr'=> [
                    'placeholder'=>'votre pays'
                    ]
                ])

            ->add('phone',TelType::class,[
                'label' =>'votre telephone',
                'attr'=> [
                    'placeholder'=>'votre telephone'
                ]
            ])
            ->add('submit',SubmitType::class,[
                'label'=>'valider votre adresse',
                'attr'=> [
                'class'=>'btn-block btn-info'
            ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
