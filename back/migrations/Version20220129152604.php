<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220129152604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE day (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, coffeeshop_id INT NOT NULL, user_id INT NOT NULL, rating INT NOT NULL, INDEX IDX_D8892622DC965AB0 (coffeeshop_id), INDEX IDX_D8892622A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timetable (id INT AUTO_INCREMENT NOT NULL, coffeeshop_id INT NOT NULL, start TIME NOT NULL, end TIME NOT NULL, UNIQUE INDEX UNIQ_6B1F670DC965AB0 (coffeeshop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timetable_day (timetable_id INT NOT NULL, day_id INT NOT NULL, INDEX IDX_6600A558CC306847 (timetable_id), INDEX IDX_6600A5589C24126 (day_id), PRIMARY KEY(timetable_id, day_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622DC965AB0 FOREIGN KEY (coffeeshop_id) REFERENCES coffeeshop (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE timetable ADD CONSTRAINT FK_6B1F670DC965AB0 FOREIGN KEY (coffeeshop_id) REFERENCES coffeeshop (id)');
        $this->addSql('ALTER TABLE timetable_day ADD CONSTRAINT FK_6600A558CC306847 FOREIGN KEY (timetable_id) REFERENCES timetable (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE timetable_day ADD CONSTRAINT FK_6600A5589C24126 FOREIGN KEY (day_id) REFERENCES day (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE timetable_day DROP FOREIGN KEY FK_6600A5589C24126');
        $this->addSql('ALTER TABLE timetable_day DROP FOREIGN KEY FK_6600A558CC306847');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A76ED395');
        $this->addSql('DROP TABLE day');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE timetable');
        $this->addSql('DROP TABLE timetable_day');
        $this->addSql('DROP TABLE user');
    }
}
