CREATE TABLE `factura` (
  `fctcod` bigint(18) NOT NULL AUTO_INCREMENT,
  `fctfch` datetime DEFAULT NULL,
  `userCode` bigint(18) unsigned DEFAULT NULL,
  `fctEst` char(3) DEFAULT NULL,
  `fctMonto` decimal(13,2) DEFAULT NULL,
  `fctIva` decimal(13,2) DEFAULT NULL,
  `fctShip` decimal(13,2) DEFAULT NULL,
  `fctTotal` decimal(13,2) DEFAULT NULL,
  `fctPayRef` varchar(255) DEFAULT NULL,
  `fctShpAddr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fctcod`)
) ENGINE=InnoDB;


CREATE TABLE `factura_detalle` (
  `fctcod` bigint(18) NOT NULL,
  `codprd` bigint(18) NOT NULL,
  `fctDsc` varchar(70) DEFAULT NULL,
  `fctCtd` int(5) DEFAULT NULL,
  `fctPrc` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`fctcod`,`codprd`)
) ENGINE=InnoDB;

CREATE TABLE `factura_forma_pago` (
  `fctcod` bigint(18) NOT NULL,
  `fctfrmpago` varchar(45) NOT NULL,
  `fctfrmdata` mediumtext,
  PRIMARY KEY (`fctcod`,`fctfrmpago`)
) ENGINE=InnoDB;
