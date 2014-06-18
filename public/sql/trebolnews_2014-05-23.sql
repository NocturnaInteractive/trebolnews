# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.6.16)
# Database: trebolnews
# Generation Time: 2014-05-23 12:08:02 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table campanias
# ------------------------------------------------------------

DROP TABLE IF EXISTS `campanias`;

CREATE TABLE `campanias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `asunto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remitente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `respuesta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table carpetas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carpetas`;

CREATE TABLE `carpetas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `carpetas` WRITE;
/*!40000 ALTER TABLE `carpetas` DISABLE KEYS */;

INSERT INTO `carpetas` (`id`, `id_usuario`, `nombre`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,0,'imagenes','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(2,1,'basura','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL);

/*!40000 ALTER TABLE `carpetas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contactos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contactos`;

CREATE TABLE `contactos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_lista` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `puesto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `empresa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pais` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `contactos` WRITE;
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;

INSERT INTO `contactos` (`id`, `id_lista`, `nombre`, `apellido`, `email`, `puesto`, `empresa`, `pais`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,'qwe','oij','pok@pok.com','oij','oij','oij','2014-05-22 12:20:33','2014-05-22 12:27:30','2014-05-22 12:27:30'),
	(2,1,'kjn','kjn','kjn@jn.com','kjn','kjn','kjn','2014-05-22 12:23:52','2014-05-22 12:23:52',NULL);

/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table imagenes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `imagenes`;

CREATE TABLE `imagenes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_carpeta` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `imagenes` WRITE;
/*!40000 ALTER TABLE `imagenes` DISABLE KEYS */;

INSERT INTO `imagenes` (`id`, `id_carpeta`, `nombre`, `archivo`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,'Telefonista','libreriaimg1.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(2,1,'Conferencia','libreriaimg2.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(3,1,'Saludo amistoso','libreriaimg3.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(4,1,'Email','libreriaimg4.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(5,1,'Reunión','libreriaimg5.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(6,1,'Descripción','libreriaimg6.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(7,1,'Descripción','libreriaimg7.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(8,1,'Descripción','libreriaimg8.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(9,1,'Descripción','libreriaimg9.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(10,1,'Descripción','libreriaimg10.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(11,1,'Descripción','libreriaimg11.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(12,1,'Descripción','libreriaimg12.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(13,1,'Descripción','libreriaimg13.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(14,1,'Descripción','libreriaimg14.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL),
	(15,1,'Descripción','libreriaimg15.jpg','2014-05-22 12:18:06','2014-05-22 12:18:06',NULL);

/*!40000 ALTER TABLE `imagenes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table listas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `listas`;

CREATE TABLE `listas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `listas` WRITE;
/*!40000 ALTER TABLE `listas` DISABLE KEYS */;

INSERT INTO `listas` (`id`, `id_usuario`, `nombre`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,'La lista','2014-05-22 12:18:55','2014-05-22 12:19:21',NULL),
	(2,1,'Otras listas','2014-05-22 12:19:04','2014-05-22 12:19:15',NULL);

/*!40000 ALTER TABLE `listas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2014_05_20_175912_crear_usuarios',1),
	('2014_05_20_231720_crear_listas',1),
	('2014_05_20_231755_crear_contactos',1),
	('2014_05_21_162055_crear_imagenes',1),
	('2014_05_21_162316_crear_carpetas',1),
	('2014_05_21_181231_crear_campanias',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `empresa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pais` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `newsletter` tinyint(1) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;

INSERT INTO `usuarios` (`id`, `email`, `password`, `remember_token`, `nombre`, `apellido`, `telefono`, `empresa`, `ciudad`, `pais`, `confirmation`, `confirmed`, `newsletter`, `last_login`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'maimar@gmail.com','$2y$10$7l1xJ8eN7oZ4z3MwuAIWX.ifuiZBgTtmD9hRdVUGH./mvp7ruePUu','','Martín','Aimar','','','','','',1,0,'2014-05-23 08:27:44','2014-05-22 12:18:06','2014-05-23 08:27:44',NULL);

/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
