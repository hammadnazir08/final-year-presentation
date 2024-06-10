-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 12:20 AM
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
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `agentschedules`
--

CREATE TABLE `agentschedules` (
  `ScheduleID` int(11) NOT NULL,
  `AgentID` int(11) DEFAULT NULL,
  `WorkDay` date DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carfeatures`
--

CREATE TABLE `carfeatures` (
  `CarID` int(11) NOT NULL,
  `FeatureID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `CarID` int(11) NOT NULL,
  `ManufacturerID` int(11) NOT NULL,
  `Model` varchar(255) NOT NULL,
  `Year` int(11) DEFAULT NULL,
  `BasePrice` decimal(10,2) DEFAULT NULL,
  `CarPicture` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','denied') DEFAULT 'pending',
  `city` varchar(255) DEFAULT NULL,
  `city_area` varchar(255) DEFAULT NULL,
  `car_info` text DEFAULT NULL,
  `registered_in` varchar(255) DEFAULT NULL,
  `exterior_color` varchar(255) DEFAULT NULL,
  `mileage` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CarID`, `ManufacturerID`, `Model`, `Year`, `BasePrice`, `CarPicture`, `status`, `city`, `city_area`, `car_info`, `registered_in`, `exterior_color`, `mileage`, `price`, `description`) VALUES
(10, 4, 'civic', 2020, 800000.00, 'uploads/6655bc11156d4.jpg', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 2, 'corollas', 2022, 220000.00, 'uploads/6655b77a37f2c.jpg', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 4, 'Crolla gli', 2150, 210000.00, 'uploads/66575bfa7fe53.jpg', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone_number`, `zip_code`, `comments`) VALUES
(1, 'vzdfg zfgg', 'admin@gmail.com', '03001111111', '54000', 'this is good page \r\n'),
(2, 'vzdfg zfgg', 'admin@gmail.com', '03001111111', '54000', 'this is good page'),
(3, 'vzdfg zfgg', 'admin@gmail.com', '03001111111', '54000', 'sencond one'),
(4, 'vzdfg zfgg', 'admin@gmail.com', '03001111111', '54000', 'third'),
(5, 'vzdfg zfgg', 'admin@gmail.com', '03001111111', '54000', 'third'),
(6, 'vzdfg zfgg', 'admin@gmail.com', '03001111111', '54000', 'third'),
(7, 'vzdfg zfgg', 'admin@gmail.com', '03001111111', '54000', 'third'),
(8, 'vzdfg zfgg', 'admin@gmail.com', '03001111111', '54000', 'nice \r\n'),
(9, 'vzdfg zfgg', 'admin@gmail.com', '03001111111', '54000', 'nice \r\n'),
(10, 'vzdfg zfgg', 'admin@gmail.com', '03001111111', '54000', 'nice'),
(11, 'vzdfg zfgg', 'admin@gmail.com', '03001111111', '54000', 'nice'),
(12, 'vzdfg zfgg', 'admin@gmail.com', '03001111111', '54000', 'forth'),
(13, 'vzdfg zfgg', 'admin@gmail.com', '03001111111', '54000', 'forth'),
(14, 'Zubair Qureshi', 'hammadg4341@gmail.com', '03001234567', '54000', 'fifth');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `Name`, `Email`, `Password`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$p9O4vhEZ0GM8e26ljgy/qOtehhwGDGTerG7IEvDrMN.3UTInYq0Sq'),
(2, 'admin', 'admin@gmail.com', '$2y$10$ZKYdeRg8mMschcBwusvcWegopnywiHewrk5/KqS6Zsbf5cRaGvKJ2'),
(3, 'admin', 'admin@gmail.com', '$2y$10$1Bz5WSLRlGkI6fgq514geep32u.a7.vVmI8VAYmfUsNunOYEgchCG'),
(4, 'admin', 'admin@gmail.com', '$2y$10$LbOAXy62B0WwHJKqdFefieEoVT4i.kk73evK5EKRzMz37DhZ2M6d.'),
(5, 'admin', 'admin@gmail.com', '$2y$10$Am9j/UAPgKbwtj.r/PxfFeJo8ynnA5HvSbGTo/olSuhu9w55QK4aq'),
(6, 'admin', 'admin@gmail.com', '$2y$10$YLVRY.zOeehcZ9T9jGzxveXfu/iIlK7.AB1R2vRK1D/YfxRMupl6u');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `FeatureID` int(11) NOT NULL,
  `FeatureName` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `InventoryID` int(11) NOT NULL,
  `CarID` int(11) DEFAULT NULL,
  `LocationID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `ListingID` int(11) NOT NULL,
  `CarID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `DateListed` date DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `LocationID` int(11) NOT NULL,
  `LocationName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `ManufacturerID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`ManufacturerID`, `Name`, `Country`) VALUES
(1, 'Toyota', 'Japan'),
(2, 'Honda', 'Japan'),
(3, 'Ford', 'USA'),
(4, 'BMW', 'Germany'),
(5, 'Mercedes-Benz', 'Germany');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `TransactionID` int(11) DEFAULT NULL,
  `PaymentMethod` varchar(255) DEFAULT NULL,
  `PaymentAmount` decimal(10,2) DEFAULT NULL,
  `PaymentDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentstatus`
--

