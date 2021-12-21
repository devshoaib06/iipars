
ALTER TABLE `subject_masters` ADD `subject_slug` VARCHAR(255) NOT NULL AFTER `exam_id`;

UPDATE `subject_masters` SET `subject_slug` = 'unit-2' WHERE `subject_masters`.`id` = 3; UPDATE `subject_masters` SET `subject_slug` = 'unit-3' WHERE `subject_masters`.`id` = 5; UPDATE `subject_masters` SET `subject_slug` = 'unit-4' WHERE `subject_masters`.`id` = 6; UPDATE `subject_masters` SET `subject_slug` = 'unit-5' WHERE `subject_masters`.`id` = 7; UPDATE `subject_masters` SET `subject_slug` = 'unit-6' WHERE `subject_masters`.`id` = 100; UPDATE `subject_masters` SET `subject_slug` = 'unit-7' WHERE `subject_masters`.`id` = 107; UPDATE `subject_masters` SET `subject_slug` = 'unit-8' WHERE `subject_masters`.`id` = 108; UPDATE `subject_masters` SET `subject_slug` = 'unit-9' WHERE `subject_masters`.`id` = 109; UPDATE `subject_masters` SET `subject_slug` = 'unit-10' WHERE `subject_masters`.`id` = 110;


/** 10-12-2021*/
ALTER TABLE `subject_masters` ADD `paper_id` INT NOT NULL AFTER `exam_id`;
ALTER TABLE `subject_masters` ADD `sequence` INT NOT NULL AFTER `status`;
ALTER TABLE `paper_masters`  ADD `paper` INT NOT NULL DEFAULT '0' COMMENT '0=>P-1,1=>P-2'  AFTER `status`;
ALTER TABLE `products` ADD `preview_main_course` INT NULL AFTER `is_preview`;


/**17-12-2021*/
ALTER TABLE `products` ADD `extra_discount` DECIMAL(8,2) NOT NULL DEFAULT '0.00' AFTER `revised_percent`;
ALTER TABLE `orders` ADD `extra_discount` DECIMAL(8,2) NOT NULL DEFAULT '0.00' AFTER `grand_total`;



