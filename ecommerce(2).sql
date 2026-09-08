-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2026 at 06:45 PM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banner_categories`
--

CREATE TABLE `banner_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `placement` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jeep', 'jeep', NULL, 1, '2026-09-08 16:04:00', '2026-09-08 16:04:00'),
(2, 'cocacala', 'cocacala', NULL, 1, '2026-09-08 16:04:06', '2026-09-08 16:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `session_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'RH1QvqHbt2TKP1buQBxZssHX4RrhIwZeVaglknmx', '2026-09-08 16:09:54', '2026-09-08 16:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `front_view` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `status`, `front_view`, `created_at`, `updated_at`) VALUES
(1, 'Woman', 'woman', NULL, 1, 0, '2026-09-08 16:03:43', '2026-09-08 16:03:43'),
(2, 'Education', 'education', NULL, 1, 0, '2026-09-08 16:03:48', '2026-09-08 16:03:48'),
(3, 'Portfolio', 'portfolio', NULL, 1, 0, '2026-09-08 16:03:55', '2026-09-08 16:03:55');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `color_code` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `color_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Black', '#000000', 1, '2026-09-08 16:04:16', '2026-09-08 16:04:16'),
(2, 'Red', '#ff0000', 1, '2026-09-08 16:04:25', '2026-09-08 16:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `color_product`
--

CREATE TABLE `color_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `color_product`
--

