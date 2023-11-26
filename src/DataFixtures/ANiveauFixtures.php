<?php

namespace App\DataFixtures;

use App\Entity\Niveau;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ANiveauFixtures  extends Fixture
{
    public const NIVEAU_REFERENCE = 'niveau';
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Define an array of level names if you want specific names,
        // or generate random names using Faker
        $levelNames = ['Beginner', 'Intermediate', 'Advanced', 'Expert', 'Master'];

        $i=0;
        foreach ($levelNames as $levelName) {
            $niveau = new Niveau();
            $niveau->setNom($levelName);
            $niveau->setDescription($faker->sentence);
            $this->addReference(self::NIVEAU_REFERENCE . $i, $niveau);
            $i++;
            $manager->persist($niveau);
        }
        $manager->flush();
    }
}