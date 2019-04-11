-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: 192.168.10.10    Database: redtutorial_prod
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activations`
--

LOCK TABLES `activations` WRITE;
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
INSERT INTO `activations` VALUES (1,1,'V8jqz90oN2FbF4AFBFobpTUawnZxKzKo',1,'2019-01-12 23:58:45','2019-01-12 23:58:45','2019-01-12 23:58:45'),(2,2,'CuJJruubB8yrQGcKG78pISaG2hq8gUM3',1,'2019-01-12 23:58:45','2019-01-12 23:58:45','2019-01-12 23:58:45');
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages_to_users`
--

LOCK TABLES `contact_messages_to_users` WRITE;
/*!40000 ALTER TABLE `contact_messages_to_users` DISABLE KEYS */;
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
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `order_weight` double(6,2) NOT NULL,
  `is_public` tinyint(4) NOT NULL DEFAULT '0',
  `is_draft` tinyint(4) NOT NULL DEFAULT '1',
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_id_index` (`id`),
  KEY `courses_order_weight_index` (`order_weight`),
  KEY `courses_is_public_index` (`is_public`),
  KEY `courses_is_draft_index` (`is_draft`),
  KEY `courses_slug_index` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,NULL,'PHP','<p>Step-by-step tutorial to help you learn and understand PHP, the most popular programming language used in developing web applications.</p>',1.00,1,1,'php',NULL,'2019-01-19 16:10:34','2019-02-17 01:51:15'),(2,1,'Overview',NULL,1.00,1,1,'overview','fa fa-search','2019-01-19 21:49:50','2019-01-19 22:13:43'),(3,1,'Variables',NULL,2.00,1,1,'variables','fa fa-cube','2019-01-19 22:05:02','2019-01-19 22:05:02'),(4,1,'Operators',NULL,3.00,1,1,'operators','fas fa-divide','2019-01-19 22:26:03','2019-01-19 22:40:23'),(5,1,'Arrays',NULL,4.00,1,1,'arrays','fas fa-list-ul','2019-01-19 22:32:42','2019-01-19 22:40:15'),(6,1,'Conditional Statements (Control Structures)',NULL,5.00,1,1,'conditional-statements-control-structures','fas fa-balance-scale','2019-01-19 22:52:40','2019-01-19 23:10:15'),(7,1,'Loops (Control Structures)',NULL,6.00,1,1,'loops-control-structures','fas fa-redo','2019-01-19 23:04:52','2019-01-19 23:10:31'),(8,1,'Functions',NULL,7.00,1,1,'functions',NULL,'2019-01-19 23:12:05','2019-01-19 23:12:05'),(9,NULL,'SQL','<p>Coming soon.</p>',2.00,1,1,'sql',NULL,'2019-01-19 23:50:19','2019-02-17 01:53:22');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
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
  `parent_id` int(11) DEFAULT NULL,
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
  KEY `lessons_parent_id_index` (`parent_id`),
  KEY `lessons_order_weight_index` (`order_weight`),
  KEY `lessons_is_public_index` (`is_public`),
  KEY `lessons_is_draft_index` (`is_draft`),
  KEY `lessons_slug_index` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons`
--

