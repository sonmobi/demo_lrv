-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:33067
-- Generation Time: Jun 10, 2020 at 03:48 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_lrv`
--
CREATE DATABASE IF NOT EXISTS `demo_lrv` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `demo_lrv`;

-- --------------------------------------------------------

--
-- Table structure for table `pms`
--

CREATE TABLE `pms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pms`
--

INSERT INTO `pms` (`id`, `name`, `title`) VALUES
(1, 'User.Index', 'Danh sách tài khoản'),
(2, 'User.Add', 'Thêm tài khoản mới'),
(3, 'User.Edit', 'Sửa thông tin tài khoản'),
(4, 'User.Delete', 'Xóa tài khoản');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `role_pms`
--

CREATE TABLE `role_pms` (
  `id_role` int(11) NOT NULL,
  `id_pms` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_pms`
--

INSERT INTO `role_pms` (`id_role`, `id_pms`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwd` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `passwd`, `email`, `fullname`, `id_role`) VALUES
(1, 'admin', '$2y$10$fupTAzY/zXE3uLm/XeO82e1w65l6W8QO58M0ZNcQYCLGOqHuO9rZm', 'admin@saophaixoan.net', 'Mr.Admin11', 1),
(2, 'abc123', '$2y$10$ailS3uidFs337FEIMYlIkezwryHPzLBfVTEVQRiOZ804RIxIyC2M.', 'abc@saophaixoan.net', 'Mr ABC', 2),
(6, 'admin2222', '$2y$10$ooKM8V.4fDdwnI7xVpyO3eNJCdJGIJLV3M6FUYkkBnCJRTwBDnJK6', 'sonmobi@gmail.com2222', 'Dang Thai Son', 2),
(9, 'abccc', '$2y$10$0a.OO2v/4q6PJTzrD4xe9eZKYF9PmOmsLxcu45KFe8GeS45pB2Iai', 'zzzzz@vn.vn', '22', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pms`
--
ALTER TABLE `pms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_pms`
--
ALTER TABLE `role_pms`
  ADD PRIMARY KEY (`id_role`,`id_pms`),
  ADD KEY `fk_role_pms_2` (`id_pms`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_role_user` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pms`
--
ALTER TABLE `pms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_pms`
--
ALTER TABLE `role_pms`
  ADD CONSTRAINT `fk_role_pms_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `fk_role_pms_2` FOREIGN KEY (`id_pms`) REFERENCES `pms` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_role_user` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
