-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2022 at 09:07 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `brickgame`
--

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`pid`, `rid`, `score`, `date`) VALUES
(1, 2, 50, '2022-12-26'),
(2, 2, 14, '2022-12-26'),
(3, 2, 1, '2022-12-26'),
(4, 2, 2, '2022-12-26'),
(5, 1, 21, '2022-12-26'),
(6, 1, 55, '2022-12-26'),
(7, 1, 44, '2022-12-26'),
(8, 3, 13, '2022-12-26'),
(9, 3, 10, '2022-12-26'),
(10, 3, 10, '2022-12-26'),
(11, 3, 24, '2022-12-26'),
(12, 3, 14, '2022-12-26'),
(13, 3, 23, '2022-12-26'),
(14, 3, 23, '2022-12-26'),
(15, 4, 23, '2022-12-26'),
(16, 4, 19, '2022-12-26'),
(17, 4, 16, '2022-12-26'),
(18, 5, 8, '2022-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `score` int(11) DEFAULT '0',
  `status` varchar(20) DEFAULT 'Active',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`rid`, `name`, `email`, `phone`, `dob`, `password`, `score`, `status`) VALUES
(1, 'AK', 'ak@mail.com', '9090909090', '1998-09-10', 'AMV', 55, 'Active'),
(2, 'aswin', 'aswin@gmail.com', '8606126630', '2017-11-17', 'aswin', 50, 'Active'),
(3, 'Anat', 'anat@gmail.com', '8535362455', '2022-12-15', 'anat', 24, 'Active'),
(4, 'jeena', 'jeena@mail.com', '987654328', '2010-02-14', '1234', 23, 'Active'),
(5, 'CH', 'ch@mail.com', '8989898989', '1998-10-10', '1234', 8, 'Active');
