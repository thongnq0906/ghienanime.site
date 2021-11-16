-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 21, 2020 lúc 03:29 AM
-- Phiên bản máy phục vụ: 10.1.40-MariaDB
-- Phiên bản PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `master_v2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `image` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `dislay` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` int(10) UNSIGNED NOT NULL,
  `total` int(10) UNSIGNED DEFAULT NULL,
  `note` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bills`
--

INSERT INTO `bills` (`id`, `user_id`, `name`, `email`, `address`, `phone`, `total`, `note`, `payment`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', 'kaka@gmail.com', '123 Hà Nội', 987654321, 9500000, NULL, NULL, 1, '2020-02-19 04:20:25', '2020-02-19 04:20:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_details`
--

CREATE TABLE `bill_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `bill_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bill_details`
--

INSERT INTO `bill_details` (`id`, `quantity`, `price`, `product_id`, `bill_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1900000, 1, 1, '2020-02-19 04:20:25', '2020-02-19 04:20:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cate_posts`
--

CREATE TABLE `cate_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `position` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `title_seo` text COLLATE utf8_unicode_ci,
  `meta_key` text COLLATE utf8_unicode_ci,
  `meta_des` text COLLATE utf8_unicode_ci,
  `image` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cate_posts`
--

INSERT INTO `cate_posts` (`id`, `name`, `slug`, `parent_id`, `position`, `description`, `status`, `title_seo`, `meta_key`, `meta_des`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Tin Tức', 'tin-tuc', 0, NULL, NULL, 1, NULL, NULL, NULL, 'upload/catepost/avatar5.png', '2019-03-20 02:06:44', '2020-01-16 04:50:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cate_products`
--

CREATE TABLE `cate_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `title_seo` text COLLATE utf8_unicode_ci,
  `meta_key` text COLLATE utf8_unicode_ci,
  `meta_des` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cate_products`
--

INSERT INTO `cate_products` (`id`, `parent_id`, `name`, `slug`, `image`, `position`, `description`, `status`, `title_seo`, `meta_key`, `meta_des`, `created_at`, `updated_at`) VALUES
(1, 0, 'test', 'test', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2020-02-19 04:08:23', '2020-02-19 04:08:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `intros`
--

CREATE TABLE `intros` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `description` longtext COLLATE utf8_unicode_ci,
  `title_seo` text COLLATE utf8_unicode_ci,
  `meta_key` text COLLATE utf8_unicode_ci,
  `meta_des` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_05_17_074557_create_cate_products_table', 1),
(4, '2018_05_19_003202_create_products_table', 1),
(5, '2018_05_20_193606_create_cate_posts_table', 1),
(6, '2018_05_20_215341_create_posts_table', 1),
(7, '2018_05_21_085212_create_intros_table', 1),
(8, '2018_05_21_100559_create_supports_table', 1),
(9, '2018_05_21_140145_create_banners_table', 1),
(10, '2018_05_21_145959_create_contact_table', 1),
(11, '2018_05_21_174649_create_sides_tables', 1),
(12, '2018_06_03_134955_creat_bills_table', 1),
(13, '2018_06_03_135034_creat_bill_details_table', 1),
(14, '2018_06_07_104447_create_settings_table', 1),
(15, '2018_08_20_143433_create_images_table', 1),
(16, '2018_08_21_105700_add_name_to_images_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `cate_post_id` int(10) UNSIGNED DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_home` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `description` longtext COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `content2` text COLLATE utf8_unicode_ci,
  `content3` text COLLATE utf8_unicode_ci,
  `title_seo` text COLLATE utf8_unicode_ci,
  `meta_key` text COLLATE utf8_unicode_ci,
  `meta_des` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `name`, `slug`, `cate_post_id`, `position`, `status`, `is_home`, `image`, `title`, `description`, `content`, `content2`, `content3`, `title_seo`, `meta_key`, `meta_des`, `created_at`, `updated_at`) VALUES
