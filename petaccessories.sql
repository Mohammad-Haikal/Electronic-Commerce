-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2022 at 11:15 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petaccessories`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` text NOT NULL,
  `rating` float NOT NULL DEFAULT '0',
  `num_of_raters` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `email`, `website`, `rating`, `num_of_raters`) VALUES
(1, 'Belcando', 'contact@belcando.com', 'https://www.belcando.com/', 3.25, 8),
(2, 'Royal Canin', 'contact@royalcanin.com', 'https://www.royalcanin.com/us', 0, 0),
(3, 'Montego Pet Nutrition', 'info@montego.com', 'info@montego.com', 0, 0),
(4, 'Happy Pet', 'info@happypet.com', 'info@HappyPet.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Cats'),
(2, 'Dogs'),
(3, 'Birds');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `product_id`, `comment`, `created_at`) VALUES
(2, 7, 35, 'This product is very good', '2022-05-20 02:18:51'),
(3, 7, 34, 'This product is very good', '2022-05-20 02:18:54'),
(9, 4, 40, 'A very nice idea!', '2022-06-16 22:59:24'),
(10, 1, 37, 'I would really need this bed for my cats!', '2022-06-16 23:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `feedback` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `feedback`) VALUES
(4, 5, 'This is a good website');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `street_name` varchar(20) NOT NULL,
  `building_number` varchar(10) NOT NULL,
  `total_price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `order_status_id` (`order_status_id`) USING BTREE,
  KEY `token` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `token`, `user_id`, `order_status_id`, `address`, `street_name`, `building_number`, `total_price`, `created_at`) VALUES
(1, '51653013348', 5, 1, 'Zarqa', 'a', 'asd', 89.97, '2022-05-20 02:22:28'),
(2, '41655418046', 4, 1, 'Karak', 'asd', 'asd', 19.96, '2022-06-16 22:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
CREATE TABLE IF NOT EXISTS `order_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_token` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `order_token` (`order_token`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_token`, `product_id`, `quantity`) VALUES
(1, '51653013348', 36, 1),
(2, '51653013348', 35, 2),
(3, '51653013348', 34, 5),
(4, '41655418046', 35, 4);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status`) VALUES
(1, 'cash'),
(2, 'online');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sold` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `description` text,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `brand_id`, `category_id`, `active`, `sold`, `name`, `image`, `description`, `price`, `quantity`, `created_at`) VALUES
(34, 2, 2, 1, 23, 'Dog\'s Bed', './img/products/16529879145.jpg', 'red', 12, 39, '2022-05-19 19:18:34'),
(35, 1, 2, 1, 9, 'Dogs\' Glasses', './img/products/16530102113.jpg', 'color: white', 4.99, 46, '2022-05-20 01:30:11'),
(36, 2, 3, 1, 56, 'Bird\'s Toys', './img/products/16530102867.jpg', 'Size: m', 19.99, 44, '2022-05-20 01:31:26'),
(37, 2, 1, 1, 0, 'Cat\'s Bed', './img/products/1655418783catbed.jpg', 'Size: 40cm*35cm\r\nColor: Grey', 19.99, 30, '2022-06-16 22:33:03'),
(38, 3, 3, 1, 0, 'Bird Cage Bill', './img/products/1655419055BirdBell.jpg', 'Color: grey', 5.99, 10, '2022-06-16 22:37:35'),
(39, 1, 1, 1, 0, 'Cat Playing Toy', './img/products/1655419138catToy.jpg', 'height: 20cm', 9.99, 30, '2022-06-16 22:38:58'),
(40, 4, 3, 1, 0, 'Bird Drinker And Feeder', './img/products/1655419970birdDrinker and Feeder.jpeg', 'A very useful product to drink and food your birds.', 3.99, 100, '2022-06-16 22:52:50'),
(41, 4, 2, 1, 0, 'Dog T Shirt', './img/products/1655420145godTshirt.jpg', 'A very comfortable wool T shirt\r\nSize: S, L\r\nColor: grey, black, white, blue, red', 19.99, 60, '2022-06-16 22:55:45'),
(42, 4, 1, 1, 0, 'Cat T Shirt', './img/products/1655420625catGlassesWithTshirt.jpg', 'Size: s, m, l\r\nColor: red, pink, green, grey, dark blue, black', 19.99, 100, '2022-06-16 23:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(1) DEFAULT '0',
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `is_admin`, `first_name`, `last_name`, `email`, `phone`, `password`, `created_at`) VALUES
(1, 0, 'Ahmad', 'Khaleel', 'ahmad@gmail.com', '0790580501', 'ahmad', '2022-05-08 11:54:37'),
(2, 0, 'Saeed', 'Ahmad', 'saeed@gmail.com', '123422', 'asd', '2022-05-08 12:41:00'),
(4, 0, 'Sajeda', 'Fahed', 'sajedafahed50@gmail.com', '09876545433', 'Sajeda2001', '2022-05-10 19:52:14'),
(5, 0, 'Raghad', 'Kk', 'raghad114@gmail.com', '54563546545', '0110', '2022-05-10 19:54:30'),
(7, 1, 'Muhammad', 'Haikal', 'muhhl2000@gmail.com', '0790580502', 'muh', '2022-05-14 21:38:00'),
(9, 0, 'Sad', 'Sad', 'sad@gmail.com', '1234', 'sad', '2022-05-14 22:18:25');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

DROP TABLE IF EXISTS `visitors`;
CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `number`) VALUES
(1, 24);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_products_ibfk_3` FOREIGN KEY (`order_token`) REFERENCES `order` (`token`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
