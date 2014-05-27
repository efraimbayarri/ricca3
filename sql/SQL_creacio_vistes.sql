DROP VIEW IF EXISTS `ricca_alumccomprepe_view`;
CREATE VIEW `ricca_alumccomprepe_view` AS
select DISTINCT
ricca_credits_avaluacions.idkey AS idkey,
ricca_credits_avaluacions.idany AS idany,
ricca_alumne.cognom1            AS cognom1,
ricca_alumne.cognom2            AS cognom2,
ricca_alumne.nom                AS nom,
ricca_alumne.idalumne           AS idalumne,
ricca_credits_avaluacions.idespecialitat AS idespecialitat,
ricca_credits_avaluacions.curs  AS curs,
ricca_alumne_especialitat.estat AS estat,
ricca_especialitats.nomespecialitat AS nomespecialitat,
ricca_grups.grup                AS grup,
ricca_ccomp.idkey               AS idccomp,
ricca_ccomp.nomccomp            AS nomccomp,
ricca_credits.ordre             AS ordre

FROM ricca_credits_avaluacions 
INNER JOIN ricca_alumne ON ricca_alumne.idalumne = ricca_credits_avaluacions.idalumne 
INNER JOIN ricca_especialitats ON ricca_especialitats.idkey = ricca_credits_avaluacions.idespecialitat 
INNER JOIN ricca_alumne_especialitat ON ricca_alumne_especialitat.idalumne =ricca_credits_avaluacions.idalumne
AND ricca_alumne_especialitat.idany = ricca_credits_avaluacions.idany
AND ricca_alumne_especialitat.estat = 'Alta'
AND ricca_alumne_especialitat.idespecialitat = ricca_credits_avaluacions.idespecialitat
INNER JOIN ricca_grups on ricca_grups.idgrup = ricca_credits_avaluacions.idgrup
INNER JOIN ricca_ccomp on ricca_ccomp.idkey = ricca_credits_avaluacions.idccomp
INNER JOIN ricca_credits ON ricca_credits.idcredit = ricca_ccomp.idcredit
WHERE ricca_credits_avaluacions.repe = 'R'
ORDER BY cognom1 ASC, cognom2 ASC;
#
#
#
DROP VIEW IF EXISTS `ricca_alumcredit_view`;
CREATE VIEW `ricca_alumcredit_view` AS
SELECT 	
ricca_credits_avaluacions.idkey          AS idkey,
ricca_credits_avaluacions.idprofessor    AS idprofessor,
ricca_credits_avaluacions.idcredit       AS idcredit,
ricca_credits_avaluacions.idccomp        AS idccomp,
ricca_credits_avaluacions.idany          AS idany,
ricca_credits_avaluacions.nota1		     AS nota1,
ricca_credits_avaluacions.nota2		     AS nota2,
ricca_credits_avaluacions.nota3		     AS nota3,
ricca_credits_avaluacions.recup		     AS recup,
ricca_credits_avaluacions.notaf		     AS notaf,
ricca_credits_avaluacions.act1		     AS act1,
ricca_credits_avaluacions.act2		     AS act2,
ricca_credits_avaluacions.actf		     AS actf,
ricca_credits_avaluacions.pendi		     AS pendi,
ricca_credits_avaluacions.repe		     AS repe,
ricca_credits_avaluacions.convord        AS convord,
ricca_credits_avaluacions.convext1       AS convext1,
ricca_credits_avaluacions.convext2       AS convext2,
ricca_alumne.idalumne                    AS idalumne,
ricca_alumne.cognom1                     AS cognom1, 
ricca_alumne.cognom2                     AS cognom2, 
ricca_alumne.nom                         AS nom,
ricca_alumne_especialitat.idespecialitat AS idespecialitat, 
ricca_alumne_especialitat.idcurs         AS idcurs, 
ricca_alumne_especialitat.idgrup         AS idgrup, 
ricca_alumne_especialitat.estat          AS estat, 
ricca_alumne_especialitat.nota           AS nota,
ricca_especialitats.nomespecialitat      AS nomespecialitat, 
ricca_grups.grup                         AS grup,
ricca_credits.nomcredit                  AS nomcredit,
ricca_credits.ordre                      AS ordre,
ricca_credits.hores                      AS hores,
ricca_credits.credit                     AS credit,
ricca_ccomp.nomccomp                     AS nomccomp,
ricca_professors.nomicognoms             AS nomicognoms

FROM ricca_credits_avaluacions 

