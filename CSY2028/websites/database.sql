-- Adminer 4.8.1 MySQL 11.3.2-MariaDB-1:11.3.2+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `auction`;
CREATE TABLE `auction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `categoryId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `endDate` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryId` (`categoryId`),
  KEY `userId` (`userId`),
  CONSTRAINT `auction_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`),
  CONSTRAINT `auction_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `auction` (`id`, `title`, `description`, `categoryId`, `userId`, `endDate`, `image`) VALUES
(1,	'Mercedes-Benz ',	'Mercedes-Benz C class coupe cars for sale!!!',	3,	4,	'2024-02-21 12:00:00',	'coupe.jpeg'),
(3,	'New Saloon car',	'The Best Saloon Car on sale!!!',	4,	4,	'2024-02-22 17:25:00',	'saloon.jpeg'),
(4,	'Skoda Superb Estate',	'flash sale!!',	1,	4,	'2024-02-23 22:00:00',	'skoda.jpeg'),
(5,	'TATA Estate ev',	'Flash sale!!',	1,	9,	'2024-02-24 12:35:00',	'tata.jpeg'),
(6,	'SEAT leon estate',	'New SEAT leon estate on sale!!',	1,	11,	'2024-02-25 13:50:00',	'leon.jpeg'),
(7,	'SUV',	'Electric car on sale!',	1,	12,	'2024-03-01 07:18:00',	'SUV.jpeg'),
(8,	'1984 Volvo 240',	'volvo car on sale!!!',	1,	12,	'2024-02-26 16:09:00',	'volvo.jpeg'),
(9,	'2014 Ford Mondeo Estate',	'Ford on sale!!!',	1,	13,	'2024-03-04 21:12:00',	'ford.jpeg'),
(10,	' Best 4*4',	'Top best car on sale!!!',	7,	13,	'2024-02-28 16:14:00',	'four.jpeg'),
(11,	'BMW',	'BMW Car on sale!',	8,	14,	'2024-03-12 20:17:00',	'12233244.4.jpeg'),
(12,	'KIA',	'KIA electric on sale!!!\r\nFlash sale!!!!',	2,	14,	'2024-03-15 16:19:00',	'kia.jpeg'),
(13,	'suv',	'this car is awesome',	2,	16,	'2024-03-01 10:26:00',	'1710218491.2.jpg'),
(14,	'suv',	'this car is awesome',	2,	16,	'2024-03-01 10:26:00',	'');

DROP TABLE IF EXISTS `bid`;
CREATE TABLE `bid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `auctionId` int(11) NOT NULL,
  `bid` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `auctionId` (`auctionId`),
  CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`auctionId`) REFERENCES `auction` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `bid` (`id`, `userId`, `auctionId`, `bid`) VALUES
(1,	4,	4,	100),
(2,	4,	4,	200),
(3,	1,	3,	300),
(4,	10,	5,	400),
(5,	11,	7,	500),
(6,	11,	5,	600),
(7,	11,	4,	700),
(8,	11,	4,	800),
(9,	11,	4,	900),
(10,	11,	4,	500),
(11,	11,	4,	500),
(12,	13,	6,	350),
(13,	14,	8,	450),
(14,	14,	11,	1500),
(15,	14,	12,	1700),
(16,	16,	11,	222),
(17,	16,	11,	22222),
(18,	16,	5,	3000),
(19,	20,	11,	33333),
(20,	20,	11,	100);

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `category` (`id`, `name`) VALUES
(1,	'Estate'),
(2,	'Electric'),
(3,	'Coupe'),
(4,	'Saloon'),
(7,	'4x4'),
(8,	'Sports'),
(9,	'Hybrid');

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `auctionId` int(11) NOT NULL,
  `reviewText` varchar(255) NOT NULL,
  `reviewDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `auctionId` (`auctionId`),
  KEY `reviewText` (`reviewText`),
  CONSTRAINT `review_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  CONSTRAINT `review_ibfk_2` FOREIGN KEY (`auctionId`) REFERENCES `auction` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `review` (`id`, `userId`, `auctionId`, `reviewText`, `reviewDate`) VALUES
(1,	6,	4,	'nice service',	'2023-05-19 11:06:16'),
(2,	11,	4,	'Super!',	'2023-05-19 07:03:23'),
(3,	16,	11,	'bmw is the best car with best specification',	'2024-03-12 04:53:45'),
(4,	20,	11,	'THIS IS SO GOOD I LOVE THIS CAR',	'2024-03-17 08:15:09');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `name`, `email`, `password`, `type`) VALUES
(1,	'Admin',	'admin123@email.com',	'I.cDg4amgSR/6',	'admin'),
(4,	'John',	'john.user@email.com',	'8be3c943b1609fffbfc51aad666d0a04adf83c9d',	'user'),
(5,	'Peter',	'peter.user@gmail.com',	'8be3c943b1609fffbfc51aad666d0a04adf83c9d',	'user'),
(6,	'Tom',	'tom.user@email.com',	'8be3c943b1609fffbfc51aad666d0a04adf83c9d',	'user'),
(7,	'aprish',	'aprish@gmail.com',	'86f7e437faa5a7fce15d1ddcb9eaeaea377667b8',	'user'),
(9,	'Frank',	'frank@email.com',	'aafdc23870ecbcd3d557b6423a8982134e17927e',	'user'),
(10,	'leo',	'leo@email.com',	'44472e643f451cae2ba0460e451385f0ff31482f',	'user'),
(11,	'abc',	'abc@email.com',	'789b49606c321c8cf228d17942608eff0ccc4171',	'user'),
(12,	'hero',	'hero@email.com',	'qrHTgzV.nQJnY',	'user'),
(13,	'David',	'david123@email.com',	'4afa2a522b2d24f5e525c072e1eef447938f6d93',	'user'),
(14,	'leo',	'leo1@email.com',	'653b84f1a58b94c8eb15a24e1e8eded12687d2a3',	'user'),
(15,	'abce',	'abcd@email.com',	'03de6c570bfe24bfc328ccd7ca46b76eadaf4334',	'user'),
(16,	'aashish',	'aashish@gmail.com',	'01b307acba4f54f55aafc33bb06bbbf6ca803e9a',	'user'),
(17,	'tamang aprish',	'tamang@gmail.com',	'01b307acba4f54f55aafc33bb06bbbf6ca803e9a',	'user'),
(18,	'Aprish111',	'aprishtamang111@gmail.com',	'a3f71dfcae07b77f24ed1cdfa470153e162a37b3',	'admin'),
(19,	'nami',	'nami@gmail.com',	'fe5f55995fd81049f5942fecf1dbd40bb862e3cb',	'user'),
(20,	'Admin',	'admin@admin.com',	'efacc4001e857f7eba4ae781c2932dedf843865e',	'admin'),
(21,	'aaaaa',	'aa@gmail.com',	'efacc4001e857f7eba4ae781c2932dedf843865e',	'user');

-- 2024-03-17 08:35:34