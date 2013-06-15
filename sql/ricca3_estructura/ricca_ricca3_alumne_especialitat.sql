CREATE DATABASE  IF NOT EXISTS `ricca` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ricca`;
-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ricca
-- ------------------------------------------------------
-- Server version	5.5.31-0ubuntu0.13.04.1

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
-- Table structure for table `ricca3_alumne_especialitat`
--

DROP TABLE IF EXISTS `ricca3_alumne_especialitat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ricca3_alumne_especialitat` (
  `idalumespec` int(11) NOT NULL AUTO_INCREMENT,
  `idalumne` int(11) NOT NULL,
  `idgrup` int(11) NOT NULL,
  `idany` int(11) NOT NULL,
  `idestat_es` int(11) NOT NULL,
  `motiubaixa` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `databaixa` datetime DEFAULT NULL,
  `notaf_es` double DEFAULT '0',
  `repeteix` varchar(1) COLLATE utf8_unicode_ci DEFAULT '',
  `observ1` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `observ2` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `observ3` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `datainscripcio` date NOT NULL DEFAULT '0000-00-00',
  `abonament` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`idalumespec`),
  KEY `idgrup` (`idgrup`),
  KEY `idalumne` (`idalumne`),
  KEY `idestat` (`idestat_es`),
  KEY `idany` (`idany`),
  CONSTRAINT `ricca3_alumne_especialitat_ibfk_2` FOREIGN KEY (`idgrup`) REFERENCES `ricca3_grups` (`idgrup`),
  CONSTRAINT `ricca3_alumne_especialitat_ibfk_3` FOREIGN KEY (`idestat_es`) REFERENCES `ricca3_estat` (`idestat`),
  CONSTRAINT `ricca3_alumne_especialitat_ibfk_4` FOREIGN KEY (`idalumne`) REFERENCES `ricca3_alumne` (`idalumne`),
  CONSTRAINT `ricca3_alumne_especialitat_ibfk_5` FOREIGN KEY (`idany`) REFERENCES `ricca3_any` (`idany`)
) ENGINE=InnoDB AUTO_INCREMENT=1362 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-15 19:57:31
