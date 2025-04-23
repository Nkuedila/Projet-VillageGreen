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
            ['Basses Acoustiques 4 Cordes  ', 'Guitar en bois de qualité supérieure.', 14400, 20, 'basseAcoust1.jpg', 'category_guitar1', 'fournisseur_1'],
            ['Basses Acoustiques 5 Cordes', 'Guitar en bois de qualité supérieure.', 16800, 20, 'basseAcoust2.jpg', 'category_guitar1', 'fournisseur_2'],
            ['Basses Acoustiques 6 Cordes', 'Guitar en bois de qualité supérieure.', 19900, 20, 'basseAcoust3.jpg', 'category_guitar1', 'fournisseur_3'],
            ['Basses Acoustiques Gaucher ', 'Guitar en bois de qualité supérieure.', 14800, 20, 'basseAcoust4.jpg', 'category_guitar1', 'fournisseur_4'],
            ['Basses Acoustiques Fretless ', 'Guitar en bois de qualité supérieure.', 69800, 20, 'basseAcoust5.jpg', 'category_guitar1', 'fournisseur_3'],


            // Guitar Clasiques
            ['1/8 Taille Guitar', 'Guitare de qualité supérieure.', 10000, 20, 'git5.jpg', 'category_guitar2', 'fournisseur_2'],
            ['1/4 Taille Guitar ', 'Guitare de qualité supérieure.', 12800, 20, 'git6.jpg', 'category_guitar2', 'fournisseur_2'],
            ['1/2 Taille Guitar', 'Guitare de qualité supérieure.', 17000, 20, 'git7.jpg', 'category_guitar2', 'fournisseur_2'],
            ['3/4 Taille Guitar', 'Guitare de qualité supérieure.', 11700, 20, 'git8.jpg', 'category_guitar2', 'fournisseur_2'],
            ['7/8 Taille Guitar', 'Guitare de qualité supérieure.', 11000, 20, 'git9.jpg', 'category_guitar2', 'fournisseur_2'],



            // Guitares Acoustiques & Electro-Acoustique
            ['Guitares Dreadnought ', 'Guitare de qualité supérieure.', 100000, 20, 'git10.jpg', 'category_guitar3', 'fournisseur_3'],
            ['Guitars Jumbo', 'Guitare de qualité supérieure.', 150000, 20, 'git11.jpg', 'category_guitar3', 'fournisseur_3'],
            ['Guitares Folk', 'Guitare de qualité supérieure.', 150000, 20, 'git12.jpg', 'category_guitar3', 'fournisseur_3'],
            ['Tailles  0.00.000  ', 'Guitare de qualité supérieure.', 150000, 20, 'git13.jpg', 'category_guitar3', 'fournisseur_3'],
            ['Guitares Roundback', 'Guitare de qualité supérieure.', 150000, 20, 'git14.jpg', 'category_guitar3', 'fournisseur_3'],




            // Basses Electriques
            ['Basses Jazz 4 Cordes ', 'Guitare de qualité supérieure.', 50000, 20, 'git15.jpg', 'category_guitar4', 'fournisseur_3'],
            ['Basses Jazz 5 Cordes ', 'Guitare de qualité supérieure.', 50000, 20, 'git16.jpg', 'category_guitar4', 'fournisseur_3'],
            ['Basses Percision 4 Cordes ', 'Guitare de qualité supérieure.', 50000, 20, 'git17.jpg', 'category_guitar4', 'fournisseur_3'],
            ['Basses Percision 5 Cordes ', 'Guitare de qualité supérieure.', 50000, 20, 'git18.jpg', 'category_guitar4', 'fournisseur_3'],
            ['Basses 6 Cordes ', 'Guitare de qualité supérieure.', 50000, 20, 'git19.jpg', 'category_guitar4', 'fournisseur_3'],




            // Percussions Classiques
            ['Xylophones', 'Batterie en bois de qualité supérieure.', 70000, 20, 'percussionclas1.jpg', 'category_bettery1', 'fournisseur_4'],
            ['Métallophones', 'Batterie en bois de qualité supérieure.', 550, 20, 'percussionclas2.jpg', 'category_bettery1', 'fournisseur_4'],
            ['Marimbas', 'Batterie en bois de qualité supérieure.', 55000, 20, 'percussionclas3.jpg', 'category_bettery1', 'fournisseur_4'],
            ['Vibraphones', 'Batterie en bois de qualité supérieure.', 58000, 20, 'percussionclas4.jpg', 'category_bettery1', 'fournisseur_4'],
            ['Carillons', 'Batterie en bois de qualité supérieure.', 55000, 20, 'percussionclas5.jpg', 'category_bettery1', 'fournisseur_4'],





            // Batery elctronic
            ['Batteries Electroniques Complètes ', 'Batterie en bois de qualité supérieure.', 185000, 20, 'battarieElec1.jpg', 'category_bettery2', 'fournisseur_4'],
            ['Pads de Charleston', 'Batterie en bois de qualité supérieure.', 130000, 20, 'battarieElec2.jpg', 'category_bettery2', 'fournisseur_4'],
            ['Pads de Caisse Claire ', 'Batterie en bois de qualité supérieure.', 100000, 20, 'battarieElec3.jpg', 'category_bettery2', 'fournisseur_4'],
            ['Peaux Maillées', 'Batterie en bois de qualité supérieure.', 190000, 20, 'battarieElec4.jpg', 'category_bettery2', 'fournisseur_4'],
            ['Pads Cymbale', 'Batterie en bois de qualité supérieure.', 139000, 20, 'battarieElec5.jpg', 'category_bettery2', 'fournisseur_4'],





            // Percussions
            ['Congas', 'Batterie en bois de qualité supérieure.', 74000, 20, 'Percussions1.jpg', 'category_bettery3', 'fournisseur_2'],
            ['Bongos', 'Batterie en bois de qualité supérieure.', 96000, 20, 'Percussions2.jpg', 'category_bettery3', 'fournisseur_2'],
            ['Djembés', 'Batterie en bois de qualité supérieure.', 95000, 20, 'Percussions3.jpg', 'category_bettery3', 'fournisseur_2'],
            ['Tambours à main', 'Batterie en bois de qualité supérieure.', 95000, 20, 'Percussions4.jpg', 'category_bettery3', 'fournisseur_2'],
            ['Timbales', 'Batterie en bois de qualité supérieure.', 96500, 20, 'Percussions5.jpg', 'category_bettery3', 'fournisseur_2'],





            // Percussions de Défilé
            ['Caisses Claires de Défilé ', 'Batterie en bois de qualité supérieure.', 145000, 20, 'PercussionsdeDéfilé1.jpg', 'category_bettery4', 'fournisseur_1'],
            ['Grosses Caisses de Défilé', 'Batterie en bois de qualité supérieure.', 165000, 20, 'PercussionsdeDéfilé2.jpg', 'category_bettery4', 'fournisseur_2'],
            ['Toms de Défilé', 'Batterie en bois de qualité supérieure.', 165000, 20, 'PercussionsdeDéfilé3.jpg', 'category_bettery4', 'fournisseur_2'],
            ['Cymbales de Défilé', 'Batterie en bois de qualité supérieure.', 165000, 20, 'PercussionsdeDéfilé4.jpg', 'category_bettery4', 'fournisseur_2'],
            ['Lyres', 'Batterie en bois de qualité supérieure.', 165000, 20, 'PercussionsdeDéfilé5.jpg', 'category_bettery4', 'fournisseur_2'],




            // Orgues Liturgiques
            ['Orgues Liturgiques 1 Clavier ', 'orgue de qualité supérieure.', 150000, 20, 'OrguesLiturgiques1.jpg', 'category_piano1', 'fournisseur_3'],
            ['Orgues Liturgiques 2 Clavier ', 'orgue de qualité supérieure.', 150000, 20, 'OrguesLiturgiques2.jpg', 'category_piano1', 'fournisseur_3'],
            ['Orgues Liturgiques 3 Clavier ', 'orgue de qualité supérieure.', 150000, 20, 'OrguesLiturgiques3.jpg', 'category_piano1', 'fournisseur_3'],
            ['Orgues Liturgiques Simple ', 'orgue de qualité supérieure.', 150000, 20, 'OrguesLiturgiques4.jpg', 'category_piano1', 'fournisseur_3'],
            ['Accessoires pour Orgues Liturgiques ', 'accessoires de qualité supérieure.', 150000, 20, 'OrguesLiturgiques5.jpg', 'category_piano1', 'fournisseur_3'],





            // Orgues Electroniques
            ['Viscount Legend Soul 273', 'orgue de qualité supérieure.', 150000, 20, 'OrguesElectroniques1.jpg', 'category_piano2', 'fournisseur_1'],
            ['Yamaha YC73', 'orgue de qualité supérieure.', 450000, 20, 'OrguesElectroniques2.jpg', 'category_piano2', 'fournisseur_1'],
            ['Roland VR-09 V-Combo B', 'orgue de qualité supérieure.', 410000, 20, 'OrguesElectroniques3.jpg', 'category_piano2', 'fournisseur_1'],
            ['Viscount Legend Live', 'orgue de qualité supérieure.', 150000, 20, 'OrguesElectroniques4.jpg', 'category_piano2', 'fournisseur_1'],
            ['Crumar Mojo 61', 'orgue de qualité supérieure.', 450000, 20, 'OrguesElectroniques5.jpg', 'category_piano2', 'fournisseur_1'],





            // Pianos Droits
            ['Yamaha B3 PE', ' Piano de qualité supérieure.', 47000, 20, 'PianosDroits1.jpg', 'category_piano3', 'fournisseur_2'],
            ['Thomann UP 121 E/P Piano', ' Pianode qualité supérieure.', 127000, 20, 'PianosDroits2.jpg', 'category_piano3', 'fournisseur_2'],
            ['Kawai K-200 ATX 4 E/P Piano', ' Pianode qualité supérieure.', 147000, 20, 'PianosDroits3.jpg', 'category_piano3', 'fournisseur_2'],
            ['Yamaha b1 PE', ' Piano de qualité supérieure.', 147000, 20, 'PianosDroits4.jpg', 'category_piano3', 'fournisseur_2'],
            ['Yamaha U1 SH3 PE silent Piano', ' Pianode qualité supérieure.', 858000, 20, 'PianosDroits5.jpg', 'category_piano3', 'fournisseur_3'],





            // Accordéons
            ['Accordéons Pianos ', ' Accordéon de qualité supérieure.', 75000, 20, 'Accordéons1.jpg', 'category_piano4', 'fournisseur_2'],
            ['Accordéons à Boutons', '  Accordéon de qualité supérieure.', 70000, 20, 'Accordéons2.jpg', 'category_piano4', 'fournisseur_2'],
            ['Accordéons de styrie', ' Accordéon de qualité supérieure.', 70000, 20, 'Accordéons3.jpg', 'category_piano4', 'fournisseur_2'],
            ['Accordéons Spéciaux', ' Accordéon de qualité supérieure.', 78500, 20, 'Accordéons4.jpg', 'category_piano4', 'fournisseur_2'],
            ['Bretelles d\'Accordéons', ' Bretelle de qualité supérieure.', 41200, 20, 'Accordéons5.jpg', 'category_piano4', 'fournisseur_2'],





            // Instruments à Cordes Frottées
            ['Violons Acoustiques', ' violon de qualité supérieure.', 50000, 20, 'InstrumentsàCordesFrottées1.jpg', 'category_traditionnel1', 'fournisseur_4'],
            ['Violoncelles Acoustiques', ' violoncelle de qualité supérieure.', 20000, 20, 'InstrumentsàCordesFrottées2.jpg', 'category_traditionnel1', 'fournisseur_4'],
            ['Contrebasses Acoustiques', ' contre basse de qualité supérieure.', 20000, 20, 'InstrumentsàCordesFrottées3.jpg', 'category_traditionnel1', 'fournisseur_4'],
            ['Altos Acoustiques', ' Alto de qualité supérieure.', 20000, 20, 'InstrumentsàCordesFrottées4.jpg', 'category_traditionnel1', 'fournisseur_4'],
            ['Archets', ' Archet de qualité supérieure.', 40000, 20, 'InstrumentsàCordesFrottées5.jpg', 'category_traditionnel1', 'fournisseur_4'],





            // Instruments de Folklore
            ['Harpe', ' harpe de qualité supérieure.', 41000, 20, 'InstrumentsdeFolklore1.jpg', 'category_traditionnel2', 'fournisseur_3'],
            ['Luths', ' luth de qualité supérieure.', 45700, 20, 'InstrumentsdeFolklore2.jpg', 'category_traditionnel2', 'fournisseur_3'],
            ['Baglamas', ' baglamas de qualité supérieure.', 47100, 20, 'InstrumentsdeFolklore3.jpg', 'category_traditionnel2', 'fournisseur_3'],
            ['Bouzoukis Grecs', ' bouzoukis de qualité supérieure.', 40000, 20, 'InstrumentsdeFolklore4.jpg', 'category_traditionnel2', 'fournisseur_3'],
            ['Villes à Roue', ' folk de qualité supérieure.', 40000, 20, 'InstrumentsdeFolklore5.jpg', 'category_traditionnel2', 'fournisseur_3'],






            // Méditations & Thérapie Musicale
            ['Handpans & Steel Tongue Drums', 'handpan de qualité supérieure.', 47000, 20, 'MéditationsThérapieMusicale1.jpg', 'category_traditionnel3', 'fournisseur_3'],
            ['Energy Chimes', ' emergy chimes de qualité supérieure.', 40000, 20, 'MéditationsThérapieMusicale2.jpg', 'category_traditionnel3', 'fournisseur_3'],
            ['Wind Gongs', ' wind Gons de qualité supérieure.', 41000, 20, 'MéditationsThérapieMusicale3.jpg', 'category_traditionnel3', 'fournisseur_3'],
            ['Tam Tam/Gongs', ' tam tam de qualité supérieure.', 50000, 20, 'MéditationsThérapieMusicale4.jpg', 'category_traditionnel3', 'fournisseur_3'],
            ['Bols Chantants', ' bols chantans de qualité supérieure.', 40000, 20, 'MéditationsThérapieMusicale5.jpg', 'category_traditionnel3', 'fournisseur_3'],



            // Clarinettes
            ['Clarinettes en Sib (Système Allemand) ', ' clarinette en bois de qualité supérieure.', 17000, 20, 'Clarinettes1.jpg', 'category_vent1', 'fournisseur_3'],
            ['Clarinettes en Sib (Système Boehm) ', ' clarinette en bois de qualité supérieure.', 14000, 20, 'Clarinettes2.jpg', 'category_vent1', 'fournisseur_3'],
            ['Clarinettes en Mib (Système Allemand) ', ' clarinette en bois de qualité supérieure.', 16000, 20, 'Clarinettes3.jpg', 'category_vent1', 'fournisseur_3'],
            ['Clarinettes en Mib (Système Boehm) ', ' clarinette en bois de qualité supérieure.', 15000, 20, 'Clarinettes4.jpg', 'category_vent1', 'fournisseur_3'],
            ['Clarinettes en La (Système Allemand) ', ' clarinette en bois de qualité supérieure.', 19000, 20, 'Clarinettes4.jpg', 'category_vent1', 'fournisseur_3'],



            // Trompettes
            ['Trompettes à Pistons en Sib', 'trompette en cuivre de qualité supérieure.', 18000, 20, 'Trompettes1.jpg', 'category_vent2', 'fournisseur_2'],
            ['Trompettes à Piston en Ut', 'trompette en cuivre de qualité supérieure.', 13000, 20, 'Trompettes2.jpg', 'category_vent2', 'fournisseur_2'],
            ['Trompettes à Palettes en Sib', 'trompette en cuivre de qualité supérieure.', 14000, 20, 'Trompettes3.jpg', 'category_vent2', 'fournisseur_2'],
            ['Trompettes à Palettes en Ut', 'trompette en cuivre de qualité supérieure.', 15000, 20, 'Trompettes4.jpg', 'category_vent2', 'fournisseur_2'],
            ['Trompettes Piccolos', 'trompette en cuivre de qualité supérieure.', 20000, 20, 'Trompettes4.jpg', 'category_vent2', 'fournisseur_2'],




            // Trombone
            ['Trombone Ténors', 'trombone en cuivre de qualité supérieure.', 40000, 20, 'Trombone1.jpg', 'category_vent3', 'fournisseur_4'],
            ['Trombone Ténor avec Rotor', 'trombone en cuivre de qualité supérieure.', 40000, 20, 'Trombone2.jpg', 'category_vent3', 'fournisseur_4'],
            ['Trombone Basse', 'trombone en cuivre de qualité supérieure.', 41000, 20, 'Trombone3.jpg', 'category_vent3', 'fournisseur_4'],
            ['Trombone Alto', 'trombone en cuivre de qualité supérieure.', 45000, 20, 'Trombone4.jpg', 'category_vent3', 'fournisseur_4'],
            ['Trombone à Piston ', 'trombone en cuivre de qualité supérieure.', 47000, 20, 'Trombone5.jpg', 'category_vent3', 'fournisseur_4'],




            // Cors D\'Harmonie
            ['Cors D\'Harmonie en Sib', ' cor harmonie en cuivre de qualité supérieure.', 41000, 20, 'CorsHarmonie1.jpg', 'category_vent4', 'fournisseur_2'],
            ['Cors D\'Harmonie en Fa', ' cor harmonie en cuivre de qualité supérieure.', 45000, 20, 'CorsHarmonie2.jpg', 'category_vent4', 'fournisseur_2'],
            ['Cors D\'Harmonie en Double', ' cor harmonie en cuivre de qualité supérieure.', 47000, 20, 'CorsHarmonie3.jpg', 'category_vent4', 'fournisseur_2'],








            // Tuba
            ['Tuba en Sib', ' tuba en cuivre de qualité supérieure.', 41000, 20, 'Tuba1.jpg', 'category_vent5', 'fournisseur_3'],
            ['Tuba en Fa', ' tuba en cuivre de qualité supérieure.', 45000, 20, 'Tuba2.jpg', 'category_vent5', 'fournisseur_3'],
            ['Tuba en Mib', ' tuba en cuivre de qualité supérieure.', 41000, 20, 'Tuba3.jpg', 'category_vent5', 'fournisseur_3'],
            ['Tubas en Ut', ' tuba en cuivre de qualité supérieure.', 457000, 20, 'Tuba4.jpg', 'category_vent5', 'fournisseur_3'],
            ['Sousaphone', ' tuba en cuivre de qualité supérieure.', 4570000, 20, 'Tuba5.jpg', 'category_vent5', 'fournisseur_3'],






            // Flûtes Traversieres
            ['Flûtes Traversières avec Plateaux Creux ', ' flute en cuivre de qualité supérieure.', 40000, 20, 'FlûtesTraversieres1.jpg', 'category_vent6', 'fournisseur_1'],
            ['Flûtes Traversières avec Plateaux Pleins', ' flute en cuivre de qualité supérieure.', 40000, 20, 'FlûtesTraversieres2.jpg', 'category_vent6', 'fournisseur_1'],
            ['Flûtes Traversières Altos & Basses', ' flute en cuivre de qualité supérieure.', 41000, 20, 'FlûtesTraversieres3.jpg', 'category_vent6', 'fournisseur_1'],
            ['Flûtes Traversières Piccolos ', ' flute en cuivre de qualité supérieure.', 57000, 20, 'FlûtesTraversieres4.jpg', 'category_vent6', 'fournisseur_1'],
            ['Flûtes Traversières en Bois ', ' flute en cuivre de qualité supérieure.', 70000, 20, 'FlûtesTraversieres5.jpg', 'category_vent6', 'fournisseur_1'],



            //microphone
            ['Microphone à condensateur large ', ' Microphone de qualité supérieure.', 40000, 20, 'micro1.jpg', 'category_studio1', 'fournisseur_1'],
            ['Microphone à condensateur petite membrane ', ' Microphone de qualité supérieure.', 30000, 20, 'micro2.jpg', 'category_studio1', 'fournisseur_1'],
            ['Microphone Stéréo ', ' Microphone de qualité supérieure.', 50000, 20, 'micro3.jpg', 'category_studio1', 'fournisseur_1'],
            ['Microphone pour Instrument ', ' Microphone de qualité supérieure.', 45000, 20, 'micro4.jpg', 'category_studio1', 'fournisseur_1'],
            ['Microphone à Ruban', ' Microphone de qualité supérieure.', 35000, 20, 'micro5.jpg', 'category_studio1', 'fournisseur_1'],


            //Enceintes de Monitoring 
            ['Enceintes de Proximité Active ', ' monitoring de qualité supérieure.', 95000, 20, 'monitoring1.jpg', 'category_studio2', 'fournisseur_2'],
            ['Enceintes de Proximité Passives ', ' monitoring de qualité supérieure.', 90000, 20, 'monitoring2.jpg', 'category_studio2', 'fournisseur_2'],
            ['Enceintes de Moyenne Distance ', ' monitoring de qualité supérieure.', 11100, 20, 'monitoring3.jpg', 'category_studio2', 'fournisseur_2'],
            ['Caissons de Basse ', ' monitoring de qualité supérieure.', 32000, 20, 'monitoring4.jpg', 'category_studio2', 'fournisseur_2'],
            ['Système 2.1 ', ' monitoring de qualité supérieure.', 22000, 20, 'monitoring5.jpg', 'category_studio2', 'fournisseur_2'],


            //controleur
            [' Contrôleurs DAW', ' contrôleur de qualité supérieure.', 15000, 20, 'controleur1.jpg', 'category_studio3', 'fournisseur_3'],
            [' Contrôleurs Vidéo', ' contrôleur de qualité supérieure.', 10600, 20, 'controleur2.jpg', 'category_studio3', 'fournisseur_3'],
            [' Autre Controleurs', ' contrôleur de qualité supérieure.', 17000, 20, 'controleur3.jpg', 'category_studio3', 'fournisseur_3'],
            [' Nave Instrument', ' contrôleur de qualité supérieure.', 18000, 20, 'controleur4.jpg', 'category_studio3', 'fournisseur_3'],
            [' Contrôleurs DAW', ' contrôleur de qualité supérieure.', 19000, 20, 'controleur5.jpg', 'category_studio3', 'fournisseur_3'],


            //Interface Audio
            [' Interfaces Audio USB', ' Interfaces Audio de qualité supérieure.', 15000, 20, 'interface1.jpg', 'category_studio4', 'fournisseur_4'],
            [' Interfaces Audio FireWire ', ' Interfaces Audio de qualité supérieure.', 16000, 20, 'interface2.jpg', 'category_studio4', 'fournisseur_4'],
            [' Interfaces ethernet ', ' Interfaces Audio de qualité supérieure.', 17000, 20, 'interface3.jpg', 'category_studio4', 'fournisseur_4'],
            ['  Interfaces Audio Thunderbolt ', ' Interfaces Audio de qualité supérieure.', 18000, 20, 'interface4.jpg', 'category_studio4', 'fournisseur_4'],
            [' RME Fireface UFX III', ' Interfaces Audio de qualité supérieure.', 19000, 20, 'interface5.jpg', 'category_studio4', 'fournisseur_4'],


            //casque
            [' Casques Studio', ' Casques de qualité supérieure.', 14000, 20, 'casque1.jpg', 'category_studio5', 'fournisseur_4'],
            [' Casques Hi-Fi', ' Casques de qualité supérieure.', 15000, 20, 'casque2.jpg', 'category_studio5', 'fournisseur_4'],
            [' Sennheiser HD 550', ' Casques de qualité supérieure.', 12000, 20, 'casque3.jpg', 'category_studio5', 'fournisseur_4'],
            [' Positive Grid Spark Neo', ' Casques de qualité supérieure.', 15000, 20, 'casque4.jpg', 'category_studio5', 'fournisseur_4'],
            [' Beyerdynamic', ' Casques de qualité supérieure.', 23900, 20, 'casque5.jpg', 'category_studio5', 'fournisseur_4'],












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
        $category = $this->getReference($categoryReference, Categories::class);
        $produit->setCategories($category);

        // Corriger la référence du fournisseur pour utiliser le format correct
        $fournisseur = $this->getReference($fournisseurReference, Fournisseur::class); // Le format du fournisseur est déjà correct, donc on l'utilise directement
        // dump($fournisseur->getId());


        // MATTER ???????
        $produit->setFournisseur($fournisseur);

        $produit->setReferenceFournisseur("");

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
