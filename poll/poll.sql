-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 mrt 2025 om 12:05
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poll`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `poll`
--

CREATE TABLE `poll` (
  `id` int(11) NOT NULL,
  `choice` int(11) DEFAULT NULL,
  `votes` int(11) NOT NULL DEFAULT 0,
  `question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `poll`
--

INSERT INTO `poll` (`id`, `choice`, `votes`, `question_id`) VALUES
(5, 2, 18, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vragen_en_opties`
--

CREATE TABLE `vragen_en_opties` (
  `id` int(11) NOT NULL,
  `vraag` varchar(255) NOT NULL,
  `antwoord1` varchar(255) DEFAULT NULL,
  `antwoord2` varchar(255) DEFAULT NULL,
  `antwoord3` varchar(255) DEFAULT NULL,
  `antwoord4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `vragen_en_opties`
--

INSERT INTO `vragen_en_opties` (`id`, `vraag`, `antwoord1`, `antwoord2`, `antwoord3`, `antwoord4`) VALUES
(2, 'wat is je favoriete stad?', 'Rotterdam', 'Den bosch', 'Groningen', 'Eindhoven'),
(6, 'wie wint de wedstrijd Nederland Spanje?', 'Spanje', 'Nederland', 'Gelijkspel', 'Het wordt gestaakt'),
(7, 'wat is je favoriete automerk?', 'BMW', 'Fiat', 'Mercedes', 'Volkswagen');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `vragen_en_opties`
--
ALTER TABLE `vragen_en_opties`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `poll`
--
ALTER TABLE `poll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `vragen_en_opties`
--
ALTER TABLE `vragen_en_opties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
