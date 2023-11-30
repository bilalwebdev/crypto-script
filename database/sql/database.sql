-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2023 at 12:04 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sp_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `crypto_payments`
--

CREATE TABLE `crypto_payments` (
  `paymentID` bigint(20) UNSIGNED NOT NULL,
  `boxID` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `boxType` enum('paymentbox','captchabox') NOT NULL,
  `orderID` varchar(50) NOT NULL DEFAULT '',
  `userID` varchar(50) NOT NULL DEFAULT '',
  `countryID` varchar(3) NOT NULL DEFAULT '',
  `coinLabel` varchar(6) NOT NULL DEFAULT '',
  `amount` double(20,8) NOT NULL DEFAULT 0.00000000,
  `amountUSD` double(20,8) NOT NULL DEFAULT 0.00000000,
  `unrecognised` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `addr` varchar(34) NOT NULL DEFAULT '',
  `txID` char(64) NOT NULL DEFAULT '',
  `txDate` datetime DEFAULT NULL,
  `txConfirmed` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `txCheckDate` datetime DEFAULT NULL,
  `processed` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `processedDate` datetime DEFAULT NULL,
  `recordCreated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sp_admins`
--

CREATE TABLE `sp_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_admins`
--

INSERT INTO `sp_admins` (`id`, `username`, `email`, `image`, `type`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@demo.com', '64197a316de5f1679391281.png', 'super', '$2y$10$YqOC7i10okx.67MwG0zBYechJLCQOOWbFGw2fVr2UCnXf6SPD3scS', 1, NULL, '2023-02-27 01:04:06', '2023-03-21 03:34:41'),
(2, 'test', 'test@test.com', '64197fc82764e1679392712.jpg', NULL, '$2y$10$mHRvrLIv8JHiOY55XlpzHOPgu0brcskEMQ8YU5BuxO5N8EkHJe9j.', 1, NULL, '2023-03-21 03:58:32', '2023-03-21 03:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `sp_admin_password_resets`
--

CREATE TABLE `sp_admin_password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_admin_password_resets`
--

INSERT INTO `sp_admin_password_resets` (`id`, `email`, `token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin@demo.com', '745339', 0, '2023-03-21 05:19:40', '2023-03-21 05:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `sp_configurations`
--

CREATE TABLE `sp_configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pagination` int(11) NOT NULL DEFAULT 10,
  `number_format` int(11) NOT NULL DEFAULT 2,
  `alert` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `fonts` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_email_verification_on` tinyint(1) NOT NULL DEFAULT 0,
  `is_sms_verification_on` tinyint(1) NOT NULL DEFAULT 0,
  `preloader_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preloader_status` tinyint(1) NOT NULL DEFAULT 1,
  `analytics_status` tinyint(1) NOT NULL DEFAULT 0,
  `analytics_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_modal` tinyint(1) NOT NULL DEFAULT 1,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cookie_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_recaptcha` tinyint(1) NOT NULL DEFAULT 0,
  `recaptcha_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recaptcha_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tdio_allow` tinyint(1) NOT NULL DEFAULT 1,
  `tdio_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signup_bonus` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `withdraw_limit` int(11) DEFAULT NULL,
  `kyc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_allow_kyc` tinyint(1) DEFAULT NULL,
  `transfer_limit` int(11) DEFAULT NULL,
  `transfer_charge` decimal(28,8) DEFAULT 0.00000000,
  `transfer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfer_min_amount` decimal(28,8) DEFAULT 0.00000000,
  `transfer_max_amount` decimal(28,8) DEFAULT 0.00000000,
  `allow_facebook` tinyint(1) NOT NULL DEFAULT 0,
  `allow_google` tinyint(1) NOT NULL DEFAULT 0,
  `cron` datetime DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_sent_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_config` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decimal_precision` int(11) NOT NULL DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_configurations`
--

INSERT INTO `sp_configurations` (`id`, `appname`, `theme`, `currency`, `pagination`, `number_format`, `alert`, `logo`, `favicon`, `reg_enabled`, `fonts`, `is_email_verification_on`, `is_sms_verification_on`, `preloader_image`, `preloader_status`, `analytics_status`, `analytics_key`, `allow_modal`, `button_text`, `cookie_text`, `allow_recaptcha`, `recaptcha_key`, `recaptcha_secret`, `tdio_allow`, `tdio_url`, `seo_tags`, `seo_description`, `color`, `signup_bonus`, `withdraw_limit`, `kyc`, `is_allow_kyc`, `transfer_limit`, `transfer_charge`, `transfer_type`, `transfer_min_amount`, `transfer_max_amount`, `allow_facebook`, `allow_google`, `cron`, `copyright`, `email_method`, `email_sent_from`, `email_config`, `decimal_precision`, `created_at`, `updated_at`) VALUES
(1, 'TradeMax', 'default', 'usd', 10, 2, 'izi', 'logo.png', 'icon.png', 1, '{\"heading_font_url\":\"https:\\/\\/fonts.googleapis.com\\/css2?family=Roboto&display=swap\",\"heading_font_family\":\"\'Roboto\',\'sans-serif\'\",\"paragraph_font_url\":\"https:\\/\\/fonts.googleapis.com\\/css2?family=Roboto&display=swap\",\"paragraph_font_family\":\"\'Roboto\',\'sans-serif\'\"}', 1, 0, NULL, 0, 0, 'hjkhjk', 1, 'Lorem, ipsum.', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Delectus, autem.', 0, '6LfnhS8eAAAAAAg3LgUY0ZBU0cxvyO6EkF8ylgFL', '6LfnhS8eAAAAADPPV4Z4nmii8B4-8rZW2o67O9pf', 0, NULL, '[\"ZXZX\",\"ZXZXZX\"]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci delectus deleniti temporibus quas veritatis eaque quae iste excepturi natus unde magnam nostrum, officiis tenetur ipsam ratione accusamus nulla esse ab, cumque maxime fugiat modi. Unde dolore nisi nostrum, accusamus eum perferendis distinctio molestiae quam possimus cupiditate, velit ut consequatur eius?', '', '0.00000000', 2, '[{\"field_name\":\"asdasd\",\"type\":\"text\",\"validation\":\"required\"}]', 1, 2, '2.00000000', 'percent', '2.00000000', '2.00000000', 1, 1, NULL, 'asdasdas', 'smtp', 'test@gmail.com', '{\"smtp_host\":\"smtp.mailtrap.io\",\"smtp_username\":\"584c40511450c9\",\"smtp_password\":\"e1d710f58c8ed3\",\"smtp_port\":\"587\",\"smtp_encryption\":\"ssl\"}', 2, '2023-02-27 01:04:07', '2023-03-23 04:11:30');

-- --------------------------------------------------------

--
-- Table structure for table `sp_contents`
--

CREATE TABLE `sp_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `language_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_contents`
--

INSERT INTO `sp_contents` (`id`, `type`, `name`, `content`, `theme`, `language_id`, `created_at`, `updated_at`) VALUES
(16, 'iteratable', 'banner', '{\"language\":\"1\",\"title\":\"dasdasd\",\"color_text_for_title\":\"asdasd\",\"button_text\":\"asdasd\",\"button_text_link\":\"asdasdasd\",\"image_one\":\"64043911c21d61677998353.png\",\"image_two\":\"64043914246831677998356.png\"}', 'default', 1, '2023-03-05 00:39:16', '2023-03-05 00:39:16'),
(19, 'iteratable', 'banner', '{\"title\":\"asdasdas\",\"color_text_for_title\":\"dasdasd\",\"button_text\":\"asdasd\",\"button_text_link\":\"asdasdasd\",\"image_one\":\"64070f3ecf3151678184254.png\",\"image_two\":\"64070f3f051951678184255.png\"}', 'default', 1, '2023-03-05 04:48:52', '2023-03-07 04:17:35'),
(20, 'non_iteratable', 'about', '{\"language\":\"1\",\"title\":\"Join the signal max community\",\"color_text_for_title\":\"signal max\",\"button_text\":\"Get Started\",\"button_link\":\"\\/\",\"repeater\":[{\"repeater\":\"+10,000 points gold price jump from this multi-year support\"},{\"repeater\":\"+2000 points eurusd and usdchf made in the negative (inverse) correlation setup\"},{\"repeater\":\"+23,000 points fall in usdcad during crude oil crash\"},{\"repeater\":\"+11,500 points gold price gone up from the higher low\"},{\"repeater\":\"+14,000 points gbpcad fall from this high\"}],\"description\":\"Signal Max team provides High Quality Forex signals services exclusively to all type of traders around the world. Each signal given with chart analysis that helps you to trade with confidence on your account. Signal Max team worked with Major banks, Financial Institutions, Liquidity providers, Forex brokers in different job positions such as Equity Dealer, Fund Manager, Senior Market Analyst, Risk Manager and other major roles in Forex Trading Companies. Try free now to see the quality trades on your account.\",\"image_one\":\"641bf4c698b931679553734.png\",\"image_two\":\"641bf4c6b2e011679553734.png\"}', 'default', 1, '2023-03-07 04:38:55', '2023-03-23 00:43:22'),
(21, 'non_iteratable', 'why_choose_us', '{\"language\":\"1\",\"section_header\":\"why choose us\",\"title\":\"Choose us signal max\",\"color_text_for_title\":\"signal max\",\"image_one\":null}', 'default', 1, '2023-03-14 05:07:25', '2023-03-23 00:38:26'),
(26, 'iteratable', 'brand', '{\"image_one\":\"641c025de32d01679557213.png\"}', 'default', 1, '2023-03-14 23:41:55', '2023-03-23 01:40:13'),
(29, 'non_iteratable', 'benefits', '{\"language\":\"1\",\"section_header\":\"Summary of benefits\",\"title\":\"Everything you need to fast track your trading\",\"color_text_for_title\":\"track your trading\",\"image_one\":\"641bfc49e3fde1679555657.png\"}', 'default', 1, '2023-03-15 00:39:38', '2023-03-23 01:14:18'),
(32, 'iteratable', 'benefits', '{\"title\":\"Highly recommended\",\"icon\":\"fab fa-searchengin\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"641bfc84a185e1679555716.png\"}', 'default', 1, '2023-03-15 00:39:59', '2023-03-23 01:15:16'),
(35, 'non_iteratable', 'contact', '{\"language\":\"1\",\"section_header\":\"sdfsdf\",\"title\":\"sdfsdf\",\"color_text_for_title\":\"sdfsdf\",\"email\":\"sdfsdf\",\"phone\":\"sdfsdf\",\"address\":\"sdfsdf\",\"form_header\":\"sdfsdf\",\"color_text_for_form_header\":\"sdfsdfsdf\"}', 'default', 1, '2023-03-15 00:43:10', '2023-03-15 00:43:10'),
(36, 'non_iteratable', 'footer', '{\"language\":\"1\",\"footer_short_details\":\"sdfsdfsdfs\",\"image_one\":\"641169071bb431678862599.png\"}', 'default', 1, '2023-03-15 00:43:19', '2023-03-15 00:43:19'),
(37, 'non_iteratable', 'how_works', '{\"language\":\"1\",\"section_header\":\"How it works\",\"title\":\"Started trading with trademax\",\"color_text_for_title\":\"with trademax\"}', 'default', 1, '2023-03-15 00:43:25', '2023-03-23 01:27:19'),
(38, 'iteratable', 'how_works', '{\"title\":\"Choose plan\",\"description\":\"Choose which forex signal plan is suitable for you by checking the comparison of pricing table.\"}', 'default', 1, '2023-03-15 00:43:33', '2023-03-23 01:27:36'),
(39, 'iteratable', 'overview', '{\"title\":\"Total signal\",\"icon\":\"fas fa-satellite-dish\",\"counter\":\"25K\"}', 'default', 1, '2023-03-15 00:43:48', '2023-03-23 01:25:22'),
(40, 'non_iteratable', 'plans', '{\"language\":\"1\",\"section_header\":\"Our Best Packages\",\"title\":\"Our best packages\",\"color_text_for_title\":\"packages\",\"image_one\":\"641bff344b3371679556404.png\"}', 'default', 1, '2023-03-15 00:44:04', '2023-03-23 01:26:44'),
(41, 'non_iteratable', 'referral', '{\"language\":\"1\",\"section_header\":\"Referral\",\"title\":\"Referral comission\",\"color_text_for_title\":\"comission\"}', 'default', 1, '2023-03-15 00:44:12', '2023-03-23 01:36:21'),
(42, 'non_iteratable', 'team', '{\"language\":\"1\",\"section_header\":\"Our team\",\"title\":\"Our forex trading specialist\",\"color_text_for_title\":\"specialist\",\"image_one\":null}', 'default', 1, '2023-03-15 00:44:18', '2023-03-23 01:28:47'),
(43, 'iteratable', 'team', '{\"member_name\":\"Metfo janil\",\"designation\":\"Senior Web Developer\",\"facebook_url\":\"http:\\/\\/www.facebook.com\",\"twitter_url\":\"http:\\/\\/www.facebook.com\",\"linkedin_url\":\"http:\\/\\/www.facebook.com\",\"instagram_url\":\"http:\\/\\/www.facebook.com\",\"image_two\":\"641c0078e59021679556728.png\",\"image_one\":\"641bfff7802011679556599.jpg\"}', 'default', 1, '2023-03-15 00:44:51', '2023-03-23 01:32:09'),
(44, 'non_iteratable', 'testimonial', '{\"language\":\"1\",\"section_header\":\"Testimonial\",\"title\":\"What our customer says\",\"color_text_for_title\":\"customer says\",\"image_one\":null}', 'default', 1, '2023-03-15 00:45:12', '2023-03-23 01:37:02'),
(45, 'iteratable', 'testimonial', '{\"client_name\":\"Jhon Doe\",\"designation\":\"Developer\",\"description\":\"Signal max started by 20+ years experienced traders team who was worked with major banks, financial institutions, liquidity providers, forex brokers in different job positions such as equity dealer, fund manager, senior market analyst, risk manager and other major roles in forex trading companies.\",\"image_one\":\"641c01c8a57141679557064.jpg\"}', 'default', 1, '2023-03-15 00:45:31', '2023-03-23 01:37:44'),
(46, 'non_iteratable', 'blog', '{\"language\":\"1\",\"section_header\":\"Blog post\",\"title\":\"Our latest news\",\"color_text_for_title\":\"news\",\"image_one\":null}', 'default', 1, '2023-03-15 00:45:46', '2023-03-23 01:38:28');
INSERT INTO `sp_contents` (`id`, `type`, `name`, `content`, `theme`, `language_id`, `created_at`, `updated_at`) VALUES
INSERT INTO `sp_contents` (`id`, `type`, `name`, `content`, `theme`, `language_id`, `created_at`, `updated_at`) VALUES
(48, 'iteratable', 'socials', '{\"language\":\"1\",\"icon\":\"fas fa-braille\",\"link\":\"asdasdasd\"}', 'default', 1, '2023-03-15 00:46:11', '2023-03-15 00:46:11'),
(49, 'iteratable', 'links', '{\"language\":\"1\",\"page_title\":\"asdasd\",\"description\":\"<p>asdasdasdasd<\\/p>\"}', 'default', 1, '2023-03-15 00:46:24', '2023-03-15 00:46:24'),
(50, 'non_iteratable', 'auth', '{\"language\":\"1\",\"title\":\"asdasdasd\",\"image_one\":\"641c1e70cffd61679564400.png\"}', 'default', 1, '2023-03-15 00:46:36', '2023-03-23 03:40:00'),
(52, 'iteratable', 'why_choose_us', '{\"language\":\"1\",\"title\":\"Strong technical analysis\",\"icon\":\"far fa-user-circle\",\"description\":\"For each and every signals our analyst team will do a fundamental news research and technical analysis. we will share you all analysis to help you\",\"image_one\":\"641bf448acaad1679553608.png\"}', 'default', 1, '2023-03-23 00:40:08', '2023-03-23 00:40:08'),
(53, 'iteratable', 'benefits', '{\"title\":\"Full expert support\",\"icon\":\"far fa-user\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"641bfcc82d8621679555784.png\"}', 'default', 1, '2023-03-23 01:16:08', '2023-03-23 01:16:24'),
(54, 'iteratable', 'benefits', '{\"title\":\"Top technical analysis\",\"icon\":\"far fa-thumbs-up\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"641bfd106e1e21679555856.png\"}', 'default', 1, '2023-03-23 01:17:08', '2023-03-23 01:17:36'),
(55, 'iteratable', 'benefits', '{\"title\":\"High performance\",\"icon\":\"far fa-chart-bar\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"641bfe8d2abba1679556237.png\"}', 'default', 1, '2023-03-23 01:18:26', '2023-03-23 01:23:57'),
(56, 'iteratable', 'overview', '{\"language\":\"1\",\"title\":\"Total users\",\"icon\":\"far fa-user\",\"counter\":\"25K\"}', 'default', 1, '2023-03-23 01:25:54', '2023-03-23 01:25:54'),
(57, 'iteratable', 'how_works', '{\"language\":\"1\",\"title\":\"Your secure purchase\",\"description\":\"Complete your payment securely and easily with wide variety of available payment methods.\"}', 'default', 1, '2023-03-23 01:27:59', '2023-03-23 01:27:59'),
(58, 'iteratable', 'how_works', '{\"language\":\"1\",\"title\":\"Start receiving\",\"description\":\"You will receive the confirmation message shortly and your signal plan will be activated immediately.\"}', 'default', 1, '2023-03-23 01:28:10', '2023-03-23 01:28:10'),
(59, 'iteratable', 'brand', '{\"language\":\"1\",\"image_one\":\"641c026a62bed1679557226.png\"}', 'default', 1, '2023-03-23 01:40:26', '2023-03-23 01:40:26'),
(60, 'iteratable', 'brand', '{\"language\":\"1\",\"image_one\":\"641c0270445e81679557232.png\"}', 'default', 1, '2023-03-23 01:40:32', '2023-03-23 01:40:32'),
(61, 'iteratable', 'brand', '{\"language\":\"1\",\"image_one\":\"641c02766edbe1679557238.png\"}', 'default', 1, '2023-03-23 01:40:38', '2023-03-23 01:40:38'),
(62, 'iteratable', 'brand', '{\"language\":\"1\",\"image_one\":\"641c027c8322d1679557244.png\"}', 'default', 1, '2023-03-23 01:40:44', '2023-03-23 01:40:44'),
(63, 'iteratable', 'brand', '{\"language\":\"1\",\"image_one\":\"641c0282c2e041679557250.png\"}', 'default', 1, '2023-03-23 01:40:50', '2023-03-23 01:40:50'),
(64, 'non_iteratable', 'banner', '{\"language\":\"1\",\"title\":\"asdasd\",\"color_text_for_title\":\"asdasd\",\"button_text\":\"asdasd\",\"button_text_link\":\"asdasd\",\"repeater\":[{\"repeater\":\"asdasd\"}],\"image_one\":\"641c1bb116c9e1679563697.jpg\"}', 'theme2', 1, '2023-03-23 03:28:17', '2023-03-23 03:28:17'),
(65, 'non_iteratable', 'banner', '{\"language\":\"1\",\"title\":\"asdasdasd\",\"color_text_for_title\":\"asdasd\",\"button_text\":\"asdasd\",\"button_text_link\":\"asdasdasd\",\"repeater\":[{\"repeater\":\"asdasdasd\"}],\"image_two\":\"641c1d558e0361679564117.png\",\"image_one\":\"641c1d40a35f01679564096.png\"}', 'default', 1, '2023-03-23 03:34:56', '2023-03-23 03:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `sp_currency_pairs`
--

CREATE TABLE `sp_currency_pairs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_currency_pairs`
--

INSERT INTO `sp_currency_pairs` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Payoneer', 1, '2023-03-16 02:05:01', '2023-03-16 02:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `sp_dashboard_signals`
--

CREATE TABLE `sp_dashboard_signals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `signal_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_dashboard_signals`
--

INSERT INTO `sp_dashboard_signals` (`id`, `user_id`, `plan_id`, `signal_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 13241023, '2023-03-20 02:38:12', '2023-03-20 02:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `sp_deposits`
--

CREATE TABLE `sp_deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `gateway_id` bigint(20) UNSIGNED NOT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `total` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `status` int(11) NOT NULL COMMENT '1 => approved,2 => pending,3 => rejected',
  `type` int(11) NOT NULL DEFAULT 1 COMMENT '0=>manual , 1 => autometic',
  `payment_proof` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_deposits`
--

INSERT INTO `sp_deposits` (`id`, `user_id`, `gateway_id`, `trx`, `amount`, `rate`, `charge`, `total`, `status`, `type`, `payment_proof`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 'IY4M3KDLWUUWBAMK', '10.00000000', '5.00000000', '5.00000000', '55.00000000', 2, 0, '[]', '2023-03-18 23:43:11', '2023-03-19 00:45:52'),
(2, 1, 15, 'LKYQB01NBAD9PWN0', '10.00000000', '5.00000000', '5.00000000', '55.00000000', 1, 0, '[]', '2023-03-19 00:46:11', '2023-03-19 01:32:51'),
(3, 1, 15, '2FEUMEK8F6KKNLGD', '100.00000000', '5.00000000', '5.00000000', '505.00000000', 1, 0, '{\"asdasd\":\"asadasd\"}', '2023-03-19 00:46:50', '2023-03-19 01:31:57'),
(4, 1, 1, 'R5BMW2T20YH83LWK', '10.00000000', '1.00000000', '0.00000000', '10.00000000', 0, 1, NULL, '2023-03-19 01:40:47', '2023-03-19 01:40:47'),
(5, 1, 2, 'OOCZB2SFJJJZJVEW', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-19 01:43:41', '2023-03-19 01:43:41'),
(6, 1, 2, 'FUJPEEPFOLDXTU3B', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-19 01:56:59', '2023-03-19 01:56:59'),
(7, 1, 2, 'XEBJVR3R955JFXQT', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-19 02:38:39', '2023-03-19 02:38:39'),
(8, 1, 3, 'MDMX6GFIRRVQC96N', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-19 02:40:05', '2023-03-19 02:40:05'),
(9, 1, 3, 'O54NBZKFRTORGU4I', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-19 02:58:20', '2023-03-19 02:58:20'),
(10, 1, 4, 'B80XIFDUC8CD6173', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 1, 1, NULL, '2023-03-19 02:59:21', '2023-03-19 04:02:24'),
(11, 1, 4, 'DGRPN7JXAD5DJVDM', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 1, 1, NULL, '2023-03-19 04:02:47', '2023-03-19 04:03:26'),
(12, 1, 5, 'SYWV9HAQDPNTWZ7Y', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-19 04:04:59', '2023-03-19 04:04:59'),
(13, 1, 6, 'RJTTPVAJGT3V6KUM', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-19 04:34:28', '2023-03-19 04:34:28'),
(14, 1, 7, 'LHY0KYC7RVB01AUM', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-19 05:41:53', '2023-03-19 05:41:53'),
(15, 1, 8, 'JSKZHHIDO6KYGNYD', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-19 06:21:39', '2023-03-19 06:21:39'),
(16, 1, 8, 'T4COPL5WCJ6VA0YY', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-19 22:34:26', '2023-03-19 22:34:26'),
(17, 1, 14, '796YTSLPBE0VTUG2', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-19 23:11:09', '2023-03-19 23:11:09'),
(18, 1, 13, 'NNXB3DSWPT2LXER8', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-19 23:18:11', '2023-03-19 23:18:11'),
(19, 1, 12, 'NXR2XIEAVWVODHQM', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-19 23:26:21', '2023-03-19 23:26:21'),
(20, 1, 11, 'K1OMYHQAAP55PJZ9', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-19 23:30:37', '2023-03-19 23:30:37'),
(21, 1, 10, 'ZJ6ITAZDNVKF38WM', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 0, 1, NULL, '2023-03-20 00:26:25', '2023-03-20 00:26:25'),
(22, 1, 9, 'G43N8ROGZSQKZRFG', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 1, 1, NULL, '2023-03-20 00:36:53', '2023-03-20 00:41:28'),
(23, 1, 9, 'LR4THEZIJ8SCBH8O', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 1, 1, NULL, '2023-03-20 00:42:26', '2023-03-20 00:42:35'),
(24, 1, 15, 'VJK68LI8XUQZBYQ5', '100.00000000', '5.00000000', '5.00000000', '505.00000000', 2, 0, '{\"asdasd\":\"asadasd\"}', '2023-03-20 00:43:54', '2023-03-20 00:43:58'),
(25, 2, 9, 'APZ9FQX8YPJBTAXX', '70.00000000', '1.00000000', '0.00000000', '70.00000000', 1, 1, NULL, '2023-03-21 05:27:50', '2023-03-21 05:29:21'),
(26, 2, 9, 'I5UQAL4MV3FX07SI', '15.00000000', '1.00000000', '0.00000000', '15.00000000', 1, 1, NULL, '2023-03-21 05:31:04', '2023-03-21 05:31:14'),
(27, 2, 9, 'JJFEEVT5AJ3LGWTM', '100.00000000', '1.00000000', '0.00000000', '100.00000000', 1, 1, NULL, '2023-03-22 00:03:01', '2023-03-22 00:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `sp_frontend_components`
--

CREATE TABLE `sp_frontend_components` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `builder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_gateways`
--

CREATE TABLE `sp_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=manual, 1=autometic',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `rate` decimal(28,8) NOT NULL DEFAULT 1.00000000,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_gateways`
--

INSERT INTO `sp_gateways` (`id`, `name`, `image`, `parameter`, `type`, `status`, `rate`, `charge`, `created_at`, `updated_at`) VALUES
(1, 'stripe', '6417ea35ecacf1679288885.png', '{\"stripe_client_id\":\"asdad\",\"stripe_client_secret\":\"asdasd\",\"gateway_currency\":\"USD\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-03-19 23:08:06'),
(2, 'paypal', '6416bdfa944ed1679212026.png', '{\"gateway_currency\":\"USD\",\"mode\":\"sandbox\",\"paypal_client_id\":\"AQtCVGlS22wqYBGWPHW1a6aAVuUcFwSOWzUGoRvsbth2vUNNxrekowLwrYRwIYLMAetedRPu3hKMO57C\",\"paypal_client_secret\":\"EMksMmpKq5xfnJP3So7fVTyjghVV4mtUa70qsXbNAiw3nBF3ir6ENXZasxT-3cPDZ8ZXJX0DaggQFptv\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-03-19 02:37:12'),
(3, 'vougepay', '6416cb0fe2ae11679215375.png', '{\"gateway_currency\":\"NGN\",\"vouguepay_merchant_id\":\"sandbox_760e43f202878f651659820234cad9\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-03-19 02:56:07'),
(4, 'razorpay', '6416cf67c1f3f1679216487.jpg', '{\"gateway_currency\":\"INR\",\"razor_key\":\"rzp_test_r8XIwoQUldfBxE\",\"razor_secret\":\"G21wL8EwAeO2RIEg33qC1WjM\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-03-20 06:09:01'),
(5, 'coinpayments', '6416def071fea1679220464.jpg', '{\"public_key\":\"38c42afde7a4259c137e59f355e49347418c191acbc8fd7d28bf2cf6ba6fc8ef\",\"private_key\":\"2f01fbce867E045eF996f7edde430cDb36D5c9D8bC7B8A6B952f69E9209a95eb\",\"merchant_id\":\"f734643e069b93f729f13159274dcc4c\",\"gateway_currency\":\"USD\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-03-19 04:07:44'),
(6, 'mollie', '6416e59a54d3c1679222170.jpg', '{\"mollie_key\":\"test_kABABRpec7dDq2hurGdUEGR6hvsghJ\",\"gateway_currency\":\"USD\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-03-19 04:36:10'),
(7, 'nowpayments', '6416f4e80f5271679226088.png', '{\"nowpay_key\":\"GWNX9GQ-3MG4ZB3-Q4QCSD1-WMHR73F\",\"gateway_currency\":\"USD\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-03-19 05:41:28'),
(8, 'flutterwave', '6416fe475554e1679228487.jpg', '{\"public_key\":\"FLWPUBK_TEST-SANDBOXDEMOKEY-X\",\"reference_key\":\"titanic-48981487343MDI0NzMx\",\"gateway_currency\":\"USD\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-03-19 06:21:27'),
(9, 'paystack', '6417e2cd126f41679286989.png', '{\"paystack_key\":\"pk_test_267cf8526cf89ade67da431da3b2b59b04e9c4e0\",\"gateway_currency\":\"ZAR\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-03-19 22:36:29'),
(10, 'paghiper', '6417e33cf040f1679287100.png', '{\"paghiper_key\":\"apk_46328544-sawGwZEtyqZMGMpdKtqmmaIJzjLfZKMR\",\"token\":\"8G5O29JZNSDG851P6NTFVK3C7HS2T981PEQRNARB24RB\",\"gateway_currency\":\"BRL\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-03-19 22:38:21'),
(11, 'gourl_BTC', '6417e8c8927361679288520.png', '{\"gateway_currency\":\"BTC\",\"public_key\":\"sdaasd\",\"private_key\":\"asdasdasd\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-03-19 23:02:00'),
(12, 'perfectmoney', '6417e92d163cf1679288621.png', '{\"accountid\":\"asdasd\",\"passphrase\":\"asdasd\",\"gateway_currency\":\"USD\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-03-19 23:03:41'),
(13, 'mercadopago', '6417e977c60eb1679288695.jpg', '{\"access_token\":\"asdasd\",\"public_key\":\"asdasd\",\"gateway_currency\":\"USD\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-03-19 23:04:55'),
(14, 'paytm', '6417e9e96cb711679288809.png', '{\"gateway_currency\":\"INR\",\"mode\":\"0\",\"merchant_id\":\"f734643e069b93f729f13159274dcc4c\",\"merchant_key\":\"dasdasd\",\"merchant_website\":\"asasdas\",\"merchant_channel\":\"sadasd\",\"merchant_industry\":\"asdasdasd\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-03-19 23:06:49'),
(15, 'payoneer', '6417ea64a289a1679288932.jpg', '{\"name\":\"Payoneer\",\"account_number\":\"dsfsdf\",\"routing_number\":\"sdfsdf\",\"branch_name\":\"sdf\",\"gateway_currency\":\"USD\",\"gateway_type\":\"bank\",\"qr_code\":\"\",\"payment_instruction\":\"<p>test<\\/p>\\r\\n\\r\\n<p>asdasdasd<\\/p>\",\"user_proof_param\":[{\"field_name\":\"asdasd\",\"type\":\"text\",\"validation\":\"required\"}]}', 0, 1, '5.00000000', '5.00000000', '2023-03-08 23:38:57', '2023-03-19 23:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `sp_jobs`
--

CREATE TABLE `sp_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_languages`
--

CREATE TABLE `sp_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=>default,1=>changeable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_languages`
--

INSERT INTO `sp_languages` (`id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 0, '2023-02-28 01:27:04', '2023-02-28 01:27:04'),
(5, 'Spanish', 'sp', 1, '2023-03-21 02:54:41', '2023-03-21 02:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `sp_login_securities`
--

CREATE TABLE `sp_login_securities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `google2fa_enable` tinyint(1) NOT NULL,
  `google2fa_secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_login_securities`
--

INSERT INTO `sp_login_securities` (`id`, `user_id`, `google2fa_enable`, `google2fa_secret`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'CNVD7FOEN63Y4WHS', '2023-03-20 04:49:54', '2023-03-20 04:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `sp_markets`
--

CREATE TABLE `sp_markets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_markets`
--

INSERT INTO `sp_markets` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Forex', 1, '2023-03-16 02:03:02', '2023-03-16 02:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `sp_migrations`
--

CREATE TABLE `sp_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_migrations`
--

INSERT INTO `sp_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_02_22_104311_create_admins_table', 1),
(3, '2023_02_22_111101_create_configurations_table', 1),
(4, '2023_02_22_121218_create_gateways_table', 1),
(5, '2023_02_25_120246_create_users_table', 1),
(6, '2023_02_26_063704_create_admin_password_resets_table', 1),
(7, '2023_02_26_081605_create_deposits_table', 1),
(8, '2023_02_26_082931_create_withdraw_gateways_table', 1),
(9, '2023_02_26_084519_create_withdraws_table', 1),
(10, '2023_02_26_085002_create_tickets_table', 1),
(11, '2023_02_26_085317_create_ticket_replies_table', 1),
(12, '2023_02_26_085758_create_payments_table', 1),
(13, '2023_02_26_090322_create_user_logs_table', 1),
(14, '2023_02_26_091028_create_languages_table', 1),
(15, '2023_02_26_092247_create_notifications_table', 1),
(16, '2023_02_26_094347_create_permission_tables', 1),
(17, '2023_02_26_105957_create_pages_table', 1),
(18, '2023_02_26_110308_create_page_sections_table', 1),
(19, '2023_02_28_064341_create_contents_table', 2),
(20, '2023_02_28_104449_create_frontend_components_table', 3),
(21, '2023_03_07_113921_create_referrals_table', 4),
(22, '2023_03_11_064120_create_subscribers_table', 5),
(24, '2023_03_11_101143_create_templates_table', 6),
(25, '2021_08_15_113006_create_crypto_payments_table', 7),
(26, '2023_03_16_054806_create_plan_subscriptions_table', 7),
(27, '2023_03_16_055015_create_login_securities_table', 8),
(28, '2023_03_16_055208_create_transactions_table', 9),
(29, '2023_03_16_055624_create_plans_table', 10),
(30, '2023_03_16_072610_create_markets_table', 11),
(31, '2023_03_16_080329_create_currency_pairs_table', 12),
(32, '2023_03_16_080524_create_time_frames_table', 13),
(33, '2023_03_16_080747_create_signals_table', 14),
(34, '2023_03_16_081326_create_plan_signals_table', 15),
(35, '2023_03_18_052943_create_dashboard_signals_table', 16),
(36, '2023_03_18_053717_create_user_signals_table', 17),
(37, '2023_03_20_091115_create_money_transfers_table', 18),
(38, '2023_03_20_095030_create_referral_commissions_table', 19),
(39, '2023_03_22_060754_create_jobs_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `sp_model_has_permissions`
--

CREATE TABLE `sp_model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_model_has_roles`
--

CREATE TABLE `sp_model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_model_has_roles`
--

INSERT INTO `sp_model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(2, 'App\\Models\\Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sp_money_transfers`
--

CREATE TABLE `sp_money_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(28,8) NOT NULL,
  `charge` decimal(28,8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_notifications`
--

CREATE TABLE `sp_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_notifications`
--

INSERT INTO `sp_notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
(64, 'App\\Notifications\\KycUpdateNotification', 'App\\Models\\Admin', '1', '{\"user_id\":2,\"message\":\"test@gmail.com has submit kyc form\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/users\\/kyc\\/request\\/2\"}', '2023-03-22 00:02:38', '2023-03-21 23:45:04', '2023-03-22 00:02:38'),
(65, 'App\\Notifications\\DepositNotification', 'App\\Models\\Admin', '1', '{\"user_id\":2,\"message\":\"test@gmail.com has made a deposit amount of : 100.00000000\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/deposit\\/online\"}', NULL, '2023-03-22 00:03:59', '2023-03-22 00:03:59'),
(66, 'App\\Notifications\\KycUpdateNotification', 'App\\Models\\Admin', '1', '{\"user_id\":1,\"message\":\"admin@admin.com has submit kyc form\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/users\\/kyc\\/request\\/1\"}', NULL, '2023-03-22 05:35:01', '2023-03-22 05:35:01'),
(2391, 'App\\Notifications\\WithdrawNotification', 'App\\Models\\Admin', '1', '{\"user_id\":1,\"message\":\"admin@admin.com has made a Withdraw amount of : 10\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/withdraw\\/pending\"}', NULL, '2023-03-22 05:36:56', '2023-03-22 05:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `sp_pages`
--

CREATE TABLE `sp_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `is_dropdown` tinyint(1) NOT NULL,
  `seo_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_pages`
--

INSERT INTO `sp_pages` (`id`, `name`, `slug`, `order`, `is_dropdown`, `seo_keywords`, `seo_description`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Home', 'home', 1, 0, '[\"asdasd\"]', 'asdasd asd asd', 1, '2023-03-07 05:36:18', '2023-03-07 05:36:18'),
(4, 'about', 'about', 2, 1, '[\"dfsdfsdf\"]', 'asdasdasdasdasd', 1, '2023-03-20 05:13:22', '2023-03-20 05:13:22'),
(5, 'Contact', 'contact', 3, 0, '[\"test\"]', 'adasdasdasdasd', 1, '2023-03-20 05:19:31', '2023-03-23 04:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `sp_page_sections`
--

CREATE TABLE `sp_page_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `sections` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_page_sections`
--

INSERT INTO `sp_page_sections` (`id`, `page_id`, `sections`, `created_at`, `updated_at`) VALUES
(12, 4, '[\"about\",\"benefits\",\"blog\",\"overview\"]', '2023-03-23 01:08:58', '2023-03-23 01:08:58'),
(18, 3, '[\"why_choose_us\",\"about\",\"benefits\",\"overview\",\"plans\",\"how_works\",\"team\",\"referral\",\"testimonial\",\"blog\",\"brand\"]', '2023-03-23 01:12:54', '2023-03-23 01:12:54'),
(21, 5, '[\"contact\",\"brand\"]', '2023-03-23 04:31:56', '2023-03-23 04:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `sp_payments`
--

CREATE TABLE `sp_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` int(11) NOT NULL,
  `gateway_id` bigint(20) UNSIGNED NOT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(28,8) NOT NULL,
  `rate` decimal(28,8) NOT NULL,
  `charge` decimal(28,8) NOT NULL,
  `total` decimal(28,8) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=>approved, 2=>pending, 3=>rejected',
  `type` int(11) DEFAULT NULL,
  `proof` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rejection_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_payments`
--

INSERT INTO `sp_payments` (`id`, `user_id`, `plan_id`, `gateway_id`, `trx`, `amount`, `rate`, `charge`, `total`, `status`, `type`, `proof`, `rejection_reason`, `plan_expired_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 15, 'ZN6U30LXDOKSHE5S', '50.00000000', '5.00000000', '5.00000000', '255.00000000', 2, 0, '{\"asdasd\":\"asadasd\"}', NULL, '2023-04-01 01:21:36', '2023-03-20 01:21:36', '2023-03-20 01:25:14'),
(2, 1, 1, 1, 'OCAWWBWAMPYPHS5P', '50.00000000', '1.00000000', '0.00000000', '50.00000000', 0, 1, NULL, NULL, '2023-04-01 02:29:38', '2023-03-20 02:29:38', '2023-03-20 02:29:38'),
(3, 1, 1, 9, 'ID8ETGQSGXKFV5TX', '50.00000000', '1.00000000', '0.00000000', '50.00000000', 1, 1, NULL, NULL, '2023-04-01 02:30:23', '2023-03-20 02:30:23', '2023-03-20 02:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `sp_permissions`
--

CREATE TABLE `sp_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_permissions`
--

INSERT INTO `sp_permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage-admin', 'admin', NULL, NULL),
(2, 'manage-role', 'admin', NULL, NULL),
(3, 'manage-referral', 'admin', NULL, NULL),
(4, 'signal', 'admin', NULL, NULL),
(5, 'manage-plan', 'admin', NULL, NULL),
(6, 'manage-user', 'admin', NULL, NULL),
(7, 'manage-ticket', 'admin', NULL, NULL),
(8, 'manage-gateway', 'admin', NULL, NULL),
(9, 'payments', 'admin', NULL, NULL),
(10, 'manage-withdraw', 'admin', NULL, NULL),
(11, 'manage-deposit', 'admin', NULL, NULL),
(12, 'manage-theme', 'admin', NULL, NULL),
(13, 'manage-email', 'admin', NULL, NULL),
(14, 'manage-setting', 'admin', NULL, NULL),
(15, 'manage-language', 'admin', NULL, NULL),
(16, 'manage-logs', 'admin', NULL, NULL),
(17, 'manage-frontend', 'admin', NULL, NULL),
(18, 'manage-subscriber', 'admin', NULL, NULL),
(19, 'manage-report', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sp_personal_access_tokens`
--

CREATE TABLE `sp_personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_plans`
--

CREATE TABLE `sp_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(28,8) NOT NULL,
  `duration` int(11) NOT NULL,
  `plan_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` tinyint(1) NOT NULL,
  `telegram` tinyint(1) NOT NULL,
  `email` tinyint(1) NOT NULL,
  `sms` tinyint(1) NOT NULL,
  `dashboard` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_plans`
--

INSERT INTO `sp_plans` (`id`, `name`, `slug`, `price`, `duration`, `plan_type`, `price_type`, `feature`, `whatsapp`, `telegram`, `email`, `sms`, `dashboard`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', '50.00000000', 12, 'limited', 'paid', '[\"asasas\",\"asasas\"]', 0, 0, 0, 0, 1, 1, '2023-03-16 01:14:27', '2023-03-22 23:20:35');

-- --------------------------------------------------------

--
-- Table structure for table `sp_plan_signals`
--

CREATE TABLE `sp_plan_signals` (
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `signal_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_plan_signals`
--

INSERT INTO `sp_plan_signals` (`plan_id`, `signal_id`) VALUES
(1, 13241023);

-- --------------------------------------------------------

--
-- Table structure for table `sp_plan_subscriptions`
--

CREATE TABLE `sp_plan_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `is_current` tinyint(1) NOT NULL,
  `plan_expired_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_plan_subscriptions`
--

INSERT INTO `sp_plan_subscriptions` (`id`, `user_id`, `plan_id`, `is_current`, `plan_expired_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2023-04-01 08:30:23', '2023-03-20 02:30:34', '2023-03-20 02:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `sp_referrals`
--

CREATE TABLE `sp_referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_referrals`
--

INSERT INTO `sp_referrals` (`id`, `type`, `level`, `commission`, `status`, `created_at`, `updated_at`) VALUES
(1, 'invest', '[\"level 1\",\"level 2\",\"level 3\",\"level 4\",\"level 5\"]', '[\"2\",\"2\",\"2\",\"2\",\"2\"]', 1, '2023-03-08 23:19:15', '2023-03-08 23:20:04'),
(2, 'interest', '[\"level 1\",\"level 2\",\"level 3\",\"level 4\",\"level 5\"]', '[\"2\",\"2\",\"2\",\"2\",\"2\"]', 1, '2023-03-08 23:20:31', '2023-03-08 23:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `sp_referral_commissions`
--

CREATE TABLE `sp_referral_commissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commission_from` bigint(20) UNSIGNED NOT NULL,
  `commission_to` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(28,8) NOT NULL,
  `purpouse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_roles`
--

CREATE TABLE `sp_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_roles`
--

INSERT INTO `sp_roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '2023-02-27 01:04:07', '2023-02-27 01:04:07'),
(2, 'broker', 'admin', '2023-03-11 00:58:52', '2023-03-11 00:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `sp_role_has_permissions`
--

CREATE TABLE `sp_role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_role_has_permissions`
--

INSERT INTO `sp_role_has_permissions` (`permission_id`, `role_id`) VALUES
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
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sp_signals`
--

CREATE TABLE `sp_signals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_frame_id` bigint(20) UNSIGNED NOT NULL,
  `currency_pair_id` bigint(20) UNSIGNED NOT NULL,
  `market_id` bigint(20) UNSIGNED NOT NULL,
  `open_price` decimal(28,8) NOT NULL,
  `sl` decimal(28,8) NOT NULL,
  `tp` decimal(28,8) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `published_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_signals`
--

INSERT INTO `sp_signals` (`id`, `title`, `time_frame_id`, `currency_pair_id`, `market_id`, `open_price`, `sl`, `tp`, `image`, `description`, `direction`, `is_published`, `published_date`, `status`, `created_at`, `updated_at`) VALUES
(13241023, 'asdasdasd', 1, 1, 1, '12.20000000', '23.20000000', '23.20000000', '64154b9c723cb1679117212.jpg', '<p><p>asdasd</p><img data-filename=\"poll.png\" style=\"width: 511.992px;\" data-old=\"yes\" src=\"http://127.0.0.1:8000/images/summernote/16793014920.png\"></p>\n', 'buy', 1, '2023-03-20 02:38:12', 0, '2023-03-17 23:26:52', '2023-03-20 02:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `sp_subscribers`
--

CREATE TABLE `sp_subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_subscribers`
--

INSERT INTO `sp_subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', '2023-03-23 03:09:07', '2023-03-23 03:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `sp_templates`
--

CREATE TABLE `sp_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_templates`
--

INSERT INTO `sp_templates` (`id`, `name`, `subject`, `template`, `status`, `created_at`, `updated_at`) VALUES
(1, 'password_reset', 'verification', '<p>Hi %username%</p>\r\n\r\n<p>Your Verification Code is %code%</p>\r\n\r\n<p>Regard,</p>\r\n\r\n<p>%app_name%</p>', 1, NULL, '2023-03-21 04:38:36'),
(2, 'payment_successfull', 'Email For Payment Successfull', '<p>Hi %username%</p>\r\n\r\n<p><br></p>\r\n\r\n<p>%plan%</p>\r\n\r\n<p>%trx%</p>\r\n\r\n<p>%amount%</p>\r\n\r\n<p>%currency%</p>\r\n\r\n<p><br></p>\r\n\r\n<p>Regards,</p>\r\n\r\n<p>%app_name%</p>', 1, NULL, '2023-03-21 05:30:49'),
(3, 'payment_received', 'Your Payment Has Been Received', '<p>Hi %username%</p><p><br></p><p><br></p><p>Regards</p><p>%app_name%</p>', 1, NULL, '2023-03-21 05:42:10'),
(4, 'verify_email', 'verification', NULL, 0, NULL, NULL),
(5, 'payment_confirmed', 'verification', NULL, 0, NULL, NULL),
(6, 'payment_rejected', 'verification', NULL, 0, NULL, NULL),
(7, 'withdraw_accepted', 'verification', NULL, 0, NULL, NULL),
(8, 'withdraw_rejected', 'verification', NULL, 0, NULL, NULL),
(9, 'refer_commission', 'verification', NULL, 1, NULL, NULL),
(10, 'common_mail', 'verification', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sp_tickets`
--

CREATE TABLE `sp_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reply_id` bigint(20) UNSIGNED NOT NULL,
  `support_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=closed, 2=> pending, 3=> answered',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_ticket_replies`
--

CREATE TABLE `sp_ticket_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_time_frames`
--

CREATE TABLE `sp_time_frames` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_time_frames`
--

INSERT INTO `sp_time_frames` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Payoneer', 1, '2023-03-16 02:06:47', '2023-03-16 02:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `sp_transactions`
--

CREATE TABLE `sp_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(28,8) NOT NULL,
  `charge` decimal(28,8) NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_transactions`
--

INSERT INTO `sp_transactions` (`id`, `trx`, `user_id`, `amount`, `charge`, `details`, `type`, `created_at`, `updated_at`) VALUES
(8, 'MZ1KH3EQPU5UL3R', 1, '100.00000000', '1.00000000', 'Withdraw Balance', '-', '2023-03-20 03:05:50', '2023-03-20 03:05:50'),
(9, 'APZ9FQX8YPJBTAXX', 2, '70.00000000', '0.00000000', 'Payment Successfull', '-', '2023-03-21 05:29:21', '2023-03-21 05:29:21'),
(10, 'APZ9FQX8YPJBTAXX', 2, '70.00000000', '0.00000000', 'Payment Successfull', '-', '2023-03-21 05:29:38', '2023-03-21 05:29:38'),
(11, 'I5UQAL4MV3FX07SI', 2, '15.00000000', '0.00000000', 'Payment Successfull', '-', '2023-03-21 05:31:14', '2023-03-21 05:31:14'),
(12, 'JJFEEVT5AJ3LGWTM', 2, '100.00000000', '0.00000000', 'Payment Successfull', '-', '2023-03-22 00:03:59', '2023-03-22 00:03:59'),
(13, 'CBWT9FXSGIT4MV2', 1, '15.00000000', '1.00000000', 'Withdraw Balance', '-', '2023-03-22 05:36:08', '2023-03-22 05:36:08'),
(14, 'SYJP33PJL4T275X', 1, '10.00000000', '1.00000000', 'Withdraw Balance', '-', '2023-03-22 05:36:56', '2023-03-22 05:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `sp_users`
--

CREATE TABLE `sp_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(28,8) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_sms_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_kyc_verified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_at` datetime NOT NULL,
  `kyc_information` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_users`
--

INSERT INTO `sp_users` (`id`, `ref_id`, `username`, `email`, `phone`, `address`, `password`, `balance`, `image`, `is_email_verified`, `is_sms_verified`, `is_kyc_verified`, `email_verification_code`, `sms_verification_code`, `login_at`, `kyc_information`, `facebook_id`, `google_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 'admin@admin.com', 'test@test.com', 'test', '{\"country\":\"sadas\",\"city\":\"asdas\",\"zip\":\"asdasd\",\"state\":\"asdasd\"}', '$2y$10$Wrkfmmkk0L0Qi2h8G1ryhOHbG47Bo2ixLeCuRDa/v1yQJ4anw3qle', '285.00000000', '6418314b051fe1679307083.jpg', 1, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '{\"asdasd\":\"asadasd\"}', NULL, NULL, 1, NULL, '2023-03-15 23:25:57', '2023-03-23 03:56:43'),
(2, 1, 'test@gmail.com', 'test@gmail.com', '01676409054', NULL, '$2y$10$AcNx011nZeLhlSogpEXhMemKTA6gG/95QReAClOG0ZmybONZvFqHm', '355.00000000', NULL, 0, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '{\"asdasd\":\"asadasd\"}', NULL, NULL, 1, NULL, '2023-03-20 05:02:22', '2023-03-22 00:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `sp_user_logs`
--

CREATE TABLE `sp_user_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `system` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_user_logs`
--

INSERT INTO `sp_user_logs` (`id`, `user_id`, `browser`, `system`, `country`, `ip`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chrome', 'Windows', '', '', '2023-03-18 23:27:33', '2023-03-18 23:27:33'),
(2, 1, 'Chrome', 'Windows', '', '', '2023-03-19 22:32:43', '2023-03-19 22:32:43'),
(3, 1, 'Chrome', 'Windows', '', '', '2023-03-20 04:48:11', '2023-03-20 04:48:11'),
(4, 1, 'Chrome', 'Windows', '', '', '2023-03-20 05:02:38', '2023-03-20 05:02:38'),
(5, 1, 'Chrome', 'Windows', '', '', '2023-03-22 05:34:44', '2023-03-22 05:34:44'),
(6, 1, 'Chrome', 'Windows', '', '', '2023-03-23 03:54:40', '2023-03-23 03:54:40'),
(7, 1, 'Chrome', 'Windows', '', '', '2023-03-23 04:05:36', '2023-03-23 04:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `sp_user_signals`
--

CREATE TABLE `sp_user_signals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `signal_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_user_signals`
--

INSERT INTO `sp_user_signals` (`id`, `user_id`, `signal_id`, `created_at`, `updated_at`) VALUES
(1, 1, 13241023, '2023-03-20 02:38:12', '2023-03-20 02:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `sp_withdraws`
--

CREATE TABLE `sp_withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `withdraw_method_id` bigint(20) UNSIGNED NOT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `withdraw_amount` decimal(28,8) NOT NULL,
  `withdraw_charge` decimal(28,8) NOT NULL,
  `total` decimal(28,8) NOT NULL,
  `proof` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reject_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=>pending, 1=>approved, 2 => reject',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_withdraws`
--

INSERT INTO `sp_withdraws` (`id`, `user_id`, `withdraw_method_id`, `trx`, `withdraw_amount`, `withdraw_charge`, `total`, `proof`, `reject_reason`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 'MZ1KH3EQPU5UL3R', '100.00000000', '1.00000000', '99.00000000', '{\"email\":\"admin@gmail.com\",\"account_information\":\"asdasd\",\"note\":\"asdasd\"}', NULL, 0, '2023-03-20 03:05:50', '2023-03-20 03:05:50'),
(4, 1, 1, 'CBWT9FXSGIT4MV2', '15.00000000', '1.00000000', '14.00000000', '{\"email\":\"admin@gmail.com\",\"account_information\":\"ZXZX\",\"note\":\"ZXZXZX\"}', NULL, 0, '2023-03-22 05:36:08', '2023-03-22 05:36:08'),
(5, 1, 1, 'SYJP33PJL4T275X', '10.00000000', '1.00000000', '9.00000000', '{\"email\":\"admin@gmail.com\",\"account_information\":\"asd\",\"note\":\"asdasd\"}', NULL, 1, '2023-03-22 05:36:56', '2023-03-22 05:37:56');

-- --------------------------------------------------------

--
-- Table structure for table `sp_withdraw_gateways`
--

CREATE TABLE `sp_withdraw_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_withdraw_amount` decimal(28,8) NOT NULL,
  `max_withdraw_amount` decimal(28,8) NOT NULL,
  `charge` decimal(28,8) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_withdraw_gateways`
--

INSERT INTO `sp_withdraw_gateways` (`id`, `name`, `min_withdraw_amount`, `max_withdraw_amount`, `charge`, `type`, `instruction`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bank', '5.00000000', '500.00000000', '1.00000000', 'fixed', '<p>zxczxc</p><p>zxczxc</p>', 1, '2023-02-27 01:04:07', '2023-03-13 00:38:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crypto_payments`
--
ALTER TABLE `crypto_payments`
  ADD PRIMARY KEY (`paymentID`),
  ADD UNIQUE KEY `key3` (`boxID`,`orderID`,`userID`,`txID`,`amount`,`addr`),
  ADD KEY `boxID` (`boxID`),
  ADD KEY `boxType` (`boxType`),
  ADD KEY `userID` (`userID`),
  ADD KEY `countryID` (`countryID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `amount` (`amount`),
  ADD KEY `amountUSD` (`amountUSD`),
  ADD KEY `coinLabel` (`coinLabel`),
  ADD KEY `unrecognised` (`unrecognised`),
  ADD KEY `addr` (`addr`),
  ADD KEY `txID` (`txID`),
  ADD KEY `txDate` (`txDate`),
  ADD KEY `txConfirmed` (`txConfirmed`),
  ADD KEY `txCheckDate` (`txCheckDate`),
  ADD KEY `processed` (`processed`),
  ADD KEY `processedDate` (`processedDate`),
  ADD KEY `recordCreated` (`recordCreated`),
  ADD KEY `key1` (`boxID`,`orderID`),
  ADD KEY `key2` (`boxID`,`orderID`,`userID`);

--
-- Indexes for table `sp_admins`
--
ALTER TABLE `sp_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_admins_username_unique` (`username`),
  ADD UNIQUE KEY `sp_admins_email_unique` (`email`);

--
-- Indexes for table `sp_admin_password_resets`
--
ALTER TABLE `sp_admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_configurations`
--
ALTER TABLE `sp_configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_contents`
--
ALTER TABLE `sp_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_currency_pairs`
--
ALTER TABLE `sp_currency_pairs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_currency_pairs_name_unique` (`name`);

--
-- Indexes for table `sp_dashboard_signals`
--
ALTER TABLE `sp_dashboard_signals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_deposits`
--
ALTER TABLE `sp_deposits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_deposits_trx_unique` (`trx`);

--
-- Indexes for table `sp_frontend_components`
--
ALTER TABLE `sp_frontend_components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_gateways`
--
ALTER TABLE `sp_gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_gateways_name_unique` (`name`);

--
-- Indexes for table `sp_jobs`
--
ALTER TABLE `sp_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sp_jobs_queue_index` (`queue`);

--
-- Indexes for table `sp_languages`
--
ALTER TABLE `sp_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_languages_name_unique` (`name`),
  ADD UNIQUE KEY `sp_languages_code_unique` (`code`);

--
-- Indexes for table `sp_login_securities`
--
ALTER TABLE `sp_login_securities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_markets`
--
ALTER TABLE `sp_markets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_markets_name_unique` (`name`);

--
-- Indexes for table `sp_migrations`
--
ALTER TABLE `sp_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_model_has_permissions`
--
ALTER TABLE `sp_model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `sp_model_has_roles`
--
ALTER TABLE `sp_model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `sp_money_transfers`
--
ALTER TABLE `sp_money_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_notifications`
--
ALTER TABLE `sp_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_pages`
--
ALTER TABLE `sp_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_pages_name_unique` (`name`);

--
-- Indexes for table `sp_page_sections`
--
ALTER TABLE `sp_page_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_payments`
--
ALTER TABLE `sp_payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_payments_trx_unique` (`trx`);

--
-- Indexes for table `sp_permissions`
--
ALTER TABLE `sp_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `sp_personal_access_tokens`
--
ALTER TABLE `sp_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_personal_access_tokens_token_unique` (`token`),
  ADD KEY `sp_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sp_plans`
--
ALTER TABLE `sp_plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_plans_name_unique` (`name`),
  ADD UNIQUE KEY `sp_plans_slug_unique` (`slug`);

--
-- Indexes for table `sp_plan_subscriptions`
--
ALTER TABLE `sp_plan_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_referrals`
--
ALTER TABLE `sp_referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_referral_commissions`
--
ALTER TABLE `sp_referral_commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_roles`
--
ALTER TABLE `sp_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `sp_role_has_permissions`
--
ALTER TABLE `sp_role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `sp_role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sp_signals`
--
ALTER TABLE `sp_signals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_subscribers`
--
ALTER TABLE `sp_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_templates`
--
ALTER TABLE `sp_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_templates_name_unique` (`name`);

--
-- Indexes for table `sp_tickets`
--
ALTER TABLE `sp_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_ticket_replies`
--
ALTER TABLE `sp_ticket_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_time_frames`
--
ALTER TABLE `sp_time_frames`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_time_frames_name_unique` (`name`);

--
-- Indexes for table `sp_transactions`
--
ALTER TABLE `sp_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_users`
--
ALTER TABLE `sp_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_users_username_unique` (`username`),
  ADD UNIQUE KEY `sp_users_email_unique` (`email`),
  ADD UNIQUE KEY `sp_users_phone_unique` (`phone`);

--
-- Indexes for table `sp_user_logs`
--
ALTER TABLE `sp_user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_user_signals`
--
ALTER TABLE `sp_user_signals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_withdraws`
--
ALTER TABLE `sp_withdraws`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_withdraws_trx_unique` (`trx`);

--
-- Indexes for table `sp_withdraw_gateways`
--
ALTER TABLE `sp_withdraw_gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_withdraw_gateways_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crypto_payments`
--
ALTER TABLE `crypto_payments`
  MODIFY `paymentID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_admins`
--
ALTER TABLE `sp_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sp_admin_password_resets`
--
ALTER TABLE `sp_admin_password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_configurations`
--
ALTER TABLE `sp_configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_contents`
--
ALTER TABLE `sp_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `sp_currency_pairs`
--
ALTER TABLE `sp_currency_pairs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_dashboard_signals`
--
ALTER TABLE `sp_dashboard_signals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_deposits`
--
ALTER TABLE `sp_deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `sp_frontend_components`
--
ALTER TABLE `sp_frontend_components`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_gateways`
--
ALTER TABLE `sp_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sp_jobs`
--
ALTER TABLE `sp_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sp_languages`
--
ALTER TABLE `sp_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sp_login_securities`
--
ALTER TABLE `sp_login_securities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_markets`
--
ALTER TABLE `sp_markets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_migrations`
--
ALTER TABLE `sp_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `sp_money_transfers`
--
ALTER TABLE `sp_money_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_notifications`
--
ALTER TABLE `sp_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2392;

--
-- AUTO_INCREMENT for table `sp_pages`
--
ALTER TABLE `sp_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sp_page_sections`
--
ALTER TABLE `sp_page_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sp_payments`
--
ALTER TABLE `sp_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sp_permissions`
--
ALTER TABLE `sp_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sp_personal_access_tokens`
--
ALTER TABLE `sp_personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_plans`
--
ALTER TABLE `sp_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_plan_subscriptions`
--
ALTER TABLE `sp_plan_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_referrals`
--
ALTER TABLE `sp_referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sp_referral_commissions`
--
ALTER TABLE `sp_referral_commissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_roles`
--
ALTER TABLE `sp_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sp_signals`
--
ALTER TABLE `sp_signals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98163471;

--
-- AUTO_INCREMENT for table `sp_subscribers`
--
ALTER TABLE `sp_subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_templates`
--
ALTER TABLE `sp_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sp_tickets`
--
ALTER TABLE `sp_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_ticket_replies`
--
ALTER TABLE `sp_ticket_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sp_time_frames`
--
ALTER TABLE `sp_time_frames`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_transactions`
--
ALTER TABLE `sp_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sp_users`
--
ALTER TABLE `sp_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sp_user_logs`
--
ALTER TABLE `sp_user_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sp_user_signals`
--
ALTER TABLE `sp_user_signals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_withdraws`
--
ALTER TABLE `sp_withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sp_withdraw_gateways`
--
ALTER TABLE `sp_withdraw_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sp_model_has_permissions`
--
ALTER TABLE `sp_model_has_permissions`
  ADD CONSTRAINT `sp_model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `sp_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sp_model_has_roles`
--
ALTER TABLE `sp_model_has_roles`
  ADD CONSTRAINT `sp_model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `sp_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sp_role_has_permissions`
--
ALTER TABLE `sp_role_has_permissions`
  ADD CONSTRAINT `sp_role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `sp_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sp_role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `sp_roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;