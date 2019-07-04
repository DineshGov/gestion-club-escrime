<?php

namespace App\Form;

use App\Entity\Entrainement;
use App\Entity\Groupe;
use App\Entity\MaitreArme;
use App\Entity\Membre;
use App\Entity\Tireur;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrainementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('groupe', EntityType::class, [
                'required' => true,
                'class' => Groupe::class,
                'choice_label' => 'nom',
                'label' => 'Groupe',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('entraineurs', EntityType::class, [
                'required' => true,
                'class' => MaitreArme::class,
                'choice_label' => 'membre',
                'label' => 'maitre d\'arme',
                'multiple' => false,
                'expanded' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entrainement::class,
        ]);
    }
}
