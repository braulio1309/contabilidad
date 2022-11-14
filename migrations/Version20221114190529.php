<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221114190529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customers (id INT AUTO_INCREMENT NOT NULL, tipo_identificacion VARCHAR(2) DEFAULT NULL, numero_identificacion VARCHAR(15) NOT NULL, company VARCHAR(255) NOT NULL, address1 VARCHAR(128) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(32) DEFAULT NULL, city VARCHAR(60) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_shopgroup_shop (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_shopgroup_shop_employee (employee_shopgroup_shop_id INT NOT NULL, employee_id INT NOT NULL, INDEX IDX_F31D398D8A4FCBCB (employee_shopgroup_shop_id), INDEX IDX_F31D398D8C03F15C (employee_id), PRIMARY KEY(employee_shopgroup_shop_id, employee_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_shopgroup_shop_shop_group (employee_shopgroup_shop_id INT NOT NULL, shop_group_id INT NOT NULL, INDEX IDX_EC8DD6008A4FCBCB (employee_shopgroup_shop_id), INDEX IDX_EC8DD60025EC23D1 (shop_group_id), PRIMARY KEY(employee_shopgroup_shop_id, shop_group_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_shopgroup_shop_shop (employee_shopgroup_shop_id INT NOT NULL, shop_id INT NOT NULL, INDEX IDX_E1BFC5C68A4FCBCB (employee_shopgroup_shop_id), INDEX IDX_E1BFC5C64D16C4DD (shop_id), PRIMARY KEY(employee_shopgroup_shop_id, shop_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employees (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, description_aditional1 VARCHAR(255) DEFAULT NULL, description_aditional2 VARCHAR(255) DEFAULT NULL, description_aditional3 VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales (id INT AUTO_INCREMENT NOT NULL, shop_id_id INT NOT NULL, customer_id_id INT DEFAULT NULL, tipo_identificacion VARCHAR(5) DEFAULT NULL, numero_identificacion VARCHAR(20) NOT NULL, address1 LONGTEXT NOT NULL, email VARCHAR(255) NOT NULL, fecha_emision DATETIME NOT NULL, tipo_documento VARCHAR(5) NOT NULL, serie VARCHAR(10) NOT NULL, secuencia VARCHAR(15) NOT NULL, autorizacion_sri VARCHAR(60) DEFAULT NULL, clave_acceso VARCHAR(60) NOT NULL, ambiente VARCHAR(5) NOT NULL, tipo_emision VARCHAR(5) NOT NULL, fecha_autorizacion DATETIME DEFAULT NULL, xml LONGTEXT DEFAULT NULL, xml_estado VARCHAR(5) DEFAULT NULL, mensaje_autorizacion LONGTEXT DEFAULT NULL, items NUMERIC(8, 2) NOT NULL, subtotal NUMERIC(8, 2) NOT NULL, descuento NUMERIC(8, 2) DEFAULT NULL, id_tax INT DEFAULT NULL, total NUMERIC(8, 2) NOT NULL, forma_pago VARCHAR(255) DEFAULT NULL, informacion_adicional VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', anulado TINYINT(1) DEFAULT NULL, INDEX IDX_6B817044B852C405 (shop_id_id), INDEX IDX_6B817044B171EB6C (customer_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales_details (id INT AUTO_INCREMENT NOT NULL, product_id_id INT NOT NULL, venta_id_id INT DEFAULT NULL, codigo_producto VARCHAR(25) NOT NULL, description VARCHAR(255) DEFAULT NULL, description_aditional1 VARCHAR(255) DEFAULT NULL, description_aditional2 VARCHAR(255) DEFAULT NULL, description_aditional3 VARCHAR(255) DEFAULT NULL, product_quantity NUMERIC(8, 2) DEFAULT NULL, product_prie NUMERIC(8, 2) NOT NULL, product_subtotal NUMERIC(8, 2) DEFAULT NULL, product_total NUMERIC(8, 2) DEFAULT NULL, tax_id INT DEFAULT NULL, INDEX IDX_7CDF77EADE18E50B (product_id_id), INDEX IDX_7CDF77EA9F1AB70D (venta_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales_taxes (id INT AUTO_INCREMENT NOT NULL, venta_id_id INT DEFAULT NULL, tax_id INT NOT NULL, porcentaje NUMERIC(8, 2) NOT NULL, base_imponible NUMERIC(8, 2) NOT NULL, valor_impuesto NUMERIC(8, 2) NOT NULL, INDEX IDX_34CA164E9F1AB70D (venta_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shopgroups (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shops (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, numero_identificacion VARCHAR(13) NOT NULL, direccion_matriz VARCHAR(200) NOT NULL, email VARCHAR(255) NOT NULL, regimen_rimpe TINYINT(1) NOT NULL, agente_retencion VARCHAR(20) NOT NULL, obligado_contabilidad TINYINT(1) NOT NULL, contribuyente_especial VARCHAR(20) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taxes (id INT AUTO_INCREMENT NOT NULL, nombre_impuesto VARCHAR(30) NOT NULL, porcentaje NUMERIC(8, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_employee ADD CONSTRAINT FK_F31D398D8A4FCBCB FOREIGN KEY (employee_shopgroup_shop_id) REFERENCES employee_shopgroup_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_employee ADD CONSTRAINT FK_F31D398D8C03F15C FOREIGN KEY (employee_id) REFERENCES employees (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop_group ADD CONSTRAINT FK_EC8DD6008A4FCBCB FOREIGN KEY (employee_shopgroup_shop_id) REFERENCES employee_shopgroup_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop_group ADD CONSTRAINT FK_EC8DD60025EC23D1 FOREIGN KEY (shop_group_id) REFERENCES shopgroups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop ADD CONSTRAINT FK_E1BFC5C68A4FCBCB FOREIGN KEY (employee_shopgroup_shop_id) REFERENCES employee_shopgroup_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop ADD CONSTRAINT FK_E1BFC5C64D16C4DD FOREIGN KEY (shop_id) REFERENCES shops (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sales ADD CONSTRAINT FK_6B817044B852C405 FOREIGN KEY (shop_id_id) REFERENCES shops (id)');
        $this->addSql('ALTER TABLE sales ADD CONSTRAINT FK_6B817044B171EB6C FOREIGN KEY (customer_id_id) REFERENCES customers (id)');
        $this->addSql('ALTER TABLE sales_details ADD CONSTRAINT FK_7CDF77EADE18E50B FOREIGN KEY (product_id_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE sales_details ADD CONSTRAINT FK_7CDF77EA9F1AB70D FOREIGN KEY (venta_id_id) REFERENCES sales (id)');
        $this->addSql('ALTER TABLE sales_taxes ADD CONSTRAINT FK_34CA164E9F1AB70D FOREIGN KEY (venta_id_id) REFERENCES sales (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee_shopgroup_shop_employee DROP FOREIGN KEY FK_F31D398D8A4FCBCB');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_employee DROP FOREIGN KEY FK_F31D398D8C03F15C');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop_group DROP FOREIGN KEY FK_EC8DD6008A4FCBCB');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop_group DROP FOREIGN KEY FK_EC8DD60025EC23D1');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop DROP FOREIGN KEY FK_E1BFC5C68A4FCBCB');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop DROP FOREIGN KEY FK_E1BFC5C64D16C4DD');
        $this->addSql('ALTER TABLE sales DROP FOREIGN KEY FK_6B817044B852C405');
        $this->addSql('ALTER TABLE sales DROP FOREIGN KEY FK_6B817044B171EB6C');
        $this->addSql('ALTER TABLE sales_details DROP FOREIGN KEY FK_7CDF77EADE18E50B');
        $this->addSql('ALTER TABLE sales_details DROP FOREIGN KEY FK_7CDF77EA9F1AB70D');
        $this->addSql('ALTER TABLE sales_taxes DROP FOREIGN KEY FK_34CA164E9F1AB70D');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE employee_shopgroup_shop');
        $this->addSql('DROP TABLE employee_shopgroup_shop_employee');
        $this->addSql('DROP TABLE employee_shopgroup_shop_shop_group');
        $this->addSql('DROP TABLE employee_shopgroup_shop_shop');
        $this->addSql('DROP TABLE employees');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE sales');
        $this->addSql('DROP TABLE sales_details');
        $this->addSql('DROP TABLE sales_taxes');
        $this->addSql('DROP TABLE shopgroups');
        $this->addSql('DROP TABLE shops');
        $this->addSql('DROP TABLE taxes');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
