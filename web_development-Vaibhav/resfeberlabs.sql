-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2014 at 09:07 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `resfeberlabs`
--
CREATE DATABASE IF NOT EXISTS `resfeberlabs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `resfeberlabs`;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `customer_mobile` bigint(20) NOT NULL,
  `location_id` bigint(20) DEFAULT NULL,
  `confirmcode` varchar(32) NOT NULL COMMENT 'Confirmation Code For Email',
  `date_of_join` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verification_code` varchar(8) DEFAULT NULL COMMENT 'Mobile Verification Code',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Table to Store List of Customers & Their Personal Details' AUTO_INCREMENT=9 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `email`, `password`, `customer_mobile`, `location_id`, `confirmcode`, `date_of_join`, `verification_code`) VALUES
(8, 'Vivek', 'Vishal', 'v.vishal05@yahoo.com', 'cf1852c25f0fad4d1c0eb5f71e3fe5cb', 9031733947, NULL, '07beeb7895cca3d9e3dbbceec7dd4cff', '2014-06-30 18:19:37', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE IF NOT EXISTS `driver` (
  `driver_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `msisdn` bigint(20) NOT NULL,
  `driver_name` varchar(32) NOT NULL,
  `driver_mobile` bigint(10) NOT NULL,
  PRIMARY KEY (`driver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `msisdn`, `driver_name`, `driver_mobile`) VALUES
(1, 917738257915, 'ABC', 999999999),
(2, 917738257068, 'DEF', 8888888888);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `order_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) NOT NULL,
  `start_location` varchar(32) NOT NULL,
  `end_destination` varchar(32) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Time & Date when Order was placed/booked',
  `pickup_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `drop_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `driver_id` bigint(20) NOT NULL,
  `total_distance` int(6) DEFAULT NULL,
  `total_fare` int(6) DEFAULT NULL,
  `order_status` enum('1','2','3','') NOT NULL COMMENT '1 : Current , 2: Upcoming, 3:Completed',
  `rating` enum('1','2','3','4','5') DEFAULT NULL COMMENT '5:Excellent && 1 : Poor',
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  KEY `driver_id` (`driver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Order_Details Table stores details of each order placed' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_location`
--

CREATE TABLE IF NOT EXISTS `vehicle_location` (
  `location_log_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `msisdn` bigint(20) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `poi` varchar(8) NOT NULL,
  `road` varchar(64) NOT NULL,
  `sublocality` varchar(64) NOT NULL,
  `locality` varchar(64) NOT NULL,
  `city_town` varchar(64) NOT NULL,
  `district` varchar(64) NOT NULL,
  `state` varchar(64) NOT NULL,
  `date_time_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Save the TimeStamp when My Database is updated with information from Airtel',
  PRIMARY KEY (`location_log_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Stores the Vehicle Location Log' AUTO_INCREMENT=51 ;

--
-- Dumping data for table `vehicle_location`
--

INSERT INTO `vehicle_location` (`location_log_no`, `msisdn`, `date_time`, `latitude`, `longitude`, `poi`, `road`, `sublocality`, `locality`, `city_town`, `district`, `state`, `date_time_log`) VALUES
(1, 917738257915, '2014-07-01 10:56:45', 19.119623, 72.9016, ' 10 m fr', 'Jogeshwari Vikhroli Link Road (Powai Road)', 'Scout and Guide Camp', 'Powai', 'Mumbai', 'Mumbai (Suburban) District', 'Maharashtra', '2014-07-01 10:57:11'),
(2, 917738257068, '2014-07-01 10:56:11', 19.123217, 72.85154, ' 14 m fr', 'Parsi Panchayat Road', 'Hari Sevak Chowk', 'Andheri East', 'Mumbai', 'Mumbai (Suburban) District', 'Maharashtra', '2014-07-01 10:57:14'),
(3, 917738257915, '2014-07-01 10:56:45', 19.119623, 72.9016, ' 10 m fr', 'Jogeshwari Vikhroli Link Road (Powai Road)', 'Scout and Guide Camp', 'Powai', 'Mumbai', 'Mumbai (Suburban) District', 'Maharashtra', '2014-07-01 11:07:17'),
(4, 917738257068, '2014-07-01 10:56:11', 19.123217, 72.85154, ' 14 m fr', 'Parsi Panchayat Road', 'Hari Sevak Chowk', 'Andheri East', 'Mumbai', 'Mumbai (Suburban) District', 'Maharashtra', '2014-07-01 11:07:20'),
(5, 917738257915, '2014-07-01 11:11:45', 19.154373, 72.95405, ' 296 m f', 'Goregaon Mulund Link Road (GM Link Road)', 'LIC Housing Colony', 'Bhandup East', 'Mumbai', 'Mumbai (Suburban) District', 'Maharashtra', '2014-07-01 11:17:23'),
(6, 917738257068, '2014-07-01 11:11:45', 19.15314, 72.95257, ' 382 m f', '', 'LIC Housing Colony', 'Bhandup East', 'Mumbai', 'Mumbai (Suburban) District', 'Maharashtra', '2014-07-01 11:17:26'),
(7, 917738257915, '2014-07-01 11:26:45', 19.211782, 72.98587, ' 125 m f', '', 'Majiwada', 'Yashaswi Nagar', 'Thane', 'Thane District', 'Maharashtra', '2014-07-01 11:27:29'),
(8, 917738257068, '2014-07-01 11:26:48', 19.213392, 72.98913, ' 417 m f', '', 'Pada Colony', 'Yashaswi Nagar', 'Thane', 'Thane District', 'Maharashtra', '2014-07-01 11:27:32'),
(9, 917738257915, '2014-07-01 11:26:45', 19.211782, 72.98587, ' 125 m f', '', 'Majiwada', 'Yashaswi Nagar', 'Thane', 'Thane District', 'Maharashtra', '2014-07-01 11:37:35'),
(10, 917738257068, '2014-07-01 11:26:48', 19.213392, 72.98913, ' 417 m f', '', 'Pada Colony', 'Yashaswi Nagar', 'Thane', 'Thane District', 'Maharashtra', '2014-07-01 11:37:38'),
(11, 917738257915, '2014-07-01 11:41:45', 19.257166, 73.076355, ' 840 m f', '', '', 'Pimpalas', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 11:47:41'),
(12, 917738257068, '2014-07-01 11:41:45', 19.259012, 73.07962, ' 1 Km fr', '', '', 'Pimpalas', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 11:47:44'),
(13, 917738257915, '2014-07-01 11:56:46', 19.274837, 73.09022, ' 186 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 11:57:47'),
(14, 917738257068, '2014-07-01 11:56:45', 19.274923, 73.08996, ' 208 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 11:57:50'),
(15, 917738257915, '2014-07-01 11:56:46', 19.274837, 73.09022, ' 186 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 12:07:53'),
(16, 917738257068, '2014-07-01 11:56:45', 19.274923, 73.08996, ' 208 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 12:07:56'),
(17, 917738257915, '2014-07-01 12:11:46', 19.27358, 73.09106, ' 241 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 12:18:00'),
(18, 917738257068, '2014-07-01 12:11:46', 19.275288, 73.09056, ' 131 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 12:18:02'),
(19, 917738257915, '2014-07-01 12:26:46', 19.273539, 73.09112, ' 244 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 12:28:05'),
(20, 917738257068, '2014-07-01 12:26:47', 19.273838, 73.09133, ' 206 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 12:28:08'),
(21, 917738257915, '2014-07-01 12:26:46', 19.273539, 73.09112, ' 244 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 12:38:11'),
(22, 917738257068, '2014-07-01 12:26:47', 19.273838, 73.09133, ' 206 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 12:38:14'),
(23, 917738257915, '2014-07-01 12:41:47', 19.276424, 73.09022, ' 184 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 12:48:17'),
(24, 917738257068, '2014-07-01 12:41:47', 19.2749, 73.09004, ' 201 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 12:48:20'),
(25, 917738257915, '2014-07-01 12:56:45', 19.275726, 73.09062, ' 118 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 12:58:23'),
(26, 917738257068, '2014-07-01 12:56:46', 19.276274, 73.090385, ' 160 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 12:58:26'),
(27, 917738257915, '2014-07-01 12:56:45', 19.275726, 73.09062, ' 118 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 13:08:29'),
(28, 917738257068, '2014-07-01 12:56:46', 19.276274, 73.090385, ' 160 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 13:08:32'),
(29, 917738257915, '2014-07-01 13:11:46', 19.276167, 73.08747, ' 261 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 13:18:35'),
(30, 917738257068, '2014-07-01 13:11:46', 19.277487, 73.08406, ' 528 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 13:18:38'),
(31, 917738257915, '2014-07-01 13:26:46', 19.296757, 73.05528, ' 35 m fr', '', '', 'Vaidya Wada', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 13:28:41'),
(32, 917738257068, '2014-07-01 13:26:46', 19.274643, 73.087555, ' 101 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 13:28:44'),
(33, 917738257915, '2014-07-01 13:26:46', 19.296757, 73.05528, ' 35 m fr', '', '', 'Vaidya Wada', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 13:38:47'),
(34, 917738257068, '2014-07-01 13:26:46', 19.274643, 73.087555, ' 101 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 13:38:50'),
(35, 917738257915, '2014-07-01 13:41:48', 19.283903, 73.04567, ' 164 m f', '', '', 'Vitthal Nagar', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 13:48:53'),
(36, 917738257068, '2014-07-01 13:41:46', 19.275738, 73.08412, ' 394 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 13:48:56'),
(37, 917738257915, '2014-07-01 13:56:46', 19.273989, 73.09035, ' 237 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 13:58:59'),
(38, 917738257068, '2014-07-01 13:56:51', 19.273829, 73.091354, ' 207 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 13:59:02'),
(39, 917738257915, '2014-07-01 13:56:46', 19.273989, 73.09035, ' 237 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 14:09:05'),
(40, 917738257068, '2014-07-01 13:56:51', 19.273829, 73.091354, ' 207 m f', '', '', 'Thakurpada Saravali', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 14:09:08'),
(41, 917738257915, '2014-07-01 14:11:47', 19.241385, 73.04297, ' 102 m f', 'Eastern Expressway (Agra Road) NH 3', '', 'Mankoli Village', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 14:19:11'),
(42, 917738257068, '2014-07-01 14:11:47', 19.241083, 73.04297, ' 115 m f', 'Eastern Expressway (Agra Road) NH 3', '', 'Mankoli Village', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 14:19:14'),
(43, 917738257915, '2014-07-01 14:26:47', 19.241245, 73.03758, ' 113 m f', '', '', 'Dapoda Village', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 14:29:17'),
(44, 917738257068, '2014-07-01 14:26:46', 19.241568, 73.03769, ' 110 m f', '', '', 'Dapoda Village', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 14:29:20'),
(45, 917738257915, '2014-07-01 14:26:47', 19.241245, 73.03758, ' 113 m f', '', '', 'Dapoda Village', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 14:39:23'),
(46, 917738257068, '2014-07-01 14:26:46', 19.241568, 73.03769, ' 110 m f', '', '', 'Dapoda Village', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 14:39:28'),
(47, 917738257915, '2014-07-01 14:41:47', 19.240622, 73.03968, ' 117 m f', '', '', 'Mankoli Village', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 14:49:30'),
(48, 917738257068, '2014-07-01 14:41:46', 19.241278, 73.03758, ' 113 m f', '', '', 'Dapoda Village', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 14:49:31'),
(49, 917738257915, '2014-07-01 14:56:47', 19.24177, 73.03992, ' 39 m fr', '', '', 'Mankoli Village', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 14:59:33'),
(50, 917738257068, '2014-07-01 14:56:46', 19.241405, 73.03763, ' 110 m f', '', '', 'Dapoda Village', 'Bhiwandi', 'Thane District', 'Maharashtra', '2014-07-01 14:59:35');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
