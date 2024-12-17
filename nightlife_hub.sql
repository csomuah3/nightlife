-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 03:34 AM
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
-- Database: `nightlife_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `Booking_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Table_id` int(11) NOT NULL,
  `Event_id` int(11) NOT NULL,
  `Booking_date` datetime NOT NULL,
  `Status` enum('Pending','Confirmed','Canceled','') NOT NULL,
  `Total_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`Booking_id`, `User_id`, `Table_id`, `Event_id`, `Booking_date`, `Status`, `Total_price`) VALUES
(1, 7, 3, 1, '0000-00-00 00:00:00', 'Pending', 250),
(2, 7, 3, 1, '0000-00-00 00:00:00', 'Pending', 250),
(3, 13, 1, 2, '0000-00-00 00:00:00', 'Pending', 250);

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `club_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `Event_id` int(11) NOT NULL,
  `Venue_id` int(11) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `Start_time` datetime NOT NULL,
  `End_time` datetime NOT NULL,
  `Description` text NOT NULL,
  `Early_bird_discount` decimal(10,0) NOT NULL,
  `Last_minute_deal` decimal(10,0) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`Event_id`, `Venue_id`, `Title`, `Start_time`, `End_time`, `Description`, `Early_bird_discount`, `Last_minute_deal`, `Created_at`) VALUES
(1, 1, 'DJ Night', '2024-12-09 01:54:59', '2024-12-09 01:54:59', 'Listen to various sounds from DJs.', 0, 0, '2024-12-09 00:55:46'),
(2, 2, 'Karaoke Night', '2024-12-09 02:01:43', '2024-12-09 02:01:43', 'Different voices in unison.', 2, 2, '2024-12-09 01:02:46'),
(3, 3, 'Masquerade Night', '2024-12-09 02:03:00', '2024-12-09 02:03:00', 'Behind the mask', 3, 3, '2024-12-09 01:03:34'),
(4, 4, 'Cocktail Specials', '2024-12-09 02:03:39', '2024-12-09 02:03:39', 'Drink to your fill.', 4, 4, '2024-12-09 01:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `membership_loyalty`
--

CREATE TABLE `membership_loyalty` (
  `Reward_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Points_earned` int(11) NOT NULL,
  `Reward_description` text NOT NULL,
  `Reward_claimed` tinyint(1) NOT NULL DEFAULT 0,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `Review_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Venue_id` int(11) NOT NULL,
  `Rating` decimal(10,0) NOT NULL,
  `Review_text` text NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `Table_id` int(11) NOT NULL,
  `Venue_id` int(11) NOT NULL,
  `Table_size` int(11) NOT NULL,
  `Package_details` text NOT NULL,
  `Amenities` varchar(255) NOT NULL,
  `Price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`Table_id`, `Venue_id`, `Table_size`, `Package_details`, `Amenities`, `Price`) VALUES
(1, 1, 10, '', '', 150),
(2, 2, 10, '', '', 100),
(3, 3, 10, '', '', 350),
(4, 4, 10, '', '', 75);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Phone_number` varchar(15) NOT NULL,
  `Membership_level` enum('Bronze','Silver','Gold','') NOT NULL,
  `Loyalty_points` int(11)  not NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_id`, `Username`, `Email`, `Password`, `Phone_number`, `Membership_level`, `Loyalty_points`, `Created_at`, `Role`) VALUES
(7, 'Martin', 'joshuaboady18@gmail.com', '$2y$10$QbR8/vAmAin3ZIWu0GwvmeOwA04kfJuGMlyuBoDdcDBqN1zeEh4K.', '0244814081', 'Silver', 0, '2024-12-08 23:10:59', ''),
(8, 'Martin', 'joshuaboady18@gmail.com', '$2y$10$q1HS2OwIURHasUHmwvHVheBoIo5.tGGzFwvWz./LDqp5cZ5rMgAr6', '0244814081', 'Silver', 0, '2024-12-08 23:11:51', 'User'),
(9, 'Martin', 'joshuaboady18@gmail.com', '$2y$10$Ck5tZYTgWC79rBEiLIaWVe6v.fGH8PwXA/f4.2XxDUbkAuOxRo98e', '0244814081', 'Silver', 0, '2024-12-08 23:15:42', 'User'),
(10, 'Martin', 'joshuaboady18@gmail.com', '$2y$10$cAn9KuR2//yYeUIX8RykceG1SRwaBv8GD5qHcBvOA9dMpPWwwhq6C', '0244814081', 'Silver', 0, '2024-12-08 23:26:05', 'Staff'),
(11, 'Admin', 'joshuaboady18@gmail.com', '$2y$10$RZBdacC4jV5pkx4pcOhJbO/iKnlLtPv1XpC4ZaCp8IKdqxHjrgV0y', '0551122334', 'Bronze', 0, '2024-12-08 23:28:10', 'Admin'),
(12, 'Collins', 'joshuaboady18@gmail.com', '$2y$10$1hhTKYR5XMUxUA91alEGwOU21aa.PjroFDt/qi0gEGJzMkBYIzRye', '0234567890', 'Bronze', 0, '2024-12-08 23:35:31', 'User'),
(13, 'Chelsea', 'chelsea.somuah@gmail.com', '$2y$10$mJiWyzMk7wAAYcJH2Qe7b.r5hPoMtc8BQAi5q8oK0Num/En5uYKy.', '0556781245', 'Gold', 0, '2024-12-10 21:41:09', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `venue_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `latitude` decimal(10,0) NOT NULL,
  `longitude` decimal(10,0) NOT NULL,
  `music_genre` varchar(50) NOT NULL,
  `ambiance` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `average_rating` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`Booking_id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`Event_id`);

--
-- Indexes for table `membership_loyalty`
--
ALTER TABLE `membership_loyalty`
  ADD PRIMARY KEY (`Reward_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`Review_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`Table_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `Booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `Event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
