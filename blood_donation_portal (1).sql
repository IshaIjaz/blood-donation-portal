-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2026 at 05:17 AM
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
-- Database: `blood_donation_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `units` int(11) NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_requests`
--

INSERT INTO `blood_requests` (`id`, `hospital_id`, `blood_group`, `units`, `status`, `request_date`) VALUES
(1, 6, 'A+', 3, 'Approved', '2026-02-15 05:00:00'),
(2, 6, 'B+', 2, 'Approved', '2026-02-20 09:30:00'),
(3, 6, 'O+', 4, 'Approved', '2026-02-18 04:15:00'),
(4, 7, 'AB+', 1, 'Approved', '2026-02-16 06:20:00'),
(5, 7, 'A-', 2, 'Approved', '2026-02-21 11:45:00'),
(6, 7, 'O+', 2, 'Rejected', '2026-02-19 08:10:00'),
(7, 9, 'B+', 3, 'Approved', '2026-02-17 07:00:00'),
(8, 9, 'AB-', 1, 'Approved', '2026-02-22 05:30:00'),
(9, 9, 'A+', 2, 'Approved', '2026-02-21 10:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `blood_stock`
--

CREATE TABLE `blood_stock` (
  `id` int(11) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `units` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_stock`
--

INSERT INTO `blood_stock` (`id`, `blood_group`, `units`) VALUES
(1, 'A+', 13),
(2, 'A-', 6),
(3, 'B+', 11),
(4, 'B-', 6),
(5, 'AB+', 6),
(6, 'AB-', 2),
(7, 'O+', 21),
(8, 'O-', 7);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `donation_date` date NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `donor_id`, `blood_group`, `donation_date`, `status`) VALUES
(1, 2, 'A+', '2026-02-01', 'Approved'),
(2, 2, 'A+', '2026-02-10', 'Approved'),
(3, 2, 'A+', '2026-02-18', 'Approved'),
(4, 3, 'B+', '2026-02-05', 'Approved'),
(5, 3, 'B+', '2026-02-12', 'Approved'),
(6, 3, 'B+', '2026-02-20', 'Approved'),
(7, 4, 'O+', '2026-02-08', 'Approved'),
(8, 4, 'O+', '2026-02-15', 'Approved'),
(9, 4, 'O+', '2026-02-22', 'Approved'),
(10, 5, 'AB+', '2026-02-14', 'Approved'),
(11, 5, 'AB+', '2026-02-21', 'Pending'),
(12, 5, 'AB+', '2026-02-26', 'Approved'),
(13, 5, 'AB+', '2026-02-21', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Donor','Hospital') NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `password`, `role`, `blood_group`, `status`, `created_at`) VALUES
(1, 'Isha Ijaz', 'admin@bdp.com', '03123456789', 'admin123', 'Admin', NULL, 'Approved', '2026-02-21 11:56:30'),
(2, 'Ali Khan', 'ali.khan@email.com', '03001234567', 'password123', 'Donor', 'A+', 'Approved', '2026-02-21 11:56:30'),
(3, 'Sara Ahmed', 'sara.ahmed@email.com', '03111223344', 'password123', 'Donor', 'B+', 'Approved', '2026-02-21 11:56:30'),
(4, 'Hassan Raza', 'hassan.raza@email.com', '03221234567', 'password123', 'Donor', 'O+', 'Approved', '2026-02-21 11:56:30'),
(5, 'Fatima Bibi', 'fatima@email.com', '03331234567', 'password123', 'Donor', 'AB+', 'Approved', '2026-02-21 11:56:30'),
(6, 'City Hospital Lahore', 'city.hospital@email.com', '0421112233', 'hospital123', 'Hospital', NULL, 'Approved', '2026-02-21 11:56:30'),
(7, 'Fatima Memorial Hospital', 'fmh@email.com', '0422223344', 'hospital123', 'Hospital', NULL, 'Approved', '2026-02-21 11:56:30'),
(8, 'Al Shifa Hospital', 'alshifa@email.com', '0423334455', 'hospital123', 'Hospital', NULL, 'Pending', '2026-02-21 11:56:30'),
(9, 'Jinnah Hospital', 'jinnah@email.com', '0424445566', 'hospital123', 'Hospital', NULL, 'Approved', '2026-02-21 11:56:30'),
(10, 'Yasir Ali', 'yasir@gmai.com', '03236754389', 'password123', 'Donor', 'O-', 'Approved', '2026-02-21 12:11:21'),
(11, 'New Life Hospital', 'newlife@gmail.com', '03000065880', 'hospital123', 'Hospital', '', 'Pending', '2026-02-21 12:13:49'),
(12, 'Bisma Khan', 'bisma@email.com', '03236754389', 'password123', 'Donor', 'O+', 'Approved', '2026-02-21 16:31:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `blood_stock`
--
ALTER TABLE `blood_stock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blood_group` (`blood_group`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blood_stock`
--
ALTER TABLE `blood_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD CONSTRAINT `blood_requests_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
