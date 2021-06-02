<?php

namespace App\Form;

use DateTime;
use App\Entity\User;
use App\Entity\Ville;
use App\Entity\Mission;
use App\Entity\Transport;
use App\Entity\Hebergement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AjouterMissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $date = new DateTime();
        $builder
            ->add('libelle')
            ->add('destination', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nom',
            ])
            ->add('date_debut', DateType::class, [
                'widget' => 'choice',
                'years' => range($date->format('Y'), $date->format('Y') + 1),
                'days' => range($date->format('d'), $date->format('t')),
                'months' => range($date->format('m'), 12),
                'format' => 'dMy',
                'attr' => ['class' => 'js-date']
            ])
            ->add('date_fin', DateType::class, [
                'widget' => 'choice',
                'years' => range($date->format('Y'), $date->format('Y') + 1),
                'days' => range($date->format('d'), $date->format('t')),
                'months' => range($date->format('m'), 12),
                'format' => 'dMy',
                'attr' => ['class' => 'js-date']
            ])
            ->add('transport', EntityType::class, [
                'class' => Transport::class,
                'choice_label' => 'libelle'
            ])
            ->add('prx_transport')
            ->add('hebergement', EntityType::class, [
                'class' => Hebergement::class,
                'choice_label' => 'libelle'
            ])
            ->add('just_heb', FileType::class, [
                'label' => 'Justification PDF',
                'attr' => [
                    'placeholder' => 'Choisissez un fichier'
                ],
                'required' => false,
                'data_class' => null
            ])
            ->add('notes');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
