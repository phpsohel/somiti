-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 19, 2023 at 04:59 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `somiti`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_deposits`
--

CREATE TABLE `daily_deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `years` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `months` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposite_date` date DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT 'Active-1|Inactive-2',
  `user_id` int DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_deposits`
--

INSERT INTO `daily_deposits` (`id`, `years`, `months`, `day_name`, `deposite_date`, `status`, `user_id`, `note`, `created_at`, `updated_at`) VALUES
(14, '2023', 'February', NULL, '2023-02-06', 1, 1, NULL, '2023-02-06 04:55:57', '2023-02-06 04:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `daily_deposit_details`
--

CREATE TABLE `daily_deposit_details` (
  `id` bigint UNSIGNED NOT NULL,
  `daily_deposit_id` int DEFAULT NULL,
  `member_id` int DEFAULT NULL,
  `deposite_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `years` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposite_date` date DEFAULT NULL,
  `payment_type` int DEFAULT NULL COMMENT '1-cash, 2-check, 3-bkash, 4-rocket, 5-nogot,6-others',
  `bank_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` decimal(50,0) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `daily_fee` decimal(16,0) NOT NULL DEFAULT '0',
  `daily_fine` decimal(16,0) NOT NULL DEFAULT '0',
  `grand_total` decimal(16,0) NOT NULL DEFAULT '0',
  `payment_status` int NOT NULL DEFAULT '1' COMMENT 'Due-1 | Paid-2 | Cancelled-3',
  `status` int NOT NULL DEFAULT '1' COMMENT 'Active-1 | Inactive-2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transition_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_deposit_details`
--

INSERT INTO `daily_deposit_details` (`id`, `daily_deposit_id`, `member_id`, `deposite_code`, `years`, `month`, `day_name`, `deposite_date`, `payment_type`, `bank_name`, `branch_name`, `check_no`, `phone_number`, `payment_date`, `daily_fee`, `daily_fine`, `grand_total`, `payment_status`, `status`, `created_at`, `updated_at`, `transition_id`, `cheque_date`) VALUES
(61, 14, 83, '10061', '2023', 'February', NULL, '2023-02-06', 3, 'islami bank', 'mirpur branch', '12121212', '172365465', '2023-02-06', '100', '10', '110', 2, 1, '2023-02-06 04:55:57', '2023-02-06 04:58:21', 'txtd#35835%02%', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int UNSIGNED NOT NULL,
  `site_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_logo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_access` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_format` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `developed_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_format` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` int DEFAULT NULL,
  `theme` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_position` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_title`, `address`, `phone`, `email`, `site_logo`, `currency`, `staff_access`, `date_format`, `developed_by`, `invoice_format`, `state`, `theme`, `created_at`, `updated_at`, `currency_position`) VALUES
(1, 'Surya Tarun Savings and Loans Cooperative Society Ltd', '3/C, Bashundhara Road, Zainab Ali Road, Jagannathpur, Bhatara, Dhaka', '01619123746', 'titojava@gmail.com', 's_b.png', '2', 'all', 'd-m-Y', 'Acquaint Technologies', 'standard', 1, 'default.css', '2018-07-06 06:13:11', '2023-02-18 22:57:31', 'prefix');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint UNSIGNED NOT NULL,
  `member_id` int DEFAULT NULL,
  `disburse` int DEFAULT NULL COMMENT 'Cash-1 | Cheque-2',
  `loan_interest_type` int DEFAULT NULL COMMENT 'Flat-1 | Interest-2',
  `loan_duration_type` int DEFAULT NULL COMMENT 'Days-1 | Weeks-2 | Month-3| Year-4',
  `loan_release_date` date DEFAULT NULL,
  `loan_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_duration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `principal_amount` decimal(20,2) DEFAULT NULL,
  `loan_interest` decimal(4,0) DEFAULT NULL,
  `grand_total` decimal(24,2) DEFAULT NULL,
  `loan_interest_amount` decimal(14,2) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `loan_status` int NOT NULL DEFAULT '1' COMMENT 'Open-1 |Approved-2|Cancelled-3',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `member_id`, `disburse`, `loan_interest_type`, `loan_duration_type`, `loan_release_date`, `loan_code`, `loan_duration`, `principal_amount`, `loan_interest`, `grand_total`, `loan_interest_amount`, `created_by`, `updated_by`, `loan_status`, `created_at`, `updated_at`) VALUES
(25, 83, 1, 2, 1, '2023-02-07', '10001', '10', '100.00', '10', '110.00', '10.00', 1, NULL, 1, '2023-02-06 23:07:06', '2023-02-06 23:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_deposits`
--

CREATE TABLE `meeting_deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `year` int NOT NULL,
  `month` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposite_date` date NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meeting_deposits`
--

INSERT INTO `meeting_deposits` (`id`, `year`, `month`, `deposite_date`, `note`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(6, 2023, 'February', '2023-02-07', NULL, 1, 1, '2023-02-06 23:06:16', '2023-02-06 23:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_deposit_details`
--

CREATE TABLE `meeting_deposit_details` (
  `id` bigint UNSIGNED NOT NULL,
  `member_id` int NOT NULL,
  `deposite_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposite_date` date NOT NULL,
  `meeting_fee` decimal(16,0) DEFAULT NULL,
  `meeting_fine` decimal(14,0) DEFAULT NULL,
  `grand_total` decimal(20,0) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_type` int DEFAULT NULL COMMENT '1-cash, 2-check, 3-bkash, 4-rocket, 5-nogot,6-others',
  `bank_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transition_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `phone_number` decimal(50,0) DEFAULT NULL,
  `payment_status` int NOT NULL DEFAULT '1',
  `meeting_deposit_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meeting_deposit_details`
--

INSERT INTO `meeting_deposit_details` (`id`, `member_id`, `deposite_code`, `year`, `month`, `deposite_date`, `meeting_fee`, `meeting_fine`, `grand_total`, `payment_date`, `payment_type`, `bank_name`, `branch_name`, `check_no`, `transition_id`, `cheque_date`, `phone_number`, `payment_status`, `meeting_deposit_id`, `created_at`, `updated_at`) VALUES
(21, 83, '10021', '2023', 'February', '2023-02-07', '500', '0', '500', '2023-02-07', 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, 6, '2023-02-06 23:06:16', '2023-02-06 23:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int UNSIGNED NOT NULL,
  `member_type` int DEFAULT NULL COMMENT 'General-1 | Borreow-2',
  `meeting_fee` decimal(12,0) DEFAULT NULL,
  `daily_deposit_fee` decimal(14,0) DEFAULT NULL,
  `weekly_deposit_fee` decimal(14,0) DEFAULT NULL,
  `yearly_deposit_fee` decimal(14,0) DEFAULT NULL,
  `monthly_deposit_fee` decimal(12,2) NOT NULL DEFAULT '0.00',
  `reference` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_id` int DEFAULT NULL,
  `joining_fee` decimal(12,2) DEFAULT '0.00',
  `customer_group_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` int DEFAULT NULL,
  `religion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` int DEFAULT NULL,
  `nationality` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_issue_date` date DEFAULT NULL,
  `company_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergency_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit` double DEFAULT NULL,
  `expense` double DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `soft_deleted` int NOT NULL DEFAULT '1' COMMENT 'deleted-0 | Active-1',
  `daily_status` int NOT NULL DEFAULT '2' COMMENT 'Active-1 | InActive-2',
  `weekly_status` int NOT NULL DEFAULT '2' COMMENT 'Active-1 | InActive-2',
  `monthly_status` int NOT NULL DEFAULT '2' COMMENT 'Active-1 | InActive-2',
  `yearly_status` int NOT NULL DEFAULT '2' COMMENT 'Active-1 | InActive-2',
  `member_code` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_type`, `meeting_fee`, `daily_deposit_fee`, `weekly_deposit_fee`, `yearly_deposit_fee`, `monthly_deposit_fee`, `reference`, `member_id`, `joining_fee`, `customer_group_id`, `user_id`, `name`, `father_name`, `mother_name`, `dob`, `gender`, `religion`, `marital_status`, `nationality`, `national_id`, `passport_no`, `passport_issue_date`, `company_name`, `email`, `phone_number`, `emergency_number`, `tax_no`, `address`, `permanent_address`, `city`, `state`, `postal_code`, `country`, `image`, `deposit`, `expense`, `is_active`, `soft_deleted`, `daily_status`, `weekly_status`, `monthly_status`, `yearly_status`, `member_code`, `created_at`, `updated_at`) VALUES
(83, 1, '500', '100', '500', '12000', '2000.00', 'SEKANDAR', NULL, '200.00', NULL, NULL, 'Md.Rishad Amir', NULL, NULL, NULL, 1, 'Islam', 1, 'Bangladeshi', NULL, NULL, NULL, 'ABC Company', 'admin@gmail.com', '0172365465', '456546456546546', NULL, 'Dhaka', 'Dhaka', NULL, NULL, NULL, 'Bangladesh', NULL, NULL, NULL, 1, 1, 1, 1, 1, 1, 'G1001', '2023-02-06 04:40:50', '2023-02-06 04:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `member_loan_details`
--

CREATE TABLE `member_loan_details` (
  `id` bigint UNSIGNED NOT NULL,
  `somiti_laon_id` int DEFAULT NULL,
  `member_id` int DEFAULT NULL,
  `principal_amount` decimal(20,2) DEFAULT NULL,
  `loan_interest` decimal(4,2) DEFAULT NULL,
  `loan_interest_amount` decimal(14,2) DEFAULT NULL,
  `loan_fine_amount` decimal(14,2) DEFAULT NULL,
  `grand_total` decimal(24,2) DEFAULT NULL,
  `payment_start_date` date DEFAULT NULL,
  `payment_last_date` date DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `payment_status` int NOT NULL DEFAULT '1' COMMENT 'Due/Unpaid-1|Paid-2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_loan_details`
--

INSERT INTO `member_loan_details` (`id`, `somiti_laon_id`, `member_id`, `principal_amount`, `loan_interest`, `loan_interest_amount`, `loan_fine_amount`, `grand_total`, `payment_start_date`, `payment_last_date`, `payment_date`, `created_by`, `updated_by`, `payment_status`, `created_at`, `updated_at`) VALUES
(885, 25, 83, '10.00', '10.00', '1.00', '0.00', '11.00', '2023-02-08', NULL, '2023-02-08', 1, 1, 2, '2023-02-06 23:07:06', '2023-02-06 23:07:14'),
(886, 25, 83, '10.00', '10.00', '1.00', NULL, '11.00', '2023-02-09', NULL, NULL, 1, NULL, 1, '2023-02-06 23:07:06', '2023-02-06 23:07:06'),
(887, 25, 83, '10.00', '10.00', '1.00', NULL, '11.00', '2023-02-10', NULL, NULL, 1, NULL, 1, '2023-02-06 23:07:06', '2023-02-06 23:07:06'),
(888, 25, 83, '10.00', '10.00', '1.00', NULL, '11.00', '2023-02-11', NULL, NULL, 1, NULL, 1, '2023-02-06 23:07:06', '2023-02-06 23:07:06'),
(889, 25, 83, '10.00', '10.00', '1.00', NULL, '11.00', '2023-02-12', NULL, NULL, 1, NULL, 1, '2023-02-06 23:07:06', '2023-02-06 23:07:06'),
(890, 25, 83, '10.00', '10.00', '1.00', NULL, '11.00', '2023-02-13', NULL, NULL, 1, NULL, 1, '2023-02-06 23:07:06', '2023-02-06 23:07:06'),
(891, 25, 83, '10.00', '10.00', '1.00', NULL, '11.00', '2023-02-14', NULL, NULL, 1, NULL, 1, '2023-02-06 23:07:06', '2023-02-06 23:07:06'),
(892, 25, 83, '10.00', '10.00', '1.00', NULL, '11.00', '2023-02-15', NULL, NULL, 1, NULL, 1, '2023-02-06 23:07:06', '2023-02-06 23:07:06'),
(893, 25, 83, '10.00', '10.00', '1.00', NULL, '11.00', '2023-02-16', NULL, NULL, 1, NULL, 1, '2023-02-06 23:07:06', '2023-02-06 23:07:06'),
(894, 25, 83, '10.00', '10.00', '1.00', NULL, '11.00', '2023-02-17', NULL, NULL, 1, NULL, 1, '2023-02-06 23:07:06', '2023-02-06 23:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(31, '2018_06_02_050905_create_roles_table', 6),
(33, '2018_06_03_053738_create_permission_tables', 8),
(43, '2018_07_06_115449_create_general_settings_table', 16),
(123, '2022_11_27_044020_create_member_loan_details_table', 81),
(126, '2023_02_06_060204_create_monthly_deposits_table', 83),
(132, '2023_02_06_124345_create_monthly_deposit_details_table', 84);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_deposits`
--

CREATE TABLE `monthly_deposits` (
  `id` int UNSIGNED NOT NULL,
  `years` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposite_date` date DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT 'Active-1|Inactive-2',
  `user_id` int DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monthly_deposits`
--

INSERT INTO `monthly_deposits` (`id`, `years`, `month`, `deposite_date`, `status`, `user_id`, `note`, `created_at`, `updated_at`) VALUES
(1, '2023', 'January', '2023-02-07', 1, NULL, NULL, '2023-02-06 22:54:41', '2023-02-06 22:54:41'),
(2, '2023', 'February', '2023-02-07', 1, NULL, NULL, '2023-02-06 22:57:06', '2023-02-06 22:57:06'),
(3, '2023', 'March', '2023-02-07', 1, NULL, NULL, '2023-02-06 23:05:02', '2023-02-06 23:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_deposit_details`
--

CREATE TABLE `monthly_deposit_details` (
  `id` bigint UNSIGNED NOT NULL,
  `monthly_deposits_id` int DEFAULT NULL,
  `member_id` int DEFAULT NULL,
  `deposite_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `years` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposite_date` date DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transition_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` decimal(14,2) DEFAULT NULL,
  `monthly_fee` decimal(14,2) NOT NULL DEFAULT '0.00',
  `monthly_fine` decimal(14,2) NOT NULL DEFAULT '0.00',
  `grand_total` decimal(14,2) NOT NULL DEFAULT '0.00',
  `payment_status` int NOT NULL DEFAULT '1' COMMENT 'Due-1 | Paid-2 | Cancelled-3',
  `status` int NOT NULL DEFAULT '1' COMMENT 'Active-1 | Inactive-2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monthly_deposit_details`
--

INSERT INTO `monthly_deposit_details` (`id`, `monthly_deposits_id`, `member_id`, `deposite_code`, `years`, `month`, `deposite_date`, `payment_date`, `payment_type`, `transition_id`, `cheque_date`, `bank_name`, `branch_name`, `check_no`, `phone_number`, `monthly_fee`, `monthly_fine`, `grand_total`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 83, '10001', '2023', 'February', '2023-02-07', '2023-02-07', '4', 'txtd#35835%02%', NULL, 'islami bank', 'mirpur branch', '12121212', '172365465.00', '2000.00', '0.00', '2000.00', 2, 1, '2023-02-06 22:57:06', '2023-02-06 23:00:03'),
(2, 3, 83, '10002', '2023', 'March', '2023-02-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2000.00', '0.00', '0.00', 1, 1, '2023-02-06 23:05:02', '2023-02-06 23:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(4, 'products-edit', 'web', '2018-06-03 01:00:09', '2018-06-03 01:00:09'),
(5, 'products-delete', 'web', '2018-06-03 22:54:22', '2018-06-03 22:54:22'),
(6, 'products-add', 'web', '2018-06-04 00:34:14', '2018-06-04 00:34:14'),
(7, 'products-index', 'web', '2018-06-04 03:34:27', '2018-06-04 03:34:27'),
(8, 'purchases-index', 'web', '2018-06-04 08:03:19', '2018-06-04 08:03:19'),
(9, 'purchases-add', 'web', '2018-06-04 08:12:25', '2018-06-04 08:12:25'),
(10, 'purchases-edit', 'web', '2018-06-04 09:47:36', '2018-06-04 09:47:36'),
(11, 'purchases-delete', 'web', '2018-06-04 09:47:36', '2018-06-04 09:47:36'),
(12, 'sales-index', 'web', '2018-06-04 10:49:08', '2018-06-04 10:49:08'),
(13, 'sales-add', 'web', '2018-06-04 10:49:52', '2018-06-04 10:49:52'),
(14, 'sales-edit', 'web', '2018-06-04 10:49:52', '2018-06-04 10:49:52'),
(15, 'sales-delete', 'web', '2018-06-04 10:49:53', '2018-06-04 10:49:53'),
(16, 'quotes-index', 'web', '2018-06-04 22:05:10', '2018-06-04 22:05:10'),
(17, 'quotes-add', 'web', '2018-06-04 22:05:10', '2018-06-04 22:05:10'),
(18, 'quotes-edit', 'web', '2018-06-04 22:05:10', '2018-06-04 22:05:10'),
(19, 'quotes-delete', 'web', '2018-06-04 22:05:10', '2018-06-04 22:05:10'),
(20, 'transfers-index', 'web', '2018-06-04 22:30:03', '2018-06-04 22:30:03'),
(21, 'transfers-add', 'web', '2018-06-04 22:30:03', '2018-06-04 22:30:03'),
(22, 'transfers-edit', 'web', '2018-06-04 22:30:03', '2018-06-04 22:30:03'),
(23, 'transfers-delete', 'web', '2018-06-04 22:30:03', '2018-06-04 22:30:03'),
(24, 'returns-index', 'web', '2018-06-04 22:50:24', '2018-06-04 22:50:24'),
(25, 'returns-add', 'web', '2018-06-04 22:50:24', '2018-06-04 22:50:24'),
(26, 'returns-edit', 'web', '2018-06-04 22:50:25', '2018-06-04 22:50:25'),
(27, 'returns-delete', 'web', '2018-06-04 22:50:25', '2018-06-04 22:50:25'),
(28, 'customers-index', 'web', '2018-06-04 23:15:54', '2018-06-04 23:15:54'),
(29, 'customers-add', 'web', '2018-06-04 23:15:55', '2018-06-04 23:15:55'),
(30, 'customers-edit', 'web', '2018-06-04 23:15:55', '2018-06-04 23:15:55'),
(31, 'customers-delete', 'web', '2018-06-04 23:15:55', '2018-06-04 23:15:55'),
(32, 'suppliers-index', 'web', '2018-06-04 23:40:12', '2018-06-04 23:40:12'),
(33, 'suppliers-add', 'web', '2018-06-04 23:40:12', '2018-06-04 23:40:12'),
(34, 'suppliers-edit', 'web', '2018-06-04 23:40:12', '2018-06-04 23:40:12'),
(35, 'suppliers-delete', 'web', '2018-06-04 23:40:12', '2018-06-04 23:40:12'),
(36, 'product-report', 'web', '2018-06-24 23:05:33', '2018-06-24 23:05:33'),
(37, 'purchase-report', 'web', '2018-06-24 23:24:56', '2018-06-24 23:24:56'),
(38, 'sale-report', 'web', '2018-06-24 23:33:13', '2018-06-24 23:33:13'),
(39, 'customer-report', 'web', '2018-06-24 23:36:51', '2018-06-24 23:36:51'),
(40, 'due-report', 'web', '2018-06-24 23:39:52', '2018-06-24 23:39:52'),
(41, 'users-index', 'web', '2018-06-25 00:00:10', '2018-06-25 00:00:10'),
(42, 'users-add', 'web', '2018-06-25 00:00:10', '2018-06-25 00:00:10'),
(43, 'users-edit', 'web', '2018-06-25 00:01:30', '2018-06-25 00:01:30'),
(44, 'users-delete', 'web', '2018-06-25 00:01:30', '2018-06-25 00:01:30'),
(45, 'profit-loss', 'web', '2018-07-14 21:50:05', '2018-07-14 21:50:05'),
(46, 'best-seller', 'web', '2018-07-14 22:01:38', '2018-07-14 22:01:38'),
(47, 'daily-sale', 'web', '2018-07-14 22:24:21', '2018-07-14 22:24:21'),
(48, 'monthly-sale', 'web', '2018-07-14 22:30:41', '2018-07-14 22:30:41'),
(49, 'daily-purchase', 'web', '2018-07-14 22:36:46', '2018-07-14 22:36:46'),
(50, 'monthly-purchase', 'web', '2018-07-14 22:48:17', '2018-07-14 22:48:17'),
(51, 'payment-report', 'web', '2018-07-14 23:10:41', '2018-07-14 23:10:41'),
(52, 'warehouse-stock-report', 'web', '2018-07-14 23:16:55', '2018-07-14 23:16:55'),
(53, 'product-qty-alert', 'web', '2018-07-14 23:33:21', '2018-07-14 23:33:21'),
(54, 'supplier-report', 'web', '2018-07-30 03:00:01', '2018-07-30 03:00:01'),
(55, 'expenses-index', 'web', '2018-09-05 01:07:10', '2018-09-05 01:07:10'),
(56, 'expenses-add', 'web', '2018-09-05 01:07:10', '2018-09-05 01:07:10'),
(57, 'expenses-edit', 'web', '2018-09-05 01:07:10', '2018-09-05 01:07:10'),
(58, 'expenses-delete', 'web', '2018-09-05 01:07:11', '2018-09-05 01:07:11'),
(59, 'general_setting', 'web', '2018-10-19 23:10:04', '2018-10-19 23:10:04'),
(60, 'mail_setting', 'web', '2018-10-19 23:10:04', '2018-10-19 23:10:04'),
(61, 'pos_setting', 'web', '2018-10-19 23:10:04', '2018-10-19 23:10:04'),
(62, 'hrm_setting', 'web', '2019-01-02 10:30:23', '2019-01-02 10:30:23'),
(63, 'purchase-return-index', 'web', '2019-01-02 21:45:14', '2019-01-02 21:45:14'),
(64, 'purchase-return-add', 'web', '2019-01-02 21:45:14', '2019-01-02 21:45:14'),
(65, 'purchase-return-edit', 'web', '2019-01-02 21:45:14', '2019-01-02 21:45:14'),
(66, 'purchase-return-delete', 'web', '2019-01-02 21:45:14', '2019-01-02 21:45:14'),
(67, 'account-index', 'web', '2019-01-02 22:06:13', '2019-01-02 22:06:13'),
(68, 'balance-sheet', 'web', '2019-01-02 22:06:14', '2019-01-02 22:06:14'),
(69, 'account-statement', 'web', '2019-01-02 22:06:14', '2019-01-02 22:06:14'),
(70, 'department', 'web', '2019-01-02 22:30:01', '2019-01-02 22:30:01'),
(71, 'attendance', 'web', '2019-01-02 22:30:01', '2019-01-02 22:30:01'),
(72, 'payroll', 'web', '2019-01-02 22:30:01', '2019-01-02 22:30:01'),
(73, 'employees-index', 'web', '2019-01-02 22:52:19', '2019-01-02 22:52:19'),
(74, 'employees-add', 'web', '2019-01-02 22:52:19', '2019-01-02 22:52:19'),
(75, 'employees-edit', 'web', '2019-01-02 22:52:19', '2019-01-02 22:52:19'),
(76, 'employees-delete', 'web', '2019-01-02 22:52:19', '2019-01-02 22:52:19'),
(77, 'user-report', 'web', '2019-01-16 06:48:18', '2019-01-16 06:48:18'),
(78, 'stock_count', 'web', '2019-02-17 10:32:01', '2019-02-17 10:32:01'),
(79, 'adjustment', 'web', '2019-02-17 10:32:02', '2019-02-17 10:32:02'),
(80, 'sms_setting', 'web', '2019-02-22 05:18:03', '2019-02-22 05:18:03'),
(81, 'create_sms', 'web', '2019-02-22 05:18:03', '2019-02-22 05:18:03'),
(82, 'print_barcode', 'web', '2019-03-07 05:02:19', '2019-03-07 05:02:19'),
(83, 'empty_database', 'web', '2019-03-07 05:02:19', '2019-03-07 05:02:19'),
(84, 'customer_group', 'web', '2019-03-07 05:37:15', '2019-03-07 05:37:15'),
(85, 'unit', 'web', '2019-03-07 05:37:15', '2019-03-07 05:37:15'),
(86, 'tax', 'web', '2019-03-07 05:37:15', '2019-03-07 05:37:15'),
(87, 'gift_card', 'web', '2019-03-07 06:29:38', '2019-03-07 06:29:38'),
(88, 'coupon', 'web', '2019-03-07 06:29:38', '2019-03-07 06:29:38'),
(89, 'holiday', 'web', '2019-10-19 08:57:15', '2019-10-19 08:57:15'),
(90, 'warehouse-report', 'web', '2019-10-22 06:00:23', '2019-10-22 06:00:23'),
(91, 'warehouse', 'web', '2020-02-26 06:47:32', '2020-02-26 06:47:32'),
(92, 'brand', 'web', '2020-02-26 06:59:59', '2020-02-26 06:59:59'),
(93, 'billers-index', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(94, 'billers-add', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(95, 'billers-edit', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(96, 'billers-delete', 'web', '2020-02-26 07:11:15', '2020-02-26 07:11:15'),
(97, 'money-transfer', 'web', '2020-03-02 05:41:48', '2020-03-02 05:41:48'),
(98, 'category', 'web', '2020-07-13 12:13:16', '2020-07-13 12:13:16'),
(99, 'delivery', 'web', '2020-07-13 12:13:16', '2020-07-13 12:13:16'),
(100, 'send_notification', 'web', '2020-10-31 06:21:31', '2020-10-31 06:21:31'),
(101, 'today_sale', 'web', '2020-10-31 06:57:04', '2020-10-31 06:57:04'),
(102, 'today_profit', 'web', '2020-10-31 06:57:04', '2020-10-31 06:57:04'),
(103, 'currency', 'web', '2020-11-09 00:23:11', '2020-11-09 00:23:11'),
(104, 'backup_database', 'web', '2020-11-15 00:16:55', '2020-11-15 00:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `guard_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Secratary', 'web', 1, '2018-06-01 23:46:44', '2022-11-23 02:48:22'),
(2, 'Rony', 'Treasurer', 'web', 1, '2018-10-22 02:38:13', '2022-11-23 02:48:01'),
(4, 'staff', 'staff has specific acess...', 'web', 0, '2018-06-02 00:05:27', '2022-11-23 02:46:17'),
(5, 'User', 'user permission', 'web', 1, '2020-11-05 06:43:16', '2022-12-13 05:22:50'),
(6, 'IT Officer', 'Simple IT Officer', 'web', 0, '2020-12-03 02:39:19', '2022-11-23 02:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(51, 1),
(59, 1),
(67, 1),
(68, 1),
(69, 1),
(72, 1),
(84, 1),
(97, 1),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(51, 2),
(59, 2),
(67, 2),
(68, 2),
(69, 2),
(72, 2),
(73, 2),
(74, 2),
(75, 2),
(76, 2),
(84, 2),
(97, 2),
(4, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(12, 4),
(13, 4),
(20, 4),
(21, 4),
(22, 4),
(24, 4),
(25, 4),
(28, 4),
(29, 4),
(55, 4),
(56, 4),
(57, 4),
(63, 4),
(64, 4);

-- --------------------------------------------------------

--
-- Table structure for table `somiti_settings`
--

CREATE TABLE `somiti_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `daily_fee` decimal(12,0) DEFAULT NULL,
  `monthly_fee` decimal(10,2) DEFAULT NULL,
  `yearly_fee` decimal(14,2) DEFAULT NULL,
  `weekly_fee` decimal(13,2) DEFAULT NULL,
  `registration_fee` decimal(12,2) DEFAULT NULL,
  `meeting_fee` decimal(12,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `somiti_settings`
--

INSERT INTO `somiti_settings` (`id`, `start_date`, `daily_fee`, `monthly_fee`, `yearly_fee`, `weekly_fee`, `registration_fee`, `meeting_fee`, `created_at`, `updated_at`) VALUES
(7, '2022-12-31', '100', '2000.00', '12000.00', '500.00', '200.00', '500', '2022-11-23 22:49:07', '2023-01-11 16:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_date` date NOT NULL DEFAULT '9999-12-31',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int NOT NULL,
  `biller_id` int DEFAULT NULL,
  `warehouse_id` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `expire_date`, `remember_token`, `phone`, `company_name`, `role_id`, `biller_id`, `warehouse_id`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$mu8qnC5GEfmPEvbq4hoHnOyeBtAGfGiq5dWlVuujjuEiY9zOGPDeq', '9999-12-31', 'Odjb4jEsWn11ShDe9vtFaKXJIzXKA6J3nwV9BWoSjem48qSXHneEv5zFUXVI', '12112', 'lioncoders', 1, NULL, NULL, 1, 0, '2018-06-02 03:24:15', '2022-12-21 21:47:06'),
(3, 'dhiman da', 'dhiman@gmail.com', '$2y$10$Fef6vu5E67nm11hX7V5a2u1ThNCQ6n9DRCvRF9TD7stk.Pmt2R6O.', '9999-12-31', '5ehQM6JIfiQfROgTbB5let0Z93vjLHS7rd9QD5RPNgOxli3xdo7fykU7vtTt', '212', 'lioncoders', 1, NULL, NULL, 0, 1, '2018-06-13 22:00:31', '2020-11-05 07:06:51'),
(6, 'test', 'test@gmail.com', '$2y$10$TDAeHcVqHyCmurki0wjLZeIl1SngKX3WLOhyTiCoZG3souQfqv.LS', '9999-12-31', 'KpW1gYYlOFacumklO2IcRfSsbC3KcWUZzOI37gqoqM388Xie6KdhaOHIFEYm', '1234', '212312', 4, NULL, NULL, 0, 1, '2018-06-23 03:05:33', '2018-06-23 03:13:45'),
(8, 'test', 'test@yahoo.com', '$2y$10$hlMigidZV0j2/IPkgE/xsOSb8WM2IRlsMv.1hg1NM7kfyd6bGX3hC', '9999-12-31', NULL, '31231', NULL, 4, NULL, NULL, 0, 1, '2018-06-24 22:35:49', '2018-07-02 01:07:39'),
(9, 'staff', 'anda@gmail.com', '$2y$10$kxDbnynB6mB1e1w3pmtbSOlSxy/WwbLPY5TJpMi0Opao5ezfuQjQm', '9999-12-31', 'DIDsmdI5kMZfkk2n4OkOpuH8yYHs3O0aPp9xUO0zuY4TwPvylsW5H6ovgE0K', '3123', NULL, 4, 5, 1, 1, 0, '2018-07-02 01:08:08', '2018-10-23 21:41:13'),
(10, 'abul', 'abul@alpha.com', '$2y$10$5zgB2OOMyNBNVAd.QOQIju5a9fhNnTqPx5H6s4oFlXhNiF6kXEsPq', '9999-12-31', 'x7HlttI5bM0vSKViqATaowHFJkLS3PHwfvl7iJdFl5Z1SsyUgWCVbLSgAoi0', '1234', 'anda', 1, NULL, NULL, 0, 0, '2018-09-07 23:44:48', '2018-09-07 23:44:48'),
(11, 'teststaff', 'a@a.com', '$2y$10$5KNBIIhZzvvZEQEhkHaZGu.Q8bbQNfqYvYgL5N55B8Pb4P5P/b/Li', '9999-12-31', 'DkHDEcCA0QLfsKPkUK0ckL0CPM6dPiJytNa0k952gyTbeAyMthW3vi7IRitp', '111', 'aa', 4, 5, 1, 0, 1, '2018-10-22 02:47:56', '2018-10-23 02:10:56'),
(12, 'john', 'john@gmail.com', '$2y$10$P/pN2J/uyTYNzQy2kRqWwuSv7P2f6GE/ykBwtHdda7yci3XsfOKWe', '9999-12-31', 'O0f1WJBVjT5eKYl3Js5l1ixMMtoU6kqrH7hbHDx9I1UCcD9CmiSmCBzHbQZg', '10001', NULL, 4, 2, 2, 0, 1, '2018-12-30 00:48:37', '2019-03-06 04:59:49'),
(13, 'jjj', 'test@test.com', '$2y$10$/Qx3gHWYWUhlF1aPfzXaCeZA7fRzfSEyCIOnk/dcC4ejO8PsoaalG', '9999-12-31', NULL, '1213', NULL, 1, NULL, NULL, 0, 1, '2019-01-03 00:08:31', '2019-03-03 04:02:29'),
(19, 'shakalaka', 'shakalaka@gmail.com', '$2y$10$ketLWT0Ib/JXpo00eJlxoeSw.7leS8V1CUGInfbyOWT4F5.Xuo7S2', '9999-12-31', NULL, '1212', 'Digital image', 5, NULL, NULL, 1, 0, '2020-11-09 00:07:16', '2020-11-09 00:07:16'),
(21, 'modon', 'modon@gmail.com', '$2y$10$7VpoeGMkP8QCvL5zLwFW..6MYJ5MRumDLDoX.TTQtClS561rpFHY.', '9999-12-31', NULL, '2222', 'modon company', 5, NULL, NULL, 1, 0, '2020-11-13 07:12:08', '2020-11-13 07:12:08'),
(22, 'dhiman', 'dhiman@gmail.com', '$2y$10$3mPygsC6wwnDtw/Sg85IpuExtUhgaHx52Lwp7Rz0.FNfuFdfKVpRq', '9999-12-31', NULL, '+8801111111101', 'lioncoders', 5, NULL, NULL, 1, 0, '2020-11-15 06:14:58', '2020-11-15 06:14:58'),
(27, 'Safi', 'safiulsahid151289@gmail.com', '$2y$10$8/WAKFEXq2AA1xgbcE//h..htYqyVKuvhAgcfP0UAlJwti1eC/6sK', '9999-12-31', NULL, '01521100281', 'Acquaint Technologies', 5, NULL, NULL, 1, 0, '2020-11-30 23:21:19', '2020-12-01 02:52:30'),
(28, 'Sahid', 'sahid@gmail.com', '$2y$10$zx7xatY7N0zgdDuNTxR7du8OeXWql86mpksOEfDMs3YEk.bo3.6qW', '9999-12-31', NULL, '01911160762', 'Acquaint Technologies', 1, NULL, NULL, 1, 0, '2020-11-30 23:29:10', '2020-11-30 23:29:10'),
(29, 'safi ul', 'safiul@gmail.com', '$2y$10$r0c5672vQK6N.F6t./jP3OWTj2s.UBiox6tFV33mJz4cXfyhDociK', '9999-12-31', NULL, '01521100281', 'Acquaint Technologies', 2, NULL, NULL, 1, 0, '2020-12-01 00:51:48', '2020-12-01 00:51:48'),
(30, 'nur', 'nur@gmail.com', '$2y$10$860RC4Bi4OzY.MrVwXNpEuMBQd7EsUrZfRKs25nPAPSk4RZ/Ec3me', '9999-12-31', NULL, '01911160762', 'Acquaint Technologies', 4, 1, 1, 1, 0, '2020-12-01 00:54:29', '2020-12-01 00:54:29'),
(31, 'Rafi Ul Sahid', 'rafi@gmail.com', '$2y$10$GcOyJlKbcbn3x5hDHwaBxeL.iYEAyyWMkjwBmNCPk0OQsW42pzKjG', '9999-12-31', NULL, '01717626265', 'Bangla Trac Ltd', 2, NULL, NULL, 1, 0, '2020-12-02 22:50:01', '2020-12-02 22:50:01'),
(32, 'Mohaimanul islam', 'mim@gmail.com', '$2y$10$8rL9RpvmXYPqp/s0lvzAVexKYtdoc49l1F3d4JvFBUcPaj6AJZpc6', '9999-12-31', NULL, '01922270873', 'khadem', 5, 1, 1, 1, 0, '2021-01-16 22:40:32', '2021-01-16 23:05:15'),
(33, 'karim', 'karim@gmail.com', '$2y$10$fUPj.ReEuy6pRaK/TteHa.VYV2N1i7hzBdE6RK.Om/m3gYAjUh7Q6', '9999-12-31', NULL, '01521100281', 'dream', 5, NULL, NULL, 0, 0, '2021-01-17 00:02:42', '2021-01-17 00:02:42'),
(34, 'Robiul', 'robi@gmail.com', '$2y$10$/pMLi6I2zGYYBrQyif/.2.QNe.or2QdzidnQk/zqD7bGH.Io1Zg96', '9999-12-31', NULL, '0155522811', 'None', 5, 1, 1, 1, 0, '2021-01-17 00:22:53', '2021-01-20 04:25:50'),
(35, 'sunny', 'sun@gmail.com', '$2y$10$mCo0R8.wbBWs9qS8h9eWY.CueD7yuUyNDKp7ZPYaxD30tW.t54FUi', '9999-12-31', NULL, '01632211392', 'None', 5, 1, 1, 1, 0, '2021-01-17 22:22:10', '2021-01-18 02:47:41'),
(58, 'hamid', 'hamid@gmail.com', '$2y$10$KuaHPRwKLQGhibrnxIaBuOBn0vYaQGAYFByNQJE.F8otCzfLUwPeG', '2021-01-25', NULL, '01911160762', 'abc', 1, NULL, NULL, 1, 0, '2021-01-24 21:44:26', '2021-01-25 00:12:00'),
(59, 'samsul', 'samsul@gmail.com', '$2y$10$msvO/tjsQdViWIFa4/fYzefAsAUNQdJAFSazC6Xoh5Sq.gNBpqMue', '2021-01-27', NULL, '324465745', 'zzz', 1, NULL, NULL, 1, 0, '2021-01-24 23:39:27', '2021-01-24 23:39:27'),
(60, 'zami', 'zami@gmail.com', '$2y$10$xIR/9LjP8aYq5B7asdoAI.phf/p9FsoR7P3Y.Y9NHEnk4vYTGSvbi', '9999-12-31', NULL, '14989734345', 'nnn', 1, NULL, NULL, 1, 0, '2021-01-24 23:44:45', '2021-01-24 23:44:45'),
(61, 'khalil', 'khalil@gmail.com', '$2y$10$9mKWCWGtrpEj1.HFMsOfxeBlWng5DepHFS.txZje30.uX5d6hFKAa', '2021-01-26', NULL, '98785745', 'ccc', 1, NULL, NULL, 1, 0, '2021-01-25 00:44:57', '2021-01-25 01:02:00'),
(62, 'Abul', 'abul111@gmail.com', '12345678', '9999-12-31', NULL, '123435576577', NULL, 5, NULL, NULL, 1, 0, '2021-01-30 23:57:22', '2021-01-30 23:57:22'),
(63, 'ansar', 'ansar@gmail.com', '$2y$10$t8AV0/E2z8LlbQ7qmDUCb.0RT2FXgdxFhi63/jKFqiLAy1BMk1LE2', '9999-12-31', NULL, '098365434', NULL, 5, NULL, NULL, 1, 0, '2021-01-31 00:09:40', '2021-02-03 01:10:52'),
(64, 'mokbul', 'mkb@gmail.com', '$2y$10$2uGCEBuSIWOgoL7QTyDwU.YK.W/QuR2TL5lgGmHQQBLTiQA3W9zgW', '9999-12-31', NULL, '09876453', NULL, 5, NULL, NULL, 1, 0, '2021-02-03 01:37:07', '2021-02-03 01:37:07'),
(65, 'rashed', 'rashed@gmail.com', '$2y$10$1BmQMEODkCeW4Z1Jtf6z/eV3y/LRAPaXP6GWeQDn4X36ko7a2MYAO', '9999-12-31', NULL, '2134522', NULL, 5, NULL, NULL, 1, 0, '2021-02-03 03:24:30', '2021-02-03 03:49:25'),
(66, 'asad', 'asad@gmail.com', '$2y$10$e52izq7wEjDkxdQoCh7M9eEjgsbx1wg05gH22RftXkUJmWRTPP6o.', '9999-12-31', NULL, '23124335', NULL, 5, NULL, NULL, 1, 0, '2021-02-03 03:50:50', '2021-02-03 03:50:50'),
(67, 'samus', 'samus@gmail.com', '$2y$10$RiDi7enubVnhIETzyiuyW.L.CNlwx4vn6kZ/b05MizH1Ktf9/kj7S', '9999-12-31', NULL, '3434', NULL, 5, NULL, NULL, 1, 0, '2021-02-03 04:07:40', '2021-02-03 05:02:56'),
(68, 'kamal', 'kamal@gmail.com', '$2y$10$fQWA8UzRgzlDR.geP9ji7eElaxlMaFu5qL/1gCUpt.znBrqr1f/E.', '9999-12-31', NULL, '01521100281', NULL, 5, NULL, NULL, 1, 0, '2021-02-04 00:53:51', '2021-02-04 00:53:51'),
(69, 'Mobina Hasan', 'samer@gmail.com', '$2y$10$I4Lzt4qig25QtAyBFvECYuJbjP6R6kkNprmEteXpeAWiy8ypwjgX2', '9999-12-31', NULL, '01686392899', NULL, 5, NULL, NULL, 1, 0, '2021-02-04 00:57:19', '2021-02-04 00:57:19'),
(70, 'selim', 'selim@gmail.com', '$2y$10$GzCAVtO0Ras3Stj8yH8ym.jYJTzHNnnVvGX155izT0ZR7f0m9h7ue', '9999-12-31', NULL, '019383763', NULL, 5, NULL, NULL, 1, 0, '2021-02-04 03:27:30', '2021-02-04 04:22:02');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_deposits`
--

CREATE TABLE `weekly_deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `years` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `months` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weekly` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposite_date` date DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT 'Active-1|Inactive-2',
  `user_id` int DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weekly_deposits`
--

INSERT INTO `weekly_deposits` (`id`, `years`, `months`, `weekly`, `deposite_date`, `status`, `user_id`, `note`, `created_at`, `updated_at`) VALUES
(6, '2023', 'February', '2023-02-10', '2023-02-06', 1, 1, NULL, '2023-02-06 04:58:34', '2023-02-06 04:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_deposit_details`
--

CREATE TABLE `weekly_deposit_details` (
  `id` bigint UNSIGNED NOT NULL,
  `weekly_deposit_id` int DEFAULT NULL,
  `member_id` int DEFAULT NULL,
  `deposite_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `years` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weeks` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposite_date` date DEFAULT NULL,
  `payment_type` int DEFAULT NULL COMMENT '1-cash, 2-check, 3-bkash, 4-rocket, 5-nogot,6-others',
  `bank_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transition_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `phone_number` decimal(50,0) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `weekly_fee` decimal(16,0) NOT NULL DEFAULT '0',
  `weekly_fine` decimal(16,0) NOT NULL DEFAULT '0',
  `grand_total` decimal(16,0) NOT NULL DEFAULT '0',
  `payment_status` int NOT NULL DEFAULT '1' COMMENT 'Due-1 | Paid-2 | Cancelled-3',
  `status` int NOT NULL DEFAULT '1' COMMENT 'Active-1 | Inactive-2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weekly_deposit_details`
--

INSERT INTO `weekly_deposit_details` (`id`, `weekly_deposit_id`, `member_id`, `deposite_code`, `years`, `month`, `weeks`, `deposite_date`, `payment_type`, `bank_name`, `branch_name`, `check_no`, `transition_id`, `cheque_date`, `phone_number`, `payment_date`, `weekly_fee`, `weekly_fine`, `grand_total`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
(14, 6, 83, '10014', '2023', 'February', '2023-02-10', '2023-02-06', 4, NULL, NULL, NULL, 'txtd#35835%02%', NULL, '172365465', '2023-02-06', '500', '0', '500', 2, 1, '2023-02-06 04:58:34', '2023-02-06 04:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `yearly_deposits`
--

CREATE TABLE `yearly_deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `years` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposite_date` date DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT 'Active-1|Inactive-2',
  `user_id` int DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yearly_deposits`
--

INSERT INTO `yearly_deposits` (`id`, `years`, `deposite_date`, `status`, `user_id`, `note`, `created_at`, `updated_at`) VALUES
(4, '2023', '2023-02-07', 1, NULL, NULL, '2023-02-06 23:06:05', '2023-02-06 23:06:05');

-- --------------------------------------------------------

--
-- Table structure for table `yearly_deposit_details`
--

CREATE TABLE `yearly_deposit_details` (
  `id` bigint UNSIGNED NOT NULL,
  `yearly_deposit_id` int DEFAULT NULL,
  `member_id` int DEFAULT NULL,
  `deposite_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `years` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposite_date` date DEFAULT NULL,
  `payment_type` int DEFAULT '1' COMMENT '1-cash, 2-check, 3-bkash, 4-rocket, 5-nogot,6-others',
  `bank_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transition_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `phone_number` decimal(50,0) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `yearly_fee` decimal(16,0) NOT NULL DEFAULT '0',
  `yearly_fine` decimal(16,0) NOT NULL DEFAULT '0',
  `grand_total` decimal(16,0) NOT NULL DEFAULT '0',
  `payment_status` int NOT NULL DEFAULT '1' COMMENT 'Due-1 | Paid-2 | Cancelled-3',
  `status` int NOT NULL DEFAULT '1' COMMENT 'Active-1 | Inactive-2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yearly_deposit_details`
--

INSERT INTO `yearly_deposit_details` (`id`, `yearly_deposit_id`, `member_id`, `deposite_code`, `years`, `month`, `deposite_date`, `payment_type`, `bank_name`, `branch_name`, `check_no`, `transition_id`, `cheque_date`, `phone_number`, `payment_date`, `yearly_fee`, `yearly_fine`, `grand_total`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
(9, 4, 83, '10009', '2023', NULL, '2023-02-07', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-07', '12000', '0', '12000', 2, 1, '2023-02-06 23:06:05', '2023-02-06 23:06:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_deposits`
--
ALTER TABLE `daily_deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_deposit_details`
--
ALTER TABLE `daily_deposit_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_deposits`
--
ALTER TABLE `meeting_deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_deposit_details`
--
ALTER TABLE `meeting_deposit_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meeting_deposit_details_meeting_deposit_id_foreign` (`meeting_deposit_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_loan_details`
--
ALTER TABLE `member_loan_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_deposits`
--
ALTER TABLE `monthly_deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_deposit_details`
--
ALTER TABLE `monthly_deposit_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `somiti_settings`
--
ALTER TABLE `somiti_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekly_deposits`
--
ALTER TABLE `weekly_deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekly_deposit_details`
--
ALTER TABLE `weekly_deposit_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yearly_deposits`
--
ALTER TABLE `yearly_deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yearly_deposit_details`
--
ALTER TABLE `yearly_deposit_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_deposits`
--
ALTER TABLE `daily_deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `daily_deposit_details`
--
ALTER TABLE `daily_deposit_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `meeting_deposits`
--
ALTER TABLE `meeting_deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `meeting_deposit_details`
--
ALTER TABLE `meeting_deposit_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `member_loan_details`
--
ALTER TABLE `member_loan_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=895;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `monthly_deposits`
--
ALTER TABLE `monthly_deposits`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `monthly_deposit_details`
--
ALTER TABLE `monthly_deposit_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `somiti_settings`
--
ALTER TABLE `somiti_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `weekly_deposits`
--
ALTER TABLE `weekly_deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `weekly_deposit_details`
--
ALTER TABLE `weekly_deposit_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `yearly_deposits`
--
ALTER TABLE `yearly_deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `yearly_deposit_details`
--
ALTER TABLE `yearly_deposit_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meeting_deposit_details`
--
ALTER TABLE `meeting_deposit_details`
  ADD CONSTRAINT `meeting_deposit_details_meeting_deposit_id_foreign` FOREIGN KEY (`meeting_deposit_id`) REFERENCES `meeting_deposits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
