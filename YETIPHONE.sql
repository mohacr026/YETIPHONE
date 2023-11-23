-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.28-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.2.0.6576
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para yetiphone
CREATE DATABASE IF NOT EXISTS `yetiphone` /*!40100 DEFAULT CHARACTER SET armscii8 COLLATE armscii8_bin */;
USE `yetiphone`;

-- Volcando estructura para tabla yetiphone.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `user` varchar(50) NOT NULL,
  `pass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Volcando datos para la tabla yetiphone.admin: ~0 rows (aproximadamente)

-- Volcando estructura para tabla yetiphone.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Volcando datos para la tabla yetiphone.category: ~0 rows (aproximadamente)

-- Volcando estructura para tabla yetiphone.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `img` varchar(150) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `featured` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Volcando datos para la tabla yetiphone.product: ~0 rows (aproximadamente)

-- Volcando estructura para tabla yetiphone.purchase
CREATE TABLE IF NOT EXISTS `purchase` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` enum('PENDING','SHIPPED') DEFAULT NULL,
  `date_order` int(11) DEFAULT NULL,
  `date_shipment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Volcando datos para la tabla yetiphone.purchase: ~0 rows (aproximadamente)

-- Volcando estructura para tabla yetiphone.subcategory
CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Volcando datos para la tabla yetiphone.subcategory: ~0 rows (aproximadamente)

-- Volcando estructura para tabla yetiphone.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `email` int(11) DEFAULT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `name` int(11) DEFAULT NULL,
  `surname` int(11) DEFAULT NULL,
  `direction` int(11) DEFAULT NULL,
  `password` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Volcando datos para la tabla yetiphone.usuarios: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
