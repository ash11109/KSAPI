-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 28, 2023 at 05:50 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ks`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories_tb`
--

DROP TABLE IF EXISTS `categories_tb`;
CREATE TABLE IF NOT EXISTS `categories_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories_tb`
--

INSERT INTO `categories_tb` (`id`, `parent_id`, `name`, `images`, `status`, `date`) VALUES
(1, 0, 'processor', 'KA20220925084849.jpg', '', '2023-06-16 03:19:34'),
(2, 1, 'AMD', 'KA20220925084848.jpg', '', '2023-06-16 03:19:34'),
(3, 0, 'Fruits', 'KA20220925084849.jpg', '', '2023-06-16 03:19:34'),
(4, 0, 'aaa', 'KA20220925084849.jpg', '', '2023-06-16 03:19:34'),
(5, 0, 'bbb', 'KA20220925084849.jpg', '', '2023-06-16 03:19:34'),
(6, 0, 'ccc', 'KA20220925084849.jpg', '', '2023-06-16 03:19:34'),
(7, 0, 'ddd', 'KA20220925084849.jpg', '', '2023-06-16 03:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `images_tb`
--

DROP TABLE IF EXISTS `images_tb`;
CREATE TABLE IF NOT EXISTS `images_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images_tb`
--

INSERT INTO `images_tb` (`id`, `pid`, `image_name`, `date`) VALUES
(1, '1', 'KA20220925084802.jpg', '2022-09-26 02:18:02'),
(2, '1', 'KA20220925084823.jpg', '2022-09-26 02:18:23'),
(3, '2', 'KA20220925084838.jpg', '2022-09-26 02:18:38'),
(4, '2', 'KA20220925084849.jpg', '2022-09-26 02:18:49'),
(5, '3', 'KA20220925050815.jpg', '2022-09-25 17:08:15'),
(6, '3', 'KA20220926043543.jpg', '2022-09-26 16:35:43'),
(7, '4', 'KA20230312102458.jpg', '2023-03-12 15:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

DROP TABLE IF EXISTS `keywords`;
CREATE TABLE IF NOT EXISTS `keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_nm` varchar(100) NOT NULL,
  `keyword` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `product_nm`, `keyword`, `date`) VALUES
(1, 'APPLE', 'apple,fresh apple,sweet apple', '2023-02-02 12:52:23'),
(2, 'APPLE', 'apple,fresh apple,sweet apple', '2023-02-02 12:52:23'),
(3, 'Banana', 'banana,', '2023-02-02 13:04:40'),
(4, 'aabb', 'aaa', '2023-03-12 15:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `product_tb`
--

DROP TABLE IF EXISTS `product_tb`;
CREATE TABLE IF NOT EXISTS `product_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_nm` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_cm` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tb`
--

INSERT INTO `product_tb` (`id`, `product_nm`, `product_cm`, `cat_id`, `description`) VALUES
(1, 'Ryzen 9', 'AMD', '2', 'About this item 12 Cores & 24 Threads, 20 MB Cache Base Clock: 3.8 GHz, Max Boost Clock: up to 4.6 GHz Memory Support: DDR4 Upto 3200 MHz, Memory Channels: 2, TDP: 65W Compatible with Motherboards based on 500 series chipset, Socket AM4 Graphics: AMD Radeon Graphics, Included Heatsink Fan: Wrgeneralth Stealth 3 Years Brand Warranty. For Technical Support : Please Contact : Tel: +91-80-67030050 (Mon-Fri: 09:00 - 17:00 IST); Expect Delayed Response due to ongoing COVID Crisis For all performance-related issues in: AMD Processor: Please reach out via AMD brand home page > Drivers & Support > Customer Support  (Technical & Warranty help) > Contact Support > Online Service Request In case you are not satisfied the resolution provided by the above brands, please reach back to Amazon Customer service for next steps.'),
(2, 'Ryzen 7', 'AMD', '2', 'About this item\n8 Cores & 16 Threads, 20 MB Cache\nBase Clock: 3.8 GHz, Max Boost Clock: up to 4.6 GHz\nMemory Support: DDR4 Upto 3200 MHz, Memory Channels: 2, TDP: 65W\nCompatible with Motherboards based on 500 series chipset, Socket AM4\nGraphics: AMD Radeon Graphics, Included Heatsink Fan: Wrgeneralth Stealth\n3 Years Brand Warranty. For Technical Support : Please Contact : Tel: +91-80-67030050 (Mon-Fri: 09:00 - 17:00 IST); Expect Delayed Response due to ongoing COVID Crisis\nFor all performance-related issues in: AMD Processor: Please reach out via AMD brand home page > Drivers & Support > Customer Support  (Technical & Warranty help) > Contact Support > Online Service Request In case you are not satisfied the resolution provided by the above brands, please reach back to Amazon Customer service for next steps.'),
(3, 'APPLE', 'Kashmiri Apple', '3', '<b>fresh and sweet</b>'),
(4, 'APPLE', 'Kashmiri Apple', '3', '<b>fresh and sweet</b>'),
(5, 'Banana', 'chiquita brands', '3', '<p><b style=\"\"><font color=\"#000000\" style=\"background-color: rgb(255, 156, 0);\">fresh and sweets</font></b><br></p>'),
(6, 'aabb', 'amd', '3', '<p>saddsa</p>');

-- --------------------------------------------------------

--
-- Table structure for table `product_var`
--

DROP TABLE IF EXISTS `product_var`;
CREATE TABLE IF NOT EXISTS `product_var` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `type_name_1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_qty_1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_name_2` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_qty_2` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fprice` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_var`
--

INSERT INTO `product_var` (`id`, `product_id`, `type_name_1`, `type_qty_1`, `type_name_2`, `type_qty_2`, `fprice`, `price`, `sku`) VALUES
(1, 1, 'SERIES', '5900X', 'SPECS', '8 Core', '80000', '39000', '456'),
(2, 1, 'SERIES', '5950X', 'SPECS', '12 cores', '90000', '51000', '789'),
(3, 2, 'Series', '5800X', 'Cores', '8', '60000', '40000', '111'),
(4, 3, 'kg', '5', 'size', 'small', '220', '180', '123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
