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
        $muscleGroups = ['Biceps', 'Triceps', 'Deltoids', 'Pectorals', 'Abdominals', 'Quadriceps', 'Hamstrings', 'Calves'];
        $i=0;
        foreach ($muscleGroups as $groupName) {
            $groupeMusculaire = new GroupeMusculaire();
            $groupeMusculaire->setNom($groupName);
            $this->addReference(self::GROUPE_MUSCULAIRE_REFERENCE . $i, $groupeMusculaire);
            $i++;
            $manager->persist($groupeMusculaire);
        }
        $manager->flush();
    }
}