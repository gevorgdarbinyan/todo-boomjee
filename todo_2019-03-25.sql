# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.36-MariaDB)
# Database: todo
# Generation Time: 2019-03-25 11:28:24 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tbl_tasks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_tasks`;

CREATE TABLE `tbl_tasks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `task` text,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_tasks` WRITE;
/*!40000 ALTER TABLE `tbl_tasks` DISABLE KEYS */;

INSERT INTO `tbl_tasks` (`id`, `username`, `email`, `task`, `status`)
VALUES
	(1,'terry','terry@gmail.com','Implement Todo functionality with MVC 1312321','completed'),
	(2,'anya','anya20@gmail.com','To correct all styles in the bootstrap griddfs','new'),
	(4,'gevorgd','gdarbinyan@bk.ru','asdsadad','completed'),
	(5,'gevorgd','gdarbinyan@bk.ru','To implement page save fucntionality','new'),
	(6,'poghos','poghos@gmail.com','blah blah blah','completed'),
	(7,'user1','user1@gmail.com','blah blah blah','completed'),
	(8,'aramix','aram88@gmail.com','blah blah blah','new'),
	(9,'user2','user2@gmail.com','task 122324','new'),
	(11,'ssdfdsf','sdfds@sdfsf.coms','sdfsfsf','new'),
	(12,'usss','uss@gmail.com','skjdhfsdkfjhsdkhfj','new'),
	(13,'ervand','ervand@gmail.com','task tas =k tas ','completed'),
	(14,'sally','sally_bright@gmail.com','this my task schedule','new'),
	(15,'tom_brown','tom_brown_manchester','1. Create project with React JS using create-react-app module. \r\n2. The same project with Redux','completed'),
	(16,'gevorgd12','gdarbinyan19@gmail.com','sdfsfsf','completed'),
	(17,'asdad','asdad@mail.ru','fhsdjfhsdkjfh','new');

/*!40000 ALTER TABLE `tbl_tasks` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
