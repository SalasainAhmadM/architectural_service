-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2025 at 05:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `about_id` int(11) NOT NULL,
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
  `service_icon4` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`about_id`, `archiid`, `about_description`, `about_image`, `service_1`, `service_2`, `service_3`, `service_4`, `service_icon1`, `service_icon2`, `service_icon3`, `service_icon4`) VALUES
(1, 1, 'This is a sample description about the architect.', '3.jpg', 'Service 1', 'Service 2', 'Service 3', 'Service 4', 'fa fa-user-check', 'fa fa-check', 'fa fa-drafting-compass', 'fa fa-headphones');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aemail`, `apassword`) VALUES
('admin@archi.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appoid` int(11) NOT NULL,
  `client_id` int(10) DEFAULT NULL,
  `apponum` int(3) DEFAULT NULL,
  `scheduleid` int(10) DEFAULT NULL,
  `appodate` date DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Initiation',
  `pay_status` varchar(50) DEFAULT 'Pay Remaining Payment Now',
  `project_sent` tinyint(1) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoid`, `client_id`, `apponum`, `scheduleid`, `appodate`, `status`, `pay_status`, `project_sent`) VALUES
(1, 1, 1, 1, '2022-06-03', 'Finalizing', 'Pay Remaining Payment Now', 0);

-- --------------------------------------------------------

--
-- Table structure for table `architect`
--

CREATE TABLE `architect` (
  `archiid` int(11) NOT NULL,
  `archiemail` varchar(255) DEFAULT NULL,
  `archiname` varchar(255) DEFAULT NULL,
  `archipassword` varchar(255) DEFAULT NULL,
  `architel` varchar(15) DEFAULT NULL,
  `archiaddress` varchar(255) DEFAULT NULL,
  `specialties` int(2) DEFAULT NULL,
  `archi_image` varchar(255) DEFAULT NULL,
  `fb_link` varchar(255) DEFAULT NULL,
  `ig_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `architect`
--

INSERT INTO `architect` (`archiid`, `archiemail`, `archiname`, `archipassword`, `architel`, `archiaddress`, `specialties`, `archi_image`, `fb_link`, `ig_link`, `twitter_link`, `linkedin_link`) VALUES
(1, 'architect@archi.com', 'Gong Yoo', '123', '09551068322', 'Zamboanga City', 1, '../uploads/archi.jpg', 'https://www.facebook.com/', 'https://www.instagram.com/', 'https://www.twitter.com/', 'https://www.linkedin.com/');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `carousel_id` int(11) NOT NULL,
  `archiid` int(11) NOT NULL,
  `carousel_image1` varchar(255) DEFAULT NULL,
  `carousel_image2` varchar(255) DEFAULT NULL,
  `carousel_image3` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`carousel_id`, `archiid`, `carousel_image1`, `carousel_image2`, `carousel_image3`) VALUES
