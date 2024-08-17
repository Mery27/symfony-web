<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240816062923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C01551436775AA46');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6206775AA46');
        $this->addSql('CREATE TABLE og_tags (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(50) DEFAULT NULL, type VARCHAR(50) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, site_name VARCHAR(50) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE ogtags');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C01551436775AA46');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C01551436775AA46 FOREIGN KEY (og_tags_id) REFERENCES og_tags (id)');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6206775AA46');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6206775AA46 FOREIGN KEY (og_tags_id) REFERENCES og_tags (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C01551436775AA46');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6206775AA46');
        $this->addSql('CREATE TABLE ogtags (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, title VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, url VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, site_name VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE og_tags');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C01551436775AA46');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C01551436775AA46 FOREIGN KEY (og_tags_id) REFERENCES ogtags (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6206775AA46');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6206775AA46 FOREIGN KEY (og_tags_id) REFERENCES ogtags (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
