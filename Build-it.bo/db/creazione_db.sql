-- -----------------------------------------------------
-- Schema onlineshop
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `onlineshop` DEFAULT CHARACTER SET utf8 ;
USE `onlineshop`;

-- -----------------------------------------------------
-- Table `onlineshop`.`accounts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onlineshop`.`accounts` (
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
-- Table `onlineshop`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onlineshop`.`products` (
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
-- Table `onlineshop`.`products-list`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onlineshop`.`products_list` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `onlineshop`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onlineshop`.`orders` (
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
-- Table `onlineshop`.`notifications`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onlineshop`.`notifications` (
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