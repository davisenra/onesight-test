<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230825000315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__tasks AS SELECT id, user_id, title, description, status, created_at, updated_at FROM tasks');
        $this->addSql('DROP TABLE tasks');
        $this->addSql('CREATE TABLE tasks (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, status INTEGER NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_50586597A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tasks (id, user_id, title, description, status, created_at, updated_at) SELECT id, user_id, title, description, status, created_at, updated_at FROM __temp__tasks');
        $this->addSql('DROP TABLE __temp__tasks');
        $this->addSql('CREATE INDEX IDX_50586597A76ED395 ON tasks (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__users AS SELECT id, email, roles, password, created_at, updated_at FROM users');
        $this->addSql('DROP TABLE users');
        $this->addSql('CREATE TABLE users (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO users (id, email, roles, password, created_at, updated_at) SELECT id, email, roles, password, created_at, updated_at FROM __temp__users');
        $this->addSql('DROP TABLE __temp__users');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__tasks AS SELECT id, user_id, title, description, status, created_at, updated_at FROM "tasks"');
        $this->addSql('DROP TABLE "tasks"');
        $this->addSql('CREATE TABLE "tasks" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, status INTEGER NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_50586597A76ED395 FOREIGN KEY (user_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "tasks" (id, user_id, title, description, status, created_at, updated_at) SELECT id, user_id, title, description, status, created_at, updated_at FROM __temp__tasks');
        $this->addSql('DROP TABLE __temp__tasks');
        $this->addSql('CREATE INDEX IDX_50586597A76ED395 ON "tasks" (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__users AS SELECT id, email, roles, password, created_at, updated_at FROM "users"');
        $this->addSql('DROP TABLE "users"');
        $this->addSql('CREATE TABLE "users" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, created_at DATE NOT NULL --(DC2Type:date_immutable)
        , updated_at DATE NOT NULL --(DC2Type:date_immutable)
        )');
        $this->addSql('INSERT INTO "users" (id, email, roles, password, created_at, updated_at) SELECT id, email, roles, password, created_at, updated_at FROM __temp__users');
        $this->addSql('DROP TABLE __temp__users');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON "users" (email)');
    }
}
