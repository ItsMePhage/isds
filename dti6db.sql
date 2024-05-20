-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: dti6db
-- ------------------------------------------------------
-- Server version	8.0.36

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
  `request_types_id` int NOT NULL,
  `category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categories_request_types1_idx` (`request_types_id`),
  CONSTRAINT `fk_categories_request_types1` FOREIGN KEY (`request_types_id`) REFERENCES `request_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,1,'ICT Equipment Service'),(2,1,'Network Service'),(3,1,'Software/Application Service'),(4,2,'Account Management'),(5,2,'Report Generation'),(6,2,'Activity-Based Assistance'),(7,2,'Others');
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
  `client_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_types`
--

LOCK TABLES `client_types` WRITE;
/*!40000 ALTER TABLE `client_types` DISABLE KEYS */;
INSERT INTO `client_types` VALUES (1,'Citizen'),(2,'Business'),(3,'Government');
/*!40000 ALTER TABLE `client_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divisions`
--

DROP TABLE IF EXISTS `divisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divisions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `division` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisions`
--

LOCK TABLES `divisions` WRITE;
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` VALUES (1,'ORD'),(2,'CPD'),(3,'FAD'),(4,'BDD'),(5,'COA'),(6,'IDD'),(7,'CPU'),(8,'IDU'),(9,'DTI Aklan'),(10,'DTI Antique'),(11,'DTI Capiz'),(12,'DTI Guimaras'),(13,'DTI Iloilo'),(14,'DTI Negros Occidental');
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `h_statuses`
--

DROP TABLE IF EXISTS `h_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `h_statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `h_statuses`
--

