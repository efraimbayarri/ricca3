-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2013 at 01:43 PM
-- Server version: 5.5.31
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ricca`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `ricca3_alumccomprepe_view`
--
CREATE TABLE IF NOT EXISTS `ricca3_alumccomprepe_view` (
`idcredaval` int(11)
,`idany` int(11)
,`any` varchar(50)
,`cognomsinom` varchar(100)
,`idalumne` int(11)
,`idccomp` int(11)
,`nomccomp` varchar(255)
,`idcredit` int(11)
,`nomcredit` varchar(100)
,`aval3nomes` tinyint(1)
,`idespecialitat` int(11)
,`nomespecialitat` varchar(100)
,`idcurs` int(11)
,`ordre_cr` tinyint(4)
,`idgrup` int(11)
,`grup` varchar(45)
,`idprofessor` int(11)
,`nomicognoms` varchar(45)
,`idtutor` int(11)
,`nomicognomstut` varchar(45)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ricca3_alumcredit_view`
--
CREATE TABLE IF NOT EXISTS `ricca3_alumcredit_view` (
`idcredaval` int(11)
,`idany` int(11)
,`any` varchar(50)
,`idccomp` int(11)
,`nomccomp` varchar(255)
,`idcredit` int(11)
,`idespecialitat` int(11)
,`nomespecialitat` varchar(100)
,`idcurs` int(11)
,`curs` varchar(15)
,`idgrup` int(11)
,`grup` varchar(45)
,`idprofessor` int(11)
,`nomicognoms` varchar(45)
,`idtutor` int(11)
,`nomicognomstut` varchar(45)
,`hores_cc` int(11)
,`hores_cr` int(11)
,`actiu_cc` tinyint(1)
,`actiu_cr` tinyint(1)
,`ordre_cr` tinyint(4)
,`nomcredit` varchar(100)
,`idalumne` int(11)
,`cognomsinom` varchar(100)
,`nota1` varchar(10)
,`act1` varchar(10)
,`nota2` varchar(10)
,`act2` varchar(10)
,`nota3` varchar(10)
,`actf` varchar(10)
,`recup` varchar(10)
,`notaf_cc` varchar(50)
,`notaf_cr` varchar(50)
,`notaf_es` double
,`idestat_es` int(11)
,`pendi` varchar(5)
,`repe` varchar(5)
,`convord` varchar(10)
,`convtext1` varchar(45)
,`convext1` varchar(10)
,`convtext2` varchar(45)
,`convext2` varchar(10)
,`convtext3` varchar(45)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ricca3_alumespec_view`
--
CREATE TABLE IF NOT EXISTS `ricca3_alumespec_view` (
`idalumespec` int(11)
,`idalumne` int(11)
,`cognomsinom` varchar(100)
,`telefon` varchar(30)
,`telefonfixe` varchar(50)
,`email` varchar(50)
,`idgrup` int(11)
,`grup` varchar(45)
,`sessio` varchar(25)
,`idcurs` int(11)
,`curs` varchar(15)
,`nomespecialitat` varchar(100)
,`idespecialitat` int(11)
,`idany` int(11)
,`any` varchar(50)
,`idestat_es` int(11)
,`estat` varchar(15)
,`idhistorial` tinytext
,`notaf_es` double
,`repeteix` varchar(1)
,`observ1` varchar(255)
,`observ2` varchar(255)
,`observ3` varchar(255)
,`motiubaixa` varchar(255)
,`databaixa` datetime
,`abonament` varchar(50)
,`datainscripcio` date
);
-- --------------------------------------------------------

--
-- Table structure for table `ricca3_alumne`
--

CREATE TABLE IF NOT EXISTS `ricca3_alumne` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2934 ;

-- --------------------------------------------------------

--
-- Table structure for table `ricca3_alumne_especialitat`
--

CREATE TABLE IF NOT EXISTS `ricca3_alumne_especialitat` (
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
  KEY `idany` (`idany`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1362 ;

-- --------------------------------------------------------

--
-- Table structure for table `ricca3_any`
--

CREATE TABLE IF NOT EXISTS `ricca3_any` (
  `idany` int(11) NOT NULL AUTO_INCREMENT,
  `any` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `actual` tinyint(1) NOT NULL DEFAULT '0',
  `insc` tinyint(1) NOT NULL DEFAULT '0',
  `conv` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cursanterior` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cursposterior` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idany`),
  KEY `conv` (`conv`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `ricca3_avaluacions`
--

CREATE TABLE IF NOT EXISTS `ricca3_avaluacions` (
  `idavaluacio` int(11) NOT NULL AUTO_INCREMENT,
  `nomaval` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idavaluacio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `ricca3_calcul_notaf`
--

CREATE TABLE IF NOT EXISTS `ricca3_calcul_notaf` (
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
  KEY `idespecialitat` (`idespecialitat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ricca3_ccomp`
--

CREATE TABLE IF NOT EXISTS `ricca3_ccomp` (
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
  KEY `idtutor` (`idtutor`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=365 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `ricca3_ccomp_view`
--
CREATE TABLE IF NOT EXISTS `ricca3_ccomp_view` (
`idccomp` int(11)
,`idcredit` int(11)
,`idgrup` int(11)
,`grup` varchar(45)
,`hores_cc` int(11)
,`hores_cr` int(11)
,`idprofessor` int(11)
,`nomicognoms` varchar(45)
,`idtutor` int(11)
,`nomicognomstut` varchar(45)
,`actiu_cc` tinyint(1)
,`actiu_cr` tinyint(1)
,`actiu_gr` int(5)
,`actiu_es` int(5)
,`nomccomp` varchar(255)
,`nomcredit` varchar(100)
,`ordre_cr` tinyint(4)
,`idespecialitat` int(11)
,`nomespecialitat` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ricca3_convext1`
--
CREATE TABLE IF NOT EXISTS `ricca3_convext1` (
`idany` int(11)
,`any` varchar(50)
,`actual` tinyint(1)
,`insc` tinyint(1)
,`conv` varchar(45)
,`ts` timestamp
,`stampuser` varchar(15)
,`stampplace` varchar(50)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ricca3_convext2`
--
CREATE TABLE IF NOT EXISTS `ricca3_convext2` (
`idany` int(11)
,`any` varchar(50)
,`actual` tinyint(1)
,`insc` tinyint(1)
,`conv` varchar(45)
,`ts` timestamp
,`stampuser` varchar(15)
,`stampplace` varchar(50)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ricca3_convord`
--
CREATE TABLE IF NOT EXISTS `ricca3_convord` (
`idany` int(11)
,`any` varchar(50)
,`actual` tinyint(1)
,`insc` tinyint(1)
,`conv` varchar(45)
,`ts` timestamp
,`stampuser` varchar(15)
,`stampplace` varchar(50)
);
-- --------------------------------------------------------

--
-- Table structure for table `ricca3_credits`
--

CREATE TABLE IF NOT EXISTS `ricca3_credits` (
  `idcredit` int(11) NOT NULL AUTO_INCREMENT,
  `idespecialitat` int(11) NOT NULL,
  `idcurs` int(11) NOT NULL,
  `hores_cr` int(11) NOT NULL,
  `actiu_cr` tinyint(1) NOT NULL DEFAULT '0',
  `ordre_cr` tinyint(4) NOT NULL,
  `aval3nomes` tinyint(1) NOT NULL DEFAULT '0',
  `nomcredit` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nomcredit_cast` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `credit` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idcredit`),
  KEY `idespecialitat` (`idespecialitat`),
  KEY `idcurs` (`idcurs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=221 ;

-- --------------------------------------------------------

--
-- Table structure for table `ricca3_credits_avaluacions`
--

CREATE TABLE IF NOT EXISTS `ricca3_credits_avaluacions` (
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
  KEY `repe` (`repe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10350 ;

-- --------------------------------------------------------

--
-- Table structure for table `ricca3_credits_especialitat`
--

CREATE TABLE IF NOT EXISTS `ricca3_credits_especialitat` (
  `idcredespec` int(11) NOT NULL AUTO_INCREMENT,
  `idespecialitat` int(11) NOT NULL,
  `idcredit` int(11) NOT NULL,
  `modul` int(5) DEFAULT NULL,
  `ordre_cr_es` int(5) DEFAULT NULL,
  `numero` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idcredespec`),
  KEY `idespecialitat` (`idespecialitat`),
  KEY `idcredit` (`idcredit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=85 ;

-- --------------------------------------------------------

--
-- Table structure for table `ricca3_cursos`
--

CREATE TABLE IF NOT EXISTS `ricca3_cursos` (
  `idcurs` int(11) NOT NULL AUTO_INCREMENT,
  `curs` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idcurs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `ricca3_especialitats`
--

CREATE TABLE IF NOT EXISTS `ricca3_especialitats` (
  `idespecialitat` int(11) NOT NULL AUTO_INCREMENT,
  `nomespecialitat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nomespecialitat_cast` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codiespecialitat` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reialdecret` int(11) DEFAULT NULL,
  `pla` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `actiu_es` int(5) NOT NULL DEFAULT '0',
  `cursos` int(5) NOT NULL,
  `ordre_es` int(5) DEFAULT NULL,
  `professio` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duracio` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idespecialitat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `ricca3_estat`
--

CREATE TABLE IF NOT EXISTS `ricca3_estat` (
  `idestat` int(11) NOT NULL AUTO_INCREMENT,
  `estat` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idestat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `ricca3_grups`
--

CREATE TABLE IF NOT EXISTS `ricca3_grups` (
  `idgrup` int(11) NOT NULL AUTO_INCREMENT,
  `grup` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `idespecialitat` int(11) NOT NULL,
  `idcurs` int(11) NOT NULL,
  `actiu_gr` int(5) DEFAULT '0',
  `ordre_gr` int(11) DEFAULT NULL,
  `sessio` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idgrup`),
  KEY `idespecialitat` (`idespecialitat`),
  KEY `idcurs` (`idcurs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Table structure for table `ricca3_historial`
--

CREATE TABLE IF NOT EXISTS `ricca3_historial` (
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
  KEY `fk_ricca3_historial_1` (`idalumne`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=260 ;

-- --------------------------------------------------------

--
-- Table structure for table `ricca3_pla`
--

CREATE TABLE IF NOT EXISTS `ricca3_pla` (
  `idpla` int(11) NOT NULL AUTO_INCREMENT,
  `idany` int(11) NOT NULL,
  `idccomp` int(11) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idpla`),
  KEY `idany` (`idany`),
  KEY `idccomp` (`idccomp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=568 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `ricca3_pla_view`
--
CREATE TABLE IF NOT EXISTS `ricca3_pla_view` (
`idpla` int(11)
,`idany` int(11)
,`any` varchar(50)
,`idccomp` int(11)
,`nomccomp` varchar(255)
,`idcredit` int(11)
,`nomcredit` varchar(100)
,`aval3nomes` tinyint(1)
,`ordre_cr` tinyint(4)
,`hores_cr` int(11)
,`idgrup` int(11)
,`hores_cc` int(11)
,`grup` varchar(45)
,`idcurs` int(11)
,`curs` varchar(15)
,`idespecialitat` int(11)
,`nomespecialitat` varchar(100)
,`idprofessor` int(11)
,`nomicognoms` varchar(45)
,`idtutor` int(11)
,`nomicognomstut` varchar(45)
);
-- --------------------------------------------------------

--
-- Table structure for table `ricca3_professors`
--

CREATE TABLE IF NOT EXISTS `ricca3_professors` (
  `idprof` int(11) NOT NULL AUTO_INCREMENT,
  `idtutor` int(11) NOT NULL,
  `nomicognoms` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telcasa` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `telcont1` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `telcont2` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `telcont3` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stampuser` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampplace` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idprof`),
  KEY `idtutor` (`idtutor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=88 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `ricca3_tutors`
--
CREATE TABLE IF NOT EXISTS `ricca3_tutors` (
`idprof` int(11)
,`idtutor` int(11)
,`nomicognomstut` varchar(45)
,`telcasa` varchar(30)
,`telcont1` varchar(30)
,`telcont2` varchar(30)
,`telcont3` varchar(30)
,`email` varchar(50)
,`ts` timestamp
,`stampuser` varchar(15)
,`stampplace` varchar(50)
);
-- --------------------------------------------------------

--
-- Structure for view `ricca3_alumccomprepe_view`
--
DROP TABLE IF EXISTS `ricca3_alumccomprepe_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_alumccomprepe_view` AS select distinct `ricca3_credits_avaluacions`.`idcredaval` AS `idcredaval`,`ricca3_credits_avaluacions`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_alumne`.`cognomsinom` AS `cognomsinom`,`ricca3_alumne`.`idalumne` AS `idalumne`,`ricca3_credits_avaluacions`.`idccomp` AS `idccomp`,`ricca3_ccomp`.`nomccomp` AS `nomccomp`,`ricca3_ccomp`.`idcredit` AS `idcredit`,`ricca3_credits`.`nomcredit` AS `nomcredit`,`ricca3_credits`.`aval3nomes` AS `aval3nomes`,`ricca3_credits`.`idespecialitat` AS `idespecialitat`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat`,`ricca3_credits`.`idcurs` AS `idcurs`,`ricca3_credits`.`ordre_cr` AS `ordre_cr`,`ricca3_ccomp`.`idgrup` AS `idgrup`,`ricca3_grups`.`grup` AS `grup`,`ricca3_ccomp`.`idprofessor` AS `idprofessor`,`ricca3_professors`.`nomicognoms` AS `nomicognoms`,`ricca3_ccomp`.`idtutor` AS `idtutor`,`ricca3_tutors`.`nomicognomstut` AS `nomicognomstut` from ((((((((`ricca3_credits_avaluacions` join `ricca3_alumne` on((`ricca3_alumne`.`idalumne` = `ricca3_credits_avaluacions`.`idalumne`))) join `ricca3_ccomp` on((`ricca3_ccomp`.`idccomp` = `ricca3_credits_avaluacions`.`idccomp`))) join `ricca3_credits` on((`ricca3_credits`.`idcredit` = `ricca3_ccomp`.`idcredit`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_ccomp`.`idgrup`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_credits`.`idespecialitat`))) join `ricca3_professors` on((`ricca3_professors`.`idprof` = `ricca3_ccomp`.`idprofessor`))) join `ricca3_tutors` on((`ricca3_tutors`.`idtutor` = `ricca3_ccomp`.`idtutor`))) join `ricca3_any` on((`ricca3_any`.`idany` = `ricca3_credits_avaluacions`.`idany`))) where (`ricca3_credits_avaluacions`.`repe` = 'R') order by `ricca3_alumne`.`cognomsinom`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_alumcredit_view`
--
DROP TABLE IF EXISTS `ricca3_alumcredit_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_alumcredit_view` AS select `ricca3_credits_avaluacions`.`idcredaval` AS `idcredaval`,`ricca3_credits_avaluacions`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_credits_avaluacions`.`idccomp` AS `idccomp`,`ricca3_ccomp`.`nomccomp` AS `nomccomp`,`ricca3_ccomp`.`idcredit` AS `idcredit`,`ricca3_credits`.`idespecialitat` AS `idespecialitat`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat`,`ricca3_credits`.`idcurs` AS `idcurs`,`ricca3_cursos`.`curs` AS `curs`,`ricca3_ccomp`.`idgrup` AS `idgrup`,`ricca3_grups`.`grup` AS `grup`,`ricca3_ccomp`.`idprofessor` AS `idprofessor`,`ricca3_professors`.`nomicognoms` AS `nomicognoms`,`ricca3_ccomp`.`idtutor` AS `idtutor`,`ricca3_tutors`.`nomicognomstut` AS `nomicognomstut`,`ricca3_ccomp`.`hores_cc` AS `hores_cc`,`ricca3_credits`.`hores_cr` AS `hores_cr`,`ricca3_ccomp`.`actiu_cc` AS `actiu_cc`,`ricca3_credits`.`actiu_cr` AS `actiu_cr`,`ricca3_credits`.`ordre_cr` AS `ordre_cr`,`ricca3_credits`.`nomcredit` AS `nomcredit`,`ricca3_credits_avaluacions`.`idalumne` AS `idalumne`,`ricca3_alumne`.`cognomsinom` AS `cognomsinom`,`ricca3_credits_avaluacions`.`nota1` AS `nota1`,`ricca3_credits_avaluacions`.`act1` AS `act1`,`ricca3_credits_avaluacions`.`nota2` AS `nota2`,`ricca3_credits_avaluacions`.`act2` AS `act2`,`ricca3_credits_avaluacions`.`nota3` AS `nota3`,`ricca3_credits_avaluacions`.`actf` AS `actf`,`ricca3_credits_avaluacions`.`recup` AS `recup`,`ricca3_credits_avaluacions`.`notaf_cc` AS `notaf_cc`,`ricca3_credits_avaluacions`.`notaf_cr` AS `notaf_cr`,`ricca3_alumne_especialitat`.`notaf_es` AS `notaf_es`,`ricca3_alumne_especialitat`.`idestat_es` AS `idestat_es`,`ricca3_credits_avaluacions`.`pendi` AS `pendi`,`ricca3_credits_avaluacions`.`repe` AS `repe`,`ricca3_credits_avaluacions`.`convord` AS `convord`,`ricca3_convord`.`conv` AS `convtext1`,`ricca3_credits_avaluacions`.`convext1` AS `convext1`,`ricca3_convext1`.`conv` AS `convtext2`,`ricca3_credits_avaluacions`.`convext2` AS `convext2`,`ricca3_convext2`.`conv` AS `convtext3` from (((((((((((((`ricca3_credits_avaluacions` join `ricca3_any` on((`ricca3_any`.`idany` = `ricca3_credits_avaluacions`.`idany`))) join `ricca3_ccomp` on((`ricca3_ccomp`.`idccomp` = `ricca3_credits_avaluacions`.`idccomp`))) join `ricca3_credits` on((`ricca3_credits`.`idcredit` = `ricca3_ccomp`.`idcredit`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_ccomp`.`idgrup`))) join `ricca3_professors` on((`ricca3_professors`.`idprof` = `ricca3_ccomp`.`idprofessor`))) join `ricca3_tutors` on((`ricca3_tutors`.`idprof` = `ricca3_ccomp`.`idtutor`))) join `ricca3_alumne` on((`ricca3_alumne`.`idalumne` = `ricca3_credits_avaluacions`.`idalumne`))) join `ricca3_convord` on((`ricca3_convord`.`idany` = `ricca3_credits_avaluacions`.`convord`))) join `ricca3_convext1` on((`ricca3_convext1`.`idany` = `ricca3_credits_avaluacions`.`convext1`))) join `ricca3_convext2` on((`ricca3_convext2`.`idany` = `ricca3_credits_avaluacions`.`convext2`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_credits`.`idespecialitat`))) join `ricca3_cursos` on((`ricca3_cursos`.`idcurs` = `ricca3_credits`.`idcurs`))) join `ricca3_alumne_especialitat` on(((`ricca3_alumne_especialitat`.`idalumne` = `ricca3_alumne`.`idalumne`) and (`ricca3_alumne_especialitat`.`idgrup` = `ricca3_grups`.`idgrup`)))) order by `ricca3_grups`.`ordre_gr`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_alumespec_view`
--
DROP TABLE IF EXISTS `ricca3_alumespec_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_alumespec_view` AS select `ricca3_alumne_especialitat`.`idalumespec` AS `idalumespec`,`ricca3_alumne_especialitat`.`idalumne` AS `idalumne`,`ricca3_alumne`.`cognomsinom` AS `cognomsinom`,`ricca3_alumne`.`telefon` AS `telefon`,`ricca3_alumne`.`telefonfixe` AS `telefonfixe`,`ricca3_alumne`.`email` AS `email`,`ricca3_alumne_especialitat`.`idgrup` AS `idgrup`,`ricca3_grups`.`grup` AS `grup`,`ricca3_grups`.`sessio` AS `sessio`,`ricca3_grups`.`idcurs` AS `idcurs`,`ricca3_cursos`.`curs` AS `curs`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat`,`ricca3_especialitats`.`idespecialitat` AS `idespecialitat`,`ricca3_alumne_especialitat`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_alumne_especialitat`.`idestat_es` AS `idestat_es`,`ricca3_estat`.`estat` AS `estat`,`ricca3_alumne`.`idhistorial` AS `idhistorial`,`ricca3_alumne_especialitat`.`notaf_es` AS `notaf_es`,`ricca3_alumne_especialitat`.`repeteix` AS `repeteix`,`ricca3_alumne_especialitat`.`observ1` AS `observ1`,`ricca3_alumne_especialitat`.`observ2` AS `observ2`,`ricca3_alumne_especialitat`.`observ3` AS `observ3`,`ricca3_alumne_especialitat`.`motiubaixa` AS `motiubaixa`,`ricca3_alumne_especialitat`.`databaixa` AS `databaixa`,`ricca3_alumne_especialitat`.`abonament` AS `abonament`,`ricca3_alumne_especialitat`.`datainscripcio` AS `datainscripcio` from ((((((`ricca3_alumne_especialitat` join `ricca3_alumne` on((`ricca3_alumne`.`idalumne` = `ricca3_alumne_especialitat`.`idalumne`))) join `ricca3_any` on((`ricca3_any`.`idany` = `ricca3_alumne_especialitat`.`idany`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_alumne_especialitat`.`idgrup`))) join `ricca3_cursos` on((`ricca3_cursos`.`idcurs` = `ricca3_grups`.`idcurs`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_grups`.`idespecialitat`))) join `ricca3_estat` on((`ricca3_estat`.`idestat` = `ricca3_alumne_especialitat`.`idestat_es`))) order by `ricca3_alumne`.`cognomsinom`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_ccomp_view`
--
DROP TABLE IF EXISTS `ricca3_ccomp_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_ccomp_view` AS select `ricca3_ccomp`.`idccomp` AS `idccomp`,`ricca3_ccomp`.`idcredit` AS `idcredit`,`ricca3_ccomp`.`idgrup` AS `idgrup`,`ricca3_grups`.`grup` AS `grup`,`ricca3_ccomp`.`hores_cc` AS `hores_cc`,`ricca3_credits`.`hores_cr` AS `hores_cr`,`ricca3_ccomp`.`idprofessor` AS `idprofessor`,`ricca3_professors`.`nomicognoms` AS `nomicognoms`,`ricca3_ccomp`.`idtutor` AS `idtutor`,`ricca3_tutors`.`nomicognomstut` AS `nomicognomstut`,`ricca3_ccomp`.`actiu_cc` AS `actiu_cc`,`ricca3_credits`.`actiu_cr` AS `actiu_cr`,`ricca3_grups`.`actiu_gr` AS `actiu_gr`,`ricca3_especialitats`.`actiu_es` AS `actiu_es`,`ricca3_ccomp`.`nomccomp` AS `nomccomp`,`ricca3_credits`.`nomcredit` AS `nomcredit`,`ricca3_credits`.`ordre_cr` AS `ordre_cr`,`ricca3_credits`.`idespecialitat` AS `idespecialitat`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat` from (((((`ricca3_ccomp` join `ricca3_credits` on((`ricca3_credits`.`idcredit` = `ricca3_ccomp`.`idcredit`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_ccomp`.`idgrup`))) join `ricca3_professors` on((`ricca3_professors`.`idprof` = `ricca3_ccomp`.`idprofessor`))) join `ricca3_tutors` on((`ricca3_tutors`.`idprof` = `ricca3_ccomp`.`idtutor`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_credits`.`idespecialitat`))) order by `ricca3_credits`.`ordre_cr`,`ricca3_ccomp`.`idprofessor`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_convext1`
--
DROP TABLE IF EXISTS `ricca3_convext1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_convext1` AS select `ricca3_any`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_any`.`actual` AS `actual`,`ricca3_any`.`insc` AS `insc`,`ricca3_any`.`conv` AS `conv`,`ricca3_any`.`ts` AS `ts`,`ricca3_any`.`stampuser` AS `stampuser`,`ricca3_any`.`stampplace` AS `stampplace` from `ricca3_any`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_convext2`
--
DROP TABLE IF EXISTS `ricca3_convext2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_convext2` AS select `ricca3_any`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_any`.`actual` AS `actual`,`ricca3_any`.`insc` AS `insc`,`ricca3_any`.`conv` AS `conv`,`ricca3_any`.`ts` AS `ts`,`ricca3_any`.`stampuser` AS `stampuser`,`ricca3_any`.`stampplace` AS `stampplace` from `ricca3_any`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_convord`
--
DROP TABLE IF EXISTS `ricca3_convord`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_convord` AS select `ricca3_any`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_any`.`actual` AS `actual`,`ricca3_any`.`insc` AS `insc`,`ricca3_any`.`conv` AS `conv`,`ricca3_any`.`ts` AS `ts`,`ricca3_any`.`stampuser` AS `stampuser`,`ricca3_any`.`stampplace` AS `stampplace` from `ricca3_any`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_pla_view`
--
DROP TABLE IF EXISTS `ricca3_pla_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_pla_view` AS select `ricca3_pla`.`idpla` AS `idpla`,`ricca3_pla`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_pla`.`idccomp` AS `idccomp`,`ricca3_ccomp`.`nomccomp` AS `nomccomp`,`ricca3_ccomp`.`idcredit` AS `idcredit`,`ricca3_credits`.`nomcredit` AS `nomcredit`,`ricca3_credits`.`aval3nomes` AS `aval3nomes`,`ricca3_credits`.`ordre_cr` AS `ordre_cr`,`ricca3_credits`.`hores_cr` AS `hores_cr`,`ricca3_ccomp`.`idgrup` AS `idgrup`,`ricca3_ccomp`.`hores_cc` AS `hores_cc`,`ricca3_grups`.`grup` AS `grup`,`ricca3_grups`.`idcurs` AS `idcurs`,`ricca3_cursos`.`curs` AS `curs`,`ricca3_especialitats`.`idespecialitat` AS `idespecialitat`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat`,`ricca3_ccomp`.`idprofessor` AS `idprofessor`,`ricca3_professors`.`nomicognoms` AS `nomicognoms`,`ricca3_ccomp`.`idtutor` AS `idtutor`,`ricca3_tutors`.`nomicognomstut` AS `nomicognomstut` from ((((((((`ricca3_pla` join `ricca3_ccomp` on((`ricca3_ccomp`.`idccomp` = `ricca3_pla`.`idccomp`))) join `ricca3_any` on((`ricca3_any`.`idany` = `ricca3_pla`.`idany`))) join `ricca3_credits` on((`ricca3_credits`.`idcredit` = `ricca3_ccomp`.`idcredit`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_ccomp`.`idgrup`))) join `ricca3_professors` on((`ricca3_professors`.`idprof` = `ricca3_ccomp`.`idprofessor`))) join `ricca3_tutors` on((`ricca3_tutors`.`idprof` = `ricca3_ccomp`.`idtutor`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_grups`.`idespecialitat`))) join `ricca3_cursos` on((`ricca3_cursos`.`idcurs` = `ricca3_grups`.`idcurs`)));

-- --------------------------------------------------------

--
-- Structure for view `ricca3_tutors`
--
DROP TABLE IF EXISTS `ricca3_tutors`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_tutors` AS select `ricca3_professors`.`idprof` AS `idprof`,`ricca3_professors`.`idtutor` AS `idtutor`,`ricca3_professors`.`nomicognoms` AS `nomicognomstut`,`ricca3_professors`.`telcasa` AS `telcasa`,`ricca3_professors`.`telcont1` AS `telcont1`,`ricca3_professors`.`telcont2` AS `telcont2`,`ricca3_professors`.`telcont3` AS `telcont3`,`ricca3_professors`.`email` AS `email`,`ricca3_professors`.`ts` AS `ts`,`ricca3_professors`.`stampuser` AS `stampuser`,`ricca3_professors`.`stampplace` AS `stampplace` from `ricca3_professors`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ricca3_alumne_especialitat`
--
ALTER TABLE `ricca3_alumne_especialitat`
  ADD CONSTRAINT `ricca3_alumne_especialitat_ibfk_2` FOREIGN KEY (`idgrup`) REFERENCES `ricca3_grups` (`idgrup`),
  ADD CONSTRAINT `ricca3_alumne_especialitat_ibfk_3` FOREIGN KEY (`idestat_es`) REFERENCES `ricca3_estat` (`idestat`),
  ADD CONSTRAINT `ricca3_alumne_especialitat_ibfk_4` FOREIGN KEY (`idalumne`) REFERENCES `ricca3_alumne` (`idalumne`),
  ADD CONSTRAINT `ricca3_alumne_especialitat_ibfk_5` FOREIGN KEY (`idany`) REFERENCES `ricca3_any` (`idany`);

--
-- Constraints for table `ricca3_calcul_notaf`
--
ALTER TABLE `ricca3_calcul_notaf`
  ADD CONSTRAINT `ricca3_calcul_notaf_ibfk_1` FOREIGN KEY (`idespecialitat`) REFERENCES `ricca3_especialitats` (`idespecialitat`),
  ADD CONSTRAINT `ricca3_calcul_notaf_ibfk_2` FOREIGN KEY (`idalumne`) REFERENCES `ricca3_alumne` (`idalumne`);

--
-- Constraints for table `ricca3_ccomp`
--
ALTER TABLE `ricca3_ccomp`
  ADD CONSTRAINT `ricca3_ccomp_ibfk_1` FOREIGN KEY (`idcredit`) REFERENCES `ricca3_credits` (`idcredit`),
  ADD CONSTRAINT `ricca3_ccomp_ibfk_2` FOREIGN KEY (`idgrup`) REFERENCES `ricca3_grups` (`idgrup`),
  ADD CONSTRAINT `ricca3_ccomp_ibfk_3` FOREIGN KEY (`idprofessor`) REFERENCES `ricca3_professors` (`idprof`),
  ADD CONSTRAINT `ricca3_ccomp_ibfk_4` FOREIGN KEY (`idtutor`) REFERENCES `ricca3_professors` (`idtutor`);

--
-- Constraints for table `ricca3_credits`
--
ALTER TABLE `ricca3_credits`
  ADD CONSTRAINT `ricca3_credits_ibfk_1` FOREIGN KEY (`idcurs`) REFERENCES `ricca3_cursos` (`idcurs`),
  ADD CONSTRAINT `ricca3_credits_ibfk_2` FOREIGN KEY (`idespecialitat`) REFERENCES `ricca3_especialitats` (`idespecialitat`);

--
-- Constraints for table `ricca3_credits_avaluacions`
--
ALTER TABLE `ricca3_credits_avaluacions`
  ADD CONSTRAINT `ricca3_credits_avaluacions_ibfk_1` FOREIGN KEY (`idany`) REFERENCES `ricca3_any` (`idany`),
  ADD CONSTRAINT `ricca3_credits_avaluacions_ibfk_2` FOREIGN KEY (`idccomp`) REFERENCES `ricca3_ccomp` (`idccomp`),
  ADD CONSTRAINT `ricca3_credits_avaluacions_ibfk_3` FOREIGN KEY (`idalumne`) REFERENCES `ricca3_alumne` (`idalumne`);

--
-- Constraints for table `ricca3_credits_especialitat`
--
ALTER TABLE `ricca3_credits_especialitat`
  ADD CONSTRAINT `ricca3_credits_especialitat_ibfk_1` FOREIGN KEY (`idespecialitat`) REFERENCES `ricca3_especialitats` (`idespecialitat`),
  ADD CONSTRAINT `ricca3_credits_especialitat_ibfk_2` FOREIGN KEY (`idcredit`) REFERENCES `ricca3_credits` (`idcredit`);

--
-- Constraints for table `ricca3_grups`
--
ALTER TABLE `ricca3_grups`
  ADD CONSTRAINT `ricca3_grups_ibfk_1` FOREIGN KEY (`idcurs`) REFERENCES `ricca3_cursos` (`idcurs`),
  ADD CONSTRAINT `ricca3_grups_ibfk_2` FOREIGN KEY (`idespecialitat`) REFERENCES `ricca3_especialitats` (`idespecialitat`);

--
-- Constraints for table `ricca3_historial`
--
ALTER TABLE `ricca3_historial`
  ADD CONSTRAINT `fk_ricca3_historial_1` FOREIGN KEY (`idalumne`) REFERENCES `ricca3_alumne` (`idalumne`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ricca3_pla`
--
ALTER TABLE `ricca3_pla`
  ADD CONSTRAINT `ricca3_pla_ibfk_1` FOREIGN KEY (`idccomp`) REFERENCES `ricca3_ccomp` (`idccomp`),
  ADD CONSTRAINT `ricca3_pla_ibfk_2` FOREIGN KEY (`idany`) REFERENCES `ricca3_any` (`idany`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
