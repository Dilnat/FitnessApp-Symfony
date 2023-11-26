<?php
// src/DataFixtures/UtilisateurFixtures.php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HUtilisateurFixtures extends Fixture
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

        for ($i = 20; $i < 40; $i++) {
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
            $numEntrainement = [];
            for ($j = 0; $j < $faker->numberBetween(0, 5); $j++) {
                $numActuel =$faker->numberBetween(0, 29);
                if(!in_array($numActuel, $numEntrainement) ){
                    $numEntrainement[] = $numActuel;
                    $utilisateur->addFavori($this->getReference(GEntrainementFixtures::ENTRAINEMENT_REFERENCE . $numActuel));
                }
            }
            $numEntrainement = [];
            for ($j = 0; $j < $faker->numberBetween(0, 5); $j++) {
                $numActuel =$faker->numberBetween(0, 29);
                if(!in_array($numActuel, $numEntrainement) ){
                    $numEntrainement[] = $numActuel;
                    $utilisateur->addHistorique($this->getReference(GEntrainementFixtures::ENTRAINEMENT_REFERENCE . $numActuel));
                }
            }
            $numEntrainement = [];
            for ($j = 0; $j < $faker->numberBetween(0, 5); $j++) {
                $numActuel =$faker->numberBetween(0, 4);
                if(!in_array($numActuel, $numEntrainement) ){
                    $numEntrainement[] = $numActuel;
                    $utilisateur->addMedaille($this->getReference(DMedailleFixtures::MEDAILLE_REFERENCE . $numActuel));
                }
            }
            $this->addReference(self::UTILISATEUR_REFERENCE . $i, $utilisateur);

            $manager->persist($utilisateur);
        }

        $manager->flush();
    }
}
