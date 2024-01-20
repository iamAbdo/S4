-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2024 at 11:31 PM
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
-- Database: `agencedevoyage`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BookingID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `HotelID` int(11) DEFAULT NULL,
  `FlightID` int(11) DEFAULT NULL,
  `CheckInDate` date DEFAULT NULL,
  `CheckOutDate` date DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL,
  `status` enum('confirmed','pending') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BookingID`, `UserID`, `HotelID`, `FlightID`, `CheckInDate`, `CheckOutDate`, `TotalPrice`, `status`) VALUES
(1, 1, 1, 1, '2023-04-10', '2023-04-15', 600.00, 'pending'),
(2, 2, 2, 2, '2023-05-05', '2023-05-10', 800.00, 'pending'),
(3, 11, 3, 3, NULL, NULL, 700.00, 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `FlightID` int(11) NOT NULL,
  `DepartureLocationID` int(11) DEFAULT NULL,
  `ArrivalLocationID` int(11) DEFAULT NULL,
  `DepartureDateTime` datetime DEFAULT NULL,
  `ArrivalDateTime` datetime DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Airline` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`FlightID`, `DepartureLocationID`, `ArrivalLocationID`, `DepartureDateTime`, `ArrivalDateTime`, `Price`, `Airline`) VALUES
(1, 1, 2, '2023-01-15 10:00:00', '2023-01-15 15:00:00', 400.00, 'AirFrance'),
(2, 2, 3, '2023-02-20 12:00:00', '2023-02-20 18:00:00', 600.00, 'Delta'),
(3, 3, 1, '2023-03-25 08:00:00', '2023-03-25 14:00:00', 500.00, 'ANA'),
(4, 66, 1, '2024-01-18 22:10:00', '2024-01-18 12:10:00', 9000.00, 'AirAlgerie');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `HotelID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `LocationID` int(11) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Rating` decimal(3,2) DEFAULT NULL,
  `ImageURLs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ImageURLs`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`HotelID`, `Name`, `LocationID`, `Description`, `Price`, `Rating`, `ImageURLs`) VALUES
(1, 'Eiffel Tower Hotel', 1, 'Luxury hotel near the Eiffel Tower', 200.00, 4.50, '[\"img1.webp\", \"img2.png\"]'),
(2, 'Times Square Hotel', 2, 'Central location in Times Square', 180.00, 4.00, '[\"img1.jpg\"]'),
(3, 'Tokyo Skyline Hotel', 3, 'Great view of the Tokyo skyline', 220.00, 4.80, '[\"img1.webp\"]'),
(4, 'Hotel snoupi', 1, 'hotel chabab mamay', 99.99, 5.00, '[\"img1.webp\"]'),
(5, 'hotel nabil', 2, 'nabil fi new york', 200.00, 4.00, '[\"THEME_HOTEL_SIGN_FIVE_STARS_FACADE_BUILDING_GettyImages-1320779330-3.jpg\"]');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `LocationID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `ImageURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`LocationID`, `Name`, `Description`, `ImageURL`) VALUES
(1, 'Paris', 'The city of love and lights', 'paris.jpg'),
(2, 'New York', 'The city that never sleeps', 'newyork.jpg'),
(3, 'Tokyo', 'A city of modern and traditional', 'tokyo.jpg'),
(66, 'dubai', 'dubai', 'Tumbnail.png');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `HotelID` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ReviewID`, `UserID`, `HotelID`, `Rating`, `Comment`, `Date`) VALUES
(1, 1, 1, 4, 'Great experience, loved the view!', '2023-04-20'),
(2, 2, 2, 3, 'Nice hotel, but a bit noisy at night', '2023-05-15'),
(3, 3, 3, 5, 'Amazing service and breathtaking view', '2023-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('user','admin') DEFAULT 'user',
  `Cookie` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Email`, `FirstName`, `LastName`, `address`, `phone`, `birthdate`, `Username`, `Password`, `Role`, `Cookie`) VALUES
