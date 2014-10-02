CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca`.`ricca3_alumcredit_view` AS 
SELECT 
ricca3_credits_avaluacions.idcredaval AS idcredaval,
ricca3_credits_avaluacions.idany      AS idany,
ricca3_any.any                        AS any,
ricca3_credits_avaluacions.idccomp    AS idccomp,
ricca3_ccomp.nomccomp                 AS nomccomp,
ricca3_ccomp.idcredit                 AS idcredit,
ricca3_credits.idespecialitat         AS idespecialitat,
ricca3_especialitats.nomespecialitat  AS nomespecialitat,
ricca3_credits.idcurs                 AS idcurs,
ricca3_cursos.curs                    AS curs,
ricca3_ccomp.idgrup                   AS idgrup,
ricca3_grups.grup                     AS grup,
ricca3_ccomp.idprofessor              AS idprofessor,
ricca3_professors.nomicognoms         AS nomicognoms,
ricca3_ccomp.idtutor                  AS idtutor,
ricca3_tutors.nomicognomstut          AS nomicognomstut,
ricca3_ccomp.hores_cc                 AS hores_cc,
ricca3_credits.hores_cr               AS hores_cr,
ricca3_ccomp.actiu_cc                 AS actiu_cc,
ricca3_credits.actiu_cr               AS actiu_cr,
ricca3_credits.ordre_cr               AS ordre_cr,
ricca3_credits.nomcredit              AS nomcredit,
ricca3_credits_avaluacions.idalumne   AS idalumne,
ricca3_alumne.cognomsinom             AS cognomsinom,
ricca3_credits_avaluacions.nota1      AS nota1,
ricca3_credits_avaluacions.act1       AS act1,
ricca3_credits_avaluacions.nota2      AS nota2,
ricca3_credits_avaluacions.act2       AS act2,
ricca3_credits_avaluacions.nota3      AS nota3,
ricca3_credits_avaluacions.actf	      AS actf,
ricca3_credits_avaluacions.recup      AS recup,
ricca3_credits_avaluacions.notaf_cc   AS notaf_cc,
ricca3_credits_avaluacions.notaf_cr   AS notaf_cr,
ricca3_alumne_especialitat.notaf_es   AS notaf_es,
ricca3_alumne_especialitat.idestat_es AS idestat_es,
ricca3_credits_avaluacions.pendi      AS pendi,
ricca3_credits_avaluacions.repe       AS repe,
ricca3_credits_avaluacions.convord    AS convord,
ricca3_convord.conv                   AS convtext1,
ricca3_credits_avaluacions.convext1   AS convext1,
ricca3_convext1.conv                  AS convtext2,
ricca3_credits_avaluacions.convext2   AS convext2,
ricca3_convext2.conv                  AS convtext3

FROM ricca3_credits_avaluacions

INNER JOIN ricca3_any                 ON ricca3_any.idany                    = ricca3_credits_avaluacions.idany
INNER JOIN ricca3_ccomp               ON ricca3_ccomp.idccomp                = ricca3_credits_avaluacions.idccomp
INNER JOIN ricca3_credits             ON ricca3_credits.idcredit             = ricca3_ccomp.idcredit
INNER JOIN ricca3_grups               ON ricca3_grups.idgrup                 = ricca3_ccomp.idgrup
INNER JOIN ricca3_professors          ON ricca3_professors.idprof            = ricca3_ccomp.idprofessor
INNER JOIN ricca3_tutors              ON ricca3_tutors.idprof                = ricca3_ccomp.idtutor
INNER JOIN ricca3_alumne              ON ricca3_alumne.idalumne              = ricca3_credits_avaluacions.idalumne
INNER JOIN ricca3_convord             ON ricca3_convord.idany                = ricca3_credits_avaluacions.convord
INNER JOIN ricca3_convext1            ON ricca3_convext1.idany               = ricca3_credits_avaluacions.convext1
INNER JOIN ricca3_convext2            ON ricca3_convext2.idany               = ricca3_credits_avaluacions.convext2
INNER JOIN ricca3_especialitats       ON ricca3_especialitats.idespecialitat = ricca3_credits.idespecialitat
INNER JOIN ricca3_cursos              ON ricca3_cursos.idcurs                = ricca3_credits.idcurs
INNER JOIN ricca3_alumne_especialitat ON ricca3_alumne_especialitat.idalumne = ricca3_alumne.idalumne 
                                     AND ricca3_alumne_especialitat.idgrup   = ricca3_grups.idgrup

ORDER BY ricca3_grups.ordre_gr
