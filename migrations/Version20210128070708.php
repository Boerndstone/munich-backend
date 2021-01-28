<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210128070708 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE route (id INT AUTO_INCREMENT NOT NULL, area_id_id INT DEFAULT NULL, rock_id_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_2C42079F28ED68D (area_id_id), INDEX IDX_2C420791871F89 (rock_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE route ADD CONSTRAINT FK_2C42079F28ED68D FOREIGN KEY (area_id_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE route ADD CONSTRAINT FK_2C420791871F89 FOREIGN KEY (rock_id_id) REFERENCES rock (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE route');
    }
}
