<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116090548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entrainement (id INT AUTO_INCREMENT NOT NULL, createur_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, date_ajout DATE NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_A27444E573A201E5 (createur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris (entrainement_id INT NOT NULL, exercice_id INT NOT NULL, INDEX IDX_5B5DCE43A15E8FD (entrainement_id), INDEX IDX_5B5DCE4389D40298 (exercice_id), PRIMARY KEY(entrainement_id, exercice_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entrainement ADD CONSTRAINT FK_A27444E573A201E5 FOREIGN KEY (createur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_5B5DCE43A15E8FD FOREIGN KEY (entrainement_id) REFERENCES entrainement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_5B5DCE4389D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entrainement DROP FOREIGN KEY FK_A27444E573A201E5');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_5B5DCE43A15E8FD');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_5B5DCE4389D40298');
        $this->addSql('DROP TABLE entrainement');
        $this->addSql('DROP TABLE favoris');
    }
}
