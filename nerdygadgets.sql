-- MySQL Script generated by MySQL Workbench
-- Thu Nov 16 11:40:04 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema nerdy_gadgets_start
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema nerdy_gadgets_start
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `nerdy_gadgets_start` DEFAULT CHARACTER SET utf8mb4 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `nerdy_gadgets_start`.`Product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `nerdy_gadgets_start`.`Product` (
  `productid` INT(11) NOT NULL,
  `productnaam` VARCHAR(250) NOT NULL,
  `description` LONGTEXT CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_bin' NULL,
  `prijs` DECIMAL(10,2) NOT NULL,
  `categorie` VARCHAR(45) NOT NULL,
  `imagesrc` VARCHAR(120) NULL,
  `datum` DATE NULL,
  `merk` VARCHAR(45) NULL,
  `productinformatie` VARCHAR(45) NULL,
  PRIMARY KEY (`productid`))
ENGINE = InnoDB
AUTO_INCREMENT = 189
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `nerdy_gadgets_start`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `nerdy_gadgets_start`.`User` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(80) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `first_name` VARCHAR(30) NOT NULL,
  `surname_prefix` VARCHAR(20) NULL DEFAULT NULL,
  `surname` VARCHAR(30) NOT NULL,
  `street_name` VARCHAR(55) NOT NULL,
  `apartment_nr` VARCHAR(20) NOT NULL,
  `postal_code` VARCHAR(6) NOT NULL,
  `city` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 91
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `mydb`.`recensies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`recensies` (
  `idrecensies` INT NOT NULL AUTO_INCREMENT,
  `inhoud` VARCHAR(250) NULL,
  `rating` INT NOT NULL,
  `Product_id` INT(11) NOT NULL,
  `User_id` INT(11) NOT NULL,
  PRIMARY KEY (`idrecensies`, `Product_id`, `User_id`),
  INDEX `fk_recensies_Product_idx` (`Product_id` ASC) ,
  INDEX `fk_recensies_User1_idx` (`User_id` ASC) ,
  CONSTRAINT `fk_recensies_Product`
    FOREIGN KEY (`Product_id`)
    REFERENCES `nerdy_gadgets_start`.`Product` (`productid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recensies_User1`
    FOREIGN KEY (`User_id`)
    REFERENCES `nerdy_gadgets_start`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `nerdy_gadgets_start` ;

-- -----------------------------------------------------
-- Table `nerdy_gadgets_start`.`Order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `nerdy_gadgets_start`.`Order` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `order_date` DATETIME NOT NULL,
  `user_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Order_User1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_Order_User1`
    FOREIGN KEY (`user_id`)
    REFERENCES `nerdy_gadgets_start`.`User` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 51
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `nerdy_gadgets_start`.`Order_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `nerdy_gadgets_start`.`Order_item` (
  `order_id` INT(11) NOT NULL,
  `product_id` INT(11) NOT NULL,
  `quantity` INT(5) NOT NULL,
  PRIMARY KEY (`order_id`, `product_id`),
  INDEX `fk_Order_has_Product_Product1_idx` (`product_id` ASC) ,
  INDEX `fk_Order_has_Product_Order_idx` (`order_id` ASC) ,
  CONSTRAINT `fk_Order_has_Product_Order`
    FOREIGN KEY (`order_id`)
    REFERENCES `nerdy_gadgets_start`.`Order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Order_has_Product_Product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `nerdy_gadgets_start`.`Product` (`productid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;