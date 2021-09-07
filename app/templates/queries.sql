CREATE TABLE `user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL DEFAULT '',
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- myapp.offer definition

CREATE TABLE `offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offertext` text CHARACTER SET utf8,
  `offerdate` date NOT NULL,
  `userId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE offer ADD COLUMN userId INT;
CREATE INDEX index_userId ON offer (userId);

INSERT INTO `offer` SET
`offertext` = 'How many programmers does it take to screw in a lightbulb? None, it\'s a
hardware problem.',
`offerdate` = '2017-04-01',
`userId` = 1;
INSERT INTO `offer` (`offertext`, `offerdate`, `userId`)
VALUES (
'Why did the programmer quit his job? He didn\'t get arrays',
'2017-04-01', 1);
INSERT INTO `offer` (`offertext`, `offerdate`, `userId`)
VALUES (
'Why was the empty array stuck outside? It didn\'t have any keys',
'2017-04-01', 2);

CREATE TABLE `offer_category` (
`offerId` INT NOT NULL,
`categoryId` INT NOT NULL,
PRIMARY KEY (`offerId`, `categoryId`)
) DEFAULT CHARSET=utf8mb4 ENGINE=InnoDB;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
