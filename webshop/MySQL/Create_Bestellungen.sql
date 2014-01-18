SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Database: `plattelade`
-- Table structure for table `Bestellungen`

CREATE TABLE `Bestellungen` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KundenID` int(11) DEFAULT NULL,
  `PaymentMethod` tinytext,
  `ShippingMethod` tinytext,
  `BillingAddressID` int(11) DEFAULT NULL,
  `IsShipped` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;