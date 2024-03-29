-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 04:31 AM
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
-- Database: `recoverybutterfly`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID_Category` int(11) NOT NULL,
  `Category_name` varchar(20) NOT NULL,
  `Category_description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID_Category`, `Category_name`, `Category_description`) VALUES
(4, 'eazeza', 'azeaze'),
(5, 'test', 'rearaerea');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `Ref_Donation` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `ID_Project` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `ID_Event` int(11) NOT NULL,
  `Event_date` date NOT NULL,
  `Event_type` varchar(20) NOT NULL,
  `Event_name` varchar(20) NOT NULL,
  `Event_description` varchar(20) NOT NULL,
  `Location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`ID_Event`, `Event_date`, `Event_type`, `Event_name`, `Event_description`, `Location`) VALUES
(9, '2025-11-12', 'Donation', 'test', 'test', 'test'),
(10, '2022-11-23', 'Donation', 'hello', 'test', 'test'),
(11, '2025-11-12', 'Donation', 'hello', 'test', 'test'),
(12, '2025-11-12', 'Donation', 'hello', 'test', 'test'),
(13, '2025-11-12', 'Donation', 'hello', 'test', 'test'),
(14, '2025-11-12', 'Donation', 'hello', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `ID_Feedback` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `ID_Project` int(11) NOT NULL,
  `Feedback_text` varchar(50) NOT NULL,
  `Feedback_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `ID_USER` int(11) NOT NULL,
  `ID_Org` int(11) NOT NULL,
  `Org_name` varchar(20) NOT NULL,
  `Org_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`ID_USER`, `ID_Org`, `Org_name`, `Org_description`) VALUES
(7, 0, 'Unicef', 'UNICEF is a UN organization dedicated to supporting children\'s rights and well-being worldwide throu');

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`id`, `id_event`, `id_user`, `etat`) VALUES
(2, 11, 1, 0),
(3, 9, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `ID_Payment` int(11) NOT NULL,
  `Payment_date` date NOT NULL,
  `Payment_method` varchar(20) NOT NULL,
  `Payment_amount` float NOT NULL,
  `ID_Product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID_Product` int(11) NOT NULL,
  `Product_name` varchar(20) NOT NULL,
  `Product_price` float NOT NULL,
  `Product_description` varchar(20) NOT NULL,
  `image_link` varchar(50) NOT NULL,
  `ID_Category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID_Product`, `Product_name`, `Product_price`, `Product_description`, `image_link`, `ID_Category`) VALUES
(2, 'test', 5, 'test desc ', 'test_image.png', 4);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `ID_Project` int(11) NOT NULL,
  `Project_name` varchar(20) NOT NULL,
  `Project_description` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `Goal` float NOT NULL,
  `Current_amount` float NOT NULL,
  `Percentage` float NOT NULL,
  `ID_Org` int(11) NOT NULL,
  `ID_Type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`ID_Project`, `Project_name`, `Project_description`, `start_date`, `Goal`, `Current_amount`, `Percentage`, `ID_Org`, `ID_Type`) VALUES
(1, 'asa', 'proj', '2024-01-03', 1000, 0, 0, 0, 4),
(29, 'asa', 'proj', '2024-01-03', 1000, 0, 0, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reclamation_tab`
--

CREATE TABLE `reclamation_tab` (
  `ID_Reclamation` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `Reclamation_text` varchar(50) NOT NULL,
  `Reclamation_date` date NOT NULL,
  `Reclamation_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `ID_Response` int(11) NOT NULL,
  `#ID_Reclamation` int(11) NOT NULL,
  `Response_text` varchar(50) NOT NULL,
  `Response_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `ID_Type` int(11) NOT NULL,
  `Type_name` varchar(20) NOT NULL,
  `Type_description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`ID_Type`, `Type_name`, `Type_description`) VALUES
(4, 'Education', 'Education');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Phone_number` int(8) NOT NULL,
  `Birthdate` date NOT NULL,
  `Country` varchar(40) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Role` int(11) NOT NULL,
  `Status` int(11) DEFAULT 0,
  `Banned` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `First_Name`, `Last_Name`, `Password`, `Phone_number`, `Birthdate`, `Country`, `Email`, `Role`, `Status`, `Banned`) VALUES
