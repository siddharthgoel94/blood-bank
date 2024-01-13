-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2024 at 04:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood-bank-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `hospital_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `Apos` int(255) NOT NULL DEFAULT 0,
  `Aneg` int(255) NOT NULL DEFAULT 0,
  `Opos` int(255) NOT NULL DEFAULT 0,
  `Oneg` int(255) NOT NULL DEFAULT 0,
  `Bpos` int(255) NOT NULL DEFAULT 0,
  `Bneg` int(255) NOT NULL DEFAULT 0,
  `ABpos` int(255) NOT NULL DEFAULT 0,
  `ABneg` int(255) NOT NULL DEFAULT 0,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hospital_id`, `name`, `username`, `password`, `contact`, `address`, `Apos`, `Aneg`, `Opos`, `Oneg`, `Bpos`, `Bneg`, `ABpos`, `ABneg`, `timestamp`) VALUES
('h123', 'ganga ram hosp', 'sgrh@example.com', '123', '9988998899', 'g-123/A2 new delhi', 100, 120, 100, 0, 0, 0, 0, 0, '2024-01-03 03:54:33'),
('hospital659515eee1b19', 'J.L.K Hospital', 'jlk@example.com', '$2y$10$rYPgpgJJ94qmPqN3RSZbwe2vWoX2UVqFZLJNfHHGmcevbAJ7zYpgO', '01189898989', 'moti nagar new delhi', 100, 100, 100, 0, 100, 500, 150, 100, '2024-01-03 13:38:15'),
('hospital65959515d9f08', 'ABC hospital', 'abc@example.com', '$2y$10$yTB2hduwuFYECojblW2XieNqQhhfp0X3SVe4TktTPlvqC3j7t.LSi', '1100998866', '12-A Nagpur', 100, 1200, 1100, 1000, 1200, 1500, 1800, 2000, '2024-01-03 22:40:45'),
('hospital659595509d18e', 'XYZ hospital', 'xyz@example.com', '$2y$10$iCM.w0yIbMrN3hyEA4c6E.xnK3uajNyqnvt553DKjwgw1zX7nOzXm', '118855664477', '34-D Dehradun , Uttrakhand', 1000, 2000, 1000, 100, 0, 0, 120, 120, '2024-01-03 22:41:44'),
('hospital659595d5e4789', 'AIIMS', 'aiims@example.com', '$2y$10$bbjDLp0KXrw.6MyD7.8OWObipCTeUi/K8N6JwdspdIhBU1JDBurku', '9988779977', 'Aiims New Delhi Hauz khas', 2000, 100, 1200, 400, 1200, 1000, 1200, 100, '2024-01-03 22:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `req_id` varchar(255) NOT NULL,
  `hospital_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `blood_group_req` text NOT NULL,
  `quantity` int(10) NOT NULL,
  `time_req` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_req` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`req_id`, `hospital_id`, `user_id`, `blood_group_req`, `quantity`, `time_req`, `status_req`) VALUES
