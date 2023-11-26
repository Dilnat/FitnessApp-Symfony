<?php

namespace App\DataFixtures;

use App\Entity\TypeExercice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CTypeExerciceFixtures extends Fixture
{

    public const TYPE_EXERCICE_REFERENCE = 'type-exercice';
    public function load(ObjectManager $manager): void

    {
        $faker = Factory::create();
        $typeNames = ['Cardio', 'Strength', 'Flexibility', 'Balance', 'Endurance'];

        $i=0;
        foreach ($typeNames as $typeName) {
            $typeExercice = new TypeExercice();
            $typeExercice->setNom($typeName);
            $this->addReference(self::TYPE_EXERCICE_REFERENCE . $i, $typeExercice);
            $manager->persist($typeExercice);
            $i++;
        }
        $manager->flush();

    }
}