LOCK TABLES `lessons` WRITE;
/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;
INSERT INTO `lessons` VALUES (1,2,'Basic notions',NULL,1.00,1,1,'basic-notions','2019-01-19 21:56:04','2019-01-19 21:56:04'),(2,2,'Installation and configuration',NULL,2.00,0,1,'installation-and-configuration','2019-01-19 22:01:21','2019-01-20 17:10:25'),(3,3,'Variables',NULL,3.00,1,1,'variables','2019-01-19 22:16:15','2019-01-19 22:16:15'),(4,3,'Constants',NULL,4.00,1,1,'constants','2019-01-19 22:17:55','2019-01-19 22:19:12'),(5,3,'Data Types',NULL,5.00,1,1,'data-types','2019-01-19 22:19:02','2019-01-19 22:19:02'),(6,4,'Arithmetic operators',NULL,6.00,1,1,'arithmetic-operators','2019-01-19 22:33:34','2019-01-19 22:33:34'),(8,4,'Comparison Operators',NULL,8.00,1,1,'comparison-operators','2019-01-19 22:38:24','2019-01-19 22:38:24'),(9,4,'Logical Operators',NULL,9.00,1,1,'logical-operators','2019-01-19 22:39:39','2019-01-19 22:39:39'),(10,5,'Indexed Arrays',NULL,10.00,1,1,'indexed-arrays','2019-01-19 22:43:55','2019-01-19 22:46:28'),(11,5,'Associative Arrays',NULL,11.00,1,1,'associative-arrays','2019-01-19 22:45:09','2019-01-19 22:45:09'),(12,5,'Multi-Dimensional Arrays',NULL,12.00,1,1,'multi-dimensional-arrays','2019-01-19 22:47:25','2019-01-19 22:47:25'),(13,6,'The if Statement',NULL,13.00,1,1,'if-statement','2019-01-19 22:54:47','2019-01-19 22:56:33'),(14,6,'The Ternary Operator',NULL,14.00,1,1,'the-ternary-operator','2019-01-19 22:55:59','2019-01-19 22:55:59'),(15,6,'The Null Coalescing Operator',NULL,15.00,1,1,'the-null-coalescing-operator','2019-01-19 22:57:21','2019-01-19 22:57:21'),(16,7,'while Loop',NULL,16.00,1,1,'while-loop','2019-01-19 23:06:51','2019-01-19 23:06:51'),(17,7,'do…while Loop',NULL,17.00,1,1,'do-while-loop','2019-01-19 23:07:30','2019-01-19 23:07:30'),(18,7,'for Loop',NULL,18.00,1,1,'for-loop','2019-01-19 23:07:56','2019-01-19 23:07:56'),(19,7,'foreach Loop',NULL,19.00,1,1,'foreach-Loop','2019-01-19 23:08:29','2019-01-19 23:08:29'),(20,2,'Syntax',NULL,2.00,1,1,'syntax','2019-01-20 17:12:43','2019-01-20 17:13:06');
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons_sections`
--

LOCK TABLES `lessons_sections` WRITE;
/*!40000 ALTER TABLE `lessons_sections` DISABLE KEYS */;
INSERT INTO `lessons_sections` VALUES (1,1,'What is PHP?','<p>PHP, the acronym stands for <strong>PHP: Hypertext Preprocessor</strong>, it&#39;s an open source programming language (everyone is free to use it and modify it) used on the <strong>server-side</strong> (runned by a server).</p>\r\n\r\n<p>PHP it&#39;s&nbsp;particularly used in building <strong>web applications</strong> and it can&nbsp;be integrated with HTML.&nbsp;</p>','text','checkbox',1.00,1,1,'2019-01-20 15:19:24','2019-01-20 17:49:24'),(2,1,NULL,'<p>What does the acronym PHP stands for?</p>','quiz','radio',2.00,1,0,'2019-01-20 15:42:23','2019-01-20 16:26:17'),(3,1,NULL,'<p>PHP&nbsp;was&nbsp;created by&nbsp;Rasmus Lerdorf in&nbsp;1994. Since then it evolved with every new release, currently it&#39;s latest major version is&nbsp;<strong>7</strong>.</p>','text','checkbox',3.00,1,1,'2019-01-20 16:42:06','2019-01-26 23:36:55'),(4,1,NULL,'<p>What is the latest major version of PHP?</p>','quiz','radio',4.00,1,1,'2019-01-20 16:43:53','2019-01-20 16:45:07'),(7,2,NULL,'<p>PHP is server-side programming language. If you want to use it, you will&nbsp;need to install a local server.</p>\r\n\r\n<p>To do that, you can install the XAMPP application from here&nbsp;<a href=\"https://www.apachefriends.org\" target=\"_blank\">https://www.apachefriends.org</a>.</p>\r\n\r\n<p>&nbsp;</p>','text','checkbox',1.00,0,1,'2019-01-20 17:02:53','2019-01-20 17:10:11'),(8,20,NULL,'<p>To tell the server that our scripts from the file represents PHP we need to include them between <strong>&lt;?php</strong>&nbsp;and <strong>?&gt;</strong>.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>A PHP file must also have the extension <strong>.php</strong>&nbsp;at the ending of it&#39;s name, like &quot;contact_us.php&quot;.</p>\r\n\r\n<p>&nbsp;</p>','text','checkbox',1.00,1,0,'2019-01-20 17:14:26','2019-01-28 20:42:24'),(9,20,NULL,'<p>What are the delimiters for the PHP scripts?</p>','quiz','radio',2.00,1,1,'2019-01-20 17:15:30','2019-01-20 17:16:41'),(10,20,'Comments','<p>When writing PHP code we may want to add some <strong>explanation&nbsp;lines</strong>&nbsp;or just add some <strong>short descriptions</strong>. This is&nbsp;a thing that it&#39;s quite encouraged, this way you or somebody else will understand better the purpose of your code.</p>\r\n\r\n<p>The <strong>server will not&nbsp;use them</strong>, it will treat them as they don&#39;t exist among the code.</p>\r\n\r\n<p>To add a single line of comment use <strong>//</strong>&nbsp;at the beginning of the line.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n//This is a single line of comment\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>&nbsp;&nbsp;</p>','text','checkbox',3.00,1,0,'2019-01-20 17:20:59','2019-01-29 23:04:25'),(12,20,NULL,'<p>How must a single line of comment&nbsp;start in PHP?</p>','quiz','radio',4.00,1,1,'2019-01-20 17:34:33','2019-01-20 17:36:54'),(13,20,NULL,'<p>If you need to add&nbsp;longer comments you can use&nbsp;the delimeters <strong>/*</strong>, that marks the start, and <strong>*/</strong>&nbsp;that marks the end of the comment.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n/* This is the first line\r\nhere is the second line\r\n\r\nand here is the last line\r\n*/\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>','text','checkbox',5.00,1,0,'2019-01-20 17:38:05','2019-01-28 20:43:06'),(15,20,NULL,'<p>How do you add comments in PHP?</p>','quiz','checkbox',6.00,1,1,'2019-01-20 17:44:50','2019-01-20 17:45:43'),(16,3,NULL,'<p>The <strong>variables</strong> are used as containers, like boxes, where we can keep <strong>values</strong>.</p>\r\n\r\n<p>Their names should always have&nbsp;the <strong>$</strong>&nbsp;symbol&nbsp;at the beginning, followed by a letter or &quot;_&quot; (underscore). After that you can either use letters, numbers or underscore, like &quot;$first_name&quot; or &quot;$_address1&quot;. Beside underscore no other special characters (like &quot;+, -, *, %&nbsp;...&quot;) are allowed for&nbsp;the name.</p>\r\n\r\n<p>The names are <strong>case sensitive </strong>(PHP makes the difference between uppercase and lowercase letters of the name),&nbsp;so PHP&nbsp;will see&nbsp;&quot;$movieName&quot; as one variable and &quot;$moviename&quot; as another variable.&nbsp;</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n\r\n$first_name = \'Edward\';\r\n\r\n$description = \'This is a PHP course\';\r\n\r\n$month_number = 11;\r\n\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>','text','checkbox',1.00,1,0,'2019-01-26 23:46:01','2019-02-07 01:30:23'),(17,3,NULL,'<p>Which variable names are correct?</p>','quiz','checkbox',2.00,1,0,'2019-01-27 00:12:29','2019-01-27 00:19:06'),(18,3,NULL,'<p>As their names&nbsp;suggests (&quot;variables&quot;)&nbsp;we can change the content of a variable as many times as we want, <strong>the content&nbsp;is variable</strong>. We can also assign the value from one variable to another one.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?\r\n\r\n$fruit = \'apple\';\r\n\r\n$fruit = \'mango\';\r\n\r\n$tropical_fruit = $fruit;\r\n\r\n//it will display the value \'mango\'\r\necho $tropical_fruit;\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>The semicolor symbol <strong>;</strong>&nbsp;is required to signal the end of an line instruction.</p>\r\n\r\n<p>We use <strong>echo</strong>&nbsp;when we want to output a value.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>','text','checkbox',3.00,1,0,'2019-01-27 00:22:56','2019-01-28 21:01:20'),(20,3,NULL,'<p>How many times can we change the value of a variable?</p>','quiz','radio',4.00,1,1,'2019-01-27 00:37:41','2019-01-27 00:39:26'),(22,4,'Constants','<p>As the name already says, opposite to the variables, the constant&#39;s <strong>value is constant</strong>, it doesn&#39;t change during the application&#39;s execution.</p>\r\n\r\n<p>To define a constant you need to use the function <strong>define()</strong>.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?\r\n\r\n//we create the constant PI\r\ndefine(\"PI\", 3.14);\r\n\r\necho PI;\r\n//will output 3.14\r\n\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>In the name of a constant we don&#39;t use&nbsp;the symbol $ at the beginning. Also, as a convention among programmers, their names are written with <strong>uppercase letters</strong>, to make them easier to identify.</p>\r\n\r\n<p><span class=\"marker\">Remember to use double quotations marks, <strong>&quot;&quot;</strong>, when defining the name inside the function define().</span></p>','text','checkbox',1.00,1,0,'2019-01-28 21:44:36','2019-01-29 23:08:47'),(23,4,NULL,'<p>What function we use to define constants?</p>','quiz','radio',2.00,1,1,'2019-01-29 23:08:50','2019-02-06 22:35:27'),(24,4,NULL,'<p>In order to check if a constant if defined you can use the function <strong>defined</strong>. This function will return <strong>1</strong> if the constant has been defined or <strong>0</strong> if it hasn&#39;t been defined.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n//check if the constant has been defined\r\necho defined(\"PI\")\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>','text','checkbox',3.00,1,1,'2019-02-07 00:32:01','2019-02-07 00:41:52'),(25,4,NULL,NULL,'text',NULL,4.00,0,1,'2019-02-07 00:43:41','2019-02-07 00:43:41'),(26,4,NULL,NULL,'text',NULL,5.00,0,1,'2019-02-07 00:44:47','2019-02-07 00:44:47'),(27,4,NULL,NULL,'text',NULL,6.00,0,1,'2019-02-07 00:45:24','2019-02-07 00:45:24'),(28,4,NULL,'<p>What value will output the function defined if the constant has been defined?</p>','quiz','radio',4.00,1,1,'2019-02-07 00:45:58','2019-02-07 00:46:31'),(29,5,NULL,'<p>In PHP applications we can work with multiple types of data. The variables can have the following types of data:</p>\r\n\r\n<ul>\r\n	<li><strong>Integer</strong></li>\r\n	<li><strong>Float</strong></li>\r\n	<li><strong>String</strong></li>\r\n	<li><strong>Boolean</strong></li>\r\n	<li><strong>Array</strong></li>\r\n	<li><strong>Object</strong></li>\r\n	<li><strong>Resource</strong></li>\r\n	<li><strong>NULL</strong></li>\r\n</ul>\r\n\r\n<p>By default, the variables don&#39;t have any type of data assign to them,&nbsp;the <strong>PHP interpretor will&nbsp;evaluate and cast their type at the run-time</strong> (the moment of script&#39;s execution).&#39;</p>\r\n\r\n<p>You can check the type of a variable using <strong>gettype()</strong>.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$name = \'Johnny\';\r\n$price = 56;\r\n\r\necho gettype($name);\r\n//will output string\r\n\r\necho gettype($price);\r\n//will output integer\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>','text','checkbox',1.00,1,1,'2019-02-07 00:56:01','2019-02-16 23:30:03'),(30,5,NULL,'<p>The PHP interpretor will evaluate the variables and cast their type at the run-time.</p>','quiz','radio',2.00,1,1,'2019-02-10 19:44:59','2019-02-10 19:53:31'),(31,5,'Integer and Float','<p>Integer and&nbsp; Float&nbsp;types are used for numeric values.</p>\r\n\r\n<p>The <strong>integer type is for non-decimal values</strong>, between&nbsp;-2,147,483,648 and 2,147,483,647. They can be either positive or negative.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$month_number = 11;\r\n\r\n$temperature = -16;\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>The <strong>float type (also known as double)&nbsp;is used for numbers with a decimal point</strong>. You can convert a&nbsp;float number to an integer using the cast operator (int) (returns the number without decimal).</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\n\r\n//the float variable\r\n$price = 22.89;\r\n\r\n//get the integer value of the $price\r\n$integer_price = (int)$price;\r\n\r\n//will return 22\r\necho $integer_price;\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>','text','checkbox',3.00,1,1,'2019-02-10 19:58:32','2019-02-10 20:36:33'),(32,5,NULL,'<p>What type of value is the number 456.72?</p>','quiz','radio',4.00,1,1,'2019-02-10 20:37:08','2019-02-10 20:39:21'),(33,5,'String','<p>A <strong>string is represented by a series of characters</strong>. There is no rule for the maximum number of characters a string may have. Compared with integer or float, a string can have any type of character. A string normally starts with <strong>&#39;</strong>&nbsp;and ends with <strong>&#39;</strong> or <strong>&quot;</strong> and ends with <strong>&quot;</strong>.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$address = \'8th Street, nr. 36\';\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>When using double quotes we may also pass variable into the string.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$name = \'Mike\';\r\n\r\n$age  = 32;\r\n\r\n$person_description = \"His name is $name, and he\'s $age years old.\";\r\necho $person_description;\r\n// this will output \"His name is Mike, and he\'s 32 years old.\"\r\n\r\n?&gt;</code></pre>','text','checkbox',5.00,1,1,'2019-02-10 20:40:31','2019-02-10 22:00:59'),(34,5,NULL,'<p>Which type of quotes allow inserting the variables value into a&nbsp;string?</p>','quiz','radio',6.00,1,1,'2019-02-10 21:54:48','2019-02-10 21:56:44'),(36,5,NULL,'<p>&nbsp;When using double quotes we can also pass into strings special characters like:</p>\r\n\r\n<ul>\r\n	<li>\\n - line feed;</li>\r\n	<li>\\r -&nbsp;carriage return;</li>\r\n	<li>\\t -&nbsp;horizontal tab;</li>\r\n	<li>\\\\ - backslash;</li>\r\n	<li>\\$ - dollar sign;</li>\r\n</ul>\r\n\r\n<p>Both \\n and \\r are used to move the text to a new line.&nbsp;</p>\r\n\r\n<p><span class=\"marker\">To escape variables(just show their names not value) and&nbsp;double quotes or single quotes (depending on how you start and end the assigning&nbsp;of the text), or backslash you need to use backslash.</span></p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$apples = \'Green apples\';\r\n\r\n$shop_text = \"The price of the apples has increased with 60 percent \\nso now they are called \\$apples or business\\\\rich apples. \\n \\t - by \\\"Shop News\\\"\";\r\n\r\necho $shop_text;\r\n/*\r\nwill output\r\n\r\nThe price of the apples has increased with 60 percent \r\nso now they are called $apples or business\\rich apples. \r\n 	 - by \"Shop News\"\r\n\r\n- we added a new line with \\n\r\n- escaped the variable $apples so we didn\'t passed it\'s value into the string\r\n- escaped the backslash with backslash so \\r won\'t make a new line \r\n- added a tab with \\t\r\n- escaped double quotes with backslash\r\n*/\r\n\r\n?&gt;</code></pre>\r\n\r\n<p><em>It&#39;s recommended to put strings inside double quotes only when needed, as PHP will slightly need more time to check the content of a string inside double quotes than single quotes, so the script&#39;s execution with take slightly more time.</em></p>','text','checkbox',7.00,1,1,'2019-02-10 21:58:05','2019-02-10 22:06:28'),(38,5,NULL,'<p>What will be the output of the following lines:</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$name = \'Ethan\';\r\n\r\n$text = \"My $name is \\$name, web development is great.\";\r\n\r\necho $text;\r\n\r\n?&gt;</code></pre>','quiz','radio',8.00,1,1,'2019-02-10 22:26:32','2019-02-10 22:37:05'),(39,5,'Boolean','<p>Boolean variables have a logical value. The boolean value can be wither <strong>TRUE</strong> or <strong>FALSE</strong>.&nbsp;</p>\r\n\r\n<p>You can convert other types of values to boolean the cast operator&nbsp;<strong>(bool)</strong>, but in general you won&#39;t be needed to use it, PHP will recognize it&#39;s logical values. Values like 0 or empty strings will automatically be converted to False, while strings or number that have other values than 0 will be converted to True.</p>\r\n\r\n<p>These boolean values are case-insensitive for PHP, so you can either write TRUE, true or True, same with the FALSE.</p>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n$correct = true;\r\n\r\n$still_correct = (bool)\'Hello\';\r\n//this also has the value true;\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>','text','checkbox',9.00,1,0,'2019-02-16 23:09:22','2019-02-16 23:26:07'),(40,5,NULL,'<p>What is the boolean value of the number <strong>25</strong>?</p>\r\n\r\n<p>&nbsp;</p>','quiz','radio',10.00,1,1,'2019-02-16 23:30:49','2019-02-16 23:33:41'),(41,5,'NULL','<p><strong>NULL</strong>&nbsp;are the variables that don&#39;t have any value assigned to them, it represents the absence of any value.</p>\r\n\r\n<p>A variable can be&nbsp;NULL if:</p>\r\n\r\n<ul>\r\n	<li>it has been assign to the NULL value;</li>\r\n	<li>it hasn&#39;t been assign any value to it;</li>\r\n	<li>it&#39;s value has been removed using the function <strong>unset()</strong>;&nbsp;</li>\r\n</ul>\r\n\r\n<pre>\r\n<code class=\"language-php\">&lt;?php\r\n\r\n\r\n$name;\r\n//it\'s null \r\n\r\n$address = null;\r\n//it\'s null\r\n\r\n$phone_number = \'0226565333222\';\r\n\r\nunset($phone_number);\r\n//it\'s null now\r\n\r\n?&gt;</code></pre>\r\n\r\n<p>&nbsp;</p>','text','checkbox',11.00,1,1,'2019-02-16 23:34:59','2019-02-16 23:55:04'),(42,5,NULL,'<p>How can you set a variable to NULL?</p>','quiz','checkbox',12.00,1,0,'2019-02-16 23:48:46','2019-02-16 23:55:40'),(43,6,NULL,NULL,'text',NULL,1.00,0,1,'2019-02-17 00:28:23','2019-02-17 00:28:23');
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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons_sections_options`
--

