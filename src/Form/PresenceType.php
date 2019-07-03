<?php

namespace App\Form;

use App\Entity\Presence;
use App\Entity\Entrainement;
use App\Entity\Tireur;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entrainement', EntityType::class, [
                'required' => true,
                'class' => Entrainement::class,
                'choice_label' => 'id',
                'label' => 'Entrainement',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('tireursPresents', EntityType::class, [
                'required' => true,
                'class' => Tireur::class,
                'choice_label' => 'membre',
                'label' => 'Tireurs presents',
                'multiple' => true,
                'expanded' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Presence::class,
        ]);
    }
}
