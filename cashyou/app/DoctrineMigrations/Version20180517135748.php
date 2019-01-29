<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180517135748 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rollover_agreements ADD expired_days INT DEFAULT NULL, CHANGE created created DATETIME DEFAULT NULL, CHANGE user_birth_date user_birth_date DATETIME DEFAULT NULL, CHANGE user_passport_registration user_passport_registration DATETIME DEFAULT NULL, CHANGE user_passport_valid_date user_passport_valid_date DATETIME DEFAULT NULL, CHANGE loan_next_payment_date loan_next_payment_date DATETIME DEFAULT NULL, CHANGE loan_creation_date loan_creation_date DATETIME DEFAULT NULL');
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

        $this->addSql('ALTER TABLE loans CHANGE next_payment_date next_payment_date DATETIME DEFAULT NULL, CHANGE creation_date creation_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE repayment_rows CHANGE operation_date operation_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE rollover_agreements DROP expired_days, CHANGE created created DATETIME DEFAULT NULL, CHANGE user_birth_date user_birth_date DATETIME DEFAULT NULL, CHANGE user_passport_registration user_passport_registration DATETIME DEFAULT NULL, CHANGE user_passport_valid_date user_passport_valid_date DATETIME DEFAULT NULL, CHANGE loan_next_payment_date loan_next_payment_date DATETIME DEFAULT NULL, CHANGE loan_creation_date loan_creation_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule_rows CHANGE due_date due_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE birth_date birth_date DATETIME DEFAULT NULL, CHANGE passport_registration passport_registration DATETIME DEFAULT NULL, CHANGE passport_valid_date passport_valid_date DATETIME DEFAULT NULL');
    }
}
