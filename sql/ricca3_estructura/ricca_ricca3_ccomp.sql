CREATE DATABASE  IF NOT EXISTS `ricca` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ricca`;
-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: ricca
-- ------------------------------------------------------
-- Server version	5.5.31-0ubuntu0.12.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ricca3_ccomp`
--

DROP TABLE IF EXISTS `ricca3_ccomp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ricca3_ccomp` (
  `idccomp` int(11) NOT NULL AUTO_INCREMENT,
  `idcredit` int(11) NOT NULL,
  `idgrup` int(11) NOT NULL,
  `idprofessor` int(11) NOT NULL,
  `idtutor` int(11) NOT NULL,
  `hores_cc` int(11) NOT NULL,
  `actiu_cc` tinyint(1) NOT NULL DEFAULT '0',
  `nomccomp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idccomp`),
  KEY `idcredit` (`idcredit`),
  KEY `idgrup` (`idgrup`),
  KEY `idprofessor` (`idprofessor`),
  KEY `idtutor` (`idtutor`) USING BTREE,
  CONSTRAINT `ricca3_ccomp_ibfk_1` FOREIGN KEY (`idcredit`) REFERENCES `ricca3_credits` (`idcredit`),
  CONSTRAINT `ricca3_ccomp_ibfk_2` FOREIGN KEY (`idgrup`) REFERENCES `ricca3_grups` (`idgrup`),
  CONSTRAINT `ricca3_ccomp_ibfk_3` FOREIGN KEY (`idprofessor`) REFERENCES `ricca3_professors` (`idprof`),
  CONSTRAINT `ricca3_ccomp_ibfk_4` FOREIGN KEY (`idtutor`) REFERENCES `ricca3_professors` (`idtutor`)
) ENGINE=InnoDB AUTO_INCREMENT=365 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-05-24 13:37:25
