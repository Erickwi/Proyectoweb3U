
CREATE DATABASE IF NOT EXISTS `inventario` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `inventario`;

-- =============================================
-- Tabla: usuario
-- =============================================
CREATE TABLE `usuario` (
  `id_usuario` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `cedula` VARCHAR(10) NOT NULL,
  `usuario` VARCHAR(50) NOT NULL,
  `tipo_usuario` VARCHAR(20) NOT NULL,
  `contraseña` VARCHAR(32) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `activo` TINYINT(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB;

-- =============================================
-- Tabla: materiales
-- =============================================
CREATE TABLE `materiales` (
  `id_materiales` INT AUTO_INCREMENT PRIMARY KEY,
  `codigo_material` VARCHAR(20) NOT NULL,
  `nombre_material` VARCHAR(200) NOT NULL,
  `cantidad_material` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `costo_material` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `unidad_medida` VARCHAR(20) NOT NULL,
  `fecha_material` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =============================================
-- Tabla: productos
-- =============================================
CREATE TABLE `productos` (
  `id_productos` INT AUTO_INCREMENT PRIMARY KEY,
  `codigo_productos` VARCHAR(5) NOT NULL,
  `nombre_productos` VARCHAR(200) NOT NULL,
  `foto_producto` VARCHAR(255) DEFAULT NULL,
  `activo_producto` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB;

-- =============================================
-- Tabla: productos_materiales (relación N:N)
-- =============================================
CREATE TABLE `productos_materiales` (
  `productos_id_productos` INT NOT NULL,
  `materiales_id_materiales` INT NOT NULL,
  `cantidad_pm` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`productos_id_productos`, `materiales_id_materiales`),
  FOREIGN KEY (`productos_id_productos`) REFERENCES `productos`(`id_productos`) ON DELETE CASCADE,
  FOREIGN KEY (`materiales_id_materiales`) REFERENCES `materiales`(`id_materiales`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- =============================================
-- Tabla: ordenes_produccion
-- =============================================
CREATE TABLE `ordenes_produccion` (
  `id_orden` INT AUTO_INCREMENT PRIMARY KEY,
  `codigo_orden` VARCHAR(50) NOT NULL,
  `fecha` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `productos_id_productos` INT NOT NULL,
  `cantidad_productos` INT NOT NULL,
  `costo_productos` DECIMAL(10,2) NOT NULL,
  `usuario_id_usuario` INT NOT NULL,
  FOREIGN KEY (`productos_id_productos`) REFERENCES `productos`(`id_productos`),
  FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario`(`id_usuario`)
) ENGINE=InnoDB;

-- =============================================
-- Tabla: inventarios_total
-- =============================================
CREATE TABLE `inventarios_total` (
  `id_inventario` INT AUTO_INCREMENT PRIMARY KEY,
  `codigo_inventario` VARCHAR(50) NOT NULL,
  `fecha_inventario` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `detalle_inventario` VARCHAR(200) NOT NULL,
  `cantidad_inventario` DECIMAL(10,2) NOT NULL,
  `unidad_medida` VARCHAR(20) NOT NULL,
  `precio_unitario_inventario` DECIMAL(10,2) NOT NULL,
  `precio_total` DECIMAL(10,2) NOT NULL,
  `tipo_proceso` VARCHAR(100) NOT NULL,
  `usuario_id_usuario` INT NOT NULL,
  FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario`(`id_usuario`)
) ENGINE=InnoDB;


INSERT INTO `usuario` (`nombre`, `apellido`, `cedula`, `usuario`, `tipo_usuario`, `contraseña`, `fecha`, `activo`)
VALUES ('Administrador', 'General', '0000000000', 'admin', 'administrador', MD5('admin123'), NOW(), 0);

INSERT INTO `usuario` (`nombre`, `apellido`, `cedula`, `usuario`, `tipo_usuario`, `contraseña`, `fecha`, `activo`)
VALUES ('Super', 'Usuario', '0000000001', 'super', 'superU', MD5('super123'), NOW(), 0);

INSERT INTO `usuario` (`nombre`, `apellido`, `cedula`, `usuario`, `tipo_usuario`, `contraseña`, `fecha`, `activo`)
VALUES ('Bodeguero', 'Test', '0000000002', 'bodeguero', 'bodeguero', MD5('bodeguero123'), NOW(), 0);

INSERT INTO `usuario` (`nombre`, `apellido`, `cedula`, `usuario`, `tipo_usuario`, `contraseña`, `fecha`, `activo`)
VALUES ('Produccion', 'Test', '0000000003', 'produccion', 'producción', MD5('produccion123'), NOW(), 0);
