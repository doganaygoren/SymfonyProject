<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191210080110 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE about (id INT AUTO_INCREMENT NOT NULL, visio VARCHAR(255) DEFAULT NULL, mission VARCHAR(255) DEFAULT NULL, content VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD children_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C13D3D2749 FOREIGN KEY (children_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_64C19C13D3D2749 ON category (children_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE about');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C13D3D2749');
        $this->addSql('DROP INDEX IDX_64C19C13D3D2749 ON category');
        $this->addSql('ALTER TABLE category DROP children_id');
    }
}
