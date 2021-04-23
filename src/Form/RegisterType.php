<?php

namespace App\Form;

use App\Entity\User;
use phpDocumentor\Reflection\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname' ,TextType::class,[
                'label'=>'prenom',
                'constraints'=>new Length([
                    'min'=> '4',
                    'max'=>'30'
                    ]),
                'attr'=> [
                    'placeholder'=>'votre prenom'
                ]
                ])
            ->add('lastname' ,TextType::class,[
                'label'=>'nom',
                'constraints'=>new Length([
                    'min'=> '4',
                    'max'=>'30'
                ]),
                'attr'=> [
                    'placeholder'=>'votre nom'
                ]
            ])
            ->add('email',EmailType::class,[
                'label'=>'email',
                'constraints'=>new Length([
                    'min'=> '4',
                    'max'=>'60'
                ]),

                'attr'=> [
                    'placeholder'=>'votre email'
                ]
            ])->add('password',RepeatedType::class,[
                'type'=>PasswordType::class,
                'invalid_message'=>'le mot de passe et la confirmation doivent etre identique',
                'label'=>'mot de passe',
                'required'=>true,
                'first_options'=>[
                    'label'=>'mot de passe',
                     'attr'=> [
               'placeholder'=>'votre mot de passe'
                     ]
                ],
                'second_options'=>[
                    'label'=>'confirmer votre mot de passe',
                    'attr'=> [
                        'placeholder'=>'confirmer votre mot de passe'
                    ]
                ]

            ])

            ->add('submit', SubmitType::class, [
                'label' => "S'incrire"
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
