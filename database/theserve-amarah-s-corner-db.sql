-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 08:10 AM
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
  `admin_name` varchar(255) DEFAULT NULL,
  `admin_username` varchar(255) DEFAULT NULL,
  `admin_phone_number` varchar(255) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `admin_password` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `admin_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_username`, `admin_phone_number`, `admin_email`, `admin_password`, `profile_image`, `admin_type`) VALUES
(3, 'Jovelyn Ocampo', 'jovy.ocampo', '09364871637', 'jovelyn.ocampo@cvsu.edu.ph', '$2y$10$17Yg/icchirlCNiC9Jsgju9T73O.k0xNnf6YaK18ZL2O.icjHKKcC', '62a2af4d4add0.jpg', 1),
(5, 'Eramie Metre', 'era.metre', '09423532536', 'eramie.metre@cvsu.edu.ph', '$2y$10$/wxP61DoA6zozs4GiuYt1eflkawPqVCaXjSLjVT.FA/xRSA8q/kJu', '62a2c79cbfbd1.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `admin_type`
--

CREATE TABLE `admin_type` (
  `admin_type_id` int(11) NOT NULL,
  `admin_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_type`
--

INSERT INTO `admin_type` (`admin_type_id`, `admin_type`) VALUES
(1, 'admin'),
(2, 'staff');

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
(1, 'Pasta', '629e3fab89c02.png'),
(2, 'Milktea', '629e3fc513386.png'),
(3, 'Pizza', '629e40015781f.png'),
(4, 'Chicken Wings', '629e4018c89ea.png'),
(5, 'Coffee', '629e4025508bd.png'),
(6, 'Refreshing Drinks', '629e403931a3e.png'),
(7, 'Cheesy Snacks', '629e404e7693f.png');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(11) DEFAULT NULL,
  `user_birthday` date DEFAULT NULL,
  `user_gender` varchar(255) DEFAULT NULL,
  `user_profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`user_id`, `name`, `username`, `email`, `password`, `phone_number`, `user_birthday`, `user_gender`, `user_profile_image`) VALUES
(1, 'Jennifer Sabado', 'Untamed Jenn', 'jennsabado22@gmail.com', '$2y$10$V0ztPibW3j945gCLYnMmveVkkaVwRJ2QEaGae8rjJ1lXsJrNpF9S2', '', '2000-12-22', 'FEMALE', '62a1bd4124e09.jpg'),
(2, 'Kaye Billones', 'Kayeb', 'kaye.billones@cvsu.edu.ph', '$2y$10$L.qh5xo/3IKxWhBt8Tv0P.SruPyt2NAdPkKscPooPFRUKjD2fZ1QO', NULL, '0000-00-00', '', '62a324f492f48.jpg'),
(3, NULL, 'xborg', 'xborg@gmail.com', '$2y$10$KZMh0q6SHtnjqqyMmJ8dtuOmVfPlmsSfjNkJv7.PY1.0AvwnoNK.y', NULL, NULL, NULL, '62a3642db9bd4.png'),
(4, NULL, 'kenet.biot', 'kenneth.estabillo@cvsu.edu.ph', '$2y$10$QqfFSxki/gJvhweblAAR9uXfziW6tpa2J58sw8qU9JtjaVD33Kvmi', NULL, NULL, NULL, NULL),
(5, 'Jennifer Sabado', 'Jennifer Sabado', 'untamedandromeda@gmail.com', '$2y$10$rztrpsu9L9r01set6RsZ/eCa/ue7vS4f.97gPIvbi7/rmvUmErn9u', NULL, '0000-00-00', '', '62a39fdf3f5f2.jpg'),
(6, NULL, 'jomarc.bapor', 'jomarc.bapor@cvsu.edu.ph', '$2y$10$vIpyxdOcwnYrFvGVK.RWQuZfG7DbIwscnjMdePdO2fQlE2/HVVpwu', NULL, NULL, NULL, NULL),
(7, NULL, 'paul.cayago', 'pauladrian.cayago@cvsu.edu.ph', '$2y$10$Poh2ckabupi8srKHOLAJAe7ve3gvJ0nVqkfeIp36x.ARpCcnGpFRi', NULL, NULL, NULL, NULL),
(8, NULL, 'Nicole Kay', 'nicolekay.anacleto@cvsu.edu.ph', '$2y$10$4oKN3JGzgkpuAFeiJbWwC./eGItFV.hDhdXCYAZMnxVDmAne/lUG2', NULL, NULL, NULL, NULL),
(9, NULL, 'Jessica Capoquian', 'jessica.capoquian@cvsu.edu.ph', '$2y$10$dOFC5k4/DWw4h1zVxL7lWOZ1MFHGZXndNJRTDO67tw0eVRiGGJcNG', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(11) NOT NULL,
  `delivery_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `delivery_title`) VALUES
(1, 'Pick Up'),
(2, 'Delivery via Lalamove'),
(3, 'Delivery within BF');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  `delivery_method` int(11) DEFAULT NULL,
  `shipping_fee` varchar(255) DEFAULT NULL,
  `screenshot_payment` varchar(255) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `order_total` varchar(255) DEFAULT NULL,
  `order_date` varchar(255) DEFAULT NULL,
  `order_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `payment_method`, `delivery_method`, `shipping_fee`, `screenshot_payment`, `reference`, `order_total`, `order_date`, `order_status`) VALUES
(41, 1, 1, 2, '200.00', NULL, NULL, '1157.00', 'June 10, 2022 06:44 PM', 5),
(42, 2, 1, 1, '0.00', NULL, NULL, '1943.00', 'June 10, 2022 07:08 PM', 5),
(43, 1, 1, 2, '200.00', NULL, NULL, '1048.00', 'June 11, 2022 01:56 AM', 2),
(45, 2, 1, 2, '200.00', NULL, NULL, '489.00', 'June 11, 2022 03:41 AM', 3),
(46, 4, 1, 2, '200.00', NULL, NULL, '489.00', 'June 11, 2022 03:45 AM', 4),
(47, 5, 1, 2, '200.00', NULL, NULL, '1067.00', 'June 11, 2022 03:48 AM', 5),
(48, 6, 1, 1, '0.00', NULL, NULL, '578.00', 'June 11, 2022 03:52 AM', 2),
(49, 7, 1, 1, '0.00', NULL, NULL, '289.00', 'June 11, 2022 03:58 AM', 2),
(53, 8, 1, 2, '200.00', NULL, NULL, '688.00', 'June 11, 2022 11:57 AM', 1),
(54, 8, 1, 2, '200.00', NULL, NULL, '399.00', 'June 11, 2022 12:00 PM', 1),
(55, 1, 1, 2, '200.00', NULL, NULL, '399.00', 'June 11, 2022 12:01 PM', 1),
(56, 9, 1, 1, '0.00', NULL, NULL, '289.00', 'June 11, 2022 12:04 PM', 1),
(57, 5, 1, 2, '200.00', NULL, NULL, '939.00', 'June 11, 2022 12:14 PM', 1),
(58, 5, 1, 2, '200.00', NULL, NULL, '939.00', 'June 11, 2022 12:14 PM', 1),
(59, 1, 1, 2, '200.00', NULL, NULL, '399.00', 'June 11, 2022 10:59 PM', 5),
(60, 1, 1, 1, '0.00', NULL, NULL, '90.00', 'June 11, 2022 11:10 PM', 5),
(61, 1, 1, 2, '200.00', NULL, NULL, '290.00', 'June 12, 2022 09:20 PM', 1),
(62, 1, 1, 2, '200.00', NULL, NULL, '778.00', 'June 12, 2022 09:33 PM', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `order_address_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `billing_name` varchar(255) DEFAULT NULL,
  `billing_number` varchar(11) DEFAULT NULL,
  `block_street_building` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city_municipality` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`order_address_id`, `order_id`, `billing_name`, `billing_number`, `block_street_building`, `province`, `city_municipality`, `barangay`) VALUES
(27, 41, 'Jennifer Sabado', '09162622138', 'Block 130, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(28, 42, 'Kaye Billones', '09423642846', 'Block 140, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(29, 43, 'Jennifer Sabado', '09542522353', 'Block 130, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(31, 45, 'Kaye Billones', '09162622138', 'Block 140, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(32, 46, 'Kenneth Estabillo', '09542522353', 'Block 141, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(33, 47, 'Jennifer Sabado', '09162622138', 'Block 130, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(34, 48, 'Jomarc Bapor', '09423642846', 'Block 145, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(35, 49, 'Paul Adrian Cayago', '09542522353', 'Block 132, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(39, 53, 'Nicole Kay Anacleto', '09656526546', 'Block 127, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(40, 54, 'Nicole Kay Anacleto', '09542522353', 'Block 127, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(41, 55, 'Jennifer Sabado', '09423642846', 'Block 130, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(42, 56, 'Jessica Capoquian', '09423642846', 'Block 120, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(43, 57, 'Jennifer Sabado', '09542522353', 'Block 130, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(44, 58, 'Jennifer Sabado', '09542522353', 'Block 130, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(45, 59, 'Jennifer Sabado', '09915362419', 'Block 130, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(46, 60, 'Jennifer Sabado', '09915362419', 'Block 130, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(47, 61, 'Jennifer Sabado', '09915362419', 'Block 130, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III'),
(48, 62, 'Jennifer Sabado', '09915362419', 'Block 130, Bagong Kampi St., Green Valley', 'Cavite', 'Bacoor', 'San Nicolas III');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_items_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `product_total` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `subcategory_id`, `qty`, `product_total`) VALUES
(55, 41, 1, 0, '3', '597.00'),
(56, 41, 3, 1, '4', '360.00'),
(57, 42, 9, 4, '2', '498.00'),
(58, 42, 5, 1, '5', '450.00'),
(59, 42, 1, 0, '5', '995.00'),
(60, 43, 5, 1, '5', '450.00'),
(61, 43, 8, 3, '2', '398.00'),
(63, 45, 1, 0, '1', '199.00'),
(64, 45, 5, 1, '1', '90.00'),
(65, 46, 1, 0, '1', '199.00'),
(66, 46, 5, 1, '1', '90.00'),
(67, 47, 5, 1, '3', '270.00'),
(68, 47, 8, 3, '3', '597.00'),
(69, 48, 1, 0, '2', '398.00'),
(70, 48, 3, 1, '2', '180.00'),
(71, 49, 1, 0, '1', '199.00'),
(72, 49, 5, 1, '1', '90.00'),
(75, 54, 1, 0, '1', '199.00'),
(76, 55, 1, 0, '1', '199.00'),
(77, 56, 4, 1, '1', '90.00'),
(78, 56, 8, 3, '1', '199.00'),
(79, 57, 1, 0, '1', '199.00'),
(80, 57, 5, 1, '1', '90.00'),
(81, 57, 2, 3, '1', '450.00'),
(82, 59, 1, 0, '1', '199.00'),
(83, 60, 4, 1, '1', '90.00'),
(84, 61, 5, 1, '1', '90.00'),
(85, 62, 7, 3, '2', '398.00'),
(86, 62, 5, 1, '2', '180.00');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL,
  `order_status_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `order_status_name`) VALUES
