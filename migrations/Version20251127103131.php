<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251127103131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout du champs editeur dans la table jeu et de la relation associée';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeu ADD editeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jeu ADD CONSTRAINT FK_82E48DB53375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id)');
        $this->addSql('CREATE INDEX IDX_82E48DB53375BD21 ON jeu (editeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeu DROP FOREIGN KEY FK_82E48DB53375BD21');
        $this->addSql('DROP INDEX IDX_82E48DB53375BD21 ON jeu');
        $this->addSql('ALTER TABLE jeu DROP editeur_id');
    }
}
