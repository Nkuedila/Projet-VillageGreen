<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Fournisseur;
use App\Entity\Produits;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('prix')
            ->add('stock')
            ->add('reference_fournisseur')
            ->add('image')
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('slug')
            ->add('categories', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'id',
            ])
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
