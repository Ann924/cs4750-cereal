CREATE TABLE IF NOT EXISTS `user_information` (
  `user_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `user_validation` (
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `user_information`
  ADD FOREIGN KEY (`email`) REFERENCES `user_validation`(`email`) ON DELETE CASCADE ON UPDATE RESTRICT;

CREATE TABLE IF NOT EXISTS `cereal_info` (
  `cereal_id` INT NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` BLOB DEFAULT NULL,
  PRIMARY KEY (`cereal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `cereal_manufacturer` (
  `name` varchar(100) NOT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `cereal_info`
  ADD FOREIGN KEY (`name`) REFERENCES `cereal_manufacturer`(`name`) ON DELETE CASCADE ON UPDATE RESTRICT;

CREATE TABLE IF NOT EXISTS `bookmarks` (
  `user_name` varchar(20) NOT NULL,
  `cereal_id` INT NOT NULL,
  `personalized_serving_size` INT DEFAULT NULL,
  PRIMARY KEY (`user_name`, `cereal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `bookmarks`
  ADD FOREIGN KEY (`cereal_id`) REFERENCES `cereal_info`(`cereal_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD FOREIGN KEY (`user_name`) REFERENCES `user_information`(`user_name`) ON DELETE CASCADE ON UPDATE RESTRICT;

CREATE TABLE IF NOT EXISTS `vote` (
  `user_name` varchar(20) NOT NULL,
  `cereal_id` INT NOT NULL,
  `vote_value` INT NOT NULL,
  PRIMARY KEY (`user_name`, `cereal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `vote`
  ADD FOREIGN KEY (`cereal_id`) REFERENCES `cereal_info`(`cereal_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD FOREIGN KEY (`user_name`) REFERENCES `user_information`(`user_name`) ON DELETE CASCADE ON UPDATE RESTRICT;

CREATE TABLE IF NOT EXISTS `creates_cereal` (
  `user_name` varchar(20) NOT NULL,
  `cereal_id` INT NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`user_name`, `cereal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `creates_cereal`
  ADD FOREIGN KEY (`cereal_id`) REFERENCES `cereal_info`(`cereal_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD FOREIGN KEY (`user_name`) REFERENCES `user_information`(`user_name`) ON DELETE CASCADE ON UPDATE RESTRICT;

CREATE TABLE IF NOT EXISTS `nutritional_statement` (
  `cereal_id` INT NOT NULL UNIQUE,
  `serving_size` INT NOT NULL,
  `calories` INT NOT NULL,
  `protein` INT DEFAULT NULL,
  `fat` INT DEFAULT NULL,
  `sugars` INT DEFAULT NULL,
  `vitamins` INT DEFAULT NULL,
  `sodium` date DEFAULT NULL,
  `fiber` date DEFAULT NULL,
  `carbohydrate` date DEFAULT NULL,
  `potassium` date DEFAULT NULL,
  PRIMARY KEY (`cereal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `comment` (
  `user_name` varchar(20) NOT NULL,
  `cereal_id` INT NOT NULL,
  `comment_id` INT NOT NULL,
  `text` TEXT DEFAULT '',
  `date` date NOT NULL,
  PRIMARY KEY (`user_name`, `cereal_id`, `comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `comment`
  ADD FOREIGN KEY (`cereal_id`) REFERENCES `cereal_info`(`cereal_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD FOREIGN KEY (`user_name`) REFERENCES `user_information`(`user_name`) ON DELETE CASCADE ON UPDATE RESTRICT;

CREATE TABLE IF NOT EXISTS `club` (
  `club_id` INT NOT NULL,
  `club_description` TEXT DEFAULT '',
  `club_score` INT DEFAULT 0,
  `num_members` INT DEFAULT 0,
  PRIMARY KEY (`club_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `joins_club` (
  `user_name` varchar(20) NOT NULL,
  `club_id` INT NOT NULL,
  PRIMARY KEY (`user_name`, `club_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `creates_club` (
  `club_id` varchar(20) NOT NULL,
  `user_name` INT NOT NULL,
  PRIMARY KEY (`club_id`, `user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `creates_club`
  ADD FOREIGN KEY (`club_id`) REFERENCES `club`(`club_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD FOREIGN KEY (`user_name`) REFERENCES `user_information`(`user_name`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `joins_club`
  ADD FOREIGN KEY (`club_id`) REFERENCES `club`(`club_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD FOREIGN KEY (`user_name`) REFERENCES `user_information`(`user_name`) ON DELETE CASCADE ON UPDATE RESTRICT;