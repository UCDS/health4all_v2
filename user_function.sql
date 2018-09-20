-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 16, 2018 at 07:46 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `health4all`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_function`
--

DROP TABLE IF EXISTS `user_function`;
CREATE TABLE IF NOT EXISTS `user_function` (
  `user_function_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_function` varchar(50) NOT NULL,
  `user_function_display` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`user_function_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_function`
--

INSERT INTO `user_function` (`user_function_id`, `user_function`, `user_function_display`, `description`) VALUES
(1, 'All', '', ''),
(13, 'Masters - Diagnostics', '', ''),
(12, 'Masters - Staff', '', ''),
(11, 'Masters - Equipment', '', ''),
(10, 'Masters - Application', '', ''),
(9, 'Create Forms', '', ''),
(8, 'Bloodbank', '', ''),
(7, 'Consumables', '', ''),
(6, 'Equipment', '', ''),
(5, 'HR', '', ''),
(4, 'Diagnostics', '', ''),
(3, 'In Patient Registration', '', ''),
(2, 'Out Patient Registration', '', ''),
(14, 'Masters - Consumables', '', ''),
(15, 'Masters - Bloodbank', '', ''),
(16, 'IP Summary', '', ''),
(17, 'OP Summary', '', ''),
(18, 'OP Detail', '', ''),
(19, 'IP Detail', '', ''),
(20, 'Diagnostics - Approve', '', ''),
(21, 'Diagnostics - Order', '', ''),
(22, 'Diagnostics - Summary', '', ''),
(23, 'Diagnostics - Detail', '', ''),
(24, 'View Patients', '', ''),
(25, 'Update Patients', '', 'Overall'),
(26, 'Update Patients', '', 'Demographic'),
(27, 'Clinical', '', ''),
(28, 'View Diagnostics', '', ''),
(29, 'Procedures', '', ''),
(30, 'Prescription', '', ''),
(31, 'Discharge', '', ''),
(32, 'Outcome Summary', '', ''),
(33, 'Audiology Reports', '', 'For summary and detailed audiology reports'),
(35, 'Vendor', '', ''),
(36, 'Diagnostics - Order All', '', 'Diagnostics all departments'),
(37, 'Clinical', '', ''),
(38, 'View Diagnostics', '', ''),
(39, 'Procedures', '', ''),
(40, 'Prescription', '', ''),
(41, 'Discharge', '', ''),
(42, 'mlc', '', ''),
(43, 'patient_visit', '', ''),
(44, 'obg', '', ''),
(45, 'Admin', '', 'Add Hospitals, Departments, Units, Areas and other application level data\r\n'),
(46, 'Helpline Update', '', ''),
(47, 'Helpline Reports', '', ''),
(48, 'Patient Transport', '', ''),
(49, 'PACS', '', ''),
(50, 'Patient Transport Report', '', ''),
(51, 'Sanitation Evaluation', '', ''),
(52, 'Masters - Sanitation', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
