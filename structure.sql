-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2016 at 10:24 PM
-- Server version: 5.6.22-71.0
-- PHP Version: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtransserv_docs`
--

-- --------------------------------------------------------

--
-- Table structure for table `mts_employee`
--

CREATE TABLE IF NOT EXISTS `mts_employee` (
  `id` int(11) unsigned NOT NULL,
  `employee_group_id` int(10) unsigned NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(8) NOT NULL DEFAULT 'employee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_employee_group`
--

CREATE TABLE IF NOT EXISTS `mts_employee_group` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(32) NOT NULL,
  `manage` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_employee_group_archive_request_type`
--

CREATE TABLE IF NOT EXISTS `mts_employee_group_archive_request_type` (
  `id` int(10) unsigned NOT NULL,
  `employee_group_id` int(10) unsigned NOT NULL,
  `service` tinyint(1) NOT NULL DEFAULT '0',
  `tires` tinyint(1) NOT NULL DEFAULT '0',
  `wash` tinyint(1) NOT NULL DEFAULT '0',
  `company` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_employee_group_request_type`
--

CREATE TABLE IF NOT EXISTS `mts_employee_group_request_type` (
  `id` int(10) unsigned NOT NULL,
  `employee_group_id` int(10) unsigned NOT NULL,
  `service` tinyint(1) NOT NULL DEFAULT '0',
  `tires` tinyint(1) NOT NULL DEFAULT '0',
  `wash` tinyint(1) NOT NULL DEFAULT '0',
  `company` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request`
--

CREATE TABLE IF NOT EXISTS `mts_request` (
  `id` int(10) unsigned NOT NULL,
  `new` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(128) DEFAULT NULL,
  `address_timezone` varchar(32) DEFAULT NULL,
  `address_index` varchar(32) DEFAULT NULL,
  `address_city` varchar(32) DEFAULT NULL,
  `address_street` varchar(128) DEFAULT NULL,
  `address_house` varchar(16) DEFAULT NULL,
  `address_phone` varchar(16) DEFAULT NULL,
  `address_mail` varchar(1024) DEFAULT NULL,
  `time_from` varchar(32) DEFAULT NULL,
  `time_to` varchar(32) DEFAULT NULL,
  `director_name` varchar(256) DEFAULT NULL,
  `director_email` varchar(32) DEFAULT NULL,
  `director_phone` varchar(16) DEFAULT NULL,
  `doc_name` varchar(256) DEFAULT NULL,
  `doc_email` varchar(32) DEFAULT NULL,
  `doc_phone` varchar(16) DEFAULT NULL,
  `next_communication_date` date DEFAULT NULL,
  `payment_day` varchar(64) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `agreement_number` varchar(16) DEFAULT NULL,
  `agreement_date` date DEFAULT NULL,
  `agreement_file` varchar(256) DEFAULT NULL,
  `status` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_comments`
--

CREATE TABLE IF NOT EXISTS `mts_request_comments` (
  `id` int(10) unsigned NOT NULL,
  `request_id` int(10) unsigned NOT NULL,
  `employee_id` int(10) unsigned NOT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_company`
--

CREATE TABLE IF NOT EXISTS `mts_request_company` (
  `request_ptr_id` int(10) unsigned NOT NULL,
  `contact_name` varchar(256) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `city` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_company_autopark`
--

CREATE TABLE IF NOT EXISTS `mts_request_company_autopark` (
  `id` int(10) unsigned NOT NULL,
  `request_ptr_id` int(10) unsigned NOT NULL,
  `model` varchar(64) DEFAULT NULL,
  `type` varchar(128) DEFAULT NULL,
  `amount` smallint(5) unsigned DEFAULT NULL,
  `price_outside` varchar(64) DEFAULT NULL,
  `price_inside` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_company_driver`
--

CREATE TABLE IF NOT EXISTS `mts_request_company_driver` (
  `id` int(10) unsigned NOT NULL,
  `request_ptr_id` int(10) unsigned NOT NULL,
  `model` varchar(64) DEFAULT NULL,
  `type` varchar(128) DEFAULT NULL,
  `fio` varchar(256) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_company_list_auto`
--

CREATE TABLE IF NOT EXISTS `mts_request_company_list_auto` (
  `id` int(10) unsigned NOT NULL,
  `request_ptr_id` int(10) unsigned NOT NULL,
  `model` varchar(64) DEFAULT NULL,
  `type` varchar(128) DEFAULT NULL,
  `state_number` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_done`
--

CREATE TABLE IF NOT EXISTS `mts_request_done` (
  `id` int(10) unsigned NOT NULL,
  `request_id` int(10) unsigned NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_employee`
--

CREATE TABLE IF NOT EXISTS `mts_request_employee` (
  `id` int(10) unsigned NOT NULL,
  `request_id` int(10) unsigned NOT NULL,
  `position` varchar(32) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_process`
--

CREATE TABLE IF NOT EXISTS `mts_request_process` (
  `id` int(10) unsigned NOT NULL,
  `request_id` int(10) unsigned NOT NULL,
  `employee_group_id` int(10) unsigned NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_process_employee`
--

CREATE TABLE IF NOT EXISTS `mts_request_process_employee` (
  `id` int(10) unsigned NOT NULL,
  `employee_id` int(10) unsigned NOT NULL,
  `request_process_id` int(10) unsigned NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `finished` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_service`
--

CREATE TABLE IF NOT EXISTS `mts_request_service` (
  `request_ptr_id` int(10) unsigned NOT NULL,
  `official_dealer` text,
  `nonofficial_dealer` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_service_serve_organisation`
--

CREATE TABLE IF NOT EXISTS `mts_request_service_serve_organisation` (
  `id` int(11) NOT NULL,
  `request_ptr_id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_service_work_rate`
--

CREATE TABLE IF NOT EXISTS `mts_request_service_work_rate` (
  `id` int(11) NOT NULL,
  `request_ptr_id` int(11) NOT NULL,
  `work_name` varchar(256) DEFAULT NULL,
  `rate` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_tires`
--

CREATE TABLE IF NOT EXISTS `mts_request_tires` (
  `request_ptr_id` int(10) unsigned NOT NULL,
  `service_mounting` tinyint(1) DEFAULT '0',
  `service_tires_sale` tinyint(1) DEFAULT '0',
  `service_disk_sale` tinyint(1) DEFAULT '0',
  `serve_car` tinyint(1) DEFAULT '0',
  `serve_truck` tinyint(1) DEFAULT '0',
  `serve_tech` tinyint(1) DEFAULT '0',
  `sale_for_car` tinyint(1) DEFAULT '0',
  `sale_for_truck` tinyint(1) DEFAULT '0',
  `sale_for_tech` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_tires_serve_organisation`
--

CREATE TABLE IF NOT EXISTS `mts_request_tires_serve_organisation` (
  `id` int(11) NOT NULL,
  `request_ptr_id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `phone` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_wash`
--

CREATE TABLE IF NOT EXISTS `mts_request_wash` (
  `request_ptr_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_wash_serve_organisation`
--

CREATE TABLE IF NOT EXISTS `mts_request_wash_serve_organisation` (
  `id` int(11) NOT NULL,
  `request_ptr_id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mts_request_wash_service`
--

CREATE TABLE IF NOT EXISTS `mts_request_wash_service` (
  `id` int(10) unsigned NOT NULL,
  `request_ptr_id` int(10) unsigned NOT NULL,
  `type` varchar(128) DEFAULT NULL,
  `price_outside` varchar(64) DEFAULT NULL,
  `price_inside` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mts_employee`
--
ALTER TABLE `mts_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`username`),
  ADD KEY `employee_group_id` (`employee_group_id`);

--
-- Indexes for table `mts_employee_group`
--
ALTER TABLE `mts_employee_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mts_employee_group_archive_request_type`
--
ALTER TABLE `mts_employee_group_archive_request_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_group_id` (`employee_group_id`);

--
-- Indexes for table `mts_employee_group_request_type`
--
ALTER TABLE `mts_employee_group_request_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_group_id` (`employee_group_id`);

--
-- Indexes for table `mts_request`
--
ALTER TABLE `mts_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mts_request_comments`
--
ALTER TABLE `mts_request_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mts_request_company_autopark`
--
ALTER TABLE `mts_request_company_autopark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mts_request_company_driver`
--
ALTER TABLE `mts_request_company_driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mts_request_company_list_auto`
--
ALTER TABLE `mts_request_company_list_auto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mts_request_done`
--
ALTER TABLE `mts_request_done`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mts_request_employee`
--
ALTER TABLE `mts_request_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empluee_group_id` (`name`(255));

--
-- Indexes for table `mts_request_process`
--
ALTER TABLE `mts_request_process`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empluee_group_id` (`employee_group_id`);

--
-- Indexes for table `mts_request_process_employee`
--
ALTER TABLE `mts_request_process_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `request_process_id` (`request_process_id`);

--
-- Indexes for table `mts_request_service`
--
ALTER TABLE `mts_request_service`
  ADD KEY `request_ptr_id` (`request_ptr_id`);

--
-- Indexes for table `mts_request_service_serve_organisation`
--
ALTER TABLE `mts_request_service_serve_organisation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_ptr_id` (`request_ptr_id`);

--
-- Indexes for table `mts_request_service_work_rate`
--
ALTER TABLE `mts_request_service_work_rate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_ptr_id` (`request_ptr_id`);

--
-- Indexes for table `mts_request_tires`
--
ALTER TABLE `mts_request_tires`
  ADD KEY `request_ptr_id` (`request_ptr_id`);

--
-- Indexes for table `mts_request_tires_serve_organisation`
--
ALTER TABLE `mts_request_tires_serve_organisation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_ptr_id` (`request_ptr_id`);

--
-- Indexes for table `mts_request_wash`
--
ALTER TABLE `mts_request_wash`
  ADD KEY `request_ptr_id` (`request_ptr_id`);

--
-- Indexes for table `mts_request_wash_serve_organisation`
--
ALTER TABLE `mts_request_wash_serve_organisation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_ptr_id` (`request_ptr_id`);

--
-- Indexes for table `mts_request_wash_service`
--
ALTER TABLE `mts_request_wash_service`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mts_employee`
--
ALTER TABLE `mts_employee`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_employee_group`
--
ALTER TABLE `mts_employee_group`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_employee_group_archive_request_type`
--
ALTER TABLE `mts_employee_group_archive_request_type`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_employee_group_request_type`
--
ALTER TABLE `mts_employee_group_request_type`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_request`
--
ALTER TABLE `mts_request`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_request_comments`
--
ALTER TABLE `mts_request_comments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_request_company_autopark`
--
ALTER TABLE `mts_request_company_autopark`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_request_company_driver`
--
ALTER TABLE `mts_request_company_driver`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_request_company_list_auto`
--
ALTER TABLE `mts_request_company_list_auto`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_request_done`
--
ALTER TABLE `mts_request_done`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_request_employee`
--
ALTER TABLE `mts_request_employee`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_request_process`
--
ALTER TABLE `mts_request_process`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_request_process_employee`
--
ALTER TABLE `mts_request_process_employee`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_request_service_serve_organisation`
--
ALTER TABLE `mts_request_service_serve_organisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_request_service_work_rate`
--
ALTER TABLE `mts_request_service_work_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_request_tires_serve_organisation`
--
ALTER TABLE `mts_request_tires_serve_organisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_request_wash_serve_organisation`
--
ALTER TABLE `mts_request_wash_serve_organisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mts_request_wash_service`
--
ALTER TABLE `mts_request_wash_service`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `mts_request_service`
--
ALTER TABLE `mts_request_service`
  ADD CONSTRAINT `request_ptr_id__service` FOREIGN KEY (`request_ptr_id`) REFERENCES `mts_request` (`id`);

--
-- Constraints for table `mts_request_tires`
--
ALTER TABLE `mts_request_tires`
  ADD CONSTRAINT `request_ptr_id__tires` FOREIGN KEY (`request_ptr_id`) REFERENCES `mts_request` (`id`);

--
-- Constraints for table `mts_request_wash`
--
ALTER TABLE `mts_request_wash`
  ADD CONSTRAINT `request_ptr_id` FOREIGN KEY (`request_ptr_id`) REFERENCES `mts_request` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