LOCK TABLES `lessons_sections_options` WRITE;
/*!40000 ALTER TABLE `lessons_sections_options` DISABLE KEYS */;
INSERT INTO `lessons_sections_options` VALUES (6,2,'1','Protected HiProcessor',1.00,0,1,'2019-01-20 16:26:17','2019-01-20 16:26:17'),(7,2,'2','PHP: Hypertext Preprocessor',2.00,1,1,'2019-01-20 16:26:17','2019-01-20 16:26:17'),(8,2,'3','Private Home Processor',3.00,0,1,'2019-01-20 16:26:17','2019-01-20 16:26:17'),(9,4,'a','19',1.00,0,1,'2019-01-20 16:45:07','2019-01-20 16:45:07'),(10,4,'b','4',2.00,0,1,'2019-01-20 16:45:07','2019-01-20 16:45:07'),(11,4,'c','7',3.00,1,1,'2019-01-20 16:45:07','2019-01-20 16:45:07'),(15,9,'a','<?php   ?>',1.00,1,1,'2019-01-20 17:16:41','2019-01-20 17:16:41'),(16,9,'b','<?code   ?>',2.00,0,1,'2019-01-20 17:16:41','2019-01-20 17:16:41'),(17,9,'c','<!   !>',3.00,0,1,'2019-01-20 17:16:41','2019-01-20 17:16:41'),(24,12,'a','//',1.00,1,1,'2019-01-20 17:36:54','2019-01-20 17:36:54'),(25,12,'b','??',2.00,0,1,'2019-01-20 17:36:54','2019-01-20 17:36:54'),(26,12,'c','>>',3.00,0,1,'2019-01-20 17:36:54','2019-01-20 17:36:54'),(31,15,'a','>> Comment',1.00,0,1,'2019-01-20 17:45:45','2019-01-20 17:45:45'),(32,15,'b','/* Comment */',2.00,1,1,'2019-01-20 17:45:45','2019-01-20 17:45:45'),(33,15,'c','// Comment',3.00,1,1,'2019-01-20 17:45:45','2019-01-20 17:45:45'),(34,15,'d','/ Comment //',4.00,0,1,'2019-01-20 17:45:45','2019-01-20 17:45:45'),(35,17,'a','#country_name',1.00,0,1,'2019-01-27 00:19:06','2019-01-27 00:19:06'),(36,17,'b','$lastName^',2.00,0,1,'2019-01-27 00:19:06','2019-01-27 00:19:06'),(37,17,'c','$color1',3.00,1,1,'2019-01-27 00:19:06','2019-01-27 00:19:06'),(38,17,'d','$1gender',4.00,0,1,'2019-01-27 00:19:06','2019-01-27 00:19:06'),(39,17,'e','$_dog_Breed',5.00,1,1,'2019-01-27 00:19:06','2019-01-27 00:19:06'),(40,20,'1','One time',1.00,0,1,'2019-01-27 00:39:26','2019-01-27 00:39:26'),(41,20,'2','Two times',2.00,0,1,'2019-01-27 00:39:26','2019-01-27 00:39:26'),(42,20,'3','As many times as we want',3.00,1,1,'2019-01-27 00:39:26','2019-01-27 00:39:26'),(43,20,'4','Never',4.00,0,1,'2019-01-27 00:39:26','2019-01-27 00:39:26'),(44,23,'a','output()',1.00,0,1,'2019-02-06 22:35:27','2019-02-06 22:35:27'),(45,23,'b','set()',2.00,0,1,'2019-02-06 22:35:27','2019-02-06 22:35:27'),(46,23,'c','define()',3.00,1,1,'2019-02-06 22:35:27','2019-02-06 22:35:27'),(47,28,'a','1',1.00,1,1,'2019-02-07 00:46:31','2019-02-07 00:46:31'),(48,28,'b','2',2.00,0,1,'2019-02-07 00:46:31','2019-02-07 00:46:31'),(49,28,'c','3',3.00,0,1,'2019-02-07 00:46:31','2019-02-07 00:46:31'),(54,30,'a','True',1.00,1,1,'2019-02-10 19:53:31','2019-02-10 19:53:31'),(55,30,'b','False',2.00,0,1,'2019-02-10 19:53:31','2019-02-10 19:53:31'),(56,32,'a','Float',1.00,1,1,'2019-02-10 20:39:21','2019-02-10 20:39:21'),(57,32,'b','Integer',2.00,0,1,'2019-02-10 20:39:21','2019-02-10 20:39:21'),(58,34,'a','Single quotes (\')',1.00,0,1,'2019-02-10 21:56:44','2019-02-10 21:56:44'),(59,34,'b','Double quotes (\")',2.00,1,1,'2019-02-10 21:56:44','2019-02-10 21:56:44'),(68,38,'a','My name is Ethan, web development is great.',1.00,0,1,'2019-02-10 22:37:05','2019-02-10 22:37:05'),(69,38,'b','My $name is Ethan, web development is great.',2.00,0,1,'2019-02-10 22:37:05','2019-02-10 22:37:05'),(70,38,'c','My Ethan is $name, web development is great.',3.00,1,1,'2019-02-10 22:37:05','2019-02-10 22:37:05'),(71,38,'d','My Ethan is Ethan, web development is great.',4.00,0,1,'2019-02-10 22:37:05','2019-02-10 22:37:05'),(72,40,'a','TRUE',1.00,1,1,'2019-02-16 23:33:41','2019-02-16 23:33:41'),(73,40,'b','FALSE',2.00,0,1,'2019-02-16 23:33:41','2019-02-16 23:33:41'),(79,42,'a','$variable = null;',1.00,1,1,'2019-02-16 23:55:40','2019-02-16 23:55:40'),(80,42,'b','$variable = \'\';',2.00,0,1,'2019-02-16 23:55:40','2019-02-16 23:55:40'),(81,42,'c','$variable = 0;',3.00,0,1,'2019-02-16 23:55:40','2019-02-16 23:55:40'),(82,42,'d','unset($variable);',4.00,1,1,'2019-02-16 23:55:40','2019-02-16 23:55:40'),(83,42,'e','$variable = -1',5.00,0,1,'2019-02-16 23:55:40','2019-02-16 23:55:40');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logins`
--

LOCK TABLES `logins` WRITE;
/*!40000 ALTER TABLE `logins` DISABLE KEYS */;
INSERT INTO `logins` VALUES (1,1,'192.168.10.1','2019-01-17 21:55:20',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(2,1,'192.168.10.1','2019-01-19 13:12:10',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(3,1,'192.168.10.1','2019-01-19 16:10:09',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(4,1,'192.168.10.1','2019-01-19 21:39:21',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(5,1,'192.168.10.1','2019-01-20 02:34:18',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(6,1,'192.168.10.1','2019-01-20 14:30:03',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(7,1,'192.168.10.1','2019-01-20 21:37:51',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(8,1,'192.168.10.1','2019-01-26 23:32:40',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(9,1,'192.168.10.1','2019-01-28 20:41:12',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(10,1,'192.168.10.1','2019-01-29 23:01:11',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'),(11,1,'192.168.10.1','2019-02-06 22:32:34',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36'),(12,1,'192.168.10.1','2019-02-10 19:41:56',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36'),(13,1,'192.168.10.1','2019-02-16 23:07:32',1,NULL,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_files`
--

