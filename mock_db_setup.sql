-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2018 at 01:17 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table 'Beheer'
--

CREATE DATABASE IF NOT EXISTS Team_16;
USE Team_16

CREATE TABLE 'Beheer' (
  'id' int(11) NOT NULL,
  'username' text NOT NULL,
  'pass' text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'Beheer'
--

INSERT INTO 'Beheer' ('id', 'username', 'pass') VALUES
(22, 'admin', '$2y$10$A6YRkG.CTT0B0xIjdcH.LOLbysd3PewMLXbQGIsedkubvMtb8mlqu'),
(28, 'TM', '$2y$10$ql/Zjlv/V4fn0v34//5n..8LUTW2vAm4QrHQ0C4xiFoBWDe4qmjMe');

-- --------------------------------------------------------

--
-- Table structure for table 'Jaargang'
--

CREATE TABLE 'Jaargang' (
  'id' int(11) NOT NULL,
  'beginTijdstip' date NOT NULL,
  'eindTijdstip' date NOT NULL,
  'info' text NOT NULL,
  'naam' text NOT NULL,
  'thema' text NOT NULL,
  'actief' int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'Jaargang'
--

INSERT INTO 'Jaargang' ('id', 'beginTijdstip', 'eindTijdstip', 'info', 'naam', 'thema', 'actief') VALUES
(1, '2017-03-09', '2017-03-23', '2016-2017', 'Fastfood', 'Verandwoord eten', 0),
(2, '2016-03-09', '2016-03-20', '2015-2016', 'Sporten is gezond', 'Beweging', 0),
(3, '2018-03-02', '2018-03-23', '2017-2018', 'Quality time', 'Quality time', 0),
(7, '2018-05-03', '2018-05-03', '', 'Avontuur in de bergen', 'Ski', 0),
(8, '2018-05-01', '2018-05-07', '', 'Zon, zee, strand', 'Zee', 1);

-- --------------------------------------------------------

--
-- Table structure for table 'KeuzeMogelijkheid'
--

CREATE TABLE 'KeuzeMogelijkheid' (
  'id' int(11) NOT NULL,
  'jaargangId' int(11) NOT NULL,
  'naam' text NOT NULL,
  'plaatsId' int(11) NOT NULL,
  'beginTijdstip' datetime DEFAULT NULL,
  'eindTijdstip' datetime DEFAULT NULL,
  'deadlineTijdstip' datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'KeuzeMogelijkheid'
--

INSERT INTO 'KeuzeMogelijkheid' ('id', 'jaargangId', 'naam', 'plaatsId', 'beginTijdstip', 'eindTijdstip', 'deadlineTijdstip') VALUES
(35, 3, 'Feest', 28, '2018-05-04 00:00:00', '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(36, 3, 'Activiteiten', 28, '2018-05-04 00:00:00', '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(37, 3, 'Eten', 28, '2018-05-04 00:00:00', '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(38, 2, 'Feest', 28, '2018-05-04 00:00:00', '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(39, 2, 'Activiteiten', 28, '2018-05-04 00:00:00', '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(40, 2, 'Eten', 28, '2018-05-04 00:00:00', '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(41, 1, 'Feest', 28, '2018-05-04 00:00:00', '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(42, 1, 'Activiteiten', 28, '2018-05-04 00:00:00', '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(43, 1, 'Eten', 28, '2018-05-04 00:00:00', '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(44, 8, 'Eten', 28, '2018-05-04 00:00:00', '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(45, 8, 'Drinken', 28, '2018-05-04 00:00:00', '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(46, 8, 'Vervoer', 28, '2018-05-04 00:00:00', '2018-05-04 00:00:00', '2018-05-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table 'KeuzeOptie'
--

CREATE TABLE 'KeuzeOptie' (
  'id' int(11) NOT NULL,
  'keuzemogelijkheidId' int(11) NOT NULL,
  'naam' text NOT NULL,
  'plaatsId' int(11) NOT NULL,
  'min' int(11) NOT NULL,
  'max' int(11) NOT NULL,
  'beginTijdstip' datetime DEFAULT NULL,
  'eindTijdstip' datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'KeuzeOptie'
--

INSERT INTO 'KeuzeOptie' ('id', 'keuzemogelijkheidId', 'naam', 'plaatsId', 'min', 'max', 'beginTijdstip', 'eindTijdstip') VALUES
(13, 35, 'Ik doe mee', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 35, 'Ik doe niet mee', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 36, 'Fietsen', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 36, 'Joggen', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 37, 'Vis', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 37, 'Groenten', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 38, 'Ik doe mee', 0, 0, 0, '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(20, 38, 'Ik doe niet mee', 0, 0, 0, '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(21, 39, 'Fietsen', 0, 0, 0, '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(22, 39, 'Joggen', 0, 0, 0, '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(23, 40, 'Vis', 0, 0, 0, '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(24, 40, 'Groenten', 0, 0, 0, '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(25, 41, 'Ik doe mee', 0, 0, 0, '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(26, 41, 'Ik doe niet mee', 0, 0, 0, '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(27, 42, 'Fietsen', 0, 0, 0, '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(28, 42, 'Joggen', 0, 0, 0, '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(29, 43, 'Vis', 0, 0, 0, '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(30, 43, 'Groenten', 0, 0, 0, '2018-05-04 00:00:00', '2018-05-04 00:00:00'),
(31, 44, 'Vis', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 44, 'Soep', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 44, 'Groenten', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 46, 'Fiets', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 46, 'Bus', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 45, 'Bier', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 45, 'Wijn', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table 'KeuzeoptieVanDeelnemer'
--

CREATE TABLE 'KeuzeoptieVanDeelnemer' (
  'keuzeoptieId' int(11) NOT NULL,
  'persoonId' int(11) NOT NULL,
  'commentaar' text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'MailHerinnering'
--

CREATE TABLE 'MailHerinnering' (
  'id' int(11) NOT NULL,
  'timer' date NOT NULL,
  'sjabloonId' int(11) NOT NULL,
  'actief' int(11) NOT NULL,
  'status' int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'MailHerinnering'
--

INSERT INTO 'MailHerinnering' ('id', 'timer', 'sjabloonId', 'actief', 'status') VALUES
(1, '2018-03-31', 1, 1, 0),
(2, '2018-04-18', 3, 0, 0),
(3, '2018-04-30', 2, 1, 0),
(4, '2018-05-17', 2, 1, 0),
(5, '2018-04-27', 2, 0, 0),
(6, '2018-04-27', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table 'Mailsjabloon'
--

CREATE TABLE 'Mailsjabloon' (
  'id' int(11) NOT NULL,
  'naam' text NOT NULL,
  'inhoud' text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'Mailsjabloon'
--

INSERT INTO 'Mailsjabloon' ('id', 'naam', 'inhoud') VALUES
(1, 'welkomst mail', 'Welkom bij de webapplicatie van het personeelsfeest van Thomas More.'),
(2, 'bevestigingsmail ', 'U inschrijving is bevestigd.'),
(3, 'annulatie', 'U inschrijving is geannuleerd.');

-- --------------------------------------------------------

--
-- Table structure for table 'Persoon'
--

CREATE TABLE 'Persoon' (
  'id' int(11) NOT NULL,
  'naam' text NOT NULL,
  'adres' text NOT NULL,
  'woonplaats' text NOT NULL,
  'nummer' text NOT NULL,
  'mail' text NOT NULL,
  'soort' text NOT NULL,
  'token' text NOT NULL,
  'jaarId' int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'Persoon'
--

INSERT INTO 'Persoon' ('id', 'naam', 'adres', 'woonplaats', 'nummer', 'mail', 'soort', 'token', 'jaarId') VALUES
(1, 'Greif Matthias', '', '', 'R0656559', 'r0656559@student.thomasmore.be', 'VRIJWILLIGER', '0prol2vZH3IgYBMapBI2', 1),
(2, 'Greif Matthias', '', '', 'R0656559', 'r0656559@student.thomasmore.be', 'VRIJWILLIGER', 'ltZTW4up2Vat3DtfVO3D', 2),
(3, 'Greif Matthias', '', '', 'R0656559', 'r0656559@student.thomasmore.be', 'VRIJWILLIGER', 'qA3Izfhv6odMt9EW2wqb', 3),
(4, 'Erik Van Reusel', '', '', 'R000000', 'r0581776@student.thomasmore.be', 'VRIJWILLIGER', 'uAnF54sOBjByFVUprLJ8', 3),
(5, 'Tim Swerts', '', '', 'R000001', 'R000001@test.thomasmore.be', 'VRIJWILLIGER', 'ColAtus5imKxECWbvuLP', 3),
(6, 'Patrick Verhaert', '', '', 'T000000', 'T000000@test.thomasmore.be', 'DEELNEMER', 'FR8QqonWJ56bSjokRRPH', 3),
(7, 'Miranda Decabooter', '', '', 'T000002', 'T000002@test.thomasmore.be', 'DEELNEMER', 'UV91cxEiIL33fDCIaovO', 3);

-- --------------------------------------------------------

--
-- Table structure for table 'PersoonInHerinnering'
--

CREATE TABLE 'PersoonInHerinnering' (
  'mailherinneringId' int(11) NOT NULL,
  'persoonId' int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'PersoonInHerinnering'
--

INSERT INTO 'PersoonInHerinnering' ('mailherinneringId', 'persoonId') VALUES
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
-- Table structure for table 'Plaats'
--

CREATE TABLE 'Plaats' (
  'id' int(11) NOT NULL,
  'naam' text NOT NULL,
  'locatie' text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'Plaats'
--

INSERT INTO 'Plaats' ('id', 'naam', 'locatie') VALUES
(28, 'B207', '0,0'),
(35, 'B218', '1,2'),
(36, 'D202', 'boven ');

-- --------------------------------------------------------

--
-- Table structure for table 'Shift'
--

CREATE TABLE 'Shift' (
  'id' int(11) NOT NULL,
  'naam' text NOT NULL,
  'taakId' int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'Taak'
--

CREATE TABLE 'Taak' (
  'id' int(11) NOT NULL,
  'functie' text NOT NULL,
  'beschrijving' text NOT NULL,
  'keuzemogelijkheidId' int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'VrijwilligersInShift'
--

CREATE TABLE 'VrijwilligersInShift' (
  'persoonId' int(11) NOT NULL,
  'shiftId' int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table 'Beheer'
--
ALTER TABLE 'Beheer'
  ADD PRIMARY KEY ('id');

--
-- Indexes for table 'Jaargang'
--
ALTER TABLE 'Jaargang'
  ADD PRIMARY KEY ('id');

--
-- Indexes for table 'KeuzeMogelijkheid'
--
ALTER TABLE 'KeuzeMogelijkheid'
  ADD PRIMARY KEY ('id'),
  ADD KEY 'jaargangId' ('jaargangId') USING BTREE,
  ADD KEY 'plaatsId' ('plaatsId');

--
-- Indexes for table 'KeuzeOptie'
--
ALTER TABLE 'KeuzeOptie'
  ADD PRIMARY KEY ('id'),
  ADD KEY 'keuzemogelijkheidId' ('keuzemogelijkheidId'),
  ADD KEY 'plaatsId' ('plaatsId');

--
-- Indexes for table 'KeuzeoptieVanDeelnemer'
--
ALTER TABLE 'KeuzeoptieVanDeelnemer'
  ADD KEY 'persoonId' ('persoonId'),
  ADD KEY 'keuzeoptieId' ('keuzeoptieId');

--
-- Indexes for table 'MailHerinnering'
--
ALTER TABLE 'MailHerinnering'
  ADD PRIMARY KEY ('id'),
  ADD KEY 'sjabloonId' ('sjabloonId');

--
-- Indexes for table 'Mailsjabloon'
--
ALTER TABLE 'Mailsjabloon'
  ADD PRIMARY KEY ('id');

--
-- Indexes for table 'Persoon'
--
ALTER TABLE 'Persoon'
  ADD PRIMARY KEY ('id'),
  ADD KEY 'jaarId' ('jaarId');

--
-- Indexes for table 'PersoonInHerinnering'
--
ALTER TABLE 'PersoonInHerinnering'
  ADD KEY 'mailreminderId' ('mailherinneringId'),
  ADD KEY 'persoonId' ('persoonId');

--
-- Indexes for table 'Plaats'
--
ALTER TABLE 'Plaats'
  ADD PRIMARY KEY ('id');

--
-- Indexes for table 'Shift'
--
ALTER TABLE 'Shift'
  ADD PRIMARY KEY ('id'),
  ADD KEY 'taakId' ('taakId');

--
-- Indexes for table 'Taak'
--
ALTER TABLE 'Taak'
  ADD PRIMARY KEY ('id'),
  ADD KEY 'keuzemogelijkheidId' ('keuzemogelijkheidId');

--
-- Indexes for table 'VrijwilligersInShift'
--
ALTER TABLE 'VrijwilligersInShift'
  ADD KEY 'shiftId' ('shiftId'),
  ADD KEY 'persoonId' ('persoonId');

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table 'Beheer'
--
ALTER TABLE 'Beheer'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table 'Jaargang'
--
ALTER TABLE 'Jaargang'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table 'KeuzeMogelijkheid'
--
ALTER TABLE 'KeuzeMogelijkheid'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table 'KeuzeOptie'
--
ALTER TABLE 'KeuzeOptie'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table 'MailHerinnering'
--
ALTER TABLE 'MailHerinnering'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table 'Mailsjabloon'
--
ALTER TABLE 'Mailsjabloon'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table 'Persoon'
--
ALTER TABLE 'Persoon'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table 'Plaats'
--
ALTER TABLE 'Plaats'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table 'Shift'
--
ALTER TABLE 'Shift'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table 'Taak'
--
ALTER TABLE 'Taak'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table 'Persoon'
--
ALTER TABLE 'Persoon'
  ADD CONSTRAINT 'Persoon_ibfk_1' FOREIGN KEY ('jaarId') REFERENCES 'Jaargang' ('id') ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table 'Shift'
--
ALTER TABLE 'Shift'
  ADD CONSTRAINT 'Shift_ibfk_1' FOREIGN KEY ('taakId') REFERENCES 'Taak' ('id') ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table 'VrijwilligersInShift'
--
ALTER TABLE 'VrijwilligersInShift'
  ADD CONSTRAINT 'VrijwilligersInShift_ibfk_1' FOREIGN KEY ('persoonId') REFERENCES 'Persoon' ('id') ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
