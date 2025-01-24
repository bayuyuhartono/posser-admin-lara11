# ************************************************************
# Sequel Ace SQL dump
# Version 20080
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Database: adminlara11
# Generation Time: 2025-01-22 20:05:16 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cache
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table cache_locks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table job_batches
# ------------------------------------------------------------

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table master_genre
# ------------------------------------------------------------

DROP TABLE IF EXISTS `master_genre`;

CREATE TABLE `master_genre` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `master_genre` WRITE;
/*!40000 ALTER TABLE `master_genre` DISABLE KEYS */;

INSERT INTO `master_genre` (`id`, `uuid`, `name`, `created_at`)
VALUES
	(1,'3fb501b3-9b30-4d5d-b1fe-8d8ce785d21e','Metal','2025-01-23 02:54:59'),
	(2,'91d933d6-124f-4990-8c32-59a038adab53','Death Metal','2025-01-23 02:55:37'),
	(3,'3efdf8c8-8496-4395-8660-6f67aa3c6738','Hardcore','2025-01-23 02:56:19');

/*!40000 ALTER TABLE `master_genre` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'0001_01_01_000000_create_users_table',1),
	(2,'0001_01_01_000001_create_cache_table',1),
	(3,'0001_01_01_000002_create_jobs_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_reset_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table rbac_access_name
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rbac_access_name`;

CREATE TABLE `rbac_access_name` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `rbac_access_name` WRITE;
/*!40000 ALTER TABLE `rbac_access_name` DISABLE KEYS */;

INSERT INTO `rbac_access_name` (`id`, `name`)
VALUES
	(1,'index'),
	(2,'show'),
	(3,'add'),
	(4,'edit'),
	(5,'delete');

/*!40000 ALTER TABLE `rbac_access_name` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rbac_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rbac_menu`;

CREATE TABLE `rbac_menu` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `url` longtext DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `parent_id` int(6) DEFAULT NULL,
  `icon` varchar(100) NOT NULL DEFAULT '<i class="far fa-circle nav-icon"></i>',
  `order` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `rbac_menu` WRITE;
/*!40000 ALTER TABLE `rbac_menu` DISABLE KEYS */;

INSERT INTO `rbac_menu` (`id`, `title`, `slug`, `url`, `module`, `parent_id`, `icon`, `order`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'Dashboard','dashboard','dashboard','dashboard',NULL,'<i class=\"nav-icon fas fa-tachometer-alt\"></i>',1,1,'2023-12-02 22:30:44','2023-12-02 13:15:09'),
	(2,'User Management','usermanagement','usermanagement','usermanagement',NULL,'<i class=\"nav-icon fas fa-users\"></i>',23,1,'2025-01-23 02:14:16','2023-12-02 13:17:16'),
	(3,'Account','account','usermanagement/account','usermanagement',2,'<i class=\"far fa-circle nav-icon\"></i>',1,1,'2025-01-23 02:14:20','2023-12-02 13:18:21'),
	(4,'Role','role','usermanagement/role','usermanagement',2,'<i class=\"far fa-circle nav-icon\"></i>',2,1,'2023-12-04 11:37:51','2023-12-02 21:38:23'),
	(5,'Menu','menu','usermanagement/menu','usermanagement',2,'<i class=\"far fa-circle nav-icon\"></i>',3,1,'2023-12-03 01:50:54','2023-12-03 01:50:54'),
	(26,'Master Data','masterdata','masterdata','masterdata',NULL,'<i class=\"far fa-circle nav-icon\"></i>',13,1,'2025-01-22 19:47:51','2025-01-22 19:47:51'),
	(27,'Genre','genre','masterdata/genre','masterdata',26,'<i class=\"far fa-circle nav-icon\"></i>',1,1,'2025-01-22 19:48:48','2025-01-22 19:48:48');

