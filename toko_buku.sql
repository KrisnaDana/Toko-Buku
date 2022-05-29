/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.22-MariaDB : Database - toko_buku
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`toko_buku` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `toko_buku`;

/*Table structure for table `admin_notifications` */

DROP TABLE IF EXISTS `admin_notifications`;

CREATE TABLE `admin_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_notifications_notifiable_id_foreign` (`notifiable_id`),
  CONSTRAINT `admin_notifications_notifiable_id_foreign` FOREIGN KEY (`notifiable_id`) REFERENCES `admins` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admin_notifications` */

insert  into `admin_notifications`(`id`,`type`,`notifiable_type`,`notifiable_id`,`data`,`read_at`,`created_at`,`updated_at`) values 
(1,'App\\Notifications\\ProducNotification','App\\Models\\Admin',3,'{\"nama\":\"Glep\",\"message\":\"membeli product!\",\"id\":8,\"category\":\"transcation\"}',NULL,'2022-05-20 04:43:46','2022-05-20 04:43:46'),
(2,'App\\Notifications\\ProducNotification','App\\Models\\Admin',3,'{\"nama\":\"Glep\",\"message\":\"Verifikasi Pembayaran!\",\"id\":\"8\",\"category\":\"Transcation\"}',NULL,'2022-05-20 04:44:00','2022-05-20 04:44:00'),
(3,'App\\Notifications\\ProducNotification','App\\Models\\Admin',3,'{\"nama\":\"Glep\",\"message\":\"membeli product!\",\"id\":9,\"category\":\"transcation\"}',NULL,'2022-05-20 11:25:27','2022-05-20 11:25:27'),
(4,'App\\Notifications\\ProducNotification','App\\Models\\Admin',3,'{\"nama\":\"Glep\",\"message\":\"Verifikasi Pembayaran!\",\"id\":\"9\",\"category\":\"Transcation\"}',NULL,'2022-05-20 19:50:47','2022-05-20 19:50:47'),
(5,'App\\Notifications\\ProducNotification','App\\Models\\Admin',3,'{\"nama\":\"Glep\",\"message\":\"seseorang mereview product!\",\"id\":\"26\",\"category\":\"review\"}',NULL,'2022-05-20 19:53:17','2022-05-20 19:53:17'),
(6,'App\\Notifications\\ProducNotification','App\\Models\\Admin',3,'{\"nama\":\"Glep\",\"message\":\"membeli product!\",\"id\":10,\"category\":\"transcation\"}',NULL,'2022-05-20 19:54:19','2022-05-20 19:54:19'),
(7,'App\\Notifications\\ProducNotification','App\\Models\\Admin',3,'{\"nama\":\"Glep\",\"message\":\"membeli product!\",\"id\":11,\"category\":\"transcation\"}',NULL,'2022-05-20 20:09:33','2022-05-20 20:09:33'),
(8,'App\\Notifications\\ProducNotification','App\\Models\\Admin',3,'{\"nama\":\"Glep\",\"message\":\"Verifikasi Pembayaran!\",\"id\":\"11\",\"category\":\"Transcation\"}',NULL,'2022-05-20 20:11:27','2022-05-20 20:11:27'),
(9,'App\\Notifications\\ProducNotification','App\\Models\\Admin',3,'{\"nama\":\"Glep\",\"message\":\"seseorang mereview product!\",\"id\":\"27\",\"category\":\"review\"}',NULL,'2022-05-20 20:22:06','2022-05-20 20:22:06'),
(10,'App\\Notifications\\ProducNotification','App\\Models\\Admin',3,'{\"nama\":\"Glep\",\"message\":\"membeli product!\",\"id\":12,\"category\":\"transaction\"}',NULL,'2022-05-20 20:24:06','2022-05-20 20:24:06'),
(11,'App\\Notifications\\ProducNotification','App\\Models\\Admin',3,'{\"nama\":\"Glep\",\"message\":\"Transaksi Dibatalkan!\",\"id\":\"12\",\"category\":\"canceled\"}',NULL,'2022-05-20 20:24:17','2022-05-20 20:24:17');

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`username`,`password`,`name`,`profile_image`,`phone`,`remember_token`,`created_at`,`updated_at`) values 
(2,'superadmin','$2y$10$.S5yp8W2z21coExl2pk3ZuJpM2UshG2HB1fPsUjzpHRSFahPIbn42','super admin','809635827.jpg','32902398',NULL,'2022-04-15 20:39:44','2022-05-02 17:37:45'),
(3,'teguh123','$2y$10$pRWZ5DaKiN3uXLl5NeUJxekwjv4NL3ELFZnETRw9mQzb6sYyGo6X.','Teguh',NULL,'082982965432',NULL,'2022-04-17 06:10:34','2022-04-17 06:10:34');

/*Table structure for table `book_categories` */

DROP TABLE IF EXISTS `book_categories`;

CREATE TABLE `book_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `book_categories` */

