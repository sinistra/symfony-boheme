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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meals`
--

LOCK TABLES `meals` WRITE;
/*!40000 ALTER TABLE `meals` DISABLE KEYS */;
INSERT INTO `meals` VALUES (1,1,2,'Bacon and egg role','juicy bacon, 2 organic eggs on a Sour dough role','2013-10-01','2018-12-31',8.50,'2013-12-18 08:50:49','paul','2013-12-18 08:50:49','paul'),(2,1,1,'Bread available','sourdough, mixed grains, brioche, gluten-free or miche','2013-10-01','2018-12-31',0.00,'2013-12-20 21:59:56','paul','2013-12-20 21:59:56','paul'),(3,1,1,'Toast with organic butter & spreads',NULL,'2013-10-01','2018-12-31',5.50,'2013-12-20 22:20:56','paul','2013-12-20 22:20:56','paul'),(4,1,1,'Toasted fruit & nut bread',NULL,'2013-10-01','2018-12-31',5.50,'2013-12-20 22:26:13','paul','2013-12-20 22:26:13','paul'),(5,1,1,'Toasted fruit & nut bread','with ricotta & organic honey','2013-10-01','2018-12-31',8.50,'2013-12-20 22:27:06','paul','2013-12-20 22:27:06','paul'),(6,1,1,'Fresh seasonal fruit with yoghurt & chia seeds',NULL,'2013-10-01','2018-12-31',12.00,'2013-12-20 22:30:07','paul','2013-12-20 22:30:07','paul'),(7,1,1,'Farmer Jo bircher muesli with apple, strawberry & nuts',NULL,'2013-10-01','2018-12-31',13.00,'2013-12-20 22:33:08','paul','2013-12-20 22:33:08','paul'),(8,1,1,'Farmer Jo granola with yoghurt & fresh seasonal fruit',NULL,'2013-10-01','2018-12-31',14.00,'2013-12-20 22:33:57','paul','2013-12-20 22:33:57','paul'),(9,1,1,'Organic eggs, poached, scrambled or fried','with your choice of toast & tomato jam','2013-10-01','2018-12-31',10.00,'2013-12-20 22:34:56','paul','2013-12-20 22:34:56','paul'),(10,1,1,'French toast of brioche','with caramelised pears & vanilla ice cream','2013-10-01','2018-12-31',15.00,'2013-12-20 22:37:29','paul','2013-12-20 22:37:29','paul'),(11,1,1,'Omelette','with mushrooms, Gruyere, chives & ricotta','2013-10-01','2018-12-31',16.00,'2013-12-20 22:40:19','paul','2013-12-20 22:40:19','paul'),(12,1,2,'Croque Monsieur/Madame',NULL,'2013-10-01','2018-12-31',15.00,'2013-12-20 23:01:32','paul','2013-12-20 23:01:32','paul'),(13,1,1,'Deli plate','of soft-boiled organic egg, avocado smash, vine-ripened tomato,\r\nPersian feta & toast','2013-10-01','2018-12-31',14.00,'2013-12-20 23:04:50','paul','2013-12-20 23:04:50','paul'),(14,1,5,'Crispy Bacon, Tasha’s ocean trout gravlax,','pork & fennel sausage or merguez','2013-10-01','2018-12-31',5.00,'2013-12-20 23:07:02','paul','2013-12-20 23:08:19','paul'),(15,1,5,'Avocado smash,','herb roasted field mushroom, spinach, roasted balsamic tomato,\r\nfresh ricotta or Persian feta','2013-10-01','2018-12-31',3.50,'2013-12-20 23:09:00','paul','2013-12-20 23:09:00','paul'),(16,1,6,'Daily selection of pastries at the bar','all made in-house','2013-10-01','2018-12-31',0.00,'2013-12-20 23:10:24','paul','2013-12-20 23:10:24','paul'),(17,1,7,'Coffee','Short or long black, macchiato or piccolo','2013-10-01','2018-12-31',3.00,'2013-12-20 23:13:16','paul','2013-12-20 23:13:16','paul'),(18,1,7,'Flat white, latte or cappucino',NULL,'2013-10-01','2018-12-31',3.50,'2013-12-20 23:15:25','paul','2013-12-20 23:15:25','paul'),(19,1,7,'Extra shot, Bonsoy, large or decaf',NULL,'2013-10-01','2018-12-31',0.50,'2013-12-20 23:19:56','paul','2013-12-20 23:19:56','paul'),(20,1,7,'Hot chocolate',NULL,'2013-10-01','2018-12-31',4.00,'2013-12-20 23:23:29','paul','2013-12-20 23:23:29','paul'),(21,1,7,'Tea Drop teas',NULL,'2013-10-01','2018-12-31',4.50,'2013-12-20 23:24:22','paul','2013-12-20 23:24:22','paul'),(22,1,7,'Zac’s chai',NULL,'2013-10-01','2018-12-31',4.50,'2013-12-20 23:26:03','paul','2013-12-20 23:26:03','paul'),(23,1,7,'Milkshakes','dark chocolate, dulce de leche\r\nor vanilla bean','2013-10-01','2018-12-31',5.50,'2013-12-20 23:27:06','paul','2013-12-20 23:27:06','paul'),(24,1,7,'Freshly squeezed O.J',NULL,'2013-10-01','2018-12-31',6.00,'2013-12-20 23:27:52','paul','2013-12-20 23:27:52','paul'),(25,1,7,'Berry smoothie',NULL,'2013-10-01','2018-12-31',5.50,'2013-12-20 23:28:53','paul','2013-12-20 23:28:53','paul'),(26,2,3,'Soup of the day','with organic sourdough bread','2013-10-01','2018-12-31',12.00,'2013-12-23 21:14:30','paul','2013-12-23 21:16:41','paul'),(27,2,4,'Tasha’s ocean trout gravlax','dill cream cheese, rocket & capers','2013-10-01','2018-12-31',13.00,'2013-12-23 21:19:12','paul','2013-12-23 21:19:33','paul'),(28,2,4,'Rueben of smoked brisket','red coleslaw & pickles','2013-10-01','2018-12-31',13.00,'2013-12-23 21:20:34','paul','2013-12-23 21:20:34','paul'),(29,2,4,'Chargrilled vegetables','Brie, pesto & leaves','2013-10-01','2018-12-31',13.00,'2013-12-23 21:21:46','paul','2013-12-23 21:21:46','paul'),(30,2,4,'Organic chicken','herbs, celery & mayo','2013-10-01','2018-12-31',13.00,'2013-12-23 21:22:33','paul','2013-12-23 21:22:33','paul'),(31,2,4,'Salami','provolone, tomatoes & rocket','2013-10-01','2018-12-31',13.00,'2013-12-23 21:23:22','paul','2013-12-23 21:23:22','paul'),(32,2,8,'Salad of leaves','lardons of bacon, a poached egg & croutons','2013-10-01','2018-12-31',16.00,'2013-12-23 21:24:09','paul','2013-12-23 21:24:09','paul'),(33,2,8,'Tuna,','mixed leaves, radicchio, olives, grape tomatoes & Persian feta','2013-10-01','2018-12-31',16.00,'2013-12-23 21:42:22','paul','2013-12-23 21:42:22','paul'),(34,2,8,'Roasted beetroot,','lentils, goat cheese, baby spinach & caramelised walnuts','2013-10-01','2018-12-31',16.00,'2013-12-23 21:44:12','paul','2013-12-23 21:44:12','paul'),(35,2,8,'Panzanella of tomato,','cucumber, celery, Spanish onion, torn bread, fresh herbs & parmesan','2013-10-01','2018-12-31',16.00,'2013-12-23 21:45:04','paul','2013-12-23 21:45:04','paul'),(36,2,8,'Organic chicken,','carrot, basil, raisins, leaves\r\n& lemon crème fraiche dressing','2013-10-01','2018-12-31',16.00,'2013-12-23 21:46:30','paul','2013-12-23 21:46:30','paul'),(37,2,9,'Croque Monsieur/Madame',NULL,'2013-10-01','2018-12-31',13.00,'2013-12-23 21:48:06','paul','2013-12-23 21:48:38','paul'),(38,2,9,'Quiche Lorraine & salad',NULL,'2013-10-01','2018-12-31',14.00,'2013-12-23 21:49:24','paul','2013-12-23 21:49:24','paul'),(39,2,9,'Vegetarian antipasto',NULL,'2013-10-01','2018-12-31',17.00,'2013-12-23 21:51:26','paul','2013-12-23 21:51:26','paul'),(40,2,9,'Café Boheme charcuterie plate',NULL,'2013-10-01','2018-12-31',18.00,'2013-12-23 21:52:28','paul','2013-12-23 21:52:28','paul'),(41,2,9,'Atlantic salmon cake','with celeriac remoulade','2013-10-01','2018-12-31',19.00,'2013-12-23 21:53:05','paul','2013-12-23 21:53:05','paul');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menugroups`
--

