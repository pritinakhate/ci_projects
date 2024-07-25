-- Adminer 4.8.1 MySQL 5.5.5-10.4.10-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `photo` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `last_ip` varchar(255) NOT NULL,
  `access_details` text NOT NULL,
  `role` enum('Admin','User') NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `token_link` varchar(100) NOT NULL,
  `token_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `token`, `name`, `email_address`, `password`, `dob`, `gender`, `photo`, `last_login`, `last_ip`, `access_details`, `role`, `status`, `created`, `modified`, `token_link`, `token_created`) VALUES
(1,	'900150983cd24fb0d6963f7d28e17f72',	'Admin',	'admin@gmail.com',	'25f9e794323b453885f5181f1b624d0b',	'0000-00-00',	'Male',	'',	'2023-08-04 11:56:41',	'::1',	'Chrome 115.0.0.0',	'Admin',	'Active',	'2023-08-04 11:55:40',	'2023-08-04 11:56:41',	'',	'0000-00-00 00:00:00'),
(2,	'dd4fb7f0bd3bccf77f67dac3b619a8dd',	'Snow',	'snowbelly@gmail.com',	'b4af804009cb036a4ccdc33431ef9ac9',	'0000-00-00',	'Male',	'',	'2023-08-25 16:36:25',	'127.0.0.1',	'Firefox 116.0',	'Admin',	'Active',	'2023-08-04 13:33:22',	'2023-08-25 16:36:25',	'',	'0000-00-00 00:00:00'),
(3,	'baa82a4886d50424bb5fd60927d61e97',	'Belly',	'belly@gmail.com',	'25f9e794323b453885f5181f1b624d0b',	'0000-00-00',	'Male',	'',	'2023-08-04 14:00:13',	'127.0.0.1',	'Firefox 115.0',	'Admin',	'Active',	'2023-08-04 13:59:58',	'2023-08-04 14:00:13',	'',	'0000-00-00 00:00:00'),
(4,	'b78787068df8bdf92d17cafee1364bd3',	'Test',	'test123@gmail.com',	'25f9e794323b453885f5181f1b624d0b',	'0000-00-00',	'Male',	'',	'0000-00-00 00:00:00',	'',	'',	'Admin',	'Active',	'2023-08-25 16:33:21',	'0000-00-00 00:00:00',	'',	'0000-00-00 00:00:00'),
(5,	'17553ec7585dbb085fe840bd0ad57b07',	'Test',	'test12@gmail.com',	'b4af804009cb036a4ccdc33431ef9ac9',	'0000-00-00',	'Male',	'',	'2023-09-05 10:36:12',	'127.0.0.1',	'Firefox 117.0',	'Admin',	'Active',	'2023-08-25 16:34:12',	'2023-09-05 10:36:12',	'',	'0000-00-00 00:00:00'),
(6,	'8807079fdd16e3e704a293c4235eaf87',	'Test',	'test5509@gmail.com',	'b4af804009cb036a4ccdc33431ef9ac9',	'0000-00-00',	'Male',	'',	'0000-00-00 00:00:00',	'',	'',	'Admin',	'Active',	'2023-09-06 16:31:50',	'2023-09-06 17:01:06',	'',	'0000-00-00 00:00:00'),
(7,	'6f32b75703933dbe7dc382c5b7969877',	'Testname',	'test220011@gmail.com',	'25f9e794323b453885f5181f1b624d0b',	'0000-00-00',	'Male',	'',	'0000-00-00 00:00:00',	'',	'',	'Admin',	'Active',	'2023-09-06 16:42:59',	'2023-09-07 10:32:16',	'',	'2023-09-07 10:21:46');

-- 2023-09-07 05:21:29