(6, 'Admin', 'Admin', '', 0, '2023-12-08', 'Norway', 'admin@admin.org', 0, 1, 0),
(7, 'Emma', 'Chen', 'emmapass', 135792468, '1994-06-25', 'China', 'emma@example.com', 1, 0, 0),
(8, 'Noah', 'Wang', 'noahpass', 246813579, '1991-11-08', 'Japan', 'noah@example.com', 1, 0, 0),
(9, 'Mia', 'Liu', 'miapass', 987654321, '1998-04-17', 'Singapore', 'mia@example.com', 1, 0, 0),
(10, 'William', 'Zhang', 'williampass', 123450987, '1993-09-30', 'Malaysia', 'william@example.com', 1, 0, 0),
(11, 'Isabella', 'Li', 'isabellapass', 987001234, '1995-12-12', 'India', 'isabella@example.com', 1, 0, 0),
(12, 'Emma', 'Lopez', 'emmapass', 111000111, '1994-06-18', 'Mexico', 'emma@example.com', 1, 0, 0),
(13, 'Noah', 'Chen', 'noahpass', 222000222, '1998-02-22', 'China', 'noah@example.com', 1, 0, 0),
(14, 'Isabella', 'Wong', 'isabellapass', 333000333, '1987-09-30', 'Singapore', 'isabella@example.com', 1, 0, 0),
(15, 'William', 'Gonzalez', 'williampass', 444000444, '1993-04-14', 'Brazil', 'william@example.com', 1, 0, 0),
(16, 'Mia', 'Kaur', 'miapass', 555000555, '1985-11-08', 'India', 'mia@example.com', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `ID_Volunteer` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `ID_Project` int(11) NOT NULL,
  `join_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID_Category`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`Ref_Donation`),
  ADD KEY `ID_USER` (`ID_USER`),
  ADD KEY `ID_Project` (`ID_Project`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`ID_Event`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID_Feedback`),
  ADD KEY `ID_Project` (`ID_Project`),
  ADD KEY `ID_User` (`ID_User`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`ID_Org`,`ID_USER`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_event` (`id_event`,`id_user`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`ID_Payment`),
  ADD KEY `Ref_donation` (`ID_Product`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID_Product`),
  ADD KEY `ID_Category` (`ID_Category`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`ID_Project`),
  ADD KEY `ID_Org` (`ID_Org`,`ID_Type`),
  ADD KEY `ID_Type` (`ID_Type`);

--
-- Indexes for table `reclamation_tab`
--
ALTER TABLE `reclamation_tab`
  ADD PRIMARY KEY (`ID_Reclamation`),
  ADD KEY `ID_User` (`ID_User`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`ID_Response`),
  ADD KEY `#ID_Reclamation` (`#ID_Reclamation`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`ID_Type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`ID_Volunteer`),
  ADD KEY `ID_User` (`ID_User`),
  ADD KEY `ID_Project` (`ID_Project`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID_Category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `Ref_Donation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `ID_Event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID_Feedback` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `ID_Org` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `participation`
--
ALTER TABLE `participation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `ID_Payment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `ID_Project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reclamation_tab`
--
ALTER TABLE `reclamation_tab`
  MODIFY `ID_Reclamation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `ID_Response` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `ID_Type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `volunteer`
--
ALTER TABLE `volunteer`
  MODIFY `ID_Volunteer` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donation_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donation_ibfk_2` FOREIGN KEY (`ID_Project`) REFERENCES `project` (`ID_Project`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`ID_Project`) REFERENCES `project` (`ID_Project`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `user` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `organization`
--
ALTER TABLE `organization`
  ADD CONSTRAINT `ID_UserC` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `event` (`ID_Event`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`ID_Product`) REFERENCES `product` (`ID_Product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`ID_Category`) REFERENCES `category` (`ID_Category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`ID_Org`) REFERENCES `organization` (`ID_Org`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`ID_Type`) REFERENCES `type` (`ID_Type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reclamation_tab`
--
ALTER TABLE `reclamation_tab`
  ADD CONSTRAINT `reclamation_tab_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `user` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_ibfk_1` FOREIGN KEY (`#ID_Reclamation`) REFERENCES `reclamation_tab` (`ID_Reclamation`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD CONSTRAINT `volunteer_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `user` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `volunteer_ibfk_2` FOREIGN KEY (`ID_Project`) REFERENCES `project` (`ID_Project`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
