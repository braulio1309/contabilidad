/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : contabilidad

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 06/03/2023 14:56:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for doctrine_migration_versions
-- ----------------------------
DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions`  (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime NULL DEFAULT NULL,
  `execution_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of doctrine_migration_versions
-- ----------------------------

-- ----------------------------
-- Table structure for messenger_messages
-- ----------------------------
DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `IDX_75EA56E0FB7336F0`(`queue_name` ASC) USING BTREE,
  INDEX `IDX_75EA56E0E3BD61CE`(`available_at` ASC) USING BTREE,
  INDEX `IDX_75EA56E016BA31DB`(`delivered_at` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of messenger_messages
-- ----------------------------

-- ----------------------------
-- Table structure for ps_customer
-- ----------------------------
DROP TABLE IF EXISTS `ps_customer`;
CREATE TABLE `ps_customer`  (
  `id_customer` int NOT NULL AUTO_INCREMENT,
  `id_shopgroup` int NOT NULL DEFAULT 1,
  `tipo_identificacion` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `numero_identificacion` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `address1` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `ciudad` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_customer`) USING BTREE,
  INDEX `id_shopgroup_numero_identificacion`(`id_shopgroup` ASC, `numero_identificacion` ASC) USING BTREE,
  INDEX `id_shopgroup_company`(`id_shopgroup` ASC, `company` ASC) USING BTREE,
  INDEX `id_shopgroup_email`(`id_shopgroup` ASC, `email` ASC) USING BTREE,
  CONSTRAINT `ps_customer_sp_shopgroup` FOREIGN KEY (`id_shopgroup`) REFERENCES `sp_shopgroup` (`id_shopgroup`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of ps_customer
-- ----------------------------
INSERT INTO `ps_customer` VALUES (1, 1, '03', '123', 'Braulio', 'Nuevo', 'brauliozapata@destiny.ws', '123', 'Guayana');
INSERT INTO `ps_customer` VALUES (2, 1, '06', 'Exercitationcu', 'Carla', 'Similique optio suscipit rem alias et sapiente hic ut animi omnis', 'gocyhesi@mailinator.com', '+1 709 978-5307', 'Nulla doloremque ut ');
INSERT INTO `ps_customer` VALUES (4, 1, '04', '12432', 'Yoha', 'xvcxv', 'brauasd@gmail.com', '123432', 'asdd');
INSERT INTO `ps_customer` VALUES (5, 1, '05', '1717740441', 'Carlos', 'Dolores ipsam minima mollit illum at consequuntur nemo quidem', 'zipowaf@mailinator.com', '+1 718 503-1533', 'Sed aut repudiandae ');
INSERT INTO `ps_customer` VALUES (6, 1, '06', 'Minusremmoles', 'Oladys', 'Vero eligendi perferendis enim eaque laboris amet expedita commodo aut libero eaque in et facere', 'lixifaq@mailinator.com', '+1 362 919', 'Error do accusamus s');
INSERT INTO `ps_customer` VALUES (7, 1, '06', 'Aliquamexceptu', 'Earum unde magni aut perspiciatis nulla', 'Adipisci dolorem quibusdam in aut quam eos ducimus adipisci eius itaque fugit sed error autem do quos repellendus', 'pedufis@mailinator.com', '+1 294 763-1926', 'Sed magna aperiam qu');
INSERT INTO `ps_customer` VALUES (8, 1, '06', '12313312', 'Magnam laboris accusamus consequatur Cumque ullam quia facere velit praesentium cupidatat Nam sunt similique optio', 'Reprehenderit autem aliquid minim duis laboris soluta harum', 'facyhapab@mail.com;yoas@mail.com', '+1 145 308-7703', 'Incididunt molestiae');
INSERT INTO `ps_customer` VALUES (9, 1, '06', 'qwerty', 'Minima molestiae Nam debitis duis id ratione doloremque voluptas natus distinctio', 'Hic distinctio Deserunt sit voluptas sint nihil doloremque', 'jypekasav@mailinator.com', '+1 146 338-4815', 'Ut ut sed voluptatem');
INSERT INTO `ps_customer` VALUES (10, 1, '06', 'Commodiminimqju', 'Id nisi ut laborum Incidunt', 'Sint eveniet est mollitia laborum Anim enim est voluptatem ut eos quas', 'pedufiss@mailinator.com', '+1 903 729-2441', 'Earum culpa qui con');

-- ----------------------------
-- Table structure for ps_employee
-- ----------------------------
DROP TABLE IF EXISTS `ps_employee`;
CREATE TABLE `ps_employee`  (
  `id_employee` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `passwd` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `roles` json NULL,
  PRIMARY KEY (`id_employee`) USING BTREE,
  INDEX `employee_login`(`email` ASC, `passwd` ASC) USING BTREE,
  INDEX `id_employee_passwd`(`id_employee` ASC, `passwd` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of ps_employee
-- ----------------------------
INSERT INTO `ps_employee` VALUES (2, 'Braulio', 'Zapata', 'brau@gmail.com', '$2y$13$noQbpo3BvZ73i1P5ooB2JukheutlLJ3gJjWf1rd8p6Xfk3pWI6EAa', 1, '[\"ROLE_SUPER_ADMIN\"]');
INSERT INTO `ps_employee` VALUES (3, 'Venus', 'Macias', 'motoju@mailinator.com', '$2y$13$oyt0nCNQBL3Rc7SXKHcnN.Cq/GUg7HKOQ155b3KyNX95zFWNMB5T6', 1, '[]');
INSERT INTO `ps_employee` VALUES (4, 'Carla', 'Vasquez', 'carla@mailinator.com', '$2y$13$cRodc7xXLWZ6/oMqUPnYeu4SoV8cT851o17/9udT9g23RRZlAwvwy', 1, '[]');
INSERT INTO `ps_employee` VALUES (5, 'Shea', 'Frank', 'nadaj@mailinator.com', '$2y$13$befVQop5sQLD.imk/V0weelFSTf7o9Sph/zy9eLIttew.j7JUgaFW', 1, '[]');
INSERT INTO `ps_employee` VALUES (6, 'Dante', 'Fry', 'kyve@mailinator.com', '$2y$13$FJx5baIrAbAY4j/eaxWg0OsGp.p4yrF0CQBDhB4juLRi8sS1nx1kS', 1, '[]');
INSERT INTO `ps_employee` VALUES (7, 'Kiayada', 'Larsen', 'ketedizic@mailinator.com', '$2y$13$f3WnoTelBBEkTgXheKPdlePnjLQUA0L9CctnemDDUK5RBGNDckdla', 1, '[]');

-- ----------------------------
-- Table structure for ps_product
-- ----------------------------
DROP TABLE IF EXISTS `ps_product`;
CREATE TABLE `ps_product`  (
  `id_product` int NOT NULL AUTO_INCREMENT,
  `id_shop` int NOT NULL DEFAULT 1,
  `codigo_producto` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_aditional1` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `description_aditional2` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `description_aditional3` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `tax_id` int NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `precio` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_product`) USING BTREE,
  INDEX `IDX_1ECD2847B2A824D8`(`tax_id` ASC) USING BTREE,
  INDEX `id_shop_codigo_producto`(`id_shop` ASC, `codigo_producto` ASC) USING BTREE,
  INDEX `id_shop_description`(`id_shop` ASC, `description` ASC) USING BTREE,
  CONSTRAINT `ps_product_ps_shop` FOREIGN KEY (`id_shop`) REFERENCES `ps_shop` (`id_shop`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of ps_product
-- ----------------------------
INSERT INTO `ps_product` VALUES (1, 1, '2', 'Test', '123', 'assa', 'sadas', 1, 'saasd', 20);
INSERT INTO `ps_product` VALUES (2, 1, 'Incididunt', 'Fuga Quisquam esse vel suscipit atque in sed culpa sed consequat Velit debitis porro', 'Ut sit consequatur explicabo Laborum rerum aute quia magni eiusmod perspiciatis nihil fugiat exercitationem', 'Quia est illo laborum dolorem laudantium explicabo Aperiam reprehenderit aut iste consequat Amet consectetur', 'Nobis voluptate quidem rem ad facilis in ducimus autem rem ullamco incididunt id fuga Et quaerat et', 1, 'Maris Guyy', 588);
INSERT INTO `ps_product` VALUES (3, 1, 'Estvelit', 'Incidunt atque facilis ad harum enim autem autem vero dolor minima voluptas magni qui commodi maiores anim', 'Quod placeat quis ea molestias consectetur facere deserunt voluptatum perferendis omnis aut deserunt', 'Sit ullam autem iusto aspernatur saepe dolore distinctio Consequatur tempore reprehenderit', 'Ea dolore velit quibusdam quisquam rerum repellendus Aspernatur ullamco cupidatat enim velit', 1, 'Elvis Saunders', 228);
INSERT INTO `ps_product` VALUES (4, 1, 'Nesciunt', 'Voluptatem Nisi deleniti ratione nesciunt vero', 'Est velit magnam nobis enim velit quia officia aliquip incidunt in', 'Aperiam soluta alias quos dolores sit iste magni alias aut minim et', 'Obcaecati ex officiis aliquip aut ut aspernatur maiores consequat Incidunt molestiae aut nesciunt qui tempor', 2, 'Jordan Hess', 125);
INSERT INTO `ps_product` VALUES (5, 1, 'Animexcep', 'Eaque laudantium sed aut ducimus beatae voluptatem voluptates nisi repellendus Exercitation sapiente dolor alias et dolore ad', 'Fugiat reiciendis id nulla nulla tenetur distinctio Fuga Magni dicta laudantium magni dolor aut nihil in', 'Necessitatibus assumenda non deserunt dolorem quo est mollitia et nostrud in aute odio laboriosam accusantium', 'Ex error qui eiusmod omnis eiusmod itaque sed voluptatem Et omnis dolor debitis qui fuga Asperiores', 1, 'Yuri Norman', 383);
INSERT INTO `ps_product` VALUES (6, 1, '12213134', 'Facere excepteur ab deserunt nihil voluptatem aliquid occaecat aut deleniti exercitationem debitis perferendis aperiam velit', 'Architecto quis minim possimus natus inventore sapiente ut laborum Odit ex ea qui ullam inventore sequi consequuntur', 'Sapiente sint tenetur dolore nostrud aliquip nemo quaerat culpa repellendus Quia corporis', 'Necessitatibus enim quo id nihil sit explicabo Nobis', 1, 'Salvador', 887);
INSERT INTO `ps_product` VALUES (7, 1, 'Autsuntn', 'Sit cupidatat ab et velit minus non voluptatem aut dolor aliqua', 'Non et aperiam nihil animi', 'Ad similique eos sunt ducimus numquam veniam ipsa culpa ut minus veniam ea tempore est dolor ea do', 'Accusamus irure ducimus aut consequatur quisquam dolores nulla maxime dolore corrupti', 2, 'Georgia Byers', 214);
INSERT INTO `ps_product` VALUES (8, 1, 'Autsuntns', 'Nostrum enim possimus quis est ipsam dolorem quia tenetur quaerat aut enim sit dolor', 'Expedita qui cupidatat qui sed id iure enim ea sunt blanditiis mollit', 'Suscipit duis provident et sed autem earum non enim qui dolor eligendi deserunt proident fugiat est qui irure sapiente', 'Voluptatem harum id veniam sit Nam duis sint veniam ipsa ut', 2, 'Timothy Vaughn', 867);

-- ----------------------------
-- Table structure for ps_shop
-- ----------------------------
DROP TABLE IF EXISTS `ps_shop`;
CREATE TABLE `ps_shop`  (
  `id_shop` int NOT NULL AUTO_INCREMENT,
  `id_shopgroup` int NOT NULL DEFAULT 1,
  `name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `numero_identificacion` varchar(13) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `direccion_matriz` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `regimen_rimpe` tinyint(1) NOT NULL,
  `agente_retencion` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `obligado_contabilidad` tinyint(1) NOT NULL,
  `contribuyente_especial` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_shop`) USING BTREE,
  INDEX `ps_shop_sp_shopgroup`(`id_shopgroup` ASC) USING BTREE,
  CONSTRAINT `ps_shop_sp_shopgroup` FOREIGN KEY (`id_shopgroup`) REFERENCES `sp_shopgroup` (`id_shopgroup`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of ps_shop
-- ----------------------------
INSERT INTO `ps_shop` VALUES (1, 1, 'Shop23', '123', 'as', 'tienda@s.com', 1, '123', 1, 'Si', 1);
INSERT INTO `ps_shop` VALUES (2, 1, 'Carson Farrell', 'Neque itaque ', 'Nesciunt est error', 'qanu@mailinator.com', 1, 'Laboriosam modi nos', 0, 'No', 1);
INSERT INTO `ps_shop` VALUES (3, 1, 'Hermione Moody', 'Sequi sequi q', 'Eos omnis ut mollit', 'xoriz@mailinator.com', 1, 'Beatae voluptates ea', 1, 'Si', 1);
INSERT INTO `ps_shop` VALUES (4, 1, 'Alexander Pickett', 'Et qui molest', 'Eos voluptate velit ', 'hegofovewo@mailinator.com', 1, 'Ratione totam quis t', 1, 'No', 1);
INSERT INTO `ps_shop` VALUES (5, 1, 'Shannon Roth', 'Facere earum ', 'Amet eu enim est re', 'sdewo@mailinator.com', 1, 'Sit officia eveniet', 0, 'Si', 1);
INSERT INTO `ps_shop` VALUES (6, 1, 'Chandler Rodgers', 'Voluptatem qu', 'Maiores reprehenderi', 'dovy@mailinator.com', 0, 'Consectetur obcaecat', 1, 'Nisi harum neque ten', 1);

-- ----------------------------
-- Table structure for sp_employee_shopgroup
-- ----------------------------
DROP TABLE IF EXISTS `sp_employee_shopgroup`;
CREATE TABLE `sp_employee_shopgroup`  (
  `id_employee` int NOT NULL,
  `id_shopgroup` int NOT NULL,
  PRIMARY KEY (`id_employee`, `id_shopgroup`) USING BTREE,
  INDEX `ps_employee_shopgroup_sp_shopgroup`(`id_shopgroup` ASC) USING BTREE,
  CONSTRAINT `ps_employee_shopgroup_ps_employee` FOREIGN KEY (`id_employee`) REFERENCES `ps_employee` (`id_employee`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `ps_employee_shopgroup_sp_shopgroup` FOREIGN KEY (`id_shopgroup`) REFERENCES `sp_shopgroup` (`id_shopgroup`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of sp_employee_shopgroup
-- ----------------------------

-- ----------------------------
-- Table structure for sp_shop_series
-- ----------------------------
DROP TABLE IF EXISTS `sp_shop_series`;
CREATE TABLE `sp_shop_series`  (
  `id_shop_series` int NOT NULL AUTO_INCREMENT,
  `id_shop` int NULL DEFAULT NULL,
  `codigo_documento` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `serie` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `secuencia` varchar(9) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `nombre_comercial` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `direccion_establecimiento` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_shop_series`) USING BTREE,
  INDEX `id_shop_codigo_documento_serie`(`id_shop` ASC, `codigo_documento` ASC, `serie` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of sp_shop_series
-- ----------------------------
INSERT INTO `sp_shop_series` VALUES (1, 1, '03', '12', '213', 'Test', 'Guayana', 1);
INSERT INTO `sp_shop_series` VALUES (2, 2, '05', 'Nesciu', 'Iusto vol', 'Charissa Conley', 'Est a suscipit nostr', 1);
INSERT INTO `sp_shop_series` VALUES (3, 2, '04', 'Volupt', 'Sed fuga', 'Dennis Saunder', 'Dolor sed irure poss', 1);
INSERT INTO `sp_shop_series` VALUES (4, 5, '04', 'Facere', 'Dolor pro', 'Dennis Saunderr', 'Quidem magni sit et', 1);

-- ----------------------------
-- Table structure for sp_shopgroup
-- ----------------------------
DROP TABLE IF EXISTS `sp_shopgroup`;
CREATE TABLE `sp_shopgroup`  (
  `id_shopgroup` int NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_shopgroup`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of sp_shopgroup
-- ----------------------------
INSERT INTO `sp_shopgroup` VALUES (1, 'Nuevo');
INSERT INTO `sp_shopgroup` VALUES (2, 'Amena Alvarado');
INSERT INTO `sp_shopgroup` VALUES (4, 'Nuevoo');

-- ----------------------------
-- Table structure for sp_taxes
-- ----------------------------
DROP TABLE IF EXISTS `sp_taxes`;
CREATE TABLE `sp_taxes`  (
  `id_tax` int NOT NULL AUTO_INCREMENT,
  `nombre_impuesto` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `porcentaje` decimal(10, 2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id_tax`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of sp_taxes
-- ----------------------------
INSERT INTO `sp_taxes` VALUES (1, 'IVA 0%', 0.00);
INSERT INTO `sp_taxes` VALUES (2, 'IVA 12%', 12.00);

-- ----------------------------
-- Table structure for sp_ventas
-- ----------------------------
DROP TABLE IF EXISTS `sp_ventas`;
CREATE TABLE `sp_ventas`  (
  `id_venta` int NOT NULL AUTO_INCREMENT,
  `id_shop` int NOT NULL,
  `id_customer` int NOT NULL,
  `tipo_identificacion` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `numero_identificacion` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `address1` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fecha_emision` datetime NOT NULL,
  `codigo_documento` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `serie` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `secuencia` varchar(9) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `autorizacion_sri` varchar(49) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `clave_acceso` varchar(49) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ambiente` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tipo_emision` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '1',
  `fecha_autorizacion` datetime NULL DEFAULT NULL,
  `xml` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `xml_estado` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `mensaje_autorizacion` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `items` decimal(3, 0) NULL DEFAULT 0,
  `subtotal` decimal(20, 6) NOT NULL DEFAULT 0.000000,
  `descuento` decimal(20, 6) NULL DEFAULT 0.000000,
  `id_tax` int NULL DEFAULT NULL,
  `total` decimal(20, 6) NOT NULL DEFAULT 0.000000,
  `forma_pago` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `informacion_adicional` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `date_add` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `date_upd` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `anulado` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_venta`) USING BTREE,
  INDEX `id_shop`(`id_shop` ASC, `codigo_documento` ASC, `serie` ASC, `secuencia` ASC) USING BTREE,
  INDEX `id_shop_id_customer`(`id_shop` ASC, `id_customer` ASC) USING BTREE,
  INDEX `id_shop_date_add`(`id_shop` ASC, `date_add` ASC) USING BTREE,
  INDEX `sp_ventas_ps_customer`(`id_customer` ASC) USING BTREE,
  INDEX `sp_ventas_sp_taxes`(`id_tax` ASC) USING BTREE,
  CONSTRAINT `sp_ventas_ps_customer` FOREIGN KEY (`id_customer`) REFERENCES `ps_customer` (`id_customer`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of sp_ventas
-- ----------------------------
INSERT INTO `sp_ventas` VALUES (2, 1, 1, '03', '123', NULL, 'brauliozapata@destiny.ws', '2023-02-20 13:35:43', '03', NULL, NULL, NULL, '697hwz0yq3xdn5aeocjpbk8ilfmt4gsuv21r', 'P', '', NULL, NULL, 'A', NULL, 1, 60.000000, NULL, 2, 60.000000, NULL, NULL, '2023-02-20 13:35:43', '2023-02-20 13:35:43', NULL);
INSERT INTO `sp_ventas` VALUES (3, 1, 1, '03', '123', NULL, 'brauliozapata@destiny.ws', '2023-02-20 13:40:58', '03', NULL, NULL, NULL, 'c07tkgjanyx5msf8l46wpdb', 'P', '', NULL, NULL, 'A', NULL, 1, 60.000000, 0.000000, 7, 67.200000, NULL, NULL, '2023-02-20 13:40:58', '2023-02-20 13:40:58', NULL);
INSERT INTO `sp_ventas` VALUES (4, 1, 1, '03', '123', NULL, 'brauliozapata@destiny.ws', '2023-02-20 13:41:40', '03', NULL, NULL, NULL, '1kca59ogvyjeqtfmp2rs8uzwibn67h43l0xd', 'P', '', NULL, NULL, 'A', NULL, 1, 60.000000, 0.000000, 7, 67.200000, NULL, NULL, '2023-02-20 13:41:40', '2023-02-20 13:41:40', NULL);
INSERT INTO `sp_ventas` VALUES (5, 1, 1, '03', '123', NULL, 'brauliozapata@destiny.ws', '2023-02-20 13:42:24', '03', NULL, NULL, NULL, '6ubp98sjqli723mhvnz40w1gcatyeokfdrx5', 'P', '', NULL, NULL, 'A', NULL, 1, 20.000000, 0.000000, 2, 22.400000, NULL, NULL, '2023-02-20 13:42:24', '2023-02-20 13:42:24', NULL);
INSERT INTO `sp_ventas` VALUES (6, 1, 1, '03', '123', NULL, 'brauliozapata@destiny.ws', '2023-02-20 13:44:06', '03', NULL, NULL, NULL, 'f3alocs5j8ubp42n6hti9xr0vwzd1mg7ykeq', 'P', '', NULL, NULL, 'A', NULL, 1, 20.000000, 0.000000, 2, 22.400000, NULL, NULL, '2023-02-20 13:44:06', '2023-02-20 13:44:06', NULL);
INSERT INTO `sp_ventas` VALUES (7, 1, 1, '03', '123', NULL, 'brauliozapata@destiny.ws', '2023-02-20 13:44:26', '03', NULL, NULL, NULL, 'pgel27', 'P', '', NULL, NULL, 'A', NULL, 1, 60.000000, 0.000000, 7, 67.200000, NULL, NULL, '2023-02-20 13:44:26', '2023-02-20 13:44:26', NULL);
INSERT INTO `sp_ventas` VALUES (8, 1, 1, '03', '123', NULL, 'brauliozapata@destiny.ws', '2023-02-20 13:47:22', '03', NULL, NULL, NULL, 'g1jy59x3eamwc7d0ptioluhvsq', 'P', '', NULL, NULL, 'A', NULL, 1, 40.000000, 0.000000, 5, 44.800000, NULL, NULL, '2023-02-20 13:47:22', '2023-02-20 13:47:22', NULL);
INSERT INTO `sp_ventas` VALUES (9, 1, 1, '03', '123', NULL, 'brauliozapata@destiny.ws', '2023-02-20 13:48:49', '03', NULL, NULL, NULL, 'vt4cxrh0lf1uag6piobjmy5e8qkz9ns72wd3', 'P', '', NULL, NULL, 'A', NULL, 1, 20.000000, 0.000000, 2, 22.400000, NULL, NULL, '2023-02-20 13:48:49', '2023-02-20 13:48:49', NULL);
INSERT INTO `sp_ventas` VALUES (28, 2, 5, '05', '1717740441', NULL, 'zipowaf@mailinator.com', '2023-03-02 21:50:10', '05', NULL, NULL, NULL, 'e0n8xt43fl71diojbh2y6uvkqmacpgr5s9zw', 'P', '', '2023-03-02 21:50:10', NULL, NULL, NULL, NULL, 456.000000, 12.000000, 0, 401.280000, NULL, NULL, '2023-03-02 21:50:10', '2023-03-02 21:50:10', NULL);

-- ----------------------------
-- Table structure for sp_ventas_detail
-- ----------------------------
DROP TABLE IF EXISTS `sp_ventas_detail`;
CREATE TABLE `sp_ventas_detail`  (
  `id_venta_detail` int NOT NULL AUTO_INCREMENT,
  `id_venta` int NOT NULL,
  `id_product` int NOT NULL,
  `codigo_producto` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `description_aditional1` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `description_aditional2` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `description_aditional3` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `product_quantity` decimal(20, 6) NOT NULL DEFAULT 0.000000,
  `product_price` decimal(20, 6) NOT NULL DEFAULT 0.000000,
  `product_subtotal` decimal(20, 6) NOT NULL DEFAULT 0.000000,
  `product_descuento` decimal(20, 6) NOT NULL DEFAULT 0.000000,
  `product_total` decimal(20, 6) NOT NULL DEFAULT 0.000000,
  `id_tax` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_venta_detail`) USING BTREE,
  INDEX `venta_detail_order`(`id_venta` ASC) USING BTREE,
  INDEX `sp_ventas_detail_sp_taxes`(`id_tax` ASC) USING BTREE,
  INDEX `sp_ventas_detail_ps_product`(`id_product` ASC) USING BTREE,
  CONSTRAINT `sp_ventas_detail_ps_product` FOREIGN KEY (`id_product`) REFERENCES `ps_product` (`id_product`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `sp_ventas_detail_sp_ventas` FOREIGN KEY (`id_venta`) REFERENCES `sp_ventas` (`id_venta`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of sp_ventas_detail
-- ----------------------------
INSERT INTO `sp_ventas_detail` VALUES (1, 1, 1, '123', NULL, NULL, NULL, NULL, 1.000000, 20.000000, 5.000000, 20.000000, 1.000000, 20);
INSERT INTO `sp_ventas_detail` VALUES (2, 1, 1, '123', NULL, NULL, NULL, NULL, 1.000000, 20.000000, 5.000000, 20.000000, 1.000000, NULL);
INSERT INTO `sp_ventas_detail` VALUES (3, 1, 1, '123', NULL, NULL, NULL, NULL, 2.400000, 20.000000, 5.000000, 40.000000, 1.000000, NULL);
INSERT INTO `sp_ventas_detail` VALUES (4, 1, 1, '123', NULL, NULL, NULL, NULL, 1.000000, 20.000000, 5.000000, 20.000000, 1.000000, 2);
INSERT INTO `sp_ventas_detail` VALUES (5, 1, 1, '123', NULL, NULL, NULL, NULL, 2.000000, 20.000000, 5.000000, 40.000000, 1.000000, 4);
INSERT INTO `sp_ventas_detail` VALUES (6, 1, 1, '123', NULL, NULL, NULL, NULL, 1.000000, 20.000000, 5.000000, 20.000000, 1.000000, 2);
INSERT INTO `sp_ventas_detail` VALUES (7, 1, 1, '123', NULL, NULL, NULL, NULL, 2.000000, 20.000000, 5.000000, 40.000000, 1.000000, 4);
INSERT INTO `sp_ventas_detail` VALUES (8, 1, 1, '123', NULL, NULL, NULL, NULL, 1.000000, 20.000000, 5.000000, 20.000000, 1.000000, 2);
INSERT INTO `sp_ventas_detail` VALUES (9, 1, 1, '123', NULL, NULL, NULL, NULL, 1.000000, 20.000000, 5.000000, 20.000000, 1.000000, 2);
INSERT INTO `sp_ventas_detail` VALUES (10, 1, 1, '123', NULL, NULL, NULL, NULL, 2.000000, 20.000000, 5.000000, 40.000000, 1.000000, 4);
INSERT INTO `sp_ventas_detail` VALUES (11, 1, 1, '123', NULL, NULL, NULL, NULL, 1.000000, 20.000000, 5.000000, 20.000000, 1.000000, 2);
INSERT INTO `sp_ventas_detail` VALUES (12, 1, 1, '123', NULL, NULL, NULL, NULL, 2.000000, 20.000000, 5.000000, 40.000000, 1.000000, 4);
INSERT INTO `sp_ventas_detail` VALUES (13, 1, 1, '123', NULL, NULL, NULL, NULL, 1.000000, 20.000000, 5.000000, 20.000000, 1.000000, 2);
INSERT INTO `sp_ventas_detail` VALUES (15, 28, 3, 'Estvelit', 'Tempora voluptas vol', 'Harum voluptas enim ', 'Eius repudiandae acc', 'Vitae esse corporis', 2.000000, 228.000000, 456.000000, 0.000000, 456.000000, 0);

-- ----------------------------
-- Table structure for sp_ventas_detail_tax
-- ----------------------------
DROP TABLE IF EXISTS `sp_ventas_detail_tax`;
CREATE TABLE `sp_ventas_detail_tax`  (
  `id_venta_detail_tax` int UNSIGNED NOT NULL,
  `id_venta_detail` int NOT NULL,
  `id_tax` int UNSIGNED NOT NULL,
  `porcentaje` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `base_imponible` decimal(20, 6) NOT NULL DEFAULT 0.000000,
  `valor_impuesto` decimal(20, 6) NOT NULL DEFAULT 0.000000,
  PRIMARY KEY (`id_venta_detail_tax`) USING BTREE,
  INDEX `sp_ventas_detail_tax_sp_ventas_detail`(`id_venta_detail` ASC) USING BTREE,
  CONSTRAINT `sp_ventas_detail_tax_sp_ventas_detail` FOREIGN KEY (`id_venta_detail`) REFERENCES `sp_ventas_detail` (`id_venta_detail`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sp_ventas_detail_tax
-- ----------------------------

-- ----------------------------
-- Table structure for sp_ventas_tax
-- ----------------------------
DROP TABLE IF EXISTS `sp_ventas_tax`;
CREATE TABLE `sp_ventas_tax`  (
  `id_venta_tax` int NOT NULL AUTO_INCREMENT,
  `id_venta` int NULL DEFAULT NULL,
  `id_tax` int NOT NULL,
  `porcentaje` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `base_imponible` decimal(20, 6) NOT NULL DEFAULT 0.000000,
  `valor_impuesto` decimal(20, 6) NOT NULL DEFAULT 0.000000,
  PRIMARY KEY (`id_venta_tax`) USING BTREE,
  INDEX `sp_ventas_tax_sp_ventas`(`id_venta` ASC) USING BTREE,
  CONSTRAINT `sp_ventas_tax_sp_ventas` FOREIGN KEY (`id_venta`) REFERENCES `sp_ventas` (`id_venta`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of sp_ventas_tax
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
