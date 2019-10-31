CREATE TABLE `categorias` (
  `catcod` int(4) unsigned NOT NULL,
  `catdsc` varchar(45) DEFAULT NULL,
  `catest` char(5) DEFAULT NULL,
  PRIMARY KEY (`catcod`)
);
ALTER TABLE `categorias` 
CHANGE COLUMN `catcod` `catcod` INT(4) UNSIGNED NOT NULL AUTO_INCREMENT ;
