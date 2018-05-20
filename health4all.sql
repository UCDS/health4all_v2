-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
-- 
-- Host: 127.0.0.1:3306
-- Generation Time: May 15, 2018 at 11:26 AM
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
CREATE DATABASE IF NOT EXISTS `health4all` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `health4all`;

-- --------------------------------------------------------

--
-- Table structure for table `activity_done`
--

DROP TABLE IF EXISTS `activity_done`;
CREATE TABLE IF NOT EXISTS `activity_done` (
  `activity_done_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `score` decimal(3,1) NOT NULL,
  `comments` tinytext NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `user_id` int(5) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`activity_done_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `affiliation`
--

DROP TABLE IF EXISTS `affiliation`;
CREATE TABLE IF NOT EXISTS `affiliation` (
  `affiliation_id` int(6) NOT NULL AUTO_INCREMENT,
  `staff_id` int(6) NOT NULL,
  `affiliated_institution` varchar(100) NOT NULL,
  PRIMARY KEY (`affiliation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `age_group`
--

DROP TABLE IF EXISTS `age_group`;
CREATE TABLE IF NOT EXISTS `age_group` (
  `age_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_year` int(11) NOT NULL,
  `to_year` int(11) NOT NULL,
  `from_month` int(11) NOT NULL,
  `to_month` int(11) NOT NULL,
  `from_day` int(11) NOT NULL,
  `to_day` int(11) NOT NULL,
  PRIMARY KEY (`age_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `antenatal_visit`
--

DROP TABLE IF EXISTS `antenatal_visit`;
CREATE TABLE IF NOT EXISTS `antenatal_visit` (
  `antenatal_visit_id` int(7) NOT NULL AUTO_INCREMENT,
  `visit_id` int(7) NOT NULL,
  `fundal_height` varchar(50) NOT NULL,
  `presentation` varchar(50) NOT NULL,
  `fetal_heart_rate` varchar(50) NOT NULL,
  `liquor` varchar(50) NOT NULL,
  `scan_finding` varchar(500) NOT NULL,
  `advice` varchar(500) NOT NULL,
  PRIMARY KEY (`antenatal_visit_id`),
  KEY `visit_id` (`visit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `antibiotic`
--

DROP TABLE IF EXISTS `antibiotic`;
CREATE TABLE IF NOT EXISTS `antibiotic` (
  `antibiotic_id` int(6) NOT NULL AUTO_INCREMENT,
  `antibiotic` varchar(50) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `temp_antibiotic_id` int(11) NOT NULL,
  PRIMARY KEY (`antibiotic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=410 DEFAULT CHARSET=latin1 COMMENT='List of antibiotics';

-- --------------------------------------------------------

--
-- Table structure for table `antibiotic_test`
--

DROP TABLE IF EXISTS `antibiotic_test`;
CREATE TABLE IF NOT EXISTS `antibiotic_test` (
  `antibiotic_test_id` int(6) NOT NULL AUTO_INCREMENT,
  `antibiotic_id` int(6) NOT NULL,
  `micro_organism_test_id` int(6) NOT NULL,
  `antibiotic_result` tinyint(1) NOT NULL COMMENT '0 - Negative, 1 - Positive',
  `temp_antibiotic_test_id` int(11) NOT NULL,
  PRIMARY KEY (`antibiotic_test_id`),
  KEY `antibiotic_id` (`antibiotic_id`),
  KEY `micro_organism_test_id` (`micro_organism_test_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1294 DEFAULT CHARSET=latin1 COMMENT='Antibiotic tests performed on micro organisms';

-- --------------------------------------------------------

--
-- Table structure for table `api_updates`
--

DROP TABLE IF EXISTS `api_updates`;
CREATE TABLE IF NOT EXISTS `api_updates` (
  `api_id` int(11) NOT NULL AUTO_INCREMENT,
  `api_name` varchar(20) NOT NULL,
  `table_name` varchar(32) NOT NULL,
  `key_name` varchar(32) NOT NULL,
  `last_updated_id` int(11) NOT NULL,
  PRIMARY KEY (`api_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
CREATE TABLE IF NOT EXISTS `area` (
  `area_id` int(4) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(20) NOT NULL,
  `department_id` int(4) NOT NULL,
  `beds` int(4) NOT NULL,
  `area_type_id` int(6) DEFAULT NULL,
  `lab_report_staff_id` int(11) DEFAULT NULL,
  `temp_area_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`area_id`),
  KEY `area_id` (`area_id`),
  KEY `department_id` (`department_id`),
  KEY `temp_area_id` (`temp_area_id`),
  KEY `area_id_2` (`area_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1336 DEFAULT CHARSET=latin1 COMMENT='Areas in hospitals';

-- --------------------------------------------------------

--
-- Table structure for table `area_activity`
--

DROP TABLE IF EXISTS `area_activity`;
CREATE TABLE IF NOT EXISTS `area_activity` (
  `area_activity_id` int(4) NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(100) NOT NULL,
  `frequency` int(2) NOT NULL COMMENT 'frequency of the activity in a day',
  `weightage` int(3) NOT NULL COMMENT 'weighted score of the activity',
  `area_type_id` int(3) NOT NULL,
  `frequency_type` varchar(10) NOT NULL COMMENT 'daily, weekly, fortnightly, monthly',
  PRIMARY KEY (`area_activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `area_types`
--

DROP TABLE IF EXISTS `area_types`;
CREATE TABLE IF NOT EXISTS `area_types` (
  `area_type_id` int(2) NOT NULL AUTO_INCREMENT,
  `area_type` varchar(50) NOT NULL,
  PRIMARY KEY (`area_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='areas like ICU,Ward,OT';

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `roaster_id` int(11) NOT NULL,
  `time_in` timestamp NULL DEFAULT NULL,
  `time_out` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`attendance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `audiology`
--

DROP TABLE IF EXISTS `audiology`;
CREATE TABLE IF NOT EXISTS `audiology` (
  `aud_test_id` int(7) NOT NULL AUTO_INCREMENT,
  `date_of_test` date NOT NULL,
  `type_of_test` varchar(20) NOT NULL,
  `ip_no` int(7) NOT NULL,
  `test_no` int(7) NOT NULL,
  `oael_outcome` varchar(20) NOT NULL,
  `oaer_outcome` varchar(20) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `staff_id` int(5) NOT NULL,
  PRIMARY KEY (`aud_test_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bb_appointment`
--

DROP TABLE IF EXISTS `bb_appointment`;
CREATE TABLE IF NOT EXISTS `bb_appointment` (
  `appointment_id` int(7) NOT NULL AUTO_INCREMENT,
  `donor_id` int(7) NOT NULL,
  `slot_id` int(7) NOT NULL,
  `datetime` datetime NOT NULL,
  `status` varchar(50) COLLATE utf8_bin NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`appointment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_app_slot_link`
--

DROP TABLE IF EXISTS `bb_app_slot_link`;
CREATE TABLE IF NOT EXISTS `bb_app_slot_link` (
  `link_id` int(7) NOT NULL AUTO_INCREMENT,
  `appointment_id` int(7) NOT NULL,
  `slot_id` int(7) NOT NULL,
  `datetime` datetime NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_donation`
--

DROP TABLE IF EXISTS `bb_donation`;
CREATE TABLE IF NOT EXISTS `bb_donation` (
  `donation_id` int(7) NOT NULL AUTO_INCREMENT,
  `donor_id` int(7) NOT NULL,
  `replacement_patient_id` int(7) NOT NULL,
  `weight` varchar(10) COLLATE utf8_bin NOT NULL,
  `pulse` int(4) NOT NULL,
  `hb` varchar(10) COLLATE utf8_bin NOT NULL,
  `sbp` varchar(10) COLLATE utf8_bin NOT NULL,
  `dbp` varchar(10) COLLATE utf8_bin NOT NULL,
  `temperature` varchar(10) COLLATE utf8_bin NOT NULL,
  `blood_unit_num` varchar(10) COLLATE utf8_bin NOT NULL,
  `segment_num` varchar(20) COLLATE utf8_bin NOT NULL,
  `bag_type` varchar(20) COLLATE utf8_bin NOT NULL,
  `collected_by` int(5) NOT NULL,
  `donation_date` date NOT NULL,
  `status` varchar(100) COLLATE utf8_bin NOT NULL,
  `status_id` int(11) NOT NULL,
  `camp_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `screening_result` tinyint(1) NOT NULL,
  `donation_time` time NOT NULL,
  PRIMARY KEY (`donation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19863 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_donation_cancel`
--

DROP TABLE IF EXISTS `bb_donation_cancel`;
CREATE TABLE IF NOT EXISTS `bb_donation_cancel` (
  `donation_id` int(100) NOT NULL,
  `reason` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bb_external_patient`
--

DROP TABLE IF EXISTS `bb_external_patient`;
CREATE TABLE IF NOT EXISTS `bb_external_patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `age` varchar(10) NOT NULL,
  `diagnosis` text NOT NULL,
  `ward_unit` varchar(20) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`patient_id`),
  KEY `hospital_id` (`hospital_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bb_issued_inventory`
--

DROP TABLE IF EXISTS `bb_issued_inventory`;
CREATE TABLE IF NOT EXISTS `bb_issued_inventory` (
  `issued_inventory_id` int(7) NOT NULL AUTO_INCREMENT,
  `issue_id` int(7) NOT NULL,
  `inventory_id` int(7) NOT NULL,
  PRIMARY KEY (`issued_inventory_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19629 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_replacement_patient`
--

DROP TABLE IF EXISTS `bb_replacement_patient`;
CREATE TABLE IF NOT EXISTS `bb_replacement_patient` (
  `replacement_patient_id` int(7) NOT NULL AUTO_INCREMENT,
  `ip_number` int(7) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `ward_unit` varchar(100) COLLATE utf8_bin NOT NULL,
  `blood_group` varchar(5) COLLATE utf8_bin NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`replacement_patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_slot`
--

DROP TABLE IF EXISTS `bb_slot`;
CREATE TABLE IF NOT EXISTS `bb_slot` (
  `slot_id` int(7) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `no_appointments` int(3) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`slot_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bb_status`
--

DROP TABLE IF EXISTS `bb_status`;
CREATE TABLE IF NOT EXISTS `bb_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bb_user`
--

DROP TABLE IF EXISTS `bb_user`;
CREATE TABLE IF NOT EXISTS `bb_user` (
  `user_id` int(7) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8_bin NOT NULL,
  `password` varchar(128) COLLATE utf8_bin NOT NULL,
  `registration_date` datetime NOT NULL,
  `registrar` tinyint(1) NOT NULL,
  `examiner` tinyint(1) NOT NULL,
  `technician` tinyint(1) NOT NULL,
  `screener` tinyint(1) NOT NULL,
  `issuer` tinyint(1) NOT NULL,
  `requester` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `displayname` varchar(200) COLLATE utf8_bin NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `bloodbank_edit_log`
--

DROP TABLE IF EXISTS `bloodbank_edit_log`;
CREATE TABLE IF NOT EXISTS `bloodbank_edit_log` (
  `bb_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `trail` varchar(250) NOT NULL,
  `staff_id` int(4) NOT NULL,
  PRIMARY KEY (`bb_log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3821 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blood_donation_camp`
--

DROP TABLE IF EXISTS `blood_donation_camp`;
CREATE TABLE IF NOT EXISTS `blood_donation_camp` (
  `camp_id` int(11) NOT NULL AUTO_INCREMENT,
  `camp_name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`camp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=342 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blood_donation_camp_date`
--

DROP TABLE IF EXISTS `blood_donation_camp_date`;
CREATE TABLE IF NOT EXISTS `blood_donation_camp_date` (
  `camp_id` int(11) NOT NULL AUTO_INCREMENT,
  `camp_date` date NOT NULL,
  PRIMARY KEY (`camp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blood_donor`
--

DROP TABLE IF EXISTS `blood_donor`;
CREATE TABLE IF NOT EXISTS `blood_donor` (
  `donor_id` int(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `parent_spouse` varchar(200) COLLATE utf8_bin NOT NULL,
  `maritial_status` varchar(20) COLLATE utf8_bin NOT NULL,
  `occupation` varchar(100) COLLATE utf8_bin NOT NULL,
  `dob` varchar(20) COLLATE utf8_bin NOT NULL,
  `age` int(3) NOT NULL,
  `sex` char(1) COLLATE utf8_bin NOT NULL,
  `blood_group` varchar(10) COLLATE utf8_bin NOT NULL,
  `sub_group` varchar(10) COLLATE utf8_bin NOT NULL,
  `phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(200) COLLATE utf8_bin NOT NULL,
  `address` mediumtext COLLATE utf8_bin NOT NULL,
  `alerts` tinyint(1) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`donor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19863 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `blood_grouping`
--

DROP TABLE IF EXISTS `blood_grouping`;
CREATE TABLE IF NOT EXISTS `blood_grouping` (
  `grouping_id` int(11) NOT NULL AUTO_INCREMENT,
  `donation_id` int(11) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `sub_group` varchar(5) NOT NULL,
  `anti_a` varchar(5) NOT NULL,
  `anti_b` varchar(5) NOT NULL,
  `anti_ab` varchar(5) NOT NULL,
  `anti_d` varchar(5) NOT NULL,
  `a_cells` varchar(5) NOT NULL,
  `b_cells` varchar(5) NOT NULL,
  `o_cells` varchar(5) NOT NULL,
  `du` varchar(5) NOT NULL,
  `forward_done_by` int(11) NOT NULL,
  `reverse_done_by` int(11) NOT NULL,
  `grouping_date` date NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`grouping_id`),
  UNIQUE KEY `donation_id` (`donation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19043 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blood_inventory`
--

DROP TABLE IF EXISTS `blood_inventory`;
CREATE TABLE IF NOT EXISTS `blood_inventory` (
  `inventory_id` int(7) NOT NULL AUTO_INCREMENT,
  `component_type` varchar(20) COLLATE utf8_bin NOT NULL,
  `inv_status` varchar(20) COLLATE utf8_bin NOT NULL COMMENT 'Unscreened,Screened,Expired,Dispatched,Issued',
  `status_id` int(11) NOT NULL,
  `donation_id` int(7) NOT NULL,
  `volume` int(4) NOT NULL,
  `created_by` int(7) NOT NULL COMMENT 'user_id',
  `expiry_date` date NOT NULL,
  `notes` text COLLATE utf8_bin NOT NULL,
  `datetime` datetime NOT NULL,
  `component_perparation_time` time NOT NULL,
  `discarded_by` int(3) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`inventory_id`),
  KEY `donor_id` (`donation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=56648 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `blood_issue`
--

DROP TABLE IF EXISTS `blood_issue`;
CREATE TABLE IF NOT EXISTS `blood_issue` (
  `issue_id` int(7) NOT NULL AUTO_INCREMENT,
  `issue_date` datetime NOT NULL,
  `issue_time` time NOT NULL,
  `request_id` int(7) NOT NULL,
  `issued_by` int(7) NOT NULL COMMENT 'user id',
  `cross_matched_by` int(5) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`issue_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7373 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `blood_request`
--

DROP TABLE IF EXISTS `blood_request`;
CREATE TABLE IF NOT EXISTS `blood_request` (
  `request_id` int(7) NOT NULL AUTO_INCREMENT,
  `bloodbank_id` int(11) NOT NULL,
  `request_type` tinyint(1) NOT NULL COMMENT '0 - Patients, 1 - Bulk',
  `staff_id` int(7) NOT NULL,
  `patient_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `patient_age` varchar(10) COLLATE utf8_bin NOT NULL,
  `patient_gender` varchar(10) COLLATE utf8_bin NOT NULL,
  `patient_id` int(7) NOT NULL,
  `request_hospital_id` int(11) NOT NULL,
  `ward_unit` varchar(200) COLLATE utf8_bin NOT NULL,
  `referred_by_doctor` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'Prescribing doctors name',
  `department` varchar(200) COLLATE utf8_bin NOT NULL,
  `blood_group` varchar(5) COLLATE utf8_bin NOT NULL,
  `diagnosis` longtext COLLATE utf8_bin NOT NULL,
  `blood_transfusion_required` tinyint(1) NOT NULL,
  `whole_blood_units` int(5) NOT NULL,
  `packed_cell_units` int(5) NOT NULL,
  `fp_units` int(5) NOT NULL,
  `ffp_units` int(5) NOT NULL,
  `prp_units` int(5) NOT NULL,
  `platelet_concentrate_units` int(5) NOT NULL,
  `cryoprecipitate_units` int(5) NOT NULL,
  `request_date` datetime NOT NULL,
  `request_status` varchar(20) COLLATE utf8_bin NOT NULL,
  `rdp_units` varchar(50) COLLATE utf8_bin NOT NULL,
  `visit_id` int(10) NOT NULL,
  `patient_type` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7594 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `blood_screening`
--

DROP TABLE IF EXISTS `blood_screening`;
CREATE TABLE IF NOT EXISTS `blood_screening` (
  `screening_id` int(7) NOT NULL AUTO_INCREMENT,
  `donation_id` int(7) NOT NULL,
  `test_hiv` tinyint(1) NOT NULL DEFAULT '0',
  `test_hbsag` tinyint(1) NOT NULL DEFAULT '0',
  `test_hcv` tinyint(1) NOT NULL DEFAULT '0',
  `test_vdrl` tinyint(1) NOT NULL DEFAULT '0',
  `test_mp` tinyint(1) NOT NULL DEFAULT '0',
  `test_irregular_ab` tinyint(1) NOT NULL DEFAULT '0',
  `screening_result` tinyint(1) NOT NULL DEFAULT '0',
  `screening_datetime` datetime NOT NULL,
  `screened_by` int(5) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`screening_id`),
  UNIQUE KEY `donation_id` (`donation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19598 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_person`
--

DROP TABLE IF EXISTS `contact_person`;
CREATE TABLE IF NOT EXISTS `contact_person` (
  `contact_person_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_person_first_name` varchar(50) NOT NULL,
  `contact_person_last_name` varchar(50) NOT NULL,
  `contact_person_email` varchar(50) NOT NULL,
  `contact_person_contact` int(50) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `designation` varchar(100) NOT NULL,
  PRIMARY KEY (`contact_person_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Vendor contact persons';

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

DROP TABLE IF EXISTS `counter`;
CREATE TABLE IF NOT EXISTS `counter` (
  `counter_id` int(7) NOT NULL AUTO_INCREMENT,
  `count` int(7) NOT NULL,
  `counter_name` varchar(10) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`counter_id`)
) ENGINE=MyISAM AUTO_INCREMENT=154 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country_codes`
--

DROP TABLE IF EXISTS `country_codes`;
CREATE TABLE IF NOT EXISTS `country_codes` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(2) NOT NULL DEFAULT '',
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `name` varchar(44) DEFAULT NULL,
  `priority` int(10) UNSIGNED ZEROFILL NOT NULL,
  PRIMARY KEY (`country_id`),
  UNIQUE KEY `country` (`country`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dashboards`
--

DROP TABLE IF EXISTS `dashboards`;
CREATE TABLE IF NOT EXISTS `dashboards` (
  `dashboard_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization` varchar(100) NOT NULL,
  `short_name` varchar(30) NOT NULL,
  `type6` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `state_alias` varchar(20) NOT NULL,
  `org_label` varchar(20) NOT NULL,
  PRIMARY KEY (`dashboard_id`),
  UNIQUE KEY `short_name` (`short_name`),
  KEY `dashboard_id` (`dashboard_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `default_setting`
--

DROP TABLE IF EXISTS `default_setting`;
CREATE TABLE IF NOT EXISTS `default_setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `table` varchar(30) NOT NULL,
  `primary_key` varchar(50) NOT NULL,
  `default_value` int(11) NOT NULL,
  `default_value_text` varchar(25) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(3) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(6) NOT NULL,
  `department` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `lab_report_staff_id` int(11) NOT NULL,
  `department_email` varchar(200) NOT NULL,
  `number_of_units` int(3) NOT NULL,
  `op_room_no` varchar(10) NOT NULL,
  `clinical` tinyint(1) NOT NULL DEFAULT '0',
  `floor` varchar(1) NOT NULL,
  `mon` tinyint(1) NOT NULL DEFAULT '0',
  `tue` tinyint(1) NOT NULL DEFAULT '0',
  `wed` tinyint(1) NOT NULL DEFAULT '0',
  `thr` tinyint(1) NOT NULL DEFAULT '0',
  `fri` tinyint(1) NOT NULL DEFAULT '0',
  `sat` tinyint(1) NOT NULL DEFAULT '0',
  `temp_department_id` int(11) NOT NULL,
  PRIMARY KEY (`department_id`),
  UNIQUE KEY `department_id_2` (`department_id`),
  KEY `temp_department_id` (`temp_department_id`),
  KEY `department_id` (`department_id`),
  KEY `hospital_id` (`hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1147 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dicom`
--

DROP TABLE IF EXISTS `dicom`;
CREATE TABLE IF NOT EXISTS `dicom` (
  `dicom_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `study_datetime` datetime NOT NULL,
  `modality` varchar(64) NOT NULL,
  `study_id` varchar(64) NOT NULL,
  `filepath` varchar(250) NOT NULL,
  PRIMARY KEY (`dicom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int(3) NOT NULL AUTO_INCREMENT,
  `district` varchar(50) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `state` varchar(50) NOT NULL,
  `state_id` int(11) NOT NULL,
  PRIMARY KEY (`district_id`),
  UNIQUE KEY `district_id` (`district_id`),
  KEY `district_id_2` (`district_id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosage`
--

DROP TABLE IF EXISTS `dosage`;
CREATE TABLE IF NOT EXISTS `dosage` (
  `dosage_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosage_unit` varchar(30) NOT NULL COMMENT 'ml, gm, etc...',
  `dosage` float NOT NULL COMMENT 'number specifiying the value.',
  PRIMARY KEY (`dosage_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drug_type`
--

DROP TABLE IF EXISTS `drug_type`;
CREATE TABLE IF NOT EXISTS `drug_type` (
  `drug_type_id` int(20) NOT NULL AUTO_INCREMENT,
  `drug_type` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`drug_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `equipment_id` int(6) NOT NULL AUTO_INCREMENT,
  `equipment_type_id` int(3) NOT NULL,
  `make` varchar(100) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `asset_number` varchar(100) DEFAULT NULL,
  `procured_by` varchar(100) DEFAULT NULL,
  `cost` int(9) DEFAULT NULL,
  `supplier` varchar(100) NOT NULL,
  `vendor_id` int(6) DEFAULT NULL,
  `supply_date` date DEFAULT NULL,
  `warranty_start_date` date NOT NULL,
  `warranty_end_date` date NOT NULL,
  `service_engineer` varchar(50) NOT NULL,
  `service_engineer_contact` varchar(30) NOT NULL,
  `service_person_id` int(6) NOT NULL COMMENT 'Contact person id',
  `hospital_id` int(3) DEFAULT NULL,
  `department_id` int(2) DEFAULT NULL,
  `area_id` int(6) NOT NULL,
  `unit_id` int(6) NOT NULL,
  `staff_id` int(4) NOT NULL,
  `equipment_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`equipment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='List of equipments in hospital';

-- --------------------------------------------------------

--
-- Table structure for table `equipment_maintenance_contract`
--

DROP TABLE IF EXISTS `equipment_maintenance_contract`;
CREATE TABLE IF NOT EXISTS `equipment_maintenance_contract` (
  `amc_cmc_id` int(6) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `equipment_id` int(6) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `rate` varchar(10) NOT NULL,
  `cost` int(11) NOT NULL,
  `vendor_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Maintenance contracts for equipments';

-- --------------------------------------------------------

--
-- Table structure for table `equipment_type`
--

DROP TABLE IF EXISTS `equipment_type`;
CREATE TABLE IF NOT EXISTS `equipment_type` (
  `equipment_type_id` int(3) NOT NULL AUTO_INCREMENT,
  `equipment_type` varchar(200) NOT NULL,
  PRIMARY KEY (`equipment_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=316 DEFAULT CHARSET=latin1 COMMENT='List of equipment types';

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

DROP TABLE IF EXISTS `facility`;
CREATE TABLE IF NOT EXISTS `facility` (
  `facility_id` int(4) NOT NULL AUTO_INCREMENT,
  `facility_name` varchar(100) NOT NULL,
  `facility_type_id` int(2) NOT NULL,
  `address` int(200) NOT NULL,
  `village_town_id` int(4) NOT NULL,
  `latitude` decimal(6,6) NOT NULL,
  `longitude` decimal(6,6) NOT NULL,
  PRIMARY KEY (`facility_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facility_activity`
--

DROP TABLE IF EXISTS `facility_activity`;
CREATE TABLE IF NOT EXISTS `facility_activity` (
  `activity_id` int(6) NOT NULL AUTO_INCREMENT,
  `facility_area_id` int(2) NOT NULL,
  `area_activity_id` int(3) NOT NULL,
  PRIMARY KEY (`activity_id`),
  UNIQUE KEY `activity_id` (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facility_area`
--

DROP TABLE IF EXISTS `facility_area`;
CREATE TABLE IF NOT EXISTS `facility_area` (
  `facility_area_id` int(4) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(10) NOT NULL COMMENT 'e.g. Unit-1, NICU, MICU',
  `facility_id` int(4) NOT NULL,
  `department_id` int(2) NOT NULL,
  `area_type_id` int(2) NOT NULL,
  PRIMARY KEY (`facility_area_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='list of area in the faclities like MICU, SICU, NICU';

-- --------------------------------------------------------

--
-- Table structure for table `facility_type`
--

DROP TABLE IF EXISTS `facility_type`;
CREATE TABLE IF NOT EXISTS `facility_type` (
  `facility_type_id` int(2) NOT NULL AUTO_INCREMENT,
  `facility_type` varchar(50) NOT NULL,
  PRIMARY KEY (`facility_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
CREATE TABLE IF NOT EXISTS `form` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(30) NOT NULL,
  `num_columns` smallint(6) NOT NULL,
  `form_type` varchar(10) NOT NULL,
  `print_layout_id` int(6) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form_layout`
--

DROP TABLE IF EXISTS `form_layout`;
CREATE TABLE IF NOT EXISTS `form_layout` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(100) NOT NULL,
  `default_value` varchar(150) NOT NULL,
  `mandatory` tinyint(1) NOT NULL,
  `form_id` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2858 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `generic_item`
--

DROP TABLE IF EXISTS `generic_item`;
CREATE TABLE IF NOT EXISTS `generic_item` (
  `generic_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `generic_name` varchar(50) NOT NULL,
  `drug_type_id` int(11) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  PRIMARY KEY (`generic_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `helpline_call`
--

DROP TABLE IF EXISTS `helpline_call`;
CREATE TABLE IF NOT EXISTS `helpline_call` (
  `call_id` int(11) NOT NULL AUTO_INCREMENT,
  `callsid` varchar(100) NOT NULL,
  `from_number` varchar(20) NOT NULL,
  `to_number` varchar(20) NOT NULL,
  `direction` varchar(20) NOT NULL,
  `dial_call_duration` time NOT NULL,
  `start_time` datetime NOT NULL,
  `current_server_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `call_type` varchar(20) NOT NULL,
  `recording_url` varchar(100) NOT NULL,
  `dial_whom_number` varchar(20) NOT NULL,
  `caller_type_id` int(11) NOT NULL,
  `call_category_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `ip_op` varchar(2) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `resolution_status_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `create_date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` tinyint(1) NOT NULL DEFAULT '0',
  `resolution_date_time` datetime NOT NULL,
  `call_group_id` int(11) NOT NULL,
  PRIMARY KEY (`call_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4597 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `helpline_caller_type`
--

DROP TABLE IF EXISTS `helpline_caller_type`;
CREATE TABLE IF NOT EXISTS `helpline_caller_type` (
  `caller_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `caller_type` varchar(30) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`caller_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `helpline_call_category`
--

DROP TABLE IF EXISTS `helpline_call_category`;
CREATE TABLE IF NOT EXISTS `helpline_call_category` (
  `call_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `call_category` varchar(50) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`call_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `helpline_call_group`
--

DROP TABLE IF EXISTS `helpline_call_group`;
CREATE TABLE IF NOT EXISTS `helpline_call_group` (
  `call_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  `group_datetime` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`call_group_id`),
  UNIQUE KEY `call_group_id` (`call_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `helpline_email`
--

DROP TABLE IF EXISTS `helpline_email`;
CREATE TABLE IF NOT EXISTS `helpline_email` (
  `helpline_email_id` int(11) NOT NULL AUTO_INCREMENT,
  `call_id` int(11) NOT NULL,
  `to_email` text NOT NULL,
  `cc_email` text NOT NULL,
  `greeting` varchar(100) NOT NULL,
  `phone_shared` tinyint(1) NOT NULL,
  `note` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `email_date_time` datetime NOT NULL,
  PRIMARY KEY (`helpline_email_id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `helpline_receiver`
--

DROP TABLE IF EXISTS `helpline_receiver`;
CREATE TABLE IF NOT EXISTS `helpline_receiver` (
  `receiver_id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `short_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`receiver_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `helpline_resolution_status`
--

DROP TABLE IF EXISTS `helpline_resolution_status`;
CREATE TABLE IF NOT EXISTS `helpline_resolution_status` (
  `resolution_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `resolution_status` varchar(20) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`resolution_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

DROP TABLE IF EXISTS `hospital`;
CREATE TABLE IF NOT EXISTS `hospital` (
  `hospital_id` int(3) NOT NULL AUTO_INCREMENT,
  `hospital_type_id` int(6) NOT NULL,
  `hospital` varchar(200) NOT NULL,
  `hospital_short_name` varchar(25) NOT NULL,
  `description` varchar(200) NOT NULL,
  `place` varchar(50) NOT NULL,
  `village_town_id` int(6) NOT NULL,
  `district` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `type1` varchar(50) NOT NULL COMMENT 'Private, Public, Non-Profit',
  `type2` varchar(50) NOT NULL COMMENT 'State Govt., Central Govt.',
  `type3` varchar(50) NOT NULL COMMENT 'Teaching, Non-Teaching',
  `type4` varchar(50) NOT NULL COMMENT 'District, Area, CHC, PHC, Sub Centre',
  `type5` varchar(50) NOT NULL COMMENT 'Urban, Rural',
  `type6` varchar(50) NOT NULL COMMENT 'DME, VVP, DH',
  PRIMARY KEY (`hospital_id`),
  KEY `hospital_id` (`hospital_id`)
) ENGINE=MyISAM AUTO_INCREMENT=289 DEFAULT CHARSET=latin1 COMMENT='List of hospitals';

-- --------------------------------------------------------

--
-- Table structure for table `hr_transaction`
--

DROP TABLE IF EXISTS `hr_transaction`;
CREATE TABLE IF NOT EXISTS `hr_transaction` (
  `staff_id` int(4) NOT NULL,
  `hr_transaction_id` int(5) NOT NULL AUTO_INCREMENT,
  `hr_transaction_type_id` int(2) NOT NULL,
  `hr_transaction_date` date NOT NULL,
  UNIQUE KEY `hr_transaction_id` (`hr_transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_transaction_type`
--

DROP TABLE IF EXISTS `hr_transaction_type`;
CREATE TABLE IF NOT EXISTS `hr_transaction_type` (
  `hr_transaction_type_id` int(2) NOT NULL,
  `hr_transaction_type` varchar(15) NOT NULL,
  `display_flag` int(1) NOT NULL,
  UNIQUE KEY `hr_transaction_type_id` (`hr_transaction_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icd_block`
--

DROP TABLE IF EXISTS `icd_block`;
CREATE TABLE IF NOT EXISTS `icd_block` (
  `block_id` varchar(7) NOT NULL,
  `chapter_id` int(2) NOT NULL,
  `block_title` varchar(500) NOT NULL,
  PRIMARY KEY (`block_id`),
  UNIQUE KEY `block_id` (`block_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icd_chapter`
--

DROP TABLE IF EXISTS `icd_chapter`;
CREATE TABLE IF NOT EXISTS `icd_chapter` (
  `chapter_id` int(2) NOT NULL,
  `chapter_title` varchar(500) NOT NULL,
  PRIMARY KEY (`chapter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icd_code`
--

DROP TABLE IF EXISTS `icd_code`;
CREATE TABLE IF NOT EXISTS `icd_code` (
  `icd_code` varchar(4) NOT NULL,
  `block_id` varchar(7) NOT NULL,
  `icd_10` varchar(3) NOT NULL,
  `icd_10_ext` varchar(1) NOT NULL,
  `code_title` varchar(500) NOT NULL,
  PRIMARY KEY (`icd_code`),
  UNIQUE KEY `icd_code` (`icd_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `id_proof_type`
--

DROP TABLE IF EXISTS `id_proof_type`;
CREATE TABLE IF NOT EXISTS `id_proof_type` (
  `id_proof_type_id` int(4) NOT NULL AUTO_INCREMENT,
  `id_proof_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id_proof_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indent`
--

DROP TABLE IF EXISTS `indent`;
CREATE TABLE IF NOT EXISTS `indent` (
  `indent_id` int(6) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(11) NOT NULL,
  `approve_date_time` datetime NOT NULL,
  `issue_date_time` datetime NOT NULL,
  `indent_date` datetime NOT NULL,
  `from_id` int(6) NOT NULL,
  `to_id` int(6) NOT NULL,
  `orderby_id` int(11) NOT NULL COMMENT 'staff_id',
  `approver_id` int(6) NOT NULL COMMENT 'staff_id',
  `issuer_id` int(6) NOT NULL COMMENT 'staff_id',
  `indent_status` varchar(50) NOT NULL COMMENT 'Indented, approved, issued, cancelled',
  `insert_user_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  `insert_datetime` datetime NOT NULL,
  `update_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`indent_id`),
  KEY `hospital_id` (`hospital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Indent for consumables';

-- --------------------------------------------------------

--
-- Table structure for table `indent_item`
--

DROP TABLE IF EXISTS `indent_item`;
CREATE TABLE IF NOT EXISTS `indent_item` (
  `indent_item_id` int(6) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(11) NOT NULL,
  `indent_id` int(6) NOT NULL,
  `item_id` int(6) NOT NULL,
  `quantity_indented` int(11) NOT NULL,
  `quantity_approved` int(11) NOT NULL,
  `quantity_issued` int(11) NOT NULL,
  `indent_status` varchar(50) NOT NULL COMMENT 'Indented, Issued, Rejected, etc.,',
  `issue_date` date NOT NULL,
  `consumption_status` varchar(50) NOT NULL COMMENT 'In stock, expired, damaged, etc.,',
  PRIMARY KEY (`indent_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='List of items for each indent';

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

DROP TABLE IF EXISTS `insurance`;
CREATE TABLE IF NOT EXISTS `insurance` (
  `insurance_id` int(11) NOT NULL AUTO_INCREMENT,
  `insurance_name` varchar(100) NOT NULL,
  PRIMARY KEY (`insurance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `internal_transfer`
--

DROP TABLE IF EXISTS `internal_transfer`;
CREATE TABLE IF NOT EXISTS `internal_transfer` (
  `transfer_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_id` int(11) NOT NULL,
  `department_id` int(3) NOT NULL,
  `area_id` int(3) NOT NULL,
  `transfer_date` date NOT NULL,
  `transfer_time` time NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`transfer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(50) NOT NULL,
  `generic_item_id` int(11) NOT NULL,
  `dosage_id` int(11) NOT NULL,
  `item_form_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `manufacturer_vendor_id` int(11) NOT NULL,
  `description` varchar(30) NOT NULL,
  `model` int(11) NOT NULL,
  `lot_batch_id` varchar(50) NOT NULL,
  `supplier_vendor_id` int(11) NOT NULL,
  `supply_date` date NOT NULL,
  `cost` int(11) NOT NULL,
  `warranty_period` int(3) NOT NULL COMMENT 'in months',
  `manufacturing_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `item_status` varchar(50) NOT NULL COMMENT 'Expired, in stock, issued, partially issued, etc.,',
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_batch`
--

DROP TABLE IF EXISTS `item_batch`;
CREATE TABLE IF NOT EXISTS `item_batch` (
  `batch_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `batch_number` int(11) NOT NULL,
  PRIMARY KEY (`batch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_form`
--

DROP TABLE IF EXISTS `item_form`;
CREATE TABLE IF NOT EXISTS `item_form` (
  `item_form_id` int(6) NOT NULL AUTO_INCREMENT,
  `item_form` varchar(20) NOT NULL COMMENT 'Table, syrup, injection etc...',
  PRIMARY KEY (`item_form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_master`
--

DROP TABLE IF EXISTS `item_master`;
CREATE TABLE IF NOT EXISTS `item_master` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(50) NOT NULL,
  `generic_item_id` int(11) NOT NULL,
  `item_form_id` int(11) NOT NULL,
  `description` varchar(30) NOT NULL,
  `model` int(11) NOT NULL,
  `serial_number` int(11) NOT NULL,
  `asset_number` int(11) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

DROP TABLE IF EXISTS `item_type`;
CREATE TABLE IF NOT EXISTS `item_type` (
  `item_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_type` varchar(50) NOT NULL COMMENT 'Surgical Disposables, chemical, Reagents etc...',
  PRIMARY KEY (`item_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Type of items, Eg. Drugs, Surgicals, Reagents, etc.,';

-- --------------------------------------------------------

--
-- Table structure for table `lab_unit`
--

DROP TABLE IF EXISTS `lab_unit`;
CREATE TABLE IF NOT EXISTS `lab_unit` (
  `lab_unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_unit` varchar(20) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `temp_lab_unit_id` int(11) NOT NULL,
  PRIMARY KEY (`lab_unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave`
--

DROP TABLE IF EXISTS `leave`;
CREATE TABLE IF NOT EXISTS `leave` (
  `leave_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `leave_status` int(1) NOT NULL,
  `leave_submission_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `leave_date` date NOT NULL,
  `comment` varchar(200) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  PRIMARY KEY (`leave_id`),
  KEY `staff_id` (`staff_id`),
  KEY `staff_id_2` (`staff_id`),
  KEY `leave_type_id` (`leave_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_status`
--

DROP TABLE IF EXISTS `leave_status`;
CREATE TABLE IF NOT EXISTS `leave_status` (
  `swap_status` int(11) NOT NULL,
  `swap_status_description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

DROP TABLE IF EXISTS `leave_type`;
CREATE TABLE IF NOT EXISTS `leave_type` (
  `leave_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_type` varchar(20) NOT NULL,
  `note` varchar(60) NOT NULL,
  PRIMARY KEY (`leave_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `list_department`
--

DROP TABLE IF EXISTS `list_department`;
CREATE TABLE IF NOT EXISTS `list_department` (
  `list_department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(100) NOT NULL,
  PRIMARY KEY (`list_department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marital_info`
--

DROP TABLE IF EXISTS `marital_info`;
CREATE TABLE IF NOT EXISTS `marital_info` (
  `marital_history_id` int(7) NOT NULL AUTO_INCREMENT,
  `patient_id` int(5) NOT NULL,
  `marital_life` int(3) NOT NULL,
  `consanguinous` varchar(3) NOT NULL,
  `marital_status` varchar(20) NOT NULL,
  PRIMARY KEY (`marital_history_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menstrual_history`
--

DROP TABLE IF EXISTS `menstrual_history`;
CREATE TABLE IF NOT EXISTS `menstrual_history` (
  `menstrual_history_id` int(7) NOT NULL AUTO_INCREMENT,
  `visit_id` int(7) NOT NULL,
  `regularity` varchar(50) NOT NULL,
  `cycle` varchar(5) NOT NULL,
  `flow_amount` varchar(10) NOT NULL,
  `dysmenorrhea` binary(3) NOT NULL,
  PRIMARY KEY (`menstrual_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `micro_organism`
--

DROP TABLE IF EXISTS `micro_organism`;
CREATE TABLE IF NOT EXISTS `micro_organism` (
  `micro_organism_id` int(6) NOT NULL AUTO_INCREMENT,
  `micro_organism` varchar(100) NOT NULL,
  `micro_organism_type` varchar(20) NOT NULL COMMENT 'Eg. Fungal, Bacterial, Viral, etc.',
  `hospital_id` int(11) NOT NULL,
  `temp_micro_organism_id` int(11) NOT NULL,
  PRIMARY KEY (`micro_organism_id`)
) ENGINE=InnoDB AUTO_INCREMENT=813 DEFAULT CHARSET=latin1 COMMENT='List of micro organisms';

-- --------------------------------------------------------

--
-- Table structure for table `micro_organism_test`
--

DROP TABLE IF EXISTS `micro_organism_test`;
CREATE TABLE IF NOT EXISTS `micro_organism_test` (
  `micro_organism_test_id` int(6) NOT NULL AUTO_INCREMENT,
  `test_id` int(6) NOT NULL,
  `micro_organism_id` int(6) NOT NULL,
  `temp_micro_organism_test_id` int(11) NOT NULL,
  PRIMARY KEY (`micro_organism_test_id`),
  KEY `test_id` (`test_id`),
  KEY `micro_organism_id` (`micro_organism_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12808 DEFAULT CHARSET=latin1 COMMENT='Tests done with micro organisms';

-- --------------------------------------------------------

--
-- Table structure for table `mlc`
--

DROP TABLE IF EXISTS `mlc`;
CREATE TABLE IF NOT EXISTS `mlc` (
  `visit_id` int(7) NOT NULL,
  `mlc_number` varchar(9) NOT NULL,
  `mlc_number_manual` varchar(10) NOT NULL,
  `ps_name` varchar(50) NOT NULL,
  `brought_by` varchar(200) NOT NULL,
  `police_intimation` tinyint(1) NOT NULL,
  `declaration_required` tinyint(1) NOT NULL,
  `pc_number` int(11) NOT NULL,
  `mlc_id` int(11) NOT NULL,
  PRIMARY KEY (`visit_id`),
  UNIQUE KEY `visit_id` (`visit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `obstetric_history`
--

DROP TABLE IF EXISTS `obstetric_history`;
CREATE TABLE IF NOT EXISTS `obstetric_history` (
  `obstetric_history_id` int(7) NOT NULL AUTO_INCREMENT,
  `patient_id` int(7) NOT NULL,
  `pregnancy_number` int(7) NOT NULL,
  `gestation` varchar(25) NOT NULL,
  `lmp` date NOT NULL,
  `edd` date NOT NULL,
  `afi` varchar(50) NOT NULL,
  `anesthesia_type` varchar(50) NOT NULL,
  `placenta` varchar(50) NOT NULL,
  `outcome` varchar(50) NOT NULL,
  `delivery_mode` varchar(50) NOT NULL,
  `sex` binary(3) NOT NULL,
  `birth_weight` int(4) NOT NULL,
  `dob` date NOT NULL,
  `apgar` varchar(50) NOT NULL,
  `suture_removal_date` date NOT NULL,
  `nicu_admission` binary(3) NOT NULL,
  `nicu_admission_reason` varchar(200) NOT NULL,
  `dod` date NOT NULL,
  `cause_of_death` varchar(200) NOT NULL,
  `booking_status` varchar(50) NOT NULL,
  PRIMARY KEY (`obstetric_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `occupation`
--

DROP TABLE IF EXISTS `occupation`;
CREATE TABLE IF NOT EXISTS `occupation` (
  `occupation_id` int(11) NOT NULL AUTO_INCREMENT,
  `occupation` varchar(50) NOT NULL,
  PRIMARY KEY (`occupation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `otp_log`
--

DROP TABLE IF EXISTS `otp_log`;
CREATE TABLE IF NOT EXISTS `otp_log` (
  `staff_id` int(11) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `otp` varchar(7) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `otp_status` varchar(11) NOT NULL DEFAULT 'Generated'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int(7) NOT NULL AUTO_INCREMENT,
  `patient_id_manual` varchar(30) NOT NULL,
  `identification_marks` varchar(200) NOT NULL,
  `first_name` varchar(50) DEFAULT '',
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL DEFAULT '',
  `dob` date NOT NULL,
  `age_years` int(2) NOT NULL,
  `age_months` int(2) NOT NULL,
  `age_days` int(2) NOT NULL,
  `gender` varchar(1) NOT NULL DEFAULT '',
  `address` varchar(100) NOT NULL DEFAULT '',
  `place` varchar(100) NOT NULL DEFAULT '',
  `country_code` varchar(5) NOT NULL,
  `state_code` varchar(5) NOT NULL,
  `district_id` varchar(5) NOT NULL,
  `phone` varchar(20) NOT NULL DEFAULT '',
  `alt_phone` varchar(20) NOT NULL,
  `father_name` varchar(50) NOT NULL DEFAULT '',
  `mother_name` varchar(50) NOT NULL DEFAULT '',
  `spouse_name` varchar(50) DEFAULT '',
  `id_proof_type_id` int(4) NOT NULL,
  `id_proof_number` varchar(20) NOT NULL,
  `occupation_id` int(11) NOT NULL,
  `education_level` varchar(50) NOT NULL,
  `education_qualification` varchar(50) NOT NULL,
  `blood_group` varchar(3) NOT NULL,
  `mr_no` varchar(6) NOT NULL,
  `bc_no` varchar(6) NOT NULL,
  `gestation` int(2) NOT NULL,
  `gestation_type` varchar(10) NOT NULL,
  `delivery_mode` varchar(25) NOT NULL,
  `delivery_place` varchar(100) NOT NULL,
  `delivery_location` varchar(50) NOT NULL,
  `hospital_type` varchar(20) NOT NULL,
  `delivery_location_type` varchar(8) NOT NULL COMMENT 'In-born or Out-born',
  `delivery_plan` varchar(10) NOT NULL,
  `birth_weight` int(4) NOT NULL,
  `congenital_anomalies` varchar(500) NOT NULL,
  `insert_by_user_id` int(11) NOT NULL,
  `update_by_user_id` int(11) NOT NULL,
  `insert_datetime` datetime NOT NULL,
  `update_datetime` datetime NOT NULL,
  `temp_patient_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`patient_id`),
  UNIQUE KEY `patient_id` (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5096233 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient_arrival_mode`
--

DROP TABLE IF EXISTS `patient_arrival_mode`;
CREATE TABLE IF NOT EXISTS `patient_arrival_mode` (
  `arrival_id` int(11) NOT NULL,
  `arrival_mode` varchar(25) NOT NULL,
  PRIMARY KEY (`arrival_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_obstetric_history`
--

DROP TABLE IF EXISTS `patient_obstetric_history`;
CREATE TABLE IF NOT EXISTS `patient_obstetric_history` (
  `obstetric_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `conception_type` int(11) NOT NULL,
  `pregnancy_number` int(11) NOT NULL,
  `delivered` tinyint(4) NOT NULL COMMENT '1 Delivered, -1 Abortion',
  `imp_date` date DEFAULT NULL,
  `edd_date` date DEFAULT NULL,
  `delivery_outcome` int(11) NOT NULL,
  `booked` tinyint(4) NOT NULL COMMENT '1 Booked, -1 Unbooked',
  `delivery_mode_id` int(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` tinyint(4) NOT NULL COMMENT '1-Girl, 2-Boy, 3-Other',
  `weight_at_birth` int(11) NOT NULL,
  `apgar` varchar(100) NOT NULL,
  `nicu_admission` tinyint(4) NOT NULL COMMENT '1-Yes, -1-No',
  `nicu_admission_reason` varchar(200) NOT NULL,
  `alive` tinyint(4) NOT NULL COMMENT '1-Alive, -1-Dead',
  `date_of_death` date NOT NULL,
  `cause_of_death` varchar(250) NOT NULL,
  PRIMARY KEY (`obstetric_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_procedure`
--

DROP TABLE IF EXISTS `patient_procedure`;
CREATE TABLE IF NOT EXISTS `patient_procedure` (
  `patient_procedure_id` int(10) NOT NULL AUTO_INCREMENT,
  `procedure_plan_id` int(11) NOT NULL,
  `visit_id` bigint(10) NOT NULL,
  `procedure_id` int(11) NOT NULL,
  `procedure_datetime` datetime NOT NULL,
  `procedure_duration` varchar(12) NOT NULL,
  `procedure_note` text NOT NULL,
  `procedure_findings` longtext NOT NULL,
  `post_procedure` text NOT NULL,
  PRIMARY KEY (`patient_procedure_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_treatment`
--

DROP TABLE IF EXISTS `patient_treatment`;
CREATE TABLE IF NOT EXISTS `patient_treatment` (
  `treatment_id` int(10) NOT NULL AUTO_INCREMENT,
  `visit_id` bigint(10) NOT NULL,
  `treatment_type` varchar(20) NOT NULL,
  `treatment` varchar(50) NOT NULL,
  `treatment_date` date NOT NULL,
  `treatment_time` time NOT NULL,
  `duration` varchar(12) NOT NULL,
  `notes` varchar(300) NOT NULL,
  PRIMARY KEY (`treatment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_visit`
--

DROP TABLE IF EXISTS `patient_visit`;
CREATE TABLE IF NOT EXISTS `patient_visit` (
  `visit_id` int(7) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(11) NOT NULL,
  `admit_id` int(7) NOT NULL,
  `visit_type` varchar(8) NOT NULL,
  `visit_name_id` int(11) NOT NULL,
  `patient_id` int(7) NOT NULL,
  `hosp_file_no` int(7) NOT NULL,
  `admit_date` date NOT NULL,
  `admit_time` time NOT NULL,
  `department_id` int(3) NOT NULL,
  `unit` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `nurse` varchar(50) NOT NULL,
  `insurance_case` varchar(1) NOT NULL,
  `insurance_id` int(11) NOT NULL,
  `insurance_no` varchar(10) NOT NULL,
  `presenting_complaints` varchar(500) NOT NULL,
  `past_history` varchar(500) NOT NULL,
  `family_history` longtext NOT NULL,
  `admit_weight` int(6) NOT NULL,
  `pulse_rate` int(3) NOT NULL,
  `respiratory_rate` int(3) NOT NULL,
  `temperature` int(3) NOT NULL,
  `sbp` int(3) NOT NULL,
  `dbp` int(3) NOT NULL,
  `clinical_findings` longtext NOT NULL,
  `cvs` text NOT NULL,
  `rs` text NOT NULL,
  `pa` text NOT NULL,
  `cns` text NOT NULL,
  `cxr` text NOT NULL,
  `provisional_diagnosis` varchar(500) NOT NULL,
  `final_diagnosis` varchar(500) NOT NULL,
  `decision` text NOT NULL,
  `advise` text NOT NULL,
  `icd_10` varchar(4) NOT NULL,
  `icd_10_ext` varchar(1) NOT NULL,
  `discharge_weight` int(6) NOT NULL,
  `outcome` varchar(11) NOT NULL,
  `outcome_date` date NOT NULL,
  `outcome_time` time NOT NULL,
  `ip_file_received` date NOT NULL,
  `mlc` tinyint(1) NOT NULL,
  `arrival_mode` varchar(25) DEFAULT NULL,
  `refereal_hospital_id` int(11) DEFAULT NULL,
  `insert_by_user_id` int(11) NOT NULL,
  `update_by_user_id` int(11) NOT NULL,
  `insert_datetime` datetime NOT NULL,
  `update_datetime` datetime NOT NULL,
  `temp_visit_id` int(11) NOT NULL,
  PRIMARY KEY (`visit_id`),
  UNIQUE KEY `visit_id_2` (`visit_id`),
  KEY `visit_id` (`visit_id`),
  KEY `hospital_id` (`hospital_id`),
  KEY `admit_date` (`admit_date`),
  KEY `unit` (`unit`),
  KEY `department_id` (`department_id`),
  KEY `area` (`area`),
  KEY `patient_id` (`patient_id`),
  KEY `visit_type` (`visit_type`),
  KEY `hosp_file_no` (`hosp_file_no`)
) ENGINE=MyISAM AUTO_INCREMENT=6058159 DEFAULT CHARSET=latin1 COMMENT='All visits made by patients';

-- --------------------------------------------------------

--
-- Table structure for table `physical_function_link`
--

DROP TABLE IF EXISTS `physical_function_link`;
CREATE TABLE IF NOT EXISTS `physical_function_link` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `function_id` int(11) NOT NULL,
  `physical_address` varchar(20) NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `places_table`
--

DROP TABLE IF EXISTS `places_table`;
CREATE TABLE IF NOT EXISTS `places_table` (
  `place_id` int(11) NOT NULL AUTO_INCREMENT,
  `col_change` varchar(1) DEFAULT NULL,
  `country_code` varchar(2) NOT NULL,
  `place_code` varchar(3) DEFAULT NULL,
  `place_name` varchar(100) DEFAULT NULL,
  `place_name_without_diacritics` varchar(100) DEFAULT NULL,
  `state_code` varchar(3) DEFAULT NULL,
  `place_function` varchar(8) DEFAULT NULL,
  `place_status` varchar(2) DEFAULT NULL,
  `place_date` varchar(4) DEFAULT NULL,
  `place_iata` varchar(3) DEFAULT NULL,
  `subsidiary_loc` varchar(12) DEFAULT NULL,
  `support_codes` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`place_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

DROP TABLE IF EXISTS `prescription`;
CREATE TABLE IF NOT EXISTS `prescription` (
  `prescription_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `frequency` varchar(15) NOT NULL,
  `morning` tinyint(4) NOT NULL,
  `afternoon` tinyint(4) NOT NULL,
  `evening` tinyint(4) NOT NULL,
  `quantity` double NOT NULL,
  `unit_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`prescription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `print_layout`
--

DROP TABLE IF EXISTS `print_layout`;
CREATE TABLE IF NOT EXISTS `print_layout` (
  `print_layout_id` int(6) NOT NULL AUTO_INCREMENT,
  `print_layout_name` varchar(100) NOT NULL,
  `print_layout_page` varchar(100) NOT NULL,
  PRIMARY KEY (`print_layout_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `procedure`
--

DROP TABLE IF EXISTS `procedure`;
CREATE TABLE IF NOT EXISTS `procedure` (
  `procedure_id` int(11) NOT NULL AUTO_INCREMENT,
  `procedure_name` varchar(100) NOT NULL,
  `procedure_type_id` int(11) NOT NULL,
  PRIMARY KEY (`procedure_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `procedure_plan`
--

DROP TABLE IF EXISTS `procedure_plan`;
CREATE TABLE IF NOT EXISTS `procedure_plan` (
  `procedure_plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_id` int(11) NOT NULL,
  `procedure_id` int(11) NOT NULL,
  `plan_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`procedure_plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `procedure_staff`
--

DROP TABLE IF EXISTS `procedure_staff`;
CREATE TABLE IF NOT EXISTS `procedure_staff` (
  `procedure_staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_procedure_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `staff_role` varchar(20) NOT NULL,
  PRIMARY KEY (`procedure_staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `procedure_type`
--

DROP TABLE IF EXISTS `procedure_type`;
CREATE TABLE IF NOT EXISTS `procedure_type` (
  `procedure_type_id` int(3) NOT NULL AUTO_INCREMENT,
  `procedure_type` varchar(50) NOT NULL,
  PRIMARY KEY (`procedure_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `publication_id` int(6) NOT NULL AUTO_INCREMENT,
  `staff_id` int(6) NOT NULL,
  `title` text NOT NULL,
  `journal` varchar(100) NOT NULL,
  `edition` varchar(50) NOT NULL,
  PRIMARY KEY (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

DROP TABLE IF EXISTS `qualification`;
CREATE TABLE IF NOT EXISTS `qualification` (
  `qualification_id` int(6) NOT NULL AUTO_INCREMENT,
  `staff_id` int(6) NOT NULL,
  `degree` varchar(50) NOT NULL,
  `year_of_completion` int(4) NOT NULL,
  `university` varchar(100) NOT NULL,
  PRIMARY KEY (`qualification_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roaster`
--

DROP TABLE IF EXISTS `roaster`;
CREATE TABLE IF NOT EXISTS `roaster` (
  `roaster_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `shift_id` int(11) NOT NULL,
  `swap_status` int(1) NOT NULL,
  `original_shift_id` int(11) NOT NULL,
  PRIMARY KEY (`roaster_id`),
  KEY `staff_id` (`staff_id`),
  KEY `shift_id` (`shift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sample_status`
--

DROP TABLE IF EXISTS `sample_status`;
CREATE TABLE IF NOT EXISTS `sample_status` (
  `sample_status_id` int(6) NOT NULL AUTO_INCREMENT,
  `sample_status` varchar(50) NOT NULL,
  PRIMARY KEY (`sample_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Status of the samples sent for testing';

-- --------------------------------------------------------

--
-- Table structure for table `service_record`
--

DROP TABLE IF EXISTS `service_record`;
CREATE TABLE IF NOT EXISTS `service_record` (
  `request_id` int(4) NOT NULL AUTO_INCREMENT,
  `equipment_id` int(6) NOT NULL,
  `user_id` int(4) NOT NULL,
  `call_date` date DEFAULT NULL,
  `call_time` time DEFAULT NULL,
  `call_information_type` varchar(50) NOT NULL,
  `call_information` varchar(500) DEFAULT NULL,
  `vendor_id` int(10) NOT NULL,
  `contact_person_id` varchar(50) NOT NULL,
  `service_provider` varchar(50) DEFAULT NULL,
  `service_person` varchar(50) DEFAULT NULL,
  `service_person_remarks` varchar(500) DEFAULT NULL,
  `service_date` date DEFAULT NULL,
  `service_time` time DEFAULT NULL,
  `problem_status` varchar(17) DEFAULT NULL,
  `working_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`request_id`),
  UNIQUE KEY `request_id` (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Service records log for equipments';

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

DROP TABLE IF EXISTS `shift`;
CREATE TABLE IF NOT EXISTS `shift` (
  `shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `shift` varchar(10) NOT NULL,
  `description` varchar(20) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  PRIMARY KEY (`shift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `specimen_type`
--

DROP TABLE IF EXISTS `specimen_type`;
CREATE TABLE IF NOT EXISTS `specimen_type` (
  `specimen_type_id` int(6) NOT NULL AUTO_INCREMENT,
  `specimen_type` varchar(100) NOT NULL COMMENT 'Eg. Sputum, Urine, CSF, etc.',
  `hospital_id` int(11) NOT NULL,
  `temp_specimen_type_id` int(11) NOT NULL,
  PRIMARY KEY (`specimen_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` int(4) NOT NULL AUTO_INCREMENT,
  `hospital_id` int(3) NOT NULL,
  `department_id` int(2) NOT NULL,
  `unit_id` int(6) NOT NULL,
  `area_id` int(6) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(1) NOT NULL,
  `staff_category` varchar(50) NOT NULL,
  `staff_category_id` int(6) NOT NULL COMMENT 'Seniority based classification. Eg. Professor, Asst. Professor, etc.',
  `staff_type` varchar(20) NOT NULL COMMENT 'On roles, On contract, etc. ',
  `staff_role` varchar(20) NOT NULL,
  `staff_role_id` int(6) NOT NULL,
  `mci_flag` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Medical Council of India, 1- Reported, 0- NonReported',
  `ima_registration_number` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL,
  `qualification_id` int(6) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `area_of_responsibility` varchar(100) NOT NULL,
  `research_area` varchar(100) NOT NULL,
  `specialisation` varchar(100) NOT NULL,
  `research` varchar(200) NOT NULL,
  `personal_note` text NOT NULL,
  `staff_status` varchar(30) NOT NULL COMMENT 'Default : Active, Transferred, Resigned, Retired, etc.,',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `status_date` date NOT NULL,
  `doctor_reg_no` varchar(20) NOT NULL,
  `staff_flag` binary(1) NOT NULL,
  `doctor_flag` binary(1) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `bank_branch` varchar(100) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `ifsc_code` varchar(11) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1547 DEFAULT CHARSET=latin1 COMMENT='Staff details working at the hospital';

-- --------------------------------------------------------

--
-- Table structure for table `staff_applicant`
--

DROP TABLE IF EXISTS `staff_applicant`;
CREATE TABLE IF NOT EXISTS `staff_applicant` (
  `applicant_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `fathers_name` varchar(70) NOT NULL,
  `mothers_name` varchar(70) NOT NULL,
  `husbands_name` varchar(70) NOT NULL,
  `address` varchar(200) NOT NULL,
  `place` varchar(60) NOT NULL,
  `district_id` int(6) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `phone_alternate` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `drive_id` int(11) NOT NULL,
  `staff_id` int(3) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`applicant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=386 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_applicant_college`
--

DROP TABLE IF EXISTS `staff_applicant_college`;
CREATE TABLE IF NOT EXISTS `staff_applicant_college` (
  `college_id` int(11) NOT NULL AUTO_INCREMENT,
  `college_name` varchar(150) NOT NULL,
  `affiliated_to` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `district_id` int(11) NOT NULL,
  `email` varchar(70) NOT NULL,
  `university_flag` tinyint(1) NOT NULL,
  `public_institution_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`college_id`)
) ENGINE=MyISAM AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_applicant_qualification`
--

DROP TABLE IF EXISTS `staff_applicant_qualification`;
CREATE TABLE IF NOT EXISTS `staff_applicant_qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `qualification_id` int(3) NOT NULL,
  `college_id` int(11) NOT NULL,
  `registration_number` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `staff_id` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=574 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_applicant_qualification_master`
--

DROP TABLE IF EXISTS `staff_applicant_qualification_master`;
CREATE TABLE IF NOT EXISTS `staff_applicant_qualification_master` (
  `qualification_id` int(11) NOT NULL AUTO_INCREMENT,
  `qualification` varchar(75) NOT NULL,
  `qualification_level_id` int(11) NOT NULL,
  PRIMARY KEY (`qualification_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_applicant_score`
--

DROP TABLE IF EXISTS `staff_applicant_score`;
CREATE TABLE IF NOT EXISTS `staff_applicant_score` (
  `score_id` int(11) NOT NULL AUTO_INCREMENT,
  `parameter_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `drive_id` int(11) NOT NULL,
  `score` varchar(300) NOT NULL,
  PRIMARY KEY (`score_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4621 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_applicant_work_expriance`
--

DROP TABLE IF EXISTS `staff_applicant_work_expriance`;
CREATE TABLE IF NOT EXISTS `staff_applicant_work_expriance` (
  `experiance_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `experiance_years` varchar(2) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`experiance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=646 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_category`
--

DROP TABLE IF EXISTS `staff_category`;
CREATE TABLE IF NOT EXISTS `staff_category` (
  `staff_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_category` varchar(50) NOT NULL COMMENT 'Eg: Prof, Asst. Prof, Assoc. Prof., etc.',
  `seniority` int(11) NOT NULL,
  PRIMARY KEY (`staff_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COMMENT='Seniority based designation/categorization';

-- --------------------------------------------------------

--
-- Table structure for table `staff_previous_hospital`
--

DROP TABLE IF EXISTS `staff_previous_hospital`;
CREATE TABLE IF NOT EXISTS `staff_previous_hospital` (
  `hospital_id` int(11) NOT NULL AUTO_INCREMENT,
  `hospital_name` varchar(150) NOT NULL,
  `address` varchar(300) NOT NULL,
  `district_id` int(6) NOT NULL,
  `public_institution_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`hospital_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_recruitment_drive`
--

DROP TABLE IF EXISTS `staff_recruitment_drive`;
CREATE TABLE IF NOT EXISTS `staff_recruitment_drive` (
  `drive_id` int(11) NOT NULL AUTO_INCREMENT,
  `place` varchar(160) NOT NULL,
  `name` varchar(70) NOT NULL,
  `start_date` date NOT NULL,
  PRIMARY KEY (`drive_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_role`
--

DROP TABLE IF EXISTS `staff_role`;
CREATE TABLE IF NOT EXISTS `staff_role` (
  `staff_role_id` int(6) NOT NULL AUTO_INCREMENT,
  `staff_role` varchar(100) NOT NULL COMMENT 'Eg. Doctor, Nurse, Technician, etc.',
  PRIMARY KEY (`staff_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_selection_parameter`
--

DROP TABLE IF EXISTS `staff_selection_parameter`;
CREATE TABLE IF NOT EXISTS `staff_selection_parameter` (
  `parameter_id` int(11) NOT NULL AUTO_INCREMENT,
  `drive_id` int(11) NOT NULL,
  `parameter_label` varchar(250) NOT NULL,
  `parameter_max_value` varchar(10) NOT NULL,
  `parameter_rank` int(2) NOT NULL,
  PRIMARY KEY (`parameter_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_service`
--

DROP TABLE IF EXISTS `staff_service`;
CREATE TABLE IF NOT EXISTS `staff_service` (
  `service_id` int(6) NOT NULL AUTO_INCREMENT,
  `date_of_joining` date NOT NULL,
  `designation` varchar(100) NOT NULL,
  `institution` varchar(100) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(2) NOT NULL AUTO_INCREMENT,
  `state` varchar(50) NOT NULL,
  `latitude` decimal(6,6) NOT NULL,
  `longitude` decimal(6,6) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state_codes`
--

DROP TABLE IF EXISTS `state_codes`;
CREATE TABLE IF NOT EXISTS `state_codes` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) NOT NULL,
  `state_code` varchar(3) NOT NULL,
  `state_name` varchar(77) NOT NULL,
  `type` varchar(51) DEFAULT NULL,
  PRIMARY KEY (`state_id`),
  UNIQUE KEY `country_code` (`country_code`,`state_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supply_chain_party`
--

DROP TABLE IF EXISTS `supply_chain_party`;
CREATE TABLE IF NOT EXISTS `supply_chain_party` (
  `supply_chain_party_id` int(11) NOT NULL AUTO_INCREMENT,
  `supply_chain_party_name` varchar(150) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  PRIMARY KEY (`supply_chain_party_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `swap_request`
--

DROP TABLE IF EXISTS `swap_request`;
CREATE TABLE IF NOT EXISTS `swap_request` (
  `swap_id` int(11) NOT NULL AUTO_INCREMENT,
  `roaster_id_requested` int(11) NOT NULL,
  `shift_id_requested` int(11) NOT NULL,
  `request_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `swap_status` int(1) NOT NULL,
  `roaster_id_accepted` int(11) DEFAULT NULL,
  PRIMARY KEY (`swap_id`),
  KEY `roaster_id_requested` (`roaster_id_requested`),
  KEY `shift_id_requested` (`shift_id_requested`),
  KEY `roaster_id_accepted` (`roaster_id_accepted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `swap_request_sent`
--

DROP TABLE IF EXISTS `swap_request_sent`;
CREATE TABLE IF NOT EXISTS `swap_request_sent` (
  `swap_request_sent_id` int(11) NOT NULL AUTO_INCREMENT,
  `swap_id` int(11) NOT NULL,
  `staff_id_sent_to` int(11) NOT NULL,
  PRIMARY KEY (`swap_request_sent_id`),
  KEY `swap_id` (`swap_id`),
  KEY `staff_id_sent_to` (`staff_id_sent_to`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `swap_rule`
--

DROP TABLE IF EXISTS `swap_rule`;
CREATE TABLE IF NOT EXISTS `swap_rule` (
  `max_swaps_per_month` int(5) NOT NULL,
  `max_swaps_per_week` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `test_id` int(6) NOT NULL AUTO_INCREMENT,
  `order_id` int(6) NOT NULL,
  `sample_id` int(6) NOT NULL,
  `test_master_id` int(6) NOT NULL,
  `group_id` int(6) NOT NULL,
  `test_result` double DEFAULT NULL COMMENT 'Where test results are numeric',
  `test_result_binary` tinyint(1) NOT NULL COMMENT '0 - Negative, 1 - Positive',
  `test_result_text` longtext NOT NULL COMMENT 'Any descriptive test results',
  `test_date_time` datetime NOT NULL,
  `test_done_by` int(6) NOT NULL COMMENT 'staff_id',
  `test_approved_by` int(6) NOT NULL COMMENT 'staff_id',
  `reported_date_time` datetime NOT NULL,
  `test_status` tinyint(1) NOT NULL,
  `test_range_id` varchar(123) NOT NULL,
  `temp_test_id` int(11) NOT NULL,
  PRIMARY KEY (`test_id`),
  KEY `order_id` (`order_id`),
  KEY `sample_id` (`sample_id`),
  KEY `sample_id_2` (`sample_id`),
  KEY `temp_test_id` (`temp_test_id`),
  KEY `test_master_id` (`test_master_id`),
  KEY `group_id` (`group_id`),
  KEY `test_id` (`test_id`),
  KEY `test_status` (`test_status`)
) ENGINE=InnoDB AUTO_INCREMENT=3628994 DEFAULT CHARSET=latin1 COMMENT='Details of tests done';

-- --------------------------------------------------------

--
-- Table structure for table `test_area`
--

DROP TABLE IF EXISTS `test_area`;
CREATE TABLE IF NOT EXISTS `test_area` (
  `test_area_id` int(6) NOT NULL AUTO_INCREMENT,
  `test_area` varchar(100) NOT NULL COMMENT 'Eg. Microbiology, Pathology, etc.',
  `department_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `temp_test_area_id` int(11) NOT NULL,
  PRIMARY KEY (`test_area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 COMMENT='Areas where the tests are done';

-- --------------------------------------------------------

--
-- Table structure for table `test_assay`
--

DROP TABLE IF EXISTS `test_assay`;
CREATE TABLE IF NOT EXISTS `test_assay` (
  `assay_id` int(11) NOT NULL AUTO_INCREMENT,
  `assay` varchar(100) NOT NULL,
  `temp_assay_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`assay_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_group`
--

DROP TABLE IF EXISTS `test_group`;
CREATE TABLE IF NOT EXISTS `test_group` (
  `group_id` int(6) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL COMMENT 'LFT, RFT, etc.,',
  `test_method_id` int(11) NOT NULL,
  `has_result` tinyint(1) NOT NULL COMMENT '1 if the group has an interpretation of its own, 0 otherwise',
  `binary_result` tinyint(1) NOT NULL,
  `numeric_result` tinyint(1) NOT NULL,
  `text_result` tinyint(1) NOT NULL,
  `binary_positive` varchar(30) NOT NULL,
  `binary_negative` varchar(30) NOT NULL,
  `numeric_result_unit` int(11) NOT NULL,
  `interpretation` text NOT NULL,
  `temp_test_group_id` int(11) NOT NULL,
  `temp_group_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `group_id` (`group_id`),
  KEY `temp_group_id` (`temp_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=latin1 COMMENT='Standard grouping of tests or test panels';

-- --------------------------------------------------------

--
-- Table structure for table `test_group_link`
--

DROP TABLE IF EXISTS `test_group_link`;
CREATE TABLE IF NOT EXISTS `test_group_link` (
  `link_id` int(6) NOT NULL AUTO_INCREMENT,
  `group_id` int(6) NOT NULL,
  `test_master_id` int(6) NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=609 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_master`
--

DROP TABLE IF EXISTS `test_master`;
CREATE TABLE IF NOT EXISTS `test_master` (
  `test_master_id` int(6) NOT NULL AUTO_INCREMENT,
  `test_name` varchar(50) NOT NULL COMMENT 'Eg : ASO, CRP, Blood Culture...',
  `assay_id` int(10) NOT NULL,
  `test_method_id` int(6) NOT NULL,
  `test_area_id` int(6) DEFAULT NULL,
  `binary_result` tinyint(1) NOT NULL,
  `numeric_result` double NOT NULL,
  `text_range` int(1) NOT NULL DEFAULT '0',
  `text_result` text NOT NULL,
  `binary_positive` varchar(30) NOT NULL,
  `binary_negative` varchar(30) NOT NULL,
  `numeric_result_unit` int(11) NOT NULL,
  `availability` int(1) NOT NULL DEFAULT '1' COMMENT '1-available, 0-unavailable',
  `nabl` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 NABL accredited, 0 Not accredited',
  `level` int(11) DEFAULT NULL,
  `comments` varchar(60) DEFAULT NULL COMMENT 'comments on availability',
  `interpretation` text NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `temp_test_master_id` int(11) NOT NULL,
  PRIMARY KEY (`test_master_id`),
  KEY `tm_ta_fk` (`test_area_id`),
  KEY `test_master_id` (`test_master_id`),
  KEY `temp_test_master_id` (`temp_test_master_id`)
) ENGINE=InnoDB AUTO_INCREMENT=877 DEFAULT CHARSET=latin1 COMMENT='Master list of tests performed in the labs';

-- --------------------------------------------------------

--
-- Table structure for table `test_method`
--

DROP TABLE IF EXISTS `test_method`;
CREATE TABLE IF NOT EXISTS `test_method` (
  `test_method_id` int(6) NOT NULL AUTO_INCREMENT,
  `test_method` varchar(100) NOT NULL COMMENT 'Eg. Serology, Microscopy, etc.)',
  `accredition_logo` varchar(200) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `temp_test_method_id` int(11) NOT NULL,
  PRIMARY KEY (`test_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1 COMMENT='Methods of testing';

-- --------------------------------------------------------

--
-- Table structure for table `test_order`
--

DROP TABLE IF EXISTS `test_order`;
CREATE TABLE IF NOT EXISTS `test_order` (
  `order_id` int(6) NOT NULL AUTO_INCREMENT,
  `visit_id` int(6) NOT NULL,
  `doctor_id` int(6) NOT NULL COMMENT 'staff_id',
  `test_area_id` int(6) NOT NULL,
  `order_date_time` datetime NOT NULL,
  `received_date_time` datetime NOT NULL,
  `order_status` tinyint(1) NOT NULL COMMENT '0 - Ordered, 1 - Received',
  `hospital_id` int(11) NOT NULL,
  `temp_order_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `visit_id` (`visit_id`),
  KEY `temp_order_id` (`temp_order_id`),
  KEY `order_id` (`order_id`),
  KEY `hospital_id` (`hospital_id`)
) ENGINE=InnoDB AUTO_INCREMENT=712890 DEFAULT CHARSET=latin1 COMMENT='Orders placed for diagnostic test';

-- --------------------------------------------------------

--
-- Table structure for table `test_range`
--

DROP TABLE IF EXISTS `test_range`;
CREATE TABLE IF NOT EXISTS `test_range` (
  `test_range_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_master_id` int(11) NOT NULL,
  `gender` tinyint(1) NOT NULL COMMENT '0-All, 1-Male, 2-Female',
  `min` varchar(10) NOT NULL,
  `max` varchar(10) NOT NULL,
  `range_text` varchar(100) NOT NULL,
  `from_year` int(11) NOT NULL,
  `to_year` int(11) NOT NULL,
  `from_month` int(11) NOT NULL,
  `to_month` int(11) NOT NULL,
  `from_day` int(11) NOT NULL,
  `to_day` int(11) NOT NULL,
  `range_type` tinyint(4) NOT NULL COMMENT '4-Text_range, 3-Range, 1-Less Than, 2-Greater Than',
  `age_type` tinyint(4) NOT NULL COMMENT '4-All ages, 3-Range, 1-Less Than, 2-Greater Than',
  `range_active` int(10) NOT NULL,
  `temp_test_range_id` int(11) NOT NULL,
  PRIMARY KEY (`test_range_id`),
  KEY `test_master_id` (`test_master_id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_result_suggestion`
--

DROP TABLE IF EXISTS `test_result_suggestion`;
CREATE TABLE IF NOT EXISTS `test_result_suggestion` (
  `suggestion_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_master_id` int(5) NOT NULL,
  `suggestion` varchar(250) NOT NULL,
  `temp_suggestion_id` int(11) NOT NULL,
  PRIMARY KEY (`suggestion_id`)
) ENGINE=MyISAM AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_sample`
--

DROP TABLE IF EXISTS `test_sample`;
CREATE TABLE IF NOT EXISTS `test_sample` (
  `sample_id` int(6) NOT NULL AUTO_INCREMENT,
  `sample_code` varchar(10) NOT NULL,
  `sample_date_time` datetime NOT NULL,
  `order_id` int(6) NOT NULL,
  `specimen_type_id` int(6) NOT NULL,
  `sample_container_type` varchar(50) NOT NULL,
  `specimen_source` varchar(150) NOT NULL,
  `sample_status_id` int(4) NOT NULL,
  `temp_sample_id` int(11) NOT NULL,
  PRIMARY KEY (`sample_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=712899 DEFAULT CHARSET=latin1 COMMENT='Samples sent for test';

-- --------------------------------------------------------

--
-- Table structure for table `test_status`
--

DROP TABLE IF EXISTS `test_status`;
CREATE TABLE IF NOT EXISTS `test_status` (
  `test_status_id` int(6) NOT NULL AUTO_INCREMENT,
  `test_id` int(6) NOT NULL,
  `test_status_type_id` int(6) NOT NULL,
  `status_date_time` datetime NOT NULL,
  PRIMARY KEY (`test_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Status logs of tests';

-- --------------------------------------------------------

--
-- Table structure for table `test_status_type`
--

DROP TABLE IF EXISTS `test_status_type`;
CREATE TABLE IF NOT EXISTS `test_status_type` (
  `test_status_type_id` int(6) NOT NULL AUTO_INCREMENT,
  `test_status` varchar(100) NOT NULL COMMENT 'Not performed, performed, approved, failed, etc.,',
  PRIMARY KEY (`test_status_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Master list of status types for a test';

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

DROP TABLE IF EXISTS `transport`;
CREATE TABLE IF NOT EXISTS `transport` (
  `transport_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_id` int(11) NOT NULL,
  `from_area_id` int(11) NOT NULL,
  `to_area_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `start_date_time` datetime NOT NULL,
  `end_date_time` datetime NOT NULL,
  `entry_date_time` datetime NOT NULL,
  `transport_type` tinyint(4) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`transport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `treatment_type`
--

DROP TABLE IF EXISTS `treatment_type`;
CREATE TABLE IF NOT EXISTS `treatment_type` (
  `treatment_type_id` int(3) NOT NULL AUTO_INCREMENT,
  `treatment_type` varchar(50) NOT NULL,
  PRIMARY KEY (`treatment_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
CREATE TABLE IF NOT EXISTS `unit` (
  `unit_id` int(4) NOT NULL AUTO_INCREMENT,
  `unit_head_staff_id` int(11) NOT NULL,
  `unit_name` varchar(20) NOT NULL,
  `department_id` int(4) NOT NULL,
  `beds` int(4) NOT NULL,
  `lab_report_staff_id` int(11) NOT NULL,
  `temp_unit_id` int(11) NOT NULL,
  PRIMARY KEY (`unit_id`),
  KEY `temp_unit_id` (`temp_unit_id`),
  KEY `unit_id` (`unit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=492 DEFAULT CHARSET=latin1 COMMENT='Units belonging to departments in hospital';

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(64) NOT NULL,
  `staff_id` int(6) NOT NULL,
  `present_login_time` time NOT NULL,
  `present_login_date` date NOT NULL,
  `past_login_time` time NOT NULL,
  `past_login_date` date NOT NULL,
  `temp_user_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=497 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE IF NOT EXISTS `user_activity` (
  `update_id` int(7) NOT NULL AUTO_INCREMENT,
  `visit_id` int(7) NOT NULL,
  `user_id` int(4) NOT NULL,
  `register` tinyint(1) NOT NULL,
  `event_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`update_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_department_link`
--

DROP TABLE IF EXISTS `user_department_link`;
CREATE TABLE IF NOT EXISTS `user_department_link` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=472 DEFAULT CHARSET=latin1 COMMENT='Links users with departments';

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

-- --------------------------------------------------------

--
-- Table structure for table `user_function_link`
--

DROP TABLE IF EXISTS `user_function_link`;
CREATE TABLE IF NOT EXISTS `user_function_link` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  `add` tinyint(1) NOT NULL,
  `edit` tinyint(1) NOT NULL,
  `view` tinyint(1) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1' COMMENT '1- Function active with user, 0- Function disabled.',
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5921 DEFAULT CHARSET=latin1 COMMENT='Links users to functions with specific permissions';

-- --------------------------------------------------------

--
-- Table structure for table `user_hospital_link`
--

DROP TABLE IF EXISTS `user_hospital_link`;
CREATE TABLE IF NOT EXISTS `user_hospital_link` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1030 DEFAULT CHARSET=latin1 COMMENT='Links users with hospitals';

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_type_id` int(11) NOT NULL,
  `vendor_name` varchar(30) NOT NULL,
  `vendor_address` varchar(50) NOT NULL,
  `vendor_city` varchar(50) NOT NULL,
  `vendor_state` varchar(50) NOT NULL,
  `vendor_country` varchar(50) NOT NULL,
  `account_no` varchar(30) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `vendor_email` varchar(200) NOT NULL,
  `vendor_phone` varchar(20) NOT NULL,
  `contact_person_id` int(11) NOT NULL COMMENT 'primary contact person',
  `vendor_pan` varchar(10) NOT NULL,
  PRIMARY KEY (`vendor_id`),
  KEY `vendor_type_id` (`vendor_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='List of vendors';

-- --------------------------------------------------------

--
-- Table structure for table `vendor_contracts`
--

DROP TABLE IF EXISTS `vendor_contracts`;
CREATE TABLE IF NOT EXISTS `vendor_contracts` (
  `contract_id` int(4) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(4) NOT NULL,
  `facility_id` int(4) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`contract_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_type`
--

DROP TABLE IF EXISTS `vendor_type`;
CREATE TABLE IF NOT EXISTS `vendor_type` (
  `vendor_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_type` varchar(50) NOT NULL,
  PRIMARY KEY (`vendor_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `village_town`
--

DROP TABLE IF EXISTS `village_town`;
CREATE TABLE IF NOT EXISTS `village_town` (
  `village_town_id` int(6) NOT NULL AUTO_INCREMENT,
  `village_town` varchar(100) NOT NULL,
  PRIMARY KEY (`village_town_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visit_name`
--

DROP TABLE IF EXISTS `visit_name`;
CREATE TABLE IF NOT EXISTS `visit_name` (
  `visit_name_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_name` varchar(50) NOT NULL,
  PRIMARY KEY (`visit_name_id`),
  KEY `visit_name_id` (`visit_name_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leave`
--
ALTER TABLE `leave`
  ADD CONSTRAINT `leave_ibfk_2` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_type` (`leave_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roaster`
--
ALTER TABLE `roaster`
  ADD CONSTRAINT `roaster_ibfk_2` FOREIGN KEY (`shift_id`) REFERENCES `shift` (`shift_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `swap_request`
--
ALTER TABLE `swap_request`
  ADD CONSTRAINT `swap_request_ibfk_1` FOREIGN KEY (`roaster_id_requested`) REFERENCES `roaster` (`roaster_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `swap_request_ibfk_2` FOREIGN KEY (`shift_id_requested`) REFERENCES `shift` (`shift_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `swap_request_ibfk_3` FOREIGN KEY (`roaster_id_accepted`) REFERENCES `roaster` (`roaster_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `swap_request_sent`
--
ALTER TABLE `swap_request_sent`
  ADD CONSTRAINT `swap_request_sent_ibfk_1` FOREIGN KEY (`swap_id`) REFERENCES `swap_request` (`swap_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_master`
--
ALTER TABLE `test_master`
  ADD CONSTRAINT `tm_ta_fk` FOREIGN KEY (`test_area_id`) REFERENCES `test_area` (`test_area_id`);

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `fk_vendor_vendortype_vendor_type_id` FOREIGN KEY (`vendor_type_id`) REFERENCES `vendor_type` (`vendor_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
