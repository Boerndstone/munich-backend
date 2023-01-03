<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221228142607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE photos (id INT AUTO_INCREMENT NOT NULL, belongs_to_area_id INT DEFAULT NULL, belongs_to_rock_id INT DEFAULT NULL, belongs_to_route_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, photgrapher VARCHAR(255) NOT NULL, INDEX IDX_876E0D9D6D3667B (belongs_to_area_id), INDEX IDX_876E0D9DF50E4A9 (belongs_to_rock_id), INDEX IDX_876E0D9AE91F1B (belongs_to_route_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9D6D3667B FOREIGN KEY (belongs_to_area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9DF50E4A9 FOREIGN KEY (belongs_to_rock_id) REFERENCES rock (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9AE91F1B FOREIGN KEY (belongs_to_route_id) REFERENCES routes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9D6D3667B');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9DF50E4A9');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9AE91F1B');
        $this->addSql('DROP TABLE photos');
    }
}
