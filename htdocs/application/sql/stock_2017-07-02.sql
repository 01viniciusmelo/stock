-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 02, 2017 at 06:17 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `branchs`
--

CREATE TABLE `branchs` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'auto',
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` text,
  `phone` text,
  `mobile` text,
  `logo_path` text,
  `pm_set` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branchs`
--

INSERT INTO `branchs` (`id`, `name`, `email`, `address`, `phone`, `mobile`, `logo_path`, `pm_set`, `active`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Test Branch', 'Branch@Branch.com', '333/3 ถนนวิภาวดีรังสิต แขวงจอมพล เขตจตุจักร กรุงเทพมหานคร', '02-033-9998', '02-033-9997', NULL, NULL, 1, '2017-06-07 00:00:00', '2017-06-07 12:08:18', NULL, 1, 1, NULL),
(2, 'การไฟฟ้านครหลวง', 'webmaster@mea.or.th', 'เลขที่ 30 ซอยชิดลม ถนนเพลินจิต แขวงลุมพินี เขตปทุมวัน กรุงเทพมหานคร 10330', '', '', NULL, NULL, 1, NULL, '2017-06-07 12:14:50', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) UNSIGNED NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_desc` text,
  `parent_cat_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_desc`, `parent_cat_id`, `active`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'PWT', 'PWT', NULL, 1, '2017-06-06 00:00:00', '2017-06-06 00:00:00', NULL, 1, 1, NULL),
(2, 'CIMC', 'CIMC', NULL, 1, '2017-06-06 00:00:00', '2017-06-06 00:00:00', NULL, 1, 1, NULL),
(3, 'YORK', 'YORK', NULL, 1, '2017-06-06 00:00:00', '2017-06-06 00:00:00', NULL, 1, 1, NULL),
(4, 'CW-TEST', 'CW-TEST Description', NULL, 0, '2017-06-06 15:50:15', '2017-06-06 15:50:15', NULL, 1, 1, NULL),
(5, 'CW-TEST2', 'CW-TEST2 Description Edited 2', NULL, 0, '2017-06-06 15:50:34', '2017-06-07 10:05:01', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'date_format', 'd-M-Y', 'yes'),
(2, 'date_format_js', 'dd-mm-yy', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `status` varchar(2) NOT NULL,
  `status_desc` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='สถานะของ order';

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status`, `status_desc`, `active`) VALUES
(1, 'A', 'Approved', 1),
(2, 'W', 'Wait for Approve', 1),
(3, 'C', 'Canceled', 1),
(4, 'R', 'Rejected', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) UNSIGNED NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_number` varchar(255) DEFAULT NULL,
  `product_desc` text,
  `product_price_selling` double DEFAULT '0',
  `product_price_purchasing` double DEFAULT '0',
  `product_branch_origin` int(11) UNSIGNED NOT NULL,
  `product_branch_present` int(11) UNSIGNED NOT NULL,
  `cat_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) UNSIGNED DEFAULT NULL,
  `parent_product_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_code`, `product_name`, `product_number`, `product_desc`, `product_price_selling`, `product_price_purchasing`, `product_branch_origin`, `product_branch_present`, `cat_id`, `quantity`, `parent_product_id`, `active`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'AS001', 'กรองน้ำมันเครื่อง STRADA', NULL, 'กรองน้ำมันเครื่อง STRADA	MD326489', 28505, 23094, 0, 0, 1, 50, NULL, 1, NULL, NULL, NULL, 1, 1, NULL),
