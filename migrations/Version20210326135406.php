<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210326135406 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE routes (id INT AUTO_INCREMENT NOT NULL, area_id_id INT NOT NULL, rock_id_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, grade VARCHAR(20) DEFAULT NULL, climbed TINYINT(1) DEFAULT NULL, first_ascent VARCHAR(100) DEFAULT NULL, year_first_ascent INT DEFAULT NULL, protection SMALLINT DEFAULT NULL, description LONGTEXT DEFAULT NULL, scale VARCHAR(100) DEFAULT NULL, grade_no INT DEFAULT NULL, rating SMALLINT DEFAULT NULL, topo_id INT DEFAULT NULL, nr INT DEFAULT NULL, INDEX IDX_32D5C2B3F28ED68D (area_id_id), INDEX IDX_32D5C2B31871F89 (rock_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE routes ADD CONSTRAINT FK_32D5C2B3F28ED68D FOREIGN KEY (area_id_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE routes ADD CONSTRAINT FK_32D5C2B31871F89 FOREIGN KEY (rock_id_id) REFERENCES rock (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE videos DROP FOREIGN KEY FK_29AA64326C536B49');
        $this->addSql('DROP TABLE routes');
    }
}
