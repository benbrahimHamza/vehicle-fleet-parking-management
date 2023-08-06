SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `vfpm`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `Fleet`;
CREATE TABLE `Fleet` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `userId` (`userId`),
  CONSTRAINT `Fleet_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `User` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `FleetVehicle`;
CREATE TABLE `FleetVehicle` (
  `idFleet` int(11) NOT NULL,
  `idVehicle` int(11) NOT NULL,
  KEY `idFleet` (`idFleet`),
  KEY `idVehicle` (`idVehicle`),
  CONSTRAINT `FleetVehicle_ibfk_1` FOREIGN KEY (`idFleet`) REFERENCES `Fleet` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FleetVehicle_ibfk_2` FOREIGN KEY (`idVehicle`) REFERENCES `Vehicle` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `Vehicle`;
CREATE TABLE `Vehicle` (
  `id` int(11) NOT NULL,
  `plateNumber` varchar(36) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
