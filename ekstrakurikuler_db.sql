-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2025 at 07:00 AM
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
-- Database: `ekstrakurikuler_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `login_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extracurricular`
--

CREATE TABLE `extracurricular` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `schedule` varchar(100) DEFAULT NULL,
  `quota` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `extracurricular`
--

INSERT INTO `extracurricular` (`id`, `name`, `description`, `schedule`, `quota`, `image`) VALUES
(1, 'Japanese Club', 'Ekstrakurikuler mendalami bahasa & budaya Jepang', 'Senin & Kamis, 15:00-17:00', 0, 'Japanese.jpg'),
(2, 'Futsal', 'Latihan futsal dan persiapan turnamen', 'Selasa & Jumat, 14:00-16:00', 25, 'Futsal.jpg'),
(3, 'Paskibra', 'Pelatihan baris berbaris dan pembinaan karakter', 'Rabu & Sabtu, 13:00-15:00', 40, 'Paskibra.jpg'),
(4, 'Teater', 'Belajar seni peran dan produksi teater', 'Senin & Rabu, 16:00-18:00', 20, 'Teater.jpg'),
(5, 'Pemrograman', 'Pembelajaran dasar komputer dan programming', 'Kamis & Jumat, 15:00-17:00', 15, 'Pemrograman.jpg'),
(6, 'Musik', 'Mempelajari alat musik', NULL, NULL, 'Music.jpg'),
(7, 'Vocal', 'Belajar bernyanyi', NULL, NULL, 'Vocal.jpg'),
(8, 'Karawitan', 'Ekstrakurikuler mengenal alat music dan kesenian tradisional', NULL, NULL, 'Karawitan.jpg'),
(9, 'Pramuka', 'Mempelajari segala kepramukaan dan kepemimpinan', NULL, NULL, 'Pramuka.png'),
(10, 'Osis ', 'Osis SMK LPPM RI 1 & 2 Kota Bandung', NULL, NULL, 'Osis.png'),
(11, 'English Club', NULL, NULL, NULL, 'English.png'),
(12, 'Rohis', 'Menanamkan Rohani islam, dan memperdalam agama', NULL, NULL, NULL),
(13, 'Boxing', 'Mempelajari teknik olahraga Boxing', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `extracurricular_photos`
--

CREATE TABLE `extracurricular_photos` (
  `id` int(11) NOT NULL,
  `extracurricular_id` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `extracurricular_photos`
--

INSERT INTO `extracurricular_photos` (`id`, `extracurricular_id`, `filename`) VALUES
(1, 8, 'Karawitan_1.jpg'),
(2, 8, 'Karawitan_2.jpg'),
(3, 8, 'Karawitan_3.jpg'),
(4, 8, 'Karawitan_4.jpg'),
(6, 8, 'Karawitan_5.jpg\r\n'),
(7, 11, 'English_1.jpg'),
(8, 11, 'English_2.jpg'),
(9, 11, 'English_3.jpg'),
(10, 11, 'English_4.jpg'),
(11, 11, 'English_5.jpg'),
(12, 11, 'English_6.jpg'),
(13, 1, 'Japanese_1.jpg'),
(14, 1, 'Japanese_2.jpg'),
(15, 1, 'Japanese_3.jpg'),
(16, 1, 'Japanese_4.jpg'),
(17, 1, 'Japanese_5.jpg'),
(18, 1, 'Japanese_6.jpg'),
(19, 2, 'Futsal_1.jpg'),
(20, 2, 'Futsal_2.jpg'),
(21, 2, 'Futsal_3.jpg'),
(22, 2, 'Futsal_4.jpg'),
(23, 2, 'Futsal_5.jpg'),
(24, 2, 'Futsal_6.jpg'),
(25, 3, 'Paskibra_1.jpg'),
(26, 3, 'Paskibra_2.jpg'),
(27, 3, 'Paskibra_3.jpg'),
(28, 3, 'Paskibra_4.jpg'),
(29, 3, 'Paskibra_5.jpg'),
(30, 3, 'Paskibra_6.jpg'),
(31, 5, 'Pemrograman_1.jpg'),
(32, 5, 'Pemrograman_2.jpg'),
(33, 6, 'Music_1.jpg'),
(34, 6, 'Music_2.jpg'),
(35, 7, 'Vocal_1.jpg'),
(36, 7, 'Vocal_2.jpg'),
(37, 7, 'Vocal_3.jpg'),
(38, 7, 'Vocal_4.jpg'),
(39, 9, 'Pramuka_1.jpg'),
(40, 9, 'Pramuka_2.jpg'),
(41, 9, 'Pramuka_3.jpg'),
(42, 9, 'Pramuka_4.jpg'),
(43, 9, 'Pramuka_5.jpg'),
(44, 9, 'Pramuka_6.jpg'),
(45, 10, 'Osis_1.jpg'),
(46, 10, 'Osis_2.jpg'),
(47, 10, 'Osis_3.jpg'),
(48, 10, 'Osis_4.jpg'),
(49, 10, 'Osis_5.jpg'),
(50, 10, 'Osis_6.jpg'),
(51, 12, 'Rohis_1.jpg'),
(52, 12, 'Rohis_2.jpg'),
(53, 13, 'Boxing_1.jpg'),
(54, 13, 'Boxing_2.jpg'),
(55, 13, 'Boxing_3.jpg'),
(56, 13, 'Boxing_4.jpg'),
(57, 13, 'Boxing_5.jpg'),
(58, 13, 'Boxing_6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_nis` varchar(20) NOT NULL,
  `student_class` varchar(20) NOT NULL,
  `extracurricular_id` int(11) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `student_name`, `student_nis`, `student_class`, `extracurricular_id`, `phone_number`, `email`, `registration_date`, `status`) VALUES
(8, 'muhammad rafi ghani', '0085928905', 'RPL 2', 2, '085860597186', 'muhammadrafighani4@gmail.com', '2025-07-19 23:02:18', 'approved'),
(9, 'muhammad rafi ghani', '0085928905', 'XI-RPL 2', 1, '085860597186', 'rafighani1712@gmail.com', '2025-07-20 04:43:46', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(64337198, 'Admin#123', '$2y$10$CvIztC5UmV7dm01htY8AuuefjIV9QKc0cLnhMx.HvEGNFWfTOIN..', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `extracurricular`
--
ALTER TABLE `extracurricular`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extracurricular_photos`
--
ALTER TABLE `extracurricular_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extracurricular_id` (`extracurricular_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `extracurricular`
--
ALTER TABLE `extracurricular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `extracurricular_photos`
--
ALTER TABLE `extracurricular_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64337199;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`extracurricular_id`) REFERENCES `extracurricular` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
