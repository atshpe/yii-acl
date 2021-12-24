-- MariaDB dump 10.19  Distrib 10.5.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: yii_acl
-- ------------------------------------------------------
-- Server version	10.5.12-MariaDB-1:10.5.12+maria~focal

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

--
-- Table structure for table `acl_rule`
--

DROP TABLE IF EXISTS `acl_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `controller` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_rule`
--

LOCK TABLES `acl_rule` WRITE;
/*!40000 ALTER TABLE `acl_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_rule_action`
--

DROP TABLE IF EXISTS `acl_rule_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_rule_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(50) NOT NULL,
  `rule_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_action_rule_id` (`rule_id`),
  CONSTRAINT `fk_action_rule_id` FOREIGN KEY (`rule_id`) REFERENCES `acl_rule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_rule_action`
--

LOCK TABLES `acl_rule_action` WRITE;
/*!40000 ALTER TABLE `acl_rule_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_rule_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_rule_assertion`
--

DROP TABLE IF EXISTS `acl_rule_assertion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_rule_assertion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(50) NOT NULL,
  `rule_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_assertion_rule_id` (`rule_id`),
  CONSTRAINT `fk_assertion_rule_id` FOREIGN KEY (`rule_id`) REFERENCES `acl_rule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_rule_assertion`
--

LOCK TABLES `acl_rule_assertion` WRITE;
/*!40000 ALTER TABLE `acl_rule_assertion` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_rule_assertion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_rule_roles`
--

DROP TABLE IF EXISTS `acl_rule_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_rule_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(50) NOT NULL,
  `rule_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_roles_rule_id` (`rule_id`),
  CONSTRAINT `fk_roles_rule_id` FOREIGN KEY (`rule_id`) REFERENCES `acl_rule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_rule_roles`
--

LOCK TABLES `acl_rule_roles` WRITE;
/*!40000 ALTER TABLE `acl_rule_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_rule_roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-24  7:37:08
