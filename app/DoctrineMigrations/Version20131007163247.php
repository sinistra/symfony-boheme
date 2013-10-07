<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131007163247 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE meals (id INT AUTO_INCREMENT NOT NULL, sitting_id INT DEFAULT NULL, menugroup_id INT DEFAULT NULL, title VARCHAR(64) NOT NULL, content LONGTEXT NOT NULL, publish DATE NOT NULL, expire DATE NOT NULL, price NUMERIC(10, 2) NOT NULL, created DATETIME NOT NULL, createdby VARCHAR(255) NOT NULL, updated DATETIME NOT NULL, updatedby VARCHAR(255) NOT NULL, INDEX IDX_E229E6EA8014E66 (sitting_id), INDEX IDX_E229E6EA2C72584 (menugroup_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE menugroups (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(64) NOT NULL, content VARCHAR(255) NOT NULL, created DATETIME NOT NULL, createdBy VARCHAR(25) NOT NULL, updated DATETIME NOT NULL, updatedBy VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sittings (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(64) NOT NULL, content VARCHAR(255) NOT NULL, created DATETIME NOT NULL, createdBy VARCHAR(25) NOT NULL, updated DATETIME NOT NULL, updatedBy VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE meals ADD CONSTRAINT FK_E229E6EA8014E66 FOREIGN KEY (sitting_id) REFERENCES sittings (id)");
        $this->addSql("ALTER TABLE meals ADD CONSTRAINT FK_E229E6EA2C72584 FOREIGN KEY (menugroup_id) REFERENCES menugroups (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE meals DROP FOREIGN KEY FK_E229E6EA2C72584");
        $this->addSql("ALTER TABLE meals DROP FOREIGN KEY FK_E229E6EA8014E66");
        $this->addSql("DROP TABLE meals");
        $this->addSql("DROP TABLE menugroups");
        $this->addSql("DROP TABLE sittings");
    }
}
