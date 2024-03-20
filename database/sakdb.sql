-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19. Mar, 2024 22:47 PM
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
(1, 'testnavn1', 'testpassord1', 'testepost1', 0, 0),
(2, 'testnavn2', 'testpassord2', 'testepost2', 0, 1),
(3, 'testnavn3', 'testpassord3', 'testepost3', 1, 1),
(4, 'testnavn4', 'testpassord4', 'testepost4', 0, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `sak`
--

CREATE TABLE `sak` (
  `saksnummer` int(11) NOT NULL,
  `beskrivelse` text NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `bruker` int(11) NOT NULL,
  `oppklart` tinyint(4) NOT NULL,
  `losning` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dataark for tabell `sak`
--

INSERT INTO `sak` (`saksnummer`, `beskrivelse`, `kategori`, `bruker`, `oppklart`, `losning`) VALUES
(1, 'testbeskrivelse1', 'testkategori1', 1, 0, ''),
(2, 'testbeskrivelse2', 'testkategori2', 1, 1, 'testløsning'),
(3, 'testbeskrivelse3', 'testkategori2', 4, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bruker`
--
ALTER TABLE `bruker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sak`
--
ALTER TABLE `sak`
  ADD PRIMARY KEY (`saksnummer`),
  ADD KEY `fk_sak_bruker_idx` (`bruker`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bruker`
--
ALTER TABLE `bruker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sak`
--
ALTER TABLE `sak`
  MODIFY `saksnummer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `sak`
--
ALTER TABLE `sak`
  ADD CONSTRAINT `fk_sak_bruker` FOREIGN KEY (`bruker`) REFERENCES `bruker` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
