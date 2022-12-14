<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214123601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers CHANGE tipo_identificacion tipo_identificacion VARCHAR(30) DEFAULT NULL, CHANGE address1 address1 VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE sales CHANGE address1 address1 LONGTEXT NOT NULL, CHANGE serie serie VARCHAR(10) NOT NULL, CHANGE secuencia secuencia VARCHAR(15) NOT NULL, CHANGE clave_acceso clave_acceso VARCHAR(60) NOT NULL, CHANGE ambiente ambiente VARCHAR(5) NOT NULL, CHANGE items items NUMERIC(8, 2) NOT NULL');
        $this->addSql('ALTER TABLE sales_details DROP FOREIGN KEY FK_7CDF77EA9F1AB70D');
        $this->addSql('ALTER TABLE sales_details ADD CONSTRAINT FK_7CDF77EA9F1AB70D FOREIGN KEY (venta_id_id) REFERENCES sales (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers CHANGE tipo_identificacion tipo_identificacion VARCHAR(25) DEFAULT NULL, CHANGE address1 address1 VARCHAR(128) DEFAULT NULL');
        $this->addSql('ALTER TABLE sales CHANGE address1 address1 LONGTEXT DEFAULT NULL, CHANGE serie serie VARCHAR(10) DEFAULT NULL, CHANGE secuencia secuencia VARCHAR(15) DEFAULT NULL, CHANGE clave_acceso clave_acceso VARCHAR(255) NOT NULL, CHANGE ambiente ambiente VARCHAR(25) NOT NULL, CHANGE items items NUMERIC(8, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE sales_details DROP FOREIGN KEY FK_7CDF77EA9F1AB70D');
        $this->addSql('ALTER TABLE sales_details ADD CONSTRAINT FK_7CDF77EA9F1AB70D FOREIGN KEY (venta_id_id) REFERENCES sales (id)');
    }
}