INNER JOIN ricca_alumne ON ricca_alumne.idalumne = ricca_credits_avaluacions.idalumne
INNER JOIN ricca_alumne_especialitat ON ricca_alumne_especialitat.idalumne = ricca_credits_avaluacions.idalumne AND ricca_alumne_especialitat.idgrup = ricca_credits_avaluacions.idgrup
INNER JOIN ricca_especialitats ON ricca_especialitats.idkey = ricca_alumne_especialitat.idespecialitat
INNER JOIN ricca_grups ON ricca_grups.idgrup = ricca_alumne_especialitat.idgrup
INNER JOIN ricca_credits ON ricca_credits.idcredit = ricca_credits_avaluacions.idcredit
INNER JOIN ricca_ccomp ON ricca_ccomp.idkey = ricca_credits_avaluacions.idccomp
LEFT JOIN  ricca_professors ON ricca_professors.idkey = ricca_credits_avaluacions.idprofessor

ORDER BY ricca_alumne_especialitat.idcurs;
#
#
#
DROP VIEW IF EXISTS `ricca_alumespec_view`;
CREATE VIEW `ricca_alumespec_view` AS
	select 
ricca_alumne_especialitat.idkey          AS idkey,
ricca_alumne_especialitat.idespecialitat AS idespecialitat,
ricca_alumne_especialitat.idcurs         AS idcurs,
ricca_alumne_especialitat.idgrup         AS idgrup,
ricca_alumne_especialitat.idany          AS idany,
ricca_alumne_especialitat.estat          AS estat,
ricca_alumne_especialitat.repeteix       AS repeteix,
ricca_alumne_especialitat.observ1        AS observ1,
ricca_alumne_especialitat.observ2        AS observ2,
ricca_alumne_especialitat.observ3        AS observ3,
ricca_alumne_especialitat.motiubaixa     AS motiubaixa,
ricca_alumne_especialitat.nota           AS nota,
ricca_alumne.idalumne                    AS idalumne,
ricca_alumne.cognom1                     AS cognom1,
ricca_alumne.cognom2                     AS cognom2,
ricca_alumne.nom                         AS nom,
ricca_alumne.dni                         AS dni,
ricca_alumne.telefon                     AS telefon,
ricca_alumne.telefonfixe                 AS telefonfixe,
ricca_alumne.email                       AS email,
ricca_alumne.idhistorial                 AS idhistorial,
ricca_especialitats.nomespecialitat      AS nomespecialitat,
ricca_grups.grup                         AS grup,
ricca_grups.sessio                       AS sessio

FROM ricca_alumne
 
INNER JOIN ricca_alumne_especialitat ON ricca_alumne_especialitat.idalumne = ricca_alumne.idalumne
INNER JOIN ricca_especialitats ON ricca_especialitats.idkey = ricca_alumne_especialitat.idespecialitat 
INNER JOIN ricca_grups ON ricca_grups.idgrup = ricca_alumne_especialitat.idgrup

ORDER BY ricca_alumne.cognom1, ricca_alumne.cognom2;

#
#
#
DROP VIEW IF EXISTS `ricca_ccomp_view`;
CREATE VIEW `ricca_ccomp_view` AS
select ricca_ccomp.idgrup      	 AS ccidgrup,
ricca_ccomp.idcredit	     AS ccidcredit,
ricca_ccomp.idkey            AS ccidkey,
ricca_ccomp.hores    		 AS cchores,
ricca_ccomp.actiu            AS ccactiu,
ricca_ccomp.nomccomp         AS ccnomccomp,
ricca_ccomp.idprofessor      AS ccidprof,
ricca_ccomp.idtutor          AS ccidtutor,

ricca_credits.nomcredit      AS crednomcredit,
ricca_credits.actiu          AS credactiu,
ricca_credits.idespecialitat AS credidespec,
ricca_credits.curs           AS credcurs,
ricca_credits.hores          AS credhores,
ricca_credits.ordre          AS credordre,

ricca_grups.grup             AS grupgrup,
ricca_grups.actiu            AS grupactiu,

ricca_especialitats.nomespecialitat AS especnom,
ricca_especialitats.idkey	 AS especid,
ricca_especialitats.actiu	 AS especactiu,

ricca_professors.nomicognoms AS profnom,

ricca_professors_view.nomicognoms AS tutnom

from ricca_ccomp
inner join ricca_credits       on ricca_credits.idcredit = ricca_ccomp.idcredit
left join  ricca_grups         on ricca_grups.idgrup = ricca_ccomp.idgrup
left join  ricca_especialitats on ricca_especialitats.idkey = ricca_grups.idespecialitat
left join  ricca_professors    on ricca_professors.idkey = ricca_ccomp.idprofessor
left join  ricca_professors_view on ricca_professors_view.idkey = ricca_ccomp.idtutor;

