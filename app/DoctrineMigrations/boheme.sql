-- MySQL dump 10.13  Distrib 5.5.27, for osx10.6 (i386)
--
-- Host: localhost    Database: boheme
-- ------------------------------------------------------
-- Server version	5.5.27

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
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `createdBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updatedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ext_log_entries`
--

DROP TABLE IF EXISTS `ext_log_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ext_log_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `logged_at` datetime NOT NULL,
  `object_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_class_lookup_idx` (`object_class`),
  KEY `log_date_lookup_idx` (`logged_at`),
  KEY `log_user_lookup_idx` (`username`),
  KEY `log_version_lookup_idx` (`object_id`,`object_class`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ext_log_entries`
--

LOCK TABLES `ext_log_entries` WRITE;
/*!40000 ALTER TABLE `ext_log_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `ext_log_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ext_translations`
--

DROP TABLE IF EXISTS `ext_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ext_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_class`,`field`,`foreign_key`),
  KEY `translations_lookup_idx` (`locale`,`object_class`,`foreign_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ext_translations`
--

LOCK TABLES `ext_translations` WRITE;
/*!40000 ALTER TABLE `ext_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ext_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F06D397057698A6A` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (2,'Administrators','ROLE_ADMIN','0000-00-00 00:00:00','2013-06-01 20:16:58'),(3,'User','ROLE_USER','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'Team role','ROLE_TEAM','0000-00-00 00:00:00','2013-08-04 21:28:34'),(5,'Club role','ROLE_CLUB','0000-00-00 00:00:00','2013-08-04 21:28:06'),(10,'Competition Manager','ROLE_COMP','0000-00-00 00:00:00','2013-08-04 21:29:18');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meals`
--

DROP TABLE IF EXISTS `meals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sitting_id` int(11) DEFAULT NULL,
  `menugroup_id` int(11) DEFAULT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `publish` date NOT NULL,
  `expire` date NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `createdby` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated` datetime NOT NULL,
  `updatedby` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E229E6EA8014E66` (`sitting_id`),
  KEY `IDX_E229E6EA2C72584` (`menugroup_id`),
  CONSTRAINT `FK_E229E6EA2C72584` FOREIGN KEY (`menugroup_id`) REFERENCES `menugroups` (`id`),
  CONSTRAINT `FK_E229E6EA8014E66` FOREIGN KEY (`sitting_id`) REFERENCES `sittings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meals`
--

LOCK TABLES `meals` WRITE;
/*!40000 ALTER TABLE `meals` DISABLE KEYS */;
INSERT INTO `meals` VALUES (1,1,2,'Bacon and egg role','juicy bacon, 2 organic eggs on a Sour dough role','2013-10-01','2018-12-31',8.50,'2013-12-18 08:50:49','paul','2013-12-18 08:50:49','paul'),(2,1,1,'Bread available','sourdough, mixed grains, brioche, gluten-free or miche','2013-10-01','2018-12-31',0.00,'2013-12-20 21:59:56','paul','2013-12-20 21:59:56','paul'),(3,1,1,'Toast with organic butter & spreads',NULL,'2013-10-01','2018-12-31',5.50,'2013-12-20 22:20:56','paul','2013-12-20 22:20:56','paul'),(4,1,1,'Toasted fruit & nut bread',NULL,'2013-10-01','2018-12-31',5.50,'2013-12-20 22:26:13','paul','2013-12-20 22:26:13','paul'),(5,1,1,'Toasted fruit & nut bread','with ricotta & organic honey','2013-10-01','2018-12-31',8.50,'2013-12-20 22:27:06','paul','2013-12-20 22:27:06','paul'),(6,1,1,'Fresh seasonal fruit with yoghurt & chia seeds',NULL,'2013-10-01','2018-12-31',12.00,'2013-12-20 22:30:07','paul','2013-12-20 22:30:07','paul'),(7,1,1,'Farmer Jo bircher muesli with apple, strawberry & nuts',NULL,'2013-10-01','2018-12-31',13.00,'2013-12-20 22:33:08','paul','2013-12-20 22:33:08','paul'),(8,1,1,'Farmer Jo granola with yoghurt & fresh seasonal fruit',NULL,'2013-10-01','2018-12-31',14.00,'2013-12-20 22:33:57','paul','2013-12-20 22:33:57','paul'),(9,1,1,'Organic eggs, poached, scrambled or fried','with your choice of toast & tomato jam','2013-10-01','2018-12-31',10.00,'2013-12-20 22:34:56','paul','2013-12-20 22:34:56','paul'),(10,1,1,'French toast of brioche','with caramelised pears & vanilla ice cream','2013-10-01','2018-12-31',15.00,'2013-12-20 22:37:29','paul','2013-12-20 22:37:29','paul'),(11,1,1,'Omelette','with mushrooms, Gruyere, chives & ricotta','2013-10-01','2018-12-31',16.00,'2013-12-20 22:40:19','paul','2013-12-20 22:40:19','paul'),(12,1,2,'Croque Monsieur/Madame',NULL,'2013-10-01','2018-12-31',15.00,'2013-12-20 23:01:32','paul','2013-12-20 23:01:32','paul'),(13,1,1,'Deli plate','of soft-boiled organic egg, avocado smash, vine-ripened tomato,\r\nPersian feta & toast','2013-10-01','2018-12-31',14.00,'2013-12-20 23:04:50','paul','2013-12-20 23:04:50','paul'),(14,1,5,'Crispy Bacon, Tasha’s ocean trout gravlax,','pork & fennel sausage or merguez','2013-10-01','2018-12-31',5.00,'2013-12-20 23:07:02','paul','2013-12-20 23:08:19','paul'),(15,1,5,'Avocado smash,','herb roasted field mushroom, spinach, roasted balsamic tomato,\r\nfresh ricotta or Persian feta','2013-10-01','2018-12-31',3.50,'2013-12-20 23:09:00','paul','2013-12-20 23:09:00','paul'),(16,1,6,'Daily selection of pastries at the bar','all made in-house','2013-10-01','2018-12-31',0.00,'2013-12-20 23:10:24','paul','2013-12-20 23:10:24','paul'),(17,1,7,'Coffee','Short or long black, macchiato or piccolo','2013-10-01','2018-12-31',3.00,'2013-12-20 23:13:16','paul','2013-12-20 23:13:16','paul'),(18,1,7,'Flat white, latte or cappucino',NULL,'2013-10-01','2018-12-31',3.50,'2013-12-20 23:15:25','paul','2013-12-20 23:15:25','paul'),(19,1,7,'Extra shot, Bonsoy, large or decaf',NULL,'2013-10-01','2018-12-31',0.50,'2013-12-20 23:19:56','paul','2013-12-20 23:19:56','paul'),(20,1,7,'Hot chocolate',NULL,'2013-10-01','2018-12-31',4.00,'2013-12-20 23:23:29','paul','2013-12-20 23:23:29','paul'),(21,1,7,'Tea Drop teas',NULL,'2013-10-01','2018-12-31',4.50,'2013-12-20 23:24:22','paul','2013-12-20 23:24:22','paul'),(22,1,7,'Zac’s chai',NULL,'2013-10-01','2018-12-31',4.50,'2013-12-20 23:26:03','paul','2013-12-20 23:26:03','paul'),(23,1,7,'Milkshakes','dark chocolate, dulce de leche\r\nor vanilla bean','2013-10-01','2018-12-31',5.50,'2013-12-20 23:27:06','paul','2013-12-20 23:27:06','paul'),(24,1,7,'Freshly squeezed O.J',NULL,'2013-10-01','2018-12-31',6.00,'2013-12-20 23:27:52','paul','2013-12-20 23:27:52','paul'),(25,1,7,'Berry smoothie',NULL,'2013-10-01','2018-12-31',5.50,'2013-12-20 23:28:53','paul','2013-12-20 23:28:53','paul');
/*!40000 ALTER TABLE `meals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menugroups`
--

DROP TABLE IF EXISTS `menugroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menugroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `updated` datetime NOT NULL,
  `updatedBy` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menugroups`
--

LOCK TABLES `menugroups` WRITE;
/*!40000 ALTER TABLE `menugroups` DISABLE KEYS */;
INSERT INTO `menugroups` VALUES (1,'breads','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(2,'entree','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(3,'main','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(4,'sandwiches','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(5,'sides','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(6,'pastries','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(7,'drinks','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(8,'salads','','0000-00-00 00:00:00','','0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `menugroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent` int(11) NOT NULL,
  `seq` int(11) NOT NULL,
  `url` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `secured` tinyint(1) NOT NULL,
  `external` tinyint(1) NOT NULL,
  `role` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated` datetime NOT NULL,
  `updatedBy` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_727508CFF47645AE` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Group',NULL,4,2,'group_list',1,0,'','2013-06-02 20:53:05','','2013-07-19 19:52:16','paul'),(2,'Users',NULL,6,4,'user_list',1,0,'','2013-06-02 22:24:19','','2013-08-12 20:23:50','paul'),(3,'Menus',NULL,4,2,'menu_list',1,0,'','2013-06-05 22:27:02','','2013-08-12 20:24:51','paul'),(6,'Admin','cogs',0,3,'#admin',1,1,'ROLE_USER','2013-07-19 20:38:38','paul','2013-07-19 20:38:38','paul'),(7,'Notices',NULL,6,1,'notice_list',1,0,'ROLE_USER','2013-07-19 20:41:12','paul','2013-07-19 20:41:33','paul'),(8,'About Me','bookmark',0,9,'#about',1,1,'ROLE_USER','2013-07-19 20:53:13','paul','2013-07-19 20:53:13','paul');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20131001090506'),('20131007163247'),('20131007165101'),('20131220221958');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notices`
--

DROP TABLE IF EXISTS `notices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `publish` date NOT NULL,
  `expire` date NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated` datetime NOT NULL,
  `updatedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notices`
--

LOCK TABLES `notices` WRITE;
/*!40000 ALTER TABLE `notices` DISABLE KEYS */;
/*!40000 ALTER TABLE `notices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sittings`
--

DROP TABLE IF EXISTS `sittings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sittings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `updated` datetime NOT NULL,
  `updatedBy` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sittings`
--

LOCK TABLES `sittings` WRITE;
/*!40000 ALTER TABLE `sittings` DISABLE KEYS */;
INSERT INTO `sittings` VALUES (1,'Breakfast','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(2,'Lunch','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(3,'Dinner','','0000-00-00 00:00:00','','0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `sittings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `IDX_8F02BF9DA76ED395` (`user_id`),
  KEY `IDX_8F02BF9DFE54D947` (`group_id`),
  CONSTRAINT `FK_8F02BF9DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_8F02BF9DFE54D947` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` VALUES (1,2),(2,2),(2,5),(2,10),(11,3);
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `token` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logins` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated` datetime NOT NULL,
  `updatedBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`),
  UNIQUE KEY `UNIQ_1483A5E95F37A13B` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'paul','Paul Taylor','f1d52014a9a6e78821bef5278f91844b','37ddb1477de6308ca9ef3824b28b4a1e79da8908','paul@nms.com.au',1,NULL,41,'2013-04-26 17:33:29','','2013-12-18 13:04:32',NULL),(2,'user','User One','9c961dd0b9d643a18fe69532b2a8c77a','6f0b18242c21b47aa5005863495d57ede071bff7','user@nms.com.au',1,NULL,0,'2013-04-26 17:33:29','','2013-07-25 20:17:19','paul'),(4,'paul1','paul','663aef479c4f8549ff6d13d5fcd8e6a3','db7f7a68b352ff8b7981ee24f906280ca60e4c2b','a@nms.com.au',1,NULL,3,'2013-07-21 21:27:54','paul','2013-07-26 22:36:14',NULL),(11,'user2','User Two','d07818e198d78a0b86f1d12cbc1c164f','b6b04cb532a1008883d2982ea5d8a3155bcb8904','pg.taylor12@gmail.com',1,'b351fb6bb55ab7e',1,'2013-07-30 21:01:14','paul','2013-08-02 21:08:41','user2');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wineregions`
--

DROP TABLE IF EXISTS `wineregions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wineregions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `updated` datetime NOT NULL,
  `updatedBy` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wineregions`
--

LOCK TABLES `wineregions` WRITE;
/*!40000 ALTER TABLE `wineregions` DISABLE KEYS */;
INSERT INTO `wineregions` VALUES (1,'barossa','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(2,'margaret river','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(3,'beaujolais','','0000-00-00 00:00:00','','0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `wineregions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wines`
--

DROP TABLE IF EXISTS `wines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variety_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8_unicode_ci,
  `glassvolume` int(11) NOT NULL,
  `glassprice` decimal(10,2) NOT NULL,
  `carafevolume` int(11) NOT NULL,
  `carafeprice` decimal(10,2) NOT NULL,
  `bottlevolume` int(11) NOT NULL,
  `bottleprice` decimal(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `createdby` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated` datetime NOT NULL,
  `updatedby` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_58312A0578C2BC47` (`variety_id`),
  KEY `IDX_58312A0598260155` (`region_id`),
  CONSTRAINT `FK_58312A0578C2BC47` FOREIGN KEY (`variety_id`) REFERENCES `winevarieties` (`id`),
  CONSTRAINT `FK_58312A0598260155` FOREIGN KEY (`region_id`) REFERENCES `wineregions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wines`
--

LOCK TABLES `wines` WRITE;
/*!40000 ALTER TABLE `wines` DISABLE KEYS */;
INSERT INTO `wines` VALUES (1,1,1,'St Hallets Faith Shiraz','blackberry tones',150,9.00,300,15.00,750,30.00,'2013-01-01 00:00:00','paul','2013-01-01 00:00:00','paul'),(2,3,2,'Evans & Tate Classic Dry White','a classic blend of dry white varieties',0,0.00,0,0.00,0,0.00,'2013-12-19 22:21:11','paul','2013-12-19 22:23:59','paul');
/*!40000 ALTER TABLE `wines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `winevarieties`
--

DROP TABLE IF EXISTS `winevarieties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `winevarieties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `updated` datetime NOT NULL,
  `updatedBy` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `winevarieties`
--

LOCK TABLES `winevarieties` WRITE;
/*!40000 ALTER TABLE `winevarieties` DISABLE KEYS */;
INSERT INTO `winevarieties` VALUES (1,'shiraz','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(2,'cabernet sauvignon','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(3,'sauvignon blanc','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(4,'riesling','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(5,'chardonnay','','0000-00-00 00:00:00','','0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `winevarieties` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-12-23  7:31:43
