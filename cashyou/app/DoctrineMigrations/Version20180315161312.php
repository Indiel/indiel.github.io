<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180315161312 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rollover_agreements (id INT AUTO_INCREMENT NOT NULL, document_id VARCHAR(512) DEFAULT NULL, term_days INT NOT NULL, pdf_template LONGTEXT NOT NULL, created DATETIME DEFAULT NULL, user_login VARCHAR(255) NOT NULL, user_first_name VARCHAR(255) DEFAULT NULL, user_last_name VARCHAR(255) DEFAULT NULL, user_middle_name VARCHAR(255) DEFAULT NULL, user_gender INT DEFAULT NULL COMMENT \'(DC2Type:gender)\', user_birth_date DATETIME DEFAULT NULL, user_phone VARCHAR(32) DEFAULT NULL, user_work_phone VARCHAR(32) DEFAULT NULL, user_email VARCHAR(255) NOT NULL, user_marital_status INT DEFAULT NULL COMMENT \'(DC2Type:marital_status)\', user_number_of_dependents INT DEFAULT NULL COMMENT \'(DC2Type:number_of_dependents)\', user_education INT DEFAULT NULL COMMENT \'(DC2Type:education)\', user_citizenship INT DEFAULT NULL COMMENT \'(DC2Type:yesno)\', user_is_passport_new_type INT DEFAULT NULL COMMENT \'(DC2Type:yesno)\', user_passport VARCHAR(10) DEFAULT NULL, user_passport_registration DATETIME DEFAULT NULL, user_passport_issued_by VARCHAR(1000) DEFAULT NULL, user_passport_valid_date DATETIME DEFAULT NULL, user_passport_record_number VARCHAR(15) DEFAULT NULL, user_social_security_number VARCHAR(10) DEFAULT NULL, user_real_estate INT DEFAULT NULL COMMENT \'(DC2Type:real_estate)\', user_income_type INT DEFAULT NULL COMMENT \'(DC2Type:income_type)\', user_monthly_income INT DEFAULT NULL COMMENT \'(DC2Type:monthly_income)\', user_company_name VARCHAR(255) DEFAULT NULL, user_position INT DEFAULT NULL COMMENT \'(DC2Type:position)\', user_business_type INT DEFAULT NULL COMMENT \'(DC2Type:business_type)\', user_last_experience INT DEFAULT NULL COMMENT \'(DC2Type:working_experience)\', user_total_experience INT DEFAULT NULL COMMENT \'(DC2Type:working_experience)\', user_car_owner INT DEFAULT NULL COMMENT \'(DC2Type:yesno)\', user_real_estate_owner INT DEFAULT NULL COMMENT \'(DC2Type:yesno)\', user_address_street VARCHAR(1000) DEFAULT NULL, user_address_state VARCHAR(1000) DEFAULT NULL, user_address_type_of_settlement INT DEFAULT NULL COMMENT \'(DC2Type:type_of_settlement)\', user_address_city VARCHAR(1000) DEFAULT NULL, user_address_house VARCHAR(100) DEFAULT NULL, user_address_building VARCHAR(100) DEFAULT NULL, user_address_apartment VARCHAR(100) DEFAULT NULL, user_address_zip_code VARCHAR(100) DEFAULT NULL, user_address_real_estate INT DEFAULT NULL COMMENT \'(DC2Type:real_estate)\', user_address_residential_matches_registration INT DEFAULT NULL COMMENT \'(DC2Type:yesno)\', user_second_address_street VARCHAR(1000) DEFAULT NULL, user_second_address_state VARCHAR(1000) DEFAULT NULL, user_second_address_type_of_settlement INT DEFAULT NULL COMMENT \'(DC2Type:type_of_settlement)\', user_second_address_city VARCHAR(1000) DEFAULT NULL, user_second_address_house VARCHAR(100) DEFAULT NULL, user_second_address_building VARCHAR(100) DEFAULT NULL, user_second_address_apartment VARCHAR(100) DEFAULT NULL, user_second_address_zip_code VARCHAR(100) DEFAULT NULL, user_second_address_real_estate INT DEFAULT NULL COMMENT \'(DC2Type:real_estate)\', user_second_address_residential_matches_registration INT DEFAULT NULL COMMENT \'(DC2Type:yesno)\', loan_id INT NOT NULL, loan_public_id VARCHAR(1000) NOT NULL, loan_status VARCHAR(100) DEFAULT NULL, loan_next_payment_date DATETIME DEFAULT NULL, loan_term INT DEFAULT NULL, loan_loan_period_kind VARCHAR(20) DEFAULT NULL, loan_amount DOUBLE PRECISION DEFAULT NULL, loan_interest_rate DOUBLE PRECISION DEFAULT NULL, loan_creation_date DATETIME DEFAULT NULL, loan_is_active TINYINT(1) DEFAULT NULL, loan_is_closed TINYINT(1) DEFAULT NULL, loan_applied_rollovers INT DEFAULT NULL, loan_rollovers_enabled TINYINT(1) DEFAULT NULL, loan_min_rollover_term INT DEFAULT NULL, loan_min_rollover_unit INT DEFAULT NULL COMMENT \'(DC2Type:rollover_unit)\', loan_max_rollover_term INT DEFAULT NULL, loan_max_rollover_unit INT DEFAULT NULL COMMENT \'(DC2Type:rollover_unit)\', loan_max_rollovers INT DEFAULT NULL, loan_outstanding_balance_principal DOUBLE PRECISION DEFAULT NULL, loan_outstanding_balance_interest DOUBLE PRECISION DEFAULT NULL, loan_expected_payment_amount DOUBLE PRECISION DEFAULT NULL, loan_credit_product_id VARCHAR(1000) DEFAULT NULL, loan_credit_product_name VARCHAR(1000) DEFAULT NULL, UNIQUE INDEX UNIQ_4F01643FC33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE repayment_rows CHANGE operation_date operation_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule_rows CHANGE due_date due_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE birth_date birth_date DATETIME DEFAULT NULL, CHANGE passport_registration passport_registration DATETIME DEFAULT NULL, CHANGE passport_valid_date passport_valid_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE loans CHANGE next_payment_date next_payment_date DATETIME DEFAULT NULL, CHANGE creation_date creation_date DATETIME DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE rollover_agreements');
        $this->addSql('ALTER TABLE loans CHANGE next_payment_date next_payment_date DATETIME DEFAULT NULL, CHANGE creation_date creation_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE repayment_rows CHANGE operation_date operation_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule_rows CHANGE due_date due_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE birth_date birth_date DATETIME DEFAULT NULL, CHANGE passport_registration passport_registration DATETIME DEFAULT NULL, CHANGE passport_valid_date passport_valid_date DATETIME DEFAULT NULL');
    }
}
