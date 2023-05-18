-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 12:40 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_masm`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` varchar(255) NOT NULL,
  `app_id` varchar(255) NOT NULL,
  `language` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `uid`, `app_id`, `language`, `os`, `created_at`, `updated_at`) VALUES
(1, '9a4408e8-cd7a-399b-a98c-e88a8aa9330c', '46672784826309838686', 'english', 'android', '2023-05-18 10:36:09', '2023-05-18 10:36:09'),
(2, '9a4408e8-cd7a-399b-a98c-e88a8aa9330c', '77719945639979473876', 'english', 'android', '2023-05-18 10:36:31', '2023-05-18 10:36:31'),
(3, '2ed0eb5b-d28e-37b7-a49a-7c0edf50f249', '97458373162291737306', 'english', 'ios', '2023-05-18 10:37:20', '2023-05-18 10:37:20'),
(4, '2ed0eb5b-d28e-37b7-a49a-7c0edf50f249', '33651988401697102659', 'english', 'ios', '2023-05-18 10:37:51', '2023-05-18 10:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-05-14-042034', 'App\\Database\\Migrations\\Devices', 'default', 'App', 1684038382, 1),
(2, '2023-05-14-042058', 'App\\Database\\Migrations\\Purchases', 'default', 'App', 1684038382, 1),
(3, '2023-05-14-042109', 'App\\Database\\Migrations\\Subscriptions', 'default', 'App', 1684038382, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscription_id` int(10) UNSIGNED NOT NULL,
  `purchase_request` tinytext NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `subscription_id`, `purchase_request`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"client_token\":\"36917d800241faeed92702d62d334628\",\"receipt\":\"20230518103609\"}', '2023-05-18 10:38:53', '2023-05-18 10:38:53'),
(2, 1, '{\"client_token\":\"36917d800241faeed92702d62d334628\",\"receipt\":\"20230518103609\"}', '2023-05-18 10:39:07', '2023-05-18 10:39:07'),
(3, 2, '{\"client_token\":\"cb4b652f606b1398c8b437c759f4323b\",\"receipt\":\"20230518103631\"}', '2023-05-18 10:39:41', '2023-05-18 10:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `device_id` int(10) UNSIGNED NOT NULL,
  `client_token` varchar(255) NOT NULL,
  `receipt` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','canceled','expired') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `device_id`, `client_token`, `receipt`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '36917d800241faeed92702d62d334628', '20230518103609', '2023-05-18', '2023-06-02', 'active', '2023-05-18 10:36:09', '2023-05-18 10:36:09'),
(2, 2, 'cb4b652f606b1398c8b437c759f4323b', '20230518103631', '2023-05-18', '2023-06-02', 'active', '2023-05-18 10:36:31', '2023-05-18 10:36:31'),
(3, 3, 'e2b6c4a7192f829b6e9c1ada24f5455f', '20230518103720', '2023-05-18', '2023-06-02', 'active', '2023-05-18 10:37:20', '2023-05-18 10:37:20'),
(4, 4, '660942ba4131c15344dc56d9857edc50', '20230518103751', '2023-05-18', '2023-06-02', 'active', '2023-05-18 10:37:51', '2023-05-18 10:37:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid_app_id` (`uid`,`app_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `client_token` (`client_token`),
  ADD UNIQUE KEY `receipt` (`receipt`),
  ADD KEY `client_token_receipt_status` (`client_token`,`receipt`,`status`),
  ADD KEY `end_date_status` (`end_date`,`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
