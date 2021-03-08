<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210308151737 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE challenge (id INT AUTO_INCREMENT NOT NULL, creator_id INT NOT NULL, catcher_id INT DEFAULT NULL, defi_id INT NOT NULL, is_success TINYINT(1) NOT NULL, url VARCHAR(255) DEFAULT NULL, is_valid TINYINT(1) DEFAULT NULL, INDEX IDX_D709895161220EA6 (creator_id), INDEX IDX_D7098951ED458ACF (catcher_id), INDEX IDX_D709895173F00F27 (defi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE defi (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, point INT NOT NULL, format VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, score INT NOT NULL, rate INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D709895161220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D7098951ED458ACF FOREIGN KEY (catcher_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D709895173F00F27 FOREIGN KEY (defi_id) REFERENCES defi (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE challenge DROP FOREIGN KEY FK_D709895173F00F27');
        $this->addSql('ALTER TABLE challenge DROP FOREIGN KEY FK_D709895161220EA6');
        $this->addSql('ALTER TABLE challenge DROP FOREIGN KEY FK_D7098951ED458ACF');
        $this->addSql('DROP TABLE challenge');
        $this->addSql('DROP TABLE defi');
        $this->addSql('DROP TABLE user');
    }
}
