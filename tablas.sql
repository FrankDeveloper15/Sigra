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
) ENGINE=InnoDB AUTO_INCREMENT=1 CHARACTER SET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 CHARACTER SET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of administrador
-- ----------------------------
INSERT INTO `administrador` VALUES 
(1, 'RUC', '20612408824', '984404105', 'CORPORACION V Y S PERU E.I.R.L', 'avsci@hotmail.com', '21232f297a57a5a743894a0e4a801fc3');

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
  CONSTRAINT `fk_credenciales_id_cliente` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_credenciales_id_servicios` FOREIGN KEY (`idServicios`) REFERENCES `servicios` (`idServicios`) ON DELETE NO ACTION ON UPDATE CASCADE
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
  CONSTRAINT `fk_contrato_id_admin` FOREIGN KEY (`idAdmin`) REFERENCES `administrador` (`idAdmin`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_contrato_id_credenciales` FOREIGN KEY (`idCredenciales`) REFERENCES `credenciales` (`idCredenciales`) ON DELETE NO ACTION ON UPDATE CASCADE
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
  `documento` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `reportePago` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `notificacion` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idClientes` int(6) NULL DEFAULT NULL,
  PRIMARY KEY (`idFacturas`) USING BTREE,
  INDEX `fk_facturas_id_clientes_clientes_idx` (`idClientes`) USING BTREE,
  CONSTRAINT `fk_facturas_id_clientes` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`idClientes`) ON DELETE NO ACTION ON UPDATE CASCADE
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

/* =================================== CONTRATO =========================================== */

-- ----------------------------
-- Procedure structure for `sp_contrato_insert`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_contrato_insert`;
DELIMITER ;;
CREATE PROCEDURE `sp_contrato_insert`(
fechaInicio_ date 
,fechaRenovacion_ date
,documento_ varchar(255)
,idCredenciales_ int(6)
,idAdmin_ int(6)

)
BEGIN
INSERT INTO
contrato
(
fechaInicio
,fechaRenovacion
,documento
,idCredenciales
,idAdmin
)
VALUES
(
fechaInicio_
,fechaRenovacion_
,documento_
,idCredenciales_
,idAdmin_
);
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_contrato_list`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_contrato_list`;
DELIMITER ;;
CREATE PROCEDURE `sp_contrato_list`()
BEGIN

SELECT
    con.idContrato
    ,con.fechaInicio
    ,con.fechaRenovacion
    ,con.documento
    ,con.idCredenciales
    ,con.idAdmin
		,cre.idClientes
    ,cre.idServicios
    ,cli.nombre
    ,ser.nombreServicios
    ,ad.nombreApellidos
	FROM
		contrato con
    INNER JOIN credenciales cre ON con.idCredenciales = cre.idCredenciales
    INNER JOIN administrador ad ON con.idAdmin = ad.idAdmin
    INNER JOIN clientes cli ON cre.idClientes = cli.idClientes
    INNER JOIN servicios ser ON cre.idServicios = ser.idServicios;
	
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_contrato_edit`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_contrato_edit`;
DELIMITER ;;
CREATE PROCEDURE `sp_contrato_edit`(
idContrato_ int(6)
,fechaInicio_ date 
,fechaRenovacion_ date
,documento_ varchar(255)
,idCredenciales_ int(6)
,idAdmin_ int(6)
)
BEGIN

UPDATE
contrato
SET
fechaInicio=fechaInicio_
,fechaRenovacion=fechaRenovacion_
,documento=documento_
,idCredenciales=idCredenciales_
,idAdmin=idAdmin_
WHERE
idContrato=idContrato_;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_contrato_delete`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_contrato_delete`;
DELIMITER ;;
CREATE PROCEDURE `sp_contrato_delete`(
idContrato_ int(6)
)
BEGIN

DELETE FROM
contrato
WHERE
idContrato=idContrato_;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_search_clientes_con`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_search_clientes_con`;
DELIMITER ;;
CREATE PROCEDURE `sp_search_clientes_con`()
BEGIN

