ALTER TABLE `branch` ADD `created_at` datetime NOT NULL AFTER `date_status_changed`;
ALTER TABLE `branch` ADD `updated_at` datetime NOT NULL AFTER `created_at`;
