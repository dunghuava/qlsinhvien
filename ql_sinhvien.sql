-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2020 at 05:25 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ql_sinhvien`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_hedaotao`
--

CREATE TABLE `db_hedaotao` (
  `id` int(11) NOT NULL,
  `ma_he` varchar(50) NOT NULL,
  `ten_he` varchar(255) NOT NULL,
  `ngay_tao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_hedaotao`
--

INSERT INTO `db_hedaotao` (`id`, `ma_he`, `ten_he`, `ngay_tao`) VALUES
(1, 'H6492', 'Trung Cấp', '13-09-2020 21:44'),
(2, 'H1312', 'Cao Đẳng', '15-09-2020 21:48'),
(3, 'H7686', 'Đại Học', '13-09-2020 21:45'),
(4, 'H2304', 'Sau Đại Học', '13-09-2020 21:45'),
(5, 'H44269d9d', 'Cao Cấp', '15-09-2020 21:44');

-- --------------------------------------------------------

--
-- Table structure for table `db_khoa`
--

CREATE TABLE `db_khoa` (
  `id` int(11) NOT NULL,
  `ma_khoa` varchar(50) NOT NULL,
  `ten_khoa` varchar(255) NOT NULL,
  `ngay_tao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_khoa`
--

INSERT INTO `db_khoa` (`id`, `ma_khoa`, `ten_khoa`, `ngay_tao`) VALUES
(2, 'KHTN & CN', 'Khoa Học Tự Nhiên & CN', '13-09-2020 22:04'),
(5, 'KNL', 'Khoa Nông Lâm', '13-09-2020 22:04'),
(6, 'KSP', 'Khoa Sư Phạm', '13-09-2020 22:05'),
(7, 'KYD', 'Khoa Y Dược', '13-09-2020 22:05');

-- --------------------------------------------------------

--
-- Table structure for table `db_khoahoc`
--

CREATE TABLE `db_khoahoc` (
  `id` int(11) NOT NULL,
  `ma_khoahoc` varchar(50) NOT NULL,
  `ten_khoahoc` varchar(50) NOT NULL,
  `ngay_tao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_khoahoc`
--

INSERT INTO `db_khoahoc` (`id`, `ma_khoahoc`, `ten_khoahoc`, `ngay_tao`) VALUES
(1, 'KH3578', 'Khóa 2014-2018', '13-09-2020 21:48'),
(2, 'KH9093', 'Khóa 2015-2019', '13-09-2020 21:48'),
(3, 'KH4029', 'Khóa 2016-2020', '13-09-2020 21:48'),
(4, 'KH4822', 'Khóa 2017-2021', '13-09-2020 21:49'),
(5, 'KH8454', 'Khóa 2018-2022', '13-09-2020 21:49');

-- --------------------------------------------------------

--
-- Table structure for table `db_lop`
--

CREATE TABLE `db_lop` (
  `id` int(11) NOT NULL,
  `ma_lop` varchar(50) NOT NULL,
  `ten_lop` varchar(255) NOT NULL,
  `ma_khoa` varchar(50) NOT NULL,
  `ma_khoahoc` varchar(50) NOT NULL,
  `ma_nganh` varchar(50) NOT NULL,
  `ma_he` varchar(50) NOT NULL,
  `ngay_tao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_lop`
--

INSERT INTO `db_lop` (`id`, `ma_lop`, `ten_lop`, `ma_khoa`, `ma_khoahoc`, `ma_nganh`, `ma_he`, `ngay_tao`) VALUES
(1, 'CNTTK15', 'Công Nghệ Thông Tin K15', '2', '1', '1', 'H7686', '13-09-2020 22:08'),
(2, 'YDK15', 'Y Đa Khoa K15', '7', '2', '3', 'H7686', '13-09-2020 22:10');

-- --------------------------------------------------------

--
-- Table structure for table `db_nganh`
--

CREATE TABLE `db_nganh` (
  `id` int(11) NOT NULL,
  `ma_nganh` varchar(50) NOT NULL,
  `ten_nganh` varchar(255) NOT NULL,
  `ma_khoa` varchar(50) NOT NULL,
  `ngay_tao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_nganh`
--

INSERT INTO `db_nganh` (`id`, `ma_nganh`, `ten_nganh`, `ma_khoa`, `ngay_tao`) VALUES
(1, 'D2316', 'Công Nghệ Thông Tin', '2', '13-09-2020 22:05'),
(2, 'D1931', 'Sư Phạm Vật Lý', '6', '13-09-2020 22:07'),
(3, 'D1222', 'Thú Y', '7', '13-09-2020 22:08');

-- --------------------------------------------------------

--
-- Table structure for table `db_province`
--

CREATE TABLE `db_province` (
  `province_id` int(10) UNSIGNED NOT NULL,
  `province_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_province`
--

INSERT INTO `db_province` (`province_id`, `province_name`, `province_code`) VALUES
(1, 'Hồ Chí Minh', 'SG'),
(2, 'Hà Nội', 'HN'),
(3, 'Đà Nẵng', 'DDN'),
(4, 'Bình Dương', 'BD'),
(5, 'Đồng Nai', 'DNA'),
(6, 'Khánh Hòa', 'KH'),
(7, 'Hải Phòng', 'HP'),
(8, 'Long An', 'LA'),
(9, 'Quảng Nam', 'QNA'),
(10, 'Bà Rịa Vũng Tàu', 'VT'),
(11, 'Đắk Lắk', 'DDL'),
(12, 'Cần Thơ', 'CT'),
(13, 'Bình Thuận  ', 'BTH'),
(14, 'Lâm Đồng', 'LDD'),
(15, 'Thừa Thiên Huế', 'TTH'),
(16, 'Kiên Giang', 'KG'),
(17, 'Bắc Ninh', 'BN'),
(18, 'Quảng Ninh', 'QNI'),
(19, 'Thanh Hóa', 'TH'),
(20, 'Nghệ An', 'NA'),
(21, 'Hải Dương', 'HD'),
(22, 'Gia Lai', 'GL'),
(23, 'Bình Phước', 'BP'),
(24, 'Hưng Yên', 'HY'),
(25, 'Bình Định', 'BDD'),
(26, 'Tiền Giang', 'TG'),
(27, 'Thái Bình', 'TB'),
(28, 'Bắc Giang', 'BG'),
(29, 'Hòa Bình', 'HB'),
(30, 'An Giang', 'AG'),
(31, 'Vĩnh Phúc', 'VP'),
(32, 'Tây Ninh', 'TNI'),
(33, 'Thái Nguyên', 'TN'),
(34, 'Lào Cai', 'LCA'),
(35, 'Nam Định', 'NDD'),
(36, 'Quảng Ngãi', 'QNG'),
(37, 'Bến Tre', 'BTR'),
(38, 'Đắk Nông', 'DNO'),
(39, 'Cà Mau', 'CM'),
(40, 'Vĩnh Long', 'VL'),
(41, 'Ninh Bình', 'NB'),
(42, 'Phú Thọ', 'PT'),
(43, 'Ninh Thuận', 'NT'),
(44, 'Phú Yên', 'PY'),
(45, 'Hà Nam', 'HNA'),
(46, 'Hà Tĩnh', 'HT'),
(47, 'Đồng Tháp', 'DDT'),
(48, 'Sóc Trăng', 'ST'),
(49, 'Kon Tum', 'KT'),
(50, 'Quảng Bình', 'QB'),
(51, 'Quảng Trị', 'QT'),
(52, 'Trà Vinh', 'TV'),
(53, 'Hậu Giang', 'HGI'),
(54, 'Sơn La', 'SL'),
(55, 'Bạc Liêu', 'BL'),
(56, 'Yên Bái', 'YB'),
(57, 'Tuyên Quang', 'TQ'),
(58, 'Điện Biên', 'DDB'),
(59, 'Lai Châu', 'LCH'),
(60, 'Lạng Sơn', 'LS'),
(61, 'Hà Giang', 'HG'),
(62, 'Bắc Kạn', 'BK'),
(63, 'Cao Bằng', 'CB');

-- --------------------------------------------------------

--
-- Table structure for table `db_quanly`
--

CREATE TABLE `db_quanly` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `ngay_tao` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_quanly`
--

INSERT INTO `db_quanly` (`id`, `username`, `password`, `ngay_tao`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '2020-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `db_sinhvien`
--

CREATE TABLE `db_sinhvien` (
  `id` int(11) NOT NULL,
  `ma_sv` varchar(8) NOT NULL,
  `ma_lop` varchar(50) NOT NULL,
  `ma_khoahoc` varchar(50) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `ngay_sinh` varchar(255) DEFAULT NULL,
  `dien_thoai` varchar(255) DEFAULT NULL,
  `gioi_tinh` int(1) DEFAULT 0 COMMENT '0=nam / 1=nu',
  `noi_sinh` varchar(255) DEFAULT NULL,
  `hoten_cha` varchar(255) DEFAULT NULL,
  `hoten_me` varchar(255) DEFAULT NULL,
  `que_quan` varchar(255) DEFAULT NULL,
  `dan_toc` varchar(255) DEFAULT NULL,
  `ton_giao` varchar(255) DEFAULT NULL,
  `ngay_tao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_sinhvien`
--

INSERT INTO `db_sinhvien` (`id`, `ma_sv`, `ma_lop`, `ma_khoahoc`, `ho_ten`, `ngay_sinh`, `dien_thoai`, `gioi_tinh`, `noi_sinh`, `hoten_cha`, `hoten_me`, `que_quan`, `dan_toc`, `ton_giao`, `ngay_tao`) VALUES
(3, '14103012', '1', '2', 'Dũng', '2020-09-23', '0383868204', 0, 'Nghệ An', 'Cha', 'Me', 'Cần Thơ', 'Nung', 'Khong', '14-09-2020 22:09'),
(4, '15103012', '1', '3', 'Minh Đính', '2020-09-30', '049499494', 0, 'Kiên Giang', 'NULL', '', 'Bà Rịa Vũng Tàu', 'K', 'NULL', '14-09-2020 22:09'),
(5, '14103011', '2', '2', 'Dũng Văn Hứa', '2020-09-23', '92929292', 0, 'Thừa Thiên Huế', '', '', 'Hải Phòng', '', '', '15-09-2020 21:52');

-- --------------------------------------------------------

--
-- Table structure for table `db_sinhvien_vitri`
--

CREATE TABLE `db_sinhvien_vitri` (
  `id` int(11) NOT NULL,
  `sinhvien_id` int(11) NOT NULL COMMENT 'liên kết với id trong bảng db_sinhvien',
  `ma_sv` int(10) DEFAULT NULL,
  `ma_lop` int(10) DEFAULT NULL,
  `dia_chi` varchar(500) DEFAULT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT 0 COMMENT '0=chưa duyệt/1=đã duyệt',
  `_lat` varchar(100) DEFAULT NULL COMMENT 'kinh độ',
  `_lng` varchar(100) DEFAULT NULL COMMENT 'vĩ độ',
  `ngay_tao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_sinhvien_vitri`
--

INSERT INTO `db_sinhvien_vitri` (`id`, `sinhvien_id`, `ma_sv`, `ma_lop`, `dia_chi`, `trang_thai`, `_lat`, `_lng`, `ngay_tao`) VALUES
(2, 3, 14103012, 1, '', 0, '10.6952642', '106.704874', '20-09-2020 16:21'),
(3, 4, 15103012, 1, NULL, 1, '12.6661944', '108.0382475', '14-09-2020 22:09'),
(4, 5, 14103011, 2, '12/7 Đường Trần Não, An Phu, District 2, Ho Chi Minh City, Vietnam', 1, '10.7986848', '106.7329098', '15-09-2020 21:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_hedaotao`
--
ALTER TABLE `db_hedaotao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ma_he` (`ma_he`);

--
-- Indexes for table `db_khoa`
--
ALTER TABLE `db_khoa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_khoa` (`ma_khoa`);

--
-- Indexes for table `db_khoahoc`
--
ALTER TABLE `db_khoahoc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_khoahoc` (`ma_khoahoc`);

--
-- Indexes for table `db_lop`
--
ALTER TABLE `db_lop`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_lop` (`ma_lop`),
  ADD KEY `ma_khoa` (`ma_khoa`),
  ADD KEY `ma_he` (`ma_he`),
  ADD KEY `ma_khoahoc` (`ma_khoahoc`),
  ADD KEY `ma_nganh` (`ma_nganh`);

--
-- Indexes for table `db_nganh`
--
ALTER TABLE `db_nganh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ma_khoa` (`ma_khoa`),
  ADD KEY `ma_nganh` (`ma_nganh`);

--
-- Indexes for table `db_province`
--
ALTER TABLE `db_province`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `db_quanly`
--
ALTER TABLE `db_quanly`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_sinhvien`
--
ALTER TABLE `db_sinhvien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_sv` (`ma_sv`),
  ADD KEY `ma_lop` (`ma_lop`),
  ADD KEY `ma_khoahoc` (`ma_khoahoc`);

--
-- Indexes for table `db_sinhvien_vitri`
--
ALTER TABLE `db_sinhvien_vitri`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_hedaotao`
--
ALTER TABLE `db_hedaotao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `db_khoa`
--
ALTER TABLE `db_khoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `db_khoahoc`
--
ALTER TABLE `db_khoahoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `db_lop`
--
ALTER TABLE `db_lop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `db_nganh`
--
ALTER TABLE `db_nganh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `db_province`
--
ALTER TABLE `db_province`
  MODIFY `province_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `db_quanly`
--
ALTER TABLE `db_quanly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `db_sinhvien`
--
ALTER TABLE `db_sinhvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `db_sinhvien_vitri`
--
ALTER TABLE `db_sinhvien_vitri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
