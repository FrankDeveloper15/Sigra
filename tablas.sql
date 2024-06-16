use sigra;
-- ----------------------------
-- Table structure for clientes
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `idClientes` int(6) NOT NULL AUTO_INCREMENT,
  `tipoDocumento` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `numDocumento` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `razonSocial` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombreComercial` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `telefonoContacto` varchar(9) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `correoContacto` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contrasenia` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`idClientes`) USING BTREE,
  UNIQUE INDEX `idx_cliente_numDocumento` (`numDocumento`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 CHARACTER SET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of clientes
-- ----------------------------
INSERT INTO `clientes` VALUES 
(1, 'DNI', '12345678', 'Empresa Teleaire', 'Empresa A S.A.', 'Empresa A', '987654321', 'empresaA@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'RUC', '10987654322', 'Empresa Cablitosmundo', 'Empresa B S.A.', 'Empresa B', '987654322', 'empresaB@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'RUC', '10897584147', 'Empresa Mejora Continua', 'Empresa C S.A.', 'Empresa C', '987654323', 'empresaC@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for administrador
-- ----------------------------
DROP TABLE IF EXISTS `administrador`;
CREATE TABLE `administrador` (
  `idAdmin` int(6) NOT NULL AUTO_INCREMENT,
  `tipoDocumento` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `numDocumento` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `telefonoContacto` varchar(9) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombreApellidos` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `correoContacto` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contrasenia` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`idAdmin`) USING BTREE,
  UNIQUE INDEX `idx_admin_numDocumento` (`numDocumento`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 CHARACTER SET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of administrador
-- ----------------------------
INSERT INTO `administrador` VALUES 
(1, 'DNI', '98765432', '987654324', 'Arturo Azcurra', 'arturo@admin.com', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'DNI', '12345678', '987654325', 'Frank Martin', 'frank@admin.com', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'Pasaporte', 'XYZ789ABC', '987654326', 'Brayan Ricra', 'brayan@admin.com', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for servicios
-- ----------------------------
DROP TABLE IF EXISTS `servicios`;
CREATE TABLE `servicios` (
  `idServicios` int(6) NOT NULL AUTO_INCREMENT,
  `nombreServicios` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `correoProveedor` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `linkAcceso` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`idServicios`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 CHARACTER SET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for credenciales
-- ----------------------------
DROP TABLE IF EXISTS `credenciales`;
CREATE TABLE `credenciales` (
  `idCredenciales` int(6) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contrasenia` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `observacion` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idClientes` int(6) NULL DEFAULT NULL,
  `idServicios` int(6) NULL DEFAULT NULL,
  PRIMARY KEY (`idCredenciales`) USING BTREE,
  INDEX `fk_credenciales_id_cliente_cliente_idx` (`idClientes`) USING BTREE,
  INDEX `fk_credenciales_id_servicios_servicios_idx` (`idServicios`) USING BTREE,
  CONSTRAINT `fk_credenciales_id_cliente` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_credenciales_id_servicios` FOREIGN KEY (`idServicios`) REFERENCES `servicios` (`idServicios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 CHARACTER SET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for contrato
-- ----------------------------
DROP TABLE IF EXISTS `contrato`;
CREATE TABLE `contrato` (
  `idContrato` int(6) NOT NULL AUTO_INCREMENT,
  `fechaInicio` date NOT NULL,
  `fechaRenovacion` date NOT NULL,
  `documento` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idCredenciales` int(6) NULL DEFAULT NULL,
  `idAdmin` int(6) NULL DEFAULT NULL,
  PRIMARY KEY (`idContrato`) USING BTREE,
  INDEX `fk_contrato_id_credenciales_credenciales_idx` (`idCredenciales`) USING BTREE,
  INDEX `fk_servicios_id_admin_admin_idx` (`idAdmin`) USING BTREE,
  CONSTRAINT `fk_contrato_id_admin` FOREIGN KEY (`idAdmin`) REFERENCES `administrador` (`idAdmin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contrato_id_credenciales` FOREIGN KEY (`idCredenciales`) REFERENCES `credenciales` (`idCredenciales`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 CHARACTER SET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for facturas
-- ----------------------------
DROP TABLE IF EXISTS `facturas`;
CREATE TABLE `facturas` (
  `idFacturas` int(6) NOT NULL AUTO_INCREMENT,
  `mes` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tipoMoneda` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `monto` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fechaEmision` date NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `estado` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `documento` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
  `idClientes` int(6) NULL DEFAULT NULL,
  PRIMARY KEY (`idFacturas`) USING BTREE,
  INDEX `fk_facturas_id_clientes_clientes_idx` (`idClientes`) USING BTREE,
  CONSTRAINT `fk_facturas_id_clientes` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 CHARACTER SET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for historia_pagos
-- ----------------------------
DROP TABLE IF EXISTS `historias_pagos`;
CREATE TABLE `historias_pagos` (
  `idHistoriaPagos` int(6) NOT NULL AUTO_INCREMENT,
  `idFacturas` int(6) NULL DEFAULT NULL,
  PRIMARY KEY (`idHistoriaPagos`) USING BTREE,
  INDEX `fk_historias_pagos_id_facturas_facturas_idx` (`idFacturas`) USING BTREE,
  CONSTRAINT `fk_historias_pagos_id_facturas` FOREIGN KEY (`idFacturas`) REFERENCES `facturas` (`idFacturas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 CHARACTER SET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- -
-- ----------------------------
-- Procedure structure for sp_clientes_login
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_clientes_login`;
DELIMITER ;;
CREATE PROCEDURE `sp_clientes_login` (IN correoContacto_ VARCHAR(255))
BEGIN
  SELECT 
    idClientes,
    numDocumento,
    razonSocial,
    nombre,
    nombreComercial,
    correoContacto,
    contrasenia
  FROM
    clientes
  WHERE
    correoContacto = correoContacto_;
END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for sp_admin_login
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_admin_login`;
DELIMITER ;;
CREATE PROCEDURE `sp_admin_login` (IN correoContacto_ VARCHAR(255))
BEGIN
  SELECT 
    idAdmin,
    numDocumento,
    telefonoContacto,
    nombreApellidos,
    correoContacto,
    contrasenia
  FROM
    administrador
  WHERE
    correoContacto = correoContacto_;
END;;
DELIMITER ;

DELIMITER $$

CREATE PROCEDURE sp_registrar_cliente(
    IN p_tipoDocumento VARCHAR(20),
    IN p_numDocumento VARCHAR(11),
    IN p_nombre VARCHAR(60),
    IN p_razonSocial VARCHAR(50),
    IN p_nombreComercial VARCHAR(50),
    IN p_telefonoContacto VARCHAR(9),
    IN p_correoContacto VARCHAR(255),
    IN p_contrasenia VARCHAR(255)
)
BEGIN
    INSERT INTO clientes (
        tipoDocumento, 
        numDocumento, 
        nombre, 
        razonSocial, 
        nombreComercial, 
        telefonoContacto, 
        correoContacto, 
        contrasenia
    )
    VALUES (
        p_tipoDocumento, 
        p_numDocumento, 
        p_nombre, 
        p_razonSocial, 
        p_nombreComercial, 
        p_telefonoContacto, 
        p_correoContacto, 
        p_contrasenia
    );
END$$

DELIMITER ;