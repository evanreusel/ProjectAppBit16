-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 27 apr 2018 om 15:56
-- Serverversie: 5.7.22-0ubuntu0.16.04.1
-- PHP-versie: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS Team_16;
USE Team_16


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Beheer`
--

CREATE TABLE `Beheer` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Beheer`
--

INSERT INTO `Beheer` (`id`, `username`, `pass`) VALUES
(28, 'TM', '$2y$10$ql/Zjlv/V4fn0v34//5n..8LUTW2vAm4QrHQ0C4xiFoBWDe4qmjMe');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Jaargang`
--

CREATE TABLE `Jaargang` (
  `id` int(11) NOT NULL,
  `beginTijdstip` date NOT NULL,
  `eindTijdstip` date NOT NULL,
  `info` text NOT NULL,
  `naam` text NOT NULL,
  `thema` text NOT NULL,
  `actief` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Jaargang`
--

INSERT INTO `Jaargang` (`id`, `beginTijdstip`, `eindTijdstip`, `info`, `naam`, `thema`, `actief`) VALUES
(1, '2017-03-09', '2017-03-23', '', '2016-2017', '', 0),
(2, '2016-03-09', '2016-03-20', '', '2015-2016', '', 0),
(3, '2018-03-02', '2018-03-23', '', '2017-2018', '', 0),
(4, '2018-04-15', '2018-04-20', '', '', '', 0),
(5, '2018-04-15', '2018-04-20', '', 'Jaar', '', 0),
(6, '2018-04-17', '2018-04-26', 'da weet ik ni', 'Sporten is gezond', '', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `KeuzeMogelijkheid`
--

CREATE TABLE `KeuzeMogelijkheid` (
  `id` int(11) NOT NULL,
  `jaargangId` int(11) NOT NULL,
  `naam` text NOT NULL,
  `plaatsId` int(11) NOT NULL,
  `beginTijdstip` datetime DEFAULT NULL,
  `eindTijdstip` datetime DEFAULT NULL,
  `deadlineTijdstip` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `KeuzeMogelijkheid`
--

INSERT INTO `KeuzeMogelijkheid` (`id`, `jaargangId`, `naam`, `plaatsId`, `beginTijdstip`, `eindTijdstip`, `deadlineTijdstip`) VALUES
(1, 1, 'Eten', 1, '2018-03-12 12:00:00', '2018-03-12 13:00:00', '2018-03-01 00:00:00'),
(2, 1, 'After-Party', 1, '2018-03-01 00:00:00', NULL, NULL),
(3, 1, 'Activiteiten', 2, '2018-04-23 18:30:00', '2018-04-23 23:30:00', '2018-04-24 22:25:00'),
(4, 3, 'eten', 3, '2018-04-25 12:00:00', '2018-04-25 16:30:00', '2018-04-23 12:00:00'),
(5, 3, 'activiteiten', 3, '2018-04-25 09:00:00', '2018-04-12 12:00:00', '2018-04-23 17:00:00'),
(6, 3, 'after-party', 3, '2018-04-25 17:00:00', '2018-04-25 22:00:00', '2018-04-23 17:00:00'),
(29, 2, 'Sletjes', 3, '2018-04-25 00:00:00', '2018-04-25 00:00:00', '2018-04-25 00:00:00'),
(30, 2, 'Feestjes', 35, '2018-04-25 00:00:00', '2018-04-25 00:00:00', '2018-04-25 00:00:00'),
(31, 6, 'Activiteit', 1, '2018-04-27 00:00:00', '2018-04-27 00:00:00', '2018-04-27 00:00:00'),
(32, 6, 'eten', 18, '2018-04-27 00:00:00', '2018-04-27 00:00:00', '2018-04-27 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `KeuzeOptie`
--

CREATE TABLE `KeuzeOptie` (
  `id` int(11) NOT NULL,
  `keuzemogelijkheidId` int(11) NOT NULL,
  `naam` text NOT NULL,
  `plaatsId` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `beginTijdstip` datetime DEFAULT NULL,
  `eindTijdstip` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `KeuzeOptie`
--

INSERT INTO `KeuzeOptie` (`id`, `keuzemogelijkheidId`, `naam`, `plaatsId`, `min`, `max`, `beginTijdstip`, `eindTijdstip`) VALUES
(1, 1, 'Visschotel', 1, 2, 5, NULL, NULL),
(2, 0, 'Ik feest meer', 2, 20, 500, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 'Ik feest niet mee', 2, 10, 50, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 3, 'fietsen', 3, 2, 50, '2018-04-23 10:00:00', '2018-04-23 12:00:00'),
(7, 29, 'U mama', 3, 5, 8, '2018-04-25 15:30:00', '2018-04-25 15:30:00'),
(8, 29, 'De mama van Thomas', 3, 4, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 29, 'Anouk', 3, 1, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 31, 'tennis', 3, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 31, 'minigolf', 3, 1, 50, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 32, 'vis', 3, 1, 100, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `KeuzeoptieVanDeelnemer`
--

CREATE TABLE `KeuzeoptieVanDeelnemer` (
  `keuzeoptieId` int(11) NOT NULL,
  `persoonId` int(11) NOT NULL,
  `commentaar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `KeuzeoptieVanDeelnemer`
--

INSERT INTO `KeuzeoptieVanDeelnemer` (`keuzeoptieId`, `persoonId`, `commentaar`) VALUES
(1, 6, ''),
(1, 7, ''),
(2, 6, ''),
(3, 7, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `MailHerinnering`
--

CREATE TABLE `MailHerinnering` (
  `id` int(11) NOT NULL,
  `timer` date NOT NULL,
  `sjabloonId` int(11) NOT NULL,
  `actief` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `MailHerinnering`
--

INSERT INTO `MailHerinnering` (`id`, `timer`, `sjabloonId`, `actief`, `status`) VALUES
(1, '2018-03-31', 1, 1, 0),
(2, '2018-04-18', 3, 0, 0),
(3, '2018-04-30', 2, 1, 0),
(4, '2018-05-17', 2, 1, 0),
(5, '2018-04-27', 2, 0, 0),
(6, '2018-04-27', 1, 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Mailsjabloon`
--

CREATE TABLE `Mailsjabloon` (
  `id` int(11) NOT NULL,
  `naam` text NOT NULL,
  `inhoud` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Mailsjabloon`
--

INSERT INTO `Mailsjabloon` (`id`, `naam`, `inhoud`) VALUES
(1, 'welkomst mail', 'Welkom bij de webapplicatie van het personeelsfeest van Thomas More.'),
(2, 'bevestigingsmail ', 'U inschrijving is bevestigd.'),
(3, 'annulatie', 'U inschrijving is geannuleerd.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Persoon`
--

CREATE TABLE `Persoon` (
  `id` int(11) NOT NULL,
  `naam` text NOT NULL,
  `adres` text NOT NULL,
  `woonplaats` text NOT NULL,
  `nummer` text NOT NULL,
  `mail` text NOT NULL,
  `soort` text NOT NULL,
  `token` text NOT NULL,
  `jaarId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Persoon`
--

INSERT INTO `Persoon` (`id`, `naam`, `adres`, `woonplaats`, `nummer`, `mail`, `soort`, `token`, `jaarId`) VALUES
(1, 'Greif Matthias', '', '', 'R0656559', 'r0656559@student.thomasmore.be', 'STUDENT', '0prol2vZH3IgYBMapBI2', 1),
(2, 'Greif Matthias', '', '', 'R0656559', 'r0656559@student.thomasmore.be', 'STUDENT', 'ltZTW4up2Vat3DtfVO3D', 2),
(3, 'Greif Matthias', '', '', 'R0656559', 'r0656559@student.thomasmore.be', 'STUDENT', 'qA3Izfhv6odMt9EW2wqb', 3),
(4, 'Erik Van Reusel', '', '', 'R000000', 'r0581776@student.thomasmore.be', 'STUDENT', 'uAnF54sOBjByFVUprLJ8', 3),
(5, 'Tim Swerts', '', '', 'R000001', 'R000001@test.thomasmore.be', 'STUDENT', 'ColAtus5imKxECWbvuLP', 3),
(6, 'Patrick Verhaert', '', '', 'T000000', 'T000000@test.thomasmore.be', 'DOCENT', 'FR8QqonWJ56bSjokRRPH', 3),
(7, 'Miranda Decabooter', '', '', 'T000002', 'T000002@test.thomasmore.be', 'DOCENT', 'UV91cxEiIL33fDCIaovO', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `PersoonInHerinnering`
--

CREATE TABLE `PersoonInHerinnering` (
  `mailherinneringId` int(11) NOT NULL,
  `persoonId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `PersoonInHerinnering`
--

INSERT INTO `PersoonInHerinnering` (`mailherinneringId`, `persoonId`) VALUES
(1, 1),
(2, 3),
(1, 2),
(2, 1),
(3, 1),
(5, 1),
(6, 4),
(6, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Plaats`
--

CREATE TABLE `Plaats` (
  `id` int(11) NOT NULL,
  `naam` text NOT NULL,
  `locatie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Plaats`
--

INSERT INTO `Plaats` (`id`, `naam`, `locatie`) VALUES
(28, 'B207', '0,0'),
(35, 'B218', '1,2'),
(36, 'D202', 'boven '),
(37, 'Aula 1', 'De eerste deur rechts nadat men de school binnenkomt langs de hoofdingang.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Shift`
--

CREATE TABLE `Shift` (
  `id` int(11) NOT NULL,
  `naam` text NOT NULL,
  `taakId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Shift`
--

INSERT INTO `Shift` (`id`, `naam`, `taakId`) VALUES
(1, 'Eerste shift', 1),
(2, 'Tweede shift', 1),
(3, 'Eerste shift', 2),
(4, 'Tweede shift', 2),
(7, 'eten maken', 5),
(8, 'eten opruimen', 6);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Taak`
--

CREATE TABLE `Taak` (
  `id` int(11) NOT NULL,
  `functie` text NOT NULL,
  `beschrijving` text NOT NULL,
  `keuzemogelijkheidId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Taak`
--

INSERT INTO `Taak` (`id`, `functie`, `beschrijving`, `keuzemogelijkheidId`) VALUES
(1, 'Afruimen', 'Afruimen van de tafels', 1),
(2, 'Afwassen', 'Afwassen van alle borden en glazen.', 1),
(5, 'shift 1', '', 31),
(6, 'shift 2', '', 32);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `VrijwilligersInShift`
--

CREATE TABLE `VrijwilligersInShift` (
  `persoonId` int(11) NOT NULL,
  `shiftId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `VrijwilligersInShift`
--

INSERT INTO `VrijwilligersInShift` (`persoonId`, `shiftId`) VALUES
(3, 1),
(3, 2),
(4, 1),
(4, 2);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Beheer`
--
ALTER TABLE `Beheer`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Jaargang`
--
ALTER TABLE `Jaargang`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `KeuzeMogelijkheid`
--
ALTER TABLE `KeuzeMogelijkheid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jaargangId` (`jaargangId`) USING BTREE,
  ADD KEY `plaatsId` (`plaatsId`);

--
-- Indexen voor tabel `KeuzeOptie`
--
ALTER TABLE `KeuzeOptie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keuzemogelijkheidId` (`keuzemogelijkheidId`),
  ADD KEY `plaatsId` (`plaatsId`);

--
-- Indexen voor tabel `KeuzeoptieVanDeelnemer`
--
ALTER TABLE `KeuzeoptieVanDeelnemer`
  ADD KEY `persoonId` (`persoonId`),
  ADD KEY `keuzeoptieId` (`keuzeoptieId`);

--
-- Indexen voor tabel `MailHerinnering`
--
ALTER TABLE `MailHerinnering`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sjabloonId` (`sjabloonId`);

--
-- Indexen voor tabel `Mailsjabloon`
--
ALTER TABLE `Mailsjabloon`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Persoon`
--
ALTER TABLE `Persoon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jaarId` (`jaarId`);

--
-- Indexen voor tabel `PersoonInHerinnering`
--
ALTER TABLE `PersoonInHerinnering`
  ADD KEY `mailreminderId` (`mailherinneringId`),
  ADD KEY `persoonId` (`persoonId`);

--
-- Indexen voor tabel `Plaats`
--
ALTER TABLE `Plaats`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Shift`
--
ALTER TABLE `Shift`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taakId` (`taakId`);

--
-- Indexen voor tabel `Taak`
--
ALTER TABLE `Taak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keuzemogelijkheidId` (`keuzemogelijkheidId`);

--
-- Indexen voor tabel `VrijwilligersInShift`
--
ALTER TABLE `VrijwilligersInShift`
  ADD KEY `shiftId` (`shiftId`),
  ADD KEY `persoonId` (`persoonId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Beheer`
--
ALTER TABLE `Beheer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT voor een tabel `Jaargang`
--
ALTER TABLE `Jaargang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `KeuzeMogelijkheid`
--
ALTER TABLE `KeuzeMogelijkheid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT voor een tabel `KeuzeOptie`
--
ALTER TABLE `KeuzeOptie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT voor een tabel `MailHerinnering`
--
ALTER TABLE `MailHerinnering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `Mailsjabloon`
--
ALTER TABLE `Mailsjabloon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `Persoon`
--
ALTER TABLE `Persoon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `Plaats`
--
ALTER TABLE `Plaats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT voor een tabel `Shift`
--
ALTER TABLE `Shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT voor een tabel `Taak`
--
ALTER TABLE `Taak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `Persoon`
--
ALTER TABLE `Persoon`
  ADD CONSTRAINT `Persoon_ibfk_1` FOREIGN KEY (`jaarId`) REFERENCES `Jaargang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `Shift`
--
ALTER TABLE `Shift`
  ADD CONSTRAINT `Shift_ibfk_1` FOREIGN KEY (`taakId`) REFERENCES `Taak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `VrijwilligersInShift`
--
ALTER TABLE `VrijwilligersInShift`
  ADD CONSTRAINT `VrijwilligersInShift_ibfk_1` FOREIGN KEY (`persoonId`) REFERENCES `Persoon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