(1, 'Pending'),
(2, 'Order Confirmed'),
(3, 'Preparing'),
(4, 'To be Received'),
(5, 'Order Delivered'),
(6, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_title`) VALUES
(1, 'Cash on Delivery'),
(2, 'Gcash');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) DEFAULT NULL,
  `product_desc` varchar(255) DEFAULT NULL,
  `product_slug` varchar(255) DEFAULT NULL,
  `product_img1` varchar(255) DEFAULT NULL,
  `product_img2` varchar(255) DEFAULT NULL,
  `product_img3` varchar(255) DEFAULT NULL,
  `product_keyword` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_sale` varchar(255) DEFAULT NULL,
  `product_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`category_id`, `subcategory_id`, `product_id`, `product_title`, `product_desc`, `product_slug`, `product_img1`, `product_img2`, `product_img3`, `product_keyword`, `product_price`, `product_sale`, `product_status`) VALUES
(1, NULL, 1, 'Saucy Spaghetti', 'Spaghetti with sauce', 'saucy-spaghetti', '629e4286ae190.jpg', NULL, NULL, 'Saucy Spaghetti', '199.00', '', 2),
(3, 3, 2, 'Hawaiian Pizza', 'Pizza from Hawaii', 'hawaiian-pizza', '629e42d5081f3.jpg', NULL, NULL, 'Hawaiian Pizza', '450.00', '', 2),
(2, 1, 3, 'Classic Milktea', '', 'classic-milktea', '629e479a1d05a.jpg', NULL, NULL, 'Classic Milktea', '90.00', '', 2),
(2, 1, 4, 'Taro Milktea', '', 'taro-milktea', '629e48270621a.jpg', NULL, NULL, 'Taro milktea', '90.00', '', 1),
(2, 1, 5, 'Vanilla Milktea', '', 'vanilla-milktea', '629e485e4a0f0.jpg', NULL, NULL, 'Vanilla Milktea', '90.00', '', 1),
(3, 3, 6, 'Pepperoni Pizza', '', 'pepperoni-pizza', '62a1717836410.jpg', NULL, NULL, 'Pepperoni Pizza', '199.00', '', 1),
(3, 3, 7, 'Beef & Mushroom Pizza', '', 'beef-mushroom-pizza', '62a171ac5085c.jpg', NULL, NULL, 'Beef & Mushroom Pizza', '199.00', '', 1),
(3, 3, 8, 'Ham & Cheese', '', 'ham-cheese', '62a171decb3fa.jpg', NULL, NULL, 'Ham & Cheese', '199.00', '', 1),
(3, 4, 9, 'Beef & Mushroom Overload', 'Loaded with beef, mushroom, pineapple, onion & bellpepper plus mozarella cheese', 'beef-mushroom-overload', '62a2cbaf50695.jpg', NULL, NULL, 'Beef & Mushroom Overload', '249.00', '', 1),
(4, NULL, 10, 'Buffalo', '', 'buffalo', '62a6cfe3e90aa.jpg', NULL, NULL, 'Buffalo', '168.00', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `product_id` int(11) DEFAULT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_status`
--

CREATE TABLE `product_status` (
  `product_status_id` int(11) NOT NULL,
  `product_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_status`
--

INSERT INTO `product_status` (`product_status_id`, `product_status`) VALUES
(1, 'AVAILABLE'),
(2, 'NOT AVAILABLE');

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
(1, 'FLAVOR'),
(6, 'SIZE'),
(7, 'ADDONS');

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
(2, 1, 'Classic Series'),
(2, 2, 'Special Series'),
(3, 3, 'Classic Flavor'),
(3, 4, 'Special Flavor'),
(5, 7, 'Cold Coffee'),
(5, 8, 'Hot Coffee'),
(5, 9, 'Frappe'),
(6, 10, 'Fruit Tea'),
(6, 11, 'Lemonade'),
(2, 12, 'Classic Flavor');

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `updates_id` int(11) NOT NULL,
  `updates_text` varchar(900) DEFAULT NULL,
  `updates_image` varchar(255) DEFAULT NULL,
  `updates_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `updates`
--

INSERT INTO `updates` (`updates_id`, `updates_text`, `updates_image`, `updates_date`) VALUES
(5, 'Some days, you just need a sweet sip of cool coffee to make you feel better. ☕ ORDER NOW!\r\n\r\nWE DELIVER ❗❗\r\n?0908-812-6310\r\n⏰ 11:00am-3:00amI Daily\r\n? Amarah\'s Corner BF Resort\r\nB5 L71 JB TAN ST BF RESORT VILLAGE TALON DOS LAS PINAS\r\n✔️Dine-In\r\n✔️Takeout\r\n✔️Delivery\r\n✔️Pick-Up\r\n✔️Advance Order\r\nMessage us to Order!\r\n( FREE DELIVERY WITHIN BF RESORT VILLAGE)\r\n#amarahscornerbf\r\n#chickenwings\r\n#pizza\r\n#milktea\r\n#coffee', '62a67281c7cff.jpg', 'June 13, 2022'),
(6, 'Netflix & chill? We\'re chilling with this combo you need to try! Message us to order.\r\nWE DELIVER ❗❗\r\n?0908-812-6310\r\n⏰ 11:00am-3:00amI Daily\r\n? Amarah\'s Corner BF Resort\r\nB5 L71 JB TAN ST BF RESORT VILLAGE TALON DOS LAS PINAS\r\n✔️Dine-In\r\n✔️Takeout\r\n✔️Delivery\r\n✔️Pick-Up\r\n✔️Advance Order\r\nMessage us to Order!\r\n( FREE DELIVERY WITHIN BF RESORT VILLAGE)\r\n#amarahscornerbf\r\n#chickenwings\r\n#pizza\r\n#milktea\r\n#coffee', '62a677b76208b.jpg', 'June 13, 2022'),
(7, 'Another acoustic jam session here at Amarah\'s Corner - Bf Resort x Lando\'s this coming Wednesday to Sunday at 8pm. See you! ?', '62a6782ac0b3f.jpg', 'June 13, 2022'),
(9, 'Have this great food as your company with your busy schedule this Monday! Message us to order. ?\r\nCREAM CHEESE SUPREME 12\" PHP 289 | 10\" PHP 249\r\nWE DELIVER ❗❗\r\n?0908-812-6310\r\n⏰ 11:00am-3:00am I Daily\r\n? Amarah\'s Corner BF Resort\r\nB5 L71 JB TAN ST BF RESORT VILLAGE TALON DOS LAS PINAS\r\n✔️Dine-In\r\n✔️Takeout\r\n✔️Delivery\r\n✔️Pick-Up\r\n✔️Advance Order\r\nMessage us to Order!\r\n( FREE DELIVERY WITHIN BF RESORT VILLAGE)\r\n#amarahscornerbf\r\n#chickenwings\r\n#pizza\r\n#milktea\r\n#coffee', '62a6aa2546311.jpg', 'June 13, 2022');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_type` (`admin_type`);

--
-- Indexes for table `admin_type`
--
ALTER TABLE `admin_type`
  ADD PRIMARY KEY (`admin_type_id`);

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
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `payment_method` (`payment_method`),
  ADD KEY `delivery_method` (`delivery_method`),
  ADD KEY `order_status` (`order_status`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`order_address_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_items_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `product_status` (`product_status`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`attribute_id`),
  ADD KEY `variant_id` (`variant_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_status`
--
ALTER TABLE `product_status`
  ADD PRIMARY KEY (`product_status_id`);

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
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`updates_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_type`
--
ALTER TABLE `admin_type`
  MODIFY `admin_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `order_address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_status`
--
ALTER TABLE `product_status`
  MODIFY `product_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_variant`
--
ALTER TABLE `product_variant`
  MODIFY `variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_variation`
--
ALTER TABLE `product_variation`
  MODIFY `product_variation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `updates_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`admin_type`) REFERENCES `admin_type` (`admin_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`payment_method`) REFERENCES `payment` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`delivery_method`) REFERENCES `delivery` (`delivery_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`order_status`) REFERENCES `order_status` (`order_status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`subcategory_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`product_status`) REFERENCES `product_status` (`product_status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD CONSTRAINT `product_attribute_ibfk_1` FOREIGN KEY (`variant_id`) REFERENCES `product_variant` (`variant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attribute_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
