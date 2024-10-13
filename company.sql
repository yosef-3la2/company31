-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 03:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(3, 'laptops'),
(4, 'mobiles'),
(5, 'fruits'),
(6, 'vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`) VALUES
(28, 'sales'),
(29, 'marketing'),
(30, 'hr'),
(31, 'sap'),
(32, 'azhar');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `department_id`, `address`, `phone`, `password`) VALUES
(3, 'ali', 'cetupib@mailinator.com', 29, 'Elit et enim pariat', '+1 (548) 686-5362', 'Pa$$w0rd!'),
(5, 'Jonas Bruce', 'nyren@mailinator.com', 28, 'Doloribus a consequa', '+1 (181) 874-1139', 'Pa$$w0rd!'),
(6, 'ahmed', 'toqekokogy@mailinator.com', 30, 'Incididunt similique', '+1 (371) 432-8077', 'Pa$$w0rd!'),
(7, 'Sopoline Douglas', 'dykuqyjyvo@mailinator.com', 28, 'Magnam enim dolorem ', '+1 (334) 237-4411', 'Pa$$w0rd!'),
(9, 'Doris Petty', 'sogyl@mailinator.com', 28, 'Cumque temporibus as', '+1 (629) 714-1063', 'Pa$$w0rd!'),
(10, 'dddddddddd', 'cazati@mailinator.com', 31, 'Ut vel in iure offic', '+1 (512) 608-6442', 'Pa$$w0rd!');

-- --------------------------------------------------------

--
-- Stand-in structure for view `employeeswithdepartments`
-- (See below for the actual view)
--
CREATE TABLE `employeeswithdepartments` (
`id` int(11)
,`name` varchar(255)
,`email` varchar(255)
,`password` varchar(255)
,`address` text
,`phone` varchar(50)
,`dep_id` int(11)
,`department` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` float DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `category_id`) VALUES
(9, 'Sint et sit quasi ', 'Sit esse voluptatem', 752, 3),
(10, 'Rerum iusto quia tem', 'Tempore fugiat in c', 793, 5),
(11, 'Quibusdam saepe qui ', 'Corporis minim quasi', 789, 4),
(12, 'Ut voluptatum et min', 'Qui ullamco debitis ', 841, 4),
(13, 'Minim quia omnis tem', 'Aliqua Quia fugit ', 399, 4),
(14, 'Numquam sed illum l', 'Consequatur elit qu', 293, 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `productswithcategories2`
-- (See below for the actual view)
--
CREATE TABLE `productswithcategories2` (
`id` int(11)
,`title` varchar(255)
,`description` text
,`price` float
,`cat_id` int(11)
,`category` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `employeeswithdepartments`
--
DROP TABLE IF EXISTS `employeeswithdepartments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `employeeswithdepartments`  AS SELECT `employees`.`id` AS `id`, `employees`.`name` AS `name`, `employees`.`email` AS `email`, `employees`.`password` AS `password`, `employees`.`address` AS `address`, `employees`.`phone` AS `phone`, `departments`.`id` AS `dep_id`, `departments`.`department` AS `department` FROM (`employees` join `departments` on(`employees`.`department_id` = `departments`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `productswithcategories2`
--
DROP TABLE IF EXISTS `productswithcategories2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productswithcategories2`  AS SELECT `products`.`id` AS `id`, `products`.`title` AS `title`, `products`.`description` AS `description`, `products`.`price` AS `price`, `categories`.`id` AS `cat_id`, `categories`.`category` AS `category` FROM (`products` join `categories` on(`products`.`category_id` = `categories`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
