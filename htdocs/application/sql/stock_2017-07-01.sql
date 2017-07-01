# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.38)
# Database: stock
# Generation Time: 2017-07-01 05:11:51 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table branchs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `branchs`;

CREATE TABLE `branchs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'auto',
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

LOCK TABLES `branchs` WRITE;
/*!40000 ALTER TABLE `branchs` DISABLE KEYS */;

INSERT INTO `branchs` (`id`, `name`, `email`, `address`, `phone`, `mobile`, `logo_path`, `pm_set`, `active`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`)
VALUES
	(1,'Test Branch','Branch@Branch.com','333/3 ถนนวิภาวดีรังสิต แขวงจอมพล เขตจตุจักร กรุงเทพมหานคร','02-033-9998','02-033-9997',NULL,NULL,1,'2017-06-07 00:00:00','2017-06-07 12:08:18',NULL,1,1,NULL),
	(2,'การไฟฟ้านครหลวง','webmaster@mea.or.th','เลขที่ 30 ซอยชิดลม ถนนเพลินจิต แขวงลุมพินี เขตปทุมวัน กรุงเทพมหานคร 10330','','',NULL,NULL,1,NULL,'2017-06-07 12:14:50',NULL,1,1,NULL),
	(6,'WANGNOI','SYSTEM_IMPORT_EXCEL@SYSTEM',NULL,NULL,NULL,NULL,NULL,1,'2017-06-24 19:44:41',NULL,NULL,1,NULL,NULL),
	(7,'BLC','SYSTEM_IMPORT_EXCEL@SYSTEM',NULL,NULL,NULL,NULL,NULL,1,'2017-06-24 19:44:41',NULL,NULL,1,NULL,NULL);

/*!40000 ALTER TABLE `branchs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_desc`, `parent_cat_id`, `active`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`)
VALUES
	(1,'PWT','PWT',NULL,1,'2017-06-06 00:00:00','2017-06-06 00:00:00',NULL,1,1,NULL),
	(2,'CIMC','CIMC',NULL,1,'2017-06-06 00:00:00','2017-06-06 00:00:00',NULL,1,1,NULL),
	(3,'YORK','YORK',NULL,1,'2017-06-06 00:00:00','2017-06-06 00:00:00',NULL,1,1,NULL),
	(4,'CW-TEST','CW-TEST Description',NULL,0,'2017-06-06 15:50:15','2017-06-06 15:50:15',NULL,1,1,NULL),
	(5,'CW-TEST2','CW-TEST2 Description Edited 2',NULL,0,'2017-06-06 15:50:34','2017-06-07 10:05:01',NULL,1,1,NULL);

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `description`)
VALUES
	(1,'admin','Administrator'),
	(2,'members','General User'),
	(3,'hhhh','hhhh');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table login_attempts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `options`;

CREATE TABLE `options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;

INSERT INTO `options` (`option_id`, `option_name`, `option_value`, `autoload`)
VALUES
	(1,'date_format','d-m-Y','yes'),
	(2,'date_format_js','dd-mm-yy','yes');

/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_conditions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_conditions`;

CREATE TABLE `product_conditions` (
  `product_id` int(11) unsigned NOT NULL,
  `quantity_min` int(11) unsigned NOT NULL,
  `quantity_max` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table product_images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_images`;

CREATE TABLE `product_images` (
  `image_id` int(11) unsigned NOT NULL,
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



# Dump of table product_transfers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_transfers`;

CREATE TABLE `product_transfers` (
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

LOCK TABLES `product_transfers` WRITE;
/*!40000 ALTER TABLE `product_transfers` DISABLE KEYS */;

