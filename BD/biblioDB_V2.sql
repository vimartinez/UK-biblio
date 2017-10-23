CREATE DATABASE  IF NOT EXISTS `biblio` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `biblio`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: biblio
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.26-MariaDB

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
-- Table structure for table `autores`
--

DROP TABLE IF EXISTS `autores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autores` (
  `aut_ID` int(11) NOT NULL,
  `nombreApe` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nacionalidad` int(11) NOT NULL,
  `eliminado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`aut_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autores`
--

LOCK TABLES `autores` WRITE;
/*!40000 ALTER TABLE `autores` DISABLE KEYS */;
INSERT INTO `autores` VALUES (1,'Stephen King',75,0),(18,'Valerio Massimo Manfredi',75,0),(19,'Mario Puzo',75,1),(21,'Dan Brown',75,0),(22,'Robert Harris',75,0),(23,'Dan Brown 2',75,1),(24,'Wilbur Smith',75,0);
/*!40000 ALTER TABLE `autores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catalogo`
--

DROP TABLE IF EXISTS `catalogo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catalogo` (
  `cat_ID` int(11) NOT NULL,
  `lib_ID` int(11) NOT NULL,
  `cantTotal` int(11) NOT NULL,
  `cantDisponible` int(11) NOT NULL,
  PRIMARY KEY (`cat_ID`),
  KEY `catalogo_libro` (`lib_ID`),
  CONSTRAINT `catalogo_libro` FOREIGN KEY (`lib_ID`) REFERENCES `libros` (`lib_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalogo`
--

LOCK TABLES `catalogo` WRITE;
/*!40000 ALTER TABLE `catalogo` DISABLE KEYS */;
/*!40000 ALTER TABLE `catalogo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `copias`
--

DROP TABLE IF EXISTS `copias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `copias` (
  `cop_id` int(11) NOT NULL,
  `lib_ID` int(11) NOT NULL,
  `est_ID` int(11) NOT NULL,
  `copia` int(11) NOT NULL,
  `calle` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pasillo` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estante` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`cop_id`),
  KEY `libroID_idx` (`lib_ID`),
  KEY `estadoID_idx` (`est_ID`),
  CONSTRAINT `estadoID` FOREIGN KEY (`est_ID`) REFERENCES `estados_libros` (`est_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `libroID` FOREIGN KEY (`lib_ID`) REFERENCES `libros` (`lib_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `copias`
--

LOCK TABLES `copias` WRITE;
/*!40000 ALTER TABLE `copias` DISABLE KEYS */;
INSERT INTO `copias` VALUES (1,1,1,1,NULL,NULL,NULL),(2,1,2,2,NULL,NULL,NULL),(3,1,3,3,NULL,NULL,NULL),(4,1,2,4,NULL,NULL,NULL),(5,2,1,1,NULL,NULL,NULL),(6,2,1,2,NULL,NULL,NULL),(7,3,1,1,NULL,NULL,NULL),(8,3,1,2,NULL,NULL,NULL),(9,3,1,3,NULL,NULL,NULL),(10,4,1,1,NULL,NULL,NULL),(11,4,1,2,NULL,NULL,NULL),(12,4,1,3,NULL,NULL,NULL),(13,5,1,1,NULL,NULL,NULL),(14,5,1,2,NULL,NULL,NULL),(15,6,1,1,NULL,NULL,NULL),(16,6,1,2,NULL,NULL,NULL),(17,6,1,3,NULL,NULL,NULL),(18,7,1,1,NULL,NULL,NULL),(19,8,1,1,NULL,NULL,NULL),(20,9,1,1,NULL,NULL,NULL),(21,10,1,1,NULL,NULL,NULL),(22,11,1,1,NULL,NULL,NULL),(23,12,1,1,NULL,NULL,NULL),(24,13,1,1,NULL,NULL,NULL),(25,14,1,1,NULL,NULL,NULL),(26,15,1,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `copias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados_libros`
--

DROP TABLE IF EXISTS `estados_libros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados_libros` (
  `est_ID` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`est_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados_libros`
--

LOCK TABLES `estados_libros` WRITE;
/*!40000 ALTER TABLE `estados_libros` DISABLE KEYS */;
INSERT INTO `estados_libros` VALUES (1,'Ingresado'),(2,'Disponible'),(3,'Prestado'),(4,'Dañado'),(5,'Perdido - Robado'),(6,'Fuera Stock');
/*!40000 ALTER TABLE `estados_libros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionalidades`
--

DROP TABLE IF EXISTS `funcionalidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionalidades` (
  `func_ID` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `comentario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`func_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionalidades`
--

LOCK TABLES `funcionalidades` WRITE;
/*!40000 ALTER TABLE `funcionalidades` DISABLE KEYS */;
INSERT INTO `funcionalidades` VALUES (1,'Gestión de Libros','Ingreso de libros al sistema'),(2,'Gestión de Autores','Registro de autores'),(3,'Gestión de socios','Administración de socios'),(4,'Reserva de libros','Reservar un libro para retiro en sucursal (validez 3 dias)'),(5,'Préstamo de libros','Registro de préstamos'),(6,'Devolución de libros','Registro de devoluciónes'),(7,'Consulta de catálogo','Permite visualizar los contenidos disponibles'),(8,'Reporte de préstamos','Muestra el listado de libros prestados'),(9,'Reporte de socios deudores','Muestra un listado con los socios deudores'),(10,'Listado de socios','Muestra los socios activos'),(11,'Gestión de sanciones','Alta de sanciones a socios deudores'),(12,'Gestión de usuarios',''),(13,'Gestión de perfiles','');
/*!40000 ALTER TABLE `funcionalidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libros`
--

DROP TABLE IF EXISTS `libros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libros` (
  `lib_ID` int(11) NOT NULL,
  `aut_ID` int(11) NOT NULL,
  `est_ID` int(11) NOT NULL,
  `isbn` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `genero` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `subgenero` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `editorial` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `resena` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `copias` int(11) NOT NULL,
  `eliminado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`lib_ID`),
  KEY `libro_autor` (`aut_ID`),
  KEY `libro_estado` (`est_ID`),
  CONSTRAINT `libro_autor` FOREIGN KEY (`aut_ID`) REFERENCES `autores` (`aut_ID`),
  CONSTRAINT `libro_estado` FOREIGN KEY (`est_ID`) REFERENCES `estados_libros` (`est_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libros`
--

LOCK TABLES `libros` WRITE;
/*!40000 ALTER TABLE `libros` DISABLE KEYS */;
INSERT INTO `libros` VALUES (1,1,1,'9781444707861','IT','Novela','Terror','Ediciones B','null',4,0),(2,18,1,'33982899','Alexandros','Novela','Historica','Alfahuara','Vida de Alejandro Magno ',2,0),(3,19,1,'994838832','El Padrino','Novela','Suspenso','Pala','Novela de Mafia',3,0),(4,19,1,'','sd','','','','',3,1),(5,1,1,'99483234','El Resplandor','Novela','Terror','','Un cuidador se queda con su familia durante en el invierno trabajando en un hotel asilado por la nieve y empieza a enloquecer cuando descubre que en hotel existen otras cosas,',2,0),(6,18,1,'9765757588','Paladion','Novela histórica','','','El paladion cae del cielo y la diosa Atenea emprende una misión para encontrarlo junto con unos mortales en la época moderna.',3,0),(7,1,1,'','La hora del Vampiro','','','','',1,1),(8,1,1,'','La hora del Vampiro','','','','',1,1),(9,1,1,'','La hora del Vampiro','','','','',1,1),(10,1,1,'','La hora del Vampiro','','','','',1,1),(11,1,1,'','La hora del Vampiro','','','','',1,1),(12,1,1,'','La hora del Vampiro','','','','',1,1),(13,1,1,'','La hora del Vampiro','','','','',1,0),(14,1,1,'','La hora del Vampiro','','','','',1,1),(15,1,1,'','La hora del Vampiro','','','','',1,1),(16,1,1,'El ojo del tibre','Aventura','','','','',2,1),(17,1,1,'ojo tigre','Aventur','ee','momo','s','',3,0);
/*!40000 ALTER TABLE `libros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT INTO `paises` VALUES (1,'AF','Afganistán'),(2,'AX','Islas Gland'),(3,'AL','Albania'),(4,'DE','Alemania'),(5,'AD','Andorra'),(6,'AO','Angola'),(7,'AI','Anguilla'),(8,'AQ','Antártida'),(9,'AG','Antigua y Barbuda'),(10,'AN','Antillas Holandesas'),(11,'SA','Arabia Saudí'),(12,'DZ','Argelia'),(13,'AR','Argentina'),(14,'AM','Armenia'),(15,'AW','Aruba'),(16,'AU','Australia'),(17,'AT','Austria'),(18,'AZ','Azerbaiyán'),(19,'BS','Bahamas'),(20,'BH','Bahréin'),(21,'BD','Bangladesh'),(22,'BB','Barbados'),(23,'BY','Bielorrusia'),(24,'BE','Bélgica'),(25,'BZ','Belice'),(26,'BJ','Benin'),(27,'BM','Bermudas'),(28,'BT','Bhután'),(29,'BO','Bolivia'),(30,'BA','Bosnia y Herzegovina'),(31,'BW','Botsuana'),(32,'BV','Isla Bouvet'),(33,'BR','Brasil'),(34,'BN','Brunéi'),(35,'BG','Bulgaria'),(36,'BF','Burkina Faso'),(37,'BI','Burundi'),(38,'CV','Cabo Verde'),(39,'KY','Islas Caimán'),(40,'KH','Camboya'),(41,'CM','Camerún'),(42,'CA','Canadá'),(43,'CF','República Centroafricana'),(44,'TD','Chad'),(45,'CZ','República Checa'),(46,'CL','Chile'),(47,'CN','China'),(48,'CY','Chipre'),(49,'CX','Isla de Navidad'),(50,'VA','Ciudad del Vaticano'),(51,'CC','Islas Cocos'),(52,'CO','Colombia'),(53,'KM','Comoras'),(54,'CD','República Democrática del Congo'),(55,'CG','Congo'),(56,'CK','Islas Cook'),(57,'KP','Corea del Norte'),(58,'KR','Corea del Sur'),(59,'CI','Costa de Marfil'),(60,'CR','Costa Rica'),(61,'HR','Croacia'),(62,'CU','Cuba'),(63,'DK','Dinamarca'),(64,'DM','Dominica'),(65,'DO','República Dominicana'),(66,'EC','Ecuador'),(67,'EG','Egipto'),(68,'SV','El Salvador'),(69,'AE','Emiratos Árabes Unidos'),(70,'ER','Eritrea'),(71,'SK','Eslovaquia'),(72,'SI','Eslovenia'),(73,'ES','España'),(74,'UM','Islas ultramarinas de Estados Unidos'),(75,'US','Estados Unidos'),(76,'EE','Estonia'),(77,'ET','Etiopía'),(78,'FO','Islas Feroe'),(79,'PH','Filipinas'),(80,'FI','Finlandia'),(81,'FJ','Fiyi'),(82,'FR','Francia'),(83,'GA','Gabón'),(84,'GM','Gambia'),(85,'GE','Georgia'),(86,'GS','Islas Georgias del Sur y Sandwich del Sur'),(87,'GH','Ghana'),(88,'GI','Gibraltar'),(89,'GD','Granada'),(90,'GR','Grecia'),(91,'GL','Groenlandia'),(92,'GP','Guadalupe'),(93,'GU','Guam'),(94,'GT','Guatemala'),(95,'GF','Guayana Francesa'),(96,'GN','Guinea'),(97,'GQ','Guinea Ecuatorial'),(98,'GW','Guinea-Bissau'),(99,'GY','Guyana'),(100,'HT','Haití'),(101,'HM','Islas Heard y McDonald'),(102,'HN','Honduras'),(103,'HK','Hong Kong'),(104,'HU','Hungría'),(105,'IN','India'),(106,'ID','Indonesia'),(107,'IR','Irán'),(108,'IQ','Iraq'),(109,'IE','Irlanda'),(110,'IS','Islandia'),(111,'IL','Israel'),(112,'IT','Italia'),(113,'JM','Jamaica'),(114,'JP','Japón'),(115,'JO','Jordania'),(116,'KZ','Kazajstán'),(117,'KE','Kenia'),(118,'KG','Kirguistán'),(119,'KI','Kiribati'),(120,'KW','Kuwait'),(121,'LA','Laos'),(122,'LS','Lesotho'),(123,'LV','Letonia'),(124,'LB','Líbano'),(125,'LR','Liberia'),(126,'LY','Libia'),(127,'LI','Liechtenstein'),(128,'LT','Lituania'),(129,'LU','Luxemburgo'),(130,'MO','Macao'),(131,'MK','ARY Macedonia'),(132,'MG','Madagascar'),(133,'MY','Malasia'),(134,'MW','Malawi'),(135,'MV','Maldivas'),(136,'ML','Malí'),(137,'MT','Malta'),(138,'FK','Islas Malvinas'),(139,'MP','Islas Marianas del Norte'),(140,'MA','Marruecos'),(141,'MH','Islas Marshall'),(142,'MQ','Martinica'),(143,'MU','Mauricio'),(144,'MR','Mauritania'),(145,'YT','Mayotte'),(146,'MX','México'),(147,'FM','Micronesia'),(148,'MD','Moldavia'),(149,'MC','Mónaco'),(150,'MN','Mongolia'),(151,'MS','Montserrat'),(152,'MZ','Mozambique'),(153,'MM','Myanmar'),(154,'NA','Namibia'),(155,'NR','Nauru'),(156,'NP','Nepal'),(157,'NI','Nicaragua'),(158,'NE','Níger'),(159,'NG','Nigeria'),(160,'NU','Niue'),(161,'NF','Isla Norfolk'),(162,'NO','Noruega'),(163,'NC','Nueva Caledonia'),(164,'NZ','Nueva Zelanda'),(165,'OM','Omán'),(166,'NL','Países Bajos'),(167,'PK','Pakistán'),(168,'PW','Palau'),(169,'PS','Palestina'),(170,'PA','Panamá'),(171,'PG','Papúa Nueva Guinea'),(172,'PY','Paraguay'),(173,'PE','Perú'),(174,'PN','Islas Pitcairn'),(175,'PF','Polinesia Francesa'),(176,'PL','Polonia'),(177,'PT','Portugal'),(178,'PR','Puerto Rico'),(179,'QA','Qatar'),(180,'GB','Reino Unido'),(181,'RE','Reunión'),(182,'RW','Ruanda'),(183,'RO','Rumania'),(184,'RU','Rusia'),(185,'EH','Sahara Occidental'),(186,'SB','Islas Salomón'),(187,'WS','Samoa'),(188,'AS','Samoa Americana'),(189,'KN','San Cristóbal y Nevis'),(190,'SM','San Marino'),(191,'PM','San Pedro y Miquelón'),(192,'VC','San Vicente y las Granadinas'),(193,'SH','Santa Helena'),(194,'LC','Santa Lucía'),(195,'ST','Santo Tomé y Príncipe'),(196,'SN','Senegal'),(197,'CS','Serbia y Montenegro'),(198,'SC','Seychelles'),(199,'SL','Sierra Leona'),(200,'SG','Singapur'),(201,'SY','Siria'),(202,'SO','Somalia'),(203,'LK','Sri Lanka'),(204,'SZ','Suazilandia'),(205,'ZA','Sudáfrica'),(206,'SD','Sudán'),(207,'SE','Suecia'),(208,'CH','Suiza'),(209,'SR','Surinam'),(210,'SJ','Svalbard y Jan Mayen'),(211,'TH','Tailandia'),(212,'TW','Taiwán'),(213,'TZ','Tanzania'),(214,'TJ','Tayikistán'),(215,'IO','Territorio Británico del Océano Índico'),(216,'TF','Territorios Australes Franceses'),(217,'TL','Timor Oriental'),(218,'TG','Togo'),(219,'TK','Tokelau'),(220,'TO','Tonga'),(221,'TT','Trinidad y Tobago'),(222,'TN','Túnez'),(223,'TC','Islas Turcas y Caicos'),(224,'TM','Turkmenistán'),(225,'TR','Turquía'),(226,'TV','Tuvalu'),(227,'UA','Ucrania'),(228,'UG','Uganda'),(229,'UY','Uruguay'),(230,'UZ','Uzbekistán'),(231,'VU','Vanuatu'),(232,'VE','Venezuela'),(233,'VN','Vietnam'),(234,'VG','Islas Vírgenes Británicas'),(235,'VI','Islas Vírgenes de los Estados Unidos'),(236,'WF','Wallis y Futuna'),(237,'YE','Yemen'),(238,'DJ','Yibuti'),(239,'ZM','Zambia'),(240,'ZW','Zimbabue');
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perf_funcionalidad`
--

DROP TABLE IF EXISTS `perf_funcionalidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perf_funcionalidad` (
  `perFunc_iD` int(11) NOT NULL,
  `per_ID` int(11) NOT NULL,
  `func_ID` int(11) NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  PRIMARY KEY (`perFunc_iD`),
  KEY `perFunc_perfil` (`per_ID`),
  KEY `perFunc_func` (`func_ID`),
  CONSTRAINT `perFunc_func` FOREIGN KEY (`func_ID`) REFERENCES `funcionalidades` (`func_ID`),
  CONSTRAINT `perFunc_perfil` FOREIGN KEY (`per_ID`) REFERENCES `perfiles` (`perf_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perf_funcionalidad`
--

LOCK TABLES `perf_funcionalidad` WRITE;
/*!40000 ALTER TABLE `perf_funcionalidad` DISABLE KEYS */;
INSERT INTO `perf_funcionalidad` VALUES (1,1,1,0),(2,1,2,0),(3,1,3,0),(4,2,3,0),(5,1,4,0),(6,3,4,0),(7,2,4,0),(8,1,5,0),(9,1,6,0),(10,1,7,0),(11,1,8,0),(12,1,9,0),(13,1,10,0),(14,1,11,0),(15,1,12,0),(16,1,13,0);
/*!40000 ALTER TABLE `perf_funcionalidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfiles` (
  `perf_ID` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  PRIMARY KEY (`perf_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles`
--

LOCK TABLES `perfiles` WRITE;
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` VALUES (1,'Administrador',0),(2,'Operador',0),(3,'Socio',0);
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestamos`
--

DROP TABLE IF EXISTS `prestamos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prestamos` (
  `pres_ID` int(11) NOT NULL,
  `soc_ID` int(11) NOT NULL,
  `res_ID` int(11) NOT NULL,
  `lib_ID` int(11) NOT NULL,
  `fechaIni` date NOT NULL,
  `fechaFin` date NOT NULL,
  PRIMARY KEY (`pres_ID`),
  KEY `prestamo_socio` (`soc_ID`),
  KEY `prestamo_libro` (`lib_ID`),
  CONSTRAINT `prestamo_libro` FOREIGN KEY (`lib_ID`) REFERENCES `libros` (`lib_ID`),
  CONSTRAINT `prestamo_socio` FOREIGN KEY (`soc_ID`) REFERENCES `socios` (`soc_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestamos`
--

LOCK TABLES `prestamos` WRITE;
/*!40000 ALTER TABLE `prestamos` DISABLE KEYS */;
/*!40000 ALTER TABLE `prestamos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservas` (
  `res_ID` int(11) NOT NULL,
  `soc_ID` int(11) NOT NULL,
  `lib_ID` int(11) NOT NULL,
  `fechaIni` date NOT NULL,
  `fechaFin` date NOT NULL,
  `realizada` tinyint(1) NOT NULL,
  PRIMARY KEY (`res_ID`),
  KEY `reserva_libro` (`lib_ID`),
  KEY `reserva_socio` (`soc_ID`),
  CONSTRAINT `reserva_libro` FOREIGN KEY (`lib_ID`) REFERENCES `libros` (`lib_ID`),
  CONSTRAINT `reserva_socio` FOREIGN KEY (`soc_ID`) REFERENCES `socios` (`soc_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sanciones`
--

DROP TABLE IF EXISTS `sanciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sanciones` (
  `san_ID` int(11) NOT NULL,
  `pres_ID` int(11) NOT NULL,
  `tip_ID` int(11) NOT NULL,
  `soc_ID` int(11) NOT NULL,
  `fechaIni` date NOT NULL,
  `fechaFin` date DEFAULT NULL,
  PRIMARY KEY (`san_ID`),
  KEY `sancion_socio` (`soc_ID`),
  KEY `sancion_prestamo` (`pres_ID`),
  KEY `sancion_tipo` (`tip_ID`),
  CONSTRAINT `sancion_prestamo` FOREIGN KEY (`pres_ID`) REFERENCES `prestamos` (`pres_ID`),
  CONSTRAINT `sancion_socio` FOREIGN KEY (`soc_ID`) REFERENCES `socios` (`soc_ID`),
  CONSTRAINT `sancion_tipo` FOREIGN KEY (`tip_ID`) REFERENCES `tipos_sanciones` (`tip_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sanciones`
--

LOCK TABLES `sanciones` WRITE;
/*!40000 ALTER TABLE `sanciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `sanciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socios`
--

DROP TABLE IF EXISTS `socios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `socios` (
  `soc_ID` int(11) NOT NULL,
  `usu_ID` int(11) NOT NULL,
  `nombreApe` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `barrio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `localidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `codPostal` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`soc_ID`),
  KEY `socio_usuario` (`usu_ID`),
  CONSTRAINT `socio_usuario` FOREIGN KEY (`usu_ID`) REFERENCES `usuarios` (`usu_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socios`
--

LOCK TABLES `socios` WRITE;
/*!40000 ALTER TABLE `socios` DISABLE KEYS */;
/*!40000 ALTER TABLE `socios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_sanciones`
--

DROP TABLE IF EXISTS `tipos_sanciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_sanciones` (
  `tip_ID` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`tip_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_sanciones`
--

LOCK TABLES `tipos_sanciones` WRITE;
/*!40000 ALTER TABLE `tipos_sanciones` DISABLE KEYS */;
INSERT INTO `tipos_sanciones` VALUES (1,'Temporal'),(2,'Definitiva');
/*!40000 ALTER TABLE `tipos_sanciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usu_ID` int(11) NOT NULL,
  `perf_ID` int(11) NOT NULL,
  `nombreApe` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `login` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fechaAlta` date NOT NULL,
  `fechaBaja` date DEFAULT NULL,
  `eliminado` tinyint(1) NOT NULL,
  PRIMARY KEY (`usu_ID`),
  KEY `usuarios_perfiles` (`perf_ID`),
  CONSTRAINT `usuarios_perfiles` FOREIGN KEY (`perf_ID`) REFERENCES `perfiles` (`perf_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,1,'Victor Martinez','vic','victor','2017-10-01',NULL,0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-23  9:26:25
