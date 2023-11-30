-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2023 at 10:06 PM
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
-- Database: `signal`
--

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
  `color` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `bot_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_telegram` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `trade_charge` decimal(28,8) DEFAULT NULL,
  `min_trade_balance` decimal(28,8) DEFAULT NULL,
  `trade_limit` int(11) DEFAULT NULL,
  `crypto_api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dark_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_configurations`
--

INSERT INTO `sp_configurations` (`id`, `appname`, `theme`, `currency`, `pagination`, `number_format`, `alert`, `logo`, `favicon`, `reg_enabled`, `fonts`, `is_email_verification_on`, `is_sms_verification_on`, `preloader_image`, `preloader_status`, `analytics_status`, `analytics_key`, `allow_modal`, `button_text`, `cookie_text`, `allow_recaptcha`, `recaptcha_key`, `recaptcha_secret`, `tdio_allow`, `tdio_url`, `seo_tags`, `seo_description`, `color`, `signup_bonus`, `withdraw_limit`, `kyc`, `is_allow_kyc`, `transfer_limit`, `transfer_charge`, `transfer_type`, `transfer_min_amount`, `transfer_max_amount`, `allow_facebook`, `allow_google`, `cron`, `copyright`, `email_method`, `email_sent_from`, `email_config`, `decimal_precision`, `bot_url`, `telegram_token`, `allow_telegram`, `created_at`, `updated_at`, `trade_charge`, `min_trade_balance`, `trade_limit`, `crypto_api`, `dark_logo`) VALUES
(1, 'SignalMax', 'light', 'USD', 10, 2, 'izi', 'logo.png', 'icon.png', 1, '{\"heading_font_url\":\"https:\\/\\/fonts.googleapis.com\\/css2?family=Epilogue:wght@400;500;600;700&display=swap\",\"heading_font_family\":\"\'Epilogue\',\'sans-serif\'\",\"paragraph_font_url\":\"https:\\/\\/fonts.googleapis.com\\/css2?family=Poppins:wght@400;500&display=swap\",\"paragraph_font_family\":\"\'Poppins\',\'sans-serif\'\"}', 0, 0, NULL, 1, 1, 'hjkhjk', 1, 'Accept', 'By clicking “accept all cookies”, you agree stack exchange can store cookies on your device and disclose information in accordance with our cookie policy.', 0, '6LfnhS8eAAAAAAg3LgUY0ZBU0cxvyO6EkF8ylgFL', '6LfnhS8eAAAAADPPV4Z4nmii8B4-8rZW2o67O9pf', 1, 'dsadasdasdasdasdasd', '[\"ZXZX\",\"ZXZXZX\"]', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. adipisci delectus deleniti temporibus quas veritatis eaque quae iste excepturi natus unde magnam nostrum, officiis tenetur ipsam ratione accusamus nulla esse ab, cumque maxime fugiat modi. unde dolore nisi nostrum, accusamus eum perferendis distinctio molestiae quam possimus cupiditate, velit ut consequatur eius?', '\"\"', '500.00000000', 200, '[{\"field_label\":\"teset (required)\",\"field_name\":\"test\",\"type\":\"text\",\"validation\":\"required\"},{\"field_label\":\"asdasda\",\"field_name\":\"asdasd\",\"type\":\"text\",\"validation\":\"required\"}]', 0, 2, '2.00000000', 'percent', '2.00000000', '200.00000000', 0, 0, NULL, 'Copyright 2023 Signal Max . All Rights Reserved.', 'smtp', 'career@springsoftit.com', '{\"MAIL_DRIVER\":\"smtp\",\"MAIL_HOST\":\"sandbox.smtp.mailtrap.io\",\"MAIL_PORT\":\"587\",\"MAIL_USERNAME\":\"36c8fd83610f4d\",\"MAIL_PASSWORD\":\"fce37e1b98d6e9\",\"MAIL_ENCRYPTION\":\"tls\",\"MAIL_FROM_ADDRESS\":\"career@springsoftit.com\"}', 2, '@jairalok_bot', '6143471397:AAF2noabLskTTTdrdN8vAote5JNa_UPdxP8', 1, '2023-02-27 01:04:07', '2023-07-26 14:00:34', '2.00000000', '5.00000000', 2, '0c12e5e8785bf8922e9f0726a43667861f6d31ecc72203f17081a76c022c7826', 'dark_logo.png');

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
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_contents`
--

INSERT INTO `sp_contents` (`id`, `type`, `name`, `content`, `theme`, `language_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(149, 'non_iteratable', 'banner', '{\"title\":\"Forex trading signals alone are not enough\",\"color_text_for_title\":\"not enough\",\"button_text\":\"Get Started\",\"button_text_link\":\"login\",\"repeater\":[{\"repeater\":\"Learn how to read and forecast the markets\"},{\"repeater\":\"Discover how to find trade opportunities and manage risk\"},{\"repeater\":\"Make smarter decisions with experienced market analysts guidance\"},{\"repeater\":\"Unlock and trade up to $2.5M of our capital - keep 70% of any profits\"}],\"image_one\":\"645b70f58c43e1683714293.png\",\"image_two\":\"645b70f5a94b21683714293.png\"}', 'default', 0, NULL, '2023-05-10 04:18:34', '2023-05-11 00:35:37'),
(150, 'non_iteratable', 'about', '{\"title\":\"Join the TradeMax Community\",\"color_text_for_title\":\"TradeMax\",\"button_text\":\"Learn More\",\"button_link\":\"about\",\"repeater\":[{\"repeater\":\"Learn how to read and forecast the markets\"},{\"repeater\":\"Discover how to find trade opportunities and manage risk\"},{\"repeater\":\"Make smarter decisions with experienced market analysts guidance\"},{\"repeater\":\"Unlock and trade up to $2.5M of our capital - keep 70% of any profits\"}],\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora perferendis molestias nesciunt. Accusamus excepturi sint dicta velit nulla quod, natus dolorum inventore alias voluptates voluptatem, iste nemo consequuntur esse.\",\"image_one\":\"645b9082de1dc1683722370.png\",\"image_two\":\"645b90830273d1683722371.png\"}', 'default', 0, NULL, '2023-05-10 04:18:44', '2023-05-11 00:36:06'),
(151, 'non_iteratable', 'benefits', '{\"section_header\":\"Summary of Benefits\",\"title\":\"Everything You Need to Fast Track Your Trading\",\"color_text_for_title\":\"Track Your Trading\",\"image_one\":\"645b7110c9a051683714320.png\"}', 'default', 0, NULL, '2023-05-10 04:18:52', '2023-05-10 05:54:52'),
(154, 'non_iteratable', 'contact', '{\"section_header\":\"Contact\",\"title\":\"We\'d Love to Hear From You\",\"color_text_for_title\":\"Hear From You\",\"email\":\"support@company.com\",\"phone\":\"01857319149\",\"address\":\"Visit our office HQ 10\\/3A Zamzam Tower, Alwal Street Newyork\",\"form_header\":\"Love to hear from you, Get in touch\",\"color_text_for_form_header\":\"Get in touch\"}', 'default', 0, NULL, '2023-05-10 04:19:36', '2023-05-10 06:12:45'),
(155, 'non_iteratable', 'footer', '{\"footer_short_details\":\"Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat delectus maxime nisi explicabo doloribus minima similique, quia hic accusantium laudantium odit voluptatibus molestiae enim aut repellat.\",\"image_one\":\"645b89b17774f1683720625.png\"}', 'default', 0, NULL, '2023-05-10 04:19:45', '2023-05-10 06:10:25'),
(156, 'non_iteratable', 'how_works', '{\"section_header\":\"How it Works\",\"title\":\"Started Trading With TradeMax\",\"color_text_for_title\":\"With TradeMax\"}', 'default', 0, NULL, '2023-05-10 04:19:52', '2023-05-10 06:15:17'),
(159, 'non_iteratable', 'plans', '{\"section_header\":\"Packages\",\"title\":\"Our Best Packages\",\"color_text_for_title\":\"Packages\",\"image_one\":\"645b6feade0401683714026.png\"}', 'default', 0, NULL, '2023-05-10 04:20:27', '2023-05-10 06:26:38'),
(160, 'non_iteratable', 'referral', '{\"section_header\":\"Referral\",\"title\":\"Our Forex Trading Referral\",\"color_text_for_title\":\"Trading Referral\"}', 'default', 0, NULL, '2023-05-10 04:20:33', '2023-05-11 00:34:01'),
(161, 'non_iteratable', 'team', '{\"section_header\":\"Our Team\",\"title\":\"Our Forex Trading Specialist\",\"color_text_for_title\":\"Forex Trading\",\"image_one\":null}', 'default', 0, NULL, '2023-05-10 04:20:41', '2023-05-10 06:23:21'),
(163, 'non_iteratable', 'testimonial', '{\"section_header\":\"Testimonials\",\"title\":\"What Our Customer Says\",\"color_text_for_title\":\"Our Customer\",\"image_one\":null}', 'default', 0, NULL, '2023-05-10 04:21:34', '2023-05-10 06:20:31'),
(165, 'non_iteratable', 'why_choose_us', '{\"section_header\":\"Choose Us\",\"title\":\"Why Choose TradeMax\",\"color_text_for_title\":\"TradeMax\",\"image_one\":null}', 'default', 0, NULL, '2023-05-10 04:21:55', '2023-05-10 06:16:52'),
(167, 'non_iteratable', 'blog', '{\"section_header\":\"Blog Post\",\"title\":\"Our Latest News\",\"color_text_for_title\":\"News\",\"image_one\":null}', 'default', 0, NULL, '2023-05-10 04:22:18', '2023-05-10 06:35:26'),
(169, 'iteratable', 'socials', '{\"icon\":\"fas fa-headset\",\"link\":\"https:\\/\\/www.youtube.com\\/embed\\/YF26L8cFnLw\"}', 'default', 0, NULL, '2023-05-10 04:22:42', '2023-05-10 04:22:42'),
(170, 'iteratable', 'links', '{\"page_title\":\"sdfsdf\",\"description\":\"<p>asdasdasd<\\/p>\"}', 'default', 0, NULL, '2023-05-10 04:22:54', '2023-05-10 04:22:54'),
(171, 'non_iteratable', 'auth', '{\"title\":\"asdasdasd\",\"image_one\":\"645b7088d8dee1683714184.png\"}', 'default', 0, NULL, '2023-05-10 04:23:04', '2023-05-10 04:23:04'),
(172, 'iteratable', 'benefits', '{\"title\":\"Top technical analysis\",\"icon\":\"fab fa-searchengin\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"645b866696d2b1683719782.png\"}', 'default', 0, NULL, '2023-05-10 05:56:22', '2023-05-11 00:44:38'),
(173, 'iteratable', 'benefits', '{\"title\":\"Full expert support\",\"icon\":\"far fa-user\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"645b868dc03051683719821.png\"}', 'default', 0, NULL, '2023-05-10 05:57:01', '2023-05-11 00:45:41'),
(174, 'iteratable', 'benefits', '{\"title\":\"Highly recommended\",\"icon\":\"far fa-thumbs-up\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"645b86bf9c2b01683719871.png\"}', 'default', 0, NULL, '2023-05-10 05:57:51', '2023-05-11 00:46:29'),
(175, 'iteratable', 'benefits', '{\"title\":\"High performance\",\"icon\":\"far fa-chart-bar\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"645b86d565db91683719893.png\"}', 'default', 0, NULL, '2023-05-10 05:58:13', '2023-05-11 00:46:58'),
(176, 'iteratable', 'benefits', '{\"title\":\"Direct Email and SMS* signals\",\"icon\":\"far fa-envelope\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"645b86fc69aea1683719932.png\"}', 'default', 0, NULL, '2023-05-10 05:58:52', '2023-05-11 00:47:30'),
(177, 'iteratable', 'benefits', '{\"title\":\"Join a growing community\",\"icon\":\"fas fa-users\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"645b87238dc001683719971.png\"}', 'default', 0, NULL, '2023-05-10 05:59:31', '2023-05-11 00:48:05'),
(178, 'iteratable', 'brand', '{\"image_one\":\"645b87a25db3c1683720098.png\"}', 'default', 0, NULL, '2023-05-10 06:01:38', '2023-05-10 06:01:38'),
(179, 'iteratable', 'brand', '{\"image_one\":\"645b87aa1f34b1683720106.png\"}', 'default', 0, NULL, '2023-05-10 06:01:46', '2023-05-10 06:01:46'),
(180, 'iteratable', 'brand', '{\"image_one\":\"645b87afc24751683720111.png\"}', 'default', 0, NULL, '2023-05-10 06:01:51', '2023-05-10 06:01:51'),
(181, 'iteratable', 'brand', '{\"image_one\":\"645b87b70b7111683720119.png\"}', 'default', 0, NULL, '2023-05-10 06:01:59', '2023-05-10 06:01:59'),
(182, 'iteratable', 'brand', '{\"image_one\":\"645b87bd8756f1683720125.png\"}', 'default', 0, NULL, '2023-05-10 06:02:05', '2023-05-10 06:02:05'),
(183, 'iteratable', 'brand', '{\"image_one\":\"645b87c38b29f1683720131.png\"}', 'default', 0, NULL, '2023-05-10 06:02:11', '2023-05-10 06:02:11'),
(184, 'iteratable', 'brand', '{\"image_one\":\"645b87ca64dce1683720138.png\"}', 'default', 0, NULL, '2023-05-10 06:02:18', '2023-05-10 06:02:18'),
(185, 'iteratable', 'brand', '{\"image_one\":\"645b87d2854eb1683720146.png\"}', 'default', 0, NULL, '2023-05-10 06:02:26', '2023-05-10 06:02:26'),
(186, 'iteratable', 'brand', '{\"image_one\":\"645b87d7c6e581683720151.png\"}', 'default', 0, NULL, '2023-05-10 06:02:31', '2023-05-10 06:02:31'),
(187, 'iteratable', 'socials', '{\"icon\":\"fab fa-facebook-f\",\"link\":\"https:\\/\\/www.facebook.com\"}', 'default', 0, NULL, '2023-05-10 06:06:05', '2023-05-10 06:06:05'),
(188, 'iteratable', 'socials', '{\"icon\":\"fab fa-twitter\",\"link\":\"https:\\/\\/twitter.com\\/\"}', 'default', 0, NULL, '2023-05-10 06:08:36', '2023-05-10 06:08:36'),
(189, 'iteratable', 'socials', '{\"icon\":\"fab fa-linkedin-in\",\"link\":\"https:\\/\\/linkedin.com\\/\"}', 'default', 0, NULL, '2023-05-10 06:08:51', '2023-05-10 06:08:51'),
(190, 'iteratable', 'socials', '{\"icon\":\"fab fa-telegram-plane\",\"link\":\"https:\\/\\/telegram.org\\/\"}', 'default', 0, NULL, '2023-05-10 06:09:03', '2023-05-10 06:09:03'),
(191, 'iteratable', 'socials', '{\"icon\":\"fab fa-instagram\",\"link\":\"https:\\/\\/instagram.com\\/\"}', 'default', 0, NULL, '2023-05-10 06:09:14', '2023-05-10 06:09:14'),
(192, 'iteratable', 'how_works', '{\"title\":\"Open An Account\",\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae laboriosam adipisci neque cumque, corrupti.\"}', 'default', 0, NULL, '2023-05-10 06:15:36', '2023-05-10 06:15:36'),
(193, 'iteratable', 'how_works', '{\"title\":\"Deposit Amount\",\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae laboriosam adipisci neque cumque, corrupti.\"}', 'default', 0, NULL, '2023-05-10 06:15:50', '2023-05-10 06:15:50'),
(194, 'iteratable', 'how_works', '{\"title\":\"Start Trading\",\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae laboriosam adipisci neque cumque, corrupti.\"}', 'default', 0, NULL, '2023-05-10 06:16:02', '2023-05-10 06:16:02'),
(195, 'iteratable', 'why_choose_us', '{\"title\":\"Meta Trader\",\"icon\":\"far fa-user-circle\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus adipisci eos, molestias, itaque aspernatur quis saepe recusandae fugit.\",\"image_one\":\"645b8b6befee71683721067.png\"}', 'default', 0, NULL, '2023-05-10 06:17:48', '2023-05-11 01:44:20'),
(196, 'iteratable', 'why_choose_us', '{\"title\":\"Competetive Pricing\",\"icon\":\"far fa-chart-bar\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus adipisci eos, molestias, itaque aspernatur quis saepe recusandae fugit.\",\"image_one\":\"645b8b88d22fe1683721096.png\"}', 'default', 0, NULL, '2023-05-10 06:18:16', '2023-05-11 01:44:56'),
(197, 'iteratable', 'why_choose_us', '{\"title\":\"Active Trader\",\"icon\":\"fas fa-bolt\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus adipisci eos, molestias, itaque aspernatur quis saepe recusandae fugit.\",\"image_one\":\"645b8bab65d931683721131.png\"}', 'default', 0, NULL, '2023-05-10 06:18:51', '2023-05-11 01:45:32'),
(198, 'iteratable', 'testimonial', '{\"client_name\":\"Fluria Jafe\",\"designation\":\"Investor\",\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolores eaque dolorum quisquam consectetur est cumque ad tenetur sit? Obcaecati laboriosam illo ipsa culpa quaerat maiores! Nobis, inventore, cumque eos laudantium ducimus blanditiis magni reprehenderit ipsum iusto ab asperiores! Aut nisi qui dignissimos non ipsa accusantium ut, assumenda asperiores voluptate.\",\"image_one\":\"645b8c539eeda1683721299.jpg\"}', 'default', 0, NULL, '2023-05-10 06:21:39', '2023-05-10 06:21:39'),
(199, 'iteratable', 'testimonial', '{\"client_name\":\"Justin & UK\",\"designation\":\"Volunteer\",\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolores eaque dolorum quisquam consectetur est cumque ad tenetur sit? Obcaecati laboriosam illo ipsa culpa quaerat maiores! Nobis, inventore, cumque eos laudantium ducimus blanditiis magni reprehenderit ipsum iusto ab asperiores! Aut nisi qui dignissimos non ipsa accusantium ut, assumenda asperiores voluptate.\",\"image_one\":\"645b8c65acae01683721317.jpg\"}', 'default', 0, NULL, '2023-05-10 06:21:57', '2023-05-10 06:21:57'),
(200, 'iteratable', 'testimonial', '{\"client_name\":\"Juan P\\u00e9rez\",\"designation\":\"Senior Copy Tader\",\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolores eaque dolorum quisquam consectetur est cumque ad tenetur sit? Obcaecati laboriosam illo ipsa culpa quaerat maiores! Nobis, inventore, cumque eos laudantium ducimus blanditiis magni reprehenderit ipsum iusto ab asperiores! Aut nisi qui dignissimos non ipsa accusantium ut, assumenda asperiores voluptate.\",\"image_one\":\"645b8c761679c1683721334.jpg\"}', 'default', 0, NULL, '2023-05-10 06:22:14', '2023-05-10 06:22:14'),
(201, 'iteratable', 'testimonial', '{\"client_name\":\"Jhon Mekila Mrsd\",\"designation\":\"Senior Copy Tader\",\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolores eaque dolorum quisquam consectetur est cumque ad tenetur sit? Obcaecati laboriosam illo ipsa culpa quaerat maiores! Nobis, inventore, cumque eos laudantium ducimus blanditiis magni reprehenderit ipsum iusto ab asperiores! Aut nisi qui dignissimos non ipsa accusantium ut, assumenda asperiores voluptate.\",\"image_one\":\"645b8c8674c361683721350.jpg\"}', 'default', 0, NULL, '2023-05-10 06:22:30', '2023-05-10 06:22:30'),
(202, 'iteratable', 'team', '{\"member_name\":\"Metfo Janil\",\"designation\":\"Investor\",\"facebook_url\":\"https:\\/\\/www.facebook.com\\/\",\"twitter_url\":\"https:\\/\\/www.twitter .com\\/\",\"linkedin_url\":\"https:\\/\\/www.linkedin .com\\/\",\"instagram_url\":\"https:\\/\\/www.instagram .com\\/\",\"image_one\":\"645b8ccee07491683721422.jpg\"}', 'default', 0, NULL, '2023-05-10 06:23:42', '2023-05-10 06:23:42'),
(203, 'iteratable', 'team', '{\"member_name\":\"Kmor Kotv\",\"designation\":\"Investor\",\"facebook_url\":\"https:\\/\\/www.facebook.com\\/\",\"twitter_url\":\"https:\\/\\/www.twitter .com\\/\",\"linkedin_url\":\"https:\\/\\/www.linkedin .com\\/\",\"instagram_url\":\"https:\\/\\/www.instagram .com\\/\",\"image_one\":\"645b8ce29bbbc1683721442.jpg\"}', 'default', 0, NULL, '2023-05-10 06:24:02', '2023-05-10 06:24:02'),
(204, 'iteratable', 'team', '{\"member_name\":\"Dimuni Sakmil\",\"designation\":\"Senior Copy Tader\",\"facebook_url\":\"https:\\/\\/www.facebook.com\\/\",\"twitter_url\":\"https:\\/\\/www.twitter .com\\/\",\"linkedin_url\":\"https:\\/\\/www.linkedin .com\\/\",\"instagram_url\":\"https:\\/\\/www.instagram .com\\/\",\"image_one\":\"645b8cf7980561683721463.jpg\"}', 'default', 0, NULL, '2023-05-10 06:24:23', '2023-05-10 06:24:23'),
(205, 'iteratable', 'team', '{\"member_name\":\"MG Morgan\",\"designation\":\"Volunteer\",\"facebook_url\":\"https:\\/\\/www.facebook.com\\/\",\"twitter_url\":\"https:\\/\\/www.twitter .com\\/\",\"linkedin_url\":\"https:\\/\\/www.linkedin .com\\/\",\"instagram_url\":\"https:\\/\\/www.instagram .com\\/\",\"image_one\":\"645b8d091d9051683721481.jpg\"}', 'default', 0, NULL, '2023-05-10 06:24:41', '2023-05-10 06:24:41'),
(206, 'iteratable', 'team', '{\"member_name\":\"MK Jon\",\"designation\":\"Investor\",\"facebook_url\":\"https:\\/\\/www.facebook.com\\/\",\"twitter_url\":\"https:\\/\\/www.twitter .com\\/\",\"linkedin_url\":\"https:\\/\\/www.linkedin .com\\/\",\"instagram_url\":\"https:\\/\\/www.instagram .com\\/\",\"image_one\":\"645b8d234d9d01683721507.jpg\"}', 'default', 0, NULL, '2023-05-10 06:25:07', '2023-05-10 06:25:07'),
(207, 'iteratable', 'team', '{\"member_name\":\"Metfo Janil\",\"designation\":\"Senior Web Developer\",\"facebook_url\":\"https:\\/\\/www.facebook.com\\/\",\"twitter_url\":\"https:\\/\\/www.twitter .com\\/\",\"linkedin_url\":\"https:\\/\\/www.linkedin .com\\/\",\"instagram_url\":\"https:\\/\\/www.instagram .com\\/\",\"image_one\":\"645b8d3e101cb1683721534.jpg\"}', 'default', 0, NULL, '2023-05-10 06:25:34', '2023-05-10 06:25:34'),
(208, 'iteratable', 'overview', '{\"title\":\"Total Signal\",\"icon\":\"fas fa-satellite-dish\",\"counter\":\"25M +\"}', 'default', 0, NULL, '2023-05-10 06:32:47', '2023-05-11 01:42:39'),
(209, 'iteratable', 'overview', '{\"title\":\"Total Users\",\"icon\":\"fas fa-user-check\",\"counter\":\"235M+\"}', 'default', 0, NULL, '2023-05-10 06:33:12', '2023-05-10 06:33:12'),
(210, 'iteratable', 'overview', '{\"title\":\"Success Rate\",\"icon\":\"fas fa-chart-line\",\"counter\":\"4560M+\"}', 'default', 0, NULL, '2023-05-10 06:33:41', '2023-05-10 06:33:41'),
(211, 'iteratable', 'overview', '{\"title\":\"Total Award\",\"icon\":\"fas fa-award\",\"counter\":\"856000M+\"}', 'default', 0, NULL, '2023-05-10 06:34:16', '2023-05-10 06:34:16'),
(212, 'iteratable', 'blog', '{\"blog_title\":\"Temporibus, dignissimos aperiam accusamus dolore\",\"short_description\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc diam sapien, bibendum eu suscipit ut, lacinia in turpis. Donec facilisis ipsum nec eros cursus commodo sit amet at eros. Aenean semper massa maximus dui cursus, vitae aliquam mauris gravida. Nam at sagittis metus, in cursus augue. Pellentesque mollis ullamcorper urna et rutrum. Vestibulum convallis eros posuere dictum interdum. Fusce convallis ante in dolor facilisis, vitae commodo justo pharetra.\",\"description\":\"<p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\"><br><\\/p><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam aliquam lorem non risus accumsan vulputate. Praesent eget mi id arcu faucibus bibendum id ut odio. Curabitur viverra justo id iaculis facilisis. Curabitur sed interdum nibh. Phasellus maximus purus sed consequat varius. Mauris fermentum scelerisque magna, eu euismod enim. Curabitur sagittis sollicitudin odio, vitae cursus metus ultricies sed. Curabitur egestas sodales&nbsp;<\\/p><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Pellentesque tempor massa dolor, ac auctor quam lobortis accumsan. Suspendisse eu condimentum libero. Mauris et finibus orci. In hac habitasse platea dictumst. Donec in ultrices metus. Praesent ultrices volutpat magna at sagittis. Mauris egestas erat tortor, in gravida felis aliquet eget. Aliquam dictum, eros vitae lobortis dapibus, odio lacus tempus lectus, ut fermentum risus mauris a ex. Suspendisse ac quam dictum justo porttitor varius. Vestibulum ac nibh ante. Donec auctor pulvinar erat, sit amet ullamcorper enim facilisis vitae. Nunc vulputate sed lacus sit amet accumsan. Nunc ut maximus orci, et dapibus quam.<\\/p><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Suspendisse bibendum leo nibh. Sed eu dui massa. Cras egestas eget augue vitae auctor. Vivamus ullamcorper ullamcorper leo, tincidunt eleifend lectus fringilla sit amet. Aliquam non lectus luctus, ultrices sapien a, eleifend sem. Ut vitae vestibulum tellus, ac sollicitudin dolor. Morbi pellentesque quis orci cursus convallis. Aliquam lobortis eu lorem nec tincidunt. Proin nec pharetra odio. Phasellus sit amet nunc viverra, suscipit tellus in, consectetur enim. Fusce sodales imperdiet cursus. Ut ullamcorper nibh vitae justo rutrum convallis. Fusce scelerisque mi nisl, a aliquet dolor auctor sollicitudin.<\\/p>\",\"image_one\":\"645b8fe7c84ff1683722215.jpg\"}', 'default', 0, NULL, '2023-05-10 06:36:55', '2023-05-10 06:36:55'),
(213, 'iteratable', 'blog', '{\"blog_title\":\"Consectetur ea quod et possimus quae dolore iste\",\"short_description\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc diam sapien, bibendum eu suscipit ut, lacinia in turpis. Donec facilisis ipsum nec eros cursus commodo sit amet at eros. Aenean semper massa maximus dui cursus, vitae aliquam mauris gravida. Nam at sagittis metus, in cursus augue. Pellentesque mollis ullamcorper urna et rutrum. Vestibulum convallis eros posuere dictum interdum. Fusce convallis ante in dolor facilisis, vitae commodo justo pharetra.\\r\\n\\r\\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam aliquam lorem non risus accumsan vulputate. Praesent eget mi id arcu faucibus bibendum id ut odio. Curabitur viverra justo\",\"description\":\"<p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\"><span style=\\\"font-size: 0.875rem;\\\">id iaculis facilisis. Curabitur sed interdum nibh. Phasellus maximus purus sed consequat varius. Mauris fermentum scelerisque magna, eu euismod enim. Curabitur sagittis sollicitudin odio, vitae cursus metus ultricies sed. Curabitur egestas sodales malesuada. Ut venenatis magna at massa fermentum lobortis. Suspendisse sit amet mauris non metus semper volutpat sit amet bibendum tellus. Suspendisse id eleifend magna. Integer sodales diam et ex molestie semper. Suspendisse lacinia nibh eu posuere vestibulum. Praesent ac turpis nisl. Duis maximus ipsum luctus mauris blandit tempor.<\\/span><br><\\/p><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Phasellus ex velit, elementum porta massa in, laoreet ullamcorper ligula. Fusce mi lacus, gravida gravida massa quis, consequat molestie lorem. Nullam tempor, mi non pharetra rhoncus, neque lacus auctor leo, at hendrerit augue massa vitae sem. Nunc sit amet venenatis erat. Sed sapien massa, hendrerit eu bibendum in, rutrum accumsan lectus. Ut viverra dui dictum ornare venenatis. Pellentesque auctor ornare placerat. Praesent cursus odio odio, id euismod leo ornare eget. Proin a massa lectus.<\\/p><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Pellentesque tempor massa dolor, ac auctor quam lobortis accumsan. Suspendisse eu condimentum libero. Mauris et finibus orci. In hac habitasse platea dictumst. Donec in ultrices metus. Praesent ultrices volutpat magna at sagittis. Mauris egestas erat tortor, in gravida felis aliquet eget. Aliquam dictum, eros vitae lobortis dapibus, odio lacus tempus lectus, ut fermentum risus mauris a ex. Suspendisse ac quam dictum justo porttitor varius. Vestibulum ac nibh ante. Donec auctor pulvinar erat, sit amet ullamcorper enim facilisis vitae. Nunc vulputate sed lacus sit amet accumsan. Nunc ut maximus orci, et dapibus quam.<\\/p><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Suspendisse bibendum leo nibh. Sed eu dui massa. Cras egestas eget augue vitae auctor. Vivamus ullamcorper ullamcorper leo, tincidunt eleifend lectus fringilla sit amet. Aliquam non lectus luctus, ultrices sapien a, eleifend sem. Ut vitae vestibulum tellus, ac sollicitudin dolor. Morbi pellentesque quis orci cursus convallis. Aliquam lobortis eu lorem nec tincidunt. Proin nec pharetra odio. Phasellus sit amet nunc viverra, suscipit tellus in, consectetur enim. Fusce sodales imperdiet cursus. Ut ullamcorper nibh vitae justo rutrum convallis. Fusce scelerisque mi nisl, a aliquet dolor auctor sollicitudin.<\\/p>\",\"image_one\":\"645b900cb1a481683722252.jpg\"}', 'default', 0, NULL, '2023-05-10 06:37:32', '2023-05-10 06:37:32'),
(214, 'iteratable', 'blog', '{\"blog_title\":\"Recusandae modi dolores fugit suscipit officiis earum\",\"short_description\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc diam sapien, bibendum eu suscipit ut, lacinia in turpis. Donec facilisis ipsum nec eros cursus commodo sit amet at eros. Aenean semper massa maximus dui cursus, vitae aliquam mauris gravida. Nam at sagittis metus, in cursus augue. Pellentesque mollis ullamcorper urna et rutrum. Vestibulum convallis eros posuere dictum interdum. Fusce convallis ante in dolor facilisis, vitae commodo justo pharetra.\",\"description\":\"<p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc diam sapien, bibendum eu suscipit ut, lacinia in turpis. Donec facilisis ipsum nec eros cursus commodo sit amet at eros. Aenean semper massa maximus dui cursus, vitae aliquam mauris gravida. Nam at sagittis metus, in cursus augue. Pellentesque mollis ullamcorper urna et rutrum. Vestibulum convallis eros posuere dictum interdum. Fusce convallis ante in dolor facilisis, vitae commodo justo pharetra.<\\/p><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam aliquam lorem non risus accumsan vulputate. Praesent eget mi id arcu faucibus bibendum id ut odio. Curabitur viverra justo id iaculis facilisis. Curabitur sed interdum nibh. Phasellus maximus purus sed consequat varius. Mauris fermentum scelerisque magna, eu euismod enim. Curabitur sagittis sollicitudin odio, vitae cursus metus ultricies sed. Curabitur egestas sodales malesuada. Ut venenatis magna at massa fermentum lobortis. Suspendisse sit amet mauris non metus semper volutpat sit amet bibendum tellus. Suspendisse id eleifend magna. Integer sodales diam et ex molestie semper. Suspendisse lacinia nibh eu posuere vestibulum. Praesent ac turpis nisl. Duis maximus ipsum luctus mauris blandit tempor.<\\/p><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Phasellus ex velit, elementum porta massa in, laoreet ullamcorper ligula. Fusce mi lacus, gravida gravida massa quis, consequat molestie lorem. Nullam tempor, mi non pharetra rhoncus, neque lacus auctor leo, at hendrerit augue massa vitae sem. Nunc sit amet venenatis erat. Sed sapien massa, hendrerit eu bibendum in, rutrum accumsan lectus. Ut viverra dui dictum ornare venenatis. Pellentesque auctor ornare placerat. Praesent cursus odio odio, id euismod leo ornare eget. Proin a massa lectus.<\\/p><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Pellentesque tempor massa dolor, ac auctor quam lobortis accumsan. Suspendisse eu condimentum libero. Mauris et finibus orci. In hac habitasse platea dictumst. Donec in ultrices metus. Praesent ultrices volutpat magna at sagittis. Mauris egestas erat tortor, in gravida felis aliquet eget. Aliquam dictum, eros vitae lobortis dapibus, odio lacus tempus lectus, ut fermentum risus mauris a ex. Suspendisse ac quam dictum justo porttitor varius. Vestibulum ac nibh ante. Donec auctor pulvinar erat, sit amet ullamcorper enim facilisis vitae. Nunc vulputate sed lacus sit amet accumsan. Nunc ut maximus orci, et dapibus quam.<\\/p><p style=\\\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\\\">Suspendisse bibendum leo nibh. Sed eu dui massa. Cras egestas eget augue vitae auctor. Vivamus ullamcorper ullamcorper leo, tincidunt eleifend lectus fringilla sit amet. Aliquam non lectus luctus, ultrices sapien a, eleifend sem. Ut vitae vestibulum tellus, ac sollicitudin dolor. Morbi pellentesque quis orci cursus convallis. Aliquam lobortis eu lorem nec tincidunt. Proin nec pharetra odio. Phasellus sit amet nunc viverra, suscipit tellus in, consectetur enim. Fusce sodales imperdiet cursus. Ut ullamcorper nibh vitae justo rutrum convallis. Fusce scelerisque mi nisl, a aliquet dolor auctor sollicitudin.<\\/p>\",\"image_one\":\"645b902b7f9fd1683722283.jpg\"}', 'default', 0, NULL, '2023-05-10 06:38:03', '2023-05-10 06:38:03'),
(215, 'non_iteratable', 'trade', '{\"section_header\":\"Live Trading\",\"title\":\"Join the trademax community\",\"color_text_for_title\":\"trademax community\",\"button_text\":\"Start Trading\",\"button_link\":\"login\"}', 'default', 0, NULL, '2023-06-20 04:53:49', '2023-06-20 04:57:12'),
(216, 'non_iteratable', 'banner', '{\"title\":\"Discover The World of Forex Signal\",\"color_text_for_title\":\"Forex Signal\",\"button_text\":\"Get Started\",\"button_text_link\":\"#\",\"button_two_text\":\"Register Now\",\"button_two_text_link\":\"register\",\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias sit eius quia facere numquam est harum cupiditate, repellat odit repudiandae voluptatem qui in sequi dicta magni quisquam neque fugit suscipit.\",\"image_three\":\"64abdca21d89a1688984738.png\",\"image_one\":\"64abd46b2a05a1688982635.png\",\"image_two\":\"64abafeb996ca1688973291.jpg\"}', 'light', 0, NULL, '2023-07-09 01:06:26', '2023-07-10 04:25:38'),
(217, 'non_iteratable', 'why_choose_us', '{\"section_header\":\"Choose us\",\"title\":\"Why Choose TradeMax\",\"color_text_for_title\":\"TradeMax\"}', 'light', 0, NULL, '2023-07-09 01:07:03', '2023-07-09 01:07:03'),
(218, 'non_iteratable', 'footer', '{\"footer_short_details\":\"Lorem ipsum dolor sit amet consectetur, adipisicing elit. fugiat delectus maxime nisi explicabo doloribus minima similique, quia hic accusantium laudantium odit voluptatibus molestiae enim aut repellat.\",\"image_one\":\"64afc3ee3cd381689240558.png\"}', 'light', 0, NULL, '2023-07-09 23:44:16', '2023-07-13 03:29:18'),
(219, 'non_iteratable', 'about', '{\"title\":\"Join the trademax community\",\"color_text_for_title\":\"trademax community\",\"button_text\":\"Learn More\",\"button_link\":\"about\",\"repeater\":[{\"repeater\":\"Learn how to read and forecast the markets\"},{\"repeater\":\"Learn how to read and forecast the markets\"},{\"repeater\":\"Learn how to read and forecast the markets\"},{\"repeater\":\"Learn how to read and forecast the markets\"}],\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. tempora perferendis molestias nesciunt. accusamus excepturi sint dicta velit nulla quod, natus dolorum inventore alias voluptates voluptatem, iste nemo consequuntur esse.\",\"image_one\":\"64abed38b05fa1688988984.png\",\"image_two\":\"64abe35a53fa01688986458.png\"}', 'light', 0, NULL, '2023-07-10 04:54:18', '2023-07-10 05:36:24'),
(220, 'non_iteratable', 'how_works', '{\"section_header\":\"How it works\",\"title\":\"Started Trading With TradeMax\",\"color_text_for_title\":\"With TradeMax\",\"image_two\":\"64acfb1d11e101689058077.jpg\",\"image_one\":null}', 'light', 0, NULL, '2023-07-10 05:41:19', '2023-07-11 00:47:57'),
(228, 'iteratable', 'how_works', '{\"title\":\"Open an account\",\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. repudiandae laboriosam adipisci neque cumque, corrupti.\",\"image_one\":\"64acf4f6e2fa71689056502.png\"}', 'light', 0, NULL, '2023-07-11 00:21:42', '2023-07-11 00:21:42'),
(229, 'iteratable', 'how_works', '{\"title\":\"Deposit amount\",\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. repudiandae laboriosam adipisci neque cumque, corrupti.\",\"image_one\":\"64acf503a4e111689056515.png\"}', 'light', 0, NULL, '2023-07-11 00:21:55', '2023-07-11 00:21:55'),
(230, 'iteratable', 'how_works', '{\"title\":\"Start trading\",\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. repudiandae laboriosam adipisci neque cumque, corrupti.\",\"image_one\":\"64acf50d79cb11689056525.png\"}', 'light', 0, NULL, '2023-07-11 00:22:05', '2023-07-11 00:22:05'),
(231, 'non_iteratable', 'plans', '{\"section_header\":\"Our best packages\",\"title\":\"Our Best Packages\",\"color_text_for_title\":\"Packages\",\"image_one\":\"64acfd4e457f21689058638.jpg\"}', 'light', 0, NULL, '2023-07-11 00:57:18', '2023-07-11 00:57:18'),
(232, 'non_iteratable', 'trade', '{\"section_header\":\"Live trading\",\"title\":\"Join the trademax community\",\"color_text_for_title\":\"trademax community\",\"button_text\":\"Start Trading\",\"button_link\":\"#\",\"image_one\":\"64ad23f80a7da1689068536.png\"}', 'light', 0, NULL, '2023-07-11 02:56:13', '2023-07-11 03:42:16'),
(233, 'iteratable', 'why_choose_us', '{\"title\":\"Meta trader\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. minus adipisci eos, molestias, itaque aspernatur quis saepe recusandae fugit.\",\"image_one\":\"64ae64c1a52761689150657.png\"}', 'light', 0, NULL, '2023-07-12 01:17:45', '2023-07-12 02:30:57'),
(234, 'iteratable', 'why_choose_us', '{\"title\":\"Competetive pricing\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. minus adipisci eos, molestias, itaque aspernatur quis saepe recusandae fugit.\",\"image_one\":\"64ae64c8b4e9c1689150664.png\"}', 'light', 0, NULL, '2023-07-12 01:18:53', '2023-07-12 02:31:04'),
(235, 'iteratable', 'why_choose_us', '{\"title\":\"Active trader\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. minus adipisci eos, molestias, itaque aspernatur quis saepe recusandae fugit.\",\"image_one\":\"64ae64cfdfb8f1689150671.png\"}', 'light', 0, NULL, '2023-07-12 01:19:10', '2023-07-12 02:31:11'),
(236, 'iteratable', 'why_choose_us', '{\"title\":\"Meta trader\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. minus adipisci eos, molestias, itaque aspernatur quis saepe recusandae fugit.\",\"image_one\":\"64ae64d7006ff1689150679.png\"}', 'light', 0, NULL, '2023-07-12 02:23:43', '2023-07-12 02:31:19'),
(237, 'iteratable', 'why_choose_us', '{\"title\":\"Competetive pricing\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. minus adipisci eos, molestias, itaque aspernatur quis saepe recusandae fugit.\",\"image_one\":\"64ae64dd785041689150685.png\"}', 'light', 0, NULL, '2023-07-12 02:24:02', '2023-07-12 02:31:25'),
(238, 'iteratable', 'why_choose_us', '{\"title\":\"Active trader\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. minus adipisci eos, molestias, itaque aspernatur quis saepe recusandae fugit.\",\"image_one\":\"64ae64e37ab7f1689150691.png\"}', 'light', 0, NULL, '2023-07-12 02:24:21', '2023-07-12 02:31:31'),
(239, 'non_iteratable', 'overview', '{\"title\":\"Join our Trading platform today.\",\"color_text_for_title\":\"platform today.\",\"description\":\"Deleniti amet dolorem rerum magni porro ab assumenda eos, officiis accusamus cumque eaque placeat debitis, quia, consequatur voluptate facere iste alias. Magnam temporibus, veniam perspiciatis suscipit eaque odit facere fuga hic tempore quidem nam optio sunt quia enim dolor, itaque quam dicta. A, quam. Odio, incidunt illo sunt quia enim dolor\",\"image_one\":\"64ae74ff11fa31689154815.png\"}', 'light', 0, NULL, '2023-07-12 02:42:48', '2023-07-12 03:40:15'),
(240, 'iteratable', 'overview', '{\"title\":\"Total signal\",\"counter\":\"25 M\"}', 'light', 0, NULL, '2023-07-12 02:50:22', '2023-07-12 02:50:22'),
(241, 'iteratable', 'overview', '{\"title\":\"Total users\",\"counter\":\"235 M\"}', 'light', 0, NULL, '2023-07-12 02:50:48', '2023-07-12 02:50:48'),
(242, 'iteratable', 'overview', '{\"title\":\"Success rate\",\"counter\":\"45 M\"}', 'light', 0, NULL, '2023-07-12 02:51:18', '2023-07-12 03:02:35'),
(243, 'iteratable', 'overview', '{\"title\":\"Total award\",\"counter\":\"12\"}', 'light', 0, NULL, '2023-07-12 02:51:31', '2023-07-12 02:51:31'),
(244, 'non_iteratable', 'benefits', '{\"section_header\":\"Summary of benefits\",\"title\":\"Everything you need to fast track your trading\",\"color_text_for_title\":\"track your trading\",\"image_one\":\"64ae7fdde00711689157597.png\"}', 'light', 0, NULL, '2023-07-12 04:26:38', '2023-07-12 04:26:38'),
(245, 'non_iteratable', 'blog', '{\"section_header\":\"Blog post\",\"title\":\"Our Latest News\",\"color_text_for_title\":\"News\"}', 'light', 0, NULL, '2023-07-12 04:32:55', '2023-07-12 04:32:55'),
(246, 'non_iteratable', 'referral', '{\"title\":\"Our Forex Trading Referral\",\"color_text_for_title\":\"Trading Referral\",\"description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. error iste quae soluta adipisci eum. consequuntur tenetur doloremque commodi unde. praesentium fugiat molestias ipsum distinctio at reprehenderit porro.\",\"image_one\":\"64af8ef86fb1a1689227000.png\"}', 'light', 0, NULL, '2023-07-12 04:33:21', '2023-07-12 23:48:43'),
(247, 'non_iteratable', 'team', '{\"section_header\":\"Our team\",\"title\":\"Our Forex Trading Specialist\",\"color_text_for_title\":\"Forex Trading\"}', 'light', 0, NULL, '2023-07-12 04:33:48', '2023-07-12 04:33:48'),
(248, 'non_iteratable', 'testimonial', '{\"section_header\":\"Testimonials\",\"title\":\"What Our Customer Says\",\"color_text_for_title\":\"Our Customer\",\"image_two\":\"64af9af18c6391689230065.jpg\",\"image_one\":null}', 'light', 0, NULL, '2023-07-12 04:34:21', '2023-07-13 00:34:25'),
(249, 'iteratable', 'benefits', '{\"title\":\"Top technical analysis\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"64ae84308548c1689158704.png\"}', 'light', 0, NULL, '2023-07-12 04:45:04', '2023-07-12 04:45:04'),
(250, 'iteratable', 'benefits', '{\"title\":\"High performance\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"64ae8440c18d81689158720.png\"}', 'light', 0, NULL, '2023-07-12 04:45:20', '2023-07-12 04:45:20'),
(251, 'iteratable', 'benefits', '{\"title\":\"Full expert support\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"64ae84503450c1689158736.png\"}', 'light', 0, NULL, '2023-07-12 04:45:36', '2023-07-12 04:45:36'),
(252, 'iteratable', 'benefits', '{\"title\":\"Direct email and sms* signals\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"64ae845c76f401689158748.png\"}', 'light', 0, NULL, '2023-07-12 04:45:48', '2023-07-12 04:45:48'),
(253, 'iteratable', 'benefits', '{\"title\":\"Highly recommended\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"64ae8468df0051689158760.png\"}', 'light', 0, NULL, '2023-07-12 04:46:00', '2023-07-12 04:46:00'),
(254, 'iteratable', 'benefits', '{\"title\":\"Join a growing community\",\"description\":\"Architecto doloremque neque asperiores laboriosam voluptatum doloribus aperiam.\",\"image_one\":\"64ae8476570781689158774.png\"}', 'light', 0, NULL, '2023-07-12 04:46:14', '2023-07-12 04:46:14'),
(255, 'iteratable', 'blog', '{\"blog_title\":\"Temporibus, dignissimos aperiam accusamus dolore\",\"short_description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sit, animi praesentium esse exercitationem cumque minus quaerat omnis accusamus soluta nam in dolores hic quod laboriosam nostrum rerum fugit porro repellat eius vitae quae at iure. Qui at corrupti expedita obcaecati tempore optio repellat, eligendi, fugit nulla eum beatae velit temporibus, aut asperiores veniam deleniti molestiae excepturi debitis. Rem, corporis laboriosam ad omnis eveniet esse numquam atque, tenetur aliquam laudantium nemo. Explicabo minus eligendi, vero distinctio id ipsam perferendis cupiditate sapiente enim perspiciatis vitae, nam nesciunt labore officia facilis aliquam fuga pariatur reprehenderit earum totam laboriosam. Officia molestias commodi quibusdam.\",\"description\":\"<div style=\\\"font-family: Consolas, &quot;Courier New&quot;, monospace; line-height: 19px; white-space: pre;\\\"><font color=\\\"#636363\\\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sit, animi praesentium esse exercitationem cumque minus quaerat omnis accusamus soluta nam in dolores hic quod laboriosam nostrum rerum fugit porro repellat eius vitae quae at iure. Qui at corrupti expedita obcaecati tempore optio repellat, eligendi, fugit nulla eum beatae velit temporibus, aut asperiores veniam deleniti molestiae excepturi debitis. Rem, corporis laboriosam ad omnis eveniet esse numquam atque, tenetur aliquam laudantium nemo. Explicabo minus eligendi, vero distinctio id ipsam perferendis cupiditate sapiente enim perspiciatis vitae, nam nesciunt labore officia facilis aliquam fuga pariatur reprehenderit earum totam laboriosam. Officia molestias commodi quibusdam.<\\/font><\\/div>\",\"image_one\":\"64ae8ae0746d41689160416.jpg\"}', 'light', 0, NULL, '2023-07-12 05:13:36', '2023-07-12 05:13:36'),
(256, 'iteratable', 'blog', '{\"blog_title\":\"Consectetur ea quod et possimus quae dolore iste\",\"short_description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sit, animi praesentium esse exercitationem cumque minus quaerat omnis accusamus soluta nam in dolores hic quod laboriosam nostrum rerum fugit porro repellat eius vitae quae at iure. Qui at corrupti expedita obcaecati tempore optio repellat, eligendi, fugit nulla eum beatae velit temporibus, aut asperiores veniam deleniti molestiae excepturi debitis. Rem, corporis laboriosam ad omnis eveniet esse numquam atque, tenetur aliquam laudantium nemo. Explicabo minus eligendi, vero distinctio id ipsam perferendis cupiditate sapiente enim perspiciatis vitae, nam nesciunt labore officia facilis aliquam fuga pariatur reprehenderit earum totam laboriosam. Officia molestias commodi quibusdam.\",\"description\":\"<div style=\\\"font-family: Consolas, &quot;Courier New&quot;, monospace; line-height: 19px; white-space: pre;\\\"><font color=\\\"#636363\\\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sit, animi praesentium esse exercitationem cumque minus quaerat omnis accusamus soluta nam in dolores hic quod laboriosam nostrum rerum fugit porro repellat eius vitae quae at iure. Qui at corrupti expedita obcaecati tempore optio repellat, eligendi, fugit nulla eum beatae velit temporibus, aut asperiores veniam deleniti molestiae excepturi debitis. Rem, corporis laboriosam ad omnis eveniet esse numquam atque, tenetur aliquam laudantium nemo. Explicabo minus eligendi, vero distinctio id ipsam perferendis cupiditate sapiente enim perspiciatis vitae, nam nesciunt labore officia facilis aliquam fuga pariatur reprehenderit earum totam laboriosam. Officia molestias commodi quibusdam.<\\/font><\\/div>\",\"image_one\":\"64ae8b0a98bda1689160458.jpg\"}', 'light', 0, NULL, '2023-07-12 05:14:18', '2023-07-12 05:14:18'),
(257, 'iteratable', 'blog', '{\"blog_title\":\"Recusandae modi dolores fugit suscipit officiis earum\",\"short_description\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sit, animi praesentium esse exercitationem cumque minus quaerat omnis accusamus soluta nam in dolores hic quod laboriosam nostrum rerum fugit porro repellat eius vitae quae at iure. Qui at corrupti expedita obcaecati tempore optio repellat, eligendi, fugit nulla eum beatae velit temporibus, aut asperiores veniam deleniti molestiae excepturi debitis. Rem, corporis laboriosam ad omnis eveniet esse numquam atque, tenetur aliquam laudantium nemo. Explicabo minus eligendi, vero distinctio id ipsam perferendis cupiditate sapiente enim perspiciatis vitae, nam nesciunt labore officia facilis aliquam fuga pariatur reprehenderit earum totam laboriosam. Officia molestias commodi quibusdam.\",\"description\":\"<div style=\\\"font-family: Consolas, &quot;Courier New&quot;, monospace; line-height: 19px; white-space: pre;\\\"><font color=\\\"#636363\\\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sit, animi praesentium esse exercitationem cumque minus quaerat omnis accusamus soluta nam in dolores hic quod laboriosam nostrum rerum fugit porro repellat eius vitae quae at iure. Qui at corrupti expedita obcaecati tempore optio repellat, eligendi, fugit nulla eum beatae velit temporibus, aut asperiores veniam deleniti molestiae excepturi debitis. Rem, corporis laboriosam ad omnis eveniet esse numquam atque, tenetur aliquam laudantium nemo. Explicabo minus eligendi, vero distinctio id ipsam perferendis cupiditate sapiente enim perspiciatis vitae, nam nesciunt labore officia facilis aliquam fuga pariatur reprehenderit earum totam laboriosam. Officia molestias commodi quibusdam.<\\/font><\\/div>\",\"image_one\":\"64ae8b1e9a7d91689160478.jpg\"}', 'light', 0, NULL, '2023-07-12 05:14:38', '2023-07-12 05:14:38'),
(258, 'iteratable', 'team', '{\"member_name\":\"John Doe\",\"designation\":\"CEO, Toto Company\",\"facebook_url\":\"#\",\"twitter_url\":\"#\",\"linkedin_url\":\"#\",\"instagram_url\":\"#\",\"image_one\":\"64ae932422e791689162532.jpg\"}', 'light', 0, NULL, '2023-07-12 05:48:52', '2023-07-12 05:48:52'),
(259, 'iteratable', 'team', '{\"member_name\":\"Edward Milar\",\"designation\":\"CEO, Toto Company\",\"facebook_url\":\"#\",\"twitter_url\":\"#\",\"linkedin_url\":\"#\",\"instagram_url\":\"#\",\"image_one\":\"64ae933f01f661689162559.jpg\"}', 'light', 0, NULL, '2023-07-12 05:49:19', '2023-07-12 05:49:19'),
(260, 'iteratable', 'team', '{\"member_name\":\"Tarbo John\",\"designation\":\"CEO, Toto Company\",\"facebook_url\":\"#\",\"twitter_url\":\"#\",\"linkedin_url\":\"#\",\"instagram_url\":\"#\",\"image_one\":\"64ae9353762f91689162579.jpg\"}', 'light', 0, NULL, '2023-07-12 05:49:39', '2023-07-12 05:49:39'),
(261, 'iteratable', 'team', '{\"member_name\":\"Urabana Edawad\",\"designation\":\"CEO, Toto Company\",\"facebook_url\":\"#\",\"twitter_url\":\"#\",\"linkedin_url\":\"#\",\"instagram_url\":\"#\",\"image_one\":\"64ae936eaf5611689162606.jpg\"}', 'light', 0, NULL, '2023-07-12 05:50:06', '2023-07-12 05:50:06'),
(262, 'iteratable', 'team', '{\"member_name\":\"Teawk Jana\",\"designation\":\"CEO, Toto Company\",\"facebook_url\":\"#\",\"twitter_url\":\"#\",\"linkedin_url\":\"#\",\"instagram_url\":\"#\",\"image_one\":\"64ae938193ed51689162625.jpg\"}', 'light', 0, NULL, '2023-07-12 05:50:25', '2023-07-12 05:50:25'),
(263, 'iteratable', 'testimonial', '{\"client_name\":\"John Doe\",\"designation\":\"Toto Company\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, cum! Sit ad officiis eius et inventore optio eligendi. Totam suscipit in obcaecati repellat quisquam deleniti facilis excepturi ad minima consectetur consectetur adipisicing.\",\"image_one\":\"64afa18cb77c11689231756.jpg\"}', 'light', 0, NULL, '2023-07-13 00:37:31', '2023-07-13 01:02:36'),
(264, 'iteratable', 'testimonial', '{\"client_name\":\"Pera Mal\",\"designation\":\"Toto Company\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, cum! Sit ad officiis eius et inventore optio eligendi. Totam suscipit in obcaecati repellat quisquam deleniti facilis excepturi ad minima consectetur consectetur adipisicing.\",\"image_one\":\"64afa1a088bae1689231776.jpg\"}', 'light', 0, NULL, '2023-07-13 00:38:04', '2023-07-13 01:02:56'),
(265, 'iteratable', 'testimonial', '{\"client_name\":\"Tara Kal\",\"designation\":\"Toto Company\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, cum! Sit ad officiis eius et inventore optio eligendi. Totam suscipit in obcaecati repellat quisquam deleniti facilis excepturi ad minima consectetur consectetur adipisicing.\",\"image_one\":\"64afa240924b01689231936.jpg\"}', 'light', 0, NULL, '2023-07-13 00:38:22', '2023-07-13 01:05:36'),
(266, 'iteratable', 'testimonial', '{\"client_name\":\"Ualal Jal\",\"designation\":\"Toto Company\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, cum! Sit ad officiis eius et inventore optio eligendi. Totam suscipit in obcaecati repellat quisquam deleniti facilis excepturi ad minima consectetur consectetur adipisicing.\",\"image_one\":\"64afa247d6e351689231943.jpg\"}', 'light', 0, NULL, '2023-07-13 00:38:41', '2023-07-13 01:05:43'),
(267, 'iteratable', 'testimonial', '{\"client_name\":\"Yala Mal\",\"designation\":\"Toto Company\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, cum! Sit ad officiis eius et inventore optio eligendi. Totam suscipit in obcaecati repellat quisquam deleniti facilis excepturi ad minima consectetur consectetur adipisicing.\",\"image_one\":\"64afa24eb51111689231950.jpg\"}', 'light', 0, NULL, '2023-07-13 00:38:57', '2023-07-13 01:05:50'),
(268, 'iteratable', 'testimonial', '{\"client_name\":\"Pawal Hala\",\"designation\":\"Toto Company\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, cum! Sit ad officiis eius et inventore optio eligendi. Totam suscipit in obcaecati repellat quisquam deleniti facilis excepturi ad minima consectetur consectetur adipisicing.\",\"image_one\":\"64afa255340ee1689231957.jpg\"}', 'light', 0, NULL, '2023-07-13 00:39:19', '2023-07-13 01:05:57'),
(269, 'iteratable', 'brand', '{\"image_one\":\"64afbd8e8a0ae1689238926.png\"}', 'light', 0, NULL, '2023-07-13 03:02:06', '2023-07-13 03:02:06'),
(270, 'iteratable', 'brand', '{\"image_one\":\"64afbd95334cc1689238933.png\"}', 'light', 0, NULL, '2023-07-13 03:02:13', '2023-07-13 03:02:13'),
(271, 'iteratable', 'brand', '{\"image_one\":\"64afbd9dd16901689238941.png\"}', 'light', 0, NULL, '2023-07-13 03:02:21', '2023-07-13 03:02:21'),
(272, 'iteratable', 'brand', '{\"image_one\":\"64afbda3c9a7c1689238947.png\"}', 'light', 0, NULL, '2023-07-13 03:02:27', '2023-07-13 03:02:27'),
(273, 'iteratable', 'brand', '{\"image_one\":\"64afbda8b7a6f1689238952.png\"}', 'light', 0, NULL, '2023-07-13 03:02:32', '2023-07-13 03:02:32');
INSERT INTO `sp_contents` (`id`, `type`, `name`, `content`, `theme`, `language_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(274, 'iteratable', 'brand', '{\"image_one\":\"64afbdae2e3a11689238958.png\"}', 'light', 0, NULL, '2023-07-13 03:02:38', '2023-07-13 03:02:38'),
(275, 'iteratable', 'socials', '{\"icon\":\"fab fa-facebook-f\",\"link\":\"#\"}', 'light', 0, NULL, '2023-07-13 03:51:33', '2023-07-13 03:51:33'),
(276, 'iteratable', 'socials', '{\"icon\":\"fab fa-twitter\",\"link\":\"#\"}', 'light', 0, NULL, '2023-07-13 03:51:43', '2023-07-13 03:51:43'),
(277, 'iteratable', 'socials', '{\"icon\":\"fab fa-linkedin-in\",\"link\":\"#\"}', 'light', 0, NULL, '2023-07-13 03:51:56', '2023-07-13 03:51:56'),
(278, 'iteratable', 'socials', '{\"icon\":\"fab fa-pinterest-p\",\"link\":\"#\"}', 'light', 0, NULL, '2023-07-13 03:52:09', '2023-07-13 03:52:09'),
(279, 'non_iteratable', 'contact', '{\"section_header\":\"Contact\",\"title\":\"We\'d Love to Hear From You\",\"color_text_for_title\":\"Hear From You\",\"email\":\"support@company.com\",\"phone\":\"+01857319149\",\"address\":\"HQ 10\\/3A Zamzam Tower, Alwal Street Newyork\",\"form_header\":\"Love to hear from you, Get in touch\",\"color_text_for_form_header\":\"Get in touch\"}', 'light', 0, NULL, '2023-07-13 05:16:58', '2023-07-13 05:16:58'),
(280, 'non_iteratable', 'auth', '{\"title\":\"Title Here\",\"image_one\":\"64afde43ea2dc1689247299.png\"}', 'light', 0, NULL, '2023-07-13 05:21:40', '2023-07-13 05:21:40');

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
-- Table structure for table `sp_frontend_media`
--

CREATE TABLE `sp_frontend_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content_id` bigint(20) UNSIGNED NOT NULL,
  `media` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, 'stripe', '64b2444f3a2f41689404495.jpg', '{\"stripe_client_id\":\"pk_test_51JPpg8Ep0youpBChKWG5eyrUnj7weSPl3FlIaU8unUrqOfoA0aAFGJq6biVmcZBjKdD7Jf7HXmH6DKaxjtJsWn9200QGc9BTns\",\"stripe_client_secret\":\"sk_test_51JPpg8Ep0youpBChPXaj1T1fXk5zhCTg8A8hCCF5sfrFm7C0n7pIYfGoMptc1xqoFb5Mnro56LB3jn21JsTvnGtP00ZTxKIaJ8\",\"gateway_currency\":\"USD\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-07-15 01:01:35'),
(2, 'paypal', '64b2446fb28f11689404527.jpg', '{\"gateway_currency\":\"USD\",\"mode\":\"sandbox\",\"paypal_client_id\":\"AQtCVGlS22wqYBGWPHW1a6aAVuUcFwSOWzUGoRvsbth2vUNNxrekowLwrYRwIYLMAetedRPu3hKMO57C\",\"paypal_client_secret\":\"EMksMmpKq5xfnJP3So7fVTyjghVV4mtUa70qsXbNAiw3nBF3ir6ENXZasxT-3cPDZ8ZXJX0DaggQFptv\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-07-15 01:02:07'),
(3, 'vougepay', '64b24481157231689404545.jpg', '{\"gateway_currency\":\"NGN\",\"vouguepay_merchant_id\":\"sandbox_760e43f202878f651659820234cad9\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-07-15 01:02:25'),
(4, 'razorpay', '64b24493c01af1689404563.jpg', '{\"gateway_currency\":\"INR\",\"razor_key\":\"rzp_test_r8XIwoQUldfBxE\",\"razor_secret\":\"G21wL8EwAeO2RIEg33qC1WjM\"}', 1, 1, '70.00000000', '0.00000000', NULL, '2023-07-15 01:02:43'),
(5, 'coinpayments', '64b244a2ee0441689404578.jpg', '{\"public_key\":\"38c42afde7a4259c137e59f355e49347418c191acbc8fd7d28bf2cf6ba6fc8ef\",\"private_key\":\"2f01fbce867E045eF996f7edde430cDb36D5c9D8bC7B8A6B952f69E9209a95eb\",\"merchant_id\":\"f734643e069b93f729f13159274dcc4c\",\"gateway_currency\":\"USD\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-07-15 01:02:58'),
(6, 'mollie', '64b244b286d5e1689404594.jpg', '{\"mollie_key\":\"test_kABABRpec7dDq2hurGdUEGR6hvsghJ\",\"gateway_currency\":\"USD\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-07-15 01:03:14'),
(7, 'nowpayments', '64b244c130d961689404609.jpg', '{\"nowpay_key\":\"GWNX9GQ-3MG4ZB3-Q4QCSD1-WMHR73F\",\"gateway_currency\":\"USD\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-07-15 01:03:29'),
(8, 'flutterwave', '64b244cd7a61b1689404621.jpg', '{\"public_key\":\"FLWPUBK_TEST-SANDBOXDEMOKEY-X\",\"reference_key\":\"titanic-48981487343MDI0NzMx\",\"gateway_currency\":\"USD\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-07-15 01:03:41'),
(9, 'paystack', '64b244d7a87151689404631.jpg', '{\"paystack_key\":\"pk_test_267cf8526cf89ade67da431da3b2b59b04e9c4e0\",\"gateway_currency\":\"ZAR\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-07-15 01:03:51'),
(10, 'paghiper', '64b244e3683081689404643.jpg', '{\"paghiper_key\":\"apk_46328544-sawGwZEtyqZMGMpdKtqmmaIJzjLfZKMR\",\"token\":\"8G5O29JZNSDG851P6NTFVK3C7HS2T981PEQRNARB24RB\",\"gateway_currency\":\"BRL\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-07-15 01:04:03'),
(11, 'gourl_BTC', '64b244f847b451689404664.jpg', '{\"gateway_currency\":\"BTC\",\"public_key\":\"25654AAo79c3Bitcoin77BTCPUBqwIefT1j9fqqMwUtMI0huVL\",\"private_key\":\"25654AAo79c3Bitcoin77BTCPRV0JG7w3jg0Tc5Pfi34U8o5JE\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-07-15 01:04:24'),
(12, 'perfectmoney', '64b24538918c51689404728.jpg', '{\"accountid\":\"asdasd\",\"passphrase\":\"asdasd\",\"gateway_currency\":\"USD\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-07-15 01:05:28'),
(13, 'mercadopago', '64b2454b45ded1689404747.jpg', '{\"access_token\":\"TEST-705032440135962-041006-ad2e021853f22338fe1a4db9f64d1491-421886156\",\"public_key\":\"TEST-fa4d869f-468f-4dfd-2620-8b520f888a32\",\"gateway_currency\":\"USD\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-07-15 01:05:47'),
(14, 'paytm', '64b2455700d171689404759.jpg', '{\"gateway_currency\":\"INR\",\"mode\":\"0\",\"merchant_id\":\"DIY12386817555501617\",\"merchant_key\":\"bKMfNxPPf_QdZppa\",\"merchant_website\":\"asasdas\",\"merchant_channel\":\"web\",\"merchant_industry\":\"asdasdasd\"}', 1, 1, '1.00000000', '0.00000000', NULL, '2023-07-15 01:05:59'),
(15, 'city-bank', '64b2459c4a6381689404828.jpg', '{\"name\":\"City Bank\",\"account_number\":\"sdasd\",\"routing_number\":\"sdfsdf\",\"branch_name\":\"sdfsdf\",\"gateway_currency\":\"USD\",\"gateway_type\":\"bank\",\"qr_code\":\"\",\"payment_instruction\":\"<p>test<\\/p>\\r\\n\\r\\n<p>asdasdasd<\\/p>\",\"user_proof_param\":[{\"field_name\":\"asdasd\",\"type\":\"file\",\"validation\":\"required\"}]}', 0, 1, '5.00000000', '5.00000000', '2023-03-08 23:38:57', '2023-07-15 01:07:08'),
(16, 'bitcoin', '6425684e97dc31680173134.png', '{\"name\":\"bitcoin\",\"account_number\":null,\"routing_number\":null,\"branch_name\":null,\"gateway_currency\":\"usd\",\"gateway_type\":\"crypto\",\"qr_code\":\"6425684e9e6071680173134.png\",\"payment_instruction\":\"<p>bitcoin<\\/p>\",\"user_proof_param\":[{\"field_name\":\"trx\",\"type\":\"text\",\"validation\":\"required\"},{\"field_name\":\"image\",\"type\":\"file\",\"validation\":\"required\"},{\"field_name\":\"te\",\"type\":\"file\",\"validation\":\"nullable\"}]}', 0, 1, '1.00000000', '10.00000000', '2023-03-30 04:45:34', '2023-03-31 23:53:45');

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
(39, '2023_03_22_060754_create_jobs_table', 20),
(40, '2023_04_02_045912_create_frontend_media_table', 21);

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
(2, 'App\\Models\\Admin', 2),
(2, 'App\\Models\\Admin', 3);

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
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, 'Home', 'home', 1, 0, '[\"signal\",\"btc\",\"froex\",\"Binance\",\"Crypto\",\"Buy\",\"Sell\"]', 'Simple stock & cryptocurrency price forecasting console application, using PHP Machine', 1, '2023-03-07 05:36:18', '2023-04-04 05:20:40'),
(4, 'about', 'about', 2, 0, '[\"abouts\"]', 'abouts', 1, '2023-03-20 05:13:22', '2023-03-30 01:47:18'),
(5, 'Contact', 'contact', 4, 0, '[\"test\"]', 'adasdasdasdasd', 1, '2023-03-20 05:19:31', '2023-03-30 01:42:18'),
(6, 'Packages', 'packages', 3, 0, '[\"Abouts\"]', 'Abouts Us', 1, '2023-03-29 01:13:52', '2023-03-30 01:45:52'),
(8, 'Blog', 'blog', 10, 1, '[\"10\",\"blog\"]', 'blog', 1, '2023-03-30 00:34:33', '2023-03-30 01:39:42');

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
(76, 8, '\"blog\"', '2023-03-30 01:39:42', '2023-03-30 01:39:42'),
(77, 5, '\"contact\"', '2023-03-30 01:42:18', '2023-03-30 01:42:18'),
(79, 6, '\"plans\"', '2023-03-30 01:46:12', '2023-03-30 01:46:12'),
(85, 4, '\"about\"', '2023-03-30 01:50:32', '2023-03-30 01:50:32'),
(86, 4, '\"overview\"', '2023-03-30 01:50:32', '2023-03-30 01:50:32'),
(87, 4, '\"how_works\"', '2023-03-30 01:50:32', '2023-03-30 01:50:32'),
(88, 4, '\"team\"', '2023-03-30 01:50:32', '2023-03-30 01:50:32'),
(166, 3, '\"about\"', '2023-07-13 03:11:25', '2023-07-13 03:11:25'),
(167, 3, '\"trade\"', '2023-07-13 03:11:25', '2023-07-13 03:11:25'),
(168, 3, '\"how_works\"', '2023-07-13 03:11:25', '2023-07-13 03:11:25'),
(169, 3, '\"plans\"', '2023-07-13 03:11:25', '2023-07-13 03:11:25'),
(170, 3, '\"why_choose_us\"', '2023-07-13 03:11:25', '2023-07-13 03:11:25'),
(171, 3, '\"overview\"', '2023-07-13 03:11:25', '2023-07-13 03:11:25'),
(172, 3, '\"benefits\"', '2023-07-13 03:11:25', '2023-07-13 03:11:25'),
(173, 3, '\"testimonial\"', '2023-07-13 03:11:25', '2023-07-13 03:11:25'),
(174, 3, '\"referral\"', '2023-07-13 03:11:25', '2023-07-13 03:11:25'),
(175, 3, '\"team\"', '2023-07-13 03:11:25', '2023-07-13 03:11:25'),
(176, 3, '\"blog\"', '2023-07-13 03:11:25', '2023-07-13 03:11:25');

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
  `payment_proof` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rejection_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `price` decimal(28,8) DEFAULT 0.00000000,
  `duration` int(11) DEFAULT 0,
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
(1, 'Pro max', 'pro-max', '90.00000000', 30, 'limited', 'paid', '[\"Great features\",\"Binance trading\",\"Crypto\",\"Live api\"]', 1, 1, 0, 0, 1, 1, '2023-07-11 01:10:41', '2023-07-14 23:42:51'),
(2, 'Ultra', 'ultra', '500.00000000', NULL, 'unlimited', 'paid', '[\"Great features\",\"Binance trading\",\"Crypto\",\"Live api\"]', 1, 1, 1, 1, 1, 1, '2023-07-11 01:11:55', '2023-07-11 01:11:55'),
(3, 'Lifetime signal', 'lifetime-signal', '900.00000000', 90, 'limited', 'paid', '[\"Great features\",\"Binance trading\",\"Crypto\",\"Live api\"]', 1, 1, 1, 1, 0, 1, '2023-07-11 01:12:41', '2023-07-11 01:12:41'),
(4, 'Plan Four', 'plan-four', '1500.00000000', NULL, 'unlimited', 'paid', '[\"Great features\",\"Crypto\",\"Live api\",\"Great features\"]', 1, 1, 1, 0, 0, 1, '2023-07-12 04:54:03', '2023-07-12 04:54:03'),
(5, 'Plan Five', 'plan-five', '450.00000000', 45, 'limited', 'paid', '[\"Live api\",\"Great features\",\"Great features\",\"Crypto\"]', 1, 1, 1, 0, 0, 1, '2023-07-12 04:54:45', '2023-07-12 04:54:45'),
(6, 'Plan Six', 'plan-six', '650.00000000', 75, 'limited', 'paid', '[\"Great features\",\"Live api\",\"Crypto\",\"Great features\"]', 1, 1, 1, 1, 0, 1, '2023-07-12 04:55:23', '2023-07-12 04:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `sp_plan_signals`
--

CREATE TABLE `sp_plan_signals` (
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `signal_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'invest', '[\"level 1\",\"level 2\",\"level 3\",\"level 4\"]', '[\"5\",\"10\",\"15\",\"20\"]', 1, '2023-03-30 00:12:45', '2023-04-01 02:34:21'),
(2, 'interest', '[\"level 1\",\"level 2\",\"level 3\",\"level 4\"]', '[\"5\",\"10\",\"15\",\"20\"]', 1, '2023-03-30 00:18:29', '2023-04-01 02:44:55');

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
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(14, 1),
(15, 1),
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
(2, 'payment_successfull', 'Email For Payment Successfull', '<p>Hi %username%</p>\r\n\r\n<p><br></p>\r\n\r\n<p>Your plan name : %plan%</p>\r\n\r\n<p><span style=\"font-size:0.875rem;\">Your transaction id : </span>%trx%</p>\r\n\r\n<p>Amount: %amount%</p>\r\n\r\n<p>Currency: %currency%</p>\r\n\r\n<p><br></p>\r\n\r\n<p>Regards,</p>\r\n\r\n<p>%app_name%</p>', 1, NULL, '2023-04-01 01:13:24'),
(3, 'payment_received', 'Your Payment Has Been Received', '<p>Hi %username%</p><p><br></p><p><br></p><p>Regards</p><p>%app_name%</p>', 1, NULL, '2023-03-21 05:42:10'),
(4, 'verify_email', 'Verify Email', '<p>Hi %username%</p><p><br></p><p>Your Verification Code is %code%</p><p><br></p><p><br></p><p>Regrads,</p><p>%app_name%</p>', 1, NULL, '2023-03-30 05:01:13'),
(5, 'payment_confirmed', 'Payment Confirmation', '<p>Hi %username%</p><p>%trx%</p><p>%amount%</p><p><br></p><p>%charge%</p><p>%plan%</p><p>%currency%</p><p><br></p><p><br></p><p><br></p><p>Regards,</p><p>%app_name%</p>', 1, NULL, '2023-03-30 05:03:18'),
(6, 'payment_rejected', 'Payment Reject', '<p>Hi %username%</p><p>Transaction id: %trx%</p><p><span style=\"font-size: 0.875rem;\">amount:&nbsp;</span>%amount%</p><p>Charge: %charge%</p><p>Plan: %plan%</p><p>Currency: %currency%</p><p>Regards,</p><p>%app_name%</p>', 1, NULL, '2023-04-01 01:16:51'),
(7, 'withdraw_accepted', 'Wtihdraw Accepted', '<p>Hi %username%</p><p><br></p><p>Your payment amount: %amount%</p><p><span style=\"font-size: 0.875rem;\">Your method:&nbsp;</span><span style=\"font-size: 0.875rem;\">&nbsp;&nbsp;</span>%method%</p><p>currency : %currency%</p><p><br></p><p>Regards</p><p>%app_name%</p>', 1, NULL, '2023-04-01 01:15:21'),
(8, 'withdraw_rejected', 'Withdraw Rejected', '<p>HI %username%</p><p><br></p><p>Reason: %reason%</p><p>Method: %method%</p><p>Amount: %amount%</p><p>currecny: %currency%</p><p><br></p><p><br></p><p>Regards</p><p>%app_name%</p>', 1, NULL, '2023-04-01 01:35:22'),
(9, 'refer_commission', 'Referral Commission', '<p>Hi %username%</p><p><br></p><p>Refer user: %refer_user%</p><p>Amount: %amount%</p><p>Currency : %currency%</p><p><br></p><p>Regards,</p><p>%app_name%</p>', 1, NULL, '2023-04-01 01:17:34'),
(12, 'send_money', 'Send Money', '<p>Hi %username%</p><p><br></p><p>Receiver: %receiver%</p><p>Amount: %amount%</p><p>Transaction id : %trx%</p><p><br></p><p>Regards,</p><p>%app_name%</p>', 1, NULL, '2023-04-01 03:58:28'),
(13, 'receive_money', 'Money Received', '<p>Hi %username%</p><p><br></p><p>%sender%</p><p>%amount%</p><p>%trx%</p><p><br></p><p>Regards,</p><p>%app_name%</p>', 1, NULL, '2023-04-01 00:11:18'),
(14, 'plan_subscription', 'Plan Subscription', '<p>Hi %username%</p><p><br></p><p>%plan%</p><p>%amount%</p><p>%trx%</p><p><br></p><p>Regards,</p><p>%app_name%</p>', 1, NULL, '2023-04-04 03:20:09'),
(15, 'Signal', 'Signal Arrives', '<p>Hi %username%</p><p>%title%</p><p>%market%</p><p>%pair%-%<span style=\"font-size:0.875rem;\">frame%</span></p><p>Opening Poin : %open%</p><p>Stop Loss : %sl%</p><p>Take Profit : %tp%</p><p>Order Direction : %direction%</p>\r\n\r\n<p>%description%</p>\r\n\r\n<p>Regards,</p><p>%app_name%</p>', 1, NULL, '2023-04-04 03:43:25');

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

-- --------------------------------------------------------

--
-- Table structure for table `sp_trades`
--

CREATE TABLE `sp_trades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trade_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_price` decimal(28,8) NOT NULL,
  `duration` int(11) NOT NULL,
  `trade_stop_at` datetime NOT NULL,
  `trade_opens_at` datetime NOT NULL,
  `profit_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profit_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `loss_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `telegram_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Bank', '50.00000000', '5000.00000000', '10.00000000', 'fixed', '<p>ddweh wedihwedijwe dih whd wkdjh wedh iweh diw</p><p>&nbsp;wudjhwe dihw iudh iwud iwh duiwh duy wid we</p><p>&nbsp;wi hdijwhid hwid iwedwe</p>', 1, '2023-07-15 00:22:05', '2023-07-15 00:22:05');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `sp_frontend_media`
--
ALTER TABLE `sp_frontend_media`
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
-- Indexes for table `sp_trades`
--
ALTER TABLE `sp_trades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sp_trades_ref_unique` (`ref`);

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
-- AUTO_INCREMENT for table `sp_admins`
--
ALTER TABLE `sp_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_admin_password_resets`
--
ALTER TABLE `sp_admin_password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_configurations`
--
ALTER TABLE `sp_configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_contents`
--
ALTER TABLE `sp_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `sp_currency_pairs`
--
ALTER TABLE `sp_currency_pairs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_dashboard_signals`
--
ALTER TABLE `sp_dashboard_signals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_deposits`
--
ALTER TABLE `sp_deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_frontend_components`
--
ALTER TABLE `sp_frontend_components`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_frontend_media`
--
ALTER TABLE `sp_frontend_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_gateways`
--
ALTER TABLE `sp_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sp_jobs`
--
ALTER TABLE `sp_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_languages`
--
ALTER TABLE `sp_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sp_login_securities`
--
ALTER TABLE `sp_login_securities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_markets`
--
ALTER TABLE `sp_markets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_migrations`
--
ALTER TABLE `sp_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `sp_money_transfers`
--
ALTER TABLE `sp_money_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_pages`
--
ALTER TABLE `sp_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sp_page_sections`
--
ALTER TABLE `sp_page_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `sp_payments`
--
ALTER TABLE `sp_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sp_plan_subscriptions`
--
ALTER TABLE `sp_plan_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_subscribers`
--
ALTER TABLE `sp_subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_templates`
--
ALTER TABLE `sp_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sp_tickets`
--
ALTER TABLE `sp_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_ticket_replies`
--
ALTER TABLE `sp_ticket_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_time_frames`
--
ALTER TABLE `sp_time_frames`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_trades`
--
ALTER TABLE `sp_trades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_transactions`
--
ALTER TABLE `sp_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_users`
--
ALTER TABLE `sp_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_user_logs`
--
ALTER TABLE `sp_user_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_user_signals`
--
ALTER TABLE `sp_user_signals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_withdraws`
--
ALTER TABLE `sp_withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_withdraw_gateways`
--
ALTER TABLE `sp_withdraw_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
