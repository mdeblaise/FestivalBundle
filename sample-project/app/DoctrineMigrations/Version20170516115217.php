<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170516115217 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contactExponent ADD card_exponent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contactExponent ADD CONSTRAINT FK_1C0CDAFA69C92B36 FOREIGN KEY (card_exponent_id) REFERENCES CardExponent (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1C0CDAFA69C92B36 ON contactExponent (card_exponent_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contactExponent DROP FOREIGN KEY FK_1C0CDAFA69C92B36');
        $this->addSql('DROP INDEX UNIQ_1C0CDAFA69C92B36 ON contactExponent');
        $this->addSql('ALTER TABLE contactExponent DROP card_exponent_id');
    }
}
