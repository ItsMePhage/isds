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
  `helpdesks_id` int DEFAULT NULL,
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
  CONSTRAINT `fk_csf_helpdesks_idx` FOREIGN KEY (`helpdesks_id`) REFERENCES `helpdesks` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisions`
--

LOCK TABLES `divisions` WRITE;
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` VALUES (1,'ORD'),(2,'CPD'),(3,'FAD'),(4,'BDD'),(5,'COA'),(6,'IDD'),(7,'DTI Aklan'),(8,'DTI Antique'),(9,'DTI Capiz'),(10,'DTI Guimaras'),(11,'DTI Iloilo'),(12,'DTI Negros Occidental');
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
  `status_hex` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `h_statuses`
--

LOCK TABLES `h_statuses` WRITE;
/*!40000 ALTER TABLE `h_statuses` DISABLE KEYS */;
INSERT INTO `h_statuses` VALUES (1,'Open','primary','#0d6efd'),(2,'Cancelled','danger','#dc3545'),(3,'Pending','warning','#ffc107'),(4,'Pre-repair','secondary','#adb5bd'),(5,'Completed','success','#198754'),(6,'Unserviceable','secondary','#adb5bd');
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
  `requested_by` int DEFAULT NULL,
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
  CONSTRAINT `fk_helpdesks_users1` FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_helpdesks_users2` FOREIGN KEY (`serviced_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_helpdesks_users3` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpdesks`
--

LOCK TABLES `helpdesks` WRITE;
/*!40000 ALTER TABLE `helpdesks` DISABLE KEYS */;
INSERT INTO `helpdesks` VALUES (1,'REQ-2024-01-001',4,'2024-01-08',1,1,1,'Reformat the PC for the new chief of BDD','2024-06-03 08:00:00',5,'',2,2,4,1,NULL,NULL,'2024-01-08 08:00:00','2024-01-08T08:00',1,1,'N/A','Reformat and optimize PC','N/A','2024-06-03 02:25:50',NULL);
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
  `audit_user` int DEFAULT NULL,
  `audit_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`audit_id`),
  KEY `fk_helpdesks_audit_users_idx` (`audit_user`),
  CONSTRAINT `fk_helpdesks_audit_users` FOREIGN KEY (`audit_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpdesks_audit`
--

LOCK TABLES `helpdesks_audit` WRITE;
/*!40000 ALTER TABLE `helpdesks_audit` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hosts`
--

LOCK TABLES `hosts` WRITE;
/*!40000 ALTER TABLE `hosts` DISABLE KEYS */;
INSERT INTO `hosts` VALUES (1,'RO'),(2,'Aklan'),(3,'Antique'),(4,'Capiz'),(5,'Guimaras'),(6,'Iloilo'),(7,'Negros Occidental');
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
  `status_hex` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_statuses`
--

LOCK TABLES `m_statuses` WRITE;
/*!40000 ALTER TABLE `m_statuses` DISABLE KEYS */;
INSERT INTO `m_statuses` VALUES (1,'Pending','warning','#ffc107'),(2,'Unavailable','secondary','#adb5bd'),(3,'Scheduled','success','#198754'),(4,'Cancelled','danger','#dc3545');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mediums`
--

LOCK TABLES `mediums` WRITE;
/*!40000 ALTER TABLE `mediums` DISABLE KEYS */;
INSERT INTO `mediums` VALUES (1,'DTI6 ISDS'),(2,'Email'),(3,'Intercom'),(4,'Messenger'),(5,'Walk-in');
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
  `requested_by` int DEFAULT NULL,
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
  CONSTRAINT `fk_meetings_users1` FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_meetings_users2` FOREIGN KEY (`generated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_meetings_users3` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
INSERT INTO `meetings` VALUES (1,'MTG-2024-05-001',1,'2024-05-29','asdasd','2024-05-29','15:54:00','16:54:00',NULL,1,'',NULL,NULL,'2024-05-29 07:54:17','2024-05-29 07:54:17');
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
  `audit_user` int DEFAULT NULL,
  `audit_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`audit_id`),
  KEY `fk_meetings_audit_users_idx` (`audit_user`),
  CONSTRAINT `fk_meetings_audit_users` FOREIGN KEY (`audit_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings_audit`
--

LOCK TABLES `meetings_audit` WRITE;
/*!40000 ALTER TABLE `meetings_audit` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `priority_levels`
--

LOCK TABLES `priority_levels` WRITE;
/*!40000 ALTER TABLE `priority_levels` DISABLE KEYS */;
INSERT INTO `priority_levels` VALUES (1,'Critical'),(2,'High'),(3,'Medium'),(4,'Low');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_classes`
--

LOCK TABLES `repair_classes` WRITE;
/*!40000 ALTER TABLE `repair_classes` DISABLE KEYS */;
INSERT INTO `repair_classes` VALUES (1,'Simple'),(2,'Medium'),(3,'Complex'),(4,'Technical'),(5,'Highly Technical');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_types`
--

LOCK TABLES `repair_types` WRITE;
/*!40000 ALTER TABLE `repair_types` DISABLE KEYS */;
INSERT INTO `repair_types` VALUES (1,'Minor'),(2,'Major');
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
  `username` varchar(45) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'MIS_Fuerte','Dan Alfrei','','Fuerte','2000-09-29','Male',NULL,'','dace.phage@gmail.com','','',1,1,3,'MIS_Fuerte','$argon2i$v=19$m=65536,t=4,p=1$a3RuNktPZ003WW1obkJERw$UH68X3h23PAQ453RcdTr6Jaz6JVqYFWQKooZOTbmZco',NULL,1,1,'2024-05-29 06:50:49','2024-06-06 02:02:06'),(2,'MIS_Patrimonio','Angelo','','Patrimonio','0001-01-01','Male',NULL,'','angelopatrimonio@dti.gov.ph','','',1,1,3,'MIS_Patrimonio','$argon2i$v=19$m=65536,t=4,p=1$WW11cmZxbFZlbDBETkxXbQ$g3Uhaz0GIvMJtIe8syH6lkkJ2Ca5N9N7S6ot808SRSs',NULL,1,1,'2024-05-29 06:52:47','2024-06-03 00:30:29'),(3,'MIS_Collado','Bemy John','','Collado','0001-01-01','Male',NULL,'','bemyjohncollado@dti.gov.ph','','',1,1,3,'MIS_Collado','$argon2i$v=19$m=65536,t=4,p=1$Z0tyd1dQTWxGNVVYQlc3Mw$3sokqlFFEwh/LGCQDhOd4zU1zpyRxRZ3NUKIg3xk8ag',NULL,1,1,'2024-05-29 07:49:10','2024-05-29 07:49:10'),(4,'','May Ann','','Arca','0001-11-11','Female',NULL,'','mayannarca560@gmail.com','','',1,4,3,'BDD_Arca','$argon2i$v=19$m=65536,t=4,p=1$WXpaY2hob1ZTdFFBSW1jUw$0+U4Lh7AUvrkeN/Db+088X8Vc4C+8VuVO7zbURkj/K0',NULL,3,1,'2024-06-03 02:16:00','2024-06-03 02:16:00');
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

-- Dump completed on 2024-06-07 17:40:43
