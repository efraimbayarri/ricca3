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
-- Table structure for table `ricca3_historial`
--

DROP TABLE IF EXISTS `ricca3_historial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ricca3_historial` (
  `idhistorial` int(11) NOT NULL AUTO_INCREMENT,
  `idalumne` int(11) NOT NULL,
  `idespecialitat` int(11) NOT NULL DEFAULT '0',
  `codi_c` varchar(225) COLLATE utf8_unicode_ci DEFAULT '08035672',
  `nom_c` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grau_c` varchar(225) COLLATE utf8_unicode_ci DEFAULT 'Superior',
  `titol` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prova` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `condic` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cicle_codi` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cicle_nom` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cicle_any_de` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cicle_any_a` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cicle_curs` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modul` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_hores` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_qual` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_conv` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf_hores` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf_qual` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf_conv` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qual_final` double DEFAULT '0',
  `obs` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idhistorial`),
  KEY `idalumne` (`idalumne`),
  KEY `fk_ricca3_historial_1` (`idalumne`),
  CONSTRAINT `fk_ricca3_historial_1` FOREIGN KEY (`idalumne`) REFERENCES `ricca3_alumne` (`idalumne`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
