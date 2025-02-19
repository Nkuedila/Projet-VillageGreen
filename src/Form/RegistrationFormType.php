<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\UsersType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, ['attr' => ['class' => 'form-control'], 'label' => 'E-mail'])
            ->add('password', PasswordType::class, ['attr' => ['class' => 'form-control'], 'label' => 'Mot de Passe'])
            ->add('nom', TextType::class, ['attr' => ['class' => 'form-control'], 'label' => 'Nom'])
            ->add('prenom', TextType::class, ['attr' => ['class' => 'form-control'], 'label' => 'Prénom'])
            ->add('adresse', TextType::class, ['attr' => ['class' => 'form-control'], 'label' => 'Adresse'])
            ->add('codepostal', TextType::class, ['attr' => ['class' => 'form-control'], 'label' => 'Code Postal'])
            ->add('ville', TextType::class, ['attr' => ['class' => 'form-control'], 'label' => 'Ville'])
            ->add('userstype', EntityType::class, [
                'class' => UsersType::class,
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionnez un type de compte',
                'attr' => ['class' => 'form-control'],
                'label' => 'Type de compte'
            ])
            ->add('numeroSiret');

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $user = $event->getData();
            $form = $event->getForm();

            if (!$user) {
                return;
            }

            // Ensure usertype is properly referenced before checking its value
            if ($user->getUserstype() && $user->getUserstype()->getNom() === 'Professionnel') {
                $form->add('numeroSiret', IntegerType::class, [
                    'attr' => ['class' => 'form-control'],
                    'label' => 'Numéro SIRET',
                    'required' => true,
                ]);
            }
        });
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class
        ]);
    }
}
