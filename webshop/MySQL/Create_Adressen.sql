SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Database: `plattelade`
-- Table structure for table `Adressen`

CREATE TABLE `Adressen` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Street` tinytext,
  `Number` tinytext,
  `PostalCode` tinytext,
  `City` tinytext,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;
