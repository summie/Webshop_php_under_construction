-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 18 dec 2017 om 11:10
-- Serverversie: 10.1.16-MariaDB
-- PHP-versie: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwa`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `id` int(11) NOT NULL,
  `artikel` varchar(40) NOT NULL,
  `prijs` decimal(11,2) NOT NULL,
  `artikelcode` varchar(40) NOT NULL,
  `btw` set('6','21') NOT NULL,
  `omschrijving` varchar(256) NOT NULL,
  `foto` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`id`, `artikel`, `prijs`, `artikelcode`, `btw`, `omschrijving`, `foto`) VALUES
(1, 'Ham', '1.75', '100608', '6', 'Lekker op een wit broodje', 'http://www.supermarktcheck.nl/images/produkten/100608.jpg'),
(2, 'Audi A4', '13999.00', '0000158', '21', 'Rijd comfortable het hele jaar door', 'https://www.audi.nl/content/dam/nemo/nl/Homepage/2017-08/585-a4-PL.JPG?downsize=880px:*'),
(3, 'Kaas', '1.99', '01137191', '6', 'Lekkere hollandse kaas', 'http://www.supermarktcheck.nl/images/produkten/deen/Het%20Beste%20van%20Deen%20kaas.jpg');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
