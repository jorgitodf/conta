-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: conta
-- ------------------------------------------------------
-- Server version	5.7.14-log

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
-- Table structure for table `tb_banco`
--

DROP TABLE IF EXISTS `tb_banco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_banco` (
  `cod_banco` mediumint(3) unsigned zerofill NOT NULL,
  `nome_banco` varchar(90) NOT NULL,
  PRIMARY KEY (`cod_banco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='		';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_banco`
--

LOCK TABLES `tb_banco` WRITE;
/*!40000 ALTER TABLE `tb_banco` DISABLE KEYS */;
INSERT INTO `tb_banco` VALUES (001,'Banco do Brasil'),(002,'Banco Central do Brasil'),(003,'Banco da Amazônia'),(004,'Banco do Nordeste do Brasil'),(007,'Banco Nacional de Desenvolvimento Econômico e Social'),(021,'Banco do Estado do Espírito Santo'),(023,'Banco de Desenvolvimento de Minas Gerais'),(024,'Banco de Desenvolvimento do Paraná'),(025,'Banco Alfa'),(033,'Banco Santander'),(037,'Banco do Estado do Pará'),(041,'Banco do Estado do Rio Grande do Sul'),(046,'Banco Regional de Desenvolvimento do Extremo Sul'),(047,'Banco de Desenvolvimento do Espírito Santo'),(048,'Banco do Estado de Sergipe'),(070,'Banco de Brasília'),(075,'Banco ABN Amro S.A.'),(077,'Banco Intermedium'),(082,'Banco Topázio'),(104,'Caixa Econômica Federal'),(107,'Banco BBM'),(121,'Banco Gerador'),(184,'Banco Itaú BBA'),(208,'Banco BTG Pactual'),(218,'Banco Bonsucesso'),(224,'Banco Fibra'),(237,'Bradesco'),(263,'Banco Cacique'),(264,'Banco Caixa Geral - Brasil'),(265,'Banco Fator'),(318,'Banco BMG'),(320,'Banco Industrial e Comercial'),(341,'Itaú Unibanco'),(389,'Banco Mercantil do Brasil'),(399,'HSBC Bank Brasil'),(422,'Banco Safra'),(479,'Banco ItaúBank'),(505,'Banco Credit Suisse'),(604,'Banco Industrial do Brasil'),(611,'Banco Paulista'),(612,'Banco Guanabara'),(623,'Banco Panamericano'),(637,'Banco Sofisa'),(643,'Banco Pine'),(653,'Banco Indusval'),(654,'Banco Renner'),(655,'Banco Votorantim'),(707,'Banco Daycoval'),(719,'Banco Banif'),(721,'Banco Credibel'),(738,'Banco Morada'),(741,'Banco Ribeirão Preto'),(745,'Banco Citibank'),(746,'Banco Modal');
/*!40000 ALTER TABLE `tb_banco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_categoria`
--

DROP TABLE IF EXISTS `tb_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_categoria` (
  `id_categoria` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_categoria`
--

LOCK TABLES `tb_categoria` WRITE;
/*!40000 ALTER TABLE `tb_categoria` DISABLE KEYS */;
INSERT INTO `tb_categoria` VALUES (1,'Academia'),(2,'Alimentação'),(3,'Banco'),(4,'Bebidas '),(5,'Capitalização'),(6,'Cartões'),(7,'Combustível '),(8,'Concursos'),(9,'Cursos'),(10,'Despesas banco'),(11,'Despesas Casa'),(12,'Despesas Diversas'),(13,'Despesas Pessoais'),(14,'Despesas Terceiros'),(15,'Eletrônicos'),(16,'Entretenimento'),(17,'Entretenimento'),(18,'Investimento'),(19,'Faculdade'),(20,'Farmácia'),(21,'Festas'),(22,'Financiamento'),(23,'Hospedagem'),(24,'Impostos Carro'),(25,'Ipva'),(26,'Lanche'),(27,'Livros'),(28,'Loterias'),(29,'Manutenção Carro '),(30,'Mercado'),(31,'Multas Carro'),(32,'Padaria'),(33,'Papelaria'),(34,'Passagem'),(35,'Perfumarias'),(36,'Pernoites'),(37,'Previdência'),(38,'Receitas'),(39,'Refeição'),(40,'Roupas'),(41,'Saúde'),(42,'Seguro Carro'),(43,'Shows'),(44,'Sisarpa'),(45,'Telefones'),(46,'Viagens');
/*!40000 ALTER TABLE `tb_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_conta`
--

DROP TABLE IF EXISTS `tb_conta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_conta` (
  `id_conta` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_conta` enum('Conta Corrente','Conta Poupança','Conta Salário') NOT NULL,
  `codigo_agencia` smallint(4) unsigned zerofill NOT NULL,
  `digito_verificador_agencia` tinyint(1) unsigned zerofill NOT NULL,
  `numero_conta` mediumint(8) unsigned zerofill NOT NULL,
  `digito_verificador_conta` tinyint(1) unsigned zerofill NOT NULL,
  `codigo_operacao` smallint(5) unsigned zerofill DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `fk_id_usuario` tinyint(3) unsigned NOT NULL,
  `fk_cod_banco` mediumint(3) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id_conta`),
  KEY `idx_conta_tb_usuario` (`fk_id_usuario`) USING BTREE,
  KEY `idx_conta_tb_banco` (`fk_cod_banco`) USING BTREE,
  CONSTRAINT `fk_tb_conta_tb_banco` FOREIGN KEY (`fk_cod_banco`) REFERENCES `tb_banco` (`cod_banco`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_tb_conta_tb_usuario` FOREIGN KEY (`fk_id_usuario`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_conta`
--

LOCK TABLES `tb_conta` WRITE;
/*!40000 ALTER TABLE `tb_conta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_conta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_extrato`
--

DROP TABLE IF EXISTS `tb_extrato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_extrato` (
  `id_extrato` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `data_movimentacao` date NOT NULL,
  `mes` varchar(20) NOT NULL,
  `tipo_operacao` enum('Débito','Crédito') NOT NULL,
  `movimentacao` varchar(60) NOT NULL,
  `quantidade` smallint(2) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `saldo` decimal(10,2) NOT NULL,
  `fk_id_categoria` mediumint(8) unsigned DEFAULT NULL,
  `fk_id_conta` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_extrato`),
  KEY `idx_extrato_tb_categoria` (`fk_id_categoria`) USING BTREE,
  KEY `idx_extrato_tb_conta` (`fk_id_conta`) USING BTREE,
  CONSTRAINT `fk_tb_extrato_tb_categoria` FOREIGN KEY (`fk_id_categoria`) REFERENCES `tb_categoria` (`id_categoria`) ON UPDATE CASCADE,
  CONSTRAINT `fk_tb_extrato_tb_conta` FOREIGN KEY (`fk_id_conta`) REFERENCES `tb_conta` (`id_conta`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_extrato`
--

LOCK TABLES `tb_extrato` WRITE;
/*!40000 ALTER TABLE `tb_extrato` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_extrato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_usuario` (
  `id_usuario` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(90) NOT NULL,
  `email` varchar(90) NOT NULL,
  `senha` varchar(190) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuario`
--

LOCK TABLES `tb_usuario` WRITE;
/*!40000 ALTER TABLE `tb_usuario` DISABLE KEYS */;
INSERT INTO `tb_usuario` VALUES (1,'Jorgito da Silva Paiva','jspaiva.1977@gmail.com','b05e1e56a181abbdf565307c30d741d7','2016-09-15 16:40:14'),(2,'','','d41d8cd98f00b204e9800998ecf8427e','2016-09-15 17:00:02'),(3,'','','d41d8cd98f00b204e9800998ecf8427e','2016-09-15 17:00:05');
/*!40000 ALTER TABLE `tb_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'conta'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-16 17:23:55
