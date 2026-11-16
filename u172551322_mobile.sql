-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 16, 2026 at 02:03 PM
-- Server version: 11.8.9-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u172551322_mobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT 'default.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `profile`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$12$fIjpobIwONoAdWiJ3dZEaOcKWEWgsH4lsB.Mqexs3/e.QrpUpZk2m', 'default.jpg', '2026-07-29 18:58:25', '2026-07-29 18:58:25');

-- --------------------------------------------------------

--
-- Table structure for table `backup_logs`
--

CREATE TABLE `backup_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `external_path` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `type` enum('manual','auto') NOT NULL DEFAULT 'manual',
  `status` enum('success','failed') NOT NULL DEFAULT 'success',
  `error_message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `backup_logs`
--

INSERT INTO `backup_logs` (`id`, `filename`, `path`, `external_path`, `size`, `type`, `status`, `error_message`, `created_at`, `updated_at`) VALUES
(3123, 'backup_auto_2026-11-10_18-09-02.zip', 'backups/backup_auto_2026-11-10_18-09-02.zip', NULL, '457.52 MB', 'auto', 'success', NULL, '2026-11-10 18:09:23', '2026-11-10 18:09:23'),
(3124, 'backup_auto_2026-11-11_18-10-02.zip', 'backups/backup_auto_2026-11-11_18-10-02.zip', NULL, '457.52 MB', 'auto', 'success', NULL, '2026-11-11 18:10:21', '2026-11-11 18:10:21'),
(3125, 'backup_auto_2026-11-12_18-11-03.zip', 'backups/backup_auto_2026-11-12_18-11-03.zip', NULL, '457.52 MB', 'auto', 'success', NULL, '2026-11-12 18:11:20', '2026-11-12 18:11:20'),
(3126, 'backup_auto_2026-11-13_18-12-02.zip', 'backups/backup_auto_2026-11-13_18-12-02.zip', NULL, '479.63 MB', 'auto', 'success', NULL, '2026-11-13 18:12:21', '2026-11-13 18:12:21'),
(3127, 'backup_auto_2026-11-14_18-13-03.zip', 'backups/backup_auto_2026-11-14_18-13-03.zip', NULL, '479.63 MB', 'auto', 'success', NULL, '2026-11-14 18:13:22', '2026-11-14 18:13:22'),
(3128, 'backup_auto_2026-11-15_18-14-02.zip', 'backups/backup_auto_2026-11-15_18-14-02.zip', NULL, '479.63 MB', 'auto', 'success', NULL, '2026-11-15 18:14:20', '2026-11-15 18:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `backup_settings`
--

CREATE TABLE `backup_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `auto_backup` tinyint(1) NOT NULL DEFAULT 1,
  `external_path` varchar(255) DEFAULT NULL,
  `retention_days` int(11) NOT NULL DEFAULT 7,
  `last_backup_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `backup_settings`
--

INSERT INTO `backup_settings` (`id`, `shop_id`, `auto_backup`, `external_path`, `retention_days`, `last_backup_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, NULL, 7, '2026-11-15 18:14:20', '2026-06-01 16:29:18', '2026-11-15 18:14:20'),
(2, 1, 1, NULL, 1, NULL, '2026-06-01 16:30:07', '2026-08-02 08:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `technician_id` bigint(20) UNSIGNED DEFAULT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` longtext DEFAULT NULL,
  `price` longtext NOT NULL,
  `time` longtext DEFAULT NULL,
  `warranty` tinyint(1) DEFAULT 0,
  `warranty_months` longtext DEFAULT NULL,
  `device_models` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`device_models`)),
  `status` longtext NOT NULL DEFAULT 'pending',
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `user_id`, `shop_id`, `technician_id`, `job_id`, `service_id`, `price`, `time`, `warranty`, `warranty_months`, `device_models`, `status`, `title`, `created_at`, `updated_at`, `description`, `image`, `sort_order`) VALUES
(2, 1, 2, NULL, 1, NULL, '156', '4', 1, '3 Months', NULL, 'accepted', NULL, '2026-04-11 09:08:36', '2026-04-15 11:57:08', NULL, NULL, 0),
(3, 1, 3, NULL, 1, NULL, '485', '2', 0, '3 Months', NULL, 'accepted', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(4, 1, 4, NULL, 1, NULL, '130', '5', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(5, 1, 5, NULL, 1, NULL, '170', '2', 1, '3 Months', NULL, 'accepted', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(6, 1, 6, NULL, 1, NULL, '167', '4', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(7, 1, 7, NULL, 1, NULL, '427', '3', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(8, 1, 8, NULL, 1, NULL, '114', '3', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(10, 1, 2, NULL, 2, NULL, '467', '5', 0, '3 Months', NULL, 'accepted', NULL, '2026-04-11 09:08:36', '2026-04-16 13:21:14', NULL, NULL, 0),
(11, 1, 3, NULL, 2, NULL, '139', '3', 1, '3 Months', NULL, 'accepted', NULL, '2026-04-11 09:08:36', '2026-04-16 13:21:49', NULL, NULL, 0),
(12, 1, 4, NULL, 2, NULL, '348', '4', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(13, 1, 5, NULL, 2, NULL, '397', '3', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(14, 1, 6, NULL, 2, NULL, '218', '4', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(15, 1, 7, NULL, 2, NULL, '182', '3', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(16, 1, 8, NULL, 2, NULL, '456', '2', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(18, 1, 2, NULL, 3, NULL, '400', '1', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(19, 1, 3, NULL, 3, NULL, '197', '3', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(20, 1, 4, NULL, 3, NULL, '105', '1', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(21, 1, 5, NULL, 3, NULL, '378', '2', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(22, 1, 6, NULL, 3, NULL, '378', '5', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(23, 1, 7, NULL, 3, NULL, '225', '5', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(24, 1, 8, NULL, 3, NULL, '406', '3', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(26, 1, 2, NULL, 4, NULL, '285', '2', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(27, 1, 3, NULL, 4, NULL, '376', '4', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(28, 1, 4, NULL, 4, NULL, '210', '1', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(29, 1, 5, NULL, 4, NULL, '379', '2', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(30, 1, 6, NULL, 4, NULL, '370', '4', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(31, 1, 7, NULL, 4, NULL, '383', '5', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(32, 1, 8, NULL, 4, NULL, '304', '3', 1, '3 Months', NULL, 'accepted', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(34, 1, 2, NULL, 5, NULL, '388', '4', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(35, 1, 3, NULL, 5, NULL, '271', '1', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(36, 1, 4, NULL, 5, NULL, '199', '1', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(37, 1, 5, NULL, 5, NULL, '238', '1', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(38, 1, 6, NULL, 5, NULL, '398', '2', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(39, 1, 7, NULL, 5, NULL, '378', '5', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(40, 1, 8, NULL, 5, NULL, '247', '1', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(41, 1, 1, NULL, 6, NULL, '314', '1', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(42, 1, 2, NULL, 6, NULL, '113', '5', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(43, 1, 3, NULL, 6, NULL, '450', '2', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(44, 1, 4, NULL, 6, NULL, '306', '5', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(45, 1, 5, NULL, 6, NULL, '273', '3', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(46, 1, 6, NULL, 6, NULL, '294', '5', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(47, 1, 7, NULL, 6, NULL, '101', '2', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(48, 1, 8, NULL, 6, NULL, '491', '5', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(50, 1, 2, NULL, 7, NULL, '386', '3', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(51, 1, 3, NULL, 7, NULL, '448', '5', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(52, 1, 4, NULL, 7, NULL, '146', '3', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(53, 1, 5, NULL, 7, NULL, '438', '2', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(54, 1, 6, NULL, 7, NULL, '273', '2', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(55, 1, 7, NULL, 7, NULL, '395', '2', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(56, 1, 8, NULL, 7, NULL, '289', '2', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(57, 1, 1, NULL, 8, NULL, '360', '1', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(58, 1, 2, NULL, 8, NULL, '392', '3', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(59, 1, 3, NULL, 8, NULL, '282', '3', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(60, 1, 4, NULL, 8, NULL, '350', '5', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(61, 1, 5, NULL, 8, NULL, '295', '4', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(62, 1, 6, NULL, 8, NULL, '276', '5', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(63, 1, 7, NULL, 8, NULL, '226', '1', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(64, 1, 8, NULL, 8, NULL, '251', '4', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(66, 1, 2, NULL, 9, NULL, '232', '4', 0, '3 Months', NULL, 'accepted', NULL, '2026-04-11 09:08:36', '2026-04-16 13:14:43', NULL, NULL, 0),
(67, 1, 3, NULL, 9, NULL, '452', '1', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(68, 1, 4, NULL, 9, NULL, '175', '3', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(69, 1, 5, NULL, 9, NULL, '269', '2', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(70, 1, 6, NULL, 9, NULL, '139', '5', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(71, 1, 7, NULL, 9, NULL, '427', '3', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(72, 1, 8, NULL, 9, NULL, '366', '4', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(74, 1, 2, NULL, 10, NULL, '164', '2', 1, '3 Months', NULL, 'accepted', NULL, '2026-04-11 09:08:36', '2026-04-15 18:57:25', NULL, NULL, 0),
(75, 1, 3, NULL, 10, NULL, '149', '5', 0, '3 Months', NULL, 'accepted', NULL, '2026-04-11 09:08:36', '2026-04-16 12:20:46', NULL, NULL, 0),
(76, 1, 4, NULL, 10, NULL, '441', '3', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(77, 1, 5, NULL, 10, NULL, '372', '4', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(78, 1, 6, NULL, 10, NULL, '157', '2', 1, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(79, 1, 7, NULL, 10, NULL, '187', '4', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(80, 1, 8, NULL, 10, NULL, '366', '5', 0, '3 Months', NULL, 'pending', NULL, '2026-04-11 09:08:36', '2026-04-11 09:08:36', NULL, NULL, 0),
(81, 1, 1, NULL, 26, NULL, '2500', '1', 1, '8', NULL, 'pending', NULL, '2026-04-16 12:43:23', '2026-04-16 20:27:52', NULL, NULL, 0),
(82, 1, 1, NULL, 24, NULL, '708', '29', 1, '40', NULL, 'pending', NULL, '2026-04-16 13:10:34', '2026-04-16 13:10:34', NULL, NULL, 0),
(84, 6, 1, NULL, 28, NULL, '700', '50', 1, '12', NULL, 'pending', NULL, '2026-04-16 19:29:17', '2026-04-16 19:30:42', NULL, NULL, 0),
(91, 2, 1, NULL, 31, NULL, '123', '2', 0, NULL, NULL, 'pending', NULL, '2026-05-11 17:14:54', '2026-05-11 17:14:54', 'hello', NULL, 0),
(99, 2, 1, NULL, 43, NULL, '217', '11', 1, '9', '[\"2262\",\"2265\"]', 'pending', 'hello', '2026-06-01 16:52:35', '2026-06-12 15:51:39', 'Optio sunt anim lau', 'jobs/1780333022_6a1db9dee8aab.jfif', 0),
(100, 2, 1, NULL, 34, NULL, '526', '8', 0, NULL, NULL, 'pending', NULL, '2026-06-01 16:57:53', '2026-06-01 16:57:53', 'Nostrud et aut provi', 'jobs/1780333072_6a1dba101386c.png', 0),
(101, 2, 1, NULL, 22, NULL, '600', '60', 0, NULL, NULL, 'pending', 'Magna dolore iusto p', '2026-06-01 17:43:23', '2026-06-01 17:43:23', 'Ducimus quas totam', 'jobs/1780335802_6a1dc4ba946a6.jfif', 0),
(119, 28, 1, 1, 62, '17', '900', NULL, NULL, '100', NULL, 'delivered', NULL, '2026-10-23 19:20:43', '2026-11-10 07:03:15', NULL, NULL, 2),
(120, 25, 1, 1, 63, '29', '20000', NULL, NULL, '1', NULL, 'delivered', NULL, '2026-10-24 18:20:08', '2026-11-10 07:03:15', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_listings`
--

CREATE TABLE `job_listings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` longtext NOT NULL,
  `cover_image` longtext DEFAULT NULL,
  `full_name` longtext NOT NULL,
  `phone_number` longtext NOT NULL,
  `brand` longtext NOT NULL,
  `model` longtext NOT NULL,
  `description` longtext NOT NULL,
  `service_type` longtext NOT NULL,
  `status` longtext NOT NULL DEFAULT 'pending',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `warranty_months` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_listings`
--

INSERT INTO `job_listings` (`id`, `user_id`, `service_id`, `code`, `cover_image`, `full_name`, `phone_number`, `brand`, `model`, `description`, `service_type`, `status`, `sort_order`, `created_at`, `updated_at`, `warranty_months`) VALUES
(65, 2, 47, '#20261110-0', NULL, 'm', '0788', 'SAMSUNG', 'SAMSUNG A05s', 'lcd', 'With Warranty', 'pending', 0, '2026-11-10 07:06:16', '2026-11-10 07:06:33', 2),
(66, 2, 48, '#20261110-1', NULL, 'mm', '885', 'SAMSUNG', 'SAMSUNG A06', 'lcd', 'With Warranty', 'pending', 0, '2026-11-10 07:13:15', '2026-11-10 07:13:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_listing_metas`
--

CREATE TABLE `job_listing_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_listing_id` bigint(20) UNSIGNED NOT NULL,
  `role` longtext NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `management`
--

CREATE TABLE `management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` longtext NOT NULL,
  `name` longtext NOT NULL,
  `price` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `management`
--

INSERT INTO `management` (`id`, `parent_id`, `role`, `name`, `price`, `created_at`, `updated_at`) VALUES
(2236, NULL, 'Brand', 'iPhone', NULL, '2026-04-28 16:46:33', '2026-04-28 16:46:33'),
(2237, NULL, 'Brand', 'Huawei', NULL, '2026-04-28 16:46:37', '2026-04-28 16:46:37'),
(2238, NULL, 'Brand', 'Honor', NULL, '2026-04-28 16:46:42', '2026-04-28 16:46:42'),
(2239, NULL, 'Brand', 'Infinix', NULL, '2026-04-28 16:46:46', '2026-04-28 16:46:46'),
(2250, NULL, 'Brand', 'Tecno', NULL, '2026-04-28 16:49:36', '2026-04-28 16:49:36'),
(2251, NULL, 'Brand', 'Redmi', NULL, '2026-04-28 16:49:42', '2026-04-28 16:49:42'),
(2252, NULL, 'Brand', 'Realme', NULL, '2026-04-28 16:49:47', '2026-04-28 16:49:47'),
(2253, NULL, 'Brand', 'Vivo', NULL, '2026-04-28 16:49:51', '2026-04-28 16:49:51'),
(2254, NULL, 'Brand', 'Oppo', NULL, '2026-04-28 16:49:57', '2026-04-28 16:49:57'),
(2255, NULL, 'Brand', 'Itel', NULL, '2026-04-28 16:50:03', '2026-04-28 16:50:03'),
(2257, NULL, 'Brand', 'POCO', NULL, '2026-04-28 16:50:11', '2026-10-14 06:02:10'),
(2276, NULL, 'Brand', 'SAMSUNG', NULL, '2026-07-27 14:25:03', '2026-10-14 06:02:02'),
(2280, 2236, 'Model', 'IPHONE 6G', NULL, '2026-10-14 06:04:38', '2026-10-14 06:04:38'),
(2281, 2236, 'Model', 'IPHONE 6G PLUS', NULL, '2026-10-14 06:04:56', '2026-10-14 06:04:56'),
(2282, 2236, 'Model', 'IPHONE 6S', NULL, '2026-10-14 06:05:08', '2026-10-14 06:05:08'),
(2283, 2236, 'Model', 'IPHONE 6S PLUS', NULL, '2026-10-14 06:05:28', '2026-10-14 06:05:28'),
(2284, 2236, 'Model', 'IPHONE 7G', NULL, '2026-10-14 06:05:40', '2026-10-14 06:05:40'),
(2285, 2236, 'Model', 'IPHONE 7 PLUS', NULL, '2026-10-14 06:05:57', '2026-10-14 06:05:57'),
(2286, 2236, 'Model', 'IPHONE 8G', NULL, '2026-10-14 06:06:09', '2026-10-14 06:06:09'),
(2287, 2236, 'Model', 'IPHONE 8 PLUS', NULL, '2026-10-14 06:06:22', '2026-10-14 06:06:22'),
(2288, 2236, 'Model', 'IPHONE X', NULL, '2026-10-14 06:06:30', '2026-10-14 06:06:30'),
(2289, 2236, 'Model', 'IPHONE XS', NULL, '2026-10-14 06:06:42', '2026-10-14 06:06:42'),
(2290, 2236, 'Model', 'IPHONE XR', NULL, '2026-10-14 06:06:54', '2026-10-14 06:06:54'),
(2291, 2236, 'Model', 'IPHONE XS MAX', NULL, '2026-10-14 06:07:08', '2026-10-14 06:07:08'),
(2292, 2236, 'Model', 'IPHONE 11', NULL, '2026-10-14 06:07:22', '2026-10-14 06:07:22'),
(2293, 2236, 'Model', 'IPHONE 11 PRO MAX', NULL, '2026-10-14 06:07:37', '2026-10-14 06:07:37'),
(2295, 2236, 'Model', 'IPHONE 12 - 12 PRO', NULL, '2026-10-14 06:07:49', '2026-11-06 08:19:44'),
(2297, 2236, 'Model', 'IPHONE 12 PRO MAX', NULL, '2026-10-14 06:08:13', '2026-10-14 06:08:13'),
(2298, 2236, 'Model', 'IPHONE 13', NULL, '2026-10-14 06:08:24', '2026-10-14 06:08:24'),
(2299, 2236, 'Model', 'IPHONE 13 PRO', NULL, '2026-10-14 06:08:34', '2026-10-14 06:08:34'),
(2300, 2236, 'Model', 'IPHONE 13 PRO MAX', NULL, '2026-10-14 06:08:47', '2026-10-14 06:08:47'),
(2301, 2236, 'Model', 'IPHONE 14', NULL, '2026-10-14 06:09:03', '2026-10-14 06:09:03'),
(2302, 2236, 'Model', 'IPHONE 14 PRO', NULL, '2026-10-14 06:09:15', '2026-10-14 06:09:15'),
(2303, 2236, 'Model', 'IPHONE 14 PRO MAX', NULL, '2026-10-14 06:09:27', '2026-10-14 06:09:27'),
(2304, 2236, 'Model', 'IPHONE 15', NULL, '2026-10-14 06:09:36', '2026-10-14 06:09:36'),
(2305, 2236, 'Model', 'IPHONE 15 PRO', NULL, '2026-10-14 06:10:10', '2026-10-14 06:10:10'),
(2306, 2236, 'Model', 'IPHONE 15 PRO MAX', NULL, '2026-10-14 06:10:24', '2026-10-14 06:10:24'),
(2307, 2236, 'Model', 'IPHONE 16', NULL, '2026-10-14 06:10:35', '2026-10-14 06:10:35'),
(2308, 2236, 'Model', 'IPHONE 16 PRO', NULL, '2026-10-14 06:10:58', '2026-10-14 06:10:58'),
(2309, 2236, 'Model', 'IPHONE 16 PRO MAX', NULL, '2026-10-14 06:11:11', '2026-10-14 06:11:11'),
(2310, 2236, 'Model', 'IPHONE 17', NULL, '2026-10-14 06:11:22', '2026-10-14 06:11:22'),
(2311, 2236, 'Model', 'IPHONE 17 PRO', NULL, '2026-10-14 06:11:37', '2026-10-14 06:11:37'),
(2312, 2236, 'Model', 'IPHONE 17 PRO MAX', NULL, '2026-10-14 06:11:49', '2026-10-14 06:11:49'),
(2313, 2236, 'Model', 'IPHONE 18', NULL, '2026-10-14 06:11:58', '2026-10-14 06:11:58'),
(2314, 2236, 'Model', 'IPHONE 18 PRO', NULL, '2026-10-14 06:12:09', '2026-10-14 06:12:09'),
(2315, 2236, 'Model', 'IPHONE 18 PRO MAX', NULL, '2026-10-14 06:12:22', '2026-10-14 06:12:22'),
(2316, 2276, 'Model', 'J200', NULL, '2026-10-14 07:54:53', '2026-10-14 07:54:53'),
(2317, 2276, 'Model', 'J260', NULL, '2026-10-14 07:55:12', '2026-10-14 07:55:12'),
(2318, 2276, 'Model', 'J320', NULL, '2026-10-14 07:55:30', '2026-10-14 07:55:30'),
(2319, 2276, 'Model', 'J400', NULL, '2026-10-14 07:55:43', '2026-10-14 07:55:43'),
(2320, 2276, 'Model', 'J500', NULL, '2026-10-14 07:55:53', '2026-10-14 07:55:53'),
(2321, 2276, 'Model', 'J510', NULL, '2026-10-14 07:56:04', '2026-10-14 07:56:04'),
(2322, 2276, 'Model', 'J610-J410', NULL, '2026-10-14 07:58:51', '2026-10-14 07:58:51'),
(2323, 2276, 'Model', 'G570 - J5 PRIME', NULL, '2026-10-14 07:59:25', '2026-10-14 07:59:25'),
(2324, 2276, 'Model', 'G610 - J7 PRIME', NULL, '2026-10-14 07:59:45', '2026-10-14 07:59:45'),
(2325, 2276, 'Model', 'J530 - J5 PRO', NULL, '2026-10-14 08:00:03', '2026-10-14 08:00:03'),
(2326, 2276, 'Model', 'J700', NULL, '2026-10-14 08:00:42', '2026-10-14 08:00:42'),
(2327, 2276, 'Model', 'J730 - J7 PRO', NULL, '2026-10-14 08:00:57', '2026-10-14 08:00:57'),
(2328, 2276, 'Model', 'SAMSUNG A01', NULL, '2026-10-14 08:01:34', '2026-10-14 08:01:34'),
(2329, 2276, 'Model', 'SAMSUNG A02S - A03S - A03 - A04E', NULL, '2026-10-14 08:03:35', '2026-10-14 08:03:35'),
(2330, 2276, 'Model', 'SAMSUNG A04', NULL, '2026-10-14 08:03:51', '2026-10-14 08:03:51'),
(2331, 2276, 'Model', 'SAMSUNG A05', NULL, '2026-10-14 08:04:03', '2026-10-14 08:04:03'),
(2332, 2276, 'Model', 'SAMSUNG A05s', NULL, '2026-10-14 08:04:19', '2026-10-14 08:04:19'),
(2333, 2276, 'Model', 'SAMSUNG A06', NULL, '2026-10-14 08:04:35', '2026-10-14 08:04:35'),
(2334, 2276, 'Model', 'SAMSUNG A125 - A127 - A02 - M125 - M127', NULL, '2026-10-14 08:05:09', '2026-10-14 08:05:09'),
(2335, 2276, 'Model', 'SAMSUNG A10', NULL, '2026-10-14 08:06:11', '2026-10-14 08:06:11'),
(2336, 2276, 'Model', 'SAMSUNG A10s', NULL, '2026-10-14 08:06:30', '2026-10-14 08:06:30'),
(2337, 2276, 'Model', 'SAMSUNG a11 - m11', NULL, '2026-10-14 08:07:44', '2026-10-14 08:07:44'),
(2338, 2276, 'Model', 'SAMSUNG A03 CORE', NULL, '2026-10-14 08:08:10', '2026-10-14 08:08:10'),
(2339, 2276, 'Model', 'SAMSUNG A13 4G', NULL, '2026-10-14 08:08:47', '2026-10-14 08:08:47'),
(2340, 2276, 'Model', 'SAMSUNG A13 5G - A04s', NULL, '2026-10-14 08:09:07', '2026-10-14 08:09:07'),
(2341, 2276, 'Model', 'SAMSUNG A20', NULL, '2026-10-14 08:09:36', '2026-10-14 08:09:36'),
(2342, 2276, 'Model', 'SAMSUNG A20s', NULL, '2026-10-14 08:09:50', '2026-10-14 08:09:50'),
(2343, 2276, 'Model', 'SAMSUNG A21s', NULL, '2026-10-14 08:10:09', '2026-10-14 08:10:09'),
(2344, 2276, 'Model', 'SAMSUNG A22 4G', NULL, '2026-10-14 08:10:35', '2026-10-14 08:10:35'),
(2345, 2276, 'Model', 'SAMSUNG A22 5G', NULL, '2026-10-14 08:10:47', '2026-10-14 08:10:47'),
(2346, 2276, 'Model', 'SAMSUNG A23 4G', NULL, '2026-10-14 08:12:34', '2026-10-14 08:12:34'),
(2347, 2276, 'Model', 'SAMSUNG A25 - A24 4G - M34 5G', NULL, '2026-10-14 08:13:20', '2026-10-14 08:13:20'),
(2348, 2276, 'Model', 'SAMSUNG A30s', NULL, '2026-10-14 08:13:48', '2026-10-14 08:13:48'),
(2349, 2276, 'Model', 'SAMSUNG A31', NULL, '2026-10-14 08:14:03', '2026-10-14 08:14:03'),
(2350, 2276, 'Model', 'SAMSUNG A32 4G', NULL, '2026-10-14 08:14:15', '2026-10-14 08:14:15'),
(2351, 2276, 'Model', 'SAMSUNG A34', NULL, '2026-10-14 08:14:32', '2026-10-14 08:14:32'),
(2352, 2276, 'Model', 'SAMSUNG A35', NULL, '2026-10-14 08:14:41', '2026-10-14 08:14:41'),
(2353, 2276, 'Model', 'SAMSUNG A50 - A30', NULL, '2026-10-14 08:14:59', '2026-10-14 08:14:59'),
(2354, 2276, 'Model', 'SAMSUNG A51', NULL, '2026-10-14 08:15:21', '2026-10-14 08:15:21'),
(2355, 2276, 'Model', 'SAMSUNG A52 5G', NULL, '2026-10-14 08:15:38', '2026-10-14 08:15:38'),
(2356, 2276, 'Model', 'SAMSUNG A53 5G', NULL, '2026-10-14 08:15:53', '2026-10-14 08:15:53'),
(2357, 2276, 'Model', 'SAMSUNG A54 5G', NULL, '2026-10-14 08:16:29', '2026-10-14 08:16:29'),
(2358, 2276, 'Model', 'SAMSUNG A55', NULL, '2026-10-14 08:16:55', '2026-10-14 08:16:55'),
(2359, 2276, 'Model', 'SAMSUNG A520', NULL, '2026-10-14 08:17:17', '2026-10-14 08:17:17'),
(2360, 2276, 'Model', 'SAMSUNG A605', NULL, '2026-10-14 08:17:28', '2026-10-14 08:17:28'),
(2361, 2276, 'Model', 'SAMSUNG A70', NULL, '2026-10-14 08:17:39', '2026-10-14 08:17:39'),
(2362, 2276, 'Model', 'SAMSUNG A71', NULL, '2026-10-14 08:17:51', '2026-10-14 08:17:51'),
(2363, 2276, 'Model', 'SAMSUNG A72 4G', NULL, '2026-10-14 08:18:03', '2026-10-14 08:18:03'),
(2364, 2276, 'Model', 'SAMSUNG A750', NULL, '2026-10-14 08:18:18', '2026-10-14 08:18:18'),
(2365, 2276, 'Model', 'SAMSUNG A920', NULL, '2026-10-14 08:18:29', '2026-10-14 08:18:29'),
(2366, 2276, 'Model', 'SAMSUNG A15', NULL, '2026-10-14 08:23:54', '2026-10-14 08:23:54'),
(2367, 2276, 'Model', 'SAMSUNG A16 4G', NULL, '2026-10-14 08:24:04', '2026-11-05 17:12:23'),
(2369, 2276, 'Model', 'SAMSUNG A14 4G', NULL, '2026-11-05 17:07:33', '2026-11-05 17:07:33'),
(2370, 2276, 'Model', 'SAMSUNG A14 5G', NULL, '2026-11-05 17:07:51', '2026-11-05 17:07:51'),
(2371, 2276, 'Model', 'SAMSUNG A16 5G', NULL, '2026-11-05 17:12:42', '2026-11-05 17:12:42'),
(2372, 2237, 'Model', 'Huawei Y5 2019 - HONOR 8s', NULL, '2026-11-07 08:15:20', '2026-11-07 08:16:42'),
(2373, 2237, 'Model', 'Huawei Y5P 2020 - HONOR 9S', NULL, '2026-11-07 08:15:35', '2026-11-07 08:18:34'),
(2374, 2237, 'Model', 'Huawei Y6 2019 - Y6s - HONON 8A ORG', NULL, '2026-11-07 08:15:44', '2026-11-07 08:17:24'),
(2375, 2237, 'Model', 'Huawei  Y6P 2020 - HONON 9A', NULL, '2026-11-07 08:15:55', '2026-11-07 08:18:26'),
(2376, 2237, 'Model', 'Huawei Y7 2019', NULL, '2026-11-07 08:16:07', '2026-11-07 08:16:07'),
(2377, 2237, 'Model', 'Huawei Y7P 2020 - HONOR 9C', NULL, '2026-11-07 08:21:50', '2026-11-07 08:27:30'),
(2378, 2237, 'Model', 'Huawei Y7A - P SMART 2021 - HONOR X10 LITE', NULL, '2026-11-07 08:22:08', '2026-11-07 08:27:40'),
(2379, 2237, 'Model', 'Huawei NOVA 3I - MATE 20 LITE', NULL, '2026-11-07 08:22:29', '2026-11-07 08:27:47'),
(2380, 2237, 'Model', 'Huawei NOVA 3E - P20 LITE', NULL, '2026-11-07 08:22:43', '2026-11-07 08:27:55'),
(2381, 2237, 'Model', 'Huawei NOVA 5i  -NOVA 7i - P20 LITE 2019 - P40 LITE', NULL, '2026-11-07 08:25:01', '2026-11-07 08:28:04'),
(2382, 2237, 'Model', 'Huawei NOVA 5T - HONOR 20PRO - HONOR 20S', NULL, '2026-11-07 08:25:19', '2026-11-07 08:28:12'),
(2383, 2237, 'Model', 'Huawei Y9 PRIME - Y9S - 9X', NULL, '2026-11-07 08:26:56', '2026-11-07 08:28:19'),
(2384, 2237, 'Model', 'Huawei Y9a - X10', NULL, '2026-11-07 08:27:22', '2026-11-07 08:27:22'),
(2385, 2237, 'Model', 'Huawei Y9 2019 - Y8s', NULL, '2026-11-07 08:28:41', '2026-11-07 08:28:41'),
(2386, 2238, 'Model', 'HONOR PAD 5', NULL, '2026-11-07 08:29:27', '2026-11-07 08:29:27'),
(2387, 2238, 'Model', 'HONOR PAD X8 LITE', NULL, '2026-11-07 08:29:47', '2026-11-07 08:29:47'),
(2388, 2238, 'Model', 'HONOR PAD 9', NULL, '2026-11-07 08:30:02', '2026-11-07 08:30:02'),
(2389, 2238, 'Model', 'HONOR X5b', NULL, '2026-11-07 08:30:35', '2026-11-07 08:30:35'),
(2390, 2238, 'Model', 'HONOR X5c - HONOR X5c PLUS', NULL, '2026-11-07 08:32:39', '2026-11-07 08:32:39'),
(2391, 2238, 'Model', 'HONOR X6 2022 - X5 2023', NULL, '2026-11-07 08:33:04', '2026-11-07 08:33:12'),
(2392, 2238, 'Model', 'HONOR X6A - X5 PLUS', NULL, '2026-11-07 08:33:28', '2026-11-07 08:33:28'),
(2393, 2238, 'Model', 'HONOR X6B', NULL, '2026-11-07 08:33:43', '2026-11-07 08:33:43'),
(2394, 2238, 'Model', 'HONOR X6c - HONOR PLAY 60', NULL, '2026-11-07 08:33:57', '2026-11-07 08:33:57'),
(2395, 2238, 'Model', 'HONOR X7 2022', NULL, '2026-11-07 08:34:49', '2026-11-07 08:34:49'),
(2396, 2238, 'Model', 'HONOR X7A', NULL, '2026-11-07 08:35:25', '2026-11-07 08:35:25'),
(2397, 2238, 'Model', 'HONOR X7B', NULL, '2026-11-07 08:35:40', '2026-11-07 08:35:40'),
(2399, 2238, 'Model', 'HONOR X7C - HONOR 60 PLUS', NULL, '2026-11-07 08:35:58', '2026-11-07 08:35:58'),
(2400, 2238, 'Model', 'HONOR X7d - HONOR 400 SMART - HONOR PLAY 10c 5G', NULL, '2026-11-07 08:36:13', '2026-11-07 08:38:12'),
(2401, 2238, 'Model', 'HONOR X7E - HONOR X6E', NULL, '2026-11-07 08:36:32', '2026-11-07 08:36:32'),
(2402, 2238, 'Model', 'HONOR X8 2022', NULL, '2026-11-07 08:38:30', '2026-11-07 08:38:30'),
(2403, 2238, 'Model', 'HONOR X8A - HONOR 90LITE', NULL, '2026-11-07 08:38:46', '2026-11-07 08:38:46'),
(2404, 2238, 'Model', 'HONOR X8b  - X8c 4G - HONOR 200 LITE', NULL, '2026-11-07 08:39:00', '2026-11-07 12:42:26'),
(2405, 2238, 'Model', 'HONOR X9 2022', NULL, '2026-11-07 08:39:21', '2026-11-07 08:39:21'),
(2406, 2238, 'Model', 'HONOR X9A', NULL, '2026-11-07 08:39:36', '2026-11-07 08:39:36'),
(2407, 2238, 'Model', 'HONOR X9b', NULL, '2026-11-07 08:39:50', '2026-11-07 08:39:50'),
(2408, 2238, 'Model', 'HONOR X9C - HONOR X60 PRO - HONOR MAGIC 70 LITE', NULL, '2026-11-07 08:40:12', '2026-11-07 08:40:12'),
(2409, 2238, 'Model', 'HONOR 10 LITE -HONOR 10i -HONOR 20 LITE - HONOR 20i - PSMART 2019', NULL, '2026-11-07 08:40:30', '2026-11-07 08:40:30'),
(2410, 2238, 'Model', 'HONOR 8X 2019 - 9X LITE', NULL, '2026-11-07 08:40:45', '2026-11-07 08:40:45'),
(2411, 2238, 'Model', 'HONOR X9C SMART - HONOR X60', NULL, '2026-11-07 08:41:13', '2026-11-07 08:41:13'),
(2412, 2238, 'Model', 'HONOR 50 - NOVA 9', NULL, '2026-11-07 08:41:25', '2026-11-07 08:41:25'),
(2413, 2238, 'Model', 'HONOR 50 LITE - NOVA 8i', NULL, '2026-11-07 08:41:40', '2026-11-07 08:41:40'),
(2414, 2238, 'Model', 'HONOR 200', NULL, '2026-11-07 08:41:56', '2026-11-07 08:41:56'),
(2415, 2238, 'Model', 'HONOR 8C', NULL, '2026-11-07 08:42:10', '2026-11-07 08:42:10'),
(2416, 2239, 'Model', 'INFINIX SMART HD 2021', NULL, '2026-11-07 13:34:47', '2026-11-07 13:34:47'),
(2417, 2239, 'Model', 'INFINIX SMART 6PLUS - HOT 10T - HOT 10S - SPARK 7P - ITEL P38 PRO - VISION 3PLUS', NULL, '2026-11-07 13:35:05', '2026-11-07 13:35:05'),
(2418, 2239, 'Model', 'INFINIX HOT 7 - SPARK3', NULL, '2026-11-07 13:35:35', '2026-11-07 13:35:35'),
(2419, 2239, 'Model', 'INFINIX HOT 8 - HOT 8LITE – SPARK 4', NULL, '2026-11-07 13:35:49', '2026-11-07 13:35:49'),
(2420, 2239, 'Model', 'INFINIX HOT 9 - HOT 9PRO - CAMON 15 - NOTE 7LITE – S5 – SPARK 5 - SPARK 5PRO', NULL, '2026-11-07 13:36:09', '2026-11-07 13:36:09'),
(2421, 2239, 'Model', 'INFINIX HOT 9 PLAY', NULL, '2026-11-07 13:36:30', '2026-11-07 13:36:30'),
(2422, 2239, 'Model', 'INFINIX HOT 10 -NOTE 8i - POVA - CAMON 16 – CAMON 16PRO -  SPARK 6', NULL, '2026-11-07 13:36:47', '2026-11-07 13:36:47'),
(2423, 2239, 'Model', 'INFINIX HOT 10LITE -HOT 10i -SPARK 7 -SMART5-ITEL ViSION 1PRO - ITEL VISION 2S', NULL, '2026-11-07 13:37:08', '2026-11-07 13:37:08'),
(2424, 2239, 'Model', 'INFINIX HOT 10 PLAY - HOT 11 PLAY - POVA NEO - ITEL ViSION 2 PLUS', NULL, '2026-11-07 13:37:23', '2026-11-07 13:37:23'),
(2425, 2239, 'Model', 'INFINIX HOT 12 - HOT 12 PLAY – HOT 20 - NOTE 12i – POVA 4 - POVA NEO 2', NULL, '2026-11-07 13:37:49', '2026-11-07 13:37:49'),
(2426, 2239, 'Model', 'INFINIX HOT 12i – HOT 20i - SMART 6 HD', NULL, '2026-11-07 13:38:12', '2026-11-07 13:38:12'),
(2427, 2239, 'Model', 'INFINIX HOT 30 4G - IFINIX NOTE 30 4G - SPARK 10 PRO - SPARK 20 PRO - POVA 5 - POVA 5 PRO 5G - POVA 6 NEO 4G - HOT 40 - HOT 40X 5G - HOT 40 PRO - INFINIX NOTE 40X 5G', NULL, '2026-11-07 13:38:42', '2026-11-07 13:38:42'),
(2428, 2239, 'Model', 'INFINIX HOT 30i - POP 7 - SMART 7 PLUS', NULL, '2026-11-07 13:38:58', '2026-11-07 13:38:58'),
(2429, 2239, 'Model', 'INFINIX HOT 30 PLAY', NULL, '2026-11-07 13:39:14', '2026-11-07 13:39:14'),
(2430, 2239, 'Model', 'INFINIX HOT 50 5G - SMART 9', NULL, '2026-11-07 13:39:47', '2026-11-07 13:39:47'),
(2431, 2239, 'Model', 'INFINIX HOT 50i', NULL, '2026-11-07 13:40:02', '2026-11-07 13:40:02'),
(2432, 2239, 'Model', 'INFINIX HOT 50 4G - SPARK 30 4G - POVA 7 5G', NULL, '2026-11-07 13:40:35', '2026-11-07 13:40:35'),
(2433, 2239, 'Model', 'INFINIX HOT 50 PRO - SPARK 30 PRO - ITEL S25', NULL, '2026-11-07 13:40:54', '2026-11-07 13:40:54'),
(2434, 2239, 'Model', 'INFINIX HOT 60 5G - 60i - SMART 10 - SMART 10 HD - SMART 10 PLUS - SMART 10 PRO - POP 10 - POP10 PRO - SPARK 40 - 40C - SPARK GO 2', NULL, '2026-11-07 13:41:09', '2026-11-07 13:41:09'),
(2435, 2239, 'Model', 'INFINIX HOT 60 PRO - INFINIX GT 30 PRO - SPARK 40 PRO - POP 7 PRO', NULL, '2026-11-07 13:41:26', '2026-11-07 13:41:26'),
(2436, 2239, 'Model', 'INFINIX HOT 60 PRO PLUS', NULL, '2026-11-07 13:41:45', '2026-11-07 13:41:45'),
(2437, 2239, 'Model', 'INFINIX SMART 20 - HOT 70 4G - SPARK 50 4G - SPARK 50 5G NFC - POP X 5G - ITEL CITY 200', NULL, '2026-11-07 13:42:03', '2026-11-07 16:12:24'),
(2438, 2239, 'Model', 'INFINIX NOTE 7', NULL, '2026-11-07 13:42:41', '2026-11-07 13:42:41'),
(2439, 2239, 'Model', 'INFINIX NOTE 8', NULL, '2026-11-07 13:43:11', '2026-11-07 13:43:11'),
(2440, 2239, 'Model', 'INFINIX NOTE 10 - POVA2 - POVA 3 - NOTE 11S -NOTE 11PRO', NULL, '2026-11-07 13:43:47', '2026-11-07 13:43:47'),
(2441, 2239, 'Model', 'INFINIX NOTE 10 PRO', NULL, '2026-11-07 13:46:41', '2026-11-07 13:46:41'),
(2442, 2239, 'Model', 'INFINIX NOTE 11 - NOTE 12 - NOTE 12 PRO', NULL, '2026-11-07 13:47:59', '2026-11-07 13:47:59'),
(2443, 2239, 'Model', 'INFINIX NOTE 40 5G - CAMON 30 - CAMON 30 5G - POVA 6 - POVA 6 PRO 5G', NULL, '2026-11-07 13:49:04', '2026-11-07 13:49:04'),
(2444, 2239, 'Model', 'INFINIX NOTE 40 4G - NOTE 50 4G - NOTE 50 PRO - NOTE 50 PRO PLUS 5G - CAMON 30 PRO 5G - CAMON 40', NULL, '2026-11-07 13:49:18', '2026-11-07 13:49:18'),
(2445, 2239, 'Model', 'INFINIX ZERO X - ZERO XPRO - CAMON 18 PREMIER', NULL, '2026-11-07 13:49:44', '2026-11-07 13:49:44'),
(2446, 2239, 'Model', 'INFINIX ZERO 20 - POVA 4 PRO', NULL, '2026-11-07 13:50:40', '2026-11-07 13:50:40'),
(2447, 2239, 'Model', 'INFINIX ZERO 30 4G - ZERO 30 5G - ZERO 30 PRO - ITEL S23 PLUS', NULL, '2026-11-07 13:50:57', '2026-11-07 13:50:57'),
(2448, 2239, 'Model', 'INFINIX ZERO 40 - INFINIX NOTE 40s 4G - INFINIX NOTE 40 PRO 4G', NULL, '2026-11-07 13:51:17', '2026-11-07 13:51:17'),
(2449, 2250, 'Model', 'SPARK 6GO - SPARK GO 2021', NULL, '2026-11-08 08:30:30', '2026-11-08 08:30:30'),
(2450, 2250, 'Model', 'SPARK 8', NULL, '2026-11-08 08:30:55', '2026-11-08 08:30:55'),
(2451, 2250, 'Model', 'SPARK 8C - SPARK 9 – SPARK 9T - ITEL VISION 3 - ITEL A60S', NULL, '2026-11-08 08:31:15', '2026-11-08 08:31:15'),
(2452, 2250, 'Model', 'SPARK 7 PRO - CAMON 17', NULL, '2026-11-08 08:31:50', '2026-11-08 08:31:50'),
(2453, 2250, 'Model', 'SPARK 9 PRO - SPARK 8T - SPARK 8P - SPARK 8 PLUS - HOT 11 - ITEL VISION 5 PLUS', NULL, '2026-11-08 08:32:08', '2026-11-08 08:32:08'),
(2454, 2250, 'Model', 'SPARK 10 - SPARK 10C - SPARK GO 2023 - SMART 7HD - SMART 7 - POP 6PRO - HOT 12PRO - POP 7 PRO - ITEL A60 - ITEL A70 - ITEL P40', NULL, '2026-11-08 08:32:26', '2026-11-08 08:32:26'),
(2455, 2250, 'Model', 'TECNO SPARK 20 PRO', NULL, '2026-11-08 08:32:44', '2026-11-08 08:32:44'),
(2456, 2250, 'Model', 'TECNO SPARK GO 2022 - TECNO POP 5LITE – POP 5PRO - INFINIX SMART 6', NULL, '2026-11-08 08:34:03', '2026-11-08 08:34:03'),
(2457, 2250, 'Model', 'TECNO SPARK GO 2024 - SPARK 20 - SPARK 20C - INFINIX HOT 40i - SMART 8 - SMART 8 PRO - SMART 8 PLUS - SMART 8 HD - POP8 - ITEL P55 PLUS - ITEL P55 - ITEL  A70s  - ITEL S24', NULL, '2026-11-08 08:35:27', '2026-11-08 08:35:27'),
(2458, 2250, 'Model', 'TECNO SPARK GO 3 - POP 20 - POP X 4G - ITEL A200 4G - ITEL A200 PLUS 4G', NULL, '2026-11-08 08:35:51', '2026-11-08 08:35:51'),
(2459, 2250, 'Model', 'TECNO POUVOIR 4 – POUVOIR 4PRO – SPARK 5AIR – SPARK 6AIR', NULL, '2026-11-08 08:37:02', '2026-11-08 08:37:02'),
(2460, 2250, 'Model', 'TECNO POP 4LITE', NULL, '2026-11-08 08:37:21', '2026-11-08 08:37:21'),
(2461, 2250, 'Model', 'TECNO POP 6', NULL, '2026-11-08 08:37:59', '2026-11-08 08:37:59'),
(2462, 2250, 'Model', 'TECNO CAMON 17 PRO – INFINIX ZERO X NEW', NULL, '2026-11-08 08:38:44', '2026-11-08 08:38:44'),
(2463, 2250, 'Model', 'TECNO CAMON 18 - CAMON 17 PREMIER - CAMON 17P - CAMON 18P - SPARK 8 PRO - HOT 11S - POVA NEO 5G - ZERO 5G 2023 - HOT 20S', NULL, '2026-11-08 08:39:04', '2026-11-08 08:39:04'),
(2464, 2250, 'Model', 'TECNO CAMON 19 - CAMON 19PRO', NULL, '2026-11-08 08:40:39', '2026-11-08 08:40:39'),
(2465, 2250, 'Model', 'TECNO CAMON 20 -CAMON 20 PRO - NOTE 30 PRO', NULL, '2026-11-08 08:41:06', '2026-11-08 08:41:06'),
(2466, 2250, 'Model', 'TECNO CAMON 30 - CAMON 30 5G - INFINIX NOTE 40 5G - POVA 6 PRO - POVA 6 PRO 5G', NULL, '2026-11-08 08:41:37', '2026-11-08 08:41:37'),
(2467, 2250, 'Model', 'TECNO CAMON 40 PRO 5G - HOT 50 PRO PLUS 4G - INFINIX NOTE 40s - NOTE 40 PRO - NOTE 40 PRO PLUS -NOTE 50s 5G - SPARK 20s PLUS - SPARK 20 PRO PLUS - ITEL S25 ULTRA - ZERO 40 ULTRA - CAMON 30s - CAMON 30s PRO', NULL, '2026-11-08 08:41:58', '2026-11-08 08:41:58'),
(2468, 2252, 'Model', 'REALME C11 - C12 - C15  - OPPO A15 – OPPO A15S – OPPO A16K', NULL, '2026-11-08 08:42:46', '2026-11-08 08:42:46'),
(2469, 2252, 'Model', 'REALME C11 2021 - C20 - C21 - NARZO 50i', NULL, '2026-11-08 08:43:26', '2026-11-08 08:43:26'),
(2470, 2252, 'Model', 'REALME C21Y -C25y', NULL, '2026-11-08 08:43:41', '2026-11-08 08:43:41'),
(2471, 2252, 'Model', 'REALME C25 – C25s', NULL, '2026-11-08 08:43:58', '2026-11-08 08:43:58'),
(2472, 2252, 'Model', 'REALME C30s - C30 - C33', NULL, '2026-11-08 08:44:41', '2026-11-08 08:44:41'),
(2473, 2252, 'Model', 'REALME C35', NULL, '2026-11-08 08:44:58', '2026-11-08 08:44:58'),
(2474, 2252, 'Model', 'REALME C53 - C51 -REALME NOTE 50 - NARZO N53', NULL, '2026-11-08 08:45:21', '2026-11-08 08:45:21'),
(2475, 2252, 'Model', 'REALME C55 – REALME C67 5G - REALME 11 5G - NARZO N55 - OPPO A58 4G', NULL, '2026-11-08 08:45:37', '2026-11-08 08:45:37'),
(2476, 2252, 'Model', 'REALME C63 - C61 - NOTE 60 - NOTE 60x - NARZO N61 - NARZO N63', NULL, '2026-11-08 08:45:50', '2026-11-08 08:45:50'),
(2477, 2252, 'Model', 'REALME C65 4G - REALME C65 5G - REALME C67 4G - REALME C75x - REALME 12 5G - REALME 13 5G - OPPO A60', NULL, '2026-11-08 08:48:00', '2026-11-08 08:48:00'),
(2478, 2252, 'Model', 'REALME C71 4G', NULL, '2026-11-08 08:48:16', '2026-11-08 08:48:24'),
(2479, 2252, 'Model', 'REALME C75', NULL, '2026-11-08 08:48:39', '2026-11-08 08:48:39'),
(2480, 2252, 'Model', 'REALME C75x', NULL, '2026-11-08 08:48:55', '2026-11-08 08:48:55'),
(2481, 2252, 'Model', 'REALME C85', NULL, '2026-11-08 08:49:15', '2026-11-08 08:49:15'),
(2482, 2252, 'Model', 'REALME NOTE 70 - REALME C72 - REALME NOTE 70T', NULL, '2026-11-08 08:50:11', '2026-11-08 08:50:11'),
(2483, 2252, 'Model', 'REALME 6i - 5i - C3 - NARZO 10A – OPPO A11', NULL, '2026-11-08 08:50:42', '2026-11-08 08:50:42'),
(2484, 2252, 'Model', 'REALME 7 - REALME 6', NULL, '2026-11-08 08:50:54', '2026-11-08 08:50:54'),
(2485, 2252, 'Model', 'REALME 7i - C17 - OPPO A53 - A53s', NULL, '2026-11-08 08:51:10', '2026-11-08 08:51:10'),
(2486, 2252, 'Model', 'REALME 8 PRO - REALME 8  - REALME 7 PRO - A74 4G - A94 5G - RENO 5F', NULL, '2026-11-08 08:51:31', '2026-11-08 08:51:31'),
(2487, 2252, 'Model', 'REALME 9 4G - REALME 9PRO PLUS - REALME 10 4G - REALME 11 4G', NULL, '2026-11-08 08:51:45', '2026-11-08 08:51:45'),
(2489, 2252, 'Model', 'REALME 9i', NULL, '2026-11-08 08:52:17', '2026-11-08 08:52:17'),
(2490, 2252, 'Model', 'REALME 12 4G - REALME 13 4G - REALME 13 PRO - REALME 13 PLUS - REALME 14 - REALME 14T', NULL, '2026-11-08 08:52:36', '2026-11-08 08:52:36'),
(2491, 2252, 'Model', 'REALME 12 PLUS  5G', NULL, '2026-11-08 08:52:51', '2026-11-08 08:52:51'),
(2492, 2252, 'Model', 'REALME C100x - REALME C100 5G - REALME C100i - REALME C83 5G - REALME C83x - realme c85X - OPPO A6c 4G', NULL, '2026-11-08 08:53:05', '2026-11-08 08:53:05'),
(2493, 2252, 'Model', 'REALME Q3PRO – OPPO RENO 5 – RENO 6PRO - GT MASTER', NULL, '2026-11-08 08:53:23', '2026-11-08 08:53:23'),
(2494, 2257, 'Model', 'POCO X3 – X3PRO', NULL, '2026-11-09 06:39:03', '2026-11-09 06:39:27'),
(2495, 2257, 'Model', 'POCO X5 PRO - REDMI NOTE 12 PRO 5G - NOTE 12 PRO PLUS 5G', NULL, '2026-11-09 06:39:34', '2026-11-09 06:39:58'),
(2496, 2257, 'Model', 'POCO X6 - REDMI NOTE 13 PRO PLUS - NOTE 13 PRO 5G', NULL, '2026-11-09 06:40:10', '2026-11-09 06:40:23'),
(2497, 2257, 'Model', 'POCO X6 PRO 5G - POCO F6', NULL, '2026-11-09 06:40:51', '2026-11-09 06:40:51'),
(2498, 2257, 'Model', 'POCO C71 4G - REDMI A5 4G - REDMI A5 5G', NULL, '2026-11-09 06:41:06', '2026-11-09 06:41:06'),
(2499, 2257, 'Model', 'POCO C81 - POCO C81 PRO - POCO C85x 5G - REDMI A7 PRP 4G - REDMI A7 PRO 5G', NULL, '2026-11-09 06:41:24', '2026-11-09 06:41:24'),
(2500, 2257, 'Model', 'POCO M3 - REDMI 9T', NULL, '2026-11-09 06:41:56', '2026-11-09 06:41:56'),
(2501, 2257, 'Model', 'POCO M3 PRO - REDMI NOTE 10 5G - NOTE 10T 5G', NULL, '2026-11-09 06:42:11', '2026-11-09 06:42:11'),
(2502, 2257, 'Model', 'POCO M4 - POCO M5 4G - REDMI 10 5G', NULL, '2026-11-09 06:42:28', '2026-11-09 06:42:28'),
(2503, 2251, 'Model', 'REDMI 7A', NULL, '2026-11-09 06:42:49', '2026-11-09 06:42:49'),
(2504, 2251, 'Model', 'REDMI 8 – REDMI 8A', NULL, '2026-11-09 06:43:08', '2026-11-09 06:43:08'),
(2505, 2251, 'Model', 'REDMI 9', NULL, '2026-11-09 06:43:44', '2026-11-09 06:43:44'),
(2506, 2251, 'Model', 'REDMI 9A – 9C – 10A – POCO C3 - POOC C65', NULL, '2026-11-09 06:44:06', '2026-11-09 06:44:06'),
(2507, 2251, 'Model', 'REDMI 10', NULL, '2026-11-09 06:44:22', '2026-11-09 06:44:22'),
(2508, 2251, 'Model', 'REDMI 10C – POCO C40', NULL, '2026-11-09 06:44:39', '2026-11-09 06:44:39'),
(2509, 2251, 'Model', 'REDMI 12c', NULL, '2026-11-09 06:45:12', '2026-11-09 06:45:12'),
(2510, 2251, 'Model', 'REDMI 13 - REDMI 12 - POCO M6 4G - POCO M6 PRO 5G', NULL, '2026-11-09 06:45:30', '2026-11-09 06:45:30'),
(2511, 2251, 'Model', 'REDMI 13C - POCO C65', NULL, '2026-11-09 06:45:46', '2026-11-09 06:45:46'),
(2512, 2251, 'Model', 'REDMI 14C - REDMI A3 PRO - REDMI 14R 5G -POCO C75', NULL, '2026-11-09 06:46:03', '2026-11-09 06:46:03'),
(2513, 2251, 'Model', 'REDMI 15 4G - POCO M7 4G', NULL, '2026-11-09 06:46:21', '2026-11-09 06:46:21'),
(2514, 2251, 'Model', 'REDMI 15c 4G - REDMI 15c 5G - POCO C85 4G', NULL, '2026-11-09 06:46:36', '2026-11-09 06:46:36'),
(2515, 2251, 'Model', 'REDMI NOTE 8', NULL, '2026-11-09 06:47:29', '2026-11-09 06:47:29'),
(2516, 2251, 'Model', 'REDMI NOTE 8 PRO', NULL, '2026-11-09 06:47:43', '2026-11-09 06:47:43'),
(2517, 2251, 'Model', 'REDMI NOTE 9 4G - POCO M3 - REDMI 9T', NULL, '2026-11-09 06:48:07', '2026-11-09 06:48:07'),
(2518, 2251, 'Model', 'REDMI NOTE 9s - REDMI NOTE 9 PRO', NULL, '2026-11-09 06:48:24', '2026-11-09 06:48:41'),
(2519, 2251, 'Model', 'REDMI NOTE 10 4G - NOTE 10S - POCO M5s', NULL, '2026-11-09 06:49:22', '2026-11-09 06:49:22'),
(2520, 2251, 'Model', 'REDMI NOTE 10 PRO 4G - NOTE 10 PRO MAX - NOTE 11 PRO 5G - NOTE 11 PRO PLUS 5G - REDMI NOTE 12 PRO 4G - POCO X4 PRO 4G - POCO X4 PRO 5G', NULL, '2026-11-09 06:49:47', '2026-11-09 06:49:47'),
(2521, 2251, 'Model', 'REDMI NOTE 10 PRO 5G', NULL, '2026-11-09 06:50:10', '2026-11-09 06:50:10'),
(2522, 2251, 'Model', 'REDMI NOTE 11 4G – NOTE 11s - NOTE 12s –POCO M4 PRO 4G', NULL, '2026-11-09 06:50:33', '2026-11-09 06:50:33'),
(2523, 2251, 'Model', 'REDMI NOTE 11 5G - NOTE 11T - NOTE 11S - NOTE 11T 5G - POCO M4 PRO 5G ORG', NULL, '2026-11-09 06:50:48', '2026-11-09 06:50:48'),
(2524, 2251, 'Model', 'REDMI NOTE 11 PRO 4G - NOTE 11 PRO 5G - NOTE 12 PRO 4G', NULL, '2026-11-09 06:51:25', '2026-11-09 06:51:25'),
(2525, 2251, 'Model', 'REDMI NOTE 12 4G - NOTE 12 5G - POCO X5', NULL, '2026-11-09 06:52:20', '2026-11-09 06:52:20'),
(2526, 2251, 'Model', 'REDMI NOTE 13 4G  - REDMI NOTE 14 4G - REDMI NOTE 14 5G - POCO M7 PRO', NULL, '2026-11-09 06:52:34', '2026-11-09 06:52:34'),
(2527, 2251, 'Model', 'REDMI NOTE 13 PRO 4G - NOTE 14S - POCO M6 PRO 4G', NULL, '2026-11-09 06:52:47', '2026-11-09 06:52:47'),
(2528, 2251, 'Model', 'REDMI NOTE 13 PRO PLUS 5G -NOTE 14 PRO 5G - NOTE 14 PRO PLUS 5G - POCO X7 5G', NULL, '2026-11-09 06:53:11', '2026-11-09 06:53:11'),
(2529, 2251, 'Model', 'REDMI NOTE 14 4G - NOTE 14 5G - NOTE 13 4G - POCO M7 PRO', NULL, '2026-11-09 06:53:27', '2026-11-09 06:53:27'),
(2530, 2251, 'Model', 'REDMI NOTE 14 4G - NOTE 14 5G - NOTE 13 4G - POCO M7 PRO', NULL, '2026-11-09 06:53:27', '2026-11-09 06:53:27'),
(2531, 2251, 'Model', 'REDMI A1 - A1 PLUS - A2 - A2 PLUS - POCO C50 - C51', NULL, '2026-11-09 06:53:54', '2026-11-09 06:53:54'),
(2532, 2251, 'Model', 'REDMI A3 -A3 PLUS - POCO C61', NULL, '2026-11-09 06:54:11', '2026-11-09 06:54:11'),
(2533, 2251, 'Model', 'REDMI NOTE 9', NULL, '2026-11-09 14:29:24', '2026-11-09 14:29:24'),
(2534, NULL, 'Brand', 'LENOVO', NULL, '2026-11-09 17:36:16', '2026-11-09 17:36:16'),
(2535, 2534, 'Model', 'LENOVO K12', NULL, '2026-11-09 17:37:14', '2026-11-09 17:37:14'),
(2536, 2534, 'Model', 'LENOVO K13', NULL, '2026-11-09 17:37:30', '2026-11-09 17:37:30'),
(2537, 2534, 'Model', 'LENOVO K14 - K14 PLUS - K15 - K15 PLUS - NOTE 13', NULL, '2026-11-09 17:37:51', '2026-11-09 17:37:51'),
(2538, 2255, 'Model', 'ITEL A26', NULL, '2026-11-09 17:39:00', '2026-11-09 17:39:00'),
(2539, 2255, 'Model', 'ITEL A49 - ITEL A58 - A58 PRO', NULL, '2026-11-09 17:39:15', '2026-11-09 17:39:15'),
(2540, 2255, 'Model', 'ITEL A56', NULL, '2026-11-09 17:39:28', '2026-11-09 17:39:28'),
(2541, NULL, 'Brand', 'Wiko', NULL, '2026-11-09 17:40:11', '2026-11-09 17:40:11'),
(2542, NULL, 'Brand', 'Blackviwe', NULL, '2026-11-09 17:40:30', '2026-11-09 17:40:30'),
(2543, 2541, 'Model', 'WIKO T3', NULL, '2026-11-09 17:41:19', '2026-11-09 17:41:19'),
(2544, 2541, 'Model', 'WIKO T10', NULL, '2026-11-09 17:41:39', '2026-11-09 17:41:39'),
(2545, 2542, 'Model', 'BLACKVIWE A70', NULL, '2026-11-09 17:41:58', '2026-11-09 17:41:58'),
(2546, 2253, 'Model', 'VIVO Y1S - Y90 - Y93', NULL, '2026-11-13 07:51:33', '2026-11-13 07:51:33'),
(2547, 2253, 'Model', 'VIVO Y11 – Y12 – Y15 – Y17', NULL, '2026-11-13 07:51:47', '2026-11-13 07:51:47'),
(2548, 2253, 'Model', 'VIVO Y19 - Y5S', NULL, '2026-11-13 07:52:01', '2026-11-13 07:52:01'),
(2549, 2253, 'Model', 'VIVO Y20 - Y20s - Y20i - Y11s - Y12s - Y15s – Y12a', NULL, '2026-11-13 07:52:27', '2026-11-13 07:52:27'),
(2550, 2253, 'Model', 'VIVO Y30 - Y30i', NULL, '2026-11-13 07:52:45', '2026-11-13 07:52:45'),
(2551, 2253, 'Model', 'VIVO Y51 2020 – Y53s', NULL, '2026-11-13 07:52:58', '2026-11-13 07:52:58'),
(2552, 2254, 'Model', 'OPPO A12 - A5s - A7 – REALME 3 – REALME 3I', NULL, '2026-11-13 08:00:19', '2026-11-13 08:00:19'),
(2553, 2254, 'Model', 'OPPO A52 - A72 - A92', NULL, '2026-11-13 08:00:35', '2026-11-13 08:00:35'),
(2554, 2254, 'Model', 'OPPO A54 5G - A55 5G', NULL, '2026-11-13 08:00:49', '2026-11-13 08:01:42'),
(2555, 2254, 'Model', 'OPPO A54 4G - A55 4G', NULL, '2026-11-13 08:02:09', '2026-11-13 08:02:09'),
(2556, 2254, 'Model', 'OPPO A57 5G - OPPA A57 4G -OPP A18 - OPPO A36', NULL, '2026-11-13 08:03:24', '2026-11-13 08:03:24'),
(2557, 2254, 'Model', 'OPPO A36 2022 - A76 2022', NULL, '2026-11-13 08:03:45', '2026-11-13 08:03:45'),
(2558, 2254, 'Model', 'OPPO A93 – RENO 4- RENO 4LITE', NULL, '2026-11-13 08:04:03', '2026-11-13 08:04:14'),
(2559, 2253, 'Model', 'VIVO Y21 -Y21s - Y33s - Y02s - Y32 - Y025 - Y16', NULL, '2026-11-13 08:13:23', '2026-11-13 08:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_10_094340_create_personal_access_tokens_table', 1),
(5, '2026_04_10_101325_create_shops_table', 1),
(6, '2026_04_10_103725_create_management_table', 1),
(8, '2026_04_11_084519_create_job_applications_table', 3),
(9, '2026_04_11_091637_create_settings_table', 4),
(10, '2026_04_11_093145_create_job_listing_metas_table', 5),
(11, '2026_04_11_094531_create_notifications_table', 5),
(12, '2026_04_13_065729_create_reviews_table', 6),
(13, '2026_04_13_101628_add_email_to_shops', 7),
(14, '2026_04_13_121542_create_technicians_table', 8),
(15, '2026_04_14_133020_update_technician_column_in_job_applications_table', 9),
(16, '2026_04_14_133659_add_technician_fk_to_job_applications_table', 10),
(17, '2026_04_15_113429_drop_cover_image_from_job_listings_table', 11),
(18, '2026_04_16_120332_description_to_job_applications_table', 12),
(19, '2026_04_16_144148_create_price_histories_table', 13),
(20, '2026_05_07_172759_create_services_table', 14),
(21, '2026_05_07_175340_create_service_metas_table', 14),
(22, '2026_05_07_181225_create_shop_services_table', 15),
(24, '2026_04_11_084316_create_job_listings_table', 16),
(25, '2026_05_30_163000_create_receipt_records_table', 17),
(26, '2026_05_23_165459_create_job_applications_table', 18),
(27, '2026_06_01_120000_add_phone_number_to_shops_table', 18),
(28, '2026_06_01_121000_create_backup_settings_table', 18),
(29, '2026_06_01_122000_create_backup_logs_table', 18),
(30, '2026_06_01_165432_add_image_to_job_applications_table', 19),
(31, '2026_06_01_174120_add_title_to_job_applications_table', 20),
(32, '2026_06_12_154528_add_device_models_to_job_applications_table', 21),
(33, '2026_07_21_082312_add_sort_order_to_job_listings_table', 22),
(34, '2026_07_21_093331_create_admins_table', 23),
(35, '2026_07_21_112031_add_sort_order_to_job_applications_and_services_tables', 23),
(36, '2026_08_25_105939_add_warranty_months_to_job_listings_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext NOT NULL,
  `description` longtext NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `description`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 'Job Created', 'Your job #20260411-11 has been created successfully.', 0, '2026-04-11 09:51:33', '2026-04-11 09:51:33'),
(2, 1, 'Review Stored', 'Your review for job ID 1 has been stored successfully.', 0, '2026-04-13 07:20:26', '2026-04-13 07:20:26'),
(3, 1, 'Welcome!', 'Welcome to Mobile Maintenance. Your account is now active.', 0, '2026-04-13 07:36:30', '2026-04-13 07:36:30'),
(4, 2, 'Welcome!', 'Welcome to Mobile Maintenance. Your account is now active.', 0, '2026-04-13 07:41:28', '2026-04-13 07:41:28'),
(5, 3, 'Welcome!', 'Welcome to Mobile Maintenance. Your account is now active.', 0, '2026-04-13 07:44:53', '2026-04-13 07:44:53'),
(6, 1, 'Offer Accepted', 'Your offer for job ID 1 has been accepted.', 0, '2026-04-15 11:57:08', '2026-04-15 11:57:08'),
(7, 1, 'Job Created', 'Your job #20260415-12 has been created successfully.', 0, '2026-04-15 12:22:11', '2026-04-15 12:22:11'),
(8, 5, 'Welcome!', 'Welcome to Mobile Maintenance. Your account is now active.', 0, '2026-04-15 13:11:26', '2026-04-15 13:11:26'),
(9, 5, 'Job Created', 'Your job #20260415-13 has been created successfully.', 0, '2026-04-15 13:11:49', '2026-04-15 13:11:49'),
(10, 5, 'Job Created', 'Your job #20260415-14 has been created successfully.', 0, '2026-04-15 13:11:55', '2026-04-15 13:11:55'),
(11, 5, 'Job Created', 'Your job #20260415-15 has been created successfully.', 0, '2026-04-15 13:12:30', '2026-04-15 13:12:30'),
(12, 5, 'Job Created', 'Your job #20260415-16 has been created successfully.', 0, '2026-04-15 13:32:40', '2026-04-15 13:32:40'),
(13, 5, 'Job Created', 'Your job #20260415-17 has been created successfully.', 0, '2026-04-15 13:36:05', '2026-04-15 13:36:05'),
(14, 5, 'Job Created', 'Your job #20260415-18 has been created successfully.', 0, '2026-04-15 14:03:57', '2026-04-15 14:03:57'),
(15, 5, 'Job Created', 'Your job #20260415-19 has been created successfully.', 0, '2026-04-15 14:05:19', '2026-04-15 14:05:19'),
(16, 5, 'Job Created', 'Your job #20260415-20 has been created successfully.', 0, '2026-04-15 14:09:57', '2026-04-15 14:09:57'),
(17, 5, 'Job Created', 'Your job #20260415-21 has been created successfully.', 0, '2026-04-15 14:17:31', '2026-04-15 14:17:31'),
(18, 1, 'Welcome!', 'Welcome to Mobile Maintenance. Your account is now active.', 0, '2026-04-15 15:42:19', '2026-04-15 15:42:19'),
(19, 1, 'Job Created', 'Your job #20260415-22 has been created successfully.', 0, '2026-04-15 16:11:10', '2026-04-15 16:11:10'),
(20, 1, 'Job Created', 'Your job #20260415-23 has been created successfully.', 0, '2026-04-15 16:13:02', '2026-04-15 16:13:02'),
(21, 1, 'Offer Accepted', 'Your offer for job ID 10 has been accepted.', 0, '2026-04-15 18:57:25', '2026-04-15 18:57:25'),
(22, 1, 'Job Created', 'Your job #20260415-24 has been created successfully.', 0, '2026-04-15 19:03:10', '2026-04-15 19:03:10'),
(23, 1, 'Offer Accepted', 'Your offer for job ID 10 has been accepted.', 0, '2026-04-15 19:03:51', '2026-04-15 19:03:51'),
(24, 1, 'Offer Accepted', 'Your offer for job ID 10 has been accepted.', 0, '2026-04-15 19:12:27', '2026-04-15 19:12:27'),
(25, 1, 'Job Created', 'Your job #20260415-25 has been created successfully.', 0, '2026-04-15 20:25:00', '2026-04-15 20:25:00'),
(26, 1, 'Offer Accepted', 'Your offer for job ID 10 has been accepted.', 0, '2026-04-16 12:20:46', '2026-04-16 12:20:46'),
(27, 1, 'Offer Accepted', 'Your offer for job ID 9 has been accepted.', 0, '2026-04-16 13:10:29', '2026-04-16 13:10:29'),
(28, 1, 'Offer Accepted', 'Your offer for job ID 9 has been accepted.', 0, '2026-04-16 13:14:43', '2026-04-16 13:14:43'),
(29, 1, 'Offer Accepted', 'Your offer for job ID 1 has been accepted.', 0, '2026-04-16 13:17:08', '2026-04-16 13:17:08'),
(30, 1, 'Offer Accepted', 'Your offer for job ID 2 has been accepted.', 0, '2026-04-16 13:21:14', '2026-04-16 13:21:14'),
(31, 1, 'Offer Accepted', 'Your offer for job ID 2 has been accepted.', 0, '2026-04-16 13:21:49', '2026-04-16 13:21:49'),
(32, 1, 'Offer Accepted', 'Your offer for job ID 5 has been accepted.', 0, '2026-04-16 15:53:48', '2026-04-16 15:53:48'),
(33, 1, 'Review Stored', 'Your review for job ID 2 has been stored successfully.', 0, '2026-04-16 18:35:24', '2026-04-16 18:35:24'),
(34, 6, 'Welcome!', 'Welcome to Mobile Maintenance. Your account is now active.', 0, '2026-04-16 19:01:11', '2026-04-16 19:01:11'),
(35, 6, 'Job Created', 'Your job #20260416-26 has been created successfully.', 0, '2026-04-16 19:03:47', '2026-04-16 19:03:47'),
(36, 6, 'Offer Accepted', 'Your offer for job ID 27 has been accepted.', 0, '2026-04-16 19:10:29', '2026-04-16 19:10:29'),
(37, 6, 'Job Created', 'Your job #20260416-27 has been created successfully.', 0, '2026-04-16 19:12:03', '2026-04-16 19:12:03'),
(38, 6, 'Offer Accepted', 'Your offer for job ID 27 has been accepted.', 0, '2026-04-16 19:26:46', '2026-04-16 19:26:46'),
(39, 6, 'Job Created', 'Your job #20260416-28 has been created successfully.', 0, '2026-04-16 19:48:16', '2026-04-16 19:48:16'),
(40, 6, 'Offer Accepted', 'Your offer for job ID 29 has been accepted.', 0, '2026-04-16 19:50:42', '2026-04-16 19:50:42'),
(41, 6, 'Job Created', 'Your job #20260416-29 has been created successfully.', 0, '2026-04-16 20:06:34', '2026-04-16 20:06:34'),
(42, 6, 'Offer Accepted', 'Your offer for job ID 30 has been accepted.', 0, '2026-04-16 20:09:08', '2026-04-16 20:09:08'),
(43, 6, 'Job Created', 'Your job #20260416-30 has been created successfully.', 0, '2026-04-16 20:20:27', '2026-04-16 20:20:27'),
(44, 6, 'Job Created', 'Your job #20260416-26 has been created successfully.', 0, '2026-04-16 20:25:16', '2026-04-16 20:25:16'),
(45, 6, 'Offer Accepted', 'Your offer for job ID 32 has been accepted.', 0, '2026-04-16 20:26:09', '2026-04-16 20:26:09'),
(46, 6, 'Job Created', 'Your job #20260416-27 has been created successfully.', 0, '2026-04-16 20:31:36', '2026-04-16 20:31:36'),
(47, 6, 'Offer Accepted', 'Your offer for job ID 33 has been accepted.', 0, '2026-04-16 20:32:39', '2026-04-16 20:32:39'),
(48, 6, 'Job Created', 'Your job #20260417-28 has been created successfully.', 0, '2026-04-17 13:17:38', '2026-04-17 13:17:38'),
(49, 6, 'Job Created', 'Your job #20260417-28 has been created successfully.', 0, '2026-04-17 14:42:19', '2026-04-17 14:42:19'),
(50, 6, 'Offer Accepted', 'Your offer for job ID 35 has been accepted.', 0, '2026-04-17 15:05:20', '2026-04-17 15:05:20'),
(51, 6, 'Job Created', 'Your job #20260417-29 has been created successfully.', 0, '2026-04-17 16:01:48', '2026-04-17 16:01:48'),
(52, 6, 'Offer Accepted', 'Your offer for job ID 36 has been accepted.', 0, '2026-04-17 16:26:26', '2026-04-17 16:26:26'),
(53, 1, 'Review Stored', 'Your review for job ID 32 has been stored successfully.', 0, '2026-04-17 16:44:02', '2026-04-17 16:44:02'),
(54, 6, 'Review Stored', 'Your review for job ID 4 has been stored successfully.', 0, '2026-04-17 12:21:56', '2026-04-17 12:21:56'),
(55, 6, 'Review Stored', 'Your review for job ID 3 has been stored successfully.', 0, '2026-04-17 12:23:53', '2026-04-17 12:23:53'),
(56, 6, 'Review Stored', 'Your review for job ID 2 has been stored successfully.', 0, '2026-04-17 12:27:15', '2026-04-17 12:27:15'),
(57, 6, 'Review Stored', 'Your review for job ID 5 has been stored successfully.', 0, '2026-04-17 12:27:26', '2026-04-17 12:27:26'),
(58, 6, 'Review Stored', 'Your review for job ID 7 has been stored successfully.', 0, '2026-04-17 12:34:45', '2026-04-17 12:34:45'),
(59, 1, 'Job Created', 'Your job #20260508-0 has been created successfully.', 0, '2026-05-08 15:18:51', '2026-05-08 15:18:51'),
(60, 1, 'Job Created', 'Your job #20260508-1 has been created successfully.', 0, '2026-05-08 15:23:56', '2026-05-08 15:23:56'),
(61, 1, 'Job Created', 'Your job #20260508-2 has been created successfully.', 0, '2026-05-08 15:34:03', '2026-05-08 15:34:03'),
(62, 1, 'Job Created', 'Your job #20260508-3 has been created successfully.', 0, '2026-05-08 15:34:36', '2026-05-08 15:34:36'),
(63, 1, 'Job Created', 'Your job #20260508-4 has been created successfully.', 0, '2026-05-08 15:35:32', '2026-05-08 15:35:32'),
(64, 1, 'Job Created', 'Your job #20260508-5 has been created successfully.', 0, '2026-05-08 15:35:51', '2026-05-08 15:35:51'),
(65, 1, 'Job Created', 'Your job #20260508-1 has been created successfully.', 0, '2026-05-08 15:37:10', '2026-05-08 15:37:10'),
(66, 1, 'Job Created', 'Your job #20260508-2 has been created successfully.', 0, '2026-05-08 15:37:38', '2026-05-08 15:37:38'),
(67, 1, 'Job Created', 'Your job #20260508-3 has been created successfully.', 0, '2026-05-08 15:41:36', '2026-05-08 15:41:36'),
(68, 1, 'Job Created', 'Your job #20260508-4 has been created successfully.', 0, '2026-05-08 15:44:02', '2026-05-08 15:44:02'),
(69, 1, 'Job Created', 'Your job #20260508-5 has been created successfully.', 0, '2026-05-08 15:45:16', '2026-05-08 15:45:16'),
(70, 1, 'Job Created', 'Your job #20260508-6 has been created successfully.', 0, '2026-05-08 15:45:39', '2026-05-08 15:45:39'),
(71, 1, 'Job Created', 'Your job #20260508-7 has been created successfully.', 0, '2026-05-08 15:45:54', '2026-05-08 15:45:54'),
(72, 1, 'Job Created', 'Your job #20260508-8 has been created successfully.', 0, '2026-05-08 15:46:26', '2026-05-08 15:46:26'),
(73, 1, 'Job Created', 'Your job #20260508-9 has been created successfully.', 0, '2026-05-08 15:46:45', '2026-05-08 15:46:45'),
(74, 1, 'Job Created', 'Your job #20260508-10 has been created successfully.', 0, '2026-05-08 15:51:27', '2026-05-08 15:51:27'),
(75, 1, 'Job Created', 'Your job #20260508-11 has been created successfully.', 0, '2026-05-08 15:51:54', '2026-05-08 15:51:54'),
(76, 2, 'Job Created', 'Your job #20260509-2 has been created successfully.', 0, '2026-05-09 16:47:31', '2026-05-09 16:47:31'),
(77, 1, 'Job Created', 'Your job #20260509-3 has been created successfully.', 0, '2026-05-09 16:52:56', '2026-05-09 16:52:56'),
(78, 1, 'Job Created', 'Your job #20260509-4 has been created successfully.', 0, '2026-05-09 16:54:38', '2026-05-09 16:54:38'),
(79, 2, 'Job Created', 'Your job #20260509-5 has been created successfully.', 0, '2026-05-09 16:55:19', '2026-05-09 16:55:19'),
(80, 2, 'Job Created', 'Your job #20260509-6 has been created successfully.', 0, '2026-05-09 17:10:15', '2026-05-09 17:10:15'),
(81, 2, 'Job Created', 'Your job #20260509-7 has been created successfully.', 0, '2026-05-09 17:10:40', '2026-05-09 17:10:40'),
(82, 2, 'Job Created', 'Your job #20260509-8 has been created successfully.', 0, '2026-05-09 17:33:05', '2026-05-09 17:33:05'),
(83, 2, 'Job Created', 'Your job #20260509-9 has been created successfully.', 0, '2026-05-09 17:33:23', '2026-05-09 17:33:23'),
(84, 2, 'Job Created', 'Your job #20260509-10 has been created successfully.', 0, '2026-05-09 17:59:50', '2026-05-09 17:59:50'),
(85, 2, 'Job Created', 'Your job #20260509-11 has been created successfully.', 0, '2026-05-09 18:06:00', '2026-05-09 18:06:00'),
(86, 2, 'Job Created', 'Your job #20260509-12 has been created successfully.', 0, '2026-05-09 18:06:10', '2026-05-09 18:06:10'),
(87, 2, 'Job Created', 'Your job #20260509-13 has been created successfully.', 0, '2026-05-09 20:10:08', '2026-05-09 20:10:08'),
(88, 2, 'Job Created', 'Your job #20260509-14 has been created successfully.', 0, '2026-05-09 20:54:35', '2026-05-09 20:54:35'),
(89, 10, 'Welcome!', 'Welcome to Mobile Maintenance. Your account is now active.', 0, '2026-05-11 16:14:44', '2026-05-11 16:14:44'),
(90, 2, 'Job Created', 'Your job #20260511-15 has been created successfully.', 0, '2026-05-11 17:01:56', '2026-05-11 17:01:56'),
(91, 2, 'New Job Offer', 'You have a new job offer. Please check your Mobile App.', 0, '2026-05-11 17:14:54', '2026-05-11 17:14:54'),
(92, 2, 'Job Created', 'Your job #20260511-16 has been created successfully.', 0, '2026-05-11 17:16:47', '2026-05-11 17:16:47'),
(93, 2, 'Job Created', 'Your job #20260511-17 has been created successfully.', 0, '2026-05-11 17:18:27', '2026-05-11 17:18:27'),
(94, 2, 'Job Created', 'Your job #20260511-18 has been created successfully.', 0, '2026-05-11 17:24:23', '2026-05-11 17:24:23'),
(95, 2, 'Review Stored', 'Your review for job ID 33 has been stored successfully.', 0, '2026-05-11 17:34:21', '2026-05-11 17:34:21'),
(96, 2, 'New Job Offer', 'You have a new job offer. Please check your Mobile App.', 0, '2026-05-11 17:53:18', '2026-05-11 17:53:18'),
(97, 2, 'Offer Accepted', 'Your offer for job ID 18 has been accepted.', 0, '2026-05-11 17:53:39', '2026-05-11 17:53:39'),
(98, 2, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-05-11 17:54:16', '2026-05-11 17:54:16'),
(99, 2, 'Job Status Update', 'Your job has been updated to: Under Review. Please check the app for more details.', 0, '2026-05-11 17:54:39', '2026-05-11 17:54:39'),
(100, 2, 'Job Status Update', 'Your job has been updated to: Under Repair. Please check the app for more details.', 0, '2026-05-11 17:54:59', '2026-05-11 17:54:59'),
(101, 2, 'Job Status Update', 'Your job has been updated to: Ready For Pickup. Please check the app for more details.', 0, '2026-05-11 18:00:05', '2026-05-11 18:00:05'),
(102, 2, 'Job Status Update', 'Your job has been updated to: Delivered. Please check the app for more details.', 0, '2026-05-11 18:31:25', '2026-05-11 18:31:25'),
(103, 9, 'Job Created', 'Your job #20260512-19 has been created successfully.', 0, '2026-05-12 08:29:39', '2026-05-12 08:29:39'),
(104, 9, 'New Job Offer', 'You have a new job offer. Please check your Mobile App.', 0, '2026-05-12 08:32:14', '2026-05-12 08:32:14'),
(105, 9, 'Job Offer Updated', 'Your job offer has been updated. Please check your Mobile App.', 0, '2026-05-12 08:34:06', '2026-05-12 08:34:06'),
(106, 9, 'Offer Accepted', 'Your offer for job ID 35 has been accepted.', 0, '2026-05-12 08:37:06', '2026-05-12 08:37:06'),
(107, 9, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-05-12 08:38:44', '2026-05-12 08:38:44'),
(108, 9, 'Job Status Update', 'Your job has been updated to: Delivered. Please check the app for more details.', 0, '2026-05-12 08:39:40', '2026-05-12 08:39:40'),
(109, 2, 'Job Created', 'Your job #20260514-20 has been created successfully.', 0, '2026-05-14 22:09:10', '2026-05-14 22:09:10'),
(110, 2, 'Job Created', 'Your job #20260514-21 has been created successfully.', 0, '2026-05-14 22:47:08', '2026-05-14 22:47:08'),
(111, 2, 'Job Created', 'Your job #20260516-22 has been created successfully.', 0, '2026-05-16 16:48:07', '2026-05-16 16:48:07'),
(112, 2, 'Job Created', 'Your job #20260523-23 has been created successfully.', 0, '2026-05-23 17:15:45', '2026-05-23 17:15:45'),
(113, 2, 'Job Created', 'Your job #20260523-24 has been created successfully.', 0, '2026-05-23 19:38:50', '2026-05-23 19:38:50'),
(114, 2, 'Job Created', 'Your job #20260523-25 has been created successfully.', 0, '2026-05-23 20:33:39', '2026-05-23 20:33:39'),
(115, 2, 'New Job Offer', 'You have a new job offer. Please check your Mobile App.', 0, '2026-05-23 20:34:12', '2026-05-23 20:34:12'),
(116, 2, 'Offer Accepted', 'Your offer for job ID 41 has been accepted.', 0, '2026-05-23 20:34:38', '2026-05-23 20:34:38'),
(117, 2, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-05-23 20:35:48', '2026-05-23 20:35:48'),
(118, 2, 'Job Created', 'Your job #20260523-26 has been created successfully.', 0, '2026-05-23 22:40:35', '2026-05-23 22:40:35'),
(119, 2, 'Job Created', 'Your job #20260525-27 has been created successfully.', 0, '2026-05-25 19:25:05', '2026-05-25 19:25:05'),
(120, 2, 'Job Created', 'Your job #20260525-28 has been created successfully.', 0, '2026-05-25 20:00:25', '2026-05-25 20:00:25'),
(121, 2, 'New Job Offer', 'You have a new job offer. Please check your Mobile App.', 0, '2026-06-01 16:52:34', '2026-06-01 16:52:34'),
(122, 2, 'Job Offer Updated', 'Your job offer has been updated. Please check your Mobile App.', 0, '2026-06-01 16:57:03', '2026-06-01 16:57:03'),
(123, 2, 'New Job Offer', 'You have a new job offer. Please check your Mobile App.', 0, '2026-06-01 16:57:53', '2026-06-01 16:57:53'),
(124, 2, 'Job Offer Updated', 'Your job offer has been updated. Please check your Mobile App.', 0, '2026-06-01 17:42:50', '2026-06-01 17:42:50'),
(125, 2, 'New Job Offer', 'You have a new job offer. Please check your Mobile App.', 0, '2026-06-01 17:43:23', '2026-06-01 17:43:23'),
(126, 2, 'Job Offer Updated', 'Your job offer has been updated. Please check your Mobile App.', 0, '2026-06-12 15:51:42', '2026-06-12 15:51:42'),
(127, 14, 'Welcome!', 'Welcome to Mobile Maintenance. Your account is now active.', 0, '2026-07-04 11:35:38', '2026-07-04 11:35:38'),
(128, 2, 'Job Created', 'Your job #20260706-28 has been created successfully.', 0, '2026-07-06 16:42:52', '2026-07-06 16:42:52'),
(129, 2, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-07-06 16:47:52', '2026-07-06 16:47:52'),
(130, 8, 'Welcome!', 'Welcome to Mobile Maintenance. Your account is now active.', 0, '2026-07-06 20:30:54', '2026-07-06 20:30:54'),
(131, 2, 'Job Status Update', 'Your job has been updated to: Under Review. Please check the app for more details.', 0, '2026-07-06 21:44:18', '2026-07-06 21:44:18'),
(132, 2, 'Job Status Update', 'Your job has been updated to: Delivered. Please check the app for more details.', 0, '2026-07-06 21:44:24', '2026-07-06 21:44:24'),
(133, 2, 'Job Created', 'Your job #20260722-28 has been created successfully.', 0, '2026-07-22 12:03:59', '2026-07-22 12:03:59'),
(134, 2, 'Job Created', 'Your job #20260723-29 has been created successfully.', 0, '2026-07-23 07:04:30', '2026-07-23 07:04:30'),
(135, 2, 'Job Created', 'Your job #20260807-30 has been created successfully.', 0, '2026-08-07 12:05:10', '2026-08-07 12:05:10'),
(136, 2, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-08-07 12:21:31', '2026-08-07 12:21:31'),
(137, 2, 'Job Status Update', 'Your job has been updated to: Under Repair. Please check the app for more details.', 0, '2026-08-07 12:25:58', '2026-08-07 12:25:58'),
(138, 2, 'Job Status Update', 'Your job has been updated to: Ready For Pickup. Please check the app for more details.', 0, '2026-08-07 12:27:19', '2026-08-07 12:27:19'),
(139, 2, 'Job Status Update', 'Your job has been updated to: Under Repair. Please check the app for more details.', 0, '2026-08-07 12:33:24', '2026-08-07 12:33:24'),
(140, 2, 'Job Status Update', 'Your job has been updated to: Delivered. Please check the app for more details.', 0, '2026-08-07 12:34:00', '2026-08-07 12:34:00'),
(141, 2, 'Review Stored', 'Your review for job ID 48 has been stored successfully.', 0, '2026-08-07 13:44:55', '2026-08-07 13:44:55'),
(142, 2, 'Review Stored', 'Your review for job ID 33 has been stored successfully.', 0, '2026-08-07 13:53:10', '2026-08-07 13:53:10'),
(143, 2, 'Review Stored', 'Your review for job ID 48 has been stored successfully.', 0, '2026-08-07 13:56:07', '2026-08-07 13:56:07'),
(144, 2, 'Review Stored', 'Your review for job ID 33 has been stored successfully.', 0, '2026-08-07 13:56:44', '2026-08-07 13:56:44'),
(145, 2, 'Job Created', 'Your job #20260818-31 has been created successfully.', 0, '2026-08-18 12:45:12', '2026-08-18 12:45:12'),
(146, 2, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-08-18 12:52:00', '2026-08-18 12:52:00'),
(147, 2, 'Job Status Update', 'Your job has been updated to: Delivered. Please check the app for more details.', 0, '2026-08-18 12:52:19', '2026-08-18 12:52:19'),
(148, 2, 'Review Stored', 'Your review for job ID 49 has been stored successfully.', 0, '2026-08-18 12:53:29', '2026-08-18 12:53:29'),
(149, 2, 'Job Created', 'Your job #20260818-32 has been created successfully.', 0, '2026-08-18 12:54:58', '2026-08-18 12:54:58'),
(150, 2, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-08-18 12:55:22', '2026-08-18 12:55:22'),
(151, 2, 'Job Status Update', 'Your job has been updated to: Delivered. Please check the app for more details.', 0, '2026-08-18 12:55:29', '2026-08-18 12:55:29'),
(152, 2, 'Review Stored', 'Your review for job ID 50 has been stored successfully.', 0, '2026-08-18 12:57:55', '2026-08-18 12:57:55'),
(153, 2, 'Job Created', 'Your job #20260818-33 has been created successfully.', 0, '2026-08-18 16:09:40', '2026-08-18 16:09:40'),
(154, 2, 'Job Created', 'Your job #20260818-34 has been created successfully.', 0, '2026-08-18 16:11:52', '2026-08-18 16:11:52'),
(155, 2, 'Job Created', 'Your job #20260818-35 has been created successfully.', 0, '2026-08-18 16:12:37', '2026-08-18 16:12:37'),
(156, 2, 'Job Created', 'Your job #20260824-36 has been created successfully.', 0, '2026-08-24 11:03:13', '2026-08-24 11:03:13'),
(157, 2, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-08-24 11:18:21', '2026-08-24 11:18:21'),
(158, 2, 'Job Status Update', 'Your job has been updated to: Under Review. Please check the app for more details.', 0, '2026-08-24 11:19:14', '2026-08-24 11:19:14'),
(159, 2, 'Job Status Update', 'Your job has been updated to: Delivered. Please check the app for more details.', 0, '2026-08-24 11:19:23', '2026-08-24 11:19:23'),
(160, 2, 'Review Stored', 'Your review for job ID 54 has been stored successfully.', 0, '2026-08-24 11:20:24', '2026-08-24 11:20:24'),
(161, 2, 'Job Created', 'Your job #20260824-37 has been created successfully.', 0, '2026-08-24 11:22:57', '2026-08-24 11:22:57'),
(162, 2, 'Job Created', 'Your job #20260827-38 has been created successfully.', 0, '2026-08-27 12:13:40', '2026-08-27 12:13:40'),
(163, 2, 'Job Created', 'Your job #20260827-39 has been created successfully.', 0, '2026-08-27 12:14:50', '2026-08-27 12:14:50'),
(164, 2, 'Job Created', 'Your job #20260827-40 has been created successfully.', 0, '2026-08-27 12:15:30', '2026-08-27 12:15:30'),
(165, 2, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-08-27 12:16:57', '2026-08-27 12:16:57'),
(166, 2, 'Job Status Update', 'Your job has been updated to: Delivered. Please check the app for more details.', 0, '2026-08-27 12:17:12', '2026-08-27 12:17:12'),
(167, 2, 'Job Created', 'Your job #20260827-41 has been created successfully.', 0, '2026-08-27 12:18:48', '2026-08-27 12:18:48'),
(168, 2, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-08-27 12:21:18', '2026-08-27 12:21:18'),
(169, 2, 'Job Status Update', 'Your job has been updated to: Under Review. Please check the app for more details.', 0, '2026-08-27 12:30:04', '2026-08-27 12:30:04'),
(170, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-08-27 12:43:38', '2026-08-27 12:43:38'),
(171, 2, 'Job Created', 'Your job #20260827-42 has been created successfully.', 0, '2026-08-27 12:50:26', '2026-08-27 12:50:26'),
(172, 2, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-08-27 12:59:39', '2026-08-27 12:59:39'),
(173, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:33:17', '2026-09-11 18:33:17'),
(174, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:33:25', '2026-09-11 18:33:25'),
(175, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:33:32', '2026-09-11 18:33:32'),
(176, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:33:38', '2026-09-11 18:33:38'),
(177, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:33:43', '2026-09-11 18:33:43'),
(178, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:33:48', '2026-09-11 18:33:48'),
(179, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:33:54', '2026-09-11 18:33:54'),
(180, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:34:00', '2026-09-11 18:34:00'),
(181, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:34:06', '2026-09-11 18:34:06'),
(182, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:34:11', '2026-09-11 18:34:11'),
(183, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:34:17', '2026-09-11 18:34:17'),
(184, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:34:30', '2026-09-11 18:34:30'),
(185, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:34:35', '2026-09-11 18:34:35'),
(186, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:34:41', '2026-09-11 18:34:41'),
(187, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:34:46', '2026-09-11 18:34:46'),
(188, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:34:52', '2026-09-11 18:34:52'),
(189, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:34:57', '2026-09-11 18:34:57'),
(190, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:35:04', '2026-09-11 18:35:04'),
(191, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:35:10', '2026-09-11 18:35:10'),
(192, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:35:15', '2026-09-11 18:35:15'),
(193, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:35:21', '2026-09-11 18:35:21'),
(194, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:35:29', '2026-09-11 18:35:29'),
(195, 1, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:35:36', '2026-09-11 18:35:36'),
(196, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:35:49', '2026-09-11 18:35:49'),
(197, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:36:06', '2026-09-11 18:36:06'),
(198, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:38:10', '2026-09-11 18:38:10'),
(199, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:38:15', '2026-09-11 18:38:15'),
(200, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:38:21', '2026-09-11 18:38:21'),
(201, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:38:26', '2026-09-11 18:38:26'),
(202, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:38:30', '2026-09-11 18:38:30'),
(203, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:38:35', '2026-09-11 18:38:35'),
(204, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:38:40', '2026-09-11 18:38:40'),
(205, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:38:45', '2026-09-11 18:38:45'),
(206, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:38:50', '2026-09-11 18:38:50'),
(207, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:38:58', '2026-09-11 18:38:58'),
(208, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:39:04', '2026-09-11 18:39:04'),
(209, 9, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:39:08', '2026-09-11 18:39:08'),
(210, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:39:14', '2026-09-11 18:39:14'),
(211, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:39:19', '2026-09-11 18:39:19'),
(212, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:39:23', '2026-09-11 18:39:23'),
(213, 2, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:39:28', '2026-09-11 18:39:28'),
(214, 1, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:39:33', '2026-09-11 18:39:33'),
(215, 1, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-09-11 18:39:38', '2026-09-11 18:39:38'),
(216, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:39:54', '2026-09-11 18:39:54'),
(217, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:39:59', '2026-09-11 18:39:59'),
(218, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:40:05', '2026-09-11 18:40:05'),
(219, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:41:27', '2026-09-11 18:41:27'),
(220, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:41:28', '2026-09-11 18:41:28'),
(221, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:41:33', '2026-09-11 18:41:33'),
(222, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:41:38', '2026-09-11 18:41:38'),
(223, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:41:52', '2026-09-11 18:41:52'),
(224, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:42:00', '2026-09-11 18:42:00'),
(225, 6, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:42:04', '2026-09-11 18:42:04'),
(226, 1, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:42:09', '2026-09-11 18:42:09'),
(227, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:42:14', '2026-09-11 18:42:14'),
(228, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:42:18', '2026-09-11 18:42:18'),
(229, 1, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:42:23', '2026-09-11 18:42:23'),
(230, 1, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:42:28', '2026-09-11 18:42:28'),
(231, 1, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:42:33', '2026-09-11 18:42:33'),
(232, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:42:38', '2026-09-11 18:42:38'),
(233, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:42:43', '2026-09-11 18:42:43'),
(234, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:42:55', '2026-09-11 18:42:55'),
(235, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:42:59', '2026-09-11 18:42:59'),
(236, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:43:04', '2026-09-11 18:43:04'),
(237, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:43:09', '2026-09-11 18:43:09'),
(238, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:43:09', '2026-09-11 18:43:09'),
(239, 1, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:43:16', '2026-09-11 18:43:16'),
(240, 9, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:43:24', '2026-09-11 18:43:24'),
(241, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:43:32', '2026-09-11 18:43:32'),
(242, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:43:36', '2026-09-11 18:43:36'),
(243, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:43:41', '2026-09-11 18:43:41'),
(244, 1, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:43:46', '2026-09-11 18:43:46'),
(245, 6, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:43:51', '2026-09-11 18:43:51'),
(246, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-09-11 18:43:56', '2026-09-11 18:43:56'),
(247, 17, 'Job Created', 'Your job #20260914-0 has been created successfully.', 0, '2026-09-14 18:32:42', '2026-09-14 18:32:42'),
(248, 17, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-09-14 18:33:56', '2026-09-14 18:33:56'),
(249, 28, 'Job Created', 'Your job #20261023-1 has been created successfully.', 0, '2026-10-23 19:19:49', '2026-10-23 19:19:49'),
(250, 25, 'Job Created', 'Your job #20261024-2 has been created successfully.', 0, '2026-10-24 14:40:50', '2026-10-24 14:40:50'),
(251, 25, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-10-24 18:21:26', '2026-10-24 18:21:26'),
(252, 25, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-10-24 18:21:27', '2026-10-24 18:21:27'),
(253, 25, 'Job Status Update', 'Your job has been updated to: Delivered. Please check the app for more details.', 0, '2026-10-24 18:21:41', '2026-10-24 18:21:41'),
(254, 28, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-10-24 18:22:33', '2026-10-24 18:22:33'),
(255, 28, 'Job Status Update', 'Your job has been updated to: Ready For Pickup. Please check the app for more details.', 0, '2026-10-24 18:23:25', '2026-10-24 18:23:25'),
(256, 28, 'Job Status Update', 'Your job has been updated to: Delivered. Please check the app for more details.', 0, '2026-10-24 18:23:36', '2026-10-24 18:23:36'),
(257, 28, 'Job Created', 'Your job #20261024-3 has been created successfully.', 0, '2026-10-24 18:40:36', '2026-10-24 18:40:36'),
(258, 28, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-10-26 07:30:52', '2026-10-26 07:30:52'),
(259, 28, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-10-26 07:30:54', '2026-10-26 07:30:54'),
(260, 28, 'Job Status Update', 'Your job has been updated to: Under Repair. Please check the app for more details.', 0, '2026-10-26 07:31:01', '2026-10-26 07:31:01'),
(261, 17, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-11-04 08:08:51', '2026-11-04 08:08:51'),
(262, 17, 'Job Deleted', 'Your job listing has been deleted.', 0, '2026-11-04 08:11:31', '2026-11-04 08:11:31'),
(263, 2, 'Job Created', 'Your job #20261110-0 has been created successfully.', 0, '2026-11-10 07:06:16', '2026-11-10 07:06:16'),
(264, 2, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-11-10 07:07:38', '2026-11-10 07:07:38'),
(265, 2, 'Job Status Update', 'Your job has been updated to: Under Repair. Please check the app for more details.', 0, '2026-11-10 07:09:35', '2026-11-10 07:09:35'),
(266, 2, 'Job Status Update', 'Your job has been updated to: Ready For Pickup. Please check the app for more details.', 0, '2026-11-10 07:11:47', '2026-11-10 07:11:47'),
(267, 2, 'Job Status Update', 'Your job has been updated to: Delivered. Please check the app for more details.', 0, '2026-11-10 07:12:36', '2026-11-10 07:12:36'),
(268, 2, 'Job Created', 'Your job #20261110-1 has been created successfully.', 0, '2026-11-10 07:13:15', '2026-11-10 07:13:15'),
(269, 2, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-11-10 07:14:13', '2026-11-10 07:14:13'),
(270, 2, 'Job Status', 'Your job status has been updated to: Under Review. Please check the app for more details.', 0, '2026-11-10 07:14:15', '2026-11-10 07:14:15'),
(271, 2, 'Job Status Update', 'Your job has been updated to: Ready For Pickup. Please check the app for more details.', 0, '2026-11-10 07:17:38', '2026-11-10 07:17:38'),
(272, 2, 'Job Status Update', 'Your job has been updated to: Delivered. Please check the app for more details.', 0, '2026-11-10 07:17:48', '2026-11-10 07:17:48'),
(273, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-11-10 07:25:17', '2026-11-10 07:25:17'),
(274, 2, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-11-10 07:25:21', '2026-11-10 07:25:21'),
(275, 28, 'Job Offer Deleted', 'Your job offer has been deleted.', 0, '2026-11-10 07:25:56', '2026-11-10 07:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_histories`
--

CREATE TABLE `price_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_application_id` bigint(20) UNSIGNED NOT NULL,
  `old_price` decimal(10,2) NOT NULL,
  `new_price` decimal(10,2) NOT NULL,
  `changed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receipt_records`
--

CREATE TABLE `receipt_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_application_id` bigint(20) UNSIGNED NOT NULL,
  `receipt_type` varchar(255) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `shop_phone` varchar(255) DEFAULT NULL,
  `shop_address` text DEFAULT NULL,
  `receipt_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`receipt_data`)),
  `customer_signature` longtext NOT NULL,
  `technician_signature` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `job_id` longtext NOT NULL,
  `rating` longtext NOT NULL,
  `review` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `shop_id`, `job_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(4, 1, 1, '32', '5', 'Great service, highly recommend!', '2026-04-17 16:44:02', '2026-04-17 16:44:02'),
(5, 6, 8, '4', '5', 'Great service, highly recommend!', '2026-04-17 12:21:56', '2026-04-17 12:21:56'),
(6, 6, 2, '3', '5', 'Great service, highly recommend!', '2026-04-17 12:23:53', '2026-04-17 12:23:53'),
(7, 6, 4, '2', '5', 'Great service, highly recommend!', '2026-04-17 12:27:15', '2026-04-17 12:27:15'),
(16, 2, 1, '50', '5', 'great service', '2026-08-18 12:57:55', '2026-08-18 12:57:55');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `cover_image` longtext NOT NULL DEFAULT 'default.png',
  `status` longtext NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `cover_image`, `status`, `created_at`, `updated_at`, `sort_order`) VALUES
(30, 'J200', 'LCD J200', '17938157376aeb74b9d82e6.png', 'active', '2026-11-04 18:08:57', '2026-11-05 16:57:39', 9),
(31, 'J260', 'LCD J260', '17938160636aeb75ff2dc1c.png', 'active', '2026-11-04 18:14:23', '2026-11-05 16:57:39', 8),
(32, 'J320', 'lCD J320', '17938163536aeb77217d105.png', 'active', '2026-11-04 18:19:13', '2026-11-04 18:42:09', 9),
(33, 'J400', 'LCD J 400', '17938165526aeb77e8d6f01.png', 'active', '2026-11-04 18:22:32', '2026-11-04 18:42:09', 8),
(34, 'J500', 'LCD J500', '17938166176aeb7829c5735.png', 'active', '2026-11-04 18:23:37', '2026-11-05 16:36:27', 9),
(35, 'J510', 'LCD J510', '17938167016aeb787dba469.png', 'active', '2026-11-04 18:25:01', '2026-11-05 16:36:27', 8),
(36, 'J610 - J410', 'LCD J610 - J410', '17938171366aeb7a30a88cc.png', 'active', '2026-11-04 18:32:16', '2026-11-05 16:36:27', 7),
(37, 'G570 - J5 prime', 'LCD G570 - J5 prime', '17938172796aeb7abf604e0.png', 'active', '2026-11-04 18:34:39', '2026-11-05 16:36:27', 6),
(38, 'J700', 'LCD J700', '17938173426aeb7afe78c5c.png', 'active', '2026-11-04 18:35:42', '2026-11-05 16:36:27', 5),
(39, 'G610 - J7 prime', 'LCD G610 - J7 prime', '17938174456aeb7b65a0551.png', 'active', '2026-11-04 18:37:25', '2026-11-06 07:49:11', 8),
(40, 'J530 - J5 pro', 'LCD J530 - J5 pro', '17938175516aeb7bcfe0bea.png', 'active', '2026-11-04 18:39:11', '2026-11-06 07:49:11', 5),
(41, 'J370 - J7 pro', 'LCD J730 J7 Pro', '17938176496aeb7c317474c.png', 'active', '2026-11-04 18:40:49', '2026-11-05 16:57:39', 7),
(42, 'A01', 'LCD A01', '17938966486aecb0c8f0ab5.png', 'active', '2026-11-05 16:37:28', '2026-11-05 16:57:39', 6),
(43, 'A02s - A03s - A03 - A04E', 'LCD A02s - A03s - A03 - A04E', '17938967646aecb13ccee96.png', 'active', '2026-11-05 16:39:24', '2026-11-06 07:49:11', 7),
(44, 'A04', 'LCD A04', '17938968446aecb18cb2c37.png', 'active', '2026-11-05 16:40:44', '2026-11-05 16:57:39', 5),
(45, 'A03 core', 'LCD A03 CORE', '17938971486aecb2bce1e05.png', 'active', '2026-11-05 16:45:48', '2026-11-06 07:49:11', 4),
(46, 'A05', 'LCD A05', '17938972146aecb2fe0f29e.png', 'active', '2026-11-05 16:46:54', '2026-11-06 07:49:11', 2),
(47, 'A05s', 'LCD A05s', '17938972686aecb3346c47f.png', 'active', '2026-11-05 16:47:48', '2026-11-06 07:49:11', 0),
(48, 'A06', 'LCD A06', '17938974016aecb3b958a67.png', 'active', '2026-11-05 16:50:01', '2026-11-05 16:57:39', 0),
(49, 'A125 - A127 - A02 - M125 - A127', 'LCD A125 - A127 - A02 - M125 - A127', '17938979076aecb5b351fbe.png', 'active', '2026-11-05 16:58:27', '2026-11-05 16:58:27', 0),
(50, 'A10', 'LCD A10', '17938979766aecb5f844a73.png', 'active', '2026-11-05 16:59:36', '2026-11-05 16:59:36', 0),
(51, 'A10s', 'LCD A10s - A107', '17938980356aecb6333e234.png', 'active', '2026-11-05 17:00:35', '2026-11-05 17:00:35', 0),
(52, 'A11 - M11', 'LCD A11 - M11', '17938981146aecb682ac641.png', 'active', '2026-11-05 17:01:54', '2026-11-05 17:01:54', 0),
(53, 'A13 4G - M13', 'LCD A13 4G - M13', '17938983246aecb754112f3.png', 'active', '2026-11-05 17:05:24', '2026-11-05 17:05:24', 0),
(54, 'A13 5G - A04s', 'LCD A13 5G - A04s', '17938984056aecb7a5d2589.png', 'active', '2026-11-05 17:06:45', '2026-11-05 17:06:45', 0),
(55, 'A14 4G', 'LCD A14 4G', '17938985296aecb82106f8a.png', 'active', '2026-11-05 17:08:49', '2026-11-05 17:08:49', 0),
(56, 'A14 5G', 'LCD A14 5G', '17938985806aecb854a64bf.png', 'active', '2026-11-05 17:09:40', '2026-11-05 17:09:40', 0),
(57, 'A15', 'LCD A15', '17938986486aecb89847b9f.png', 'active', '2026-11-05 17:10:48', '2026-11-05 17:10:48', 0),
(58, 'A16', 'LCD A16 4G', '17938987206aecb8e05bc1a.png', 'active', '2026-11-05 17:12:00', '2026-11-05 17:12:00', 0),
(59, 'A16 5G', 'LCD A16 5G', '17938988416aecb9592654d.png', 'active', '2026-11-05 17:14:01', '2026-11-05 17:14:01', 0),
(60, 'A20', 'LCD A20', '17939024406aecc768a72c3.png', 'active', '2026-11-05 18:14:00', '2026-11-05 18:14:00', 0),
(61, 'A20s', 'LCD A20s', '17939025116aecc7af35aa2.png', 'active', '2026-11-05 18:15:11', '2026-11-05 18:15:11', 0),
(62, 'A21s', 'LCD A21s', '17939025766aecc7f0d8ff0.png', 'active', '2026-11-05 18:16:16', '2026-11-05 18:16:16', 0),
(63, 'A23 4G', 'LCD A23 4G', '17939026636aecc847594a3.png', 'active', '2026-11-05 18:17:43', '2026-11-05 18:17:43', 0),
(64, 'A25 - A24 4G - M34 5G', 'LCD A25 - A24 4G - M34 5G', '17939029696aecc979af06a.png', 'active', '2026-11-05 18:22:49', '2026-11-05 18:22:49', 0),
(65, 'A30s', 'LCD A30s', '17939031376aecca218cf75.png', 'active', '2026-11-05 18:25:37', '2026-11-05 18:25:37', 0),
(66, 'A31', 'LCD A31', '17939031906aecca5643714.png', 'active', '2026-11-05 18:26:30', '2026-11-05 18:26:54', 0),
(67, 'A32 4G', 'LCD A32 4G', '17939032816aeccab1e4a8e.png', 'active', '2026-11-05 18:28:01', '2026-11-05 18:28:01', 0),
(68, 'A34', 'LCD A34', '17939033436aeccaef5dbe3.png', 'active', '2026-11-05 18:29:03', '2026-11-05 18:29:03', 0),
(69, 'A35', 'LCD A35', '17939033886aeccb1c083e5.png', 'active', '2026-11-05 18:29:48', '2026-11-05 18:29:48', 0),
(70, 'A50 - A30', 'LCD A50 - A30', '17939034746aeccb721350d.png', 'active', '2026-11-05 18:31:14', '2026-11-05 18:31:14', 0),
(71, 'A51', 'LCD A51', '17939035436aeccbb7d544a.png', 'active', '2026-11-05 18:32:23', '2026-11-06 09:08:21', 7),
(72, 'A52', 'LCD A52 5G', '17939036316aeccc0f36dc0.png', 'active', '2026-11-05 18:33:51', '2026-11-06 09:08:21', 8),
(73, 'A53 5G', 'LCD A53 5G', '17939037046aeccc585ebd0.png', 'active', '2026-11-05 18:35:04', '2026-11-06 09:08:21', 6),
(74, 'A54 5G', 'LCD A54 5G', '17939037696aeccc9942679.png', 'active', '2026-11-05 18:36:09', '2026-11-06 09:08:21', 9),
(75, 'A520', 'LCD A520', '17939038896aeccd11a7409.png', 'active', '2026-11-05 18:38:09', '2026-11-06 09:08:21', 5),
(76, 'A605', 'LCD A605', '17939039636aeccd5b736fc.png', 'active', '2026-11-05 18:39:23', '2026-11-06 07:45:27', 9),
(77, 'A71', 'LCD A71', '17939040586aeccdbaac26e.png', 'active', '2026-11-05 18:40:58', '2026-11-06 07:45:27', 8),
(78, 'A72 4G', 'LCD A72 4G', '17939041386aecce0a6eef6.png', 'active', '2026-11-05 18:42:18', '2026-11-06 07:45:27', 7),
(79, 'A750', 'LCD A750', '17939042216aecce5d33ca1.png', 'active', '2026-11-05 18:43:41', '2026-11-06 07:45:27', 6),
(80, 'A920', 'LCD A920', '17939042786aecce96df69d.png', 'active', '2026-11-05 18:44:38', '2026-11-06 07:49:11', 9),
(81, 'IPHONE 6G', 'LCD IPHONE 6G', '17939504366aed82e49f899.png', 'active', '2026-11-06 07:33:56', '2026-11-06 09:08:21', 4),
(82, 'IPHONE 6G PLUS', 'LCD 6G PLUS', '17939505406aed834c3e37e.png', 'active', '2026-11-06 07:35:40', '2026-11-06 07:49:11', 6),
(83, '6S', 'LCD 6S', '17939505956aed8383dad7d.png', 'active', '2026-11-06 07:36:35', '2026-11-06 07:49:11', 3),
(84, '7 PLUS', 'LCD 7 PLUS', '17939506926aed83e47065c.png', 'active', '2026-11-06 07:38:12', '2026-11-06 07:49:11', 1),
(85, '8 PLUS', 'LCD 8 PLUS', '17939508506aed8482d0c48.png', 'active', '2026-11-06 07:40:50', '2026-11-06 07:45:27', 1),
(86, 'IPHONE X', 'LCD IPHONE X', '17939514956aed870714dc4.png', 'active', '2026-11-06 07:51:35', '2026-11-06 09:08:21', 3),
(87, 'IPHONE XS', 'LCD IPHONE Xs', '17939515796aed875b4fda8.png', 'active', '2026-11-06 07:52:59', '2026-11-06 09:08:21', 2),
(88, 'IPHONE Xr', 'LCD IPHONE Xr', '17939516526aed87a4ae39e.png', 'active', '2026-11-06 07:54:12', '2026-11-06 09:08:21', 1),
(89, 'IPHONE Xs MAX', 'LCD IPHONE Xs MAX', '17939518346aed885ac4724.png', 'active', '2026-11-06 07:57:14', '2026-11-06 09:08:21', 0),
(90, 'IPHONE 11', 'LCD IPHONE 11', '17939519376aed88c154c9b.png', 'active', '2026-11-06 07:58:57', '2026-11-06 07:58:57', 0),
(91, 'IPHONE 11 PRO MAX', 'LCD IPHONE 11 PRO MAX', '17939520286aed891cbfa8a.png', 'active', '2026-11-06 08:00:28', '2026-11-06 08:00:28', 0),
(92, 'IPHONE 12 - 12 PRO', 'LCD IPHONE 12 - 12 PRO', '17939532576aed8de99c625.png', 'active', '2026-11-06 08:20:57', '2026-11-06 08:20:57', 0),
(93, 'IPHONE 12 PRO MAX', 'LCD IPHONE 12 PRO MAX', '17939533366aed8e384da64.png', 'active', '2026-11-06 08:22:16', '2026-11-06 08:22:16', 0),
(94, 'IPHONE 13', 'LCD IPHONE 13', '17939534126aed8e84ab6be.png', 'active', '2026-11-06 08:23:32', '2026-11-06 08:23:32', 0),
(95, 'IPHONE 13 PRO', 'LCD IPHONE 13 PRO', '17939534716aed8ebf6e2bd.png', 'active', '2026-11-06 08:24:31', '2026-11-06 08:24:31', 0),
(96, 'IPHONE 13 PRO MAX', 'LCD IPHONE 13 PRO MAX', '17939535406aed8f04a7e91.png', 'active', '2026-11-06 08:25:40', '2026-11-06 08:25:40', 0),
(97, 'IPHONE 14', 'LCD IPHONE 14', '17939536036aed8f437f24a.png', 'active', '2026-11-06 08:26:43', '2026-11-06 08:26:43', 0),
(98, 'IPHONE 14 PRO', 'LCD IPHONE 14 PRO', '17939536666aed8f82d0634.png', 'active', '2026-11-06 08:27:46', '2026-11-06 08:27:46', 0),
(99, 'IPHONE 14 PRO MAX', 'LCD IPHONE 14 PRO MAX', '17939537256aed8fbd352d1.png', 'active', '2026-11-06 08:28:45', '2026-11-06 08:28:45', 0),
(100, 'Y5 2019 - HONOR 8s', 'LCD Y5 2019 - HONOR 8s', '17940411526aeee5409bf30.png', 'active', '2026-11-07 08:45:52', '2026-11-07 08:45:52', 0),
(101, 'Y5p 2020 - HONOR 9s', 'LCD Y5p 2020 - HONOR 9s', '17940412236aeee5875cebf.png', 'active', '2026-11-07 08:47:03', '2026-11-07 08:47:03', 0),
(102, 'Y6p 2020 - HONOR 9A', 'LCD Y6p 2020 - HONOR 9A', '17940412786aeee5bebc55b.png', 'active', '2026-11-07 08:47:58', '2026-11-07 08:47:58', 0),
(103, 'Y7A - PSMART 2021 - HONOR X10 LITE', 'LCD Y7A - PSMART 2021 - HONOR X10 LITE', '17940413896aeee62d54c12.png', 'active', '2026-11-07 08:49:49', '2026-11-07 08:49:49', 0),
(104, 'NOVA 3i - MATE 20 LITE', 'LCD NOVA 3i - MATE 20 LITE', '17940415136aeee6a930e8e.png', 'active', '2026-11-07 08:51:53', '2026-11-07 08:51:53', 0),
(105, 'NOVA 3E - P20 LITE', 'LCD NOVA 3E - P20 LITE', '17940417406aeee78c7b7c3.png', 'active', '2026-11-07 08:55:40', '2026-11-07 08:55:40', 0),
(106, 'NOVA 5t - HONOR 20 PRO - HONOR 20s', 'LCD NOVA 5t - HONOR 20 PRO - HONOR 20s', '17940418246aeee7e04d000.png', 'active', '2026-11-07 08:57:04', '2026-11-07 08:57:04', 0),
(107, 'NOVA 5i - NOVA 7i - P20 LITE 2019', 'LCD NOVA 5i - NOVA 7i - P20 LITE 2019', '17940419066aeee832aa5fa.png', 'active', '2026-11-07 08:58:26', '2026-11-07 08:58:26', 0),
(108, 'Y9 PRIME - Y9s - HONOR 9x', 'LCD Y9 PRIME - Y9s - HONOR 9x', '17940420536aeee8c545d69.png', 'active', '2026-11-07 09:00:53', '2026-11-07 09:00:53', 0),
(109, 'Y9a - HONOR X10', 'LCD Y9a - HONOR X10', '17940422666aeee99a77a16.png', 'active', '2026-11-07 09:04:26', '2026-11-07 09:04:26', 0),
(110, 'Y9 2019 - Y8s', 'LCD Y9 2019 - Y8s', '17940423446aeee9e8c116e.png', 'active', '2026-11-07 09:05:44', '2026-11-07 09:05:44', 0),
(111, 'HONOR X5b', 'LCD HONOR X5b', '17940539376aef17319b0eb.png', 'active', '2026-11-07 12:18:57', '2026-11-07 12:18:57', 0),
(112, 'HONOR X5c - HONOR X5c PLUS', 'LCD HONOR X5c - HONOR X5c PLUS', '17940540506aef17a294a66.png', 'active', '2026-11-07 12:20:50', '2026-11-07 12:20:50', 0),
(113, 'HONOR X6 2022 - HONOR X5 2023', 'LCD HONOR X6 2022 - HONOR X5 2023', '17940541386aef17fada68f.png', 'active', '2026-11-07 12:22:18', '2026-11-07 12:22:18', 0),
(114, 'HONOR X6A - HONOR X5 PLUS', 'LCD HONOR X6A - HONOR X5 PLUS', '17940542316aef185772a5b.png', 'active', '2026-11-07 12:23:51', '2026-11-07 12:23:51', 0),
(115, 'HONOR X6B', 'LCD HONOR X6B', '17940543096aef18a5babfb.png', 'active', '2026-11-07 12:25:09', '2026-11-07 12:25:09', 0),
(116, 'HONOR X6c - HONOR PLAY 60', 'LCD HONOR X6c - HONOR PLAY 60', '17940544816aef1951b8dee.png', 'active', '2026-11-07 12:28:01', '2026-11-07 12:28:01', 0),
(117, 'HONOR X7 2022', 'LCD HONOR X7 2022', '17940545486aef1994e432c.png', 'active', '2026-11-07 12:29:08', '2026-11-07 12:29:08', 0),
(118, 'HONOR X7A', 'LCD HONOR X7A', '17940546246aef19e0c7361.png', 'active', '2026-11-07 12:30:24', '2026-11-07 12:30:24', 0),
(119, 'HONOR X7b', 'LCD HONOR X7b', '17940547206aef1a4058b6b.png', 'active', '2026-11-07 12:32:00', '2026-11-07 12:32:00', 0),
(120, 'HONOR X7c - HONOR 60 PLUS', 'LCD HONOR X7c - HONOR 60 PLUS', '17940548016aef1a9149a0f.png', 'active', '2026-11-07 12:33:21', '2026-11-07 12:33:21', 0),
(121, 'HONOR X7d - HONOR 400 SMART - HONOR PLAY 10c 5G', 'LCD HONOR X7d - HONOR 400 SMART - HONOR PLAY 10c 5G', '17940548896aef1ae9dc6fa.png', 'active', '2026-11-07 12:34:49', '2026-11-07 12:34:49', 0),
(122, 'HONOR X7e - HONOR X6e', 'LCD HONOR X7e - HONOR X6e', '17940549736aef1b3d76d99.png', 'active', '2026-11-07 12:36:13', '2026-11-07 12:36:13', 0),
(123, 'HONOR X8 2022', 'LCD HONOR X8 2022', '17940551276aef1bd710d10.png', 'active', '2026-11-07 12:38:47', '2026-11-07 12:38:47', 0),
(124, 'HONOR X8a - HONOR 90 LITE', 'LCD HONOR X8a - HONOR 90 LITE', '17940552116aef1c2b8b405.png', 'active', '2026-11-07 12:40:11', '2026-11-07 12:40:11', 0),
(125, 'HONOR X8b - HONOR X8c 4G - HONOR 200 LITE', 'LCD HONOR X8b - HONOR X8c 4G - HONOR 200 LITE', '17940553206aef1c9890a35.png', 'active', '2026-11-07 12:42:00', '2026-11-07 12:42:00', 0),
(126, 'HONOR X9 2022', 'LCD HONOR X9 2022', '17940558606aef1eb44762e.png', 'active', '2026-11-07 12:51:00', '2026-11-07 12:51:00', 0),
(127, 'HONOR X9a', 'LCD HONOR X9a', '17940559276aef1ef7312a3.png', 'active', '2026-11-07 12:52:07', '2026-11-07 12:52:07', 0),
(128, 'HONOR X9b', 'LCD HONOR X9b', '17940559816aef1f2df1dba.png', 'active', '2026-11-07 12:53:01', '2026-11-07 12:53:01', 0),
(129, 'HONOR X9c - HONOR X6 PRO - HONOR MAGIC 70 LITE', 'LCD HONOR X9c - HONOR X6 PRO - HONOR MAGIC 70 LITE', '17940560896aef1f99b7280.png', 'active', '2026-11-07 12:54:49', '2026-11-07 12:54:49', 0),
(130, 'HONOR 8X 2019 - HONOR 9X LITE', 'LCD HONOR 8X 2019 - HONOR 9X LITE', '17940562076aef200f0c0bc.png', 'active', '2026-11-07 12:56:47', '2026-11-07 12:56:47', 0),
(131, 'HONOR 50 - NOVA 9', 'LCD HONOR 50 - NOVA 9', '17940563216aef208100893.png', 'active', '2026-11-07 12:58:41', '2026-11-07 12:58:41', 0),
(132, 'HONOR 200', 'LCD HONOR 200', '17940564126aef20dc88480.png', 'active', '2026-11-07 13:00:12', '2026-11-07 13:00:12', 0),
(133, 'HONOR 8c', 'LCD HONOR 8c', '17940569336aef22e59b8db.png', 'active', '2026-11-07 13:08:53', '2026-11-07 13:08:53', 0),
(134, 'INFINIX SMART HD 2021', 'LCD INFINIX SMART HD 2021', '17940598266aef2e32798c2.png', 'active', '2026-11-07 13:57:06', '2026-11-07 13:57:06', 0),
(135, 'INFINIX SMART 6PLUS - HOT 10T - HOT 10S - SPARK 7P - ITEL P38 PRO - VISION 3PLUS', 'LCD INFINIX SMART 6PLUS - HOT 10T - HOT 10S - SPARK 7P - ITEL P38 PRO - VISION 3PLUS', '17940599356aef2e9fcf478.png', 'active', '2026-11-07 13:58:55', '2026-11-07 13:58:55', 0),
(136, 'INFINIX HOT 7 - SPARK3', 'LCD INFINIX HOT 7 - SPARK3', '17940600236aef2ef77e778.png', 'active', '2026-11-07 14:00:23', '2026-11-07 14:00:23', 0),
(137, 'INFINIX HOT 8 - HOT 8LITE – SPARK 4', 'LCD INFINIX HOT 8 - HOT 8LITE – SPARK 4', '17940600866aef2f3688ccc.png', 'active', '2026-11-07 14:01:26', '2026-11-07 14:01:26', 0),
(138, 'INFINIX HOT 9 - HOT 9PRO - CAMON 15 - NOTE 7LITE – S5 – SPARK 5 - SPARK 5PRO', 'LCD INFINIX HOT 9 - HOT 9PRO - CAMON 15 - NOTE 7LITE – S5 – SPARK 5 - SPARK 5PRO', '17940602296aef2fc515c08.png', 'active', '2026-11-07 14:03:49', '2026-11-07 14:03:49', 0),
(139, 'INFINIX HOT 9 PLAY', 'LCD INFINIX HOT 9 PLAY', '17940603416aef303591e08.png', 'active', '2026-11-07 14:05:41', '2026-11-07 14:05:41', 0),
(140, 'INFINIX HOT 10 -NOTE 8i - POVA - CAMON 16 – CAMON 16PRO -  SPARK 6', 'LCD INFINIX HOT 10 -NOTE 8i - POVA - CAMON 16 – CAMON 16PRO -  SPARK 6', '17940604686aef30b4e9cf7.png', 'active', '2026-11-07 14:07:48', '2026-11-07 14:07:48', 0),
(141, 'INFINIX HOT 10LITE -HOT 10i -SPARK 7 -SMART5-ITEL ViSION 1PRO - ITEL VISION 2S', 'LCD INFINIX HOT 10LITE -HOT 10i -SPARK 7 -SMART5-ITEL ViSION 1PRO - ITEL VISION 2S', '17940606746aef318227219.png', 'active', '2026-11-07 14:11:14', '2026-11-07 14:11:14', 0),
(142, 'INFINIX HOT 12 - HOT 12 PLAY – HOT 20 - NOTE 12i – POVA 4 - POVA NEO 2', 'LCD INFINIX HOT 12 - HOT 12 PLAY – HOT 20 - NOTE 12i – POVA 4 - POVA NEO 2', '17940608956aef325f6a905.png', 'active', '2026-11-07 14:14:55', '2026-11-07 14:14:55', 0),
(143, 'INFINIX HOT 12i – HOT 20i - SMART 6 HD', 'LCD INFINIX HOT 12i – HOT 20i - SMART 6 HD', '17940609986aef32c66c2ad.png', 'active', '2026-11-07 14:16:38', '2026-11-07 14:16:38', 0),
(144, 'INFINIX HOT 30 4G - IFINIX NOTE 30 4G - SPARK 10 PRO - SPARK 20 PRO - POVA 5 - POVA 5 PRO 5G - POVA 6 NEO 4G - HOT 40 - HOT 40X 5G - HOT 40 PRO - INFINIX NOTE 40X 5G', 'LCD INFINIX HOT 30 4G - IFINIX NOTE 30 4G - SPARK 10 PRO - SPARK 20 PRO - POVA 5 - POVA 5 PRO 5G - POVA 6 NEO 4G - HOT 40 - HOT 40X 5G - HOT 40 PRO - INFINIX NOTE 40X 5G', '17940610876aef331f9dc37.png', 'active', '2026-11-07 14:18:07', '2026-11-07 14:18:07', 0),
(145, 'INFINIX HOT 30i - POP 7 - SMART 7 PLUS', 'LCD INFINIX HOT 30i - POP 7 - SMART 7 PLUS', '17940612786aef33dec270e.png', 'active', '2026-11-07 14:21:18', '2026-11-07 14:21:18', 0),
(146, 'INFINIX HOT 30 PLAY', 'LCD INFINIX HOT 30 PLAY', '17940614566aef34900c0c2.png', 'active', '2026-11-07 14:24:16', '2026-11-07 14:24:16', 0),
(147, 'INFINIX HOT 50 5G - SMART 9', 'LCD INFINIX HOT 50 5G - SMART 9', '17940664746aef482a54ffa.png', 'active', '2026-11-07 15:47:54', '2026-11-07 15:47:54', 0),
(148, 'INFINIX HOT 50i', 'LCD INFINIX HOT 50i', '17940665526aef4878cbfc3.png', 'active', '2026-11-07 15:49:12', '2026-11-07 15:49:12', 0),
(149, 'INFINIX HOT 50 4G - SPARK 30 4G - POVA 7 5G', 'LCD INFINIX HOT 50 4G - SPARK 30 4G - POVA 7 5G', '17940666386aef48ce0a7a4.png', 'active', '2026-11-07 15:50:38', '2026-11-07 15:50:38', 0),
(150, 'INFINIX HOT 50 PRO - SPARK 30 PRO - ITEL S25', 'LCD INFINIX HOT 50 PRO - SPARK 30 PRO - ITEL S25', '17940671126aef4aa8ee64d.png', 'active', '2026-11-07 15:58:32', '2026-11-07 15:58:32', 0),
(151, 'INFINIX HOT 60 PRO - INFINIX GT 30 PRO - SPARK 40 PRO - POP 7 PRO', 'LCD INFINIX HOT 60 PRO - INFINIX GT 30 PRO - SPARK 40 PRO - POP 7 PRO', '17940672566aef4b3889cc0.png', 'active', '2026-11-07 16:00:56', '2026-11-07 16:00:56', 0),
(152, 'INFINIX HOT 60 5G - 60i - SMART 10 - SMART 10 HD - SMART 10 PLUS - SMART 10 PRO - POP 10 - POP10 PRO - SPARK 40 - 40C - SPARK GO 2', 'LCD INFINIX HOT 60 5G - 60i - SMART 10 - SMART 10 HD - SMART 10 PLUS - SMART 10 PRO - POP 10 - POP10 PRO - SPARK 40 - 40C - SPARK GO 2', '17940673566aef4b9cec7fd.png', 'active', '2026-11-07 16:02:36', '2026-11-07 16:02:36', 0),
(153, 'INFINIX HOT 60 PRO PLUS', 'LCD INFINIX HOT 60 PRO PLUS HD+', '17940674336aef4be91546e.png', 'active', '2026-11-07 16:03:53', '2026-11-07 16:03:53', 0),
(154, 'INFINIX SMART 20 - HOT 70 4G - SPARK 50 4G - SPARK 50 5G NFC - POP X 5G - ITEL CITY 200', 'LCD INFINIX SMART 20 - HOT 70 4G - SPARK 50 4G - SPARK 50 5G NFC - POP X 5G - ITEL CITY 200', '17940679186aef4dcecd817.png', 'active', '2026-11-07 16:11:58', '2026-11-07 16:11:58', 0),
(155, 'INFINIX NOTE 7', 'LCD INFINIX NOTE 7', '17940685246aef502c196a9.png', 'active', '2026-11-07 16:22:04', '2026-11-07 16:22:04', 0),
(156, 'INFINIX NOTE 8', 'LCD INFINIX NOTE 8', '17940685806aef5064bb33c.png', 'active', '2026-11-07 16:23:00', '2026-11-07 17:19:31', 9),
(157, 'INFINIX NOTE 10 - POVA2 - POVA 3 - NOTE 11S -NOTE 11PRO', 'LCD INFINIX NOTE 10 - POVA2 - POVA 3 - NOTE 11S -NOTE 11PRO', '17940695756aef544700c77.png', 'active', '2026-11-07 16:39:35', '2026-11-07 17:19:31', 8),
(158, 'INFINIX NOTE 10 PRO', 'LCD INFINIX NOTE 10 PRO', '17940696426aef548a21bcc.png', 'active', '2026-11-07 16:40:42', '2026-11-07 17:19:31', 7),
(159, 'INFINIX NOTE 11 - NOTE 12 - NOTE 12 PRO', 'LCD INFINIX NOTE 11 - NOTE 12 - NOTE 12 PRO', '17940697136aef54d185770.png', 'active', '2026-11-07 16:41:53', '2026-11-07 17:19:31', 6),
(160, 'INFINIX NOTE 40 5G - CAMON 30 - CAMON 30 5G - POVA 6 - POVA 6 PRO 5G', 'LCD INFINIX NOTE 40 5G - CAMON 30 - CAMON 30 5G - POVA 6 - POVA 6 PRO 5G', '17940697936aef55215020f.png', 'active', '2026-11-07 16:43:13', '2026-11-07 17:19:31', 5),
(161, 'INFINIX NOTE 40 4G - NOTE 50 4G - NOTE 50 PRO - NOTE 50 PRO PLUS 5G - CAMON 30 PRO 5G - CAMON 40', 'LCD INFINIX NOTE 40 4G - NOTE 50 4G - NOTE 50 PRO - NOTE 50 PRO PLUS 5G - CAMON 30 PRO 5G - CAMON 40', '17940699086aef55947a530.png', 'active', '2026-11-07 16:45:08', '2026-11-07 17:19:31', 4),
(162, 'INFINIX ZERO X - ZERO XPRO - CAMON 18 PREMIER', 'LCD INFINIX ZERO X - ZERO XPRO - CAMON 18 PREMIER', '17940717136aef5ca1cd01b.png', 'active', '2026-11-07 17:15:13', '2026-11-07 17:19:31', 3),
(163, 'INFINIX ZERO 20 - POVA 4 PRO', 'LCD INFINIX ZERO 20 - POVA 4 PRO', '17940718206aef5d0c57bf1.png', 'active', '2026-11-07 17:17:00', '2026-11-07 17:19:31', 2),
(164, 'INFINIX ZERO 30 4G - ZERO 30 5G - ZERO 30 PRO - ITEL S23 PLUS', 'LCD INFINIX ZERO 30 4G - ZERO 30 5G - ZERO 30 PRO - ITEL S23 PLUS', '17940718796aef5d47be20c.png', 'active', '2026-11-07 17:17:59', '2026-11-07 17:19:31', 1),
(165, 'INFINIX ZERO 40 - INFINIX NOTE 40s 4G - INFINIX NOTE 40 PRO 4G', 'LCD INFINIX ZERO 40 - INFINIX NOTE 40s 4G - INFINIX NOTE 40 PRO 4G', '17940719546aef5d92622d7.png', 'active', '2026-11-07 17:19:14', '2026-11-07 17:19:31', 0),
(166, 'SPARK 6GO - SPARK GO 2021', 'LCD SPARK 6GO - SPARK GO 2021', '17941560746af0a62a0309f.png', 'active', '2026-11-08 16:41:14', '2026-11-08 16:41:14', 0),
(167, 'SPARK 8', 'LCD SPARK 8', '17941561356af0a66725283.png', 'active', '2026-11-08 16:42:15', '2026-11-08 16:42:15', 0),
(168, 'SPARK 8C - SPARK 9 – SPARK 9T - ITEL VISION 3 - ITEL A60S', 'LCD SPARK 8C - SPARK 9 – SPARK 9T - ITEL VISION 3 - ITEL A60S', '17941562256af0a6c16a641.png', 'active', '2026-11-08 16:43:45', '2026-11-08 16:43:45', 0),
(169, 'SPARK 7 PRO - CAMON 17', 'LCD SPARK 7 PRO - CAMON 17', '17941563066af0a7120029c.png', 'active', '2026-11-08 16:45:06', '2026-11-08 16:45:06', 0),
(170, 'SPARK 9 PRO - SPARK 8T - SPARK 8P - SPARK 8 PLUS - HOT 11 - ITEL VISION 5 PLUS', 'LCD SPARK 9 PRO - SPARK 8T - SPARK 8P - SPARK 8 PLUS - HOT 11 - ITEL VISION 5 PLUS', '17941563776af0a759dcd46.png', 'active', '2026-11-08 16:46:17', '2026-11-08 16:46:17', 0),
(171, 'SPARK 10 - SPARK 10C - SPARK GO 2023 - SMART 7HD - SMART 7 - POP 6PRO - HOT 12PRO - POP 7 PRO - ITEL A60 - ITEL A70 - ITEL P40', 'LCD SPARK 10 - SPARK 10C - SPARK GO 2023 - SMART 7HD - SMART 7 - POP 6PRO - HOT 12PRO - POP 7 PRO - ITEL A60 - ITEL A70 - ITEL P40', '17941564506af0a7a21d0f4.png', 'active', '2026-11-08 16:47:30', '2026-11-08 16:47:30', 0),
(172, 'TECNO SPARK 20 PRO', 'LCD TECNO SPARK 20 PRO', '17941565456af0a80101ace.png', 'active', '2026-11-08 16:49:05', '2026-11-08 16:49:05', 0),
(173, 'SPARK GO 2022 - POP 5LITE – POP 5PRO  - SMART 6', 'LCD SPARK GO 2022 - POP 5LITE – POP 5PRO - SMART 6', '17941566776af0a885419ec.png', 'active', '2026-11-08 16:51:17', '2026-11-08 16:51:17', 0),
(174, 'SPARK GO 2024 - SPARK 20 - SPARK 20C - INFINIX HOT 40i - SMART 8 - SMART 8 PRO - SMART 8 PLUS - SMART 8 HD - POP8 - ITEL P55 PLUS - ITEL P55 - ITEL  A70s  - ITEL S24', 'LCD SPARK GO 2024 - SPARK 20 - SPARK 20C - INFINIX HOT 40i - SMART 8 - SMART 8 PRO - SMART 8 PLUS - SMART 8 HD - POP8 - ITEL P55 PLUS - ITEL P55 - ITEL  A70s  - ITEL S24', '17941567826af0a8ee3f69d.png', 'active', '2026-11-08 16:53:02', '2026-11-08 16:53:02', 0),
(175, 'SPARK GO 3 - POP 20 - POP X 4G ITEL A200 4G - ITEL A200 PLUS 4G', 'LCD SPARK GO 3 - POP 20 - POP X 4G ITEL A200 4G - ITEL A200 PLUS 4G', '17941568846af0a9545e55f.png', 'active', '2026-11-08 16:54:44', '2026-11-08 16:54:44', 0),
(176, 'POUVOIR 4 – POUVOIR 4PRO – SPARK 5AIR – SPARK 6AIR', 'LCD POUVOIR 4 – POUVOIR 4PRO – SPARK 5AIR – SPARK 6AIR', '17941569556af0a99b1959e.png', 'active', '2026-11-08 16:55:55', '2026-11-08 16:55:55', 0),
(177, 'TECNO POP 4LITE', 'TECNO POP 4LITE', '17941570366af0a9ec7e3ab.png', 'active', '2026-11-08 16:57:16', '2026-11-08 16:57:16', 0),
(178, 'TECNO POP 6', 'LCD TECNO POP 6', '17941571246af0aa44b2b13.png', 'active', '2026-11-08 16:58:44', '2026-11-08 16:58:44', 0),
(179, 'TECNO CAMON 19 - CAMON 19PRO', 'LCD TECNO CAMON 19 - CAMON 19PRO', '17941572346af0aab27877f.png', 'active', '2026-11-08 17:00:34', '2026-11-08 17:00:34', 0),
(180, 'TECNO CAMON 17 PRO – INFINIX ZERO X NEW', 'LCD TECNO CAMON 17 PRO – INFINIX ZERO X NEW', '17941579116af0ad576458e.png', 'active', '2026-11-08 17:11:51', '2026-11-08 17:11:51', 0),
(181, 'TECNO CAMON 18 - CAMON 17 PREMIER - CAMON 17P - CAMON 18P - SPARK 8 PRO - HOT 11S - POVA NEO 5G - ZERO 5G 2023 - HOT 20S', 'LCD TECNO CAMON 18 - CAMON 17 PREMIER - CAMON 17P - CAMON 18P - SPARK 8 PRO - HOT 11S - POVA NEO 5G - ZERO 5G 2023 - HOT 20S', '17941579816af0ad9d3549c.png', 'active', '2026-11-08 17:13:01', '2026-11-08 17:13:01', 0),
(182, 'TECNO CAMON 20 - CAMON 20 PRO - NOTE 30 PRO', 'LCD TECNO CAMON 20 - CAMON 20 PRO - NOTE 30 PRO', '17941580466af0adde49453.png', 'active', '2026-11-08 17:14:06', '2026-11-08 17:14:06', 0),
(183, 'TECNO CAMON 30 - CAMON 30 5G - INFINIX NOTE 40 5G - POVA 6 PRO - POVA 6 PRO 5G', 'LCD TECNO CAMON 30 - CAMON 30 5G - INFINIX NOTE 40 5G - POVA 6 PRO - POVA 6 PRO 5G', '17941581456af0ae4110052.png', 'active', '2026-11-08 17:15:45', '2026-11-08 17:15:45', 0),
(184, 'LCD TECNO CAMON 40 PRO 5G - HOT 50 PRO PLUS 4G - INFINIX NOTE 40s - NOTE 40 PRO - NOTE 40 PRO PLUS -NOTE 50s 5G - SPARK 20s PLUS - SPARK 20 PRO PLUS - ITEL S25 ULTRA - ZERO 40 ULTRA - CAMON 30s - CAMON 30s PRO', 'TECNO CAMON 40 PRO 5G - HOT 50 PRO PLUS 4G - INFINIX NOTE 40s - NOTE 40 PRO - NOTE 40 PRO PLUS -NOTE 50s 5G - SPARK 20s PLUS - SPARK 20 PRO PLUS - ITEL S25 ULTRA - ZERO 40 ULTRA - CAMON 30s - CAMON 30s PRO', '17941582596af0aeb37f5dc.png', 'active', '2026-11-08 17:17:39', '2026-11-08 17:17:39', 0),
(185, 'REALME C11 - C12 - C15  - OPPO A15 – OPPO A15S – OPPO A16K', 'LCD REALME C11 - C12 - C15  - OPPO A15 – OPPO A15S – OPPO A16K', '17941601356af0b607355c8.png', 'active', '2026-11-08 17:48:55', '2026-11-08 17:48:55', 0),
(186, 'REALME C11 2021 - C20 - C21 - NARZO 50i', 'LCD REALME C11 2021 - C20 - C21 - NARZO 50i', '17941601916af0b63f0a876.png', 'active', '2026-11-08 17:49:51', '2026-11-08 17:49:51', 0),
(187, 'REALME C21Y -C25y', 'LCD REALME C21Y -C25y', '17941602526af0b67c64e82.png', 'active', '2026-11-08 17:50:52', '2026-11-08 17:50:52', 0),
(188, 'REALME C25 – C25s', 'LCD REALME C25 – C25s', '17941603406af0b6d41d18c.png', 'active', '2026-11-08 17:52:20', '2026-11-08 17:52:20', 0),
(189, 'REALME C30 - C30s - C33', 'LCD REALME C30 - C30s - C33', '17941604256af0b72909256.png', 'active', '2026-11-08 17:53:45', '2026-11-08 17:53:45', 0),
(190, 'REALME C35', 'LCD REALME C35', '17941604836af0b7634b531.png', 'active', '2026-11-08 17:54:43', '2026-11-08 17:54:43', 0),
(191, 'REALME C53 - C51 -REALME NOTE 50 - NARZO N53', 'LCD REALME C53 - C51 -REALME NOTE 50 - NARZO N53', '17941605426af0b79ed2476.png', 'active', '2026-11-08 17:55:42', '2026-11-08 17:55:42', 0),
(192, 'REALME C55 – REALME C67 5G - REALME 11 5G - NARZO N55 - OPPO A58 4G', 'LCD REALME C55 – REALME C67 5G - REALME 11 5G - NARZO N55 - OPPO A58 4G', '17941605916af0b7cf9f083.png', 'active', '2026-11-08 17:56:31', '2026-11-08 17:56:31', 0),
(193, 'REALME C63 - C61 - NOTE 60 - NOTE 60x - NARZO N61 - NARZO N63', 'LCD REALME C63 - C61 - NOTE 60 - NOTE 60x - NARZO N61 - NARZO N63', '17941606426af0b802ef681.png', 'active', '2026-11-08 17:57:22', '2026-11-08 17:57:22', 0),
(194, 'REALME C65 4G - REALME C65 5G - REALME C67 4G - REALME C75x - REALME 12 5G - REALME 13 5G - OPPO A60', 'LCD REALME C65 4G - REALME C65 5G - REALME C67 4G - REALME C75x - REALME 12 5G - REALME 13 5G - OPPO A60', '17941607156af0b84b49291.png', 'active', '2026-11-08 17:58:35', '2026-11-08 17:58:35', 0),
(195, 'REALME C71 4G', 'LCD REALME C71 4G', '17941607956af0b89baa20a.png', 'active', '2026-11-08 17:59:55', '2026-11-08 17:59:55', 0),
(196, 'REALME C75', 'LCD REALME C75', '17941608926af0b8fc80f46.png', 'active', '2026-11-08 18:01:32', '2026-11-08 18:01:32', 0),
(197, 'REALME C75x', 'LCD REALME C75x', '17941609476af0b9330b09b.png', 'active', '2026-11-08 18:02:27', '2026-11-08 18:02:27', 0),
(198, 'REALME C85', 'LCD REALME C85', '17941609966af0b9644680e.png', 'active', '2026-11-08 18:03:16', '2026-11-08 18:03:16', 0),
(199, 'REALME NOTE 70 - REALME C72 - REALME NOTE 70T', 'LCD REALME NOTE 70 - REALME C72 - REALME NOTE 70T', '17941610536af0b99dcac6e.png', 'active', '2026-11-08 18:04:13', '2026-11-08 18:04:13', 0),
(200, 'REALME 7 - REALME 6', 'LCD REALME 7 - REALME 6', '17941611416af0b9f5920f5.png', 'active', '2026-11-08 18:05:41', '2026-11-08 18:05:41', 0),
(201, 'REALME 7i - C17 - OPPO A53 - A53s', 'LCD REALME 7i - C17 - OPPO A53 - A53s', '17941611896af0ba2560fc2.png', 'active', '2026-11-08 18:06:29', '2026-11-08 18:06:29', 0),
(202, 'REALME 8 PRO - REALME 8  - REALME 7 PRO - A74 4G - A94 5G - RENO 5F', 'LCD REALME 8 PRO - REALME 8  - REALME 7 PRO - A74 4G - A94 5G - RENO 5F', '17941612706af0ba7636ad0.png', 'active', '2026-11-08 18:07:50', '2026-11-08 18:07:50', 0),
(203, 'REALME 9 4G - REALME 9PRO PLUS - REALME 10 4G - REALME 11 4G', 'LCD REALME 9 4G - REALME 9PRO PLUS - REALME 10 4G - REALME 11 4G', '17941613276af0baaf1a0eb.png', 'active', '2026-11-08 18:08:47', '2026-11-08 18:08:47', 0),
(204, 'REALME 9i', 'LCD REALME 9i', '17941613816af0bae52e2f7.png', 'active', '2026-11-08 18:09:41', '2026-11-08 18:09:41', 0),
(205, 'REALME 12 4G - REALME 13 4G - REALME 13 PRO - REALME 13 PLUS - REALME 14 - REALME 14T', 'LCD REALME 12 4G - REALME 13 4G - REALME 13 PRO - REALME 13 PLUS - REALME 14 - REALME 14T', '17941614386af0bb1e14106.png', 'active', '2026-11-08 18:10:38', '2026-11-08 18:10:38', 0),
(206, 'REALME 12 PLUS  5G', 'LCD REALME 12 PLUS  5G', '17941616186af0bbd2cb529.png', 'active', '2026-11-08 18:13:38', '2026-11-08 18:13:38', 0),
(207, 'REALME C100x - REALME C100 5G - REALME C100i - REALME C83 5G - REALME C83x - realme c85X - OPPO A6c 4G', 'LCD REALME C100x - REALME C100 5G - REALME C100i - REALME C83 5G - REALME C83x - realme c85X - OPPO A6c 4G', '17941617426af0bc4e7cf5f.png', 'active', '2026-11-08 18:15:42', '2026-11-08 18:15:42', 0),
(208, 'REALME Q3PRO – OPPO RENO 5 – RENO 6PRO - GT MASTER', 'LCD REALME Q3PRO – OPPO RENO 5 – RENO 6PRO - GT MASTER', '17941618106af0bc920e434.png', 'active', '2026-11-08 18:16:50', '2026-11-08 18:16:50', 0),
(209, 'REALME 7i - REALME C17 - OPPO A53 - A53s', 'LCD REALME 7i - REALME C17 - OPPO A53 - A53s', '17941622006af0be185cdde.png', 'active', '2026-11-08 18:23:20', '2026-11-08 18:23:20', 0),
(210, 'REDMI 8 – REDMI 8A', 'LCD REDMI 8 – REDMI 8A', '17942126936af18355d3ccb.png', 'active', '2026-11-09 08:24:53', '2026-11-09 08:24:53', 0),
(211, 'REDMI 9', 'LCD REDMI 9', '17942128316af183df0760d.png', 'active', '2026-11-09 08:27:11', '2026-11-09 08:27:11', 0),
(212, 'REDMI 9A – 9C – 10A – POCO C3 - POOC C65', 'LCD REDMI 9A – 9C – 10A – POCO C3 - POOC C65', '17942129156af18433f3a02.png', 'active', '2026-11-09 08:28:36', '2026-11-09 08:28:36', 0),
(213, 'REDMI 10C – POCO C40', 'LCD REDMI 10C – POCO C40', '17942129876af1847b8c46c.png', 'active', '2026-11-09 08:29:47', '2026-11-09 08:29:47', 0),
(214, 'REDMI 10', 'LCD REDMI 10', '17942130576af184c1ade84.png', 'active', '2026-11-09 08:30:57', '2026-11-09 08:30:57', 0),
(215, 'REDMI 12c', 'LCD REDMI 12c', '17942131146af184fa18b8c.png', 'active', '2026-11-09 08:31:54', '2026-11-09 08:31:54', 0),
(216, 'REDMI 13 - REDMI 12 - POCO M6 4G - POCO M6 PRO 5G', 'LCD REDMI 13 - REDMI 12 - POCO M6 4G - POCO M6 PRO 5G', '17942132196af18563c31b1.png', 'active', '2026-11-09 08:33:39', '2026-11-09 08:33:39', 0),
(217, 'REDMI 13C - POCO C65', 'LCD REDMI 13C - POCO C65', '17942132976af185b1a153e.png', 'active', '2026-11-09 08:34:57', '2026-11-09 08:34:57', 0),
(218, 'REDMI 14C - REDMI A3 PRO - REDMI 14R 5G -POCO C75', 'LCD REDMI 14C - REDMI A3 PRO - REDMI 14R 5G -POCO C75', '17942133646af185f43f8d9.png', 'active', '2026-11-09 08:36:04', '2026-11-09 08:36:04', 0),
(219, 'REDMI 15 4G - POCO M7 4G', 'LCD REDMI 15 4G - POCO M7 4G', '17942134106af18622db834.png', 'active', '2026-11-09 08:36:50', '2026-11-09 14:35:04', 9),
(220, 'REDMI 15c 4G - REDMI 15c 5G - POCO C85 4G', 'LCD REDMI 15c 4G - REDMI 15c 5G - POCO C85 4G', '17942134646af18658a0777.png', 'active', '2026-11-09 08:37:44', '2026-11-09 14:35:04', 8),
(221, 'REDMI NOTE 8', 'LCD REDMI NOTE 8', '17942344526af1d854e9a7a.png', 'active', '2026-11-09 14:27:32', '2026-11-09 14:35:04', 7),
(222, 'REDMI NOTE 8 PRO', 'LCD REDMI NOTE 8 PRO', '17942345066af1d88acb607.png', 'active', '2026-11-09 14:28:26', '2026-11-09 14:35:04', 6),
(223, 'REDMI NOTE 9', 'LCD REDMI NOTE 9', '17942346106af1d8f2f3cab.png', 'active', '2026-11-09 14:30:11', '2026-11-09 14:35:04', 4),
(224, 'REDMI NOTE 9 4G - POCO M3 - REDMI 9T', 'LCD REDMI NOTE 9 4G - POCO M3 - REDMI 9T', '17942346726af1d9309fad1.png', 'active', '2026-11-09 14:31:12', '2026-11-09 14:35:04', 5),
(225, 'REDMI NOTE 9s - XIOMI NOTE 9 PRO', 'LCD REDMI NOTE 9s - XIOMI NOTE 9 PRO', '17942347196af1d95f3c804.png', 'active', '2026-11-09 14:31:59', '2026-11-09 14:35:04', 3),
(226, 'REDMI NOTE 10 4G - NOTE 10S - POCO M5s', 'LCD REDMI NOTE 10 4G - NOTE 10S - POCO M5s', '17942347826af1d99e8e951.png', 'active', '2026-11-09 14:33:02', '2026-11-09 14:35:04', 2),
(227, 'REDMI NOTE 10 PRO 4G - NOTE 10 PRO MAX - NOTE 11 PRO 5G - NOTE 11 PRO PLUS 5G - REDMI NOTE 12 PRO 4G - POCO X4 PRO 4G - POCO X4 PRO 5G', 'LCD REDMI NOTE 10 PRO 4G - NOTE 10 PRO MAX - NOTE 11 PRO 5G - NOTE 11 PRO PLUS 5G - REDMI NOTE 12 PRO 4G - POCO X4 PRO 4G - POCO X4 PRO 5G', '17942348496af1d9e13304d.png', 'active', '2026-11-09 14:34:09', '2026-11-09 14:35:04', 1),
(228, 'REDMI NOTE 10PRO 5G', 'LCD REDMI NOTE 10PRO 5G', '17942348996af1da13b657b.png', 'active', '2026-11-09 14:34:59', '2026-11-09 14:45:28', 9),
(229, 'REDMI NOTE 11 4G – NOTE 11s - NOTE 12s –POCO M4 PRO 4G', 'LCD REDMI NOTE 11 4G – NOTE 11s - NOTE 12s –POCO M4 PRO 4G', '17942349746af1da5e18841.png', 'active', '2026-11-09 14:36:14', '2026-11-09 14:45:28', 8),
(230, 'REDMI NOTE 11 PRO 4G - NOTE 11 PRO 5G - NOTE 12 PRO 4G', 'LCD REDMI NOTE 11 PRO 4G - NOTE 11 PRO 5G - NOTE 12 PRO 4G', '17942350346af1da9a576ba.png', 'active', '2026-11-09 14:37:14', '2026-11-09 14:45:28', 7),
(231, 'REDMI NOTE 12 4G - NOTE 12 5G - POCO X5', 'LCD REDMI NOTE 12 4G - NOTE 12 5G - POCO X5', '17942350996af1dadb38aa1.png', 'active', '2026-11-09 14:38:19', '2026-11-09 14:45:28', 6),
(232, 'REDMI NOTE 13 4G  - REDMI NOTE 14 4G - REDMI NOTE 14 5G - POCO M7 PRO', 'LCD REDMI NOTE 13 4G  - REDMI NOTE 14 4G - REDMI NOTE 14 5G - POCO M7 PRO', '17942351666af1db1e1fe14.png', 'active', '2026-11-09 14:39:26', '2026-11-09 14:45:28', 5),
(233, 'REDMI NOTE 13 PRO 4G - NOTE 14S - POCO M6 PRO 4G', 'LCD REDMI NOTE 13 PRO 4G - NOTE 14S - POCO M6 PRO 4G', '17942352236af1db57f30f7.png', 'active', '2026-11-09 14:40:24', '2026-11-09 14:45:28', 4),
(234, 'REDMI NOTE 13 PRO PLUS 5G -NOTE 14 PRO 5G - NOTE 14 PRO PLUS 5G - POCO X7 5G', 'LCD REDMI NOTE 13 PRO PLUS 5G -NOTE 14 PRO 5G - NOTE 14 PRO PLUS 5G - POCO X7 5G', '17942352846af1db9453d56.png', 'active', '2026-11-09 14:41:24', '2026-11-09 14:45:28', 3),
(235, 'REDMI NOTE 14 4G - NOTE 14 5G - NOTE 13 4G - POCO M7 PRO', 'LCD REDMI NOTE 14 4G - NOTE 14 5G - NOTE 13 4G - POCO M7 PRO', '17942353966af1dc04e5358.png', 'active', '2026-11-09 14:43:16', '2026-11-09 14:45:28', 2),
(236, 'REDMI A1 - A1 PLUS - A2 - A2 PLUS - POCO C50 - C51', 'LCD REDMI A1 - A1 PLUS - A2 - A2 PLUS - POCO C50 - C51', '17942354636af1dc474cff8.png', 'active', '2026-11-09 14:44:23', '2026-11-09 14:45:28', 1),
(237, 'REDMI A3 -A3 PLUS - POCO C61', 'LCD REDMI A3 -A3 PLUS - POCO C61', '17942355126af1dc7862933.png', 'active', '2026-11-09 14:45:12', '2026-11-09 14:45:28', 0),
(238, 'POCO X3 – X3PRO', 'LCD POCO X3 – X3PRO', '17942440166af1fdb06977e.png', 'active', '2026-11-09 17:06:56', '2026-11-09 17:06:56', 0),
(239, 'POCO X5 PRO - REDMI NOTE 12 PRO 5G - NOTE 12 PRO PLUS 5G', 'LCD POCO X5 PRO - REDMI NOTE 12 PRO 5G - NOTE 12 PRO PLUS 5G', '17942441206af1fe1828bfd.png', 'active', '2026-11-09 17:08:40', '2026-11-09 17:08:40', 0),
(240, 'POCO X6 - REDMI NOTE 13 PRO PLUS - NOTE 13 PRI 5G', 'LCD POCO X6 - REDMI NOTE 13 PRO PLUS - NOTE 13 PRI 5G', '17942441946af1fe6203b26.png', 'active', '2026-11-09 17:09:54', '2026-11-09 17:09:54', 0),
(241, 'POCO X6 PRO 5G - POCO F6', 'LCD POCO X6 PRO 5G - POCO F6', '17942442596af1fea30aa9e.png', 'active', '2026-11-09 17:10:59', '2026-11-09 17:10:59', 0),
(242, 'POCO C71 4G - REDMI A5 4G - REDMI A5 5G', 'LCD POCO C71 4G - REDMI A5 4G - REDMI A5 5G', '17942443186af1fedeab68d.png', 'active', '2026-11-09 17:11:58', '2026-11-09 17:11:58', 0),
(243, 'POCO C81 - POCO C81 PRO - POCO C85x 5G - REDMI A7 PRP 4G - REDMI A7 PRO 5G', 'LCD POCO C81 - POCO C81 PRO - POCO C85x 5G - REDMI A7 PRP 4G - REDMI A7 PRO 5G', '17942444886af1ff889a386.png', 'active', '2026-11-09 17:14:48', '2026-11-09 17:14:48', 0),
(244, 'POCO M3 PRO - REDMI NOTE 10 5G - NOTE 10T 5G', 'LCD POCO M3 PRO - REDMI NOTE 10 5G - NOTE 10T 5G', '17942445846af1ffe868c2c.png', 'active', '2026-11-09 17:16:24', '2026-11-09 17:16:24', 0),
(245, 'POCO M4 - POCO M5 4G - REDMI 10 5G', 'LCD POCO M4 - POCO M5 4G - REDMI 10 5G', '17942446496af20029ae17c.png', 'active', '2026-11-09 17:17:29', '2026-11-09 17:17:29', 0),
(246, 'BLACKVIWE A70', 'LCD BLACKVIWE A70', '17942470746af209a21403d.png', 'active', '2026-11-09 17:57:54', '2026-11-09 17:57:54', 0),
(247, 'ITEL A26', 'LCD ITEL A26', '17942471536af209f1ef8bc.png', 'active', '2026-11-09 17:59:13', '2026-11-09 17:59:13', 0),
(248, 'ITEL A49 - ITEL A58 - A58 PRO', 'LCD ITEL A49 - ITEL A58 - A58 PRO', '17942471966af20a1cd7764.png', 'active', '2026-11-09 17:59:56', '2026-11-09 17:59:56', 0),
(249, 'ITEL A56', 'LCD ITEL A56', '17942472436af20a4bf2c68.png', 'active', '2026-11-09 18:00:43', '2026-11-13 08:30:34', 9),
(250, 'LENOVO K12', 'LCD LENOVO K12', '17942473026af20a86957db.png', 'active', '2026-11-09 18:01:42', '2026-11-13 08:30:34', 8),
(251, 'LENOVO K13', 'LCD LENOVO K13', '17942473786af20ad2dce84.png', 'active', '2026-11-09 18:02:58', '2026-11-13 08:30:34', 7),
(252, 'LENOVO K14 - K14 PLUS - K15 - K15 PLUS - NOTE 13', 'LCD LENOVO K14 - K14 PLUS - K15 - K15 PLUS - NOTE 13', '17942474426af20b1241e68.png', 'active', '2026-11-09 18:04:02', '2026-11-13 08:20:59', 9),
(253, 'WIKO T3', 'LCD WIKO T3', '17942475286af20b6807b83.png', 'active', '2026-11-09 18:05:28', '2026-11-13 08:20:59', 8),
(254, 'WIKO T10', 'LCD WIKO T10', '17942475756af20b97655fc.png', 'active', '2026-11-09 18:06:15', '2026-11-13 08:20:59', 7),
(255, 'VIVO Y1S - Y90 - Y93', 'LCD VIVO Y1S - Y90 - Y93', '17945573086af6c57c0c0fa.png', 'active', '2026-11-13 08:08:28', '2026-11-13 08:20:59', 6),
(256, 'VIVO Y11 – Y12 – Y15 – Y17', 'LCD VIVO Y11 – Y12 – Y15 – Y17', '17945573766af6c5c0d11f6.png', 'active', '2026-11-13 08:09:36', '2026-11-13 08:20:59', 5),
(257, 'VIVO Y20 - Y20s - Y20i - Y11s - Y12s - Y15s – Y12a', 'LCD VIVO Y20 - Y20s - Y20i - Y11s - Y12s - Y15s – Y12a', '17945575276af6c6572828c.png', 'active', '2026-11-13 08:12:07', '2026-11-13 08:20:59', 3),
(258, 'VIVO Y21 -Y21s - Y33s - Y02s - Y32 - Y025 - Y16', 'LCD VIVO Y21 -Y21s - Y33s - Y02s - Y32 - Y025 - Y16', '17945577156af6c71345566.png', 'active', '2026-11-13 08:15:15', '2026-11-13 08:20:59', 2),
(259, 'VIVO Y30 - Y30I', 'LCD VIVO Y30 - Y30I', '17945577756af6c74f6b6e1.png', 'active', '2026-11-13 08:16:15', '2026-11-13 08:20:59', 1),
(260, 'VIVO Y51 2020 – Y53s', 'LCD VIVO Y51 2020 – Y53s', '17945578226af6c77e7f123.png', 'active', '2026-11-13 08:17:02', '2026-11-13 08:30:34', 6),
(261, 'VIVO Y19 - Y5S', 'LCD VIVO Y19 - Y5S', '17945580526af6c8645ae05.png', 'active', '2026-11-13 08:20:52', '2026-11-13 08:20:59', 4),
(262, 'OPPO A12 - A5s - A7 – REALME 3 – REALME 3I', 'LCD OPPO A12 - A5s - A7 – REALME 3 – REALME 3I', '17945581706af6c8da7f310.png', 'active', '2026-11-13 08:22:50', '2026-11-13 08:30:34', 5),
(263, 'OPPO A52 - A72 - A92', 'LCD OPPO A52 - A72 - A92', '17945582726af6c940a08e1.png', 'active', '2026-11-13 08:24:32', '2026-11-13 08:30:34', 4),
(264, 'LCD OPPO A54 5G - A55 5G', 'LCD OPPO A54 5G - A55 5G', '17945583426af6c9865efb2.png', 'active', '2026-11-13 08:25:42', '2026-11-13 08:30:34', 3),
(265, 'OPPO A57 5G - OPPO A57 4G - OPPO A18 - OPPO A38', 'LCD OPPO A57 5G - OPPO A57 4G - OPPO A18 - OPPO A38', '17945584726af6ca08ad138.png', 'active', '2026-11-13 08:27:52', '2026-11-13 08:30:34', 2),
(266, 'OPPO A36 2022 - A76 2022', 'LCD OPPO A36 2022 - A76 2022', '17945585476af6ca53877d1.png', 'active', '2026-11-13 08:29:07', '2026-11-13 08:30:34', 1),
(267, 'OPPO A93 – RENO 4-RENO 4LITE', 'LCD OPPO A93 – RENO 4-RENO 4LITE', '17945586146af6ca9626b94.png', 'active', '2026-11-13 08:30:14', '2026-11-13 08:30:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_metas`
--

CREATE TABLE `service_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `services_id` bigint(20) UNSIGNED NOT NULL,
  `type` longtext NOT NULL,
  `value` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_metas`
--

INSERT INTO `service_metas` (`id`, `services_id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(263, 30, 'brand', 'SAMSUNG', '2026-11-04 18:08:57', '2026-11-04 18:08:57'),
(264, 30, 'model', 'J200', '2026-11-04 18:08:57', '2026-11-04 18:08:57'),
(265, 30, 'price', '15000', '2026-11-04 18:08:57', '2026-11-04 18:08:57'),
(266, 30, 'discount', '11000', '2026-11-04 18:08:57', '2026-11-04 18:08:57'),
(267, 30, 'skill', 'تبديل شاشة', '2026-11-04 18:08:57', '2026-11-04 18:08:57'),
(268, 31, 'brand', 'SAMSUNG', '2026-11-04 18:14:23', '2026-11-04 18:14:23'),
(269, 31, 'model', 'J260', '2026-11-04 18:14:23', '2026-11-04 18:14:23'),
(270, 31, 'price', '30000', '2026-11-04 18:14:23', '2026-11-04 18:14:23'),
(271, 31, 'discount', '24000', '2026-11-04 18:14:23', '2026-11-04 18:14:23'),
(272, 31, 'skill', 'تبديل شاشة', '2026-11-04 18:14:23', '2026-11-04 18:14:23'),
(273, 32, 'brand', 'SAMSUNG', '2026-11-04 18:19:13', '2026-11-04 18:19:13'),
(274, 32, 'model', 'J320', '2026-11-04 18:19:13', '2026-11-04 18:19:13'),
(275, 32, 'price', '18000', '2026-11-04 18:19:13', '2026-11-04 18:19:13'),
(276, 32, 'discount', '15000', '2026-11-04 18:19:13', '2026-11-04 18:19:13'),
(277, 32, 'skill', 'تبديل شاشة', '2026-11-04 18:19:13', '2026-11-04 18:19:13'),
(278, 33, 'brand', 'SAMSUNG', '2026-11-04 18:22:32', '2026-11-04 18:22:32'),
(279, 33, 'model', 'J400', '2026-11-04 18:22:32', '2026-11-04 18:22:32'),
(280, 33, 'price', '18000', '2026-11-04 18:22:32', '2026-11-04 18:22:32'),
(281, 33, 'discount', '12000', '2026-11-04 18:22:32', '2026-11-04 18:22:32'),
(282, 33, 'skill', 'تبديل شاشة', '2026-11-04 18:22:32', '2026-11-04 18:22:32'),
(283, 34, 'brand', 'SAMSUNG', '2026-11-04 18:23:37', '2026-11-04 18:23:37'),
(284, 34, 'model', 'J500', '2026-11-04 18:23:37', '2026-11-04 18:23:37'),
(285, 34, 'price', '18000', '2026-11-04 18:23:37', '2026-11-04 18:23:37'),
(286, 34, 'discount', '13000', '2026-11-04 18:23:37', '2026-11-04 18:23:37'),
(287, 34, 'skill', 'تبديل شاشة', '2026-11-04 18:23:37', '2026-11-04 18:23:37'),
(288, 35, 'brand', 'SAMSUNG', '2026-11-04 18:25:01', '2026-11-04 18:25:01'),
(289, 35, 'model', 'J510', '2026-11-04 18:25:01', '2026-11-04 18:25:01'),
(290, 35, 'price', '18000', '2026-11-04 18:25:01', '2026-11-04 18:25:01'),
(291, 35, 'discount', '14000', '2026-11-04 18:25:01', '2026-11-04 18:25:01'),
(292, 35, 'skill', 'تبديل شاشة', '2026-11-04 18:25:01', '2026-11-04 18:25:01'),
(293, 36, 'brand', 'SAMSUNG', '2026-11-04 18:32:16', '2026-11-04 18:32:16'),
(294, 36, 'model', 'J610-J410', '2026-11-04 18:32:16', '2026-11-04 18:32:16'),
(295, 36, 'price', '18000', '2026-11-04 18:32:16', '2026-11-04 18:32:16'),
(296, 36, 'discount', '12000', '2026-11-04 18:32:16', '2026-11-04 18:32:16'),
(297, 36, 'skill', 'تبديل شاشة', '2026-11-04 18:32:16', '2026-11-04 18:32:16'),
(298, 37, 'brand', 'SAMSUNG', '2026-11-04 18:34:39', '2026-11-04 18:34:39'),
(299, 37, 'model', 'G570 - J5 PRIME', '2026-11-04 18:34:39', '2026-11-04 18:34:39'),
(300, 37, 'price', '18000', '2026-11-04 18:34:39', '2026-11-04 18:34:39'),
(301, 37, 'discount', '12000', '2026-11-04 18:34:39', '2026-11-04 18:34:39'),
(302, 37, 'skill', 'تبديل شاشة', '2026-11-04 18:34:39', '2026-11-04 18:34:39'),
(303, 38, 'brand', 'SAMSUNG', '2026-11-04 18:35:42', '2026-11-04 18:35:42'),
(304, 38, 'model', 'J700', '2026-11-04 18:35:42', '2026-11-04 18:35:42'),
(305, 38, 'price', '30000', '2026-11-04 18:35:42', '2026-11-04 18:35:42'),
(306, 38, 'discount', '27000', '2026-11-04 18:35:42', '2026-11-04 18:35:42'),
(307, 38, 'skill', 'تبديل شاشة', '2026-11-04 18:35:42', '2026-11-04 18:35:42'),
(308, 39, 'brand', 'SAMSUNG', '2026-11-04 18:37:25', '2026-11-04 18:37:25'),
(309, 39, 'model', 'G610 - J7 PRIME', '2026-11-04 18:37:25', '2026-11-04 18:37:25'),
(310, 39, 'price', '18000', '2026-11-04 18:37:25', '2026-11-04 18:37:25'),
(311, 39, 'discount', '14000', '2026-11-04 18:37:25', '2026-11-04 18:37:25'),
(312, 39, 'skill', 'تبديل شاشة', '2026-11-04 18:37:25', '2026-11-04 18:37:25'),
(313, 40, 'brand', 'SAMSUNG', '2026-11-04 18:39:11', '2026-11-04 18:39:11'),
(314, 40, 'model', 'J530 - J5 PRO', '2026-11-04 18:39:11', '2026-11-04 18:39:11'),
(315, 40, 'price', '30000', '2026-11-04 18:39:11', '2026-11-04 18:39:11'),
(316, 40, 'discount', '26000', '2026-11-04 18:39:11', '2026-11-04 18:39:11'),
(317, 40, 'skill', 'تبديل شاشة', '2026-11-04 18:39:11', '2026-11-04 18:39:11'),
(318, 41, 'brand', 'SAMSUNG', '2026-11-04 18:40:49', '2026-11-04 18:40:49'),
(319, 41, 'model', 'J730 - J7 PRO', '2026-11-04 18:40:49', '2026-11-04 18:40:49'),
(320, 41, 'price', '18000', '2026-11-04 18:40:49', '2026-11-04 18:40:49'),
(321, 41, 'discount', '14000', '2026-11-04 18:40:49', '2026-11-04 18:40:49'),
(322, 41, 'skill', 'تبديل شاشة', '2026-11-04 18:40:49', '2026-11-04 18:40:49'),
(323, 42, 'brand', 'SAMSUNG', '2026-11-05 16:37:28', '2026-11-05 16:37:28'),
(324, 42, 'model', 'SAMSUNG A01', '2026-11-05 16:37:28', '2026-11-05 16:37:28'),
(325, 42, 'price', '15000', '2026-11-05 16:37:28', '2026-11-05 16:37:28'),
(326, 42, 'discount', '12000', '2026-11-05 16:37:28', '2026-11-05 16:37:28'),
(327, 42, 'skill', 'تبديل شاشة', '2026-11-05 16:37:28', '2026-11-05 16:37:28'),
(338, 44, 'brand', 'SAMSUNG', '2026-11-05 16:41:10', '2026-11-05 16:41:10'),
(339, 44, 'model', 'SAMSUNG A04', '2026-11-05 16:41:10', '2026-11-05 16:41:10'),
(340, 44, 'price', '18000', '2026-11-05 16:41:10', '2026-11-05 16:41:10'),
(341, 44, 'discount', '14000', '2026-11-05 16:41:10', '2026-11-05 16:41:10'),
(342, 44, 'skill', 'تبديل شاشة', '2026-11-05 16:41:10', '2026-11-05 16:41:10'),
(343, 43, 'brand', 'SAMSUNG', '2026-11-05 16:41:33', '2026-11-05 16:41:33'),
(344, 43, 'model', 'SAMSUNG A02S - A03S - A03 - A04E', '2026-11-05 16:41:33', '2026-11-05 16:41:33'),
(345, 43, 'price', '20000', '2026-11-05 16:41:33', '2026-11-05 16:41:33'),
(346, 43, 'discount', '16000', '2026-11-05 16:41:33', '2026-11-05 16:41:33'),
(347, 43, 'skill', 'تبديل شاشة', '2026-11-05 16:41:33', '2026-11-05 16:41:33'),
(353, 46, 'brand', 'SAMSUNG', '2026-11-05 16:46:54', '2026-11-05 16:46:54'),
(354, 46, 'model', 'SAMSUNG A05', '2026-11-05 16:46:54', '2026-11-05 16:46:54'),
(355, 46, 'price', '20000', '2026-11-05 16:46:54', '2026-11-05 16:46:54'),
(356, 46, 'discount', '15000', '2026-11-05 16:46:54', '2026-11-05 16:46:54'),
(357, 46, 'skill', 'تبديل شاشة', '2026-11-05 16:46:54', '2026-11-05 16:46:54'),
(358, 47, 'brand', 'SAMSUNG', '2026-11-05 16:47:48', '2026-11-05 16:47:48'),
(359, 47, 'model', 'SAMSUNG A05s', '2026-11-05 16:47:48', '2026-11-05 16:47:48'),
(360, 47, 'price', '25000', '2026-11-05 16:47:48', '2026-11-05 16:47:48'),
(361, 47, 'discount', '20000', '2026-11-05 16:47:48', '2026-11-05 16:47:48'),
(362, 47, 'skill', 'تبديل شاشة', '2026-11-05 16:47:48', '2026-11-05 16:47:48'),
(363, 48, 'brand', 'SAMSUNG', '2026-11-05 16:50:01', '2026-11-05 16:50:01'),
(364, 48, 'model', 'SAMSUNG A06', '2026-11-05 16:50:01', '2026-11-05 16:50:01'),
(365, 48, 'price', '20000', '2026-11-05 16:50:01', '2026-11-05 16:50:01'),
(366, 48, 'discount', '16000', '2026-11-05 16:50:01', '2026-11-05 16:50:01'),
(367, 48, 'skill', 'تبديل شاشة', '2026-11-05 16:50:01', '2026-11-05 16:50:01'),
(368, 49, 'brand', 'SAMSUNG', '2026-11-05 16:58:27', '2026-11-05 16:58:27'),
(369, 49, 'model', 'SAMSUNG A125 - A127 - A02 - M125 - M127', '2026-11-05 16:58:27', '2026-11-05 16:58:27'),
(370, 49, 'price', '20000', '2026-11-05 16:58:27', '2026-11-05 16:58:27'),
(371, 49, 'discount', '17000', '2026-11-05 16:58:27', '2026-11-05 16:58:27'),
(372, 49, 'skill', 'تبديل شاشة', '2026-11-05 16:58:27', '2026-11-05 16:58:27'),
(373, 50, 'brand', 'SAMSUNG', '2026-11-05 16:59:36', '2026-11-05 16:59:36'),
(374, 50, 'model', 'SAMSUNG A10', '2026-11-05 16:59:36', '2026-11-05 16:59:36'),
(375, 50, 'price', '20000', '2026-11-05 16:59:36', '2026-11-05 16:59:36'),
(376, 50, 'discount', '16000', '2026-11-05 16:59:36', '2026-11-05 16:59:36'),
(377, 50, 'skill', 'تبديل شاشة', '2026-11-05 16:59:36', '2026-11-05 16:59:36'),
(378, 51, 'brand', 'SAMSUNG', '2026-11-05 17:00:35', '2026-11-05 17:00:35'),
(379, 51, 'model', 'SAMSUNG A10s', '2026-11-05 17:00:35', '2026-11-05 17:00:35'),
(380, 51, 'price', '20000', '2026-11-05 17:00:35', '2026-11-05 17:00:35'),
(381, 51, 'discount', '16000', '2026-11-05 17:00:35', '2026-11-05 17:00:35'),
(382, 51, 'skill', 'تبديل شاشة', '2026-11-05 17:00:35', '2026-11-05 17:00:35'),
(383, 52, 'brand', 'SAMSUNG', '2026-11-05 17:01:54', '2026-11-05 17:01:54'),
(384, 52, 'model', 'SAMSUNG a11 - m11', '2026-11-05 17:01:54', '2026-11-05 17:01:54'),
(385, 52, 'price', '20000', '2026-11-05 17:01:54', '2026-11-05 17:01:54'),
(386, 52, 'discount', '16000', '2026-11-05 17:01:54', '2026-11-05 17:01:54'),
(387, 52, 'skill', 'تبديل شاشة', '2026-11-05 17:01:54', '2026-11-05 17:01:54'),
(388, 45, 'brand', 'SAMSUNG', '2026-11-05 17:03:30', '2026-11-05 17:03:30'),
(389, 45, 'model', 'SAMSUNG A03 CORE', '2026-11-05 17:03:30', '2026-11-05 17:03:30'),
(390, 45, 'price', '18000', '2026-11-05 17:03:30', '2026-11-05 17:03:30'),
(391, 45, 'discount', '15000', '2026-11-05 17:03:30', '2026-11-05 17:03:30'),
(392, 45, 'skill', 'تبديل شاشة', '2026-11-05 17:03:30', '2026-11-05 17:03:30'),
(393, 53, 'brand', 'SAMSUNG', '2026-11-05 17:05:24', '2026-11-05 17:05:24'),
(394, 53, 'model', 'SAMSUNG A13 4G', '2026-11-05 17:05:24', '2026-11-05 17:05:24'),
(395, 53, 'price', '18000', '2026-11-05 17:05:24', '2026-11-05 17:05:24'),
(396, 53, 'discount', '15000', '2026-11-05 17:05:24', '2026-11-05 17:05:24'),
(397, 53, 'skill', 'تبديل شاشة', '2026-11-05 17:05:24', '2026-11-05 17:05:24'),
(398, 54, 'brand', 'SAMSUNG', '2026-11-05 17:06:45', '2026-11-05 17:06:45'),
(399, 54, 'model', 'SAMSUNG A13 5G - A04s', '2026-11-05 17:06:45', '2026-11-05 17:06:45'),
(400, 54, 'price', '18000', '2026-11-05 17:06:45', '2026-11-05 17:06:45'),
(401, 54, 'discount', '13000', '2026-11-05 17:06:45', '2026-11-05 17:06:45'),
(402, 54, 'skill', 'تبديل شاشة', '2026-11-05 17:06:45', '2026-11-05 17:06:45'),
(403, 55, 'brand', 'SAMSUNG', '2026-11-05 17:08:49', '2026-11-05 17:08:49'),
(404, 55, 'model', 'SAMSUNG A14 4G', '2026-11-05 17:08:49', '2026-11-05 17:08:49'),
(405, 55, 'price', '20000', '2026-11-05 17:08:49', '2026-11-05 17:08:49'),
(406, 55, 'discount', '17000', '2026-11-05 17:08:49', '2026-11-05 17:08:49'),
(407, 55, 'skill', 'تيديل شاشة', '2026-11-05 17:08:49', '2026-11-05 17:08:49'),
(408, 56, 'brand', 'SAMSUNG', '2026-11-05 17:09:40', '2026-11-05 17:09:40'),
(409, 56, 'model', 'SAMSUNG A14 5G', '2026-11-05 17:09:40', '2026-11-05 17:09:40'),
(410, 56, 'price', '20000', '2026-11-05 17:09:40', '2026-11-05 17:09:40'),
(411, 56, 'discount', '17000', '2026-11-05 17:09:40', '2026-11-05 17:09:40'),
(412, 56, 'skill', 'تبديل شاشة', '2026-11-05 17:09:40', '2026-11-05 17:09:40'),
(413, 57, 'brand', 'SAMSUNG', '2026-11-05 17:10:48', '2026-11-05 17:10:48'),
(414, 57, 'model', 'SAMSUNG A15', '2026-11-05 17:10:48', '2026-11-05 17:10:48'),
(415, 57, 'price', '25000', '2026-11-05 17:10:48', '2026-11-05 17:10:48'),
(416, 57, 'discount', '20000', '2026-11-05 17:10:48', '2026-11-05 17:10:48'),
(417, 57, 'skill', 'تبديل شاشة', '2026-11-05 17:10:48', '2026-11-05 17:10:48'),
(423, 58, 'brand', 'SAMSUNG', '2026-11-05 17:13:10', '2026-11-05 17:13:10'),
(424, 58, 'model', 'SAMSUNG A16 4G', '2026-11-05 17:13:10', '2026-11-05 17:13:10'),
(425, 58, 'price', '25000', '2026-11-05 17:13:10', '2026-11-05 17:13:10'),
(426, 58, 'discount', '20000', '2026-11-05 17:13:10', '2026-11-05 17:13:10'),
(427, 58, 'skill', 'تبديل شاشة', '2026-11-05 17:13:10', '2026-11-05 17:13:10'),
(428, 59, 'brand', 'SAMSUNG', '2026-11-05 17:14:01', '2026-11-05 17:14:01'),
(429, 59, 'model', 'SAMSUNG A16 5G', '2026-11-05 17:14:01', '2026-11-05 17:14:01'),
(430, 59, 'price', '25000', '2026-11-05 17:14:01', '2026-11-05 17:14:01'),
(431, 59, 'discount', '20000', '2026-11-05 17:14:01', '2026-11-05 17:14:01'),
(432, 59, 'skill', 'تبديل شاشة', '2026-11-05 17:14:01', '2026-11-05 17:14:01'),
(433, 60, 'brand', 'SAMSUNG', '2026-11-05 18:14:00', '2026-11-05 18:14:00'),
(434, 60, 'model', 'SAMSUNG A20', '2026-11-05 18:14:00', '2026-11-05 18:14:00'),
(435, 60, 'price', '35000', '2026-11-05 18:14:00', '2026-11-05 18:14:00'),
(436, 60, 'discount', '20000', '2026-11-05 18:14:00', '2026-11-05 18:14:00'),
(437, 60, 'skill', 'تبديل شاشة', '2026-11-05 18:14:00', '2026-11-05 18:14:00'),
(438, 61, 'brand', 'SAMSUNG', '2026-11-05 18:15:11', '2026-11-05 18:15:11'),
(439, 61, 'model', 'SAMSUNG A20s', '2026-11-05 18:15:11', '2026-11-05 18:15:11'),
(440, 61, 'price', '20000', '2026-11-05 18:15:11', '2026-11-05 18:15:11'),
(441, 61, 'discount', '18000', '2026-11-05 18:15:11', '2026-11-05 18:15:11'),
(442, 61, 'skill', 'تبديل شاشة', '2026-11-05 18:15:11', '2026-11-05 18:15:11'),
(443, 62, 'brand', 'SAMSUNG', '2026-11-05 18:16:16', '2026-11-05 18:16:16'),
(444, 62, 'model', 'SAMSUNG A21s', '2026-11-05 18:16:16', '2026-11-05 18:16:16'),
(445, 62, 'price', '18000', '2026-11-05 18:16:16', '2026-11-05 18:16:16'),
(446, 62, 'discount', '15000', '2026-11-05 18:16:16', '2026-11-05 18:16:16'),
(447, 62, 'skill', 'تبديل شاشة', '2026-11-05 18:16:16', '2026-11-05 18:16:16'),
(448, 63, 'brand', 'SAMSUNG', '2026-11-05 18:17:43', '2026-11-05 18:17:43'),
(449, 63, 'model', 'SAMSUNG A23 4G', '2026-11-05 18:17:43', '2026-11-05 18:17:43'),
(450, 63, 'price', '25000', '2026-11-05 18:17:43', '2026-11-05 18:17:43'),
(451, 63, 'discount', '18000', '2026-11-05 18:17:43', '2026-11-05 18:17:43'),
(452, 63, 'skill', 'تبديل شاشة', '2026-11-05 18:17:43', '2026-11-05 18:17:43'),
(453, 64, 'brand', 'SAMSUNG', '2026-11-05 18:22:49', '2026-11-05 18:22:49'),
(454, 64, 'model', 'SAMSUNG A25 - A24 4G - M34 5G', '2026-11-05 18:22:49', '2026-11-05 18:22:49'),
(455, 64, 'price', '25000', '2026-11-05 18:22:49', '2026-11-05 18:22:49'),
(456, 64, 'discount', '20000', '2026-11-05 18:22:49', '2026-11-05 18:22:49'),
(457, 64, 'skill', 'تبديل شاشة', '2026-11-05 18:22:49', '2026-11-05 18:22:49'),
(458, 65, 'brand', 'SAMSUNG', '2026-11-05 18:25:37', '2026-11-05 18:25:37'),
(459, 65, 'model', 'SAMSUNG A30s', '2026-11-05 18:25:37', '2026-11-05 18:25:37'),
(460, 65, 'price', '18000', '2026-11-05 18:25:37', '2026-11-05 18:25:37'),
(461, 65, 'discount', '15000', '2026-11-05 18:25:37', '2026-11-05 18:25:37'),
(462, 65, 'skill', 'تبديل شاشة', '2026-11-05 18:25:37', '2026-11-05 18:25:37'),
(468, 66, 'brand', 'SAMSUNG', '2026-11-05 18:26:54', '2026-11-05 18:26:54'),
(469, 66, 'model', 'SAMSUNG A31', '2026-11-05 18:26:54', '2026-11-05 18:26:54'),
(470, 66, 'price', '25000', '2026-11-05 18:26:54', '2026-11-05 18:26:54'),
(471, 66, 'discount', '17000', '2026-11-05 18:26:54', '2026-11-05 18:26:54'),
(472, 66, 'skill', 'تبديل شاشة', '2026-11-05 18:26:54', '2026-11-05 18:26:54'),
(473, 67, 'brand', 'SAMSUNG', '2026-11-05 18:28:02', '2026-11-05 18:28:02'),
(474, 67, 'model', 'SAMSUNG A32 4G', '2026-11-05 18:28:02', '2026-11-05 18:28:02'),
(475, 67, 'price', '25000', '2026-11-05 18:28:02', '2026-11-05 18:28:02'),
(476, 67, 'discount', '17000', '2026-11-05 18:28:02', '2026-11-05 18:28:02'),
(477, 67, 'skill', 'تبديل شاشة', '2026-11-05 18:28:02', '2026-11-05 18:28:02'),
(478, 68, 'brand', 'SAMSUNG', '2026-11-05 18:29:03', '2026-11-05 18:29:03'),
(479, 68, 'model', 'SAMSUNG A34', '2026-11-05 18:29:03', '2026-11-05 18:29:03'),
(480, 68, 'price', '45000', '2026-11-05 18:29:03', '2026-11-05 18:29:03'),
(481, 68, 'discount', '35000', '2026-11-05 18:29:03', '2026-11-05 18:29:03'),
(482, 68, 'skill', 'تبديل شاشة', '2026-11-05 18:29:03', '2026-11-05 18:29:03'),
(483, 69, 'brand', 'SAMSUNG', '2026-11-05 18:29:48', '2026-11-05 18:29:48'),
(484, 69, 'model', 'SAMSUNG A35', '2026-11-05 18:29:48', '2026-11-05 18:29:48'),
(485, 69, 'price', '25000', '2026-11-05 18:29:48', '2026-11-05 18:29:48'),
(486, 69, 'discount', '20000', '2026-11-05 18:29:48', '2026-11-05 18:29:48'),
(487, 69, 'skill', 'تبديل شاشة', '2026-11-05 18:29:48', '2026-11-05 18:29:48'),
(488, 70, 'brand', 'SAMSUNG', '2026-11-05 18:31:14', '2026-11-05 18:31:14'),
(489, 70, 'model', 'SAMSUNG A50 - A30', '2026-11-05 18:31:14', '2026-11-05 18:31:14'),
(490, 70, 'price', '25000', '2026-11-05 18:31:14', '2026-11-05 18:31:14'),
(491, 70, 'discount', '18000', '2026-11-05 18:31:14', '2026-11-05 18:31:14'),
(492, 70, 'skill', 'تبديل شاشة', '2026-11-05 18:31:14', '2026-11-05 18:31:14'),
(493, 71, 'brand', 'SAMSUNG', '2026-11-05 18:32:30', '2026-11-05 18:32:30'),
(494, 71, 'model', 'SAMSUNG A51', '2026-11-05 18:32:30', '2026-11-05 18:32:30'),
(495, 71, 'price', '45000', '2026-11-05 18:32:30', '2026-11-05 18:32:30'),
(496, 71, 'discount', '35000', '2026-11-05 18:32:30', '2026-11-05 18:32:30'),
(497, 71, 'skill', 'تبديل شاشة', '2026-11-05 18:32:30', '2026-11-05 18:32:30'),
(498, 72, 'brand', 'SAMSUNG', '2026-11-05 18:33:54', '2026-11-05 18:33:54'),
(499, 72, 'model', 'SAMSUNG A52 5G', '2026-11-05 18:33:54', '2026-11-05 18:33:54'),
(500, 72, 'price', '45000', '2026-11-05 18:33:54', '2026-11-05 18:33:54'),
(501, 72, 'discount', '40000', '2026-11-05 18:33:54', '2026-11-05 18:33:54'),
(502, 72, 'skill', 'تبديل شاشة', '2026-11-05 18:33:54', '2026-11-05 18:33:54'),
(503, 73, 'brand', 'SAMSUNG', '2026-11-05 18:35:04', '2026-11-05 18:35:04'),
(504, 73, 'model', 'SAMSUNG A53 5G', '2026-11-05 18:35:04', '2026-11-05 18:35:04'),
(505, 73, 'price', '45000', '2026-11-05 18:35:04', '2026-11-05 18:35:04'),
(506, 73, 'discount', '35000', '2026-11-05 18:35:04', '2026-11-05 18:35:04'),
(507, 73, 'skill', 'تبديل شاشة', '2026-11-05 18:35:04', '2026-11-05 18:35:04'),
(508, 74, 'brand', 'SAMSUNG', '2026-11-05 18:36:09', '2026-11-05 18:36:09'),
(509, 74, 'model', 'SAMSUNG A54 5G', '2026-11-05 18:36:09', '2026-11-05 18:36:09'),
(510, 74, 'price', '25000', '2026-11-05 18:36:09', '2026-11-05 18:36:09'),
(511, 74, 'discount', '18000', '2026-11-05 18:36:09', '2026-11-05 18:36:09'),
(512, 74, 'skill', 'تبديل شاشة', '2026-11-05 18:36:09', '2026-11-05 18:36:09'),
(513, 75, 'brand', 'SAMSUNG', '2026-11-05 18:38:09', '2026-11-05 18:38:09'),
(514, 75, 'model', 'SAMSUNG A520', '2026-11-05 18:38:09', '2026-11-05 18:38:09'),
(515, 75, 'price', '35000', '2026-11-05 18:38:09', '2026-11-05 18:38:09'),
(516, 75, 'discount', '30000', '2026-11-05 18:38:09', '2026-11-05 18:38:09'),
(517, 75, 'skill', 'تبديل شاشة', '2026-11-05 18:38:09', '2026-11-05 18:38:09'),
(518, 76, 'brand', 'SAMSUNG', '2026-11-05 18:39:23', '2026-11-05 18:39:23'),
(519, 76, 'model', 'SAMSUNG A605', '2026-11-05 18:39:23', '2026-11-05 18:39:23'),
(520, 76, 'price', '18000', '2026-11-05 18:39:23', '2026-11-05 18:39:23'),
(521, 76, 'discount', '14000', '2026-11-05 18:39:23', '2026-11-05 18:39:23'),
(522, 76, 'skill', 'تبديل شاشة', '2026-11-05 18:39:23', '2026-11-05 18:39:23'),
(523, 77, 'brand', 'SAMSUNG', '2026-11-05 18:40:58', '2026-11-05 18:40:58'),
(524, 77, 'model', 'SAMSUNG A71', '2026-11-05 18:40:58', '2026-11-05 18:40:58'),
(525, 77, 'price', '50000', '2026-11-05 18:40:58', '2026-11-05 18:40:58'),
(526, 77, 'discount', '43000', '2026-11-05 18:40:58', '2026-11-05 18:40:58'),
(527, 77, 'skill', 'تبديل شاشة', '2026-11-05 18:40:58', '2026-11-05 18:40:58'),
(528, 78, 'brand', 'SAMSUNG', '2026-11-05 18:42:18', '2026-11-05 18:42:18'),
(529, 78, 'model', 'SAMSUNG A72 4G', '2026-11-05 18:42:18', '2026-11-05 18:42:18'),
(530, 78, 'price', '45000', '2026-11-05 18:42:18', '2026-11-05 18:42:18'),
(531, 78, 'discount', '35000', '2026-11-05 18:42:18', '2026-11-05 18:42:18'),
(532, 78, 'skill', 'تبديل شاشة', '2026-11-05 18:42:18', '2026-11-05 18:42:18'),
(533, 79, 'brand', 'SAMSUNG', '2026-11-05 18:43:41', '2026-11-05 18:43:41'),
(534, 79, 'model', 'SAMSUNG A750', '2026-11-05 18:43:41', '2026-11-05 18:43:41'),
(535, 79, 'price', '25000', '2026-11-05 18:43:41', '2026-11-05 18:43:41'),
(536, 79, 'discount', '18000', '2026-11-05 18:43:41', '2026-11-05 18:43:41'),
(537, 79, 'skill', 'تبديل شاشة', '2026-11-05 18:43:41', '2026-11-05 18:43:41'),
(538, 80, 'brand', 'SAMSUNG', '2026-11-05 18:44:38', '2026-11-05 18:44:38'),
(539, 80, 'model', 'SAMSUNG A920', '2026-11-05 18:44:38', '2026-11-05 18:44:38'),
(540, 80, 'price', '45000', '2026-11-05 18:44:38', '2026-11-05 18:44:38'),
(541, 80, 'discount', '38000', '2026-11-05 18:44:38', '2026-11-05 18:44:38'),
(542, 80, 'skill', 'تبديل شاشة', '2026-11-05 18:44:38', '2026-11-05 18:44:38'),
(553, 83, 'brand', 'iPhone', '2026-11-06 07:36:35', '2026-11-06 07:36:35'),
(554, 83, 'model', 'IPHONE 6S', '2026-11-06 07:36:35', '2026-11-06 07:36:35'),
(555, 83, 'price', '18000', '2026-11-06 07:36:35', '2026-11-06 07:36:35'),
(556, 83, 'discount', '12000', '2026-11-06 07:36:35', '2026-11-06 07:36:35'),
(557, 83, 'skill', 'تبديل شاشة', '2026-11-06 07:36:35', '2026-11-06 07:36:35'),
(558, 84, 'brand', 'iPhone', '2026-11-06 07:38:12', '2026-11-06 07:38:12'),
(559, 84, 'model', 'IPHONE 7 PLUS', '2026-11-06 07:38:12', '2026-11-06 07:38:12'),
(560, 84, 'price', '25000', '2026-11-06 07:38:12', '2026-11-06 07:38:12'),
(561, 84, 'discount', '20000', '2026-11-06 07:38:12', '2026-11-06 07:38:12'),
(562, 84, 'skill', 'تبديل شاشة', '2026-11-06 07:38:12', '2026-11-06 07:38:12'),
(563, 85, 'brand', 'iPhone', '2026-11-06 07:40:50', '2026-11-06 07:40:50'),
(564, 85, 'model', 'IPHONE 8 PLUS', '2026-11-06 07:40:50', '2026-11-06 07:40:50'),
(565, 85, 'price', '25000', '2026-11-06 07:40:50', '2026-11-06 07:40:50'),
(566, 85, 'discount', '20000', '2026-11-06 07:40:50', '2026-11-06 07:40:50'),
(567, 85, 'skill', 'تبديل شاشة', '2026-11-06 07:40:50', '2026-11-06 07:40:50'),
(573, 82, 'brand', 'iPhone', '2026-11-06 07:44:01', '2026-11-06 07:44:01'),
(574, 82, 'model', 'IPHONE 6G PLUS', '2026-11-06 07:44:01', '2026-11-06 07:44:01'),
(575, 82, 'price', '30000', '2026-11-06 07:44:01', '2026-11-06 07:44:01'),
(576, 82, 'discount', '24000', '2026-11-06 07:44:01', '2026-11-06 07:44:01'),
(577, 82, 'skill', 'تبديل شاشة', '2026-11-06 07:44:01', '2026-11-06 07:44:01'),
(583, 81, 'brand', 'iPhone', '2026-11-06 07:46:04', '2026-11-06 07:46:04'),
(584, 81, 'model', 'IPHONE 6G', '2026-11-06 07:46:04', '2026-11-06 07:46:04'),
(585, 81, 'price', '18000', '2026-11-06 07:46:04', '2026-11-06 07:46:04'),
(586, 81, 'discount', '12000', '2026-11-06 07:46:04', '2026-11-06 07:46:04'),
(587, 81, 'skill', 'تبديل شاشة', '2026-11-06 07:46:04', '2026-11-06 07:46:04'),
(588, 86, 'brand', 'iPhone', '2026-11-06 07:51:35', '2026-11-06 07:51:35'),
(589, 86, 'model', 'IPHONE X', '2026-11-06 07:51:35', '2026-11-06 07:51:35'),
(590, 86, 'price', '25000', '2026-11-06 07:51:35', '2026-11-06 07:51:35'),
(591, 86, 'discount', '18000', '2026-11-06 07:51:35', '2026-11-06 07:51:35'),
(592, 86, 'skill', 'تبديل شاشة', '2026-11-06 07:51:35', '2026-11-06 07:51:35'),
(593, 87, 'brand', 'iPhone', '2026-11-06 07:52:59', '2026-11-06 07:52:59'),
(594, 87, 'model', 'IPHONE XS', '2026-11-06 07:52:59', '2026-11-06 07:52:59'),
(595, 87, 'price', '25000', '2026-11-06 07:52:59', '2026-11-06 07:52:59'),
(596, 87, 'discount', '18000', '2026-11-06 07:52:59', '2026-11-06 07:52:59'),
(597, 87, 'skill', 'تبديل شاشة', '2026-11-06 07:52:59', '2026-11-06 07:52:59'),
(598, 88, 'brand', 'iPhone', '2026-11-06 07:54:12', '2026-11-06 07:54:12'),
(599, 88, 'model', 'IPHONE XR', '2026-11-06 07:54:12', '2026-11-06 07:54:12'),
(600, 88, 'price', '25000', '2026-11-06 07:54:12', '2026-11-06 07:54:12'),
(601, 88, 'discount', '18000', '2026-11-06 07:54:12', '2026-11-06 07:54:12'),
(602, 88, 'skill', 'تبديل شاشة', '2026-11-06 07:54:12', '2026-11-06 07:54:12'),
(608, 89, 'brand', 'iPhone', '2026-11-06 07:57:44', '2026-11-06 07:57:44'),
(609, 89, 'model', 'IPHONE XS MAX', '2026-11-06 07:57:44', '2026-11-06 07:57:44'),
(610, 89, 'price', '55000', '2026-11-06 07:57:44', '2026-11-06 07:57:44'),
(611, 89, 'discount', '45000', '2026-11-06 07:57:44', '2026-11-06 07:57:44'),
(612, 89, 'skill', 'تبديل شاشة', '2026-11-06 07:57:44', '2026-11-06 07:57:44'),
(613, 90, 'brand', 'iPhone', '2026-11-06 07:58:57', '2026-11-06 07:58:57'),
(614, 90, 'model', 'IPHONE 11', '2026-11-06 07:58:57', '2026-11-06 07:58:57'),
(615, 90, 'price', '25000', '2026-11-06 07:58:57', '2026-11-06 07:58:57'),
(616, 90, 'discount', '18000', '2026-11-06 07:58:57', '2026-11-06 07:58:57'),
(617, 90, 'skill', 'تبديل شاشة', '2026-11-06 07:58:57', '2026-11-06 07:58:57'),
(618, 91, 'brand', 'iPhone', '2026-11-06 08:00:28', '2026-11-06 08:00:28'),
(619, 91, 'model', 'IPHONE 11 PRO MAX', '2026-11-06 08:00:28', '2026-11-06 08:00:28'),
(620, 91, 'price', '55000', '2026-11-06 08:00:28', '2026-11-06 08:00:28'),
(621, 91, 'discount', '45000', '2026-11-06 08:00:28', '2026-11-06 08:00:28'),
(622, 91, 'skill', 'تبديل شاشة', '2026-11-06 08:00:28', '2026-11-06 08:00:28'),
(623, 92, 'brand', 'iPhone', '2026-11-06 08:20:57', '2026-11-06 08:20:57'),
(624, 92, 'model', 'IPHONE 12 - 12 PRO', '2026-11-06 08:20:57', '2026-11-06 08:20:57'),
(625, 92, 'price', '25000', '2026-11-06 08:20:57', '2026-11-06 08:20:57'),
(626, 92, 'discount', '21000', '2026-11-06 08:20:57', '2026-11-06 08:20:57'),
(627, 92, 'skill', 'تبديل شاشة', '2026-11-06 08:20:57', '2026-11-06 08:20:57'),
(628, 93, 'brand', 'iPhone', '2026-11-06 08:22:16', '2026-11-06 08:22:16'),
(629, 93, 'model', 'IPHONE 12 PRO MAX', '2026-11-06 08:22:16', '2026-11-06 08:22:16'),
(630, 93, 'price', '35000', '2026-11-06 08:22:16', '2026-11-06 08:22:16'),
(631, 93, 'discount', '25000', '2026-11-06 08:22:16', '2026-11-06 08:22:16'),
(632, 93, 'skill', 'تبديل شاشة', '2026-11-06 08:22:16', '2026-11-06 08:22:16'),
(633, 94, 'brand', 'iPhone', '2026-11-06 08:23:32', '2026-11-06 08:23:32'),
(634, 94, 'model', 'IPHONE 13', '2026-11-06 08:23:32', '2026-11-06 08:23:32'),
(635, 94, 'price', '35000', '2026-11-06 08:23:32', '2026-11-06 08:23:32'),
(636, 94, 'discount', '24000', '2026-11-06 08:23:32', '2026-11-06 08:23:32'),
(637, 94, 'skill', 'تبديل شاشة', '2026-11-06 08:23:32', '2026-11-06 08:23:32'),
(638, 95, 'brand', 'iPhone', '2026-11-06 08:24:31', '2026-11-06 08:24:31'),
(639, 95, 'model', 'IPHONE 13 PRO', '2026-11-06 08:24:31', '2026-11-06 08:24:31'),
(640, 95, 'price', '35000', '2026-11-06 08:24:31', '2026-11-06 08:24:31'),
(641, 95, 'discount', '28000', '2026-11-06 08:24:31', '2026-11-06 08:24:31'),
(642, 95, 'skill', 'تبديل شاشة', '2026-11-06 08:24:31', '2026-11-06 08:24:31'),
(643, 96, 'brand', 'iPhone', '2026-11-06 08:25:40', '2026-11-06 08:25:40'),
(644, 96, 'model', 'IPHONE 13 PRO MAX', '2026-11-06 08:25:40', '2026-11-06 08:25:40'),
(645, 96, 'price', '50000', '2026-11-06 08:25:40', '2026-11-06 08:25:40'),
(646, 96, 'discount', '40000', '2026-11-06 08:25:40', '2026-11-06 08:25:40'),
(647, 96, 'skill', 'تبديل شاشة', '2026-11-06 08:25:40', '2026-11-06 08:25:40'),
(648, 97, 'brand', 'iPhone', '2026-11-06 08:26:43', '2026-11-06 08:26:43'),
(649, 97, 'model', 'IPHONE 14', '2026-11-06 08:26:43', '2026-11-06 08:26:43'),
(650, 97, 'price', '35000', '2026-11-06 08:26:43', '2026-11-06 08:26:43'),
(651, 97, 'discount', '22000', '2026-11-06 08:26:43', '2026-11-06 08:26:43'),
(652, 97, 'skill', 'تبديل شاشة', '2026-11-06 08:26:43', '2026-11-06 08:26:43'),
(653, 98, 'brand', 'iPhone', '2026-11-06 08:27:46', '2026-11-06 08:27:46'),
(654, 98, 'model', 'IPHONE 14 PRO', '2026-11-06 08:27:46', '2026-11-06 08:27:46'),
(655, 98, 'price', '35000', '2026-11-06 08:27:46', '2026-11-06 08:27:46'),
(656, 98, 'discount', '30000', '2026-11-06 08:27:46', '2026-11-06 08:27:46'),
(657, 98, 'skill', 'تبديل شاشة', '2026-11-06 08:27:46', '2026-11-06 08:27:46'),
(658, 99, 'brand', 'iPhone', '2026-11-06 08:28:45', '2026-11-06 08:28:45'),
(659, 99, 'model', 'IPHONE 14 PRO MAX', '2026-11-06 08:28:45', '2026-11-06 08:28:45'),
(660, 99, 'price', '65000', '2026-11-06 08:28:45', '2026-11-06 08:28:45'),
(661, 99, 'discount', '55000', '2026-11-06 08:28:45', '2026-11-06 08:28:45'),
(662, 99, 'skill', 'تبديل شاشة', '2026-11-06 08:28:45', '2026-11-06 08:28:45'),
(663, 100, 'brand', 'Huawei', '2026-11-07 08:45:52', '2026-11-07 08:45:52'),
(664, 100, 'model', 'Huawei Y5 2019 - HONOR 8s', '2026-11-07 08:45:52', '2026-11-07 08:45:52'),
(665, 100, 'price', '15000', '2026-11-07 08:45:52', '2026-11-07 08:45:52'),
(666, 100, 'discount', '10000', '2026-11-07 08:45:52', '2026-11-07 08:45:52'),
(667, 100, 'skill', 'تبديل شاشة', '2026-11-07 08:45:52', '2026-11-07 08:45:52'),
(668, 101, 'brand', 'Huawei', '2026-11-07 08:47:03', '2026-11-07 08:47:03'),
(669, 101, 'model', 'Huawei Y5P 2020 - HONOR 9S', '2026-11-07 08:47:03', '2026-11-07 08:47:03'),
(670, 101, 'price', '18000', '2026-11-07 08:47:03', '2026-11-07 08:47:03'),
(671, 101, 'discount', '12000', '2026-11-07 08:47:03', '2026-11-07 08:47:03'),
(672, 101, 'skill', 'تبديل شاشة', '2026-11-07 08:47:03', '2026-11-07 08:47:03'),
(673, 102, 'brand', 'Huawei', '2026-11-07 08:47:58', '2026-11-07 08:47:58'),
(674, 102, 'model', 'Huawei  Y6P 2020 - HONON 9A', '2026-11-07 08:47:58', '2026-11-07 08:47:58'),
(675, 102, 'price', '18000', '2026-11-07 08:47:58', '2026-11-07 08:47:58'),
(676, 102, 'discount', '12000', '2026-11-07 08:47:58', '2026-11-07 08:47:58'),
(677, 102, 'skill', 'تبديل شاشة', '2026-11-07 08:47:58', '2026-11-07 08:47:58'),
(678, 103, 'brand', 'Huawei', '2026-11-07 08:49:49', '2026-11-07 08:49:49'),
(679, 103, 'model', 'Huawei Y7A - P SMART 2021 - HONOR X10 LITE', '2026-11-07 08:49:49', '2026-11-07 08:49:49'),
(680, 103, 'price', '18000', '2026-11-07 08:49:49', '2026-11-07 08:49:49'),
(681, 103, 'discount', '14000', '2026-11-07 08:49:49', '2026-11-07 08:49:49'),
(682, 103, 'skill', 'تبديل شاشة', '2026-11-07 08:49:49', '2026-11-07 08:49:49'),
(683, 104, 'brand', 'Huawei', '2026-11-07 08:51:53', '2026-11-07 08:51:53'),
(684, 104, 'model', 'Huawei NOVA 3I - MATE 20 LITE', '2026-11-07 08:51:53', '2026-11-07 08:51:53'),
(685, 104, 'price', '20000', '2026-11-07 08:51:53', '2026-11-07 08:51:53'),
(686, 104, 'discount', '16000', '2026-11-07 08:51:53', '2026-11-07 08:51:53'),
(687, 104, 'skill', 'تبديل شاشة', '2026-11-07 08:51:53', '2026-11-07 08:51:53'),
(688, 105, 'brand', 'Huawei', '2026-11-07 08:55:40', '2026-11-07 08:55:40'),
(689, 105, 'model', 'Huawei NOVA 3E - P20 LITE', '2026-11-07 08:55:40', '2026-11-07 08:55:40'),
(690, 105, 'price', '18000', '2026-11-07 08:55:40', '2026-11-07 08:55:40'),
(691, 105, 'discount', '16000', '2026-11-07 08:55:40', '2026-11-07 08:55:40'),
(692, 105, 'skill', 'تبديل شاشة', '2026-11-07 08:55:40', '2026-11-07 08:55:40'),
(693, 106, 'brand', 'Huawei', '2026-11-07 08:57:04', '2026-11-07 08:57:04'),
(694, 106, 'model', 'Huawei NOVA 5T - HONOR 20PRO - HONOR 20S', '2026-11-07 08:57:04', '2026-11-07 08:57:04'),
(695, 106, 'price', '18000', '2026-11-07 08:57:04', '2026-11-07 08:57:04'),
(696, 106, 'discount', '14000', '2026-11-07 08:57:04', '2026-11-07 08:57:04'),
(697, 106, 'skill', 'تبديل شاشة', '2026-11-07 08:57:04', '2026-11-07 08:57:04'),
(698, 107, 'brand', 'Huawei', '2026-11-07 08:58:26', '2026-11-07 08:58:26'),
(699, 107, 'model', 'Huawei NOVA 5i  -NOVA 7i - P20 LITE 2019 - P40 LITE', '2026-11-07 08:58:26', '2026-11-07 08:58:26'),
(700, 107, 'price', '18000', '2026-11-07 08:58:26', '2026-11-07 08:58:26'),
(701, 107, 'discount', '14000', '2026-11-07 08:58:26', '2026-11-07 08:58:26'),
(702, 107, 'skill', 'تبديل شاشة', '2026-11-07 08:58:26', '2026-11-07 08:58:26'),
(703, 108, 'brand', 'Huawei', '2026-11-07 09:00:53', '2026-11-07 09:00:53'),
(704, 108, 'model', 'Huawei Y9 PRIME - Y9S - 9X', '2026-11-07 09:00:53', '2026-11-07 09:00:53'),
(705, 108, 'price', '20000', '2026-11-07 09:00:53', '2026-11-07 09:00:53'),
(706, 108, 'discount', '16000', '2026-11-07 09:00:53', '2026-11-07 09:00:53'),
(707, 108, 'skill', 'تبديل شاشة', '2026-11-07 09:00:53', '2026-11-07 09:00:53'),
(708, 109, 'brand', 'Huawei', '2026-11-07 09:04:26', '2026-11-07 09:04:26'),
(709, 109, 'model', 'Huawei Y9a - X10', '2026-11-07 09:04:26', '2026-11-07 09:04:26'),
(710, 109, 'price', '25000', '2026-11-07 09:04:26', '2026-11-07 09:04:26'),
(711, 109, 'discount', '20000', '2026-11-07 09:04:26', '2026-11-07 09:04:26'),
(712, 109, 'skill', 'تبديل شاشة', '2026-11-07 09:04:26', '2026-11-07 09:04:26'),
(713, 110, 'brand', 'Huawei', '2026-11-07 09:05:44', '2026-11-07 09:05:44'),
(714, 110, 'model', 'Huawei Y9 2019 - Y8s', '2026-11-07 09:05:44', '2026-11-07 09:05:44'),
(715, 110, 'price', '25000', '2026-11-07 09:05:44', '2026-11-07 09:05:44'),
(716, 110, 'discount', '18000', '2026-11-07 09:05:44', '2026-11-07 09:05:44'),
(717, 110, 'skill', 'تبديل شاشة', '2026-11-07 09:05:44', '2026-11-07 09:05:44'),
(718, 111, 'brand', 'Honor', '2026-11-07 12:18:57', '2026-11-07 12:18:57'),
(719, 111, 'model', 'HONOR X5b', '2026-11-07 12:18:57', '2026-11-07 12:18:57'),
(720, 111, 'price', '18000', '2026-11-07 12:18:57', '2026-11-07 12:18:57'),
(721, 111, 'discount', '12000', '2026-11-07 12:18:57', '2026-11-07 12:18:57'),
(722, 111, 'skill', 'تبديل شاشة', '2026-11-07 12:18:57', '2026-11-07 12:18:57'),
(723, 112, 'brand', 'Honor', '2026-11-07 12:20:50', '2026-11-07 12:20:50'),
(724, 112, 'model', 'HONOR X5c - HONOR X5c PLUS', '2026-11-07 12:20:50', '2026-11-07 12:20:50'),
(725, 112, 'price', '25000', '2026-11-07 12:20:50', '2026-11-07 12:20:50'),
(726, 112, 'discount', '17000', '2026-11-07 12:20:50', '2026-11-07 12:20:50'),
(727, 112, 'skill', 'تبديل شاشة', '2026-11-07 12:20:50', '2026-11-07 12:20:50'),
(728, 113, 'brand', 'Honor', '2026-11-07 12:22:18', '2026-11-07 12:22:18'),
(729, 113, 'model', 'HONOR X6 2022 - X5 2023', '2026-11-07 12:22:18', '2026-11-07 12:22:18'),
(730, 113, 'price', '25000', '2026-11-07 12:22:18', '2026-11-07 12:22:18'),
(731, 113, 'discount', '18000', '2026-11-07 12:22:18', '2026-11-07 12:22:18'),
(732, 113, 'skill', 'تبديل شاشة', '2026-11-07 12:22:18', '2026-11-07 12:22:18'),
(733, 114, 'brand', 'Honor', '2026-11-07 12:23:51', '2026-11-07 12:23:51'),
(734, 114, 'model', 'HONOR X6A - X5 PLUS', '2026-11-07 12:23:51', '2026-11-07 12:23:51'),
(735, 114, 'price', '25000', '2026-11-07 12:23:51', '2026-11-07 12:23:51'),
(736, 114, 'discount', '16000', '2026-11-07 12:23:51', '2026-11-07 12:23:51'),
(737, 114, 'skill', 'تبديل شاشة', '2026-11-07 12:23:51', '2026-11-07 12:23:51'),
(743, 115, 'brand', 'Honor', '2026-11-07 12:25:31', '2026-11-07 12:25:31'),
(744, 115, 'model', 'HONOR X6B', '2026-11-07 12:25:31', '2026-11-07 12:25:31'),
(745, 115, 'price', '25000', '2026-11-07 12:25:31', '2026-11-07 12:25:31'),
(746, 115, 'discount', '18000', '2026-11-07 12:25:31', '2026-11-07 12:25:31'),
(747, 115, 'skill', 'تبديل شاشة', '2026-11-07 12:25:31', '2026-11-07 12:25:31'),
(748, 116, 'brand', 'Honor', '2026-11-07 12:28:01', '2026-11-07 12:28:01'),
(749, 116, 'model', 'HONOR X6c - HONOR PLAY 60', '2026-11-07 12:28:01', '2026-11-07 12:28:01'),
(750, 116, 'price', '25000', '2026-11-07 12:28:01', '2026-11-07 12:28:01'),
(751, 116, 'discount', '18000', '2026-11-07 12:28:01', '2026-11-07 12:28:01'),
(752, 116, 'skill', 'تبديل شاشة', '2026-11-07 12:28:01', '2026-11-07 12:28:01'),
(753, 117, 'brand', 'Honor', '2026-11-07 12:29:08', '2026-11-07 12:29:08'),
(754, 117, 'model', 'HONOR X7 2022', '2026-11-07 12:29:08', '2026-11-07 12:29:08'),
(755, 117, 'price', '20000', '2026-11-07 12:29:08', '2026-11-07 12:29:08'),
(756, 117, 'discount', '16000', '2026-11-07 12:29:08', '2026-11-07 12:29:08'),
(757, 117, 'skill', 'تبديل شاشة', '2026-11-07 12:29:08', '2026-11-07 12:29:08'),
(758, 118, 'brand', 'Honor', '2026-11-07 12:30:24', '2026-11-07 12:30:24'),
(759, 118, 'model', 'HONOR X7A', '2026-11-07 12:30:24', '2026-11-07 12:30:24'),
(760, 118, 'price', '18000', '2026-11-07 12:30:24', '2026-11-07 12:30:24'),
(761, 118, 'discount', '12000', '2026-11-07 12:30:24', '2026-11-07 12:30:24'),
(762, 118, 'skill', 'تبديل شاشة', '2026-11-07 12:30:24', '2026-11-07 12:30:24'),
(763, 119, 'brand', 'Honor', '2026-11-07 12:32:00', '2026-11-07 12:32:00'),
(764, 119, 'model', 'HONOR X7B', '2026-11-07 12:32:00', '2026-11-07 12:32:00'),
(765, 119, 'price', '25000', '2026-11-07 12:32:00', '2026-11-07 12:32:00'),
(766, 119, 'discount', '18000', '2026-11-07 12:32:00', '2026-11-07 12:32:00'),
(767, 119, 'skill', 'تبديل شاشة', '2026-11-07 12:32:00', '2026-11-07 12:32:00'),
(768, 120, 'brand', 'Honor', '2026-11-07 12:33:21', '2026-11-07 12:33:21'),
(769, 120, 'model', 'HONOR X7C - HONOR 60 PLUS', '2026-11-07 12:33:21', '2026-11-07 12:33:21'),
(770, 120, 'price', '25000', '2026-11-07 12:33:21', '2026-11-07 12:33:21'),
(771, 120, 'discount', '15000', '2026-11-07 12:33:21', '2026-11-07 12:33:21'),
(772, 120, 'skill', 'تبديل شاشة', '2026-11-07 12:33:21', '2026-11-07 12:33:21'),
(773, 121, 'brand', 'Honor', '2026-11-07 12:34:49', '2026-11-07 12:34:49'),
(774, 121, 'model', 'HONOR X7d - HONOR 400 SMART - HONOR PLAY 10c 5G', '2026-11-07 12:34:49', '2026-11-07 12:34:49'),
(775, 121, 'price', '25000', '2026-11-07 12:34:49', '2026-11-07 12:34:49'),
(776, 121, 'discount', '18000', '2026-11-07 12:34:49', '2026-11-07 12:34:49'),
(777, 121, 'skill', 'تبديل شاشة', '2026-11-07 12:34:49', '2026-11-07 12:34:49'),
(778, 122, 'brand', 'Honor', '2026-11-07 12:36:13', '2026-11-07 12:36:13'),
(779, 122, 'model', 'HONOR X7E - HONOR X6E', '2026-11-07 12:36:13', '2026-11-07 12:36:13'),
(780, 122, 'price', '25000', '2026-11-07 12:36:13', '2026-11-07 12:36:13'),
(781, 122, 'discount', '18000', '2026-11-07 12:36:13', '2026-11-07 12:36:13'),
(782, 122, 'skill', 'تبديل شاشة', '2026-11-07 12:36:13', '2026-11-07 12:36:13'),
(783, 123, 'brand', 'Honor', '2026-11-07 12:38:47', '2026-11-07 12:38:47'),
(784, 123, 'model', 'HONOR X8 2022', '2026-11-07 12:38:47', '2026-11-07 12:38:47'),
(785, 123, 'price', '25000', '2026-11-07 12:38:47', '2026-11-07 12:38:47'),
(786, 123, 'discount', '18000', '2026-11-07 12:38:47', '2026-11-07 12:38:47'),
(787, 123, 'skill', 'تبديل شاشة', '2026-11-07 12:38:47', '2026-11-07 12:38:47'),
(788, 124, 'brand', 'Honor', '2026-11-07 12:40:11', '2026-11-07 12:40:11'),
(789, 124, 'model', 'HONOR X8A - HONOR 90LITE', '2026-11-07 12:40:11', '2026-11-07 12:40:11'),
(790, 124, 'price', '25000', '2026-11-07 12:40:11', '2026-11-07 12:40:11'),
(791, 124, 'discount', '20000', '2026-11-07 12:40:11', '2026-11-07 12:40:11'),
(792, 124, 'skill', 'تبديل شاشة', '2026-11-07 12:40:11', '2026-11-07 12:40:11'),
(798, 125, 'brand', 'Honor', '2026-11-07 12:42:45', '2026-11-07 12:42:45'),
(799, 125, 'model', 'HONOR X8b  - X8c 4G - HONOR 200 LITE', '2026-11-07 12:42:45', '2026-11-07 12:42:45'),
(800, 125, 'price', '45000', '2026-11-07 12:42:45', '2026-11-07 12:42:45'),
(801, 125, 'discount', '35000', '2026-11-07 12:42:45', '2026-11-07 12:42:45'),
(802, 125, 'skill', 'تبديل شاشة', '2026-11-07 12:42:45', '2026-11-07 12:42:45'),
(803, 126, 'brand', 'Honor', '2026-11-07 12:51:00', '2026-11-07 12:51:00'),
(804, 126, 'model', 'HONOR X9 2022', '2026-11-07 12:51:00', '2026-11-07 12:51:00'),
(805, 126, 'price', '25000', '2026-11-07 12:51:00', '2026-11-07 12:51:00'),
(806, 126, 'discount', '16000', '2026-11-07 12:51:00', '2026-11-07 12:51:00'),
(807, 126, 'skill', 'تبديل شاشة', '2026-11-07 12:51:00', '2026-11-07 12:51:00'),
(808, 127, 'brand', 'Honor', '2026-11-07 12:52:07', '2026-11-07 12:52:07'),
(809, 127, 'model', 'HONOR X9A', '2026-11-07 12:52:07', '2026-11-07 12:52:07'),
(810, 127, 'price', '60000', '2026-11-07 12:52:07', '2026-11-07 12:52:07'),
(811, 127, 'discount', '50000', '2026-11-07 12:52:07', '2026-11-07 12:52:07'),
(812, 127, 'skill', 'تبديل شاشة', '2026-11-07 12:52:07', '2026-11-07 12:52:07'),
(813, 128, 'brand', 'Honor', '2026-11-07 12:53:02', '2026-11-07 12:53:02'),
(814, 128, 'model', 'HONOR X9b', '2026-11-07 12:53:02', '2026-11-07 12:53:02'),
(815, 128, 'price', '65000', '2026-11-07 12:53:02', '2026-11-07 12:53:02'),
(816, 128, 'discount', '58000', '2026-11-07 12:53:02', '2026-11-07 12:53:02'),
(817, 128, 'skill', 'تبديل شاشة', '2026-11-07 12:53:02', '2026-11-07 12:53:02'),
(818, 129, 'brand', 'Honor', '2026-11-07 12:54:49', '2026-11-07 12:54:49'),
(819, 129, 'model', 'HONOR X9C - HONOR X60 PRO - HONOR MAGIC 70 LITE', '2026-11-07 12:54:49', '2026-11-07 12:54:49'),
(820, 129, 'price', '75000', '2026-11-07 12:54:49', '2026-11-07 12:54:49'),
(821, 129, 'discount', '60000', '2026-11-07 12:54:49', '2026-11-07 12:54:49'),
(822, 129, 'skill', 'تبديل شاشة', '2026-11-07 12:54:49', '2026-11-07 12:54:49'),
(823, 130, 'brand', 'Honor', '2026-11-07 12:56:47', '2026-11-07 12:56:47'),
(824, 130, 'model', 'HONOR 8X 2019 - 9X LITE', '2026-11-07 12:56:47', '2026-11-07 12:56:47'),
(825, 130, 'price', '25000', '2026-11-07 12:56:47', '2026-11-07 12:56:47'),
(826, 130, 'discount', '18000', '2026-11-07 12:56:47', '2026-11-07 12:56:47'),
(827, 130, 'skill', 'تبديل شاشة', '2026-11-07 12:56:47', '2026-11-07 12:56:47'),
(828, 131, 'brand', 'Honor', '2026-11-07 12:58:41', '2026-11-07 12:58:41'),
(829, 131, 'model', 'HONOR 50 - NOVA 9', '2026-11-07 12:58:41', '2026-11-07 12:58:41'),
(830, 131, 'price', '60000', '2026-11-07 12:58:41', '2026-11-07 12:58:41'),
(831, 131, 'discount', '45000', '2026-11-07 12:58:41', '2026-11-07 12:58:41'),
(832, 131, 'skill', 'تبديل شاشة', '2026-11-07 12:58:41', '2026-11-07 12:58:41'),
(833, 132, 'brand', 'Honor', '2026-11-07 13:00:12', '2026-11-07 13:00:12'),
(834, 132, 'model', 'HONOR 200', '2026-11-07 13:00:12', '2026-11-07 13:00:12'),
(835, 132, 'price', '65000', '2026-11-07 13:00:12', '2026-11-07 13:00:12'),
(836, 132, 'discount', '50000', '2026-11-07 13:00:12', '2026-11-07 13:00:12'),
(837, 132, 'skill', 'تبديل شاشة', '2026-11-07 13:00:12', '2026-11-07 13:00:12'),
(838, 133, 'brand', 'Honor', '2026-11-07 13:08:53', '2026-11-07 13:08:53'),
(839, 133, 'model', 'HONOR 8C', '2026-11-07 13:08:53', '2026-11-07 13:08:53'),
(840, 133, 'price', '20000', '2026-11-07 13:08:53', '2026-11-07 13:08:53'),
(841, 133, 'discount', '14000', '2026-11-07 13:08:53', '2026-11-07 13:08:53'),
(842, 133, 'skill', 'تبديل شاشة', '2026-11-07 13:08:53', '2026-11-07 13:08:53'),
(843, 134, 'brand', 'Infinix', '2026-11-07 13:57:06', '2026-11-07 13:57:06'),
(844, 134, 'model', 'INFINIX SMART HD 2021', '2026-11-07 13:57:06', '2026-11-07 13:57:06'),
(845, 134, 'price', '15000', '2026-11-07 13:57:06', '2026-11-07 13:57:06'),
(846, 134, 'discount', '10000', '2026-11-07 13:57:06', '2026-11-07 13:57:06'),
(847, 134, 'skill', 'تبديل شاشة', '2026-11-07 13:57:06', '2026-11-07 13:57:06'),
(848, 135, 'brand', 'Infinix', '2026-11-07 13:58:55', '2026-11-07 13:58:55'),
(849, 135, 'model', 'INFINIX SMART 6PLUS - HOT 10T - HOT 10S - SPARK 7P - ITEL P38 PRO - VISION 3PLUS', '2026-11-07 13:58:55', '2026-11-07 13:58:55'),
(850, 135, 'price', '18000', '2026-11-07 13:58:55', '2026-11-07 13:58:55'),
(851, 135, 'discount', '12000', '2026-11-07 13:58:55', '2026-11-07 13:58:55'),
(852, 135, 'skill', 'تبديل شاشة', '2026-11-07 13:58:55', '2026-11-07 13:58:55'),
(853, 136, 'brand', 'Infinix', '2026-11-07 14:00:23', '2026-11-07 14:00:23'),
(854, 136, 'model', 'INFINIX HOT 7 - SPARK3', '2026-11-07 14:00:23', '2026-11-07 14:00:23'),
(855, 136, 'price', '30000', '2026-11-07 14:00:23', '2026-11-07 14:00:23'),
(856, 136, 'discount', '27000', '2026-11-07 14:00:23', '2026-11-07 14:00:23'),
(857, 136, 'skill', 'تبديل شاشة', '2026-11-07 14:00:23', '2026-11-07 14:00:23'),
(858, 137, 'brand', 'Infinix', '2026-11-07 14:01:26', '2026-11-07 14:01:26'),
(859, 137, 'model', 'INFINIX HOT 8 - HOT 8LITE – SPARK 4', '2026-11-07 14:01:26', '2026-11-07 14:01:26'),
(860, 137, 'price', '18000', '2026-11-07 14:01:26', '2026-11-07 14:01:26'),
(861, 137, 'discount', '12000', '2026-11-07 14:01:26', '2026-11-07 14:01:26'),
(862, 137, 'skill', 'تبديل شاشة', '2026-11-07 14:01:26', '2026-11-07 14:01:26'),
(863, 138, 'brand', 'Infinix', '2026-11-07 14:03:49', '2026-11-07 14:03:49'),
(864, 138, 'model', 'INFINIX HOT 9 - HOT 9PRO - CAMON 15 - NOTE 7LITE – S5 – SPARK 5 - SPARK 5PRO', '2026-11-07 14:03:49', '2026-11-07 14:03:49'),
(865, 138, 'price', '20000', '2026-11-07 14:03:49', '2026-11-07 14:03:49'),
(866, 138, 'discount', '15000', '2026-11-07 14:03:49', '2026-11-07 14:03:49'),
(867, 138, 'skill', 'تبديل شاشة', '2026-11-07 14:03:49', '2026-11-07 14:03:49'),
(868, 139, 'brand', 'Infinix', '2026-11-07 14:05:41', '2026-11-07 14:05:41'),
(869, 139, 'model', 'INFINIX HOT 9 PLAY', '2026-11-07 14:05:41', '2026-11-07 14:05:41'),
(870, 139, 'price', '20000', '2026-11-07 14:05:41', '2026-11-07 14:05:41'),
(871, 139, 'discount', '12000', '2026-11-07 14:05:41', '2026-11-07 14:05:41'),
(872, 139, 'skill', 'تبديل شاشة', '2026-11-07 14:05:41', '2026-11-07 14:05:41'),
(873, 140, 'brand', 'Infinix', '2026-11-07 14:07:48', '2026-11-07 14:07:48'),
(874, 140, 'model', 'INFINIX HOT 10 -NOTE 8i - POVA - CAMON 16 – CAMON 16PRO -  SPARK 6', '2026-11-07 14:07:48', '2026-11-07 14:07:48'),
(875, 140, 'price', '20000', '2026-11-07 14:07:48', '2026-11-07 14:07:48'),
(876, 140, 'discount', '16000', '2026-11-07 14:07:48', '2026-11-07 14:07:48'),
(877, 140, 'skill', 'تبديل شاشة', '2026-11-07 14:07:48', '2026-11-07 14:07:48'),
(878, 141, 'brand', 'Infinix', '2026-11-07 14:11:14', '2026-11-07 14:11:14'),
(879, 141, 'model', 'INFINIX HOT 10LITE -HOT 10i -SPARK 7 -SMART5-ITEL ViSION 1PRO - ITEL VISION 2S', '2026-11-07 14:11:14', '2026-11-07 14:11:14'),
(880, 141, 'price', '20000', '2026-11-07 14:11:14', '2026-11-07 14:11:14'),
(881, 141, 'discount', '15000', '2026-11-07 14:11:14', '2026-11-07 14:11:14'),
(882, 141, 'skill', 'تبديل شاشة', '2026-11-07 14:11:14', '2026-11-07 14:11:14'),
(883, 142, 'brand', 'Infinix', '2026-11-07 14:14:55', '2026-11-07 14:14:55'),
(884, 142, 'model', 'INFINIX HOT 12 - HOT 12 PLAY – HOT 20 - NOTE 12i – POVA 4 - POVA NEO 2', '2026-11-07 14:14:55', '2026-11-07 14:14:55'),
(885, 142, 'price', '25000', '2026-11-07 14:14:55', '2026-11-07 14:14:55'),
(886, 142, 'discount', '16000', '2026-11-07 14:14:55', '2026-11-07 14:14:55'),
(887, 142, 'skill', 'تبديل شاشة', '2026-11-07 14:14:55', '2026-11-07 14:14:55'),
(888, 143, 'brand', 'Infinix', '2026-11-07 14:16:38', '2026-11-07 14:16:38'),
(889, 143, 'model', 'INFINIX HOT 12i – HOT 20i - SMART 6 HD', '2026-11-07 14:16:38', '2026-11-07 14:16:38'),
(890, 143, 'price', '20000', '2026-11-07 14:16:38', '2026-11-07 14:16:38'),
(891, 143, 'discount', '15000', '2026-11-07 14:16:38', '2026-11-07 14:16:38'),
(892, 143, 'skill', 'تبديل شاشة', '2026-11-07 14:16:38', '2026-11-07 14:16:38'),
(893, 144, 'brand', 'Infinix', '2026-11-07 14:18:07', '2026-11-07 14:18:07'),
(894, 144, 'model', 'INFINIX HOT 30 4G - IFINIX NOTE 30 4G - SPARK 10 PRO - SPARK 20 PRO - POVA 5 - POVA 5 PRO 5G - POVA 6 NEO 4G - HOT 40 - HOT 40X 5G - HOT 40 PRO - INFINIX NOTE 40X 5G', '2026-11-07 14:18:07', '2026-11-07 14:18:07'),
(895, 144, 'price', '25000', '2026-11-07 14:18:07', '2026-11-07 14:18:07'),
(896, 144, 'discount', '18000', '2026-11-07 14:18:07', '2026-11-07 14:18:07'),
(897, 144, 'skill', 'تبديل شاشة', '2026-11-07 14:18:07', '2026-11-07 14:18:07'),
(898, 145, 'brand', 'Infinix', '2026-11-07 14:21:18', '2026-11-07 14:21:18'),
(899, 145, 'model', 'INFINIX HOT 30i - POP 7 - SMART 7 PLUS', '2026-11-07 14:21:18', '2026-11-07 14:21:18'),
(900, 145, 'price', '20000', '2026-11-07 14:21:18', '2026-11-07 14:21:18'),
(901, 145, 'discount', '15000', '2026-11-07 14:21:18', '2026-11-07 14:21:18'),
(902, 145, 'skill', 'تبديل شاشة', '2026-11-07 14:21:18', '2026-11-07 14:21:18'),
(903, 146, 'brand', 'Infinix', '2026-11-07 14:24:16', '2026-11-07 14:24:16'),
(904, 146, 'model', 'INFINIX HOT 30 PLAY', '2026-11-07 14:24:16', '2026-11-07 14:24:16'),
(905, 146, 'price', '20000', '2026-11-07 14:24:16', '2026-11-07 14:24:16'),
(906, 146, 'discount', '16000', '2026-11-07 14:24:16', '2026-11-07 14:24:16'),
(907, 146, 'skill', 'تبديل شاشة', '2026-11-07 14:24:16', '2026-11-07 14:24:16'),
(908, 147, 'brand', 'Infinix', '2026-11-07 15:47:54', '2026-11-07 15:47:54'),
(909, 147, 'model', 'INFINIX HOT 50 5G - SMART 9', '2026-11-07 15:47:54', '2026-11-07 15:47:54'),
(910, 147, 'price', '25000', '2026-11-07 15:47:54', '2026-11-07 15:47:54'),
(911, 147, 'discount', '18000', '2026-11-07 15:47:54', '2026-11-07 15:47:54'),
(912, 147, 'skill', 'تبديل شاشة', '2026-11-07 15:47:54', '2026-11-07 15:47:54'),
(913, 148, 'brand', 'Infinix', '2026-11-07 15:49:12', '2026-11-07 15:49:12'),
(914, 148, 'model', 'INFINIX HOT 50i', '2026-11-07 15:49:12', '2026-11-07 15:49:12'),
(915, 148, 'price', '25000', '2026-11-07 15:49:12', '2026-11-07 15:49:12'),
(916, 148, 'discount', '18000', '2026-11-07 15:49:12', '2026-11-07 15:49:12'),
(917, 148, 'skill', 'تبديل شاشة', '2026-11-07 15:49:12', '2026-11-07 15:49:12'),
(918, 149, 'brand', 'Infinix', '2026-11-07 15:50:38', '2026-11-07 15:50:38'),
(919, 149, 'model', 'INFINIX HOT 50 4G - SPARK 30 4G - POVA 7 5G', '2026-11-07 15:50:38', '2026-11-07 15:50:38'),
(920, 149, 'price', '25000', '2026-11-07 15:50:38', '2026-11-07 15:50:38'),
(921, 149, 'discount', '18000', '2026-11-07 15:50:38', '2026-11-07 15:50:38'),
(922, 149, 'skill', 'تبديل شاشة', '2026-11-07 15:50:38', '2026-11-07 15:50:38'),
(923, 150, 'brand', 'Infinix', '2026-11-07 15:58:32', '2026-11-07 15:58:32'),
(924, 150, 'model', 'INFINIX HOT 50 PRO - SPARK 30 PRO - ITEL S25', '2026-11-07 15:58:32', '2026-11-07 15:58:32'),
(925, 150, 'price', '60000', '2026-11-07 15:58:32', '2026-11-07 15:58:32'),
(926, 150, 'discount', '45000', '2026-11-07 15:58:32', '2026-11-07 15:58:32'),
(927, 150, 'skill', 'تبديل شاشة', '2026-11-07 15:58:32', '2026-11-07 15:58:32'),
(928, 151, 'brand', 'Infinix', '2026-11-07 16:00:56', '2026-11-07 16:00:56'),
(929, 151, 'model', 'INFINIX HOT 60 PRO - INFINIX GT 30 PRO - SPARK 40 PRO - POP 7 PRO', '2026-11-07 16:00:56', '2026-11-07 16:00:56'),
(930, 151, 'price', '60000', '2026-11-07 16:00:56', '2026-11-07 16:00:56'),
(931, 151, 'discount', '50000', '2026-11-07 16:00:56', '2026-11-07 16:00:56'),
(932, 151, 'skill', 'تبديل شاشة', '2026-11-07 16:00:56', '2026-11-07 16:00:56'),
(933, 152, 'brand', 'Infinix', '2026-11-07 16:02:36', '2026-11-07 16:02:36'),
(934, 152, 'model', 'INFINIX HOT 60 5G - 60i - SMART 10 - SMART 10 HD - SMART 10 PLUS - SMART 10 PRO - POP 10 - POP10 PRO - SPARK 40 - 40C - SPARK GO 2', '2026-11-07 16:02:36', '2026-11-07 16:02:36'),
(935, 152, 'price', '25000', '2026-11-07 16:02:36', '2026-11-07 16:02:36'),
(936, 152, 'discount', '18000', '2026-11-07 16:02:36', '2026-11-07 16:02:36'),
(937, 152, 'skill', 'تبديل شاشة', '2026-11-07 16:02:36', '2026-11-07 16:02:36'),
(938, 153, 'brand', 'Infinix', '2026-11-07 16:03:53', '2026-11-07 16:03:53'),
(939, 153, 'model', 'INFINIX HOT 60 PRO PLUS', '2026-11-07 16:03:53', '2026-11-07 16:03:53'),
(940, 153, 'price', '65000', '2026-11-07 16:03:53', '2026-11-07 16:03:53'),
(941, 153, 'discount', '55000', '2026-11-07 16:03:53', '2026-11-07 16:03:53'),
(942, 153, 'skill', 'تبديل شاشة', '2026-11-07 16:03:53', '2026-11-07 16:03:53'),
(948, 154, 'brand', 'Infinix', '2026-11-07 16:12:43', '2026-11-07 16:12:43'),
(949, 154, 'model', 'INFINIX SMART 20 - HOT 70 4G - SPARK 50 4G - SPARK 50 5G NFC - POP X 5G - ITEL CITY 200', '2026-11-07 16:12:43', '2026-11-07 16:12:43'),
(950, 154, 'price', '25000', '2026-11-07 16:12:43', '2026-11-07 16:12:43'),
(951, 154, 'discount', '20000', '2026-11-07 16:12:43', '2026-11-07 16:12:43'),
(952, 154, 'skill', 'تبديل شاشة', '2026-11-07 16:12:43', '2026-11-07 16:12:43'),
(953, 155, 'brand', 'Infinix', '2026-11-07 16:22:04', '2026-11-07 16:22:04'),
(954, 155, 'model', 'INFINIX NOTE 7', '2026-11-07 16:22:04', '2026-11-07 16:22:04'),
(955, 155, 'price', '25000', '2026-11-07 16:22:04', '2026-11-07 16:22:04'),
(956, 155, 'discount', '18000', '2026-11-07 16:22:04', '2026-11-07 16:22:04'),
(957, 155, 'skill', 'تبديل شاشة', '2026-11-07 16:22:04', '2026-11-07 16:22:04'),
(958, 156, 'brand', 'Infinix', '2026-11-07 16:23:00', '2026-11-07 16:23:00'),
(959, 156, 'model', 'INFINIX NOTE 8', '2026-11-07 16:23:00', '2026-11-07 16:23:00'),
(960, 156, 'price', '25000', '2026-11-07 16:23:00', '2026-11-07 16:23:00');
INSERT INTO `service_metas` (`id`, `services_id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(961, 156, 'discount', '18000', '2026-11-07 16:23:00', '2026-11-07 16:23:00'),
(962, 156, 'skill', 'تبديل شاشة', '2026-11-07 16:23:00', '2026-11-07 16:23:00'),
(963, 157, 'brand', 'Infinix', '2026-11-07 16:39:35', '2026-11-07 16:39:35'),
(964, 157, 'model', 'INFINIX NOTE 10 - POVA2 - POVA 3 - NOTE 11S -NOTE 11PRO', '2026-11-07 16:39:35', '2026-11-07 16:39:35'),
(965, 157, 'price', '25000', '2026-11-07 16:39:35', '2026-11-07 16:39:35'),
(966, 157, 'discount', '18000', '2026-11-07 16:39:35', '2026-11-07 16:39:35'),
(967, 157, 'skill', 'تبديل شاشة', '2026-11-07 16:39:35', '2026-11-07 16:39:35'),
(968, 158, 'brand', 'Infinix', '2026-11-07 16:40:42', '2026-11-07 16:40:42'),
(969, 158, 'model', 'INFINIX NOTE 10 PRO', '2026-11-07 16:40:42', '2026-11-07 16:40:42'),
(970, 158, 'price', '25000', '2026-11-07 16:40:42', '2026-11-07 16:40:42'),
(971, 158, 'discount', '18000', '2026-11-07 16:40:42', '2026-11-07 16:40:42'),
(972, 158, 'skill', 'تبديل شاشة', '2026-11-07 16:40:42', '2026-11-07 16:40:42'),
(973, 159, 'brand', 'Infinix', '2026-11-07 16:41:53', '2026-11-07 16:41:53'),
(974, 159, 'model', 'INFINIX NOTE 11 - NOTE 12 - NOTE 12 PRO', '2026-11-07 16:41:53', '2026-11-07 16:41:53'),
(975, 159, 'price', '25000', '2026-11-07 16:41:53', '2026-11-07 16:41:53'),
(976, 159, 'discount', '18000', '2026-11-07 16:41:53', '2026-11-07 16:41:53'),
(977, 159, 'skill', 'تبديل شاشة', '2026-11-07 16:41:53', '2026-11-07 16:41:53'),
(978, 160, 'brand', 'Infinix', '2026-11-07 16:43:13', '2026-11-07 16:43:13'),
(979, 160, 'model', 'INFINIX NOTE 40 5G - CAMON 30 - CAMON 30 5G - POVA 6 - POVA 6 PRO 5G', '2026-11-07 16:43:13', '2026-11-07 16:43:13'),
(980, 160, 'price', '70000', '2026-11-07 16:43:13', '2026-11-07 16:43:13'),
(981, 160, 'discount', '54000', '2026-11-07 16:43:13', '2026-11-07 16:43:13'),
(982, 160, 'skill', 'تبديل شاشة', '2026-11-07 16:43:13', '2026-11-07 16:43:13'),
(983, 161, 'brand', 'Infinix', '2026-11-07 16:45:08', '2026-11-07 16:45:08'),
(984, 161, 'model', 'INFINIX NOTE 40 4G - NOTE 50 4G - NOTE 50 PRO - NOTE 50 PRO PLUS 5G - CAMON 30 PRO 5G - CAMON 40', '2026-11-07 16:45:08', '2026-11-07 16:45:08'),
(985, 161, 'price', '75000', '2026-11-07 16:45:08', '2026-11-07 16:45:08'),
(986, 161, 'discount', '58000', '2026-11-07 16:45:08', '2026-11-07 16:45:08'),
(987, 161, 'skill', 'تبديل شاشة', '2026-11-07 16:45:08', '2026-11-07 16:45:08'),
(988, 162, 'brand', 'Infinix', '2026-11-07 17:15:13', '2026-11-07 17:15:13'),
(989, 162, 'model', 'INFINIX ZERO X - ZERO XPRO - CAMON 18 PREMIER', '2026-11-07 17:15:13', '2026-11-07 17:15:13'),
(990, 162, 'price', '25000', '2026-11-07 17:15:13', '2026-11-07 17:15:13'),
(991, 162, 'discount', '20000', '2026-11-07 17:15:13', '2026-11-07 17:15:13'),
(992, 162, 'skill', 'تبديل شاشة', '2026-11-07 17:15:13', '2026-11-07 17:15:13'),
(993, 163, 'brand', 'Infinix', '2026-11-07 17:17:00', '2026-11-07 17:17:00'),
(994, 163, 'model', 'INFINIX ZERO 20 - POVA 4 PRO', '2026-11-07 17:17:00', '2026-11-07 17:17:00'),
(995, 163, 'price', '25000', '2026-11-07 17:17:00', '2026-11-07 17:17:00'),
(996, 163, 'discount', '18000', '2026-11-07 17:17:00', '2026-11-07 17:17:00'),
(997, 163, 'skill', 'تبديل شاشة', '2026-11-07 17:17:00', '2026-11-07 17:17:00'),
(998, 164, 'brand', 'Infinix', '2026-11-07 17:17:59', '2026-11-07 17:17:59'),
(999, 164, 'model', 'INFINIX ZERO 30 4G - ZERO 30 5G - ZERO 30 PRO - ITEL S23 PLUS', '2026-11-07 17:17:59', '2026-11-07 17:17:59'),
(1000, 164, 'price', '30000', '2026-11-07 17:17:59', '2026-11-07 17:17:59'),
(1001, 164, 'discount', '23000', '2026-11-07 17:17:59', '2026-11-07 17:17:59'),
(1002, 164, 'skill', 'تبديل شاشة', '2026-11-07 17:17:59', '2026-11-07 17:17:59'),
(1003, 165, 'brand', 'Infinix', '2026-11-07 17:19:14', '2026-11-07 17:19:14'),
(1004, 165, 'model', 'INFINIX ZERO 40 - INFINIX NOTE 40s 4G - INFINIX NOTE 40 PRO 4G', '2026-11-07 17:19:14', '2026-11-07 17:19:14'),
(1005, 165, 'price', '75000', '2026-11-07 17:19:14', '2026-11-07 17:19:14'),
(1006, 165, 'discount', '58000', '2026-11-07 17:19:14', '2026-11-07 17:19:14'),
(1007, 165, 'skill', 'تبديل شاشة', '2026-11-07 17:19:14', '2026-11-07 17:19:14'),
(1008, 166, 'brand', 'Tecno', '2026-11-08 16:41:14', '2026-11-08 16:41:14'),
(1009, 166, 'model', 'SPARK 6GO - SPARK GO 2021', '2026-11-08 16:41:14', '2026-11-08 16:41:14'),
(1010, 166, 'price', '15000', '2026-11-08 16:41:14', '2026-11-08 16:41:14'),
(1011, 166, 'discount', '12000', '2026-11-08 16:41:14', '2026-11-08 16:41:14'),
(1012, 166, 'skill', 'تبديل شاشة', '2026-11-08 16:41:14', '2026-11-08 16:41:14'),
(1013, 167, 'brand', 'Tecno', '2026-11-08 16:42:15', '2026-11-08 16:42:15'),
(1014, 167, 'model', 'SPARK 8', '2026-11-08 16:42:15', '2026-11-08 16:42:15'),
(1015, 167, 'price', '18000', '2026-11-08 16:42:15', '2026-11-08 16:42:15'),
(1016, 167, 'discount', '15000', '2026-11-08 16:42:15', '2026-11-08 16:42:15'),
(1017, 167, 'skill', 'تبديل شاشة', '2026-11-08 16:42:15', '2026-11-08 16:42:15'),
(1018, 168, 'brand', 'Tecno', '2026-11-08 16:43:45', '2026-11-08 16:43:45'),
(1019, 168, 'model', 'SPARK 8C - SPARK 9 – SPARK 9T - ITEL VISION 3 - ITEL A60S', '2026-11-08 16:43:45', '2026-11-08 16:43:45'),
(1020, 168, 'price', '20000', '2026-11-08 16:43:45', '2026-11-08 16:43:45'),
(1021, 168, 'discount', '16000', '2026-11-08 16:43:45', '2026-11-08 16:43:45'),
(1022, 168, 'skill', 'تبديل شاشة', '2026-11-08 16:43:45', '2026-11-08 16:43:45'),
(1023, 169, 'brand', 'Tecno', '2026-11-08 16:45:06', '2026-11-08 16:45:06'),
(1024, 169, 'model', 'SPARK 7 PRO - CAMON 17', '2026-11-08 16:45:06', '2026-11-08 16:45:06'),
(1025, 169, 'price', '20000', '2026-11-08 16:45:06', '2026-11-08 16:45:06'),
(1026, 169, 'discount', '15000', '2026-11-08 16:45:06', '2026-11-08 16:45:06'),
(1027, 169, 'skill', 'تبديل شاشة', '2026-11-08 16:45:06', '2026-11-08 16:45:06'),
(1028, 170, 'brand', 'Tecno', '2026-11-08 16:46:17', '2026-11-08 16:46:17'),
(1029, 170, 'model', 'SPARK 9 PRO - SPARK 8T - SPARK 8P - SPARK 8 PLUS - HOT 11 - ITEL VISION 5 PLUS', '2026-11-08 16:46:17', '2026-11-08 16:46:17'),
(1030, 170, 'price', '18000', '2026-11-08 16:46:17', '2026-11-08 16:46:17'),
(1031, 170, 'discount', '12000', '2026-11-08 16:46:17', '2026-11-08 16:46:17'),
(1032, 170, 'skill', 'تبديل شاشة', '2026-11-08 16:46:17', '2026-11-08 16:46:17'),
(1033, 171, 'brand', 'Tecno', '2026-11-08 16:47:30', '2026-11-08 16:47:30'),
(1034, 171, 'model', 'SPARK 10 - SPARK 10C - SPARK GO 2023 - SMART 7HD - SMART 7 - POP 6PRO - HOT 12PRO - POP 7 PRO - ITEL A60 - ITEL A70 - ITEL P40', '2026-11-08 16:47:30', '2026-11-08 16:47:30'),
(1035, 171, 'price', '20000', '2026-11-08 16:47:30', '2026-11-08 16:47:30'),
(1036, 171, 'discount', '15000', '2026-11-08 16:47:30', '2026-11-08 16:47:30'),
(1037, 171, 'skill', 'تبديل شاشة', '2026-11-08 16:47:30', '2026-11-08 16:47:30'),
(1038, 172, 'brand', 'Tecno', '2026-11-08 16:49:05', '2026-11-08 16:49:05'),
(1039, 172, 'model', 'TECNO SPARK 20 PRO', '2026-11-08 16:49:05', '2026-11-08 16:49:05'),
(1040, 172, 'price', '18000', '2026-11-08 16:49:05', '2026-11-08 16:49:05'),
(1041, 172, 'discount', '14000', '2026-11-08 16:49:05', '2026-11-08 16:49:05'),
(1042, 172, 'skill', 'تبديل شاشة', '2026-11-08 16:49:05', '2026-11-08 16:49:05'),
(1043, 173, 'brand', 'Tecno', '2026-11-08 16:51:17', '2026-11-08 16:51:17'),
(1044, 173, 'model', 'TECNO SPARK GO 2022 - TECNO POP 5LITE – POP 5PRO - INFINIX SMART 6', '2026-11-08 16:51:17', '2026-11-08 16:51:17'),
(1045, 173, 'price', '18000', '2026-11-08 16:51:17', '2026-11-08 16:51:17'),
(1046, 173, 'discount', '14000', '2026-11-08 16:51:17', '2026-11-08 16:51:17'),
(1047, 173, 'skill', 'تبديل شاشة', '2026-11-08 16:51:17', '2026-11-08 16:51:17'),
(1048, 174, 'brand', 'Tecno', '2026-11-08 16:53:03', '2026-11-08 16:53:03'),
(1049, 174, 'model', 'TECNO SPARK GO 2024 - SPARK 20 - SPARK 20C - INFINIX HOT 40i - SMART 8 - SMART 8 PRO - SMART 8 PLUS - SMART 8 HD - POP8 - ITEL P55 PLUS - ITEL P55 - ITEL  A70s  - ITEL S24', '2026-11-08 16:53:03', '2026-11-08 16:53:03'),
(1050, 174, 'price', '25000', '2026-11-08 16:53:03', '2026-11-08 16:53:03'),
(1051, 174, 'discount', '16000', '2026-11-08 16:53:03', '2026-11-08 16:53:03'),
(1052, 174, 'skill', 'تبديل شاشة', '2026-11-08 16:53:03', '2026-11-08 16:53:03'),
(1053, 175, 'brand', 'Tecno', '2026-11-08 16:54:44', '2026-11-08 16:54:44'),
(1054, 175, 'model', 'TECNO SPARK GO 3 - POP 20 - POP X 4G - ITEL A200 4G - ITEL A200 PLUS 4G', '2026-11-08 16:54:44', '2026-11-08 16:54:44'),
(1055, 175, 'price', '30000', '2026-11-08 16:54:44', '2026-11-08 16:54:44'),
(1056, 175, 'discount', '20000', '2026-11-08 16:54:44', '2026-11-08 16:54:44'),
(1057, 175, 'skill', 'تبديل شاشة', '2026-11-08 16:54:44', '2026-11-08 16:54:44'),
(1058, 176, 'brand', 'Tecno', '2026-11-08 16:55:55', '2026-11-08 16:55:55'),
(1059, 176, 'model', 'TECNO POUVOIR 4 – POUVOIR 4PRO – SPARK 5AIR – SPARK 6AIR', '2026-11-08 16:55:55', '2026-11-08 16:55:55'),
(1060, 176, 'price', '25000', '2026-11-08 16:55:55', '2026-11-08 16:55:55'),
(1061, 176, 'discount', '18000', '2026-11-08 16:55:55', '2026-11-08 16:55:55'),
(1062, 176, 'skill', 'تبديل شاشة', '2026-11-08 16:55:55', '2026-11-08 16:55:55'),
(1063, 177, 'brand', 'Tecno', '2026-11-08 16:57:16', '2026-11-08 16:57:16'),
(1064, 177, 'model', 'TECNO POP 4LITE', '2026-11-08 16:57:16', '2026-11-08 16:57:16'),
(1065, 177, 'price', '18000', '2026-11-08 16:57:16', '2026-11-08 16:57:16'),
(1066, 177, 'discount', '14000', '2026-11-08 16:57:16', '2026-11-08 16:57:16'),
(1067, 177, 'skill', 'تبديل شاشة', '2026-11-08 16:57:16', '2026-11-08 16:57:16'),
(1068, 178, 'brand', 'Tecno', '2026-11-08 16:58:44', '2026-11-08 16:58:44'),
(1069, 178, 'model', 'TECNO POP 6', '2026-11-08 16:58:44', '2026-11-08 16:58:44'),
(1070, 178, 'price', '20000', '2026-11-08 16:58:44', '2026-11-08 16:58:44'),
(1071, 178, 'discount', '15000', '2026-11-08 16:58:44', '2026-11-08 16:58:44'),
(1072, 178, 'skill', 'تبديل شاشة', '2026-11-08 16:58:44', '2026-11-08 16:58:44'),
(1073, 179, 'brand', 'Tecno', '2026-11-08 17:00:34', '2026-11-08 17:00:34'),
(1074, 179, 'model', 'TECNO CAMON 19 - CAMON 19PRO', '2026-11-08 17:00:34', '2026-11-08 17:00:34'),
(1075, 179, 'price', '25000', '2026-11-08 17:00:34', '2026-11-08 17:00:34'),
(1076, 179, 'discount', '18000', '2026-11-08 17:00:34', '2026-11-08 17:00:34'),
(1077, 179, 'skill', 'تبديل شاشة', '2026-11-08 17:00:34', '2026-11-08 17:00:34'),
(1078, 180, 'brand', 'Tecno', '2026-11-08 17:11:51', '2026-11-08 17:11:51'),
(1079, 180, 'model', 'TECNO CAMON 17 PRO – INFINIX ZERO X NEW', '2026-11-08 17:11:51', '2026-11-08 17:11:51'),
(1080, 180, 'price', '25000', '2026-11-08 17:11:51', '2026-11-08 17:11:51'),
(1081, 180, 'discount', '16000', '2026-11-08 17:11:51', '2026-11-08 17:11:51'),
(1082, 180, 'skill', 'تبديل شاشة', '2026-11-08 17:11:51', '2026-11-08 17:11:51'),
(1083, 181, 'brand', 'Tecno', '2026-11-08 17:13:01', '2026-11-08 17:13:01'),
(1084, 181, 'model', 'TECNO CAMON 18 - CAMON 17 PREMIER - CAMON 17P - CAMON 18P - SPARK 8 PRO - HOT 11S - POVA NEO 5G - ZERO 5G 2023 - HOT 20S', '2026-11-08 17:13:01', '2026-11-08 17:13:01'),
(1085, 181, 'price', '15000', '2026-11-08 17:13:01', '2026-11-08 17:13:01'),
(1086, 181, 'discount', '18000', '2026-11-08 17:13:01', '2026-11-08 17:13:01'),
(1087, 181, 'skill', 'تبديل شاشة', '2026-11-08 17:13:01', '2026-11-08 17:13:01'),
(1088, 182, 'brand', 'Tecno', '2026-11-08 17:14:06', '2026-11-08 17:14:06'),
(1089, 182, 'model', 'TECNO CAMON 20 -CAMON 20 PRO - NOTE 30 PRO', '2026-11-08 17:14:06', '2026-11-08 17:14:06'),
(1090, 182, 'price', '25000', '2026-11-08 17:14:06', '2026-11-08 17:14:06'),
(1091, 182, 'discount', '18000', '2026-11-08 17:14:06', '2026-11-08 17:14:06'),
(1092, 182, 'skill', 'تبديل شاشة', '2026-11-08 17:14:06', '2026-11-08 17:14:06'),
(1093, 183, 'brand', 'Tecno', '2026-11-08 17:15:45', '2026-11-08 17:15:45'),
(1094, 183, 'model', 'TECNO CAMON 30 - CAMON 30 5G - INFINIX NOTE 40 5G - POVA 6 PRO - POVA 6 PRO 5G', '2026-11-08 17:15:45', '2026-11-08 17:15:45'),
(1095, 183, 'price', '25000', '2026-11-08 17:15:45', '2026-11-08 17:15:45'),
(1096, 183, 'discount', '18000', '2026-11-08 17:15:45', '2026-11-08 17:15:45'),
(1097, 183, 'skill', 'تبديل شاشة', '2026-11-08 17:15:45', '2026-11-08 17:15:45'),
(1098, 184, 'brand', 'Tecno', '2026-11-08 17:17:39', '2026-11-08 17:17:39'),
(1099, 184, 'model', 'TECNO CAMON 40 PRO 5G - HOT 50 PRO PLUS 4G - INFINIX NOTE 40s - NOTE 40 PRO - NOTE 40 PRO PLUS -NOTE 50s 5G - SPARK 20s PLUS - SPARK 20 PRO PLUS - ITEL S25 ULTRA - ZERO 40 ULTRA - CAMON 30s - CAMON 30s PRO', '2026-11-08 17:17:39', '2026-11-08 17:17:39'),
(1100, 184, 'price', '70000', '2026-11-08 17:17:39', '2026-11-08 17:17:39'),
(1101, 184, 'discount', '45000', '2026-11-08 17:17:39', '2026-11-08 17:17:39'),
(1102, 184, 'skill', 'تبديل شاشة', '2026-11-08 17:17:39', '2026-11-08 17:17:39'),
(1103, 185, 'brand', 'Realme', '2026-11-08 17:48:55', '2026-11-08 17:48:55'),
(1104, 185, 'model', 'REALME C11 - C12 - C15  - OPPO A15 – OPPO A15S – OPPO A16K', '2026-11-08 17:48:55', '2026-11-08 17:48:55'),
(1105, 185, 'price', '20000', '2026-11-08 17:48:55', '2026-11-08 17:48:55'),
(1106, 185, 'discount', '14000', '2026-11-08 17:48:55', '2026-11-08 17:48:55'),
(1107, 185, 'skill', 'تبديل شاشة', '2026-11-08 17:48:55', '2026-11-08 17:48:55'),
(1108, 186, 'brand', 'Realme', '2026-11-08 17:49:51', '2026-11-08 17:49:51'),
(1109, 186, 'model', 'REALME C11 2021 - C20 - C21 - NARZO 50i', '2026-11-08 17:49:51', '2026-11-08 17:49:51'),
(1110, 186, 'price', '20000', '2026-11-08 17:49:51', '2026-11-08 17:49:51'),
(1111, 186, 'discount', '16000', '2026-11-08 17:49:51', '2026-11-08 17:49:51'),
(1112, 186, 'skill', 'تبديل شاشة', '2026-11-08 17:49:51', '2026-11-08 17:49:51'),
(1113, 187, 'brand', 'Realme', '2026-11-08 17:50:52', '2026-11-08 17:50:52'),
(1114, 187, 'model', 'REALME C21Y -C25y', '2026-11-08 17:50:52', '2026-11-08 17:50:52'),
(1115, 187, 'price', '18000', '2026-11-08 17:50:52', '2026-11-08 17:50:52'),
(1116, 187, 'discount', '14000', '2026-11-08 17:50:52', '2026-11-08 17:50:52'),
(1117, 187, 'skill', 'تبديل شاشة', '2026-11-08 17:50:52', '2026-11-08 17:50:52'),
(1118, 188, 'brand', 'Realme', '2026-11-08 17:52:20', '2026-11-08 17:52:20'),
(1119, 188, 'model', 'REALME C25 – C25s', '2026-11-08 17:52:20', '2026-11-08 17:52:20'),
(1120, 188, 'price', '18000', '2026-11-08 17:52:20', '2026-11-08 17:52:20'),
(1121, 188, 'discount', '14000', '2026-11-08 17:52:20', '2026-11-08 17:52:20'),
(1122, 188, 'skill', 'تبديل شاشة', '2026-11-08 17:52:20', '2026-11-08 17:52:20'),
(1123, 189, 'brand', 'Realme', '2026-11-08 17:53:45', '2026-11-08 17:53:45'),
(1124, 189, 'model', 'REALME C30s - C30 - C33', '2026-11-08 17:53:45', '2026-11-08 17:53:45'),
(1125, 189, 'price', '20000', '2026-11-08 17:53:45', '2026-11-08 17:53:45'),
(1126, 189, 'discount', '16000', '2026-11-08 17:53:45', '2026-11-08 17:53:45'),
(1127, 189, 'skill', 'تبديل شاشة', '2026-11-08 17:53:45', '2026-11-08 17:53:45'),
(1128, 190, 'brand', 'Realme', '2026-11-08 17:54:43', '2026-11-08 17:54:43'),
(1129, 190, 'model', 'REALME C35', '2026-11-08 17:54:43', '2026-11-08 17:54:43'),
(1130, 190, 'price', '20000', '2026-11-08 17:54:43', '2026-11-08 17:54:43'),
(1131, 190, 'discount', '16000', '2026-11-08 17:54:43', '2026-11-08 17:54:43'),
(1132, 190, 'skill', 'تبديل شاشة', '2026-11-08 17:54:43', '2026-11-08 17:54:43'),
(1133, 191, 'brand', 'Realme', '2026-11-08 17:55:42', '2026-11-08 17:55:42'),
(1134, 191, 'model', 'REALME C53 - C51 -REALME NOTE 50 - NARZO N53', '2026-11-08 17:55:42', '2026-11-08 17:55:42'),
(1135, 191, 'price', '25000', '2026-11-08 17:55:42', '2026-11-08 17:55:42'),
(1136, 191, 'discount', '18000', '2026-11-08 17:55:42', '2026-11-08 17:55:42'),
(1137, 191, 'skill', 'تبديل شاشة', '2026-11-08 17:55:42', '2026-11-08 17:55:42'),
(1138, 192, 'brand', 'Realme', '2026-11-08 17:56:31', '2026-11-08 17:56:31'),
(1139, 192, 'model', 'REALME C55 – REALME C67 5G - REALME 11 5G - NARZO N55 - OPPO A58 4G', '2026-11-08 17:56:31', '2026-11-08 17:56:31'),
(1140, 192, 'price', '25000', '2026-11-08 17:56:31', '2026-11-08 17:56:31'),
(1141, 192, 'discount', '18000', '2026-11-08 17:56:31', '2026-11-08 17:56:31'),
(1142, 192, 'skill', 'تبديل شاشة', '2026-11-08 17:56:31', '2026-11-08 17:56:31'),
(1143, 193, 'brand', 'Realme', '2026-11-08 17:57:22', '2026-11-08 17:57:22'),
(1144, 193, 'model', 'REALME C63 - C61 - NOTE 60 - NOTE 60x - NARZO N61 - NARZO N63', '2026-11-08 17:57:22', '2026-11-08 17:57:22'),
(1145, 193, 'price', '25000', '2026-11-08 17:57:22', '2026-11-08 17:57:22'),
(1146, 193, 'discount', '18000', '2026-11-08 17:57:22', '2026-11-08 17:57:22'),
(1147, 193, 'skill', 'تبديل شاشة', '2026-11-08 17:57:22', '2026-11-08 17:57:22'),
(1148, 194, 'brand', 'Realme', '2026-11-08 17:58:35', '2026-11-08 17:58:35'),
(1149, 194, 'model', 'REALME C65 4G - REALME C65 5G - REALME C67 4G - REALME C75x - REALME 12 5G - REALME 13 5G - OPPO A60', '2026-11-08 17:58:35', '2026-11-08 17:58:35'),
(1150, 194, 'price', '25000', '2026-11-08 17:58:35', '2026-11-08 17:58:35'),
(1151, 194, 'discount', '16000', '2026-11-08 17:58:35', '2026-11-08 17:58:35'),
(1152, 194, 'skill', 'تبديل شاشة', '2026-11-08 17:58:35', '2026-11-08 17:58:35'),
(1153, 195, 'brand', 'Realme', '2026-11-08 17:59:55', '2026-11-08 17:59:55'),
(1154, 195, 'model', 'REALME C71 4G', '2026-11-08 17:59:55', '2026-11-08 17:59:55'),
(1155, 195, 'price', '25000', '2026-11-08 17:59:55', '2026-11-08 17:59:55'),
(1156, 195, 'discount', '16000', '2026-11-08 17:59:55', '2026-11-08 17:59:55'),
(1157, 195, 'skill', 'تبديل شاشة', '2026-11-08 17:59:55', '2026-11-08 17:59:55'),
(1158, 196, 'brand', 'Realme', '2026-11-08 18:01:32', '2026-11-08 18:01:32'),
(1159, 196, 'model', 'REALME C75', '2026-11-08 18:01:32', '2026-11-08 18:01:32'),
(1160, 196, 'price', '25000', '2026-11-08 18:01:32', '2026-11-08 18:01:32'),
(1161, 196, 'discount', '16000', '2026-11-08 18:01:32', '2026-11-08 18:01:32'),
(1162, 196, 'skill', 'تبديل شاشة', '2026-11-08 18:01:32', '2026-11-08 18:01:32'),
(1163, 197, 'brand', 'Realme', '2026-11-08 18:02:27', '2026-11-08 18:02:27'),
(1164, 197, 'model', 'REALME C75x', '2026-11-08 18:02:27', '2026-11-08 18:02:27'),
(1165, 197, 'price', '25000', '2026-11-08 18:02:27', '2026-11-08 18:02:27'),
(1166, 197, 'discount', '18000', '2026-11-08 18:02:27', '2026-11-08 18:02:27'),
(1167, 197, 'skill', 'تبديل شاشة', '2026-11-08 18:02:27', '2026-11-08 18:02:27'),
(1168, 198, 'brand', 'Realme', '2026-11-08 18:03:16', '2026-11-08 18:03:16'),
(1169, 198, 'model', 'REALME C85', '2026-11-08 18:03:16', '2026-11-08 18:03:16'),
(1170, 198, 'price', '25000', '2026-11-08 18:03:16', '2026-11-08 18:03:16'),
(1171, 198, 'discount', '18000', '2026-11-08 18:03:16', '2026-11-08 18:03:16'),
(1172, 198, 'skill', 'تبديل شاشة', '2026-11-08 18:03:16', '2026-11-08 18:03:16'),
(1173, 199, 'brand', 'Realme', '2026-11-08 18:04:13', '2026-11-08 18:04:13'),
(1174, 199, 'model', 'REALME NOTE 70 - REALME C72 - REALME NOTE 70T', '2026-11-08 18:04:13', '2026-11-08 18:04:13'),
(1175, 199, 'price', '25000', '2026-11-08 18:04:13', '2026-11-08 18:04:13'),
(1176, 199, 'discount', '18000', '2026-11-08 18:04:13', '2026-11-08 18:04:13'),
(1177, 199, 'skill', 'تبديل شاشة', '2026-11-08 18:04:13', '2026-11-08 18:04:13'),
(1178, 200, 'brand', 'Realme', '2026-11-08 18:05:41', '2026-11-08 18:05:41'),
(1179, 200, 'model', 'REALME 7 - REALME 6', '2026-11-08 18:05:41', '2026-11-08 18:05:41'),
(1180, 200, 'price', '20000', '2026-11-08 18:05:41', '2026-11-08 18:05:41'),
(1181, 200, 'discount', '14000', '2026-11-08 18:05:41', '2026-11-08 18:05:41'),
(1182, 200, 'skill', 'تبديل شاشة', '2026-11-08 18:05:41', '2026-11-08 18:05:41'),
(1183, 201, 'brand', 'Realme', '2026-11-08 18:06:29', '2026-11-08 18:06:29'),
(1184, 201, 'model', 'REALME 6i - 5i - C3 - NARZO 10A – OPPO A11', '2026-11-08 18:06:29', '2026-11-08 18:06:29'),
(1185, 201, 'price', '18000', '2026-11-08 18:06:29', '2026-11-08 18:06:29'),
(1186, 201, 'discount', '12000', '2026-11-08 18:06:29', '2026-11-08 18:06:29'),
(1187, 201, 'skill', 'تبديل شاشة', '2026-11-08 18:06:29', '2026-11-08 18:06:29'),
(1188, 202, 'brand', 'Realme', '2026-11-08 18:07:50', '2026-11-08 18:07:50'),
(1189, 202, 'model', 'REALME 8 PRO - REALME 8  - REALME 7 PRO - A74 4G - A94 5G - RENO 5F', '2026-11-08 18:07:50', '2026-11-08 18:07:50'),
(1190, 202, 'price', '25000', '2026-11-08 18:07:50', '2026-11-08 18:07:50'),
(1191, 202, 'discount', '18000', '2026-11-08 18:07:50', '2026-11-08 18:07:50'),
(1192, 202, 'skill', 'تبديل شاشة', '2026-11-08 18:07:50', '2026-11-08 18:07:50'),
(1193, 203, 'brand', 'Realme', '2026-11-08 18:08:47', '2026-11-08 18:08:47'),
(1194, 203, 'model', 'REALME 9 4G - REALME 9PRO PLUS - REALME 10 4G - REALME 11 4G', '2026-11-08 18:08:47', '2026-11-08 18:08:47'),
(1195, 203, 'price', '25000', '2026-11-08 18:08:47', '2026-11-08 18:08:47'),
(1196, 203, 'discount', '18000', '2026-11-08 18:08:47', '2026-11-08 18:08:47'),
(1197, 203, 'skill', 'تبديل شاشة', '2026-11-08 18:08:47', '2026-11-08 18:08:47'),
(1198, 204, 'brand', 'Realme', '2026-11-08 18:09:41', '2026-11-08 18:09:41'),
(1199, 204, 'model', 'REALME 9i', '2026-11-08 18:09:41', '2026-11-08 18:09:41'),
(1200, 204, 'price', '25000', '2026-11-08 18:09:41', '2026-11-08 18:09:41'),
(1201, 204, 'discount', '18000', '2026-11-08 18:09:41', '2026-11-08 18:09:41'),
(1202, 204, 'skill', 'تبديل شاشة', '2026-11-08 18:09:41', '2026-11-08 18:09:41'),
(1203, 205, 'brand', 'Realme', '2026-11-08 18:10:38', '2026-11-08 18:10:38'),
(1204, 205, 'model', 'REALME 12 4G - REALME 13 4G - REALME 13 PRO - REALME 13 PLUS - REALME 14 - REALME 14T', '2026-11-08 18:10:38', '2026-11-08 18:10:38'),
(1205, 205, 'price', '25000', '2026-11-08 18:10:38', '2026-11-08 18:10:38'),
(1206, 205, 'discount', '18000', '2026-11-08 18:10:38', '2026-11-08 18:10:38'),
(1207, 205, 'skill', 'تبديل شاشة', '2026-11-08 18:10:38', '2026-11-08 18:10:38'),
(1208, 206, 'brand', 'Realme', '2026-11-08 18:13:38', '2026-11-08 18:13:38'),
(1209, 206, 'model', 'REALME 12 PLUS  5G', '2026-11-08 18:13:38', '2026-11-08 18:13:38'),
(1210, 206, 'price', '55000', '2026-11-08 18:13:38', '2026-11-08 18:13:38'),
(1211, 206, 'discount', '40000', '2026-11-08 18:13:38', '2026-11-08 18:13:38'),
(1212, 206, 'skill', 'تبديل شاشة', '2026-11-08 18:13:38', '2026-11-08 18:13:38'),
(1213, 207, 'brand', 'Realme', '2026-11-08 18:15:42', '2026-11-08 18:15:42'),
(1214, 207, 'model', 'REALME C100x - REALME C100 5G - REALME C100i - REALME C83 5G - REALME C83x - realme c85X - OPPO A6c 4G', '2026-11-08 18:15:42', '2026-11-08 18:15:42'),
(1215, 207, 'price', '25000', '2026-11-08 18:15:42', '2026-11-08 18:15:42'),
(1216, 207, 'discount', '20000', '2026-11-08 18:15:42', '2026-11-08 18:15:42'),
(1217, 207, 'skill', 'تبديل شاشة', '2026-11-08 18:15:42', '2026-11-08 18:15:42'),
(1218, 208, 'brand', 'Realme', '2026-11-08 18:16:50', '2026-11-08 18:16:50'),
(1219, 208, 'model', 'REALME Q3PRO – OPPO RENO 5 – RENO 6PRO - GT MASTER', '2026-11-08 18:16:50', '2026-11-08 18:16:50'),
(1220, 208, 'price', '60000', '2026-11-08 18:16:50', '2026-11-08 18:16:50'),
(1221, 208, 'discount', '48000', '2026-11-08 18:16:50', '2026-11-08 18:16:50'),
(1222, 208, 'skill', 'تبديل شاشة', '2026-11-08 18:16:50', '2026-11-08 18:16:50'),
(1223, 209, 'brand', 'Realme', '2026-11-08 18:23:20', '2026-11-08 18:23:20'),
(1224, 209, 'model', 'REALME 7i - C17 - OPPO A53 - A53s', '2026-11-08 18:23:20', '2026-11-08 18:23:20'),
(1225, 209, 'price', '20000', '2026-11-08 18:23:20', '2026-11-08 18:23:20'),
(1226, 209, 'discount', '14000', '2026-11-08 18:23:20', '2026-11-08 18:23:20'),
(1227, 209, 'skill', 'تبديل شاشة', '2026-11-08 18:23:20', '2026-11-08 18:23:20'),
(1228, 210, 'brand', 'Redmi', '2026-11-09 08:24:53', '2026-11-09 08:24:53'),
(1229, 210, 'model', 'REDMI 8 – REDMI 8A', '2026-11-09 08:24:53', '2026-11-09 08:24:53'),
(1230, 210, 'price', '20000', '2026-11-09 08:24:53', '2026-11-09 08:24:53'),
(1231, 210, 'discount', '15000', '2026-11-09 08:24:53', '2026-11-09 08:24:53'),
(1232, 210, 'skill', 'تبديل شاشة', '2026-11-09 08:24:53', '2026-11-09 08:24:53'),
(1233, 211, 'brand', 'Redmi', '2026-11-09 08:27:11', '2026-11-09 08:27:11'),
(1234, 211, 'model', 'REDMI 9', '2026-11-09 08:27:11', '2026-11-09 08:27:11'),
(1235, 211, 'price', '20000', '2026-11-09 08:27:11', '2026-11-09 08:27:11'),
(1236, 211, 'discount', '16000', '2026-11-09 08:27:11', '2026-11-09 08:27:11'),
(1237, 211, 'skill', 'تبديل شاشة', '2026-11-09 08:27:11', '2026-11-09 08:27:11'),
(1238, 212, 'brand', 'Redmi', '2026-11-09 08:28:36', '2026-11-09 08:28:36'),
(1239, 212, 'model', 'REDMI 9A – 9C – 10A – POCO C3 - POOC C65', '2026-11-09 08:28:36', '2026-11-09 08:28:36'),
(1240, 212, 'price', '18000', '2026-11-09 08:28:36', '2026-11-09 08:28:36'),
(1241, 212, 'discount', '12000', '2026-11-09 08:28:36', '2026-11-09 08:28:36'),
(1242, 212, 'skill', 'تبديل شاشة', '2026-11-09 08:28:36', '2026-11-09 08:28:36'),
(1243, 213, 'brand', 'Redmi', '2026-11-09 08:29:47', '2026-11-09 08:29:47'),
(1244, 213, 'model', 'REDMI 10C – POCO C40', '2026-11-09 08:29:47', '2026-11-09 08:29:47'),
(1245, 213, 'price', '20000', '2026-11-09 08:29:47', '2026-11-09 08:29:47'),
(1246, 213, 'discount', '14000', '2026-11-09 08:29:47', '2026-11-09 08:29:47'),
(1247, 213, 'skill', 'تبديل شاشة', '2026-11-09 08:29:47', '2026-11-09 08:29:47'),
(1248, 214, 'brand', 'Redmi', '2026-11-09 08:30:57', '2026-11-09 08:30:57'),
(1249, 214, 'model', 'REDMI 10', '2026-11-09 08:30:57', '2026-11-09 08:30:57'),
(1250, 214, 'price', '20000', '2026-11-09 08:30:57', '2026-11-09 08:30:57'),
(1251, 214, 'discount', '14000', '2026-11-09 08:30:57', '2026-11-09 08:30:57'),
(1252, 214, 'skill', 'تبديل شاشة', '2026-11-09 08:30:57', '2026-11-09 08:30:57'),
(1253, 215, 'brand', 'Redmi', '2026-11-09 08:31:54', '2026-11-09 08:31:54'),
(1254, 215, 'model', 'REDMI 12c', '2026-11-09 08:31:54', '2026-11-09 08:31:54'),
(1255, 215, 'price', '20000', '2026-11-09 08:31:54', '2026-11-09 08:31:54'),
(1256, 215, 'discount', '16000', '2026-11-09 08:31:54', '2026-11-09 08:31:54'),
(1257, 215, 'skill', 'تبديل شاشة', '2026-11-09 08:31:54', '2026-11-09 08:31:54'),
(1258, 216, 'brand', 'Redmi', '2026-11-09 08:33:39', '2026-11-09 08:33:39'),
(1259, 216, 'model', 'REDMI 13 - REDMI 12 - POCO M6 4G - POCO M6 PRO 5G', '2026-11-09 08:33:39', '2026-11-09 08:33:39'),
(1260, 216, 'price', '20000', '2026-11-09 08:33:39', '2026-11-09 08:33:39'),
(1261, 216, 'discount', '16000', '2026-11-09 08:33:39', '2026-11-09 08:33:39'),
(1262, 216, 'skill', 'تبديل شاشة', '2026-11-09 08:33:39', '2026-11-09 08:33:39'),
(1263, 217, 'brand', 'Redmi', '2026-11-09 08:34:57', '2026-11-09 08:34:57'),
(1264, 217, 'model', 'REDMI 13C - POCO C65', '2026-11-09 08:34:57', '2026-11-09 08:34:57'),
(1265, 217, 'price', '20000', '2026-11-09 08:34:57', '2026-11-09 08:34:57'),
(1266, 217, 'discount', '15000', '2026-11-09 08:34:57', '2026-11-09 08:34:57'),
(1267, 217, 'skill', 'تبديل شاشة', '2026-11-09 08:34:57', '2026-11-09 08:34:57'),
(1268, 218, 'brand', 'Redmi', '2026-11-09 08:36:04', '2026-11-09 08:36:04'),
(1269, 218, 'model', 'REDMI 14C - REDMI A3 PRO - REDMI 14R 5G -POCO C75', '2026-11-09 08:36:04', '2026-11-09 08:36:04'),
(1270, 218, 'price', '20000', '2026-11-09 08:36:04', '2026-11-09 08:36:04'),
(1271, 218, 'discount', '15000', '2026-11-09 08:36:04', '2026-11-09 08:36:04'),
(1272, 218, 'skill', 'تبديل شاشة', '2026-11-09 08:36:04', '2026-11-09 08:36:04'),
(1273, 219, 'brand', 'Redmi', '2026-11-09 08:36:50', '2026-11-09 08:36:50'),
(1274, 219, 'model', 'REDMI 15 4G - POCO M7 4G', '2026-11-09 08:36:50', '2026-11-09 08:36:50'),
(1275, 219, 'price', '25000', '2026-11-09 08:36:50', '2026-11-09 08:36:50'),
(1276, 219, 'discount', '18000', '2026-11-09 08:36:50', '2026-11-09 08:36:50'),
(1277, 219, 'skill', 'تبديل شاشة', '2026-11-09 08:36:50', '2026-11-09 08:36:50'),
(1278, 220, 'brand', 'Redmi', '2026-11-09 08:37:44', '2026-11-09 08:37:44'),
(1279, 220, 'model', 'REDMI 15c 4G - REDMI 15c 5G - POCO C85 4G', '2026-11-09 08:37:44', '2026-11-09 08:37:44'),
(1280, 220, 'price', '25000', '2026-11-09 08:37:44', '2026-11-09 08:37:44'),
(1281, 220, 'discount', '18000', '2026-11-09 08:37:44', '2026-11-09 08:37:44'),
(1282, 220, 'skill', 'تبديل شاشة', '2026-11-09 08:37:44', '2026-11-09 08:37:44'),
(1283, 221, 'brand', 'Redmi', '2026-11-09 14:27:32', '2026-11-09 14:27:32'),
(1284, 221, 'model', 'REDMI NOTE 8', '2026-11-09 14:27:32', '2026-11-09 14:27:32'),
(1285, 221, 'price', '20000', '2026-11-09 14:27:32', '2026-11-09 14:27:32'),
(1286, 221, 'discount', '15000', '2026-11-09 14:27:32', '2026-11-09 14:27:32'),
(1287, 221, 'skill', 'تبديل شاشة', '2026-11-09 14:27:32', '2026-11-09 14:27:32'),
(1288, 222, 'brand', 'Redmi', '2026-11-09 14:28:26', '2026-11-09 14:28:26'),
(1289, 222, 'model', 'REDMI NOTE 8 PRO', '2026-11-09 14:28:26', '2026-11-09 14:28:26'),
(1290, 222, 'price', '25000', '2026-11-09 14:28:26', '2026-11-09 14:28:26'),
(1291, 222, 'discount', '16000', '2026-11-09 14:28:26', '2026-11-09 14:28:26'),
(1292, 222, 'skill', 'تبديل شاشة', '2026-11-09 14:28:26', '2026-11-09 14:28:26'),
(1293, 223, 'brand', 'Redmi', '2026-11-09 14:30:11', '2026-11-09 14:30:11'),
(1294, 223, 'model', 'REDMI NOTE 9', '2026-11-09 14:30:11', '2026-11-09 14:30:11'),
(1295, 223, 'price', '18000', '2026-11-09 14:30:11', '2026-11-09 14:30:11'),
(1296, 223, 'discount', '13000', '2026-11-09 14:30:11', '2026-11-09 14:30:11'),
(1297, 223, 'skill', 'تبديل شاشة', '2026-11-09 14:30:11', '2026-11-09 14:30:11'),
(1298, 224, 'brand', 'Redmi', '2026-11-09 14:31:12', '2026-11-09 14:31:12'),
(1299, 224, 'model', 'REDMI NOTE 9 4G - POCO M3 - REDMI 9T', '2026-11-09 14:31:12', '2026-11-09 14:31:12'),
(1300, 224, 'price', '25000', '2026-11-09 14:31:12', '2026-11-09 14:31:12'),
(1301, 224, 'discount', '16000', '2026-11-09 14:31:12', '2026-11-09 14:31:12'),
(1302, 224, 'skill', 'تبديل شاشة', '2026-11-09 14:31:12', '2026-11-09 14:31:12'),
(1303, 225, 'brand', 'Redmi', '2026-11-09 14:31:59', '2026-11-09 14:31:59'),
(1304, 225, 'model', 'REDMI NOTE 9s - REDMI NOTE 9 PRO', '2026-11-09 14:31:59', '2026-11-09 14:31:59'),
(1305, 225, 'price', '25000', '2026-11-09 14:31:59', '2026-11-09 14:31:59'),
(1306, 225, 'discount', '16000', '2026-11-09 14:31:59', '2026-11-09 14:31:59'),
(1307, 225, 'skill', 'تبديل شاشة', '2026-11-09 14:31:59', '2026-11-09 14:31:59'),
(1308, 226, 'brand', 'Redmi', '2026-11-09 14:33:02', '2026-11-09 14:33:02'),
(1309, 226, 'model', 'REDMI NOTE 10 4G - NOTE 10S - POCO M5s', '2026-11-09 14:33:02', '2026-11-09 14:33:02'),
(1310, 226, 'price', '20000', '2026-11-09 14:33:02', '2026-11-09 14:33:02'),
(1311, 226, 'discount', '14000', '2026-11-09 14:33:02', '2026-11-09 14:33:02'),
(1312, 226, 'skill', 'تبديل شاشة', '2026-11-09 14:33:02', '2026-11-09 14:33:02'),
(1313, 227, 'brand', 'Redmi', '2026-11-09 14:34:09', '2026-11-09 14:34:09'),
(1314, 227, 'model', 'REDMI NOTE 10 PRO 4G - NOTE 10 PRO MAX - NOTE 11 PRO 5G - NOTE 11 PRO PLUS 5G - REDMI NOTE 12 PRO 4G - POCO X4 PRO 4G - POCO X4 PRO 5G', '2026-11-09 14:34:09', '2026-11-09 14:34:09'),
(1315, 227, 'price', '25000', '2026-11-09 14:34:09', '2026-11-09 14:34:09'),
(1316, 227, 'discount', '18000', '2026-11-09 14:34:09', '2026-11-09 14:34:09'),
(1317, 227, 'skill', 'تبديل شاشة', '2026-11-09 14:34:09', '2026-11-09 14:34:09'),
(1318, 228, 'brand', 'Redmi', '2026-11-09 14:34:59', '2026-11-09 14:34:59'),
(1319, 228, 'model', 'REDMI NOTE 10 PRO 5G', '2026-11-09 14:34:59', '2026-11-09 14:34:59'),
(1320, 228, 'price', '30000', '2026-11-09 14:34:59', '2026-11-09 14:34:59'),
(1321, 228, 'discount', '20000', '2026-11-09 14:34:59', '2026-11-09 14:34:59'),
(1322, 228, 'skill', 'تبديل شاشة', '2026-11-09 14:34:59', '2026-11-09 14:34:59'),
(1323, 229, 'brand', 'Redmi', '2026-11-09 14:36:14', '2026-11-09 14:36:14'),
(1324, 229, 'model', 'REDMI NOTE 11 4G – NOTE 11s - NOTE 12s –POCO M4 PRO 4G', '2026-11-09 14:36:14', '2026-11-09 14:36:14'),
(1325, 229, 'price', '25000', '2026-11-09 14:36:14', '2026-11-09 14:36:14'),
(1326, 229, 'discount', '18000', '2026-11-09 14:36:14', '2026-11-09 14:36:14'),
(1327, 229, 'skill', 'تبديل شاشة', '2026-11-09 14:36:14', '2026-11-09 14:36:14'),
(1328, 230, 'brand', 'Redmi', '2026-11-09 14:37:14', '2026-11-09 14:37:14'),
(1329, 230, 'model', 'REDMI NOTE 11 PRO 4G - NOTE 11 PRO 5G - NOTE 12 PRO 4G', '2026-11-09 14:37:14', '2026-11-09 14:37:14'),
(1330, 230, 'price', '25000', '2026-11-09 14:37:14', '2026-11-09 14:37:14'),
(1331, 230, 'discount', '18000', '2026-11-09 14:37:14', '2026-11-09 14:37:14'),
(1332, 230, 'skill', 'تبديل شاشة', '2026-11-09 14:37:14', '2026-11-09 14:37:14'),
(1333, 231, 'brand', 'Redmi', '2026-11-09 14:38:19', '2026-11-09 14:38:19'),
(1334, 231, 'model', 'REDMI NOTE 12 4G - NOTE 12 5G - POCO X5', '2026-11-09 14:38:19', '2026-11-09 14:38:19'),
(1335, 231, 'price', '25000', '2026-11-09 14:38:19', '2026-11-09 14:38:19'),
(1336, 231, 'discount', '18000', '2026-11-09 14:38:19', '2026-11-09 14:38:19'),
(1337, 231, 'skill', 'تبديل شاشة', '2026-11-09 14:38:19', '2026-11-09 14:38:19'),
(1338, 232, 'brand', 'Redmi', '2026-11-09 14:39:26', '2026-11-09 14:39:26'),
(1339, 232, 'model', 'REDMI NOTE 13 4G  - REDMI NOTE 14 4G - REDMI NOTE 14 5G - POCO M7 PRO', '2026-11-09 14:39:26', '2026-11-09 14:39:26'),
(1340, 232, 'price', '25000', '2026-11-09 14:39:26', '2026-11-09 14:39:26'),
(1341, 232, 'discount', '16000', '2026-11-09 14:39:26', '2026-11-09 14:39:26'),
(1342, 232, 'skill', 'تبديل شاشة', '2026-11-09 14:39:26', '2026-11-09 14:39:26'),
(1343, 233, 'brand', 'Redmi', '2026-11-09 14:40:24', '2026-11-09 14:40:24'),
(1344, 233, 'model', 'REDMI NOTE 13 PRO 4G - NOTE 14S - POCO M6 PRO 4G', '2026-11-09 14:40:24', '2026-11-09 14:40:24'),
(1345, 233, 'price', '30000', '2026-11-09 14:40:24', '2026-11-09 14:40:24'),
(1346, 233, 'discount', '20000', '2026-11-09 14:40:24', '2026-11-09 14:40:24'),
(1347, 233, 'skill', 'تبديل شاشة', '2026-11-09 14:40:24', '2026-11-09 14:40:24'),
(1348, 234, 'brand', 'Redmi', '2026-11-09 14:41:24', '2026-11-09 14:41:24'),
(1349, 234, 'model', 'REDMI NOTE 13 PRO PLUS 5G -NOTE 14 PRO 5G - NOTE 14 PRO PLUS 5G - POCO X7 5G', '2026-11-09 14:41:24', '2026-11-09 14:41:24'),
(1350, 234, 'price', '35000', '2026-11-09 14:41:24', '2026-11-09 14:41:24'),
(1351, 234, 'discount', '22000', '2026-11-09 14:41:24', '2026-11-09 14:41:24'),
(1352, 234, 'skill', 'تبديل شاشة', '2026-11-09 14:41:24', '2026-11-09 14:41:24'),
(1353, 235, 'brand', 'Redmi', '2026-11-09 14:43:16', '2026-11-09 14:43:16'),
(1354, 235, 'model', 'REDMI NOTE 14 4G - NOTE 14 5G - NOTE 13 4G - POCO M7 PRO', '2026-11-09 14:43:16', '2026-11-09 14:43:16'),
(1355, 235, 'price', '75000', '2026-11-09 14:43:16', '2026-11-09 14:43:16'),
(1356, 235, 'discount', '50000', '2026-11-09 14:43:16', '2026-11-09 14:43:16'),
(1357, 235, 'skill', 'تبديل شاشة', '2026-11-09 14:43:16', '2026-11-09 14:43:16'),
(1358, 236, 'brand', 'Redmi', '2026-11-09 14:44:23', '2026-11-09 14:44:23'),
(1359, 236, 'model', 'REDMI A1 - A1 PLUS - A2 - A2 PLUS - POCO C50 - C51', '2026-11-09 14:44:23', '2026-11-09 14:44:23'),
(1360, 236, 'price', '25000', '2026-11-09 14:44:23', '2026-11-09 14:44:23'),
(1361, 236, 'discount', '16000', '2026-11-09 14:44:23', '2026-11-09 14:44:23'),
(1362, 236, 'skill', 'تبديل شاشة', '2026-11-09 14:44:23', '2026-11-09 14:44:23'),
(1363, 237, 'brand', 'Redmi', '2026-11-09 14:45:12', '2026-11-09 14:45:12'),
(1364, 237, 'model', 'REDMI A3 -A3 PLUS - POCO C61', '2026-11-09 14:45:12', '2026-11-09 14:45:12'),
(1365, 237, 'price', '25000', '2026-11-09 14:45:12', '2026-11-09 14:45:12'),
(1366, 237, 'discount', '17000', '2026-11-09 14:45:12', '2026-11-09 14:45:12'),
(1367, 237, 'skill', 'تبديل شاشة', '2026-11-09 14:45:12', '2026-11-09 14:45:12'),
(1368, 238, 'brand', 'POCO', '2026-11-09 17:06:56', '2026-11-09 17:06:56'),
(1369, 238, 'model', 'POCO X3 – X3PRO', '2026-11-09 17:06:56', '2026-11-09 17:06:56'),
(1370, 238, 'price', '45000', '2026-11-09 17:06:56', '2026-11-09 17:06:56'),
(1371, 238, 'discount', '35000', '2026-11-09 17:06:56', '2026-11-09 17:06:56'),
(1372, 238, 'skill', 'تبديل شاشة', '2026-11-09 17:06:56', '2026-11-09 17:06:56'),
(1373, 239, 'brand', 'POCO', '2026-11-09 17:08:40', '2026-11-09 17:08:40'),
(1374, 239, 'model', 'POCO X5 PRO - REDMI NOTE 12 PRO 5G - NOTE 12 PRO PLUS 5G', '2026-11-09 17:08:40', '2026-11-09 17:08:40'),
(1375, 239, 'price', '60000', '2026-11-09 17:08:40', '2026-11-09 17:08:40'),
(1376, 239, 'discount', '45000', '2026-11-09 17:08:40', '2026-11-09 17:08:40'),
(1377, 239, 'skill', 'تبديل شاشة', '2026-11-09 17:08:40', '2026-11-09 17:08:40'),
(1378, 240, 'brand', 'POCO', '2026-11-09 17:09:54', '2026-11-09 17:09:54'),
(1379, 240, 'model', 'POCO X6 - REDMI NOTE 13 PRO PLUS - NOTE 13 PRO 5G', '2026-11-09 17:09:54', '2026-11-09 17:09:54'),
(1380, 240, 'price', '25000', '2026-11-09 17:09:54', '2026-11-09 17:09:54'),
(1381, 240, 'discount', '18000', '2026-11-09 17:09:54', '2026-11-09 17:09:54'),
(1382, 240, 'skill', 'تبديل شاشة', '2026-11-09 17:09:54', '2026-11-09 17:09:54'),
(1383, 241, 'brand', 'POCO', '2026-11-09 17:10:59', '2026-11-09 17:10:59'),
(1384, 241, 'model', 'POCO X6 PRO 5G - POCO F6', '2026-11-09 17:10:59', '2026-11-09 17:10:59'),
(1385, 241, 'price', '25000', '2026-11-09 17:10:59', '2026-11-09 17:10:59'),
(1386, 241, 'discount', '18000', '2026-11-09 17:10:59', '2026-11-09 17:10:59'),
(1387, 241, 'skill', 'تبديل شاشة', '2026-11-09 17:10:59', '2026-11-09 17:10:59'),
(1388, 242, 'brand', 'POCO', '2026-11-09 17:11:58', '2026-11-09 17:11:58'),
(1389, 242, 'model', 'POCO C71 4G - REDMI A5 4G - REDMI A5 5G', '2026-11-09 17:11:58', '2026-11-09 17:11:58'),
(1390, 242, 'price', '25000', '2026-11-09 17:11:58', '2026-11-09 17:11:58'),
(1391, 242, 'discount', '18000', '2026-11-09 17:11:58', '2026-11-09 17:11:58'),
(1392, 242, 'skill', 'تبديل شاشة', '2026-11-09 17:11:58', '2026-11-09 17:11:58'),
(1393, 243, 'brand', 'POCO', '2026-11-09 17:14:48', '2026-11-09 17:14:48'),
(1394, 243, 'model', 'POCO C81 - POCO C81 PRO - POCO C85x 5G - REDMI A7 PRP 4G - REDMI A7 PRO 5G', '2026-11-09 17:14:48', '2026-11-09 17:14:48'),
(1395, 243, 'price', '30000', '2026-11-09 17:14:48', '2026-11-09 17:14:48'),
(1396, 243, 'discount', '20000', '2026-11-09 17:14:48', '2026-11-09 17:14:48'),
(1397, 243, 'skill', 'تبديل شاشة', '2026-11-09 17:14:48', '2026-11-09 17:14:48'),
(1398, 244, 'brand', 'POCO', '2026-11-09 17:16:24', '2026-11-09 17:16:24'),
(1399, 244, 'model', 'POCO M3 PRO - REDMI NOTE 10 5G - NOTE 10T 5G', '2026-11-09 17:16:24', '2026-11-09 17:16:24'),
(1400, 244, 'price', '25000', '2026-11-09 17:16:24', '2026-11-09 17:16:24'),
(1401, 244, 'discount', '19000', '2026-11-09 17:16:24', '2026-11-09 17:16:24'),
(1402, 244, 'skill', 'تبديل شاشة', '2026-11-09 17:16:24', '2026-11-09 17:16:24'),
(1403, 245, 'brand', 'POCO', '2026-11-09 17:17:29', '2026-11-09 17:17:29'),
(1404, 245, 'model', 'POCO M4 - POCO M5 4G - REDMI 10 5G', '2026-11-09 17:17:29', '2026-11-09 17:17:29'),
(1405, 245, 'price', '25000', '2026-11-09 17:17:29', '2026-11-09 17:17:29'),
(1406, 245, 'discount', '16000', '2026-11-09 17:17:29', '2026-11-09 17:17:29'),
(1407, 245, 'skill', 'تبديل شاشة', '2026-11-09 17:17:29', '2026-11-09 17:17:29'),
(1413, 247, 'brand', 'Itel', '2026-11-09 17:59:13', '2026-11-09 17:59:13'),
(1414, 247, 'model', 'ITEL A26', '2026-11-09 17:59:13', '2026-11-09 17:59:13'),
(1415, 247, 'price', '20000', '2026-11-09 17:59:13', '2026-11-09 17:59:13'),
(1416, 247, 'discount', '12000', '2026-11-09 17:59:13', '2026-11-09 17:59:13'),
(1417, 247, 'skill', 'تبديل شاشة', '2026-11-09 17:59:13', '2026-11-09 17:59:13'),
(1418, 248, 'brand', 'Itel', '2026-11-09 17:59:56', '2026-11-09 17:59:56'),
(1419, 248, 'model', 'ITEL A49 - ITEL A58 - A58 PRO', '2026-11-09 17:59:56', '2026-11-09 17:59:56'),
(1420, 248, 'price', '20000', '2026-11-09 17:59:56', '2026-11-09 17:59:56'),
(1421, 248, 'discount', '12000', '2026-11-09 17:59:56', '2026-11-09 17:59:56'),
(1422, 248, 'skill', 'تبديل شاشة', '2026-11-09 17:59:56', '2026-11-09 17:59:56'),
(1423, 249, 'brand', 'Itel', '2026-11-09 18:00:44', '2026-11-09 18:00:44'),
(1424, 249, 'model', 'ITEL A56', '2026-11-09 18:00:44', '2026-11-09 18:00:44'),
(1425, 249, 'price', '20000', '2026-11-09 18:00:44', '2026-11-09 18:00:44'),
(1426, 249, 'discount', '12000', '2026-11-09 18:00:44', '2026-11-09 18:00:44'),
(1427, 249, 'skill', 'تبديل شاشة', '2026-11-09 18:00:44', '2026-11-09 18:00:44'),
(1428, 250, 'brand', 'LENOVO', '2026-11-09 18:01:42', '2026-11-09 18:01:42'),
(1429, 250, 'model', 'LENOVO K12', '2026-11-09 18:01:42', '2026-11-09 18:01:42'),
(1430, 250, 'price', '25000', '2026-11-09 18:01:42', '2026-11-09 18:01:42'),
(1431, 250, 'discount', '18000', '2026-11-09 18:01:42', '2026-11-09 18:01:42'),
(1432, 250, 'skill', 'تبديل شاشة', '2026-11-09 18:01:42', '2026-11-09 18:01:42'),
(1433, 251, 'brand', 'LENOVO', '2026-11-09 18:02:58', '2026-11-09 18:02:58'),
(1434, 251, 'model', 'LENOVO K13', '2026-11-09 18:02:58', '2026-11-09 18:02:58'),
(1435, 251, 'price', '30000', '2026-11-09 18:02:58', '2026-11-09 18:02:58'),
(1436, 251, 'discount', '20000', '2026-11-09 18:02:58', '2026-11-09 18:02:58'),
(1437, 251, 'skill', 'تبديل شاشة', '2026-11-09 18:02:58', '2026-11-09 18:02:58'),
(1438, 252, 'brand', 'LENOVO', '2026-11-09 18:04:02', '2026-11-09 18:04:02'),
(1439, 252, 'model', 'LENOVO K14 - K14 PLUS - K15 - K15 PLUS - NOTE 13', '2026-11-09 18:04:02', '2026-11-09 18:04:02'),
(1440, 252, 'price', '25000', '2026-11-09 18:04:02', '2026-11-09 18:04:02'),
(1441, 252, 'discount', '15000', '2026-11-09 18:04:02', '2026-11-09 18:04:02'),
(1442, 252, 'skill', 'تبديل شاشة', '2026-11-09 18:04:02', '2026-11-09 18:04:02'),
(1443, 253, 'brand', 'Wiko', '2026-11-09 18:05:28', '2026-11-09 18:05:28'),
(1444, 253, 'model', 'WIKO T3', '2026-11-09 18:05:28', '2026-11-09 18:05:28'),
(1445, 253, 'price', '25000', '2026-11-09 18:05:28', '2026-11-09 18:05:28'),
(1446, 253, 'discount', '18000', '2026-11-09 18:05:28', '2026-11-09 18:05:28'),
(1447, 253, 'skill', 'تبديل شاشة', '2026-11-09 18:05:28', '2026-11-09 18:05:28'),
(1448, 254, 'brand', 'Wiko', '2026-11-09 18:06:15', '2026-11-09 18:06:15'),
(1449, 254, 'model', 'WIKO T10', '2026-11-09 18:06:15', '2026-11-09 18:06:15'),
(1450, 254, 'price', '25000', '2026-11-09 18:06:15', '2026-11-09 18:06:15'),
(1451, 254, 'discount', '18000', '2026-11-09 18:06:15', '2026-11-09 18:06:15'),
(1452, 254, 'skill', 'تبديل شاشة', '2026-11-09 18:06:15', '2026-11-09 18:06:15'),
(1458, 246, 'brand', 'Blackviwe', '2026-11-09 18:07:11', '2026-11-09 18:07:11'),
(1459, 246, 'model', 'BLACKVIWE A70', '2026-11-09 18:07:11', '2026-11-09 18:07:11'),
(1460, 246, 'price', '25000', '2026-11-09 18:07:11', '2026-11-09 18:07:11'),
(1461, 246, 'discount', '16000', '2026-11-09 18:07:11', '2026-11-09 18:07:11'),
(1462, 246, 'skill', 'تبديل شاشة', '2026-11-09 18:07:11', '2026-11-09 18:07:11'),
(1463, 255, 'brand', 'Vivo', '2026-11-13 08:08:28', '2026-11-13 08:08:28'),
(1464, 255, 'model', 'VIVO Y1S - Y90 - Y93', '2026-11-13 08:08:28', '2026-11-13 08:08:28'),
(1465, 255, 'price', '25000', '2026-11-13 08:08:28', '2026-11-13 08:08:28'),
(1466, 255, 'discount', '17000', '2026-11-13 08:08:28', '2026-11-13 08:08:28'),
(1467, 255, 'skill', 'تبديل شاشة', '2026-11-13 08:08:28', '2026-11-13 08:08:28'),
(1468, 256, 'brand', 'Vivo', '2026-11-13 08:09:36', '2026-11-13 08:09:36'),
(1469, 256, 'model', 'VIVO Y11 – Y12 – Y15 – Y17', '2026-11-13 08:09:36', '2026-11-13 08:09:36'),
(1470, 256, 'price', '20000', '2026-11-13 08:09:36', '2026-11-13 08:09:36'),
(1471, 256, 'discount', '14000', '2026-11-13 08:09:36', '2026-11-13 08:09:36'),
(1472, 256, 'skill', 'تبديل شاشة', '2026-11-13 08:09:36', '2026-11-13 08:09:36'),
(1473, 257, 'brand', 'Vivo', '2026-11-13 08:12:07', '2026-11-13 08:12:07'),
(1474, 257, 'model', 'VIVO Y20 - Y20s - Y20i - Y11s - Y12s - Y15s – Y12a', '2026-11-13 08:12:07', '2026-11-13 08:12:07'),
(1475, 257, 'price', '25000', '2026-11-13 08:12:07', '2026-11-13 08:12:07'),
(1476, 257, 'discount', '15000', '2026-11-13 08:12:07', '2026-11-13 08:12:07'),
(1477, 257, 'skill', 'تبديل شاشة', '2026-11-13 08:12:07', '2026-11-13 08:12:07'),
(1478, 258, 'brand', 'Vivo', '2026-11-13 08:15:15', '2026-11-13 08:15:15'),
(1479, 258, 'model', 'VIVO Y21 -Y21s - Y33s - Y02s - Y32 - Y025 - Y16', '2026-11-13 08:15:15', '2026-11-13 08:15:15'),
(1480, 258, 'price', '20000', '2026-11-13 08:15:15', '2026-11-13 08:15:15'),
(1481, 258, 'discount', '14000', '2026-11-13 08:15:15', '2026-11-13 08:15:15'),
(1482, 258, 'skill', 'تبديل شاشة', '2026-11-13 08:15:15', '2026-11-13 08:15:15'),
(1483, 259, 'brand', 'Vivo', '2026-11-13 08:16:15', '2026-11-13 08:16:15'),
(1484, 259, 'model', 'VIVO Y30 - Y30i', '2026-11-13 08:16:15', '2026-11-13 08:16:15'),
(1485, 259, 'price', '20000', '2026-11-13 08:16:15', '2026-11-13 08:16:15'),
(1486, 259, 'discount', '15000', '2026-11-13 08:16:15', '2026-11-13 08:16:15'),
(1487, 259, 'skill', 'تبديل شاشة', '2026-11-13 08:16:15', '2026-11-13 08:16:15'),
(1488, 260, 'brand', 'Vivo', '2026-11-13 08:17:02', '2026-11-13 08:17:02'),
(1489, 260, 'model', 'VIVO Y51 2020 – Y53s', '2026-11-13 08:17:02', '2026-11-13 08:17:02'),
(1490, 260, 'price', '25000', '2026-11-13 08:17:02', '2026-11-13 08:17:02'),
(1491, 260, 'discount', '15000', '2026-11-13 08:17:02', '2026-11-13 08:17:02'),
(1492, 260, 'skill', 'تبديل شاشة', '2026-11-13 08:17:02', '2026-11-13 08:17:02'),
(1493, 261, 'brand', 'Vivo', '2026-11-13 08:20:52', '2026-11-13 08:20:52'),
(1494, 261, 'model', 'VIVO Y19 - Y5S', '2026-11-13 08:20:52', '2026-11-13 08:20:52'),
(1495, 261, 'price', '18000', '2026-11-13 08:20:52', '2026-11-13 08:20:52'),
(1496, 261, 'discount', '12000', '2026-11-13 08:20:52', '2026-11-13 08:20:52'),
(1497, 261, 'skill', 'تبديل شاشة', '2026-11-13 08:20:52', '2026-11-13 08:20:52'),
(1498, 262, 'brand', 'Oppo', '2026-11-13 08:22:50', '2026-11-13 08:22:50'),
(1499, 262, 'model', 'OPPO A12 - A5s - A7 – REALME 3 – REALME 3I', '2026-11-13 08:22:50', '2026-11-13 08:22:50'),
(1500, 262, 'price', '25000', '2026-11-13 08:22:50', '2026-11-13 08:22:50'),
(1501, 262, 'discount', '18000', '2026-11-13 08:22:50', '2026-11-13 08:22:50'),
(1502, 262, 'skill', 'تبديل شاشة', '2026-11-13 08:22:50', '2026-11-13 08:22:50'),
(1503, 263, 'brand', 'Oppo', '2026-11-13 08:24:32', '2026-11-13 08:24:32'),
(1504, 263, 'model', 'OPPO A52 - A72 - A92', '2026-11-13 08:24:32', '2026-11-13 08:24:32'),
(1505, 263, 'price', '30000', '2026-11-13 08:24:32', '2026-11-13 08:24:32'),
(1506, 263, 'discount', '20000', '2026-11-13 08:24:32', '2026-11-13 08:24:32'),
(1507, 263, 'skill', 'تبديل شاشة', '2026-11-13 08:24:32', '2026-11-13 08:24:32'),
(1508, 264, 'brand', 'Oppo', '2026-11-13 08:25:42', '2026-11-13 08:25:42'),
(1509, 264, 'model', 'OPPO A54 5G - A55 5G', '2026-11-13 08:25:42', '2026-11-13 08:25:42'),
(1510, 264, 'price', '25000', '2026-11-13 08:25:42', '2026-11-13 08:25:42'),
(1511, 264, 'discount', '16000', '2026-11-13 08:25:42', '2026-11-13 08:25:42'),
(1512, 264, 'skill', 'تبديل شاشة', '2026-11-13 08:25:42', '2026-11-13 08:25:42'),
(1513, 265, 'brand', 'Oppo', '2026-11-13 08:27:52', '2026-11-13 08:27:52'),
(1514, 265, 'model', 'OPPO A57 5G - OPPA A57 4G -OPP A18 - OPPO A36', '2026-11-13 08:27:52', '2026-11-13 08:27:52'),
(1515, 265, 'price', '25000', '2026-11-13 08:27:52', '2026-11-13 08:27:52'),
(1516, 265, 'discount', '15000', '2026-11-13 08:27:52', '2026-11-13 08:27:52'),
(1517, 265, 'skill', 'تبديل شاشة', '2026-11-13 08:27:52', '2026-11-13 08:27:52'),
(1518, 266, 'brand', 'Oppo', '2026-11-13 08:29:07', '2026-11-13 08:29:07'),
(1519, 266, 'model', 'OPPO A36 2022 - A76 2022', '2026-11-13 08:29:07', '2026-11-13 08:29:07'),
(1520, 266, 'price', '25000', '2026-11-13 08:29:07', '2026-11-13 08:29:07'),
(1521, 266, 'discount', '15000', '2026-11-13 08:29:07', '2026-11-13 08:29:07'),
(1522, 266, 'skill', 'تبديل شاشة', '2026-11-13 08:29:07', '2026-11-13 08:29:07'),
(1523, 267, 'brand', 'Oppo', '2026-11-13 08:30:14', '2026-11-13 08:30:14'),
(1524, 267, 'model', 'OPPO A93 – RENO 4- RENO 4LITE', '2026-11-13 08:30:14', '2026-11-13 08:30:14'),
(1525, 267, 'price', '90000', '2026-11-13 08:30:14', '2026-11-13 08:30:14'),
(1526, 267, 'discount', '70000', '2026-11-13 08:30:14', '2026-11-13 08:30:14'),
(1527, 267, 'skill', 'تبديل شاشة', '2026-11-13 08:30:14', '2026-11-13 08:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `google_api_key` longtext NOT NULL,
  `near_by_location` longtext NOT NULL,
  `privacy_policy` longtext NOT NULL,
  `terms_and_condition` longtext NOT NULL,
  `about_us` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `google_api_key`, `near_by_location`, `privacy_policy`, `terms_and_condition`, `about_us`, `created_at`, `updated_at`) VALUES
(1, 'AIzaSyB86OFACOdLLhVyJ_eJBUWfVIa96NaWnUA', '10', 'سياسة الخصوصية – تطبيق صيانة جوالي\r\nنرحب بكم في تطبيق «صيانة جوالي». نحن نحترم خصوصية مستخدمينا ونلتزم بحماية بياناتهم الشخصية، ونسعى إلى توفير تجربة آمنة وموثوقة عند استخدام خدماتنا.\r\n1. المعلومات التي نجمعها\r\nقد نقوم بجمع المعلومات التالية عند استخدام التطبيق:\r\n* الاسم ورقم الهاتف.\r\n* نوع الهاتف والشركة المصنعة والموديل.\r\n* وصف المشكلة أو العطل.\r\n* الصور التي يرسلها العميل لتوضيح حالة الجهاز.\r\n* تفاصيل طلبات الصيانة وحالة الإصلاح.\r\n2. كيفية استخدام المعلومات\r\nنستخدم المعلومات للأغراض التالية:\r\n* استقبال طلبات الصيانة ومتابعتها.\r\n* التواصل مع العملاء بشأن طلباتهم.\r\n* تحديد نوع الجهاز والعطل وتقديم الخدمة المناسبة.\r\n* إدارة عمليات الصيانة وتحديث حالتها.\r\n* عرض أسعار الخدمات والعروض المتاحة.\r\n3. حماية البيانات\r\nنحرص على اتخاذ التدابير التقنية والتنظيمية المناسبة لحماية بيانات المستخدمين من الوصول غير المصرح به أو التعديل أو الإفصاح غير القانوني.\r\n4. تحديث سياسة الخصوصية\r\nقد نقوم بتحديث هذه السياسة عند الحاجة، وسيتم نشر النسخة المحدثة داخل التطبيق.\r\nصيانة جوالي – خصوصيتكم وثقتكم مسؤوليتنا.', 'مرحباً بكم في تطبيق «صيانة جوالي». يرجى قراءة الشروط والأحكام التالية بعناية قبل استخدام التطبيق. إن استخدام التطبيق يعني موافقتكم على هذه الشروط.\r\n1. الغرض من التطبيق\r\nيهدف التطبيق إلى تسهيل خدمات صيانة الهواتف المحمولة، وعرض عروض الصيانة وأسعار الشاشات وقطع الغيار، واستقبال طلبات العملاء ومتابعة عمليات الإصلاح.\r\n2. حساب المستخدم\r\n* يجب تقديم معلومات صحيحة عند التسجيل واستخدام التطبيق.\r\n* يتحمل المستخدم مسؤولية المحافظة على بيانات حسابه.\r\n* يمنع استخدام التطبيق لأي أغراض غير قانونية أو للإضرار بالخدمات.\r\n3. الأسعار والعروض\r\n* الأسعار المعروضة داخل التطبيق قابلة للتحديث.\r\n* قد تكون بعض العروض محددة بمدة زمنية أو كمية معينة.\r\n* يحق لإدارة المحل تحديث العروض والأسعار عند الحاجة.\r\n4. ضمان الصيانة وقطع الغيار\r\n* يتم تحديد مدة الضمان وشروطه بحسب نوع الخدمة وقطعة الغيار المستخدمة.\r\n* لا يشمل الضمان الأضرار الناتجة عن الكسر أو السوائل أو سوء الاستخدام أو التدخل الخارجي، إلا إذا نص اتفاق الضمان على خلاف ذلك.\r\n* يجب الرجوع إلى شروط الضمان المحددة في فاتورة الصيانة.\r\n5. الموافقة على الشروط\r\nباستخدام تطبيق «صيانة جوالي»، فإنك تقر بأنك قرأت هذه الشروط والأحكام ووافقت على الالتزام بها.\r\nشكراً لثقتكم بنا واختياركم صيانة جوالي.', 'صيانة جوالي هو تطبيق متخصص في تسهيل خدمات صيانة الهواتف المحمولة، وقد تم تطويره لتوفير وسيلة سهلة ومريحة للعملاء للتعرف على خدمات الصيانة والأسعار والعروض المتاحة والتواصل مع مركز الصيانة.\r\nخدماتنا\r\n* عرض خدمات صيانة الهواتف المحمولة.\r\n* استعراض عروض الشاشات وقطع الغيار وأسعارها.\r\n* البحث عن الأجهزة وتحديد نوع العطل.\r\n* تقديم طلب صيانة بسهولة عبر التطبيق.\r\n* إرسال صور الجهاز والمشكلة لتسهيل تشخيص العطل.\r\n* متابعة حالة طلب الصيانة ومراحل الإصلاح.\r\n* معرفة تفاصيل الأسعار والضمان.\r\n* الوصول إلى موقع مركز الصيانة عبر الخرائط.\r\nرؤيتنا\r\nنسعى إلى تطوير تجربة صيانة الهواتف المحمولة من خلال الاستفادة من التكنولوجيا، وتوفير خدمات سهلة وواضحة، والاهتمام بجودة الصيانة ورضا العملاء.\r\nهدفنا\r\nتوفير الوقت والجهد على العملاء، وتسهيل الوصول إلى خدمات الصيانة، وتقديم أسعار وعروض واضحة، وبناء علاقة قائمة على الثقة والشفافية.\r\nيسعدنا استقبال استفساراتكم وملاحظاتكم، ويمكنكم التواصل معنا عبر:\r\nالبريد الإلكتروني: Mamdkr10@gmail.com\r\nنشكركم على ثقتكم بنا.\r\nصيانة جوالي – صيانة أسهل، خدمة أفضل، وثقة تدوم.', '2026-04-11 09:18:33', '2026-11-06 18:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile` longtext DEFAULT 'default.jpg',
  `username` longtext DEFAULT NULL,
  `email` longtext DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `password` longtext DEFAULT NULL,
  `title` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `latitude` longtext DEFAULT NULL,
  `longitude` longtext DEFAULT NULL,
  `status` enum('pending','active') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `users_id`, `profile`, `username`, `email`, `phone_number`, `password`, `title`, `description`, `address`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'shopImages/1793778492_8D37CA6A-AE97-441D-AC5D-3F73C6B00066.png', 'SMART SHOP', 'mamdkr10@gmail.com', NULL, '$2y$12$iEiRd84fGdoKw9L5muuQ9.J5Tfk9r28M5.6b2N9/rI7gGxY/OlJEm', 'سمارت للخدمات موبايل', 'تبديل شاشات موبايل , تبديل قواعد الشحن , تبديل بطاريات موبايل', 'Defence Colony, New Delhi, Delhi, India', '28.5740467', '77.2308826', 'active', '2026-04-11 08:06:34', '2026-11-04 07:48:12'),
(2, NULL, 'shops/shop2.jpg', 'testingshop', 'testing@gmail.com', NULL, '$2y$12$fIjpobIwONoAdWiJ3dZEaOcKWEWgsH4lsB.Mqexs3/e.QrpUpZk2m', 'Clifton Phone Fixers', 'Expert in iPhone and Android repair services.', 'Clifton, Karachi', '24.8138', '67.0305', 'active', '2026-04-11 08:06:34', '2026-08-18 18:07:12'),
(3, NULL, 'shops/shop3.jpg', 'testingshop2', 'testing2@gmail.com', NULL, '$2y$12$fIjpobIwONoAdWiJ3dZEaOcKWEWgsH4lsB.Mqexs3/e.QrpUpZk2m', 'Gulshan Mobile Lab', 'Hardware repair, flashing, and unlocking services.', 'Gulshan-e-Iqbal, Karachi', '24.9056', '67.0822', 'active', '2026-04-11 08:06:34', '2026-04-11 08:06:34'),
(4, NULL, 'shops/shop4.jpg', 'testingshop3', 'testing3@gmail.com', NULL, '$2y$12$fIjpobIwONoAdWiJ3dZEaOcKWEWgsH4lsB.Mqexs3/e.QrpUpZk2m', 'Nazimabad Repair Hub', 'Affordable phone repair with quick turnaround time.', 'Nazimabad, Karachi', '24.9260', '67.0330', 'active', '2026-04-11 08:06:34', '2026-04-11 08:06:34'),
(5, NULL, 'shops/shop5.jpg', 'testingshop4', 'testing4@gmail.com', NULL, '$2y$12$fIjpobIwONoAdWiJ3dZEaOcKWEWgsH4lsB.Mqexs3/e.QrpUpZk2m', 'DHA Tech Repair', 'Premium repair service for all smartphone brands.', 'DHA, Karachi', '24.8000', '67.0500', 'active', '2026-04-11 08:06:34', '2026-04-11 08:06:34'),
(6, NULL, 'shops/shop6.jpg', 'testingshop5', 'testing5@gmail.com', NULL, '$2y$12$fIjpobIwONoAdWiJ3dZEaOcKWEWgsH4lsB.Mqexs3/e.QrpUpZk2m', 'Korangi Mobile Solutions', 'Charging port, speaker, and mic repair specialists.', 'Korangi, Karachi', '24.8300', '67.1200', 'active', '2026-04-11 08:06:34', '2026-04-11 08:06:34'),
(7, NULL, 'shops/shop7.jpg', 'testingshop6', 'testing6@gmail.com', NULL, '$2y$12$fIjpobIwONoAdWiJ3dZEaOcKWEWgsH4lsB.Mqexs3/e.QrpUpZk2m', 'Malir Phone Repair Shop', 'All kinds of smartphone repair at affordable prices.', 'Malir, Karachi', '24.8900', '67.1900', 'active', '2026-04-11 08:06:34', '2026-04-11 08:06:34'),
(8, NULL, 'shops/shop8.jpg', 'testingshop7', 'testing7@gmail.com', NULL, '$2y$12$fIjpobIwONoAdWiJ3dZEaOcKWEWgsH4lsB.Mqexs3/e.QrpUpZk2m', 'North Karachi Mobile Lab', 'Fast and reliable mobile repair services.', 'North Karachi, Karachi', '24.9500', '67.0700', 'active', '2026-04-11 08:06:34', '2026-04-11 08:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `shop_services`
--

CREATE TABLE `shop_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `services_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_services`
--

INSERT INTO `shop_services` (`id`, `services_id`, `shop_id`, `created_at`, `updated_at`) VALUES
(30, 30, 1, '2026-11-04 18:08:57', '2026-11-04 18:08:57'),
(31, 31, 1, '2026-11-04 18:14:23', '2026-11-04 18:14:23'),
(32, 32, 1, '2026-11-04 18:19:13', '2026-11-04 18:19:13'),
(33, 33, 1, '2026-11-04 18:22:32', '2026-11-04 18:22:32'),
(34, 34, 1, '2026-11-04 18:23:37', '2026-11-04 18:23:37'),
(35, 35, 1, '2026-11-04 18:25:01', '2026-11-04 18:25:01'),
(36, 36, 1, '2026-11-04 18:32:16', '2026-11-04 18:32:16'),
(37, 37, 1, '2026-11-04 18:34:39', '2026-11-04 18:34:39'),
(38, 38, 1, '2026-11-04 18:35:42', '2026-11-04 18:35:42'),
(39, 39, 1, '2026-11-04 18:37:25', '2026-11-04 18:37:25'),
(40, 40, 1, '2026-11-04 18:39:11', '2026-11-04 18:39:11'),
(41, 41, 1, '2026-11-04 18:40:49', '2026-11-04 18:40:49'),
(42, 42, 1, '2026-11-05 16:37:28', '2026-11-05 16:37:28'),
(43, 43, 1, '2026-11-05 16:39:24', '2026-11-05 16:39:24'),
(44, 44, 1, '2026-11-05 16:40:44', '2026-11-05 16:40:44'),
(45, 45, 1, '2026-11-05 16:45:48', '2026-11-05 16:45:48'),
(46, 46, 1, '2026-11-05 16:46:54', '2026-11-05 16:46:54'),
(47, 47, 1, '2026-11-05 16:47:48', '2026-11-05 16:47:48'),
(48, 48, 1, '2026-11-05 16:50:01', '2026-11-05 16:50:01'),
(49, 49, 1, '2026-11-05 16:58:27', '2026-11-05 16:58:27'),
(50, 50, 1, '2026-11-05 16:59:36', '2026-11-05 16:59:36'),
(51, 51, 1, '2026-11-05 17:00:35', '2026-11-05 17:00:35'),
(52, 52, 1, '2026-11-05 17:01:54', '2026-11-05 17:01:54'),
(53, 53, 1, '2026-11-05 17:05:24', '2026-11-05 17:05:24'),
(54, 54, 1, '2026-11-05 17:06:45', '2026-11-05 17:06:45'),
(55, 55, 1, '2026-11-05 17:08:49', '2026-11-05 17:08:49'),
(56, 56, 1, '2026-11-05 17:09:40', '2026-11-05 17:09:40'),
(57, 57, 1, '2026-11-05 17:10:48', '2026-11-05 17:10:48'),
(58, 58, 1, '2026-11-05 17:12:00', '2026-11-05 17:12:00'),
(59, 59, 1, '2026-11-05 17:14:01', '2026-11-05 17:14:01'),
(60, 60, 1, '2026-11-05 18:14:00', '2026-11-05 18:14:00'),
(61, 61, 1, '2026-11-05 18:15:11', '2026-11-05 18:15:11'),
(62, 62, 1, '2026-11-05 18:16:16', '2026-11-05 18:16:16'),
(63, 63, 1, '2026-11-05 18:17:43', '2026-11-05 18:17:43'),
(64, 64, 1, '2026-11-05 18:22:49', '2026-11-05 18:22:49'),
(65, 65, 1, '2026-11-05 18:25:37', '2026-11-05 18:25:37'),
(66, 66, 1, '2026-11-05 18:26:30', '2026-11-05 18:26:30'),
(67, 67, 1, '2026-11-05 18:28:02', '2026-11-05 18:28:02'),
(68, 68, 1, '2026-11-05 18:29:03', '2026-11-05 18:29:03'),
(69, 69, 1, '2026-11-05 18:29:48', '2026-11-05 18:29:48'),
(70, 70, 1, '2026-11-05 18:31:14', '2026-11-05 18:31:14'),
(71, 71, 1, '2026-11-05 18:32:30', '2026-11-05 18:32:30'),
(72, 72, 1, '2026-11-05 18:33:54', '2026-11-05 18:33:54'),
(73, 73, 1, '2026-11-05 18:35:04', '2026-11-05 18:35:04'),
(74, 74, 1, '2026-11-05 18:36:09', '2026-11-05 18:36:09'),
(75, 75, 1, '2026-11-05 18:38:09', '2026-11-05 18:38:09'),
(76, 76, 1, '2026-11-05 18:39:23', '2026-11-05 18:39:23'),
(77, 77, 1, '2026-11-05 18:40:58', '2026-11-05 18:40:58'),
(78, 78, 1, '2026-11-05 18:42:18', '2026-11-05 18:42:18'),
(79, 79, 1, '2026-11-05 18:43:41', '2026-11-05 18:43:41'),
(80, 80, 1, '2026-11-05 18:44:38', '2026-11-05 18:44:38'),
(81, 81, 1, '2026-11-06 07:33:56', '2026-11-06 07:33:56'),
(82, 82, 1, '2026-11-06 07:35:40', '2026-11-06 07:35:40'),
(83, 83, 1, '2026-11-06 07:36:35', '2026-11-06 07:36:35'),
(84, 84, 1, '2026-11-06 07:38:12', '2026-11-06 07:38:12'),
(85, 85, 1, '2026-11-06 07:40:50', '2026-11-06 07:40:50'),
(86, 86, 1, '2026-11-06 07:51:35', '2026-11-06 07:51:35'),
(87, 87, 1, '2026-11-06 07:52:59', '2026-11-06 07:52:59'),
(88, 88, 1, '2026-11-06 07:54:12', '2026-11-06 07:54:12'),
(89, 89, 1, '2026-11-06 07:57:14', '2026-11-06 07:57:14'),
(90, 90, 1, '2026-11-06 07:58:57', '2026-11-06 07:58:57'),
(91, 91, 1, '2026-11-06 08:00:28', '2026-11-06 08:00:28'),
(92, 92, 1, '2026-11-06 08:20:57', '2026-11-06 08:20:57'),
(93, 93, 1, '2026-11-06 08:22:16', '2026-11-06 08:22:16'),
(94, 94, 1, '2026-11-06 08:23:32', '2026-11-06 08:23:32'),
(95, 95, 1, '2026-11-06 08:24:31', '2026-11-06 08:24:31'),
(96, 96, 1, '2026-11-06 08:25:40', '2026-11-06 08:25:40'),
(97, 97, 1, '2026-11-06 08:26:43', '2026-11-06 08:26:43'),
(98, 98, 1, '2026-11-06 08:27:46', '2026-11-06 08:27:46'),
(99, 99, 1, '2026-11-06 08:28:45', '2026-11-06 08:28:45'),
(100, 100, 1, '2026-11-07 08:45:52', '2026-11-07 08:45:52'),
(101, 101, 1, '2026-11-07 08:47:03', '2026-11-07 08:47:03'),
(102, 102, 1, '2026-11-07 08:47:58', '2026-11-07 08:47:58'),
(103, 103, 1, '2026-11-07 08:49:49', '2026-11-07 08:49:49'),
(104, 104, 1, '2026-11-07 08:51:53', '2026-11-07 08:51:53'),
(105, 105, 1, '2026-11-07 08:55:40', '2026-11-07 08:55:40'),
(106, 106, 1, '2026-11-07 08:57:04', '2026-11-07 08:57:04'),
(107, 107, 1, '2026-11-07 08:58:26', '2026-11-07 08:58:26'),
(108, 108, 1, '2026-11-07 09:00:53', '2026-11-07 09:00:53'),
(109, 109, 1, '2026-11-07 09:04:26', '2026-11-07 09:04:26'),
(110, 110, 1, '2026-11-07 09:05:44', '2026-11-07 09:05:44'),
(111, 111, 1, '2026-11-07 12:18:57', '2026-11-07 12:18:57'),
(112, 112, 1, '2026-11-07 12:20:50', '2026-11-07 12:20:50'),
(113, 113, 1, '2026-11-07 12:22:18', '2026-11-07 12:22:18'),
(114, 114, 1, '2026-11-07 12:23:51', '2026-11-07 12:23:51'),
(115, 115, 1, '2026-11-07 12:25:10', '2026-11-07 12:25:10'),
(116, 116, 1, '2026-11-07 12:28:01', '2026-11-07 12:28:01'),
(117, 117, 1, '2026-11-07 12:29:08', '2026-11-07 12:29:08'),
(118, 118, 1, '2026-11-07 12:30:24', '2026-11-07 12:30:24'),
(119, 119, 1, '2026-11-07 12:32:00', '2026-11-07 12:32:00'),
(120, 120, 1, '2026-11-07 12:33:21', '2026-11-07 12:33:21'),
(121, 121, 1, '2026-11-07 12:34:49', '2026-11-07 12:34:49'),
(122, 122, 1, '2026-11-07 12:36:13', '2026-11-07 12:36:13'),
(123, 123, 1, '2026-11-07 12:38:47', '2026-11-07 12:38:47'),
(124, 124, 1, '2026-11-07 12:40:11', '2026-11-07 12:40:11'),
(125, 125, 1, '2026-11-07 12:42:00', '2026-11-07 12:42:00'),
(126, 126, 1, '2026-11-07 12:51:00', '2026-11-07 12:51:00'),
(127, 127, 1, '2026-11-07 12:52:07', '2026-11-07 12:52:07'),
(128, 128, 1, '2026-11-07 12:53:02', '2026-11-07 12:53:02'),
(129, 129, 1, '2026-11-07 12:54:49', '2026-11-07 12:54:49'),
(130, 130, 1, '2026-11-07 12:56:47', '2026-11-07 12:56:47'),
(131, 131, 1, '2026-11-07 12:58:41', '2026-11-07 12:58:41'),
(132, 132, 1, '2026-11-07 13:00:12', '2026-11-07 13:00:12'),
(133, 133, 1, '2026-11-07 13:08:53', '2026-11-07 13:08:53'),
(134, 134, 1, '2026-11-07 13:57:06', '2026-11-07 13:57:06'),
(135, 135, 1, '2026-11-07 13:58:55', '2026-11-07 13:58:55'),
(136, 136, 1, '2026-11-07 14:00:23', '2026-11-07 14:00:23'),
(137, 137, 1, '2026-11-07 14:01:26', '2026-11-07 14:01:26'),
(138, 138, 1, '2026-11-07 14:03:49', '2026-11-07 14:03:49'),
(139, 139, 1, '2026-11-07 14:05:41', '2026-11-07 14:05:41'),
(140, 140, 1, '2026-11-07 14:07:48', '2026-11-07 14:07:48'),
(141, 141, 1, '2026-11-07 14:11:14', '2026-11-07 14:11:14'),
(142, 142, 1, '2026-11-07 14:14:55', '2026-11-07 14:14:55'),
(143, 143, 1, '2026-11-07 14:16:38', '2026-11-07 14:16:38'),
(144, 144, 1, '2026-11-07 14:18:07', '2026-11-07 14:18:07'),
(145, 145, 1, '2026-11-07 14:21:18', '2026-11-07 14:21:18'),
(146, 146, 1, '2026-11-07 14:24:16', '2026-11-07 14:24:16'),
(147, 147, 1, '2026-11-07 15:47:54', '2026-11-07 15:47:54'),
(148, 148, 1, '2026-11-07 15:49:12', '2026-11-07 15:49:12'),
(149, 149, 1, '2026-11-07 15:50:38', '2026-11-07 15:50:38'),
(150, 150, 1, '2026-11-07 15:58:32', '2026-11-07 15:58:32'),
(151, 151, 1, '2026-11-07 16:00:56', '2026-11-07 16:00:56'),
(152, 152, 1, '2026-11-07 16:02:36', '2026-11-07 16:02:36'),
(153, 153, 1, '2026-11-07 16:03:53', '2026-11-07 16:03:53'),
(154, 154, 1, '2026-11-07 16:11:58', '2026-11-07 16:11:58'),
(155, 155, 1, '2026-11-07 16:22:04', '2026-11-07 16:22:04'),
(156, 156, 1, '2026-11-07 16:23:00', '2026-11-07 16:23:00'),
(157, 157, 1, '2026-11-07 16:39:35', '2026-11-07 16:39:35'),
(158, 158, 1, '2026-11-07 16:40:42', '2026-11-07 16:40:42'),
(159, 159, 1, '2026-11-07 16:41:53', '2026-11-07 16:41:53'),
(160, 160, 1, '2026-11-07 16:43:13', '2026-11-07 16:43:13'),
(161, 161, 1, '2026-11-07 16:45:08', '2026-11-07 16:45:08'),
(162, 162, 1, '2026-11-07 17:15:13', '2026-11-07 17:15:13'),
(163, 163, 1, '2026-11-07 17:17:00', '2026-11-07 17:17:00'),
(164, 164, 1, '2026-11-07 17:17:59', '2026-11-07 17:17:59'),
(165, 165, 1, '2026-11-07 17:19:14', '2026-11-07 17:19:14'),
(166, 166, 1, '2026-11-08 16:41:14', '2026-11-08 16:41:14'),
(167, 167, 1, '2026-11-08 16:42:15', '2026-11-08 16:42:15'),
(168, 168, 1, '2026-11-08 16:43:45', '2026-11-08 16:43:45'),
(169, 169, 1, '2026-11-08 16:45:06', '2026-11-08 16:45:06'),
(170, 170, 1, '2026-11-08 16:46:17', '2026-11-08 16:46:17'),
(171, 171, 1, '2026-11-08 16:47:30', '2026-11-08 16:47:30'),
(172, 172, 1, '2026-11-08 16:49:05', '2026-11-08 16:49:05'),
(173, 173, 1, '2026-11-08 16:51:17', '2026-11-08 16:51:17'),
(174, 174, 1, '2026-11-08 16:53:03', '2026-11-08 16:53:03'),
(175, 175, 1, '2026-11-08 16:54:44', '2026-11-08 16:54:44'),
(176, 176, 1, '2026-11-08 16:55:55', '2026-11-08 16:55:55'),
(177, 177, 1, '2026-11-08 16:57:16', '2026-11-08 16:57:16'),
(178, 178, 1, '2026-11-08 16:58:44', '2026-11-08 16:58:44'),
(179, 179, 1, '2026-11-08 17:00:34', '2026-11-08 17:00:34'),
(180, 180, 1, '2026-11-08 17:11:51', '2026-11-08 17:11:51'),
(181, 181, 1, '2026-11-08 17:13:01', '2026-11-08 17:13:01'),
(182, 182, 1, '2026-11-08 17:14:06', '2026-11-08 17:14:06'),
(183, 183, 1, '2026-11-08 17:15:45', '2026-11-08 17:15:45'),
(184, 184, 1, '2026-11-08 17:17:39', '2026-11-08 17:17:39'),
(185, 185, 1, '2026-11-08 17:48:55', '2026-11-08 17:48:55'),
(186, 186, 1, '2026-11-08 17:49:51', '2026-11-08 17:49:51'),
(187, 187, 1, '2026-11-08 17:50:52', '2026-11-08 17:50:52'),
(188, 188, 1, '2026-11-08 17:52:20', '2026-11-08 17:52:20'),
(189, 189, 1, '2026-11-08 17:53:45', '2026-11-08 17:53:45'),
(190, 190, 1, '2026-11-08 17:54:43', '2026-11-08 17:54:43'),
(191, 191, 1, '2026-11-08 17:55:42', '2026-11-08 17:55:42'),
(192, 192, 1, '2026-11-08 17:56:31', '2026-11-08 17:56:31'),
(193, 193, 1, '2026-11-08 17:57:22', '2026-11-08 17:57:22'),
(194, 194, 1, '2026-11-08 17:58:35', '2026-11-08 17:58:35'),
(195, 195, 1, '2026-11-08 17:59:55', '2026-11-08 17:59:55'),
(196, 196, 1, '2026-11-08 18:01:32', '2026-11-08 18:01:32'),
(197, 197, 1, '2026-11-08 18:02:27', '2026-11-08 18:02:27'),
(198, 198, 1, '2026-11-08 18:03:16', '2026-11-08 18:03:16'),
(199, 199, 1, '2026-11-08 18:04:13', '2026-11-08 18:04:13'),
(200, 200, 1, '2026-11-08 18:05:41', '2026-11-08 18:05:41'),
(201, 201, 1, '2026-11-08 18:06:29', '2026-11-08 18:06:29'),
(202, 202, 1, '2026-11-08 18:07:50', '2026-11-08 18:07:50'),
(203, 203, 1, '2026-11-08 18:08:47', '2026-11-08 18:08:47'),
(204, 204, 1, '2026-11-08 18:09:41', '2026-11-08 18:09:41'),
(205, 205, 1, '2026-11-08 18:10:38', '2026-11-08 18:10:38'),
(206, 206, 1, '2026-11-08 18:13:38', '2026-11-08 18:13:38'),
(207, 207, 1, '2026-11-08 18:15:42', '2026-11-08 18:15:42'),
(208, 208, 1, '2026-11-08 18:16:50', '2026-11-08 18:16:50'),
(209, 209, 1, '2026-11-08 18:23:20', '2026-11-08 18:23:20'),
(210, 210, 1, '2026-11-09 08:24:53', '2026-11-09 08:24:53'),
(211, 211, 1, '2026-11-09 08:27:11', '2026-11-09 08:27:11'),
(212, 212, 1, '2026-11-09 08:28:36', '2026-11-09 08:28:36'),
(213, 213, 1, '2026-11-09 08:29:47', '2026-11-09 08:29:47'),
(214, 214, 1, '2026-11-09 08:30:57', '2026-11-09 08:30:57'),
(215, 215, 1, '2026-11-09 08:31:54', '2026-11-09 08:31:54'),
(216, 216, 1, '2026-11-09 08:33:39', '2026-11-09 08:33:39'),
(217, 217, 1, '2026-11-09 08:34:57', '2026-11-09 08:34:57'),
(218, 218, 1, '2026-11-09 08:36:04', '2026-11-09 08:36:04'),
(219, 219, 1, '2026-11-09 08:36:50', '2026-11-09 08:36:50'),
(220, 220, 1, '2026-11-09 08:37:44', '2026-11-09 08:37:44'),
(221, 221, 1, '2026-11-09 14:27:32', '2026-11-09 14:27:32'),
(222, 222, 1, '2026-11-09 14:28:26', '2026-11-09 14:28:26'),
(223, 223, 1, '2026-11-09 14:30:11', '2026-11-09 14:30:11'),
(224, 224, 1, '2026-11-09 14:31:12', '2026-11-09 14:31:12'),
(225, 225, 1, '2026-11-09 14:31:59', '2026-11-09 14:31:59'),
(226, 226, 1, '2026-11-09 14:33:02', '2026-11-09 14:33:02'),
(227, 227, 1, '2026-11-09 14:34:09', '2026-11-09 14:34:09'),
(228, 228, 1, '2026-11-09 14:34:59', '2026-11-09 14:34:59'),
(229, 229, 1, '2026-11-09 14:36:14', '2026-11-09 14:36:14'),
(230, 230, 1, '2026-11-09 14:37:14', '2026-11-09 14:37:14'),
(231, 231, 1, '2026-11-09 14:38:19', '2026-11-09 14:38:19'),
(232, 232, 1, '2026-11-09 14:39:26', '2026-11-09 14:39:26'),
(233, 233, 1, '2026-11-09 14:40:24', '2026-11-09 14:40:24'),
(234, 234, 1, '2026-11-09 14:41:24', '2026-11-09 14:41:24'),
(235, 235, 1, '2026-11-09 14:43:16', '2026-11-09 14:43:16'),
(236, 236, 1, '2026-11-09 14:44:23', '2026-11-09 14:44:23'),
(237, 237, 1, '2026-11-09 14:45:12', '2026-11-09 14:45:12'),
(238, 238, 1, '2026-11-09 17:06:56', '2026-11-09 17:06:56'),
(239, 239, 1, '2026-11-09 17:08:40', '2026-11-09 17:08:40'),
(240, 240, 1, '2026-11-09 17:09:54', '2026-11-09 17:09:54'),
(241, 241, 1, '2026-11-09 17:10:59', '2026-11-09 17:10:59'),
(242, 242, 1, '2026-11-09 17:11:58', '2026-11-09 17:11:58'),
(243, 243, 1, '2026-11-09 17:14:48', '2026-11-09 17:14:48'),
(244, 244, 1, '2026-11-09 17:16:24', '2026-11-09 17:16:24'),
(245, 245, 1, '2026-11-09 17:17:29', '2026-11-09 17:17:29'),
(246, 246, 1, '2026-11-09 17:57:54', '2026-11-09 17:57:54'),
(247, 247, 1, '2026-11-09 17:59:13', '2026-11-09 17:59:13'),
(248, 248, 1, '2026-11-09 17:59:56', '2026-11-09 17:59:56'),
(249, 249, 1, '2026-11-09 18:00:44', '2026-11-09 18:00:44'),
(250, 250, 1, '2026-11-09 18:01:42', '2026-11-09 18:01:42'),
(251, 251, 1, '2026-11-09 18:02:58', '2026-11-09 18:02:58'),
(252, 252, 1, '2026-11-09 18:04:02', '2026-11-09 18:04:02'),
(253, 253, 1, '2026-11-09 18:05:28', '2026-11-09 18:05:28'),
(254, 254, 1, '2026-11-09 18:06:15', '2026-11-09 18:06:15'),
(255, 255, 1, '2026-11-13 08:08:28', '2026-11-13 08:08:28'),
(256, 256, 1, '2026-11-13 08:09:36', '2026-11-13 08:09:36'),
(257, 257, 1, '2026-11-13 08:12:07', '2026-11-13 08:12:07'),
(258, 258, 1, '2026-11-13 08:15:15', '2026-11-13 08:15:15'),
(259, 259, 1, '2026-11-13 08:16:15', '2026-11-13 08:16:15'),
(260, 260, 1, '2026-11-13 08:17:02', '2026-11-13 08:17:02'),
(261, 261, 1, '2026-11-13 08:20:52', '2026-11-13 08:20:52'),
(262, 262, 1, '2026-11-13 08:22:50', '2026-11-13 08:22:50'),
(263, 263, 1, '2026-11-13 08:24:32', '2026-11-13 08:24:32'),
(264, 264, 1, '2026-11-13 08:25:42', '2026-11-13 08:25:42'),
(265, 265, 1, '2026-11-13 08:27:52', '2026-11-13 08:27:52'),
(266, 266, 1, '2026-11-13 08:29:07', '2026-11-13 08:29:07'),
(267, 267, 1, '2026-11-13 08:30:14', '2026-11-13 08:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` longtext NOT NULL,
  `email` longtext DEFAULT NULL,
  `phone_number` longtext DEFAULT NULL,
  `password` longtext DEFAULT NULL,
  `profile_picture` longtext NOT NULL DEFAULT 'default.jpg',
  `otp_code` longtext DEFAULT NULL,
  `registration_type` longtext DEFAULT NULL,
  `status` longtext NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`id`, `full_name`, `email`, `phone_number`, `password`, `profile_picture`, `otp_code`, `registration_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Syed Haseeb Ahmed', 'technician@gmail.com', '123456789', '$2y$12$ODPAWzoOKBMfyFf9fqxP1uhN3rFilJ4GxlVk3Q4XdGyBFjRNEydM6', '177608824469dcf4b4d5fec.jpg', NULL, 'email', 'pending', '2026-04-13 13:43:16', '2026-04-15 21:02:32'),
(6, 'SMART SHOP', 'mamdkr10@gmail.com', '07703746006', '$2y$12$/RktpfWKEWGtGrwnSyN/XuXzk.CG.v2cBOrdaC1.7sDwTN1ic8uUK', '17937798526aeae88c20fe1.png', NULL, 'email', 'pending', '2026-11-04 08:10:15', '2026-11-04 08:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` longtext NOT NULL,
  `email` longtext DEFAULT NULL,
  `phone_number` longtext DEFAULT NULL,
  `password` longtext DEFAULT NULL,
  `profile_picture` longtext NOT NULL DEFAULT 'default.jpg',
  `otp_code` longtext DEFAULT NULL,
  `registration_type` longtext NOT NULL,
  `status` longtext NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone_number`, `password`, `profile_picture`, `otp_code`, `registration_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Ali', 'weblinxwork@gmail.com', 'null', '$2y$12$Uzgrw6jiilUcJs9Dezi9ruYchnddA0AOi9iQiOz9qKEH8Ntj1u43S', 'default.jpg', '150428', 'email', 'active', '2026-04-11 08:51:45', '2026-04-15 15:43:20'),
(2, 'John Doe', 'john@yopmail.com', 'null', '$2y$12$QL.h1o3GSmy4Xkr7pXS70.lx0ianNgVrhCQn8GokwXUOKVsx1QD6C', 'default.jpg', '146823', 'email', 'active', '2026-04-13 07:38:37', '2026-11-16 13:19:44'),
(3, 'Steve Smith', 'steve@yopmail.com', 'null', '$2y$12$QY.9GDEmHJ0bcxAY81M6Y.6TrSesf7iaYYswlq9jrmIhYmAG9sdFS', 'default.jpg', '946707', 'email', 'active', '2026-04-13 07:44:11', '2026-04-13 08:51:36'),
(4, 'Steve Smith2', 'stevesmith2@yopmail.com', '+923001234567', '$2y$12$6GN3Ngv9T/WYkowzJV1eieMbjR/dy/yveLSLyPZkk7VfCPPKpFqmm', 'default.jpg', '373531', 'email', 'pending', '2026-04-13 07:59:46', '2026-05-11 19:04:47'),
(5, 'demo2', 'demo2@yopmail.com', '+133916766', '$2y$12$pE0ZMFTX12e55OTDmbmz/.fGOfCryf5HuzY/jTX3uYMgmNe4WoDu6', 'default.jpg', '310349', 'email', 'active', '2026-04-15 13:10:32', '2026-04-15 13:11:26'),
(6, 'test 1', 'test1@yopmail.com', '+1331605368189', '$2y$12$5Z5utZMpx0HI.W3l/6wR6eVRQZC8E9WyxEjmpm23QlcwsBi0jZIFG', 'default.jpg', '938540', 'email', 'active', '2026-04-16 19:00:45', '2026-04-16 19:06:44'),
(7, 'Steve Smith', 'workingmen@gmail.com', '+923001234567', '$2y$12$CAobLubfCUEdE8zwtz8wn.rM3/0tzMe1dbUTKX8oGO.0dLkABXhPy', 'default.jpg', '125928', 'social', 'active', '2026-04-18 09:12:26', '2026-04-18 09:12:26'),
(9, 'mamd', 'mamdkr@gmail.com', '+9647703746006', '$2y$12$dLKk1DSauKWb8WLA/txzBeCHNrUUqfqgfH9gKiwEYx0OFSFoBxJiO', 'default.jpg', '294869', 'email', 'active', '2026-05-10 22:27:39', '2026-07-30 19:18:48'),
(10, 'Jimmy', 'jimmy@yopmail.com', '+1123456789', '$2y$12$v.vvTNG8oudaaKGCvwHLieX3O3mwlCIyEGUYfdqDAKCcnuT67g2uC', 'default.jpg', '014880', 'email', 'active', '2026-05-11 16:12:19', '2026-05-11 16:15:11'),
(11, 'testing20', 'testing20@yopmail.com', '+923001234567', '$2y$12$NOes4XtV6E3EgCHIO/9Lc.zDKHZHGtl3.mL/UyTv7kEgvuD04IwD.', 'default.jpg', '179757', 'social', 'active', '2026-05-11 19:04:19', '2026-05-11 19:04:19'),
(12, 'johm', 'johm@yopmail.com', '+1123456789', '$2y$12$xsOBzhBGYA0xnwl27Phphejhv4k0TjCdNroIELJYWuKT81WxY4EAi', 'default.jpg', '974243', 'email', 'pending', '2026-05-11 19:21:18', '2026-05-11 19:21:18'),
(16, 'Steve Smith2', 'stevesmith20@yopmail.com', '+923001234567', '$2y$12$gDS24PdmXD9B8VHKFpiYUOw7KfuDjAhfMGkvjuuCAWCGDxdfj7v4S', 'default.jpg', '956612', 'email', 'pending', '2026-09-09 15:50:22', '2026-09-09 15:50:22'),
(17, 'Syed Munaf Ahmed', 'munafahmed389@gmail.com', NULL, '$2y$12$rqeFka.9xf1lU.yrP9vXDeRsOqt4V/ZSKnxcRuz729DUOaDTe2Kg2', 'default.jpg', '317312', 'social', 'active', '2026-09-14 18:29:43', '2026-09-14 18:29:43'),
(18, 'John Doe', 'john.doe@example.com', '+11234567890', '$2y$12$GyBN4hOKbWMHjtLO12tLnOb2Bb5NNDGMgfq.9eD0F1I0ErNoUVClm', 'default.jpg', '728684', 'email', 'pending', '2026-09-14 19:32:01', '2026-09-14 19:32:01'),
(19, 'aamir anwar', 'aamiranwar33@gmail.com', NULL, '$2y$12$Lfbf/Ylaq4oDF/fmIOd0uedk5F97yaXK04mB6IWUYMoaewFbmvm/m', 'default.jpg', '907587', 'social', 'active', '2026-09-15 12:09:53', '2026-09-15 12:09:53'),
(20, 'Syed Haseeb', 'syedhaseeb20055@gmail.com', NULL, '$2y$12$qORn7CxkfMFx1eT3Uh9Fcu.KaSUySJnL48PYL8ErGea0dn0xWmYyu', 'default.jpg', '395821', 'social', 'active', '2026-09-15 15:26:47', '2026-09-15 15:26:47'),
(21, 'Rk Simulation', 'rohaibchouhan@gmail.com', NULL, '$2y$12$vBYFAGYc/aG4Bj9rc0x4meNOSyGO4vnsoIcEq4JHMcJhq2sj/MB4C', 'default.jpg', '523296', 'social', 'active', '2026-09-15 15:27:46', '2026-09-15 15:27:46'),
(22, 'syed haseeb', 'haseebsyed444@gmail.com', NULL, '$2y$12$bXBxGZUeQAszHMKVio3dvuh//ZQX.I1DiFkXJ6b.cmVugCwwwhA8.', 'default.jpg', '533010', 'social', 'active', '2026-09-17 17:30:03', '2026-09-17 17:30:03'),
(24, 'Mamd M', 'mamdkr2@gmail.com', NULL, '$2y$12$41RcO/6YGUrUq016T1lx..lgLCJM9J3jDYlug9.HB/RcwZW79caN.', 'default.jpg', '216137', 'social', 'active', '2026-09-30 17:02:37', '2026-09-30 17:02:37'),
(25, 'ahmed ali', 'mamdkr6@gmail.com', NULL, '$2y$12$5NtLGAmXf3dxTxb1RKZXL.5O9UZq7lublpAT0WBoIE2zayG3dPwpm', 'default.jpg', '273477', 'social', 'active', '2026-09-30 17:39:04', '2026-09-30 17:39:04'),
(26, 'Mamd Kr', 'mamdkr46@gmail.com', NULL, '$2y$12$kxry2LVN3voJUiXC.qVI7e/lkDaNxMQzQIu3NF13u0GshS2hb/./a', 'default.jpg', '867284', 'social', 'active', '2026-10-05 09:36:24', '2026-10-05 09:36:24'),
(27, 'mamd 2009', 'mamdkr3@gmail.com', NULL, '$2y$12$/JpGo9soDbGMSTvscdBzuex4D1rA3xX3uiI3NaE/0xOcrCTtVEqEm', 'default.jpg', '116163', 'social', 'active', '2026-10-18 09:08:30', '2026-10-18 09:08:30'),
(28, 'Tariq Ahmad', 'tarqalsharq@gmail.com', NULL, '$2y$12$8kySIbBuKMvkgEJomSNB9upXoiqcFgnXzuHxNKx3/SvzE6Vci7tny', 'default.jpg', '959668', 'social', 'active', '2026-10-23 19:16:22', '2026-10-23 19:16:22'),
(29, 'محمد ملاك', 'm1amohammed1am@gmail.com', NULL, '$2y$12$8s88DFXUGMQ54Ha4BNkGnOAnkK2jUGH7ysWY3gk8/SpFYBgRcjRVK', 'default.jpg', '167649', 'social', 'active', '2026-11-04 16:31:41', '2026-11-04 16:31:41'),
(30, 'حسن البياتي', 'hggggg555h@gmail.com', NULL, '$2y$12$Ye9DBWN5PugUAfgJbF/th.VI24G1EhgGzNyh9RW5pFdDQxtpo4QSq', 'default.jpg', '058259', 'social', 'active', '2026-11-06 13:53:33', '2026-11-06 13:53:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `backup_logs`
--
ALTER TABLE `backup_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backup_settings`
--
ALTER TABLE `backup_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`),
  ADD KEY `jobs_service_id_foreign` (`service_id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_applications_user_id_foreign` (`user_id`),
  ADD KEY `job_applications_shop_id_foreign` (`shop_id`),
  ADD KEY `job_applications_job_id_foreign` (`job_id`),
  ADD KEY `job_applications_technician_id_foreign` (`technician_id`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_listings`
--
ALTER TABLE `job_listings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_listings_user_id_foreign` (`user_id`),
  ADD KEY `job_listings_service_id_foreign` (`service_id`);

--
-- Indexes for table `job_listing_metas`
--
ALTER TABLE `job_listing_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_listing_metas_job_listing_id_foreign` (`job_listing_id`);

--
-- Indexes for table `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `management_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `price_histories`
--
ALTER TABLE `price_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_histories_job_application_id_foreign` (`job_application_id`),
  ADD KEY `price_histories_changed_by_foreign` (`changed_by`);

--
-- Indexes for table `receipt_records`
--
ALTER TABLE `receipt_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipt_records_job_application_id_foreign` (`job_application_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_metas`
--
ALTER TABLE `service_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_metas_services_id_foreign` (`services_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shops_users_id_foreign` (`users_id`);

--
-- Indexes for table `shop_services`
--
ALTER TABLE `shop_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_services_services_id_foreign` (`services_id`),
  ADD KEY `shop_services_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `backup_logs`
--
ALTER TABLE `backup_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3129;

--
-- AUTO_INCREMENT for table `backup_settings`
--
ALTER TABLE `backup_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `job_listings`
--
ALTER TABLE `job_listings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `job_listing_metas`
--
ALTER TABLE `job_listing_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `management`
--
ALTER TABLE `management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2560;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_histories`
--
ALTER TABLE `price_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt_records`
--
ALTER TABLE `receipt_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT for table `service_metas`
--
ALTER TABLE `service_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1528;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shop_services`
--
ALTER TABLE `shop_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_listings`
--
ALTER TABLE `job_listings`
  ADD CONSTRAINT `job_listings_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_listings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `price_histories`
--
ALTER TABLE `price_histories`
  ADD CONSTRAINT `price_histories_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `shops` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `price_histories_job_application_id_foreign` FOREIGN KEY (`job_application_id`) REFERENCES `job_applications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `receipt_records`
--
ALTER TABLE `receipt_records`
  ADD CONSTRAINT `receipt_records_job_application_id_foreign` FOREIGN KEY (`job_application_id`) REFERENCES `job_applications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_metas`
--
ALTER TABLE `service_metas`
  ADD CONSTRAINT `service_metas_services_id_foreign` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shop_services`
--
ALTER TABLE `shop_services`
  ADD CONSTRAINT `shop_services_services_id_foreign` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shop_services_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