#
#
#
DROP VIEW IF EXISTS `ricca_credpend_view`;
CREATE VIEW `ricca_credpend_view` AS
SELECT ricca_credits_avaluacions.idkey AS idkey, 
ricca_alumne.cognomsinom AS cognomsinom, 
ricca_credits_avaluacions.idany AS idany, 
ricca_ccomp.nomccomp AS nomccomp, 
ricca_credits_avaluacions.convord AS convord, 
ricca_credits_avaluacions.convext1 AS convext1, 
ricca_credits_avaluacions.convext2 AS convext2 

FROM ricca_credits_avaluacions 

INNER JOIN ricca_especialitats ON ricca_especialitats.idkey = ricca_credits_avaluacions.idespecialitat 
INNER JOIN ricca_ccomp         ON ricca_ccomp.idkey         = ricca_credits_avaluacions.idccomp 
INNER JOIN ricca_alumne        ON ricca_alumne.idalumne     = ricca_credits_avaluacions.idalumne 
LEFT JOIN  ricca_professors    ON ricca_professors.idkey    = ricca_credits_avaluacions.idprofessor 
WHERE pendi='P'   
ORDER BY cognomsinom ASC ;
#
#
#
DROP VIEW IF EXISTS `ricca_plan_view`;
CREATE VIEW `ricca_plan_view` AS
SELECT 
ricca_plan.idkey          AS idkey,
ricca_plan.any            AS any,
ricca_plan.idgrup         AS idgrup,
ricca_plan.idespecialitat AS idespecialitat,
ricca_plan.idcredit       AS idcredit,
ricca_plan.idccomp        AS idccomp,
ricca_plan.idprofessor    AS idprofessor,
ricca_plan.idtutor        AS idtutor,

ricca_grups.grup          AS grup,

ricca_especialitats.nomespecialitat AS nomespecialitat,

ricca_credits.nomcredit   AS nomcredit,
ricca_credits.ordre       AS ordre,
ricca_credits.hores       AS hores,
ricca_credits.aval3nomes  AS aval3nomes,
ricca_credits.curs        AS curs,

ricca_ccomp.hores         AS cchores,

ricca_professors.nomicognoms      AS profnomicognoms,

ricca_professors_view.nomicognoms AS tutnomicognoms

FROM ricca_plan

