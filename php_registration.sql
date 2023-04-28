-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2023 at 06:40 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  `code` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `mobile`, `verified`, `code`, `created_at`, `updated_at`) VALUES
(1, 'adf', 'adf@gmail.com', 'asdf', 0, 0, '2023-04-27 14:13:55', '2023-04-27 14:13:55'),
(2, 'adfa', 'w@gmail.com', 'hilal', 0, 1015, '2023-04-27 14:15:34', '2023-04-27 14:15:34'),
(3, 'adfa', 'ww@gmail.com', 'hilal', 0, 6746, '2023-04-27 14:17:19', '2023-04-27 14:17:19'),
(4, 'adfa', 'wwr@gmail.com', 'hilal', 0, 5845, '2023-04-27 15:53:37', '2023-04-27 15:53:37'),
(5, 'asdf', 'asd@gmail.com', 'hilal', 0, 5288, '2023-04-27 15:55:14', '2023-04-27 15:55:14'),
(6, 'asdf', 'asd1@gmail.com', 'hilal', 0, 8063, '2023-04-27 15:56:10', '2023-04-27 15:56:10'),
(7, 'asdfas', 'asdf@gmail.com', 'hilal', 0, 7188, '2023-04-27 15:56:29', '2023-04-27 15:56:29'),
(8, 'asdfas', 'asdf1@gmail.com', 'hilal', 0, 8777, '2023-04-27 15:57:00', '2023-04-27 15:57:00'),
(9, 'asdfas', 'hilal.ahmad.developer@gmail.com', 'hilal', 1, 1784, '2023-04-27 15:58:06', '2023-04-27 15:58:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
