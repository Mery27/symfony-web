<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240805213500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_tag (blog_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_6EC3989DAE07E97 (blog_id), INDEX IDX_6EC3989BAD26311 (tag_id), PRIMARY KEY(blog_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_tag ADD CONSTRAINT FK_6EC3989DAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blog_tag ADD CONSTRAINT FK_6EC3989BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blog ADD category_id INT DEFAULT NULL, ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C015514312469DE2 FOREIGN KEY (category_id) REFERENCES blog_category (id)');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C01551433DA5256D FOREIGN KEY (image_id) REFERENCES blog_image (id)');
        $this->addSql('CREATE INDEX IDX_C015514312469DE2 ON blog (category_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C01551433DA5256D ON blog (image_id)');
        $this->addSql('ALTER TABLE blog_image_gallery ADD blog_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_image_gallery ADD CONSTRAINT FK_A1BDE58ADAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('CREATE INDEX IDX_A1BDE58ADAE07E97 ON blog_image_gallery (blog_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_tag DROP FOREIGN KEY FK_6EC3989DAE07E97');
        $this->addSql('ALTER TABLE blog_tag DROP FOREIGN KEY FK_6EC3989BAD26311');
        $this->addSql('DROP TABLE blog_tag');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C015514312469DE2');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C01551433DA5256D');
        $this->addSql('DROP INDEX IDX_C015514312469DE2 ON blog');
        $this->addSql('DROP INDEX UNIQ_C01551433DA5256D ON blog');
        $this->addSql('ALTER TABLE blog DROP category_id, DROP image_id');
        $this->addSql('ALTER TABLE blog_image_gallery DROP FOREIGN KEY FK_A1BDE58ADAE07E97');
        $this->addSql('DROP INDEX IDX_A1BDE58ADAE07E97 ON blog_image_gallery');
        $this->addSql('ALTER TABLE blog_image_gallery DROP blog_id');
    }
}
