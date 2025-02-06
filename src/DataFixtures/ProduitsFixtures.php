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
    public function __construct(private SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        $produits = [
            // Basses Acoustiques/semi Acoustiques
            ['Basses Acoustiques 4 Cordes  ', 'Guitar en bois de qualité supérieure.', 144, 20, 'basseAcoust1.jpg', 'category_guitar', 'fournisseur_1'],
            ['Basses Acoustiques 5 Cordes', 'Guitar en bois de qualité supérieure.', 168, 20, 'basseAcoust2.jpg', 'category_guitar', 'fournisseur_2'],
            ['Basses Acoustiques 6 Cordes', ' en bois de qualité supérieure.', 199, 20, 'basseAcoust3.jpg', 'category_guitar', 'fournisseur_3'],
            ['Basses Acoustiques Gaucher ', ' en bois de qualité supérieure.', 148, 20, 'basseAcoust4.jpg', 'category_guitar', 'fournisseur_4'],
            ['Basses Acoustiques Fretless ', ' en bois de qualité supérieure.', 698, 20, 'basseAcoust5.jpg', 'category_guitar', 'fournisseur_3'],


            // Guitar Clasiques
            ['1/8 Taille Guitar', 'Bettery en bois de qualité supérieure.', 100, 20, 'git5.jpg', 'category_guitar', 'fournisseur_2'],
            ['1/4 Taille Guitar ', 'Bettery en bois de qualité supérieure.', 128, 20, 'git6.jpg', 'category_guitar', 'fournisseur_2'],
            ['1/2 Taille Guitar', 'Bettery en bois de qualité supérieure.', 170, 20, 'git7.jpg', 'category_guitar', 'fournisseur_2'],
            ['3/4 Taille Guitar', 'Bettery en bois de qualité supérieure.', 117, 20, 'git8.jpg', 'category_guitar', 'fournisseur_2'],
            ['7/8 Taille Guitar', 'Bettery en bois de qualité supérieure.', 110, 20, 'git9.jpg', 'category_guitar', 'fournisseur_2'],



            // Guitares Acoustiques & Electro-Acoustique
            ['Guitares Dreadnought ', 'Guitare de qualité supérieure.', 1000, 20, 'git10.jpg', 'category_guitar', 'fournisseur_3'],
            ['Guitars Jumbo', 'Guitare de qualité supérieure.', 1500, 20, 'git11.jpg', 'category_guitar', 'fournisseur_3'],
            ['Guitares Folk', 'Guitare de qualité supérieure.', 1500, 20, 'git12.jpg', 'category_guitar', 'fournisseur_3'],
            ['Tailles  0.00.000  ', 'Guitare de qualité supérieure.', 1500, 20, 'git13.jpg', 'category_guitar', 'fournisseur_3'],
            ['Guitares Roundback', 'Guitare de qualité supérieure.', 1500, 20, 'git14.jpg', 'category_guitar', 'fournisseur_3'],




            // Basses Electriques
            ['Basses Jazz 4 Cordes ', 'Guitare de qualité supérieure.', 500, 20, 'git15.jpg', 'category_guitar', 'fournisseur_3'],
            ['Basses Jazz 5 Cordes ', 'Guitare de qualité supérieure.', 500, 20, 'git16.jpg', 'category_guitar', 'fournisseur_3'],
            ['Basses Percision 4 Cordes ', 'Guitare de qualité supérieure.', 500, 20, 'git17.jpg', 'category_guitar', 'fournisseur_3'],
            ['Basses Percision 5 Cordes ', 'Guitare de qualité supérieure.', 500, 20, 'git18.jpg', 'category_guitar', 'fournisseur_3'],
            ['Basses 6 Cordes ', 'Guitare de qualité supérieure.', 500, 20, 'git19.jpg', 'category_guitar', 'fournisseur_3'],




            // Percussions Classiques
            ['Xylophones', 'Bettery en bois de qualité supérieure.', 700, 20, 'percussionclas1.jpg', 'category_bettery', 'fournisseur_4'],
            ['Métallophones', 'Bettery en bois de qualité supérieure.', 550, 20, 'percussionclas2.jpg', 'category_bettery', 'fournisseur_4'],
            ['Marimbas', 'Bettery en bois de qualité supérieure.', 550, 20, 'percussionclas3.jpg', 'category_bettery', 'fournisseur_4'],
            ['Vibraphones', 'Bettery en bois de qualité supérieure.', 580, 20, 'percussionclas4.jpg', 'category_bettery', 'fournisseur_4'],
            ['Carillons', 'Bettery en bois de qualité supérieure.', 550, 20, 'percussionclas5.jpg', 'category_bettery', 'fournisseur_4'],





            // Batery elctronic
            ['Batteries Electroniques Complètes ', 'Bettery en bois de qualité supérieure.', 1850, 20, 'battarieElec1.jpg', 'category_bettery', 'fournisseur_4'],
            ['Pads de Charleston', 'Bettery en bois de qualité supérieure.', 1300, 20, 'battarieElec2.jpg', 'category_bettery', 'fournisseur_4'],
            ['Pads de Caisse Claire ', 'Bettery en bois de qualité supérieure.', 1000, 20, 'battarieElec3.jpg', 'category_bettery', 'fournisseur_4'],
            ['Peaux Maillées', 'Bettery en bois de qualité supérieure.', 1900, 20, 'battarieElec4.jpg', 'category_bettery', 'fournisseur_4'],
            ['Pads Cymbale', 'Bettery en bois de qualité supérieure.', 1390, 20, 'battarieElec5.jpg', 'category_bettery', 'fournisseur_4'],





            // Percussions
            ['Congas', 'Bettery en bois de qualité supérieure.', 740, 20, 'Percussions1.jpg', 'category_bettery', 'fournisseur_2'],
            ['Bongos', 'Bettery en bois de qualité supérieure.', 960, 20, 'Percussions2.jpg', 'category_bettery', 'fournisseur_2'],
            ['Djembés', 'Bettery en bois de qualité supérieure.', 950, 20, 'Percussions3.jpg', 'category_bettery', 'fournisseur_2'],
            ['Tambours à main', 'Bettery en bois de qualité supérieure.', 950, 20, 'Percussions4.jpg', 'category_bettery', 'fournisseur_2'],
            ['Timbales', 'Bettery en bois de qualité supérieure.', 965, 20, 'Percussions5.jpg', 'category_bettery', 'fournisseur_2'],





            // Percussions de Défilé
            ['Caisses Claires de Défilé ', 'Bettery en bois de qualité supérieure.', 1450, 20, 'PercussionsdeDéfilé1.jpg', 'category_bettery', 'fournisseur_1'],
            ['Grosses Caisses de Défilé', 'Bettery en bois de qualité supérieure.', 1650, 20, 'PercussionsdeDéfilé2.jpg', 'category_bettery', 'fournisseur_2'],
            ['Toms de Défilé', 'Bettery en bois de qualité supérieure.', 1650, 20, 'PercussionsdeDéfilé3.jpg', 'category_bettery', 'fournisseur_2'],
            ['Cymbales de Défilé', 'Bettery en bois de qualité supérieure.', 1650, 20, 'PercussionsdeDéfilé4.jpg', 'category_bettery', 'fournisseur_2'],
            ['Lyres', 'Bettery en bois de qualité supérieure.', 1650, 20, 'PercussionsdeDéfilé5.jpg', 'category_bettery', 'fournisseur_2'],




            // Orgues Liturgiques
            ['Orgues Liturgiques 1 Clavier ', 'orgue de qualité supérieure.', 1500, 20, 'OrguesLiturgiques1.jpg', 'category_piano', 'fournisseur_3'],
            ['Orgues Liturgiques 2 Clavier ', 'orgue de qualité supérieure.', 1500, 20, 'OrguesLiturgiques2.jpg', 'category_piano', 'fournisseur_3'],
            ['Orgues Liturgiques 3 Clavier ', 'orgue de qualité supérieure.', 1500, 20, 'OrguesLiturgiques3.jpg', 'category_piano', 'fournisseur_3'],
            ['Orgues Liturgiques Simple ', 'orgue de qualité supérieure.', 1500, 20, 'OrguesLiturgiques.jpg4', 'category_piano', 'fournisseur_3'],
            ['Accessoires pour Orgues Liturgiques ', 'accessoires de qualité supérieure.', 1500, 20, 'OrguesLiturgiques5.jpg', 'category_piano', 'fournisseur_3'],





            // Orgues Electroniques
            ['Viscount Legend Soul 273', 'orgue de qualité supérieure.', 1500, 20, 'OrguesElectroniques1.jpg', 'category_piano', 'fournisseur_1'],
            ['Yamaha YC73', 'orgue de qualité supérieure.', 4500, 20, 'OrguesElectroniques2.jpg', 'category_piano', 'fournisseur_1'],
            ['Roland VR-09 V-Combo B', 'orgue de qualité supérieure.', 4100, 20, 'OrguesElectroniques3.jpg', 'category_piano', 'fournisseur_1'],
            ['Viscount Legend Live', 'orgue de qualité supérieure.', 1500, 20, 'OrguesElectroniques4.jpg', 'category_piano', 'fournisseur_1'],
            ['Crumar Mojo 61', 'orgue de qualité supérieure.', 4500, 20, 'OrguesElectroniques5.jpg', 'category_piano', 'fournisseur_1'],





            // Pianos Droits
            ['Yamaha B3 PE', ' de qualité supérieure.', 470, 20, 'PianosDroits1.jpg', 'category_piano', 'fournisseur_2'],
            ['Thomann UP 121 E/P Piano', 'de qualité supérieure.', 1270, 20, 'PianosDroits.jpg2', 'category_piano', 'fournisseur_2'],
            ['Kawai K-200 ATX 4 E/P Piano', 'de qualité supérieure.', 1470, 20, 'PianosDroits3.jpg', 'category_piano', 'fournisseur_2'],
            ['Yamaha b1 PE', ' de qualité supérieure.', 1470, 20, 'PianosDroits4.jpg', 'category_piano', 'fournisseur_2'],
            ['Yamaha U1 SH3 PE silent Piano', 'de qualité supérieure.', 8580, 20, 'PianosDroits5.jpg', 'category_piano', 'fournisseur_3'],





            // Accordéons
            ['Accordéons Pianos ', 'de qualité supérieure.', 750, 20, 'Accordéons1.jpg', 'category_piano', 'fournisseur_2'],
            ['Accordéons à Boutons', 'de qualité supérieure.', 700, 20, 'Accordéons2.jpg', 'category_piano', 'fournisseur_2'],
            ['Accordéons de styrie', 'de qualité supérieure.', 700, 20, 'Accordéons3.jpg', 'category_piano', 'fournisseur_2'],
            ['Accordéons Spéciaux', 'de qualité supérieure.', 785, 20, 'Accordéons4.jpg', 'category_piano', 'fournisseur_2'],
            ['Bretelles d\'Accordéons', 'de qualité supérieure.', 412, 20, 'Accordéons5.jpg', 'category_piano', 'fournisseur_2'],





            // Instruments à Cordes Frottées
            ['Violons Acoustiques', 'de qualité supérieure.', 500, 20, 'InstrumentsàCordesFrottées1.jpg', 'category_traditionnel', 'fournisseur_4'],
            ['Violoncelles Acoustiques', 'de qualité supérieure.', 200, 20, 'InstrumentsàCordesFrottées2.jpg', 'category_traditionnel', 'fournisseur_4'],
            ['Contrebasses Acoustiques', 'de qualité supérieure.', 200, 20, 'InstrumentsàCordesFrottées3.jpg', 'category_traditionnel', 'fournisseur_4'],
            ['Altos Acoustiques', 'de qualité supérieure.', 200, 20, 'InstrumentsàCordesFrottées4.jpg', 'category_traditionnel', 'fournisseur_4'],
            ['Archets', 'de qualité supérieure.', 400, 20, 'InstrumentsàCordesFrottées5.jpg', 'category_traditionnel', 'fournisseur_4'],





            // Instruments de Folklore
            ['Harpe', 'de qualité supérieure.', 410, 20, 'InstrumentsdeFolklore1.jpg', 'category_traditionnel', 'fournisseur_3'],
            ['Luths', 'de qualité supérieure.', 457, 20, 'InstrumentsdeFolklore2.jpg', 'category_traditionnel', 'fournisseur_3'],
            ['Baglamas', 'de qualité supérieure.', 471, 20, 'InstrumentsdeFolklore3.jpg', 'category_traditionnel', 'fournisseur_3'],
            ['Bouzoukis Grecs', 'de qualité supérieure.', 400, 20, 'InstrumentsdeFolklore4.jpg', 'category_traditionnel', 'fournisseur_3'],
            ['Villes à Roue', 'de qualité supérieure.', 400, 20, 'InstrumentsdeFolklore5.jpg', 'category_traditionnel', 'fournisseur_3'],






            // Méditations & Thérapie Musicale
            ['Handpans & Steel Tongue Drums', 'de qualité supérieure.', 470, 20, 'MéditationsThérapieMusicale1.jpg', 'category_traditionnel', 'fournisseur_3'],
            ['Energy Chimes', 'de qualité supérieure.', 400, 20, 'MéditationsThérapieMusicale.jpg', 'category_traditionnel', 'fournisseur_3'],
            ['Wind Gongs', 'de qualité supérieure.', 410, 20, 'MéditationsThérapieMusicale.jpg', 'category_traditionnel', 'fournisseur_3'],
            ['Tam Tam/Gongs', 'de qualité supérieure.', 500, 20, 'MéditationsThérapieMusicale.jpg', 'category_traditionnel', 'fournisseur_3'],
            ['Bols Chantants', 'de qualité supérieure.', 400, 20, 'MéditationsThérapieMusicale.jpg', 'category_traditionnel', 'fournisseur_3'],



            // Clarinettes
            ['Clarinettes en Sib (Système Allemand) ', 'de qualité supérieure.', 170, 20, 'Clarinettes1.jpg', 'category_vent', 'fournisseur_3'],
            ['Clarinettes en Sib (Système Boehm) ', 'de qualité supérieure.', 140, 20, 'Clarinettes2.jpg', 'category_vent', 'fournisseur_3'],
            ['Clarinettes en Mib (Système Allemand) ', 'de qualité supérieure.', 160, 20, 'Clarinettes3.jpg', 'category_vent', 'fournisseur_3'],
            ['Clarinettes en Mib (Système Boehm) ', 'de qualité supérieure.', 150, 20, 'Clarinettes4.jpg', 'category_vent', 'fournisseur_3'],
            ['Clarinettes en La (Système Allemand) ', 'de qualité supérieure.', 190, 20, 'Clarinettes4.jpg', 'category_vent', 'fournisseur_3'],



            // Trompettes
            ['Trompettes à Pistons en Sib', 'Bettery en bois de qualité supérieure.', 180, 20, 'Trompettes1.jpg', 'category_vent', 'fournisseur_2'],
            ['Trompettes à Piston en Ut', 'Bettery en bois de qualité supérieure.', 130, 20, 'Trompettes2.jpg', 'category_vent', 'fournisseur_2'],
            ['Trompettes à Palettes en Sib', 'Bettery en bois de qualité supérieure.', 140, 20, 'Trompettes3.jpg', 'category_vent', 'fournisseur_2'],
            ['Trompettes à Palettes en Ut', 'Bettery en bois de qualité supérieure.', 150, 20, 'Trompettes4.jpg', 'category_vent', 'fournisseur_2'],
            ['Trompettes Piccolos', 'Bettery en bois de qualité supérieure.', 200, 20, 'Trompettes4.jpg', 'category_vent', 'fournisseur_2'],




            // Trombone
            ['Trombone Ténors', 'de qualité supérieure.', 400, 20, 'Trombone1.jpg', 'category_vent', 'fournisseur_4'],
            ['Trombone Ténor avec Rotor', 'de qualité supérieure.', 400, 20, 'Trombone2.jpg', 'category_vent', 'fournisseur_4'],
            ['Trombone Basse', 'de qualité supérieure.', 410, 20, 'Trombone3.jpg', 'category_vent', 'fournisseur_4'],
            ['Trombone Alto', 'de qualité supérieure.', 450, 20, 'Trombone4.jpg', 'category_vent', 'fournisseur_4'],
            ['Trombone à Piston ', 'de qualité supérieure.', 470, 20, 'Trombone5.jpg', 'category_vent', 'fournisseur_4'],




            // Cors D\'Harmonie
            ['Cors D\'Harmonie en Sib', 'de qualité supérieure.', 410, 20, 'CorsHarmonie1.jpg', 'category_vent', 'fournisseur_2'],
            ['Cors D\'Harmonie en Fa', 'de qualité supérieure.', 450, 20, 'CorsHarmonie2.jpg', 'category_vent', 'fournisseur_2'],
            ['Cors D\'Harmonie en Double', 'de qualité supérieure.', 470, 20, 'CorsHarmonie3.jpg', 'category_vent', 'fournisseur_2'],








            // Tuba
            ['Tuba en Sib', 'de qualité supérieure.', 410, 20, 'Tuba1.jpg', 'category_vent', 'fournisseur_3'],
            ['Tuba en Fa', 'de qualité supérieure.', 450, 20, 'Tuba2.jpg', 'category_vent', 'fournisseur_3'],
            ['Tuba en Mib', 'de qualité supérieure.', 410, 20, 'Tuba3.jpg', 'category_vent', 'fournisseur_3'],
            ['Tubas en Ut', 'de qualité supérieure.', 4570, 20, 'Tuba4.jpg', 'category_vent', 'fournisseur_3'],
            ['Sousaphone', 'de qualité supérieure.', 45700, 20, 'Tuba5.jpg', 'category_vent', 'fournisseur_3'],






            // Flûtes Traversieres
            ['Flûtes Traversières avec Plateaux Creux ', 'de qualité supérieure.', 400, 20, 'FlûtesTraversieres1.jpg', 'category_vent', 'fournisseur_1'],
            ['Flûtes Traversières avec Plateaux Pleins', 'de qualité supérieure.', 400, 20, 'FlûtesTraversieres2.jpg', 'category_vent', 'fournisseur_1'],
            ['Flûtes Traversières Altos & Basses', 'de qualité supérieure.', 410, 20, 'FlûtesTraversieres3.jpg', 'category_vent', 'fournisseur_1'],
            ['Flûtes Traversières Piccolos ', 'de qualité supérieure.', 570, 20, 'FlûtesTraversieres4.jpg', 'category_vent', 'fournisseur_1'],
            ['Flûtes Traversières en Bois ', 'de qualité supérieure.', 700, 20, 'FlûtesTraversieres5.jpg', 'category_vent', 'fournisseur_1'],




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
        // Récupérer la catégorie (en supposant que vous avez 4 catégories)
        $category = $this->getReference('cat-' . mt_rand(1, 4), Categories::class);
        $produit->setCategories($category);

        // Corriger la référence du fournisseur pour utiliser le format correct
        $fournisseur = $this->getReference($fournisseurReference, Fournisseur::class); // Le format du fournisseur est déjà correct, donc on l'utilise directement
        dump($fournisseur->getId());


        // MATTER ???????
        $produit->setReferenceFournisseur($fournisseur->getId());

        // Enregistrer la référence du produit pour réutilisation
        $this->setReference('prod-' . strtolower(str_replace(' ', '-', $nom)), $produit);

        $manager->persist($produit);
    }

    public function getDependencies(): array
    {
        return [
            CategoriesFixtures::class,
            FournisseursFixtures::class,
        ];
    }
}
