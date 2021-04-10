<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210404171626 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password LONGTEXT NOT NULL, adresse LONGTEXT NOT NULL, nom LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, locataire_id INT DEFAULT NULL, proprietaire_id INT DEFAULT NULL, agence_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, statut TINYINT(1) NOT NULL, type VARCHAR(255) NOT NULL, loyer DOUBLE PRECISION NOT NULL, INDEX IDX_F65593E5D8A38199 (locataire_id), INDEX IDX_F65593E576C50E4A (proprietaire_id), INDEX IDX_F65593E5D725330D (agence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE echeance (id INT AUTO_INCREMENT NOT NULL, annonce_id INT DEFAULT NULL, date DATE NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_40D9893B8805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, nom VARCHAR(255) NOT NULL, taille VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image_blob LONGBLOB NOT NULL, INDEX IDX_C53D045F8805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_profil (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, taille VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image_profil_blob LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locataire (id INT AUTO_INCREMENT NOT NULL, image_profil_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_C47CF6EBFFDC0B2C (image_profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, annonce_id INT DEFAULT NULL, date DATE NOT NULL, contenu_message LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_B6BD307F8805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proprietaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password LONGTEXT NOT NULL, is_bailleur_tier TINYINT(1) NOT NULL, is_abonne TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5D8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E576C50E4A FOREIGN KEY (proprietaire_id) REFERENCES proprietaire (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5D725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('ALTER TABLE echeance ADD CONSTRAINT FK_40D9893B8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE locataire ADD CONSTRAINT FK_C47CF6EBFFDC0B2C FOREIGN KEY (image_profil_id) REFERENCES image_profil (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5D725330D');
        $this->addSql('ALTER TABLE echeance DROP FOREIGN KEY FK_40D9893B8805AB2F');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F8805AB2F');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F8805AB2F');
        $this->addSql('ALTER TABLE locataire DROP FOREIGN KEY FK_C47CF6EBFFDC0B2C');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5D8A38199');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E576C50E4A');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE echeance');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE image_profil');
        $this->addSql('DROP TABLE locataire');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE proprietaire');
    }
}
