<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191210103524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE settings (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, keyword VARCHAR(50) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, mobile VARCHAR(20) DEFAULT NULL, fax VARCHAR(20) DEFAULT NULL, mail VARCHAR(50) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, google VARCHAR(50) DEFAULT NULL, recapctha VARCHAR(50) DEFAULT NULL, map VARCHAR(50) DEFAULT NULL, facebook VARCHAR(100) DEFAULT NULL, twitter VARCHAR(50) DEFAULT NULL, instagram VARCHAR(50) NOT NULL, youtube VARCHAR(50) DEFAULT NULL, smtp_user VARCHAR(50) DEFAULT NULL, smtp_password VARCHAR(255) DEFAULT NULL, smtp_host VARCHAR(50) DEFAULT NULL, smtp_port VARCHAR(50) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE settings');
    }
}
