-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2015 at 02:15 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `CODEBASE`
--

-- --------------------------------------------------------

--
-- Table structure for table `USER_MASTER`
--

CREATE TABLE IF NOT EXISTS `USER_MASTER` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `UserAccountID` int(50) NOT NULL,
  `UserTypeID` int(10) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Address` text NOT NULL,
  `MobileCode` varchar(3) NOT NULL,
  `MobileNumber` varchar(12) NOT NULL,
  `LandlineNumber` varchar(20) NOT NULL,
  `Fax` varchar(20) NOT NULL,
  `AccountCode` varchar(20) NOT NULL,
  `DateStamp` datetime NOT NULL,
  `ValidTill` datetime NOT NULL,
  `UpdatedDateStamp` datetime NOT NULL,
  `Comments` text NOT NULL,
  `Status` varchar(10) NOT NULL DEFAULT 'Enabled',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `USER_MASTER`
--

INSERT INTO `USER_MASTER` (`ID`, `UserAccountID`, `UserTypeID`, `Firstname`, `Lastname`, `Username`, `Password`, `Email`, `Address`, `MobileCode`, `MobileNumber`, `LandlineNumber`, `Fax`, `AccountCode`, `DateStamp`, `ValidTill`, `UpdatedDateStamp`, `Comments`, `Status`) VALUES
(1, 1, 1, 'Administrator', '', 'admin', '0192023a7bbd73250516f069df18b500', 'admin@website.com', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Enabled'),
(2, 2, 5, 'Demo', '', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@website.com', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Enabled');

-- --------------------------------------------------------

--
-- Table structure for table `USER_TYPE`
--

CREATE TABLE IF NOT EXISTS `USER_TYPE` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `UserType` varchar(100) NOT NULL,
  `Description` text,
  `Status` varchar(10) NOT NULL DEFAULT 'Active',
  `DateStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `UpdatedDateStamp` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `USER_TYPE`
--

INSERT INTO `USER_TYPE` (`ID`, `UserType`, `Description`, `Status`, `DateStamp`, `UpdatedDateStamp`) VALUES
(1, 'Owner', 'Owner with full access', 'Active', '2014-04-23 10:51:42', '0000-00-00 00:00:00'),
(2, 'Super Admin', 'Super Admin', 'Active', '2014-06-22 04:55:47', '0000-00-00 00:00:00'),
(3, 'Administrator', 'Administrator with restricted access', 'Active', '2014-08-22 22:11:07', '0000-00-00 00:00:00'),
(4, 'Basic', 'Customer Access', 'Active', '2014-08-22 22:11:07', '0000-00-00 00:00:00'),
(5, 'Demo', 'Customer Access', 'Active', '2014-08-22 22:11:16', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
