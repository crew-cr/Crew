
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- sf_guard_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_group`;

CREATE TABLE `sf_guard_group`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`description` TEXT,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `sf_guard_group_U_1` (`name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sf_guard_permission
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_permission`;

CREATE TABLE `sf_guard_permission`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`description` TEXT,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `sf_guard_permission_U_1` (`name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sf_guard_group_permission
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_group_permission`;

CREATE TABLE `sf_guard_group_permission`
(
	`group_id` INTEGER NOT NULL,
	`permission_id` INTEGER NOT NULL,
	PRIMARY KEY (`group_id`,`permission_id`),
	INDEX `sf_guard_group_permission_FI_2` (`permission_id`),
	CONSTRAINT `sf_guard_group_permission_FK_1`
		FOREIGN KEY (`group_id`)
		REFERENCES `sf_guard_group` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `sf_guard_group_permission_FK_2`
		FOREIGN KEY (`permission_id`)
		REFERENCES `sf_guard_permission` (`id`)
		ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sf_guard_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user`;

CREATE TABLE `sf_guard_user`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(128) NOT NULL,
	`algorithm` VARCHAR(128) DEFAULT 'sha1' NOT NULL,
	`salt` VARCHAR(128) NOT NULL,
	`password` VARCHAR(128) NOT NULL,
	`created_at` DATETIME,
	`last_login` DATETIME,
	`is_active` TINYINT(1) DEFAULT 1 NOT NULL,
	`is_super_admin` TINYINT(1) DEFAULT 0 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `sf_guard_user_U_1` (`username`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sf_guard_user_permission
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_permission`;

CREATE TABLE `sf_guard_user_permission`
(
	`user_id` INTEGER NOT NULL,
	`permission_id` INTEGER NOT NULL,
	PRIMARY KEY (`user_id`,`permission_id`),
	INDEX `sf_guard_user_permission_FI_2` (`permission_id`),
	CONSTRAINT `sf_guard_user_permission_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `sf_guard_user_permission_FK_2`
		FOREIGN KEY (`permission_id`)
		REFERENCES `sf_guard_permission` (`id`)
		ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sf_guard_user_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_group`;

CREATE TABLE `sf_guard_user_group`
(
	`user_id` INTEGER NOT NULL,
	`group_id` INTEGER NOT NULL,
	PRIMARY KEY (`user_id`,`group_id`),
	INDEX `sf_guard_user_group_FI_2` (`group_id`),
	CONSTRAINT `sf_guard_user_group_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `sf_guard_user_group_FK_2`
		FOREIGN KEY (`group_id`)
		REFERENCES `sf_guard_group` (`id`)
		ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sf_guard_remember_key
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_remember_key`;

CREATE TABLE `sf_guard_remember_key`
(
	`user_id` INTEGER NOT NULL,
	`remember_key` VARCHAR(32),
	`ip_address` VARCHAR(50) NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`user_id`,`ip_address`),
	CONSTRAINT `sf_guard_remember_key_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
