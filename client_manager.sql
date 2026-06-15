-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2026 at 10:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `client_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$mxa6FmiBm3ESZQxXAKD1heWr40kqFF68vbU7VBlJgS6xUc4iHwnuy');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`, `email`, `phone`, `company_name`, `industry`, `address`, `created_at`) VALUES
(1, 'Rahul Sharma', 'rahul@gmail.com', '9876543210', 'TechNova', 'Software', 'New Delhi', '2026-06-08 07:35:56'),
(2, 'Priya Gupta', 'priya@gmail.com', '9123456780', 'Creative Studio', 'Marketing', 'Noida', '2026-06-08 07:35:56'),
(3, 'Gabs', 'random@gmail.com', '9999999999', 'xya', 'chemical', '1/132', '2026-06-08 08:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `project_name` varchar(150) NOT NULL,
  `project_type` varchar(100) DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('Pending','Partial','Paid') DEFAULT 'Pending',
  `project_status` enum('Not Started','In Progress','On Hold','Completed') DEFAULT 'Not Started',
  `start_date` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `client_id`, `project_name`, `project_type`, `budget`, `payment_status`, `project_status`, `start_date`, `deadline`, `notes`, `created_at`) VALUES
(1, 1, 'Portfolio Website', 'Web Development', 25000.00, 'Partial', 'In Progress', '2026-06-01', '2026-06-30', 'Homepage completed', '2026-06-08 07:35:56'),
(2, 2, 'Brand Promotion', 'Digital Marketing', 15000.00, 'Pending', 'Not Started', '2026-06-10', '2026-07-10', 'Waiting for assets', '2026-06-08 07:35:56'),
(3, 3, 'Record holder', 'Dynamic', 50000.00, 'Pending', 'On Hold', '2026-06-01', '2026-06-30', 'Mkae it more advanced', '2026-06-08 08:43:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
