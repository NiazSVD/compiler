-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 15, 2026 at 12:01 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `compiler`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:36:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:19:\"vendor.order.status\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:16:\"vendor.food.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:18:\"vendor.food.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:18:\"vendor.food.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:18:\"vendor.food.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:20:\"vendor.food.set_meal\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:24:\"vendor.food.stock_update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:19:\"vendor.meal_history\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:22:\"vendor.payment_history\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:19:\"employee.make_order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:20:\"employee.vendor_list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:20:\"employee.place_order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:21:\"employee.order.status\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:21:\"employee.order.cancel\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:24:\"employee.payment_history\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:25:\"office_staff.order.status\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:18:\"food_category.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:18:\"food_category.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:20:\"food_category.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:20:\"food_category.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:9:\"user.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:11:\"user.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:9:\"user.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:11:\"user.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:9:\"team.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:11:\"team.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:9:\"team.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:11:\"team.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:9:\"role.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:11:\"role.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:9:\"role.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:11:\"role.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:13:\"settings.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:13:\"settings.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:14:\"profile.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:1:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}}}', 1768540596);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_pages`
--

CREATE TABLE `dynamic_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `page_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int DEFAULT NULL,
  `page_content` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dynamic_pages`
--

INSERT INTO `dynamic_pages` (`id`, `page_title`, `page_slug`, `order`, `page_content`, `status`, `created_at`, `updated_at`) VALUES
(4, 'About Us', 'about-us', 1, '<p>dsf sf sf sdf yguy gjvht uygtyf uy&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; guy&nbsp; g&nbsp; g uyguy jy gj j g gggg g g</p>', 'active', '2026-01-15 06:21:44', '2026-01-15 06:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `landing_pages`
--

CREATE TABLE `landing_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `landing_pages`
--

