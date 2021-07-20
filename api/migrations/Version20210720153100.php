<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210720153100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE todo_learning_materials_course (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', review VARCHAR(2000) DEFAULT NULL, rating SMALLINT DEFAULT NULL, steps INT DEFAULT NULL, step INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE todo_learning_materials_media (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', review VARCHAR(2000) DEFAULT NULL, rating SMALLINT DEFAULT NULL, duration VARCHAR(9) DEFAULT NULL, pause VARCHAR(9) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE todo_learning_materials_read (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', review VARCHAR(2000) DEFAULT NULL, rating SMALLINT DEFAULT NULL, pages INT DEFAULT NULL, page INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE todos (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(200) NOT NULL, description VARCHAR(1600) DEFAULT NULL, due DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', type VARCHAR(255) NOT NULL, INDEX IDX_CD826255A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(150) NOT NULL, name VARCHAR(100) NOT NULL, password VARCHAR(128) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE todo_learning_materials_course ADD CONSTRAINT FK_8FCD50B3BF396750 FOREIGN KEY (id) REFERENCES todos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE todo_learning_materials_media ADD CONSTRAINT FK_3042110FBF396750 FOREIGN KEY (id) REFERENCES todos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE todo_learning_materials_read ADD CONSTRAINT FK_F3385999BF396750 FOREIGN KEY (id) REFERENCES todos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE todos ADD CONSTRAINT FK_CD826255A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE todo_learning_materials_course DROP FOREIGN KEY FK_8FCD50B3BF396750');
        $this->addSql('ALTER TABLE todo_learning_materials_media DROP FOREIGN KEY FK_3042110FBF396750');
        $this->addSql('ALTER TABLE todo_learning_materials_read DROP FOREIGN KEY FK_F3385999BF396750');
        $this->addSql('ALTER TABLE todos DROP FOREIGN KEY FK_CD826255A76ED395');
        $this->addSql('DROP TABLE todo_learning_materials_course');
        $this->addSql('DROP TABLE todo_learning_materials_media');
        $this->addSql('DROP TABLE todo_learning_materials_read');
        $this->addSql('DROP TABLE todos');
        $this->addSql('DROP TABLE users');
    }
}
