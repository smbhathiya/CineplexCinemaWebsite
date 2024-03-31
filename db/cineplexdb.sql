-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2024 at 05:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cineplexdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `movietitle` varchar(255) DEFAULT NULL,
  `showtime` varchar(50) DEFAULT NULL,
  `seatnumber` varchar(5) DEFAULT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `contactno` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`movietitle`, `showtime`, `seatnumber`, `customername`, `contactno`) VALUES
('Godzilla - King of Monsters', 'Monday - 7:00 PM', 'A3', 'bhathiya lakshan', '0123456789'),
('Godzilla - King of Monsters', 'Monday - 7:00 PM', 'A4', 'bhathiya lakshan', '0123456789');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contactno` varchar(10) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`fullname`, `email`, `contactno`, `password`) VALUES
('bhathiya lakshan', 'bhathiya@gmail.com', '0123456789', '$2y$10$S59bAKhLyLGDlnyp1bZ9CeXukJYNct2vUo/YmxNQvuKF75vxHXZt2'),
('John Smith', 'john@gmail.com', '0123456789', '$2y$10$DvbkrtQFMIVEcr2qi.QFpekx5a53pCGMJlqcx3TYfrSqxVFFum6o.');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`fullname`, `email`, `message`) VALUES
('bhathiya lakshan', 'mayanan733@vinthao.com', 'Hello, this is my message');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `moredetails` varchar(200) NOT NULL,
  `timings` longtext NOT NULL,
  `status` varchar(20) NOT NULL,
  `releasedate` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `moredetails`, `timings`, `status`, `releasedate`) VALUES
(1, 'Godzilla - King of Monsters', 'https://www.imdb.com/title/tt3741700/', '[\"Monday - 7:00 PM\", \"Tuesday - 7:00 PM\", \"Wednesday - 7:00 PM\"]', 'now', 'May 31, 2019'),
(2, 'Fantastic Beasts and Where I Can Find Them', 'https://www.imdb.com/title/tt3183660/', '[\"Thursday - 6:30 PM\", \"Friday - 6:30 PM\", \"Saturday - 3:00 PM\"]', 'now', ''),
(3, 'Guardians of the Galaxy Vol.3', 'https://www.imdb.com/title/tt6791350/', '[\"Sunday - 5:30 PM\", \"Monday - 7:00 PM\", \"Tuesday - 7:00 PM\"]', 'now', ''),
(4, 'Transformers: Rise of the Beasts', 'https://www.imdb.com/title/tt5090568/', '[\"Wednesday - 8:30 PM\", \"Thursday - 8:30 PM\", \"Friday - 8:30 PM\"]', 'now', ''),
(5, 'Aquaman and the Lost Kingdom', 'https://www.imdb.com/title/tt9663764/', '[\"Saturday - 2:00 PM\", \"Sunday - 4:30 PM\", \"Monday - 8:00 PM\"]', 'now', ''),
(6, 'Wonka', 'https://www.imdb.com/title/tt6166392/', '[\"Thursday - 7:00 PM\", \"Friday - 8:00 PM\", \"Saturday - 5:30 PM\"]', 'now', ''),
(7, 'The Last Voyage of the Demeter', 'https://www.imdb.com/title/tt1001520/', '[\"Monday - 6:45 PM\", \"Wednesday - 7:30 PM\", \"Friday - 9:15 PM\"]', 'now', ''),
(8, 'Thor: Love and Thunder', 'https://www.imdb.com/title/tt10648342/', '[\"Sunday - 6:00 PM\", \"Tuesday - 8:45 PM\", \"Thursday - 7:15 PM\"]', 'now', ''),
(9, 'Kingdom of the Planet of the Apes', 'https://www.imdb.com/title/tt11389872/', '[\"Monday - 7:00 PM\", \"Tuesday - 7:00 PM\", \"Wednesday - 7:00 PM\"]', 'soon', '2024-05-24'),
(10, 'Oppenheimer', 'https://www.imdb.com/title/tt15398776/', '[\"Wednesday - 8:30 PM\", \"Thursday - 8:30 PM\", \"Friday - 8:30 PM\"]', 'soon', '2024-04-01'),
(11, 'Kung Fu Panda 4', 'https://www.imdb.com/title/tt21692408/', '', 'soon', '2024-03-28'),
(12, ' The Flash', 'https://www.imdb.com/title/tt0439572/', '', 'soon', '2024-03-20'),
(13, 'Venom 3', 'https://www.imdb.com/title/tt16366836/', '', 'soon', '2024-11-08'),
(14, 'Godzilla x Kong: The New Empire', 'https://www.imdb.com/title/tt14539740/', '', 'soon', '2024-03-29'),
(15, 'Deadpool & Wolverine', 'https://www.imdb.com/title/tt6263850/', '', 'soon', '2024-07-26'),
(16, 'Dune: Part Two', 'https://www.imdb.com/title/tt15239678/', '', 'soon', '2024-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `now_showing_movies`
--

CREATE TABLE `now_showing_movies` (
  `id` varchar(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `moredetails` varchar(200) NOT NULL,
  `timings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`timings`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `now_showing_movies`
