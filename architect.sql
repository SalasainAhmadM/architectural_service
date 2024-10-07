-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 19, 2022 at 01:39 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `archi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`aemail`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aemail`, `apassword`) VALUES
('admin@archi.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `appoid` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(10) DEFAULT NULL,
  `apponum` int(3) DEFAULT NULL,
  `scheduleid` int(10) DEFAULT NULL,
  `appodate` date DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Initiation',
  `pay_status` varchar(50) DEFAULT 'Pay Remaining Payment Now',
  `project_sent` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`appoid`),
  KEY `client_id` (`client_id`),
  KEY `scheduleid` (`scheduleid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoid`, `client_id`, `apponum`, `scheduleid`, `appodate` ,`status` ,`pay_status` , `project_sent`) VALUES
(1, 1, 1, 1, '2022-06-03', 'Started' , 'Pay Remaining Payment Now', 0);

-- --------------------------------------------------------

--
-- Table structure for table `architect`
--

DROP TABLE IF EXISTS `architect`;
CREATE TABLE IF NOT EXISTS `architect` (
  `archiid` int(11) NOT NULL AUTO_INCREMENT,
  `archiemail` varchar(255) DEFAULT NULL,
  `archiname` varchar(255) DEFAULT NULL,
  `archipassword` varchar(255) DEFAULT NULL,
  `architel` varchar(15) DEFAULT NULL,
  `archiaddress` varchar(255) DEFAULT NULL,
  `specialties` int(2) DEFAULT NULL,
  `archi_image` varchar(255) DEFAULT NULL, 
  `fb_link` VARCHAR(255) DEFAULT NULL,
  `ig_link` VARCHAR(255) DEFAULT NULL,
  `twitter_link` VARCHAR(255) DEFAULT NULL,
  `linkedin_link` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`archiid`),
  KEY `specialties` (`specialties`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `architect`
--

INSERT INTO `architect` (`archiid`, `archiemail`, `archiname`, `archipassword`, `architel`, `archiaddress`,`specialties`, `archi_image`, `fb_link`, `ig_link`, `twitter_link`, `linkedin_link`) VALUES
(1, 'architect@archi.com', 'Gong Yoo', '123', '09551068322','Zamboanga City', 1, './img/archi.jpg', 'https://www.facebook.com/','https://www.instagram.com/','https://www.twitter.com/', 'https://www.linkedin.com/');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_email` varchar(255) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_password` varchar(255) DEFAULT NULL,
  `client_address` varchar(255) DEFAULT NULL,
  `client_dob` date DEFAULT NULL,
  `client_tel` varchar(15) DEFAULT NULL,
  `client_image` varchar(255) DEFAULT NULL, 
  PRIMARY KEY (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_email`, `client_name`, `client_password`, `client_address`, `client_dob`, `client_tel`) VALUES
(1, 'client@archi.com', 'Test Client', '123', 'Bugguk',  '2000-01-01', '0120000000'),
(2, 'nadzrin@gmail.com', 'Nadzrin Alhari', '123', 'Mariki',  '2022-06-03', '0700000000');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `feedback_message` text DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_image` varchar(255) DEFAULT NULL,
  `client_profession` varchar(255) DEFAULT NULL,
  `feedback_date` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`feedback_id`),
  FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Insert example data into `feedback`
INSERT INTO `feedback` (`client_id`, `feedback_message`, `client_name`,`client_image`, `client_profession`) VALUES
(1, 'Great service!', 'Test Client','user.png', 'Engineer'),
(2, 'Very satisfied with the project!', 'Nadzrin Alhari', 'user.png','Architect');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `scheduleid` int(11) NOT NULL AUTO_INCREMENT,
  `archiid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int(4) DEFAULT NULL,
  PRIMARY KEY (`scheduleid`),
  KEY `archiid` (`archiid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `archiid`, `title`, `cost`, `scheduledate`, `scheduletime`, `nop`) VALUES
