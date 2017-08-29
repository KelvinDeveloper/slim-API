CREATE TABLE `slim`.`users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2017-01-01 10:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '2017-01-01 10:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `slim`.`users`
(`id`,
`name`,
`lastname`,
`email`,
`password`,
`remember_token`,
`created_at`,
`updated_at`)
VALUES
(null,
'Admin',
'SlimAPI',
'admin@admin.com',
'$2a$06$QHANYIBvctm2MhdZywU0d.hSsfBWDHxgTuqDsjmWFupq1Boqx1ECO',
'',
now(),
now());
