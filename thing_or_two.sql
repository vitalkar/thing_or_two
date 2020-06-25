CREATE TABLE `thing_or_two`.`urls` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `url` INT NOT NULL , 
    `short_url` INT NOT NULL , 
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`)    
) ENGINE = InnoDB;