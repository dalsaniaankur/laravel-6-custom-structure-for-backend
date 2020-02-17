-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2020 at 06:55 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `master`
--

-- --------------------------------------------------------

--
-- Table structure for table `ka_allergies`
--

CREATE TABLE `ka_allergies` (
  `allergie_id` int(10) UNSIGNED NOT NULL,
  `allergy_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_allergies`
--

INSERT INTO `ka_allergies` (`allergie_id`, `allergy_name`, `created_at`, `updated_at`) VALUES
(1, 'Pollen', '2019-07-02 18:30:00', '2019-12-12 06:25:11'),
(2, 'Latex', '2019-07-02 18:30:00', '2019-12-12 06:22:10'),
(3, 'Mold', '2019-12-12 06:25:20', '2019-12-12 06:25:20'),
(4, 'Dogs', '2019-12-12 06:25:29', '2019-12-12 06:25:29'),
(5, 'Cats', '2019-12-12 06:25:38', '2019-12-12 06:25:38'),
(6, 'Milk', '2019-12-13 13:01:32', '2019-12-13 13:01:32'),
(7, 'Powdered milk', '2019-12-13 13:01:40', '2019-12-13 13:01:40'),
(8, 'Cheese', '2019-12-13 13:01:46', '2019-12-13 13:01:46'),
(9, 'Butter', '2019-12-13 13:01:52', '2019-12-13 13:01:52'),
(10, 'Margarine', '2019-12-13 13:01:58', '2019-12-13 13:01:58'),
(11, 'Ice cream', '2019-12-13 13:02:05', '2019-12-13 13:02:05'),
(12, 'Yogurt', '2019-12-13 13:02:12', '2019-12-13 13:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `ka_city`
--

CREATE TABLE `ka_city` (
  `city_id` int(10) UNSIGNED NOT NULL,
  `city_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_city`
--

INSERT INTO `ka_city` (`city_id`, `city_name`, `state_id`) VALUES
(1, 'Aba North', 1),
(2, 'Aba South', 1),
(3, 'Arochukwu', 1),
(4, 'Bende', 1),
(5, 'Ikwuano', 1),
(6, 'Isiala Ngwa North', 1),
(7, 'Isiala Ngwa South', 1),
(8, 'Isuikwuato', 1),
(9, 'Obi Ngwa', 1),
(10, 'Ohafia', 1),
(11, 'Osisioma', 1),
(12, 'Ugwunagbo', 1),
(13, 'Ukwa East', 1),
(14, 'Ukwa West', 1),
(15, 'Umuahia North', 1),
(16, 'muahia South', 1),
(17, 'Umu Nneochi', 1),
(18, 'Demsa', 2),
(19, 'Fufure', 2),
(20, 'Ganye', 2),
(21, 'Gayuk', 2),
(22, 'Gombi', 2),
(23, 'Grie', 2),
(24, 'Hong', 2),
(25, 'Jada', 2),
(26, 'Larmurde', 2),
(27, 'Madagali', 2),
(28, 'Maiha', 2),
(29, 'Mayo Belwa', 2),
(30, 'Michika', 2),
(31, 'Mubi North', 2),
(32, 'Mubi South', 2),
(33, 'Numan', 2),
(34, 'Shelleng', 2),
(35, 'Song', 2),
(36, 'Toungo', 2),
(37, 'Yola North', 2),
(38, 'Yola South', 2),
(39, 'Abak', 3),
(40, 'Eastern Obolo', 3),
(41, 'Eket', 3),
(42, 'Esit Eket', 3),
(43, 'Essien Udim', 3),
(44, 'Etim Ekpo', 3),
(45, 'Etinan', 3),
(46, 'Ibeno', 3),
(47, 'Ibesikpo Asutan', 3),
(48, 'Ibiono-Ibom', 3),
(49, 'Ika', 3),
(50, 'Ikono', 3),
(51, 'Ikot Abasi', 3),
(52, 'Ikot Ekpene', 3),
(53, 'Ini', 3),
(54, 'Itu', 3),
(55, 'Mbo', 3),
(56, 'Mkpat-Enin', 3),
(57, 'Nsit-Atai', 3),
(58, 'Nsit-Ibom', 3),
(59, 'Nsit-Ubium', 3),
(60, 'Obot Akara', 3),
(61, 'Okobo', 3),
(62, 'Onna', 3),
(63, 'Oron', 3),
(64, 'Oruk Anam', 3),
(65, 'Udung-Uko', 3),
(66, 'Ukanafun', 3),
(67, 'Uruan', 3),
(68, 'Urue-Offong Oruko', 3),
(69, 'Uyo', 3),
(70, 'Aguata', 4),
(71, 'Anambra East', 4),
(72, 'Anambra West', 4),
(73, 'Anaocha', 4),
(74, 'Awka North', 4),
(75, 'Awka South', 4),
(76, 'Ayamelum', 4),
(77, 'Dunukofia', 4),
(78, 'Ekwusigo', 4),
(79, 'Idemili North', 4),
(80, 'Idemili South', 4),
(81, 'Ihiala', 4),
(82, 'Njikoka', 4),
(83, 'Nnewi North', 4),
(84, 'Nnewi South', 4),
(85, 'Ogbaru', 4),
(86, 'Onitsha North', 4),
(87, 'Onitsha South', 4),
(88, 'Orumba North', 4),
(89, 'Orumba South', 4),
(90, 'Oyi', 4),
(91, 'Alkaleri', 5),
(92, 'Bauchi', 5),
(93, 'Bogoro', 5),
(94, 'Damban', 5),
(95, 'Darazo', 5),
(96, 'Dass', 5),
(97, 'Gamawa', 5),
(98, 'Ganjuwa', 5),
(99, 'Giade', 5),
(100, 'Itas-Gadau', 5),
(101, 'Jama are', 5),
(102, 'Katagum', 5),
(103, 'Kirfi', 5),
(104, 'Misau', 5),
(105, 'Ningi', 5),
(106, 'Shira', 5),
(107, 'Tafawa Balewa', 5),
(108, 'Toro', 5),
(109, 'Warji', 5),
(110, 'Zaki', 5),
(111, 'Brass', 6),
(112, 'Ekeremor', 6),
(113, 'Kolokuma Opokuma', 6),
(114, 'Nembe', 6),
(115, 'Ogbia', 6),
(116, 'Sagbama', 6),
(117, 'Southern Ijaw', 6),
(118, 'Yenagoa', 6),
(119, 'Agatu', 7),
(120, 'Apa', 7),
(121, 'Ado', 7),
(122, 'Buruku', 7),
(123, 'Gboko', 7),
(124, 'Guma', 7),
(125, 'Gwer East', 7),
(126, 'Gwer West', 7),
(127, 'Katsina-Ala', 7),
(128, 'Konshisha', 7),
(129, 'Kwande', 7),
(130, 'Logo', 7),
(131, 'Makurdi', 7),
(132, 'Obi', 7),
(133, 'Ogbadibo', 7),
(134, 'Ohimini', 7),
(135, 'Oju', 7),
(136, 'Okpokwu', 7),
(137, 'Oturkpo', 7),
(138, 'Tarka', 7),
(139, 'Ukum', 7),
(140, 'Ushongo', 7),
(141, 'Vandeikya', 7),
(142, 'Abadam', 8),
(143, 'Askira-Uba', 8),
(144, 'Bama', 8),
(145, 'Bayo', 8),
(146, 'Biu', 8),
(147, 'Chibok', 8),
(148, 'Damboa', 8),
(149, 'Dikwa', 8),
(150, 'Gubio', 8),
(151, 'Guzamala', 8),
(152, 'Gwoza', 8),
(153, 'Hawul', 8),
(154, 'Jere', 8),
(155, 'Kaga', 8),
(156, 'Kala-Balge', 8),
(157, 'Konduga', 8),
(158, 'Kukawa', 8),
(159, 'Kwaya Kusar', 8),
(160, 'Mafa', 8),
(161, 'Magumeri', 8),
(162, 'Maiduguri', 8),
(163, 'Marte', 8),
(164, 'Mobbar', 8),
(165, 'Monguno', 8),
(166, 'Ngala', 8),
(167, 'Nganzai', 8),
(168, 'Shani', 8),
(169, 'Abi', 9),
(170, 'Akamkpa', 9),
(171, 'Akpabuyo', 9),
(172, 'Bakassi', 9),
(173, 'Bekwarra', 9),
(174, 'Biase', 9),
(175, 'Boki', 9),
(176, 'Calabar Municipal', 9),
(177, 'Calabar South', 9),
(178, 'Etung', 9),
(179, 'Ikom', 9),
(180, 'Obanliku', 9),
(181, 'Obubra', 9),
(182, 'Obudu', 9),
(183, 'Odukpani', 9),
(184, 'Ogoja', 9),
(185, 'Yakuur', 9),
(186, 'Yala', 9),
(187, 'Aniocha North', 10),
(188, 'Aniocha South', 10),
(189, 'Bomadi', 10),
(190, 'Burutu', 10),
(191, 'Ethiope East', 10),
(192, 'Ethiope West', 10),
(193, 'Ika North East', 10),
(194, 'Ika South', 10),
(195, 'Isoko North', 10),
(196, 'Isoko South', 10),
(197, 'Ndokwa East', 10),
(198, 'Ndokwa West', 10),
(199, 'Okpe', 10),
(200, 'Oshimili North', 10),
(201, 'Oshimili South', 10),
(202, 'Patani', 10),
(203, 'Sapele', 10),
(204, 'Udu', 10),
(205, 'Ughelli North', 10),
(206, 'Ughelli South', 10),
(207, 'Ukwuani', 10),
(208, 'Uvwie', 10),
(209, 'Warri North', 10),
(210, 'Warri South', 10),
(211, 'Warri South West', 10),
(212, 'Abakaliki', 11),
(213, 'Afikpo North', 11),
(214, 'Afikpo South', 11),
(215, 'Ebonyi', 11),
(216, 'Ezza North', 11),
(217, 'Ezza South', 11),
(218, 'Ikwo', 11),
(219, 'Ishielu', 11),
(220, 'Ivo', 11),
(221, 'Izzi', 11),
(222, 'Ohaozara', 11),
(223, 'Ohaukwu', 11),
(224, 'Onicha', 11),
(225, 'Akoko-Edo', 12),
(226, 'Egor', 12),
(227, 'Esan Central', 12),
(228, 'Esan North-East', 12),
(229, 'Esan South-East', 12),
(230, 'Esan West', 12),
(231, 'Etsako Central', 12),
(232, 'Etsako East', 12),
(233, 'Etsako West', 12),
(234, 'Igueben', 12),
(235, 'Ikpoba Okha', 12),
(236, 'Orhionmwon', 12),
(237, 'Oredo', 12),
(238, 'Ovia North-East', 12),
(239, 'Ovia South-West', 12),
(240, 'Owan East', 12),
(241, 'Owan West', 12),
(242, 'Uhunmwonde', 12),
(243, 'Ado Ekiti', 13),
(244, 'Efon', 13),
(245, 'Ekiti East', 13),
(246, 'Ekiti South-West', 13),
(247, 'Ekiti West', 13),
(248, 'Emure', 13),
(249, 'Gbonyin', 13),
(250, 'Ido Osi', 13),
(251, 'Ijero', 13),
(252, 'Ikere', 13),
(253, 'Ikole', 13),
(254, 'Ilejemeje', 13),
(255, 'Irepodun-Ifelodun', 13),
(256, 'Ise-Orun', 13),
(257, 'Moba', 13),
(258, 'Oye', 13),
(259, 'Aninri', 14),
(260, 'Awgu', 14),
(261, 'Enugu East', 14),
(262, 'Enugu North', 14),
(263, 'Enugu South', 14),
(264, 'Ezeagu', 14),
(265, 'Igbo Etiti', 14),
(266, 'Igbo Eze North', 14),
(267, 'Igbo Eze South', 14),
(268, 'Isi Uzo', 14),
(269, 'Nkanu East', 14),
(270, 'Nkanu West', 14),
(271, 'Nsukka', 14),
(272, 'Oji River', 14),
(273, 'Udenu', 14),
(274, 'Udi', 14),
(275, 'Uzo Uwani', 14),
(276, 'Abaji', 15),
(277, 'Bwari', 15),
(278, 'Gwagwalada', 15),
(279, 'Kuje', 15),
(280, 'Kwali', 15),
(281, 'Municipal Area Council', 15),
(282, 'Akko', 16),
(283, 'Balanga', 16),
(284, 'Billiri', 16),
(285, 'Dukku', 16),
(286, 'Funakaye', 16),
(287, 'Gombe', 16),
(288, 'Kaltungo', 16),
(289, 'Kwami', 16),
(290, 'Nafada', 16),
(291, 'Shongom', 16),
(292, 'Yamaltu-Deba', 16),
(293, 'Aboh Mbaise', 17),
(294, 'Ahiazu Mbaise', 17),
(295, 'Ehime Mbano', 17),
(296, 'Ezinihitte', 17),
(297, 'Ideato North', 17),
(298, 'Ideato South', 17),
(299, 'Ihitte-Uboma', 17),
(300, 'Ikeduru', 17),
(301, 'Isiala Mbano', 17),
(302, 'Isu', 17),
(303, 'Mbaitoli', 17),
(304, 'Ngor Okpala', 17),
(305, 'Njaba', 17),
(306, 'Nkwerre', 17),
(307, 'Nwangele', 17),
(308, 'Obowo', 17),
(309, 'Oguta', 17),
(310, 'Ohaji-Egbema', 17),
(311, 'Okigwe', 17),
(312, 'Orlu', 17),
(313, 'Orsu', 17),
(314, 'Oru East', 17),
(315, 'Oru West', 17),
(316, 'Owerri Municipal', 17),
(317, 'Owerri North', 17),
(318, 'Owerri West', 17),
(319, 'Unuimo', 17),
(320, 'Auyo', 18),
(321, 'Babura', 18),
(322, 'Biriniwa', 18),
(323, 'Birnin Kudu', 18),
(324, 'Buji', 18),
(325, 'Dutse', 18),
(326, 'Gagarawa', 18),
(327, 'Garki', 18),
(328, 'Gumel', 18),
(329, 'Guri', 18),
(330, 'Gwaram', 18),
(331, 'Gwiwa', 18),
(332, 'Hadejia', 18),
(333, 'Jahun', 18),
(334, 'Kafin Hausa', 18),
(335, 'Kazaure', 18),
(336, 'Kiri Kasama', 18),
(337, 'Kiyawa', 18),
(338, 'Kaugama', 18),
(339, 'Maigatari', 18),
(340, 'Malam Madori', 18),
(341, 'Miga', 18),
(342, 'Ringim', 18),
(343, 'Roni', 18),
(344, 'Sule Tankarkar', 18),
(345, 'Taura', 18),
(346, 'Yankwashi', 18),
(347, 'Birnin Gwari', 19),
(348, 'Chikun', 19),
(349, 'Giwa', 19),
(350, 'Igabi', 19),
(351, 'Ikara', 19),
(352, 'Jaba', 19),
(353, 'Jema a', 19),
(354, 'Kachia', 19),
(355, 'Kaduna North', 19),
(356, 'Kaduna South', 19),
(357, 'Kagarko', 19),
(358, 'Kajuru', 19),
(359, 'Kaura', 19),
(360, 'Kauru', 19),
(361, 'Kubau', 19),
(362, 'Kudan', 19),
(363, 'Lere', 19),
(364, 'Makarfi', 19),
(365, 'Sabon Gari', 19),
(366, 'Sanga', 19),
(367, 'Soba', 19),
(368, 'Zangon Kataf', 19),
(369, 'Zaria', 19),
(370, 'Ajingi', 20),
(371, 'Albasu', 20),
(372, 'Bagwai', 20),
(373, 'Bebeji', 20),
(374, 'Bichi', 20),
(375, 'Bunkure', 20),
(376, 'Dala', 20),
(377, 'Dambatta', 20),
(378, 'Dawakin Kudu', 20),
(379, 'Dawakin Tofa', 20),
(380, 'Doguwa', 20),
(381, 'Fagge', 20),
(382, 'Gabasawa', 20),
(383, 'Garko', 20),
(384, 'Garun Mallam', 20),
(385, 'Gaya', 20),
(386, 'Gezawa', 20),
(387, 'Gwale', 20),
(388, 'Gwarzo', 20),
(389, 'Kabo', 20),
(390, 'Kano Municipal', 20),
(391, 'Karaye', 20),
(392, 'Kibiya', 20),
(393, 'Kiru', 20),
(394, 'Kumbotso', 20),
(395, 'Kunchi', 20),
(396, 'Kura', 20),
(397, 'Madobi', 20),
(398, 'Makoda', 20),
(399, 'Minjibir', 20),
(400, 'Nasarawa', 20),
(401, 'Rano', 20),
(402, 'Rimin Gado', 20),
(403, 'Rogo', 20),
(404, 'Shanono', 20),
(405, 'Sumaila', 20),
(406, 'Takai', 20),
(407, 'Tarauni', 20),
(408, 'Tofa', 20),
(409, 'Tsanyawa', 20),
(410, 'Tudun Wada', 20),
(411, 'Ungogo', 20),
(412, 'Warawa', 20),
(413, 'Wudil', 20),
(414, 'Bakori', 21),
(415, 'Batagarawa', 21),
(416, 'Batsari', 21),
(417, 'Baure', 21),
(418, 'Bindawa', 21),
(419, 'Charanchi', 21),
(420, 'Dandume', 21),
(421, 'Danja', 21),
(422, 'Dan Musa', 21),
(423, 'Daura', 21),
(424, 'Dutsi', 21),
(425, 'Dutsin Ma', 21),
(426, 'Faskari', 21),
(427, 'Funtua', 21),
(428, 'Ingawa', 21),
(429, 'Jibia', 21),
(430, 'Kafur', 21),
(431, 'Kaita', 21),
(432, 'Kankara', 21),
(433, 'Kankia', 21),
(434, 'Katsina', 21),
(435, 'Kurfi', 21),
(436, 'Kusada', 21),
(437, 'Mai Adua', 21),
(438, 'Malumfashi', 21),
(439, 'Mani', 21),
(440, 'Mashi', 21),
(441, 'Matazu', 21),
(442, 'Musawa', 21),
(443, 'Rimi', 21),
(444, 'Sabuwa', 21),
(445, 'Safana', 21),
(446, 'Sandamu', 21),
(447, 'Zango', 21),
(448, 'Aleiro', 22),
(449, 'Arewa Dandi', 22),
(450, 'Argungu', 22),
(451, 'Augie', 22),
(452, 'Bagudo', 22),
(453, 'Birnin Kebbi', 22),
(454, 'Bunza', 22),
(455, 'Dandi', 22),
(456, 'Fakai', 22),
(457, 'Gwandu', 22),
(458, 'Jega', 22),
(459, 'Kalgo', 22),
(460, 'Koko Besse', 22),
(461, 'Maiyama', 22),
(462, 'Ngaski', 22),
(463, 'Sakaba', 22),
(464, 'Shanga', 22),
(465, 'Suru', 22),
(466, 'Wasagu Danko', 22),
(467, 'Yauri', 22),
(468, 'Zuru', 22),
(469, 'Adavi', 23),
(470, 'Ajaokuta', 23),
(471, 'Ankpa', 23),
(472, 'Bassa', 23),
(473, 'Dekina', 23),
(474, 'Ibaji', 23),
(475, 'Idah', 23),
(476, 'Igalamela Odolu', 23),
(477, 'Ijumu', 23),
(478, 'Kabba Bunu', 23),
(479, 'Kogi', 23),
(480, 'Lokoja', 23),
(481, 'Mopa Muro', 23),
(482, 'Ofu', 23),
(483, 'Ogori Magongo', 23),
(484, 'Okehi', 23),
(485, 'Okene', 23),
(486, 'Olamaboro', 23),
(487, 'Omala', 23),
(488, 'Yagba East', 23),
(489, 'Yagba West', 23),
(490, 'Asa', 24),
(491, 'Baruten', 24),
(492, 'Edu', 24),
(493, 'Ekiti', 24),
(494, 'Ifelodun', 24),
(495, 'Ilorin East', 24),
(496, 'Ilorin South', 24),
(497, 'Ilorin West', 24),
(498, 'Irepodun', 24),
(499, 'Isin', 24),
(500, 'Kaiama', 24),
(501, 'Moro', 24),
(502, 'Offa', 24),
(503, 'Oke Ero', 24),
(504, 'Oyun', 24),
(505, 'Pategi', 24),
(506, 'Agege', 25),
(507, 'Ajeromi-Ifelodun', 25),
(508, 'Alimosho', 25),
(509, 'Amuwo-Odofin', 25),
(510, 'Apapa', 25),
(511, 'Badagry', 25),
(512, 'Epe', 25),
(513, 'Eti Osa', 25),
(514, 'Ibeju-Lekki', 25),
(515, 'Ifako-Ijaiye', 25),
(516, 'Ikeja', 25),
(517, 'Ikorodu', 25),
(518, 'Kosofe', 25),
(519, 'Lagos Island', 25),
(520, 'Lagos Mainland', 25),
(521, 'Mushin', 25),
(522, 'Ojo', 25),
(523, 'Oshodi-Isolo', 25),
(524, 'Shomolu', 25),
(525, 'Surulere', 25),
(526, 'Akwanga', 26),
(527, 'Awe', 26),
(528, 'Doma', 26),
(529, 'Karu', 26),
(530, 'Keana', 26),
(531, 'Keffi', 26),
(532, 'Kokona', 26),
(533, 'Lafia', 26),
(534, 'Nasarawa', 26),
(535, 'Nasarawa Egon', 26),
(536, 'Obi', 26),
(537, 'Toto', 26),
(538, 'Wamba', 26),
(539, 'Agaie', 27),
(540, 'Agwara', 27),
(541, 'Bida', 27),
(542, 'Borgu', 27),
(543, 'Bosso', 27),
(544, 'Chanchaga', 27),
(545, 'Edati', 27),
(546, 'Gbako', 27),
(547, 'Gurara', 27),
(548, 'Katcha', 27),
(549, 'Kontagora', 27),
(550, 'Lapai', 27),
(551, 'Lavun', 27),
(552, 'Magama', 27),
(553, 'Mariga', 27),
(554, 'Mashegu', 27),
(555, 'Mokwa', 27),
(556, 'Moya', 27),
(557, 'Paikoro', 27),
(558, 'Rafi', 27),
(559, 'Rijau', 27),
(560, 'Shiroro', 27),
(561, 'Suleja', 27),
(562, 'Tafa', 27),
(563, 'Wushishi', 27),
(564, 'Abeokuta North', 28),
(565, 'Abeokuta South', 28),
(566, 'Ado-Odo Ota', 28),
(567, 'Egbado North', 28),
(568, 'Egbado South', 28),
(569, 'Ewekoro', 28),
(570, 'Ifo', 28),
(571, 'Ijebu East', 28),
(572, 'Ijebu North', 28),
(573, 'Ijebu North East', 28),
(574, 'Ijebu Ode', 28),
(575, 'Ikenne', 28),
(576, 'Imeko Afon', 28),
(577, 'Ipokia', 28),
(578, 'Obafemi Owode', 28),
(579, 'Odeda', 28),
(580, 'Odogbolu', 28),
(581, 'Ogun Waterside', 28),
(582, 'Remo North', 28),
(583, 'Shagamu', 28),
(584, 'Akoko North-East', 29),
(585, 'Akoko North-West', 29),
(586, 'Akoko South-West', 29),
(587, 'Akoko South-East', 29),
(588, 'Akure North', 29),
(589, 'Akure South', 29),
(590, 'Ese Odo', 29),
(591, 'Idanre', 29),
(592, 'Ifedore', 29),
(593, 'Ilaje', 29),
(594, 'Ile Oluji-Okeigbo', 29),
(595, 'Irele', 29),
(596, 'Odigbo', 29),
(597, 'Okitipupa', 29),
(598, 'Ondo East', 29),
(599, 'Ondo West', 29),
(600, 'Ose', 29),
(601, 'Owo', 29),
(602, 'Atakunmosa East', 30),
(603, 'Atakunmosa West', 30),
(604, 'Aiyedaade', 30),
(605, 'Aiyedire', 30),
(606, 'Boluwaduro', 30),
(607, 'Boripe', 30),
(608, 'Ede North', 30),
(609, 'Ede South', 30),
(610, 'Ife Central', 30),
(611, 'Ife East', 30),
(612, 'Ife North', 30),
(613, 'Ife South', 30),
(614, 'Egbedore', 30),
(615, 'Ejigbo', 30),
(616, 'Ifedayo', 30),
(617, 'Ifelodun', 30),
(618, 'Ila', 30),
(619, 'Ilesa East', 30),
(620, 'Ilesa West', 30),
(621, 'Irepodun', 30),
(622, 'Irewole', 30),
(623, 'Isokan', 30),
(624, 'Iwo', 30),
(625, 'Obokun', 30),
(626, 'Odo Otin', 30),
(627, 'Ola Oluwa', 30),
(628, 'Olorunda', 30),
(629, 'Oriade', 30),
(630, 'Orolu', 30),
(631, 'Osogbo', 30),
(632, 'Afijio', 31),
(633, 'Akinyele', 31),
(634, 'Atiba', 31),
(635, 'Atisbo', 31),
(636, 'Egbeda', 31),
(637, 'Ibadan North', 31),
(638, 'Ibadan North-East', 31),
(639, 'Ibadan North-West', 31),
(640, 'Ibadan South-East', 31),
(641, 'Ibadan South-West', 31),
(642, 'Ibarapa Central', 31),
(643, 'Ibarapa East', 31),
(644, 'Ibarapa North', 31),
(645, 'Ido', 31),
(646, 'Irepo', 31),
(647, 'Iseyin', 31),
(648, 'Itesiwaju', 31),
(649, 'Iwajowa', 31),
(650, 'Kajola', 31),
(651, 'Lagelu', 31),
(652, 'Ogbomosho North', 31),
(653, 'Ogbomosho South', 31),
(654, 'Ogo Oluwa', 31),
(655, 'Olorunsogo', 31),
(656, 'Oluyole', 31),
(657, 'Ona Ara', 31),
(658, 'Orelope', 31),
(659, 'Ori Ire', 31),
(660, 'Oyo', 31),
(661, 'Oyo East', 31),
(662, 'Saki East', 31),
(663, 'Saki West', 31),
(664, 'Surulere', 31),
(665, 'Bokkos', 32),
(666, 'Barkin Ladi', 32),
(667, 'Bassa', 32),
(668, 'Jos East', 32),
(669, 'Jos North', 32),
(670, 'Jos South', 32),
(671, 'Kanam', 32),
(672, 'Kanke', 32),
(673, 'Langtang South', 32),
(674, 'Langtang North', 32),
(675, 'Mangu', 32),
(676, 'Mikang', 32),
(677, 'Pankshin', 32),
(678, 'Qua an Pan', 32),
(679, 'Riyom', 32),
(680, 'Shendam', 32),
(681, 'Wase', 32),
(682, 'Abua Odual', 33),
(683, 'Ahoada East', 33),
(684, 'Ahoada West', 33),
(685, 'Akuku-Toru', 33),
(686, 'Andoni', 33),
(687, 'Asari-Toru', 33),
(688, 'Bonny', 33),
(689, 'Degema', 33),
(690, 'Eleme', 33),
(691, 'Emuoha', 33),
(692, 'Etche', 33),
(693, 'Gokana', 33),
(694, 'Ikwerre', 33),
(695, 'Khana', 33),
(696, 'Obio Akpor', 33),
(697, 'Ogba Egbema Ndoni', 33),
(698, 'Ogu Bolo', 33),
(699, 'Okrika', 33),
(700, 'Omuma', 33),
(701, 'Opobo Nkoro', 33),
(702, 'Oyigbo', 33),
(703, 'Port Harcourt', 33),
(704, 'Tai', 33),
(705, 'Binji', 34),
(706, 'Bodinga', 34),
(707, 'Dange Shuni', 34),
(708, 'Gada', 34),
(709, 'Goronyo', 34),
(710, 'Gudu', 34),
(711, 'Gwadabawa', 34),
(712, 'Illela', 34),
(713, 'Isa', 34),
(714, 'Kebbe', 34),
(715, 'Kware', 34),
(716, 'Rabah', 34),
(717, 'Sabon Birni', 34),
(718, 'Shagari', 34),
(719, 'Silame', 34),
(720, 'Sokoto North', 34),
(721, 'Sokoto South', 34),
(722, 'Tambuwal', 34),
(723, 'Tangaza', 34),
(724, 'Tureta', 34),
(725, 'Wamako', 34),
(726, 'Wurno', 34),
(727, 'Yabo', 34),
(728, 'Ardo Kola', 35),
(729, 'Bali', 35),
(730, 'Donga', 35),
(731, 'Gashaka', 35),
(732, 'Gassol', 35),
(733, 'Ibi', 35),
(734, 'Jalingo', 35),
(735, 'Karim Lamido', 35),
(736, 'Kumi', 35),
(737, 'Lau', 35),
(738, 'Sardauna', 35),
(739, 'Takum', 35),
(740, 'Ussa', 35),
(741, 'Wukari', 35),
(742, 'Yorro', 35),
(743, 'Zing', 35),
(744, 'Bade', 36),
(745, 'Bursari', 36),
(746, 'Damaturu', 36),
(747, 'Fika', 36),
(748, 'Fune', 36),
(749, 'Geidam', 36),
(750, 'Gujba', 36),
(751, 'Gulani', 36),
(752, 'Jakusko', 36),
(753, 'Karasuwa', 36),
(754, 'Machina', 36),
(755, 'Nangere', 36),
(756, 'Nguru', 36),
(757, 'Potiskum', 36),
(758, 'Tarmuwa', 36),
(759, 'Yunusari', 36),
(760, 'Yusufari', 36),
(761, 'Anka', 37),
(762, 'Bakura', 37),
(763, 'Birnin Magaji Kiyaw', 37),
(764, 'Bukkuyum', 37),
(765, 'Bungudu', 37),
(766, 'Gummi', 37),
(767, 'Gusau', 37),
(768, 'Kaura Namoda', 37),
(769, 'Maradun', 37),
(770, 'Maru', 37),
(771, 'Shinkafi', 37),
(772, 'Talata Mafara', 37),
(773, 'Chafe', 37),
(774, 'Zurmi', 37);

-- --------------------------------------------------------

--
-- Table structure for table `ka_class`
--

CREATE TABLE `ka_class` (
  `class_id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `grade_id` int(10) UNSIGNED NOT NULL,
  `class_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_class`
--

INSERT INTO `ka_class` (`class_id`, `school_id`, `grade_id`, `class_name`, `status`, `created_at`, `updated_at`) VALUES
(10, 16, 8, 'East', 1, '2019-07-05 19:38:15', '2019-07-05 19:38:15'),
(11, 16, 8, 'West', 1, '2019-07-05 19:38:32', '2019-07-05 19:38:32'),
(12, 16, 9, 'Secondary', 1, '2019-07-05 19:38:42', '2019-07-05 19:38:42'),
(13, 16, 9, 'East', 1, '2019-07-05 19:38:54', '2019-08-02 19:33:53'),
(14, 23, 10, '1 East', 1, '2019-07-11 17:38:05', '2019-07-11 17:38:05'),
(15, 23, 11, 'East 2', 1, '2019-07-11 17:40:06', '2019-07-11 17:40:06'),
(16, 28, 12, 'East', 1, '2019-07-12 19:55:54', '2019-07-12 19:55:54'),
(17, 33, 19, 'A.S 1', 1, '2019-07-25 18:05:29', '2019-07-25 18:05:29'),
(18, 33, 19, 'A.S 2', 1, '2019-07-25 18:05:48', '2019-07-25 18:05:48'),
(19, 147, 20, '2a', 1, '2019-10-09 00:58:05', '2019-10-09 00:58:05'),
(20, 147, 20, '2b', 1, '2019-10-09 00:58:35', '2019-10-09 00:58:35'),
(21, 16, 22, 'East', 1, '2019-10-11 14:25:55', '2019-10-11 14:25:55'),
(22, 16, 8, 'North', 1, '2019-10-21 20:21:23', '2019-10-21 20:21:23'),
(23, 16, 9, 'North', 1, '2019-10-21 20:21:40', '2019-10-21 20:21:40'),
(24, 16, 22, 'North', 1, '2019-10-21 20:21:56', '2019-10-21 20:21:56'),
(25, 147, 24, '1a', 1, '2019-11-10 07:29:50', '2019-11-10 07:29:50'),
(26, 147, 24, '1b', 1, '2019-11-10 07:29:59', '2019-11-10 07:29:59'),
(27, 147, 23, '3a', 1, '2019-11-10 07:31:14', '2019-11-10 07:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `ka_club`
--

CREATE TABLE `ka_club` (
  `club_id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `club_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_club`
--

INSERT INTO `ka_club` (`club_id`, `school_id`, `club_name`, `created_at`, `updated_at`) VALUES
(3, 16, 'LAVO New York', '2019-07-05 07:00:00', '2019-07-05 07:00:00'),
(4, 16, 'Hyde Bellagio ', '2019-07-05 07:00:00', '2019-07-05 07:00:00'),
(5, 33, 'Glory club', '2019-07-25 18:36:06', '2019-07-25 18:36:06'),
(6, 147, 'Boys and Girls Club', '2019-10-16 21:14:34', '2019-10-16 21:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `ka_cms_page`
--

CREATE TABLE `ka_cms_page` (
  `page_id` int(10) UNSIGNED NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_cms_page`
--

INSERT INTO `ka_cms_page` (`page_id`, `content`, `image_path`, `created_at`, `updated_at`) VALUES
(1, '<strong>Kidrend is an interactive app connecting schools & parents in Africa.</strong><br>Get daily updates about your child\'s academics, behavior, health & more', 'images/cms_page/home_15686351461606443339.png', '2019-07-18 07:00:00', '2019-09-16 19:59:06'),
(2, '<p>At Kidrend, we believe in putting education first. To do that, we&rsquo;ve created a safe, secure place where communication from teacher to parent and parent to teacher is easy and stress-free.</p><p>Please read through the terms and conditions carefully, and let usknow if there are any questions at all that we can answer. Remember, your protection, satisfaction, and success is always our priority.</p><p>Effective date: April 9, 2019</p><p>Welcome to Kidrend! Please read these terms of use carefully (&quot;Terms&quot;). The following Terms are a legally binding contract between you and Kidrend Advantage Limited. (&ldquo;Kidrend&rdquo;, &quot;we&quot;, or &quot;us&quot;). These Terms govern and apply to your access and use of <a href=\"http://kidrend.com\">www.kidrend.com</a> and Kidrend?s social networking services available via Kidrend?s site and mobile apps (collectively, the &quot;Service&quot;). By accessing or using our Service, you agree to be bound to all of the terms and conditions described in these Terms, including the Kidrend Privacy Policy. If you do not agree to all of these terms and conditions, do not use our Service.</p><p>If you are entering into this Agreement on behalf of a company or other legal entity, you represent that you have the authority to bind such entity to these terms and conditions, in which case the terms &quot;you&quot;, &quot;your&quot; or &quot;Member&quot; shall refer to such entity. If you do not have such authority, or if you do not agree with these terms and conditions, you must not accept this Agreement and may not use the Service.</p><p>We reserve the right, at our discretion, to change these Terms at any time. If they do change, we will do our best to tell you in advance by placing a notification on the Kidrend.comwebsite, or by sending you an email. You may also check these Terms periodically for changes. If you use the Service in any way after a change to the Terms is effective, then please remember that means you agree to all of the Terms. If you have any questions, comments, or concerns regarding these Terms or the Service, please contact us at <a href=\"mailto:support@kidrend.com\">support@kidrend.com</a>.</p><h5>1. Eligibility</h5><p>You must be at least eighteen (18) years old to use the Service. By agreeing to the Terms, you represent and warrant to us that you are at least eighteen (18) years old and, that your registration and your use of the Service is in compliance with any and all applicable laws and regulations.</p><h5>2. Privacy Policy</h5><p>Please read the Kidrend Privacy Policy carefully for information regarding our collection, use, and disclosure of your personal information. If any conflict exists between the Terms and our Privacy Policy, the Terms will prevail.</p><h5>3. Accounts and Registration</h5><p>You promise to provide us with accurate, complete, and updated registration information about yourself. You will also be asked to provide a password. You are solely responsible for maintaining the confidentiality of your account and password. You agree to accept responsibility for all activities that occur under your account. You may not transfer your account to anyone else without our prior written permission.If you have reason to believe that your account is no longer secure for any reason(for example, in the event of a loss, theft or unauthorized disclosure or use of your password), then you agree to immediately notify us at <a href=\"mailto:support@kidrend.com\">support@kidrend.com</a>. If you violate the terms of this Agreement, Kidrend reserves the right to reclaim any username you have registered.</p><h5>4.Intellectual Property Rights</h5><p><strong>4.1 Content</strong></p><p>The materials displayed or performed on the Service, (including, but not limited to, text, graphics, articles, photos, images, illustrations, User Submissions (defined below), and so forth (the &quot;Content&quot;) and thetrademarks, service marks and logos contained on the Service (&quot;Marks&quot;), are protected by copyright and other intellectual property laws. Content is provided for your information and personal use only and may not be used, copied, distributed, transmitted, displayed, sold, licensed, reverse engineered, de-compiled, or otherwise exploited for any other purposes whatsoever without prior written consent of the owner of the Content or in any way that violates someone else&#39;s rights, including Kidrend. You understand that Kidrend owns the Service. You won&#39;t modify, publish, transmit, participate in the transfer or sale of, reproduce (except as expressly provided in this Section), creative derivative works based on, or otherwise exploit any of the Service.</p><p><strong>4.2 User Submissions</strong></p><p>Anything you post, upload, share, store, or otherwise provide through the Service is your &quot;User Submission.&quot; You retain copyright and any other proprietary rights you hold in the User Submission that you post to the Service. For all User Submissions, you hereby grant Kidrend a worldwide, non-exclusive, transferable, assignable, fully paid-up, royalty-free right and license to host, transfer, display, perform, reproduce, modify, distribute and re-distribute, and otherwise exploit your User Submissions, in whole or in part, in any media formats and through any media channels (for example making sure your content is viewable on your iPhone as well as your computer). This is a license only &ndash;your ownership in User Submissions is not affected.</p><p>By posting and sharing User Submissions with another user of the Service, you hereby grant that user a non-exclusive license to access and use such User Submissions.</p><p>You are solely responsible for your User Submissions and the consequences of posting or publishing User Submissions. By posting and publishing User Submissions, you affirm, represent, and warrant that:</p><ul><li>You are the creator and owner of, or have the necessary licenses, rights, consents, and permissions to use and to authorize Kidrend and users of the Service to use and distribute your User Submissions as necessary to exercise the licenses granted by you in this Section 4 and in the manner contemplated by Kidrend and the Terms.</li><li>Your User Submissions, and the use thereof as contemplated herein, does not and will not: (a) infringe, violate, or misappropriate any third-party right, including any copyright, trademark, patent, trade secret, moral right, privacy<br />\r\n		right, right of publicity, or any other intellectual property or proprietary right;(b)slander, defame, libel, or invade the right of privacy, publicity or other property rights of any other person; (c) contain any viruses, adware, spyware, worms, or other malicious code; or (d) violate any applicable law or regulation.</li></ul><p>We are under no obligation to edit or control User Submissions that you and other users post or publish, and will not be in any way responsible or liable for User Submissions. You understand that when using the Service you will be exposed to User Submissions from a variety of sources and acknowledge that User Submissions may be inaccurate, offensive, indecent or objectionable. You agree to waive, and hereby do waive, any legal or equitable rights or remedies you have or may have against Kidrend with respect thereto. We expressly disclaim any and all liability in connection with User Submissions. If notified by a user or content owner that User Submissions allegedly does not conform to the Terms, we may investigate the allegation and determine in our sole discretion whether to remove the content, which we reserve the right to do at any time and without notice. For clarity, Kidrend does not permit copyright infringing activities on the Service.</p><h5>5. DMCA Notification</h5><p>We comply with the provisions of the Digital Millennium Copyright Act (DMCA) as it relates to online service providers, like Kidrend, removing material that we believe in good faith violates someone&#39;s copyright. If you have any complaints or objections to material posted on the Service, you may contact us at: support@kidrend. Tolearn more about DMCA, <a href=\"https://www.copyright.gov/legislation/dmca.pdf\">click here</a></p><h5>6. FERPA</h5><p>Certain information that may be provided to Kidrend by teachers, teacher aides, or other personnel at an Institution (&quot;School Official&quot;) that is directly related to a student and maintained by an Institution, may be considered an education record (&quot;Education Record&quot;) under the Family Educational Rights and Privacy Act (&quot;FERPA&quot;). Additionally, certain information, provided to Kidrend by School Officials about a student, such as student name and grade level, may be considered directory information under FERPA (&quot;Directory Information&quot;) and thus not an Education Record. A school may not generally disclose personally identifiable information from an eligible student&#39;s education records to a third party without written consent of the parent and/or eligible student or without meeting one of the exemptions set forth in FERPA (&quot;FERPA Exemption(s)&quot;), including the exemption for Directory Information (&quot;Directory Information Exemption&quot;) or disclosure to school officials with a legitimate educational interest (&quot;School Official Exemption&quot;).</p><p>As a School Official or Institution providing Directory Information or any Education Record to Kidrend, you represent, warrant and covenant to Kidrend, as applicable, that your Institution has:</p><ul><li>Complied with the Directory Information Exemption, including, without limitation, informing parents and eligible students what information the Institution deems to be directory informationand allowing parents and eligible students a reasonable amount of time to request that schools not disclose directory information about them; and/or</li><li>Complied with the School Official Exemption, including, without limitation, informing parents in their annual notification of FERPA rights that the Institution defines &quot;school official&quot; to include service providers and defines &quot;legitimate educational interest&quot; to include services such as the type provided by Kidrend; or</li><li>Obtained all necessary parental or eligible student written consent to share the Directory Information and Educational Records with Kidrend, in each case, solely to enable Company&#39;s operation of the Service.</li></ul><p>Kidrend will never share Education Records with third parties except (i) as directed by a Kidrend user (i.e., teacher sharing with another teacher or parent); or (ii) to our service providers that are necessary for us to provide the Service, as stated in our Privacy Policy. Education Records are never used or disclosed for third party advertising or any kind of first-or third-party behaviorally-targeted advertising to students or parents. This section shall not be construed to prohibit Kidrend from marketing or advertising directly to parents so long as the marketing or advertising did not result from the use of Educational Records to provide behaviorally targeted advertising.</p><p>Kidrend may use Education Records that have been de-identified for product development, research or other purposes (&quot;De-Identified Data&quot;). De-Identified Data will have all direct and indirect personal identifiers removed, this includes, but is not limited to, name, date of birth, demographic information, location information and school identity. Kidrend agrees not to attempt to re-identify the De-Identified Data and not to transfer the De-Identified Data to a third party unless that party agrees not to attempt re-identification.</p><h5>7. Prohibited Conduct</h5><p>BY USING THE SERVICE YOU AGREE NOT TO:</p><ul><li>Rent, lease, loan, sell, resell, sublicense, distribute or otherwise transfer the licenses granted herein or any Materials (as defined below);</li><li>Post, upload, or distribute any defamatory, libelous, or inaccurate User Submission or other content;</li><li>Publish the private information of any third party without the consent of that third party;<ul><li>Post, upload, or distribute any User Submission or other Content that is unlawful or that a reasonable person could deem to be objectionable, profane, offensive, indecent, pornographic, harassing, threatening, embarrassing, distressing, vulgar, hateful, racially or ethnically offensive, or otherwise inappropriate;</li><li>Impersonate any person or entity, falsely claim an affiliation with any person or entity, or access the Service accounts of others without permission, forge another person&#39;s digital signature, misrepresent the source, identity, or content of information transmitted via the Service, or perform any other similar fraudulent activity;</li><li>Delete the copyright or other proprietary rights on the Service or any User Submission;</li></ul></li><li>Make unsolicited offers, advertisements, proposals, or send junk mail or spam to other users of the Service. This includes, but is not limited to, unsolicited advertising, promotional materials, or other solicitation material, bulk mailing of commercial advertising, chain mail, informational announcements, charity requests, and petitions for signatures;</li><li>Use the Service for any illegal purpose, or in violation of any local, state, national, or international law, including, without limitation COPPA and FERPA, laws governing intellectualproperty and other proprietary rights, and data protection and privacy;</li><li>Defame, harass, abuse, threaten or defraud users of the Service, or collect, or attempt to collect, personal information about users or third parties without their consent,</li><li>Remove, circumvent, disable, damage or otherwise interfere with security-related features of the Service or User Submission, features that prevent or restrict use or copying of any content accessible through the Service, or features that enforce limitations on theuse of the Service or User Submission;</li><li>Reverse engineer, decompile, disassemble or otherwise attempt to discover the source code of the Service or any part thereof (including any App), except and only to the extent that such activity is expressly permitted by applicable law notwithstanding this limitation;</li><li>Modify, adapt, translate or create derivative works based upon the Service or any part thereof, except and only to the extent the foregoing restriction is expressly prohibited by applicable law; or</li><li>Intentionally interfere with or damage operation of the Service or any user&#39;s enjoyment of it, by any means, including uploading or otherwise disseminating viruses, adware, spyware, worms, or other malicious code.</li></ul><h5>8.App Usage</h5><p>We make available mobile applications or other downloadable software applications (each an &quot;App&quot;). Subject to the restrictions defined in these Terms, Kidrend grants you a limited, non-exclusive, non-transferable, non-sub licensable, revocable license to install and use one copy of an App in object code format, solely for your personal use, on one device that you own or control.An App may be made available to you through a third-party distributor such as the Apple iTunes App Store or Google Play (each an &quot;App Distributor&quot;). You acknowledge and agree that:</p><ul><li>The Terms are between you and Kidrend only, not with the App Distributor and the App Distributor is not responsible for the App and its content.</li><li>The App Distributor has no obligation whatsoever to furnish any maintenance and support services with respect to the App.</li><li>If you have downloaded your App from the iTunes App Store, in the event of any failure of an App to conform to any applicable warranty, then you may notify the Apple and Apple will refund the purchase price for the relevant App to you. Except as set forth in the preceding sentence, to the maximum extent permitted by applicable law, App Distributors have no other warranty obligations whatsoever with respect to the App.</li><li>The App Distributor is not responsible for addressing any claims by you or any third party relating to the App or your possession and/or use of the App, including, but not limited to: (i) product liability claims; (ii) any claim that the App fails to conform to any applicable legal or regulatory requirement; and (iii) claims arising under consumer protection or similar legislation.</li><li>The App Distributor is not responsible for the investigation, defense, settlement and discharge of any third party claim that the App or your possession and use of the App infringes that third party&#39;s intellectual property rights.</li><li>The App Distributor, and its subsidiaries, are third party beneficiaries of these Terms, and upon your acceptance of the Terms, the App Distributor will have the right (and will be deemed to have accepted the right) to enforce the Terms against you as a third party beneficiary of the Terms.</li><li>You agree to comply with any applicable third party terms of use when using the App.</li></ul><h5>9.Third Party Services and Websites</h5><p>Kidrend may provide tools through the Service that enable you to export information to third party services, including through use of an API or by linking your account on Kidrend with an account on the third party service, such as Twitter or Facebook. By using these tools, you agree that we may transfersuch User Submissions and information to the applicable third party service. Such third party services are not under our control, and we are not responsible for the contents of the third party service or the use of your User Submission or information by the third party service. The Service, including our websites, may also contain links to third-party websites. The linked sites are not under our control, and we are not responsible for the contents of any linked site. We provide these links as a convenienceonly, and a link does not imply our endorsement of, sponsorship of, or affiliation with the linked site. You should make whatever investigation you feel necessary or appropriate before proceeding with any transaction with any of these third parties services or websites.</p><h5>10. Termination of Use</h5><p>You may terminate your account at any time by contacting customer service at <a href=\"mailto:support@kidrend.com\" target=\"_blank\">support@kidrend.com</a>.Kidrend is also free to terminate (or suspend access to)your use of the Service or your account, for any reason, including your breach of<br />\r\n	these Terms. Kidrend has the sole right to decide whether you are in violation of any of the restrictions set forth in these Terms. Account termination may result in destruction of any content associated with your account, so keep that in mind before you decide to terminate your account. We will try to provide advance notice to you prior to our terminating your account so that you are able to retrieve any important documents you may have stored in your account (to the extent allowed by law and these Terms), but we may not do so if we determine it would be impractical, illegal, or would not be in the interest of someone&#39;s safety or security to do so.</p><h5>11. Ownership; Proprietary Rights</h5><p>The Service is owned and operated by Kidrend. The visual interfaces, graphics, design, compilation, information, computer code (including source code or object code), products, software, services, and all other elements of the Service provided by Kidrend (the &quot;Materials&quot;) are protected by United States copyright, trade dress, and trademark laws, international conventions, and all other relevant intellectual property and proprietary rights, and applicable laws. Except for any User Submission that is provided and owned by users of the Service, all Materials contained in the Service are the property of Kidrend or its subsidiaries or affiliated companies and/or third-party licensors. All trademarks, service marks, and trade names are proprietary to Kidrend or its affiliates and/or third-party licensors. Except as expressly authorized by Kidrend, you agree not to sell, license, distribute, copy, modify, publicly perform or display, transmit, publish, edit, adapt, create derivative works from, or otherwise make unauthorized use of the Materials. Kidrend reserves all rights to the Materials not expressly granted in the Terms.</p><h5>12. Indemnity</h5><p>You agree that you will be personally responsible for your use of the Service and you agree to defend, indemnify and hold harmless Kidrend its affiliates, and their respective officers, directors, employees and agents, from and against any and all claims, damages, obligations, losses, liabilities, costs and expenses (including but not limited to attorney&#39;s fees) arising from: (i) your use of the Service; (ii) your violation of these Terms; (iii) your violation of any third party right, including without limitation any copyright, property, publicity or privacy right; or (iv) any claim that one of your User Submissions caused damage to a third party. This defense and indemnification obligation will survive these Terms and your use of the Service.</p><h5>13. Warranty Disclaimer</h5><p>THE SERVICE ARE PROVIDED &quot;AS IS&quot; AND ON AN &quot;AS AVAILABLE&quot; BASIS, WITHOUT WARRANTY OR CONDITION OF ANY KIND, EITHER EXPRESS OR IMPLIED. BLOOMZ AND ITS OFFICERS, DIRECTORS, EMPLOYEES AND AGENTS SPECIFICALLY (BUT WITHOUT LIMITATION) DISCLAIM (i) ANY IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT; (ii) ANY WARRANTIES ARISING OUT OF COURSE-OF-DEALING, USAGE, OR TRADE; (iii) ANY WARRANTIES THAT<br />\r\n	THE INFORMATION OR RESULTS PROVIDED IN, OR THAT MAY BE OBTAINED FROM USE OF, THE SERVICE WILL MEET YOUR REQUIREMENTS OR BE ACCURATE, RELIABLE, COMPLETE, OR UP-TO-DATE; AND (iv) ANY WARRANTIES WHATSOEVER REGARDING ANY PRODUCTS, SERVICES, INFORMATION OR OTHER MATERIAL ADVERTISED, MADE AVAILABLE, OR REFERRED TO YOU THROUGH THE SERVICE. YOU ASSUME ALL RISK FOR ALL DAMAGES, INCLUDING DAMAGE TO YOUR COMPUTER SYSTEM, MOBILE DEVICE OR LOSS OF DATA THAT MAY RESULT FROM YOUR USE OF OR ACCESS TO THE SERVICE. ANY CONTENT, MATERIALS, INFORMATION OR SOFTWARE DOWNLOADED, USED OR OTHERWISE OBTAINED THROUGH THE USE OF THE SERVICE IS DONE AT YOUR OWN DISCRETION AND RISK.SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF CERTAIN WARRANTIES IN SOME CIRCUMSTANCES. ACCORDINGLY, SOME OF THE ABOVE LIMITATIONS MAY NOT APPLY TO YOU.</p><h5>14. Limitation of Liability</h5><p>TO THE FULLEST EXTENT ALLOWED BY APPLICABLE LAW, UNDER NO CIRCUMSTANCES AND UNDER NO LEGAL THEORY(INCLUDING, WITHOUT LIMITATION, TORT, CONTRACT, STRICT LIABILITY, OR OTHERWISE) SHALL KIDREND BE LIABLE TO YOU OR TO ANY OTHER PERSON FOR (A) ANY INDIRECT, SPECIAL, INCIDENTAL, OR CONSEQUENTIAL DAMAGES OF ANY KIND, INCLUDING DAMAGES FOR LOST PROFITS, LOSSOF GOODWILL, WORK STOPPAGE, ACCURACY OF RESULTS, OR COMPUTER FAILURE OR MALFUNCTION, OR (B) ANY AMOUNT, IN THE AGGREGATE, IN EXCESS OF THE GREATER OF (I) $100 OR (II) THE AMOUNTS PAID BY YOU TO KIDREND IN CONNECTION WITH THE SERVICE IN THE TWELVE (12) MONTH PERIOD PRECEDING THIS APPLICABLE CLAIM, OR (III) ANY MATTER BEYOND OUR REASONABLE CONTROL. SOME STATES DO NOT ALLOW THE EXCLUSION OR LIMITATION OF CERTAIN DAMAGES, SO THE ABOVE LIMITATION AND EXCLUSIONS MAY NOT APPLY TO YOU.</p><h5>15. Applicable Law and Venue</h5><p>These Terms and your use of the Service shall be governed by and construed in accordance with the laws of the State of Washington, applicable to agreements made and to be entirely performed within the State of Washington, without resort to its conflict of law provisions. You agree that any action at law or in equity arising out of or relating to these Terms shall be filed only in the state and federal courts located in the country where Kidrend is licensed to operate,and you hereby irrevocably and unconditionally consent and submit to the exclusive jurisdiction of such courts over any suit, action or proceeding arising out of these Terms.</p><h5>16. Assignment</h5><p>You may not assign, delegate, or transfer these Terms or your rights or obligations hereunder, or your Service account, in any way (by operation of law or otherwise) without Kidrend?s prior written consent. We may transfer, assign, or delegate these Terms and our rights and obligations without consent.</p><h5>17. Contact Information</h5><p>If you have any questions regarding Kidrend, the Service, or the Terms please contact us at <a href=\"mailto:support@kidrend.com\" target=\"_blank\">support@kidrend.com</a>.</p><p>Research has demonstrated the value of parental involvement in their kid&#39;s education. When parents are in the know, teachers and students also benefit.</p>', '', '2019-07-18 07:00:00', '2019-09-19 18:28:50');
INSERT INTO `ka_cms_page` (`page_id`, `content`, `image_path`, `created_at`, `updated_at`) VALUES
(3, '<div class=\"terms-wrap\">\r\n    <div class=\"wow fadeInUp\">\r\n    <p>Privacy Policy Highlights</p>\r\n<p> We believe you should always know what data we collect from you and how we use it, and that you should have meaningful control over both. We want to empower users to make the best decisions about the information that they share with us. We also have a Student data protection Addendum, an agreement we enter into with schools, that further describes our duties, responsibilities, and commitments with respect to Student Data (as defined therein) that we collect or receive. </p>\r\n\r\n<p> You should read this policy in full, but here are a few key points: Personal Data We Collect: Please see <a href=\"https://www.classdojo.com/data/\">this chart</a> for the detailed categories of information we collect from each user type as well as <a href=\"https://classdojo.zendesk.com/hc/en-us/articles/204422195\">this chart</a> for more detail on our mobile app permission and our <a href=\"https://www.classdojo.com/cookies-policy/\">Online Tracking Technologies Policy</a>. You can also find more details below. </p>\r\n<p class=\"mb-5\">How We Use the Information We Collect: We use the personal information we collect from students (or about students from teachers) to provide and improve the Service, for educational, security, and safety purposes, or as required by law. We will not require children to provide more personal information than is reasonably necessary in order to participate in the Service. See here for more information on our use of information collected from students, and here for additional information on our use of information collected from teachers, parents.</p>\r\n<p>Data Retention: We will not retain student personal information for any longer than is necessary for educational purposes and legal obligations, or to provide the Service for which we receive or collect the student personal information. Additionally, we protect students with our industry-leading 3-Tier Student Data Protection Policy: </p> \r\n\r\n<p>(1) we collect only minimal information from students necessary to register for the Service, <br />\r\n(2) we automatically delete their feedback awarded in school after a year, and <br />\r\n(3) we delete students\' accounts if they\'re inactive for more than twelve months. Note, however, some content within a student account will be kept after deletion of the account for school legal compliance reasons (e.g., maintenance of \"education records\" under the Family Educational Rights and Privacy Act (FERPA) or \"student data\" under state student privacy laws) and will not be deleted until we receive direction from the school. We store nonstudent user personal information, including content uploaded by children in non-school contexts, for as long as it is necessary to provide products and Service to you and others. For non-student users, personal information associated with your account will be kept until your account is deleted or until we no longer need the data to provide the Service, whichever occurs first. Note, however, that some content uploaded by a teacher, school leader, or parent may also be kept after the deletion of the account for school legal compliance reasons (e.g., maintenance of \"education records\" under FERPA or \"student data\" under state student privacy laws) and will not be deleted until we receive direction from the school. See here for more details.</p>\r\n\r\n<p>What Student Information is Shown Publicly? No student\'s account, profile, or portfolio is made available or visible to the public through Kidrend. Only the student, the student\'s parents, and the student\'s teachers or school leaders can see the student\'s profile and  portfolio. No child can upload content (such as a response to an activity, photo, video, drawing, journal entry, or document) to the Service on Portfolios except through their student account, or if their parent has allowed their child access to certain premium features, such as Kidrend Beyond School on the Kids tab (\"Premium Features\")]on the parent\'s device. This can\'t happen for children without either (1) the parent providing parental consent directly to Kidrend or</p> \r\n<p>(2) the child\'s teacher representing Kidrend that they have obtained any necessary parental consent. Parents are able to view their own child\'s portfolio, including any Portfolio Comments (as defined below), on their own parent account after the teacher has approved the student-submitted content. Parents may see feedback points awarded in school if the teacher has elected to let parents see these.</p> \r\n\r\n<p>Class story and School story are visible by students, teachers, parents and school leaders who have logged into their accounts and are associated with that particular class or school. They are not viewable by the general public. Parents, teachers and school leaders can add content or comments to these stories, but students can only view or like content on these stories and are only able to do this once either the school or Kidrend has obtained parental consent, if under 13. Teachers may share their classes, including feedback points, Portfolios, and Class Story, with other teachers or school leaders in their school. Content uploaded or feedback points awarded within Premium Features is viewable only by the parent and the children accessing such Premium Features on the parent\'s device; the content is not viewable by the child\'s teacher or other students.</p> \r\n\r\n<p>We Never Sell Personal Information: We will never sell or rent your personal information or non-personal information. We will only share personal information with a limited set of third-party service provider necessary to provide or develop our services (such as database hosting) or as required by law, and we will be transparent about who these service providers are. We will contractually require that these service providers process personal information in accordance with our instructions and consistent with this Privacy Policy and ensure that these service providers employ reasonable and comprehensive data protection and security protocols. See here for more details.</p>\r\n\r\n<p>You own your data: We don\'t own any content or information you provide or we receive - you (students, parents and/or schools) will own your content and information.</p>\r\n\r\n<p>Security and Privacy by Design and Default: We use security industry best practices to protect personal information, including using encryption and other security safeguards to protect personal information. We design products with security and privacy in mind from day one. See here for more information.</p>\r\n\r\n<p>Transparency and Choice: We will be transparent about our practices, so that you can make meaningful choices about how your personal information is used. If we make a material change, we will provide prominent notice by posting a notice on our service or this website page and/or we will notify you by email (if you have provided an email address to us). See here for more information. </p>\r\n\r\n<p>Right to Access and Correction of Data: We support access to and correction of student personal information by the student or their parent or legal guardian, either by <br /> 1) assisting the school in meeting its requirements for access by responding to requests we receive from schools, or <br />\r\n2) directly responding to requests from parents when the information is collected directly from a student and ClassDojo obtains the parent consent (not the school). Teachers, parents, school leaders and other users can contact us at <a href=\"mailto:privacy@kidrend.com\">privacy@kidrend.com</a> to access, correct or update their personal information, or they can use the features in their account settings to do so. See here for more information, including about your additional rights of data portability and right to object or withdrawal consent</p>\r\n\r\n</div>\r\n<div class=\"wow fadeInUp\">\r\n<h2 class=\"h4\">Kidrend Privacy Policy</h2>\r\n<p class=\"mb-5\"> Kidrend\'s mission is to give teachers, school leaders, parents, and students the power to create incredible classrooms. We\'re humbled that millions of people like you trust Kidrend to do that every day. Keeping this trust through your privacy and safety is incredibly important to us. This Privacy Policy explains:</p> \r\n<p>\r\n	<ul>\r\n    	<li>What information Kidrend collects from you (and why we collect it), </li>\r\n		<li>How we use and share that information,</li>\r\n		<li>The choices and rights you have, including how to access, update, delete your information, and take your information out of Kidrend.</li>\r\n    </ul>\r\n</p>\r\n\r\n<p>This policy applies to all products and services offered by Kidrend, Inc. (\"Kidrend,\" \"we,\" \"us,\" \"our,\" and our subsidiaries or affiliates). Kidrend may be acting as both a Controller and a Processor as those terms are defined under the European Union\'s General Data Protection Regulation (\"GDPR\"). For more information, please see below</p> \r\n<p>Our Privacy Policy is designed to provide transparency into our privacy practices and principles. We\'ve done our best to write this policy in simple, clear terms, but if you\'re not familiar with terms like personal information, cookies, IP address, pixel tags and browsers, then read about these key terms. We\'ve also added summaries below each section that provide short explanations of the legal language in plain English (it starts with ‘Basically...\') to aid in understanding, but it isn\'t legally binding.</p> \r\n\r\n<p>Last updated: November 2, 2018. You can see past versions of this policy here on Github.</p>\r\n\r\n<h2 class=\"h4\">iKEEPSAFE PRIVACY</h2>\r\n<p> Overview <br />\r\nWe will only collect, use, and share your personal information in accordance with this Privacy Policy. This policy applies whether you login to use Kidrend through <a href=\"http://www.kidrend.com\">http://www.kidrend.com</a> (the \"Kidrend Platform\"), our mobile applications (the \"Kidrend Apps\"), or any of our other products or services that link to this Privacy Policy that Kidrend may provide now or in the future (collectively, the \"Service\"). Additionally, this Privacy Policy applies if you browse the Kidrend informational website located at <a href=\"http://www.kidrend.com\">http://www.kidrend.com</a> (the \"Kidrend Website\"). In addition, this Privacy Policy also covers kidrend\'s treatment of any personal information about our users that our partners or other services might share with us, for example responses to a teacher survey collected through SurveyMonkey. This policy does not apply to websites or services or practices of companies that Kidrend doesn\'t own or control, such as third-party services you might access through links or other features (e.g., social media buttons or YouTube videos) onthe Service. These other services have their own privacy policies, and we encourage you to review them before providing them with personal information. Whether you are new here (welcome!), or have been using Kidrend for a long time (welcome back!), please do take the time to get to know our privacy practices. We think they\'re pretty clear and friendly, but if you have any questions, we\'re here to help. You can visit the <a href=\"https://www.classdojo.com/privacycenter/\">Kidrend Privacy Center</a> to learn more about how we protect your privacy, or send us an email at <a href=\"mailto:privacy@kidrend.com\">privacy@kidrend.com</a>. By using the Service, you acknowledge that you accept and agree to this Privacy Policy. Basically</p>\r\n\r\n<p>Protecting your privacy is incredibly important to us. This Privacy Policy is here to help you understand how we treat any Personal information that you share with us when you use Kidrend. This policy applies to every Kidrend product - other companies that Kidrend doesn\'t own or control will have their own privacy policies, and you should read them, too!</p> \r\n\r\n<p>Kidrend\'s Privacy Certifications</p>\r\n\r\n<p>Kidrend participates in the iKeepSafe Safe Harbor program. Kidrend has been granted the iKeepSafe COPPA Safe Harbor seal signifying its Website, Platform, and Apps have been reviewed and approved for having policies and practices surrounding the collection, use, maintenance and disclosure of personal information from children consistent with the iKeepSafe COPPA Safe Harbor program guidelines. Kidrend holds the iKeepSafe FERPA Certification signifying its Website, Platform, and Apps have been reviewed and approved for having policies and practices that are compliant with the federal mandates for FERPA. Kidrend is also a signatory to the Student Privacy Pledge, agreeing to a set of principles intended to safeguard student privacy, including responsible stewardship, protection, and transparent handling of student personal information. Read more about the Student Privacy Pledge here.</p>\r\n\r\n<p>Basically, <br />\r\nKidrend is certified <a href=\"https://ikeepsafe.org/certification/coppa/\">COPPA-compliant</a>, has a certification stating that its policies and practices help schools meet their FERPA obligations, and has also signed the student privacy pledge.</p> \r\n</div>\r\n<div class=\"wow fadeInUp\">\r\n<h2 class=\"h4\">How does Kidrend protect children\'s personal information?</h2>\r\n<p class=\"mb-5\">Protecting children\'s privacy is especially important to us - We\'re educators and parents ourselves, after all. This is why we\'ve signed the Student Privacy Pledge and received iKeepSafe\'s Children\'s Online Privacy Protection Act (\"COPPA\") Safe Harbor seal, signifying that this Privacy Policy and our practices with respect to the operation of the Service have been reviewed and approved for compliance with iKeepSafe\'s COPPA Safe Harbor program. COPPA protects the online privacy of children under the age of 13 (\"child\" or \"children\"); for more information about COPPA and generally protecting children\'s online privacy, please visit <a href=\"https://www.consumer.ftc.gov/articles/0031-protecting-your-childs-privacy-online\">OnGuard Online.</a> </p>\r\n\r\n<p><strong>What information does Kidrend collect from children, and how is it used?</strong> The statements we make regarding the information we collect from or about students (and non-student child users and how we use this information applies equally to all students regardless of their age. Accordingly, where this Privacy Policy references students or any information collected from or about students, our Privacy Policy applies to students under 13 years old as well as students 13 years old and above. Kidrend collects the minimal amount of information from students necessary to register for an account on the Service. This information is necessary to enable us to comply with legal obligations and given our legitimate interest in being able to provide and improve the Service and for security and safety purposes. Additionally, Kidrend follows the Federal Trade Commission\'s (FTC) COPPA rules for parental consent.</p> \r\n<p><strong>Student Account Creation</strong> <br />\r\nCurrently student accounts are created in the following ways:<br />\r\n(1) by the student\'s parent;<br />\r\n(2) by the student\'s teacher; </p>\r\n\r\n<p>(1) By the parent: When a parent sets up an account for their child, they will first need a parent account. In order to set up a parent account and be connected to their child\'s school, parents must first receive the unique parent code provided to their child by their child\'s teacher or sent through an email/SMS invitation directly from the teacher containing the unique parent code or choose their child\'s teacher from the list shown from within the Kidrend App or Kidrend Website (the request to join the class must still be approved by the teacher). Parents can also set up their account without this unique access code, but will not be connected to their child\'s school (or any activity on their child\'s account in school, such as feedback points or student uploaded content, Portfolio Comments or Student Activity Responses). In accordance with COPPA, we may ask the parent to provide the date of birth or age of their child, and if the child is under 13, we will also then seek to obtain verifiable parental consent in order to proceed with creating theirchild\'s account. If a parent is connected to their child\'s school, we don\'t ask the child\'s parent for any additional information regarding their child during the student account creation, but link the account to the name and information provided by the child\'s teacher. If the parent is not connected to their child\'s school, the parent may provide their child\'s first and last name (at the option of the parent). Once we have obtained parental consent, the child\'s account will be set up and a QR code will be accessible on the parent\'s device to allow the child to log in to their student account. Although not required under COPPA, we may choose to impose parental consent requirements on students 13 and above at our discretion.</p>\r\n\r\n<p>(2) By the student\'s teacher: If a student\'s school or teacher elects to utilize student accounts in school or otherwise sets up a student\'s account, the school will be responsible for obtaining any necessary parental consent under COPPA (including if they choose to act as the agent of the parent and consent on the parent\'s behalf - commonly referred to as \"school consent\" under COPPA) to create the student account on behalf of the student and let students access their accounts. The teacher will provide the student\'s name to set up the account. Please note that if you, as a parent, provide an email to the school when the school is obtaining parental consent, we may send an email out to you asking you to verify your child\'s account, but you will not receive any other emails unless you have opted in to email marketing or have separately created an account on our Service. For more information on school consent, please see the <a href=\"https://www.ftc.gov/tips-advice/business-center/guidance/complying-coppa-frequently-asked-questions#Schools\">FTC\'s COPPA FAQ\'s.</a></p> \r\n<p>Any student account (or access to a student account) created for the student by the parent, or the student\'s teacher in class, are linked together (these are not different accounts).</p> \r\n\r\n<p><strong>Photos, Videos, Documents, Drawings, Student Activity Responses, and Journal Entries</strong> Once a student account is created (whether created by the student\'s teacher or parent and parental consent is obtained, teachers will be able to take and upload photos, videos, documents, Student Activity Responses, create drawings, and write journal entries (which may contain personal information) to their account on Portfolios which will be collected by Kidrend once the content has been actively saved by the teacher within the Service. Until the content is actively saved by the teacher, it is temporarily stored locally on the parents device. The portfolio can only be viewed by the student\'s parents, and the student\'s teachers and school leaders. If the school or teacher elects to utilize student accounts in the classroom, the school will be responsible for obtaining any necessary parental consent under COPPA. Additionally, the student\'s teacher must approve any post made by students (whether posted froom home or inschool), including any Student Activity Responses, before it is shared with parents on portfolio. Any content uploaded by a student in their student account created by their parent or in the classroom by their teacher or themselves will appear in the same student account (these are not three different accounts).</p>\r\n\r\n<p><strong>Viewing Stories</strong> Students with student accounts may also view or \"like\" content on the Class Story and School Story, however, they will not be able to post content (such as videos or photos) to either the Class Story or School Story. Currently, students are limited to posting content to just their own portfolio or through access to the Premium Features given to them by their parents (on their parent\'s device).</p> \r\n\r\n<p><strong>Portfolio Comments</strong> If a student\'s teacher has elected to provide Portfolio Comments on their Student Activity Responses or any other content uploaded by students to Portfolios, the student may also respond to these comments. Prior to any student-uploaded content being viewed by the student\'s parents, the teacher must first approve this content. Additionally, prior to this approval of portfolio content, any Portfolio Comments between the teacher and the student can\'t be viewed by the student\'s parent, but any connected parents will receive a notice indicating that Portfolio Comments is being utilized by their child\'s teacher and can discuss the use of Portfolio Comments with their child\'s teacher. Once the Student Activity Responses (or other content) has been approved by the student\'s teacher, the Portfolio Comments will then be viewable by the parent (but may have been previously edited by the student\'s teacher).</p> \r\n\r\n<p><strong>Premium Features</strong> <br /> Parents may choose to allow their children to access and use certain <a href=\"https://classdojo.zendesk.com/hc/en-us/articles/360018137732\">Premium Features</a> on the parent\'s device (the \"Kids Tab\"). A parent will first need to have their own parent account, and be required to use either their Apple ID, Google Account, or other payment method to purchase the Premium Features. Prior to allowing your child (or children) access to the Kids Tab within the Premium Features, we will also require <a href=\"https://classdojo.zendesk.com/hc/en-us/articles/115004741603\">parental consent</a>. Once we have obtained parental consent, the children\'s features will be unlocked for their children to utilize on their parent\'s device. Although not required under COPPA, we may choose to impose parental consent requirements on students 13 and above at our discretion. In the Kids Tab that is utilized by a child, we collect photos, as well as audio and video recordings made by the child once the content has been actively saved by the parent or child within the ClassDojo App. Until the content is actively saved by the parent or child, it is temporarily stored locally on the parent\'s device. This content is then viewable by the parent and child within the Premium Features section of the app and is not viewable by the child\'s teacher or other students. This content can be deleted by the parent or child. In addition, the child can customize their moneter, and these changes to their monster may be shown in their student account in class.</p> \r\n\r\n<p>In addition to the information listed above, we automatically collect some information from any use of our Service as set forth in the \"Information collected automatically\" section, this includes device data (such as platform, app version and device ID) and product event data (such as whether the children\'s area was accessed or the last activity a child started) from the parent\'s device when utilized by their child, such as for Premium Features or logging in via QR code to their student account on the parent\'s device .</p> \r\n\r\n<p>We also receive from the child\'s teacher (and link to the student\'s account) whatever name he or she has provided for the student, the student\'s grade, the <a href=\"https://classdojo.zendesk.com/hc/en-us/articles/204422125\">feedback points</a> given by that teacher, and content uploaded by the teacher to the student\'s portfolio (such as student responses to activities and Portfolio Comments). Teachers can choose to provide full names for students (e.g., first name and last name) when setting up their class; they can also opt to only provide non-identifying information (e.g., just first name and seat number). This <a href=\"https://www.classdojo.com/data/\">chart details</a> the personal information we collect, how we use it, and where it is stored. We use this information to provide and improve the Service to the child, for <a href=\"https://classdojo.zendesk.com/hc/en-us/articles/115004741703#EducationalPurposes\">educational</a>, security and safety purposes, as required by law, or to enforce our Terms. We will not require children to provide more <a href=\"https://classdojo.zendesk.com/hc/en-us/articles/115004741703#PersonalInformation\">personal information</a> than is reasonably necessary in order to participate in the Service. If we discover that we have collected information from a child in a manner inconsistent with COPPA, we will take appropriate steps to either delete the information, or immediately seek the parent\'s consent for that collection. We do not disclose any personal information about children to third-parties, except to service providers necessary to provide the Service, authorized school personnel (such as school leaders) as directed by the child\'s school, as required by law, or to protect the security of the Service or other users. Information collected from students (including personal information and information collected automatically) is never used or disclosed for third-party advertising. We also do not place any third-party advertisements in student logged-in areas of the Service. Additionally, personal information collected from students is never used for behaviorally-targeted advertising to students by us or any third-party, and children\'s personal information is never sold or rented to anyone, including marketers and advertisers.</p>\r\n\r\n<p>Basically, <br /> ClassDojo has been certified by iKeepSafe, an FTC-approved COPPA Safe Harbor, for compliance with their COPPA Safe Harbor program. We don\'t ask for or require children to provide personal information beyond that which is reasonably necessary to use ClassDojo. Information collected from students is never used or disclosed for third-party advertising or any kind of behaviorallytargeted advertising, and it is never sold or rented to anyone, including marketers or advertisers. Please see this chart for the detailed categories of information we collect from each user type and how we use the information.</p> \r\n\r\n<p><strong>Push Notifications</strong></p> \r\n<p>ClassDojo may send push notifications to students - for example, letting them know when their weekly report is ready, or telling them about an achievement milestone they reached! We require children provide a parent\'s email address before he or she can receive push notifications from ClassDojo (or have a student account previously set up on ClassDojo by their parent or teacher, with any necessary parental consent obtained). We will then provide the parent with notice (if the account was set up by them or their child) and provide the parent the opportunity to prevent further notifications. The device identifier for a child\'s account will only be associated with other personal information once parental consent is provided. If you are a student or a parent of a child and no longer want these communications to be sent, please either turn off the push notifications on your device, or contact us at privacy@classdojo.com.</p>\r\n\r\n<p>Basically, <br /> Before ever sending a push notification to a child, if the child or the parent sets up the child\'s account on the Service, we will provide notice to parents, or obtain parental consent. We rely on teachers to obtain any necessary personal information if they set up the child\'s account. Parents can always opt-out (or withdraw consent) later as well by turning off the push notifications on their child\'s device or contacting us at privacy@classdojo.com.</p> \r\n<p><strong>What Children\'s Information is Visible to Others?</strong></p>\r\n<p>No student\'s account, profile, or portfolio is made available or visible to the public through ClassDojo. Only the student, the student\'s parents, and the student\'s teachers or school leaders can see the student\'s profile and portfolio. No child can upload content (such as a photo, video, drawing, journal entry, or document) to the Service except through their student account, or if their parent has allowed their child access to certain Premium Features on the parent\'s device. This can\'t happen for children without either (1) the parent providing parental consent directly to ClassDojo or (2) the child\'s teacher representing to ClassDojo that they have obtained any necessary parental consent. If a student adds content to their account in the classroom, students can\'t view each other\'s individual student accounts or portfolio unless they have intentionally chosen another student\'s name from the list of names shown to them or viewed the camera roll locally on the device that may be saving photos and videos taken by students. Teachers also have the option to use individual QR codes specific to each student for login purposes. Parents are able to view their own child\'s portfolio (through their own parent account) after the teacher has approved the student-submitted content, including Portfolio Comments and Student Activity Responses. Please note that parents may not see prior drafts of the studentsubmitted content or Portfolio Comments prior to the final teacher approval that allows parents to access and view and may not see all feedback points awarded by the teacher in school if the teacher has elected not to show these.</p>\r\n\r\n<p>Class Story and School Story are visible by students, teachers, parents and school leaders who have logged into their accounts and are associated with that particular class or school. They are not viewable by the general public. Parents, teachers and school leaders can add content or comments to these stories, but students can only view or like content on these stories and are only able to do this once either the school or ClassDojo has obtained parental consent, if under 13. Teachers may share their classes, including feedback points, Portfolios, and Class Story, with other teachers or school leaders in their school. Please note that if the teacher chooses to project their own ClassDojo teacher account in their classroom, students physically present in that classroom may see other students\' names and total feedback points - this is similar to how paper-based sticker charts displayed in a classroom might work. Students\' portfolios of classwork may also be visible from the teacher account. Teachers, however, can choose to never project or display their own teacher account in class, and therefore keep student feedback points and Portfolios private for each student, their teacher(s), and their parents — and many do!</p> \r\n\r\n<p>Content uploaded by children or feedback points awarded within Premium Features is viewable by the parent and any children accessing such Premium Features on the parent\'s device; the content is not viewable by the child\'s teacher or other students. The customization of the monster by the child within Premium Features may be viewable within the child\'s student account (and thus viewable by the child\'s teacher or other students in the classroom).</p> \r\n\r\n<p>Basically, <br /> By default, the full set of feedback and content posted, including Portfolio Comments and Student Activity Responses, to a student\'s account is private to the student, their teacher(s), school leader, and their parents (once the content is approved by the teacher). If a teacher displays their teacher account publicly in class, then students may see other students\' total feedback points, and potentially classwork on Portfolios. Parents can view all teacherapproved posts, including Portfolio Comments and Student Activity Responses, shared on their child\'s portfolio, as well as every post shared on Class Story and School Story. Students can view and like, but not upload, content and comments on Class Story and School Story (once parental consent has been obtained by ClassDojo or their school/teacher). Parents may not see all feedback points awarded by the teacher in school if the teacher has elected not to show these.</p> \r\n\r\n<p>Content uploaded or feedback points awarded within Premium Features is viewable by the parent and the children accessing such Premium Features on the parent\'s device; the content is not viewable by the child\'s teacher or other students. The customization of the monster by the child within Premium Features may be viewable within the child\'s student account (and thus viewable by the child\'s teacher or other students in the classroom).</p> \r\n\r\n<p><strong>How Long Does ClassDojo Keep Children\'s Information?</strong></p>\r\n\r\n<p>We will not retain a child\'s personal information for any longer than is necessary for educational purposes or legal obligations, or to provide the Service for which we receive or collect the child\'s personal information. Additionally, we only keep a child\'s personal information for as long as his or her student account is active, unless we are required by law or the child\'s school to retain it, need it to ensure the security of our community or our Service, or to enforce our Terms. More specifically, ClassDojo operates a 3-tier student data protection policy to protect all students\' (not just children\'s) information (\"3-Tier Student Data Protection Policy\"):</p> \r\n\r\n<p>1. Minimal information: ClassDojo collects the minimal amount of information from students necessary to use the Service. For more information, see above. In addition to the information entered by the child, we automatically collect some information from any use of our Service as set forth in the \"Information collected automatically\" section.</p> \r\n<p>2. One year deletion policy for feedback points: To protect students, ClassDojo sets limits on how long students\' feedback points given in the classroom are retained. For all students, feedback points older than 12 months are automatically deleted. For example, if a teacher sets up a class on ClassDojo on January 1, 2018, on January 1, 2019 any feedback points added in that class on or before January 1, 2018 would be deleted (and will continue to be deleted on an ongoing basis as each point reaches 12 months in age) regardless of whether or not a student has his or her own account (and if that account is active). This means feedback points cannot exist long-term. Teachers can also delete feedback points at any time. For more information on feedback points that parents can award at home, please see our FAQ.</p>\r\n<p>3. Deleting inactive accounts: If a student\'s account is inactive for twelve months or more (meaning no teacher has given feedback to the student, added content to a student\'s portfolio, or messaged with the student\'s parent(s), and neither the parent(s) nor the student have logged into their accounts), ClassDojo will automatically delete the student account. Learn more about how we delete student accounts here. Please note that certain content 1) within a student account or student portfolio (uploaded by the student, teacher or parent), such as photos, videos, Student Activity Responses or Portfolio Comments, or 2) uploaded by a teacher, school leader, parent, or student through Class Story or School Story may be kept after deletion of a student account as we are required to retain these at the direction of the school (e.g., for legal compliance reasons such as maintenance of \"education records\" under FERPA or \"student data\" under state student privacy laws). Please see our FAQ about how to request deletion of this content. For more information on the deletion of content related to our Premium Features (and not school based accounts or content), please see our FAQ.</p>\r\n\r\n<p>\r\nBasically, <br /> We only keep a child\'s personal information for as long as the account is active, unless we are required by law or the child\'s school to retain it, need it to enforce our policies, or to ensure the security of our community. Additionally, we protect students with our industry-leading 3-Tier Student Data Protection Policy: (1) we collect only minimal information from students necessary to  register for an account on the Service, (2) we automatically delete their feedback points given in the classroom after a year, and (3) we delete students\' accounts if they\'re inactive for more than twelve months. Please note that this does not include content uploaded by the teacher, parent, or student to the portfolio as we are required to retain these at the direction of the school. </p> \r\n\r\n<p><strong>Parental Choices</strong></p>\r\n\r\n<p>1) If a child (with parental consent) sets up their own account or a parent or guardian sets up their child\'s account; or a parent allows a child access to Premium Features on their device: If your child\'s account was set up directly by your child (with your consent) or you as their parent or legal guardian, set up their account, or you allow them access to Premium Features on your device, and you have a parent account connected to the student, you may access, review, correct, or delete any of your child\'s personal information in the Service by emailing privacy@classdojo.com or by contacting us here. Any content uploaded (e.g., photos, videos, Student Activity Responses, Portfolio Comments), however, that is requested as part of a class at a school, or otherwise directed by your child\'s teacher or school, is retained at the direction of the school (e.g., for legal compliance reasons such as maintenance of \"education records\" under FERPA); to correct or delete this content, please contact the appropriate official at your child\'s school. If the school determines that the request should be implemented, the school may either make the change themselves or submit the request to ClassDojo by emailing privacy@classdojo.com or by contacting us here. Additionally, at any time, you can refuse to permit us to collect further personal information from your child, and can request that we delete the personal information we have collected from your child by emailing privacy@classdojo.com or by contacting us here. Please keep in mind that deleting records may require us to terminate the account in question</p> \r\n\r\n<p>2) If your child\'s account was set up by your child\'s school (e.g., to allow the student to login via a QR code, class text code, or Google Login): If your child\'s school set up the account directly and obtained your consent (or chose to act as an agent and consent on your behalf) and you do not have a parent account connected to your child, please contact the appropriate official at your child\'s school to access, review, correct or delete any of your child\'s personal information in the Service. If the school determines that the request should be implemented, the school may either make the change themselves or submit the request to ClassDojo by emailing privacy@classdojo.com or by contacting us here. A parent or legal guardian who has a ClassDojo parent account and is already connected to their child (but did not set up their child\'s student account) may at any time contact ClassDojo directly by emailing privacy@classdojo.com or by contacting us here to access and review their child\'s personal information in the Service, but correction or deletion requests should still be made to the child\'s school first</p>\r\n\r\n<p>For either method described above, we will use commercially reasonable efforts to process such requests in a timely manner consistent with applicable law. We will need to verify your identity, for example by requiring that you provide acceptable forms of personal identification.</p> \r\n\r\n<p>Basically, <br /> We believe parents who have set up their child\'s account, or allow their child access to Premium Features on their device, should always be able to delete their child\'s account, request for us to delete their child\'s personal information, or obtain a copy of their child\'s personal information. Just email us at privacy@classdojo.com and we\'ll be happy to help. Please note, however, that certain content uploaded by your child (in the classroom or otherwise directed by their teacher) is retained at the direction of the school for legal compliance reasons and you will need to first contact the appropriate official at your child\'s school to correct or delete this information. If your child\'s teacher set up their account directly, and you do not have a ClassDojo parent account, please send your request to your child\'s school - we will process requests we receive from the school in a timely manner</p> \r\n\r\n\r\n<p><strong>What information does ClassDojo collect?</strong></p>\r\n<p>We collect two types of information about you: (1) information that you voluntarily provide us by using the Service (described below under \"Information you provide to us\") and (2) information collected automatically as result of your use of the Service (described below under \"Information collected automatically\"). We may also receive information about you from third-party sources (as described below under \"Information Received from Third-Party Sources\"). The types and amounts of information collected will vary depending on whether the user is a teacher, school leader, parent or student (e.g., we collect minimal information from students to register for an account on our Service) and how they use ClassDojo (e.g., if teachers join their school, we may need to collect school address information).</p> \r\n<p>Basically, <br /> ClassDojo asks for some limited information directly from teachers, school leaders, parents, and students (such as account information), and also collects some information automatically (such as crash reports when errors occur) in order to provide you with the best possible ClassDojo experience.</p> \r\n\r\n<p><strong>Information you provide to us</strong></p>\r\n<p>We ask for and collect the following personal information about you when you use the Service. This information is necessary for the adequate performance of the contract between you and us, for our legitimate interest in being able to provide and improve the Service, and to allow us to comply with our legal obligations. Without it, we may not be able to provide you with all the requested services.</p> \r\n<p>There are currently four categories of users on our Service: teachers, school leaders, parents, and students. Additionally, as a non-logged in visitor to the ClassDojo Website, you may provide personal information to us as set forth below. We describe the information collected from students in the \"How We Protect Children\'s Personal Information\" section above; for other users, we collect and store the following types of information from each type of user: \r\n<ul>\r\n	<li>Account Sign-up and Profile Information To create a ClassDojo account as a teacher, school leader, or parent, you may be asked to provide some basic information such as your first and last name, email address, telephone number, password and a profile photo. If a student\'s teacher is creating the student account on behalf of the student, they will provide the student\'s name and grade. This same information is also used to create the student account on the parent\'s behalf (the parent does not currently need to provide any additional personal information of their child if a parent is connected to the school with the unique parent code). If the parent is creating their child\'s account and is not connected to their child\'s school, they may provide additional information about their child (such as first and last name). Teacher and school leader profiles may be viewed by other teachers and school leaders in the same school; however, no teacher, parent or student profile is made available or visible to the genneral public through the functionality of our Service.</li>\r\n<li>School Information and Collaboration Features: If you are a teacher or school leader, as part of the profile information you provide, you may choose to associate your account with an existing school or may enter a new school name and possibly your school\'s address if we do not have it already. If you are using the Service as a teacher, school leader, or parent, we may ask you for permission to collect and store your precise geolocation information to help us identify schools located nearby for you, including to help connect your parent account to your child\'s school. By connecting you with your school, the Service may enable and provide additional collaboration features for teachers and school leaders within the same school (and parents of children at that school) such as adding photos, videos, and text updates on Class Story or School Story for parents, students and other verified teachers in that school to see. Learn more about our current collaboration features and what information may be collected and shared from teachers, school leaders, students and parents and who can view these stories here.</li>\r\n<li>Class Information: As a teacher, you enter the class year (e.g., first grade) and the names of the students in your class. It is the teacher\'s choice what they enter here: for example, teachers could enter John S or John Smith. Alternatively, teachers can also upload a spreadsheet to the Service with the student\'s first and last names, or choose students from the School Directory if they are already in a class of a verified teacher within the school. If a teacher opts to share the classes they set up on ClassDojo with other teachers or school leaders in their school, such as teachers they co-teach with, then those teachers can also see that class\'s information.</li>\r\n<li>Inviting Others and Sharing Content: As a teacher or school leader, you can invite your students\' parents to join the Service, for example by providing their email address or phone number (to invite them via SMS) within ClassDojo. As a parent, school leader, or teacher you can also invite others to join the Service or share certain content (e.g., as a parent within Premium Features) by utilizing your own native mobile application functionality through the ClassDojo App, for example by email or SMS. We will collect and store the email and phone numbers you provide with these requests, and will also treat this as personal information in accordance with this Privacy Policy. We may also ask you for access to the contacts on your mobile device to prevent you having to enter contact information for those invitations you send through our application and may store these contacts from your address book. If these individuals would like to request deletion of their information, they may contact us directly at privvacy@classdojo.com.</li>\r\n\r\n<li>Feedback Points: As a teacher or school leader, you can customize a list of feedback types that you want to encourage or recognize using feedback points, such as persistence, teamwork, or leadership. These feedback points cannot be viewed by the general public through our Service. A student\'s feedback points can only be viewed on ClassDojo by that student, the teacher who awarded them, that student\'s parents (if the teacher has elected to show them to the parent), and other teachers or school leaders the class is shared with. If the teacher chooses to display totals to the class, other students in the class may be able to see each other\'s aggregated totals (but not individual feedback points). Parents can also choose to customize and award feedback points at home to their children through the Premium Features functionality. These feedback points at home are only viewable by the parent and any children accessing the Premium Features on the parents device and are not viewable by the child\'s teacher or othher students.</li>\r\n\r\n<li>Messaging: As a teacher or school leader, you can privately message with individual parents that have signed up for the Service, including through Portfolios, or send broadcast messages to all parents at once, using the ClassDojo Messaging, Class Story, and School Story features.</li> \r\n</ul>\r\n</p>\r\n\r\n<p>As a parent, you can also message with your child\'s teacher through ClassDojo\r\nMessaging as well as through comments on Portfolios, Class Story, and School Story posts. As a teacher, school leader, or parent, your name and profile photo\r\nmay be displayed to the person with whom you are messaging, and if you are a\r\nteacher or school leader, you may receive a ‘read receipt\' showing how many\r\nparents have read your message. Please be aware that by using a broadcast\r\nmessaging feature, such as Class Story or School Story, any messages, photos,\r\nvideos or other content shared can be viewed by all parents, students (whose\r\nparents have provided verifiable parental consent to ClassDojo (or the student\'s\r\nteacher has represented they have obtained any necessary parental consent)),\r\nand teachers and school leaders that are members of that class or school,\r\nrespectively. In the case that a photo or video is shared in a broadcast message,\r\nClass Story, or School Story showing a student who does not want photos taken of\r\nhim/her (or whose parent does not want photos taken of him/her), the student or\r\nparent can contact us at privacy@classdojo.com to remove it, subject to any\r\nphoto or record being deemed an \"education record\" under FERPA. If a photos or\r\nvideo is considered an \"education record\" you will need to first contact your\r\nchild\'s school to request removal. For more information on when photos or videos\r\nare considered an \"education record\" please see the Department of Education\'s\r\nguidance here. We will store messages, including those on Class Story and School\r\nStory, and any content sent with the messages (e.g., photos), to provide the\r\nService, and to help teachers and school leaders keep a log of their\r\ncommunications with parents. For more information on how long these are\r\nretained, please see our FAQ.\r\n\r\n<ul>\r\n\r\n	<li>Portfolio Comments: Teachers can also add Portfolio Comments to their\r\nstudents (e.g., on any student\'s uploaded content, including Student Activity\r\nResponses) within Portfolios (including prior to any content being shown to\r\nthe student\'s parent). Once the teacher has approved any student-uploaded\r\ncontent, the Portfolio Comments will then be viewable to the child\'s parent\r\n(but may have been edited by the student or teacher prior to being shown to\r\nthe parent). Prior to this approval, any Portfolio Comments between the\r\nteacher and the student can\'t be viewed by the student\'s parent, but any\r\nconnected parent will receive a notice indicating that Portfolio Comments is\r\nbeing utilized by their child\'s teacher and can discuss the use of Portfolio\r\nComments with their child\'s teacher.</li>\r\n\r\n<li>Content: Teachers, school leaders, and parents may upload photos, videos,\r\nand other content, including content that may contain personal information\r\nand can be viewed by others, for example, on Class Story or School Story.\r\nLearn more about what information may be collected and shared from\r\nteachers, school leaders, students and parents and who can view these\r\nstories here. Additionally, teachers can post Activities on ClassDojo. Such\r\ninformation may include activity title, instructions, and the type of content\r\nthey expect students to respond with (e..g, photo, video, drawing, or journal\r\nentry). Once a teacher publishes such Activities, they can be viewed by their\r\nstudents, other teachers using ClassDojo at that teacher\'s school, and by other teachers that ClassDojo may share with pursuant to the Terms of\r\nService (unless a teacher opts-out), but they will not be viewable by the\r\ngeneral public. Parents can also upload photos, videos, and other content,\r\nwhich may contain personal information, through utilizing the Messaging and\r\nPremium Features features.</li>\r\n<li>Purchasing Premium Features: As a parent, when you purchase any\r\nPremium Features, you will first need to have your own parent account. You\r\nwill then be required to use either your Apple ID, Google Account, or other\r\npayment method to purchase the Premium Features. Prior to allowing your\r\nchild (or children) access to the Kids Tab within the Premium Features, we will\r\nalso require parental consent. We do not collect any credit card information\r\ndirectly from parents to purchase Premium Features, nor is any credit card\r\ndata passed back to us from any payment method you used to purchase the\r\nPremium Features. Please see here for a list of what information we receive\r\nfrom third-parties in connection with your payment method.</li>\r\n<li>Testimonials: We may collect certain personal information (such as your\r\nname, photo, and/or video) if you choose to give us a testimonial. We post\r\ntestimonials on our Service which may contain this personal information in the\r\ntestimonial. We obtain the individual\'s consent in advance to ensure we have\r\npermission to post this content publicly. To request removal of your personal\r\ninformation from our testimonials, please contact us at\r\nprivacy@classdojo.com.</li>\r\n<li>Contact Information: As a general visitor to the ClassDojo Website or as a\r\nuser of the Service, you may choose to provide us with your personal\r\ninformation, such as a name, email address and telephone number. Some\r\nexamples include when you send us an email asking a question, participate in\r\na video testimonial about our Service, or choose to participate in any research\r\nefforts with ClassDojo to improve the Service).</li>\r\n\r\n</ul>\r\n</p>\r\n\r\n<p>When you send us a message using the \"Contact Us\" page or via email, the email\r\naddresses and phone numbers collected are not further used to market to the\r\nindividual beyond providing the services requested or responding to the requests.\r\nOur use of the information above is described below in the section \"How Does\r\nClassDojo Use the Information it Collects.\" If you are using the ClassDojo App,\r\nwe may ask you for certain permissions - please see here for more detail about\r\nthose permissions. We have also prepared this chart of the personal information\r\nwe collect, how we use it, and where it is stored.</p>\r\n\r\n<p>\r\nBasically, <br />\r\nWe ask you for different types of information based on who you are\r\n(i.e., teacher, school leader, parent, and student) and which\r\nClassDojo features you use (e.g., sending a message between a\r\nteacher and a parent, or helping a teacher or parent join their\r\nschool). You may also choose to provide us with certain personal\r\ninformation as a general ClassDojo Website visitor.\r\n</p>\r\n\r\n<p><strong>Information collected automatically</strong></p>\r\n<p>When you use the Service, we (or our service providers) may automatically\r\ncollect information, including personal information, about the services you use and\r\nhow you use them. This information is necessary for the adequate performance of\r\nthe contract between you and us, to enable us to comply with legal obligations\r\nand given our legitimate interest in being able to provide and improve the Service.\r\nFor example, this could include the frequency and duration of your visits to\r\nClassDojo (similar to TV ratings that indicate how many people watched a\r\nparticular show). If you use ClassDojo on different devices, we may link the\r\ninformation we collect from those different devices to help us provide a consistent\r\nService across your different devices. If we do combine any automaticallycollected information with personal information, we will treat the combined\r\ninformation as personal information, and it will be protected as per this Privacy\r\nPolicy.\r\n</p>\r\n<p>The technologies and information we automatically collect include: <br />\r\n\r\n<ul>\r\n	<li>Cookies and other similar technologies: We (or our service providers) may\r\nuse cookies or similar technologies to identify your browser or device. We\r\n(or our service providers) may also use these technologies (never in student\r\nlogged in areas of our Service) in connection with advertising of our Service\r\nthat may appear on other sites or in connection with advertising their products\r\noutside of our Service (e.g., if you view an embedded YouTube video player on\r\nour Service, YouTube may place cookies or similar technologies on your\r\nbrowser when you play the video off our site). We don\'t allow these thirdparties to advertise directly on our Service (i.e. such as when an advertiser\r\nwould bid to place an advertisement directly on a platform such as Facebook),\r\nbut we may serve contextually relevant advertising for third-party products\r\nand services ourselves that we believe may be of interest to you (e.g., our cocreated content with Yale University on Mindfulness). Please read our Online\r\nTracking Technologies Policy for more details, including how to modify your\r\ncookie settings and a list of the tracking technologies we use.</li>\r\n<li>Local storage: We may also use, collect, and store information locally on your\r\ndevice using mechanisms such as browser web storage (including HTML5)\r\nand application data caches. Like many services, ClassDojo uses these\r\ntechnologies to analyze trends, gather demographic information, understand\r\nyour engagement with the ClassDojo Website, administer the Service, tailor\r\nthe Service for you, and to help the Service work better for you - for example,\r\nby remembering your language preferences. Please read our Online Tracking\r\nTechnologies Policy for more details.</li>\r\n<li>Device information: We collect device-specific information such as your\r\ndevice type, device brand, operating system, hardware version, device\r\nsettings, file and software names and types, battery and signal strength, and\r\ndevice identifiers. This helps us measure how the Service or ClassDojo \r\nWebsite is performing, improve ClassDojo for you on your particular device,\r\nand send you push notifications if you\'ve opted in to receive them.</li>\r\n<li>Mobile application information: Certain mobile applications or \"apps\"\r\ninclude a unique application number. This number and information about your\r\ninstallation (for example, the operating system type and application version\r\nnumber) may be sent to ClassDojo when you install or uninstall that\r\napplication, such as when you install the ClassDojo App, when you open the\r\napplication, or when that application periodically contacts our servers, such as\r\nfor automatic updates. Additionally, we may receive application state and\r\ncrash log information which will help us debug and improve the ClassDojo\r\nApp</li>\r\n<li>Server log information: Like most online services, when you use our Service\r\nor ClassDojo Website, even if you have not created a ClassDojo account or\r\nlogged in, we automatically collect and store certain information in our server\r\nlogs. Examples include things like:\r\n	<ul>\r\n    	<li>Details of how you used our Service, such as your activity on the Service\r\n        (including product event data used to track progress or user activity) or\r\n        the ClassDojo Website, and the frequency and duration of your visits to\r\n        the ClassDojo Website or the Service (similar to TV ratings that indicate\r\n        how many people watched a particular show) </li>\r\n        <li>Telephony log information like your phone number and SMS routing\r\n        information</li>\r\n        <li>IP address</li>\r\n        <li>Device event information such as crashes, system activity, hardware\r\n        settings, browser type, browser language, the date and time of your\r\n        request and referral URL</li>\r\n    </ul>\r\nThis information helps us make decisions about what we should work on next - for\r\nexample, by showing which features are most (or least!) popular and to send\r\nnotifications to a device (such as push notifications if the user opted in) to\r\nencourage the user to finish an activity or start the next activity\r\n</li>\r\n\r\n<li>Location information: When you use our Service or browse the ClassDojo\r\nWebsite, we may collect and process information about your geographic\r\nlocation, for example based on your IP address. We collect both coarse (i.e.,\r\ncity-level) location data and precise location data. If we collect precise\r\ngeolocation information (\"precise\" meaning sufficient to identify street name\r\nand name of city or town) from you (such as when a teacher or parent is\r\nsearching for a school), we ask for your explicit opt-in permission. We never\r\ncollect precise geolocation data from students. We will not store or track your\r\ndevice location on an ongoing basis or without your permission. We do not\r\nshare precise geolocation data with third-parties, other than our service\r\nproviders as necessary to provide the Service. If you no longer wish to allow\r\nus to track your location information, you may opt-out at any time by turning it\r\noff at the device level.</li>\r\n<li>Cross-device collection: To provide users with a seamless online experience,\r\nwe may link your identifiers on different browsers and environments you are\r\nusing our syncing technology, DojoCast. With DojoCast, ClassDojo is able to\r\nprovide a seamless experience across multiple devices and browsers without\r\ncollecting or processing any additional identifying personal data.</li>\r\n</ul>\r\n\r\n</p>\r\n\r\n<p>Basically, <br />\r\nWe collect some information from you automatically (and\r\nadditionally use cookies and other similar technologies to collect\r\ninformation) so that we know when things go wrong, or to help us\r\nunderstand what parts of ClassDojo need some improvement. If we\r\nneed to collect street-level (\"precise\") geolocation data from you\r\nas a teacher, school leader, or parent, we\'ll ask for your explicit,\r\nopt-in consent. We never collect precise geolocation data from\r\nstudents.</p>\r\n\r\n<p><strong>Information received from third-party sources</strong></p>\r\n<p>We may also obtain information, including personal information, from third-party\r\nsources to update or supplement the information you provided or we collected\r\nautomatically. This may include aggregated anonymous information or certain\r\npersonal information that may be provided to us. If we receive personal\r\ninformation from third-parties, we will handle it in accordance with this Privacy\r\nPolicy. If we directly combine information we receive from other third-parties with\r\npersonal information that we collect through the Service, we will treat the\r\ncombined information as personal information and handle it in accordance with\r\nthis Privacy Policy. Additionally, we may use any aggregated anonymous\r\ninformation received by third-parties as set forth below under the heading\r\n\"Aggregated Information and Non-Identifying Information\". Local law may\r\nrequire you authorize the third-party to share your information with us before we\r\ncan acquire it. We do not control, supervise, or respond to how third parties\r\nproviding your information process your personal information, and any information\r\nrequest regarding the disclosure of your personal information to us should be\r\ndirected to such third-parties.</p>\r\n\r\n<p>Basically, <br />\r\nWe may collect some information from third-party sources, such as\r\nSurveyMonkey when we send questionnaires to teachers and\r\nparents. That information will be handled under this Privacy Policy</p>\r\n\r\n<p><strong>How does ClassDojo use the information it collects?</strong></p>\r\n<p>First and foremost, you should know that ClassDojo does not sell or rent any of\r\nyour, or your child\'s, personal information to any third-party for any purpose -\r\nincluding for advertising or marketing purposes. Third-party advertising is not\r\npermitted on areas where users are required to log in to ClassDojo and personal information collected from students is never used for behaviorally-targeted\r\nadvertising to students (by us or third-parties). We use the information we collect\r\nfrom you to provide you with the best ClassDojo experience. Our use of\r\ninformation collected from students (and non-student child users) is set forth\r\nabove in the section \"What Information Does ClassDojo Collect from Children,\r\nand How Is it Used\". More specifically, this information collected from nonstudents is used to:</p>\r\n\r\n<ul>\r\n	<li>Provide and improve the Service and ClassDojo Website, for example by\r\ndeveloping new products and features</li>\r\n<li>\r\nRespond to your emails, submissions, questions, requests for information or\r\ncustomer support</li>\r\n<li>Customize the Service and ClassDojo Website for you, and improve your\r\nexperience with it</li>\r\n<li>Send you information about features on our Service or changes to our policies\r\nand Service or the ClassDojo Website</li>\r\n<li>Send you security alerts, and support and administrative messages and\r\notherwise facilitate your use of, and our administration and operation of the\r\nService and the ClassDojo Website</li>\r\n<li>Provide parents and teachers information about events, announcements,\r\noffers, promotions, products, including third-party products, and services we\r\nthink will be of interest to you</li>\r\n<li>Notify and contact contest and sweepstakes entrants</li>\r\n<li>For any other purpose for which the information was collected (e.g., fulfilling\r\nPremium Features orders)</li>\r\n<li>Most crucially, to protect our community by making sure the Service and the\r\nClassDojo Website remains safe and secure</li>\r\n\r\n\r\n</ul>\r\n\r\n<p>We use automatically collected information (described in the \"Information\r\ncollected automatically\" section above) to provide and support our Service and\r\nthe ClassDojo Website, and for the additional uses described in this section of our\r\nPrivacy Policy. To learn more about how we use your information for\r\npersonalization and tracking, please see the Online Tracking Technologies\r\nPolicy.</p>\r\n\r\n<p>We process this information given our legitimate interest in improving the Service\r\nand the ClassDojo Website and our users\' experience with it, in protecting the\r\nService and the ClassDojo Website, where necessary for the adequate\r\nperformance of the contract with you, and to comply with applicable laws.\r\nAdditionally, we will process your personal information for the purposes listed in\r\nthis section related to marketing given our legitimate interests in undertaking\r\nmarketing activities to offer you products and services that may be of your\r\ninterest. You can opt-out of receiving marketing communications from us by\r\nfollowing the unsubscribe instructions included in our marketing communications\r\nor changing your notification settings within your ClassDojo account.</p>\r\n\r\n<p>Basically, <br />\r\nClassDojo doesn\'t sell or rent your information to third-parties, we\r\ndon\'t permit third-party advertising on ClassDojo, and personal\r\ninformation collected from students is never used for behaviorallytargeted advertising to students. We use your information to\r\nprovide and personalize the Service and the ClassDojo Website to\r\nyou, optimize and improve our Service and the ClassDojo Website,\r\ncommunicate with you about our Service and the ClassDojo\r\nWebsite, and for security and safety reasons. We may also use the\r\ninformation provided by parents and teachers to provide parents\r\nand teachers information about events, announcements, offers,\r\npromotions, products, including third-party products, and services\r\nwe think will be of interest to you.</p>\r\n\r\n<p><strong>Will ClassDojo share any information it collects?</strong></p>\r\n<p>First and foremost, you should know that ClassDojo does not sell or rent your (or\r\nyour child\'s) personal information to any third-party for any purpose - including\r\nfor advertising or marketing purposes. Third-party advertising is not permitted\r\non areas where users are required to log in to ClassDojo and personal information\r\ncollected from students is never used for behaviorally-targeted advertising to\r\nstudents (by us or third-parties). Furthermore, we do not share personal\r\ninformation with any third-parties except in the limited circumstances described in\r\nthis Privacy Policy and as set forth below:\r\n\r\n	<ul>\r\n    	<li>Other Users You Share and Communicate with on ClassDojo: No teacher,\r\nschool leader, parent or student profiles are made available to the general\r\npublic through our Service. Furthermore, students cannot share their account\r\ninformation or portfolio with anyone on ClassDojo, outside of their parents,\r\nteachers, or school leaders. If you are a teacher, school leader, or a parent,\r\nyou may choose to share information or content through the Service with\r\nother ClassDojo teachers, school leaders, students, or parents - for example,\r\nthings like your account information, feedback points awarded to students\r\nyou teach (if you are a teacher or school leader) or to your children (if you are\r\na parent) or other information you share with teachers, school leaders, or\r\nparents you are communicating with through ClassDojo Messaging, Class\r\nStory, or School Story or our other collaboration features.\r\nPlease keep in mind that information (including personal Information or\r\nchildren\'s personal information) or content that you voluntarily disclose to\r\nothers - including to other ClassDojo users you interact with through the\r\nService (such as messages you might send other users or other teachers and\r\nschool leaders you collaborate with) - can be viewed, copied, stored, and used\r\nby the people you share it with. We cannot control the actions of people with\r\nwhom you choose to share information and we are not responsible for the\r\ncollection, use or disclosure of such information or content by others.</li>\r\n\r\n\r\n<li>Third-party integrations on our Service: When, as a teacher, school leader,\r\nstudent, or parent, you use third-party apps, websites or other services that\r\nuse, or are integrated with, our Service, they may receive information about\r\nwhat you post or share. For example, when you share a Big Ideas activity on\r\nTwitter or Facebook, these services receive the information that you share\r\nthrough this functionality, and information that you are sharing from\r\nClassDojo. We may also have third-party integrations on the ClassDojo\r\nWebsite (non-user logged in areas). Please see here for more information on\r\nSocial Media Features and here for more information on third-party services.\r\nPlease see here for a list of third-party app integrations on our Service and\r\nthe ClassDojo Website.</li>\r\n\r\n<li>Service Providers: We do work with vendors, service providers, and other\r\npartners to help us provide the Service and the ClassDojo Website by\r\nperforming tasks on our behalf - we can\'t build everything ourselves, after all!\r\nThese service providers may be located inside or outside of the European\r\nEconomic Area (\"EEA\"). We may need to share or provide information\r\n(including personal information) to them to help them perform these business\r\nfunctions, for example sending emails on our behalf, database management\r\nservices, database hosting, providing customer support software, and\r\nsecurity. These providers have limited access to your personal information to\r\nperform these tasks on our behalf, and are contractually bound to protect and\r\nuse it only for the purpose for which it was disclosed and consistent with this\r\nPrivacy Policy. Please see here for a list of the third-parties we work with to\r\nprovide the Service and the ClassDojo Website.</li>\r\n\r\n<li>Social Media Platforms: Where permissible according to applicable law, we\r\nmay share certain limited personal information with social media platforms\r\n(such as Google or Facebook) and other websites, applications or partners, to\r\ngenerate leads, drive traffic to our websites or otherwise market and advertise\r\nour products or services on those websites or applications (this will never\r\ninclude personal information of students). These processing activities are\r\nbased on our legitimate interest in undertaking marketing activities to offer\r\nyou products and services that may be of your interest. These social media\r\nplatforms with which we may share your personal information are not\r\ncontrolled or supervised by ClassDojo. Therefore, any questions regarding\r\nhow your social media platform processes your personal information should be\r\ndirected to such provider.</li>\r\n\r\n<li>Analytics Services: We use analytics services, including mobile analytics\r\nsoftware, to help us understand and improve how the Service and ClassDojo\r\nWebsite is being used. These services may collect, store and use information\r\nin order to help us understand things like how often you use the Service or the\r\nClassDojo Website, the events that occur within the application, usage,\r\nperformance data, and from where the application was downloaded. A current\r\nlist of analytics providers that we use is located here.</li>\r\n\r\n<li>Aggregated Information and Non-Identifying Information: We may share\r\naggregated information (information about our users that we combine\r\ntogether so that it no longer identifies or references an individual user) and\r\nother de-identified or non-personally identifiable information (such as\r\nstatistics about visitors, traffic and usage patterns), including with users,\r\npartners or the press in order to, for example, demonstrate how ClassDojo is\r\nused, spot industry trends, or to provide marketing materials for ClassDojo.\r\nAny aggregated information and non-personalized information shared this way\r\nwill not contain any personal information.</li>\r\n<li>Legal Requirements: We may disclose information, including personal\r\ninformation, if we have a good faith belief that doing so is necessary to comply\r\nwith the law, such as complying with a subpoena or other legal process. We\r\nmay need to disclose personal information where, in good faith, we think it is\r\nnecessary to protect the rights, property, or safety of ClassDojo, our\r\nemployees, our community, or others, or to prevent violations of our Terms of\r\nService or other agreements. This includes, without limitation, exchanging\r\ninformation with other companies and organizations for fraud protection or\r\nresponding to law enforcement and government requests. Where appropriate,\r\nwe may notify users about the legal requests, unless (i) providing notice is\r\nprohibited by the legal process itself, by court order we receive, or by\r\napplicable law; (ii) we believe that providing notice would be futile, ineffective,\r\ncreate a risk of injury or bodily harm to an individual or group, or create or\r\nincrease a risk of fraud upon ClassDojo, or its users. In instances where we\r\ncomply with legal requests without notice for these reasons, we will attempt to\r\nnotify that user about the request after the fact where appropriate and where\r\nwe determine in good faith that we are no longer prevented from doing so.</li>\r\n\r\n<li>Sharing with ClassDojo Companies: Over time, ClassDojo may grow and\r\nreorganize. We may share your personal information with affiliates such as a\r\nparent company, subsidiaries, joint venture partners or other companies that\r\nwe control or that are under common control with us, in which case we will\r\nrequire those companies to agree to use your personal information in a way\r\nthat is consistent with this Privacy Policy.</li>\r\n<li>Change of control: The Student Privacy Pledge requires us (and all\r\npledgers) to commit to how we handle data in the event of a change to our\r\norganizations such that all or a portion of ClassDojo or its assets are acquired\r\nby or merged with a third-party, or in any other situation where personal\r\ninformation that we have collected from users would be one of the assets\r\ntransferred to or acquired by that third-party. Consistent with the Student\r\nPrivacy Pledge and applicable state and federal laws, in connection with such\r\na change to our organization, if any, this Privacy Policy will continue to apply\r\nto your information, and any acquirer would only be able to handle your\r\npersonal information as per this policy (unless you give consent to a new\r\npolicy). We will provide you with notice of an acquisition within thirty (30) days \r\nfollowing the completion of such a transaction, by posting on our homepage,\r\nor by email to your email address that you provided to us. If you do not\r\nconsent to the use of your personal information by such a successor company,\r\nsubject to applicable law, you may request its deletion from the company.\r\nIn the unlikely event that ClassDojo goes out of business, or files for\r\nbankruptcy, we will protect your personal information, and will not sell it to\r\nany third-party. For more information on our practices regarding your data if\r\nwe go out of business, please see our FAQ.</li>\r\n<li>With your consent: Other than the cases above, we won\'t disclose your\r\npersonal information for any purpose unless you consent to it.</li>\r\n\r\n    </ul>\r\n\r\n</p>\r\n<p>Basically,\r\nClassDojo doesn\'t sell or rent your personal information to any\r\nthird-parties. We believe your information is yours, and you should\r\nown it - we think that\'s the right way to operate. We share some\r\ninformation with service providers who help us provide you with the\r\nService and the ClassDojo Website – like companies that help us\r\nsend emails, for example, or if we have to to comply with the law.\r\nAdditionally, you may choose to share information with other users\r\nof the Service or to third-parties that are integrated on our Service\r\nor the ClassDojo Website.</p>\r\n\r\n<p>And, if ClassDojo is ever acquired or goes out of business, our\r\ncommitments don\'t change: we still won\'t sell or rent your personal\r\ninformation to anyone. Your personal information will continue to be\r\nprotected by this policy, and any company that acquires ClassDojo\r\nwill have to abide by this policy, unless you give consent to a new\r\npolicy.</p>\r\n\r\n<p><strong>How does ClassDojo protect and secure my information?</strong></p>\r\n\r\n<p>Your ClassDojo account is protected by a password or a QR code. You can help us\r\nprotect against unauthorized access to your account by keeping your password or\r\nQR code secret at all times. The security of your personal information is\r\nimportant to us. We work hard to protect our community, and we maintain\r\nadministrative, technical and physical safeguards designed to protect against\r\nunauthorized use, disclosure of or access to personal information. In particular:\r\n\r\n<ul>\r\n	<li>Our engineering team is dedicated to keeping your personal information\r\nsecure </li><li>\r\nWe perform application security testing; penetration testing; conduct risk\r\nassessments; and monitor compliance with security policies</li><li>\r\nWe periodically review our information collection, storage and processing\r\npractices, including physical security measures, to guard against unauthorized\r\naccess to systems</li><li>\r\nWe continually develop and implement features to keep your personal \r\ninformation safe</li><li>\r\nWhen you enter any information anywhere on the Service or the ClassDojo\r\nWebsite, we encrypt the transmission of that information using secure socket\r\nlayer technology (SSL/TLS) by default</li><li>\r\nClassDojo\'s database where we store your personal information is encrypted\r\nat rest, which converts all personal information stored in the database to an\r\nunintelligible form.</li><li>\r\nWe ensure passwords are stored and transferred securely using encryption\r\nand salted hashing</li><li>\r\nThe Service and the ClassDojo Website is hosted on servers at a third-party\r\nfacility, with whom we have a contract providing for enhanced security\r\nmeasures. For example, personal information is stored on a server equipped\r\nwith industry standard firewalls. In addition, the hosting facility provides a\r\n24x7 security system, video surveillance, intrusion detection systems and\r\nlocked cage areas.</li><li>\r\nWe automatically delete inactive student accounts after a specific period of\r\ntime, as per our retention policy, described in the \"How Long Does ClassDojo\r\nKeep Children\'s Information?\" section.</li><li>\r\nWe also operate a ‘bug bounty\' security program to encourage an active\r\ncommunity of third-party security researchers to report any security bugs to\r\nus. More information on this is available by contacting us at\r\nprivacy@classdojo.com</li><li>\r\nWe restrict access to personal information to authorized ClassDojo\r\nemployees, agents or independent contractors who need to know that\r\ninformation in order to process it for us, and who are subject to strict\r\nconfidentiality obligations and may be disciplined or terminated if they fail to\r\nmeet these obligations</li>\r\n</ul>\r\n\r\n</p>\r\n<p>\r\nFor additional information on our security practices, please visit our Privacy\r\nCenter. Although we make concerted good faith efforts to maintain the security of\r\npersonal information, and we work hard to ensure the integrity and security of our\r\nsystems, no practices are 100% immune, and we can\'t guarantee the security of\r\ninformation. Outages, attacks, human error, system failure, unauthorized use or\r\nother factors may compromise the security of user information at any time. If we\r\nlearn of a security breach, we will attempt to notify you electronically (subject to\r\nany applicable laws and school reporting requirements) so that you can take\r\nappropriate protective steps; for example, we may post a notice on our homepage\r\n(www.classdojo.com) or elsewhere on the Service, and may send email to you at\r\nthe email address you have provided to us. Depending on where you live, you may\r\nhave a legal right to receive notice of a security breach in writing.</p>\r\n\r\n<p>Basically, <br />\r\nThe security of your information is important to us, and we take it\r\nvery seriously. We\'re always adding safeguards to ensure the safety\r\nand security of ClassDojo and our community of teachers, school leaders, parents, and students. You can help us out by keeping your\r\npassword and QR code secret! When you enter information\r\nanywhere on the Service or the ClassDojo Website, we encrypt the\r\ntransmission of that information using SSL by default.</p>\r\n\r\n<p><strong>ClassDojo\'s commitments to providing Transparency and Your Rights</strong></p>\r\n<p>As you can see, we try to be transparent about what information we collect, so\r\nthat you can make meaningful choices about how it is used. You control the\r\npersonal information you share with us. You can access or rectify this information\r\nat any time. You can also delete your account. We also provide you tools to object,\r\nrestrict, or withdraw consent where applicable for the use of personal information\r\nyou have provided to ClassDojo. We also make the personal information you share\r\nthrough our Service or the ClassDojo Website portable and provide easy ways for\r\nyou to contact us.</p>\r\n\r\n<p>You may exercise any of these rights described in this section by sending an email\r\nto privacy@classdojo.com or making a request here. Please note that we may\r\nask you to verify your identity before taking further action on your request.</p>\r\n\r\n<p>\r\n<ul>\r\n	<li>Access or correct your personal information</li>\r\n    <li>Control who you share information with</li>\r\n    <li>Delete your account from ClassDojo;</li>\r\n    <li>Object, restrict, or withdraw consent;</li>\r\n    <li>Take information out of ClassDojo</li>\r\n</ul>\r\n</p>\r\n\r\n<p>Basically, <br />\r\nAt ClassDojo, we believe that more transparency is better. We try to\r\ngive you control, with easy settings and options, so that you can\r\nmake good choices when it comes to your information and how it is\r\nused. We also set forth the ways in which you can exercise your\r\nrights to access, correct, and delete your personal information as\r\nwell as your right to take information out of ClassDojo and object or\r\nwithdraw consent.</p>\r\n\r\n<p><strong>Access or correct your personal information</strong></p>\r\n<p>ClassDojo aims to provide you with easy access to any personal information we\r\nhave collected about you and give you easy ways to update it or delete it, unless\r\nwe have to keep that information for legitimate business purposes (e.g., we need\r\nat least an email address for your account if you maintain an account with us) or\r\nlegal purposes. You have the right to correct inaccurate or incomplete personal\r\ninformation concerning you (and which you cannot update yourself within your\r\nClassDojo account).</p>\r\n\r\n<p>Managing Your Information: If you have registered for an account on ClassDojo,\r\nyou may update, correct, or delete some of your profile information or your \r\npreferences at any time by logging into your account on ClassDojo and accessing\r\nyour account settings page. You may have to verify your identity before you can do\r\nthat. You may also, at any time, update, correct, or delete certain personal\r\ninformation that you have provided to us by contacting us at\r\nprivacy@classdojo.com or by following the instructions here. We will respond to\r\nyour request within a reasonable timeframe.</p>\r\n\r\n<p>Accessing Your Information: Upon request, ClassDojo will provide you with\r\ninformation about whether we hold any of your personal information, and, If you\r\nare a user of ClassDojo, you may request access to all your personal information\r\nwe have on file by contacting us at privacy@classdojo.com or by following the\r\ninstructions here. In some cases, we won\'t be able to guarantee complete access\r\ndue to legal restrictions - for example, you will not be allowed to access files that\r\ncontain information about other users or information that is confidential to us.</p>\r\n\r\n<p>Accessing Your Child\'s Information: Visit our \"Parental Choices\" section to see\r\nhow you can obtain copies of your child\'s personal information.\r\nWe may reject requests for access, change or deletion that are unreasonably\r\nrepetitive, require disproportionate technical effort (for example, developing a new\r\nsystem or fundamentally changing an existing practice), risk the privacy of others,\r\nor would be extremely impractical (for instance, requests concerning information\r\nresiding on backup systems).</p>\r\n\r\n<p>Where we can provide information access and correction, we will do so for free,\r\nexcept where it would require a disproportionate effort.</p>\r\n\r\n<p>You have certain rights to access, update and correct your personal\r\ninformation. You can always access and manage your personal\r\ninformation through your ClassDojo account, or by contacting us or\r\nyour child\'s school if they created your child\'s account. Please see\r\nhere for more information on accessing your child\'s information.</p>\r\n\r\n<p><strong>How can I delete my account?</strong></p>\r\n<p>We hope you love using ClassDojo now and always. However, if for some reason\r\nyou ever want to delete your account (or your child\'s account, if you are his or her\r\nparent), you can do that at any time by contacting us at privacy@classdojo.com\r\nor by following the instructions here. If you are a parent, teacher, or school leader\r\nusing the Service, you may also delete your account by logging into your account\r\nand accessing your account settings page.</p>\r\n\r\n<p>When you delete your account, we delete your profile information and any other\r\ncontent you provide in your profile (such as your name, username, password,\r\nemail address, and profile photos) and depending on the category of user you are\r\n(i.e., teacher, school leader, parent, or student), feedback points awarded in\r\nschool and information collected through the mobile permissions you\'ve\r\ngranted. Information that you have shared with others, others have shared about \r\nyou, or content other users may have copied and stored, is not part of your\r\naccount and may not be deleted when you delete your account. Additionally,\r\nplease note, that even if your account is deleted, messages sent between teachers\r\nand parents (or Portfolio Comments between teachers and students) are retained\r\nto assist schools with various recordkeeping or compliance obligations. This\r\nincludes, for example, any content uploaded, including photos and videos on\r\nMessaging, Portfolios, Class Story, or School Story, which we consider messaging\r\nbetween parents and teachers. Additionally, some content within a student\r\naccount, such as Student Activity Responses and other content uploaded by the\r\nstudent and/or teacher, will be kept after the student account is deleted for school\r\nlegal compliance reasons (e.g., maintenance of \"education records\" under FERPA\r\nor \"student records\" under various state student privacy laws). If you would like\r\nthis content deleted, please first put in a request to your (or your child\'s) school. If\r\nthe school determines that the request should be implemented, the school may\r\nsubmit the request to ClassDojo by emailing privacy@classdojo.com. For more\r\ndetails, please read \"What happens when I delete my account?\" in our FAQs.\r\nWe aim to maintain our services in a manner that protects information from\r\naccidental or malicious destruction. Because of this, even after you update or\r\ndelete personal information you have provided us from our Service, your personal\r\ninformation may be retained in our backup files and archives for a reasonable\r\nperiod of time as necessary for our legitimate business interests, such as fraud\r\ndetection and prevention and enhancing safety</p>\r\n<p>For example, if we suspend a ClassDojo account for fraud or safety reasons, we\r\nmay retain certain information from that account to prevent that user from opening\r\na new account in the future. Also, we may retain and use your personal information\r\nto the extent necessary to comply with our legal obligations.</p>\r\n\r\n<p>Basically, <br />\r\nYou can always delete your account by visiting your account\r\nsettings, or simply by contacting us. For more details on what\r\nhappens when you delete your account, click here. Please note that\r\nsome content will not be deleted given various compliance and\r\nrecordkeeping obligations schools have. Please contact your (or\r\nyour child\'s) school if you would like all of this content deleted. If\r\nthe school determines that the request should be implemented,\r\nthey may submit a request to us.</p>\r\n\r\n<p><strong>Object, Restrict, or Withdraw Consent</strong></p>\r\n<p>\r\nWhere you have provided your consent to the processing of your personal\r\ninformation by ClassDojo you may withdraw your consent at any time by changing\r\nyour account settings or by sending a communication to ClassDojo specifying\r\nwhich consent you are withdrawing. Please note that the withdrawal of your\r\nconsent does not affect the lawfulness of any processing activities based on such \r\nconsent before its withdrawal. ClassDojo provides parents and teachers with the\r\nopportunity to withdrawal consent or ‘opt-out\' of receiving any future marketing\r\ncommunications from ClassDojo and its partners at any time. Please see the\r\n\"What communications will I receive from ClassDojo?\" section below for more\r\ninformation. Additionally, you can always decline to share personal information\r\nwith us, or even block all cookies. However, it\'s important to remember that many\r\nof ClassDojo\'s features may not be accessible, or may not function properly - for\r\nexample, we may not be able to remember your language preferences for you.\r\nIn some jurisdictions, applicable law may entitle you to require ClassDojo not to\r\nprocess your personal information for certain specific purposes (including\r\nprofiling) where such processing is based on legitimate interest. If you object to\r\nsuch processing ClassDojo will no longer process your personal information for\r\nthese purposes unless we can demonstrate compelling legitimate grounds for\r\nsuch processing or such processing is required for the establishment, exercise or\r\ndefence of legal claims. Additionally, in some jurisdictions, applicable law may give\r\nyou the right to limit the ways in which we use your personal information, in\r\nparticular where (i) you contest the accuracy of your personal information; (ii) the\r\nprocessing is unlawful and you oppose the erasure of your personal information;\r\n(iii) we no longer need your personal information for the purposes of the\r\nprocessing, but you require the information for the establishment, exercise or\r\ndefence of legal claims; or (iv) you have objected to the processing as set forth\r\nbelow and pending the verification whether the legitimate grounds of ClassDojo\r\noverride your own.\r\n</p>\r\n<p>Basically,\r\nYou have the right to withdraw consent for the collection of your\r\npersonal information, and also opt-out of marketing\r\ncommunications from us. You may also be able to limit the ways in\r\nwhich ClassDojo uses your personal information. Just email us at\r\nprivacy@classdojo.com and we\'ll help you right away.</p>\r\n<p>Additional Information or Assistance and Article 27 GDPR Local\r\nRepresentative</p>\r\n<p>If you are located in the European Union or the EEA, you have a right to lodge\r\ncomplaints about the data processing activities carried about by ClassDojo with\r\nClassDojo\'s lead supervisory authority, the Information Commissioner\'s Office. You\r\ncan find their contact details here</p>\r\n\r\n<p>Pursuant to Article 27 of the GDPR, ClassDojo, Inc. has appointed European Data\r\nProtection Office (EDPO) as its GDPR representative in the EU. You can contact\r\nEDPO regarding matters pertaining to the GDPR by sending an email to\r\nprivacy@edpo.brussels, using EDPO\'s online request form, or writing to EDPO at\r\nAvenue Huart Hamoir 71, 1030 Brussels, Belgium.</p>\r\n\r\n<p>Basically, <br />\r\nIf you\'re located in the EU and would like to make a complaint,\r\ncontact our local authority here. Additionally, you can contact\r\nClassDojo\'s appointed local representative in the EU, European Data\r\nProtection Office (EDPO) using their online request form.</p>\r\n\r\n<p>How long does ClassDojo keep information about me?</p>\r\n<p>Non-Student Users: <br />\r\nWe store your personal information for as long as it is necessary to provide the\r\nService to you and others, including those described above. Personal information\r\nassociated with your account will be kept until your account is deleted, unless we\r\nno longer need the data to provide products and services, in which case we will\r\ndelete prior to you deleting your account.</p>\r\n\r\n<p>Please note that we may have to retain some information after your account is\r\nclosed, to comply with legal obligations, to protect the safety and security of our\r\ncommunity or our Service, or to prevent abuse of our Terms. You can, of course,\r\ndelete your account at any time, as per the \"How can I delete my account?\"\r\nsection. Additionally, please note, that even if your account is deleted, messages\r\nsent between teachers and parents are retained to assist schools with various\r\nrecordkeeping or compliance obligations. Additionally, some content uploaded by\r\na teacher, school leader, or parent, including photos, videos, and Portfolio\r\nComments on Messaging, Portfolios, Class Story, or School Story, are retained at\r\nthe direction of the school (e.g., for legal compliance reasons such as\r\nmaintenance of \"education records\" under FERPA or \"student data\" under various\r\nstate student privacy laws) and will not be deleted until we receive direction from\r\nthe school. For more details, please read \"What happens when I delete my\r\naccount?\" in our FAQs.</p>\r\n\r\n<p>Student Users:\r\nPlease see the \"How Long Does ClassDojo Keep Children\'s Information?\" for\r\ndetails on how long we retain data for Student Users.</p>\r\n\r\n<p>Basically, <br />\r\nWe keep teacher, school leader, and parent personal information\r\nuntil your account is deleted, or until we no longer need it to provide\r\nyou with the Service. We only keep student personal information for\r\nas long as the student\'s account is active, unless we are required by\r\nlaw or the student\'s school to retain it, or need it to protect the\r\nsafety of our users. Additionally, for students, we have our 3-Tier\r\nStudent Data Protection Policy that states how we delete students\'\r\ninformation after some time. Note that some content may be kept\r\nafter an account (student, parent, or teacher) is deleted for school\r\nlegal compliance reasons (e.g., maintenance of \"education records\"\r\nunder FERPA).</p>\r\n\r\n<p><strong>What communications will I receive from ClassDojo?</strong></p>\r\n\r\n<p>If you registered on ClassDojo, provided an email or phone number to us, or\r\notherwise opted-in to receive communications from us, we may send you\r\nmessages and updates regarding your account, including privacy and security\r\nnotices, updates regarding the Service or ClassDojo Website, and information\r\nregarding products, features or services from ClassDojo (or third-parties we\r\nbelieve you may be interested in). These communications may include, but are not\r\nlimited to, social media updates, SMS/MMS messages, push notifications, email,\r\nand postal mail. If you have an account with us, we\'ll also use your email address\r\nto contact you for customer service purposes, or for any legal matters that arise in\r\nthe course of business. We may receive a confirmation when you open an email\r\nfrom us if your device supports it. We use this confirmation to help us understand\r\nwhich emails are most interesting and helpful.</p>\r\n\r\n<p>If you invite another person to join you on ClassDojo by providing their email\r\naddress or phone number, we may contact them regarding the Service using the\r\nappropriate form of communication. If they would prefer not to receive our\r\ncommunications, they may opt-out using the \"Unsubscribe\" or \"STOP\"\r\ninstructions contained in those communications. If, as a parent/legal guardian of a\r\nstudent, you provided an email address or phone number to your child\'s school,\r\nClassDojo, at the direction of the school, may send an invitation to join ClassDojo\r\nvia the email or phone number your student\'s teacher provided ClassDojo. The\r\ninvitation may be sent via email or SMS/MMS text message. If, as a parent/legal\r\nguardian, you provide your telephone number to your child\'s school, you are\r\nconsenting to ClassDojo (on behalf of and at the direction of your child\'s school)\r\nsending informational text messages closely related to the school\'s mission.</p>\r\n\r\n<p>You can always unsubscribe from receiving any of our 1) marketing emails or other\r\nmarketing communications whenever you\'d like by clicking the \"Unsubscribe\" link\r\nat the bottom of the email; 2) marketing SMS texts by replying or texting ‘STOP\' to\r\n‘23656\'; or 3) marketing push notifications by turning off push notifications on\r\nyour device.</p>\r\n\r\n<p>You can further indicate your preferences by contacting us using the information\r\nin the \"How can I contact ClassDojo with questions?\" section below. Please\r\nnote that if you do not want to receive legal notices from us, such as this Privacy\r\nPolicy, those legal notices will still govern your use of the Website, and you are\r\nresponsible for reviewing those legal notices for changes.</p>\r\n\r\n<p>Basically,\r\nFrom time to time, we may send you useful messages about\r\nupdates or new features. You can always opt-out of these\r\nmessages if you\'d rather we didn\'t contact you.</p>\r\n\r\n<p>Social Media Features/Widgets</p>\r\n\r\n<p>The Service and the ClassDojo Website may now or in the future include social \r\nmedia features, such as the Facebook Like button or the Twitter Tweet button, or\r\nincorporate certain other functions that allow you to interact with the Service\r\nthrough your accounts on certain supported third-party social network or network\r\nstorage sites (collectively \"Social Media Features\"). These Social Media Features\r\nmay collect your IP address, which page you are visiting on our site, and may set a\r\ncookie to enable the feature to function properly. You may be given the option by\r\nsuch Social Media Features to post information about your activities on our\r\nService to a profile page of yours that is provided by a third-party social media\r\nnetwork in order to share with others within your network. Social Media Features\r\nare either hosted by a third-party or hosted directly on our Service or the\r\nClassDojo Website. Your interactions with these Social Media Features are\r\ngoverned by the privacy policy of the company providing each Social Media\r\nFeature. If you are not comfortable accessing such social media websites and\r\nusing such Social Media Features, please don\'t use them!</p>\r\n\r\n<p>Basically, <br />\r\nWe may have some social media sharing features from Facebook,\r\nTwitter, and other popular social networking sites available for use.\r\nThese features are governed by the respective company\'s privacy\r\npolicy</p>\r\n\r\n<p>Third-party Authentication Services</p>\r\n\r\n<p>If you decide to register for a ClassDojo account through an authentication\r\nservice, such as Google Login (\"Authentication Service\"), ClassDojo may collect\r\npersonal information that is already associated with your account connected to\r\nthe Authentication Service. If you choose to provide such information during\r\nregistration, you are giving ClassDojo the permission to store and use such\r\ninformation already associated with your Authentication Service in a manner\r\nconsistent with this Privacy Policy. The current list of Authentication Services that\r\nwe use is listed here. Please note, that when using an Authentication Service for\r\nregistering a student (or if a student is directly using their own Authentication\r\nService), ClassDojo will not request more information from the Authentication\r\nService than name and email address unless specifically requested or chosen to\r\nbe passed by the teacher or school to ClassDojo. We will only use the email\r\ncollected from student users for the purposes of login and account management.\r\nThe Authentication Service may collect certain other information from you in your\r\nuse of that particular service (such as G-Suite for Education). You may revoke\r\nClassDojo\'s access to your account on any Authentication Service at any time by\r\nupdating the appropriate settings in the account preferences of the respective\r\nAuthentication Service. You should check your privacy settings on each\r\nAuthentication Service to understand and change the information sent to us\r\nthrough each Authentication Service. Please review each Authentication Service\'s\r\nterms of use and privacy policies carefully before using their services and\r\nconnecting to our Service. Your use of Authentication Service is subject to the \r\napplicable third-party terms and privacy policies. Please see here for more\r\ninformation on what we collect through the use of Authentication Services and\r\nhow we use that information.</p>\r\n\r\n<p>Basically, <br />\r\nWe may allow for users to register on our Service through an\r\nauthentication service (e.g. with Google Login). If you to choose to\r\ndo so, we may collect personal information that is already\r\nassociated with your connected authentication service and you give\r\nus permission to use and store this information consistent with this\r\nPrivacy Policy. You can revoke our access to your account on this\r\nauthentication service at any time by updating the appropriate\r\nsettings in the account settings of the authentication service.</p>\r\n\r\n<p>Please note, that when using an authentication service for registering a student (or\r\nif a student is directly using their own authentication service), ClassDojo will not\r\nrequest more information from the authentication service than name and email\r\naddress unless specifically requested or chosen to be passed by the teacher or\r\nschool to ClassDojo</p>\r\n\r\n<p>Third-party Services</p>\r\n<p>The Service or the ClassDojo Website may contain links to websites and services\r\nprovided by third-parties (e.g., video players). Any personal information you\r\nprovide on third-party websites or services is provided directly to that third-party\r\nand is subject to that third-party\'s policies governing privacy and security. This\r\nPrivacy Policy does not apply to these websites or services. The fact that we link\r\nto a website is not an endorsement, authorization or representation that we are\r\naffiliated with that third-party, nor is it an endorsement of their privacy or\r\ninformation security policies or practices. These other websites may place their\r\nown cookies or other files on your computer, collect data or solicit personal\r\ninformation from you, including if you view a video through an embedded video\r\nplayer which is played off our Service, but may appear to still be playing on our\r\nService. We are not responsible for the content or privacy and security practices\r\nand policies of third-party websites or services. We encourage you to learn about\r\nthird-parties\' privacy and security policies before providing them with personal\r\ninformation.</p>\r\n\r\n<p>Basically, <br />\r\nLinks to other websites and services as well as embedded video\r\nplayers may be found within the Service — this Privacy Policy does\r\nnot apply to those.</p>\r\n\r\n<p><strong>How will ClassDojo notify me of changes to this policy?</strong></p>\r\n<p>We may occasionally update this Privacy Policy - you can see when the last\r\nupdate was by looking at the \"Last Updated\" date at the top of this page. We\r\nwon\'t reduce your rights under this Privacy Policy without your explicit consent. If \r\nwe make any significant changes, we\'ll provide prominent notice by posting a\r\nnotice on the Service and/or notifying you by email (using the email address you\r\nprovided), so you can review and make sure you know about them.\r\nIn addition, if we ever make significant changes to the types of personal\r\ninformation we collect from children, or how we use it, we will notify parents in\r\norder to obtain parental consent or notice for those new practices and provide\r\nschools with the necessary information about these changes where they have\r\nobtained parental consent (or acted as the agent of the parent and provided\r\nconsent on their behalf).</p>\r\n\r\n<p>We encourage you to review this Privacy Policy from time to time, to stay informed\r\nabout our collection, use, and disclosure of personal information through the\r\nService. If you don\'t agree with any changes to the Privacy Policy, you may\r\nterminate your account (although we\'ll be sad to see you go!). By continuing to\r\nuse the Service after the revised Privacy Policy has become effective, you\r\nacknowledge that you accept and agree to the current version of the Privacy\r\nPolicy.</p>\r\n\r\n<p>Basically, <br />\r\nWe will let you know by email and/or on our website when we make\r\nsignificant changes to our Privacy Policy. If we make significant\r\nchanges to the types of personal information we collect from\r\nchildren, or how we use it, we will notify parents, or ask for their\r\nconsent and provide schools with the necessary information about\r\nthese changes where they have obtained parental consent (or acted\r\nas the agent of the parent and consent on their behalf).</p>\r\n\r\n<p><strong>Is ClassDojo a Controller?</strong></p>\r\n<p>ClassDojo processes personal information both as a Processor and as a Controller,\r\nas defined in the GDPR:\r\nWhen teachers, school leaders, and parents enter information directly into our\r\nService, ClassDojo will generally be the Controller for the user data, as outlined\r\nabove in \"What information does ClassDojo collect?\" section. However, in\r\ncertain circumstances, where requested by the student\'s school, ClassDojo will be\r\nthe Processor, and will only delete records per the school\'s specific instructions\r\nand will request that you make any requests for access, correction or deletion of\r\npersonal information through the school. ClassDojo will respond to such requests\r\nwhen received from the school. Please see ClassDojo\'s policy on data retention\r\nand deletion.</p>\r\n\r\n<p>What if I\'m not in the U.S.?</p>\r\n<p>ClassDojo is hosted and operated in the United States. If you use the Service or\r\nthe ClassDojo Website from the European Union, or any other region with laws\r\ngoverning data collection, protection and use that may differ from United States \r\nlaw, please note that you may be transferring your personal information outside of\r\nthose jurisdictions to the United States. Where we transfer, store and process your\r\npersonal information outside of the European Union or EEA, we have ensured\r\nthat appropriate safeguards are in place to ensure an adequate level of protection\r\nfor the rights of data subjects based on the adequacy of the receiving country\'s\r\ndata protection laws, or EU-US and Swiss-US Privacy Shield principles.</p>\r\n\r\n<p>By using the Service, you consent to the transfer of your personal information\r\noutside your home jurisdiction, including to the United States, and to the storage\r\nof your personal information in the United States, for the purpose of hosting, using\r\nand processing the personal information in accordance with this Privacy Policy.\r\nYou further acknowledge that these countries may not have the same data\r\nprotection laws as the country from which you provided your personal information,\r\nand that ClassDojo may be compelled to disclose your personal information to U.S.\r\nauthorities. You have the right to withdraw your consent at any time by contacting\r\nus as described in the \"Contacting ClassDojo\" section below.</p>\r\n\r\n<p>Basically, <br />\r\nOur servers are located in the U.S., so if you are using the Service\r\nfrom any other country, your data might be transferred to the U.S.</p>\r\n\r\n<p><strong>EU – U.S. Privacy Shield and Swiss – U.S. Privacy Shield</strong></p>\r\n<p>ClassDojo complies with the EU – U.S. Privacy Shield Framework and Swiss – U.S.\r\nPrivacy Shield Framework as set forth by the U.S. Department of Commerce\r\nregarding the collection, use, and retention of personal information transferred\r\nfrom the European Union and Switzerland to the United States. ClassDojo certified\r\nto the Department of Commerce that it adheres to the Privacy Shield Principles. To\r\nlearn more about the Privacy Shield program, and to view our certification, please\r\nvisit https://www.privacyshield.gov/.</p>\r\n<p>ClassDojo is responsible for the processing of personal information it receives,\r\nunder the Privacy Shield Frameworks, and subsequently transfers to third-parties\r\nacting as an agent on its behalf. ClassDojo complies with the Privacy Shield\r\nPrinciples for all onward transfers of personal information from the EU and\r\nSwitzerland, including the onward transfer liability provisions.</p>\r\n<p>With respect to personal data received or transferred pursuant to the Privacy\r\nShield Frameworks, ClassDojo is subject to the regulatory enforcement powers of\r\nthe U.S. Federal Trade Commission and other authorized statutory bodies. In\r\ncertain situations, ClassDojo may be required to disclose personal data in\r\nresponse to lawful requests by public authorities, including to meet national\r\nsecurity or law enforcement requirements.</p>\r\n<p>If you have an unresolved privacy or data use concern, please contact our U.S.-\r\nbased third-party dispute resolution provider, free of charge here.\r\nUnder certain conditions, more fully described on the Privacy Shield website,\r\nyou may invoke binding arbitration when other dispute resolution procedures have\r\nbeen exhausted.</p>\r\n<p>Basically, <br />\r\nClassDojo is certified as an approved company under the EU – U.S.\r\nPrivacy Shield and Swiss — U.S. Privacy Shield.</p>\r\n\r\n<p><strong>Canada</strong></p>\r\n<p>We endeavor to provide privacy protection that is consistent with Canada\'s private\r\nsector privacy laws, including the Personal Information Protection and Electronic\r\nDocuments Act (\"PIPEDA\"). For any questions regarding how we comply with\r\nPIPEDA, please contact us at privacy@classdojo.com.</p>\r\n<p>Basically, <br />\r\nClassDojo works hard to provide privacy protections consistent\r\nwith PIPEDA in Canada.</p>\r\n\r\n<p><strong>California Privacy Disclosures</strong></p>\r\n<p>Do Not Track: Currently, various browsers offer a \"do not track\" or \"DNT\" option\r\nthat relies on a technology known as a DNT header, which sends a signal to Web\r\nsites visited by the user about the user\'s browser DNT preference setting. </p>\r\n<p>ClassDojo does not track its users over time and across third-party websites to\r\nprovide behaviorally-targeted advertising and therefore does not respond to Do\r\nNot Track (DNT) signals. For more information on \"do not track\", please visit\r\nwww.allaboutdnt.org.</p>\r\n<p>Third-parties that have content embedded on the ClassDojo Website, such as a\r\nsocial feature, or an embedded video player, may set cookies on a user\'s browser\r\nand/or obtain information about the fact that a web browser visited a the\r\nClassDojo Website from a certain IP address. Third-parties cannot collect any\r\nother personally identifiable information from ClassDojo\'s websites unless you\r\nprovide it to them directly.</p>\r\n<p>Basically, <br />\r\nWe do not track our users over time across third-party websites to\r\nprovide behaviorally-targeted advertising and thus do not respond\r\nto Do Not Track signals.</p>\r\n<p>Notice for Minors (users under 18)</p>\r\n\r\n<p>If you are under the age of 18, or the parent of a child using ClassDojo under the\r\nage of 18 residing in California, you are entitled to request removal of content or\r\ninformation you (the minor) have publicly posted on our Service. Currently, we do\r\nnot allow minors to post content to share publicly, but we do still allow minors (or\r\nthe minor\'s parents if under 13) the option to delete personal information\r\nassociated with their user accounts or content that they upload through their\r\nstudent account (which is not shared publicly (only the student\'s parents,\r\nteachers, or school leaders can view). If you are a minor, or the parent of a minor\r\nunder 13, and would like to delete personal information associated with your \r\naccount or content you uploaded through your account, please follow the\r\ndirections set forth in the \"ClassDojo\'s commitments to providing\r\nTransparency and Your Rights\" section, which may include the need to contact\r\nyour school first. Although we offer deletion capabilities on our Service, you\r\nshould be aware that the removal of content may not ensure complete or\r\ncomprehensive removal of that content or information posted through the Service,\r\nas there may be de-identified or recoverable elements of your content or\r\ninformation on our servers in some form. Additionally, we will not remove content\r\nor information that we may be required to retain at the direction of the school or\r\nunder applicable laws.</p>\r\n\r\n<p>Basically, <br />\r\nIf you are a minor or parent of a minor, you may delete information\r\nper the \"How can I delete my account?\" section.</p>\r\n\r\n<p>How can I contact ClassDojo with questions?</p>\r\n<p>If you have any questions or concerns about this Privacy Policy or how we protect\r\nour community, please contact us at privacy@classdojo.com - we\'d love to help.\r\nIf you\'d like, you may also write to us at:</p>\r\n<p>ClassDojo, Inc. 735 Tehama Street San Francisco, CA 94103 650-503-3656\r\nAttention: Chief Privacy Officer</p>\r\n<p>Basically, <br />\r\nQuestions? We\'re here to help! Email us any time at privacy@classdojo.com</p>\r\n\r\n<p><strong>Further Privacy and Security Resources</strong></p>\r\n\r\n<p>For teachers, school leaders, parents, students, or administrators seeking more\r\ninformation on how we provide safety on ClassDojo, we provide privacy and\r\nsecurity related materials on our Privacy Center</p>\r\n<p>For Key Terms that are used in this Privacy Policy and our Terms of Service, please\r\nvisit this Key Terms FAQ.</p>\r\n<p>For our Online Tracking Technologies Policy, please see here.</p>\r\n<p>For our short video for students that highlights the most important details in our\r\nPrivacy Policy that they should know about, please see here</p>\r\n<p>For our chart that details the personal information we collect, how we use it, and\r\nwhere it is stored, please see here.</p>\r\n<p>Basically,\r\nIf you\'d like some more safety and privacy resources for your\r\nschool, please visit our Privacy Center. For definitions of Key Terms\r\nused in this policy and our Terms of Service, visit here.</p>\r\n\r\n</div>\r\n</div>', NULL, '2019-09-20 07:00:00', '2019-10-25 20:50:31');

-- --------------------------------------------------------

--
-- Table structure for table `ka_configuration`
--

CREATE TABLE `ka_configuration` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_type` int(11) DEFAULT NULL COMMENT '1 => General 2 => Mailjet, 3 => social',
  `user_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_configuration`
--

INSERT INTO `ka_configuration` (`id`, `key`, `value`, `label`, `group_type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'default_per_page_record', '10', 'Default Per Page Record', 1, 1, '2019-07-11 08:57:55', '2020-01-07 08:59:11'),
(2, 'copyright', 'Kidrend', 'Copyright', 1, 1, '2019-07-11 08:57:56', '2019-07-11 08:57:56'),
(3, 'mail_jet_public_api_key', 'aede1782365993ea5504d643cc37b5f0', 'Mailjet public api key', 2, 1, '2019-07-11 08:57:56', '2019-12-13 19:42:28'),
(4, 'mail_jet_private_api_key', '45c8d149f63378ac7aa2c9c6715b44be', 'Mailjet private api key', 2, 1, '2019-07-11 08:57:56', '2019-12-13 19:42:28'),
(5, 'mail_jet_email', 'cwiser904@gmail.com', 'Mailjet email', 2, 1, '2019-07-11 08:57:56', '2019-12-13 19:42:28'),
(6, 'admin_email', 'cwiserdeveloper@gmail.com', 'Admin email', 1, 1, '2019-07-11 08:57:56', '2019-07-11 08:57:56'),
(7, 'facebook_url', 'https://www.facebook.com/kidrend/', 'Facebook url', 3, 1, '2019-07-11 08:57:56', '2019-07-11 08:57:56'),
(8, 'phone', NULL, 'Phone number', 1, 1, '2019-07-11 08:57:56', '2019-12-12 06:21:30'),
(9, 'twitter_url', 'https://www.twitter.com/kidrend/', 'Twitter url', 3, 1, '2019-08-19 20:13:03', '2019-08-19 20:13:03'),
(10, 'linkedin_url', 'https://www.linkedin.com/kidrend/', 'Linkedin url', 3, 1, '2019-08-19 20:13:03', '2019-08-19 20:13:03'),
(11, 'app_server_key', 'AAAA2Lij_Hg:APA91bGvX73VVXSIIlnKkKOV3af93g7K2SDLhSWkTiouqLDcgZGSf_r11C0Avqo8wOLI4oNJWFkcqKgrQYHJp784172ZXqJCkELN1bp_PESeJixgcujZTzsckN3nM4Z-M0WiW75aGydY', 'App server key', NULL, 1, '2019-10-18 21:00:55', '2019-10-18 21:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `ka_country`
--

CREATE TABLE `ka_country` (
  `country_id` int(10) UNSIGNED NOT NULL,
  `country_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_country`
--

INSERT INTO `ka_country` (`country_id`, `country_name`, `created_at`, `updated_at`) VALUES
(1, 'Nigeria', '2019-07-29 01:30:00', '2019-07-29 01:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `ka_email_template`
--

CREATE TABLE `ka_email_template` (
  `email_template_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template_fields` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_email_template`
--

INSERT INTO `ka_email_template` (`email_template_id`, `subject`, `entity`, `template_name`, `template_content`, `template_fields`, `created_at`, `updated_at`) VALUES
(1, 'Student Registration', 'student_register', 'Student Registration', 'Hi <strong>%name%</strong>,\r\n\r\nYou have successfully signed up with Kidrend. Below are your account details:\r\n\r\n<b>Names:</b> %name%\r\n<b>Email:</b> %email%\r\nTo get started, login with the details below\r\n<b>Username:</b> <a href=\"mailto:%email%\">%email%</a>\r\n<b>Password:</b>%password%\r\n\r\nIf you have any questions or comments please feel free to contact us at support@kidrend.com our support team will respond to your inquiry promptly.', 'name,loginUrl,email,password', '2019-07-10 18:30:00', '2019-08-16 14:58:47'),
(2, 'Teacher Registration', 'teacher_register', 'Teacher Registration', 'Hi <strong>%name%</strong>,\r\n\r\nYou have successfully signed up with Kidrend. Below are your account details:\r\n\r\n<b>Names:</b> %name%\r\n<b>Email:</b> %email%\r\nTo get started, login with the details below\r\n<b>Login page:</b> <a href=\"%loginUrl%\">Teacher Login</a>\r\n<b>Username:</b> <a href=\"mailto:%email%\">%email%</a>\r\n<b>Password:</b>%password%\r\n\r\nIf you have any questions or comments please feel free to contact us at support@kidrend.com our support team will respond to your inquiry promptly.', 'name,loginUrl,email,password', '2019-07-10 18:30:00', '2019-08-16 14:58:55'),
(3, 'Parent Registration', 'parent_register', 'Parent Registration', 'Hi <strong>%name%</strong>,\r\n\r\nYou have successfully signed up with Kidrend. Below are your account details:\r\n\r\n<b>Names:</b> %name%\r\n<b>Email:</b> %email%\r\nTo get started, login with the details below\r\n<b>Username:</b> <a href=\"mailto:%email%\">%email%</a>\r\n<b>Password:</b>%password%\r\n\r\nIf you have any questions or comments please feel free to contact us at support@kidrend.com our support team will respond to your inquiry promptly.', 'name,email,password', '2019-07-10 18:30:00', '2019-08-16 14:59:03'),
(4, 'School Registration', 'school_register', 'School Registration', 'Hi <strong>%name%</strong>,\r\n\r\nYou have successfully signed up with Kidrend. Below are your account details:\r\n\r\n<b>Names:</b> %name%\r\n<b>Email:</b> %email%\r\nTo get started, login with the details below\r\n<b>Login page:</b> <a href=\"%loginUrl%\">School Login</a>\r\n<b>Username:</b> <a href=\"mailto:%email%\">%email%</a>\r\n<b>Password:</b>%password%\r\n\r\nIf you have any questions or comments please feel free to contact us at support@kidrend.com our support team will respond to your inquiry promptly.', 'name,loginUrl,email,password', '2019-07-10 20:00:00', '2019-08-16 14:57:01'),
(5, 'School Password change', 'school_password_change', 'School Password Change', 'Hi <strong>%name%</strong>,\r\n\r\nYou have successfully password changed with Kidrend. Below are your account details:\r\n\r\n<b>Names:</b> %name%\r\n<b>Email:</b> %email%\r\nTo get started, login with the details below\r\n<b>Login page:</b> <a href=\"%loginUrl%\">School Login</a>\r\n<b>Username:</b> <a href=\"mailto:%email%\">%email%</a>\r\n<b>Password:</b>%password%\r\n\r\nIf you have any questions or comments please feel free to contact us at support@kidrend.com our support team will respond to your inquiry promptly.', 'name,loginUrl,email,password', '2019-07-10 20:00:00', '2019-08-16 14:57:09'),
(6, 'Parent Password change', 'parent_password_change', 'Parent Password Change', 'Hi <strong>%name%</strong>,\r\n\r\nYou have successfully password changed with Kidrend. Below are your account details:\r\n\r\n<b>Names:</b> %name%\r\n<b>Email:</b> %email%\r\nTo get started, login with the details below\r\n<b>Login page:</b> <a href=\"%loginUrl%\">Parent Login</a>\r\n<b>Username:</b> <a href=\"mailto:%email%\">%email%</a>\r\n<b>Password:</b>%password%\r\n\r\nIf you have any questions or comments please feel free to contact us at support@kidrend.com our support team will respond to your inquiry promptly.', 'name,loginUrl,email,password', '2019-07-10 20:00:00', '2019-08-16 14:57:34'),
(7, 'Student Password change', 'student_password_change', 'Student Password Change', 'Hi <strong>%name%</strong>,\r\n\r\nYou have successfully password changed with Kidrend. Below are your account details:\r\n\r\n<b>Names:</b> %name%\r\n<b>Email:</b> %email%\r\nTo get started, login with the details below\r\n<b>Login page:</b> <a href=\"%loginUrl%\">Student Login</a>\r\n<b>Username:</b> <a href=\"mailto:%email%\">%email%</a>\r\n<b>Password:</b>%password%\r\n\r\nIf you have any questions or comments please feel free to contact us at support@kidrend.com our support team will respond to your inquiry promptly.', 'name,loginUrl,email,password', '2019-07-10 20:00:00', '2019-08-16 14:57:41'),
(8, 'Teacher Password change', 'teacher_password_change', 'Teacher Password Change', 'Hi <strong>%name%</strong>,\r\n\r\nYou have successfully password changed with Kidrend. Below are your account details:\r\n\r\n<b>Names:</b> %name%\r\n<b>Email:</b> %email%\r\nTo get started, login with the details below\r\n<b>Login page:</b> <a href=\"%loginUrl%\">Teacher Login</a>\r\n<b>Username:</b> <a href=\"mailto:%email%\">%email%</a>\r\n<b>Password:</b>%password%\r\n\r\nIf you have any questions or comments please feel free to contact us at support@kidrend.com our support team will respond to your inquiry promptly.', 'name,loginUrl,email,password', '2019-07-10 20:00:00', '2019-08-16 14:58:39'),
(9, 'PTA Registration', 'pta_register', 'PTA Registration', 'Hi <strong>%name%</strong>,\r\n\r\nYou have successfully signed up with Kidrend. Below are your account details:\r\n\r\n<b>Names:</b> %name%\r\n<b>Email:</b> %email%\r\nTo get started, login with the details below\r\n<b>Login page:</b> <a href=\"%loginUrl%\">PTA Login</a>\r\n<b>Username:</b> <a href=\"mailto:%email%\">%email%</a>\r\n<b>Password:</b>%password%\r\n\r\nIf you have any questions or comments please feel free to contact us at support@kidrend.com our support team will respond to your inquiry promptly.', 'name,loginUrl,email,password', '2019-12-10 07:00:00', '2019-12-10 07:00:00'),
(10, 'Message from', 'support', 'Support', 'Hi <strong>Admin</strong>,\r\n\r\n<strong>Below is a message from %user_name% sent via the App:</strong>\r\n\r\n%message%\r\n\r\nIf you have any questions or comments please feel free to contact us at support@kidrend.com our support team will respond to your inquiry promptly.', 'user_name,message', '2019-12-10 07:00:00', '2019-12-10 07:00:00'),
(11, 'We have a new user', 'user_register_admin', 'User Register Admin', 'Hi <strong>Admin</strong>,\r\n\r\n<strong>We have a new user. Please see their account details below:</strong>\r\n\r\n<b>Names:</b> %user_name%\r\n<b>Email:</b> <a href=\"mailto:%user_email%\">%user_email%</a>\r\n<b>Sign up type:</b> App<br/>\r\n<b>Signed up on:</b> %signup_date%<br/>\r\n\r\nIf you have any questions or comments please feel free to contact us at support@kidrend.com our support team will respond to your inquiry promptly.', 'user_name,user_email,signup_date', '2019-12-10 07:00:00', '2019-12-10 07:00:00'),
(12, 'PTA Password change', 'pta_password_change', 'PTA Password Change', 'Hi <strong>%name%</strong>,\r\n\r\nYou have successfully password changed with Kidrend. Below are your account details:\r\n\r\n<b>Names:</b> %name%\r\n<b>Email:</b> %email%\r\nTo get started, login with the details below\r\n<b>Login page:</b> <a href=\"%loginUrl%\">Teacher Login</a>\r\n<b>Username:</b> <a href=\"mailto:%email%\">%email%</a>\r\n<b>Password:</b>%password%\r\n\r\nIf you have any questions or comments please feel free to contact us at support@kidrend.com our support team will respond to your inquiry promptly.', 'name,loginUrl,email,password', '2019-12-10 07:00:00', '2019-12-10 07:00:00'),
(13, 'Pick-up/Drop-off details', 'pick-up_drop-off_details', 'Pick-up/Drop-off details', 'Hi <strong>%user_name%</strong>,\r\n\r\nPlease find pickup code:\r\n\r\n<b>Student name:</b> %student_name%\r\n<b>Previous person name:</b> %previous_person_name%\r\n<b>Pickup code:</b> %pickup_code%\r\n\r\nIf you have any questions or comments please feel free to contact us at support@kidrend.com our support team will respond to your inquiry promptly.', 'user_name,student_name,previous_person_name,pickup_code', '2019-12-10 07:00:00', '2019-12-10 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ka_events`
--

CREATE TABLE `ka_events` (
  `event_id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL COMMENT '1 => By Principal, 2 => Person of Month, 3=> Theme of Month, 4=>Club notice, 5=> Class Notice, 6=> Birthday notices',
  `is_all` int(11) DEFAULT NULL COMMENT '1 => All, 0 => Specific User',
  `created_user_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'Birthday notices',
  `class_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Class Notice',
  `club_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Club notice',
  `school_id` int(10) UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_events`
--

INSERT INTO `ka_events` (`event_id`, `description`, `event_title`, `event_type`, `is_all`, `created_user_id`, `user_id`, `class_id`, `club_id`, `school_id`, `start_date`, `start_time`, `end_date`, `end_time`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'Jessica Morris', 'july - 2019', 2, 1, 16, 0, NULL, NULL, 16, '2019-08-01', '17:30:00', '2019-08-02', '17:30:00', NULL, '2019-08-02 19:59:52', '2019-08-02 19:59:52'),
(2, 'dfdf', 'THeme', 3, 1, 16, 0, NULL, NULL, 16, '2019-08-01', '18:38:00', '2019-08-03', '19:39:00', NULL, '2019-08-02 20:08:34', '2019-08-02 20:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `ka_event_and_notification`
--

CREATE TABLE `ka_event_and_notification` (
  `event_and_notification_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Created by',
  `status` int(11) DEFAULT NULL COMMENT '1 = Active, 0 = Inactive',
  `created_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Web, App',
  `notification_type` int(11) DEFAULT NULL COMMENT '1 = Principal’s notice, 2 = Class notice, 3 = Theme of the month, 4 = Clubs notice, 5 = Person of the month (Student, teacher or parent), 6 = P.T.A. notice',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_event_and_notification`
--

INSERT INTO `ka_event_and_notification` (`event_and_notification_id`, `title`, `event_date`, `start_time`, `end_time`, `photo`, `description`, `sender_id`, `status`, `created_type`, `notification_type`, `created_at`, `updated_at`) VALUES
(1, 'Testing event', '2019-10-30', '10:17:00', '12:17:00', 'images/event_and_notification/lighthouse_1569394107141855722.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 1, 1, 'Web', 3, '2019-09-25 14:48:27', '2019-09-25 14:48:27'),
(2, 'Testing notification', '2019-10-30', '10:23:00', '12:23:00', 'images/event_and_notification/penguins_1569394418292188557.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 1, 1, 'Web', 4, '2019-09-25 14:53:38', '2019-09-25 14:53:38'),
(3, 'Soccer Club Trials', '2019-11-28', '10:17:00', '12:17:00', 'images/event_and_notification/events_1.jpg', 'It\'s that time of the year again', 1, 1, 'Web', 3, '2019-09-30 07:00:00', '2019-10-21 18:23:19'),
(4, 'Spring - 2019', '2019-12-04', '10:17:00', '12:17:00', 'images/event_and_notification/events_2.jpg', 'Lets meet at holistic world', 1, 1, 'Web', 3, '2019-09-30 07:00:00', '0000-00-00 00:00:00'),
(5, 'Winter - 2020', '2020-01-12', '10:17:00', '12:17:00', 'images/event_and_notification/events.jpg', 'World view of disscuss', 1, 1, 'Web', 3, '2019-09-30 07:00:00', '0000-00-00 00:00:00'),
(6, 'Summer - 2020', '2020-03-12', '10:17:00', '12:17:00', 'images/event_and_notification/events_1.jpg', 'World view of disscuss,We\'ve got bright ideas for all kinds of events', 1, 1, 'Web', 3, '2019-09-30 07:00:00', '0000-00-00 00:00:00'),
(7, 'Immuanuel gbadebo', '2019-10-10', '10:23:00', '00:00:00', '', 'Let us have a 20 minute staff meeting ', 1, 1, 'Web', 2, '2019-09-25 14:53:38', '2019-09-25 14:53:38'),
(8, 'Elizabeth', '2019-10-14', '10:23:00', '00:00:00', '', 'Ademola charllies uncle, tall light skinned man ', 1, 1, 'Web', 3, '2019-09-25 14:53:38', '2019-09-25 14:53:38'),
(9, 'Study Discussion', '2019-11-20', '10:23:00', '00:00:00', '', 'Lets have a discussion with all students', 1, 1, 'Web', 2, '2019-09-25 14:53:38', '2019-09-25 14:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `ka_exam`
--

CREATE TABLE `ka_exam` (
  `exam_id` int(10) UNSIGNED NOT NULL,
  `exam_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user_id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `exam_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_exam`
--

INSERT INTO `ka_exam` (`exam_id`, `exam_name`, `created_user_id`, `school_id`, `exam_date`, `created_at`, `updated_at`) VALUES
(1, '2019, Term 1 - Midterms', 1, 23, '2019-07-11', '2019-07-11 07:00:00', '2019-07-11 11:00:00'),
(2, '2019, Term 1 - Midterms', 16, 16, '2019-07-11', '2019-07-11 19:26:24', '2020-01-20 05:21:24'),
(3, 'Mid Term Exam 2019', 1, 33, '2019-07-25', '2019-07-25 18:42:07', '2019-07-25 18:51:39'),
(4, 'Mid Term. Sept 2019', 1, 147, '2019-10-16', '2019-10-16 23:19:37', '2019-10-16 23:20:12'),
(5, 'Finals', 16, 16, '2019-12-24', '2019-12-12 06:35:56', '2020-01-10 04:16:39');

-- --------------------------------------------------------

--
-- Table structure for table `ka_exam_result`
--

CREATE TABLE `ka_exam_result` (
  `exam_result_id` int(10) UNSIGNED NOT NULL,
  `exam_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `created_user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_exam_result`
--

INSERT INTO `ka_exam_result` (`exam_result_id`, `exam_id`, `user_id`, `subject`, `percent`, `exam_date`, `created_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 26, 'Math', '56', '2019-07-31', 1, '2019-07-11 18:08:16', '2019-07-11 18:08:16'),
(2, 1, 26, 'English', '96', '2019-07-31', 1, '2019-07-11 18:08:16', '2019-07-11 18:08:16'),
(4, 1, 26, 'Geography', '69', '2019-07-31', 1, '2019-07-11 18:09:23', '2019-07-11 18:09:23'),
(5, 1, 26, 'science', '59', '2019-07-31', 1, '2019-07-11 18:19:25', '2019-07-11 18:19:25'),
(6, 2, 112, 'Maths', '10', '2019-09-05', 16, '2019-09-04 19:42:31', '2019-09-04 19:42:31'),
(7, 2, 112, 'science', '20', '2019-09-05', 16, '2019-09-04 19:42:31', '2019-09-04 19:42:31'),
(8, 2, 112, 'English', '55', '2019-09-05', 16, '2019-09-04 19:42:31', '2019-09-04 19:42:31'),
(9, 2, 112, 'History', '75', '2019-09-05', 16, '2019-09-04 19:42:31', '2019-09-04 19:42:31'),
(10, 2, 112, 'History', '70', '2019-09-06', 16, '2019-09-05 14:11:31', '2019-09-05 14:11:31'),
(11, 2, 112, 'Math', '75', '2019-09-06', 16, '2019-09-05 14:11:31', '2019-09-05 14:11:31'),
(12, 2, 112, 'English', '65', '2019-09-06', 16, '2019-09-05 14:11:31', '2019-09-05 14:11:31'),
(13, 2, 112, 'Science', '80', '2019-09-06', 16, '2019-09-05 14:11:31', '2019-09-05 14:11:31'),
(14, 2, 112, 'Science', '75', '2019-09-07', 16, '2019-09-05 14:28:09', '2019-09-05 14:28:09'),
(15, 2, 112, 'History', '80', '2019-09-07', 16, '2019-09-05 14:28:09', '2019-09-05 14:28:09'),
(16, 2, 112, 'History', '80', '2019-09-08', 16, '2019-09-05 14:29:57', '2019-09-05 14:29:57'),
(17, 2, 112, 'Science', '75', '2019-09-08', 16, '2019-09-05 14:29:57', '2019-09-05 14:29:57'),
(18, 2, 112, 'Maths', '85', '2019-09-08', 16, '2019-09-05 14:29:57', '2019-09-05 14:29:57'),
(19, 2, 112, 'Hindi', '82', '2019-09-08', 16, '2019-09-05 14:29:57', '2019-09-05 14:29:57'),
(20, 2, 112, 'English', '74', '2019-09-08', 16, '2019-09-05 14:29:57', '2019-09-05 14:29:57'),
(21, 2, 112, 'Physics', '86', '2019-09-08', 16, '2019-09-05 14:29:57', '2019-09-05 14:29:57'),
(22, 2, 124, 'English', '70', '2019-10-02', 17, '2019-10-17 12:53:06', '2019-10-17 12:53:06'),
(23, 2, 124, 'Maths', '90', '2019-10-02', 17, '2019-10-17 12:53:06', '2019-10-17 12:53:06'),
(24, 2, 123, 'English', '60', '2019-10-02', 17, '2019-10-17 13:09:41', '2019-10-17 13:09:41'),
(25, 2, 123, 'Maths', '77', '2019-10-02', 17, '2019-10-17 13:09:41', '2019-10-17 13:09:41'),
(26, 2, 38, 'English', '50', '2019-10-02', 17, '2019-10-17 13:14:12', '2019-10-17 13:14:12'),
(27, 2, 38, 'Hindi', '90', '2019-10-02', 17, '2019-10-17 13:14:12', '2019-10-17 13:14:12'),
(28, 2, 38, 'History', '60', '2019-10-02', 17, '2019-10-17 13:14:12', '2019-10-17 13:14:12'),
(29, 2, 38, 'Maths', '55', '2019-10-02', 17, '2019-10-17 13:14:12', '2019-10-17 13:14:12'),
(30, 2, 20, 'English', '50', '2019-10-02', 17, '2019-10-17 13:17:19', '2019-10-17 13:17:19'),
(31, 2, 20, 'History', '90', '2019-10-02', 17, '2019-10-17 13:17:19', '2019-10-17 13:17:19'),
(32, 2, 20, 'Maths', '80', '2019-10-02', 17, '2019-10-17 13:17:19', '2019-10-17 13:17:19'),
(33, 2, 20, 'Physics', '77', '2019-10-02', 17, '2019-10-17 13:17:19', '2019-10-17 13:17:19'),
(34, 2, 19, 'English', '50', '2019-10-02', 17, '2019-10-17 13:19:14', '2019-10-17 13:19:14'),
(35, 2, 19, 'History', '56', '2019-10-02', 17, '2019-10-17 13:19:14', '2019-10-17 13:19:14'),
(36, 2, 19, 'Maths', '95', '2019-10-02', 17, '2019-10-17 13:19:14', '2019-10-17 13:19:14'),
(37, 2, 19, 'Physics', '60', '2019-10-02', 17, '2019-10-17 13:19:14', '2019-10-17 13:19:14'),
(38, 2, 107, 'English', '80', '2019-10-17', 17, '2019-10-17 13:24:36', '2019-10-17 13:24:36'),
(39, 2, 107, 'History', '81', '2019-10-17', 17, '2019-10-17 13:24:36', '2019-10-17 13:24:36'),
(40, 2, 107, 'Physics', '86', '2019-10-17', 17, '2019-10-17 13:24:36', '2019-10-17 13:24:36'),
(41, 2, 107, 'Science', '75', '2019-10-17', 17, '2019-10-17 13:24:36', '2019-10-17 13:24:36'),
(42, 2, 164, 'English', '75', '2019-11-22', 1, '2019-11-22 00:08:23', '2019-11-22 00:08:23'),
(43, 2, 164, 'Maths', '82', '2019-11-22', 1, '2019-11-22 00:08:23', '2019-11-22 00:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `ka_grade`
--

CREATE TABLE `ka_grade` (
  `grade_id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `grade_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_grade`
--

INSERT INTO `ka_grade` (`grade_id`, `school_id`, `grade_name`, `created_at`, `updated_at`) VALUES
(8, 16, 'Grade 1', '2019-07-05 19:37:57', '2019-07-05 19:37:57'),
(9, 16, 'Grade 2', '2019-07-05 19:38:05', '2019-07-05 19:38:05'),
(10, 23, 'Grade 1', '2019-07-11 17:37:47', '2019-07-11 17:37:47'),
(11, 23, 'Grade2', '2019-07-11 17:39:55', '2019-07-11 17:39:55'),
(12, 28, 'Grade 1', '2019-07-12 19:55:21', '2019-07-12 19:55:21'),
(13, 28, 'Grade 2', '2019-07-12 19:55:28', '2019-07-12 19:55:28'),
(15, 33, 'Creche', '2019-07-25 17:57:50', '2019-07-25 17:57:50'),
(16, 33, 'Pre K', '2019-07-25 17:59:24', '2019-07-25 17:59:24'),
(17, 33, 'kindergarten', '2019-07-25 18:03:13', '2019-07-25 18:03:13'),
(18, 33, 'Primary School', '2019-07-25 18:03:57', '2019-07-25 18:03:57'),
(19, 33, 'After School', '2019-07-25 18:04:12', '2019-07-25 18:04:12'),
(20, 147, 'Primary 2', '2019-10-09 00:57:42', '2019-11-10 07:27:15'),
(22, 16, 'Grade 3', '2019-10-11 14:25:04', '2019-10-11 14:25:04'),
(23, 147, 'Primary 3', '2019-11-10 07:28:54', '2019-11-10 07:28:54'),
(24, 147, 'Primary 1', '2019-11-10 07:29:06', '2019-11-10 07:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `ka_homework`
--

CREATE TABLE `ka_homework` (
  `homework_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED DEFAULT NULL,
  `created_user_id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homework_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ka_message`
--

CREATE TABLE `ka_message` (
  `message_id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1 =>Unread, 2 => Read',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_message`
--

INSERT INTO `ka_message` (`message_id`, `sender_id`, `receiver_id`, `message`, `attachment`, `status`, `created_at`, `updated_at`) VALUES
(17, 16, 17, 'Meeting tomorrow', NULL, 1, '2019-08-02 19:53:07', '2019-08-02 19:53:15'),
(18, 17, 16, 'I will join you', NULL, 1, '2019-08-02 19:53:25', '2019-08-02 19:53:37'),
(19, 16, 17, 'With nature discussion', 'images/message_attachment/smaland-rejseguide-aasnen-nationalpark-sverige-3_1564746849588559275.jpg', 1, '2019-08-02 19:54:09', '2019-08-02 19:54:17'),
(27, 16, 17, 'testt', 'images/message_attachment/2019091275245000000.docx', 1, '2019-09-12 07:52:45', NULL),
(28, 16, 121, 'testing only..', NULL, 1, '2019-09-20 14:17:02', '2019-10-08 16:27:50'),
(29, 121, 16, 'Hello new test', NULL, 2, '2019-10-04 05:17:00', '2019-11-04 20:43:10'),
(30, 121, 16, 'New test ios', NULL, 2, '2019-10-04 05:35:13', '2019-11-04 20:43:10'),
(31, 121, 16, 'iOS test', NULL, 2, '2019-10-04 06:59:09', '2019-11-04 20:43:10'),
(32, 121, 16, 'New testing', NULL, 2, '2019-10-04 07:11:29', '2019-11-04 20:43:10'),
(33, 16, 121, 'hello', NULL, 1, '2019-10-08 16:29:27', '2019-10-08 16:29:34'),
(34, 16, 121, 'hi', NULL, 1, '2019-10-08 16:36:03', '2019-10-08 16:49:59'),
(35, 121, 16, 'Hello', NULL, 2, '2019-10-09 11:10:01', '2019-11-04 20:43:10'),
(36, 16, 121, 'how are you today', NULL, 1, '2019-10-09 19:18:04', '2019-10-09 19:18:04'),
(37, 121, 16, 'M good', NULL, 2, '2019-10-09 11:18:38', '2019-11-04 20:43:10'),
(38, 121, 16, 'Fine', NULL, 2, '2019-10-09 11:20:41', '2019-11-04 20:43:10'),
(39, 16, 121, 'thats good', NULL, 1, '2019-10-09 19:21:54', '2019-10-09 19:21:54'),
(40, 16, 121, 'test text', 'images/message_attachment/70_15706224081524470040.jpg', 1, '2019-10-09 20:00:08', '2019-10-09 20:00:08'),
(41, 16, 121, NULL, 'images/message_attachment/30_1570624354729450996.jpg', 1, '2019-10-09 20:32:34', '2019-10-09 20:32:34'),
(42, 121, 16, '', 'images/message_attachment/20191009124355000000.docx', 2, '2019-10-09 12:43:55', '2019-11-04 20:43:10'),
(43, 121, 16, '', 'images/message_attachment/20191009124840000000.png', 2, '2019-10-09 12:48:40', '2019-11-04 20:43:10'),
(44, 121, 16, 'iOS image testing with text', 'images/message_attachment/20191009125250000000.png', 2, '2019-10-09 12:52:50', '2019-11-04 20:43:10'),
(45, 16, 143, 'hello Lucas', NULL, 1, '2019-10-12 12:37:06', '2019-10-12 12:37:06'),
(46, 143, 16, 'Hello', NULL, 1, '2019-10-12 04:37:37', '2019-10-15 19:09:47'),
(47, 143, 16, 'How are you?', NULL, 1, '2019-10-12 04:39:06', '2019-10-15 19:09:47'),
(48, 139, 143, 'how are you today.. ??', NULL, 1, '2019-10-12 12:40:54', '2019-10-12 12:40:54'),
(49, 143, 139, 'I am good you say about you', NULL, 1, '2019-10-12 04:41:59', '2019-10-12 12:42:24'),
(50, 125, 143, 'hi..\r\ngood morning', NULL, 1, '2019-10-12 12:43:40', '2019-10-12 12:43:40'),
(51, 139, 143, 'Why?', NULL, 1, '2019-10-13 22:25:00', NULL),
(52, 139, 143, 'How about this one ?', NULL, 1, '2019-10-13 22:25:40', NULL),
(53, 139, 143, 'How about this one ?', NULL, 1, '2019-10-13 22:26:19', NULL),
(54, 139, 143, 'How about this one ?', NULL, 1, '2019-10-13 22:26:37', NULL),
(55, 16, 139, 'hi. good morning', NULL, 1, '2019-10-14 14:40:46', '2019-10-14 14:40:46'),
(56, 139, 16, '', 'images/message_attachment/2019101471045000000.png', 1, '2019-10-14 07:10:45', '2019-10-15 21:07:38'),
(57, 143, 125, 'Hello', NULL, 1, '2019-10-15 11:07:24', NULL),
(58, 143, 125, '', 'images/message_attachment/20191015110809000000.png', 1, '2019-10-15 11:08:09', NULL),
(59, 143, 125, 'Gdfgdfgdfg', NULL, 1, '2019-10-15 11:08:42', NULL),
(60, 16, 143, 'hi', NULL, 1, '2019-10-15 19:09:52', '2019-10-15 19:09:52'),
(61, 143, 16, 'Hello', NULL, 1, '2019-10-15 11:10:24', '2019-10-15 19:18:45'),
(62, 16, 143, 'how are you today..??', NULL, 2, '2019-10-15 19:19:17', '2019-10-15 19:19:17'),
(63, 139, 16, '', 'images/message_attachment/2019101510606000000.png', 1, '2019-10-15 13:06:06', '2019-10-15 21:07:38'),
(64, 139, 16, 'Hi', NULL, 1, '2019-10-15 13:06:16', '2019-10-15 21:07:38'),
(65, 16, 139, 'hello', NULL, 1, '2019-10-15 21:07:47', '2019-10-15 21:07:47'),
(66, 139, 16, 'Hii', NULL, 1, '2019-10-15 13:13:37', '2019-11-04 20:19:27'),
(67, 139, 16, 'Hi', NULL, 1, '2019-10-15 13:19:10', '2019-11-04 20:19:27'),
(68, 121, 16, 'huh', NULL, 2, '2019-10-16 05:49:52', '2019-11-04 20:43:10'),
(69, 121, 16, 'hi', NULL, 2, '2019-10-16 05:56:05', '2019-11-04 20:43:10'),
(70, 121, 16, 'hello', NULL, 2, '2019-10-16 05:56:12', '2019-11-04 20:43:10'),
(71, 121, 16, 'hy testing', NULL, 2, '2019-10-16 05:57:19', '2019-11-04 20:43:10'),
(72, 17, 19, 'Hello jackson', NULL, 1, '2019-10-16 07:08:45', NULL),
(73, 121, 16, 'dub tun is', NULL, 2, '2019-10-16 07:15:56', '2019-11-04 20:43:10'),
(74, 17, 20, 'Hi', NULL, 1, '2019-10-16 07:16:21', NULL),
(75, 121, 16, '', 'images/message_attachment/2019101672111000000.png', 2, '2019-10-16 07:21:11', '2019-11-04 20:43:10'),
(76, 121, 16, 'hy', NULL, 2, '2019-10-16 07:34:19', '2019-11-04 20:43:10'),
(77, 121, 16, 'Hello', 'images/message_attachment/2019101673545000000.png', 2, '2019-10-16 07:35:45', '2019-11-04 20:43:10'),
(78, 16, 17, 'hi', NULL, 1, '2019-10-16 16:49:03', '2019-10-16 16:49:03'),
(79, 17, 19, 'Hello', NULL, 1, '2019-10-16 08:59:45', NULL),
(80, 121, 16, 'hey', 'images/message_attachment/2019101691511000000.png', 2, '2019-10-16 09:15:11', '2019-11-04 20:43:10'),
(81, 121, 16, '', 'images/message_attachment/2019101691546000000.png', 2, '2019-10-16 09:15:46', '2019-11-04 20:43:10'),
(82, 121, 16, 'can', NULL, 2, '2019-10-16 09:15:56', '2019-11-04 20:43:10'),
(83, 121, 16, 'cant', NULL, 2, '2019-10-16 09:16:00', '2019-11-04 20:43:10'),
(84, 121, 16, 'CCTV', NULL, 2, '2019-10-16 09:16:04', '2019-11-04 20:43:10'),
(85, 121, 16, 'hello ', NULL, 2, '2019-10-16 09:18:27', '2019-11-04 20:43:10'),
(86, 121, 16, '', 'images/message_attachment/2019101691848000000.png', 2, '2019-10-16 09:18:48', '2019-11-04 20:43:10'),
(87, 121, 16, '', 'images/message_attachment/2019101692031000000.png', 2, '2019-10-16 09:20:31', '2019-11-04 20:43:10'),
(92, 1, 20, 'this is developer testing', NULL, 1, '2019-10-16 19:20:37', '2019-10-16 19:20:37'),
(93, 1, 19, 'testt', NULL, 1, '2019-10-16 19:20:49', NULL),
(94, 1, 155, 'Hello, this about your child.', NULL, 1, '2019-10-16 23:22:24', '2019-10-16 23:22:24'),
(95, 125, 19, 'Hi', NULL, 1, '2019-10-17 13:45:38', NULL),
(96, 125, 143, 'hello', NULL, 2, '2019-10-17 13:48:54', NULL),
(97, 1, 33, 'This is for test', NULL, 1, '2019-10-17 14:28:55', '2019-10-17 14:28:55'),
(98, 17, 142, 'hy', NULL, 1, '2019-10-17 14:39:00', NULL),
(99, 143, 139, 'Hello', NULL, 1, '2019-10-17 18:47:12', NULL),
(100, 143, 139, '', 'images/message_attachment/20191017105333000000.png', 2, '2019-10-17 18:53:33', NULL),
(101, 16, 17, 'conversation', NULL, 1, '2019-10-17 19:29:24', NULL),
(102, 1, 20, 'just conversation', NULL, 1, '2019-10-17 19:49:59', NULL),
(103, 121, 16, 'hy', NULL, 2, '2019-10-17 20:02:54', '2019-11-04 20:43:10'),
(104, 1, 115, 'hrthdrtjhet', NULL, 1, '2019-10-18 04:30:44', '2019-10-18 04:30:44'),
(105, 16, 17, 'hi', NULL, 1, '2019-10-21 16:19:33', '2019-10-21 16:20:21'),
(106, 1, 33, 'sending to all', NULL, 1, '2019-10-21 20:32:01', '2019-10-21 20:32:01'),
(107, 1, 16, 'sending to all', NULL, 2, '2019-10-21 20:32:01', '2019-12-18 06:33:11'),
(108, 1, 147, 'sending to all', NULL, 1, '2019-10-21 20:32:01', '2019-10-21 20:32:01'),
(109, 1, 23, 'sending to all', NULL, 1, '2019-10-21 20:32:01', '2019-10-21 20:32:01'),
(110, 1, 28, 'sending to all', NULL, 1, '2019-10-21 20:32:01', '2019-10-21 20:32:01'),
(111, 17, 19, 'Jackson ', NULL, 2, '2019-10-22 20:09:29', NULL),
(112, 17, 142, 'How are you', NULL, 1, '2019-11-04 20:16:18', '2019-11-04 20:16:18'),
(113, 17, 20, 'Just testing', NULL, 1, '2019-11-04 20:16:42', '2019-11-04 20:16:42'),
(114, 17, 16, 'Are you there?', NULL, 1, '2019-11-04 20:17:27', '2019-11-04 20:17:27'),
(115, 17, 1, 'Hello', NULL, 2, '2019-11-04 20:18:12', '2019-12-18 06:23:30'),
(116, 1, 17, 'Hi', NULL, 2, '2019-11-04 20:18:41', '2019-12-18 06:33:45'),
(117, 16, 1, 'Hello', NULL, 2, '2019-11-04 20:20:31', '2019-12-12 06:18:51'),
(118, 16, 139, 'Hi', NULL, 2, '2019-11-04 20:20:43', '2019-11-04 20:20:43'),
(119, 121, 16, 'hello', NULL, 2, '2019-11-05 20:10:48', NULL),
(120, 139, 112, 'Hello', NULL, 2, '2019-12-02 11:21:39', NULL),
(121, 139, 112, 'Here is the photo ', 'images/message_attachment/2019120232225000000.png', 2, '2019-12-02 11:22:25', NULL),
(122, 139, 19, 'Bdhbe', NULL, 2, '2019-12-02 11:32:42', NULL),
(123, 16, 143, 'test message', NULL, 2, '2019-12-06 21:25:23', '2019-12-06 21:25:23'),
(124, 139, 143, 'hy', NULL, 2, '2019-12-06 21:38:05', NULL),
(125, 143, 125, 'How are you?', NULL, 2, '2019-12-11 10:11:57', NULL),
(126, 1, 16, 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.\r\n\r\nBring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple touchpoints for offshoring.\r\n\r\nCapitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.', 'images/message_attachment/img_4787.jpg', 2, '2019-12-12 06:18:02', '2019-12-18 06:33:11'),
(127, 1, 28, 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.\r\n\r\nBring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple touchpoints for offshoring.\r\n\r\nCapitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.', 'images/message_attachment/img_4787.jpg', 1, '2019-12-12 06:18:03', '2019-12-12 06:18:03'),
(128, 1, 16, 'Hello', NULL, 2, '2019-12-18 07:16:19', '2019-12-18 08:04:25'),
(129, 1, 16, 'Helllo', NULL, 2, '2019-12-18 07:28:04', '2019-12-18 08:04:25'),
(130, 1, 16, 'Testing Message', NULL, 2, '2019-12-18 08:04:02', '2019-12-18 08:04:25'),
(131, 17, 1, 'Hello', NULL, 1, '2019-12-18 08:07:41', '2019-12-18 08:07:41'),
(132, 1, 16, 'Testing', NULL, 1, '2019-12-19 00:32:05', '2019-12-19 00:32:05'),
(133, 1, 16, 'Testing ankur', NULL, 1, '2019-12-19 08:31:30', '2019-12-19 08:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `ka_notification`
--

CREATE TABLE `ka_notification` (
  `notification_id` int(10) UNSIGNED NOT NULL,
  `unique_group_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user_id` int(10) UNSIGNED NOT NULL,
  `display_date` datetime DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1 = Schedule, 0 = Sent, 2 = View, 3 = Failed, 4=Dismiss',
  `notification_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1 = Class, 0 = Club',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_notification`
--

INSERT INTO `ka_notification` (`notification_id`, `unique_group_id`, `user_id`, `description`, `created_user_id`, `display_date`, `status`, `notification_type`, `created_at`, `updated_at`) VALUES
(1, 'c4fe6f9b528c109a2049af3db2e9ad86', 17, 'Testing', 1, '2019-10-18 11:43:48', 4, '1', '2019-10-18 18:43:49', '2019-10-18 18:43:49'),
(2, 'c4fe6f9b528c109a2049af3db2e9ad86', 121, 'Meeting is on monday', 1, '2019-10-19 00:00:00', 4, '0', '2019-10-19 18:43:49', '2019-10-19 18:43:49'),
(3, 'c4fe6f9b528c109a2049af3db2e9ad86', 121, 'Messaging sysatem will go online', 1, '2019-10-19 11:40:00', 4, '1', '2019-10-19 18:43:49', '2019-10-19 18:43:49'),
(4, '9fafb02c65d71403c67ad77378c63910', 17, 'This is teting.', 1, '2019-10-22 08:23:03', 4, '1', '2019-10-22 15:23:03', '2019-10-22 15:23:03'),
(5, '887f363b86cf9473acc5e4b2acf2e09d', 17, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 1, '2019-10-23 12:00:00', 4, '1', '2019-10-22 15:24:08', '2019-10-22 15:24:08'),
(6, 'f23e18ad24eadb6888c000c143ae1bf8', 17, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, \nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 1, '2019-10-22 08:24:56', 4, '1', '2019-10-22 15:24:56', '2019-10-22 15:24:56'),
(7, 'c9fe6b92296e3dfa3e1a948bece9b938', 17, 'This is a test notification for Grade', 1, '2019-10-23 10:45:50', 4, '1', '2019-10-23 17:45:50', '2019-10-23 17:45:50'),
(8, '5a489fdab6148e565265998e1fc370be', 17, 'This is a test notification for Grade111', 1, '2019-10-23 10:46:12', 3, '1', '2019-10-23 17:46:12', '2019-10-23 17:46:12'),
(9, '6a0d342384454dc112a9b309fc554ba5', 17, 'This is a test notification for Grade2222', 1, '2019-10-23 10:46:31', 3, '1', '2019-10-23 17:46:31', '2019-10-23 17:46:32'),
(10, 'dc9de9daddb7a4fa3c0dfa71d310c2f2', 17, 'This is a test notification for Grade Schedule1', 1, '2019-10-24 15:00:00', 1, '1', '2019-10-23 17:47:20', '2019-10-23 17:47:20'),
(11, '71433d508fc46299ba844fb7e85a8820', 17, 'This is a test notification for Grade Schedule12', 1, '2019-10-25 15:00:00', 1, '1', '2019-10-23 17:47:41', '2019-10-23 17:47:41'),
(12, '35aa4e82de4f9bd6362ebe550e2c016b', 139, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 1, '2019-12-12 17:00:00', 2, '1', '2019-12-13 20:16:04', '2019-12-13 20:16:04'),
(13, '35aa4e82de4f9bd6362ebe550e2c016b', 143, 'There are many variations of passages of Lorem Ipsum available,', 1, '2019-12-12 17:00:00', 2, '1', '2019-12-13 20:16:04', '2019-12-13 20:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `ka_pick_up_and_drop_off_user`
--

CREATE TABLE `ka_pick_up_and_drop_off_user` (
  `pick_up_and_drop_off_user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL COMMENT '1 => Male, 2 => Female',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_physical_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_pick_up_and_drop_off_user`
--

INSERT INTO `ka_pick_up_and_drop_off_user` (`pick_up_and_drop_off_user_id`, `first_name`, `last_name`, `gender`, `phone`, `short_physical_description`, `created_at`, `updated_at`) VALUES
(3, 'test', 'test', 2, '1245639874', 'physical', '2019-07-17 07:09:01', NULL),
(4, 'testfname', 'testlname', 1, '5698745896', 'physical', '2019-09-05 10:57:50', NULL),
(5, 'testfname', 'testlname', 1, '5698745896', 'physical', '2019-09-05 11:13:50', NULL),
(6, 'testfname', 'testlname', 1, '5698745896', 'physical', '2019-09-05 12:49:15', NULL),
(7, 'rj', 'yu', 0, '6u', 'ty', '2019-09-05 12:59:34', NULL),
(8, 'js', 'jsu', 0, 'js', 'js', '2019-09-05 13:03:29', NULL),
(9, 'bs', 'js', 0, 'hz', 'hz', '2019-09-05 13:04:57', NULL),
(10, 'bs', 'js', 0, 'hz', 'hz', '2019-09-05 13:05:00', NULL),
(11, 'bs', 'js', 0, 'hz', 'hz', '2019-09-05 13:05:01', NULL),
(12, 'bs', 'js', 0, 'hz', 'hz', '2019-09-05 13:05:02', NULL),
(13, 'bz', 'js', 1, 'us', 'hhs', '2019-09-05 13:06:36', NULL),
(14, 'rk', 'ji', 1, 'jkajajshs', 'hsjsjss', '2019-09-06 04:41:57', NULL),
(15, 'testfname', 'testlname', 1, '5698745896', 'physical', '2019-09-06 04:42:31', NULL),
(16, 'rk', 'ji', 2, 'jkajajshs', 'hsjsjss', '2019-09-06 04:43:02', NULL),
(17, 'rohir', 'khatri', 1, '7733934864', 'huui', '2019-09-06 04:56:39', NULL),
(18, 'ravi', 'khatri', 2, '7979797979', 'hahahahajaaj', '2019-09-06 05:12:23', NULL),
(19, 'ty', 'yy', 1, '6655588885', 'dfhhjj', '2019-09-06 05:18:58', NULL),
(21, 'test', 'testlname', 1, '5698745896', 'physical', '2019-09-17 07:32:34', NULL),
(25, 'Lisa', 'Olivia', 2, '123456789', 'Short physical description \ne.g. 5ft 11in dark skinned \nheavy-set man ', '2019-09-19 11:53:45', NULL),
(26, 'abva', 'Liam', 1, '987056422', '5ft dark color', '2019-10-04 12:48:00', NULL),
(27, 'test', 'testlname', 1, '5698745896', 'physical', '2019-10-18 16:11:41', NULL),
(28, 'test', 'testlname', 1, '5698745896', 'physical', '2019-10-18 16:16:38', NULL),
(29, 'test', 'testlname', 1, '5698745896', 'physical', '2019-10-18 16:19:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ka_roles`
--

CREATE TABLE `ka_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_roles`
--

INSERT INTO `ka_roles` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'School'),
(3, 'Teacher'),
(4, 'Student'),
(5, 'Parent'),
(6, 'PTA');

-- --------------------------------------------------------

--
-- Table structure for table `ka_school_level`
--

CREATE TABLE `ka_school_level` (
  `school_level_id` int(10) UNSIGNED NOT NULL,
  `school_level_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_school_level`
--

INSERT INTO `ka_school_level` (`school_level_id`, `school_level_name`, `created_at`, `updated_at`) VALUES
(1, 'Level 1', '2019-06-30 18:30:00', '2019-06-30 18:30:00'),
(2, 'Level 2', '2019-06-30 18:30:00', '2019-06-30 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `ka_state`
--

CREATE TABLE `ka_state` (
  `state_id` int(10) UNSIGNED NOT NULL,
  `state_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_state`
--

INSERT INTO `ka_state` (`state_id`, `state_name`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Abia', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(2, 'Adamawa', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(3, 'Akwa Ibom', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(4, 'Anambra', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(5, 'Bauchi', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(6, 'Bayelsa', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(7, 'Benue', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(8, 'Borno', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(9, 'Cross River', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(10, 'Delta', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(11, 'Ebonyi', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(12, 'Edo', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(13, 'Ekiti', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(14, 'Enugu', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(15, 'FCT', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(16, 'Gombe', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(17, 'Imo', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(18, 'Jigawa', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(19, 'Kaduna', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(20, 'Kano', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(21, 'Katsina', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(22, 'Kebbi', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(23, 'Kogi', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(24, 'Kwara', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(25, 'Lagos', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(26, 'Nasarawa', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(27, 'Niger', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(28, 'Ogun', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(29, 'Ondo', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(30, 'Osun', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(31, 'Oyo', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(32, 'Plateau', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(33, 'Rivers', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(34, 'Sokoto', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(35, 'Taraba', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(36, 'Yobe', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00'),
(37, 'Zamfara', 1, '2019-07-29 01:30:00', '2019-07-29 01:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `ka_student_allergies`
--

CREATE TABLE `ka_student_allergies` (
  `student_allergie_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `allergie_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_student_allergies`
--

INSERT INTO `ka_student_allergies` (`student_allergie_id`, `user_id`, `allergie_id`, `created_at`, `updated_at`) VALUES
(1, 26, 2, '2019-07-11 18:51:05', '2019-07-11 18:51:05'),
(2, 27, 1, '2019-07-12 19:58:01', '2019-07-12 19:58:01'),
(3, 112, 1, '2019-09-04 14:51:02', '2019-09-04 14:51:02'),
(4, 123, 1, '2019-09-18 14:10:30', '2019-09-18 14:10:30'),
(6, 124, 2, '2019-10-14 05:43:37', '2019-10-14 05:43:37'),
(7, 151, 2, '2019-10-14 05:58:16', '2019-10-14 05:58:16'),
(8, 20, 1, '2019-10-17 13:16:20', '2019-10-17 13:16:20'),
(9, 19, 1, '2019-10-17 13:18:14', '2019-10-17 13:18:14'),
(10, 38, 1, '2019-10-17 13:26:14', '2019-10-17 13:26:14'),
(11, 107, 1, '2019-10-17 13:27:05', '2019-10-17 13:27:05'),
(12, 153, 1, '2019-10-18 04:02:26', '2019-10-18 04:02:26'),
(13, 164, 1, '2019-11-22 00:07:00', '2019-11-22 00:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `ka_student_feed`
--

CREATE TABLE `ka_student_feed` (
  `student_feed_id` int(10) UNSIGNED NOT NULL,
  `feed_date` date NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_user_id` int(10) UNSIGNED NOT NULL,
  `attendance` int(11) DEFAULT NULL COMMENT '1 => Present, 2 => Absent, 3 => Absent with request',
  `general` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `behavior` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `food` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `health_medical` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_curricular` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_student_feed`
--

INSERT INTO `ka_student_feed` (`student_feed_id`, `feed_date`, `user_id`, `created_user_id`, `attendance`, `general`, `behavior`, `food`, `health_medical`, `extra_curricular`, `created_at`, `updated_at`) VALUES
(1, '2019-07-02', 26, 1, NULL, '<ul>\n<li>Diaper Changed at 4pm</li>\n<li>Slept at 2pm</li>\n<li>Woke up T 3:30pm</li>\n</ul>', '<ul>\n<li>cried a lot today - all day</li>\n<li>helped stop a fight today, I am veryat 4:15 pm</li>\n</ul>\n<p>&nbsp;</p>', '<ul>\n<li>Lunch - Spaghetti &amp; chicken stew packed<br />from home - 2:00pm</li>\n</ul>', '<ul>\n<li>Temperature rose to 38.3c - 9:50am</li>\n</ul>', '<ul>\n<li>Participated in kite building - 12:00pm</li>\n</ul>', '2019-07-11 18:23:02', '2019-07-11 18:23:02'),
(2, '2019-09-06', 112, 17, 1, '<p>Joy Ihuoma is very smart &amp; <br />private pupil grow the holistic world <br />workplace diversity and empowerment.</p>', '<p>Joy Ihuoma is very smart &amp; <br />private pupil grow the holistic world <br />workplace diversity and empowerment.</p>', '<p>Michael Oluwafunbi is very smart &amp; <br />private pupil grow the holistic world <br />workplace diversity and empowerment.</p>', '<p>Joy Ihuoma is very smart &amp; <br />private pupil grow the holistic world <br />workplace diversity and empowerment.</p>', '<p>Joy Ihuoma is very smart &amp; <br />private pupil grow the holistic world <br />workplace diversity and empowerment.</p>', '2019-09-05 17:17:39', '2019-10-17 13:29:17'),
(3, '2019-09-05', 112, 17, 1, '<p>Joy Ihuoma is very smart &amp; <br />private pupil grow the holistic world <br />workplace diversity and empowerment.</p>', '<p>Joy Ihuoma is very smart &amp; <br />private pupil grow the holistic world <br />workplace diversity and empowerment.</p>', '<p>Joy Ihuoma is very smart &amp; <br />private pupil grow the holistic world <br />workplace diversity and empowerment.</p>', '<p>Joy Ihuoma is very smart &amp; <br />private pupil grow the holistic world <br />workplace diversity and empowerment.</p>', '<p>Joy Ihuoma is very smart &amp; <br />private pupil grow the holistic world <br />workplace diversity and empowerment.</p>', '2019-09-05 17:18:12', '2019-10-17 13:29:39'),
(4, '2019-10-17', 124, 17, 1, '<p>Quite good</p>', '<p>Normal <span data-dobid=\"hdw\">behaviour</span></p>', '<p>Taken lunch</p>', '<p>Health is ok</p>', '<p>Nothing</p>', '2019-10-17 12:54:29', '2019-10-17 12:54:29'),
(5, '2019-10-17', 123, 17, 1, '<p>Quite good</p>', '<p>Good&nbsp;<span data-dobid=\"hdw\">behaviour</span></p>', '<p>Taken lunch</p>', '<p>Health is ok</p>', '<p>Nothing</p>', '2019-10-17 13:11:03', '2019-10-17 13:11:03'),
(6, '2019-10-17', 38, 17, 1, '<p>Rachael Machie is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>Rachael Machie is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>Rachael Machie is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>Rachael Machie is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>Rachael Machie is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '2019-10-17 13:15:06', '2019-10-17 13:30:48'),
(7, '2019-10-17', 19, 17, 1, '<p>jackson Kainyechukwuekene is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>jackson Kainyechukwuekene is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>jackson Kainyechukwuekene is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>jackson Kainyechukwuekene is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>jackson Kainyechukwuekene is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '2019-10-17 13:20:05', '2019-10-17 13:35:52'),
(8, '2019-10-17', 107, 17, 1, '<p>Robert Garry is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>Robert Garry is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>Robert Garry is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>Robert Garry is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>Robert Garry is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '2019-10-17 13:25:00', '2019-10-17 13:33:46'),
(9, '2019-10-17', 20, 17, 1, '<p>Emmanuel Afamefuna is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>Emmanuel Afamefuna is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>Emmanuel Afamefuna is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>Emmanuel Afamefuna is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '<p>Emmanuel Afamefuna is very smart &amp;<br />private pupil grow the holistic world<br />workplace diversity and empowerment.</p>', '2019-10-17 13:31:35', '2019-10-17 13:32:01'),
(10, '2019-10-19', 157, 16, 1, '<p>mark was in good spirit today</p>', '<p>excellent</p>', '<p>chicken</p>', '<p>good health</p>', '<p>play football today</p>', '2019-10-20 02:15:27', '2019-10-20 02:15:27'),
(11, '2019-11-23', 164, 1, 1, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2019-11-22 00:09:56', '2019-11-22 00:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `ka_student_parent`
--

CREATE TABLE `ka_student_parent` (
  `student_parent_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_student_parent`
--

INSERT INTO `ka_student_parent` (`student_parent_id`, `student_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 39, 38, '2019-08-02 19:42:39', '2019-08-02 19:42:39'),
(5, 112, 121, '2019-09-06 19:06:23', '2019-09-06 19:06:23'),
(8, 19, 126, '2019-09-20 16:42:17', '2019-09-20 16:42:17'),
(11, 153, 155, '2019-10-15 21:20:24', '2019-10-15 21:20:24'),
(12, 20, 121, '2019-10-19 13:53:39', '2019-10-19 13:53:39'),
(13, 38, 121, '2019-10-19 13:54:26', '2019-10-19 13:54:26'),
(14, 107, 121, '2019-10-19 13:59:44', '2019-10-19 13:59:44'),
(15, 157, 159, '2019-10-20 02:56:20', '2019-10-20 02:56:20'),
(16, 164, 143, '2019-11-21 23:57:47', '2019-11-21 23:57:47'),
(17, 167, 166, '2019-12-13 22:17:47', '2019-12-13 22:17:47'),
(18, 168, 121, '2020-01-03 06:47:11', '2020-01-03 06:47:11'),
(19, 169, 121, '2020-01-03 07:14:41', '2020-01-03 07:14:41'),
(20, 170, 121, '2020-01-03 07:25:26', '2020-01-03 07:25:26'),
(21, 171, 121, '2020-01-06 08:13:31', '2020-01-06 08:13:31'),
(22, 173, 172, '2020-01-06 08:16:29', '2020-01-06 08:16:29'),
(23, 174, 121, '2020-01-06 08:51:40', '2020-01-06 08:51:40'),
(24, 176, 175, '2020-01-06 08:53:29', '2020-01-06 08:53:29'),
(25, 177, 39, '2020-01-07 01:46:00', '2020-01-07 01:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `ka_users`
--

CREATE TABLE `ka_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_level_id` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_id` int(10) UNSIGNED DEFAULT NULL,
  `class_id` int(10) UNSIGNED DEFAULT NULL,
  `grade_id` int(10) UNSIGNED DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL COMMENT '1 => Male, 2 => Female',
  `eye_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height_in_meter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height_in_inche` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hair_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `principal_first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `principal_last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `principal_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `principal_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_motto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `core_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `state_id` int(10) UNSIGNED DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `current_login_date` datetime DEFAULT NULL,
  `created_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Web, App',
  `ip_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1 = Active, 0 = Inactive',
  `is_show_club_notification` int(11) DEFAULT NULL,
  `club_notification_update_date` datetime DEFAULT NULL,
  `is_show_class_notification` int(11) DEFAULT NULL,
  `class_notification_update_date` datetime DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '''Android''/''IOS''',
  `social_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `social_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_users`
--

INSERT INTO `ka_users` (`user_id`, `first_name`, `last_name`, `school_name`, `school_level_id`, `email`, `password`, `school_id`, `class_id`, `grade_id`, `phone`, `whatsapp`, `gender`, `eye_color`, `height_in_meter`, `height_in_inche`, `weight`, `hair_color`, `date_of_birth`, `comment`, `bio`, `principal_first_name`, `principal_last_name`, `principal_email`, `principal_phone`, `school_motto`, `core_values`, `short_description`, `address`, `country_id`, `state_id`, `city_id`, `zipcode`, `photo`, `last_login_date`, `current_login_date`, `created_type`, `ip_address`, `role_id`, `status`, `is_show_club_notification`, `club_notification_update_date`, `is_show_class_notification`, `class_notification_update_date`, `email_verified_at`, `remember_token`, `fcm_token`, `device_type`, `social_type`, `social_id`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Agbude', '', NULL, 'admin@kidrend.com', '$2y$10$H.Wg0A8FKsKtDSGqW8pD2eMvJlByF/ZAJLJ8jb3ia5qh9b.ngm2pa', NULL, NULL, NULL, '9999999999', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/2_1571003891981375804_15766709331302084576.png', '2020-01-10 09:01:14', '2020-01-10 11:40:15', 'Web', NULL, 1, 1, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2019-06-30 18:30:00', '7vyXyeQfBL8u8cks7dWko6sxR9Hm7Sj9WLL8Z9qO39yWyt4PGnoflnEkXiUo', '', '', '', '', '2019-06-30 18:30:00', '2020-01-10 06:10:15'),
(16, 'Debra', 'Clark', 'Aukamm Elementary School', 1, 'debraclark@gmail.com', '$2y$10$H.Wg0A8FKsKtDSGqW8pD2eMvJlByF/ZAJLJ8jb3ia5qh9b.ngm2pa', NULL, NULL, NULL, '4456655546', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Wilson', 'Ronald', 'ronaldwilson@gmail.com', '8898989998', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '34 Haymans Road', 1, 10, 195, '382352', 'images/user/222_15658330761333318997.png', '2020-01-21 09:09:04', '2020-01-22 04:55:28', 'Web', '103.239.146.10', 2, 1, 1, '2019-07-17 00:21:30', 1, '0000-00-00 00:00:00', '2019-07-05 19:37:37', 'eWmzj2vihXsZSSmcZ8zXAQx1PdAyXZ84x2ytVhIZiFqKMyXKckti92hvDeKt', '', '', '', '', '2019-07-05 19:37:38', '2020-01-21 23:25:28'),
(17, 'Jessica', 'Morris', 'Aukamm Elementary School', NULL, 'jessicamorris@gmail.com', '$2y$10$cY1r3S8AC1FXvmA00DzfsuE1kBZqJUYDpAMIaEWkGypkk/ngS.XXW', 16, 10, 8, '4545664655', '1234567890', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'abia', 1, 1, 1, NULL, 'images/user/20191206124940000000.jpg', '2020-01-06 13:55:05', '2020-01-07 10:13:11', 'Web', '61.0.29.119', 3, 1, 1, '2019-10-23 09:52:53', 1, '2019-10-23 09:57:55', '2019-07-05 19:42:19', '4FG3qPnqEwXRMc5QSnLNZL9kwWEANKimiFNC6lrGABBETb4u3mtPthOBtyf3', '', '', '', '', '2019-07-05 19:42:19', '2020-01-07 04:43:11'),
(18, 'Barbara', 'Roberts', NULL, NULL, 'barbararoberts@gmail.com', '$2y$10$3fGkgMEA.B18ESjMZWWx.ertwha6prRrcRpoAfAASr8zxYM56XEym', 16, 22, 8, '9898998999', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/koala_1562330586.jpg', NULL, NULL, 'Web', '103.239.146.10', 3, 1, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2019-07-05 19:43:06', NULL, '', '', '', '', '2019-07-05 19:43:06', '2019-10-21 20:22:28'),
(19, 'Jackson', 'Villanova', NULL, NULL, 'normareed@gmail.com', '$2y$10$QAU0gAktd1LRIYidZtL/4ePdSRK8jQd2UdKXZYOQvrYHWrNT4za/m', 16, 11, 8, '4454564565', '9829056030', 1, NULL, NULL, NULL, NULL, NULL, '2000-08-10', NULL, 'Hard worker', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/b3_1571004548741019040.png', '2019-09-24 06:13:44', '2019-09-24 06:13:44', 'Web', '103.239.146.10', 4, 1, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2019-07-05 19:48:49', NULL, '', '', '', '', '2019-07-05 19:48:49', '2019-12-12 06:23:13'),
(20, 'Emmanuel', 'Afamefuna', NULL, NULL, 'louisnelson@gmail.com', '$2y$10$OfA2iRhxO0dTWU/H3TGw4.5LQ.O95maVavwEhPE1uJmJkChKDIqCi', 16, 10, 8, '7899878898', NULL, 1, 'Blue', '5', '7', '50', 'Balck', '2000-08-15', 'nice', 'Emmanuel Afamefuna is very smart & \r\nprivate pupil grow the holistic world \r\nworkplace diversity and empowerment.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/b2_157100455763808777.png', NULL, NULL, 'Web', '103.239.146.10', 4, 1, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2019-07-05 19:51:03', NULL, '', '', '', '', '2019-07-05 19:51:03', '2019-10-17 13:17:54'),
(21, 'Samuel', 'Jenkins', NULL, NULL, 'samueljenkins@gmail.com', '$2y$10$OfA2iRhxO0dTWU/H3TGw4.5LQ.O95maVavwEhPE1uJmJkChKDIqCi', 16, 10, 8, '7899878898', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '123546', 'images/user/user_1562331063.jpg', NULL, NULL, 'Web', '103.239.146.10', 5, 1, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2019-07-05 19:51:03', NULL, 'nvbn', 'IOS', '', '', '2019-07-05 19:51:03', '2019-07-05 19:51:03'),
(22, 'Victor', 'Scott', NULL, NULL, 'victorscott@gmail.com', '$2y$10$OfA2iRhxO0dTWU/H3TGw4.5LQ.O95maVavwEhPE1uJmJkChKDIqCi', 16, 10, 8, '7899878898', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '123546', 'images/user/user_1562331053.jpg', NULL, NULL, 'Web', '103.239.146.10', 5, 1, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2019-07-05 19:51:03', NULL, '', '', '', '', '2019-07-05 19:51:03', '2019-07-05 19:51:03'),
(23, 'Martha', 'Hall', 'Idealnest school', 2, 'mhall@gmail.com', '$2y$10$H.Wg0A8FKsKtDSGqW8pD2eMvJlByF/ZAJLJ8jb3ia5qh9b.ngm2pa', NULL, NULL, NULL, '8888888888', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jack', 'halimator', 'jhalimator@gmail.com', '9999999999', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'USA', 1, 1, 1, '235689', 'images/user/school_1562841433.jpg', NULL, NULL, 'Web', '103.239.146.10', 2, 1, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2019-07-11 17:37:13', NULL, '', '', '', '', '2019-07-11 17:37:13', '2019-07-11 17:39:36'),
(24, 'Ralph', 'Harris', NULL, NULL, 'RHarris@ymail.com', '$2y$10$uzZp5OT6714TbhawptKDW.LopfuHCWjArGkprRA3t1LIiGZE40Uv6', 23, 14, 10, '5555555555', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dummy text data', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/841490_1562841554.png', NULL, NULL, 'Web', '103.239.146.10', 3, 1, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2019-07-11 17:39:14', NULL, '', '', '', '', '2019-07-11 17:39:14', '2019-07-11 17:39:14'),
(25, 'Thomas', 'Henderson', NULL, NULL, 'thenderson@gmail.com', '$2y$10$HuOI8NoVWJJWY05vCDDM9.vjNzJ31YCrCmkC6JeovPhQBLXJMNG9.', 23, 15, 11, '2222222222', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'loreum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, 'Web', '103.239.146.10', 3, 1, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2019-07-11 17:41:01', NULL, '', '', '', '', '2019-07-11 17:41:01', '2019-07-11 19:40:13'),
(26, 'Esther', 'Maduenu', NULL, NULL, 'agonzalez@gmail.com', '$2y$10$dbVvbFDs2vvlOQjISLLy3ORRou92oVaN2zuDz8ALRwiifGiiUYWBu', 23, 15, 11, '4569771235', '', 1, 'Brown', '4', '11', '45', 'Black', '2000-08-08', 'Thanks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/27_1571004027345192509.png', NULL, NULL, 'Web', '103.239.146.10', 4, 1, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2019-07-11 17:44:15', NULL, '', '', '', '', '2019-07-11 17:44:15', '2019-10-14 06:00:28'),
(27, 'Blessing', 'Akpenvwoghene', NULL, NULL, 'john@gmail.com', '$2y$10$qjvoJ5ak6Rm5hrwMPWBLeOC2eojZPMvLwQVt3nPRfGpV5lGmdRzt6', 16, 13, 9, '2343423422', NULL, 1, 'Black', '5', '5', '40', 'Black', '2000-08-16', 'sdsf', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/19_1571003604958111955.png', NULL, NULL, 'Web', '103.239.146.10', 4, 1, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2019-07-12 13:39:31', NULL, '', '', '', '', '2019-07-12 13:39:32', '2019-10-14 05:53:25'),
(28, 'Todd', 'Foster', 'Steven', 1, 'toddfoster@gmail.com', '$2y$10$H.Wg0A8FKsKtDSGqW8pD2eMvJlByF/ZAJLJ8jb3ia5qh9b.ngm2pa', NULL, NULL, NULL, '8798789897', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Steven', 'Thompson', 'steven@gmail.com', '9855656566', 'Lorem...', 'Lorem...', 'Lorem...', 'USA', 1, 1, 1, '382352', 'images/user/lighthouse_1562936104.jpg', NULL, NULL, 'Web', '103.239.146.10', 2, 1, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2019-07-12 19:55:04', NULL, '', '', '', '', '2019-07-12 19:55:04', '2019-07-12 19:55:04'),
(29, 'Juan', 'Sanders', NULL, NULL, 'juansanders@gmail.com', '$2y$10$JD0Il5w7pC1m2LjfSApF.ezAD3eqy4xy63p.echChiIgYgBwKf4n6', 28, 16, 12, '8989998989', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Lorem...', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/13_1551811496_1562936197.png', NULL, NULL, 'Web', '103.239.146.10', 3, 1, 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2019-07-12 19:56:37', NULL, '', '', '', '', '2019-07-12 19:56:37', '2019-07-12 19:56:37'),
(31, 'jack123', 'jack123', NULL, NULL, 'jack123@gmail.com', '$2y$10$tLdJPasOaGlvqlpZi1g3m.x9BLT.l.h1sDzoxwVzXpg0ruA5sZfL.', NULL, NULL, NULL, '1234567898', '9876543217', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', 1, 1, 1, NULL, 'images/user/2019071763345000000.jpg', '2019-07-16 23:07:30', '2019-07-16 23:07:30', 'App', '103.250.189.148', 5, 1, NULL, NULL, NULL, NULL, '2019-07-17 05:50:14', NULL, '', '', '', '', '2019-07-17 05:50:14', '2019-07-17 06:33:45'),
(32, 'Merry', 'Merry', NULL, NULL, 'merry@gmail.com', NULL, NULL, NULL, NULL, '1234567890', '1234567890', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'adddress', 1, 1, 1, NULL, 'images/user/20190916113554000000.jpg', '2019-10-22 12:08:54', '2019-09-27 03:40:28', 'App', '103.250.189.148', 3, 1, NULL, NULL, NULL, NULL, '2019-07-17 05:52:27', NULL, 'QWERBHJGJH4NDk4MA', 'Android', '', '', '2019-07-17 05:52:27', '2019-09-16 11:35:55'),
(33, 'Patrick', 'Okoro', 'Agape Bundle', 1, 'admin@agapebundle.com', '$2y$10$v1JigqGmPfJ4Xh.Va69rCOdWGAKxriOhYW3VkelbKDUlWOO2QKKZm', NULL, NULL, NULL, '0802341726', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Jenny', 'Okoli', 'info@agapebundleschools.com', '2347967983', 'quality education at it best', 'The fear of the Most High God (KLIM) Keep love in mind.Personality is fixed from childhood\", so we are poised in restoring family values and fear of the lord to todays\' children for a better tomorrowTo promote Health, Happiness, Safety and welfare of all children and protect them from all kinds of harm and abuses besides giving them love and sound foundation for their Education', 'Knowing that the personality of a child is determined by his/her foundation, Agape Bundles is styled to give the young ones a sense of Home, an environment to stimulate their senses and give them the motherly care that will make them blossom like flowers in their due season. It is designed to meet the needs of children between the ages of 3 months to 10 years and in the after school service 3yrs to 12yrs. It is said that the experiences of a child between birth and age 6 cements the foundation for later development, this is why Agape Bundles is set up to make the best of their early years and create an atmosphere that promotes the wellbeing of children as well as provide a solid foundation for their future and sound qualitative education. Today Agape Bundles is considered a unique school and is known to have brought COMFORT to the doorstep of families, Whose minds are at peace knowing that their bundles are lovingly cared for and developed in a first class, warm, attractive and conducive environment by God fearing professionals. We make childhood a pleasant and memorable experience “NO CHILDHOOD WITHOUT THE AGAPE EXPERIENCE” KLIM Keep love in Mind Barr Mrs. Jennifer .K.Okoli dared to dream of a home where children can be kept safe, healthy, developed mentally and socially and also given a foundation for their education, without loosing the value', 'Plot 46 Adeyemi Akakpo Street, Ikeja, Nigeria', 1, 25, 516, '234', 'images/user/ways-insight-logo_1564066514.png', NULL, NULL, 'Web', '70.115.141.178', 2, 1, NULL, NULL, NULL, NULL, '2019-07-25 17:55:13', NULL, '', '', '', '', '2019-07-25 17:55:14', '2019-10-09 00:36:20'),
(34, 'Ella', 'Young', NULL, NULL, 'ellayoung@gmail.com', '$2y$10$xn9A0OuR9WmqQxnROZIKf.9uG8jDRvGolFwNSHhSphJzwPHCRpM2u', 33, 17, 19, '8082301022', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5ft 8 xxxxxxxxxxxxxxx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/395bfb89-333b-4cf9-81bb-ecd63d556ec0_1564067335.jpg', NULL, NULL, 'Web', '70.115.141.178', 3, 1, NULL, NULL, NULL, NULL, '2019-07-25 18:08:55', NULL, '', '', '', '', '2019-07-25 18:08:56', '2019-07-25 18:08:56'),
(35, 'Blessing', 'Chiagozie', NULL, NULL, 'john_doe@yahoo.com', '$2y$10$dsD653icZhwP6uXDM5sjzu1xm7lCz.s1db71Kmj0CJ..UCvvZUgWm', 23, 15, 11, '0802301044', NULL, 2, 'Black', '5', '3', '35', 'Black', '2000-08-31', 'nice', 'Hard worker', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/21_15710036481915051014.png', NULL, NULL, 'Web', '70.115.141.178', 4, 1, NULL, NULL, NULL, NULL, '2019-07-25 18:19:01', NULL, '', '', '', '', '2019-07-25 18:19:01', '2019-10-14 05:54:08'),
(36, 'Cari', 'Forde', NULL, NULL, 'cariforde@gmail.com', '$2y$10$wKJwffoXbAxiwnfTMN95V.KJAePTSEEooq/uQYQMMcPrYfiYspLT.', 16, NULL, NULL, '123456789', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Web', '103.239.146.10', 6, 1, NULL, NULL, NULL, NULL, '2019-08-02 19:31:06', NULL, '', '', '', '', '2019-08-02 19:31:06', '2019-08-02 19:31:06'),
(37, 'Constance', 'Hall', NULL, NULL, 'Conhall@gmail.com', '$2y$10$nkM5RCuVcgimNwksg0Jxwua0tmZUkLsXDQybSkPdwzgASJZspr4se', 16, 23, 9, '1234567890', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/big_156474587092907503.jpg', NULL, NULL, 'Web', '103.239.146.10', 3, 1, NULL, NULL, NULL, NULL, '2019-08-02 19:37:50', NULL, '', '', '', '', '2019-08-02 19:37:50', '2019-10-21 20:22:22'),
(38, 'Rachael', 'Machie', NULL, NULL, 'Iziengbe@gmail.com', '$2y$10$ar5kjLpyiwzA/0ecaFCzH.78mBgZ5TerAs0TGmJ1dL2gMJdmEM6QK', 16, 10, 8, '9876543210', NULL, 2, 'Blue', '5', '7', '40', 'Brown', '2000-08-14', 'nice', 'Hard worker', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/g1_1571004573802491269.png', NULL, NULL, 'Web', '103.239.146.10', 4, 1, NULL, NULL, NULL, NULL, '2019-08-02 19:41:03', NULL, '', '', '', '', '2019-08-02 19:41:03', '2019-10-17 13:30:15'),
(39, 'Augustine', 'Iheanyichukwu', NULL, NULL, 'Iheanyichukwu@gmail.com', '$2y$10$M.9S2s5Jvkoc5VdFlrNxiuT8MSMq3Dt9xrhZoe7Ml6CAF3Si9vnw.', 16, NULL, NULL, '852369741', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, 'Web', '103.239.146.10', 5, 1, NULL, NULL, NULL, NULL, '2019-08-02 19:42:39', NULL, '', '', '', '', '2019-08-02 19:42:39', '2019-08-02 19:42:39'),
(40, 'Jack', 'Jack', NULL, NULL, 'jack@gmail.com', '$2y$10$UtF3tmV34SfY3GOHptsAKOUwiXLIox592CSDz.gkfMv2T8jHyRaze', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-22 12:08:20', '2019-09-27 03:52:49', 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-28 10:30:35', NULL, 'QWERBHJGJH4NDk4MA', 'Android', '', '', '2019-08-28 10:30:35', NULL),
(41, 'Developer', 'Developer', NULL, NULL, 'developer@malinator.com', '$2y$10$HHf5QoBalGIMqWakgw9DBOjsclTse2ocIA8P5rOLNS.VAzab4/EPm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '103.250.189.148', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 04:19:05', NULL, '', '', '', '', '2019-08-29 04:19:05', NULL),
(42, 'Ellie', 'Wormer', NULL, NULL, 'sandeep.knollinfo@gmail.com', '$2y$10$/Wj1tZgsyLzMT./834mgkOS7Oqt9mTZNNy.5eVcGXZWBdIRMzXK4a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 09:55:17', NULL, '', '', '', '', '2019-08-29 09:55:17', NULL),
(43, 'Vivian', 'Blake', NULL, NULL, 'sandeep1.knollinfo@gmail.com', '$2y$10$szgkDXVNIkoUWBEQVB3ymugj3z/EILpTGBsg0YKJmKbDv1ECHFjc6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-29 03:48:09', '2019-08-29 03:48:09', 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 09:56:33', NULL, '', '', '', '', '2019-08-29 09:56:33', NULL),
(44, 'Jack', 'Jack', NULL, NULL, 'jack1@gmail.com', '$2y$10$Lm5IiHi6ypvGE8Pzby/S2.XPmZ1IS/Zt0bUw43.ITBFnHVHZzExeW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 10:10:29', NULL, '', '', '', '', '2019-08-29 10:10:29', NULL),
(45, 'Jack', 'Jack', NULL, NULL, 'jack2@gmail.com', '$2y$10$Xm92Ca5bMA9MxhmycIGyh.xaFGz7ltG2nUaSZcomq6FhxNoACBape', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 10:13:43', NULL, '', '', '', '', '2019-08-29 10:13:43', NULL),
(46, 'Jack', 'Jack', NULL, NULL, 'test@gmail.com', '$2y$10$Y9wRS0/RUFf7Au9iz1guPOfUNyvtaG/k9/KyHNCTJBAMT/n6ZlNBW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 10:23:13', NULL, '', '', '', '', '2019-08-29 10:23:13', NULL),
(47, 'Jack', 'Jack', NULL, NULL, 'jack54@gmail.com', '$2y$10$6lIQ5j2d0EXyWn3WfUBNtOz2Um0p6yH.LJCGYAVlYNnP6e7Fr8lPu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 10:25:44', NULL, '', '', '', '', '2019-08-29 10:25:44', NULL),
(48, 'Robb', 'D', NULL, NULL, 'robb@gmail.com', '$2y$10$E86BlmgTXVqE0y9ghH/.l.kf.cMOIBhNEf9KNOQh7xeyAyaMFpC4O', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-02 05:14:40', '2019-09-02 05:14:40', 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 10:30:21', NULL, '', '', '', '', '2019-08-29 10:30:21', NULL),
(49, 'Jack', 'Jack', NULL, NULL, 'jack54ss@gmail.com', '$2y$10$gd6px2.pVi0HGtu1eWTfzu5rwV.r0qABN4c8xq3qQGMx4rFCQ5V12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 10:42:53', NULL, '', '', '', '', '2019-08-29 10:42:53', NULL),
(51, 'Robb', 'D', NULL, NULL, 'robb1@gmail.com', '$2y$10$FsBjff6xAW9.ZiFBOuemROP6BfD8bWjpovtQlDob65GzKjn5txRy.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 11:19:58', NULL, '', '', '', '', '2019-08-29 11:19:58', NULL),
(52, 'Rihidt', 'Irdkr', NULL, NULL, 'rohfa@gmail.com', '$2y$10$4nNk4vHhVLZItRIw6xgT3ObbuoypToRHGWj7d8vV6i2nEZSF46/q2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 11:22:22', NULL, '', '', '', '', '2019-08-29 11:22:22', NULL),
(53, 'Rihidtg', 'Irdkrg', NULL, NULL, 'rohfas@gmail.com', '$2y$10$uMpQ6oPRCFJ9sArznI8ZBO4yPExCMTf5B6B8Dl90hrBd/ibZQn7i2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-29 21:45:11', '2019-08-29 21:45:11', 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 11:22:36', NULL, '', '', '', '', '2019-08-29 11:22:36', NULL),
(54, 'Rock', 'Z', NULL, NULL, 'rockZ@gmail.com', '$2y$10$.CaXg7zkuR9Vl/YWoAYPzO.oxIRYtSsy.wjJJ0Yc/fRJ3kWNCCqom', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 11:24:27', NULL, '', '', '', '', '2019-08-29 11:24:27', NULL),
(55, 'Rav', 'D', NULL, NULL, 'ravi@gmail.com', '$2y$10$xXIknyzkr4lw97teXRB//erQf5ttDS63gbK7jP0dwRsXKgFQmRas6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 11:38:11', NULL, '', '', '', '', '2019-08-29 11:38:11', NULL),
(57, 'Rkxk', 'Jsks', NULL, NULL, 'qqoe@fmajz.com', '$2y$10$RHfCccsgZclmHFM32N0Db.EdWBXwt5FR.di1/zPJkuolN9nqvNQ7.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 11:49:16', NULL, '', '', '', '', '2019-08-29 11:49:16', NULL),
(58, 'Roh', 'Kha', NULL, NULL, 'rohiaa@gmail.com', '$2y$10$jMBd4cqLFw3RlImgFdnSmOWYRUJjqJzdQIwmddhX4BBAtARDN4F1O', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 11:55:07', NULL, '', '', '', '', '2019-08-29 11:55:07', NULL),
(59, 'Rohit', 'Rohit', NULL, NULL, 'eibir@gmail.com', '$2y$10$OWNwQjr.Z5Ikd07M29wTaelkMwKNZ.YfDOUukMxeQpde6zPoWa.d6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 12:01:03', NULL, '', '', '', '', '2019-08-29 12:01:03', NULL),
(60, 'Don', 'Torero', NULL, NULL, 'don@gmail.com', '$2y$10$zgI/RlRoHvMDsKahioeoUuOj4r7Xkj.1JmuLFKUYm37AlAkpxotEW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 12:44:03', NULL, '', '', '', '', '2019-08-29 12:44:03', NULL),
(61, 'Rock', 'Rocky', NULL, NULL, 'rock1@gmail.com', '$2y$10$N/GH8Hl8VXkaYUqk/6zToeUHLUoqOdXbQHM7QcqX4jPr2HVh6Yn6y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 12:50:03', NULL, '', '', '', '', '2019-08-29 12:50:03', NULL),
(62, 'Abc', 'Bcd', NULL, NULL, 'abc@gmail.com', '$2y$10$jfdPVkEXe8bLE7R/LGjPfOUyI2xnc067uG0ra78bzjBYVL8ux3j8y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 12:53:14', NULL, '', '', '', '', '2019-08-29 12:53:14', NULL),
(63, 'Test', 'Te', NULL, NULL, 'test3@gmail.com', '$2y$10$BGNITxNn7kbvDikRhbWk8.I.trbp.NJ8Wt7kbD9EtBFbCXfGeZXcO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-29 13:04:17', NULL, '', '', '', '', '2019-08-29 13:04:17', NULL),
(64, 'Qwer', 'Qwert', NULL, NULL, 'ropi@gmail.com', '$2y$10$wmwUi8Ss4K6jdOnm6NMRUeozMBQdTZWWZiavYpPHieVGqC1XU43Xu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 04:13:55', NULL, '', '', '', '', '2019-08-30 04:13:55', NULL),
(66, 'Fun', 'Zone', NULL, NULL, 'funz@gmail.com', '$2y$10$SnM5wA.OjxANM43BrqUqzOoSeig03qqo0hDIOfde4wTw0Wi7M9a8G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-30 02:41:09', '2019-08-30 02:41:09', 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 04:16:32', NULL, '', '', '', '', '2019-08-30 04:16:32', NULL),
(67, 'Wallace', 'Hi', NULL, NULL, 'ravi1@gmail.com', '$2y$10$s0tqUdPJtcqTQ9q0ri1JZeNi0uupc1wJEg9InPaaWADTZQwEo25B.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 04:41:52', NULL, '', '', '', '', '2019-08-30 04:41:52', NULL),
(68, 'Goff', 'Goff', NULL, NULL, 'james@mailinator.com', '$2y$10$GfOdXtsxiS3bKzfcojPhGe3en0oaTVYnV8woVykH0unCiGhNBX9le', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 04:47:52', NULL, '', '', '', '', '2019-08-30 04:47:52', NULL),
(69, 'Ronesha', 'Rolland', NULL, NULL, 'rk@gmail.com', '$2y$10$yvqFeW7t39N1b.r2DoNvxuyLiCTJVIVsPUWPN9nxJhtElX91uRyUm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 05:15:04', NULL, '', '', '', '', '2019-08-30 05:15:04', NULL),
(70, 'Quenisha', 'Yolanda', NULL, NULL, 'rks@gmail.com', '$2y$10$eh/Tm2VB.h9tQAkjowro2ua1RJd99gy9tBGUbWGOhq0xRaMh0Iyme', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 05:34:01', NULL, '', '', '', '', '2019-08-30 05:34:01', NULL),
(71, 'Jack', 'Jack', NULL, NULL, 'jack564@gmail.com', '$2y$10$70upSJnLwKKfIKgx2Dh/Hei6dT8jJRZzSWVhqzVb0ZMfaKRucobKC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 05:51:50', NULL, '', '', '', '', '2019-08-30 05:51:50', NULL),
(72, 'Jack', 'Jack', NULL, NULL, 'jack5644@gmail.com', '$2y$10$3AuLXusbfiFj/UveEzazZeQd0a0VJIW9CUtoqbA6qxmthgrBZjkTK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-29 23:40:37', '2019-08-29 23:40:37', 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 05:53:13', NULL, '', '', '', '', '2019-08-30 05:53:13', NULL),
(73, 'Rkdnd', 'Jsnsks', NULL, NULL, 'dk@gmsnx.com', '$2y$10$xbGRerD7FV2ynTm62rjPIOsaxIn3oew.sQZN2igHoX67159gS3FSW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 05:59:48', NULL, '', '', '', '', '2019-08-30 05:59:48', NULL),
(77, 'Robb', 'D', NULL, NULL, 'robb14564@gmail.com', '$2y$10$d8Q65/FvmGzeMqKakm0KCeP5t5Ipa4iqhUv69WC4B92yjKdroV0FW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.27.78', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 06:10:40', NULL, '', '', '', '', '2019-08-30 06:10:40', NULL),
(78, 'Rohit', 'Khatri', NULL, NULL, 'sjja@gmail.com', '$2y$10$53KIEMN3R1IoXWMUrjGfoOEGCkzd.Rp3FXoLKh2YJ4tHzrmG3Tkba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 06:18:59', NULL, '', '', '', '', '2019-08-30 06:18:59', NULL),
(79, 'Rosj', 'Jsjs', NULL, NULL, 'qwer@gmail.com', '$2y$10$0bOU5rknao.P7ij.DiwcQuKedLKhrUX/wVNqTGRCZhIirIsFfLCky', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 06:22:45', NULL, '', '', '', '', '2019-08-30 06:22:45', NULL),
(80, 'Qwaa', 'Jss', NULL, NULL, 'rlsn@gmail.com', '$2y$10$ioI.2k36l1B1hx8KLm/eI.YDsZT4C679oS2Iqgh4JfDJXU.U7o62u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 06:26:28', NULL, '', '', '', '', '2019-08-30 06:26:28', NULL),
(81, 'Roh', 'Jsj', NULL, NULL, 'dfd@gmail.com', '$2y$10$hwUODg2nJJUocIkkTS.7UeeZ01t1Or9TDieK545Mukc0u2o.SdwBu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 06:28:45', NULL, '', '', '', '', '2019-08-30 06:28:45', NULL),
(82, 'Rkhit', 'Jahs', NULL, NULL, 'rogjk@gmail.com', '$2y$10$Q.Py7ylN/bUMQA2Hy1B9DeMkFbTBD40VUPK/dPhFRp9eYTA0TfBpu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 06:35:10', NULL, '', '', '', '', '2019-08-30 06:35:10', NULL),
(83, 'Ravi', 'K', NULL, NULL, 'ravi.knollinfo@gmail.com', '$2y$10$o.0H2dyBSOiROBZbO43qHOXG5IA3To3PIHMz1pKF5u0LWG4Q231X2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-29 23:51:10', '2019-08-29 23:51:10', 'App', '61.0.27.78', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 06:40:49', NULL, '', '', '', '', '2019-08-30 06:40:49', NULL),
(84, 'Rew', 'Wer', NULL, NULL, 'asd@gmail.com', '$2y$10$aLKUtvggtC9APrymPHaxtO2BoDvX9PjmR3b1aIDkNaubMP1OsYo5a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 06:42:57', NULL, '', '', '', '', '2019-08-30 06:42:57', NULL),
(85, 'Travis', 'Conner', NULL, NULL, 'qwsd@gmail.com', '$2y$10$0oBBs854/pm6Mvz6pocpV.PduSzc/p.K997mpuu.uoZGgpb5OMn/W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 06:46:19', NULL, '', '', '', '', '2019-08-30 06:46:19', NULL),
(86, 'Rih', 'Gjh', NULL, NULL, 'dyh@gmail.com', '$2y$10$r87IoprFRvvbrDXf1W6rU.AMPFdzsnW63U12pUrkSW85RdI2hZuJe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 06:49:53', NULL, '', '', '', '', '2019-08-30 06:49:53', NULL),
(87, 'Js', 'Hs', NULL, NULL, 'hss@gmail.com', '$2y$10$fMIa1VCtNFitkMIhX11brekcJSwI3PFDPJvzPufxQ87Hh6DKObFJu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 06:54:04', NULL, '', '', '', '', '2019-08-30 06:54:04', NULL),
(88, 'Hs', 'H', NULL, NULL, 'sjaa@gmail.com', '$2y$10$XYih7nhyr.DfSfj5MS95uOYhgCdlI.T5rwu62oigLw5A7KTsbS2Ja', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 06:59:28', NULL, '', '', '', '', '2019-08-30 06:59:28', NULL),
(89, 'Rachel', 'Kanwa', NULL, NULL, 'akljfkaljfkj@mail.com', '$2y$10$/13AH0oI.FTFISc.MXbE5uBZraQmwU7/Jflmz8ARvAR5IYrExifSi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.27.78', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 08:35:32', NULL, '', '', '', '', '2019-08-30 08:35:32', NULL),
(90, 'New', 'Test', NULL, NULL, 'neate@gmail.com', '$2y$10$lpvrnN/fBhsNwroykUOF4O2V4WaMzZ53jJNrULnVDDIGBhQqKATIu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 08:53:36', NULL, '', '', '', '', '2019-08-30 08:53:36', NULL),
(91, 'Lkjsda', 'Sash', NULL, NULL, 'sdkjdkfl@gmail.com', '$2y$10$gun3KI/VLdRFgjfF.O7i2OCSoISTlPwpb2T4waU5yGJfG0ZhOHqk6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 09:07:12', NULL, '', '', '', '', '2019-08-30 09:07:12', NULL),
(92, 'Fell', 'Lkejgkls1', NULL, NULL, 'sdfkl@gmail.com', '$2y$10$c2GhOopmozbHdoBEClBzyOVAU07t6A7qPU0bUod0sqtc4Kj0Fmz9m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 09:12:49', NULL, '', '', '', '', '2019-08-30 09:12:49', NULL),
(94, 'Lights', 'Ljasdfkl', NULL, NULL, 'klsd@gmail.com', '$2y$10$75M3qfvB1fgEbxQlqZ4PhO/2vSGIgrRShXX9RVcRa2v/4UyXqol2W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 09:17:26', NULL, '', '', '', '', '2019-08-30 09:17:26', NULL),
(95, 'Clement', 'Larry', NULL, NULL, 'kishan@gmail.com', '$2y$10$rVIXWv/Qurr0Z8tEBJyYsOtnjkYBhw.KqOsJXyEG/ZrFM5ejGRrF6', NULL, NULL, NULL, '8778897887', '7485964512', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, 1, 1, NULL, NULL, '2019-08-30 04:11:23', '2019-08-30 04:11:23', 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 09:23:21', NULL, '', '', '', '', '2019-08-30 09:23:21', '2019-08-30 12:28:56'),
(96, 'Barla', 'Trevor', NULL, NULL, 'afdjsad@gmail.com', '$2y$10$qfOrIfRr7UPWPRJD8YdYA.js4J4L..sK60BuvHkwn9/5YgJ2NcwhS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 09:39:15', NULL, '', '', '', '', '2019-08-30 09:39:15', NULL),
(100, 'Angel', 'Lkjsdf', NULL, NULL, 'sdjg@gmail.com', '$2y$10$bZTOTGoqYOBbijKzUYKWO.AQOxtPRsTcx7fetOkPQ0fA2ZymndbqO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 09:51:18', NULL, '', '', '', '', '2019-08-30 09:51:18', NULL),
(101, 'Ronny', 'Khatri', NULL, NULL, 'rohit.khatri.75436@gmail.com', '$2y$10$Gtmn3mJAbqWbrnE11cqZGez.ZTCqQC3BMYr0Vp1nijGLUXNiXPqKm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 09:52:24', NULL, '', '', '', '', '2019-08-30 09:52:24', NULL),
(102, 'Jsdfklj', 'Adkin', NULL, NULL, 'klsja@gmail.com', '$2y$10$n.3zKAASwjHOm/pK5MTVWeFaEdPkdli2eHt/9vPuYC2dyDpcs4X/G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.181', 3, 1, NULL, NULL, NULL, NULL, '2019-08-30 09:53:02', NULL, '', '', '', '', '2019-08-30 09:53:02', NULL),
(107, 'Robert', 'Garry', NULL, NULL, 'kishan1.knollinfo@gmail.com', '$2y$10$2uygy2aHr5UT4VZCqDKy2upVXNnX5qSsqp30VgppfcCNPY6/0nhoW', 16, 10, 8, '9874563210', NULL, 1, 'Blue', '5', '1', '35', 'Black', '2000-07-11', 'Nice', 'Robert Garry is very smart & \r\nprivate pupil grow the holistic world \r\nworkplace diversity and empowerment.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/images_15712898162080403007.jpg', NULL, NULL, 'Web', '61.0.25.6', 4, 1, NULL, NULL, NULL, NULL, '2019-09-02 14:20:24', NULL, '', '', '', '', '2019-09-02 14:20:24', '2019-10-17 13:33:14'),
(108, 'Mary', 'Carly', NULL, NULL, 'neha@gmail.com', '$2y$10$/KRXgCG7cRZ/aXIHqD8AdeLZT9uIo.DhKtWATJcMEVt5XsnaOrvVa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-03 02:29:59', '2019-09-03 02:29:59', 'App', '61.0.25.6', 3, 1, NULL, NULL, NULL, NULL, '2019-09-03 09:01:03', NULL, '', '', '', '', '2019-09-03 09:01:03', NULL),
(109, 'Jackie', 'Moore', NULL, NULL, 'neha12@gmail.com', '$2y$10$/fGGQUgCw7wU5YJ85.2KKONLw6/dZFxpT0GpMHfPpvu73JbHP4HvS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.6', 3, 1, NULL, NULL, NULL, NULL, '2019-09-03 09:02:05', NULL, '', '', '', '', '2019-09-03 09:02:05', NULL),
(110, 'Timmy', 'Amanda', NULL, NULL, 'neha123@gmail.com', '$2y$10$UoG4rz5mGV7RXIijLaIOf.peK2oHDXZ8C26OV9umdRz4n7shFVoGW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.6', 3, 1, NULL, NULL, NULL, NULL, '2019-09-03 09:03:38', NULL, '', '', '', '', '2019-09-03 09:03:38', NULL),
(111, 'Neha', 'Jerry', NULL, NULL, 'neha1234@gmail.com', '$2y$10$goEXs7cyjTrcaag0j98muOHHZl6gEXZdHZACPgXB8p//ry4aSNL5q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1995-05-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.6', 3, 1, NULL, NULL, NULL, NULL, '2019-09-03 09:08:59', NULL, '', '', '', '', '2019-09-03 09:08:59', NULL),
(112, 'Joy', 'Ihuoma', NULL, NULL, 'neha124@gmail.com', '$2y$10$L0WyNo.MJeuW1KWzANNilOv7Z5Wg1CIvWQTl8QAnPdjt1uobUbp16', 16, 11, 8, '9874563210', '9874563210', 2, 'Blue', '5', '4', '30', 'Black', '2000-09-20', 'Hard worker', 'Joy Ihuoma is very smart & \r\nprivate pupil grow the holistic world \r\nworkplace diversity and empowerment.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/g2_1571004583714402937.png', NULL, NULL, 'Web', '61.0.25.6', 4, 1, NULL, NULL, NULL, NULL, '2019-09-04 14:49:13', NULL, '', '', '', '', '2019-09-04 14:49:13', '2019-11-22 00:29:19'),
(113, 'Leonard', 'Perry', NULL, NULL, 'kishan@singh.com', '$2y$10$Q.eDv1XuxHNYwj1nE7WNHe7D/vgpA16iXIMRyhpTU0LuzxTFcW7f6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-04 21:31:28', '2019-09-04 21:31:28', 'App', '61.0.25.6', 3, 1, NULL, NULL, 1, '2019-09-04 22:43:00', '2019-09-04 07:10:24', NULL, '', '', '', '', '2019-09-04 07:10:24', NULL),
(114, 'Jake', 'harry', NULL, NULL, 'rohitk@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.6', 5, 1, NULL, NULL, NULL, NULL, '2019-09-05 10:57:36', NULL, '', '', '', '', '2019-09-05 10:57:36', NULL),
(115, 'Daniel', 'Dustin', NULL, NULL, 'webzdeveloper272@gmail.com', '$2y$10$2ITCItC1/VXqzCjEMmhl0.99vyZ47SQw2foWxJRvWHIS5P1/.W6ja', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '103.216.236.182', 3, 1, NULL, NULL, NULL, NULL, '2019-09-05 12:03:31', NULL, '', '', '', '', '2019-09-05 12:03:31', NULL),
(117, 'Brian', 'Martin', NULL, NULL, 'rohitki@gmail.com', '$2y$10$Q6DCO5vuLS5OoubqS/zgRerYbos7Igp1dY.bLynIoLD0rwrjrCkXS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-06 04:50:32', '2019-09-06 04:50:32', 'App', '61.0.25.6', 5, 1, NULL, NULL, NULL, NULL, '2019-09-05 12:57:25', NULL, '', '', '', '', '2019-09-05 12:57:25', NULL),
(121, 'Anna', 'Dallas', NULL, NULL, 'ani@singh.com', '$2y$10$TYzeBxeq2ohMk9BBiowPxOm38JH9sf/3tVTQBrwDTuD.NWNWnX.9.', 16, NULL, NULL, '1236554789', '9639639638', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'suzo trat', 1, 31, 655, NULL, 'images/user/20191017112904000000.jpg', '2019-12-06 14:09:08', '2019-10-17 06:27:01', 'Web', '157.37.244.172', 5, 1, 1, '2019-10-22 13:07:31', 1, '2019-10-22 13:07:28', '2019-09-06 19:06:23', NULL, '', '', '', '', '2019-09-06 19:06:23', '2019-10-19 13:59:44'),
(122, 'Austin', 'Garry', NULL, NULL, 'singhkishanpanwar@gmail.com', '$2y$10$ELZf4ZjrshT7/qtEnJTHa.QO9QLIMwd5Zhsy.yvYGjbArIWoxkWB.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-11 22:25:48', '2019-09-11 22:25:48', 'App', '61.0.31.73', 3, 1, NULL, NULL, NULL, NULL, '2019-09-12 05:25:05', NULL, '', 'Android', 'google', '103346357368836694123', '2019-09-12 05:25:05', NULL),
(123, 'Timothy', 'Ofekira', NULL, NULL, 'sandeep@knoll.com', '$2y$10$02nuIMra1YfPwlrGaVKvnuQThflpSwIoZ2.e3KWNlzKamjxZiGy4S', 16, 10, 8, '9874563210', NULL, 1, 'Blue', '5', '7', '40', 'Black', '2000-10-21', 'nice', 'Hard worker', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/b1_1571004616771157702.png', NULL, NULL, 'Web', '61.0.31.34', 4, 1, NULL, NULL, NULL, NULL, '2019-09-18 14:10:05', NULL, '', '', '', '', '2019-09-18 14:10:05', '2019-10-17 13:28:35'),
(124, 'Kingsley', 'Abayomrunkoje', NULL, NULL, 'theoptimabranding@gmail.com', '$2y$10$2J4bn3VFjSUfykKvfnlweOkkx/j01w6pZ9Qb3ONF/Hsxjx8FsrYHy', 16, 10, 8, '1236547895', NULL, 1, 'Black', '5', '9', '35', 'Brown', '2000-08-23', 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.', 'Hard worker', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/5_1571004777105183.jpg', NULL, NULL, 'Web', '61.0.31.34', 4, 1, NULL, NULL, NULL, NULL, '2019-09-18 14:14:58', NULL, '', '', '', '', '2019-09-18 14:14:58', '2019-10-17 13:28:20'),
(125, 'Emma', 'lores', NULL, NULL, 'emma@gmail.com', '$2y$10$bMXlUaSsQkzl8872sFwmrOqkd6.0arey1RyM6TKWQSKKsKNm4SENu', 16, 21, 22, '(123) 654-7895', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'She is a person who helps students to acquire knowledge, competence or virtue.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/19_1568962176413605667.jpg', '2019-12-06 14:08:26', '2019-10-17 06:27:38', 'Web', '61.0.24.170', 3, 1, 1, '2019-10-01 04:24:20', 1, '2019-10-01 04:24:19', '2019-09-20 14:49:36', 'Xncd1ej8jkl28AlykqDnC6UPcwyrE94m1wKxM3Pv2x4EVWZofogiVgALUIxT', '', '', '', '', '2019-09-20 14:49:36', '2019-10-21 20:20:00'),
(126, 'Luis', 'mirza', NULL, NULL, 'luis@mirza.com', '$2y$10$Et7KUCnCvvCgPXc/vmBCK.FIoE9.egiz3P7ZhzTk548n1jjUIQTvG', 16, NULL, NULL, '1236547895', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, 277, NULL, 'images/user/78_156896893738890856.jpg', NULL, NULL, 'Web', '61.0.24.170', 5, 1, NULL, NULL, NULL, NULL, '2019-09-20 16:42:17', NULL, '', '', '', '', '2019-09-20 16:42:17', '2019-09-20 16:42:17'),
(130, 'Charles Philip Arthur George ', 'Mountbatten Windsor', NULL, NULL, 'charly@gmail.com', '$2y$10$j9GkdFv/g3.30MKQGXAyXOUW4DSgCmlMQU6iLaaul91bmLHtGvZBG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-29 23:32:28', '2019-09-29 23:32:28', 'App', '61.0.25.174', 3, 1, NULL, NULL, NULL, NULL, '2019-09-30 06:31:50', NULL, '', '', '', '', '2019-09-30 06:31:50', NULL),
(134, 'Neha', 'Soni', NULL, NULL, 'pari.soni1000@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/20191004104749000000.jpg', NULL, NULL, 'App', '61.0.25.174', 5, 1, NULL, NULL, NULL, NULL, '2019-10-04 10:47:49', NULL, 'cjdpKMaZsXU:APA91bGEip9GKOWc6nPe_SBX8u2COjwv8L4npg2eTAoFSmpEWPvIn-fMMmjzAHUEeuhSbjPANJ1Fcat2QG6H92fKpXObvHCg2JftdnaJk-Rv_YK55DIWtSN4bAPSlNoGYn7HQa02R-Do', 'IOS', 'fb', '2487364908163818', '2019-10-04 10:47:49', NULL),
(135, 'John', 'Cena', NULL, NULL, 'john1@gmail.com', '$2y$10$AhG29IxJZn5ZKnflHNrZn.x591u1gx1ftDqi04bl6.1DxWXfTsdV2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.174', 3, 1, NULL, NULL, NULL, NULL, '2019-10-04 11:14:59', NULL, '', '', '', '', '2019-10-04 11:14:59', NULL),
(136, 'John', 'Cena', NULL, NULL, 'john3@gmail.com', '$2y$10$qz29.NcegrSS6ysJiUQsNeeu6giDOSSGCBzTtV9kEiViV6BAczhkC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-04 04:15:34', '2019-10-04 04:15:34', 'App', '61.0.25.174', 3, 1, NULL, NULL, NULL, NULL, '2019-10-04 11:15:09', NULL, 'dXNPai_0Og0:APA91bFIi9TNpEz_LCdG9isfh7rMhLNBFCErvWXLTizg3G0OAhDZpB7yWWJ6wSyUBCPT0z0KXKNg5WMxGWzKCDr2C8gy9XliUZo2GkXh4dIDXoUWqMx0RiMlvJJYYDudc534TumvO26h', 'Android', '', '', '2019-10-04 11:15:09', NULL),
(137, 'Jaden', 'Jace', NULL, NULL, 'jace@gmail.com', '$2y$10$5linG4ubCDUeEwUDEe9FzeJBHEdi0oNfwSNcSG2eUkE9OmO60Pi8e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-04 04:20:18', '2019-10-04 04:20:18', 'App', '61.0.25.174', 3, 1, NULL, NULL, NULL, NULL, '2019-10-04 11:20:04', NULL, 'eNrR1O3ieiQ:APA91bFo_KK3pClpFNyTkvrNp3jK3E8pClhGsof76iwJQ_OHppRRwxegV6m_qnjTtJT8_LDSV2bBJCGNUrUqeoRZDM6PsvJGPCR287972xj8vRMg258wffw-_fZ5jyVFvQtfHFDiv60Q', 'IOS', '', '', '2019-10-04 11:20:04', NULL);
INSERT INTO `ka_users` (`user_id`, `first_name`, `last_name`, `school_name`, `school_level_id`, `email`, `password`, `school_id`, `class_id`, `grade_id`, `phone`, `whatsapp`, `gender`, `eye_color`, `height_in_meter`, `height_in_inche`, `weight`, `hair_color`, `date_of_birth`, `comment`, `bio`, `principal_first_name`, `principal_last_name`, `principal_email`, `principal_phone`, `school_motto`, `core_values`, `short_description`, `address`, `country_id`, `state_id`, `city_id`, `zipcode`, `photo`, `last_login_date`, `current_login_date`, `created_type`, `ip_address`, `role_id`, `status`, `is_show_club_notification`, `club_notification_update_date`, `is_show_class_notification`, `class_notification_update_date`, `email_verified_at`, `remember_token`, `fcm_token`, `device_type`, `social_type`, `social_id`, `created_at`, `updated_at`) VALUES
(138, 'Kirti', 'Jain', NULL, NULL, 'kirti.jain0702@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/20191004112713000000.jpg', NULL, NULL, 'App', '61.0.25.174', 3, 1, NULL, NULL, NULL, NULL, '2019-10-04 11:27:13', NULL, 'csBoymN-HGw:APA91bFJFITVIfBJK3nVlkZ_ZoX0TqytK5c7tlTpFoMDubyU0T5Vlxa5ckiWNc-BoA0zZTWYVT9Q5rrNyw5QT6Uos6-4auRkaAa-w2PtwsnBbXXBv5brSJrdP1qBb7HY-6Xl3Wy6nzwM', 'Android', 'fb', '413742389330965', '2019-10-04 11:27:13', NULL),
(139, 'Abraham', 'James', NULL, NULL, 'amaya@gmail.com', '$2y$10$.i6CyYmJLOMsoi3P1xAj1u04q0IMOTDvo/pp0JsMAchK7XQPlykiC', 16, 11, 8, '2348023010335', '2348023010335', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'great and smart', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'adddress', NULL, 35, 741, NULL, 'images/user/2019121315058000000.jpg', '2019-12-14 07:47:47', '2019-12-13 13:05:20', 'App', '61.0.31.246', 3, 1, 1, '2019-11-25 16:56:32', 1, '2019-11-25 16:56:32', '2019-10-04 11:29:05', 'nLactz9AXwsVp40jjUBPSVVIhBR8XQDSQU5xMKsCJ4qZtKKVDKp7PjBHNWbg', '', '', '', '', '2019-10-04 11:29:05', '2019-12-13 21:50:58'),
(141, 'Noah', 'Abby', NULL, NULL, 'abby@gmail.com', '$2y$10$2HVB5DsX1kvYgCWSfwM2Cetoj15ztfb/tV3.pWf1VyxYCqVJBbw6y', 16, 24, 22, '323223232', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'great and smart', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-04 05:02:45', '2019-10-04 05:02:45', 'App', '61.0.25.174', 3, 1, 1, '2019-10-04 05:07:49', NULL, NULL, '2019-10-04 12:01:57', NULL, 'eDIlQNzWpkE:APA91bGEMCdZs6bZMJJ9rLy2MICVy9xSlRj_Vjt1fNzPGLEno5BQ4EKQ8DmuKpQGJ3ABvF4tSQYqG0YtioxzbdRsqEnQTk_8jIYpr4TN4Z40Gz4bqOPjmC95wS5H5Fbd55KAA0YBadh3', 'IOS', '', '', '2019-10-04 12:01:57', '2019-10-21 20:22:58'),
(142, 'Liam', 'Ava', NULL, NULL, 'ava@gmail.com', '$2y$10$bq5esLhD7jFK4mfugk6ZEe3d1t5dwNfrGhKr6TCwzp.UDWY/EpGVm', 16, 10, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/user_1525631053.jpg', '2019-10-04 05:20:01', '2019-10-04 05:20:01', 'App', '61.0.25.174', 5, 1, NULL, NULL, NULL, NULL, '2019-10-04 12:19:17', NULL, 'dA913kQJ71A:APA91bFi7q5hicGZSg3FrRpHoqYZbti1_UQn-swuC5TVEb6UbNPIY-v0X_J0J11xGazYdlBfjIEvRhPaZo7y5NZa9bxAVCvU-IDNc27ekzS74qgM4SzRVAZ8kqLSl7xRBQC_xHQ62NGV', 'IOS', '', '', '2019-10-04 12:19:17', NULL),
(143, 'Lucas', 'Elijah', NULL, NULL, 'Lucas@gmail.com', '$2y$10$bq5esLhD7jFK4mfugk6ZEe3d1t5dwNfrGhKr6TCwzp.UDWY/EpGVm', 16, 11, 8, '(123) 654-7895', '7700900360', 1, NULL, NULL, NULL, NULL, NULL, '1985-08-07', NULL, 'smart and intelligent', NULL, NULL, NULL, NULL, NULL, NULL, 'A good school for children', '8 Victoria Drive, Southend-On-Sea, SS3 0AT', 1, 6, 113, '900001', 'images/user/53_15708561411867079124.jpg', '2019-12-16 10:38:47', '2019-10-16 14:20:18', 'Web', '61.0.25.174', 5, 1, NULL, NULL, 1, '2019-10-15 04:12:49', '2019-10-04 20:42:03', NULL, 'eAuPVmYMyD4:APA91bF8LfvC6SdWLUKGbAdciPctRKGip6-MwrvHeUtGbyZKpPzn1_9hQvZiCaupHlQaBTHVzqHKXM0eDzlGDgEisSGQM4w9JpF7DrIJ9mlq_gUNbm0k3ZYiQg44GaVM4jZ6FoYB1U4F', 'IOS', '', '', '2019-10-04 20:42:03', '2019-10-12 12:55:41'),
(144, 'Olivia', 'Baytown', NULL, NULL, 'baytown@gmail.com', '$2y$10$JumWOXR/4alF/4wIWBDbmuI4TwPG7mzSr/DAjOTrueNYeIisIQbc6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.25.174', 5, 1, NULL, NULL, NULL, NULL, '2019-10-04 12:43:18', NULL, '', '', '', '', '2019-10-04 12:43:18', NULL),
(145, 'Manveer', 'Singh', NULL, NULL, 'manveersingh0@gmail.com', '$2y$10$h5dr/X1CJFqCDuEQwVp4feBvfN7GwfguD64pQGIhu74prd5E5thhq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/2019100412237000000.jpg', NULL, NULL, 'App', '61.0.25.174', 3, 1, NULL, NULL, NULL, NULL, '2019-10-04 13:22:37', NULL, 'cb3THs66opg:APA91bHY6xCJ8tCO8HY3rrh5D8Nq0TOVXPU9W4xPO2ZleHRLdWgDNEpDotk4K-keohXUydTEpMHTPeCosm4clCl4rKxVG5GeZQf1FZp3efBe5aVz6ANbxPDBaThQ2EcI8lrGeATmuE1K', 'IOS', 'fb', '2455753661128246', '2019-10-04 13:22:37', NULL),
(146, 'Robert', 'Davis', NULL, NULL, 'james@bond.com', '$2y$10$MKBI9/WjgYn3QsqMJnnUHuw4adwhocPxTLZhkbTIMqpwvawhjlep2', 16, NULL, NULL, '(123) 654-7895', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 10:27:15', '2019-10-08 00:09:26', 'Web', '61.0.27.116', 6, 1, NULL, NULL, 1, '2019-12-14 07:37:55', '2019-10-08 15:00:58', NULL, '', '', '', '', '2019-10-08 15:00:58', '2019-10-08 15:06:08'),
(147, 'Samuel', 'Okoro', 'Honeywell Group of Schools', 1, 'admin@honeywellshools.com', '$2y$10$fR2lHKTgGsQTf3R3g4sYIOGInfScqR2QIjvwhJuVT0fxfkxIsKuAa', NULL, NULL, NULL, '2347098352222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Kathy', 'Akande', 'mrsakande@honeywell.com', '234 803 563 8932', 'Education is strength', 'Promote moral value', 'A standard school for children', '21 Muyibat Oyefusi Cr', 1, 25, 516, '234', NULL, NULL, NULL, 'Web', '70.115.144.175', 2, 1, NULL, NULL, NULL, NULL, '2019-10-09 00:57:08', NULL, '', '', '', '', '2019-10-09 00:57:08', '2019-10-09 00:57:08'),
(148, 'Mike', 'Adenuga', NULL, NULL, 'nugamike@honeywellschoo.com', '$2y$10$97jOpC5N6Rhl6OFdzN3Zs.6OPbjiHwyhbt0RpSWRxjTyByM9Um4u2', 147, 20, 20, '234 7067457888', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'smart and intelligent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Web', '70.115.144.175', 3, 1, NULL, NULL, NULL, NULL, '2019-10-09 02:12:08', NULL, '', '', '', '', '2019-10-09 02:12:08', '2019-10-21 20:23:34'),
(149, 'Sophia', 'John', NULL, NULL, 'sophia@gmail.com', '$2y$10$S8/ZCL6d8JyjBNbQcgxSyuZtnmey9DnSBB6ftmLuehgY1cddirggK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-10 04:56:58', '2019-10-10 04:56:58', 'App', '61.0.28.224', 3, 1, NULL, NULL, NULL, NULL, '2019-10-10 10:59:45', NULL, 'd9t5PGtfJZw:APA91bF4TQvU73CRzc8w-AZUxD1ePhfq3kPsgLTjBgm2K45G2b59nsfo7Bm1bPYRvuA_Ig6ua45ROiMC-xnZqVT1dL8u2Z8dSQQBMJr7LgApoxTKEbJk6pwztGR8e2q0vGSWx1HO8jmF', 'IOS', '', '', '2019-10-10 10:59:45', NULL),
(150, 'Teacher1', 'Teacher', NULL, NULL, 'test@teacher.com', '$2y$10$dlzpFJvjVzImgjkF02Uh4OAvR6N4u5JgzY1K6yRYymjcIUIdfdXRu', 16, 24, 8, '1231231231', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Experience is quite cool.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/picture1_1551810784_1570775364791791212.png', NULL, NULL, 'Web', '103.239.146.10', 3, 1, NULL, NULL, NULL, NULL, '2019-10-11 14:29:23', NULL, '', '', '', '', '2019-10-11 14:29:24', '2019-10-21 20:22:14'),
(151, 'Christopher', 'Mobo', NULL, NULL, 'stveamillion@gmail.com', '$2y$10$A.MtldEKcQRl88rZYdydNer48.ag7s0DhOKuoKxKJyNlcy5sBb2nm', 16, 13, 9, '123121231', NULL, 1, 'Brown', '6', '2', '40', 'Brown', '2000-08-23', 'Thanks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/2_1571003891981375804.png', NULL, NULL, 'Web', '103.239.146.10', 4, 1, NULL, NULL, NULL, NULL, '2019-10-11 14:46:07', NULL, '', '', '', '', '2019-10-11 14:46:07', '2019-10-14 05:58:11'),
(152, 'Lucy', 'Wonder', NULL, NULL, 'luwonder@honeywellschools.com', '$2y$10$RV29/ugBBr2n6msTcWLR7Oz7FfNY6KSItYl2AxzKoHHxoyPnOjCcy', 147, 27, 23, '2348087007905', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'God fearing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/img_0421.jpg', NULL, NULL, 'Web', '70.115.144.175', 3, 1, NULL, NULL, NULL, NULL, '2019-10-15 06:36:59', NULL, '', '', '', '', '2019-10-15 06:37:00', '2019-11-10 07:31:55'),
(153, 'Luke', 'Mark', NULL, NULL, 'mikeson@yahoo.com', '$2y$10$6vzS./YifAq38D9VrMvmtOqdhAsG7p/xihQRMvgoUCIiWpN0hYYBG', 147, 19, 20, '2347084356732', NULL, 1, 'Brown', '6', '5', '36', 'Brown', '2000-08-23', 'Hard worker', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/f6529c95-00d9-4a0f-9921-0b2b7e53f4b1_15710928165498011.jpg', NULL, NULL, 'Web', '70.115.144.175', 4, 1, NULL, NULL, NULL, NULL, '2019-10-15 06:40:16', NULL, '', '', '', '', '2019-10-15 06:40:16', '2019-10-15 06:40:16'),
(154, 'Olivia', 'Emma', NULL, NULL, 'emavia@gmail.com', '$2y$10$5/JJi6moPL5HDnHFYEBXWuK8LThwyi5zE4N7bb5/Sd9oJrIMljbQm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-15 05:07:20', '2019-10-15 05:07:20', 'App', '61.0.24.173', 3, 1, NULL, NULL, NULL, NULL, '2019-10-15 12:03:27', NULL, 'eCqhR6j3v4c:APA91bEF3IOoiG7PyweeU9aAtr8ofN_OQCwbbu5aoH0t1nBOnHx6skBLUadhgOEy4oGll00CU6AvvwNk5X0pkp5ITa-Q1qzP0fNL5ZHL2UYhBTmTa1mRvNkNG3FZfm-eyAxMRVC8gdP-', 'IOS', '', '', '2019-10-15 12:03:27', NULL),
(155, 'Peter', 'Mark', NULL, NULL, 'pmark123@yahoo.com', '$2y$10$r.OWUJJ7R8iIUT0jFsc7E.4SMi8y2RJdySKPmXMABpSSq2mVXrQY2', 147, NULL, NULL, '2348078975563', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 25, 516, NULL, 'images/user/img_0399.jpg', NULL, NULL, 'Web', '70.115.144.175', 5, 1, NULL, NULL, NULL, NULL, '2019-10-15 21:20:23', NULL, '', '', '', '', '2019-10-15 21:20:24', '2019-11-10 07:32:49'),
(156, 'Peter', 'Mark', NULL, NULL, 'pmark@yahoo.com', '$2y$10$Sxes/H8WHpNfsdriFY/cdu3hYrdsqlQnqOMqeaFnKxLPZ8ndCqtva', 147, NULL, NULL, '2348083457882', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/img_0399.jpg', NULL, NULL, 'Web', '70.115.144.175', 6, 1, NULL, NULL, NULL, NULL, '2019-10-16 23:17:33', NULL, '', '', '', '', '2019-10-16 23:17:33', '2019-10-16 23:17:33'),
(157, 'Luke', 'Mark', NULL, NULL, 'maluke2014@gmail.com', '$2y$10$2ZqDNgykF.ZdV4./GlMpFeTkc8u1CxT1rt4ein9Pz3PNLWmbEpfPG', 16, 13, 9, '2348086784532', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Web', '70.115.144.175', 4, 1, NULL, NULL, NULL, NULL, '2019-10-20 02:11:32', NULL, '', '', '', '', '2019-10-20 02:11:33', '2019-10-20 02:11:33'),
(158, 'Lucy', 'Wonder', NULL, NULL, 'luwonder@gmail.com', '$2y$10$7JyC4eWH5ouMRJ7eUoXZ5.6AdidtoL0LFnDYvviboC91rYTGjjy2G', 16, 13, 9, '2348035635632', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'great and smart', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Web', '70.115.144.175', 3, 1, NULL, NULL, NULL, NULL, '2019-10-20 02:52:44', NULL, '', '', '', '', '2019-10-20 02:52:45', '2019-10-20 02:52:45'),
(159, 'Peter', 'Mark', NULL, NULL, 'pmark@gmail.com', '$2y$10$Ntm4d2fm5RcsrcownsV7nuWqbKqhjhxkkHdwq4SgvpoFV1Kf.keOS', 16, NULL, NULL, '2347036748844', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 25, 516, NULL, NULL, NULL, NULL, 'Web', '70.115.144.175', 5, 1, NULL, NULL, NULL, NULL, '2019-10-20 02:56:20', NULL, '', '', '', '', '2019-10-20 02:56:20', '2019-10-20 02:56:20'),
(160, 'Peter', 'Mark', NULL, NULL, 'pmark123@gmail.com', '$2y$10$S5LIFQQfcsBb9x4Sfu6pSeoSaJyvambE0GHN6dsgu1CMFgbu0qDfi', 16, NULL, NULL, '2347084568844', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Web', '70.115.144.175', 6, 1, NULL, NULL, NULL, NULL, '2019-10-20 02:57:58', NULL, '', '', '', '', '2019-10-20 02:57:58', '2019-10-20 02:57:58'),
(162, 'John ', 'Cena', NULL, NULL, 'john4@gmail.com', '$2y$10$Mr9vu0NoqOVe/iT4b42goOb5uh.hAogI4UNIA1q6VcKwvLWdftqpe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'App', '61.0.28.15', 5, 1, NULL, NULL, NULL, NULL, '2019-10-24 18:54:37', NULL, '', '', '', '', '2019-10-24 18:54:37', NULL),
(163, 'John ', 'Cena', NULL, NULL, 'john5@gmail.com', '$2y$10$Uf2UfK6oxPyn51OoxFjSxuOyal/DPVNtfaJqWv3RNM.DP8NSJA3ZK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-24 11:57:42', NULL, 'App', '61.0.28.15', 5, 1, NULL, NULL, NULL, NULL, '2019-10-24 18:54:46', NULL, 'faP8yfByTMI:APA91bFo6EbWSckxABPiYh_RTvT9RdfwJVXEItrMVHq6x5CCXs-gknJX-NhsJZBWnuMCwqn2TH771coYlGSBA8ivhvvPL9N3fxQHKo78JgtxkqXXMkmC5ZSC18J9ZMfGcpo0ts6Afnzq', 'Android', '', '', '2019-10-24 18:54:46', NULL),
(164, 'John', 'Carter', NULL, NULL, 'john.carter@gmail.com', '$2y$10$z4IZtnsDv8fLaVrsSN5iyOBRDXowrj6nltXtW1INeYbqV7Q3kEHea', 16, 11, 8, '9874563210', '9874563210', 1, 'blue', '5', '7', '45', 'brown', '2019-11-04', 'Good in english', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/images_15743524122131929036.jpg', NULL, NULL, 'Web', '106.207.166.151', 4, 1, NULL, NULL, NULL, NULL, '2019-11-21 23:26:26', NULL, '', '', '', '', '2019-11-21 23:26:26', '2019-11-22 00:14:44'),
(165, 'Cwiser', 'Developer', NULL, NULL, 'cwiserdeveloper@gmail.com', '$2y$10$m1yDYR/jcuEJd3VegDs3MONr.n0RaoBsIcWbjhknYcZZkL0Wz4N0a', 16, NULL, NULL, '98566652553', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/john-doe_15749302332052107344.jpg', '2019-12-11 03:17:31', NULL, 'Web', '103.239.146.10', 3, 1, NULL, NULL, NULL, NULL, '2019-11-28 16:37:13', 'IUq7SV2WFnQfDxyymZ1IziQsuj5b8WfzbVreZEW8YA5v9XXwv6HyDIPNqzaw', 'euU-XdqCHvg:APA91bEnCN4CLHlOG1PrR0We71EjXf5f_e-RqkIaz6bR4SsrwrX_hNJ3J8T9vcwJGbOISi5mcRgg341vYpHNVOV-6qQoU2Mx9rYBQQoyTPTLEXT-yPX144eq7h1Jf20ZON-3GEVsCJ1M', 'IOS', '', '', '2019-11-28 16:37:13', '2020-01-01 01:34:31'),
(166, 'Evelyn', 'Atkinson', NULL, NULL, 'Evelyn@gmail.com', '$2y$10$pZnRzMUd60z45qdt7f.buORNi.RV9Qp7MVYCz79PSM5IkVzfTCdc2', NULL, 11, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/15743424122131925654.jpg', NULL, NULL, 'App', '103.250.189.148', 5, 1, NULL, NULL, NULL, NULL, '2019-12-13 19:31:25', NULL, '', '', '', '', '2019-12-13 19:31:25', NULL),
(167, 'Zoe', 'Booth', NULL, NULL, 'zoe@gmail.com', '$2y$10$pZnRzMUd60z45qdt7f.buORNi.RV9Qp7MVYCz79PSM5IkVzfTCdc2', 16, 11, 8, '8874563210', '8874563210', 1, 'blue', '5', '5', '47', 'brown', '2010-11-04', 'Good in technology', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Web', '106.207.166.151', 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '2019-12-13 22:26:26', '2019-12-13 22:26:26'),
(168, 'John', 'Roni', NULL, NULL, 'Jonsroni@gmail.com', '$2y$10$EHdceNRxzaK1IAJYNObpneIsvT43BUGAiIZNX8XHuSrSrhLUmN7OS', 16, 10, 8, '9876549870', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Web', '127.0.0.1', 4, 1, NULL, NULL, NULL, NULL, '2020-01-03 06:47:11', NULL, '', '', '', '', '2020-01-03 06:47:11', '2020-01-03 06:47:11'),
(169, 'Norris', 'Griffin', NULL, NULL, 'norrisgriffin@gmail.com', '$2y$10$TeoKKN5Wb/FJXIj7.PHTseuZeP3iBjVVE64yzE.jF5WJVlODLSxym', 16, 10, 8, '9876542311', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Web', '127.0.0.1', 4, 1, NULL, NULL, NULL, NULL, '2020-01-03 07:14:41', NULL, '', '', '', '', '2020-01-03 07:14:41', '2020-01-03 07:14:41'),
(170, 'Chadwick', 'King', NULL, NULL, 'chadwickking@gmail.com', '$2y$10$dVV9B2G6OMCE1O.qe2CwiOrW01ePpklAcHtEBfFUDghzX26sGUU2u', 16, 10, 8, '9876543211', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Web', '127.0.0.1', 4, 1, NULL, NULL, NULL, NULL, '2020-01-03 07:25:26', NULL, '', '', '', '', '2020-01-03 07:25:26', '2020-01-03 07:25:26'),
(171, 'Jana', 'Dubois', NULL, NULL, 'jared1970@gmail.com', '$2y$10$YJSs7PVYndMxXOEC0vSOV.rhRhYyESo4RjY0QW7y69kIgn.OEBZoy', 16, 10, 8, '9876543210', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/penguins_15783146091077045218.jpg', NULL, NULL, 'Web', '127.0.0.1', 4, 1, NULL, NULL, NULL, NULL, '2020-01-06 08:13:29', NULL, '', '', '', '', '2020-01-06 08:13:30', '2020-01-06 08:13:30'),
(172, 'Drew', 'Thomas', NULL, NULL, 'loma_schuli@hotmail.com', '$2y$10$QrrhqI4wGpyC0PfwXyzZZuIbjtZtBxCWcxygk1xVtI.X2E3Z5jHHe', 16, 10, 8, '6549876541', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/hydrangeas_157831478426936101.jpg', NULL, NULL, 'Web', '127.0.0.1', 5, 1, NULL, NULL, NULL, NULL, '2020-01-06 08:16:24', NULL, '', '', '', '', '2020-01-06 08:16:24', '2020-01-06 08:16:24'),
(173, 'Michael', 'Ouellette', NULL, NULL, 'charley1986@gmail.com', '$2y$10$f9JktSbOeju7ZxHBEHS4sut8w5dLXm.MXmY9PkVaamKfe7zJFQwTC', 16, 10, 8, '5869456789', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/lighthouse_15783147861854675374.jpg', NULL, NULL, 'Web', '127.0.0.1', 4, 1, NULL, NULL, NULL, NULL, '2020-01-06 08:16:24', NULL, '', '', '', '', '2020-01-06 08:16:26', '2020-01-06 08:16:26'),
(174, 'Caroline', 'Chapman', NULL, NULL, 'warren2001@yahoo.com', '$2y$10$Hw7ivsSURIFe5Y9NXVh/y.eUAcmZBwXgiJ7MjgerIM/biD0QLSn2i', 16, 10, 8, '9876543210', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/lighthouse_1578316899739543034.jpg', NULL, NULL, 'Web', '127.0.0.1', 4, 1, NULL, NULL, NULL, NULL, '2020-01-06 08:51:39', NULL, '', '', '', '', '2020-01-06 08:51:39', '2020-01-06 08:51:39'),
(175, 'John', 'Wynn', NULL, NULL, 'samanta_feen@yahoo.com', '$2y$10$5eLS75woccJb6DpqcNQJHumToGrToSfjL4qDidmIMocgwvSgsnLw.', 16, 10, 8, '9876543214', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 'images/user/lighthouse_1578317006444269412.jpg', NULL, NULL, 'Web', '127.0.0.1', 5, 1, NULL, NULL, NULL, NULL, '2020-01-06 08:53:26', NULL, '', '', '', '', '2020-01-06 08:53:26', '2020-01-06 08:53:26'),
(176, 'William', 'Norris', NULL, NULL, 'jazlyn1975@hotmail.com', '$2y$10$CqGM/og8/aT52yeA.ecSIegMxom8iIzYoiBg9knjlqlb/llIXBOO.', 16, 10, 8, '9876543214', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'images/user/penguins_15783170071965268368.jpg', NULL, NULL, 'Web', '127.0.0.1', 4, 1, NULL, NULL, NULL, NULL, '2020-01-06 08:53:26', NULL, '', '', '', '', '2020-01-06 08:53:28', '2020-01-06 08:53:28'),
(177, 'Adam', 'Shaul', NULL, NULL, 'mariana1973@gmail.com', '$2y$10$9e1lUSiYK1BZgWvdQ3HjN.VwQuDktzKY9IGJpdY9xReAMIMY1ALHC', 16, 10, 8, '9876543210', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Web', '127.0.0.1', 4, 1, NULL, NULL, NULL, NULL, '2020-01-07 01:45:58', NULL, '', '', '', '', '2020-01-07 01:45:58', '2020-01-07 01:45:58'),
(179, 'Mark', 'Todd', NULL, NULL, 'cullen2012@yahoo.com', '$2y$10$SyoBiyTPoI388oTGTxIBIuVJCjFKgbRVSSKifdF8goTnX8cW58I5K', 16, 10, 8, '9876543210', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Web', '127.0.0.1', 4, 1, NULL, NULL, NULL, NULL, '2020-01-07 02:15:13', NULL, '', '', '', '', '2020-01-07 02:15:16', '2020-01-07 02:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `ka_user_block_list`
--

CREATE TABLE `ka_user_block_list` (
  `user_block_list_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `block_user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_user_block_list`
--

INSERT INTO `ka_user_block_list` (`user_block_list_id`, `user_id`, `block_user_id`, `created_at`, `updated_at`) VALUES
(3, 143, 142, '2019-10-15 11:22:09', '2019-10-15 11:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `ka_user_club`
--

CREATE TABLE `ka_user_club` (
  `user_club_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `club_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_user_club`
--

INSERT INTO `ka_user_club` (`user_club_id`, `user_id`, `club_id`, `created_at`, `updated_at`) VALUES
(1, 27, 4, '2019-07-17 13:45:34', '2019-07-17 13:45:34'),
(2, 38, 3, '2019-08-02 19:43:14', '2019-08-02 19:43:14'),
(4, 112, 4, '2019-09-04 14:51:25', '2019-09-04 14:51:25'),
(6, 123, 4, '2019-09-18 14:10:35', '2019-09-18 14:10:35'),
(7, 125, 4, '2019-09-20 14:49:59', '2019-09-20 14:49:59'),
(8, 124, 3, '2019-10-14 05:43:44', '2019-10-14 05:43:44'),
(10, 153, 6, '2019-10-16 21:20:07', '2019-10-16 21:20:07'),
(11, 152, 6, '2019-10-16 23:07:30', '2019-10-16 23:07:30'),
(12, 20, 4, '2019-10-17 13:16:24', '2019-10-17 13:16:24'),
(14, 107, 4, '2019-10-17 13:27:08', '2019-10-17 13:27:08'),
(15, 139, 3, '2019-10-22 18:30:10', '2019-10-22 18:30:10'),
(16, 164, 4, '2019-11-22 00:07:07', '2019-11-22 00:07:07'),
(17, 19, 3, '2019-12-12 06:13:02', '2019-12-12 06:13:02'),
(18, 151, 4, '2019-12-16 14:10:49', '2019-12-16 14:10:49'),
(19, 139, 4, '2019-12-16 14:10:49', '2019-12-16 14:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `ka_user_pick_up_and_drop_off`
--

CREATE TABLE `ka_user_pick_up_and_drop_off` (
  `user_pick_up_and_drop_off_id` int(10) UNSIGNED NOT NULL,
  `pick_up_or_drop_off_id` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 => Pick-up, 2 => Drop-off ',
  `user_id` int(10) UNSIGNED NOT NULL,
  `pick_up_and_drop_off_user_id` int(10) UNSIGNED DEFAULT NULL,
  `relationship` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transportation_purpose` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `minute` int(11) DEFAULT NULL,
  `created_user_id` int(10) UNSIGNED DEFAULT NULL,
  `pickup_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ka_user_pick_up_and_drop_off`
--

INSERT INTO `ka_user_pick_up_and_drop_off` (`user_pick_up_and_drop_off_id`, `pick_up_or_drop_off_id`, `user_id`, `pick_up_and_drop_off_user_id`, `relationship`, `transportation_purpose`, `date`, `hour`, `minute`, `created_user_id`, `pickup_code`, `created_at`, `updated_at`) VALUES
(1, '1', 26, 3, 'replationship', 'purpose', '2019-07-17', 5, 25, 21, '', '2019-07-17 07:09:01', NULL),
(2, '1', 26, 4, 'relationship', 'transpottation', '2019-07-17', 5, 50, 114, '', '2019-09-05 10:57:50', NULL),
(3, '1', 19, 5, 'relationship', 'transpottation', '2019-07-17', 5, 50, 114, '', '2019-09-05 11:13:50', NULL),
(4, '1', 19, 6, 'relationship', 'transpottation', '2019-07-17', 5, 50, 114, '', '2019-09-05 12:49:15', NULL),
(5, '1', 19, 7, 'th', 'ty', '2019-10-06', 5, 30, 117, '', '2019-09-05 12:59:34', NULL),
(6, '1', 19, 8, 'js', 'hs', '2019-10-06', 5, 30, 117, '', '2019-09-05 13:03:29', NULL),
(7, '1', 19, 9, 'hs', 'zh', '2019-10-06', 5, 30, 117, '', '2019-09-05 13:04:57', NULL),
(8, '1', 19, 10, 'hs', 'zh', '2019-10-06', 5, 30, 117, '', '2019-09-05 13:05:00', NULL),
(9, '1', 19, 11, 'hs', 'zh', '2019-10-06', 5, 30, 117, '', '2019-09-05 13:05:01', NULL),
(10, '1', 19, 12, 'hs', 'zh', '2019-10-06', 5, 30, 117, '', '2019-09-05 13:05:02', NULL),
(11, '1', 19, 13, 'hsjs', 'shsjs', '2019-10-06', 5, 30, 117, '', '2019-09-05 13:06:36', NULL),
(12, '1', 19, 14, 'shsjsjs', 'hsjsjs', '2019-10-06', 5, 30, 117, '', '2019-09-06 04:41:57', NULL),
(13, '1', 19, 15, 'relationship', 'transpottation', '2019-07-17', 5, 50, 114, '', '2019-09-06 04:42:31', NULL),
(14, '1', 19, 16, 'shsjsjs', 'hsjsjs', '2019-10-06', 5, 30, 117, '', '2019-09-06 04:43:02', NULL),
(15, '1', 19, 17, 'jsjsj', 'jsjsjs', '2019-10-06', 5, 30, 117, '', '2019-09-06 04:56:39', NULL),
(16, '1', 19, 18, 'jajjaajajajaja', 'jajajajjaja', '2019-10-06', 5, 30, 117, '', '2019-09-06 05:12:23', NULL),
(17, '2', 19, 19, 'that t6g6g6g', 'tight of g6fyvyvyvyv', '2019-10-06', 5, 30, 117, '', '2019-09-06 05:18:58', NULL),
(21, '1', 26, 21, 'relationship', 'transpottation', '2019-07-17', 5, 50, 21, '', '2019-09-17 07:32:34', NULL),
(26, '1', 112, 25, 'daughter ', 'e.g. Look out for a black \nToyota Prado', '2019-09-19', 8, 20, 121, '', '2019-09-19 11:53:45', NULL),
(27, '1', 112, 25, 'daughter ', 'testing', '0000-00-00', 17, 25, 121, '', '2019-09-21 06:51:00', NULL),
(28, '1', 112, 25, 'daughter ', 'testingyxyx', '2019-09-22', 17, 25, 121, '', '2019-09-21 08:33:22', NULL),
(29, '1', 112, 25, 'daughter ', 'testingyxyx', '2019-09-02', 17, 25, 121, '', '2019-09-21 08:34:18', NULL),
(30, '1', 112, 25, 'daughter ', 'testingyxyx', '2019-10-16', 15, 20, 121, '', '2019-10-04 12:32:45', NULL),
(31, '1', 112, 26, 'daughter', 'Black toy to', '2019-10-06', 2, 30, 143, '', '2019-10-04 12:48:00', NULL),
(32, '1', 19, 26, 'daughter', 'Black toy to', '2019-10-06', 2, 30, 143, '', '2019-10-15 11:13:47', NULL),
(33, '1', 26, 27, 'relationship', 'transpottation', '2019-07-17', 5, 50, 21, 'krEM8334', '2019-10-18 16:11:41', NULL),
(34, '1', 26, 28, 'relationship', 'transpottation', '2019-07-17', 5, 50, 21, 'krEM4092', '2019-10-18 16:16:38', NULL),
(35, '1', 26, 29, 'relationship', 'transpottation', '2019-07-17', 5, 50, 21, 'krEM5451', '2019-10-18 16:19:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_09_30_051827_create_country_table', 1),
(2, '2014_10_01_000000_create_state_table', 1),
(3, '2014_10_02_000000_create_city_table', 1),
(4, '2014_10_11_000000_create_roles_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2019_03_02_100050_create_configuration_table', 1),
(7, '2019_03_18_090341_create_allergies_table', 1),
(8, '2019_06_14_051454_create_school_level_table', 1),
(9, '2019_06_14_061206_create_users_table', 1),
(10, '2019_06_14_061207_create_grade_table', 1),
(11, '2019_06_14_061208_create_class_table', 1),
(12, '2019_06_14_061210_create_club_table', 1),
(13, '2019_06_14_063716_create_student_allergies_table', 1),
(14, '2019_06_14_070431_create_student_parent_table', 1),
(15, '2019_06_14_073010_create_student_feed', 1),
(16, '2019_06_14_085204_create_exam_table', 1),
(17, '2019_06_14_085217_create_exam_result_table', 1),
(18, '2019_06_14_094723_create_message_table', 1),
(19, '2019_06_14_102217_create_notification_table', 1),
(20, '2019_06_14_121648_add_reference_in_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('cwiserdeveloper@gmail.com', '$2y$10$NmA742sRGclnQzpggLQKoOhYZr4.O6EathYTExy4yHHEOlQn2Kzuy', '2020-01-03 01:01:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ka_allergies`
--
ALTER TABLE `ka_allergies`
  ADD PRIMARY KEY (`allergie_id`);

--
-- Indexes for table `ka_city`
--
ALTER TABLE `ka_city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `ka_city_state_id_foreign` (`state_id`);

--
-- Indexes for table `ka_class`
--
ALTER TABLE `ka_class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `ka_class_school_id_foreign` (`school_id`),
  ADD KEY `ka_class_grade_id_foreign` (`grade_id`);

--
-- Indexes for table `ka_club`
--
ALTER TABLE `ka_club`
  ADD PRIMARY KEY (`club_id`),
  ADD KEY `ka_club_school_id_foreign` (`school_id`);

--
-- Indexes for table `ka_cms_page`
--
ALTER TABLE `ka_cms_page`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `ka_configuration`
--
ALTER TABLE `ka_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ka_country`
--
ALTER TABLE `ka_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `ka_email_template`
--
ALTER TABLE `ka_email_template`
  ADD PRIMARY KEY (`email_template_id`);

--
-- Indexes for table `ka_events`
--
ALTER TABLE `ka_events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `ka_events_school_id_foreign` (`school_id`);

--
-- Indexes for table `ka_event_and_notification`
--
ALTER TABLE `ka_event_and_notification`
  ADD PRIMARY KEY (`event_and_notification_id`),
  ADD KEY `ka_event_and_notification_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `ka_exam`
--
ALTER TABLE `ka_exam`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `ka_exam_user_id_foreign` (`created_user_id`),
  ADD KEY `ka_exam_school_id_foreign` (`school_id`);

--
-- Indexes for table `ka_exam_result`
--
ALTER TABLE `ka_exam_result`
  ADD PRIMARY KEY (`exam_result_id`),
  ADD KEY `ka_exam_result_exam_id_foreign` (`exam_id`),
  ADD KEY `ka_exam_result_school_id_foreign` (`user_id`),
  ADD KEY `ka_exam_result_created_user_id_foreign` (`created_user_id`);

--
-- Indexes for table `ka_grade`
--
ALTER TABLE `ka_grade`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `ka_grade_school_id_foreign` (`school_id`);

--
-- Indexes for table `ka_homework`
--
ALTER TABLE `ka_homework`
  ADD PRIMARY KEY (`homework_id`),
  ADD KEY `ka_homework_school_id_foreign` (`school_id`);

--
-- Indexes for table `ka_message`
--
ALTER TABLE `ka_message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `ka_message_sender_id_foreign` (`sender_id`),
  ADD KEY `ka_message_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `ka_notification`
--
ALTER TABLE `ka_notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `ka_notification_user_id_foreign` (`user_id`),
  ADD KEY `ka_notification_created_user_id_foreign` (`created_user_id`);

--
-- Indexes for table `ka_pick_up_and_drop_off_user`
--
ALTER TABLE `ka_pick_up_and_drop_off_user`
  ADD PRIMARY KEY (`pick_up_and_drop_off_user_id`);

--
-- Indexes for table `ka_roles`
--
ALTER TABLE `ka_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `ka_school_level`
--
ALTER TABLE `ka_school_level`
  ADD PRIMARY KEY (`school_level_id`);

--
-- Indexes for table `ka_state`
--
ALTER TABLE `ka_state`
  ADD PRIMARY KEY (`state_id`),
  ADD KEY `ka_state_country_id_foreign` (`country_id`);

--
-- Indexes for table `ka_student_allergies`
--
ALTER TABLE `ka_student_allergies`
  ADD PRIMARY KEY (`student_allergie_id`),
  ADD KEY `ka_student_allergies_user_id_foreign` (`user_id`),
  ADD KEY `ka_student_allergies_allergie_id_foreign` (`allergie_id`);

--
-- Indexes for table `ka_student_feed`
--
ALTER TABLE `ka_student_feed`
  ADD PRIMARY KEY (`student_feed_id`),
  ADD KEY `ka_student_feed_user_id_foreign` (`user_id`);

--
-- Indexes for table `ka_student_parent`
--
ALTER TABLE `ka_student_parent`
  ADD PRIMARY KEY (`student_parent_id`),
  ADD KEY `ka_student_parent_student_id_foreign` (`student_id`),
  ADD KEY `ka_student_parent_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `ka_users`
--
ALTER TABLE `ka_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `ka_users_email_unique` (`email`),
  ADD KEY `ka_users_role_id_foreign` (`role_id`),
  ADD KEY `ka_users_country_id_foreign` (`country_id`),
  ADD KEY `ka_users_state_id_foreign` (`state_id`),
  ADD KEY `ka_users_city_id_foreign` (`city_id`),
  ADD KEY `ka_users_school_id_foreign` (`school_id`),
  ADD KEY `ka_users_school_level_id_foreign` (`school_level_id`),
  ADD KEY `ka_users_class_id_foreign` (`class_id`),
  ADD KEY `ka_users_grade_id_foreign` (`grade_id`);

--
-- Indexes for table `ka_user_block_list`
--
ALTER TABLE `ka_user_block_list`
  ADD PRIMARY KEY (`user_block_list_id`),
  ADD KEY `ka_user_block_list_user_id_foreign` (`user_id`),
  ADD KEY `block_user_id` (`block_user_id`);

--
-- Indexes for table `ka_user_club`
--
ALTER TABLE `ka_user_club`
  ADD PRIMARY KEY (`user_club_id`),
  ADD KEY `ka_user_club_user_id_foreign` (`user_id`),
  ADD KEY `ka_user_club_club_id_foreign` (`club_id`);

--
-- Indexes for table `ka_user_pick_up_and_drop_off`
--
ALTER TABLE `ka_user_pick_up_and_drop_off`
  ADD PRIMARY KEY (`user_pick_up_and_drop_off_id`),
  ADD KEY `ka_user_pick_up_and_drop_off_user_id_foreign` (`user_id`),
  ADD KEY `pick_up_and_drop_off_user_id_foreign` (`pick_up_and_drop_off_user_id`),
  ADD KEY `ka_user_pick_up_and_drop_off_created_user_id_foreign` (`created_user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ka_allergies`
--
ALTER TABLE `ka_allergies`
  MODIFY `allergie_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ka_city`
--
ALTER TABLE `ka_city`
  MODIFY `city_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=775;

--
-- AUTO_INCREMENT for table `ka_class`
--
ALTER TABLE `ka_class`
  MODIFY `class_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ka_club`
--
ALTER TABLE `ka_club`
  MODIFY `club_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ka_cms_page`
--
ALTER TABLE `ka_cms_page`
  MODIFY `page_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ka_configuration`
--
ALTER TABLE `ka_configuration`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ka_country`
--
ALTER TABLE `ka_country`
  MODIFY `country_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ka_email_template`
--
ALTER TABLE `ka_email_template`
  MODIFY `email_template_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ka_events`
--
ALTER TABLE `ka_events`
  MODIFY `event_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ka_event_and_notification`
--
ALTER TABLE `ka_event_and_notification`
  MODIFY `event_and_notification_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ka_exam`
--
ALTER TABLE `ka_exam`
  MODIFY `exam_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ka_exam_result`
--
ALTER TABLE `ka_exam_result`
  MODIFY `exam_result_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `ka_grade`
--
ALTER TABLE `ka_grade`
  MODIFY `grade_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ka_homework`
--
ALTER TABLE `ka_homework`
  MODIFY `homework_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ka_message`
--
ALTER TABLE `ka_message`
  MODIFY `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `ka_notification`
--
ALTER TABLE `ka_notification`
  MODIFY `notification_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ka_pick_up_and_drop_off_user`
--
ALTER TABLE `ka_pick_up_and_drop_off_user`
  MODIFY `pick_up_and_drop_off_user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ka_roles`
--
ALTER TABLE `ka_roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ka_school_level`
--
ALTER TABLE `ka_school_level`
  MODIFY `school_level_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ka_state`
--
ALTER TABLE `ka_state`
  MODIFY `state_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `ka_student_allergies`
--
ALTER TABLE `ka_student_allergies`
  MODIFY `student_allergie_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ka_student_feed`
--
ALTER TABLE `ka_student_feed`
  MODIFY `student_feed_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ka_student_parent`
--
ALTER TABLE `ka_student_parent`
  MODIFY `student_parent_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ka_users`
--
ALTER TABLE `ka_users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `ka_user_block_list`
--
ALTER TABLE `ka_user_block_list`
  MODIFY `user_block_list_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ka_user_club`
--
ALTER TABLE `ka_user_club`
  MODIFY `user_club_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ka_user_pick_up_and_drop_off`
--
ALTER TABLE `ka_user_pick_up_and_drop_off`
  MODIFY `user_pick_up_and_drop_off_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ka_city`
--
ALTER TABLE `ka_city`
  ADD CONSTRAINT `ka_city_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `ka_state` (`state_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_class`
--
ALTER TABLE `ka_class`
  ADD CONSTRAINT `ka_class_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `ka_grade` (`grade_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_class_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_club`
--
ALTER TABLE `ka_club`
  ADD CONSTRAINT `ka_club_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_events`
--
ALTER TABLE `ka_events`
  ADD CONSTRAINT `ka_events_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_event_and_notification`
--
ALTER TABLE `ka_event_and_notification`
  ADD CONSTRAINT `ka_event_and_notification_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_exam`
--
ALTER TABLE `ka_exam`
  ADD CONSTRAINT `ka_exam_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_exam_user_id_foreign` FOREIGN KEY (`created_user_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_exam_result`
--
ALTER TABLE `ka_exam_result`
  ADD CONSTRAINT `ka_exam_result_created_user_id_foreign` FOREIGN KEY (`created_user_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_exam_result_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `ka_exam` (`exam_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_exam_result_school_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_grade`
--
ALTER TABLE `ka_grade`
  ADD CONSTRAINT `ka_grade_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_homework`
--
ALTER TABLE `ka_homework`
  ADD CONSTRAINT `ka_homework_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_message`
--
ALTER TABLE `ka_message`
  ADD CONSTRAINT `ka_message_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_message_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_notification`
--
ALTER TABLE `ka_notification`
  ADD CONSTRAINT `ka_notification_created_user_id_foreign` FOREIGN KEY (`created_user_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_notification_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_state`
--
ALTER TABLE `ka_state`
  ADD CONSTRAINT `ka_state_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `ka_country` (`country_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_student_allergies`
--
ALTER TABLE `ka_student_allergies`
  ADD CONSTRAINT `ka_student_allergies_allergie_id_foreign` FOREIGN KEY (`allergie_id`) REFERENCES `ka_allergies` (`allergie_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_student_allergies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_student_feed`
--
ALTER TABLE `ka_student_feed`
  ADD CONSTRAINT `ka_student_feed_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_student_parent`
--
ALTER TABLE `ka_student_parent`
  ADD CONSTRAINT `ka_student_parent_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_student_parent_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_users`
--
ALTER TABLE `ka_users`
  ADD CONSTRAINT `ka_users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `ka_city` (`city_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_users_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `ka_class` (`class_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `ka_country` (`country_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_users_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `ka_grade` (`grade_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `ka_roles` (`role_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_users_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_users_school_level_id_foreign` FOREIGN KEY (`school_level_id`) REFERENCES `ka_school_level` (`school_level_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_users_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `ka_state` (`state_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_user_block_list`
--
ALTER TABLE `ka_user_block_list`
  ADD CONSTRAINT `ka_user_block_list_ibfk_1` FOREIGN KEY (`block_user_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_user_block_list_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_user_club`
--
ALTER TABLE `ka_user_club`
  ADD CONSTRAINT `ka_user_club_club_id_foreign` FOREIGN KEY (`club_id`) REFERENCES `ka_club` (`club_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_user_club_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ka_user_pick_up_and_drop_off`
--
ALTER TABLE `ka_user_pick_up_and_drop_off`
  ADD CONSTRAINT `ka_user_pick_up_and_drop_off_created_user_id_foreign` FOREIGN KEY (`created_user_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ka_user_pick_up_and_drop_off_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `ka_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pick_up_and_drop_off_user_id_foreign` FOREIGN KEY (`pick_up_and_drop_off_user_id`) REFERENCES `ka_pick_up_and_drop_off_user` (`pick_up_and_drop_off_user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
