ALTER TABLE `comment`
  ADD `check_user_id` int(11) DEFAULT NULL AFTER `root_comment_id`,
  ADD `checked_at` datetime AFTER `check_user_id`,
  ADD CONSTRAINT `comment_FI_4` FOREIGN KEY (`check_user_id`) REFERENCES `sf_guard_user` (`id`);
