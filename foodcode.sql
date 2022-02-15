-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: localhost    Database: lv_foodcode
-- ------------------------------------------------------
-- Server version	8.0.28-0ubuntu0.20.04.3
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO,ANSI' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table "admins"
--

DROP TABLE IF EXISTS "admins";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "admins" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "first_name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "last_name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "full_name" varchar(255) COLLATE utf8mb4_unicode_ci GENERATED ALWAYS AS (concat(`first_name`,_utf8mb4' ',`last_name`)) VIRTUAL,
  "email" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "avatar" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  "password" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "deleted_at" timestamp NULL DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  UNIQUE KEY "admins_email_unique" ("email")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "admins"
--

LOCK TABLES "admins" WRITE;
/*!40000 ALTER TABLE "admins" DISABLE KEYS */;
INSERT INTO "admins" ("id", "first_name", "last_name", "email", "avatar", "password", "deleted_at", "created_at", "updated_at") VALUES (1,'developer','develop','admin@foodcode.com','default.png','$2y$10$X.jcJTtTRmtWqDqRbzsM9utEaft1K5rp07AH1jaXMv56rPdHigs5q',NULL,'2022-02-15 05:07:38','2022-02-15 05:07:38');
/*!40000 ALTER TABLE "admins" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "banned"
--

DROP TABLE IF EXISTS "banned";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "banned" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "user_id" bigint unsigned NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "banned_user_id_foreign" ("user_id"),
  CONSTRAINT "banned_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "banned"
--

LOCK TABLES "banned" WRITE;
/*!40000 ALTER TABLE "banned" DISABLE KEYS */;
/*!40000 ALTER TABLE "banned" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "bookamrk_videos"
--

DROP TABLE IF EXISTS "bookamrk_videos";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "bookamrk_videos" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "user_id" bigint unsigned NOT NULL,
  "short_video_id" bigint unsigned NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "bookamrk_videos_user_id_foreign" ("user_id"),
  KEY "bookamrk_videos_short_video_id_foreign" ("short_video_id"),
  CONSTRAINT "bookamrk_videos_short_video_id_foreign" FOREIGN KEY ("short_video_id") REFERENCES "short_videos" ("id") ON DELETE CASCADE,
  CONSTRAINT "bookamrk_videos_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "bookamrk_videos"
--

LOCK TABLES "bookamrk_videos" WRITE;
/*!40000 ALTER TABLE "bookamrk_videos" DISABLE KEYS */;
/*!40000 ALTER TABLE "bookamrk_videos" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "categories"
--

DROP TABLE IF EXISTS "categories";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "categories" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "name_en" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "name_ar" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "image" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'category.png',
  "created_by" bigint unsigned NOT NULL,
  "updated_by" bigint unsigned DEFAULT NULL,
  "parent_id" bigint unsigned DEFAULT NULL,
  "deleted_at" timestamp NULL DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "categories_created_by_foreign" ("created_by"),
  KEY "categories_updated_by_foreign" ("updated_by"),
  CONSTRAINT "categories_created_by_foreign" FOREIGN KEY ("created_by") REFERENCES "users" ("id") ON DELETE CASCADE,
  CONSTRAINT "categories_updated_by_foreign" FOREIGN KEY ("updated_by") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "categories"
--

LOCK TABLES "categories" WRITE;
/*!40000 ALTER TABLE "categories" DISABLE KEYS */;
INSERT INTO "categories" VALUES (5,'name in english','name in arabic','620b7b5bee15315557821-imag-des-gouttes-d-eau-sur-la-fenêtre-et-fond-de-ciel-bleu.jpg',1,1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE "categories" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "comics"
--

DROP TABLE IF EXISTS "comics";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "comics" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "user_id" bigint unsigned NOT NULL,
  "category_id" bigint unsigned NOT NULL,
  "title" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "is_active" tinyint unsigned NOT NULL,
  "description" longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  "deleted_at" timestamp NULL DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "comics_user_id_foreign" ("user_id"),
  KEY "comics_category_id_foreign" ("category_id"),
  CONSTRAINT "comics_category_id_foreign" FOREIGN KEY ("category_id") REFERENCES "categories" ("id") ON DELETE CASCADE,
  CONSTRAINT "comics_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "comics"
--

LOCK TABLES "comics" WRITE;
/*!40000 ALTER TABLE "comics" DISABLE KEYS */;
/*!40000 ALTER TABLE "comics" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "comics_album"
--

DROP TABLE IF EXISTS "comics_album";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "comics_album" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "file_name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "mime_type" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "comic_id" bigint unsigned NOT NULL,
  "user_id" bigint unsigned NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "comics_album_comic_id_foreign" ("comic_id"),
  KEY "comics_album_user_id_foreign" ("user_id"),
  CONSTRAINT "comics_album_comic_id_foreign" FOREIGN KEY ("comic_id") REFERENCES "comics" ("id") ON DELETE CASCADE,
  CONSTRAINT "comics_album_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "comics_album"
--

LOCK TABLES "comics_album" WRITE;
/*!40000 ALTER TABLE "comics_album" DISABLE KEYS */;
/*!40000 ALTER TABLE "comics_album" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "comment_replies"
--

DROP TABLE IF EXISTS "comment_replies";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "comment_replies" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "user_id" bigint unsigned NOT NULL,
  "comment_id" bigint unsigned NOT NULL,
  "description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "deleted_at" timestamp NULL DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "comment_replies_user_id_foreign" ("user_id"),
  KEY "comment_replies_comment_id_foreign" ("comment_id"),
  CONSTRAINT "comment_replies_comment_id_foreign" FOREIGN KEY ("comment_id") REFERENCES "comments" ("id") ON DELETE CASCADE,
  CONSTRAINT "comment_replies_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "comment_replies"
--

LOCK TABLES "comment_replies" WRITE;
/*!40000 ALTER TABLE "comment_replies" DISABLE KEYS */;
/*!40000 ALTER TABLE "comment_replies" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "comments"
--

DROP TABLE IF EXISTS "comments";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "comments" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "user_type" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "user_id" bigint unsigned NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "comments_user_type_user_id_index" ("user_type","user_id")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "comments"
--

LOCK TABLES "comments" WRITE;
/*!40000 ALTER TABLE "comments" DISABLE KEYS */;
/*!40000 ALTER TABLE "comments" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "expriments"
--

DROP TABLE IF EXISTS "expriments";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "expriments" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "user_id" bigint unsigned NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "expriments_user_id_foreign" ("user_id"),
  CONSTRAINT "expriments_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "expriments"
--

LOCK TABLES "expriments" WRITE;
/*!40000 ALTER TABLE "expriments" DISABLE KEYS */;
/*!40000 ALTER TABLE "expriments" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "failed_jobs"
--

DROP TABLE IF EXISTS "failed_jobs";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "failed_jobs" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "uuid" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "connection" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "queue" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "payload" longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  "exception" longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  "failed_at" timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ("id"),
  UNIQUE KEY "failed_jobs_uuid_unique" ("uuid")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "failed_jobs"
--

LOCK TABLES "failed_jobs" WRITE;
/*!40000 ALTER TABLE "failed_jobs" DISABLE KEYS */;
/*!40000 ALTER TABLE "failed_jobs" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "followers"
--

DROP TABLE IF EXISTS "followers";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "followers" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "user_id" bigint unsigned NOT NULL,
  "deleted_at" timestamp NULL DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "followers_user_id_foreign" ("user_id"),
  CONSTRAINT "followers_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "followers"
--

LOCK TABLES "followers" WRITE;
/*!40000 ALTER TABLE "followers" DISABLE KEYS */;
/*!40000 ALTER TABLE "followers" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "following"
--

DROP TABLE IF EXISTS "following";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "following" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "user_id" bigint unsigned NOT NULL,
  "deleted_at" timestamp NULL DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "following_user_id_foreign" ("user_id"),
  CONSTRAINT "following_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "following"
--

LOCK TABLES "following" WRITE;
/*!40000 ALTER TABLE "following" DISABLE KEYS */;
/*!40000 ALTER TABLE "following" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "hashtags"
--

DROP TABLE IF EXISTS "hashtags";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "hashtags" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "title" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "user_id" bigint unsigned NOT NULL,
  "deleted_at" timestamp NULL DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "hashtags_user_id_foreign" ("user_id"),
  CONSTRAINT "hashtags_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "hashtags"
--

LOCK TABLES "hashtags" WRITE;
/*!40000 ALTER TABLE "hashtags" DISABLE KEYS */;
INSERT INTO "hashtags" VALUES (1,'#hashtag',1,NULL,'2022-02-15 05:07:38','2022-02-15 05:07:38');
/*!40000 ALTER TABLE "hashtags" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "ingredients"
--

DROP TABLE IF EXISTS "ingredients";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "ingredients" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "recipe_id" bigint unsigned NOT NULL,
  "description" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "ingredients_recipe_id_foreign" ("recipe_id"),
  CONSTRAINT "ingredients_recipe_id_foreign" FOREIGN KEY ("recipe_id") REFERENCES "recipes" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "ingredients"
--

LOCK TABLES "ingredients" WRITE;
/*!40000 ALTER TABLE "ingredients" DISABLE KEYS */;
/*!40000 ALTER TABLE "ingredients" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "jobs"
--

DROP TABLE IF EXISTS "jobs";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "jobs" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "queue" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "payload" longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  "attempts" tinyint unsigned NOT NULL,
  "reserved_at" int unsigned DEFAULT NULL,
  "available_at" int unsigned NOT NULL,
  "created_at" int unsigned NOT NULL,
  PRIMARY KEY ("id"),
  KEY "jobs_queue_index" ("queue")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "jobs"
--

LOCK TABLES "jobs" WRITE;
/*!40000 ALTER TABLE "jobs" DISABLE KEYS */;
/*!40000 ALTER TABLE "jobs" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "likes"
--

DROP TABLE IF EXISTS "likes";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "likes" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "user_id" bigint unsigned NOT NULL,
  "postable_type" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "postable_id" bigint unsigned NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "likes_user_id_foreign" ("user_id"),
  KEY "likes_postable_type_postable_id_index" ("postable_type","postable_id"),
  CONSTRAINT "likes_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "likes"
--

LOCK TABLES "likes" WRITE;
/*!40000 ALTER TABLE "likes" DISABLE KEYS */;
/*!40000 ALTER TABLE "likes" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "migrations"
--

DROP TABLE IF EXISTS "migrations";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "migrations" (
  "id" int unsigned NOT NULL AUTO_INCREMENT,
  "migration" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "batch" int NOT NULL,
  PRIMARY KEY ("id")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "migrations"
--

LOCK TABLES "migrations" WRITE;
/*!40000 ALTER TABLE "migrations" DISABLE KEYS */;
INSERT INTO "migrations" VALUES (1,'2014_02_08_071304_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_01_10_122438_create_comments_table',1),(6,'2022_01_26_104903_create_jobs_table',1),(7,'2022_01_30_201712_create_admins_table',1),(8,'2022_01_30_205034_create_categories_table',1),(9,'2022_01_30_205245_create_short_videos_table',1),(10,'2022_01_30_210721_create_bookamrk_videos_table',1),(11,'2022_01_31_124229_create_waiting_list',1),(12,'2022_01_31_133703_create_likes_table',1),(13,'2022_01_31_133811_create_hashtag_table',1),(14,'2022_01_31_135715_create_banned_table',1),(15,'2022_01_31_140119_create_followers_table',1),(16,'2022_01_31_140306_create_following_table',1),(17,'2022_02_01_093824_create_recipes_table',1),(18,'2022_02_01_111246_create_comics_table',1),(19,'2022_02_01_111443_create_ingredients_table',1),(20,'2022_02_01_111512_create_steps_table',1),(21,'2022_02_01_111953_create_expriments_table',1),(22,'2022_02_01_132927_create_notifications_table',1),(23,'2022_02_03_134401_create_settings_table',1),(24,'2022_02_06_132203_create_comics_album_table',1),(25,'2022_02_06_132945_create_recipes_album_table',1),(26,'2022_02_08_065917_create_replies_table',1),(27,'2022_02_11_164504_create_permission_tables',1),(28,'2022_02_14_145435_create_recipe_hashtag_table',1);
/*!40000 ALTER TABLE "migrations" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "model_has_permissions"
--

DROP TABLE IF EXISTS "model_has_permissions";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "model_has_permissions" (
  "permission_id" bigint unsigned NOT NULL,
  "model_type" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "model_id" bigint unsigned NOT NULL,
  PRIMARY KEY ("permission_id","model_id","model_type"),
  KEY "model_has_permissions_model_id_model_type_index" ("model_id","model_type"),
  CONSTRAINT "model_has_permissions_permission_id_foreign" FOREIGN KEY ("permission_id") REFERENCES "permissions" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "model_has_permissions"
--

LOCK TABLES "model_has_permissions" WRITE;
/*!40000 ALTER TABLE "model_has_permissions" DISABLE KEYS */;
/*!40000 ALTER TABLE "model_has_permissions" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "model_has_roles"
--

DROP TABLE IF EXISTS "model_has_roles";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "model_has_roles" (
  "role_id" bigint unsigned NOT NULL,
  "model_type" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "model_id" bigint unsigned NOT NULL,
  PRIMARY KEY ("role_id","model_id","model_type"),
  KEY "model_has_roles_model_id_model_type_index" ("model_id","model_type"),
  CONSTRAINT "model_has_roles_role_id_foreign" FOREIGN KEY ("role_id") REFERENCES "roles" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "model_has_roles"
--

LOCK TABLES "model_has_roles" WRITE;
/*!40000 ALTER TABLE "model_has_roles" DISABLE KEYS */;
/*!40000 ALTER TABLE "model_has_roles" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "notifications"
--

DROP TABLE IF EXISTS "notifications";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "notifications" (
  "id" char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  "type" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "notifiable_type" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "notifiable_id" bigint unsigned NOT NULL,
  "data" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "read_at" timestamp NULL DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "notifications_notifiable_type_notifiable_id_index" ("notifiable_type","notifiable_id")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "notifications"
--

LOCK TABLES "notifications" WRITE;
/*!40000 ALTER TABLE "notifications" DISABLE KEYS */;
/*!40000 ALTER TABLE "notifications" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "password_resets"
--

DROP TABLE IF EXISTS "password_resets";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "password_resets" (
  "email" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "token" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  KEY "password_resets_email_index" ("email")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "password_resets"
--

LOCK TABLES "password_resets" WRITE;
/*!40000 ALTER TABLE "password_resets" DISABLE KEYS */;
/*!40000 ALTER TABLE "password_resets" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "permissions"
--

DROP TABLE IF EXISTS "permissions";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "permissions" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "guard_name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  UNIQUE KEY "permissions_name_guard_name_unique" ("name","guard_name")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "permissions"
--

LOCK TABLES "permissions" WRITE;
/*!40000 ALTER TABLE "permissions" DISABLE KEYS */;
/*!40000 ALTER TABLE "permissions" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "personal_access_tokens"
--

DROP TABLE IF EXISTS "personal_access_tokens";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "personal_access_tokens" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "tokenable_type" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "tokenable_id" bigint unsigned NOT NULL,
  "name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "token" varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  "abilities" text COLLATE utf8mb4_unicode_ci,
  "last_used_at" timestamp NULL DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  UNIQUE KEY "personal_access_tokens_token_unique" ("token"),
  KEY "personal_access_tokens_tokenable_type_tokenable_id_index" ("tokenable_type","tokenable_id")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "personal_access_tokens"
--

LOCK TABLES "personal_access_tokens" WRITE;
/*!40000 ALTER TABLE "personal_access_tokens" DISABLE KEYS */;
/*!40000 ALTER TABLE "personal_access_tokens" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "recipe_hashtag"
--

DROP TABLE IF EXISTS "recipe_hashtag";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "recipe_hashtag" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "recipe_id" bigint unsigned NOT NULL,
  "hash_tag_id" bigint unsigned NOT NULL,
  PRIMARY KEY ("id"),
  KEY "recipe_hashtag_recipe_id_foreign" ("recipe_id"),
  KEY "recipe_hashtag_hash_tag_id_foreign" ("hash_tag_id"),
  CONSTRAINT "recipe_hashtag_hash_tag_id_foreign" FOREIGN KEY ("hash_tag_id") REFERENCES "hashtags" ("id") ON DELETE CASCADE,
  CONSTRAINT "recipe_hashtag_recipe_id_foreign" FOREIGN KEY ("recipe_id") REFERENCES "recipes" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "recipe_hashtag"
--

LOCK TABLES "recipe_hashtag" WRITE;
/*!40000 ALTER TABLE "recipe_hashtag" DISABLE KEYS */;
/*!40000 ALTER TABLE "recipe_hashtag" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "recipes"
--

DROP TABLE IF EXISTS "recipes";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "recipes" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "title" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "description" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "user_id" bigint unsigned DEFAULT NULL,
  "hash_tag_id" bigint unsigned NOT NULL,
  "category_id" bigint unsigned NOT NULL,
  "people_count" bigint unsigned NOT NULL,
  "cooking_time" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "is_active" tinyint unsigned NOT NULL,
  "created_by" bigint unsigned NOT NULL,
  "updated_by" bigint unsigned DEFAULT NULL,
  "deleted_at" timestamp NULL DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "recipes_user_id_foreign" ("user_id"),
  KEY "recipes_hash_tag_id_foreign" ("hash_tag_id"),
  KEY "recipes_category_id_foreign" ("category_id"),
  KEY "recipes_created_by_foreign" ("created_by"),
  KEY "recipes_updated_by_foreign" ("updated_by"),
  CONSTRAINT "recipes_category_id_foreign" FOREIGN KEY ("category_id") REFERENCES "categories" ("id") ON DELETE CASCADE,
  CONSTRAINT "recipes_created_by_foreign" FOREIGN KEY ("created_by") REFERENCES "admins" ("id") ON DELETE CASCADE,
  CONSTRAINT "recipes_hash_tag_id_foreign" FOREIGN KEY ("hash_tag_id") REFERENCES "hashtags" ("id") ON DELETE CASCADE,
  CONSTRAINT "recipes_updated_by_foreign" FOREIGN KEY ("updated_by") REFERENCES "admins" ("id") ON DELETE CASCADE,
  CONSTRAINT "recipes_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "recipes"
--

LOCK TABLES "recipes" WRITE;
/*!40000 ALTER TABLE "recipes" DISABLE KEYS */;
/*!40000 ALTER TABLE "recipes" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "recipes_album"
--

DROP TABLE IF EXISTS "recipes_album";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "recipes_album" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "file_name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "mime_type" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "recipe_id" bigint unsigned NOT NULL,
  "user_id" bigint unsigned NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "recipes_album_recipe_id_foreign" ("recipe_id"),
  KEY "recipes_album_user_id_foreign" ("user_id"),
  CONSTRAINT "recipes_album_recipe_id_foreign" FOREIGN KEY ("recipe_id") REFERENCES "recipes" ("id") ON DELETE CASCADE,
  CONSTRAINT "recipes_album_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "recipes_album"
--

LOCK TABLES "recipes_album" WRITE;
/*!40000 ALTER TABLE "recipes_album" DISABLE KEYS */;
/*!40000 ALTER TABLE "recipes_album" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "role_has_permissions"
--

DROP TABLE IF EXISTS "role_has_permissions";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "role_has_permissions" (
  "permission_id" bigint unsigned NOT NULL,
  "role_id" bigint unsigned NOT NULL,
  PRIMARY KEY ("permission_id","role_id"),
  KEY "role_has_permissions_role_id_foreign" ("role_id"),
  CONSTRAINT "role_has_permissions_permission_id_foreign" FOREIGN KEY ("permission_id") REFERENCES "permissions" ("id") ON DELETE CASCADE,
  CONSTRAINT "role_has_permissions_role_id_foreign" FOREIGN KEY ("role_id") REFERENCES "roles" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "role_has_permissions"
--

LOCK TABLES "role_has_permissions" WRITE;
/*!40000 ALTER TABLE "role_has_permissions" DISABLE KEYS */;
/*!40000 ALTER TABLE "role_has_permissions" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "roles"
--

DROP TABLE IF EXISTS "roles";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "roles" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "guard_name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  UNIQUE KEY "roles_name_guard_name_unique" ("name","guard_name")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "roles"
--

LOCK TABLES "roles" WRITE;
/*!40000 ALTER TABLE "roles" DISABLE KEYS */;
/*!40000 ALTER TABLE "roles" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "settings"
--

DROP TABLE IF EXISTS "settings";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "settings" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "meta_key" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "meta_data" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "settings"
--

LOCK TABLES "settings" WRITE;
/*!40000 ALTER TABLE "settings" DISABLE KEYS */;
/*!40000 ALTER TABLE "settings" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "short_videos"
--

DROP TABLE IF EXISTS "short_videos";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "short_videos" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "description" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "view_count" int unsigned NOT NULL DEFAULT '0',
  "user_id" bigint unsigned NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "short_videos_user_id_foreign" ("user_id"),
  CONSTRAINT "short_videos_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "short_videos"
--

LOCK TABLES "short_videos" WRITE;
/*!40000 ALTER TABLE "short_videos" DISABLE KEYS */;
/*!40000 ALTER TABLE "short_videos" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "steps"
--

DROP TABLE IF EXISTS "steps";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "steps" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "recipe_id" bigint unsigned NOT NULL,
  "step_description" text COLLATE utf8mb4_unicode_ci NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "steps_recipe_id_foreign" ("recipe_id"),
  CONSTRAINT "steps_recipe_id_foreign" FOREIGN KEY ("recipe_id") REFERENCES "recipes" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "steps"
--

LOCK TABLES "steps" WRITE;
/*!40000 ALTER TABLE "steps" DISABLE KEYS */;
/*!40000 ALTER TABLE "steps" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "users"
--

DROP TABLE IF EXISTS "users";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "users" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "name" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "phone_number" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "verify_number" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  "phone_number_verified_at" timestamp NULL DEFAULT NULL,
  "password" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "avatar" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  "provider_id" bigint unsigned DEFAULT NULL,
  "provider_token" text COLLATE utf8mb4_unicode_ci,
  "provider_name" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "identity" varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'identity.png',
  "description" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "user_ip" varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  "address" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "youtube_channel" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "facebook_link" varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "deleted_at" timestamp NULL DEFAULT NULL,
  "remember_token" varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  UNIQUE KEY "users_phone_number_unique" ("phone_number"),
  KEY "users_provider_id_index" ("provider_id")
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "users"
--

LOCK TABLES "users" WRITE;
/*!40000 ALTER TABLE "users" DISABLE KEYS */;
INSERT INTO "users" VALUES (1,'developer','01021408852','9999',NULL,'$2y$10$JwvkkadFCcROMtwUvJq2JuzkD8pHX4IPSpWlTyp50Il/1VzCZ9g8W','avatar.png',NULL,NULL,NULL,'identity.png',NULL,'0.0.0.0',NULL,NULL,NULL,NULL,NULL,'2022-02-15 05:07:38','2022-02-15 05:07:38');
/*!40000 ALTER TABLE "users" ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table "waiting_list"
--

DROP TABLE IF EXISTS "waiting_list";
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "waiting_list" (
  "id" bigint unsigned NOT NULL AUTO_INCREMENT,
  "user_id" bigint unsigned NOT NULL,
  "created_at" timestamp NULL DEFAULT NULL,
  "updated_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id"),
  KEY "waiting_list_user_id_foreign" ("user_id"),
  CONSTRAINT "waiting_list_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table "waiting_list"
--

LOCK TABLES "waiting_list" WRITE;
/*!40000 ALTER TABLE "waiting_list" DISABLE KEYS */;
/*!40000 ALTER TABLE "waiting_list" ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-15 13:15:48
