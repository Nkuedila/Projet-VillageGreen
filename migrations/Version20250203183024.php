<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250203183024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD userstype_id INT NOT NULL, ADD commercial_id INT NOT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E93398E580 FOREIGN KEY (userstype_id) REFERENCES users_type (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E97854071C FOREIGN KEY (commercial_id) REFERENCES commercial (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E93398E580 ON users (userstype_id)');
        $this->addSql('CREATE INDEX IDX_1483A5E97854071C ON users (commercial_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E93398E580');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E97854071C');
        $this->addSql('DROP INDEX IDX_1483A5E93398E580 ON users');
        $this->addSql('DROP INDEX IDX_1483A5E97854071C ON users');
        $this->addSql('ALTER TABLE users DROP userstype_id, DROP commercial_id');
    }
}
