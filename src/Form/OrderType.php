<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Carrier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user=$options['user'];
        $builder
            ->add('addresses',EntityType::class ,[
                'label' => false,
                'required'=>true,
                'choices'=> $user->getAddresses(),
                'class'=>Address::class,
                'multiple'=>false,
                'expanded'=>true
        ])

        ->add('carriers',EntityType::class ,[
        'label' => 'choisissez votre adresse de livraison',
        'required'=>true,
        'class'=>Carrier::class,
        'multiple'=>false,
        'expanded'=>true
    ])
            ->add('submit',SubmitType::class,[
                'label'=>'valider ma commande',
                'attr'=>[
                    'class'=>'btn btn-success btn-block'
                ]
            ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'user'=>array()
        ]);
    }
}
