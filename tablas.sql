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

/* =================================== SERVICIOS =========================================== */

-- ----------------------------
-- Procedure structure for `sp_servicios_insert`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_servicios_insert`;
DELIMITER ;;
CREATE PROCEDURE `sp_servicios_insert`(
nombreServicios_ char(50) 
,correoProveedor_ varchar(255)
,linkAcceso_ varchar(255) 
)
BEGIN
INSERT INTO
servicios
(
nombreServicios
,correoProveedor
,linkAcceso
)
VALUES
(
nombreServicios_
,correoProveedor_
,linkAcceso_
);
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_servicios_list`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_servicios_list`;
DELIMITER ;;
CREATE PROCEDURE `sp_servicios_list`()
BEGIN

SELECT
		idServicios
		,nombreServicios	
		,correoProveedor
    ,linkAcceso
	FROM
		servicios;
	
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_servicios_edit`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_servicios_edit`;
DELIMITER ;;
CREATE PROCEDURE `sp_servicios_edit`(
idServicios_ int(6)
,nombreServicios_ char(50) 
,correoProveedor_ varchar(255)
,linkAcceso_ varchar(255) 
)
BEGIN

UPDATE
servicios
SET
nombreServicios=nombreServicios_
,correoProveedor=correoProveedor_
,linkAcceso=linkAcceso_
WHERE
idServicios=idServicios_;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_servicios_delete`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_servicios_delete`;
DELIMITER ;;
CREATE PROCEDURE `sp_servicios_delete`(
idServicios_ int(6)
)
BEGIN

DELETE FROM
servicios
WHERE
idServicios=idServicios_;

END
;;
DELIMITER ;

/* =================================== ADMIN =========================================== */

-- ----------------------------
-- Procedure structure for `sp_admin_insert`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_admin_insert`;
DELIMITER ;;
CREATE PROCEDURE `sp_admin_insert`(
tipoDocumento_ char(20) 
,numDocumento_ varchar(11)
,telefonoContacto_ varchar(9) 
,nombreApellidos_ varchar(60) 
,correoContacto_ varchar(255)
,contrasenia_ varchar(255)
)
BEGIN
INSERT INTO
administrador
(
tipoDocumento
,numDocumento
,telefonoContacto
,nombreApellidos
,correoContacto
,contrasenia
)
VALUES
(
tipoDocumento_
,numDocumento_
,telefonoContacto_
,nombreApellidos_
,correoContacto_
,contrasenia_
);
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_admin_list`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_admin_list`;
DELIMITER ;;
CREATE PROCEDURE `sp_admin_list`()
BEGIN

SELECT
		idAdmin
		,tipoDocumento
    ,numDocumento
    ,telefonoContacto
    ,nombreApellidos
    ,correoContacto
    ,contrasenia
	FROM
		administrador;
	
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_admin_edit`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_admin_edit`;
DELIMITER ;;
CREATE PROCEDURE `sp_admin_edit`(
idAdmin_ int(6)
,tipoDocumento_ char(20) 
,numDocumento_ varchar(11)
,telefonoContacto_ varchar(9) 
,nombreApellidos_ varchar(60) 
,correoContacto_ varchar(255)
,contrasenia_ varchar(255)
)
BEGIN

UPDATE
administrador
SET
tipoDocumento=tipoDocumento_
,numDocumento=numDocumento_
,telefonoContacto=telefonoContacto_
,nombreApellidos=nombreApellidos_
,correoContacto=correoContacto_
,contrasenia=contrasenia_
WHERE
idAdmin=idAdmin_;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_admin_delete`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_admin_delete`;
DELIMITER ;;
CREATE PROCEDURE `sp_admin_delete`(
idAdmin_ int(6)
)
BEGIN

DELETE FROM
administrador
WHERE
idAdmin=idAdmin_;

END
;;
DELIMITER ;

/* =================================== CLIENTES =========================================== */

