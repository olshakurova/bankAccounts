-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2013 at 11:39 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `a1103474`
--
--
CREATE DATABASE IF NOT EXISTS `a1103474` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `a1103474`;
-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customerNumber` int(10) unsigned NOT NULL,
  `name` varchar(80) NOT NULL,
  `ssn` varchar(11) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `accountNumber` int(11) NOT NULL,
  `balance` decimal(10,0) NOT NULL,
  `accountType` enum('1','3','5') NOT NULL,
  `additionalInfo` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accountNumber` (`accountNumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `customerNumber`, `name`, `ssn`, `gender`, `accountNumber`, `balance`, `accountType`, `additionalInfo`) VALUES
(1, 1, ' Pekka Kemaja', '123456-1230', 'male', 0100002016, '2016', '3', 'Business'),
(2, 2, 'Ralf Rehnah', '123456-1231', 'male', 103005408, '5408', '5', 'Business Processes, Account 1'),
(3, 2, 'Ralf Rehnah', '123456-1231', 'male', 500014054, '14054', '1', 'Business Processes, Account 2'),
(4, 3, 'Kari Silpiho', '123456-1232', 'male', 200880147, '80147', '3', 'Databases'),
(5, 4, 'Tero Korvinen', '123456-1233', 'male', 400008548, '8548', '5', 'Linux');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
