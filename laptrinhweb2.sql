-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 12:00 PM
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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`taikhoan`, `masp`, `soluong`) VALUES
('newaccount', 'FISD28934', 5),
('nextmoonqueen', 'ASUF8892', 1);

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

--
-- Dumping data for table `diachi`
--

INSERT INTO `diachi` (`id`, `taikhoan`, `city`, `tenduong`, `sonha`) VALUES
(17, 'nextmoonqueen', 'Lào Cai', 'Hồ Con Rùa', '675/AD'),
(18, 'tinhnhatphai', 'Hà Nội', 'Trần Duy Hưng', '675/XNXX'),
(20, 'newaccount', 'Hà Nội', 'Hồ Con Rùa', '675/AD'),
(22, 'haihau12', 'Lào Cai', 'Trần Duy Hưng', '123/AD'),
(24, 'haihau41', 'Lào Cai', 'Ho xuan Huong', '457/mk'),
(25, 'quang', 'Lào Cai', 'Hồ Con Rùa', '675/AD');

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

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`id`, `tentaikhoan`, `date`, `payment`, `id_dc`, `trangthai`, `sdt`) VALUES
(38, 'newaccount', '2023-05-19', 'Online', 20, 'cancelled', 9087164),
(39, 'newaccount', '2023-05-19', 'COD', 20, 'cancelled', 9087164),
(40, 'nextmoonqueen', '2023-05-19', 'Online', 17, 'confirmed', 986689),
(41, 'nextmoonqueen', '2023-05-19', 'COD', 17, 'confirmed', 986689),
(45, 'haihau12', '2023-05-20', 'COD', 22, 'confirmed', 9087164),
(49, 'haihau41', '2023-05-20', 'Online', 24, 'confirmed', 9087164),
(50, 'haihau41', '2023-05-20', 'COD', 24, 'confirmed', 9087164),
(51, 'haihau41', '2023-05-20', 'COD', 24, 'cancelled', 9087164),
(54, 'quang', '2024-11-12', 'COD', 25, 'confirmed', 908723456),
(56, 'quang', '2024-11-16', 'COD', 25, 'cancelled', 9087164);

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
(23, 'FEASF23', 'Bàn phím asus', 'img/product/product-38.png', 'Đa dạng các cổng kết nối', 250, 'img/product/banphim13.png', 'img/product/product-22.png', 'img/product/product-40.png', 2, 3),
(24, 'ASUF8892', 'Acer Nitro Gaming 5 ', 'img/product/acer2.png', 'thiết kế sang trọng và thanh lịch', 1400, 'img/product/acer21.png', 'img/product/acer22.png', 'img/product/acer23.png', 1, 1),
(26, 'FISD28934', 'Acer TUF Gaming', 'img/product/asus21.png', 'Thiết kế mạnh mẽ, phong cách Gaming', 950, 'img/product/acer12.png', 'img/product/acer2.png', 'img/product/acer1.jpg', 1, 1),
(27, '82K101H', 'Lenovo Gaming IdeaPad 3', 'img/product/lenovo1.png', 'Ổ cứng SSD 512GB khởi động máy nhanh chóng', 1200, 'img/product/lenovo11.png', 'img/product/lenovo12.png', 'img/product/lenovo13.png', 1, 4),
(28, 'GIDsu781', 'Lenovo IdeaPad', 'img/product/lenovo1.jpg', 'Hiệu năng ổn định, ấn tượng', 650, 'img/product/huawei2.jpg', 'img/product/huawei1.jpg', 'img/product/hp2.jpg', 1, 4),
(29, 'P112F002BBL', 'Dell Vostro', 'img/product/dell2.png', 'Card rời NVIDIA GeForce RTX 3050 đồ họa mượt mà', 1450, 'img/product/dell21.png', 'img/product/dell22.png', 'img/product/dell23.png', 1, 5),
(30, 'B7M098VN', 'Asus Modern', 'img/product/asus1.png', 'Màn hình 144Hz viền mỏng hiển thị hình ảnh chân thật', 1500, 'img/product/asus11.png', 'img/product/asus12.png', 'img/product/asus13.png', 1, 3),
(31, 'eg2083TU', 'Dell Pavilion', 'img/product/dell1.png', 'Công nghệ DTS:X Ultra Audio cho trải nghiệm âm thanh lớn', 1100, 'img/product/dell11.png', 'img/product/dell12.png', 'img/product/dell13.png', 1, 5),
(32, 'AOVUSF234', 'MSI Modern', 'img/product/MSI1.png', 'Trang bị bàn phím chuyển màu RGB độc đáo', 900, 'img/product/MSI11.png', 'img/product/MSi12.png', 'img/product/MSI13.png', 1, 2),
(34, '82H803VN', 'Lenovo Thinkpad', 'img/product/product-16.png', 'Thiết kế trang nhã, hiện đại', 1150, 'img/product/product-17.png', 'img/product/product-18.png', 'img/product/hp3.jpg', 1, 4),
(35, 'L1026W', 'MSI Vivobook', 'img/product/product-14.png', 'Chip AMD Ryzen™ 5-3500U giúp bạn xử lý tốt công việc', 2320, 'img/product/product-4.png', 'img/product/product-5.png', 'img/product/product-15.png', 1, 2),
(36, 'A3155854M5', 'MSI Aspire 3', 'img/product/MSI2.png', 'RAM 8GB chuẩn DDR4 cho phép máy chạy mượt nhiều Tab', 1050, 'img/product/MSI21.png', 'img/product/MSI22.png', 'img/product/MSI23.png', 1, 2),
(37, 'UIGAG823', 'Lenovo Thinhpad 5', 'img/product/lenovo2.png', 'Card NVIDIA GeForce RTX 3050Ti tăng cường sức mạnh', 2800, 'img/product/lenovo21.png', 'img/product/lenovo22.png', 'img/product/lenovo23.png', 1, 4),
(38, 'OHHAW28934', 'Asus Vitus', 'img/product/product-7.png', 'Làm việc tốt, chơi game mượt', 1200, 'img/product/product-11.png', 'img/product/product-9.png', 'img/product/product-12.png', 1, 3),
(39, 'SOHF9234', 'Bàn phím Dell', 'img/product/banphim22.png', 'Bộ bàn phím và chuột MK235 kết nối không dây tiện lợi', 450, 'img/product/banphim23.png', 'img/product/banphim21.png', 'img/product/banphim12.png', 2, 5),
(40, 'FAHAf9234', 'Màn hình Dell', 'img/product/manhinh1.png', 'Thời gian phản hồi 5ms cho hình ảnh chuyển động mượt mà', 500, 'img/product/manhinh11.png', 'img/product/manhinh12.png', 'img/product/manhinh13.png', 2, 5),
(41, 'FSGU34872', 'Loa Acer', 'img/product/loa2.png', 'Thiết kế nhỏ gọn, tiện mang theo và nghe nhạc mọi lúc', 300, 'img/product/loa21.png', 'img/product/loa22.png', 'img/product/loa23.png', 2, 1),
(43, 'AUIW28934', 'Màn hình Dell', 'img/product/manhinh2.png', 'Trải nghiệm hình ảnh rõ nét với độ phân giải Full HD', 800, 'img/product/manhinh21.png', 'img/product/manhinh22.png', 'img/product/manhinh23.png', 2, 5),
(44, 'AIEUr2374', '', 'img/product/ocung1.png', 'Tốc độ truyền tải nhanh, giao diện kết nối USB 3.2 Gen 2', 250, 'img/product/ocung11.png', 'img/product/ocung12.png', 'img/product/ocung13.png', 2, 1),
(45, 'oU798234', 'Tai nghe MSI', 'img/product/tainghe2.png', 'Thiết kế nhỏ gọn, tiện mang theo và nghe nhạc mọi lúc', 350, 'img/product/tainghe21.png', 'img/product/tainghe22.png', 'img/product/tainghe23.png', 2, 2),
(46, 'AUIdh8734', 'Tai nghe MSI', 'img/product/tainghe1.png', 'Tai có lớp đệm êm, bọc da cao cấp, tạo cảm giác thoải mái', 350, 'img/product/tainghe11.png', 'img/product/tainghe12.png', 'img/product/tainghe13.png', 2, 2),
(47, 'AIUd8724', 'Ổ cứng Dell', 'img/product/ocung21.png', 'Ổ cứng SSD 512GB giúp khởi động máy nhanh chóng', 200, 'img/product/ocung2.png', 'img/product/ocung22.png', 'img/product/ocung23.png', 2, 5),
(48, 'SA93234F', 'Bàn phím Asus', 'img/product/product-26.png', 'Bàn phím được thiết kế đơn giản, phím bấm với độ nổi thấp', 600, 'img/product/product-27.png', 'img/product/product-25.png', 'img/product/product-37.png', 2, 3),
(49, 'PGSUEG234', 'Acer Spire 5', 'img/product/acer1.jpg', 'Laptop có kích thước 14\" độ phân giải Full HD', 1950, 'img/product/asus2.jpg', 'img/product/asus13.png', 'img/product/dell1.jpg', 1, 1),
(59, 'SBFSHD2387', 'Nếu là em', 'img/product/acer1.png', 'kocodau', 500, 'img/product/acer11.png', 'img/product/acer12.png', 'img/product/acer13.png', 1, 1),
(60, 'SBFSHhyt', 'Lenovo', 'img/product/acer1.png', 'hjada', 8789, 'img/product/acer22.png', 'img/product/acer13.png', 'img/product/acer11.png', 1, 2),
(61, 'dyttydsdfs', 'Nếu là em', 'img/product/acer13.png', 'kocodau', 679, 'img/product/acer22.png', 'img/product/acer1.png', 'img/product/acer1.jpg', 1, 2);

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
(24, 16, 4),
(32, 22, 1),
(32, 39, 1),
(33, 31, 1),
(33, 36, 1),
(33, 51, 1),
(36, 59, 1),
(37, 39, 1),
(37, 59, 1),
(38, 24, 4),
(38, 26, 2),
(38, 27, 6),
(38, 35, 1),
(38, 40, 3),
(39, 39, 1),
(39, 41, 1),
(40, 32, 1),
(40, 40, 2),
(41, 24, 1),
(41, 26, 4),
(41, 39, 3),
(42, 22, 2),
(42, 24, 2),
(42, 31, 2),
(42, 39, 2),
(43, 29, 1),
(43, 31, 2),
(43, 34, 1),
(43, 39, 1),
(45, 26, 1),
(45, 30, 2),
(47, 26, 1),
(47, 30, 1),
(49, 24, 1),
(49, 30, 2),
(49, 38, 1),
(50, 24, 2),
(50, 49, 2),
(51, 39, 1),
(54, 24, 1),
(56, 26, 1);

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
('anhtai123', '$2y$10$lQZm1kqO6TKg.CgaRGASdud0xJDflvklsQUujE3sll9sW.mixPdFW', 'tkrac@gmail.com', 'Nam', 'normal', 1),
('haihau12', '$2a$10$C.5Dh.9oxFobOsXb7dgm8eaT3EF/vtTXD.09LdMOv/MN44etvVGye', 'hauss@gmail.com', 'Hau lo ngu', 'normal', 0),
('haihau41', '$2a$10$Sbu1tQ5kNiHOIubXJuuccOxfL2fzaglXfccqKYkc5pbbT9ek9nXei', 'haungudo@gmail.com', 'haulovai', 'normal', 1),
('hoanganh', '$2a$10$QYKlL7X4iROfhhQ6iZIP2O4NvgGEhV6qEViArjJk24fnnUdvr9.MG', 'mathewHanh@gmail.com', 'baodoi', 'admin', 0),
('hoanganh12', '$2a$10$wHsjVz0QUFSPtESQY/5UXObSrBJuadTNanbp3u.9w9qQuUjCv17bK', 'kaasgdaksd@gmail.com', 'hoangso1', 'admin', 0),
('kodamdauemconphaihocbai', '$2y$10$4BlCa2ILfMmh4N6T5pFzzu16qqSegD/GJiqRM8UQWqEgXD4JNEWcm', 'mathew@gmail.com', 'Lê Thị Mộng Thường', 'normal', 0),
('newaccount', '$2y$10$02KmdlDsZaMP.a399eQbjO2qYQ6hD9YJKUHED73A7o6bCiBwJHUJe', '123boyzzkhoi@gmail.com', 'TaochuAi', 'admin', 0),
('nextmoonqueen', '$2y$10$SRCCtDQaWPJ8njyP92Gh6OezuA7u9rzY7/Amw1t8jmdgxnyC0TSx2', 'yidepe9903@inkmoto.com', 'Ranni', 'normal', 0),
('quang', '$2y$10$bU0hUO1rZoiMlAOkBBhsZu4/vrMB/6kFM4LS5w0JWFpVzERT4l7/6', 'abc@gmail.com', 'Quang', 'admin', 0),
('quangclone', '$2y$10$3T07JBj/Fe27vA3Xyc3TmOhuI9sKpY06Z5hyAuH6cNqxPi8BS6xGO', 'ractk@gmail.com', 'Genshin', 'normal', 0),
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

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
