-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2026 at 06:59 PM
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
-- Database: `db_ranaflorist`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `gambar`, `created_at`) VALUES
(1, 'banner_1769741953_Gemini_Generated_Image_p7f0k0p7f0k0p7f0.jpeg', '2026-01-30 02:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `qty`) VALUES
(2, 1, 5, 1),
(3, 1, 4, 1),
(4, 1, 3, 1),
(5, 1, 2, 1),
(8, 3, 4, 2),
(10, 3, 5, 3),
(11, 3, 6, 2),
(12, 1, 6, 1),
(13, 1, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nama_kategori`) VALUES
(1, 'Buket Uang'),
(2, 'Single Flower'),
(3, 'Buket Wisuda'),
(4, 'bunga balon');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `pertanyaan`, `jawaban`) VALUES
(2, 'Apakah menerima pesanan dengan Jumlah banyak?', 'Sangat bisa'),
(3, 'Bisa dikirim luar kota?', 'Bisa melalui kurir ekspedisi');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `dimensi` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `nama_produk`, `deskripsi`, `harga`, `dimensi`, `stok`) VALUES
(2, 1, 'Buket Beri', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 100.00, '50x70', 10),
(3, 2, 'Buket Jaer', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 10.00, '50x70', 7),
(4, 1, 'Buket Bubu Tercinta', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 150.00, '50x70', 10),
(5, 2, 'Bunga Buket Hijau', 'aaaaaaaaaaaaaa', 150000.00, '50x70', 20),
(6, 1, 'Buket Melati', '', 15000.00, '50x70', 10),
(7, 1, 'Bunga Bunga', 'ayank', 10000.00, '50x70', 10),
(8, 4, 'Bukete Balon', '', 15000.00, '50x70', 3),
(9, 2, 'Buket Bunga Kawat Bulu Single Daisy \"Love You\" - Amethyst Purple', 'Berikan kejutan manis yang tidak akan pernah layu untuk orang tersayang! Bunga Single Daisy ini dirakit secara handmade 100% menggunakan material kawat bulu (chenille stems) premium yang sangat lembut dan awet.\r\n\r\nTampilannya sangat estetik dengan gaya ala Korean minimalist bouquet. Dibalut dengan kertas pembungkus premium berhiaskan tipografi \"LOVE\" dan \"LOVE YOU\" yang elegan, serta disempurnakan dengan ikatan pita satin berwarna lavender yang cantik. Sangat cocok dijadikan hadiah pelengkap untuk momen romantis, anniversary, wisuda, atau sekadar hadiah kecil penambah mood si dia.\r\n\r\nKeunggulan Produk:\r\n- Everlasting: Bunga tidak akan pernah layu atau berubah warna.\r\n- Handmade & Detail: Dibuat dengan rapi dan teliti.\r\n- Estetik & Premium: Kemasan siap jadi kado tanpa perlu repot membungkus lagi.', 15000.00, '12x35 cm', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `is_primary` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `nama_file`, `is_primary`) VALUES
(2, 2, '1769369821_c67d45b29d31bc1160b7a4384fcf6387.jpg', 1),
(3, 3, '1769369867_download.jpeg', 1),
(4, 4, '1769372143_c16c901ea20146a0916c04364c46ca92~.jpeg', 1),
(5, 4, '1769372143_c67d45b29d31bc1160b7a4384fcf6387.jpg', 0),
(6, 4, '1769372143_download (1).jpeg', 0),
(7, 4, '1769372143_download.jpeg', 0),
(8, 5, '1769373219_c16c901ea20146a0916c04364c46ca92~.jpeg', 1),
(9, 6, '1769704099_download.jpeg', 1),
(10, 7, '1769704273_download (1).jpeg', 1),
(11, 8, '1769823157_buketbunga.webp', 1),
(12, 9, '1777553577_1777553033132 (2).jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `isi_testimoni` text DEFAULT NULL,
  `foto_pelanggan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `nama_pelanggan`, `isi_testimoni`, `foto_pelanggan`) VALUES
(1, 'ABCD', 'produk bagus', '1769407433_buketbunga.webp'),
(2, 'User 2', 'Produk sangat bagus', '1769408143_download.jpeg'),
(3, 'User 3', 'Produk sangat bagus', '1769408201_c67d45b29d31bc1160b7a4384fcf6387.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`, `reset_token`, `reset_expiry`) VALUES
(1, 'admin rana', 'admin@gmail.com', '$2y$10$0jPuY3jnIXiRoO853XP7IuKWH9Eio4kLywFVT0lj7WvJp0ewdapP2', 'admin', '2026-01-25 19:31:42', NULL, NULL),
(2, 'Nadya Juliyanti', 'nadyajly57@g', '$2y$10$VrYvhKMD7J.iZK5c7parsOQ9mN3iXHnAgkshCqksrzuCFvPi2rbKi', 'user', '2026-01-25 20:09:19', NULL, NULL),
(3, 'user', 'user@gmail.com', '$2y$10$7WH.kjeclEOdPh9oXQUkPuG1voDd6H0e7tIr8UI3CeQBMYDAC0.xS', 'user', '2026-01-25 20:13:23', NULL, NULL),
(4, 'sabbilal rakha', 'sabilalrakha11@gmail.com', '$2y$10$7RwA6NbZbLtCYXRjqzYrE.HniFY4CIXm/xAVBrdd3Gdh0alEIrZ1O', 'user', '2026-01-26 09:46:58', NULL, NULL),
(5, 'Nadya', 'nadyajly71@gmail.com', '$2y$10$Ye182WcSAuZKydAnRca5.OyVlaj.Lc8BW4xZi91R.ey88xZqEIxLG', 'user', '2026-01-26 09:57:29', 'a9bc53f38d2291bdaac6d232300c4b293990d55d6038ad46e2047474cccdaab1', '2026-05-02 15:16:17'),
(6, 'wendi ganteng', 'airlazar0@gmail.com', '$2y$10$s7K.XSrVAuyiK6Yp3m6mB.36lAjXA0kBLdkCwCVB8xNlPi63QLyDa', 'user', '2026-02-02 02:08:21', '6a30cd860025c2cc185e0d06cc13862a0b52a96e906cd852d30d95d155e4554d', '2026-02-02 10:08:42'),
(7, 'tes', 'tes@gmail.com', '$2y$10$.Cark6332mOV3iNUfUgQXu1hikZbb2YGnUB3KFUxsl45wt4o6YE.G', 'user', '2026-05-02 08:13:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`) VALUES
(1, 1, 5),
(2, 1, 4),
(3, 3, 4),
(5, 1, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
