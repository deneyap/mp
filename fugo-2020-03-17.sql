# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.35)
# Database: fugo
# Generation Time: 2020-03-17 15:56:32 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(100) DEFAULT NULL,
  `displayIndex` tinyint(255) DEFAULT '0',
  `description` text,
  `coverFile` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;

INSERT INTO `cities` (`id`, `label`, `displayIndex`, `description`, `coverFile`)
VALUES
	(1,'İstanbul',0,NULL,NULL),
	(2,'İzmir',1,NULL,NULL),
	(3,'Ankara',2,NULL,NULL),
	(4,'Trabzon',8,NULL,NULL),
	(5,'Malatya',3,NULL,NULL);

/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table extras
# ------------------------------------------------------------

DROP TABLE IF EXISTS `extras`;

CREATE TABLE `extras` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `extras` WRITE;
/*!40000 ALTER TABLE `extras` DISABLE KEYS */;

INSERT INTO `extras` (`id`, `title`, `text`)
VALUES
	(1,'Ekstra Geziler Hakkında Bilgilendirme','Tur programda belirtilen ekstra geziler, servis aldığımız yerel acente tarafından minimum 20 kişi katılım şartı ile düzenlenmektedir. Yeterli çoğunluk sağlanamadığı takdirde geziler yapılamamaktadır veya ekstra gezi fiyatları ve içerik katılımcı sayısına göre değişiklik gösterebilmektedir. Özel/ayrı olarak çocuk fiyatı belirtilmeyen ekstra turlarda, 3-12 yaş arası çocuk misafirler için ekstra turlar %50 indirimli. Ekstra tur fiyatları turları düzenleyen yerel acenta tarafından belirlenmektedir.');

/*!40000 ALTER TABLE `extras` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tour_dates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tour_dates`;

CREATE TABLE `tour_dates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tourId` int(11) unsigned DEFAULT NULL,
  `startDate` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_tour` (`tourId`),
  CONSTRAINT `fk_tour` FOREIGN KEY (`tourId`) REFERENCES `tours` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tour_dates` WRITE;
/*!40000 ALTER TABLE `tour_dates` DISABLE KEYS */;

INSERT INTO `tour_dates` (`id`, `tourId`, `startDate`, `status`)
VALUES
	(1,1,'2020-03-20',0),
	(2,1,'2020-04-20',1),
	(3,1,'2020-05-20',1),
	(4,2,'2020-03-21',1),
	(5,2,'2020-03-28',1);

/*!40000 ALTER TABLE `tour_dates` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tour_destinations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tour_destinations`;

CREATE TABLE `tour_destinations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tourId` int(11) unsigned DEFAULT NULL,
  `cityId` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tourId` (`tourId`),
  KEY `cityId` (`cityId`),
  CONSTRAINT `tour_destinations_ibfk_1` FOREIGN KEY (`tourId`) REFERENCES `tours` (`id`),
  CONSTRAINT `tour_destinations_ibfk_2` FOREIGN KEY (`cityId`) REFERENCES `cities` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tour_destinations` WRITE;
/*!40000 ALTER TABLE `tour_destinations` DISABLE KEYS */;

INSERT INTO `tour_destinations` (`id`, `tourId`, `cityId`)
VALUES
	(1,1,1),
	(2,1,3),
	(3,2,1),
	(4,2,2),
	(5,2,4);

/*!40000 ALTER TABLE `tour_destinations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tour_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tour_details`;

CREATE TABLE `tour_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tourId` int(11) unsigned DEFAULT NULL,
  `transportation` enum('otobus','ucak','tren','yat','gemi') DEFAULT 'otobus',
  `groupSize` tinyint(255) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tourId` (`tourId`),
  CONSTRAINT `tour_details_ibfk_1` FOREIGN KEY (`tourId`) REFERENCES `tours` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tour_details` WRITE;
/*!40000 ALTER TABLE `tour_details` DISABLE KEYS */;

INSERT INTO `tour_details` (`id`, `tourId`, `transportation`, `groupSize`)
VALUES
	(1,1,'otobus',0),
	(2,2,'ucak',10);

/*!40000 ALTER TABLE `tour_details` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tour_extras
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tour_extras`;

CREATE TABLE `tour_extras` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tourId` int(11) unsigned DEFAULT NULL,
  `extraId` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tourId` (`tourId`,`extraId`),
  KEY `extraId` (`extraId`),
  CONSTRAINT `tour_extras_ibfk_1` FOREIGN KEY (`tourId`) REFERENCES `tours` (`id`),
  CONSTRAINT `tour_extras_ibfk_2` FOREIGN KEY (`extraId`) REFERENCES `extras` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tour_extras` WRITE;
/*!40000 ALTER TABLE `tour_extras` DISABLE KEYS */;

INSERT INTO `tour_extras` (`id`, `tourId`, `extraId`)
VALUES
	(1,2,1);

