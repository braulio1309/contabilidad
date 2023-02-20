<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230125020233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sp_shop_series (id_shop_series INT AUTO_INCREMENT NOT NULL, shop_id_id INT DEFAULT NULL, tipo_documento VARCHAR(2) NOT NULL, serie VARCHAR(11) NOT NULL, secuencia VARCHAR(255) NOT NULL, nombre_comercial VARCHAR(200) NOT NULL, direccion_establecimiento VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_679BC0E3B852C405 (shop_id_id), PRIMARY KEY(id_shop_series)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sp_shop_series ADD CONSTRAINT FK_679BC0E3B852C405 FOREIGN KEY (shop_id_id) REFERENCES ps_shop (id)');
        $this->addSql('DROP TABLE shop_serie');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_employee ADD CONSTRAINT FK_F31D398D8C03F15C FOREIGN KEY (employee_id) REFERENCES ps_employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop_group ADD CONSTRAINT FK_EC8DD6008A4FCBCB FOREIGN KEY (employee_shopgroup_shop_id) REFERENCES employee_shopgroup_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop_group ADD CONSTRAINT FK_EC8DD60025EC23D1 FOREIGN KEY (shop_group_id) REFERENCES sp_shopgroup (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop ADD CONSTRAINT FK_E1BFC5C68A4FCBCB FOREIGN KEY (employee_shopgroup_shop_id) REFERENCES employee_shopgroup_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop ADD CONSTRAINT FK_E1BFC5C64D16C4DD FOREIGN KEY (shop_id) REFERENCES ps_shop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ps_product ADD CONSTRAINT FK_1ECD2847B2A824D8 FOREIGN KEY (tax_id) REFERENCES taxes (id)');
        $this->addSql('ALTER TABLE sales ADD CONSTRAINT FK_6B817044B852C405 FOREIGN KEY (shop_id_id) REFERENCES ps_shop (id)');
        $this->addSql('ALTER TABLE sales ADD CONSTRAINT FK_6B817044B171EB6C FOREIGN KEY (customer_id_id) REFERENCES ps_customer (id)');
        $this->addSql('ALTER TABLE sales_details ADD CONSTRAINT FK_7CDF77EADE18E50B FOREIGN KEY (product_id_id) REFERENCES ps_product (id)');
        $this->addSql('ALTER TABLE sales_details ADD CONSTRAINT FK_7CDF77EA9F1AB70D FOREIGN KEY (venta_id_id) REFERENCES sales (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sales_taxes ADD CONSTRAINT FK_34CA164E9F1AB70D FOREIGN KEY (venta_id_id) REFERENCES sales (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shop_serie (id_shop_series INT AUTO_INCREMENT NOT NULL, shop_id_id INT DEFAULT NULL, tipo_documento VARCHAR(2) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, serie VARCHAR(11) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, secuencia VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, nombre_comercial VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, direccion_establecimiento VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, active TINYINT(1) NOT NULL, INDEX IDX_6D2CC966B852C405 (shop_id_id), PRIMARY KEY(id_shop_series)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sp_shop_series DROP FOREIGN KEY FK_679BC0E3B852C405');
        $this->addSql('DROP TABLE sp_shop_series');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_employee DROP FOREIGN KEY FK_F31D398D8C03F15C');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop DROP FOREIGN KEY FK_E1BFC5C68A4FCBCB');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop DROP FOREIGN KEY FK_E1BFC5C64D16C4DD');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop_group DROP FOREIGN KEY FK_EC8DD6008A4FCBCB');
        $this->addSql('ALTER TABLE employee_shopgroup_shop_shop_group DROP FOREIGN KEY FK_EC8DD60025EC23D1');
        $this->addSql('ALTER TABLE ps_product DROP FOREIGN KEY FK_1ECD2847B2A824D8');
        $this->addSql('ALTER TABLE sales DROP FOREIGN KEY FK_6B817044B852C405');
        $this->addSql('ALTER TABLE sales DROP FOREIGN KEY FK_6B817044B171EB6C');
        $this->addSql('ALTER TABLE sales_details DROP FOREIGN KEY FK_7CDF77EADE18E50B');
        $this->addSql('ALTER TABLE sales_details DROP FOREIGN KEY FK_7CDF77EA9F1AB70D');
        $this->addSql('ALTER TABLE sales_taxes DROP FOREIGN KEY FK_34CA164E9F1AB70D');
    }
}
