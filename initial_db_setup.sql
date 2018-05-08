-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2018 at 01:31 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS Team_16;
USE Team_16;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `Beheer`
--

CREATE TABLE `Beheer` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Beheer`
--

INSERT INTO `Beheer` (`id`, `username`, `pass`) VALUES
(28, 'TM', '$2y$10$ql/Zjlv/V4fn0v34//5n..8LUTW2vAm4QrHQ0C4xiFoBWDe4qmjMe');

-- --------------------------------------------------------

--
-- Table structure for table `Jaargang`
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

-- --------------------------------------------------------

--
-- Table structure for table `KeuzeMogelijkheid`
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

-- --------------------------------------------------------

--
-- Table structure for table `KeuzeOptie`
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

-- --------------------------------------------------------

--
-- Table structure for table `KeuzeoptieVanDeelnemer`
--

CREATE TABLE `KeuzeoptieVanDeelnemer` (
  `keuzeoptieId` int(11) NOT NULL,
  `persoonId` int(11) NOT NULL,
  `commentaar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `MailHerinnering`
--

CREATE TABLE `MailHerinnering` (
  `id` int(11) NOT NULL,
  `timer` date NOT NULL,
  `sjabloonId` int(11) NOT NULL,
  `actief` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Mailsjabloon`
--

CREATE TABLE `Mailsjabloon` (
  `id` int(11) NOT NULL,
  `naam` text NOT NULL,
  `inhoud` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Persoon`
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

-- --------------------------------------------------------

--
-- Table structure for table `PersoonInHerinnering`
--

CREATE TABLE `PersoonInHerinnering` (
  `mailherinneringId` int(11) NOT NULL,
  `persoonId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Plaats`
--

CREATE TABLE `Plaats` (
  `id` int(11) NOT NULL,
  `naam` text NOT NULL,
  `locatie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Shift`
--

CREATE TABLE `Shift` (
  `id` int(11) NOT NULL,
  `naam` text NOT NULL,
  `taakId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Taak`
--

CREATE TABLE `Taak` (
  `id` int(11) NOT NULL,
  `functie` text NOT NULL,
  `beschrijving` text NOT NULL,
  `keuzemogelijkheidId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `VrijwilligersInShift`
--

CREATE TABLE `VrijwilligersInShift` (
  `persoonId` int(11) NOT NULL,
  `shiftId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Beheer`
--
ALTER TABLE `Beheer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Jaargang`
--
ALTER TABLE `Jaargang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `KeuzeMogelijkheid`
--
ALTER TABLE `KeuzeMogelijkheid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jaargangId` (`jaargangId`) USING BTREE,
  ADD KEY `plaatsId` (`plaatsId`);

--
-- Indexes for table `KeuzeOptie`
--
ALTER TABLE `KeuzeOptie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keuzemogelijkheidId` (`keuzemogelijkheidId`),
  ADD KEY `plaatsId` (`plaatsId`);

--
-- Indexes for table `KeuzeoptieVanDeelnemer`
--
ALTER TABLE `KeuzeoptieVanDeelnemer`
  ADD KEY `persoonId` (`persoonId`),
  ADD KEY `keuzeoptieId` (`keuzeoptieId`);

--
-- Indexes for table `MailHerinnering`
--
ALTER TABLE `MailHerinnering`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sjabloonId` (`sjabloonId`);

--
-- Indexes for table `Mailsjabloon`
--
ALTER TABLE `Mailsjabloon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Persoon`
--
ALTER TABLE `Persoon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jaarId` (`jaarId`);

--
-- Indexes for table `PersoonInHerinnering`
--
ALTER TABLE `PersoonInHerinnering`
  ADD KEY `mailreminderId` (`mailherinneringId`),
  ADD KEY `persoonId` (`persoonId`);

--
-- Indexes for table `Plaats`
--
ALTER TABLE `Plaats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Shift`
--
ALTER TABLE `Shift`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taakId` (`taakId`);

--
-- Indexes for table `Taak`
--
ALTER TABLE `Taak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keuzemogelijkheidId` (`keuzemogelijkheidId`);

--
-- Indexes for table `VrijwilligersInShift`
--
ALTER TABLE `VrijwilligersInShift`
  ADD KEY `shiftId` (`shiftId`),
  ADD KEY `persoonId` (`persoonId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Beheer`
--
ALTER TABLE `Beheer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `Jaargang`
--
ALTER TABLE `Jaargang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `KeuzeMogelijkheid`
--
ALTER TABLE `KeuzeMogelijkheid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `KeuzeOptie`
--
ALTER TABLE `KeuzeOptie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `MailHerinnering`
--
ALTER TABLE `MailHerinnering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Mailsjabloon`
--
ALTER TABLE `Mailsjabloon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Persoon`
--
ALTER TABLE `Persoon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Plaats`
--
ALTER TABLE `Plaats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `Shift`
--
ALTER TABLE `Shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `Taak`
--
ALTER TABLE `Taak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Persoon`
--
ALTER TABLE `Persoon`
  ADD CONSTRAINT `Persoon_ibfk_1` FOREIGN KEY (`jaarId`) REFERENCES `Jaargang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Shift`
--
ALTER TABLE `Shift`
  ADD CONSTRAINT `Shift_ibfk_1` FOREIGN KEY (`taakId`) REFERENCES `Taak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `VrijwilligersInShift`
--
ALTER TABLE `VrijwilligersInShift`
  ADD CONSTRAINT `VrijwilligersInShift_ibfk_1` FOREIGN KEY (`persoonId`) REFERENCES `Persoon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
