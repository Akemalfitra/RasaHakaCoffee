-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2024 at 02:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rmsimangat`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('user@gmail.comm|127.0.0.1', 'i:1;', 1732104927),
('user@gmail.comm|127.0.0.1:timer', 'i:1732104927;', 1732104927),
('userr@gmail.comm|127.0.0.1', 'i:1;', 1732104921),
('userr@gmail.comm|127.0.0.1:timer', 'i:1732104921;', 1732104921);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_08_121729_create_products_table', 1),
(5, '2024_11_08_122126_create_orders_table', 1),
(6, '2024_11_11_152309_create_order_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'pending',
  `total_harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_status`, `total_harga`, `created_at`, `updated_at`) VALUES
(7, 1, 'Pesanan selesai', 105000, '2024-11-16 10:38:09', '2024-11-16 21:51:02'),
(8, 5, 'Pesanan diproses', 261000, '2024-11-16 11:35:06', '2024-11-20 23:51:41'),
(9, 3, 'Dibatalkan penjual', 105000, '2024-11-16 11:44:46', '2024-11-21 03:25:42'),
(10, 1, 'Pesanan diproses', 48000, '2024-11-17 03:00:41', '2024-11-18 08:53:58'),
(11, 1, 'Dibatalkan pembeli', 74000, '2024-11-17 03:15:58', '2024-11-18 09:26:55'),
(12, 1, 'Dibatalkan pembeli', 25000, '2024-11-18 09:08:27', '2024-11-18 09:26:59'),
(13, 1, 'Dibatalkan pembeli', 37000, '2024-11-18 09:27:19', '2024-11-18 09:27:23'),
(16, 1, 'Pesanan selesai', 50000, '2024-11-20 06:26:38', '2024-11-21 03:37:54'),
(18, 1, 'Pesanan selesai', 13000, '2024-11-20 22:38:52', '2024-11-21 02:56:47'),
(22, 1, 'Pesanan diproses', 12000, '2024-11-21 03:41:28', '2024-11-21 03:41:43'),
(23, 1, 'pending', 50000, '2024-11-21 09:55:26', '2024-11-21 09:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `harga`, `created_at`, `updated_at`) VALUES
(12, 7, 1, 1, 25000.00, '2024-11-16 10:38:09', '2024-11-16 10:38:09'),
(13, 7, 29, 1, 12000.00, '2024-11-16 10:38:09', '2024-11-16 10:38:09'),
(14, 7, 30, 1, 13000.00, '2024-11-16 10:38:09', '2024-11-16 10:38:09'),
(15, 7, 33, 1, 18000.00, '2024-11-16 10:38:09', '2024-11-16 10:38:09'),
(16, 7, 32, 1, 20000.00, '2024-11-16 10:38:09', '2024-11-16 10:38:09'),
(17, 7, 31, 1, 17000.00, '2024-11-16 10:38:09', '2024-11-16 10:38:09'),
(18, 8, 1, 1, 25000.00, '2024-11-16 11:35:06', '2024-11-16 11:35:06'),
(19, 8, 29, 4, 12000.00, '2024-11-16 11:35:06', '2024-11-16 11:35:06'),
(20, 8, 30, 6, 13000.00, '2024-11-16 11:35:06', '2024-11-16 11:35:06'),
(21, 8, 33, 2, 18000.00, '2024-11-16 11:35:06', '2024-11-16 11:35:06'),
(22, 8, 32, 2, 20000.00, '2024-11-16 11:35:06', '2024-11-16 11:35:06'),
(23, 8, 31, 2, 17000.00, '2024-11-16 11:35:06', '2024-11-16 11:35:06'),
(24, 9, 30, 1, 13000.00, '2024-11-16 11:44:46', '2024-11-16 11:44:46'),
(25, 9, 29, 1, 12000.00, '2024-11-16 11:44:46', '2024-11-16 11:44:46'),
(26, 9, 1, 1, 25000.00, '2024-11-16 11:44:46', '2024-11-16 11:44:46'),
(27, 9, 33, 1, 18000.00, '2024-11-16 11:44:46', '2024-11-16 11:44:46'),
(28, 9, 32, 1, 20000.00, '2024-11-16 11:44:46', '2024-11-16 11:44:46'),
(29, 9, 31, 1, 17000.00, '2024-11-16 11:44:46', '2024-11-16 11:44:46'),
(30, 10, 32, 1, 20000.00, '2024-11-17 03:00:41', '2024-11-17 03:00:41'),
(31, 10, 33, 1, 18000.00, '2024-11-17 03:00:41', '2024-11-17 03:00:41'),
(32, 10, 40, 1, 10000.00, '2024-11-17 03:00:41', '2024-11-17 03:00:41'),
(33, 11, 1, 1, 25000.00, '2024-11-17 03:15:58', '2024-11-17 03:15:58'),
(34, 11, 29, 1, 12000.00, '2024-11-17 03:15:58', '2024-11-17 03:15:58'),
(35, 11, 31, 1, 17000.00, '2024-11-17 03:15:58', '2024-11-17 03:15:58'),
(36, 11, 32, 1, 20000.00, '2024-11-17 03:15:58', '2024-11-17 03:15:58'),
(37, 12, 29, 1, 12000.00, '2024-11-18 09:08:27', '2024-11-18 09:08:27'),
(38, 12, 30, 1, 13000.00, '2024-11-18 09:08:27', '2024-11-18 09:08:27'),
(39, 13, 1, 1, 25000.00, '2024-11-18 09:27:19', '2024-11-18 09:27:19'),
(40, 13, 29, 1, 12000.00, '2024-11-18 09:27:19', '2024-11-18 09:27:19'),
(44, 16, 1, 1, 25000.00, '2024-11-20 06:26:38', '2024-11-20 06:26:38'),
(45, 16, 29, 1, 12000.00, '2024-11-20 06:26:38', '2024-11-20 06:26:38'),
(46, 16, 30, 1, 13000.00, '2024-11-20 06:26:38', '2024-11-20 06:26:38'),
(50, 18, 30, 1, 13000.00, '2024-11-20 22:38:52', '2024-11-20 22:38:52'),
(57, 22, 29, 1, 12000.00, '2024-11-21 03:41:28', '2024-11-21 03:41:28'),
(58, 23, 1, 1, 25000.00, '2024-11-21 09:55:26', '2024-11-21 09:55:26'),
(59, 23, 29, 1, 12000.00, '2024-11-21 09:55:26', '2024-11-21 09:55:26'),
(60, 23, 30, 1, 13000.00, '2024-11-21 09:55:26', '2024-11-21 09:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `nama`, `jenis`, `harga`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Nasi Goreng', 'Makanan Utama', 25000, 'nasi_goreng.jpg', '2024-11-15 01:41:39', '2024-11-20 09:22:49'),
(29, 'Bakso Urat', 'Makanan Utama', 12000, '884d70de1b759f4caf66ff2de02ca375.jpeg', '2024-11-16 07:10:30', '2024-11-16 07:10:30'),
(30, 'Mie Ayam', 'Makanan Utama', 13000, '5ee6660aa646ee55c55a0a9a4975279a.jpg', '2024-11-16 08:25:50', '2024-11-16 08:25:50'),
(31, 'Mie Ayam Bakso', 'Makanan Utama', 17000, 'dc73a6a7b1e9ce362163aae9dcadf082.jpg', '2024-11-16 08:27:39', '2024-11-16 08:27:39'),
(32, 'Ayam Bakar', 'Makanan Utama', 20000, '1a72b57951dd80788d9e588b8976d8b3.jpg', '2024-11-16 09:18:35', '2024-11-16 09:18:35'),
(33, 'Spaghetti', 'Menu Utama', 18000, 'a7dcbcbe537963142da8c24c8c593e6d.jpg', '2024-11-16 09:23:57', '2024-11-16 09:23:57'),
(40, 'Nasi Goreng', 'Makanan Utama', 10000, '0d37a8b0cf41d72e50c4270db251b713.jpg', '2024-11-16 22:30:23', '2024-11-16 22:30:23'),
(65, 'Nasi Putih', 'Makanan Utama', 2000, '88913ad9b72b448c6bfcca75f148bf26.jpeg', '2024-11-18 05:10:34', '2024-11-18 05:10:34'),
(72, 'Es Jeruk', 'Minuman', 8000, 'cf6a0bc21d0692a466ad93af13b081ce.jpg', '2024-11-18 05:20:00', '2024-11-18 05:20:00'),
(73, 'Jus Alpukat', 'Minuman', 10000, 'eff5e388ba92d5223e97130d5231e9cd.jpg', '2024-11-18 09:01:14', '2024-11-18 09:01:14'),
(77, 'Jus Mangga', 'Minuman', 10000, 'cc6b42fd9517e30f559b2ca469cd8a69.jpg', '2024-11-20 23:49:46', '2024-11-20 23:49:46'),
(78, 'Dalgona Matcha', 'Minuman', 5000, 'bf152eeea2c722a21095122150d5bd86.jpg', '2024-11-20 23:50:35', '2024-11-20 23:51:04');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4jMXKlrjGrBcwom2cy2HpUkppit8Y3DJ1EW792r7', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTTIwTU1BRU0xeTJHQlZzTjdmOWRSaHZvaThyd2NFZk1rdDZOY0lsdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyLW1lbnUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1732411682),
('e8bUa4X99oKe9imMS6dF7eeLr91bJqQNKkU1O7Jo', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYXdFNTdKUlJWYWFqVTV5TGNESTdLTmpLU3VHUWdXeXR5Q05NVTVDSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9ybS1zaW1hbmdhdC50ZXN0L3VzZXItbWVudSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1732272746),
('YdJ4Ip2kx52DV5mA0ax7Vsvfm81hLTRD9hiLyAXF', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ1g2RmY0OUp1a3UxWnZEcmdKaWswa2RYeUNhSUdiS21oM1UxRmt5ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9ybS1zaW1hbmdhdC50ZXN0L2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1732411796);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'User', 'user@gmail.com', NULL, '$2y$12$uVZKrwn3SS0kiOoBWS1qJeJmk6xOa7n8TL0fKrUl6bod0aMo5ReQO', 'user', NULL, '2024-11-15 01:41:39', '2024-11-15 01:41:39'),
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$12$M0KVeTks3lFijtIWe3YQFeR2Q9d/BR3uqAMMZW06llg1wExOg/LTq', 'admin', NULL, '2024-11-15 01:41:39', '2024-11-21 09:50:23'),
(3, 'User2', 'user2@gmail.com', NULL, '$2y$12$8ehJVBTSC.AbYeDuch0UhOTalRbqY4e9pck7DLlKWuhG0bhBpdyiq', 'user', NULL, '2024-11-15 01:41:39', '2024-11-15 01:41:39'),
(4, 'Admin2', 'admin2@gmail.com', NULL, '$2y$12$abDsZZRnwQeK.Dt3.b7znOEYE9iSw06g17XwnaJ0f8lyi9aYbD8yC', 'admin', NULL, '2024-11-15 01:41:39', '2024-11-15 01:41:39'),
(5, 'ahmad', 'ahmad@gmail.com', NULL, '$2y$12$xjSkREljkb0aesz/sCJ1CejgNbu4NnvbQzYEePJv6oQ0V/0QuyRzq', 'user', NULL, '2024-11-16 11:34:29', '2024-11-16 11:34:29');

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
