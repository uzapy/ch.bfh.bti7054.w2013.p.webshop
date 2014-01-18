SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Database: `plattelade`
-- Table structure for table `Kunden`

CREATE TABLE `Kunden` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` tinytext,
  `LastName` tinytext,
  `EMail` tinytext,
  `Password` tinytext,
  `PhoneNumber` tinytext,
  `LastFmUser` tinytext,
  `AddressID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;