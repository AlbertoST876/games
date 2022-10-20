CREATE DATABASE `es_games`;
USE `es_games`;

----------------------------------------------------------

CREATE TABLE `users` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `restorePassword` enum('T','F') NOT NULL DEFAULT 'T',
  `lastPasswordChange` datetime DEFAULT NULL,
  `lastAccess` datetime DEFAULT NULL,
  `editedBy` int DEFAULT NULL,
  `lastEdition` datetime DEFAULT NULL,
  `createdBy` int DEFAULT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `games` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `torrent` varchar(100) NOT NULL,
  `featured` enum('T', 'F') NOT NULL DEFAULT 'F',
  `editedBy` int DEFAULT NULL,
  `lastEdition` datetime DEFAULT NULL,
  `createdBy` int NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `reports` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `game` int NOT NULL,
  `message` varchar(255) NOT NULL,
  `reported` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `attendedBy` int DEFAULT NULL,
  `attended` datetime DEFAULT NULL,
  `resolved` enum('T','F') NOT NULL DEFAULT 'F'
);

CREATE TABLE `permissions` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `action` varchar(25) NOT NULL
);

CREATE TABLE `users_permissions` (
  `user` int NOT NULL,
  `permission` int NOT NULL
);

----------------------------------------------------------

INSERT INTO `users` (`username`, `password`, `restorePassword`) VALUES
('root', 'root', 'T');

INSERT INTO `permissions` (`action`) VALUES
('Ver Usuarios'),
('Ver Juegos'),
('Ver Reportes'),
('Agregar Usuarios'),
('Agregar Juegos'),
('Editar Usuarios'),
('Editar Juegos'),
('Eliminar Usuarios'),
('Eliminar Juegos'),
('Atender Reportes');

INSERT INTO `users_permissions` (`user`, `permission`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10);

