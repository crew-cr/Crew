CREATE TABLE IF NOT EXISTS `log_git` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `command` varchar(512) NOT NULL,
  `code` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
