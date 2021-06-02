<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Ville;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AjouterUtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('password')
            ->add('roles', CollectionType::class, [
                'entry_type' => ChoiceType::class,
                'entry_options' => [
                    'choices' => [
                        'Comptable' => 'ROLE_comptable',
                        'Visiteur' => 'ROLE_visiteur',
                        'Admin' => 'ROLE_admin'
                    ]
                ]
            ])
            ->add('adresse')
            ->add('naissance')
            ->add('ville', AutocompleteType::class, ['class' => Ville::class]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
