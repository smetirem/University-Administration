-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 23, 2021 at 10:13 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moumoulidou`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int(11) NOT NULL,
  `title` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `semester` enum('1','2','3','4') COLLATE utf8_unicode_ci NOT NULL,
  `ecp` int(2) NOT NULL,
  `user_tc` int(10) NOT NULL,
  UNIQUE KEY `course_id` (`course_id`,`user_tc`) USING BTREE,
  KEY `use_tc` (`user_tc`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `title`, `type`, `description`, `semester`, `ecp`, `user_tc`) VALUES
(1, 'Μαθηματικά', 'Επιλογής', 'Περιγραφή 1', '1', 25, 57),
(2, 'Φυσική', 'Υποχρεωτικό', 'Περιγραφή 2', '2', 22, 57),
(3, ' Χημεία ', 'Επιλογής', ' Περιγραφή 3 ', '3', 10, 51),
(4, 'Πληροφορική', 'Υποχρεωτικό', 'Περιγραφή 4', '4', 20, 58);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

DROP TABLE IF EXISTS `enrollment`;
CREATE TABLE IF NOT EXISTS `enrollment` (
  `enrollment_id` int(10) NOT NULL AUTO_INCREMENT,
  `grade` int(2) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_fk` int(10) NOT NULL,
  `course_fk` int(11) NOT NULL,
  PRIMARY KEY (`enrollment_id`),
  KEY `user_fk` (`user_fk`),
  KEY `course_fk` (`course_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enrollment_id`, `grade`, `status`, `user_fk`, `course_fk`) VALUES
(3, 8, 'Ολοκληρωμένο', 3, 2),
(5, 9, 'Ολοκληρωμένο', 6, 3),
(6, 5, 'Ολοκληρωμένο', 9, 2),
(7, 5, ' Ολοκληρωμένο ', 4, 1),
(8, 4, ' Σε Εξέλιξη ', 9, 1),
(9, 0, 'Σε Εξέλιξη', 6, 2),
(10, 0, 'Σε Εξέλιξη', 3, 1),
(11, 5, ' Σε Εξέλιξη ', 8, 1),
(12, NULL, 'Σε εξέλιξη', 62, 3);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
CREATE TABLE IF NOT EXISTS `semester` (
  `semester_id` int(2) NOT NULL,
  `semester` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_fk` int(10) NOT NULL,
  PRIMARY KEY (`semester_id`,`user_fk`),
  KEY `user_fk` (`user_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester`, `user_fk`) VALUES
(1, '1', 7),
(2, '2', 3),
(3, '3', 4),
(4, '3', 6),
(5, '5', 8),
(6, '6', 9),
(8, '8', 62);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` int(14) DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registry` int(15) NOT NULL,
  `registration_date` date NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password` (`password`),
  UNIQUE KEY `registry` (`registry`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `last_name`, `email`, `password`, `role`, `mobile`, `address`, `registry`, `registration_date`) VALUES
(3, 'Κωνσταντίνος', 'Καρράς ', 'kk@eap.gr', '11111111', 'Φοιτητής', 695847125, 'Διεύθυνση 1', 1111, '2021-02-25'),
(4, 'Μάριος', 'Αλευράς', 'aa@eap.gr', '22222222', 'Φοιτητής', 693214568, '  Διεύθυνση 2  ', 2222, '2021-02-25'),
(6, 'Μαρία', 'Κρασά', 'mk@eap.gr', '33333333', 'Φοιτητής', 693214111, 'Διεύθυνση 3', 3333, '2021-02-25'),
(7, 'Αφροδίτη', 'Κουμέλη', 'ak@eap.gr', '44444444', 'Φοιτητής', 693241114, 'Διεύθυνση 4', 4444, '2021-02-25'),
(8, 'Μενέλαος', 'Ζώτος', 'mz@eap.gr', '55555555', 'Φοιτητής', 693994568, 'Διεύθυνση 5', 5555, '2021-02-25'),
(9, 'Ιωάννης', 'Γρίβας', 'ig@eap.gr', '66666666', 'Φοιτητής', 693214222, 'Διεύθυνση 6', 6666, '2021-02-25'),
(40, 'Αλέξανδρος', 'Παπασωτηρίου', 'ap@eap.gr', '77777777', 'Διδακτικό Προσωπικό', 695441267, 'Διεύθυνση 7', 7777, '2021-03-18'),
(51, 'Ευδοκία', 'Ρουμελιώτη', 'er@eap.gr', '88888888', 'Διδακτικό Προσωπικό', 695412367, 'Διεύθυνση 8', 8888, '2021-03-18'),
(56, 'Χαρίκλεια', 'Λαγουδάκη', 'xl@eap.gr ', '10110111', 'Γραμματεία', 693256521, '  Διεύθυνση 11  ', 1011, '2021-03-18'),
(57, 'Νικόλαος', 'Σταύρου', 'ns@eap.gr', '99999999', 'Διδακτικό Προσωπικό', 699652241, '   Διεύθυνση 9   ', 9999, '2021-03-18'),
(58, 'Χρυσή', 'Μαρκουλάκη', 'xm@eap.gr', '10101010', 'Διδακτικό Προσωπικό', 695412698, 'Διεύθυνση 10', 1010, '2021-03-18'),
(60, 'Ιωάννης', 'Προκοπίδης', 'pp@eap.gr', '10120222', 'Γραμματεία', 693256444, 'Διεύθυνση 12', 1012, '2021-03-18'),
(61, 'Ελένη', 'Καραριτάκη', 'eek@eap.gr', '10131313', 'Διδακτικό Προσωπικό', 693256554, 'Διεύθυνση 13', 1313, '2021-03-22'),
(62, 'Ευάγγελος', 'Παππάς', 'ep@eap.gr', ' 14141414 ', 'Φοιτητής', 697412554, ' Διεύθυνση 14 ', 1414, '2021-03-23');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`user_tc`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`user_fk`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`course_fk`) REFERENCES `courses` (`course_id`) ON UPDATE CASCADE;

--
-- Constraints for table `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `semester_ibfk_1` FOREIGN KEY (`user_fk`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
