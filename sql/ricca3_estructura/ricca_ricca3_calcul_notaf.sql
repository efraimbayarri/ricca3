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
-- Table structure for table `ricca3_calcul_notaf`
--

DROP TABLE IF EXISTS `ricca3_calcul_notaf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ricca3_calcul_notaf` (
  `idcalcul` int(11) NOT NULL AUTO_INCREMENT,
  `idalumne` int(11) NOT NULL,
  `idespecialitat` int(11) NOT NULL,
  `doublenotaf` double NOT NULL DEFAULT '0',
  `nomcredit` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `notaf` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `hores` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `punts` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idcalcul`),
  KEY `idalumne` (`idalumne`),
  KEY `idespecialitat` (`idespecialitat`),
  CONSTRAINT `ricca3_calcul_notaf_ibfk_1` FOREIGN KEY (`idespecialitat`) REFERENCES `ricca3_especialitats` (`idespecialitat`),
  CONSTRAINT `ricca3_calcul_notaf_ibfk_2` FOREIGN KEY (`idalumne`) REFERENCES `ricca3_alumne` (`idalumne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
