-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 04:20 PM
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
-- Database: `inventory_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(1) DEFAULT NULL,
  `product_id` int(2) DEFAULT NULL,
  `name` varchar(3) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `email` varchar(4) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `phone_number` varchar(5) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `gender` varchar(6) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `product_id`, `name`, `email`, `phone_number`, `gender`) VALUES
(12, 4, 'kam', 'samu', '07821', 'male'),
(11, 3, 'UWE', 'ruth', '07821', 'female'),
(NULL, NULL, NULL, 'enoc', NULL, NULL),
(NULL, NULL, NULL, 'eric', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(1) DEFAULT NULL,
  `product_name` varchar(2) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `product_description` int(3) DEFAULT NULL,
  `product_price` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `product_price`) VALUES
(12, 'sm', 4000, 350000);

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `stockin_id` int(1) DEFAULT NULL,
  `stock_transaction_id` int(2) DEFAULT NULL,
  `product_id` int(3) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `quantity` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stockin`
--

INSERT INTO `stockin` (`stockin_id`, `stock_transaction_id`, `product_id`, `transaction_date`, `quantity`) VALUES
(11, 12, 11, '2024-06-08', 6000),
(1, 2, 11, '2024-06-10', 500);

-- --------------------------------------------------------

--
-- Table structure for table `stockout`
--

CREATE TABLE `stockout` (
  `stockout_id` int(1) DEFAULT NULL,
  `stock_transactio_id` int(2) DEFAULT NULL,
  `product_id` int(3) DEFAULT NULL,
  `customer_id` int(4) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `quantity` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stockout`
--

INSERT INTO `stockout` (`stockout_id`, `stock_transactio_id`, `product_id`, `customer_id`, `transaction_date`, `quantity`) VALUES
(2, 3, 11, 6, '2024-06-08', 8000),
(7, 8, 3, 4, '2024-06-04', 9000);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transaction`
--

CREATE TABLE `stock_transaction` (
  `stock_transaction_id` int(1) DEFAULT NULL,
  `product_id` int(2) DEFAULT NULL,
  `transaction_type` varchar(3) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `quantity` varchar(4) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `transaction_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_transaction`
--

INSERT INTO `stock_transaction` (`stock_transaction_id`, `product_id`, `transaction_type`, `quantity`, `transaction_date`) VALUES
(2, 3, '43', '8000', '2024-06-03'),
(11, 12, '4', '6000', '2024-06-05');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(1) DEFAULT NULL,
  `product_id` int(2) DEFAULT NULL,
  `supplier_name` varchar(3) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `supplier_adress` varchar(4) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `supplier_contact` varchar(5) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `gender` varchar(6) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `product_id`, `supplier_name`, `supplier_adress`, `supplier_contact`, `gender`) VALUES
(3, 5, 'BYI', 'KIGA', '07911', 'male'),
(4, 7, 'YVA', 'KIGA', '07911', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(1) DEFAULT NULL,
  `username` varchar(2) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `first_name` varchar(3) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `last_name` varchar(4) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `email` varchar(5) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `password` varchar(5) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `gender` varchar(6) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `first_name`, `last_name`, `email`, `password`, `gender`) VALUES
(1, 'sa', '', '', 'xavie', '$2y$1', ''),
(5, 'uw', 'bah', 'Eric', 'eric@', '$2y$1', 'male'),
(9, 'sa', 'MAH', 'Eric', 'eric@', '$2y$1', 'male'),
(1, 'sa', 'uwa', 'ruth', 'ruth@', '$2y$1', 'female'),
(NULL, NULL, NULL, NULL, 'ruth@', '$2y$1', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
