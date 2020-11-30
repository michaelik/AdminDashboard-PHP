-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2020 at 03:47 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_clone`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `subtitle` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `links` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `subtitle`, `description`, `links`) VALUES
(3, 'man', 'is', 'hello lol', 'www.google.com'),
(4, 'The Ultimate How', 'An imaginary Intro On How TO Goes', 'The misery jagon', 'www.how.com'),
(5, 'okay lol', 'hello now', 'hi man', 'jhuy.com');

-- --------------------------------------------------------

--
-- Table structure for table `dept_category`
--

CREATE TABLE `dept_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept_category`
--

INSERT INTO `dept_category` (`id`, `name`, `description`, `image`) VALUES
(1, 'Department of computer science', 'Here i go', '5-2020.jpg'),
(2, 'Department of Engineering.', 'ben', '6-2020.jpg'),
(5, 'Department of marketing', 'this is epic', '7-2020.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dept_category_list`
--

CREATE TABLE `dept_category_list` (
  `id` int(11) NOT NULL,
  `dept_cate_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `descrip` varchar(191) NOT NULL,
  `section` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept_category_list`
--

INSERT INTO `dept_category_list` (`id`, `dept_cate_id`, `name`, `descrip`, `section`) VALUES
(1, 5, 'business', 'this is business course.', 'D'),
(2, 5, 'business2', 'this is business 2 course.', 'D'),
(7, 1, 'artificial intelligent', 'this is  awesome.', 'A'),
(8, 5, 'Enterprenuership', 'An Introduction To Entrepreneurship.', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `designation` varchar(30) NOT NULL,
  `description` varchar(80) NOT NULL,
  `images` varchar(50) NOT NULL,
  `visible` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `designation`, `description`, `images`, `visible`) VALUES
(36, 'rufhdsukhkxcjhbvauihbuiluhb', 'ufkduisfuifgkjxu', 'udsiufnucnjvfbuib', '2018.jpg', 0),
(37, 'fjcvhsbjxhcb', 'bdkfhesbkh', 'jhbfshbvsjh', 'myAvatar.png', 0),
(57, 'jhsdbkfshdj', 'fiukhdrfguikfhx', 'dufudfhvikudfhu', '3-2020.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `email`, `password`, `usertype`) VALUES
(3, 'oma', 'hand@noe', '7777', 'admin'),
(4, 'anah', 'nan@example.com', '5555', 'admin'),
(5, 'makeit', 'gmail@example.com', '1234', 'user'),
(6, 'ghalla', 'hello@lol', '9999', 'admin'),
(9, 'Emeka', 'make@han', '1234', 'admin'),
(10, 'erwjhsdfbuh', 'hand@noeh', 'LeFvtLm3fuR2A2P', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept_category`
--
ALTER TABLE `dept_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept_category_list`
--
ALTER TABLE `dept_category_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_cate_id` (`dept_cate_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `dept_category`
--
ALTER TABLE `dept_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `dept_category_list`
--
ALTER TABLE `dept_category_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dept_category_list`
--
ALTER TABLE `dept_category_list`
  ADD CONSTRAINT `dept_category_list_ibfk_1` FOREIGN KEY (`dept_cate_id`) REFERENCES `dept_category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
