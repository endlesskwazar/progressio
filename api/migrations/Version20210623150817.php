<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623150817 extends AbstractMigration
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
        $this->addSql('CREATE TABLE media_todo (id INT NOT NULL, duration VARCHAR(255) DEFAULT NULL, pause VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book_todo ADD CONSTRAINT FK_4393FDA8BF396750 FOREIGN KEY (id) REFERENCES todos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_todo ADD CONSTRAINT FK_92AC6BA6BF396750 FOREIGN KEY (id) REFERENCES todos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_todo ADD CONSTRAINT FK_99496973BF396750 FOREIGN KEY (id) REFERENCES todos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE todos DROP pages, DROP page, DROP author, DROP duration, DROP pause, DROP steps, DROP step');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE book_todo');
        $this->addSql('DROP TABLE course_todo');
        $this->addSql('DROP TABLE media_todo');
        $this->addSql('ALTER TABLE todos ADD pages INT DEFAULT NULL, ADD page INT DEFAULT NULL, ADD author VARCHAR(300) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD duration VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD pause VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD steps INT DEFAULT NULL, ADD step INT DEFAULT NULL');
    }
}
