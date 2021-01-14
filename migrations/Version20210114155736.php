<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210114155736 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE machine_type ADD brand_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE machine_type ADD CONSTRAINT FK_DAD4BC5044F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_DAD4BC5044F5D008 ON machine_type (brand_id)');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D9F6B75B26');
        $this->addSql('DROP INDEX IDX_D79572D9F6B75B26 ON model');
        $this->addSql('ALTER TABLE model ADD brand_id INT DEFAULT NULL, ADD model VARCHAR(255) NOT NULL, DROP machine_id, DROP name_brand, DROP name_model');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_D79572D944F5D008 ON model (brand_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE machine_type DROP FOREIGN KEY FK_DAD4BC5044F5D008');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP INDEX IDX_DAD4BC5044F5D008 ON machine_type');
        $this->addSql('ALTER TABLE machine_type DROP brand_id');
        $this->addSql('DROP INDEX IDX_D79572D944F5D008 ON model');
        $this->addSql('ALTER TABLE model ADD machine_id INT NOT NULL, ADD name_model VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP brand_id, CHANGE model name_brand VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D9F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D79572D9F6B75B26 ON model (machine_id)');
    }
}
