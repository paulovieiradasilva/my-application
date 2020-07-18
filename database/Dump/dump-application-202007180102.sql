-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: application
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-1ubuntu1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `application_employee`
--

DROP TABLE IF EXISTS `application_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_employee` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint(20) unsigned NOT NULL,
  `employee_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `application_employee_application_id_foreign` (`application_id`),
  KEY `application_employee_employee_id_foreign` (`employee_id`),
  CONSTRAINT `application_employee_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `application_employee_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_employee`
--

LOCK TABLES `application_employee` WRITE;
/*!40000 ALTER TABLE `application_employee` DISABLE KEYS */;
INSERT INTO `application_employee` VALUES (1,1,1,NULL,NULL),(2,1,2,NULL,NULL);
/*!40000 ALTER TABLE `application_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_server`
--

DROP TABLE IF EXISTS `application_server`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_server` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint(20) unsigned NOT NULL,
  `server_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `application_server_application_id_foreign` (`application_id`),
  KEY `application_server_server_id_foreign` (`server_id`),
  CONSTRAINT `application_server_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `application_server_server_id_foreign` FOREIGN KEY (`server_id`) REFERENCES `servers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_server`
--

LOCK TABLES `application_server` WRITE;
/*!40000 ALTER TABLE `application_server` DISABLE KEYS */;
INSERT INTO `application_server` VALUES (1,1,2,NULL,NULL),(2,1,3,NULL,NULL);
/*!40000 ALTER TABLE `application_server` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start` enum('Automático','Manual') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('Web','Executável') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tower_id` bigint(20) unsigned DEFAULT NULL,
  `provider_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applications_provider_id_foreign` (`provider_id`),
  KEY `applications_tower_id_foreign` (`tower_id`),
  CONSTRAINT `applications_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`),
  CONSTRAINT `applications_tower_id_foreign` FOREIGN KEY (`tower_id`) REFERENCES `towers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,'HEMERA - SP',NULL,'Manual',NULL,'Web',3,1,'2020-07-08 02:07:08','2020-07-08 02:07:08');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cellphone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactable_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_contactable_type_contactable_id_index` (`contactable_type`,`contactable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'decio.silva@castecnologia.com.br','(11) 3264-0016',NULL,NULL,'App\\Models\\Provider',1,'2020-07-07 00:46:39','2020-07-08 02:03:01'),(2,'psr.ti@castecnologia.com.br','(11) 3264-0000',NULL,NULL,'App\\Models\\Provider',1,'2020-07-07 00:47:22','2020-07-08 01:58:52'),(4,NULL,NULL,'(11) 9 7674-2980',NULL,'App\\Models\\Provider',1,'2020-07-08 02:03:44','2020-07-08 02:03:44'),(6,'gabriela.araujo@edpbr.com.br',NULL,'(11) 9 9965-3328',NULL,'App\\Models\\Employee',1,'2020-07-08 02:05:16','2020-07-08 02:05:16');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credentials`
--

DROP TABLE IF EXISTS `credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credentials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credentialable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credentialable_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `credentials_credentialable_type_credentialable_id_index` (`credentialable_type`,`credentialable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credentials`
--

LOCK TABLES `credentials` WRITE;
/*!40000 ALTER TABLE `credentials` DISABLE KEYS */;
INSERT INTO `credentials` VALUES (1,'hemera','bandeirante01','App\\Models\\Database',1,'2020-07-08 01:54:33','2020-07-08 01:54:33'),(2,'hemera','bandeirante01','App\\Models\\Database',2,'2020-07-08 01:55:43','2020-07-08 01:55:43'),(3,'01','01','App\\Models\\Integration',1,'2020-07-08 02:50:30','2020-07-08 02:50:30'),(4,'02','02','App\\Models\\Integration',2,'2020-07-08 02:50:55','2020-07-08 02:50:55'),(5,'01','01','App\\Models\\Service',1,'2020-07-08 02:52:50','2020-07-08 02:52:50'),(6,'02','02','App\\Models\\Service',2,'2020-07-08 02:53:40','2020-07-08 02:53:40');
/*!40000 ALTER TABLE `credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `databases`
--

DROP TABLE IF EXISTS `databases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `databases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sgdb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `databases_server_id_foreign` (`server_id`),
  CONSTRAINT `databases_server_id_foreign` FOREIGN KEY (`server_id`) REFERENCES `servers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `databases`
--

LOCK TABLES `databases` WRITE;
/*!40000 ALTER TABLE `databases` DISABLE KEYS */;
INSERT INTO `databases` VALUES (1,'pband21','ORACLE','1521',2,'2020-07-08 01:54:33','2020-07-08 01:54:33'),(2,'pband21','ORACLE','1521',3,'2020-07-08 01:55:43','2020-07-08 01:55:43');
/*!40000 ALTER TABLE `databases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `details`
--

DROP TABLE IF EXISTS `details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint(20) unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `environment_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `details_application_id_foreign` (`application_id`),
  KEY `details_environment_id_foreign` (`environment_id`),
  CONSTRAINT `details_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `details_environment_id_foreign` FOREIGN KEY (`environment_id`) REFERENCES `environments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `details`
--

LOCK TABLES `details` WRITE;
/*!40000 ALTER TABLE `details` DISABLE KEYS */;
INSERT INTO `details` VALUES (1,1,'Link','http://hemerasp.edp.pt:8080/hemera/loginHemera.jsp',3,'2020-07-18 03:35:23','2020-07-18 03:35:23'),(2,1,'Link','http://172.20.221.75:8080/hemera/loginHemera.jsp',2,'2020-07-18 03:35:56','2020-07-18 03:35:56');
/*!40000 ALTER TABLE `details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('AO','KEY','BO') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tower_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_tower_id_foreign` (`tower_id`),
  CONSTRAINT `employees_tower_id_foreign` FOREIGN KEY (`tower_id`) REFERENCES `towers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'Gabriela de Campos Ferreira Araújo','AO',3,'2020-07-07 00:16:01','2020-07-08 02:04:32'),(2,'Funcionário 002','KEY',3,'2020-07-07 01:09:32','2020-07-07 01:09:32');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `environments`
--

DROP TABLE IF EXISTS `environments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `environments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `environments`
--

LOCK TABLES `environments` WRITE;
/*!40000 ALTER TABLE `environments` DISABLE KEYS */;
INSERT INTO `environments` VALUES (1,'DEV',NULL,'2020-07-07 00:12:43','2020-07-07 00:12:43'),(2,'QA',NULL,'2020-07-07 00:12:48','2020-07-07 00:12:48'),(3,'PRD',NULL,'2020-07-07 00:12:55','2020-07-07 00:12:55');
/*!40000 ALTER TABLE `environments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `integrations`
--

DROP TABLE IF EXISTS `integrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `integrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('Webservice','PI','xml','json') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `integrations_application_id_foreign` (`application_id`),
  CONSTRAINT `integrations_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `integrations`
--

LOCK TABLES `integrations` WRITE;
/*!40000 ALTER TABLE `integrations` DISABLE KEYS */;
INSERT INTO `integrations` VALUES (1,'01',NULL,'Webservice',1,'2020-07-08 02:50:30','2020-07-08 02:50:30'),(2,'02',NULL,'PI',1,'2020-07-08 02:50:55','2020-07-08 02:50:55');
/*!40000 ALTER TABLE `integrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=309 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (282,'2014_10_12_000000_create_users_table',1),(283,'2014_10_12_100000_create_password_resets_table',1),(284,'2015_01_20_084450_create_roles_table',1),(285,'2015_01_20_084525_create_role_user_table',1),(286,'2015_01_24_080208_create_permissions_table',1),(287,'2015_01_24_080433_create_permission_role_table',1),(288,'2015_12_04_003040_add_special_role_column',1),(289,'2017_10_17_170735_create_permission_user_table',1),(290,'2020_02_25_153406_create_providers_table',1),(291,'2020_02_25_153436_create_towers_table',1),(292,'2020_02_25_153519_create_employees_table',1),(293,'2020_02_25_153550_create_environments_table',1),(294,'2020_02_25_154230_create_servers_table',1),(295,'2020_02_25_154231_create_databases_table',1),(296,'2020_02_25_154347_create_applications_table',1),(297,'2020_02_25_154952_create_services_table',1),(298,'2020_02_25_155005_create_integrations_table',1),(299,'2020_02_26_010929_create_contacts_table',1),(300,'2020_02_26_011006_create_credentials_table',1),(301,'2020_03_30_230316_add_description_to_servers_table',1),(302,'2020_03_30_230841_remove_version_os_to_servers_table',1),(303,'2020_03_31_000112_add_description_to_providers_table',1),(304,'2020_04_10_000645_remove_version_to_databases_table',1),(305,'2020_04_21_180702_create_application_employee_table',1),(306,'2020_04_25_140704_create_application_server_table',1),(307,'2020_05_09_102122_add_tower_id_to_applications_table',1),(308,'2020_05_10_115050_create_details_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_user`
--

LOCK TABLES `permission_user` WRITE;
/*!40000 ALTER TABLE `permission_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Listar usuários','users.index','Listar todos os usuário do sistema','2020-07-07 00:04:53','2020-07-07 00:04:53'),(2,'Visualizar detalhes de usuários','users.show','Listar usuário do sistema','2020-07-07 00:04:54','2020-07-07 00:04:54'),(3,'Atualizar usuários','users.edit','Editar todos os usuário','2020-07-07 00:04:54','2020-07-07 00:04:54'),(4,'Eliminar usuários','users.destroy','Apagar usuários do sistema','2020-07-07 00:04:54','2020-07-07 00:04:54'),(5,'Criar novos papéis','roles.create','Cadastrar novos papéis para o Sistema','2020-07-07 00:04:54','2020-07-07 00:04:54'),(6,'Listar papéis','roles.index','Listar todos os papéis','2020-07-07 00:04:54','2020-07-07 00:04:54'),(7,'Visualizar detalhes de papéis','roles.show','Ver detalhe dos papéis','2020-07-07 00:04:55','2020-07-07 00:04:55'),(8,'Atualizar papéis','roles.edit','Editar os papéis','2020-07-07 00:04:55','2020-07-07 00:04:55'),(9,'Eliminar papéis','roles.destroy','Deletar os papéis','2020-07-07 00:04:55','2020-07-07 00:04:55'),(10,'Criar novas permissões','permissions.create','Cadastrar novos permissões','2020-07-07 00:04:56','2020-07-07 00:04:56'),(11,'Listar permissões','permissions.index','Listar todos os permissões','2020-07-07 00:04:56','2020-07-07 00:04:56'),(12,'Visualizar detalhes de permissões','permissions.show','Ver detalhes das permissões','2020-07-07 00:04:56','2020-07-07 00:04:56'),(13,'Atualizar permissões','permissions.edit','Editar permissões do sistema','2020-07-07 00:04:57','2020-07-07 00:04:57'),(14,'Eliminar papéis','permissions.destroy','Apagar permissões do sistema','2020-07-07 00:04:58','2020-07-07 00:04:58'),(15,'Controle de Acesso','access.control','Acesso aos módulos de usuários, papeis e permissões.','2020-07-07 00:04:58','2020-07-07 00:04:58'),(16,'Dashboard','users.dashboard','Exibir o dashboard padrão para os usuários','2020-07-07 00:04:58','2020-07-07 00:04:58'),(17,'Criar novos servidores','servers.create','Cadastrar novos servidores','2020-07-07 00:04:58','2020-07-07 00:04:58'),(18,'Listar servidores','servers.index','Listar todos os servidores','2020-07-07 00:04:58','2020-07-07 00:04:58'),(19,'Visualizar detalhes de servidores','servers.show','Ver detalhe dos servidores','2020-07-07 00:04:59','2020-07-07 00:04:59'),(20,'Atualizar servidores','servers.edit','Editar os servidores','2020-07-07 00:04:59','2020-07-07 00:04:59'),(21,'Eliminar servidores','servers.destroy','Deletar os servidores','2020-07-07 00:04:59','2020-07-07 00:04:59'),(22,'Criar novos databases','databases.create','Cadastrar novas databases','2020-07-07 00:04:59','2020-07-07 00:04:59'),(23,'Listar databases','databases.index','Listar todas as databases','2020-07-07 00:05:00','2020-07-07 00:05:00'),(24,'Visualizar detalhes de databases','databases.show','Ver detalhe das databases','2020-07-07 00:05:00','2020-07-07 00:05:00'),(25,'Atualizar databases','databases.edit','Editar databases','2020-07-07 00:05:00','2020-07-07 00:05:00'),(26,'Eliminar databases','databases.destroy','Deletar databases','2020-07-07 00:05:01','2020-07-07 00:05:01'),(27,'Criar novos funcionários','employees.create','Cadastrar novos funcionários','2020-07-07 00:05:01','2020-07-07 00:05:01'),(28,'Listar funcionários','employees.index','Listar todos os funcionários','2020-07-07 00:05:01','2020-07-07 00:05:01'),(29,'Visualizar detalhes de funcionários','employees.show','Ver detalhe dos funcionários','2020-07-07 00:05:01','2020-07-07 00:05:01'),(30,'Atualizar funcionários','employees.edit','Editar os funcionários','2020-07-07 00:05:02','2020-07-07 00:05:02'),(31,'Eliminar funcionários','employees.destroy','Deletar os funcionários','2020-07-07 00:05:02','2020-07-07 00:05:02'),(32,'Criar novos fornecedores','providers.create','Cadastrar novos fornecedores','2020-07-07 00:05:02','2020-07-07 00:05:02'),(33,'Listar fornecedores','providers.index','Listar todos os fornecedores','2020-07-07 00:05:03','2020-07-07 00:05:03'),(34,'Visualizar detalhes de fornecedores','providers.show','Ver detalhe dos fornecedores','2020-07-07 00:05:03','2020-07-07 00:05:03'),(35,'Atualizar fornecedores','providers.edit','Editar os fornecedores','2020-07-07 00:05:03','2020-07-07 00:05:03'),(36,'Eliminar fornecedores','providers.destroy','Deletar os fornecedores','2020-07-07 00:05:03','2020-07-07 00:05:03'),(37,'Criar novos torres','towers.create','Cadastrar novas torres','2020-07-07 00:05:04','2020-07-07 00:05:04'),(38,'Listar torres','towers.index','Listar todas as torres','2020-07-07 00:05:04','2020-07-07 00:05:04'),(39,'Visualizar detalhes de torres','towers.show','Ver detalhe das torres','2020-07-07 00:05:04','2020-07-07 00:05:04'),(40,'Atualizar torres','towers.edit','Editar torres','2020-07-07 00:05:05','2020-07-07 00:05:05'),(41,'Eliminar torres','towers.destroy','Deletar torres','2020-07-07 00:05:05','2020-07-07 00:05:05'),(42,'Criar novos ambientes','environments.create','Cadastrar novas ambientes','2020-07-07 00:05:05','2020-07-07 00:05:05'),(43,'Listar ambientes','environments.index','Listar todos os ambientes','2020-07-07 00:05:06','2020-07-07 00:05:06'),(44,'Visualizar detalhes de ambientes','environments.show','Ver detalhe dos ambientes','2020-07-07 00:05:06','2020-07-07 00:05:06'),(45,'Atualizar ambientes','environments.edit','Editar ambientes','2020-07-07 00:05:06','2020-07-07 00:05:06'),(46,'Eliminar ambientes','environments.destroy','Deletar ambientes','2020-07-07 00:05:06','2020-07-07 00:05:06'),(47,'Criar novos aplicações','applications.create','Cadastrar novas aplicações','2020-07-07 00:05:07','2020-07-07 00:05:07'),(48,'Listar aplicações','applications.index','Listar todas as aplicações','2020-07-07 00:05:07','2020-07-07 00:05:07'),(49,'Visualizar detalhes de aplicações','applications.show','Ver detalhe das aplicações','2020-07-07 00:05:07','2020-07-07 00:05:07'),(50,'Atualizar aplicações','applications.edit','Editar aplicações','2020-07-07 00:05:07','2020-07-07 00:05:07'),(51,'Eliminar aplicações','applications.destroy','Deletar aplicações','2020-07-07 00:05:08','2020-07-07 00:05:08'),(52,'Criar novos serviços','services.create','Cadastrar novos serviços','2020-07-07 00:05:08','2020-07-07 00:05:08'),(53,'Listar serviços','services.index','Listar todos os seriços','2020-07-07 00:05:08','2020-07-07 00:05:08'),(54,'Visualizar detalhes de seriços','services.show','Ver detalhe dos seriços','2020-07-07 00:05:09','2020-07-07 00:05:09'),(55,'Atualizar seriços','services.edit','Editar seriços','2020-07-07 00:05:09','2020-07-07 00:05:09'),(56,'Eliminar seriços','services.destroy','Deletar seriços','2020-07-07 00:05:09','2020-07-07 00:05:09'),(57,'Criar novas integrações','integrations.create','Cadastrar novas integrações','2020-07-07 00:05:09','2020-07-07 00:05:09'),(58,'Listar integrações','integrations.index','Listar todas as integrações','2020-07-07 00:05:10','2020-07-07 00:05:10'),(59,'Visualizar detalhes de integrações','integrations.show','Ver detalhe das integrações','2020-07-07 00:05:10','2020-07-07 00:05:10'),(60,'Atualizar integrações','integrations.edit','Editar integrações','2020-07-07 00:05:10','2020-07-07 00:05:10'),(61,'Eliminar integrações','integrations.destroy','Deletar integrações','2020-07-07 00:05:11','2020-07-07 00:05:11'),(62,'Criar novos contatos','contacts.create','Cadastrar novos contatos','2020-07-07 00:05:09','2020-07-07 00:05:09'),(63,'Listar contatos','contacts.index','Listar todas os contatos','2020-07-07 00:05:10','2020-07-07 00:05:10'),(64,'Visualizar detalhes do contato','contacts.show','Ver detalhe dos contatos','2020-07-07 00:05:10','2020-07-07 00:05:10'),(65,'Atualizar contatos','contacts.edit','Editar contatos','2020-07-07 00:05:10','2020-07-07 00:05:10'),(66,'Eliminar contatos','contacts.destroy','Deletar contatos','2020-07-07 00:05:11','2020-07-07 00:05:11'),(68,'Cadastrar novo detalhe','details.create','Cadastrar novo detalhe.','2020-07-18 03:11:22','2020-07-18 03:11:22'),(69,'Listar detalhes','details.index','Listar todos os detalhes','2020-07-18 03:11:52','2020-07-18 03:11:52'),(70,'Visualizar detalhe','details.show','Ver detalhe','2020-07-18 03:13:07','2020-07-18 03:13:07'),(71,'Atualizar detalhe','details.edit','Editar detalhes','2020-07-18 03:13:41','2020-07-18 03:13:41'),(72,'Eliminar detalhe','details.destroy','Deletar detalhe','2020-07-18 03:14:37','2020-07-18 03:14:37');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `providers`
--

DROP TABLE IF EXISTS `providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `providers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_hours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `on_duty` enum('-','12/7','24/7') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `providers`
--

LOCK TABLES `providers` WRITE;
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
INSERT INTO `providers` VALUES (1,'CAS TECNOLOGIA','Comercial','12/7',NULL,'2020-07-07 00:16:29','2020-07-08 01:56:32');
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1,'2020-07-07 00:06:11','2020-07-07 00:06:11');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special` enum('all-access','no-access') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador','admin','Administrador do sistema, possui todas as permissões','2020-07-07 00:06:10','2020-07-07 00:06:10','all-access'),(2,'Users','users','Papél default para usuários do sistema','2020-07-07 00:06:10','2020-07-07 00:06:10',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servers`
--

DROP TABLE IF EXISTS `servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('Aplicação','Banco de Dados') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `environment_id` bigint(20) unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `servers_environment_id_foreign` (`environment_id`),
  CONSTRAINT `servers_environment_id_foreign` FOREIGN KEY (`environment_id`) REFERENCES `environments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servers`
--

LOCK TABLES `servers` WRITE;
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
INSERT INTO `servers` VALUES (1,'EDPBR660','172.20.221.99','Linux','Aplicação',3,NULL,'2020-07-08 01:50:48','2020-07-08 01:50:48'),(2,'EDPBR433','172.20.221.133',NULL,'Banco de Dados',3,NULL,'2020-07-08 01:52:08','2020-07-08 01:52:08'),(3,'EDPBR434','172.20.221.134',NULL,'Banco de Dados',3,NULL,'2020-07-08 01:52:30','2020-07-08 01:52:30');
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start` enum('Automático','Manual') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_application_id_foreign` (`application_id`),
  CONSTRAINT `services_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'01',NULL,'Manual',1,'2020-07-08 02:52:49','2020-07-08 02:52:49'),(2,'02',NULL,'Automático',1,'2020-07-08 02:53:40','2020-07-08 02:53:40');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `towers`
--

DROP TABLE IF EXISTS `towers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `towers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `towers`
--

LOCK TABLES `towers` WRITE;
/*!40000 ALTER TABLE `towers` DISABLE KEYS */;
INSERT INTO `towers` VALUES (1,'BI',NULL,'2020-07-07 00:12:04','2020-07-07 00:12:04'),(2,'R3',NULL,'2020-07-07 00:12:24','2020-07-07 00:12:24'),(3,'CCS',NULL,'2020-07-07 00:12:33','2020-07-07 00:12:33');
/*!40000 ALTER TABLE `towers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrador','admin@admin.com','2020-07-07 00:05:15','$2y$10$Uhhp6Y7f/h6fmFf88RIsz.LkQmeTlV5669p7NTVxw/sfmplm4LkIu',NULL,'2020-07-07 00:05:15','2020-07-07 00:05:15'),(2,'Cyril Sawayn','elroy44@example.org','2020-07-07 00:05:15','$2y$10$iHAk6F0w/h4dMpYALf4cf.5u6f2YNKnpWy4p9oy9lb1IiSwL/cZJm','fucbq28pBE','2020-07-07 00:05:20','2020-07-07 00:05:20'),(3,'Cornelius Bins','damian.mosciski@example.com','2020-07-07 00:05:15','$2y$10$tBVnJdBN2nDbo84QCYmsl.tbX/KqCDfq/NO/L7ytx1DlRj96CUig2','wTB89zHosL','2020-07-07 00:05:20','2020-07-07 00:05:20'),(4,'Vicky Howe','delaney12@example.net','2020-07-07 00:05:15','$2y$10$Ve0v8iPxz8rvpbvQEc7sUOc0oR3ynZybV/MBj4g4NtQYTR9EejI92','MeSXJE3NG5','2020-07-07 00:05:21','2020-07-07 00:05:21'),(5,'Shany Wolf IV','walter54@example.net','2020-07-07 00:05:15','$2y$10$KQmD8x/6xFbZxRprIAhGo.RRow/sLwU.dU9wBKWDp0joEhOtQZHU6','UwZH1YYp38','2020-07-07 00:05:21','2020-07-07 00:05:21'),(6,'Ms. Alisha Flatley','vanderson@example.org','2020-07-07 00:05:15','$2y$10$oHFUnEF.sXHZJzXUqxpjbupdzTKzDDP6.Px6nI7BFzPZxyMVftCru','tyiwDpbI6Z','2020-07-07 00:05:21','2020-07-07 00:05:21'),(7,'Kelvin Kozey','ed29@example.org','2020-07-07 00:05:15','$2y$10$eyr8MAAlO1DCEoCX0m5V3epMwMvQ2AhXPlbtD/AhFt1JtSFWhU2li','DDEcXqZgMR','2020-07-07 00:05:22','2020-07-07 00:05:22'),(8,'Mr. Clifford Kris II','goconner@example.com','2020-07-07 00:05:15','$2y$10$B9vUBZlk1OTIBw7VPJv3geyolNPckZ8JJL/zCj9AeOp8iNbNWAw1q','CSvuKxt7EP','2020-07-07 00:05:22','2020-07-07 00:05:22'),(9,'Andres Yundt','josinski@example.com','2020-07-07 00:05:15','$2y$10$z7deHJGThCKVTqqigyZayebeCzDnuzDPDlze/xnQHPna1Y2wam2mu','3nVLX7Y7bJ','2020-07-07 00:05:22','2020-07-07 00:05:22'),(10,'Ms. Concepcion Gislason V','prosacco.albert@example.org','2020-07-07 00:05:15','$2y$10$EjMkwTZSbYPyxKF8jyFzRumJ3lqVpPmuhtY4yX4W6QrHjHOOTstGG','7sT4hMpRYp','2020-07-07 00:05:22','2020-07-07 00:05:22'),(11,'Marian Waters III','zella.nader@example.org','2020-07-07 00:05:15','$2y$10$KLEcIh6wl7vnyq9cT5/Vbuaz3uZy58ELOwVgZFvpOAxIjDpKaW.NC','ulOSOzdMih','2020-07-07 00:05:22','2020-07-07 00:05:22'),(12,'Yoshiko Huel','rutherford.ila@example.com','2020-07-07 00:05:15','$2y$10$OnTgGCTu9SUFjf9.BiGf3el/GfY9ZL0D10HdkVVryt6AiKndCFVLq','xUL1OiKo9b','2020-07-07 00:05:23','2020-07-07 00:05:23'),(13,'Neil Cruickshank III','pdach@example.com','2020-07-07 00:05:16','$2y$10$yTNCZBpWhZEeyIn1s/aC/.I/Uv4QRedaTgmVRjjTnSH9MQDDlZvQ.','UxLNUu3D88','2020-07-07 00:05:23','2020-07-07 00:05:23'),(14,'Natalia Wisoky DVM','icie.buckridge@example.org','2020-07-07 00:05:16','$2y$10$iguzmAutMpKPFSDsOHip/.F0vU7gcKHF6Nct07pwILiDD/Ckwz2d2','zCDSvGo1Ug','2020-07-07 00:05:23','2020-07-07 00:05:23'),(15,'Anastacio Frami','myrtle40@example.org','2020-07-07 00:05:16','$2y$10$mzSsWMZR8pJ0hJfLLKDTduRlnRRdwrcsw6v1yy8oZN72dIsRe/DRi','JjYcRBVrdy','2020-07-07 00:05:24','2020-07-07 00:05:24'),(16,'Chasity Abbott','sstokes@example.com','2020-07-07 00:05:16','$2y$10$bsX3/iJObwqST/TTFZxOOOEfkXHmliogeyZirCAHKw0hzAbDpi/Ni','n3hV9iLmFQ','2020-07-07 00:05:24','2020-07-07 00:05:24'),(17,'Nicolas Murazik DVM','orpha.trantow@example.org','2020-07-07 00:05:16','$2y$10$mpuY9J52Imzv.KyID06R/OUk8D3wVvEb7xe.koAnGIoG0PsWvRsxK','crVPzZQn7T','2020-07-07 00:05:24','2020-07-07 00:05:24'),(18,'Keith Powlowski','schimmel.aileen@example.net','2020-07-07 00:05:16','$2y$10$qYfMZ8cBSGoXV0aymJCSIuPNrXLf8czN.b0xiOFAPwJFWHbPoNgCW','1e724Nmv5O','2020-07-07 00:05:25','2020-07-07 00:05:25'),(19,'Mr. Denis Champlin Jr.','vance.auer@example.net','2020-07-07 00:05:16','$2y$10$RxwmkvdZZNkX/Vfuzs0qJOrTStmVPfdvWtwq19d115JMLw5/S9ocu','ipTqZ4FzFF','2020-07-07 00:05:25','2020-07-07 00:05:25'),(20,'Dr. Asa Weber MD','zbergstrom@example.org','2020-07-07 00:05:16','$2y$10$OD5zJoHQJl9PZbGD0dDF/uXOIlK56H0mzeDXzGOWsop6z6Idv.S3a','CkVO4NHoZw','2020-07-07 00:05:25','2020-07-07 00:05:25'),(21,'Donny Skiles','barrows.aleen@example.org','2020-07-07 00:05:16','$2y$10$yrWC1Y7SU84vIjfHV8ijQ..YVEW6vJEbqc.pnuepzbrTsCrfopGFm','X5mYbg7tdA','2020-07-07 00:05:26','2020-07-07 00:05:26'),(22,'Marilou O\'Hara','shakira33@example.com','2020-07-07 00:05:16','$2y$10$Zk/kjzmzCRZz.tUjPKLasuCI8TQAZlRFv7zIVygWVsVBeODIHsr/a','ra9MDkh6Yf','2020-07-07 00:05:27','2020-07-07 00:05:27'),(23,'Lucy Hintz','lexi.marks@example.net','2020-07-07 00:05:16','$2y$10$kw12FIRbkB6/keyumQ5KlOrmh8QgtV/p8LDdzCQwEX7oEzmAyCwY2','LSFmHrmp0E','2020-07-07 00:05:27','2020-07-07 00:05:27'),(24,'Aurelie Legros','albert90@example.net','2020-07-07 00:05:16','$2y$10$KNok8w5EQEA/NUvpMpgClOzzl1BVzEbx8MQglmK0hF0kjFXeQX7Nq','rjEJL3qRQS','2020-07-07 00:05:27','2020-07-07 00:05:27'),(25,'Joaquin Grady IV','waylon.johnson@example.net','2020-07-07 00:05:16','$2y$10$qWvwq8v1Vc.SRg4PR8qbL.gW3SjtDu0ULpay.b04m63gjXoxhqD1y','PGfcMUnFQu','2020-07-07 00:05:28','2020-07-07 00:05:28'),(26,'Deion Kshlerin','maud82@example.com','2020-07-07 00:05:16','$2y$10$lNEWLGOPzq.cIYQWpOa.hukvc5SYhf.p7GbmTU9U3e9no489DnI3y','7KF7WfrTXE','2020-07-07 00:05:28','2020-07-07 00:05:28'),(27,'Elmer McClure','matilde.haley@example.org','2020-07-07 00:05:16','$2y$10$h1Gos07uoauKarRywB3.b.W4oMQlYNXF0SKrnW5oGS/Wb8DTqNpOe','uDXrMzqLwn','2020-07-07 00:05:28','2020-07-07 00:05:28'),(28,'Danny Barton','mark34@example.net','2020-07-07 00:05:16','$2y$10$QKVeDtNOCmqtjn8fh2FmMOBmK3Dmerp4PHF93zpv56GlU9SsagL.e','NFWJiwvQyM','2020-07-07 00:05:28','2020-07-07 00:05:28'),(29,'Prof. Ivory Kerluke','sammie31@example.org','2020-07-07 00:05:16','$2y$10$nYZDxxm.3502ApvQxMSqOu7OvshVDsxyDugEVEOLW8humlQ1HrlnK','MaFqMk3Uvk','2020-07-07 00:05:29','2020-07-07 00:05:29'),(30,'Lyla Hyatt','santino.marquardt@example.net','2020-07-07 00:05:16','$2y$10$hf9nhzHRrVGdH9B.A8Us/O3EPaPsTTbw0Nh7MzMVJe7PgQQSXqI..','n99hR93OBH','2020-07-07 00:05:29','2020-07-07 00:05:29'),(31,'Geovanni Glover IV','rosenbaum.earline@example.com','2020-07-07 00:05:16','$2y$10$wicNXoxlrymttm3MOE9ASu4.lkgcROUnP.Zs2ArzUgf1v0868vEjW','m2pDUUrwNu','2020-07-07 00:05:30','2020-07-07 00:05:30'),(32,'Cecilia Jaskolski Jr.','iabshire@example.org','2020-07-07 00:05:16','$2y$10$/hY6BlVj/U/8.yKA2VpiMO06H.xS1AOnuLc5YzqnQJbyv4ADyJRj6','KJhXLprNkk','2020-07-07 00:05:30','2020-07-07 00:05:30'),(33,'Willy Fadel','porter48@example.org','2020-07-07 00:05:17','$2y$10$mPZ4P0eX9a757w01gl./ROuo2MpjLGmfyo71gUUgGI.8lqszrAWuW','wS0oP4lMyD','2020-07-07 00:05:30','2020-07-07 00:05:30'),(34,'Dr. Tyreek Franecki DDS','lyla72@example.com','2020-07-07 00:05:17','$2y$10$hEB91Ho2/U1xE5.Sv9q/zemA13hy.SssK2irMNDPjjL5BZC58FfeG','E4qDg0F39c','2020-07-07 00:05:30','2020-07-07 00:05:30'),(35,'Briana Lesch','cheyenne.emmerich@example.net','2020-07-07 00:05:17','$2y$10$eSmC97i53ckhCzzQ/OwGn.1W9pndQKGtxc8GyY7rNHUhJZWrMIn3y','6mTZWRehgx','2020-07-07 00:05:31','2020-07-07 00:05:31'),(36,'Mariah Hirthe','krajcik.giovanny@example.com','2020-07-07 00:05:17','$2y$10$BpTiqRp6GCXzFSC3v1Lgv.cuTlfpir27T0nuhm04Ma7OlObw0bhBa','QtTxiVjcve','2020-07-07 00:05:31','2020-07-07 00:05:31'),(37,'Mary Kihn','elinor.kuhic@example.com','2020-07-07 00:05:17','$2y$10$sy8RVtBWeFNMMxz6Ah3mPOPfnq2j96p5g9ev7HESmUq2sWMSseLgC','Nmb6CRg0GW','2020-07-07 00:05:32','2020-07-07 00:05:32'),(38,'Mellie Erdman I','wlakin@example.com','2020-07-07 00:05:17','$2y$10$RVJxYqkiE9m6dD0K1Jx6BuYuETPRP/vNOHMEe4yWHca6XOSXL2.U.','qGqzWbe4Xo','2020-07-07 00:05:32','2020-07-07 00:05:32'),(39,'Mrs. Dayna Bogan','obreitenberg@example.org','2020-07-07 00:05:17','$2y$10$EUZDf0ui5ojI0oe/sRI.h.iiLmEYsDGFppPrfxOHjmvqf1LnOQokO','Tux8EMikgD','2020-07-07 00:05:32','2020-07-07 00:05:32'),(40,'Mariana Krajcik PhD','thansen@example.net','2020-07-07 00:05:17','$2y$10$8VA9lftP1BrZr0AaPxWEV.qZ0aoeIhQuyVCvJ6t/F6WVwN5UUu.Km','MRxqX0jCHy','2020-07-07 00:05:32','2020-07-07 00:05:32'),(41,'Dr. Milo Reichel','fthompson@example.net','2020-07-07 00:05:17','$2y$10$rW8HTf7hXdVj9TcjsBVaQeFmsWgplEV.ok/bUnmu8NZcCVs6uMkZi','wW6xu96rDn','2020-07-07 00:05:32','2020-07-07 00:05:32'),(42,'Catalina O\'Kon','lockman.major@example.net','2020-07-07 00:05:17','$2y$10$pvW.mu5ePU22FzzmqwBWi.OqiotuPBwfnhr5NgGdoBJnW/BaPfSAW','zCOzIrw2AQ','2020-07-07 00:05:33','2020-07-07 00:05:33'),(43,'Yvette Marks II','adrienne64@example.net','2020-07-07 00:05:17','$2y$10$gkrGaef.kAyTBxkZuhtBAOrHLuU/20fioiQeAHpKxsTeb2joAKPdy','kMwrhAGLAV','2020-07-07 00:05:33','2020-07-07 00:05:33'),(44,'Imogene Nader DVM','hope.wilkinson@example.org','2020-07-07 00:05:17','$2y$10$OPA686CED4s5LT/93K4QkOmWx5Dk9oNL9CbWzMd5L0SA/NsT9iEIi','7GN6MWJiVC','2020-07-07 00:05:33','2020-07-07 00:05:33'),(45,'Bradly Huels V','rahul.steuber@example.org','2020-07-07 00:05:17','$2y$10$8Ebmw2Pau9DkmrKsxrdzFOUV7xbtdjV11XZJcIxKVZt52LPAzHjZe','onnVSULG6w','2020-07-07 00:05:34','2020-07-07 00:05:34'),(46,'Melvina Terry','lbradtke@example.net','2020-07-07 00:05:17','$2y$10$fXhpDzWlgXZmkrYCsAFVweJxZ9nIs5yVjSs1C1tnz5PbXr4lu6rcG','fSjqP4im3u','2020-07-07 00:05:34','2020-07-07 00:05:34'),(47,'Ara Anderson V','kreiger.jermain@example.org','2020-07-07 00:05:17','$2y$10$Mqw6ezFa1y6vi.gWYWX76uUtarMAU0ArPan2DU7ois8Y13tH295Ta','kxsq90vDXH','2020-07-07 00:05:35','2020-07-07 00:05:35'),(48,'Dr. Jadyn Wiza III','cassidy.cremin@example.com','2020-07-07 00:05:17','$2y$10$BL7K.jlIMgfGleJBRDiyAe5t2BiF6HvFKlYJusaU5YSlKyOtiFN3C','Qm6yjCfSeL','2020-07-07 00:05:35','2020-07-07 00:05:35'),(49,'Dr. Lenore Auer IV','benjamin13@example.com','2020-07-07 00:05:17','$2y$10$/p1UNFhkS30O08sOQwSDDuly/cAnemeL4U1Fqb81fyDHhT5TqtsKi','gvzIbro5Ie','2020-07-07 00:05:35','2020-07-07 00:05:35'),(50,'Mr. Marshall Dickinson III','anya15@example.com','2020-07-07 00:05:17','$2y$10$rDfG.cd8P5iHJq81FpMfW.16nLV4Bqf1nd5XTXhE5YfGAiqhLK11S','K4seTl11J5','2020-07-07 00:05:35','2020-07-07 00:05:35'),(51,'Jalon Streich','dewitt94@example.net','2020-07-07 00:05:17','$2y$10$edp3u2ZoCXk7spvNZKbca.7hbspLT1oy5yQlrtJDNKpm.6hhu0r.6','dzTF18475Y','2020-07-07 00:05:36','2020-07-07 00:05:36'),(52,'Delphine Fritsch','efrain02@example.net','2020-07-07 00:05:18','$2y$10$Jvvkwj9a8mI7XircMrg.0.C3LHYP1N2GESfeqhL92UJH6xYacM5lG','g5so1FPSY5','2020-07-07 00:05:36','2020-07-07 00:05:36'),(53,'Rosetta Kertzmann Sr.','kayla60@example.com','2020-07-07 00:05:18','$2y$10$OKPaOUy7rcjZrujWK1mWXe1SrHh8Y5rXdaxg73YY9HOPFHzj6zsI.','JaV8ev823V','2020-07-07 00:05:36','2020-07-07 00:05:36'),(54,'Lindsay Lowe','bailey.marianna@example.net','2020-07-07 00:05:18','$2y$10$bMetyYOR1C4XmV0UDaFcqO2JjMcfniGzYuQ6b70hJHyRIr5O6wL6i','o03v7Qdan6','2020-07-07 00:05:37','2020-07-07 00:05:37'),(55,'Peggie Herman','erich56@example.org','2020-07-07 00:05:18','$2y$10$o5hgAYbffUFltZ/ast54OeVoBcdNR1Jzvo4wvpRABpwJHvG6Zmh5.','uIil9009Z1','2020-07-07 00:05:37','2020-07-07 00:05:37'),(56,'Parker Yundt','suzanne57@example.com','2020-07-07 00:05:18','$2y$10$7eHUhJBvTW8dhKdLJqmYe./9Msb7.EJgoGwpo/D4UBt7ZwuvZlVbW','yqQuAwwMmD','2020-07-07 00:05:37','2020-07-07 00:05:37'),(57,'Otilia Ryan','daugherty.deshawn@example.net','2020-07-07 00:05:18','$2y$10$YTJowLUI0DFkjQ0TCgAUoemF0vqXSDlzFmf4.qBGQRl1As5GTT1Ka','hK9B1n2SuE','2020-07-07 00:05:37','2020-07-07 00:05:37'),(58,'Felix O\'Conner','hauck.verna@example.net','2020-07-07 00:05:18','$2y$10$hB5yX4GY.mmM0Nv0x/CWbeY678NMT9CtKB/4eX9U8g40BC3jV.lo2','YEkmphh6yM','2020-07-07 00:05:38','2020-07-07 00:05:38'),(59,'Miss Winnifred Swift','bridie.deckow@example.org','2020-07-07 00:05:18','$2y$10$3LXfXF8NvN.aBPb4vWAQ3e1HeypTaJfdr1PLYTe4yJqxU0SldLUpa','wGU00wlezK','2020-07-07 00:05:38','2020-07-07 00:05:38'),(60,'Emerald Hudson','wlehner@example.net','2020-07-07 00:05:18','$2y$10$xLeYOuS8kpSdc94vYFEegute6.a41nzpIvCim5YCv58rmHbXs3YI.','ynpf84OfYg','2020-07-07 00:05:38','2020-07-07 00:05:38'),(61,'Mr. Adan Purdy I','tremblay.darrel@example.org','2020-07-07 00:05:18','$2y$10$xTNESVYCHG10/yiKkWTtF.dEb8RHlRGZBlT9WmK3JbCQKs2dNXqM.','hcJ1zA2Fpd','2020-07-07 00:05:38','2020-07-07 00:05:38'),(62,'Hans Aufderhar','herminia85@example.net','2020-07-07 00:05:18','$2y$10$DnDALdJu2w9ORagdqJ44Y.R1PZxhrwJsoqBYddrooVSNJ/IK1gFlW','FGmmd1ueBj','2020-07-07 00:05:39','2020-07-07 00:05:39'),(63,'Dorris Cassin I','miller.kuhn@example.com','2020-07-07 00:05:18','$2y$10$E3gToH8S6vYbLzM5imu0jOWmOqzC8SKaFwRen5abhb9AVbDR05SdG','cfWudojHtq','2020-07-07 00:05:39','2020-07-07 00:05:39'),(64,'Ervin Rosenbaum Sr.','xoberbrunner@example.org','2020-07-07 00:05:18','$2y$10$necy7jpreFfym7.GYM14lOm7WVjTCF23UkhgdHQmAlGArJWi67/Cu','L9CprEL6na','2020-07-07 00:05:39','2020-07-07 00:05:39'),(65,'Prof. Raquel Schinner III','julien28@example.com','2020-07-07 00:05:18','$2y$10$FzPb.A3cpb3ccvraKu/en..qR9c6Odtk7wYx1v.HRqyi1.nf3K6qG','nGKymSpyFw','2020-07-07 00:05:39','2020-07-07 00:05:39'),(66,'Ms. Violet Lueilwitz MD','wilderman.maynard@example.org','2020-07-07 00:05:18','$2y$10$SVi6hRnv5bA6KYP35.fM6O2.t4ug7Q6YISULwpoxzvrhcYpCIaS1K','W6neuoaXiD','2020-07-07 00:05:40','2020-07-07 00:05:40'),(67,'Colten Ward','fdicki@example.net','2020-07-07 00:05:18','$2y$10$4v1KpxD.IPsc1DwqsIdAOOthK6v5F23/uepOvv0jkP87ULvxzjE/C','V44wesx5rn','2020-07-07 00:05:40','2020-07-07 00:05:40'),(68,'Ms. Maureen Gleichner','schaefer.trystan@example.org','2020-07-07 00:05:18','$2y$10$aYafMktOWbrWmCbpbeR4IebKVjZq.hZpcbv2Iai.8kfQreNxRJPqu','VsNyXtpQc0','2020-07-07 00:05:40','2020-07-07 00:05:40'),(69,'Merl Walker','sheridan43@example.net','2020-07-07 00:05:18','$2y$10$BKgTIPiPaJ/UrBZVFdawwOqmkM.AxTktKTXrs.kK0j8fGLfqoKGK2','2dySi2Aovf','2020-07-07 00:05:40','2020-07-07 00:05:40'),(70,'Oliver Streich','bayer.alfredo@example.org','2020-07-07 00:05:18','$2y$10$3rpvsE5dVm/AjlKQ2N1DIuVlFCPAo5u5WJk/CXus0d1vtGgnHAQ0i','AXA2odCmpS','2020-07-07 00:05:41','2020-07-07 00:05:41'),(71,'Meda Dickinson','lynch.edward@example.org','2020-07-07 00:05:18','$2y$10$JpImOY3H3BtuC.p7RgzMjed/oReRYInLNusVBmdoyV2UBvK7Dhk4u','hSXRyVwEmj','2020-07-07 00:05:41','2020-07-07 00:05:41'),(72,'Mrs. Candice Cruickshank','fay.conor@example.com','2020-07-07 00:05:19','$2y$10$SJJSXxFTzlIIqQ7yudL2JOyY0gj9VyTnqLQSJrGHrVZl.8djXxYju','9Y5kt1pa13','2020-07-07 00:05:41','2020-07-07 00:05:41'),(73,'Newell Bernier','anabel.kirlin@example.com','2020-07-07 00:05:19','$2y$10$hGyf8VK9mrrjgyP6l.rZpegIFJWo1AhlSmo61ARksiXBiJybadWEu','tYfyoVm4r9','2020-07-07 00:05:41','2020-07-07 00:05:41'),(74,'Trey Adams PhD','smith.maxime@example.net','2020-07-07 00:05:19','$2y$10$y7EQQwe1FsL5aSvVWw6R6.I42tTaPyLf6fX21N2KStsCNFtCIF/ne','NwyvUm1MSN','2020-07-07 00:05:42','2020-07-07 00:05:42'),(75,'Wendell Jacobi','abbott.okey@example.com','2020-07-07 00:05:19','$2y$10$VKN/nL3L/jfyONg6Ureb6OHEcYUDtd3G4.jhioWENwjdYMD0QDdy2','hlXtbDLAkP','2020-07-07 00:05:42','2020-07-07 00:05:42'),(76,'Orion Olson DDS','smith.toy@example.com','2020-07-07 00:05:19','$2y$10$q1/T5OagDH08WnMTKSkHKushop1UaeCDTyq7QDZQbxdB6W8RfU3zS','mRcOb7uUU1','2020-07-07 00:05:42','2020-07-07 00:05:42'),(77,'Prof. Leone Koss','alexandrine.schulist@example.net','2020-07-07 00:05:19','$2y$10$uTII.EUBfeSk9olOZxrLre6no9BwPur89zyOMhQmqtLMYKaarawnm','A1DrFMXr94','2020-07-07 00:05:42','2020-07-07 00:05:42'),(78,'Ursula Reilly','nigel85@example.com','2020-07-07 00:05:19','$2y$10$h2VDsKncQVxfgvu88qmEhu/gCEKc73t9nXU5Qsg9Nt4OR8p3R20Ke','beGPc2WPjE','2020-07-07 00:05:43','2020-07-07 00:05:43'),(79,'Mrs. Gisselle Heidenreich','kareem.baumbach@example.com','2020-07-07 00:05:19','$2y$10$BtzX7PIhmmN2eYIdNidG3Ogfb6Z68Oj3BtMwSR/wJsNdQK1n3PhhK','DFTAljLDJn','2020-07-07 00:05:43','2020-07-07 00:05:43'),(80,'Dennis Moore','arnaldo.little@example.net','2020-07-07 00:05:19','$2y$10$eeAREmLLDmHKhqjP3878rOWhkYzpE9towpxbi6MiPnRNfo/3pY00q','GVWpa2ToJZ','2020-07-07 00:05:44','2020-07-07 00:05:44'),(81,'Norbert O\'Kon','schoen.micah@example.com','2020-07-07 00:05:19','$2y$10$cIBLDxXvH6uwllhr7Zjgtuy3YqSt.4sX/cMJKIDo7CJFAF29LJVY.','aNcgIXsO9b','2020-07-07 00:05:44','2020-07-07 00:05:44'),(82,'Trevion Cummings','zstoltenberg@example.net','2020-07-07 00:05:19','$2y$10$kXhm7zyf/yjnPfdrfIOREexiZEv37KkiH1L3VnAXD04I4Kp4h2/FC','knkkKSRXgA','2020-07-07 00:05:44','2020-07-07 00:05:44'),(83,'Sylvia Gaylord','ltowne@example.net','2020-07-07 00:05:19','$2y$10$0Haymt8BeLyejrAdcQOHeOZUx6L.Lw1m7X6SR1xzG2DdjIAyzIGRK','RauQmxxLXn','2020-07-07 00:05:44','2020-07-07 00:05:44'),(84,'Madaline Sawayn Jr.','alvina.simonis@example.net','2020-07-07 00:05:19','$2y$10$pYaOccirG4thccZOUbs3UedGLqcl0GN/ZASBvOMG.HH4Dge/jQ16O','jnQs0AGvOG','2020-07-07 00:05:44','2020-07-07 00:05:44'),(85,'Paxton Bergnaum','selina15@example.org','2020-07-07 00:05:19','$2y$10$VzNE8rCvYO82mq4w3y8Df.2VAm1Og6zVkZvns0.UoOa4tuw9.2VhC','C17wlZjlEE','2020-07-07 00:05:45','2020-07-07 00:05:45'),(86,'Alfredo Feest','fae.ward@example.net','2020-07-07 00:05:19','$2y$10$0yDTc8rZCvvrym8PltNYz.fF5I09zjtClzog..hkpJGjQBF82Pg6S','8KYcLHQ5DT','2020-07-07 00:05:45','2020-07-07 00:05:45'),(87,'Aniyah Nader','salvador.rowe@example.org','2020-07-07 00:05:19','$2y$10$CBQmE9S5SeTWHUrFZHwRdu4B8inIBOpfkeJW.9UA63rOuiF4h1ClG','Yzs0L1xgsE','2020-07-07 00:05:45','2020-07-07 00:05:45'),(88,'Marjorie Bins','vschamberger@example.org','2020-07-07 00:05:19','$2y$10$DuMcL/MsPyCUds80vdtyXOPoEItZLQaUJGk0Uj/Ms.JZjgLRfqw5S','db0OJp743h','2020-07-07 00:05:45','2020-07-07 00:05:45'),(89,'Austin Gorczany III','schmeler.clemens@example.net','2020-07-07 00:05:19','$2y$10$DJz3xm.A1zLnIDfOOD6R4uJrJzy4omTCR.i2xHgje9GlJAhun.ShO','7yad5BPi4T','2020-07-07 00:05:46','2020-07-07 00:05:46'),(90,'Miss Jewel Russel','vella65@example.com','2020-07-07 00:05:19','$2y$10$8CmcNA8J1jNtKLyeHZeYZuiSq81KRIna2NtSPL6D3L4Yth3b1NEQu','FdeXVnbYfh','2020-07-07 00:05:46','2020-07-07 00:05:46'),(91,'Alvah Wisozk','jakubowski.adan@example.org','2020-07-07 00:05:20','$2y$10$iQbdjnYH6F4J/9qZIF1Yb.o6Lfnz6H5q5WOx9cU0ogIXgZbpegtQ.','ZyzOC92cLs','2020-07-07 00:05:47','2020-07-07 00:05:47'),(92,'Alba Schaefer','orn.pansy@example.org','2020-07-07 00:05:20','$2y$10$HKH3WwbJIAM8A/.iIW7SKOFfyreyxQzUSB/c7tawTwvcGgZPbqGj2','JhEsnVfGQw','2020-07-07 00:05:47','2020-07-07 00:05:47'),(93,'Skye Reinger','kory07@example.net','2020-07-07 00:05:20','$2y$10$dI1BRWBm3wJAMvAvUVSXE.OOzLZDbjEue5hqDUEJ0Yv9RSIwXF04C','pE0uQN1NyK','2020-07-07 00:05:47','2020-07-07 00:05:47'),(94,'Celestine Corwin','rath.loyal@example.com','2020-07-07 00:05:20','$2y$10$9/4esxigr2QofMxcC9nj9.idD56lFryznZ1sSjmBhoppEMYKPgu1W','o31ZwOrZir','2020-07-07 00:05:48','2020-07-07 00:05:48'),(95,'Adelbert Wolf II','moises44@example.net','2020-07-07 00:05:20','$2y$10$eMxrfDquF3nr2VqPTMqnIeGnjWpQwvZJ/SmAWBe1Yy4ecvILLXj6e','xjr6JYzT8I','2020-07-07 00:05:48','2020-07-07 00:05:48'),(96,'Dr. Devyn Johnston','joanne.boehm@example.org','2020-07-07 00:05:20','$2y$10$11a4tuhA0xq1sQAdAw/UcuHsDXEQ4pm0iKpOT17ATXp3cJFbXccca','Rb9z2qYG25','2020-07-07 00:05:48','2020-07-07 00:05:48'),(97,'Lexus Purdy','ayden51@example.com','2020-07-07 00:05:20','$2y$10$dkyIuFqC6bvnF9NuCdVeVOMttwuw46EHW3Kh0oRL1qhQ.qdtQulNi','fw4edj6C2K','2020-07-07 00:05:48','2020-07-07 00:05:48'),(98,'Kevon Waelchi Jr.','emerson49@example.com','2020-07-07 00:05:20','$2y$10$y5xpjQcF/3Uggf7KHY4J1eoaUogB6FqHH5q.7SwR.YksqwqIumswi','qwGXA7TmcE','2020-07-07 00:05:49','2020-07-07 00:05:49'),(99,'Brandon Schroeder','angela73@example.com','2020-07-07 00:05:20','$2y$10$Bt33JRses/pFU.nHJmaDDuOODRurxtxIWyTHowyG5.giQG9wBisEG','ugCNSIoJg0','2020-07-07 00:05:49','2020-07-07 00:05:49'),(100,'Jillian Flatley V','metz.leilani@example.com','2020-07-07 00:05:20','$2y$10$zCxfrripeNCaRJSUbEkMW.TXiDFjLff8S9cNkPd19kex5U/GpOEVK','nGA7qKiaj3','2020-07-07 00:05:49','2020-07-07 00:05:49'),(101,'Vergie Macejkovic Sr.','treutel.wilfrid@example.net','2020-07-07 00:05:20','$2y$10$QqiZQGgaf0.2l9SLChAZPO188pb4jOxsGXHjbsDs/e/1qqvtBlKU6','UhwOdWXNdQ','2020-07-07 00:05:49','2020-07-07 00:05:49');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'application'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-18  1:02:16
