-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2023 at 08:54 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `student_system`
--

-- --------------------------------------------------------
--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birth_day` varchar(10) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `gender` varchar(10) NOT NULL,
  `notes` text NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (
    `id`,
    `first_name`,
    `last_name`,
    `birth_day`,
    `added_at`,
    `gender`,
    `notes`
  )
VALUES (
    1002,
    'Peter',
    'Parker',
    '',
    '2023-08-17 01:09:19',
    'Male',
    'Spider-Man is a superhero appearing in American comic books published by Marvel Comics. Created by writer-editor Stan Lee and artist Steve Ditko, he first appeared in the anthology comic book Amazing Fantasy #15 in the Silver Age of Comic Books.'
  ),
  (
    1003,
    'Food',
    'Panda',
    '',
    '2023-08-17 01:13:22',
    'Male',
    'Foodpanda is online food and groceries delivery service in the Philippines that you shouldn\'t miss!'
  ),
  (
    1004,
    'Taylor',
    'Swift',
    '',
    '2023-08-17 12:40:03',
    'Female',
    'Taylor Alison Swift (born December 13, 1989) is an American singer-songwriter. Recognized for her songwriting, musical versatility, artistic reinventions, and influence on the music industry, she is a prominent cultural figure of the 21st century.\r\n\r\nSwift began professional songwriting at age 14 and signed with Big Machine Records in 2005 to become a country singer. Under Big Machine, she released six studio albums, four of them to country radio, starting with her self-titled album in 2006. Her next, Fearless (2008), explored country pop, and its singles \"Love Story\" and \"You Belong with Me\" catapulted her to prominence. Speak Now (2010) incorporated rock influences, while Red (2012) experimented with electronic elements and featured Swift\'s first Billboard Hot 100 number-one song, \"We Are Never Ever Getting Back Together\". She forwent her country image with 1989 (2014), a synth-pop album supported by the chart-topping songs \"Shake It Off\", \"Blank Space\", and \"Bad Blood\". Media scrutiny inspired the hip-hop-flavored Reputation (2017) and its number-one single \"Look What You Made Me Do\".'
  ),
  (
    1011,
    'Pande',
    'Coco',
    '',
    '2023-08-18 11:57:24',
    'Male',
    'Pan de Coco with a soft, fluffy bun and perfectly sweetened coconut filling is perfect as a snack or dessert. This coconut bread is fantastic with coffee or tea and is sure to be a family favorite.'
  ),
  (
    1013,
    'SD',
    'Card',
    '',
    '2023-08-18 15:18:18',
    'Male',
    'A Secure Digital (SD) card is a tiny flash memory card designed for high-capacity memory and various portable devices, such as car navigation systems, cellular phones, e-books, PDAs, smartphones, digital cameras, music players, digital video camcorders and personal computers.'
  ),
  (
    1014,
    'Alden',
    'Richards',
    '',
    '2023-08-18 17:50:32',
    'Male',
    'Richard Reyes Faulkerson Jr. (born January 2, 1992),[3] popularly known as Alden Richards, is a Filipino actor, host, ambassador, recording artist, product endorser, producer and entrepreneur. He is dubbed as \"The Asia\'s Multimedia Star\" after receiving the Asian Star Prize awards in 14th Seoul International Drama Awards of 2019 for acting.'
  ),
  (
    1015,
    'Juan',
    'Dela Cruz',
    '',
    '2023-08-18 18:03:09',
    'Male',
    'Juan dela Cruz is a 2013 Philippine superhero television series starring Coco Martin.'
  ),
  (
    1016,
    'Coco',
    'Martin',
    '',
    '2023-08-18 18:07:04',
    'Male',
    'Rodel Pacheco Nacianceno, known professionally as Coco Martin, is a Filipino actor, director, and film producer. He is best known for playing the lead roles in television series, such as Minsan Lang Kita Iibigin, Walang Hanggan, Ikaw Lamang, Juan dela Cruz, FPJ\'s Ang Probinsyano and FPJ\'s Batang Quiapo.'
  ),
  (
    1017,
    'Ben',
    'Tennyson',
    '',
    '2023-08-18 18:08:19',
    'Male',
    'Benjamin Kirby \"Ben\" Tennyson, commonly known as Ben 10, is a fictional superhero and the title protagonist of the Ben 10 franchise.'
  ),
  (
    1018,
    'Sunkissed',
    'Lola',
    '',
    '2023-08-18 18:10:06',
    'Male',
    'SunKissed Lola is a Filipino rock band formed in Olongapo, Zambales in 2021. The group consists of Dan Ombao (lead vocals, guitar), Alvin Serito (lead vocals, acoustic guitar), Laura Lacbain (lead vocals), Danj Quimson (bass guitar), Genson Viloria (drums), and Rodnie Resos (keyboards).\r\n\r\nThe band gained prominence with the success of their single \"Pasilyo\", breaking records in Spotify Philippines and Billboard Philippines Songs as one of the most successful OPM songs in the streaming era.'
  ),
  (
    1019,
    'Rob',
    'Deniel',
    '',
    '2023-08-18 18:10:42',
    'Male',
    'Rob Deniel Barrinuevo (born October 6, 2003) know by his stage name Rob Deniel is a Filipino singer-songwriter under Viva Records.'
  ),
  (
    1020,
    'Silent',
    'Sanctuary',
    '',
    '2023-08-18 18:11:30',
    'Male',
    'Silent Sanctuary is a 6-piece Filipino rock band that was formed in Metro Manila, Philippines in 2001. Five studio albums have been released by the band throughout its career.'
  ),
  (
    1021,
    'Emily',
    'Smith',
    '',
    '2023-08-18 18:13:08',
    'Male',
    'A young artist exploring the world of abstract painting.\r\n\r\n'
  ),
  (
    1022,
    'Liam ',
    'Johnson',
    '',
    '2023-08-18 18:13:25',
    'Male',
    'A tech enthusiast passionate about developing innovative apps.'
  ),
  (
    1023,
    'Olivia',
    'Williams',
    '',
    '2023-08-18 18:13:51',
    'Male',
    'An avid traveler and photographer capturing moments around the globe.'
  ),
  (
    1024,
    'Noah',
    'Brown',
    '',
    '2023-08-18 18:14:24',
    'Male',
    'A fitness enthusiast and personal trainer helping others achieve their goals.'
  ),
  (
    1025,
    'Ava',
    'Jones',
    '',
    '2023-08-18 18:15:15',
    'Male',
    'A food blogger with a knack for creating delectable recipes.'
  ),
  (
    1026,
    'Jethro',
    'Frane',
    '',
    '2023-08-19 04:37:19',
    'Male',
    '3rd Year BSIT Student.'
  );
--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 1028;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;