-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: ticogourmet
-- ------------------------------------------------------
-- Server version	8.0.37

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
-- Table structure for table `categoria_tb`
--

DROP TABLE IF EXISTS `categoria_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria_tb` (
  `ID_Categoria` int NOT NULL AUTO_INCREMENT,
  `Categoria` varchar(45) NOT NULL,
  `ID_Estado` int NOT NULL,
  PRIMARY KEY (`ID_Categoria`),
  KEY `Categoria_Estado_TB_FK_idx` (`ID_Estado`),
  CONSTRAINT `Categoria_Estado_TB_FK` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_tb` (`ID_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_tb`
--

LOCK TABLES `categoria_tb` WRITE;
/*!40000 ALTER TABLE `categoria_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentarios_tb`
--

DROP TABLE IF EXISTS `comentarios_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentarios_tb` (
  `ID_Comentario` int NOT NULL AUTO_INCREMENT,
  `ID_Restaurante` int NOT NULL,
  `Comentario` varchar(500) NOT NULL,
  `Rating` int NOT NULL,
  `ID_Usuario` int NOT NULL,
  PRIMARY KEY (`ID_Comentario`),
  KEY `Comentario_Restaurante_TB_FK_idx` (`ID_Restaurante`),
  KEY `Comentario_Usuario_TB_FK_idx` (`ID_Usuario`),
  CONSTRAINT `Comentario_Restaurante_TB_FK` FOREIGN KEY (`ID_Restaurante`) REFERENCES `restaurante_tb` (`ID_Restaurante`),
  CONSTRAINT `Comentario_Usuario_TB_FK` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario_tb` (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios_tb`
--

LOCK TABLES `comentarios_tb` WRITE;
/*!40000 ALTER TABLE `comentarios_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentarios_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especializacion_proveedortb`
--

DROP TABLE IF EXISTS `especializacion_proveedortb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `especializacion_proveedortb` (
  `ID_Especializacion_Proveedor` int NOT NULL AUTO_INCREMENT,
  `Especializacion` varchar(45) NOT NULL,
  `ID_Estado` int NOT NULL,
  PRIMARY KEY (`ID_Especializacion_Proveedor`),
  KEY `Espec_Proveedor_Estado_TB_FK_idx` (`ID_Estado`),
  CONSTRAINT `Espec_Proveedor_Estado_TB_FK` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_tb` (`ID_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especializacion_proveedortb`
--

LOCK TABLES `especializacion_proveedortb` WRITE;
/*!40000 ALTER TABLE `especializacion_proveedortb` DISABLE KEYS */;
/*!40000 ALTER TABLE `especializacion_proveedortb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especializacion_restaurante`
--

DROP TABLE IF EXISTS `especializacion_restaurante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `especializacion_restaurante` (
  `ID_Especializacion_Restaurante` int NOT NULL AUTO_INCREMENT,
  `Especializacion` varchar(45) NOT NULL,
  `ID_Estado` int NOT NULL,
  PRIMARY KEY (`ID_Especializacion_Restaurante`),
  KEY `Espec_Rest_Estado_TB_FK_idx` (`ID_Estado`),
  CONSTRAINT `Espec_Rest_Estado_TB_FK` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_tb` (`ID_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especializacion_restaurante`
--

LOCK TABLES `especializacion_restaurante` WRITE;
/*!40000 ALTER TABLE `especializacion_restaurante` DISABLE KEYS */;
/*!40000 ALTER TABLE `especializacion_restaurante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_tb`
--

DROP TABLE IF EXISTS `estado_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado_tb` (
  `ID_Estado` int NOT NULL AUTO_INCREMENT,
  `Estado` varchar(64) NOT NULL,
  PRIMARY KEY (`ID_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_tb`
--

LOCK TABLES `estado_tb` WRITE;
/*!40000 ALTER TABLE `estado_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `estado_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura_tb`
--

DROP TABLE IF EXISTS `factura_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `factura_tb` (
  `ID_Factura` int NOT NULL AUTO_INCREMENT,
  `ID_Pedido` int NOT NULL,
  `Total` double NOT NULL,
  `Fecha` date NOT NULL,
  `ID_Restaurante` int NOT NULL,
  `ID_Estado` int NOT NULL,
  PRIMARY KEY (`ID_Factura`),
  KEY `Factura_Restaurante_TB_FK_idx` (`ID_Restaurante`),
  KEY `Factura_Pedido_TB_FK_idx` (`ID_Pedido`),
  KEY `Factura_Estado_TB_FK_idx` (`ID_Estado`),
  CONSTRAINT `Factura_Estado_TB_FK` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_tb` (`ID_Estado`),
  CONSTRAINT `Factura_Pedido_TB_FK` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedido_tb` (`ID_Pedido`),
  CONSTRAINT `Factura_Restaurante_TB_FK` FOREIGN KEY (`ID_Restaurante`) REFERENCES `restaurante_tb` (`ID_Restaurante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura_tb`
--

LOCK TABLES `factura_tb` WRITE;
/*!40000 ALTER TABLE `factura_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `factura_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genero_tb`
--

DROP TABLE IF EXISTS `genero_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genero_tb` (
  `ID_Genero` int NOT NULL AUTO_INCREMENT,
  `Nombre_Genero` varchar(32) NOT NULL,
  `ID_Estado` int NOT NULL,
  PRIMARY KEY (`ID_Genero`),
  KEY `Genero_TB_Estado_FK_idx` (`ID_Estado`),
  CONSTRAINT `Genero_TB_Estado_FK` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_tb` (`ID_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero_tb`
--

LOCK TABLES `genero_tb` WRITE;
/*!40000 ALTER TABLE `genero_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `genero_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario_tb`
--

DROP TABLE IF EXISTS `horario_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horario_tb` (
  `ID_Horario` int NOT NULL AUTO_INCREMENT,
  `Horario` varchar(45) NOT NULL,
  `ID_Estado` int NOT NULL,
  PRIMARY KEY (`ID_Horario`,`Horario`),
  KEY `Horario_Estado_TB_FK_idx` (`ID_Estado`),
  CONSTRAINT `Horario_Estado_TB_FK` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_tb` (`ID_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario_tb`
--

LOCK TABLES `horario_tb` WRITE;
/*!40000 ALTER TABLE `horario_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `horario_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventario` (
  `ID_Inventario` int NOT NULL AUTO_INCREMENT,
  `ID_Producto` int NOT NULL,
  `Cantidad` varchar(45) NOT NULL,
  `Fecha_De_Entregado` varchar(45) NOT NULL,
  `ID_Restaurante` int NOT NULL,
  PRIMARY KEY (`ID_Inventario`),
  KEY `Inventario_Producto_TB_FK_idx` (`ID_Producto`),
  KEY `Inventario_Restaurante_TB_FK_idx` (`ID_Restaurante`),
  CONSTRAINT `Inventario_Producto_TB_FK` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Producto`),
  CONSTRAINT `Inventario_Restaurante_TB_FK` FOREIGN KEY (`ID_Restaurante`) REFERENCES `restaurante_tb` (`ID_Restaurante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario`
--

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesas_tb`
--

DROP TABLE IF EXISTS `mesas_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mesas_tb` (
  `ID_Mesa` int NOT NULL AUTO_INCREMENT,
  `Num_Mesa` int NOT NULL,
  `Estado` tinyint NOT NULL,
  `ID_Restaurante` int NOT NULL,
  PRIMARY KEY (`ID_Mesa`),
  KEY `Mesas_Restaurante_TB_FK_idx` (`ID_Restaurante`),
  CONSTRAINT `Mesas_Restaurante_TB_FK` FOREIGN KEY (`ID_Restaurante`) REFERENCES `restaurante_tb` (`ID_Restaurante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesas_tb`
--

LOCK TABLES `mesas_tb` WRITE;
/*!40000 ALTER TABLE `mesas_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `mesas_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais_tb`
--

DROP TABLE IF EXISTS `pais_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pais_tb` (
  `ID_Pais` int NOT NULL AUTO_INCREMENT,
  `Pais` varchar(45) NOT NULL,
  `ID_Estado` int NOT NULL,
  PRIMARY KEY (`ID_Pais`),
  KEY `Pais_Estado_TB_FK_idx` (`ID_Estado`),
  CONSTRAINT `Pais_Estado_TB_FK` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_tb` (`ID_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais_tb`
--

LOCK TABLES `pais_tb` WRITE;
/*!40000 ALTER TABLE `pais_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `pais_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_platillos_tb`
--

DROP TABLE IF EXISTS `pedido_platillos_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido_platillos_tb` (
  `ID_Pedido` int NOT NULL,
  `ID_Platillo` int NOT NULL,
  `Cantidad` varchar(45) NOT NULL,
  KEY `Pedido_Platillo_Platillo_TB_FK_idx` (`ID_Platillo`),
  KEY `Pedido_Platillo_Pedido_TB_FK` (`ID_Pedido`),
  CONSTRAINT `Pedido_Platillo_Pedido_TB_FK` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedido_tb` (`ID_Pedido`),
  CONSTRAINT `Pedido_Platillo_Platillo_TB_FK` FOREIGN KEY (`ID_Platillo`) REFERENCES `platillo_tb` (`ID_Platillo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_platillos_tb`
--

LOCK TABLES `pedido_platillos_tb` WRITE;
/*!40000 ALTER TABLE `pedido_platillos_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido_platillos_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_tb`
--

DROP TABLE IF EXISTS `pedido_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido_tb` (
  `ID_Pedido` int NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int NOT NULL,
  `ID_Estado` int NOT NULL,
  PRIMARY KEY (`ID_Pedido`),
  KEY `Pedido_Usuario_TB_FK_idx` (`ID_Usuario`),
  KEY `Pedido_Estado_TB_FK_idx` (`ID_Estado`),
  CONSTRAINT `Pedido_Estado_TB_FK` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_tb` (`ID_Estado`),
  CONSTRAINT `Pedido_Usuario_TB_FK` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario_tb` (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_tb`
--

LOCK TABLES `pedido_tb` WRITE;
/*!40000 ALTER TABLE `pedido_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planilla`
--

DROP TABLE IF EXISTS `planilla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planilla` (
  `ID_Planilla` int NOT NULL AUTO_INCREMENT,
  `ID_Restaurante` int NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Salario` double NOT NULL,
  `ID_Horario` int NOT NULL,
  `Telefono` varchar(45) NOT NULL,
  `ID_RolPlanilla` int NOT NULL,
  `ID_Estado` int NOT NULL,
  PRIMARY KEY (`ID_Planilla`),
  KEY `Planilla_Horario_FK_TB_idx` (`ID_Horario`),
  KEY `Planilla_RolPlanilla_TB_FK_idx` (`ID_RolPlanilla`),
  KEY `Planilla_Estado_TB_FK_idx` (`ID_Estado`),
  KEY `Planilla_Restaurante_TB_FK_idx` (`ID_Restaurante`),
  CONSTRAINT `Planilla_Estado_TB_FK` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_tb` (`ID_Estado`),
  CONSTRAINT `Planilla_Horario_TB_FK` FOREIGN KEY (`ID_Horario`) REFERENCES `horario_tb` (`ID_Horario`),
  CONSTRAINT `Planilla_Restaurante_TB_FK` FOREIGN KEY (`ID_Restaurante`) REFERENCES `restaurante_tb` (`ID_Restaurante`),
  CONSTRAINT `Planilla_RolPlanilla_TB_FK` FOREIGN KEY (`ID_RolPlanilla`) REFERENCES `rol_tb` (`ID_Rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planilla`
--

LOCK TABLES `planilla` WRITE;
/*!40000 ALTER TABLE `planilla` DISABLE KEYS */;
/*!40000 ALTER TABLE `planilla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platillo_tb`
--

DROP TABLE IF EXISTS `platillo_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `platillo_tb` (
  `ID_Platillo` int NOT NULL AUTO_INCREMENT,
  `ID_Restaurante` int NOT NULL,
  `ID_Categoria` int NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Precio` double NOT NULL,
  PRIMARY KEY (`ID_Platillo`),
  KEY `Platillo_Restaurante_TB_FK_idx` (`ID_Restaurante`),
  KEY `Platillo_Caterogia_TB_FK_idx` (`ID_Categoria`),
  CONSTRAINT `Platillo_Caterogia_TB_FK` FOREIGN KEY (`ID_Categoria`) REFERENCES `categoria_tb` (`ID_Categoria`),
  CONSTRAINT `Platillo_Restaurante_TB_FK` FOREIGN KEY (`ID_Restaurante`) REFERENCES `restaurante_tb` (`ID_Restaurante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platillo_tb`
--

LOCK TABLES `platillo_tb` WRITE;
/*!40000 ALTER TABLE `platillo_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `platillo_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `ID_Producto` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Detalles` varchar(256) NOT NULL,
  `Precio` double NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `Cantidad` int NOT NULL,
  `ID_Proveedor` int NOT NULL,
  PRIMARY KEY (`ID_Producto`),
  KEY `Productos_Proveedor_TB_FK_idx` (`ID_Proveedor`),
  CONSTRAINT `Productos_Proveedor_TB_FK` FOREIGN KEY (`ID_Proveedor`) REFERENCES `proveedor_tb` (`ID_Proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor_tb`
--

DROP TABLE IF EXISTS `proveedor_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedor_tb` (
  `ID_Proveedor` int NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int NOT NULL,
  `ID_Estado` int NOT NULL,
  PRIMARY KEY (`ID_Proveedor`),
  KEY `Proveedor_Usuario_TB_FK_idx` (`ID_Usuario`),
  KEY `Proveedor_Estado_TB_FK_idx` (`ID_Estado`),
  CONSTRAINT `Proveedor_Estado_TB_FK` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_tb` (`ID_Estado`),
  CONSTRAINT `Proveedor_Usuario_TB_FK` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario_tb` (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor_tb`
--

LOCK TABLES `proveedor_tb` WRITE;
/*!40000 ALTER TABLE `proveedor_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `proveedor_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva_tb`
--

DROP TABLE IF EXISTS `reserva_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reserva_tb` (
  `ID_Reserva` int NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int NOT NULL,
  `Fecha` varchar(45) NOT NULL,
  `Cantidad_Asientos` varchar(45) NOT NULL,
  `ID_Mesa` int NOT NULL,
  PRIMARY KEY (`ID_Reserva`),
  KEY `Reserva_Usuario_TB_FK_idx` (`ID_Usuario`),
  KEY `Reserva_Mesa_TB_FK_idx` (`ID_Mesa`),
  CONSTRAINT `Reserva_Mesa_TB_FK` FOREIGN KEY (`ID_Mesa`) REFERENCES `mesas_tb` (`ID_Mesa`),
  CONSTRAINT `Reserva_Usuario_TB_FK` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario_tb` (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva_tb`
--

LOCK TABLES `reserva_tb` WRITE;
/*!40000 ALTER TABLE `reserva_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `reserva_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurante_tb`
--

DROP TABLE IF EXISTS `restaurante_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `restaurante_tb` (
  `ID_Restaurante` int NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int NOT NULL,
  `Direccion` varchar(45) NOT NULL,
  `Horario_Apertura` varchar(45) NOT NULL,
  `Horario_Cierre` varchar(45) NOT NULL,
  `ID_Especializacion_Restaurante` int NOT NULL,
  `ID_Pais` int NOT NULL,
  `ID_Estado` int NOT NULL,
  PRIMARY KEY (`ID_Restaurante`),
  KEY `Restaurante_Pais_TB_FK_idx` (`ID_Pais`),
  KEY `Restaurante_Estado_TB_FK_idx` (`ID_Estado`),
  KEY `Restaurante_Espec_Rest_TB_FK_idx` (`ID_Especializacion_Restaurante`),
  KEY `Restaurante_Usuario_TB_FK_idx` (`ID_Usuario`),
  CONSTRAINT `Restaurante_Espec_Rest_TB_FK` FOREIGN KEY (`ID_Especializacion_Restaurante`) REFERENCES `especializacion_restaurante` (`ID_Especializacion_Restaurante`),
  CONSTRAINT `Restaurante_Estado_TB_FK` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_tb` (`ID_Estado`),
  CONSTRAINT `Restaurante_Pais_TB_FK` FOREIGN KEY (`ID_Pais`) REFERENCES `pais_tb` (`ID_Pais`),
  CONSTRAINT `Restaurante_Usuario_TB_FK` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario_tb` (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurante_tb`
--

LOCK TABLES `restaurante_tb` WRITE;
/*!40000 ALTER TABLE `restaurante_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `restaurante_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol_tb`
--

DROP TABLE IF EXISTS `rol_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol_tb` (
  `ID_Rol` int NOT NULL AUTO_INCREMENT,
  `Rol` varchar(45) NOT NULL,
  `ID_Estado` int NOT NULL,
  PRIMARY KEY (`ID_Rol`),
  KEY `Rol_TB_Estado_FK` (`ID_Estado`),
  CONSTRAINT `Rol_Estado_TB_FK` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_tb` (`ID_Estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol_tb`
--

LOCK TABLES `rol_tb` WRITE;
/*!40000 ALTER TABLE `rol_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `rol_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_tb`
--

DROP TABLE IF EXISTS `usuario_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_tb` (
  `ID_Usuario` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(64) NOT NULL,
  `Nombre` varchar(64) NOT NULL,
  `Apellido` varchar(64) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Telefono` int NOT NULL,
  `Puntos` int NOT NULL,
  `ID_Genero` int NOT NULL,
  `ID_Rol` int NOT NULL,
  `ID_Estado` int NOT NULL,
  PRIMARY KEY (`ID_Usuario`),
  KEY `Genero_TB_FK_idx` (`ID_Genero`),
  KEY `Estado_TB_FK_idx` (`ID_Estado`),
  KEY `Usuario_Rol_TB_FK_idx` (`ID_Rol`),
  CONSTRAINT `Usuario_Estado_TB_FK` FOREIGN KEY (`ID_Estado`) REFERENCES `estado_tb` (`ID_Estado`),
  CONSTRAINT `Usuario_Genero_TB_FK` FOREIGN KEY (`ID_Genero`) REFERENCES `genero_tb` (`ID_Genero`),
  CONSTRAINT `Usuario_Rol_TB_FK` FOREIGN KEY (`ID_Rol`) REFERENCES `rol_tb` (`ID_Rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_tb`
--

LOCK TABLES `usuario_tb` WRITE;
/*!40000 ALTER TABLE `usuario_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_tb` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-25 22:34:47
