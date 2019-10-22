CREATE SCHEMA `nw201903` ;
-- Mysql < 8
-- CREATE USER 'demouser'@'%' IDENTIFIED BY 'carm3l1t4s';
-- Mysql >= 8  or MariaDB
CREATE USER 'nw201903'@'%' IDENTIFIED WITH mysql_native_password BY 'carm3l1t4s';
GRANT ALL ON nw201903.* TO 'demouser'@'%';
