CREATE DATABASE `es_games`;
USE `es_games`;

----------------------------------------------------------

CREATE TABLE `games` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `torrent` varchar(100) NOT NULL,
  `destacado` enum('T', 'F') NOT NULL DEFAULT 'F',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `reports` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `juego` int NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

----------------------------------------------------------

ALTER TABLE `reports`
  ADD CONSTRAINT `fk_IDJuego` FOREIGN KEY (`juego`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;