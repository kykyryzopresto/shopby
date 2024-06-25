CREATE TABLE `coins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Cur_ID` int(11) NOT NULL,
  `Cur_Abbreviation` varchar(255) NOT NULL,
  `Cur_Scale` int(11) NOT NULL,
  `Cur_Name` varchar(255) NOT NULL,
  `Cur_OfficialRate` float NOT NULL,
  `Date` timestamp NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

