<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221115180148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shop_serie (id INT AUTO_INCREMENT NOT NULL, shop_id_id INT DEFAULT NULL, tipo_documento VARCHAR(2) NOT NULL, serie VARCHAR(11) NOT NULL, secuencia VARCHAR(255) NOT NULL, nombre_comercial VARCHAR(200) NOT NULL, direccion_establecimiento VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_6D2CC966B852C405 (shop_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shop_serie ADD CONSTRAINT FK_6D2CC966B852C405 FOREIGN KEY (shop_id_id) REFERENCES shops (id)');
        $this->addSql('ALTER TABLE products ADD name VARCHAR(255) NOT NULL, ADD code VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shop_serie DROP FOREIGN KEY FK_6D2CC966B852C405');
        $this->addSql('DROP TABLE shop_serie');
        $this->addSql('ALTER TABLE products DROP name, DROP code');
    }
}
