<?php

namespace App\Form;

use App\Entity\Objectif;
use App\Entity\Membre;
use App\Entity\Tireur;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjectifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('objectif')
            ->add('atteint')
            ->add('tireur', EntityType::class, [
                'required' => true,
                'class' => Tireur::class,
                'choice_label' => 'membre',
                'label' => 'tireur',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('attribuePar', EntityType::class, [
                'required' => true,
                'class' => Membre::class,
                'choice_label' => 'nom',
                'label' => 'Attribué par',
                'multiple' => false,
                'expanded' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Objectif::class,
        ]);
    }
}
