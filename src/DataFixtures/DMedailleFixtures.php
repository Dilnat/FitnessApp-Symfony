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
        $medalNames = ['Gold Star', 'Silver Shield', 'Bronze Warrior', 'Iron Heart', 'Diamond Mind'];
        $i = 0;
        foreach ($medalNames as $medalName) {
            $medaille = new Medaille();
            $medaille->setNom($medalName);
            $this->addReference(self::MEDAILLE_REFERENCE . $i, $medaille);
            $i++;
            $manager->persist($medaille);
        }
        $manager->flush();

    }
}