CREATE TABLE `modas` (
  `idmoda` BIGINT(15) NOT NULL AUTO_INCREMENT,
  `dscmoda` VARCHAR(60) NOT NULL,
  `blogmoda` MEDIUMTEXT NULL,
  `bannermod` VARCHAR(512) NULL,
  `thumbmoda` VARCHAR(512) NULL,
  `modelmoda` VARCHAR(512) NULL,
  `prcmoda` DECIMAL(15,2) NULL,
  `ivamoda` DECIMAL(5,2) NULL,
  `estmoda` CHAR(3) NULL,
  `idcategoria` BIGINT(15) NULL,
  PRIMARY KEY (`idmoda`));
