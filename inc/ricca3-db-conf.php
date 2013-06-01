<?php

#############################################################################################
/** 	ricca3_credits  																	*/
#############################################################################################
$ricca3_sql_credits = "CREATE TABLE ricca3_credits (
idcredit       int(11) NOT NULL AUTO_INCREMENT,
idespecialitat int(11) NOT NULL,
idcurs         int(11) NOT NULL,
hores_cr       int(11) NOT NULL,
actiu_cr       tinyint(1) NOT NULL DEFAULT '0',
ordre_cr       tinyint(4) NOT NULL,
aval3nomes     tinyint(1) NOT NULL DEFAULT '0',
nomcredit      varchar(100) COLLATE utf8_unicode_ci NOT NULL,
credit         varchar(100) COLLATE utf8_unicode_ci NOT NULL,
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY  (idcredit),
);";

#############################################################################################
/** 	ricca3_professors 																	*/
#############################################################################################
$ricca3_sql_professors = "CREATE TABLE ricca3_professors (
idprof         int(11) NOT NULL AUTO_INCREMENT,
idtutor        int(11) NOT NULL,
nomicognoms    varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
telcasa        varchar(30) CHARACTER SET utf8 DEFAULT NULL,
telcont1       varchar(30) CHARACTER SET utf8 DEFAULT NULL,
telcont2       varchar(30) CHARACTER SET utf8 DEFAULT NULL,
telcont3       varchar(30) CHARACTER SET utf8 DEFAULT NULL,
email          varchar(50) CHARACTER SET utf8 DEFAULT NULL,
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY  (idprof),
);";

#############################################################################################
/** 	ricca3_alumne_especialitat  														*/
#############################################################################################
$ricca3_sql_alumne_especialitat = "CREATE TABLE ricca3_alumne_especialitat (
idalumespec    int(11) NOT NULL AUTO_INCREMENT,
idalumne       int(11) NOT NULL,
idgrup         int(11) NOT NULL,
idany          int(11) NOT NULL,
idestat_es     int(11) NOT NULL,
motiubaixa     varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
databaixa      datetime DEFAULT NULL,
notaf_es       double DEFAULT '0',
repeteix       varchar(1) COLLATE utf8_unicode_ci DEFAULT '',
observ1        varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
observ2        varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
observ3        varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
datainscripcio date NOT NULL DEFAULT '0000-00-00',
abonament      varchar(50) COLLATE utf8_unicode_ci DEFAULT '',		
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
PRIMARY KEY  (idalumespec),
);";

#############################################################################################
/** 	ricca3_grups 																		 */
#############################################################################################
$ricca3_sql_grups = "CREATE TABLE ricca3_grups (
idgrup         int(11) NOT NULL AUTO_INCREMENT,
grup           varchar(45) COLLATE utf8_unicode_ci NOT NULL,
idespecialitat int(11) NOT NULL,
idcurs         int(11) NOT NULL,
actiu_gr       int(5) DEFAULT '0',
ordre_gr       int(11) DEFAULT NULL,
sessio         varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY  (idgrup),
);";

#############################################################################################
/**   	ricca3_any																			*/
#############################################################################################
$ricca3_sql_any = "CREATE TABLE ricca3_any (
idany          int(11) NOT NULL AUTO_INCREMENT,
any            varchar(50) COLLATE utf8_unicode_ci NOT NULL,
actual         tinyint(1) NOT NULL DEFAULT '0',
insc           tinyint(1) NOT NULL DEFAULT '0',
conv           varchar(45) COLLATE utf8_unicode_ci NOT NULL,
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY  (idany),
);";

#############################################################################################
/**   	ricca3_historial																	*/
#############################################################################################
$ricca3_sql_historial = "CREATE TABLE ricca3_historial (
idhistorial    int(11) NOT NULL AUTO_INCREMENT,
idalumne       int(11) NOT NULL,
idespecialitat int(11) NOT NULL,
codi_c         varchar(225) COLLATE utf8_unicode_ci DEFAULT '08035672',
nom_c          varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
grau_c         varchar(225) COLLATE utf8_unicode_ci DEFAULT 'Superior',
titol          varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
prova          varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
condic         varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
cicle_codi     varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
cicle_nom      varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
cicle_any_de   varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
cicle_any_a    varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
cicle_curs     varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,		
modul          varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
m_hores        varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
m_qual         varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
m_conv         varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
uf             varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
uf_hores       varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
uf_qual        varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
uf_conv        varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
qual_final     double DEFAULT '0',
obs            varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY  (idhistorial),
);";

#############################################################################################
/**   	ricca3_avaluacions																	*/
#############################################################################################
$ricca3_sql_avaluacions = "CREATE TABLE ricca3_avaluacions (
idavaluacio    int(11) NOT NULL AUTO_INCREMENT,
nomaval        varchar(50) COLLATE utf8_unicode_ci NOT NULL,
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY  (idavaluacio),
);";

#############################################################################################
/**   	ricca3_ccomp																		*/
#############################################################################################
$ricca3_sql_ccomp = "CREATE TABLE ricca3_ccomp (
idccomp        int(11) NOT NULL AUTO_INCREMENT,
idcredit       int(11) NOT NULL,
idgrup         int(11) NOT NULL,
idprofessor    int(11) NOT NULL,
idtutor        int(11) NOT NULL,
hores_cc       int(11) NOT NULL,
actiu_cc       tinyint(1) NOT NULL DEFAULT '0',
nomccomp       varchar(255) COLLATE utf8_unicode_ci NOT NULL,
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY  (idccomp),
);";

