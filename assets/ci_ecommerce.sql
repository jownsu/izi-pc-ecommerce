-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 13, 2022 at 06:33 PM
-- Server version: 8.0.29
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_carts_users_idx` (`user_id`),
  KEY `fk_carts_products1_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'keyboard', '2022-08-12 10:39:54', '2022-08-12 10:39:54'),
(2, 'monitor', '2022-08-12 10:39:54', '2022-08-12 10:39:54'),
(3, 'motherboard', '2022-08-12 10:39:54', '2022-08-12 10:39:54'),
(4, 'mouse', '2022-08-12 10:39:54', '2022-08-12 10:39:54'),
(5, 'pc case', '2022-08-12 10:39:54', '2022-08-12 10:39:54'),
(6, 'powerbank', '2022-08-12 10:39:54', '2022-08-12 10:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `content` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users1_idx` (`user_id`),
  KEY `fk_comments_products1_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `main` tinyint DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`product_id`),
  KEY `fk_images_products1_idx` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `product_id`, `image`, `main`, `created_at`, `updated_at`) VALUES
(1, 1, 'k-1.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(2, 1, 'k-2.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(3, 1, 'k-3.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(4, 1, 'k-4.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(5, 1, 'k-5.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(6, 2, 'k-6.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(7, 2, 'k-7.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(8, 2, 'k-8.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(9, 2, 'k-9.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(10, 2, 'k-10.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(11, 3, 'k-11.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(12, 3, 'k-12.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(13, 3, 'k-13.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(14, 3, 'k-14.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(15, 3, 'k-15.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(16, 4, 'k-16.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(17, 4, 'k-17.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(18, 4, 'k-18.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(19, 4, 'k-19.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(20, 4, 'k-20.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(21, 5, 'k-21.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(22, 5, 'k-22.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(23, 5, 'k-23.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(24, 5, 'k-24.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(25, 5, 'k-25.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(26, 6, 'k-26.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(27, 6, 'k-27.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(28, 6, 'k-28.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(29, 6, 'k-29.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(30, 6, 'k-30.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(31, 7, 'k-31.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(32, 7, 'k-32.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(33, 7, 'k-33.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(34, 7, 'k-34.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(35, 7, 'k-35.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(36, 8, 'k-36.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(37, 8, 'k-37.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(38, 8, 'k-38.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(39, 8, 'k-39.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(40, 8, 'k-40.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(41, 9, 'k-41.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(42, 9, 'k-42.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(43, 9, 'k-43.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(44, 9, 'k-44.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(45, 9, 'k-45.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(46, 10, 'm-1.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(47, 10, 'm-2.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(48, 10, 'm-3.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(49, 10, 'm-4.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(50, 10, 'm-5.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(51, 11, 'm-6.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(52, 11, 'm-7.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(53, 11, 'm-8.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(54, 11, 'm-9.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(55, 11, 'm-10.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(56, 12, 'm-11.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(57, 12, 'm-12.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(58, 12, 'm-13.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(59, 12, 'm-14.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(60, 12, 'm-15.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(61, 13, 'm-16.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(62, 13, 'm-17.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(63, 13, 'm-18.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(64, 13, 'm-19.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(65, 13, 'm-20.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(66, 14, 'm-21.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(67, 14, 'm-22.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(68, 14, 'm-23.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(69, 14, 'm-24.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(70, 15, 'mb-1.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(71, 15, 'mb-2.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(72, 15, 'mb-3.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(73, 15, 'mb-4.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(74, 15, 'mb-5.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(75, 16, 'mb-6.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(76, 16, 'mb-7.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(77, 16, 'mb-8.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(78, 16, 'mb-9.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(79, 16, 'mb-10.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(80, 17, 'mb-11.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(81, 17, 'mb-12.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(82, 17, 'mb-13.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(83, 17, 'mb-14.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(84, 17, 'mb-15.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(85, 18, 'mb-16.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(86, 18, 'mb-17.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(87, 18, 'mb-18.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(88, 18, 'mb-19.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(89, 18, 'mb-20.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(90, 19, 'mb-21.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(91, 19, 'mb-22.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(92, 19, 'mb-23.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(93, 19, 'mb-24.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(94, 19, 'mb-25.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(95, 20, 'ms-1.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(96, 20, 'ms-2.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(97, 20, 'ms-3.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(98, 20, 'ms-4.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(99, 20, 'ms-5.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(100, 21, 'ms-6.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(101, 21, 'ms-7.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(102, 21, 'ms-8.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(103, 21, 'ms-9.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(104, 21, 'ms-10.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(105, 22, 'ms-11.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(106, 22, 'ms-12.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(107, 22, 'ms-13.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(108, 22, 'ms-14.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(109, 22, 'ms-15.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(110, 23, 'ms-16.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(111, 23, 'ms-17.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(112, 23, 'ms-18.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(113, 23, 'ms-19.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(114, 23, 'ms-20.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(115, 24, 'ms-21.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(116, 24, 'ms-22.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(117, 24, 'ms-23.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(118, 24, 'ms-24.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(119, 24, 'ms-25.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(120, 25, 'c-1.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(121, 25, 'c-2.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(122, 25, 'c-3.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(123, 25, 'c-4.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(124, 25, 'c-5.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(125, 26, 'c-6.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(126, 26, 'c-7.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(127, 26, 'c-8.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(128, 26, 'c-9.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(129, 26, 'c-10.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(130, 27, 'c-11.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(131, 27, 'c-12.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(132, 27, 'c-13.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(133, 28, 'c-14.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(134, 28, 'c-15.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(135, 28, 'c-16.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(136, 28, 'c-17.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(137, 29, 'c-18.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(138, 29, 'c-19.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(139, 29, 'c-20.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(140, 29, 'c-21.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(141, 29, 'c-22.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(142, 30, 'pb-1.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(143, 30, 'pb-2.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(144, 30, 'pb-3.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(145, 30, 'pb-4.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(146, 30, 'pb-5.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(147, 31, 'pb-6.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(148, 31, 'pb-7.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(149, 31, 'pb-8.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(150, 31, 'pb-9.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(151, 31, 'pb-10.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(152, 32, 'pb-11.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(153, 32, 'pb-12.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(154, 32, 'pb-13.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(155, 32, 'pb-14.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(156, 32, 'pb-15.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(157, 33, 'pb-16.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(158, 33, 'pb-17.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(159, 33, 'pb-18.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(160, 33, 'pb-19.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(161, 33, 'pb-20.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(162, 34, 'pb-21.jpg', 1, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(163, 34, 'pb-22.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(164, 34, 'pb-23.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(165, 34, 'pb-24.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26'),
(166, 34, 'pb-25.jpg', 0, '2022-08-12 11:42:26', '2022-08-12 11:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` tinyint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_billing`
--

DROP TABLE IF EXISTS `order_billing`;
CREATE TABLE IF NOT EXISTS `order_billing` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address` text,
  `address 2` text,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `card` varchar(255) DEFAULT NULL,
  `card_security_code` varchar(255) DEFAULT NULL,
  `card_expiration` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_ata` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

DROP TABLE IF EXISTS `order_product`;
CREATE TABLE IF NOT EXISTS `order_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_item_orders1_idx` (`order_id`),
  KEY `fk_order_product_products1_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_shipping`
--

DROP TABLE IF EXISTS `order_shipping`;
CREATE TABLE IF NOT EXISTS `order_shipping` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_shipping_ibfk_1` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `inventory` int DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_categories1_idx` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `inventory`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'A4tech KRS-85', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '372', '2022-08-12 11:05:33', NULL),
(2, 1, 'Deepcool KG722 65%', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '3199', '2022-08-12 11:05:33', NULL),
(3, 1, 'Rakk Ilis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '1575', '2022-08-12 11:05:33', NULL),
(4, 1, 'Rakk Kimat XT.LE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '1495', '2022-08-12 11:05:33', NULL),
(5, 1, 'RAKK Sari', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '695', '2022-08-12 11:05:33', NULL),
(6, 1, 'Rakk Tandus 87 Keys', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '1049', '2022-08-12 11:05:33', NULL),
(7, 1, 'Razer Cynosa', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '1999', '2022-08-12 11:05:33', NULL),
(8, 1, 'STARWAVE SW-GK01', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '665', '2022-08-12 11:05:33', NULL),
(9, 1, 'STARWAVE SW-MK06', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '465', '2022-08-12 11:05:33', NULL),
(10, 2, 'Gamdias Atlas HD236G 23.6 Curved 165Hz', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '6749', '2022-08-12 11:05:33', NULL),
(11, 2, 'MSI OPTIX G241VC 24 Full HD 75Hz', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '8495', '2022-08-12 11:05:33', NULL),
(12, 2, 'Orion L-G1901 19 inch', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '2300', '2022-08-12 11:05:33', NULL),
(13, 2, 'Viewplus MM-25HI 24.5 IPS FLAT 165hz', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '5495', '2022-08-12 11:05:33', NULL),
(14, 2, 'ViewPlus MS-27CH 27 165Hz Freesync 165Hz', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '8999', '2022-08-12 11:05:33', NULL),
(15, 3, 'ASRock B450M STEEL LEGEND Socket AM4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '5255', '2022-08-12 11:05:33', NULL),
(16, 3, 'Asus EX A320M Gaming Motherboard Socket Am4 Ddr4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '3339', '2022-08-12 11:05:33', NULL),
(17, 3, 'Asus Prime A320M-K Motherboard Socket Am4 Pcie Ddr4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '3195', '2022-08-12 11:05:33', NULL),
(18, 3, 'Biostar A320MH Socket Am4 Ddr4 Motherboard', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '2450', '2022-08-12 11:05:33', NULL),
(19, 3, 'Gigabyte GA-A320M-S2H Motherboard Socket Am4 Pcie Ddr4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '3720', '2022-08-12 11:05:33', NULL),
(20, 4, 'Deepcool MG510', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '3199', '2022-08-12 11:05:33', NULL),
(21, 4, 'HP M100', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '295', '2022-08-12 11:05:33', NULL),
(22, 4, 'HP M280', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '465', '2022-08-12 11:05:33', NULL),
(23, 4, 'Rakk Alti Illuminated', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '460', '2022-08-12 11:05:33', NULL),
(24, 4, 'Rakk Dasig Illuminated', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '419', '2022-08-12 11:05:33', NULL),
(25, 5, 'InPlay Meteor 01 Mid Tower', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '900', '2022-08-12 11:05:33', NULL),
(26, 5, 'Keytech T850 Mid Tower', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '1041', '2022-08-12 11:05:33', NULL),
(27, 5, 'Keytech T1000 Mid Tower', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '1145', '2022-08-12 11:05:33', NULL),
(28, 5, 'MSI MAG Forge 100R Mid Tower', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '3115', '2022-08-12 11:05:33', NULL),
(29, 5, 'Rakk Haliya ATX', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '2290', '2022-08-12 11:05:33', NULL),
(30, 6, 'Romoss Coeus 20 20000 mAh', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '475', '2022-08-12 11:05:33', NULL),
(31, 6, 'Romoss PEA40 40000 mAh', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '1195', '2022-08-12 11:05:33', NULL),
(32, 6, 'Romoss Pulse 10 10000 mAh', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '390', '2022-08-12 11:05:33', NULL),
(33, 6, 'Romoss Sense 8p+ 30000', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '1050', '2022-08-12 11:05:33', NULL),
(34, 6, 'YOOBAO EN1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 100, '4250', '2022-08-12 11:05:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `review` tinyint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reviews_users1_idx` (`user_id`),
  KEY `fk_reviews_products1_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `contact_no` int DEFAULT NULL,
  `is_admin` tinyint DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_billing`
--

DROP TABLE IF EXISTS `user_billing`;
CREATE TABLE IF NOT EXISTS `user_billing` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address` text,
  `address 2` text,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `card` varchar(255) DEFAULT NULL,
  `card_security_code` varchar(255) DEFAULT NULL,
  `card_expiration` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_ata` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_billing_users1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_shipping`
--

DROP TABLE IF EXISTS `user_shipping`;
CREATE TABLE IF NOT EXISTS `user_shipping` (
  `id` int NOT NULL AUTO_INCREMENT,
  `users_id` int NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_shipping_users1_idx` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_carts_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_carts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `order_billing`
--
ALTER TABLE `order_billing`
  ADD CONSTRAINT `order_billing_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `fk_order_item_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `fk_order_product_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `order_shipping`
--
ALTER TABLE `order_shipping`
  ADD CONSTRAINT `order_shipping_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_reviews_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_billing`
--
ALTER TABLE `user_billing`
  ADD CONSTRAINT `fk_user_billing_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_shipping`
--
ALTER TABLE `user_shipping`
  ADD CONSTRAINT `fk_user_shipping_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;