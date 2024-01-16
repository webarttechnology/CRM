-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2024 at 10:53 AM
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
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assign_logs`
--

CREATE TABLE `assign_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` varchar(255) NOT NULL,
  `changes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`changes`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `chat_message` longtext NOT NULL,
  `message_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `from_user_id`, `to_user_id`, `group_id`, `chat_message`, `message_status`, `created_at`, `updated_at`) VALUES
(1, 8, 15, NULL, 'hi', 'Read', '2024-01-16 03:51:45', '2024-01-16 03:52:04'),
(2, 15, 8, NULL, 'hello', 'Read', '2024-01-16 03:52:12', '2024-01-16 03:52:20'),
(3, 8, 15, NULL, 'jhjh', 'Read', '2024-01-16 03:52:57', '2024-01-16 03:56:17'),
(4, 8, 15, NULL, 'kjkjh', 'Read', '2024-01-16 03:56:32', '2024-01-16 03:57:13'),
(5, 8, 15, NULL, 'jkjhjh', 'Read', '2024-01-16 03:57:20', '2024-01-16 04:00:27'),
(6, 8, 15, NULL, 'jhjjh', 'Read', '2024-01-16 04:00:36', '2024-01-16 04:04:52'),
(7, 8, 15, NULL, 'jhjhk', 'Read', '2024-01-16 04:05:00', '2024-01-16 04:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) UNSIGNED NOT NULL,
  `client_code` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `current_website` varchar(255) DEFAULT NULL,
  `agent_name` varchar(250) NOT NULL,
  `closer_name` varchar(250) NOT NULL,
  `remarks` text DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_code`, `name`, `email`, `country_name`, `address`, `current_website`, `agent_name`, `closer_name`, `remarks`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 485711, 'Devid', 'devid@gmail.com', 'USA', 'US', 'https://www.kovevew.us', 'Devid', 'Devid', 'Devid', NULL, '2024-01-15 07:08:52', '2024-01-15 07:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `closers`
--

CREATE TABLE `closers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `currency` int(11) NOT NULL,
  `instalment` int(11) NOT NULL,
  `net_amount` double(8,2) NOT NULL,
  `sale_date` date NOT NULL,
  `payment_mode` int(11) NOT NULL,
  `other_payment_mode` varchar(250) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `client_id`, `sale_id`, `currency`, `instalment`, `net_amount`, `sale_date`, `payment_mode`, `other_payment_mode`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 200.00, '2024-01-15', 2, NULL, '2024-01-15 12:45:27', '2024-01-15 07:15:27'),
(2, 1, 2, 1, 1, 200.00, '2024-01-17', 2, NULL, '2024-01-16 11:46:57', '2024-01-16 06:16:57'),
(3, 1, 3, 1, 1, 200.00, '2024-01-18', 2, NULL, '2024-01-16 11:49:28', '2024-01-16 06:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `file` longtext DEFAULT NULL,
  `date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `sale_id`, `comment_by`, `message`, `file`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 15, NULL, 'http://127.0.0.1:8000/admin/comment/397742019_blank_chat.png', '2024-01-16 12:38:57', '2024-01-16 12:38:57', '2024-01-16 07:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `developer_jobs`
--

CREATE TABLE `developer_jobs` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `assign_to` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`assign_to`)),
  `assign_by` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `remarks` text NOT NULL,
  `status` int(11) NOT NULL,
  `total_time` text NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `developer_jobs`
--

INSERT INTO `developer_jobs` (`id`, `sale_id`, `assign_to`, `assign_by`, `title`, `details`, `start_date`, `end_date`, `remarks`, `status`, `total_time`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '[\"8\",\"15\"]', 1, 'Landing page - Wordpress', 'Landing page - Wordpress', '2024-01-15 12:49:00', '2024-01-26 12:49:00', 'Landing page - Wordpress', 1, '{\"year\":0,\"months\":0,\"days\":1,\"hours\":0,\"minutes\":0}', NULL, '2024-01-15 12:50:10', '2024-01-15 12:17:53');

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
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`id`, `group_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 2, 17, '2023-12-27 10:58:06', '2023-12-27 10:58:06'),
(4, 2, 15, '2023-12-27 10:58:06', '2023-12-27 10:58:06'),
(6, 2, 8, '2023-12-27 10:58:06', '2023-12-27 10:58:06'),
(7, 2, 3, '2023-12-27 10:58:06', '2023-12-27 10:58:06'),
(9, 2, 6, '2023-12-27 10:58:06', '2023-12-27 10:58:06'),
(10, 2, 7, '2023-12-27 10:58:06', '2023-12-27 10:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `group_names`
--

CREATE TABLE `group_names` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `uniqid` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `type` enum('Deal','Work') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_names`
--

