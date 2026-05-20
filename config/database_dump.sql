
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `target_type` varchar(50) DEFAULT NULL,
  `target_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_user` (`user_id`),
  KEY `idx_created` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` VALUES (1,NULL,'apply','New application from mahdi','application',1,'2026-05-20 20:02:30'),(2,1,'login','System Admin logged in','user',1,'2026-05-20 20:02:59'),(3,1,'accept','Application #1 marked as Approved','application',1,'2026-05-20 20:03:04'),(4,1,'create','Partner created from application: mahdi','partner',1,'2026-05-20 20:03:04'),(5,1,'update','Updated partner: mahdi','partner',1,'2026-05-20 20:19:34'),(6,1,'delete','Deleted partner: mahdi','partner',1,'2026-05-20 20:19:42'),(7,NULL,'apply','New application from mahdi','application',2,'2026-05-20 20:20:24'),(8,1,'accept','Application #2 marked as Approved','application',2,'2026-05-20 20:20:39'),(9,1,'create','Partner created from application: ubci','partner',2,'2026-05-20 20:20:39'),(10,1,'email_sent','Welcome email sent to mahdixaloui@gmail.com','partner',2,'2026-05-20 20:20:41'),(11,1,'accept','Application #2 marked as Approved','application',2,'2026-05-20 20:20:41'),(12,13,'login','mahdi logged in','user',13,'2026-05-20 20:22:55'),(13,13,'lead_create','Lead reserved: BNA','lead',1,'2026-05-20 20:24:32'),(14,1,'login','System Admin logged in','user',1,'2026-05-20 20:25:19'),(15,1,'accept','Partner mahdi was accepted','partner',2,'2026-05-20 20:25:37'),(16,1,'lead_approve','Lead #1 (BNA) marked as Approved','lead',1,'2026-05-20 20:31:10'),(17,1,'update','Updated partner: mahdi','partner',2,'2026-05-20 20:31:13'),(18,NULL,'apply','New application from ishak bakroui','application',3,'2026-05-20 20:33:13'),(19,1,'login','System Admin logged in','user',1,'2026-05-20 20:34:58'),(20,1,'accept','Application #3 marked as Approved','application',3,'2026-05-20 20:35:01'),(21,1,'create','Partner created from application: BH BANK','partner',3,'2026-05-20 20:35:01'),(22,1,'email_sent','Welcome email sent to bakraouiishak@gmail.com','partner',3,'2026-05-20 20:35:03'),(23,1,'accept','Application #3 marked as Approved','application',3,'2026-05-20 20:35:03'),(24,13,'login','mahdi logged in','user',13,'2026-05-20 20:37:41'),(25,13,'message_send','Message to BNA','lead',1,'2026-05-20 20:37:50'),(26,13,'login','mahdi logged in','user',13,'2026-05-20 20:41:12');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(150) NOT NULL,
  `website` varchar(200) DEFAULT NULL,
  `country` varchar(60) DEFAULT NULL,
  `company_size` varchar(50) DEFAULT NULL,
  `partner_type` varchar(80) DEFAULT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_email` varchar(150) NOT NULL,
  `contact_phone` varchar(30) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('Pending','Reviewed','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,'mahdi','','Tunisia','1–10 employees','Referral Partner','mahdi','mahdixaloui@gmail.com','','','Approved','2026-05-20 20:02:30'),(2,'ubci','','Tunisia','11–50 employees','Implementation Partner (Integrator)','mahdi','mahdixaloui@gmail.com','56213736','','Approved','2026-05-20 20:20:24'),(3,'BH BANK','','Tunisia','51–200 employees','Referral Partner','ishak bakroui','bakraouiishak@gmail.com','20300079','','Approved','2026-05-20 20:33:13');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `company` varchar(150) DEFAULT NULL,
  `country` varchar(60) DEFAULT NULL,
  `contact_type` varchar(50) DEFAULT NULL,
  `subject` varchar(80) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_is_read` (`is_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `lead_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `sender` enum('partner','lead') NOT NULL,
  `body` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_lead` (`lead_id`),
  KEY `idx_partner` (`partner_id`),
  KEY `idx_unread` (`is_read`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `lead_messages` WRITE;
/*!40000 ALTER TABLE `lead_messages` DISABLE KEYS */;
INSERT INTO `lead_messages` VALUES (1,1,2,'partner','hi',1,'2026-05-20 20:37:50');
/*!40000 ALTER TABLE `lead_messages` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `industry` varchar(60) DEFAULT NULL,
  `company_size` varchar(30) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `country` varchar(60) DEFAULT NULL,
  `contact_first_name` varchar(80) DEFAULT NULL,
  `contact_last_name` varchar(80) DEFAULT NULL,
  `contact_title` varchar(100) DEFAULT NULL,
  `contact_email` varchar(150) NOT NULL,
  `contact_phone` varchar(30) DEFAULT NULL,
  `project_types` varchar(255) DEFAULT NULL,
  `budget_range` varchar(30) DEFAULT NULL,
  `timeline` varchar(30) DEFAULT NULL,
  `decision_maker` tinyint(1) DEFAULT 0,
  `notes` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_partner` (`partner_id`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `leads` WRITE;
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
INSERT INTO `leads` VALUES (1,2,'BNA','Banking','1-10','','','ahmed','Gharbi','','mahdialoui6969@gmail.com','','Other','<50K€','<3 months',1,'','Approved','2026-05-20 20:24:32');
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` varchar(500) DEFAULT NULL,
  `type` varchar(40) DEFAULT 'info',
  `link` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_user` (`user_id`),
  KEY `idx_unread` (`is_read`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,1,'New partner application','mahdi from mahdi applied.','application','#applications',1,'2026-05-20 20:02:30'),(2,1,'Application Approved','mahdi — mahdi','application','#applications',1,'2026-05-20 20:03:04'),(3,12,'Your profile was updated by an admin','Name/company/tier/contact details may have changed.','info','#profile',0,'2026-05-20 20:19:34'),(4,1,'New partner application','mahdi from ubci applied.','application','#applications',1,'2026-05-20 20:20:24'),(5,1,'Application Approved','mahdi — ubci','application','#applications',1,'2026-05-20 20:20:39'),(6,1,'Application Approved','mahdi — ubci','application','#applications',1,'2026-05-20 20:20:41'),(7,1,'New lead submitted','mahdi reserved: BNA','lead','#partners',1,'2026-05-20 20:24:32'),(8,13,'Lead reserved','“BNA” has been added to your pipeline.','success','#leads',1,'2026-05-20 20:24:32'),(9,1,'Partner accepted','mahdi was marked as accepted.','partner','#partners',1,'2026-05-20 20:25:37'),(10,13,'Your partner status is now Accepted','An admin updated your account status.','success','#profile',1,'2026-05-20 20:25:37'),(11,13,'Lead approved: BNA','An admin updated the status of this lead.','success','#leads',1,'2026-05-20 20:31:10'),(12,13,'Your profile was updated by an admin','Name/company/tier/contact details may have changed.','info','#profile',1,'2026-05-20 20:31:13'),(13,1,'New partner application','ishak bakroui from BH BANK applied.','application','#applications',1,'2026-05-20 20:33:13'),(14,1,'Application Approved','ishak bakroui — BH BANK','application','#applications',1,'2026-05-20 20:35:01'),(15,1,'Application Approved','ishak bakroui — BH BANK','application','#applications',1,'2026-05-20 20:35:03');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `country` varchar(60) DEFAULT NULL,
  `company` varchar(150) NOT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `company_size` varchar(30) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `type` enum('Banking Decision Maker','IT Manager','Local Integrator') NOT NULL,
  `tier` enum('Bronze','Silver','Gold') NOT NULL DEFAULT 'Bronze',
  `status` enum('Pending','Accepted','Stalled','Declined') NOT NULL DEFAULT 'Pending',
  `progress` int(11) NOT NULL DEFAULT 0,
  `admin_notes` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`),
  KEY `idx_tier` (`tier`),
  KEY `idx_type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT INTO `partners` VALUES (2,'mahdi','mahdixaloui@gmail.com','56213736','Tunisia','ubci','Banking','1-10','','','Local Integrator','Bronze','Accepted',85,'','2026-05-20 20:20:39','2026-05-20 20:31:13',NULL),(3,'ishak bakroui','bakraouiishak@gmail.com','20300079','Tunisia','BH BANK',NULL,'','',NULL,'Banking Decision Maker','Bronze','Accepted',85,NULL,'2026-05-20 20:35:01','2026-05-20 20:35:01',NULL);
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `period` varchar(40) DEFAULT NULL,
  `type` enum('Sales','Activity','Pipeline','Performance','Other') NOT NULL DEFAULT 'Activity',
  `content` text NOT NULL,
  `status` enum('Draft','Sent','Reviewed') NOT NULL DEFAULT 'Sent',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_partner` (`partner_id`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('partner','admin') NOT NULL DEFAULT 'partner',
  `partner_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_email` (`email`),
  KEY `idx_role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'System Admin','admin@bankerise.com','$2y$10$T8OapsW4MwPQ/P35v1E.tOqgfFLyqyNA44qIhAZgbf0sCXXy0ap66','admin',NULL,1,'2026-04-17 21:47:33','2026-05-20 20:34:58'),(13,'mahdi','mahdixaloui@gmail.com','$2y$10$XZFMJ6vpvZfwYJY1Nn.IsOf5a0M4XOJnA6.js9Q8O.Sv8Xo792qci','partner',2,1,'2026-05-20 20:20:39','2026-05-20 20:41:12'),(14,'ishak bakroui','bakraouiishak@gmail.com','$2y$10$gRM5EUzKrpFaViNRhSEs9uwtXxWrg/1h4k1sKMd.2204a2KBIylDm','partner',3,1,'2026-05-20 20:35:01',NULL);
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

