<?php

/** @var \PDO $pdo */
require_once './pdo_ini.php';

$sql = <<<'SQL'
CREATE TABLE `cities` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`id`)
);

CREATE TABLE `states` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`id`)
);

CREATE TABLE `airports` ( 
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`code` VARCHAR(3) NOT NULL COLLATE 'utf8_general_ci',
	`city_id` INT(10) NOT NULL,
	`state_id` INT(10) NOT NULL,
	`address` VARCHAR(150) NOT NULL COLLATE 'utf8_general_ci',
	`timezone` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`id`),
	FOREIGN KEY (`city_id`) REFERENCES cities(`id`),
	FOREIGN KEY (`state_id`) REFERENCES states(`id`)
);
SQL;
$pdo->exec($sql);
