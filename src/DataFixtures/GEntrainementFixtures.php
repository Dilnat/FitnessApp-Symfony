<?php

namespace App\DataFixtures;

use App\Entity\Entrainement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class GEntrainementFixtures extends Fixture
{
    public const ENTRAINEMENT_REFERENCE = 'entrainement';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 30; $i++) {
            $entrainement = new Entrainement();
            $entrainement->setNom($faker->words(3, true));
            $entrainement->setDescription($faker->paragraph);
            $entrainement->setDateAjout($faker->dateTimeThisYear);
            $entrainement->setCreateur($this->getReference(FUtilisateurFixtures::UTILISATEUR_REFERENCE . $faker->numberBetween(0, 19)));
            $numExercices = [];
            for ($j = 0; $j < $faker->numberBetween(3, 6); $j++) {
                $numActuel = $faker->numberBetween(0, 49);
                if(!in_array($numActuel, $numExercices) ){
                    $numExercices[] = $numActuel;
                    $entrainement->addExercice($this->getReference(EExerciceFixtures::EXERCICE_REFERENCE . $numActuel));
                }

            }
            $entrainement->setImage($faker->imageUrl(640, 480, 'sports'));
            $this->addReference(self::ENTRAINEMENT_REFERENCE . $i, $entrainement);
            $manager->persist($entrainement);
        }

        $manager->flush();
    }
}