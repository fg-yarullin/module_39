CREATE TABLE `user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL DEFAULT '',
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- myapp.offer definition

CREATE TABLE `offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offertext` text,
  `offerdate` date NOT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

ALTER TABLE offer ADD COLUMN userid INT;
CREATE INDEX index_userid ON offer (userid);

INSERT INTO `offer` SET
`offertext` = 'How many programmers does it take to screw in a lightbulb? None, it\'s a
hardware problem.',
`offerdate` = '2017-04-01',
`userid` = 1;
INSERT INTO `offer` (`offertext`, `offerdate`, `userid`)
VALUES (
'Why did the programmer quit his job? He didn\'t get arrays',
'2017-04-01', 1);
INSERT INTO `offer` (`offertext`, `offerdate`, `userid`)
VALUES (
'Why was the empty array stuck outside? It didn\'t have any keys',
'2017-04-01', 2);

CREATE TABLE `offercategory` (
`offerid` INT NOT NULL,
`categoryid` INT NOT NULL,
PRIMARY KEY (`offerid`, `categoryid`)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

CREATE TABLE `category` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` VARCHAR(255)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;


