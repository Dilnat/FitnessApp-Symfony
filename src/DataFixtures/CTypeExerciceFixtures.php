<?php

namespace App\DataFixtures;

use App\Entity\TypeExercice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
class CTypeExerciceFixtures extends Fixture
{

    public const TYPE_EXERCICE_REFERENCE = 'type-exercice';
    public function load(ObjectManager $manager): void
    {
        // create 5 typeExercice! Bam!
        for ($i = 0; $i < 5; $i++) {
            $typeExercice = new TypeExercice();
            $typeExercice->setNom('typeExercice' . $i);
            $manager->persist($typeExercice);
            $this->addReference(self::TYPE_EXERCICE_REFERENCE . $i, $typeExercice);
        }
        $manager->flush();

    }
}