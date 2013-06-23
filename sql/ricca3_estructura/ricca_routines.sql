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
-- Temporary table structure for view `ricca3_ccomp_view`
--

DROP TABLE IF EXISTS `ricca3_ccomp_view`;
/*!50001 DROP VIEW IF EXISTS `ricca3_ccomp_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `ricca3_ccomp_view` (
  `idccomp` tinyint NOT NULL,
  `idcredit` tinyint NOT NULL,
  `idgrup` tinyint NOT NULL,
  `grup` tinyint NOT NULL,
  `hores_cc` tinyint NOT NULL,
  `hores_cr` tinyint NOT NULL,
  `idprofessor` tinyint NOT NULL,
  `nomicognoms` tinyint NOT NULL,
  `idtutor` tinyint NOT NULL,
  `nomicognomstut` tinyint NOT NULL,
  `actiu_cc` tinyint NOT NULL,
  `actiu_cr` tinyint NOT NULL,
  `actiu_gr` tinyint NOT NULL,
  `actiu_es` tinyint NOT NULL,
  `nomccomp` tinyint NOT NULL,
  `nomcredit` tinyint NOT NULL,
  `ordre_cr` tinyint NOT NULL,
  `idespecialitat` tinyint NOT NULL,
  `nomespecialitat` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `ricca3_convord`
--

DROP TABLE IF EXISTS `ricca3_convord`;
/*!50001 DROP VIEW IF EXISTS `ricca3_convord`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `ricca3_convord` (
  `idany` tinyint NOT NULL,
  `any` tinyint NOT NULL,
  `actual` tinyint NOT NULL,
  `insc` tinyint NOT NULL,
  `conv` tinyint NOT NULL,
  `ts` tinyint NOT NULL,
  `stampuser` tinyint NOT NULL,
  `stampplace` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `ricca3_alumespec_view`
--

DROP TABLE IF EXISTS `ricca3_alumespec_view`;
/*!50001 DROP VIEW IF EXISTS `ricca3_alumespec_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `ricca3_alumespec_view` (
  `idalumespec` tinyint NOT NULL,
  `idalumne` tinyint NOT NULL,
  `cognomsinom` tinyint NOT NULL,
  `telefon` tinyint NOT NULL,
  `telefonfixe` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `idgrup` tinyint NOT NULL,
  `grup` tinyint NOT NULL,
  `sessio` tinyint NOT NULL,
  `idcurs` tinyint NOT NULL,
  `curs` tinyint NOT NULL,
  `nomespecialitat` tinyint NOT NULL,
  `idespecialitat` tinyint NOT NULL,
  `idany` tinyint NOT NULL,
  `any` tinyint NOT NULL,
  `idestat_es` tinyint NOT NULL,
  `estat` tinyint NOT NULL,
  `idhistorial` tinyint NOT NULL,
  `notaf_es` tinyint NOT NULL,
  `repeteix` tinyint NOT NULL,
  `observ1` tinyint NOT NULL,
  `observ2` tinyint NOT NULL,
  `observ3` tinyint NOT NULL,
  `motiubaixa` tinyint NOT NULL,
  `databaixa` tinyint NOT NULL,
  `abonament` tinyint NOT NULL,
  `datainscripcio` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `ricca3_convext2`
--

DROP TABLE IF EXISTS `ricca3_convext2`;
/*!50001 DROP VIEW IF EXISTS `ricca3_convext2`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `ricca3_convext2` (
  `idany` tinyint NOT NULL,
  `any` tinyint NOT NULL,
  `actual` tinyint NOT NULL,
  `insc` tinyint NOT NULL,
  `conv` tinyint NOT NULL,
  `ts` tinyint NOT NULL,
  `stampuser` tinyint NOT NULL,
  `stampplace` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `ricca3_convext1`
--

DROP TABLE IF EXISTS `ricca3_convext1`;
/*!50001 DROP VIEW IF EXISTS `ricca3_convext1`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `ricca3_convext1` (
  `idany` tinyint NOT NULL,
  `any` tinyint NOT NULL,
  `actual` tinyint NOT NULL,
  `insc` tinyint NOT NULL,
  `conv` tinyint NOT NULL,
  `ts` tinyint NOT NULL,
  `stampuser` tinyint NOT NULL,
  `stampplace` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `ricca3_pla_view`
--

DROP TABLE IF EXISTS `ricca3_pla_view`;
/*!50001 DROP VIEW IF EXISTS `ricca3_pla_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `ricca3_pla_view` (
  `idpla` tinyint NOT NULL,
  `idany` tinyint NOT NULL,
  `any` tinyint NOT NULL,
  `idccomp` tinyint NOT NULL,
  `nomccomp` tinyint NOT NULL,
  `idcredit` tinyint NOT NULL,
  `nomcredit` tinyint NOT NULL,
  `aval3nomes` tinyint NOT NULL,
  `ordre_cr` tinyint NOT NULL,
  `hores_cr` tinyint NOT NULL,
  `idgrup` tinyint NOT NULL,
  `hores_cc` tinyint NOT NULL,
  `grup` tinyint NOT NULL,
  `idcurs` tinyint NOT NULL,
  `curs` tinyint NOT NULL,
  `idespecialitat` tinyint NOT NULL,
  `nomespecialitat` tinyint NOT NULL,
  `idprofessor` tinyint NOT NULL,
  `nomicognoms` tinyint NOT NULL,
  `idtutor` tinyint NOT NULL,
  `nomicognomstut` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `ricca3_alumccomprepe_view`
--

DROP TABLE IF EXISTS `ricca3_alumccomprepe_view`;
/*!50001 DROP VIEW IF EXISTS `ricca3_alumccomprepe_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `ricca3_alumccomprepe_view` (
  `idcredaval` tinyint NOT NULL,
  `idany` tinyint NOT NULL,
  `any` tinyint NOT NULL,
  `cognomsinom` tinyint NOT NULL,
  `idalumne` tinyint NOT NULL,
  `idccomp` tinyint NOT NULL,
  `nomccomp` tinyint NOT NULL,
  `idcredit` tinyint NOT NULL,
  `nomcredit` tinyint NOT NULL,
  `aval3nomes` tinyint NOT NULL,
  `idespecialitat` tinyint NOT NULL,
  `nomespecialitat` tinyint NOT NULL,
  `idcurs` tinyint NOT NULL,
  `ordre_cr` tinyint NOT NULL,
  `idgrup` tinyint NOT NULL,
  `grup` tinyint NOT NULL,
  `idprofessor` tinyint NOT NULL,
  `nomicognoms` tinyint NOT NULL,
  `idtutor` tinyint NOT NULL,
  `nomicognomstut` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `ricca3_tutors`
--

DROP TABLE IF EXISTS `ricca3_tutors`;
/*!50001 DROP VIEW IF EXISTS `ricca3_tutors`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `ricca3_tutors` (
  `idprof` tinyint NOT NULL,
  `idtutor` tinyint NOT NULL,
  `nomicognomstut` tinyint NOT NULL,
  `telcasa` tinyint NOT NULL,
  `telcont1` tinyint NOT NULL,
  `telcont2` tinyint NOT NULL,
  `telcont3` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `ts` tinyint NOT NULL,
  `stampuser` tinyint NOT NULL,
  `stampplace` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `ricca3_alumcredit_view`
--

DROP TABLE IF EXISTS `ricca3_alumcredit_view`;
/*!50001 DROP VIEW IF EXISTS `ricca3_alumcredit_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `ricca3_alumcredit_view` (
  `idcredaval` tinyint NOT NULL,
  `idany` tinyint NOT NULL,
  `any` tinyint NOT NULL,
  `idccomp` tinyint NOT NULL,
  `nomccomp` tinyint NOT NULL,
  `idcredit` tinyint NOT NULL,
  `idespecialitat` tinyint NOT NULL,
  `nomespecialitat` tinyint NOT NULL,
  `idcurs` tinyint NOT NULL,
  `curs` tinyint NOT NULL,
  `idgrup` tinyint NOT NULL,
  `grup` tinyint NOT NULL,
  `idprofessor` tinyint NOT NULL,
  `nomicognoms` tinyint NOT NULL,
  `idtutor` tinyint NOT NULL,
  `nomicognomstut` tinyint NOT NULL,
  `hores_cc` tinyint NOT NULL,
  `hores_cr` tinyint NOT NULL,
  `actiu_cc` tinyint NOT NULL,
  `actiu_cr` tinyint NOT NULL,
  `ordre_cr` tinyint NOT NULL,
  `nomcredit` tinyint NOT NULL,
  `idalumne` tinyint NOT NULL,
  `cognomsinom` tinyint NOT NULL,
  `nota1` tinyint NOT NULL,
  `act1` tinyint NOT NULL,
  `nota2` tinyint NOT NULL,
  `act2` tinyint NOT NULL,
  `nota3` tinyint NOT NULL,
  `actf` tinyint NOT NULL,
  `recup` tinyint NOT NULL,
  `notaf_cc` tinyint NOT NULL,
  `notaf_cr` tinyint NOT NULL,
  `notaf_es` tinyint NOT NULL,
  `idestat_es` tinyint NOT NULL,
  `pendi` tinyint NOT NULL,
  `repe` tinyint NOT NULL,
  `convord` tinyint NOT NULL,
  `convtext1` tinyint NOT NULL,
  `convext1` tinyint NOT NULL,
  `convtext2` tinyint NOT NULL,
  `convext2` tinyint NOT NULL,
  `convtext3` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `ricca3_ccomp_view`
--

/*!50001 DROP TABLE IF EXISTS `ricca3_ccomp_view`*/;
/*!50001 DROP VIEW IF EXISTS `ricca3_ccomp_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ricca3_ccomp_view` AS select `ricca3_ccomp`.`idccomp` AS `idccomp`,`ricca3_ccomp`.`idcredit` AS `idcredit`,`ricca3_ccomp`.`idgrup` AS `idgrup`,`ricca3_grups`.`grup` AS `grup`,`ricca3_ccomp`.`hores_cc` AS `hores_cc`,`ricca3_credits`.`hores_cr` AS `hores_cr`,`ricca3_ccomp`.`idprofessor` AS `idprofessor`,`ricca3_professors`.`nomicognoms` AS `nomicognoms`,`ricca3_ccomp`.`idtutor` AS `idtutor`,`ricca3_tutors`.`nomicognomstut` AS `nomicognomstut`,`ricca3_ccomp`.`actiu_cc` AS `actiu_cc`,`ricca3_credits`.`actiu_cr` AS `actiu_cr`,`ricca3_grups`.`actiu_gr` AS `actiu_gr`,`ricca3_especialitats`.`actiu_es` AS `actiu_es`,`ricca3_ccomp`.`nomccomp` AS `nomccomp`,`ricca3_credits`.`nomcredit` AS `nomcredit`,`ricca3_credits`.`ordre_cr` AS `ordre_cr`,`ricca3_credits`.`idespecialitat` AS `idespecialitat`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat` from (((((`ricca3_ccomp` join `ricca3_credits` on((`ricca3_credits`.`idcredit` = `ricca3_ccomp`.`idcredit`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_ccomp`.`idgrup`))) join `ricca3_professors` on((`ricca3_professors`.`idprof` = `ricca3_ccomp`.`idprofessor`))) join `ricca3_tutors` on((`ricca3_tutors`.`idprof` = `ricca3_ccomp`.`idtutor`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_credits`.`idespecialitat`))) order by `ricca3_credits`.`ordre_cr`,`ricca3_ccomp`.`idprofessor` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ricca3_convord`
--

/*!50001 DROP TABLE IF EXISTS `ricca3_convord`*/;
/*!50001 DROP VIEW IF EXISTS `ricca3_convord`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ricca3_convord` AS select `ricca3_any`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_any`.`actual` AS `actual`,`ricca3_any`.`insc` AS `insc`,`ricca3_any`.`conv` AS `conv`,`ricca3_any`.`ts` AS `ts`,`ricca3_any`.`stampuser` AS `stampuser`,`ricca3_any`.`stampplace` AS `stampplace` from `ricca3_any` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ricca3_alumespec_view`
--

/*!50001 DROP TABLE IF EXISTS `ricca3_alumespec_view`*/;
/*!50001 DROP VIEW IF EXISTS `ricca3_alumespec_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ricca3_alumespec_view` AS select `ricca3_alumne_especialitat`.`idalumespec` AS `idalumespec`,`ricca3_alumne_especialitat`.`idalumne` AS `idalumne`,`ricca3_alumne`.`cognomsinom` AS `cognomsinom`,`ricca3_alumne`.`telefon` AS `telefon`,`ricca3_alumne`.`telefonfixe` AS `telefonfixe`,`ricca3_alumne`.`email` AS `email`,`ricca3_alumne_especialitat`.`idgrup` AS `idgrup`,`ricca3_grups`.`grup` AS `grup`,`ricca3_grups`.`sessio` AS `sessio`,`ricca3_grups`.`idcurs` AS `idcurs`,`ricca3_cursos`.`curs` AS `curs`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat`,`ricca3_especialitats`.`idespecialitat` AS `idespecialitat`,`ricca3_alumne_especialitat`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_alumne_especialitat`.`idestat_es` AS `idestat_es`,`ricca3_estat`.`estat` AS `estat`,`ricca3_alumne`.`idhistorial` AS `idhistorial`,`ricca3_alumne_especialitat`.`notaf_es` AS `notaf_es`,`ricca3_alumne_especialitat`.`repeteix` AS `repeteix`,`ricca3_alumne_especialitat`.`observ1` AS `observ1`,`ricca3_alumne_especialitat`.`observ2` AS `observ2`,`ricca3_alumne_especialitat`.`observ3` AS `observ3`,`ricca3_alumne_especialitat`.`motiubaixa` AS `motiubaixa`,`ricca3_alumne_especialitat`.`databaixa` AS `databaixa`,`ricca3_alumne_especialitat`.`abonament` AS `abonament`,`ricca3_alumne_especialitat`.`datainscripcio` AS `datainscripcio` from ((((((`ricca3_alumne_especialitat` join `ricca3_alumne` on((`ricca3_alumne`.`idalumne` = `ricca3_alumne_especialitat`.`idalumne`))) join `ricca3_any` on((`ricca3_any`.`idany` = `ricca3_alumne_especialitat`.`idany`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_alumne_especialitat`.`idgrup`))) join `ricca3_cursos` on((`ricca3_cursos`.`idcurs` = `ricca3_grups`.`idcurs`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_grups`.`idespecialitat`))) join `ricca3_estat` on((`ricca3_estat`.`idestat` = `ricca3_alumne_especialitat`.`idestat_es`))) order by `ricca3_alumne`.`cognomsinom` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ricca3_convext2`
--

/*!50001 DROP TABLE IF EXISTS `ricca3_convext2`*/;
/*!50001 DROP VIEW IF EXISTS `ricca3_convext2`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ricca3_convext2` AS select `ricca3_any`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_any`.`actual` AS `actual`,`ricca3_any`.`insc` AS `insc`,`ricca3_any`.`conv` AS `conv`,`ricca3_any`.`ts` AS `ts`,`ricca3_any`.`stampuser` AS `stampuser`,`ricca3_any`.`stampplace` AS `stampplace` from `ricca3_any` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ricca3_convext1`
--

/*!50001 DROP TABLE IF EXISTS `ricca3_convext1`*/;
/*!50001 DROP VIEW IF EXISTS `ricca3_convext1`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ricca3_convext1` AS select `ricca3_any`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_any`.`actual` AS `actual`,`ricca3_any`.`insc` AS `insc`,`ricca3_any`.`conv` AS `conv`,`ricca3_any`.`ts` AS `ts`,`ricca3_any`.`stampuser` AS `stampuser`,`ricca3_any`.`stampplace` AS `stampplace` from `ricca3_any` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ricca3_pla_view`
--

/*!50001 DROP TABLE IF EXISTS `ricca3_pla_view`*/;
/*!50001 DROP VIEW IF EXISTS `ricca3_pla_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ricca3_pla_view` AS select `ricca3_pla`.`idpla` AS `idpla`,`ricca3_pla`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_pla`.`idccomp` AS `idccomp`,`ricca3_ccomp`.`nomccomp` AS `nomccomp`,`ricca3_ccomp`.`idcredit` AS `idcredit`,`ricca3_credits`.`nomcredit` AS `nomcredit`,`ricca3_credits`.`aval3nomes` AS `aval3nomes`,`ricca3_credits`.`ordre_cr` AS `ordre_cr`,`ricca3_credits`.`hores_cr` AS `hores_cr`,`ricca3_ccomp`.`idgrup` AS `idgrup`,`ricca3_ccomp`.`hores_cc` AS `hores_cc`,`ricca3_grups`.`grup` AS `grup`,`ricca3_grups`.`idcurs` AS `idcurs`,`ricca3_cursos`.`curs` AS `curs`,`ricca3_especialitats`.`idespecialitat` AS `idespecialitat`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat`,`ricca3_ccomp`.`idprofessor` AS `idprofessor`,`ricca3_professors`.`nomicognoms` AS `nomicognoms`,`ricca3_ccomp`.`idtutor` AS `idtutor`,`ricca3_tutors`.`nomicognomstut` AS `nomicognomstut` from ((((((((`ricca3_pla` join `ricca3_ccomp` on((`ricca3_ccomp`.`idccomp` = `ricca3_pla`.`idccomp`))) join `ricca3_any` on((`ricca3_any`.`idany` = `ricca3_pla`.`idany`))) join `ricca3_credits` on((`ricca3_credits`.`idcredit` = `ricca3_ccomp`.`idcredit`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_ccomp`.`idgrup`))) join `ricca3_professors` on((`ricca3_professors`.`idprof` = `ricca3_ccomp`.`idprofessor`))) join `ricca3_tutors` on((`ricca3_tutors`.`idprof` = `ricca3_ccomp`.`idtutor`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_grups`.`idespecialitat`))) join `ricca3_cursos` on((`ricca3_cursos`.`idcurs` = `ricca3_grups`.`idcurs`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ricca3_alumccomprepe_view`
--

/*!50001 DROP TABLE IF EXISTS `ricca3_alumccomprepe_view`*/;
/*!50001 DROP VIEW IF EXISTS `ricca3_alumccomprepe_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ricca3_alumccomprepe_view` AS select distinct `ricca3_credits_avaluacions`.`idcredaval` AS `idcredaval`,`ricca3_credits_avaluacions`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_alumne`.`cognomsinom` AS `cognomsinom`,`ricca3_alumne`.`idalumne` AS `idalumne`,`ricca3_credits_avaluacions`.`idccomp` AS `idccomp`,`ricca3_ccomp`.`nomccomp` AS `nomccomp`,`ricca3_ccomp`.`idcredit` AS `idcredit`,`ricca3_credits`.`nomcredit` AS `nomcredit`,`ricca3_credits`.`aval3nomes` AS `aval3nomes`,`ricca3_credits`.`idespecialitat` AS `idespecialitat`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat`,`ricca3_credits`.`idcurs` AS `idcurs`,`ricca3_credits`.`ordre_cr` AS `ordre_cr`,`ricca3_ccomp`.`idgrup` AS `idgrup`,`ricca3_grups`.`grup` AS `grup`,`ricca3_ccomp`.`idprofessor` AS `idprofessor`,`ricca3_professors`.`nomicognoms` AS `nomicognoms`,`ricca3_ccomp`.`idtutor` AS `idtutor`,`ricca3_tutors`.`nomicognomstut` AS `nomicognomstut` from ((((((((`ricca3_credits_avaluacions` join `ricca3_alumne` on((`ricca3_alumne`.`idalumne` = `ricca3_credits_avaluacions`.`idalumne`))) join `ricca3_ccomp` on((`ricca3_ccomp`.`idccomp` = `ricca3_credits_avaluacions`.`idccomp`))) join `ricca3_credits` on((`ricca3_credits`.`idcredit` = `ricca3_ccomp`.`idcredit`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_ccomp`.`idgrup`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_credits`.`idespecialitat`))) join `ricca3_professors` on((`ricca3_professors`.`idprof` = `ricca3_ccomp`.`idprofessor`))) join `ricca3_tutors` on((`ricca3_tutors`.`idtutor` = `ricca3_ccomp`.`idtutor`))) join `ricca3_any` on((`ricca3_any`.`idany` = `ricca3_credits_avaluacions`.`idany`))) where (`ricca3_credits_avaluacions`.`repe` = 'R') order by `ricca3_alumne`.`cognomsinom` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ricca3_tutors`
--

/*!50001 DROP TABLE IF EXISTS `ricca3_tutors`*/;
/*!50001 DROP VIEW IF EXISTS `ricca3_tutors`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ricca3_tutors` AS select `ricca3_professors`.`idprof` AS `idprof`,`ricca3_professors`.`idtutor` AS `idtutor`,`ricca3_professors`.`nomicognoms` AS `nomicognomstut`,`ricca3_professors`.`telcasa` AS `telcasa`,`ricca3_professors`.`telcont1` AS `telcont1`,`ricca3_professors`.`telcont2` AS `telcont2`,`ricca3_professors`.`telcont3` AS `telcont3`,`ricca3_professors`.`email` AS `email`,`ricca3_professors`.`ts` AS `ts`,`ricca3_professors`.`stampuser` AS `stampuser`,`ricca3_professors`.`stampplace` AS `stampplace` from `ricca3_professors` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ricca3_alumcredit_view`
--

/*!50001 DROP TABLE IF EXISTS `ricca3_alumcredit_view`*/;
/*!50001 DROP VIEW IF EXISTS `ricca3_alumcredit_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ricca3_alumcredit_view` AS select `ricca3_credits_avaluacions`.`idcredaval` AS `idcredaval`,`ricca3_credits_avaluacions`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_credits_avaluacions`.`idccomp` AS `idccomp`,`ricca3_ccomp`.`nomccomp` AS `nomccomp`,`ricca3_ccomp`.`idcredit` AS `idcredit`,`ricca3_credits`.`idespecialitat` AS `idespecialitat`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat`,`ricca3_credits`.`idcurs` AS `idcurs`,`ricca3_cursos`.`curs` AS `curs`,`ricca3_ccomp`.`idgrup` AS `idgrup`,`ricca3_grups`.`grup` AS `grup`,`ricca3_ccomp`.`idprofessor` AS `idprofessor`,`ricca3_professors`.`nomicognoms` AS `nomicognoms`,`ricca3_ccomp`.`idtutor` AS `idtutor`,`ricca3_tutors`.`nomicognomstut` AS `nomicognomstut`,`ricca3_ccomp`.`hores_cc` AS `hores_cc`,`ricca3_credits`.`hores_cr` AS `hores_cr`,`ricca3_ccomp`.`actiu_cc` AS `actiu_cc`,`ricca3_credits`.`actiu_cr` AS `actiu_cr`,`ricca3_credits`.`ordre_cr` AS `ordre_cr`,`ricca3_credits`.`nomcredit` AS `nomcredit`,`ricca3_credits_avaluacions`.`idalumne` AS `idalumne`,`ricca3_alumne`.`cognomsinom` AS `cognomsinom`,`ricca3_credits_avaluacions`.`nota1` AS `nota1`,`ricca3_credits_avaluacions`.`act1` AS `act1`,`ricca3_credits_avaluacions`.`nota2` AS `nota2`,`ricca3_credits_avaluacions`.`act2` AS `act2`,`ricca3_credits_avaluacions`.`nota3` AS `nota3`,`ricca3_credits_avaluacions`.`actf` AS `actf`,`ricca3_credits_avaluacions`.`recup` AS `recup`,`ricca3_credits_avaluacions`.`notaf_cc` AS `notaf_cc`,`ricca3_credits_avaluacions`.`notaf_cr` AS `notaf_cr`,`ricca3_alumne_especialitat`.`notaf_es` AS `notaf_es`,`ricca3_alumne_especialitat`.`idestat_es` AS `idestat_es`,`ricca3_credits_avaluacions`.`pendi` AS `pendi`,`ricca3_credits_avaluacions`.`repe` AS `repe`,`ricca3_credits_avaluacions`.`convord` AS `convord`,`ricca3_convord`.`conv` AS `convtext1`,`ricca3_credits_avaluacions`.`convext1` AS `convext1`,`ricca3_convext1`.`conv` AS `convtext2`,`ricca3_credits_avaluacions`.`convext2` AS `convext2`,`ricca3_convext2`.`conv` AS `convtext3` from (((((((((((((`ricca3_credits_avaluacions` join `ricca3_any` on((`ricca3_any`.`idany` = `ricca3_credits_avaluacions`.`idany`))) join `ricca3_ccomp` on((`ricca3_ccomp`.`idccomp` = `ricca3_credits_avaluacions`.`idccomp`))) join `ricca3_credits` on((`ricca3_credits`.`idcredit` = `ricca3_ccomp`.`idcredit`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_ccomp`.`idgrup`))) join `ricca3_professors` on((`ricca3_professors`.`idprof` = `ricca3_ccomp`.`idprofessor`))) join `ricca3_tutors` on((`ricca3_tutors`.`idprof` = `ricca3_ccomp`.`idtutor`))) join `ricca3_alumne` on((`ricca3_alumne`.`idalumne` = `ricca3_credits_avaluacions`.`idalumne`))) join `ricca3_convord` on((`ricca3_convord`.`idany` = `ricca3_credits_avaluacions`.`convord`))) join `ricca3_convext1` on((`ricca3_convext1`.`idany` = `ricca3_credits_avaluacions`.`convext1`))) join `ricca3_convext2` on((`ricca3_convext2`.`idany` = `ricca3_credits_avaluacions`.`convext2`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_credits`.`idespecialitat`))) join `ricca3_cursos` on((`ricca3_cursos`.`idcurs` = `ricca3_credits`.`idcurs`))) join `ricca3_alumne_especialitat` on(((`ricca3_alumne_especialitat`.`idalumne` = `ricca3_alumne`.`idalumne`) and (`ricca3_alumne_especialitat`.`idgrup` = `ricca3_grups`.`idgrup`)))) order by `ricca3_grups`.`ordre_gr` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-23 18:29:53
