<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170530133219 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE card_guest_days_of_presence (card_guest_id INT NOT NULL, days_of_presence_id INT NOT NULL, INDEX IDX_ADE34608237B68DB (card_guest_id), INDEX IDX_ADE34608DBD7FFE3 (days_of_presence_id), PRIMARY KEY(card_guest_id, days_of_presence_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE card_guest_days_of_presence ADD CONSTRAINT FK_ADE34608237B68DB FOREIGN KEY (card_guest_id) REFERENCES CardGuest (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE card_guest_days_of_presence ADD CONSTRAINT FK_ADE34608DBD7FFE3 FOREIGN KEY (days_of_presence_id) REFERENCES days_of_presence (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE card_guest_days_of_presence');
    }
}
