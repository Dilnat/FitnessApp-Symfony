<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231126111729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entrainement (id INT AUTO_INCREMENT NOT NULL, createur_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, date_ajout DATE NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_A27444E573A201E5 (createur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercices_par_entrainement (entrainement_id INT NOT NULL, exercice_id INT NOT NULL, INDEX IDX_8D166F39A15E8FD (entrainement_id), INDEX IDX_8D166F3989D40298 (exercice_id), PRIMARY KEY(entrainement_id, exercice_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercice (id INT AUTO_INCREMENT NOT NULL, type_exercice_id INT NOT NULL, difficulte_id INT NOT NULL, equipement JSON NOT NULL COMMENT \'(DC2Type:json)\', temps_exo INT NOT NULL, photo VARCHAR(255) NOT NULL, kcal INT NOT NULL, repos_apres_exo INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_E418C74DC2CDD509 (type_exercice_id), INDEX IDX_E418C74DE6357589 (difficulte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercice_groupeMusculaire (exercice_id INT NOT NULL, groupe_musculaire_id INT NOT NULL, INDEX IDX_A0B9D4B889D40298 (exercice_id), INDEX IDX_A0B9D4B81287564D (groupe_musculaire_id), PRIMARY KEY(exercice_id, groupe_musculaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_musculaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medaille (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_exercice (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, photo VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', mail VARCHAR(255) NOT NULL, taille INT NOT NULL, poids INT NOT NULL, date_naissance DATE NOT NULL, UNIQUE INDEX UNIQ_1D1C63B35126AC48 (mail), INDEX IDX_1D1C63B3B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Recompense (utilisateur_id INT NOT NULL, medaille_id INT NOT NULL, INDEX IDX_51C6C30EFB88E14F (utilisateur_id), INDEX IDX_51C6C30E72E59222 (medaille_id), PRIMARY KEY(utilisateur_id, medaille_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Favori (utilisateur_id INT NOT NULL, entrainement_id INT NOT NULL, INDEX IDX_E829A7FAFB88E14F (utilisateur_id), INDEX IDX_E829A7FAA15E8FD (entrainement_id), PRIMARY KEY(utilisateur_id, entrainement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Historique (utilisateur_id INT NOT NULL, entrainement_id INT NOT NULL, INDEX IDX_A2E2D63CFB88E14F (utilisateur_id), INDEX IDX_A2E2D63CA15E8FD (entrainement_id), PRIMARY KEY(utilisateur_id, entrainement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entrainement ADD CONSTRAINT FK_A27444E573A201E5 FOREIGN KEY (createur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE exercices_par_entrainement ADD CONSTRAINT FK_8D166F39A15E8FD FOREIGN KEY (entrainement_id) REFERENCES entrainement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercices_par_entrainement ADD CONSTRAINT FK_8D166F3989D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74DC2CDD509 FOREIGN KEY (type_exercice_id) REFERENCES type_exercice (id)');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74DE6357589 FOREIGN KEY (difficulte_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE exercice_groupeMusculaire ADD CONSTRAINT FK_A0B9D4B889D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice_groupeMusculaire ADD CONSTRAINT FK_A0B9D4B81287564D FOREIGN KEY (groupe_musculaire_id) REFERENCES groupe_musculaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE Recompense ADD CONSTRAINT FK_51C6C30EFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Recompense ADD CONSTRAINT FK_51C6C30E72E59222 FOREIGN KEY (medaille_id) REFERENCES medaille (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Favori ADD CONSTRAINT FK_E829A7FAFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Favori ADD CONSTRAINT FK_E829A7FAA15E8FD FOREIGN KEY (entrainement_id) REFERENCES entrainement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Historique ADD CONSTRAINT FK_A2E2D63CFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Historique ADD CONSTRAINT FK_A2E2D63CA15E8FD FOREIGN KEY (entrainement_id) REFERENCES entrainement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrainement DROP FOREIGN KEY FK_A27444E573A201E5');
        $this->addSql('ALTER TABLE exercices_par_entrainement DROP FOREIGN KEY FK_8D166F39A15E8FD');
        $this->addSql('ALTER TABLE exercices_par_entrainement DROP FOREIGN KEY FK_8D166F3989D40298');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74DC2CDD509');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74DE6357589');
        $this->addSql('ALTER TABLE exercice_groupeMusculaire DROP FOREIGN KEY FK_A0B9D4B889D40298');
        $this->addSql('ALTER TABLE exercice_groupeMusculaire DROP FOREIGN KEY FK_A0B9D4B81287564D');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3B3E9C81');
        $this->addSql('ALTER TABLE Recompense DROP FOREIGN KEY FK_51C6C30EFB88E14F');
        $this->addSql('ALTER TABLE Recompense DROP FOREIGN KEY FK_51C6C30E72E59222');
        $this->addSql('ALTER TABLE Favori DROP FOREIGN KEY FK_E829A7FAFB88E14F');
        $this->addSql('ALTER TABLE Favori DROP FOREIGN KEY FK_E829A7FAA15E8FD');
        $this->addSql('ALTER TABLE Historique DROP FOREIGN KEY FK_A2E2D63CFB88E14F');
        $this->addSql('ALTER TABLE Historique DROP FOREIGN KEY FK_A2E2D63CA15E8FD');
        $this->addSql('DROP TABLE entrainement');
        $this->addSql('DROP TABLE exercices_par_entrainement');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE exercice_groupeMusculaire');
        $this->addSql('DROP TABLE groupe_musculaire');
        $this->addSql('DROP TABLE medaille');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE type_exercice');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE Recompense');
        $this->addSql('DROP TABLE Favori');
        $this->addSql('DROP TABLE Historique');
    }
}