(1, 'user1@email.com', NULL, 'Doe', '', '', NULL, 'user1', 'password1', 'user', '1'),
(2, 'admin@email.com', NULL, 'User', '', '', NULL, 'admin1', 'adminpass', 'admin', '2'),
(3, 'user2@email.com', NULL, 'Smith', '', '', NULL, 'user2', 'pass123', 'user', '3'),
(7, 'abdellah@gmail.com', NULL, 'Abdellah', '', '', NULL, 'Abdellah', '12345678', 'user', '5'),
(8, 'walid1@gmail.com', 'Abdellah', 'Yahia', 'institus audio visual ouledfayet', '0550414141', '2024-01-09', 'walid', '$2y$10$5g4SPCmnAwSy3iPVxIhgYuNttmh0btA97Jflz/WOf2cV3XHQC3DQm', 'user', '6'),
(11, 'hmed@gmail.com', 'Abdellah', 'kheloufi', 'institus audio visual ouledfayet', '023232323', '2002-08-23', 'hmed', '$2y$10$79qgFuYYlKcnPNn5FKoZSeDbnqk49GVuRvZgXXARkq6LUjchKalUu', 'admin', '9'),
(12, 'nabil@gmail.com', NULL, 'senouci', '', '', NULL, 'nabil', '$2y$10$TKi3wHOppqxyfyvIakRvLeNoWvWFn1yFE.E8vjGwfYot1Qpe1ZPSW', 'user', '59e2583d3ed249a6c385a21573d990fb3c63bc28236f0015693fdedfdd17ec11f38cc8d2aea9af6144f342e436f67f4b56b5296704515811884f6792ef1efc0e'),
(15, 'abdellaalger@gmail.com', NULL, NULL, '', '', NULL, 'hmed', '$2y$10$zSHL1kp3CwH11C6cIsSXqOUTfaIaEzaaO3uLrfLga3yfS86uqYPEu', 'user', '0a5576c911452dac267763445951454bdde3c19a964b88b1bd748de0f5177795a2acb6bc6df154750e151346af8d32a3ce2f22f3f124e753a40d88c22ee6a38b'),
(16, 'hmed2002@gmail.com', NULL, NULL, '', '', NULL, 'hmed', '$2y$10$cl4xRlRX18Th0lfY9hGP6.CoWVsyWn6CI7BeTnqLb6r.Pb6mTEtCu', 'user', '2b4ba298481ef37ac0ffc92d9c9c8a4cb5df101b3346d8f2ddec3d2b00979d50f4b06c351c7a68a8b5f1b477d114228e7680a124fb1d75d0e2daf4c7f571d12d'),
(17, 'amineabdellah25@gmail.com', NULL, NULL, '', '', NULL, 'test', '$2y$10$cl4xRlRX18Th0lfY9hGP6.CoWVsyWn6CI7BeTnqLb6r.Pb6mTEtCu', 'user', '5233c1b1e9c533d2ce1ddfa34815e5d478b43a70929c45348a8dbdc790ca3c166f1e6344bcbf6cf5cc215930d34568e50cbbe10750652efd440f1cf6d0d92da5'),
(18, 'walid2@gmail.com', NULL, NULL, '', '', NULL, 'hmed', '$2y$10$bFt.YrZiTy38TZKMrbu4LOXJ0XZgRnsLcjTB82hsLfhilpiV7XOoK', 'user', '35e056256d259097d2d736948ab3b34a193498005eae2c7c8c7155fe13378be75dd91f11c0c71853396f92ebf5314312c091b3ef7bf144ece3aaff510ec871cc'),
(19, 'mhamed@gmail.com', NULL, NULL, '', '', NULL, 'mhamed', '$2y$10$WQDgSAXlNYCnigg9DMEg7.jOQV/zkOtDk8H636CSyqMLZwvvg8RjK', 'user', '1f3eea14a3c0181ba1619322a618d21b077c48e7f083b677ec1899b6fbfe0edb9ba619af09316ea6f2bcc76d52577ee7aa3d5f2716915b3508840e2eb212e02a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `HotelID` (`HotelID`),
  ADD KEY `FlightID` (`FlightID`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`FlightID`),
  ADD KEY `DepartureLocationID` (`DepartureLocationID`),
  ADD KEY `ArrivalLocationID` (`ArrivalLocationID`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`HotelID`),
  ADD KEY `LocationID` (`LocationID`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`LocationID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `HotelID` (`HotelID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `FlightID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `HotelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `LocationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`HotelID`) REFERENCES `hotels` (`HotelID`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`FlightID`) REFERENCES `flights` (`FlightID`);

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`DepartureLocationID`) REFERENCES `locations` (`LocationID`),
  ADD CONSTRAINT `flights_ibfk_2` FOREIGN KEY (`ArrivalLocationID`) REFERENCES `locations` (`LocationID`);

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`LocationID`) REFERENCES `locations` (`LocationID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`HotelID`) REFERENCES `hotels` (`HotelID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
