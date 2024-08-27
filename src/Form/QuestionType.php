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
                    'class' => 'form-control',
                    'id' => 'titre',
                ],
                'required' => true,
            ])
            ->add('imageFileQuestion', VichImageType::class,[
                'label'=> 'Image',
                'attr' => [
                    'class'=> 'form-control',
                ],  
            ])
            ->add('thematic_id', EntityType::class, [
                'class' => Thematic::class,
                'choice_label' => 'name',
                'label' => 'Thématique :',
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn',
                ],
                'label' => 'Envoyer',
                'row_attr' => [
                    'class' => 'form-submit',
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
