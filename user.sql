CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `email` varchar(50) DEFAULT NULL,
  `phone` int(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `banished` tinyint DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;