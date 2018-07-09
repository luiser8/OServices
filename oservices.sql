-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: localhost    Database: oservices
-- ------------------------------------------------------
-- Server version	5.7.17-log

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
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrito` (
  `CodCarrito` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoProd` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `Cliente` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `NombreProd` varchar(155) COLLATE utf8_spanish_ci NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Cantidad` int(10) unsigned NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL,
  `Estado` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descuento` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`CodCarrito`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito`
--

LOCK TABLES `carrito` WRITE;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `CodigoCat` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` text NOT NULL,
  PRIMARY KEY (`CodigoCat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES ('01','Papelería','Productos Papeleros'),('02','Higiénico','Papeles Higiénicos'),('03','Limpieza','Productos de Limpieza');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `RIF` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `NombreCompleto` varchar(70) NOT NULL,
  `Clave` text NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  PRIMARY KEY (`RIF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES ('16068389','emiru48','Emir Urbano','81dc9bdb52d04dc20036dbd8313ed055','Puerto la Cruz, Estado Anzoátegui','04148283661','emiru48@gmail.com'),('J123456','pruebax','Pedro Perez','81dc9bdb52d04dc20036dbd8313ed055','Barcelona','555555','hola@gmail.com'),('J1234567','prueba2','Empresa de Prueba','81dc9bdb52d04dc20036dbd8313ed055','Puerto la Cruz, Estado Anzoátegui','123456','micorreo@gmail.com'),('v14477562','sagiro60','Ronal Rodriguez','81dc9bdb52d04dc20036dbd8313ed055','Av. Stadium, C.C. El Cardon, Puerto La Cruz','4265188972','programate@gmail.com');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuentabanco`
--

DROP TABLE IF EXISTS `cuentabanco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuentabanco` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `NumeroCuenta` varchar(100) NOT NULL,
  `NombreBanco` varchar(100) NOT NULL,
  `NombreBeneficiario` varchar(100) NOT NULL,
  `TipoCuenta` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuentabanco`
--

LOCK TABLES `cuentabanco` WRITE;
/*!40000 ALTER TABLE `cuentabanco` DISABLE KEYS */;
INSERT INTO `cuentabanco` VALUES (1,'01340062870621035057','Banesco','Inversora Oriente Services CA','Corriente');
/*!40000 ALTER TABLE `cuentabanco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle`
--

DROP TABLE IF EXISTS `detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle` (
  `NumPedido` int(20) NOT NULL,
  `CodigoProd` varchar(30) NOT NULL,
  `CantidadProductos` int(20) NOT NULL,
  `PrecioProd` decimal(30,2) NOT NULL,
  KEY `NumPedido` (`NumPedido`),
  KEY `CodigoProd` (`CodigoProd`),
  CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`NumPedido`) REFERENCES `venta` (`NumPedido`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle`
--

LOCK TABLES `detalle` WRITE;
/*!40000 ALTER TABLE `detalle` DISABLE KEYS */;
INSERT INTO `detalle` VALUES (10,'pa001',1,5000.00),(11,'pa001',2,5000.00),(12,'HG-01',2,20000.00),(12,'pa001',1,5000.00),(15,'p02',2,500000.00),(15,'p02',1,500000.00),(15,'p02',2,500000.00),(15,'p02',1,500000.00),(15,'p02',2,500000.00),(15,'p02',1,500000.00),(24,'pa001',4,5000.00),(31,'HG-01',1,20000.00),(32,'HG-01',1,20000.00),(33,'HG-01',2,20000.00),(33,'p02',2,500000.00);
/*!40000 ALTER TABLE `detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `niveles`
--

DROP TABLE IF EXISTS `niveles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `niveles` (
  `CodNivel` int(11) NOT NULL AUTO_INCREMENT,
  `Nivel` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CodNivel`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `niveles`
--

LOCK TABLES `niveles` WRITE;
/*!40000 ALTER TABLE `niveles` DISABLE KEYS */;
INSERT INTO `niveles` VALUES (1,'Administrador del sistema','2018-07-02 14:31:15'),(2,'Cliente','2018-07-02 14:31:15'),(3,'Tesorero','2018-07-02 14:31:15'),(4,'Almacenista','2018-07-02 14:31:15'),(5,'Gerente','2018-07-02 14:31:15');
/*!40000 ALTER TABLE `niveles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `CodigoProd` varchar(30) NOT NULL,
  `NombreProd` varchar(30) NOT NULL,
  `CodigoCat` varchar(30) NOT NULL,
  `Precio` decimal(30,2) NOT NULL,
  `Descuento` int(2) NOT NULL,
  `Presentación` varchar(30) NOT NULL,
  `Marca` varchar(30) NOT NULL,
  `Stock` int(20) NOT NULL,
  `RIFProveedor` varchar(30) NOT NULL,
  `Imagen` varchar(150) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Estado` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `CodigoCat` (`CodigoCat`),
  KEY `NITProveedor` (`RIFProveedor`),
  KEY `Agregado` (`Nombre`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`CodigoCat`) REFERENCES `categoria` (`CodigoCat`) ON UPDATE CASCADE,
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`RIFProveedor`) REFERENCES `proveedor` (`RIFProveedor`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'HG-01','Papel Institucional 9','02',20000.00,0,'Bulto de 6 Rollos','PAVECA',120,'305837260','HG-01.jpg','admin','Activo'),(2,'pa001','Resma','01',5000.00,0,'Resma 500 Hojas','Alpes',19,'305837260','pa001.png','admin','Activo'),(3,'p02','opalina','01',500000.00,0,'100 hojas','opal',8,'305837260','p02.jpg','admin','Activo');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `RIFProveedor` varchar(30) NOT NULL,
  `NombreCompleto` varchar(70) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  PRIMARY KEY (`RIFProveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES ('305837260','Emir Urbano2','Puerto la Cruz, Estado Anzoátegui','04148283661','emiru48@gmail.com');
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `Clave` text COLLATE utf8_spanish_ci NOT NULL,
  `CodNivel` int(10) unsigned NOT NULL COMMENT '1: administrador (super usuario, hace todas las funciones) no ve el carrito.\nEs el unico que accede a configurar los usuarios y le coloca el nivel al usuario.\n2: clientes (crean pedidos y pueden ver sus pedidos e imprimirlos) Solo ellos pueden ver el carrito\n3: tesoreros (ve los pedidos y aprueba los pagos para que luego se pueda imprimir el pedido)\n4: almacenistas (ve el inventario y carga existencia al inventario)\neste inventario es una vista especial que es tipo listado y la ven asi el gerente y el administrador solo ellos.\n5: gerente (igual que el administrador pero no puede crear usuarios) no ve el carrito\n\nEn el caso del tesorero y almacenista no puede ver el carrito ni el modulos de administracion\n',
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rif` varchar(30) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Para los usuarios tipo cliente se usa esta campo para relacionar con la tabla de clientes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Nombre_UNIQUE` (`Nombre`),
  UNIQUE KEY `rif_UNIQUE` (`rif`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',1,'2018-07-02 14:52:40',NULL),(2,'tesorero','81dc9bdb52d04dc20036dbd8313ed055',3,'2018-07-02 14:57:36',NULL),(3,'emiru48','81dc9bdb52d04dc20036dbd8313ed055',2,'2018-07-02 15:24:44','16068389'),(4,'ronal','81dc9bdb52d04dc20036dbd8313ed055',2,'2018-07-02 17:13:40','J1234567'),(5,'almacenista','81dc9bdb52d04dc20036dbd8313ed055',4,'2018-07-02 20:01:51',NULL),(6,'gerente','81dc9bdb52d04dc20036dbd8313ed055',5,'2018-07-02 20:04:38',NULL),(7,'sagiro60','81dc9bdb52d04dc20036dbd8313ed055',2,'2018-07-08 02:57:50','v14477562'),(8,'tesorero2','81dc9bdb52d04dc20036dbd8313ed055',3,'2018-07-08 03:27:04',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta` (
  `NumPedido` int(20) NOT NULL AUTO_INCREMENT,
  `Fecha` varchar(150) NOT NULL,
  `RIF` varchar(30) NOT NULL,
  `TotalPagar` decimal(30,2) NOT NULL,
  `Estado` varchar(150) NOT NULL,
  `NumeroDeposito` varchar(50) NOT NULL,
  `TipoEnvio` varchar(37) NOT NULL,
  `NombreEnvio` varchar(70) NOT NULL,
  `DirEnvio` varchar(200) NOT NULL,
  `TlfEnvio` varchar(20) NOT NULL,
  `Adjunto` varchar(50) NOT NULL,
  PRIMARY KEY (`NumPedido`),
  KEY `NIT` (`RIF`),
  CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`RIF`) REFERENCES `cliente` (`RIF`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES (10,'04-07-2018','16068389',5000.00,'verificado','565555555555555555','Recoger Por Tienda','Jose','bna','04121805865','Sin archivo adjunto'),(11,'04-07-2018','16068389',10000.00,'verificado','565555555555555555','Recoger Por Tienda','Jose','bna','04121805865','Sin archivo adjunto'),(12,'08-07-2018','V14477562',45000.00,'Pendiente','12345','Recoger Por Tienda','Ronal','Caracas','1234','Sin archivo adjunto'),(13,'08-07-2018','16068389',0.00,'Verificado','1234','Recoger Por Tienda','Yo','PLC','1234','Sin archivo adjunto'),(14,'08-07-2018','v14477562',0.00,'Verificado','543322','Recoger Por Tienda','Ronal','PLC','12345','Sin archivo adjunto'),(15,'08-07-2018','v14477562',0.00,'Verificado','645','Recoger Por Tienda','Ronal','tyr','5345','Sin archivo adjunto'),(16,'08-07-2018','v14477562',1500000.00,'Verificado','7666','Recoger Por Tienda','Ricardo','Bna','456555','Sin archivo adjunto'),(23,'08-07-2018','v14477562',2000000.00,'Verificado','9888','Recoger Por Tienda','Carolina','Lecheria','2671691','Sin archivo adjunto'),(24,'08-07-2018','v14477562',100000.00,'Verificado','99999','Recoger Por Tienda','Ricardo','Aragua','4543333','Sin archivo adjunto'),(31,'08-07-2018','v14477562',20000.00,'Pendiente','534','Recoger Por Tienda','rter','435','435','Sin archivo adjunto'),(32,'08-07-2018','v14477562',20000.00,'Pendiente','456546','Recoger Por Tienda','ertert','3454','ert','Sin archivo adjunto'),(33,'08-07-2018','v14477562',1040000.00,'Verificado','65756','Recoger Por Tienda','raul','345435','435435','Sin archivo adjunto');
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verificado`
--

DROP TABLE IF EXISTS `verificado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verificado` (
  `CodVerf` int(11) NOT NULL AUTO_INCREMENT,
  `NumPedido` int(11) NOT NULL,
  `Estado` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CodVerf`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verificado`
--

LOCK TABLES `verificado` WRITE;
/*!40000 ALTER TABLE `verificado` DISABLE KEYS */;
INSERT INTO `verificado` VALUES (3,1,1,'0000-00-00 00:00:00'),(4,3,1,'0000-00-00 00:00:00'),(5,4,1,'0000-00-00 00:00:00'),(6,5,1,'0000-00-00 00:00:00'),(7,6,1,'0000-00-00 00:00:00'),(8,7,1,'0000-00-00 00:00:00'),(9,8,1,'0000-00-00 00:00:00'),(10,9,1,'0000-00-00 00:00:00'),(11,10,1,'0000-00-00 00:00:00'),(12,11,1,'0000-00-00 00:00:00'),(13,12,1,'0000-00-00 00:00:00'),(14,13,1,'0000-00-00 00:00:00'),(15,14,1,'0000-00-00 00:00:00'),(16,23,1,'0000-00-00 00:00:00'),(17,24,1,'0000-00-00 00:00:00'),(18,16,1,'0000-00-00 00:00:00'),(19,15,1,'0000-00-00 00:00:00'),(21,33,1,'2018-07-09 01:23:22');
/*!40000 ALTER TABLE `verificado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'oservices'
--

--
-- Dumping routines for database 'oservices'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-09  0:31:02
