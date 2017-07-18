/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.10-MariaDB : Database - srider_schema
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`srider_schema` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `srider_schema`;

/*Table structure for table `agency` */

DROP TABLE IF EXISTS `agency`;

CREATE TABLE `agency` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(180) DEFAULT NULL,
  `contact` varchar(200) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city_id` int(255) DEFAULT NULL,
  `zip_code` varchar(150) DEFAULT NULL,
  `country_id` int(255) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `license` varchar(150) DEFAULT NULL,
  `license_file` varchar(150) DEFAULT NULL,
  `insurance` varchar(150) DEFAULT NULL,
  `insurance_file` varchar(150) DEFAULT NULL,
  `contract_type` int(50) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `commission` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `agency` */

/*Table structure for table `agency_info` */

DROP TABLE IF EXISTS `agency_info`;

CREATE TABLE `agency_info` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `license` varchar(150) DEFAULT NULL,
  `license_file` varchar(150) DEFAULT NULL,
  `insurance` varchar(150) DEFAULT NULL,
  `insurance_file` varchar(150) DEFAULT NULL,
  `contract_type_id` int(50) DEFAULT NULL,
  `commission` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `agency_info` */

/*Table structure for table `booking` */

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `pickup_date` varchar(100) DEFAULT NULL COMMENT 'timestamp with reservation date and hour',
  `reservation_date` varchar(100) DEFAULT NULL,
  `car_type_id` int(255) DEFAULT NULL,
  `cost` int(50) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `pickup` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `waypoints` varchar(255) DEFAULT NULL COMMENT 'json with users''s waipoints until destination',
  `created_at` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '1 / 0  == accepted / cancelled',
  `cancelations` int(10) DEFAULT NULL,
  `canceled_by` int(255) DEFAULT NULL,
  `insurance_id` int(255) DEFAULT NULL,
  `flight` varchar(150) DEFAULT NULL,
  `terminal` varchar(100) DEFAULT NULL,
  `referral` int(255) DEFAULT NULL COMMENT 'user id of the driver/agency that confirmed',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `insurance_id` (`insurance_id`),
  KEY `car_type_id` (`car_type_id`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`insurance_id`) REFERENCES `insurance` (`id`),
  CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`car_type_id`) REFERENCES `car_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `booking` */

/*Table structure for table `car` */

DROP TABLE IF EXISTS `car`;

CREATE TABLE `car` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `model` varchar(150) DEFAULT NULL,
  `brand_id` int(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `made_year` varchar(5) DEFAULT NULL,
  `seats_number` int(10) DEFAULT NULL COMMENT 'max persons',
  `max_luggage` int(10) DEFAULT NULL COMMENT 'max number of luggages',
  PRIMARY KEY (`id`),
  KEY `brand_id` (`brand_id`),
  CONSTRAINT `car_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `car_brand` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `car` */

/*Table structure for table `car_brand` */

DROP TABLE IF EXISTS `car_brand`;

CREATE TABLE `car_brand` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `car_brand` */

/*Table structure for table `car_type` */

DROP TABLE IF EXISTS `car_type`;

CREATE TABLE `car_type` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `brand_id` int(255) DEFAULT NULL,
  `tariff_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brand_id` (`brand_id`),
  KEY `tariff_id` (`tariff_id`),
  CONSTRAINT `car_type_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `car_brand` (`id`),
  CONSTRAINT `car_type_ibfk_2` FOREIGN KEY (`tariff_id`) REFERENCES `tariff` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `car_type` */

/*Table structure for table `city` */

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `city` */

/*Table structure for table `cms` */

DROP TABLE IF EXISTS `cms`;

CREATE TABLE `cms` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) DEFAULT NULL,
  `body_text` varchar(255) DEFAULT NULL,
  `page_type` tinyint(1) DEFAULT NULL COMMENT '1 == cms page | 0 == ads',
  `user_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cms` */

/*Table structure for table `commission` */

DROP TABLE IF EXISTS `commission`;

CREATE TABLE `commission` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `percentage` int(100) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `commission` */

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `phone_prefix` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `country` */

/*Table structure for table `county` */

DROP TABLE IF EXISTS `county`;

CREATE TABLE `county` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `county` */

/*Table structure for table `cron` */

DROP TABLE IF EXISTS `cron`;

CREATE TABLE `cron` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cron` */

/*Table structure for table `days` */

DROP TABLE IF EXISTS `days`;

CREATE TABLE `days` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `days` */

/*Table structure for table `documents` */

DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `photo` varchar(200) DEFAULT NULL,
  `police_record` varchar(200) DEFAULT NULL,
  `driver_licence` varchar(200) DEFAULT NULL,
  `car_insurance` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `documents` */

/*Table structure for table `earnings` */

DROP TABLE IF EXISTS `earnings`;

CREATE TABLE `earnings` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT NULL,
  `booking_id` int(255) DEFAULT NULL,
  `sum` int(100) DEFAULT NULL,
  `created_at` varchar(150) DEFAULT NULL,
  `penalty` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `earnings` */

/*Table structure for table `hour_color` */

DROP TABLE IF EXISTS `hour_color`;

CREATE TABLE `hour_color` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `color` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hour_color` */

