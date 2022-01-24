-- -----------------------------------------------------
-- Schema build-it.bo
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `build-it.bo` DEFAULT CHARACTER SET utf8 ;
USE `build-it.bo`;

-- -----------------------------------------------------
-- Table `build-it.bo`.`accounts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `build-it.bo`.`accounts` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(100) NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `address` varchar(100) NULL, 
  `image` varchar(100) NULL,
  `permissions` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `build-it.bo`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `build-it.bo`.`products` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL UNIQUE,
  `quantity` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `description_short` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `discount` int(11) NULL,
  `image` varchar(100) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `build-it.bo`.`products-list`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `build-it.bo`.`products_list` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `build-it.bo`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `build-it.bo`.`orders` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shipping` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `comments` varchar(255) NULL,
  `id_user` int(11) NOT NULL,
  `buy_date` datetime(0) NOT NULL,
  `delivery_date` datetime(0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `build-it.bo`.`notifications`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `build-it.bo`.`notifications` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `permissions` int(11) NOT NULL,
  `id_user` int(11) NULL,
  `id_order` int(11) NULL,
  `order_step` int(11) NULL,
  `id_product` int(11) NULL,
  `text` char(100) NOT NULL,
  `seen` boolean NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;