INSERT INTO `games` (`name`, `image`, `torrent`, `featured`, `createdBy`) VALUES
('Alan Wake', './assets/img/alanwake.jpg', './assets/torrent/alanwake.torrent', 'F', 1),
('Alien Isolation', './assets/img/alienisolation.jpg', './assets/torrent/alienisolation.torrent', 'F', 1),
('ARK Survival Evolved', './assets/img/ark.jpg', './assets/torrent/ark.torrent', 'F', 1),
('Assassin\'s Creed 4 Black Flag', './assets/img/assassinscreed4blackflag.jpg', './assets/torrent/assassinscreed4blackflag.torrent', 'F', 1),
('Assassin\'s Creed Odyssey', './assets/img/assassinscreedodyssey.jpg', './assets/torrent/assassinscreedodyssey.torrent', 'T', 1),
('Assassin\'s Creed Origins', './assets/img/assassinscreedorigins.jpg', './assets/torrent/assassinscreedorigins.torrent', 'F', 1),
('Castlevania Lords of Shadow', './assets/img/castlevanialordsofshadow.jpg', './assets/torrent/castlevanialordsofshadow.torrent', 'F', 1),
('Castlevania Lords of Shadow 2', './assets/img/castlevanialordsofshadow2.jpg', './assets/torrent/castlevanialordsofshadow2.torrent', 'F', 1),
('Castlevania Mirror of Fate', './assets/img/castlevaniamirroroffate.jpg', './assets/torrent/castlevaniamirroroffate.torrent', 'F', 1),
('Call of Duty Advanced Warfare', './assets/img/codaw.jpg', './assets/torrent/codaw.torrent', 'F', 1),
('Call of Duty Black Ops', './assets/img/codbo.jpg', './assets/torrent/codbo.torrent', 'F', 1),
('Call of Duty Black Ops 2', './assets/img/codbo2.jpg', './assets/torrent/codbo2.torrent', 'F', 1),
('Call of Duty Black Ops 3', './assets/img/codbo3.jpg', './assets/torrent/codbo3.torrent', 'F', 1),
('Call of Duty Infinite Warfare', './assets/img/codiw.jpg', './assets/torrent/codiw.torrent', 'F', 1),
('Call of Duty World War 2', './assets/img/codww2.jpg', './assets/torrent/codww2.torrent', 'F', 1),
('Doom', './assets/img/doom.jpg', './assets/torrent/doom.torrent', 'F', 1),
('Doom Eternal', './assets/img/doometernal.jpg', './assets/torrent/doometernal.torrent', 'T', 1),
('Far Cry 3', './assets/img/farcry3.jpg', './assets/torrent/farcry3.torrent', 'F', 1),
('Far Cry 4', './assets/img/farcry4.jpg', './assets/torrent/farcry4.torrent', 'F', 1),
('Far Cry 5', './assets/img/farcry5.jpg', './assets/torrent/farcry5.torrent', 'F', 1),
('Ghost Recon Wildlands', './assets/img/ghostreconwildlands.jpg', './assets/torrent/ghostreconwildlands.torrent', 'F', 1),
('Grand Theft Auto V', './assets/img/gtav.jpg', './assets/torrent/gtav.torrent', 'T', 1),
('Hitman', './assets/img/hitman.jpg', './assets/torrent/hitman.torrent', 'F', 1),
('Hitman 2', './assets/img/hitman2.jpg', './assets/torrent/hitman2.torrent', 'F', 1),
('Hitman 3', './assets/img/hitman3.jpg', './assets/torrent/hitman3.torrent', 'F', 1),
('Jurassic World Evolution', './assets/img/jurassicworldevolution.jpg', './assets/torrent/jurassicworldevolution.torrent', 'F', 1),
('Just Cause 3', './assets/img/justcause3.jpg', './assets/torrent/justcause3.torrent', 'F', 1),
('Just Cause 4', './assets/img/justcause4.jpg', './assets/torrent/justcause4.torrent', 'F', 1),
('Little Nightmares', './assets/img/littlenightmares.jpg', './assets/torrent/littlenightmares.torrent', 'F', 1),
('Little Nightmares 2', './assets/img/littlenightmares2.jpg', './assets/torrent/littlenightmares2.torrent', 'F', 1),
('Metro Exodus', './assets/img/metroexodus.jpg', './assets/torrent/metroexodus.torrent', 'F', 1),
('Monster Hunter World', './assets/img/monsterhunterworld.jpg', './assets/torrent/monsterhunterworld.torrent', 'F', 1),
('Mortal Kombat 11', './assets/img/mortalkombat11.jpg', './assets/torrent/mortalkombat11.torrent', 'F', 1),
('Mortal Kombat X', './assets/img/mortalkombatx.jpg', './assets/torrent/mortalkombatx.torrent', 'F', 1),
('Need for Speed Heat', './assets/img/nfsheat.jpg', './assets/torrent/nfsheat.torrent', 'F', 1),
('Need for Speed Most Wanted', './assets/img/nfsmw12.jpg', './assets/torrent/nfsmw12.torrent', 'F', 1),
('Need for Speed Payback', './assets/img/nfspayback.jpg', './assets/torrent/nfspayback.torrent', 'F', 1),
('Outlast', './assets/img/outlast.jpg', './assets/torrent/outlast.torrent', 'F', 1),
('Outlast 2', './assets/img/outlast2.jpg', './assets/torrent/outlast2.torrent', 'F', 1),
('PayDay 2', './assets/img/payday2.jpg', './assets/torrent/payday2.torrent', 'F', 1),
('Rage', './assets/img/rage.jpg', './assets/torrent/rage.torrent', 'F', 1),
('Rage 2', './assets/img/rage2.jpg', './assets/torrent/rage2.torrent', 'F', 1),
('Red Dead Redemption 2', './assets/img/reddeadredemption2.jpg', './assets/torrent/reddeadredemption2.torrent', 'T', 1),
('Resident Evil 7', './assets/img/residentevil7.jpg', './assets/torrent/residentevil7.torrent', 'F', 1),
('Rise of the Tomb Raider', './assets/img/risetombraider.jpg', './assets/torrent/risetombraider.torrent', 'F', 1),
('Shadow of the Tomb Raider', './assets/img/shadowtombraider.jpg', './assets/torrent/shadowtombraider.torrent', 'T', 1),
('Subnautica', './assets/img/subnautica.jpg', './assets/torrent/subnautica.torrent', 'F', 1),
('Subnautica Below Zero', './assets/img/subnauticabelowzero.jpg', './assets/torrent/subnauticabelowzero.torrent', 'F', 1),
('Titanfall 2', './assets/img/titanfall2.jpg', './assets/torrent/titanfall2.torrent', 'F', 1),
('Tomb Raider', './assets/img/tombraider.jpg', './assets/torrent/tombraider.torrent', 'F', 1),
('Watch Dogs', './assets/img/watchdogs.jpg', './assets/torrent/watchdogs.torrent', 'F', 1),
('Watch Dogs 2', './assets/img/watchdogs2.jpg', './assets/torrent/watchdogs2.torrent', 'F', 1),
('Wolfenstein Youngblood', './assets/img/wolfensteinyoungblood.jpg', './assets/torrent/wolfensteinyoungblood.torrent', 'F', 1),
('World War Z', './assets/img/worldwarz.jpg', './assets/torrent/worldwarz.torrent', 'F', 1);

----------------------------------------------------------

ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_editedBy` FOREIGN KEY (`editedBy`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_createdBy` FOREIGN KEY (`createdBy`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `games`
  ADD CONSTRAINT `fk_games_editedBy` FOREIGN KEY (`editedBy`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_games_createdBy` FOREIGN KEY (`createdBy`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `reports`
  ADD CONSTRAINT `fk_reports_game` FOREIGN KEY (`game`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reports_attendedBy` FOREIGN KEY (`attendedBy`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `users_permissions`
  ADD CONSTRAINT `fk_usersPermissions_user` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usersPermissions_permission` FOREIGN KEY (`permission`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;