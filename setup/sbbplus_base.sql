-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Mrz 2019 um 22:56
-- Server-Version: 10.1.9-MariaDB
-- PHP-Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `Name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `material`
--
ALTER TABLE `material`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `station`
--
ALTER TABLE `station`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `worker`
--
ALTER TABLE `worker`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
