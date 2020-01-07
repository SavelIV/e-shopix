-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: phpshop
-- ------------------------------------------------------
-- Server version	5.7.27

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (13,'Ноутбуки',1,1),(14,'Планшеты',2,1),(15,'Мониторы',3,1),(16,'Игровые компьютеры',4,1),(17,'something for something',6,1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `price` float NOT NULL,
  `availability` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT '0',
  `is_recommended` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (34,'Ноутбук Asus X200MA (X200MA-KX315D)',13,1839707,395,1,'Asus','Экран 11.6\" (1366x768) HD LED, глянцевый / Intel Pentium N3530 (2.16 - 2.58 ГГц) / RAM 4 ГБ / HDD 750 ГБ / Intel HD Graphics / без ОД / Bluetooth 4.0 / Wi-Fi / LAN / веб-камера / без ОС / 1.24 кг / синий',0,0,1),(35,'Ноутбук HP Stream 11-d050nr',13,2343847,305,0,'Hewlett Packard','Экран 11.6” (1366x768) HD LED, матовый / Intel Celeron N2840 (2.16 ГГц) / RAM 2 ГБ / eMMC 32 ГБ / Intel HD Graphics / без ОД / Wi-Fi / Bluetooth / веб-камера / Windows 8.1 + MS Office 365 / 1.28 кг / синий',1,1,1),(36,'Ноутбук Asus X200MA White ',13,2028027,270,1,'Asus','Экран 11.6\" (1366x768) HD LED, глянцевый / Intel Celeron N2840 (2.16 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / Bluetooth 4.0 / Wi-Fi / LAN / веб-камера / без ОС / 1.24 кг / белый',0,1,1),(37,'Ноутбук Acer Aspire E3-112-C65X',13,2019487,325,1,'Acer','Экран 11.6\'\' (1366x768) HD LED, матовый / Intel Celeron N2840 (2.16 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / LAN / Wi-Fi / Bluetooth / веб-камера / Linpus / 1.29 кг / серебристый',0,1,1),(38,'Ноутбук Acer TravelMate TMB115',13,1953212,275,1,'Acer','Экран 11.6\'\' (1366x768) HD LED, матовый / Intel Celeron N2840 (2.16 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / LAN / Wi-Fi / Bluetooth 4.0 / веб-камера / Linpus / 1.32 кг / черный',0,0,1),(39,'Ноутбук Lenovo Flex 10',13,1602042,370,0,'Lenovo','Экран 10.1\" (1366x768) HD LED, сенсорный, глянцевый / Intel Celeron N2830 (2.16 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / Wi-Fi / Bluetooth / веб-камера / Windows 8.1 / 1.2 кг / черный',0,0,1),(40,'Ноутбук Asus X751MA',13,2028367,430,1,'Asus','Экран 17.3\" (1600х900) HD+ LED, глянцевый / Intel Pentium N3540 (2.16 - 2.66 ГГц) / RAM 4 ГБ / HDD 1 ТБ / Intel HD Graphics / DVD Super Multi / LAN / Wi-Fi / Bluetooth 4.0 / веб-камера / DOS / 2.6 кг / белый',0,1,1),(41,'Samsung Galaxy Tab S 10.5 16GB',14,1129365,780,1,'Samsung','Samsung Galaxy Tab S создан для того, чтобы сделать вашу жизнь лучше. Наслаждайтесь своим контентом с покрытием 94% цветов Adobe RGB и 100000:1 уровнем контрастности, который обеспечивается sAmoled экраном с функцией оптимизации под отображаемое изображение и окружение. Яркий 10.5” экран в ультратонком корпусе весом 467 г порадует вас высоким уровнем портативности. Работа станет проще вместе с Hancom Office и удаленным доступом к вашему ПК. E-Meeting и WebEx – отличные помощники для проведения встреч, когда вы находитесь вне офиса. Надежно храните ваши данные благодаря сканеру отпечатка пальцев.',1,1,1),(42,'Samsung Galaxy Tab S 8.4 16GB',14,1128670,640,1,'Samsung','Экран 8.4\" Super AMOLED (2560x1600) емкостный Multi-Touch / Samsung Exynos 5420 (1.9 ГГц + 1.3 ГГц) / RAM 3 ГБ / 16 ГБ встроенной памяти + поддержка карт памяти microSD / Bluetooth 4.0 / Wi-Fi 802.11 a/b/g/n/ac / основная камера 8 Мп, фронтальная 2.1 Мп / GPS / ГЛОНАСС / Android 4.4.2 (KitKat) / 294 г / белый',0,0,1),(43,'Gazer Tegra Note 7',14,683364,210,1,'Gazer','Экран 7\" IPS (1280x800) емкостный Multi-Touch / NVIDIA Tegra 4 (1.8 ГГц) / RAM 1 ГБ / 16 ГБ встроенной памяти + поддержка карт памяти microSD / Wi-Fi / Bluetooth 4.0 / основная камера 5 Мп, фронтальная - 0.3 Мп / GPS / ГЛОНАСС / Android 4.4.2 (KitKat) / вес 320 г',0,0,1),(44,'Монитор 23\" Dell E2314H Black',15,355025,175,1,'Dell','С расширением Full HD Вы сможете рассмотреть мельчайшие детали. Dell E2314H предоставит Вам резкое и четкое изображение, с которым любая работа будет в удовольствие. Full HD 1920 x 1080 при 60 Гц разрешение (макс.)',0,0,1),(45,'Компьютер Everest Game ',16,1563832,1320,1,'Everest','Everest Game 9085 — это компьютеры премимум класса, собранные на базе эксклюзивных компонентов, тщательно подобранных и протестированных лучшими специалистами нашей компании. Это топовый сегмент систем, который отвечает наилучшим характеристикам показателей качества и производительности.',0,0,1),(46,'something',13,1,1000,1,'me','this is something',1,1,1);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_order`
--

DROP TABLE IF EXISTS `product_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_comment` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `products` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_order`
--

LOCK TABLES `product_order` WRITE;
/*!40000 ALTER TABLE `product_order` DISABLE KEYS */;
INSERT INTO `product_order` VALUES (49,'Виктор Зинченко','5555555555','victor',4,'2019-03-27 12:13:37','{\"44\":2,\"43\":1,\"40\":1}',1),(47,'Игорь','8125857865','its me',6,'2019-03-26 21:33:12','{\"45\":2,\"40\":1,\"42\":1,\"41\":1}',1),(48,'Саша','4545454545','casha',3,'2019-03-26 22:40:36','{\"44\":2,\"43\":1,\"42\":2}',1),(50,'goga','5555555555','fefe',0,'2019-03-27 14:16:00','{\"44\":1,\"43\":1}',1),(51,'goga','5555555555','#2',8,'2019-03-27 14:26:48','{\"44\":1,\"42\":1,\"43\":1}',1),(52,'goga','6666666665','nfvndvjkvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj',8,'2019-03-27 16:28:06','{\"45\":1,\"40\":1,\"44\":1}',1),(53,'goga','9999999999','hgjhfkgklglvn',8,'2019-03-27 16:56:42','{\"43\":1}',1),(54,'goga','99999999999','gxgxiuhkjsnjsjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj',8,'2019-03-27 17:03:03','{\"44\":1,\"45\":1}',1),(55,'goga','3333333333','gtkghlgjlgjfk;k  f;okok  otjjg jrtgjf je5poyfjpof jifh   dotyoth hgifg gjg fjjf  kgjljg gjglfj  gjfiojojf gjfgjogj jgfj gjrgf jgjfg jifgj  fj fgjf g pgj5pj5pj f j5 f5jfpj  jf5gj5fj5gjgjgp5jp f phjpj5pgj5poj5pj5fpj j5pfj5pf 5pf f5j5pj5pj5pj5gjfj j5g5jgp5jgp5ofj5pogjgpojg gjgp5jgpo5jg5pogj5fpogj5 j5pgfj5pgj5pgj5pg jg5pgj5f pj5f 5f 5jgf 5pgj5pg5ojfgop5j g 5pgj5f p5ojgpgofkj5ggp5ojg  fpgj5pgj5pfgkepkwfgpk4f  f[gk5gkg[pkfo;gj rlgjr g gj rjglrgjr rgpr   jg perojgrpogjre;ogj;gjlgjrtlgj f 5jh ejgv vgjcfj chvcprhoifh  c rhcgejf d;jd fhnrtlgj cc hgierofh tegh lgrjc gr crigjc hrgjt cjgwg cjltg wcg jgjr kgh kgh wgh gdh 4',8,'2019-03-27 20:42:05','{\"42\":1,\"41\":1}',1),(56,'goga','666666666666666','hgjhfkgklglvn gjtrgligj gjrtog tgrjrpf fgijf gojrogf ff ijf iryjf rgf   f rfirjf rfj rgfj frf rjrf r;gjr fgr  frogfjr forjf rfj r fr;ogf ;o r;og fr;o f;ro f;f j f frjfr;ogj;ogjo;jf gjgo;gjr;ogjf;gm;rjrotgj    ;j;ojf;ogjr;gj;ogj;gjf;  fg ;roj;of ;jr;ofj;ojojf grgjrtgj;ofjr;ogjr;ogjfr;rjg;eojgf e;gre;dgj e;gdj;otje;h dd ;og4;gdj ;4oglgid ghdo fhdwfh ohgptg ;ogdj h lrjg ;rojg dr;ogjdw hge wgd hg;otgj ;rtgdj;og jg dd g;t gh;ogjr;ogj ;rgh dghg;lgj ;tgojrt ;ogj d; gjd4;ogj 4;og ',8,'2019-03-27 21:13:17','{\"45\":1,\"44\":1,\"40\":2}',1),(57,'goga','33443344334444','hgjhfkgklglvn tidj5t tj  dt4jtpi5dt   j4idt 4t5j 4otijd 4t 4otijd 4to  4oitd4 to 4 4iotjd 4tij4t tij  ptj dpt 5p d5pd 56pjp56jtgpj6 d d g6pojd 5pdj5  d  dp5oj5pjo  dp5 d5pj5pdj 5p dgj 5p',8,'2019-03-27 21:57:45','{\"44\":1,\"43\":1}',1),(58,'goga','9999999999999999','тмлмод омадом  моамо омша двшоф  о шо  сшов  шмо',8,'2019-03-27 22:06:14','{\"45\":1,\"40\":1,\"41\":1}',1),(59,'яя','9099900990','nnn',0,'2019-03-28 22:36:27','{\"45\":3}',1),(60,'Игорь','hhhhhhhhhh','ghjkk',6,'2019-03-28 22:45:08','{\"44\":1}',4),(61,'яя','9099900990','ghjghj gjghj gjhjhgjhg gjgjgjgh gjhguhgih hihlih hiuhih huihiu huib byuby hbiuh',9,'2019-03-28 22:56:41','{\"44\":2}',1),(62,'Igor','99215555555','was made 02/06/2019',6,'2019-06-02 10:35:47','{\"41\":1,\"40\":1,\"43\":1}',4);
/*!40000 ALTER TABLE `product_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,'Саша','alex@mail.com','333333',''),(4,'Виктор Зинченко','zinchenko.us@gmail.com','222222','admin'),(5,'Сергей','serg@mail.com','111111',''),(6,'Igor','savelevi@mail.ru','11111111','admin'),(7,'ГОша','fdsfgggf@mv.ru','11111111',''),(8,'goga','gogogogo@gogo.ru','gogogogo',''),(9,'яя','fff@ff.ff','ffffff',''),(10,'савва','fhsjljv@ui.ru','12345678','');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-29 16:20:49
