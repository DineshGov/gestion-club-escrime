<?php

namespace App\Form;

use App\Entity\Arme;
use App\Entity\Groupe;
use App\Entity\Membre;
use App\Entity\Niveau;
use App\Entity\Tireur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TireurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('membre', MembreType::class,[
                'label' => ' '

            ])
            ->add('blason')
            ->add('niveauSurclassement')
            ->add('niveau', EntityType::class, [
                'required' => true,
                'class' => Niveau::class,
                'choice_label' => 'categorie',
                'label' => 'Niveau',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('armes',EntityType::class,[

                'required' => true,
                'class' => Arme::class,
                'choice_label' => 'nom',
                'label' => 'Arme',
                'multiple' => true,
                'expanded' => false,

            ])
            ->add('groupe', EntityType::class, [
                'required' => true,
                'class' => Groupe::class,
                'choice_label' => 'nom',
                'label' => 'Groupe',
                'multiple' => false,
                'expanded' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tireur::class,
        ]);
    }
}
