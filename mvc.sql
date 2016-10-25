-- phpMiniAdmin dump 1.9.160630
-- Datetime: 2016-10-25 09:54:21
-- Host: localhost
-- Database: i2910768_wp1

/*!40030 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `secret_code` varchar(255) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('1','tien_dat','08a01023fb153e81625a5c37fc99d32c','tiendatbt19@gmail.com','17cd7fa10ceb7f41b556d263f6ba0270',NULL,NULL,NULL,'2016-10-23 20:57:24',NULL),('2','khanhnguyen','c823b1941f16dc38c8089f5f46065995','khanhbe1995@gmail.com','256045223f8eb3a592052349bd4649a5',NULL,NULL,NULL,'2016-10-23 20:59:39',NULL),('3','thong','29021649042a6e3620e9abb91e40bd7d','cuongmanh.95@gmail.com','9a5324e93a7f37a1f1f197a7a99edfb2','132 123 1237','','1999-04-20','2016-10-24 18:46:53',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;


-- phpMiniAdmin dump end
