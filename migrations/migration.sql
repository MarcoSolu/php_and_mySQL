DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `travel_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `countries_ibfk_1_idx` (`travel_name`),
  CONSTRAINT `countries_ibfk_1` FOREIGN KEY (`travel_name`) REFERENCES `travels` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



LOCK TABLES `countries` WRITE;

INSERT INTO `countries` VALUES (1,'Italy','A travel inside the european culture'),(2,'France','A travel inside the european culture'),(3,'Germany','A travel inside the european culture'),(4,'United States of America','Visit some of the most famous country of the U.S.A.'),(5,'Japan','The fascinating country of Japan');

UNLOCK TABLES;



DROP TABLE IF EXISTS `travels`;

CREATE TABLE `travels` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `seats_available` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


LOCK TABLES `travels` WRITE;

INSERT INTO `travels` VALUES (1,'A travel inside the european culture',45),(2,'Visit some of the most famous country of the U.S.A.',40),(3,'The fascinating country of Japan',35);

UNLOCK TABLES;
