-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for stock
CREATE DATABASE IF NOT EXISTS `stock` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `stock`;

-- Dumping structure for table stock.branchs
DROP TABLE IF EXISTS `branchs`;
CREATE TABLE IF NOT EXISTS `branchs` (
  `id` int(11) unsigned NOT NULL COMMENT 'auto',
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
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table stock.branchs: ~3 rows (approximately)
DELETE FROM `branchs`;
/*!40000 ALTER TABLE `branchs` DISABLE KEYS */;
INSERT INTO `branchs` (`id`, `name`, `email`, `address`, `phone`, `mobile`, `logo_path`, `pm_set`, `active`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
	(0, 'WANGNOI', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2017-07-02 19:54:03', NULL, NULL, 1, NULL, NULL),
	(1, 'Test Branch', 'Branch@Branch.com', '333/3 ถนนวิภาวดีรังสิต แขวงจอมพล เขตจตุจักร กรุงเทพมหานคร', '02-033-9998', '02-033-9997', NULL, NULL, 1, '2017-06-07 00:00:00', '2017-06-07 12:08:18', NULL, 1, 1, NULL),
	(2, 'การไฟฟ้านครหลวง', 'webmaster@mea.or.th', 'เลขที่ 30 ซอยชิดลม ถนนเพลินจิต แขวงลุมพินี เขตปทุมวัน กรุงเทพมหานคร 10330', '', '', NULL, NULL, 1, NULL, '2017-06-07 12:14:50', NULL, 1, 1, NULL);
/*!40000 ALTER TABLE `branchs` ENABLE KEYS */;

-- Dumping structure for table stock.category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) unsigned NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_desc` text,
  `parent_cat_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table stock.category: ~5 rows (approximately)
DELETE FROM `category`;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`cat_id`, `cat_name`, `cat_desc`, `parent_cat_id`, `active`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
	(1, 'PWT', 'PWT', NULL, 1, '2017-06-06 00:00:00', '2017-06-06 00:00:00', NULL, 1, 1, NULL),
	(2, 'CIMC', 'CIMC', NULL, 1, '2017-06-06 00:00:00', '2017-06-06 00:00:00', NULL, 1, 1, NULL),
	(3, 'YORK', 'YORK', NULL, 1, '2017-06-06 00:00:00', '2017-06-06 00:00:00', NULL, 1, 1, NULL),
	(4, 'CW-TEST', 'CW-TEST Description', NULL, 0, '2017-06-06 15:50:15', '2017-06-06 15:50:15', NULL, 1, 1, NULL),
	(5, 'CW-TEST2', 'CW-TEST2 Description Edited 2', NULL, 0, '2017-06-06 15:50:34', '2017-06-07 10:05:01', NULL, 1, 1, NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table stock.groups
DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table stock.groups: ~2 rows (approximately)
DELETE FROM `groups`;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
	(1, 'admin', 'Administrator'),
	(2, 'members', 'General User');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Dumping structure for table stock.login_attempts
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table stock.login_attempts: ~0 rows (approximately)
DELETE FROM `login_attempts`;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;

-- Dumping structure for table stock.options
DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table stock.options: ~2 rows (approximately)
DELETE FROM `options`;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
	(1, 'date_format', 'd-M-Y', 'yes'),
	(2, 'date_format_js', 'dd-mm-yy', 'yes');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;

-- Dumping structure for table stock.order_status
DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(2) NOT NULL,
  `status_desc` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='สถานะของ order';

-- Dumping data for table stock.order_status: ~4 rows (approximately)
DELETE FROM `order_status`;
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
INSERT INTO `order_status` (`id`, `status`, `status_desc`, `active`) VALUES
	(1, 'A', 'Approved', 1),
	(2, 'W', 'Wait for Approve', 1),
	(3, 'C', 'Canceled', 1),
	(4, 'R', 'Rejected', 1);
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;

-- Dumping structure for table stock.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_number` varchar(255) DEFAULT NULL,
  `product_desc` text,
  `product_price_selling` double DEFAULT '0',
  `product_price_purchasing` double DEFAULT '0',
  `product_branch_origin` int(11) unsigned NOT NULL,
  `product_branch_present` int(11) unsigned NOT NULL,
  `unit` varchar(200) NOT NULL,
  `cat_id` int(11) unsigned NOT NULL,
  `quantity` int(11) unsigned DEFAULT NULL,
  `parent_product_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_code` (`product_code`)
) ENGINE=InnoDB AUTO_INCREMENT=1328 DEFAULT CHARSET=utf8;

-- Dumping data for table stock.products: ~0 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table stock.product_conditions
DROP TABLE IF EXISTS `product_conditions`;
CREATE TABLE IF NOT EXISTS `product_conditions` (
  `product_id` int(11) unsigned NOT NULL,
  `quantity_min` int(11) unsigned NOT NULL,
  `quantity_max` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table stock.product_conditions: ~0 rows (approximately)
DELETE FROM `product_conditions`;
/*!40000 ALTER TABLE `product_conditions` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_conditions` ENABLE KEYS */;

-- Dumping structure for table stock.product_images
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `image_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table stock.product_images: ~0 rows (approximately)
DELETE FROM `product_images`;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;

-- Dumping structure for table stock.product_transfers
DROP TABLE IF EXISTS `product_transfers`;
CREATE TABLE IF NOT EXISTS `product_transfers` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_no` varchar(15) NOT NULL,
  `branch_from` int(11) NOT NULL,
  `branch_to` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `regis_date` datetime NOT NULL,
  `quantity` double NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `remark` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`trans_id`),
  UNIQUE KEY `UNI_KEY` (`trans_no`,`branch_from`,`branch_to`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table stock.product_transfers: ~0 rows (approximately)
DELETE FROM `product_transfers`;
/*!40000 ALTER TABLE `product_transfers` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_transfers` ENABLE KEYS */;

-- Dumping structure for table stock.reason
DROP TABLE IF EXISTS `reason`;
CREATE TABLE IF NOT EXISTS `reason` (
  `reason_id` int(11) NOT NULL,
  `reason_title` varchar(255) NOT NULL,
  `reason_desc` text,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`reason_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table stock.reason: ~0 rows (approximately)
DELETE FROM `reason`;
/*!40000 ALTER TABLE `reason` DISABLE KEYS */;
INSERT INTO `reason` (`reason_id`, `reason_title`, `reason_desc`, `active`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
	(1, 'ตัด Stock2', 'ตัด Stock desc 2', 1, '0000-00-00 00:00:00', '2017-06-07 12:40:09', NULL, 1, 1, NULL);
/*!40000 ALTER TABLE `reason` ENABLE KEYS */;

-- Dumping structure for table stock.sale_order
DROP TABLE IF EXISTS `sale_order`;
CREATE TABLE IF NOT EXISTS `sale_order` (
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
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`order_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเพื่อเก็บข้อมูลการขายสินค้าและtransfer';

-- Dumping data for table stock.sale_order: ~11 rows (approximately)
DELETE FROM `sale_order`;
/*!40000 ALTER TABLE `sale_order` DISABLE KEYS */;
INSERT INTO `sale_order` (`order_no`, `order_type`, `order_subtotal`, `order_discount`, `order_tax`, `order_total`, `reason_id`, `branchs_id`, `branchs_id_to`, `order_ship_name`, `order_ship_tel`, `order_ship_address`, `order_billing_name`, `order_billing_tel`, `order_billing_address`, `order_desc`, `order_remark`, `order_cancel_remark`, `order_status`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	('OD20170618-4826', 'OD', 30215, 215, 7, 27900, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'กรุณาระบุเหตุผลทุกครั้ง', NULL, 'C', 1, '2017-06-18 14:46:48', 1, '2017-06-18 14:46:48', 1),
	('OD20170618-6364', 'OD', 59290, 95, 7, 55051.35, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'กรุณาระบุเหตุผลทุกครั้ง', 'ทดสอบยกเลิก', 'W', 1, '2017-06-18 13:22:15', 1, '2017-06-18 13:22:15', 1),
	('OD20170618-7924', 'OD', 30215, 6, 7, 28094.37, 0, 1, NULL, 's', NULL, 'sa', 'b', NULL, 'ba', NULL, 'remark', 'ทดสอบยกเลิก', 'C', 1, '2017-06-18 17:58:36', 1, '2017-06-18 17:58:36', 1),
	('TR20170624-1627', 'TR', 57010, 0, 0, 57010, 0, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test transfer 2', NULL, 'C', 1, '2017-06-24 06:59:23', 1, '2017-06-24 06:59:23', 1),
	('TR20170624-2352', 'TR', 171030, 0, 0, 171030, 0, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test transfer : branch1 to branch2 , Product 1 qty=6', NULL, 'C', 1, '2017-06-24 07:01:54', 1, '2017-06-24 07:01:54', 1),
	('TR20170624-3418', 'TR', 28505, 0, 0, 28505, 0, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Test Transfer', NULL, 'A', 1, '2017-06-24 05:47:52', 1, '2017-06-24 05:47:52', 1),
	('TR20170624-4512', 'TR', 114020, 0, 0, 114020, 0, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Transfer', NULL, 'A', 1, '2017-06-24 06:50:20', 1, '2017-06-24 06:50:20', 1),
	('TR20170624-8572', 'TR', 171030, 0, 0, 171030, 0, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'taet 4', NULL, 'C', 1, '2017-06-24 07:06:10', 1, '2017-06-24 07:06:10', 1),
	('TR20170702-2565', 'TR', 114020, 10, 0, 114010, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, 'W', 1, '2017-07-02 19:43:22', 1, '2017-07-02 19:43:22', 1),
	('TR20170702-4845', 'TR', 57010, 0, 0, 57010, 0, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test transfer', NULL, 'R', 1, '2017-07-02 05:03:09', 1, '2017-07-02 05:03:09', 1),
	('TR20170702-8953', 'TR', 570, 0, 0, 570, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'remark', NULL, 'C', 1, '2017-07-02 04:18:56', 1, '2017-07-02 04:18:56', 1);
/*!40000 ALTER TABLE `sale_order` ENABLE KEYS */;

-- Dumping structure for table stock.sale_order_item
DROP TABLE IF EXISTS `sale_order_item`;
CREATE TABLE IF NOT EXISTS `sale_order_item` (
  `order_no` varchar(15) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_price` double NOT NULL COMMENT 'ราคาต่อหน่วย ณ ตอนสร้าง PO',
  `quantity` double NOT NULL COMMENT 'จำนวนสินค้า ชิ้น',
  `amount` double NOT NULL COMMENT 'ยอดรวมราคาสินค้า',
  PRIMARY KEY (`order_no`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเพื่อเก็บรายการสินค้าใน order';

-- Dumping data for table stock.sale_order_item: ~14 rows (approximately)
DELETE FROM `sale_order_item`;
/*!40000 ALTER TABLE `sale_order_item` DISABLE KEYS */;
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
	('TR20170702-2565', 1, 28505, 4, 114020),
	('TR20170702-4845', 1, 28505, 2, 57010),
	('TR20170702-8953', 2, 570, 1, 570);
/*!40000 ALTER TABLE `sale_order_item` ENABLE KEYS */;

-- Dumping structure for table stock.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table stock.sessions: ~0 rows (approximately)
DELETE FROM `sessions`;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Dumping structure for table stock.stock
DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `branchs_id` int(11) NOT NULL COMMENT 'รหัสสาขาของ stock นี้',
  `product_id` int(11) NOT NULL COMMENT 'รหัสสินค้าใน stock',
  `stock_qty_ori` int(11) NOT NULL DEFAULT '0' COMMENT 'จำนวนสินค้าใน stock ตอนสร้าง stock',
  `stock_qty_remaining` int(11) NOT NULL COMMENT 'จำนวนสินค้าคงคลัง',
  `stock_remark` text,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`stock_id`),
  UNIQUE KEY `branchs_id` (`branchs_id`,`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table stock.stock: ~5 rows (approximately)
DELETE FROM `stock`;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` (`stock_id`, `branchs_id`, `product_id`, `stock_qty_ori`, `stock_qty_remaining`, `stock_remark`, `active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
	(3, 1, 1, 220, 231, '', 1, 1, '2017-06-19 15:49:11', 1, '2017-06-19 18:15:27'),
	(4, 2, 2, 53, 96, '', 1, 1, '2017-06-19 16:22:35', 1, '2017-06-19 17:49:07'),
	(7, 2, 1, 1, 26, 'Transfer', 1, NULL, '2017-06-24 06:46:46', NULL, '2017-06-24 06:46:46'),
	(8, 1, 2, 3, 27, 'Transfer', 1, NULL, '2017-07-01 07:24:46', NULL, '2017-07-01 07:24:46'),
	(9, 1, 3, 0, 0, NULL, 1, NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;

-- Dumping structure for table stock.tmp_import_stocks
DROP TABLE IF EXISTS `tmp_import_stocks`;
CREATE TABLE IF NOT EXISTS `tmp_import_stocks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ID_CODE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2951 DEFAULT CHARSET=utf8;

-- Dumping data for table stock.tmp_import_stocks: ~0 rows (approximately)
DELETE FROM `tmp_import_stocks`;
/*!40000 ALTER TABLE `tmp_import_stocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmp_import_stocks` ENABLE KEYS */;

-- Dumping structure for table stock.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table stock.users: ~2 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `branch`, `phone`) VALUES
	(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', 'MEYMvFPJzK9kcLEdqqMhwu0b6142ac9bc3b69fb1', 1495649960, NULL, 1268889823, 1499016627, 1, 'Admin', 'Admin', 'ADMIN', '1', '1213'),
	(2, '::1', 'ad2@ad.com', '$2y$08$/wakpgz4qSUwlLVnPqLmLeEC38WxnnGf/m8wFF2ior262H0TnUvm2', NULL, 'ad2@ad.com', NULL, NULL, NULL, NULL, 1497202309, NULL, 1, 'sss', 'jj', NULL, '1', 'jjj');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table stock.users_groups
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table stock.users_groups: ~3 rows (approximately)
DELETE FROM `users_groups`;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 2, 2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
