-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 01:54 PM
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
-- Database: `tickets booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `Id` int(20) NOT NULL,
  `Name` text NOT NULL,
  `Date` date NOT NULL,
  `Time` time(4) NOT NULL,
  `Max_Attendees` int(20) NOT NULL,
  `Location` varchar(20) NOT NULL,
  `VIP` int(10) NOT NULL,
  `Regular` int(10) NOT NULL,
  `Event_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`Id`, `Name`, `Date`, `Time`, `Max_Attendees`, `Location`, `VIP`, `Regular`, `Event_description`) VALUES
(9, 'SOL FEST', '2024-01-31', '14:30:00.0000', 50, 'Kabarak', 2500, 1000, ''),
(10, 'LIVE', '2024-02-28', '14:58:00.0000', 1000, 'Nairobi', 1000, 700, ''),
(11, 'rea', '2024-02-13', '18:34:00.0000', 45, 'Nairobi', 0, 0, ''),
(14, 'newer', '2024-02-07', '14:32:00.0000', 67, 'Mombasa', 32, 65, ''),
(15, 'hey', '2024-02-29', '14:31:00.0000', 76, 'KAKAMEGA', 689, 54, ''),
(18, 'Street Fashion', '2024-03-03', '14:45:00.0000', 400, 'Uhuru Park', 1500, 700, ''),
(19, 'Street Fashion', '2024-03-03', '14:45:00.0000', 400, 'Uhuru Park', 1500, 700, '');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `email` varchar(20) NOT NULL,
  `ticket_type` varchar(20) NOT NULL,
  `num_tickets` int(20) NOT NULL,
  `Name` text NOT NULL,
  `Cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`email`, `ticket_type`, `num_tickets`, `Name`, `Cost`) VALUES
('eileenafula@gmail.co', 'VIP', 4, 'SOL', 0),
('eileenafula@gmail.co', 'VIP', 4, 'SOL', 0),
('eileenafula@gmail.co', 'VIP', 4, 'SOL', 0),
('eileenafula@gmail.co', 'VIP', 4, 'SOL', 0),
('eileenafula@gmail.co', 'VIP', 4, 'SOL', 0),
('eileenafula@gmail.co', 'VIP', 4, 'SOL', 0),
('really@gmail.com', 'Regular', 4, 'SOL', 0),
('eillleenafula@gmail.', 'VIP', 4, 'hey', 0),
('eileenafula@gmail.co', 'Regular', 2, 'Festival', 0),
('eileenafula@gmail.co', 'Regular', 2, 'Festival', 0),
('eileenafula@gmail.co', 'Regular', 2, 'Festival', 0),
('eileenafula@gmail.co', 'Regular', 2, 'Festival', 0),
('eileenafula@gmail.co', 'Regular', 2, 'Festival', 0),
('eileenafula@gmail.co', 'Regular', 2, 'Festival', 0),
('eillleenafula@gmail.', 'Regular', 5, 'Street Fashion', 0),
('eillleenafula@gmail.', 'Regular', 5, 'Street Fashion', 0),
('eillleenafula@gmail.', 'Regular', 5, 'Street Fashion', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(150) NOT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT 1,
  `username` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT ' 0 = incative , 1 = active',
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_type`, `username`, `password`, `status`, `date_updated`) VALUES
(1, 'Administrator', 1, 'admin', 'f2d0ff370380124029c2b807a924156c', 1, '2022-06-25 20:13:42'),
(3, 'AdminWilly', 2, 'willy', 'f2d0ff370380124029c2b807a924156c', 1, '2022-06-25 20:14:01'),
(4, 'AdminLea', 1, 'leadmin', 'f2d0ff370380124029c2b807a924156c', 1, '2022-06-25 20:14:03'),
(5, 'nafula', 1, 'nafula', 'here32', 1, '2024-02-27 21:52:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
