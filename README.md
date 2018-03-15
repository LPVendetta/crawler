# crawler
Crawler Prova PHP

CONFIGURAÇÃO BD:
  Alterar $Host, $Usuario, $Senha, $Nomebanco em src/ClasseBanco.php

BANCO DE DADOS:
CREATE DATABASE `webx`;
USE `webx`;

CREATE TABLE `webx`.`urls`(
	`id` INT NOT NULL AUTO_INCREMENT ,
	`url` VARCHAR(255) ,
	`visited` ENUM('yes','no') DEFAULT 'no' ,
	PRIMARY KEY (`id`) );

CREATE TABLE `webx`.`emails`(
	`id` INT NOT NULL AUTO_INCREMENT ,
	`email` VARCHAR(255) ,
	PRIMARY KEY (`id`)  );

INSERT INICIAL: INSERT INTO `webx`.`urls`(url) VALUES('https://www.google.com.br/?gfe_rd=ctrl&ei=9xcNU6uRGYfJ8Qa-moHwAg&gws_rd=cr#q=webx&safe=off');

