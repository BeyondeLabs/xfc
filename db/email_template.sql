-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2015 at 07:27 PM
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
-- Table structure for table `email_template`
--

CREATE TABLE IF NOT EXISTS `email_template` (
`etid` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `html` text,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`etid`, `name`, `html`, `datetime`) VALUES
(1, 'default', '<html>\r\n<body>\r\n<table width="590" align="center" border="0" style="font-family: Helvetica, Arial, sans-serif;">\r\n<tr>\r\n	<td style="background:#cecece;color:#25408f;font-size:20px;padding:5px;font-weight:bold;border-bottom:solid 5px #c04d25;">\r\n		FOCUS <span style="color:#c04d25;">Champions</span>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td style="padding:10px 3px;color:#555;font-size:14px;line-height:18px;">\r\n		{body}\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td>\r\n<table width="590" cellspacing="0" cellpadding="0" border="0">\r\n							<tbody>\r\n								<tr>\r\n									<td width="590" valign="middle" height="5" style="background-color: #dbdbd9"></td>\r\n								</tr>\r\n								\r\n								<tr>\r\n									<td style="padding:5px 2px;">\r\n									<p style="font-size: 11px; line-height: 15px; font-family: Helvetica, Arial, sans-serif; color: #999999; margin: 0px 0px 10px 0">\r\n									FOCUS Champions &bull; A project of <a style="color: #336699; text-decoration: none" href="http://champions.focuskenya.org" target="_blank">Fellowship of Christian Unions (FOCUS) Kenya</a><br>\r\n									See our <a style="color: #336699; text-decoration: none" href="#" target="_blank">Privacy Policy</a> and <a style="color: #336699; text-decoration: none" href="#" target="_blank">Terms &amp; Conditions</a>.</p>\r\n\r\n									</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n	</td>\r\n</tr>\r\n\r\n</table>\r\n\r\n</body>\r\n</html>', '2015-01-03 17:47:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
 ADD PRIMARY KEY (`etid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
MODIFY `etid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
