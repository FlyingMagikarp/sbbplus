-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 13. Mrz 2019 um 17:55
-- Server-Version: 10.1.37-MariaDB
-- PHP-Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `sbbplus`
--
CREATE DATABASE IF NOT EXISTS `sbbplus` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sbbplus`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `connection`
--

DROP TABLE IF EXISTS `connection`;
CREATE TABLE `connection` (
  `ID` int(11) NOT NULL,
  `RouteID` int(11) NOT NULL,
  `RoutePOS` int(11) NOT NULL,
  `FromStation` int(11) NOT NULL,
  `ToStation` int(11) NOT NULL,
  `TravelTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `connection`
--

INSERT INTO `connection` (`ID`, `RouteID`, `RoutePOS`, `FromStation`, `ToStation`, `TravelTime`) VALUES
(13, 8, 1, 1, 3, 12),
(15, 8, 2, 3, 2, 7),
(16, 8, 3, 2, 4, 5),
(17, 9, 1, 4, 2, 5),
(19, 11, 1, 1, 2, 12),
(20, 12, 1, 1, 1, 12),
(21, 13, 1, 1, 2, 13);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `material`
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE `material` (
  `ID` int(11) NOT NULL,
  `SN` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `DateStart` date NOT NULL,
  `LastCheck` date NOT NULL,
  `NextCheck` date NOT NULL,
  `Class` int(11) NOT NULL,
  `Space` int(11) NOT NULL,
  `Available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `material`
--

INSERT INTO `material` (`ID`, `SN`, `Type`, `DateStart`, `LastCheck`, `NextCheck`, `Class`, `Space`, `Available`) VALUES
(1, 12345678, 0, '2018-12-01', '2019-03-01', '2019-04-01', 0, 0, 1),
(2, 1235431, 1, '2019-03-01', '2019-03-02', '2019-03-03', 1, 120, 1),
(3, 1234561231, 1, '2019-03-22', '2019-03-10', '2019-03-23', 2, 140, 1),
(4, 87654321, 1, '2019-03-16', '2019-03-09', '2019-03-03', 2, 120, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `materialtype`
--

DROP TABLE IF EXISTS `materialtype`;
CREATE TABLE `materialtype` (
  `ID` int(11) NOT NULL,
  `Type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `materialtype`
--

INSERT INTO `materialtype` (`ID`, `Type`) VALUES
(1, 'Lokomotive'),
(2, 'Wagen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `ID` int(11) NOT NULL,
  `Role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `role`
--

INSERT INTO `role` (`ID`, `Role`) VALUES
(1, 'Lokomotivführer'),
(2, 'Kontrolleur');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `route`
--

DROP TABLE IF EXISTS `route`;
CREATE TABLE `route` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Configuration` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `route`
--

INSERT INTO `route` (`ID`, `Name`, `Configuration`) VALUES
(8, 'Test Line 1', '1::1::1'),
(9, 'Test Line 2', '1::1::2'),
(13, 'Test Linie 3', '1::1::2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `station`
--

DROP TABLE IF EXISTS `station`;
CREATE TABLE `station` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Wait` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `station`
--

INSERT INTO `station` (`ID`, `Name`, `Wait`) VALUES
(1, 'Ostermundigen', 2),
(2, 'Zollikofen', 2),
(3, 'Bern', 5),
(4, 'Moosseedorf', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `worker`
--

DROP TABLE IF EXISTS `worker`;
CREATE TABLE `worker` (
  `ID` int(11) NOT NULL,
  `WorkerNr` int(11) NOT NULL,
  `Firstname` text NOT NULL,
  `Lastname` text NOT NULL,
  `Role` text NOT NULL,
  `Absent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `worker`
--

INSERT INTO `worker` (`ID`, `WorkerNr`, `Firstname`, `Lastname`, `Role`, `Absent`) VALUES
(1, 1, 'John', 'Doe', 'Lokomotivführer', 0),
(2, 12345678, 'Max', 'Mustermann', 'Kontrolleur', 0),
(3, 10, 'Oscar', 'Reynolds', 'Lokomotivführer', 0),
(4, 11, 'Kayle', 'Parker', 'Lokomotivführer', 0),
(5, 12, 'Thomas', 'Perry', 'Lokomotivführer', 0),
(6, 13, 'Jack', 'Moore', 'Lokomotivführer', 0),
(7, 14, 'Jack', 'Berry', 'Lokomotivführer', 0),
(8, 15, 'John', 'Simmons', 'Lokomotivführer', 0),
(9, 16, 'John', 'Simmons', 'Kontrolleur', 0),
(10, 17, 'John', 'Rodriguez', 'Lokomotivführer', 0),
(11, 18, 'John', 'Rodriguez', 'Kontrolleur', 0),
(12, 19, 'John', 'Henry', 'Lokomotivführer', 0),
(13, 20, 'John', 'Henry', 'Kontrolleur', 0),
(14, 21, 'John', 'Stewart', 'Lokomotivführer', 0),
(15, 22, 'John', 'Stewart', 'Kontrolleur', 0),
(16, 23, 'John', 'Warren', 'Lokomotivführer', 0),
(17, 24, 'John', 'Warren', 'Kontrolleur', 0),
(18, 25, 'John', 'Anderson', 'Lokomotivführer', 0),
(19, 26, 'John', 'Anderson', 'Kontrolleur', 0),
(20, 27, 'John', 'Cook', 'Lokomotivführer', 0),
(21, 28, 'John', 'Cook', 'Kontrolleur', 0),
(22, 29, 'John', 'Lewis', 'Lokomotivführer', 0),
(23, 30, 'John', 'Lewis', 'Kontrolleur', 0),
(24, 31, 'John', 'Wagner', 'Lokomotivführer', 0),
(25, 32, 'John', 'Wagner', 'Kontrolleur', 0),
(26, 15, 'John', 'Hughes', 'Lokomotivführer', 0),
(27, 15, 'John', 'Hughes', 'Kontrolleur', 0),
(28, 50, 'Hans', 'Hughes', 'Kontrolleur', 0),
(29, 51, 'Hans', 'Jenkins', 'Kontrolleur', 0),
(30, 52, 'Hans', 'Wright', 'Kontrolleur', 0),
(31, 53, 'Hans', 'Reid', 'Kontrolleur', 0),
(32, 54, 'Hans', 'Murphy', 'Kontrolleur', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `connection`
--
ALTER TABLE `connection`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `materialtype`
--
ALTER TABLE `materialtype`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `connection`
--
ALTER TABLE `connection`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT für Tabelle `material`
--
ALTER TABLE `material`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `materialtype`
--
ALTER TABLE `materialtype`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `role`
--
ALTER TABLE `role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `route`
--
ALTER TABLE `route`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `station`
--
ALTER TABLE `station`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `worker`
--
ALTER TABLE `worker`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
