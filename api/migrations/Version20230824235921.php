<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230824235921 extends AbstractMigration
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
        $this->addSql('CREATE TABLE tasks (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, status INTEGER NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_50586597A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tasks (id, user_id, title, description, status, created_at, updated_at) SELECT id, user_id, title, description, status, created_at, updated_at FROM __temp__tasks');
        $this->addSql('DROP TABLE __temp__tasks');
        $this->addSql('CREATE INDEX IDX_50586597A76ED395 ON tasks (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__tasks AS SELECT id, user_id, title, description, status, created_at, updated_at FROM "tasks"');
        $this->addSql('DROP TABLE "tasks"');
        $this->addSql('CREATE TABLE "tasks" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, status INTEGER NOT NULL, created_at DATE NOT NULL --(DC2Type:date_immutable)
        , updated_at DATE NOT NULL --(DC2Type:date_immutable)
        , CONSTRAINT FK_50586597A76ED395 FOREIGN KEY (user_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "tasks" (id, user_id, title, description, status, created_at, updated_at) SELECT id, user_id, title, description, status, created_at, updated_at FROM __temp__tasks');
        $this->addSql('DROP TABLE __temp__tasks');
        $this->addSql('CREATE INDEX IDX_50586597A76ED395 ON "tasks" (user_id)');
    }
}
