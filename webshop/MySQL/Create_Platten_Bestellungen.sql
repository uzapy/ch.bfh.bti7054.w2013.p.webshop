SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Database: `plattelade`
-- Table structure for table `Platten_Bestellungen`

CREATE TABLE `Platten_Bestellungen` (
  `PlattenID` int(11) NOT NULL,
  `BestellungID` int(11) NOT NULL,
  `WithDigitalDownload` tinyint(1) DEFAULT NULL,
  `Anzahl` int(11) DEFAULT NULL,
  PRIMARY KEY (`PlattenID`,`BestellungID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;