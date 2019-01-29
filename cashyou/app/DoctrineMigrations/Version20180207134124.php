<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180207134124 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE avator_turbo_sms_sent (id INT AUTO_INCREMENT NOT NULL, phone VARCHAR(100) DEFAULT \'\' NOT NULL, message_id VARCHAR(250) DEFAULT \'\' NOT NULL, status VARCHAR(50) DEFAULT \'\' NOT NULL, status_message VARCHAR(250) DEFAULT \'\' NOT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX phone (phone), INDEX status (status), INDEX created_at (created_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, middle_name VARCHAR(255) DEFAULT NULL, gender INT DEFAULT NULL COMMENT \'(DC2Type:gender)\', birth_date DATETIME DEFAULT NULL, phone VARCHAR(32) DEFAULT NULL, work_phone VARCHAR(32) DEFAULT NULL, email VARCHAR(255) NOT NULL, secret_question INT DEFAULT NULL COMMENT \'(DC2Type:secret_question)\', secret_answer VARCHAR(1000) DEFAULT NULL, marital_status INT DEFAULT NULL COMMENT \'(DC2Type:marital_status)\', number_of_dependents INT DEFAULT NULL COMMENT \'(DC2Type:number_of_dependents)\', education INT DEFAULT NULL COMMENT \'(DC2Type:education)\', citizenship INT DEFAULT NULL COMMENT \'(DC2Type:yesno)\', is_passport_new_type INT DEFAULT NULL COMMENT \'(DC2Type:yesno)\', passport VARCHAR(10) DEFAULT NULL, passport_registration DATETIME DEFAULT NULL, passport_issued_by VARCHAR(1000) DEFAULT NULL, passport_valid_date DATETIME DEFAULT NULL, passport_record_number VARCHAR(15) DEFAULT NULL, social_security_number VARCHAR(10) DEFAULT NULL, real_estate INT DEFAULT NULL COMMENT \'(DC2Type:real_estate)\', income_type INT DEFAULT NULL COMMENT \'(DC2Type:income_type)\', monthly_income INT DEFAULT NULL COMMENT \'(DC2Type:monthly_income)\', company_name VARCHAR(255) DEFAULT NULL, position INT DEFAULT NULL COMMENT \'(DC2Type:position)\', business_type INT DEFAULT NULL COMMENT \'(DC2Type:business_type)\', last_experience INT DEFAULT NULL COMMENT \'(DC2Type:working_experience)\', total_experience INT DEFAULT NULL COMMENT \'(DC2Type:working_experience)\', car_owner INT DEFAULT NULL COMMENT \'(DC2Type:yesno)\', real_estate_owner INT DEFAULT NULL COMMENT \'(DC2Type:yesno)\', doc_passport1 LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', doc_passport2 LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', doc_passport3 LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', doc_ipn LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', docs LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json_array)\', address_street VARCHAR(1000) DEFAULT NULL, address_state VARCHAR(1000) DEFAULT NULL, address_type_of_settlement INT DEFAULT NULL COMMENT \'(DC2Type:type_of_settlement)\', address_city VARCHAR(1000) DEFAULT NULL, address_house VARCHAR(100) DEFAULT NULL, address_building VARCHAR(100) DEFAULT NULL, address_apartment VARCHAR(100) DEFAULT NULL, address_zip_code VARCHAR(100) DEFAULT NULL, address_real_estate INT DEFAULT NULL COMMENT \'(DC2Type:real_estate)\', address_residential_matches_registration INT DEFAULT NULL COMMENT \'(DC2Type:yesno)\', second_address_street VARCHAR(1000) DEFAULT NULL, second_address_state VARCHAR(1000) DEFAULT NULL, second_address_type_of_settlement INT DEFAULT NULL COMMENT \'(DC2Type:type_of_settlement)\', second_address_city VARCHAR(1000) DEFAULT NULL, second_address_house VARCHAR(100) DEFAULT NULL, second_address_building VARCHAR(100) DEFAULT NULL, second_address_apartment VARCHAR(100) DEFAULT NULL, second_address_zip_code VARCHAR(100) DEFAULT NULL, second_address_real_estate INT DEFAULT NULL COMMENT \'(DC2Type:real_estate)\', second_address_residential_matches_registration INT DEFAULT NULL COMMENT \'(DC2Type:yesno)\', UNIQUE INDEX UNIQ_1483A5E9AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tracking (id INT AUTO_INCREMENT NOT NULL, sub_id VARCHAR(256) NOT NULL, status VARCHAR(128) NOT NULL COMMENT \'(DC2Type:tracking_status)\', created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE avator_turbo_sms_sent');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE tracking');
    }
}
