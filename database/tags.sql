-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: nyistbbs
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
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'前端','Front Web',8),(2,'后端','Back Web',15),(3,'数据库','Database',4),(4,'服务器','Server',3),(5,'网络','NetWork',3),(6,'操作系统','Operating System',3),(7,'算法','Algorithm',2),(8,'学习路线','Learning route',20),(9,'学习笔记','Learning Notes',22),(10,'踩坑排错','DeBug',4),(11,'吐槽','Discuss',13),(12,'人生感悟','Life Perception',24),(13,'面经','Interview Experience',13),(14,'内推','Internal Recommendation',3),(15,'校招','Campus Recruitment',4),(16,'社招','Social Recruitment',1),(17,'开源推荐','Open Source Recommend',3);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tags_topics`
--

LOCK TABLES `tags_topics` WRITE;
/*!40000 ALTER TABLE `tags_topics` DISABLE KEYS */;
INSERT INTO `tags_topics` VALUES (1,12,60),(2,1,59),(3,17,58),(4,3,57),(5,2,56),(6,8,37),(7,12,37),(8,13,37),(9,12,36),(10,2,16),(11,12,16),(12,13,16),(13,12,15),(14,13,15),(15,12,10),(16,8,9),(17,12,9),(18,11,8),(19,8,7),(20,12,7),(21,3,6),(22,13,6),(23,1,5),(24,8,5),(25,6,4),(26,9,4),(27,5,3),(28,13,3),(29,2,2),(30,6,2),(31,13,2),(34,5,1),(35,9,1),(37,17,55),(38,1,54),(39,8,54),(40,9,54),(41,3,53),(42,8,53),(43,9,53),(44,4,52),(45,8,52),(46,9,52),(47,7,51),(48,8,51),(49,9,51),(50,2,50),(51,8,50),(52,9,50),(53,11,35),(54,12,35),(55,13,35),(56,11,34),(57,11,33),(58,12,33),(59,8,11),(60,12,11),(61,1,28),(62,13,28),(63,11,12),(64,12,12),(65,2,48),(66,9,48),(67,2,47),(68,9,47),(69,11,13),(70,12,13),(71,2,43),(72,9,43),(73,2,42),(74,4,42),(75,9,42),(76,12,14),(77,2,30),(78,4,30),(79,8,30),(80,8,29),(81,9,29),(82,11,22),(83,12,22),(84,8,17),(85,11,17),(86,12,17),(87,2,49),(88,8,49),(89,13,41),(90,15,41),(91,11,32),(92,12,32),(93,10,31),(94,8,26),(95,12,26),(96,14,25),(97,15,25),(98,14,24),(99,15,24),(100,11,39),(101,12,39),(102,8,38),(103,12,38),(104,10,27),(105,2,46),(106,9,46),(107,2,45),(108,9,45),(109,2,44),(110,9,44),(111,8,20),(112,11,18),(113,12,18),(114,1,40),(115,13,40),(116,11,21),(117,12,21),(118,8,19),(119,12,19),(120,13,19),(121,1,61),(122,1,65),(123,9,65),(124,10,65),(125,1,66),(126,9,66),(127,2,67),(128,3,68),(129,9,68),(130,13,68),(133,4,69),(134,9,69),(135,5,70),(136,9,70),(137,6,71),(138,7,72),(139,9,72),(140,2,73),(141,8,73),(142,9,73),(143,14,74),(144,15,74),(145,16,74),(146,17,75),(147,8,76),(148,12,76),(149,13,76),(150,10,77),(151,11,77);
/*!40000 ALTER TABLE `tags_topics` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-13 14:31:57
