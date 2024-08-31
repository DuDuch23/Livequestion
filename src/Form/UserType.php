<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\PasswordHasher\Type\PasswordTypePasswordHasherExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label'=> 'Pseudo :',
                'attr' => [
                    'class' => 'form-control border-2 rounded-lg py-2.5 px-3.5',
                    'id' => 'username',
                ],
                'row_attr' => [
                    'class' => 'form-row grid mb-8',
                ],
                'required' => true,
            'constraints' => [
                new Length([
                    'min' => 3,
                    'max' => 50,
                    'minMessage' => 'Le pseudo doit contenir au moins {{ limit }} caractères.',
                    'maxMessage' => 'Le pseudo ne peut pas dépasser {{ limit }} caractères.',
                ]),
                new NotBlank([
                    'message' => 'Le pseudo ne peut pas être vide.',
                ]),
            ],
            ])
            ->add('email', EmailType::class, [
                'label'=> 'Email :',
                'attr' => [
                    'class' => 'form-control border-2 rounded-lg py-2.5 px-3.5',
                    'id' => 'email',
                ],
                'row_attr' => [
                    'class' => 'form-row grid mb-8',
                ],
                'required' => true,
                'constraints' => [
                    new Email([
                        'message' => 'Veuillez entrer une adresse email valide.',
                    ]),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'L\'email ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                    new NotBlank([
                        'message' => 'L\'email ne peut pas être vide.',
                    ]),
                ],
            ])
            ->add('imageFileUser', VichImageType::class, [
                'label'=> 'Photo de profil :',
                'attr' => [
                    'class' => 'form-control border-2 rounded-lg py-2.5 px-3.5',
                    'id' => 'titre',
                ],
                'row_attr' => [
                    'class' => 'form-row grid mb-8',
                ],
                'required' => false,
            ])
            ->add('password', PasswordType::class, [
                'label'=> 'Mot de passe :',
                'attr' => [
                    'class' => 'form-control border-2 rounded-lg py-2.5 px-3.5',
                    'id' => 'titre',
                ],
                'row_attr' => [
                    'class' => 'form-row grid mb-8',
                ],
                'required' => true,
                // 'constraints' => [
                //     new Length([
                //         'min' => 8,
                //         'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères.',
                //     ]),
                //     new Regex([
                //         'pattern' => '/[A-Z]/',
                //         'message' => 'Le mot de passe doit contenir au moins une majuscule.',
                //     ]),
                //     new Regex([
                //         'pattern' => '/\d/',
                //         'message' => 'Le mot de passe doit contenir au moins un chiffre.',
                //     ]),
                //     new Regex([
                //         'pattern' => '/[\W_]/',
                //         'message' => 'Le mot de passe doit contenir au moins un caractère spécial.',
                //     ]),
                // ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn form-control border-2 rounded-lg py-2.5 px-3.5',
                ],
                'label' => 'Envoyer',
                'row_attr' => [
                    'class' => 'form-submit grid',
                ],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
