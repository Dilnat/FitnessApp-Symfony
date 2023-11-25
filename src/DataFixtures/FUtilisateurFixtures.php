<?php

namespace App\DataFixtures;


use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FUtilisateurFixtures extends Fixture implements DependentFixtureInterface
{
    public const UTILISATEUR_REFERENCE = 'utilisateur';

    public function load(ObjectManager $manager): void
    {
        // create 5 utilisateur! Bam!
        for ($i = 0; $i < 5; $i++) {
            $utilisateur = new Utilisateur();
            $utilisateur->setPhoto('utilisateur' .$i);
            $utilisateur->setNom('utilisateur' .$i);
            $utilisateur->setPrenom('utilisateur' .$i);
            $utilisateur->setMail('utilisateur' . $i);
            $utilisateur->setTaille('utilisateur' . $i);
            $utilisateur->setPoids($i);
            $utilisateur->setNiveau($this->getReference(ANiveauFixtures::NIVEAU_REFERENCE . $i));
            $utilisateur->setDateNaissance(new \DateTime('now'));
            $utilisateur->addMedaille($this->getReference(DMedailleFixtures::MEDAILLE_REFERENCE . $i));
            $utilisateur->addFavori($this->getReference(GEntrainementFixtures::ENTRAINEMENT_REFERENCE . $i));
            $manager->persist($utilisateur);
            $this->addReference(self::UTILISATEUR_REFERENCE . $i, $utilisateur);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ANiveauFixtures::class,
            DMedailleFixtures::class,
            GEntrainementFixtures::class,
        );
    }
}