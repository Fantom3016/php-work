-- AdminNeo 5.0.0 MySQL 8.0.43-0ubuntu0.24.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `badlibs`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `badlibs`;
CREATE TABLE `badlibs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `noun` varchar(250) DEFAULT NULL,
  `verb` varchar(250) DEFAULT NULL,
  `adjective` varchar(250) DEFAULT NULL,
  `adverb` varchar(250) DEFAULT NULL,
  `story` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `badlibs` (`id`, `noun`, `verb`, `adjective`, `adverb`, `story`) VALUES
(22,	'apple',	'eat',	'wide',	'fast',	'I really hate eat! I always feel wide after and it fast makes my apple unhappy!'),
(23,	'person',	'run',	'tall',	'slowly',	'I really hate run! I always feel tall after and it slowly makes my person unhappy!'),
(24,	'person',	'run',	'tall',	'slowly',	'I really hate run! I always feel tall after and it slowly makes my person unhappy!');

-- 2025-10-16 15:44:04 UTC
