-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: aq
-- ------------------------------------------------------
-- Server version	5.7.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application` (
  `application_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `application_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_dtm` datetime DEFAULT NULL,
  `last_update_dtm` datetime DEFAULT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application`
--

LOCK TABLES `application` WRITE;
/*!40000 ALTER TABLE `application` DISABLE KEYS */;
INSERT INTO `application` VALUES ('00000000-0000-0000-0000-000000000000','fw','2012-06-23 22:57:27',NULL);
/*!40000 ALTER TABLE `application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `average_type`
--

DROP TABLE IF EXISTS `average_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `average_type` (
  `average_type_cd` varchar(10) NOT NULL,
  `average_type_name` varchar(100) DEFAULT NULL,
  `average_type_description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`average_type_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `average_type`
--

LOCK TABLES `average_type` WRITE;
/*!40000 ALTER TABLE `average_type` DISABLE KEYS */;
INSERT INTO `average_type` VALUES ('01','Local',NULL),('02','State',NULL),('03','National',NULL);
/*!40000 ALTER TABLE `average_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms`
--

DROP TABLE IF EXISTS `cms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms` (
  `cms_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `html` longtext COLLATE utf8_unicode_ci,
  `spanish_html` longtext COLLATE utf8_unicode_ci,
  `creation_dtm` datetime DEFAULT NULL,
  `last_update_dtm` datetime DEFAULT NULL,
  PRIMARY KEY (`cms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms`
--

LOCK TABLES `cms` WRITE;
/*!40000 ALTER TABLE `cms` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filter_type`
--

DROP TABLE IF EXISTS `filter_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filter_type` (
  `filter_type_cd` varchar(10) NOT NULL,
  `filter_type_name` varchar(100) DEFAULT NULL,
  `filter_type_description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`filter_type_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filter_type`
--

LOCK TABLES `filter_type` WRITE;
/*!40000 ALTER TABLE `filter_type` DISABLE KEYS */;
INSERT INTO `filter_type` VALUES ('01','PUR Faucet Filter',NULL),('02','3M  AquaPure System',NULL),('03','Custom Filter Required',NULL);
/*!40000 ALTER TABLE `filter_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `health_risk_type`
--

DROP TABLE IF EXISTS `health_risk_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `health_risk_type` (
  `health_risk_type_cd` varchar(10) NOT NULL,
  `health_risk_type_name` varchar(100) DEFAULT NULL,
  `health_risk_type_description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`health_risk_type_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `health_risk_type`
--

LOCK TABLES `health_risk_type` WRITE;
/*!40000 ALTER TABLE `health_risk_type` DISABLE KEYS */;
INSERT INTO `health_risk_type` VALUES ('01','Cancer',NULL);
/*!40000 ALTER TABLE `health_risk_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `limit_type`
--

DROP TABLE IF EXISTS `limit_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `limit_type` (
  `limit_type_cd` varchar(10) NOT NULL,
  `limit_type_name` varchar(100) DEFAULT NULL,
  `limit_type_description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`limit_type_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `limit_type`
--

LOCK TABLES `limit_type` WRITE;
/*!40000 ALTER TABLE `limit_type` DISABLE KEYS */;
INSERT INTO `limit_type` VALUES ('01','Health',NULL),('02','State',NULL),('03','National',NULL);
/*!40000 ALTER TABLE `limit_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property`
--

DROP TABLE IF EXISTS `property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property` (
  `property_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `application_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `property_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_dtm` datetime DEFAULT NULL,
  `last_update_dtm` datetime DEFAULT NULL,
  PRIMARY KEY (`property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property`
--

LOCK TABLES `property` WRITE;
/*!40000 ALTER TABLE `property` DISABLE KEYS */;
INSERT INTO `property` VALUES ('a44bcfce-2cc2-11e5-a142-34e6d70bc33a','d771134f-bd86-11e1-a2da-0303030a26a1','age','2015-07-17 15:30:19',NULL),('c460fd80-bda1-11e1-a2da-0303030a26a1','d771134f-bd86-11e1-a2da-0303030a26a1','first_name','2012-06-24 02:10:13',NULL),('cdb7f207-bda1-11e1-a2da-0303030a26a1','d771134f-bd86-11e1-a2da-0303030a26a1','last_name','2012-06-24 02:10:28',NULL);
/*!40000 ALTER TABLE `property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `role_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `application_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_dtm` datetime DEFAULT NULL,
  `last_update_dtm` datetime DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES ('49cc6f5e-08c1-11e2-bd2d-46e6b1c0b23a','00000000-0000-0000-0000-000000000000','User',NULL,NULL),('683cfd4e-08bf-11e2-bd2d-46e6b1c0b23a','00000000-0000-0000-0000-000000000000','Administrator',NULL,NULL),('d4a5684e-0991-11e2-bd2d-46e6b1c0b23a','00000000-0000-0000-0000-000000000000','Guest',NULL,NULL);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `setting_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `application_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setting_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setting_value` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_dtm` datetime DEFAULT NULL,
  `last_update_dtm` datetime DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `source_type`
--

DROP TABLE IF EXISTS `source_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `source_type` (
  `source_type_cd` varchar(10) NOT NULL,
  `source_type_name` varchar(100) DEFAULT NULL,
  `source_type_description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`source_type_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `source_type`
--

LOCK TABLES `source_type` WRITE;
/*!40000 ALTER TABLE `source_type` DISABLE KEYS */;
INSERT INTO `source_type` VALUES ('01','Byproduct of Disinfection',NULL),('02','Industrial + Naturally Occuring',NULL);
/*!40000 ALTER TABLE `source_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state_type`
--

DROP TABLE IF EXISTS `state_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state_type` (
  `state_type_cd` varchar(10) NOT NULL,
  `state_type_name` varchar(100) DEFAULT NULL,
  `state_type_description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`state_type_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state_type`
--

LOCK TABLES `state_type` WRITE;
/*!40000 ALTER TABLE `state_type` DISABLE KEYS */;
INSERT INTO `state_type` VALUES ('AK','Alaska',NULL),('AL','Alabama',NULL),('AR','Arkansas',NULL),('AZ','Arizona',NULL),('CA','California',NULL),('CO','Colorado',NULL),('CT','Connecticut',NULL),('DE','Delaware',NULL),('FL','Florida',NULL),('GA','Georgia',NULL),('HI','Hawaii',NULL),('IA','Iowa',NULL),('ID','Idaho',NULL),('IL','Illinois',NULL),('IN','Indiana',NULL),('KS','Kansas',NULL),('KY','Kentucky',NULL),('LA','Louisiana',NULL),('MA','Massachusetts',NULL),('MD','Maryland',NULL),('ME','Maine',NULL),('MI','Michigan',NULL),('MN','Minnesota',NULL),('MO','Missouri',NULL),('MS','Mississippi',NULL),('MT','Montana',NULL),('NC','North Carolina',NULL),('ND','North Dakota',NULL),('NE','Nebraska',NULL),('NH','New Hampshire',NULL),('NJ','New Jersey',NULL),('NM','New Mexico',NULL),('NV','Nevada',NULL),('NY','New York',NULL),('OH','Ohio',NULL),('OK','Oklahoma',NULL),('OR','Oregon',NULL),('PA','Pennsylvania',NULL),('RI','Rhode Island',NULL),('SC','South Carolina',NULL),('SD','South Dakota',NULL),('TN','Tennessee',NULL),('TX','Texas',NULL),('UT','Utah',NULL),('VA','Virginia',NULL),('VT','Vermont',NULL),('WA','Washington',NULL),('WI','Wisconsin',NULL),('WV','West Virginia',NULL),('WY','Wyoming',NULL);
/*!40000 ALTER TABLE `state_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `toxin_average`
--

DROP TABLE IF EXISTS `toxin_average`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `toxin_average` (
  `toxin_average_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `toxin_type_cd` varchar(10) DEFAULT NULL,
  `average_type_cd` varchar(10) DEFAULT NULL,
  `value` decimal(13,7) DEFAULT NULL,
  `creation_user_id` varchar(36) DEFAULT NULL,
  `creation_dtm` datetime(6) DEFAULT NULL,
  `last_update_user_id` varchar(36) DEFAULT NULL,
  `last_update_dtm` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`toxin_average_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `toxin_average`
--

LOCK TABLES `toxin_average` WRITE;
/*!40000 ALTER TABLE `toxin_average` DISABLE KEYS */;
INSERT INTO `toxin_average` VALUES (1,'01','02',1.7900000,NULL,NULL,NULL,NULL),(2,'01','03',4.3100000,NULL,NULL,NULL,NULL),(3,'02','02',6.6700000,NULL,NULL,NULL,NULL),(4,'02','03',11.2000000,NULL,NULL,NULL,NULL),(5,'03','02',0.1420000,NULL,NULL,NULL,NULL),(6,'03','03',0.7970000,NULL,NULL,NULL,NULL),(7,'04','02',0.7140000,NULL,NULL,NULL,NULL),(8,'04','03',0.2960000,NULL,NULL,NULL,NULL),(9,'05','02',3.1900000,NULL,NULL,NULL,NULL),(10,'05','03',6.0000000,NULL,NULL,NULL,NULL),(11,'06','02',11.8000000,NULL,NULL,NULL,NULL),(12,'06','03',23.2000000,NULL,NULL,NULL,NULL),(13,'07','02',3.6600000,NULL,NULL,NULL,NULL),(14,'07','03',4.9200000,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `toxin_average` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `toxin_limit`
--

DROP TABLE IF EXISTS `toxin_limit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `toxin_limit` (
  `toxin_limit_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `toxin_type_cd` varchar(10) DEFAULT NULL,
  `limit_type_cd` varchar(10) DEFAULT NULL,
  `value` decimal(13,7) DEFAULT NULL,
  `creation_user_id` varchar(36) DEFAULT NULL,
  `creation_dtm` datetime(6) DEFAULT NULL,
  `last_update_user_id` varchar(36) DEFAULT NULL,
  `last_update_dtm` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`toxin_limit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `toxin_limit`
--

LOCK TABLES `toxin_limit` WRITE;
/*!40000 ALTER TABLE `toxin_limit` DISABLE KEYS */;
INSERT INTO `toxin_limit` VALUES (1,'01','01',0.4000000,NULL,NULL,NULL,NULL),(2,'01','02',NULL,NULL,NULL,NULL,NULL),(3,'01','03',NULL,NULL,NULL,NULL,NULL),(4,'02','01',1.0000000,NULL,NULL,NULL,NULL),(5,'02','02',NULL,NULL,NULL,NULL,NULL),(6,'02','03',NULL,NULL,NULL,NULL,NULL),(7,'03','01',0.0200000,NULL,NULL,NULL,NULL),(8,'03','02',NULL,NULL,NULL,NULL,NULL),(9,'03','03',NULL,NULL,NULL,NULL,NULL),(10,'04','01',0.7000000,NULL,NULL,NULL,NULL),(11,'04','02',NULL,NULL,NULL,NULL,NULL),(12,'04','03',NULL,NULL,NULL,NULL,NULL),(13,'05','01',0.7000000,NULL,NULL,NULL,NULL),(14,'05','02',NULL,NULL,NULL,NULL,NULL),(15,'05','03',NULL,NULL,NULL,NULL,NULL),(16,'06','01',0.8000000,NULL,NULL,NULL,NULL),(17,'06','02',NULL,NULL,NULL,NULL,NULL),(18,'06','03',80.0000000,NULL,NULL,NULL,NULL),(19,'07','01',0.5000000,NULL,NULL,NULL,NULL),(20,'07','02',NULL,NULL,NULL,NULL,NULL),(21,'07','03',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `toxin_limit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `toxin_type`
--

DROP TABLE IF EXISTS `toxin_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `toxin_type` (
  `toxin_type_cd` varchar(10) NOT NULL,
  `toxin_type_name` varchar(100) DEFAULT NULL,
  `toxin_type_description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`toxin_type_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `toxin_type`
--

LOCK TABLES `toxin_type` WRITE;
/*!40000 ALTER TABLE `toxin_type` DISABLE KEYS */;
INSERT INTO `toxin_type` VALUES ('01','Bromodichloromethane',NULL),('02','Chloroform',NULL),('03','Chromium (hexavalent)',NULL),('04','Dibromochloromethane',NULL),('05','Dichloroacetic acid',NULL),('06','Total trihalomethanes (TTHMs)',NULL),('07','Trichloroacetic acid',NULL);
/*!40000 ALTER TABLE `toxin_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `application_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approved_flag` tinyint(1) DEFAULT NULL,
  `active_flag` tinyint(1) DEFAULT NULL,
  `last_login_dtm` datetime DEFAULT NULL,
  `creation_dtm` datetime DEFAULT NULL,
  `last_update_dtm` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('4d61e46e-bd87-11e1-a2da-0303030a26a1','d771134f-bd86-11e1-a2da-0303030a26a1','user@qeala.com','user@qeala.com','0rIQrpWRJMM=',1,1,NULL,'2012-06-23 23:00:45','2017-09-15 18:23:55');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_property`
--

DROP TABLE IF EXISTS `user_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_property` (
  `user_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `property_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `property_value` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_dtm` datetime DEFAULT NULL,
  `last_update_dtm` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`,`property_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_property`
--

LOCK TABLES `user_property` WRITE;
/*!40000 ALTER TABLE `user_property` DISABLE KEYS */;
INSERT INTO `user_property` VALUES ('4d61e46e-bd87-11e1-a2da-0303030a26a1','a44bcfce-2cc2-11e5-a142-34e6d70bc33a',NULL,'2017-09-15 18:23:55',NULL),('4d61e46e-bd87-11e1-a2da-0303030a26a1','c460fd80-bda1-11e1-a2da-0303030a26a1',NULL,'2017-09-15 18:23:55',NULL),('4d61e46e-bd87-11e1-a2da-0303030a26a1','cdb7f207-bda1-11e1-a2da-0303030a26a1',NULL,'2017-09-15 18:23:55',NULL);
/*!40000 ALTER TABLE `user_property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `user_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES ('4d61e46e-bd87-11e1-a2da-0303030a26a1','49cc6f5e-08c1-11e2-bd2d-46e6b1c0b23a'),('4d61e46e-bd87-11e1-a2da-0303030a26a1','683cfd4e-08bf-11e2-bd2d-46e6b1c0b23a');
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utility`
--

DROP TABLE IF EXISTS `utility`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utility` (
  `utility_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `state_type_cd` varchar(10) DEFAULT NULL,
  `creation_user_id` varchar(36) DEFAULT NULL,
  `creation_dtm` datetime(6) DEFAULT NULL,
  `last_update_user_id` varchar(36) DEFAULT NULL,
  `last_update_dtm` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`utility_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utility`
--

LOCK TABLES `utility` WRITE;
/*!40000 ALTER TABLE `utility` DISABLE KEYS */;
INSERT INTO `utility` VALUES (1,'Atlanta',NULL,'GA',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `utility` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zip`
--

DROP TABLE IF EXISTS `zip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zip` (
  `zip_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zip_cd` varchar(10) DEFAULT NULL,
  `toxin_type_cd` varchar(10) DEFAULT NULL,
  `health_risk_type_cd` varchar(10) DEFAULT NULL,
  `filter_type_cd` varchar(10) DEFAULT NULL,
  `amount` decimal(13,7) DEFAULT NULL,
  `utility_id` int(11) DEFAULT NULL,
  `sample_dtm` datetime(6) DEFAULT NULL,
  `creation_user_id` varchar(36) DEFAULT NULL,
  `creation_dtm` datetime(6) DEFAULT NULL,
  `last_update_user_id` varchar(36) DEFAULT NULL,
  `last_update_dtm` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`zip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zip`
--

LOCK TABLES `zip` WRITE;
/*!40000 ALTER TABLE `zip` DISABLE KEYS */;
INSERT INTO `zip` VALUES (1,'30308','01','01','01',7.4600000,1,'2018-03-17 00:00:00.000000',NULL,NULL,NULL,NULL),(2,'30308','02','01','01',26.6000000,1,'2018-03-17 00:00:00.000000',NULL,NULL,NULL,NULL),(3,'30308','03','01','02',0.1450000,1,'2018-03-17 00:00:00.000000',NULL,NULL,NULL,NULL),(4,'30308','04','01','03',1.0600000,1,'2018-03-17 00:00:00.000000',NULL,NULL,NULL,NULL),(5,'30308','05','01','03',15.9000000,1,'2018-03-17 00:00:00.000000',NULL,NULL,NULL,NULL),(6,'30308','06','01','02',35.3000000,1,'2018-03-17 00:00:00.000000',NULL,NULL,NULL,NULL),(7,'30308','07','01','03',14.6000000,1,'2018-03-17 00:00:00.000000',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `zip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zip_toxin_source`
--

DROP TABLE IF EXISTS `zip_toxin_source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zip_toxin_source` (
  `zip_toxin_source_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zip_cd` varchar(10) DEFAULT NULL,
  `toxin_type_cd` varchar(10) DEFAULT NULL,
  `source_type_cd` varchar(10) DEFAULT NULL,
  `creation_user_id` varchar(36) DEFAULT NULL,
  `creation_dtm` datetime(6) DEFAULT NULL,
  `last_update_user_id` varchar(36) DEFAULT NULL,
  `last_update_dtm` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`zip_toxin_source_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zip_toxin_source`
--

LOCK TABLES `zip_toxin_source` WRITE;
/*!40000 ALTER TABLE `zip_toxin_source` DISABLE KEYS */;
INSERT INTO `zip_toxin_source` VALUES (1,'30308','01','01',NULL,NULL,NULL,NULL),(2,'30308','02','01',NULL,NULL,NULL,NULL),(3,'30308','03','02',NULL,NULL,NULL,NULL),(4,'30308','04','01',NULL,NULL,NULL,NULL),(5,'30308','05','01',NULL,NULL,NULL,NULL),(6,'30308','06','01',NULL,NULL,NULL,NULL),(7,'30308','07','01',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `zip_toxin_source` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'aq'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_average_type_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_average_type_get`()
BEGIN

select
  a.average_type_cd,
  a.average_type_name,
  a.average_type_description
from
  average_type a;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_average_type_get_by_cd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_average_type_get_by_cd`(
  p_average_type_cd varchar(10)
)
BEGIN

select
  a.average_type_cd,
  a.average_type_name,
  a.average_type_description
from
  average_type a
where
  a.average_type_cd = p_average_type_cd;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_cms_del` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cms_del`(
	p_cms_id varchar(36)
)
delete from
	cms
where
	cms_id = p_cms_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_cms_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cms_get`()
select
	a.cms_id,
	a.name,
	a.html,
	a.spanish_html,
	a.creation_dtm,
	a.last_update_dtm
from
	cms a ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_cms_get_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cms_get_by_id`(
	p_cms_id varchar(36)
)
select
	a.cms_id,
	a.name,
	a.html,
	a.spanish_html,
	a.creation_dtm,
	a.last_update_dtm
from
	cms a
where
	a.cms_id = p_cms_id ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_cms_ins` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cms_ins`(
  p_name VARCHAR(100),
  p_html VARCHAR(8000),
  p_spanish_html VARCHAR(8000)
)
BEGIN
DECLARE p_cms_id VARCHAR(36);
SET p_cms_id = UUID();
INSERT INTO cms
(
  cms_id,
  NAME,
  html,
  spanish_html,
  creation_dtm
)
VALUES
(
  p_cms_id,
  p_name,
  p_html,
  p_spanish_html,
  CURRENT_TIMESTAMP
);
  
SELECT
  a.cms_id,
  a.name,
  a.html,
  a.spanish_html,
  a.creation_dtm,
  a.last_update_dtm
FROM
  cms a
WHERE
  a.cms_id = p_cms_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_cms_upd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cms_upd`(
  p_cms_id varchar(36),
  p_name VARCHAR(100),
  p_html VARCHAR(8000),
  p_spanish_html VARCHAR(8000)
)
BEGIN
update
  cms
set
  name = p_name,
  html = p_html,
  spanish_html = p_spanish_html
where
  cms_id = p_cms_id;
  
SELECT
  a.cms_id,
  a.name,
  a.html,
  a.spanish_html,
  a.creation_dtm,
  a.last_update_dtm
FROM
  cms a
WHERE
  a.cms_id = p_cms_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_filter_type_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_filter_type_get`()
BEGIN

select
  a.filter_type_cd,
  a.filter_type_name,
  a.filter_type_description
from
  filter_type a;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_filter_type_get_by_cd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_filter_type_get_by_cd`(
  p_filter_type_cd varchar(10)
)
BEGIN

select
  a.filter_type_cd,
  a.filter_type_name,
  a.filter_type_description
from
  filter_type a
where
  a.filter_type_cd = p_filter_type_cd;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_health_risk_type_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_health_risk_type_get`()
BEGIN

select
  a.health_risk_type_cd,
  a.health_risk_type_name,
  a.health_risk_type_description
from
  health_risk_type a;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_health_risk_type_get_by_cd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_health_risk_type_get_by_cd`(
  p_health_risk_type_cd varchar(10)
)
BEGIN

select
  a.health_risk_type_cd,
  a.health_risk_type_name,
  a.health_risk_type_description
from
  health_risk_type a
where
  a.health_risk_type_cd = p_health_risk_type_cd;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_limit_type_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_limit_type_get`()
BEGIN

select
  a.limit_type_cd,
  a.limit_type_name,
  a.limit_type_description
from
  limit_type a;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_limit_type_get_by_cd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_limit_type_get_by_cd`(
  p_limit_type_cd varchar(10)
)
BEGIN

select
  a.limit_type_cd,
  a.limit_type_name,
  a.limit_type_description
from
  limit_type a
where
  a.limit_type_cd = p_limit_type_cd;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_property_del` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_property_del`(
  p_property_id varchar(36)
)
begin
delete from property where property_id = p_property_id;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_property_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_property_get`(
)
begin
select
	a.property_id,
	a.application_id,
	a.property_name,
	a.creation_dtm,
	a.last_update_dtm
from
	property a;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_property_get_by_application_property_name` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_property_get_by_application_property_name`(
  p_application_id varchar(36),
  p_property_name varchar(100)
)
begin
select
  a.property_id,
  a.application_id,
  a.property_name,
  a.creation_dtm,
  a.last_update_dtm
from
  property a
where
  a.application_id = p_application_id
  and a.property_name = p_property_name;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_property_get_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_property_get_by_id`(
  p_property_id varchar(36)
)
begin
select
	a.property_id,
	a.application_id,
	a.property_name,
	a.creation_dtm,
	a.last_update_dtm
from
	property a
where
	a.property_id = p_property_id;	
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_property_ins` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_property_ins`(
  p_application_id varchar(36),
  p_property_name varchar(100)
)
begin
insert into property
(
  property_id,
  application_id,
  property_name,
  creation_dtm
)
values
(
  uuid(),
  p_application_id,
  p_property_name,
  utc_timestamp
);
select
  a.property_id,
  a.application_id,
  a.property_name,
  a.creation_dtm,
  a.last_update_dtm
from
  property a
where
  a.application_id = p_application_id
  and a.property_name = p.property_name;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_property_upd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_property_upd`(
  p_property_id varchar(36),
  p_application_id varchar(36),
  p_property_name varchar(100)
)
begin
  update
    property
  set
    a.application_id = p_application_id,
    a.property_name = p_property_name
  where
    a.property_id = p_property_id;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_role_get_by_user` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_role_get_by_user`(p_username varchar(100))
begin
	select
		a.role_id,
		a.application_id,
		a.role_name,
		a.creation_dtm,
		a.last_update_dtm,
		c.user_id,
		c.username
	from	
		role a
	join
		user_role b
	on
		a.role_id = b.role_id
	join
		user c
	on
		b.user_id = c.user_id
	where
		c.username = p_username;
		
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_source_type_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_source_type_get`()
BEGIN

select
  a.source_type_cd,
  a.source_type_name,
  a.source_type_description
from
  source_type a;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_source_type_get_by_cd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_source_type_get_by_cd`(
  p_source_type_cd varchar(10)
)
BEGIN

select
  a.source_type_cd,
  a.source_type_name,
  a.source_type_description
from
  source_type a
where
  a.source_type_cd = p_source_type_cd;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_state_type_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_state_type_get`()
BEGIN

select
  a.state_type_cd,
  a.state_type_name,
  a.state_type_description
from
  state_type a;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_state_type_get_by_cd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_state_type_get_by_cd`(
  p_state_type_cd varchar(10)
)
BEGIN

select
  a.state_type_cd,
  a.state_type_name,
  a.state_type_description
from
  state_type a
where
  a.state_type_cd = p_state_type_cd;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_toxin_average_del` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_toxin_average_del`(
  p_toxin_average_id int
)
BEGIN

delete from
  toxin_average
where
  toxin_average_id = p_toxin_average_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_toxin_average_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_toxin_average_get`()
BEGIN

select
  a.toxin_average_id,
  a.toxin_type_cd,
  a.average_type_cd,
  a.value,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  toxin_average a;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_toxin_average_get_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_toxin_average_get_by_id`(
  p_toxin_average_id int
)
BEGIN

select
  a.toxin_average_id,
  a.toxin_type_cd,
  a.average_type_cd,
  a.value,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  toxin_average a
where
  a.toxin_average_id = p_toxin_average_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_toxin_average_ins` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_toxin_average_ins`(
  p_toxin_type_cd varchar(10),
  p_average_type_cd varchar(10),
  p_value decimal(13,7),
  p_creation_user_id varchar(36)
)
BEGIN

insert toxin_average
(
  toxin_type_cd,
  average_type_cd,
  value,
  creation_user_id,
  creation_dtm
)
values
(
  p_toxin_type_cd,
  p_average_type_cd,
  p_value,
  p_creation_user_id,
  utc_timestamp
);

select
  a.toxin_average_id,
  a.toxin_type_cd,
  a.average_type_cd,
  a.value,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  toxin_average a
where
  a.toxin_average_id = last_insert_id();


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_toxin_average_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_toxin_average_trn`()
BEGIN

truncate table toxin_average;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_toxin_average_upd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_toxin_average_upd`(
  p_toxin_average_id int,
  p_toxin_type_cd varchar(10),
  p_average_type_cd varchar(10),
  p_value decimal(13,7),
  p_last_update_user_id varchar(36)
)
BEGIN

update
  toxin_average
set
  toxin_type_cd = p_toxin_type_cd,
  average_type_cd = p_average_type_cd,
  value = p_value,
  last_update_user_id = p_last_update_user_id,
  last_update_dtm = utc_timestamp
where
  toxin_average_id = p_toxin_average_id;

select
  a.toxin_average_id,
  a.toxin_type_cd,
  a.average_type_cd,
  a.value,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  toxin_average a
where
  a.toxin_average_id = p_toxin_average_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_toxin_limit_del` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_toxin_limit_del`(
  p_toxin_limit_id int
)
BEGIN

delete from
  toxin_limit
where
  toxin_limit_id = p_toxin_limit_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_toxin_limit_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_toxin_limit_get`()
BEGIN

select
  a.toxin_limit_id,
  a.toxin_type_cd,
  a.limit_type_cd,
  a.value,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  toxin_limit a;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_toxin_limit_get_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_toxin_limit_get_by_id`(
  p_toxin_limit_id int
)
BEGIN

select
  a.toxin_limit_id,
  a.toxin_type_cd,
  a.limit_type_cd,
  a.value,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  toxin_limit a
where
  a.toxin_limit_id = p_toxin_limit_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_toxin_limit_ins` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_toxin_limit_ins`(
  p_toxin_type_cd varchar(10),
  p_limit_type_cd varchar(10),
  p_value decimal(13,7),
  p_creation_user_id varchar(36)
)
BEGIN

insert toxin_limit
(
  toxin_type_cd,
  limit_type_cd,
  value,
  creation_user_id,
  creation_dtm
)
values
(
  p_toxin_type_cd,
  p_limit_type_cd,
  p_value,
  p_creation_user_id,
  utc_timestamp
);

select
  a.toxin_limit_id,
  a.toxin_type_cd,
  a.limit_type_cd,
  a.value,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  toxin_limit a
where
  a.toxin_limit_id = last_insert_id();


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_toxin_limit_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_toxin_limit_trn`()
BEGIN

truncate table toxin_limit;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_toxin_limit_upd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_toxin_limit_upd`(
  p_toxin_limit_id int,
  p_toxin_type_cd varchar(10),
  p_limit_type_cd varchar(10),
  p_value decimal(13,7),
  p_last_update_user_id varchar(36)
)
BEGIN

update
  toxin_limit
set
  toxin_type_cd = p_toxin_type_cd,
  limit_type_cd = p_limit_type_cd,
  value = p_value,
  last_update_user_id = p_last_update_user_id,
  last_update_dtm = utc_timestamp
where
  toxin_limit_id = p_toxin_limit_id;

select
  a.toxin_limit_id,
  a.toxin_type_cd,
  a.limit_type_cd,
  a.value,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  toxin_limit a
where
  a.toxin_limit_id = p_toxin_limit_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_toxin_type_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_toxin_type_get`()
BEGIN

select
  a.toxin_type_cd,
  a.toxin_type_name,
  a.toxin_type_description
from
  toxin_type a;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_toxin_type_get_by_cd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_toxin_type_get_by_cd`(
  p_toxin_type_cd varchar(10)
)
BEGIN

select
  a.toxin_type_cd,
  a.toxin_type_name,
  a.toxin_type_description
from
  toxin_type a
where
  a.toxin_type_cd = p_toxin_type_cd;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_del` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_del`(p_user_id varchar(36))
begin
delete from user_role where user_id = p_user_id;
delete from user_property where user_id = p_user_id;
delete from user where user_id = p_user_id;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_get`()
begin
select
	a.user_id,
	a.application_id,
	a.username,
	a.email,
	a.password,
	a.approved_flag,
	a.active_flag,
	a.last_login_dtm,
	a.creation_dtm,
	a.last_update_dtm
from
	user a;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_get_by_email` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_get_by_email`(p_email varchar(512))
begin
select
	a.user_id,
	a.application_id,
	a.username,
	a.email,
	a.password,
	a.approved_flag,
	a.active_flag,
	a.last_login_dtm,
	a.creation_dtm,
	a.last_update_dtm
from
	user a
where
	a.email = p_email;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_get_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_get_by_id`(p_user_id varchar(36))
begin
select
	a.user_id,
	a.application_id,
	a.username,
	a.email,
	a.password,
	a.approved_flag,
	a.active_flag,
	a.last_login_dtm,
	a.creation_dtm,
	a.last_update_dtm
from
	user a
where
	a.user_id = p_user_id;	
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_get_by_role` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_get_by_role`(p_role_id varchar(36))
begin
select
	a.user_id,
	a.application_id,
	a.username,
	a.email,
	a.password,
	a.approved_flag,
	a.active_flag,
	a.last_login_dtm,
	a.creation_dtm,
	a.last_update_dtm
from
	user a
join
	userrole b
on
	a.user_id = b.user_id		
where
	b.role_id = p_role_id;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_get_by_username` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_get_by_username`(p_username varchar(100))
begin
select
	a.user_id,
	a.application_id,
	a.username,
	a.email,
	a.password,
	a.approved_flag,
	a.active_flag,
	a.last_login_dtm,
	a.creation_dtm,
	a.last_update_dtm
from
	user a
where
	a.username = p_username;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_ins` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_ins`(
	p_application_id varchar(36), 
	p_username varchar(100), 
	p_email varchar(512), 
	p_password varchar(512), 
	p_approved_flag tinyint(1), 
	p_active_flag tinyint(1), 
	p_last_login_dtm datetime
)
begin
if not exists(select * from user where email = p_email) then

insert user
(
	user_id,
	application_id,
	username,
	email,
	password,
	approved_flag,
	active_flag,
	last_login_dtm,
	creation_dtm
)
values
(
	uuid(),
	p_application_id,
	p_username,
	p_email,
	p_password,
	p_approved_flag,
	p_active_flag,
	p_last_login_dtm,
	utc_timestamp
);
end if;

select
	a.user_id,
	a.application_id,
	a.username,
	a.email,
	a.password,
	a.approved_flag,
	a.active_flag,
	a.last_login_dtm,
	a.creation_dtm,
	a.last_update_dtm
from
	user a
where
	a.email = p_email;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_property_del_by_user` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_property_del_by_user`(
  p_user_id varchar(36)
)
begin
delete from user_property where user_id = p_user_id;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_property_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_property_get`(
)
begin
select
	a.user_id,
	a.property_id,
	a.property_value,
	a.creation_dtm,
	a.last_update_dtm,
	b.application_id,
	b.property_name
from
	user_property a
join
	property b
on
	a.property_id = b.property_id;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_property_get_by_name_value` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_property_get_by_name_value`(
	p_property_name varchar(100),
	p_property_value varchar(512)
)
begin
select
	a.user_id,
	a.property_id,
	a.property_value,
	a.creation_dtm,
	a.last_update_dtm,
	b.application_id,
	b.property_name
from
	user_property a
join
	property b
on
	a.property_id = b.property_id
where
	b.property_name = p_property_name
	and a.property_value = p_property_value;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_property_get_by_user` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_property_get_by_user`(p_user_id varchar(36))
begin
select
	a.user_id,
	a.property_id,
	a.property_value,
	a.creation_dtm,
	a.last_update_dtm,
	b.application_id,
	b.property_name
from
	user_property a
join
	property b
on
	a.property_id = b.property_id
where
	a.user_id = p_user_id;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_property_ins` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_property_ins`(
	p_user_id varchar(36),
	p_property_id varchar(36),
	p_property_value varchar(512) 	
)
begin

delete from 
	user_property 
where 
	user_id = p_user_id 
	and property_id = p_property_id;

insert into user_property
(
	user_id, 
	property_id, 
	property_value, 
	creation_dtm
) 
values 
(
	p_user_id, 
	p_property_id, 
	p_property_value, 
	utc_timestamp
);
	
select
	a.user_id,
	a.property_id,
	a.property_value,
	a.creation_dtm,
	a.last_update_dtm,
	b.application_id,
	b.property_name
from
	user_property a
join
	property b
on
	a.property_id = b.property_id
where
	a.user_id = p_user_id
	and a.property_id = p_property_id;	

end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_upd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_upd`(
	p_user_id varchar(36), 
	p_application_id varchar(36), 
	p_username varchar(100), 
	p_email varchar(512), 
	p_password varchar(512), 
	p_approved_flag tinyint(1), 
	p_active_flag tinyint(1), 
	p_last_login_dtm datetime
)
begin

update
	user
set
	application_id = p_application_id,
	username = p_username,
	email = p_email,
	password = p_password,
	approved_flag = p_approved_flag,
	active_flag = p_active_flag,
	last_login_dtm = p_last_login_dtm,
	last_update_dtm = utc_timestamp
where
	user_id = p_user_id;	


select
	a.user_id,
	a.application_id,
	a.username,
	a.email,
	a.password,
	a.approved_flag,
	a.active_flag,
	a.last_login_dtm,
	a.creation_dtm,
	a.last_update_dtm
from
	user a
where
	a.user_id = p_user_id;


end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_validate` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_validate`(p_username varchar(100), p_password varchar(512))
begin
select
	a.user_id,
	a.application_id,
	a.username,
	a.email,
	a.password,
	a.approved_flag,
	a.active_flag,
	a.last_login_dtm,
	a.creation_dtm,
	a.last_update_dtm
from
	user a
where
	a.username = p_username
	and a.password = p_password;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_utility_del` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_utility_del`(
  p_utility_id int
)
BEGIN

delete from
  utility
where
  utility_id = p_utility_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_utility_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_utility_get`()
BEGIN

select
  a.utility_id,
  a.name,
  a.description,
  a.state_type_cd,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  utility a;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_utility_get_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_utility_get_by_id`(
  p_utility_id int
)
BEGIN

select
  a.utility_id,
  a.name,
  a.description,
  a.state_type_cd,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  utility a
where
  a.utility_id = p_utility_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_utility_ins` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_utility_ins`(
  p_name varchar(100),
  p_description varchar(512),
  p_state_type_cd varchar(10),
  p_creation_user_id varchar(36)
)
BEGIN

insert utility
(
  name,
  description,
  state_type_cd,
  creation_user_id,
  creation_dtm
)
values
(
  p_name,
  p_description,
  p_state_type_cd,
  p_creation_user_id,
  utc_timestamp
);

select
  a.utility_id,
  a.name,
  a.description,
  a.state_type_cd,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  utility a
where
  a.utility_id = last_insert_id();


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_utility_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_utility_trn`()
BEGIN

truncate table utility;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_utility_upd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_utility_upd`(
  p_utility_id int,
  p_name varchar(100),
  p_description varchar(512),
  p_state_type_cd varchar(10),
  p_last_update_user_id varchar(36)
)
BEGIN

update
  utility
set
  name = p_name,
  description = p_description,
  state_type_cd = p_state_type_cd,
  last_update_user_id = p_last_update_user_id,
  last_update_dtm = utc_timestamp
where
  utility_id = p_utility_id;

select
  a.utility_id,
  a.name,
  a.description,
  a.state_type_cd,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  utility a
where
  a.utility_id = p_utility_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_zip_del` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_zip_del`(
  p_zip_id int
)
BEGIN

delete from
  zip
where
  zip_id = p_zip_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_zip_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_zip_get`()
BEGIN

select
  a.zip_id,
  a.zip_cd,
  a.toxin_type_cd,
  a.health_risk_type_cd,
  a.filter_type_cd,
  a.amount,
  a.utility_id,
  a.sample_dtm,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  zip a;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_zip_get_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_zip_get_by_id`(
  p_zip_id int
)
BEGIN

select
  a.zip_id,
  a.zip_cd,
  a.toxin_type_cd,
  a.health_risk_type_cd,
  a.filter_type_cd,
  a.amount,
  a.utility_id,
  a.sample_dtm,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  zip a
where
  a.zip_id = p_zip_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_zip_ins` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_zip_ins`(
  p_zip_cd varchar(10),
  p_toxin_type_cd varchar(10),
  p_health_risk_type_cd varchar(10),
  p_filter_type_cd varchar(10),
  p_amount decimal(13,7),
  p_utility_id int,
  p_sample_dtm datetime(6),
  p_creation_user_id varchar(36)
)
BEGIN

insert zip
(
  zip_cd,
  toxin_type_cd,
  health_risk_type_cd,
  filter_type_cd,
  amount,
  utility_id,
  sample_dtm,
  creation_user_id,
  creation_dtm
)
values
(
  p_zip_cd,
  p_toxin_type_cd,
  p_health_risk_type_cd,
  p_filter_type_cd,
  p_amount,
  p_utility_id,
  p_sample_dtm,
  p_creation_user_id,
  utc_timestamp
);

select
  a.zip_id,
  a.zip_cd,
  a.toxin_type_cd,
  a.health_risk_type_cd,
  a.filter_type_cd,
  a.amount,
  a.utility_id,
  a.sample_dtm,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  zip a
where
  a.zip_id = last_insert_id();


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_zip_toxin_source_del` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_zip_toxin_source_del`(
  p_zip_toxin_source_id int
)
BEGIN

delete from
  zip_toxin_source
where
  zip_toxin_source_id = p_zip_toxin_source_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_zip_toxin_source_get` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_zip_toxin_source_get`()
BEGIN

select
  a.zip_toxin_source_id,
  a.zip_cd,
  a.toxin_type_cd,
  a.source_type_cd,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  zip_toxin_source a;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_zip_toxin_source_get_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_zip_toxin_source_get_by_id`(
  p_zip_toxin_source_id int
)
BEGIN

select
  a.zip_toxin_source_id,
  a.zip_cd,
  a.toxin_type_cd,
  a.source_type_cd,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  zip_toxin_source a
where
  a.zip_toxin_source_id = p_zip_toxin_source_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_zip_toxin_source_ins` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_zip_toxin_source_ins`(
  p_zip_cd varchar(10),
  p_toxin_type_cd varchar(10),
  p_source_type_cd varchar(10),
  p_creation_user_id varchar(36)
)
BEGIN

insert zip_toxin_source
(
  zip_cd,
  toxin_type_cd,
  source_type_cd,
  creation_user_id,
  creation_dtm
)
values
(
  p_zip_cd,
  p_toxin_type_cd,
  p_source_type_cd,
  p_creation_user_id,
  utc_timestamp
);

select
  a.zip_toxin_source_id,
  a.zip_cd,
  a.toxin_type_cd,
  a.source_type_cd,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  zip_toxin_source a
where
  a.zip_toxin_source_id = last_insert_id();


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_zip_toxin_source_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_zip_toxin_source_trn`()
BEGIN

truncate table zip_toxin_source;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_zip_toxin_source_upd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_zip_toxin_source_upd`(
  p_zip_toxin_source_id int,
  p_zip_cd varchar(10),
  p_toxin_type_cd varchar(10),
  p_source_type_cd varchar(10),
  p_last_update_user_id varchar(36)
)
BEGIN

update
  zip_toxin_source
set
  zip_cd = p_zip_cd,
  toxin_type_cd = p_toxin_type_cd,
  source_type_cd = p_source_type_cd,
  last_update_user_id = p_last_update_user_id,
  last_update_dtm = utc_timestamp
where
  zip_toxin_source_id = p_zip_toxin_source_id;

select
  a.zip_toxin_source_id,
  a.zip_cd,
  a.toxin_type_cd,
  a.source_type_cd,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  zip_toxin_source a
where
  a.zip_toxin_source_id = p_zip_toxin_source_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_zip_trn` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_zip_trn`()
BEGIN

truncate table zip;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_zip_upd` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ben`@`localhost` PROCEDURE `sp_zip_upd`(
  p_zip_id int,
  p_zip_cd varchar(10),
  p_toxin_type_cd varchar(10),
  p_health_risk_type_cd varchar(10),
  p_filter_type_cd varchar(10),
  p_amount decimal(13,7),
  p_utility_id int,
  p_sample_dtm datetime(6),
  p_last_update_user_id varchar(36)
)
BEGIN

update
  zip
set
  zip_cd = p_zip_cd,
  toxin_type_cd = p_toxin_type_cd,
  health_risk_type_cd = p_health_risk_type_cd,
  filter_type_cd = p_filter_type_cd,
  amount = p_amount,
  utility_id = p_utility_id,
  sample_dtm = p_sample_dtm,
  last_update_user_id = p_last_update_user_id,
  last_update_dtm = utc_timestamp
where
  zip_id = p_zip_id;

select
  a.zip_id,
  a.zip_cd,
  a.toxin_type_cd,
  a.health_risk_type_cd,
  a.filter_type_cd,
  a.amount,
  a.utility_id,
  a.sample_dtm,
  a.creation_user_id,
  a.creation_dtm,
  a.last_update_user_id,
  a.last_update_dtm
from
  zip a
where
  a.zip_id = p_zip_id;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-17 18:33:54
