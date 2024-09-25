-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 03:21 PM
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
-- Database: `btth01_cse485`
--

-- --------------------------------------------------------

--
-- Table structure for table `baiviet`
--

CREATE TABLE `baiviet` (
  `ma_bviet` int(10) UNSIGNED NOT NULL,
  `tieude` varchar(200) NOT NULL,
  `ten_bhat` varchar(100) NOT NULL,
  `ma_tloai` int(10) UNSIGNED NOT NULL,
  `tomtat` text NOT NULL,
  `noidung` text DEFAULT NULL,
  `ma_tgia` int(10) UNSIGNED NOT NULL,
  `ngayviet` datetime DEFAULT current_timestamp(),
  `hinhanh` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baiviet`
--

INSERT INTO `baiviet` (`ma_bviet`, `tieude`, `ten_bhat`, `ma_tloai`, `tomtat`, `noidung`, `ma_tgia`, `ngayviet`, `hinhanh`) VALUES
(14, 'Shape of You', 'Shape of You', 8, 'A popular song by Ed Sheeran from his album \"Divide\".', NULL, 1, '2024-09-25 00:00:00', '../../assets/images/songs/1.jpg'),
(15, 'Blinding Lights', 'Blinding Lights', 8, 'A hit song by The Weeknd from his album \"After Hours\".', NULL, 2, '2024-09-25 00:00:00', '../../assets/images/songs/2.jpg'),
(16, 'Someone Like You', 'Someone Like You', 8, 'A soulful ballad by Adele from her album \"21\".', NULL, 3, '2024-09-25 00:00:00', '../../assets/images/songs/3.jpg'),
(17, 'Rolling in the Deep', 'Rolling in the Deep', 8, 'Another powerful song by Adele from her album \"21\".', NULL, 3, '2024-09-25 00:00:00', '../../assets/images/songs/4.jpg'),
(18, 'Uptown Funk', 'Uptown Funk', 8, 'A funky hit by Mark Ronson featuring Bruno Mars.', NULL, 4, '2024-09-25 00:00:00', '../../assets/images/songs/5.jpg'),
(19, 'Bad Guy', 'Bad Guy', 8, 'A popular song by Billie Eilish from her album \"When We All Fall Asleep, Where Do We Go?\".', NULL, 5, '2024-09-25 00:00:00', '../../assets/images/songs/6.jpg'),
(20, 'Senorita', 'Senorita', 8, 'A duet by Shawn Mendes and Camila Cabello.', NULL, 6, '2024-09-25 00:00:00', '../../assets/images/songs/7.jpg'),
(21, 'Old Town Road', 'Old Town Road', 8, 'A viral hit by Lil Nas X featuring Billy Ray Cyrus.', NULL, 7, '2024-09-25 00:00:00', '../../assets/images/songs/8.jpg'),
(22, 'Havana', 'Havana', 8, 'A catchy song by Camila Cabello featuring Young Thug.', NULL, 6, '2024-09-25 00:00:00', '../../assets/images/songs/9.jpg'),
(23, 'Perfect', 'Perfect', 8, 'A romantic ballad by Ed Sheeran from his album \"Divide\".', NULL, 1, '2024-09-25 00:00:00', '../../assets/images/songs/10.jpg'),
(29, 'Blank Space', 'Blank Space', 8, 'A pop song by Taylor Swift from her album \"1989\".', NULL, 9, '2024-09-25 00:00:00', '../../assets/images/songs/11.jpg'),
(30, 'Despacito', 'Despacito', 8, 'A Latin pop song by Luis Fonsi featuring Daddy Yankee.', NULL, 10, '2024-09-25 00:00:00', '../../assets/images/songs/12.jpg'),
(31, 'Too Good At Goodbyes', 'Too Good At Goodbyes', 8, 'A soulful ballad by Sam Smith from his album \"The Thrill of It All\".', NULL, 11, '2024-09-25 00:00:00', '../../assets/images/songs/13.jpg'),
(32, 'Love Story', 'Love Story', 8, 'A country pop song by Taylor Swift from her album \"Fearless\".', NULL, 9, '2024-09-25 00:00:00', '../../assets/images/songs/14.jpg'),
(33, 'Échame la Culpa', 'Échame la Culpa', 8, 'A Latin pop song by Luis Fonsi and Demi Lovato.', NULL, 10, '2024-09-25 00:00:00', '../../assets/images/songs/15\r\n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tacgia`
--

CREATE TABLE `tacgia` (
  `ma_tgia` int(10) UNSIGNED NOT NULL,
  `ten_tgia` varchar(100) NOT NULL,
  `hinh_tgia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tacgia`
--

INSERT INTO `tacgia` (`ma_tgia`, `ten_tgia`, `hinh_tgia`) VALUES
(1, 'Nhacvietplus', '../../assets/images/authors/1.jpg'),
(2, 'Sưu tầm', '../../assets/images/authors/2.jpg'),
(3, 'Sandy', '../../assets/images/authors/3.jpg'),
(4, 'Lê Trung Ngân', '../../assets/images/authors/4.jpg'),
(5, 'Khánh Ngọc', '../../assets/images/authors/5.jpg'),
(6, 'Night Stalker', '../../assets/images/authors/6.jpg'),
(7, 'Phạm Phương Anh', '../../assets/images/authors/7.jpg'),
(8, 'Tâm tình', '../../assets/images/authors/8.jpg'),
(9, 'Taylor Swift', '../../assets/images/authors/9.jpg'),
(10, 'Luis Fonsi', '../../assets/images/authors/10.jpg'),
(11, 'Sam Smith', '../../assets/images/authors/11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `theloai`
--

CREATE TABLE `theloai` (
  `ma_tloai` int(10) UNSIGNED NOT NULL,
  `ten_tloai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theloai`
--

INSERT INTO `theloai` (`ma_tloai`, `ten_tloai`) VALUES
(1, 'Nhạc trẻ 100'),
(2, 'Nhạc trữ tình'),
(3, 'Nhạc cách mạng'),
(4, 'Nhạc thiếu nhi'),
(5, 'Nhạc quê hương'),
(6, 'POP'),
(7, 'Rock'),
(8, 'R&B');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'admin', '123', 'admin@admin.com', 'admin'),
(4, 'admin1', '123', '', 'user'),
(5, 'user1', 'password1', 'user1@example.com', 'user'),
(6, 'user2', 'password2', 'user2@example.com', 'user'),
(7, 'user3', 'password3', 'user3@example.com', 'user'),
(8, 'user4', 'password4', 'user4@example.com', 'user'),
(9, 'user5', 'password5', 'user5@example.com', 'user'),
(10, 'user6', 'password6', 'user6@example.com', 'user'),
(11, 'user7', 'password7', 'user7@example.com', 'user'),
(12, 'user8', 'password8', 'user8@example.com', 'user'),
(13, 'user9', 'password9', 'user9@example.com', 'user'),
(14, 'user10', 'password10', 'user10@example.com', 'user');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_music`
-- (See below for the actual view)
--
CREATE TABLE `vw_music` (
`ma_bviet` int(10) unsigned
,`tieude` varchar(200)
,`ten_bhat` varchar(100)
,`ma_tloai` int(10) unsigned
,`tomtat` text
,`noidung` text
,`ma_tgia` int(10) unsigned
,`ngayviet` datetime
,`hinhanh` varchar(200)
,`ten_tloai` varchar(50)
,`ten_tgia` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_music`
--
DROP TABLE IF EXISTS `vw_music`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_music`  AS SELECT `bv`.`ma_bviet` AS `ma_bviet`, `bv`.`tieude` AS `tieude`, `bv`.`ten_bhat` AS `ten_bhat`, `bv`.`ma_tloai` AS `ma_tloai`, `bv`.`tomtat` AS `tomtat`, `bv`.`noidung` AS `noidung`, `bv`.`ma_tgia` AS `ma_tgia`, `bv`.`ngayviet` AS `ngayviet`, `bv`.`hinhanh` AS `hinhanh`, `tl`.`ten_tloai` AS `ten_tloai`, `tg`.`ten_tgia` AS `ten_tgia` FROM ((`baiviet` `bv` join `theloai` `tl` on(`bv`.`ma_tloai` = `tl`.`ma_tloai`)) join `tacgia` `tg` on(`bv`.`ma_tgia` = `tg`.`ma_tgia`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baiviet`
--
ALTER TABLE `baiviet`
  ADD PRIMARY KEY (`ma_bviet`),
  ADD KEY `ma_tloai` (`ma_tloai`),
  ADD KEY `ma_tgia` (`ma_tgia`);

--
-- Indexes for table `tacgia`
--
ALTER TABLE `tacgia`
  ADD PRIMARY KEY (`ma_tgia`);

--
-- Indexes for table `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`ma_tloai`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baiviet`
--
ALTER TABLE `baiviet`
  MODIFY `ma_bviet` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tacgia`
--
ALTER TABLE `tacgia`
  MODIFY `ma_tgia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `theloai`
--
ALTER TABLE `theloai`
  MODIFY `ma_tloai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `baiviet`
--
ALTER TABLE `baiviet`
  ADD CONSTRAINT `baiviet_ibfk_1` FOREIGN KEY (`ma_tloai`) REFERENCES `theloai` (`ma_tloai`),
  ADD CONSTRAINT `baiviet_ibfk_2` FOREIGN KEY (`ma_tgia`) REFERENCES `tacgia` (`ma_tgia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
