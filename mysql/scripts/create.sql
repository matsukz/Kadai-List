CREATE TABLE `kadai` (
    `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
    `register_date` date NOT NULL DEFAULT '2000-01-01',
    `start_date` date NOT NULL DEFAULT '2000-01-01',
    `limit_date` date NOT NULL DEFAULT '2000-01-01',
    `group` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
    `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
    `content` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
    `note` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
    `status` BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;