insert  into `book_categories`(`id`,`category_name`,`created_at`,`updated_at`) values 
(1,'Buku Pelajaran','2022-04-19 07:14:57','2022-04-19 07:14:57'),
(3,'Buku Horor','2022-04-19 07:22:44','2022-04-29 01:43:36'),
(4,'Buku Cerita','2022-04-19 10:33:17','2022-04-19 10:33:17');

/*Table structure for table `book_category_details` */

DROP TABLE IF EXISTS `book_category_details`;

CREATE TABLE `book_category_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `book_category_details_book_id_foreign` (`book_id`),
  KEY `book_category_details_category_id_foreign` (`category_id`),
  CONSTRAINT `book_category_details_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `book_category_details_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `book_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `book_category_details` */

insert  into `book_category_details`(`id`,`book_id`,`category_id`,`created_at`,`updated_at`) values 
(6,26,1,'2022-04-29 01:45:03','2022-04-29 01:45:03'),
(7,27,1,'2022-04-29 01:46:08','2022-04-29 01:46:08'),
(8,28,1,'2022-04-29 01:49:30','2022-04-29 01:49:40'),
(9,29,1,'2022-04-29 01:52:06','2022-04-29 02:05:11');

/*Table structure for table `book_images` */

DROP TABLE IF EXISTS `book_images`;

CREATE TABLE `book_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` bigint(20) unsigned NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `book_images_book_id_foreign` (`book_id`),
  CONSTRAINT `book_images_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `book_images` */

insert  into `book_images`(`id`,`book_id`,`image_name`,`created_at`,`updated_at`) values 
(11,26,'1341181923.jpg','2022-04-29 01:45:03','2022-04-29 01:45:03'),
(12,27,'1316471904.jpg','2022-04-29 01:46:08','2022-04-29 01:46:08'),
(13,28,'564141251.jpg','2022-04-29 01:49:30','2022-04-29 01:49:30'),
(14,29,'152809760.jpg','2022-04-29 01:52:06','2022-04-29 01:52:06');

/*Table structure for table `book_reviews` */

DROP TABLE IF EXISTS `book_reviews`;

CREATE TABLE `book_reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `transaction_detail_id` bigint(20) unsigned NOT NULL,
  `rate` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `book_reviews_book_id_foreign` (`book_id`),
  KEY `book_reviews_user_id_foreign` (`user_id`),
  KEY `transaction_id` (`transaction_detail_id`),
  CONSTRAINT `book_reviews_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  CONSTRAINT `book_reviews_ibfk_1` FOREIGN KEY (`transaction_detail_id`) REFERENCES `transaction_details` (`id`),
  CONSTRAINT `book_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `book_reviews` */

