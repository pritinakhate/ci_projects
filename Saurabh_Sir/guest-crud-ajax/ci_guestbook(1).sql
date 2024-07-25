-- Adminer 4.8.1 MySQL 5.5.5-10.4.10-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO `cities` (`id`, `token`, `state_id`, `city_name`, `status`, `created`, `modified`) VALUES
(1,	'faa39a62417e90f77bdfd843ec29f656',	2,	'Surat',	'Active',	'2023-08-04 13:55:51',	'0000-00-00 00:00:00'),
(2,	'461da0a0b0b44404130ac942a824a63d',	2,	'Jamnagar',	'Active',	'2023-08-04 13:56:02',	'0000-00-00 00:00:00'),
(3,	'9eaa704df5556b49a7d12f986d47dc27',	1,	'Nagpur',	'Active',	'2023-08-04 13:56:09',	'0000-00-00 00:00:00'),
(4,	'9c9437489ee8566d8c256d26c8bb61b1',	1,	'Mumbai',	'Active',	'2023-08-04 13:56:17',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `country_flag` varchar(255) NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `countries` (`id`, `token`, `country_name`, `country_code`, `country_flag`, `status`, `created`, `modified`) VALUES
(1,	'7ca5d993fe3498a2efe47a7dc7a753a6',	'India',	'91',	'37461bdb3e7ac8a957562ed834566ee4.jpeg',	'Active',	'2023-08-04 13:55:20',	'0000-00-00 00:00:00'),
(2,	'7ca5d993fe3498a2efe47a7dc7a753a7',	'Sri Lanka',	'91',	'37461bdb3e7ac8a957562ed834566ee4.jpeg',	'Active',	'2023-08-04 13:55:20',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `guests`;
CREATE TABLE `guests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `hobby_id` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `details_about_guest` text NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO `guests` (`id`, `token`, `user_id`, `name`, `email_address`, `address`, `dob`, `gender`, `country_id`, `state_id`, `city_id`, `hobby_id`, `photo`, `details_about_guest`, `status`, `created`, `modified`) VALUES
(1,	'9568522804c7e76bb9941bf2d781fce4',	2,	'Test',	'test@gmail.com',	'Nagpur',	'2023-08-01',	'Male',	1,	1,	1,	' 2',	'e397377b0cf902d4534af78700d626d9.png',	'<p>nagpur</p>',	'Active',	'2023-08-04 13:47:02',	'0000-00-00 00:00:00'),
(2,	'233ddfa03ef33d352a48bde63807d920',	8,	'Snow BElly',	'snowbelly@gmail.com',	'Nagpur',	'2023-09-11',	'Female',	1,	1,	3,	' 3,  4',	'4b183fdada11d7ebce498d86e1df0c7b.png',	'<p><em><strong>Nagpur </strong></em></p>',	'Active',	'2023-09-12 10:56:14',	'0000-00-00 00:00:00'),
(3,	'93c605b0cb7b8c9ba6b384b8fb286a6d',	9,	'Vaishnavi',	'vaishnavsdfdsfdsfs@gmail.com',	'Hghgfhgfgfg',	'2023-09-04',	'Female',	1,	1,	3,	' 3,  4',	'08bf5ee67d3b03c227128db1d754ba45.png',	'<p>jhgjkfgjfjf</p>',	'Block',	'2023-09-13 10:17:47',	'2023-09-15 11:00:41'),
(5,	'3c1b082431b9d5dcc406d8fe1c2293c2',	9,	'Komal',	'vaishnavi@gmail.com',	'Nagpur',	'2023-09-05',	'Female',	1,	1,	3,	' 3,  4',	'd81bc4e6a5c5ee6b48daa0409388d4d0.jpeg',	'<p>cbkjdhkcjkl</p>',	'Active',	'2023-09-15 10:32:00',	'2023-09-15 10:32:28'),
(6,	'b0c837ceaabc222b88b451ce95e25878',	9,	'Snow',	'snowbelly123456@gmail.com',	'CANADA',	'1992-12-02',	'Female',	1,	2,	2,	'4',	'',	'That Is Testing Content',	'Active',	'2023-09-18 10:41:59',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `guest_logs`;
CREATE TABLE `guest_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `hobby_id` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `details_about_guest` text NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO `guest_logs` (`id`, `token`, `guest_id`, `name`, `email_address`, `address`, `dob`, `gender`, `country_id`, `state_id`, `city_id`, `hobby_id`, `photo`, `details_about_guest`, `status`, `created`, `modified`) VALUES
(1,	'3c1b082431b9d5dcc406d8fe1c2293c2',	5,	'Komal',	'komal@gmail.com',	'Nagpur',	'2023-09-05',	'Female',	1,	1,	3,	' 3,  4',	'',	'<p>cbkjdhkcjkl</p>',	'Active',	'2023-09-15 10:32:28',	'0000-00-00 00:00:00'),
(2,	'93c605b0cb7b8c9ba6b384b8fb286a6d',	3,	'Vaishnavi',	'vaishnavi@gmail.com',	'Hghgfhgfgfg',	'2023-09-04',	'Female',	1,	1,	3,	' 3,  4',	'',	'<p>jhgjkfgjfjf</p>',	'Block',	'2023-09-15 11:00:41',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `hobbies`;
CREATE TABLE `hobbies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `hobby_title` varchar(255) NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO `hobbies` (`id`, `token`, `hobby_title`, `status`, `created`, `modified`) VALUES
(3,	'4fe004cd618af076f00531b8519148bf',	'Playing',	'Active',	'2023-08-04 13:52:48',	'2023-08-04 13:53:13'),
(4,	'a78c450601716cd8bb6ad310481687e8',	'Reading',	'Active',	'2023-08-04 13:53:19',	'0000-00-00 00:00:00'),
(5,	'bb5e1de62c23e887fdeef4c849b2f119',	'Singing',	'Active',	'2023-08-04 13:53:26',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `notices`;
CREATE TABLE `notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `notices` (`id`, `token`, `title`, `content`, `from_date`, `to_date`, `status`, `created`, `modified`) VALUES
(3,	'4d7cfc330aa1050e799882d6d5552af8',	'Test',	'test',	'2023-08-04',	'2023-08-12',	'Active',	'2023-08-04 13:58:08',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `notice_access_logs`;
CREATE TABLE `notice_access_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notice_id` int(11) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `footer_note` varchar(255) NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `settings` (`id`, `token`, `title`, `logo`, `footer_note`, `tagline`, `created`, `modified`) VALUES
(1,	'3ea4b6cd805e9001a71358cda7948a59',	'GuestBook',	'08f3b0f7e9e075d95b8c561f8bdfc7b4.png',	'TBS Guestbook',	'GuestBook',	'2023-08-04 11:53:58',	'2023-08-04 13:57:29');

DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `status` enum('Active','Block','Pending') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO `states` (`id`, `token`, `country_id`, `state_name`, `status`, `created`, `modified`) VALUES
(1,	'd45e559d0194b0ad7c8d1f3ef61a142f',	1,	'Maharashtra',	'Active',	'2023-08-04 13:55:32',	'0000-00-00 00:00:00'),
(2,	'8988e7069913dbd870df1d9d349ab40f',	1,	'Gujrat',	'Active',	'2023-08-04 13:55:40',	'0000-00-00 00:00:00'),
(3,	'8988e7069913dbd870df1d9d349ab40f',	2,	'Western',	'Active',	'2023-08-04 13:55:40',	'0000-00-00 00:00:00'),
(4,	'8988e7069913dbd870df1d9d349ab40f',	2,	'North Central',	'Active',	'2023-08-04 13:55:40',	'0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `token`, `name`, `email_address`, `password`, `dob`, `gender`, `photo`, `last_login`, `last_ip`, `access_details`, `role`, `status`, `created`, `modified`, `token_link`, `token_created`) VALUES
(1,	'900150983cd24fb0d6963f7d28e17f72',	'Admin',	'admin@gmail.com',	'25f9e794323b453885f5181f1b624d0b',	'0000-00-00',	'Male',	'',	'2023-08-04 11:56:41',	'::1',	'Chrome 115.0.0.0',	'Admin',	'Active',	'2023-08-04 11:55:40',	'2023-08-04 11:56:41',	'',	'0000-00-00 00:00:00'),
(2,	'dd4fb7f0bd3bccf77f67dac3b619a8dd',	'Snow',	'snowbelly@gmail.com',	'b4af804009cb036a4ccdc33431ef9ac9',	'0000-00-00',	'Male',	'',	'2023-08-25 16:36:25',	'127.0.0.1',	'Firefox 116.0',	'Admin',	'Active',	'2023-08-04 13:33:22',	'2023-09-26 19:32:39',	'',	'2023-09-26 19:22:09'),
(3,	'baa82a4886d50424bb5fd60927d61e97',	'Belly',	'belly@gmail.com',	'25f9e794323b453885f5181f1b624d0b',	'0000-00-00',	'Male',	'',	'2023-08-04 14:00:13',	'127.0.0.1',	'Firefox 115.0',	'Admin',	'Active',	'2023-08-04 13:59:58',	'2023-08-04 14:00:13',	'',	'0000-00-00 00:00:00'),
(4,	'b78787068df8bdf92d17cafee1364bd3',	'Test',	'test123@gmail.com',	'25f9e794323b453885f5181f1b624d0b',	'0000-00-00',	'Male',	'',	'0000-00-00 00:00:00',	'',	'',	'Admin',	'Active',	'2023-08-25 16:33:21',	'0000-00-00 00:00:00',	'',	'0000-00-00 00:00:00'),
(5,	'17553ec7585dbb085fe840bd0ad57b07',	'Test',	'test12@gmail.com',	'32250170a0dca92d53ec9624f336ca24',	'0000-00-00',	'Male',	'',	'2023-09-05 10:36:12',	'127.0.0.1',	'Firefox 117.0',	'Admin',	'Active',	'2023-08-25 16:34:12',	'2023-09-05 10:36:12',	'',	'0000-00-00 00:00:00'),
(6,	'8807079fdd16e3e704a293c4235eaf87',	'Test',	'test5509@gmail.com',	'b4af804009cb036a4ccdc33431ef9ac9',	'0000-00-00',	'Male',	'',	'0000-00-00 00:00:00',	'',	'',	'Admin',	'Active',	'2023-09-06 16:31:50',	'2023-09-06 17:01:06',	'',	'0000-00-00 00:00:00'),
(7,	'6f32b75703933dbe7dc382c5b7969877',	'Testname',	'test220011@gmail.com',	'25f9e794323b453885f5181f1b624d0b',	'0000-00-00',	'Male',	'',	'0000-00-00 00:00:00',	'',	'',	'Admin',	'Active',	'2023-09-06 16:42:59',	'2023-09-07 10:32:16',	'',	'2023-09-07 10:21:46'),
(8,	'71dbd34b82e86f1341bfc90f2d4a0ca4',	'Test',	'testsnow@gmail.com',	'b4af804009cb036a4ccdc33431ef9ac9',	'0000-00-00',	'Male',	'',	'2023-09-12 10:19:49',	'127.0.0.1',	'Firefox 117.0',	'Admin',	'Active',	'2023-09-12 10:19:39',	'2023-09-12 10:19:49',	'',	'0000-00-00 00:00:00'),
(9,	'920898b74f20884119bab4125f5c1d4d',	'Demo',	'demo@gmail.com',	'b4af804009cb036a4ccdc33431ef9ac9',	'0000-00-00',	'Male',	'',	'2023-10-03 10:21:47',	'127.0.0.1',	'Firefox 118.0',	'Admin',	'Active',	'2023-09-12 13:16:07',	'2023-10-03 10:21:47',	'',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `user_access_logs`;
CREATE TABLE `user_access_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_login` datetime NOT NULL,
  `user_logout` datetime NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `last_logout` datetime NOT NULL,
  `last_ip` varchar(255) NOT NULL,
  `access_details` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_access_logs` (`id`, `user_id`, `user_login`, `user_logout`, `ip_address`, `last_login`, `last_logout`, `last_ip`, `access_details`, `created`, `modified`) VALUES
(8,	5,	'2023-09-05 10:36:12',	'2023-09-05 10:42:04',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 117.0',	'2023-09-05 10:36:12',	'2023-09-05 10:42:04'),
(9,	8,	'2023-09-12 10:19:49',	'2023-09-13 10:14:17',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 117.0',	'2023-09-12 10:19:49',	'2023-09-13 10:14:17'),
(10,	9,	'2023-09-12 13:16:54',	'2023-09-13 10:14:17',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 117.0',	'2023-09-12 13:16:54',	'2023-09-13 10:14:17'),
(11,	9,	'2023-09-13 10:14:52',	'2023-09-14 10:06:05',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 117.0',	'2023-09-13 10:14:52',	'2023-09-14 10:06:05'),
(12,	9,	'2023-09-14 10:06:24',	'2023-09-15 10:03:50',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 117.0',	'2023-09-14 10:06:24',	'2023-09-15 10:03:50'),
(13,	9,	'2023-09-15 10:03:58',	'2023-09-18 09:59:20',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 117.0',	'2023-09-15 10:03:58',	'2023-09-18 09:59:20'),
(14,	9,	'2023-09-15 12:52:06',	'2023-09-18 09:59:20',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 117.0',	'2023-09-15 12:52:06',	'2023-09-18 09:59:20'),
(15,	9,	'2023-09-18 09:59:24',	'2023-09-20 10:24:36',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 117.0',	'2023-09-18 09:59:24',	'2023-09-20 10:24:36'),
(16,	9,	'2023-09-20 10:24:41',	'2023-09-22 10:48:25',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 117.0',	'2023-09-20 10:24:41',	'2023-09-22 10:48:25'),
(17,	9,	'2023-09-22 10:48:29',	'2023-09-25 16:15:21',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 117.0',	'2023-09-22 10:48:29',	'2023-09-25 16:15:21'),
(18,	9,	'2023-09-25 16:15:24',	'2023-09-26 19:21:45',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 117.0',	'2023-09-25 16:15:24',	'2023-09-26 19:21:45'),
(19,	9,	'2023-10-03 10:21:47',	'0000-00-00 00:00:00',	'127.0.0.1',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'Firefox 118.0',	'2023-10-03 10:21:47',	'0000-00-00 00:00:00');

-- 2023-10-03 05:43:11
