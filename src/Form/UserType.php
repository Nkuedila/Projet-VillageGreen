<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\UsersType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('adresse')
            ->add('codepostal')
            ->add('ville')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'User' => 'ROLE_USER',
                    'Commercial' => 'ROLE_COMMERCIAL',
                    'Client_Particulier' => 'ROLE_CLIENT_PARTICULIER',
                    'Client_Professionnel' => 'ROLE_CLIENT_PROFESSIONEL'


                ],
                'multiple' => true,  // Permet de sélectionner plusieurs rôles
                'expanded' => false, // Affichage sous forme de menu déroulant (mettre true pour des checkboxes)
            ])
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
           ->add('numeroSiret')
            ->add('userstype', EntityType::class, [
                'class' => UsersType::class,
                'choice_label' => 'id',
            ])
    
            ->add('Password')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}