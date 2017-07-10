-- Update tmp_import_stocks
ALTER TABLE `tmp_import_stocks` ADD COLUMN `exists` INT(1) NOT NULL DEFAULT '0' AFTER `file_type`;