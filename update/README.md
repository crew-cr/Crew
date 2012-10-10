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
      
### From 2.0 to master

    CREATE TABLE IF NOT EXISTS `request` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `branch_id` int(11) NOT NULL,
      `commit` varchar(50) NOT NULL,
      `created_at` datetime NOT NULL,
      PRIMARY KEY (`id`),
      KEY `review_FI_1` (`branch_id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
    
    ALTER TABLE `request`
      ADD CONSTRAINT `branch_id_fk` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`);
      
    INSERT INTO request (branch_id, commit, created_at)
    SELECT id, last_commit, updated_at
    FROM branch;


These  [patches](https://github.com/pmsipilot/Crew/tree/master/update/sql) are also available in the project.
