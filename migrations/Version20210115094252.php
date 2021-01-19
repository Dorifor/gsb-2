<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210115094252 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE PrevoirHebergement (id INT AUTO_INCREMENT NOT NULL, mission_id INT NOT NULL, hebergement_id INT NOT NULL, justification VARCHAR(255) DEFAULT NULL, INDEX IDX_1A14F4EBBE6CAE90 (mission_id), INDEX IDX_1A14F4EB23BB0F66 (hebergement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deplacer (id INT AUTO_INCREMENT NOT NULL, mission_id INT NOT NULL, transport_id INT NOT NULL, nbr_km INT DEFAULT NULL, essence VARCHAR(255) DEFAULT NULL, INDEX IDX_D067EF0ABE6CAE90 (mission_id), INDEX IDX_D067EF0A9909C13F (transport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hebergement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, destination_id INT NOT NULL, user_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, notes LONGTEXT DEFAULT NULL, nbr_repas INT NOT NULL, INDEX IDX_9067F23C816C6140 (destination_id), INDEX IDX_9067F23CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(150) NOT NULL, chevaux INT DEFAULT NULL, coeff_km DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, ville_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, adresse VARCHAR(120) DEFAULT NULL, naissance DATE NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE PrevoirHebergement ADD CONSTRAINT FK_1A14F4EBBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('ALTER TABLE PrevoirHebergement ADD CONSTRAINT FK_1A14F4EB23BB0F66 FOREIGN KEY (hebergement_id) REFERENCES hebergement (id)');
        $this->addSql('ALTER TABLE deplacer ADD CONSTRAINT FK_D067EF0ABE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('ALTER TABLE deplacer ADD CONSTRAINT FK_D067EF0A9909C13F FOREIGN KEY (transport_id) REFERENCES transport (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C816C6140 FOREIGN KEY (destination_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE PrevoirHebergement DROP FOREIGN KEY FK_1A14F4EB23BB0F66');
        $this->addSql('ALTER TABLE PrevoirHebergement DROP FOREIGN KEY FK_1A14F4EBBE6CAE90');
        $this->addSql('ALTER TABLE deplacer DROP FOREIGN KEY FK_D067EF0ABE6CAE90');
        $this->addSql('ALTER TABLE deplacer DROP FOREIGN KEY FK_D067EF0A9909C13F');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CA76ED395');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C816C6140');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A73F0036');
        $this->addSql('DROP TABLE PrevoirHebergement');
        $this->addSql('DROP TABLE deplacer');
        $this->addSql('DROP TABLE hebergement');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE ville');
    }
}
