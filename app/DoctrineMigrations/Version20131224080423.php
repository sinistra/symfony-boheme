<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131224080423 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE winetypes (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(64) NOT NULL, created DATETIME NOT NULL, createdBy VARCHAR(25) NOT NULL, updated DATETIME NOT NULL, updatedBy VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE wines ADD type_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE wines ADD CONSTRAINT FK_58312A05C54C8C93 FOREIGN KEY (type_id) REFERENCES winetypes (id)");
        $this->addSql("CREATE INDEX IDX_58312A05C54C8C93 ON wines (type_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE wines DROP FOREIGN KEY FK_58312A05C54C8C93");
        $this->addSql("DROP TABLE winetypes");
        $this->addSql("DROP INDEX IDX_58312A05C54C8C93 ON wines");
        $this->addSql("ALTER TABLE wines DROP type_id");
    }
}
