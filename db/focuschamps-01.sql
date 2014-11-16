-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2014 at 11:58 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `email`, `username`, `password`) VALUES
(1, 'focus@beyon.de', 'FOCUS', '644c7646baa0d1c1798a3b2870b1a337');

-- --------------------------------------------------------

--
-- Table structure for table `affiliation_type`
--

CREATE TABLE IF NOT EXISTS `affiliation_type` (
  `atid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`atid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `affiliation_type`
--

INSERT INTO `affiliation_type` (`atid`, `name`) VALUES
(1, 'Associate'),
(2, 'Current Member'),
(3, 'Spouse to Associate'),
(4, 'None');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `champion`
--

INSERT INTO `champion` (`cid`, `cuid`, `atid`, `grad_year`, `first_name`, `last_name`, `gender`, `email`, `phone`, `phone_alt`, `location`, `url`, `url_fb`, `url_tw`, `password`) VALUES
(2, 137, 1, 2012, 'Anthony', 'Nandaa', 'Male', 'prof@nandaa.com', '0728590438', NULL, NULL, NULL, NULL, NULL, '1f32aa4c9a1d2ea010adcf2348166a04');

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
('9f4d83012f92f8df5a4345b2c021db78', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 1416178626, 'a:17:{s:9:"user_data";s:0:"";s:3:"cid";s:1:"2";s:4:"cuid";s:3:"137";s:4:"atid";s:1:"1";s:9:"grad_year";s:4:"2012";s:10:"first_name";s:7:"Anthony";s:9:"last_name";s:6:"Nandaa";s:6:"gender";s:4:"Male";s:5:"email";s:15:"prof@nandaa.com";s:5:"phone";s:10:"0728590438";s:9:"phone_alt";N;s:8:"location";N;s:3:"url";N;s:6:"url_fb";N;s:6:"url_tw";N;s:8:"password";s:32:"1f32aa4c9a1d2ea010adcf2348166a04";s:9:"logged_in";b:1;}');

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
  `email` varchar(50) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`cuid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=147 ;

--
-- Dumping data for table `cu`
--

INSERT INTO `cu` (`cuid`, `name`, `website`, `email`, `uid`) VALUES
(1, 'Main Campus', 'http://www.mccuon.org', 'info@mccuon.org', 85),
(2, 'Technical University of Mombasa', '', '', 1),
(3, 'Pwani University College', '', '', 2),
(4, 'Mombasa Technical Training Institute', '', '', 3),
(5, 'Shanzu TTC', '', '', 4),
(6, 'Mombasa Aviation College', '', '', 5),
(7, 'Government Training Institute Mombasa', '', '', 7),
(8, 'NYS Mombasa', '', '', 8),
(9, 'Baraton University of East Africa', '', '', 9),
(10, 'Baraton Teachers’ Training College', '', '', 10),
(11, 'Kitale Technical Training Institute', '', '', 11),
(12, 'University of Eldoret', '', '', 12),
(13, 'Rift Valley Technical Training Institute', '', '', 21),
(14, 'Alphax College', '', '', 14),
(15, 'Eldoret Polytechnic', '', '', 15),
(16, 'Kabarak University', '', '', 28),
(17, 'Dairy Training Institute Naivasha', '', '', 17),
(18, 'Machakos University College', '', '', 18),
(19, 'Nakuru MTC', '', '', 19),
(20, 'Comboni Polytechnic', '', '', 20),
(21, 'Rift Valley Technical Training Institute', '', '', 13),
(22, 'Kenya Industrial Training Institute', '', '', 22),
(23, 'Nyandarua Institute of Science & Technology', '', '', 24),
(24, 'Maasai Mara University', '', '', 25),
(25, 'Shabab Campus', '', '', 23),
(26, 'Kikuyu Campus', '', '', 23),
(27, 'Ngara Campus', '', '', 26),
(28, 'City Square Campus', '', '', 26),
(29, 'Nyahururu Campus', '', '', 27),
(30, 'Kabete', '', '', 27),
(31, 'Kabarak TTC', '', '', 28),
(32, 'Kagumo Teachers College', '', '', 29),
(33, 'Kimathi University', '', '', 30),
(34, 'Nyeri Technical Training Institute', '', '', 31),
(35, 'Tumutumu School of Nursing', '', '', 32),
(36, 'Chuka University', '', '', 33),
(37, 'Mathenge Technical Training Institute', '', '', 34),
(38, 'Rware College of Accountancy', '', '', 35),
(40, 'Othaya Teachers College', '', '', 36),
(41, 'Ark School of Professionals', '', '', 37),
(42, 'Kamwenja TTC', '', '', 38),
(43, 'Meru University', '', '', 39),
(44, 'Main Campus', '', '', 40),
(45, 'Outspan Medical School', '', '', 41),
(46, 'Chogoria School of Nursing', '', '', 42),
(47, 'Embu University College', '', '', 43),
(48, 'Embu College of Technology', '', '', 44),
(49, 'Bukura Agricultural College', '', '', 45),
(50, 'Kisumu Polytechnic', '', '', 46),
(51, 'Gusii Institute of Technology', '', '', 47),
(52, 'Sigalagala Polytechnic', '', '', 48),
(53, 'St Mary’s School of Clinical Medicine Mumias', '', '', 49),
(54, 'Main Campus', '', '', 50),
(55, 'Moi Institute of Technology - Rongo', '', '', 51),
(56, 'Kibabii Diploma Teachers Training College', '', '', 52),
(57, 'Jaramogi Oginga Odinga University of Science and T', '', '', 53),
(58, 'Rongo University College', '', '', 54),
(59, 'Kibabii University College', '', '', 55),
(60, 'Sangalo Technical Training Institute', '', '', 56),
(61, 'Kiambu Institute of Science & Technology', '', '', 57),
(62, 'Kenya Technical Teachers College', '', '', 58),
(63, 'Kenya Utalii College', '', '', 59),
(64, 'Kenya Institute of Special Education', '', '', 62),
(65, 'South Eastern University College', '', '', 63),
(66, 'St. Paul’s University', '', '', 64),
(67, 'Technical University of Kenya', '', '', 65),
(68, 'Cooperative University College', '', '', 66),
(69, 'Kabete Technical Training Institute', '', '', 67),
(70, 'Tangaza College', '', '', 68),
(71, 'Kenya School of Law', '', '', 69),
(72, 'Multi Media University', '', '', 70),
(73, 'Main Campus', '', '', 71),
(74, 'Kapkatet Campus', '', '', 71),
(75, 'Main Campus', '', '', 72),
(76, 'Webuye Campus', '', '', 72),
(77, 'Njoro Campus', '', '', 73),
(78, 'Nakuru Town Campus', '', '', 73),
(79, 'Medical School', '', '', 73),
(80, 'Great Lakes University', '', '', 74),
(81, 'West Campus', '', '', 75),
(82, 'Main Campus', '', '', 75),
(83, 'Town Campus', '', '', 75),
(84, 'Annex Campus', '', '', 75),
(85, 'Kitale Campus', '', '', 75),
(86, 'Pioneer Campus', '', '', 75),
(87, 'Karatina Campus', '', '', 75),
(88, 'Kericho Town Campus', '', '', 75),
(89, 'Odero Okang’o Campus', '', '', 75),
(90, 'City Campus', '', '', 75),
(91, 'Mombasa', '', '', 76),
(92, 'Portreitz', '', '', 76),
(93, 'Msambweni', '', '', 76),
(94, 'Kilifi', '', '', 76),
(95, 'Eldoret', '', '', 76),
(96, 'Kapsowar', '', '', 76),
(97, 'Nyeri', '', '', 76),
(98, 'Kisumu', '', '', 76),
(99, 'Kakamega', '', '', 76),
(100, 'Siaya', '', '', 76),
(101, 'Kisii', '', '', 76),
(102, 'Webuye', '', '', 76),
(103, 'Kapkatet', '', '', 76),
(104, 'Mumias', '', '', 76),
(105, 'Kitui', '', '', 76),
(106, 'School of Nutrition', '', '', 76),
(107, 'Machakos', '', '', 76),
(108, 'Maanza', '', '', 76),
(109, 'Main Campus', '', '', 77),
(110, 'Main Campus', '', '', 78),
(111, 'Mombasa Campus', '', '', 79),
(112, 'Athi River Campus', '', '', 79),
(113, 'Valley Road Campus', '', '', 79),
(114, 'Mombasa Campus', '', '', 80),
(115, 'Nyeri Campus', '', '', 80),
(116, 'Main Campus', '', '', 80),
(117, 'Ruiru Campus', '', '', 80),
(118, 'Kitui Campus', '', '', 80),
(119, 'Parklands Campus', '', '', 80),
(120, 'Mombasa Campus', '', '', 81),
(121, 'Nakuru', '', '', 81),
(122, 'Main Campus', '', '', 81),
(123, 'Nairobi Campus', '', '', 81),
(124, 'Taita Taveta Campus', '', '', 82),
(125, 'Main Campus', '', '', 82),
(126, 'Karen Campus', '', '', 82),
(127, 'Eldoret Campus', '', '', 83),
(128, 'Kitale Campus', '', '', 83),
(129, 'Nakuru Town Campus', '', '', 83),
(130, 'City Campus', '', '', 83),
(131, 'Main Campus', '', '', 84),
(132, 'Nyahururu Campus', '', '', 84),
(133, 'Nakuru Town Campus', '', '', 84),
(134, 'Mombasa Campus', '', '', 85),
(135, 'Lower Kabete Campus', '', '', 85),
(136, 'Parklands Campus', '', '', 85),
(137, 'Main Campus', '', '', 85),
(138, 'Chiromo Campus', '', '', 85),
(139, 'Kikuyu Campus', '', '', 85),
(140, 'Kenya Science Campus', '', '', 85),
(141, 'Medical School Campus', '', '', 85),
(142, 'Upper Kabete Campus', '', '', 85),
(143, 'Kisumu Campus', '', '', 86),
(146, ' None', '', '', 87);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

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
(86, 'KCA University', '', NULL),
(87, ' None', '', NULL);

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
