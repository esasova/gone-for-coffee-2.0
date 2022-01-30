<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130143045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622DC965AB0');
        $this->addSql('ALTER TABLE rating CHANGE coffeeshop_id coffeeshop_id INT NOT NULL');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622DC965AB0 FOREIGN KEY (coffeeshop_id) REFERENCES coffeeshop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE timeline DROP FOREIGN KEY FK_46FEC666DC965AB0');
        $this->addSql('ALTER TABLE timeline ADD CONSTRAINT FK_46FEC666DC965AB0 FOREIGN KEY (coffeeshop_id) REFERENCES coffeeshop (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622DC965AB0');
        $this->addSql('ALTER TABLE rating CHANGE coffeeshop_id coffeeshop_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622DC965AB0 FOREIGN KEY (coffeeshop_id) REFERENCES coffeeshop (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE timeline DROP FOREIGN KEY FK_46FEC666DC965AB0');
        $this->addSql('ALTER TABLE timeline ADD CONSTRAINT FK_46FEC666DC965AB0 FOREIGN KEY (coffeeshop_id) REFERENCES coffeeshop (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