LOCK TABLES `h_statuses` WRITE;
/*!40000 ALTER TABLE `h_statuses` DISABLE KEYS */;
INSERT INTO `h_statuses` VALUES (1,'Open'),(2,'Cancelled'),(3,'Pending'),(4,'Pre-repair'),(5,'Completed'),(6,'Unserviceable');
/*!40000 ALTER TABLE `h_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helpdesks`
--

DROP TABLE IF EXISTS `helpdesks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `helpdesks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_number` varchar(45) DEFAULT NULL,
  `requested_by` int NOT NULL,
  `date_requested` date DEFAULT NULL,
  `request_types_id` int NOT NULL,
  `categories_id` int NOT NULL,
  `sub_categories_id` int NOT NULL,
  `complaint` text,
  `datetime_preferred` datetime DEFAULT NULL,
  `h_statuses_id` int NOT NULL DEFAULT '1',
  `property_number` varchar(45) DEFAULT NULL,
  `priority_levels_id` int DEFAULT NULL,
  `repair_types_id` int DEFAULT NULL,
  `repair_classes_id` int DEFAULT NULL,
  `mediums_id` int DEFAULT NULL,
  `serviced_by` int DEFAULT NULL,
  `approved_by` int DEFAULT NULL,
  `datetime_start` datetime DEFAULT NULL,
  `datetime_end` varchar(45) DEFAULT NULL,
  `is_pullout` tinyint DEFAULT NULL,
  `is_turnover` tinyint DEFAULT NULL,
  `diagnosis` text,
  `action_taken` text,
  `remarks` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `request_number_UNIQUE` (`request_number`),
  KEY `fk_helpdesks_users1_idx` (`requested_by`),
  KEY `fk_helpdesks_request_types1_idx` (`request_types_id`),
  KEY `fk_helpdesks_categories1_idx` (`categories_id`),
  KEY `fk_helpdesks_sub_categories1_idx` (`sub_categories_id`),
  KEY `fk_helpdesks_h_statuses1_idx` (`h_statuses_id`),
  KEY `fk_helpdesks_priority_levels1_idx` (`priority_levels_id`),
  KEY `fk_helpdesks_repair_types1_idx` (`repair_types_id`),
  KEY `fk_helpdesks_repair_classes1_idx` (`repair_classes_id`),
  KEY `fk_helpdesks_mediums1_idx` (`mediums_id`),
  KEY `fk_helpdesks_users2_idx` (`serviced_by`),
  KEY `fk_helpdesks_users3_idx` (`approved_by`),
  CONSTRAINT `fk_helpdesks_categories1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `fk_helpdesks_h_statuses1` FOREIGN KEY (`h_statuses_id`) REFERENCES `h_statuses` (`id`),
  CONSTRAINT `fk_helpdesks_mediums1` FOREIGN KEY (`mediums_id`) REFERENCES `mediums` (`id`),
  CONSTRAINT `fk_helpdesks_priority_levels1` FOREIGN KEY (`priority_levels_id`) REFERENCES `priority_levels` (`id`),
  CONSTRAINT `fk_helpdesks_repair_classes1` FOREIGN KEY (`repair_classes_id`) REFERENCES `repair_classes` (`id`),
  CONSTRAINT `fk_helpdesks_repair_types1` FOREIGN KEY (`repair_types_id`) REFERENCES `repair_types` (`id`),
  CONSTRAINT `fk_helpdesks_request_types1` FOREIGN KEY (`request_types_id`) REFERENCES `request_types` (`id`),
  CONSTRAINT `fk_helpdesks_sub_categories1` FOREIGN KEY (`sub_categories_id`) REFERENCES `sub_categories` (`id`),
  CONSTRAINT `fk_helpdesks_users1` FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_helpdesks_users2` FOREIGN KEY (`serviced_by`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_helpdesks_users3` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpdesks`
--

LOCK TABLES `helpdesks` WRITE;
/*!40000 ALTER TABLE `helpdesks` DISABLE KEYS */;
INSERT INTO `helpdesks` VALUES (1,'REQ-2024-05-001',1,'2024-05-19',1,1,1,'asdasd','2024-05-19 20:43:00',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-19 12:43:35',NULL),(2,'REQ-2024-05-002',1,'2024-05-19',1,1,3,'asdasd','2024-05-19 21:20:00',5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-19 13:21:01',NULL),(3,'REQ-2024-05-003',1,'2024-05-19',2,5,20,'asdasd','2024-05-19 11:28:00',5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-19 15:28:37',NULL),(4,'REQ-2024-05-004',1,'2024-05-19',1,2,6,'asdasd','2024-05-19 23:28:00',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-19 15:28:48',NULL),(5,'REQ-2024-05-005',2,'2024-05-20',1,1,1,'asdasd','2024-05-20 12:59:00',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-20 04:59:59',NULL);
/*!40000 ALTER TABLE `helpdesks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hosts`
--

DROP TABLE IF EXISTS `hosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hosts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `host` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hosts`
--

LOCK TABLES `hosts` WRITE;
/*!40000 ALTER TABLE `hosts` DISABLE KEYS */;
/*!40000 ALTER TABLE `hosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_statuses`
--

DROP TABLE IF EXISTS `m_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_statuses`
--

LOCK TABLES `m_statuses` WRITE;
/*!40000 ALTER TABLE `m_statuses` DISABLE KEYS */;
INSERT INTO `m_statuses` VALUES (1,'Pending'),(2,'Unavailable'),(3,'Scheduled'),(4,'Cancelled');
/*!40000 ALTER TABLE `m_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mediums`
--

DROP TABLE IF EXISTS `mediums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mediums` (
  `id` int NOT NULL AUTO_INCREMENT,
  `medium` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mediums`
--

LOCK TABLES `mediums` WRITE;
/*!40000 ALTER TABLE `mediums` DISABLE KEYS */;
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
  `request_number` varchar(45) DEFAULT NULL,
  `requested_by` int NOT NULL,
  `date_requested` date DEFAULT NULL,
  `topic` text,
  `date_scheduled` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `hosts_id` int DEFAULT NULL,
  `m_statuses_id` int DEFAULT '1',
  `meeting_details` text,
  `generated_by` int DEFAULT NULL,
  `approved_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `request_number_UNIQUE` (`request_number`),
  KEY `fk_meetings_users1_idx` (`requested_by`),
  KEY `fk_meetings_hosts1_idx` (`hosts_id`),
  KEY `fk_meetings_m_statuses1_idx` (`m_statuses_id`),
  KEY `fk_meetings_users2_idx` (`generated_by`),
  KEY `fk_meetings_users3_idx` (`approved_by`),
  CONSTRAINT `fk_meetings_hosts1` FOREIGN KEY (`hosts_id`) REFERENCES `hosts` (`id`),
  CONSTRAINT `fk_meetings_m_statuses1` FOREIGN KEY (`m_statuses_id`) REFERENCES `m_statuses` (`id`),
  CONSTRAINT `fk_meetings_users1` FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_meetings_users2` FOREIGN KEY (`generated_by`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_meetings_users3` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
INSERT INTO `meetings` VALUES (1,'MTG-2024-05-001',1,'2024-05-20',NULL,'2024-05-20','11:59:00','12:59:00',NULL,1,NULL,NULL,NULL,'2024-05-20 03:59:53','2024-05-20 03:59:53'),(2,'MTG-2024-05-002',2,'2024-05-20',NULL,'2024-05-20','12:02:00','13:02:00',NULL,1,NULL,NULL,NULL,'2024-05-20 04:02:24','2024-05-20 04:02:24');
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offices`
--

DROP TABLE IF EXISTS `offices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `office_code` varchar(45) DEFAULT NULL,
  `office` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offices`
--

LOCK TABLES `offices` WRITE;
/*!40000 ALTER TABLE `offices` DISABLE KEYS */;
INSERT INTO `offices` VALUES (1,'RO','Regional Office'),(2,'AKL','Aklan Provincial Office'),(3,'ANT','Antique Provincial Office'),(4,'CAP','Capiz Provincial Office'),(5,'GUI','Guimaras Provincial Office'),(6,'ILO','Iloilo Provincial Office'),(7,'NEG','Negros Occidental Provincial Office');
/*!40000 ALTER TABLE `offices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `priority_levels`
--

DROP TABLE IF EXISTS `priority_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `priority_levels` (
  `id` int NOT NULL AUTO_INCREMENT,
  `priority_level` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `priority_levels`
--

LOCK TABLES `priority_levels` WRITE;
/*!40000 ALTER TABLE `priority_levels` DISABLE KEYS */;
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
  `repair_class` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_classes`
--

LOCK TABLES `repair_classes` WRITE;
/*!40000 ALTER TABLE `repair_classes` DISABLE KEYS */;
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
  `repair_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_types`
--

LOCK TABLES `repair_types` WRITE;
/*!40000 ALTER TABLE `repair_types` DISABLE KEYS */;
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
  `request_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_types`
--

LOCK TABLES `request_types` WRITE;
/*!40000 ALTER TABLE `request_types` DISABLE KEYS */;
INSERT INTO `request_types` VALUES (1,'Maintenance Job Request'),(2,'Other ICT Service');
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
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin'),(2,'staff'),(3,'employee');
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
  `categories_id` int NOT NULL,
  `sub_category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sub_categories_categories1_idx` (`categories_id`),
  CONSTRAINT `fk_sub_categories_categories1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_categories`
--

LOCK TABLES `sub_categories` WRITE;
/*!40000 ALTER TABLE `sub_categories` DISABLE KEYS */;
INSERT INTO `sub_categories` VALUES (1,1,'Desktop'),(2,1,'Laptop'),(3,1,'Printer'),(4,1,'Others'),(5,2,'Internet Access'),(6,2,'LAN'),(7,2,'Network Sharing'),(8,2,'Others'),(9,3,'Payroll'),(10,3,'eNGAS'),(11,3,'HR System'),(12,3,'DTR System'),(13,3,'Others'),(14,4,'O365 Account'),(15,4,'IHRIS'),(16,4,'eNGAS'),(17,4,'iMMIS'),(18,4,'Others'),(19,5,'O365 Account'),(20,5,'IHRIS'),(21,5,'eNGAS'),(22,5,'iMMIS'),(23,5,'Others'),(24,6,'Graphics'),(25,6,'Video Editing'),(26,6,'Pitch Deck/PPT Presentation'),(27,6,'Set up Venue'),(28,6,'Others'),(29,7,'Others'),(30,3,'iMMIS');
/*!40000 ALTER TABLE `sub_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_number` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) NOT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) NOT NULL,
  `date_birth` date NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `is_pwd` tinyint DEFAULT '0',
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `designation` varchar(150) DEFAULT NULL,
  `offices_id` int NOT NULL,
  `divisions_id` int NOT NULL,
  `client_types_id` int NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_exp` timestamp NULL DEFAULT NULL,
  `roles_id` int NOT NULL DEFAULT '3',
  `is_active` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_users_offices_idx` (`offices_id`),
  KEY `fk_users_divisions1_idx` (`divisions_id`),
  KEY `fk_users_client_types1_idx` (`client_types_id`),
  KEY `fk_users_roles1_idx` (`roles_id`),
  CONSTRAINT `fk_users_client_types1` FOREIGN KEY (`client_types_id`) REFERENCES `client_types` (`id`),
  CONSTRAINT `fk_users_divisions1` FOREIGN KEY (`divisions_id`) REFERENCES `divisions` (`id`),
  CONSTRAINT `fk_users_offices` FOREIGN KEY (`offices_id`) REFERENCES `offices` (`id`),
  CONSTRAINT `fk_users_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'COS6-004','Dan Alfrei','Celestial','Fuerte','2000-09-29','Male',1,'09818098637','dace.phage@gmail.com','Iloilo City','JO/COS',1,1,3,'user','$argon2i$v=19$m=65536,t=4,p=1$UWVxSWsyTkMuZ1dOdG0xdQ$K1XDCN1hqQqz3riRkonCXBi39TH5VT455w1lG+YC8jc',NULL,3,1,'2024-05-19 10:02:00','2024-05-19 10:02:00'),(2,'COS6-005','Kristopher Gerard','','Jovero','1993-06-17','Male',NULL,'','a@gmail.com','','',1,1,3,'user2','$argon2i$v=19$m=65536,t=4,p=1$MGFXVTBVYS9tRW9VR2FjNQ$mN8fn92ZQVBg8JA6mrujyS4rwp1iDtnOJPT+N8VO86o',NULL,3,1,'2024-05-20 03:00:39','2024-05-20 03:00:39');
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

-- Dump completed on 2024-05-20 13:08:01
