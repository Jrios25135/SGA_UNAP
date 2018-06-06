/*
SQLyog Enterprise - MySQL GUI v8.1 
MySQL - 5.5.5-10.1.28-MariaDB : Database - sga_unap
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`sga_unap` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `sga_unap`;

/*Table structure for table `curricula` */

DROP TABLE IF EXISTS `curricula`;

CREATE TABLE `curricula` (
  `Cui_IdCurricula` int(11) NOT NULL AUTO_INCREMENT,
  `Cui_Nombre` varchar(250) DEFAULT NULL,
  `Cui_Descripcion` longtext,
  `Cui_Codigo` varchar(50) DEFAULT NULL,
  `Cui_Resolucion` varchar(250) DEFAULT NULL,
  `Esc_IdEscuela` int(11) DEFAULT NULL,
  `Cui_Estado` tinyint(1) DEFAULT NULL,
  `Row_Estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Cui_IdCurricula`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `curricula` */

insert  into `curricula`(Cui_IdCurricula,Cui_Nombre,Cui_Descripcion,Cui_Codigo,Cui_Resolucion,Esc_IdEscuela,Cui_Estado,Row_Estado) values (1,'NUEVA CURRICULA ING SISTEMAS',NULL,'123456','RR-123456-2011',1,1,1),(2,'ANTIGUA CURRICULA ING SISTEMAS',NULL,'321654','RR-321654-2017',1,1,1),(3,'NUEVA CURRICULA DE ECONOMIA',NULL,'654321','RR-654321-2017',2,1,1);

/*Table structure for table `escuela` */

DROP TABLE IF EXISTS `escuela`;

CREATE TABLE `escuela` (
  `Esc_IdEscuela` int(11) NOT NULL AUTO_INCREMENT,
  `Esc_Nombre` varchar(200) DEFAULT NULL,
  `Esc_Descripcion` varchar(250) DEFAULT NULL,
  `Esc_Direccion` varchar(250) DEFAULT NULL,
  `Esc_Telefono` varchar(45) DEFAULT NULL,
  `Fac_IdFacultad` int(11) NOT NULL,
  `Esc_Estado` tinyint(1) DEFAULT NULL,
  `Row_Estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Esc_IdEscuela`),
  KEY `Fk_escuela_facultad_idx` (`Fac_IdFacultad`),
  CONSTRAINT `Fk_escuela_facultad` FOREIGN KEY (`Fac_IdFacultad`) REFERENCES `facultad` (`Fac_IdFacultad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `escuela` */

insert  into `escuela`(Esc_IdEscuela,Esc_Nombre,Esc_Descripcion,Esc_Direccion,Esc_Telefono,Fac_IdFacultad,Esc_Estado,Row_Estado) values (1,'Escuela Profesional de Administracion','Descripción breve','Calle Nanay 352','065234364 / 065243644',2,1,1),(2,'Escuela Profesional de Contabilidad','Descripción breve','Calle Nanay 352','065234364 / 065243644',2,1,1),(3,'Escuela Profesional de Economia','Descripción breve','Calle Nanay 352','065234364 / 065243644',2,1,1),(4,'Escuela Profesional de Negocios y Turismo','Descripción breve','Calle Nanay 352','065234364 / 065243644',2,1,1),(5,'Escuela Profesional de Agronomia','Descripción breve','Calle Samanez Ocampo 185','065234140',4,1,1),(6,'Escuela Profesional de Gestión Ambiental','Descripción breve','Calle Samanez Ocampo 185','065234140',4,1,1),(7,'Escuela Profesional de Acuicultura','Descripción breve','Calle Pevas 5ta cuadra','065236121',10,1,1),(8,'Escuela Profesional de Ciencias Biologicas','Descripción breve','Calle Pevas 5ta cuadra','065236121',10,1,1),(9,'Escuela Profesional de Ingenieria de Sistemas e Informatica','Descripción breve','Moore 280','065232708',1,1,1),(10,'Escuela Profesional de Ingenieria de Industrias Alimentarias','Descripción breve','Calle Nauta 5ta. cuadra','065234458',3,1,1),(11,'Escuela Profesional de Bromotologia y Nutricion Humana','Descripción breve','Calle Nauta 5ta. cuadra','065234458',3,1,1),(12,'Escuela Profesional de Educación Fisica','Descripción breve','Sgto. Lores 635','065233563',5,1,1),(13,'Escuela Profesional de Zootecnia','Descripción breve','Calle Libertad 1250, Yurimaguas','065351010',8,1,1),(14,'Escuela Profesional de Odontologia','Descripción breve','San Marcos/Las Crisnejas s/n, San Juan Bautista','065 633728',6,1,1),(15,'Escuela Profesional de Medicina Humana','Descripción breve','Av. Colonial s/n, Moronillo, Punchana','065251780',7,1,1),(16,'Escuela Profesional de Ciencias Forestales','Descripción breve','Pevas 584','065 233705',9,1,1),(17,'Escuela Profesional de Ingenieria en Ecologia de Bosques Tropicales ','Descripción breve','Pevas 584','065233705',9,1,1),(18,'Escuela Profesional de Farmacia y Bioquimica','Descripción breve','Nina Rumi, San Juan Bautista','--',11,1,1),(19,'Escuela Profesional de Enfermeria','Descripción breve','Pasaje Dina Límaco 186','065266368',12,1,1),(20,'Escuela Profesional de Derecho y Ciencias Políticas','Descripción breve','Sargento Lores 446','065222720',13,1,1),(21,'Escuela Profesional de Ingeniería Química','Descripción breve','Av. Freyre 616','065243665 - 234101',14,1,1);

/*Table structure for table `escuela_ambiente` */

DROP TABLE IF EXISTS `escuela_ambiente`;

CREATE TABLE `escuela_ambiente` (
  `Esc_IdEscuela` int(11) NOT NULL,
  `Amb_IdAmbiente` int(11) NOT NULL,
  KEY `fk_escula_ambiente_escuela_idx` (`Esc_IdEscuela`),
  KEY `fk_escuela_ambiente_ambiente_idx` (`Amb_IdAmbiente`),
  CONSTRAINT `fk_escuela_ambiente_ambiente` FOREIGN KEY (`Amb_IdAmbiente`) REFERENCES `ambiente` (`Amb_IdAmbiente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_escuela_ambiente_escuela` FOREIGN KEY (`Esc_IdEscuela`) REFERENCES `escuela` (`Esc_IdEscuela`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `escuela_ambiente` */

/*Table structure for table `facultad` */

DROP TABLE IF EXISTS `facultad`;

CREATE TABLE `facultad` (
  `Fac_IdFacultad` int(11) NOT NULL AUTO_INCREMENT,
  `Fac_Nombre` varchar(150) DEFAULT NULL,
  `Fac_Direccion` varchar(200) DEFAULT NULL,
  `Fac_Telefono` varchar(100) DEFAULT NULL,
  `Fac_Estado` tinyint(1) DEFAULT NULL,
  `Row_Estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Fac_IdFacultad`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `facultad` */

insert  into `facultad`(Fac_IdFacultad,Fac_Nombre,Fac_Direccion,Fac_Telefono,Fac_Estado,Row_Estado) values (1,'Facultad de Ingeniería de Sistemas e Informática','Calle Moore 250','065263265',1,1),(2,'Facultad de Ciencias Economicas y de Negocios','Pevas 540','065362565',1,1),(3,'Facultad de Industrias Alimentarias','Nauta 460','065246859',1,1),(4,'Facultad de Agronomia','Nauta 480','065874582',1,1),(5,'Facultad de Ciencias de la Educación y Humanidades','Bermudez 36','065235689',1,1),(6,'Facultad de Odontología','San Marcos/Las Crisnejas s/n, San Juan Bautista','065633728',1,1),(7,'Facultad de Medicina Humana','Av. Colonial s/n, Moronillo, Punchana','065251780',1,1),(8,'Facultad de Zootecnia','Calle Libertad 1250, Yurimaguas, Perú','065351010',1,1),(9,'Facultad de Ciencias Forestales','Pevas 584','065233705',1,1),(10,'Facultad de Ciencias Biológicas','Calle Pevas 5ta cuadra','065236121',1,1),(11,'Facultad de Farmacia y Bioquímica','Nina Rumi, San Juan Bautista',NULL,1,1),(12,'Facultad de Enfermeria','Pasaje Dina Límaco 186','065266368',1,1),(13,'Facultad de Derecho y Ciencias Politicos','Sargento Lores 446','065222720',1,1),(14,'Facultad de Ingenieria Quimica','Av. Freyre 616','065243665 -065234101',1,1),(15,'CurriculaNueva','Descripcion de currii','56590665',0,1);

/* Procedure structure for procedure `s_i_curricula` */

/*!50003 DROP PROCEDURE IF EXISTS  `s_i_curricula` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `s_i_curricula`(
	IN iCui_Nombre VARCHAR(250) ,
	IN iCui_Descripcion longtext ,
	IN iCui_Codigo VARCHAR(50) ,
	in iCui_Resolucion varchar(250),
	IN iEsc_IdEscuela INT(11),
	IN iCui_Estado TINYINT(1),
	in iRow_Estado tinyint(1)
    )
BEGIN
    INSERT INTO curricula(
	Cui_Nombre,
	Cui_Descripcion,
	Cui_Codigo,
	Cui_Resolucion,
	Esc_IdEscuela,
	Cui_Estado,
	Row_Estado
	)
   VALUES(
	iCui_Nombre,
	iCui_Descripcion,
	iCui_Codigo,
	iCui_Resolucion,
	iEsc_IdEscuela,
	iCui_Estado,
	iRow_Estado
);
    SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `s_i_escuela` */

/*!50003 DROP PROCEDURE IF EXISTS  `s_i_escuela` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `s_i_escuela`(
	IN iEsc_Nombre VARCHAR(200) ,
	IN iEsc_Descripcion VARCHAR(250) ,
	IN iEsc_Direccion VARCHAR(250) ,
	in iEsc_Telefono varchar(45),
	IN iFac_IdFacultad INT(11),
	IN iEsc_Estado TINYINT(1),
	in iRow_Estado tinyint(1)
    )
BEGIN
    INSERT INTO escuela(
	Esc_Nombre,
	Esc_Descripcion,
	Esc_Direccion,
	Esc_Telefono,
	Fac_IdFacultad,
	Esc_Estado,
	Row_Estado
	)
   VALUES(
	iEsc_Nombre,
	iEsc_Descripcion,
	iEsc_Direccion,
	iEsc_Telefono,
	iFac_IdFacultad,
	iEsc_Estado,
	iRow_Estado
);
    SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `s_i_facultad` */

/*!50003 DROP PROCEDURE IF EXISTS  `s_i_facultad` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `s_i_facultad`(
	IN iFac_Nombre VARCHAR(150) ,
	IN iFac_Direccion varCHAR(200) ,
	in iFac_Telefono varchar(100),
	in iFac_Estado TINYINT(1),
	in iRow_Estado tinyint(1)
    )
BEGIN
    INSERT INTO facultad(
	Fac_Nombre,
	Fac_Direccion,
	Fac_Telefono,
	Fac_Estado,
	Row_Estado
	)
   VALUES(
	iFac_Nombre,
	iFac_Direccion,
	iFac_Telefono,
	iFac_Estado,
	iRow_Estado
);
    SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `s_s_listar_curriculas` */

/*!50003 DROP PROCEDURE IF EXISTS  `s_s_listar_curriculas` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `s_s_listar_curriculas`( 
	IN iPagina INT(11),
	IN iRegistrosXPagina INT(11),
	in iRow_Estado tinyint(1)
)
BEGIN
	DECLARE registroInicio INT;
	IF iPagina > 0 THEN 
		SET registroInicio = (iPagina - 1) * iRegistrosXPagina;
		if iRow_Estado = 1 then
			SELECT * FROM curricula 
			where Row_Estado = iRow_Estado 
			LIMIT registroInicio,iRegistrosXPagina;
		else
			SELECT * FROM curricula  
			ORDER BY Row_Estado DESC 
			LIMIT registroInicio,iRegistrosXPagina;
		end if;
	ELSE 
		IF iRow_Estado = 1 THEN			
			SELECT * FROM curricula   
			WHERE Row_Estado = iRow_Estado 
			LIMIT 0,iRegistrosXPagina;
		else 
			SELECT * FROM curricula 
			ORDER BY Row_Estado DESC 
			LIMIT 0,iRegistrosXPagina;
		END IF;
	END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `s_s_listar_facultades` */

/*!50003 DROP PROCEDURE IF EXISTS  `s_s_listar_facultades` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `s_s_listar_facultades`( 
	IN iPagina INT(11),
	IN iRegistrosXPagina INT(11),
	in iRow_Estado tinyint(1)
)
BEGIN
	DECLARE registroInicio INT;
	IF iPagina > 0 THEN 
		SET registroInicio = (iPagina - 1) * iRegistrosXPagina;
		if iRow_Estado = 1 then
			SELECT f.* FROM facultad f 
			where Row_Estado = iRow_Estado 
			LIMIT registroInicio,iRegistrosXPagina;
		else
			SELECT f.* FROM facultad f  
			ORDER BY Row_Estado DESC 
			LIMIT registroInicio,iRegistrosXPagina;
		end if;
	ELSE 
		IF iRow_Estado = 1 THEN			
			SELECT f.* FROM facultad f   
			WHERE Row_Estado = iRow_Estado 
			LIMIT 0,iRegistrosXPagina;
		else 
			SELECT f.* FROM facultad f 
			ORDER BY Row_Estado DESC 
			LIMIT 0,iRegistrosXPagina;
		END IF;
	END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `s_u_cambiar_estado_facultad` */

/*!50003 DROP PROCEDURE IF EXISTS  `s_u_cambiar_estado_facultad` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `s_u_cambiar_estado_facultad`(
	IN iFac_IdFacultad int(11),
	IN iFac_Estado tinyint(1)
)
UPDATE facultad SET Fac_Estado = iFac_Estado WHERE Fac_IdFacultad = iFac_IdFacultad */$$
DELIMITER ;

/* Procedure structure for procedure `s_u_editar_facultad` */

/*!50003 DROP PROCEDURE IF EXISTS  `s_u_editar_facultad` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `s_u_editar_facultad`(
	IN iFac_IdFacultad int(11),
	IN iFac_Nombre VARCHAR(150),
	IN iFac_Direccion VARCHAR(200),
	IN iFac_Telefono VARCHAR(100)
)
UPDATE facultad SET Fac_Nombre = iFac_Nombre, Fac_Direccion = iFac_Direccion, Fac_Telefono = iFac_Telefono 
where Fac_IdFacultad = iFac_IdFacultad */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
