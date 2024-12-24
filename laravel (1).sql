-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 24, 2024 lúc 04:45 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proposal_id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attachments`
--

INSERT INTO `attachments` (`id`, `proposal_id`, `file_name`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'HE163201_21032024203456.pdf', 'attachments/8R5uNSXtQ6CdzmVxmRKLOUTPjMe1mhs8GWRu2E6Q.pdf', '2024-12-08 09:30:12', '2024-12-08 09:30:12'),
(2, 2, 'logo-truong-dai-hoc-fpt-university_043152077.png', 'attachments/HDauN3tzS7Sc5eaVroVch3S3xLVh7pjSSrsNVdET.png', '2024-12-10 11:19:44', '2024-12-10 11:19:44'),
(3, 4, 'placeholder-image.jpg', 'attachments/lKZqK3kbp1xFKgwRFf74G1yKZBC28jzuHzDG3ITj.jpg', '2024-12-12 22:50:12', '2024-12-12 22:50:12'),
(4, 5, 'HE163201_21032024203456.pdf', 'attachments/9uXPiYLPfvERJ78yPlZ8RyafOoy6NagAtE0wtjLn.pdf', '2024-12-13 08:00:06', '2024-12-13 08:00:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `check_in` timestamp NULL DEFAULT NULL,
  `check_out` timestamp NULL DEFAULT NULL,
  `date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Không hợp lệ',
  `justification_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `confirmed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `check_in`, `check_out`, `date`, `status`, `justification_reason`, `is_confirmed`, `confirmed_by`, `confirmed_at`, `created_at`, `updated_at`) VALUES
