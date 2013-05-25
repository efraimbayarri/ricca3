SELECT 
ricca3_pla.idpla,
ricca3_pla.idany,
ricca3_any.any,
ricca3_pla.idccomp,
ricca3_ccomp.nomccomp,
ricca3_ccomp.idcredit,
ricca3_credits.nomcredit,
ricca3_credits.aval3nomes,
ricca3_credits.ordre_cr,
ricca3_credits.hores_cr,
ricca3_ccomp.idgrup,
ricca3_ccomp.hores_cc,
ricca3_grups.grup,
ricca3_grups.idcurs,
ricca3_cursos.curs,
ricca3_especialitats.idespecialitat,
ricca3_especialitats.nomespecialitat,
ricca3_ccomp.idprofessor,
ricca3_professors.nomicognoms,
ricca3_ccomp.idtutor,
ricca3_tutors.nomicognomstut

FROM ricca3_pla

INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_pla.idccomp
INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_pla.idany
INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit
INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup
INNER JOIN ricca3_professors ON ricca3_professors.idprof = ricca3_ccomp.idprofessor
INNER JOIN ricca3_tutors ON ricca3_tutors.idprof = ricca3_ccomp.idtutor
INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_grups.idespecialitat
INNER JOIN ricca3_cursos ON ricca3_cursos.idcurs = ricca3_grups.idcurs

