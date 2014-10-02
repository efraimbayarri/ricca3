select DISTINCT
ricca3_credits_avaluacions.idcredaval,
ricca3_credits_avaluacions.idany,
ricca3_any.any,
ricca3_alumne.cognomsinom,
ricca3_alumne.idalumne,
ricca3_credits_avaluacions.idccomp,
ricca3_ccomp.nomccomp,
ricca3_ccomp.idcredit,
ricca3_credits.nomcredit,
ricca3_credits.aval3nomes,
ricca3_credits.idespecialitat,
ricca3_especialitats.nomespecialitat,
ricca3_credits.idcurs,
ricca3_credits.ordre_cr,
ricca3_ccomp.idgrup,
ricca3_grups.grup,
ricca3_ccomp.idprofessor,
ricca3_professors.nomicognoms,
ricca3_ccomp.idtutor,
ricca3_tutors.nomicognomstut

FROM ricca3_credits_avaluacions

INNER JOIN ricca3_alumne ON ricca3_alumne.idalumne = ricca3_credits_avaluacions.idalumne
INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp
INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit
INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup
INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_credits.idespecialitat
INNER JOIN ricca3_professors ON ricca3_professors.idprof = ricca3_ccomp.idprofessor
INNER JOIN ricca3_tutors ON ricca3_tutors.idtutor = ricca3_ccomp.idtutor
INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_credits_avaluacions.idany

WHERE ricca3_credits_avaluacions.repe = 'R'
ORDER BY cognomsinom
