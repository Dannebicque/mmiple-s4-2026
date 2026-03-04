<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251127072422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout du champs stock';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE jeutest (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, editeur VARCHAR(255) NOT NULL, duree INT NOT NULL, prix NUMERIC(5, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jeu ADD stock INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE jeutest');
        $this->addSql('ALTER TABLE jeu DROP stock');
    }
}
