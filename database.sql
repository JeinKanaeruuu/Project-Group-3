-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2024 at 12:34 PM
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
-- Database: `rtbsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `menu_description` text DEFAULT NULL,
  `menu_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`menu_id`, `menu_name`, `menu_description`, `menu_price`) VALUES
(1, 'Nasi Goreng', 'Nasi yang digoreng dengan bumbu dan bahan-bahan lainnya', 10.50),
(2, 'Mie Ayam', 'Mie dengan potongan daging ayam dan kuah kaldu', 8.75),
(3, 'Ayam Bakar', 'Potongan ayam yang dibakar dengan bumbu rempah', 12.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(11) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `AdminuserName` varchar(20) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp(),
  `UserType` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `AdminuserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`, `UserType`) VALUES
(2, 'Admin', 'admin', 1234596321, 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2023-05-21 18:30:00', 1),
(7, 'Jein Ananda', 'Jein', 1234567890, '10221031@student.itk.ac.id', 'c4ca4238a0b923820dcc509a6f75849b', '2024-02-16 11:09:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblbookings`
--

CREATE TABLE `tblbookings` (
  `id` int(11) NOT NULL,
  `bookingNo` bigint(12) DEFAULT NULL,
  `fullName` varchar(200) DEFAULT NULL,
  `emailId` varchar(200) DEFAULT NULL,
  `phoneNumber` bigint(12) DEFAULT NULL,
  `bookingDate` date DEFAULT NULL,
  `bookingTime` varchar(100) DEFAULT NULL,
  `noAdults` bigint(20) DEFAULT NULL,
  `noChildrens` bigint(20) DEFAULT NULL,
  `tableId` int(11) DEFAULT NULL,
  `adminremark` varchar(255) DEFAULT NULL,
  `boookingStatus` varchar(15) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `tableNumber` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbookings`
--

INSERT INTO `tblbookings` (`id`, `bookingNo`, `fullName`, `emailId`, `phoneNumber`, `bookingDate`, `bookingTime`, `noAdults`, `noChildrens`, `tableId`, `adminremark`, `boookingStatus`, `postingDate`, `updationDate`, `tableNumber`) VALUES
(8, 9015284083, 'Jein Ananda', 'venommancer123@gmail.com', 9223372036854775807, '2024-02-14', '10 : 17 AM', 1, 1, 1, '112', 'Accepted', '2024-02-14 05:05:04', '2024-02-14 05:05:40', 3),
(9, 6450149619, 'jein ananda', 'aqilla123@gmail.com', 312321536477, '2024-02-14', '9 : 54 AM', 4, 0, 10, ' 1214fsaafs', 'Accepted', '2024-02-14 05:19:34', '2024-02-14 05:19:50', 5),
(10, 5357032870, 'Dinda', '10221075@student.itk.ac.id', 90324891249, '2024-02-15', '12 : 39 PM', 4, 0, 10, '143', 'Accepted', '2024-02-14 23:39:51', '2024-02-14 23:40:30', 5),
(11, 8508905827, 'ffaa', '10221075@student.itk.ac.id', 9223372036854775807, '2024-02-16', '12 : 39 PM', 1, 0, 1, '1', 'Accepted', '2024-02-16 11:22:56', '2024-02-16 11:31:25', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblrestables`
--

CREATE TABLE `tblrestables` (
  `id` int(11) NOT NULL,
  `tableNumber` varchar(100) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `AddedBy` int(11) DEFAULT NULL,
  `status` enum('available','occupied') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblrestables`
--

INSERT INTO `tblrestables` (`id`, `tableNumber`, `creationDate`, `AddedBy`, `status`) VALUES
(1, '1', '2023-05-27 03:50:35', 2, 'available'),
(2, '2', '2023-05-27 03:50:55', 2, 'available'),
(4, '3', '2023-05-27 03:51:07', 2, 'available'),
(9, '4', '2024-02-13 11:59:52', 2, 'available'),
(10, '5', '2024-02-14 05:19:12', 2, 'available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbookings`
--
ALTER TABLE `tblbookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblrestables`
--
ALTER TABLE `tblrestables`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblbookings`
--
ALTER TABLE `tblbookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblrestables`
--
ALTER TABLE `tblrestables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
