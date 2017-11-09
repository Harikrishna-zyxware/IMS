-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2017 at 06:56 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `comment`, `date`, `post_id`) VALUES
(1, 62, 'nice', '2017-11-06', 1),
(2, 62, 'asads', '2017-11-06', 1),
(3, 62, 'new', '2017-11-06', 1),
(4, 62, 'zxc', '2017-11-06', 1),
(5, 62, '', '2017-11-06', 1),
(6, 62, 'yiiy', '2017-11-06', 1),
(7, 62, 'cvb', '2017-11-06', 1),
(8, 62, 'last comment', '2017-11-06', 1),
(9, 62, 'fhfhfhfhg', '2017-11-06', 1),
(10, 62, 'test', '2017-11-06', 1),
(11, 62, 'test', '2017-11-06', 1),
(12, 62, 'test', '2017-11-06', 1),
(13, 62, 'test', '2017-11-06', 1),
(14, 62, 'test', '2017-11-06', 1),
(15, 62, 'test', '2017-11-06', 1),
(16, 62, 'sdf', '2017-11-06', 1),
(17, 62, 'new comment', '2017-11-06', 1),
(18, 62, 'nice', '2017-11-06', 2),
(19, 62, 'new', '2017-11-06', 2),
(20, 62, 'hfhfh', '2017-11-06', 2),
(21, 62, ' mn m,n,m', '2017-11-06', 2),
(22, 62, 'bmvbmv', '2017-11-06', 2),
(23, 62, 'cbvcvbcb', '2017-11-06', 2),
(24, 62, 'test sdgdgdfg', '2017-11-06', 2),
(25, 62, 'dfgdg', '2017-11-06', 2);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `date` int(11) NOT NULL,
  `author` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `body`, `date`, `author`) VALUES
(1, 'Drupal bugathon at Zyxware', 'We are happy to announce that we will be conducting a Drupal bugathon at our office at Sasthamangalam, Trivandrum on the 1st of February 2014. If you are a Drupal developer and you would like to get some guidance on how to contribute to Drupal you are welcome to join us. Bring your own laptops for the session.', 1391106600, 'webmaster'),
(2, 'Zyxware is one of the 5 featured service providers', 'We are happy to announce that Zyxware is now a Featured Service Provider on Drupal.org, a select club of Drupal providers with only another 4 members from India. This is a recognition of our contributions to Drupal over these years. We thank all our employees who have helped make this possible through their sustained contributions and members of the Drupal community who have guided,mentored and helped us as we grew in the Drupal space.', 1387132200, 'webmaster'),
(3, 'Drupal Boost Captcha by Zyxware', 'We have created and released a new module Boost Captcha to allow static page caching of pages with forms with captcha without running into the captcha session timeout errors. By helping boost cache more pages the module will allow for better performance without compromising on spam protection.', 1378751400, 'webmaster');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image_path` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `image_path`) VALUES
(40, 'cat', 'cat@cat', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'uploads/40.jpg'),
(55, 'grumpycat', 'grumpycat@gmail.com', '9d989e8d27dc9e0ec3389fc855f142c3d40f0c50', NULL),
(56, 'grumpycat', 'grumpycat@gmail.com', '9d989e8d27dc9e0ec3389fc855f142c3d40f0c50', NULL),
(57, 'glen', 'werwred@gdg', 'c226bcbeea1369fe10f943fcc1abb3ac7d5f8286', NULL),
(58, 'meow', 'werwred@gdg', '7d5c2a2d6136fbf166211d5183bf66214a247f31', NULL),
(59, '123', 'dgdg@dfd', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL),
(60, 'asd', 'asda@gdfg', 'f10e2821bbbea527ea02200352313bc059445190', NULL),
(61, 'asdf', 'asda@gdfg', '3da541559918a808c2402bba5012f6c60b27661c', 'uploads/61.png'),
(62, 'bnm', 'bnm@bnm', '6c82c6eefcd93e05b3e632153c424a7303ec650d', 'uploads/62.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
