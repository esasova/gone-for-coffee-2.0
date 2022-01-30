<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220129155650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE timeline ADD coffeeshop_id INT NOT NULL');
        $this->addSql('ALTER TABLE timeline ADD CONSTRAINT FK_46FEC666DC965AB0 FOREIGN KEY (coffeeshop_id) REFERENCES coffeeshop (id)');
        $this->addSql('CREATE INDEX IDX_46FEC666DC965AB0 ON timeline (coffeeshop_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE timeline DROP FOREIGN KEY FK_46FEC666DC965AB0');
        $this->addSql('DROP INDEX IDX_46FEC666DC965AB0 ON timeline');
        $this->addSql('ALTER TABLE timeline DROP coffeeshop_id');
    }
}
