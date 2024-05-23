CREATE DATABASE  IF NOT EXISTS `dti6db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `dti6db`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: dti6db
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
-- Table structure for table `csf`
--

DROP TABLE IF EXISTS `csf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `csf` (
  `id` int NOT NULL AUTO_INCREMENT,
  `helpdesks_id` int NOT NULL,
  `criteria_a` int DEFAULT NULL,
  `criteria_b` int DEFAULT NULL,
  `criteria_c` int DEFAULT NULL,
  `criteria_d` int DEFAULT NULL,
  `overall` int DEFAULT NULL,
  `reasons` text,
  `comments` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_csf_helpdesks_idx_idx` (`helpdesks_id`),
  CONSTRAINT `fk_csf_helpdesks_idx` FOREIGN KEY (`helpdesks_id`) REFERENCES `helpdesks` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `csf`
--

LOCK TABLES `csf` WRITE;
/*!40000 ALTER TABLE `csf` DISABLE KEYS */;
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
  `status_color` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `h_statuses`
--

LOCK TABLES `h_statuses` WRITE;
/*!40000 ALTER TABLE `h_statuses` DISABLE KEYS */;
INSERT INTO `h_statuses` VALUES (1,'Open','primary'),(2,'Cancelled','danger'),(3,'Pending','warning'),(4,'Pre-repair','secondary'),(5,'Completed','success'),(6,'Unserviceable','secondary');
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
  CONSTRAINT `fk_helpdesks_categories` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `fk_helpdesks_h_statuses` FOREIGN KEY (`h_statuses_id`) REFERENCES `h_statuses` (`id`),
  CONSTRAINT `fk_helpdesks_mediums` FOREIGN KEY (`mediums_id`) REFERENCES `mediums` (`id`),
  CONSTRAINT `fk_helpdesks_priority_levels` FOREIGN KEY (`priority_levels_id`) REFERENCES `priority_levels` (`id`),
  CONSTRAINT `fk_helpdesks_repair_classes` FOREIGN KEY (`repair_classes_id`) REFERENCES `repair_classes` (`id`),
  CONSTRAINT `fk_helpdesks_repair_types` FOREIGN KEY (`repair_types_id`) REFERENCES `repair_types` (`id`),
  CONSTRAINT `fk_helpdesks_request_types` FOREIGN KEY (`request_types_id`) REFERENCES `request_types` (`id`),
  CONSTRAINT `fk_helpdesks_sub_categories` FOREIGN KEY (`sub_categories_id`) REFERENCES `sub_categories` (`id`),
  CONSTRAINT `fk_helpdesks_users1` FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_helpdesks_users2` FOREIGN KEY (`serviced_by`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_helpdesks_users3` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpdesks`
--

LOCK TABLES `helpdesks` WRITE;
/*!40000 ALTER TABLE `helpdesks` DISABLE KEYS */;
INSERT INTO `helpdesks` VALUES (16,'REQ-2024-05-001',1,'2024-05-23',1,1,1,'asdasd','2024-05-23 08:03:30',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-23 06:03:30',NULL);
/*!40000 ALTER TABLE `helpdesks` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `helpdesks_BEFORE_INSERT` BEFORE INSERT ON `helpdesks` FOR EACH ROW BEGIN
	DECLARE seq_num INT;
    DECLARE current_year_month VARCHAR(7);
    
    -- Get the current year and month from date_requested
    SET current_year_month = DATE_FORMAT(NEW.date_requested, '%Y-%m');
    
    -- Get the current max sequence number for the month
SELECT 
    IFNULL(MAX(CAST(SUBSTRING_INDEX(request_number, '-', - 1)
                AS UNSIGNED)),
            0) + 1
INTO seq_num FROM
    helpdesks
WHERE
    DATE_FORMAT(created_at, '%Y-%m') = current_year_month;
    
    -- Set the request number in the format REQ-YYYY-MM-NUM
    SET NEW.request_number = CONCAT(
        'REQ-', current_year_month, '-', LPAD(seq_num, 3, '0')
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `after_helpdesks_delete` AFTER DELETE ON `helpdesks` FOR EACH ROW BEGIN
  DECLARE audit_user_id INT;
  SET audit_user_id = @audit_user_id;

  INSERT INTO `helpdesks_audit` (
    `id`, `request_number`, `requested_by`, `date_requested`, `request_types_id`, 
    `categories_id`, `sub_categories_id`, `complaint`, `datetime_preferred`, 
    `h_statuses_id`, `property_number`, `priority_levels_id`, `repair_types_id`, 
    `repair_classes_id`, `mediums_id`, `serviced_by`, `approved_by`, `datetime_start`, 
    `datetime_end`, `is_pullout`, `is_turnover`, `diagnosis`, `action_taken`, 
    `remarks`, `created_at`, `updated_at`, `audit_action`, `audit_user`
  ) VALUES (
    OLD.`id`, OLD.`request_number`, OLD.`requested_by`, OLD.`date_requested`, OLD.`request_types_id`, 
    OLD.`categories_id`, OLD.`sub_categories_id`, OLD.`complaint`, OLD.`datetime_preferred`, 
    OLD.`h_statuses_id`, OLD.`property_number`, OLD.`priority_levels_id`, OLD.`repair_types_id`, 
    OLD.`repair_classes_id`, OLD.`mediums_id`, OLD.`serviced_by`, OLD.`approved_by`, OLD.`datetime_start`, 
    OLD.`datetime_end`, OLD.`is_pullout`, OLD.`is_turnover`, OLD.`diagnosis`, OLD.`action_taken`, 
    OLD.`remarks`, OLD.`created_at`, OLD.`updated_at`, 'DELETE', audit_user_id
  );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `helpdesks_audit`
--

DROP TABLE IF EXISTS `helpdesks_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `helpdesks_audit` (
  `audit_id` int NOT NULL AUTO_INCREMENT,
  `id` int NOT NULL,
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
  `audit_action` varchar(10) NOT NULL,
  `audit_user` int NOT NULL,
  `audit_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`audit_id`),
  KEY `fk_helpdesks_audit_users_idx` (`audit_user`),
  CONSTRAINT `fk_helpdesks_audit_users` FOREIGN KEY (`audit_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpdesks_audit`
--

LOCK TABLES `helpdesks_audit` WRITE;
/*!40000 ALTER TABLE `helpdesks_audit` DISABLE KEYS */;
INSERT INTO `helpdesks_audit` VALUES (1,11,'REQ-2024-03-001',1,'2024-03-21',1,1,2,'asdasd','2024-05-21 09:27:35',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-21 07:27:35',NULL,'DELETE',1,'2024-05-22 03:28:33'),(2,5,'REQ-2024-05-004',1,'2024-04-21',1,1,1,'asdasd','2024-05-21 15:04:00',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-21 07:04:49',NULL,'DELETE',1,'2024-05-22 03:30:06'),(3,10,'REQ-2024-04-001',1,'2024-04-21',1,2,7,'asdasd','2024-05-21 09:27:10',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-21 07:27:10',NULL,'DELETE',1,'2024-05-22 03:30:10'),(4,1,'REQ-2024-05-001',1,'2024-05-20',1,1,1,'asdasda',NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-20 05:30:02',NULL,'DELETE',1,'2024-05-22 03:30:14'),(5,3,'REQ-2024-05-002',1,'2024-05-21',1,1,1,'sadasd','2024-05-21 14:20:00',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-21 06:20:07',NULL,'DELETE',1,'2024-05-22 03:30:18'),(6,4,'REQ-2024-05-003',1,'2024-05-21',1,1,2,'asdasd','2024-05-21 08:24:13',5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-21 06:24:13',NULL,'DELETE',1,'2024-05-22 03:30:33'),(7,9,'REQ-2024-05-005',1,'2024-05-21',2,4,14,'asdasda','2024-05-21 09:26:55',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-21 07:26:55',NULL,'DELETE',1,'2024-05-22 03:30:37'),(8,14,'REQ-2024-05-003',1,'2024-05-23',1,1,2,'asdasdas','2024-05-23 04:57:47',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-23 02:57:47',NULL,'DELETE',1,'2024-05-23 03:10:37'),(9,13,'REQ-2024-05-002',1,'2024-05-22',1,1,3,'asdasd','2024-05-22 05:55:01',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-22 03:55:01',NULL,'DELETE',1,'2024-05-23 03:10:42'),(10,12,'REQ-2024-05-001',1,'2024-05-22',1,1,2,'asdasda','2024-05-22 05:47:37',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-22 03:47:37',NULL,'DELETE',1,'2024-05-23 03:10:46'),(11,15,'REQ-2024-05-004',1,'2024-05-23',1,2,7,'LOLs','2024-05-23 04:58:00',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-23 02:58:04',NULL,'DELETE',1,'2024-05-23 06:02:35');
/*!40000 ALTER TABLE `helpdesks_audit` ENABLE KEYS */;
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
  `status_color` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_statuses`
--

LOCK TABLES `m_statuses` WRITE;
/*!40000 ALTER TABLE `m_statuses` DISABLE KEYS */;
INSERT INTO `m_statuses` VALUES (1,'Pending','warning'),(2,'Unavailable','secondary'),(3,'Scheduled','success'),(4,'Cancelled','danger');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
INSERT INTO `meetings` VALUES (2,'MTG-2024-05-002',2,'2024-05-20',NULL,'2024-05-20','12:02:00','13:02:00',NULL,1,NULL,NULL,NULL,'2024-05-20 04:02:24','2024-05-20 04:02:24'),(8,'MTG-2024-05-003',1,'2024-05-22','sadasdasdasdwasdxczxcasdsadsada','2024-05-22','11:47:00','12:47:00',NULL,1,NULL,NULL,NULL,'2024-05-22 03:47:58','2024-05-22 03:47:58');
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `meetings_BEFORE_INSERT` BEFORE INSERT ON `meetings` FOR EACH ROW BEGIN
DECLARE seq_num INT;

    -- Get the current year and month
    SET @current_year_month = DATE_FORMAT(NOW(), '%Y-%m');

    -- Get the current max sequence number for the month
SELECT 
    IFNULL(MAX(CAST(SUBSTRING_INDEX(request_number, '-', - 1)
                AS UNSIGNED)),
            0) + 1
INTO seq_num FROM
    meetings
WHERE
    DATE_FORMAT(created_at, '%Y-%m') = @current_year_month;

    -- Set the request number in the format REQ-YYYY-MM-NUM
    SET NEW.request_number = CONCAT('MTG-', @current_year_month, '-', LPAD(seq_num, 3, '0'));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `after_meetings_delete` AFTER DELETE ON `meetings` FOR EACH ROW BEGIN
  DECLARE audit_user_id INT;
  SET audit_user_id = @audit_user_id;
  INSERT INTO `meetings_audit` (
    `id`, `request_number`, `requested_by`, `date_requested`, `topic`, 
    `date_scheduled`, `time_start`, `time_end`, `hosts_id`, `m_statuses_id`, 
    `meeting_details`, `generated_by`, `approved_by`, `created_at`, `updated_at`, 
    `audit_action`, `audit_user`
  ) VALUES (
    OLD.`id`, OLD.`request_number`, OLD.`requested_by`, OLD.`date_requested`, OLD.`topic`, 
    OLD.`date_scheduled`, OLD.`time_start`, OLD.`time_end`, OLD.`hosts_id`, OLD.`m_statuses_id`, 
    OLD.`meeting_details`, OLD.`generated_by`, OLD.`approved_by`, OLD.`created_at`, OLD.`updated_at`, 
    'DELETE', audit_user_id
  );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `meetings_audit`
--

DROP TABLE IF EXISTS `meetings_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meetings_audit` (
  `audit_id` int NOT NULL AUTO_INCREMENT,
  `id` int NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  `audit_action` varchar(10) NOT NULL,
  `audit_user` int NOT NULL,
  `audit_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`audit_id`),
  KEY `fk_meetings_audit_users_idx` (`audit_user`),
  CONSTRAINT `fk_meetings_audit_users` FOREIGN KEY (`audit_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings_audit`
--

LOCK TABLES `meetings_audit` WRITE;
/*!40000 ALTER TABLE `meetings_audit` DISABLE KEYS */;
INSERT INTO `meetings_audit` VALUES (1,1,'MTG-2024-05-001',1,'2024-05-20',NULL,'2024-05-20','11:59:00','12:59:00',NULL,1,NULL,NULL,NULL,'2024-05-20 03:59:53','2024-05-20 03:59:53','DELETE',1,'2024-05-22 03:39:17'),(2,3,'MTG-2024-05-003',1,'2024-05-20',NULL,'2024-05-21','13:53:00','14:53:00',NULL,1,NULL,NULL,NULL,'2024-05-20 05:54:00','2024-05-20 05:54:00','DELETE',1,'2024-05-22 03:39:32'),(3,4,'MTG-2024-05-004',1,'2024-05-20',NULL,'2024-05-20','17:59:00','18:59:00',NULL,1,NULL,NULL,NULL,'2024-05-20 05:55:33','2024-05-20 05:55:33','DELETE',1,'2024-05-22 03:39:37'),(4,5,'MTG-2024-05-005',1,'2024-05-20','asdasd','2024-05-20','13:56:00','14:56:00',NULL,1,NULL,NULL,NULL,'2024-05-20 05:56:40','2024-05-20 05:56:40','DELETE',1,'2024-05-22 03:39:42'),(5,6,'MTG-2024-05-006',1,'2024-05-22','asdasd','2024-05-23','08:51:00','09:51:00',NULL,1,NULL,NULL,NULL,'2024-05-22 00:51:36','2024-05-22 00:51:36','DELETE',1,'2024-05-22 03:39:46'),(6,7,'MTG-2024-05-007',1,'2024-05-22','Full Driver & Software Package','2024-05-22','08:51:00','09:51:00',NULL,1,NULL,NULL,NULL,'2024-05-22 00:52:02','2024-05-22 00:52:02','DELETE',1,'2024-05-22 03:39:50');
/*!40000 ALTER TABLE `meetings_audit` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'COS6-004','Dan Alfreis','Celestial','Fuerte','2000-09-29','Male',1,'09818098637','dace.phage@gmail.com','Iloilo City','JO/COS',1,5,1,'user','$argon2i$v=19$m=65536,t=4,p=1$STA1M2tYZnVydUJvN1FYVQ$tx6Nsvi/SmLl7JnYUpzppc/9ueAIiL1yEtrlP4DCGyU',NULL,3,1,'2024-05-19 10:02:00','2024-05-23 07:50:29'),(2,'COS6-005','Kristopher Gerard','','Jovero','1993-06-17','Male',NULL,'','a@gmail.com','','',1,1,3,'user2','$argon2i$v=19$m=65536,t=4,p=1$MGFXVTBVYS9tRW9VR2FjNQ$mN8fn92ZQVBg8JA6mrujyS4rwp1iDtnOJPT+N8VO86o',NULL,3,1,'2024-05-20 03:00:39','2024-05-20 03:00:39'),(3,'','Jane','','Doe','2001-01-01','Female',NULL,'','dace.phage@gmail2.com','','',1,1,3,'admin','$argon2i$v=19$m=65536,t=4,p=1$ay9ueC9yRHpPTmF5empydQ$8RK5zrLMml/3s/stQx8bOQs4g/pO2Jk4ALMkaHn33JY',NULL,1,1,'2024-05-22 04:00:10','2024-05-22 05:49:12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'dti6db'
--

--
-- Dumping routines for database 'dti6db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-23 18:07:56
