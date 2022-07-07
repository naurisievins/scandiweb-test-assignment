CREATE TABLE `products` (
  `pID` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `pSKU` varchar(50) NOT NULL UNIQUE KEY,
  `pName` varchar(50) NOT NULL,
  `pPrice` decimal(10,2) UNSIGNED NOT NULL,
  `pType` varchar(4) NOT NULL,
  `pSize` decimal(10,2) UNSIGNED DEFAULT NULL,
  `pWeight` decimal(10,2) UNSIGNED DEFAULT NULL,
  `pDimH` decimal(10,2) UNSIGNED DEFAULT NULL,
  `pDimW` decimal(10,2) UNSIGNED DEFAULT NULL,
  `pdimL` decimal(10,2) UNSIGNED DEFAULT NULL
)