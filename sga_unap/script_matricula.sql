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

/*Table structure for table `matricula` */

DROP TABLE IF EXISTS `matricula`;

CREATE TABLE `matricula` (
  `Mat_IdMatricula` int(11) NOT NULL AUTO_INCREMENT,
  `Mat_Fecha` date DEFAULT NULL,
  `Usr_IdUsuarioRol` int(11) DEFAULT NULL,
  PRIMARY KEY (`Mat_IdMatricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `matricula` */

/*Table structure for table `matricula_carga_academica` */

DROP TABLE IF EXISTS `matricula_carga_academica`;

CREATE TABLE `matricula_carga_academica` (
  `Mca_IdMatriculaCargaAcademica` int(11) NOT NULL AUTO_INCREMENT,
  `Caa_IdCargaAcademica` int(11) DEFAULT NULL,
  `Mat_IdMatricula` int(11) DEFAULT NULL,
  PRIMARY KEY (`Mca_IdMatriculaCargaAcademica`),
  KEY `FK_matricula_carga_academica_carga` (`Caa_IdCargaAcademica`),
  KEY `FK_matricula_carga_academica` (`Mat_IdMatricula`),
  CONSTRAINT `FK_matricula_carga_academica` FOREIGN KEY (`Mat_IdMatricula`) REFERENCES `matricula` (`Mat_IdMatricula`),
  CONSTRAINT `FK_matricula_carga_academica_carga` FOREIGN KEY (`Caa_IdCargaAcademica`) REFERENCES `carga_academica` (`Caa_IdCargaAcademica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `matricula_carga_academica` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
