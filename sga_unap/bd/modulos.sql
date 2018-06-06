/*
SQLyog Enterprise - MySQL GUI v8.1 
MySQL - 5.5.5-10.1.28-MariaDB : Database - pric_otca
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`pric_otca` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `pric_otca`;

/*Table structure for table `modulo` */

DROP TABLE IF EXISTS `modulo`;

CREATE TABLE `modulo` (
  `Mod_IdModulo` int(11) NOT NULL AUTO_INCREMENT,
  `Mod_Nombre` varchar(100) NOT NULL,
  `Mod_Codigo` varchar(50) DEFAULT NULL,
  `Mod_Descripcion` varchar(250) DEFAULT NULL,
  `Idi_IdIdioma` char(5) DEFAULT NULL,
  `Mod_Estado` tinyint(1) DEFAULT NULL,
  `Row_Estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Mod_IdModulo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `modulo` */

insert  into `modulo`(Mod_IdModulo,Mod_Nombre,Mod_Codigo,Mod_Descripcion,Idi_IdIdioma,Mod_Estado,Row_Estado) values (1,'Access Control List','ACL',NULL,'en',1,1),(2,'Usuarios','Usuario',NULL,'es',1,1),(3,'Foro','foro',NULL,'es',1,1),(4,'E-Learning','elearning',NULL,'es',1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
