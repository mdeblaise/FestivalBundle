<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170523152145 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CardExponent ADD edition_id INT DEFAULT NULL, ADD global_code CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE CardExponent ADD CONSTRAINT FK_C908AAF574281A5E FOREIGN KEY (edition_id) REFERENCES edition (id)');
        $this->addSql('CREATE INDEX IDX_C908AAF574281A5E ON CardExponent (edition_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CardExponent DROP FOREIGN KEY FK_C908AAF574281A5E');
        $this->addSql('DROP INDEX IDX_C908AAF574281A5E ON CardExponent');
        $this->addSql('ALTER TABLE CardExponent DROP edition_id, DROP global_code');
    }
}
