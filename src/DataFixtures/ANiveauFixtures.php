<?php

namespace App\DataFixtures;

use App\Entity\Niveau;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
class ANiveauFixtures  extends Fixture
{
    public const NIVEAU_REFERENCE = 'niveau';
    public function load(ObjectManager $manager): void
    {
        // create 5 niveau! Bam!
        for ($i = 0; $i < 5; $i++) {
            $niveau = new Niveau();
            $niveau->setNom('niveau' . $i);
            $niveau->setDescription('niveau' . $i . '-----');
            $manager->persist($niveau);
            $this->addReference(self::NIVEAU_REFERENCE . $i, $niveau);

        }
        $manager->flush();
    }
}