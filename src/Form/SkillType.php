<?php

namespace App\Form;

use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('techno', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'p-3 rounded-3 mb-3 shadow-none',
                    'placeholder' => 'Stack'
                ]
            ])
            ->add('level', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'p-3 rounded-3 mb-3 shadow-none',
                    'placeholder' => 'Niveau'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
}
