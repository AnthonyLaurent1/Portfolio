<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'p-3 rounded-3 mb-3 shadow-none',
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'p-3 rounded-3 mb-3 shadow-none',
                    'placeholder' => 'Description'
                ]
            ])
            ->add('url', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'p-3 rounded-3 mb-3 shadow-none',
                    'placeholder' => 'Url du site'
                ]
            ])
            ->add('linkGitHub', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'p-3 rounded-3 mb-3 shadow-none',
                    'placeholder' => 'Lien Github'
                ]
            ])
            ->add('category', EntityType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'p-3 rounded-3 mb-3 shadow-none',
                    'placeholder' => 'Nom'
                ],
                'class' => Category::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
