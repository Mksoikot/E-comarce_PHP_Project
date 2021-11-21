-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2021 at 04:50 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ctg_id` int(11) NOT NULL,
  `ctg_name` varchar(50) NOT NULL,
  `ctg_dess` varchar(50) NOT NULL,
  `ctg_status` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ctg_id`, `ctg_name`, `ctg_dess`, `ctg_status`) VALUES
(14, 'Apple', 'Its Best Collection', 1),
(15, 'Orange', 'Its Best Collection', 1),
(16, 'Banana', 'Its Best Food In The World', 1),
(17, 'Fruit', 'Its Best Collection', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pdt_id` int(255) NOT NULL,
  `pdt_name` varchar(255) NOT NULL,
  `pdt_price` int(50) NOT NULL,
  `pdt_des` varchar(200) NOT NULL,
  `pdt_ctg` int(200) NOT NULL,
  `pdt_image` varchar(250) NOT NULL,
  `pdt_status` tinyint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pdt_id`, `pdt_name`, `pdt_price`, `pdt_des`, `pdt_ctg`, `pdt_image`, `pdt_status`) VALUES
(1, 'Apple', 200, 'esztrgfwv', 8, 'english sajetion.png', 1),
(6, 'Banana', 50, 'Its good food', 5, '2021-07-25_095947.png', 1),
(7, 'Faruk ', 200, 'Amr Sonar Bangla Ami Toamy Valobasi ', 9, '2021-09-28_124026.png', 1),
(8, 'Ayna ', 20, 'sdetgfvh yrae', 10, '2021-09-28_123742.png', 0),
(9, 'Orange ', 2005, 'Amr Sonar Bangla Ami Tomay Valobasi', 5, 'bhi.jpg', 1),
(10, 'Apple', 150, 'Its Good food for health', 14, 'post-wgt-02.jpg', 1),
(12, 'Apple', 200, 'Its a Good Food', 14, 'bn04.jpg', 1),
(13, 'Orange', 250, 'Its a Good Food', 15, 'product_deal-02_330x330.jpg', 1),
(14, 'Banana', 50, 'Its a good for health', 16, 'istockphoto-173242750-612x612.jpg', 1),
(15, 'Fruit', 200, 'Its a good food', 17, 'insta-01.jpg', 1),
(17, 'Apple', 100, 'Its a good food', 14, 'thumb-07.jpg', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_info_ctg`
-- (See below for the actual view)
--
CREATE TABLE `product_info_ctg` (
`pdt_id` int(255)
,`pdt_name` varchar(255)
,`pdt_price` int(50)
,`pdt_des` varchar(200)
,`pdt_image` varchar(250)
,`pdt_status` tinyint(5)
,`ctg_id` int(11)
,`ctg_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_fastname` text NOT NULL,
  `user_lastname` text NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_mobile` int(11) NOT NULL,
  `user_roles` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_fastname`, `user_lastname`, `user_email`, `user_password`, `user_mobile`, `user_roles`) VALUES
(4, 'soikot', 'MK', 'Bhuiyan', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1622243117, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `confirm_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `confirm_password`) VALUES
(1, 'Mk Soikot', 'Mk@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', ''),
(2, 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '');

-- --------------------------------------------------------

--
-- Structure for view `product_info_ctg`
--
DROP TABLE IF EXISTS `product_info_ctg`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_info_ctg`  AS  select `products`.`pdt_id` AS `pdt_id`,`products`.`pdt_name` AS `pdt_name`,`products`.`pdt_price` AS `pdt_price`,`products`.`pdt_des` AS `pdt_des`,`products`.`pdt_image` AS `pdt_image`,`products`.`pdt_status` AS `pdt_status`,`category`.`ctg_id` AS `ctg_id`,`category`.`ctg_name` AS `ctg_name` from (`products` join `category`) where (`products`.`pdt_ctg` = `category`.`ctg_id`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ctg_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pdt_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ctg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pdt_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
