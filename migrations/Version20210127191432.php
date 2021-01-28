<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127191432 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE route (id INT AUTO_INCREMENT NOT NULL, rocks_id_id INT NOT NULL, area_id_id INT NOT NULL, nr INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, grade INT DEFAULT NULL, already_climbed TINYINT(1) DEFAULT NULL, first_ascent VARCHAR(100) DEFAULT NULL, year_first_ascent INT DEFAULT NULL, protection SMALLINT DEFAULT NULL, description LONGTEXT DEFAULT NULL, scale VARCHAR(50) DEFAULT NULL, grade_no INT DEFAULT NULL, rating SMALLINT DEFAULT NULL, INDEX IDX_2C420799C741D71 (rocks_id_id), INDEX IDX_2C42079F28ED68D (area_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE route ADD CONSTRAINT FK_2C420799C741D71 FOREIGN KEY (rocks_id_id) REFERENCES rock (id)');
        $this->addSql('ALTER TABLE route ADD CONSTRAINT FK_2C42079F28ED68D FOREIGN KEY (area_id_id) REFERENCES area (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE route');
    }
}