/*!40000 ALTER TABLE `rbac_menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rbac_permission
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rbac_permission`;

CREATE TABLE `rbac_permission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(50) DEFAULT NULL,
  `access` varchar(50) DEFAULT NULL,
  `status` tinyint(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `rbac_permission` WRITE;
/*!40000 ALTER TABLE `rbac_permission` DISABLE KEYS */;

INSERT INTO `rbac_permission` (`id`, `slug`, `access`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'dashboard','show',1,'2023-12-02 22:48:36','2023-12-02 22:48:36'),
	(2,'account','show',1,'2023-12-02 22:52:05','2023-12-02 22:52:05'),
	(3,'account','add',1,'2023-12-02 22:52:35','2023-12-02 22:52:35'),
	(4,'account','edit',1,'2023-12-02 22:53:22','2023-12-02 22:53:22'),
	(5,'account','delete',1,'2023-12-02 22:53:32','2023-12-02 22:53:32'),
	(6,'dashboard','index',1,'2023-12-03 00:13:38','2023-12-03 00:13:38'),
	(7,'usermanagement','index',1,'2023-12-03 00:13:46','2023-12-03 00:13:46'),
	(8,'role','show',1,'2023-12-03 01:39:09','2023-12-03 01:39:09'),
	(9,'role','add',1,'2023-12-03 01:39:20','2023-12-03 01:39:20'),
	(10,'role','edit',1,'2023-12-03 01:39:30','2023-12-03 01:39:30'),
	(11,'role','delete',1,'2023-12-03 01:39:41','2023-12-03 01:39:41'),
	(12,'menu','show',1,'2023-12-03 01:39:51','2023-12-03 01:39:51'),
	(13,'menu','add',1,'2023-12-03 01:41:55','2023-12-03 01:41:55'),
	(14,'menu','edit',1,'2023-12-03 01:42:08','2023-12-03 01:42:08'),
	(15,'menu','delete',1,'2023-12-03 01:42:15','2023-12-03 01:42:15'),
	(56,'masterdata','index',1,'2025-01-23 02:47:51','2025-01-23 02:47:51'),
	(57,'genre','show',1,'2025-01-23 02:48:48','2025-01-23 02:48:48'),
	(58,'genre','add',1,'2025-01-23 02:48:48','2025-01-23 02:48:48'),
	(59,'genre','edit',1,'2025-01-23 02:48:48','2025-01-23 02:48:48'),
	(60,'genre','delete',1,'2025-01-23 02:48:48','2025-01-23 02:48:48');

/*!40000 ALTER TABLE `rbac_permission` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rbac_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rbac_role`;

CREATE TABLE `rbac_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(300) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `rbac_role` WRITE;
/*!40000 ALTER TABLE `rbac_role` DISABLE KEYS */;

INSERT INTO `rbac_role` (`id`, `uuid`, `title`, `slug`, `description`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'2f92bb7f-e5f7-4477-a901-c3a79baa088b','Super User','super-user',NULL,1,'2023-12-02 22:06:58','2023-12-02 22:06:58'),
	(2,'74610f99-13ba-43ec-91f2-e6d986bc9d65','Chief','chief',NULL,1,'2023-12-02 22:07:29','2023-12-02 22:07:29');

/*!40000 ALTER TABLE `rbac_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rbac_role_permission
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rbac_role_permission`;

CREATE TABLE `rbac_role_permission` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `rbac_role_permission` WRITE;
/*!40000 ALTER TABLE `rbac_role_permission` DISABLE KEYS */;

