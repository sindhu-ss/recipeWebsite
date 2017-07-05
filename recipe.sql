-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 05, 2017 at 03:32 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `recipe_id` mediumint(8) UNSIGNED NOT NULL,
  `comment` varchar(1500) CHARACTER SET utf8 NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `recipe_id`, `comment`, `created`) VALUES
(1, 2, 29, 'beautiful...something i was looking for', '2017-07-04 23:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `ingredients` text CHARACTER SET utf8 NOT NULL,
  `poster` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `description`, `ingredients`, `poster`, `date_created`, `category`) VALUES
(11, 'Oats Pudding with Coconut', 'hhldfhldhfglhdlfhgdhlfgdfgdfgdfgdfg\r\n', 'fjfgjfgjfgjfgj\r\nghdhfghdlhfgdhfghdlfgldfg', '56909d572aabd.jpeg', '2017-07-05 01:25:45', 'snack'),
(12, 'Granola Bars', 'Press in to a square dish and bake at 160 degrees for about 1 hour! Then cool before cutting in to squares.', '\r\noats\r\nflour\r\n1 tsp baking powder\r\nchocolate chips\r\ndried cranberries\r\nchopped nuts\r\ncoconut shreds\r\nchopped dates\r\noil or butter', NULL, '2017-07-05 01:27:33', 'snack'),
(13, 'Blueberry Nutty Smoothie', ' Great for energy and digestive health!', 'Almond milk, banana, blueberries\r\n', '5690a5011eb15.jpeg', '2017-07-05 01:29:19', 'smoothie'),
(18, 'Green Smoothie', 'ghjghjghjghjghjghjghjghjghjghj', 'milk, banana, mangoes, spinach, pineapple, pear\r\n', '56946028bb197.jpeg', '2017-07-05 01:30:16', 'smoothie'),
(26, 'Mango Smoothie', 'Whizzed up in 2 mins in my #nutribulletnz!', '<ul>\r\n<li>1/2 cup of pineapple</li>\r\n<li>1/2 a banana</li>\r\n<li>1/2 cup of frozen mango</li>\r\n<li>3/4 cup of So Good Coconut Milk</li>\r\n<li>1 tbsp coconut yoghurt (I used @raglancoconutyoghurt)</li>\r\n\r\n<li>Delish!</li>\r\n</ul>', '569460ac6cd84.jpeg', '2016-01-12 02:10:52', 'smoothie'),
(27, 'Home made Snickers ', 'try it with coffee. Yum!', 'kdhfgkdfgh, sdgfgskdf,skdgfksgdfkgsd,skdfgksd', '569462042213f.jpeg', '2017-07-05 01:31:14', 'dessert'),
(29, 'Banana Muffins', 'ghjghjghjghjghjghjghjghjg', 'gkghghjghjghjghjghjghjghjgh', '569463eaab08e.jpeg', '2017-07-05 01:31:34', 'dessert'),
(30, 'Veg Enriched Smoothie', 'dfgdfgdfgdfgdfgdfgdf', 'dfgdfgdfgdfgdfgdfgdfgdfgdfgdfg', NULL, '2017-07-04 11:24:38', 'smoothie'),
(31, 'Semolina Nut Bar', 'fghfghfghfghfghfgh', 'fghfghfghfghfghfghfghfghfghfghfgh', NULL, '2017-07-04 11:31:09', 'dessert'),
(38, 'snack bar', 'fgjhjghjkgkghkghkghkghkghkghkghk', 'ghkghkghkghkghkghkghkghkghkghkghk', NULL, '2017-07-05 00:37:09', 'snack');

-- --------------------------------------------------------

--
-- Table structure for table `recipes_tag`
--

CREATE TABLE `recipes_tag` (
  `recipe_id` mediumint(8) UNSIGNED NOT NULL,
  `tag_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipes_tag`
--

INSERT INTO `recipes_tag` (`recipe_id`, `tag_id`) VALUES
(38, 2),
(18, 6),
(18, 3),
(31, 16),
(31, 15),
(13, 17),
(13, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `tag` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(16, 'crunchy'),
(17, 'fruity'),
(2, 'nutritious'),
(15, 'nutty'),
(6, 'tasty'),
(3, 'veg'),
(7, 'yummy');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(15) UNSIGNED NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `role` enum('user','admin') CHARACTER SET utf8 NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'assin', 'ss@m.com', '$2y$10$LsX5RE.JY7jF.lHmUPgTP.jNBVGIebmu03ZvepKoHbXpkWz/H.esq', 'admin'),
(2, 'ssamdi', 'amy@m.com', '$2y$10$95pxMzgYJ3h3CrAjzhdaA.OvPNVZwEJKj7kAcn/HgHO3kp7uNCbbi', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`recipe_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);
ALTER TABLE `recipes` ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `recipes` ADD FULLTEXT KEY `description` (`description`);
ALTER TABLE `recipes` ADD FULLTEXT KEY `category` (`category`);

--
-- Indexes for table `recipes_tag`
--
ALTER TABLE `recipes_tag`
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tag` (`tag`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `recipes_tag`
--
ALTER TABLE `recipes_tag`
  ADD CONSTRAINT `recipes_tag_ibfk_4` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`),
  ADD CONSTRAINT `recipes_tag_ibfk_5` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
