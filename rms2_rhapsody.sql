-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2022 at 08:17 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rms2_rhapsody`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_present` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `is_leave` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `checkin_time` time DEFAULT NULL,
  `checkout_time` time DEFAULT NULL,
  `is_leave_approved` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `leave_approved_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_trial_details`
--

CREATE TABLE `audit_trial_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_trial_details`
--

INSERT INTO `audit_trial_details` (`id`, `date`, `time`, `ip_address`, `country`, `description`, `type`, `status`, `device`, `role_id`, `created_by`, `is_active`, `created_at`, `updated_at`) VALUES
(344749, '2022-02-09', '15:56:41', '127.0.0.1', 'Not Found', 'Ajith (Emp101/Top Management) Logged In', 'Log_In', 'success', 'Mobile', 8, 'Emp101', '1', '2022-02-09 10:26:41', '2022-02-09 10:26:41'),
(344750, '2022-02-09', '16:41:27', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) new store added', 'Store', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:11:27', '2022-02-09 11:11:27'),
(344751, '2022-02-09', '16:41:59', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) new store added', 'Store', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:11:59', '2022-02-09 11:11:59'),
(344752, '2022-02-09', '16:42:29', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) new store added', 'Store', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:12:29', '2022-02-09 11:12:29'),
(344753, '2022-02-09', '16:52:18', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) added a brand(Galaxy)', 'Brand', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:22:18', '2022-02-09 11:22:18'),
(344754, '2022-02-09', '16:52:42', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) added a brand(5 star)', 'Brand', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:22:42', '2022-02-09 11:22:42'),
(344755, '2022-02-09', '16:59:10', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) added a product(Galazy 10G)', 'Product', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:29:10', '2022-02-09 11:29:10'),
(344756, '2022-02-09', '17:00:13', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) added a product(5 star 25g)', 'Product', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:30:13', '2022-02-09 11:30:13'),
(344757, '2022-02-09', '17:01:06', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) added a product(Good Day)', 'Product', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:31:06', '2022-02-09 11:31:06'),
(344758, '2022-02-09', '17:03:50', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) added a outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:33:50', '2022-02-09 11:33:50'),
(344759, '2022-02-09', '17:04:39', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) added a outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:34:39', '2022-02-09 11:34:39'),
(344760, '2022-02-09', '17:05:14', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) added a outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:35:14', '2022-02-09 11:35:14'),
(344761, '2022-02-09', '17:07:50', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) added a nbl to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:37:50', '2022-02-09 11:37:50'),
(344762, '2022-02-09', '17:07:50', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:37:50', '2022-02-09 11:37:50'),
(344763, '2022-02-09', '17:07:51', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:37:51', '2022-02-09 11:37:51'),
(344764, '2022-02-09', '17:07:51', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:37:51', '2022-02-09 11:37:51'),
(344765, '2022-02-09', '17:07:51', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:37:51', '2022-02-09 11:37:51'),
(344766, '2022-02-09', '17:07:51', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:37:51', '2022-02-09 11:37:51'),
(344767, '2022-02-09', '17:07:51', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:37:51', '2022-02-09 11:37:51'),
(344768, '2022-02-09', '17:08:50', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:38:50', '2022-02-09 11:38:50'),
(344769, '2022-02-09', '17:08:50', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:38:50', '2022-02-09 11:38:50'),
(344770, '2022-02-09', '17:08:50', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:38:50', '2022-02-09 11:38:50'),
(344771, '2022-02-09', '17:08:50', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:38:50', '2022-02-09 11:38:50'),
(344772, '2022-02-09', '17:08:50', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:38:50', '2022-02-09 11:38:50'),
(344773, '2022-02-09', '17:08:50', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:38:50', '2022-02-09 11:38:50'),
(344774, '2022-02-09', '17:09:46', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:39:46', '2022-02-09 11:39:46'),
(344775, '2022-02-09', '17:09:46', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:39:46', '2022-02-09 11:39:46'),
(344776, '2022-02-09', '17:09:46', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:39:46', '2022-02-09 11:39:46'),
(344777, '2022-02-09', '17:09:46', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:39:46', '2022-02-09 11:39:46'),
(344778, '2022-02-09', '17:09:46', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:39:46', '2022-02-09 11:39:46'),
(344779, '2022-02-09', '17:09:46', '127.0.0.1', 'Not Found', 'Mars(Emp3289/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp3289', '1', '2022-02-09 11:39:46', '2022-02-09 11:39:46'),
(344780, '2022-02-09', '17:13:03', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) new store added', 'Store', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:43:03', '2022-02-09 11:43:03'),
(344781, '2022-02-09', '17:13:48', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) new store added', 'Store', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:43:48', '2022-02-09 11:43:48'),
(344782, '2022-02-09', '17:14:09', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) new store added', 'Store', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:44:09', '2022-02-09 11:44:09'),
(344783, '2022-02-09', '17:15:20', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) added a brand(Coco cola)', 'Brand', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:45:20', '2022-02-09 11:45:20'),
(344784, '2022-02-09', '17:17:15', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) added a product(coco cola 1lrt)', 'Product', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:47:15', '2022-02-09 11:47:15'),
(344785, '2022-02-09', '17:18:15', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) added a product(sprite 1ltr)', 'Product', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:48:15', '2022-02-09 11:48:15'),
(344786, '2022-02-09', '17:19:05', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) added a outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:49:05', '2022-02-09 11:49:05'),
(344787, '2022-02-09', '17:19:38', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) added a outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:49:38', '2022-02-09 11:49:38'),
(344788, '2022-02-09', '17:20:11', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) added a outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:50:11', '2022-02-09 11:50:11'),
(344789, '2022-02-09', '17:21:49', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49'),
(344790, '2022-02-09', '17:21:49', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49'),
(344791, '2022-02-09', '17:21:49', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49'),
(344792, '2022-02-09', '17:21:49', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49'),
(344793, '2022-02-09', '17:21:49', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49'),
(344794, '2022-02-09', '17:21:49', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49'),
(344795, '2022-02-09', '17:21:49', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49'),
(344796, '2022-02-09', '17:21:49', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49'),
(344797, '2022-02-09', '17:21:49', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49'),
(344798, '2022-02-09', '17:21:49', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49'),
(344799, '2022-02-09', '17:21:49', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49'),
(344800, '2022-02-09', '17:21:49', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49'),
(344801, '2022-02-09', '17:21:49', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49'),
(344802, '2022-02-09', '17:21:49', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49'),
(344803, '2022-02-09', '17:23:54', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54'),
(344804, '2022-02-09', '17:23:54', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54'),
(344805, '2022-02-09', '17:23:54', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54'),
(344806, '2022-02-09', '17:23:54', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54'),
(344807, '2022-02-09', '17:23:54', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54'),
(344808, '2022-02-09', '17:23:54', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54'),
(344809, '2022-02-09', '17:23:54', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54'),
(344810, '2022-02-09', '17:23:54', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54'),
(344811, '2022-02-09', '17:23:54', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54'),
(344812, '2022-02-09', '17:23:54', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54'),
(344813, '2022-02-09', '17:23:54', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54'),
(344814, '2022-02-09', '17:23:54', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54'),
(344815, '2022-02-09', '17:23:54', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54'),
(344816, '2022-02-09', '17:23:54', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54'),
(344817, '2022-02-09', '17:26:00', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:56:00', '2022-02-09 11:56:00'),
(344818, '2022-02-09', '17:26:00', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:56:00', '2022-02-09 11:56:00'),
(344819, '2022-02-09', '17:26:01', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01'),
(344820, '2022-02-09', '17:26:01', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01'),
(344821, '2022-02-09', '17:26:01', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01'),
(344822, '2022-02-09', '17:26:01', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01'),
(344823, '2022-02-09', '17:26:01', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01'),
(344824, '2022-02-09', '17:26:01', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01'),
(344825, '2022-02-09', '17:26:01', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01'),
(344826, '2022-02-09', '17:26:01', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01'),
(344827, '2022-02-09', '17:26:01', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01'),
(344828, '2022-02-09', '17:26:01', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01'),
(344829, '2022-02-09', '17:26:01', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01'),
(344830, '2022-02-09', '17:26:01', '127.0.0.1', 'Not Found', 'Coco(Emp7367/Client) categories added to outlet', 'outlet', 'success', 'Web', 7, 'Emp7367', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01'),
(344831, '2022-02-09', '17:32:18', '127.0.0.1', 'Not Found', 'Field(Emp104/Field Manager) added new scheduled timesheet to (Emp102)', 'journey_plan', 'success', 'Web', 5, 'Emp104', '1', '2022-02-09 12:02:18', '2022-02-09 12:02:18'),
(344832, '2022-02-09', '17:33:21', '127.0.0.1', 'Not Found', 'Coco(Emp105/Field Manager) added new scheduled timesheet to (Emp103)', 'journey_plan', 'success', 'Web', 5, 'Emp105', '1', '2022-02-09 12:03:21', '2022-02-09 12:03:21'),
(344833, '2022-02-09', '17:34:57', '127.0.0.1', 'Not Found', 'merchandiser(Emp102/Merchandiser) check in VKR MALL[STR001],vellore,DUBAI', 'CheckIn', 'success', 'Web', 6, 'Emp102', '1', '2022-02-09 12:04:57', '2022-02-09 12:04:57'),
(344834, '2022-02-09', '17:35:09', '127.0.0.1', 'Not Found', 'merchandiser(Emp102/Merchandiser) updated availability in VKR MALL[STR001],vellore,DUBAI', 'Availability', 'success', 'Web', 6, 'Emp102', '1', '2022-02-09 12:05:09', '2022-02-09 12:05:09'),
(344835, '2022-02-09', '17:36:53', '127.0.0.1', 'Not Found', 'Ajith (Emp101/Top Management) Logged In', 'Log_In', 'success', 'Mobile', 8, 'Emp101', '1', '2022-02-09 12:06:53', '2022-02-09 12:06:53'),
(344836, '2022-02-09', '17:41:56', '127.0.0.1', 'Not Found', 'Ajith (Emp101/Top Management) Logged In', 'Log_In', 'success', 'Mobile', 8, 'Emp101', '1', '2022-02-09 12:11:56', '2022-02-09 12:11:56'),
(344837, '2022-02-10', '09:01:02', '127.0.0.1', 'Not Found', 'Ajith(Emp101/Top Management)changed his name / email ', 'Profile', 'success', 'Web', 8, 'Emp101', '1', '2022-02-10 03:31:02', '2022-02-10 03:31:02'),
(344838, '2022-02-10', '09:43:07', '127.0.0.1', 'Not Found', 'merchandiser(Emp102/Merchandiser) check in VKR MALL[STR001],vellore,DUBAI', 'CheckIn', 'success', 'Web', 6, 'Emp102', '1', '2022-02-10 04:13:07', '2022-02-10 04:13:07'),
(344839, '2022-02-10', '09:43:41', '127.0.0.1', 'Not Found', 'merchant_coco(Emp103/Merchandiser) check in COC1[COC001],UAE,DUBAI', 'CheckIn', 'success', 'Web', 6, 'Emp103', '1', '2022-02-10 04:13:41', '2022-02-10 04:13:41'),
(344840, '2022-02-10', '09:44:08', '127.0.0.1', 'Not Found', 'merchant_coco(Emp103/Merchandiser) checked again in COC1[COC001],UAE,DUBAI', 'CheckIn', 'success', 'Web', 6, 'Emp103', '1', '2022-02-10 04:14:08', '2022-02-10 04:14:08'),
(344841, '2022-02-17', '08:57:37', '127.0.0.1', 'Not Found', 'merchandiser (Emp102/Merchandiser) Logged In', 'Log_In', 'success', 'Mobile', 6, 'Emp102', '1', '2022-02-17 03:27:37', '2022-02-17 03:27:37'),
(344842, '2022-02-17', '08:58:53', '127.0.0.1', 'Not Found', 'merchandiser (Emp102/Merchandiser) Logged In', 'Log_In', 'success', 'Mobile', 6, 'Emp102', '1', '2022-02-17 03:28:53', '2022-02-17 03:28:53'),
(344843, '2022-02-17', '09:04:06', '127.0.0.1', 'Not Found', 'merchandiser (Emp102/Merchandiser) Logged In', 'Log_In', 'success', 'Mobile', 6, 'Emp102', '1', '2022-02-17 03:34:06', '2022-02-17 03:34:06'),
(344844, '2022-02-17', '09:07:47', '127.0.0.1', 'Not Found', 'Field(Emp104/Field Manager) added new scheduled timesheet to (Emp102)', 'journey_plan', 'success', 'Web', 5, 'Emp104', '1', '2022-02-17 03:37:47', '2022-02-17 03:37:47'),
(344845, '2022-02-17', '09:09:49', '127.0.0.1', 'Not Found', 'merchandiser (Emp102/Merchandiser) Logged In', 'Log_In', 'success', 'Mobile', 6, 'Emp102', '1', '2022-02-17 03:39:49', '2022-02-17 03:39:49'),
(344846, '2022-02-17', '09:20:48', '127.0.0.1', 'Not Found', 'merchandiser (Emp102/Merchandiser) Logged In', 'Log_In', 'success', 'Mobile', 6, 'Emp102', '1', '2022-02-17 03:50:48', '2022-02-17 03:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `outlet_products_mapping_id` int(10) UNSIGNED DEFAULT NULL,
  `outlet_id` int(10) UNSIGNED NOT NULL,
  `timesheet_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`id`, `date`, `outlet_products_mapping_id`, `outlet_id`, `timesheet_id`, `category_id`, `product_id`, `brand_name`, `category_name`, `product_name`, `is_available`, `reason`, `remarks`, `is_active`, `created_at`, `updated_at`, `created_by`, `device`) VALUES
(173265, '2022-02-09', 71053, 5237, 191598, NULL, 890, 'Galaxy', 'CHOCOLATE', 'Galazy 10G', '1', NULL, NULL, '1', '2022-02-09 12:05:09', '2022-02-09 12:05:09', 'Emp102', NULL),
(173266, '2022-02-09', 71053, 5237, 191598, NULL, 891, '5 star', 'CHOCOLATE', '5 star 25g', '1', NULL, NULL, '1', '2022-02-09 12:05:09', '2022-02-09 12:05:09', 'Emp102', NULL),
(173267, '2022-02-09', 71056, 5237, 191598, NULL, 892, 'Galaxy', 'BISCUITS', 'Good Day', '1', NULL, NULL, '1', '2022-02-09 12:05:09', '2022-02-09 12:05:09', 'Emp102', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand_details`
--

CREATE TABLE `brand_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_manager_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_manager_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_details`
--

INSERT INTO `brand_details` (`id`, `brand_name`, `client_id`, `field_manager_id`, `sales_manager_id`, `created_by`, `updated_by`, `is_active`, `created_at`, `updated_at`, `device`) VALUES
(63, 'Galaxy', 'Emp3289', 'Emp104', 'Emp110', 'Emp3289', NULL, '1', '2022-02-09 11:22:18', '2022-02-09 11:22:18', NULL),
(64, '5 star', 'Emp3289', 'Emp104', 'Emp110', 'Emp3289', NULL, '1', '2022-02-09 11:22:42', '2022-02-09 11:22:42', NULL),
(65, 'Coco cola', 'Emp7367', 'Emp105', 'Emp110', 'Emp7367', NULL, '1', '2022-02-09 11:45:20', '2022-02-09 11:45:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_details`
--

CREATE TABLE `category_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_details`
--

INSERT INTO `category_details` (`id`, `category_name`, `is_active`, `created_at`, `created_by`, `updated_at`, `device`) VALUES
(6, 'CHOCOLATE', '1', '2021-04-12 12:41:29', 'Emp3289', NULL, NULL),
(7, 'Cookies', '0', '2021-04-12 14:09:45', 'Emp3289', NULL, NULL),
(8, 'PET FOOD', '1', '2021-04-14 14:23:54', 'Emp3289', NULL, NULL),
(9, 'ICE CREAM', '1', '2021-04-23 11:53:39', 'Emp3289', NULL, 'Mobile'),
(10, 'Oreo', '0', '2021-04-27 16:59:31', 'Emp3289', NULL, 'Mobile'),
(11, 'BISCUITS', '1', '2021-04-27 17:09:53', 'Emp3289', NULL, 'Mobile'),
(12, 'Health Drinks', '0', '2021-05-05 11:37:02', 'Emp3289', NULL, 'Mobile'),
(13, 'Tetra Pack Food', '0', '2021-05-19 14:27:57', 'Emp3289', NULL, 'Mobile'),
(26, 'Be Kind(Protein Bar,Cereal Bar)', '1', '2021-05-26 16:11:26', 'Emp3289', '2021-05-26 16:11:26', NULL),
(27, 'PASTA SAUCE', '1', '2021-05-26 16:12:05', 'Emp3289', '2021-05-26 16:12:05', NULL),
(28, 'RICE', '1', '2021-05-26 16:12:32', 'Emp3289', '2021-05-26 16:12:32', NULL),
(37, 'Coca-Cola', '1', '2021-11-23 06:34:19', 'Emp7367', '2021-11-23 06:34:19', NULL),
(38, 'SPRITE', '1', '2021-12-02 05:07:48', 'Emp7367', '2021-12-02 05:07:48', NULL),
(39, 'FANTA ORANGE', '1', '2021-12-02 05:07:48', 'Emp7367', '2021-12-02 05:07:48', NULL),
(40, 'FANTA CITRUS', '1', '2021-12-02 05:07:48', 'Emp7367', '2021-12-02 05:07:48', NULL),
(41, 'FANTA STRAWBERRY', '1', '2021-12-02 05:07:48', 'Emp7367', '2021-12-02 05:07:48', NULL),
(42, 'THUMS UP COLA', '1', '2021-12-02 05:07:48', 'Emp7367', '2021-12-02 05:07:48', NULL),
(43, 'SCHW +C LEMON', '1', '2021-12-02 05:07:48', 'Emp7367', '2021-12-02 05:07:48', NULL),
(44, 'COCA-COLA LIGHT', '1', '2021-12-02 05:07:48', 'Emp7367', '2021-12-02 05:07:48', NULL),
(45, 'COCA-COLA ZERO', '1', '2021-12-02 05:07:48', 'Emp7367', '2021-12-02 05:07:48', NULL),
(46, 'COCA-COLA LIFE', '1', '2021-12-02 05:07:48', 'Emp7367', '2021-12-02 05:07:48', NULL),
(47, 'SPRITE LIGHT', '1', '2021-12-02 05:07:48', 'Emp7367', '2021-12-02 05:07:48', NULL),
(48, 'SPRITE ZERO CALORIES', '1', '2021-12-02 05:07:48', 'Emp7367', '2021-12-02 05:07:48', NULL),
(49, 'FANTA GREEN APPLE', '1', '2021-12-02 05:07:48', 'Emp7367', '2021-12-02 05:07:48', NULL),
(50, 'STORM', '1', '2021-12-02 05:07:48', 'Emp7367', '2021-12-02 05:07:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cde_reporting`
--

CREATE TABLE `cde_reporting` (
  `id` int(10) UNSIGNED NOT NULL,
  `merchandiser_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cde_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` date DEFAULT NULL,
  `reporting_end_date` date DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cde_reporting`
--

INSERT INTO `cde_reporting` (`id`, `merchandiser_id`, `cde_id`, `reporting_date`, `reporting_end_date`, `created_by`, `is_active`, `created_at`, `updated_at`, `device`) VALUES
(323, 'Emp102', 'Emp1336', '2022-02-01', '2022-03-12', 'Emp104', '1', '2022-02-09 12:00:17', '2022-02-09 12:00:17', NULL),
(324, 'Emp103', 'Emp6881', '2022-02-01', '2022-03-12', 'Emp105', '1', '2022-02-09 12:01:18', '2022-02-09 12:01:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `competitor`
--

CREATE TABLE `competitor` (
  `id` int(10) UNSIGNED NOT NULL,
  `timesheet_id` int(10) UNSIGNED DEFAULT NULL,
  `outlet_id` int(10) UNSIGNED DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotion_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotion_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mrp` int(11) DEFAULT NULL,
  `selling_price` int(11) DEFAULT NULL,
  `capture_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(10) UNSIGNED NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_copy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visa_copy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dl_copy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dl_expiry` date NOT NULL,
  `passport_exp_date` date NOT NULL,
  `edu_certificate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exp_certificate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emi_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lab_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lab_expiry` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emirates_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codes` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emirates_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` int(10) UNSIGNED NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `joining_date` date NOT NULL,
  `visa_exp_date` date DEFAULT NULL,
  `visa_number` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_exp_date` date DEFAULT NULL,
  `medical_ins_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medical_ins_exp_date` date DEFAULT NULL,
  `visa_company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Location` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade_license` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Person_code` int(11) DEFAULT NULL,
  `work_permit_no` int(11) DEFAULT NULL,
  `work_contact_number` int(11) DEFAULT NULL,
  `marital_status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emirate_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_unit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logout_message` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `first_name`, `middle_name`, `surname`, `passport_number`, `nationality`, `gender`, `codes`, `emirates_id`, `mobile_number`, `email`, `designation`, `department`, `joining_date`, `visa_exp_date`, `visa_number`, `passport_exp_date`, `medical_ins_no`, `medical_ins_exp_date`, `visa_company_name`, `Location`, `trade_license`, `Person_code`, `work_permit_no`, `work_contact_number`, `marital_status`, `emirate_id`, `business_unit`, `employee_score`, `is_active`, `created_at`, `updated_at`, `logout_message`) VALUES
('Emp101', 'AJITH S', 'KUMAR', 'SHANMUGAM', 'pass101', 'Afghanistan', 'male', '91', 'emi1245845', '9952217596', 'ajith@gmail.com', 8, 'Admin', '2020-12-20', '2020-12-20', NULL, '2020-12-20', NULL, NULL, 'visa101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100', '0', '2021-09-06 14:30:00', '2021-04-23 15:35:08', 'App Don\'t track you, it will only track when user had active check in.'),
('Emp102', 'merchandiser', 'merchandiser', 'merchandiser', 'PASSIND001', 'India', '', '', '', '9958985858588', 'merchandiser@gmail.com', 6, 'Sales', '2022-01-01', '2022-12-31', NULL, '2022-12-31', 'MED568555', '2022-12-31', 'INDVISA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-02-09 11:00:06', '2022-02-09 11:00:06', NULL),
('Emp103', 'merchant_coco', 'merchant_coco', 'merchant_coco', 'PASSIND879855', 'India', '', '', '', '99525888588', 'merchant_coco@gmail.com', 6, 'Sales', '2022-01-01', '2022-12-31', NULL, '2023-01-07', 'MED454847', '2022-12-31', 'INDVISA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-02-09 11:02:21', '2022-02-09 11:02:21', NULL),
('Emp104', 'Field', 'manager', 'field', 'pass8787747', 'India', '', '', '', '7418529630', 'fieldmanager_mars@gmail.com', 5, 'Sales', '2022-12-31', '2022-12-31', NULL, '2022-12-31', 'medind88855', '2022-12-31', 'indvisa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-02-09 11:04:31', '2022-02-09 11:04:31', NULL),
('Emp105', 'Coco', 'Filed', 'Field', 'pass787744', 'India', '', '', '', '74125898588', 'field_coco@gmail.com', 5, 'Sales', '2022-01-01', '2022-12-31', NULL, '2022-12-31', 'med4587888', '2022-12-31', 'indvisa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-02-09 11:06:53', '2022-02-09 11:06:53', NULL),
('Emp110', 'Sales', 'man', 'salesman', 'aasfas', 'India', '', '', '', '98598589699', 'salesman@gmail.com', 9, 'Sales', '2022-01-01', '2022-02-26', NULL, '2022-02-26', 'sadfasfd', '2022-02-19', 'dsfasfd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-02-09 11:21:41', '2022-02-09 11:21:41', NULL),
('Emp1336', 'mars', 'cde', 'mars cde', '', 'India', '', '91', '', '78888585855', 'mars_cde@gmail.com', 2, '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-02-09 11:08:05', '2022-02-09 11:08:05', NULL),
('Emp3289', 'Mars', 'mars', 'mars', '', 'United Arab Emirates', '', '971', '', '05986858588', 'mars@gmail.com', 7, '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-02-09 10:20:26', '2022-02-09 10:20:26', NULL),
('Emp6881', 'coco', 'cde', 'coco cde', '', 'India', '', '91', '', '78895878585', 'coco_cde@gmail.com', 2, '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-02-09 11:09:06', '2022-02-09 11:09:06', NULL),
('Emp7367', 'Coco', 'cola', 'coco', '', 'United Arab Emirates', '', '971', '', '059784875888', 'coco@gmail.com', 7, '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2022-02-09 10:21:31', '2022-02-09 10:21:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_reporting_to`
--

CREATE TABLE `employee_reporting_to` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reporting_to_emp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reporting_date` date NOT NULL,
  `reporting_end_date` date NOT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_reporting_to`
--

INSERT INTO `employee_reporting_to` (`id`, `employee_id`, `reporting_to_emp_id`, `reporting_date`, `reporting_end_date`, `is_active`, `created_at`, `updated_at`) VALUES
(495, 'Emp102', 'Emp104', '2022-02-15', '2022-03-05', '1', '2022-02-09 11:58:14', '2022-02-09 11:58:14'),
(496, 'Emp103', 'Emp105', '2022-02-01', '2022-02-26', '1', '2022-02-09 11:59:35', '2022-02-09 11:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaverequest`
--

CREATE TABLE `leaverequest` (
  `lrid` int(10) UNSIGNED NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reporting_to_emp_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leavetype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leavestartdate` date NOT NULL,
  `leaveenddate` date NOT NULL,
  `total_days` int(11) NOT NULL,
  `supportingdocument` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_rejected` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_balance`
--

CREATE TABLE `leave_balance` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Annual_Leave` float(4,1) NOT NULL,
  `total_month` int(11) NOT NULL,
  `Maternity_Leave` int(11) NOT NULL,
  `Sick_Leave` float(4,1) NOT NULL,
  `Casual_Leave` int(11) NOT NULL,
  `Emergency_Leave` int(11) NOT NULL,
  `Parental_Leave` int(11) NOT NULL,
  `Medical_Leave` int(11) NOT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `annual_leave_accured` float(4,4) DEFAULT NULL,
  `annual_leave_availed` float(4,4) DEFAULT NULL,
  `mol_contract_date_final` date DEFAULT NULL,
  `no_of_years` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_balance`
--

INSERT INTO `leave_balance` (`id`, `employee_id`, `Annual_Leave`, `total_month`, `Maternity_Leave`, `Sick_Leave`, `Casual_Leave`, `Emergency_Leave`, `Parental_Leave`, `Medical_Leave`, `is_active`, `created_at`, `updated_at`, `annual_leave_accured`, `annual_leave_availed`, `mol_contract_date_final`, `no_of_years`) VALUES
(1653, 'Emp102', 10.0, 0, 0, 0.0, 0, 0, 0, 0, '1', '2022-02-09 11:00:06', '2022-02-10 03:35:16', NULL, NULL, NULL, NULL),
(1654, 'Emp103', 10.0, 0, 0, 0.0, 0, 0, 0, 0, '1', '2022-02-09 11:02:21', '2022-02-10 03:35:24', NULL, NULL, NULL, NULL),
(1655, 'Emp104', 10.0, 0, 0, 0.0, 0, 0, 0, 0, '1', '2022-02-09 11:04:32', '2022-02-10 03:35:31', NULL, NULL, NULL, NULL),
(1656, 'Emp105', 10.0, 0, 0, 0.0, 0, 0, 0, 0, '1', '2022-02-09 11:06:53', '2022-02-10 03:35:39', NULL, NULL, NULL, NULL),
(1657, 'Emp110', 10.0, 0, 0, 0.0, 0, 0, 0, 0, '1', '2022-02-09 11:21:41', '2022-02-10 03:35:46', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leave_rule`
--

CREATE TABLE `leave_rule` (
  `leave_rule_id` int(10) UNSIGNED NOT NULL,
  `leave_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_days` float(10,2) NOT NULL,
  `year` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirements` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manualcheckin`
--

CREATE TABLE `manualcheckin` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `outlet_id` int(10) UNSIGNED NOT NULL,
  `checkin_time` time NOT NULL,
  `checkout_time` time NOT NULL,
  `checkin_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkout_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `merchant_time_sheet`
--

CREATE TABLE `merchant_time_sheet` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `is_defined` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outlet_id` int(10) UNSIGNED NOT NULL,
  `is_present?` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkin_time` time DEFAULT NULL,
  `checkout_time` time DEFAULT NULL,
  `scheduled_calls` int(11) DEFAULT NULL,
  `checkin_location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout_location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salesman_approval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cde_approval` int(11) DEFAULT NULL,
  `salesman_remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salesman_approved_date` date DEFAULT NULL,
  `client_approval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_completed` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkin_type` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `not_finish_reason` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cde_approve_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchant_time_sheet`
--

INSERT INTO `merchant_time_sheet` (`id`, `date`, `is_defined`, `employee_id`, `outlet_id`, `is_present?`, `checkin_time`, `checkout_time`, `scheduled_calls`, `checkin_location`, `checkout_location`, `salesman_approval`, `cde_approval`, `salesman_remarks`, `salesman_approved_date`, `client_approval`, `remarks`, `is_active`, `is_completed`, `status`, `created_at`, `updated_at`, `created_by`, `added_by`, `checkin_type`, `reason`, `not_finish_reason`, `cde_approve_id`, `device`) VALUES
(191573, '2022-02-07', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191574, '2022-02-14', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191575, '2022-02-21', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191576, '2022-02-28', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191577, '2022-02-07', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191578, '2022-02-14', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191579, '2022-02-21', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191580, '2022-02-28', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191581, '2022-02-07', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191582, '2022-02-14', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191583, '2022-02-21', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191584, '2022-02-28', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191585, '2022-02-01', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191586, '2022-02-08', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191587, '2022-02-15', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191588, '2022-02-22', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191589, '2022-02-01', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191590, '2022-02-08', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191591, '2022-02-15', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191592, '2022-02-22', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191593, '2022-02-01', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191594, '2022-02-08', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191595, '2022-02-15', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191596, '2022-02-22', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191597, '2022-02-02', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191598, '2022-02-09', '1', 'Emp102', 5237, '1', '17:34:57', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:04:57', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191599, '2022-02-16', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191600, '2022-02-23', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191601, '2022-02-02', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191602, '2022-02-09', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191603, '2022-02-16', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191604, '2022-02-23', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191605, '2022-02-02', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191606, '2022-02-09', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191607, '2022-02-16', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191608, '2022-02-23', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191609, '2022-02-03', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191610, '2022-02-10', '1', 'Emp102', 5237, '1', '09:43:07', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-10 04:13:07', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191611, '2022-02-17', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191612, '2022-02-24', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191613, '2022-02-03', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191614, '2022-02-10', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191615, '2022-02-17', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191616, '2022-02-24', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191617, '2022-02-03', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191618, '2022-02-10', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191619, '2022-02-17', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191620, '2022-02-24', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191621, '2022-02-04', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191622, '2022-02-11', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191623, '2022-02-18', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191624, '2022-02-25', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191625, '2022-02-04', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191626, '2022-02-11', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191627, '2022-02-18', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191628, '2022-02-25', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191629, '2022-02-04', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191630, '2022-02-11', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191631, '2022-02-18', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191632, '2022-02-25', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191633, '2022-02-05', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191634, '2022-02-12', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191635, '2022-02-19', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191636, '2022-02-26', '1', 'Emp102', 5237, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191637, '2022-02-05', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191638, '2022-02-12', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191639, '2022-02-19', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191640, '2022-02-26', '1', 'Emp102', 5238, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191641, '2022-02-05', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191642, '2022-02-12', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191643, '2022-02-19', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191644, '2022-02-26', '1', 'Emp102', 5239, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:02:18', '2022-02-09 12:02:18', 'Emp104', 'Emp104', NULL, NULL, NULL, NULL, NULL),
(191645, '2022-02-07', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191646, '2022-02-14', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191647, '2022-02-21', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191648, '2022-02-28', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191649, '2022-02-07', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191650, '2022-02-14', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191651, '2022-02-21', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191652, '2022-02-28', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191653, '2022-02-07', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191654, '2022-02-14', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191655, '2022-02-21', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191656, '2022-02-28', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191657, '2022-02-01', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191658, '2022-02-08', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191659, '2022-02-15', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191660, '2022-02-22', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191661, '2022-02-01', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191662, '2022-02-08', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191663, '2022-02-15', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191664, '2022-02-22', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191665, '2022-02-01', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191666, '2022-02-08', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191667, '2022-02-15', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191668, '2022-02-22', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191669, '2022-02-02', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191670, '2022-02-09', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191671, '2022-02-16', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191672, '2022-02-23', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191673, '2022-02-02', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191674, '2022-02-09', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191675, '2022-02-16', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191676, '2022-02-23', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191677, '2022-02-02', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191678, '2022-02-09', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191679, '2022-02-16', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191680, '2022-02-23', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191681, '2022-02-03', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191682, '2022-02-10', '1', 'Emp103', 5240, '1', '09:43:41', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-10 04:14:08', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191683, '2022-02-17', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191684, '2022-02-24', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191685, '2022-02-03', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191686, '2022-02-10', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191687, '2022-02-17', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191688, '2022-02-24', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191689, '2022-02-03', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191690, '2022-02-10', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191691, '2022-02-17', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191692, '2022-02-24', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191693, '2022-02-04', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191694, '2022-02-11', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191695, '2022-02-18', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191696, '2022-02-25', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191697, '2022-02-04', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191698, '2022-02-11', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191699, '2022-02-18', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191700, '2022-02-25', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191701, '2022-02-04', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191702, '2022-02-11', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191703, '2022-02-18', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191704, '2022-02-25', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191705, '2022-02-05', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191706, '2022-02-12', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191707, '2022-02-19', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191708, '2022-02-26', '1', 'Emp103', 5240, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191709, '2022-02-05', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191710, '2022-02-12', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191711, '2022-02-19', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191712, '2022-02-26', '1', 'Emp103', 5241, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191713, '2022-02-05', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191714, '2022-02-12', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191715, '2022-02-19', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL),
(191716, '2022-02-26', '1', 'Emp103', 5242, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '2022-02-09 12:03:21', '2022-02-09 12:03:21', 'Emp105', 'Emp105', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_01_15_100000_create_roles_table', 1),
(3, '2019_01_17_121504_create_categories_table', 1),
(4, '2019_01_21_130422_create_tags_table', 1),
(5, '2019_01_21_163402_create_items_table', 1),
(6, '2019_01_21_163414_create_item_tag_table', 1),
(7, '2019_03_06_143255_add_fields_to_items_table', 1),
(8, '2019_03_20_090438_add_color_tags_table', 1),
(9, '2020_11_07_113620_create_employee_table', 1),
(10, '2020_12_01_153558_create_employee_reporting_to_table', 1),
(11, '2020_12_04_103904_create-leave_rule-table', 1),
(12, '2020_12_08_170754_create_leaverequest_table', 1),
(13, '2020_12_11_151117_create_attendance_table', 1),
(14, '2020_12_12_153251_create_documents_table', 1),
(15, '2020_12_16_123422_create_users_table', 1),
(16, '2020_12_24_124856_create_outlet_table', 2),
(17, '2020_12_28_120825_add_field_to_leaverequest_table', 2),
(18, '2021_01_04_144919_create_merchant_time_sheet_table', 3),
(19, '2021_01_04_145652_create_merchant_time_sheet_table', 4),
(20, '2021_01_12_110313_create_leave_balance_table', 5),
(21, '2021_01_12_144754_create_holydays_table', 6),
(22, '2021_01_11_174916_create_working_days_table', 7),
(23, '2021_01_12_164913_create_holidays_table', 7),
(24, '2016_06_01_000001_create_oauth_auth_codes_table', 8),
(25, '2016_06_01_000002_create_oauth_access_tokens_table', 8),
(26, '2016_06_01_000003_create_oauth_refresh_tokens_table', 8),
(27, '2016_06_01_000004_create_oauth_clients_table', 8),
(28, '2016_06_01_000005_create_oauth_personal_access_clients_table', 8),
(29, '2021_01_23_131956_create_brand_details_table', 9),
(30, '2021_01_23_151718_create_brand_details_table', 10),
(31, '2021_02_01_154050_add_is_defined_outlet_table', 11),
(32, '2021_02_01_163828_add_day_merchant_time_sheet_table', 12),
(33, '2021_02_01_180745_add_is_defined_merchant_time_sheet_table', 13),
(34, '2021_02_02_110215_create_outlet_login_table', 14),
(35, '2021_02_02_111113_add_day_outlet_login_table', 15),
(36, '2021_02_02_142955_add_outlet_login_table', 16),
(37, '2021_02_02_143449_add_merchant_time_sheet_id_outlet_login_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `nbl_files`
--

CREATE TABLE `nbl_files` (
  `id` int(11) NOT NULL,
  `outlet_id` int(10) UNSIGNED DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nbl_files`
--

INSERT INTO `nbl_files` (`id`, `outlet_id`, `file_url`, `is_active`, `created_at`, `updated_at`) VALUES
(1719, 5239, '1644412070.Win-With-Oasis-T&C-Final.pdf', 1, '2022-02-09 17:07:50', '2022-02-09 17:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `notifiation_details`
--

CREATE TABLE `notifiation_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `page_url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `viwed_at` int(11) DEFAULT 1,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifiation_details`
--

INSERT INTO `notifiation_details` (`id`, `title`, `date`, `time`, `created_by`, `user_type`, `created_to`, `read_at`, `page_url`, `is_active`, `created_at`, `viwed_at`, `updated_at`, `device`, `ip_address`, `country`) VALUES
(341986, 'Fieldmanager added scheduled timesheet', '2022-02-09', '17:32:18', 'Emp104', 'Merchandiser', 'Emp102', '0', 'timesheet', 1, '2022-02-09 12:02:18', 0, '2022-02-09 12:02:18', NULL, NULL, NULL),
(341987, 'Fieldmanager added scheduled timesheet', '2022-02-09', '17:33:21', 'Emp105', 'Merchandiser', 'Emp103', '1', 'timesheet', 1, '2022-02-09 12:03:21', 1, '2022-02-09 12:03:21', NULL, NULL, NULL),
(341988, 'Merchandiser CheckIn In Outlet', '2022-02-09', '17:34:57', 'Emp102', 'merchandiser', 'Emp104', '1', 'defined-outlets', 1, '2022-02-09 12:04:57', 1, '2022-02-09 12:04:57', NULL, NULL, NULL),
(341989, 'Merchandiser update availability', '2022-02-09', '17:35:09', 'Emp102', 'merchandiser', 'Emp104', '1', 'defined-outlets', 1, '2022-02-09 12:05:09', 1, '2022-02-09 12:05:09', NULL, NULL, NULL),
(341990, 'Merchandiser CheckIn In Outlet', '2022-02-10', '09:43:07', 'Emp102', 'merchandiser', 'Emp104', '1', 'defined-outlets', 1, '2022-02-10 04:13:07', 1, '2022-02-10 04:13:07', NULL, NULL, NULL),
(341991, 'Merchandiser CheckIn In Outlet', '2022-02-10', '09:43:41', 'Emp103', 'merchandiser', 'Emp105', '1', 'defined-outlets', 1, '2022-02-10 04:13:41', 1, '2022-02-10 04:13:41', NULL, NULL, NULL),
(341992, 'Fieldmanager added scheduled timesheet', '2022-02-17', '09:07:47', 'Emp104', 'Merchandiser', 'Emp102', '1', 'timesheet', 1, '2022-02-17 03:37:47', 1, '2022-02-17 03:37:47', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('091f1487e0b3683d2750e4cb373199807c5c953c3a669f3ebe67ba4fda1f2c92537d20461484a04d', 1757, 3, 'Laravel Password Grant Client', '[]', 0, '2022-02-17 03:27:36', '2022-02-17 03:27:36', '2023-02-17 08:57:36'),
('0b43efd04b41049ff9faa70f1b8fcb1ca53228cebfc04e9bd33685f6d288d09b1f698b8c0048bc83', 1, 3, 'Laravel Password Grant Client', '[]', 0, '2022-02-09 12:11:56', '2022-02-09 12:11:56', '2023-02-09 17:41:56'),
('24b0af4ec5f69220c99004ab97b63625ada155c125dbe6abc488f0dbcaf7dea7975176e35864ccfe', 1757, 3, 'Laravel Password Grant Client', '[]', 0, '2022-02-17 03:28:53', '2022-02-17 03:28:53', '2023-02-17 08:58:53'),
('24f6702293be2d8e464456f4f44d884d27f3fd0f8663fca48fe20e648ab4e5cca56432e8713c9fbb', 1757, 3, 'Laravel Password Grant Client', '[]', 0, '2022-02-17 03:39:49', '2022-02-17 03:39:49', '2023-02-17 09:09:49'),
('35a48f778a9eea4461746d7dc6c2145f2eee0569946348a894bfbc4ebd9d2f3d16deb3c78846b6f2', 1757, 3, 'Laravel Password Grant Client', '[]', 0, '2022-02-17 03:34:05', '2022-02-17 03:34:05', '2023-02-17 09:04:05'),
('994a3a7a62bd3f43e12f9677a3f8b87ec980c6e420fa74f4b74fc766457d5a370f044b217216f17b', 1, 3, 'Laravel Password Grant Client', '[]', 0, '2022-02-09 12:06:53', '2022-02-09 12:06:53', '2023-02-09 17:36:53'),
('a09e2f44adb3422a50ded055ed6c09e07c93d2315555584337e3ccaf8ca5abe4e448f30085c638fe', 1757, 3, 'Laravel Password Grant Client', '[]', 0, '2022-02-17 03:50:48', '2022-02-17 03:50:48', '2023-02-17 09:20:48'),
('f216bf70c5037a35ccb021c859c1154ff7a4337aea8a46512c1834df12cb4479e6da144f9c1c0045', 1, 3, 'Laravel Password Grant Client', '[]', 0, '2022-02-09 10:26:40', '2022-02-09 10:26:40', '2023-02-09 15:56:40');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(3, NULL, 'rms', 'OsVFm5MmRotI3VmxYzqIpyMhhETQsRdSHA4JknIg', NULL, 'http://localhost', 1, 0, 0, '2022-02-09 10:26:28', '2022-02-09 10:26:28');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(2, 3, '2022-02-09 10:26:28', '2022-02-09 10:26:28');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oulet_survey`
--

CREATE TABLE `oulet_survey` (
  `id` int(10) UNSIGNED NOT NULL,
  `timeshet_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `availability` int(11) NOT NULL DEFAULT 0,
  `visibility` int(11) NOT NULL DEFAULT 0,
  `shareofself` int(11) NOT NULL DEFAULT 0,
  `promotioncheck` int(11) NOT NULL DEFAULT 0,
  `planogramcheck` int(11) NOT NULL DEFAULT 0,
  `compitetorinfo` int(11) NOT NULL DEFAULT 0,
  `stockexpiry` int(11) NOT NULL DEFAULT 0,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `outlet_id` int(10) UNSIGNED NOT NULL,
  `outlet_name` int(10) UNSIGNED NOT NULL,
  `outlet_lat` decimal(10,8) DEFAULT NULL,
  `outlet_long` decimal(11,8) DEFAULT NULL,
  `outlet_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outlet_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outlet_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outlet_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_defined` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_assigned` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`outlet_id`, `outlet_name`, `outlet_lat`, `outlet_long`, `outlet_area`, `outlet_city`, `outlet_state`, `outlet_country`, `is_defined`, `is_active`, `created_by`, `is_assigned`, `created_at`, `updated_at`, `account`) VALUES
(5237, 3470, '25.23920345', '55.28635020', 'dubai', 'DUBAI', 'DUBAI', 'uae', NULL, 1, 'Emp3289', '0', '2022-02-09 11:33:50', '2022-02-09 11:33:50', NULL),
(5238, 3471, '25.26421845', '55.35798111', 'dubai', 'DUBAI', 'DUBAI', 'UAE', NULL, 1, 'Emp3289', '0', '2022-02-09 11:34:39', '2022-02-09 11:34:39', NULL),
(5239, 3472, '25.21390215', '55.26801517', 'DUBAI', 'DUBAI', 'DUBAI', 'UAE', NULL, 1, 'Emp3289', '0', '2022-02-09 11:35:14', '2022-02-09 11:35:14', NULL),
(5240, 3473, '25.24651174', '55.29054550', 'uae', 'DUBAI', 'DUBAI', 'uae', NULL, 1, 'Emp7367', '0', '2022-02-09 11:49:04', '2022-02-09 11:49:04', NULL),
(5241, 3474, '25.21924397', '55.26770441', 'uae', 'DUBAI', 'DUBAI', 'uae', NULL, 1, 'Emp7367', '0', '2022-02-09 11:49:38', '2022-02-09 11:49:38', NULL),
(5242, 3475, '25.23723576', '55.35875802', 'uae', 'DUBAI', 'DUBAI', 'uae', NULL, 1, 'Emp7367', '0', '2022-02-09 11:50:11', '2022-02-09 11:50:11', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `outletview`
-- (See below for the actual view)
--
CREATE TABLE `outletview` (
`outlet_id` int(1)
,`outlet_name` int(1)
,`outlet_lat` int(1)
,`outlet_long` int(1)
,`outlet_area` int(1)
,`outlet_city` int(1)
,`outlet_state` int(1)
,`outlet_country` int(1)
,`is_defined` int(1)
,`is_active` int(1)
,`created_by` int(1)
,`is_assigned` int(1)
,`created_at` int(1)
,`updated_at` int(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `outlet_journey_time`
--

CREATE TABLE `outlet_journey_time` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timesheet_id` int(10) UNSIGNED NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `checkin_time` time NOT NULL,
  `checkout_time` time DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outlet_login`
--

CREATE TABLE `outlet_login` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `outlet_id` int(10) UNSIGNED NOT NULL,
  `timesheet_id` int(10) UNSIGNED DEFAULT NULL,
  `is_present?` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkin_time` time DEFAULT NULL,
  `checkout_time` time DEFAULT NULL,
  `checkin_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `is_completed` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outlet_products_mapping`
--

CREATE TABLE `outlet_products_mapping` (
  `id` int(10) UNSIGNED NOT NULL,
  `outlet_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `client_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shelf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `planogram_img` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `outlet_products_mapping`
--

INSERT INTO `outlet_products_mapping` (`id`, `outlet_id`, `brand_id`, `category_id`, `client_id`, `shelf`, `target`, `planogram_img`, `is_active`, `created_at`, `updated_at`, `device`) VALUES
(71041, 5239, NULL, 6, 'Emp3289', NULL, '100', '1644412070.insta_btn.png', '1', '2022-02-09 11:37:50', '2022-02-09 11:37:50', NULL),
(71042, 5239, NULL, 8, 'Emp3289', NULL, '100', '1644412070.form_592x920.png', '1', '2022-02-09 11:37:50', '2022-02-09 11:37:50', NULL),
(71043, 5239, NULL, 9, 'Emp3289', NULL, '100', '1644412071.insta_btn.png', '1', '2022-02-09 11:37:51', '2022-02-09 11:37:51', NULL),
(71044, 5239, NULL, 11, 'Emp3289', NULL, '100', '1644412071.mail_balloon.png', '1', '2022-02-09 11:37:51', '2022-02-09 11:37:51', NULL),
(71045, 5239, NULL, 26, 'Emp3289', NULL, '100', '1644412071.mail_balloon.png', '1', '2022-02-09 11:37:51', '2022-02-09 11:37:51', NULL),
(71046, 5239, NULL, 27, 'Emp3289', NULL, '100', '1644412071.mail_balloon.png', '1', '2022-02-09 11:37:51', '2022-02-09 11:37:51', NULL),
(71047, 5238, NULL, 6, 'Emp3289', NULL, '100', '1644412130.form_592x920.png', '1', '2022-02-09 11:38:50', '2022-02-09 11:38:50', NULL),
(71048, 5238, NULL, 8, 'Emp3289', NULL, '100', '1644412130.insta_btn.png', '1', '2022-02-09 11:38:50', '2022-02-09 11:38:50', NULL),
(71049, 5238, NULL, 9, 'Emp3289', NULL, '100', '1644412130.mail_balloon.png', '1', '2022-02-09 11:38:50', '2022-02-09 11:38:50', NULL),
(71050, 5238, NULL, 11, 'Emp3289', NULL, '100', '1644412130.form(1).png', '1', '2022-02-09 11:38:50', '2022-02-09 11:38:50', NULL),
(71051, 5238, NULL, 26, 'Emp3289', NULL, '100', '1644412130.mob_centre_logo.png', '1', '2022-02-09 11:38:50', '2022-02-09 11:38:50', NULL),
(71052, 5238, NULL, 27, 'Emp3289', NULL, '100', '1644412130.mob_gif.png', '1', '2022-02-09 11:38:50', '2022-02-09 11:38:50', NULL),
(71053, 5237, NULL, 6, 'Emp3289', NULL, '100', '1644412186.Fb_btn.png', '1', '2022-02-09 11:39:46', '2022-02-09 11:39:46', NULL),
(71054, 5237, NULL, 8, 'Emp3289', NULL, '100', '1644412186.form_392X534.png', '1', '2022-02-09 11:39:46', '2022-02-09 11:39:46', NULL),
(71055, 5237, NULL, 9, 'Emp3289', NULL, '100', '1644412186.form_392X534.png', '1', '2022-02-09 11:39:46', '2022-02-09 11:39:46', NULL),
(71056, 5237, NULL, 11, 'Emp3289', NULL, '100', '1644412186.form_392X534.png', '1', '2022-02-09 11:39:46', '2022-02-09 11:39:46', NULL),
(71057, 5237, NULL, 26, 'Emp3289', NULL, '100', '1644412186.Fb_btn.png', '1', '2022-02-09 11:39:46', '2022-02-09 11:39:46', NULL),
(71058, 5237, NULL, 27, 'Emp3289', NULL, '100', '1644412186.form(1).png', '1', '2022-02-09 11:39:46', '2022-02-09 11:39:46', NULL),
(71059, 5242, NULL, 37, 'Emp7367', NULL, '100', '1644412909.form_392X534.png', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49', NULL),
(71060, 5242, NULL, 38, 'Emp7367', NULL, '100', '1644412909.form_392X534.png', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49', NULL),
(71061, 5242, NULL, 39, 'Emp7367', NULL, '100', '1644412909.form_554X754.png', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49', NULL),
(71062, 5242, NULL, 40, 'Emp7367', NULL, '100', '1644412909.form(1).png', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49', NULL),
(71063, 5242, NULL, 41, 'Emp7367', NULL, '100', '1644412909.form_592x920.png', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49', NULL),
(71064, 5242, NULL, 42, 'Emp7367', NULL, '100', '1644412909.form_392X534.png', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49', NULL),
(71065, 5242, NULL, 43, 'Emp7367', NULL, '100', '1644412909.form_392X534.png', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49', NULL),
(71066, 5242, NULL, 44, 'Emp7367', NULL, '100', '1644412909.form_392X534.png', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49', NULL),
(71067, 5242, NULL, 45, 'Emp7367', NULL, '100', '1644412909.form_471x862.png', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49', NULL),
(71068, 5242, NULL, 46, 'Emp7367', NULL, '100', '1644412909.form_592x920.png', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49', NULL),
(71069, 5242, NULL, 47, 'Emp7367', NULL, '100', '1644412909.mail_balloon.png', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49', NULL),
(71070, 5242, NULL, 48, 'Emp7367', NULL, '100', '1644412909.form_592x920.png', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49', NULL),
(71071, 5242, NULL, 49, 'Emp7367', NULL, '100', '1644412909.form_554X754.png', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49', NULL),
(71072, 5242, NULL, 50, 'Emp7367', NULL, '100', '1644412909.form_471x862.png', '1', '2022-02-09 11:51:49', '2022-02-09 11:51:49', NULL),
(71073, 5241, NULL, 37, 'Emp7367', NULL, '100', '1644413034.Fb_btn.png', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54', NULL),
(71074, 5241, NULL, 38, 'Emp7367', NULL, '100', '1644413034.form_471x862.png', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54', NULL),
(71075, 5241, NULL, 39, 'Emp7367', NULL, '100', '1644413034.form(1).png', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54', NULL),
(71076, 5241, NULL, 40, 'Emp7367', NULL, '100', '1644413034.Fb_btn.png', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54', NULL),
(71077, 5241, NULL, 41, 'Emp7367', NULL, '100', '1644413034.form_471x862.png', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54', NULL),
(71078, 5241, NULL, 42, 'Emp7367', NULL, '100', '1644413034.favicon.png', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54', NULL),
(71079, 5241, NULL, 43, 'Emp7367', NULL, '100', '1644413034.form(1).png', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54', NULL),
(71080, 5241, NULL, 44, 'Emp7367', NULL, '100', '1644413034.mob_centre_logo.png', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54', NULL),
(71081, 5241, NULL, 45, 'Emp7367', NULL, '100', '1644413034.mail_offer.png', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54', NULL),
(71082, 5241, NULL, 46, 'Emp7367', NULL, '100', '1644413034.mail_offer.png', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54', NULL),
(71083, 5241, NULL, 47, 'Emp7367', NULL, '100', '1644413034.insta_btn.png', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54', NULL),
(71084, 5241, NULL, 48, 'Emp7367', NULL, '100', '1644413034.insta_btn.png', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54', NULL),
(71085, 5241, NULL, 49, 'Emp7367', NULL, '100', '1644413034.mob_centre_logo.png', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54', NULL),
(71086, 5241, NULL, 50, 'Emp7367', NULL, '100', '1644413034.mail_balloon.png', '1', '2022-02-09 11:53:54', '2022-02-09 11:53:54', NULL),
(71087, 5240, NULL, 37, 'Emp7367', NULL, '100', '1644413160.Fb_btn.png', '1', '2022-02-09 11:56:00', '2022-02-09 11:56:00', NULL),
(71088, 5240, NULL, 38, 'Emp7367', NULL, '100', '1644413160.form_554X754.png', '1', '2022-02-09 11:56:00', '2022-02-09 11:56:00', NULL),
(71089, 5240, NULL, 39, 'Emp7367', NULL, '100', '1644413160.mail_offer.png', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01', NULL),
(71090, 5240, NULL, 40, 'Emp7367', NULL, '100', '1644413161.insta_btn.png', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01', NULL),
(71091, 5240, NULL, 41, 'Emp7367', NULL, '100', '1644413161.Fb_btn.png', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01', NULL),
(71092, 5240, NULL, 42, 'Emp7367', NULL, '100', '1644413161.mob_balloon.png', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01', NULL),
(71093, 5240, NULL, 43, 'Emp7367', NULL, '100', '1644413161.mail_ipads.png', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01', NULL),
(71094, 5240, NULL, 44, 'Emp7367', NULL, '100', '1644413161.mail_ipads.png', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01', NULL),
(71095, 5240, NULL, 45, 'Emp7367', NULL, '100', '1644413161.form_592x920.png', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01', NULL),
(71096, 5240, NULL, 46, 'Emp7367', NULL, '100', '1644413161.mob_bg_367X714.png', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01', NULL),
(71097, 5240, NULL, 47, 'Emp7367', NULL, '100', '1644413161.mob_centre_logo.png', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01', NULL),
(71098, 5240, NULL, 48, 'Emp7367', NULL, '100', '1644413161.Mobile_form.png', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01', NULL),
(71099, 5240, NULL, 49, 'Emp7367', NULL, '100', '1644413161.mail_balloon.png', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01', NULL),
(71100, 5240, NULL, 50, 'Emp7367', NULL, '100', '1644413161.mob_offer.png', '1', '2022-02-09 11:56:01', '2022-02-09 11:56:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `outlet_share`
--

CREATE TABLE `outlet_share` (
  `id` int(10) UNSIGNED NOT NULL,
  `outlet_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `share` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outlet_stockexpiry`
--

CREATE TABLE `outlet_stockexpiry` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT '00:00:00',
  `timesheet_id` int(10) UNSIGNED NOT NULL,
  `outlet_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `piece_price` float(7,2) NOT NULL,
  `near_expiry` int(11) NOT NULL,
  `exposure_qty` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchandiser_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_manager_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sales_man_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salesman_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fieldmanager_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchandiser_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zrep` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `near_expiry_value` float(7,2) DEFAULT NULL,
  `expiry_items_count` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_period` int(11) DEFAULT NULL,
  `extimate_expire_value` float(7,2) DEFAULT NULL,
  `bar_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodcut_location` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_storegroup` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uom` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `planogram_checks`
--

CREATE TABLE `planogram_checks` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `outlet_id` int(10) UNSIGNED NOT NULL,
  `timesheet_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `brand_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outlet_products_mapping_id` int(10) UNSIGNED DEFAULT NULL,
  `default_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `before_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `after_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `zrep` varchar(20) NOT NULL,
  `material_description` varchar(200) NOT NULL,
  `barcode_cs` varchar(30) DEFAULT NULL,
  `barcode_bs` varchar(30) DEFAULT NULL,
  `barcode_pc` varchar(30) DEFAULT NULL,
  `price_pc` double DEFAULT NULL,
  `price_bs` double DEFAULT NULL,
  `price_cs` double DEFAULT NULL,
  `copack_regular` varchar(20) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zrep_code` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `range` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `piece_per_carton` int(11) NOT NULL,
  `price_per_piece` int(11) NOT NULL,
  `Image_url` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `client_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_categories` int(10) UNSIGNED NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `sku`, `product_name`, `barcode`, `zrep_code`, `type`, `range`, `piece_per_carton`, `price_per_piece`, `Image_url`, `updated_by`, `created_by`, `brand_id`, `client_id`, `product_categories`, `remarks`, `is_active`, `status`, `created_at`, `updated_at`, `device`) VALUES
(890, '234567890858', 'Galazy 10G', '78985858985884', 898858, 'Regular', 'minis', 10, 10, NULL, NULL, 'Emp3289', 63, 'Emp3289', 6, 'test', '1', '1', '2022-02-09 11:29:10', '2022-02-09 11:29:10', NULL),
(891, '774477885588', '5 star 25g', '74185296484854', 78858588, 'Regular', 'minis', 10, 20, NULL, NULL, 'Emp3289', 64, 'Emp3289', 6, 'test', '1', '1', '2022-02-09 11:30:13', '2022-02-09 11:30:13', NULL),
(892, '7885487858888', 'Good Day', '478747885888', 7885888, 'Regular', 'multipacks', 5, 20, NULL, NULL, 'Emp3289', 63, 'Emp3289', 11, 'test', '1', '1', '2022-02-09 11:31:06', '2022-02-09 11:31:06', NULL),
(893, '5668985898588', 'coco cola 1lrt', '4582665859855', 7885855, 'Regular', 'minis', 1, 50, NULL, NULL, 'Emp7367', 65, 'Emp7367', 37, 'test', '1', '1', '2022-02-09 11:47:15', '2022-02-09 11:47:15', NULL),
(894, '58996558588', 'sprite 1ltr', '7885888588588', 48785855, 'Regular', 'minis', 1, 50, NULL, NULL, 'Emp7367', 65, 'Emp7367', 38, 'test', '1', '1', '2022-02-09 11:48:15', '2022-02-09 11:48:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(10) UNSIGNED NOT NULL,
  `outlet_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `device` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotion_check`
--

CREATE TABLE `promotion_check` (
  `id` int(10) UNSIGNED NOT NULL,
  `outlet_id` int(10) UNSIGNED NOT NULL,
  `timesheet_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `is_available` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reliever`
--

CREATE TABLE `reliever` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reliever_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timesheet_id` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_details`
--

CREATE TABLE `report_details` (
  `id` int(11) NOT NULL,
  `file_name` varchar(500) NOT NULL,
  `timesheet_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'This is the administration role', '1', '2020-12-12 04:45:31', '2020-12-12 04:45:31'),
(2, 'CDE', 'This is the CDE role', '1', '2020-12-02 23:30:24', '2020-12-02 23:30:24'),
(3, 'Human Resource', 'This is the hr role', '1', '2020-12-02 23:31:41', '2020-12-02 23:31:41'),
(4, 'Accounts', 'This is the accounts role', '1', '2020-12-02 23:32:14', '2020-12-02 23:32:14'),
(5, 'Field Manager', 'This is the field manager role', '1', '2020-12-02 23:32:38', '2020-12-02 23:32:38'),
(6, 'Merchandiser', 'This is the merchandiser role', '1', '2020-12-02 23:33:41', '2020-12-02 23:33:41'),
(7, 'Client', 'This is the client role', '1', '2020-12-02 23:35:52', '2020-12-02 23:35:52'),
(8, 'Top Management', 'This is the top management', '1', '2020-12-31 00:04:07', '2020-12-31 00:04:07'),
(9, 'Sales Man', 'This is the sales man \r\n', '1', '2020-12-31 00:09:09', '2020-12-31 00:09:09'),
(12, 'HR Manager', 'This is hr manager role', '1', '2021-01-25 04:30:08', '2021-01-25 04:30:08'),
(13, 'KEY ACCOUNT EXECUTIVE', 'this is key account executive ', '1', '2021-06-15 17:55:20', '2021-06-15 17:55:28'),
(14, 'FIELD SUPERVISOR', 'this is field supervisor role', '1', '2021-06-15 17:55:24', '2021-06-15 17:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `shareof_shelf`
--

CREATE TABLE `shareof_shelf` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `outlet_products_mapping_id` int(10) UNSIGNED NOT NULL,
  `outlet_id` int(10) UNSIGNED NOT NULL,
  `timesheet_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `category_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_share` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `share` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_expiry`
--

CREATE TABLE `stock_expiry` (
  `id` int(11) NOT NULL,
  `customer_outlet_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `copack_regular` varchar(20) DEFAULT NULL,
  `near_expiry_in_pc` double DEFAULT NULL,
  `pc_expiry_date` date DEFAULT NULL,
  `period` varchar(10) DEFAULT NULL,
  `exposure_qty_will_expire_in_pc` int(11) DEFAULT NULL,
  `price_pc` double DEFAULT NULL,
  `near_expiry_in_cs` int(11) DEFAULT NULL,
  `price_cs` int(11) DEFAULT NULL,
  `cs_expiry_date` date DEFAULT NULL,
  `near_expiry_in_bs` int(11) DEFAULT NULL,
  `price_bs` double DEFAULT NULL,
  `bs_expiry_date` date DEFAULT NULL,
  `exposure_expiry_in_cs` int(11) DEFAULT NULL,
  `exposure_expiry_in_bs` int(11) DEFAULT NULL,
  `action_to_be_filled_by_cde` text DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_details`
--

CREATE TABLE `store_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_details`
--

INSERT INTO `store_details` (`id`, `store_code`, `store_name`, `contact_number`, `address`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(3470, 'STR001', 'VKR MALL', 2147483647, 'vellore', '1', 'Emp3289', '2022-02-09 11:11:27', '2022-02-09 11:11:27'),
(3471, 'STR002', 'KVP STORE', 2147483647, 'VELLORE', '1', 'Emp3289', '2022-02-09 11:11:59', '2022-02-09 11:11:59'),
(3472, 'STR003', 'Fort mall', 2147483647, 'vellore', '1', 'Emp3289', '2022-02-09 11:12:29', '2022-02-09 11:12:29'),
(3473, 'COC001', 'COC1', 788585855, 'UAE', '1', 'Emp7367', '2022-02-09 11:43:03', '2022-02-09 11:43:03'),
(3474, 'COC2', 'COC002', 2147483647, 'UAE', '1', 'Emp7367', '2022-02-09 11:43:48', '2022-02-09 11:43:48'),
(3475, 'COC003', 'COC3', 2147483647, 'UAE', '1', 'Emp7367', '2022-02-09 11:44:09', '2022-02-09 11:44:09');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_details`
--

CREATE TABLE `task_details` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `outlet_id` int(10) UNSIGNED NOT NULL,
  `task_list` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `device` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_response_details`
--

CREATE TABLE `task_response_details` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `timesheet_id` int(10) UNSIGNED NOT NULL,
  `task_id` int(11) NOT NULL,
  `img_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_completed` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `device` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `track_location_details`
--

CREATE TABLE `track_location_details` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emp_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `outlet_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `outlet_lat` decimal(10,8) NOT NULL,
  `outlet_long` decimal(11,8) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_date` datetime NOT NULL,
  `is_active` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `emp_id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `picture`, `is_active`, `created_at`, `updated_at`, `client_id`) VALUES
(1, 'Emp101', 'Ajith', 'ajith@gmail.com', '2020-12-12 04:45:31', '$2y$10$Eci1gVHnZ52RYj0pjJ6mROTON8j.CBjPdJ1HGSroDrIzijpZv5TDq', 8, 'L7CqWRNKJAqTcEGYWdiRQJPNeNZdW3w3Wxl8tJOkXS1rEIWXcp26zAhyKaM3', '1644469262.profile_photo.jpg', '1', '2022-02-10 03:31:02', '2021-04-23 14:14:16', 'Emp2784'),
(1755, 'Emp3289', 'Mars', 'mars@gmail.com', NULL, '$2y$10$RNsLv9ImW5iQgEbwOw9Nue4SYMf2lqVE04iKjjQHjOa5.tCcCIWd.', 7, NULL, NULL, '1', '2022-02-09 10:20:26', '2022-02-09 10:20:26', NULL),
(1756, 'Emp7367', 'Coco', 'coco@gmail.com', NULL, '$2y$10$jKp46obUR4gfNwTDVAa5Led/0f1wDSwO4Olt2PYe.ALL/70X.0gAC', 7, 'B5vgU7TcIvLqPXiRP9KgbrXxglLHs1DGp9KEE0iQaTU9EMlDb5tjCx8GkXrj', NULL, '1', '2022-02-09 10:21:31', '2022-02-09 10:21:31', NULL),
(1757, 'Emp102', 'merchandiser', 'merchandiser@gmail.com', NULL, '$2y$10$SqxlHBBtumx212Toygt6y.t3w8Jky7FNdMEWA.R.uodsetHoZVs3W', 6, NULL, NULL, '1', '2022-02-09 11:00:06', '2022-02-09 11:00:06', NULL),
(1758, 'Emp103', 'merchant_coco', 'merchant_coco@gmail.com', NULL, '$2y$10$HGHECjO3nnKAJ7er1lS99e1DW7xe2aRWvkwCpCsnO.qOK1WWJjyhe', 6, NULL, NULL, '1', '2022-02-09 11:02:21', '2022-02-09 11:02:21', NULL),
(1759, 'Emp104', 'Field', 'fieldmanager_mars@gmail.com', NULL, '$2y$10$6bBPStXXEobi9SqHWFh37euAI1F5QwdCQTr9ncIvRKOlg20Ykz6Xy', 5, NULL, NULL, '1', '2022-02-09 11:04:32', '2022-02-09 11:04:32', 'Emp3289'),
(1760, 'Emp105', 'Coco', 'field_coco@gmail.com', NULL, '$2y$10$l8E7zx9jWH5yuM7HkiQIXOVYiIUkR1rEHNkXrsbXC/lJzU.FnG6/W', 5, NULL, NULL, '1', '2022-02-09 11:06:53', '2022-02-09 11:06:53', 'Emp7367'),
(1761, 'Emp1336', 'mars', 'mars_cde@gmail.com', NULL, '$2y$10$GZ69u2rWBFFo1zEatQwJRerCMdtRBFdjoqLHwjp2SBm/xhvQch8ve', 2, NULL, NULL, '1', '2022-02-09 11:08:05', '2022-02-09 11:08:05', NULL),
(1762, 'Emp6881', 'coco', 'coco_cde@gmail.com', NULL, '$2y$10$LF7P5qi4qtmyjIPHIK4P1uA0XpJvp6KPMW.P8OrvP6KhNclgTvpWS', 2, NULL, NULL, '1', '2022-02-09 11:09:06', '2022-02-09 11:09:06', NULL),
(1763, 'Emp110', 'Sales', 'salesman@gmail.com', NULL, '$2y$10$qoeQddFUCCM/LJYDdrMALOFBXaPo4GShA6oZ8a5iy0WI7cWuqljyS', 9, NULL, NULL, '1', '2022-02-09 11:21:41', '2022-02-09 11:21:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visibility`
--

CREATE TABLE `visibility` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `outlet_products_mapping_id` int(10) UNSIGNED DEFAULT NULL,
  `outlet_id` int(10) UNSIGNED NOT NULL,
  `timesheet_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `brand_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_area` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_aisle` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pois` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visibility`
--

INSERT INTO `visibility` (`id`, `date`, `outlet_products_mapping_id`, `outlet_id`, `timesheet_id`, `category_id`, `brand_id`, `product_id`, `brand_name`, `category_name`, `product_name`, `g_area`, `main_aisle`, `pois`, `is_available`, `image_url`, `reason`, `remarks`, `is_active`, `created_at`, `updated_at`, `created_by`, `device`) VALUES
(2102, '2022-02-09', 71057, 5237, 191598, 26, NULL, NULL, NULL, 'Be Kind(Protein Bar,Cereal Bar)', NULL, NULL, NULL, NULL, '1', '1644413745.form(1).png', NULL, NULL, '1', '2022-02-09 12:05:45', NULL, 'Emp102', NULL),
(2103, '2022-02-09', 71056, 5237, 191598, 11, NULL, NULL, NULL, 'BISCUITS', NULL, NULL, NULL, NULL, '1', '1644413745.form_554X754.png', NULL, NULL, '1', '2022-02-09 12:05:45', NULL, 'Emp102', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weekoff`
--

CREATE TABLE `weekoff` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `working_days`
--

CREATE TABLE `working_days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_days` int(11) NOT NULL,
  `is_active` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure for view `outletview`
--
DROP TABLE IF EXISTS `outletview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `outletview`  AS SELECT 1 AS `outlet_id`, 1 AS `outlet_name`, 1 AS `outlet_lat`, 1 AS `outlet_long`, 1 AS `outlet_area`, 1 AS `outlet_city`, 1 AS `outlet_state`, 1 AS `outlet_country`, 1 AS `is_defined`, 1 AS `is_active`, 1 AS `created_by`, 1 AS `is_assigned`, 1 AS `created_at`, 1 AS `updated_at` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `audit_trial_details`
--
ALTER TABLE `audit_trial_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_trial_details_created_by_foreign` (`created_by`),
  ADD KEY `audit_trial_details_role_id_foreign` (`role_id`);

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outlet_relation` (`outlet_id`),
  ADD KEY `timesheet_relation` (`timesheet_id`),
  ADD KEY `foreign_product` (`product_id`),
  ADD KEY `fk_category_id_availability` (`category_id`);

--
-- Indexes for table `brand_details`
--
ALTER TABLE `brand_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_details_client_id_foreign` (`client_id`),
  ADD KEY `brand_details_field_manager_id_foreign` (`field_manager_id`),
  ADD KEY `brand_details_sales_manager_id_foreign` (`sales_manager_id`),
  ADD KEY `brand_details_updates_by_foreign` (`updated_by`),
  ADD KEY `brand_details_created_by_foreign` (`created_by`);

--
-- Indexes for table `category_details`
--
ALTER TABLE `category_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_createby` (`created_by`);

--
-- Indexes for table `cde_reporting`
--
ALTER TABLE `cde_reporting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cde_reporting_merchandiser_id_foreign` (`merchandiser_id`),
  ADD KEY `cde_reporting_cde_id_foreign` (`cde_id`),
  ADD KEY `cde_reporting_created_by_foreign` (`created_by`);

--
-- Indexes for table `competitor`
--
ALTER TABLE `competitor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competitor_timesheet_id` (`timesheet_id`),
  ADD KEY `competitor_outlet_id_fk` (`outlet_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `documents_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_email_unique` (`email`),
  ADD KEY `designation_foreign_key` (`designation`);

--
-- Indexes for table `employee_reporting_to`
--
ALTER TABLE `employee_reporting_to`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_reporting_to_employee_id_foreign` (`employee_id`),
  ADD KEY `employee_reporting_reporting_to` (`reporting_to_emp_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaverequest`
--
ALTER TABLE `leaverequest`
  ADD PRIMARY KEY (`lrid`),
  ADD KEY `leaverequest_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `leave_balance`
--
ALTER TABLE `leave_balance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reporting_to_emp_id` (`employee_id`);

--
-- Indexes for table `leave_rule`
--
ALTER TABLE `leave_rule`
  ADD PRIMARY KEY (`leave_rule_id`);

--
-- Indexes for table `manualcheckin`
--
ALTER TABLE `manualcheckin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_out_manual` (`outlet_id`),
  ADD KEY `fk_emp_manual` (`employee_id`);

--
-- Indexes for table `merchant_time_sheet`
--
ALTER TABLE `merchant_time_sheet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `merchant_time_sheet_employee_id_foreign` (`employee_id`),
  ADD KEY `outlet_foreign` (`outlet_id`),
  ADD KEY `fk_created_by` (`created_by`),
  ADD KEY `added_by_foreign` (`added_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nbl_files`
--
ALTER TABLE `nbl_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nbl_file_outlet_foreign` (`outlet_id`);

--
-- Indexes for table `notifiation_details`
--
ALTER TABLE `notifiation_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `oulet_survey`
--
ALTER TABLE `oulet_survey`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oulet_survey_employee_id_foreign` (`employee_id`),
  ADD KEY `oulet_survey_timeshet_id_foreign` (`timeshet_id`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`outlet_id`),
  ADD KEY `store_table_foreign` (`outlet_name`),
  ADD KEY `outlet_table_createdby_foreign` (`created_by`);

--
-- Indexes for table `outlet_journey_time`
--
ALTER TABLE `outlet_journey_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outlet_journey_time_employee_id_foreign` (`employee_id`),
  ADD KEY `outlettime_timesheet_fk` (`timesheet_id`);

--
-- Indexes for table `outlet_login`
--
ALTER TABLE `outlet_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outlet_login_employee_id_foreign` (`employee_id`),
  ADD KEY `outlet_login_outlet_id_foreign` (`outlet_id`),
  ADD KEY `timesheet_foriegn` (`timesheet_id`);

--
-- Indexes for table `outlet_products_mapping`
--
ALTER TABLE `outlet_products_mapping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outlet_foreign_relation` (`outlet_id`),
  ADD KEY `fk_brand_visibility` (`brand_id`),
  ADD KEY `fk_client_outlet_relation` (`client_id`),
  ADD KEY `fk_category_id_relation` (`category_id`);

--
-- Indexes for table `outlet_share`
--
ALTER TABLE `outlet_share`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outlet_share_outlet_id_foreign` (`outlet_id`),
  ADD KEY `outlet_share_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `outlet_stockexpiry`
--
ALTER TABLE `outlet_stockexpiry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outlet_stockexpiry_product_id_foreign` (`product_id`),
  ADD KEY `outlet_stockexpiry_merchandiser_id_foreign` (`merchandiser_id`),
  ADD KEY `outlet_stockexpiry_field_manager_id_foreign` (`field_manager_id`),
  ADD KEY `outlet_stockexpiry_timesheet_id_foreign` (`timesheet_id`),
  ADD KEY `outlet_stockexpiry_sales_man_id_by_foreign` (`sales_man_id`),
  ADD KEY `outlet_stockexpiry_outlet_id_foriegn` (`outlet_id`),
  ADD KEY `outlet_stockexpiry_client_id_foreign` (`client_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `planogram_checks`
--
ALTER TABLE `planogram_checks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planogram_checks_outlet_products_mapping_id_foreign` (`outlet_products_mapping_id`),
  ADD KEY `fk_outlets_id` (`outlet_id`),
  ADD KEY `fk_timesheet_id` (`timesheet_id`),
  ADD KEY `fk_brand` (`brand_id`),
  ADD KEY `planogram_checks_category` (`category_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_details_brand_id_foreign` (`brand_id`),
  ADD KEY `product_details_product_categories_foreign` (`product_categories`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promotion_product_id_foreign` (`product_id`),
  ADD KEY `promotion_outlet_id_foreign` (`outlet_id`);

--
-- Indexes for table `promotion_check`
--
ALTER TABLE `promotion_check`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promotion_check_outlet_id_foreign` (`outlet_id`),
  ADD KEY `promotion_check_timesheet_foreign` (`timesheet_id`),
  ADD KEY `promotion_check_product_foreign` (`product_id`);

--
-- Indexes for table `reliever`
--
ALTER TABLE `reliever`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reliever_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `report_details`
--
ALTER TABLE `report_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `shareof_shelf`
--
ALTER TABLE `shareof_shelf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shareof_shelf_outlet_id_foreign` (`outlet_id`),
  ADD KEY `shareof_shelf_timesheet_id_foreign` (`timesheet_id`),
  ADD KEY `shareof_shelf_brand_id_foreign` (`brand_id`),
  ADD KEY `shareof_shelf_fk_cate_id` (`category_id`);

--
-- Indexes for table `stock_expiry`
--
ALTER TABLE `stock_expiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_details`
--
ALTER TABLE `store_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_table_createdby_foreign` (`created_by`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_name_unique` (`name`);

--
-- Indexes for table `task_details`
--
ALTER TABLE `task_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outlet_fk` (`outlet_id`),
  ADD KEY `task_employee_fk` (`created_by`);

--
-- Indexes for table `task_response_details`
--
ALTER TABLE `task_response_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_response_employee_fk` (`employee_id`),
  ADD KEY `tesk_tresponse_fk` (`task_id`),
  ADD KEY `task_timesheet_fk` (`timesheet_id`);

--
-- Indexes for table `track_location_details`
--
ALTER TABLE `track_location_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_teack_fk` (`emp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `visibility`
--
ALTER TABLE `visibility`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_visibility` (`outlet_products_mapping_id`),
  ADD KEY `fk_visiblebrand_visibility` (`brand_id`),
  ADD KEY `fk_product_visibility` (`product_id`),
  ADD KEY `fk_category_id_visibility` (`category_id`);

--
-- Indexes for table `weekoff`
--
ALTER TABLE `weekoff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `weekoff_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `working_days`
--
ALTER TABLE `working_days`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25723;

--
-- AUTO_INCREMENT for table `audit_trial_details`
--
ALTER TABLE `audit_trial_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344847;

--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173268;

--
-- AUTO_INCREMENT for table `brand_details`
--
ALTER TABLE `brand_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `category_details`
--
ALTER TABLE `category_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `cde_reporting`
--
ALTER TABLE `cde_reporting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `competitor`
--
ALTER TABLE `competitor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employee_reporting_to`
--
ALTER TABLE `employee_reporting_to`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=497;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `leaverequest`
--
ALTER TABLE `leaverequest`
  MODIFY `lrid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `leave_balance`
--
ALTER TABLE `leave_balance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1658;

--
-- AUTO_INCREMENT for table `leave_rule`
--
ALTER TABLE `leave_rule`
  MODIFY `leave_rule_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `manualcheckin`
--
ALTER TABLE `manualcheckin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=348;

--
-- AUTO_INCREMENT for table `merchant_time_sheet`
--
ALTER TABLE `merchant_time_sheet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191717;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `nbl_files`
--
ALTER TABLE `nbl_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1720;

--
-- AUTO_INCREMENT for table `notifiation_details`
--
ALTER TABLE `notifiation_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=341993;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oulet_survey`
--
ALTER TABLE `oulet_survey`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61932;

--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `outlet_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5243;

--
-- AUTO_INCREMENT for table `outlet_journey_time`
--
ALTER TABLE `outlet_journey_time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3866;

--
-- AUTO_INCREMENT for table `outlet_login`
--
ALTER TABLE `outlet_login`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `outlet_products_mapping`
--
ALTER TABLE `outlet_products_mapping`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71101;

--
-- AUTO_INCREMENT for table `outlet_share`
--
ALTER TABLE `outlet_share`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outlet_stockexpiry`
--
ALTER TABLE `outlet_stockexpiry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1607;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `planogram_checks`
--
ALTER TABLE `planogram_checks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=895;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `promotion_check`
--
ALTER TABLE `promotion_check`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `reliever`
--
ALTER TABLE `reliever`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `report_details`
--
ALTER TABLE `report_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `shareof_shelf`
--
ALTER TABLE `shareof_shelf`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1357;

--
-- AUTO_INCREMENT for table `stock_expiry`
--
ALTER TABLE `stock_expiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `store_details`
--
ALTER TABLE `store_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3476;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task_details`
--
ALTER TABLE `task_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1048;

--
-- AUTO_INCREMENT for table `task_response_details`
--
ALTER TABLE `task_response_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2463;

--
-- AUTO_INCREMENT for table `track_location_details`
--
ALTER TABLE `track_location_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1764;

--
-- AUTO_INCREMENT for table `visibility`
--
ALTER TABLE `visibility`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2104;

--
-- AUTO_INCREMENT for table `weekoff`
--
ALTER TABLE `weekoff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `working_days`
--
ALTER TABLE `working_days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `audit_trial_details`
--
ALTER TABLE `audit_trial_details`
  ADD CONSTRAINT `audit_trial_details_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `designation_foreign_key` FOREIGN KEY (`designation`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
