<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210114162317 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand_machine_type (brand_id INT NOT NULL, machine_type_id INT NOT NULL, INDEX IDX_1762EBE344F5D008 (brand_id), INDEX IDX_1762EBE3C3331C23 (machine_type_id), PRIMARY KEY(brand_id, machine_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE brand_machine_type ADD CONSTRAINT FK_1762EBE344F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE brand_machine_type ADD CONSTRAINT FK_1762EBE3C3331C23 FOREIGN KEY (machine_type_id) REFERENCES machine_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE machine_type DROP FOREIGN KEY FK_DAD4BC5044F5D008');
        $this->addSql('DROP INDEX IDX_DAD4BC5044F5D008 ON machine_type');
        $this->addSql('ALTER TABLE machine_type DROP brand_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE brand_machine_type');
        $this->addSql('ALTER TABLE machine_type ADD brand_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE machine_type ADD CONSTRAINT FK_DAD4BC5044F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DAD4BC5044F5D008 ON machine_type (brand_id)');
    }
}