(1, '1', 'Test Session', 60000.00, '2050-01-01', '18:00:00', 50),
(2, '1', '12',60000.00, '2022-06-10', '13:33:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

DROP TABLE IF EXISTS `specialties`;
CREATE TABLE IF NOT EXISTS `specialties` (
  `id` int(2) NOT NULL,
  `sname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`id`, `sname`) VALUES
(1, 'Restaurants'),
(2, 'Mall'),
(3, 'House');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

DROP TABLE IF EXISTS `webuser`;
CREATE TABLE IF NOT EXISTS `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@archi.com', 'a'),
('architect@archi.com', 'd'),
('client@archi.com', 'p'),
('nadzrin@gmail.com', 'p');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

DROP TABLE IF EXISTS `portfolio`;
CREATE TABLE IF NOT EXISTS `portfolio` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `archiid` int(11) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `project_description` text DEFAULT NULL,
  `project_client` varchar(255) DEFAULT NULL,
  `project_enddate` date DEFAULT NULL,
  `project_startdate` date DEFAULT NULL,
  `project_image` varchar(255) DEFAULT NULL,
  `project_cost` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`project_id`),
  KEY `archiid` (`archiid`),
  CONSTRAINT `fk_archiid` FOREIGN KEY (`archiid`) REFERENCES `architect` (`archiid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`archiid`, `project_name`, `project_description`, `project_client`, `project_enddate`, `project_startdate`, `project_image`, `project_cost`) VALUES
(1, 'Project 1', 'Description for Project 1', 'Maloi', '2023-01-01', '2022-01-01', 'archi.jpg', 60000.00),
(2, 'Project 2', 'Description for Project 2', 'Mikha', '2023-02-01', '2023-01-01','empty.png', 70000.00),
(3, 'Project 3', 'Description for Project 3', 'Aiah', '2024-01-01', '2022-05-01','1.jpg', 55000.00),
(4, 'Project 4', 'Description for Project 4', 'Jhoana', '2025-01-01', '2024-01-01','2.jpg', 80000.00);

-- --------------------------------------------------------

--
-- Table structure for table `finished_project`
--

DROP TABLE IF EXISTS `finished_project`;
CREATE TABLE IF NOT EXISTS `finished_project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `archiid` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `project_description` text DEFAULT NULL,
  `project_client` varchar(255) DEFAULT NULL,
  `project_enddate` date DEFAULT NULL,
  `project_startdate` date DEFAULT NULL,
  `project_image` varchar(255) DEFAULT NULL,
  `project_cost` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`project_id`),
  KEY `archiid` (`archiid`),
  CONSTRAINT `fk_archiid` FOREIGN KEY (`archiid`) REFERENCES `architect` (`archiid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finished_project`
--

INSERT INTO `finished_project` (`archiid`, `client_id`, `project_name`, `project_description`, `project_client`, `project_enddate`, `project_startdate`, `project_image`, `project_cost`) 
VALUES (1, 1, 'Finished Project', 'Description for Finished Project', 'Test Client', '2025-01-01', '2024-12-01', '2.jpg', 80000.00);


-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `archiid` int(11) NOT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `service_description` text DEFAULT NULL,
  `service_date` date DEFAULT NULL,
  `service_image` varchar(255) DEFAULT NULL,
  `service_cost` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`service_id`),
  KEY `archiid` (`archiid`),
  CONSTRAINT `fk_archiid` FOREIGN KEY (`archiid`) REFERENCES `architect` (`archiid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`archiid`, `service_name`, `service_description`, `service_date`, `service_image`, `service_cost`) VALUES
(1, 'Service 1', 'Description for Service 1', '2022-01-01', 'archi.jpg', 60000.00),
(2, 'Service 2', 'Description for Service 2', '2022-02-01', 'empty.png', 70000.00),
(3, 'Service 3', 'Description for Service 3', '2022-02-01', '1.jpg', 55000.00),
(4, 'Service 4', 'Description for Service 4', '2022-02-01', '2.jpg', 80000.00);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `social_media_1` varchar(255) DEFAULT NULL,
  `social_media_2` varchar(255) DEFAULT NULL,
  `social_media_3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`team_id`),
  KEY `admin_email` (`admin_email`),
  CONSTRAINT `fk_admin_email` FOREIGN KEY (`admin_email`) REFERENCES `admin`(`aemail`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`admin_email`, `name`, `role`, `profile_image`, `social_media_1`, `social_media_2`, `social_media_3`) VALUES
('admin@archi.com', 'Nadzrin Alhari', 'Project Manager', '1.jpg', 'https://twitter.com/1', 'https://instagram.com/1', 'https://facebook.com/1'),
('admin@archi.com', 'Farhan Madisan', 'Frontend Developer', '1.jpg', 'https://twitter.com/2', 'https://instagram.com/2', 'https://facebook.com/2'),
('admin@archi.com', 'Absar Sappari', 'Backend Developer', '1.jpg', 'https://twitter.com/3', 'https://instagram.com/3', 'https://facebook.com/3'),
('admin@archi.com', 'Bhen Sansawi', 'Business Analyst', '1.jpg', 'https://twitter.com/4', 'https://instagram.com/4', 'https://facebook.com/4');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
    `message_id` INT AUTO_INCREMENT PRIMARY KEY,
    `sender_id` INT NOT NULL,
    `receiver_id` INT NOT NULL,
    `message` TEXT NOT NULL,
    `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`sender_id`) REFERENCES `architect`(`archiid`),
    FOREIGN KEY (`receiver_id`) REFERENCES `client`(`client_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- No data to insert for table `messages` since it will be populated dynamically

-- --------------------------------------------------------

-- New Table: about
DROP TABLE IF EXISTS `about`;
CREATE TABLE IF NOT EXISTS `about` (
  `about_id` int(11) NOT NULL AUTO_INCREMENT,
  `archiid` int(11) NOT NULL,
  `about_description` text DEFAULT NULL,
  `about_image` varchar(255) DEFAULT NULL,
  `service_1` varchar(255) DEFAULT NULL,
  `service_2` varchar(255) DEFAULT NULL,
  `service_3` varchar(255) DEFAULT NULL,
  `service_4` varchar(255) DEFAULT NULL,
  `service_icon1` varchar(255) DEFAULT NULL,
  `service_icon2` varchar(255) DEFAULT NULL,
  `service_icon3` varchar(255) DEFAULT NULL,
  `service_icon4` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`about_id`),
  FOREIGN KEY (`archiid`) REFERENCES `architect` (`archiid`) ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Insert example data into `about`
INSERT INTO `about` (`archiid`, `about_description`, `about_image`,`service_1`,`service_2`,`service_3`,`service_4`,`service_icon1`,`service_icon2`,`service_icon3`,`service_icon4` ) VALUES
(1, 'This is a sample description about the architect.', '3.jpg', 'Service 1', 'Service 2','Service 3','Service 4', 'fa fa-user-check','fa fa-check','fa fa-drafting-compass','fa fa-headphones');

-- --------------------------------------------------------

-- New Table: chooseus
DROP TABLE IF EXISTS `chooseus`;
CREATE TABLE IF NOT EXISTS `chooseus` (
  `chooseus_id` int(11) NOT NULL AUTO_INCREMENT,
  `archiid` int(11) NOT NULL,
  `chooseus_description` text DEFAULT NULL,
  `chooseus_image` varchar(255) DEFAULT NULL,
  `feature_1` varchar(255) DEFAULT NULL,
  `feature_2` varchar(255) DEFAULT NULL,
  `feature_3` varchar(255) DEFAULT NULL,
  `feature_4` varchar(255) DEFAULT NULL,
  `featuretitle_1` varchar(255) DEFAULT NULL,
  `featuretitle_2` varchar(255) DEFAULT NULL,
  `featuretitle_3` varchar(255) DEFAULT NULL,
  `featuretitle_4` varchar(255) DEFAULT NULL,
  `feature_icon1` varchar(255) DEFAULT NULL,
  `feature_icon2` varchar(255) DEFAULT NULL,
  `feature_icon3` varchar(255) DEFAULT NULL,
  `feature_icon4` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`chooseus_id`),
  FOREIGN KEY (`archiid`) REFERENCES `architect` (`archiid`) ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Insert example data into `chooseus`
INSERT INTO `chooseus` (`archiid`, `chooseus_description`, `chooseus_image`,`feature_1`,`feature_2`,`feature_3`,`feature_4`,`featuretitle_1`,`featuretitle_2`,`featuretitle_3`,`featuretitle_4`,`feature_icon1`,`feature_icon2`,`feature_icon3`,`feature_icon4` ) VALUES
(1, 'This is a sample description about the architect.', '3.jpg', 'Quality', 'Free','Creative','Customer','Services', 'Consultation','Designs','Support', 'fa fa-user-check','fa fa-check','fa fa-drafting-compass','fa fa-headphones');

-- --------------------------------------------------------

-- New Table: carousel
DROP TABLE IF EXISTS `carousel`;
CREATE TABLE IF NOT EXISTS `carousel` (
  `carousel_id` int(11) NOT NULL AUTO_INCREMENT,
  `archiid` int(11) NOT NULL,
  `carousel_image1` varchar(255) DEFAULT NULL,
  `carousel_image2` varchar(255) DEFAULT NULL,
  `carousel_image3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`carousel_id`),
  FOREIGN KEY (`archiid`) REFERENCES `architect` (`archiid`) ON DELETE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Insert example data into `carousel`
INSERT INTO `carousel` (`archiid`,`carousel_image1`,`carousel_image2`,`carousel_image3` ) VALUES
(1,'bg1.jpg','bg2.jpg','bg3.jpg');

-- Existing tables and schema continuation...

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
