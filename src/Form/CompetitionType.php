<?php

namespace App\Form;

use App\Entity\Arbitre;
use App\Entity\Competition;
use App\Entity\Niveau;
use App\Entity\Tireur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('date')
            ->add('ville')
            ->add('tireurs',EntityType::class,[
                'required' => true,
                'class' => Tireur::class,
                'choice_label' => 'membre.nomPrenom',
                'label' => 'Tireurs',
                'multiple' => true,
                'expanded' => false,
            ])
            ->add('niveau', EntityType::class, [
                'required' => true,
                'class' => Niveau::class,
                'choice_label' => 'categorie',
                'label' => 'Niveau',
                'multiple' => true,
                'expanded' => false,
            ])
            ->add('arbitres',EntityType::class,[
                'required' => true,
                'class' => Arbitre::class,
                'choice_label' =>'membre.nomPrenom',
                'label' =>'Arbitres',
                'multiple' => true,
                'expanded' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Competition::class,
        ]);
    }
}
