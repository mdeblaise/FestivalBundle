<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170530124753 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE days_of_presence ADD edition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE days_of_presence ADD CONSTRAINT FK_498D0DCE74281A5E FOREIGN KEY (edition_id) REFERENCES edition (id)');
        $this->addSql('CREATE INDEX IDX_498D0DCE74281A5E ON days_of_presence (edition_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE days_of_presence DROP FOREIGN KEY FK_498D0DCE74281A5E');
        $this->addSql('DROP INDEX IDX_498D0DCE74281A5E ON days_of_presence');
        $this->addSql('ALTER TABLE days_of_presence DROP edition_id');
    }
}
