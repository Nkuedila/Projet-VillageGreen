<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class UsersFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface $slugger
    ) {}

    public function load(ObjectManager $manager): void
    {
        $admin = new Users();
        $admin->setEmail('alibunzi1995@gmail.com');
        $admin->setNom('Nkuedila');
        $admin->setPrenom('Ali');
        $admin->setAdresse('36 rue emile francfort');
        $admin->setCodepostal('80000');
        $admin->setVille('Amiens');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $admin = new Users();
        $admin->setEmail('musadaqmohamedabshir@gmail.fr');
        $admin->setNom('Mohamed');
        $admin->setPrenom('Musadaq');
        $admin->setAdresse('30 rue Henri Dunant');
        $admin->setCodepostal('51000');
        $admin->setVille('Chalon-en-Champagne');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'bunzi')
        );
        $admin->setRoles(['ROLE_COMMERCIAL']);

        $manager->persist($admin);


        $admin = new Users();
        $admin->setEmail('kulala@gmail.fr');
        $admin->setNom('Kulala');
        $admin->setPrenom('pasco');
        $admin->setAdresse('38 rue mbandaka');
        $admin->setCodepostal('20102');
        $admin->setVille('kinshasa');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'pasco')
        );
        $admin->setRoles(['ROLE_CLIENT_PARTICULIER']);

        $manager->persist($admin);



        $admin = new Users();
        $admin->setEmail('masambukidi@gmail.fr');
        $admin->setNom('Masambukidi');
        $admin->setPrenom('Samuel');
        $admin->setAdresse('40 rue mbandaka');
        $admin->setCodepostal('30071');
        $admin->setVille('kinshasa');
        $admin->setNumeroSiret('12345');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'samuel')
        );
        $admin->setRoles(['ROLE_CLIENT_PROFESSIONEL']);

        $manager->persist($admin);





        $manager->flush();
    }
}
