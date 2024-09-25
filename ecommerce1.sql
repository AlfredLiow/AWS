-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 08:01 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `admin_type` varchar(10) NOT NULL,
  `contact` int(11) NOT NULL,
  `exp_date` varchar(250) NOT NULL,
  `reset_link_token` varchar(250) NOT NULL,
  `admin_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `admin_name`, `email`, `password`, `admin_type`, `contact`, `exp_date`, `reset_link_token`, `admin_status`) VALUES
(1, 'Admin', 'admin@gmail.com', '12345678', 'SuperAdmin', 987654321, '', '', 1),
(2, 'Alfred', '1211200875@student.mmu.edu.my', 'Li000000', 'Admin', 166624882, '', '', 1),
(4, 'Bosco', 'fongzhiliow@gmail.com', 'LiowFongZhi0406#', 'Admin', 166684228, '', '', 0),
(7, 'yi', 'lee841965@gmail.com', 'Li000000', 'Admin', 123456789, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL,
  `brand_qty` int(11) NOT NULL,
  `brand_status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`, `brand_qty`, `brand_status`) VALUES
(1, 'Acer', 11, 1),
(2, 'Dell', 20, 1),
(3, 'HP', 15, 1),
(12, 'Asus', 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `ip_add`, `user_id`, `qty`) VALUES
(6, 26, '::1', 4, 1),
(9, 10, '::1', 7, 1),
(10, 11, '::1', 7, 1),
(11, 45, '::1', 7, 1),
(44, 5, '::1', 3, 0),
(46, 2, '::1', 3, 0),
(48, 72, '::1', 3, 0),
(49, 60, '::1', 8, 1),
(50, 61, '::1', 8, 1),
(52, 5, '::1', 9, 1),
(53, 2, '::1', 14, 1),
(54, 3, '::1', 14, 1),
(55, 5, '::1', 14, 1),
(57, 2, '::1', 9, 1),
(202, 1, '', 44, 1),
(203, 3, '', 44, 1),
(204, 11, '', 44, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL,
  `cat_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_status`) VALUES
(1, 'Laptop', 1),
(2, 'Desktop', 1),
(3, 'Accessories', 1),
(49, 's', 0),
(50, 'Power', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `p_status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `qty`, `trx_id`, `created_at`, `p_status`) VALUES
(1, 12, 7, 1, '07M47684BS5725041', NULL, 1),
(2, 14, 2, 1, '07M47684BS5725041', NULL, 1),
(3, 44, 1, 1, '956319', NULL, 0),
(4, 44, 2, 1, '956319', NULL, 0),
(5, 44, 1, 1, '8736', NULL, 0),
(6, 44, 5, 1, '8736', NULL, 0),
(7, 44, 1, 1, '6405ae65a7ee1', NULL, 0),
(8, 44, 6, 1, '6405ae65a7ee1', NULL, 0),
(9, 44, 13, 1, '6405af82b1756', NULL, 0),
(10, 44, 16, 1, '6405af82b1756', NULL, 0),
(22, 44, 5, 1, '64078c7f631ba', NULL, 0),
(23, 44, 1, 1, '64196087f0386', '2023-05-16 19:02:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_info`
--

CREATE TABLE `orders_info` (
  `order_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` int(10) NOT NULL,
  `cardname` varchar(255) NOT NULL,
  `cardnumber` varchar(20) NOT NULL,
  `expdate` varchar(255) NOT NULL,
  `prod_count` int(15) DEFAULT NULL,
  `total_amt` int(15) DEFAULT NULL,
  `cvv` int(5) NOT NULL,
  `order_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_info`
--

INSERT INTO `orders_info` (`order_id`, `user_id`, `f_name`, `email`, `address`, `city`, `state`, `zip`, `cardname`, `cardnumber`, `expdate`, `prod_count`, `total_amt`, `cvv`, `order_status`) VALUES
(2, 27, 'y hy', 'y@gmail.com', 'BUKIT BERUANG', 'MALACCA', 'Malacca', 51100, 'CHin', '1565156115155454', '12/24', 2, 6698, 123, 0),
(3, 27, 'y hy', 'y@gmail.com', 'BUKIT BERUANG', 'MALACCA', 'Malacca', 51100, 'CHin', '1315165114515121', '12/24', 3, 7169, 123, 1),
(4, 27, 'y hy', 'y@gmail.com', 'BUKIT BERUANG', 'MALACCA', 'Malacca', 51100, 'CHin', '1353151515321212', '12/24', 5, 21297, 123, 0),
(5, 27, 'y hy', 'y@gmail.com', 'BUKIT BERUANG', 'MALACCA', 'malacca', 81100, 'Chin', '1213155545487878', '12/24', 3, 7289, 123, 0),
(6, 27, 'y hy', 'y@gmail.com', 'BUKIT BERUANG', 'MALACCA', 'malacca', 81100, 'Chin', '1615154548787878', '12/24', 2, 7408, 123, 0),
(7, 27, 'y hy', 'y@gmail.com', 'BUKIT BERUANG', 'MALACCA', 'malacca', 81100, 'Chin', '1212212121212122', '12/24', 2, 1688, 123, 0),
(8, 27, 'y hy', 'y@gmail.com', 'BUKIT BERUANG', 'MALACCA', 'malacca', 81100, 'Chin', '2154545121212445', '12/24', 2, 5898, 123, 0),
(9, 27, 'y hy', 'y@gmail.com', 'BUKIT BERUANG', 'MALACCA', 'malacca', 81100, 'Chin', '1214545787878877', '12/24', 2, 6698, 123, 0),
(10, 27, 'y hy', 'y@gmail.com', 'BUKIT BERUANG', 'MALACCA', 'malacca', 81100, 'Chin', '1214545787125478', '12/24', 2, 2070, 123, 0),
(11, 28, 'ys chin', 'y02@gmail.com', 'The Height', 'Malacca', 'Malacca', 74540, 'Chin', '1151678451245787', '12/24', 2, 6848, 123, 0),
(12, 29, 'yiqi tan', 'yq@gmail.com', 'Ixora', 'Malacca', 'Malacca', 81100, 'Tan Yi Qi', '1213545487842121', '12/24', 3, 10970, 123, 1),
(13, 30, 'yisin chin', 'yisin@gmail.com', 'Bukit Beruang', 'Malacca', 'Malacca', 81100, 'Tan Yi Qi', '1255448484815121', '12/23', 2, 7499, 555, 0),
(14, 44, 'chin ys', 'suisuichin70@gmail.com', 'Austin', 'Johor', 'Johor Bahru', 81100, 'Chin', '123154687845121', '12/23', 2, 7300, 456, 0),
(15, 44, 'chin ys', 'suisuichin70@gmail.com', 'Austin', 'Johor', 'Johor Bahru', 81100, 'Chin', '1547875212458895', '12/23', 2, 7499, 123, 0),
(16, 44, 'chin ys', 'suisuichin70@gmail.com', 'Austin', 'Johor', 'Johor Bahru', 81100, 'Chin', '2124578784124587', '12/23', 2, 7300, 123, 0),
(17, 44, 'chin ys', 'suisuichin70@gmail.com', 'Austin', 'Johor', 'Johor Bahru', 81100, 'Chin', '1214578712356899', '12/24', 2, 7300, 234, 0),
(18, 44, 'chin ys', 'suisuichin70@gmail.com', 'Austin', 'Johor', 'Johor Bahru', 81100, 'Chin', '1215768451346878', '12/23', 2, 7300, 456, 0),
(19, 44, 'chin ys', 'suisuichin70@gmail.com', 'Austin', 'Johor', 'Johor Bahru', 81100, 'Chin', '1215457878452121', '12/23', 2, 7300, 789, 0),
(20, 44, 'chin ys', 'suisuichin70@gmail.com', 'Austin', 'Johor', 'Johor Bahru', 81100, 'Chin', '5465 8764 1324 6578', '12/24', 2, 6598, 123, 0),
(21, 44, 'chin ys', 'suisuichin70@gmail.com', 'Austin', 'Johor', 'Johor Bahru', 81100, 'Chin', '4546 7865 2135 4784', '12/24', 2, 5398, 456, 0),
(22, 44, 'chin ys', 'suisuichin70@gmail.com', 'Austin', 'Johor', 'Johor Bahru', 81100, 'Rainn', '4564 5484 4687 8454', '12/24', 3, 5489, 101, 0),
(23, 44, 'chin ys', 'suisuichin70@gmail.com', 'Austin', 'Johor', 'Malacca', 81100, 'Chin Yi Sin', '4545 4644 5645 6465', '12/23', 2, 3788, 123, 1),
(24, 44, 'chin ys', 'suisuichin700@gmail.com', 'ASFF', 'Seremban', 'adfrghh', 81100, 'Chin Yi SIn', '4534 5757 8345 2145', '12/24', 2, 5298, 123, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_pro_id` int(10) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(15) DEFAULT NULL,
  `amt` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`order_pro_id`, `order_id`, `product_id`, `qty`, `amt`) VALUES
(91, 2, 1, 1, 3699),
(92, 2, 2, 1, 2999),
(93, 3, 1, 1, 3699),
(94, 3, 20, 1, 71),
(95, 3, 16, 1, 3399),
(96, 4, 1, 1, 3699),
(97, 4, 8, 1, 8400),
(98, 4, 18, 1, 4199),
(99, 4, 10, 1, 3400),
(100, 4, 14, 1, 1599),
(101, 5, 1, 1, 3699),
(102, 5, 9, 1, 3500),
(103, 5, 21, 1, 90),
(104, 6, 2, 1, 2999),
(105, 6, 17, 1, 4409),
(106, 7, 19, 1, 89),
(107, 7, 14, 1, 1599),
(108, 8, 2, 1, 2999),
(109, 8, 6, 1, 2899),
(110, 9, 1, 1, 3699),
(111, 9, 2, 1, 2999),
(112, 10, 20, 1, 71),
(113, 10, 13, 1, 1999),
(118, 12, 7, 1, 7200),
(119, 13, 1, 1, 3699),
(120, 13, 5, 1, 3800),
(121, 14, 5, 1, 3800),
(122, 14, 9, 1, 3500),
(123, 15, 1, 1, 3699),
(124, 15, 5, 1, 3800),
(125, 16, 5, 1, 3800),
(126, 16, 9, 1, 3500),
(127, 17, 5, 1, 3800),
(128, 17, 9, 1, 3500),
(129, 18, 5, 1, 3800),
(130, 18, 9, 1, 3500),
(131, 19, 5, 1, 3800),
(132, 19, 9, 1, 3500),
(133, 20, 1, 1, 3699),
(134, 20, 6, 1, 2899),
(135, 21, 13, 1, 1999),
(136, 21, 16, 1, 3399),
(137, 22, 5, 1, 3800),
(138, 22, 3, 1, 1599),
(139, 22, 21, 1, 90),
(140, 23, 1, 1, 3699),
(141, 23, 19, 1, 89);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `stock` int(255) NOT NULL,
  `sales` int(255) NOT NULL,
  `prod_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `stock`, `sales`, `prod_status`) VALUES
(1, 1, 1, 'Acer Everyday Laptop - Aspire 5 (Haze Gold)', 3699, '// Windows 11 Home// Intel® Core™ i7-1255U processor// Intel® Iris® Xe Graphics// 14', 'acer-01.jpg', 56, 5, 1),
(2, 1, 1, 'Acer Everyday Laptop - Aspire 5 (Steel Grey)', 2999, '// Windows 11 Home\r\n// Intel® Core™ i5-1235U processor\r\n// Intel® UHD Graphics\r\n// 15.6\" FHD IPS Slim Bezel\r\n// 8GB DDR4 (upgradable to 32GB), 512GB \r\n   SSD\r\n// Microsoft Office Home & Student 2021 \r\n   (by activation)\r\n// Warranty : 3 Year Local Warranty with \r\n   1st Year International Travelers \r\n   Warranty (ITW)', 'acer-02.jpg', 40, 3, 1),
(3, 1, 1, 'Acer Consumer Laptop - Aspire 3 (Pure Silver)', 1599, '// Windows 11 Home\r\n// Intel® Celeron® dual-core processor \r\n   N4500\r\n// 15.6\" FHD IPS DISPLAY\r\n// Intel® UHD Graphics\r\n// 4GB OnBoard DDR4 (1 extra slot, \r\n   upgradable to 12GB) ; 256GB SSD\r\n// Microsoft Office Home & Student 2021 \r\n  (by activation)\r\n// Warranty: 1 Year Local Warranty & 1 \r\n   Year International Traveller Warranty', 'acer-03.jpg', 30, 7, 1),
(4, 1, 1, 'Acer Commercial Laptop', 4499, '// Windows 10 Pro\r\n// Intel® Core™ i5-1135G7 processor\r\n// 8GB DDR4, up to 32GB ; 512GB SSD, SD™ \r\n   Card Reader\r\n// 14.0\" Full HD 1920 x 1080, high- \r\n   brightness supporting multi-touch and \r\n   AES Stylus pen\r\n// Intel® Iris® Xe Graphics\r\n// 325 (W) x 236 (D) x 17.9 (H) mm, \r\n   1.53kg\r\n// Warranty : 3 Years Parts & Labor, \r\n   Onsite Warranty with 1 Year \r\n   International Traveler Warranty (ITW)', 'acer-04.jpg', 25, 10, 1),
(5, 1, 2, 'Dell Latitude 3520', 3800, '// 11th Gen Intel® Core™ i5-1135G7\r\n// Windows 11 Pro (Dell Technologies \r\n   recommends Windows 11 Pro for \r\n   business)\r\n// CY22 Acceleration Intel i5-1135G7, \r\n   Integrated Intel Iris Xe Graphics\r\n// 8 GB, DDR4\r\n// 512 GB SSD\r\n// 15.6-in. display Full HD (1920X1080)', 'dell-01.jpeg', 35, 16, 1),
(6, 1, 2, 'Dell Latitude 3420 Laptop', 2899, '// 11th Gen Intel® Core™ i5-1135G7\r\n// Windows 10 Pro (Dell Technologies \r\n   recommends Windows 11 Pro for \r\n   business)\r\n// Intel® Iris® Xe Graphics\r\n// 8 GB, DDR4\r\n// 256 GB SSD\r\n// 14.0-in. display HD (1366X768)', 'dell-02.jpeg', 45, 22, 1),
(7, 1, 2, 'Dell Alienware X14', 7200, '// 12th Gen Intel® Core™ i7-12700H\r\n// Windows 11 Home\r\n// NVIDIA® GeForce RTX™ 3050 Ti\r\n// 16 GB, LPDDR5\r\n// 512 GB SSD\r\n// 14.0-in. display Full HD (1920X1080) \r\n   144Hz', 'dell-04.jpeg', 55, 0, 1),
(8, 1, 2, 'Dell Alienware X17', 8400, '// 12th Gen Intel® Core™ i9-12900H\r\n// Windows 11 Home\r\n// NVIDIA® GeForce RTX™ 3070 Ti\r\n// 16 GB, DDR5\r\n// 512 GB SSD\r\n// 17.3-in. display Full HD (1920X1080) \r\n   165Hz', 'dell-05.jpeg', 65, 0, 1),
(9, 1, 3, 'HP Pavilion Pink', 3500, '// 12th Generation Intel® Core™ i5 \r\n   processor\r\n// Windows 11 Home\r\n// 14\" diagonal FHD display\r\n// Intel® Iris® X Graphics\r\n// 512 GB PCIe® NVMe™ M.2 SSD\r\n// 8 GB DDR4-3200 MHz RAM (2 x 4 GB)\r\n// 1.41 kg', 'hp-03.jpeg', 60, 0, 1),
(10, 1, 3, 'HP Pavilion Silver', 3400, '// 12th Generation Intel® Core™ i5 \r\n   processor\r\n// Windows 11 Home\r\n// 15.6\" diagonal FHD display\r\n// Intel® Iris® X Graphics\r\n// 512 GB PCIe® NVMe™ M.2 SSD\r\n// 8 GB DDR4-3200 MHz RAM (2 x 4 GB)\r\n// 1.74 kg', 'hp-01.jpeg', 70, 0, 1),
(11, 1, 3, 'HP Pavilion Gaming', 6400, '// Intel® Core™ i7-10750H Processor\r\n// 8 GB DDR4-2933 SDRAM (1 x 8 GB)\r\n// 512 GB PCIe® NVMe™ TLC M.2 SSD\r\n// NVIDIA® GeForce® GTX 1660 Ti with Max- \r\n   Q design (6 GB GDDR6 dedicated)\r\n// 15.6\" diagonal FHD, 144 Hz, IPS, anti- \r\n   glare, micro-edge, WLED-backlit, 250 \r\n   nits, 45% NTSC (1920 x 1080)\r\n// Windows 10 Home\r\n// 2 Years HP Onsite Warranty + ADP', 'hp-07.jpeg', 25, 0, 1),
(12, 1, 3, 'HP Victus', 5700, '// AMD Ryzen™ 5 processor\r\n// Windows 11 Home\r\n// AMD Radeon™ RX 6500M Graphics\r\n// 8 GB DDR4-3200 MHz RAM\r\n// 512 GB PCIe® NVMe™ SSD\r\n// 15.6\" diagonal FHD display 144 Hz 9 ms \r\n   response time\r\n// 2.29 kg', 'hp-04.jpeg', 80, 0, 1),
(13, 2, 1, 'Acer All-In-One - Acer Aspire C Series', 1999, '// Windows® 11 Home\r\n// Intel® Celeron® N4505\r\n// 4GB DDR4 RAM (upgradable to 8GB*2) ; \r\n   256GB SSD\r\n// 21.5\" 1920x1080 (Non-Touch) ; Intel® \r\n   UHD Graphics\r\n// Panel Tiltable from -5° to 25°\r\n// Package included: Acer USB keyboard \r\n   and mouse\r\n// Warranty: 3 Years Onsite Local Limited \r\n   Warranty', 'desktopsacer-aspire.jpg', 90, 0, 1),
(14, 2, 1, 'Acer Consumer Desktop | Acer XC Series', 1599, '// Windows 11 Home\r\n// Intel® Pentium® Silver processor \r\n   N6005 (2.0 GHz up to 3.3 GHz, 4 MB \r\n   cache, quad-core, 10 W)\r\n// 4 GB DDR4 2933 MHz soDIMM (upgradable \r\n   to 8GB*2), 512GB PCIE SSD\r\n// Front/Side I/O connectors : • Card \r\n   reader • Audio jack(s): 2 • USB 3.2 \r\n   Gen 1 Type A port(s): 1 • USB 3.2 \r\n   Gen1 Type C port(s): 1\r\n// Rear I/O connectors : • HDMI port(s): \r\n   1 • LAN port(s): 1• D-Sub port(s): 1 \r\n   • Audio jack(s): 3 • USB 2.0 Type A \r\n   port(s): 4\r\n// Expansion : • PCI Express® x16 \r\n   slot(s): 1\r\n// 3 Years Onsite Local Limited Warranty', 'desktopsacer-consumer.jpg', 85, 0, 1),
(15, 2, 2, 'Dell Inspiron 24 All-in-One', 3149, '// 12th Gen Intel® Core™ i5-1235U\r\n// Windows 11 Home\r\n// Intel® UHD Graphics\r\n// 8 GB, DDR4\r\n// 512 GB SSD\r\n// 23.8-in. display Full HD (1920X1080)', 'desktopsdell24.jpg', 95, 0, 1),
(16, 2, 2, 'Dell Inspiron 27 All-in-One', 3399, '// 12th Gen Intel® Core™ i5-1235U\r\n// Windows 11 Home\r\n// Intel® UHD Graphics\r\n// 8 GB, DDR4\r\n// 512 GB SSD\r\n// 27.0-in. display Full HD (1920X1080)', 'desktopsdell27.jpg', 75, 0, 1),
(17, 2, 3, 'HP ProOne 440 G9 All-in-One Desktop PC', 4409, '// 12th Generation Intel® Core™ i5 \r\n   processor \r\n// Windows 10 Pro (available through \r\n   downgrade rights from Windows 11 Pro) // 8 GB DDR4-3200 MHz RAM (1 x 8 GB) \r\n// 512 GB PCIe® NVMe™ SSD \r\n// Intel® UHD Graphics 770 (integrated on \r\n   processors)', 'desktopshp440.jpg', 25, 0, 1),
(18, 2, 3, 'HP All-in-One Desktop PC 27-cb1002d', 4199, '// 12th Generation Intel® Core™ i5 \r\n   processor\r\n// Windows 11 Home Single Language in S \r\n   mode\r\n// 8 GB DDR4-3200 MHz RAM (1 x 8 GB)\r\n// 1 TB PCIe® NVMe™ M.2 SSD\r\n// Intel® Iris® X Graphics', 'desktopshp27.jpg', 25, 0, 1),
(19, 3, 1, 'Acer USB Type-C 7 in 1 Mini Dock Silver', 89, '// Host Interface: USB Type C\r\n// Color: Silver\r\n// 7 in 1 Mini Docking Station', 'accessoriesacer.jpg', 45, 0, 1),
(20, 3, 2, 'Dell Wireless Mouse-WM126 - Black', 71, 'The WM126 Wireless Optical Mouse from Dell offers you everyday wireless performance with excellent battery life', 'accessoriesdell.jpg', 40, 0, 1),
(21, 3, 3, 'HP 330 Wireless Mouse and Keyboard Combination', 90, '// Wireless. Precise. Comfortable.\r\n// Quick is just your type\r\n// No strings attached\r\n// Keystroke of genius', 'accessorieshp.jpg', 50, 0, 1),
(92, 3, 2, 'q', 12, 'fujebfenj', 'maxresdefault.jpg', 30, 0, 0),
(93, 49, 1, 'product1', 12, 'fujebfenj', '71188276d6da5b6e74d18ab2e8dff288.jpg', 31, 0, 0),
(94, 1, 1, 'Product10', 12, 'fujebfenj', '1015424.jpg', 31, 0, 1),
(95, 1, 1, 'Product11', 12, 'fujebfenj', '1015424.jpg', 31, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_variation`
--

CREATE TABLE `product_variation` (
  `variation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity_in_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_variation`
--

INSERT INTO `product_variation` (`variation_id`, `product_id`, `category_id`, `quantity_in_stock`) VALUES
(1, 1, 1, 75),
(2, 2, 1, 50),
(3, 3, 1, 66),
(4, 4, 1, 45),
(21, 20, 0, 48),
(22, 9, 0, 65),
(23, 11, 3, 44),
(24, 12, 0, 69),
(25, 10, 0, 69),
(27, 8, 0, 78),
(31, 17, 0, 75);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL,
  `verification_code` int(10) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `exp_date` varchar(250) NOT NULL,
  `reset_link_token` varchar(255) NOT NULL,
  `user_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`, `verification_code`, `email_verified_at`, `exp_date`, `reset_link_token`, `user_status`) VALUES
(12, 'Alfred', 'Liow', '1211200875@student.mmu.edu.my', '12345678', '0123456789', '123456789', 'sdcjns,djc', 0, NULL, '2023-06-03 10:53:09', '41be88edd2e8070452dea2eb8fa64df75833', 1),
(27, 'y', 'hy', 'y@gmail.com', '12345678*', '0123456789', 'BUKIT BERUANG', 'MALACCA', 0, NULL, '', '', 1),
(28, 'ys', 'chin', 'y02@gmail.com', 'Yschin00..', '0123456789', 'The Height', 'Malacca', 0, NULL, '', '', 1),
(29, 'yiqi', 'tan', 'yq@gmail.com', 'Yschin00..', '0123456789', 'Ixora', 'Malacca', 0, NULL, '', '', 1),
(30, 'yisin', 'chin', 'yisin@gmail.com', '123456789', '0123456789', 'Bukit Beruang', 'Malacca', 0, NULL, '', '', 1),
(44, 'chin', 'ys', 'suisuichin700@gmail.com', '45172002', '0123456789', 'Austin', 'Johor', 100952, '2023-03-02 18:42:59', '', '', 1);

--
-- Triggers `user_info`
--
DELIMITER $$
CREATE TRIGGER `after_user_info_insert` AFTER INSERT ON `user_info` FOR EACH ROW BEGIN 
INSERT INTO user_info_backup VALUES(new.user_id,new.first_name,new.last_name,new.email,new.password,new.mobile,new.address1,new.address2);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_info_backup`
--

CREATE TABLE `user_info_backup` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders_info`
--
ALTER TABLE `orders_info`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_pro_id`),
  ADD KEY `order_products` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_variation`
--
ALTER TABLE `product_variation`
  ADD PRIMARY KEY (`variation_id`),
  ADD UNIQUE KEY `uc_ps` (`product_id`,`category_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_info_backup`
--
ALTER TABLE `user_info_backup`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders_info`
--
ALTER TABLE `orders_info`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `order_pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `product_variation`
--
ALTER TABLE `product_variation`
  MODIFY `variation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user_info_backup`
--
ALTER TABLE `user_info_backup`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_info`
--
ALTER TABLE `orders_info`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products` FOREIGN KEY (`order_id`) REFERENCES `orders_info` (`order_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
