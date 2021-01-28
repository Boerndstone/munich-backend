<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127195028 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rock DROP FOREIGN KEY FK_3749BBA2AE27D15');
        $this->addSql('DROP INDEX IDX_3749BBA2AE27D15 ON rock');
        $this->addSql('ALTER TABLE rock DROP topo_id_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rock ADD topo_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rock ADD CONSTRAINT FK_3749BBA2AE27D15 FOREIGN KEY (topo_id_id) REFERENCES topo (id)');
        $this->addSql('CREATE INDEX IDX_3749BBA2AE27D15 ON rock (topo_id_id)');
    }
}
