<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200719193804 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enseignant ADD sceance_id INT NOT NULL');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA157447AA6 FOREIGN KEY (sceance_id) REFERENCES sceance (id)');
        $this->addSql('CREATE INDEX IDX_81A72FA157447AA6 ON enseignant (sceance_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA157447AA6');
        $this->addSql('DROP INDEX IDX_81A72FA157447AA6 ON enseignant');
        $this->addSql('ALTER TABLE enseignant DROP sceance_id');
    }
}
