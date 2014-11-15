-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2014 at 11:56 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `focuschamps`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`aid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `affiliation_type`
--

CREATE TABLE IF NOT EXISTS `affiliation_type` (
  `atid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`atid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `champion`
--

CREATE TABLE IF NOT EXISTS `champion` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cuid` int(11) DEFAULT NULL,
  `atid` int(11) DEFAULT NULL,
  `grad_year` year(4) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `phone_alt` varchar(20) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `url_fb` varchar(100) DEFAULT NULL,
  `url_tw` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  KEY `cuid` (`cuid`),
  KEY `atid` (`atid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('1ea14aea127e3c3e8075ccbf48094339', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1416008909, ''),
('ee7b06e780160769f149586ed671ecc5', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1416016196, '');

-- --------------------------------------------------------

--
-- Table structure for table `commitment`
--

CREATE TABLE IF NOT EXISTS `commitment` (
  `cmid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `ctid` int(11) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `lifetime` int(11) DEFAULT NULL,
  PRIMARY KEY (`cmid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `commitment_type`
--

CREATE TABLE IF NOT EXISTS `commitment_type` (
  `ctid` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cu`
--

CREATE TABLE IF NOT EXISTS `cu` (
  `cuid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`cuid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invite`
--

CREATE TABLE IF NOT EXISTS `invite` (
  `iid` int(11) NOT NULL AUTO_INCREMENT,
  `cid_from` int(11) DEFAULT NULL,
  `cid_to` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `responded` int(11) DEFAULT NULL,
  PRIMARY KEY (`iid`),
  KEY `cid_from` (`cid_from`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE IF NOT EXISTS `organization` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  PRIMARY KEY (`oid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `other_contribution`
--

CREATE TABLE IF NOT EXISTS `other_contribution` (
  `ocid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `occid` int(11) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`ocid`),
  KEY `occid` (`occid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `other_contribution_cat`
--

CREATE TABLE IF NOT EXISTS `other_contribution_cat` (
  `occid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`occid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE IF NOT EXISTS `university` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `initials` varchar(10) NOT NULL,
  `website` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`uid`, `name`, `initials`, `website`) VALUES
(1, 'Technical University of Mombasa', 'TUM', NULL),
(2, 'Pwani University College', '', NULL),
(3, 'Mombasa Technical Training Institute', '', NULL),
(4, 'Shanzu TTC', '', NULL),
(5, 'Mombasa Aviation College', '', NULL),
(6, 'Christian Industrial Technical College', '', NULL),
(7, 'Government Training Institute Mombasa', '', NULL),
(8, 'NYS Mombasa', '', NULL),
(9, 'Baraton University of East Africa', '', NULL),
(10, 'Baraton Teachers’ Training College', '', NULL),
(11, 'Kitale Technical Training Institute', '', NULL),
(12, 'University of Eldoret', '', NULL),
(13, 'Rift Valley Technical Training Institute', '', NULL),
(14, 'Alphax College', '', NULL),
(15, 'Eldoret Polytechnic', '', NULL),
(16, 'Kabarak University', '', NULL),
(17, 'Dairy Training Institute Naivasha', '', NULL),
(18, 'Machakos University College', '', NULL),
(19, 'Nakuru MTC', '', NULL),
(20, 'Comboni Polytechnic', '', NULL),
(21, 'Rift Valley Institute of Science and Technology', '', NULL),
(22, 'Kenya Industrial Training Institute', '', NULL),
(23, 'PCEA', 'PCEA', NULL),
(24, 'Nyandarua Institute of Science & Technology', '', NULL),
(25, 'Maasai Mara University', '', NULL),
(26, 'Visions Institute', '', NULL),
(27, 'AHITI', '', NULL),
(28, 'Kabarak TTC', '', NULL),
(29, 'Kagumo Teachers College', '', NULL),
(30, 'Kimathi University', '', NULL),
(31, 'Nyeri Technical Training Institute', '', NULL),
(32, 'Tumutumu School of Nursing', '', NULL),
(33, 'Chuka University', '', NULL),
(34, 'Mathenge Technical Training Institute', '', NULL),
(35, 'Rware College of Accountancy', '', NULL),
(36, 'Othaya Teachers College', '', NULL),
(37, 'Ark School of Professionals', '', NULL),
(38, 'Kamwenja TTC', '', NULL),
(39, 'Meru University', '', NULL),
(40, 'Karatina University', '', NULL),
(41, 'Outspan Medical School', '', NULL),
(42, 'Chogoria School of Nursing', '', NULL),
(43, 'Embu University College', '', NULL),
(44, 'Embu College of Technology', '', NULL),
(45, 'Bukura Agricultural College', '', NULL),
(46, 'Kisumu Polytechnic', '', NULL),
(47, 'Gusii Institute of Technology', '', NULL),
(48, 'Sigalagala Polytechnic', '', NULL),
(49, 'St Mary’s School of Clinical Medicine - Mumias', '', NULL),
(50, 'Kisii University', '', NULL),
(51, 'Moi Institute of Technology - Rongo', '', NULL),
(52, 'Kibabii Diploma Teachers Training College', '', NULL),
(53, 'Jaramogi Oginga Odinga University of Science and Technology', '', NULL),
(54, 'Rongo University College', '', NULL),
(55, 'Kibabii University College', '', NULL),
(56, 'Sangalo Technical Training Institute', '', NULL),
(57, 'Kiambu Institute of Science & Technology', 'KIST', NULL),
(58, 'Kenya Technical Teachers College', 'KTTC', NULL),
(59, 'Kenya Utalii College', '', NULL),
(62, 'Kenya Institute of Special Education', '', NULL),
(63, 'South Eastern University College', '', NULL),
(64, 'St. Paul’s University', '', NULL),
(65, 'Technical University of Kenya', '', NULL),
(66, 'Cooperative University College', '', NULL),
(67, 'Kabete Technical Training Institute', '', NULL),
(68, 'Tangaza College (CUEA)', '', NULL),
(69, 'Kenya School of Law', '', NULL),
(70, 'Multi Media University', '', NULL),
(71, 'Kabianga University', '', NULL),
(72, 'Masinde Muliro University of Science and Technology', 'MMUST', NULL),
(73, 'Egerton University', '', NULL),
(74, 'Great Lakes University', '', NULL),
(75, 'Moi University', '', NULL),
(76, 'Kenya Medical Training College', 'KMTC', NULL),
(77, 'Maseno University', '', NULL),
(78, 'Pan African Christian University', 'PACU', NULL),
(79, 'Daystar University', '', NULL),
(80, 'Kenyatta University', '', NULL),
(81, 'Kenya Methodist University', 'KEMU', NULL),
(82, 'Jomo Kenyatta University of Agriculture and Technology', 'JKUAT', NULL),
(83, 'Mt. Kenya University', 'MKU', NULL),
(84, 'Laikipia University', '', NULL),
(85, 'University of Nairobi', 'UoN', NULL),
(86, 'KCA University', '', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `champion`
--
ALTER TABLE `champion`
  ADD CONSTRAINT `champion_ibfk_1` FOREIGN KEY (`cuid`) REFERENCES `cu` (`cuid`),
  ADD CONSTRAINT `champion_ibfk_2` FOREIGN KEY (`atid`) REFERENCES `affiliation_type` (`atid`);

--
-- Constraints for table `cu`
--
ALTER TABLE `cu`
  ADD CONSTRAINT `cu_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `university` (`uid`);

--
-- Constraints for table `invite`
--
ALTER TABLE `invite`
  ADD CONSTRAINT `invite_ibfk_1` FOREIGN KEY (`cid_from`) REFERENCES `champion` (`cid`);

--
-- Constraints for table `organization`
--
ALTER TABLE `organization`
  ADD CONSTRAINT `organization_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `champion` (`cid`);

--
-- Constraints for table `other_contribution`
--
ALTER TABLE `other_contribution`
  ADD CONSTRAINT `other_contribution_ibfk_1` FOREIGN KEY (`occid`) REFERENCES `other_contribution_cat` (`occid`),
  ADD CONSTRAINT `other_contribution_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `champion` (`cid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
