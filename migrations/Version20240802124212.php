<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240802124212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, seo_id INT DEFAULT NULL, og_tags_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, short_body LONGTEXT NOT NULL, body LONGTEXT NOT NULL, is_published TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_140AB62097E3DD86 (seo_id), UNIQUE INDEX UNIQ_140AB6206775AA46 (og_tags_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB62097E3DD86 FOREIGN KEY (seo_id) REFERENCES seo (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6206775AA46 FOREIGN KEY (og_tags_id) REFERENCES ogtags (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB62097E3DD86');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6206775AA46');
        $this->addSql('DROP TABLE page');
    }
}