INSERT INTO `landing_pages` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'theme_color', '#e40101', NULL, NULL),
(2, 'header_sub_title', 'No setup required — Start coding instantly1111111111111111', NULL, NULL),
(3, 'header_title', 'Choose Your Programming Language', NULL, NULL),
(4, 'header_short_description', 'Write, run, and test code online instantly — no installation, no configuration. Just pick a language and start building.', NULL, NULL),
(5, 'lang_header', 'Popular Languages', NULL, NULL),
(6, 'lang_description', 'Empowering developers worldwide with instant, accessible coding tools.', NULL, NULL),
(7, 'about_header', 'About Softvence', NULL, NULL),
(8, 'about_short_description', 'Empowering developers worldwide with instant, accessible coding tools.', NULL, NULL),
(9, 'about_description', '<p class=\"\" style=\"border: 0px solid lab(90.952 0 -0.0000119209); margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; outline-color: oklab(0.707999 -0.00000712276 0.0000166297 / 0.5); color: rgb(107, 114, 128); font-family: Inter, &quot;Inter Fallback&quot;; font-size: 16px; background-color: lab(100 0 0);\">Softvence is a leading software development company dedicated to creating innovative tools that simplify the coding experience. Our Online Code Compiler was born from a simple idea: everyone should be able to write and run code instantly, without the hassle of complex setups or installations.</p><p style=\"border: 0px solid lab(90.952 0 -0.0000119209); margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; outline-color: oklab(0.707999 -0.00000712276 0.0000166297 / 0.5); color: rgb(107, 114, 128); font-family: Inter, &quot;Inter Fallback&quot;; font-size: 16px; background-color: lab(100 0 0);\">Since our founding, we\'ve helped millions of developers, students, and educators around the world learn, practice,<br style=\"border: 0px solid lab(90.952 0 -0.0000119209); margin: 0px; padding: 0px; outline-color: oklab(0.707999 -0.00000712276 0.0000166297 / 0.5);\">and build with code. Whether you\'re a complete beginner taking your first steps or an experienced developer testing a quick idea, our platform is designed to get you coding in seconds.</p>', NULL, NULL),
(10, 'about_card_header_1', 'Our Mission', NULL, NULL),
(11, 'about_card_description_1', 'Make coding accessible to everyone, everywhere, with zero barriers.', NULL, NULL),
(12, 'about_card_header_2', 'No Installation', NULL, NULL),
(13, 'about_card_description_2', 'Access from any browser, anywhere. No downloads or setup required.', NULL, NULL),
(14, 'about_card_header_3', 'Multiple Languages', NULL, NULL),
(15, 'about_card_description_3', 'Support for 20+ programming languages with syntax highlighting.', NULL, NULL),
(16, 'about_card_header_4', 'Instant Execution', NULL, NULL),
(17, 'about_card_description_4', 'Run your code in milliseconds with our optimized cloud infrastructure.', NULL, NULL),
(18, 'about_card_header_5', 'No Installation', NULL, NULL),
(19, 'about_card_description_5', 'Access from any browser, anywhere. No downloads or setup required.', NULL, NULL),
(20, 'about_card_header_6', 'Multiple Languages', NULL, NULL),
(21, 'about_card_description_6', 'Support for 20+ programming languages with syntax highlighting.', NULL, NULL),
(22, 'about_card_header_7', 'Beginner Friendly', NULL, NULL),
(23, 'about_card_description_7', 'Perfect for learning. Clear error messages and helpful documentation.', NULL, NULL),
(24, 'about_card_header_8', 'Works Everywhere', NULL, NULL),
(25, 'about_card_description_8', 'Desktop, tablet, or mobile — code on any device seamlessly.', NULL, NULL),
(26, 'about_card_header_9', 'Secure & Private', NULL, NULL),
(27, 'about_card_description_9', 'Your code runs in isolated containers. Safe and secure execution.', NULL, NULL),
(28, 'about_header_2', 'Why Use Our Online Code Compiler?', NULL, NULL),
(29, 'about_short_description_2', 'Everything you need to write, test, and run code — right in your browser.', NULL, NULL),
(30, 'footer_text', '© 2025 Online Code Compiler — Developed by Softvence', NULL, NULL),
(31, 'about_card_icon_1', 'http://192.168.7.191:8000/uploads/landing/about/1768393424_1.svg', NULL, NULL),
(32, 'about_card_icon_2', 'http://192.168.7.191:8000/uploads/landing/about/1768393424_2.svg', NULL, NULL),
(33, 'about_card_icon_3', 'http://192.168.7.191:8000/uploads/landing/about/1768393424_3.svg', NULL, NULL),
(34, 'about_card_icon_4', 'http://192.168.7.191:8000/uploads/landing/about/1768393424_4.svg', NULL, NULL),
(35, 'about_card_icon_5', 'http://192.168.7.191:8000/uploads/landing/about/1768393424_5.svg', NULL, NULL),
(36, 'about_card_icon_6', 'http://192.168.7.191:8000/uploads/landing/about/1768393425_6.svg', NULL, NULL),
(37, 'about_card_icon_7', 'http://192.168.7.191:8000/uploads/landing/about/1768393425_7.svg', NULL, NULL),
(38, 'about_card_icon_8', 'http://192.168.7.191:8000/uploads/landing/about/1768393425_8.svg', NULL, NULL),
(39, 'about_card_icon_9', 'http://192.168.7.191:8000/uploads/landing/about/1768393425_9.svg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `runtime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `display_name`, `slug`, `version`, `runtime`, `is_active`, `is_default`, `icon`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'matl', 'MATL', 'matl-valo-hoye-jao', '22.5.0', 'matl', 0, 0, NULL, '<h3 class=\"h3\" style=\"margin: 3.125rem 0px 1.875rem; padding: 0px; font-variant-ligatures: none; font-family: &quot;Means Web&quot;, Georgia, Times, &quot;Times New Roman&quot;, serif; font-size: 32px; line-height: 1.25; color: rgb(35, 30, 21);\">What does Lorem Ipsum text say?</h3><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: &quot;Graphik Web&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, Verdana, sans-serif; font-size: 16px; line-height: 1.5; color: rgb(35, 30, 21);\">Printers in the 1500s scrambled the words from Cicero\'s \"De Finibus Bonorum et Malorum\'\' after mixing the words in each sentence. The familiar \"lorem ipsum dolor sit amet\" text emerged when 16th-century printers adapted Cicero\'s original work, beginning with the phrase \"dolor sit amet consectetur.\"</p><p style=\"margin: 1.875rem 0px 0px; padding: 0px; font-family: &quot;Graphik Web&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, Verdana, sans-serif; font-size: 16px; line-height: 1.5; color: rgb(35, 30, 21);\">They abbreviated \"dolorem\" (meaning \"pain\") to \"lorem,\" which carries no meaning in Latin. \"Ipsum\" translates to \"itself,\" and the text frequently includes phrases such as \"consectetur adipiscing elit\" and \"ut labore et dolore.\" These Latin fragments, derived from Cicero\'s philosophical treatise, were rearranged to create the standard dummy text that has become a fundamental tool in design and typography across generations.</p><p style=\"margin: 1.875rem 0px 0px; padding: 0px; font-family: &quot;Graphik Web&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, Verdana, sans-serif; font-size: 16px; line-height: 1.5; color: rgb(35, 30, 21);\">The short answer is that lorem ipsum text doesn\'t actually \"say\" anything meaningful. It\'s deliberately scrambled Latin that doesn\'t form coherent sentences. While it comes from Cicero\'s \"De Finibus Bonorum et Malorum,\" the text has been modified so extensively that it\'s nonsensical.</p><p style=\"margin: 1.875rem 0px 0px; padding: 0px; font-family: &quot;Graphik Web&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, Verdana, sans-serif; font-size: 16px; line-height: 1.5; color: rgb(35, 30, 21);\">Why scrambled text? That\'s exactly the point. By using text that\'s unreadable but maintains the general pattern of regular writing — including normal word length, spacing, and punctuation — designers can focus on the visual elements of a layout without the actual content getting in the way. The pseudo-Latin appearance gives it a natural feel while ensuring it won\'t distract from the design itself.</p>', '2026-01-11 08:07:39', '2026-01-15 04:02:55', NULL),
(2, 'matl', 'MATL', 'matl-1', '22.7.4', 'matl', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(3, 'bash', 'BASH', 'bash', '5.2.0', 'bash', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(4, 'befunge93', 'BEFUNGE93', 'befunge93', '0.2.0', 'befunge93', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-14 12:19:40', NULL),
(5, 'bqn', 'BQN', 'bqn', '1.0.0', 'bqn', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-14 12:19:47', NULL),
(6, 'brachylog', 'BRACHYLOG', 'brachylog', '1.0.0', 'brachylog', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-15 04:02:32', NULL),
(7, 'brainfuck', 'BRAINFUCK', 'brainfuck', '2.7.3', 'brainfuck', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(8, 'cjam', 'CJAM', 'cjam', '0.6.5', 'cjam', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(9, 'clojure', 'CLOJURE', 'clojure', '1.10.3', 'clojure', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(10, 'cobol', 'COBOL', 'cobol', '3.1.2', 'cobol', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(11, 'coffeescript', 'COFFEESCRIPT', 'coffeescript', '2.5.1', 'coffeescript', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(12, 'cow', 'COW', 'cow', '1.0.0', 'cow', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(13, 'crystal', 'CRYSTAL', 'crystal', '0.36.1', 'crystal', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(14, 'dart', 'DART', 'dart', '2.19.6', 'dart', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(15, 'dash', 'DASH', 'dash', '0.5.11', 'dash', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(16, 'typescript', 'TYPESCRIPT', 'typescript', '1.32.3', 'deno', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(17, 'javascript', 'JAVASCRIPT', 'javascript', '1.32.3', 'deno', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(18, 'basic.net', 'BASIC.NET', 'basicnet', '5.0.201', 'dotnet', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(19, 'fsharp.net', 'FSHARP.NET', 'fsharpnet', '5.0.201', 'dotnet', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(20, 'csharp.net', 'CSHARP.NET', 'csharpnet', '5.0.201', 'dotnet', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(21, 'fsi', 'FSI', 'fsi', '5.0.201', 'dotnet', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(22, 'dragon', 'DRAGON', 'dragon', '1.9.8', 'dragon', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(23, 'elixir', 'ELIXIR', 'elixir', '1.11.3', 'elixir', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(24, 'emacs', 'EMACS', 'emacs', '27.1.0', 'emacs', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(25, 'emojicode', 'EMOJICODE', 'emojicode', '1.0.2', 'emojicode', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(26, 'erlang', 'ERLANG', 'erlang', '23.0.0', 'erlang', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(27, 'file', 'FILE', 'file', '0.0.1', 'file', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(28, 'forte', 'FORTE', 'forte', '1.0.0', 'forte', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(29, 'forth', 'FORTH', 'forth', '0.7.3', 'forth', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(30, 'freebasic', 'FREEBASIC', 'freebasic', '1.9.0', 'freebasic', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(31, 'awk', 'AWK', 'awk', '5.1.0', 'gawk', 0, 0, NULL, NULL, '2026-01-11 08:07:39', '2026-01-11 08:07:39', NULL),
(32, 'c', 'C', 'c', '10.2.0', 'gcc', 1, 0, 'uploads/languages/1768393274_69678a3ad0d05.png', NULL, '2026-01-11 08:07:39', '2026-01-14 12:21:14', NULL),
(33, 'c++', 'C++', 'c-1', '10.2.0', 'gcc', 1, 0, 'uploads/languages/1768393141_696789b52b202.png', NULL, '2026-01-11 08:07:39', '2026-01-14 12:19:01', NULL),
(34, 'd', 'D', 'd', '10.2.0', 'gcc', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(35, 'fortran', 'FORTRAN', 'fortran', '10.2.0', 'gcc', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(36, 'go', 'GO', 'go', '1.16.2', 'go', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(37, 'golfscript', 'GOLFSCRIPT', 'golfscript', '1.0.0', 'golfscript', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(38, 'groovy', 'GROOVY', 'groovy', '3.0.7', 'groovy', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(39, 'haskell', 'HASKELL', 'haskell', '9.0.1', 'haskell', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(40, 'husk', 'HUSK', 'husk', '1.0.0', 'husk', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(41, 'iverilog', 'IVERILOG', 'iverilog', '11.0.0', 'iverilog', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(42, 'japt', 'JAPT', 'japt', '2.0.0', 'japt', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(43, 'java', 'JAVA', 'java', '15.0.2', 'java', 1, 0, 'uploads/languages/1768393089_6967898101d7e.webp', '<h3 class=\"h3\" style=\"margin: 3.125rem 0px 1.875rem; padding: 0px; font-variant-ligatures: none; font-family: &quot;Means Web&quot;, Georgia, Times, &quot;Times New Roman&quot;, serif; font-size: 32px; line-height: 1.25; color: rgb(35, 30, 21);\">What does Lorem Ipsum text say?</h3><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: &quot;Graphik Web&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, Verdana, sans-serif; font-size: 16px; line-height: 1.5; color: rgb(35, 30, 21);\">Printers in the 1500s scrambled the words from Cicero\'s \"De Finibus Bonorum et Malorum\'\' after mixing the words in each sentence. The familiar \"lorem ipsum dolor sit amet\" text emerged when 16th-century printers adapted Cicero\'s original work, beginning with the phrase \"dolor sit amet consectetur.\"</p><p style=\"margin: 1.875rem 0px 0px; padding: 0px; font-family: &quot;Graphik Web&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, Verdana, sans-serif; font-size: 16px; line-height: 1.5; color: rgb(35, 30, 21);\">They abbreviated \"dolorem\" (meaning \"pain\") to \"lorem,\" which carries no meaning in Latin. \"Ipsum\" translates to \"itself,\" and the text frequently includes phrases such as \"consectetur adipiscing elit\" and \"ut labore et dolore.\" These Latin fragments, derived from Cicero\'s philosophical treatise, were rearranged to create the standard dummy text that has become a fundamental tool in design and typography across generations.</p><p style=\"margin: 1.875rem 0px 0px; padding: 0px; font-family: &quot;Graphik Web&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, Verdana, sans-serif; font-size: 16px; line-height: 1.5; color: rgb(35, 30, 21);\">The short answer is that lorem ipsum text doesn\'t actually \"say\" anything meaningful. It\'s deliberately scrambled Latin that doesn\'t form coherent sentences. While it comes from Cicero\'s \"De Finibus Bonorum et Malorum,\" the text has been modified so extensively that it\'s nonsensical.</p><p style=\"margin: 1.875rem 0px 0px; padding: 0px; font-family: &quot;Graphik Web&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, Verdana, sans-serif; font-size: 16px; line-height: 1.5; color: rgb(35, 30, 21);\">Why scrambled text? That\'s exactly the point. By using text that\'s unreadable but maintains the general pattern of regular writing — including normal word length, spacing, and punctuation — designers can focus on the visual elements of a layout without the actual content getting in the way. The pseudo-Latin appearance gives it a natural feel while ensuring it won\'t distract from the design itself.</p>', '2026-01-11 08:07:40', '2026-01-14 12:18:09', NULL),
(44, 'jelly', 'JELLY', 'jelly', '0.1.31', 'jelly', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(45, 'julia', 'JULIA', 'julia', '1.8.5', 'julia', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(46, 'kotlin', 'KOTLIN', 'kotlin', '1.8.20', 'kotlin', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(47, 'lisp', 'LISP', 'lisp', '2.1.2', 'lisp', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(48, 'llvm_ir', 'LLVM_IR', 'llvm-ir', '12.0.1', 'llvm_ir', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(49, 'lolcode', 'LOLCODE', 'lolcode', '0.11.2', 'lolcode', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(50, 'lua', 'LUA', 'lua', '5.4.4', 'lua', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(51, 'csharp', 'CSHARP', 'csharp', '6.12.0', 'mono', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(52, 'basic', 'BASIC', 'basic', '6.12.0', 'mono', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(53, 'nasm', 'NASM', 'nasm', '2.15.5', 'nasm', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(54, 'nasm64', 'NASM64', 'nasm64', '2.15.5', 'nasm', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(55, 'nim', 'NIM', 'nim', '1.6.2', 'nim', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(56, 'javascript', 'JAVASCRIPT', 'javascript-1', '18.15.0', 'node', 1, 0, 'uploads/languages/1768393173_696789d5823ce.jpg', NULL, '2026-01-11 08:07:40', '2026-01-14 12:19:33', NULL),
(57, 'ocaml', 'OCAML', 'ocaml', '4.12.0', 'ocaml', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(58, 'octave', 'OCTAVE', 'octave', '8.1.0', 'octave', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(59, 'osabie', 'OSABIE', 'osabie', '1.0.1', 'osabie', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(60, 'paradoc', 'PARADOC', 'paradoc', '0.6.0', 'paradoc', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(61, 'pascal', 'PASCAL', 'pascal', '3.2.2', 'pascal', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(62, 'perl', 'PERL', 'perl', '5.36.0', 'perl', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(63, 'php', 'PHP', 'php', '8.2.3', 'php', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(64, 'ponylang', 'PONYLANG', 'ponylang', '0.39.0', 'ponylang', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(65, 'prolog', 'PROLOG', 'prolog', '8.2.4', 'prolog', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(66, 'pure', 'PURE', 'pure', '0.68.0', 'pure', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(67, 'powershell', 'POWERSHELL', 'powershell', '7.1.4', 'pwsh', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(68, 'pyth', 'PYTH', 'pyth', '1.0.0', 'pyth', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(69, 'python2', 'PYTHON2', 'python2', '2.7.18', 'python2', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(70, 'python', 'PYTHON', 'python', '3.10.0', 'python', 1, 0, 'uploads/languages/1768393317_69678a65a3519.png', NULL, '2026-01-11 08:07:40', '2026-01-14 12:21:57', NULL),
(71, 'racket', 'RACKET', 'racket', '8.3.0', 'racket', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(72, 'raku', 'RAKU', 'raku', '6.100.0', 'raku', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(73, 'retina', 'RETINA', 'retina', '1.2.0', 'retina', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(74, 'rockstar', 'ROCKSTAR', 'rockstar', '1.0.0', 'rockstar', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(75, 'rscript', 'RSCRIPT', 'rscript', '4.1.1', 'rscript', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(76, 'ruby', 'RUBY', 'ruby', '3.0.1', 'ruby', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(77, 'rust', 'RUST', 'rust', '1.68.2', 'rust', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(78, 'samarium', 'SAMARIUM', 'samarium', '0.3.1', 'samarium', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(79, 'scala', 'SCALA', 'scala', '3.2.2', 'scala', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(80, 'smalltalk', 'SMALLTALK', 'smalltalk', '3.2.3', 'smalltalk', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(81, 'sqlite3', 'SQLITE3', 'sqlite3', '3.36.0', 'sqlite3', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(82, 'swift', 'SWIFT', 'swift', '5.3.3', 'swift', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(83, 'typescript', 'TYPESCRIPT', 'typescript-1', '5.0.3', 'typescript', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(84, 'vlang', 'VLANG', 'vlang', '0.3.3', 'vlang', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(85, 'vyxal', 'VYXAL', 'vyxal', '2.4.1', 'vyxal', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(86, 'yeethon', 'YEETHON', 'yeethon', '3.10.0', 'yeethon', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(87, 'zig', 'ZIG', 'zig', '0.10.1', 'zig', 0, 0, NULL, NULL, '2026-01-11 08:07:40', '2026-01-11 08:07:40', NULL),
(88, 'html', 'HTML', 'html', '5', 'html', 1, 0, 'uploads/languages/1768393231_69678a0fe67a0.png', NULL, '2026-01-11 08:49:56', '2026-01-14 12:20:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_07_034138_create_permission_tables', 1),
(5, '2025_12_07_055654_create_teams_table', 1),
(6, '2025_12_08_043611_create_food_categories_table', 1),
(7, '2025_12_08_093201_create_food_table', 1),
(8, '2025_12_08_095520_create_today_meals_table', 1),
(9, '2025_12_09_154714_create_orders_table', 1),
(10, '2025_12_10_113355_add_order_no_to_orders_table', 1),
(11, '2025_12_10_151639_add_order_count_to_today_meals_table', 1),
(12, '2025_12_20_113002_add_team_foreign_to_users_table', 1),
(13, '2025_12_20_170407_create_settings_table', 1),
(14, '2026_01_11_091258_create_languages_table', 2),
(15, '2026_01_11_091259_create_languages_table', 3),
(16, '2026_01_11_121102_create_shared_codes_table', 4),
(17, '2026_01_11_091260_create_languages_table', 5),
(18, '2026_01_11_154245_create_landing_pages_table', 6),
(19, '2026_01_11_154246_create_landing_pages_table', 7),
(20, '2026_01_11_154247_create_landing_pages_table', 8),
(21, '2026_01_11_154248_create_landing_pages_table', 9),
(22, '2026_01_11_154249_create_landing_pages_table', 10),
(23, '2026_01_11_154250_create_landing_pages_table', 11),
(24, '2026_01_15_113052_create_dynamic_pages_table', 12),
(25, '2026_01_15_113053_create_dynamic_pages_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(2, 'vendor.order.status', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(3, 'vendor.food.view', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(4, 'vendor.food.create', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(5, 'vendor.food.update', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(6, 'vendor.food.delete', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(7, 'vendor.food.set_meal', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(8, 'vendor.food.stock_update', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(9, 'vendor.meal_history', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(10, 'vendor.payment_history', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(11, 'employee.make_order', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(12, 'employee.vendor_list', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(13, 'employee.place_order', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(14, 'employee.order.status', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(15, 'employee.order.cancel', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(16, 'employee.payment_history', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(17, 'office_staff.order.status', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(18, 'food_category.view', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(19, 'food_category.edit', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(20, 'food_category.create', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(21, 'food_category.delete', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(22, 'user.view', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(23, 'user.create', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(24, 'user.edit', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(25, 'user.delete', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(26, 'team.view', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(27, 'team.create', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(28, 'team.edit', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(29, 'team.delete', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(30, 'role.view', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(31, 'role.create', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(32, 'role.edit', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(33, 'role.delete', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(34, 'settings.view', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(35, 'settings.edit', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13'),
(36, 'profile.update', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2026-01-10 04:32:13', '2026-01-10 04:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('LCajEsh9yrU0amAt7e1z5PWFAos9tskNsERwBPWJ', 1, '192.168.7.191', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZ0RReHdIWlBId2dZOWdhV1hrZnp4RkljVkxJQTJBVjRhdUpIaTJmNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xOTIuMTY4LjcuMTkxOjgwMDAvYWRtaW4vZHluYW1pYy1wYWdlcyI7czo1OiJyb3V0ZSI7czoyNDoiYWRtaW4uZHluYW1pY19wYWdlLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjY6ImxvY2FsZSI7czoyOiJlbiI7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9fQ==', 1768459762);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `site_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `footer_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_description`, `footer_text`, `logo`, `favicon`, `email`, `phone`, `address`, `website`, `facebook`, `instagram`, `twitter`, `linkedin`, `created_at`, `updated_at`) VALUES
(1, 'Online Code Compiler', 'Printers in the 1500s scrambled the words from Cicero\'s \"De Finibus Bonorum et Malorum\'\' after mixing the words in each sentence. The familiar \"lorem ipsum dolor sit amet\" text emerged when 16th-century printers adapted Cicero\'s original work, beginning with the phrase \"dolor sit amet consectetur.\"', '© 2025 Online Code Compiler | Developed by Niaz SVD', 'uploads/settings/69638abcc1ab31768131260.png', 'uploads/settings/6963908027f921768132736.png', 'niaz.softvence@gmail.com', '01666666666', 'Dhaka Bangladesh', 'http://compiler.softvencedelta.com/', 'https://www.facebook.com/', 'https://www.instagram.com/', 'https://www.x.com/', 'https://www.linkedIn.com/', '2026-01-11 04:16:25', '2026-01-15 05:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `shared_codes`
--

CREATE TABLE `shared_codes` (
  `id` bigint UNSIGNED NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stdin` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shared_codes`
--

INSERT INTO `shared_codes` (`id`, `token`, `language`, `code`, `stdin`, `created_at`, `updated_at`) VALUES
(1, 'PpbWftAuNw2cLyjy', 'java', '// Write your JAVA code here...\n\n// Write your JAVA code here...\n\nimport java.util.*;\n\npublic class Main {\n    public static void main(String[] args) {\n      System.out.println(\"Hello, World!\");\n  }\n}', NULL, '2026-01-11 06:27:07', '2026-01-11 06:27:07'),
(2, 'yLFHRsvF4NT0u9S9', 'java', '// Write your JAVA code here...\n\n// Write your JAVA code here...\n\nimport java.util.*;\n\npublic class Main {\n    public static void main(String[] args) {\n      System.out.println(\"Hello, World!\");\n  }\n}', NULL, '2026-01-11 06:30:43', '2026-01-11 06:30:43'),
(3, 'Op8IWX62lYzI6HtN', 'java', '// Write your JAVA code here...\n\n// Write your JAVA code here...\n\nimport java.util.*;\n\npublic class Main {\n    public static void main(String[] args) {\n      System.out.println(\"Hello, World!\");\n  }\n}', 'gfhgfh', '2026-01-11 06:30:58', '2026-01-11 06:30:58'),
(4, 'oqqoAuDulDvovwbE', 'java', '// Write your JAVA code here...', NULL, '2026-01-11 06:35:34', '2026-01-11 06:35:34'),
(5, 'fBrnvbM7DbuZDFpq', 'java', '// Write your JAVA code here...', NULL, '2026-01-11 06:57:32', '2026-01-11 06:57:32'),
(6, 'x1DDQXWTR3757mOP', 'mono', 'using System;\nusing System.Collections.Generic;\nusing System.Linq;\nusing System.Text.RegularExpressions;\n\nnamespace HelloWorld\n{\n	public class Program\n	{\n		public static void Main(string[] args)\n		{\n			Console.WriteLine(\"Hello, World!\");\n		}\n	}\n}', NULL, '2026-01-11 07:05:39', '2026-01-11 07:05:39'),
(7, '6IztMQw3IUsndxHa', 'mono', '// Write your CSHARP code here...\n\nusing System;\nusing System.Collections.Generic;\nusing System.Linq;\nusing System.Text.RegularExpressions;\n\nnamespace HelloWorld\n{\n	public class Program\n	{\n		public static void Main(string[] args)\n		{\n			Console.WriteLine(\"Hello, World!\");\n		}\n	}\n}', NULL, '2026-01-11 07:07:47', '2026-01-11 07:07:47'),
(8, '4GQjuvPPi5OPRwfk', 'java', '// Write your JAVA code here...gfdgdg', NULL, '2026-01-11 11:12:43', '2026-01-11 11:12:43'),
(9, 'JZhOCALxU6uDUroc', 'java', '// Write your JAVA code here...', NULL, '2026-01-12 03:27:25', '2026-01-12 03:27:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `row` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seat_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade_licence` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visiting_card` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avater` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `employee_number`, `floor`, `row`, `seat_number`, `nid`, `nid_image`, `trade_licence`, `visiting_card`, `avater`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Niaz Ahmed Nayeem', 'admin@gmail.com', '01666666666', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/profile/6968604e85ddb1768448078.jpg', 1, NULL, '$2y$12$yvXqdj9WXilQPJx14HtLB..z16moNsCtH5zgjg33Lea/l6MzFlZt.', NULL, '2026-01-10 04:32:13', '2026-01-15 03:46:28'),
(5, 'Niaz', 'niaz.softvence@gmail.com', '01966509310', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/profile/69686698a4f991768449688.jpg', 1, NULL, '$2y$12$8ftNjafbSe7JJlgIdiR56.9r7TghBZ1LEofBFlC7/RSGOrpNGTHLu', NULL, '2026-01-15 03:56:59', '2026-01-15 04:01:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `dynamic_pages`
--
ALTER TABLE `dynamic_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dynamic_pages_page_slug_unique` (`page_slug`);

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
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landing_pages`
--
ALTER TABLE `landing_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `landing_pages_key_unique` (`key`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shared_codes`
--
ALTER TABLE `shared_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shared_codes_token_unique` (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dynamic_pages`
--
ALTER TABLE `dynamic_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landing_pages`
--
ALTER TABLE `landing_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shared_codes`
--
ALTER TABLE `shared_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

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
