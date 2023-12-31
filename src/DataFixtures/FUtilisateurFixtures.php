<?php
// src/DataFixtures/UtilisateurFixtures.php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class FUtilisateurFixtures extends Fixture
{
    public const UTILISATEUR_REFERENCE = 'utilisateur';
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $utilisateur = new Utilisateur();
            $utilisateur->setNom($faker->lastName);
            $utilisateur->setPrenom($faker->firstName);
            $utilisateur->setMail($faker->email);
            $utilisateur->setDateNaissance($faker->dateTimeThisCentury);
            $utilisateur->setTaille($faker->numberBetween(150, 200));
            $utilisateur->setPoids($faker->numberBetween(50, 100));
            $utilisateur->setPhoto($faker->imageUrl(640, 480, 'people', true));
            $utilisateur->setNiveau($this->getReference(ANiveauFixtures::NIVEAU_REFERENCE . $faker->numberBetween(0, 4)));
            $hashedPassword = $this->passwordHasher->hashPassword($utilisateur, $faker->password);
            $utilisateur->setPassword($hashedPassword);
            $this->addReference(self::UTILISATEUR_REFERENCE . $i, $utilisateur);

            $manager->persist($utilisateur);
        }

        $manager->flush();
    }
}
