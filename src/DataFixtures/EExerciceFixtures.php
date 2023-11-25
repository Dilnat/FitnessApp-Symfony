<?php

namespace App\DataFixtures;


use App\Entity\Exercice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
class EExerciceFixtures extends Fixture
{
    public const EXERCICE_REFERENCE = 'exercice';
    public function load(ObjectManager $manager): void
    {
        // create 5 exercice! Bam!
        for ($i = 0; $i < 5; $i++) {
            $exercice = new Exercice();
            $exercice->addGroupeMusculaire($this->getReference(BGroupeMusculaireFixtures::GROUPE_MUSCULAIRE_REFERENCE . $i));
            $exercice->setTypeExercice($this->getReference(CTypeExerciceFixtures::TYPE_EXERCICE_REFERENCE . $i));
            $exercice->setDifficulte($this->getReference(ANiveauFixtures::NIVEAU_REFERENCE . $i));
            $exercice->setEquipement(['exercice' .$i, 'exercice' . $i+1]);
            $exercice->setTempsExo($i);
            $exercice->setPhoto('exercice' .$i);
            $exercice->setKcal($i);
            $exercice->setTempsExo($i);
            $exercice->setReposApresExo($i);
            $exercice->setNom('exercice' .$i);
            $manager->persist($exercice);
            $this->addReference(self::EXERCICE_REFERENCE . $i, $exercice);
        }
        $manager->flush();
    }


}