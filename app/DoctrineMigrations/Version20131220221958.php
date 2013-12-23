<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131220221958 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE users DROP FOREIGN KEY FK_1483A5E961190A32");
        $this->addSql("DROP INDEX IDX_1483A5E961190A32 ON users");
        $this->addSql("ALTER TABLE users DROP club_id");
        $this->addSql("ALTER TABLE meals CHANGE content content LONGTEXT DEFAULT NULL");
        $this->addSql("ALTER TABLE wines CHANGE note note LONGTEXT DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE meals CHANGE content content LONGTEXT NOT NULL");
        $this->addSql("ALTER TABLE users ADD club_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE users ADD CONSTRAINT FK_1483A5E961190A32 FOREIGN KEY (club_id) REFERENCES clubs (id)");
        $this->addSql("CREATE INDEX IDX_1483A5E961190A32 ON users (club_id)");
        $this->addSql("ALTER TABLE wines CHANGE note note LONGTEXT NOT NULL");
    }
}
