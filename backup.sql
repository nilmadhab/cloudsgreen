/*
SQLyog Enterprise - MySQL GUI v8.02 RC
MySQL - 5.6.11 : Database - hawking
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`hawking` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `hawking`;

/*Table structure for table `ebills` */

DROP TABLE IF EXISTS `ebills`;

CREATE TABLE `ebills` (
  `bill_id` int(32) NOT NULL AUTO_INCREMENT,
  `bill_comp_id` varchar(32) NOT NULL,
  `bill_user_id` char(32) NOT NULL,
  `bill_amt` double(64,0) NOT NULL,
  `bill_transac_id` varchar(64) DEFAULT NULL,
  `bill_status` varchar(10) DEFAULT NULL,
  `bill_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sno` int(8) NOT NULL,
  `particulars` varchar(64) DEFAULT NULL,
  `quantity` int(8) NOT NULL,
  `amount` double(64,0) NOT NULL,
  `bill_type` int(8) NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ebills` */

LOCK TABLES `ebills` WRITE;

insert  into `ebills`(`bill_id`,`bill_comp_id`,`bill_user_id`,`bill_amt`,`bill_transac_id`,`bill_status`,`bill_date`,`sno`,`particulars`,`quantity`,`amount`,`bill_type`) values (1,'1','12',123,'2344','444','2014-04-06 20:20:17',2,'kldskm',34,23,2),(2,'1','23',567,'3345','0','2014-04-07 12:43:09',3,'fdfv',56,56,4);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
