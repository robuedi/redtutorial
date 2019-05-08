-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: redtutorial
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.10.1

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
-- Table structure for table `activations`
--

DROP TABLE IF EXISTS `activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activations`
--

LOCK TABLES `activations` WRITE;
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
INSERT INTO `activations` VALUES (1,1,'V8jqz90oN2FbF4AFBFobpTUawnZxKzKo',1,'2019-01-12 23:58:45','2019-01-12 23:58:45','2019-01-12 23:58:45'),(3,3,'LQJDlKxh9llp9dQKPXNR3GS8HoHMnIA9',1,'2019-04-07 23:19:07','2019-04-07 23:19:07','2019-04-07 23:19:07'),(4,4,'C4dFZHqbwSk1Xcdib4kZQInCFyfmiTnf',1,'2019-04-14 16:32:41','2019-04-14 16:32:41','2019-04-14 16:32:41'),(5,5,'lv5oyfB1fdWa1NXmWL9v6d8FgvsGOAmt',1,'2019-04-17 20:57:53','2019-04-17 20:57:53','2019-04-17 20:57:53'),(6,6,'ZMHIZ3BIexzdjYbryXQJLZ3lCLMDgQZX',1,'2019-04-19 11:06:38','2019-04-19 11:06:38','2019-04-19 11:06:38'),(8,7,'DbcfrPzKYfav8iG70WFI7zQ0iO72IKmr',1,'2019-04-19 11:14:51','2019-04-19 11:14:51','2019-04-19 11:14:51'),(9,8,'XW0HlZwtWRNDwaWdAl9kiU9mwRGUQqlw',1,'2019-05-02 15:35:14','2019-05-02 15:34:56','2019-05-02 15:35:14');
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapters`
--

DROP TABLE IF EXISTS `chapters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `order_weight` double(6,2) NOT NULL,
  `is_public` tinyint(4) NOT NULL DEFAULT '0',
  `is_draft` tinyint(4) NOT NULL DEFAULT '1',
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chapters_parent_id_index` (`course_id`),
  KEY `chapters_order_weight_index` (`order_weight`),
  KEY `chapters_is_public_index` (`is_public`),
  KEY `chapters_is_draft_index` (`is_draft`),
  KEY `chapters_slug_index` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapters`
--

