-- MySQL dump 10.13  Distrib 5.7.25, for Win32 (AMD64)
--
-- Host: localhost    Database: simple_shop
-- ------------------------------------------------------
-- Server version	5.7.25

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `handle` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `INDEX_HANDLE` (`handle`),
  KEY `index_categories_parent_id` (`parent_id`),
  KEY `index_categories_handle` (`handle`),
  KEY `index_categories_status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Bracelets',0,'bracelets','flowers_1024x1024.png',1),(2,'Earrings',0,'earrings','rainbows_1024x1024.png',1),(3,'Necklaces',0,'necklaces','spiral_1024x1024.png',1),(4,'Rings',0,'rings','stars_1024x1024.png',1),(5,'Beaded',1,'beaded','flowers_1024x1024.png',1),(6,'Chain',5,'chain','rainbows_1024x1024.png',1),(7,'Wrap',6,'wrap','spiral_1024x1024.png',1),(8,'Cuff',1,'cuff','stars_1024x1024.png',1),(9,'Hoop Earrings',2,'hoop-earrings','spiral_1024x1024.png',1),(10,'Studs Earrings',2,'studs-earrings','stars_1024x1024.png',1),(11,'Pinky Rings',4,'pinky-rings','flowers_1024x1024.png',1),(12,'Zodiak Rings',4,'zodiak-rings','rainbows_1024x1024.png',1),(13,'Chain Rings',4,'chain-rings','spiral_1024x1024.png',1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_product`
--

