-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: misdb
-- ------------------------------------------------------
-- Server version	8.0.37

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_type_id` int DEFAULT NULL,
  `category` varchar(150) DEFAULT NULL,
  `category_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_categories_request_types1_idx` (`request_type_id`),
  CONSTRAINT `fk_cat_rqt` FOREIGN KEY (`request_type_id`) REFERENCES `request_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,1,'ICT Equipment Service',NULL),(2,1,'Network Service',NULL),(3,1,'Software/Application Service',NULL),(4,2,'Account Management',NULL),(5,2,'Report Generation',NULL),(6,2,'Activity-Based Assistance',NULL),(7,2,'Others',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_types`
--

DROP TABLE IF EXISTS `client_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_type` varchar(150) DEFAULT NULL,
  `client_type_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_types`
--

LOCK TABLES `client_types` WRITE;
/*!40000 ALTER TABLE `client_types` DISABLE KEYS */;
INSERT INTO `client_types` VALUES (1,'Business','Entities engaged in commercial activities for profit.'),(2,'Citizen','Individual residents or community members.'),(3,'Government','Public-sector entities governing and providing services.');
/*!40000 ALTER TABLE `client_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `csf`
--

DROP TABLE IF EXISTS `csf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `csf` (
  `id` int NOT NULL AUTO_INCREMENT,
  `helpdesks_id` int DEFAULT NULL,
  `crit1` int DEFAULT NULL,
  `crit2` int DEFAULT NULL,
  `crit3` int DEFAULT NULL,
  `crit4` int DEFAULT NULL,
  `overall` int DEFAULT NULL,
  `reasons` text,
  `comments` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `csf`
--

LOCK TABLES `csf` WRITE;
/*!40000 ALTER TABLE `csf` DISABLE KEYS */;
INSERT INTO `csf` VALUES (1,119,4,4,4,4,4,'N/A','N/A','2024-02-13 08:37:09','2024-02-13 08:37:09'),(2,125,4,4,4,4,4,NULL,'You\\\'re so alert and amazing! Keep it up!','2024-02-14 05:46:15','2024-02-14 05:46:15'),(3,127,4,4,4,4,4,NULL,'Thank you for your prompt action. &quot;Maaasahan&quot; as always. Keep up the good work. :-)','2024-02-15 03:54:54','2024-02-15 03:54:54'),(4,126,4,4,4,4,4,'N/A','N/A','2024-02-15 04:06:14','2024-02-15 04:06:14'),(5,156,4,4,4,4,4,'aw','aw','2024-02-16 09:20:09','2024-02-16 09:20:19'),(6,157,4,4,4,4,4,NULL,NULL,'2024-02-19 04:20:49','2024-02-19 04:20:49'),(7,158,4,4,4,4,4,'hello','world','2024-03-11 08:50:09','2024-03-11 08:50:09'),(8,NULL,4,4,4,4,4,'N/A','Thank you very much for the prompt assistance!  :D','2024-04-22 01:09:37','2024-04-22 01:09:37'),(9,160,4,4,4,4,4,NULL,NULL,'2024-04-23 06:52:50','2024-04-23 06:52:50'),(10,237,4,4,4,4,4,NULL,NULL,'2024-04-24 00:16:14','2024-04-24 00:16:14'),(11,238,4,4,4,4,4,NULL,NULL,'2024-04-24 00:16:55','2024-04-24 00:16:55'),(12,239,4,4,4,4,4,NULL,NULL,'2024-04-24 00:17:29','2024-04-24 00:17:29'),(13,240,4,4,4,4,4,NULL,NULL,'2024-04-24 00:22:31','2024-04-24 00:22:31'),(14,242,4,4,4,4,4,NULL,NULL,'2024-04-24 00:23:08','2024-04-24 00:23:08'),(15,232,4,4,4,4,4,NULL,NULL,'2024-04-24 00:23:30','2024-04-24 00:23:30'),(16,236,4,4,4,4,4,NULL,NULL,'2024-04-24 00:24:02','2024-04-24 00:24:02'),(17,212,4,4,4,4,4,NULL,NULL,'2024-04-24 00:25:42','2024-04-24 00:25:42'),(18,257,4,4,4,4,4,NULL,NULL,'2024-04-24 00:27:33','2024-04-24 00:27:33'),(19,282,4,4,4,4,4,NULL,NULL,'2024-04-24 02:55:25','2024-04-24 02:55:25'),(20,283,4,4,4,4,4,NULL,NULL,'2024-04-24 02:55:47','2024-04-24 02:55:47'),(21,278,4,4,4,4,4,NULL,NULL,'2024-04-24 02:56:22','2024-04-24 02:56:22'),(22,284,4,4,4,4,4,NULL,NULL,'2024-04-24 02:56:46','2024-04-24 02:56:46'),(23,274,4,4,4,4,4,NULL,'Good job! Thank you :)','2024-04-24 02:57:25','2024-04-24 02:57:25'),(24,275,4,4,4,4,4,NULL,NULL,'2024-04-24 02:57:41','2024-04-24 02:57:41'),(25,276,4,4,4,4,4,NULL,NULL,'2024-04-24 02:58:01','2024-04-24 02:58:01'),(26,277,4,4,4,4,4,NULL,NULL,'2024-04-24 02:58:16','2024-04-24 02:58:16'),(27,182,4,4,4,4,4,NULL,'Thank you MIS for your prompt actions as always','2024-04-24 02:59:00','2024-04-24 02:59:00'),(28,185,4,4,4,4,4,NULL,'We appreciate your prompt response as always. Thank you.','2024-04-24 02:59:43','2024-04-24 02:59:43'),(29,165,4,4,4,4,4,NULL,NULL,'2024-04-24 03:00:10','2024-04-24 03:00:10'),(30,264,4,4,4,4,4,NULL,NULL,'2024-04-24 03:00:29','2024-04-24 03:00:29'),(31,251,4,4,4,4,4,NULL,NULL,'2024-04-24 03:02:04','2024-04-24 03:02:04'),(32,199,4,4,4,4,4,NULL,NULL,'2024-04-24 03:03:14','2024-04-24 03:03:14'),(33,265,4,4,4,4,4,NULL,NULL,'2024-04-24 03:03:27','2024-04-24 03:03:27'),(34,334,4,4,4,4,4,NULL,NULL,'2024-04-24 03:03:45','2024-04-24 03:03:45'),(35,340,4,4,4,4,4,NULL,NULL,'2024-04-24 03:04:11','2024-04-24 03:04:11'),(36,339,4,4,4,4,4,NULL,NULL,'2024-04-24 03:04:42','2024-04-24 03:04:42'),(37,219,4,4,4,4,4,'Thank you!',NULL,'2024-04-24 03:05:13','2024-04-24 03:05:13'),(38,220,4,4,4,4,4,NULL,NULL,'2024-04-24 03:05:29','2024-04-24 03:05:29'),(39,222,4,4,4,4,4,NULL,NULL,'2024-04-24 03:05:47','2024-04-24 03:05:47'),(40,206,4,4,4,4,4,NULL,NULL,'2024-04-24 03:06:05','2024-04-24 03:06:05'),(41,207,4,4,4,4,4,NULL,NULL,'2024-04-24 03:06:21','2024-04-24 03:06:21'),(42,223,4,4,4,4,4,NULL,NULL,'2024-04-24 03:06:36','2024-04-24 03:06:36'),(43,204,4,4,4,4,4,NULL,NULL,'2024-04-24 03:06:50','2024-04-24 03:06:50'),(44,210,4,4,4,4,4,NULL,NULL,'2024-04-24 03:07:12','2024-04-24 03:07:12'),(45,205,4,4,4,4,4,NULL,NULL,'2024-04-24 03:07:26','2024-04-24 03:07:26'),(46,221,4,4,4,4,4,NULL,NULL,'2024-04-24 03:07:39','2024-04-24 03:07:39'),(47,209,4,4,4,4,4,NULL,NULL,'2024-04-24 03:07:54','2024-04-24 03:07:54'),(48,225,4,4,4,4,4,NULL,NULL,'2024-04-24 03:08:48','2024-04-24 03:08:48'),(49,243,4,4,4,4,4,NULL,NULL,'2024-04-24 03:14:57','2024-04-24 03:14:57'),(50,235,4,4,4,4,4,NULL,NULL,'2024-04-24 03:16:39','2024-04-24 03:16:39'),(51,228,4,4,4,4,4,NULL,NULL,'2024-04-24 03:16:46','2024-04-24 03:16:46'),(52,227,4,4,4,4,4,NULL,NULL,'2024-04-24 03:17:03','2024-04-24 03:17:03'),(53,231,4,4,4,4,4,NULL,NULL,'2024-04-24 03:17:06','2024-04-24 03:17:06'),(54,226,4,4,4,4,4,NULL,NULL,'2024-04-24 03:17:18','2024-04-24 03:17:18'),(55,229,4,4,4,4,4,NULL,NULL,'2024-04-24 03:17:30','2024-04-24 03:17:30'),(56,230,4,4,4,4,4,NULL,NULL,'2024-04-24 03:17:35','2024-04-24 03:17:35'),(57,253,4,4,4,4,4,NULL,NULL,'2024-04-24 03:17:44','2024-04-24 03:17:44'),(58,248,4,4,4,4,4,NULL,NULL,'2024-04-24 03:18:17','2024-04-24 03:18:17'),(59,241,4,4,4,4,4,NULL,NULL,'2024-04-24 03:18:53','2024-04-24 03:18:53'),(60,249,4,4,4,4,4,NULL,NULL,'2024-04-24 03:19:15','2024-04-24 03:19:15'),(61,247,4,4,4,4,4,NULL,NULL,'2024-04-24 03:23:07','2024-04-24 03:23:07'),(62,246,4,4,4,4,4,NULL,NULL,'2024-04-24 03:23:44','2024-04-24 03:23:44'),(63,269,4,4,4,4,4,NULL,NULL,'2024-04-24 03:24:13','2024-04-24 03:24:13'),(64,218,4,4,4,4,4,NULL,NULL,'2024-04-24 03:24:34','2024-04-24 03:24:34'),(65,252,4,4,4,4,4,NULL,NULL,'2024-04-24 03:25:02','2024-04-24 03:25:02'),(66,217,4,4,4,4,4,NULL,NULL,'2024-04-24 03:25:21','2024-04-24 03:25:21'),(67,263,4,4,4,4,4,NULL,NULL,'2024-04-24 03:25:37','2024-04-24 03:25:37'),(68,311,4,4,4,4,4,NULL,NULL,'2024-04-24 03:25:51','2024-04-24 03:25:51'),(69,333,4,4,4,4,4,NULL,NULL,'2024-04-24 03:26:02','2024-04-24 03:26:02'),(70,310,4,4,4,4,4,NULL,NULL,'2024-04-24 03:26:04','2024-04-24 03:26:04'),(71,327,4,4,4,4,4,NULL,'Very prompt! TY','2024-04-24 03:26:26','2024-04-24 03:27:49'),(72,192,4,4,4,4,4,NULL,NULL,'2024-04-24 03:26:49','2024-04-24 03:26:49'),(73,191,4,4,4,4,4,NULL,NULL,'2024-04-24 03:27:05','2024-04-24 03:27:05'),(74,287,4,4,4,4,4,NULL,'Excellent service. Thank you.','2024-04-24 03:27:24','2024-04-24 03:27:24'),(75,301,4,4,4,4,4,NULL,NULL,'2024-04-24 03:27:40','2024-04-24 03:27:40'),(76,302,4,4,4,4,4,NULL,NULL,'2024-04-24 03:27:53','2024-04-24 03:27:53'),(77,291,4,4,4,4,4,NULL,NULL,'2024-04-24 03:28:12','2024-04-24 03:28:12'),(78,299,4,4,4,4,4,NULL,'Prompt service. Thank you!','2024-04-24 03:28:24','2024-04-24 03:28:24'),(79,294,4,4,4,4,4,NULL,NULL,'2024-04-24 03:28:24','2024-04-24 03:28:24'),(80,293,4,4,4,4,4,NULL,NULL,'2024-04-24 03:28:38','2024-04-24 03:28:38'),(81,286,4,4,4,4,4,NULL,NULL,'2024-04-24 03:28:43','2024-04-24 03:28:43'),(82,307,4,4,4,4,4,NULL,NULL,'2024-04-24 03:28:52','2024-04-24 03:28:52'),(83,306,4,4,4,4,4,NULL,NULL,'2024-04-24 03:29:06','2024-04-24 03:29:06'),(84,300,4,4,4,4,4,NULL,NULL,'2024-04-24 03:29:07','2024-04-24 03:29:07'),(85,292,4,4,4,4,4,NULL,NULL,'2024-04-24 03:29:22','2024-04-24 03:29:22'),(86,298,4,4,4,4,4,NULL,NULL,'2024-04-24 03:29:29','2024-04-24 03:29:29'),(87,328,4,4,4,4,4,NULL,NULL,'2024-04-24 03:29:41','2024-04-24 03:29:41'),(88,305,4,4,4,4,4,NULL,NULL,'2024-04-24 03:29:43','2024-04-24 03:29:43'),(89,288,4,4,4,4,4,NULL,NULL,'2024-04-24 03:30:02','2024-04-24 03:30:02'),(90,281,4,4,4,4,4,NULL,'Thank you.','2024-04-24 03:30:04','2024-04-24 03:30:04'),(91,268,4,4,4,4,4,NULL,'Thank you.','2024-04-24 03:30:30','2024-04-24 03:30:30'),(92,290,4,4,4,4,4,NULL,'Thanks for the prompt service.','2024-04-24 03:30:33','2024-04-24 03:30:33'),(93,295,4,4,4,4,4,NULL,NULL,'2024-04-24 03:30:55','2024-04-24 03:30:55'),(94,260,4,4,4,4,4,NULL,NULL,'2024-04-24 03:31:04','2024-04-24 03:31:04'),(95,304,4,4,4,4,4,NULL,NULL,'2024-04-24 03:31:13','2024-04-24 03:31:13'),(96,250,4,4,4,4,4,NULL,NULL,'2024-04-24 03:31:41','2024-04-24 03:31:41'),(97,184,4,4,4,4,4,NULL,NULL,'2024-04-24 03:31:52','2024-04-24 03:31:52'),(98,319,4,4,4,4,4,NULL,NULL,'2024-04-24 03:31:57','2024-04-24 03:31:57'),(99,318,4,4,4,4,4,NULL,'Thank you, Sir Dan & MIS!','2024-04-24 03:32:39','2024-04-24 03:32:39'),(100,312,4,4,4,4,4,NULL,'Thank you, as always sir Kristopher & MIS!','2024-04-24 03:33:58','2024-04-24 03:33:58'),(101,329,4,4,4,4,4,NULL,NULL,'2024-04-24 03:34:23','2024-04-24 03:34:23'),(102,279,4,4,4,4,4,NULL,NULL,'2024-04-24 03:34:39','2024-04-24 03:34:39'),(103,342,4,4,4,4,4,NULL,NULL,'2024-04-24 03:34:58','2024-04-24 03:34:58'),(104,171,4,4,4,4,4,NULL,NULL,'2024-04-24 03:47:20','2024-04-24 03:47:20'),(105,177,4,4,4,4,4,NULL,NULL,'2024-04-24 03:47:34','2024-04-24 03:47:34'),(106,164,4,4,4,4,4,NULL,NULL,'2024-04-24 03:48:16','2024-04-24 03:48:16'),(107,176,4,4,4,4,4,NULL,NULL,'2024-04-24 03:48:31','2024-04-24 03:48:31'),(108,181,4,4,4,4,4,NULL,NULL,'2024-04-24 03:48:43','2024-04-24 03:48:43'),(109,173,4,4,4,4,4,NULL,NULL,'2024-04-24 03:48:57','2024-04-24 03:48:57'),(110,163,4,4,4,4,4,NULL,NULL,'2024-04-24 03:49:14','2024-04-24 03:49:14'),(111,162,4,4,4,4,4,NULL,NULL,'2024-04-24 03:49:25','2024-04-24 03:49:25'),(112,166,4,4,4,4,4,NULL,NULL,'2024-04-24 03:50:45','2024-04-24 03:50:45'),(113,352,4,4,4,4,4,'N/A','Thank you for the prompt assistance, Dan, as always! :D ','2024-04-25 03:07:35','2024-04-25 03:07:35'),(114,356,4,4,4,4,4,NULL,'Your action towards this request was highly appreciated. Thank you','2024-04-25 08:31:38','2024-04-25 08:31:38'),(115,346,4,4,4,4,4,NULL,NULL,'2024-04-26 01:52:44','2024-04-26 01:52:44'),(116,348,4,4,4,4,4,NULL,NULL,'2024-04-26 01:53:10','2024-04-26 01:53:10'),(117,347,4,4,4,4,4,NULL,NULL,'2024-04-26 01:53:27','2024-04-26 01:53:27'),(118,371,4,4,4,4,4,NULL,NULL,'2024-04-26 08:17:54','2024-04-26 08:17:54'),(119,256,4,4,4,4,4,NULL,NULL,'2024-04-26 08:43:56','2024-04-26 08:43:56'),(120,373,4,4,4,4,4,'Prompt action.',NULL,'2024-04-29 06:11:43','2024-04-29 06:11:43'),(121,374,4,4,4,4,4,NULL,NULL,'2024-04-29 07:46:57','2024-04-29 07:46:57'),(122,376,4,4,4,4,4,NULL,NULL,'2024-04-30 03:42:35','2024-04-30 03:42:35'),(123,378,4,4,4,4,4,'N/A','Salamat sa madasig nga pag hatag sang solusyon sa amon request','2024-04-30 09:19:34','2024-04-30 09:19:34'),(124,399,4,4,4,4,4,NULL,NULL,'2024-05-02 05:05:38','2024-05-02 05:05:38'),(125,403,4,4,4,4,4,'N/A','Thank you so much.','2024-05-03 02:59:14','2024-05-03 02:59:14'),(126,404,4,4,4,4,4,NULL,'Very satisfied with the quick response to my request. Thank you! ','2024-05-06 03:53:34','2024-05-06 03:53:34'),(127,408,4,4,4,4,4,NULL,NULL,'2024-05-06 08:49:09','2024-05-06 08:49:09'),(128,411,4,4,4,4,4,NULL,NULL,'2024-05-07 02:09:38','2024-05-07 02:09:38'),(129,415,4,4,4,4,4,NULL,NULL,'2024-05-08 09:35:07','2024-05-08 09:35:07'),(130,402,4,4,4,4,4,NULL,'Thank your for the service as always, Sir Pe!','2024-05-09 01:44:17','2024-05-09 01:44:17'),(131,417,4,4,4,4,4,NULL,NULL,'2024-05-09 05:26:43','2024-05-09 05:26:43'),(132,418,4,4,4,4,4,NULL,NULL,'2024-05-09 05:37:48','2024-05-09 05:37:48'),(133,413,4,4,4,4,4,NULL,NULL,'2024-05-09 05:38:20','2024-05-09 05:38:20'),(134,409,4,4,4,4,4,NULL,NULL,'2024-05-09 05:38:51','2024-05-09 05:38:51'),(135,421,4,4,4,4,4,NULL,NULL,'2024-05-09 06:31:12','2024-05-09 06:31:12'),(136,422,4,4,4,4,4,NULL,'Thanks you so much for the prompt service as always','2024-05-10 03:29:31','2024-05-10 03:29:31'),(137,187,4,4,4,4,4,NULL,'Appreciate your assistance.','2024-05-10 03:31:06','2024-05-10 03:31:06'),(138,159,4,4,4,4,4,NULL,NULL,'2024-05-10 06:10:23','2024-05-10 06:10:23'),(139,258,4,4,4,4,4,NULL,NULL,'2024-05-10 06:48:05','2024-05-10 06:48:05'),(140,262,4,4,4,4,4,NULL,NULL,'2024-05-10 06:48:19','2024-05-10 06:48:19'),(141,244,4,4,4,4,4,NULL,NULL,'2024-05-10 06:48:33','2024-05-10 06:48:33'),(142,233,4,4,4,4,4,NULL,NULL,'2024-05-10 06:48:48','2024-05-10 06:48:48'),(143,216,4,4,4,4,4,NULL,NULL,'2024-05-10 06:49:15','2024-05-10 06:49:15'),(144,261,4,4,4,4,4,NULL,NULL,'2024-05-10 06:55:05','2024-05-10 06:55:05'),(145,289,4,4,4,4,4,'N/A','Thank you!','2024-05-10 08:16:38','2024-05-10 08:16:38'),(146,190,4,4,4,4,4,'Always amenable to assists in every urgent needs/concerns.',NULL,'2024-05-10 08:49:09','2024-05-10 08:49:09'),(147,424,4,4,4,4,4,NULL,'Thank you for the assistance!','2024-05-12 11:40:32','2024-05-12 11:40:32'),(148,407,4,4,4,4,4,NULL,NULL,'2024-05-13 03:13:55','2024-05-13 03:13:55'),(149,420,4,4,4,4,4,NULL,NULL,'2024-05-14 08:30:35','2024-05-14 08:30:35'),(150,427,4,4,4,4,4,NULL,'Thank you for the support and excellent service.','2024-05-15 02:39:20','2024-05-15 02:39:20'),(151,428,4,4,4,4,4,NULL,NULL,'2024-05-15 05:59:57','2024-05-15 05:59:57'),(152,273,4,4,4,4,4,NULL,NULL,'2024-05-16 02:19:21','2024-05-16 02:19:21'),(153,172,4,4,4,4,4,NULL,NULL,'2024-05-16 02:19:44','2024-05-16 02:19:44'),(154,161,4,4,4,4,4,NULL,NULL,'2024-05-16 02:20:02','2024-05-16 02:20:02'),(155,317,4,4,4,4,4,NULL,NULL,'2024-05-16 02:20:16','2024-05-16 02:20:16'),(156,259,4,4,4,4,4,NULL,NULL,'2024-05-16 02:20:31','2024-05-16 02:20:31'),(157,169,4,4,4,4,4,NULL,NULL,'2024-05-16 02:20:47','2024-05-16 02:20:47'),(158,174,4,4,4,4,4,NULL,NULL,'2024-05-16 02:21:16','2024-05-16 02:21:16'),(159,245,4,4,4,4,4,NULL,NULL,'2024-05-16 02:21:35','2024-05-16 02:21:35'),(160,337,4,4,4,4,4,NULL,NULL,'2024-05-16 02:22:52','2024-05-16 02:22:52'),(161,325,4,4,4,4,4,NULL,NULL,'2024-05-16 02:23:12','2024-05-16 02:23:12'),(162,202,4,4,4,4,4,NULL,NULL,'2024-05-16 02:23:48','2024-05-16 02:23:48'),(163,338,4,4,4,4,4,NULL,NULL,'2024-05-16 02:24:05','2024-05-16 02:24:05'),(164,208,4,4,4,4,4,NULL,NULL,'2024-05-16 02:24:20','2024-05-16 02:24:20'),(165,211,4,4,4,4,4,NULL,NULL,'2024-05-16 02:24:43','2024-05-16 02:24:43'),(166,341,4,4,4,4,4,NULL,NULL,'2024-05-16 02:25:00','2024-05-16 02:25:00'),(167,180,4,4,4,4,4,NULL,NULL,'2024-05-16 02:25:14','2024-05-16 02:25:14'),(168,343,4,4,4,4,4,NULL,NULL,'2024-05-16 02:25:39','2024-05-16 02:25:39'),(169,193,4,4,4,4,4,NULL,NULL,'2024-05-16 02:25:58','2024-05-16 02:25:58'),(170,179,4,4,4,4,4,NULL,NULL,'2024-05-16 02:26:15','2024-05-16 02:26:15'),(171,320,4,4,4,4,4,NULL,NULL,'2024-05-16 02:26:28','2024-05-16 02:26:28'),(172,167,4,4,4,4,4,NULL,NULL,'2024-05-16 02:26:42','2024-05-16 02:26:42'),(173,271,4,4,4,4,4,NULL,NULL,'2024-05-16 02:51:34','2024-05-16 02:51:34'),(174,425,4,4,4,4,4,NULL,NULL,'2024-05-16 03:17:49','2024-05-16 03:17:49'),(175,309,4,4,4,4,4,'N/A','thanks for the immediate response','2024-05-16 03:52:19','2024-05-16 03:52:19'),(176,213,4,4,4,4,4,NULL,NULL,'2024-05-16 04:23:49','2024-05-16 04:23:49'),(177,366,4,4,4,4,4,NULL,NULL,'2024-05-16 04:24:21','2024-05-16 04:24:21'),(178,359,4,4,4,4,4,NULL,NULL,'2024-05-16 05:29:25','2024-05-16 05:29:25'),(179,367,4,4,4,4,4,NULL,NULL,'2024-05-16 05:29:44','2024-05-16 05:29:44');
/*!40000 ALTER TABLE `csf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divisions`
--

DROP TABLE IF EXISTS `divisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divisions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `division` varchar(150) DEFAULT NULL,
  `division_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisions`
--

LOCK TABLES `divisions` WRITE;
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` VALUES (1,'ORD','Office of the Regional Director'),(2,'BDD','Business Development Division'),(3,'CPD','Consumer Protection Division'),(4,'FAD','Finance and Admin Division'),(5,'IDD','Industry Development Division'),(6,'COA','Commision On Audit'),(7,'DTI Aklan','Aklan Provincial Office'),(8,'DTI Antique','Antique Provincial Office'),(9,'DTI Capiz','Capiz Provincial Office'),(10,'DTI Guimaras','Guimaras Provincial Office'),(11,'DTI Iloilo','Iloilo Provincial Office'),(12,'DTI Negros Occidental','Negros Occidental Provincial Office'),(13,'DTI','Default');
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `equipment_type_id` int DEFAULT NULL,
  `brand` varchar(150) DEFAULT NULL,
  `model_number` varchar(150) DEFAULT NULL,
  `serial_number` varchar(150) DEFAULT NULL,
  `property_number` varchar(150) DEFAULT NULL,
  `cost` double(65,2) DEFAULT NULL,
  `description` text,
  `remarks` text,
  `status_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_equipment_equipment_type1_idx` (`equipment_type_id`),
  KEY `fk_equipment_equipment_statuses1_idx` (`status_id`),
  CONSTRAINT `fk_equ_eqs` FOREIGN KEY (`status_id`) REFERENCES `equipment_statuses` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_equ_eqt` FOREIGN KEY (`equipment_type_id`) REFERENCES `equipment_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment`
--

LOCK TABLES `equipment` WRITE;
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment_statuses`
--

DROP TABLE IF EXISTS `equipment_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipment_statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(150) DEFAULT NULL,
  `status_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment_statuses`
--

LOCK TABLES `equipment_statuses` WRITE;
/*!40000 ALTER TABLE `equipment_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment_type`
--

DROP TABLE IF EXISTS `equipment_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipment_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `equipment_type` varchar(150) DEFAULT NULL,
  `equipment_type_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment_type`
--

LOCK TABLES `equipment_type` WRITE;
/*!40000 ALTER TABLE `equipment_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `files` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference_id` int DEFAULT NULL,
  `file_name` varchar(150) DEFAULT NULL,
  `file_path` text,
  `file_mime` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_fil_hel_idx` (`reference_id`),
  CONSTRAINT `fk_fil_hel` FOREIGN KEY (`reference_id`) REFERENCES `helpdesks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helpdesks`
--

DROP TABLE IF EXISTS `helpdesks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `helpdesks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_number` varchar(150) DEFAULT NULL COMMENT 'ICT-2024-01-001',
  `requested_by` int DEFAULT NULL,
  `date_requested` date DEFAULT NULL,
  `request_type_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `sub_category_id` int DEFAULT NULL,
  `complaint` varchar(150) DEFAULT NULL,
  `datetime_preferred` datetime DEFAULT NULL,
  `status_id` int DEFAULT '1',
  `sent_id` int DEFAULT '1',
  `property_number` varchar(150) DEFAULT NULL,
  `priority_level_id` int DEFAULT NULL,
  `repair_type_id` int DEFAULT NULL,
  `repair_class_id` int DEFAULT NULL,
  `medium_id` int DEFAULT NULL,
  `assigned_to` int DEFAULT NULL,
  `approved_by` int DEFAULT NULL,
  `serviced_by` int DEFAULT NULL,
  `datetime_start` datetime DEFAULT NULL,
  `datetime_end` datetime DEFAULT NULL,
  `diagnosis` text,
  `remarks` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pull_out` tinyint DEFAULT NULL,
  `turn_over` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_helpdesks_users_idx` (`requested_by`),
  KEY `fk_helpdesks_repair_types1_idx` (`repair_type_id`),
  KEY `fk_helpdesks_categories1_idx` (`category_id`),
  KEY `fk_helpdesks_request_types1_idx` (`request_type_id`),
  KEY `fk_helpdesks_sub_categories1_idx` (`sub_category_id`),
  KEY `fk_helpdesks_repair_classes1_idx` (`repair_class_id`),
  KEY `fk_helpdesks_mediums1_idx` (`medium_id`),
  KEY `fk_helpdesks_priority_levels1_idx` (`priority_level_id`),
  KEY `fk_helpdesks_users1_idx` (`assigned_to`),
  KEY `fk_helpdesks_users2_idx` (`approved_by`),
  KEY `fk_helpdesks_users3_idx` (`serviced_by`),
  KEY `fk_helpdesks_helpdesks_statuses1_idx` (`status_id`),
  CONSTRAINT `fk_hel_cat` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_hes` FOREIGN KEY (`status_id`) REFERENCES `helpdesks_statuses` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_med` FOREIGN KEY (`medium_id`) REFERENCES `mediums` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_prl` FOREIGN KEY (`priority_level_id`) REFERENCES `priority_levels` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_rec` FOREIGN KEY (`repair_class_id`) REFERENCES `repair_classes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_ret` FOREIGN KEY (`repair_type_id`) REFERENCES `repair_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_rqt` FOREIGN KEY (`request_type_id`) REFERENCES `request_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_sca` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_use1` FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_use2` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_use3` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_use4` FOREIGN KEY (`serviced_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=431 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpdesks`
--

LOCK TABLES `helpdesks` WRITE;
/*!40000 ALTER TABLE `helpdesks` DISABLE KEYS */;
INSERT INTO `helpdesks` VALUES (157,'REQ-2024-02-001',123,'2024-02-19',1,1,1,'no display','2024-02-19 05:17:00',5,5,'1234567',1,1,1,1,110,108,110,'2024-02-19 12:18:00','2024-02-19 12:43:00','deffective power cord','Done','2024-02-19 04:18:01','2024-02-23 07:15:53',NULL,NULL),(158,'REQ-2024-02-002',123,'2024-02-23',1,1,1,'WALAs','2024-02-23 08:37:00',5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-23 07:45:55','2024-03-11 08:35:49',0,0),(159,'REQ-2024-04-001',117,'2024-04-23',1,2,5,'No internet the PC of ma\\\\\\\\\\\\\\\'am Therese','2024-04-23 09:40:00',5,5,NULL,2,1,1,2,111,109,111,'2024-04-23 09:40:00','2024-04-23 09:45:00','Reset the internet driver.','Done','2024-04-23 01:50:53','2024-05-10 06:04:22',0,0),(160,'REQ-2024-04-002',113,'2024-04-18',1,1,2,'NC Tubungan - Lagging and slow','2024-04-18 09:00:00',5,5,'66NHZN2',1,1,1,2,111,108,111,'2024-04-22 13:00:00','2024-04-22 15:00:00','Upgrade to SSD','Done','2024-04-23 05:21:00','2024-04-23 05:21:23',1,1),(161,'REQ-2024-01-010',103,'2024-01-02',1,1,1,'Desktop arrangement',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(162,'REQ-2024-01-029',116,'2024-01-02',1,1,1,'Set-up new PC',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(163,'REQ-2024-01-030',116,'2024-01-02',1,1,1,'Reformat the PC for the new chief of BDD',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(164,'REQ-2024-02-020',NULL,'2024-01-02',1,1,1,'Laggy PC and no shutdown button',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(165,'REQ-2024-02-022',117,'2024-01-02',1,1,1,'Flickering screen - May Ann\'s PC',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(166,'REQ-2024-03-022',116,'2024-01-03',1,1,1,'documents default apps is WPS',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(167,'REQ-2024-03-043',103,'2024-01-04',1,1,1,'no boot-up',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(168,'REQ-2024-04-013',103,'2024-04-01',1,1,1,'No boot up','2024-04-03 09:00:00',5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,'2024-04-03 09:15:00','2024-04-03 09:20:00','Reattached the SSD','Done','2024-04-23 05:28:28','2024-05-16 03:02:19',0,0),(169,'REQ-2024-01-023',104,'2024-01-05',1,1,2,'Cracked hinge',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(170,'REQ-2024-03-028',104,'2024-01-05',1,1,2,'Laptop check up and canvass for LCD replacement, RAM and SSD',NULL,2,2,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(171,'REQ-2024-03-040',NULL,'2024-01-08',1,1,4,'UPS',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(172,'REQ-2024-01-007',103,'2024-01-08',1,1,3,'Other printer options not available',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(173,'REQ-2024-01-027',116,'2024-01-09',1,1,3,'No connection',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(174,'REQ-2024-01-028',103,'2024-01-09',1,1,3,'No driver',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(175,'REQ-2024-04-030',133,'2024-04-01',1,1,3,'No color printing','2024-04-16 13:00:00',5,5,NULL,NULL,1,NULL,2,111,109,111,'2024-04-16 13:05:00','2024-04-16 13:20:00','Nozzle head and power cleaning and pump the ink tube.','Done','2024-04-23 05:28:28','2024-05-16 02:47:28',0,0),(176,'REQ-2024-03-037',NULL,'2024-01-22',1,2,5,'No Internet',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(177,'REQ-2024-03-044',NULL,'2024-01-22',1,2,5,'No internet',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(178,'REQ-2024-04-012',117,'2024-04-01',1,2,5,'No internet','2024-04-03 08:30:00',5,5,NULL,1,1,1,2,111,108,111,'2024-05-16 08:30:00','2024-04-03 08:45:00','Reset the network driver and make the connection static.','Done','2024-04-23 05:28:28','2024-05-16 02:53:34',0,0),(179,'REQ-2024-03-031',103,'2024-01-23',1,2,6,'no internet connection',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(180,'REQ-2024-03-008',104,'2024-01-24',1,2,8,'Cant connect to NAS',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(181,'REQ-2024-02-005',116,'2024-01-24',1,3,13,'MS Office files opens in WPS',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(182,'REQ-2024-02-006',117,'2024-01-26',1,3,13,'Excel custom view is empty',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(183,'REQ-2024-04-024',117,'2024-04-01',1,3,13,'Recover MS Word file','2024-04-03 16:00:00',5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,'2024-04-03 16:00:00','2024-04-03 17:00:00','MS word not responding. ctrl S and auto recovery.','Done','2024-04-23 05:28:28','2024-05-16 03:05:26',0,0),(184,'REQ-2024-02-011',NULL,'2024-01-30',2,4,17,'Creation of iMMIS Accounts for 13 NCs',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(185,'REQ-2024-02-021',117,'2024-01-30',2,4,14,'Backup of outlook emails of Ma\'am Yolly',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(186,'REQ-2024-04-039',116,'2024-04-01',2,7,29,'Access Denied in DTI6 Communication Logsheet in KR Hub','2024-04-18 10:00:00',5,5,NULL,NULL,NULL,NULL,NULL,108,108,108,'2024-04-18 10:05:00','2024-04-18 10:15:00','Update outlook password and permission settings in DTI6 KR HUb','Done','2024-04-23 05:28:28','2024-05-10 05:37:23',0,0),(187,'REQ-2024-02-034',104,'2024-01-05',2,5,22,'List of Profiled/Assisted 4P Beneficiaries for year 2023','2024-02-29 11:00:00',5,5,NULL,NULL,NULL,NULL,NULL,109,108,109,'2024-02-29 11:06:00','2024-03-01 09:40:00',NULL,NULL,'2024-04-23 05:28:28','2024-05-10 02:52:02',0,0),(188,'REQ-2024-03-024',133,'2024-01-08',2,5,22,'Report on iMMIS encoding errors (list and summary) from January 1, 2022 to March 11, 2024','2024-03-11 13:00:00',2,2,NULL,NULL,NULL,NULL,NULL,109,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-05-10 05:54:19',0,0),(189,'REQ-2024-04-032',104,'2024-04-01',2,5,22,'List of Solo Parent Clients and assistance provided','2024-04-16 14:40:00',5,5,NULL,NULL,NULL,NULL,NULL,109,108,109,'2024-04-16 14:40:00','2024-04-16 15:05:00','Generated report from iMMIS (Deadline was also today)','Done, requested report was sent to the requestor','2024-04-23 05:28:28','2024-05-10 05:31:20',0,0),(190,'REQ-2024-04-027',81,'2024-04-01',1,2,5,'No internet','2024-04-11 08:15:00',5,5,NULL,1,1,1,2,111,109,111,'2024-04-11 08:15:00','2024-04-11 08:30:00','Make the connection static','Done','2024-04-23 05:28:28','2024-05-10 05:27:14',0,0),(191,'REQ-2024-02-012',81,'2024-02-13',2,6,18,'Generate zoom link for IEC Campaign on PNS 26:2018 and PNS 2145:2020 on February 26, 27, 29, March 1, 8am to 4pm',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(192,'REQ-2024-02-028',81,'2024-02-14',2,6,27,'Tech support for IEC Campaign on PNS 262018 and PNS 21452020',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,108,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(193,'REQ-2024-03-025',NULL,'2024-02-14',1,3,13,'Unable to find Transmittal System (MS Access)',NULL,5,5,NULL,NULL,NULL,NULL,NULL,108,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(194,'REQ-2024-03-005',NULL,'2024-02-14',2,4,17,'Sir Bem, good morning! request ko tani sir new iMMIS account para sa bag o namon nga BC assigned sa NC Caticlan sir. Thank you',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(195,'REQ-2024-04-009',137,'2024-04-01',2,4,17,'Creation of iMMIS account for newly hired BCs assigned to NC Malay and NC Makato.','2024-04-02 09:30:00',5,5,NULL,NULL,NULL,NULL,NULL,109,108,109,'2024-04-02 09:30:00','2024-04-02 10:15:00','Created accounts for NC Malay and NC Makato. Account details were forwarded to their emails',NULL,'2024-04-23 05:28:28','2024-05-16 02:36:35',0,0),(196,'REQ-2024-04-037',34,'2024-04-01',2,4,18,'Recover /Update NAS Account',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-25 05:06:07',NULL,NULL),(197,'REQ-2024-04-023',137,'2024-04-01',2,5,22,'Request to generate list of 2023 Clients (Senior Citizens) with Assistance','2024-04-11 09:00:00',5,5,NULL,NULL,NULL,NULL,NULL,109,108,109,'2024-04-11 09:05:00','2024-04-11 10:18:00','To export data from client module and BSMED report, then join the two tables in MS Access.','Senior Citizen to be added to the MSME and Client Module filters. SC also to be included in the export data of PGS and BSMED Reports','2024-04-23 05:28:28','2024-05-10 01:09:37',0,0),(198,'REQ-2024-03-049',NULL,'2024-03-01',2,4,14,'Request for O365 Account',NULL,2,2,NULL,NULL,NULL,NULL,NULL,111,108,108,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-25 05:07:35',NULL,NULL),(199,'REQ-2024-02-027',NULL,'2024-02-20',2,4,17,'Change email details of iMMIS account',NULL,5,5,NULL,NULL,NULL,NULL,NULL,108,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(200,'REQ-2024-02-032',NULL,'2024-02-22',1,1,1,'No display',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(201,'REQ-2024-04-007',115,'2024-04-01',1,3,13,'Mapping of NAS of Miss Fe and Miss Marimae',NULL,5,5,NULL,NULL,NULL,NULL,NULL,109,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-25 05:07:10',NULL,NULL),(202,'REQ-2024-02-029',NULL,'2024-02-22',2,4,17,'Creation of iMMIS account for Normel Galvan (NC TIDA Account) and Ghea Rodriguez (NC San Lorenzo)',NULL,5,5,NULL,NULL,NULL,NULL,NULL,109,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(203,'REQ-2024-02-002',115,'2024-02-21',2,4,14,'Application for O365 Account of Ms. Rejoice Orquia','2024-02-14 10:30:00',2,2,NULL,NULL,NULL,NULL,NULL,108,108,108,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-05-10 05:56:20',0,0),(204,'REQ-2024-01-001',113,'2024-02-22',1,1,1,'PC disk capacity is full',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(205,'REQ-2024-01-002',113,'2024-02-22',1,1,1,'Installation of MS Office and Adobe Acrobat',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(206,'REQ-2024-02-019',113,'2024-02-02',1,1,1,'Unit system check-up',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(207,'REQ-2024-02-026',113,'2024-02-23',1,1,1,'CPU automatic shutdown',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(208,'REQ-2024-02-033',56,'2024-02-23',1,1,1,'Installation of MS Office','2024-02-29 09:45:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-05-10 01:56:04',0,0),(209,'REQ-2024-02-036',113,'2024-02-23',1,1,1,'Upgrade to SSD',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(210,'REQ-2024-02-040',113,'2024-02-23',1,1,1,'SSD upgrade',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(211,'REQ-2024-02-041',113,'2024-02-23',1,1,1,'NC San Miguel Desktop check up',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(212,'REQ-2024-03-003',113,'2024-02-23',1,1,1,'System unit won\'t turn on; no power',NULL,5,5,NULL,NULL,NULL,NULL,NULL,109,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(213,'REQ-2024-04-017',113,'2024-04-01',1,1,1,'CPU won\\\'t turn on','2024-04-04 10:00:00',5,5,NULL,1,1,1,2,111,108,111,'2024-04-04 10:00:00','2024-04-04 15:00:00','The Motherboard is defective.\\r\\nCheck all the component one by one.','Done','2024-04-23 05:28:28','2024-05-16 03:21:53',1,0),(214,'REQ-2024-04-021',65,'2024-04-01',1,1,1,'Blue screen','2024-04-08 10:00:00',5,5,NULL,1,1,1,2,108,108,108,'2024-04-08 10:00:00','2024-04-08 10:35:00','restart the PC',NULL,'2024-04-23 05:28:28','2024-05-16 03:32:40',0,1),(215,'REQ-2024-04-026',65,'2024-04-01',1,1,1,'Boot-up problem','2024-04-11 08:30:00',5,5,NULL,NULL,1,NULL,NULL,111,109,111,'2024-04-11 08:30:00','2024-04-11 12:00:00','Corrupt OS. Install new OS',NULL,'2024-04-23 05:28:28','2024-05-16 02:54:53',0,0),(216,'REQ-2024-04-035',113,'2024-04-01',1,1,1,'System Unit (No printer found & USB port damage)','2024-04-17 08:30:00',5,5,NULL,1,1,1,2,111,108,111,'2024-04-17 10:30:00','2024-04-18 09:00:00','Corrupt System32. \\r\\nInstall new OS, back up the files, optimized the drive and install necessary apps.','Done','2024-04-23 05:28:28','2024-05-10 05:34:14',1,1),(217,'REQ-2024-01-022',54,'2024-02-26',1,1,2,'Lagging applications',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(218,'REQ-2024-01-025',54,'2024-02-27',1,1,2,'Inaccessible files',NULL,5,5,NULL,NULL,NULL,NULL,NULL,109,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(219,'REQ-2024-02-007',113,'2024-02-28',1,1,2,'NC Calinog - No power',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(220,'REQ-2024-02-009',113,'2024-02-28',1,1,2,'Corrupt OS',NULL,5,5,NULL,NULL,NULL,NULL,NULL,109,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(221,'REQ-2024-02-013',113,'2024-02-27',1,1,2,'No power, not turning ON',NULL,5,5,NULL,NULL,NULL,NULL,NULL,109,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(222,'REQ-2024-02-014',113,'2024-02-27',1,1,2,'No power, not turning ON',NULL,5,5,NULL,NULL,NULL,NULL,NULL,109,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(223,'REQ-2024-02-016',113,'2024-02-29',1,1,2,'Laptop upgrade to SSD',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(224,'REQ-2024-02-046',113,'2024-02-29',1,1,2,'SSD upgrade',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(225,'REQ-2024-02-049',113,'2024-02-29',1,1,2,'NC Cabatuan - Lenovo laptop not turning ON',NULL,5,5,NULL,NULL,NULL,NULL,NULL,109,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(226,'REQ-2024-02-050',113,'2024-02-06',1,1,2,'IPO laptop - Acer laptop laggy and white line and red patch on the screen',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(227,'REQ-2024-02-051',113,'2024-02-06',1,1,2,'NC Cabatuan - Laptop no power',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(228,'REQ-2024-02-052',113,'2024-02-07',1,1,2,'IPO laptop no power',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(229,'REQ-2024-02-053',113,'2024-02-12',1,1,2,'NC Dingle - Acer laptop Damaged hinge and won\'t turn ON',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(230,'REQ-2024-02-058',113,'2024-02-13',1,1,2,'IPO laptop for check up',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(231,'REQ-2024-02-059',113,'2024-02-13',1,1,2,'NC Miagao - Laptop check-uprn',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(232,'REQ-2024-03-027',113,'2024-02-13',1,1,2,'NC Alimodian - The bottom-right corner of the screen separates when attempting to open it, creating a gap between the screen and the other parts.',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(233,'REQ-2024-04-022',113,'2024-04-01',1,1,2,'Unable to turn on','2024-04-08 14:00:00',5,5,NULL,1,1,1,2,111,108,111,'2024-04-08 14:00:00','2024-04-08 14:05:00','The charger is defective','Done','2024-04-23 05:28:28','2024-05-10 05:22:37',1,1),(234,'REQ-2024-04-031',136,'2024-04-01',1,1,2,'No bootable device','2024-04-16 12:00:00',5,5,NULL,1,1,1,5,109,108,109,'2024-04-16 13:10:00','2024-04-16 14:35:00','Laptop couldn\\\'t detect hard disk. Hard disk was damaged due to defective battery of the laptop. Pulled-out hard disk copied user files and transferred to a SSD (S/N W231100011656)','Replace the defective of the laptop','2024-04-23 05:28:28','2024-05-10 01:03:10',0,0),(235,'REQ-2024-03-002',113,'2024-02-13',1,1,4,'UPS of NC Calinog',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(236,'REQ-2024-03-004',113,'2024-02-14',1,1,4,'UPS of NC Tubungan',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(237,'REQ-2024-03-011',113,'2024-02-16',1,1,4,'UPS-NC San Joaquin',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(238,'REQ-2024-03-012',113,'2024-02-16',1,1,4,'UPS-IPO',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(239,'REQ-2024-03-013',113,'2024-02-21',1,1,4,'UPS-NC Carles',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(240,'REQ-2024-03-014',113,'2024-02-21',1,1,4,'UPS-NC Estancia',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(241,'REQ-2024-03-017',113,'2024-02-22',1,1,4,'Xerox machine paper jam',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(242,'REQ-2024-03-026',113,'2024-02-22',1,1,4,'3 External hard drive check-up',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(243,'REQ-2024-03-035',113,'2024-02-22',1,1,4,'System Unit power cord is damage',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(244,'REQ-2024-04-018',113,'2024-04-01',1,1,4,'PLDT prepaid WIFI','2024-04-04 15:00:00',5,5,NULL,1,1,1,2,111,108,111,'2024-04-04 15:00:00','2024-04-04 15:10:00','The SIM is expired','Done','2024-04-23 05:28:28','2024-05-10 05:18:40',1,1),(245,'REQ-2024-02-001',112,'2024-02-26',1,1,3,'printer end of life','2024-02-07 15:50:00',5,5,NULL,1,1,1,2,110,108,110,'2024-02-07 15:55:00','2024-02-07 16:35:00',NULL,NULL,'2024-04-23 05:28:28','2024-05-10 01:27:56',0,0),(246,'REQ-2024-02-047',113,'2024-02-26',1,1,3,'NC San Dionisio-No Color printing',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(247,'REQ-2024-02-048',113,'2024-02-27',1,1,3,'NC Carles - No black, yellow and magenta color printing',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(248,'REQ-2024-02-057',113,'2024-02-28',1,1,3,'Printer check-up for disposal',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(249,'REQ-2024-03-019',113,'2024-02-28',1,1,3,'NC Iloilo City Laptop - No printer driver',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(250,'REQ-2024-03-034',65,'2024-03-04',1,1,3,'Epson Printer cannot Scan',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(251,'REQ-2024-03-036',NULL,'2024-03-04',1,1,3,'Ink waste pad is full, end of life service.',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(252,'REQ-2024-03-038',54,'2024-03-04',1,1,3,'Transfer and install driver',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(253,'REQ-2024-03-045',113,'2024-03-04',1,1,3,'The printer blinking red and cranking gears',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(254,'REQ-2024-04-041',113,'2024-04-01',1,1,3,'NC Carles - no colors and black print out.','2024-04-17 08:30:00',5,5,NULL,NULL,NULL,NULL,NULL,111,108,109,'2024-04-17 09:00:00','2024-04-17 09:45:00',NULL,NULL,'2024-04-23 05:28:28','2024-05-16 03:15:09',0,0),(255,'REQ-2024-04-005',139,'2024-04-01',1,1,3,'End of life service','2024-04-01 15:45:00',5,5,NULL,1,1,1,2,111,109,111,'2024-04-01 15:45:00','2024-04-01 16:15:00','Reset','Done','2024-04-23 05:28:28','2024-05-16 05:29:20',1,1),(256,'REQ-2024-04-036',113,'2024-04-01',1,1,3,'Printer no longer prints color','2024-04-17 08:30:00',5,5,NULL,NULL,NULL,NULL,NULL,109,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-26 07:32:49',0,0),(257,'REQ-2024-03-001',113,'2024-03-05',1,2,5,'No internet connection',NULL,5,5,NULL,NULL,NULL,NULL,NULL,109,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(258,'REQ-2024-04-006',113,'2024-04-01',1,2,5,'No internet','2024-04-02 08:30:00',5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,'2024-04-02 08:30:00','2024-04-02 08:35:00','Check and reset the WIFI driver','Done','2024-04-23 05:28:28','2024-05-10 05:10:13',0,0),(259,'REQ-2024-01-016',112,'2024-03-05',1,3,12,'Request of Soft copy DTR','2024-01-22 11:00:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-05-10 01:24:31',0,0),(260,'REQ-2024-02-035',NULL,'2024-03-06',1,3,12,'Request for February DTR',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(261,'REQ-2024-03-009',135,'2024-03-06',1,3,12,'Fingerprint error','2024-03-05 10:00:00',5,5,NULL,1,NULL,NULL,NULL,111,108,111,'2024-03-05 10:00:00','2024-03-05 10:10:00','Check the registered fingerprint. \\\\r\\\\nRegistered the thumb finger','Done','2024-04-23 05:28:28','2024-05-10 05:51:16',0,0),(262,'REQ-2024-04-015',113,'2024-04-01',1,3,13,'Zoom Request - District 2 Monthly Meeting','2024-04-03 10:00:00',5,5,NULL,NULL,NULL,NULL,5,111,108,111,'2024-04-03 10:10:00','2024-04-03 10:15:00','Generate zoom link','Done','2024-04-23 05:28:28','2024-05-10 05:13:23',0,0),(263,'REQ-2024-03-032',54,'2024-03-06',2,6,18,'Mic and Audio setup',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(264,'REQ-2024-02-037',NULL,'2024-03-07',2,7,29,'PC transfer and set-up',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(265,'REQ-2024-02-038',NULL,'2024-03-07',2,7,29,'PC exchange and set-up (Rose Saludes)',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(266,'REQ-2024-04-020',138,'2024-04-01',2,4,15,'Cannot log in. Error: Unauthorized','2024-04-05 09:00:00',5,5,NULL,NULL,NULL,NULL,NULL,108,108,108,'2024-04-05 09:00:00','2024-04-06 21:30:00','Incorrect Password. Regenerated new password from IHRIS','Done','2024-04-23 05:28:28','2024-05-16 03:27:10',0,0),(267,'REQ-2024-03-047',NULL,'2024-03-07',2,4,17,'Creation of iMMIS Accounts for NC Pulupandan, NC Pontevedra, NC Silay, NC Valladolid, NC Bacolod',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(268,'REQ-2024-01-009',82,'2024-03-07',1,1,1,'pdf viewer problem',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(269,'REQ-2024-01-012',91,'2024-03-08',1,1,1,'Bookmark not visible',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(270,'REQ-2024-04-040',113,'2024-04-01',1,1,1,'PC won\\\\\\\'t turn on','2024-04-01 09:00:00',5,5,NULL,NULL,1,1,2,111,108,111,'2024-04-01 09:00:00','2024-04-01 09:30:00','Checked UPS, defective power cord',NULL,'2024-04-23 05:28:28','2024-05-16 03:15:32',0,0),(271,'REQ-2024-04-011',91,'2024-04-01',1,1,1,'Lag','2024-04-02 09:00:00',5,5,NULL,1,1,1,5,111,108,111,'2024-04-02 09:00:00','2024-05-02 13:00:00','Upgrade to SSD (S/N: W231100011650)','Done','2024-04-23 05:28:28','2024-05-16 02:50:15',1,1),(272,'REQ-2023-06-001',132,'2024-03-11',1,1,3,'Printer head','2023-06-16 10:00:00',5,5,NULL,NULL,1,4,5,111,108,111,'2023-06-16 10:00:00','2023-06-16 12:00:00','After conducting text-alignment and head cleaning, the printer still shows the same problem. It appears that the printer head is the main issue.','Refer to authorized or accredited service center for parts replacement.','2024-04-23 05:28:28','2024-05-10 06:00:02',1,1),(273,'REQ-2024-01-005',NULL,'2024-03-11',1,1,3,'Printer blinking orange',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(274,'REQ-2024-01-014',26,'2024-03-11',1,1,3,'Printer cannot connect to desktop',NULL,5,5,NULL,NULL,NULL,NULL,NULL,109,108,108,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(275,'REQ-2024-02-003',26,'2024-03-12',1,1,3,'Unable to print',NULL,5,5,NULL,NULL,NULL,NULL,NULL,108,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(276,'REQ-2024-01-004',26,'2024-03-12',1,2,5,'No internet connection',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(277,'REQ-2024-01-011',26,'2024-03-08',1,2,5,'Internet Connection',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(278,'REQ-2024-02-004',73,'2024-03-13',1,2,5,'No internet connection',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(279,'REQ-2024-02-017',NULL,'2024-03-13',1,2,5,'Slow internet connection',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(280,'REQ-2024-03-046',91,'2024-03-14',1,2,5,'No internet',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,108,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(281,'REQ-2024-02-024',82,'2024-03-14',1,3,10,'enGAS installation and VPN configuration for WFH seyup',NULL,5,5,NULL,NULL,NULL,NULL,NULL,108,108,108,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(282,'REQ-2024-03-020',73,'2024-03-19',1,3,10,'Installation of eNGAS and Fortinet VPN to Laptop',NULL,5,5,NULL,NULL,NULL,NULL,NULL,108,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(283,'REQ-2024-03-021',73,'2024-03-20',1,3,10,'Installation of eNGAS and BIR Alphalist 7.2',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,108,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(284,'REQ-2024-01-008',73,'2024-03-20',1,3,11,'HR System error',NULL,5,5,NULL,NULL,NULL,NULL,NULL,108,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(285,'REQ-2023-11-001',20,'2024-03-20',1,1,2,'Laptop won\'t turn on',NULL,3,3,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(286,'REQ-2024-02-025',20,'2024-03-25',1,1,2,'Laptop won\'t turn on',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(287,'REQ-2024-03-039',79,'2024-03-25',1,1,2,'Trackpad and hinge',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(288,'REQ-2024-01-017',25,'2024-03-25',1,1,4,'Mobile disconnected to Wi-Fi',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(289,'REQ-2023-12-004',40,'2024-03-25',1,1,3,'No printing','2023-12-01 15:00:00',5,5,NULL,1,2,4,2,111,109,111,'2023-12-01 15:00:00','2023-12-01 17:00:00','Defective printer head','Refer to authorized or accredited service center for parts replacement','2024-04-23 05:28:28','2024-05-10 06:03:11',1,1),(290,'REQ-2024-01-006',40,'2024-03-22',1,1,3,'Printer cant be detected to pc',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,109,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(291,'REQ-2024-02-042',NULL,'2024-03-20',1,1,3,'Set-up the new printer of ma\'am Au',NULL,5,5,NULL,NULL,NULL,NULL,NULL,109,108,108,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(292,'REQ-2024-02-044',20,'2024-03-26',1,1,3,'Set-up the printer network printing',NULL,5,5,NULL,NULL,NULL,NULL,NULL,108,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(293,'REQ-2024-03-023',NULL,'2024-03-26',1,1,3,'paper jam upon scanning',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(294,'REQ-2024-03-033',NULL,'2024-03-26',1,1,3,'Transfer and set-up',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-23 07:29:09',NULL,NULL),(295,'REQ-2024-03-050',NULL,'2024-03-01',1,1,3,'Can\'t print',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:28','2024-04-25 05:07:55',NULL,NULL),(296,'REQ-2024-04-029',40,'2024-04-01',1,1,3,'Can\\\'t print','2024-04-12 14:30:00',5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,'2024-04-12 14:30:00','2024-04-12 14:45:00','Restart the PC and do a nozzle head cleaning','Done','2024-04-23 05:28:28','2024-05-16 02:50:30',0,0),(297,'REQ-2024-04-034',129,'2024-04-01',1,1,3,'Printer need assistance','2024-04-16 15:00:00',5,5,NULL,NULL,1,NULL,NULL,111,108,111,'2024-04-16 15:00:00','2024-04-16 16:45:00','Printer set-up, nozzle head cleaning, power flashing, & pump the ink tube.','Done','2024-04-23 05:28:28','2024-05-16 02:36:48',0,0),(298,'REQ-2024-01-018',NULL,'2024-03-27',1,2,5,'Disconnected to Wi-Fi',NULL,5,5,NULL,NULL,NULL,NULL,NULL,109,108,108,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-23 07:29:09',NULL,NULL),(299,'REQ-2024-01-020',79,'2024-03-27',1,2,5,'No internet connection',NULL,5,5,NULL,NULL,NULL,NULL,NULL,108,108,111,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-23 07:29:09',NULL,NULL),(300,'REQ-2024-01-021',20,'2024-01-01',1,2,5,'No Internet Connection',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(301,'REQ-2024-02-039',NULL,'2024-02-01',1,2,5,'No internet',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(302,'REQ-2024-02-055',NULL,'2024-02-01',1,2,5,'No internet',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(303,'REQ-2024-04-025',25,'2024-04-01',1,2,5,'Can\\\'t connect to WIFI','2024-04-08 13:30:00',5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,'2024-04-08 13:30:00','2024-04-08 14:00:00','Make the connection static','Done','2024-04-23 05:28:29','2024-05-16 02:58:21',0,0),(304,'REQ-2024-01-019',25,'2024-01-01',1,2,6,'Defective LAN cable',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(305,'REQ-2024-02-054',25,'2024-02-01',1,3,13,'Install Power BI',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(306,'REQ-2024-03-029',NULL,'2024-03-01',1,3,13,'web cam for zoom',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(307,'REQ-2024-03-030',NULL,'2024-03-01',1,3,13,'excel file',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(308,'REQ-2024-04-033',129,'2024-04-01',2,7,29,'Biometric enrollment and iHRIS password reset','2024-04-16 15:00:00',5,5,NULL,NULL,NULL,NULL,NULL,109,108,109,'2024-04-16 15:15:00','2024-04-16 15:25:00','Reset password and enrolled to biometric. Can now log-in and out using the biometric system and iHRIS','Done. Reset password and enrolled to biometric. Can now log-in and out using the biometric system and iHRIS','2024-04-23 05:28:29','2024-05-16 02:40:07',0,0),(309,'REQ-2024-04-008',40,'2024-04-01',2,5,22,'List of MSMEs with Asset Size nad MSMEs under OTOP and ICE Programs','2024-04-01 15:50:00',5,5,NULL,NULL,NULL,NULL,NULL,109,108,109,'2024-04-01 15:50:00','2024-04-02 09:45:00','Generated report per province according to the requested data.',NULL,'2024-04-23 05:28:29','2024-05-16 02:32:38',0,0),(310,'REQ-2024-01-003',NULL,'2024-01-01',1,1,1,'Stocked on Loading screen',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(311,'REQ-2024-01-024',NULL,'2024-01-01',1,1,1,'Stucked on Loading screen',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(312,'REQ-2024-02-045',NULL,'2024-02-01',1,1,1,'Power supply malfunctioning',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(313,'REQ-2024-04-003',123,'2024-04-01',1,1,1,'Guba power cord',NULL,6,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(314,'REQ-2023-12-001',NULL,'2023-12-01',1,1,3,'Defective encoder strip',NULL,5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(315,'REQ-2023-12-002',NULL,'2023-12-01',1,1,3,'Defective maintenance box',NULL,5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(316,'REQ-2023-12-003',NULL,'2023-12-01',1,1,3,'Program (Software) problem',NULL,5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(317,'REQ-2024-01-013',59,'2024-01-01',1,3,13,'Expired licence MS Office 19, Installed MS Office 16',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(318,'REQ-2024-01-015',NULL,'2024-01-01',1,3,13,'NAS folder was accidentally deleted.',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(319,'REQ-2024-03-041',NULL,'2024-03-01',1,3,13,'Cant download/install anydesk',NULL,5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(320,'REQ-2024-03-042',59,'2024-03-01',2,6,27,'Regional Information Officers\' Conference',NULL,5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(321,'REQ-2024-02-023',22,'2024-02-01',2,5,23,'Request to print DTR',NULL,6,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(322,'REQ-2024-02-043',33,'2024-02-01',1,1,1,'SSD upgrade',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(323,'REQ-2024-03-010',33,'2024-03-01',1,1,1,'SSD upgrade',NULL,6,6,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(324,'REQ-2024-04-016',66,'2024-04-01',1,1,1,'PSU exploded','2024-04-04 09:00:00',5,5,NULL,1,1,1,2,111,108,111,'2024-04-04 09:00:00','2024-04-04 10:00:00','Replace PSU and desktop check-up.','Done and returned','2024-04-23 05:28:29','2024-05-16 03:18:21',0,0),(325,'REQ-2024-02-015',49,'2024-02-01',1,1,2,'Blue screen',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(326,'REQ-2023-03-001',23,'2024-03-01',1,1,3,'Printer head',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(327,'REQ-2024-01-026',58,'2024-01-01',1,1,3,'Printer end of life service',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(328,'REQ-2024-02-018',101,'2024-02-01',1,1,3,'Can\'t print',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(329,'REQ-2024-03-016',74,'2024-03-01',1,1,3,'Canon Pixma G4010 cartridge replacement',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(330,'REQ-2024-04-014',49,'2024-04-01',1,1,3,'Blinking red','2024-04-03 10:00:00',5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,'2024-04-03 10:00:00','2024-04-03 10:05:00','Remove the foreign object inside the feeder and test print','Done','2024-04-23 05:28:29','2024-05-16 03:05:58',0,0),(331,'REQ-2024-04-004',36,'2024-04-01',1,2,5,'No internet connection','2024-04-01 10:00:00',5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,'2024-04-01 10:00:00','2024-04-01 10:40:00','attached Wi-Fi adapter','Need further check on the LAN cables','2024-04-23 05:28:29','2024-05-16 02:08:28',0,0),(332,'REQ-2024-04-010',45,'2024-04-01',1,2,6,'No Internet Connection','2024-04-02 11:30:00',5,5,NULL,NULL,NULL,NULL,NULL,108,108,108,'2024-04-02 11:32:00','2024-04-02 11:35:00','LAN cable is not detected; detached and reattached the cable to make it detectable.','Done','2024-04-23 05:28:29','2024-05-16 02:47:20',0,0),(333,'REQ-2024-02-008',58,'2024-02-01',1,3,13,'error in connecting to web browser',NULL,5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(334,'REQ-2024-02-056',92,'2024-02-01',1,3,13,'Install BIR Alphalist 7.2',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(335,'REQ-2024-04-019',49,'2024-04-01',1,3,13,'Don\\\'t know how to open GDOC files','2024-04-05 13:00:00',5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,'2024-04-05 13:00:00','2024-04-05 13:05:00','trace the link and copy paste to the browser','Done','2024-04-23 05:28:29','2024-05-16 03:24:51',0,0),(336,'REQ-2024-04-038',92,'2024-04-01',2,4,15,'Creation of iHIRIS account and biometric enrollment of DTI Iloilo JO/COS','2024-04-15 13:00:00',5,5,NULL,2,1,1,2,109,108,109,'2024-04-15 14:05:00','2024-04-17 15:15:00','Done, encoded to iHRIS PDS data and enrolled their fingerprints into the biometric system','Other Staff to submit PDS for biometric enrollment','2024-04-23 05:28:29','2024-05-16 00:25:22',0,0),(337,'REQ-2024-02-010',57,'2024-02-01',2,4,17,'Deactivation of NC Accounts of NC Tapaz (Escamilla) and NC Maayon (De Juan) and Creation of iMMIS Account for Miss Escamilla and Mr. Losaria.',NULL,5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(338,'REQ-2024-02-030',31,'2024-02-01',2,4,18,'Cannot log-in to DIR Alphalist and Data Entry Validation 7.2',NULL,5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(339,'REQ-2024-02-031',92,'2024-02-01',2,4,18,'Cannot log-in to BIR Alphalist 7.2',NULL,5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(340,'REQ-2024-03-006',92,'2024-03-01',2,4,18,'DTI HR System - Username and Password Reset',NULL,5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(341,'REQ-2024-03-007',49,'2024-03-01',2,7,29,'Cant access old shared docs file',NULL,5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(342,'REQ-2024-03-015',68,'2024-03-01',2,7,29,'PC transfer and set-up',NULL,5,5,NULL,NULL,NULL,NULL,NULL,111,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(343,'REQ-2024-03-018',32,'2024-03-01',2,7,29,'Request for multiple zoom schedule',NULL,5,5,NULL,NULL,NULL,NULL,NULL,110,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(344,'REQ-2024-03-048',89,'2024-03-01',2,5,22,'MSMEs per Industry Cluster',NULL,5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 05:28:29','2024-04-25 03:21:31',NULL,NULL),(345,'REQ-2024-04-028',87,'2024-04-01',2,5,22,'Generate CARP Beneficiaries from iMMIS','2024-04-12 16:00:00',5,5,NULL,NULL,NULL,NULL,NULL,108,108,108,'2024-04-12 10:30:00','2024-04-12 14:30:00','Generated from iMMIS','Done','2024-04-23 05:28:29','2024-05-16 02:52:49',0,0),(346,'REQ-2024-04-042',101,'2024-04-23',1,1,1,'For check-up','2024-04-23 14:30:00',5,5,NULL,1,1,1,2,111,108,111,'2024-04-23 14:35:00','2024-04-23 15:15:00','Defective GPU\\r\\nCheck all components from RAM, GPU, PSU, CPU and wiring connection.','Done','2024-04-23 06:39:11','2024-04-25 05:08:14',1,1),(347,'REQ-2024-04-043',101,'2024-04-23',1,1,3,'For check-up','2024-04-23 14:30:00',5,5,NULL,1,2,4,2,111,NULL,111,'2024-04-23 15:30:00','2024-04-23 17:00:00','error code 9500.','Service Center','2024-04-23 06:40:32','2024-04-25 05:08:19',1,1),(348,'REQ-2024-04-044',101,'2024-04-23',1,1,4,'Monitor for check-up','2024-04-23 14:30:00',5,5,NULL,1,1,1,2,111,108,111,'2024-04-23 15:15:00','2024-04-23 15:20:00','No problem found','Done','2024-04-23 06:41:33','2024-04-25 05:08:22',1,1),(349,'REQ-2024-04-045',126,'2024-04-24',1,1,4,'UPS ','2024-04-24 08:30:00',5,5,NULL,1,NULL,NULL,NULL,111,109,111,'2024-04-24 08:30:00','2024-04-24 08:40:00','Deploy spare UPS','Done','2024-04-24 01:28:19','2024-04-25 05:08:27',0,0),(350,'REQ-2024-04-046',81,'2024-04-24',1,1,1,'Blue screen, can\\\'t load windows','2024-04-24 09:00:00',5,5,NULL,2,1,2,5,109,108,109,'2024-04-24 09:15:00','2024-04-24 11:05:00','Drive C was wiped out. Reinstalled OS and other essential applications','Desktop, documents, downloads must mapped to drive D. Always back-up files.','2024-04-24 04:04:15','2024-04-25 05:08:30',1,1),(351,'REQ-2024-04-047',81,'2024-04-24',1,1,3,'Printer driver not installed','2024-04-24 14:39:00',5,5,NULL,2,1,1,5,110,108,110,'2024-04-24 14:39:00','2024-04-24 14:45:00','Printer not connected to computer, installed printer driver and test print',NULL,'2024-04-24 06:49:49','2024-04-25 05:08:33',0,0),(352,'REQ-2024-04-048',23,'2024-04-25',1,2,5,'Internet Problem, no available IP address','2024-04-25 10:51:00',5,5,NULL,2,1,1,5,110,108,110,'2024-04-25 10:49:00','2024-04-25 10:53:00','Change connection type to static',NULL,'2024-04-25 02:54:03','2024-04-25 05:08:38',0,0),(353,'REQ-2024-04-049',127,'2024-04-25',1,2,5,'No Internet Connection','2024-04-25 11:03:00',5,5,NULL,2,1,1,2,110,108,110,'2024-04-25 11:04:00','2024-04-25 11:04:00','Loosed network adapter',NULL,'2024-04-25 03:04:46','2024-04-25 05:08:43',0,0),(355,'REQ-2024-04-050',128,'2024-04-25',1,2,5,'No internet','2024-04-25 08:30:00',5,5,NULL,2,1,1,5,111,108,111,'2024-04-25 08:30:00','2024-04-25 08:35:00','No IP\\r\\nMake the connection static','Done','2024-04-25 05:14:29','2024-05-10 05:41:02',0,0),(356,'REQ-2024-04-051',117,'2024-04-25',1,2,8,'NAS','2024-04-25 08:20:00',5,5,NULL,1,1,1,2,111,109,111,'2024-04-25 08:20:00','2024-04-25 08:25:00','Remap the network address','Done','2024-04-25 05:34:30','2024-04-25 05:34:47',0,0),(357,'REQ-2024-04-052',87,'2024-04-01',1,1,1,'Computer display bios on startup','2024-04-25 13:11:00',5,1,NULL,NULL,NULL,NULL,NULL,110,108,110,NULL,NULL,'Change the boot menu to run windows OS first to boot.',NULL,'2024-04-25 05:44:45','2024-04-25 05:44:45',0,0),(358,'REQ-2024-04-053',56,'2024-04-01',1,2,8,'Network Attached Storage cant be detected via network','2024-04-25 13:44:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-25 13:45:00','2024-04-25 14:15:00','Network credentials are not saved, logged in the user and select save credentials.',NULL,'2024-04-25 05:47:47','2024-05-16 03:16:21',0,0),(359,'REQ-2024-04-054',81,'2024-04-02',1,1,2,'Separate Each certificate from 1 PDF file','2024-04-25 13:48:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-25 14:25:00','2024-04-25 14:40:00','Splitting PDF file pages one by one using iLovePDF.',NULL,'2024-04-25 05:53:12','2024-05-16 03:17:30',0,0),(360,'REQ-2024-04-055',45,'2024-04-25',1,2,5,'Computer no internet connection','2024-04-25 13:53:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-25 14:30:00','2024-04-25 02:45:00','LAN cable is loosed, reconnect to identify network.',NULL,'2024-04-25 05:54:32','2024-05-16 03:18:21',0,0),(361,'REQ-2024-04-056',91,'2024-04-25',1,1,1,'Cloning of HDD to SSD','2024-04-25 13:54:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-25 15:00:00','2024-04-25 16:00:00','Cloned HDD to SSD using Mini Partition Tool',NULL,'2024-04-25 05:57:10','2024-05-16 03:19:18',0,0),(362,'REQ-2024-04-057',36,'2024-04-25',1,2,5,'No internet connection','2024-04-25 13:57:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-25 15:40:00','2024-04-25 15:50:00','Network is connected to Globe, change network to DTI R06 Wi-Fi',NULL,'2024-04-25 05:58:17','2024-05-16 03:20:04',0,0),(363,'REQ-2024-04-058',127,'2024-04-04',1,1,2,'Stuck display','2024-04-25 13:58:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-25 16:00:00','2024-04-25 16:15:00','laptop stucked on overlay, hit CTRL + ALT + DEL to exit overlay',NULL,'2024-04-25 06:02:08','2024-05-16 03:21:01',0,0),(364,'REQ-2024-04-059',127,'2024-04-25',1,2,5,'No internet Connection','2024-04-25 14:02:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-25 16:00:00','2024-04-25 16:15:00','Internet is inaccessible, installed switch to get Wi-Fi connection',NULL,'2024-04-25 06:06:56','2024-05-16 03:21:57',0,0),(365,'REQ-2024-04-060',56,'2024-04-25',1,1,3,'Cant perform Scan to PC using Epson Scan 2','2024-04-25 14:06:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-25 16:15:00','2024-04-25 16:25:00','Printer is not connected and Epson scan 2 driver is different model, reinstalled and configured.',NULL,'2024-04-25 06:09:17','2024-05-16 03:23:14',0,0),(366,'REQ-2024-04-061',113,'2024-04-11',2,6,28,'Zoom schedule conflict','2024-04-25 14:09:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-25 16:30:00','2024-04-25 16:30:00','Rescheduled conflict zoom schedule.',NULL,'2024-04-25 06:10:38','2024-05-16 03:28:01',0,0),(367,'REQ-2024-04-062',81,'2024-04-25',1,1,2,'Separate Each certificate from 1 PDF file','2024-04-25 14:10:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-25 02:15:00','2024-04-25 02:30:00','Splitting PDF file pages one by one using iLovePDF.',NULL,'2024-04-25 06:12:06','2024-05-16 03:29:06',0,0),(368,'REQ-2024-04-063',82,'2024-04-26',1,2,5,'No internet connection','2024-04-26 10:00:00',5,5,NULL,2,1,1,2,109,108,109,'2024-04-26 10:00:00','2024-04-26 10:05:00','IP was static at 10.20.12.x  Fortigate was upgraded last night and all 2nd floor connection had their IP changed to 10.20.9.x. Action taken: changed to dynamic IP.','Change the IP of 2nd floor PCs to 10.20.9.x','2024-04-26 02:05:04','2024-04-26 02:11:27',0,0),(369,'REQ-2024-04-064',54,'2024-04-26',1,1,2,'forgot user password','2024-04-26 14:28:00',5,5,NULL,2,1,1,2,110,108,110,'2024-04-26 14:20:00','2024-04-26 14:30:00','Removed password using another Administrator User',NULL,'2024-04-26 06:30:56','2024-04-26 06:31:16',1,1),(370,'REQ-2024-04-065',51,'2024-04-26',1,1,1,'No Microsoft Office Installed after windows update','2024-04-26 09:31:00',5,5,'NA',2,1,2,5,108,108,108,'2024-04-26 09:45:00','2024-04-26 10:00:00','Remote the device and installed licensed MS Office','Done','2024-04-26 07:12:20','2024-04-26 07:12:38',0,0),(371,'REQ-2024-04-066',25,'2024-04-26',1,2,5,'No internet','2024-04-26 14:00:00',5,5,NULL,1,1,NULL,NULL,111,109,111,'2024-04-26 14:00:00','2024-04-26 14:10:00','Reset the WIFI driver','Done','2024-04-26 07:39:06','2024-04-26 07:39:23',0,0),(372,'REQ-2024-04-067',130,'2024-04-29',1,2,5,'Can\\\\\\\'t connect to the internet','2024-04-29 09:15:00',5,5,NULL,2,1,1,NULL,109,108,109,'2024-04-29 09:15:00','2024-04-29 09:25:00','IP was static at 10.20.12.x  Fortigate was upgraded last 4/25 and all 2nd floor connection had their IP changed to 10.20.9.x. Action taken: changed to dynamic IP.','Change the IP of 2nd floor devices to 10.20.9.x','2024-04-29 05:42:11','2024-04-29 05:47:44',0,0),(373,'REQ-2024-04-068',131,'2024-04-29',2,4,17,'Creation of iMMIS account','2024-04-29 13:00:00',5,5,NULL,2,1,1,3,109,108,109,'2024-04-29 13:30:00','2024-04-29 13:45:00','Created iMMIS account for requestor. Log-in details were sent thru email.',NULL,'2024-04-29 05:55:52','2024-04-29 05:57:18',0,0),(374,'REQ-2024-04-069',113,'2024-04-26',1,1,4,'Laptop Charger (Universal) Damaged adapter','2024-04-26 09:00:00',5,5,NULL,1,1,1,2,111,109,111,'2024-04-29 15:00:00','2024-04-29 15:10:00','Removed the damaged parts/adapter.','Done','2024-04-29 07:32:36','2024-04-29 07:33:24',1,1),(375,'REQ-2024-04-070',130,'2024-04-30',1,1,3,'Printer cannot scan','2024-04-30 09:30:00',5,5,NULL,2,1,1,5,109,108,109,'2024-04-30 09:30:00','2024-04-30 09:45:00','Reinstalled printer\\\'s scan driver and installed epson scan 2 tool.',NULL,'2024-04-30 01:46:46','2024-04-30 01:48:29',0,0),(376,'REQ-2024-04-071',45,'2024-04-30',1,1,1,'browser\\\\\\\\\\\\\\\'s page automatic refresh','2024-04-30 09:30:00',5,5,'NA',2,1,1,2,108,108,108,'2024-04-30 09:35:00','2024-04-30 09:40:00','This is causing an automatic page refresh in the Edge browser.  Action Taken: clear browser history','Done','2024-04-30 01:58:52','2024-04-30 02:00:02',0,0),(377,'REQ-2024-04-072',132,'2024-04-30',1,1,4,'Monitor has no power','2024-04-30 10:22:00',5,5,'NA',1,1,1,2,108,108,108,'2024-04-30 10:22:00','2024-04-30 10:25:00','Unplug the monitor power cord and then plug it back in','Done','2024-04-30 02:26:53','2024-04-30 02:27:22',0,0),(378,'REQ-2024-04-073',133,'2024-04-30',1,3,13,'Installation of PDF editor software','2024-04-30 13:10:00',5,5,NULL,2,1,1,5,109,108,109,'2024-04-30 13:10:00','2024-04-30 13:32:00','Installed Nitro 10 Pro in 3 PCs of CPD (Sir RL, Miss Mia, and Miss Janice)','Installed software was version 10. If the office has extra budget, the could opt to buy the latest version of the software (version 14)','2024-04-30 05:33:05','2024-04-30 05:35:58',0,0),(379,'REQ-2024-04-079',127,'2024-04-16',1,3,12,'Request of DTR for April 1-15','2024-05-02 08:29:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-16 08:35:00','2024-04-16 08:40:00','Generated DTR for Jayona, Alteros, and Canales for the month of April',NULL,'2024-05-02 00:31:13','2024-05-16 03:47:55',0,0),(380,'REQ-2024-04-080',127,'2024-04-02',1,1,3,'printer problem, not turning on','2024-05-02 08:31:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-29 09:45:00','2024-04-29 10:00:00','Power plug is not inserted properly',NULL,'2024-05-02 00:34:37','2024-05-16 05:24:51',0,0),(381,'REQ-2024-04-081',113,'2024-04-02',1,1,2,'Upgrade Laptop to SSD','2024-05-02 08:34:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-29 08:35:00','2024-04-29 10:00:00','migrate HDD to SSD',NULL,'2024-05-02 00:36:59','2024-05-16 05:23:49',0,0),(382,'REQ-2024-04-082',48,'2024-04-02',1,2,5,'Wi-Fi connected but no internet connection','2024-04-29 08:37:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-29 08:40:00','2024-04-29 08:45:00','Connected in different Wi-Fi SSID',NULL,'2024-05-02 00:38:17','2024-05-16 05:21:45',0,0),(383,'REQ-2024-04-083',110,'2024-04-02',2,7,29,'Encoding and Sorting of CSF','2024-05-02 08:38:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,108,NULL,NULL,'Encoded and Arranged CSF by month for the 1st quarter of the year.',NULL,'2024-05-02 00:42:19','2024-05-02 03:18:02',0,0),(384,'REQ-2024-04-074',127,'2024-04-25',1,2,5,'No internet connection','2024-05-02 08:42:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-26 20:30:00','2024-04-26 08:35:00','network adapter not inserted properly ',NULL,'2024-05-02 01:27:45','2024-05-16 03:44:04',0,0),(385,'REQ-2024-04-075',23,'2024-04-25',1,2,5,'No available IP Address','2024-05-02 09:30:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-25 09:30:00','2024-04-25 09:40:00','Changed connection type from dynamic to static',NULL,'2024-05-02 01:31:46','2024-05-16 03:45:06',0,0),(386,'REQ-2024-04-076',130,'2024-04-25',1,2,5,'Connected, but page cannot be reach','2024-05-02 09:32:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-25 09:40:00','2024-04-25 09:40:00','changed Wi-Fi connection',NULL,'2024-05-02 01:52:18','2024-05-16 03:45:22',0,0),(387,'REQ-2024-04-077',65,'2024-04-25',1,2,5,'BNRS no internet connection','2024-05-02 09:52:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-25 09:55:00','2024-04-25 10:03:00','Restart network driver and connect to Wi-Fi',NULL,'2024-05-02 02:27:10','2024-05-16 03:53:12',0,0),(388,'REQ-2024-04-078',113,'2024-04-29',1,3,12,'Request of DTR for April 16-30','2024-05-02 10:28:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-29 10:35:00','2024-04-29 10:40:00','Generated DTR for Jayona, Alteros, and Canales for the month of April',NULL,'2024-05-02 02:30:09','2024-05-16 03:46:56',0,0),(389,'REQ-2024-04-084',110,'2024-04-02',2,7,29,'Burn new Lupang Hinirang CD','2024-05-02 10:30:00',5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-02 02:31:33','2024-05-02 03:18:02',0,0),(390,'REQ-2024-04-085',54,'2024-04-02',2,7,29,'Edit formats and formulas of excel report','2024-04-29 10:30:00',5,5,NULL,NULL,NULL,NULL,NULL,110,109,110,'2024-04-29 10:30:00','2024-04-29 12:00:00','Edit formats and formulas of excel report',NULL,'2024-05-02 02:34:05','2024-05-16 05:12:21',0,0),(391,'REQ-2024-04-086',113,'2024-04-02',1,1,2,'Installation of MS Office 2016','2024-05-02 10:41:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-29 10:20:00','2024-05-29 11:50:00','Installed MS Office 2016',NULL,'2024-05-02 02:49:23','2024-05-16 05:18:37',0,0),(392,'REQ-2024-04-087',91,'2024-04-02',1,2,5,'no internet connection','2024-04-29 10:52:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-29 08:30:00','2024-04-29 08:45:00','Changed connection type from static to dynamic',NULL,'2024-05-02 02:53:06','2024-05-16 05:17:14',0,0),(393,'REQ-2024-04-088',116,'2024-04-02',1,1,1,'Burned power chord plug','2024-05-02 11:01:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,108,'2024-04-29 11:00:00','2024-04-29 13:05:00','Replace Burned power chord plug',NULL,'2024-05-02 03:02:38','2024-05-16 05:15:11',0,0),(394,'REQ-2024-04-089',20,'2024-04-02',2,6,27,'Set up briefing room for event CMCI meeting','2024-05-02 11:02:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-29 08:00:00','2024-04-29 09:00:00','Setup TV and laptop for CMCI Meeting',NULL,'2024-05-02 03:03:52','2024-05-16 03:57:59',0,0),(395,'REQ-2024-04-090',113,'2024-04-02',1,3,12,'Request of DTR for APRIL 16-30','2024-05-02 11:03:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-30 09:53:00','2024-04-30 09:53:00','Generated DTR for the Month of April',NULL,'2024-05-02 03:04:51','2024-05-16 03:54:51',0,0),(396,'REQ-2024-04-091',98,'2024-04-02',1,1,2,'Checkup for laptop DTI Capiz','2024-04-30 11:05:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-30 11:10:00','2024-04-30 16:00:00','BOD Problem, changed boot option from UEFI to Legacy',NULL,'2024-05-02 03:07:33','2024-05-16 05:11:50',0,0),(397,'REQ-2024-04-092',113,'2024-04-02',1,1,1,'Stucked screen display','2024-05-02 11:07:00',5,5,NULL,NULL,NULL,NULL,NULL,110,108,110,'2024-04-30 13:05:00','2024-04-30 13:25:00','Restart PC and fix Internet Problem',NULL,'2024-05-02 03:09:49','2024-05-16 05:13:29',0,0),(398,'REQ-2024-05-001',128,'2024-05-01',2,4,18,'Request for DTI6 portal login credentials','2024-05-02 11:43:00',5,5,'NA',2,1,1,5,108,108,108,'2024-05-02 11:42:00','2024-05-02 11:45:00','Created dti6 login credentials to view payslip. ','Link: http://r6itbpm.site/dti/login.php\\r\\n\\r\\nusername: jazer\\r\\npassword: miranda\\r\\n\\r\\nPlease remember to update your password after initial login.','2024-05-02 03:46:46','2024-05-02 03:54:04',0,0),(399,'REQ-2024-05-002',57,'2024-05-02',2,4,18,'account details for DTi6 portal to view payslip','2024-05-02 11:54:00',5,5,'NA',1,1,1,5,108,108,108,'2024-05-02 11:55:00','2024-05-02 11:58:00','account created and sent to requester','Done','2024-05-02 04:03:18','2024-05-02 04:06:17',0,0),(400,'REQ-2024-04-093',79,'2024-04-29',2,3,13,'Zoom meeting-HIMS Meeting','2024-04-29 01:00:00',5,5,NULL,NULL,NULL,NULL,5,111,109,111,'2024-04-29 13:00:00','2024-04-29 13:05:00','Generate Zoom link','Done','2024-05-02 08:05:02','2024-05-10 05:42:40',0,0),(401,'REQ-2024-05-003',129,'2024-05-02',1,3,13,'Zoom request','2024-05-02 09:00:00',6,1,NULL,NULL,NULL,NULL,NULL,111,109,111,NULL,NULL,'Generate zoom link','Done','2024-05-02 08:28:35','2024-05-02 08:28:44',0,0),(402,'REQ-2024-04-094',129,'2024-04-29',1,3,13,'Zoom request','2024-04-29 09:00:00',5,5,NULL,NULL,NULL,NULL,NULL,111,109,111,NULL,NULL,'Generate zoom link','Done','2024-05-02 08:30:07','2024-05-02 08:30:29',0,0),(403,'REQ-2024-04-095',40,'2024-04-30',2,6,27,'WHIC','2024-04-30 08:00:00',5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,'2024-04-30 08:00:00','2024-04-30 15:00:00','Tech support','Done','2024-05-02 08:32:44','2024-05-02 08:32:57',0,0),(404,'REQ-2024-05-004',23,'2024-05-06',2,6,28,'Zoom link for 1st Quarter Management Committee Meeting on 14-15 May 2024','2024-05-06 11:24:00',5,5,NULL,2,1,NULL,5,109,108,109,'2024-05-06 11:20:00','2024-05-06 11:26:00','Done, zoom link sent to requestor',NULL,'2024-05-06 03:26:03','2024-05-06 03:27:08',0,0),(405,'REQ-2024-05-005',72,'2024-05-06',2,4,15,'Cant log-in. Validation error','2024-05-06 10:51:00',5,5,NULL,2,NULL,NULL,NULL,109,108,109,'2024-05-06 11:10:00','2024-05-06 11:15:00','Reset password of requestor','Done','2024-05-06 03:28:26','2024-05-06 03:29:32',0,0),(406,'REQ-2024-05-006',130,'2024-05-06',1,2,5,'Can\\\\\\\'t access portal.sbcorp.ph and openproject.sbcorp.ph','2024-05-06 08:45:00',5,5,NULL,3,1,2,5,109,108,109,'2024-05-06 08:50:00','2024-05-06 09:30:00','Access was blocked due to a policy in the fortigate. Created a policy to exempt both portal.sbcorp.ph and openproject.sbcorp.ph in the SSL certification.','Done','2024-05-06 03:30:28','2024-05-06 03:33:14',0,0),(407,'REQ-2024-05-007',135,'2024-05-03',2,4,15,'Cant access iHIRIS. Need to print DTR','2024-05-03 10:30:00',5,5,NULL,2,1,3,2,109,108,109,'2024-05-03 10:30:00','2024-05-03 11:00:00','Account can only log-in thru the requestor\\\'s phone. Tried resetting the password but still not able to log-in thru a PC. Printed a copy of the DTR and sent it to the requestor.',NULL,'2024-05-06 03:37:18','2024-05-06 03:40:23',0,0),(408,'REQ-2024-05-008',113,'2024-05-02',1,1,3,'NC Maasin Printer (Epson L3210) - Printer scanner and photocopier error, and  paper feed issue.','2024-05-02 09:00:00',5,5,'XAGM111296',1,1,1,2,111,109,111,'2024-05-06 10:00:00','2024-05-06 12:00:00','Defective printer roller.\\\\r\\\\nCheck the interior and exterior of the printer and the gears and roller.','Purchase/replace the printer roller.','2024-05-06 08:07:28','2024-05-06 08:07:50',1,0),(409,'REQ-2024-04-096',115,'2024-04-30',1,1,3,'Printer check-up','2024-04-30 16:00:00',5,5,'CN6C93Q436',1,1,2,5,111,109,111,'2024-05-06 13:00:00','2024-05-06 15:00:00','Defective Encoder Strip','Need replacement of Encoder Strip','2024-05-06 08:12:43','2024-05-06 08:14:21',1,0),(410,'REQ-2024-05-009',101,'2024-05-07',1,3,13,'Create a QGIS Map with Iloilo cities and municipalities only.','2024-05-07 09:00:00',5,5,NULL,2,1,2,NULL,109,109,109,'2024-05-07 09:00:00','2024-05-07 09:15:00','Assisted the requestor in editing the existing Philippine QGIS Map.',NULL,'2024-05-07 01:27:38','2024-05-07 01:31:39',0,0),(411,'REQ-2024-05-010',113,'2024-05-02',1,1,1,'Need to replace Windows because some files cannot open, and when you open google app, google help automatically show up, and you cannot proceed anymor','2024-05-02 09:00:00',5,5,NULL,1,1,1,2,111,109,111,'2024-05-06 10:00:00','2024-05-06 11:00:00','Upon checking the unit, the Windows is activated, no errors when opening any google apps and it function normally.','Please check your keyboard set-up. It might be malfunctioning or pressing F1 unintentionally. ','2024-05-07 01:54:19','2024-05-07 01:57:31',0,1),(412,'REQ-2024-05-011',98,'2024-05-07',1,2,5,'No internet connection from other network aside from PO\\\\\\\'s AP','2024-05-07 11:20:00',5,5,NULL,2,1,1,5,109,109,109,'2024-05-07 11:20:00','2024-05-07 12:05:00','Static IP address. Changed IP address to dynamic',NULL,'2024-05-07 04:06:27','2024-05-07 04:08:30',0,0),(413,'REQ-2024-05-012',115,'2024-05-07',1,1,2,'No power','2024-05-07 08:00:00',5,5,NULL,1,1,1,5,111,109,111,'2024-05-07 08:30:00','2024-05-07 09:00:00','Defective charger','Replace/purchase new charger','2024-05-07 08:41:07','2024-05-07 08:41:31',1,0),(414,'REQ-2024-05-013',54,'2024-05-08',2,4,15,'Request for a new password','2024-05-08 08:51:00',5,5,'NA',1,1,1,5,108,108,108,'2024-05-08 08:51:00','2024-05-08 08:57:00','Completed and generated a new password through the IHRIS ','Done','2024-05-08 01:20:45','2024-05-08 01:21:28',0,0),(415,'REQ-2024-05-014',25,'2024-05-07',1,2,5,'Cant upload files to email','2024-05-07 15:45:00',5,5,NULL,2,1,2,2,109,109,109,'2024-05-07 15:45:00','2024-05-07 04:20:00','Download speed is between 50 to 70 mbps with upload speed is on between 0.3 to 1mbps. Checked port using different cable and laptop but the upload speed was okay. Rechecked again using the same cable but with a different laptop and the upload speed goes below 1 mbps. Replaced the LAN cable.',NULL,'2024-05-08 01:24:11','2024-05-08 01:29:06',0,0),(416,'REQ-2024-05-015',128,'2024-05-08',1,1,1,'Lag','2024-05-08 09:00:00',5,5,NULL,1,1,1,5,111,109,111,'2024-05-08 09:00:00','2024-05-08 11:00:00','Close the SSD to the new SDD','Done','2024-05-08 08:52:59','2024-05-08 08:53:57',1,1),(417,'REQ-2024-05-016',50,'2024-05-09',2,4,18,'No login credentials for DTI6 portal for payslip viewing.','2024-05-09 13:04:00',5,5,'NA',1,1,1,5,108,108,108,'2024-05-09 13:10:00','2024-05-09 13:16:00','Generated password ','Done','2024-05-09 05:20:28','2024-05-09 05:20:45',0,0),(418,'REQ-2024-05-017',115,'2024-05-08',1,1,3,'Waste pad counter reset','2024-05-09 10:30:00',5,5,NULL,2,1,2,5,109,108,109,'2024-05-09 11:22:00','2024-05-09 13:28:00','Remote the laptop connected to the printer. Temporarily uninstalled bit defender in order to successfully install the counter resetter. Run the resetter and installed bit defender again.','Done','2024-05-09 05:32:08','2024-05-09 05:35:26',0,0),(419,'REQ-2024-05-018',89,'2024-05-08',2,5,23,'Merge two excel files and generate the difference between the two.','2024-05-09 11:45:00',5,5,NULL,2,1,2,5,109,108,109,'2024-05-09 09:12:00','2024-05-09 13:20:00','Merged two excel files and transferred it to the template prepared by Dan','Done','2024-05-09 05:38:33','2024-05-09 05:40:39',0,0),(420,'REQ-2024-05-019',81,'2024-05-09',2,6,28,'Zoom link for CPD Planning Session on May 10 and 13','2024-05-09 13:30:00',5,5,NULL,2,1,1,5,109,108,109,'2024-05-09 13:17:00','2024-05-09 13:32:00','Scheduled activity in ISDS and zoom','Done','2024-05-09 05:41:26','2024-05-09 05:43:48',0,0),(421,'REQ-2024-05-020',51,'2024-05-09',1,3,13,'No MS office','2024-05-09 13:30:00',5,5,NULL,NULL,NULL,1,5,111,108,111,'2024-05-09 13:30:00','2024-05-09 13:15:00','via AnyDesk - install MS office','Done','2024-05-09 06:25:01','2024-05-09 06:25:19',0,0),(422,'REQ-2024-05-021',104,'2024-05-09',1,1,2,'No display and broken hinge holder','2024-05-09 09:00:00',5,5,'NXVPXSP0011462D9547600',1,1,2,1,111,108,111,'2024-05-09 09:00:00','2024-05-09 15:45:00','Replace the exterior parts including monitor and body frame with spare parts in the MIS','Done','2024-05-09 06:54:20','2024-05-09 07:58:51',1,0),(423,'REQ-2024-05-022',126,'2024-05-09',1,1,1,'PC of RD Rachel is lagging','2024-05-09 08:00:00',5,5,NULL,2,1,1,5,111,108,111,'2024-05-09 09:00:00','2024-05-09 10:00:00','Add additional 8 GB RAM and do a stress test.','Done','2024-05-09 06:56:18','2024-05-10 06:15:56',1,0),(424,'REQ-2024-05-023',79,'2024-05-06',1,3,13,'Zoom Request - Meeting w/ Medstar','2024-05-06 15:20:00',5,5,NULL,1,NULL,NULL,NULL,111,108,111,'2024-05-06 15:20:00','2024-05-06 15:25:00','Generate Zoom link','Done','2024-05-10 06:11:52','2024-05-10 06:15:18',0,0),(425,'REQ-2024-05-024',135,'2024-05-13',2,4,15,'Request DTR','2024-05-13 09:26:00',5,5,NULL,NULL,NULL,NULL,NULL,109,108,109,'2024-05-16 09:50:00','2024-05-16 10:11:00','Forwarded to requestor copy of her DTR',NULL,'2024-05-13 03:05:15','2024-05-16 02:15:11',0,0),(426,'REQ-2024-05-025',129,'2024-05-14',1,1,1,'Lag','2024-05-14 09:00:00',5,5,NULL,NULL,1,1,5,111,108,111,'2024-05-14 09:30:00','2024-05-14 15:00:00','Back up the files and clone the HDD to the new SSD','Done','2024-05-15 00:25:25','2024-05-15 00:26:02',0,0),(427,'REQ-2024-05-026',79,'2024-05-13',2,6,28,'RIIC Meeting ','2024-05-13 08:26:00',5,5,NULL,NULL,NULL,NULL,NULL,111,108,111,'2024-05-13 09:30:00','2024-05-13 11:45:00','Tech support ',NULL,'2024-05-15 00:27:38','2024-05-15 00:27:55',0,0),(428,'REQ-2024-05-027',113,'2024-05-15',1,2,5,'no internet','2024-05-15 13:05:00',5,5,NULL,NULL,1,1,2,111,109,111,'2024-05-15 13:05:00','2024-05-15 13:15:00','reset the internet driver','done','2024-05-15 05:18:48','2024-05-15 05:24:20',0,0),(429,'REQ-2024-05-028',129,'2024-05-15',1,1,1,'Lag','2024-05-15 08:30:00',5,5,NULL,1,1,1,5,111,109,111,'2024-05-15 20:30:00','2024-05-15 10:00:00','Clone the HDD to the new SSD and add the extra HDD','done','2024-05-15 08:59:58','2024-05-15 09:00:29',1,1),(430,'REQ-2024-05-029',129,'2024-05-15',1,2,5,'Slow internet connection','2024-05-15 14:50:00',5,5,NULL,1,1,NULL,5,111,108,111,'2024-05-15 14:50:00','2024-05-15 16:00:00','Overheating of backbone due to no ventilation.\\\\r\\\\nRest the backbone to cooldown and restart. ','Done','2024-05-15 09:03:15','2024-05-15 09:03:29',0,0);
/*!40000 ALTER TABLE `helpdesks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helpdesks_statuses`
--

DROP TABLE IF EXISTS `helpdesks_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `helpdesks_statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(150) DEFAULT NULL,
  `status_desc` text,
  `color` varchar(45) DEFAULT NULL,
  `color_hex` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpdesks_statuses`
--

LOCK TABLES `helpdesks_statuses` WRITE;
/*!40000 ALTER TABLE `helpdesks_statuses` DISABLE KEYS */;
INSERT INTO `helpdesks_statuses` VALUES (1,'Open',NULL,'warning','#ffc107'),(2,'Pending',NULL,'primary','#0d6efd'),(3,'Pre-repair',NULL,'secondary','#adb5bd'),(4,'Unserviceable',NULL,'secondary','#adb5bd'),(5,'Completed',NULL,'success','#198754'),(6,'Cancelled',NULL,'danger','#dc3545');
/*!40000 ALTER TABLE `helpdesks_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hosts`
--

DROP TABLE IF EXISTS `hosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hosts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `host_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hosts`
--

LOCK TABLES `hosts` WRITE;
/*!40000 ALTER TABLE `hosts` DISABLE KEYS */;
INSERT INTO `hosts` VALUES (1,'Judith Guillo'),(2,'Ermelinda Pollentes');
/*!40000 ALTER TABLE `hosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iar`
--

DROP TABLE IF EXISTS `iar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `iar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int DEFAULT NULL,
  `po_id` int DEFAULT NULL,
  `division_id` int DEFAULT NULL,
  `iar_number` varchar(150) DEFAULT NULL COMMENT 'IAR-2024-01-001',
  `iar_date` date DEFAULT NULL,
  `invoice_number` varchar(150) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `date_inspected` date DEFAULT NULL,
  `inspected_by_id` int DEFAULT NULL,
  `date_accepted` date DEFAULT NULL,
  `accepted_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_iar_suppliers1_idx` (`supplier_id`),
  KEY `fk_iar_divisions1_idx` (`division_id`),
  KEY `fk_iar_users1_idx` (`inspected_by_id`),
  KEY `fk_iar_users2_idx` (`accepted_by`),
  KEY `fk_iar_procurements1_idx` (`po_id`),
  CONSTRAINT `fk_iar_div` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_iar_pro` FOREIGN KEY (`po_id`) REFERENCES `po` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_iar_sup` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_iar_use1` FOREIGN KEY (`inspected_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_iar_use2` FOREIGN KEY (`accepted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iar`
--

LOCK TABLES `iar` WRITE;
/*!40000 ALTER TABLE `iar` DISABLE KEYS */;
/*!40000 ALTER TABLE `iar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iar_items`
--

DROP TABLE IF EXISTS `iar_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `iar_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iar_id` int DEFAULT NULL,
  `equipment_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_par_items_equipment1_idx` (`equipment_id`),
  KEY `fk_procurement_items_copy1_iar1_idx` (`iar_id`),
  CONSTRAINT `fk_iai_equ` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_iai_iar` FOREIGN KEY (`iar_id`) REFERENCES `iar` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iar_items`
--

LOCK TABLES `iar_items` WRITE;
/*!40000 ALTER TABLE `iar_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `iar_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mediums`
--

DROP TABLE IF EXISTS `mediums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mediums` (
  `id` int NOT NULL AUTO_INCREMENT,
  `medium` varchar(150) DEFAULT NULL,
  `medium_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mediums`
--

LOCK TABLES `mediums` WRITE;
/*!40000 ALTER TABLE `mediums` DISABLE KEYS */;
INSERT INTO `mediums` VALUES (1,'System',NULL),(2,'Intercom',NULL),(3,'Email',NULL),(4,'Memo',NULL),(5,'Others',NULL);
/*!40000 ALTER TABLE `mediums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meetings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `meeting_number` varchar(150) DEFAULT NULL COMMENT 'MTG-2024-01-001',
  `requested_by` int DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `date_scheduled` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `host_id` int DEFAULT NULL,
  `status_id` int DEFAULT NULL,
  `meetingid` varchar(150) DEFAULT NULL,
  `passcode` varchar(150) DEFAULT NULL,
  `join_link` text,
  `start_link` text,
  `remarks` text,
  `date_requested` date DEFAULT NULL,
  `generated_by` int DEFAULT NULL,
  `approved_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_meetings_users1_idx` (`requested_by`),
  KEY `fk_meetings_hosts1_idx` (`host_id`),
  KEY `fk_meetings_users2_idx` (`generated_by`),
  KEY `fk_meetings_users3_idx` (`approved_by`),
  KEY `fk_meetings_meetings_statuses1_idx` (`status_id`),
  CONSTRAINT `fk_mtg_hos` FOREIGN KEY (`host_id`) REFERENCES `hosts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_mtg_mts` FOREIGN KEY (`status_id`) REFERENCES `meetings_statuses` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_mtg_use1` FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_mtg_use2` FOREIGN KEY (`generated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_mtg_use3` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
INSERT INTO `meetings` VALUES (21,'MTG-2024-02-001',110,'Sample meeting','2024-02-20','02:40:00','08:40:00',1,2,NULL,NULL,NULL,NULL,'DTIR06 ADMIN is inviting you to a scheduled Zoom meeting.\\r\\n\\r\\nTopic: HRMPSB\\r\\nTime: Feb 22, 2024 08:30 AM Singapore\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/83988715455?pwd=HWEkN1sPUylli6yovqB5K0Ur4k3zJ0.1\\r\\n\\r\\nMeeting ID: 839 8871 5455\\r\\nPasscode: 588069','2024-02-20',NULL,NULL,'2024-02-20 01:41:35','2024-02-20 07:40:17'),(22,'MTG-2024-03-001',123,'asdasda','2024-03-11','08:32:00','08:32:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-11',NULL,NULL,'2024-03-11 07:32:08','2024-03-11 07:32:08'),(23,'MTG-2024-03-002',123,'asdas','2024-03-11','08:46:00','08:46:00',NULL,1,NULL,NULL,NULL,NULL,NULL,'2024-03-11',NULL,NULL,'2024-03-11 07:46:29','2024-03-11 07:46:29'),(24,'MTG-2024-04-001',89,'Social Media Marketing (CANCELLED)','2024-04-29','13:00:00','17:00:00',1,4,NULL,NULL,NULL,NULL,'Topic: Social Media Marketing\\r\\nTime: Apr 29, 2024 01:00 PM Singapore\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/83051753316?pwd=VPiLecaUEVwSOMP7jIsEwetU5tuiCT.1\\r\\n\\r\\nMeeting ID: 830 5175 3316\\r\\nPasscode: 212171\\r\\n','2024-04-22',NULL,NULL,'2024-04-22 02:43:22','2024-04-26 04:05:05'),(25,'MTG-2024-04-002',91,'Final Interview - Capiz JOCOS','2024-04-23','08:27:00','08:27:00',2,2,NULL,NULL,NULL,NULL,'DTI VI is inviting you to a scheduled Zoom meeting.\\r\\n\\r\\nTopic: Final Interview - Capiz JOCOS\\r\\nTime: Apr 23, 2024 09:30 AM Singapore\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us05web.zoom.us/j/82540490045?pwd=blBCSZGoHa2c88ScaahCf9G4pOfabk.1\\r\\n\\r\\nMeeting ID: 825 4049 0045\\r\\nPasscode: N8JTsq','2024-04-23',110,NULL,'2024-04-23 00:28:13','2024-04-23 00:28:13'),(26,'MTG-2024-04-003',54,'SSF Meeting','2024-04-26','09:00:00','11:00:00',1,2,NULL,NULL,NULL,NULL,'DTI VI is inviting you to a scheduled Zoom meeting.\\r\\n\\r\\nTopic: SSF Meeting\\r\\nTime: Apr 26, 2024 09:00 AM Singapore\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/87024051610?pwd=SeWAaoT0MqUmlFaFO5nII6dkOgooCz.1\\r\\n\\r\\nMeeting ID: 870 2405 1610\\r\\nPasscode: 081412','2024-04-25',110,NULL,'2024-04-25 01:33:45','2024-04-25 01:33:45'),(27,'MTG-2024-04-004',129,'RTWG Evaluation Meeting re: SSF','2024-05-08','08:00:00','17:00:00',1,2,NULL,NULL,NULL,NULL,'Topic: RTWG Evaluation Meeting re: SSF\\r\\nTime: May 8, 2024 08:00 AM Singapore\\r\\n        Every day, until May 9, 2024, 2 occurrence(s)\\r\\n        May 8, 2024 08:00 AM\\r\\n        May 9, 2024 08:00 AM\\r\\nPlease download and import the following iCalendar (.ics) files to your calendar system.\\r\\nDaily: https://us06web.zoom.us/meeting/tZAvfuGgrzgjG9y83HYyXS1hVgi-2Gpy9Ctx/ics?icsToken=98tyKuGsrDIiEtWWuRiPRpwIAIr4WfzzmHZEjfpExEzNOjlrUVL-AOVLf-BYAMGJ\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/84298813918?pwd=tbL7EYjD0RqWb5sieKMhzlhNYe9Em2.1\\r\\n\\r\\nMeeting ID: 842 9881 3918\\r\\nPasscode: 434176','2024-04-29',111,NULL,'2024-04-29 06:14:02','2024-04-29 06:14:02'),(28,'MTG-2024-04-005',32,'KMME-MME Online - Government Services Forum','2024-05-07','09:00:00','12:30:00',1,2,NULL,NULL,NULL,NULL,'Topic: KMME-MME Online - Government Services Forum\\r\\nTime: May 7, 2024 09:00 AM Singapore\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/84233678644?pwd=eyJ8cBgMhOtq5M2bnFIpq7bD21arxA.1\\r\\n\\r\\nMeeting ID: 842 3367 8644\\r\\nPasscode: 272597','2024-04-29',109,NULL,'2024-04-29 06:35:22','2024-04-29 06:35:22'),(29,'MTG-2024-05-001',54,'Provincial Bamboo Council Meeting','2024-05-06','08:30:00','00:00:00',NULL,2,NULL,NULL,NULL,NULL,'DTI VI is inviting you to a scheduled Zoom meeting.\\r\\n\\r\\nTopic: Provincial Bamboo Council Meeting\\r\\nTime: May 6, 2024 08:45 AM Perth\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us02web.zoom.us/j/81394293482?pwd=SWdvUlBlT0hVUFVja2I3cytndk8rdz09\\r\\n\\r\\nMeeting ID: 813 9429 3482\\r\\nPasscode: 706399\\r\\n','2024-05-02',110,NULL,'2024-05-02 03:39:37','2024-05-02 03:39:37'),(30,'MTG-2024-05-002',80,'Briefing Session of PMSMED-Capiz for the 2024 Pres.  Awards for the outstanding MSMES and Outstanding Development Partners','2024-05-06','14:00:00','17:00:00',1,2,NULL,NULL,NULL,NULL,'DTI VI is inviting you to a scheduled Zoom meeting.\\r\\n\\r\\nTopic: Briefing Session of PMSMED-Capiz for the 2024 Pres.  Awards for the outstanding MSMES and Outstanding Development Partners\\r\\nTime: May 6, 2024 02:00 PM Singapore\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/87838473619?pwd=geoCIaQOMYqbPyUocCLawgcrrBe4V0.1\\r\\n\\r\\nMeeting ID: 878 3847 3619\\r\\nPasscode: 376406','2024-05-03',NULL,NULL,'2024-05-03 08:40:32','2024-05-03 08:48:53'),(31,'MTG-2024-05-003',91,'Oath Taking','2024-05-06','09:40:00','09:40:00',NULL,2,NULL,NULL,NULL,NULL,'DTI VI is inviting you to a scheduled Zoom meeting.\\r\\n\\r\\nTopic: Oath Taking of Newly Hired Employees\\r\\nTime: May 6, 2024 03:00 PM\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us02web.zoom.us/j/84007488232?pwd=QXV5ZEREZWhSS0wxbENpL01EbndIQT09\\r\\n\\r\\nMeeting ID: 840 0748 8232\\r\\nPasscode: 754827','2024-05-06',NULL,NULL,'2024-05-06 01:46:08','2024-05-06 02:44:46'),(32,'MTG-2024-05-004',23,'1st Quarter Management Committee Meeting','2024-05-14','08:00:00','19:00:00',1,2,NULL,NULL,NULL,NULL,'DTI VI is inviting you to a scheduled Zoom meeting.\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/83075275302?pwd=bca6aWEudEr8aAj54aY5595rUCyMtB.1\\r\\n\\r\\nMeeting ID: 830 7527 5302\\r\\nPasscode: 194968','2024-05-06',109,NULL,'2024-05-06 03:23:47','2024-05-06 03:23:47'),(33,'MTG-2024-05-005',23,'1st Quarter Management Committee Meeting','2024-05-15','08:00:00','19:00:00',1,2,NULL,NULL,NULL,NULL,'DTI VI is inviting you to a scheduled Zoom meeting.\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/83075275302?pwd=bca6aWEudEr8aAj54aY5595rUCyMtB.1\\r\\n\\r\\nMeeting ID: 830 7527 5302\\r\\nPasscode: 194968','2024-05-15',109,NULL,'2024-05-06 03:24:34','2024-05-06 03:24:34'),(34,'MTG-2024-05-006',79,'Meeting w/ Medstar','2024-05-07','13:00:00','14:00:00',1,2,NULL,NULL,NULL,NULL,'Topic: Meeting w/ Medstar\\r\\nTime: May 7, 2024 01:00 PM Singapore\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/81040913632?pwd=xT6Sfa2KVrvMMRROuQd8WweI7BaTaB.1\\r\\n\\r\\nMeeting ID: 810 4091 3632\\r\\nPasscode: 512564\\r\\n','2024-05-06',NULL,NULL,'2024-05-06 07:43:05','2024-05-06 07:43:36'),(35,'MTG-2024-05-007',92,'Professionalism in the Workplace and Dashboard Re-Orientation','2024-05-17','08:30:00','16:00:00',1,2,NULL,NULL,NULL,NULL,'Topic: Professionalism in the Workplace and Dashboard Re-Orientation\\r\\nTime: May 17, 2024 08:30 AM Singapore\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/81470785774?pwd=sbuuhBF3J0gfOkH8pSWBV68E4gszl5.1\\r\\n\\r\\nMeeting ID: 814 7078 5774\\r\\nPasscode: 933386','2024-05-08',109,NULL,'2024-05-08 08:40:06','2024-05-08 08:40:06'),(36,'MTG-2024-05-008',81,'CPD Planning Session','2024-05-10','08:00:00','17:00:00',1,2,NULL,NULL,NULL,NULL,'DTI VI is inviting you to a scheduled Zoom meeting.\\r\\n\\r\\nTopic: CPD Planning Session\\r\\nTime: May 10, 2024 08:00 AM\\r\\n            May 13, 2024 08:00 AM\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/81277884493?pwd=SALVZUsGkPWKhbthuZpMbrHyXu9hO9.1\\r\\n\\r\\nMeeting ID: 812 7788 4493\\r\\nPasscode: 231617','2024-05-09',109,NULL,'2024-05-09 05:28:08','2024-05-09 05:28:08'),(37,'MTG-2024-05-009',81,'CPD Planning Session','2024-05-13','08:00:00','17:00:00',1,2,NULL,NULL,NULL,NULL,'DTI VI is inviting you to a scheduled Zoom meeting.\\r\\n\\r\\nTopic: CPD Planning Session\\r\\nTime: May 10, 2024 08:00 AM\\r\\n            May 13, 2024 08:00 AM\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/81277884493?pwd=SALVZUsGkPWKhbthuZpMbrHyXu9hO9.1\\r\\n\\r\\nMeeting ID: 812 7788 4493\\r\\nPasscode: 231617','2024-05-09',109,NULL,'2024-05-09 05:30:31','2024-05-09 05:30:31'),(38,'MTG-2024-05-010',91,'HRMPSB Meeting','2024-05-16','09:00:00','12:30:00',1,2,NULL,NULL,NULL,NULL,'DTI VI is inviting you to a scheduled Zoom meeting.\\r\\n\\r\\nTopic: HRMPSB Meeting\\r\\nTime: May 16, 2024 09:00 AM Singapore\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/89674551943?pwd=B4Lj1Ga3ramvigvWSVWqUINubPw29L.1\\r\\n\\r\\nMeeting ID: 896 7455 1943\\r\\nPasscode: 334576','2024-05-15',109,NULL,'2024-05-15 01:04:16','2024-05-15 01:04:16'),(39,'MTG-2024-05-011',57,'Pixel Perfection: Facebook Ads Revolutionized with AI ','2024-05-28','09:00:00','17:00:00',NULL,2,NULL,NULL,NULL,NULL,'DTI VI is inviting you to a scheduled Zoom meeting.\\r\\n\\r\\nTopic: Pixel Perfection: Facebook Ads Revolutionized with AI \\r\\nTime: May 28, 2024 09:00 AM\\r\\n           May 29, 2024 09:00 AM\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/89403809422?pwd=JtoyafDRtWaDN40bWBc5cTaNdTKDr8.1\\r\\n\\r\\nMeeting ID: 894 0380 9422\\r\\nPasscode: 282742\\r\\n','2024-05-15',109,NULL,'2024-05-15 09:11:29','2024-05-15 09:11:29'),(40,'MTG-2024-05-012',57,'Pixel Perfection: Facebook Ads Revolutionized with AI','2024-05-29','09:00:00','17:00:00',1,2,NULL,NULL,NULL,NULL,'DTI VI is inviting you to a scheduled Zoom meeting.\\r\\n\\r\\nJoin Zoom Meeting\\r\\nhttps://us06web.zoom.us/j/89403809422?pwd=JtoyafDRtWaDN40bWBc5cTaNdTKDr8.1\\r\\n\\r\\nMeeting ID: 894 0380 9422\\r\\nPasscode: 282742','2024-05-15',109,NULL,'2024-05-15 09:12:35','2024-05-15 09:12:35');
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings_statuses`
--

DROP TABLE IF EXISTS `meetings_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meetings_statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(150) DEFAULT NULL,
  `status_desc` text,
  `color` varchar(45) DEFAULT NULL,
  `color_hex` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings_statuses`
--

LOCK TABLES `meetings_statuses` WRITE;
/*!40000 ALTER TABLE `meetings_statuses` DISABLE KEYS */;
INSERT INTO `meetings_statuses` VALUES (1,'Pending',NULL,'warning','#ffc107'),(2,'Scheduled',NULL,'success','#198754'),(3,'Unavailable',NULL,'secondary','#adb5bd'),(4,'Cancelled',NULL,'danger','#dc3545');
/*!40000 ALTER TABLE `meetings_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `par`
--

DROP TABLE IF EXISTS `par`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `par` (
  `id` int NOT NULL AUTO_INCREMENT,
  `entity_name` varchar(150) DEFAULT NULL,
  `par_number` varchar(150) DEFAULT NULL COMMENT 'PAR-2024-01-001',
  `received_by` int DEFAULT NULL,
  `issued_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_par_users1_idx` (`received_by`),
  KEY `fk_par_users2_idx` (`issued_by`),
  CONSTRAINT `fk_par_use1` FOREIGN KEY (`issued_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_par_use2` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `par`
--

LOCK TABLES `par` WRITE;
/*!40000 ALTER TABLE `par` DISABLE KEYS */;
/*!40000 ALTER TABLE `par` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `par_items`
--

DROP TABLE IF EXISTS `par_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `par_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `par_id` int DEFAULT NULL,
  `equipment_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_par_items_par1_idx` (`par_id`),
  KEY `fk_par_items_equipment1_idx` (`equipment_id`),
  CONSTRAINT `fk_pai_equ` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pai_par` FOREIGN KEY (`par_id`) REFERENCES `par` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `par_items`
--

LOCK TABLES `par_items` WRITE;
/*!40000 ALTER TABLE `par_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `par_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po`
--

DROP TABLE IF EXISTS `po`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `po` (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int DEFAULT NULL,
  `date_purchased` date DEFAULT NULL,
  `cost` double(11,2) DEFAULT NULL,
  `po_number` varchar(150) DEFAULT NULL,
  `date_po` date DEFAULT NULL,
  `place_delivery` varchar(150) DEFAULT NULL,
  `date_delivery` date DEFAULT NULL,
  `delivery_term` varchar(150) DEFAULT NULL,
  `payment_term` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_procurements_suppliers1_idx` (`supplier_id`),
  CONSTRAINT `fk_p_s` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po`
--

LOCK TABLES `po` WRITE;
/*!40000 ALTER TABLE `po` DISABLE KEYS */;
/*!40000 ALTER TABLE `po` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po_items`
--

DROP TABLE IF EXISTS `po_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `po_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `po_id` int DEFAULT NULL,
  `equipment_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_par_items_equipment1_idx` (`equipment_id`),
  KEY `fk_par_items_copy1_procurements1_idx` (`po_id`),
  CONSTRAINT `fk_poi_e` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_poi_po` FOREIGN KEY (`po_id`) REFERENCES `po` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po_items`
--

LOCK TABLES `po_items` WRITE;
/*!40000 ALTER TABLE `po_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `po_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pre_post_repair`
--

DROP TABLE IF EXISTS `pre_post_repair`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pre_post_repair` (
  `id` int NOT NULL AUTO_INCREMENT,
  `helpdesk_id` int DEFAULT NULL,
  `equipment_id` int DEFAULT NULL,
  `requested_by_id` int DEFAULT NULL,
  `received_by_id` int DEFAULT NULL,
  `approved_by_id` int DEFAULT NULL,
  `date_prepared` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_pre_post_repair_equipment1_idx` (`equipment_id`),
  KEY `fk_pre_post_repair_users2_idx` (`received_by_id`),
  KEY `fk_pre_post_repair_users3_idx` (`approved_by_id`),
  KEY `fk_pre_post_repair_helpdesks1_idx` (`helpdesk_id`),
  KEY `fk_ppr_u1_idx` (`requested_by_id`),
  CONSTRAINT `fk_ppr_equ` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_ppr_hel` FOREIGN KEY (`helpdesk_id`) REFERENCES `helpdesks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ppr_use1` FOREIGN KEY (`requested_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_ppr_use2` FOREIGN KEY (`received_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_ppr_use3` FOREIGN KEY (`approved_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pre_post_repair`
--

LOCK TABLES `pre_post_repair` WRITE;
/*!40000 ALTER TABLE `pre_post_repair` DISABLE KEYS */;
/*!40000 ALTER TABLE `pre_post_repair` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `priority_levels`
--

DROP TABLE IF EXISTS `priority_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `priority_levels` (
  `id` int NOT NULL AUTO_INCREMENT,
  `priority_level` varchar(150) DEFAULT NULL,
  `priority_level_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `priority_levels`
--

LOCK TABLES `priority_levels` WRITE;
/*!40000 ALTER TABLE `priority_levels` DISABLE KEYS */;
INSERT INTO `priority_levels` VALUES (1,'Low',NULL),(2,'Normal',NULL),(3,'High',NULL),(4,'Critical',NULL);
/*!40000 ALTER TABLE `priority_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_classes`
--

DROP TABLE IF EXISTS `repair_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `repair_classes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `repair_class` varchar(150) DEFAULT NULL,
  `repair_class_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_classes`
--

LOCK TABLES `repair_classes` WRITE;
/*!40000 ALTER TABLE `repair_classes` DISABLE KEYS */;
INSERT INTO `repair_classes` VALUES (1,'Simple',NULL),(2,'Medium',NULL),(3,'Complex',NULL),(4,'Highly Technical',NULL);
/*!40000 ALTER TABLE `repair_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_types`
--

DROP TABLE IF EXISTS `repair_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `repair_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `repair_type` varchar(150) DEFAULT NULL,
  `repair_type_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_types`
--

LOCK TABLES `repair_types` WRITE;
/*!40000 ALTER TABLE `repair_types` DISABLE KEYS */;
INSERT INTO `repair_types` VALUES (1,'Minor',NULL),(2,'Major',NULL);
/*!40000 ALTER TABLE `repair_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_types`
--

DROP TABLE IF EXISTS `request_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_type` varchar(150) DEFAULT NULL,
  `request_type_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_types`
--

LOCK TABLES `request_types` WRITE;
/*!40000 ALTER TABLE `request_types` DISABLE KEYS */;
INSERT INTO `request_types` VALUES (1,'Maintenance Job Request',NULL),(2,'Other ICT Service',NULL);
/*!40000 ALTER TABLE `request_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(150) DEFAULT NULL,
  `role_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Manages system settings and user access.'),(2,'officer','Handles complex technical issues and coordinates with other support teams.'),(3,'staff','Provides frontline support, troubleshoots routine issues, and logs support requests.'),(4,'employee','End-user seeking assistance with IT-related concerns, reports issues, and collaborates with helpdesk staff for resolutions.');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `sub_category` varchar(45) DEFAULT NULL,
  `sub_category_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_sub_categories_categories1_idx` (`category_id`),
  CONSTRAINT `fk_sca_cat` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_categories`
--

LOCK TABLES `sub_categories` WRITE;
/*!40000 ALTER TABLE `sub_categories` DISABLE KEYS */;
INSERT INTO `sub_categories` VALUES (1,1,'Desktop',NULL),(2,1,'Laptop',NULL),(3,1,'Printer',NULL),(4,1,'Others',NULL),(5,2,'Internet Access',NULL),(6,2,'LAN',NULL),(7,2,'Network Sharing',NULL),(8,2,'Others',NULL),(9,3,'Payroll',NULL),(10,3,'eNGAS',NULL),(11,3,'HR System',NULL),(12,3,'DTR System',NULL),(13,3,'Others',NULL),(14,4,'O365 Account',NULL),(15,4,'IHRIS',NULL),(16,4,'eNGAS',NULL),(17,4,'iMMIS',NULL),(18,4,'Others',NULL),(19,5,'O365 Account',NULL),(20,5,'IHRIS',NULL),(21,5,'eNGAS',NULL),(22,5,'iMMIS',NULL),(23,5,'Others',NULL),(24,6,'Graphics',NULL),(25,6,'Video Editting',NULL),(26,6,'Pitch Deck/PPT Presentation',NULL),(27,6,'Set up Venue',NULL),(28,6,'Others',NULL),(29,7,'Others',NULL),(30,3,'iMMIS',NULL);
/*!40000 ALTER TABLE `sub_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(150) DEFAULT NULL,
  `supplier_address` varchar(150) DEFAULT NULL,
  `supplier_contact` varchar(150) DEFAULT NULL,
  `supplier_email` varchar(150) DEFAULT NULL,
  `active` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_number` varchar(150) DEFAULT NULL,
  `first_name` varchar(150) DEFAULT NULL,
  `middle_name` varchar(150) DEFAULT NULL,
  `last_name` varchar(150) DEFAULT NULL,
  `position` varchar(150) DEFAULT NULL,
  `division_id` int DEFAULT NULL,
  `client_type_id` int DEFAULT '3',
  `date_birth` date DEFAULT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `pwd` tinyint DEFAULT '0',
  `phone` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `temp_password` varchar(255) DEFAULT NULL,
  `temp_password_exp` timestamp NULL DEFAULT NULL,
  `active` tinyint DEFAULT '1',
  `role_id` int DEFAULT '4',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_users_divisions1_idx` (`division_id`),
  KEY `fk_users_roles1_idx` (`role_id`),
  KEY `fk_users_client_types1_idx` (`client_type_id`),
  CONSTRAINT `fk_users_client_types1` FOREIGN KEY (`client_type_id`) REFERENCES `client_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_users_division` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (18,'6-051','Aisel Joyce','M.','Tupas','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'aj.moyani@gmail.com',NULL,'6-051','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(19,'6-036','Amiel','P.','Sumait','Trade-industry Development Specialist',13,3,NULL,'Male',0,NULL,'amielsumait@dti.gov.ph',NULL,'6-036','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(20,'6-056','Andrea','S.','Reyes','Trade-industry Development Specialist',5,3,'2024-02-04','Female',0,'09818098637','AndreaReyes@dti.gov.ph','Iloilo','6-056','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-04 13:23:59'),(21,'6-053','Anelyn','L.','Apiag','Administrative Aide Vi',13,3,'2020-02-04','Female',0,NULL,'anelyn1995@gmail.com',NULL,'6-053','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(22,'6-006','Angelo','G.','Patrimonio','Trade-industry Development Specialist',1,3,'2001-02-05','Male',0,'09123456789','AngeloPatrimonio@dti.gov.ph','Iloilo','6-006','$2y$10$R4D6W8Ny1KVLrlPmt1lcrOilTG4wrC.X2yxu4JWYoeMjH9OckUEBG','OYkGspdA','2024-04-24 01:28:41',1,4,'2024-02-02 03:59:17','2024-04-24 01:26:41'),(23,'6-016','Ariane','L.','Fuentespina','Administrative Assistant Iii-secretary',13,3,NULL,'Female',0,NULL,'ArianeFuentespina@dti.gov.ph',NULL,'6-016','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(24,'6-023','Arnel','B.','Oliveros','Trade-industry Development Specialist',13,3,NULL,'Male',0,NULL,'ArnelOliveros@dti.gov.ph',NULL,'6-023','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(25,'6-041','Aurora Teresa','J.','Alisen','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'AuroraTeresaAlisen@dti.gov.ph',NULL,'6-041','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(26,'6-010','Belinda','B.','Roldan','Administrative Officer Iii',13,3,NULL,'Female',0,NULL,'BelindaRoldan@dti.gov.ph',NULL,'6-010','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(27,'6-004','Bella','B.','Bonto','Administrative Officer Iii',13,3,NULL,'Female',0,NULL,'BellaBonto@dti.gov.ph',NULL,'6-004','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(28,'6-038','Bemy John','A.','Collado','Trade-industry Development Analyst',13,3,NULL,'Male',0,NULL,'itsbeenawhile93@gmail.com',NULL,'6-038','$2y$10$1n5fMEZQ28QRkWH5R1LoBeCnOtSURGi2TH32vjnRfWiZ57VxfyVIW','NzF8i2K5','2024-04-22 01:27:06',1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(29,'6-079','Billy','B.','Regondon','Administrative Aide Vi',13,3,NULL,'Male',0,NULL,'BillyRegondon@dti.gov.ph',NULL,'6-079','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(30,'6-045','Charlene Joy','A.','Adeja','Trade-industry Development Analyst',13,3,NULL,'Female',0,NULL,'cjaltillero@gmail.com',NULL,'6-045','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(31,'6-128','Cheryl','D.','Fernandez','Trade-industry Development Analyst',13,3,NULL,'Female',0,NULL,'Cherylfernandez@dti.gov.ph',NULL,'6-128','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(32,'6-162','Daniel','S.','Agan','Trade-industry Development Analyst',13,3,NULL,'Male',0,NULL,'danielagan@dti.gov.ph',NULL,'6-162','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(33,'C6-004','Daryl Mae Lorene','F.','Salveron','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'DarylMaeLoreneSalveron@dti.gov.ph',NULL,'C6-004','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(34,'6-050','Dessa Anh','T.','Flores','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'dessaanhflores987@gmail.com',NULL,'6-050','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(35,'C6-014','Dicof','D.','Cofreros','Trade-industry Development Specialist',13,3,NULL,'Male',0,NULL,'DicofCofreros@dti.gov.ph',NULL,'C6-014','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(36,'6-062','Emily','S.','Pasaporte','Administrative Aide Vi',13,3,NULL,'Female',0,NULL,'EmilyPasaporte@dti.gov.ph',NULL,'6-062','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(37,'6-113','Engiemar','B.','Tupas','Senior Trade-industry Development Specialist',13,3,NULL,'Male',0,NULL,'engiemartupas@dti.gov.ph',NULL,'6-113','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(38,'6-002','Ermelinda','P.','Pollentes','Director Iii-assistant Regional Director',1,3,'2024-02-05','Female',1,'09123456789','ErmelindaPollentes@dti.gov.ph','Iloilo City','6-002','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,0,4,'2024-02-02 03:59:17','2024-02-14 02:33:01'),(39,'6-142','Felisa Judith','L.','Degala','Provincial Trade-industry Officer',13,3,NULL,'Female',0,NULL,'felisajudithdegala@dti.gov.ph',NULL,'6-142','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(40,'6-156','Florenda Octoberiana','C.','Abian','Trade-industry Development Specialist',5,3,NULL,'Female',0,NULL,'FlorendaOctoberianaAbian@dti.gov.ph',NULL,'6-156','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-05-10 06:17:38'),(41,'C6-040','Florielee','S.','Clavel','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'FlorieleeSasabo@dti.gov.ph',NULL,'C6-040','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(42,'6-029','Frauleine','B.','Bautista','Administrative Officer Ii',13,3,NULL,'Female',0,NULL,'frauleinebautista@dti.gov.ph',NULL,'6-029','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(43,'6-117','Gerin','E.','Vergara','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'gerinvergara@dti.gov.ph',NULL,'6-117','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(44,'6-012','Gevi Kristina','O.','Sandoy','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'gk.sandoy@gmail.com',NULL,'6-012','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(45,'6-138','Grace','M.','Benedicto','Supervising Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'GraceBenedicto@dti.gov.ph',NULL,'6-138','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-04-26 07:17:43'),(46,'6-119','Honey Mae','F.','Osimco','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'honeymaeosimco@dti.gov.ph',NULL,'6-119','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(47,'6-039','Iris Mae','I.','Sarabia','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'immibisate@gmail.com',NULL,'6-039','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(48,'6-137','Jane Russel','B.','Prudente','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'JaneRusselPrudente@dti.gov.ph',NULL,'6-137','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(49,'6-013','Janice','T.','Abellar','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'janiceabellar@dti.gov.ph',NULL,'6-013','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(50,'6-042','Jenny May','B.','Tabalanza','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'jennymaytabalanza@dti.gov.ph',NULL,'6-042','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-05-09 05:21:33'),(51,'6-037','John Mchale','C.','Benid','Trade-industry Development Specialist',13,3,NULL,'Male',0,NULL,'johnmchalbenid@dti.gov.ph',NULL,'6-037','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(52,'6-009','Jomar','B.','Benedicto','Utility Worker',13,3,NULL,'Male',0,NULL,'jbenedicto.cti@gmail.com',NULL,'6-009','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(53,'6-005','Jonas Richard','F.','Fondevilla','Trade-industry Development Specialist',13,3,NULL,'Male',0,NULL,'JonasRichardFondevilla@dto.gov.ph',NULL,'6-005','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(54,'6-147','Jonathan','T.','Tejida','Senior Trade-industry Development Specialist',13,3,NULL,'Male',0,NULL,'jonathantejida@dti.gov.ph',NULL,'6-147','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(55,'6-080','Jose Marie','T.','Tanchuan','Driver I',13,3,NULL,'Male',0,NULL,'josemarietanchuan@gmail.com',NULL,'6-080','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(56,'C6-007','Joy Anne','S.','Erazo','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'JoyAnneErazo@dti.gov.ph',NULL,'C6-007','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-05-10 01:54:51'),(57,'6-043','Juan Carlos','V.','Corros','Trade-industry Development Analyst',13,3,NULL,'Male',0,NULL,'juancarloscorros@dti.gov.ph',NULL,'6-043','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-05-02 04:04:00'),(58,'6-008','Judith','G.','Kelly','Chief Administrative Officer',13,3,NULL,'Female',0,NULL,'JudithKelly@dti.gov.ph',NULL,'6-008','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(59,'6-024','Judy Mae','M.','Sajo','Information Officer Iii',13,3,NULL,'Female',0,NULL,'judymaesajo@gmail.com',NULL,'6-024','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(60,'6-083','Juvy','D.','Benliro','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'JuvyBenliro@dti.gov.ph',NULL,'6-083','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(61,'6-087','Ken Queenie','R.','Cuñada','Provincial Trade-industry Officer',13,3,NULL,'Female',0,NULL,'kenqueeniecunada@dti.gov.ph',NULL,'6-087','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(62,'6-030','Kenneth','C.','Villarosa','Trade-industry Development Specialist',13,3,NULL,'Male',0,NULL,'kennethvillarosa@hotmail.com',NULL,'6-030','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(63,'6-052','Kent Novie','T.','Tacsagon','Trade-industry Development Analyst',13,3,NULL,'Male',0,NULL,'kntacsagon01@gmail.com',NULL,'6-052','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(64,'C6-009','Kher Jake Martin','A.','Trayco','Senior Trade-industry Development Specialist',13,3,NULL,'Male',0,NULL,'traycomartin@gmail.com',NULL,'C6-009','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(65,'6-089','Kurt Maurice','S.','Tugaff','Trade-industry Development Specialist',13,3,NULL,'Male',0,NULL,'kurttugaff1@gmail.com',NULL,'6-089','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(66,'6-121','Lakambini','T.','Regalado','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'bambeetle79@gmail.com',NULL,'6-121','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(67,'C6-039','Lovely Claire','D.','Rebatado','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'LovelyClaireDulaca@dti.gov.ph',NULL,'C6-039','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(68,'6-020','Lyndy Exzyle','D.','Miranda','Accountant Ii',13,3,NULL,'Female',0,NULL,'LyndyExzyleDemegillo@dti.gov.ph',NULL,'6-020','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(69,'6-158','Ma. Aurora','E.','Bangcaya','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'maia.seb82@gmail.com',NULL,'6-158','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(70,'6-127','Ma. Carmen','I.','Iturralde','Provincial Trade-industry Officer',13,3,NULL,'Female',0,NULL,'MaCarmenIturralde@dti.gov.ph',NULL,'6-127','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(71,'6-033','Ma. Dinda','R.','Tamayo','Provincial Trade-industry Officer',13,3,NULL,'Female',0,NULL,'madindatamayo@dti.gov.ph',NULL,'6-033','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(72,'6-046','Ma. Dorita','D.','Chavez','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'MaDoritaChavez@dti.gov.ph',NULL,'6-046','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(73,'6-034','Ma. Kristine','B.','Rosaldes','Administrative Assistant Iii-bookkeeper',4,3,NULL,'Female',0,NULL,'MaKristineRosaldes@dti.gov.ph',NULL,'6-034','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-14 05:41:32'),(74,'6-157','Maria Victoria','D.','Aspera','Trade-industry Development Analyst',13,3,NULL,'Female',0,NULL,'MariaVictoriaAspera@dti.gov.ph',NULL,'6-157','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(75,'6-026','Mariecon','A.','Burla','Administrative Aide Vi',13,3,NULL,'Female',0,NULL,'marzalvarez@gmail.com',NULL,'6-026','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(76,'6-017','Marjorie','F.','Tendras','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'MarjorieTendras@dti.gov.ph',NULL,'6-017','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(77,'6-872','Mark','C.','Jurilla','Attorney Iii',13,3,NULL,'Male',0,NULL,'markjurilla@gmail.com',NULL,'6-872','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(78,'6-031','Mary Jade','R.','Gonzales','Planning Officer Iii',13,3,NULL,'Female',0,NULL,'MaryJadeGonzales@dti.gov.ph',NULL,'6-031','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(79,'6-035','May Angeli','V.','Tayona','Senior Trade-industry Development Specialist',5,3,NULL,'Female',0,NULL,'MayAngeliTayona@dti.gov.ph',NULL,'6-035','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-05-10 06:17:11'),(80,'6-082','Merian','A.','Asas','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'MerianAsas@dti.gov.ph',NULL,'6-082','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(81,'6-049','Mia','A.','Aujero','Trade-industry Development Analyst',3,3,NULL,'Female',0,NULL,'MiaAujero@dti.gov.ph',NULL,'6-049','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-05-10 06:17:26'),(82,'6-007','Michelle','C.','Ladigohon','Administrative Officer V',13,3,NULL,'Female',0,NULL,'michelleladigohon@dti.gov.ph',NULL,'6-007','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(83,'6-154','Mutya','D.','Eusores','Chief Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'MUTYAEUSORES@DTI.GOV.PH',NULL,'6-154','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(84,'6-011','Nesgen Rhea','C.','Zerrudo','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'NesgenRheaCaburlan@dti.gov.ph',NULL,'6-011','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(85,'6-066','Pamela','S.','Roldan','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'PamelaRoldan@dti.gov.ph',NULL,'6-066','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(86,'6-141','Procilito','G.','Sadaya','Senior Trade-industry Development Specialist',13,3,NULL,'Male',0,NULL,'pros_sadaya@yahoo.com',NULL,'6-141','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(87,'6-054','Rachel','N.','Nufable','Provincial Trade-industry Officer',13,3,NULL,'Female',0,NULL,'RachelNufable@dti.gov.ph',NULL,'6-054','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(88,'6-047','Reginald','S.','Hudierez','Senior Trade-industry Development Specialist',13,3,NULL,'Male',0,NULL,'ReginaldHudierez@dti.gov.ph',NULL,'6-047','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(89,'6-044','Rejoice','S.','Orquia','Trade-industry Development Analyst',13,3,NULL,'Female',0,NULL,'guimaras.dti@negosyocenter.gov.ph',NULL,'6-044','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-05-09 05:36:20'),(90,'6-131','Reynaldo','T.','Tejero','Driver I',13,3,NULL,'Male',0,NULL,'tejeroreynaldo@yahoo.com',NULL,'6-131','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(91,'6-134','Rhea','B.','Jocsing','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'RheaJocsing@dti.gov.ph',NULL,'6-134','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(92,'6-015','Rhea Jepee','L.','Legario','Administrative Officer Ii',13,3,NULL,'Female',0,NULL,'RheaJepeeLegario@dti.gov.ph',NULL,'6-015','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(93,'6-085','Richeline','A.','Borres','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'RichelineBorres@dti.gov.ph',NULL,'6-085','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(94,'6-027','Romel','L.','Amihan','Senior Trade-industry Development Specialist',13,3,NULL,'Male',0,NULL,'romelamihan@dti.gov.ph',NULL,'6-027','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(95,'6-143','Rosalie','A.','Panganiban','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'RosaliePanganiban@dti.gov.ph',NULL,'6-143','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(96,'6-105','Rosie','Y.','Evangelista','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'rosieevangelista@dti.gov.ph',NULL,'6-105','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(97,'C6-003','Rowena','D.','Barcelona','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'RowenaBarcelona@dti.gov.ph',NULL,'C6-003','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(98,'6-025','Roxanne','B.','Arbatin','Administrative Officer Ii',13,3,NULL,'Female',0,NULL,'roxannebedeo@yahoo.com',NULL,'6-025','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(99,'6-109','Rudy','G.','Montalbo','Administrative Aide Iv-driver',13,3,NULL,'Male',0,NULL,'rudymontalbo@gmail.com',NULL,'6-109','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(100,'6-028','Sealbia','Y.','Quilino','Administrative Officer Ii',13,3,NULL,'Female',0,NULL,'SealbiaQuilino@dti.gov.ph',NULL,'6-028','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(101,'6-014','Shayne','G.','Jornadal','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'ShayneJornadal@dti.gov.ph',NULL,'6-014','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(102,'6-155','Sheryl','E.','Dioteles','Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'Sheryldioteles@dti.gov.ph',NULL,'6-155','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(103,'6-160','Therese Grace','J.','Marla','Administrative Officer V',13,3,NULL,'Female',0,NULL,'theresegracemarla@dti.gov.ph',NULL,'6-160','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(104,'C6-145','Verna','A.','Belegera','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'VernaBelegera@dti.gov.ph',NULL,'C6-145','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-05-10 00:38:45'),(105,'6-048','Yolanda','O.','Gallenero','Senior Trade-industry Development Specialist',13,3,NULL,'Female',0,NULL,'YolandaGallenero@dti.gov.ph',NULL,'6-048','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-04-26 07:17:43'),(108,'MIS_Patrimonio','Angelo','G.','Patrimonio',NULL,13,3,NULL,'Male',0,NULL,'AngeloPatrimonio@dti.gov.ph',NULL,'MIS_Patrimonio','$2y$10$9LVUh599htXJdnxM6wi0mOZQdocJ3CBiDanwolaEJVuaxoiczNDZO',NULL,NULL,1,1,'2024-02-13 08:28:37','2024-04-26 07:17:43'),(109,'MIS_Collado','Bemy John','A.','Collado',NULL,13,3,NULL,'Male',0,NULL,'BemyJohnCollado@dti.gov.ph',NULL,'MIS_Collado','$2y$10$wgESLB6ZqReAyBKBFylfG.1NCiNFsP48Sb5sZHLIqGOdzxWr61.fC',NULL,NULL,1,1,'2024-02-13 08:29:38','2024-04-26 07:17:43'),(110,NULL,'Dan Alfrei','C.','Fuerte','JO/COS',1,3,'2000-09-29','Male',0,'09818098637','dace.phage@gmail.com','Iloilo City Proper','MIS_Fuerte','$2y$10$MX9c7FR/f.9N.2T8gY.sQuKo6lm8uWKpKbrpnSegIozJggkFHgcpO',NULL,NULL,1,1,'2024-02-13 08:30:17','2024-02-19 06:07:43'),(111,'MIS_Jovero','Kristopher Gerard',NULL,'Jovero',NULL,13,3,NULL,'Male',0,NULL,NULL,NULL,'MIS_Jovero','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,1,'2024-02-13 08:31:22','2024-04-26 07:17:43'),(112,NULL,'Sherlyn',NULL,'Canales',NULL,11,3,NULL,'Female',1,NULL,NULL,NULL,NULL,'$2y$10$rmWObF1jbqPhPzZFi7UdJeysrXM4kTjpf2BeH/UGCcvFZp7rxccMu','65cb2956',NULL,1,4,'2024-02-13 08:33:26','2024-02-13 08:33:26'),(113,NULL,'Mary Ann','asdasd','Alteros',NULL,11,3,NULL,'Female',1,NULL,'IloiloCity.LGU@negosyocenter.gov.ph','sedweweweww',NULL,'$2y$10$UvTikuViD.0hm3x3fBsbbexdWMlNDy5ANzonfZPL2flZ9L2/vhbcO','65cc075d',NULL,1,4,'2024-02-14 00:20:46','2024-04-24 01:53:40'),(115,'1234','Marimae','Cartagena','Pueyo','TIDS - CARP',10,3,'1995-01-01','Female',1,NULL,'marimaepueyo@dti.gov.ph','Guimaras','1234','$2y$10$dxthzDj2h5nA4DwqMMbv7OPioYsLXxbqgSk0EXiS.81YeYU7HSx5m','65cc26c3',NULL,1,4,'2024-02-14 02:34:43','2024-02-14 02:34:43'),(116,NULL,'May Ann',NULL,'Arca',NULL,2,3,NULL,'Female',0,NULL,'mayannarca560@gmail.com',NULL,NULL,'$2y$10$gvkY9mesfy7Y9XgT2tijLuySGS4amouwljNxnRlE7xkHOtoDjRJ9G','65cd68c8',NULL,1,4,'2024-02-15 01:28:40','2024-02-15 01:28:40'),(117,NULL,'Johna Raf','M.','Montalvo',NULL,2,3,NULL,'Female',0,NULL,'JohnaRafMontalvo@dti.gov.ph',NULL,NULL,'$2y$10$scCG0dEBjAhg8ZbpdmmfDu73MV/G2CYTGabd4OXW8APjIhwnKWSC6','65cd6945',NULL,1,4,'2024-02-15 01:30:45','2024-05-10 00:41:24'),(118,NULL,'Jeanne Renee',NULL,'Nedula',NULL,1,NULL,NULL,'Female',0,NULL,NULL,NULL,NULL,'$2y$10$8qmWlgvdR9yB.QfYgRae8e06lheow/t5B8rveBQE5C7dUCD.BfdQq','65cd6ebd',NULL,1,NULL,'2024-02-15 01:54:05','2024-02-15 01:54:05'),(119,NULL,'Glace',NULL,'Sajonia',NULL,4,3,NULL,'Female',0,NULL,NULL,NULL,NULL,'$2y$10$hZsbMxUkwesrS7SYh23Ode8vQ4ooK4E1BB2gntBnNzo1VT4d1zMae','65cd7337',NULL,1,NULL,'2024-02-15 02:13:11','2024-02-15 02:13:11'),(120,NULL,'Glace',NULL,'Sajonia',NULL,4,3,NULL,'Female',0,NULL,NULL,NULL,NULL,'$2y$10$fG3ILHMBeMWvRJ1yFh14/uM1lTL5.xXVtCalQEcDngT/50AAyQx7m','65cd73c1',NULL,1,NULL,'2024-02-15 02:15:29','2024-02-15 02:15:29'),(122,NULL,'Francine',NULL,'Demasis',NULL,11,3,NULL,'Female',0,NULL,NULL,NULL,NULL,'$2y$10$S7n7x8cmCPb0XsKH6zgBx.LkmHcaWPpfOt40mAl9aghPWdf9XBuSe','65cda28d',NULL,1,4,'2024-02-15 05:35:09','2024-02-15 05:35:09'),(123,'cos6-004','Dan Alfrei','Celestial','Fuerte','JO/COS',1,3,'2000-09-29','Male',0,'09818098637','dace.phage@gmail.com','Iloilo City','ORD_Fuerte','$2y$10$MX9c7FR/f.9N.2T8gY.sQuKo6lm8uWKpKbrpnSegIozJggkFHgcpO',NULL,NULL,1,4,'2024-02-15 06:26:10','2024-05-16 06:12:01'),(126,NULL,'Jeanne Renee',NULL,'Nedula',NULL,1,3,NULL,'Female',0,NULL,'JeanneReneeNedula@dti.gov.ph',NULL,'ORD_Nedula','$2y$10$IGYfsp/k1sLGjm4Cs28iZeSFj75Scucj7eZtuzLVpYg00D73OPAUe','66285da4',NULL,1,4,'2024-04-24 01:17:24','2024-04-24 01:17:24'),(127,NULL,'Maria Rose',NULL,'Jayona',NULL,11,3,NULL,'Female',0,NULL,'mariarosejayona@gmail.com',NULL,'DTI Iloilo_Jayona','$2y$10$CgeVo/.2/zmDlL7/jg3nVOZvJKRj2IGiUWL9Qejsym9/bYZo.51pG','6629c7e5',NULL,1,4,'2024-04-25 03:03:01','2024-04-25 03:03:01'),(128,NULL,'Jazer',NULL,'Miranda',NULL,1,3,NULL,'Male',0,NULL,'jazerpmiranda@gmail.com',NULL,'ORD_Miranda','$2y$10$7vL6XHWYdk2qcozTToo3leHeVL/fVnYFgRrbvXgxw9qo/p9zZNt26','6629e641',NULL,1,4,'2024-04-25 05:12:33','2024-04-25 05:12:33'),(129,NULL,'Rossel',NULL,'Virtuoso','AA',5,3,NULL,'Female',0,NULL,'dtir6cfidp@gmail.com',NULL,'IDD_Virtuoso','$2y$10$1l4Or3gpzEzdcUrVK0V.y.OgkCB4Pfo4ZASrRhLQ0qNyxjKf//20O','662b5b89',NULL,1,4,'2024-04-26 07:45:13','2024-04-26 07:45:13'),(130,NULL,'Julie Jean',NULL,'Tidon',NULL,13,3,NULL,'Female',0,NULL,'jtidon@sbcorp.gov.ph',NULL,'DTI_Tidon','$2y$10$IT9TQS50Xv/VwHyUpY36OOJ17WQpf/d0.DhONkjQZt3/yPBWHPPcG','662f3304',NULL,1,4,'2024-04-29 05:41:24','2024-04-29 05:41:24'),(131,NULL,'Althone','Ledesma','Dy','TIDS',12,3,NULL,'Male',0,NULL,'althonedy@gmail.com',NULL,'DTI Negros Occidental_Dy','$2y$10$CxjlKDNWdWS/T06TEBcXo.0I6mtKvspDJNb60U6AEkFFFtZ3UHmDu',NULL,NULL,1,4,'2024-04-29 05:55:09','2024-04-29 08:17:35'),(132,NULL,'Glecita',NULL,'Sajonia',NULL,4,3,'1900-12-01','Female',0,NULL,NULL,NULL,'FAD_Sajonia','$2y$10$eXIixvhvdlzLkrxkbr6ApujY8xX6Aky/sqyDTF5nEnGPznnipu0F.','66305608',NULL,1,4,'2024-04-30 02:23:04','2024-04-30 02:23:04'),(133,NULL,'RL','G','Marco','TIDA',3,3,NULL,'Male',0,NULL,'rlmarco@dti.gov.ph',NULL,'CPD_Marco','$2y$10$tQpiVPpu7O3HhgN9/4NvvusZjS7N1Zk7xriRNdErk9glJgRSVAQg2','66308256',NULL,1,4,'2024-04-30 05:32:06','2024-04-30 05:32:06'),(135,'COS-IL-007','Wilma','N','Semillano',NULL,11,3,NULL,'Female',0,NULL,'wilmasemillano331@gmail.com',NULL,'DTI Iloilo_Semillano','$2y$10$CxazH7lmvbifG6h/x1lqgu23yxgA3TZWmAyCFPEull0FTahUUqruO',NULL,NULL,1,4,'2024-05-06 03:36:19','2024-05-13 01:26:07'),(136,NULL,'Romil ',NULL,'Maro',NULL,11,3,NULL,'Male',0,NULL,'RomilMaro@dti.gov.ph',NULL,'DTI Iloilo_Maro','$2y$10$cPNnx/r8R0R9.HvAsdoKquNhIgB.s.oIuhJqxMhXRPKJu4UZ78dkW','663d7179',NULL,1,4,'2024-05-10 00:59:37','2024-05-16 02:25:51'),(137,NULL,'Judy Ann ',NULL,'Bandiola',NULL,7,3,NULL,'Female',0,NULL,'negosyocenteraklan@gmail.com',NULL,'DTI Aklan_Bandiola','$2y$10$kkXF7hzTb0eQxMXh3aHqAuqWR5NKAsDFRD3NWZHxYpJBdeWmvec6G','663d731c',NULL,1,4,'2024-05-10 01:06:36','2024-05-16 02:25:51'),(138,NULL,'Lynna Joy ',NULL,'Cardinal',NULL,12,3,NULL,'Female',0,NULL,'LynnaJoyCardinal@dti.gov.ph',NULL,'DTI Negros Occidental_Cardinal','$2y$10$Zz9fPLiAL23TxSAahasEo.biSVC6S2EAI8aCed5oPaGetnf/jKfUS','663d74ad',NULL,1,4,'2024-05-10 01:13:17','2024-05-16 02:25:51'),(139,NULL,'Rheyzia Marie',NULL,'Elgario','DTI Monitor',11,3,NULL,'Female',0,NULL,'dti.iloprovincialmonitors@gmail.com',NULL,'DTI Iloilo_Elgario','$2y$10$tcb55MePy3fRBjFkVFBWIOgrh3t3FYCnh/yHOmF5NLrqrEmCmXEFK','66459995',NULL,1,4,'2024-05-16 05:28:53','2024-05-16 05:28:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-16 17:52:43
