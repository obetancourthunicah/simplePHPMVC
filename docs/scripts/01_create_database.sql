CREATE SCHEMA `ednamodasdb` ;
--SOLO PARA MYSQL < 8
CREATE USER 'ednayotra'@'%' IDENTIFIED BY 'j4rj4rRules4ever';
-- SOLO PARA MYSQL 8.0 >
--  CREATE USER 'ednayotra'@'%' IDENTIFIED WITH mysql_native_password BY 'j4rj4rRules4ever';
GRANT ALL ON ednamodasdb.* TO 'ednayotra'@'%';
