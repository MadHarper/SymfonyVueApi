<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190223143417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE api_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE api_token (id INT NOT NULL, api_user_id INT NOT NULL, token VARCHAR(255) NOT NULL, axpires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7BA2F5EB4A50A7F2 ON api_token (api_user_id)');
        $this->addSql('CREATE TABLE app_user (id INT NOT NULL, uuid VARCHAR(180) NOT NULL, roles JSON NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9D17F50A6 ON app_user (uuid)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE api_token DROP CONSTRAINT FK_7BA2F5EB4A50A7F2');
        $this->addSql('DROP SEQUENCE api_token_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_user_id_seq CASCADE');
        $this->addSql('DROP TABLE api_token');
        $this->addSql('DROP TABLE app_user');
    }
}
