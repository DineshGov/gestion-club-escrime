<?php

namespace App\Form;

use App\Entity\Entrainement;
use App\Entity\Lecon;
use App\Entity\MaitreArme;
use App\Entity\Membre;
use App\Entity\Tireur;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LeconType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entrainement', EntityType::class, [
                'required' => true,
                'class' => Entrainement::class,
                'choice_label' => 'id',
                'label' => 'entrainement',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('entraineur', EntityType::class, [
                'required' => true,
                'class' => MaitreArme::class,
                'choice_label' => 'membre',
                'label' => 'entraineur',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('tireur', EntityType::class, [
                'required' => true,
                'class' => Tireur::class,
                'choice_label' => 'membre',
                'label' => 'tireur',
                'multiple' => false,
                'expanded' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lecon::class,
        ]);
    }
}
