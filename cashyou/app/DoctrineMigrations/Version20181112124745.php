<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181112124745 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
		
		$this->connection->executeQuery('CREATE TABLE registration_steps 
		(id SMALLINT AUTO_INCREMENT NOT NULL, 
		alias VARCHAR(100) DEFAULT \'\' NOT NULL, 
		name VARCHAR(100) DEFAULT \'\' NOT NULL,
		prev_id SMALLINT DEFAULT NULL,
		step_number SMALLINT NOT NULL,
		probability SMALLINT DEFAULT 0,
		bonus SMALLINT DEFAULT 0,
		PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
		
		$this->connection->executeQuery('CREATE INDEX prev_id_idx ON registration_steps (prev_id)');

		$this->connection->executeQuery('
		ALTER TABLE registration_steps
		ADD FOREIGN KEY fk_registration_steps_prev_id(prev_id)
		REFERENCES registration_steps(id)
		ON DELETE NO ACTION
		ON UPDATE CASCADE;');

		$this->connection->executeQuery("INSERT INTO `registration_steps` (`name`, `alias`, `step_number`, `bonus`) values ('Создайте личный кабинет', 'create-an-account', 1, 100)");

		$accId = $this->connection->lastInsertId();

		$this->connection->executeQuery("INSERT INTO `registration_steps` (`name`, `alias`, `prev_id`, `step_number`, `bonus`) values ('Паспортные данные', 'social-info', ?, 2, 200)", [$accId]);

		$conId = $this->connection->lastInsertId();

		$this->connection->executeQuery("INSERT INTO `registration_steps` (`name`, `alias`, `prev_id`, `step_number`, `bonus`) values ('Адрес проживания', 'address', ?, 3, 250)", [$conId]);

		$addId = $this->connection->lastInsertId();

		$this->connection->executeQuery("INSERT INTO `registration_steps` (`name`, `alias`, `prev_id`, `step_number`, `bonus`) values ('Финансовое состояние', 'finance-state', ?, 4, 250)", [$addId]);

		$finId = $this->connection->lastInsertId();

		$this->connection->executeQuery("INSERT INTO `registration_steps` (`name`, `alias`, `prev_id`, `step_number`, `bonus`) values ('Фото документов', 'photo-of-documents', ?, 5, 1200)", [$finId]);

		$phtId = $this->connection->lastInsertId();


		$this->connection->executeQuery("INSERT INTO `registration_steps` (`name`, `alias`, `prev_id`, `step_number`) values ('Привязка карты', 'link-card', ?, 6)", [$phtId]);

		$crdId = $this->connection->lastInsertId();

		$this->connection->executeQuery("INSERT INTO `registration_steps` (`name`, `alias`, `prev_id`, `step_number`) values ('Регистрация окончена', 'finish', ?, 7)", [$crdId]);
		
		$this->connection->executeQuery('ALTER TABLE users ADD current_step SMALLINT;');
		$this->connection->executeQuery('CREATE INDEX current_step_idx ON users (current_step)');
		
		$this->connection->executeQuery('
		ALTER TABLE users
		ADD FOREIGN KEY fk_users_current_step(current_step)
		REFERENCES registration_steps(id)
		ON DELETE NO ACTION
		ON UPDATE CASCADE;');
		
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