LOCK TABLES `media_files` WRITE;
/*!40000 ALTER TABLE `media_files` DISABLE KEYS */;
INSERT INTO `media_files` VALUES (1,'php_elephant.jpg','uploads/media_library/2019/01/php_elephant.jpg','/home/vagrant/Projects/redtutorial_prod/public/uploads/media_library/2019/01','jpg','2019-01-19 21:52:13','2019-01-19 21:52:13');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_files_to_items`
--

LOCK TABLES `media_files_to_items` WRITE;
/*!40000 ALTER TABLE `media_files_to_items` DISABLE KEYS */;
INSERT INTO `media_files_to_items` VALUES (1,1,1,'course','2019-01-19 21:52:13','2019-01-19 21:52:13');
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2018_02_04_230147_migration_cartalyst_sentinel',1),(2,'2018_02_24_135203_create_table_courses',1),(3,'2018_02_25_182859_create_login_table',1),(4,'2018_04_29_225354_create_table_lessons',1),(5,'2018_06_06_232415_create_slugs_table',1),(6,'2018_06_26_212258_create_media_files_table',1),(7,'2018_07_21_002304_create_emails_table',1),(8,'2018_10_05_010456_create_static_pages_table',1),(9,'2018_10_07_221954_create_contact_messages_table',1),(10,'2018_10_07_222321_create_contact_messages_to_users_table',1),(11,'2018_10_08_154805_alter_static_pages_add_meta_update_title',1),(12,'2018_10_16_175433_alter_messages_to_user_add_is_deleted_is_flaged_columns',1),(13,'2018_10_18_143241_alter_user_table_add_phone_second_email',1),(14,'2018_11_02_174210_alter_courses_drop_level_column',1),(15,'2018_11_05_203337_alter_courses_table_add_symbol_class',1),(16,'2018_11_07_232326_create_table_lessons_sections',1),(17,'2018_11_07_233338_create_alter_lessons_drop_content',1),(18,'2018_11_09_183622_create_table_lesson_sections_options',1),(19,'2018_11_09_185349_alter_table_lesson_sections_add_order_weight',1),(20,'2018_11_10_173529_alter_table_lesson_sections_options_add_order_weight_value',1),(21,'2018_11_10_174227_alter_table_lesson_sections_options_add_is_public',1),(22,'2018_11_11_172153_alter_table_lessons_sections_add_options_type',1),(23,'2018_11_11_173345_alter_table_lessons_sections_options_drop_type',1),(24,'2018_11_20_195701_create_media_files_to_items',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persistences`
--

