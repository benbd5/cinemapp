<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223084918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actors (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, role VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movies (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, release_date DATE NOT NULL, synopsis VARCHAR(255) NOT NULL, duration INT NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movies_category (movies_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_EE38B6F953F590A4 (movies_id), INDEX IDX_EE38B6F912469DE2 (category_id), PRIMARY KEY(movies_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movies_actors (movies_id INT NOT NULL, actors_id INT NOT NULL, INDEX IDX_A857225153F590A4 (movies_id), INDEX IDX_A85722517168CF59 (actors_id), PRIMARY KEY(movies_id, actors_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opinions (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, movies_id INT DEFAULT NULL, commentary LONGTEXT DEFAULT NULL, stars INT NOT NULL, publication_date DATE NOT NULL, INDEX IDX_BEAF78D067B3B43D (users_id), INDEX IDX_BEAF78D053F590A4 (movies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movies_category ADD CONSTRAINT FK_EE38B6F953F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movies_category ADD CONSTRAINT FK_EE38B6F912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movies_actors ADD CONSTRAINT FK_A857225153F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movies_actors ADD CONSTRAINT FK_A85722517168CF59 FOREIGN KEY (actors_id) REFERENCES actors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE opinions ADD CONSTRAINT FK_BEAF78D067B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE opinions ADD CONSTRAINT FK_BEAF78D053F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movies_actors DROP FOREIGN KEY FK_A85722517168CF59');
        $this->addSql('ALTER TABLE movies_category DROP FOREIGN KEY FK_EE38B6F912469DE2');
        $this->addSql('ALTER TABLE movies_category DROP FOREIGN KEY FK_EE38B6F953F590A4');
        $this->addSql('ALTER TABLE movies_actors DROP FOREIGN KEY FK_A857225153F590A4');
        $this->addSql('ALTER TABLE opinions DROP FOREIGN KEY FK_BEAF78D053F590A4');
        $this->addSql('ALTER TABLE opinions DROP FOREIGN KEY FK_BEAF78D067B3B43D');
        $this->addSql('DROP TABLE actors');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE movies');
        $this->addSql('DROP TABLE movies_category');
        $this->addSql('DROP TABLE movies_actors');
        $this->addSql('DROP TABLE opinions');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
