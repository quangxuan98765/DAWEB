-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2023 at 05:57 PM
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
('newnewaccount', 'dndaksj', 1);

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
(10, 'cc1', '12', 'sadasd', 123),
(12, 'newnewaccount', 'Ha Noi', 'Tungttt', 4587);

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
(24, 'account', '2023-05-05', 'on', 4, 'waiting', 98809),
(27, 'newnewaccount', '2023-05-08', 'on', 12, 'waiting', 345353),
(30, 'newnewaccount', '2023-05-08', 'COD', 12, 'waiting', 23423423);

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
  `more_img1` text NOT NULL,
  `more_img2` text NOT NULL,
  `category_id` int(200) NOT NULL,
  `brand_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `MaSP`, `TenSP`, `HinhSP`, `MoTaSP`, `GiaSP`, `product_sell`, `more_img`, `more_img1`, `more_img2`, `category_id`, `brand_id`) VALUES
(2, 'dnakssj', 'Laptop msi 1', ' ', ' ', 20000, 'Hàng mới', ' ', '', '', 1, 2),
(3, 'dndaksj', 'Laptop acer 1', ' ', ' ', 20000, 'Hàng mới', ' ', '', '', 1, 1),
(4, 'dnưaksj', 'sạc AUS 1', ' ', ' ', 20000, 'Hàng mới', ' ', '', '', 2, 4),
(5, 'lỏ vừa thôi', 'Laptop msi 1', '../ProjectWeb/img/product/huawei1.jpg', ' lo cccc', 1312312, 'Hàng mới', '../ProjectWeb/img/product/hp2.jpg', '../ProjectWeb/img/product/dell1.jpg', '../ProjectWeb/img/product/asus2.jpg', 1, 4),
(6, 'dnak1sj', 'sạc lenovo 3', ' ', ' ', 20000, 'Hàng mới', ' ', '', '', 2, 4),
(7, 'dnakđâssj', 'sạc lenovo 4', ' ', ' ', 20000, 'Hàng mới', ' ', '', '', 2, 4),
(8, 'dnadaksj', 'sạc lenovo 5', ' ', ' ', 20000, 'Hàng mới', ' ', '', '', 2, 4),
(9, 'dnakczxsj', 'sạc lenovo 6', ' ', ' ', 20000, 'Hàng mới', ' ', '', '', 2, 4),
(10, 'dnazcxáksj', 'sạc lenovo 7', ' ', ' ', 20000, 'Hàng mới', ' ', '', '', 2, 4),
(11, 'dnak12esj', 'sạc lenovo 8', ' ', ' ', 20000, 'Hàng mới', ' ', '', '', 2, 4),
(12, 'dnakeesj', 'sạc lenovo 9', ' ', ' ', 20000, 'Hàng mới', ' ', '', '', 2, 4),
(13, 'dnaaksj', 'sạc lenovo 10', ' ', ' ', 20000, 'Hàng mới', ' ', '', '', 2, 4),
(15, 'LNV12', 'LENOVO S1', ' ', ' ', 20000, 'Mới', ' ', '', '', 1, 4),
(21, 'DHB', 'Dell 3', '../ProjectWeb/img/product/dell1.jpg', 'asdasddas', 50000000, '', '../ProjectWeb/img/product/dell2.png', '../ProjectWeb/img/product/dell 3.jpg', '../ProjectWeb/img/product/Screenshot (229).png', 1, 5);

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
(27, 2, 1),
(27, 3, 1),
(30, 2, 1),
(30, 3, 1),
(30, 5, 1);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
