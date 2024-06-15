-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 12:48 AM
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
-- Database: `db_sp`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `account_Type` varchar(50) NOT NULL,
  `First_Name` text NOT NULL,
  `Last_Name` text NOT NULL,
  `dob` date NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `username`, `password`, `account_Type`, `First_Name`, `Last_Name`, `dob`, `email`) VALUES
(6, 'Kendrick', '$2y$10$xEL9yduJK9G1x7uOxMH0I.43lf5eFxVbKgxmrEooJQS', 'professional', 'travis', 'scott', '2015-07-26', 'user07@gmail.com'),
(7, 'studentAccount', '$2y$10$4hTMLlfTAkeC7JLXNevUH.gbmdCK9YVuPTukQimcY0O', 'student', 'frank', 'ocean', '2002-08-14', 'frankocean@gmail.coom');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `account_id`, `date`, `category_id`, `description`, `amount`) VALUES
(1, 6, '2024-03-11', 2, 'qwerty', 100),
(2, 6, '2024-01-03', 1, 'wer', 200),
(3, 6, '2024-01-03', 2, 'dior', 400),
(11, 6, '2024-01-03', 3, 'dfgh', 100),
(12, 6, '2024-01-23', 2, 'test2', 300),
(13, 6, '2024-01-02', 1, 'test2', 200),
(14, 6, '2024-02-14', 5, 'perfume', 300),
(15, 6, '2024-02-08', 3, 'steak with family', 200),
(16, 6, '2024-02-02', 2, 'pokemon', 1000),
(17, 6, '2024-03-14', 2, 'supreme', 700),
(18, 6, '2024-03-30', 3, 'night out', 100),
(19, 6, '2024-03-14', 1, 'ireland', 70);

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `category_id` int(11) NOT NULL,
  `category_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`category_id`, `category_Name`) VALUES
(1, 'Transport'),
(2, 'Shopping'),
(3, 'food&bev'),
(5, 'others');

-- --------------------------------------------------------

--
-- Table structure for table `goal`
--

CREATE TABLE `goal` (
  `goal_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `monthly_savings` double NOT NULL,
  `2024_goal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goal`
--

INSERT INTO `goal` (`goal_id`, `account_id`, `monthly_savings`, `2024_goal`) VALUES
(1, 6, 1000, 12000),
(2, 6, 2500, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `investment`
--

CREATE TABLE `investment` (
  `investment_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(50) NOT NULL,
  `purchase_Price` double NOT NULL,
  `current_Price` double NOT NULL,
  `gain/loss` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `investment`
--

INSERT INTO `investment` (`investment_id`, `account_id`, `date`, `name`, `purchase_Price`, `current_Price`, `gain/loss`) VALUES
(1, 6, '2024-03-30', 'apple', 2000, 1000, 0),
(2, 6, '2024-03-20', 'tesla', 4000, 10000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_budget`
--

CREATE TABLE `monthly_budget` (
  `budget_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `budget` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monthly_budget`
--

INSERT INTO `monthly_budget` (`budget_id`, `account_id`, `month`, `budget`) VALUES
(1, 6, '1', 3000),
(3, 6, '2', 2000),
(4, 6, '3', 5000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `goal`
--
ALTER TABLE `goal`
  ADD PRIMARY KEY (`goal_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `investment`
--
ALTER TABLE `investment`
  ADD PRIMARY KEY (`investment_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `monthly_budget`
--
ALTER TABLE `monthly_budget`
  ADD PRIMARY KEY (`budget_id`),
  ADD KEY `account_id` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `goal`
--
ALTER TABLE `goal`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `investment`
--
ALTER TABLE `investment`
  MODIFY `investment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `monthly_budget`
--
ALTER TABLE `monthly_budget`
  MODIFY `budget_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`),
  ADD CONSTRAINT `expense_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `expense_category` (`category_id`);

--
-- Constraints for table `goal`
--
ALTER TABLE `goal`
  ADD CONSTRAINT `goal_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `investment`
--
ALTER TABLE `investment`
  ADD CONSTRAINT `investment_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `monthly_budget`
--
ALTER TABLE `monthly_budget`
  ADD CONSTRAINT `monthly_budget_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
