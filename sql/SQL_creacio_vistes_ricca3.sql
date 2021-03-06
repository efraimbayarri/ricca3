--
-- Structure for view `ricca3_tutors`
--
DROP VIEW IF EXISTS `ricca3_tutors`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_tutors` AS select `ricca3_professors`.`idprof` AS `idprof`,`ricca3_professors`.`idtutor` AS `idtutor`,`ricca3_professors`.`nomicognoms` AS `nomicognomstut`,`ricca3_professors`.`telcasa` AS `telcasa`,`ricca3_professors`.`telcont1` AS `telcont1`,`ricca3_professors`.`telcont2` AS `telcont2`,`ricca3_professors`.`telcont3` AS `telcont3`,`ricca3_professors`.`email` AS `email`,`ricca3_professors`.`ts` AS `ts`,`ricca3_professors`.`stampuser` AS `stampuser`,`ricca3_professors`.`stampplace` AS `stampplace` from `ricca3_professors`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_convext1`
--
DROP VIEW IF EXISTS `ricca3_convext1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_convext1` AS select `ricca3_any`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_any`.`actual` AS `actual`,`ricca3_any`.`insc` AS `insc`,`ricca3_any`.`conv` AS `conv`,`ricca3_any`.`ts` AS `ts`,`ricca3_any`.`stampuser` AS `stampuser`,`ricca3_any`.`stampplace` AS `stampplace` from `ricca3_any`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_convext2`
--
DROP VIEW IF EXISTS `ricca3_convext2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_convext2` AS select `ricca3_any`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_any`.`actual` AS `actual`,`ricca3_any`.`insc` AS `insc`,`ricca3_any`.`conv` AS `conv`,`ricca3_any`.`ts` AS `ts`,`ricca3_any`.`stampuser` AS `stampuser`,`ricca3_any`.`stampplace` AS `stampplace` from `ricca3_any`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_convord`
--
DROP VIEW IF EXISTS `ricca3_convord`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_convord` AS select `ricca3_any`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_any`.`actual` AS `actual`,`ricca3_any`.`insc` AS `insc`,`ricca3_any`.`conv` AS `conv`,`ricca3_any`.`ts` AS `ts`,`ricca3_any`.`stampuser` AS `stampuser`,`ricca3_any`.`stampplace` AS `stampplace` from `ricca3_any`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_alumccomprepe_view`
--
DROP VIEW IF EXISTS `ricca3_alumccomprepe_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_alumccomprepe_view` AS select distinct `ricca3_credits_avaluacions`.`idcredaval` AS `idcredaval`,`ricca3_credits_avaluacions`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_alumne`.`cognomsinom` AS `cognomsinom`,`ricca3_alumne`.`idalumne` AS `idalumne`,`ricca3_credits_avaluacions`.`idccomp` AS `idccomp`,`ricca3_ccomp`.`nomccomp` AS `nomccomp`,`ricca3_ccomp`.`idcredit` AS `idcredit`,`ricca3_credits`.`nomcredit` AS `nomcredit`,`ricca3_credits`.`aval3nomes` AS `aval3nomes`,`ricca3_credits`.`idespecialitat` AS `idespecialitat`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat`,`ricca3_credits`.`idcurs` AS `idcurs`,`ricca3_credits`.`ordre_cr` AS `ordre_cr`,`ricca3_ccomp`.`idgrup` AS `idgrup`,`ricca3_grups`.`grup` AS `grup`,`ricca3_ccomp`.`idprofessor` AS `idprofessor`,`ricca3_professors`.`nomicognoms` AS `nomicognoms`,`ricca3_ccomp`.`idtutor` AS `idtutor`,`ricca3_tutors`.`nomicognomstut` AS `nomicognomstut` from ((((((((`ricca3_credits_avaluacions` join `ricca3_alumne` on((`ricca3_alumne`.`idalumne` = `ricca3_credits_avaluacions`.`idalumne`))) join `ricca3_ccomp` on((`ricca3_ccomp`.`idccomp` = `ricca3_credits_avaluacions`.`idccomp`))) join `ricca3_credits` on((`ricca3_credits`.`idcredit` = `ricca3_ccomp`.`idcredit`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_ccomp`.`idgrup`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_credits`.`idespecialitat`))) join `ricca3_professors` on((`ricca3_professors`.`idprof` = `ricca3_ccomp`.`idprofessor`))) join `ricca3_tutors` on((`ricca3_tutors`.`idtutor` = `ricca3_ccomp`.`idtutor`))) join `ricca3_any` on((`ricca3_any`.`idany` = `ricca3_credits_avaluacions`.`idany`))) where (`ricca3_credits_avaluacions`.`repe` = 'R') order by `ricca3_alumne`.`cognomsinom`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_alumcredit_view`
--
DROP VIEW IF EXISTS `ricca3_alumcredit_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_alumcredit_view` AS select `ricca3_credits_avaluacions`.`idcredaval` AS `idcredaval`,`ricca3_credits_avaluacions`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_credits_avaluacions`.`idccomp` AS `idccomp`,`ricca3_ccomp`.`nomccomp` AS `nomccomp`,`ricca3_ccomp`.`idcredit` AS `idcredit`,`ricca3_credits`.`idespecialitat` AS `idespecialitat`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat`,`ricca3_credits`.`idcurs` AS `idcurs`,`ricca3_cursos`.`curs` AS `curs`,`ricca3_ccomp`.`idgrup` AS `idgrup`,`ricca3_grups`.`grup` AS `grup`,`ricca3_ccomp`.`idprofessor` AS `idprofessor`,`ricca3_professors`.`nomicognoms` AS `nomicognoms`,`ricca3_ccomp`.`idtutor` AS `idtutor`,`ricca3_tutors`.`nomicognomstut` AS `nomicognomstut`,`ricca3_ccomp`.`hores_cc` AS `hores_cc`,`ricca3_credits`.`hores_cr` AS `hores_cr`,`ricca3_ccomp`.`actiu_cc` AS `actiu_cc`,`ricca3_credits`.`actiu_cr` AS `actiu_cr`,`ricca3_credits`.`ordre_cr` AS `ordre_cr`,`ricca3_credits`.`nomcredit` AS `nomcredit`,`ricca3_credits_avaluacions`.`idalumne` AS `idalumne`,`ricca3_alumne`.`cognomsinom` AS `cognomsinom`,`ricca3_credits_avaluacions`.`nota1` AS `nota1`,`ricca3_credits_avaluacions`.`act1` AS `act1`,`ricca3_credits_avaluacions`.`nota2` AS `nota2`,`ricca3_credits_avaluacions`.`act2` AS `act2`,`ricca3_credits_avaluacions`.`nota3` AS `nota3`,`ricca3_credits_avaluacions`.`actf` AS `actf`,`ricca3_credits_avaluacions`.`recup` AS `recup`,`ricca3_credits_avaluacions`.`notaf_cc` AS `notaf_cc`,`ricca3_credits_avaluacions`.`notaf_cr` AS `notaf_cr`,`ricca3_alumne_especialitat`.`notaf_es` AS `notaf_es`,`ricca3_alumne_especialitat`.`idestat_es` AS `idestat_es`,`ricca3_credits_avaluacions`.`pendi` AS `pendi`,`ricca3_credits_avaluacions`.`repe` AS `repe`,`ricca3_credits_avaluacions`.`convord` AS `convord`,`ricca3_convord`.`conv` AS `convtext1`,`ricca3_credits_avaluacions`.`convext1` AS `convext1`,`ricca3_convext1`.`conv` AS `convtext2`,`ricca3_credits_avaluacions`.`convext2` AS `convext2`,`ricca3_convext2`.`conv` AS `convtext3` from (((((((((((((`ricca3_credits_avaluacions` join `ricca3_any` on((`ricca3_any`.`idany` = `ricca3_credits_avaluacions`.`idany`))) join `ricca3_ccomp` on((`ricca3_ccomp`.`idccomp` = `ricca3_credits_avaluacions`.`idccomp`))) join `ricca3_credits` on((`ricca3_credits`.`idcredit` = `ricca3_ccomp`.`idcredit`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_ccomp`.`idgrup`))) join `ricca3_professors` on((`ricca3_professors`.`idprof` = `ricca3_ccomp`.`idprofessor`))) join `ricca3_tutors` on((`ricca3_tutors`.`idprof` = `ricca3_ccomp`.`idtutor`))) join `ricca3_alumne` on((`ricca3_alumne`.`idalumne` = `ricca3_credits_avaluacions`.`idalumne`))) join `ricca3_convord` on((`ricca3_convord`.`idany` = `ricca3_credits_avaluacions`.`convord`))) join `ricca3_convext1` on((`ricca3_convext1`.`idany` = `ricca3_credits_avaluacions`.`convext1`))) join `ricca3_convext2` on((`ricca3_convext2`.`idany` = `ricca3_credits_avaluacions`.`convext2`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_credits`.`idespecialitat`))) join `ricca3_cursos` on((`ricca3_cursos`.`idcurs` = `ricca3_credits`.`idcurs`))) join `ricca3_alumne_especialitat` on(((`ricca3_alumne_especialitat`.`idalumne` = `ricca3_alumne`.`idalumne`) and (`ricca3_alumne_especialitat`.`idgrup` = `ricca3_grups`.`idgrup`)))) order by `ricca3_grups`.`ordre_gr`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_alumespec_view`
--
DROP VIEW IF EXISTS `ricca3_alumespec_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_alumespec_view` AS select `ricca3_alumne_especialitat`.`idalumespec` AS `idalumespec`,`ricca3_alumne_especialitat`.`idalumne` AS `idalumne`,`ricca3_alumne`.`cognomsinom` AS `cognomsinom`,`ricca3_alumne`.`telefon` AS `telefon`,`ricca3_alumne`.`telefonfixe` AS `telefonfixe`,`ricca3_alumne`.`dni` AS `dni`,`ricca3_alumne`.`email` AS `email`,`ricca3_alumne_especialitat`.`idgrup` AS `idgrup`,`ricca3_grups`.`grup` AS `grup`,`ricca3_grups`.`sessio` AS `sessio`,`ricca3_grups`.`idcurs` AS `idcurs`,`ricca3_cursos`.`curs` AS `curs`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat`,`ricca3_especialitats`.`idespecialitat` AS `idespecialitat`,`ricca3_alumne_especialitat`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_alumne_especialitat`.`idestat_es` AS `idestat_es`,`ricca3_estat`.`estat` AS `estat`,`ricca3_alumne`.`idhistorial` AS `idhistorial`,`ricca3_alumne_especialitat`.`notaf_es` AS `notaf_es`,`ricca3_alumne_especialitat`.`notaf_es_manual` AS `notaf_es_manual`,`ricca3_alumne_especialitat`.`repeteix` AS `repeteix`,`ricca3_alumne_especialitat`.`observ1` AS `observ1`,`ricca3_alumne_especialitat`.`observ2` AS `observ2`,`ricca3_alumne_especialitat`.`observ3` AS `observ3`,`ricca3_alumne_especialitat`.`motiubaixa` AS `motiubaixa`,`ricca3_alumne_especialitat`.`databaixa` AS `databaixa`,`ricca3_alumne_especialitat`.`abonament` AS `abonament`,`ricca3_alumne_especialitat`.`datainscripcio` AS `datainscripcio` from ((((((`ricca3_alumne_especialitat` join `ricca3_alumne` on((`ricca3_alumne`.`idalumne` = `ricca3_alumne_especialitat`.`idalumne`))) join `ricca3_any` on((`ricca3_any`.`idany` = `ricca3_alumne_especialitat`.`idany`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_alumne_especialitat`.`idgrup`))) join `ricca3_cursos` on((`ricca3_cursos`.`idcurs` = `ricca3_grups`.`idcurs`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_grups`.`idespecialitat`))) join `ricca3_estat` on((`ricca3_estat`.`idestat` = `ricca3_alumne_especialitat`.`idestat_es`))) order by `ricca3_alumne`.`cognomsinom`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_ccomp_view`
--
DROP VIEW IF EXISTS `ricca3_ccomp_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_ccomp_view` AS select `ricca3_ccomp`.`idccomp` AS `idccomp`,`ricca3_ccomp`.`idcredit` AS `idcredit`,`ricca3_ccomp`.`idgrup` AS `idgrup`,`ricca3_grups`.`grup` AS `grup`,`ricca3_ccomp`.`hores_cc` AS `hores_cc`,`ricca3_credits`.`hores_cr` AS `hores_cr`,`ricca3_ccomp`.`idprofessor` AS `idprofessor`,`ricca3_professors`.`nomicognoms` AS `nomicognoms`,`ricca3_ccomp`.`idtutor` AS `idtutor`,`ricca3_tutors`.`nomicognomstut` AS `nomicognomstut`,`ricca3_ccomp`.`actiu_cc` AS `actiu_cc`,`ricca3_credits`.`actiu_cr` AS `actiu_cr`,`ricca3_grups`.`actiu_gr` AS `actiu_gr`,`ricca3_especialitats`.`actiu_es` AS `actiu_es`,`ricca3_ccomp`.`nomccomp` AS `nomccomp`,`ricca3_credits`.`nomcredit` AS `nomcredit`,`ricca3_credits`.`ordre_cr` AS `ordre_cr`,`ricca3_credits`.`idespecialitat` AS `idespecialitat`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat` from (((((`ricca3_ccomp` join `ricca3_credits` on((`ricca3_credits`.`idcredit` = `ricca3_ccomp`.`idcredit`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_ccomp`.`idgrup`))) join `ricca3_professors` on((`ricca3_professors`.`idprof` = `ricca3_ccomp`.`idprofessor`))) join `ricca3_tutors` on((`ricca3_tutors`.`idprof` = `ricca3_ccomp`.`idtutor`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_credits`.`idespecialitat`))) order by `ricca3_credits`.`ordre_cr`,`ricca3_ccomp`.`idprofessor`;

-- --------------------------------------------------------

--
-- Structure for view `ricca3_pla_view`
--
DROP VIEW IF EXISTS `ricca3_pla_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ricca3_pla_view` AS select `ricca3_pla`.`idpla` AS `idpla`,`ricca3_pla`.`idany` AS `idany`,`ricca3_any`.`any` AS `any`,`ricca3_pla`.`idccomp` AS `idccomp`,`ricca3_ccomp`.`nomccomp` AS `nomccomp`,`ricca3_ccomp`.`idcredit` AS `idcredit`,`ricca3_credits`.`nomcredit` AS `nomcredit`,`ricca3_credits`.`aval3nomes` AS `aval3nomes`,`ricca3_credits`.`ordre_cr` AS `ordre_cr`,`ricca3_credits`.`hores_cr` AS `hores_cr`,`ricca3_ccomp`.`idgrup` AS `idgrup`,`ricca3_ccomp`.`hores_cc` AS `hores_cc`,`ricca3_grups`.`grup` AS `grup`,`ricca3_grups`.`idcurs` AS `idcurs`,`ricca3_cursos`.`curs` AS `curs`,`ricca3_especialitats`.`idespecialitat` AS `idespecialitat`,`ricca3_especialitats`.`nomespecialitat` AS `nomespecialitat`,`ricca3_ccomp`.`idprofessor` AS `idprofessor`,`ricca3_professors`.`nomicognoms` AS `nomicognoms`,`ricca3_ccomp`.`idtutor` AS `idtutor`,`ricca3_tutors`.`nomicognomstut` AS `nomicognomstut` from ((((((((`ricca3_pla` join `ricca3_ccomp` on((`ricca3_ccomp`.`idccomp` = `ricca3_pla`.`idccomp`))) join `ricca3_any` on((`ricca3_any`.`idany` = `ricca3_pla`.`idany`))) join `ricca3_credits` on((`ricca3_credits`.`idcredit` = `ricca3_ccomp`.`idcredit`))) join `ricca3_grups` on((`ricca3_grups`.`idgrup` = `ricca3_ccomp`.`idgrup`))) join `ricca3_professors` on((`ricca3_professors`.`idprof` = `ricca3_ccomp`.`idprofessor`))) join `ricca3_tutors` on((`ricca3_tutors`.`idprof` = `ricca3_ccomp`.`idtutor`))) join `ricca3_especialitats` on((`ricca3_especialitats`.`idespecialitat` = `ricca3_grups`.`idespecialitat`))) join `ricca3_cursos` on((`ricca3_cursos`.`idcurs` = `ricca3_grups`.`idcurs`)));

-- --------------------------------------------------------
