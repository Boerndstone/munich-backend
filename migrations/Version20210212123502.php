<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210212123502 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rock (id INT AUTO_INCREMENT NOT NULL, area_relation_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, nr INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, access LONGTEXT DEFAULT NULL, nature LONGTEXT DEFAULT NULL, zone SMALLINT DEFAULT NULL, banned SMALLINT DEFAULT NULL, height INT DEFAULT NULL, orientation VARCHAR(50) DEFAULT NULL, season VARCHAR(50) DEFAULT NULL, child_friendly SMALLINT DEFAULT NULL, sunny SMALLINT DEFAULT NULL, rain SMALLINT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, header_image VARCHAR(255) DEFAULT NULL, topo INT DEFAULT NULL, lat DOUBLE PRECISION DEFAULT NULL, lng DOUBLE PRECISION DEFAULT NULL, online TINYINT(1) DEFAULT NULL, INDEX IDX_3749BBA2196D3B2B (area_relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rock ADD CONSTRAINT FK_3749BBA2196D3B2B FOREIGN KEY (area_relation_id) REFERENCES area (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE routes DROP FOREIGN KEY FK_32D5C2B31871F89');
        $this->addSql('DROP TABLE rock');
    }
}
