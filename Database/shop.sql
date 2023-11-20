-- Adminer 4.8.1 MySQL 5.5.5-10.4.27-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites` (
  `productid` int(11) NOT NULL AUTO_INCREMENT,
  `productname` varchar(255) NOT NULL,
  `productprice` varchar(255) NOT NULL,
  `productimage` varchar(255) NOT NULL,
  PRIMARY KEY (`productid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `productid` int(11) NOT NULL AUTO_INCREMENT,
  `productname` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `stock` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `productdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `productdescription` text NOT NULL,
  `productimg` varchar(255) NOT NULL,
  PRIMARY KEY (`productid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

INSERT INTO `products` (`productid`, `productname`, `category`, `stock`, `price`, `productdate`, `productdescription`, `productimg`) VALUES
(1,	'Hamburger',	'',	'1.000',	'150₺',	'2023-11-20 18:19:28',	'Hamburger Description',	'IMG-655ba330d5d409.48582989.png'),
(2,	'Pizza',	'',	'500',	'180₺',	'2023-11-20 18:19:58',	'Pizza Description',	'IMG-655ba34e742255.29926803.png'),
(3,	'Sandwich',	'',	'289',	'75₺',	'2023-11-20 18:20:48',	'Sandwich Description',	'IMG-655ba3808df9d7.22730559.png'),
(4,	'Toast',	'',	'917',	'95₺',	'2023-11-20 18:22:01',	'Toast Description',	'IMG-655ba3c95dd6f4.01507697.png'),
(5,	'Cola',	'',	'2.500',	'25₺',	'2023-11-20 18:22:38',	'Cola Description',	'IMG-655ba3eee381a0.88571662.png'),
(6,	'French Fries',	'',	'1.430',	'50₺',	'2023-11-20 18:23:44',	'French Fries Description',	'IMG-655ba43092d727.73650564.png');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `useremail` varchar(50) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

INSERT INTO `users` (`userid`, `username`, `useremail`, `userpassword`, `role`) VALUES
(1,	'Ahmet Yılmaz',	'ahmet@gmail.com',	'$2y$10$SHJAe.TDg5jp4S/GJ9p1..N/K9Bcw9OvDwaEzyQKQm2aHtq5wcZ2.',	1),
(2,	'Admin',	'admin@gmail.com',	'$2y$10$T.V40CsyhHOj/pT922VwrOcRBksyCzvHfeAJNf/oOgdJQQKXzU9WC',	2);

-- 2023-11-20 18:32:15
