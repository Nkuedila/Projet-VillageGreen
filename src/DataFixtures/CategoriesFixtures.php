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
        $parent = $this->createCategory('Categories des Instruments', 'accueil.jpg', null, $manager);


        $this->createCategory('Les Instruments à vent', 'instruments-a-vent.jpg', $parent, $manager);
        $this->createCategory('Les Instruments à corde', 'instrumentCorde.jpg', $parent, $manager);
        $this->createCategory('La Percussion', 'percussion.jpg', $parent, $manager);




        $manager->flush();
    }



    public function createCategory(string $nom, string $image, ?Categories $parent, ObjectManager $manager): Categories
    {
        $category = new Categories();
        $category->setNom($nom);
        $category->setImage($image);

        $category->setSlug($this->slugger->slug($category->getNom())->lower());
        $category->setParent($parent);
        $manager->persist($category);

        $this->addReference('cat-' . $this->counter, $category);
        $this->counter++;

        return $category;
    }
}
