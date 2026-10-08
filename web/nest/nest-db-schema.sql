-- MySQL dump 10.14  Distrib 5.5.68-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: NEST
-- ------------------------------------------------------
-- Server version	5.5.68-MariaDB

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
-- Table structure for table `BunnyWAF`
--

DROP TABLE IF EXISTS `BunnyWAF`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BunnyWAF` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `received_at` datetime NOT NULL,
  `hostname` varchar(255) NOT NULL,
  `program` varchar(64) NOT NULL,
  `event_time` time DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `method` varchar(16) DEFAULT NULL,
  `request` varchar(2048) DEFAULT NULL,
  `type` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_received_at` (`received_at`),
  KEY `idx_host` (`host`),
  KEY `idx_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BunnyWAF`
--

LOCK TABLES `BunnyWAF` WRITE;
/*!40000 ALTER TABLE `BunnyWAF` DISABLE KEYS */;
/*!40000 ALTER TABLE `BunnyWAF` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NETADM`
--

DROP TABLE IF EXISTS `NETADM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NETADM` (
  `uname` varchar(20) NOT NULL,
  `passwd` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NETADM`
--

LOCK TABLES `NETADM` WRITE;
/*!40000 ALTER TABLE `NETADM` DISABLE KEYS */;
INSERT INTO `NETADM` VALUES ('admin','21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `NETADM` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Suricata`
--

DROP TABLE IF EXISTS `Suricata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Suricata` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `received_at` datetime NOT NULL,
  `hostname` varchar(255) NOT NULL,
  `program` varchar(64) NOT NULL,
  `event_timestamp` datetime(6) DEFAULT NULL,
  `flow_id` bigint(20) unsigned DEFAULT NULL,
  `event_type` varchar(32) DEFAULT NULL,
  `src_ip` varchar(45) DEFAULT NULL,
  `src_port` int(10) unsigned DEFAULT NULL,
  `dest_ip` varchar(45) DEFAULT NULL,
  `dest_port` int(10) unsigned DEFAULT NULL,
  `proto` varchar(16) DEFAULT NULL,
  `signature_id` bigint(20) unsigned DEFAULT NULL,
  `signature` varchar(1024) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `severity` int(11) DEFAULT NULL,
  `http_hostname` varchar(255) DEFAULT NULL,
  `http_url` varchar(4096) DEFAULT NULL,
  `http_method` varchar(16) DEFAULT NULL,
  `http_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_received_at` (`received_at`),
  KEY `idx_event_timestamp` (`event_timestamp`),
  KEY `idx_src_ip` (`src_ip`),
  KEY `idx_dest_ip` (`dest_ip`),
  KEY `idx_signature_id` (`signature_id`),
  KEY `idx_severity` (`severity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Suricata`
--

LOCK TABLES `Suricata` WRITE;
/*!40000 ALTER TABLE `Suricata` DISABLE KEYS */;
/*!40000 ALTER TABLE `Suricata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cumi`
--

DROP TABLE IF EXISTS `cumi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cumi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `received_at` datetime NOT NULL,
  `hostname` varchar(255) NOT NULL,
  `program` varchar(64) NOT NULL,
  `event_time` time DEFAULT NULL,
  `category` varchar(64) DEFAULT NULL,
  `url` varchar(2048) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `method` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `received_at` (`received_at`),
  KEY `category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cumi`
--

LOCK TABLES `cumi` WRITE;
/*!40000 ALTER TABLE `cumi` DISABLE KEYS */;
/*!40000 ALTER TABLE `cumi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delpy`
--

DROP TABLE IF EXISTS `delpy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delpy` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `received_at` datetime NOT NULL,
  `hostname` varchar(255) NOT NULL,
  `program` varchar(64) NOT NULL,
  `event_time` time DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `sensitivity` varchar(32) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `srcip` varchar(45) DEFAULT NULL,
  `file` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_received_at` (`received_at`),
  KEY `idx_host` (`host`),
  KEY `idx_srcip` (`srcip`),
  KEY `idx_signature` (`signature`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delpy`
--

LOCK TABLES `delpy` WRITE;
/*!40000 ALTER TABLE `delpy` DISABLE KEYS */;
/*!40000 ALTER TABLE `delpy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sentraID`
--

DROP TABLE IF EXISTS `sentraID`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sentraID` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `received_at` datetime NOT NULL,
  `hostname` varchar(255) NOT NULL,
  `program` varchar(64) NOT NULL,
  `event_time` time DEFAULT NULL,
  `srcip` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `received_at` (`received_at`),
  KEY `srcip` (`srcip`(191)),
  KEY `event` (`event`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sentraID`
--

LOCK TABLES `sentraID` WRITE;
/*!40000 ALTER TABLE `sentraID` DISABLE KEYS */;
/*!40000 ALTER TABLE `sentraID` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spiEDR`
--

DROP TABLE IF EXISTS `spiEDR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spiEDR` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `received_at` datetime NOT NULL,
  `hostname` varchar(255) NOT NULL,
  `program` varchar(64) NOT NULL,
  `event_time` time DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `type` varchar(64) DEFAULT NULL,
  `severity` varchar(32) DEFAULT NULL,
  `hash` varchar(128) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `srcip` varchar(45) DEFAULT NULL,
  `filepath` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_received_at` (`received_at`),
  KEY `idx_signature` (`signature`),
  KEY `idx_severity` (`severity`),
  KEY `idx_hash` (`hash`),
  KEY `idx_host` (`host`),
  KEY `idx_srcip` (`srcip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spiEDR`
--

LOCK TABLES `spiEDR` WRITE;
/*!40000 ALTER TABLE `spiEDR` DISABLE KEYS */;
/*!40000 ALTER TABLE `spiEDR` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-07 22:02:23
