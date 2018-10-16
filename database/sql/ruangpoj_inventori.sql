-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2018 at 10:58 AM
-- Server version: 5.7.23
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ruangpoj_inventori`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_item`
--

CREATE TABLE `master_item` (
  `id` int(11) NOT NULL,
  `nama_item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_pembelian` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `status` char(2) COLLATE utf8mb4_unicode_ci DEFAULT '00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_item`
--

INSERT INTO `master_item` (`id`, `nama_item`, `stok`, `harga_pembelian`, `harga_jual`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'motherboard asus h61', 1, 750000, 850000, 'Auto Generate From - PO20180811000001', '99', NULL, '2018-08-21 02:12:08'),
(2, 'MSI H61', 0, 700000, 750000, 'Auto Generate From - PO20180811000001', '99', NULL, '2018-08-17 19:15:00'),
(3, 'hardisk', 5, 87878, 9879879, 'Auto Generate From - PO20180815000002', '00', NULL, NULL),
(4, 'Motherboard Asus H61', 2, 650000, 725000, 'Auto Generate From - PO20180815000001', '99', NULL, '2018-08-29 19:26:02'),
(9, 'testing lagi', 2, 1500, 2000, ' Auto Generate From SC20180816000001', '99', '2018-08-16 09:31:33', '2018-08-16 09:31:33'),
(10, 'stok test', 1, 1000, 1100, ' Auto Generate From SC20180816000001', '99', '2018-08-16 09:31:33', '2018-08-16 09:31:33'),
(11, 'Budi', 1, 10000, 100000, 'Auto Generate From - PO20180820000002', '99', NULL, '2018-08-19 19:49:41'),
(12, 'ssss', 3, 450, 500, 'Auto Generate From - PO20180827000003', '00', NULL, NULL),
(13, 'dddd', 2, 300, 350, 'Auto Generate From - PO20180827000003', '00', NULL, NULL),
(14, 'pai', 1, 7000000, 75000000, 'Auto Generate From - PO20180831000004', '00', NULL, NULL),
(15, 'had', 2, 750000, 800000, 'Auto Generate From - PO20180831000004', '00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_kustomer`
--

CREATE TABLE `master_kustomer` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_kustomer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp_kustomer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_kustomer` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_kustomer`
--

INSERT INTO `master_kustomer` (`id`, `nama_kustomer`, `telp_kustomer`, `alamat_kustomer`, `created_at`, `updated_at`) VALUES
(1, 'gagas', '085747919247', 'purwokerto', '2018-08-11 02:17:06', '2018-08-11 02:17:06'),
(2, 'kiting', '9879898', 'jkahsdfasd', '2018-08-14 08:24:17', '2018-08-14 08:24:17');

-- --------------------------------------------------------

--
-- Table structure for table `master_suplier`
--

CREATE TABLE `master_suplier` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_suplier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp_suplier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_suplier` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_suplier`
--

INSERT INTO `master_suplier` (`id`, `nama_suplier`, `telp_suplier`, `alamat_suplier`, `created_at`, `updated_at`) VALUES
(2, 'test', '085747919247', 'asdfasd asd f', '2018-08-10 01:03:14', '2018-08-10 01:03:14'),
(3, 'Bakul', '08970987098', 'jhalskjdfasd', '2018-08-10 04:22:13', '2018-08-10 04:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `master_warehouse`
--

CREATE TABLE `master_warehouse` (
  `id` int(10) UNSIGNED NOT NULL,
  `warehouse_nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_warehouse`
--

INSERT INTO `master_warehouse` (`id`, `warehouse_nama`, `warehouse_alamat`, `created_at`, `updated_at`) VALUES
(1, 'Warehouse satu', 'alamat warehouse satu', NULL, NULL),
(2, 'warehouse tiga', 'alamat warehouse tiga', NULL, NULL),
(3, 'warehouse dua', 'alamat warehouse dua', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_02_03_024936_create_permission_tables', 1),
(4, '2018_02_03_160433_create_categories_table', 2),
(5, '2018_02_04_114856_create_article_table', 3),
(6, '2018_02_04_115811_create_website_menu_table', 4),
(7, '2018_02_04_120230_create_website_config_table', 5),
(8, '2018_02_05_071228_create_page_statis_table', 6),
(9, '2018_02_06_045134_create_search_engine_seo_table', 7),
(10, '2018_08_09_144125_create_master_item_table', 8),
(11, '2018_08_09_144907_create_master_suplier_table', 9),
(12, '2018_08_09_145229_create_orders_temp_table', 10),
(13, '2018_08_09_145849_create_master_kustomer_table', 11),
(14, '2018_08_10_025717_create_master_items_table', 12),
(15, '2018_08_10_064237_create_tr_pembelian_table', 12),
(16, '2018_08_10_064813_create_tr_pembelian_detail_table', 13),
(17, '2018_08_10_094954_create_pembelian_temp_table', 14),
(18, '2018_08_11_031220_create_penjualan_temp_table', 15),
(19, '2018_08_11_032513_create_tr_penjualan_table', 15),
(20, '2018_08_11_032912_create_tr_penjualan_detail_table', 16),
(21, '2018_08_12_034924_create_tr_stok_adjusment_table', 17),
(22, '2018_08_12_041302_create_tr_stok_adjusment_detail_table', 18),
(23, '2018_08_12_041941_create_adjusment_temp_table', 19),
(24, '2018_08_16_115438_create_tr_konsinyasi_table', 20),
(25, '2018_08_16_120244_create_tr_konsinyasi_detail_table', 21),
(26, '2018_08_16_122010_create_master_warehouse_table', 22),
(27, '2018_08_17_032454_create_tr_mutasi_stok_table', 23),
(28, '2018_08_17_032905_create_tr_mutasi_stok_detail_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `orders_temp`
--

CREATE TABLE `orders_temp` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `item_stok_temp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_konsinyasi`
--

CREATE TABLE `tr_konsinyasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `konsinyasi_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konsinyasi_tanggal` date NOT NULL,
  `konsinyasi_deskripsi` text COLLATE utf8mb4_unicode_ci,
  `konsinyasi_suplier_id` int(11) NOT NULL,
  `konsinyasi_total` int(11) NOT NULL,
  `konsinyasi_tipe` char(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konsinyasi_status` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00',
  `generate_status` char(2) COLLATE utf8mb4_unicode_ci DEFAULT '00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_konsinyasi`
--

INSERT INTO `tr_konsinyasi` (`id`, `konsinyasi_code`, `konsinyasi_tanggal`, `konsinyasi_deskripsi`, `konsinyasi_suplier_id`, `konsinyasi_total`, `konsinyasi_tipe`, `konsinyasi_status`, `generate_status`, `created_at`, `updated_at`) VALUES
(1, 'SC20180816000001', '2018-08-16', 'Penambahan stok dari bakul', 3, 5100, 'in', '99', '00', '2018-08-16 08:55:10', '2018-08-16 08:55:10'),
(2, 'SC20180817000002', '2018-08-17', NULL, 3, 9879879, 'out', '00', '00', '2018-08-17 01:02:12', '2018-08-17 01:02:12'),
(3, 'SC20180818000003', '2018-08-18', 'test', 3, 9879879, 'out', '00', '00', '2018-08-17 18:16:21', '2018-08-17 18:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `tr_konsinyasi_detail`
--

CREATE TABLE `tr_konsinyasi_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `tr_konsinyasi_id` int(11) NOT NULL,
  `konsinyasi_item_id` int(11) DEFAULT '0',
  `konsinyasi_item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konsinyasi_item_qty` int(11) NOT NULL,
  `konsinyasi_item_harga_beli` int(11) NOT NULL,
  `konsinyasi_item_harga_jual` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_konsinyasi_detail`
--

INSERT INTO `tr_konsinyasi_detail` (`id`, `tr_konsinyasi_id`, `konsinyasi_item_id`, `konsinyasi_item`, `konsinyasi_item_qty`, `konsinyasi_item_harga_beli`, `konsinyasi_item_harga_jual`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'testing lagi', 2, 1500, 2000, NULL, NULL),
(2, 1, 0, 'stok test', 1, 1000, 1100, NULL, NULL),
(3, 2, 3, 'hardisk', 1, 87878, 9879879, NULL, NULL),
(4, 3, 3, 'hardisk', 1, 87878, 9879879, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tr_mutasi_stok`
--

CREATE TABLE `tr_mutasi_stok` (
  `id` int(10) UNSIGNED NOT NULL,
  `mutasi_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mutasi_tanggal` date NOT NULL,
  `mutasi_deskripsi` text COLLATE utf8mb4_unicode_ci,
  `mutasi_warehouse_out` int(11) NOT NULL,
  `mutasi_warehouse_in` int(11) NOT NULL,
  `mutasi_total` int(11) NOT NULL,
  `mutasi_status` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_mutasi_stok`
--

INSERT INTO `tr_mutasi_stok` (`id`, `mutasi_code`, `mutasi_tanggal`, `mutasi_deskripsi`, `mutasi_warehouse_out`, `mutasi_warehouse_in`, `mutasi_total`, `mutasi_status`, `created_at`, `updated_at`) VALUES
(1, 'SM20180817000001', '2018-08-17', 'TESTING', 1, 2, 10604879, '00', '2018-08-17 00:11:54', '2018-08-17 00:23:39'),
(2, 'SM20180817000002', '2018-08-17', 'test', 2, 1, 750000, '00', '2018-08-17 00:41:21', '2018-08-17 00:41:21'),
(3, 'SM20180818000003', '2018-08-18', NULL, 2, 1, 9879879, '99', '2018-08-17 18:16:57', '2018-08-27 19:43:50'),
(4, 'SM20180820000004', '2018-08-20', NULL, 2, 3, 9879879, '99', '2018-08-19 19:47:59', '2018-08-27 19:43:45'),
(5, 'SM20180910000005', '2018-09-11', NULL, 2, 1, 350, '00', '2018-09-10 12:50:37', '2018-09-10 12:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `tr_mutasi_stok_detail`
--

CREATE TABLE `tr_mutasi_stok_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `mutasi_id` int(11) NOT NULL,
  `mutasi_item_id` int(11) NOT NULL,
  `mutasi_item_qty` int(11) NOT NULL,
  `mutasi_item_harga_beli` int(11) NOT NULL,
  `mutasi_item_harga_jual` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_mutasi_stok_detail`
--

INSERT INTO `tr_mutasi_stok_detail` (`id`, `mutasi_id`, `mutasi_item_id`, `mutasi_item_qty`, `mutasi_item_harga_beli`, `mutasi_item_harga_jual`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 650000, 725000, '2018-08-17 00:11:54', '2018-08-17 00:11:54'),
(2, 1, 3, 1, 87878, 9879879, '2018-08-17 00:11:54', '2018-08-17 00:11:54'),
(3, 2, 2, 1, 700000, 750000, '2018-08-17 00:41:21', '2018-08-17 00:41:21'),
(4, 3, 3, 1, 87878, 9879879, '2018-08-17 18:16:57', '2018-08-17 18:16:57'),
(5, 4, 3, 1, 87878, 9879879, '2018-08-19 19:47:59', '2018-08-19 19:47:59'),
(6, 5, 13, 1, 300, 350, '2018-09-10 12:50:37', '2018-09-10 12:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `tr_pembelian`
--

CREATE TABLE `tr_pembelian` (
  `id` int(10) UNSIGNED NOT NULL,
  `pembelian_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suplier_id` int(11) NOT NULL,
  `reference_kode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `total_harga` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tgl_pembelian` date NOT NULL,
  `user_input` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` char(2) COLLATE utf8mb4_unicode_ci DEFAULT '00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_pembelian`
--

INSERT INTO `tr_pembelian` (`id`, `pembelian_code`, `suplier_id`, `reference_kode`, `total_harga`, `tgl_pembelian`, `user_input`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PO20180816000001', 3, '34534', '13000', '2018-08-16', 'gagas', '99', '2018-08-15 18:22:32', '2018-08-15 19:30:05'),
(2, 'PO20180820000002', 2, '1', '10000', '2018-08-20', 'gagas', '99', '2018-08-19 19:48:53', '2018-09-27 23:20:01'),
(3, 'PO20180827000003', 3, '343535', '2250', '2018-08-26', 'gagas', '99', '2018-08-26 23:39:40', '2018-08-29 19:25:08'),
(4, 'PO20180831000004', 3, '12', '8500000', '2018-08-30', 'gagas', '99', '2018-08-30 17:11:50', '2018-08-30 17:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `tr_pembelian_detail`
--

CREATE TABLE `tr_pembelian_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `tr_pembelian_id` int(11) NOT NULL,
  `nama_item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_pembelian` int(11) NOT NULL,
  `harga_penjualan` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_pembelian_detail`
--

INSERT INTO `tr_pembelian_detail` (`id`, `tr_pembelian_id`, `nama_item`, `stok`, `harga_pembelian`, `harga_penjualan`, `created_at`, `updated_at`) VALUES
(1, 1, 'yosih gaber', 8, 1000, 1250, NULL, NULL),
(2, 1, 'gasdfasd', 1, 5000, 5500, NULL, NULL),
(3, 2, 'Budi', 1, 10000, 100000, NULL, NULL),
(4, 3, 'ssss', 3, 450, 500, NULL, NULL),
(5, 3, 'dddd', 3, 300, 350, NULL, NULL),
(6, 4, 'pai', 1, 7000000, 75000000, NULL, NULL),
(7, 4, 'had', 2, 750000, 800000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tr_penjualan`
--

CREATE TABLE `tr_penjualan` (
  `id` int(10) UNSIGNED NOT NULL,
  `penjualan_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kustomer_id` int(11) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `deskripsi_penjualan` text COLLATE utf8mb4_unicode_ci,
  `total_penjualan` int(11) DEFAULT NULL,
  `status` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_penjualan`
--

INSERT INTO `tr_penjualan` (`id`, `penjualan_code`, `kustomer_id`, `tgl_penjualan`, `deskripsi_penjualan`, `total_penjualan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SO20180816000001', 2, '2018-08-16', 'test', 19759758, '99', '2018-08-15 19:15:14', '2018-08-15 19:18:24'),
(2, 'SO20180816000002', 2, '2018-08-16', NULL, 725000, '99', '2018-08-15 19:19:37', '2018-08-15 19:20:22'),
(3, 'SO20180816000003', 2, '2018-08-16', 'rtsd', 9879879, '99', '2018-08-15 19:20:42', '2018-08-15 19:33:01'),
(4, 'SO20180924000004', 1, '2018-09-24', NULL, 84880379, '99', '2018-09-24 00:54:03', '2018-09-24 00:54:14'),
(5, 'SO20180926000005', 2, '2018-09-26', NULL, 9879879, '00', '2018-09-26 04:53:46', '2018-09-26 04:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `tr_penjualan_detail`
--

CREATE TABLE `tr_penjualan_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `tr_penjualan_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_jual_produk` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_penjualan_detail`
--

INSERT INTO `tr_penjualan_detail` (`id`, `tr_penjualan_id`, `produk_id`, `jumlah`, `harga_jual_produk`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2, '9879879', NULL, NULL),
(2, 2, 4, 1, '725000', NULL, NULL),
(3, 3, 3, 1, '9879879', NULL, NULL),
(4, 4, 14, 1, '75000000', NULL, NULL),
(5, 4, 12, 1, '500', NULL, NULL),
(6, 4, 3, 1, '9879879', NULL, NULL),
(7, 5, 3, 1, '9879879', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'gagas', 'pahlitamanata@gmail.com', '$2y$10$Hun1mGMYacu2BHAA5rBOJ.TNgjYSI40QaxOo5h.T/i5.PRfRkGW7S', 'a7HJEqlQe2Y4vgWGPBcbfyf5fnwaN3uktOcjeppJ02UDDrFovqRrCkjL96V4', NULL, '2018-04-19 03:30:44'),
(3, 'amelia puspita', 'puspitaamelia67@gmail.com', '$2y$10$RZjMXcJCXvBpNaCzvNVamuGfS5albRZs0AonCiZOrYNVQAtzQkmWq', NULL, '2018-08-15 04:28:17', '2018-08-15 04:28:17'),
(4, 'test', 'abibiprbw@yahoo.com', '$2y$10$KPkWhmmXHnK3exq5yK8A.O0hqNl4HjD..nxAUz6LxDIGCXS20BwM6', NULL, '2018-09-27 23:20:53', '2018-09-27 23:20:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_item`
--
ALTER TABLE `master_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_kustomer`
--
ALTER TABLE `master_kustomer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_suplier`
--
ALTER TABLE `master_suplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_warehouse`
--
ALTER TABLE `master_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_temp`
--
ALTER TABLE `orders_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `tr_konsinyasi`
--
ALTER TABLE `tr_konsinyasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_konsinyasi_detail`
--
ALTER TABLE `tr_konsinyasi_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_mutasi_stok`
--
ALTER TABLE `tr_mutasi_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_mutasi_stok_detail`
--
ALTER TABLE `tr_mutasi_stok_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_pembelian`
--
ALTER TABLE `tr_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_pembelian_detail`
--
ALTER TABLE `tr_pembelian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_penjualan`
--
ALTER TABLE `tr_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_penjualan_detail`
--
ALTER TABLE `tr_penjualan_detail`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `master_item`
--
ALTER TABLE `master_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `master_kustomer`
--
ALTER TABLE `master_kustomer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_suplier`
--
ALTER TABLE `master_suplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_warehouse`
--
ALTER TABLE `master_warehouse`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `orders_temp`
--
ALTER TABLE `orders_temp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_konsinyasi`
--
ALTER TABLE `tr_konsinyasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tr_konsinyasi_detail`
--
ALTER TABLE `tr_konsinyasi_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tr_mutasi_stok`
--
ALTER TABLE `tr_mutasi_stok`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tr_mutasi_stok_detail`
--
ALTER TABLE `tr_mutasi_stok_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tr_pembelian`
--
ALTER TABLE `tr_pembelian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tr_pembelian_detail`
--
ALTER TABLE `tr_pembelian_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tr_penjualan`
--
ALTER TABLE `tr_penjualan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tr_penjualan_detail`
--
ALTER TABLE `tr_penjualan_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
