CREATE TABLE `almacenes` (
  `almcod` BIGINT(18) NOT NULL AUTO_INCREMENT,
  `almdsc` VARCHAR(75) NULL,
  `almtyp` CHAR(3) NULL,
  `almest` CHAR(3) NULL,
  PRIMARY KEY (`almcod`),
  INDEX `IALMTYP` (`almtyp` ASC),
  INDEX `IALMEST` (`almest` ASC));
