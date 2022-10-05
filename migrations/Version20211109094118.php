<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211109094118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE area (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, orientation VARCHAR(25) NOT NULL, sequence SMALLINT DEFAULT NULL, online SMALLINT NOT NULL, image VARCHAR(255) DEFAULT NULL, header_image VARCHAR(255) DEFAULT NULL, lat DOUBLE PRECISION DEFAULT NULL, lng DOUBLE PRECISION DEFAULT NULL, zoom SMALLINT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE galerie (id INT AUTO_INCREMENT NOT NULL, belongs_to_area_id INT NOT NULL, belongs_to_rock_id INT NOT NULL, belongs_to_route_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, photographer VARCHAR(255) DEFAULT NULL, INDEX IDX_9E7D1590D6D3667B (belongs_to_area_id), INDEX IDX_9E7D1590DF50E4A9 (belongs_to_rock_id), INDEX IDX_9E7D1590AE91F1B (belongs_to_route_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rock (id INT AUTO_INCREMENT NOT NULL, area_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, nr INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, access LONGTEXT DEFAULT NULL, nature LONGTEXT DEFAULT NULL, zone SMALLINT DEFAULT NULL, banned SMALLINT DEFAULT NULL, height INT DEFAULT NULL, orientation VARCHAR(50) DEFAULT NULL, season VARCHAR(50) DEFAULT NULL, child_friendly SMALLINT DEFAULT NULL, sunny SMALLINT DEFAULT NULL, rain SMALLINT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, header_image VARCHAR(255) DEFAULT NULL, topo INT DEFAULT NULL, lat DOUBLE PRECISION DEFAULT NULL, lng DOUBLE PRECISION DEFAULT NULL, online TINYINT(1) DEFAULT NULL, INDEX IDX_3749BBA2BD0F409C (area_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE routes (id INT AUTO_INCREMENT NOT NULL, area_id INT NOT NULL, rock_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, grade VARCHAR(20) DEFAULT NULL, climbed TINYINT(1) DEFAULT NULL, first_ascent VARCHAR(100) NOT NULL, year_first_ascent INT NOT NULL, protection SMALLINT DEFAULT NULL, description LONGTEXT DEFAULT NULL, scale VARCHAR(100) DEFAULT NULL, grade_no INT DEFAULT NULL, rating SMALLINT DEFAULT NULL, topo_id INT DEFAULT NULL, nr INT DEFAULT NULL, INDEX IDX_32D5C2B3BD0F409C (area_id), INDEX IDX_32D5C2B3B48CC24E (rock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, super VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE topo (id INT AUTO_INCREMENT NOT NULL, rocks_id INT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, with_sector TINYINT(1) DEFAULT NULL, svg LONGTEXT DEFAULT NULL, number SMALLINT NOT NULL, INDEX IDX_74A061F576A15D70 (rocks_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, firstname VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, agreed_terms_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE videos (id INT AUTO_INCREMENT NOT NULL, video_area_id INT NOT NULL, video_rocks_id INT NOT NULL, video_routes_id INT NOT NULL, video_link VARCHAR(255) NOT NULL, INDEX IDX_29AA643258E2A931 (video_area_id), INDEX IDX_29AA6432DE236FCC (video_rocks_id), INDEX IDX_29AA64326C536B49 (video_routes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE galerie ADD CONSTRAINT FK_9E7D1590D6D3667B FOREIGN KEY (belongs_to_area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE galerie ADD CONSTRAINT FK_9E7D1590DF50E4A9 FOREIGN KEY (belongs_to_rock_id) REFERENCES rock (id)');
        $this->addSql('ALTER TABLE galerie ADD CONSTRAINT FK_9E7D1590AE91F1B FOREIGN KEY (belongs_to_route_id) REFERENCES routes (id)');
        $this->addSql('ALTER TABLE rock ADD CONSTRAINT FK_3749BBA2BD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE routes ADD CONSTRAINT FK_32D5C2B3BD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE routes ADD CONSTRAINT FK_32D5C2B3B48CC24E FOREIGN KEY (rock_id) REFERENCES rock (id)');
        $this->addSql('ALTER TABLE topo ADD CONSTRAINT FK_74A061F576A15D70 FOREIGN KEY (rocks_id) REFERENCES rock (id)');
        $this->addSql('ALTER TABLE videos ADD CONSTRAINT FK_29AA643258E2A931 FOREIGN KEY (video_area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE videos ADD CONSTRAINT FK_29AA6432DE236FCC FOREIGN KEY (video_rocks_id) REFERENCES rock (id)');
        $this->addSql('ALTER TABLE videos ADD CONSTRAINT FK_29AA64326C536B49 FOREIGN KEY (video_routes_id) REFERENCES routes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE galerie DROP FOREIGN KEY FK_9E7D1590D6D3667B');
        $this->addSql('ALTER TABLE rock DROP FOREIGN KEY FK_3749BBA2BD0F409C');
        $this->addSql('ALTER TABLE routes DROP FOREIGN KEY FK_32D5C2B3BD0F409C');
        $this->addSql('ALTER TABLE videos DROP FOREIGN KEY FK_29AA643258E2A931');
        $this->addSql('ALTER TABLE galerie DROP FOREIGN KEY FK_9E7D1590DF50E4A9');
        $this->addSql('ALTER TABLE routes DROP FOREIGN KEY FK_32D5C2B3B48CC24E');
        $this->addSql('ALTER TABLE topo DROP FOREIGN KEY FK_74A061F576A15D70');
        $this->addSql('ALTER TABLE videos DROP FOREIGN KEY FK_29AA6432DE236FCC');
        $this->addSql('ALTER TABLE galerie DROP FOREIGN KEY FK_9E7D1590AE91F1B');
        $this->addSql('ALTER TABLE videos DROP FOREIGN KEY FK_29AA64326C536B49');
        $this->addSql('DROP TABLE area');
        $this->addSql('DROP TABLE galerie');
        $this->addSql('DROP TABLE rock');
        $this->addSql('DROP TABLE routes');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE topo');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE videos');
    }
}
