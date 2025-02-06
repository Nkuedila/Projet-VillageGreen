<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{

    private $counter = 1;

    public function __construct(private SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        // Création de la catégorie parente

        $parent = $this->createCategory('Guitares & Bases', 'guitarEtBasse.jpg', null, $manager);


        // Sous-catégories associées à la catégorie parente
        $this->createCategory('Basses Acoustiques/semi Acoustiques', 'basseA.jpg', $parent, $manager);
        $this->createCategory('Guitares Clasiques', 'guitarClass.jpg', $parent, $manager);
        $this->createCategory('Guitares Acoustiques & Electro-Acoustique', 'guitarAcouElec.jpg', $parent, $manager);
        $this->createCategory('Basses Electriques', 'baselec.jpg', $parent, $manager);




        $parent = $this->createCategory('Batteries & Percussions', 'Batteriespercussions.jpg', null, $manager);


        // Sous-catégories associées à la catégorie parente

        $this->createCategory('Percussions Classiques', 'percussionsclassiques.jpg', $parent, $manager);
        $this->createCategory('Batteries Electroniques', 'batterieselectroniques.jpg', $parent, $manager);
        $this->createCategory('Percussions', 'percussions.jpg', $parent, $manager);
        $this->createCategory('Percussions de Défilé ', 'percussionsdéfilé.jpg', $parent, $manager);



        $parent = $this->createCategory('Pianos & Clavier', 'pianoetclavier.jpg', null, $manager);


        // Sous-catégories associées à la catégorie parente

        $this->createCategory('Orgues Liturgiques', 'orgueliturgies.jpg', $parent, $manager);
        $this->createCategory('Orgues Electroniques', 'orgueselectroniques.jpg', $parent, $manager);
        $this->createCategory('Pianos Droits', 'pianosdroits.jpg', $parent, $manager);
        $this->createCategory('Accordéons', 'accordéons.jpg', $parent, $manager);



        $parent = $this->createCategory('Instruments Traditionnels', 'instrumentvent.jpg', null, $manager);


        // Sous-catégories associées à la catégorie parente

        $this->createCategory('Instruments à Cordes Frottées', 'cordefrotté.jpg', $parent, $manager);
        $this->createCategory('Instruments de Folklore', 'folk.jpg', $parent, $manager);
        $this->createCategory('Méditations & Thérapie Musicale', 'meditation.jpg', $parent, $manager);






        $parent = $this->createCategory('Instruments à Vent', 'instumentvent.jpg', null, $manager);

        // Sous-catégories associées à la catégorie parente

        $this->createCategory('Clarinettes', 'clarinette.jpg', $parent, $manager);
        $this->createCategory('Trompettes', 'trompette.jpg', $parent, $manager);
        $this->createCategory('Trombones', 'trombone.jpg', $parent, $manager);
        $this->createCategory('Cors D\'Harmonie', 'corsHarmonie.jpg', $parent, $manager);
        $this->createCategory('Tuba', 'tuba.jpg', $parent, $manager);
        $this->createCategory('Flûtes Traversieres', 'flutestraversiere.jpg', $parent, $manager);



        $manager->flush();
    }

    /**
     * Crée une catégorie avec un nom, une photo et un parent facultatif
     */
    public function createCategory(string $nom, string $image, ?Categories $parent, ObjectManager $manager): Categories
    {
        $category = new Categories();
        $category->setNom($nom);
        $category->setImage($image);
        $category->setSlug($this->slugger->slug($nom)->lower());
        $category->setParent($parent);

        $manager->persist($category);

        $this->addReference('cat-' . $this->counter, $category);
        $this->counter++;



        return $category;
    }
}
