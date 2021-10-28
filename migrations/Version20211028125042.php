<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211028125042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE garde (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, simple SMALLINT NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD sid_id INT NOT NULL, CHANGE gid gid_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491D55F70B FOREIGN KEY (gid_id) REFERENCES garde (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498512B786 FOREIGN KEY (sid_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6491D55F70B ON user (gid_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6498512B786 ON user (sid_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491D55F70B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498512B786');
        $this->addSql('DROP TABLE garde');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP INDEX IDX_8D93D6491D55F70B ON user');
        $this->addSql('DROP INDEX IDX_8D93D6498512B786 ON user');
        $this->addSql('ALTER TABLE user ADD gid INT NOT NULL, DROP gid_id, DROP sid_id');
    }
}
