<?php

namespace App\DataFixtures;

use App\Entity\Fournisseur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FournisseursFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fournisseurs = [
            ['THOMANN 1', 'Burgebrach, Allemagne', '+33-176-548-596'],
            ['YAMAHA 2', 'Tokyo, Japon', '+81 3-1234-5678'],
            ['WOODBRASS 3', 'saint-herlain, France', '01 86 65 03 03'],
            ['JUPITER 4', 'Marburg, Allemagne', '06421/989-0'],

        ];

        foreach ($fournisseurs as $index => [$nom, $adresse, $telephone]) {
            $fournisseur = new Fournisseur();
            $fournisseur->setNom($nom);
            $fournisseur->setAdresse($adresse);
            $fournisseur->setTelephone($telephone);

            $manager->persist($fournisseur);

            // Ajouter la reference des lien avec les produits

            $this->addReference('fournisseur_' . ($index + 1), $fournisseur);
        }


        $manager->flush();
    }
}