INSERT INTO `rbac_role_permission` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'2023-12-02 22:54:04','2023-12-02 22:54:04'),
	(2,1,2,'2023-12-02 22:54:09','2023-12-02 22:54:09'),
	(3,1,3,'2023-12-02 22:54:16','2023-12-02 22:54:16'),
	(4,1,4,'2023-12-02 22:54:21','2023-12-02 22:54:21'),
	(5,1,5,'2023-12-02 22:54:42','2023-12-02 22:54:42'),
	(7,1,6,'2023-12-03 00:17:02','2023-12-03 00:17:02'),
	(8,1,7,'2023-12-03 00:17:09','2023-12-03 00:17:09'),
	(10,1,8,'2023-12-03 01:48:02','2023-12-03 01:48:02'),
	(11,1,9,'2023-12-03 01:48:08','2023-12-03 01:48:08'),
	(12,1,10,'2023-12-03 01:48:14','2023-12-03 01:48:14'),
	(13,1,11,'2023-12-03 01:48:20','2023-12-03 01:48:20'),
	(14,1,12,'2023-12-03 01:48:26','2023-12-03 01:48:26'),
	(15,1,13,'2023-12-03 01:48:35','2023-12-03 01:48:35'),
	(16,1,14,'2023-12-03 01:48:39','2023-12-03 01:48:39'),
	(17,1,15,'2023-12-03 01:48:50','2023-12-03 01:48:50'),
	(64,2,6,'2023-12-05 23:38:03','2023-12-05 23:38:03'),
	(65,2,1,'2023-12-05 23:38:03','2023-12-05 23:38:03');

