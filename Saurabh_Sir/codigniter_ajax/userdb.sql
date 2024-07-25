-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 09:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `hobbies` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `name`, `email`, `mobile`, `hobbies`, `gender`, `profile_image`, `country`, `state`, `city`, `created`, `modified`) VALUES
(1, 'Sanjay', 'sanjay@gmail.com', '9876543210', 'reading,traveling', 'male', '1721581626_download.jpeg', 'USA', 'California', 'Los Angeles', '2024-07-21 19:07:06', '2024-07-21 19:07:06'),
(2, 'saurabh', 'ajaykuli@gmail.com', '9876543210', 'reading,traveling', 'male', '1721583702_download.jpeg', 'USA', 'California', 'Los Angeles', '2024-07-21 19:41:42', '2024-07-21 19:41:42'),
(3, 'Ajay Kuli', 'ajaykuli@gmail.com', '9876543210', 'reading,traveling', 'male', '1721583935_download.jpeg', 'USA', 'California', 'Los Angeles', '2024-07-21 19:45:35', '2024-07-21 19:45:35'),
(4, 'Ajay Kuli', 'ajaykuli@gmail.com', '9876543210', 'reading,traveling', 'male', '1721583949_download.jpeg', 'USA', 'California', 'Los Angeles', '2024-07-21 19:45:49', '2024-07-21 19:45:49'),
(6, 'saurabh', 'sanjay@gmail.com', '9898989898', 'reading,traveling', 'male', '1721585467_download.jpeg', 'USA', 'California', 'Los Angeles', '2024-07-21 20:11:07', '2024-07-21 20:11:07'),
(7, 'Samar', 'samar@gmail.com', '9876543210', 'reading,traveling,cooking', 'male', '1721585523_download.jpeg', 'USA', 'California', 'Los Angeles', '2024-07-21 20:12:03', '2024-07-21 20:12:03'),
(8, 'Shridhar', 'shridhar@gmail.com', '9511599519', 'reading,traveling,cooking', 'male', NULL, 'USA', 'California', 'Los Angeles', '2024-07-21 20:13:49', '2024-07-21 20:13:49'),
(9, 'Shridhar', 'shridhar@gmail.com', '9511599519', 'reading,traveling,cooking', 'male', NULL, 'USA', 'California', 'Los Angeles', '2024-07-21 20:14:00', '2024-07-21 20:14:00'),
(10, 'Shridhar', 'shridhar@gmail.com', '9511599519', 'reading,traveling,cooking', 'male', '1721585696_download.jpeg', 'USA', 'California', 'Los Angeles', '2024-07-21 20:14:56', '2024-07-21 20:14:56'),
(11, 'saurabh', 'saurabh@gmail.com', '7894561230', 'reading,traveling,cooking', 'male', NULL, 'USA', 'California', 'Los Angeles', '2024-07-21 20:23:27', '2024-07-21 20:23:27'),
(12, 'shravan', 'shravanhget@gmail.com', '7894561230', 'reading,traveling,cooking', 'male', NULL, 'USA', 'California', 'Los Angeles', '2024-07-21 20:24:13', '2024-07-21 20:24:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
