CREATE DATABASE IF NOT EXISTS `csproject_db`;
USE `csproject_db`;

START TRANSACTION;

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` integer NOT NULL,
  `weight` float NOT NULL,
  `height` int NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);

ALTER TABLE `notifications` 
ADD PRIMARY KEY (`id`);

ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

COMMIT;