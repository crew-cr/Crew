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