LOCK TABLES `menugroups` WRITE;
/*!40000 ALTER TABLE `menugroups` DISABLE KEYS */;
INSERT INTO `menugroups` VALUES (1,'breads','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(2,'entree','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(3,'soup','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(4,'sandwiches','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(5,'sides','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(6,'pastries','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(7,'drinks','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(8,'salads','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(9,'mains','','0000-00-00 00:00:00','','0000-00-00 00:00:00','');
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
INSERT INTO `migration_versions` VALUES ('20131001090506'),('20131007163247'),('20131007165101'),('20131220221958'),('20131224080423');
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
INSERT INTO `user_group` VALUES (1,2),(2,2),(2,5),(2,10);
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
INSERT INTO `users` VALUES (1,'paul','Paul Taylor','f1d52014a9a6e78821bef5278f91844b','37ddb1477de6308ca9ef3824b28b4a1e79da8908','paul@nms.com.au',1,NULL,45,'2013-04-26 17:33:29','','2013-12-25 18:37:39',NULL),(2,'user','User One','9c961dd0b9d643a18fe69532b2a8c77a','6f0b18242c21b47aa5005863495d57ede071bff7','user@nms.com.au',1,NULL,0,'2013-04-26 17:33:29','','2013-07-25 20:17:19','paul'),(4,'boheme','Cafe Boheme','faf2c3628a104a128fb422ddd76c3a76','dfc96cd2fd29c8cd2707a9bd47cfa147e8e8c1ed','info@cafeboheme.com.au',1,NULL,4,'2013-07-21 21:27:54','paul','2014-01-12 16:27:39',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wineregions`
--

LOCK TABLES `wineregions` WRITE;
/*!40000 ALTER TABLE `wineregions` DISABLE KEYS */;
INSERT INTO `wineregions` VALUES (1,'Barossa Valley ','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(2,'margaret river','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(3,'Bordeaux','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(4,'Veneto','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(5,'Champagne','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(6,'Loire Valley ','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(7,'Abruzzo','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(8,'King Valley ','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(9,'Southern Highlands ','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(10,'Gisborne','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(11,'Chablis','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(12,'Provence','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(13,'Burgundy','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(14,'Umbria','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(15,'Rhone Valley ','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(16,'McLaren Vale ','','0000-00-00 00:00:00','','0000-00-00 00:00:00','');
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
  `type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_58312A0578C2BC47` (`variety_id`),
  KEY `IDX_58312A0598260155` (`region_id`),
  KEY `IDX_58312A05C54C8C93` (`type_id`),
  CONSTRAINT `FK_58312A0578C2BC47` FOREIGN KEY (`variety_id`) REFERENCES `winevarieties` (`id`),
  CONSTRAINT `FK_58312A0598260155` FOREIGN KEY (`region_id`) REFERENCES `wineregions` (`id`),
  CONSTRAINT `FK_58312A05C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `winetypes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wines`
--

LOCK TABLES `wines` WRITE;
/*!40000 ALTER TABLE `wines` DISABLE KEYS */;
INSERT INTO `wines` VALUES (1,1,1,'St Hallets Faith Shiraz','blackberry tones',150,9.00,300,15.00,750,30.00,'2013-01-01 00:00:00','paul','2013-12-24 08:23:00','paul',4),(2,3,2,'Evans & Tate Classic Dry White','a classic blend of dry white varieties',0,0.00,0,0.00,0,0.00,'2013-12-19 22:21:11','paul','2013-12-24 08:27:30','paul',2),(3,11,4,'NV Furlan Treviso',NULL,125,12.00,0,0.00,750,63.00,'2013-12-23 22:13:42','paul','2013-12-24 08:27:40','paul',1),(4,12,5,'NV Dosnon & Lepage  Blanc de Noir',NULL,125,25.00,0,0.00,750,138.00,'2013-12-23 22:15:46','paul','2013-12-24 08:27:49','paul',1),(5,13,6,'‘11 Dm. de La Grenaudiere',NULL,150,10.00,500,31.00,750,44.00,'2013-12-23 22:17:12','paul','2013-12-24 08:28:38','paul',2),(6,14,7,'‘12 Cielo D’Abruzzo ‘Kasaura’',NULL,150,9.00,500,29.00,750,41.00,'2013-12-23 22:18:25','paul','2013-12-24 08:30:46','paul',2),(7,4,8,'‘08 Sam Miranda ‘Cellar Release’',NULL,150,10.00,500,31.00,750,44.00,'2013-12-23 22:19:39','paul','2013-12-24 08:30:55','paul',2),(8,15,9,'12 Far Ago Hill ‘Canyonleigh Reserve’',NULL,150,13.00,500,40.00,750,56.00,'2013-12-23 22:20:26','paul','2013-12-24 08:31:06','paul',2),(9,3,6,'‘11 Monmousseau Touraine',NULL,150,10.00,500,30.00,750,43.00,'2013-12-23 22:21:25','paul','2013-12-24 08:31:16','paul',2),(10,16,10,'’12 Crazy by Nature –certified organic',NULL,150,9.00,500,27.00,750,39.00,'2013-12-23 22:22:19','paul','2013-12-24 08:31:25','paul',2),(11,17,1,'‘12 Massena ‘The Surly Muse’',NULL,150,11.00,500,33.00,750,47.00,'2013-12-23 22:23:31','paul','2013-12-24 08:32:12','paul',2),(12,5,11,'‘10 Denis Pommier Petit Chablis Chardonnay – Chablis',NULL,150,14.00,500,44.00,750,62.00,'2013-12-23 22:24:50','paul','2013-12-24 08:32:29','paul',2),(13,19,12,'’12 Rimauresq ‘Petit Rose’',NULL,150,11.00,500,35.00,750,50.00,'2013-12-23 22:26:17','paul','2013-12-24 08:32:46','paul',3),(14,12,13,'‘11 Vincent Girardin Bourgogne Rouge',NULL,150,14.00,500,42.00,750,60.00,'2013-12-23 22:27:12','paul','2013-12-24 08:33:05','paul',4),(15,20,14,'’11 Cantina dei Colli Amerini',NULL,150,9.00,500,28.00,750,40.00,'2013-12-23 22:28:12','paul','2013-12-24 08:33:17','paul',4),(16,21,15,'‘12 Yves Cuilleron',NULL,150,12.00,500,38.00,750,54.00,'2013-12-23 22:29:06','paul','2013-12-24 08:45:45','paul',4),(17,1,16,'’13 Battle of Bosworth ‘Puritan’','–certified organic & no added preservative, served lightly chilled',150,9.00,500,29.00,750,41.00,'2013-12-23 22:30:23','paul','2013-12-24 08:45:56','paul',4),(18,22,3,'‘09 Vieux Naudin Bordeaux Superieur',NULL,150,10.00,500,30.00,750,43.00,'2013-12-23 22:31:27','paul','2013-12-24 08:46:15','paul',5);
/*!40000 ALTER TABLE `wines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `winetypes`
--

DROP TABLE IF EXISTS `winetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `winetypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `updated` datetime NOT NULL,
  `updatedBy` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `winetypes`
--

LOCK TABLES `winetypes` WRITE;
/*!40000 ALTER TABLE `winetypes` DISABLE KEYS */;
INSERT INTO `winetypes` VALUES (1,'Sparkling','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(2,'White','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(3,'Rose','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(4,'Red','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(5,'Desert','0000-00-00 00:00:00','','0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `winetypes` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `winevarieties`
--

LOCK TABLES `winevarieties` WRITE;
/*!40000 ALTER TABLE `winevarieties` DISABLE KEYS */;
INSERT INTO `winevarieties` VALUES (1,'Shiraz ','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(2,'Cabernet Sauvignon','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(3,'Sauvignon Blanc','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(4,'Riesling','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(5,'Chardonnay','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(6,'Sparkling','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(7,'White','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(8,'Rose','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(9,'Red','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(10,'Desert','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(11,'Prosecco','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(12,'Pinot Noir ','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(13,'Muscadet','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(14,'Trebbiano','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(15,'Pinot Gris ','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(16,'Chenin Blanc ','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(17,'Viognier','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(18,'Chardonnay','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(19,'Grenache/Cinsault/Carignan','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(20,'Sangiovese ','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(21,'Gamay','','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(22,'Merlot/Cabernets ','','0000-00-00 00:00:00','','0000-00-00 00:00:00','');
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

-- Dump completed on 2014-01-12 16:36:04
