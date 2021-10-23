<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210930134320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE videos (id INT AUTO_INCREMENT NOT NULL, video_area_id INT NOT NULL, video_rocks_id INT NOT NULL, video_routes_id INT NOT NULL, video_link VARCHAR(255) NOT NULL, INDEX IDX_29AA643258E2A931 (video_area_id), INDEX IDX_29AA6432DE236FCC (video_rocks_id), INDEX IDX_29AA64326C536B49 (video_routes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE videos ADD CONSTRAINT FK_29AA643258E2A931 FOREIGN KEY (video_area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE videos ADD CONSTRAINT FK_29AA6432DE236FCC FOREIGN KEY (video_rocks_id) REFERENCES rock (id)');
        $this->addSql('ALTER TABLE videos ADD CONSTRAINT FK_29AA64326C536B49 FOREIGN KEY (video_routes_id) REFERENCES routes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE videos');
    }
}
