-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2022 at 12:24 AM
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
-- Database: `zuzu`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(20) NOT NULL,
  `zipcode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `email`, `phone`, `fname`, `address`, `city`, `zipcode`) VALUES
(184, 'j.l.kousemakeDDDr@gmail.com', '+31612059599', 'Justin Kousemaker', 'Isabellaland, 930, 930', 'Den Haag', '2591ST'),
(185, 'j.l.er@gmail.com', '+31612059599', 'Justin Kousemaker', 'Isabellaland, 930, 930', 'Den Haag', '2591ST'),
(186, 'j.l.kousemakil.com', '+31612059599', 'Justin Kousemaker', 'Isabellaland, 930, 930', 'Den Haag', '2591ST'),
(187, 'j.l.ksdar@gmail.com', '+31612059599', 'Justin Kousemaker', 'Isabellaland, 930, 930', 'Den Haag', '2591ST'),
(188, 'j.l.kousemaker@fasdasfasfasmail.com', '+31612059599', 'Justin Kousemaker', 'Isabellaland, 930, 930', 'Den Haag', '2591ST'),
(189, 'j.l.kousemaker@gmvxcvfgvhgjnvbhngfail.com', '+31612059599', 'Justin Kousemaker', 'Isabellaland, 930, 930', 'Den Haag', '2591ST'),
(190, 'j.l.kousekfjdhaggmail.com', '+31612059599', 'Justin Kousemaker', 'Isabellaland, 930, 930', 'Den Haag', '2591ST'),
(191, 'j.l.kousemaker@gkghkhjlkmbnmmail.com', '+31612059599', 'Justin Kousemaker', 'Isabellaland, 930, 930', 'Den Haag', '2591ST'),
(192, 'j.l.kousemaker,n.lk;jkmgfnjk@gmail.com', '+31612059599', 'Justin Kousemakerjhljk', 'Isabellaland, 930, 930', 'Den Haag', '2591ST'),
(193, 'j.l.kousemaker@gkhgkghjgnbvhjgh mail.com', '+31612059599', 'Justin Kousemaker', 'Isabellaland, 930, 930', 'Den Haag', '2591ST'),
(194, 'j.l.kouker@gdasfsfmail.com', '+31612059599', 'Justin Kousemaker', 'Isabellaland, 930, 930', 'Den Haag', '2591ST');

-- --------------------------------------------------------

--
-- Table structure for table `orderlink`
--

CREATE TABLE `orderlink` (
  `id` int(11) NOT NULL,
  `order_id` int(255) NOT NULL,
  `product_id` int(20) NOT NULL,
  `amount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderlink`
--

INSERT INTO `orderlink` (`id`, `order_id`, `product_id`, `amount`) VALUES
(167, 91, 5, 3),
(168, 92, 5, 5),
(169, 92, 6, 5),
(170, 93, 5, 1),
(171, 94, 14, 2),
(172, 95, 15, 5),
(173, 96, 16, 0),
(174, 96, 21, 30),
(175, 96, 20, 40),
(176, 97, 16, 0),
(177, 97, 20, 55),
(178, 97, 21, 25),
(179, 98, 15, 4),
(180, 99, 14, 1),
(181, 99, 15, 1),
(182, 99, 16, 0),
(183, 99, 17, 1),
(184, 99, 18, 1),
(185, 99, 19, 1),
(186, 99, 20, 1),
(187, 99, 21, 1),
(188, 99, 22, 1),
(189, 100, 14, 1),
(190, 100, 15, 1),
(191, 100, 16, 0),
(192, 100, 17, 1),
(193, 100, 18, 1),
(194, 100, 19, 1),
(195, 100, 20, 1),
(196, 100, 21, 1),
(197, 100, 22, 1),
(198, 101, 14, 1),
(199, 101, 15, 1),
(200, 101, 16, 0),
(201, 101, 17, 1),
(202, 101, 18, 11),
(203, 101, 19, 1),
(204, 101, 20, 1),
(205, 101, 21, 1),
(206, 101, 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `price` decimal(2,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `price`) VALUES
(91, 184, '45'),
(92, 185, '99'),
(93, 186, '15'),
(94, 187, '30'),
(95, 188, '99'),
(96, 189, '99'),
(97, 190, '99'),
(98, 191, '99'),
(99, 192, '99'),
(100, 193, '99'),
(101, 194, '99');

-- --------------------------------------------------------

--
-- Table structure for table `sushi`
--

CREATE TABLE `sushi` (
  `id` int(255) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int(255) NOT NULL,
  `amount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sushi`
--

INSERT INTO `sushi` (`id`, `name`, `price`, `amount`) VALUES
(14, 'Chirashizushi', 15, 99),
(15, 'Futomaki', 36, 99),
(16, 'Gunkan maki', 19, 100),
(17, 'Hosomaki', 12, 99),
(18, 'Nigirizushi', 13, 89),
(19, 'Hamachi', 22, 99),
(20, 'Temaki', 7, 99),
(21, 'Temarizushi', 8, 99),
(22, 'Uramaki', 12, 99);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderlink`
--
ALTER TABLE `orderlink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sushi`
--
ALTER TABLE `sushi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `orderlink`
--
ALTER TABLE `orderlink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `sushi`
--
ALTER TABLE `sushi`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
