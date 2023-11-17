<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116090008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercice (id INT AUTO_INCREMENT NOT NULL, type_exercice_id INT NOT NULL, difficulte_id INT NOT NULL, equipement JSON NOT NULL COMMENT \'(DC2Type:json)\', temps_exo INT NOT NULL, photo VARCHAR(255) NOT NULL, kcal INT NOT NULL, repos_apres_exo INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_E418C74DC2CDD509 (type_exercice_id), INDEX IDX_E418C74DE6357589 (difficulte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercice_groupe_musculaire (exercice_id INT NOT NULL, groupe_musculaire_id INT NOT NULL, INDEX IDX_EF81D27989D40298 (exercice_id), INDEX IDX_EF81D2791287564D (groupe_musculaire_id), PRIMARY KEY(exercice_id, groupe_musculaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74DC2CDD509 FOREIGN KEY (type_exercice_id) REFERENCES type_exercice (id)');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74DE6357589 FOREIGN KEY (difficulte_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE exercice_groupe_musculaire ADD CONSTRAINT FK_EF81D27989D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice_groupe_musculaire ADD CONSTRAINT FK_EF81D2791287564D FOREIGN KEY (groupe_musculaire_id) REFERENCES groupe_musculaire (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74DC2CDD509');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74DE6357589');
        $this->addSql('ALTER TABLE exercice_groupe_musculaire DROP FOREIGN KEY FK_EF81D27989D40298');
        $this->addSql('ALTER TABLE exercice_groupe_musculaire DROP FOREIGN KEY FK_EF81D2791287564D');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE exercice_groupe_musculaire');
    }
}
