-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2020 at 02:31 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `Birthday` date NOT NULL,
  `City` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`ID`, `first_name`, `last_name`, `Birthday`, `City`, `Country`) VALUES
(10, 'Jo', 'Nesbo', '1960-03-29', 'Oslo', 'Norway'),
(13, 'Camilla', 'Lackberg', '1974-08-30', 'Fjällbacka', 'Sweden'),
(14, 'Stephen', 'King', '1947-09-21', 'Portland', 'USA'),
(15, 'Agatha', 'Christie', '1890-08-15', 'London', 'England'),
(16, 'Henning', 'Mankell', '1948-02-03', 'Stockholm', 'Sweden');

-- --------------------------------------------------------

--
-- Table structure for table `author_books`
--

CREATE TABLE `author_books` (
  `ID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  `authorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author_books`
--

INSERT INTO `author_books` (`ID`, `bookID`, `authorID`) VALUES
(7, 1, 13),
(9, 3, 15),
(10, 4, 16),
(11, 5, 14),
(12, 15, 10),
(13, 6, 16);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ID` int(11) NOT NULL,
  `ISBN` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Pages` int(11) NOT NULL,
  `Publisher` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `reserved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ID`, `ISBN`, `Title`, `Pages`, `Publisher`, `Date`, `reserved`) VALUES
(1, 1234564565, 'The Ice Princess', 356, 'Pegasus', '2009-05-06', 0),
(2, 85645165, 'The Leopard', 458, 'Vintage Crime', '2011-02-11', 0),
(3, 64135166, 'Death on the Nile', 236, 'Chivers Pres Ltd', '1952-10-14', 0),
(4, 565645654, 'The Troubled Man', 325, 'Leopard forlag', '2012-08-06', 0),
(5, 45212152, 'It', 1138, 'Viking Press', '1985-09-15', 1),
(6, 1234656, 'Sunday book', 215, 'Doubleplay', '2020-05-14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(3) NOT NULL,
  `data_type` varchar(128) NOT NULL,
  `title` varchar(256) NOT NULL,
  `imgFullName` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `imgOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `data_type`, `title`, `imgFullName`, `description`, `imgOrder`) VALUES
(13, '', 'Parrot', 'name.5ec959ca6bfc16.79495655.png', 'Colourful parrot', 1),
(14, '', 'Wolf', 'wolf.5ec95a7e1b4de7.64137339.png', 'Wolf in snow', 1),
(15, '', 'Dolphin', 'dolphin.5ec96770d1eda4.69193673.png', 'jumping on thee water', 1),
(19, '', 'as', 'as.5ed2bd16db7aa8.49074648.png', 'addsds', 1),
(20, '', 'f', 'f.5ed2bee6a0e0a4.35796533.jpg', 'gfd', 1),
(21, '', 'asas', 'asas.5ed3816b9c7d42.36452470.png', 'ffdfd sds sd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `ID` int(11) NOT NULL,
  `publisher_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`ID`, `publisher_name`) VALUES
(1, 'Pegasus'),
(2, 'Doubleplay'),
(3, 'Vintage Crime'),
(4, 'Chivers Press Ltd'),
(5, 'Leopard forlag');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_first` varchar(255) NOT NULL,
  `user_last` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_staff` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `user_first`, `user_last`, `user_address`, `email`, `is_staff`) VALUES
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', '', '', 1),
(9, 'elsa', '60271be81c5179f86502bc147e316a1f', 'Elsa', 'Pratt', '', '', 0),
(10, 'zoe', 'c88a65120330cfc69d5dbe1916fc8cd2', 'Zoe', 'Koutelida', '', '', 0),
(11, 'maria', '263bce650e68ab4e23f28263760b9fa5', 'Maria', 'Castillo', '', '', 0),
(12, 'patrick', '6c84cbd30cf9350a990bad2bcc1bec5f', 'Patrick', 'Walsh', '', '', 0),
(13, 'moderator', '15d61712450a686a7f365adf4fef581f', '', '', '', '', 2),
(14, 'newadmin', '', 'admin', 'user', '', 'sdsd', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `author_books`
--
ALTER TABLE `author_books`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `author_books`
--
ALTER TABLE `author_books`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
