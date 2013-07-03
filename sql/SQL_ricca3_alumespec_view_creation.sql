SELECT
ricca3_alumne_especialitat.idalumespec,
ricca3_alumne_especialitat.idalumne,
ricca3_alumne.cognomsinom,
ricca3_alumne.telefon,
ricca3_alumne.telefonfixe,
ricca3_alumne.email,
ricca3_alumne_especialitat.idgrup,
ricca3_grups.grup,
ricca3_grups.sessio,
ricca3_grups.idcurs,
ricca3_cursos.curs,
ricca3_especialitats.nomespecialitat,
ricca3_especialitats.idespecialitat,
ricca3_alumne_especialitat.idany,
ricca3_any.any,
ricca3_alumne_especialitat.idestat_es,
ricca3_estat.estat,
ricca3_alumne.idhistorial,
ricca3_alumne_especialitat.notaf_es,
ricca3_alumne_especialitat.notaf_es_manual,
ricca3_alumne_especialitat.repeteix,
ricca3_alumne_especialitat.observ1,
ricca3_alumne_especialitat.observ2,
ricca3_alumne_especialitat.observ3,
ricca3_alumne_especialitat.motiubaixa,
ricca3_alumne_especialitat.databaixa,
ricca3_alumne_especialitat.abonament,
ricca3_alumne_especialitat.datainscripcio


FROM ricca3_alumne_especialitat

INNER JOIN ricca3_alumne ON ricca3_alumne.idalumne=ricca3_alumne_especialitat.idalumne
INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_alumne_especialitat.idany
INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_alumne_especialitat.idgrup
INNER JOIN ricca3_cursos ON ricca3_cursos.idcurs = ricca3_grups.idcurs
INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_grups.idespecialitat
INNER JOIN ricca3_estat ON ricca3_estat.idestat = ricca3_alumne_especialitat.idestat_es

ORDER BY cognomsinom
