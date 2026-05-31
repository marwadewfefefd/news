-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2026 at 02:03 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(2, 'أخبار سياسية'),
(4, 'أخبار رياضية'),
(5, 'أخبار إقتصادية'),
(6, 'علمية');

-- --------------------------------------------------------

--
-- Table structure for table `news-posts`
--

CREATE TABLE `news-posts` (
  `post-id` int(100) NOT NULL,
  `post-title` varchar(100) NOT NULL,
  `post-content` varchar(4000) NOT NULL,
  `post-image` varchar(1000) NOT NULL,
  `category-id` int(100) NOT NULL,
  `user-id` int(100) NOT NULL,
  `post-status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news-posts`
--

INSERT INTO `news-posts` (`post-id`, `post-title`, `post-content`, `post-image`, `category-id`, `user-id`, `post-status`) VALUES
(1, 'خبر1', 'هذا الخبر 1', '1779998443Screenshot_٢٠٢٠٠٦٢٤-٠٠٣٧٣٤.png', 2, 16, 'deleted'),
(2, 'خبر1', 'خبر1', '1780061981لقطة الشاشة 2025-01-27 012650.png', 6, 16, 'deleted'),
(3, 'مساق داتا بيز', 'هذا مساق سنة2 فصل1 يتحدث عن قواعد بيانات وكيفية تخزينها ومعالجتها.هذا مساق سنة2 فصل2 يتحدث عن قواعد بيانات وكيفية تخزينها ومعالجتها .هذا مساق سنة2 فصل2 يتحدث عن قواعد بيانات وكيفية تخزينها ومعالجتها  ', '17800716222.png', 5, 16, 'active'),
(4, 'خبر دراسة1', 'خبر يتعلق بالدراسة صورة حلويات', '17800729798.png', 6, 16, 'deleted'),
(5, 'خبر اقتصاد', 'خبر اقتصادخبر اقتصادخبر اقتصادخبر اقتصادخبر اقتصادخبر اقتصادخبر اقتصاد', '17800731499.png', 5, 16, 'deleted'),
(6, 'ويب2', 'مساق ويب 2 مساق سنة2 به ربط الباك مع قواعد البياناتز', '1780073567bread.png', 6, 16, 'deleted'),
(7, 'خبر دراسة1', 'r4t', '1780073988cakes.png', 2, 16, 'deleted'),
(8, 'امتحانات وجاهية', 'الامتحانات وجاهية هذا الفصل', '178007430074.jpeg', 6, 16, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(100) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Name`, `Email`, `Password`) VALUES
(14, 'marwa', 'marwa.khateeb@gmail', '$2y$10$yCPak89qPW8Dn5jqbGge9ugFkyv5PabplLkUdu7wlH6zdoaN.4z1K'),
(15, 'aysha', 'aysha.khateeb@gmail.com', '$2y$10$EYrKWdu02TEev3Av2gnLMuC.fScqhN9uBHG43HpuH8zO9b4.4GA.a'),
(16, 'admin', 'admin@gmail.com', '$2y$10$SAvN.3hkmmRLmygU5naY3e96rrEvTtGwUuxhXLd2/VLR7Rr5JFyMK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news-posts`
--
ALTER TABLE `news-posts`
  ADD PRIMARY KEY (`post-id`),
  ADD KEY `category-id` (`category-id`),
  ADD KEY `user-id` (`user-id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news-posts`
--
ALTER TABLE `news-posts`
  MODIFY `post-id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news-posts`
--
ALTER TABLE `news-posts`
  ADD CONSTRAINT `news-posts_ibfk_1` FOREIGN KEY (`category-id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `news-posts_ibfk_2` FOREIGN KEY (`user-id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
