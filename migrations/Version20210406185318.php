<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210406185318 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE galerie (id INT AUTO_INCREMENT NOT NULL, belongs_to_area_id INT NOT NULL, belongs_to_rock_id INT NOT NULL, belongs_to_route_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, photographer VARCHAR(255) DEFAULT NULL, INDEX IDX_9E7D1590D6D3667B (belongs_to_area_id), INDEX IDX_9E7D1590DF50E4A9 (belongs_to_rock_id), INDEX IDX_9E7D1590AE91F1B (belongs_to_route_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE galerie ADD CONSTRAINT FK_9E7D1590D6D3667B FOREIGN KEY (belongs_to_area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE galerie ADD CONSTRAINT FK_9E7D1590DF50E4A9 FOREIGN KEY (belongs_to_rock_id) REFERENCES rock (id)');
        $this->addSql('ALTER TABLE galerie ADD CONSTRAINT FK_9E7D1590AE91F1B FOREIGN KEY (belongs_to_route_id) REFERENCES routes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE galerie');
    }
}
