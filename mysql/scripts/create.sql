CREATE TABLE `kadai` (
    `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    `resist_date` date NOT NULL DEFAULT '2000-01-01',
    `start_date` date NOT NULL DEFAULT '2000-01-01',
    `limit_date` date NOT NULL DEFAULT '2000-01-01',
    `group` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
    `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
    `content` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
    `note` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
    `status` int UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;