DROP TABLE IF EXISTS `category_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_product` (
  `category_id` int(11) unsigned NOT NULL DEFAULT '0',
  `product_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_product`
--

LOCK TABLES `category_product` WRITE;
/*!40000 ALTER TABLE `category_product` DISABLE KEYS */;
INSERT INTO `category_product` VALUES (1,1),(1,2),(1,3),(1,4),(1,8),(1,9),(1,10),(1,11),(2,5),(2,6),(2,7),(3,12),(3,13),(4,14),(4,15),(4,16),(4,17),(5,1),(5,2),(6,3),(6,4),(7,8),(8,9),(8,10),(8,11),(8,12);
/*!40000 ALTER TABLE `category_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `product_name` varchar(255) NOT NULL,
  `qty` mediumint(7) NOT NULL DEFAULT '0',
  `price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(11,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (25,25,9,'Blue Sapphire Tennis Bracelet',2,2500.00,5000.00),(26,25,3,'Diamond V Cuff',3,750.00,2250.00),(27,26,9,'Blue Sapphire Tennis Bracelet',1,2500.00,2500.00),(28,26,14,'Diamond Marquise Ring',1,650.00,650.00),(29,26,3,'Diamond V Cuff',1,750.00,750.00),(30,27,9,'Blue Sapphire Tennis Bracelet',3,2500.00,7500.00),(31,28,9,'Blue Sapphire Tennis Bracelet',3,2500.00,7500.00),(32,29,9,'Blue Sapphire Tennis Bracelet',3,2500.00,7500.00),(33,30,9,'Blue Sapphire Tennis Bracelet',1,2500.00,2500.00),(34,31,14,'Diamond Marquise Ring',1,650.00,650.00),(35,31,3,'Diamond V Cuff',3,750.00,2250.00),(36,32,9,'Blue Sapphire Tennis Bracelet',3,2500.00,7500.00),(37,32,14,'Diamond Marquise Ring',1,650.00,650.00);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL DEFAULT 'in_progress',
  `total_amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zipcode` varchar(20) DEFAULT NULL,
  `country` varchar(20) NOT NULL,
  `delivery_time` varchar(20) DEFAULT NULL,
  `delivery_date` varchar(20) DEFAULT NULL,
  `created_at` varchar(30) NOT NULL,
  `updated_at` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (30,'in_progress',2500.00,'Denis','Developer','dns@rebussoft.com','345345345345','Shev 23','New York','NY','10001','USA','12:29','2020-05-09','2020-04-24 12:29:47','2020-04-24 12:29:47'),(29,'in_progress',7500.00,'Denis','Developer','dns@rebussoft.com','345345345345','Shev 23','New York','NY','10001','USA','12:22','2020-05-09','2020-04-24 12:22:15','2020-04-24 12:22:15'),(28,'in_progress',7500.00,'Denis','Developer','dns@rebussoft.com','345345345345','Shev 23','New York','NY','10001','USA','12:21','2020-05-08','2020-04-24 12:21:34','2020-04-24 12:21:34'),(27,'in_progress',7500.00,'Denis','Developer','dns@rebussoft.com','345345345345','Shev 23','New York','NY','10001','USA','12:20','2020-05-01','2020-04-24 12:20:44','2020-04-24 12:20:44'),(26,'in_progress',3900.00,'Denis','Developer','dns@rebussoft.com','345345345345','Shev 23','New York','NY','10001','USA','13:39','2020-05-08','2020-04-23 18:39:59','2020-04-23 18:39:59'),(25,'in_progress',7250.00,'Denis','Developer','dns@rebussoft.com','345345345345','Shev 23','New York','NY','10001','USA','18:17','2020-05-01','2020-04-23 18:17:10','2020-04-23 18:17:10'),(31,'in_progress',2900.00,'Denis','Developer','dns@rebussoft.com','345345345345','Shev 23','New York','NY','10001','Russia','09:00','2020-05-09','2020-04-24 16:29:53','2020-04-24 16:29:53'),(32,'in_progress',8150.00,'Denis','Developer','dns@rebussoft.com','345345345345','Shev 23','New York','NY','','USA','','2020-05-07','2020-04-24 18:10:10','2020-04-24 18:10:10');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `image` varchar(255) DEFAULT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0',
  `handle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `INDEX_HANDLE` (`handle`),
  KEY `index_products_handle` (`handle`),
  KEY `index_products_status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Pink-Sapphire Bangle','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',750.00,'sapphire_tennis_bracelets_stack_ca562aff-ac15-4158-8b7a-b3b35e3c8281_1000x.jpg',1,'pink-sapphire-bangle'),(2,'Multi-Sapphire Bangle','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',750.00,'sbg-b12-14K-M-circle_1000x.jpg',1,'multi-sapphire-bangle'),(3,'Diamond V Cuff','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',750.00,'sbg-b16-d-circle_874x.jpg',1,'diamond-v-cuff'),(4,'Blue Sapphire Star Cuff','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',456.00,'sbg-b16-m-circle_1000x.png',1,'blue-sapphire-star-cuff'),(5,'Diamond Star Studs','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',665.00,'sbg-e117-14k-m-square_1000x.jpg',1,'diamond-star-studs'),(6,'Pear Sapphire Rainbow Drops','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',1225.00,'sbg-e118-14k-d-square_1000x.jpg',1,'pear-sapphire-rainbow-drops'),(7,'Moonstone Marquis Drop Earring','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',950.00,'SBg-E121-14K-C_38962ec3-1d3c-4ca9-96eb-7125a18e50a5_1000x.jpg',1,'moonstone-marquis-drop-earring'),(8,'Rainbow Sapphire Tennis Bracelet','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',2500.00,'sbg-b4-10K-B-circle_1000x.jpg',1,'rainbow-sapphire-tennis-bracelet'),(9,'Blue Sapphire Tennis Bracelet','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',2500.00,'sbg-b61_b70-14K-model1_1000x.jpg',1,'blue-sapphire-tennis-bracelet'),(10,'Rainbow V Sapphire Cuff','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',455.00,'sbg-b61_b70-model-3_1000x.jpg',1,'rainbow-v-sapphire-cuff'),(11,'Rainbow Sapphire Pear Cuff','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',1450.00,'sbg-b70-14K-model-stack_1000x.jpg',1,'rainbow-sapphire-pear-cuff'),(12,'Sapphire Puffy Heart Pendant','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',895.00,'sapphire_rainbow_necklace_close_1000x.jpg',1,'sapphire-puffy-heart-pendant'),(13,'Rainbow Sapphire Tennis Necklace','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',4200.00,'sbg-n85-14K-R_1000x.jpg',1,'rainbow-sapphire-tennis-necklace'),(14,'Diamond Marquise Ring','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',650.00,'sbg-r10-GM_1000x.jpg',1,'diamond-marquise-ring'),(15,'Pink Sapphire Band','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',275.00,'sbg-r50-14K-TC-model2_1000x.jpg',1,'pink-sapphire-band'),(16,'Pink Sapphire Pinky Ring','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',650.00,'sbg-r63-10K-P-circle_1000x.jpg',1,'pink-sapphire-pinky-ring'),(17,'Heart Rainbow Ring','We\'ve created a modern way to wear your heart on your finger.  An instant classic, this satisfyingly sized ring is easy to wear. Handcrafted with a grey topaz stone in the center and surrounded by rainbow sapphires, this ring is set in 14K gold. ',975.00,'SBG-R63-10K-PINK_1000x.jpg',1,'heart-rainbow-ring');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-24 19:42:27
