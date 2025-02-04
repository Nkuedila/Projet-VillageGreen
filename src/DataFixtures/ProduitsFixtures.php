<?php

namespace App\DataFixtures;

use App\Entity\Produits;
use App\Entity\Categories;
use App\Entity\Fournisseur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProduitsFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
         $produits = [
            // Instruments à
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],



            // Instruments à

            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],


            //percussion

            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],
            ['nom', 'description', 'prix', 'stock', 'image', 'category_cordes', 'fournisseur1'],

         ];
         foreach ($produits as [$nom, $description, $prix, $stock, $image, $categoryReference, $fournisseurReference]) {
            $this->createProduit($nom, $description, $prix, $stock, $image, $categoryReference, $fournisseurReference, $manager);
         }

        $manager->flush();
    }

    private function createProduit(
        string $nom,
        string $description,
        int $prix,
        int $stock,
        string $image,
        string $categoryReference,
        string $fournisseurReference,
        ObjectManager $manager
    ): void {
        $produit = new Produits();
        $produit->setNom($nom);
        $produit->setDescription($description);
        $produit->setPrix($prix);
        $produit->setStock($stock);
        $produit->setImage($image);
        $produit->setSlug($this->slugger->slug($nom)->lower());

        //Récuperation des catégorie
        $category = $this->getReference('cat-' . mt_rand(1,4), Categories::class); // le formt du fournisseur est déjà correct, doct on l'ur=tilise
        $produit->setReferenceFournisseur($fournisseur->getId());

        //Enregistrer la référence du produit pour l'utilisation
        $this->setReference('prod-' . strtolower(str_replace('', '-', $nom)), $produit);

        $manager->persist($produit);

    }

    public function getDependencies(): array
    {
        return [
            CategoriesFixtures::class,
            FournisseurFixtures::class,

        ];
    }
}
