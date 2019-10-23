CREATE TABLE `productos` (
  `prdcod` BIGINT(18) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prddsc` VARCHAR(45) NULL,
  `prdprc` DECIMAL(18,4) NULL,
  `catcod` INT(4) UNSIGNED NOT NULL,
  `prdImgPrm` VARCHAR(255) NULL,
  `prdImgScd` VARCHAR(255) NULL,
  PRIMARY KEY (`prdcod`));
