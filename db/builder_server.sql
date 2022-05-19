-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 08:15 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `builder_server`
--

-- --------------------------------------------------------

--
-- Table structure for table `check_processes`
--

CREATE TABLE `check_processes` (
  `log_id` int(11) NOT NULL,
  `log_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_prosessing` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_agent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dateofworks`
--

CREATE TABLE `dateofworks` (
  `datework_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_start_work` datetime NOT NULL,
  `date_off_work` datetime NOT NULL,
  `datework_check` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dateofworks`
--

INSERT INTO `dateofworks` (`datework_id`, `user_id`, `date_start_work`, `date_off_work`, `datework_check`, `created_at`, `updated_at`) VALUES
(13, 1, '2022-05-12 10:31:10', '2022-05-12 10:33:54', '0', NULL, NULL),
(14, 1, '2022-05-12 10:33:56', '2022-05-12 11:10:21', '0', NULL, NULL),
(15, 2, '2022-05-12 11:05:31', '2022-05-12 11:05:37', '0', NULL, NULL),
(16, 2, '2022-05-12 11:05:44', '2022-05-12 11:05:50', '0', NULL, NULL),
(17, 2, '2022-05-12 11:06:57', '2022-05-12 11:09:00', '0', NULL, NULL),
(18, 1, '2022-05-12 13:39:34', '2022-05-12 13:39:45', '0', NULL, NULL),
(19, 1, '2022-05-12 13:40:01', '2022-05-12 13:40:16', '0', NULL, NULL),
(20, 1, '2022-05-12 14:29:53', '2022-05-16 12:07:36', '0', NULL, NULL),
(21, 1, '2022-05-17 16:09:36', '0000-00-00 00:00:00', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `date_for_checkings`
--

CREATE TABLE `date_for_checkings` (
  `date_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `date_for_checkings`
--

INSERT INTO `date_for_checkings` (`date_id`, `start_date`, `end_date`) VALUES
(1, '2022-05-18 07:00:00', '2022-05-19 06:59:59'),
(2, '2022-05-19 07:00:00', '2022-05-20 06:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `list_of_imgs`
--

CREATE TABLE `list_of_imgs` (
  `img_repair_id` int(11) NOT NULL,
  `list_repair_id` int(11) NOT NULL,
  `img_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `list_of_imgs`
--

INSERT INTO `list_of_imgs` (`img_repair_id`, `list_repair_id`, `img_name`, `img_description`, `created_at`, `updated_at`) VALUES
(2, 12, '1733138025729083.png', '', '2022-05-18 04:47:01', '2022-05-18 04:47:01'),
(3, 12, '1733138025732029.jpg', '', '2022-05-18 04:47:01', '2022-05-18 04:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `list_of_repairs`
--

CREATE TABLE `list_of_repairs` (
  `list_repair_id` int(11) NOT NULL,
  `date_of_report` datetime NOT NULL,
  `list_report` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_repair` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `editor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approve_report` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bookmark_checked` tinyint(1) NOT NULL,
  `processing_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `list_of_repairs`
--

INSERT INTO `list_of_repairs` (`list_repair_id`, `date_of_report`, `list_report`, `status_repair`, `notifier`, `editor`, `operator`, `description`, `approve_report`, `bookmark_checked`, `processing_date`, `created_at`, `updated_at`) VALUES
(1, '2022-05-18 09:24:27', 'ทดสอบการทำงานของระบบ', 'ดำเนินการสำเร็จ', 'อาทิตย์ (am)', '', '', '1.ทดสอบการดำเนินการทั้งหมด\r\n2.ทดสอบการดำเนินการทั้งหมด', '', 0, '', NULL, NULL),
(2, '2022-05-02 09:25:47', 'ทดสอบการทำงานของระบบรูปแบบสอง', 'ยังไม่ดำเนินการ', 'อาทิตย์ (am)', '', '', '', '', 0, '', NULL, NULL),
(3, '2022-05-18 10:46:08', 'ทดสอบการทำงาน 3', 'ยังไม่ดำเนินการ', 'อาทิตย์ (am)', '', '', '', '', 0, '', NULL, NULL),
(4, '2022-05-18 10:46:22', 'ทดสอบการทำงาน 4', 'ยังไม่ดำเนินการ', 'อาทิตย์ (am)', '', '', '', '', 0, '', NULL, NULL),
(5, '2022-05-18 10:47:03', 'ทดสอบการทำงาน 5', 'กำลังดำเนินการ', 'อาทิตย์ (am)', '', '', '', '', 0, '', NULL, NULL),
(6, '2022-05-18 10:47:10', 'ทดสอบการทำงาน 6', 'ยังไม่ดำเนินการ', 'อาทิตย์ (am)', '', '', '', '', 1, '', NULL, NULL),
(7, '2022-05-18 10:47:16', 'ทดสอบการทำงาน 7', 'ยังไม่ดำเนินการ', 'อาทิตย์ (am)', '', '', '', '', 0, '', NULL, NULL),
(8, '2022-05-18 10:47:22', 'ทดสอบการทำงาน 8', 'ยังไม่ดำเนินการ', 'อาทิตย์ (am)', '', '', '', '', 0, '', NULL, NULL),
(9, '2022-05-18 10:47:29', 'ทดสอบการทำงาน 9', 'ยังไม่ดำเนินการ', 'อาทิตย์ (am)', '', '', '', '', 0, '', NULL, NULL),
(10, '2022-05-18 10:47:36', 'ทดสอบการทำงาน 10', 'ยังไม่ดำเนินการ', 'อาทิตย์ (am)', '', '', '', '', 0, '', NULL, NULL),
(11, '2022-05-18 10:48:57', 'ทดสอบการทำงาน 11', 'ยังไม่ดำเนินการ', 'อาทิตย์ (am)', '', '', '', '', 0, '', NULL, NULL),
(12, '2022-05-18 11:47:01', 'ทดสอบรูปภาพ', 'ดำเนินการสำเร็จ', 'อาทิตย์ (am)', '', '', '', '', 1, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `machine_descriptions`
--

CREATE TABLE `machine_descriptions` (
  `machine_description_id` int(11) NOT NULL,
  `machine_rooms_check_day_id` int(11) NOT NULL,
  `machine_description_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `machine_description_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `machine_rooms`
--

CREATE TABLE `machine_rooms` (
  `machine_room_id` int(11) NOT NULL,
  `machine_room_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `machine_room_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `machine_room_level` int(11) NOT NULL,
  `machine_room_detail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `machine_rooms`
--

INSERT INTO `machine_rooms` (`machine_room_id`, `machine_room_name`, `machine_room_number`, `machine_room_level`, `machine_room_detail`, `created_at`, `updated_at`) VALUES
(3, '', 'EE-03', 2, '', '2022-05-02 01:27:42', '2022-05-02 01:27:42'),
(4, '', 'EE-04', 5, '', '2022-05-02 01:39:16', '2022-05-02 01:39:16'),
(5, '', 'EE-09', 2, '', '2022-05-02 15:06:12', '2022-05-02 15:06:12'),
(6, '', 'EE-1', 1, 'ทดสอบการทำงานของระบบ', '2022-05-02 17:42:49', '2022-05-11 06:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `machine_rooms_check_days`
--

CREATE TABLE `machine_rooms_check_days` (
  `machine_rooms_check_day_id` int(11) NOT NULL,
  `machine_room_id` int(11) NOT NULL,
  `machine_rooms_check_day_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `machine_rooms_check_day_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift_worker_time` int(11) NOT NULL,
  `machine_room_problem` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_for_checked` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `machine_rooms_check_days`
--

INSERT INTO `machine_rooms_check_days` (`machine_rooms_check_day_id`, `machine_room_id`, `machine_rooms_check_day_status`, `machine_rooms_check_day_description`, `shift_worker_time`, `machine_room_problem`, `img_for_checked`, `created_at`, `updated_at`) VALUES
(583, 4, 'ปกติ', '', 1, '', '1732712390024266413-05-2022-19-01-44.jpg', '2022-05-13 07:18:29', '2022-05-13 12:01:44'),
(584, 4, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-13 07:18:29', '2022-05-13 07:18:29'),
(585, 4, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-13 07:18:29', '2022-05-13 07:18:29'),
(586, 3, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-13 07:18:29', '2022-05-13 07:18:29'),
(587, 3, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-13 07:18:29', '2022-05-13 07:18:29'),
(588, 3, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-13 07:18:29', '2022-05-13 07:18:29'),
(589, 5, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-13 07:18:29', '2022-05-13 07:18:29'),
(590, 5, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-13 07:18:29', '2022-05-13 07:18:29'),
(591, 5, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-13 07:18:29', '2022-05-13 07:18:29'),
(592, 6, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-13 07:18:29', '2022-05-13 07:18:29'),
(593, 6, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-13 07:18:29', '2022-05-13 07:18:29'),
(594, 6, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-13 07:18:29', '2022-05-13 07:18:29'),
(595, 4, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-16 03:59:40', '2022-05-16 03:59:40'),
(596, 4, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-16 03:59:40', '2022-05-16 03:59:40'),
(597, 4, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-16 03:59:40', '2022-05-16 03:59:40'),
(598, 3, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-16 03:59:40', '2022-05-16 03:59:40'),
(599, 3, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-16 03:59:40', '2022-05-16 03:59:40'),
(600, 3, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-16 03:59:40', '2022-05-16 03:59:40'),
(601, 5, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-16 03:59:40', '2022-05-16 03:59:40'),
(602, 5, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-16 03:59:40', '2022-05-16 03:59:40'),
(603, 5, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-16 03:59:40', '2022-05-16 03:59:40'),
(604, 6, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-16 03:59:40', '2022-05-16 03:59:40'),
(605, 6, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-16 03:59:40', '2022-05-16 03:59:40'),
(606, 6, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-16 03:59:40', '2022-05-16 03:59:40'),
(607, 4, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-17 04:18:24', '2022-05-17 04:18:24'),
(608, 4, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-17 04:18:24', '2022-05-17 04:18:24'),
(609, 4, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-17 04:18:24', '2022-05-17 04:18:24'),
(610, 3, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-17 04:18:24', '2022-05-17 04:18:24'),
(611, 3, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-17 04:18:24', '2022-05-17 04:18:24'),
(612, 3, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-17 04:18:24', '2022-05-17 04:18:24'),
(613, 5, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-17 04:18:24', '2022-05-17 04:18:24'),
(614, 5, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-17 04:18:24', '2022-05-17 04:18:24'),
(615, 5, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-17 04:18:24', '2022-05-17 04:18:24'),
(616, 6, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-17 04:18:24', '2022-05-17 04:18:24'),
(617, 6, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-17 04:18:24', '2022-05-17 04:18:24'),
(618, 6, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-17 04:18:24', '2022-05-17 04:18:24'),
(619, 4, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-18 01:41:29', '2022-05-18 01:41:29'),
(620, 4, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-18 01:41:29', '2022-05-18 01:41:29'),
(621, 4, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-18 01:41:29', '2022-05-18 01:41:29'),
(622, 3, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-18 01:41:29', '2022-05-18 01:41:29'),
(623, 3, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-18 01:41:29', '2022-05-18 01:41:29'),
(624, 3, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-18 01:41:29', '2022-05-18 01:41:29'),
(625, 5, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-18 01:41:29', '2022-05-18 01:41:29'),
(626, 5, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-18 01:41:29', '2022-05-18 01:41:29'),
(627, 5, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-18 01:41:29', '2022-05-18 01:41:29'),
(628, 6, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-18 01:41:29', '2022-05-18 01:41:29'),
(629, 6, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-18 01:41:29', '2022-05-18 01:41:29'),
(630, 6, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-18 01:41:29', '2022-05-18 01:41:29'),
(631, 4, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-19 05:23:20', '2022-05-19 05:23:20'),
(632, 4, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-19 05:23:20', '2022-05-19 05:23:20'),
(633, 4, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-19 05:23:20', '2022-05-19 05:23:20'),
(634, 3, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-19 05:23:20', '2022-05-19 05:23:20'),
(635, 3, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-19 05:23:20', '2022-05-19 05:23:20'),
(636, 3, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-19 05:23:20', '2022-05-19 05:23:20'),
(637, 5, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-19 05:23:20', '2022-05-19 05:23:20'),
(638, 5, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-19 05:23:20', '2022-05-19 05:23:20'),
(639, 5, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-19 05:23:20', '2022-05-19 05:23:20'),
(640, 6, 'ยังไม่ตรวจสอบ', '', 1, '', '', '2022-05-19 05:23:20', '2022-05-19 05:23:20'),
(641, 6, 'ยังไม่ตรวจสอบ', '', 2, '', '', '2022-05-19 05:23:20', '2022-05-19 05:23:20'),
(642, 6, 'ยังไม่ตรวจสอบ', '', 3, '', '', '2022-05-19 05:23:20', '2022-05-19 05:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_04_29_122337_create_dateofworks_table', 1),
(3, '2022_05_01_055524_create_machine_rooms_table', 1),
(4, '2022_05_01_061715_create_machine_descriptions_table', 1),
(5, '2022_05_01_062409_create_machine_rooms_check_days_table', 1),
(6, '2022_05_01_084040_create_user_accounts_table', 1),
(13, '2022_05_09_082518_create_date_for_checkings_table', 2),
(14, '2022_05_10_033733_create_check_processes_table', 2),
(15, '2022_05_17_030920_create_list_of_repairs_table', 2),
(16, '2022_05_17_040653_create_list_of_imgs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_pass` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_begindatetowork` datetime NOT NULL,
  `user_img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_contrack` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_birth` datetime NOT NULL,
  `user_nickname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_rule_status` int(11) NOT NULL,
  `user_sick_leave` int(11) NOT NULL,
  `user_personal_leave` int(11) NOT NULL,
  `user_vacation_leave` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`user_id`, `user_name`, `user_pass`, `user_firstname`, `user_lastname`, `user_begindatetowork`, `user_img`, `user_contrack`, `user_birth`, `user_nickname`, `user_rule_status`, `user_sick_leave`, `user_personal_leave`, `user_vacation_leave`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '123123', 'อาทิตย์', 'ศรีจันทร์', '2022-05-01 00:00:00', '', '', '2022-05-01 00:00:00', 'am', 0, 0, 0, 0, NULL, NULL),
(2, '123123', '123123', 'พนักงาน', 'ฝ่ายอาคาร', '2022-04-01 00:00:00', 'logo.png', '', '1997-02-23 00:00:00', 'พนง.', 1, 0, 0, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `check_processes`
--
ALTER TABLE `check_processes`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `dateofworks`
--
ALTER TABLE `dateofworks`
  ADD PRIMARY KEY (`datework_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `date_for_checkings`
--
ALTER TABLE `date_for_checkings`
  ADD PRIMARY KEY (`date_id`);

--
-- Indexes for table `list_of_imgs`
--
ALTER TABLE `list_of_imgs`
  ADD PRIMARY KEY (`img_repair_id`),
  ADD KEY `list_repair_id` (`list_repair_id`);

--
-- Indexes for table `list_of_repairs`
--
ALTER TABLE `list_of_repairs`
  ADD PRIMARY KEY (`list_repair_id`);

--
-- Indexes for table `machine_descriptions`
--
ALTER TABLE `machine_descriptions`
  ADD PRIMARY KEY (`machine_description_id`),
  ADD KEY `machine_rooms_check_day_id` (`machine_rooms_check_day_id`);

--
-- Indexes for table `machine_rooms`
--
ALTER TABLE `machine_rooms`
  ADD PRIMARY KEY (`machine_room_id`);

--
-- Indexes for table `machine_rooms_check_days`
--
ALTER TABLE `machine_rooms_check_days`
  ADD PRIMARY KEY (`machine_rooms_check_day_id`),
  ADD KEY `machine_room_id` (`machine_room_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `check_processes`
--
ALTER TABLE `check_processes`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dateofworks`
--
ALTER TABLE `dateofworks`
  MODIFY `datework_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `date_for_checkings`
--
ALTER TABLE `date_for_checkings`
  MODIFY `date_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `list_of_imgs`
--
ALTER TABLE `list_of_imgs`
  MODIFY `img_repair_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `list_of_repairs`
--
ALTER TABLE `list_of_repairs`
  MODIFY `list_repair_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `machine_descriptions`
--
ALTER TABLE `machine_descriptions`
  MODIFY `machine_description_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `machine_rooms`
--
ALTER TABLE `machine_rooms`
  MODIFY `machine_room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `machine_rooms_check_days`
--
ALTER TABLE `machine_rooms_check_days`
  MODIFY `machine_rooms_check_day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=643;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dateofworks`
--
ALTER TABLE `dateofworks`
  ADD CONSTRAINT `dateofworks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_accounts` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `list_of_imgs`
--
ALTER TABLE `list_of_imgs`
  ADD CONSTRAINT `list_of_imgs_ibfk_1` FOREIGN KEY (`list_repair_id`) REFERENCES `list_of_repairs` (`list_repair_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `machine_descriptions`
--
ALTER TABLE `machine_descriptions`
  ADD CONSTRAINT `machine_descriptions_ibfk_1` FOREIGN KEY (`machine_rooms_check_day_id`) REFERENCES `machine_rooms_check_days` (`machine_rooms_check_day_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `machine_rooms_check_days`
--
ALTER TABLE `machine_rooms_check_days`
  ADD CONSTRAINT `machine_rooms_check_days_ibfk_1` FOREIGN KEY (`machine_room_id`) REFERENCES `machine_rooms` (`machine_room_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
