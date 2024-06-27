-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 27, 2024 at 07:31 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

DROP TABLE IF EXISTS `credentials`;
CREATE TABLE IF NOT EXISTS `credentials` (
  `email` varchar(100) NOT NULL,
  `pass_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `reset_token_hash` int DEFAULT NULL,
  `reset_token_expiration` datetime DEFAULT NULL,
  UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`email`, `pass_hash`, `reset_token_hash`, `reset_token_expiration`) VALUES
('mari@gmail.com', '$2y$10$zcx3HHbpUjvXfBS1AXKph.lIlzXyq4opSbTldUIjkYTH7DDF5Oada', NULL, NULL),
('maria@gmail.com', '$2y$10$wC2ulcJLky2p9gyp628xWeK0KipS.iS/yVLHhx1AT6pzqvo0iwzQ.', NULL, NULL),
('marit@gmail.com', '$2y$10$qEj3rjlyiEjUrWNcEYV41OY9ShiO5CADgAIvzVBZ5FgmduHZzbUTS', NULL, NULL),
('', '', NULL, NULL),
('ana@gmai.com', '$2y$10$bVQOiq6QmY.8ZE1KlOOHDeudJm7IVFcv3qGdUsD1x4yRBNdu3aLMe', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

DROP TABLE IF EXISTS `uploads`;
CREATE TABLE IF NOT EXISTS `uploads` (
  `fileId` int NOT NULL AUTO_INCREMENT,
  `path_to_file` varchar(255) NOT NULL,
  PRIMARY KEY (`fileId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`fileId`, `path_to_file`) VALUES
(1, 'C:\\wamp64\\www\\web-programming\\Final Project/uploads/maomao(3).jpg'),
(2, 'C:\\wamp64\\www\\web-programming\\Final Project/uploads/maomao(4).jpg'),
(3, 'C:\\wamp64\\www\\web-programming\\Final Project/uploads/the lighthouse(2).jpg'),
(4, 'C:\\wamp64\\www\\web-programming\\Final Project/uploads/all 3 android version and physical.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`) VALUES
(2, 'mari', 'mari@gmail.com'),
(3, 'maria', 'maria@gmail.com'),
(4, 'maria', 'marit@gmail.com'),
(5, 'ana', 'ana@gmai.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_img`
--

DROP TABLE IF EXISTS `user_img`;
CREATE TABLE IF NOT EXISTS `user_img` (
  `userId` int NOT NULL,
  `fileId` int NOT NULL,
  PRIMARY KEY (`userId`,`fileId`),
  KEY `fileId` (`fileId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_img`
--

INSERT INTO `user_img` (`userId`, `fileId`) VALUES
(2, 1),
(2, 2),
(2, 3),
(5, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
