<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221228185212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photos CHANGE description description LONGTEXT DEFAULT NULL, CHANGE photgrapher photgrapher VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE videos ADD video_area_id INT DEFAULT NULL, ADD video_rocks_id INT DEFAULT NULL, ADD video_routes_id INT DEFAULT NULL, ADD video_link VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE videos ADD CONSTRAINT FK_29AA643258E2A931 FOREIGN KEY (video_area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE videos ADD CONSTRAINT FK_29AA6432DE236FCC FOREIGN KEY (video_rocks_id) REFERENCES rock (id)');
        $this->addSql('ALTER TABLE videos ADD CONSTRAINT FK_29AA64326C536B49 FOREIGN KEY (video_routes_id) REFERENCES routes (id)');
        $this->addSql('CREATE INDEX IDX_29AA643258E2A931 ON videos (video_area_id)');
        $this->addSql('CREATE INDEX IDX_29AA6432DE236FCC ON videos (video_rocks_id)');
        $this->addSql('CREATE INDEX IDX_29AA64326C536B49 ON videos (video_routes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photos CHANGE description description LONGTEXT NOT NULL, CHANGE photgrapher photgrapher VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE videos DROP FOREIGN KEY FK_29AA643258E2A931');
        $this->addSql('ALTER TABLE videos DROP FOREIGN KEY FK_29AA6432DE236FCC');
        $this->addSql('ALTER TABLE videos DROP FOREIGN KEY FK_29AA64326C536B49');
        $this->addSql('DROP INDEX IDX_29AA643258E2A931 ON videos');
        $this->addSql('DROP INDEX IDX_29AA6432DE236FCC ON videos');
        $this->addSql('DROP INDEX IDX_29AA64326C536B49 ON videos');
        $this->addSql('ALTER TABLE videos DROP video_area_id, DROP video_rocks_id, DROP video_routes_id, DROP video_link');
    }
}
