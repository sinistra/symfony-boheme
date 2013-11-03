<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131007165101 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE wines (id INT AUTO_INCREMENT NOT NULL, variety_id INT DEFAULT NULL, region_id INT DEFAULT NULL, title VARCHAR(64) NOT NULL, note LONGTEXT NOT NULL, glassvolume INT NOT NULL, glassprice NUMERIC(10, 2) NOT NULL, carafevolume INT NOT NULL, carafeprice NUMERIC(10, 2) NOT NULL, bottlevolume INT NOT NULL, bottleprice NUMERIC(10, 2) NOT NULL, created DATETIME NOT NULL, createdby VARCHAR(255) NOT NULL, updated DATETIME NOT NULL, updatedby VARCHAR(255) NOT NULL, INDEX IDX_58312A0578C2BC47 (variety_id), INDEX IDX_58312A0598260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE wineregions (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(64) NOT NULL, content VARCHAR(255) NOT NULL, created DATETIME NOT NULL, createdBy VARCHAR(25) NOT NULL, updated DATETIME NOT NULL, updatedBy VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE winevarieties (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(64) NOT NULL, content VARCHAR(255) NOT NULL, created DATETIME NOT NULL, createdBy VARCHAR(25) NOT NULL, updated DATETIME NOT NULL, updatedBy VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE wines ADD CONSTRAINT FK_58312A0578C2BC47 FOREIGN KEY (variety_id) REFERENCES winevarieties (id)");
        $this->addSql("ALTER TABLE wines ADD CONSTRAINT FK_58312A0598260155 FOREIGN KEY (region_id) REFERENCES wineregions (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE wines DROP FOREIGN KEY FK_58312A0598260155");
        $this->addSql("ALTER TABLE wines DROP FOREIGN KEY FK_58312A0578C2BC47");
        $this->addSql("DROP TABLE wines");
        $this->addSql("DROP TABLE wineregions");
        $this->addSql("DROP TABLE winevarieties");
    }
}
