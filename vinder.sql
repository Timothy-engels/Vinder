SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `vinder`
--
CREATE DATABASE IF NOT EXISTS `vinder` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `vinder`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accountexpertises`
--

CREATE TABLE `accountexpertises` (
  `ID` int(11) NOT NULL,
  `AccountID` int(11) NOT NULL,
  `ExpertiseID` int(11) NOT NULL,
  `Info` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accountexpertisesextra`
--

CREATE TABLE `accountexpertisesextra` (
  `ID` int(11) NOT NULL,
  `AccountID` int(11) NOT NULL,
  `ExpertiseNaam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Info` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accountmeerinfo`
--

CREATE TABLE `accountmeerinfo` (
  `ID` int(11) NOT NULL,
  `AccountID` int(11) NOT NULL,
  `ExpertiseID` int(11) NOT NULL,
  `Info` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accountmeerinfoextra`
--

CREATE TABLE `accountmeerinfoextra` (
  `ID` int(11) NOT NULL,
  `AccountID` int(11) NOT NULL,
  `MeerinfoNaam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Info` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Contactpersoon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Emailadres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Wachtwoord` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Bevestigd` tinyint(1) NOT NULL,
  `Website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Logo` text COLLATE utf8_unicode_ci,
  `Info` text COLLATE utf8_unicode_ci,
  `Admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `expertises`
--

CREATE TABLE `expertises` (
  `ID` int(11) NOT NULL,
  `Expertise` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Actief` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `expertises`
--

INSERT INTO `expertises` (`ID`, `Expertise`, `Actief`) VALUES
(1, 'Loopbaanbegeleiding', 1),
(2, '55+', 1),
(3, 'Industrie', 1),
(4, 'Opleidingen', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `general`
--

CREATE TABLE `general` (
  `RegisterDate` datetime NOT NULL,
  `SwipeDate` datetime NOT NULL,
  `Mail` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `matching`
--

CREATE TABLE `matching` (
  `ID` int(11) NOT NULL,
  `AccountID1` int(11) NOT NULL,
  `AccountID2` int(11) NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `accountexpertises`
--
ALTER TABLE `accountexpertises`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Expertises_idx` (`ExpertiseID`),
  ADD KEY `Accounts_idx` (`AccountID`);

--
-- Indexen voor tabel `accountexpertisesextra`
--
ALTER TABLE `accountexpertisesextra`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Accounts_idx` (`AccountID`);

--
-- Indexen voor tabel `accountmeerinfo`
--
ALTER TABLE `accountmeerinfo`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MeerinfoAccounts_idx` (`AccountID`),
  ADD KEY `MeerinfoExpertises_idx` (`ExpertiseID`);

--
-- Indexen voor tabel `accountmeerinfoextra`
--
ALTER TABLE `accountmeerinfoextra`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MeerinfoextraAccounts_idx` (`AccountID`);

--
-- Indexen voor tabel `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `expertises`
--
ALTER TABLE `expertises`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `matching`
--
ALTER TABLE `matching`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `matchingAccounts1_idx` (`AccountID1`),
  ADD KEY `matchingAccounts2_idx` (`AccountID2`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `accountexpertises`
--
ALTER TABLE `accountexpertises`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `accountexpertisesextra`
--
ALTER TABLE `accountexpertisesextra`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `accountmeerinfo`
--
ALTER TABLE `accountmeerinfo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `accountmeerinfoextra`
--
ALTER TABLE `accountmeerinfoextra`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `expertises`
--
ALTER TABLE `expertises`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `matching`
--
ALTER TABLE `matching`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `accountexpertises`
--
ALTER TABLE `accountexpertises`
  ADD CONSTRAINT `ExpertisesAccounts` FOREIGN KEY (`AccountID`) REFERENCES `accounts` (`ID`),
  ADD CONSTRAINT `ExpertisesExpertises` FOREIGN KEY (`ExpertiseID`) REFERENCES `expertises` (`ID`);

--
-- Beperkingen voor tabel `accountexpertisesextra`
--
ALTER TABLE `accountexpertisesextra`
  ADD CONSTRAINT `ExpertisesextraAccounts` FOREIGN KEY (`AccountID`) REFERENCES `accounts` (`ID`);

--
-- Beperkingen voor tabel `accountmeerinfo`
--
ALTER TABLE `accountmeerinfo`
  ADD CONSTRAINT `MeerinfoAccounts` FOREIGN KEY (`AccountID`) REFERENCES `accounts` (`ID`),
  ADD CONSTRAINT `MeerinfoExpertises` FOREIGN KEY (`ExpertiseID`) REFERENCES `expertises` (`ID`);

--
-- Beperkingen voor tabel `accountmeerinfoextra`
--
ALTER TABLE `accountmeerinfoextra`
  ADD CONSTRAINT `MeerinfoextraAccounts` FOREIGN KEY (`AccountID`) REFERENCES `accounts` (`ID`);

--
-- Beperkingen voor tabel `matching`
--
ALTER TABLE `matching`
  ADD CONSTRAINT `matchingAccounts1` FOREIGN KEY (`AccountID1`) REFERENCES `accounts` (`ID`),
  ADD CONSTRAINT `matchingAccounts2` FOREIGN KEY (`AccountID2`) REFERENCES `accounts` (`ID`);
COMMIT;


GRANT USAGE ON * . * TO 'Admin'@'localhost' IDENTIFIED BY 'KnockKnock';
GRANT SELECT, INSERT, UPDATE, DELETE ON cursusphp.* TO 'Admin'@'localhost';