CREATE DATABASE IF NOT EXISTS `register_sales` DEFAULT CHARSET = utf8;

SELECT * FROM `products`;
SELECT * FROM `sales`;
SELECT * FROM `sales_products`;

CREATE TABLE IF NOT EXISTS `products` (
	`id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    `quantity` int,
    `price` decimal(6,2) NOT NULL,
    `image` varchar(80),
    PRIMARY KEY(`id`)
) DEFAULT CHARSET = utf8;



INSERT INTO `products` (name, quantity, price) VALUES ('Panela', 3, 29.99);

CREATE TABLE IF NOT EXISTS `sales` (
	`id` int NOT NULL AUTO_INCREMENT,
    `payment_type` enum('À vista', 'Cartão', 'Boleto') NOT NULL,
    `date_sale` date NOT NULL,
    `number_note` varchar(20) NOT NULL UNIQUE,
    `observation` text,
    PRIMARY KEY(`id`)
) DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `sales_products` (
	`id` int NOT NULL AUTO_INCREMENT,
    `product_id` int,
    `sale_id` int,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`product_id`) REFERENCES `products`(`id`),
    FOREIGN KEY(`sale_id`) REFERENCES `sales`(`id`)
) DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `sales`;
DROP TABLE IF EXISTS `sales_products`;
