<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210114200557 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model ADD machine_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D9C3331C23 FOREIGN KEY (machine_type_id) REFERENCES machine_type (id)');
        $this->addSql('CREATE INDEX IDX_D79572D9C3331C23 ON model (machine_type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D9C3331C23');
        $this->addSql('DROP INDEX IDX_D79572D9C3331C23 ON model');
        $this->addSql('ALTER TABLE model DROP machine_type_id');
    }
}
