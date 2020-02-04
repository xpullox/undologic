CREATE TABLE `LIVE_database`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `first_name` VARCHAR(99) NOT NULL , `last_name` VARCHAR(99) NOT NULL , `email` VARCHAR(99) NOT NULL , `password` VARCHAR(99) NOT NULL , `created` DATETIME NOT NULL , `modified` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `users` ADD `user_type_id` INT NOT NULL AFTER `id`;


CREATE TABLE `LIVE_database`.`datas` ( `id` INT NOT NULL AUTO_INCREMENT , `data` LONGTEXT NOT NULL , `created` DATETIME NOT NULL , `modified` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;



ALTER TABLE `datas` ADD `name` VARCHAR(99) NOT NULL AFTER `id`;