insert  into `book_reviews`(`id`,`book_id`,`user_id`,`transaction_detail_id`,`rate`,`content`,`created_at`,`updated_at`) values 
(1,29,2,1,5,'mantap bukunya',NULL,NULL),
(2,29,3,1,4,'lumayan',NULL,NULL),
(3,29,2,1,5,'keren sekali','2022-05-03 13:51:58','2022-05-03 13:51:58'),
(4,29,2,1,3,'keren sekali','2022-05-03 13:52:23','2022-05-03 13:52:23'),
(5,29,2,1,3,'test','2022-05-03 13:54:57','2022-05-03 13:54:57'),
(6,29,2,1,3,'test','2022-05-03 13:55:16','2022-05-03 13:55:16'),
(7,26,2,1,5,'bagus bukunya','2022-05-20 19:53:17','2022-05-20 19:53:17'),
(8,27,2,12,5,'bukunya keren','2022-05-20 20:22:06','2022-05-20 20:22:06'),
(9,27,2,10,5,'keren bukunya','2022-05-21 09:08:19','2022-05-21 09:08:19');

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `book_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint(20) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_rate` float NOT NULL,
  `stock` int(11) NOT NULL,
  `weight` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `books` */

insert  into `books`(`id`,`book_name`,`price`,`description`,`book_rate`,`stock`,`weight`,`created_at`,`updated_at`,`image_name`,`category_name`) values 
(26,'Biologi',100000,'Buku Biologi Untuk Kelas 10 SMA',5,98,1.00,'2022-04-29 01:45:03','2022-05-20 20:24:17','1341181923.jpg','1'),
(27,'Fisika',120000,'Fisika Untuk Kelas 10 SMA',5,118,1.00,'2022-04-29 01:46:07','2022-05-20 20:24:17','1316471904.jpg','1'),
(28,'Bahasa Inggris',200000,'Bahas Inggris Untuk Kelas 10 SMA',0,12,1.00,'2022-04-29 01:49:30','2022-05-20 11:04:31','564141251.jpg','1'),
(29,'Bahasa Indonesia',100000,'Bahasa Indonesia Untuk Kelas 10 SMA',3.83333,21,1.00,'2022-04-29 01:52:06','2022-05-20 11:04:31','152809760.jpg','1');

/*Table structure for table `carts` */

DROP TABLE IF EXISTS `carts`;

CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `book_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_book_id_foreign` (`book_id`),
  CONSTRAINT `carts_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `carts` */

insert  into `carts`(`id`,`user_id`,`book_id`,`qty`,`status`,`created_at`,`updated_at`) values 
(1,2,29,6,'hapus',NULL,'2022-05-20 04:43:47'),
(2,2,27,2,'hapus',NULL,'2022-05-03 21:19:10'),
(3,2,27,3,'hapus','2022-05-03 21:44:24','2022-05-03 21:44:46'),
(4,2,29,1,'hapus','2022-05-03 21:55:08','2022-05-03 21:55:29'),
(5,2,28,1,'hapus','2022-05-03 21:56:31','2022-05-04 10:16:22'),
(6,2,28,2,'hapus','2022-05-04 11:38:52','2022-05-20 04:43:47'),
(7,2,27,1,'hapus','2022-05-20 20:23:11','2022-05-20 20:24:06'),
(8,2,26,2,'hapus','2022-05-20 20:23:27','2022-05-20 20:24:06'),
(9,2,27,3,'aktif','2022-05-21 10:02:00','2022-05-21 11:55:16'),
(10,2,26,1,'aktif','2022-05-21 11:39:07','2022-05-21 11:39:07');

/*Table structure for table `couriers` */

DROP TABLE IF EXISTS `couriers`;

CREATE TABLE `couriers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `courier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `couriers_courier_unique` (`courier`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `couriers` */

insert  into `couriers`(`id`,`courier`,`created_at`,`updated_at`) values 
(4,'jne','2022-04-22 15:08:24','2022-04-22 15:08:24'),
(5,'pos',NULL,NULL),
(6,'tiki',NULL,NULL);

/*Table structure for table `discounts` */

DROP TABLE IF EXISTS `discounts`;

CREATE TABLE `discounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` bigint(20) unsigned NOT NULL,
  `percentage` double(8,2) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discounts_book_id_foreign` (`book_id`),
  CONSTRAINT `discounts_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `discounts` */

insert  into `discounts`(`id`,`book_id`,`percentage`,`start`,`end`,`created_at`,`updated_at`) values 
(10,27,10.00,'2022-04-29','2022-05-03','2022-04-29 01:46:36','2022-04-29 01:46:36'),
(11,29,50.00,'2022-04-29','2022-05-12','2022-04-29 01:53:35','2022-04-29 01:53:35');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(157,'2014_10_12_000000_create_users_table',1),
(158,'2014_10_12_100000_create_password_resets_table',1),
(159,'2019_08_19_000000_create_failed_jobs_table',1),
(160,'2019_12_14_000001_create_personal_access_tokens_table',1),
(161,'2022_02_27_142927_create_admins_table',1),
(162,'2022_02_27_143255_create_admin_notifications_table',1),
(163,'2022_02_27_144045_create_books_table',1),
(164,'2022_02_27_144617_create_discounts_table',1),
(165,'2022_02_27_144935_create_book_images_table',1),
(166,'2022_02_27_145238_create_book_categories_table',1),
(167,'2022_02_27_145346_create_book_category_details_table',1),
(168,'2022_02_27_150040_create_carts_table',1),
(169,'2022_02_27_150731_create_user_notifications_table',1),
(170,'2022_02_27_151219_create_couriers_table',1),
(171,'2022_02_27_151220_create_transactions_table',1),
(172,'2022_02_27_152022_create_transaction_details_table',1),
(173,'2022_02_27_152446_create_book_reviews_table',1),
(174,'2022_02_27_152704_create_responses_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `responses` */

DROP TABLE IF EXISTS `responses`;

CREATE TABLE `responses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `review_id` bigint(20) unsigned NOT NULL,
  `admin_id` bigint(20) unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `responses_review_id_foreign` (`review_id`),
  KEY `responses_admin_id_foreign` (`admin_id`),
  CONSTRAINT `responses_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  CONSTRAINT `responses_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `book_reviews` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `responses` */

insert  into `responses`(`id`,`review_id`,`admin_id`,`content`,`created_at`,`updated_at`) values 
(1,1,2,'Terimakasih',NULL,NULL),
(4,9,2,'terima kasih','2022-05-21 09:59:03','2022-05-21 09:59:03');

/*Table structure for table `transaction_details` */

DROP TABLE IF EXISTS `transaction_details`;

