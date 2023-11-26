<?php

namespace App\DataFixtures;


use App\Entity\Exercice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EExerciceFixtures extends Fixture
{
    public const EXERCICE_REFERENCE = 'exercice';
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // create 5 exercice! Bam!
        for ($i = 0; $i < 50; $i++) {
            $exercice = new Exercice();
            $exercice->addGroupeMusculaire($this->getReference(BGroupeMusculaireFixtures::GROUPE_MUSCULAIRE_REFERENCE . $faker->numberBetween(0, 7)));
            $exercice->setTypeExercice($this->getReference(CTypeExerciceFixtures::TYPE_EXERCICE_REFERENCE . $faker->numberBetween(0, 4) ));
            $exercice->setDifficulte($this->getReference(ANiveauFixtures::NIVEAU_REFERENCE . $faker->numberBetween(0, 4)));
            $exercice->setEquipement([$faker->word, $faker->word]);
            $exercice->setPhoto($faker->imageUrl(640, 480, 'sports'));
            $exercice->setKcal($faker->numberBetween(100, 500));
            $exercice->setTempsExo($faker->numberBetween(10, 60));
            $exercice->setReposApresExo($faker->numberBetween(10, 60));
            $exercice->setNom($faker->word);
            $manager->persist($exercice);
            $this->addReference(self::EXERCICE_REFERENCE . $i, $exercice);
        }
        $manager->flush();
    }


}