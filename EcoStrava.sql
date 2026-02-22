CREATE DATABASE EcoStrava;
USE EcoStrava;

CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `transports` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `co2_km` FLOAT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `activities` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `transport_id` INT(11) NOT NULL,
  `km` FLOAT NOT NULL,
  `date` DATE NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `transport_id` (`transport_id`),
  CONSTRAINT `fk_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `users`(`id`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_transport`
    FOREIGN KEY (`transport_id`)
    REFERENCES `transports`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `transports` (`name`, `co2_km`) VALUES
('Walking', 0),
('Cycling', 0),
('E-scooter', 3),
('Train, long distance', 31),
('Bus, long distance', 31),
('Bus, local', 41),
('Train, local', 58),
('Metro', 63),
('Tram', 63),
('Ferry', 123),
('Car (average)', 166),
('Airplane', 238);
