<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210125135730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rock ADD slug VARCHAR(255) NOT NULL, ADD nr INT DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL, ADD access LONGTEXT DEFAULT NULL, ADD nature LONGTEXT DEFAULT NULL, ADD zone SMALLINT DEFAULT NULL, ADD banned SMALLINT DEFAULT NULL, ADD height INT DEFAULT NULL, ADD orientation VARCHAR(50) DEFAULT NULL, ADD sunny SMALLINT DEFAULT NULL, ADD rain SMALLINT DEFAULT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD header_image VARCHAR(255) DEFAULT NULL, ADD topo INT DEFAULT NULL, ADD lat DOUBLE PRECISION DEFAULT NULL, ADD lng DOUBLE PRECISION DEFAULT NULL, ADD online TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rock DROP slug, DROP nr, DROP description, DROP access, DROP nature, DROP zone, DROP banned, DROP height, DROP orientation, DROP sunny, DROP rain, DROP image, DROP header_image, DROP topo, DROP lat, DROP lng, DROP online');
    }
}
