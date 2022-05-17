-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2022 at 10:21 AM
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
(1, 1, '2022-05-01 21:47:35', '2022-05-01 23:03:43', '0', NULL, NULL),
(2, 1, '2022-05-01 23:20:06', '2022-05-02 01:27:06', '0', NULL, NULL),
(3, 1, '2022-05-02 13:34:03', '2022-05-02 13:34:07', '0', NULL, NULL),
(4, 1, '2022-05-03 00:19:22', '2022-05-03 09:15:32', '0', NULL, NULL),
(5, 1, '2022-05-03 09:35:58', '2022-05-06 09:20:15', '0', NULL, NULL);

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

--
-- Dumping data for table `machine_descriptions`
--

INSERT INTO `machine_descriptions` (`machine_description_id`, `machine_rooms_check_day_id`, `machine_description_name`, `machine_description_image`, `created_at`, `updated_at`) VALUES
(8, 256, '', 'img/machine/problem/1731735714308919.png', '2022-05-02 17:17:53', '2022-05-02 17:17:53'),
(9, 254, '', 'img/errormachine1732063721036868.png', '2022-05-06 01:11:25', '2022-05-06 01:11:25'),
(10, 254, '', 'img/errormachine1732063721038831.jpg', '2022-05-06 01:11:25', '2022-05-06 01:11:25'),
(11, 254, '', 'img/errormachine1732064067020386.png', '2022-05-06 01:16:55', '2022-05-06 01:16:55'),
(12, 254, '', '1732064173022684.png', '2022-05-06 01:18:36', '2022-05-06 01:18:36'),
(13, 253, '', '1732064236585727.jpg', '2022-05-06 01:19:36', '2022-05-06 01:19:36'),
(14, 253, '', '1732064236589861.jpg', '2022-05-06 01:19:36', '2022-05-06 01:19:36'),
(15, 253, '', '1732064236592533.png', '2022-05-06 01:19:36', '2022-05-06 01:19:36'),
(16, 253, '', '1732064277540903.jpg', '2022-05-06 01:20:15', '2022-05-06 01:20:15'),
(17, 253, '', '1732064277544659.jpg', '2022-05-06 01:20:15', '2022-05-06 01:20:15'),
(18, 253, '', '1732064277547005.png', '2022-05-06 01:20:15', '2022-05-06 01:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `machine_rooms`
--

CREATE TABLE `machine_rooms` (
  `machine_room_id` int(11) NOT NULL,
  `machine_room_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `machine_room_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `machine_room_level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `machine_room_detail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `machine_rooms`
--

INSERT INTO `machine_rooms` (`machine_room_id`, `machine_room_name`, `machine_room_number`, `machine_room_level`, `machine_room_detail`, `created_at`, `updated_at`) VALUES
(2, '', 'EE-01', '4', '', '2022-05-01 08:08:11', '2022-05-01 08:08:11'),
(3, '', 'EE-03', '2', '', '2022-05-02 01:27:42', '2022-05-02 01:27:42'),
(4, '', 'EE-04', '5', '', '2022-05-02 01:39:16', '2022-05-02 01:39:16'),
(5, '', 'EE-09', '2', '', '2022-05-02 15:06:12', '2022-05-02 15:06:12'),
(6, '', 'EE-08', '13', '', '2022-05-02 17:42:49', '2022-05-02 17:42:49'),
(10, '', 'EE-331', '2', '', '2022-05-05 20:50:32', '2022-05-05 20:50:32');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `machine_rooms_check_days`
--

INSERT INTO `machine_rooms_check_days` (`machine_rooms_check_day_id`, `machine_room_id`, `machine_rooms_check_day_status`, `machine_rooms_check_day_description`, `shift_worker_time`, `machine_room_problem`, `created_at`, `updated_at`) VALUES
(253, 2, 'พบปัญหาและแก้ไขแล้ว', '', 1, 'wedewwe', '2022-05-02 17:12:36', '2022-05-06 01:19:36'),
(254, 2, 'พบปัญหาและแก้ไขแล้ว', '', 2, 'asd', '2022-05-02 17:12:36', '2022-05-06 01:14:21'),
(255, 2, 'พบปัญหา', '', 3, 'asd', '2022-05-02 17:12:36', '2022-05-06 00:47:25'),
(256, 3, 'พบปัญหา', '', 1, 'พัง', '2022-05-02 17:12:36', '2022-05-02 17:17:53'),
(257, 3, 'พบปัญหาและแก้ไขแล้ว', '', 2, '', '2022-05-02 17:12:36', '2022-05-02 17:12:36'),
(258, 3, 'ยังไม่ตรวจสอบ', '', 3, '', '2022-05-02 17:12:36', '2022-05-02 17:12:36'),
(259, 4, 'ยังไม่ตรวจสอบ', '', 1, '', '2022-05-02 17:12:36', '2022-05-02 17:12:36'),
(260, 4, 'ยังไม่ตรวจสอบ', '', 2, '', '2022-05-02 17:12:36', '2022-05-02 17:12:36'),
(261, 4, 'ยังไม่ตรวจสอบ', '', 3, '', '2022-05-02 17:12:36', '2022-05-02 17:12:36'),
(262, 5, 'ยังไม่ตรวจสอบ', '', 1, '', '2022-05-02 17:12:36', '2022-05-02 17:12:36'),
(263, 5, 'ยังไม่ตรวจสอบ', '', 2, '', '2022-05-02 17:12:36', '2022-05-02 17:12:36'),
(264, 5, 'ยังไม่ตรวจสอบ', '', 3, '', '2022-05-02 17:12:36', '2022-05-02 17:12:36'),
(265, 6, 'ปกติ', '', 1, '', '2022-05-02 17:42:49', '2022-05-02 17:43:00'),
(266, 6, 'ยังไม่ตรวจสอบ', '', 2, '', '2022-05-02 17:42:49', '2022-05-02 17:42:49'),
(267, 6, 'ยังไม่ตรวจสอบ', '', 3, '', '2022-05-02 17:42:49', '2022-05-02 17:42:49'),
(271, 10, 'ยังไม่ตรวจสอบ', '', 1, '', '2022-05-05 20:50:32', '2022-05-05 20:50:32'),
(272, 10, 'ยังไม่ตรวจสอบ', '', 2, '', '2022-05-05 20:50:32', '2022-05-05 20:50:32'),
(273, 10, 'ยังไม่ตรวจสอบ', '', 3, '', '2022-05-05 20:50:32', '2022-05-05 20:50:32');

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
(6, '2022_05_01_084040_create_user_accounts_table', 1);

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
(1, 'Admin', '123123', 'อาทิตย์', 'ศรีจันทร์', '2022-05-01 16:46:56', '', '', '2022-05-01 16:46:56', '', 0, 0, 0, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dateofworks`
--
ALTER TABLE `dateofworks`
  ADD PRIMARY KEY (`datework_id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `dateofworks`
--
ALTER TABLE `dateofworks`
  MODIFY `datework_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `machine_descriptions`
--
ALTER TABLE `machine_descriptions`
  MODIFY `machine_description_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `machine_rooms`
--
ALTER TABLE `machine_rooms`
  MODIFY `machine_room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `machine_rooms_check_days`
--
ALTER TABLE `machine_rooms_check_days`
  MODIFY `machine_rooms_check_day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dateofworks`
--
ALTER TABLE `dateofworks`
  ADD CONSTRAINT `dateofworks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_accounts` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
