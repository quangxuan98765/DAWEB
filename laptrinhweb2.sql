-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2023 at 05:53 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laptrinhweb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(200) NOT NULL,
  `brand_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`) VALUES
(1, 'ACER'),
(2, 'MSI'),
(3, 'ASUS'),
(4, 'LENOVO'),
(5, 'DELL');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `taikhoan` varchar(50) NOT NULL,
  `masp` varchar(255) NOT NULL,
  `soluong` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(200) NOT NULL,
  `category_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'laptop'),
(2, 'phụ kiện');

-- --------------------------------------------------------

--
-- Table structure for table `diachi`
--

CREATE TABLE `diachi` (
  `id` int(10) NOT NULL,
  `taikhoan` varchar(50) NOT NULL,
  `city` text NOT NULL,
  `tenduong` text NOT NULL,
  `sonha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `id` int(11) NOT NULL,
  `tentaikhoan` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `payment` varchar(100) NOT NULL,
  `id_dc` int(10) NOT NULL,
  `trangthai` varchar(100) NOT NULL,
  `sdt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(10) NOT NULL,
  `MaSP` varchar(255) NOT NULL,
  `TenSP` varchar(100) NOT NULL,
  `HinhSP` text NOT NULL,
  `MoTaSP` varchar(200) NOT NULL,
  `GiaSP` int(11) NOT NULL,
  `more_img` text NOT NULL,
  `more_img1` text NOT NULL,
  `more_img2` text NOT NULL,
  `category_id` int(200) NOT NULL,
  `brand_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `MaSP`, `TenSP`, `HinhSP`, `MoTaSP`, `GiaSP`, `more_img`, `more_img1`, `more_img2`, `category_id`, `brand_id`) VALUES