(1, 'Việt Nam rơi vào nhóm hạt giống thấp nhất SEA Games 2019', 'viet-nam-roi-vao-nhom-hat-giong-thap-nhat-sea-games-2019', 1, NULL, 1, 1, 'upload/post/2019_20_03_09_08_02-anh-thay-11-1200x0-1552977934-6333-1552978016.png', 'Nằm cùng Nhóm 4 với Việt Nam là Lào, Campuchia, Brunei và Timor Leste', '<p style=\"text-align:justify\">H&ocirc;m nay, chủ nh&agrave; SEA Games 2019 Philippines c&ocirc;ng bố danh s&aacute;ch bốn nh&oacute;m hạt giống ở m&ocirc;n b&oacute;ng đ&aacute; nam.&nbsp;C&aacute;ch xếp nh&oacute;m dựa tr&ecirc;n th&agrave;nh t&iacute;ch của c&aacute;c đội tuyển ở SEA Games 2017.</p>\r\n\r\n<p style=\"text-align:justify\">Tại giải đấu c&aacute;ch đ&acirc;y hai năm ở Malaysia, U22 Việt Nam được dẫn dắt bởi HLV Nguyễn Hữu Thắng.&nbsp;Sau khi thắng tưng bừng ba trận đầu ti&ecirc;n gặp Timor Leste, Campuchia v&agrave; Philippines, đội h&ograve;a Indonesia v&agrave; đại bại trước Th&aacute;i Lan n&ecirc;n bị loại ngay v&ograve;ng bảng. HLV Nguyễn Hữu Thắng ngay sau đ&oacute; tuy&ecirc;n bố từ chức.</p>\r\n\r\n<p style=\"text-align:justify\">Việc rơi v&agrave;o Nh&oacute;m 4 khiến Việt Nam đối diện bảng đấu v&ocirc; c&ugrave;ng khắc nghiệt ở Đại hội diễn ra v&agrave;o cuối năm nay.&nbsp;</p>\r\n\r\n<table align=\"center\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:justify\"><img alt=\"Quang Hải (đỏ) và các đồng đội đứng trước nguy cơ rơi vào bảng đấu khó khăn. Ảnh: Lâm Thỏa.\" src=\"https://i-thethao.vnecdn.net/2019/03/19/anh-thay-11-1200x0-1552977934-6333-1552978016.png\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p style=\"text-align:justify\">Quang Hải (đỏ) v&agrave; c&aacute;c đồng đội đứng trước nguy cơ rơi v&agrave;o bảng đấu kh&oacute; khăn. Ảnh:&nbsp;<em>L&acirc;m Thỏa.</em></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"text-align:justify\">Với tư c&aacute;ch chủ nh&agrave;, Philippines được xếp v&agrave;o Nh&oacute;m 1 c&ugrave;ng đương kim v&ocirc; địch Th&aacute;i Lan.&nbsp;Malaysia v&agrave; Indonesia ở Nh&oacute;m 2, trong khi Myanmar v&agrave; Singapore thuộc Nh&oacute;m 3.</p>\r\n\r\n<p style=\"text-align:justify\">Tại SEA Games 2019, m&ocirc;n b&oacute;ng đ&aacute; nam c&oacute; 11 đội. Trong đ&oacute;, Th&aacute;i Lan sẽ nằm ở bảng s&aacute;u đội, v&agrave; Philippines ở bảng năm đội.&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">Trước đ&oacute; Philippines đ&atilde; quyết định&nbsp;<a href=\"https://vnexpress.net/bong-da/cong-phuong-xuan-truong-lai-co-co-hoi-du-sea-games-2019-3896161.html\">cho c&aacute;c đội tuyển bổ sung 2 cầu thủ tr&ecirc;n 22 tuổi</a>. Điều đ&oacute; đồng nghĩa với việc&nbsp;lứa cầu thủ như C&ocirc;ng Phượng, Xu&acirc;n Trường, Văn To&agrave;n, Duy Mạnh... sẽ lại c&oacute; cơ hội tranh t&agrave;i tại SEA Games. Đ&acirc;y l&agrave; những cầu thủ từng c&ugrave;ng U23 Việt Nam gi&agrave;nh HC bạc ch&acirc;u &Aacute; hồi th&aacute;ng 1/2018 nhưng đ&atilde; qu&aacute; tuổi.</p>\r\n\r\n<p style=\"text-align:justify\">Trong đội U22 hiện tại c&oacute; bảy gương mặt đ&atilde; c&ugrave;ng đội tuyển quốc gia v&ocirc; địch AFF Cup 2018 hay v&agrave;o tứ kết Asian Cup 2019 l&agrave; Quang Hải, Đ&igrave;nh Trọng, Đức Chinh, Văn Hậu, B&ugrave;i Tiến Dũng (thủ m&ocirc;n), Th&agrave;nh Chung v&agrave; Tiến Linh. Việc cầu thủ n&agrave;o được lựa chọn bổ sung cho SEA Games sẽ do HLV Park Hang-seo to&agrave;n quyền quyết định.</p>', NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-20 02:08:02', '2020-01-16 03:32:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cate_product_id` int(10) UNSIGNED DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_home` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `description` longtext COLLATE utf8_unicode_ci,
  `discount` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED DEFAULT NULL,
  `available` tinyint(1) DEFAULT '1',
  `content` text COLLATE utf8_unicode_ci,
  `content2` text COLLATE utf8_unicode_ci,
  `content3` text COLLATE utf8_unicode_ci,
  `title_seo` text COLLATE utf8_unicode_ci,
  `meta_key` text COLLATE utf8_unicode_ci,
  `meta_des` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `cate_product_id`, `slug`, `price`, `position`, `status`, `is_home`, `image`, `title`, `description`, `discount`, `quantity`, `available`, `content`, `content2`, `content3`, `title_seo`, `meta_key`, `meta_des`, `created_at`, `updated_at`) VALUES