LOCK TABLES `chapters` WRITE;
/*!40000 ALTER TABLE `chapters` DISABLE KEYS */;
INSERT INTO `chapters` VALUES (2,1,'Overview',NULL,1.00,1,1,'overview','2019-03-04 20:23:01','2019-05-01 10:44:28'),(3,1,'Variables',NULL,2.00,1,1,'variables','2019-03-04 20:23:01','2019-05-01 11:19:03'),(4,1,'Operators',NULL,3.00,1,1,'operators','2019-03-04 20:23:01','2019-05-05 13:33:30'),(5,1,'Arrays',NULL,4.00,0,1,'arrays','2019-03-04 20:23:01','2019-03-16 15:58:17'),(6,1,'Conditional Statements (Control Structures)',NULL,5.00,0,1,'conditional-statements-control-structures','2019-03-04 20:23:01','2019-03-16 15:58:36'),(7,1,'Loops (Control Structures)',NULL,6.00,0,1,'loops-control-structures','2019-03-04 20:23:01','2019-03-16 15:58:46'),(8,1,'Functions',NULL,7.00,0,1,'functions','2019-03-04 20:23:01','2019-03-16 15:58:56'),(9,10,'Apache Web Server',NULL,8.00,1,0,'apache-web-server','2019-04-25 19:24:38','2019-05-02 15:31:38');
/*!40000 ALTER TABLE `chapters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_messages_name_index` (`name`),
  KEY `contact_messages_email_index` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
INSERT INTO `contact_messages` VALUES (1,'Eduard','edi_cristi3@yahoo.com','Hi','Test message','2019-04-11 21:26:12','2019-04-11 21:26:12'),(2,'florenti','angelaEnCulse@gmail.com','Mailing via the feedback form.','Good day!  redtutorial.com \r\n \r\nWe make available \r\n \r\nSending your business proposition through the feedback form which can be found on the sites in the Communication section. Contact form are filled in by our software and the captcha is solved. The superiority of this method is that messages sent through feedback forms are whitelisted. This method raise the odds that your message will be read. Mailing is done in the same way as you received this message. \r\nYour  business proposition will be seen by millions of site administrators and those who have access to the sites! \r\n \r\nThe cost of sending 1 million messages is $ 49 instead of $ 99. (you can select any country or country domain) \r\nAll USA - (10 million messages sent) - $399 instead of $699 \r\nAll Europe (7 million messages sent)- $ 299 instead of $599 \r\nAll sites in the world (25 million messages sent) - $499 instead of $999 \r\n \r\n \r\nDiscounts are valid until April 30. \r\nFeedback and warranty! \r\nDelivery report! \r\nIn the process of sending messages we don\'t break the rules GDRP. \r\n \r\nThis message is automatically generated to use our contacts for communication. \r\n \r\n \r\n \r\nContact us. \r\nTelegram - @FeedbackFormEU \r\nSkype – FeedbackForm2019 \r\nEmail - FeedbackForm@make-success.com \r\n \r\n \r\nAll the best','2019-04-30 01:34:03','2019-04-30 01:34:03'),(3,'Rutenis Raila','rutenisraila@hotmail.com','Nice project','Hey,\r\n\r\nIt\'s Rutenis from Keepthinking, I found your side project, I think it\'s cool.  I\'m actually doing something similar myself:  www.treetarg.com/\r\n\r\nWould you like to collaborate? :D\r\n\r\nBest,\r\n\r\nRutenis','2019-05-03 21:40:36','2019-05-03 21:40:36'),(4,'Phasellus','phasellus@gmail.com','Nunc sit amet elit lectus','Donec gravida tincidunt lectus, ac lobortis massa laoreet a. Praesent auctor, lorem efficitur gravida varius, lorem mauris suscipit diam, sed imperdiet eros quam et odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In at aliquam quam, quis dapibus ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque molestie auctor risus in volutpat. Sed lacus metus, porta sit amet ante a, efficitur bibendum diam. Cras leo lacus, gravida a fringilla et, tempor mattis libero. Nunc ullamcorper urna quam. Sed tincidunt nulla at neque auctor, a dictum diam iaculis. Vivamus tincidunt viverra metus, non laoreet ipsum faucibus eu. Nunc sit amet elit lectus. Phasellus bibendum id erat eget mollis. Cras porttitor, lorem vel aliquam lacinia, ipsum dolor facilisis orci, nec ornare ex purus nec dui.','2019-05-04 10:44:13','2019-05-04 10:44:13');
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages_to_users`
--

DROP TABLE IF EXISTS `contact_messages_to_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages_to_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT '0',
  `is_flagged` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_messages_to_users_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages_to_users`
--

LOCK TABLES `contact_messages_to_users` WRITE;
/*!40000 ALTER TABLE `contact_messages_to_users` DISABLE KEYS */;
INSERT INTO `contact_messages_to_users` VALUES (1,1,1,0,0,1,'2019-04-11 21:26:12','2019-04-13 20:17:27'),(2,2,1,0,0,0,'2019-04-11 21:26:12','2019-04-11 21:26:12'),(3,1,2,1,0,0,'2019-04-30 01:34:03','2019-05-01 08:07:19'),(4,2,2,0,0,0,'2019-04-30 01:34:03','2019-04-30 01:34:03'),(5,6,2,0,0,0,'2019-04-30 01:34:03','2019-04-30 01:34:03'),(6,1,3,1,0,0,'2019-05-03 21:40:36','2019-05-04 09:07:08'),(7,2,3,0,0,0,'2019-05-03 21:40:36','2019-05-03 21:40:36'),(8,6,3,0,0,0,'2019-05-03 21:40:36','2019-05-03 21:40:36'),(9,1,4,1,0,0,'2019-05-04 10:44:13','2019-05-04 14:11:23'),(10,2,4,0,0,0,'2019-05-04 10:44:13','2019-05-04 10:44:13'),(11,6,4,0,0,0,'2019-05-04 10:44:13','2019-05-04 10:44:13');
/*!40000 ALTER TABLE `contact_messages_to_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `order_weight` double(6,2) NOT NULL,
  `is_draft` tinyint(4) NOT NULL DEFAULT '1',
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_id_index` (`id`),
  KEY `courses_order_weight_index` (`order_weight`),
  KEY `courses_is_draft_index` (`is_draft`),
  KEY `courses_slug_index` (`slug`),
  KEY `courses_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'PHP',1,'<p>This tutorial will help you to learn and understand PHP, the most popular programming language used in developing web applications.</p>','<p>In this tutorial&nbsp;you will&nbsp;<strong>learn the basics</strong> of PHP, as a beginner, and then move to more <strong>advance concepts as you progress</strong> through the course. The purpose of this course is to give you an <strong>easy way to understand PHP concepts</strong>&nbsp;and <strong>help you&nbsp;&nbsp;in building your own website</strong>.&nbsp;</p>',1.00,1,'php-tutorial','2019-01-19 16:10:34','2019-05-08 00:42:01'),(9,'SQL',0,NULL,'<p>Coming soon.</p>',2.00,1,'sql','2019-01-19 23:50:19','2019-04-25 19:58:12'),(10,'Ubuntu 18',1,'<p>Learn to set up and configure Ubuntu 18, manage your web server.</p>',NULL,3.00,1,'ubuntu-linux-tutorial','2019-04-25 19:23:36','2019-05-08 00:17:57');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses_statuses`
--

DROP TABLE IF EXISTS `courses_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` double(6,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_statuses_name_index` (`name`),
  KEY `courses_statuses_order_index` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses_statuses`
--

LOCK TABLES `courses_statuses` WRITE;
/*!40000 ALTER TABLE `courses_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `courses_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `from_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cc_address` text COLLATE utf8mb4_unicode_ci,
  `bcc_address` text COLLATE utf8mb4_unicode_ci,
  `email_subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_attachment` longtext COLLATE utf8mb4_unicode_ci,
  `sent_success` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_date` datetime NOT NULL,
  `retries` int(11) NOT NULL,
  `mailer_internal_id` text COLLATE utf8mb4_unicode_ci,
  `mailer_last_response` text COLLATE utf8mb4_unicode_ci,
  `skip_check_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emails_user_id_index` (`user_id`),
  KEY `emails_from_address_index` (`from_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lessons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `order_weight` double(6,2) NOT NULL,
  `is_public` tinyint(4) NOT NULL DEFAULT '0',
  `is_draft` tinyint(4) NOT NULL DEFAULT '1',
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lessons_id_index` (`id`),
  KEY `lessons_parent_id_index` (`chapter_id`),
  KEY `lessons_order_weight_index` (`order_weight`),
  KEY `lessons_is_public_index` (`is_public`),
  KEY `lessons_is_draft_index` (`is_draft`),
  KEY `lessons_slug_index` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons`
--

LOCK TABLES `lessons` WRITE;
/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;
INSERT INTO `lessons` VALUES (1,2,'Basic notions',NULL,1.00,1,1,'basic-notions','2019-01-19 21:56:04','2019-05-01 10:40:38'),(2,2,'Installation and configuration',NULL,2.00,0,1,'installation-and-configuration','2019-01-19 22:01:21','2019-01-20 17:10:25'),(3,3,'Variables',NULL,3.00,1,1,'variables','2019-01-19 22:16:15','2019-05-01 11:12:39'),(4,3,'Constants',NULL,4.00,1,1,'constants','2019-01-19 22:17:55','2019-05-01 11:14:19'),(5,3,'Data types',NULL,5.00,1,1,'data-types','2019-01-19 22:19:02','2019-05-01 11:15:53'),(6,4,'Operators for numeric values',NULL,6.00,1,1,'arithmetic-operators','2019-01-19 22:33:34','2019-05-01 11:21:24'),(8,4,'Comparison operators',NULL,8.00,1,1,'comparison-operators','2019-01-19 22:38:24','2019-05-01 11:23:48'),(9,4,'Logical operators',NULL,9.00,1,1,'logical-operators','2019-01-19 22:39:39','2019-05-05 13:33:30'),(10,5,'Indexed Arrays',NULL,10.00,1,1,'indexed-arrays','2019-01-19 22:43:55','2019-01-19 22:46:28'),(11,5,'Associative Arrays',NULL,11.00,1,1,'associative-arrays','2019-01-19 22:45:09','2019-01-19 22:45:09'),(12,5,'Multi-Dimensional Arrays',NULL,12.00,1,1,'multi-dimensional-arrays','2019-01-19 22:47:25','2019-01-19 22:47:25'),(13,6,'The if Statement',NULL,13.00,1,1,'if-statement','2019-01-19 22:54:47','2019-01-19 22:56:33'),(14,6,'The Ternary Operator',NULL,14.00,1,1,'the-ternary-operator','2019-01-19 22:55:59','2019-01-19 22:55:59'),(15,6,'The Null Coalescing Operator',NULL,15.00,1,1,'the-null-coalescing-operator','2019-01-19 22:57:21','2019-01-19 22:57:21'),(16,7,'while Loop',NULL,16.00,1,1,'while-loop','2019-01-19 23:06:51','2019-01-19 23:06:51'),(17,7,'do…while Loop',NULL,17.00,1,1,'do-while-loop','2019-01-19 23:07:30','2019-01-19 23:07:30'),(18,7,'for Loop',NULL,18.00,1,1,'for-loop','2019-01-19 23:07:56','2019-01-19 23:07:56'),(19,7,'foreach Loop',NULL,19.00,1,1,'foreach-Loop','2019-01-19 23:08:29','2019-01-19 23:08:29'),(20,2,'Syntax',NULL,2.00,1,1,'syntax','2019-01-20 17:12:43','2019-05-01 10:44:28'),(21,8,'User defined functions',NULL,20.00,1,1,'user-defined-functions','2019-03-03 18:05:33','2019-03-03 18:05:33'),(22,8,'Function arguments',NULL,21.00,1,1,'function-arguments','2019-03-03 18:06:14','2019-03-03 18:06:14'),(23,4,'Conditional assignment operators',NULL,22.00,0,1,'conditional-assignment-operators','2019-03-03 20:36:24','2019-03-16 16:00:57'),(24,3,'Data types - part 2',NULL,23.00,1,1,'data-types-part-2','2019-03-09 20:11:30','2019-05-01 11:19:03'),(25,9,'How to install the Apache Web Server',NULL,24.00,1,1,'how-to-install-the-apache-web-server','2019-04-25 19:29:04','2019-05-02 15:31:38');
/*!40000 ALTER TABLE `lessons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessons_sections`
--

DROP TABLE IF EXISTS `lessons_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lessons_sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_weight` double(6,2) NOT NULL,
  `is_public` tinyint(4) NOT NULL DEFAULT '0',
  `is_draft` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lessons_sections_lesson_id_index` (`lesson_id`),
  KEY `lessons_sections_type_index` (`type`),
  KEY `lessons_sections_is_public_index` (`is_public`),
  KEY `lessons_sections_is_draft_index` (`is_draft`),
  KEY `lessons_sections_order_weight_index` (`order_weight`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons_sections`
--

LOCK TABLES `lessons_sections` WRITE;
/*!40000 ALTER TABLE `lessons_sections` DISABLE KEYS */;
INSERT INTO `lessons_sections` VALUES (1,1,'What is PHP?','<p>The name&nbsp;PHP stands for <strong>PHP: Hypertext Preprocessor</strong>. PHP is an open source programming language (everyone is free to use it and modify it) used on the <strong>server-side</strong> (it needs to runned by a server application).</p>\r\n\r\n<p>PHP it&#39;s&nbsp;particularly used in building <strong>web applications</strong> and it can&nbsp;be integrated with HTML.&nbsp;</p>','text','checkbox',1.00,1,1,'2019-01-20 15:19:24','2019-03-09 19:43:08'),(2,1,NULL,'<p>What does the acronym PHP stands for?</p>','quiz','radio',2.00,1,0,'2019-01-20 15:42:23','2019-01-20 16:26:17'),(3,1,NULL,'<p>PHP&nbsp;was&nbsp;created by&nbsp;Rasmus Lerdorf in&nbsp;1994. Since then it evolved with every new release,&nbsp;it&#39;s current&nbsp;major version is&nbsp;<strong>7</strong>.</p>','text','checkbox',3.00,1,1,'2019-01-20 16:42:06','2019-03-09 19:44:07'),(4,1,NULL,'<p>What is the latest major version of PHP?</p>','quiz','radio',4.00,1,1,'2019-01-20 16:43:53','2019-01-20 16:45:07'),(7,2,NULL,'<p>PHP is server-side programming language. If you want to use it, you will&nbsp;need to install a local server.</p>\r\n\r\n<p>To do that, you can install the XAMPP application from here&nbsp;<a href=\"https://www.apachefriends.org\" target=\"_blank\">https://www.apachefriends.org</a>.</p>\r\n\r\n<p>&nbsp;</p>','text','checkbox',1.00,0,1,'2019-01-20 17:02:53','2019-01-20 17:10:11'),(8,20,NULL,'<p>To tell to the server that our scripts from&nbsp;a file represents PHP we need to include them between <strong>&lt;?php</strong>&nbsp;and <strong>?&gt;</strong>.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>A PHP file must also have the extension <strong>.php</strong>&nbsp;at the ending of it&#39;s name, like &quot;contact_us.php&quot;.</p>','text','checkbox',1.00,1,0,'2019-01-20 17:14:26','2019-05-01 10:42:54'),(9,20,NULL,'<p>What are the delimiters for the PHP scripts?</p>','quiz','radio',2.00,1,1,'2019-01-20 17:15:30','2019-01-20 17:16:41'),(10,20,'Comments','<p>When writing PHP code we may want to add some <strong>explanation&nbsp;lines</strong>&nbsp;or just add some <strong>short descriptions</strong>. This is&nbsp;a thing that it&#39;s quite encouraged, this way you or somebody else will understand better and easier the purpose of your code.</p>\r\n\r\n<p>The <strong>server will not&nbsp;use the comments</strong>, it will treat them as they don&#39;t exist among the code.</p>\r\n\r\n<p>To add a single line of comment use <strong>//</strong>&nbsp;at the beginning of the line.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n//This is a single line of comment\r\n\r\n?&gt;</code></pre>','text','checkbox',3.00,1,0,'2019-01-20 17:20:59','2019-05-01 10:43:51'),(12,20,NULL,'<p>How must a single line of comment&nbsp;start in PHP?</p>','quiz','radio',4.00,1,1,'2019-01-20 17:34:33','2019-01-20 17:36:54'),(13,20,NULL,'<p>If you need to add&nbsp;longer comments you can use&nbsp;the delimeters <strong>/*</strong>, that marks the start, and <strong>*/</strong>&nbsp;that marks the end of the comment.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n/* This is the first line\r\nhere is the second line\r\n\r\nand here is the last line\r\n*/\r\n\r\n?&gt;</code></pre>','text','checkbox',5.00,1,0,'2019-01-20 17:38:05','2019-05-01 10:44:28'),(15,20,NULL,'<p>How do you add comments in PHP?</p>','quiz','checkbox',6.00,1,1,'2019-01-20 17:44:50','2019-01-20 17:45:43'),(16,3,'Intro','<p>The <strong>variables</strong> are used as containers, like boxes, where we can keep <strong>values</strong>.</p>\r\n\r\n<p>Their names should always have&nbsp;the <strong>$</strong>&nbsp;symbol&nbsp;at the beginning, followed by a letter or &quot;_&quot; (underscore). After that you can either use letters, numbers or underscore, like &quot;$first_name&quot; or &quot;$_address1&quot;. Beside underscore no other special characters (like &quot;+, -, *, %&nbsp;...&quot;) are allowed for&nbsp;the name.</p>\r\n\r\n<p>The names are <strong>case sensitive </strong>(PHP makes the difference between uppercase and lowercase letters of the name),&nbsp;so PHP&nbsp;will see&nbsp;&quot;$movieName&quot; as one variable and &quot;$moviename&quot; as another variable.&nbsp;</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n//examples of variables\r\n$first_name = \'Edward\';\r\n\r\n$description = \'This is a PHP course\';\r\n\r\n$month_number = 11;\r\n\r\n\r\n?&gt;</code></pre>','text','checkbox',1.00,1,0,'2019-01-26 23:46:01','2019-05-01 11:12:39'),(17,3,NULL,'<p>Which variable names are correct?</p>','quiz','checkbox',2.00,1,0,'2019-01-27 00:12:29','2019-01-27 00:19:06'),(18,3,NULL,'<p>As their names&nbsp;suggests (&quot;variables&quot;)&nbsp;we can change the content of a variable as many times as we want, <strong>the content&nbsp;is variable</strong>. We can also assign the value from one variable to another one.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?\r\n\r\n$fruit = \'apple\';\r\n\r\n$fruit = \'mango\';\r\n\r\n$tropical_fruit = $fruit;\r\n\r\n//it will display the value \'mango\'\r\necho $tropical_fruit;\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>The semicolor symbol <strong>;</strong>&nbsp;is required to signal the end of an line instruction.</p>\r\n\r\n<p><em>We use <strong>echo</strong>&nbsp;when we want to output a value.&nbsp;</em></p>','text','checkbox',3.00,1,0,'2019-01-27 00:22:56','2019-03-09 20:00:56'),(20,3,NULL,'<p>How many times&nbsp;we can change the value of a variable?</p>','quiz','radio',4.00,1,1,'2019-01-27 00:37:41','2019-03-09 20:01:50'),(22,4,'Intro','<p>As the name already says, opposite to the variables, the constant&#39;s <strong>value is constant</strong>, it doesn&#39;t change during the application&#39;s execution.</p>\r\n\r\n<p>To define a constant you need to use the function <strong>define()</strong>.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?\r\n\r\n//we create the constant PI\r\ndefine(\"PI\", 3.14);\r\n\r\necho PI;\r\n//will output 3.14\r\n\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>In the name of a constant we don&#39;t use&nbsp;the symbol $ at the beginning. Also, as a convention among programmers, their names are written with <strong>uppercase letters</strong>, to make them easier to identify.</p>\r\n\r\n<p><span class=\"marker\">Remember to use double quotations marks, <strong>&quot;&quot;</strong>, when defining the name inside the function define().</span></p>','text','checkbox',1.00,1,0,'2019-01-28 21:44:36','2019-03-09 19:56:46'),(23,4,NULL,'<p>What function we use to define constants?</p>','quiz','radio',2.00,1,1,'2019-01-29 23:08:50','2019-02-06 22:35:27'),(24,4,NULL,'<p>In order to check if a constant if defined you can use the function <strong>defined</strong>. This function will return <strong>1</strong> if the constant has been defined or <strong>0</strong> if it hasn&#39;t been defined.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n//check if the constant has been defined\r\necho defined(\"PI\")\r\n\r\n?&gt;</code></pre>','text','checkbox',3.00,1,1,'2019-02-07 00:32:01','2019-05-01 11:14:19'),(28,4,NULL,'<p>What value will output the function defined if the constant has been defined?</p>','quiz','radio',4.00,1,1,'2019-02-07 00:45:58','2019-02-07 00:46:31'),(29,5,'Intro','<p>In PHP applications we can work with multiple types of data. The variables can have the following types of data:</p>\r\n\r\n<ul>\r\n	<li><strong>Integer</strong></li>\r\n	<li><strong>Float</strong></li>\r\n	<li><strong>String</strong></li>\r\n	<li><strong>Boolean</strong></li>\r\n	<li><strong>Array</strong></li>\r\n	<li><strong>Object</strong></li>\r\n	<li><strong>Resource</strong></li>\r\n	<li><strong>NULL</strong></li>\r\n</ul>\r\n\r\n<p>By default, the variables don&#39;t have any type of data assign to them,&nbsp;the <strong>PHP interpretor will&nbsp;evaluate and cast their type at the run-time</strong> (the moment of script&#39;s execution).&#39;</p>\r\n\r\n<p>You can check the type of a variable using <strong>gettype()</strong>.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$name = \'Johnny\';\r\n$price = 56;\r\n\r\necho gettype($name);\r\n//will output string\r\n\r\necho gettype($price);\r\n//will output integer\r\n\r\n?&gt;</code></pre>','text','checkbox',1.00,1,1,'2019-02-07 00:56:01','2019-05-01 11:15:53'),(30,5,NULL,'<p>The PHP interpretor will evaluate the variables and cast their type at the run-time.</p>','quiz','radio',2.00,1,1,'2019-02-10 19:44:59','2019-02-10 19:53:31'),(31,5,'Integer and Float Type','<p>Integer and&nbsp; Float&nbsp;types are used for numeric values.</p>\r\n\r\n<p>The <strong>integer type is for non-decimal values</strong>, between&nbsp;-2,147,483,648 and 2,147,483,647. They can be either positive or negative.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$month_number = 11;\r\n\r\n$temperature = -16;\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>The <strong>float type (also known as double)&nbsp;is used for numbers with a decimal point</strong>. You can convert a&nbsp;float number to an integer using the cast operator (int) (returns the number without decimal).</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\n\r\n//the float variable\r\n$price = 22.89;\r\n\r\n//get the integer value of the $price\r\n$integer_price = (int)$price;\r\n\r\n//will return 22\r\necho $integer_price;\r\n\r\n?&gt;</code></pre>','text','checkbox',3.00,1,1,'2019-02-10 19:58:32','2019-03-09 20:18:41'),(32,5,NULL,'<p>What type of value is the number 456.72?</p>','quiz','radio',4.00,1,1,'2019-02-10 20:37:08','2019-02-10 20:39:21'),(33,5,'String Type','<p>A <strong>string is represented by a series of characters</strong>. There is no rule for the maximum number of characters a string may have. Compared with integer or float, a string can have any type of character. A string normally starts with <strong>&#39;</strong>&nbsp;and ends with <strong>&#39;</strong> or <strong>&quot;</strong> and ends with <strong>&quot;</strong>.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$address = \'8th Street, nr. 36\';\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>When using double quotes we may also pass a variable&#39;s value&nbsp;into the string.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$name = \'Mike\';\r\n\r\n$age  = 32;\r\n\r\n$person_description = \"His name is $name, and he\'s $age years old.\";\r\necho $person_description;\r\n// this will output \"His name is Mike, and he\'s 32 years old.\"\r\n\r\n?&gt;</code></pre>','text','checkbox',5.00,1,1,'2019-02-10 20:40:31','2019-03-09 20:18:59'),(34,5,NULL,'<p>Which type of quotes allow inserting the variables value into a&nbsp;string?</p>','quiz','radio',6.00,1,1,'2019-02-10 21:54:48','2019-02-10 21:56:44'),(36,5,NULL,'<p>&nbsp;When using double quotes we can also pass into strings special characters like:</p>\r\n\r\n<ul>\r\n	<li>\\n - line feed;</li>\r\n	<li>\\r -&nbsp;carriage return;</li>\r\n	<li>\\t -&nbsp;horizontal tab;</li>\r\n	<li>\\\\ - backslash;</li>\r\n	<li>\\$ - dollar sign;</li>\r\n</ul>\r\n\r\n<p>Both \\n and \\r are used to move the text to a new line.&nbsp;</p>\r\n\r\n<p><span class=\"marker\">To escape variables(just show their names not value) and&nbsp;double quotes or single quotes (depending on how you start and end the assigning&nbsp;of the text), or backslash you need to use backslash.</span></p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$apples = \'Green apples\';\r\n\r\n$shop_text = \"The price of the apples has increased with 60 percent \\nso now they are called \\$apples or business\\\\rich apples. \\n \\t - by \\\"Shop News\\\"\";\r\n\r\necho $shop_text;\r\n/*\r\nwill output\r\n\r\nThe price of the apples has increased with 60 percent \r\nso now they are called $apples or business\\rich apples. \r\n 	 - by \"Shop News\"\r\n\r\n- we added a new line with \\n\r\n- escaped the variable $apples so we didn\'t passed it\'s value into the string\r\n- escaped the backslash with backslash so \\r won\'t make a new line \r\n- added a tab with \\t\r\n- escaped double quotes with backslash\r\n*/\r\n\r\n?&gt;</code></pre>\r\n\r\n<p><em>It&#39;s recommended to put strings inside double quotes only when needed, as PHP will slightly need more time to check the content of a string inside double quotes than single quotes, so the script&#39;s execution with take slightly more time.</em></p>','text','checkbox',7.00,1,1,'2019-02-10 21:58:05','2019-02-10 22:06:28'),(38,5,NULL,'<p>What will be the output of the following lines:</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$name = \'Ethan\';\r\n\r\n$text = \"My $name is \\$name, web development is great.\";\r\n\r\necho $text;\r\n\r\n?&gt;</code></pre>','quiz','radio',8.00,1,1,'2019-02-10 22:26:32','2019-02-10 22:37:05'),(39,24,'Boolean Type','<p>Boolean variables have a logical value. The boolean value can be wither <strong>TRUE</strong> or <strong>FALSE</strong>.</p>\r\n\r\n<p>You can convert other types of values to boolean the cast operator&nbsp;<strong>(bool)</strong>, but in general you won&#39;t be needed to use it, PHP will recognize it&#39;s logical values. Values like 0 or empty strings will automatically be converted to False, while strings or number that have other values than 0 will be converted to True.</p>\r\n\r\n<p>These boolean values are case-insensitive for PHP, so you can either write TRUE, true or True, same with the FALSE.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$correct = true;\r\n\r\n$still_correct = (bool)\'Hello\';\r\n//this also has the value true;\r\n\r\n?&gt;</code></pre>','text','checkbox',9.00,1,0,'2019-02-16 23:09:22','2019-05-01 11:18:45'),(40,24,NULL,'<p>What is the boolean value of the number <strong>25</strong>?</p>','quiz','radio',10.00,1,1,'2019-02-16 23:30:49','2019-05-01 11:19:03'),(41,24,'NULL Type','<p><strong>NULL</strong>&nbsp;are the variables that don&#39;t have any value assigned to them, it represents the absence of any value.</p>\r\n\r\n<p>A variable can be&nbsp;NULL if:</p>\r\n\r\n<ul>\r\n	<li>it has been assign to the NULL value;</li>\r\n	<li>it hasn&#39;t been assign any value to it;</li>\r\n	<li>it&#39;s value has been removed using the function <strong>unset()</strong>;&nbsp;</li>\r\n</ul>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n\r\n$name;\r\n//it\'s null \r\n\r\n$address = null;\r\n//it\'s null\r\n\r\n$phone_number = \'0226565333222\';\r\n\r\nunset($phone_number);\r\n//it\'s null now\r\n\r\n?&gt;</code></pre>','text','checkbox',11.00,1,1,'2019-02-16 23:34:59','2019-03-09 20:20:01'),(42,24,NULL,'<p>How can you set a variable to NULL?</p>','quiz','checkbox',12.00,1,0,'2019-02-16 23:48:46','2019-02-16 23:55:40'),(43,6,'Arithmetic Operators','<p>Arithmetic operators are used to perform normal <strong>arithmetical operations</strong> among&nbsp;variables or variables and other mathematical values. With them you can perform addition, multiplication, subtraction etc.</p>\r\n\r\n<table>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Name</th>\r\n			<th scope=\"col\">Operator</th>\r\n			<th scope=\"col\">Example</th>\r\n			<th scope=\"col\">Result</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>Addition</td>\r\n			<td class=\"text-center\"><strong>+</strong></td>\r\n			<td>$a + $b</td>\r\n			<td>Sum of the variables $a and $b</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Subtraction</td>\r\n			<td class=\"text-center\"><strong>-</strong></td>\r\n			<td>$a - $b</td>\r\n			<td>Difference of the variables $a and $b</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Multiplication</td>\r\n			<td class=\"text-center\"><strong>*</strong></td>\r\n			<td>$a * $b</td>\r\n			<td>Product of the variables $a and $b</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Division</td>\r\n			<td class=\"text-center\"><strong>/</strong></td>\r\n			<td>$a / $b</td>\r\n			<td>Partition of variables $a and $b</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Modulus</td>\r\n			<td class=\"text-center\"><strong>%</strong></td>\r\n			<td>$a % $b</td>\r\n			<td>Remainder of the variable $a divided by $b</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Exponentiation</td>\r\n			<td class=\"text-center\"><strong>**</strong></td>\r\n			<td>$a ** $b</td>\r\n			<td>Result of raising the variable $a to the $b&#39;th power</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Practical example:&nbsp;</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$a = 10;\r\n$b = 4;\r\n\r\n//Addition\r\n$addition = $a + $b;\r\necho $addition.\"\\n\";\r\n// outputs 14\r\n\r\n$subtraction = $a - $b;\r\necho $subtraction.\"\\n\";\r\n//outputs 6\r\n\r\n$multiplication = $a * $b;\r\necho $multiplication.\"\\n\";\r\n//outputs 40\r\n\r\n$division = $a / $b;\r\necho $division.\"\\n\";\r\n//outputs 2.5\r\n\r\n$modulus = $a % $b;\r\necho $modulus.\"\\n\";\r\n/*outputs 2 \r\n  8 is the maximum multiplication number that 4 can have \r\n  inside 10, so we are left with remaining 2 */\r\n\r\n$exponentiation = $a ** $b;\r\necho $exponentiation.\"\\n\";\r\n//outputs 10000\r\n\r\n?&gt;</code></pre>','text','checkbox',1.00,1,1,'2019-02-17 00:28:23','2019-05-01 11:20:20'),(45,6,'Assignment Operators','<p>The assignment operator are used to <strong>write (assign) a numberic value to a variable</strong>. The default assignment operator in PHP is &quot;=&quot; and it assigns to the variable from the left side the value of the expression from the right side.</p>\r\n\r\n<table>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Assignment</th>\r\n			<th scope=\"col\">Equivalent</th>\r\n			<th scope=\"col\">Result</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>$a <strong>=</strong> $b</td>\r\n			<td>$a = $b</td>\r\n			<td>The variable from left will get the value of the expression from right</td>\r\n		</tr>\r\n		<tr>\r\n			<td>$a <strong>+=</strong> $b</td>\r\n			<td>$a = $a + $b</td>\r\n			<td>Addition</td>\r\n		</tr>\r\n		<tr>\r\n			<td>$a <strong>-=</strong> $b</td>\r\n			<td>$a = $a - $b</td>\r\n			<td>Subtraction</td>\r\n		</tr>\r\n		<tr>\r\n			<td>$a <strong>*=</strong> $b</td>\r\n			<td>$a = $a * $b</td>\r\n			<td>Multiplication</td>\r\n		</tr>\r\n		<tr>\r\n			<td>$a <strong>/=</strong> $b</td>\r\n			<td>$a = $a / $b</td>\r\n			<td>Division</td>\r\n		</tr>\r\n		<tr>\r\n			<td>$a <strong>%=</strong> $b</td>\r\n			<td>$a = $a % $b</td>\r\n			<td>Modulus</td>\r\n		</tr>\r\n	</tbody>\r\n</table>','text','checkbox',3.00,1,1,'2019-02-26 21:05:25','2019-05-01 11:20:47'),(46,6,NULL,'<p>What is the output of the following code?</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\n\r\n$a = 33;\r\n$b = 3;\r\n$c = 7;\r\n\r\n$a /= $b;\r\n$a %= $c;\r\n\r\necho $a;\r\n\r\n?&gt;</code></pre>','quiz','radio',4.00,1,1,'2019-02-26 21:05:59','2019-03-03 17:55:59'),(47,6,'Increment / Decrement Operators','<p>The incremental operator<strong>&nbsp;increments&nbsp;the variables value by 1</strong>. The decremental operator <strong>decrements&nbsp;the variable&#39;s value by 1</strong>.</p>\r\n\r\n<table>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Operator</th>\r\n			<th scope=\"col\">Name</th>\r\n			<th scope=\"col\">Result</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td><strong>++</strong>$a</td>\r\n			<td>Pre-increment</td>\r\n			<td>Increments $a by 1, then returns the value of $a</td>\r\n		</tr>\r\n		<tr>\r\n			<td>$a<strong>++</strong></td>\r\n			<td>Post-increment</td>\r\n			<td>Returns the value of $a, then increments $a by 1</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>--</strong>$a</td>\r\n			<td>Pre-decrement</td>\r\n			<td>Decrements $a by 1, then returns the value of $a</td>\r\n		</tr>\r\n		<tr>\r\n			<td>$a<strong>--</strong></td>\r\n			<td>Post-decrement</td>\r\n			<td>Returns the value of $a, then decrements $a by 1</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Practical example:</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$a = 5;\r\n\r\n++$a;\r\n//the value of $a is now 6\r\n\r\n$a++;\r\n//the value of $a is now 7\r\n\r\n--$a;\r\n//the value of $a is now 6\r\n\r\n$a--;\r\n//the value of $a is now 5\r\n\r\n$a = 5;\r\n$b = 0;\r\n$b = ++$a;\r\n/* the value of $b is 6 and also the value of $a is 6, \r\n   since $a has first been incremented by 1 \r\n   and then it\'s value has been returned to $b\r\n*/\r\n\r\n$a = 5;\r\n$b = 0;\r\n$b = $a++;\r\n/* the value of $b is 5 and the value of $a is 6, \r\n   since $a has first returned the initial value of 5\r\n   and then it\'s value has been incremented by 1 \r\n*/\r\n\r\n$a = 5;\r\n$b = 0;\r\n$b = --$a;\r\n/* the value of $b is 4 and also the value of $a is 4, \r\n   since $a has first been decremented by 1 \r\n   and then it\'s value has been returned \r\n*/\r\n\r\n$a = 5;\r\n$b = 0;\r\n$b = $a--;\r\n/* the value of $b is 5 and the value of $a is 4, \r\n   since $a has first returned the initial value of 5\r\n   and then it\'s value has been decremented by 1 \r\n*/\r\n\r\n?&gt;</code></pre>','text','checkbox',5.00,1,1,'2019-02-26 21:06:04','2019-05-01 11:21:24'),(48,6,NULL,'<p>Are the variables <strong>$a</strong> and <strong>$b</strong> equal at the end of the script?</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$a = 10;\r\n$b = 10;\r\n$c = 2;\r\n\r\n$a += $c++;\r\n\r\n$b++;\r\n++$b;\r\n\r\n//end of the script\r\n\r\n?&gt;</code></pre>','quiz','radio',6.00,1,1,'2019-02-26 21:06:58','2019-03-03 20:33:21'),(49,8,'Equal, Identical','<p>This operators are represented by:</p>\r\n\r\n<table>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Operator</th>\r\n			<th scope=\"col\">Name</th>\r\n			<th scope=\"col\">Example</th>\r\n			<th scope=\"col\">Result</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td><strong>==</strong></td>\r\n			<td>Equal</td>\r\n			<td>$a == $b</td>\r\n			<td>If the variable $a is equal with $b will return true</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>===</strong></td>\r\n			<td>Identical</td>\r\n			<td>$a === $b</td>\r\n			<td>If the variable $a is equal with $b and they are both the same data type (like both string, integer, bool etc.) will return true</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Beside the fact that both operators are checking if the variables are equal, the &#39;Identical&#39; operator check if they are also the same data type, like integer, string or bool.</p>\r\n\r\n<p>So, for PHP the string &quot;1&quot; is equal with the number 1, even though they are different data types, to be sure that they are also the same data type you need to use the &#39;Identical&#39; operator. Also,&nbsp;the number 0 (zero)&nbsp;is equal with the boolean value FALSE and&nbsp;with an empty string.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$a = 20;\r\n$b = \'20\';\r\n$c = 0;\r\n$d = false;\r\n\r\nvar_dump($a == $b);\r\n// returns bool(true), so it\'s true\r\n\r\nvar_dump($a === $b);\r\n/* \r\nreturns bool(false), because even though the \r\nvalue is 20 in both variables, the one from the left\r\nis integer and the one in from the right is string\r\n*/\r\n\r\nvar_dump($c == $d);\r\n// returns bool(true)\r\n\r\nvar_dump($c === $d); \r\n// returns bool(false)\r\n\r\n?&gt;</code></pre>\r\n\r\n<p><em>The PHP <strong>var_dump</strong> function is used to display a variable or value, same as with <strong>echo</strong>, but it will&nbsp;give more information about the structure and the data type of the variable.</em></p>','text','checkbox',1.00,1,1,'2019-02-26 21:09:30','2019-05-01 11:22:27'),(50,8,NULL,'<p>What will be the output of the comparison: 1&nbsp;== false ?</p>','quiz','radio',2.00,1,1,'2019-02-26 21:09:54','2019-03-09 20:48:34'),(51,8,'Not equal, Not identical','<p>As their names says, they check if two variables or value are not equal, and for the identical if they also have same data type. They are oposite to &#39;==&#39;&nbsp; and &#39;===&#39;.</p>\r\n\r\n<table>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Operator</th>\r\n			<th scope=\"col\">Name</th>\r\n			<th scope=\"col\">Example</th>\r\n			<th scope=\"col\">Result</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td><strong>!=</strong></td>\r\n			<td>Not equal</td>\r\n			<td>$a != $b</td>\r\n			<td>Wil return true if $a is not equal to $b</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>&lt;&gt;</strong></td>\r\n			<td>Not equal</td>\r\n			<td>$a &lt;&gt; $b</td>\r\n			<td>Wil return (same as !=) true if $a is not equal to $b</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>!==</strong></td>\r\n			<td>Not identical</td>\r\n			<td>$a !== $b</td>\r\n			<td>Wil return true if $a is not equal to $b, and they are not the same data type (like string, integer etc.)</td>\r\n		</tr>\r\n	</tbody>\r\n</table>','text','checkbox',3.00,1,1,'2019-02-26 21:09:59','2019-05-01 11:23:02'),(52,8,NULL,'<p>What value will this statement return: &#39;0&#39; !== false ?</p>','quiz','radio',4.00,1,1,'2019-02-26 21:11:04','2019-04-28 22:13:12'),(53,8,'Greater than, Less than / Or equal to','<p>This operators are:</p>\r\n\r\n<table>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Operator</th>\r\n			<th scope=\"col\">Name</th>\r\n			<th scope=\"col\">Example</th>\r\n			<th scope=\"col\">Result</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td><strong>&gt;</strong></td>\r\n			<td>Greater than</td>\r\n			<td>$a &gt; $b</td>\r\n			<td>If $a is greater than $b returns true</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>&lt;</strong></td>\r\n			<td>Less than</td>\r\n			<td>$a &lt; $b</td>\r\n			<td>If $a is less than $b returns true</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>&gt;=</strong></td>\r\n			<td>Greater than or equal to</td>\r\n			<td>$a &gt;= $b</td>\r\n			<td>If $a is greater than or equal to $b returns true</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>&lt;=</strong></td>\r\n			<td>Less than or equal to</td>\r\n			<td>$a &lt;= $b</td>\r\n			<td>If $a is less than or equal to $b returns true</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>To make their role more explicit please check the example bellow:</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$a = 10;\r\n$b = 7;\r\n$c = 10;\r\n\r\nvar_dump($a &gt; $b);\r\n//will output true\r\n\r\nvar_dump($a &lt; $b);\r\n//will output false\r\n\r\nvar_dump($a &gt;= $b);\r\n//will output true \r\n//since $a it\'s bigger than $b\r\n\r\nvar_dump($a &lt;= $b);\r\n//will output false\r\n//since $a it\'s neither less than $b or equal to $b\r\n\r\nvar_dump($a &gt;= $c);\r\n//will output true\r\n//since they are equal\r\n\r\nvar_dump($b &gt;= $c);\r\n//will output true\r\n//since $b it\'s neither bigger than $c or equal to $c\r\n\r\n?&gt;</code></pre>','text','checkbox',5.00,1,1,'2019-02-26 21:11:17','2019-03-09 20:42:58'),(54,8,NULL,'<p>What will be output of the following comparison:</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$a = -10;\r\n$b = 0;\r\n\r\nvar_dump($a &lt;= $b);\r\n\r\n?&gt;</code></pre>','quiz','radio',6.00,1,1,'2019-02-26 21:13:23','2019-05-01 11:23:48'),(55,6,NULL,'<p>What is the output othe following code:</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\n\r\n$a = 15;\r\n\r\necho ($a % 13)**2;\r\n\r\n?&gt;</code></pre>','quiz','radio',2.00,1,1,'2019-03-03 16:52:22','2019-03-03 16:58:46'),(56,21,'Returning function\'s values',NULL,'text','checkbox',1.00,0,1,'2019-03-03 18:07:23','2019-03-03 18:07:55'),(57,23,'Thernary Operator',NULL,'text','checkbox',1.00,1,1,'2019-03-03 20:36:42','2019-03-03 20:37:05'),(58,23,NULL,NULL,'text',NULL,2.00,0,1,'2019-03-03 20:37:12','2019-03-03 20:37:12'),(59,23,'Null coalescing operator',NULL,'text','checkbox',3.00,1,1,'2019-03-03 20:37:16','2019-03-03 20:37:40'),(60,8,'Spaceship operator','<p>The spaceship operator <strong>&lt;=&gt;</strong>, like $a &lt;=&gt; $b, was introduced in PHP 7. It returns -1 if the variable from the left is smaller, 0 if the variables are equal, and&nbsp; 1 if the variable from the left is bigger.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$a = 10;\r\n$b = 5;\r\n\r\necho $a &lt;=&gt; $b;\r\n//will return 1\r\n//since $a is bigger than $b\r\n\r\n$c = 12;\r\n$d = 12;\r\n\r\necho $c &lt;=&gt; $d;\r\n//will return 0\r\n//since $c is equal to $d\r\n\r\n$e = 7;\r\n$f = 9;\r\n\r\necho $e &lt;=&gt; $f;\r\n//will return -1\r\n//since $e is smaller than $f</code></pre>','text','checkbox',7.00,1,0,'2019-03-09 18:42:19','2019-04-16 19:51:10'),(62,8,NULL,'<p>What is the output of the following script?</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\necho 12 &lt;=&gt; 9;</code></pre>','quiz','radio',8.00,1,0,'2019-04-16 19:39:09','2019-04-16 19:47:13'),(63,9,'Intro','<p>Logical operators are used to check multiple conditions.</p>\r\n\r\n<p>For example we want to check in the same time if a variable is bigger than 5 and also to check if another variable is not empty. If the conditions are meet than the operator will return <strong>true</strong>, else it will return&nbsp;<strong>false</strong>.</p>\r\n\r\n<p>Values that represent false are:</p>\r\n\r\n<ul>\r\n	<li>the FALSE value itself;</li>\r\n	<li>the numeric value 0;</li>\r\n	<li>empty strings and the strings with the value &#39;0&#39;;</li>\r\n	<li>arrays with zero elements;</li>\r\n	<li>the NULL value;</li>\r\n</ul>\r\n\r\n<p>As long as your variable doesn&#39;t has those values it&#39;s true;</p>\r\n\r\n<p>The logical operators are:&nbsp;</p>\r\n\r\n<table>\r\n	<thead>\r\n		<tr>\r\n			<th>Name</th>\r\n			<th>Operator</th>\r\n			<th class=\"white-space-nowrap\">Example</th>\r\n			<th>Result</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>And</td>\r\n			<td><strong>&amp;&amp;</strong><br />\r\n			same as<br />\r\n			<strong>and</strong></td>\r\n			<td>$a &amp;&amp; $b<br />\r\n			$a and $b</td>\r\n			<td>If both $a and $b are true it will return true, else it will return false</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Or</td>\r\n			<td><strong>||</strong><br />\r\n			same as<br />\r\n			<strong>or</strong></td>\r\n			<td>$a || $b<br />\r\n			$a or $b</td>\r\n			<td>If both $a and $b are true it will return true, also if&nbsp;either&nbsp;$a or $b is true it will return true, else it will return false</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xor</td>\r\n			<td><strong>xor</strong></td>\r\n			<td>$a xor $b</td>\r\n			<td>If&nbsp;either&nbsp;$a or $b is true, but not both in the same time, it will return true, else it will return false</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Not</td>\r\n			<td><strong>!</strong></td>\r\n			<td>!$a</td>\r\n			<td>If $a is true it will return false, if $a is false it will return true</td>\r\n		</tr>\r\n	</tbody>\r\n</table>','text','checkbox',1.00,1,0,'2019-04-19 15:07:26','2019-04-20 11:07:34'),(64,9,NULL,'<p>What type of value is&nbsp;a logical operator returning?</p>','quiz','radio',2.00,1,0,'2019-04-19 22:51:01','2019-04-19 22:53:08'),(65,9,'&& (and) Operator','<p>The <strong>And</strong> operator has the symbol <strong>&amp;&amp;</strong>, it can also be used&nbsp;<strong>and</strong>&nbsp;but the most common way is&nbsp;&#39;&amp;&amp;&#39;.</p>\r\n\r\n<p>This operator is useful when we want to be sure that all our conditions are met, since every conditions needs to be true.&nbsp;</p>\r\n\r\n<p>For example, in a registration form we want to be sure that the first name, last name and email are all not empty.</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\n\r\n$first_name = \'Alice\';\r\n\r\n$last_name = \'Wonderland\';\r\n\r\n$email = \'\';\r\n\r\nvar_dump($first_name &amp;&amp; $last_name &amp;&amp; $email);\r\n//will output false, since the variable $email is empty\r\n\r\n\r\n$email = \'alice@wonderland.com\';\r\n\r\nvar_dump($first_name &amp;&amp; $last_name &amp;&amp; $email);\r\n//will output true\r\n\r\n\r\n$pet_price = 20;\r\n$pet_name  = \'White Rabbit\';\r\n\r\n//check the pet name \r\n//and if the price is bigger than 5\r\nvar_dump($pet_price &gt; 5 &amp;&amp; $pet_name === \'White Rabbit\');\r\n//will return true\r\n\r\n$place_name = \'Wonderland\';\r\n$place_location = null;\r\n\r\n//check if we have values for the variables\r\nvar_dump($place_name &amp;&amp; $place_location);\r\n//will output false, since NULL means false to our operator\r\n\r\n\r\n?&gt;</code></pre>','text','checkbox',3.00,1,0,'2019-04-19 22:55:15','2019-05-01 11:25:14'),(67,9,NULL,'<p>What will return the following statement?</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\n\r\nvar_dump(\'And quiz\' &amp;&amp; 0 === false);\r\n\r\n?&gt;</code></pre>','quiz','radio',4.00,1,0,'2019-04-20 11:32:54','2019-05-05 13:33:30'),(68,9,'|| (Or) Operator','<p>The <strong>Or</strong>&nbsp;is using the symbol <strong>||</strong>, also there is the <strong>or</strong>&nbsp;symbol, but most commonly&nbsp; is used &#39;||&#39;.</p>\r\n\r\n<p>In order for this operator to return true at least one of the conditions must be true.</p>\r\n\r\n<p>As an practical example we may want to check if a user has entered as a contact method either his email or phone number.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$email = \'mike@redtutorial.com\';\r\n\r\n$phone_number = \'\';\r\n\r\n$address = \'\';\r\n\r\nvar_dump($phone_number || $email || $address);\r\n/* \r\nwill output true since the email is not empty, \r\neven though the $phone_number and the $address are empty\r\n*/\r\n\r\n$price = 125;\r\n$promo_code = \'DISCOUNT\';\r\n\r\nvar_dump($price &gt; 120 || $promo_code === \'DISCOUNT\');\r\n/* \r\nwill output true, even though at least one condition\r\nshould\'ve been true both are true\r\n*/\r\n\r\n$payment_method = \'cash\';\r\n\r\nvar_dump($payment_method === \'credit_card\' || $payment_method === \'paypal\');\r\n/*\r\nwill output false since not even at least one condition \r\nwas true\r\n*/\r\n\r\n?&gt;</code></pre>','text','checkbox',5.00,1,0,'2019-04-24 20:25:31','2019-04-24 20:51:20'),(70,9,NULL,'<p>Which of the following scripts will return true?</p>','quiz','checkbox',6.00,1,0,'2019-04-24 20:55:00','2019-04-24 21:00:32'),(71,25,'Installing Apache Web Server','<p>Since Apache can be found in the default&#39;s Ubuntu repositories we can install it using the normal package management tool like this:</p>\r\n\r\n<ul>\r\n	<li>First we are updating our local package index:</li>\r\n</ul>\r\n\r\n<pre>\r\n<code class=\"shell\">$ sudo apt update</code></pre>\r\n\r\n<ul>\r\n	<li>Next we install the apache2&nbsp;package using:</li>\r\n</ul>\r\n\r\n<pre>\r\n<code class=\"shell\">$ sudo apt install apache2</code></pre>\r\n\r\n<p>With just this commands we have installed the Apache Web Server on our environment.</p>','text','checkbox',1.00,1,0,'2019-04-25 19:30:33','2019-04-25 20:40:53'),(72,25,NULL,'<p>What&#39;s the name of the Apache Web Server repository package?</p>','quiz','radio',2.00,1,0,'2019-04-25 19:40:28','2019-04-25 19:42:14'),(73,25,'Checking the status, start, stop, restart, reload Apache Web Server','<p>To check the <strong>status</strong> of the Apache Web Server we use the command:</p>\r\n\r\n<pre>\r\n<code class=\"shell\">$ sudo systemctl status apache2</code></pre>\r\n\r\n<p>If we want to <strong>stop</strong> Apache Web Server we can use the following command:</p>\r\n\r\n<pre>\r\n<code class=\"shell\">$ sudo systemctl stop apache2 </code></pre>\r\n\r\n<p>To <strong>start</strong> again the server we may use:</p>\r\n\r\n<pre>\r\n<code class=\"shell\">$ sudo systemctl start apache2</code></pre>\r\n\r\n<p>We can also perform a stop and start again operation using a <strong>restart</strong> command while server running using:</p>\r\n\r\n<pre>\r\n<code class=\"shell\">$ sudo systemctl restart apache2</code></pre>\r\n\r\n<p>A similar command is reload. The difference between reload and restart if that we won&#39;t stop and start the Apache service, we will only reload the configuration while the server is running. This is recommanded if we want to update the server configuration while keeping it running. We can do this with:</p>\r\n\r\n<pre>\r\n<code class=\"shell\">$ sudo systemctl reload apache2\r\n</code></pre>','text','checkbox',3.00,1,0,'2019-04-25 19:42:21','2019-05-02 15:31:38'),(74,25,NULL,'<p>You just made some basic&nbsp;changes to your Apache server&#39;s configuration. What would be a good choice to load the new configuration while keeping it running?</p>','quiz','radio',4.00,1,0,'2019-04-26 00:37:27','2019-04-26 00:41:54'),(75,9,'xor Operator','<p>xor operator is similar to the or ( || ) operator but this time <strong>only one option needs to be true</strong>. In practice this operator is not so commonly used by developers as and, or and not operators.&nbsp;</p>\r\n\r\n<p>One practical example would be for example when having two inputs, lets say we have&nbsp;an article two write and there is a&nbsp;input for setting the article&nbsp;public and another one for setting it draft, and we need to choose only option.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$article_is_public = 1;\r\n$article_is_draft  = 1;\r\n\r\nvar_dump($article_is_public xor $article_is_draft);\r\n//will output false since both variables are true ( 1 equals with true when evaluated)\r\n\r\n$article_is_draft = 0;\r\n\r\nvar_dump($article_is_public xor $article_is_draft);\r\n//will output true since only article_is_public variable is true now</code></pre>','text','checkbox',7.00,1,0,'2019-05-05 13:11:17','2019-05-05 13:28:06'),(76,9,NULL,'<p>Which of the following statements are true?</p>','quiz','checkbox',8.00,1,0,'2019-05-05 13:26:49','2019-05-05 13:32:40');
/*!40000 ALTER TABLE `lessons_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessons_sections_options`
--

DROP TABLE IF EXISTS `lessons_sections_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lessons_sections_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lesson_section_id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_weight` double(6,2) NOT NULL,
  `is_valid` tinyint(4) NOT NULL DEFAULT '0',
  `is_public` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lessons_sections_options_lesson_section_id_index` (`lesson_section_id`),
  KEY `lessons_sections_options_order_weight_index` (`order_weight`),
  KEY `lessons_sections_options_is_public_index` (`is_public`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons_sections_options`
--

LOCK TABLES `lessons_sections_options` WRITE;
/*!40000 ALTER TABLE `lessons_sections_options` DISABLE KEYS */;
INSERT INTO `lessons_sections_options` VALUES (6,2,'1','Protected HiProcessor',1.00,0,1,'2019-01-20 16:26:17','2019-01-20 16:26:17'),(7,2,'2','PHP: Hypertext Preprocessor',2.00,1,1,'2019-01-20 16:26:17','2019-01-20 16:26:17'),(8,2,'3','Private Home Processor',3.00,0,1,'2019-01-20 16:26:17','2019-01-20 16:26:17'),(9,4,'a','19',1.00,0,1,'2019-01-20 16:45:07','2019-01-20 16:45:07'),(10,4,'b','4',2.00,0,1,'2019-01-20 16:45:07','2019-01-20 16:45:07'),(11,4,'c','7',3.00,1,1,'2019-01-20 16:45:07','2019-01-20 16:45:07'),(15,9,'a','<?php   ?>',1.00,1,1,'2019-01-20 17:16:41','2019-01-20 17:16:41'),(16,9,'b','<?code   ?>',2.00,0,1,'2019-01-20 17:16:41','2019-01-20 17:16:41'),(17,9,'c','<!   !>',3.00,0,1,'2019-01-20 17:16:41','2019-01-20 17:16:41'),(24,12,'a','//',1.00,1,1,'2019-01-20 17:36:54','2019-01-20 17:36:54'),(25,12,'b','??',2.00,0,1,'2019-01-20 17:36:54','2019-01-20 17:36:54'),(26,12,'c','>>',3.00,0,1,'2019-01-20 17:36:54','2019-01-20 17:36:54'),(31,15,'a','>> Comment',1.00,0,1,'2019-01-20 17:45:45','2019-01-20 17:45:45'),(32,15,'b','/* Comment */',2.00,1,1,'2019-01-20 17:45:45','2019-01-20 17:45:45'),(33,15,'c','// Comment',3.00,1,1,'2019-01-20 17:45:45','2019-01-20 17:45:45'),(34,15,'d','/ Comment //',4.00,0,1,'2019-01-20 17:45:45','2019-01-20 17:45:45'),(35,17,'a','#country_name',1.00,0,1,'2019-01-27 00:19:06','2019-01-27 00:19:06'),(36,17,'b','$lastName^',2.00,0,1,'2019-01-27 00:19:06','2019-01-27 00:19:06'),(37,17,'c','$color1',3.00,1,1,'2019-01-27 00:19:06','2019-01-27 00:19:06'),(38,17,'d','$1gender',4.00,0,1,'2019-01-27 00:19:06','2019-01-27 00:19:06'),(39,17,'e','$_dog_Breed',5.00,1,1,'2019-01-27 00:19:06','2019-01-27 00:19:06'),(44,23,'a','output()',1.00,0,1,'2019-02-06 22:35:27','2019-02-06 22:35:27'),(45,23,'b','set()',2.00,0,1,'2019-02-06 22:35:27','2019-02-06 22:35:27'),(46,23,'c','define()',3.00,1,1,'2019-02-06 22:35:27','2019-02-06 22:35:27'),(47,28,'a','1',1.00,1,1,'2019-02-07 00:46:31','2019-02-07 00:46:31'),(48,28,'b','2',2.00,0,1,'2019-02-07 00:46:31','2019-02-07 00:46:31'),(49,28,'c','3',3.00,0,1,'2019-02-07 00:46:31','2019-02-07 00:46:31'),(54,30,'a','True',1.00,1,1,'2019-02-10 19:53:31','2019-02-10 19:53:31'),(55,30,'b','False',2.00,0,1,'2019-02-10 19:53:31','2019-02-10 19:53:31'),(56,32,'a','Float',1.00,1,1,'2019-02-10 20:39:21','2019-02-10 20:39:21'),(57,32,'b','Integer',2.00,0,1,'2019-02-10 20:39:21','2019-02-10 20:39:21'),(58,34,'a','Single quotes (\')',1.00,0,1,'2019-02-10 21:56:44','2019-02-10 21:56:44'),(59,34,'b','Double quotes (\")',2.00,1,1,'2019-02-10 21:56:44','2019-02-10 21:56:44'),(68,38,'a','My name is Ethan, web development is great.',1.00,0,1,'2019-02-10 22:37:05','2019-02-10 22:37:05'),(69,38,'b','My $name is Ethan, web development is great.',2.00,0,1,'2019-02-10 22:37:05','2019-02-10 22:37:05'),(70,38,'c','My Ethan is $name, web development is great.',3.00,1,1,'2019-02-10 22:37:05','2019-02-10 22:37:05'),(71,38,'d','My Ethan is Ethan, web development is great.',4.00,0,1,'2019-02-10 22:37:05','2019-02-10 22:37:05'),(79,42,'a','$variable = null;',1.00,1,1,'2019-02-16 23:55:40','2019-02-16 23:55:40'),(80,42,'b','$variable = \'\';',2.00,0,1,'2019-02-16 23:55:40','2019-02-16 23:55:40'),(81,42,'c','$variable = 0;',3.00,0,1,'2019-02-16 23:55:40','2019-02-16 23:55:40'),(82,42,'d','unset($variable);',4.00,1,1,'2019-02-16 23:55:40','2019-02-16 23:55:40'),(83,42,'e','$variable = -1',5.00,0,1,'2019-02-16 23:55:40','2019-02-16 23:55:40'),(90,55,'a','246',1.00,0,1,'2019-03-03 16:58:46','2019-03-03 16:58:46'),(91,55,'b','48',2.00,0,1,'2019-03-03 16:58:46','2019-03-03 16:58:46'),(92,55,'c','4',3.00,1,1,'2019-03-03 16:58:46','2019-03-03 16:58:46'),(97,46,'a','3',1.00,0,1,'2019-03-03 17:55:59','2019-03-03 17:55:59'),(98,46,'b','4',2.00,1,1,'2019-03-03 17:55:59','2019-03-03 17:55:59'),(99,46,'c','6',3.00,0,1,'2019-03-03 17:55:59','2019-03-03 17:55:59'),(100,46,'d','11',4.00,0,1,'2019-03-03 17:55:59','2019-03-03 17:55:59'),(105,48,'a','Yes',1.00,1,1,'2019-03-03 20:33:21','2019-03-03 20:33:21'),(106,48,'b','No',2.00,0,1,'2019-03-03 20:33:21','2019-03-03 20:33:21'),(113,20,'1','One time',1.00,0,1,'2019-03-09 20:01:50','2019-03-09 20:01:50'),(114,20,'2','Two times',2.00,0,1,'2019-03-09 20:01:50','2019-03-09 20:01:50'),(115,20,'3','As many times as we want',3.00,1,1,'2019-03-09 20:01:50','2019-03-09 20:01:50'),(116,20,'4','Never',4.00,0,1,'2019-03-09 20:01:50','2019-03-09 20:01:50'),(123,62,'a','-1',1.00,0,1,'2019-04-16 19:47:13','2019-04-16 19:47:13'),(124,62,'b','0',2.00,0,1,'2019-04-16 19:47:13','2019-04-16 19:47:13'),(125,62,'c','1',3.00,1,1,'2019-04-16 19:47:13','2019-04-16 19:47:13'),(126,64,'a','String',1.00,0,1,'2019-04-19 22:53:08','2019-04-19 22:53:08'),(127,64,'b','Boolean',2.00,1,1,'2019-04-19 22:53:08','2019-04-19 22:53:08'),(128,64,'c','Integer',3.00,0,1,'2019-04-19 22:53:08','2019-04-19 22:53:08'),(132,70,'a','true == 1 || false === 0',1.00,1,1,'2019-04-24 21:00:32','2019-04-24 21:00:32'),(133,70,'b','0 || 1 || false',2.00,1,1,'2019-04-24 21:00:32','2019-04-24 21:00:32'),(134,70,'c','true === 1 || false === 0',3.00,0,1,'2019-04-24 21:00:32','2019-04-24 21:00:32'),(135,72,'a','apache',1.00,0,1,'2019-04-25 19:42:14','2019-04-25 19:42:14'),(136,72,'b','apache2',2.00,1,1,'2019-04-25 19:42:14','2019-04-25 19:42:14'),(141,74,'a','$ sudo systemctl status apache2',1.00,0,1,'2019-04-26 00:42:52','2019-04-26 00:42:52'),(142,74,'b','$ sudo systemctl start apache2',2.00,0,1,'2019-04-26 00:42:52','2019-04-26 00:42:52'),(143,74,'c','$ sudo systemctl reload apache2',3.00,1,1,'2019-04-26 00:42:52','2019-04-26 00:42:52'),(144,74,'d','$ sudo systemctl restart apache2',4.00,0,1,'2019-04-26 00:42:52','2019-04-26 00:42:52'),(147,50,'a','True',1.00,0,1,'2019-04-28 22:12:53','2019-04-28 22:12:53'),(148,50,'b','False',2.00,1,1,'2019-04-28 22:12:53','2019-04-28 22:12:53'),(149,52,'a','True',1.00,1,1,'2019-04-28 22:13:12','2019-04-28 22:13:12'),(150,52,'b','False',2.00,0,1,'2019-04-28 22:13:12','2019-04-28 22:13:12'),(153,40,'a','True',1.00,1,1,'2019-05-01 11:19:03','2019-05-01 11:19:03'),(154,40,'b','False',2.00,0,1,'2019-05-01 11:19:03','2019-05-01 11:19:03'),(157,54,'a','True',1.00,1,1,'2019-05-01 11:23:48','2019-05-01 11:23:48'),(158,54,'b','False',2.00,0,1,'2019-05-01 11:23:48','2019-05-01 11:23:48'),(161,76,'a','true xor true',1.00,0,1,'2019-05-05 13:32:40','2019-05-05 13:32:40'),(162,76,'b','false xor false xor true',2.00,1,1,'2019-05-05 13:32:40','2019-05-05 13:32:40'),(163,76,'c','false xor false xor false',3.00,0,1,'2019-05-05 13:32:40','2019-05-05 13:32:40'),(164,67,'a','True',1.00,0,1,'2019-05-05 13:33:30','2019-05-05 13:33:30'),(165,67,'b','False',2.00,1,1,'2019-05-05 13:33:30','2019-05-05 13:33:30');
/*!40000 ALTER TABLE `lessons_sections_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logins`
--

DROP TABLE IF EXISTS `logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logins` (
  `login_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `login_ip` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_date` datetime NOT NULL,
  `login_success` tinyint(4) NOT NULL DEFAULT '0',
  `logout_date` datetime DEFAULT NULL,
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`login_id`),
  KEY `logins_user_id_index` (`user_id`),
  KEY `logins_login_ip_index` (`login_ip`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logins`
--

LOCK TABLES `logins` WRITE;
/*!40000 ALTER TABLE `logins` DISABLE KEYS */;
INSERT INTO `logins` VALUES (1,1,'192.168.10.1','2019-01-17 21:55:20',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(2,1,'192.168.10.1','2019-01-19 13:12:10',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(3,1,'192.168.10.1','2019-01-19 16:10:09',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(4,1,'192.168.10.1','2019-01-19 21:39:21',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(5,1,'192.168.10.1','2019-01-20 02:34:18',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(6,1,'192.168.10.1','2019-01-20 14:30:03',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(7,1,'192.168.10.1','2019-01-20 21:37:51',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(8,1,'192.168.10.1','2019-01-26 23:32:40',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(9,1,'192.168.10.1','2019-01-28 20:41:12',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(10,1,'192.168.10.1','2019-01-29 23:01:11',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(11,1,'192.168.10.1','2019-02-06 22:32:34',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36'),(12,1,'192.168.10.1','2019-02-10 19:41:56',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36'),(13,1,'192.168.10.1','2019-02-16 23:07:32',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36'),(14,1,'192.168.10.1','2019-02-26 20:49:01',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.119 Safari/537.36'),(15,1,'192.168.10.1','2019-02-28 00:31:21',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.119 Safari/537.36'),(16,1,'192.168.10.1','2019-03-03 13:50:46',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36'),(17,1,'192.168.10.1','2019-03-09 18:38:56',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36'),(18,1,'192.168.10.1','2019-03-16 15:58:03',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36'),(19,1,'192.168.10.1','2019-03-16 23:50:36',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36'),(20,1,'192.168.10.1','2019-03-17 12:48:55',1,'2019-03-17 12:49:36','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36'),(21,1,'192.168.10.1','2019-03-17 18:47:11',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36'),(22,1,'192.168.10.1','2019-03-22 16:51:16',1,NULL,'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.75 Safari/537.36'),(23,1,'192.168.10.1','2019-04-06 17:20:11',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.75 Safari/537.36'),(24,3,'80.6.61.146','2019-04-07 23:19:25',1,NULL,'Mozilla/5.0 (Linux; Android 9; Pixel 2 XL) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.90 Mobile Safari/537.36'),(25,3,'80.6.61.146','2019-04-07 23:20:57',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.75 Safari/537.36'),(26,1,'80.6.61.146','2019-04-11 21:21:37',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.75 Safari/537.36'),(27,1,'80.6.61.146','2019-04-13 20:17:03',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.75 Safari/537.36'),(28,1,'82.132.221.235','2019-04-15 16:28:08',1,NULL,'Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1'),(29,1,'80.6.61.146','2019-04-15 21:14:31',1,'2019-04-15 21:16:30','Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1'),(30,1,'130.32.42.190','2019-04-16 11:52:14',1,NULL,'Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1'),(31,1,'80.6.61.146','2019-04-16 19:20:01',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.75 Safari/537.36'),(32,1,'80.6.61.146','2019-04-17 00:06:55',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.75 Safari/537.36'),(33,1,'82.132.223.72','2019-04-17 20:53:10',1,NULL,'Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1'),(34,5,'81.135.169.242','2019-04-17 20:58:36',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(35,1,'80.6.61.146','2019-04-19 11:03:16',1,'2019-04-19 11:09:16','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(36,3,'80.6.61.146','2019-04-19 11:09:48',1,'2019-04-19 11:13:33','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(37,1,'80.6.61.146','2019-04-19 14:32:00',1,'2019-04-19 15:00:59','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(38,1,'80.6.61.146','2019-04-19 15:01:08',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(39,1,'80.6.61.146','2019-04-19 22:15:31',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(40,1,'80.6.61.146','2019-04-20 09:53:05',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(41,1,'80.6.61.146','2019-04-24 20:25:14',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(42,1,'80.6.61.146','2019-04-25 19:20:45',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(43,1,'80.6.61.146','2019-04-26 00:32:57',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(44,1,'80.6.61.146','2019-04-27 17:23:22',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(45,1,'80.6.61.146','2019-04-28 22:09:11',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(46,1,'130.32.42.190','2019-05-01 08:07:04',1,NULL,'Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1'),(47,1,'130.32.42.190','2019-05-01 10:38:19',1,NULL,'Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1'),(48,1,'130.32.42.190','2019-05-02 15:30:13',1,'2019-05-02 15:33:06','Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1'),(49,8,'130.32.42.190','2019-05-02 15:35:38',1,'2019-05-02 15:35:50','Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1'),(50,8,'130.32.42.190','2019-05-02 15:36:17',1,'2019-05-02 15:37:03','Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1'),(51,1,'80.6.61.146','2019-05-04 09:05:59',1,'2019-05-04 11:03:37','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(52,1,'80.6.61.146','2019-05-04 13:14:11',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(53,3,'80.6.61.146','2019-05-05 01:12:35',1,NULL,'Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1'),(54,1,'80.6.61.146','2019-05-05 13:07:52',1,'2019-05-05 13:40:14','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(55,3,'80.6.61.146','2019-05-05 13:40:38',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(56,3,'80.6.61.146','2019-05-05 14:46:23',1,NULL,'Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1'),(57,3,'80.6.61.146','2019-05-05 17:26:50',1,'2019-05-05 20:13:22','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(58,3,'80.6.61.146','2019-05-05 20:13:33',1,'2019-05-05 20:13:46','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(59,3,'82.132.235.214','2019-05-05 20:38:23',1,'2019-05-05 20:39:39','Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1'),(60,3,'82.132.235.105','2019-05-06 09:52:51',1,'2019-05-06 12:00:01','Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1'),(61,3,'80.6.61.146','2019-05-06 11:00:15',1,'2019-05-06 11:00:27','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(62,1,'80.6.61.146','2019-05-07 23:54:22',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36'),(63,1,'80.6.61.146','2019-05-08 00:40:09',1,'2019-05-08 00:49:54','Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1');
/*!40000 ALTER TABLE `logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_files`
--

DROP TABLE IF EXISTS `media_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_files_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_files`
--

LOCK TABLES `media_files` WRITE;
/*!40000 ALTER TABLE `media_files` DISABLE KEYS */;
INSERT INTO `media_files` VALUES (1,'php_elephant.jpg','uploads/media_library/2019/01/php_elephant.jpg','/home/vagrant/Projects/redtutorial_prod/public/uploads/media_library/2019/01','jpg','2019-01-19 21:52:13','2019-01-19 21:52:13'),(2,'network_3396348_1280.jpg','uploads/media_library/2019/04/network_3396348_1280.jpg','/var/www/redtutorial.com/public/uploads/media_library/2019/04','jpg','2019-04-25 20:11:00','2019-04-25 20:11:00');
/*!40000 ALTER TABLE `media_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_files_to_items`
--

DROP TABLE IF EXISTS `media_files_to_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media_files_to_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_files_to_items_file_id_index` (`file_id`),
  KEY `media_files_to_items_item_id_index` (`item_id`),
  KEY `media_files_to_items_item_type_index` (`item_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_files_to_items`
--

LOCK TABLES `media_files_to_items` WRITE;
/*!40000 ALTER TABLE `media_files_to_items` DISABLE KEYS */;
INSERT INTO `media_files_to_items` VALUES (1,1,1,'course','2019-01-19 21:52:13','2019-01-19 21:52:13'),(2,2,10,'course','2019-04-25 20:11:00','2019-04-25 20:11:00');
/*!40000 ALTER TABLE `media_files_to_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2018_02_04_230147_migration_cartalyst_sentinel',1),(2,'2018_02_24_135203_create_table_courses',1),(3,'2018_02_25_182859_create_login_table',1),(4,'2018_04_29_225354_create_table_lessons',1),(5,'2018_06_06_232415_create_slugs_table',1),(6,'2018_06_26_212258_create_media_files_table',1),(7,'2018_07_21_002304_create_emails_table',1),(8,'2018_10_05_010456_create_static_pages_table',1),(9,'2018_10_07_221954_create_contact_messages_table',1),(10,'2018_10_07_222321_create_contact_messages_to_users_table',1),(11,'2018_10_08_154805_alter_static_pages_add_meta_update_title',1),(12,'2018_10_16_175433_alter_messages_to_user_add_is_deleted_is_flaged_columns',1),(13,'2018_10_18_143241_alter_user_table_add_phone_second_email',1),(14,'2018_11_02_174210_alter_courses_drop_level_column',1),(15,'2018_11_05_203337_alter_courses_table_add_symbol_class',1),(16,'2018_11_07_232326_create_table_lessons_sections',1),(17,'2018_11_07_233338_create_alter_lessons_drop_content',1),(18,'2018_11_09_183622_create_table_lesson_sections_options',1),(19,'2018_11_09_185349_alter_table_lesson_sections_add_order_weight',1),(20,'2018_11_10_173529_alter_table_lesson_sections_options_add_order_weight_value',1),(21,'2018_11_10_174227_alter_table_lesson_sections_options_add_is_public',1),(22,'2018_11_11_172153_alter_table_lessons_sections_add_options_type',1),(23,'2018_11_11_173345_alter_table_lessons_sections_options_drop_type',1),(24,'2018_11_20_195701_create_media_files_to_items',1),(25,'2019_03_04_193903_create_chapters_table',2),(26,'2019_03_04_194038_drop_slugs_table',2),(27,'2019_03_04_202705_drop_symbol_class_parent_id_courses_table',3),(28,'2019_03_04_213355_alter_chapters_lessons_parent_id_to_course_id_chapter_id',4),(29,'2019_03_10_235511_create_table_users_to_lessons_sections',5),(30,'2019_03_16_163920_create_table_courses_status',5),(31,'2019_03_16_164028_alter_table_courses_add_status_column',5),(32,'2019_03_16_172231_alter_table_courses_remove_is_public_column',5),(33,'2019_05_07_235659_alter_courses_add_short_description_column',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persistences`
--

DROP TABLE IF EXISTS `persistences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persistences`
--

LOCK TABLES `persistences` WRITE;
/*!40000 ALTER TABLE `persistences` DISABLE KEYS */;
INSERT INTO `persistences` VALUES (1,1,'oHemHn7GQniuXBjSlUFMjvW59r5vtE9A','2019-01-17 21:55:20','2019-01-17 21:55:20'),(2,1,'r1J4HwOK8ZDdLSVR5B8At6bnawgR8X9I','2019-01-19 13:12:10','2019-01-19 13:12:10'),(3,1,'M2BpjpwAqOoJFdHvOwmwVtXWm46hgTgT','2019-01-19 16:10:08','2019-01-19 16:10:08'),(4,1,'yA62OfLjox4ac5VZMkRhgc5dwKpmT8rx','2019-01-19 21:39:21','2019-01-19 21:39:21'),(5,1,'4grF3MDru99zjdfszlBUHJSObS8hI2Om','2019-01-20 02:34:18','2019-01-20 02:34:18'),(6,1,'IgcXT1pNlaCSNuCKmburZbHRYEJ2PmPl','2019-01-20 14:30:03','2019-01-20 14:30:03'),(7,1,'kmgWfjkLEmb89O9Bi56HqV1JjaHBikL3','2019-01-20 21:37:51','2019-01-20 21:37:51'),(8,1,'sqeAKgmopjfJnQTv4z5ndfltmeQbqRR8','2019-01-26 23:32:40','2019-01-26 23:32:40'),(9,1,'BuqTCfrcsnDNCp9xApCn0ju3nVayanJY','2019-01-28 20:41:12','2019-01-28 20:41:12'),(10,1,'GwrXS6Kku3D7XO1ngrmAoLsHCfA0bZDD','2019-01-29 23:01:11','2019-01-29 23:01:11'),(11,1,'Vsz0QutoLsLipYlytNARKDyLxoHdeClw','2019-02-06 22:32:34','2019-02-06 22:32:34'),(12,1,'m2tDWofvplLXGpdGHuWP57w9lXX5x4mR','2019-02-10 19:41:56','2019-02-10 19:41:56'),(13,1,'zS6twsQwzJ7mORRsVFuATqvBGnxvrbKJ','2019-02-16 23:07:32','2019-02-16 23:07:32'),(14,1,'kDNmV7nTJzrvf9l58Wc7Asu9mDsjSi9v','2019-02-26 20:49:01','2019-02-26 20:49:01'),(15,1,'qB7mgTfJjhEsm62bXVTzV0MtP1Yz0Ut0','2019-02-28 00:31:21','2019-02-28 00:31:21'),(16,1,'PNKYcqMKwmZCHukxPgpD49EJq1NzViNs','2019-03-03 13:50:46','2019-03-03 13:50:46'),(17,1,'FfxEg3mBN2AOKvf81HPxB6c2vyC9heuH','2019-03-09 18:38:56','2019-03-09 18:38:56'),(18,1,'Mkjo1gwntLEd3zb9BvYfzrl3EfY6rcSL','2019-03-16 15:58:03','2019-03-16 15:58:03'),(19,1,'eDxIrcbbphbj54s2Db4gFwiWpBLTTRsf','2019-03-16 23:50:36','2019-03-16 23:50:36'),(20,1,'GVPvF6YgoXBOjUNt2BAgu3ATo3LmWYAF','2019-03-17 18:47:11','2019-03-17 18:47:11'),(21,1,'eBgXV68yMubQ2K3m4xwExv9OZCeHDCVv','2019-03-22 16:51:16','2019-03-22 16:51:16'),(22,1,'mBZnh1TajVl1hBPIY2yaLpLRcd3XK4eI','2019-04-06 17:20:11','2019-04-06 17:20:11'),(23,3,'1otnzMyrn1tXXK4swlB9JlDEwlT7gMcv','2019-04-07 23:19:25','2019-04-07 23:19:25'),(24,3,'WqqZQMK401iEVIcSHsPmLuUgPhsAxt8m','2019-04-07 23:20:57','2019-04-07 23:20:57'),(25,1,'vDjvIskTbjWyauXGXvPiDCQWxDpwOg8C','2019-04-11 21:21:37','2019-04-11 21:21:37'),(26,1,'Iw4g6U1Hg4ExrKH8a9SK8lsnHLs5knsM','2019-04-13 20:17:03','2019-04-13 20:17:03'),(27,1,'HAHboGQDvMZSJdkssyPZZrjFy71Nq1j1','2019-04-15 16:28:08','2019-04-15 16:28:08'),(29,1,'uCJcIJUZR1m7pybaOIamXqhnZJKV4cdO','2019-04-16 11:52:14','2019-04-16 11:52:14'),(30,1,'Erlqadc7OFBtITK1GVnkNP4KZo1CT0lL','2019-04-16 19:20:01','2019-04-16 19:20:01'),(31,1,'HXyGupnQTFy41Tc1GptnaXza2bU1YjYJ','2019-04-17 00:06:55','2019-04-17 00:06:55'),(32,1,'A2Wvs39StLDV1L32W8CGX36uiB8JS9nj','2019-04-17 20:53:10','2019-04-17 20:53:10'),(33,5,'Z33rHy4Y2G188qtSibJiWLxNLn6Dl3WM','2019-04-17 20:58:36','2019-04-17 20:58:36'),(37,1,'3f5Sy2p4eMWi4xwlhIGs720j6XKJTrQq','2019-04-19 15:01:08','2019-04-19 15:01:08'),(38,1,'ZuZfIvGxncoMp4LK2ne6nlx6o6kV601Q','2019-04-19 22:15:31','2019-04-19 22:15:31'),(39,1,'DUPrTJYxJpKIxgh75zBiJH0yPbX2vhqO','2019-04-20 09:53:05','2019-04-20 09:53:05'),(40,1,'M0Wa60DjawkCx2N0P4HqIl3V5xLpQU7Y','2019-04-24 20:25:14','2019-04-24 20:25:14'),(41,1,'RXUThozd9TWnUENEJG0XXBLptlGBNDgZ','2019-04-25 19:20:45','2019-04-25 19:20:45'),(42,1,'XhJ0Bod4Z1t9lW8pdolwCNAqrl2P4Zz6','2019-04-26 00:32:57','2019-04-26 00:32:57'),(43,1,'i1C6inPF7VZ3BlkCd66Nj4vn80j5Db2f','2019-04-27 17:23:22','2019-04-27 17:23:22'),(44,1,'d63XqBqOdpF66NxWf4MJXlhqF5ahPcbQ','2019-04-28 22:09:11','2019-04-28 22:09:11'),(45,1,'c1gb84fBmOeoNHH8uhXhWEa63SB8ykVp','2019-05-01 08:07:04','2019-05-01 08:07:04'),(46,1,'m5FCNQ2GCzNDUgr9VHaiNxUuw9zPF2Ur','2019-05-01 10:38:19','2019-05-01 10:38:19'),(51,1,'VJEijrrQ4lqCC9n2kQoTFNRWG2XxtOvO','2019-05-04 13:14:11','2019-05-04 13:14:11'),(52,3,'aZTaFcVmzrZx3aJBiAZU4AUoV0Vq8gg4','2019-05-05 01:12:35','2019-05-05 01:12:35'),(54,3,'lmeQjZlrbPJ5Nv7COm1xDFuUcYxAelXl','2019-05-05 13:40:38','2019-05-05 13:40:38'),(55,3,'xa6QNqLCwEnZUhmlB9VIAC0CsDXXnJsW','2019-05-05 14:46:23','2019-05-05 14:46:23'),(61,1,'ikcE2nBJXIkTn6TEh2eRIfcI8IxZnEHL','2019-05-07 23:54:22','2019-05-07 23:54:22');
/*!40000 ALTER TABLE `persistences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminders`
--

DROP TABLE IF EXISTS `reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminders`
--

LOCK TABLES `reminders` WRITE;
/*!40000 ALTER TABLE `reminders` DISABLE KEYS */;
INSERT INTO `reminders` VALUES (3,2,'YgFEVTniFjBvsYiUi2UdjV3jjPZRPu6x',1,'2019-04-18 00:08:06','2019-04-18 00:07:35','2019-04-18 00:08:06'),(4,2,'wLm4YmGp2obI3EeyC51KPh4M4pl47Uhn',1,'2019-04-19 11:02:51','2019-04-19 11:02:19','2019-04-19 11:02:51'),(5,3,'H6b9fQeP2Wkd0CIGaPQ8KIa2NOmBw6s3',1,'2019-04-19 11:08:46','2019-04-19 11:08:12','2019-04-19 11:08:46'),(6,7,'IEC3yuWx2HBZpifKXNvoHl9fJrvtqkIp',1,'2019-04-19 11:17:57','2019-04-19 11:17:10','2019-04-19 11:17:57'),(7,8,'5IwCFH2glUCrNWFsJoIn5hVCzQ3tjBSW',1,'2019-05-02 15:39:19','2019-05-02 15:37:28','2019-05-02 15:39:19');
/*!40000 ALTER TABLE `reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_users`
--

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
INSERT INTO `role_users` VALUES (1,1,'2019-01-12 23:58:45','2019-01-12 23:58:45'),(2,1,'2019-01-12 23:58:45','2019-01-12 23:58:45'),(3,2,'2019-04-07 23:19:07','2019-04-07 23:19:07'),(4,2,'2019-04-14 16:32:41','2019-04-14 16:32:41'),(5,2,'2019-04-17 20:57:53','2019-04-17 20:57:53'),(6,1,'2019-04-19 11:06:38','2019-04-19 11:06:38'),(7,2,'2019-04-19 11:14:51','2019-04-19 11:14:51'),(8,2,'2019-05-02 15:34:56','2019-05-02 15:34:56');
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin','{\"admin\":true}','2019-01-12 23:58:45','2019-01-12 23:58:45'),(2,'client','Client','{\"client\":true}','2019-01-12 23:58:45','2019-01-12 23:58:45');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `static_pages`
--

DROP TABLE IF EXISTS `static_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `static_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `head_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_public` tinyint(4) NOT NULL DEFAULT '0',
  `is_draft` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `static_pages_slug_unique` (`slug`),
  KEY `static_pages_is_public_index` (`is_public`),
  KEY `static_pages_is_draft_index` (`is_draft`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `static_pages`
--

LOCK TABLES `static_pages` WRITE;
/*!40000 ALTER TABLE `static_pages` DISABLE KEYS */;
INSERT INTO `static_pages` VALUES (1,'Terms and Conditions','Terms and Conditions','Terms and Conditions','Terms and Conditions','<h2 unselectable=\"on\">Introduction</h2>\r\n\r\n<p unselectable=\"on\">These terms and conditions apply between you, the User of this Website (including any sub-domains, unless expressly excluded by their own terms and conditions), and Eduard Cristian Robu, the owner and operator of this Website. Please read these terms and conditions carefully, as they affect your legal rights. Your agreement to comply with and be bound by these terms and conditions is deemed to occur upon your first use of the Website. If you do not agree to be bound by these terms and conditions, you should stop using the Website immediately.</p>\r\n\r\n<p unselectable=\"on\">In these terms and conditions, <b unselectable=\"on\">User</b> or <b unselectable=\"on\">Users</b> means any third party that accesses the Website and is not either (i) employed by Eduard Cristian Robu and acting in the course of their employment or (ii) engaged as a consultant or otherwise providing services to Eduard Cristian Robu and accessing the Website in connection with the provision of such services.</p>\r\n\r\n<p unselectable=\"on\">You must be at least 18 years of age to use this Website. By using the Website and agreeing to these terms and conditions, you represent and warrant that you are at least 18 years of age.</p>\r\n\r\n<h2 unselectable=\"on\">Intellectual property and acceptable use</h2>\r\n\r\n<ol class=\"clauses firstList\" unselectable=\"on\">\r\n	<li unselectable=\"on\">All Content included on the Website, unless uploaded by Users, is the property of Eduard Cristian Robu, our affiliates or other relevant third parties. In these terms and conditions, Content means any text, graphics, images, audio, video, software, data compilations, page layout, underlying code and software and any other form of information capable of being stored in a computer that appears on or forms part of this Website, including any such content uploaded by Users. By continuing to use the Website you acknowledge that such Content is protected by copyright, trademarks, database rights and other intellectual property rights. Nothing on this site shall be construed as granting, by implication, estoppel, or otherwise, any license or right to use any trademark, logo or service mark displayed on the site without the owner&#39;s prior written permission</li>\r\n	<li unselectable=\"on\">You may, for your own personal, non-commercial use only, do the following:\r\n	<ol unselectable=\"on\">\r\n		<li unselectable=\"on\">retrieve, display and view the Content on a computer screen</li>\r\n	</ol>\r\n	</li>\r\n	<li unselectable=\"on\">You must not otherwise reproduce, modify, copy, distribute or use for commercial purposes any Content without the written permission of Eduard Cristian Robu.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Prohibited use</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">You may not use the Website for any of the following purposes:\r\n	<ol unselectable=\"on\">\r\n		<li unselectable=\"on\">in any way which causes, or may cause, damage to the Website or interferes with any other person&#39;s use or enjoyment of the Website;</li>\r\n		<li unselectable=\"on\">in any way which is harmful, unlawful, illegal, abusive, harassing, threatening or otherwise objectionable or in breach of any applicable law, regulation, governmental order;</li>\r\n		<li unselectable=\"on\">making, transmitting or storing electronic copies of Content protected by copyright without the permission of the owner.</li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Links to other websites</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">This Website may contain links to other sites. Unless expressly stated, these sites are not under the control of Eduard Cristian Robu or that of our affiliates.</li>\r\n	<li unselectable=\"on\">We assume no responsibility for the content of such Websites and disclaim liability for any and all forms of loss or damage arising out of the use of them.</li>\r\n	<li unselectable=\"on\">The inclusion of a link to another site on this Website does not imply any endorsement of the sites themselves or of those in control of them.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Privacy Policy and Cookies Policy</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">Use of the Website is also governed by our Privacy Policy and Cookies Policy, which are incorporated into these terms and conditions by this reference. To view the Privacy Policy and Cookies Policy, please click on the following: http://redtutorial.com/info/privacy-and-cookies-policy and http://redtutorial.com/info/privacy-and-cookies-policy.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Availability of the Website and disclaimers</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">Any online facilities, tools, services or information that Eduard Cristian Robu makes available through the Website (the <b unselectable=\"on\">Service</b>) is provided &quot;as is&quot; and on an &quot;as available&quot; basis. We give no warranty that the Service will be free of defects and/or faults. To the maximum extent permitted by the law, we provide no warranties (express or implied) of fitness for a particular purpose, accuracy of information, compatibility and satisfactory quality. Eduard Cristian Robu is under no obligation to update information on the Website.</li>\r\n	<li unselectable=\"on\">Whilst Eduard Cristian Robu uses reasonable endeavours to ensure that the Website is secure and free of errors, viruses and other malware, we give no warranty or guaranty in that regard and all Users take responsibility for their own security, that of their personal details and their computers.</li>\r\n	<li unselectable=\"on\">Eduard Cristian Robu accepts no liability for any disruption or non-availability of the Website.</li>\r\n	<li unselectable=\"on\">Eduard Cristian Robu reserves the right to alter, suspend or discontinue any part (or the whole of) the Website including, but not limited to, any products and/or services available. These terms and conditions shall continue to apply to any modified version of the Website unless it is expressly stated otherwise.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Limitation of liability</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">Nothing in these terms and conditions will: (a) limit or exclude our or your liability for death or personal injury resulting from our or your negligence, as applicable; (b) limit or exclude our or your liability for fraud or fraudulent misrepresentation; or (c) limit or exclude any of our or your liabilities in any way that is not permitted under applicable law.</li>\r\n	<li unselectable=\"on\">We will not be liable to you in respect of any losses arising out of events beyond our reasonable control.</li>\r\n	<li unselectable=\"on\">To the maximum extent permitted by law, Eduard Cristian Robu accepts no liability for any of the following:\r\n	<ol unselectable=\"on\">\r\n		<li unselectable=\"on\">any business losses, such as loss of profits, income, revenue, anticipated savings, business, contracts, goodwill or commercial opportunities;</li>\r\n		<li unselectable=\"on\">loss or corruption of any data, database or software;</li>\r\n		<li unselectable=\"on\">any special, indirect or consequential loss or damage.</li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">General</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">You may not transfer any of your rights under these terms and conditions to any other person. We may transfer our rights under these terms and conditions where we reasonably believe your rights will not be affected.</li>\r\n	<li unselectable=\"on\">These terms and conditions may be varied by us from time to time. Such revised terms will apply to the Website from the date of publication. Users should check the terms and conditions regularly to ensure familiarity with the then current version.</li>\r\n	<li unselectable=\"on\">These terms and conditions together with the Privacy Policy and Cookies Policy contain the whole agreement between the parties relating to its subject matter and supersede all prior discussions, arrangements or agreements that might have taken place in relation to the terms and conditions.</li>\r\n	<li unselectable=\"on\">The Contracts (Rights of Third Parties) Act 1999 shall not apply to these terms and conditions and no third party will have any right to enforce or rely on any provision of these terms and conditions.</li>\r\n	<li unselectable=\"on\">If any court or competent authority finds that any provision of these terms and conditions (or part of any provision) is invalid, illegal or unenforceable, that provision or part-provision will, to the extent required, be deemed to be deleted, and the validity and enforceability of the other provisions of these terms and conditions will not be affected.</li>\r\n	<li unselectable=\"on\">Unless otherwise agreed, no delay, act or omission by a party in exercising any right or remedy will be deemed a waiver of that, or any other, right or remedy.</li>\r\n	<li unselectable=\"on\">This Agreement shall be governed by and interpreted according to the law of England and Wales and all disputes arising under the Agreement (including non-contractual disputes or claims) shall be subject to the exclusive jurisdiction of the English and Welsh courts.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Eduard Cristian Robu details</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">Eduard Cristian Robu of Canterbury Road 110, London, E106EF operates the Website http://redtutorial.com.\r\n	<p unselectable=\"on\">You can contact Eduard Cristian Robu by email on contact@redtutorial.com.</p>\r\n	</li>\r\n</ol>','terms-and-conditions',1,1,'2019-02-06 22:42:22','2019-04-06 17:22:58'),(2,'Privacy and Cookies Policy','Privacy and Cookies Policy','Privacy and Cookies Policy','Privacy and Cookies Policy','<div class=\"docBody\" unselectable=\"on\">\r\n<p unselectable=\"on\">This privacy policy applies between you, the User of this Website and Eduard Cristian Robu, the owner and provider of this Website. Eduard Cristian Robu takes the privacy of your information very seriously. This privacy policy applies to our use of any and all Data collected by us or provided by you in relation to your use of the Website.</p>\r\n\r\n<p unselectable=\"on\"><b unselectable=\"on\">Please read this privacy policy carefully</b>.</p>\r\n\r\n<h2 unselectable=\"on\">Definitions and interpretation</h2>\r\n\r\n<ol class=\"clauses firstList\" unselectable=\"on\">\r\n	<li unselectable=\"on\">In this privacy policy, the following definitions are used:\r\n	<table class=\"definitions\" unselectable=\"on\">\r\n		<tbody unselectable=\"on\">\r\n			<tr unselectable=\"on\">\r\n				<td unselectable=\"on\"><b unselectable=\"on\">Data</b></td>\r\n				<td unselectable=\"on\">collectively all information that you submit to Eduard Cristian Robu via the Website. This definition incorporates, where applicable, the definitions provided in the Data Protection Laws;</td>\r\n			</tr>\r\n			<tr unselectable=\"on\">\r\n				<td unselectable=\"on\"><b unselectable=\"on\">Cookies</b></td>\r\n				<td unselectable=\"on\">a small text file placed on your computer by this Website when you visit certain parts of the Website and/or when you use certain features of the Website. Details of the cookies used by this Website are set out in the clause below (<b unselectable=\"on\">Cookies</b>);</td>\r\n			</tr>\r\n			<tr unselectable=\"on\">\r\n				<td unselectable=\"on\"><b unselectable=\"on\">Data Protection Laws</b></td>\r\n				<td unselectable=\"on\">any applicable law relating to the processing of personal Data, including but not limited to the Directive 96/46/EC (Data Protection Directive) or the GDPR, and any national implementing laws, regulations and secondary legislation, for as long as the GDPR is effective in the UK;</td>\r\n			</tr>\r\n			<tr unselectable=\"on\">\r\n				<td unselectable=\"on\"><b unselectable=\"on\">GDPR</b></td>\r\n				<td unselectable=\"on\">the General Data Protection Regulation (EU) 2016/679;</td>\r\n			</tr>\r\n			<tr unselectable=\"on\">\r\n				<td unselectable=\"on\"><b unselectable=\"on\">Eduard Cristian Robu,<br unselectable=\"on\" />\r\n				we</b> or <b unselectable=\"on\">us</b></td>\r\n				<td unselectable=\"on\">Eduard Cristian Robu of Canterbury Road 110, London, E106EF;</td>\r\n			</tr>\r\n			<tr unselectable=\"on\">\r\n				<td unselectable=\"on\"><b unselectable=\"on\">UK and EU Cookie Law</b></td>\r\n				<td unselectable=\"on\">the Privacy and Electronic Communications (EC Directive) Regulations 2003 as amended by the Privacy and Electronic Communications (EC Directive) (Amendment) Regulations 2011;</td>\r\n			</tr>\r\n			<tr unselectable=\"on\">\r\n				<td unselectable=\"on\"><b unselectable=\"on\">User</b> or <b unselectable=\"on\">you</b></td>\r\n				<td unselectable=\"on\">any third party that accesses the Website and is not either (i) employed by Eduard Cristian Robu and acting in the course of their employment or (ii) engaged as a consultant or otherwise providing services to Eduard Cristian Robu and accessing the Website in connection with the provision of such services; and</td>\r\n			</tr>\r\n			<tr unselectable=\"on\">\r\n				<td unselectable=\"on\"><b unselectable=\"on\">Website</b></td>\r\n				<td unselectable=\"on\">the website that you are currently using, redtutorial.com, and any sub-domains of this site unless expressly excluded by their own terms and conditions.</td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n	</li>\r\n	<li unselectable=\"on\">In this privacy policy, unless the context requires a different interpretation:\r\n	<ol unselectable=\"on\">\r\n		<li unselectable=\"on\">the singular includes the plural and vice versa;</li>\r\n		<li unselectable=\"on\">references to sub-clauses, clauses, schedules or appendices are to sub-clauses, clauses, schedules or appendices of this privacy policy;</li>\r\n		<li unselectable=\"on\">a reference to a person includes firms, companies, government entities, trusts and partnerships;</li>\r\n		<li unselectable=\"on\">&quot;including&quot; is understood to mean &quot;including without limitation&quot;;</li>\r\n		<li unselectable=\"on\">reference to any statutory provision includes any modification or amendment of it;</li>\r\n		<li unselectable=\"on\">the headings and sub-headings do not form part of this privacy policy.</li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Scope of this privacy policy</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">This privacy policy applies only to the actions of Eduard Cristian Robu and Users with respect to this Website. It does not extend to any websites that can be accessed from this Website including, but not limited to, any links we may provide to social media websites.</li>\r\n	<li unselectable=\"on\">For purposes of the applicable Data Protection Laws, Eduard Cristian Robu is the &quot;data controller&quot;. This means that Eduard Cristian Robu determines the purposes for which, and the manner in which, your Data is processed.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Data collected</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">We may collect the following Data, which includes personal Data, from you:\r\n	<ol unselectable=\"on\">\r\n		<li unselectable=\"on\">name;</li>\r\n		<li unselectable=\"on\">contact Information such as email addresses and telephone numbers;</li>\r\n		<li unselectable=\"on\">IP address (automatically collected);</li>\r\n		<li unselectable=\"on\">web browser type and version (automatically collected);</li>\r\n		<li unselectable=\"on\">operating system (automatically collected);</li>\r\n		<li>in each case, in accordance with this privacy policy.</li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">How we collect Data</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">We collect Data in the following ways:\r\n	<ol unselectable=\"on\">\r\n		<li unselectable=\"on\">data is given to us by you; and</li>\r\n		<li unselectable=\"on\">data is collected automatically.</li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Data that is given to us by you</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">Eduard Cristian Robu will collect your Data in a number of ways, for example:\r\n	<p unselectable=\"on\">in each case, in accordance with this privacy policy.</p>\r\n\r\n	<ol unselectable=\"on\">\r\n		<li unselectable=\"on\">when you contact us through the Website, by telephone, post, e-mail or through any other means;</li>\r\n		<li unselectable=\"on\">when you register with us and set up an account to receive our products/services;</li>\r\n		<li unselectable=\"on\">when you make payments to us, through this Website or otherwise;</li>\r\n		<li unselectable=\"on\">when you use our services;</li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Data that is collected automatically</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">To the extent that you access the Website, we will collect your Data automatically, for example:\r\n	<ol unselectable=\"on\">\r\n		<li unselectable=\"on\">we automatically collect some information about your visit to the Website. This information helps us to make improvements to Website content and navigation, and includes your IP address, the date, times and frequency with which you access the Website and the way you use and interact with its content.</li>\r\n		<li unselectable=\"on\">we will collect your Data automatically via cookies, in line with the cookie settings on your browser. For more information about cookies, and how we use them on the Website, see the section below, headed &quot;Cookies&quot;.</li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Our use of Data</h2>\r\n\r\n<p unselectable=\"on\">in each case, in accordance with this privacy policy.</p>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">Any or all of the above Data may be required by us from time to time in order to provide you with the best possible service and experience when using our Website. Specifically, Data may be used by us for the following reasons:\r\n	<ol unselectable=\"on\">\r\n		<li unselectable=\"on\">improvement of our products / services;</li>\r\n		<li unselectable=\"on\">transmission by email of marketing materials that may be of interest to you;</li>\r\n		<li unselectable=\"on\">contact for market research purposes which may be done using email, telephone, fax or mail. Such information may be used to customise or update the Website;</li>\r\n	</ol>\r\n	</li>\r\n	<li unselectable=\"on\">We may use your Data for the above purposes if we deem it necessary to do so for our legitimate interests. If you are not satisfied with this, you have the right to object in certain circumstances (see the section headed &quot;Your rights&quot; below).</li>\r\n	<li unselectable=\"on\">For the delivery of direct marketing to you via e-mail, we&#39;ll need your consent, whether via an opt-in or soft-opt-in:\r\n	<ol unselectable=\"on\">\r\n		<li unselectable=\"on\">soft opt-in consent is a specific type of consent which applies when you have previously engaged with us (for example, you contact us to ask us for more details about a particular product/service, and we are marketing similar products/services). Under &quot;soft opt-in&quot; consent, we will take your consent as given unless you opt-out.</li>\r\n		<li unselectable=\"on\">for other types of e-marketing, we are required to obtain your explicit consent; that is, you need to take positive and affirmative action when consenting by, for example, checking a tick box that we&#39;ll provide.</li>\r\n		<li unselectable=\"on\">if you are not satisfied about our approach to marketing, you have the right to withdraw consent at any time. To find out how to withdraw your consent, see the section headed &quot;Your rights&quot; below.</li>\r\n	</ol>\r\n	</li>\r\n	<li unselectable=\"on\">When you register with us and set up an account to receive our services, the legal basis for this processing is the performance of a contract between you and us and/or taking steps, at your request, to enter into such a contract.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Who we share Data with</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">We may share your Data with the following groups of people for the following reasons:\r\n	<p unselectable=\"on\">in each case, in accordance with this privacy policy.</p>\r\n\r\n	<ol unselectable=\"on\">\r\n		<li unselectable=\"on\">any of our group companies or affiliates - For marketing purposes;</li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Keeping Data secure</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">We will use technical and organisational measures to safeguard your Data, for example:\r\n	<ol unselectable=\"on\">\r\n		<li unselectable=\"on\">access to your account is controlled by a password and a user name that is unique to you.</li>\r\n		<li unselectable=\"on\">we store your Data on secure servers.</li>\r\n	</ol>\r\n	</li>\r\n	<li unselectable=\"on\">Technical and organisational measures include measures to deal with any suspected data breach. If you suspect any misuse or loss or unauthorised access to your Data, please let us know immediately by contacting us via this e-mail address: edi_cristi3@yahoo.com.</li>\r\n	<li unselectable=\"on\">If you want detailed information from Get Safe Online on how to protect your information and your computers and devices against fraud, identity theft, viruses and many other online problems, please visit www.getsafeonline.org. Get Safe Online is supported by HM Government and leading businesses.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Data retention</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">Unless a longer retention period is required or permitted by law, we will only hold your Data on our systems for the period necessary to fulfil the purposes outlined in this privacy policy or until you request that the Data be deleted.</li>\r\n	<li unselectable=\"on\">Even if we delete your Data, it may persist on backup or archival media for legal, tax or regulatory purposes.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Your rights</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">You have the following rights in relation to your Data:\r\n	<ol unselectable=\"on\">\r\n		<li unselectable=\"on\"><b unselectable=\"on\">Right to access</b> - the right to request (i) copies of the information we hold about you at any time, or (ii) that we modify, update or delete such information. If we provide you with access to the information we hold about you, we will not charge you for this, unless your request is &quot;manifestly unfounded or excessive.&quot; Where we are legally permitted to do so, we may refuse your request. If we refuse your request, we will tell you the reasons why.</li>\r\n		<li unselectable=\"on\"><b unselectable=\"on\">Right to correct</b> - the right to have your Data rectified if it is inaccurate or incomplete.</li>\r\n		<li unselectable=\"on\"><b unselectable=\"on\">Right to erase</b> - the right to request that we delete or remove your Data from our systems.</li>\r\n		<li unselectable=\"on\"><b unselectable=\"on\">Right to restrict our use of your Data</b> - the right to &quot;block&quot; us from using your Data or limit the way in which we can use it.</li>\r\n		<li unselectable=\"on\"><b unselectable=\"on\">Right to data portability</b> - the right to request that we move, copy or transfer your Data.</li>\r\n		<li unselectable=\"on\"><b unselectable=\"on\">Right to object</b> - the right to object to our use of your Data including where we use it for our legitimate interests.</li>\r\n	</ol>\r\n	</li>\r\n	<li unselectable=\"on\">To make enquiries, exercise any of your rights set out above, or withdraw your consent to the processing of your Data (where consent is our legal basis for processing your Data), please contact us via this e-mail address: edi_cristi3@yahoo.com.</li>\r\n	<li unselectable=\"on\">If you are not satisfied with the way a complaint you make in relation to your Data is handled by us, you may be able to refer your complaint to the relevant data protection authority. For the UK, this is the Information Commissioner&#39;s Office (ICO). The ICO&#39;s contact details can be found on their website at https://ico.org.uk/.</li>\r\n	<li unselectable=\"on\">It is important that the Data we hold about you is accurate and current. Please keep us informed if your Data changes during the period for which we hold it.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Links to other websites</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">This Website may, from time to time, provide links to other websites. We have no control over such websites and are not responsible for the content of these websites. This privacy policy does not extend to your use of such websites. You are advised to read the privacy policy or statement of other websites prior to using them.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Changes of business ownership and control</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">Eduard Cristian Robu may, from time to time, expand or reduce our business and this may involve the sale and/or the transfer of control of all or part of Eduard Cristian Robu. Data provided by Users will, where it is relevant to any part of our business so transferred, be transferred along with that part and the new owner or newly controlling party will, under the terms of this privacy policy, be permitted to use the Data for the purposes for which it was originally supplied to us.</li>\r\n	<li unselectable=\"on\">We may also disclose Data to a prospective purchaser of our business or any part of it.</li>\r\n	<li unselectable=\"on\">In the above instances, we will take steps with the aim of ensuring your privacy is protected.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Cookies</h2>\r\n\r\n<table class=\"withBorders\" unselectable=\"on\">\r\n	<tbody unselectable=\"on\">\r\n		<tr unselectable=\"on\">\r\n			<td align=\"center\" unselectable=\"on\" valign=\"center\" width=\"30%\"><b unselectable=\"on\">Type of Cookie</b></td>\r\n			<td align=\"center\" unselectable=\"on\" valign=\"center\" width=\"70%\"><b unselectable=\"on\">Purpose</b></td>\r\n		</tr>\r\n		<tr unselectable=\"on\">\r\n			<td align=\"left\" unselectable=\"on\" valign=\"top\">Strictly necessary cookies</td>\r\n			<td align=\"left\" unselectable=\"on\" valign=\"top\">These are cookies that are required for the operation of our website. They include, for example, cookies that enable you to log into secure areas of our website, use a shopping cart or make use of e-billing services.</td>\r\n		</tr>\r\n		<tr unselectable=\"on\">\r\n			<td align=\"left\" unselectable=\"on\" valign=\"top\">Analytical/performance cookies</td>\r\n			<td align=\"left\" unselectable=\"on\" valign=\"top\">They allow us to recognise and count the number of visitors and to see how visitors move around our website when they are using it. This helps us to improve the way our website works, for example, by ensuring that users are finding what they are looking for easily.</td>\r\n		</tr>\r\n		<tr unselectable=\"on\">\r\n			<td align=\"left\" unselectable=\"on\" valign=\"top\">Functionality cookies</td>\r\n			<td align=\"left\" unselectable=\"on\" valign=\"top\">These are used to recognise you when you return to our website. This enables us to personalise our content for you, greet you by name and remember your preferences (for example, your choice of language or region).</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">This Website may place and access certain Cookies on your computer. Eduard Cristian Robu uses Cookies to improve your experience of using the Website. Eduard Cristian Robu has carefully chosen these Cookies and has taken steps to ensure that your privacy is protected and respected at all times.</li>\r\n	<li unselectable=\"on\">All Cookies used by this Website are used in accordance with current UK and EU Cookie Law.</li>\r\n	<li unselectable=\"on\">Before the Website places Cookies on your computer, you will be presented with a message bar requesting your consent to set those Cookies. By giving your consent to the placing of Cookies, you are enabling Eduard Cristian Robu to provide a better experience and service to you. You may, if you wish, deny consent to the placing of Cookies; however certain features of the Website may not function fully or as intended.</li>\r\n	<li unselectable=\"on\">This Website may place the following Cookies:</li>\r\n	<li unselectable=\"on\">You can find a list of Cookies that we use in the Cookies Schedule.</li>\r\n	<li unselectable=\"on\">You can choose to enable or disable Cookies in your internet browser. By default, most internet browsers accept Cookies but this can be changed. For further details, please consult the help menu in your internet browser.</li>\r\n	<li unselectable=\"on\">You can choose to delete Cookies at any time; however you may lose any information that enables you to access the Website more quickly and efficiently including, but not limited to, personalisation settings.</li>\r\n	<li unselectable=\"on\">It is recommended that you ensure that your internet browser is up-to-date and that you consult the help and guidance provided by the developer of your internet browser if you are unsure about adjusting your privacy settings.</li>\r\n	<li unselectable=\"on\">For more information generally on cookies, including how to disable them, please refer to aboutcookies.org. You will also find details on how to delete cookies from your computer.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">General</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">You may not transfer any of your rights under this privacy policy to any other person. We may transfer our rights under this privacy policy where we reasonably believe your rights will not be affected.</li>\r\n	<li unselectable=\"on\">If any court or competent authority finds that any provision of this privacy policy (or part of any provision) is invalid, illegal or unenforceable, that provision or part-provision will, to the extent required, be deemed to be deleted, and the validity and enforceability of the other provisions of this privacy policy will not be affected.</li>\r\n	<li unselectable=\"on\">Unless otherwise agreed, no delay, act or omission by a party in exercising any right or remedy will be deemed a waiver of that, or any other, right or remedy.</li>\r\n	<li unselectable=\"on\">This Agreement will be governed by and interpreted according to the law of England and Wales. All disputes arising under the Agreement will be subject to the exclusive jurisdiction of the English and Welsh courts.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Changes to this privacy policy</h2>\r\n\r\n<ol class=\"clauses\" unselectable=\"on\">\r\n	<li unselectable=\"on\">Eduard Cristian Robu reserves the right to change this privacy policy as we may deem necessary from time to time or as may be required by law. Any changes will be immediately posted on the Website and you are deemed to have accepted the terms of the privacy policy on your first use of the Website following the alterations.<br unselectable=\"on\" />\r\n	<br unselectable=\"on\" />\r\n	You may contact Eduard Cristian Robu by email at edi_cristi3@yahoo.com.</li>\r\n</ol>\r\n\r\n<h2 unselectable=\"on\">Attribution</h2>\r\n\r\n<p unselectable=\"on\"><b unselectable=\"on\">17 March 2019</b></p>\r\n\r\n<p class=\"pagebreakhere\" unselectable=\"on\">&nbsp;</p>\r\n\r\n<h2 unselectable=\"on\">Cookies</h2>\r\n\r\n<p unselectable=\"on\">Below is a list of the cookies that we use. We have tried to ensure this is complete and up to date, but if you think that we have missed a cookie or there is any discrepancy, please let us know.</p>\r\n\r\n<p unselectable=\"on\">Strictly necessary</p>\r\n\r\n<p unselectable=\"on\">We use the following strictly necessary cookies:</p>\r\n\r\n<table class=\"withBorders\" unselectable=\"on\">\r\n	<tbody unselectable=\"on\">\r\n		<tr unselectable=\"on\">\r\n			<td align=\"center\" unselectable=\"on\" valign=\"center\" width=\"50%\"><b unselectable=\"on\">Description of Cookie</b></td>\r\n			<td align=\"center\" unselectable=\"on\" valign=\"center\" width=\"50%\"><b unselectable=\"on\">Purpose</b></td>\r\n		</tr>\r\n		<tr unselectable=\"on\">\r\n			<td align=\"left\" unselectable=\"on\" valign=\"top\">We use this session cookie to remember you and maintain your session whilst you are using our website.</td>\r\n			<td align=\"left\" unselectable=\"on\" valign=\"top\">We use this session cookie to remember you and maintain your session whilst you are using our website.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<br unselectable=\"on\" />\r\n<br unselectable=\"on\" />\r\n&nbsp;\r\n<p unselectable=\"on\">Analytical/performance</p>\r\n\r\n<p unselectable=\"on\">We use the following analytical/performance cookies:</p>\r\n\r\n<table class=\"withBorders\" unselectable=\"on\">\r\n	<tbody unselectable=\"on\">\r\n		<tr unselectable=\"on\">\r\n			<td align=\"center\" unselectable=\"on\" valign=\"center\" width=\"50%\"><b unselectable=\"on\">Description of Cookie</b></td>\r\n			<td align=\"center\" unselectable=\"on\" valign=\"center\" width=\"50%\"><b unselectable=\"on\">Purpose</b></td>\r\n		</tr>\r\n		<tr unselectable=\"on\">\r\n			<td align=\"left\" unselectable=\"on\" valign=\"top\">We use this cookie to help us analyse how users use the website</td>\r\n			<td align=\"left\" unselectable=\"on\" valign=\"top\">We use this cookie to help us analyse how users use the website</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<br unselectable=\"on\" />\r\n<br unselectable=\"on\" />\r\n&nbsp;\r\n<p unselectable=\"on\">Functionality</p>\r\n\r\n<p unselectable=\"on\">We use the following functionality cookies:</p>\r\n\r\n<table class=\"withBorders\" unselectable=\"on\">\r\n	<tbody unselectable=\"on\">\r\n		<tr unselectable=\"on\">\r\n			<td align=\"center\" unselectable=\"on\" valign=\"center\" width=\"50%\"><b unselectable=\"on\">Description of Cookie</b></td>\r\n			<td align=\"center\" unselectable=\"on\" valign=\"center\" width=\"50%\"><b unselectable=\"on\">Purpose</b></td>\r\n		</tr>\r\n		<tr unselectable=\"on\">\r\n			<td align=\"left\" unselectable=\"on\" valign=\"top\">We use this cookie to identify your computer and analyse traffic patterns on our website.</td>\r\n			<td align=\"left\" unselectable=\"on\" valign=\"top\">We use this cookie to identify your computer and analyse traffic patterns on our website.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<br unselectable=\"on\" />\r\n<br unselectable=\"on\" />\r\n&nbsp;</div>','privacy-and-cookies-policy',1,1,'2019-02-06 22:43:31','2019-03-17 19:14:56');
/*!40000 ALTER TABLE `static_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `throttle`
--

DROP TABLE IF EXISTS `throttle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `throttle`
--

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;
INSERT INTO `throttle` VALUES (1,NULL,'global',NULL,'2019-03-17 12:49:48','2019-03-17 12:49:48'),(2,NULL,'ip','192.168.10.1','2019-03-17 12:49:48','2019-03-17 12:49:48'),(3,NULL,'global',NULL,'2019-03-17 12:49:58','2019-03-17 12:49:58'),(4,NULL,'ip','192.168.10.1','2019-03-17 12:49:58','2019-03-17 12:49:58'),(5,NULL,'global',NULL,'2019-04-17 20:54:02','2019-04-17 20:54:02'),(6,NULL,'ip','81.135.169.242','2019-04-17 20:54:02','2019-04-17 20:54:02'),(7,4,'user',NULL,'2019-04-17 20:54:02','2019-04-17 20:54:02'),(8,NULL,'global',NULL,'2019-04-17 20:54:38','2019-04-17 20:54:38'),(9,NULL,'ip','81.135.169.242','2019-04-17 20:54:38','2019-04-17 20:54:38'),(10,4,'user',NULL,'2019-04-17 20:54:38','2019-04-17 20:54:38'),(11,NULL,'global',NULL,'2019-04-17 20:55:02','2019-04-17 20:55:02'),(12,NULL,'ip','81.135.169.242','2019-04-17 20:55:02','2019-04-17 20:55:02'),(13,4,'user',NULL,'2019-04-17 20:55:02','2019-04-17 20:55:02'),(14,NULL,'global',NULL,'2019-04-17 20:55:13','2019-04-17 20:55:13'),(15,NULL,'ip','81.135.169.242','2019-04-17 20:55:13','2019-04-17 20:55:13'),(16,4,'user',NULL,'2019-04-17 20:55:13','2019-04-17 20:55:13'),(17,NULL,'global',NULL,'2019-04-17 20:57:09','2019-04-17 20:57:09'),(18,NULL,'ip','81.135.169.242','2019-04-17 20:57:09','2019-04-17 20:57:09'),(19,NULL,'global',NULL,'2019-05-01 08:06:50','2019-05-01 08:06:50'),(20,NULL,'ip','130.32.42.190','2019-05-01 08:06:50','2019-05-01 08:06:50'),(21,1,'user',NULL,'2019-05-01 08:06:50','2019-05-01 08:06:50'),(22,NULL,'global',NULL,'2019-05-05 01:12:23','2019-05-05 01:12:23'),(23,NULL,'ip','80.6.61.146','2019-05-05 01:12:23','2019-05-05 01:12:23'),(24,NULL,'global',NULL,'2019-05-05 17:26:43','2019-05-05 17:26:43'),(25,NULL,'ip','80.6.61.146','2019-05-05 17:26:43','2019-05-05 17:26:43');
/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'robu.edi@gmail.com',NULL,NULL,'$2y$10$ZmhAMX8FkNqrZR6fzs7Dq.aDwGcbzOHMXcntVGAzNkbjjhslPE.Mu','{\"user.admin.view\":true,\"user.admin.create\":true,\"user.admin.edit\":true,\"user.admin.delete\":true,\"user.admin.deactivate_user\":true,\"user.client.view\":true,\"user.client.create\":true,\"user.client.edit\":true,\"user.client.delete\":true,\"user.client.deactivate_user\":true}','2019-05-08 00:40:09','Eduard','Robu','2019-01-12 23:58:45','2019-05-08 00:40:09'),(2,'edi_cristi3@yahoo.com',NULL,NULL,'$2y$10$KOmqsz4a0FuyFro.DZx37.W6bljD3BB9dwtk7QnE6M1yQG8U7ChH2','{\"user.client.view\":true,\"user.client.create\":true,\"user.client.edit\":true}',NULL,'Eduard','Robu','2019-01-12 23:58:45','2019-04-19 11:02:51'),(3,'galioana92@gmail.com',NULL,NULL,'$2y$10$MJUK5q336hAQllFO5UArYOBw7vxq.wHZP0jQ.V8mWdj1BLKeZOKCy',NULL,'2019-05-06 11:00:15','Ioana','Gal','2019-04-07 23:19:07','2019-05-06 11:00:15'),(4,'helloacooper@gmail.com',NULL,NULL,'$2y$10$KOZpRmtlCaepTvi.jrGDBehmwcPx7pILSNqtqZe1cMaEaE4qBGfAa',NULL,NULL,'Alistair','Cooper','2019-04-14 16:32:41','2019-04-14 16:32:41'),(5,'b.laskowski@keepthinking.it',NULL,NULL,'$2y$10$4AKTkdNLOkxVXDBoqZcbJ.7U15IJg86tb8xE5r4srC1IcxxTTxgqW',NULL,'2019-04-17 20:58:36','xx','yy','2019-04-17 20:57:53','2019-04-17 20:58:36'),(6,'admin@redtutorial.com',NULL,NULL,'$2y$10$qBFFIJuYxmUAcHP4W6QG6.BFNnEicMK6gHsvxvMXea.Hvhp/5O.7C',NULL,NULL,'Admin','Admin','2019-04-19 11:06:38','2019-04-19 11:06:38'),(7,'tester@redtutorial.com',NULL,NULL,'$2y$10$QGddXTzW0Gmra3aK71is9.UZ25omXVdK2GZZC.Sj91dbcPc9uw8qS',NULL,NULL,'FirstTester','LastTester','2019-04-19 11:14:51','2019-04-19 11:17:57'),(8,'Robu.edi@yahoo.com',NULL,NULL,'$2y$10$w9SuiCLBA8WW/i9hIVRzJepgCYNmYlXwn6vMhLBtsAvq96mY3Tp2G',NULL,'2019-05-02 15:36:17','EduardY','RobuY','2019-05-02 15:34:56','2019-05-02 15:39:19');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_to_lessons_sections`
--

DROP TABLE IF EXISTS `users_to_lessons_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_to_lessons_sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lesson_section_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_to_lessons_sections_user_id_index` (`user_id`),
  KEY `users_to_lessons_sections_lesson_section_id_index` (`lesson_section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_to_lessons_sections`
--

LOCK TABLES `users_to_lessons_sections` WRITE;
/*!40000 ALTER TABLE `users_to_lessons_sections` DISABLE KEYS */;
INSERT INTO `users_to_lessons_sections` VALUES (1,3,2,'2019-04-07 23:27:58','2019-04-07 23:27:58'),(2,5,23,'2019-04-17 20:58:53','2019-04-17 20:58:53'),(3,5,28,'2019-04-17 20:59:02','2019-04-17 20:59:02'),(4,5,2,'2019-04-17 20:59:15','2019-04-17 20:59:15'),(5,3,17,'2019-04-19 11:10:10','2019-04-19 11:10:10'),(6,3,30,'2019-05-05 01:12:55','2019-05-05 01:12:55'),(7,3,32,'2019-05-05 01:13:02','2019-05-05 01:13:02'),(8,3,34,'2019-05-05 01:13:10','2019-05-05 01:13:10'),(9,3,38,'2019-05-05 01:13:19','2019-05-05 01:13:19'),(10,3,50,'2019-05-05 13:40:56','2019-05-05 13:40:56'),(11,3,55,'2019-05-05 13:41:24','2019-05-05 13:41:24'),(12,3,46,'2019-05-05 13:41:39','2019-05-05 13:41:39'),(13,3,4,'2019-05-05 14:52:53','2019-05-05 14:52:53'),(14,3,9,'2019-05-05 14:53:02','2019-05-05 14:53:02'),(15,3,12,'2019-05-05 14:53:10','2019-05-05 14:53:10'),(16,3,15,'2019-05-05 14:53:16','2019-05-05 14:53:16'),(17,3,20,'2019-05-05 20:12:53','2019-05-05 20:12:53'),(18,3,23,'2019-05-05 20:13:02','2019-05-05 20:13:02'),(19,3,28,'2019-05-06 11:59:18','2019-05-06 11:59:18');
/*!40000 ALTER TABLE `users_to_lessons_sections` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-08 21:52:06