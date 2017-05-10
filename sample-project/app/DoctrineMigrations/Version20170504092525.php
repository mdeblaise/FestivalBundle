<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170504092525 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CardExponent (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actuality (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, title VARCHAR(100) NOT NULL, contents VARCHAR(141) DEFAULT NULL, published_at DATETIME DEFAULT NULL, illustration VARCHAR(255) DEFAULT NULL, alt VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, target VARCHAR(2) NOT NULL, status VARCHAR(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_4093DDD84ACC9A20 (card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contactPress (id INT AUTO_INCREMENT NOT NULL, civility VARCHAR(4) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, media VARCHAR(3) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(10) NOT NULL, address VARCHAR(100) NOT NULL, postal_code VARCHAR(100) NOT NULL, city VARCHAR(100) NOT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exponent (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, name VARCHAR(100) NOT NULL, descriptif LONGTEXT DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, vignette VARCHAR(255) DEFAULT NULL, alt VARCHAR(255) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, stand VARCHAR(50) DEFAULT NULL, level VARCHAR(50) DEFAULT NULL, status VARCHAR(1) NOT NULL, univers VARCHAR(3) NOT NULL, edition VARCHAR(25) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_B1D78504ACC9A20 (card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CardGuest (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CardActivity (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE play (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, department_number VARCHAR(2) NOT NULL, phone VARCHAR(10) NOT NULL, receive_information TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, link VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) NOT NULL, alt VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CardActuality (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, title VARCHAR(100) NOT NULL, descriptif LONGTEXT DEFAULT NULL, vignette VARCHAR(255) DEFAULT NULL, alt_vignette VARCHAR(255) DEFAULT NULL, cover_photo VARCHAR(255) DEFAULT NULL, alt_cover_photo VARCHAR(255) DEFAULT NULL, type VARCHAR(4) NOT NULL, univers VARCHAR(3) NOT NULL, status VARCHAR(1) NOT NULL, edition VARCHAR(25) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, this_friday TINYINT(1) NOT NULL, this_saturday TINYINT(1) NOT NULL, this_sunday TINYINT(1) NOT NULL, INDEX IDX_AC74095A4ACC9A20 (card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_card_guest (activity_id INT NOT NULL, card_guest_id INT NOT NULL, INDEX IDX_C16155FB81C06096 (activity_id), INDEX IDX_C16155FB237B68DB (card_guest_id), PRIMARY KEY(activity_id, card_guest_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE getProgram (id INT AUTO_INCREMENT NOT NULL, civility VARCHAR(4) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(10) NOT NULL, address VARCHAR(100) NOT NULL, postal_code VARCHAR(100) NOT NULL, city VARCHAR(100) NOT NULL, receive_information TINYINT(1) NOT NULL, not_transmit_data TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guest (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, name VARCHAR(100) NOT NULL, external_link VARCHAR(255) DEFAULT NULL, vignette VARCHAR(255) DEFAULT NULL, alt_vignette VARCHAR(255) DEFAULT NULL, cover_photo VARCHAR(255) DEFAULT NULL, alt_cover_photo VARCHAR(255) DEFAULT NULL, biography LONGTEXT DEFAULT NULL, guest_of_honor TINYINT(1) NOT NULL, univers VARCHAR(3) NOT NULL, status VARCHAR(1) NOT NULL, edition VARCHAR(25) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, this_friday TINYINT(1) NOT NULL, this_saturday TINYINT(1) NOT NULL, this_sunday TINYINT(1) NOT NULL, INDEX IDX_ACB79A354ACC9A20 (card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actuality ADD CONSTRAINT FK_4093DDD84ACC9A20 FOREIGN KEY (card_id) REFERENCES CardActuality (id)');
        $this->addSql('ALTER TABLE exponent ADD CONSTRAINT FK_B1D78504ACC9A20 FOREIGN KEY (card_id) REFERENCES CardExponent (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A4ACC9A20 FOREIGN KEY (card_id) REFERENCES CardActivity (id)');
        $this->addSql('ALTER TABLE activity_card_guest ADD CONSTRAINT FK_C16155FB81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_card_guest ADD CONSTRAINT FK_C16155FB237B68DB FOREIGN KEY (card_guest_id) REFERENCES CardGuest (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE guest ADD CONSTRAINT FK_ACB79A354ACC9A20 FOREIGN KEY (card_id) REFERENCES CardGuest (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exponent DROP FOREIGN KEY FK_B1D78504ACC9A20');
        $this->addSql('ALTER TABLE activity_card_guest DROP FOREIGN KEY FK_C16155FB237B68DB');
        $this->addSql('ALTER TABLE guest DROP FOREIGN KEY FK_ACB79A354ACC9A20');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A4ACC9A20');
        $this->addSql('ALTER TABLE actuality DROP FOREIGN KEY FK_4093DDD84ACC9A20');
        $this->addSql('ALTER TABLE activity_card_guest DROP FOREIGN KEY FK_C16155FB81C06096');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE CardExponent');
        $this->addSql('DROP TABLE actuality');
        $this->addSql('DROP TABLE contactPress');
        $this->addSql('DROP TABLE exponent');
        $this->addSql('DROP TABLE CardGuest');
        $this->addSql('DROP TABLE CardActivity');
        $this->addSql('DROP TABLE play');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE CardActuality');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE activity_card_guest');
        $this->addSql('DROP TABLE getProgram');
        $this->addSql('DROP TABLE guest');
    }
}