('req659662b49d9a0', 'h123', 'user659491b424f29', 'Apos', 50, '2024-01-04 21:09:23', 0),
('req659668077ae0f', 'h123', 'user659491b424f29', 'Opos', 100, '2024-01-04 21:09:23', 0),
('req6596683881434', 'hospital65959515d9f08', 'user659491b424f29', 'Opos', 200, '2024-01-04 21:09:23', 0),
('req659695c83f7a4', 'h123', 'user659491b424f29', 'Aneg', 0, '2024-01-04 21:09:23', 0),
('req65969f5fd1e6a', 'hospital659595509d18e', 'user659491b424f29', 'Apos', 100, '2024-01-04 21:09:23', 0),
('req6596a35f70807', 'hospital659515eee1b19', 'user659491b424f29', 'Aneg', 20, '2024-01-04 21:09:23', -1),
('req6596abd6c444c', 'hospital659595d5e4789', 'user659492532aca7', 'Oneg', 100, '2024-01-04 21:09:23', 0),
('req6596fbed1244c', 'hospital659515eee1b19', 'user659491b424f29', 'Opos', 100, '2024-01-04 21:09:23', -1),
('req659729f9bca68', 'h123', 'user659729e1d05e1', 'Aneg', 100, '2024-01-04 21:58:17', 0),
('req65972a036e7d8', 'hospital659515eee1b19', 'user659729e1d05e1', 'Aneg', 50, '2024-01-04 21:58:27', -1),
('req65972a3ec7ba7', 'hospital659595509d18e', 'user659729e1d05e1', 'Oneg', 10, '2024-01-04 21:59:26', 0),
('req65978ebab4c34', 'hospital65959515d9f08', 'user6595071e90065', 'Oneg', 100, '2024-01-05 05:08:10', 0),
('req659794ec0e19d', 'hospital659515eee1b19', 'user659491b424f29', 'Oneg', 20, '2024-01-05 05:34:36', 1),
('req65979525f0f50', 'hospital659515eee1b19', 'user659492532aca7', 'Oneg', 100, '2024-01-05 05:35:33', -1),
('req65979fc10bafa', 'hospital659515eee1b19', 'user659491b424f29', 'Oneg', 50, '2024-01-05 06:20:49', 1),
('req65979fc6f01be', 'hospital659515eee1b19', 'user659491b424f29', 'Apos', 50, '2024-01-05 06:20:54', 1),
('req65979fcc23a20', 'hospital659515eee1b19', 'user659491b424f29', 'Aneg', 100, '2024-01-05 06:21:00', 1),
('req65979fd3aea9a', 'hospital659515eee1b19', 'user659491b424f29', 'Opos', 50, '2024-01-05 06:21:07', 1),
('req6597a31fc7696', 'hospital659515eee1b19', 'user659491b424f29', 'Oneg', 20, '2024-01-05 06:35:11', 1),
('req6597af1d8fad0', 'hospital659515eee1b19', 'user659492532aca7', 'Oneg', 40, '2024-01-05 07:26:21', -1),
('req6597afdd1b3c5', 'hospital659515eee1b19', 'user659492532aca7', 'Oneg', 40, '2024-01-05 07:29:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `test-table`
--

CREATE TABLE `test-table` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `gender` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test-table`
--

INSERT INTO `test-table` (`id`, `username`, `password`, `gender`) VALUES
(1, 'sid', '$2y$10$hOuRQxau7MKyq1NFpKzcbu0tINKOzn37fW1pxBt92BuB24TpOwFeW', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(20) NOT NULL,
  `name` text NOT NULL,
  `blood_group` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `blood_group`, `username`, `password`, `address`, `phone_no`, `timestamp`) VALUES
('user659491b424f29', 'Teeksha', 'Apos', 'teeksha', '$2y$10$/QnikhZHOJOqdh9dCk7x1.z5XC8rByhKflS5CCwwpg7q0pEHvfwqG', '12-Q Ber sarai', '', '2024-01-03 04:14:04'),
('user659492532aca7', 'Shubham', 'Oneg', 'shubham', '$2y$10$A0.Sq5c/zJFpgF7QRB4q4uEJiOCiMYUV4.SuJO5ohM6172pycr.jC', '12-N Dwarka', '', '2024-01-03 04:16:43'),
('user6595071e90065', 'parth', 'Opos', 'parth', '$2y$10$rhmQ/91YFj.AtQyeJgHCh.Sthb/5nXa63TfWDGbmEgWM1kNd76Fb6', '11-A Joshi Road', '', '2024-01-03 12:35:02'),
('user6597064639780', 'Akshat', 'ABpos', 'akshat@example.com', '$2y$10$2XDVbplElH9w/ERImQPe6.3UVmvmGJnjPLgeQRfKfqTf2U6xS5aC.', '12-K Paschim Vihar', '', '2024-01-05 00:55:58'),
('user65970693dc83a', 'Harshit', 'Aneg', 'harshit@example.com', '$2y$10$WItzLTVdsT0Dc0HCuy3oaOnhbyMc7wu3fIJ4tme02hVSwL.iJuYjG', '21-A Moti nagar', '1122334455', '2024-01-05 00:57:16'),
('user6597070ab41f4', 'Sneha', 'Bpos', 'sneha@example.com', '$2y$10$pUNOx7fSzEAZ9TB2ef03IuHrF8l0rpyL4/kvJsxCpIqorwsbtt7W6', '10-Q Jamakpuri', '8877996677', '2024-01-05 00:59:14'),
('user659729e1d05e1', 'Shishir', 'Apos', 'shishirgarg', '$2y$10$u/yCmMglL/cwIzd3U75Epe9ydhe.4Mu/LnhF7S13DJXyl8wn5g7n2', '10-W Rohini West', '9988686868', '2024-01-05 03:27:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`hospital_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `user_constraint` (`user_id`),
  ADD KEY `hospital_conostraint` (`hospital_id`);

--
-- Indexes for table `test-table`
--
ALTER TABLE `test-table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `test-table`
--
ALTER TABLE `test-table`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `hospital_conostraint` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_constraint` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
