CREATE TABLE `itp_vt`.`tbl_385215` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`chat_uygulamasinin_adi` VARCHAR(500) NOT NULL ,
	`kullanici_adi` VARCHAR(50) NOT NULL ,
	`ort_kac_saat` INT(50) NOT NULL ,
	`rahat_mi` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)
) ENGINE = InnoDB;