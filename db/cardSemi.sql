CREATE DATABASE  IF NOT EXISTS `cardapio-semidinamico` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cardapio-semidinamico`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: cardapio-semidinamico
-- ------------------------------------------------------
-- Server version	8.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `itens_venda`
--

DROP TABLE IF EXISTS `itens_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `itens_venda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `venda_id` int NOT NULL,
  `produto_id` int NOT NULL,
  `quantidade` int NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `venda_id` (`venda_id`),
  KEY `produto_id` (`produto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_venda`
--

LOCK TABLES `itens_venda` WRITE;
/*!40000 ALTER TABLE `itens_venda` DISABLE KEYS */;
INSERT INTO `itens_venda` VALUES (1,4,31,3,150.00),(2,4,29,2,10.00),(3,4,30,1,10.00),(4,4,32,1,20.00),(5,4,33,1,20.00),(6,5,29,1,10.00),(7,5,32,1,20.00),(8,6,33,1,20.00),(9,7,31,1,150.00),(10,8,33,1,20.00),(11,8,31,1,150.00),(12,9,33,2,20.00),(13,10,32,1,20.00),(14,10,29,1,10.00),(15,11,33,1,20.00),(16,11,31,2,150.00),(17,12,31,1,150.00),(18,13,31,1,150.00),(19,14,33,1,20.00),(20,15,33,1,20.00),(21,16,29,1,10.00),(22,16,32,1,20.00),(23,17,31,1,150.00),(24,17,33,1,20.00),(25,18,33,1,20.00),(26,19,33,1,20.00),(27,19,31,1,150.00),(28,20,31,1,150.00),(29,21,31,1,150.00),(30,21,30,1,10.00),(31,22,33,1,20.00),(32,22,31,1,150.00),(33,23,31,1,150.00),(34,24,30,1,10.00),(35,24,35,1,20.00);
/*!40000 ALTER TABLE `itens_venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `categoria` enum('bebidas','pratos') NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `disponivel` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (30,'SEU PRODUTO','DESCRIÇÃO DO PRODUTO',10.00,'pratos','67deb092aefba.png','2025-03-22 12:44:02',1),(31,'SEU PRODUTO','descrição',150.00,'pratos','67decffb448d5.png','2025-03-22 14:58:03',1),(35,'Seu Produto 001	','Descriçaõ do Produto 001',20.00,'pratos','68024f277498c.png','2025-04-18 13:09:59',1);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(191) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Administrador','admin@example.com','e7d80ffeefa212b7c5c55700e4f7193e','2024-08-25 19:38:11');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendas`
--

DROP TABLE IF EXISTS `vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_nome` varchar(255) NOT NULL,
  `contato` varchar(20) NOT NULL,
  `endereco` text NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('Pendente','Pago (Dinheiro)','Pago (Pix)','Pago (Cartão De Crédito)') DEFAULT 'Pendente',
  `status_pedido` enum('Pedido Feito','Em Preparo','Saiu para Entrega','Entregue') DEFAULT 'Pedido Feito',
  `data_venda` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendas`
--

LOCK TABLES `vendas` WRITE;
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` VALUES (11,'Pedro á degquen','996280333','Sou viada quero que me cheme de Pedra, meus pronomes são elo delo',320.00,'','Pedido Feito','2025-04-15 18:30:17'),(2,'Jose','996280333','asa',0.00,'Pago (Dinheiro)','Pedido Feito','2025-04-15 16:48:32'),(3,'Jose','996280333','teste',520.00,'Pago (Dinheiro)','Pedido Feito','2025-04-15 17:03:15'),(4,'Jose','991082837','sdasdasda',520.00,'Pago (Dinheiro)','Pedido Feito','2025-04-15 17:07:56'),(5,'pedrin matador','322341313','asdqaqweqqweqw',30.00,'Pago (Dinheiro)','Pedido Feito','2025-04-15 17:13:04'),(6,'pedrin matador','996280333','vsfd LOUD',20.00,'Pago (Dinheiro)','Pedido Feito','2025-04-15 17:16:04'),(7,'pedrin matador','996280333','FDS a LOUD valorante',150.00,'Pago (Dinheiro)','Pedido Feito','2025-04-15 17:21:37'),(8,'pedrin matador','996280333','teste de numero sei la oq',170.00,'Pago (Dinheiro)','Pedido Feito','2025-04-15 17:26:46'),(9,'pedrin matador','996280333','SDASD',40.00,'Pago (Dinheiro)','Pedido Feito','2025-04-15 17:29:18'),(10,'pedrin matador','996280333','asdasdas',30.00,'Pago (Dinheiro)','Pedido Feito','2025-04-15 17:30:02'),(12,'Pedro á degquen','asdasda','adasdasd',150.00,'Pago (Dinheiro)','Pedido Feito','2025-04-15 18:46:13'),(13,'Pedro á degquen','asda','adad',150.00,'Pago (Pix)','Pedido Feito','2025-04-15 18:47:18'),(14,'Pedro á degquen','996280333','adad',20.00,'Pago (Dinheiro)','Pedido Feito','2025-04-15 18:50:14'),(15,'Pedro á degquen','996280333','dadad',20.00,'Pago (Dinheiro)','Pedido Feito','2025-04-15 18:53:46'),(16,'ss','996280333','adasdasdad',30.00,'Pago (Dinheiro)','Pedido Feito','2025-04-15 18:58:08'),(17,'ss','996280333','ewrwer',170.00,'','Pedido Feito','2025-04-15 18:59:28'),(18,'ss','991082837','adasdasd',20.00,'Pago (Pix)','Pedido Feito','2025-04-15 19:00:45'),(19,'Matador','09398373','asdadasda',170.00,'Pago (Pix)','Pedido Feito','2025-04-15 23:08:45'),(20,'Jose','996280333','adadadad',150.00,'Pago (Dinheiro)','Pedido Feito','2025-04-17 12:56:18'),(21,'Jose','996280333','asdasda',160.00,'','Pedido Feito','2025-04-17 13:00:29'),(22,'jose','1234567890','afdadada',170.00,'','Pedido Feito','2025-04-17 13:09:17'),(23,'Jose','996280333','adfadada',150.00,'Pago (Dinheiro)','Pedido Feito','2025-04-18 13:15:39'),(24,'Jose','996280333','fafda',30.00,'Pago (Dinheiro)','Pedido Feito','2025-04-18 14:08:15');
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-18 11:31:25
