<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113145006 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE machine_type (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_DAD4BC5012469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, machine_id INT NOT NULL, name_brand VARCHAR(255) NOT NULL, name_model VARCHAR(255) NOT NULL, INDEX IDX_D79572D9F6B75B26 (machine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, model_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5A8600B07975B7E7 (model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE machine_type ADD CONSTRAINT FK_DAD4BC5012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D9F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine_type (id)');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B07975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE machine_type DROP FOREIGN KEY FK_DAD4BC5012469DE2');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D9F6B75B26');
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B07975B7E7');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE machine_type');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE user');
    }
}
