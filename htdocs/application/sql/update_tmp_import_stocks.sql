
ALTER TABLE `tmp_import_stocks`
        -- ADD COLUMN `exists` INT(11) NOT NULL DEFAULT '0' AFTER `file_type`;	
	ADD COLUMN `barcode` VARCHAR(255) NULL DEFAULT NULL AFTER `part_no`,
        ADD COLUMN `template` VARCHAR(250) NULL  DEFAULT NULL AFTER `exists`,
	ADD COLUMN `image` TEXT NULL DEFAULT NULL AFTER `qty`;

