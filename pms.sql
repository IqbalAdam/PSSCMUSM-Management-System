-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 02:28 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_ID`, `name`, `username`, `password`) VALUES
(1, 'MUHAMMAD IQBAL ADAM', 'iqbal', 'admin'),
(2, 'AB HAFIZ AB MAJID', 'abdhafiz', '123456'),
(3, 'AB MAJID ISMAIL', 'ardrmajid', '123');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `class_id`, `student_id`) VALUES
(1, 1, 31),
(5, 1, 44),
(6, 1, 12),
(7, 1, 33),
(8, 1, 40),
(10, 3, 31),
(11, 3, 25),
(12, 4, 40),
(13, 4, 41),
(20, 9, 31),
(21, 1, 45),
(22, 2, 45),
(23, 4, 45),
(24, 24, 50),
(25, 1, 50),
(26, 1, 45),
(27, 1, 44),
(28, 1, 43),
(29, 1, 41),
(31, 1, 40),
(33, 1, 33),
(34, 1, 33),
(35, 1, 31),
(36, 1, 14),
(37, 1, 32),
(38, 3, 50),
(39, 3, 45),
(40, 3, 3),
(41, 3, 4),
(42, 3, 41),
(43, 3, 14),
(44, 3, 44),
(45, 3, 31),
(47, 3, 12),
(48, 3, 32),
(49, 3, 43),
(61, 31, 3),
(62, 31, 4),
(63, 31, 7),
(64, 31, 8),
(65, 31, 10),
(66, 31, 12),
(68, 14, 3),
(69, 14, 4),
(70, 14, 7),
(71, 14, 10),
(73, 14, 8),
(74, 14, 12),
(76, 14, 31),
(77, 14, 32),
(78, 14, 33),
(80, 14, 40),
(81, 14, 41),
(82, 14, 42),
(83, 14, 43),
(84, 14, 50),
(85, 14, 45),
(86, 14, 44),
(87, 14, 53),
(88, 14, 25),
(89, 14, 14),
(91, 15, 3),
(92, 15, 4),
(93, 15, 8),
(94, 15, 10),
(95, 15, 25),
(96, 15, 32),
(97, 15, 42),
(98, 15, 41),
(99, 15, 44),
(100, 15, 50),
(101, 15, 53),
(102, 16, 44),
(103, 16, 42),
(104, 16, 40),
(105, 16, 33),
(106, 16, 32),
(107, 16, 4),
(108, 16, 3),
(110, 16, 31),
(111, 16, 14),
(112, 16, 12),
(113, 16, 10),
(114, 16, 53),
(117, 17, 3),
(118, 17, 4),
(119, 17, 7),
(120, 17, 8),
(121, 17, 10),
(122, 17, 14),
(123, 17, 12),
(124, 17, 31),
(125, 17, 25),
(126, 17, 32),
(127, 17, 33),
(129, 17, 53),
(130, 17, 50),
(132, 17, 40),
(133, 17, 43),
(134, 10, 3),
(135, 10, 4),
(136, 10, 7),
(137, 10, 8),
(138, 10, 10),
(139, 10, 12),
(140, 10, 25),
(141, 10, 31),
(142, 10, 41),
(144, 10, 42),
(145, 10, 44),
(146, 10, 53),
(147, 10, 50),
(148, 10, 45),
(149, 9, 4),
(151, 9, 12),
(152, 9, 14),
(153, 9, 25),
(154, 9, 8),
(155, 9, 33),
(156, 9, 32),
(157, 9, 41),
(158, 9, 45),
(159, 9, 53),
(160, 9, 50),
(161, 9, 43),
(162, 9, 42),
(163, 9, 44),
(164, 9, 40),
(166, 9, 10),
(167, 9, 7),
(168, 9, 3),
(169, 3, 40),
(170, 3, 53),
(171, 3, 8),
(172, 11, 8),
(173, 11, 10),
(174, 11, 14),
(175, 11, 32),
(176, 11, 33),
(177, 11, 31),
(178, 11, 7),
(181, 11, 41),
(182, 11, 44),
(183, 11, 50),
(184, 11, 53),
(185, 2, 4),
(186, 2, 8),
(187, 2, 31),
(188, 2, 25),
(189, 2, 12),
(190, 2, 10),
(191, 2, 33),
(192, 2, 53),
(193, 2, 50),
(194, 2, 44),
(195, 2, 43),
(196, 2, 42),
(197, 2, 41),
(198, 2, 40),
(200, 22, 45),
(201, 22, 43),
(202, 22, 41),
(204, 22, 32),
(205, 22, 4),
(206, 22, 8),
(207, 22, 12),
(208, 22, 25),
(209, 22, 31),
(211, 22, 3),
(212, 22, 53),
(214, 22, 42),
(215, 22, 50),
(216, 4, 10),
(217, 4, 7),
(219, 4, 33),
(223, 4, 32),
(224, 4, 31),
(226, 18, 3),
(227, 18, 4),
(228, 18, 7),
(229, 18, 8),
(230, 18, 10),
(231, 18, 12),
(232, 18, 25),
(233, 18, 14),
(234, 18, 32),
(235, 18, 31),
(236, 18, 44),
(237, 18, 45),
(238, 18, 53),
(239, 18, 54),
(240, 18, 42),
(241, 18, 40),
(243, 19, 4),
(244, 19, 31),
(245, 19, 32),
(246, 19, 33),
(247, 19, 10),
(248, 19, 12),
(249, 19, 41),
(250, 19, 40),
(251, 19, 43),
(252, 19, 45),
(253, 19, 50),
(254, 19, 53),
(255, 19, 54),
(256, 19, 44),
(257, 19, 42),
(261, 20, 4),
(262, 20, 10),
(263, 20, 31),
(264, 20, 25),
(265, 20, 12),
(266, 20, 8),
(268, 20, 42),
(269, 20, 44),
(270, 20, 50),
(271, 20, 53),
(272, 20, 45),
(273, 20, 43),
(275, 20, 33),
(276, 20, 32),
(277, 20, 3),
(278, 20, 7),
(279, 20, 14),
(280, 20, 40),
(281, 20, 41),
(282, 20, 54),
(283, 21, 7),
(284, 21, 14),
(285, 21, 33),
(286, 21, 12),
(287, 21, 8),
(288, 21, 3),
(289, 21, 32),
(290, 21, 25),
(292, 21, 44),
(293, 21, 50),
(294, 21, 53),
(295, 21, 54),
(296, 21, 45),
(297, 21, 43),
(298, 21, 41),
(300, 23, 4),
(302, 23, 8),
(303, 23, 10),
(304, 23, 14),
(305, 23, 31),
(306, 23, 32),
(307, 23, 33),
(308, 23, 42),
(311, 23, 41),
(312, 23, 40),
(313, 23, 43),
(314, 23, 44),
(317, 23, 54),
(318, 23, 53),
(319, 23, 50),
(320, 23, 45),
(321, 23, 12),
(322, 23, 7),
(323, 24, 4),
(325, 24, 31),
(326, 24, 32),
(328, 24, 8),
(329, 24, 7),
(330, 24, 12),
(331, 24, 10),
(332, 24, 25),
(333, 24, 14),
(334, 24, 3),
(335, 24, 33),
(337, 24, 41),
(339, 24, 40),
(341, 24, 53),
(342, 24, 44),
(343, 24, 45),
(344, 24, 43),
(345, 24, 42),
(346, 24, 54),
(347, 26, 7),
(348, 26, 3),
(350, 26, 12),
(351, 26, 25),
(352, 26, 53),
(354, 26, 45),
(357, 26, 40),
(358, 26, 14),
(359, 26, 32),
(360, 26, 31),
(361, 26, 33),
(363, 26, 55),
(364, 26, 57),
(366, 26, 56),
(367, 26, 54),
(368, 26, 50),
(369, 26, 42),
(370, 26, 43),
(371, 26, 44),
(372, 26, 41),
(374, 26, 10),
(375, 26, 8),
(376, 26, 4),
(378, 33, 4),
(379, 33, 10),
(380, 33, 32),
(381, 33, 33),
(382, 33, 31),
(383, 33, 14),
(384, 33, 12),
(385, 33, 8),
(386, 33, 7),
(388, 33, 43),
(389, 33, 41),
(390, 33, 40),
(393, 33, 50),
(394, 33, 45),
(395, 33, 44),
(396, 33, 56),
(398, 33, 57),
(400, 33, 54),
(401, 33, 55),
(402, 33, 53),
(404, 35, 31),
(405, 36, 31),
(415, 44, 3),
(768, 44, 4),
(769, 44, 7),
(770, 44, 8),
(772, 44, 25),
(773, 44, 32),
(774, 44, 33),
(775, 44, 31),
(776, 44, 14),
(777, 44, 12),
(778, 44, 10),
(779, 44, 45),
(780, 44, 43),
(782, 44, 40),
(783, 44, 41),
(784, 44, 42),
(785, 44, 44),
(786, 44, 50),
(787, 44, 53),
(788, 44, 54),
(790, 44, 55),
(791, 44, 56),
(792, 44, 57),
(1130, 76, 3),
(1131, 76, 7),
(1133, 76, 57),
(1134, 76, 56),
(1135, 76, 55),
(1136, 76, 53),
(1137, 76, 50),
(1138, 76, 45),
(1139, 76, 43),
(1140, 76, 40),
(1141, 76, 33),
(1142, 76, 32),
(1143, 76, 31),
(1144, 76, 14),
(1145, 76, 10),
(1146, 76, 8),
(1147, 76, 12),
(1149, 36, 4),
(1150, 36, 7),
(1151, 36, 10),
(1152, 36, 25),
(1153, 36, 33),
(1154, 36, 32),
(1155, 36, 14),
(1156, 36, 12),
(1158, 36, 43),
(1159, 36, 44),
(1160, 36, 50),
(1161, 36, 53),
(1164, 36, 57),
(1165, 36, 56),
(1166, 36, 55),
(1167, 36, 54),
(1168, 36, 45),
(1169, 36, 42),
(1170, 36, 41),
(1171, 36, 40),
(1173, 36, 8),
(1174, 36, 3),
(1703, 80, 57),
(1705, 80, 45),
(1706, 80, 56),
(1707, 80, 31),
(1708, 35, 3),
(1709, 35, 7),
(1710, 35, 10),
(1711, 35, 14),
(1712, 35, 53),
(1713, 35, 56),
(1714, 35, 45),
(1715, 35, 41),
(1716, 35, 40),
(1718, 35, 54),
(1719, 35, 55),
(1720, 35, 32),
(1721, 35, 44),
(1722, 35, 43),
(1723, 35, 42),
(1724, 31, 32),
(1726, 31, 53),
(1727, 31, 44),
(1728, 31, 31),
(1730, 31, 56),
(1731, 31, 55),
(1732, 31, 57),
(1733, 80, 3),
(1734, 80, 8),
(1735, 80, 43),
(1736, 80, 54),
(1738, 80, 55),
(1739, 80, 50),
(1740, 80, 41),
(1741, 80, 32),
(1742, 80, 12),
(1743, 80, 14),
(1744, 80, 25),
(1750, 15, 57),
(1751, 15, 56),
(1752, 15, 55),
(1753, 15, 54),
(1754, 15, 45),
(1756, 15, 43),
(1757, 15, 40),
(1759, 15, 33),
(1760, 15, 31),
(1761, 15, 14),
(1762, 15, 12),
(1763, 15, 7),
(1765, 81, 56),
(1766, 81, 57),
(1768, 81, 55),
(1769, 81, 54),
(1770, 81, 53),
(1771, 81, 45),
(1772, 81, 43),
(1773, 81, 10),
(1774, 81, 3),
(1775, 81, 7),
(1776, 81, 8),
(1777, 81, 4),
(1778, 81, 14),
(1780, 81, 12),
(1781, 81, 25),
(1782, 81, 33),
(1784, 81, 32),
(1785, 81, 44),
(1786, 81, 42),
(1787, 81, 40),
(1788, 81, 50),
(1789, 82, 57),
(1790, 82, 56),
(1791, 82, 45),
(1795, 82, 55),
(1796, 82, 50),
(1797, 82, 54),
(1798, 82, 32),
(1799, 82, 25),
(1800, 82, 14),
(1801, 82, 7),
(1802, 82, 4),
(1803, 82, 10),
(1804, 82, 43),
(1807, 82, 40),
(1808, 82, 41),
(1809, 82, 42),
(1810, 82, 44),
(1811, 82, 12),
(1812, 82, 8),
(1813, 82, 3),
(1814, 83, 45),
(1815, 83, 56),
(1816, 83, 57),
(1820, 83, 55),
(1821, 83, 54),
(1822, 83, 53),
(1823, 83, 50),
(1824, 83, 42),
(1825, 83, 41),
(1827, 83, 40),
(1828, 83, 25),
(1829, 83, 12),
(1830, 83, 32),
(1831, 83, 33),
(1832, 83, 10),
(1833, 83, 8),
(1834, 83, 7),
(1835, 83, 4),
(1894, 96, 45),
(1895, 96, 31),
(1899, 91, 32),
(1900, 91, 33),
(1903, 91, 44),
(1904, 91, 54),
(1905, 91, 53),
(1906, 91, 50),
(1907, 91, 45),
(1908, 91, 55),
(1909, 91, 57),
(1910, 91, 56),
(1911, 91, 43),
(1912, 91, 40),
(1931, 102, 40),
(1932, 103, 56),
(1933, 103, 31),
(1934, 103, 45),
(1935, 103, 57),
(1937, 103, 4),
(1938, 103, 10),
(1939, 103, 12),
(1940, 103, 14),
(1941, 103, 42),
(1942, 104, 56),
(1943, 104, 45),
(1944, 104, 31),
(1945, 104, 57),
(1946, 106, 56),
(1947, 107, 33),
(1948, 107, 56),
(1949, 3, 33),
(1950, 3, 42),
(1951, 3, 55);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `class_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_date`) VALUES
(1, '2024-05-31'),
(2, '2024-06-01'),
(3, '2024-05-03'),
(4, '2024-05-06'),
(9, '2024-05-24'),
(10, '2024-05-27'),
(11, '2024-06-03'),
(14, '2024-05-10'),
(15, '2024-05-13'),
(16, '2024-05-17'),
(17, '2024-05-20'),
(18, '2024-06-21'),
(19, '2024-07-01'),
(20, '2024-07-05'),
(21, '2024-07-08'),
(22, '2024-06-06'),
(23, '2024-07-19'),
(24, '2024-08-02'),
(26, '2024-08-12'),
(31, '2025-01-03'),
(33, '2024-08-16'),
(35, '2025-01-24'),
(36, '2025-01-13'),
(44, '2024-06-10'),
(76, '2024-06-14'),
(80, '2024-06-24'),
(81, '2025-01-30'),
(82, '2025-01-06'),
(83, '2025-01-17'),
(91, '2024-06-19'),
(96, '2024-06-20'),
(102, '2024-07-05'),
(103, '2024-07-11'),
(104, '2024-07-22'),
(105, '2024-07-23'),
(106, '2024-07-06'),
(107, '2024-08-06'),
(108, '2024-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `matric_id` varchar(10) NOT NULL,
  `level` int(3) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `ic_number` varchar(12) NOT NULL,
  `school` varchar(100) NOT NULL,
  `program` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `u1_asas` int(3) NOT NULL,
  `u2_jatuh` int(3) NOT NULL,
  `u3_potong` int(3) NOT NULL,
  `theory` int(11) NOT NULL,
  `ko_k` int(3) NOT NULL,
  `ko_k_2` int(3) NOT NULL,
  `ko_k_3` int(3) NOT NULL,
  `u_usr` int(3) NOT NULL,
  `u_demo` int(3) NOT NULL,
  `end_year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `full_name`, `matric_id`, `level`, `gender`, `ic_number`, `school`, `program`, `email`, `phone`, `image`, `u1_asas`, `u2_jatuh`, `u3_potong`, `theory`, `ko_k`, `ko_k_2`, `ko_k_3`, `u_usr`, `u_demo`, `end_year`) VALUES
