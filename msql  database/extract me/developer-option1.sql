-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 25, 2022 at 04:51 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developer-option`
--

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

DROP TABLE IF EXISTS `audits`;
CREATE TABLE IF NOT EXISTS `audits` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `middle_initial` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suffix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_paid` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `lastname_id` bigint(20) UNSIGNED DEFAULT NULL,
  `firstname_id` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lastname_fk_6943083` (`lastname_id`),
  KEY `firstname_fk_6943084` (`firstname_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `host` varchar(46) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES
(1, 'audit:created', 1, 'App\\Models\\ListOfName#1', 1, '{\"house_number\":\"1\",\"last_name\":\"Marcos\",\"first_name\":\"Angel Bong Bong\",\"middle_initial\":\"R.\",\"customer_year\":\"2022\",\"customer_number\":\"00001\",\"meter_number\":\"123\",\"installation\":\"Installed\",\"phone\":\"09318783025\",\"Province\":\"NUEVA VIZCAYA\",\"City\":\"Aritao\",\"Brgy\":\"Nagcuartelan\",\"Purok\":\"2\",\"Street\":\"N\\/A\",\"updated_at\":\"2022-08-05 10:09:44\",\"created_at\":\"2022-08-05 10:09:44\",\"id\":1}', '::1', '2022-08-05 02:09:44', '2022-08-05 02:09:44'),
(2, 'audit:created', 1, 'App\\Models\\BillSettings#1', 1, '{\"billing_date\":\"2022-01-01T00:00:00.000000Z\",\"price\":\"30\",\"updated_at\":\"2022-08-05T10:10:11.000000Z\",\"created_at\":\"2022-08-05T10:10:11.000000Z\",\"id\":1}', '::1', '2022-08-05 02:10:11', '2022-08-05 02:10:11'),
(3, 'audit:created', 2, 'App\\Models\\BillSettings#2', 1, '{\"billing_date\":\"2022-02-01T00:00:00.000000Z\",\"price\":\"30\",\"updated_at\":\"2022-08-05T10:10:15.000000Z\",\"created_at\":\"2022-08-05T10:10:15.000000Z\",\"id\":2}', '::1', '2022-08-05 02:10:15', '2022-08-05 02:10:15'),
(4, 'audit:created', 3, 'App\\Models\\BillSettings#3', 1, '{\"billing_date\":\"2022-03-01T00:00:00.000000Z\",\"price\":\"30\",\"updated_at\":\"2022-08-05T10:10:18.000000Z\",\"created_at\":\"2022-08-05T10:10:18.000000Z\",\"id\":3}', '::1', '2022-08-05 02:10:18', '2022-08-05 02:10:18'),
(5, 'audit:created', 4, 'App\\Models\\BillSettings#4', 1, '{\"billing_date\":\"2022-04-01T00:00:00.000000Z\",\"price\":\"30\",\"updated_at\":\"2022-08-05T10:10:23.000000Z\",\"created_at\":\"2022-08-05T10:10:23.000000Z\",\"id\":4}', '::1', '2022-08-05 02:10:23', '2022-08-05 02:10:23'),
(6, 'audit:created', 5, 'App\\Models\\BillSettings#5', 1, '{\"billing_date\":\"2022-05-01T00:00:00.000000Z\",\"price\":\"30\",\"updated_at\":\"2022-08-05T10:10:27.000000Z\",\"created_at\":\"2022-08-05T10:10:27.000000Z\",\"id\":5}', '::1', '2022-08-05 02:10:27', '2022-08-05 02:10:27'),
(7, 'audit:created', 6, 'App\\Models\\BillSettings#6', 1, '{\"billing_date\":\"2022-06-01T00:00:00.000000Z\",\"price\":\"30\",\"updated_at\":\"2022-08-05T10:10:30.000000Z\",\"created_at\":\"2022-08-05T10:10:30.000000Z\",\"id\":6}', '::1', '2022-08-05 02:10:30', '2022-08-05 02:10:30'),
(8, 'audit:created', 7, 'App\\Models\\BillSettings#7', 1, '{\"billing_date\":\"2022-07-01T00:00:00.000000Z\",\"price\":\"30\",\"updated_at\":\"2022-08-05T10:10:34.000000Z\",\"created_at\":\"2022-08-05T10:10:34.000000Z\",\"id\":7}', '::1', '2022-08-05 02:10:34', '2022-08-05 02:10:34'),
(9, 'audit:created', 8, 'App\\Models\\BillSettings#8', 1, '{\"billing_date\":\"2022-08-01T00:00:00.000000Z\",\"price\":\"30\",\"updated_at\":\"2022-08-05T10:10:37.000000Z\",\"created_at\":\"2022-08-05T10:10:37.000000Z\",\"id\":8}', '::1', '2022-08-05 02:10:37', '2022-08-05 02:10:37'),
(10, 'audit:created', 9, 'App\\Models\\BillSettings#9', 1, '{\"billing_date\":\"2022-09-01T00:00:00.000000Z\",\"price\":\"30\",\"updated_at\":\"2022-08-05T10:10:41.000000Z\",\"created_at\":\"2022-08-05T10:10:41.000000Z\",\"id\":9}', '::1', '2022-08-05 02:10:41', '2022-08-05 02:10:41'),
(11, 'audit:created', 10, 'App\\Models\\BillSettings#10', 1, '{\"billing_date\":\"2022-10-01T00:00:00.000000Z\",\"price\":\"30\",\"updated_at\":\"2022-08-05T10:10:45.000000Z\",\"created_at\":\"2022-08-05T10:10:45.000000Z\",\"id\":10}', '::1', '2022-08-05 02:10:45', '2022-08-05 02:10:45'),
(12, 'audit:created', 11, 'App\\Models\\BillSettings#11', 1, '{\"billing_date\":\"2022-11-01T00:00:00.000000Z\",\"price\":\"30\",\"updated_at\":\"2022-08-05T10:10:49.000000Z\",\"created_at\":\"2022-08-05T10:10:49.000000Z\",\"id\":11}', '::1', '2022-08-05 02:10:49', '2022-08-05 02:10:49'),
(13, 'audit:created', 12, 'App\\Models\\BillSettings#12', 1, '{\"billing_date\":\"2022-12-01T00:00:00.000000Z\",\"price\":\"30\",\"updated_at\":\"2022-08-05T10:10:54.000000Z\",\"created_at\":\"2022-08-05T10:10:54.000000Z\",\"id\":12}', '::1', '2022-08-05 02:10:54', '2022-08-05 02:10:54'),
(14, 'audit:created', 1, 'App\\Models\\Invoice#1', 1, '{\"disconnection_date\":\"2022-02-14\",\"name_id\":\"1\",\"prev_reading\":\"0\",\"present_reading\":\"1\",\"water_usage\":\"1\",\"price_per_cb\":\"30\",\"system_lost\":\"5\",\"discount\":null,\"total_amount\":\"35\",\"note\":null,\"get_pay_until_date\":\"2022-02-08\",\"reading_date_from\":\"2022-01-03\",\"reading_date_to\":\"2022-02-03\",\"bill_year\":\"2022\",\"bill_number\":\"00001\",\"balance\":\"35\",\"payment\":\"0.00\",\"paymentStatus\":\"New\",\"disconnectionStatus\":\"normal\",\"penalty\":\"0.00\",\"autditStatus\":\"notaudited\",\"updated_at\":\"2022-08-05 10:11:35\",\"created_at\":\"2022-08-05 10:11:35\",\"id\":1}', '::1', '2022-08-05 02:11:35', '2022-08-05 02:11:35'),
(15, 'audit:created', 2, 'App\\Models\\ListOfName#2', 1, '{\"house_number\":\"1\",\"last_name\":\"Marcos\",\"first_name\":\"josh\",\"middle_initial\":\"R\",\"customer_year\":\"2022\",\"customer_number\":\"00002\",\"meter_number\":\"1234\",\"installation\":\"Installed\",\"phone\":\"09318783025\",\"Province\":\"NUEVA VIZCAYA\",\"City\":\"Aritao\",\"Brgy\":\"nagcuartelan\",\"Purok\":\"2\",\"Street\":\"N\\/A\",\"updated_at\":\"2022-08-06 06:33:13\",\"created_at\":\"2022-08-06 06:33:13\",\"id\":2}', '::1', '2022-08-05 22:33:13', '2022-08-05 22:33:13'),
(16, 'audit:created', 3, 'App\\Models\\ListOfName#3', 1, '{\"house_number\":\"3\",\"last_name\":\"Marcos\",\"first_name\":\"asd\",\"middle_initial\":\"s\",\"customer_year\":\"2022\",\"customer_number\":\"00003\",\"meter_number\":\"12345\",\"installation\":\"Installed\",\"phone\":\"09318783025\",\"Province\":\"NUEVA VIZCAYA\",\"City\":\"Aritao\",\"Brgy\":\"nagcuartelan\",\"Purok\":\"2\",\"Street\":\"N\\/A\",\"updated_at\":\"2022-08-06 06:34:03\",\"created_at\":\"2022-08-06 06:34:03\",\"id\":3}', '::1', '2022-08-05 22:34:03', '2022-08-05 22:34:03'),
(17, 'audit:created', 4, 'App\\Models\\ListOfName#4', 1, '{\"house_number\":\"3\",\"last_name\":\"Marcos\",\"first_name\":\"asdas\",\"middle_initial\":\"s\",\"customer_year\":\"2022\",\"customer_number\":\"00003\",\"meter_number\":\"123456\",\"installation\":\"Installed\",\"phone\":\"09318783025\",\"Province\":\"NUEVA VIZCAYA\",\"City\":\"Aritao\",\"Brgy\":\"nagcuartelan\",\"Purok\":\"2\",\"Street\":\"N\\/A\",\"updated_at\":\"2022-08-06 06:34:18\",\"created_at\":\"2022-08-06 06:34:18\",\"id\":4}', '::1', '2022-08-05 22:34:18', '2022-08-05 22:34:18'),
(18, 'audit:deleted', 3, 'App\\Models\\ListOfName#3', 1, '{\"id\":3,\"house_number\":3,\"last_name\":\"Marcos\",\"first_name\":\"asd\",\"middle_initial\":\"s\",\"customers_number\":\"2022-00004\",\"meter_number\":\"12345\",\"address\":null,\"Province\":\"NUEVA VIZCAYA\",\"City\":\"Aritao\",\"Brgy\":\"nagcuartelan\",\"Purok\":\"2\",\"Street\":\"N\\/A\",\"installation\":\"Installed\",\"connection\":\"Connected\",\"created_at\":\"2022-08-06 06:34:03\",\"updated_at\":\"2022-08-06 06:35:27\",\"deleted_at\":\"2022-08-06 06:35:27\",\"phone\":\"09318783025\",\"customer_year\":\"2022\",\"customer_number\":\"00003\"}', '::1', '2022-08-05 22:35:27', '2022-08-05 22:35:27'),
(19, 'audit:created', 5, 'App\\Models\\ListOfName#5', 1, '{\"house_number\":\"4\",\"last_name\":\"Marcos\",\"first_name\":\"Angel25\",\"middle_initial\":\"T\",\"customer_year\":\"2022\",\"customer_number\":\"00004\",\"meter_number\":\"12345\",\"installation\":\"Installed\",\"phone\":\"09318783025\",\"Province\":\"NUEVA VIZCAYA\",\"City\":\"Aritao\",\"Brgy\":\"nagcuartelan\",\"Purok\":\"2\",\"Street\":\"N\\/A\",\"updated_at\":\"2022-08-06 06:36:01\",\"created_at\":\"2022-08-06 06:36:01\",\"id\":5}', '::1', '2022-08-05 22:36:01', '2022-08-05 22:36:01'),
(20, 'audit:created', 2, 'App\\Models\\Invoice#2', 1, '{\"disconnection_date\":\"2022-09-10\",\"name_id\":\"5\",\"prev_reading\":\"0\",\"present_reading\":\"12\",\"water_usage\":\"12\",\"price_per_cb\":\"30\",\"system_lost\":null,\"discount\":null,\"total_amount\":\"360\",\"note\":null,\"get_pay_until_date\":\"2022-09-05\",\"reading_date_from\":\"2022-08-08\",\"reading_date_to\":\"2022-08-31\",\"bill_year\":\"2022\",\"bill_number\":\"00002\",\"balance\":\"360\",\"payment\":\"0.00\",\"paymentStatus\":\"New\",\"disconnectionStatus\":\"normal\",\"penalty\":\"0.00\",\"autditStatus\":\"notaudited\",\"updated_at\":\"2022-08-08 03:26:37\",\"created_at\":\"2022-08-08 03:26:37\",\"id\":2}', '::1', '2022-08-07 19:26:37', '2022-08-07 19:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `bill_settings`
--

DROP TABLE IF EXISTS `bill_settings`;
CREATE TABLE IF NOT EXISTS `bill_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `billing_date` date DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_settings`
--

INSERT INTO `bill_settings` (`id`, `billing_date`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2022-01-01', '30', '2022-08-05 02:10:11', '2022-08-05 02:10:11', NULL),
(2, '2022-02-01', '30', '2022-08-05 02:10:15', '2022-08-05 02:10:15', NULL),
(3, '2022-03-01', '30', '2022-08-05 02:10:18', '2022-08-05 02:10:18', NULL),
(4, '2022-04-01', '30', '2022-08-05 02:10:23', '2022-08-05 02:10:23', NULL),
(5, '2022-05-01', '30', '2022-08-05 02:10:27', '2022-08-05 02:10:27', NULL),
(6, '2022-06-01', '30', '2022-08-05 02:10:30', '2022-08-05 02:10:30', NULL),
(7, '2022-07-01', '30', '2022-08-05 02:10:34', '2022-08-05 02:10:34', NULL),
(8, '2022-08-01', '30', '2022-08-05 02:10:37', '2022-08-05 02:10:37', NULL),
(9, '2022-09-01', '30', '2022-08-05 02:10:41', '2022-08-05 02:10:41', NULL),
(10, '2022-10-01', '30', '2022-08-05 02:10:45', '2022-08-05 02:10:45', NULL),
(11, '2022-11-01', '30', '2022-08-05 02:10:49', '2022-08-05 02:10:49', NULL),
(12, '2022-12-01', '30', '2022-08-05 02:10:54', '2022-08-05 02:10:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checkinout`
--

DROP TABLE IF EXISTS `checkinout`;
CREATE TABLE IF NOT EXISTS `checkinout` (
  `USERID` int(11) NOT NULL,
  `CHECKTIME` datetime NOT NULL,
  `CHECKTYPE` char(5) CHARACTER SET utf8 DEFAULT NULL,
  `VERIFYCODE` tinyint(4) DEFAULT NULL,
  `SENSORID` int(11) DEFAULT NULL,
  `archived` tinyint(3) UNSIGNED DEFAULT '0',
  `Memoinfo` char(5) CHARACTER SET utf8 DEFAULT NULL,
  `WorkCode` tinyint(4) DEFAULT NULL,
  `sn` bigint(20) DEFAULT NULL,
  `UserExtFmt` tinyint(4) DEFAULT NULL,
  `ACTIVE_TS` char(5) CHARACTER SET utf8 DEFAULT NULL,
  `raw` text COLLATE utf8_bin,
  PRIMARY KEY (`USERID`,`CHECKTIME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `information_reports`
--

DROP TABLE IF EXISTS `information_reports`;
CREATE TABLE IF NOT EXISTS `information_reports` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `info_reports` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reading_date_from` date DEFAULT NULL,
  `reading_date_to` date DEFAULT NULL,
  `prev_reading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_reading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `water_usage` int(11) DEFAULT NULL,
  `price_per_cb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_lost` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `get_pay_until_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `name_id` bigint(20) UNSIGNED DEFAULT NULL,
  `balance` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `payment` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymentStatus` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disconnectionStatus` enum('normal','for_disconnection','disconnected') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penalty` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `autditStatus` enum('audited','notaudited') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_number` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_year` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymentdate` date DEFAULT NULL,
  `disconnection_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `last_name_fk_7012413` (`name_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `reading_date_from`, `reading_date_to`, `prev_reading`, `present_reading`, `water_usage`, `price_per_cb`, `discount`, `system_lost`, `total_amount`, `note`, `get_pay_until_date`, `created_at`, `updated_at`, `deleted_at`, `name_id`, `balance`, `status`, `payment`, `paymentStatus`, `disconnectionStatus`, `penalty`, `autditStatus`, `bill_number`, `bill_year`, `paymentdate`, `disconnection_date`) VALUES
(1, '2022-01-03', '2022-02-03', '0', '1', 1, '30', NULL, '5', '35', NULL, '2022-02-08', '2022-08-05 02:11:35', '2022-08-07 19:36:09', NULL, 1, '0', NULL, '65', 'Fully Paid', 'normal', '30', 'audited', '00001', '2022', '2022-08-05', '2022-02-14'),
(2, '2022-08-08', '2022-08-31', '0', '12', 12, '30', NULL, NULL, '360', NULL, '2022-09-05', '2022-08-07 19:26:37', '2022-08-07 19:36:14', NULL, 5, '360', NULL, '0.00', 'New', 'normal', '0.00', 'audited', '00002', '2022', NULL, '2022-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `list_of_names`
--

DROP TABLE IF EXISTS `list_of_names`;
CREATE TABLE IF NOT EXISTS `list_of_names` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `house_number` int(11) NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_initial` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customers_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meter_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Province` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Brgy` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Purok` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Street` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `connection` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT 'Connected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_year` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_number` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `list_of_names`
--

INSERT INTO `list_of_names` (`id`, `house_number`, `last_name`, `first_name`, `middle_initial`, `customers_number`, `meter_number`, `address`, `Province`, `City`, `Brgy`, `Purok`, `Street`, `installation`, `connection`, `created_at`, `updated_at`, `deleted_at`, `phone`, `customer_year`, `customer_number`) VALUES
(1, 1, 'Marcos', 'Angel Bong Bong', 'R.', NULL, '123', NULL, 'NUEVA VIZCAYA', 'Aritao', 'Nagcuartelan', '2', 'N/A', 'Installed', 'Connected', '2022-08-05 02:09:44', '2022-08-05 02:09:44', NULL, '09318783025', '2022', '00001'),
(2, 1, 'Marcos', 'josh', 'R', NULL, '1234', NULL, 'NUEVA VIZCAYA', 'Aritao', 'nagcuartelan', '2', 'N/A', 'Installed', 'Connected', '2022-08-05 22:33:13', '2022-08-05 22:33:13', NULL, '09318783025', '2022', '00002'),
(3, 3, 'Marcos', 'asd', 's', '2022-00004', '12345', NULL, 'NUEVA VIZCAYA', 'Aritao', 'nagcuartelan', '2', 'N/A', 'Installed', 'Connected', '2022-08-05 22:34:03', '2022-08-05 22:35:27', '2022-08-05 22:35:27', '09318783025', '2022', '00003'),
(4, 3, 'Marcos', 'asdas', 's', NULL, '123456', NULL, 'NUEVA VIZCAYA', 'Aritao', 'nagcuartelan', '2', 'N/A', 'Installed', 'Connected', '2022-08-05 22:34:18', '2022-08-05 22:34:18', NULL, '09318783025', '2022', '00003'),
(5, 4, 'Marcos', 'Angel25', 'T', NULL, '12345', NULL, 'NUEVA VIZCAYA', 'Aritao', 'nagcuartelan', '2', 'N/A', 'Installed', 'Connected', '2022-08-05 22:36:01', '2022-08-05 22:36:01', NULL, '09318783025', '2022', '00004');

-- --------------------------------------------------------

--
-- Table structure for table `locals`
--

DROP TABLE IF EXISTS `locals`;
CREATE TABLE IF NOT EXISTS `locals` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `barangay` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memo_reports`
--

DROP TABLE IF EXISTS `memo_reports`;
CREATE TABLE IF NOT EXISTS `memo_reports` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `memo` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `messages` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2022_07_19_000001_create_audit_logs_table', 1),
(4, '2022_07_19_000002_create_media_table', 1),
(5, '2022_07_19_000003_create_permissions_table', 1),
(6, '2022_07_19_000004_create_roles_table', 1),
(7, '2022_07_19_000005_create_users_table', 1),
(8, '2022_07_19_000006_create_list_of_names_table', 1),
(9, '2022_07_19_000007_create_locals_table', 1),
(10, '2022_07_19_000008_create_reports_table', 1),
(11, '2022_07_19_000009_create_messages_table', 1),
(12, '2022_07_19_000010_create_audits_table', 1),
(13, '2022_07_19_000011_create_information_reports_table', 1),
(14, '2022_07_19_000012_create_memo_reports_table', 1),
(15, '2022_07_19_000013_create_invoices_table', 1),
(16, '2022_07_19_000014_create_permission_role_pivot_table', 1),
(17, '2022_07_19_000015_create_role_user_pivot_table', 1),
(18, '2022_07_19_000016_add_relationship_fields_to_reports_table', 1),
(19, '2022_07_19_000017_add_relationship_fields_to_audits_table', 1),
(20, '2022_07_19_000018_add_relationship_fields_to_invoices_table', 1),
(21, '2022_07_19_000019_add_approval_fields', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', NULL, NULL, NULL),
(2, 'permission_create', NULL, NULL, NULL),
(3, 'permission_edit', NULL, NULL, NULL),
(4, 'permission_show', NULL, NULL, NULL),
(5, 'permission_delete', NULL, NULL, NULL),
(6, 'permission_access', NULL, NULL, NULL),
(7, 'role_create', NULL, NULL, NULL),
(8, 'role_edit', NULL, NULL, NULL),
(9, 'role_show', NULL, NULL, NULL),
(10, 'role_delete', NULL, NULL, NULL),
(11, 'role_access', NULL, NULL, NULL),
(12, 'user_create', NULL, NULL, NULL),
(13, 'user_edit', NULL, NULL, NULL),
(14, 'user_show', NULL, NULL, NULL),
(15, 'user_delete', NULL, NULL, NULL),
(16, 'user_access', NULL, NULL, NULL),
(17, 'secretary_access', NULL, NULL, NULL),
(18, 'treasurer_access', NULL, NULL, NULL),
(19, 'auditor_access', NULL, NULL, NULL),
(20, 'bookkeeper_access', NULL, NULL, NULL),
(21, 'audit_log_show', NULL, NULL, NULL),
(22, 'audit_log_access', NULL, NULL, NULL),
(23, 'list_of_name_create', NULL, NULL, NULL),
(24, 'list_of_name_edit', NULL, NULL, NULL),
(25, 'list_of_name_show', NULL, NULL, NULL),
(26, 'list_of_name_delete', NULL, NULL, NULL),
(27, 'list_of_name_access', NULL, NULL, NULL),
(28, 'local_create', NULL, NULL, NULL),
(29, 'local_edit', NULL, NULL, NULL),
(30, 'local_show', NULL, NULL, NULL),
(31, 'local_delete', NULL, NULL, NULL),
(32, 'local_access', NULL, NULL, NULL),
(33, 'report_create', NULL, NULL, NULL),
(34, 'report_edit', NULL, NULL, NULL),
(35, 'report_show', NULL, NULL, NULL),
(36, 'report_delete', NULL, NULL, NULL),
(37, 'report_access', NULL, NULL, NULL),
(38, 'message_create', NULL, NULL, NULL),
(39, 'message_edit', NULL, NULL, NULL),
(40, 'message_show', NULL, NULL, NULL),
(41, 'message_delete', NULL, NULL, NULL),
(42, 'message_access', NULL, NULL, NULL),
(43, 'audit_create', NULL, NULL, NULL),
(44, 'audit_edit', NULL, NULL, NULL),
(45, 'audit_show', NULL, NULL, NULL),
(46, 'audit_delete', NULL, NULL, NULL),
(47, 'audit_access', NULL, NULL, NULL),
(48, 'information_report_create', NULL, NULL, NULL),
(49, 'information_report_edit', NULL, NULL, NULL),
(50, 'information_report_show', NULL, NULL, NULL),
(51, 'information_report_delete', NULL, NULL, NULL),
(52, 'information_report_access', NULL, NULL, NULL),
(53, 'memo_report_create', NULL, NULL, NULL),
(54, 'memo_report_edit', NULL, NULL, NULL),
(55, 'memo_report_show', NULL, NULL, NULL),
(56, 'memo_report_delete', NULL, NULL, NULL),
(57, 'memo_report_access', NULL, NULL, NULL),
(58, 'invoice_create', NULL, NULL, NULL),
(59, 'invoice_edit', NULL, NULL, NULL),
(60, 'invoice_show', NULL, NULL, NULL),
(61, 'invoice_delete', NULL, NULL, NULL),
(62, 'invoice_access', NULL, NULL, NULL),
(63, 'profile_password_edit', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  KEY `role_id_fk_6942819` (`role_id`),
  KEY `permission_id_fk_6942819` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 18),
(1, 20),
(3, 18),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(4, 27),
(3, 20),
(4, 24),
(4, 25),
(4, 26),
(3, 63),
(3, 62),
(4, 20),
(3, 60),
(3, 59),
(3, 58),
(3, 37),
(4, 23),
(3, 35),
(3, 34),
(3, 33),
(3, 23),
(3, 27),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 17),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(2, 42),
(2, 43),
(2, 44),
(2, 45),
(2, 46),
(2, 47),
(2, 48),
(2, 49),
(2, 50),
(2, 51),
(2, 52),
(2, 53),
(2, 54),
(2, 55),
(2, 56),
(2, 57),
(2, 58),
(2, 59),
(2, 60),
(2, 61),
(2, 62),
(2, 63),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 19),
(1, 43),
(1, 44),
(1, 45),
(1, 21),
(1, 22),
(1, 46),
(1, 47),
(1, 63);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_payment_date` date NOT NULL,
  `balance` int(11) DEFAULT NULL,
  `bill_paid` int(11) DEFAULT NULL,
  `paid_pending` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `lastname_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name_id` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lastname_fk_6942942` (`lastname_id`),
  KEY `first_name_fk_6942943` (`first_name_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, NULL, NULL),
(2, 'User', NULL, '2022-08-02 22:53:30', '2022-08-02 22:53:30'),
(3, 'treasurer', '2022-08-04 02:35:09', '2022-08-04 02:35:09', NULL),
(4, 'bookkeeper', '2022-08-04 02:42:10', '2022-08-04 02:42:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  KEY `user_id_fk_6942828` (`user_id`),
  KEY `role_id_fk_6942828` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved` tinyint(1) DEFAULT '0',
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `approved`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$ib85vBxg.bxcqInkLG95O.ixKInGa54nzT1xdCq.7pjqiBAh.nbfa', 1, 'tfYtLL5ANNiKoG0cuwkar8Hn7i2fsRaCCm0MU61EXfOBNMGafrODek22hbwU', NULL, NULL, NULL),
(2, 'treasurer', 'tres@tres.com', NULL, '$2y$10$GrwzMRqtJPrUjT5oO7l08O26.obqz9fLMKiVRiBreXFKKQAZP5G7q', 1, NULL, '2022-08-04 02:36:07', '2022-08-04 02:36:07', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
