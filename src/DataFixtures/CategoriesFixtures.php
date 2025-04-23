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

        $parent = $this->createCategory('Guitares & Bases', 'guitarEtBasse.jpg', 'c1', null, $manager);


        // Sous-catégories associées à la catégorie parente
        $this->createCategory('Basses Acoustiques/semi Acoustiques', 'basseA.jpg', 'category_guitar1', $parent, $manager);
        $this->createCategory('Guitares Clasiques', 'guitarClass.jpg', 'category_guitar2', $parent, $manager);
        $this->createCategory('Guitares Acoustiques & Electro-Acoustique', 'guitarAcouElec.jpg', 'category_guitar3',  $parent, $manager);
        $this->createCategory('Basses Electriques', 'baselec.jpg', 'category_guitar4',  $parent, $manager);




        $parent = $this->createCategory('Batteries & Percussions', 'Batteriespercussions.jpg', 'c2', null, $manager);


        // Sous-catégories associées à la catégorie parente

        $this->createCategory('Percussions Classiques', 'percussionsclassiques.jpg', 'category_bettery1',  $parent, $manager);
        $this->createCategory('Batteries Electroniques', 'batterieselectroniques.jpg', 'category_bettery2',  $parent, $manager);
        $this->createCategory('Percussions', 'percussions.jpg', 'category_bettery3', $parent, $manager);
        $this->createCategory('Percussions de Défilé ', 'percussionsdéfilé.jpg', 'category_bettery4',  $parent, $manager);



        $parent = $this->createCategory('Pianos & Clavier', 'pianoetclavier.jpg', 'c3', null, $manager);


        // Sous-catégories associées à la catégorie parente

        $this->createCategory('Orgues Liturgiques', 'orgueliturgies.jpg', 'category_piano1', $parent, $manager);
        $this->createCategory('Orgues Electroniques', 'orgueselectroniques.jpg', 'category_piano2', $parent, $manager);
        $this->createCategory('Pianos Droits', 'pianosdroits.jpg', 'category_piano3', $parent, $manager);
        $this->createCategory('Accordéons', 'accordéons.jpg', 'category_piano4', $parent, $manager);



        $parent = $this->createCategory('Instruments Traditionnels', 'instrumentstraditionnels.jpg', 'c4', null, $manager);


        // Sous-catégories associées à la catégorie parente

        $this->createCategory('Instruments à Cordes Frottées', 'cordefrotté.jpg', 'category_traditionnel1', $parent, $manager);
        $this->createCategory('Instruments de Folklore', 'folk.jpg', 'category_traditionnel2', $parent, $manager);
        $this->createCategory('Méditations & Thérapie Musicale', 'meditation.jpg', 'category_traditionnel3', $parent, $manager);






        $parent = $this->createCategory('Instruments à Vent', 'instrumentvent.jpg', 'c5', null, $manager);

        // Sous-catégories associées à la catégorie parente

        $this->createCategory('Clarinettes', 'clarinette.jpg', 'category_vent1', $parent, $manager);
        $this->createCategory('Trompettes', 'trompette.jpg', 'category_vent2', $parent, $manager);
        $this->createCategory('Trombones', 'trombone.jpg', 'category_vent3', $parent, $manager);
        $this->createCategory('Cors D\'Harmonie', 'corsHarmonie.jpg', 'category_vent4', $parent, $manager);
        $this->createCategory('Tuba', 'tuba.jpg', 'category_vent5', $parent, $manager);
        $this->createCategory('Flûtes Traversieres', 'flutestraversiere.jpg', 'category_vent6', $parent, $manager);





        $parent = $this->createCategory('Studio', 'studio.jpg', 'c6', null, $manager);

        // Sous-catégories associées à la catégorie parente

        $this->createCategory('microphone', 'microphone.jpg', 'category_studio1', $parent, $manager);
        $this->createCategory('Enceintes de Monitoring ', 'monitoring.jpg', 'category_studio2', $parent, $manager);
        $this->createCategory('Controleur', 'controleur.jpg', 'category_studio3', $parent, $manager);
        $this->createCategory('Interface Audio', 'interface.jpg', 'category_studio4', $parent, $manager);
        $this->createCategory('Casque', 'casque.jpg', 'category_studio5', $parent, $manager);






        $manager->flush();
    }

    /**
     * Crée une catégorie avec un nom, une photo et un parent facultatif
     */
    public function createCategory(string $nom, string $image, string $reference, ?Categories $parent, ObjectManager $manager): Categories
    {
        $category = new Categories();
        $category->setNom($nom);
        $category->setImage($image);
        $category->setSlug($this->slugger->slug($nom)->lower());
        $category->setParent($parent);

        $manager->persist($category);

        $this->addReference($reference, $category);
        $this->counter++;



        return $category;
    }
}
