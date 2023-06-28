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
-- Database: `ks_abcd`
--

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

DROP TABLE IF EXISTS `addons`;
CREATE TABLE IF NOT EXISTS `addons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` varchar(10) NOT NULL,
  `description` varchar(500) NOT NULL,
  `purchase_status` varchar(5) NOT NULL,
  `activation_status` varchar(5) NOT NULL,
  `links` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `addons`
--

INSERT INTO `addons` (`id`, `name`, `price`, `description`, `purchase_status`, `activation_status`, `links`, `date`) VALUES
(1, 'THEME', '100', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is avail', '0', '0', 'https://www.youtube.com/', '2023-06-25 13:34:43'),
(2, 'GST', '1000', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is avail', '0', '0', 'https://www.youtube.com/', '2023-06-25 13:34:43');

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
  `status` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories_tb`
--

INSERT INTO `categories_tb` (`id`, `parent_id`, `name`, `images`, `status`) VALUES
(1, 0, 'games', 'KA_CAT_20230624082908.jpg', '1'),
(2, 0, 'A PR', 'KA_CAT_20230624092410.jpg', '0'),
(3, 0, 'fruits', 'KA_CAT_20230624092421.jpg', '0'),
(4, 51, 'processor', 'KA_CAT_20230624092453.jpg', '1'),
(51, 0, 'AMD', 'KA_CAT_20230624092213.jpg', '1'),
(53, 0, 'grocery', 'KA_CAT_20230624075432.jpg', '1'),
(54, 4, 'vegi', 'KA_CAT_20230624075727.jpg', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images_tb`
--

INSERT INTO `images_tb` (`id`, `pid`, `image_name`, `date`) VALUES
(84, '46', 'KA_PR_20230626030543.jpg', '2023-06-26 20:35:43'),
(85, '54', 'KA_PR_20230626035918.jpg', '2023-06-26 21:29:18'),
(68, '48', 'KA_PR_20230625045323.jpg', '2023-06-25 22:24:50'),
(77, '53', 'KA_PR_20230626114123.jpg', '2023-06-26 17:11:23');

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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `product_nm`, `keyword`, `date`) VALUES
(39, 'JAR', 'qqqq', '2023-06-26 21:29:18'),
(38, 'sweets', 'gsdhjsg', '2023-06-25 22:23:23');

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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tb`
--

INSERT INTO `product_tb` (`id`, `product_nm`, `product_cm`, `cat_id`, `description`) VALUES
(63, 'sweets1', 'ash1', '53', 'a1'),
(65, 'Ryzen 9', 'AMD', '-1', 'About this item 12 Cores & 24 Threads, 20 MB Cache Base Clock: 3.8 GHz, Max Boost Clock: up to 4.6 GHz Memory Support: DDR4 Upto 3200 MHz, Memory Channels: 2, TDP: 65W Compatible with Motherboards based on 500 series chipset, Socket AM4 Graphics: AMD Radeon Graphics, Included Heatsink Fan: Wrgeneralth Stealth 3 Years Brand Warranty. For Technical Support : Please Contact : Tel: +91-80-67030050 (Mon-Fri: 09:00 - 17:00 IST); Expect Delayed Response due to ongoing COVID Crisis For all performance-related issues in: AMD Processor: Please reach out via AMD brand home page > Drivers & Support > Customer Support  (Technical & Warranty help) > Contact Support > Online Service Request In case you are not satisfied the resolution provided by the above brands, please reach back to Amazon Customer service for next steps.'),
(70, 'JAR', 'aa', '2', 'qqqq');

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
  `qty` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_var`
--

INSERT INTO `product_var` (`id`, `product_id`, `type_name_1`, `type_qty_1`, `type_name_2`, `type_qty_2`, `fprice`, `price`, `sku`, `qty`, `gst`, `status`) VALUES
(46, 63, 'a1', 'a1', 'a1', 'a1', '2501', '101', '1234561', '60', '0', '0'),
(48, 65, 'SERIES', '5900X', 'SPECS', '8 Core', '80000', '39000', '456', '0', '0', '0'),
(53, 63, 't1', 't2', 't3', 't4', '250', '200', '23', '20', '0', '1'),
(54, 70, 'q', 'q', 'q', 'q', '123', '123', '0', '0', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(5) NOT NULL,
  `qty` varchar(5) NOT NULL,
  `price` varchar(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `pid`, `qty`, `price`, `date`) VALUES
(2, '46', '0', '100', '2023-06-25 22:23:23'),
(5, '46', '10', '10', '2023-06-26 03:54:34'),
(4, '48', '0', '39000', '2023-06-25 22:24:50'),
(6, '49', '0', '61000', '2023-06-26 16:19:33'),
(7, '50', '0', '51000', '2023-06-26 16:21:02'),
(8, '51', '0', '51000', '2023-06-26 16:21:14'),
(9, '52', '0', '51000', '2023-06-26 16:24:10'),
(10, '53', '0', '200', '2023-06-26 17:11:23'),
(11, '54', '0', '123', '2023-06-26 21:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `renewal_date` datetime NOT NULL DEFAULT current_timestamp(),
  `wallet` varchar(20) NOT NULL,
  `status` varchar(5) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `type`, `name`, `address`, `mobile`, `renewal_date`, `wallet`, `status`, `date`) VALUES
(1, 'admin', '12345', '2', '', '', '', '2023-06-05 17:43:00', '5000', '1', '2023-06-04 18:09:18'),
(2, 'AMIT123', '123123', '1', 'AMIT', 'RANCHI', '123123', '2023-06-05 17:43:00', '0', '1', '2023-06-04 18:09:18'),
(3, 'abhi', '123', '1', 'a', '', '1234567800', '2023-06-26 22:27:45', '0', '1', '2023-06-26 22:27:45'),
(4, 'rajunew', '123', '1', 'raju', '', '1234567800', '2023-06-26 22:36:14', '0', '1', '2023-06-26 22:36:14'),
(5, 'rajunew1', '123', '1', 'raju', '', '1234567800', '2023-06-26 22:38:00', '0', '1', '2023-06-26 22:38:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