LOCK TABLES `persistences` WRITE;
/*!40000 ALTER TABLE `persistences` DISABLE KEYS */;
INSERT INTO `persistences` VALUES (1,1,'oHemHn7GQniuXBjSlUFMjvW59r5vtE9A','2019-01-17 21:55:20','2019-01-17 21:55:20'),(2,1,'r1J4HwOK8ZDdLSVR5B8At6bnawgR8X9I','2019-01-19 13:12:10','2019-01-19 13:12:10'),(3,1,'M2BpjpwAqOoJFdHvOwmwVtXWm46hgTgT','2019-01-19 16:10:08','2019-01-19 16:10:08'),(4,1,'yA62OfLjox4ac5VZMkRhgc5dwKpmT8rx','2019-01-19 21:39:21','2019-01-19 21:39:21'),(5,1,'4grF3MDru99zjdfszlBUHJSObS8hI2Om','2019-01-20 02:34:18','2019-01-20 02:34:18'),(6,1,'IgcXT1pNlaCSNuCKmburZbHRYEJ2PmPl','2019-01-20 14:30:03','2019-01-20 14:30:03'),(7,1,'kmgWfjkLEmb89O9Bi56HqV1JjaHBikL3','2019-01-20 21:37:51','2019-01-20 21:37:51'),(8,1,'sqeAKgmopjfJnQTv4z5ndfltmeQbqRR8','2019-01-26 23:32:40','2019-01-26 23:32:40'),(9,1,'BuqTCfrcsnDNCp9xApCn0ju3nVayanJY','2019-01-28 20:41:12','2019-01-28 20:41:12'),(10,1,'GwrXS6Kku3D7XO1ngrmAoLsHCfA0bZDD','2019-01-29 23:01:11','2019-01-29 23:01:11'),(11,1,'Vsz0QutoLsLipYlytNARKDyLxoHdeClw','2019-02-06 22:32:34','2019-02-06 22:32:34'),(12,1,'m2tDWofvplLXGpdGHuWP57w9lXX5x4mR','2019-02-10 19:41:56','2019-02-10 19:41:56'),(13,1,'zS6twsQwzJ7mORRsVFuATqvBGnxvrbKJ','2019-02-16 23:07:32','2019-02-16 23:07:32');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminders`
--

LOCK TABLES `reminders` WRITE;
/*!40000 ALTER TABLE `reminders` DISABLE KEYS */;
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
INSERT INTO `role_users` VALUES (1,1,'2019-01-12 23:58:45','2019-01-12 23:58:45'),(2,1,'2019-01-12 23:58:45','2019-01-12 23:58:45');
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
-- Table structure for table `slugs`
--

DROP TABLE IF EXISTS `slugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slugs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slugs_slug_index` (`slug`),
  KEY `slugs_table_index` (`table`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slugs`
