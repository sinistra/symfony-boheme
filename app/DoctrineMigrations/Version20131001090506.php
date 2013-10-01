<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131001090506 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(255) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX translations_lookup_idx (locale, object_class, foreign_key), UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT '(DC2Type:array)', username VARCHAR(255) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE groups (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, role VARCHAR(20) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, UNIQUE INDEX UNIQ_F06D397057698A6A (role), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE blogs (id VARCHAR(32) NOT NULL, title VARCHAR(64) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, createdBy VARCHAR(255) NOT NULL, updatedBy VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, name VARCHAR(50) NOT NULL, salt VARCHAR(32) NOT NULL, password VARCHAR(40) NOT NULL, email VARCHAR(60) NOT NULL, token VARCHAR(20) DEFAULT NULL, is_active TINYINT(1) NOT NULL, logins INT DEFAULT 0 NOT NULL, created DATETIME NOT NULL, createdBy VARCHAR(255) NOT NULL, updated DATETIME NOT NULL, updatedBy VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), UNIQUE INDEX UNIQ_1483A5E95F37A13B (token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_8F02BF9DA76ED395 (user_id), INDEX IDX_8F02BF9DFE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE menus (id INT AUTO_INCREMENT NOT NULL, parent INT NOT NULL, seq INT NOT NULL, title VARCHAR(30) NOT NULL, icon VARCHAR(20) DEFAULT NULL, url VARCHAR(50) NOT NULL, secured TINYINT(1) NOT NULL, external TINYINT(1) NOT NULL, created DATETIME NOT NULL, createdBy VARCHAR(30) NOT NULL, updated DATETIME NOT NULL, updatedBy VARCHAR(30) NOT NULL, role VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_727508CFF47645AE (url), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE notices (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(64) NOT NULL, content LONGTEXT NOT NULL, publish DATE NOT NULL, expire DATE NOT NULL, created DATETIME NOT NULL, createdBy VARCHAR(255) NOT NULL, updated DATETIME NOT NULL, updatedBy VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DFE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE user_group DROP FOREIGN KEY FK_8F02BF9DFE54D947");
        $this->addSql("ALTER TABLE user_group DROP FOREIGN KEY FK_8F02BF9DA76ED395");
        $this->addSql("DROP TABLE ext_translations");
        $this->addSql("DROP TABLE ext_log_entries");
        $this->addSql("DROP TABLE groups");
        $this->addSql("DROP TABLE blogs");
        $this->addSql("DROP TABLE users");
        $this->addSql("DROP TABLE user_group");
        $this->addSql("DROP TABLE menus");
        $this->addSql("DROP TABLE notices");
    }
}
