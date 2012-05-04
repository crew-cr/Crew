To know the current version, see the [version file](https://github.com/pmsipilot/Crew/blob/master/version).

## Update the code

Just pull the project.

## Update the database

Check your local version file : `/path/to/your/workspace/Crew/version`  
And patch your MySql database with the following SQL commands.

### From 1.0 to 2.0

    ALTER TABLE `branch` 
      ADD `created_at` datetime NOT NULL AFTER `date_status_changed`,
      ADD `updated_at` datetime NOT NULL AFTER `created_at`;

    CREATE TABLE IF NOT EXISTS `log_git` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `command` varchar(512) NOT NULL,
      `code` int(11) NOT NULL,
      `message` text NOT NULL,
      `created_at` datetime NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

    ALTER TABLE `comment`
      ADD `check_user_id` int(11) DEFAULT NULL AFTER `root_comment_id`,
      ADD `checked_at` datetime AFTER `check_user_id`,
      ADD CONSTRAINT `comment_FI_4` FOREIGN KEY (`check_user_id`) REFERENCES `sf_guard_user` (`id`);

These  [patches](https://github.com/pmsipilot/Crew/tree/master/update/sql/1.0) are also available in the project.