(22, 'INAS7823', 'Acer', '../ProjectWeb/img/product/acer1.png', 'Hiệu năng ổn định, ấn tượng', 21000000, '../ProjectWeb/img/product/acer2.png', '../ProjectWeb/img/product/acer11.png', '../ProjectWeb/img/product/acer12.png', 1, 1),
(23, 'FEASF23', 'Bàn phím asus', '../ProjectWeb/img/product/product-38.png', 'Đa dạng các cổng kết nối', 500000, '../ProjectWeb/img/product/banphim13.png', '../ProjectWeb/img/product/product-22.png', '../ProjectWeb/img/product/product-40.png', 2, 3),
(24, 'ASUF8892', 'Acer Nitro Gaming 5 ', '../ProjectWeb/img/product/acer2.png', 'thiết kế sang trọng và thanh lịch', 23000000, '../ProjectWeb/img/product/acer21.png', '../ProjectWeb/img/product/acer22.png', '../ProjectWeb/img/product/acer23.png', 1, 1),
(26, 'FISD28934', 'Asus TUF Gaming', '../ProjectWeb/img/product/asus2.png', 'Thiết kế mạnh mẽ, phong cách Gaming', 20000000, '../ProjectWeb/img/product/asus21.png', '../ProjectWeb/img/product/asus22.png', '../ProjectWeb/img/product/asus23.png', 1, 3),
(27, '82K101HGVN', 'Lenovo Gaming IdeaPad 3', '../ProjectWeb/img/product/lenovo1.png', 'Ổ cứng SSD 512GB khởi động máy nhanh chóng', 19000000, '../ProjectWeb/img/product/lenovo11.png', '../ProjectWeb/img/product/lenovo12.png', '../ProjectWeb/img/product/lenovo13.png', 1, 4),
(28, 'GIDsu781', 'Lenovo IdeaPad', '../ProjectWeb/img/product/lenovo1.jpg', 'Hiệu năng ổn định, ấn tượng', 6500000, '../ProjectWeb/img/product/huawei2.jpg', '../ProjectWeb/img/product/huawei1.jpg', '../ProjectWeb/img/product/hp2.jpg', 1, 4),
(29, 'P112F002BBL', 'Dell Vostro', '../ProjectWeb/img/product/dell2.png', 'Card rời NVIDIA GeForce RTX 3050 đồ họa mượt mà', 30000000, '../ProjectWeb/img/product/dell21.png', '../ProjectWeb/img/product/dell22.png', '../ProjectWeb/img/product/dell23.png', 1, 5),
(30, 'B7M098VN', 'Asus Modern', '../ProjectWeb/img/product/asus1.png', 'Màn hình 144Hz viền mỏng hiển thị hình ảnh chân thật', 6850000, '../ProjectWeb/img/product/asus11.png', '../ProjectWeb/img/product/asus12.png', '../ProjectWeb/img/product/asus13.png', 1, 3),
(31, 'eg2083TU', 'Dell Pavilion', '../ProjectWeb/img/product/dell1.png', 'Công nghệ DTS:X Ultra Audio cho trải nghiệm âm thanh lớn', 17000000, '../ProjectWeb/img/product/dell11.png', '../ProjectWeb/img/product/dell12.png', '../ProjectWeb/img/product/dell13.png', 1, 5),
(32, 'AOVUSF234', 'MSI Modern', '../ProjectWeb/img/product/MSI1.png', 'Trang bị bàn phím chuyển màu RGB độc đáo', 27000000, '../ProjectWeb/img/product/MSI11.png', '../ProjectWeb/img/product/MSi12.png', '../ProjectWeb/img/product/MSI13.png', 1, 2),
(34, '82H80388VN', 'Lenovo Thinhpad', '../ProjectWeb/img/product/product-16.png', 'Thiết kế trang nhã, hiện đại', 31000000, '../ProjectWeb/img/product/product-17.png', '../ProjectWeb/img/product/product-18.png', '../ProjectWeb/img/product/hp3.jpg', 1, 4),
(35, 'L1026W', 'MSIVivobook', '../ProjectWeb/img/product/product-14.png', 'Chip AMD Ryzen™ 5-3500U giúp bạn xử lý tốt mọi công việc', 32000000, '../ProjectWeb/img/product/product-4.png', '../ProjectWeb/img/product/product-5.png', '../ProjectWeb/img/product/product-15.png', 1, 2),
(36, 'A3155854M5', 'MSI Aspire 3', '../ProjectWeb/img/product/MSI2.png', 'RAM 8GB chuẩn DDR4 cho phép máy chạy mượt nhiều Tab', 14500000, '../ProjectWeb/img/product/MSI21.png', '../ProjectWeb/img/product/MSI22.png', '../ProjectWeb/img/product/MSI23.png', 1, 2),
(37, 'UIGAG823', 'Lenovo Thinhpad 5', '../ProjectWeb/img/product/lenovo2.png', 'Card NVIDIA GeForce RTX 3050Ti tăng cường nguồn sức mạnh', 40000000, '../ProjectWeb/img/product/lenovo21.png', '../ProjectWeb/img/product/lenovo22.png', '../ProjectWeb/img/product/lenovo23.png', 1, 4),
(38, 'OHHAW28934', 'Asus Vitus', '../ProjectWeb/img/product/product-7.png', 'Làm việc tốt, chơi game mượt', 25000000, '../ProjectWeb/img/product/product-11.png', '../ProjectWeb/img/product/product-9.png', '../ProjectWeb/img/product/product-12.png', 1, 3),
(39, 'SOHF9234', 'Bàn phím Dell', '../ProjectWeb/img/product/banphim22.png', 'Bộ bàn phím và chuột MK235 kết nối không dây tiện lợi', 450000, '../ProjectWeb/img/product/banphim23.png', '../ProjectWeb/img/product/banphim21.png', '../ProjectWeb/img/product/banphim12.png', 2, 5),
(40, 'FAHAf9234', 'Màn hình Dell', '../ProjectWeb/img/product/manhinh1.png', 'Thời gian phản hồi 5ms cho hình ảnh chuyển động mượt mà', 2100000, '../ProjectWeb/img/product/manhinh11.png', '../ProjectWeb/img/product/manhinh12.png', '../ProjectWeb/img/product/manhinh13.png', 2, 5),
(41, 'FSGU34872', 'Loa Acer', '../ProjectWeb/img/product/loa2.png', 'Thiết kế nhỏ gọn, tiện mang theo và nghe nhạc mọi lúc', 300000, '../ProjectWeb/img/product/loa21.png', '../ProjectWeb/img/product/loa22.png', '../ProjectWeb/img/product/loa23.png', 2, 1),
(42, 'IUERF789234', 'Loa Asus', '../ProjectWeb/img/product/loa1.png', 'Thiết Kế Over Ear tạo nên cảm giác khỏe khoắn', 400000, '../ProjectWeb/img/product/loa11.png', '../ProjectWeb/img/product/loa12.png', '../ProjectWeb/img/product/loa13.png', 2, 3),
(43, 'AUIW28934', 'Màn hình Dell', '../ProjectWeb/img/product/manhinh2.png', 'Trải nghiệm hình ảnh rõ nét với độ phân giải Full HD', 1000000, '../ProjectWeb/img/product/manhinh21.png', '../ProjectWeb/img/product/manhinh22.png', '../ProjectWeb/img/product/manhinh23.png', 2, 5),
(44, 'AIEUr2374', 'Ổ cứng Acer', '../ProjectWeb/img/product/ocung1.png', 'Tốc độ truyền tải nhanh, giao diện kết nối USB 3.2 Gen 2', 2500000, '../ProjectWeb/img/product/ocung11.png', '../ProjectWeb/img/product/ocung12.png', '../ProjectWeb/img/product/ocung13.png', 2, 1),
(45, 'oU798234', 'Tai nghe MSI', '../ProjectWeb/img/product/tainghe2.png', 'Thiết kế nhỏ gọn, tiện mang theo và nghe nhạc mọi lúc', 350000, '../ProjectWeb/img/product/tainghe21.png', '../ProjectWeb/img/product/tainghe22.png', '../ProjectWeb/img/product/tainghe23.png', 2, 2),
(46, 'AUIdh8734', 'Tai nghe MSI', '../ProjectWeb/img/product/tainghe1.png', 'Tai có lớp đệm êm, bọc da cao cấp, tạo cảm giác thoải mái', 350000, '../ProjectWeb/img/product/tainghe11.png', '../ProjectWeb/img/product/tainghe12.png', '../ProjectWeb/img/product/tainghe13.png', 2, 2),
(47, 'AIUd8724', 'Ổ cứng Dell', '../ProjectWeb/img/product/ocung21.png', 'Ổ cứng SSD 512GB giúp khởi động máy nhanh chóng', 2000000, '../ProjectWeb/img/product/ocung2.png', '../ProjectWeb/img/product/ocung22.png', '../ProjectWeb/img/product/ocung23.png', 2, 5),
(48, 'SA93234F', 'Bàn phím Asus', '../ProjectWeb/img/product/product-26.png', 'Bàn phím được thiết kế đơn giản, phím bấm với độ nổi thấp', 400000, '../ProjectWeb/img/product/product-27.png', '../ProjectWeb/img/product/product-25.png', '../ProjectWeb/img/product/product-37.png', 2, 3),
(49, 'PGSUEG234', 'Acer Spire 5', '../ProjectWeb/img/product/acer1.jpg', 'Laptop có kích thước 14\" độ phân giải Full HD', 19500000, '../ProjectWeb/img/product/asus2.jpg', '../ProjectWeb/img/product/asus13.png', '../ProjectWeb/img/product/dell1.jpg', 1, 1),
(50, 'IRELIA-0175', 'Raiden nuke dame', '../ProjectWeb/img/product/Screenshot (176).png', 'Thiết kế tinh tế nhỏ gọn phù hợp nhiều không gian', 33850000, '../ProjectWeb/img/product/Screenshot (153).png', '../ProjectWeb/img/product/Screenshot (155).png', '../ProjectWeb/img/product/Screenshot (156).png', 1, 5),
(51, 'ABCXNZZ234', 'Hutao nuke dame', '../ProjectWeb/img/product/Screenshot (321).jpg', 'Màn hình 144Hz viền mỏng hiển thị hình ảnh chân thật', 555800000, '../ProjectWeb/img/product/Screenshot (163).png', '../ProjectWeb/img/product/Screenshot (237).png', '../ProjectWeb/img/product/Screenshot (162).png', 1, 5),
(52, '200ODlyear', 'Nilou nuke 20p gg', '../ProjectWeb/img/product/Screenshot (181).png', 'Ngoại hình cá tính, phong cách mạnh mẽ', 1260000000, '../ProjectWeb/img/product/Screenshot (184).png', '../ProjectWeb/img/product/Screenshot (223).png', '../ProjectWeb/img/product/Screenshot (225).png', 1, 5),
(53, 'FFId8734', 'Ganyu 20p GG', '../ProjectWeb/img/product/Screenshot (320).png', 'CPU Intel Core i5-1155G7 mạnh mẽ', 115115115, '../ProjectWeb/img/product/Screenshot (319).png', '../ProjectWeb/img/product/Screenshot (210).png', '../ProjectWeb/img/product/Screenshot (209).png', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sl_sp_dh`
--

CREATE TABLE `sl_sp_dh` (
  `id_dh` int(11) NOT NULL,
  `id_sp` int(10) NOT NULL,
  `soluong` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sl_sp_dh`
--

INSERT INTO `sl_sp_dh` (`id_dh`, `id_sp`, `soluong`) VALUES
(23, 4, 2),
(23, 5, 1),
(23, 6, 1),
(24, 15, 2),
(24, 16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `fullname`, `role`, `disabled`) VALUES
('henemkiepsautagapnhau', '$2y$10$oQhjN1F3gqVFMhwFtc7wFeUUTjZMMz/czNd60VY7c1dfIezMbvHaK', 'bolerotrutinh@gmail.com', 'Con Thuyền', 'normal', 0),
('kodamdauemconphaihocbai', '$2y$10$4BlCa2ILfMmh4N6T5pFzzu16qqSegD/GJiqRM8UQWqEgXD4JNEWcm', 'mathew@gmail.com', 'Lê Thị Mộng Thường', 'normal', 0),
('newaccount', '$2y$10$02KmdlDsZaMP.a399eQbjO2qYQ6hD9YJKUHED73A7o6bCiBwJHUJe', '123boyzzkhoi@gmail.com', 'TaochuAi', 'admin', 0),
('nextmoonqueen', '$2y$10$SRCCtDQaWPJ8njyP92Gh6OezuA7u9rzY7/Amw1t8jmdgxnyC0TSx2', 'yidepe9903@inkmoto.com', 'Ranni', 'normal', 0),
('quantrotrangian', '$2y$10$Zzsp7KHZB88s57L4FUhLnOdP5Tl8BJSWej1WMriPj6lyu3p5VtS4m', 'congidauem@yahoo.com', 'Sống ở đời', 'normal', 0),
('taikhoanmoi', '$2y$10$DRpH.6EVr4JTxfiO/Ze8luKFhi0XI17uSKQouCpfaJEOo6qnjkK1u', 'Xxbbluexx@gmail.com', 'Douicc', 'admin', 0),
('tinhnhatphai', '$2y$10$cgFGWt/hfve7SGoPXfoGneSWln4s/ax1escDqYkQjBZ8CCgCwLAxe', 'tinhtuongtu@gmail.com', 'Chờ em chờ đến bao giờ', 'normal', 0),
('tuongtunangcasi', '$2y$10$oSET2lRMlVMK1AcxMRVxa.3h8HpBmwELAHTDECtI2fBLfhIXjvXa6', 'tuongtu@gmail.com', 'Quang Lê', 'normal', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`taikhoan`,`masp`),
  ADD KEY `masp` (`masp`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diachi`
--
ALTER TABLE `diachi`
  ADD PRIMARY KEY (`id`,`taikhoan`),
  ADD KEY `taikhoan` (`taikhoan`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tentaikhoan` (`tentaikhoan`),
  ADD KEY `id_dc` (`id_dc`,`tentaikhoan`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `MaSP` (`MaSP`) USING BTREE,
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `sl_sp_dh`
--
ALTER TABLE `sl_sp_dh`
  ADD PRIMARY KEY (`id_dh`,`id_sp`),
  ADD KEY `id_sp` (`id_sp`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `diachi`
--
ALTER TABLE `diachi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`MaSP`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`taikhoan`) REFERENCES `users` (`username`);

--
-- Constraints for table `diachi`
--
ALTER TABLE `diachi`
  ADD CONSTRAINT `diachi_ibfk_1` FOREIGN KEY (`taikhoan`) REFERENCES `users` (`username`);

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`tentaikhoan`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `donhang_ibfk_2` FOREIGN KEY (`id_dc`,`tentaikhoan`) REFERENCES `diachi` (`id`, `taikhoan`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
