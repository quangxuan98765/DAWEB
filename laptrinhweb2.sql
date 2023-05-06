-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 04:44 PM
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

--
-- Dumping data for table `diachi`
--

INSERT INTO `diachi` (`id`, `taikhoan`, `city`, `tenduong`, `sonha`) VALUES
(1, 'account', 'asdds', 'sadads', 123),
(3, 'account', 'HCM', 'asdsad', 231132),
(4, 'account', 'HCM', 'TEnduong', 123),
(5, 'account', 'HCM', 'TEnduong', 123),
(8, 'account', 'asdds', 'sadads', 123),
(9, 'account', '', '', 0),
(10, 'cc1', '12', 'sadasd', 123);

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
(21, 'account', '2023-05-05', 'on', 4, 'waiting', 923123),
(22, 'account', '2023-05-05', 'on', 3, 'waiting', 23123123),
(23, 'account', '2023-05-05', 'on', 3, 'waiting', 23123123),
(24, 'account', '2023-05-05', 'on', 4, 'waiting', 98809);

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
  `category_id` int(200) NOT NULL,
  `brand_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

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
