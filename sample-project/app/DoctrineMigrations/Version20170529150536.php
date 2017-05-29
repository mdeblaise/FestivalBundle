<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170529150536 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CardGuest ADD edition_id INT DEFAULT NULL, ADD global_code CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE CardGuest ADD CONSTRAINT FK_5E91452B74281A5E FOREIGN KEY (edition_id) REFERENCES edition (id)');
        $this->addSql('CREATE INDEX IDX_5E91452B74281A5E ON CardGuest (edition_id)');
        $this->addSql('ALTER TABLE guest DROP edition');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE CardGuest DROP FOREIGN KEY FK_5E91452B74281A5E');
        $this->addSql('DROP INDEX IDX_5E91452B74281A5E ON CardGuest');
        $this->addSql('ALTER TABLE CardGuest DROP edition_id, DROP global_code');
        $this->addSql('ALTER TABLE guest ADD edition VARCHAR(25) NOT NULL COLLATE utf8_unicode_ci');
    }
}
