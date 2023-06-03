-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2023 at 04:00 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `es_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `number`, `message`) VALUES
(1, 'Jork Cedric', 'jcp093001@gmail.com', '09212859073', 'I just finished reading your book, Wanderer of Life\'s Wonders, and I wanted to take a moment to tell you how much I enjoyed it. I was completely captivated by the story and the characters. I couldn\'t put it down!\r\n\r\nIt was so well-written and engaging. I felt like I was right there with the characters, experiencing everything they were going through.\r\n\r\nThank you for writing such an amazing book. It was a pleasure to read. I can\'t wait to read more of your work in the future.'),
(3, 'John Smith', 'johnsmith@gmail.com', '0918237697', '1 2 3 4, I knock the door!');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 0, 'Jork Cedric Padua', '092812842', 'ronangelo23@gmail.com', 'gcash', 'Street, Barangay Brgy, City, State', ', Wanderer of Life\'s Wonders (1) ', 700, '03-Jun-2023', 'completed'),
(2, 0, 'Tricia Cabantog', '091278372', 'triciacabantog13@gmail.com', 'gcash', 'Street, Barangay Brgy, City, State', ', Lifelong Commitment (1) ', 600, '03-Jun-2023', 'completed'),
(3, 0, 'Joy Buenaceda', '0912372137', 'rozenmontefalco104@gmail.com', 'gcash', 'Street, Barangay Brgy, City, State', ', Quarter-Life (1) ', 650, '03-Jun-2023', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(30) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `description`, `price`, `image`) VALUES
(1, 'Wanderer of Life\'s Wonders', 'Prose and Poetry', 'This is a prose and poetry book that is divided into three parts. The first part tackles the topic of failing and being lost. The second part is about trying and searching. The third part is about succeeding and finding yourself. \n\nThere are pieces about heartbreaks, failures, hitting rock bottom, adulthood, dreams in life, silent battles, life lessons, aspirations, surviving, striving, thriving, reality, and thoughts in between. It will take us on an adventure of paving our path, finding our purpose, and fulfilling our reasons.', 700, 'product-item1.png'),
(2, 'Me and The Universe', 'Prose and Poetry', 'It is a book of prose and poetry that tackles the topic of personal growth, dreams, silent battles, and our series of small progress. This is for those who feel lost in the uncertainty of life, for those who can feel the pressure brought by the society’s expectation, and for those who feel like they are ready to grow as a person. Some pieces will entertain you and some will let you have time to reflect. Pieces are literally inspired by universe in general. ', 550, 'product-item2.png'),
(3, 'Lifelong Commitment', 'Novel', 'With his lifelong commitment with the pursuit of happiness, John Michael San Miguel sees travelling as a way of searching for that happiness. His brother, Lucas, once offers a trip to Italy with him and he loves this idea. Italy is John Michael\'s dream place to be in but aside from fulfilling his dream, this place will also teach him a lot of life lessons especially those that are about mental health issues that he once suffered from. Searching for enjoyment and happiness, John Michael will find it in a complicated and unexpected way with the help of a girl that, he has no idea, will make him realizes a lot of things in life and would change his perspective towards happiness. ', 600, 'product-item3.png'),
(4, ' Wisdom on Hand', 'Prose and Poetry', 'This is a prose and poetry book that is dedicated to the dreamers, to the fighters, to the believers, to the achievers, and to those who feel like they need encouragement to grow better and stronger. ', 550, 'product-item4.png'),
(5, 'Quarter-Life', 'Prose and Poetry', 'This is a collection of prose and poetry that tackles the topic of dreams, silent battles, lessons, and experiences that someone who will be, who is in, and who had been in their mid-20s can relate to. ', 650, 'product-item5.png');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `c_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`c_id`, `name`, `email`, `message`, `date`) VALUES
(1, 'Jork Cedric Padua', 'jork@gmail.com', 'It\'s amazing!', '29-May-2023'),
(4, 'Customer Name', 'customer@gmail.com', 'Hatdog', '01-Jun-2023'),
(5, 'John Smith', 'johnsmith@gmail.com', 'Omg! I love it!', '03-Jun-2023');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `c_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
