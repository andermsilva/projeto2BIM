-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: bd_resto
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `contato`
--

DROP TABLE IF EXISTS `contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contato` (
  `cod_contato` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sobrenome` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `motivo_contato` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_hora_contato` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cod_contato`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contato`
--

LOCK TABLES `contato` WRITE;
/*!40000 ALTER TABLE `contato` DISABLE KEYS */;
INSERT INTO `contato` VALUES (6,'brendon','feitosa','1898103583','teste@hotmail.com','teste2','2023-06-11 15:08:17'),(7,'suzana','sousa','18981077130','suzana@jumamarua.com.br','Sou a Juma e quero ir me imbora','2023-06-11 15:09:20'),(8,'anderson','marques','18123456789','teste@teste.com','teste3','2023-06-11 16:09:35');
/*!40000 ALTER TABLE `contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `endereco` (
  `end_cod` int NOT NULL AUTO_INCREMENT,
  `cliente_cli_id` int NOT NULL,
  `cep` varchar(9) NOT NULL,
  `logradouro` varchar(50) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `comp` varchar(45) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  PRIMARY KEY (`end_cod`),
  KEY `fk_endereco_cliente1_idx` (`cliente_cli_id`),
  CONSTRAINT `fk_endereco_cliente1` FOREIGN KEY (`cliente_cli_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (39,1,'1956265','Avenida Corenel Jose Soares Marconde','23','A','Jd','Pres.Prudente'),(40,1,'19045802','Diamante','500','Ap21','Jd Botanico','São Paulo'),(41,3,'19045802','Diamante','500','Ap21','Jd Botanico','São Paulo');
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historia`
--

DROP TABLE IF EXISTS `historia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historia` (
  `real_id` int NOT NULL AUTO_INCREMENT,
  `fundacao` mediumtext,
  `de_onde_viemos` mediumtext,
  `porque_cidade` mediumtext,
  `curiosidades` mediumtext,
  PRIMARY KEY (`real_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historia`
--

LOCK TABLES `historia` WRITE;
/*!40000 ALTER TABLE `historia` DISABLE KEYS */;
INSERT INTO `historia` VALUES (40,'Uma família apaixonada por gastronomia fundou o restaurante \"Fatec Food\" em Presidente Prudente - SP. \r\nTransformaram um antigo casarão abandonado em um espaço charmoso. João, o chef talentoso, criava pratos deliciosos,\r\n enquanto Maria, especialista em vinhos, selecionava as melhores opções. Com atendimento impecável e um cardápio\r\n diversificado, o restaurante conquistou a cidade. Tornou-se um ponto de referência, onde pessoas celebram momentos\r\n especiais. O sucesso é resultado da paixão, dedicação e trabalho árduo dessa família. O Fatec Food é um lugar onde a \r\n boa gastronomia encontra aconchego e memórias inesquecíveis são criadas.','João e Maria, irmãos apaixonados por gastronomia,\r\n deixaram sua cidade natal (Maceió - AL) em busca de novas oportunidades. Com suas habilidades culinárias, eles encontraram um\r\n antigo casarão abandonado em Presidente Prudente - SP. Com o apoio dos pais, Dona Ana e Seu Carlos, transformaram o\r\n local no renomado restaurante \"Fatec Food\". Hoje, são referência na cidade, celebrando o sucesso de uma jornada \r\n corajosa e deliciosa.','João e Maria, em busca de um lugar para abrir seu restaurante dos sonhos, descobriram Presidente\r\n Prudente - SP. Encantados com a atmosfera acolhedora e a paixão dos moradores pela gastronomia, escolheram essa cidade \r\n como o local perfeito para compartilhar sua arte culinária. O resto é história de sucesso.','O restaurante \"Fatec Food\" possui \r\n curiosidades encantadoras. Seu cardápio é inspirado em receitas de família, guardando segredos de gerações. Além disso, \r\n o local abriga uma horta própria, onde ingredientes frescos são colhidos diariamente. A decoração é composta por peças \r\n de artesãos locais, trazendo um toque único ao ambiente. É um lugar onde a tradição se mistura com a criatividade culinária.\r\n');
/*!40000 ALTER TABLE `historia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagamento`
--

DROP TABLE IF EXISTS `pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagamento` (
  `pag_id` int NOT NULL AUTO_INCREMENT,
  `data_pgto` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tp_pgto_cod` int NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `ped_num` int NOT NULL,
  `cancelado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pag_id`),
  KEY `pedido_pagamento_idx` (`tp_pgto_cod`),
  CONSTRAINT `tp_pgto_pagamento` FOREIGN KEY (`tp_pgto_cod`) REFERENCES `tipo_pagamento` (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagamento`
--

LOCK TABLES `pagamento` WRITE;
/*!40000 ALTER TABLE `pagamento` DISABLE KEYS */;
INSERT INTO `pagamento` VALUES (37,'2023-11-25 16:08:27',3,60.40,144,0);
/*!40000 ALTER TABLE `pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido` (
  `ped_num` int NOT NULL AUTO_INCREMENT,
  `tipo_pgto_cod` int NOT NULL,
  `cliente_id` int NOT NULL,
  `ped_data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valor_total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `end_cod` int NOT NULL,
  `status` int NOT NULL DEFAULT '2',
  PRIMARY KEY (`ped_num`,`tipo_pgto_cod`),
  KEY `fk_pedido_tipo_pagamento1_idx` (`tipo_pgto_cod`),
  KEY `fk_pedido_cliente1_idx` (`cliente_id`),
  KEY `fk_endereco_pedido_idx` (`end_cod`),
  KEY `status_ped_pedido_idx` (`status`),
  CONSTRAINT `fk_pedido_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `fk_pedido_tipo_pagamento1` FOREIGN KEY (`tipo_pgto_cod`) REFERENCES `tipo_pagamento` (`cod`),
  CONSTRAINT `status_ped_pedido` FOREIGN KEY (`status`) REFERENCES `status_pedido` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
INSERT INTO `pedido` VALUES (142,9,1,'2023-11-22 21:01:29',38.40,40,1),(143,9,1,'2023-11-25 13:34:18',60.40,40,1),(144,3,1,'2023-11-25 15:29:55',60.40,39,1),(145,3,3,'2023-11-25 22:40:50',43.50,41,2);
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `tipocod` int NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` mediumtext NOT NULL,
  `preco` decimal(12,2) NOT NULL,
  `promo` tinyint(1) DEFAULT NULL,
  `imageurl` longtext NOT NULL,
  `peso` decimal(12,2) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_pratos_tipo_prato_idx` (`tipocod`),
  CONSTRAINT `fk_pratos_tipo_prato` FOREIGN KEY (`tipocod`) REFERENCES `tipoproduto` (`tipocod`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES (6,1,'tutu de feijão','\r\n                Feijão com bacon, farinha de mandioca torrada couve refogada, ovo frito e torresmo                ',22.00,0,'img-id6.jpg',0.25),(7,21,'Frita','\r\n                batata frita em formato de palito                ',19.90,0,'batatafrita.jpg',0.10),(9,12,'Lasanha','massa de lasanha, presunto, queijo, e molho de carne moida',18.50,1,'lasanha.jpg',0.25),(10,7,'Baião de dois','\r\n                Arroz feijão de corda, torresmo, couve,bisteca suina e linguiça                ',25.00,0,'baiaodedois.jpg',0.30),(12,16,'Schweppers','\r\n                refrigerante citrus 350ml                ',5.00,0,'schweppes.jpg',0.35),(13,16,'Coca Cola zero','coca cola zero 350ml',5.00,1,'cocazero.jpg',0.35),(14,7,'Dobradinha','feijão branco, bacon, calabresa e bucho bovino',21.90,0,'dobradinha.jpg',0.40),(15,5,'Salada capresi','\r\n                tomate ,mussarela fresca de búfala ou vaca  azeite de oliva virgem extra  manjericão, orégano seco                ',25.00,1,'salada-caprese-2.jpeg',0.15);
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_has_pedido`
--

DROP TABLE IF EXISTS `produto_has_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto_has_pedido` (
  `produto_codigo` int NOT NULL,
  `pedido_ped_num` int NOT NULL,
  `qtde` int NOT NULL,
  `valorUnitario` decimal(12,2) NOT NULL,
  `desconto` decimal(12,2) DEFAULT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  PRIMARY KEY (`produto_codigo`,`pedido_ped_num`),
  KEY `fk_produto_has_pedido_pedido1_idx` (`pedido_ped_num`),
  KEY `fk_produto_has_pedido_produto1_idx` (`produto_codigo`),
  CONSTRAINT `fk_produto_has_pedido_pedido1` FOREIGN KEY (`pedido_ped_num`) REFERENCES `pedido` (`ped_num`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_produto_has_pedido_produto1` FOREIGN KEY (`produto_codigo`) REFERENCES `produto` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_has_pedido`
--

LOCK TABLES `produto_has_pedido` WRITE;
/*!40000 ALTER TABLE `produto_has_pedido` DISABLE KEYS */;
INSERT INTO `produto_has_pedido` VALUES (6,143,1,22.00,NULL,22.00),(6,144,1,22.00,NULL,22.00),(7,142,1,19.90,NULL,19.90),(7,143,1,19.90,NULL,19.90),(7,144,1,19.90,NULL,19.90),(9,142,1,18.50,NULL,18.50),(9,143,1,18.50,NULL,18.50),(9,144,1,18.50,NULL,18.50),(9,145,1,18.50,NULL,18.50),(10,145,1,25.00,NULL,25.00);
/*!40000 ALTER TABLE `produto_has_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `release`
--

DROP TABLE IF EXISTS `release`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `release` (
  `real_id` int NOT NULL,
  `fundacao` mediumtext NOT NULL,
  `de_onde_vimos` mediumtext NOT NULL,
  PRIMARY KEY (`real_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `release`
--

LOCK TABLES `release` WRITE;
/*!40000 ALTER TABLE `release` DISABLE KEYS */;
/*!40000 ALTER TABLE `release` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_pedido`
--

DROP TABLE IF EXISTS `status_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_pedido` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_pedido`
--

LOCK TABLES `status_pedido` WRITE;
/*!40000 ALTER TABLE `status_pedido` DISABLE KEYS */;
INSERT INTO `status_pedido` VALUES (1,'Finalizado'),(2,'Pendente'),(3,'Cancelado');
/*!40000 ALTER TABLE `status_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_pagamento`
--

DROP TABLE IF EXISTS `tipo_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_pagamento` (
  `cod` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_pagamento`
--

LOCK TABLES `tipo_pagamento` WRITE;
/*!40000 ALTER TABLE `tipo_pagamento` DISABLE KEYS */;
INSERT INTO `tipo_pagamento` VALUES (3,'cartão debito'),(4,'cartão crédito'),(9,'PIX');
/*!40000 ALTER TABLE `tipo_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoproduto`
--

DROP TABLE IF EXISTS `tipoproduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipoproduto` (
  `tipocod` int NOT NULL AUTO_INCREMENT,
  `tipo_nome` varchar(150) NOT NULL,
  PRIMARY KEY (`tipocod`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoproduto`
--

LOCK TABLES `tipoproduto` WRITE;
/*!40000 ALTER TABLE `tipoproduto` DISABLE KEYS */;
INSERT INTO `tipoproduto` VALUES (1,'tradicionais'),(2,'tipicas'),(4,'assados'),(5,'entradas'),(7,'Nordestinas'),(12,'pastas'),(13,'doces'),(16,'refrigerante'),(21,'acompanhamento'),(42,'Vegana');
/*!40000 ALTER TABLE `tipoproduto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `dt_nasc` date NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `whatsapp` varchar(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Anderson Marques da Silva','M','2023-06-09','user','$2y$10$etSIWhDPI3lJYPEGwvq9xO2xo1HV.Q.4NswFO2AuZ0EI4eGT4wR9i','18997752582','andermarsil@gmail.com','11111111100'),(2,'Administrador','M','2023-06-09','admin','$2y$10$etSIWhDPI3lJYPEGwvq9xO2xo1HV.Q.4NswFO2AuZ0EI4eGT4wR9i','18997752582','admin@gmail.com','11111111100'),(3,'TESTE','M','2023-06-09','user','$2y$10$etSIWhDPI3lJYPEGwvq9xO2xo1HV.Q.4NswFO2AuZ0EI4eGT4wR9i','18997752582','teste@gmail.com','11111111101');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-25 23:20:47
