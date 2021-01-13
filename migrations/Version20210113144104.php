<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113144104 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE resource (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, machine_type_id INT DEFAULT NULL, model_id INT DEFAULT NULL, optional_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_BC91F41612469DE2 (category_id), INDEX IDX_BC91F416C3331C23 (machine_type_id), INDEX IDX_BC91F4167975B7E7 (model_id), INDEX IDX_BC91F4163FAB2781 (optional_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F41612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F416C3331C23 FOREIGN KEY (machine_type_id) REFERENCES machine_type (id)');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F4167975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F4163FAB2781 FOREIGN KEY (optional_id) REFERENCES `option` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE resource');
    }
}
