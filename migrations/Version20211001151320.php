<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211001151320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE routes DROP FOREIGN KEY FK_32D5C2B31871F89');
        $this->addSql('ALTER TABLE routes DROP FOREIGN KEY FK_32D5C2B3F28ED68D');
        $this->addSql('DROP INDEX IDX_32D5C2B31871F89 ON routes');
        $this->addSql('DROP INDEX IDX_32D5C2B3F28ED68D ON routes');
        $this->addSql('ALTER TABLE routes CHANGE area_id_id area_id INT NOT NULL, CHANGE rock_id_id rock_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE routes ADD CONSTRAINT FK_32D5C2B3BD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE routes ADD CONSTRAINT FK_32D5C2B3B48CC24E FOREIGN KEY (rock_id) REFERENCES rock (id)');
        $this->addSql('CREATE INDEX IDX_32D5C2B3BD0F409C ON routes (area_id)');
        $this->addSql('CREATE INDEX IDX_32D5C2B3B48CC24E ON routes (rock_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE routes DROP FOREIGN KEY FK_32D5C2B3BD0F409C');
        $this->addSql('ALTER TABLE routes DROP FOREIGN KEY FK_32D5C2B3B48CC24E');
        $this->addSql('DROP INDEX IDX_32D5C2B3BD0F409C ON routes');
        $this->addSql('DROP INDEX IDX_32D5C2B3B48CC24E ON routes');
        $this->addSql('ALTER TABLE routes CHANGE area_id area_id_id INT NOT NULL, CHANGE rock_id rock_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE routes ADD CONSTRAINT FK_32D5C2B31871F89 FOREIGN KEY (rock_id_id) REFERENCES rock (id)');
        $this->addSql('ALTER TABLE routes ADD CONSTRAINT FK_32D5C2B3F28ED68D FOREIGN KEY (area_id_id) REFERENCES area (id)');
        $this->addSql('CREATE INDEX IDX_32D5C2B31871F89 ON routes (rock_id_id)');
        $this->addSql('CREATE INDEX IDX_32D5C2B3F28ED68D ON routes (area_id_id)');
    }
}
