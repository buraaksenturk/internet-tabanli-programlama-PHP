-- 385215_tbl_users
CREATE TABLE `php_final`.`385215_tbl_users` ( 
    `users_id` INT NOT NULL AUTO_INCREMENT , 
    `ad` VARCHAR(50) NOT NULL , 
    `soyad` VARCHAR(50) NOT NULL , 
    `email` VARCHAR(100) NOT NULL , 
    `sifre` VARCHAR(50) NOT NULL , 
    `fotograf` VARCHAR(500) NOT NULL , 
    `aktif_mi` INT NOT NULL DEFAULT '0' , 
    `aktivasyon` VARCHAR(500) NOT NULL , PRIMARY KEY (`users_id`)
) ENGINE = InnoDB;

-- 385215_tbl_mesajlar
CREATE TABLE `php_final`.`385215_tbl_mesajlar` ( 
    `mesaj_id` INT NOT NULL AUTO_INCREMENT , 
    `chat_uygulamasi` INT NOT NULL , 
    `mesaji_gonderen` INT NOT NULL , 
    `mesaj_baslik` VARCHAR(50) NOT NULL , 
    `mesaj_icerik` TEXT NOT NULL , 
    `gonderim_tarihi` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`mesaj_id`)
) ENGINE = InnoDB;

-- 385215_tbl_chatuygulamalari
CREATE TABLE `php_final`.`385215_tbl_chatuygulamalari` ( 
    `chat_id` INT NOT NULL AUTO_INCREMENT , 
    `chat_adi` VARCHAR(100) NOT NULL , PRIMARY KEY (`chat_id`)
) ENGINE = InnoDB;