/*!40000 ALTER TABLE `tour_extras` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tour_info
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tour_info`;

CREATE TABLE `tour_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tourId` int(11) unsigned DEFAULT NULL,
  `included` text,
  `exclude` text,
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `tourId` (`tourId`),
  CONSTRAINT `tour_info_ibfk_1` FOREIGN KEY (`tourId`) REFERENCES `tours` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table tour_medias
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tour_medias`;

CREATE TABLE `tour_medias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tourId` int(11) unsigned DEFAULT NULL,
  `coverPath` varchar(255) DEFAULT NULL,
  `filePath` varchar(255) DEFAULT NULL,
  `type` enum('video','photo') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tourId` (`tourId`),
  CONSTRAINT `tour_medias_ibfk_1` FOREIGN KEY (`tourId`) REFERENCES `tours` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tour_medias` WRITE;
/*!40000 ALTER TABLE `tour_medias` DISABLE KEYS */;

INSERT INTO `tour_medias` (`id`, `tourId`, `coverPath`, `filePath`, `type`)
VALUES
	(1,1,'img1.jpg','img1.jpg','photo'),
	(2,1,'video1.jpg','video1.mov','video');

/*!40000 ALTER TABLE `tour_medias` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tour_timelines
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tour_timelines`;

CREATE TABLE `tour_timelines` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tourId` int(11) unsigned DEFAULT NULL,
  `label` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `text` text,
  `displayIndex` tinyint(255) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tourId` (`tourId`),
  CONSTRAINT `tour_timelines_ibfk_1` FOREIGN KEY (`tourId`) REFERENCES `tours` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tour_timelines` WRITE;
/*!40000 ALTER TABLE `tour_timelines` DISABLE KEYS */;

INSERT INTO `tour_timelines` (`id`, `tourId`, `label`, `title`, `description`, `text`, `displayIndex`)
VALUES
	(1,1,'1. GÜN','CUMA / Adana, Buluşma Noktalarından Hareket','24:00’da Gazipaşa Etstur Ofisi Önü hareket ediyoruz.','Hoş geldiniz ikramımızı dağıtıyoruz. (ikram Kutusu: sandviç,  muz, meyve suyu, şeker, kurabiye) Otobüs yolculuğunuzun rahat ve konforlu geçmesi ve otele girmeden gezilere başlayacağımız için, bol ve spor kıyafetler ile topuksuz, tercihen spor ayakkabısı giymenizi tavsiye ederiz… Tur boyunca beraber olacağımız rehberlerimiz ve kaptanlarımız ile tanışıyoruz',0),
	(2,1,'2. GÜN','CUMARTESİ /Köprülü Kanyon Milli Parkı Rafting. Dileyen Herkes Keyifli Su Oyunlarının Olduğu Rafting Heyecanına Katılabilir.',NULL,'Sabah yol güzergahında aldığımız kahvaltımızın ardından otobüsümüzde buluşarak Selge Kenti ile Kervan yolunu bağlayan Antik Roma Köprüsü’nün adını verdiği tabiat harikası Köprülü Kanyon’a devam ediyoruz.\nRafting Ekstra: 85,00 TL 7den 70e herkesin rahatlıkla katılabileceği heyecanlı Rafting macerasını Köprüçay’ın buz gibi sularında beraber yaşıyoruz (ekstra). Rafting merkezinde verilen gerekli bilgi (Malzeme tanıtımı ve kullanılması, rafting sırasında uygulanması gereken kurallar vb.) sonrası rafting macerasını tatmak için botlarımıza binerek Köprülü Kanyon’un buz gibi sularında raftinge başlıyoruz. Tatlı suda yüzme molaları ile birlikte ortalama 3 saat sürecek keyif ardından rafting restoranımızda alacağımız yemeğin ardından arzu edenler fotoğrafları ve video çekimlerini izleyebilirler. Akşam yemeği ve konaklama otelimizde.\n\nSabah Kahvaltısı: Otobüste dağıtılan lunch box (sandviç, meyve, kurabiye, meyve suyu, nane şekeri)\nÖğlen Yemeği: Rafting Restoran\nMenü: Asma yaprağında alabalık veya sebzeli tavuk şiş ızgara (ana yemek seçmeli) çoban salata, pilav ve makarna, meyve\nAkşam Yemeği: Otelde tur ücretine dahil olarak açık büfe veya set menü şeklinde sunuluyor. Tüm içecekler ekstra.\nKonaklama: Antalya otelleri (Konaklanabilecek oteller programın altında belirtilmiştir.)\nRota: Adana – Ulukışla- Karaman – Akseki – Side -  Antalya (537 km).',1),
	(3,1,'3. GÜN','PAZAR / Kekova & Batıkşehir Tekne Turu, Kemer, Kumluca, Finike, Demre, Kaputaş, Üçağız, Simena, Saklıkent(1.tekne)',NULL,'Sabah otelde alınan erken kahvaltının ardından hareketle Kemer, Kumluca, Finike üzerinden Üçağız köyüne doğru sert virajlardan inerken Kekova’nın muhteşem manzarası sizi kucaklayacak. Kekova bölgesi olarak adlandırdığımız bölge 1990’da sit alanı olmuş adını Kekova adasından alıp, Batıkşehir, Simena Kaleköy ve Üçağız (Teimiussa)  köyünü kapsayan alandır. Üçağız köyünden başlayan tekne turumuzda Kekova bölgesinin muhteşem koylarında yüzmenin keyfine varacaksınız, MS 141 ve 240 yıllarında yaşanmış büyük depremler sonucu sular altında kalmış kısım günümüzde Batık Şehir (Dolichiste)olarak adlandırılıyor. Su altında kalmış batıklar ve tarih sizleri büyüleyecek. Kekova tekne turumuzda göreceğiniz yerler; Yolu olmayan Simena (Kale Köy), Tersane Koyu, Hamidiye Koyu, Kekova Adası olacak  ardından teknemiz bizleri ortalama 15 dakika sonrasında kıyıya ulaştırmış olacak. Kıyıda köylü teyzelerin deniz kabuklarından yapmış olduğu ürünleri görebilmek ve alışveriş yapmak için kısa bir zaman sonrasında otobüsümüze biniyoruz ve ülkemizin en ünlü kanyonlarından birisi olan Saklıkent Kanyonu’nu görmek için aracımızla hareket ediyoruz. Neredeyse buz gibi sularda Kanyondaki keyifli yürüyüşümüz sonrasında  Kalkan, Kaş sahillerini izleyerek resimlerine bakıp da mümkün değil o su o renk olamaz dedikten sonra sizleri çok daha fazlası ile karşılaşacak olan Kaputaş Plajı’na ulaşıyor ve burada kısa bir fotoğraf molası veriyoruz. Ardından konaklama yapacağımız otelimize doğru hareket ediyoruz. Akşam yemeği ve konaklama otelimizde. \n\nKahvaltı: Otelde tur ücretine dahil olarak açık büfe veya set menü şeklinde sunuluyor.\nÖğle Yemeği:Tur ücretine dahil. Kekova tekne turu esnasında sunuluyor. Tur ücretine tavuk menü dahildir.\nMenü: Soslu tavuk ızgara, bezelye, pilav, soslu mantı makarna, çoban salata.\nAkşam Yemeği: Otelde tur ücretine dahil olarak açık büfe veya set menü şeklinde sunuluyor. Tüm içecekler ekstra.  \nKonaklama: Fethiye Edasu Otel.\nRota: Fethiye ',2),
	(4,2,'00:10','TEst',NULL,NULL,0);