CREATE TABLE `paymentstatus` (
  `PaymentID` int(11) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `predictionlogs`
--

CREATE TABLE `predictionlogs` (
  `LogID` int(11) NOT NULL,
  `PredictionID` int(11) DEFAULT NULL,
  `LogDetails` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `predictions`
--

CREATE TABLE `predictions` (
  `PredictionID` int(11) NOT NULL,
  `CarID` int(11) DEFAULT NULL,
  `PredictedPrice` decimal(10,2) DEFAULT NULL,
  `PredictionDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `PriceID` int(11) NOT NULL,
  `CarID` int(11) DEFAULT NULL,
  `HistoricalPrice` decimal(10,2) DEFAULT NULL,
  `DateRecorded` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviewratings`
--

CREATE TABLE `reviewratings` (
  `ReviewID` int(11) NOT NULL,
  `Rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewID` int(11) NOT NULL,
  `CarID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ReviewText` text DEFAULT NULL,
  `ReviewDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salesagents`
--

CREATE TABLE `salesagents` (
  `AgentID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TransactionID` int(11) NOT NULL,
  `ListingID` int(11) DEFAULT NULL,
  `BuyerID` int(11) DEFAULT NULL,
  `SellerID` int(11) DEFAULT NULL,
  `TransactionDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `TotalPrice` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `CreatedAt`) VALUES
(0, 'admin', '$2y$10$wetTHt0BDlmDl5jL/fA2pucF0jrZ86GvpVPMZ/A4CtWYVZcuXKIGi', 'mark@gmail.com', '2024-05-28 23:20:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agentschedules`
--
ALTER TABLE `agentschedules`
  ADD PRIMARY KEY (`ScheduleID`),
  ADD KEY `AgentID` (`AgentID`);

--
-- Indexes for table `carfeatures`
--
ALTER TABLE `carfeatures`
  ADD PRIMARY KEY (`CarID`,`FeatureID`),
  ADD KEY `FeatureID` (`FeatureID`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CarID`),
  ADD KEY `ManufacturerID` (`ManufacturerID`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`FeatureID`),
  ADD UNIQUE KEY `FeatureName` (`FeatureName`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`InventoryID`),
  ADD KEY `CarID` (`CarID`),
  ADD KEY `LocationID` (`LocationID`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`ListingID`),
  ADD KEY `CarID` (`CarID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`LocationID`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`ManufacturerID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `TransactionID` (`TransactionID`);

--
-- Indexes for table `paymentstatus`
--
ALTER TABLE `paymentstatus`
  ADD KEY `PaymentID` (`PaymentID`);

--
-- Indexes for table `predictionlogs`
--
ALTER TABLE `predictionlogs`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `PredictionID` (`PredictionID`);

--
-- Indexes for table `predictions`
--
ALTER TABLE `predictions`
  ADD PRIMARY KEY (`PredictionID`),
  ADD KEY `CarID` (`CarID`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`PriceID`),
  ADD KEY `CarID` (`CarID`);

--
-- Indexes for table `reviewratings`
--
ALTER TABLE `reviewratings`
  ADD PRIMARY KEY (`ReviewID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `CarID` (`CarID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleID`),
  ADD UNIQUE KEY `RoleName` (`RoleName`);

--
-- Indexes for table `salesagents`
--
ALTER TABLE `salesagents`
  ADD PRIMARY KEY (`AgentID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Phone` (`Phone`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `ListingID` (`ListingID`),
  ADD KEY `BuyerID` (`BuyerID`),
  ADD KEY `SellerID` (`SellerID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `CarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agentschedules`
--
ALTER TABLE `agentschedules`
  ADD CONSTRAINT `agentschedules_ibfk_1` FOREIGN KEY (`AgentID`) REFERENCES `salesagents` (`AgentID`);

--
-- Constraints for table `carfeatures`
--
ALTER TABLE `carfeatures`
  ADD CONSTRAINT `carfeatures_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`),
  ADD CONSTRAINT `carfeatures_ibfk_2` FOREIGN KEY (`FeatureID`) REFERENCES `features` (`FeatureID`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`LocationID`) REFERENCES `locations` (`LocationID`);

--
-- Constraints for table `listings`
--
ALTER TABLE `listings`
  ADD CONSTRAINT `listings_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`),
  ADD CONSTRAINT `listings_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`TransactionID`) REFERENCES `transactions` (`TransactionID`);

--
-- Constraints for table `paymentstatus`
--
ALTER TABLE `paymentstatus`
  ADD CONSTRAINT `paymentstatus_ibfk_1` FOREIGN KEY (`PaymentID`) REFERENCES `payments` (`PaymentID`);

--
-- Constraints for table `predictionlogs`
--
ALTER TABLE `predictionlogs`
  ADD CONSTRAINT `predictionlogs_ibfk_1` FOREIGN KEY (`PredictionID`) REFERENCES `predictions` (`PredictionID`);

--
-- Constraints for table `predictions`
--
ALTER TABLE `predictions`
  ADD CONSTRAINT `predictions_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`);

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`);

--
-- Constraints for table `reviewratings`
--
ALTER TABLE `reviewratings`
  ADD CONSTRAINT `reviewratings_ibfk_1` FOREIGN KEY (`ReviewID`) REFERENCES `reviews` (`ReviewID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`ListingID`) REFERENCES `listings` (`ListingID`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`BuyerID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`SellerID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
