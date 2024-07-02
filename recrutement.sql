-- MySQL dump 10.13  Distrib 5.7.36, for Win64 (x86_64)
--
-- Host: localhost    Database: recrutement
-- ------------------------------------------------------
-- Server version	5.7.36

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
-- Table structure for table `candidature`
--

DROP TABLE IF EXISTS `candidature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `domaine` varchar(255) DEFAULT NULL,
  `poste_souhaite` varchar(255) DEFAULT NULL,
  `niveau_etude` varchar(255) DEFAULT NULL,
  `dernier_diplome_obtenu` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `lettre_motivation` varchar(255) DEFAULT NULL,
  `message` text,
  `date_soumission` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidature`
--

LOCK TABLES `candidature` WRITE;
/*!40000 ALTER TABLE `candidature` DISABLE KEYS */;
INSERT INTO `candidature` VALUES (1,1,'Informatique','Developpeur Full-Stack','Master 1','Licence','666ab1dea0989-Examen_GDP.pdf','666ab1dea09a0-Atelier6_Assane_Gueye.pdf','ll','2024-06-13 11:45:28'),(11,1,'FiscalitÃ©',' Comptable','Licence 2','BAC','666b1c68ab575-Atelier7_Assane_Gueye.docx','uploads/Sans titre 3 (1).pdf','mm','2024-06-13 18:20:56'),(6,5,'informatique','pc','jc','nc','666b0de31d771-Assane_Gueye_Atelier2.pdf','666b0de31d780-Examen_GDP.pdf','n','2024-06-13 17:18:59'),(4,5,'papa','pdg','l3','bac','666ac1843af47-Rapport_projet_RX.pdf','666ac1843af63-Atelier7_Assane_Gueye.pdf','ml','2024-06-13 11:53:08'),(17,6,'Gestion Ressources Humaines','CHEF','LL','BAC','66741175333c5-Atelier7_Assane_Gueye.docx','66741175333d9-Atelier7_Assane_Gueye.pdf','','2024-06-20 13:24:37'),(18,6,'Logistique & Supplychain','CHEF','L3','DUT','66741516cc332-Atelier7_Assane_Gueye.pdf','66741516cc33e-Atelier6_Assane_Gueye.pdf','','2024-06-20 13:40:06'),(16,1,'Gestion Ressources Humaines','Assistante RH','Mastere specialise','Master','6672b11e4217e-Examen_GDP.pdf','6672b11e4219e-Rapport_projet_RX.pdf','nn','2024-06-19 12:21:18'),(20,8,'Informatique','chef de projet','Licence3','DST','6679e7f277071-Note rappel.pdf','6679e7f277097-Note rappel.pdf','bonsoir','2024-06-24 23:41:06');
/*!40000 ALTER TABLE `candidature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'assanegueye@senelec.sn','Assane','Gueye','2001-12-11','dakar','200000098','pass'),(2,'baba@senlec.sn','babacar','seck','1980-10-10',NULL,'098765','passer'),(3,'nok@snlc.sn','cheikh','gueye','2004-02-10',NULL,'546','passer'),(4,'poiu@senlec.sn','aliou','seck','1908-03-11','keur gorgui','098765','pas'),(5,'ama@sp.sn','ama','laye','2003-09-09','thies','9876543','passer'),(6,'cheikh@senelec.sn','Cheikh','Gueye','1980-12-12','cite keur gorgui','777778899','passer'),(7,'babzo@snlc.sn','babacar','GUEYE','2004-01-25','medina','897900','123'),(8,'bouba@senelec.sn','Bouba','Diouf','2003-01-02','HLM','098765','pass');
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

-- Dump completed on 2024-07-02 15:47:48