INNER JOIN ricca_grups ON ricca_grups.idgrup = ricca_plan.idgrup
INNER JOIN ricca_especialitats ON ricca_especialitats.idkey = ricca_plan.idespecialitat
INNER JOIN ricca_credits ON ricca_credits.idcredit = ricca_plan.idcredit
INNER JOIN ricca_ccomp ON ricca_ccomp.idkey = ricca_plan.idccomp
LEFT  JOIN ricca_professors ON ricca_professors.idkey = ricca_plan.idprofessor
LEFT  JOIN ricca_professors_view ON ricca_professors_view.idkey = ricca_plan.idtutor;
#
#
#
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_alumespec_view` AS select `ricca3_alumne_especialitat`.`idalumespec` AS `idalumespec`,`ricca3_alumne_especialitat`.`idalumne` AS `idalumne`,`ricca3_alumne`.`cognomsinom` AS `cognomsinom`,`ricca3_alumne`.`telefon` AS `telefon`,`ricca3_alumne`.`telefonfixe` AS `telefonfixe`,`ricca3_alumne`.`email` AS `email`,`ricca3_alumne_especialitat`.`idgrup` AS `idgrup`,`ricca3_grups`.`grup` AS `grup`,`ricca3_grups`.`sessio` AS `sessio`,`ricca3_grups`.`idcurs` AS `idcurs`,`ricca3_cursos`.`curs` AS `curs`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat`,`ricca3_especialitats`.`idespecialitat` AS `idespecialitat`,`ricca3_alumne_especialitat`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_alumne_especialitat`.`idestat_es` AS `idestat_es`,`ricca3_estat`.`estat` AS `estat`,`ricca3_alumne`.`idhistorial` AS `idhistorial`,`ricca3_alumne_especialitat`.`notaf_es` AS `notaf_es`,`ricca3_alumne_especialitat`.`notaf_es_manual` AS `notaf_es_manual`,`ricca3_alumne_especialitat`.`repeteix` AS `repeteix`,`ricca3_alumne_especialitat`.`observ1` AS `observ1`,`ricca3_alumne_especialitat`.`observ2` AS `observ2`,`ricca3_alumne_especialitat`.`observ3` AS `observ3`,`ricca3_alumne_especialitat`.`motiubaixa` AS `motiubaixa`,`ricca3_alumne_especialitat`.`databaixa` AS `databaixa`,`ricca3_alumne_especialitat`.`abonament` AS `abonament`,`ricca3_alumne_especialitat`.`datainscripcio` AS `datainscripcio` from ((((((`ricca3_alumne_especialitat` join `ricca3_alumne` on((`ricca3_alumne`.`idalumne` = `ricca3_alumne_especialitat`.`idalumne`))) join `ricca3_any` on((`ricca3_any`.`idany` = `ricca3_alumne_especialitat`.`idany`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_alumne_especialitat`.`idgrup`))) join `ricca3_cursos` on((`ricca3_cursos`.`idcurs` = `ricca3_grups`.`idcurs`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_grups`.`idespecialitat`))) join `ricca3_estat` on((`ricca3_estat`.`idestat` = `ricca3_alumne_especialitat`.`idestat_es`))) order by `ricca3_alumne`.`cognomsinom`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_ccomp_view`
--
DROP TABLE IF EXISTS `ricca3_ccomp_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_ccomp_view` AS select `ricca3_ccomp`.`idccomp` AS `idccomp`,`ricca3_ccomp`.`idcredit` AS `idcredit`,`ricca3_ccomp`.`idgrup` AS `idgrup`,`ricca3_grups`.`grup` AS `grup`,`ricca3_ccomp`.`hores_cc` AS `hores_cc`,`ricca3_credits`.`hores_cr` AS `hores_cr`,`ricca3_ccomp`.`idprofessor` AS `idprofessor`,`ricca3_professors`.`nomicognoms` AS `nomicognoms`,`ricca3_ccomp`.`idtutor` AS `idtutor`,`ricca3_tutors`.`nomicognomstut` AS `nomicognomstut`,`ricca3_ccomp`.`actiu_cc` AS `actiu_cc`,`ricca3_credits`.`actiu_cr` AS `actiu_cr`,`ricca3_grups`.`actiu_gr` AS `actiu_gr`,`ricca3_especialitats`.`actiu_es` AS `actiu_es`,`ricca3_ccomp`.`nomccomp` AS `nomccomp`,`ricca3_credits`.`nomcredit` AS `nomcredit`,`ricca3_credits`.`ordre_cr` AS `ordre_cr`,`ricca3_credits`.`idespecialitat` AS `idespecialitat`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat` from (((((`ricca3_ccomp` join `ricca3_credits` on((`ricca3_credits`.`idcredit` = `ricca3_ccomp`.`idcredit`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_ccomp`.`idgrup`))) join `ricca3_professors` on((`ricca3_professors`.`idprof` = `ricca3_ccomp`.`idprofessor`))) join `ricca3_tutors` on((`ricca3_tutors`.`idprof` = `ricca3_ccomp`.`idtutor`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_credits`.`idespecialitat`))) order by `ricca3_credits`.`ordre_cr`,`ricca3_ccomp`.`idprofessor`;


--
-- Structure for view `ricca3_pla_view`
--
DROP TABLE IF EXISTS `ricca3_pla_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_pla_view` AS select `ricca3_pla`.`idpla` AS `idpla`,`ricca3_pla`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_pla`.`idccomp` AS `idccomp`,`ricca3_ccomp`.`nomccomp` AS `nomccomp`,`ricca3_ccomp`.`idcredit` AS `idcredit`,`ricca3_credits`.`nomcredit` AS `nomcredit`,`ricca3_credits`.`aval3nomes` AS `aval3nomes`,`ricca3_credits`.`ordre_cr` AS `ordre_cr`,`ricca3_credits`.`hores_cr` AS `hores_cr`,`ricca3_ccomp`.`idgrup` AS `idgrup`,`ricca3_ccomp`.`hores_cc` AS `hores_cc`,`ricca3_grups`.`grup` AS `grup`,`ricca3_grups`.`idcurs` AS `idcurs`,`ricca3_cursos`.`curs` AS `curs`,`ricca3_especialitats`.`idespecialitat` AS `idespecialitat`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat`,`ricca3_ccomp`.`idprofessor` AS `idprofessor`,`ricca3_professors`.`nomicognoms` AS `nomicognoms`,`ricca3_ccomp`.`idtutor` AS `idtutor`,`ricca3_tutors`.`nomicognomstut` AS `nomicognomstut` from ((((((((`ricca3_pla` join `ricca3_ccomp` on((`ricca3_ccomp`.`idccomp` = `ricca3_pla`.`idccomp`))) join `ricca3_any` on((`ricca3_any`.`idany` = `ricca3_pla`.`idany`))) join `ricca3_credits` on((`ricca3_credits`.`idcredit` = `ricca3_ccomp`.`idcredit`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_ccomp`.`idgrup`))) join `ricca3_professors` on((`ricca3_professors`.`idprof` = `ricca3_ccomp`.`idprofessor`))) join `ricca3_tutors` on((`ricca3_tutors`.`idprof` = `ricca3_ccomp`.`idtutor`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_grups`.`idespecialitat`))) join `ricca3_cursos` on((`ricca3_cursos`.`idcurs` = `ricca3_grups`.`idcurs`)));

-- --------------------------------------------------------
