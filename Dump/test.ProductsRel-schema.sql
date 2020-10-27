/*!40101 SET NAMES binary*/;
/*!40014 SET FOREIGN_KEY_CHECKS=0*/;

/*!40103 SET TIME_ZONE='+00:00' */;
CREATE TABLE `ProductsRel` (
  `Id` int NOT NULL,
  `RelId` int NOT NULL,
  PRIMARY KEY (`Id`,`RelId`),
  CONSTRAINT `Product_fk` FOREIGN KEY (`Id`) REFERENCES `Products` (`Id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
