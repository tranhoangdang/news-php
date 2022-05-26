-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th5 25, 2022 lúc 08:08 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `news`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `is_active` tinyint(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `username`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'tranhoangdang1402@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 'Trần Hoàng Đăng', 1, '2022-05-25 16:37:24', '2022-05-25 17:02:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `cover` char(200) NOT NULL,
  `summary` text NOT NULL,
  `content` longtext NOT NULL,
  `is_active` tinyint(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `subcategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `articles`
--

INSERT INTO `articles` (`id`, `title`, `cover`, `summary`, `content`, `is_active`, `created_at`, `updated_at`, `subcategoryID`) VALUES
(10, 'Môi giới BĐS thời đại mới đừng chỉ bán hàng, hãy bán tất cả những gì mình có', '../public/uploads/photo1653454789912-165345479025590121779-63789079652543.jpeg', 'Muốn bán bất động sản, đặc biệt là bất động sản triệu đô, nhà môi giới thời đại mới đừng chăm chăm vào việc bán hàng, mà hãy bán niềm tin, bán kiến thức và cảm xúc cho khách hàng.', '<p>Theo các chuyên gia bán hàng, mọi người ai cũng đang sống bằng cách bán một thứ gì đó. Nếu như xem tu sĩ \"rao bán\" niềm tin, nhà giáo \"rao bán\" kiến thức, nhà chính trị \"rao bán\" chính kiến, thì dường như nhà môi giới bất động sản không chỉ bán nhà, mà họ còn phải bán rất nhiều thứ mình có cho khách hàng.</p><p><strong>Tư vấn khéo léo - \"bán\" kiến thức</strong></p><p>Đối với một nhà môi giới BĐS thời đại mới, đòi hỏi đầu tiên là phải có một nền tảng kiến thức tổng hợp về BĐS và những lĩnh vực liên quan. Bởi khi bán một sản phẩm có giá trị lớn như BĐS, nhà môi giới không chỉ đơn thuần bán hàng, mà còn đang bán những kiến thức mình có.</p><p>Không chỉ giới thiệu về sản phẩm BĐS, nhà môi giới thời đại mới còn đóng vai trò như một chuyên viên tư vấn tài chính để tư vấn cho khách hàng chọn những sản phẩm phù hợp với nhu cầu và tài chính. Họ còn có thể đóng vai trò như một nhà tư vấn pháp lý để cung cấp những kiến thức về pháp luật, hỗ trợ khách hàng trong các thủ tục, giấy tờ ký kết hợp đồng mua bán nhà…</p>', 1, '2022-05-25 15:42:15', '2022-05-25 17:04:20', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_active` tinyint(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Thời trang', 0, '2022-05-24 14:50:50', '2022-05-25 04:38:22'),
(10, 'Thể thao', 1, '2022-05-24 15:00:33', '2022-05-25 05:00:25'),
(13, 'Văn hoá', 1, '2022-05-24 15:07:46', NULL),
(14, 'Giải trí', 0, '2022-05-24 16:19:12', '2022-05-24 17:29:14'),
(15, 'Học đường', 1, '2022-05-24 17:01:49', NULL),
(16, 'Thế giới', 0, '2022-05-24 17:03:21', '2022-05-24 17:17:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_active` tinyint(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `categoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `is_active`, `created_at`, `updated_at`, `categoryID`) VALUES
(1, 'Bóng đá', 1, '2022-05-25 04:28:31', '2022-05-25 05:03:43', 10),
(2, 'Âm nhạc', 1, '2022-05-25 04:47:26', '2022-05-25 05:03:08', 14),
(3, 'Phim', 1, '2022-05-25 06:40:27', NULL, 14),
(4, 'TV show', 1, '2022-05-25 06:41:33', NULL, 14);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
