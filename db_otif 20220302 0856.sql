-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.43-community-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema db_otif
--

CREATE DATABASE IF NOT EXISTS db_otif;
USE db_otif;

--
-- Definition of table `mastersetting`
--

DROP TABLE IF EXISTS `mastersetting`;
CREATE TABLE `mastersetting` (
  `idsetting` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(45) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsetting`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mastersetting`
--

/*!40000 ALTER TABLE `mastersetting` DISABLE KEYS */;
INSERT INTO `mastersetting` (`idsetting`,`value`,`keterangan`) VALUES 
 (2,'coba','12345');
/*!40000 ALTER TABLE `mastersetting` ENABLE KEYS */;


--
-- Definition of table `masteruser`
--

DROP TABLE IF EXISTS `masteruser`;
CREATE TABLE `masteruser` (
  `iduser` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `jabatan` varchar(45) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masteruser`
--

/*!40000 ALTER TABLE `masteruser` DISABLE KEYS */;
INSERT INTO `masteruser` (`iduser`,`fullname`,`username`,`password`,`jabatan`,`level`) VALUES 
 (5,'ERWIN GUNAWAN','egunawan','Gun-123','Chief / Head','User'),
 (8,'WILDAN A NASRULLAH','wnasrullah','','Chief / Head','Superadmin'),
 (9,'ADMINISTRATOR','admin','S3mangat!','Staff','Superadmin');
/*!40000 ALTER TABLE `masteruser` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
