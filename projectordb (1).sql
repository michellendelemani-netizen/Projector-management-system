-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 30, 2026 at 07:04 PM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectordb`
--

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

DROP TABLE IF EXISTS `lecturers`;
CREATE TABLE IF NOT EXISTS `lecturers` (
  `lecturer_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lecturer_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`lecturer_id`, `first_name`, `middle_name`, `last_name`, `department`, `phone_number`, `home`, `email`) VALUES
(1, 'Dr John', 'A', 'Mwambene', 'Computer Science', '0999000001', 'Lilongwe', 'lec1@uni.com'),
(2, 'Dr Mary', 'B', 'Phiri', 'Business', '0999000002', 'Blantyre', 'lec2@uni.com'),
(3, 'Dr Peter', 'C', 'Banda', 'Engineering', '0999000003', 'Zomba', 'lec3@uni.com'),
(4, 'Dr Grace', 'D', 'Soko', 'Law', '0999000004', 'Mzuzu', 'lec4@uni.com'),
(5, 'Dr James', 'E', 'Kambalame', 'IT', '0999000005', 'Mangochi', 'lec5@uni.com');

-- --------------------------------------------------------

--
-- Table structure for table `projectors`
--

DROP TABLE IF EXISTS `projectors`;
CREATE TABLE IF NOT EXISTS `projectors` (
  `projector_id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `life_span` int DEFAULT NULL,
  `manufactured_date` date DEFAULT NULL,
  `bought_date` date DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expected_end_of_life` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`projector_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projectors`
--

INSERT INTO `projectors` (`projector_id`, `model`, `life_span`, `manufactured_date`, `bought_date`, `status`, `expected_end_of_life`, `is_active`) VALUES
(1, 'Epson X1', 1000, '2022-01-01', '2022-02-01', 'available', '2026-01-01', 1),
(2, 'BenQ G2', 1200, '2022-01-02', '2022-02-02', 'in_use', '2026-02-01', 1),
(3, 'Sony P3', 1500, '2022-01-03', '2022-02-03', 'faulty', '2026-03-01', 0),
(4, 'HP Pro1', 1100, '2022-01-04', '2022-02-04', 'available', '2026-04-01', 1),
(5, 'Acer V5', 1300, '2022-01-05', '2022-02-05', 'in_use', '2026-05-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_village` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_of_study` int DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_of_study` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `middle_name`, `last_name`, `dob`, `gender`, `phone_number`, `home_village`, `year_of_study`, `email`, `program_of_study`) VALUES
(1, 'John', 'A', 'Phiri', '2000-01-01', 'Male', '0888000001', 'Village1', 1, 'student1@gmail.com', 'IT'),
(2, 'Mary', 'B', 'Kawawa', '2000-01-02', 'Female', '0888000002', 'Village2', 2, 'student2@gmail.com', 'Business'),
(3, 'Peter', 'C', 'Mwale', '2000-01-03', 'Male', '0888000003', 'Village3', 3, 'student3@gmail.com', 'Engineering'),
(4, 'Grace', 'D', 'Banda', '2000-01-04', 'Female', '0888000004', 'Village4', 4, 'student4@gmail.com', 'Law'),
(5, 'James', 'E', 'Sakala', '2000-01-05', 'Male', '0888000005', 'Village5', 1, 'student5@gmail.com', 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `projector_id` int DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `lecturer_id` int DEFAULT NULL,
  `borrower_type` enum('student','lecturer') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `borrowed_at` datetime NOT NULL,
  `expected_return_at` datetime DEFAULT NULL,
  `returned_at` datetime DEFAULT NULL,
  `projector_condition` enum('good','faulty') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','returned','flagged') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  PRIMARY KEY (`transaction_id`),
  KEY `user_id` (`user_id`),
  KEY `projector_id` (`projector_id`),
  KEY `student_id` (`student_id`),
  KEY `lecturer_id` (`lecturer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `projector_id`, `student_id`, `lecturer_id`, `borrower_type`, `borrowed_at`, `expected_return_at`, `returned_at`, `projector_condition`, `reason`, `status`) VALUES
(1, 1, 1, 1, NULL, 'student', '2026-04-01 10:00:00', '2026-04-05 10:00:00', NULL, NULL, 'Lecture presentation', 'pending'),
(2, 2, 2, NULL, 1, 'lecturer', '2026-04-02 11:00:00', '2026-04-06 11:00:00', '2026-04-05 09:00:00', NULL, 'Research demo', 'returned'),
(3, 3, 3, 2, NULL, 'student', '2026-04-03 12:00:00', '2026-04-07 12:00:00', NULL, NULL, 'Project defense', 'pending'),
(4, 4, 4, NULL, 2, 'lecturer', '2026-04-04 09:00:00', '2026-04-08 09:00:00', '2026-04-24 17:24:00', NULL, 'Class lecture', 'returned'),
(5, 5, 5, 3, NULL, 'student', '2026-04-05 14:00:00', '2026-04-09 14:00:00', '2026-04-18 18:52:00', 'good', 'Assignment', 'returned');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('desk','manager') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `home`, `phone_number`, `role`) VALUES
(1, 'Admin', 'A', 'One', 'admin1@sys.com', 'pass123', 'Blantyre', '0888111111', 'manager'),
(2, 'Desk', 'B', 'User', 'desk1@sys.com', 'pass123', 'Limbe', '0888111112', 'desk'),
(3, 'Desk', 'C', 'User', 'desk2@sys.com', 'pass123', 'Zomba', '0888111113', 'desk'),
(4, 'Manager', 'D', 'User', 'manager1@sys.com', 'pass123', 'Lilongwe', '0888111114', 'manager'),
(5, 'Desk', 'E', 'User', 'desk3@sys.com', 'pass123', 'Mzuzu', '0888111115', 'desk'),
(6, 'Manager', 'F', 'User', 'manager2@sys.com', 'pass123', 'Mangochi', '0888111116', 'manager'),
(7, 'Desk', 'G', 'User', 'desk4@sys.com', 'pass123', 'Kasungu', '0888111117', 'desk');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
