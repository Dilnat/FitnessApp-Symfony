<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $niveauFixtures = new ANiveauFixtures();
        print_r("test");
        ANiveauFixtures::class->load($manager);

        print_r("test2");
        $groupeMusculaireFixtures = new BGroupeMusculaireFixtures();
        $groupeMusculaireFixtures->load($manager);

        print_r("test3");
        $typeExerciceFixtures = new CTypeExerciceFixtures();
        $typeExerciceFixtures->load($manager);

        print_r("test4");
        $medailleFixtures = new DMedailleFixtures();
        $medailleFixtures->load($manager);

        print_r("test5");
        $exerciceFixtures = new EExerciceFixtures();
        $exerciceFixtures->load($manager);

        print_r("test6");
        $utilisateurFixtures = new FUtilisateurFixtures();
        $utilisateurFixtures->load($manager);

        print_r("test7");
        $entrainementFixtures = new GEntrainementFixtures();
        $entrainementFixtures->load($manager);

        print_r("test8");
        $manager->flush();
    }


}
