<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116090318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, photo VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, taille INT NOT NULL, poids INT NOT NULL, date_naissance DATE NOT NULL, INDEX IDX_1D1C63B3B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_medaille (utilisateur_id INT NOT NULL, medaille_id INT NOT NULL, INDEX IDX_2D7DD8DEFB88E14F (utilisateur_id), INDEX IDX_2D7DD8DE72E59222 (medaille_id), PRIMARY KEY(utilisateur_id, medaille_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE utilisateur_medaille ADD CONSTRAINT FK_2D7DD8DEFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_medaille ADD CONSTRAINT FK_2D7DD8DE72E59222 FOREIGN KEY (medaille_id) REFERENCES medaille (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3B3E9C81');
        $this->addSql('ALTER TABLE utilisateur_medaille DROP FOREIGN KEY FK_2D7DD8DEFB88E14F');
        $this->addSql('ALTER TABLE utilisateur_medaille DROP FOREIGN KEY FK_2D7DD8DE72E59222');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateur_medaille');
    }
}
