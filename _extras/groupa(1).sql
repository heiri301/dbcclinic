-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 04:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `groupa`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appt_id` int(16) NOT NULL,
  `appt_uuid` varchar(16) NOT NULL,
  `appt_date` date NOT NULL,
  `appt_time` time NOT NULL,
  `appt_subject` varchar(36) NOT NULL,
  `appt_type` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `appt_notes` varchar(2048) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pid` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appt_id`, `appt_uuid`, `appt_date`, `appt_time`, `appt_subject`, `appt_type`, `appt_notes`, `pid`) VALUES
(38, '0257c1af', '2024-07-12', '21:21:00', 'test', '1', 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_attachments`
--

CREATE TABLE `appointment_attachments` (
  `appt_uuid` varchar(16) NOT NULL,
  `attachment_path` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_types`
--

CREATE TABLE `appointment_types` (
  `appt_type` int(16) NOT NULL,
  `appt_type_desc` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment_types`
--

INSERT INTO `appointment_types` (`appt_type`, `appt_type_desc`) VALUES
(1, 'visitation'),
(2, 'checkup'),
(3, 'admission'),
(4, 'other');

-- --------------------------------------------------------

--
-- Table structure for table `checkupdtails`
--

CREATE TABLE `checkupdtails` (
  `pid` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `diagnosis` text NOT NULL,
  `actiontaken` text NOT NULL,
  `prescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elistgen`
--

CREATE TABLE `elistgen` (
  `eid` int(11) NOT NULL,
  `scode` int(6) NOT NULL,
  `plan` text NOT NULL,
  `gradeyear` text NOT NULL,
  `section_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `Candidate_ID` int(8) NOT NULL,
  `Department` varchar(30) NOT NULL,
  `Course` varchar(30) NOT NULL,
  `Student_Type` varchar(30) NOT NULL,
  `Student_Status` varchar(10) NOT NULL,
  `assessment_status` int(11) NOT NULL,
  `processed_by` text NOT NULL,
  `sid` int(11) NOT NULL,
  `fyid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `healthdeclaration`
--

CREATE TABLE `healthdeclaration` (
  `date` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `temperature` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `illness`
--

CREATE TABLE `illness` (
  `disid` int(11) NOT NULL,
  `disease` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `illness`
--

INSERT INTO `illness` (`disid`, `disease`) VALUES
(1, 'Allergy - Food'),
(2, 'Allergy - Drugs'),
(3, 'Asthma'),
(4, 'Anemia'),
(5, 'Bleeding Problems'),
(6, 'Behavioral Problems'),
(7, 'Hearing Problems'),
(8, 'Speech Problems'),
(9, 'Visual Problems'),
(10, 'Recurrent Indigestion'),
(11, 'Jaundice'),
(12, 'Eating Disorder'),
(13, 'Chicken Pox');

-- --------------------------------------------------------

--
-- Table structure for table `medicalhistory`
--

CREATE TABLE `medicalhistory` (
  `pid` int(11) NOT NULL,
  `illno` int(11) NOT NULL,
  `relation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicinedosage`
--

CREATE TABLE `medicinedosage` (
  `pid` int(11) NOT NULL,
  `medication` text NOT NULL,
  `date` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `pid` int(11) NOT NULL,
  `lname` text NOT NULL,
  `fname` text NOT NULL,
  `mname` text NOT NULL,
  `relation` text NOT NULL,
  `occupation` text NOT NULL,
  `contactno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pid` int(11) NOT NULL,
  `lname` text NOT NULL,
  `fname` text NOT NULL,
  `mname` text NOT NULL,
  `address` text NOT NULL,
  `weight` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `birthday` int(11) NOT NULL,
  `gender` text NOT NULL,
  `contactno` int(11) NOT NULL,
  `id` text NOT NULL,
  `sid` int(11) NOT NULL,
  `dept` varchar(54) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `lname`, `fname`, `mname`, `address`, `weight`, `height`, `birthday`, `gender`, `contactno`, `id`, `sid`, `dept`) VALUES
(1, 'sitchon', 'jonel', 'laude', 'test', 0, 0, 0, '', 0, '', 0, ''),
(5, 'mansalapuz', 'haley', 'abulencia', '', 0, 0, 0, '', 0, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `personaldiseaserecord`
--

CREATE TABLE `personaldiseaserecord` (
  `pid` int(11) NOT NULL,
  `disid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personaldiseaserecord`
--

INSERT INTO `personaldiseaserecord` (`pid`, `disid`) VALUES
(1, '1,2,3,4'),
(5, '1,3,5,7,9,11,13');

-- --------------------------------------------------------

--
-- Table structure for table `personalmedicalhistory`
--

CREATE TABLE `personalmedicalhistory` (
  `pid` int(11) NOT NULL,
  `illno` int(11) NOT NULL,
  `datediagnose` int(11) NOT NULL,
  `medication` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schyear`
--

CREATE TABLE `schyear` (
  `sid` int(11) NOT NULL,
  `schyr` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schyear`
--

INSERT INTO `schyear` (`sid`, `schyr`, `status`) VALUES
(1, '2010', 0),
(2, '2011', 0),
(3, '2012', 0),
(4, '2013', 0),
(5, '2014', 0),
(18, '2015', 0),
(19, '2016', 0),
(20, '2017', 0),
(21, '2018', 0),
(22, '2019', 0),
(23, '2020', 0),
(24, '2021', 0),
(25, '2022', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Candidate_ID` int(11) NOT NULL,
  `SCODE` int(11) NOT NULL,
  `SLNAME` text NOT NULL,
  `SFNAME` text NOT NULL,
  `SMNAME` text NOT NULL,
  `SUFFIXNAME` text NOT NULL,
  `SFULLNAME` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `GRADE_YEAR` text NOT NULL,
  `SECTION` text NOT NULL,
  `SHOP` text NOT NULL,
  `ENROLLED` int(11) NOT NULL,
  `TERM` text NOT NULL,
  `YEAR` int(11) NOT NULL,
  `SY_EFFECTIVE` text NOT NULL,
  `DEPARTMENT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `user_uid` varchar(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pwhash` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_type` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_email` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`user_uid`, `name`, `username`, `pwhash`, `user_type`, `user_email`) VALUES
('121212', '', 'admin', '$2y$10$ITt/.PhrC9XfLnDVnb9XVu6Mj1FOjvQcQ58Wjes9UtgMjW7bGe70C', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `usersession`
--

CREATE TABLE `usersession` (
  `id` int(16) NOT NULL,
  `token` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tokentype` int(11) NOT NULL,
  `date_set` datetime NOT NULL,
  `date_expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Table for User Session handling';

--
-- Dumping data for table `usersession`
--

INSERT INTO `usersession` (`id`, `token`, `tokentype`, `date_set`, `date_expiry`) VALUES
(71, 'd7d35ce2bfdf3d7e4232cc5e0a9013bf', 1, '2024-07-12 14:45:29', '2024-07-19 14:45:29');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `vid` int(11) NOT NULL,
  `vaccninename` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vaccinestatus`
--

CREATE TABLE `vaccinestatus` (
  `pid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `dose` text NOT NULL,
  `date` int(11) NOT NULL,
  `location` text NOT NULL,
  `vacccinationcard` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appt_id`);

--
-- Indexes for table `appointment_attachments`
--
ALTER TABLE `appointment_attachments`
  ADD PRIMARY KEY (`appt_uuid`);

--
-- Indexes for table `appointment_types`
--
ALTER TABLE `appointment_types`
  ADD PRIMARY KEY (`appt_type`);

--
-- Indexes for table `checkupdtails`
--
ALTER TABLE `checkupdtails`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `elistgen`
--
ALTER TABLE `elistgen`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `illness`
--
ALTER TABLE `illness`
  ADD PRIMARY KEY (`disid`);

--
-- Indexes for table `medicalhistory`
--
ALTER TABLE `medicalhistory`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `medicinedosage`
--
ALTER TABLE `medicinedosage`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `personaldiseaserecord`
--
ALTER TABLE `personaldiseaserecord`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `personalmedicalhistory`
--
ALTER TABLE `personalmedicalhistory`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `schyear`
--
ALTER TABLE `schyear`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`user_uid`);

--
-- Indexes for table `usersession`
--
ALTER TABLE `usersession`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccinestatus`
--
ALTER TABLE `vaccinestatus`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appt_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `elistgen`
--
ALTER TABLE `elistgen`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicalhistory`
--
ALTER TABLE `medicalhistory`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicinedosage`
--
ALTER TABLE `medicinedosage`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personalmedicalhistory`
--
ALTER TABLE `personalmedicalhistory`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schyear`
--
ALTER TABLE `schyear`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `usersession`
--
ALTER TABLE `usersession`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `vaccinestatus`
--
ALTER TABLE `vaccinestatus`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
