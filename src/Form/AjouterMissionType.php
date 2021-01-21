<?php

namespace App\Form;

use App\Entity\Hebergement;
use App\Entity\Mission;
use App\Entity\User;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjouterMissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('date_debut')
            ->add('date_fin')
            ->add('notes')
            ->add('destination', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nom',
            ])
<<<<<<< HEAD
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'nom',
            // ])
            ->add('hebergement', EntityType::class, [
                'class' => Hebergement::class,
                'choice_label' => 'libelle'
            ]);
=======
            // ->add('hebergement', EntityType::class, [
            //     'label' => 'Hébergement',
            //     'class' => Hebergement::class,
            //     'choice_label' => 'libelle'
            // ])
            ;
>>>>>>> ff58a5b4938c97d8794842fe59296b6e49746258
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
