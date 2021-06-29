<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629145800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book_todo (id INT NOT NULL, pages INT DEFAULT NULL, page INT DEFAULT NULL, author VARCHAR(300) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_todo (id INT NOT NULL, steps INT DEFAULT NULL, step INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE files (id INT AUTO_INCREMENT NOT NULL, original_file_name VARCHAR(500) NOT NULL, src VARCHAR(500) NOT NULL, kind VARCHAR(20) NOT NULL, mime VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_todo (id INT NOT NULL, duration VARCHAR(255) DEFAULT NULL, pause VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE todos (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, due DATETIME DEFAULT NULL, body VARCHAR(8000) DEFAULT NULL, done TINYINT(1) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE url (id INT AUTO_INCREMENT NOT NULL, todo_id INT NOT NULL, src VARCHAR(300) NOT NULL, description VARCHAR(200) NOT NULL, INDEX IDX_F47645AEEA1EBC33 (todo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(150) NOT NULL, name VARCHAR(100) NOT NULL, password VARCHAR(128) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book_todo ADD CONSTRAINT FK_4393FDA8BF396750 FOREIGN KEY (id) REFERENCES todos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_todo ADD CONSTRAINT FK_92AC6BA6BF396750 FOREIGN KEY (id) REFERENCES todos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_todo ADD CONSTRAINT FK_99496973BF396750 FOREIGN KEY (id) REFERENCES todos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE url ADD CONSTRAINT FK_F47645AEEA1EBC33 FOREIGN KEY (todo_id) REFERENCES todos (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book_todo DROP FOREIGN KEY FK_4393FDA8BF396750');
        $this->addSql('ALTER TABLE course_todo DROP FOREIGN KEY FK_92AC6BA6BF396750');
        $this->addSql('ALTER TABLE media_todo DROP FOREIGN KEY FK_99496973BF396750');
        $this->addSql('ALTER TABLE url DROP FOREIGN KEY FK_F47645AEEA1EBC33');
        $this->addSql('DROP TABLE book_todo');
        $this->addSql('DROP TABLE course_todo');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE media_todo');
        $this->addSql('DROP TABLE todos');
        $this->addSql('DROP TABLE url');
        $this->addSql('DROP TABLE users');
    }
}
