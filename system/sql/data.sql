
		CREATE TABLE IF NOT EXISTS `logs`(
		`id` INT AUTO_INCREMENT NOT NULL,
		`_id` DOUBLE DEFAULT NULL,
		`login` VARCHAR(100),
		`pass` VARCHAR(100),
		`email` VARCHAR(100),
		`bday` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (`id`))
		CHARACTER SET utf8 COLLATE utf8_general_ci;
		
			INSERT INTO `logs`(`_id`,`login`,`pass`,`email`,`bday`)
			VALUES(1629247013.8516,'test','ca956cda23a29c97e8bf6595dc96a45b','Kazanskiy.sergey87@gmail.com','1987-11-27 12:11:00');
			
			INSERT INTO `logs`(`_id`,`login`,`pass`,`email`,`bday`)
			VALUES(1629247695.7183,'jbytvt5hygjvYgvj_ii','ca956cda23a29c97e8bf6595dc96a45b','sb@gmail.com','1987-11-27 12:11:00');
			