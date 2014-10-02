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

