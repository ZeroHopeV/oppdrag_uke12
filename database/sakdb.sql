-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 31. Mar, 2024 15:31 PM
-- Tjener-versjon: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sakdb`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `bruker`
--

CREATE TABLE `bruker` (
  `id` int(11) NOT NULL,
  `navn` varchar(100) NOT NULL,
  `passord` varchar(255) NOT NULL,
  `epost` varchar(75) NOT NULL,
  `admin` tinyint(4) NOT NULL,
  `arbeider` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dataark for tabell `bruker`
--

INSERT INTO `bruker` (`id`, `navn`, `passord`, `epost`, `admin`, `arbeider`) VALUES
(1, 'test1', '$2y$10$BZVrbqFTjcGh3tVJ2jsUMOVHkuR7hxVlA.nM9Nbe7Dd4FYOWdVzXK', 'bruker', 0, 0),
(2, 'test2', '$2y$10$aHs0HVGlMpQQgSUpsfeA1O6KaZl5EJxwdVv5/Fh6zjewPdoy7FlP2', 'arbeider', 0, 1),
(3, 'test3', '$2y$10$KNlhhB2toLDUbKDYTHwLI.7ZCKcYt7xFZLcOzVc3efLtO0oOa4fCW', 'admin', 1, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `kategori`
--

CREATE TABLE `kategori` (
  `ktgr_id` int(11) NOT NULL,
  `ktgr_navn` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dataark for tabell `kategori`
--

INSERT INTO `kategori` (`ktgr_id`, `ktgr_navn`) VALUES
(1, 'Programvare'),
(2, 'Maskinvare'),
(3, 'Sikkerhet'),
(4, 'Nettverk'),
(5, 'Annet');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `sak`
--

CREATE TABLE `sak` (
  `saksnummer` int(11) NOT NULL,
  `beskrivelse` text NOT NULL,
  `bruker` int(11) NOT NULL,
  `oppklart` tinyint(4) NOT NULL,
  `losning` text DEFAULT NULL,
  `kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bruker`
--
ALTER TABLE `bruker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ktgr_id`);

--
-- Indexes for table `sak`
--
ALTER TABLE `sak`
  ADD PRIMARY KEY (`saksnummer`),
  ADD KEY `fk_sak_bruker_idx` (`bruker`),
  ADD KEY `fk_sak_kategori1_idx` (`kategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bruker`
--
ALTER TABLE `bruker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `ktgr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sak`
--
ALTER TABLE `sak`
  MODIFY `saksnummer` int(11) NOT NULL AUTO_INCREMENT;

--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `sak`
--
ALTER TABLE `sak`
  ADD CONSTRAINT `fk_sak_bruker` FOREIGN KEY (`bruker`) REFERENCES `bruker` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sak_kategori1` FOREIGN KEY (`kategori`) REFERENCES `kategori` (`ktgr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