(1, 'ccccc', 1, 'ccccc', 1900000, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-19 04:08:42', '2020-02-19 04:08:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `website` text COLLATE utf8_unicode_ci,
  `address` text COLLATE utf8_unicode_ci,
  `phone` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hotline` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8_unicode_ci,
  `banner` text COLLATE utf8_unicode_ci,
  `icon` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `thead` text COLLATE utf8_unicode_ci,
  `tbody` text COLLATE utf8_unicode_ci,
  `robot` text COLLATE utf8_unicode_ci,
  `title_seo` text COLLATE utf8_unicode_ci,
  `meta_key` text COLLATE utf8_unicode_ci,
  `meta_des` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `name`, `website`, `address`, `phone`, `hotline`, `email`, `logo`, `banner`, `icon`, `description`, `thead`, `tbody`, `robot`, `title_seo`, `meta_key`, `meta_des`, `created_at`, `updated_at`) VALUES
(1, 'Nhập tên công ty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-03-19 15:18:07', '2019-03-19 15:18:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slides`
--

CREATE TABLE `slides` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `position` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `link` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dislay` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `supports`
--

CREATE TABLE `supports` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `list` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'thongnq0906@gmail.com', '$2y$10$W6gMtAiu.qYC8qWIldQqn.wL9H/DjpSwRRxlKSxYQZ/EQ/SC5loKO', 1, 0, 'Osf2G3ADfVGX4FaPlNKrGI8HMtnMnmxujxIOKKW074Bya0hzC4DelBBquDEp', NULL, NULL),
(2, 'nqt', 'quocthonght95@gmail.com', '$2y$10$q2k0HJr456Y4ZuQIcNEb6.J9/PRg/a8cb0yJ01.Hds1zj0rnwi5Wq', 1, 0, NULL, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bill_details`
--
ALTER TABLE `bill_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_details_product_id_foreign` (`product_id`),
  ADD KEY `bill_details_bill_id_foreign` (`bill_id`);

--
-- Chỉ mục cho bảng `cate_posts`
--
ALTER TABLE `cate_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cate_posts_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `cate_products`
--
ALTER TABLE `cate_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cate_products_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `intros`
--
ALTER TABLE `intros`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_cate_post_id_foreign` (`cate_post_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_cate_product_id_foreign` (`cate_product_id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supports_position_unique` (`position`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `bill_details`
--
ALTER TABLE `bill_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `cate_posts`
--
ALTER TABLE `cate_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `cate_products`
--
ALTER TABLE `cate_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `intros`
--
ALTER TABLE `intros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `supports`
--
ALTER TABLE `supports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bill_details`
--
ALTER TABLE `bill_details`
  ADD CONSTRAINT `bill_details_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_cate_post_id_foreign` FOREIGN KEY (`cate_post_id`) REFERENCES `cate_posts` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_cate_product_id_foreign` FOREIGN KEY (`cate_product_id`) REFERENCES `cate_products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