(3, 'NUR KAMARINA BINTI AZHARI', '112899', 0, 'female', '001231023546', 'BIOLOGY', '0', '', '', 'uploads/sdm1.png', 99, 100, 87, 91, 2, 0, 0, 0, 0, 2024),
(4, 'SITI SAKIRAH BINTI MUHD NIZAM', '151712', 400, 'female', '001011061272', 'MATHEMATICAL SCIENCES', '0', '', '', 'uploads/individual.png', 88, 70, 0, 79, 0, 0, 0, 0, 0, 0),
(7, 'AJMAL ALI BIN OSMAN', '176331', 0, 'male', '010630140773', 'COMMUNICATION', '0', '', '', 'uploads/module3.png', 87, 100, 0, 93, 0, 0, 0, 0, 0, 0),
(8, 'NUR IRDINA BINTI SAMSUDIN', '163551', 0, 'female', '020118140213', 'TECHOLOGY INDUSTRY', '0', '', '', 'uploads/module3.png', 75, 78, 0, 100, 0, 0, 0, 0, 0, 0),
(10, 'SITI NUR AMALIA BINTI HARUN', '180246', 0, 'female', '031112140149', 'PHYSICS', '0', '', '', 'uploads/module1.png', 76, 92, 0, 99, 0, 0, 0, 0, 0, 0),
(12, 'MUHAMMAD NADHIR ISKANDAR BIN SHAFIK AKMAL', '164554', 0, 'male', '170802021159', 'SOCIAL SCIENCE', '0', '', '', 'uploads/module1.png', 92, 87, 0, 79, 0, 0, 0, 0, 0, 0),
(14, 'MOKHTAR BIN DAHARI', '144574', 0, 'male', '990115074549', 'COMMUNICATION', '0', '', '', 'uploads/attendance.png', 92, 77, 0, 81, 0, 0, 0, 0, 0, 0),
(25, 'SITI AISYAH BINTI SARMAN ', '145699', 0, 'female', '000411032566', 'PHYSICS', '0', '', '', 'uploads/dropdown.png', 40, 50, 0, 77, 0, 0, 0, 0, 0, 0),
(31, 'MUHAMMAD AQIL SOFIY BIN MOHAMAD SAUPI', '150692', 0, 'male', '01308073349', 'ARTS', '0', '', '', 'uploads/ProfilePic_Aqil.png', 93, 86, 0, 100, 0, 0, 0, 0, 0, 0),
(32, 'NUR ADLINA BINTI ZAHIR', '144796', 0, 'male', '030516014588', 'HOUSING, BUILDING AND PLANNING', '0', '', '', 'uploads/adlina.png', 88, 72, 0, 96, 0, 0, 0, 0, 0, 0),
(33, 'AHMAD FARHAN BIN ABU HANIFAH', '172323', 0, 'male', '020730091243', 'SOCIAL SCIENCE', '0', '', '', 'uploads/farhan.png', 97, 94, 0, 100, 0, 0, 0, 0, 0, 0),
(40, 'NURSHUADA BINTI CHE AZMI', '163841', 0, 'female', '010114031446', 'TECHOLOGY INDUSTRY', '0', '', '', 'uploads/female.png', 92, 94, 0, 89, 0, 0, 0, 0, 0, 0),
(41, 'MOHD AKMAL HAZIM BIN SHARIFF', '123789', 0, 'female', '030409141249', 'COMPUTER SCIENCE', '0', '', '', 'uploads/farhan.png', 40, 38, 0, 72, 0, 0, 0, 0, 0, 0),
(42, 'IRDINA BINTI RAHMAN YUSOF', '158231', 0, 'female', '000630014576', 'COMMUNICATION', '0', '', '', 'uploads/student_picture.png', 78, 58, 0, 96, 0, 0, 0, 0, 0, 0),
(43, 'NUR AISYAH BINTI MAT JUSOF', '142301', 0, 'female', '010229051548', 'ARTS', '0', '', '', 'uploads/10203119.png', 90, 88, 0, 99, 0, 0, 0, 0, 0, 0),
(44, 'KAMARUL BIN ZAMRI', '152001', 0, 'male', '030730111899', 'COMPUTER SCIENCE', '0', '', '', 'uploads/sdm1.png', 100, 100, 0, 100, 0, 0, 0, 0, 0, 0),
(45, 'SITI NUR AINAA BINTI MOHD AZAM', '170023', 0, 'female', '014575687620', 'HOUSING, BUILDING AND PLANNING', '0', '', '', 'uploads/female.png', 91, 49, 0, 72, 0, 0, 0, 0, 0, 0),
(50, 'WAN HAZIM BIN WAN SARMAN', '100741', 0, 'male', '010911051423', 'BIOLOGY', '0', '', '', 'uploads/sdm1.png', 59, 78, 0, 63, 0, 0, 0, 0, 0, 0),
(53, 'AL-KHAWARIZMI BIN MOKHRIZAN', '201338', 0, 'male', '000718074233', 'BIOLOGY', '0', '', '', 'uploads/farhan.png', 88, 53, 0, 77, 0, 0, 0, 0, 0, 0),
(54, 'NURUL NATAYSA BINTI MUHAMMAD RAIF', '144230', 0, 'female', '041129081244', 'COMPUTER SCIENCE', '0', '', '', 'uploads/10203119.png', 90, 100, 0, 80, 0, 0, 0, 0, 0, 0),
(55, 'NOR SYAHIRAH BINT MD ABU', '100326', 0, 'male', '991212070826', 'PHYSICS', '0', '', '', 'uploads/10203119.png', 80, 79, 0, 100, 0, 0, 0, 0, 0, 0),
(56, 'SITI NOR AIN BINTI SARMAN', '147080', 0, 'female', '981130021282', 'SOCIAL SCIENCE', '0', '', '', 'uploads/4329449.png', 50, 70, 0, 90, 0, 0, 0, 0, 0, 0),
(57, 'MOHD DANIAL HAKIM BIN HUSNI', '170320', 0, 'male', '020915023697', 'COMPUTER SCIENCE', '0', '', '', 'uploads/3233508.png', 71, 83, 0, 82, 0, 0, 0, 0, 0, 0),
(525, 'ABDUL ARIF HAFIZUDDIN BIN ABDUL RAZAK', '22304202', 100, 'male', '041101010437', 'PUSAT PENGAJIAN SAINS KOMPUTER', 'SAINS KOMPUTER', 'arifarqriz@student.usm.my', '0136073312', '', 80, 77, 65, 60, 5, 0, 0, 0, 0, 0),
(526, 'AHMAD AMMAR BIN AHMAD HILMI', '22305435', 100, 'male', '021001020699', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'EKONOMI', 'ammarhilmi18@student.usm.my', '01160728179', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(527, 'AISYA SOFIA BINTI SALAHUDDIN', '22300735', 100, 'female', '021021020928', 'PUSAT PENGAJIAN TEKNOLOGI INDUSTRI', 'SJ. MUDA TEKNOLOGI KEJ. BIOPRO', 'aisyapia@student.usm.my', '01172662425', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(528, 'ANIS SURAYA BINTI ANUAR', '22301509', 100, 'female', '040430070110', 'PUSAT PENGAJIAN SAINS KIMIA', 'SAINS (KIMIA)', 'anis97872@student.usm.my', '0184077450', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(529, 'ARNI AMIERA BINTI IBRAHIM', '22303960', 100, 'female', '040817140486', 'PUSAT PENGAJIAN SAINS FIZIK', 'SAINS GUNAAN ( FIZIK )', 'arniamiera04@student.usm.my', '01165574169', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(530, 'FATIN AMIRA BINTI ABD RAHIM', '22303455', 100, 'female', '040218060644', 'PUSAT PENGAJIAN PENGURUSAN', 'PERAKAUNAN', 'fatinamira86@student.usm.my', '01137504091', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(531, 'HUSNA BINTI ABD MALEK', '22301385', 100, 'female', '030506040112', 'PUSAT PENGAJIAN TEKNOLOGI INDUSTRI', 'SJ. MUDA TEKNOLOGI KEJ. BIOPRO', 'husnamalek0506@student.usm.my', '0176205922', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(532, 'MALIQUE AYMAN BIN MOHD YASSIN', '22303525', 100, 'male', '040317070071', 'PUSAT PENGAJIAN SAINS FIZIK', 'SAINS GUNAAN ( FIZIK )', 'malique.ayman@student.usm.my', '0195073468', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(533, 'MOHAMAD SAUTUL IMAN BIN MOHD SAIFUL', '22302972', 100, 'male', '040224080537', 'PUSAT PENGAJIAN SAINS KAJIHAYAT', 'SAINS GUNAAN (BIOLOGI)', 'imansaiful0402@student.usm.my', '0138635439', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(534, 'MUHAMMAD AFIQ BIN SHAIPULBAHRI', '22303156', 100, 'male', '031025070315', 'PUSAT PENGAJIAN SAINS KOMPUTER', 'SAINS KOMPUTER', 'afiq231@student.usm.my', '01156406346', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(535, 'MUHAMMAD AIMAN BIN MOHD HATTA', '22302874', 100, 'male', '040915100349', 'PUSAT PENGAJIAN PENGURUSAN', 'PENGURUSAN', 'aimanhatta@student.usm.my', '01116237227', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(536, 'MUHAMMAD ALIF SYAFIQ KHAIRIL ANWAR', '22301492', 100, 'male', '030830070081', 'PUSAT PENGAJIAN SAINS KIMIA', 'SAINS (KIMIA)', 'alif.syafiq@student.usm.my', '01137250733', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(537, 'MUHAMMAD HARITH BIN ABU BAKAR', '163240', 100, 'male', '030210081003', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'EKONOMI', 'harith6137@student.usm.my', '01137874090', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(538, 'NUR A`LIA NADHIRAH BINTI ABDUL RAHMAN', '22303027', 100, 'female', '040924101888', 'PUSAT PENGAJIAN SAINS MATEMATIK', 'SAINS GUNAAN (MATEMATIK)', 'alianurnadhirah@student.usm.my', '0178411491', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(539, 'NUR ADIBAH BINTI MOHD AZHAR', '22301199', 100, 'female', '030220050278', 'PUSAT PENGAJIAN TEKNOLOGI INDUSTRI', 'SJ. MUDA TEKNOLOGI KEJ. BIOPRO', 'adibahazhar03@student.usm.my', '01128334759', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(540, 'NUR ADLIN NATASYA BINTI NASIP', '22301531', 100, 'female', '041019011510', 'PUSAT PENGAJIAN SAINS KIMIA', 'SAINS (KIMIA)', 'adlinatasya1910@student.usm.my', '01169720690', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(541, 'NUR AZIKIN', '22303193', 100, 'female', '031114120214', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'EKONOMI', 'azikinsamsuddin@student.usm.my', '0164067240', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(542, 'NUR AZIYANNY BINTI ABDULLAH', '22302865', 100, 'female', '040701010882', 'PUSAT PENGAJIAN PENGURUSAN', 'PENGURUSAN', 'nuraziyanny17@student.usm.my', '0137986094', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(543, 'NUR DIANAH AZWA BINTI SHAHARUDDIN', '22302857', 100, 'female', '040511100908', 'PUSAT PENGAJIAN PENGURUSAN', 'PENGURUSAN', 'dianahazwa@student.usm.my', '0142519411', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(544, 'NUR HAZIMAH BINTI ABDUL HAMID', '22301527', 100, 'female', '040908080570', 'PUSAT PENGAJIAN SAINS KIMIA', 'SAINS (KIMIA)', 'nurhazimah@student.usm.my', '01114352740', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(545, 'NUR IZNI HANANI BINTI ABDUL MOHSIN', '22301571', 100, 'female', '040109010736', 'PUSAT PENGAJIAN ILMU KEMANUSIAAN', 'SASTERA (TERJ. & INTERPRETASI ', 'iznihanani04@student.usm.my', '01158555486', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(546, 'NUR NABIHAH BINTI DAHARI', '22301695', 100, 'female', '041222060502', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'EKONOMI', 'nabihahdahari@student.usm.my', '0196405649', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(547, 'NUR SERI ATIELA NATASYA BINTI ZAINUL AMIN', '22303094', 100, 'female', '040312020614', 'PUSAT PENGAJIAN SAINS KAJIHAYAT', 'SAINS ( BIOLOGI )', 'seriatiela12@student.usm.my', '01172502038', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(548, 'NUR WAHEEDA NADZMA BINTI ABD RAZAK', '22303050', 100, 'female', '031129020486', 'PUSAT PENGAJIAN ILMU KEMANUSIAAN', 'SASTERA ( I.KEMANUSIAAN )', 'nadzmawaheeda@student.usm.my', '0195277174', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(549, 'NURIZZATI SAFIAH BINTI AHMAD NIZAM', '22303486', 100, 'female', '040302140110', 'PUSAT PENGAJIAN SAINS KIMIA', 'SAINS GUNAAN (KIMIA)', 'izzatizam234@student.usm.my', '0162127372', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(550, 'SITI AISHAH BINTI MOHAMED NOR', '22301929', 100, 'female', '040110031008', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'SAINS KEMASYARAKATAN', 'aishahayish@student.usm.my', '01126864773', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(551, 'SITI NUR ALLISYA NURULZAMAN BINTI ABDULLAH', '22301816', 100, 'female', '041211140742', 'PUSAT PENGAJIAN PENGURUSAN', 'PENGURUSAN', 'nurallisya@student.usm.my', '0194952520', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(552, 'SITI NURJANNATUL HUSNA BINTI MOHD. YAZID', '22303657', 100, 'female', '040424160224', 'PUSAT PENGAJIAN SAINS MATEMATIK', 'SAINS ( MATEMATIK )', 'sitinurjannatul204@student.usm.my', '0138023744', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(553, 'SITI NURUL ATIQAH BINTI MAZLAN', '22300719', 100, 'female', '020925010242', 'PUSAT PENGAJIAN SAINS MATEMATIK', 'SAINS ( MATEMATIK )', 'atiqahmazlan259@student.usm.my', '01151631500', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(554, 'UMIE NADHIRAH BINTI ABDUL GHANI', '165254', 100, 'female', '991011146196', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'SAINS KEMASYARAKATAN', 'umienadhirah@student.usm.my', '01119190369', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(555, 'YANG SAHIRA BINTI MUHAMMAD SAYUTI', '22302018', 100, 'female', '040424070480', 'PUSAT PENGAJIAN TEKNOLOGI INDUSTRI', 'TEKNOLOGI INDUSTRI (MAKANAN)', 'yangs@student.usm.my', '01151112456', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(591, 'ABU HANIFAH BIN HAMDZAH', '157679', 200, 'male', '011024020377', 'PUSAT PENGAJIAN SAINS KAJIHAYAT', 'SAINS ( BIOLOGI )', 'abu.han52410@student.usm.my', '01111472783', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(592, 'AHMAD ALI BIN FIROUZ', '164691', 200, 'male', '990426146353', 'PUSAT PENGAJIAN KOMUNIKASI', 'KOMUNIKASI', 'ahmadali99@student.usm.my', '0197438442', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(593, 'AHMAD MUNTAZAR BIN KHALID KHAN', '160814', 200, 'male', '000110050093', 'PUSAT PENGAJIAN PERUMAHAN BANGUNAN DAN PERANCANGAN', 'TEKNOLOGI KEJURUTERAAN BANGUNA', 'ahmadmuntazar0@student.usm.my', '0197450629', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(594, 'AHMAD SAID BIN ZULKEFLI', '160366', 200, 'male', '030214140701', 'PUSAT PENGAJIAN SAINS FARMASI', 'FARMASI', 'said@student.usm.my', '01159522261', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(595, 'AHMAD ZA`IM BIN ROSLI', '164579', 200, 'male', '031229070421', 'PUSAT PENGAJIAN SAINS KOMPUTER', 'SAINS KOMPUTER', 'zaimrosli2003@student.usm.my', '0134591239', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(596, 'AIMAN FITRI BIN HAZLIN', '162929', 200, 'male', '021203050263', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'SAINS KEMASYARAKATAN', 'aiman2020@student.usm.my', '01162370667', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(597, 'AMIRAH SYAHMINA BINTI FIRDAUS', '160475', 200, 'female', '030723080030', 'PUSAT PENGAJIAN SAINS FIZIK', 'SAINS GUNAAN ( FIZIK )', 'amirahsyahmina2307@student.usm.my', '0149445881', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(598, 'AMIRUL AKMAL BIN MOHD NOOR', '162187', 200, 'male', '020721070307', 'PUSAT PENGAJIAN SAINS KOMPUTER', 'SAINS KOMPUTER', 'amirulmeon@student.usm.my', '0138907119', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(599, 'ANWAR RIDHWAN BIN MOHD SABRI', '161269', 200, 'male', '011008030655', 'PUSAT PENGAJIAN SAINS KOMPUTER', 'SAINS KOMPUTER', 'anwarridhwan01@student.usm.my', '01165180655', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(600, 'ARIF HAKIM BIN AMIR HAKIM', '161120', 200, 'male', '020126100479', 'PUSAT PENGAJIAN SAINS KOMPUTER', 'SAINS KOMPUTER', 'arifhakm26@student.usm.my', '0166060068', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(601, 'ARNIE NADHIA BINTI MOHAMMAD HUZAIMAN', '162016', 200, 'female', '020624130638', 'PUSAT PENGAJIAN ILMU KEMANUSIAAN', 'SASTERA ( I.KEMANUSIAAN )', 'arnie@student.usm.my', '01136476064', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(602, 'AYU SYAFIQAH BINTI NORHISHAM', '158963', 200, 'female', '020827070524', 'PUSAT PENGAJIAN SAINS MATEMATIK', 'SAINS GUNAAN (MATEMATIK)', 'ayusyafiqah@student.usm.my', '0197230024', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(603, 'ILLIYA KHAIRANI BINTI MOHD ALI', '163451', 200, 'female', '030409070256', 'PUSAT PENGAJIAN SAINS MATEMATIK', 'SAINS ( MATEMATIK )', 'illiyakhaira94@student.usm.my', '0135475094', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(604, 'KHAIRUNNISA ATHIRAH BINTI KHAIRUL ZAINI', '162770', 200, 'female', '021113100124', 'PUSAT PENGAJIAN SAINS KOMPUTER', 'SAINS KOMPUTER', 'khrnnisa_athirh@student.usm.my', '0103042744', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(605, 'MIRA MIRANI BINTI ANUAR', '156178', 200, 'female', '010110010568', 'PUSAT PENGAJIAN SAINS KAJIHAYAT', 'SAINS GUNAAN (BIOLOGI)', 'miramirani@student.usm.my', '01110723603', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(606, 'MOHD. ZULHILMI BIN ZAHKERIA', '162084', 200, 'male', '020630130749', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'EKONOMI', 'zulhilmizahkeria8@student.usm.my', '0105997002', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(607, 'MUHAMMAD AFIQ HASRAF BIN HAZLY', '164300', 200, 'male', '030925140249', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'SAINS KEMASYARAKATAN', 'hasraf@student.usm.my', '0132027705', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(608, 'MUHAMMAD AFNAN NABIL BIN BADRUL FAHMI', '164488', 200, 'male', '031113101433', 'PUSAT PENGAJIAN SAINS KIMIA', 'SAINS GUNAAN (KIMIA)', 'afnanabil2003@student.usm.my', '0139856599', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(609, 'MUHAMMAD HAZIQ BIN ROZAIDEE', '164205', 200, 'male', '031003010389', 'PUSAT PENGAJIAN SAINS KAJIHAYAT', 'SAINS ( BIOLOGI )', 'mhaziq@student.usm.my', '01161300297', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(610, 'MUHAMMAD IMAN DANIEL BIN MUHAMMAD ASRUL', '162863', 200, 'male', '021122070609', 'PUSAT PENGAJIAN KOMUNIKASI', 'KOMUNIKASI', 'imandnial@student.usm.my', '0109197407', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(611, 'MUHAMMAD SYAHMI BIN ZULKIFLEE', '164089', 200, 'male', '030820101315', 'PUSAT PENGAJIAN PENGURUSAN', 'PERAKAUNAN', 'muhdsyahmi208@student.usm.my', '0133683584', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(612, 'MUHAMMAD SYAHMI IMRAN BIN MUHAMAD FARIS IRFAN', '161971', 200, 'male', '020530030281', 'PUSAT PENGAJIAN PENGURUSAN', 'PENGURUSAN', 'imranirfan@student.usm.my', '0198894024', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(613, 'MUHAMMAD ZAHID BIN KHAIRUL AZMAN', '161547', 200, 'male', '020315080809', 'PUSAT PENGAJIAN PENGURUSAN', 'PENGURUSAN', 'zahidka@student.usm.my', '0197236410', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(614, 'NASUHA BINTI JAFAR RUDIN', '162983', 200, 'female', '030104100012', 'PUSAT PENGAJIAN SAINS KAJIHAYAT', 'SAINS ( BIOLOGI )', 'nasuhajafarrudin@student.usm.my', '01151381307', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(615, 'NOR AIN BINTI AMRAN', '163227', 200, 'female', '030227120232', 'PUSAT PENGAJIAN SAINS FIZIK', 'SAINS GUNAAN ( FIZIK )', 'ainshere@student.usm.my', '0189646292', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(616, 'NOR HANIDA BINTI MAT RAFI', '162142', 200, 'female', '020713060336', 'PUSAT PENGAJIAN SENI', 'SASTERA ( SENI )', 'hanida@student.usm.my', '0133251301', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(617, 'NUR AISHAH BINTI AZMAN', '159430', 200, 'female', '021201080020', 'PUSAT PENGAJIAN SAINS KIMIA', 'SAINS GUNAAN (KIMIA)', 'aishahazman02@student.usm.my', '0183524904', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(618, 'NUR ALEEYA NAJIHAH BINTI YUSOFF', '163793', 200, 'female', '030620050226', 'PUSAT PENGAJIAN ILMU KEMANUSIAAN', 'SASTERA ( B.I.& KESUSASTERAAN ', 'aleeyanaj@student.usm.my', '0123476689', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(619, 'NUR HAJNA ERMINA BINTI HAMDAN', '161318', 200, 'female', '020313070906', 'PUSAT PENGAJIAN PERUMAHAN BANGUNAN DAN PERANCANGAN', 'PERANCANGAN BANDAR DAN WILAYAH', 'hajnahamdan@student.usm.my', '0175442807', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(620, 'NUR IZZATI HUSNA BINTI IBRAHIM', '162986', 200, 'female', '021213020586', 'PUSAT PENGAJIAN SAINS KIMIA', 'SAINS (KIMIA)', 'husnaizzati13@student.usm.my', '0142773794', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(621, 'NUR MAISARAH BINTI ABDUL AZIH', '163787', 200, 'female', '030620080062', 'PUSAT PENGAJIAN SENI', 'SENI HALUS', 'sarah2022@student.usm.my', '0125470937', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(622, 'NUR SYAFIQAH BINTI MUHAMMAD NAZRI', '160982', 200, 'female', '010211110250', 'PUSAT PENGAJIAN SAINS KAJIHAYAT', 'SAINS ( BIOLOGI )', 'nursyafiqah.nazri@student.usm.my', '0199367252', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(623, 'NUR SYAZANA BINTI ABDUL GHANI', '163485', 200, 'female', '030413070128', 'PUSAT PENGAJIAN SAINS KAJIHAYAT', 'SAINS ( BIOLOGI )', 'nursyazanq@student.usm.my', '01161466250', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(624, 'SHARIFAH NURUL HANA BINTI SYED SHAFULAMIN', '164696', 200, 'female', '991012025222', 'PUSAT PENGAJIAN SENI', 'SENI HALUS', 'sharifah.hana99@student.usm.my', '0167291539', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(625, 'SITI NUR AISHAH BINTI ABDUL AZIZ', '163921', 200, 'female', '030715101348', 'PUSAT PENGAJIAN SAINS MATEMATIK', 'SAINS ( MATEMATIK )', 'nuraishahaziz@student.usm.my', '0148140534', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(626, 'ADLAN AFIQ MUSYRIF BIN AZHAR', '159453', 300, 'male', '021209020049', 'PUSAT PENGAJIAN PENGURUSAN', 'PERAKAUNAN', 'adlanafiq0912@student.usm.my', '01161466750', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(627, 'FATIHA ATIERA BINTI MOHD HARIS', '155386', 300, 'female', '020308100082', 'PUSAT PENGAJIAN SAINS KOMPUTER', 'SAINS KOMPUTER', 'atiera2002@student.usm.my', '0183576826', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(628, 'FATIN NURATIQAH BINTI DZARUDIN', '158081', 300, 'female', '011209140164', 'PUSAT PENGAJIAN SAINS KIMIA', 'SAINS (KIMIA)', 'fatin_atiqah@student.usm.my', '01113317117', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(629, 'HAZIQAH ULFAH BINTI MOHAMAD', '158869', 300, 'female', '020716070556', 'PUSAT PENGAJIAN SAINS FARMASI', 'FARMASI', 'haziqah131@student.usm.my', '0123449414', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(630, 'MUHAMAD ADIB BIN MD NOOR', '157855', 300, 'male', '011109020229', 'PUSAT PENGAJIAN ILMU KEMANUSIAAN', 'SASTERA ( I.KEMANUSIAAN )', 'adibmdnoor@student.usm.my', '01140721399', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(631, 'MUHAMMAD IRFAN HARITH BIN HAMRI', '158405', 300, 'male', '020604110269', 'PUSAT PENGAJIAN SAINS KOMPUTER', 'SAINS KOMPUTER', 'irfanharith0406@student.usm.my', '0139320576', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(632, 'NUR AIEN SYAHIRAH', '155885', 300, 'female', '000420012420', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'KERJA SOSIAL', 'nasyahirah6@student.usm.my', '01128625987', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(633, 'NUR FARAH NATASYA BINTI ZULKFLI', '156263', 300, 'female', '010209030980', 'PUSAT PENGAJIAN ILMU KEMANUSIAAN', 'SASTERA ( B.I.& KESUSASTERAAN ', 'farahzulkfli@student.usm.my', '0139479781', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(634, 'NUR SHAZMALIA HANIM BINTI JAMALUDIN', '159471', 300, 'female', '021231021072', 'PUSAT PENGAJIAN SAINS MATEMATIK', 'SAINS GUNAAN (MATEMATIK)', 'n.shazmaliahanim@student.usm.my', '0195064880', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(635, 'NURSHAFIKAH BINTI RAHIMIN', '158867', 300, 'female', '020716030888', 'PUSAT PENGAJIAN SAINS MATEMATIK', 'SAINS ( MATEMATIK )', 'shafikahrahimin16@student.usm.my', '0105614541', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(636, 'NURSHUADA BINTI CHE AZMI', '156152', 300, 'female', '010114030646', 'PUSAT PENGAJIAN TEKNOLOGI INDUSTRI', 'TEKNOLOGI INDUSTRI', 'shucheazmi@student.usm.my', '0137043646', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(637, 'SITI AMIENA BINTI AZIZAN', '159345', 300, 'female', '021121020634', 'PUSAT PENGAJIAN ILMU KEMANUSIAAN', 'SASTERA ( B.I.& KESUSASTERAAN ', 'sitiamiena@student.usm.my', '0102173748', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(638, 'SITI NURAZWA BINTI ISHAR', '159004', 300, 'female', '020828020828', 'PUSAT PENGAJIAN SAINS FIZIK', 'SAINS GUNAAN ( FIZIK )', 'nurazwaishar@student.usm.my', '0125808700', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(639, 'WAN MAZNI BINTI WAN MOHD MAZUKI', '155255', 300, 'female', '021007110046', 'PUSAT PENGAJIAN SAINS KAJIHAYAT', 'SAINS GUNAAN (BIOLOGI)', 'wanmazni781021@student.usm.my', '0139609124', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(640, 'ZAINUL ARIFFIN BIN KHOMARON AZHAR', '158059', 300, 'male', '011216010405', 'PUSAT PENGAJIAN SAINS KAJIHAYAT', 'SAINS ( BIOLOGI )', 'ariffin161201@student.usm.my', '01155044629', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ic_number` varchar(20) NOT NULL,
  `matric_id` varchar(20) NOT NULL,
  `school` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `ic_number`, `matric_id`, `school`, `program`, `email`, `phone`) VALUES
(1, 'ABDUL ARIF HAFIZUDDIN BIN ABDUL RAZAK', '041101010437', '22304202', 'PUSAT PENGAJIAN SAINS KOMPUTER', 'SAINS KOMPUTER', 'arifarqriz@student.usm.my', '0136073312'),
(2, 'AHMAD AMMAR BIN AHMAD HILMI', '021001020699', '22305435', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'EKONOMI', 'ammarhilmi18@student.usm.my', '01160728179'),
(3, 'AISYA SOFIA BINTI SALAHUDDIN', '021021020928', '22300735', 'PUSAT PENGAJIAN TEKNOLOGI INDUSTRI', 'SJ. MUDA TEKNOLOGI KEJ. BIOPROSES', 'aisyapia@student.usm.my', '01172662425'),
(4, 'ANIS SURAYA BINTI ANUAR', '040430070110', '22301509', 'PUSAT PENGAJIAN SAINS KIMIA', 'SAINS (KIMIA)', 'anis97872@student.usm.my', '0184077450'),
(5, 'ARNI AMIERA BINTI IBRAHIM', '040817140486', '22303960', 'PUSAT PENGAJIAN SAINS FIZIK', 'SAINS GUNAAN ( FIZIK )', 'arniamiera04@student.usm.my', '01165574169'),
(6, 'FATIN AMIRA BINTI ABD RAHIM', '040218060644', '22303455', 'PUSAT PENGAJIAN PENGURUSAN', 'PERAKAUNAN', 'fatinamira86@student.usm.my', '01137504091'),
(7, 'HUSNA BINTI ABD MALEK', '030506040112', '22301385', 'PUSAT PENGAJIAN TEKNOLOGI INDUSTRI', 'SJ. MUDA TEKNOLOGI KEJ. BIOPROSES', 'husnamalek0506@student.usm.my', '0176205922'),
(8, 'MALIQUE AYMAN BIN MOHD YASSIN', '040317070071', '22303525', 'PUSAT PENGAJIAN SAINS FIZIK', 'SAINS GUNAAN ( FIZIK )', 'malique.ayman@student.usm.my', '0195073468'),
(9, 'MOHAMAD SAUTUL IMAN BIN MOHD SAIFUL', '040224080537', '22302972', 'PUSAT PENGAJIAN SAINS KAJIHAYAT', 'SAINS GUNAAN (BIOLOGI)', 'imansaiful0402@student.usm.my', '0138635439'),
(10, 'MUHAMMAD AFIQ BIN SHAIPULBAHRI', '031025070315', '22303156', 'PUSAT PENGAJIAN SAINS KOMPUTER', 'SAINS KOMPUTER', 'afiq231@student.usm.my', '01156406346'),
(11, 'MUHAMMAD AIMAN BIN MOHD HATTA', '040915100349', '22302874', 'PUSAT PENGAJIAN PENGURUSAN', 'PENGURUSAN', 'aimanhatta@student.usm.my', '01116237227'),
(12, 'MUHAMMAD ALIF SYAFIQ KHAIRIL ANWAR', '030830070081', '22301492', 'PUSAT PENGAJIAN SAINS KIMIA', 'SAINS (KIMIA)', 'alif.syafiq@student.usm.my', '01137250733'),
(13, 'MUHAMMAD HARITH BIN ABU BAKAR', '030210081003', '163240', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'EKONOMI', 'harith6137@student.usm.my', '01137874090'),
(14, 'NUR A`LIA NADHIRAH BINTI ABDUL RAHMAN', '040924101888', '22303027', 'PUSAT PENGAJIAN SAINS MATEMATIK', 'SAINS GUNAAN (MATEMATIK)', 'alianurnadhirah@student.usm.my', '0178411491'),
(15, 'NUR ADIBAH BINTI MOHD AZHAR', '030220050278', '22301199', 'PUSAT PENGAJIAN TEKNOLOGI INDUSTRI', 'SJ. MUDA TEKNOLOGI KEJ. BIOPROSES', 'adibahazhar03@student.usm.my', '01128334759'),
(16, 'NUR ADLIN NATASYA BINTI NASIP', '041019011510', '22301531', 'PUSAT PENGAJIAN SAINS KIMIA', 'SAINS (KIMIA)', 'adlinatasya1910@student.usm.my', '01169720690'),
(17, 'NUR AZIKIN', '031114120214', '22303193', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'EKONOMI', 'azikinsamsuddin@student.usm.my', '0164067240'),
(18, 'NUR AZIYANNY BINTI ABDULLAH', '040701010882', '22302865', 'PUSAT PENGAJIAN PENGURUSAN', 'PENGURUSAN', 'nuraziyanny17@student.usm.my', '0137986094'),
(19, 'NUR DIANAH AZWA BINTI SHAHARUDDIN', '040511100908', '22302857', 'PUSAT PENGAJIAN PENGURUSAN', 'PENGURUSAN', 'dianahazwa@student.usm.my', '0142519411'),
(20, 'NUR HAZIMAH BINTI ABDUL HAMID', '040908080570', '22301527', 'PUSAT PENGAJIAN SAINS KIMIA', 'SAINS (KIMIA)', 'nurhazimah@student.usm.my', '01114352740'),
(21, 'NUR IZNI HANANI BINTI ABDUL MOHSIN', '040109010736', '22301571', 'PUSAT PENGAJIAN ILMU KEMANUSIAAN', 'SASTERA (TERJ. & INTERPRETASI )', 'iznihanani04@student.usm.my', '01158555486'),
(22, 'NUR NABIHAH BINTI DAHARI', '041222060502', '22301695', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'EKONOMI', 'nabihahdahari@student.usm.my', '0196405649'),
(23, 'NUR SERI ATIELA NATASYA BINTI ZAINUL AMIN', '040312020614', '22303094', 'PUSAT PENGAJIAN SAINS KAJIHAYAT', 'SAINS ( BIOLOGI )', 'seriatiela12@student.usm.my', '01172502038'),
(24, 'NUR WAHEEDA NADZMA BINTI ABD RAZAK', '031129020486', '22303050', 'PUSAT PENGAJIAN ILMU KEMANUSIAAN', 'SASTERA ( I.KEMANUSIAAN )', 'nadzmawaheeda@student.usm.my', '0195277174'),
(25, 'NURIZZATI SAFIAH BINTI AHMAD NIZAM', '040302140110', '22303486', 'PUSAT PENGAJIAN SAINS KIMIA', 'SAINS GUNAAN (KIMIA)', 'izzatizam234@student.usm.my', '0162127372'),
(26, 'SITI AISHAH BINTI MOHAMED NOR', '040110031008', '22301929', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'SAINS KEMASYARAKATAN', 'aishahayish@student.usm.my', '01126864773'),
(27, 'SITI NUR ALLISYA NURULZAMAN BINTI ABDULLAH', '041211140742', '22301816', 'PUSAT PENGAJIAN PENGURUSAN', 'PENGURUSAN', 'nurallisya@student.usm.my', '0194952520'),
(28, 'SITI NURJANNATUL HUSNA BINTI MOHD. YAZID', '040424160224', '22303657', 'PUSAT PENGAJIAN SAINS MATEMATIK', 'SAINS ( MATEMATIK )', 'sitinurjannatul204@student.usm.my', '0138023744'),
(29, 'SITI NURUL ATIQAH BINTI MAZLAN', '020925010242', '22300719', 'PUSAT PENGAJIAN SAINS MATEMATIK', 'SAINS ( MATEMATIK )', 'atiqahmazlan259@student.usm.my', '01151631500'),
(30, 'UMIE NADHIRAH BINTI ABDUL GHANI', '991011146196', '165254', 'PUSAT PENGAJIAN SAINS KEMASYARAKATAN', 'SAINS KEMASYARAKATAN', 'umienadhirah@student.usm.my', '01119190369'),
(31, 'YANG SAHIRA BINTI MUHAMMAD SAYUTI', '040424070480', '22302018', 'PUSAT PENGAJIAN TEKNOLOGI INDUSTRI', 'TEKNOLOGI INDUSTRI (MAKANAN)', 'yangs@student.usm.my', '01151112456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1952;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=641;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