(2, 'AS002', 'กระจกมองข้างขวา-เลย์', NULL, 'กระจกมองข้างขวา-เลย์	1-71798422-0', 570, 500, 0, 0, 1, 200, NULL, 1, NULL, NULL, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_conditions`
--

CREATE TABLE `product_conditions` (
  `product_id` int(11) UNSIGNED NOT NULL,
  `quantity_min` int(11) UNSIGNED NOT NULL,
  `quantity_max` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) UNSIGNED NOT NULL,
  `image_desc` text,
  `image_name` varchar(255) DEFAULT NULL,
  `image_data` text,
  `image_path` text,
  `product_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reason`
--

CREATE TABLE `reason` (
  `reason_id` int(11) NOT NULL,
  `reason_title` varchar(255) NOT NULL,
  `reason_desc` text,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reason`
--

INSERT INTO `reason` (`reason_id`, `reason_title`, `reason_desc`, `active`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'ตัด Stock2', 'ตัด Stock desc 2', 1, '0000-00-00 00:00:00', '2017-06-07 12:40:09', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_order`
--

CREATE TABLE `sale_order` (
  `order_no` varchar(15) NOT NULL COMMENT 'เลขที่ order ขึ้นด้วยด้วย OD แต่ถ้าเป็น transfer จะขึ้นต้นด้วย TR',
  `order_type` varchar(2) NOT NULL DEFAULT 'OD' COMMENT 'OD:Order, TR:Transfer',
  `order_subtotal` double NOT NULL COMMENT 'ยอดรวมของ order ก่อน vat และ discount',
  `order_discount` double NOT NULL COMMENT 'ส่วนลดเป็นจำนวนเงิน',
  `order_tax` double NOT NULL COMMENT 'Vat เป็น % เช่น7',
  `order_total` double NOT NULL COMMENT 'ยอดรวมหลักหักส่วนลดและ Vat',
  `reason_id` int(11) NOT NULL,
  `branchs_id` int(11) NOT NULL COMMENT 'สาขาที่ทำรายการ (ดึงมาจาก User login)',
  `branchs_id_to` int(11) DEFAULT NULL COMMENT 'สาขาปลายทางที่จะทำการ Transfer',
  `order_ship_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อสถานที่ส่งสินค้า',
  `order_ship_tel` varchar(20) DEFAULT NULL COMMENT 'เบอร์โทรที่ส่งสินค้า',
  `order_ship_address` text COMMENT 'ที่อยู่จัดส่งสินค้า',
  `order_billing_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อแสดงในใบเสร็จและ PO',
  `order_billing_tel` varchar(20) DEFAULT NULL COMMENT 'เบอร์โทรในใบเสร็จและ PO',
  `order_billing_address` text COMMENT 'ที่อยู่ในใบเสร็จและ PO',
  `order_desc` text COMMENT 'รายละเอียดอื่นๆ ถ้ามี',
  `order_remark` text NOT NULL,
  `order_cancel_remark` text COMMENT 'เหตุผลในการยกเลิก',
  `order_status` varchar(1) NOT NULL COMMENT '''A'' = Approved, ''W'' = Wait for Approve, ''R'' = Reject, ''C'' = Cancel',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเพื่อเก็บข้อมูลการขายสินค้าและtransfer';

--
-- Dumping data for table `sale_order`
--

INSERT INTO `sale_order` (`order_no`, `order_type`, `order_subtotal`, `order_discount`, `order_tax`, `order_total`, `reason_id`, `branchs_id`, `branchs_id_to`, `order_ship_name`, `order_ship_tel`, `order_ship_address`, `order_billing_name`, `order_billing_tel`, `order_billing_address`, `order_desc`, `order_remark`, `order_cancel_remark`, `order_status`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
('OD20170618-4826', 'OD', 30215, 215, 7, 27900, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'กรุณาระบุเหตุผลทุกครั้ง', NULL, 'C', 1, '2017-06-18 14:46:48', 1, '2017-06-18 14:46:48', 1),
('OD20170618-6364', 'OD', 59290, 95, 7, 55051.35, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'กรุณาระบุเหตุผลทุกครั้ง', 'ทดสอบยกเลิก', 'W', 1, '2017-06-18 13:22:15', 1, '2017-06-18 13:22:15', 1),
('OD20170618-7924', 'OD', 30215, 6, 7, 28094.37, 0, 1, NULL, 's', NULL, 'sa', 'b', NULL, 'ba', NULL, 'remark', 'ทดสอบยกเลิก', 'C', 1, '2017-06-18 17:58:36', 1, '2017-06-18 17:58:36', 1),
('TR20170624-1627', 'TR', 57010, 0, 0, 57010, 0, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test transfer 2', NULL, 'C', 1, '2017-06-24 06:59:23', 1, '2017-06-24 06:59:23', 1),
('TR20170624-2352', 'TR', 171030, 0, 0, 171030, 0, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test transfer : branch1 to branch2 , Product 1 qty=6', NULL, 'C', 1, '2017-06-24 07:01:54', 1, '2017-06-24 07:01:54', 1),
('TR20170624-3418', 'TR', 28505, 0, 0, 28505, 0, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test Transfer', NULL, 'A', 1, '2017-06-24 05:47:52', 1, '2017-06-24 05:47:52', 1),
('TR20170624-4512', 'TR', 114020, 0, 0, 114020, 0, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Transfer', NULL, 'A', 1, '2017-06-24 06:50:20', 1, '2017-06-24 06:50:20', 1),
('TR20170624-8572', 'TR', 171030, 0, 0, 171030, 0, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'taet 4', NULL, 'C', 1, '2017-06-24 07:06:10', 1, '2017-06-24 07:06:10', 1),
('TR20170702-4845', 'TR', 57010, 0, 0, 57010, 0, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test transfer', NULL, 'R', 1, '2017-07-02 05:03:09', 1, '2017-07-02 05:03:09', 1),
('TR20170702-8953', 'TR', 570, 0, 0, 570, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'remark', NULL, 'C', 1, '2017-07-02 04:18:56', 1, '2017-07-02 04:18:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale_order_item`
--

CREATE TABLE `sale_order_item` (
  `order_no` varchar(15) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_price` double NOT NULL COMMENT 'ราคาต่อหน่วย ณ ตอนสร้าง PO',
  `quantity` double NOT NULL COMMENT 'จำนวนสินค้า ชิ้น',
  `amount` double NOT NULL COMMENT 'ยอดรวมราคาสินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเพื่อเก็บรายการสินค้าใน order';

--
-- Dumping data for table `sale_order_item`
--

INSERT INTO `sale_order_item` (`order_no`, `product_id`, `unit_price`, `quantity`, `amount`) VALUES
('OD20170618-4826', 1, 28505, 1, 28505),
('OD20170618-4826', 2, 570, 3, 1710),
('OD20170618-6364', 1, 28505, 2, 57010),
('OD20170618-6364', 2, 570, 4, 2280),
('OD20170618-7924', 1, 28505, 1, 28505),
('OD20170618-7924', 2, 570, 3, 1710),
('TR20170624-1627', 1, 28505, 2, 57010),
('TR20170624-2352', 1, 28505, 6, 171030),
('TR20170624-3418', 1, 28505, 1, 28505),
('TR20170624-4512', 1, 28505, 4, 114020),
('TR20170624-8572', 1, 28505, 6, 171030),
('TR20170702-4845', 1, 28505, 2, 57010),
('TR20170702-8953', 2, 570, 1, 570);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('tv0heiqvf975un54uv6ne5adp04f9ab9', '::1', 1498961788, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383936313539323b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343938393236303431223b6c6173745f636865636b7c693a313439383936313631333b),
('pnl7kulg89foem13i7qb6nkd0d91irvu', '::1', 1498962151, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383936313930323b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343938393236303431223b6c6173745f636865636b7c693a313439383936313631333b),
('pfap6edcukrgromu5l7vfl7o563m2cdf', '::1', 1498962534, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383936323234393b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343938393236303431223b6c6173745f636865636b7c693a313439383936313631333b),
('fkjq4tq7ahcmp5nbm4qrmikbf7e9um5i', '::1', 1498962753, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383936323535383b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343938393236303431223b6c6173745f636865636b7c693a313439383936313631333b),
('8l4nlngqs71kc4bop3edj5khltdh8a04', '::1', 1498963289, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383936333034383b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343938393236303431223b6c6173745f636865636b7c693a313439383936313631333b),
('4178p674nbp0c8vge091gghq9o315v2f', '::1', 1498964468, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383936343231393b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343938393236303431223b6c6173745f636865636b7c693a313439383936313631333b),
('js40fhsmeh2sllrua329b0cogj8kfl39', '::1', 1498964782, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383936343536373b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343938393236303431223b6c6173745f636865636b7c693a313439383936313631333b),
('28amkah3q93a0rfq66fbmvm9sou7nhgg', '::1', 1498966110, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383936353837323b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343938393236303431223b6c6173745f636865636b7c693a313439383936313631333b),
('k265end8s4ostkmopi4l5tn24hofka58', '::1', 1498966349, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383936363230303b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343938393236303431223b6c6173745f636865636b7c693a313439383936313631333b),
('8p2e73om4oq21v1ebdfp2l2c421qbins', '::1', 1498967008, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383936363732393b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343938393236303431223b6c6173745f636865636b7c693a313439383936313631333b),
('vh3iv6t4b9m7up1qbbp6udl8bsu6lr75', '::1', 1498967389, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383936373133383b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343938393236303431223b6c6173745f636865636b7c693a313439383936313631333b),
('m7lv51g0m66aulv092r7p7j14uu5ervs', '::1', 1498967548, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383936373438323b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343938393236303431223b6c6173745f636865636b7c693a313439383936313631333b),
('hcng1bl1ibjl16lemseo7vjnhoipmt6i', '::1', 1498968026, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439383936373930383b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231343938393236303431223b6c6173745f636865636b7c693a313439383936313631333b);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `branchs_id` int(11) NOT NULL COMMENT 'รหัสสาขาของ stock นี้',
  `product_id` int(11) NOT NULL COMMENT 'รหัสสินค้าใน stock',
  `stock_qty_ori` int(11) NOT NULL DEFAULT '0' COMMENT 'จำนวนสินค้าใน stock ตอนสร้าง stock',
  `stock_qty_remaining` int(11) NOT NULL COMMENT 'จำนวนสินค้าคงคลัง',
  `stock_remark` text,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `branchs_id`, `product_id`, `stock_qty_ori`, `stock_qty_remaining`, `stock_remark`, `active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(3, 1, 1, 220, 231, '', 1, 1, '2017-06-19 15:49:11', 1, '2017-06-19 18:15:27'),
(4, 2, 2, 53, 96, '', 1, 1, '2017-06-19 16:22:35', 1, '2017-06-19 17:49:07'),
(7, 2, 1, 1, 26, 'Transfer', 1, NULL, '2017-06-24 06:46:46', NULL, '2017-06-24 06:46:46'),
(8, 1, 2, 3, 27, 'Transfer', 1, NULL, '2017-07-01 07:24:46', NULL, '2017-07-01 07:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_import_stocks`
--

CREATE TABLE `tmp_import_stocks` (
  `id` int(11) UNSIGNED NOT NULL,
  `import_file_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `part_no` varchar(255) DEFAULT NULL,
  `qty` double DEFAULT '0',
  `price` double DEFAULT '0',
  `code` varchar(16) DEFAULT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `branch`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', 'MEYMvFPJzK9kcLEdqqMhwu0b6142ac9bc3b69fb1', 1495649960, NULL, 1268889823, 1498961613, 1, 'Admin', 'istrator', 'ADMIN', '1', '0'),
(2, '::1', 'ad2@ad.com', '$2y$08$/wakpgz4qSUwlLVnPqLmLeEC38WxnnGf/m8wFF2ior262H0TnUvm2', NULL, 'ad2@ad.com', NULL, NULL, NULL, NULL, 1497202309, NULL, 1, 'sss', 'jj', NULL, '1', 'jjj');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branchs`
--
ALTER TABLE `branchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- Indexes for table `reason`
--
ALTER TABLE `reason`
  ADD PRIMARY KEY (`reason_id`);

--
-- Indexes for table `sale_order`
--
ALTER TABLE `sale_order`
  ADD PRIMARY KEY (`order_no`);

--
-- Indexes for table `sale_order_item`
--
ALTER TABLE `sale_order_item`
  ADD PRIMARY KEY (`order_no`,`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD UNIQUE KEY `branchs_id` (`branchs_id`,`product_id`);

--
-- Indexes for table `tmp_import_stocks`
--
ALTER TABLE `tmp_import_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ID_CODE` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tmp_import_stocks`
--
ALTER TABLE `tmp_import_stocks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
