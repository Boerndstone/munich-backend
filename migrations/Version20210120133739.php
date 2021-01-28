<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210120133739 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE area ADD sequence SMALLINT DEFAULT NULL, ADD online SMALLINT NOT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD header_image VARCHAR(255) DEFAULT NULL, ADD lat DOUBLE PRECISION NOT NULL, ADD lng DOUBLE PRECISION NOT NULL, ADD zoom SMALLINT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE area DROP sequence, DROP online, DROP image, DROP header_image, DROP lat, DROP lng, DROP zoom');
    }
}
