-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 28, 2022 at 01:37 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_cost` decimal(6,0) NOT NULL,
  `order_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on_hold',
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_name`, `user_email`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(5, '20', 'not paid', 'Mahmoud Elshall', 'admin@admin.com', 44557788, 'Elsanta', 'Meetmaymoon - Santa - Gharbia', '2022-04-26 00:00:00'),
(6, '150', 'not paid', 'mahmoud', 'mahmoud@gmail.com', 5555555, 'sssss', 'sssssssss', '2022-04-26 00:00:00'),
(7, '90', 'paid', 'ahmed', 'aa@aa.com', 44557788, 'aaaaa', 'aaaaa', '2022-04-26 00:00:00'),
(8, '20', 'not paid', 'ali', 'ali@ali.com', 44557788, 'aaaaa', 'aaaaa', '2022-04-26 00:00:00'),
(9, '40', 'not paid', 'ali', 'ali@ali.com', 44557788, 'aaaaa', 'aaaaa', '2022-04-26 00:00:00'),
(10, '40', 'paid', 'ali', 'ali@ali.com', 44557788, 'aaaaa', 'aaaaa', '2022-04-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_name` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` datetime NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_name`, `order_date`) VALUES
(2, 5, '14', 'Soda Drinks', 'drink-3.jpg', '20.00', 1, 'Mahmoud Elshall', '2022-04-26 00:00:00'),
(3, 6, '14', 'Soda Drinks', 'drink-3.jpg', '20.00', 3, 'mahmoud', '2022-04-26 00:00:00'),
(4, 6, '1', 'Italian Pizza', 'pizza-1.jpg', '90.00', 1, 'mahmoud', '2022-04-26 00:00:00'),
(5, 7, '1', 'Italian Pizza', 'pizza-1.jpg', '90.00', 1, 'ahmed', '2022-04-26 00:00:00'),
(6, 8, '16', 'drink', 'drink-5.jpg', '20.00', 1, 'ali', '2022-04-26 00:00:00'),
(7, 9, '16', 'drink', 'drink-5.jpg', '20.00', 2, 'ali', '2022-04-26 00:00:00'),
(8, 10, '16', 'drink', 'drink-5.jpg', '20.00', 2, 'ali', '2022-04-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `transaction_id` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` datetime NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `transaction_id`, `payment_date`) VALUES
(1, 7, '2L384671JE854780D', '2022-04-26 00:00:00'),
(2, 10, '77626328D2440594G', '2022-04-27 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` decimal(6,0) NOT NULL,
  `product_special_offer` int(2) NOT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_quantity` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_price`, `product_special_offer`, `product_type`, `product_quantity`) VALUES
(1, 'Italian Pizza', 'pizza', 'pizza with cheese and onion', 'pizza-1.jpg', '90', 0, 'meal', 0),
(2, 'Greek Pizza\r\n', 'pizza', 'pizza with cheese and onion', 'pizza-2.jpg', '80', 0, 'meal', 0),
(3, 'Caucasian Pizza\r\n', 'pizza', 'pizza with cheese and onion', 'pizza-3.jpg', '100', 0, 'meal', 0),
(4, 'American Pizza\r\n', 'pizza', 'pizza with cheese and onion', 'pizza-4.jpg', '70', 0, 'meal', 0),
(5, 'Tomatoe Pie\r\n', 'pizza', 'pizza', 'pizza-5.jpg', '50', 0, 'meal', 0),
(6, 'Margherita', 'pizza', 'pizza with cheese and onion', 'pizza-6.jpg', '80', 0, 'meal', 0),
(7, 'Ham & Pineapple', 'pizza', 'pizza with cheese and onion', 'pizza-7.jpg', '85', 0, 'meal', 0),
(8, 'Ultimate Overload', 'pizza', 'pizza with cheese and onion', 'pizza-8.jpg', '80', 0, 'meal', 0),
(9, 'pasta', 'pasta', 'pasta', 'pasta-1.jpg', '60', 0, 'meal', 0),
(10, 'pasta', 'pasta', 'pasta', 'pasta-2.jpg', '70', 0, 'meal', 0),
(11, 'pasta', 'pasta', 'pasta', 'pasta-3.jpg', '50', 0, 'meal', 0),
(12, 'Lemonade Juice', 'drink', 'drink', 'drink-1.jpg', '20', 0, 'drink', 0),
(13, 'Pineapple Juice', 'drink', 'drink', 'drink-2.jpg', '20', 0, 'drink', 0),
(14, 'Soda Drinks', 'drink', 'drink', 'drink-3.jpg', '20', 0, 'drink', 0),
(15, 'drink', 'drink', 'drink', 'drink-4.jpg', '20', 0, 'drink', 0),
(16, 'drink', 'drink', 'drink', 'drink-5.jpg', '20', 0, 'drink', 0),
(17, 'drink', 'drink', 'drink', 'drink-6.jpg', '20', 0, 'drink', 0),
(18, 'drink', 'drink', 'drink', 'drink-7.jpg', '20', 0, 'drink', 0),
(19, 'drink', 'drink', 'drink', 'drink-8.jpg', '20', 0, 'drink', 0),
(20, 'drink', 'drink', 'drink', 'drink-9.jpg', '20', 0, 'drink', 0),
(21, 'Itallian burger ', 'burger', 'burger', 'burger-1.jpg', '60', 0, 'meal', 0),
(22, 'Hawaiian burger', 'burger', 'burger', 'burger-2.jpg', '60', 0, 'meal', 0),
(23, 'burger', 'burger', 'burger', 'burger-3.jpg', '60', 0, 'meal', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
