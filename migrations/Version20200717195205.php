<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200717195205 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite_scientifique (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, date DATE NOT NULL, heure TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE administrateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_32EB52E8E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, date_ajout DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attestation_travail (id INT AUTO_INCREMENT NOT NULL, motif VARCHAR(255) NOT NULL, date_delivrance DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bureau (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conge (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, objet VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseignant (id INT AUTO_INCREMENT NOT NULL, grade_id INT NOT NULL, bureau_id INT NOT NULL, specialite_id INT NOT NULL, niveau_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, matricule INT NOT NULL, name VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, telephone INT NOT NULL, nationalite VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_81A72FA1E7927C74 (email), INDEX IDX_81A72FA1FE19A1A8 (grade_id), INDEX IDX_81A72FA132516FE2 (bureau_id), INDEX IDX_81A72FA12195E0F0 (specialite_id), INDEX IDX_81A72FA1B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, photo VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, date DATE NOT NULL, lieu VARCHAR(255) NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grade1 (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_formation (id INT AUTO_INCREMENT NOT NULL, enseignant_id INT DEFAULT NULL, formation_id INT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_E655E3A7E455FCC0 (enseignant_id), INDEX IDX_E655E3A75200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mutation (id INT AUTO_INCREMENT NOT NULL, motif VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau_etude (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_professionnelle (id INT AUTO_INCREMENT NOT NULL, annee DATE NOT NULL, appreciation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel (id INT AUTO_INCREMENT NOT NULL, bureau_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, grade_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, cin INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone INT NOT NULL, date_naissance DATE NOT NULL, UNIQUE INDEX UNIQ_A6BCF3DEF85E0677 (username), INDEX IDX_A6BCF3DE32516FE2 (bureau_id), INDEX IDX_A6BCF3DEBCF5E72D (categorie_id), INDEX IDX_A6BCF3DEFE19A1A8 (grade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sanction (id INT AUTO_INCREMENT NOT NULL, motif VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seance (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_conge (id INT AUTO_INCREMENT NOT NULL, maladie VARCHAR(255) NOT NULL, maternite VARCHAR(255) NOT NULL, annuel VARCHAR(255) NOT NULL, recherche VARCHAR(255) NOT NULL, autres VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_seance (id INT AUTO_INCREMENT NOT NULL, cours VARCHAR(255) NOT NULL, td VARCHAR(255) NOT NULL, tp VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA1FE19A1A8 FOREIGN KEY (grade_id) REFERENCES grade1 (id)');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA132516FE2 FOREIGN KEY (bureau_id) REFERENCES bureau (id)');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA12195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id)');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA1B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau_etude (id)');
        $this->addSql('ALTER TABLE inscription_formation ADD CONSTRAINT FK_E655E3A7E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE inscription_formation ADD CONSTRAINT FK_E655E3A75200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DE32516FE2 FOREIGN KEY (bureau_id) REFERENCES bureau (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEFE19A1A8 FOREIGN KEY (grade_id) REFERENCES grade1 (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA132516FE2');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DE32516FE2');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEBCF5E72D');
        $this->addSql('ALTER TABLE inscription_formation DROP FOREIGN KEY FK_E655E3A7E455FCC0');
        $this->addSql('ALTER TABLE inscription_formation DROP FOREIGN KEY FK_E655E3A75200282E');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA1FE19A1A8');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEFE19A1A8');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA1B3E9C81');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA12195E0F0');
        $this->addSql('DROP TABLE activite_scientifique');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE attestation_travail');
        $this->addSql('DROP TABLE bureau');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE conge');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE enseignant');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE grade1');
        $this->addSql('DROP TABLE inscription_formation');
        $this->addSql('DROP TABLE mutation');
        $this->addSql('DROP TABLE niveau_etude');
        $this->addSql('DROP TABLE note_professionnelle');
        $this->addSql('DROP TABLE personnel');
        $this->addSql('DROP TABLE sanction');
        $this->addSql('DROP TABLE seance');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE type_conge');
        $this->addSql('DROP TABLE type_seance');
    }
}
