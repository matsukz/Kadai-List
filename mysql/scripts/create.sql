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

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(100) NOT NULL,
    api_key VARCHAR(100) NOT NULL UNIQUE,
    roll BOOLEAN not null DEFAULT FALSE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;