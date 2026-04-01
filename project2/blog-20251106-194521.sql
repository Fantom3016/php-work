-- AdminNeo 5.0.0 MySQL 8.0.43-0ubuntu0.24.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `blog`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `post` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `blog` (`id`, `title`, `date_created`, `post`) VALUES
(4,	'Test',	'2025-10-30 00:00:00',	'This is a test'),
(5,	'cooking today',	'2025-11-06 00:00:00',	'Made some sunflower seeds the other night and they turned out really good');

-- 2025-11-06 19:45:21 UTC
