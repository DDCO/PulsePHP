use pulsephp;
CREATE TABLE IF NOT EXISTS `users` ( 
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(45) NOT NULL,
    password VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL,
    usergroupID INT UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `id_UNIQUE` (`id` ASC)
);
CREATE TABLE IF NOT EXISTS `log` ( 
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `timestamp` DATETIME NOT NULL,
    address VARCHAR(45) NOT NULL,
    description VARCHAR(45) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `id_UNIQUE` (`id` ASC)
);
CREATE TABLE IF NOT EXISTS `usergroups` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(45) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `id_UNIQUE` (`id` ASC)
);

INSERT INTO usergroups (`name`) VALUES('Administrator');
INSERT INTO usergroups (`name`) VALUES('Registered');