<?php

namespace App\DataFixtures;

use App\Entity\Niveau;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasherInterface
    ) {}
    public function load(ObjectManager $manager): void
    {
//        $niveauFixtures = new ANiveauFixtures();
//        print_r("test");
//        ANiveauFixtures::class->load($manager);
//
//        print_r("test2");
//        $groupeMusculaireFixtures = new BGroupeMusculaireFixtures();
//        $groupeMusculaireFixtures->load($manager);
//
//        print_r("test3");
//        $typeExerciceFixtures = new CTypeExerciceFixtures();
//        $typeExerciceFixtures->load($manager);
//
//        print_r("test4");
//        $medailleFixtures = new DMedailleFixtures();
//        $medailleFixtures->load($manager);
//
//        print_r("test5");
//        $exerciceFixtures = new EExerciceFixtures();
//        $exerciceFixtures->load($manager);

//        print_r("test6");
//        $utilisateurFixtures = new FUtilisateurFixtures();
//        $utilisateurFixtures->load($manager);
//
//        print_r("test7");
//        $entrainementFixtures = new GEntrainementFixtures();
//        $entrainementFixtures->load($manager);
//
//        print_r("test8");
        $niveau = new Niveau();
        $niveau->setNom('niveau débutant');
        $niveau->setDescription('niveau -----');
        $manager->persist($niveau);
        $utilisateur = new Utilisateur();
        $utilisateur->setPhoto('utilisateur');
        $utilisateur->setNom('pollet');
        $utilisateur->setPrenom('matteo');
        $utilisateur->setMail('mattpoll@hotmail.com');
        $utilisateur->setTaille('175');
        $utilisateur->setPoids('70');
        $utilisateur->setNiveau($niveau);
        $utilisateur->setDateNaissance(new \DateTime('now'));
        $utilisateur->setPassword($this->userPasswordHasherInterface->hashPassword($utilisateur, 'password123'));
        $manager->persist($utilisateur);
        $manager->flush();
    }


}
