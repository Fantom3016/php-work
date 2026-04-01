-- AdminNeo 5.0.0 MySQL 8.0.44-0ubuntu0.24.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `exercise`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `exercise_log`;
CREATE TABLE `exercise_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `exercise_id` int NOT NULL,
  `date` date NOT NULL,
  `exercise_type` varchar(50) DEFAULT NULL,
  `time_in_minutes` int DEFAULT NULL,
  `heartrate` int DEFAULT NULL,
  `calories` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exercise_id` (`exercise_id`),
  CONSTRAINT `exercise_log_ibfk_1` FOREIGN KEY (`exercise_id`) REFERENCES `exercise_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `exercise_log` (`id`, `exercise_id`, `date`, `exercise_type`, `time_in_minutes`, `heartrate`, `calories`) VALUES
(7,	28,	'2025-12-01',	'Weightlifting',	10,	182,	131.332);

DROP TABLE IF EXISTS `exercise_user`;
CREATE TABLE `exercise_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `birthdate` date NOT NULL,
  `weight` varchar(200) NOT NULL,
  `password_hash` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `access_privileges` varchar(200) NOT NULL DEFAULT 'user',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image_file` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `exercise_user` (`id`, `user_name`, `first_name`, `last_name`, `gender`, `birthdate`, `weight`, `password_hash`, `access_privileges`, `date_created`, `image_file`) VALUES
(28,	'Student',	'Mary',	'Williams',	'Female',	'1999-10-16',	'139',	'$2y$10$LMjNv6oGxujuqDGvdCeSjeQCHZGtaG4v4k0NpzrXdcVMjAE8i0MIe',	'admin',	'2025-12-11 13:27:19',	'/var/www/html/projects/project3/images/istockphoto-1326417862-612x612.jpg'),
(30,	'BoB',	'Donald',	'Duck',	'Male',	'2011-12-25',	'225',	'$2y$10$H21LHa4H6.O3Dc9ovPwjheeufEc775D53L58.H3R08Va9iJ8x2s.W',	'user',	'2025-12-11 13:44:06',	'/var/www/html/projects/project3/images/Donald_Duck_angry_transparent_background.png'),
(33,	'the rock',	'Rock',	'Johnson',	'Male',	'2012-12-25',	'245',	'$2y$10$dCI6lFfWk.vpUnOSvSk1b.xHjNF9DBlxyKN4vFILZl/gDQEyCizNe',	'user',	'2025-12-12 10:35:43',	'/var/www/html/projects/project3/images/John_Cena_by_Gage_Skidmore.jpg'),
(34,	'ICU',	'John',	'Cena',	'Male',	'1985-05-25',	'269',	'$2y$10$DTURDZoDl.NrfWvVZvGeZu.7uMuDg50kkdSriTdwmdBx7Dl/WrzJW',	'user',	'2025-12-12 10:38:41',	'/var/www/html/projects/project3/images/John_Cena_by_Gage_Skidmore.jpg');

-- 2025-12-12 16:40:31 UTC
