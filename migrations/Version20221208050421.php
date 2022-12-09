<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221208050421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers CHANGE tipo_identificacion tipo_identificacion VARCHAR(30) DEFAULT NULL, CHANGE address1 address1 VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE employees ADD roles JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE sales_details CHANGE product_prie product_price NUMERIC(8, 2) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers CHANGE tipo_identificacion tipo_identificacion VARCHAR(25) DEFAULT NULL, CHANGE address1 address1 VARCHAR(128) DEFAULT NULL');
        $this->addSql('ALTER TABLE employees DROP roles');
        $this->addSql('ALTER TABLE sales_details CHANGE product_price product_prie NUMERIC(8, 2) NOT NULL');
    }
}
