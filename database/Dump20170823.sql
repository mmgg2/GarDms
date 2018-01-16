CREATE DATABASE  IF NOT EXISTS `gestorDoc` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `gestorDoc`;
-- MySQL dump 10.13  Distrib 5.5.55, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: gestorDoc
-- ------------------------------------------------------
-- Server version	5.5.55-0ubuntu0.14.04.1

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
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentos` (
  `id_documentos` int(11) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `Path` varchar(250) DEFAULT NULL,
  `etiqueta` varchar(250) DEFAULT NULL,
  `idsiniestros` varchar(250) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `timestampCreacion` timestamp NULL DEFAULT NULL,
  `flagDelete` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_documentos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
INSERT INTO `documentos` VALUES (0,'test description ','Siniestros/rama1/codigo1/rama1-codigo1.pdf','test1','0','test1',NULL,NULL);
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moderatorDocumentos`
--

DROP TABLE IF EXISTS `moderatorDocumentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moderatorDocumentos` (
  `idmoderatorDocumentos` int(11) NOT NULL,
  `id_object` varchar(250) DEFAULT NULL,
  `isSiniestro` varchar(250) DEFAULT NULL,
  `timestampCreacion` varchar(250) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `codRama` varchar(250) DEFAULT NULL,
  `codSiniestro` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idmoderatorDocumentos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moderatorDocumentos`
--

LOCK TABLES `moderatorDocumentos` WRITE;
/*!40000 ALTER TABLE `moderatorDocumentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `moderatorDocumentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siniestros`
--

DROP TABLE IF EXISTS `siniestros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siniestros` (
  `idsiniestros` int(11) NOT NULL,
  `codRama` varchar(250) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `etiqueta` varchar(250) DEFAULT NULL,
  `codSiniestro` varchar(250) DEFAULT NULL,
  `timestampCreacion` varchar(250) DEFAULT NULL,
  `flagDelete` varchar(250) DEFAULT NULL,
  `safe` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idsiniestros`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siniestros`
--

LOCK TABLES `siniestros` WRITE;
/*!40000 ALTER TABLE `siniestros` DISABLE KEYS */;
INSERT INTO `siniestros` VALUES (0,'rama1','test','test','codigo1',NULL,NULL,NULL);
/*!40000 ALTER TABLE `siniestros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `categoria` varchar(250) DEFAULT NULL,
  `habilitado` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `lastName` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'mgarbate','123',NULL,'admin','SI','maxi','Garbate');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-23 16:53:37
