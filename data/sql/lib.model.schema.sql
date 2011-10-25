
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- branch
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `branch`;


CREATE TABLE `branch`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`status_id` INTEGER(11)  NOT NULL,
	`user_status_changed` INTEGER,
	`repository_id` INTEGER(11)  NOT NULL,
	`name` VARCHAR(255)  NOT NULL,
	`commit_reference` VARCHAR(50)  NOT NULL,
	`commit_status_changed` VARCHAR(50),
	`date_status_changed` TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
	`is_blacklisted` TINYINT(1) default 0 NOT NULL,
	`review_request` TINYINT(1) default 0 NOT NULL,
	PRIMARY KEY (`id`),
	KEY `branch_FI_1`(`status_id`),
	KEY `branch_FI_2`(`user_status_changed`),
	CONSTRAINT `branch_FK_1`
		FOREIGN KEY (`status_id`)
		REFERENCES `status` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `branch_FK_2`
		FOREIGN KEY (`user_status_changed`)
		REFERENCES `sf_guard_user` (`id`),
	INDEX `branch_FI_3` (`repository_id`),
	CONSTRAINT `branch_FK_3`
		FOREIGN KEY (`repository_id`)
		REFERENCES `repository` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- branch_comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `branch_comment`;


CREATE TABLE `branch_comment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER,
	`branch_id` INTEGER(11)  NOT NULL,
	`value` TEXT  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `branch_comment_FI_1`(`user_id`),
	KEY `branch_comment_FI_2`(`branch_id`),
	CONSTRAINT `branch_comment_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`),
	CONSTRAINT `branch_comment_FK_2`
		FOREIGN KEY (`branch_id`)
		REFERENCES `branch` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- file
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `file`;


CREATE TABLE `file`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`branch_id` INTEGER(11)  NOT NULL,
	`status_id` INTEGER(11)  NOT NULL,
	`state` CHAR(1)  NOT NULL,
	`filename` VARCHAR(255)  NOT NULL,
	`commit_status_changed` VARCHAR(50)  NOT NULL,
	`user_status_changed` INTEGER(11)  NOT NULL,
	`date_status_changed` TIMESTAMP NOT NULL default CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	KEY `file_FI_1`(`branch_id`),
	KEY `file_FI_2`(`status_id`),
	CONSTRAINT `file_FK_1`
		FOREIGN KEY (`branch_id`)
		REFERENCES `branch` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `file_FK_2`
		FOREIGN KEY (`status_id`)
		REFERENCES `status` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- file_comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `file_comment`;


CREATE TABLE `file_comment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER,
	`file_id` INTEGER(11)  NOT NULL,
	`value` TEXT  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `file_comment_FI_1`(`user_id`),
	KEY `file_comment_FI_2`(`file_id`),
	CONSTRAINT `file_comment_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`),
	CONSTRAINT `file_comment_FK_2`
		FOREIGN KEY (`file_id`)
		REFERENCES `file` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- line_comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `line_comment`;


CREATE TABLE `line_comment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER,
	`commit_reference` VARCHAR(50)  NOT NULL,
	`file_id` INTEGER(11)  NOT NULL,
	`position` INTEGER(11)  NOT NULL,
	`line` INTEGER(11)  NOT NULL,
	`value` TEXT  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `line_comment_FI_1`(`user_id`),
	KEY `line_comment_FI_2`(`file_id`),
	CONSTRAINT `line_comment_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`),
	CONSTRAINT `line_comment_FK_2`
		FOREIGN KEY (`file_id`)
		REFERENCES `file` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- repository
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `repository`;


CREATE TABLE `repository`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50)  NOT NULL,
	`value` VARCHAR(255)  NOT NULL,
	`remote` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- status
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `status`;


CREATE TABLE `status`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50)  NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