--

LOCK TABLES `slugs` WRITE;
/*!40000 ALTER TABLE `slugs` DISABLE KEYS */;
/*!40000 ALTER TABLE `slugs` ENABLE KEYS */;
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
INSERT INTO `static_pages` VALUES (1,'Terms and Conditions','Terms and Conditions','Terms and Conditions','Terms and Conditions','<p><strong>Terms and Conditions</strong></p>','terms-and-conditions',1,1,'2019-02-06 22:42:22','2019-02-06 22:42:22'),(2,'Privacy','Privacy','Privacy','Privacy',NULL,'privacy',1,1,'2019-02-06 22:43:31','2019-02-06 22:43:31');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `throttle`
--

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'robu.edi@gmail.com',NULL,NULL,'$2y$10$ZmhAMX8FkNqrZR6fzs7Dq.aDwGcbzOHMXcntVGAzNkbjjhslPE.Mu','{\"user.admin.view\":true,\"user.admin.create\":true,\"user.admin.edit\":true,\"user.admin.delete\":true,\"user.admin.deactivate_user\":true,\"user.client.view\":true,\"user.client.create\":true,\"user.client.edit\":true,\"user.client.delete\":true,\"user.client.deactivate_user\":true}','2019-02-16 23:07:32','Eduard','Robu','2019-01-12 23:58:45','2019-02-16 23:07:32'),(2,'edi_cristi3@yahoo.com',NULL,NULL,'$2y$10$Ci5G1f4HfL1lKljlFR01Su1D6cck9jY5Pz./xjMA5HQ55wTpO5AKC','{\"user.client.view\":true,\"user.client.create\":true,\"user.client.edit\":true}',NULL,'Eduard','Robu','2019-01-12 23:58:45','2019-01-12 23:58:45');
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

-- Dump completed on 2019-02-17  1:56:01