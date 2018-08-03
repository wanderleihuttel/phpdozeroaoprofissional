-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: projeto_mmn
-- ------------------------------------------------------
-- Server version	5.7.22

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
-- Current Database: `projeto_mmn`
--

/*!40000 DROP DATABASE IF EXISTS `projeto_mmn`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `projeto_mmn` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `projeto_mmn`;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pai` int(11) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `patente` int(11) NOT NULL DEFAULT '1',
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `id_pai`, `nome`, `email`, `senha`, `patente`, `data_cadastro`) VALUES (1,NULL,'Admin','admin@admin','21232f297a57a5a743894a0e4a801fc3',1,'2018-08-02 20:15:30'),(2,1,'Wanderlei','wanderlei.huttel@gmail.com','e10adc3949ba59abbe56e057f20f883e',1,'2018-08-02 21:15:30'),(3,2,'Fabiane','fabiane@famacris.com.br','ceee0cf207a2a2232cf3b3ddeb1567b7',1,'2018-08-02 21:20:56'),(4,2,'Rodrigo','rodrigo@gmail.com','07e7655f7b11a5a84afa062de7e2d0f7',1,'2018-08-02 21:24:46'),(5,3,'Camila','camila@gmail.com','394188daf1f5da9691167129f700aa55',1,'2018-08-02 21:52:46'),(6,3,'Keidi','keidi@gmail.com','ea14515f2b88bc7adcae1987f1f5e929',1,'2018-08-02 21:53:03'),(7,3,'Tatiane','tatiane@gmail.com','0747265dbab0d406cd604c38e4065e36',1,'2018-08-02 21:53:16'),(8,6,'Leandro','leandro@gmail.com','01a41468df4bcf46718736ef9fdd8a4a',1,'2018-08-02 21:53:44'),(9,6,'Alicia','alicia@gmail.com','4c0106b6966a1ce17470e905ab1f2d65',1,'2018-08-02 21:53:58'),(10,7,'Adenilson','adenilson@gmail.com','4bb0655909ff76d65aeac8353ed150d3',1,'2018-08-02 21:54:43'),(11,5,'Adriano','adriano@gmail.com','6d903f0c4ccc1cb76ce8c44c2e223394',1,'2018-08-02 22:08:39'),(12,5,'Helena','helena@gmail.com','6f6e2b7702605deed32e737540394802',1,'2018-08-02 22:08:54'),(13,2,'Eduardo','eduardo@gmail.com','bc5f4c96b7cc8f260c7f90951489fa3b',1,'2018-08-02 22:11:30'),(14,4,'Monique','monique@gmail.com','dc0601b9322910a82c825e54db62daa8',1,'2018-08-02 22:13:44'),(15,13,'Fabiana','fabiana@gmail.com','2cbb8c98e187f10cc0ea5ba9fb190b44',1,'2018-08-02 22:14:11'),(16,13,'Fabiano','fabiano@hotmail.com','4033bdb06c77fb10aa6363088d882ea5',1,'2018-08-02 22:14:31'),(17,16,'Barbara','barbara@hotmail.com','537fbcdab6351e84ba65d9b6ef786bd8',1,'2018-08-02 22:14:48');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'projeto_mmn'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-02 22:16:19
