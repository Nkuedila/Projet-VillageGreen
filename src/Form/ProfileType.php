<?php

// src/Form/ProfileType.php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'E-mail',
            ])
            ->add('password', PasswordType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Mot de Passe',
                'required' => false,  // This allows password to be optional (not required)
            ])
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom',
            ])
            ->add('prenom', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Prénom',
            ])
            ->add('adresse', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Adresse',
            ])
            ->add('codepostal', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Code Postal',
            ])
            ->add('ville', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Ville',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save Changes',
                'attr' => ['class' => 'btn btn-primary w-100 mt-3'],
            ]);

        // Conditionally add 'numeroSiret' based on user type
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $user = $event->getData();
            $form = $event->getForm();

            if (!$user) {
                return;
            }

          /*   if ($user->getUsertype() && $user->getUsertype()->getNom() === 'Professionnel') {
                $form->add('numeroSiret', IntegerType::class, [
                    'attr' => ['class' => 'form-control'],
                    'label' => 'Numéro SIRET',
                    'required' => true,
                ]);
            } */
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
