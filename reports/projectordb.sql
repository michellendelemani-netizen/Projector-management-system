-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 02, 2026 at 05:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `incident_id` int(11) NOT NULL,
  `projector_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `type` enum('missing','damaged') DEFAULT NULL,
  `description` text DEFAULT NULL,
  `reported_at` datetime DEFAULT NULL,
  `status` enum('open','resolved') DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`incident_id`, `projector_id`, `transaction_id`, `type`, `description`, `reported_at`, `status`) VALUES
(1, 2, 1, 'missing', 'Projector not returned', '2026-05-02 09:45:06', 'open'),
(2, 1, 1, 'missing', 'Not returned after lecture', '2026-04-06 10:00:00', 'open'),
(3, 2, 2, 'damaged', 'Screen flickering issue', '2026-04-07 11:30:00', 'resolved'),
(4, 3, 3, 'missing', 'Student did not return projector', '2026-04-08 12:00:00', 'open'),
(5, 4, 4, 'damaged', 'Lens cracked', '2026-04-09 09:15:00', 'resolved'),
(6, 5, 5, 'missing', 'Lost during transport', '2026-04-10 14:20:00', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `lecturer_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `home` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `maintenance_id` int(11) NOT NULL,
  `projector_id` int(11) NOT NULL,
  `issue` text DEFAULT NULL,
  `action_taken` text DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `reported_at` datetime DEFAULT NULL,
  `fixed_at` datetime DEFAULT NULL,
  `status` enum('pending','fixed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`maintenance_id`, `projector_id`, `issue`, `action_taken`, `cost`, `reported_at`, `fixed_at`, `status`) VALUES
(1, 1, 'Lamp not working', NULL, NULL, '2026-05-02 09:43:43', NULL, 'pending'),
(2, 1, 'Lamp failure', 'Replaced lamp', 120.00, '2026-03-01 10:00:00', '2026-03-02 15:00:00', 'fixed'),
(3, 2, 'Overheating', 'Cleaned fan', 50.00, '2026-03-05 09:30:00', '2026-03-05 12:00:00', 'fixed'),
(4, 3, 'No display', 'Checked HDMI port', 30.00, '2026-03-10 11:00:00', NULL, 'pending'),
(5, 4, 'Blurred image', 'Adjusted lens', 20.00, '2026-03-12 14:00:00', '2026-03-12 16:00:00', 'fixed'),
(6, 5, 'Power issue', 'Replaced power supply', 80.00, '2026-03-15 08:00:00', NULL, 'pending'),
(7, 1, 'Color distortion', 'Reset settings', 25.00, '2026-03-18 13:00:00', '2026-03-18 14:30:00', 'fixed'),
(8, 2, 'Fan noise', 'Lubricated fan', 15.00, '2026-03-20 10:45:00', '2026-03-20 11:30:00', 'fixed'),
(9, 3, 'HDMI not working', 'Replaced port', 60.00, '2026-03-22 09:00:00', NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `projectors`
--

CREATE TABLE `projectors` (
  `projector_id` int(11) NOT NULL,
  `model` varchar(100) DEFAULT NULL,
  `life_span` int(11) DEFAULT NULL,
  `manufactured_date` date DEFAULT NULL,
  `bought_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `expected_end_of_life` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `home_village` varchar(100) DEFAULT NULL,
  `year_of_study` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `program_of_study` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `projector_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `lecturer_id` int(11) DEFAULT NULL,
  `borrower_type` enum('student','lecturer') DEFAULT NULL,
  `borrowed_at` datetime NOT NULL,
  `expected_return_at` datetime DEFAULT NULL,
  `returned_at` datetime DEFAULT NULL,
  `projector_condition` enum('good','faulty') DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','returned','flagged') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `projector_id`, `student_id`, `lecturer_id`, `borrower_type`, `borrowed_at`, `expected_return_at`, `returned_at`, `projector_condition`, `reason`, `status`) VALUES
(1, 1, 1, 1, NULL, 'student', '2026-04-01 10:00:00', '2026-04-05 10:00:00', NULL, NULL, 'Lecture presentation', 'pending'),
(2, 2, 2, NULL, 1, 'lecturer', '2026-04-02 11:00:00', '2026-04-06 11:00:00', '2026-04-05 09:00:00', NULL, 'Research demo', 'returned'),
(3, 3, 3, 2, NULL, 'student', '2026-04-03 12:00:00', '2026-04-07 12:00:00', NULL, NULL, 'Project defense', 'pending'),
(4, 4, 4, NULL, 2, 'lecturer', '2026-04-04 09:00:00', '2026-04-08 09:00:00', '2026-04-24 17:24:00', NULL, 'Class lecture', 'returned'),
(5, 5, 5, 3, NULL, 'student', '2026-04-05 14:00:00', '2026-04-09 14:00:00', '2026-04-18 18:52:00', 'good', 'Assignment', 'returned'),
(6, 1, 1, 1, NULL, 'student', '2026-05-02 11:33:43', '2026-05-02 11:33:43', NULL, NULL, NULL, 'returned'),
(7, 1, 1, 2, NULL, 'student', '2026-05-02 11:33:43', '2026-05-02 11:33:43', NULL, NULL, NULL, 'returned'),
(8, 1, 1, 3, NULL, 'student', '2026-05-02 11:33:43', '2026-05-02 11:33:43', NULL, NULL, NULL, 'returned'),
(9, 1, 2, 4, NULL, 'student', '2026-05-02 11:33:43', '2026-05-02 11:33:43', NULL, NULL, NULL, 'returned'),
(10, 1, 2, 5, NULL, 'student', '2026-05-02 11:33:43', '2026-05-02 11:33:43', NULL, NULL, NULL, 'returned');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `home` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `role` enum('desk','manager') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`incident_id`),
  ADD KEY `fk_incident_projector` (`projector_id`),
  ADD KEY `fk_incident_transaction` (`transaction_id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`lecturer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`maintenance_id`),
  ADD KEY `fk_maintenance_projector` (`projector_id`);

--
-- Indexes for table `projectors`
--
ALTER TABLE `projectors`
  ADD PRIMARY KEY (`projector_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `projector_id` (`projector_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `incident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `lecturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `maintenance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `projectors`
--
ALTER TABLE `projectors`
  MODIFY `projector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `fk_incident_projector` FOREIGN KEY (`projector_id`) REFERENCES `projectors` (`projector_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_incident_transaction` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON DELETE SET NULL;

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `fk_maintenance_projector` FOREIGN KEY (`projector_id`) REFERENCES `projectors` (`projector_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