CREATE TABLE `transaction_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint(20) unsigned NOT NULL,
  `book_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `selling_price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_details_transaction_id_foreign` (`transaction_id`),
  KEY `transaction_details_book_id_foreign` (`book_id`),
  CONSTRAINT `transaction_details_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  CONSTRAINT `transaction_details_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaction_details` */

insert  into `transaction_details`(`id`,`transaction_id`,`book_id`,`qty`,`discount`,`selling_price`,`created_at`,`updated_at`) values 
(1,4,29,1,50.00,50000,'2022-05-04 18:14:40','2022-05-04 18:14:40'),
(2,4,28,1,0.00,200000,'2022-05-04 18:14:40','2022-05-04 18:14:40'),
(3,5,29,1,NULL,50000,'2022-05-04 19:02:37','2022-05-04 19:02:37'),
(4,6,29,1,50.00,50000,'2022-05-04 19:06:52','2022-05-04 19:06:52'),
(5,7,29,2,50.00,50000,'2022-05-04 23:19:11','2022-05-04 23:19:11'),
(6,7,28,2,0.00,200000,'2022-05-04 23:19:11','2022-05-04 23:19:11'),
(7,8,29,1,0.00,100000,'2022-05-20 04:43:46','2022-05-20 04:43:46'),
(8,9,26,1,0.00,100000,'2022-05-20 11:25:27','2022-05-20 11:25:27'),
(9,10,26,1,0.00,100000,'2022-05-20 19:54:19','2022-05-20 19:54:19'),
(10,11,27,2,0.00,120000,'2022-05-20 20:09:33','2022-05-20 20:09:33'),
(11,12,27,1,0.00,120000,'2022-05-20 20:24:06','2022-05-20 20:24:06'),
(12,12,26,2,0.00,100000,'2022-05-20 20:24:06','2022-05-20 20:24:06');

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `courier_id` bigint(20) unsigned NOT NULL,
  `timeout` datetime NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` bigint(20) DEFAULT NULL,
  `shipping_cost` bigint(20) DEFAULT NULL,
  `subtotal` bigint(20) DEFAULT NULL,
  `proof_of_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  KEY `transactions_courier_id_foreign` (`courier_id`),
  CONSTRAINT `transactions_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`),
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`user_id`,`courier_id`,`timeout`,`address`,`regency`,`province`,`total`,`shipping_cost`,`subtotal`,`proof_of_payment`,`status`,`created_at`,`updated_at`) values 
(1,2,4,'2022-02-01 18:00:52','tes','Buleleng','Bali',274000,24000,250000,NULL,'transaksi expired','2022-05-04 18:00:52','2022-05-04 21:05:12'),
(2,2,4,'2022-05-05 18:05:15','tes','Buleleng','Bali',274000,24000,250000,NULL,'transaksi expired','2022-05-04 18:05:15','2022-05-20 19:51:23'),
(3,2,4,'2022-05-05 18:05:55','tes','Buleleng','Bali',274000,24000,250000,NULL,'transaksi expired','2022-05-04 18:05:55','2022-05-20 19:51:23'),
(4,2,4,'2022-05-05 18:14:40','tes','Buleleng','Bali',274000,24000,250000,'2094605133.jpg','menunggu verifikasi','2022-05-04 18:14:40','2022-05-05 01:29:19'),
(5,2,4,'2022-05-05 19:02:37','tes','Denpasar','Bali',61000,11000,50000,'','transaksi dibatalkan','2022-05-04 19:02:37','2022-05-04 23:25:59'),
(6,2,4,'2022-05-01 19:06:52','tes','Buleleng','Bali',62000,12000,50000,NULL,'barang telah sampai di tujuan','2022-05-04 19:06:52','2022-05-04 19:06:52'),
(7,2,4,'2022-05-05 23:19:11','test','Buleleng','Bali',548000,48000,500000,NULL,'transaksi expired','2022-05-04 23:19:11','2022-05-20 11:04:31'),
(8,2,4,'2022-05-21 12:43:46','tes','Gianyar','Bali',163000,63000,100000,'1879362391.jpg','menunggu verifikasi','2022-05-20 04:43:46','2022-05-20 04:44:00'),
(9,2,4,'2022-05-21 19:25:27','test','Denpasar','Bali',156000,56000,100000,'375241243.png','barang telah sampai di tujuan','2022-05-20 11:25:27','2022-05-20 19:52:14'),
(10,2,5,'2022-05-21 19:54:19','test','Gianyar','Bali',159000,59000,100000,NULL,'menunggu bukti pembayaran','2022-05-20 19:54:19','2022-05-20 19:54:19'),
(11,2,5,'2022-05-21 20:09:33','kampus sudirman','Denpasar','Bali',349000,109000,240000,'1624287204.jpg','barang telah sampai di tujuan','2022-05-20 20:09:33','2022-05-20 20:14:40'),
(12,2,6,'2022-05-21 20:24:06','kamsud','Denpasar','Bali',338000,18000,320000,NULL,'transaksi dibatalkan','2022-05-20 20:24:06','2022-05-20 20:24:17');

/*Table structure for table `user_notifications` */

DROP TABLE IF EXISTS `user_notifications`;

CREATE TABLE `user_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_notifications_notifiable_id_foreign` (`notifiable_id`),
  CONSTRAINT `user_notifications_notifiable_id_foreign` FOREIGN KEY (`notifiable_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_notifications` */

insert  into `user_notifications`(`id`,`type`,`notifiable_type`,`notifiable_id`,`data`,`read_at`,`created_at`,`updated_at`) values 
(1,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:19:42','2022-05-20 04:19:42'),
(2,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:19:42','2022-05-20 04:19:42'),
(3,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:19:42','2022-05-20 04:19:42'),
(4,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:29:56','2022-05-20 04:29:56'),
(5,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:29:56','2022-05-20 04:29:56'),
(6,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:29:56','2022-05-20 04:29:56'),
(7,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:31:00','2022-05-20 04:31:00'),
(8,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:31:00','2022-05-20 04:31:00'),
(9,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:31:00','2022-05-20 04:31:00'),
(10,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:32:13','2022-05-20 04:32:13'),
(11,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:32:13','2022-05-20 04:32:13'),
(12,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:32:13','2022-05-20 04:32:13'),
(13,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:33:05','2022-05-20 04:33:05'),
(14,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:33:05','2022-05-20 04:33:05'),
(15,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:33:05','2022-05-20 04:33:05'),
(16,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:33:55','2022-05-20 04:33:55'),
(17,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:33:55','2022-05-20 04:33:55'),
(18,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:33:55','2022-05-20 04:33:55'),
(19,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:34:31','2022-05-20 04:34:31'),
(20,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:34:31','2022-05-20 04:34:31'),
(21,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:34:31','2022-05-20 04:34:31'),
(22,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:37:00','2022-05-20 04:37:00'),
(23,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:37:00','2022-05-20 04:37:00'),
(24,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:37:00','2022-05-20 04:37:00'),
(25,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:37:11','2022-05-20 04:37:11'),
(26,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:37:11','2022-05-20 04:37:11'),
(27,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:37:11','2022-05-20 04:37:11'),
(28,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:37:25','2022-05-20 04:37:25'),
(29,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:37:25','2022-05-20 04:37:25'),
(30,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:37:25','2022-05-20 04:37:25'),
(31,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:38:01','2022-05-20 04:38:01'),
(32,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:38:01','2022-05-20 04:38:01'),
(33,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:38:01','2022-05-20 04:38:01'),
(34,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:38:34','2022-05-20 04:38:34'),
(35,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:38:34','2022-05-20 04:38:34'),
(36,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:38:34','2022-05-20 04:38:34'),
(37,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:38:42','2022-05-20 04:38:42'),
(38,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:38:42','2022-05-20 04:38:42'),
(39,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:38:42','2022-05-20 04:38:42'),
(40,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:39:13','2022-05-20 04:39:13'),
(41,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:39:13','2022-05-20 04:39:13'),
(42,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:39:13','2022-05-20 04:39:13'),
(43,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:39:25','2022-05-20 04:39:25'),
(44,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:39:25','2022-05-20 04:39:25'),
(45,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:39:25','2022-05-20 04:39:25'),
(46,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:41:18','2022-05-20 04:41:18'),
(47,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:41:18','2022-05-20 04:41:18'),
(48,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:41:18','2022-05-20 04:41:18'),
(49,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"Upload Bukti Pembayaran!\",\"id\":8,\"category\":\"transcation\"}',NULL,'2022-05-20 04:43:46','2022-05-20 04:43:46'),
(50,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:44:07','2022-05-20 04:44:07'),
(51,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:44:07','2022-05-20 04:44:07'),
(52,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:44:07','2022-05-20 04:44:07'),
(53,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:44:50','2022-05-20 04:44:50'),
(54,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:44:50','2022-05-20 04:44:50'),
(55,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:44:50','2022-05-20 04:44:50'),
(56,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:45:34','2022-05-20 04:45:34'),
(57,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:45:34','2022-05-20 04:45:34'),
(58,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:45:34','2022-05-20 04:45:34'),
(59,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:45:37','2022-05-20 04:45:37'),
(60,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:45:37','2022-05-20 04:45:37'),
(61,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:45:37','2022-05-20 04:45:37'),
(62,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:45:41','2022-05-20 04:45:41'),
(63,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:45:41','2022-05-20 04:45:41'),
(64,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:45:41','2022-05-20 04:45:41'),
(65,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 04:46:17','2022-05-20 04:46:17'),
(66,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 04:46:17','2022-05-20 04:46:17'),
(67,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 04:46:17','2022-05-20 04:46:17'),
(68,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 11:04:06','2022-05-20 11:04:06'),
(69,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 11:04:06','2022-05-20 11:04:06'),
(70,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}',NULL,'2022-05-20 11:04:06','2022-05-20 11:04:06'),
(71,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 11:04:25','2022-05-20 11:04:25'),
(72,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 11:04:25','2022-05-20 11:04:25'),
(73,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":7,\"category\":\"transcation\"}','2022-05-20 19:04:31','2022-05-20 11:04:25','2022-05-20 11:04:31'),
(74,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 11:04:38','2022-05-20 11:04:38'),
(75,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 11:04:38','2022-05-20 11:04:38'),
(76,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":2,\"category\":\"transcation\"}',NULL,'2022-05-20 11:19:45','2022-05-20 11:19:45'),
(77,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi expired!\",\"id\":3,\"category\":\"transcation\"}',NULL,'2022-05-20 11:19:45','2022-05-20 11:19:45'),
(78,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"Upload Bukti Pembayaran!\",\"id\":9,\"category\":\"transcation\"}',NULL,'2022-05-20 11:25:27','2022-05-20 11:25:27'),
(79,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"sudah tervirifikasi\",\"id\":\"9\",\"category\":\"transaction\"}',NULL,'2022-05-20 19:51:35','2022-05-20 19:51:35'),
(80,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"sudah tervirifikasi\",\"id\":\"9\",\"category\":\"transaction\"}',NULL,'2022-05-20 19:52:10','2022-05-20 19:52:10'),
(81,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"barang telah sampai tujuan\",\"id\":\"9\",\"category\":\"transaction\"}',NULL,'2022-05-20 19:52:14','2022-05-20 19:52:14'),
(82,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"barang telah sampai tujuan\",\"id\":\"9\",\"category\":\"transaction\"}',NULL,'2022-05-20 19:52:18','2022-05-20 19:52:18'),
(83,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"Upload Bukti Pembayaran!\",\"id\":10,\"category\":\"transcation\"}',NULL,'2022-05-20 19:54:19','2022-05-20 19:54:19'),
(84,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"Upload Bukti Pembayaran!\",\"id\":11,\"category\":\"transcation\"}',NULL,'2022-05-20 20:09:33','2022-05-20 20:09:33'),
(85,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"sudah tervirifikasi\",\"id\":\"11\",\"category\":\"transaction\"}',NULL,'2022-05-20 20:14:09','2022-05-20 20:14:09'),
(86,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"barang dikirim\",\"id\":\"11\",\"category\":\"transaction\"}',NULL,'2022-05-20 20:14:34','2022-05-20 20:14:34'),
(87,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"sudah tervirifikasi\",\"id\":\"11\",\"category\":\"transaction\"}',NULL,'2022-05-20 20:14:40','2022-05-20 20:14:40'),
(88,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"Upload Bukti Pembayaran!\",\"id\":12,\"category\":\"transcation\"}',NULL,'2022-05-20 20:24:06','2022-05-20 20:24:06'),
(89,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"Transaksi Berhasil Dibatalkan!\",\"id\":\"12\",\"category\":\"canceled\"}',NULL,'2022-05-20 20:24:17','2022-05-20 20:24:17'),
(90,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:48:37','2022-05-21 09:48:37'),
(91,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:48:50','2022-05-21 09:48:50'),
(92,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:49:03','2022-05-21 09:49:03'),
(93,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:50:23','2022-05-21 09:50:23'),
(94,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:50:43','2022-05-21 09:50:43'),
(95,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:51:04','2022-05-21 09:51:04'),
(96,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:53:07','2022-05-21 09:53:07'),
(97,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:54:32','2022-05-21 09:54:32'),
(98,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:54:41','2022-05-21 09:54:41'),
(99,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:55:20','2022-05-21 09:55:20'),
(100,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:55:50','2022-05-21 09:55:50'),
(101,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:56:04','2022-05-21 09:56:04'),
(102,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:56:22','2022-05-21 09:56:22'),
(103,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:56:49','2022-05-21 09:56:49'),
(104,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:57:05','2022-05-21 09:57:05'),
(105,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:57:20','2022-05-21 09:57:20'),
(106,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"transaksi dibatalkan\",\"id\":\"12\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:57:56','2022-05-21 09:57:56'),
(107,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"barang telah sampai tujuan\",\"id\":\"11\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:58:52','2022-05-21 09:58:52'),
(108,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"review anda direspon!\",\"id\":27,\"category\":\"review\"}',NULL,'2022-05-21 09:59:03','2022-05-21 09:59:03'),
(109,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"barang telah sampai tujuan\",\"id\":\"11\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:59:03','2022-05-21 09:59:03'),
(110,'App\\Notifications\\AdminNotification','App\\Models\\User',2,'{\"nama\":\"Admin\",\"message\":\"barang telah sampai tujuan\",\"id\":\"11\",\"category\":\"transaction\"}',NULL,'2022-05-21 09:59:12','2022-05-21 09:59:12');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`profile_image`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'test12345','krzna.com@gmail.com',NULL,'2022-04-10 14:27:05','$2y$10$horo7tkhxaXKKsLegfv2TeriUtXNUHHkYSfXFvp/Q3xTUwf1UDGxS',NULL,'2022-04-10 14:24:43','2022-04-10 14:27:05'),
(2,'Glep','glep@gmail.com','857257230.jpg','2022-04-12 11:10:41','$2y$10$YMgAwLChTvoSgzS0B6tfyueWK45v0bIJkybytcQKQImSzAFHIiJj.','yqO6rhUBCKo2K27czm8iMi2CXpBmnVgenjrHZSR3ATVhInmIEmm1Q83MaJOP','2022-04-12 11:09:13','2022-05-02 18:08:20'),
(3,'test','test123@gmail.com',NULL,'2022-04-12 12:04:27','$2y$10$CzBe3xvMXP5YyGAtELUrluvVFk5z3WmTjm9XehAbNjqlzOqT8OY3y','xXm8Bt6BLe5Q9MzRDE3WNGr4pyfpbRlI11CvJqBSmeMEugQRpFPBuOZ6pykR','2022-04-12 12:04:01','2022-04-12 12:07:19'),
(4,'test 9','test9@gmail.com',NULL,NULL,'$2y$10$NhhwUp/6QlagjceqLydk6OYQo3GcTgf6dXE8XiA2eEwV2i1WWjLzG',NULL,'2022-04-14 20:56:56','2022-04-14 20:56:56'),
(5,'teguh','teguharthana77@gmail.com',NULL,NULL,'$2y$10$qYw/g.c3LIEq0G7xtxEubuWPkBBH8TwM4Y/PKebYN/dDvVuH5fi8q',NULL,'2022-04-17 05:43:08','2022-04-17 05:43:08'),
(6,'teguh','teguharthana@gmail.com',NULL,'2022-04-17 05:53:23','$2y$10$OP7HTTX42cDpMZPQ1lXJc.7XoiC.erU7MJn9Vp9Uko6AR9204Kw.i','ayJflPdk04ZyulD9cThHoZwwb02plGh1OrBrcWdxG6kvWX86J2CW72eEo7x1','2022-04-17 05:48:41','2022-04-17 05:55:35'),
(7,'glep test','gleptest@gmail.com',NULL,NULL,'$2y$10$1EzaoN4HR1iNST7BG8Uax.fI17t6T3jdygJ.5J7w7FvOio4c3GJuq',NULL,'2022-05-20 20:17:55','2022-05-20 20:17:55');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
