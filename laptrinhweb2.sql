-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2023 at 05:50 PM
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
  `id` int(10) NOT NULL,
  `masp` varchar(255) NOT NULL,
  `tensp` varchar(200) NOT NULL,
  `hinhsp` text NOT NULL,
  `motasp` varchar(255) NOT NULL,
  `giasp` int(100) NOT NULL,
  `soluong` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `masp`, `tensp`, `hinhsp`, `motasp`, `giasp`, `soluong`) VALUES
(1, 'HGa387', 'Dell 1', '../ProjectWeb/img/product/dell1.jpg', '', 19000000, 1),
(2, 'ABC564', 'Acer 1', '../ProjectWeb/img/product/acer1.jpg', '', 17000000, 2),
(3, 'VdU832', 'Asus 1', '../ProjectWeb/img/product/asus1.jpg', '', 18000000, 1),
(5, 'IbS893', 'Lenovo 1', '../ProjectWeb/img/product/lenovo1.jpg', '', 23000000, 1),
(7, 'gKD782', 'HP 2', '../ProjectWeb/img/product/hp2.jpg', '', 23000000, 1);

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
(1, 'ABC564', 'Acer 1', '../ProjectWeb/img/product/acer1.jpg', 'acer lỏ', 17000000, 'hàng mới', '../ProjectWeb/img/product/asus1.jpg', 2),
(2, 'VdU832', 'Asus 1', '../ProjectWeb/img/product/asus1.jpg', 'Asus lỏ', 18000000, 'hàng mới', '', 3),
(3, 'HGa387', 'Dell 1', '../ProjectWeb/img/product/dell1.jpg', 'Dell lỏ', 19000000, 'hàng mới', '', 4),
(4, 'POH823', 'Dell 3', '../ProjectWeb/img/product/dell 3.jpg', 'Dell lỏ', 20000000, 'hàng bán chạy', '', 4),
(5, 'IbS893', 'Lenovo 1', '../ProjectWeb/img/product/lenovo1.jpg', 'Lenovo lỏ', 23000000, 'hàng bán chạy', '', 6),
(6, 'gKD782', 'HP 2', '../ProjectWeb/img/product/hp2.jpg', 'HP lỏ', 23000000, 'hàng bán chạy', '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `fullname`) VALUES
('newaccount', '123456789', 'Xxbbluexx@gmail.com', 'noncaihen'),
('taikhoanmoi', 'adminbaso9', '123boyzzkhoi@gmail.com', 'Vạn Xuân Quang');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_name` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_name`, `role`) VALUES
('newaccount', 'normal'),
('taikhoanmoi', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `MaSP` (`MaSP`) USING BTREE,
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user_roles` (`user_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