SELECT
    cre.idCredenciales
		,cli.idClientes
    ,cli.nombre
    ,ser.idServicios
    ,ser.nombreServicios
	FROM
		clientes cli
    INNER JOIN credenciales cre ON cli.idClientes = cre.idClientes
    INNER JOIN servicios ser ON cre.idServicios = ser.idServicios;
	
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_search_admin_con`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_search_admin_con`;
DELIMITER ;;
CREATE PROCEDURE `sp_search_admin_con`()
BEGIN

SELECT
		idAdmin
		,nombreApellidos	
	FROM
		administrador;
	
END
;;
DELIMITER ;

/* =================================== FACTURAS =========================================== */
-- ----------------------------
-- Procedure structure for `sp_facturas_insert`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_facturas_insert`;
DELIMITER ;;
CREATE PROCEDURE `sp_facturas_insert`(
mes_ varchar(30)
,tipoMoneda_ varchar(10)
,monto_ varchar(5)
,fechaEmision_ date 
,fechaVencimiento_ date
,estado_ varchar(15)
,documento_ varchar(255)
,reportePago_ varchar(255)
,notificacion_ varchar(6)
,idClientes_ int(6)

)
BEGIN
INSERT INTO
facturas
(
mes
,tipoMoneda
,monto
,fechaEmision
,fechaVencimiento
,estado
,documento
,reportePago
,notificacion
,idClientes
)
VALUES
(
mes_
,tipoMoneda_
,monto_
,fechaEmision_
,fechaVencimiento_
,estado_
,documento_
,reportePago_
,notificacion_
,idClientes_
);
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_facturas_list`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_facturas_list`;
DELIMITER ;;
CREATE PROCEDURE `sp_facturas_list`()
BEGIN

SELECT
    fac.idFacturas
    ,fac.mes
    ,fac.tipoMoneda
    ,fac.monto
    ,fac.fechaEmision
    ,fac.fechaVencimiento
		,fac.estado
    ,fac.documento
    ,fac.reportePago
    ,fac.notificacion
    ,fac.idClientes
    ,cli.nombre
    ,ser.nombreServicios
	FROM
		facturas fac
    INNER JOIN credenciales cre ON fac.idClientes = cre.idClientes
    INNER JOIN contrato con ON con.idCredenciales = cre.idCredenciales
    INNER JOIN clientes cli ON cli.idClientes = cre.idClientes
    INNER JOIN servicios ser ON ser.idServicios = cre.idServicios;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_facturas_edit`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_facturas_edit`;
DELIMITER ;;
CREATE PROCEDURE `sp_facturas_edit`(
    idFacturas_ INT(6),
    mes_ VARCHAR(30),
    tipoMoneda_ VARCHAR(10),
    monto_ VARCHAR(5),
    fechaEmision_ DATE, 
    fechaVencimiento_ DATE,
    estado_ VARCHAR(15),
    documento_ VARCHAR(255),
    reportePago_ VARCHAR(255),
    idClientes_ INT(6)
)
BEGIN
    DECLARE new_notificacion VARCHAR(6);

    IF estado_ = 'Pago' THEN
        SET new_notificacion = '0';
    ELSEIF estado_ = 'Pendiente' THEN
        SET new_notificacion = '1';
    ELSE
        SET new_notificacion = '1'; -- Valor predeterminado en caso de que no sea ni 'Pago' ni 'Pendiente'
    END IF;

    UPDATE facturas
    SET
        mes = mes_,
        tipoMoneda = tipoMoneda_,
        monto = monto_,
        fechaEmision = fechaEmision_,
        fechaVencimiento = fechaVencimiento_,
        estado = estado_,
        documento = documento_,
        reportePago = reportePago_,
        notificacion = new_notificacion,
        idClientes = idClientes_
    WHERE
        idFacturas = idFacturas_;

END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_facturas_delete`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_facturas_delete`;
DELIMITER ;;
CREATE PROCEDURE `sp_facturas_delete`(
idFacturas_ int(6)
)
BEGIN

DELETE FROM
facturas
WHERE
idFacturas=idFacturas_;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_search_clientes_fac`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_search_clientes_fac`;
DELIMITER ;;
CREATE PROCEDURE `sp_search_clientes_fac`()
BEGIN

SELECT
		cli.idClientes
    ,cli.nombre
	FROM
		contrato con
    INNER JOIN credenciales cre ON con.idCredenciales = cre.idCredenciales
    INNER JOIN clientes cli ON cli.idClientes = cre.idClientes;
	
END
;;
DELIMITER ;

/* =================================== TABLAS DE CLIENTES =========================================== */
-- ----------------------------
-- Procedure structure for `sp_info_clientes`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_info_clientes`;
DELIMITER ;;
CREATE PROCEDURE `sp_info_clientes`(
idClientes_ int(6)
)
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
	FROM
		clientes
  WHERE
	idClientes = idClientes_;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_info_credenciales`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_info_credenciales`;
