CREATE SCHEMA `dynapolls` ;
-- Mysql < 8
 CREATE USER 'dynauser'@'%' IDENTIFIED BY 'fr4nc1scanus';
-- Mysql >= 8
-- CREATE USER 'dynauser'@'%' IDENTIFIED WITH mysql_native_password BY 'fr4nc1scanus';
GRANT ALL ON dynapolls.* TO 'dynauser'@'%';