/*Table structure for table `insurance` */

DROP TABLE IF EXISTS `insurance`;

CREATE TABLE `insurance` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `percent` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `insurance` */

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `languages` */

/*Table structure for table `permission` */

DROP TABLE IF EXISTS `permission`;

CREATE TABLE `permission` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(50) DEFAULT NULL,
  `resource_id` int(150) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resource_id` (`resource_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `permission` */

insert  into `permission`(`id`,`permission_name`,`resource_id`,`active`) values (1,'index',1,1),(2,'srider',2,1),(3,'index',4,1);

/*Table structure for table `resource` */

DROP TABLE IF EXISTS `resource`;

CREATE TABLE `resource` (
  `id` int(150) NOT NULL AUTO_INCREMENT,
  `resource_name` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `resource` */

insert  into `resource`(`id`,`resource_name`,`active`) values (1,'Srider\\Controller\\Login',1),(2,'Srider\\Controller\\Index',1),(3,'Srider\\Controller\\User',1),(4,'Srider\\Controller\\Srider',1);

/*Table structure for table `reviews` */

DROP TABLE IF EXISTS `reviews`;

CREATE TABLE `reviews` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL,
  `booking_id` int(255) DEFAULT NULL,
  `rating` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `reviews` */

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `role` */

insert  into `role`(`id`,`role_name`,`active`) values (1,'Superadmin',1),(2,'Agency',1),(3,'Driver',1),(4,'User',1),(5,'Customer care',1);

/*Table structure for table `role_permission` */

DROP TABLE IF EXISTS `role_permission`;

CREATE TABLE `role_permission` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `role_id` int(100) DEFAULT NULL,
  `permission_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `role_permission` */

insert  into `role_permission`(`id`,`role_id`,`permission_id`) values (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,2,1),(6,2,2),(7,3,1),(8,3,3);

/*Table structure for table `routes` */

DROP TABLE IF EXISTS `routes`;

CREATE TABLE `routes` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `from` varchar(200) DEFAULT NULL,
  `to` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `routes` */

/*Table structure for table `tariff` */

DROP TABLE IF EXISTS `tariff`;

CREATE TABLE `tariff` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `price` int(100) DEFAULT NULL,
  `price_km` int(100) DEFAULT NULL,
  `minimum_price` int(100) DEFAULT NULL,
  `hour_color_id` int(50) DEFAULT NULL,
  `route_id` int(255) DEFAULT NULL,
  `day_id` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hour_color_id` (`hour_color_id`),
  KEY `route_id` (`route_id`),
  KEY `day_id` (`day_id`),
  CONSTRAINT `tariff_ibfk_1` FOREIGN KEY (`hour_color_id`) REFERENCES `hour_color` (`id`),
  CONSTRAINT `tariff_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`),
  CONSTRAINT `tariff_ibfk_3` FOREIGN KEY (`day_id`) REFERENCES `days` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tariff` */

/*Table structure for table `user_history` */

DROP TABLE IF EXISTS `user_history`;

CREATE TABLE `user_history` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT NULL,
  `booking_id` int(255) DEFAULT NULL,
  `created_at` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_history` */

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT NULL,
  `role_id` int(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`user_id`,`role_id`,`active`) values (1,1,1,1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `address` varchar(120) DEFAULT NULL,
  `post_code` varchar(20) DEFAULT NULL,
  `city_id` int(255) DEFAULT NULL,
  `county_id` int(255) DEFAULT NULL,
  `country_id` int(255) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `facebook_user` tinyint(1) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `created_by` int(255) DEFAULT NULL,
  `agency_id` int(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `commission_id` int(255) DEFAULT NULL,
  `documents_id` int(255) DEFAULT NULL,
  `experience` varchar(200) DEFAULT NULL,
  `language_id` int(255) DEFAULT NULL,
  `role_id` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`),
  KEY `city_id` (`city_id`),
  KEY `agency_id` (`agency_id`),
  KEY `agency_commission` (`commission_id`),
  KEY `county_id` (`county_id`),
  KEY `documents_id` (`documents_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `users_ibfk_3` FOREIGN KEY (`agency_id`) REFERENCES `agency_info` (`id`),
  CONSTRAINT `users_ibfk_4` FOREIGN KEY (`commission_id`) REFERENCES `commission` (`id`),
  CONSTRAINT `users_ibfk_5` FOREIGN KEY (`county_id`) REFERENCES `county` (`id`),
  CONSTRAINT `users_ibfk_6` FOREIGN KEY (`documents_id`) REFERENCES `documents` (`id`),
  CONSTRAINT `users_ibfk_7` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`last_name`,`email`,`phone`,`fax`,`address`,`post_code`,`city_id`,`county_id`,`country_id`,`website`,`password`,`facebook_user`,`image`,`created_at`,`updated_at`,`created_by`,`agency_id`,`active`,`commission_id`,`documents_id`,`experience`,`language_id`,`role_id`) values (1,'Dan','Brinzaru','dan.brinzaru@gmail.com','123','321','Str ','725100',NULL,NULL,NULL,NULL,'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
