-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 11:20 PM
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
-- Database: `agriserve`
--

-- --------------------------------------------------------

--
-- Table structure for table `agri_adversity`
--

CREATE TABLE `agri_adversity` (
  `agri_adversity_id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `commodity` varchar(255) NOT NULL,
  `areas_affected` varchar(10) NOT NULL,
  `typhoon` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agri_adversity`
--

INSERT INTO `agri_adversity` (`agri_adversity_id`, `farmer_id`, `commodity`, `areas_affected`, `typhoon`, `date`) VALUES
(2, 10, 'tset', 'test', '123', '2023-12-01 00:00:00'),
(3, 18, 'RCEF Beneficiary', 'Ilocano', 'Perding', '2019-06-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `agri_assistance`
--

CREATE TABLE `agri_assistance` (
  `agri_assistance_id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `farm_assistance` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agri_assistance`
--

INSERT INTO `agri_assistance` (`agri_assistance_id`, `farmer_id`, `farm_assistance`) VALUES
(1, 11, 'RCEF BENEFIARY'),
(2, 10, 'Mechanization Program');

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `crop_id` int(11) NOT NULL,
  `crop_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`crop_id`, `crop_name`) VALUES
(1, 'Rice/Palay'),
(2, 'Corn/Mais'),
(3, 'Ice/Candy'),
(4, 'Tobacco');

-- --------------------------------------------------------

--
-- Table structure for table `cultivated_plants`
--

CREATE TABLE `cultivated_plants` (
  `cultivated_plants_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `land_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `farm_type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cultivated_plants`
--

INSERT INTO `cultivated_plants` (`cultivated_plants_id`, `crop_id`, `land_id`, `size`, `farm_type`) VALUES
(2, 1, 5, '99', 1),
(4, 1, 8, '6', 2),
(5, 3, 5, '2312', 1);

-- --------------------------------------------------------

--
-- Table structure for table `farmer_info`
--

CREATE TABLE `farmer_info` (
  `farmer_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `extension_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `highest_formal_education` varchar(255) NOT NULL,
  `mother_maiden_name` varchar(255) NOT NULL,
  `spouse_name` varchar(255) NOT NULL,
  `is_pwd` enum('Yes','No') NOT NULL,
  `is_4ps` enum('Yes','No') NOT NULL,
  `is_ip` enum('Yes','No') NOT NULL,
  `has_government_id` enum('Yes','No') NOT NULL,
  `government_id_type` varchar(255) NOT NULL,
  `government_id_number` varchar(255) NOT NULL,
  `is_associated` enum('Yes','No') NOT NULL,
  `association_name` varchar(255) NOT NULL,
  `is_household_head` enum('Yes','No') NOT NULL,
  `household_head_name` varchar(255) NOT NULL,
  `household_head_relationship` varchar(255) NOT NULL,
  `living_household_members` varchar(255) NOT NULL,
  `no_of_female` varchar(255) NOT NULL,
  `no_of_male` varchar(255) NOT NULL,
  `emergency_contact_name` varchar(255) NOT NULL,
  `emergency_contact_number` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `indigenous_group` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_info`
--

INSERT INTO `farmer_info` (`farmer_id`, `firstname`, `middlename`, `surname`, `extension_name`, `address`, `sex`, `mobile_number`, `date_of_birth`, `place_of_birth`, `religion`, `civil_status`, `highest_formal_education`, `mother_maiden_name`, `spouse_name`, `is_pwd`, `is_4ps`, `is_ip`, `has_government_id`, `government_id_type`, `government_id_number`, `is_associated`, `association_name`, `is_household_head`, `household_head_name`, `household_head_relationship`, `living_household_members`, `no_of_female`, `no_of_male`, `emergency_contact_name`, `emergency_contact_number`, `profile_image`, `indigenous_group`) VALUES
(10, 'David', 'Caburnay', 'Labitoria', 'III', '69, Lower Bio, Bio, TAGUDIN, ILOCOS SUR', 'Male', '12345678980', '1996-12-12', 'BINONDO, NCR, CITY OF MANILA, FIRST DISTRICT', 'Roman Catholic', 'Single', 'bachelors_degree', 'Dik ammo', 'awan pay', 'Yes', 'Yes', 'Yes', 'Yes', 'umid', '1234', 'No', 'N/A', 'Yes', 'David', 'Self', '4', '2', '2', 'IDK', '23821093', '', NULL),
(11, 'Emmanuel', 'Arzadon', 'Lodia', '', '12, Ilocano, Sudipen, La Union, Bigbiga, SUDIPEN, LA UNION', 'Male', '09513976153', '2000-10-12', 'SUDIPEN, LA UNION', 'Roman Catholic', 'Single', 'elementary', 'Dela Cruz', 'Awan pay', 'No', 'Yes', 'Yes', 'Yes', 'employeeId', '1234', 'Yes', 'N/A', 'Yes', 'Emmanuel', 'Self', '3', '2', '2', 'Emman Lodia', '09423821093', '', NULL),
(12, 'Marchie', 'Opas', 'Balandino', '', 'namaltugan', 'Male', '123456789', '1998-03-30', 'AGOO, LA UNION', 'RC', 'Single', 'high_school', 'daWFAF', 'Naghahanap parin', 'No', 'Yes', 'Yes', 'Yes', 'passport', 'n/a', 'Yes', 'n/a', 'Yes', 'Marchie', 'ME', '6', '1', '5', 'dfhdfh', '-09086', '', NULL),
(13, 'Reymon', 'Portgas', 'Jose', 'Jr.', '#43, Centro, Poblacion, SUDIPEN, LA UNION', 'Male', '123456789', '2023-11-27', 'AGOO, LA UNION', 'RC', 'Single', 'doctorate', 'daWFAF', 'Naghahanap parin', 'Yes', 'Yes', 'Yes', 'Yes', 'ibpId', 'n/a', 'Yes', 'n/a', 'No', 'Reymon', 'father', '20', '10', '10', 'dfhdfh', '-09086', '', NULL),
(14, 'Mike', 'Andersen', 'Enriquez', 'Sr.', '#43, Centro, Bangbangcag, BUCAY, ABRA', 'Male', '3333333333', '2023-11-08', ', ABRA', 'RC', 'Married', 'masters_degree', 'daWFAF', 'jane enriquez', 'Yes', 'Yes', 'Yes', 'Yes', 'nbiClearance', 'n/a', 'Yes', 'n/a', 'Yes', 'Mike', 'ME', '4', '4', '0', 'dfhdfh', '-09086', '', NULL),
(15, 'Ronalyn', 'vic', 'Singasing', '', '#43, Centro, Ilocano, SUDIPEN, LA UNION', 'Female', '3333333333', '2023-11-02', 'AGOO, LA UNION', 'RC', 'Divorced', 'doctorate', 'daWFAF', 'Marchie Balandino', 'No', 'Yes', 'Yes', 'Yes', 'prc', 'n/a', 'Yes', 'n/a', 'Yes', 'Ronalyn', 'ME', '6', '6', '6', 'dfhdfh', '-09086', '', NULL),
(16, 'Nekka', 'Val', 'Castro', '', '#43, Centro, San Francisco Sur, SUDIPEN, LA UNION', 'Female', '3333333333', '2023-11-10', 'AGOO, LA UNION', 'RC', 'Single', 'bachelors_degree', 'daWFAF', 'Naghahanap parin', 'Yes', 'Yes', 'Yes', 'Yes', 'prc', 'n/a', 'Yes', 'n/a', 'Yes', 'Nekka', 'ME', '4', '1', '3', 'dfhdfh', '-09086', '', NULL),
(17, 'zeny', 'caslangen', 'corpuz', '', '#45, Centro, Old Central, SUDIPEN, LA UNION', 'Female', '3333333333', '2023-11-01', 'AGOO, LA UNION', 'RC', 'Married', 'masters_degree', 'daWFAF', 'n/a', 'No', 'Yes', 'Yes', 'Yes', 'prc', 'n/a', 'Yes', 'n/a', 'Yes', 'zeny', 'ME', '4', '2', '2', 'dfhdfh', '-09086', '', NULL),
(18, 'Zet', 'Ortiz', 'Ortiz', '', '#1, Centro, Namaltugan, SUDIPEN, LA UNION', 'Male', '3333333333', '2023-11-02', 'AGOO, LA UNION', 'INC', 'Single', 'bachelors_degree', 'daWFAF', 'n/a', 'Yes', 'Yes', 'Yes', 'Yes', 'prc', 'n/a', 'Yes', 'n/a', 'No', 'Zet', 'father', '5', '1', '4', 'dfhdfh', '-09086', '', NULL),
(19, 'Zeus', 'vic', 'Enriquez', '', '#43, Centro, Poblacion, SUDIPEN, LA UNION', 'Male', '3333333333', '2000-06-23', 'AGOO, LA UNION', 'RC', 'Single', 'doctorate', 'daWFAF', 'n/a', 'Yes', 'Yes', 'Yes', 'Yes', 'prc', 'n/a', 'Yes', 'n/a', 'Yes', 'Zeus', 'ME', '6', '5', '1', 'dfhdfh', '-09086', '', NULL),
(27, 'Cyanne Justin ', 'Labitoria', 'Vega', '', '19, Lower Bio, Bio, TAGUDIN, ILOCOS SUR', 'Male', 'idk', '2002-12-01', 'TAGUDIN, ILOCOS SUR', 'idk', 'Single', 'elementary', 'idk', 'idk', 'Yes', 'Yes', 'Yes', 'Yes', 'driverLicense', 'idk', 'Yes', 'idk', 'Yes', 'Cyanne Justin ', 'idk', '12', '1', '1', 'idk', 'idk', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `farmer_land_info`
--

CREATE TABLE `farmer_land_info` (
  `farmer_land_id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `land_area` varchar(255) NOT NULL COMMENT 'hectares',
  `location` varchar(255) NOT NULL,
  `agrarian_reform_beneficiary` enum('Yes','No') NOT NULL,
  `ownership_type` varchar(255) NOT NULL,
  `within_ancestral_domain` enum('Yes','No') DEFAULT NULL,
  `ownership_document_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_land_info`
--

INSERT INTO `farmer_land_info` (`farmer_land_id`, `farmer_id`, `land_area`, `location`, `agrarian_reform_beneficiary`, `ownership_type`, `within_ancestral_domain`, `ownership_document_number`) VALUES
(5, 10, '20', '23', '', 'others', '', '1234567890'),
(6, 11, '20', 'Ilocano', 'Yes', 'certificateOfLandTransfer', '', 'Secret'),
(8, 12, '20', 'namaltugan', 'Yes', 'taxDeclaration', 'Yes', '56789'),
(9, 19, '20', 'namaltugan', '', 'certificateOfTitle', '', '56789'),
(10, 18, '20', 'Ilocano', 'Yes', 'homesteadPatent', '', 'Secret'),
(11, 10, '', '', 'Yes', 'agriculturalSalesPatent', '', ''),
(12, 11, '', '', '', 'agriculturalSalesPatent', '', ''),
(13, 10, '20 hectared', 'Namaltugan, Sudipen, La Union', 'Yes', 'certificateOfLandTransfer', 'Yes', '1234345436'),
(22, 0, '', '', '', 'certificateOfLandTransfer', '', ''),
(23, 0, '12', '12', 'Yes', 'homesteadPatent', 'Yes', 'i'),
(24, 27, '12', '12', 'Yes', 'homesteadPatent', 'Yes', 'i');

-- --------------------------------------------------------

--
-- Table structure for table `farm_type`
--

CREATE TABLE `farm_type` (
  `farm_type_id` int(11) NOT NULL,
  `farm_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farm_type`
--

INSERT INTO `farm_type` (`farm_type_id`, `farm_type`) VALUES
(1, 'Irrigated'),
(2, 'Rainfed Upland'),
(3, 'Rainfed Lowland');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `date_created`) VALUES
(1, 'admin', 'admin@agrisudipen.net', '$2y$10$xTUX5nVlKW1q7Zat3i9gQeGGVh5MT8uNtnFMKEfqdM6kXrvlNTNIa', '2023-10-15 12:59:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agri_adversity`
--
ALTER TABLE `agri_adversity`
  ADD PRIMARY KEY (`agri_adversity_id`),
  ADD KEY `farmer_id` (`farmer_id`);

--
-- Indexes for table `agri_assistance`
--
ALTER TABLE `agri_assistance`
  ADD PRIMARY KEY (`agri_assistance_id`);

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`crop_id`);

--
-- Indexes for table `cultivated_plants`
--
ALTER TABLE `cultivated_plants`
  ADD PRIMARY KEY (`cultivated_plants_id`),
  ADD KEY `crop_id` (`crop_id`),
  ADD KEY `land_id` (`land_id`),
  ADD KEY `farm_type` (`farm_type`);

--
-- Indexes for table `farmer_info`
--
ALTER TABLE `farmer_info`
  ADD PRIMARY KEY (`farmer_id`);

--
-- Indexes for table `farmer_land_info`
--
ALTER TABLE `farmer_land_info`
  ADD PRIMARY KEY (`farmer_land_id`);

--
-- Indexes for table `farm_type`
--
ALTER TABLE `farm_type`
  ADD PRIMARY KEY (`farm_type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agri_adversity`
--
ALTER TABLE `agri_adversity`
  MODIFY `agri_adversity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `agri_assistance`
--
ALTER TABLE `agri_assistance`
  MODIFY `agri_assistance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `crop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cultivated_plants`
--
ALTER TABLE `cultivated_plants`
  MODIFY `cultivated_plants_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `farmer_info`
--
ALTER TABLE `farmer_info`
  MODIFY `farmer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `farmer_land_info`
--
ALTER TABLE `farmer_land_info`
  MODIFY `farmer_land_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `farm_type`
--
ALTER TABLE `farm_type`
  MODIFY `farm_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cultivated_plants`
--
ALTER TABLE `cultivated_plants`
  ADD CONSTRAINT `cultivated_plants_ibfk_1` FOREIGN KEY (`crop_id`) REFERENCES `crops` (`crop_id`),
  ADD CONSTRAINT `cultivated_plants_ibfk_2` FOREIGN KEY (`land_id`) REFERENCES `farmer_land_info` (`farmer_land_id`),
  ADD CONSTRAINT `cultivated_plants_ibfk_3` FOREIGN KEY (`farm_type`) REFERENCES `farm_type` (`farm_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
