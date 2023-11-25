<?php

namespace App\DataFixtures;

use App\Entity\Medaille;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
class DMedailleFixtures extends Fixture
{
    public const MEDAILLE_REFERENCE = 'medaille';
    public function load(ObjectManager $manager): void
    {
        // create 5 medaille! Bam!
        for ($i = 0; $i < 5; $i++) {
            $medaille = new Medaille();
            $medaille->setNom('medaille' . $i);
            $manager->persist($medaille);
            $this->addReference(self::MEDAILLE_REFERENCE . $i, $medaille);
        }
        $manager->flush();

    }
}