(1, 4, '2024-11-21 08:28:04', '2024-11-21 08:28:10', '2024-11-21', 'Không hợp lệ', NULL, 0, NULL, NULL, '2024-11-21 08:28:04', '2024-11-21 08:28:10'),
(2, 7, '2024-11-21 08:34:10', '2024-11-21 08:34:14', '2024-11-21', 'Không hợp lệ\r\n', NULL, 0, NULL, NULL, '2024-11-21 08:34:10', '2024-11-21 08:34:14'),
(5, 8, '2024-11-21 14:18:38', '2024-11-21 14:18:43', '2024-11-21', 'Không hợp lệ', NULL, 0, NULL, NULL, '2024-11-21 14:18:38', '2024-11-21 14:18:43'),
(6, 7, '2024-11-22 08:28:17', '2024-11-22 08:28:22', '2024-11-22', 'Hợp lệ', NULL, 0, NULL, NULL, '2024-11-22 08:28:17', '2024-11-22 08:28:22'),
(7, 7, '2024-11-24 07:12:10', '2024-11-24 07:12:17', '2024-11-24', 'Hợp lệ', NULL, 0, NULL, NULL, '2024-11-24 07:12:10', '2024-11-24 07:12:17'),
(8, 4, '2024-11-24 07:13:47', '2024-11-24 07:13:53', '2024-11-24', 'Hợp lệ', NULL, 0, NULL, NULL, '2024-11-24 07:13:47', '2024-11-24 07:13:53'),
(9, 8, '2024-11-24 19:03:42', '2024-11-24 19:03:46', '2024-11-25', 'Hợp lệ', NULL, 0, NULL, NULL, '2024-11-24 19:03:42', '2024-11-24 19:03:46'),
(10, 7, '2024-11-25 02:47:48', NULL, '2024-11-25', 'Không hợp lệ', NULL, 0, NULL, NULL, '2024-11-25 02:47:48', '2024-11-25 02:47:48'),
(11, 7, '2024-12-01 14:15:00', '2024-12-01 14:15:00', '2024-11-28', 'Hợp lệ', NULL, 0, NULL, NULL, '2024-11-28 14:15:13', '2024-12-01 13:50:04'),
(14, 7, '2024-11-29 08:46:31', '2024-11-29 08:46:36', '2024-11-29', 'Hợp lệ', NULL, 0, NULL, NULL, '2024-11-29 08:46:31', '2024-11-29 08:46:36'),
(15, 7, '2024-12-01 14:27:00', '2024-12-01 14:27:00', '2024-11-30', 'Hợp lệ', NULL, 0, NULL, NULL, '2024-11-30 14:27:12', '2024-12-01 13:38:12'),
(16, 7, '2024-12-01 09:03:47', '2024-12-01 09:12:57', '2024-12-01', 'Hợp lệ', NULL, 0, NULL, NULL, '2024-12-01 09:03:47', '2024-12-01 09:12:57'),
(17, 4, '2024-12-01 09:13:00', '2024-12-01 09:13:00', '2024-12-01', 'Không hợp lệ', NULL, 0, NULL, NULL, '2024-12-01 09:13:19', '2024-12-01 13:38:30'),
(18, 7, '2024-12-05 09:19:19', '2024-12-05 10:21:52', '2024-12-05', 'Không hợp lệ', NULL, 0, NULL, NULL, '2024-12-05 09:19:19', '2024-12-05 10:21:52'),
(19, 8, '2024-12-10 11:18:53', '2024-12-10 11:18:58', '2024-12-10', 'Không hợp lệ', NULL, 0, NULL, NULL, '2024-12-10 11:18:53', '2024-12-10 11:18:58'),
(20, 7, '2024-12-21 23:41:59', '2024-12-21 23:42:49', '2024-12-22', 'Hợp lệ', NULL, 0, NULL, NULL, '2024-12-21 23:41:59', '2024-12-21 23:42:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_mobile` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `collections`
--

CREATE TABLE `collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` int(11) DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('deactivated','activated') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'deactivated',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `departments`
--

INSERT INTO `departments` (`id`, `room_name`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Phòng IT', NULL, 'activated', '2024-11-07 08:15:11', '2024-11-07 08:15:11'),
(2, 'Phòng Kinh Doanh', NULL, 'activated', '2024-11-07 08:15:21', '2024-11-07 08:15:21'),
(3, 'Phòng Nhân Sự', NULL, 'activated', '2024-11-07 08:15:46', '2024-11-07 08:15:46'),
(9, 'Phòng Thiết Kế', NULL, 'activated', NULL, NULL),
(10, 'Trưởng Phòng', 1, 'activated', '2024-12-23 08:37:17', '2024-12-23 08:37:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `general_descriptions`
--

CREATE TABLE `general_descriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(25, 'default', '{\"uuid\":\"e590c7d0-2a40-4ac1-a577-2412b9870246\",\"displayName\":\"App\\\\Jobs\\\\SendProposalFeedbackEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendProposalFeedbackEmail\",\"command\":\"O:34:\\\"App\\\\Jobs\\\\SendProposalFeedbackEmail\\\":2:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:4:\\\"data\\\";a:2:{s:4:\\\"name\\\";s:23:\\\"Xin chào Việt Hoàng\\\";s:7:\\\"content\\\";s:42:\\\" - Đơn này đã được: Chấp Nhận\\\";}}\"}}', 0, NULL, 1734890381, 1734890381),
(26, 'default', '{\"uuid\":\"23acbca8-4a6e-4b6d-8c75-e3193984e9e6\",\"displayName\":\"App\\\\Jobs\\\\SendProposalFeedbackEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendProposalFeedbackEmail\",\"command\":\"O:34:\\\"App\\\\Jobs\\\\SendProposalFeedbackEmail\\\":2:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:4:\\\"data\\\";a:2:{s:4:\\\"name\\\";s:15:\\\"Xin chào admin\\\";s:7:\\\"content\\\";s:42:\\\" - Đơn này đã được: Chấp Nhận\\\";}}\"}}', 0, NULL, 1735048728, 1735048728);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `justifications`
--

CREATE TABLE `justifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attendance_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Đang chờ','Chấp nhận','Từ chối') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Đang chờ',
  `response` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `justifications`
--

INSERT INTO `justifications` (`id`, `attendance_id`, `user_id`, `reason`, `status`, `response`, `created_at`, `updated_at`) VALUES
(2, 6, 7, 'xin đến muộn', 'Từ chối', 'no', NULL, '2024-11-24 14:15:39'),
(3, 2, 7, 'di muộn', 'Chấp nhận', 'ok', NULL, '2024-11-24 18:53:52'),
(4, 7, 7, 'thiếu cong', 'Chấp nhận', 'ok', '2024-11-24 14:52:09', '2024-11-24 15:48:15'),
(5, 5, 8, 'check lại cho tôi', 'Chấp nhận', 'oke', '2024-11-24 19:04:30', '2024-11-24 19:04:49'),
(6, 10, 7, 'quên không check out', 'Chấp nhận', 'ad', '2024-11-27 14:37:00', '2024-11-29 08:47:31'),
(7, 16, 7, 'ad', 'Đang chờ', NULL, '2024-12-01 13:16:44', '2024-12-01 13:16:44'),
(8, 16, 7, 'ád', 'Đang chờ', NULL, '2024-12-01 13:44:15', '2024-12-01 13:44:15'),
(9, 16, 7, 'ád', 'Đang chờ', NULL, '2024-12-01 13:44:48', '2024-12-01 13:44:48'),
(10, 11, 7, 'den muon', 'Chấp nhận', 'ok', '2024-12-01 13:47:07', '2024-12-01 13:47:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `leave_balances`
--

CREATE TABLE `leave_balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `total_leaves` int(11) DEFAULT 0,
  `used_leaves` int(11) NOT NULL DEFAULT 0,
  `remaining_leaves` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `leave_balances`
--

INSERT INTO `leave_balances` (`id`, `user_id`, `year`, `total_leaves`, `used_leaves`, `remaining_leaves`, `created_at`, `updated_at`) VALUES
(1, 7, 2024, 9, 11, 1, NULL, '2024-12-22 17:59:41'),
(2, 8, 2024, 9, 6, 3, NULL, '2024-12-10 16:49:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `turn_off` tinyint(1) NOT NULL DEFAULT 0,
  `numerical_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_24_133515_create_fanpage_table', 1),
(6, '2024_01_30_124650_update_upcoming_titile_table', 1),
(7, '2024_02_16_022433_update_banners_table', 1),
(8, '2024_10_27_154247_update_users_table', 1),
(9, '2024_10_27_163020_create_department_table', 1),
(11, '2024_10_31_101732_create_roles_table', 1),
(12, '2024_10_31_101739_create_permissions_table', 1),
(13, '2024_10_31_101747_create_role_permission_table', 1),
(14, '2024_10_31_101754_create_user_role_table', 1),
(19, '2024_11_11_104139_add_checkin_checkout_times_to_users_table', 3),
(20, '2024_11_13_175321_create_salary_levels_table', 4),
(21, '2024_11_07_164045_create_payrolls_table', 5),
(23, '2024_11_20_212739_create_jobs_table', 6),
(25, '2024_10_30_135227_create_attendances_table', 7),
(28, '2024_11_21_221941_create_justifications_table', 8),
(37, '2024_11_20_211051_create_reminder_schedules_table', 9),
(38, '2024_12_04_214822_create_proposes_table', 9),
(39, '2024_12_10_201418_create_leave_balances_table', 10),
(40, '2024_12_11_223400_update_users_table', 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payrolls`
--

CREATE TABLE `payrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `valid_workdays` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ngày công hợp lệ',
  `invalid_workdays` int(11) DEFAULT NULL COMMENT 'Ngày không hợp lệ',
  `month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leave_without_leave` tinyint(11) DEFAULT 0,
  `salary_received` decimal(10,2) DEFAULT NULL COMMENT 'Lương được nhận',
  `type` enum('month','day') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'theo tháng, theo ngày',
  `processed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payrolls`
--

INSERT INTO `payrolls` (`id`, `user_id`, `valid_workdays`, `invalid_workdays`, `month`, `leave_without_leave`, `salary_received`, `type`, `processed_by`, `created_at`, `updated_at`) VALUES
(29, 7, '1.5', 21, '12-2024', 2, '900000.00', 'day', 1, '2024-12-24 14:11:18', '2024-12-24 15:43:38'),
(30, 4, '0', 22, '12-2024', 0, '0.00', 'day', 1, '2024-12-24 14:14:41', '2024-12-24 14:20:44'),
(31, 5, '0', 22, '12-2024', 0, '0.00', 'day', 1, '2024-12-24 14:14:41', '2024-12-24 15:43:38'),
(32, 8, '0', 22, '12-2024', 0, '0.00', 'day', 1, '2024-12-24 14:14:41', '2024-12-24 14:20:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'view_dashboard', '2024-11-07 08:13:30', '2024-11-07 08:13:30'),
(2, 'check_in', '2024-11-07 08:13:30', '2024-11-07 08:13:30'),
(3, 'check_out', '2024-11-07 08:13:30', '2024-11-07 08:13:30'),
(4, 'view_user', '2024-11-07 08:13:30', '2024-11-07 08:13:30'),
(5, 'create_user', '2024-11-07 08:13:30', '2024-11-07 08:13:30'),
(6, 'edit_user', '2024-11-07 08:13:30', '2024-11-07 08:13:30'),
(7, 'delete_user', '2024-11-07 08:13:30', '2024-11-07 08:13:30'),
(8, 'view_department', '2024-11-07 08:13:30', '2024-11-07 08:13:30'),
(9, 'create_department', '2024-11-07 08:13:30', '2024-11-07 08:13:30'),
(10, 'edit_department', '2024-11-07 08:13:30', '2024-11-07 08:13:30'),
(11, 'delete_department', '2024-11-07 08:13:30', '2024-11-07 08:13:30'),
(12, 'view_profile', '2024-11-07 08:13:30', '2024-11-07 08:13:30'),
(13, 'view_justifications', NULL, NULL),
(14, 'create_justifications', NULL, NULL),
(15, 'edit_justifications', NULL, NULL),
(16, 'delete_justifications', NULL, NULL),
(17, 'view_configurations', NULL, NULL),
(18, 'create_configurations', NULL, NULL),
(19, 'edit_configurations', '2024-11-28 13:18:43', '2024-11-28 13:18:43'),
(20, 'delete_configurations', '2024-11-28 13:18:43', '2024-11-28 13:18:43'),
(21, 'view_leaves', '2024-12-04 13:43:44', '2024-12-04 13:43:44'),
(22, 'create_leaves', '2024-12-04 13:43:44', '2024-12-04 13:43:44'),
(23, 'edit_leaves', '2024-12-04 13:43:44', '2024-12-04 13:43:44'),
(24, 'delete_leaves', '2024-12-04 13:43:44', '2024-12-04 13:43:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `proposals`
--

CREATE TABLE `proposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proposal_type_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Khóa ngoại đến bảng loại đề xuất',
  `proposal_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên đề xuất',
  `content` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_date` date DEFAULT NULL COMMENT 'Từ ngày',
  `to_date` date DEFAULT NULL COMMENT 'Đến ngày',
  `type_of_vacation` enum('Sáng','Chiều') COLLATE utf8mb4_unicode_ci DEFAULT 'Sáng' COMMENT 'Chọn Loại nghỉ',
  `status` enum('Nháp','Gửi','Từ chối','Chấp Nhận') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nháp',
  `rest_type` enum('Nghỉ phép','Nghỉ không phép') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nghỉ phép' COMMENT 'Chọn kiểu nghỉ',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'Người khởi tạo',
  `user_reviewer_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Người duyệt',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `proposals`
--

INSERT INTO `proposals` (`id`, `proposal_type_id`, `proposal_name`, `content`, `from_date`, `to_date`, `type_of_vacation`, `status`, `rest_type`, `user_id`, `user_reviewer_id`, `created_at`, `updated_at`) VALUES
(1, 'Nghỉ toàn ca', 'nghỉ ốm', '123', '2024-12-09', '2024-12-11', NULL, 'Chấp Nhận', 'Nghỉ không phép', 7, 8, '2024-12-08 09:30:12', '2024-12-08 09:32:21'),
(2, 'Nghỉ toàn ca', 'nghỉ phép', 'việc cá nhân', '2024-12-11', '2024-12-13', NULL, 'Chấp Nhận', 'Nghỉ không phép', 8, 7, '2024-12-10 11:19:44', '2024-12-11 09:32:45'),
(3, 'Nghỉ toàn ca', 'nghỉ phép', '123', '2024-12-12', '2024-12-14', NULL, 'Từ chối', 'Nghỉ phép', 7, 8, '2024-12-10 16:37:10', '2024-12-10 16:50:30'),
(4, 'Nghỉ nửa ca', 'nghỉ ốm', 'tôi xin nghỉ sáng vì mệt', '2024-12-13', '2024-12-13', 'Sáng', 'Gửi', 'Nghỉ phép', 7, 8, '2024-12-12 22:50:12', '2024-12-12 22:52:33'),
(5, 'Nghỉ nửa ca', 'nghỉ ốm', 'bị ốm', '2024-12-14', '2024-12-16', 'Sáng', 'Chấp Nhận', 'Nghỉ phép', 7, 8, '2024-12-13 08:00:06', '2024-12-22 17:59:41'),
(6, 'Nghỉ nửa ca', '12312', '123123', '2024-12-24', '2024-12-24', 'Sáng', 'Chấp Nhận', 'Nghỉ không phép', 7, 1, '2024-12-24 13:48:00', '2024-12-24 13:58:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `proposal_types`
--

CREATE TABLE `proposal_types` (
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `proposal_types`
--

INSERT INTO `proposal_types` (`type_name`, `created_at`, `updated_at`) VALUES
('Nghỉ nửa ca', NULL, NULL),
('Nghỉ toàn ca', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reminder_schedules`
--

CREATE TABLE `reminder_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reminder_time` time NOT NULL,
  `status` enum('Hợp lệ','Không hợp lệ') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hợp lệ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reminder_schedules`
--

INSERT INTO `reminder_schedules` (`id`, `user_id`, `email`, `reminder_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'truongviethoang64@gmail.com', '20:47:00', 'Hợp lệ', '2024-12-09 13:45:53', '2024-12-09 13:45:53'),
(2, 7, 'truongviethoang64@gmail.com', '00:20:00', 'Hợp lệ', '2024-12-22 16:53:55', '2024-12-22 17:18:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reminder_schedule_logs`
--

CREATE TABLE `reminder_schedule_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reminder_schedule_id` bigint(20) UNSIGNED NOT NULL,
  `error_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Đã gửi','Chưa gửi') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Chưa gửi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reminder_schedule_logs`
--

INSERT INTO `reminder_schedule_logs` (`id`, `reminder_schedule_id`, `error_message`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Đã gửi', '2024-12-09 13:47:06', '2024-12-09 13:47:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_system_role` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `is_system_role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, '2024-11-07 08:13:30', '2024-11-07 08:13:30'),
(2, 'member', 0, '2024-11-07 08:13:30', '2024-11-07 08:13:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_permission`
--

CREATE TABLE `role_permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_permission`
--

INSERT INTO `role_permission` (`id`, `role_id`, `permission_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 12),
(7, 2, 17),
(8, 2, 18),
(9, 2, 19),
(10, 2, 20),
(12, 2, 14),
(13, 2, 21),
(14, 2, 22),
(15, 2, 23),
(16, 2, 24);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `salary_levels`
--

CREATE TABLE `salary_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `level_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `daily_rate` decimal(20,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `salary_levels`
--

INSERT INTO `salary_levels` (`id`, `user_id`, `level_name`, `daily_rate`, `created_at`, `updated_at`) VALUES
(20, 5, '1', '600000', '2024-12-24 14:59:34', '2024-12-24 14:59:34'),
(21, 7, '1', '600000', '2024-12-24 14:59:34', '2024-12-24 14:59:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `synthetics`
--

CREATE TABLE `synthetics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hottline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `switchboard` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operating_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_face` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_youtobe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_tiktok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_reservations` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `upcomings`
--

CREATE TABLE `upcomings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `great_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `custom_checkin_time` time DEFAULT '08:00:00',
  `custom_checkout_time` time DEFAULT '17:00:00',
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('nam','nữ','không xác định') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone_number`, `position`, `department_id`, `custom_checkin_time`, `custom_checkout_time`, `date_of_birth`, `gender`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$tbaNQzJDXb5/JaHfiADycePJcUHX.UJ/F2cYrJQY6z9EOQ1uWrq1G', NULL, '2024-11-07 08:13:14', '2024-11-07 08:13:14', '', '', 0, '08:00:00', '17:00:00', '1990-12-04', 'nam'),
(2, 'Anh KHoa', 'anhkhoa@gmail.com', NULL, '$2y$10$Lh9ahZPHd2io3Egh9.kkkuS3WbUmZ6SUoXF/evVnaoc6LSw/UJQ/.', NULL, '2024-11-07 08:14:24', '2024-11-07 08:25:49', '969772859', 'f82e62d7c3ea69cc12b5cdb8d621dab6', 1, '08:00:00', '17:00:00', '1970-12-10', 'nam'),
(3, 'hoang', 'hoang@gmail.com', NULL, '$2y$10$UPJVJ04RSa7Kt9ehUUL33uohUAMHCs5ZV.qH7FYdzUGSEjkdXTtNW', NULL, '2024-11-07 08:14:24', '2024-11-07 08:25:38', '969772859', 'f82e62d7c3ea69cc12b5cdb8d621dab6', 1, '08:00:00', '17:00:00', '1999-07-01', 'nữ'),
(4, 'Hoàng Trương', 'user@gmail.com', NULL, '$2y$10$HLcI3F/Uv34nWlLAqizkB.NuYSQ46OdU5KRcDIuILpRs4l2fMsndG', NULL, '2024-11-07 08:17:36', '2024-11-07 08:17:36', '0979763115', 'f82e62d7c3ea69cc12b5cdb8d621dab6', 2, '08:00:00', '17:00:00', '2024-12-10', 'nữ'),
(5, 'Oanh', 'Oanh@gmail.com', NULL, '$2y$10$usVxqT6b.a45/1LGQcv00uYp6cJxWnfNQECFkXTqep1LiuE4OxWZW', NULL, '2024-11-07 08:18:09', '2024-12-13 07:23:05', '0987654321', 'f82e62d7c3ea69cc12b5cdb8d621dab6', 9, '08:00:00', '17:00:00', '2005-03-06', 'nữ'),
(7, 'Việt Hoàng', 'truongviethoang64@gmail.com', NULL, '$2y$10$YUcRGQADj7GRQAQAJ1ESoO51PhRQsoMPoakpwTH/Htqd4EUli.s8.', NULL, '2024-11-11 04:07:58', '2024-11-11 04:07:58', '0979763115', 'f82e62d7c3ea69cc12b5cdb8d621dab6', 1, '08:00:00', '17:00:00', '2002-07-11', 'nam'),
(8, 'Hoàng', 'hoangtvhe163201@fpt.edu.vn', NULL, '$2y$10$dBSLpBsYfi83og.kBYshLepvUpnPLk.bbmI40NApR3eEs9a8uP33.', NULL, '2024-11-12 01:11:45', '2024-11-12 01:11:45', '0979763115', 'f82e62d7c3ea69cc12b5cdb8d621dab6', 3, '08:00:00', '17:00:00', '2002-07-11', 'nam'),
(12, 'Hoàng2', 'user1@gmail.com', NULL, '$2y$10$2t.6dK/br3cHAU4KM8FUF.Pw00cNkipO69bxdOWw5.Bv8cc.C5maW', NULL, '2024-12-11 16:23:28', '2024-12-11 16:32:59', '0979763115', 'f82e62d7c3ea69cc12b5cdb8d621dab6', 4, '08:00:00', '17:00:00', '2024-12-07', 'nữ'),
(13, 'linh', 'linh@gmail.com', NULL, '$2y$10$I1OvFf5LUgT4iFrMkHVfzuSmyb1wUztqBax0PVflLnNwvZ1pUhm2q', NULL, '2024-12-12 14:29:31', '2024-12-12 14:29:31', '1234567890', 'f82e62d7c3ea69cc12b5cdb8d621dab6', 3, '08:00:00', '17:00:00', '2002-01-10', 'nữ'),
(14, 'chung', 'chung@gmail.com', NULL, '$2y$10$TYDMkThJA65DB60nWe1DtuuY2/sRrD36aJ2grQmjatqOqy1J3JOza', NULL, '2024-12-12 14:40:17', '2024-12-12 14:40:17', '1234567890', 'f82e62d7c3ea69cc12b5cdb8d621dab6', 9, '08:00:00', '17:00:00', '1992-12-18', 'nam'),
(15, 'Ngọc Hưng', 'hung@gmail.com', NULL, '$2y$10$e7M0LtqgdjnVdiZb73iPMOFTPae.ASD2cLYnqJt4IpW3bE.77ezsS', NULL, '2024-12-12 14:41:01', '2024-12-12 14:41:01', '1234567890', 'f82e62d7c3ea69cc12b5cdb8d621dab6', 3, '08:00:00', '17:00:00', '2024-12-21', 'nam'),
(16, 'Lợi', 'loi@gmail.com', NULL, '$2y$10$yWr2y0i/f59p8IBRoZpqpOsYIJj2V/OVfuyBJL24w7AemWm1qkdSm', NULL, '2024-12-12 14:42:24', '2024-12-12 14:42:24', '1234567890', 'f82e62d7c3ea69cc12b5cdb8d621dab6', 2, '08:00:00', '17:00:00', '1972-11-28', 'nữ'),
(17, 'dũng', 'dung@gmail.com', NULL, '$2y$10$ww18jnTA7iBEXNvdC6FCV.6KSLU3e2pkWwHBnncm2kTNe03GcshCy', NULL, '2024-12-13 07:19:12', '2024-12-13 07:19:12', '1234567890', 'f82e62d7c3ea69cc12b5cdb8d621dab6', 1, '08:00:00', '17:00:00', '1997-10-01', 'nam'),
(18, 'Mậm', 'mam@gmail.com', NULL, '$2y$10$cp5En3zFeCmE9myA3EeuEeTTxp7dEbRCaH4Ged6e3zSkkLMPuk.1m', NULL, '2024-12-23 05:32:17', '2024-12-23 05:32:17', '1234567890', 'f82e62d7c3ea69cc12b5cdb8d621dab6', 9, '08:00:00', '17:00:00', '2000-11-27', 'nam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_role`
--

CREATE TABLE `user_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(2, 4, 2),
(3, 5, 2),
(6, 7, 2),
(7, 8, 2),
(8, 2, 2),
(9, 12, 2),
(10, 13, 2),
(11, 14, 2),
(12, 15, 2),
(13, 16, 2),
(14, 17, 2),
(15, 18, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `utilities`
--

CREATE TABLE `utilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numerical_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_confirmed_by_foreign` (`confirmed_by`);

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `general_descriptions`
--
ALTER TABLE `general_descriptions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `justifications`
--
ALTER TABLE `justifications`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `leave_balances`
--
ALTER TABLE `leave_balances`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `proposal_types`
--
ALTER TABLE `proposal_types`
  ADD UNIQUE KEY `proposal_types_type_name_unique` (`type_name`);

--
-- Chỉ mục cho bảng `reminder_schedules`
--
ALTER TABLE `reminder_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reminder_schedules_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `reminder_schedule_logs`
--
ALTER TABLE `reminder_schedule_logs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Chỉ mục cho bảng `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permission_role_id_foreign` (`role_id`),
  ADD KEY `role_permission_permission_id_foreign` (`permission_id`);

--
-- Chỉ mục cho bảng `salary_levels`
--
ALTER TABLE `salary_levels`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `synthetics`
--
ALTER TABLE `synthetics`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `upcomings`
--
ALTER TABLE `upcomings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_user_id_foreign` (`user_id`),
  ADD KEY `user_role_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `general_descriptions`
--
ALTER TABLE `general_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `justifications`
--
ALTER TABLE `justifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `leave_balances`
--
ALTER TABLE `leave_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `reminder_schedules`
--
ALTER TABLE `reminder_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `reminder_schedule_logs`
--
ALTER TABLE `reminder_schedule_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `salary_levels`
--
ALTER TABLE `salary_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `synthetics`
--
ALTER TABLE `synthetics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `upcomings`
--
ALTER TABLE `upcomings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `utilities`
--
ALTER TABLE `utilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_confirmed_by_foreign` FOREIGN KEY (`confirmed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `reminder_schedules`
--
ALTER TABLE `reminder_schedules`
  ADD CONSTRAINT `reminder_schedules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
