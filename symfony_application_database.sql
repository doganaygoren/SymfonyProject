-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Haz 2020, 23:50:17
-- Sunucu sürümü: 10.4.11-MariaDB
-- PHP Sürümü: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `symfony_application`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `visio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `about`
--

INSERT INTO `about` (`id`, `visio`, `mission`, `content`, `created_at`, `updated_at`) VALUES
(1, 'To serve you the best, you must be the best', 'Just experience the best with our activities', '<p><span style=\"color:#3498db\">Our Activities Serve You The Best.</span></p>\r\n\r\n<p><u><span style=\"color:#3498db\"><a href=\"http://localhost:8000/activities\">Check Our Activities Before It is Too Late</a></span></u></p>', NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adrenaline_factor` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `detail` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `activity`
--

INSERT INTO `activity` (`id`, `category_id`, `title`, `keyword`, `description`, `image`, `adrenaline_factor`, `address`, `phone`, `fax`, `email`, `city`, `status`, `created_at`, `updated_at`, `detail`, `userid`) VALUES
(3, 21, 'Best Bungee Jumping Experience Ever!', 'bungee jumping, best,experience', 'You can find the best experience here.', '6249e2b1fad09878c38b5093c5c588c7.jpeg', 4, 'address', '0286 325 54 32', '0286 325 54 33', 'bungee@gmail.com', 'Muğla', 'Active', NULL, NULL, '<p>You can find the best experience <em><u>here.</u></em></p>', 24),
(8, 24, 'Hike With Us', 'hike,with,us,hiking,outdoor', 'Come and hike with us', 'fe816b1c51c7cc98f30fedb64e76feac.jpeg', 2, 'Muğla Forest', '0286 456 67 78', '0286 456 67 79', 'hikewithus@gmail.com', 'Muğla', 'Active', NULL, NULL, '<p><em><strong>Come and hike with us</strong></em></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11px\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&nbsp; consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></p>', 1),
(20, 16, 'Dive With Us', 'scuba,diving,diving,extreme', 'Scuba diving', '60adf9d6f063161175c46708f5d5c2c8.jpeg', 3, 'Ölüdeniz Diving Club', '02864567973', '02213242344', 'divewithus@gmail.com', 'Muğla', 'Active', NULL, NULL, '<p><strong>Dive with us and explore the <u>underwater</u> world</strong></p>', 1),
(21, 16, 'Climbing to Babadag', 'babadag,climbing,extreme', 'Let\'s enjoy climbing to the Babadag!', '1c1d72d66467c8420ec3a85827658555.jpeg', 5, 'Babadag, Fethiye', '02863467884', '02863467875', 'climbontobabadag@gmail.com', 'Muğla', 'Active', NULL, NULL, '<p>Have you ever climbed? If not come climb with us and experience <strong>the best</strong></p>', 5),
(22, 23, 'Fethiye Safari', 'safari,fethiye,outdoor', 'safari in muğla', '8063cd7b203998097fd3b6059062a126.jpeg', 1, 'Fethiye Kanyonu', '02863456778', '02863456779', 'fethiyesafari@gmail.com', 'Muğla', 'Active', NULL, NULL, '<p><u>Safari with us!!!</u></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 24),
(23, 17, 'Boxing', 'boxing,strength', 'Have you ever tried boxing?', 'd2e68fba38901f3af4b3b09690f6ff74.jpeg', 3, 'Antalya Box Club', '0290 345 67 72', '0290 345 67 73', 'info@boxclub.com', 'Antalya', 'Active', NULL, NULL, '<p>Come and try yourself. Explore your&nbsp;<strong>strength.</strong></p>', 20),
(24, 16, 'Come and Score With Us', 'football', 'Are you a good footballer?', '718a371c0ff1a60f0ddaab18fbb00b7b.jpeg', 3, 'Antalya Footbal Club', '0285 456 67 70', '0285 456 67 71', 'info@footbalclub.com', 'Antalya', 'Active', NULL, NULL, '<p>Are you a good footballer?</p>', 32),
(25, 21, 'Best Snowboarding Experience', 'snowboard,experience', 'Best snowboarding experience', '0b2a31e787d0977db7456275c6fbb3fe.jpeg', 4, 'Uludağ', '0286 456 67 78', '0286 456 67 79', 'snowboard@gmail.com', 'Bursa', 'Active', NULL, NULL, '<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>Best snowboarding experience</p>\r\n\r\n<p>&nbsp;</p>', 34),
(26, 16, 'Surfing Experience', 'surfing,aquatic', 'Surf With Us', 'abc7f271f96f6d2b85d93f2f8c1b98c4.jpeg', 3, 'Sydney', '7456789', '02863467875', 'surf@gmail.com', 'Australia', 'Active', NULL, NULL, '<p>All About Surfing</p>\r\n\r\n<p>All About Surfing</p>\r\n\r\n<p>All About Surfing</p>\r\n\r\n<p>All About Surfing</p>\r\n\r\n<p>All About Surfing</p>\r\n\r\n<p>All About Surfing</p>\r\n\r\n<p>&nbsp;</p>', 34),
(27, 19, 'Lets Score Together', 'basketball', 'Lets Score Together', '50f937a49aa5242a6a83443c6c819a9d.jpeg', 1, 'Muğla Basketball Club', '0286 456 67 78', '0286 325 54 33', 'basketballinmugla@gmail.com', 'Muğla', 'Active', NULL, NULL, '<p><strong>Lets Score Together</strong></p>\r\n\r\n<p><strong>Lets Score Together</strong></p>\r\n\r\n<p><strong>Lets Score Together</strong></p>\r\n\r\n<p><strong>Lets Score Together</strong></p>\r\n\r\n<p><strong>Lets Score Together</strong></p>', 20),
(28, 18, 'Lets Play Tennis', 'tennis', 'Lets Play Tennis', '708177d357aaf0d0a062f1bc2dbae102.jpeg', 2, 'Istanbul Tennis Club', '0286 456 67 78', '0286 456 67 79', 'istanbultennis@gmail.com', 'Istanbul', 'Active', NULL, NULL, '<p><em>Lets Play Tennis</em></p>\r\n\r\n<p><em>Lets Play Tennis</em></p>\r\n\r\n<p><em>Lets Play Tennis</em></p>\r\n\r\n<p><em>Lets Play Tennis</em></p>\r\n\r\n<p><em>Lets Play Tennis</em></p>', 20),
(29, 17, 'Run With Us', 'running', 'Run with Us', 'b4861a75a8c0a98f5827018822d984a8.jpeg', 1, 'Muğla Forest', '0286 456 67 78', '0286 456 67 79', 'runwithus@gmail.com', 'Muğla', 'Active', NULL, NULL, '<p><u>Run with Us</u></p>\r\n\r\n<p><u>Run with Us</u></p>\r\n\r\n<p><u>Run with Us</u></p>\r\n\r\n<p><u>Run with Us</u></p>\r\n\r\n<p><u>Run with Us</u></p>\r\n\r\n<p><u>Run with Us</u></p>\r\n\r\n<p>&nbsp;</p>', 1),
(30, 22, 'Cycle With Us', 'cycling', 'Cycle With Us', '057a17fb2ef281e3d54a383b60750cd6.jpeg', 2, 'Muğla Forest', '0545555555', '0286 325 54 33', 'cycle@gmail.com', 'Muğla', 'Active', NULL, NULL, '<p><strong>Cycle With Us</strong></p>\r\n\r\n<p><strong>Cycle With Us</strong></p>\r\n\r\n<p><strong>Cycle With Us</strong></p>\r\n\r\n<p><strong>Cycle With Us</strong></p>\r\n\r\n<p>&nbsp;</p>', 1),
(31, 23, 'Walk With Us', 'walking', 'Walk With Us', 'dbb89ae85f31d375b81a68bfbe53ed85.jpeg', 1, 'Antalya Beach', '0286 456 67 78', '0286 325 54 33', 'walk@gmail.com', 'Antalya', 'Active', NULL, NULL, '<p><em>Walk With Us</em></p>\r\n\r\n<p><em>Walk With Us</em></p>\r\n\r\n<p><em>Walk With Us</em></p>', 1),
(32, 22, 'Lets Dirtbike Together', 'dirtbike', 'Lets Dirtbike Together', '6dfd49cbadd40ffaeabe8a870e99b314.jpeg', 3, 'Muğla Forest', '0286 456 67 78', '0286 325 54 33', 'dirtbike@gmail.com', 'Muğla', 'Active', NULL, NULL, '<p><strong><em>Lets Dirtbike Together</em></strong></p>\r\n\r\n<p><strong><em>Lets Dirtbike Together</em></strong></p>\r\n\r\n<p><strong><em>Lets Dirtbike Together</em></strong></p>\r\n\r\n<p><strong><em>Lets Dirtbike Together</em></strong></p>\r\n\r\n<p><strong><em>Lets Dirtbike Together</em></strong></p>', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upper_category` int(11) DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`id`, `category_name`, `upper_category`, `keywords`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(16, 'Aquatic Sports', 0, 'aquatic', 'Best aquatic sports', 'd9fded7b70d18eab097562298a419444.jpeg', 'Active', NULL, NULL),
(17, 'Strength and Agility Sports', 0, 'strength,agility,sport', 'Best strength and agility sports', '1930555c00387c59f440421816ffd1fe.jpeg', 'Active', NULL, NULL),
(18, 'Ball Sports', 0, 'ball,sport', 'Come play with us', '3311903d93a7b5972f6a2d203c34d6c2.jpeg', 'Active', NULL, NULL),
(19, 'Basketball', 18, 'basketball', 'Can you score?', 'ad7a16a851618c915a6f7181c80b5e50.png', 'Active', NULL, NULL),
(20, 'Football', 18, 'football', 'Can you goal?', 'e17b05f31bc36689a5cdd27179ba64fa.jpeg', 'Active', NULL, NULL),
(21, 'Extreme', 0, 'extreme', 'Extreme sports', '77501c31b421638eb747f5299eb7d45a.jpeg', 'Active', NULL, NULL),
(22, 'Adventure', 0, 'adventure,sport', 'All the best adventure sports', 'd1cda5cc7e0f9cd69d059ff6cb65e36f.jpeg', 'Active', NULL, NULL),
(23, 'Outdoor', 0, 'outdoor,sport', 'Outdoor sports', 'e573a4e369aed139591429ad28c8a9fe.jpeg', 'Active', NULL, NULL),
(24, 'Hiking', 23, 'hiking,outdoor', 'Best hiking experience', 'e5889fcae3aa6a1668c15143a3d4f4a1.jpeg', 'Active', NULL, NULL),
(25, 'Paragliding', 21, 'paragliding, extreme,sport', 'Paragliding extreme sport', '009f1ff52ee9f12c5109ba32e8184737.jpeg', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `subject` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `activityid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `comment`
--

INSERT INTO `comment` (`id`, `subject`, `comment`, `status`, `ip`, `userid`, `created_at`, `updated_at`, `rate`, `activityid`) VALUES
(5, 'test', 'test', 'Active', '127.0.0.1', 1, NULL, NULL, 5, 21),
(6, 'test', 'rateee', 'New', '127.0.0.1', 1, NULL, NULL, 4, 8),
(7, 'Safari', 'I love safari!!', 'New', '127.0.0.1', 5, NULL, NULL, 4, 22),
(8, 'test', 'status test', 'Active', '127.0.0.1', 5, NULL, NULL, 3, 3),
(9, 'test', 'hello', 'Active', '127.0.0.1', 1, NULL, NULL, 3, 3),
(10, 'test', 'hello Doğanay', 'Active', '127.0.0.1', 5, NULL, NULL, 3, 3),
(11, 'Snowboard', 'Best place!!', 'Active', '127.0.0.1', 34, NULL, NULL, 4, 25),
(12, 'Hi', 'I hate dirtbiking', 'Active', '127.0.0.1', 1, NULL, NULL, 1, 32),
(13, 'aaaaaaa', 'xxxxxxxxxxxxxxxx', 'New', '127.0.0.1', 1, NULL, NULL, 3, 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `image`
--

INSERT INTO `image` (`id`, `activity_id`, `title`, `image`) VALUES
(1, NULL, 'test image', NULL),
(31, 22, 'Fethiye Safari Exit', '3444993e8ddac5ccb896b42190ad33c8.jpeg'),
(32, 20, 'Ölüdeniz Diving', 'a22bfa6653e41d0f5b24a02e8d5e0246.jpeg'),
(33, 24, 'Goal', 'd8a34f0ab87c7304b89a8a03c1fe22db.jpeg'),
(34, 3, 'Jumping', '6a3d6ade43065a86a3d8b789ebe204be.jpeg'),
(35, 20, 'Underwater Plane', '2c5d1882f5b36ad8af7dd0f1083a05ec.jpeg'),
(36, 25, 'snowboard', 'f6fd80af60e491896aba2c61b18c685a.jpeg'),
(37, 25, 'snowboard', 'aaa731893568e7f53afbd83b0b289033.jpeg'),
(38, 32, 'dirtbike', '66cc3135bfd1e2c786cebc4ccba86da3.jpeg'),
(39, 3, 'aaaaaaaaaaa', '3fb1db525fc07630d17eb8d3ff426e77.jpeg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `subject`, `message`, `status`, `ip`, `note`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@gmail.com', 'test', 'test', 'Inactive', NULL, NULL, NULL, NULL),
(2, 'dilara', 'dilara@gmail.com', 'parachute', 'hello mr. doganay,\r\nI want to learn about parachute. can you give me some information for it.', 'Seen', NULL, 'Contact her', NULL, NULL),
(11, 'Şükrü Davulcu', 'davulcu@gmail.com', 'Info about boxing', 'I need info pls contact me', 'Seen', '127.0.0.1', 'Contact him', NULL, NULL),
(28, 'Doğanay', 'doganaygoren97@gmail.com', 'hey', 'ı just wanted to test', 'New', '127.0.0.1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20191206191805', '2019-12-06 19:18:48'),
('20191207131141', '2019-12-07 13:12:21'),
('20191209064801', '2019-12-09 06:48:28'),
('20191209192852', '2019-12-09 19:29:16'),
('20191209195017', '2019-12-09 19:50:27'),
('20191209195449', '2019-12-09 19:54:58'),
('20191210073545', '2019-12-10 07:36:21'),
('20191210080110', '2019-12-10 08:02:06'),
('20191210081300', '2019-12-10 08:13:19'),
('20191210103524', '2019-12-10 10:35:46'),
('20191211131427', '2019-12-11 13:22:05'),
('20191216225703', '2019-12-16 22:57:36'),
('20191221162954', '2019-12-21 16:30:19'),
('20191221170920', '2019-12-21 17:09:31'),
('20191221175451', '2019-12-21 17:55:05'),
('20191225175425', '2019-12-25 17:55:36'),
('20191225182352', '2019-12-25 18:24:10'),
('20191227002857', '2019-12-27 00:29:26'),
('20191227184140', '2019-12-27 18:42:11'),
('20191227184513', '2019-12-27 18:45:29'),
('20200101175559', '2020-01-01 17:56:33'),
('20200107000640', '2020-01-07 00:07:07'),
('20200107001053', '2020-01-07 00:11:06'),
('20200108170856', '2020-01-08 17:09:23'),
('20200109012246', '2020-01-09 01:29:04');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recapctha` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_user` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_host` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_port` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `title`, `description`, `keyword`, `phone`, `mobile`, `fax`, `mail`, `address`, `google`, `recapctha`, `map`, `facebook`, `twitter`, `instagram`, `youtube`, `smtp_user`, `smtp_password`, `smtp_host`, `smtp_port`, `created_at`, `updated_at`) VALUES
(1, 'Activity Best', 'Come and Experience the BEST With Us', 'activity best,fethiye', '0286 346 34 52', '0545 678 89 98', '0286 346 34 53', 'info@activitybest.com', 'Activity Best Activity Club Fethiye/Muğla', 'google', 'recapctha', 'maps', 'http://facebook.com', 'http://twitter.com', 'http://instagram.com', 'http://youtube.com', 'activitybest@gmail.com', 'mheqfvoywlteujio', 'activitybest@gmail.com', '587', NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `surname`, `image`, `created_at`, `updated_at`, `status`) VALUES
(1, 'doganaygoren97@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=65536,t=4,p=1$OGxTOEl2YlUzVnN0R3FFRw$JsJScxaOcnV5VksWINsUo0WmqgibKRQvC5JfVdZ6kWo', 'Doğanay', 'Gören', '01a058cce83ca17a699a214e269d553b.png', NULL, NULL, NULL),
(5, 'dilaratezcan97@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=65536,t=4,p=1$WEtTQThoQzBpL2FPRWJ1Mw$QUtzPPfrG08S4Feq7cwY4oWhWZfp7MK4VC5KyjDrl8Y', 'Dilara', 'Tezcan', '4d5b1845b89e17f2def3d99679fa5c75.jpeg', NULL, NULL, 'Active'),
(20, 'dorukgoren10@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=65536,t=4,p=1$UTB3VGU4SWhYQ0pGbG9DZA$ifLEp8S8Gtlpo4eSpphLpn57+m/8El8JA7Er75gBgBk', 'Doruk', 'Gören', '546a622584a8cf8b886edd00e8db5992.png', NULL, NULL, 'Active'),
(24, 'ahmetyilmaz@gmail.com', '[]', '$argon2i$v=19$m=65536,t=4,p=1$Z3ZrMW5kcmlNVXUzdS9CNw$ammVvZnvPw7UJ5/o35jpNDjk2TZC/AZLrTg6iG8nF7w', 'Ahmet', 'Yılmaz', '2264532a896899d6fd1070e56793d596.png', NULL, NULL, NULL),
(32, 'sukru@gmail.com', '[]', '$argon2i$v=19$m=65536,t=4,p=1$VVZyaDlBMjZxV3Y0ZTlnSQ$X+mxr/DQFFoF4cfOxrEkFERMJoO4XLshow0ggZqAwj0', 'Şükrü', 'Karakaya', '92c73787a98a531b4a3ab058c45ad889.png', NULL, NULL, 'Active'),
(33, 'ecaliskan@gmail.com', '[]', '$argon2i$v=19$m=65536,t=4,p=1$Q0RTUS80QzkwcEFCVmxrbA$kjqc17vmdRno3D8fEkrIXTvX7mYwbk2nDAZJXUxpJQc', 'Emre', 'Çalışkan', NULL, NULL, NULL, NULL),
(34, 'rifat@gmail.com', '[]', '$argon2i$v=19$m=65536,t=4,p=1$dXRhWGtpakxsTW83aTJsVA$NJdi/cvN8tYs+vsoIvHXCmfzN9q7uaoiedkvLWONC3I', 'Rıfat', 'Sağlam', '9c49c172dd250aae59d848734a0a8fe4.jpeg', NULL, NULL, NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AC74095A12469DE2` (`category_id`);

--
-- Tablo için indeksler `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C53D045F81C06096` (`activity_id`);

--
-- Tablo için indeksler `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Tablo için AUTO_INCREMENT değeri `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Tablo için AUTO_INCREMENT değeri `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `FK_AC74095A12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Tablo kısıtlamaları `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045F81C06096` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
