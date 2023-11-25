<?php

namespace App\DataFixtures;

use App\Entity\Entrainement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
class GEntrainementFixtures extends Fixture
{
    public const ENTRAINEMENT_REFERENCE = 'entrainement';

    public function load(ObjectManager $manager): void
    {
        // create 5 entrainement! Bam!
        for ($i = 0; $i < 5; $i++) {
            $entrainement = new Entrainement();
            $entrainement->addExercice($this->getReference(EExerciceFixtures::EXERCICE_REFERENCE . $i));
            $entrainement->setNom('entrainement' . $i);
            $entrainement->setDescription('entrainement' . $i);
            $entrainement->setCreateur($this->getReference(FUtilisateurFixtures::UTILISATEUR_REFERENCE . $i));
            $entrainement->setDateAjout(new \DateTime('now'));
            $entrainement->setImage('entrainement' .$i);
            $manager->persist($entrainement);
            $this->addReference(self::ENTRAINEMENT_REFERENCE . $i, $entrainement);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            EExerciceFixtures::class,
            FUtilisateurFixtures::class
        );
    }
}