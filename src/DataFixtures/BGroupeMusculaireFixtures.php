<?php

namespace App\DataFixtures;

use App\Entity\GroupeMusculaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
class BGroupeMusculaireFixtures extends Fixture
{

    public const GROUPE_MUSCULAIRE_REFERENCE = 'groupe-musculaire';
    public function load(ObjectManager $manager): void
    {
        // create 5 groupMusculaire! Bam!
        for ($i = 0; $i < 5; $i++) {
            $groupMusculaire = new GroupeMusculaire();
            $groupMusculaire->setNom('groupMusculaire' . $i);
            $manager->persist($groupMusculaire);
            print_r(self::GROUPE_MUSCULAIRE_REFERENCE . $i . "\n");
            $this->addReference(self::GROUPE_MUSCULAIRE_REFERENCE . $i, $groupMusculaire);
        }
        $manager->flush();
    }
}