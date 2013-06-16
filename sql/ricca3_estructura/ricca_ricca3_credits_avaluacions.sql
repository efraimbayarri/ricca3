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
-- Table structure for table `ricca3_credits_avaluacions`
--

DROP TABLE IF EXISTS `ricca3_credits_avaluacions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ricca3_credits_avaluacions` (
  `idcredaval` int(11) NOT NULL AUTO_INCREMENT,
  `idany` int(11) NOT NULL,
  `idccomp` int(11) NOT NULL,
  `idalumne` int(11) NOT NULL,
  `idestat_cr` int(11) NOT NULL DEFAULT '0',
  `nota1` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `nota2` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `nota3` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `recup` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `notaf_cc` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `notaf_cr` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `act1` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `act2` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `actf` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `pendi` varchar(5) COLLATE utf8_unicode_ci DEFAULT '',
  `repe` varchar(5) COLLATE utf8_unicode_ci DEFAULT '',
  `convord` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `convext1` varchar(10) COLLATE utf8_unicode_ci DEFAULT '0',
  `convext2` varchar(10) COLLATE utf8_unicode_ci DEFAULT '0',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idcredaval`),
  KEY `idany` (`idany`),
  KEY `idccomp` (`idccomp`),
  KEY `idalumne` (`idalumne`),
  KEY `pendi` (`pendi`),
  KEY `repe` (`repe`),
  CONSTRAINT `ricca3_credits_avaluacions_ibfk_1` FOREIGN KEY (`idany`) REFERENCES `ricca3_any` (`idany`),
  CONSTRAINT `ricca3_credits_avaluacions_ibfk_2` FOREIGN KEY (`idccomp`) REFERENCES `ricca3_ccomp` (`idccomp`),
  CONSTRAINT `ricca3_credits_avaluacions_ibfk_3` FOREIGN KEY (`idalumne`) REFERENCES `ricca3_alumne` (`idalumne`)
) ENGINE=InnoDB AUTO_INCREMENT=10350 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-16 19:33:09