INSERT INTO `color_product` (`id`, `product_id`, `color_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` enum('fixed','percent') NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `limit` int(11) DEFAULT NULL,
  `used` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courier_settings`
--

CREATE TABLE `courier_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'courier',
  `courier_name` varchar(255) NOT NULL,
  `base_url` varchar(255) DEFAULT NULL,
  `api_url` varchar(255) DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `secret_key` text DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `account_id` varchar(255) DEFAULT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `sandbox` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(4, '2026_07_12_072102_create_categories_table', 1),
(5, '2026_07_12_072103_create_brands_table', 1),
(6, '2026_07_12_072104_create_tags_table', 1),
(7, '2026_07_12_072105_create_products_table', 1),
(8, '2026_07_12_072106_create_product_images_table', 1),
(9, '2026_07_12_072107_create_carts_table', 1),
(10, '2026_07_12_072108_create_cart_items_table', 1),
(11, '2026_07_12_072108_create_shipping_areas_table', 1),
(12, '2026_07_12_072109_create_orders_table', 1),
(13, '2026_07_12_072110_create_order_items_table', 1),
(14, '2026_07_12_072111_create_payments_table', 1),
(15, '2026_07_12_072112_create_coupons_table', 1),
(16, '2026_07_12_072113_create_reviews_table', 1),
(17, '2026_08_15_194032_create_permissions_table', 1),
(18, '2026_08_15_194033_create_role_permissions_table', 1),
(19, '2026_08_27_013228_create_banner_categories_table', 1),
(20, '2026_08_27_013229_create_banners_table', 1),
(21, '2026_08_29_100538_create_smtp_settings_table', 1),
(22, '2026_08_29_235625_create_courier_settings_table', 1),
(23, '2026_08_31_204914_create_colors_sizes_table', 1),
(24, '2026_08_31_215833_create_color_size_product_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `shipping_area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `shipping` decimal(12,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(12,2) NOT NULL,
  `payment_method` enum('cod','bkash','nagad','sslcommerz') NOT NULL,
  `payment_status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `order_status` enum('pending','confirmed','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `trx_id` varchar(255) DEFAULT NULL,
  `method` enum('cod','bkash','nagad','sslcommerz') NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `module`, `action`, `created_at`, `updated_at`) VALUES
(1, 'categories.view', 'categories', 'view', NULL, NULL),
(2, 'categories.create', 'categories', 'create', NULL, NULL),
(3, 'categories.edit', 'categories', 'edit', NULL, NULL),
(4, 'categories.delete', 'categories', 'delete', NULL, NULL),
(5, 'categories.status', 'categories', 'status', NULL, NULL),
(6, 'brands.view', 'brands', 'view', NULL, NULL),
(7, 'brands.create', 'brands', 'create', NULL, NULL),
(8, 'brands.edit', 'brands', 'edit', NULL, NULL),
(9, 'brands.delete', 'brands', 'delete', NULL, NULL),
(10, 'brands.status', 'brands', 'status', NULL, NULL),
(11, 'products.view', 'products', 'view', NULL, NULL),
(12, 'products.create', 'products', 'create', NULL, NULL),
(13, 'products.edit', 'products', 'edit', NULL, NULL),
(14, 'products.delete', 'products', 'delete', NULL, NULL),
(15, 'tags.view', 'tags', 'view', NULL, NULL),
(16, 'tags.create', 'tags', 'create', NULL, NULL),
(17, 'tags.edit', 'tags', 'edit', NULL, NULL),
(18, 'tags.delete', 'tags', 'delete', NULL, NULL),
(19, 'tags.status', 'tags', 'status', NULL, NULL),
(20, 'colors.view', 'colors', 'view', NULL, NULL),
(21, 'colors.create', 'colors', 'create', NULL, NULL),
(22, 'colors.edit', 'colors', 'edit', NULL, NULL),
(23, 'colors.delete', 'colors', 'delete', NULL, NULL),
(24, 'colors.status', 'colors', 'status', NULL, NULL),
(25, 'sizes.view', 'sizes', 'view', NULL, NULL),
(26, 'sizes.create', 'sizes', 'create', NULL, NULL),
(27, 'sizes.edit', 'sizes', 'edit', NULL, NULL),
(28, 'sizes.delete', 'sizes', 'delete', NULL, NULL),
(29, 'sizes.status', 'sizes', 'status', NULL, NULL),
(30, 'couriers.view', 'couriers', 'view', NULL, NULL),
(31, 'couriers.create', 'couriers', 'create', NULL, NULL),
(32, 'couriers.edit', 'couriers', 'edit', NULL, NULL),
(33, 'couriers.delete', 'couriers', 'delete', NULL, NULL),
(34, 'couriers.status', 'couriers', 'status', NULL, NULL),
(35, 'banners.view', 'banners', 'view', NULL, NULL),
(36, 'banners.create', 'banners', 'create', NULL, NULL),
(37, 'banners.edit', 'banners', 'edit', NULL, NULL),
(38, 'banners.delete', 'banners', 'delete', NULL, NULL),
(39, 'banners.status', 'banners', 'status', NULL, NULL),
(40, 'banners_categories.view', 'banners_categories', 'view', NULL, NULL),
(41, 'banners_categories.create', 'banners_categories', 'create', NULL, NULL),
(42, 'banners_categories.edit', 'banners_categories', 'edit', NULL, NULL),
(43, 'banners_categories.delete', 'banners_categories', 'delete', NULL, NULL),
(44, 'banners_categories.status', 'banners_categories', 'status', NULL, NULL),
(45, 'smtp.view', 'smtp', 'view', NULL, NULL),
(46, 'smtp.create', 'smtp', 'create', NULL, NULL),
(47, 'smtp.edit', 'smtp', 'edit', NULL, NULL),
(48, 'orders.create', 'orders', 'create', NULL, NULL),
(49, 'orders.view', 'orders', 'view', NULL, NULL),
(50, 'orders.edit', 'orders', 'edit', NULL, NULL),
(51, 'orders.delete', 'orders', 'delete', NULL, NULL),
(52, 'orders.status', 'orders', 'status', NULL, NULL),
(53, 'shipping.view', 'shipping', 'view', NULL, NULL),
(54, 'shipping.create', 'shipping', 'create', NULL, NULL),
(55, 'shipping.edit', 'shipping', 'edit', NULL, NULL),
(56, 'shipping.delete', 'shipping', 'delete', NULL, NULL),
(57, 'shipping.status', 'shipping', 'status', NULL, NULL),
(58, 'users.view', 'users', 'view', NULL, NULL),
(59, 'users.create', 'users', 'create', NULL, NULL),
(60, 'users.edit', 'users', 'edit', NULL, NULL),
(61, 'users.delete', 'users', 'delete', NULL, NULL),
(62, 'users.status', 'users', 'status', NULL, NULL),
(63, 'coupons.view', 'coupons', 'view', NULL, NULL),
(64, 'coupons.create', 'coupons', 'create', NULL, NULL),
(65, 'coupons.edit', 'coupons', 'edit', NULL, NULL),
(66, 'coupons.delete', 'coupons', 'delete', NULL, NULL),
(67, 'coupons.status', 'coupons', 'status', NULL, NULL),
(68, 'payments.view', 'payments', 'view', NULL, NULL),
(69, 'payments.create', 'payments', 'create', NULL, NULL),
(70, 'payments.edit', 'payments', 'edit', NULL, NULL),
(71, 'payments.delete', 'payments', 'delete', NULL, NULL),
(72, 'payments.status', 'payments', 'status', NULL, NULL),
(73, 'payments_gateway.view', 'payments_gateway', 'view', NULL, NULL),
(74, 'payments_gateway.create', 'payments_gateway', 'create', NULL, NULL),
(75, 'payments_gateway.edit', 'payments_gateway', 'edit', NULL, NULL),
(76, 'payments_gateway.delete', 'payments_gateway', 'delete', NULL, NULL),
(77, 'payments_gateway.status', 'payments_gateway', 'status', NULL, NULL),
(78, 'sms_gateway.view', 'sms_gateway', 'view', NULL, NULL),
(79, 'sms_gateway.create', 'sms_gateway', 'create', NULL, NULL),
(80, 'sms_gateway.edit', 'sms_gateway', 'edit', NULL, NULL),
(81, 'sms_gateway.delete', 'sms_gateway', 'delete', NULL, NULL),
(82, 'sms_gateway.status', 'sms_gateway', 'status', NULL, NULL),
(83, 'reviews.view', 'reviews', 'view', NULL, NULL),
(84, 'reviews.create', 'reviews', 'create', NULL, NULL),
(85, 'reviews.edit', 'reviews', 'edit', NULL, NULL),
(86, 'reviews.delete', 'reviews', 'delete', NULL, NULL),
(87, 'reviews.status', 'reviews', 'status', NULL, NULL),
(88, 'media.view', 'media', 'view', NULL, NULL),
(89, 'media.create', 'media', 'create', NULL, NULL),
(90, 'media.edit', 'media', 'edit', NULL, NULL),
(91, 'media.delete', 'media', 'delete', NULL, NULL),
(92, 'setting.view', 'setting', 'view', NULL, NULL),
(93, 'setting.create', 'setting', 'create', NULL, NULL),
(94, 'setting.edit', 'setting', 'edit', NULL, NULL),
(95, 'setting.delete', 'setting', 'delete', NULL, NULL),
(96, 'page.view', 'page', 'view', NULL, NULL),
(97, 'page.create', 'page', 'create', NULL, NULL),
(98, 'page.edit', 'page', 'edit', NULL, NULL),
(99, 'page.delete', 'page', 'delete', NULL, NULL),
(100, 'stocks_report.view', 'stocks_report', 'view', NULL, NULL),
(101, 'stocks_report.create', 'stocks_report', 'create', NULL, NULL),
(102, 'stocks_report.edit', 'stocks_report', 'edit', NULL, NULL),
(103, 'stocks_report.delete', 'stocks_report', 'delete', NULL, NULL),
(104, 'sales_report.view', 'sales_report', 'view', NULL, NULL),
(105, 'sales_report.create', 'sales_report', 'create', NULL, NULL),
(106, 'sales_report.edit', 'sales_report', 'edit', NULL, NULL),
(107, 'sales_report.delete', 'sales_report', 'delete', NULL, NULL),
(108, 'orders_report.view', 'orders_report', 'view', NULL, NULL),
(109, 'orders_report.create', 'orders_report', 'create', NULL, NULL),
(110, 'orders_report.edit', 'orders_report', 'edit', NULL, NULL),
(111, 'orders_report.delete', 'orders_report', 'delete', NULL, NULL),
(112, 'ip.view', 'ip', 'view', NULL, NULL),
(113, 'ip.create', 'ip', 'create', NULL, NULL),
(114, 'ip.edit', 'ip', 'edit', NULL, NULL),
(115, 'ip.delete', 'ip', 'delete', NULL, NULL),
(116, 'invoices.view', 'invoices', 'view', NULL, NULL),
(117, 'invoices.download', 'invoices', 'download', NULL, NULL),
(118, 'permission.view', 'permission', 'view', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tag_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `discount_price` decimal(12,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `short_description` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `hot_deals` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `tag_id`, `name`, `slug`, `sku`, `thumbnail`, `price`, `discount_price`, `stock`, `short_description`, `description`, `status`, `hot_deals`, `created_at`, `updated_at`) VALUES
(1, 2, 2, NULL, 'Always Smile Printed Boys T-shirt For Men f gh', 'always-smile-printed-boys-t-shirt-for-men-f-gh', 'DAK125', 'products/DzQcBwRJRWJohOhJS2n5h0GBgcgpQLibItMBaihq.jpg', 200.00, 180.00, 20, 'DXVZV', 'CBVC DFHGFH', 1, 1, '2026-09-08 16:06:18', '2026-09-08 16:06:18'),
(2, 1, 1, NULL, 'Always Smile Printed Boys T-shirt For Men', 'always-smile-printed-boys-t-shirt-for-men', 'DAK129', 'products/IqRw5EJTkueB8VIH17p16ByZuJEgunBTASsuqmJ2.jpg', 5600.00, 5400.00, 10, 'CXZVC', 'CXVCXVXCV', 1, 1, '2026-09-08 16:12:22', '2026-09-08 16:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'products/gallery/vFx1lw4CkavOhtuXc1bq6G1i29t1mnT2GkHmOoOT.jpg', '2026-09-08 16:06:18', '2026-09-08 16:06:18'),
(2, 1, 'products/gallery/V7FGF6fbTrdwNKfVKCijfjLFq1dcD4grY7vTk89N.jpg', '2026-09-08 16:06:18', '2026-09-08 16:06:18'),
(3, 1, 'products/gallery/NliGRPqSr9V3RNeX8oDP8tBM5AzHuK38lumMMj6p.jpg', '2026-09-08 16:06:18', '2026-09-08 16:06:18'),
(4, 1, 'products/gallery/RXe8tVdvFnZ6sh40wijMQ1dEslL1d61OVJhWvFMe.jpg', '2026-09-08 16:06:18', '2026-09-08 16:06:18'),
(5, 2, 'products/gallery/FI7Nuf2JtVp6NN3fevprf20CYkN5oRgViKmoCz6A.jpg', '2026-09-08 16:12:22', '2026-09-08 16:12:22'),
(6, 2, 'products/gallery/wdVpAX4PqhH0Tf3sfZSm1xa5gwmULSfZtjE3KvRi.jpg', '2026-09-08 16:12:22', '2026-09-08 16:12:22'),
(7, 2, 'products/gallery/diNFLHruqWuRBaE0puwJaa5hfu2kwiBSsJKDclDj.jpg', '2026-09-08 16:12:22', '2026-09-08 16:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`id`, `product_id`, `size_id`) VALUES
(1, 1, 3),
(2, 1, 4),
(5, 2, 2),
(3, 2, 3),
(4, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('Administrator','Shop Manager','Editor','Contributor') NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('RH1QvqHbt2TKP1buQBxZssHX4RrhIwZeVaglknmx', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWDNtMjA0VmxYUHNsSzl4eE9ZZnhKeW01ZnpoR2lzQ1NKU3FZSEk2UyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3VzZXJzL3JvbGUtcGVybWlzc2lvbnMiO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1788885280);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_areas`
--

CREATE TABLE `shipping_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_areas`
--

INSERT INTO `shipping_areas` (`id`, `name`, `charge`, `status`, `created_at`, `updated_at`) VALUES
(1, 'DHAKA 150', 150.00, 1, '2026-09-08 16:05:11', '2026-09-08 16:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'S', 1, '2026-09-08 16:04:32', '2026-09-08 16:04:32'),
(2, 'L', 1, '2026-09-08 16:04:37', '2026-09-08 16:04:37'),
(3, 'M', 1, '2026-09-08 16:04:45', '2026-09-08 16:04:45'),
(4, 'XL', 1, '2026-09-08 16:04:51', '2026-09-08 16:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `smtp_settings`
--

CREATE TABLE `smtp_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL,
  `port` int(10) UNSIGNED NOT NULL DEFAULT 587,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `encryption` varchar(255) DEFAULT NULL,
  `from_email` varchar(255) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` enum('Administrator','Shop Manager','Editor','Contributor','Customer') NOT NULL DEFAULT 'Customer',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `image`, `role`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md Imran Hosen', 'imran.ppi453@gmail.com', '01756041512', '3 no Fakirhat, Agrabad,\nBandar, Chittagong', 'users/administrator/mdimranhosen_01756041512.jpg', 'Administrator', 1, NULL, '$2y$12$M8V390Vwv1I88Snc8hBDP.Wd5MOoNEPxKueij6wXaBMSSxYau5Day', 'XthjBX3yjUWYICFXy3N0cgIiMb2SR9fO8DswTf6xkkxuiKrUwHwvIauN5y5L', '2026-09-08 14:34:28', '2026-09-08 14:35:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_banner_category_id_foreign` (`banner_category_id`);

--
-- Indexes for table `banner_categories`
--
ALTER TABLE `banner_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banner_categories_slug_unique` (`slug`),
  ADD KEY `banner_categories_placement_index` (`placement`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `colors_name_unique` (`name`);

--
-- Indexes for table `color_product`
--
ALTER TABLE `color_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `color_product_product_id_color_id_unique` (`product_id`,`color_id`),
  ADD KEY `color_product_color_id_foreign` (`color_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `courier_settings`
--
ALTER TABLE `courier_settings`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `orders_invoice_no_unique` (`invoice_no`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_shipping_area_id_foreign` (`shipping_area_id`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`),
  ADD KEY `permissions_module_action_index` (`module`,`action`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_size_product_id_size_id_unique` (`product_id`,`size_id`),
  ADD KEY `product_size_size_id_foreign` (`size_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_permissions_role_permission_id_unique` (`role`,`permission_id`),
  ADD KEY `role_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipping_areas`
--
ALTER TABLE `shipping_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sizes_name_unique` (`name`);

--
-- Indexes for table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banner_categories`
--
ALTER TABLE `banner_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `color_product`
--
ALTER TABLE `color_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courier_settings`
--
ALTER TABLE `courier_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_areas`
--
ALTER TABLE `shipping_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_banner_category_id_foreign` FOREIGN KEY (`banner_category_id`) REFERENCES `banner_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `color_product`
--
ALTER TABLE `color_product`
  ADD CONSTRAINT `color_product_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `color_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_shipping_area_id_foreign` FOREIGN KEY (`shipping_area_id`) REFERENCES `shipping_areas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_size_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
