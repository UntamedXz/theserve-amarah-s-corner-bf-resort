-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2022 at 06:40 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theserve-amarah-s-corner-db`
--
CREATE DATABASE IF NOT EXISTS `theserve-amarah-s-corner-db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `theserve-amarah-s-corner-db`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(255) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `admin_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_email`, `admin_password`) VALUES
(1, 'jovy', 'jovelyn.ocampo@cvsu.edu.ph', 'jovyyy');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_qty` int(11) DEFAULT NULL,
  `product_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `cart_id`, `category_id`, `subcategory_id`, `product_id`, `product_qty`, `product_total`) VALUES
(8, 26, 2, 0, 37, 1, '129.00'),
(8, 27, 2, 0, 37, 1, '129.00'),
(8, 28, 2, 0, 37, 1, '129.00'),
(8, 29, 2, 0, 37, 1, '129.00'),
(8, 30, 2, 0, 37, 1, '129.00'),
(2, 31, 2, 0, 38, 5, '645.00'),
(2, 32, 1, 2, 25, 2, '398.00'),
(2, 33, 21, 13, 50, 5, '400.00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(255) DEFAULT NULL,
  `categoty_thumbnail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_title`, `categoty_thumbnail`) VALUES
(1, 'Pizza', '628d243bf079e.png'),
(2, 'Chicken Wings', '628655e6eb31f-wings.png'),
(3, 'Pasta ', '628d24768fdc2.png'),
(4, 'Cheesy Snacks', '628656d4224d5-cheesy.png'),
(5, 'Milk Tea', '62865c1cde79d-milktea.png'),
(10, 'Coffee', '62865e94d281a-hotCoffee.png'),
(21, 'Refreshing Drinks', '6298ba65b8b3b.png');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'KayeB', 'kaye.billones@cvsu.edu.ph', 'kayeeeb'),
(2, 'untamed', 'untamedandromeda@gmail.com', 'untamed_jenn'),
(3, 'markyyy', 'markryan.jancorda@cvsu.edu.ph', 'markyyyboy'),
(4, 'kenetBiot', 'kenneth.estabillo@cvsu.edu.ph', 'kenetbiot'),
(5, 'jess', 'jessica.capoquian@cvsu.edu.ph', 'jessica.capoquian'),
(6, 'kamil', 'camille.tubo@cvsu.edu.ph', 'camille.tubo'),
(7, 'nikol', 'nicolekay.anacleto@cvsu.edu.ph', 'nicolekay.anacleto'),
(8, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `default_product_variation`
--

CREATE TABLE `default_product_variation` (
  `default_variation_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_variation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) DEFAULT NULL,
  `product_slug` varchar(255) DEFAULT NULL,
  `product_img1` varchar(255) DEFAULT NULL,
  `product_img2` varchar(255) DEFAULT NULL,
  `product_img3` varchar(255) DEFAULT NULL,
  `product_keyword` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_sale` varchar(255) DEFAULT NULL,
  `product_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`category_id`, `subcategory_id`, `product_id`, `product_title`, `product_slug`, `product_img1`, `product_img2`, `product_img3`, `product_keyword`, `product_price`, `product_sale`, `product_status`) VALUES
(1, 2, 7, 'Ham & Cheese', 'ham-cheese', '6292ebfd901ff.jpg', NULL, NULL, 'Ham & Cheese', '129.00', '', NULL),
(4, 0, 8, 'Cheesy Fries', 'cheesy-fries', '62937e2f83136.jpg', NULL, NULL, 'Cheesy Fries', '130.00', '', NULL),
(4, 0, 9, 'Cheesy Nachos', 'cheesy-nachos', '6293811ba42ed.jpg', NULL, NULL, 'Cheesy Nachos', '130.00', '', NULL),
(3, 0, 10, 'Saucy Spaghetti', 'saucy-spaghetti', '6293867d16ba1.jpg', NULL, NULL, 'Saucy Spaghetti', '119.00', '', NULL),
(3, 0, 11, 'Creamy Carbonara', 'creamy-carbonara', '6293870491837.jpg', NULL, NULL, 'Creamy Carbonara', '119.00', '', NULL),
(5, 7, 13, 'Classic Milktea', 'classic-milktea', '6294534c7dff1.jpg', NULL, NULL, 'Classic Milktea', '90.00', '', NULL),
(5, 7, 14, 'Taro Milktea', 'taro-milktea', '629453b16d9a7.jpg', NULL, NULL, 'Taro Milktea', '90.00', '', NULL),
(5, 7, 15, 'Vanilla Milktea', 'vanilla-milktea', '629454397c7e9.jpg', NULL, NULL, 'Vanilla Milktea', '90.00', '', NULL),
(5, 7, 16, 'Okinawa Milktea', 'okinawa-milktea', '629454d6aacd9.jpg', NULL, NULL, 'Okinawa Milktea', '100.00', '', NULL),
(5, 7, 17, 'Wintermelon Milktea', 'wintermelon-milktea', '6294553abc77b.jpg', NULL, NULL, 'Wintermelon Milktea', '90.00', '', NULL),
(5, 7, 18, 'Dark Chocolate Milktea', 'dark-chocolate-milktea', '62945599ad0d0.jpg', NULL, NULL, 'Dark Chocolate Milktea', '95.00', '', NULL),
(5, 7, 19, 'Cookies & Cream Milktea', 'cookies-cream-milktea', '629462738203e.jpg', NULL, NULL, 'Cookies & Cream Milktea', '100.00', '', NULL),
(5, 7, 20, 'Double Dutch Milktea', 'double-dutch-milktea', '629462beee633.jpg', NULL, NULL, 'Double Dutch Milktea', '95.00', '', NULL),
(1, 2, 25, 'Hawaiian Pizza', 'hawaiian-pizza', '6294c1d06cf4e.jpg', NULL, NULL, 'Hawaiian Pizza', '199.00', '', NULL),
(1, 2, 26, 'Beef & Mushroom Pizza', 'beef-mushroom-pizza', '6294c2081e8bb.jpg', NULL, NULL, 'Beef & Mushroom Pizza', '199.00', '', NULL),
(1, 2, 27, 'Pepperoni Pizza', 'pepperoni-pizza', '6294c22d5cd69.jpg', NULL, NULL, 'Pepperoni Pizza', '199.00', '', NULL),
(1, 3, 28, 'Pepperoni Overload Pizza', 'pepperoni-overload-pizza', '6294c25a50468.jpg', NULL, NULL, 'Pepperoni Overload Pizza', '249.00', '', NULL),
(1, 3, 29, 'Beef & Mushroom Overload Pizza', 'beef-mushroom-overload-pizza', '6294c278a7656.jpg', NULL, NULL, 'Beef & Mushroom Overload Pizza', '249.00', '', NULL),
(1, 3, 30, 'Bacon & Ham Pizza', 'bacon-ham-pizza', '6294c29ce9644.jpg', NULL, NULL, 'Bacon & Ham Pizza', '249.00', '', NULL),
(1, 3, 31, 'Triple Cheese Pizza', 'triple-cheese-pizza', '6294c2b6586d8.jpg', NULL, NULL, 'Triple Cheese Pizza', '249.00', '', NULL),
(1, 3, 32, 'All Meat Pizza', 'all-meat-pizza', '6294c2d1c1ece.jpg', NULL, NULL, 'All Meat Pizza', '249.00', '', NULL),
(1, 3, 33, 'Creamcheese Supreme Pizza', 'creamcheese-supreme-pizza', '6294c2ec1c0bd.jpg', NULL, NULL, 'Creamcheese Supreme Pizza', '249.00', '', NULL),
(1, 3, 34, 'Spinach Overload Pizza', 'spinach-overload-pizza', '6294c30304d5d.jpg', NULL, NULL, 'Spinach Overload Pizza', '249.00', '', NULL),
(2, 0, 36, 'Honey Garlic', 'honey-garlic', '6294c39181159.jpg', NULL, NULL, 'Honey Garlic', '129.00', '', NULL),
(2, 0, 37, 'Buffalo', 'buffalo', '6294c48d360a2.jpg', NULL, NULL, 'Buffalo', '129.00', '', NULL),
(2, 0, 38, 'Garlic Parmesan', 'garlic-parmesan', '6294c4fb394d6.jpg', NULL, NULL, 'Garlic Parmesan', '129.00', '', NULL),
(2, 0, 39, 'Buttered Garlic', 'buttered-garlic', '6294c524d2114.jpg', NULL, NULL, 'Buttered Garlic', '129.00', '', NULL),
(2, 0, 40, 'Salted Egg', 'salted-egg', '6294c5450b238.jpg', NULL, NULL, 'Salted Egg', '129.00', '', NULL),
(21, 13, 47, 'Strawberry Jasmine', 'strawberry-jasmine', NULL, NULL, NULL, 'Strawberry Jasmine', '80.00', '', NULL),
(21, 13, 48, 'Green Apple Jasmine', 'green-apple-jasmine', NULL, NULL, NULL, 'green apple jasmine', '80.00', '', NULL),
(21, 13, 49, 'Blueberry Jasmine', 'blueberry-jasmine', NULL, NULL, NULL, 'Blueberry Jasmine', '80.00', '', NULL),
(21, 13, 50, 'Mango Jasmine', 'mango-jasmine', NULL, NULL, NULL, 'mango jasmine', '80.00', '', NULL),
(21, 13, 51, 'Passionfruit Jasmine', 'passionfruit-jasmine', NULL, NULL, NULL, 'passionfruit jasmine', '80.00', '', NULL),
(21, 14, 52, 'Strawberry Lemonade', 'strawberry-lemonade', NULL, NULL, NULL, 'strawberry lemonade', '140.00', '', NULL),
(21, 14, 53, 'Passionfruit Lemonade', 'passionfruit-lemonade', NULL, NULL, NULL, 'passionfruit lemonade', '140.00', '', NULL),
(21, 14, 54, 'Cucumber Lemonade', 'cucumber-lemonade', NULL, NULL, NULL, 'cucumber lemonade', '140.00', '', NULL),
(21, 14, 55, 'Blueberry Lemonade', 'blueberry-lemonade', NULL, NULL, NULL, 'blueberry lemonade', '140.00', '', NULL),
(21, 14, 56, 'Green Apple Lemonade', 'green-apple-lemonade', NULL, NULL, NULL, 'green apple lemonade', '140.00', '', NULL),
(21, 15, 57, 'Avocado Cheesecake', 'avocado-cheesecake', NULL, NULL, NULL, 'avocado cheesecake', '159.00', '', NULL),
(21, 15, 58, 'Strawberry Cheesecake', 'strawberry-cheesecake', NULL, NULL, NULL, 'strawberry cheesecake', '159.00', '', NULL),
(21, 15, 59, 'Blueberry Cheesecake', 'blueberry-cheesecake', NULL, NULL, NULL, 'blueberry cheesecake', '159.00', '', NULL),
(21, 15, 60, 'Mango Cheesecake', 'mango-cheesecake', NULL, NULL, NULL, 'mango cheesecake', '159.00', '', NULL),
(21, 15, 61, 'Vanilla Cheesecake', 'vanilla-cheesecake', NULL, NULL, NULL, 'vanilla cheesecake', '159.00', '', NULL),
(21, 16, 62, 'Strawberry Queen', 'strawberry-queen', NULL, NULL, NULL, 'strawberry queen', '130.00', '', NULL),
(21, 16, 63, 'Avocado Delight', 'avocado-delight', NULL, NULL, NULL, 'avocado delight', '130.00', '', NULL),
(21, 16, 64, 'Taro', 'taro', NULL, NULL, NULL, 'taro', '130.00', '', NULL),
(21, 16, 65, 'Matcha', 'matcha', NULL, NULL, NULL, 'matcha', '130.00', '', NULL),
(21, 16, 66, 'Milo Dino', 'milo-dino', NULL, NULL, NULL, 'milo dino', '130.00', '', NULL),
(5, 7, 67, 'Matcha Milktea', 'matcha-milktea', NULL, NULL, NULL, 'matcha milktea', '90.00', '', NULL),
(5, 12, 68, 'Classic Brown Sugar', 'classic-brown-sugar', NULL, NULL, NULL, 'classic brown sugar', '125.00', '', NULL),
(5, 12, 69, 'House Blend Wintermelon', 'house-blend-wintermelon', NULL, NULL, NULL, 'house blend wintermelon', '125.00', '', NULL),
(5, 12, 70, 'White Rabbit', 'white-rabbit', NULL, NULL, NULL, 'white rabbit', '125.00', '', NULL),
(5, 12, 71, 'Red Velvet Cheesecake Milktea', 'red-velvet-cheesecake-milktea', '6298da3b90311.jpg', NULL, NULL, 'Red Velvet Cheesecake Milktea', '125.00', '', NULL),
(5, 12, 72, 'Milky Taro', 'milky-taro', NULL, NULL, NULL, 'milky taro', '125.00', '', NULL),
(5, 12, 73, 'Overload Oreo Cheesecake Milktea', 'overload-oreo-cheesecake-milktea', '6298df277ef0f.jpg', NULL, NULL, 'Overload Oreo Cheesecake Milktea', '125.00', '', NULL),
(5, 12, 74, 'Choco Lava Milktea', 'choco-lava-milktea', '6298df556cef5.jpg', NULL, NULL, 'Choco Lava Milktea', '125.00', '', NULL),
(10, 4, 75, 'Americano', 'americano', NULL, NULL, NULL, 'americano', '145.00', '', NULL),
(10, 4, 76, 'Espresso', 'espresso', NULL, NULL, NULL, 'espresso', '145.00', '', NULL),
(10, 4, 77, 'Mocha', 'mocha', NULL, NULL, NULL, 'mocha', '145.00', '', NULL),
(10, 4, 78, 'Vanilla Latte', 'vanilla-latte', NULL, NULL, NULL, 'vanilla latte', '145.00', '', NULL),
(10, 4, 79, 'Hazelnut Latte', 'hazelnut-latte', NULL, NULL, NULL, 'hazelnut latte', '145.00', '', NULL),
(10, 4, 80, 'Capuccino', 'capuccino', NULL, NULL, NULL, 'capuccino', '145.00', '', NULL),
(10, 5, 81, 'Spanish Cold Brew', 'spanish-cold-brew', NULL, NULL, NULL, 'spanish cold brew', '130.00', '', NULL),
(10, 5, 82, 'Iced Latte', 'iced-latte', NULL, NULL, NULL, 'iced latte', '130.00', '', NULL),
(10, 5, 83, 'Iced Mocha', 'iced-mocha', NULL, NULL, NULL, 'iced mocha', '130.00', '', NULL),
(10, 5, 84, 'Iced Vanilla', 'iced-vanilla', NULL, NULL, NULL, 'iced vanilla', '130.00', '', NULL),
(10, 5, 85, 'Iced Hazelnut', 'iced-hazelnut', NULL, NULL, NULL, 'iced hazelnut', '130.00', '', NULL),
(10, 5, 86, 'Iced Caramel', 'iced-caramel', NULL, NULL, NULL, 'iced caramel', '130.00', '', NULL),
(10, 6, 87, 'Vanilla', 'vanilla', NULL, NULL, NULL, 'vanilla', '150.00', '', NULL),
(10, 6, 88, 'Red Velvet', 'red-velvet', NULL, NULL, NULL, 'red velvet', '150.00', '', NULL),
(10, 6, 89, 'Java Chips', 'java-chips', NULL, NULL, NULL, 'java chips', '150.00', '', NULL),
(10, 6, 90, 'Choco Fudge', 'choco-fudge', NULL, NULL, NULL, 'choco fudge', '150.00', '', NULL),
(10, 6, 91, 'Oreo Delight', 'oreo-delight', NULL, NULL, NULL, 'oreo delight', '150.00', '', NULL),
(10, 6, 92, 'Coffee Jelly', 'coffee-jelly', NULL, NULL, NULL, 'coffee jelly', '150.00', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `variant_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_variant`
--

CREATE TABLE `product_variant` (
  `variant_id` int(11) NOT NULL,
  `variant_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_variant`
--

INSERT INTO `product_variant` (`variant_id`, `variant_title`) VALUES
(1, 'SIZE'),
(2, 'FLAVOR');

-- --------------------------------------------------------

--
-- Table structure for table `product_variation`
--

CREATE TABLE `product_variation` (
  `product_id` int(11) DEFAULT NULL,
  `product_variation_id` int(11) NOT NULL,
  `product_variation_code` int(11) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_sale` decimal(10,2) DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `product_variation_status` varchar(255) DEFAULT NULL,
  `default_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `subcategory_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`category_id`, `subcategory_id`, `subcategory_title`) VALUES
(1, 2, 'Classic Flavor'),
(1, 3, 'Special Flavor'),
(10, 4, 'Hot Coffee'),
(10, 5, 'Cold Coffee'),
(10, 6, 'Frappe'),
(5, 7, 'Classic Series'),
(5, 12, 'Special Series'),
(21, 13, 'Fruit Tea'),
(21, 14, 'Lemonade'),
(21, 15, 'Cheesecake Series'),
(21, 16, 'Milkshake');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `default_product_variation`
--
ALTER TABLE `default_product_variation`
  ADD PRIMARY KEY (`default_variation_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`attribute_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD PRIMARY KEY (`variant_id`);

--
-- Indexes for table `product_variation`
--
ALTER TABLE `product_variation`
  ADD PRIMARY KEY (`product_variation_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD KEY `subcategory_ibfk_1` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `default_product_variation`
--
ALTER TABLE `default_product_variation`
  MODIFY `default_variation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variant`
--
ALTER TABLE `product_variant`
  MODIFY `variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_variation`
--
ALTER TABLE `product_variation`
  MODIFY `product_variation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`subcategory_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD CONSTRAINT `product_attribute_ibfk_1` FOREIGN KEY (`variant_id`) REFERENCES `product_variant` (`variant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_variation`
--
ALTER TABLE `product_variation`
  ADD CONSTRAINT `product_variation_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