#############################################################################################
/**   	ricca3_calcul_notaf																	*/
#############################################################################################
$ricca3_sql_calcul_notaf = "CREATE TABLE ricca3_calcul_notaf (
idcalcul       int(11) NOT NULL AUTO_INCREMENT,
idalumne       int(11) NOT NULL,
idespecialitat int(11) NOT NULL,
doublenotaf    double NOT NULL DEFAULT '0',
nomcredit      varchar(1024) CHARACTER SET utf8 NOT NULL,
notaf          varchar(1024) CHARACTER SET utf8 NOT NULL,
hores          varchar(1024) CHARACTER SET utf8 NOT NULL,
punts          varchar(1024) CHARACTER SET utf8 NOT NULL,
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY  (idcalcul),
);";

#############################################################################################
/**   	ricca3_alumne																		*/
#############################################################################################
$ricca3_sql_alumne = "CREATE TABLE ricca3_alumne (
idalumne       int(11) NOT NULL AUTO_INCREMENT,
cognom1        varchar(50) COLLATE utf8_unicode_ci NOT NULL,
cognom2        varchar(50) COLLATE utf8_unicode_ci NOT NULL,
nom            varchar(50) COLLATE utf8_unicode_ci NOT NULL,
idestat_al     int(11) NOT NULL,
datanai        date NOT NULL,
llocnai        varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Barcelona',
provnai        varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
paisnai        varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
dni            varchar(30) COLLATE utf8_unicode_ci NOT NULL,
residenciacurs varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
ciutatcurs     varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
codpostalcurs  varchar(5) COLLATE utf8_unicode_ci DEFAULT '',
telefoncontactecurs1 varchar(30) COLLATE utf8_unicode_ci DEFAULT '',
telefoncontactecurs2 varchar(30) COLLATE utf8_unicode_ci DEFAULT '',
email          varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
residenciahabitual varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
ciutathabitual varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Barcelona',
provinciahabitual varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
codipostal     varchar(5) COLLATE utf8_unicode_ci DEFAULT '',
telefon        varchar(30) COLLATE utf8_unicode_ci DEFAULT '',
estudisrealitzats varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
datainscripcio date NOT NULL DEFAULT '0000-00-00',
telefonfixe    varchar(50) COLLATE utf8_unicode_ci DEFAULT ''
estudisanteriors varchar(255) COLLATE utf8_unicode_ci DEFAULT ''
centreea       varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
poblacioea     varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
abonament      varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
tipusdni       varchar(30) COLLATE utf8_unicode_ci DEFAULT '',
llenguafamiliar varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
professio      varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
idhistorial    tinytext COLLATE utf8_unicode_ci,
nacionalitat   varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
attachment_id  varchar(30) COLLATE utf8_unicode_ci DEFAULT '',
cognomsinom    varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
nomicognoms    varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT '',
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
PRIMARY KEY  (idalumne),
);";

#############################################################################################
/**   	ricca3_credits_especialitat															*/
#############################################################################################
$ricca3_sql_credits_especialitat = "CREATE TABLE ricca3_credits_especialitat (
idcredespec    int(11) NOT NULL AUTO_INCREMENT,
idespecialitat int(11) NOT NULL,
idcredit       int(11) NOT NULL,
modul          int(5) DEFAULT NULL,
ordre_cr_es    int(5) DEFAULT NULL,
numero         varchar(45) CHARACTER SET utf8 DEFAULT NULL,
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY  (idcredespec),
);";

#############################################################################################
/**   	ricca3_pla																			*/
#############################################################################################
$ricca3_sql_pla = "CREATE TABLE ricca3_pla (
idpla          int(11) NOT NULL AUTO_INCREMENT,
idany          int(11) NOT NULL,
idccomp        int(11) NOT NULL,
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY  (idpla),
);";
		
#############################################################################################
/**   	ricca3_cursos																		*/
#############################################################################################
$ricca3_sql_cursos = "CREATE TABLE ricca3_cursos (
idcurs         int(11) NOT NULL AUTO_INCREMENT,
curs           varchar(15) COLLATE utf8_unicode_ci NOT NULL,
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY  (idcurs),
);";		

#############################################################################################
/**   	ricca3_estat																		*/
#############################################################################################
$ricca3_sql_estat = "CREATE TABLE ricca3_estat (
idestat        int(11) NOT NULL AUTO_INCREMENT,
estat          varchar(15) COLLATE utf8_unicode_ci NOT NULL,
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY  (idestat),
);";

#############################################################################################
/**   	ricca3_especialitats																*/
#############################################################################################
$ricca3_sql_especialitats = "CREATE TABLE ricca3_especialitats (
idespecialitat int(11) NOT NULL AUTO_INCREMENT,
nomespecialitat varchar(100) COLLATE utf8_unicode_ci NOT NULL,
codiespecialitat varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
pla            varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
actiu_es       int(5) NOT NULL DEFAULT '0',
cursos         int(5) NOT NULL,
ordre_es       int(5) DEFAULT NULL,
professio      varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
duracio        varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY  (idespecialitat),
);";

#############################################################################################
/**   	ricca3_credits_avaluacions 															*/
#############################################################################################
$ricca3_sql_credits_avaluacions = "CREATE TABLE ricca3_credits_avaluacions (
idcredaval     int(11) NOT NULL AUTO_INCREMENT,
idany          int(11) NOT NULL,
idccomp        int(11) NOT NULL,
idalumne       int(11) NOT NULL,
nota1          varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
nota2          varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
nota3          varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
recup          varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
notaf_cc       varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
notaf_cr       varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
act1           varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
act2           varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
actf           varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
pendi          varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
repe           varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
convord        int(11) NOT NULL,
convext1       int(11) DEFAULT '0',
convext2       int(11) DEFAULT '0',
ts             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
stampuser      varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
stampplace     varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY  (idcredaval),
);";


