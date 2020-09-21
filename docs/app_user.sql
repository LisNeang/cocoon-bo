-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `app_user`;
CREATE TABLE `app_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(64) DEFAULT NULL,
  `lastname` varchar(64) DEFAULT NULL,
  `role` enum('admin','catalog-manager') NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '1 => actif\n2 => désactivé/bloqué',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `app_user` (`id`, `email`, `password`, `firstname`, `lastname`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1,	'philippe@oclock.io',	'$2y$10$BrKFYYY.cDSp.yFFCESMAue1qMS7PJUleNCKQBDFjTkju9RMT5rX6',	'Philippe',	'Candille',	'admin',	1,	'2020-04-03 09:27:31',	NULL),
(2,	'lucie@oclock.io',	'$2y$10$6yyeDFEPbFirpEsakKjW8ejCOnaF5Rhr5jb/NkKkjSq8oeCPhusgO',	'Lucie',	'Copin',	'admin',	1,	'2020-04-03 09:27:31',	NULL),
(3,	'nicole@oclock.io',	'$2y$10$wGXcVrxifpzqjVh9MTS4CefTU7E3tq0ZMlgscEou0A8zQ22GkTFZG',	'Nicole',	'Café',	'catalog-manager',	1,	'2020-04-03 09:27:31',	NULL),
(7,	'lisneang@gmail.com',	'lm',	'lm',	'lm',	'admin',	2,	'2020-04-04 14:01:43',	NULL);

-- 2020-09-21 09:59:01