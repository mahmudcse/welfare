-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2017 at 12:13 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `welfare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `componentId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`componentId`, `name`, `email`, `password`, `status`) VALUES
(1, 'Admin', 'welfare@gmail.com', '$2a$06$Qs8TZUtMXtt9OjsqFl3npuUayfRVAJuxpFQCNFmyY8uvX2s.Cn6cG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `componentId` int(11) NOT NULL,
  `commission_name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`componentId`, `commission_name`, `code`) VALUES
(1, 'Health', ''),
(2, 'Education', '');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `componentId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`componentId`, `name`, `code`) VALUES
(1, 'Manager', ''),
(2, 'Assistant Manager', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `componentId` int(11) NOT NULL,
  `card_no` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `commission_name` varchar(255) NOT NULL,
  `last_salary` int(11) NOT NULL,
  `file_no` int(11) NOT NULL,
  `date_of_birth` datetime NOT NULL,
  `death` datetime NOT NULL,
  `sonalibank_branch` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nominee`
--

CREATE TABLE `nominee` (
  `componentId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `relation` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `amount_at_a_time` int(11) NOT NULL,
  `amount_per_month` int(11) NOT NULL,
  `pay_time_starts` datetime NOT NULL,
  `pay_time_ends` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `relation`
--

CREATE TABLE `relation` (
  `componentId` int(11) NOT NULL,
  `relation_name` varchar(255) NOT NULL,
  `relation_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relation`
--

INSERT INTO `relation` (`componentId`, `relation_name`, `relation_code`) VALUES
(1, 'Wife', 0),
(2, 'Son', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sonali_bank_branches`
--

CREATE TABLE `sonali_bank_branches` (
  `componentId` int(11) NOT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `branch_code` int(11) DEFAULT NULL,
  `address` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sonali_bank_branches`
--

INSERT INTO `sonali_bank_branches` (`componentId`, `branch_name`, `branch_code`, `address`) VALUES
(2, 'Mohammad Pur', NULL, NULL),
(3, 'Motijhil', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `nominee`
--
ALTER TABLE `nominee`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `sonali_bank_branches`
--
ALTER TABLE `sonali_bank_branches`
  ADD PRIMARY KEY (`componentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nominee`
--
ALTER TABLE `nominee`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `relation`
--
ALTER TABLE `relation`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sonali_bank_branches`
--
ALTER TABLE `sonali_bank_branches`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
