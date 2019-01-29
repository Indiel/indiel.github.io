<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180227092421 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE repayment_rows (id INT AUTO_INCREMENT NOT NULL, loan_id INT DEFAULT NULL, operation_date DATETIME DEFAULT NULL, is_auto_charge TINYINT(1) DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, amount_left DOUBLE PRECISION DEFAULT NULL, principal DOUBLE PRECISION DEFAULT NULL, base_interest DOUBLE PRECISION DEFAULT NULL, past_due_interest DOUBLE PRECISION DEFAULT NULL, fees DOUBLE PRECISION DEFAULT NULL, administration_fee DOUBLE PRECISION DEFAULT NULL, outstanding_principal DOUBLE PRECISION DEFAULT NULL, payment_type VARCHAR(100) DEFAULT NULL, service_id VARCHAR(1000) DEFAULT NULL, operator_id VARCHAR(1000) DEFAULT NULL, comments LONGTEXT DEFAULT NULL, status VARCHAR(100) DEFAULT NULL, is_successful TINYINT(1) DEFAULT NULL, INDEX IDX_99BBC2D8CE73868F (loan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule_rows (id INT AUTO_INCREMENT NOT NULL, loan_id INT DEFAULT NULL, total DOUBLE PRECISION DEFAULT NULL, fees DOUBLE PRECISION DEFAULT NULL, interest DOUBLE PRECISION DEFAULT NULL, principal INT DEFAULT NULL, status VARCHAR(100) DEFAULT NULL, due_date DATETIME DEFAULT NULL, past_due_interest DOUBLE PRECISION DEFAULT NULL, INDEX IDX_EAC3D4FACE73868F (loan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loan_agreement_documents (id INT AUTO_INCREMENT NOT NULL, loan_id INT DEFAULT NULL, doc_type_id VARCHAR(1000) DEFAULT NULL, doc_type_title VARCHAR(1000) DEFAULT NULL, signature_id VARCHAR(1000) DEFAULT NULL, INDEX IDX_6E36F6C7CE73868F (loan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loans (id INT NOT NULL, user_id INT DEFAULT NULL, public_id VARCHAR(1000) NOT NULL, status VARCHAR(100) DEFAULT NULL, next_payment_date DATETIME DEFAULT NULL, term INT DEFAULT NULL, loan_period_kind VARCHAR(20) DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, interest_rate DOUBLE PRECISION DEFAULT NULL, creation_date DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, is_closed TINYINT(1) DEFAULT NULL, applied_rollovers INT DEFAULT NULL, rollovers_enabled TINYINT(1) DEFAULT NULL, min_rollover_term INT DEFAULT NULL, min_rollover_unit INT DEFAULT NULL COMMENT \'(DC2Type:rollover_unit)\', max_rollover_term INT DEFAULT NULL, max_rollover_unit INT DEFAULT NULL COMMENT \'(DC2Type:rollover_unit)\', max_rollovers INT DEFAULT NULL, outstanding_balance_principal DOUBLE PRECISION DEFAULT NULL, outstanding_balance_interest DOUBLE PRECISION DEFAULT NULL, expected_payment_amount DOUBLE PRECISION DEFAULT NULL, credit_product_id VARCHAR(1000) DEFAULT NULL, credit_product_name VARCHAR(1000) DEFAULT NULL, INDEX IDX_82C24DBCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE repayment_rows ADD CONSTRAINT FK_99BBC2D8CE73868F FOREIGN KEY (loan_id) REFERENCES loans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE schedule_rows ADD CONSTRAINT FK_EAC3D4FACE73868F FOREIGN KEY (loan_id) REFERENCES loans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loan_agreement_documents ADD CONSTRAINT FK_6E36F6C7CE73868F FOREIGN KEY (loan_id) REFERENCES loans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loans ADD CONSTRAINT FK_82C24DBCA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users ADD api_token VARCHAR(255) DEFAULT NULL, CHANGE birth_date birth_date DATETIME DEFAULT NULL, CHANGE passport_registration passport_registration DATETIME DEFAULT NULL, CHANGE passport_valid_date passport_valid_date DATETIME DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E97BA2F5EB ON users (api_token)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE repayment_rows DROP FOREIGN KEY FK_99BBC2D8CE73868F');
        $this->addSql('ALTER TABLE schedule_rows DROP FOREIGN KEY FK_EAC3D4FACE73868F');
        $this->addSql('ALTER TABLE loan_agreement_documents DROP FOREIGN KEY FK_6E36F6C7CE73868F');
        $this->addSql('DROP TABLE repayment_rows');
        $this->addSql('DROP TABLE schedule_rows');
        $this->addSql('DROP TABLE loan_agreement_documents');
        $this->addSql('DROP TABLE loans');
        $this->addSql('DROP INDEX UNIQ_1483A5E97BA2F5EB ON users');
        $this->addSql('ALTER TABLE users DROP api_token, CHANGE birth_date birth_date DATETIME DEFAULT NULL, CHANGE passport_registration passport_registration DATETIME DEFAULT NULL, CHANGE passport_valid_date passport_valid_date DATETIME DEFAULT NULL');
    }
}