--

INSERT INTO `now_showing_movies` (`id`, `title`, `moredetails`, `timings`) VALUES
('01', 'Godzilla - King of Monsters', 'https://www.imdb.com/title/tt3741700/', '[\"Monday - 7:00 PM\", \"Tuesday - 7:00 PM\", \"Wednesday - 7:00 PM\"]'),
('02', 'Fantastic Beasts and Where I Can Find Them', 'https://www.imdb.com/title/tt3183660/', '[\"Thursday - 6:30 PM\", \"Friday - 6:30 PM\", \"Saturday - 3:00 PM\"]'),
('03', 'Guardians of the Galaxy Vol.3', 'https://www.imdb.com/title/tt6791350/', '[\"Sunday - 5:30 PM\", \"Monday - 7:00 PM\", \"Tuesday - 7:00 PM\"]'),
('04', 'Transformers: Rise of the Beasts', 'https://www.imdb.com/title/tt5090568/', '[\"Wednesday - 8:30 PM\", \"Thursday - 8:30 PM\", \"Friday - 8:30 PM\"]'),
('13', 'Aquaman and the Lost Kingdom', 'https://www.imdb.com/title/tt9663764/', '[\"Saturday - 2:00 PM\", \"Sunday - 4:30 PM\", \"Monday - 8:00 PM\"]'),
('14', 'Wonka', 'https://www.imdb.com/title/tt6166392/', '[\"Thursday - 7:00 PM\", \"Friday - 8:00 PM\", \"Saturday - 5:30 PM\"]'),
('15', 'The Last Voyage of the Demeter', 'https://www.imdb.com/title/tt1001520/', '[\"Monday - 6:45 PM\", \"Wednesday - 7:30 PM\", \"Friday - 9:15 PM\"]'),
('16', 'Thor: Love and Thunder', 'https://www.imdb.com/title/tt10648342/', '[\"Sunday - 6:00 PM\", \"Tuesday - 8:45 PM\", \"Thursday - 7:15 PM\"]');

-- --------------------------------------------------------

--
-- Table structure for table `upcoming_movies`
--

CREATE TABLE `upcoming_movies` (
  `id` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `moredetails` varchar(200) NOT NULL,
  `releasedate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upcoming_movies`
--

INSERT INTO `upcoming_movies` (`id`, `title`, `moredetails`, `releasedate`) VALUES
('05', 'Kingdom of the Planet of the Apes', 'https://www.imdb.com/title/tt11389872/', ' May 24, 2024'),
('06', 'Oppenheimer', 'https://www.imdb.com/title/tt15398776/', 'April 01, 2024'),
('07', 'Kung Fu Panda 4', 'https://www.imdb.com/title/tt21692408/', 'March 28, 2024'),
('08', 'The Flash', 'https://www.imdb.com/title/tt0439572/', 'March 20, 2024'),
('09', 'Venom 3', 'https://www.imdb.com/title/tt16366836/', 'November 8,2024'),
('10', 'Godzilla x Kong: The New Empire', 'https://www.imdb.com/title/tt14539740/', 'March 29, 2024'),
('11', 'Deadpool & Wolverine', 'https://www.imdb.com/title/tt6263850/', 'July 26, 2024'),
('12', 'Dune: Part Two', 'https://www.imdb.com/title/tt15239678/', 'March 20, 2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD UNIQUE KEY `fullname` (`fullname`,`email`,`message`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `now_showing_movies`
--
ALTER TABLE `now_showing_movies`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `upcoming_movies`
--
ALTER TABLE `upcoming_movies`
  ADD UNIQUE KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