/*!40000 ALTER TABLE `rbac_role_permission` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`)
VALUES
	('oC1htOzNPhYOcY2uU2ijPOBMIaU87NNYmnzd94Cq',1,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiUERDSUJCM1ZvZXdycEp2Z1FQVmtMU24zMkF6eGdDNWMwTVlPdmlJaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9tYXN0ZXJkYXRhL2dlbnJlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJyb2xlX2luZm9fc2Vzc2lvbiI7Tzo4OiJzdGRDbGFzcyI6Mzp7czo5OiJyb2xlX3V1aWQiO3M6MzY6IjJmOTJiYjdmLWU1ZjctNDQ3Ny1hOTAxLWMzYTc5YmFhMDg4YiI7czo1OiJ0aXRsZSI7czoxMDoiU3VwZXIgVXNlciI7czo3OiJyb2xlX2lkIjtpOjE7fXM6MTg6InJvbGVhY2Nlc3Nfc2Vzc2lvbiI7YToxNzp7aTowO3M6MTI6ImFjY291bnQgc2hvdyI7aToxO3M6MTE6ImFjY291bnQgYWRkIjtpOjI7czoxMjoiYWNjb3VudCBlZGl0IjtpOjM7czoxNDoiYWNjb3VudCBkZWxldGUiO2k6NDtzOjE0OiJkYXNoYm9hcmQgc2hvdyI7aTo1O3M6MTA6ImdlbnJlIGVkaXQiO2k6NjtzOjk6ImdlbnJlIGFkZCI7aTo3O3M6MTA6ImdlbnJlIHNob3ciO2k6ODtzOjEyOiJnZW5yZSBkZWxldGUiO2k6OTtzOjk6Im1lbnUgc2hvdyI7aToxMDtzOjg6Im1lbnUgYWRkIjtpOjExO3M6OToibWVudSBlZGl0IjtpOjEyO3M6MTE6Im1lbnUgZGVsZXRlIjtpOjEzO3M6OToicm9sZSBlZGl0IjtpOjE0O3M6ODoicm9sZSBhZGQiO2k6MTU7czo5OiJyb2xlIHNob3ciO2k6MTY7czoxMToicm9sZSBkZWxldGUiO31zOjEyOiJtZW51X3Nlc3Npb24iO086Mjk6IklsbHVtaW5hdGVcU3VwcG9ydFxDb2xsZWN0aW9uIjoyOntzOjg6IgAqAGl0ZW1zIjthOjM6e2k6MDtPOjg6InN0ZENsYXNzIjo0OntzOjI6ImlkIjtpOjE7czo1OiJ0aXRsZSI7czo5OiJEYXNoYm9hcmQiO3M6MzoidXJsIjtzOjk6ImRhc2hib2FyZCI7czo0OiJpY29uIjtzOjQ2OiI8aSBjbGFzcz0ibmF2LWljb24gZmFzIGZhLXRhY2hvbWV0ZXItYWx0Ij48L2k+Ijt9aToxO086ODoic3RkQ2xhc3MiOjU6e3M6MjoiaWQiO2k6MjY7czo1OiJ0aXRsZSI7czoxMToiTWFzdGVyIERhdGEiO3M6MzoidXJsIjtzOjEwOiJtYXN0ZXJkYXRhIjtzOjQ6Imljb24iO3M6Mzg6IjxpIGNsYXNzPSJmYXIgZmEtY2lyY2xlIG5hdi1pY29uIj48L2k+IjtzOjU6ImNoaWxkIjtPOjI5OiJJbGx1bWluYXRlXFN1cHBvcnRcQ29sbGVjdGlvbiI6Mjp7czo4OiIAKgBpdGVtcyI7YToxOntpOjA7Tzo4OiJzdGRDbGFzcyI6NDp7czoyOiJpZCI7aToyNztzOjU6InRpdGxlIjtzOjU6IkdlbnJlIjtzOjM6InVybCI7czoxNjoibWFzdGVyZGF0YS9nZW5yZSI7czo0OiJpY29uIjtzOjM4OiI8aSBjbGFzcz0iZmFyIGZhLWNpcmNsZSBuYXYtaWNvbiI+PC9pPiI7fX1zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fX1pOjI7Tzo4OiJzdGRDbGFzcyI6NTp7czoyOiJpZCI7aToyO3M6NToidGl0bGUiO3M6MTU6IlVzZXIgTWFuYWdlbWVudCI7czozOiJ1cmwiO3M6MTQ6InVzZXJtYW5hZ2VtZW50IjtzOjQ6Imljb24iO3M6Mzc6IjxpIGNsYXNzPSJuYXYtaWNvbiBmYXMgZmEtdXNlcnMiPjwvaT4iO3M6NToiY2hpbGQiO086Mjk6IklsbHVtaW5hdGVcU3VwcG9ydFxDb2xsZWN0aW9uIjoyOntzOjg6IgAqAGl0ZW1zIjthOjM6e2k6MDtPOjg6InN0ZENsYXNzIjo0OntzOjI6ImlkIjtpOjM7czo1OiJ0aXRsZSI7czo3OiJBY2NvdW50IjtzOjM6InVybCI7czoyMjoidXNlcm1hbmFnZW1lbnQvYWNjb3VudCI7czo0OiJpY29uIjtzOjM4OiI8aSBjbGFzcz0iZmFyIGZhLWNpcmNsZSBuYXYtaWNvbiI+PC9pPiI7fWk6MTtPOjg6InN0ZENsYXNzIjo0OntzOjI6ImlkIjtpOjQ7czo1OiJ0aXRsZSI7czo0OiJSb2xlIjtzOjM6InVybCI7czoxOToidXNlcm1hbmFnZW1lbnQvcm9sZSI7czo0OiJpY29uIjtzOjM4OiI8aSBjbGFzcz0iZmFyIGZhLWNpcmNsZSBuYXYtaWNvbiI+PC9pPiI7fWk6MjtPOjg6InN0ZENsYXNzIjo0OntzOjI6ImlkIjtpOjU7czo1OiJ0aXRsZSI7czo0OiJNZW51IjtzOjM6InVybCI7czoxOToidXNlcm1hbmFnZW1lbnQvbWVudSI7czo0OiJpY29uIjtzOjM4OiI8aSBjbGFzcz0iZmFyIGZhLWNpcmNsZSBuYXYtaWNvbiI+PC9pPiI7fX1zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fX19czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO319',1737576244);

/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `role_uuid` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `uuid`, `role_uuid`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'7314385f-6bf7-4505-9e3e-fcdfdb087cb0','2f92bb7f-e5f7-4477-a901-c3a79baa088b','super user','super@gmail.com',NULL,'$2y$12$v3JJ8f3X1dLdCm.T9/8xn.VeFERKmybiOtxCXHJ9UkVC0gY/XYtC.',NULL,'2025-01-22 18:32:40','2025-01-22 18:32:40');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
