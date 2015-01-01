-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2015 at 11:06 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `focuschampions`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`aid` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `affiliation_type`
--

CREATE TABLE IF NOT EXISTS `affiliation_type` (
`atid` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `champion`
--

CREATE TABLE IF NOT EXISTS `champion` (
`cid` int(11) NOT NULL,
  `cuid` int(11) DEFAULT NULL,
  `atid` int(11) DEFAULT NULL,
  `grad_year` year(4) NOT NULL,
  `title` varchar(20) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `marital_status` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `phone_alt` varchar(20) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `url_fb` varchar(100) DEFAULT NULL,
  `url_tw` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `in_cu` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `champion_log`
--

CREATE TABLE IF NOT EXISTS `champion_log` (
`clid` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `value_int` int(11) DEFAULT NULL,
  `value_text` varchar(200) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cid` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commitment`
--

CREATE TABLE IF NOT EXISTS `commitment` (
`cmid` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `ctid` int(11) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `lifetime` int(11) DEFAULT NULL,
  `amount` decimal(10,0) NOT NULL,
  `current_supporter` int(11) NOT NULL,
  `payment_mode` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commitment_type`
--

CREATE TABLE IF NOT EXISTS `commitment_type` (
`ctid` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commit_later`
--

CREATE TABLE IF NOT EXISTS `commit_later` (
`clid` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `reminder_date` date DEFAULT NULL,
  `reminded` int(11) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cu`
--

CREATE TABLE IF NOT EXISTS `cu` (
`cuid` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `uid` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
`fid` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `feedback` text,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invite`
--

CREATE TABLE IF NOT EXISTS `invite` (
`iid` int(11) NOT NULL,
  `cid_from` int(11) DEFAULT NULL,
  `cid_to` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `responded` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE IF NOT EXISTS `organization` (
`oid` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `current` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `other_contribution`
--

CREATE TABLE IF NOT EXISTS `other_contribution` (
`ocid` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `occid` int(11) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `other_contribution_cat`
--

CREATE TABLE IF NOT EXISTS `other_contribution_cat` (
`occid` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE IF NOT EXISTS `university` (
`uid` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `initials` varchar(10) NOT NULL,
  `website` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`aid`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `affiliation_type`
--
ALTER TABLE `affiliation_type`
 ADD PRIMARY KEY (`atid`);

--
-- Indexes for table `champion`
--
ALTER TABLE `champion`
 ADD PRIMARY KEY (`cid`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `phone` (`phone`), ADD KEY `cuid` (`cuid`), ADD KEY `atid` (`atid`);

--
-- Indexes for table `champion_log`
--
ALTER TABLE `champion_log`
 ADD PRIMARY KEY (`clid`), ADD KEY `cid` (`cid`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `commitment`
--
ALTER TABLE `commitment`
 ADD PRIMARY KEY (`cmid`), ADD UNIQUE KEY `commit_ibfk_1` (`cid`);

--
-- Indexes for table `commitment_type`
--
ALTER TABLE `commitment_type`
 ADD PRIMARY KEY (`ctid`);

--
-- Indexes for table `commit_later`
--
ALTER TABLE `commit_later`
 ADD PRIMARY KEY (`clid`), ADD UNIQUE KEY `cid` (`cid`);

--
-- Indexes for table `cu`
--
ALTER TABLE `cu`
 ADD PRIMARY KEY (`cuid`), ADD KEY `uid` (`uid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
 ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `invite`
--
ALTER TABLE `invite`
 ADD PRIMARY KEY (`iid`), ADD KEY `cid_from` (`cid_from`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
 ADD PRIMARY KEY (`oid`), ADD KEY `cid` (`cid`);

--
-- Indexes for table `other_contribution`
--
ALTER TABLE `other_contribution`
 ADD PRIMARY KEY (`ocid`), ADD KEY `occid` (`occid`), ADD KEY `cid` (`cid`);

--
-- Indexes for table `other_contribution_cat`
--
ALTER TABLE `other_contribution_cat`
 ADD PRIMARY KEY (`occid`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
 ADD PRIMARY KEY (`uid`), ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `affiliation_type`
--
ALTER TABLE `affiliation_type`
MODIFY `atid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `champion`
--
ALTER TABLE `champion`
MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `champion_log`
--
ALTER TABLE `champion_log`
MODIFY `clid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `commitment`
--
ALTER TABLE `commitment`
MODIFY `cmid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `commitment_type`
--
ALTER TABLE `commitment_type`
MODIFY `ctid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `commit_later`
--
ALTER TABLE `commit_later`
MODIFY `clid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cu`
--
ALTER TABLE `cu`
MODIFY `cuid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=147;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invite`
--
ALTER TABLE `invite`
MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `other_contribution`
--
ALTER TABLE `other_contribution`
MODIFY `ocid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `other_contribution_cat`
--
ALTER TABLE `other_contribution_cat`
MODIFY `occid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=88;
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
-- Constraints for table `champion_log`
--
ALTER TABLE `champion_log`
ADD CONSTRAINT `champion_log_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `champion` (`cid`);

--
-- Constraints for table `commitment`
--
ALTER TABLE `commitment`
ADD CONSTRAINT `commit_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `champion` (`cid`);

--
-- Constraints for table `commit_later`
--
ALTER TABLE `commit_later`
ADD CONSTRAINT `commit_later_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `champion` (`cid`);

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
