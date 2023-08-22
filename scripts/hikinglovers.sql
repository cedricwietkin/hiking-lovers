CREATE DATABASE IF NOT EXISTS `hamilton-8-lovers`;

USE `hamilton-8-lovers`;

DROP TABLE IF EXISTS `Hikes`;

CREATE TABLE `Hikes` (
                         `id` INT AUTO_INCREMENT PRIMARY KEY,
                         `username` VARCHAR(100) NOT NULL,
                         `distance` VARCHAR(180) NOT NULL,
                         `duration` VARCHAR(255),
                         `elevation_gain` DECIMAL(10, 2),
                         `description` TEXT,
                         `created_at` TIMESTAMP,
                         `updated_at` TIMESTAMP
);

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users` (
                         `id` INT AUTO_INCREMENT PRIMARY KEY,
                         `firstname` VARCHAR(100) NOT NULL,
                         `lastname` VARCHAR(100) NOT NULL,
                         `nickname` VARCHAR(100) NOT NULL,
                         `email` VARCHAR(180) NOT NULL,
                         `password` VARCHAR(255),
                         CONSTRAINT email UNIQUE (`email`),
                         CONSTRAINT nickname UNIQUE (`nickname`)
);


DROP TABLE IF EXISTS `Tags`;

CREATE TABLE `Tags` (
                         `id` INT AUTO_INCREMENT PRIMARY KEY,
                         `name` VARCHAR(100) NOT NULL

);