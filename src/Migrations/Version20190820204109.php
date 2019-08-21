<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190820204109 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE media_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created DATETIME DEFAULT NULL, deleted DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE media ADD type_id INT NOT NULL, DROP type');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CC54C8C93 FOREIGN KEY (type_id) REFERENCES media_type (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CC54C8C93 ON media (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CC54C8C93');
        $this->addSql('DROP TABLE media_type');
        $this->addSql('DROP INDEX IDX_6A2CA10CC54C8C93 ON media');
        $this->addSql('ALTER TABLE media ADD type VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci, DROP type_id');
    }
}
