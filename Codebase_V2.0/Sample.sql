-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 07, 2011 at 02:35 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `table1`
--

DROP TABLE IF EXISTS `TABLE1`;
CREATE TABLE IF NOT EXISTS `TABLE1` (
  `ID` int(8) NOT NULL AUTO_INCREMENT,
  `Tbox` varchar(100) NOT NULL,
  `Pword` varchar(100) NOT NULL,
  `Rad` varchar(100) NOT NULL,
  `Chec` varchar(100) NOT NULL,
  `Hid` datetime NOT NULL,
  `To_Date` datetime NOT NULL,
  `Texta` text NOT NULL,
  `Sel` int(100) NOT NULL,
  `Gender` char(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `table1`
--

INSERT INTO `TABLE1` (`ID`, `Tbox`, `Pword`, `Rad`, `Chec`, `Hid`, `To_Date`, `Texta`, `Sel`, `Gender`) VALUES
(1, 'Textbox', 'Pass', 'Male', 'yes', '2011-03-05 04:44:26', '2011-03-06 00:00:00', 'This is Textarea', 1, '1'),
(2, 'Textbox1', 'Pass1', 'FeMale', 'yes', '2011-03-05 05:25:15', '2011-03-31 08:00:00', 'This is second textarea', 2, '2'),
(3, 'Textbox2', 'Pass2', 'FeMale', '', '2011-03-05 00:00:00', '0000-00-00 00:00:00', 'THis is third textarea', 1, '2'),
(4, 'Textbox3', 'Pass3', 'FeMale', 'yes', '2011-03-06 02:44:45', '0000-00-00 00:00:00', 'This is test', 1, '2'),
(5, 'Textbox5', 'Text5', 'Male', 'yes', '2011-03-06 08:26:05', '0000-00-00 00:00:00', 'sdfsdf', 1, '1'),
(6, 'Textbox5', 'sdfsdfsd', 'Male', 'yes', '2011-03-06 08:26:05', '2011-03-06 08:00:00', 'sdfsdf', 1, '1'),
(7, 'Textbox5', 'fghfgh', 'Male', 'yes', '2011-03-06 08:26:05', '2011-03-06 08:00:00', 'sdfsdf', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

DROP TABLE IF EXISTS `USER_MASTER`;
CREATE TABLE IF NOT EXISTS `USER_MASTER` (
  `Firstname` varchar(50) DEFAULT NULL,
  `Lastname` varchar(50) DEFAULT NULL,
  `Username` varchar(20) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL,
  `User_Type_ID` int(10) DEFAULT NULL,
  `Account_ID` int(10) DEFAULT NULL,
  `E_Mail` varchar(180) DEFAULT NULL,
  `Alerts` varchar(2) DEFAULT '0',
  `Refresh` int(5) DEFAULT '90',
  `Map_Size` int(5) DEFAULT '1',
  `Map_API` varchar(255) DEFAULT NULL,
  `Created_On` varchar(20) DEFAULT NULL,
  `Valid_Till` varchar(20) DEFAULT NULL,
  `Icon_Set` varchar(20) DEFAULT 'set_1',
  `KlikoF` varchar(20) DEFAULT 'enabled',
  `KlikoAdmin` varchar(20) DEFAULT 'disabled'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `USER_MASTER`
--

INSERT INTO `USER_MASTER` (`Firstname`, `Lastname`, `Username`, `Password`, `Status`, `User_Type_ID`, `Account_ID`, `E_Mail`, `Alerts`, `Refresh`, `Map_Size`, `Map_API`, `Created_On`, `Valid_Till`, `Icon_Set`, `KlikoF`, `KlikoAdmin`) VALUES
('admin', 'admin', 'admin', 'admin123', 'Enabled', 6, 1, 'admin@gmail.com', '1', 180, 3, 'ceinfo', '29.09.2010', '', 'set_1', 'enabled', 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `USER_TYPE`
--

DROP TABLE IF EXISTS `USER_TYPE`;
CREATE TABLE IF NOT EXISTS `USER_TYPE` (
  `User_Type_ID` int(10) NOT NULL AUTO_INCREMENT,
  `User_Type` varchar(255) DEFAULT NULL,
  `User_Type_Description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`User_Type_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `USER_TYPE` (`User_Type_ID`, `User_Type`, `User_Type_Description`) VALUES
(1, 'Customer', 'Customer Access'),
(2, 'QC1', 'Restricted access'),
(3, 'QC2', 'Restricted access'),
(4, 'QC3', 'Restricted access'),
(5, 'Supervisor', 'Administrator with restricted access'),
(6, 'Super Admin', 'Administrator with full access'),
(7, 'Manufacturer', 'Restricted Access');
