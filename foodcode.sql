-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: localhost    Database: lv_foodcode
-- ------------------------------------------------------
-- Server version	8.0.28-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci GENERATED ALWAYS AS (concat(`first_name`,_utf8mb4' ',`last_name`)) VIRTUAL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `avatar`, `password`, `deleted_at`, `created_at`, `updated_at`) VALUES (1,'developer','develop','admin@foodcode.com','default.png','$2y$10$9yieXdPYWqgda8bU.4321umzp5FezGNUeMHtQxpkR4X5voDjwbQXy',NULL,'2022-02-15 12:37:14','2022-02-15 12:37:14'),(3,'ahmed','mahmoud','ahmed.mahmoud.marketing@gmail.com','default.png','$2y$10$dU3PU.JtDrJtAUMoQZkNO.umxC74XjTXvTkJGR.RGXrpx0zAuNvWK',NULL,NULL,NULL),(4,'Mostafa','Hesham','mostafalotfy285@gmail.com','default.png','$2y$10$iIlDSibSkxeE3eC0RBiOFeMu4z.CLL56NpxtsowG9zIFj95kI4koS',NULL,NULL,NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banned`
--

DROP TABLE IF EXISTS `banned`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banned` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banned_user_id_foreign` (`user_id`),
  CONSTRAINT `banned_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banned`
--

LOCK TABLES `banned` WRITE;
/*!40000 ALTER TABLE `banned` DISABLE KEYS */;
/*!40000 ALTER TABLE `banned` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookamrk_videos`
--

DROP TABLE IF EXISTS `bookamrk_videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookamrk_videos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `short_video_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookamrk_videos_user_id_foreign` (`user_id`),
  KEY `bookamrk_videos_short_video_id_foreign` (`short_video_id`),
  CONSTRAINT `bookamrk_videos_short_video_id_foreign` FOREIGN KEY (`short_video_id`) REFERENCES `short_videos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookamrk_videos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookamrk_videos`
--

LOCK TABLES `bookamrk_videos` WRITE;
/*!40000 ALTER TABLE `bookamrk_videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookamrk_videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'category.png',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_created_by_foreign` (`created_by`),
  KEY `categories_updated_by_foreign` (`updated_by`),
  CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'BBQ','مشويات','6211f81f27908WhatsApp Image 2022-02-15 at 2.10.53 PM.jpeg',1,1,NULL,NULL,NULL,NULL),(2,'Main Dishes','الاطباق الرئيسية','6211f85e70e75WhatsApp Image 2022-02-15 at 2.10.50 PM (1).jpeg',1,1,NULL,NULL,NULL,NULL),(3,'Spices','بهارات','6211f8853774dWhatsApp Image 2022-02-15 at 2.10.51 PM (1).jpeg',1,1,NULL,NULL,NULL,NULL),(4,'Seafood','اكل بحري','6211f89d524f4WhatsApp Image 2022-02-15 at 2.10.51 PM.jpeg',1,1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comics`
--

DROP TABLE IF EXISTS `comics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint unsigned NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comics_user_id_foreign` (`user_id`),
  KEY `comics_category_id_foreign` (`category_id`),
  CONSTRAINT `comics_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comics_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comics`
--

LOCK TABLES `comics` WRITE;
/*!40000 ALTER TABLE `comics` DISABLE KEYS */;
INSERT INTO `comics` VALUES (1,2,2,'title',0,'description',NULL,'2022-02-15 12:37:57','2022-02-16 07:31:21'),(2,2,1,'title',0,'description',NULL,'2022-02-15 12:38:40',NULL),(3,2,1,'title',0,'description',NULL,'2022-02-16 05:45:59',NULL),(4,2,1,'title',0,'description',NULL,'2022-02-16 05:48:03',NULL),(5,2,1,'title',0,'description',NULL,'2022-02-16 06:50:10',NULL);
/*!40000 ALTER TABLE `comics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comics_album`
--

DROP TABLE IF EXISTS `comics_album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comics_album` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comic_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comics_album_comic_id_foreign` (`comic_id`),
  KEY `comics_album_user_id_foreign` (`user_id`),
  CONSTRAINT `comics_album_comic_id_foreign` FOREIGN KEY (`comic_id`) REFERENCES `comics` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comics_album_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comics_album`
--

LOCK TABLES `comics_album` WRITE;
/*!40000 ALTER TABLE `comics_album` DISABLE KEYS */;
INSERT INTO `comics_album` VALUES (1,'620bbac78b578','application/octet-stream',1,2,'2022-02-15 12:37:59',NULL),(2,'620bbaf30d1e9','application/octet-stream',1,2,'2022-02-15 12:38:43',NULL),(3,'620cabbb7971bmp4','video/mp4',1,2,'2022-02-16 05:46:03',NULL),(4,'620cac369eb0djpg','image/jpeg',1,2,'2022-02-16 05:48:06',NULL),(5,'620cbac51b1f1jpg','image/jpeg',1,2,'2022-02-16 06:50:13',NULL);
/*!40000 ALTER TABLE `comics_album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment_replies`
--

DROP TABLE IF EXISTS `comment_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment_replies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `comment_id` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_replies_user_id_foreign` (`user_id`),
  KEY `comment_replies_comment_id_foreign` (`comment_id`),
  CONSTRAINT `comment_replies_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comment_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment_replies`
--

LOCK TABLES `comment_replies` WRITE;
/*!40000 ALTER TABLE `comment_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_type_user_id_index` (`user_type`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expriments`
--

DROP TABLE IF EXISTS `expriments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expriments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expriments_user_id_foreign` (`user_id`),
  CONSTRAINT `expriments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expriments`
--

LOCK TABLES `expriments` WRITE;
/*!40000 ALTER TABLE `expriments` DISABLE KEYS */;
/*!40000 ALTER TABLE `expriments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
INSERT INTO `failed_jobs` VALUES (1,'3d686103-77c5-4e5c-8cd9-da28e73c93eb','database','default','{\"uuid\":\"3d686103-77c5-4e5c-8cd9-da28e73c93eb\",\"displayName\":\"App\\\\Jobs\\\\PublishVideoToFacebook\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\PublishVideoToFacebook\",\"command\":\"O:31:\\\"App\\\\Jobs\\\\PublishVideoToFacebook\\\":15:{s:38:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000group\\\";N;s:41:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000metadata\\\";a:2:{s:5:\\\"title\\\";s:5:\\\"title\\\";s:11:\\\"description\\\";N;}s:35:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000id\\\";s:15:\\\"278561817144387\\\";s:37:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000path\\\";s:51:\\\"\\/home\\/mostafa\\/foodcode\\/public\\/storage\\/620bbac78b578\\\";s:38:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000token\\\";s:207:\\\"EAAWR0tDd8jgBAJyly28uWLyHy6uJKP3HuWtpFcYarWYO9Wq58ThdZBSjFPof54QGI7Sjkbq1ktDOJ0ZB082HtuglV9LvTAe1IvLgpTfqQ5XThtlGEucr3DGwBNzRyO3T61CMKMv46zUB5TgnKxRbchjeDyQJ9WQryuS9Vr34IOr2grrEQanWc2VF3DvPfPwZBfAiZA7HbwZDZD\\\";s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}','Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\PublishVideoToFacebook has been attempted too many times or run too long. The job may have previously timed out. in /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:750\nStack trace:\n#0 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(213): Illuminate\\Queue\\Worker->maxAttemptsExceededException()\n#1 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/HttpClients/FacebookCurl.php(77): Illuminate\\Queue\\Worker->Illuminate\\Queue\\{closure}()\n#2 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/HttpClients/FacebookCurlHttpClient.php(129): Facebook\\HttpClients\\FacebookCurl->exec()\n#3 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/HttpClients/FacebookCurlHttpClient.php(70): Facebook\\HttpClients\\FacebookCurlHttpClient->sendRequest()\n#4 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/FacebookClient.php(216): Facebook\\HttpClients\\FacebookCurlHttpClient->send()\n#5 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/FileUpload/FacebookResumableUploader.php(175): Facebook\\FacebookClient->sendRequest()\n#6 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/FileUpload/FacebookResumableUploader.php(117): Facebook\\FileUpload\\FacebookResumableUploader->sendUploadRequest()\n#7 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/Facebook.php(624): Facebook\\FileUpload\\FacebookResumableUploader->transfer()\n#8 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/Facebook.php(601): Facebook\\Facebook->maxTriesTransfer()\n#9 /home/mostafa/foodcode/Providers/Facebook/Group.php(13): Facebook\\Facebook->uploadVideo()\n#10 /home/mostafa/foodcode/app/Jobs/PublishVideoToFacebook.php(47): Providers\\Facebook\\Group->addVideo()\n#11 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\PublishVideoToFacebook->handle()\n#12 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/Container.php(653): Illuminate\\Container\\BoundMethod::call()\n#16 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#17 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#18 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#19 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#20 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#21 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#22 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#24 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#25 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#26 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(378): Illuminate\\Queue\\Worker->process()\n#28 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(172): Illuminate\\Queue\\Worker->runJob()\n#29 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon()\n#30 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#31 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#34 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#35 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/Container.php(653): Illuminate\\Container\\BoundMethod::call()\n#36 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call()\n#37 /home/mostafa/foodcode/vendor/symfony/console/Command/Command.php(298): Illuminate\\Console\\Command->execute()\n#38 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#39 /home/mostafa/foodcode/vendor/symfony/console/Application.php(1015): Illuminate\\Console\\Command->run()\n#40 /home/mostafa/foodcode/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#41 /home/mostafa/foodcode/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#42 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Console/Application.php(94): Symfony\\Component\\Console\\Application->run()\n#43 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#44 /home/mostafa/foodcode/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 {main}','2022-02-15 12:43:28'),(2,'4b49df69-72b1-44aa-8f37-305e255cf216','database','default','{\"uuid\":\"4b49df69-72b1-44aa-8f37-305e255cf216\",\"displayName\":\"App\\\\Jobs\\\\PublishVideoToFacebook\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\PublishVideoToFacebook\",\"command\":\"O:31:\\\"App\\\\Jobs\\\\PublishVideoToFacebook\\\":15:{s:38:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000group\\\";N;s:41:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000metadata\\\";a:2:{s:5:\\\"title\\\";s:5:\\\"title\\\";s:11:\\\"description\\\";N;}s:35:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000id\\\";s:15:\\\"278561817144387\\\";s:37:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000path\\\";s:51:\\\"\\/home\\/mostafa\\/foodcode\\/public\\/storage\\/620bbaf30d1e9\\\";s:38:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000token\\\";s:207:\\\"EAAWR0tDd8jgBAJyly28uWLyHy6uJKP3HuWtpFcYarWYO9Wq58ThdZBSjFPof54QGI7Sjkbq1ktDOJ0ZB082HtuglV9LvTAe1IvLgpTfqQ5XThtlGEucr3DGwBNzRyO3T61CMKMv46zUB5TgnKxRbchjeDyQJ9WQryuS9Vr34IOr2grrEQanWc2VF3DvPfPwZBfAiZA7HbwZDZD\\\";s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}','Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\PublishVideoToFacebook has been attempted too many times or run too long. The job may have previously timed out. in /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:750\nStack trace:\n#0 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(504): Illuminate\\Queue\\Worker->maxAttemptsExceededException()\n#1 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(418): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts()\n#2 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(378): Illuminate\\Queue\\Worker->process()\n#3 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(172): Illuminate\\Queue\\Worker->runJob()\n#4 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon()\n#5 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#6 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#8 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#9 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#10 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/Container.php(653): Illuminate\\Container\\BoundMethod::call()\n#11 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call()\n#12 /home/mostafa/foodcode/vendor/symfony/console/Command/Command.php(298): Illuminate\\Console\\Command->execute()\n#13 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#14 /home/mostafa/foodcode/vendor/symfony/console/Application.php(1015): Illuminate\\Console\\Command->run()\n#15 /home/mostafa/foodcode/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#16 /home/mostafa/foodcode/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#17 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Console/Application.php(94): Symfony\\Component\\Console\\Application->run()\n#18 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#19 /home/mostafa/foodcode/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#20 {main}','2022-02-16 05:43:55'),(3,'35925af8-e0ab-4381-8cd4-84d9e71b5a28','database','default','{\"uuid\":\"35925af8-e0ab-4381-8cd4-84d9e71b5a28\",\"displayName\":\"App\\\\Jobs\\\\PublishVideoToFacebook\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\PublishVideoToFacebook\",\"command\":\"O:31:\\\"App\\\\Jobs\\\\PublishVideoToFacebook\\\":15:{s:38:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000group\\\";N;s:41:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000metadata\\\";a:2:{s:5:\\\"title\\\";s:5:\\\"title\\\";s:11:\\\"description\\\";N;}s:35:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000id\\\";s:15:\\\"278561817144387\\\";s:37:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000path\\\";s:54:\\\"\\/home\\/mostafa\\/foodcode\\/public\\/storage\\/620cabbb7971bmp4\\\";s:38:\\\"\\u0000App\\\\Jobs\\\\PublishVideoToFacebook\\u0000token\\\";s:209:\\\"EAAWR0tDd8jgBALyrcQbke6zPsV6BZCXhKZCHJqp5WHuRdqRHmfce5ix9RowFXZB4vpc5FHHkZAueAFPD4RBFsbqoxj1J4DtWqXtwgFpinc1SzSA3NLfzQJavAbySGXpbtMdKNZBegtHwPj4TiOMFT5CH7ox0nyCEIZAIIwNe9fGXSb6hyIIxkHTJXpNAfMCEJr3Gr0dvECBwZDZD\\\";s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}','Illuminate\\Queue\\MaxAttemptsExceededException: App\\Jobs\\PublishVideoToFacebook has been attempted too many times or run too long. The job may have previously timed out. in /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:750\nStack trace:\n#0 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(213): Illuminate\\Queue\\Worker->maxAttemptsExceededException()\n#1 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/HttpClients/FacebookCurl.php(77): Illuminate\\Queue\\Worker->Illuminate\\Queue\\{closure}()\n#2 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/HttpClients/FacebookCurlHttpClient.php(129): Facebook\\HttpClients\\FacebookCurl->exec()\n#3 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/HttpClients/FacebookCurlHttpClient.php(70): Facebook\\HttpClients\\FacebookCurlHttpClient->sendRequest()\n#4 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/FacebookClient.php(216): Facebook\\HttpClients\\FacebookCurlHttpClient->send()\n#5 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/FileUpload/FacebookResumableUploader.php(175): Facebook\\FacebookClient->sendRequest()\n#6 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/FileUpload/FacebookResumableUploader.php(117): Facebook\\FileUpload\\FacebookResumableUploader->sendUploadRequest()\n#7 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/Facebook.php(624): Facebook\\FileUpload\\FacebookResumableUploader->transfer()\n#8 /home/mostafa/foodcode/vendor/facebook/graph-sdk/src/Facebook/Facebook.php(601): Facebook\\Facebook->maxTriesTransfer()\n#9 /home/mostafa/foodcode/Providers/Facebook/Group.php(13): Facebook\\Facebook->uploadVideo()\n#10 /home/mostafa/foodcode/app/Jobs/PublishVideoToFacebook.php(47): Providers\\Facebook\\Group->addVideo()\n#11 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\PublishVideoToFacebook->handle()\n#12 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#13 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#14 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#15 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/Container.php(653): Illuminate\\Container\\BoundMethod::call()\n#16 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call()\n#17 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}()\n#18 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#19 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then()\n#20 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow()\n#21 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}()\n#22 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}()\n#23 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then()\n#24 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware()\n#25 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call()\n#26 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#27 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(378): Illuminate\\Queue\\Worker->process()\n#28 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(172): Illuminate\\Queue\\Worker->runJob()\n#29 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon()\n#30 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker()\n#31 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#32 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#33 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure()\n#34 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod()\n#35 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Container/Container.php(653): Illuminate\\Container\\BoundMethod::call()\n#36 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call()\n#37 /home/mostafa/foodcode/vendor/symfony/console/Command/Command.php(298): Illuminate\\Console\\Command->execute()\n#38 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run()\n#39 /home/mostafa/foodcode/vendor/symfony/console/Application.php(1015): Illuminate\\Console\\Command->run()\n#40 /home/mostafa/foodcode/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand()\n#41 /home/mostafa/foodcode/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun()\n#42 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Console/Application.php(94): Symfony\\Component\\Console\\Application->run()\n#43 /home/mostafa/foodcode/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run()\n#44 /home/mostafa/foodcode/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle()\n#45 {main}','2022-02-16 05:47:47');
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `followers`
--

DROP TABLE IF EXISTS `followers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `followers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `followers_user_id_foreign` (`user_id`),
  CONSTRAINT `followers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `followers`
--

LOCK TABLES `followers` WRITE;
/*!40000 ALTER TABLE `followers` DISABLE KEYS */;
/*!40000 ALTER TABLE `followers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `following`
--

DROP TABLE IF EXISTS `following`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `following` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `following_user_id_foreign` (`user_id`),
  CONSTRAINT `following_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `following`
--

LOCK TABLES `following` WRITE;
/*!40000 ALTER TABLE `following` DISABLE KEYS */;
/*!40000 ALTER TABLE `following` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hashtags`
--

DROP TABLE IF EXISTS `hashtags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hashtags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hashtags_user_id_foreign` (`user_id`),
  CONSTRAINT `hashtags_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hashtags`
--

LOCK TABLES `hashtags` WRITE;
/*!40000 ALTER TABLE `hashtags` DISABLE KEYS */;
INSERT INTO `hashtags` VALUES (1,'#hashtag',1,NULL,'2022-02-15 12:37:15','2022-02-15 12:37:15'),(2,'#hashtag',2,NULL,'2022-02-15 12:37:59',NULL),(3,'#hashtag',2,NULL,'2022-02-15 12:37:59',NULL),(4,'#hashtag',2,NULL,'2022-02-15 12:38:43',NULL),(5,'#hashtag',2,NULL,'2022-02-15 12:38:43',NULL),(6,'#hashtag',2,NULL,'2022-02-16 05:46:03',NULL),(7,'#hashtag',2,NULL,'2022-02-16 05:46:03',NULL),(8,'#hashtag',2,NULL,'2022-02-16 05:48:06',NULL),(9,'#hashtag',2,NULL,'2022-02-16 05:48:06',NULL),(10,'#hashtag',2,NULL,'2022-02-16 06:50:13',NULL),(11,'#hashtag',2,NULL,'2022-02-16 06:50:13',NULL);
/*!40000 ALTER TABLE `hashtags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `recipe_id` bigint unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ingredients_recipe_id_foreign` (`recipe_id`),
  CONSTRAINT `ingredients_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (5,'default','{\"uuid\":\"e1f0a870-b088-44fd-98c6-9c6eaa9be367\",\"displayName\":\"App\\\\Jobs\\\\PublishImageToFacebook\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\PublishImageToFacebook\",\"command\":\"O:31:\\\"App\\\\Jobs\\\\PublishImageToFacebook\\\":17:{s:38:\\\"\\u0000App\\\\Jobs\\\\PublishImageToFacebook\\u0000group\\\";N;s:38:\\\"\\u0000App\\\\Jobs\\\\PublishImageToFacebook\\u0000token\\\";s:209:\\\"EAAWR0tDd8jgBALyrcQbke6zPsV6BZCXhKZCHJqp5WHuRdqRHmfce5ix9RowFXZB4vpc5FHHkZAueAFPD4RBFsbqoxj1J4DtWqXtwgFpinc1SzSA3NLfzQJavAbySGXpbtMdKNZBegtHwPj4TiOMFT5CH7ox0nyCEIZAIIwNe9fGXSb6hyIIxkHTJXpNAfMCEJr3Gr0dvECBwZDZD\\\";s:38:\\\"\\u0000App\\\\Jobs\\\\PublishImageToFacebook\\u0000album\\\";N;s:41:\\\"\\u0000App\\\\Jobs\\\\PublishImageToFacebook\\u0000provider\\\";N;s:39:\\\"\\u0000App\\\\Jobs\\\\PublishImageToFacebook\\u0000helper\\\";N;s:35:\\\"\\u0000App\\\\Jobs\\\\PublishImageToFacebook\\u0000id\\\";i:647923316324104;s:37:\\\"\\u0000App\\\\Jobs\\\\PublishImageToFacebook\\u0000path\\\";s:24:\\\"storage\\/620cbac51b1f1jpg\\\";s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}',0,NULL,1645001413,1645001413);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `postable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postable_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `likes_user_id_foreign` (`user_id`),
  KEY `likes_postable_type_postable_id_index` (`postable_type`,`postable_id`),
  CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_02_08_071304_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_01_10_122438_create_comments_table',1),(6,'2022_01_26_104903_create_jobs_table',1),(7,'2022_01_30_201712_create_admins_table',1),(8,'2022_01_30_205034_create_categories_table',1),(9,'2022_01_30_205245_create_short_videos_table',1),(10,'2022_01_30_210721_create_bookamrk_videos_table',1),(11,'2022_01_31_124229_create_waiting_list',1),(12,'2022_01_31_133703_create_likes_table',1),(13,'2022_01_31_133811_create_hashtag_table',1),(14,'2022_01_31_135715_create_banned_table',1),(15,'2022_01_31_140119_create_followers_table',1),(16,'2022_01_31_140306_create_following_table',1),(17,'2022_02_01_093824_create_recipes_table',1),(18,'2022_02_01_111246_create_comics_table',1),(19,'2022_02_01_111443_create_ingredients_table',1),(20,'2022_02_01_111512_create_steps_table',1),(21,'2022_02_01_111953_create_expriments_table',1),(22,'2022_02_01_132927_create_notifications_table',1),(23,'2022_02_03_134401_create_settings_table',1),(24,'2022_02_06_132203_create_comics_album_table',1),(25,'2022_02_06_132945_create_recipes_album_table',1),(26,'2022_02_08_065917_create_replies_table',1),(27,'2022_02_11_164504_create_permission_tables',1),(28,'2022_02_14_145435_create_recipe_hashtag_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\Admin',1),(5,'App\\Models\\Admin',3),(4,'App\\Models\\Admin',4);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view-role','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(2,'add-role','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(3,'delete-role','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(4,'update-role','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(5,'view-admin','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(6,'add-admin','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(7,'delete-admin','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(8,'update-admin','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(9,'view-notification','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(10,'add-notification','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(11,'delete-notification','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(12,'update-notification','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(13,'view-logs','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(14,'add-logs','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(15,'delete-logs','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(16,'update-logs','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(17,'view-city','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(18,'add-city','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(19,'delete-city','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(20,'update-city','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(21,'view-govern','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(22,'add-govern','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(23,'delete-govern','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(24,'update-govern','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(25,'view-admins','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(26,'add-admins','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(27,'delete-admins','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(28,'update-admins','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(29,'view-clients','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(30,'add-clients','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(31,'delete-clients','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(32,'update-clients','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(33,'view-roles','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(34,'add-roles','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(35,'delete-roles','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(36,'update-roles','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(37,'view-setting','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(38,'add-setting','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(39,'delete-setting','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(40,'update-setting','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(41,'activate-admin','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(42,'deactivate-admin','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(43,'reset-password','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(44,'activate-notification','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(45,'deactivate-notification','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(46,'view-reports','admin','2022-02-16 07:53:03','2022-02-16 07:53:03');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',2,'Foodcode','790b6c641060a0e3e63fe3a834e8eac2fda75435018ba11d175b1890e36c6666','[\"*\"]','2022-02-15 12:38:40','2022-02-15 12:37:34','2022-02-15 12:38:40'),(2,'App\\Models\\User',2,'Foodcode','51bc2e428fe25856d8384f508a901cb1f5e9ff2befaa51eae12258f5ee1aee72','[\"*\"]','2022-02-16 06:50:10','2022-02-16 05:45:35','2022-02-16 06:50:10');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_hashtag`
--

DROP TABLE IF EXISTS `recipe_hashtag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe_hashtag` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `recipe_id` bigint unsigned NOT NULL,
  `hash_tag_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `recipe_hashtag_recipe_id_foreign` (`recipe_id`),
  KEY `recipe_hashtag_hash_tag_id_foreign` (`hash_tag_id`),
  CONSTRAINT `recipe_hashtag_hash_tag_id_foreign` FOREIGN KEY (`hash_tag_id`) REFERENCES `hashtags` (`id`) ON DELETE CASCADE,
  CONSTRAINT `recipe_hashtag_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_hashtag`
--

LOCK TABLES `recipe_hashtag` WRITE;
/*!40000 ALTER TABLE `recipe_hashtag` DISABLE KEYS */;
/*!40000 ALTER TABLE `recipe_hashtag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `hash_tag_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `people_count` bigint unsigned NOT NULL,
  `cooking_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint unsigned NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recipes_user_id_foreign` (`user_id`),
  KEY `recipes_hash_tag_id_foreign` (`hash_tag_id`),
  KEY `recipes_category_id_foreign` (`category_id`),
  KEY `recipes_created_by_foreign` (`created_by`),
  KEY `recipes_updated_by_foreign` (`updated_by`),
  CONSTRAINT `recipes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `recipes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  CONSTRAINT `recipes_hash_tag_id_foreign` FOREIGN KEY (`hash_tag_id`) REFERENCES `hashtags` (`id`) ON DELETE CASCADE,
  CONSTRAINT `recipes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  CONSTRAINT `recipes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES (2,'وصفة جديدة','وصفة يتم استخدامها بشكل متكرر في ايطاليا',NULL,1,1,5,'4:00',0,1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipes_album`
--

DROP TABLE IF EXISTS `recipes_album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipes_album` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipe_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recipes_album_recipe_id_foreign` (`recipe_id`),
  KEY `recipes_album_user_id_foreign` (`user_id`),
  CONSTRAINT `recipes_album_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `recipes_album_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes_album`
--

LOCK TABLES `recipes_album` WRITE;
/*!40000 ALTER TABLE `recipes_album` DISABLE KEYS */;
/*!40000 ALTER TABLE `recipes_album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(1,4),(2,4),(3,4),(4,4),(1,6),(2,6),(3,6),(4,6);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super-admin','admin','2022-02-16 07:53:03','2022-02-16 07:53:03'),(4,'role','admin',NULL,NULL),(5,'rolename','admin',NULL,NULL),(6,'new Role','admin',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `short_videos`
--

DROP TABLE IF EXISTS `short_videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `short_videos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_count` int unsigned NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `short_videos_user_id_foreign` (`user_id`),
  CONSTRAINT `short_videos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `short_videos`
--

LOCK TABLES `short_videos` WRITE;
/*!40000 ALTER TABLE `short_videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `short_videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `steps`
--

DROP TABLE IF EXISTS `steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `steps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `recipe_id` bigint unsigned NOT NULL,
  `step_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `steps_recipe_id_foreign` (`recipe_id`),
  CONSTRAINT `steps_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `steps`
--

LOCK TABLES `steps` WRITE;
/*!40000 ALTER TABLE `steps` DISABLE KEYS */;
/*!40000 ALTER TABLE `steps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `provider_id` bigint unsigned DEFAULT NULL,
  `provider_token` text COLLATE utf8mb4_unicode_ci,
  `provider_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'identity.png',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_channel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  KEY `users_provider_id_index` (`provider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'developer','01021408852','10000',NULL,'$2y$10$YYe7/mDwJDyJSA/MXPvVReVWb76.gNQM4darKkWYyD/0oWbCA8wfm','avatar.png',NULL,NULL,NULL,'identity.png',NULL,'0.0.0.0',NULL,NULL,NULL,NULL,NULL,'2022-02-15 12:37:14','2022-02-15 12:37:14'),(2,'ahmed',NULL,'1234','2022-02-16 05:45:35',NULL,'620cab9ea6a1d',337867188189964,'EAAWR0tDd8jgBALyrcQbke6zPsV6BZCXhKZCHJqp5WHuRdqRHmfce5ix9RowFXZB4vpc5FHHkZAueAFPD4RBFsbqoxj1J4DtWqXtwgFpinc1SzSA3NLfzQJavAbySGXpbtMdKNZBegtHwPj4TiOMFT5CH7ox0nyCEIZAIIwNe9fGXSb6hyIIxkHTJXpNAfMCEJr3Gr0dvECBwZDZD','facebook','identity.png',NULL,'127.0.0.1',NULL,NULL,NULL,NULL,NULL,'2022-02-15 12:37:34','2022-02-16 05:45:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `waiting_list`
--

DROP TABLE IF EXISTS `waiting_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `waiting_list` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `waiting_list_user_id_foreign` (`user_id`),
  CONSTRAINT `waiting_list_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `waiting_list`
--

LOCK TABLES `waiting_list` WRITE;
/*!40000 ALTER TABLE `waiting_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `waiting_list` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-20 10:31:36