/*!40000 ALTER TABLE `tour_timelines` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tours
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tours`;

CREATE TABLE `tours` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cityId` int(11) unsigned DEFAULT NULL,
  `typeId` int(11) unsigned DEFAULT NULL,
  `title` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(100) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cityId` (`cityId`),
  KEY `typeId` (`typeId`),
  CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`cityId`) REFERENCES `cities` (`id`),
  CONSTRAINT `tours_ibfk_2` FOREIGN KEY (`typeId`) REFERENCES `types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tours` WRITE;
/*!40000 ALTER TABLE `tours` DISABLE KEYS */;

INSERT INTO `tours` (`id`, `cityId`, `typeId`, `title`, `slug`, `duration`, `amount`)
VALUES
	(1,1,2,'Uçaklı Karadeniz, Anadolujet, 3 Gece Konaklamalı','ucakli-karadeniz-turu','2 GÜN 3 GECE',1300.00),
	(2,3,7,'Akdeniz Ege, Adana, 5 Gece Otel Konaklaması','akdeniz-ege-adana-5-gece-otel-konaklamasi','5 GÜN 4 GECE',600.00);

/*!40000 ALTER TABLE `tours` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `types`;

CREATE TABLE `types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parentId` int(11) unsigned DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `displayIndex` tinyint(255) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parentId` (`parentId`),
  CONSTRAINT `types_ibfk_1` FOREIGN KEY (`parentId`) REFERENCES `types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;

INSERT INTO `types` (`id`, `parentId`, `label`, `displayIndex`)
VALUES
	(1,NULL,'Kültür Turları',0),
	(2,1,'EGE - AKDENİZ TURLARI',0),
	(3,1,'ARA TATİL TURLARI (SÖMESTİR)',0),
	(4,1,'TREN TURLARI',0),
	(5,1,'HAFTA SONU TURLARI',0),
	(6,NULL,'Yurt Dışı Turları',0),
	(7,6,'İTALYA TURLARI',0),
	(8,6,'BALKAN VE YUNANİSTAN TURLARI',0);

/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
