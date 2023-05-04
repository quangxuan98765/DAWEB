-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2023 at 06:52 AM
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
('account', 'IbS893', 1),
('account', 'POH823', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `slug`) VALUES
(1, 'apple', 'laptop'),
(2, 'acer', 'laptop'),
(3, 'asus', 'laptop'),
(4, 'dell', 'laptop'),
(5, 'hp', 'laptop'),
(6, 'lenovo', 'laptop');

-- --------------------------------------------------------

--
-- Table structure for table `diachi`
--

CREATE TABLE `diachi` (
  `id` int(10) NOT NULL,
  `taikhoan` varchar(50) NOT NULL,
  `city` text NOT NULL,
  `tenduong` text NOT NULL,
  `sonha` int(255) NOT NULL
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
  `trangthai` varchar(100) NOT NULL
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
  `product_sell` varchar(100) NOT NULL,
  `more_img` text NOT NULL,
  `category_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `MaSP`, `TenSP`, `HinhSP`, `MoTaSP`, `GiaSP`, `product_sell`, `more_img`, `category_id`) VALUES
(4, 'POH823', 'Dell 3', '../ProjectWeb/img/product/dell 3.jpg', 'Dell lỏ', 20000000, 'hàng bán chạy', '', 4),
(5, 'IbS893', 'Lenovo 1', '../ProjectWeb/img/product/lenovo1.jpg', 'Lenovo lỏ', 23000000, 'hàng bán chạy', '', 6),
(6, 'gKD782', 'HP 2', '../ProjectWeb/img/product/hp2.jpg', 'HP lỏ', 23000000, 'hàng bán chạy', '', 5),
(15, 'ASD', 'Acer 1', '../ProjectWeb/img/product/acer1.jpg', 'Acer lỏ', 17000000, 'hàng mới', '', 2),
(16, 'DHB', 'Asus 1', '../ProjectWeb/img/product/asus1.jpg', 'Asus lỏ', 18000000, 'hàng mới', '', 3);

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
(1, 16, 7),
(12, 4, 9),
(12, 5, 19),
(12, 6, 39),
(12, 16, 5),
(13, 4, 9),
(13, 5, 7),
(13, 6, 9),
(13, 16, 7),
(14, 4, 9),
(14, 5, 7),
(14, 6, 9),
(15, 4, 9),
(15, 5, 7),
(15, 6, 9),
(16, 4, 9),
(16, 5, 19),
(17, 6, 39),
(18, 4, 9),
(18, 5, 19),
(19, 4, 9),
(19, 6, 39),
(20, 5, 19),
(20, 6, 39);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `fullname`, `role`) VALUES
('account', '123456789', '123boyzzkwdadasadw1313hoi@gmail.com', 'asdasd', 'admin'),
('cc1', 'adminbaso9', 'Xxbblu333exx@gmail.com', 'asasds', 'normal'),
('ccc1', 'adminbaso9', 'Xxbb13lu333esxx@gmail.com', 'asasd', 'normal'),
('ccc2', 'adminbaso9', 'Xxbbaslue3xx@31gmail.com', 'asasd', 'normal'),
('clm1', 'adminbaso9', 'Xxbblu333exx@gmails.com', 'asasd', 'normal'),
('cocaic2', 'adminbaso9', 'Xxbbluexx@31gmaial.com', 'asasd', 'normal'),
('newaccount', '123456789', '123boyzzk1313hoi@gmail.com', 'asdasd', 'adminsss'),
('newnewaccount', '123456789', '1a23boyzzk1313hoi@gmail.com', 'asdasd', 'admin'),
('taikhoanmoi', 'adminbaso9', 'Xxbb3luexx@g321mail.com', 'asasd', 'normal'),
('taikhoanmsssoi', 'adminbaso9', 'Xxdasdadabb3luexx@g321mail.com', 'asasd', 'normal'),
('taikhoanncc', 'adminbaso9', 'Xxbb3luessaxx@g321mail.com', 'asasd', 'normal'),
('tk122', '123456789', '1das23boyzz123khoi@gma4il.com', 'asdasd', 'admin'),
('tk1313', '123456789', '123boyzz123khoi@gmsa4il.com', 'asdasd', 'admin'),
('tk2', '123456789', '123boyzz123khoi@gma4il.com', 'asdasd', 'admin'),
('tk23', '123456789', '123boyz222zkhoi@gmail.com', 'asdsssssaadsada', 'adminss'),
('tk2399', '123456789', '123boyz222zkhoi@gmadil.com', 'asdasd', 'admin'),
('tk323', '123456789', '12123boyz222zkhoi@gmail.com', 'asdasd', 'admin'),
('tk423', '123456789', '123boyz22ssss2zkhoi@gmail.com', 'asdasd', 'admin');

--
-- Indexes for dumped tables
--

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
  ADD KEY `category_id` (`category_id`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `diachi`
--
ALTER TABLE `diachi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `sl_sp_dh`
--
ALTER TABLE `sl_sp_dh`
  ADD CONSTRAINT `sl_sp_dh_ibfk_1` FOREIGN KEY (`id_dh`) REFERENCES `donhang` (`id`),
  ADD CONSTRAINT `sl_sp_dh_ibfk_2` FOREIGN KEY (`id_sp`) REFERENCES `sanpham` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
