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
-- Table structure for table `ricca3_alumne`
--

DROP TABLE IF EXISTS `ricca3_alumne`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ricca3_alumne` (
  `idalumne` int(11) NOT NULL AUTO_INCREMENT,
  `cognom1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cognom2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idestat_al` int(11) NOT NULL,
  `datanai` date NOT NULL,
  `llocnai` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Barcelona',
  `provnai` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `paisnai` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `dni` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `residenciacurs` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `ciutatcurs` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `codpostalcurs` varchar(5) COLLATE utf8_unicode_ci DEFAULT '',
  `telefoncontactecurs1` varchar(30) COLLATE utf8_unicode_ci DEFAULT '',
  `telefoncontactecurs2` varchar(30) COLLATE utf8_unicode_ci DEFAULT '',
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `residenciahabitual` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `ciutathabitual` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Barcelona',
  `provinciahabitual` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `codipostal` varchar(5) COLLATE utf8_unicode_ci DEFAULT '',
  `telefon` varchar(30) COLLATE utf8_unicode_ci DEFAULT '',
  `estudisrealitzats` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `datainscripcio` date NOT NULL DEFAULT '0000-00-00',
  `telefonfixe` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `estudisanteriors` varchar(255) COLLATE utf8_unicode_ci DEFAULT '' COMMENT 'ESTUDIOSANTERIORES',
  `centreea` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `poblacioea` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `abonament` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `tipusdni` varchar(30) COLLATE utf8_unicode_ci DEFAULT '',
  `llenguafamiliar` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `professio` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `idhistorial` tinytext COLLATE utf8_unicode_ci,
  `nacionalitat` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `attachment_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT '',
  `cognomsinom` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `nomicognoms` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`idalumne`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  KEY `cognom1` (`cognom1`),
  KEY `cognom2` (`cognom2`),
  KEY `nom` (`nom`),
  KEY `dni` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=2910 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-14 22:20:36
