<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170522132408 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CardActivity ADD edition_id INT DEFAULT NULL, DROP edition');
        $this->addSql('ALTER TABLE CardActivity ADD CONSTRAINT FK_6E61DBFF74281A5E FOREIGN KEY (edition_id) REFERENCES edition (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6E61DBFF74281A5E ON CardActivity (edition_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CardActivity DROP FOREIGN KEY FK_6E61DBFF74281A5E');
        $this->addSql('DROP INDEX UNIQ_6E61DBFF74281A5E ON CardActivity');
        $this->addSql('ALTER TABLE CardActivity ADD edition VARCHAR(4) NOT NULL COLLATE utf8_unicode_ci, DROP edition_id');
    }
}