INSERT INTO `group_names` (`id`, `user_id`, `name`, `uniqid`, `status`, `type`, `created_at`, `updated_at`) VALUES
(2, 1, 'Funfriend', 'k3fP9ppZG3', 'Active', 'Work', '2023-12-27 10:51:58', '2023-12-27 10:51:58'),
(3, 1, 'WebArt', 'Vd5q93EInM', 'Active', 'Work', '2024-01-02 03:57:30', '2024-01-03 06:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `log_histories`
--

CREATE TABLE `log_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` varchar(255) NOT NULL,
  `remark` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_histories`
--

INSERT INTO `log_histories` (`id`, `client_id`, `sale_id`, `user_id`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', 'Task (Landing page) has been added', '2024-01-15 07:15:27', '2024-01-15 07:15:27'),
(2, 1, 1, '1', 'Upsale  has been added', '2024-01-15 07:18:16', '2024-01-15 07:18:16'),
(3, 1, 1, '1', 'Task (Landing page) has been assigned', '2024-01-15 07:20:10', '2024-01-15 07:20:10'),
(4, 1, 2, '1', 'Task (Landing page) has been added', '2024-01-16 06:16:57', '2024-01-16 06:16:57'),
(5, 1, 3, '1', 'Task (Ecommerce) has been added', '2024-01-16 06:19:28', '2024-01-16 06:19:28'),
(6, 1, NULL, '1', 'Task (Ecommerce) has been assigned', '2024-01-16 06:31:45', '2024-01-16 06:31:45'),
(7, 1, NULL, '1', 'Task (Ecommerce) has been assigned', '2024-01-16 06:43:03', '2024-01-16 06:43:03');

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
(1, '2022_12_28_050429_create_clients_table', 1),
(2, '2014_10_12_000000_create_users_table', 2),
(3, '2014_10_12_100000_create_password_resets_table', 2),
(4, '2019_08_19_000000_create_failed_jobs_table', 2),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(6, '2022_12_28_050413_create_sales_table', 2),
(7, '2022_12_28_050503_create_closers_table', 2),
(8, '2022_12_28_050522_create_agents_table', 2),
(9, '2022_12_28_054233_create_contact_details_table', 2),
(10, '2023_12_12_121427_create_timers_table', 3),
(11, '2023_12_13_084404_create_log_histories_table', 4),
(12, '2023_12_14_100002_add_column_to_log_histories', 4),
(13, '2023_12_15_052237_create_assign_logs_table', 4),
(14, '2023_12_15_073412_create_group_names_table', 5),
(15, '2023_12_15_073826_create_group_members_table', 6),
(16, '2023_12_18_110008_create_chats_table', 6),
(17, '2023_12_18_110057_create_chat_requests_table', 6),
(18, '2023_12_18_110129_update_users_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$ddSV5x5RrfKiS/jxs9Skvuph7.IJ5tfR5kBkvqY82uZXMYrqk1TBi', '2023-01-10 14:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_type` int(11) NOT NULL,
  `technology` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `marketing_plan` varchar(255) DEFAULT NULL,
  `smo_on` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `platform_name` varchar(255) DEFAULT NULL,
  `prefer_technology` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `business_name` varchar(255) NOT NULL,
  `closer_name` varchar(250) NOT NULL,
  `agent_name` varchar(250) NOT NULL,
  `reference_sites` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `customer_requerment` text NOT NULL,
  `upsale_opportunities` text DEFAULT NULL,
  `isupsale` enum('1','0') NOT NULL,
  `sale_date` date NOT NULL,
  `currency` int(11) NOT NULL,
  `gross_amount` double(10,2) NOT NULL,
  `net_amount` double(10,2) NOT NULL,
  `due_amount` double(10,2) NOT NULL,
  `payment_mode` varchar(250) NOT NULL,
  `other_pay` varchar(250) DEFAULT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'Active',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `client_id`, `project_name`, `project_type`, `technology`, `type`, `others`, `marketing_plan`, `smo_on`, `start_date`, `end_date`, `platform_name`, `prefer_technology`, `description`, `business_name`, `closer_name`, `agent_name`, `reference_sites`, `remarks`, `customer_requerment`, `upsale_opportunities`, `isupsale`, `sale_date`, `currency`, `gross_amount`, `net_amount`, `due_amount`, `payment_mode`, `other_pay`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Landing page', 1, '1', '1', '', '', '', NULL, NULL, NULL, NULL, NULL, 'Test', 'Test', 'Test', NULL, 'Test', '', NULL, '1', '2024-01-15', 1, 200.00, 200.00, 0.00, '2', NULL, 'Active', NULL, '2024-01-15 07:15:27', '2024-01-15 07:15:27'),
(2, 1, 'Landing page', 1, '2', '5', '', '', '', NULL, NULL, NULL, NULL, NULL, 'jhjgkh', 'bjmhkgb', 'khjhk', NULL, 'kjjkh', 'kjhjh', NULL, '1', '2024-01-17', 1, 200.00, 200.00, 0.00, '2', NULL, 'Active', NULL, '2024-01-16 06:16:57', '2024-01-16 06:16:57'),
(3, 1, 'Ecommerce', 1, '3', '5', '', '', '', NULL, NULL, NULL, NULL, NULL, 'Ecommerce', 'Ecommerce', 'Ecommerce', NULL, 'Ecommerce', 'Ecommerce', NULL, '1', '2024-01-18', 1, 200.00, 200.00, 0.00, '2', NULL, 'Active', NULL, '2024-01-16 06:19:28', '2024-01-16 06:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) UNSIGNED NOT NULL,
  `assign_to` int(10) UNSIGNED NOT NULL,
  `assign_by` int(10) NOT NULL,
  `assign_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `sale_id`, `assign_to`, `assign_by`, `assign_date`, `created_at`, `updated_at`) VALUES
(1, 3, 6, 1, '2024-01-16', '2024-01-16 12:01:45', '2024-01-16 06:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `time_logs`
--

CREATE TABLE `time_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_time` varchar(255) NOT NULL,
  `timer_data` varchar(255) DEFAULT NULL,
  `type` enum('work','break') DEFAULT NULL,
  `status` enum('start','stop','end') DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_logs`
--

INSERT INTO `time_logs` (`id`, `user_id`, `start_time`, `timer_data`, `type`, `status`, `reason`, `created_at`, `updated_at`) VALUES
(1, 15, '14:39:04', '00:00:00', 'work', 'start', NULL, '2024-01-15 09:09:05', '2024-01-15 09:09:05'),
(2, 15, '14:39:17', '00:00:12', 'work', 'start', NULL, '2024-01-15 09:09:18', '2024-01-15 09:09:18'),
(3, 15, '14:39:20', '00:00:15', 'work', 'start', NULL, '2024-01-15 09:09:20', '2024-01-15 09:09:20'),
(4, 15, '14:39:20', '00:00:15', 'work', 'start', NULL, '2024-01-15 09:09:21', '2024-01-15 09:09:21'),
(5, 15, '14:39:24', '00:00:19', 'work', 'stop', NULL, '2024-01-15 09:09:25', '2024-01-15 09:09:25'),
(6, 15, '14:39:24', '00:00:00', 'break', 'start', NULL, '2024-01-15 09:09:25', '2024-01-15 09:09:25'),
(7, 15, '14:39:29', '00:00:04', 'break', 'start', NULL, '2024-01-15 09:09:30', '2024-01-15 09:09:30'),
(8, 15, '14:39:32', '00:00:07', 'break', 'start', NULL, '2024-01-15 09:09:32', '2024-01-15 09:09:32'),
(9, 15, '14:39:32', '00:00:19', 'work', 'stop', NULL, '2024-01-15 09:09:33', '2024-01-15 09:09:33'),
(10, 15, '14:39:32', '00:00:07', 'break', 'start', NULL, '2024-01-15 09:09:33', '2024-01-15 09:09:33'),
(11, 15, '14:39:37', '00:00:11', 'break', 'start', NULL, '2024-01-15 09:09:37', '2024-01-15 09:09:37'),
(12, 15, '14:39:43', '00:00:17', 'break', 'start', NULL, '2024-01-15 09:09:43', '2024-01-15 09:09:43'),
(13, 15, '14:39:44', '00:00:19', 'work', 'stop', NULL, '2024-01-15 09:09:45', '2024-01-15 09:09:45'),
(14, 15, '14:39:44', '00:00:17', 'break', 'start', NULL, '2024-01-15 09:09:45', '2024-01-15 09:09:45'),
(15, 15, '14:39:48', '00:00:21', 'break', 'stop', NULL, '2024-01-15 09:09:48', '2024-01-15 09:09:48'),
(16, 15, '14:39:48', '00:00:19', 'work', 'start', NULL, '2024-01-15 09:09:49', '2024-01-15 09:09:49'),
(17, 15, '14:39:51', '00:00:22', 'work', 'stop', NULL, '2024-01-15 09:09:52', '2024-01-15 09:09:52'),
(18, 15, '14:39:51', '00:00:21', 'break', 'start', NULL, '2024-01-15 09:09:52', '2024-01-15 09:09:52'),
(19, 15, '14:40:01', '00:00:31', 'break', 'stop', NULL, '2024-01-15 09:10:02', '2024-01-15 09:10:02'),
(20, 15, '14:40:01', '00:00:22', 'work', 'start', NULL, '2024-01-15 09:10:02', '2024-01-15 09:10:02'),
(21, 15, '14:40:07', '00:00:27', 'work', 'stop', NULL, '2024-01-15 09:10:07', '2024-01-15 09:10:07'),
(22, 15, '14:40:07', '00:00:31', 'break', 'start', NULL, '2024-01-15 09:10:07', '2024-01-15 09:10:07'),
(23, 15, '14:40:10', '00:00:33', 'break', 'stop', NULL, '2024-01-15 09:10:10', '2024-01-15 09:10:10'),
(24, 15, '14:40:10', '00:00:27', 'work', 'start', NULL, '2024-01-15 09:10:10', '2024-01-15 09:10:10'),
(25, 15, '14:41:21', '00:01:38', 'work', 'start', NULL, '2024-01-15 09:11:21', '2024-01-15 09:11:21'),
(26, 15, '14:41:21', '00:01:38', 'work', 'start', NULL, '2024-01-15 09:11:23', '2024-01-15 09:11:23'),
(27, 15, '14:42:27', '00:02:44', 'work', 'start', NULL, '2024-01-15 09:12:27', '2024-01-15 09:12:27'),
(28, 15, '14:42:27', '00:02:44', 'work', 'start', NULL, '2024-01-15 09:12:28', '2024-01-15 09:12:28'),
(29, 15, '15:30:10', '00:50:27', 'work', 'start', NULL, '2024-01-15 10:00:10', '2024-01-15 10:00:10'),
(30, 15, '15:30:11', '00:50:27', 'work', 'start', NULL, '2024-01-15 10:00:12', '2024-01-15 10:00:12'),
(31, 15, '15:30:42', '00:50:58', 'work', 'start', NULL, '2024-01-15 10:00:42', '2024-01-15 10:00:42'),
(32, 15, '15:30:42', '00:50:58', 'work', 'start', NULL, '2024-01-15 10:00:43', '2024-01-15 10:00:43'),
(33, 15, '15:52:11', '01:12:27', 'work', 'start', NULL, '2024-01-15 10:22:11', '2024-01-15 10:22:11'),
(34, 15, '15:52:11', '01:12:27', 'work', 'start', NULL, '2024-01-15 10:22:13', '2024-01-15 10:22:13'),
(35, 15, '15:52:42', '01:12:58', 'work', 'start', NULL, '2024-01-15 10:22:42', '2024-01-15 10:22:42'),
(36, 15, '15:52:42', '01:12:58', 'work', 'start', NULL, '2024-01-15 10:22:43', '2024-01-15 10:22:43'),
(37, 15, '15:54:01', '01:14:17', 'work', 'start', NULL, '2024-01-15 10:24:01', '2024-01-15 10:24:01'),
(38, 15, '15:54:01', '01:14:17', 'work', 'start', NULL, '2024-01-15 10:24:02', '2024-01-15 10:24:02'),
(39, 15, '15:54:23', '01:14:39', 'work', 'start', NULL, '2024-01-15 10:24:23', '2024-01-15 10:24:23'),
(40, 15, '15:54:23', '01:14:39', 'work', 'start', NULL, '2024-01-15 10:24:24', '2024-01-15 10:24:24'),
(41, 15, '15:54:43', '01:14:59', 'work', 'start', NULL, '2024-01-15 10:24:43', '2024-01-15 10:24:43'),
(42, 15, '15:54:43', '01:14:59', 'work', 'start', NULL, '2024-01-15 10:24:44', '2024-01-15 10:24:44'),
(43, 15, '15:55:05', '01:15:21', 'work', 'start', NULL, '2024-01-15 10:25:05', '2024-01-15 10:25:05'),
(44, 15, '15:55:06', '01:15:21', 'work', 'start', NULL, '2024-01-15 10:25:07', '2024-01-15 10:25:07'),
(45, 15, '15:55:28', '01:15:43', 'work', 'start', NULL, '2024-01-15 10:25:28', '2024-01-15 10:25:28'),
(46, 15, '15:55:28', '01:15:43', 'work', 'start', NULL, '2024-01-15 10:25:29', '2024-01-15 10:25:29'),
(47, 15, '15:55:48', '01:16:03', 'work', 'start', NULL, '2024-01-15 10:25:48', '2024-01-15 10:25:48'),
(48, 15, '15:55:48', '01:16:03', 'work', 'start', NULL, '2024-01-15 10:25:49', '2024-01-15 10:25:49'),
(49, 15, '15:56:09', '01:16:24', 'work', 'start', NULL, '2024-01-15 10:26:09', '2024-01-15 10:26:09'),
(50, 15, '15:56:09', '01:16:24', 'work', 'start', NULL, '2024-01-15 10:26:11', '2024-01-15 10:26:11'),
(51, 15, '15:56:43', '01:16:58', 'work', 'start', NULL, '2024-01-15 10:26:43', '2024-01-15 10:26:43'),
(52, 15, '15:56:44', '01:16:58', 'work', 'start', NULL, '2024-01-15 10:26:45', '2024-01-15 10:26:45'),
(53, 15, '15:57:00', '01:17:14', 'work', 'start', NULL, '2024-01-15 10:27:00', '2024-01-15 10:27:00'),
(54, 15, '15:57:00', '01:17:14', 'work', 'start', NULL, '2024-01-15 10:27:02', '2024-01-15 10:27:02'),
(55, 15, '16:01:47', '01:22:01', 'work', 'start', NULL, '2024-01-15 10:31:47', '2024-01-15 10:31:47'),
(56, 15, '16:01:47', '01:22:01', 'work', 'start', NULL, '2024-01-15 10:31:49', '2024-01-15 10:31:49'),
(57, 15, '16:01:56', '01:22:10', 'work', 'start', NULL, '2024-01-15 10:31:56', '2024-01-15 10:31:56'),
(58, 15, '16:01:56', '01:22:10', 'work', 'start', NULL, '2024-01-15 10:31:57', '2024-01-15 10:31:57'),
(59, 15, '16:02:13', '01:22:27', 'work', 'start', NULL, '2024-01-15 10:32:13', '2024-01-15 10:32:13'),
(60, 15, '16:02:14', '01:22:27', 'work', 'start', NULL, '2024-01-15 10:32:15', '2024-01-15 10:32:15'),
(61, 15, '16:02:28', '01:22:41', 'work', 'start', NULL, '2024-01-15 10:32:28', '2024-01-15 10:32:28'),
(62, 15, '16:02:28', '01:22:41', 'work', 'start', NULL, '2024-01-15 10:32:29', '2024-01-15 10:32:29'),
(63, 15, '16:02:42', '01:22:55', 'work', 'start', NULL, '2024-01-15 10:32:42', '2024-01-15 10:32:42'),
(64, 15, '16:02:42', '01:22:55', 'work', 'start', NULL, '2024-01-15 10:32:43', '2024-01-15 10:32:43'),
(65, 15, '16:02:52', '01:23:05', 'work', 'start', NULL, '2024-01-15 10:32:52', '2024-01-15 10:32:52'),
(66, 15, '16:02:52', '01:23:05', 'work', 'start', NULL, '2024-01-15 10:32:53', '2024-01-15 10:32:53'),
(67, 15, '16:03:26', '01:23:39', 'work', 'start', NULL, '2024-01-15 10:33:26', '2024-01-15 10:33:26'),
(68, 15, '16:03:26', '01:23:39', 'work', 'start', NULL, '2024-01-15 10:33:27', '2024-01-15 10:33:27'),
(69, 15, '16:04:58', '01:25:11', 'work', 'start', NULL, '2024-01-15 10:34:58', '2024-01-15 10:34:58'),
(70, 15, '16:04:58', '01:25:11', 'work', 'start', NULL, '2024-01-15 10:35:00', '2024-01-15 10:35:00'),
(71, 15, '16:05:20', '01:25:33', 'work', 'start', NULL, '2024-01-15 10:35:20', '2024-01-15 10:35:20'),
(72, 15, '16:05:20', '01:25:33', 'work', 'start', NULL, '2024-01-15 10:35:21', '2024-01-15 10:35:21'),
(73, 15, '16:08:56', '01:29:08', 'work', 'start', NULL, '2024-01-15 10:38:56', '2024-01-15 10:38:56'),
(74, 15, '16:09:00', '01:29:12', 'work', 'start', NULL, '2024-01-15 10:39:00', '2024-01-15 10:39:00'),
(75, 15, '16:09:01', '01:29:12', 'work', 'start', NULL, '2024-01-15 10:39:02', '2024-01-15 10:39:02'),
(76, 15, '16:10:20', '01:30:31', 'work', 'start', NULL, '2024-01-15 10:40:20', '2024-01-15 10:40:20'),
(77, 15, '16:10:20', '01:30:31', 'work', 'start', NULL, '2024-01-15 10:40:22', '2024-01-15 10:40:22'),
(78, 15, '16:10:39', '01:30:50', 'work', 'start', NULL, '2024-01-15 10:40:39', '2024-01-15 10:40:39'),
(79, 15, '16:10:39', '01:30:50', 'work', 'start', NULL, '2024-01-15 10:40:41', '2024-01-15 10:40:41'),
(80, 15, '16:11:09', '01:31:20', 'work', 'start', NULL, '2024-01-15 10:41:09', '2024-01-15 10:41:09'),
(81, 15, '16:11:09', '01:31:20', 'work', 'start', NULL, '2024-01-15 10:41:10', '2024-01-15 10:41:10'),
(82, 15, '16:11:14', '01:31:25', 'work', 'start', NULL, '2024-01-15 10:41:14', '2024-01-15 10:41:14'),
(83, 15, '16:11:15', '01:31:25', 'work', 'start', NULL, '2024-01-15 10:41:16', '2024-01-15 10:41:16'),
(84, 15, '16:12:49', '01:32:59', 'work', 'start', NULL, '2024-01-15 10:42:49', '2024-01-15 10:42:49'),
(85, 15, '16:12:50', '01:32:59', 'work', 'start', NULL, '2024-01-15 10:42:51', '2024-01-15 10:42:51'),
(86, 15, '16:20:14', '01:40:21', 'work', 'start', NULL, '2024-01-15 10:50:14', '2024-01-15 10:50:14'),
(87, 15, '16:20:17', '01:40:24', 'work', 'start', NULL, '2024-01-15 10:50:17', '2024-01-15 10:50:17'),
(88, 15, '16:20:18', '01:40:24', 'work', 'start', NULL, '2024-01-15 10:50:19', '2024-01-15 10:50:19'),
(89, 15, '16:20:25', '01:40:31', 'work', 'start', NULL, '2024-01-15 10:50:25', '2024-01-15 10:50:25'),
(90, 15, '16:20:26', '01:40:31', 'work', 'start', NULL, '2024-01-15 10:50:27', '2024-01-15 10:50:27'),
(91, 15, '16:21:41', '01:41:46', 'work', 'start', NULL, '2024-01-15 10:51:41', '2024-01-15 10:51:41'),
(92, 15, '16:21:41', '01:41:46', 'work', 'start', NULL, '2024-01-15 10:51:42', '2024-01-15 10:51:42'),
(93, 15, '16:24:25', '01:44:30', 'work', 'start', NULL, '2024-01-15 10:54:25', '2024-01-15 10:54:25'),
(94, 15, '16:24:25', '01:44:30', 'work', 'start', NULL, '2024-01-15 10:54:26', '2024-01-15 10:54:26'),
(95, 15, '16:25:01', '01:45:06', 'work', 'start', NULL, '2024-01-15 10:55:01', '2024-01-15 10:55:01'),
(96, 15, '16:25:01', '01:45:06', 'work', 'start', NULL, '2024-01-15 10:55:03', '2024-01-15 10:55:03'),
(97, 15, '16:25:32', '01:45:37', 'work', 'start', NULL, '2024-01-15 10:55:32', '2024-01-15 10:55:32'),
(98, 15, '16:25:32', '01:45:37', 'work', 'start', NULL, '2024-01-15 10:55:34', '2024-01-15 10:55:34'),
(99, 15, '16:26:21', '01:46:26', 'work', 'start', NULL, '2024-01-15 10:56:21', '2024-01-15 10:56:21'),
(100, 15, '16:26:22', '01:46:26', 'work', 'start', NULL, '2024-01-15 10:56:23', '2024-01-15 10:56:23'),
(101, 15, '16:27:20', '01:47:24', 'work', 'start', NULL, '2024-01-15 10:57:20', '2024-01-15 10:57:20'),
(102, 15, '16:27:20', '01:47:24', 'work', 'start', NULL, '2024-01-15 10:57:21', '2024-01-15 10:57:21'),
(103, 15, '16:27:45', '01:47:49', 'work', 'start', NULL, '2024-01-15 10:57:45', '2024-01-15 10:57:45'),
(104, 15, '16:27:45', '01:47:49', 'work', 'start', NULL, '2024-01-15 10:57:47', '2024-01-15 10:57:47'),
(105, 15, '16:28:28', '01:48:32', 'work', 'start', NULL, '2024-01-15 10:58:28', '2024-01-15 10:58:28'),
(106, 15, '16:28:28', '01:48:32', 'work', 'start', NULL, '2024-01-15 10:58:30', '2024-01-15 10:58:30'),
(107, 15, '16:28:36', '01:48:40', 'work', 'start', NULL, '2024-01-15 10:58:36', '2024-01-15 10:58:36'),
(108, 15, '16:28:37', '01:48:40', 'work', 'start', NULL, '2024-01-15 10:58:38', '2024-01-15 10:58:38'),
(109, 15, '16:29:24', '01:49:27', 'work', 'start', NULL, '2024-01-15 10:59:24', '2024-01-15 10:59:24'),
(110, 15, '16:29:25', '01:49:27', 'work', 'start', NULL, '2024-01-15 10:59:26', '2024-01-15 10:59:26'),
(111, 15, '16:30:00', '01:50:02', 'work', 'start', NULL, '2024-01-15 11:00:00', '2024-01-15 11:00:00'),
(112, 15, '16:30:00', '01:50:02', 'work', 'start', NULL, '2024-01-15 11:00:01', '2024-01-15 11:00:01'),
(113, 15, '16:31:05', '01:51:07', 'work', 'start', NULL, '2024-01-15 11:01:05', '2024-01-15 11:01:05'),
(114, 15, '16:31:05', '01:51:07', 'work', 'start', NULL, '2024-01-15 11:01:07', '2024-01-15 11:01:07'),
(115, 15, '16:32:04', '01:52:06', 'work', 'start', NULL, '2024-01-15 11:02:04', '2024-01-15 11:02:04'),
(116, 15, '16:32:05', '01:52:06', 'work', 'start', NULL, '2024-01-15 11:02:06', '2024-01-15 11:02:06'),
(117, 15, '16:33:54', '01:53:55', 'work', 'start', NULL, '2024-01-15 11:03:54', '2024-01-15 11:03:54'),
(118, 15, '16:33:54', '01:53:55', 'work', 'start', NULL, '2024-01-15 11:03:55', '2024-01-15 11:03:55'),
(119, 15, '16:34:27', '01:54:28', 'work', 'start', NULL, '2024-01-15 11:04:27', '2024-01-15 11:04:27'),
(120, 15, '16:34:27', '01:54:28', 'work', 'start', NULL, '2024-01-15 11:04:28', '2024-01-15 11:04:28'),
(121, 15, '16:43:36', '02:03:37', 'work', 'start', NULL, '2024-01-15 11:13:36', '2024-01-15 11:13:36'),
(122, 15, '16:43:36', '02:03:37', 'work', 'start', NULL, '2024-01-15 11:13:37', '2024-01-15 11:13:37'),
(123, 15, '16:48:32', '02:08:33', 'work', 'start', NULL, '2024-01-15 11:18:32', '2024-01-15 11:18:32'),
(124, 15, '16:48:33', '02:08:33', 'work', 'start', NULL, '2024-01-15 11:18:34', '2024-01-15 11:18:34'),
(125, 15, '16:48:43', '02:08:43', 'work', 'start', NULL, '2024-01-15 11:18:43', '2024-01-15 11:18:43'),
(126, 15, '16:48:43', '02:08:43', 'work', 'start', NULL, '2024-01-15 11:18:44', '2024-01-15 11:18:44'),
(127, 15, '16:52:36', '02:12:36', 'work', 'start', NULL, '2024-01-15 11:22:36', '2024-01-15 11:22:36'),
(128, 15, '16:52:37', '02:12:36', 'work', 'start', NULL, '2024-01-15 11:22:38', '2024-01-15 11:22:38'),
(129, 15, '16:53:36', '02:13:35', 'work', 'start', NULL, '2024-01-15 11:23:36', '2024-01-15 11:23:36'),
(130, 15, '16:53:36', '02:13:35', 'work', 'start', NULL, '2024-01-15 11:23:38', '2024-01-15 11:23:38'),
(131, 15, '16:53:49', '02:13:48', 'work', 'start', NULL, '2024-01-15 11:23:49', '2024-01-15 11:23:49'),
(132, 15, '16:53:50', '02:13:48', 'work', 'start', NULL, '2024-01-15 11:23:51', '2024-01-15 11:23:51'),
(133, 15, '16:58:08', '02:18:06', 'work', 'start', NULL, '2024-01-15 11:28:08', '2024-01-15 11:28:08'),
(134, 15, '16:58:08', '02:18:06', 'work', 'start', NULL, '2024-01-15 11:28:10', '2024-01-15 11:28:10'),
(135, 15, '16:58:27', '02:18:25', 'work', 'start', NULL, '2024-01-15 11:28:27', '2024-01-15 11:28:27'),
(136, 15, '16:58:27', '02:18:25', 'work', 'start', NULL, '2024-01-15 11:28:28', '2024-01-15 11:28:28'),
(137, 15, '16:58:42', '02:18:40', 'work', 'start', NULL, '2024-01-15 11:28:42', '2024-01-15 11:28:42'),
(138, 15, '16:58:42', '02:18:40', 'work', 'start', NULL, '2024-01-15 11:28:43', '2024-01-15 11:28:43'),
(139, 15, '16:58:59', '02:18:57', 'work', 'start', NULL, '2024-01-15 11:28:59', '2024-01-15 11:28:59'),
(140, 15, '16:59:00', '02:18:57', 'work', 'start', NULL, '2024-01-15 11:29:01', '2024-01-15 11:29:01'),
(141, 15, '16:59:09', '02:19:06', 'work', 'start', NULL, '2024-01-15 11:29:09', '2024-01-15 11:29:09'),
(142, 15, '16:59:09', '02:19:06', 'work', 'start', NULL, '2024-01-15 11:29:10', '2024-01-15 11:29:10'),
(143, 15, '17:00:35', '02:20:31', 'work', 'start', NULL, '2024-01-15 11:30:35', '2024-01-15 11:30:35'),
(144, 15, '17:00:37', '02:20:33', 'work', 'start', NULL, '2024-01-15 11:30:37', '2024-01-15 11:30:37'),
(145, 15, '17:00:37', '02:20:33', 'work', 'start', NULL, '2024-01-15 11:30:38', '2024-01-15 11:30:38'),
(146, 15, '17:00:47', '02:20:43', 'work', 'start', NULL, '2024-01-15 11:30:47', '2024-01-15 11:30:47'),
(147, 15, '17:00:47', '02:20:43', 'work', 'start', NULL, '2024-01-15 11:30:48', '2024-01-15 11:30:48'),
(148, 15, '17:23:29', '02:43:25', 'work', 'start', NULL, '2024-01-15 11:53:29', '2024-01-15 11:53:29'),
(149, 15, '17:23:29', '02:43:25', 'work', 'start', NULL, '2024-01-15 11:53:31', '2024-01-15 11:53:31'),
(150, 15, '17:23:43', '02:43:39', 'work', 'start', NULL, '2024-01-15 11:53:43', '2024-01-15 11:53:43'),
(151, 15, '17:23:43', '02:43:39', 'work', 'start', NULL, '2024-01-15 11:53:44', '2024-01-15 11:53:44'),
(152, 15, '17:24:28', '02:44:24', 'work', 'start', NULL, '2024-01-15 11:54:28', '2024-01-15 11:54:28'),
(153, 15, '17:24:28', '02:43:39', 'work', 'start', NULL, '2024-01-15 11:54:29', '2024-01-15 11:54:29'),
(154, 15, '17:28:59', '02:48:10', 'work', 'start', NULL, '2024-01-15 11:58:59', '2024-01-15 11:58:59'),
(155, 15, '17:28:59', '02:48:10', 'work', 'start', NULL, '2024-01-15 11:59:01', '2024-01-15 11:59:01'),
(156, 15, '17:29:31', '02:48:41', 'work', 'start', NULL, '2024-01-15 11:59:31', '2024-01-15 11:59:31'),
(157, 15, '17:29:32', '02:48:42', 'work', 'start', NULL, '2024-01-15 11:59:32', '2024-01-15 11:59:32'),
(158, 15, '17:29:32', '02:48:42', 'work', 'start', NULL, '2024-01-15 11:59:34', '2024-01-15 11:59:34'),
(159, 15, '17:30:20', '02:49:29', 'work', 'start', NULL, '2024-01-15 12:00:21', '2024-01-15 12:00:21'),
(160, 15, '17:30:22', '02:49:31', 'work', 'start', NULL, '2024-01-15 12:00:22', '2024-01-15 12:00:22'),
(161, 15, '17:30:22', '02:49:31', 'work', 'start', NULL, '2024-01-15 12:00:24', '2024-01-15 12:00:24'),
(162, 15, '17:30:39', '02:49:47', 'work', 'start', NULL, '2024-01-15 12:00:39', '2024-01-15 12:00:39'),
(163, 15, '17:30:41', '02:49:49', 'work', 'start', NULL, '2024-01-15 12:00:41', '2024-01-15 12:00:41'),
(164, 15, '17:30:41', '02:49:49', 'work', 'start', NULL, '2024-01-15 12:00:42', '2024-01-15 12:00:42'),
(165, 15, '17:30:51', '02:49:59', 'work', 'start', NULL, '2024-01-15 12:00:51', '2024-01-15 12:00:51'),
(166, 15, '17:30:52', '02:49:59', 'work', 'start', NULL, '2024-01-15 12:00:53', '2024-01-15 12:00:53'),
(167, 15, '17:31:34', '02:50:41', 'work', 'start', NULL, '2024-01-15 12:01:34', '2024-01-15 12:01:34'),
(168, 15, '17:31:35', '02:50:41', 'work', 'start', NULL, '2024-01-15 12:01:35', '2024-01-15 12:01:35'),
(169, 15, '17:31:43', '02:50:49', 'work', 'start', NULL, '2024-01-15 12:01:43', '2024-01-15 12:01:43'),
(170, 15, '17:31:44', '02:50:49', 'work', 'start', NULL, '2024-01-15 12:01:45', '2024-01-15 12:01:45'),
(171, 15, '17:32:11', '02:51:16', 'work', 'start', NULL, '2024-01-15 12:02:11', '2024-01-15 12:02:11'),
(172, 15, '17:32:12', '02:51:16', 'work', 'start', NULL, '2024-01-15 12:02:13', '2024-01-15 12:02:13'),
(173, 15, '17:32:23', '02:51:27', 'work', 'start', NULL, '2024-01-15 12:02:23', '2024-01-15 12:02:23'),
(174, 15, '17:32:23', '02:51:27', 'work', 'start', NULL, '2024-01-15 12:02:24', '2024-01-15 12:02:24'),
(175, 15, '17:32:55', '02:51:59', 'work', 'start', NULL, '2024-01-15 12:02:55', '2024-01-15 12:02:55'),
(176, 15, '17:32:55', '02:51:59', 'work', 'start', NULL, '2024-01-15 12:02:56', '2024-01-15 12:02:56'),
(177, 15, '17:33:36', '02:52:40', 'work', 'start', NULL, '2024-01-15 12:03:36', '2024-01-15 12:03:36'),
(178, 15, '17:33:37', '02:52:40', 'work', 'start', NULL, '2024-01-15 12:03:38', '2024-01-15 12:03:38'),
(179, 15, '17:33:44', '02:52:47', 'work', 'start', NULL, '2024-01-15 12:03:44', '2024-01-15 12:03:44'),
(180, 15, '17:33:44', '02:52:47', 'work', 'start', NULL, '2024-01-15 12:03:45', '2024-01-15 12:03:45'),
(181, 15, '17:34:16', '02:53:19', 'work', 'start', NULL, '2024-01-15 12:04:16', '2024-01-15 12:04:16'),
(182, 15, '17:34:17', '02:53:19', 'work', 'start', NULL, '2024-01-15 12:04:18', '2024-01-15 12:04:18'),
(183, 15, '17:35:11', '02:54:13', 'work', 'start', NULL, '2024-01-15 12:05:11', '2024-01-15 12:05:11'),
(184, 15, '17:35:12', '02:54:13', 'work', 'start', NULL, '2024-01-15 12:05:13', '2024-01-15 12:05:13'),
(185, 15, '17:35:29', '02:54:30', 'work', 'start', NULL, '2024-01-15 12:05:29', '2024-01-15 12:05:29'),
(186, 15, '17:35:31', '02:54:32', 'work', 'start', NULL, '2024-01-15 12:05:31', '2024-01-15 12:05:31'),
(187, 15, '17:35:32', '02:54:32', 'work', 'start', NULL, '2024-01-15 12:05:33', '2024-01-15 12:05:33'),
(188, 15, '17:36:25', '02:55:25', 'work', 'start', NULL, '2024-01-15 12:06:25', '2024-01-15 12:06:25'),
(189, 15, '17:36:28', '02:55:28', 'work', 'start', NULL, '2024-01-15 12:06:28', '2024-01-15 12:06:28'),
(190, 15, '17:36:28', '02:55:28', 'work', 'start', NULL, '2024-01-15 12:06:29', '2024-01-15 12:06:29'),
(191, 15, '17:36:33', '02:55:33', 'work', 'start', NULL, '2024-01-15 12:06:34', '2024-01-15 12:06:34'),
(192, 15, '17:36:36', '02:55:36', 'work', 'start', NULL, '2024-01-15 12:06:36', '2024-01-15 12:06:36'),
(193, 15, '17:36:36', '02:55:36', 'work', 'start', NULL, '2024-01-15 12:06:37', '2024-01-15 12:06:37'),
(194, 15, '17:37:10', '02:56:09', 'work', 'start', NULL, '2024-01-15 12:07:10', '2024-01-15 12:07:10'),
(195, 15, '17:37:13', '02:56:12', 'work', 'start', NULL, '2024-01-15 12:07:13', '2024-01-15 12:07:13'),
(196, 15, '17:37:13', '02:56:09', 'work', 'start', NULL, '2024-01-15 12:07:14', '2024-01-15 12:07:14'),
(197, 15, '17:38:08', '02:57:03', 'work', 'start', NULL, '2024-01-15 12:08:08', '2024-01-15 12:08:08'),
(198, 15, '17:38:10', '02:57:05', 'work', 'start', NULL, '2024-01-15 12:08:10', '2024-01-15 12:08:10'),
(199, 15, '17:38:11', NULL, 'work', 'start', NULL, '2024-01-15 12:08:12', '2024-01-15 12:08:12'),
(200, 15, '17:38:17', '17:38:23', 'work', 'start', NULL, '2024-01-15 12:08:17', '2024-01-15 12:08:17'),
(201, 15, '17:38:18', NULL, 'work', 'start', NULL, '2024-01-15 12:08:19', '2024-01-15 12:08:19'),
(202, 15, '17:39:00', '17:39:42', 'work', 'start', NULL, '2024-01-15 12:09:00', '2024-01-15 12:09:00'),
(203, 15, '17:39:01', '17:39:42', 'work', 'start', NULL, '2024-01-15 12:09:02', '2024-01-15 12:09:02'),
(204, 15, '17:39:39', '17:40:20', 'work', 'start', NULL, '2024-01-15 12:09:39', '2024-01-15 12:09:39'),
(205, 15, '17:39:39', '17:40:20', 'work', 'start', NULL, '2024-01-15 12:09:40', '2024-01-15 12:09:40'),
(206, 15, '17:39:47', '17:40:28', 'work', 'start', NULL, '2024-01-15 12:09:47', '2024-01-15 12:09:47'),
(207, 15, '17:39:47', '17:40:28', 'work', 'start', NULL, '2024-01-15 12:09:48', '2024-01-15 12:09:48'),
(208, 15, '17:39:57', '17:40:38', 'work', 'start', NULL, '2024-01-15 12:09:57', '2024-01-15 12:09:57'),
(209, 15, '17:39:57', '17:40:38', 'work', 'start', NULL, '2024-01-15 12:09:59', '2024-01-15 12:09:59'),
(210, 15, '17:40:13', '17:40:54', 'work', 'start', NULL, '2024-01-15 12:10:13', '2024-01-15 12:10:13'),
(211, 15, '17:40:13', '17:40:38', 'work', 'start', NULL, '2024-01-15 12:10:15', '2024-01-15 12:10:15'),
(212, 15, '17:40:22', '17:40:47', 'work', 'start', NULL, '2024-01-15 12:10:22', '2024-01-15 12:10:22'),
(213, 15, '17:40:23', '17:40:47', 'work', 'start', NULL, '2024-01-15 12:10:24', '2024-01-15 12:10:24'),
(214, 15, '17:40:59', '17:41:23', 'work', 'start', NULL, '2024-01-15 12:10:59', '2024-01-15 12:10:59'),
(215, 15, '17:40:59', '17:41:23', 'work', 'start', NULL, '2024-01-15 12:11:00', '2024-01-15 12:11:00'),
(216, 15, '17:41:18', '17:41:42', 'work', 'start', NULL, '2024-01-15 12:11:18', '2024-01-15 12:11:18'),
(217, 15, '17:41:18', NULL, 'work', 'start', NULL, '2024-01-15 12:11:19', '2024-01-15 12:11:19'),
(218, 15, '17:41:31', '17:41:44', 'work', 'start', NULL, '2024-01-15 12:11:31', '2024-01-15 12:11:31'),
(219, 15, '17:41:31', NULL, 'work', 'start', NULL, '2024-01-15 12:11:32', '2024-01-15 12:11:32'),
(220, 15, '17:41:54', '17:42:17', 'work', 'start', NULL, '2024-01-15 12:11:54', '2024-01-15 12:11:54'),
(221, 15, '17:41:54', NULL, 'work', 'start', NULL, '2024-01-15 12:11:55', '2024-01-15 12:11:55'),
(222, 15, '17:42:02', '17:42:10', 'work', 'start', NULL, '2024-01-15 12:12:02', '2024-01-15 12:12:02'),
(223, 15, '17:42:02', NULL, 'work', 'start', NULL, '2024-01-15 12:12:03', '2024-01-15 12:12:03'),
(224, 15, '17:42:31', '17:43:00', 'work', 'start', NULL, '2024-01-15 12:12:31', '2024-01-15 12:12:31'),
(225, 15, '17:42:31', '17:43:00', 'work', 'start', NULL, '2024-01-15 12:12:32', '2024-01-15 12:12:32'),
(226, 15, '17:42:44', '17:43:13', 'work', 'start', NULL, '2024-01-15 12:12:44', '2024-01-15 12:12:44'),
(227, 15, '17:42:44', '17:43:00', 'work', 'start', NULL, '2024-01-15 12:12:46', '2024-01-15 12:12:46'),
(228, 15, '17:42:59', '17:43:15', 'work', 'start', NULL, '2024-01-15 12:12:59', '2024-01-15 12:12:59'),
(229, 15, '17:43:00', '17:43:15', 'work', 'start', NULL, '2024-01-15 12:13:01', '2024-01-15 12:13:01'),
(230, 15, '17:43:16', '17:43:31', 'work', 'start', NULL, '2024-01-15 12:13:16', '2024-01-15 12:13:16'),
(231, 15, '17:43:16', '17:43:15', 'work', 'start', NULL, '2024-01-15 12:13:17', '2024-01-15 12:13:17'),
(232, 15, '17:44:07', '17:44:06', 'work', 'start', NULL, '2024-01-15 12:14:07', '2024-01-15 12:14:07'),
(233, 15, '17:44:07', '17:44:06', 'work', 'start', NULL, '2024-01-15 12:14:08', '2024-01-15 12:14:08'),
(234, 15, '17:44:16', '17:44:15', 'work', 'start', NULL, '2024-01-15 12:14:16', '2024-01-15 12:14:16'),
(235, 15, '17:44:17', '17:44:15', 'work', 'start', NULL, '2024-01-15 12:14:18', '2024-01-15 12:14:18'),
(236, 15, '17:44:20', '17:44:18', 'work', 'start', NULL, '2024-01-15 12:14:20', '2024-01-15 12:14:20'),
(237, 15, '17:44:20', '17:44:18', 'work', 'start', NULL, '2024-01-15 12:14:21', '2024-01-15 12:14:21'),
(238, 15, '17:45:11', '17:45:09', 'work', 'start', NULL, '2024-01-15 12:15:11', '2024-01-15 12:15:11'),
(239, 15, '17:45:11', '17:45:09', 'work', 'start', NULL, '2024-01-15 12:15:12', '2024-01-15 12:15:12'),
(240, 15, '17:47:08', '17:47:06', 'work', 'start', NULL, '2024-01-15 12:17:08', '2024-01-15 12:17:08'),
(241, 15, '17:47:09', '17:47:06', 'work', 'start', NULL, '2024-01-15 12:17:10', '2024-01-15 12:17:10'),
(242, 15, '17:47:16', '17:47:13', 'work', 'start', NULL, '2024-01-15 12:17:16', '2024-01-15 12:17:16'),
(243, 15, '17:47:16', '17:47:13', 'work', 'start', NULL, '2024-01-15 12:17:17', '2024-01-15 12:17:17'),
(244, 15, '17:47:25', '17:47:22', 'work', 'start', NULL, '2024-01-15 12:17:25', '2024-01-15 12:17:25'),
(245, 15, '17:47:26', '17:47:22', 'work', 'start', NULL, '2024-01-15 12:17:27', '2024-01-15 12:17:27'),
(246, 15, '17:47:44', '17:47:40', 'work', 'start', NULL, '2024-01-15 12:17:44', '2024-01-15 12:17:44'),
(247, 15, '17:47:45', '17:47:40', 'work', 'start', NULL, '2024-01-15 12:17:46', '2024-01-15 12:17:46'),
(248, 15, '17:47:49', '17:47:44', 'work', 'start', NULL, '2024-01-15 12:17:49', '2024-01-15 12:17:49'),
(249, 15, '17:47:49', '17:47:44', 'work', 'start', NULL, '2024-01-15 12:17:50', '2024-01-15 12:17:50'),
(250, 15, '17:48:36', '17:48:31', 'work', 'start', NULL, '2024-01-15 12:18:36', '2024-01-15 12:18:36'),
(251, 15, '17:48:36', '17:48:31', 'work', 'start', NULL, '2024-01-15 12:18:38', '2024-01-15 12:18:38'),
(252, 15, '17:49:30', '17:49:25', 'work', 'start', NULL, '2024-01-15 12:19:30', '2024-01-15 12:19:30'),
(253, 15, '17:49:31', '17:49:25', 'work', 'start', NULL, '2024-01-15 12:19:32', '2024-01-15 12:19:32'),
(254, 15, '17:51:07', '17:51:01', 'work', 'start', NULL, '2024-01-15 12:21:07', '2024-01-15 12:21:07'),
(255, 15, '17:51:07', '17:51:01', 'work', 'start', NULL, '2024-01-15 12:21:08', '2024-01-15 12:21:08'),
(256, 15, '17:51:26', '17:51:20', 'work', 'start', NULL, '2024-01-15 12:21:26', '2024-01-15 12:21:26'),
(257, 15, '17:51:26', '17:51:20', 'work', 'start', NULL, '2024-01-15 12:21:27', '2024-01-15 12:21:27'),
(258, 15, '17:52:02', '17:51:56', 'work', 'start', NULL, '2024-01-15 12:22:02', '2024-01-15 12:22:02'),
(259, 15, '17:52:02', '17:51:56', 'work', 'start', NULL, '2024-01-15 12:22:03', '2024-01-15 12:22:03'),
(260, 15, '17:52:27', '17:52:21', 'work', 'start', NULL, '2024-01-15 12:22:27', '2024-01-15 12:22:27'),
(261, 15, '17:52:27', '17:52:21', 'work', 'start', NULL, '2024-01-15 12:22:29', '2024-01-15 12:22:29'),
(262, 15, '17:53:03', '17:52:57', 'work', 'start', NULL, '2024-01-15 12:23:03', '2024-01-15 12:23:03'),
(263, 15, '17:53:03', '17:52:57', 'work', 'start', NULL, '2024-01-15 12:23:04', '2024-01-15 12:23:04'),
(264, 15, '17:53:14', '17:53:08', 'work', 'start', NULL, '2024-01-15 12:23:14', '2024-01-15 12:23:14'),
(265, 15, '17:53:14', '17:53:08', 'work', 'start', NULL, '2024-01-15 12:23:16', '2024-01-15 12:23:16'),
(266, 15, '17:53:53', '17:53:47', 'work', 'start', NULL, '2024-01-15 12:23:53', '2024-01-15 12:23:53'),
(267, 15, '17:53:54', '17:53:47', 'work', 'start', NULL, '2024-01-15 12:23:55', '2024-01-15 12:23:55'),
(268, 15, '17:54:06', '17:53:59', 'work', 'start', NULL, '2024-01-15 12:24:06', '2024-01-15 12:24:06'),
(269, 15, '17:54:06', '17:53:59', 'work', 'start', NULL, '2024-01-15 12:24:07', '2024-01-15 12:24:07'),
(270, 15, '17:54:31', '17:54:24', 'work', 'start', NULL, '2024-01-15 12:24:31', '2024-01-15 12:24:31'),
(271, 15, '17:54:31', '17:54:24', 'work', 'start', NULL, '2024-01-15 12:24:33', '2024-01-15 12:24:33'),
(272, 15, '17:54:57', '17:54:50', 'work', 'start', NULL, '2024-01-15 12:24:57', '2024-01-15 12:24:57'),
(273, 15, '17:54:57', '17:54:50', 'work', 'start', NULL, '2024-01-15 12:24:58', '2024-01-15 12:24:58'),
(274, 15, '17:55:05', '17:54:58', 'work', 'start', NULL, '2024-01-15 12:25:05', '2024-01-15 12:25:05'),
(275, 15, '17:55:06', '17:54:58', 'work', 'start', NULL, '2024-01-15 12:25:07', '2024-01-15 12:25:07'),
(276, 15, '18:06:53', '18:06:45', 'work', 'start', NULL, '2024-01-15 12:36:53', '2024-01-15 12:36:53'),
(277, 15, '18:06:53', '18:06:45', 'work', 'start', NULL, '2024-01-15 12:36:55', '2024-01-15 12:36:55'),
(278, 15, '18:07:19', '18:07:11', 'work', 'start', NULL, '2024-01-15 12:37:19', '2024-01-15 12:37:19'),
(279, 15, '18:07:20', '18:07:11', 'work', 'start', NULL, '2024-01-15 12:37:21', '2024-01-15 12:37:21'),
(280, 15, '18:07:41', '18:07:32', 'work', 'start', NULL, '2024-01-15 12:37:41', '2024-01-15 12:37:41'),
(281, 15, '18:07:41', '18:07:32', 'work', 'start', NULL, '2024-01-15 12:37:42', '2024-01-15 12:37:42'),
(282, 15, '13:03:06', '00:00:00', 'work', 'start', NULL, '2024-01-16 07:33:07', '2024-01-16 07:33:07'),
(283, 15, '13:03:08', '00:00:02', 'work', 'stop', NULL, '2024-01-16 07:33:09', '2024-01-16 07:33:09'),
(284, 15, '13:03:08', '00:00:00', 'break', 'start', NULL, '2024-01-16 07:33:09', '2024-01-16 07:33:09'),
(285, 15, '13:03:10', '00:00:01', 'break', 'stop', NULL, '2024-01-16 07:33:10', '2024-01-16 07:33:10'),
(286, 15, '13:03:10', '00:00:02', 'work', 'start', NULL, '2024-01-16 07:33:11', '2024-01-16 07:33:11'),
(287, 15, '13:03:16', '00:00:08', 'work', 'start', NULL, '2024-01-16 07:33:16', '2024-01-16 07:33:16'),
(288, 15, '13:03:16', '00:00:08', 'work', 'start', NULL, '2024-01-16 07:33:18', '2024-01-16 07:33:18'),
(289, 15, '13:05:16', '00:02:07', 'work', 'start', NULL, '2024-01-16 07:35:16', '2024-01-16 07:35:16'),
(290, 15, '13:05:18', '00:02:09', 'work', 'start', NULL, '2024-01-16 07:35:18', '2024-01-16 07:35:18'),
(291, 15, '13:05:19', '00:02:09', 'work', 'start', NULL, '2024-01-16 07:35:20', '2024-01-16 07:35:20'),
(292, 15, '13:16:04', '00:07:36', 'work', 'start', NULL, '2024-01-16 07:46:05', '2024-01-16 07:46:05'),
(293, 15, '13:16:07', '00:07:39', 'work', 'start', NULL, '2024-01-16 07:46:07', '2024-01-16 07:46:07'),
(294, 15, '13:16:07', '00:07:39', 'work', 'start', NULL, '2024-01-16 07:46:09', '2024-01-16 07:46:09'),
(295, 15, '13:16:12', '00:07:44', 'work', 'start', NULL, '2024-01-16 07:46:12', '2024-01-16 07:46:12'),
(296, 15, '13:16:13', '00:07:44', 'work', 'start', NULL, '2024-01-16 07:46:14', '2024-01-16 07:46:14'),
(297, 15, '13:16:21', '00:07:52', 'work', 'start', NULL, '2024-01-16 07:46:21', '2024-01-16 07:46:21'),
(298, 15, '13:16:21', '00:07:52', 'work', 'start', NULL, '2024-01-16 07:46:23', '2024-01-16 07:46:23'),
(299, 15, '13:17:23', '00:08:54', 'work', 'start', NULL, '2024-01-16 07:47:23', '2024-01-16 07:47:23'),
(300, 15, '13:17:23', '00:07:52', 'work', 'start', NULL, '2024-01-16 07:47:25', '2024-01-16 07:47:25'),
(301, 15, '13:20:40', '00:11:09', 'work', 'start', NULL, '2024-01-16 07:50:40', '2024-01-16 07:50:40'),
(302, 15, '13:20:40', '00:11:09', 'work', 'start', NULL, '2024-01-16 07:50:42', '2024-01-16 07:50:42'),
(303, 15, '13:21:44', '00:12:13', 'work', 'start', NULL, '2024-01-16 07:51:44', '2024-01-16 07:51:44'),
(304, 15, '13:21:44', '00:12:13', 'work', 'start', NULL, '2024-01-16 07:51:45', '2024-01-16 07:51:45'),
(305, 15, '13:22:43', '00:13:12', 'work', 'start', NULL, '2024-01-16 07:52:43', '2024-01-16 07:52:43'),
(306, 15, '13:22:43', '00:12:13', 'work', 'start', NULL, '2024-01-16 07:52:45', '2024-01-16 07:52:45'),
(307, 15, '13:23:35', '00:13:05', 'work', 'start', NULL, '2024-01-16 07:53:35', '2024-01-16 07:53:35'),
(308, 15, '13:23:36', '00:13:05', 'work', 'start', NULL, '2024-01-16 07:53:37', '2024-01-16 07:53:37'),
(309, 15, '13:24:06', '00:13:35', 'work', 'start', NULL, '2024-01-16 07:54:06', '2024-01-16 07:54:06'),
(310, 15, '13:24:07', '00:13:35', 'work', 'start', NULL, '2024-01-16 07:54:08', '2024-01-16 07:54:08'),
(311, 15, '13:27:13', '00:16:41', 'work', 'start', NULL, '2024-01-16 07:57:14', '2024-01-16 07:57:14'),
(312, 15, '13:27:17', '00:16:45', 'work', 'start', NULL, '2024-01-16 07:57:17', '2024-01-16 07:57:17'),
(313, 15, '13:27:17', '00:16:45', 'work', 'start', NULL, '2024-01-16 07:57:19', '2024-01-16 07:57:19'),
(314, 15, '13:27:56', '00:17:23', 'work', 'start', NULL, '2024-01-16 07:57:56', '2024-01-16 07:57:56'),
(315, 15, '13:27:59', '00:17:26', 'work', 'start', NULL, '2024-01-16 07:57:59', '2024-01-16 07:57:59'),
(316, 15, '13:27:59', '00:17:26', 'work', 'start', NULL, '2024-01-16 07:58:01', '2024-01-16 07:58:01'),
(317, 15, '14:07:21', '00:56:48', 'work', 'start', NULL, '2024-01-16 08:37:21', '2024-01-16 08:37:21'),
(318, 15, '14:07:22', '00:56:48', 'work', 'start', NULL, '2024-01-16 08:37:23', '2024-01-16 08:37:23'),
(319, 15, '14:08:02', '00:57:28', 'work', 'start', NULL, '2024-01-16 08:38:02', '2024-01-16 08:38:02'),
(320, 15, '14:08:02', '00:57:28', 'work', 'start', NULL, '2024-01-16 08:38:04', '2024-01-16 08:38:04'),
(321, 15, '14:08:45', '00:58:10', 'work', 'start', NULL, '2024-01-16 08:38:45', '2024-01-16 08:38:45'),
(322, 15, '14:08:48', '00:58:13', 'work', 'start', NULL, '2024-01-16 08:38:48', '2024-01-16 08:38:48'),
(323, 15, '14:08:48', '00:58:13', 'work', 'start', NULL, '2024-01-16 08:38:50', '2024-01-16 08:38:50'),
(324, 15, '14:09:47', '00:59:12', 'work', 'start', NULL, '2024-01-16 08:39:47', '2024-01-16 08:39:47'),
(325, 15, '14:09:50', '00:59:15', 'work', 'start', NULL, '2024-01-16 08:39:50', '2024-01-16 08:39:50'),
(326, 15, '14:09:50', '00:59:15', 'work', 'start', NULL, '2024-01-16 08:39:52', '2024-01-16 08:39:52'),
(327, 15, '14:11:12', '01:00:36', 'work', 'start', NULL, '2024-01-16 08:41:12', '2024-01-16 08:41:12'),
(328, 15, '14:11:15', '01:00:39', 'work', 'start', NULL, '2024-01-16 08:41:15', '2024-01-16 08:41:15'),
(329, 15, '14:11:15', '01:00:39', 'work', 'start', NULL, '2024-01-16 08:41:17', '2024-01-16 08:41:17'),
(330, 15, '14:11:39', '01:01:02', 'work', 'start', NULL, '2024-01-16 08:41:39', '2024-01-16 08:41:39'),
(331, 15, '14:11:42', '01:01:05', 'work', 'start', NULL, '2024-01-16 08:41:42', '2024-01-16 08:41:42'),
(332, 15, '14:11:42', '01:01:05', 'work', 'start', NULL, '2024-01-16 08:41:44', '2024-01-16 08:41:44'),
(333, 15, '14:12:50', '01:02:13', 'work', 'start', NULL, '2024-01-16 08:42:50', '2024-01-16 08:42:50'),
(334, 15, '14:12:51', '01:02:13', 'work', 'start', NULL, '2024-01-16 08:42:52', '2024-01-16 08:42:52'),
(335, 15, '14:13:14', '01:02:36', 'work', 'start', NULL, '2024-01-16 08:43:14', '2024-01-16 08:43:14'),
(336, 15, '14:13:14', '01:02:13', 'work', 'start', NULL, '2024-01-16 08:43:16', '2024-01-16 08:43:16'),
(337, 15, '14:22:24', '01:11:23', 'work', 'start', NULL, '2024-01-16 08:52:24', '2024-01-16 08:52:24'),
(338, 15, '14:22:26', '01:11:25', 'work', 'start', NULL, '2024-01-16 08:52:26', '2024-01-16 08:52:26'),
(339, 15, '14:22:26', '01:11:25', 'work', 'start', NULL, '2024-01-16 08:52:28', '2024-01-16 08:52:28'),
(340, 15, '14:22:42', '01:11:41', 'work', 'start', NULL, '2024-01-16 08:52:42', '2024-01-16 08:52:42'),
(341, 15, '14:22:42', '01:11:41', 'work', 'start', NULL, '2024-01-16 08:52:44', '2024-01-16 08:52:44'),
(342, 15, '14:23:53', '01:12:51', 'work', 'end', NULL, '2024-01-16 08:53:53', '2024-01-16 08:53:53'),
(343, 15, '14:23:55', '01:12:51', 'work', 'start', NULL, '2024-01-16 08:53:55', '2024-01-16 08:53:55'),
(344, 15, '14:23:56', '01:12:52', 'work', 'stop', NULL, '2024-01-16 08:53:56', '2024-01-16 08:53:56'),
(345, 15, '14:23:56', '00:00:01', 'break', 'start', NULL, '2024-01-16 08:53:56', '2024-01-16 08:53:56'),
(346, 15, '14:27:24', '00:03:28', 'break', 'start', NULL, '2024-01-16 08:57:24', '2024-01-16 08:57:24'),
(347, 15, '14:27:26', '00:03:30', 'break', 'start', NULL, '2024-01-16 08:57:26', '2024-01-16 08:57:26'),
(348, 15, '14:27:26', '01:12:52', 'work', 'stop', NULL, '2024-01-16 08:57:27', '2024-01-16 08:57:27'),
(349, 15, '14:27:26', '00:03:30', 'break', 'start', NULL, '2024-01-16 08:57:27', '2024-01-16 08:57:27'),
(350, 15, '14:29:46', '00:05:49', 'break', 'start', NULL, '2024-01-16 08:59:46', '2024-01-16 08:59:46'),
(351, 15, '14:30:36', '00:06:39', 'break', 'start', NULL, '2024-01-16 09:00:36', '2024-01-16 09:00:36'),
(352, 15, '14:30:36', '01:12:52', 'work', 'stop', NULL, '2024-01-16 09:00:37', '2024-01-16 09:00:37'),
(353, 15, '14:30:36', '00:06:39', 'break', 'start', NULL, '2024-01-16 09:00:37', '2024-01-16 09:00:37'),
(354, 15, '14:31:50', '00:07:53', 'break', 'start', NULL, '2024-01-16 09:01:50', '2024-01-16 09:01:50'),
(355, 15, '14:31:50', '01:12:52', 'work', 'stop', NULL, '2024-01-16 09:01:51', '2024-01-16 09:01:51'),
(356, 15, '14:31:50', '00:07:53', 'break', 'start', NULL, '2024-01-16 09:01:51', '2024-01-16 09:01:51'),
(357, 15, '14:31:54', '00:07:57', 'break', 'start', NULL, '2024-01-16 09:01:54', '2024-01-16 09:01:54'),
(358, 15, '14:31:55', '01:12:52', 'work', 'stop', NULL, '2024-01-16 09:01:56', '2024-01-16 09:01:56'),
(359, 15, '14:31:55', '00:07:57', 'break', 'start', NULL, '2024-01-16 09:01:56', '2024-01-16 09:01:56'),
(360, 15, '14:32:11', '00:08:13', 'break', 'start', NULL, '2024-01-16 09:02:11', '2024-01-16 09:02:11'),
(361, 15, '14:32:11', '01:12:52', 'work', 'stop', NULL, '2024-01-16 09:02:13', '2024-01-16 09:02:13'),
(362, 15, '14:32:11', '00:08:13', 'break', 'start', NULL, '2024-01-16 09:02:13', '2024-01-16 09:02:13'),
(363, 15, '14:32:18', '00:08:20', 'break', 'start', NULL, '2024-01-16 09:02:18', '2024-01-16 09:02:18'),
(364, 15, '14:32:18', '01:12:52', 'work', 'stop', NULL, '2024-01-16 09:02:20', '2024-01-16 09:02:20'),
(365, 15, '14:32:18', '00:08:20', 'break', 'start', NULL, '2024-01-16 09:02:20', '2024-01-16 09:02:20'),
(366, 15, '14:32:52', '00:08:53', 'break', 'stop', NULL, '2024-01-16 09:02:52', '2024-01-16 09:02:52'),
(367, 15, '14:32:52', '01:12:52', 'work', 'start', NULL, '2024-01-16 09:02:52', '2024-01-16 09:02:52'),
(368, 15, '14:38:26', '01:16:27', 'work', 'start', NULL, '2024-01-16 09:08:26', '2024-01-16 09:08:26'),
(369, 15, '14:38:28', '01:16:29', 'work', 'start', NULL, '2024-01-16 09:08:28', '2024-01-16 09:08:28'),
(370, 15, '14:38:29', '01:16:29', 'work', 'start', NULL, '2024-01-16 09:08:30', '2024-01-16 09:08:30'),
(371, 15, '14:41:06', '01:19:05', 'work', 'start', NULL, '2024-01-16 09:11:06', '2024-01-16 09:11:06'),
(372, 15, '14:41:10', '01:19:09', 'work', 'start', NULL, '2024-01-16 09:11:10', '2024-01-16 09:11:10'),
(373, 15, '14:41:10', '01:19:05', 'work', 'start', NULL, '2024-01-16 09:11:11', '2024-01-16 09:11:11'),
(374, 15, '14:42:19', '01:20:14', 'work', 'start', NULL, '2024-01-16 09:12:19', '2024-01-16 09:12:19'),
(375, 15, '14:42:19', '01:20:14', 'work', 'start', NULL, '2024-01-16 09:12:20', '2024-01-16 09:12:20'),
(376, 15, '14:42:44', '01:20:38', 'work', 'start', NULL, '2024-01-16 09:12:44', '2024-01-16 09:12:44'),
(377, 15, '14:42:47', '01:20:41', 'work', 'start', NULL, '2024-01-16 09:12:47', '2024-01-16 09:12:47'),
(378, 15, '14:42:48', '01:20:41', 'work', 'start', NULL, '2024-01-16 09:12:49', '2024-01-16 09:12:49'),
(379, 15, '14:42:52', '01:20:45', 'work', 'stop', NULL, '2024-01-16 09:12:53', '2024-01-16 09:12:53'),
(380, 15, '14:42:52', '00:08:53', 'break', 'start', NULL, '2024-01-16 09:12:53', '2024-01-16 09:12:53'),
(381, 15, '14:42:56', '00:08:56', 'break', 'start', NULL, '2024-01-16 09:12:56', '2024-01-16 09:12:56'),
(382, 15, '14:42:59', '00:08:59', 'break', 'start', NULL, '2024-01-16 09:12:59', '2024-01-16 09:12:59'),
(383, 15, '14:42:59', '01:20:45', 'work', 'stop', NULL, '2024-01-16 09:13:01', '2024-01-16 09:13:01'),
(384, 15, '14:42:59', '00:08:59', 'break', 'start', NULL, '2024-01-16 09:13:01', '2024-01-16 09:13:01'),
(385, 15, '14:43:32', '00:09:32', 'break', 'start', NULL, '2024-01-16 09:13:33', '2024-01-16 09:13:33'),
(386, 15, '14:43:37', '00:09:37', 'break', 'start', NULL, '2024-01-16 09:13:37', '2024-01-16 09:13:37'),
(387, 15, '14:43:36', '01:20:45', 'work', 'stop', NULL, '2024-01-16 09:13:38', '2024-01-16 09:13:38'),
(388, 15, '14:43:36', '00:09:32', 'break', 'start', NULL, '2024-01-16 09:13:38', '2024-01-16 09:13:38'),
(389, 15, '14:48:52', '00:14:48', 'break', 'start', NULL, '2024-01-16 09:18:52', '2024-01-16 09:18:52'),
(390, 15, '14:48:53', '01:20:45', 'work', 'stop', NULL, '2024-01-16 09:18:55', '2024-01-16 09:18:55'),
(391, 15, '14:48:53', '00:14:48', 'break', 'start', NULL, '2024-01-16 09:18:55', '2024-01-16 09:18:55'),
(392, 15, '14:51:02', '00:16:56', 'break', 'start', NULL, '2024-01-16 09:21:02', '2024-01-16 09:21:02'),
(393, 15, '14:51:06', '00:17:00', 'break', 'start', NULL, '2024-01-16 09:21:06', '2024-01-16 09:21:06'),
(394, 15, '14:51:06', '01:20:45', 'work', 'stop', NULL, '2024-01-16 09:21:07', '2024-01-16 09:21:07'),
(395, 15, '14:51:06', '00:16:56', 'break', 'start', NULL, '2024-01-16 09:21:07', '2024-01-16 09:21:07'),
(396, 15, '14:52:28', '00:18:18', 'break', 'start', NULL, '2024-01-16 09:22:28', '2024-01-16 09:22:28'),
(397, 15, '14:52:29', '01:20:45', 'work', 'stop', NULL, '2024-01-16 09:22:30', '2024-01-16 09:22:30'),
(398, 15, '14:52:29', '00:18:18', 'break', 'start', NULL, '2024-01-16 09:22:30', '2024-01-16 09:22:30'),
(399, 15, '14:52:58', '00:18:47', 'break', 'start', NULL, '2024-01-16 09:22:58', '2024-01-16 09:22:58'),
(400, 15, '14:52:58', '01:20:45', 'work', 'stop', NULL, '2024-01-16 09:23:00', '2024-01-16 09:23:00'),
(401, 15, '14:52:58', '00:18:47', 'break', 'start', NULL, '2024-01-16 09:23:00', '2024-01-16 09:23:00'),
(402, 15, '14:55:19', '00:21:08', 'break', 'start', NULL, '2024-01-16 09:25:19', '2024-01-16 09:25:19'),
(403, 15, '14:55:18', '01:20:45', 'work', 'stop', NULL, '2024-01-16 09:25:20', '2024-01-16 09:25:20'),
(404, 15, '14:55:18', '00:18:47', 'break', 'start', NULL, '2024-01-16 09:25:20', '2024-01-16 09:25:20'),
(405, 15, '14:58:20', '00:21:48', 'break', 'start', NULL, '2024-01-16 09:28:20', '2024-01-16 09:28:20'),
(406, 15, '14:58:22', '00:21:50', 'break', 'start', NULL, '2024-01-16 09:28:22', '2024-01-16 09:28:22'),
(407, 15, '14:58:23', '01:20:45', 'work', 'stop', NULL, '2024-01-16 09:28:24', '2024-01-16 09:28:24'),
(408, 15, '14:58:23', '00:21:50', 'break', 'start', NULL, '2024-01-16 09:28:24', '2024-01-16 09:28:24'),
(409, 15, '15:03:00', '00:26:26', 'break', 'stop', NULL, '2024-01-16 09:33:00', '2024-01-16 09:33:00'),
(410, 15, '15:03:00', '01:20:45', 'work', 'start', NULL, '2024-01-16 09:33:00', '2024-01-16 09:33:00'),
(411, 15, '15:03:02', '01:20:47', 'work', 'start', NULL, '2024-01-16 09:33:02', '2024-01-16 09:33:02'),
(412, 15, '15:03:04', '01:20:49', 'work', 'start', NULL, '2024-01-16 09:33:04', '2024-01-16 09:33:04'),
(413, 15, '15:03:04', '01:20:49', 'work', 'start', NULL, '2024-01-16 09:33:06', '2024-01-16 09:33:06'),
(414, 15, '15:09:52', '01:27:36', 'work', 'stop', NULL, '2024-01-16 09:39:52', '2024-01-16 09:39:52'),
(415, 15, '15:09:52', '00:26:26', 'break', 'start', NULL, '2024-01-16 09:39:52', '2024-01-16 09:39:52'),
(416, 15, '15:09:53', '00:26:26', 'break', 'stop', NULL, '2024-01-16 09:39:53', '2024-01-16 09:39:53'),
(417, 15, '15:09:53', '01:27:36', 'work', 'start', NULL, '2024-01-16 09:39:54', '2024-01-16 09:39:54'),
(418, 15, '15:09:54', '01:27:36', 'work', 'stop', NULL, '2024-01-16 09:39:54', '2024-01-16 09:39:54'),
(419, 15, '15:09:54', '00:26:26', 'break', 'start', NULL, '2024-01-16 09:39:54', '2024-01-16 09:39:54'),
(420, 15, '15:09:54', '00:26:26', 'break', 'stop', NULL, '2024-01-16 09:39:55', '2024-01-16 09:39:55'),
(421, 15, '15:09:54', '01:27:36', 'work', 'start', NULL, '2024-01-16 09:39:55', '2024-01-16 09:39:55'),
(422, 15, '15:10:47', '01:28:28', 'work', 'start', NULL, '2024-01-16 09:40:47', '2024-01-16 09:40:47'),
(423, 15, '15:10:49', '01:28:30', 'work', 'start', NULL, '2024-01-16 09:40:49', '2024-01-16 09:40:49'),
(424, 15, '15:10:49', '01:28:30', 'work', 'start', NULL, '2024-01-16 09:40:50', '2024-01-16 09:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `upsales`
--

CREATE TABLE `upsales` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `upsale_type` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `others` text NOT NULL,
  `gross_amount` double(10,2) NOT NULL,
  `net_amount` double(10,2) NOT NULL,
  `payment_mode` int(11) NOT NULL,
  `other_payment_mode` varchar(250) NOT NULL,
  `sale_date` date NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upsales`
--

INSERT INTO `upsales` (`id`, `client_id`, `sale_id`, `upsale_type`, `start_date`, `end_date`, `others`, `gross_amount`, `net_amount`, `payment_mode`, `other_payment_mode`, `sale_date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, '2024-01-15', '2024-01-30', '', 200.00, 200.00, 2, '', '2024-01-15', NULL, '2024-01-15 12:48:16', '2024-01-15 07:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(200) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` enum('1','2','3','4','5','6','7','8') NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `connection_id` int(11) DEFAULT NULL,
  `user_status` enum('Offline','Online') DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile_no`, `email_verified_at`, `password`, `role_id`, `is_active`, `remember_token`, `created_at`, `updated_at`, `token`, `connection_id`, `user_status`, `user_image`) VALUES
(1, 'Webart Technology (Owner)', 'admin@gmail.com', '9632587410', NULL, '$2y$10$5dIsrq7GWMXmseeDyOhxKu.xBqCJ209zXDvTNGAeweitc9aNjX3R2', '1', 1, 'BXaJWH7BHW7Smc64C3Vf4dY5D8b8qve5MQQdrECFtlbKdc96JHziEYoUAEe4', '2023-01-02 01:21:46', '2024-01-16 06:45:12', '76df9cb296d8412e394b63a5518189a5', 0, 'Offline', ''),
(3, 'Sales', 'sales@gmail.com', NULL, NULL, '$2y$10$5dIsrq7GWMXmseeDyOhxKu.xBqCJ209zXDvTNGAeweitc9aNjX3R2', '2', 1, NULL, '2023-01-02 01:21:46', '2024-01-03 09:17:29', '', 0, 'Offline', 'http://127.0.0.1:8000/admin/Employee/716967142_logo.png'),
(6, 'Pritam sen', 'pritam@webart.technology', '9088850821', NULL, '$2y$10$FsyHj77Dy9bDFxd1YrrTQOHB2lRwTji3j57fYLTdB8zBEeuXYvrTu', '3', 1, NULL, '2023-07-17 06:08:27', '2024-01-16 05:47:20', '64880e47fdf345df4c1d15b5387eb144', 0, 'Offline', ''),
(7, 'Sankar Bera', 'sankar@webart.technology', '9874300364', NULL, '$2y$10$S2cSAhmsPuiqYYyeCfoTveO2Ukg1s1HtR46AzlQjS3oMLco6sejGW', '4', 1, NULL, '2023-07-17 06:19:20', '2023-07-17 06:52:55', '', 0, 'Offline', ''),
(8, 'Deepak Kumar', 'deepak@gmail.com', '9874300364', NULL, '$2y$10$yBON9Myfhw3Roa.Mtg9D8eWhX8gl13pRKRr7aFq9le98IrnKPM6.i', '6', 1, NULL, '2023-07-31 01:47:44', '2024-01-16 04:12:50', '8ab237e79338164fac9b443c636f6056', 0, 'Offline', 'http://127.0.0.1:8000/admin/Employee/1157968163_1562026947_camera3.png'),
(9, 'Sudip Ghosh', 'sudip@webart.technology', '9874300364', NULL, '$2y$10$F3ZGJ/YjEyWn.487e0r.heMAbwiaja4RjsuRgEKT97xnfVL/o9lW2', '5', 1, NULL, '2023-08-01 03:43:55', '2024-01-16 06:06:04', '689e6b7f937d649a81e2513a4f467d93', 0, 'Offline', ''),
(10, 'Sohom Bhattacharjee', 'sohom@webart.technology', '8956656897', NULL, '$2y$10$XjCUbHto/5Wi0cPQjl7ZGuLRKtpGmF6BU9gvhPiHpFkYTSFP4SYVy', '7', 1, NULL, '2023-08-07 03:41:47', '2023-08-07 03:41:47', '', 0, 'Offline', ''),
(11, 'Sudipto Chakraborty', 'sudipto@digitalwebber.com', '7003238056', NULL, '$2y$10$SEg1c4XgkGGmu/YC/Q0sD.K1nb69Ilk.UluNJpMfGFa61zi0A7YcS', '2', 1, NULL, '2023-08-14 21:13:56', '2023-08-14 21:13:56', '', 0, 'Offline', ''),
(12, 'Test Project Manager', 'test@yopmail.com', '1234567890', NULL, '$2y$10$nQh0.JKoOqdI9C7F6uz5IuTAeprBU.BXKLnIVVib/55w8VyvWzjGK', '6', 1, NULL, '2023-08-14 22:25:23', '2023-12-08 04:30:57', '', 0, 'Offline', ''),
(14, 'Test user', 'test@mail.com', '0123456789', NULL, '$2y$10$nrMLwmRecT5TdYQbPXvV8.cUvn6I7LcX3cw862XRpYCc3gI2.Mlki', '6', 1, NULL, '2023-12-08 04:32:19', '2023-12-21 06:42:57', 'd313d1feee4eddab3141cbdd7befdfe8', 0, 'Offline', ''),
(15, 'Safikul Islam', 'safikul@gmail.com', '0123456789', NULL, '$2y$10$bypWh4Fwgkdzd/2dwoMVd.vQzZRVdlbkMM.wAacXTUYi9KnOjQUWa', '6', 1, 'jBcdEb0xjqhyl2Z9A2VhvpFW4gHf4DAKPEnsqZX3LVtjYWFWdUnBxSjilsdQ', '2023-12-11 06:28:26', '2024-01-16 06:56:18', 'ac97c06b3d3467bae78949d43b097c20', 0, 'Online', 'http://127.0.0.1:8000/admin/Employee/1078121593_safikul.jpg.png'),
(16, 'Sandy', 'sandy@yopmail.com', '0123456789', NULL, '$2y$10$/58YlEhNAK/cG4o.Gff/C.4gtYkB0hFyca2jYJtr6PdNXwVHZARKy', '2', 1, NULL, '2023-12-18 04:54:47', '2023-12-27 11:24:16', '', 0, 'Offline', ''),
(17, 'Test Group', 'safikul.islam1@webart.technology', '1234567890', NULL, '$2y$10$Mv44AJ8bhdVQWww23abA/.YAuLAs.Sp5J7.b00NoYeyFuMA/IubmC', '6', 1, NULL, '2023-12-27 10:58:06', '2023-12-27 11:14:02', '611a3249fba738816fec959ebfcc6346', 0, NULL, NULL),
(18, 'Test', 'test@gmail.com', '0123456789', NULL, '$2y$10$Gnp.QkvYpgInQkB3.WZbA.UflxgPhmKQ/wXaSY7k7mon7CIRFXtJq', '6', 1, NULL, '2024-01-03 09:18:26', '2024-01-16 06:30:48', '63fa7808768b87c406e679d0e15d69c5', 852, 'Offline', 'http://127.0.0.1:8000/admin/Employee/1595204603_stripe-logo.png'),
(19, 'Sayandip', 'sayandip@gmail.com', '0123456789', NULL, '$2y$10$pM6O011eLCwr0wJdK8RaE.iDMb2ovP3HOWNDrBbhWHLZrcqkY9BlG', '8', 1, NULL, '2024-01-16 04:29:07', '2024-01-16 05:47:02', '9ee685f5b08c72fb48edc525c5a71bd4', 0, 'Offline', 'http://127.0.0.1:8000/admin/Employee/920466638_blank_chat.png');

-- --------------------------------------------------------

--
-- Table structure for table `workhistories`
--

CREATE TABLE `workhistories` (
  `id` int(11) NOT NULL,
  `developer_job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `final_status` varchar(100) NOT NULL,
  `currenttime` time NOT NULL,
  `delayThen` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workhistories`
--

INSERT INTO `workhistories` (`id`, `developer_job_id`, `user_id`, `final_status`, `currenttime`, `delayThen`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 'start', '00:00:00', 0, '2024-01-15 17:47:53', '2024-01-15 12:17:53'),
(2, 1, 15, 'start', '00:00:16', 0, '2024-01-15 17:53:34', '2024-01-15 12:23:34'),
(3, 1, 15, 'start', '00:01:14', 0, '2024-01-16 09:37:39', '2024-01-16 04:07:39'),
(4, 1, 15, 'start', '00:01:14', 0, '2024-01-16 12:35:25', '2024-01-16 07:05:25'),
(5, 1, 15, 'start', '00:01:14', 0, '2024-01-16 12:38:29', '2024-01-16 07:08:29'),
(6, 1, 15, 'start', '00:13:02', 0, '2024-01-16 12:55:32', '2024-01-16 07:25:32'),
(7, 1, 15, 'start', '00:18:19', 0, '2024-01-16 13:02:40', '2024-01-16 07:32:40'),
(8, 1, 15, 'start', '00:20:16', 0, '2024-01-16 13:05:17', '2024-01-16 07:35:17'),
(9, 1, 15, 'start', '00:25:42', 0, '2024-01-16 13:16:05', '2024-01-16 07:46:05'),
(10, 1, 15, 'start', '00:28:45', 0, '2024-01-16 13:27:14', '2024-01-16 07:57:14'),
(11, 1, 15, 'start', '00:29:20', 0, '2024-01-16 13:27:56', '2024-01-16 07:57:56'),
(12, 1, 15, 'start', '00:29:59', 0, '2024-01-16 14:08:45', '2024-01-16 08:38:45'),
(13, 1, 15, 'start', '00:30:55', 0, '2024-01-16 14:09:48', '2024-01-16 08:39:48'),
(14, 1, 15, 'start', '00:32:13', 0, '2024-01-16 14:11:13', '2024-01-16 08:41:13'),
(15, 1, 15, 'start', '00:32:33', 0, '2024-01-16 14:11:40', '2024-01-16 08:41:40'),
(16, 1, 15, 'start', '00:41:40', 0, '2024-01-16 14:22:25', '2024-01-16 08:52:25'),
(17, 1, 15, 'start', '00:46:19', 0, '2024-01-16 14:27:25', '2024-01-16 08:57:25'),
(18, 1, 15, 'start', '00:46:34', 0, '2024-01-16 14:27:45', '2024-01-16 08:57:45'),
(19, 1, 15, 'start', '00:48:33', 0, '2024-01-16 14:29:47', '2024-01-16 08:59:47'),
(20, 1, 15, 'start', '00:54:38', 0, '2024-01-16 14:38:27', '2024-01-16 09:08:27'),
(21, 1, 15, 'start', '00:57:12', 0, '2024-01-16 14:41:06', '2024-01-16 09:11:06'),
(22, 1, 15, 'start', '00:57:33', 0, '2024-01-16 14:42:44', '2024-01-16 09:12:44'),
(23, 1, 15, 'start', '00:57:38', 0, '2024-01-16 14:42:56', '2024-01-16 09:12:56'),
(24, 1, 15, 'start', '00:58:07', 0, '2024-01-16 14:43:33', '2024-01-16 09:13:33'),
(25, 1, 15, 'start', '01:00:12', 0, '2024-01-16 14:51:02', '2024-01-16 09:21:02'),
(26, 1, 15, 'start', '01:03:10', 0, '2024-01-16 14:58:21', '2024-01-16 09:28:21'),
(27, 1, 15, 'start', '01:07:21', 0, '2024-01-16 15:02:37', '2024-01-16 09:32:37'),
(28, 1, 15, 'start', '01:07:44', 0, '2024-01-16 15:03:03', '2024-01-16 09:33:03'),
(29, 1, 15, 'start', '01:15:23', 0, '2024-01-16 15:10:47', '2024-01-16 09:40:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agents_email_unique` (`email`);

--
-- Indexes for table `assign_logs`
--
ALTER TABLE `assign_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `closers`
--
ALTER TABLE `closers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `closers_email_unique` (`email`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `developer_jobs`
--
ALTER TABLE `developer_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_members_group_id_foreign` (`group_id`);

--
-- Indexes for table `group_names`
--
ALTER TABLE `group_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_histories`
--
ALTER TABLE `log_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `assign_to` (`assign_to`);

--
-- Indexes for table `time_logs`
--
ALTER TABLE `time_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upsales`
--
ALTER TABLE `upsales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `workhistories`
--
ALTER TABLE `workhistories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_logs`
--
ALTER TABLE `assign_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `closers`
--
ALTER TABLE `closers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `developer_jobs`
--
ALTER TABLE `developer_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `group_names`
--
ALTER TABLE `group_names`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `log_histories`
--
ALTER TABLE `log_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `time_logs`
--
ALTER TABLE `time_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=425;

--
-- AUTO_INCREMENT for table `upsales`
--
ALTER TABLE `upsales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `workhistories`
--
ALTER TABLE `workhistories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `group_names` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `assign_to` FOREIGN KEY (`assign_to`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sale_id` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
