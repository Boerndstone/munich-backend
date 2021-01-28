<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210119131409 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rock DROP FOREIGN KEY FK_3749BBA2BD0F409C');
        $this->addSql('DROP INDEX IDX_3749BBA2BD0F409C ON rock');
        $this->addSql('ALTER TABLE rock ADD area INT NOT NULL, CHANGE area_id area_relation_id INT NOT NULL');
        $this->addSql('ALTER TABLE rock ADD CONSTRAINT FK_3749BBA2196D3B2B FOREIGN KEY (area_relation_id) REFERENCES area (id)');
        $this->addSql('CREATE INDEX IDX_3749BBA2196D3B2B ON rock (area_relation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rock DROP FOREIGN KEY FK_3749BBA2196D3B2B');
        $this->addSql('DROP INDEX IDX_3749BBA2196D3B2B ON rock');
        $this->addSql('ALTER TABLE rock ADD area_id INT NOT NULL, DROP area_relation_id, DROP area');
        $this->addSql('ALTER TABLE rock ADD CONSTRAINT FK_3749BBA2BD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
        $this->addSql('CREATE INDEX IDX_3749BBA2BD0F409C ON rock (area_id)');
    }
}
