-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 08:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecotrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `userID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`userID`) VALUES
(21),
(28),
(29);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `ID` int(10) UNSIGNED NOT NULL,
  `postID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `postedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ID`, `postID`, `userID`, `comment`, `postedDateTime`) VALUES
(3, 3, 21, 'test23', '2023-12-15 07:21:17'),
(4, 3, 21, 'test2', '2023-12-15 07:32:06'),
(5, 7, 27, 'I need more plants', '2023-12-15 08:08:13'),
(6, 5, 27, 'Never would have guessed', '2023-12-15 08:08:23'),
(7, 6, 26, 'Plane lol', '2023-12-15 08:09:03'),
(8, 7, 26, 'Sunflowers :O', '2023-12-15 08:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `ID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf16 COLLATE utf16_bin DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `postedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `userID`, `title`, `content`, `postedDateTime`) VALUES
(3, 3, 'How to grow an avocado tree.  ', 'Plant it.', '2023-12-15 05:05:25'),
(4, 21, 'How to raise a dog', 'dogs are cool', '2023-12-15 05:26:09'),
(5, 23, 'best method to water plants', 'the best way to water plants is by putting the dry plant in a large watering bowl and letting it sit in water for about 30ish mins', '2023-12-15 08:05:28'),
(6, 24, 'how to keep a plane alive', 'don’t kill it', '2023-12-15 08:06:02'),
(7, 25, 'best plant to buy as a beginner', 'sunflower idk lol', '2023-12-15 08:06:39'),
(8, 26, 'best soil to use for plants', 'uhhhh one that’s full of nutrients', '2023-12-15 08:07:14'),
(9, 27, 'best temperature to keep plants in', 'direct sunlight is best', '2023-12-15 08:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(10) UNSIGNED NOT NULL,
  `username` varchar(48) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `email`, `password`) VALUES
(1, 'koalafan22', 'koalafan22@gmail.com', 'testing123'),
(2, 'ecoenthusiast45', 'ecoenthusiast45@gmail.com', 'ecoiscool'),
(3, 'prostheticss', 'prostheticss@gmail.com', 'prostheticss'),
(21, 'sdy329', 'sdy329@gmail.com', '$2y$10$Ob6tjimlH6rPC1iwYCQJeOwXG0RdOR0fNQyS/8EEcOThBfJcnQRbO'),
(22, 'test', 'test@test.com', '$2y$10$wzZvgN2ymlryaGdKNjUz3uBehjPMIpoVsmiHmbGXCGo/OobxveZsy'),
(23, 'symmetricals', 'symmetricals@gmail.com', '$2y$10$8s772KGYHaEYNrTCCPXMV.Qh1JG05qHvQ4p3n0TmgDx.TFFIg23q.'),
(24, 'strangeffects', 'strangeffects@yahoo.com', '$2y$10$gf38IykPPmQtoEcSr9H39epqfwlqCBKvhnD6UKKexONcPFLrx7OUu'),
(25, 'lotus', 'lotus@gmail.com', '$2y$10$ZgB9XWFcZdceFOlOSD7Reuz1HbXRlEweLdcBTxyprESdqV.ht1Qpi'),
(26, 'aparri', 'aparri@att.net', '$2y$10$sIuoCrVGDPc5vaUwR.tqrezE2PpwzceWHvkaR3pcVQ3ZsKwXYls7.'),
(27, 'wisteria', 'wisteriamoon@gmail.com', '$2y$10$S35Ga69yt79K9aBL9jG90eOc8RUmKsLID7J2JypKj/YhvnlkSn.K.'),
(28, 'Caporusso', 'caporusson1@nku.edu', '$2y$10$WPrvHbZIP8l3pKACu6u2cO2Vb5O7K1qJekQrtXSMbsZZddJHwtp2i'),
(29, 'admin', 'admin@admin.com', '$2y$10$2sUDTgcgfMLgDl4WL4o6defs7vpcXHxF9tJ9iiILh.FwKOu3I2LxG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD KEY `Admin UserID` (`userID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `commentPost` (`postID`),
  ADD KEY `commentUser` (`userID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `Admin UserID` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `commentPost` FOREIGN KEY (`postID`) REFERENCES `posts` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentUser` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `user` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