-- ----------------------------
-- Procedure structure for `sp_clientes_insert`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_clientes_insert`;
DELIMITER ;;
CREATE PROCEDURE `sp_clientes_insert`(
tipoDocumento_ char(20) 
,numDocumento_ varchar(11)
,nombre_ varchar(60)
,razonSocial_ varchar(50)
,nombreComercial_ varchar(50)
,telefonoContacto_ varchar(9) 
,correoContacto_ varchar(255)
,contrasenia_ varchar(255)
)
BEGIN
INSERT INTO
clientes
(
tipoDocumento
,numDocumento
,nombre
,razonSocial
,nombreComercial
,telefonoContacto
,correoContacto
,contrasenia
)
VALUES
(
tipoDocumento_
,numDocumento_
,nombre_
,razonSocial_
,nombreComercial_
,telefonoContacto_
,correoContacto_
,contrasenia_
);
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_clientes_list`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_clientes_list`;
DELIMITER ;;
CREATE PROCEDURE `sp_clientes_list`()
BEGIN

SELECT
		idClientes
		,tipoDocumento
    ,numDocumento
    ,nombre
    ,razonSocial
    ,nombreComercial
    ,telefonoContacto
    ,correoContacto
    ,contrasenia
	FROM
		clientes;
	
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_clientes_edit`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_clientes_edit`;
DELIMITER ;;
CREATE PROCEDURE `sp_clientes_edit`(
idClientes_ int(6)
,tipoDocumento_ char(20) 
,numDocumento_ varchar(11)
,nombre_ varchar(60)
,razonSocial_ varchar(50)
,nombreComercial_ varchar(50)
,telefonoContacto_ varchar(9) 
,correoContacto_ varchar(255)
,contrasenia_ varchar(255)
)
BEGIN

UPDATE
clientes
SET
tipoDocumento=tipoDocumento_
,numDocumento=numDocumento_
,nombre=nombre_
,razonSocial=razonSocial_
,nombreComercial=nombreComercial_
,telefonoContacto=telefonoContacto_
,correoContacto=correoContacto_
,contrasenia=contrasenia_
WHERE
idClientes=idClientes_;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_clientes_delete`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_clientes_delete`;
DELIMITER ;;
CREATE PROCEDURE `sp_clientes_delete`(
idClientes_ int(6)
)
BEGIN

DELETE FROM
clientes
WHERE
idClientes=idClientes_;

END
;;
DELIMITER ;

/* =================================== CREDENCIALES =========================================== */

-- ----------------------------
-- Procedure structure for `sp_credenciales_insert`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_credenciales_insert`;
DELIMITER ;;
CREATE PROCEDURE `sp_credenciales_insert`(
usuario_ varchar(30) 
,contrasenia_ varchar(255)
,observacion_ varchar(50)
,idClientes_ int(6)
,idServicios_ int(6)

)
BEGIN
INSERT INTO
credenciales
(
usuario
,contrasenia
,observacion
,idClientes
,idServicios
)
VALUES
(
usuario_
,contrasenia_
,observacion_
,idClientes_
,idServicios_
);
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_credenciales_list`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_credenciales_list`;
DELIMITER ;;
CREATE PROCEDURE `sp_credenciales_list`()
BEGIN

SELECT
		cre.idCredenciales
		,cre.usuario
    ,cre.contrasenia
    ,cre.observacion
    ,cre.idClientes
    ,cre.idServicios
    ,cli.nombre
    ,ser.nombreServicios
    ,ser.linkAcceso
	FROM
		credenciales cre
    INNER JOIN clientes cli ON cre.idClientes = cli.idClientes
    INNER JOIN servicios ser ON cre.idServicios = ser.idServicios;
	
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_credenciales_edit`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_credenciales_edit`;
DELIMITER ;;
CREATE PROCEDURE `sp_credenciales_edit`(
idCredenciales_ int(6)
,usuario_ varchar(30) 
,contrasenia_ varchar(255)
,observacion_ varchar(50)
,idClientes_ int(6)
,idServicios_ int(6)
)
BEGIN

UPDATE
credenciales
SET
usuario=usuario_
,contrasenia=contrasenia_
,observacion=observacion_
,idClientes=idClientes_
,idServicios=idServicios_
WHERE
idCredenciales=idCredenciales_;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_credenciales_delete`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_credenciales_delete`;
DELIMITER ;;
CREATE PROCEDURE `sp_credenciales_delete`(
idCredenciales_ int(6)
)
BEGIN

DELETE FROM
credenciales
WHERE
idCredenciales=idCredenciales_;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_search_clientes_cre`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_search_clientes_cre`;
DELIMITER ;;
CREATE PROCEDURE `sp_search_clientes_cre`()
BEGIN

SELECT
		idClientes
    ,nombre
	FROM
		clientes;
	
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_search_servicios_cre`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_search_servicios_cre`;
DELIMITER ;;
CREATE PROCEDURE `sp_search_servicios_cre`()
BEGIN

SELECT
		idServicios
		,nombreServicios	
	FROM
		servicios;
	
END
;;
DELIMITER ;