(1, 1, 'bg1.jpg', 'bg2.jpg', 'bg3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `chooseus`
--

CREATE TABLE `chooseus` (
  `chooseus_id` int(11) NOT NULL,
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
  `feature_icon4` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `chooseus`
--

INSERT INTO `chooseus` (`chooseus_id`, `archiid`, `chooseus_description`, `chooseus_image`, `feature_1`, `feature_2`, `feature_3`, `feature_4`, `featuretitle_1`, `featuretitle_2`, `featuretitle_3`, `featuretitle_4`, `feature_icon1`, `feature_icon2`, `feature_icon3`, `feature_icon4`) VALUES
(1, 1, 'This is a sample description about the architect.', '3.jpg', 'Quality', 'Free', 'Creative', 'Customer', 'Services', 'Consultation', 'Designs', 'Support', 'fa fa-user-check', 'fa fa-check', 'fa fa-drafting-compass', 'fa fa-headphones');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_email` varchar(255) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_password` varchar(255) DEFAULT NULL,
  `client_address` varchar(255) DEFAULT NULL,
  `client_dob` date DEFAULT NULL,
  `client_tel` varchar(15) DEFAULT NULL,
  `client_image` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_email`, `client_name`, `client_password`, `client_address`, `client_dob`, `client_tel`, `client_image`) VALUES
(1, 'client@archi.com', 'Test Client', '123', 'Bugguk', '2000-01-01', '0120000000', NULL),
(2, 'nadzrin@gmail.com', 'Nadzrin Alhari', '123', 'Mariki', '2022-06-03', '0700000000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `feedback_message` text DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_image` varchar(255) DEFAULT NULL,
  `client_profession` varchar(255) DEFAULT NULL,
  `feedback_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `client_id`, `feedback_message`, `client_name`, `client_image`, `client_profession`, `feedback_date`) VALUES
(1, 1, 'Great service!', 'Test Client', 'user.png', 'Engineer', '2024-10-29 05:38:37'),
(2, 2, 'Very satisfied with the project!', 'Nadzrin Alhari', 'user.png', 'Architect', '2024-10-29 05:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `finished_project`
--

CREATE TABLE `finished_project` (
  `project_id` int(11) NOT NULL,
  `archiid` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `project_description` text DEFAULT NULL,
  `project_client` varchar(255) DEFAULT NULL,
  `project_enddate` date DEFAULT NULL,
  `project_startdate` date DEFAULT NULL,
  `project_image` varchar(255) DEFAULT NULL,
  `project_cost` decimal(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `finished_project`
--

INSERT INTO `finished_project` (`project_id`, `archiid`, `client_id`, `project_name`, `project_description`, `project_client`, `project_enddate`, `project_startdate`, `project_image`, `project_cost`) VALUES
(1, 1, 1, 'Finished Project', 'Description for Finished Project', 'Test Client', '2025-01-01', '2024-12-01', '2.jpg', 80000.00);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `sender_type` enum('architect','client') NOT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `receiver_id`, `message`, `timestamp`, `sender_type`, `is_read`) VALUES
(1, 1, 1, 'hi', '2025-01-18 16:24:30', 'architect', 1),
(2, 1, 1, 'hello', '2025-01-18 16:25:08', 'client', 0);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `project_id` int(11) NOT NULL,
  `archiid` int(11) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `project_description` text DEFAULT NULL,
  `project_client` varchar(255) DEFAULT NULL,
  `project_enddate` date DEFAULT NULL,
  `project_startdate` date DEFAULT NULL,
  `project_image` varchar(255) DEFAULT NULL,
  `project_cost` decimal(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`project_id`, `archiid`, `project_name`, `project_description`, `project_client`, `project_enddate`, `project_startdate`, `project_image`, `project_cost`) VALUES
(1, 1, 'Project 1', 'Description for Project 1', 'Maloi', '2023-01-01', '2022-01-01', 'archi.jpg', 60000.00),
(2, 2, 'Project 2', 'Description for Project 2', 'Mikha', '2023-02-01', '2023-01-01', 'empty.png', 70000.00),
(3, 3, 'Project 3', 'Description for Project 3', 'Aiah', '2024-01-01', '2022-05-01', '1.jpg', 55000.00),
(4, 4, 'Project 4', 'Description for Project 4', 'Jhoana', '2025-01-01', '2024-01-01', '2.jpg', 80000.00);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `service_id` int(11) NOT NULL,
  `archiid` int(11) NOT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `service_description` text DEFAULT NULL,
  `service_date` date DEFAULT NULL,
  `service_image` varchar(255) DEFAULT NULL,
  `service_cost` decimal(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`service_id`, `archiid`, `service_name`, `service_description`, `service_date`, `service_image`, `service_cost`) VALUES
(1, 1, 'Service 1', 'Description for Service 1', '2022-01-01', 'archi.jpg', 60000.00),
(2, 2, 'Service 2', 'Description for Service 2', '2022-02-01', 'empty.png', 70000.00),
(3, 3, 'Service 3', 'Description for Service 3', '2022-02-01', '1.jpg', 55000.00),
(4, 4, 'Service 4', 'Description for Service 4', '2022-02-01', '2.jpg', 80000.00);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleid` int(11) NOT NULL,
  `archiid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `archiid`, `title`, `cost`, `scheduledate`, `scheduletime`, `nop`) VALUES
(1, '1', 'Test Session', 60000.00, '2050-01-01', '18:00:00', 50),
(2, '1', '12', 60000.00, '2022-06-10', '13:33:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `id` int(2) NOT NULL,
  `sname` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`id`, `sname`) VALUES
(1, 'Restaurants'),
(2, 'Mall'),
(3, 'House');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `social_media_1` varchar(255) DEFAULT NULL,
  `social_media_2` varchar(255) DEFAULT NULL,
  `social_media_3` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `admin_email`, `name`, `role`, `profile_image`, `social_media_1`, `social_media_2`, `social_media_3`) VALUES
(1, 'admin@archi.com', 'Nadzrin Alhari', 'Project Manager', '1.jpg', 'https://twitter.com/1', 'https://instagram.com/1', 'https://facebook.com/1'),
(2, 'admin@archi.com', 'Farhan Madisan', 'Frontend Developer', '1.jpg', 'https://twitter.com/2', 'https://instagram.com/2', 'https://facebook.com/2'),
(3, 'admin@archi.com', 'Absar Sappari', 'Backend Developer', '1.jpg', 'https://twitter.com/3', 'https://instagram.com/3', 'https://facebook.com/3'),
(4, 'admin@archi.com', 'Bhen Sansawi', 'Business Analyst', '1.jpg', 'https://twitter.com/4', 'https://instagram.com/4', 'https://facebook.com/4');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

CREATE TABLE `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@archi.com', 'a'),
('architect@archi.com', 'd'),
('client@archi.com', 'p'),
('nadzrin@gmail.com', 'p');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`about_id`),
  ADD KEY `archiid` (`archiid`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aemail`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appoid`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `scheduleid` (`scheduleid`);

--
-- Indexes for table `architect`
--
ALTER TABLE `architect`
  ADD PRIMARY KEY (`archiid`),
  ADD KEY `specialties` (`specialties`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`carousel_id`),
  ADD KEY `archiid` (`archiid`);

--
-- Indexes for table `chooseus`
--
ALTER TABLE `chooseus`
  ADD PRIMARY KEY (`chooseus_id`),
  ADD KEY `archiid` (`archiid`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `finished_project`
--
ALTER TABLE `finished_project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `archiid` (`archiid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `archiid` (`archiid`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `archiid` (`archiid`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleid`),
  ADD KEY `archiid` (`archiid`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `admin_email` (`admin_email`);

--
-- Indexes for table `webuser`
--
ALTER TABLE `webuser`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `architect`
--
ALTER TABLE `architect`
  MODIFY `archiid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `carousel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chooseus`
--
ALTER TABLE `chooseus`
  MODIFY `chooseus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `finished_project`
--
ALTER TABLE `finished_project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
