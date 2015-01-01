-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2015 at 11:07 AM
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

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `email`, `username`, `password`) VALUES
(1, 'focus@beyon.de', 'FOCUS', '644c7646baa0d1c1798a3b2870b1a337');

--
-- Dumping data for table `affiliation_type`
--

INSERT INTO `affiliation_type` (`atid`, `name`) VALUES
(1, 'Associate'),
(2, 'Current Member'),
(3, 'Other');

--
-- Dumping data for table `commitment_type`
--

INSERT INTO `commitment_type` (`ctid`, `name`, `description`) VALUES
(1, 'One-off', NULL),
(2, 'Monthly', NULL),
(3, 'Quarterly', NULL),
(4, 'Bi-annually', NULL),
(5, 'Yearly', NULL);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
