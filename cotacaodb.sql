-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: cotacaodb
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.24-MariaDB

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
-- Table structure for table `cotacao_frete`
--

DROP TABLE IF EXISTS `cotacao_frete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cotacao_frete` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentual_cotacao` double(8,2) NOT NULL,
  `valor_extra` double(8,2) NOT NULL,
  `transportadora_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cotacao_frete_transportadora_id_foreign` (`transportadora_id`),
  CONSTRAINT `cotacao_frete_transportadora_id_foreign` FOREIGN KEY (`transportadora_id`) REFERENCES `transportadora` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotacao_frete`
--

LOCK TABLES `cotacao_frete` WRITE;
/*!40000 ALTER TABLE `cotacao_frete` DISABLE KEYS */;
INSERT INTO `cotacao_frete` VALUES (1,'AC',11.00,22.00,10,'2022-03-30 05:23:45','2022-03-30 05:23:45'),(2,'GO',3.00,55.00,3,'2022-03-30 05:56:29','2022-03-30 05:56:29'),(3,'AC',1.00,1.00,4,'2022-03-30 06:22:44','2022-03-30 06:22:44'),(4,'DF',5.00,12.00,2,'2022-03-30 06:23:34','2022-03-30 06:23:34'),(5,'PR',30.00,10.00,7,'2022-03-30 07:04:54','2022-03-30 07:04:54'),(6,'PR',40.00,5.00,9,'2022-03-30 07:05:03','2022-03-30 07:05:03'),(7,'PR',25.00,45.00,3,'2022-03-30 07:05:13','2022-03-30 07:05:13'),(8,'CE',12.00,12.00,9,'2022-03-30 07:57:21','2022-03-30 07:57:21'),(9,'AC',20.00,20.00,3,'2022-03-30 08:03:36','2022-03-30 08:03:36'),(10,'TO',11.00,11.00,3,'2022-03-30 08:04:34','2022-03-30 08:04:34'),(11,'AM',2.00,21.00,4,'2022-03-30 08:06:10','2022-03-30 08:06:10'),(12,'ES',1.00,22.00,9,'2022-03-30 08:10:12','2022-03-30 08:10:12'),(13,'MA',1.00,21.00,9,'2022-03-30 08:11:39','2022-03-30 08:11:39'),(14,'MG',4.00,14.00,4,'2022-03-30 08:13:33','2022-03-30 08:13:33'),(15,'PR',4.00,14.00,5,'2022-03-30 08:14:15','2022-03-30 08:14:15');
/*!40000 ALTER TABLE `cotacao_frete` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_12_14_000001_create_personal_access_tokens_table',1),(2,'2022_03_30_003228_create_transportadoras_table',1),(3,'2022_03_30_003938_create_cotacao_fretes_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transportadora`
--

DROP TABLE IF EXISTS `transportadora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transportadora` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transportadora`
--

LOCK TABLES `transportadora` WRITE;
/*!40000 ALTER TABLE `transportadora` DISABLE KEYS */;
INSERT INTO `transportadora` VALUES (1,'FL BRASIL HOLDING',NULL,NULL),(2,'TEX COURIER',NULL,NULL),(3,'TRANSPORTADORA PLIMOR',NULL,NULL),(4,'ALFA TRANSPORTES',NULL,NULL),(5,'BRASPRESS',NULL,NULL),(6,'EXPRESSO SÃO MIGUEL',NULL,NULL),(7,'FEDEX BRASIL',NULL,NULL),(8,'GRUPO BBM LOGÍSTICA',NULL,NULL),(9,'JAMEF TRANSPORTES',NULL,NULL),(10,'RTE RODONAVES',NULL,NULL);
/*!40000 ALTER TABLE `transportadora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'cotacaodb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-30  2:25:44
