-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2022 at 03:59 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lms_webdev`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id_author` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id_author`, `name`) VALUES
(1, 'Apri Anggara Yudha'),
(2, 'David Brubeck'),
(13, 'Jacob Collier'),
(15, 'Art Blakey'),
(19, 'John Coltrane'),
(20, 'Mahler');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id_book` int(11) NOT NULL,
  `cover` varchar(50) DEFAULT 'default.png',
  `title` varchar(255) NOT NULL,
  `isbn` varchar(13) DEFAULT '',
  `id_category` int(11) DEFAULT 1,
  `publication_date` date DEFAULT NULL,
  `copies` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id_book`, `cover`, `title`, `isbn`, `id_category`, `publication_date`, `copies`) VALUES
(23, 'polarbear.jpg', 'Detailed Collection', '1234', 3, '2022-06-23', 3),
(24, 'default.png', 'A Book Title', '0123456789123', 5, '2022-05-29', 0),
(25, 'default.png', 'ABC', '', 1, '2022-06-01', 2),
(27, 'default.png', 'The Book', '', 1, '0000-00-00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `book_detail`
--

CREATE TABLE `book_detail` (
  `id_book_detail` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `status` varchar(255) DEFAULT 'AVAILABLE',
  `book_condition` varchar(255) DEFAULT 'GOOD'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_detail`
--

INSERT INTO `book_detail` (`id_book_detail`, `id_book`, `status`, `book_condition`) VALUES
(4, 23, 'BORROWED', 'GOOD'),
(5, 23, 'AVAILABLE', 'GOOD'),
(9, 23, 'AVAILABLE', 'Missing page 101'),
(10, 25, 'AVAILABLE', 'GOOD'),
(12, 25, 'AVAILABLE', 'PERFECT'),
(17, 27, 'BORROWED', 'PERFECT'),
(18, 27, 'AVAILABLE', 'GOOD'),
(19, 27, 'AVAILABLE', 'GOOD');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name`) VALUES
(1, 'Other'),
(3, 'Comic'),
(5, 'Dictionary'),
(6, 'Encyclopedia'),
(7, 'Novel');

-- --------------------------------------------------------

--
-- Table structure for table `fine_payment`
--

CREATE TABLE `fine_payment` (
  `id_payment` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fine_payment`
--

INSERT INTO `fine_payment` (`id_payment`, `id_member`, `amount`, `payment_date`) VALUES
(6, 1, 10000, '2022-06-23'),
(7, 1, 5000, '2022-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `link_book_author`
--

CREATE TABLE `link_book_author` (
  `id_link_book_author` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `link_book_author`
--

INSERT INTO `link_book_author` (`id_link_book_author`, `id_book`, `id_author`) VALUES
(21, 23, 1),
(22, 23, 20),
(23, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id_loan` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_book_detail` int(11) NOT NULL,
  `loan_date` date DEFAULT NULL,
  `due_return_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `fine_amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id_loan`, `id_member`, `id_book_detail`, `loan_date`, `due_return_date`, `return_date`, `fine_amount`) VALUES
(18, 1, 4, '2022-06-23', '2022-07-07', NULL, 10000),
(19, 1, 5, '2022-06-23', '2022-07-07', '2022-07-08', 10000),
(20, 1, 10, '2022-06-23', '2022-07-07', '2022-07-08', 10000),
(21, 2, 17, '2022-06-24', '2022-07-08', NULL, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `register_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `member_name`, `email`, `register_date`) VALUES
(1, 'Apri Anggara Yudha', 'anggarayudha585@upi.edu', '2022-06-14'),
(2, 'A Member', 'dummy@email.com', '2022-06-30'),
(3, 'Another Member', 'dummy@email.com', '2022-06-30'),
(4, 'New Member', 'newmember@email.com', '2022-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id_rules` int(11) NOT NULL,
  `loan_periode` int(11) NOT NULL DEFAULT 14,
  `fine_amount` int(11) NOT NULL DEFAULT 10000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id_rules`, `loan_periode`, `fine_amount`) VALUES
(1, 14, 10000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id_author`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_book`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `book_detail`
--
ALTER TABLE `book_detail`
  ADD PRIMARY KEY (`id_book_detail`),
  ADD KEY `id_book` (`id_book`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `fine_payment`
--
ALTER TABLE `fine_payment`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_member` (`id_member`);

--
-- Indexes for table `link_book_author`
--
ALTER TABLE `link_book_author`
  ADD PRIMARY KEY (`id_link_book_author`),
  ADD KEY `id_book` (`id_book`),
  ADD KEY `id_author` (`id_author`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id_loan`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_book` (`id_book_detail`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id_rules`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `book_detail`
--
ALTER TABLE `book_detail`
  MODIFY `id_book_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fine_payment`
--
ALTER TABLE `fine_payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `link_book_author`
--
ALTER TABLE `link_book_author`
  MODIFY `id_link_book_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id_loan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id_rules` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE SET NULL;

--
-- Constraints for table `book_detail`
--
ALTER TABLE `book_detail`
  ADD CONSTRAINT `book_detail_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fine_payment`
--
ALTER TABLE `fine_payment`
  ADD CONSTRAINT `fine_payment_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`);

--
-- Constraints for table `link_book_author`
--
ALTER TABLE `link_book_author`
  ADD CONSTRAINT `link_book_author_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `link_book_author_ibfk_2` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`) ON DELETE CASCADE,
  ADD CONSTRAINT `loan_ibfk_2` FOREIGN KEY (`id_book_detail`) REFERENCES `book_detail` (`id_book_detail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
