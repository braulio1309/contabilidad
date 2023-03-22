drop database bum;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Estructura de tabla para la tabla `ps_employee`
CREATE TABLE `ps_employee` (
  `id_employee` int(11) UNSIGNED NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
ALTER TABLE `ps_employee`
  ADD PRIMARY KEY (`id_employee`),
  ADD KEY `employee_login` (`email`,`passwd`),
  ADD KEY `id_employee_passwd` (`id_employee`,`passwd`);
ALTER TABLE `ps_employee`
  MODIFY `id_employee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Estructura de tabla para la tabla `sp_shopgroup`
CREATE TABLE `sp_shopgroup` (
  `id_shopgroup` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
ALTER TABLE `sp_shopgroup`
  ADD PRIMARY KEY (`id_shopgroup`);
ALTER TABLE `sp_shopgroup`
  MODIFY `id_shopgroup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

-- Estructura de tabla para la tabla `ps_shop`
CREATE TABLE `ps_shop` (
  `id_shop` int(11) NOT NULL,
  `id_shopgroup` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `numero_identificacion` varchar(13) NOT NULL,
  `direccion_matriz` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `regimen_rimpe` tinyint(1) NOT NULL,
  `agente_retencion` varchar(20) NOT NULL,
  `obligado_contabilidad` tinyint(1) NOT NULL,
  `contribuyente_especial` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
ALTER TABLE `ps_shop`
  ADD PRIMARY KEY (`id_shop`);
ALTER TABLE `ps_shop`
  MODIFY `id_shop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Estructura de tabla para la tabla `sp_employee_shopgroup`
CREATE TABLE `sp_employee_shopgroup` (
  `id_employee` int(11) NOT NULL,
  `id_shopgroup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
ALTER TABLE `sp_employee_shopgroup`
  ADD PRIMARY KEY (`id_employee`,`id_shopgroup`);

-- Estructura de tabla para la tabla `ps_customer`
CREATE TABLE `ps_customer` (
  `id_customer` int(11) UNSIGNED NOT NULL,
  `id_shopgroup` int(11) NOT NULL,
  `tipo_identificacion` varchar(2) DEFAULT NULL,
  `numero_identificacion`	varchar (15) NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `address1` varchar(128) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(255) NULL,
  `phone` varchar(32) DEFAULT NULL,
  `ciudad` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
ALTER TABLE `ps_customer`
  ADD PRIMARY KEY (`id_customer`),
  ADD KEY `id_shopgroup_numero_identificacion` (`id_shopgroup`,`numero_identificacion`),
  ADD KEY `id_shopgroup_company` (`id_shopgroup`,`company`),
  ADD KEY `id_shopgroup_email` (`id_shopgroup`,`email`);
ALTER TABLE `ps_customer`
  MODIFY `id_customer` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Estructura de tabla para la tabla `ps_product`
CREATE TABLE `ps_product` (
  `id_product` int(11) UNSIGNED NOT NULL,
  `id_shop` int(11) NOT NULL,
  `codigo_producto` varchar(10) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `description_aditional1` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `description_aditional2` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `description_aditional3` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio` decimal(20,6) NOT NULL DEFAULT 0.000000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

ALTER TABLE `ps_product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_shop_codigo_producto` (`id_shop`,`codigo_producto`),
  ADD KEY `id_shop_description` (`id_shop`,`description`);

ALTER TABLE `ps_product`
  MODIFY `id_product` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Estructura de tabla para la tabla `sp_shop_series`
CREATE TABLE `sp_shop_series` (
  `id_shop_series` int(11) NOT NULL,
  `id_shop` int(11) NOT NULL,
  `codigo_documento` varchar(2) NOT NULL,
  `serie` varchar(6) NOT NULL,
  `secuencia` varchar(9) NOT NULL,
  `nombre_comercial` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion_establecimiento` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
ALTER TABLE `sp_shop_series`
  ADD PRIMARY KEY (`id_shop_series`),
  ADD KEY `id_shop_codigo_documento_serie` (`id_shop`,`codigo_documento`,`serie`);
ALTER TABLE `sp_shop_series`
  MODIFY `id_shop_series` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- ventas
CREATE TABLE `sp_ventas` (
  `id_venta` int(11) UNSIGNED NOT NULL,
  `id_shop` int(11) NOT NULL,
  `id_customer` int(11) UNSIGNED NOT NULL,
  `tipo_identificacion` varchar(2) DEFAULT NULL,
  `numero_identificacion`	varchar (15) NOT NULL,
  `address1` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `fecha_emision` datetime NOT NULL,
  `codigo_documento` varchar(2) NOT NULL,
  `serie` varchar(6) NOT NULL,
  `secuencia` varchar(9) NOT NULL,
  `autorizacion_sri` varchar(49) NULL,
  `clave_acceso` varchar(49) NOT NULL,
  `ambiente` varchar(1) NOT NULL,
  `tipo_emision` varchar(1) NOT NULL DEFAULT 1,
  `fecha_autorizacion` datetime NULL,
  `xml` text,
  `xml_estado` varchar(2) DEFAULT 0,
  `mensaje_autorizacion` text,
  `items` decimal(3) NOT NULL DEFAULT 0,
  `subtotal` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `descuento` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `id_tax` int(11) UNSIGNED NULL,
  `total` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `forma_pago` text DEFAULT NULL,
  `informacion_adicional` text DEFAULT NULL,    
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `anulado`	tinyint(1) UNSIGNED NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
ALTER TABLE `sp_ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_shop` (`id_shop`,`codigo_documento`,`serie`,`secuencia`),
  ADD KEY `id_shop_id_customer` (`id_shop`,`id_customer`),
  ADD KEY `id_shop_date_add` (`id_shop`,`date_add`);

ALTER TABLE `sp_ventas`
  MODIFY `id_venta` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Estructura de tabla para la tabla `sp_ventas_tax
CREATE TABLE `sp_ventas_tax` (
  `id_venta_tax` int(11) UNSIGNED NOT NULL,
  `id_venta` int(11) UNSIGNED NOT NULL,
  `id_tax` int(11) UNSIGNED NOT NULL,
  `porcentaje` decimal(10,2) NOT NULL DEFAULT 0.00,
  `base_imponible` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `valor_impuesto` decimal(20,6) NOT NULL DEFAULT 0.000000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `sp_ventas_tax`
  ADD PRIMARY KEY (`id_venta_tax`);
ALTER TABLE `sp_ventas_tax`
  MODIFY `id_venta_tax` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Estructura de tabla para la tabla `sp_ventas_detail
CREATE TABLE `sp_ventas_detail` (
  `id_venta_detail` int(11) UNSIGNED NOT NULL,
  `id_venta` int(11) UNSIGNED NOT NULL,
  `id_product` int(11) UNSIGNED NOT NULL,
  `codigo_producto` varchar(10) NULL,
  `description` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `description_aditional1` text COLLATE utf8mb4_spanish_ci NULL,
  `description_aditional2` text COLLATE utf8mb4_spanish_ci NULL,
  `description_aditional3` text COLLATE utf8mb4_spanish_ci NULL,
  `product_quantity` decimal(20,6) NOT NULL DEFAULT 0,
  `product_price` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `product_subtotal` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `product_descuento` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `product_total` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `id_tax` int(11) UNSIGNED NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
ALTER TABLE `sp_ventas_detail`
  ADD PRIMARY KEY (`id_venta_detail`),
  ADD KEY `venta_detail_order` (`id_venta`);
ALTER TABLE `sp_ventas_detail`
  MODIFY `id_venta_detail` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Estructura de tabla para la tabla `sp_ventas_detail_tax
CREATE TABLE `sp_ventas_detail_tax` (
  `id_venta_detail_tax` int(11) UNSIGNED NOT NULL,
  `id_venta_detail` int(11) UNSIGNED NOT NULL,
  `id_tax` int(11) UNSIGNED NOT NULL,
  `porcentaje` decimal(10,2) NOT NULL DEFAULT 0.00,
  `base_imponible` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `valor_impuesto` decimal(20,6) NOT NULL DEFAULT 0.000000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `sp_ventas_detail_tax`
  ADD PRIMARY KEY (`id_venta_detail_tax`);
ALTER TABLE `sp_ventas_detail_tax`
  MODIFY `id_venta_detail_tax` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Estructura de tabla para la tabla `sp_tax
CREATE TABLE `sp_taxes` (
  `id_tax` int(11) UNSIGNED NOT NULL,
  `nombre_impuesto` varchar(20) NULL,  
  `porcentaje` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `sp_taxes` (`id_tax`, `nombre_impuesto`, `porcentaje`) VALUES
(0, 'IVA 0%', 0),
(1, 'IVA 12%', 12);

ALTER TABLE `sp_taxes`
  ADD PRIMARY KEY (`id_tax`);
ALTER TABLE `sp_taxes`
  MODIFY `id_tax` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- RELACIONES

ALTER TABLE ps_customer ADD CONSTRAINT ps_customer_sp_shopgroup FOREIGN KEY ( id_shopgroup ) REFERENCES sp_shopgroup (id_shopgroup);

ALTER TABLE sp_employee_shopgroup ADD CONSTRAINT ps_employee_shopgroup_ps_employee FOREIGN KEY ( id_employee ) REFERENCES ps_employee (id_employee); 
ALTER TABLE sp_employee_shopgroup ADD CONSTRAINT ps_employee_shopgroup_sp_shopgroup FOREIGN KEY ( id_shopgroup ) REFERENCES sp_shopgroup (id_shopgroup); 

ALTER TABLE ps_shop ADD CONSTRAINT ps_shop_sp_shopgroup FOREIGN KEY ( id_shopgroup ) REFERENCES sp_shopgroup (id_shopgroup); 

ALTER TABLE ps_product ADD CONSTRAINT ps_product_ps_shop FOREIGN KEY ( id_shop ) REFERENCES ps_shop (id_shop); 

ALTER TABLE sp_ventas ADD CONSTRAINT sp_ventas_ps_customer FOREIGN KEY ( id_customer ) REFERENCES ps_customer (id_customer);
ALTER TABLE sp_ventas ADD CONSTRAINT sp_ventas_sp_taxes FOREIGN KEY ( id_tax ) REFERENCES sp_taxes (id_tax) ON DELETE CASCADE;

ALTER TABLE sp_ventas_detail ADD CONSTRAINT sp_ventas_detail_sp_ventas FOREIGN KEY ( id_venta ) REFERENCES sp_ventas (id_venta) ON DELETE CASCADE;
ALTER TABLE sp_ventas_detail ADD CONSTRAINT sp_ventas_detail_sp_taxes FOREIGN KEY ( id_tax ) REFERENCES sp_taxes (id_tax) ON DELETE CASCADE;
ALTER TABLE sp_ventas_detail ADD CONSTRAINT sp_ventas_detail_ps_product FOREIGN KEY ( id_product ) REFERENCES ps_product (id_product);

ALTER TABLE sp_ventas_tax ADD CONSTRAINT sp_ventas_tax_sp_ventas FOREIGN KEY ( id_venta ) REFERENCES sp_ventas (id_venta) ON DELETE CASCADE;

ALTER TABLE sp_ventas_detail_tax ADD CONSTRAINT sp_ventas_detail_tax_sp_ventas_detail FOREIGN KEY ( id_venta_detail ) REFERENCES sp_ventas_detail (id_venta_detail) ON DELETE CASCADE;
