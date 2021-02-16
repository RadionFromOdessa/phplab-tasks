# CREATE TABLE `anekdots`

CREATE TABLE `anekdots` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `athor` varchar(255) NOT NULL,
  `type_id` int NOT NULL,
  `users_id` int NOT NULL,
  `datepost` date NOT NULL,
  `anekdot` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

# INSERT INTO `anekdots`

INSERT INTO `anekdots` VALUES (37,'Radion',7,9,'2020-11-07','111','2020-11-07 08:17:20','2020-11-07 08:17:20'),(50,'Radion',6,9,'2020-11-08','вамвапвап','2020-11-08 17:16:07','2020-11-08 17:16:07'),(52,'Radion',5,9,'2020-11-08','123','2020-11-08 18:01:44','2020-11-08 18:01:44'),(53,'Radion',4,9,'2020-11-08','dsadsad','2020-11-08 18:26:19','2020-11-08 18:26:19'),(54,'Radion',4,9,'2020-11-08','dsdfsdf','2020-11-08 18:26:43','2020-11-08 18:26:43'),(58,'Radion',5,9,'2020-11-08','111е','2020-11-08 18:59:47','2020-11-30 05:27:45'),(62,'Radion',6,9,'2020-11-08','321','2020-11-08 19:52:05','2020-11-08 19:52:05'),(63,'Radion',4,9,'2020-11-09','rewrwer','2020-11-09 09:03:56','2020-11-09 09:03:56'),(64,'Radion',4,9,'2020-11-09','cvcxvxcv','2020-11-09 09:04:08','2020-11-09 09:04:08'),(69,'Radion',7,9,'2020-11-09','тестовая дата','2020-11-09 09:53:16','2020-10-09 08:53:16'),(72,'Radion',6,9,'2020-11-09','вамвапвапq','2020-11-09 13:22:16','2020-11-09 13:22:16'),(75,'Elizabeth',4,10,'2020-11-09','vdvfvfg','2020-11-09 14:30:51','2020-11-09 14:30:51'),(76,'Radion',4,9,'2020-11-09','fdsfdsfsdf','2020-11-09 14:55:04','2020-11-09 14:55:04'),(78,'Radion',7,9,'2020-11-09','тестовая дата123','2020-11-09 15:47:39','2020-11-09 15:47:39'),(79,'Elizabeth',4,10,'2020-11-09','vdvfvfg123','2020-11-09 18:21:12','2020-11-09 18:21:12'),(91,'LiizA',7,12,'2020-11-29','Я не уступаю место бабкам в маршрутке потому, что бабки - не главное но без них тяжело','2020-11-29 17:01:12','2020-11-29 17:01:29'),(93,'Radion',4,9,'2020-12-25','Нрип','2020-12-25 13:20:19','2020-12-25 13:20:19');

# CREATE TABLE `pages`

CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `url` char(128) NOT NULL,
  `title` char(128) NOT NULL,
  `type_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

# INSERT INTO `pages`

INSERT INTO `pages` VALUES (1,'404','Page NOT FOUND',0,'2020-11-05 16:22:18','2020-11-05 16:22:18'),(2,'/','Главная страница',0,'2020-11-05 16:27:03','2020-11-05 16:27:03'),(3,'vova','Анекдоты Вовочка',4,'2020-11-05 16:27:03','2020-11-05 16:27:03'),(4,'masha','Анедоты про Машу',5,'2020-11-05 16:27:04','2020-11-05 16:27:04'),(5,'vasyapetya','Анекдоты про Чапаева и Петьку',6,'2020-11-05 16:27:04','2020-11-05 16:27:04'),(6,'raznoe','Разные анекдоты',7,'2020-11-05 16:27:04','2020-11-05 16:27:04');

# CREATE TABLE `types`

CREATE TABLE `types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

# INSERT INTO `types`

INSERT INTO `types` VALUES (4,'vova','2020-11-05 16:10:34','2020-11-05 16:10:34'),(5,'masha','2020-11-05 16:11:07','2020-11-05 16:11:07'),(6,'vasyapetya','2020-11-05 16:11:29','2020-11-05 16:11:29'),(7,'raznoe','2020-11-05 16:11:49','2020-11-05 16:11:49');

# CREATE TABLE `users`

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text,
  `two_factor_recovery_codes` text,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `statuses_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

# INSERT INTO `users`

INSERT INTO `users` VALUES (9,'Radion','Babucha','$2y$f10$pTBaNos6gfhMi2SMBgfgfK0A.p3Om8U4oFdbVgfgerKHRrj4ajqXJq84oe40Am',NULL,NULL,'Украина','Одесса','1991-07-24','bauca@gmail.com',NULL,NULL,NULL,NULL,'2020-11-06 12:24:43','2020-11-06 14:05:39',1),(10,'Elizabeth','LizaNAti','$2y$10$wwNhPLc72LTmqJ4At2jRdugiDMB4qYEZ7jmoXjpwylaNPf.w5ByeG',NULL,NULL,'Украина','Киев','2007-07-14','lizaagaletskaya@gmail.com',NULL,NULL,NULL,NULL,'2020-11-06 12:25:45','2020-11-06 14:06:07',2),(11,'Настя','Dodu','$2y$10$9vadhQUS32FYHpU/Z4dH6.7QIT.CWjwAZ7LDaushS47z8/Jsg8Sym',NULL,NULL,'Украина','Харьков','1986-11-13','fdsf@gfg',NULL,NULL,NULL,NULL,'2020-11-09 11:13:47','2020-11-09 11:13:47',2),(12,'LiizA','_liza_','$2y$10$d093zI9xtUC8bn2upIZufOHVfNNQnXkotFN5eN/prLrpujePxQFP2',NULL,NULL,'Ukraine','Odessa','2007-07-14','leictom@gmail.com',NULL,NULL,NULL,NULL,'2020-11-29 16:57:49','2020-11-29 16:57:49',2),(13,'asdasdas','sadasdsadasd','$2y$10$NAwkI0x2NirAMLxvgCby2.ei32HcQ75EXZJbBa9R66jGJn6ewS8H.',NULL,NULL,'asdasd','asdasdas','2020-12-11','sadasd@gmail.com',NULL,NULL,NULL,NULL,'2020-12-29 14:32:35','2020-12-29 14:32:35',2);