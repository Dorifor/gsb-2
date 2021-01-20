<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210120145607 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission ADD hebergement_id INT DEFAULT NULL, ADD just_heb VARCHAR(255) DEFAULT NULL, DROP nbr_repas');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C23BB0F66 FOREIGN KEY (hebergement_id) REFERENCES hebergement (id)');
        $this->addSql('CREATE INDEX IDX_9067F23C23BB0F66 ON mission (hebergement_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C23BB0F66');
        $this->addSql('DROP INDEX IDX_9067F23C23BB0F66 ON mission');
        $this->addSql('ALTER TABLE mission ADD nbr_repas INT NOT NULL, DROP hebergement_id, DROP just_heb');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`');
    }
}
