To know the current version, see the [version file](https://github.com/pmsipilot/Crew/blob/master/version).

## Update the code

Just pull the project.

## Update the database

Check your local version file : `/path/to/your/workspace/Crew/version`  
And patch your MySql database with the following SQL commands.

### From 1.0 to current status

    ALTER TABLE `branch` ADD `created_at` datetime NOT NULL AFTER `date_status_changed`;
    ALTER TABLE `branch` ADD `updated_at` datetime NOT NULL AFTER `created_at`;

These  [patches](https://github.com/pmsipilot/Crew/tree/master/update/sql/1.0) are also available in the project.
