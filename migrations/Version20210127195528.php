<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127195528 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE topo ADD rock_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE topo ADD CONSTRAINT FK_74A061F5B48CC24E FOREIGN KEY (rock_id) REFERENCES rock (id)');
        $this->addSql('CREATE INDEX IDX_74A061F5B48CC24E ON topo (rock_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE topo DROP FOREIGN KEY FK_74A061F5B48CC24E');
        $this->addSql('DROP INDEX IDX_74A061F5B48CC24E ON topo');
        $this->addSql('ALTER TABLE topo DROP rock_id');
    }
}
