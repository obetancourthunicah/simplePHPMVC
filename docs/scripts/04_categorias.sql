CREATE TABLE `dynapolls`.`categorias` (
  `ctgcod` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ctgdsc` VARCHAR(70) NOT NULL,
  `ctgest` CHAR(3) NOT NULL DEFAULT 'ACT',
  PRIMARY KEY (`ctgcod`));

INSERT INTO `dynapolls`.`categorias` (`ctgdsc`, `ctgest`) VALUES ('Social', 'ACT');
INSERT INTO `dynapolls`.`categorias` (`ctgdsc`, `ctgest`) VALUES ('Político', 'ACT');
INSERT INTO `dynapolls`.`categorias` (`ctgdsc`, `ctgest`) VALUES ('Salud', 'ACT');
