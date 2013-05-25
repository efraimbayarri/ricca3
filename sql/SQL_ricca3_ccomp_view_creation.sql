SELECT
ricca3_ccomp.idccomp,
ricca3_ccomp.idcredit,
ricca3_ccomp.idgrup,
ricca3_grups.grup,
ricca3_ccomp.hores_cc,
ricca3_credits.hores_cr,
ricca3_ccomp.idprofessor,
ricca3_professors.nomicognoms,
ricca3_ccomp.idtutor,
ricca3_tutors.nomicognomstut,
ricca3_ccomp.actiu_cc,
ricca3_credits.actiu_cr,
ricca3_grups.actiu_gr,
ricca3_especialitats.actiu_es,
ricca3_ccomp.nomccomp,
ricca3_credits.nomcredit,
ricca3_credits.ordre_cr,
ricca3_credits.idespecialitat,
ricca3_especialitats.nomespecialitat

FROM ricca.ricca3_ccomp

INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit
INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup
INNER JOIN ricca3_professors ON ricca3_professors.idprof = ricca3_ccomp.idprofessor
INNER JOIN ricca3_tutors ON ricca3_tutors.idprof = ricca3_ccomp.idtutor
INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_credits.idespecialitat

ORDER BY ordre_cr ASC, ricca3_ccomp.idprofessor ASC