INSERT INTO `product_transfers` (`trans_id`, `trans_no`, `branch_from`, `branch_to`, `product_id`, `regis_date`, `quantity`, `status`, `remark`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`)
VALUES
	(1,'TF20170625-2325',7,6,3478,'2017-06-25 20:55:18',100,'WAIT','','2017-06-25 20:55:18',NULL,NULL,1,NULL,NULL);

/*!40000 ALTER TABLE `product_transfers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) DEFAULT NULL,
  `product_number` varchar(255) DEFAULT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `product_desc` text,
  `product_price_selling` double DEFAULT '0',
  `product_price_purchasing` double DEFAULT '0',
  `product_branch_origin` int(11) unsigned NOT NULL,
  `product_branch_present` int(11) unsigned NOT NULL,
  `unit` varchar(200) DEFAULT NULL,
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
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`product_id`, `product_name`, `product_number`, `product_code`, `product_desc`, `product_price_selling`, `product_price_purchasing`, `product_branch_origin`, `product_branch_present`, `unit`, `cat_id`, `quantity`, `parent_product_id`, `active`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`)
VALUES
	(1,'กรองน้ำมันเครื่อง STRADA',NULL,NULL,'กรองน้ำมันเครื่อง STRADA	MD326489',28505,23094,0,0,'เครื่อง',1,50,NULL,1,NULL,'2017-06-25 09:13:18',NULL,1,1,NULL),
	(2,'กระจกมองข้างขวา-เลย์',NULL,NULL,'กระจกมองข้างขวา-เลย์	1-71798422-0',570,500,0,0,NULL,1,200,NULL,1,NULL,NULL,NULL,1,1,NULL),
	(3000,'TEST',NULL,'374835835','TEST',100,100,7,0,'dfgdg',1,100,NULL,1,NULL,'2017-06-25 08:32:02',NULL,1,1,NULL),
	(3478,'TETS02',NULL,'345435','sdklfsdf',111,78,7,0,'55',1,900,NULL,1,NULL,'2017-06-25 20:55:18',NULL,1,1,NULL);

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reason
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reason`;

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
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`reason_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `reason` WRITE;
/*!40000 ALTER TABLE `reason` DISABLE KEYS */;

INSERT INTO `reason` (`reason_id`, `reason_title`, `reason_desc`, `active`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`)
VALUES
	(1,'ตัด Stock2','ตัด Stock desc 2',1,'0000-00-00 00:00:00','2017-06-07 12:40:09',NULL,1,1,NULL);

/*!40000 ALTER TABLE `reason` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sale_order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sale_order`;

CREATE TABLE `sale_order` (
  `order_no` varchar(15) NOT NULL,
  `order_subtotal` double NOT NULL,
  `order_discount` double NOT NULL,
  `order_tax` double NOT NULL,
  `order_total` double NOT NULL,
  `reason_id` int(11) NOT NULL,
  `branchs_id` int(11) NOT NULL,
  `order_ship_name` varchar(255) DEFAULT NULL,
  `order_ship_tel` varchar(20) DEFAULT NULL,
  `order_ship_address` text,
  `order_billing_name` varchar(255) DEFAULT NULL,
  `order_billing_tel` varchar(20) DEFAULT NULL,
  `order_billing_address` text,
  `order_desc` text,
  `order_remark` text NOT NULL,
  `order_status` varchar(1) NOT NULL COMMENT '''A'' = Approved, ''W'' = Wait for Approve, ''R'' = Reject, ''C'' = Cancel',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`order_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `sale_order` WRITE;
/*!40000 ALTER TABLE `sale_order` DISABLE KEYS */;

