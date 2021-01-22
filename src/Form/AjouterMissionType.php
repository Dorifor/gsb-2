<?php

namespace App\Form;

use App\Entity\Hebergement;
use App\Entity\Mission;
use App\Entity\Transport;
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
            ->add('destination', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nom',
            ])
            ->add('date_debut')
            ->add('date_fin')
            ->add('transport', EntityType::class, [
                'class' => Transport::class,
                'choice_label' => 'libelle'
            ])
            ->add('prx_transport')
            ->add('hebergement', EntityType::class, [
                'class' => Hebergement::class,
                'choice_label' => 'libelle'
            ])
            ->add('just_heb')
            ->add('notes');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
