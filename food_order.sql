-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2024 at 01:59 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `ID` int(10) UNSIGNED NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`ID`, `fullName`, `userName`, `password`) VALUES
(41, 'Mohamed', 'Mohamed_Sayed', 'c6d80670d464e4de1c2022a10108b2f7'),
(42, 'Aya ', 'Aya_Kamal', 'c6d80670d464e4de1c2022a10108b2f7');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `ID` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) DEFAULT NULL,
  `active` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`ID`, `title`, `image_name`, `featured`, `active`) VALUES
(31, 'Pizza', 'Food_Category_378.jpg', 'Yes', 'Yes'),
(32, 'Burger', 'Food_Category_55.jpg', 'Yes', 'Yes'),
(43, 'Momo', 'Food_Category_917.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `ID` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) DEFAULT NULL,
  `active` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`ID`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(26, 'Best Burger', ' Burger With Meat.Pineapple And Lots Of Cheese', '5.00', 'Food-Name-669ba60f796193.77245847.jpg', 31, 'Yes', 'Yes'),
(27, 'Momo', 'Good Momo & Good Price', '6.00', 'Food-Name-6698354c5d0ab6.82428497.jpg', 31, 'Yes', 'Yes'),
(33, 'Dumplings Special', 'Chicken Dumplings With Herbs From Mountains .', '5.00', 'Food-Name-669ba6add77c16.12055462.jpg', 34, 'Yes', 'Yes'),
(34, 'Smoky Pizza', 'Best Firewood Pizza In Town', '6.00', 'Food-Name-669bab42a54e44.40141930.jpg', 31, 'Yes', 'Yes'),
(39, 'Mixed Pizza', 'Pizza With Chicken , Mushroom And Vegetables', '7.00', 'Food-Name-669e07804af352.60609837.jpg', 31, 'Yes', 'Yes'),
(40, 'Sadeko Momo', 'Best Spicy Momo For Winter.', '6.00', 'Food-Name-669e08d399f834.99666672.jpg', 31, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `ID` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `customer_name` varchar(150) DEFAULT NULL,
  `customer_contact` varchar(20) DEFAULT NULL,
  `customer_email` varchar(150) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`ID`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Mixed Pizza', '7', 2, '14', '2024-07-22 04:09:17', 'Cancelled', 'Mohamed Sayed', '01155331015', 'mohamedsayed051213@gmail.com', '   Elshaheed street'),
(2, 'Momo', '6', 2, '12', '2024-07-23 07:26:22', 'Delivered', 'Mohamed Sayed', '01155331015', 'mohamedsayed051213@gmail.com', '           Elshaheed street'),
(3, 'Dumplings Special', '5', 1, '5', '2024-07-23 10:14:17', 'On Delivery', 'Ahmed Sayed', '01040179169', 'ahmedtito12389@gmail.com', ' Cairo\r\nElnasr City / Cairo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
