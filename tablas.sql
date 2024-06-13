use sigra;
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes`  (
  `idCliente` int(6) NOT NULL AUTO_INCREMENT,
  `tipoDocumento` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `numDocumento` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `razonSocial` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombreComercial` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `telefonoContacto` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `correoContacto` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `personaCargo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `servicioContrato` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cicloFacturacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fechaRenovacion` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contrasenia` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`idCliente`) USING BTREE,
  UNIQUE INDEX `idx_cliente_numDocumento`(`numDocumento`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of clientes
-- ----------------------------
INSERT INTO `clientes` VALUES (1,'DNI', '12345678', 'Empresa A S.A.', 'Empresa A', '+51987654321', 'empresaA@gmail.com', 'Gerente General', 'Servicio de Consultoría', 'Mensual', '2024-04-01', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `clientes` VALUES (2,'RUC', '98765432', 'Empresa B S.A.', 'Empresa B', '+51987654322', 'empresaB@gmail.com', 'Director de Operaciones', 'Servicio de Software', 'Trimestral', '2024-06-15', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `clientes` VALUES (3,'Pasaporte', 'ABC123XYZ', 'Empresa C S.A.', 'Empresa C', '+51987654323', 'empresaC@gmail.com', 'Jefe de Finanzas', 'Servicio de Marketing Digital', 'Anual', '2024-12-31', '21232f297a57a5a743894a0e4a801fc3');
-- ----------------------------
DROP TABLE IF EXISTS `administrador`;
CREATE TABLE `administrador`  (
  `idAdmin` int(6) NOT NULL AUTO_INCREMENT,
  `tipoDocumento` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `numDocumento` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `telefonoContacto` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombreApellidos` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `correoContacto` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contrasenia` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`idAdmin`) USING BTREE,
  UNIQUE INDEX `idx_admin_numDocumento`(`numDocumento`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of apoderado
-- ----------------------------
INSERT INTO `administrador` VALUES (1, 'DNI', '98765432', '+51987654324', 'Arturo Azcurra', 'arturo@admin.com', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `administrador` VALUES (2, 'DNI', '12345678', '+51987654325', 'Frank Martin', 'frank@admin.com', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `administrador` VALUES (3, 'Pasaporte', 'XYZ789ABC', '+51987654326', 'Brayan Ricra', 'brayan@admin.com', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for accesos
-- ----------------------------
DROP TABLE IF EXISTS `historial`;
CREATE TABLE `historial`  (
  `id_historial` int(4) NOT NULL,
  `id_aula` int(4) NOT NULL,
  `id_matricula` int(4) NOT NULL,
  `id_curso` int(4) NOT NULL,
  `bimestre` tinyint(4) NOT NULL,
  `nota` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id_historial`, `id_aula`, `id_matricula`, `id_curso`, `bimestre`) USING BTREE,
  INDEX `fk_historial_Aula_1`(`id_aula`) USING BTREE,
  INDEX `fk_historial_Curso_1`(`id_curso`) USING BTREE,
  INDEX `fk_historial_Matricula_1`(`id_matricula`) USING BTREE,
  CONSTRAINT `fk_historial_Aula_1` FOREIGN KEY (`id_aula`) REFERENCES `aula` (`id_aula`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_historial_Curso_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_historial_Matricula_1` FOREIGN KEY (`id_matricula`) REFERENCES `matricula` (`id_matricula`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Procedure structure for sp_clientes_loguin
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_clientes_loguin`;
delimiter ;;
CREATE PROCEDURE `sp_clientes_loguin`(IN correoContacto_ VARCHAR(255))
BEGIN
SELECT 
		idCliente
		,numDocumento
		,razonSocial
		,nombreComercial
		,correoContacto
        ,contrasenia
	FROM
		Clientes
	WHERE
		correoContacto=correoContacto_;

END
;;
delimiter ;


-- ----------------------------
-- Procedure structure for sp_admin_loguin
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_admin_loguin`;
delimiter ;;
CREATE PROCEDURE `sp_admin_loguin`(IN correoContacto_ VARCHAR(255))
BEGIN
SELECT 
		idAdmin
		,numDocumento
		,telefonoContacto
		,nombreApellidos
		,correoContacto
        ,contrasenia
	FROM
		Administrador
	WHERE
		correoContacto=correoContacto_;

END
;;
delimiter ;