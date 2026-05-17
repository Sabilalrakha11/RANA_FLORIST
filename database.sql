-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2026 at 06:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rana_florist`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `sub_judul` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buket`
--

CREATE TABLE `buket` (
  `id` int(11) NOT NULL,
  `nama_buket` varchar(100) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buket`
--

INSERT INTO `buket` (`id`, `nama_buket`, `harga`, `kategori`, `foto`, `gambar`) VALUES
(1, 'Mawar Merah Elegan', '150.000', 'mawar', 'Logo.jpg.jpg', NULL),
(2, 'Buket Mawarr', '10000', 'wisuda', 'buketbunga.webp', NULL),
(3, 'Buket Mawar Ireng', '1.000.000', 'mawar', 'c67d45b29d31bc1160b7a4384fcf6387.jpg', NULL),
(5, 'Wisuda Mawar', '75.000', 'mawar', 'download.jpeg', NULL),
(6, 'Baket Wisuda Mix', '150.000', 'mawar', 'download (1).jpeg', NULL),
(7, 'Ruby', '500.000', 'wisuda', 'WhatsApp Image 2025-12-30 at 13.44.45.jpeg', NULL),
(8, 'Permata Citrine', '250.000', 'wisuda', 'WhatsApp Image 2025-12-30 at 13.44.44 (2).jpeg', NULL),
(9, 'Opal', '100.000', 'wisuda', 'WhatsApp Image 2025-12-30 at 13.44.45 (2).jpeg', NULL),
(10, 'Opal', '100.000', 'wisuda', '1767563647_WhatsApp Image 2025-12-30 at 13.44.45 (2).jpeg', NULL),
(13, 'Tes123', '99.999', 'single-flower', '1767564457_WhatsApp Image 2025-12-30 at 13.44.48.jpeg', NULL),
(14, 'Contoh1', '200.000', 'snack', '1767723952_c67d45b29d31bc1160b7a4384fcf6387.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `buket_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `buket_id`, `qty`, `created_at`) VALUES
(1, 2, 13, 2, '2026-01-04 22:32:17'),
(2, 2, 6, 1, '2026-01-04 22:33:16'),
(3, 2, 8, 1, '2026-01-04 22:40:43'),
(4, 0, 7, 1, '2026-01-05 03:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `favorit`
--

CREATE TABLE `favorit` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `buket_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(6, 'bunga balon'),
(1, 'Mawar'),
(4, 'Single Flower'),
(3, 'Snack'),
(2, 'Wisuda');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin123', 'admin'),
(2, 'rana', 'user123', 'user'),
(3, 'sabilalraka11', 'Mas.bolem1', 'user'),
(4, 'user', 'user123', 'user'),
(5, 'Ireng', '12345abc', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buket`
--
ALTER TABLE `buket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buket`
--
ALTER TABLE `buket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
