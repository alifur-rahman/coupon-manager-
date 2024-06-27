-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2021 at 11:09 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fiverr_maxpapa`
--

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `ID` int(255) NOT NULL,
  `coupon_key` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `secondary_color` varchar(255) DEFAULT NULL,
  `text_color` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `terms` text,
  `logo` varchar(255) DEFAULT NULL,
  `expires` varchar(255) DEFAULT NULL,
  `promo` varchar(255) DEFAULT NULL,
  `promoCode` varchar(255) DEFAULT NULL,
  `bg_type` varchar(255) NOT NULL,
  `bg_img` varchar(255) DEFAULT NULL,
  `fonts` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`ID`, `coupon_key`, `color`, `secondary_color`, `text_color`, `title`, `description`, `name`, `terms`, `logo`, `expires`, `promo`, `promoCode`, `bg_type`, `bg_img`, `fonts`) VALUES
(1, 'a44f7e49630a7882affa', '#d50101', '#d50101', '#ffffff', 'SAVE 50%', 'on your next purchase', 'WAQAS AHMED', 'Integer sit amet risus lacus. Quisque quis orci nec dui tincidunt vehicula', 'http://localhost/projects/projects/fiverr/maxpapa/uploads/1615365803_kfc.png', '', 'promo', '', '', NULL, ''),
(2, 'e1e24276ecb0e4932653', '#d50101', '#d50101', '#ffffff', 'SAVE 50%', 'on your next purchase', 'WAQAS AHMED', 'Integer sit amet risus lacus. Quisque quis orci nec dui tincidunt vehicula', 'http://localhost/projects/projects/fiverr/maxpapa/uploads/1615366276_mcdonalds-logo-1.jpg', '', 'qrcode', 'https://chart.googleapis.com/chart?chl=http://localhost/projects/projects/fiverr/maxpapa/view.php?id=e1e24276ecb0e4932653&chs=200x200&cht=qr', '', NULL, ''),
(3, '143ce5acbc73451fe6fa', '#d50101', '#d50101', '#ffffff', 'SAVE 50%', 'on your next purchase', 'WAQAS AHMED', 'Integer sit amet risus lacus. Quisque quis orci nec dui tincidunt vehicula', 'http://localhost/projects/projects/fiverr/maxpapa/uploads/1615366311_mcdonalds-logo-1.jpg', '', 'barcode', 'https://mobiledemand-barcode.azurewebsites.net/barcode/image?content=43434342&size=100&symbology=CODE_39&format=png&text=true', '', NULL, ''),
(4, '565f999d390e0a15a717', '#ef41fb', '#750000', '#dbdbdb', 'SAVE 50%', 'on your next purchase', 'Demo Coupon', 'Terms &amp; Conditions', 'http://localhost/projects/projects/fiverr/maxpapa/uploads/1615367926_mcdonalds-logo-1.jpg', '', 'promo', '', '', NULL, ''),
(5, '17b054183e58a38b03f8', '#06ac46', '#fa0f0f', '#ffffff', 'SAVE 50%', 'on your next purchase', 'Demo Coupon', 'Terms &amp; Conditions', 'http://localhost/projects/maxpapa/uploads/1615623398_Shakers-2019-Logo-ICON.png', '', 'qrcode', 'https://chart.googleapis.com/chart?chl=http://localhost/projects/maxpapa/view.php?id=17b054183e58a38b03f8&chs=300x300&cht=qr', 'color', 'http://localhost/projects/maxpapa/', 'Caudex'),
(7, 'a7ea967a7e92a3080a54', '#ffffff', '#ffffff', '#ffffff', 'SAVE 50%', 'on your next purchase', 'Demo Coupon', 'Terms &amp; Conditions', 'http://localhost/projects/maxpapa/uploads/1615623529_Shakers-2019-Logo-ICON.png', '', 'qrcode', 'https://chart.googleapis.com/chart?chl=http://localhost/projects/maxpapa/view.php?id=a7ea967a7e92a3080a54&chs=300x300&cht=qr', 'image', 'http://localhost/projects/maxpapa/uploads/1615623529_PUBG-mobile-1.jpg', 'Cherry+Cream+Soda');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `ID` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `secondary_color` varchar(255) DEFAULT NULL,
  `text_color` varchar(255) NOT NULL,
  `bg_img` varchar(255) DEFAULT NULL,
  `fonts` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`ID`, `type`, `color`, `secondary_color`, `text_color`, `bg_img`, `fonts`) VALUES
(1, 'image', '#ffffff', '#ffffff', '#ffffff', 'uploads/1615618235_pHngiNMo5GrQUq4QuagerU.jpg', ''),
(2, 'image', '#ffffff', '#ffffff', '#000000', 'uploads/1615618242_pHngiNMo5GrQUq4QuagerU.jpg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `coupon_key` (`coupon_key`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
