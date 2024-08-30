<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Thematic;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'=> 'Titre',
                'attr' => [
                    'class' => 'form-control border-2 rounded-lg py-2.5 px-3.5',
                    'id' => 'titre',
                ],
                'row_attr' => [
                    'class' => 'form-row grid mb-8',
                ],
                'required' => true,
            ])
            ->add('imageFileQuestion', VichImageType::class,[
                'label'=> 'Image',
                'attr' => [
                    'class'=> 'form-control border-2 rounded-lg py-2.5 px-3.5',
                ],  
                'row_attr' => [
                    'class' => 'form-row grid mb-8',
                ],
                'required' => false,
            ])
            ->add('thematic_id', EntityType::class, [
                'class' => Thematic::class,
                'choice_label' => 'name',
                'label' => 'Thématique :',
                'attr' => [
                    'class'=> 'form-control border-2 rounded-lg py-2.5 px-3.5',
                ],
                'row_attr' => [
                    'class' => 'form-row grid mb-8',
                ],
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
            'data_class' => Question::class,
        ]);
    }
}