INSERT INTO `sale_order` (`order_no`, `order_subtotal`, `order_discount`, `order_tax`, `order_total`, `reason_id`, `branchs_id`, `order_ship_name`, `order_ship_tel`, `order_ship_address`, `order_billing_name`, `order_billing_tel`, `order_billing_address`, `order_desc`, `order_remark`, `order_status`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`)
VALUES
	('OD20170618-4826',30215,215,7,27900,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'กรุณาระบุเหตุผลทุกครั้ง','A',1,'2017-06-18 14:46:48',1,'2017-06-18 14:46:48',1),
	('OD20170618-6364',59290,95,7,55051.35,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'กรุณาระบุเหตุผลทุกครั้ง','A',1,'2017-06-18 13:22:15',1,'2017-06-18 13:22:15',1),
	('OD20170618-7924',30215,6,7,28094.37,0,1,'s',NULL,'sa','b',NULL,'ba',NULL,'remark','W',1,'2017-06-18 17:58:36',1,'2017-06-18 17:58:36',1);

/*!40000 ALTER TABLE `sale_order` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sale_order_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sale_order_item`;

CREATE TABLE `sale_order_item` (
  `order_no` varchar(15) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `quantity` double NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`order_no`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `sale_order_item` WRITE;
/*!40000 ALTER TABLE `sale_order_item` DISABLE KEYS */;

INSERT INTO `sale_order_item` (`order_no`, `product_id`, `unit_price`, `quantity`, `amount`)
VALUES
	('OD20170618-4826',1,28505,1,28505),
	('OD20170618-4826',2,570,3,1710),
	('OD20170618-6364',1,28505,2,57010),
	('OD20170618-6364',2,570,4,2280),
	('OD20170618-7924',1,28505,1,28505),
	('OD20170618-7924',2,570,3,1710);

/*!40000 ALTER TABLE `sale_order_item` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;

INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`)
VALUES
	('2f60c259d7c6d657441463f46508a519512f4303','::1',1498885597,X'5F5F63695F6C6173745F726567656E65726174657C693A313439383838353532343B6964656E746974797C733A31353A2261646D696E4061646D696E2E636F6D223B656D61696C7C733A31353A2261646D696E4061646D696E2E636F6D223B757365725F69647C733A313A2231223B6F6C645F6C6173745F6C6F67696E7C733A31303A2231343938333933313531223B6C6173745F636865636B7C693A313439383838353533313B');

/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table stock
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stock`;

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `branchs_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stock_qty_ori` int(11) NOT NULL DEFAULT '0',
  `stock_qty_remaining` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`stock_id`),
  UNIQUE KEY `branchs_id` (`branchs_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;

INSERT INTO `stock` (`stock_id`, `branchs_id`, `product_id`, `stock_qty_ori`, `stock_qty_remaining`, `active`, `created_by`, `created_at`, `updated_by`, `updated_at`)
VALUES
	(3,1,1,220,216,1,1,'2017-06-19 15:49:11',1,'2017-06-19 18:15:27'),
	(4,2,2,53,53,1,1,'2017-06-19 16:22:35',1,'2017-06-19 17:49:07'),
	(9,7,3478,4535,900,1,0,'0000-00-00 00:00:00',1,'2017-06-25 20:55:18');

/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tmp_import_stocks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tmp_import_stocks`;

CREATE TABLE `tmp_import_stocks` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `branch`, `phone`)
VALUES
	(1,'127.0.0.1','administrator','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','','MEYMvFPJzK9kcLEdqqMhwu0b6142ac9bc3b69fb1',1495649960,NULL,1268889823,1498885531,1,'Admin','Admin','ADMIN','1','0866954585'),
	(2,'::1','ad2@ad.com','$2y$08$/wakpgz4qSUwlLVnPqLmLeEC38WxnnGf/m8wFF2ior262H0TnUvm2',NULL,'ad2@ad.com',NULL,NULL,NULL,NULL,1497202309,NULL,1,'sss','jj','ADMIN','1','jjj'),
	(3,'::1','ad@admin.com','$2y$08$BSZoLjEWmF1ox/e3NFBqcum9tEsRoA8ce6NFKWkx.9ktRNEsstham',NULL,'ad@admin.com',NULL,NULL,NULL,NULL,1497377863,NULL,1,'xxxx','xxxx','ADMIN','2','2394234'),
	(4,'::1','test@admin.com','$2y$08$rG/Eu6.K9nbV4Qqkcx7U4.bSub7lCph5/5JVvCnhMFpr9jInKbjhq',NULL,'test@admin.com',NULL,NULL,NULL,NULL,1497802688,NULL,1,'xxxxx','xxxx',NULL,'1','234234234');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`)
VALUES
	(1,1,1),
	(2,1,2),
	(3,2,2);

/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