DELIMITER ;;
CREATE PROCEDURE `sp_info_credenciales`(
idClientes_ int(6)
)
BEGIN

SELECT
    cre.idCredenciales
		,cre.usuario
    ,cre.observacion
    ,cre.idClientes
    ,cre.idServicios
    ,cli.nombre
    ,ser.nombreServicios
    ,ser.linkAcceso
	FROM
		credenciales cre
    INNER JOIN clientes cli ON cre.idClientes = cli.idClientes
    INNER JOIN servicios ser ON cre.idServicios = ser.idServicios
  WHERE
	  cre.idClientes = idClientes_;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_info_contrato
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_info_contrato`;
DELIMITER ;;
CREATE PROCEDURE `sp_info_contrato`(
idClientes_ int(6)
)
BEGIN

SELECT
    con.idContrato
    ,con.fechaInicio
    ,con.fechaRenovacion
    ,con.documento
    ,con.idCredenciales
    ,con.idAdmin
		,cre.idClientes
    ,cre.idServicios
    ,cli.nombre
    ,ser.nombreServicios
    ,ad.nombreApellidos
	FROM
		contrato con
    INNER JOIN credenciales cre ON con.idCredenciales = cre.idCredenciales
    INNER JOIN administrador ad ON con.idAdmin = ad.idAdmin
    INNER JOIN clientes cli ON cre.idClientes = cli.idClientes
    INNER JOIN servicios ser ON cre.idServicios = ser.idServicios
  WHERE
	cre.idClientes = idClientes_;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_info_facturas`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_info_facturas`;
DELIMITER ;;
CREATE PROCEDURE `sp_info_facturas`(
  idClientes_ int(6)
)
BEGIN

SELECT
    fac.idFacturas
    ,fac.mes
    ,fac.tipoMoneda
    ,fac.monto
    ,fac.fechaEmision
    ,fac.fechaVencimiento
		,fac.estado
    ,fac.documento
    ,fac.reportePago
    ,fac.notificacion
    ,fac.idClientes
    ,cli.nombre
    ,ser.nombreServicios
	FROM
		facturas fac
    INNER JOIN credenciales cre ON fac.idClientes = cre.idClientes
    INNER JOIN contrato con ON con.idCredenciales = cre.idCredenciales
    INNER JOIN clientes cli ON cli.idClientes = cre.idClientes
    INNER JOIN servicios ser ON ser.idServicios = cre.idServicios
  WHERE
    fac.idClientes = idClientes_;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `sp_facturas_edit_reportePago`
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_facturas_edit_reportePago`;
DELIMITER ;;
CREATE PROCEDURE `sp_facturas_edit_reportePago`(
    idFacturas_ INT(6),
    reportePago_ VARCHAR(255),
    notificacion_ VARCHAR(6)
)
BEGIN
    UPDATE facturas
    SET
        reportePago = reportePago_,
        notificacion = notificacion_
    WHERE
        idFacturas = idFacturas_;
END;;
DELIMITER ;