SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Database: `plattelade`
-- Table structure for table `Platten`

CREATE TABLE `Platten` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Artist` tinytext,
  `Album` tinytext,
  `Year` year(4) DEFAULT NULL,
  `Country` tinytext,
  `Genre` tinytext,
  `Style` tinytext,
  `Label` tinytext,
  `Number` tinytext,
  `CoverName` tinytext,
  `Price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`),
  KEY `ID_2` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;