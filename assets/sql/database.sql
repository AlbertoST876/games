CREATE DATABASE `es_games`;
USE `es_games`;

----------------------------------------------------------

CREATE TABLE `games` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `torrent` varchar(255) NOT NULL,
  `destacado` varchar(5) NOT NULL DEFAULT 'no',
  `fecha` varchar(30) NOT NULL
);

CREATE TABLE `reports` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `juego` int NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `fecha` varchar(30) NOT NULL
);

----------------------------------------------------------

ALTER TABLE `games` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 55;


----------------------------------------------------------

ALTER TABLE `reports`
  ADD CONSTRAINT `fk_IDJuego` FOREIGN KEY (`juego`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;