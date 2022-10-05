<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005094629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rock (id INT AUTO_INCREMENT NOT NULL, area_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, nr INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, access LONGTEXT DEFAULT NULL, nature LONGTEXT DEFAULT NULL, zone SMALLINT DEFAULT NULL, banned SMALLINT DEFAULT NULL, height INT DEFAULT NULL, orientation VARCHAR(50) DEFAULT NULL, season VARCHAR(50) DEFAULT NULL, child_friendly SMALLINT DEFAULT NULL, sunny SMALLINT DEFAULT NULL, rain SMALLINT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, header_image VARCHAR(255) DEFAULT NULL, topo INT DEFAULT NULL, lat DOUBLE PRECISION DEFAULT NULL, lng NUMERIC(10, 6) DEFAULT NULL, online TINYINT(1) DEFAULT NULL, INDEX IDX_3749BBA2BD0F409C (area_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rock ADD CONSTRAINT FK_3749BBA2BD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE galerie DROP FOREIGN KEY FK_9E7D1590DF50E4A9');
        $this->addSql('ALTER TABLE routes DROP FOREIGN KEY FK_32D5C2B3B48CC24E');
        $this->addSql('ALTER TABLE topo DROP FOREIGN KEY FK_74A061F576A15D70');
        $this->addSql('ALTER TABLE videos DROP FOREIGN KEY FK_29AA6432DE236FCC');
        $this->addSql('DROP TABLE rock');
    }
}
