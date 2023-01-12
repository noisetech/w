/*
SQLyog Ultimate v12.5.1 (32 bit)
MySQL - 5.7.33 : Database - emonev_laravel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`emonev_laravel` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `emonev_laravel`;

/*Table structure for table `akun_rekening` */

DROP TABLE IF EXISTS `akun_rekening`;

CREATE TABLE `akun_rekening` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian_akun` text COLLATE utf8mb4_unicode_ci,
  `deskripsi_akun` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `akun_rekening` */

insert  into `akun_rekening`(`id`,`kode`,`uraian_akun`,`deskripsi_akun`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'4','PENDAPATAN DAERAH 4','Digunakan untuk mencatat penerimaan oleh bendahara umum daerah atau oleh entitas pemerintah lainnya yang menambah saldo anggaran lebih dalam periode tahun anggaran yang bersangkutan yang menjadi hak pemerintah, dan tidak perlu dibayar kembali oleh pemerintah.',NULL,'2022-12-09 16:22:36','2022-12-09 16:22:36');

/*Table structure for table `bidang` */

DROP TABLE IF EXISTS `bidang`;

CREATE TABLE `bidang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `urusan_id` bigint(20) unsigned NOT NULL,
  `kode` text COLLATE utf8mb4_unicode_ci,
  `nomenklatur` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bidang_urusan_id_foreign` (`urusan_id`),
  CONSTRAINT `bidang_urusan_id_foreign` FOREIGN KEY (`urusan_id`) REFERENCES `urusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `bidang` */

insert  into `bidang`(`id`,`urusan_id`,`kode`,`nomenklatur`,`deleted_at`,`created_at`,`updated_at`) values 
(1,1,'1.1','Ut numquam tempore',NULL,'2022-12-09 16:21:17','2022-12-09 16:21:17');

/*Table structure for table `detail_ket_sub_dpa` */

DROP TABLE IF EXISTS `detail_ket_sub_dpa`;

CREATE TABLE `detail_ket_sub_dpa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ket_sub_dpa_id` bigint(20) unsigned NOT NULL,
  `sub_rincian_objek` bigint(20) DEFAULT NULL,
  `jumlah_anggaran` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detail_ket_sub_dpa` */

insert  into `detail_ket_sub_dpa`(`id`,`ket_sub_dpa_id`,`sub_rincian_objek`,`jumlah_anggaran`,`deleted_at`,`created_at`,`updated_at`) values 
(1,1,1,30000000,NULL,NULL,NULL);

/*Table structure for table `dinas` */

DROP TABLE IF EXISTS `dinas`;

CREATE TABLE `dinas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `wilayah_id` bigint(20) unsigned NOT NULL,
  `dinas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` longtext COLLATE utf8mb4_unicode_ci,
  `icon` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dinas_wilayah_id_foreign` (`wilayah_id`),
  CONSTRAINT `dinas_wilayah_id_foreign` FOREIGN KEY (`wilayah_id`) REFERENCES `wilayah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `dinas` */

insert  into `dinas`(`id`,`wilayah_id`,`dinas`,`logo`,`icon`,`created_at`,`updated_at`) values 
(1,1,'Dinas Parawisata','file-logo-dinas4698858aa45b065b1f65488ac7e7e7ef-6393603692a391670602806221209.png','file-icon-dinas271ff005eb5e935f6ae7d140e6216503-639360369385e1670602806221209.png','2022-12-09 16:20:06','2022-12-09 16:20:06'),
(2,1,'Dinas Parawisata','file-logo-dinas5edfbb6a3ab15005fe9743bb998230de-6396b5394ee0f1670821177221212.png','file-icon-dinasbdf0fca9c2e62c79b980d79f69f40fbb-6396b5394fe9e1670821177221212.png','2022-12-12 04:59:37','2022-12-12 04:59:37');

/*Table structure for table `dpa` */

DROP TABLE IF EXISTS `dpa`;

CREATE TABLE `dpa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `no_dpa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_id` bigint(20) unsigned DEFAULT NULL,
  `dinas_id` bigint(20) unsigned DEFAULT NULL,
  `urusan_id` bigint(20) unsigned DEFAULT NULL,
  `bidang_id` bigint(20) unsigned DEFAULT NULL,
  `program_id` bigint(20) unsigned DEFAULT NULL,
  `kegiatan_id` bigint(20) unsigned DEFAULT NULL,
  `organisasi_id` bigint(20) unsigned DEFAULT NULL,
  `unit_id` bigint(20) unsigned DEFAULT NULL,
  `sasaran_program` text COLLATE utf8mb4_unicode_ci,
  `capaian_program` longtext COLLATE utf8mb4_unicode_ci,
  `alokasi_tahun` longtext COLLATE utf8mb4_unicode_ci,
  `indikator_kinerja` longtext COLLATE utf8mb4_unicode_ci,
  `kelompok_sasaran_kegiatan` longtext COLLATE utf8mb4_unicode_ci,
  `rencana_penarikan` longtext COLLATE utf8mb4_unicode_ci,
  `tim_anggaran` longtext COLLATE utf8mb4_unicode_ci,
  `ttd_dpa` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dpa_tahun_id_foreign` (`tahun_id`),
  KEY `dpa_dinas_id_foreign` (`dinas_id`),
  KEY `dpa_urusan_id_foreign` (`urusan_id`),
  KEY `dpa_bidang_id_foreign` (`bidang_id`),
  KEY `dpa_program_id_foreign` (`program_id`),
  KEY `dpa_kegiatan_id_foreign` (`kegiatan_id`),
  KEY `dpa_organisasi_id_foreign` (`organisasi_id`),
  KEY `dpa_unit_id_foreign` (`unit_id`),
  CONSTRAINT `dpa_bidang_id_foreign` FOREIGN KEY (`bidang_id`) REFERENCES `bidang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dpa_dinas_id_foreign` FOREIGN KEY (`dinas_id`) REFERENCES `dinas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dpa_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dpa_organisasi_id_foreign` FOREIGN KEY (`organisasi_id`) REFERENCES `organisasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dpa_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dpa_tahun_id_foreign` FOREIGN KEY (`tahun_id`) REFERENCES `tahun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dpa_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dpa_urusan_id_foreign` FOREIGN KEY (`urusan_id`) REFERENCES `urusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `dpa` */

insert  into `dpa`(`id`,`no_dpa`,`tahun_id`,`dinas_id`,`urusan_id`,`bidang_id`,`program_id`,`kegiatan_id`,`organisasi_id`,`unit_id`,`sasaran_program`,`capaian_program`,`alokasi_tahun`,`indikator_kinerja`,`kelompok_sasaran_kegiatan`,`rencana_penarikan`,`tim_anggaran`,`ttd_dpa`,`created_at`,`updated_at`) values 
(1,'90878',1,1,1,1,1,1,1,1,'f,n sfm,f jkdfg\r\n','dn sfsdfmjv asdsad','msa,d amdlak oamds','asndha iandiasd ','j dhasd ads ','smnd sknf sf','nsd fmnsfd','adk adsna djasd',NULL,NULL);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `jenis_rekening` */

DROP TABLE IF EXISTS `jenis_rekening`;

CREATE TABLE `jenis_rekening` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kelompok_rekening_id` bigint(20) unsigned NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian_akun` text COLLATE utf8mb4_unicode_ci,
  `deskripsi_akun` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jenis_rekening_kelompok_rekening_id_foreign` (`kelompok_rekening_id`),
  CONSTRAINT `jenis_rekening_kelompok_rekening_id_foreign` FOREIGN KEY (`kelompok_rekening_id`) REFERENCES `kelompok_rekening` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jenis_rekening` */

insert  into `jenis_rekening`(`id`,`kelompok_rekening_id`,`kode`,`uraian_akun`,`deskripsi_akun`,`created_at`,`updated_at`) values 
(1,1,'1.1.01','PENDAPATAN DAERAH 7','Quis ipsum sint dolo','2022-12-09 16:23:47','2022-12-09 16:23:47');

/*Table structure for table `kegiatan` */

DROP TABLE IF EXISTS `kegiatan`;

CREATE TABLE `kegiatan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) unsigned NOT NULL,
  `kode` text COLLATE utf8mb4_unicode_ci,
  `nomenklatur` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kegiatan_program_id_foreign` (`program_id`),
  CONSTRAINT `kegiatan_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `kegiatan` */

insert  into `kegiatan`(`id`,`program_id`,`kode`,`nomenklatur`,`deleted_at`,`created_at`,`updated_at`) values 
(1,1,'1.1.01.05','Libero labore simili',NULL,'2022-12-09 16:21:44','2022-12-09 16:21:44');

/*Table structure for table `kelompok_rekening` */

DROP TABLE IF EXISTS `kelompok_rekening`;

CREATE TABLE `kelompok_rekening` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `akun_rekening_id` bigint(20) unsigned NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian_akun` text COLLATE utf8mb4_unicode_ci,
  `deskripsi_akun` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kelompok_rekening_akun_rekening_id_foreign` (`akun_rekening_id`),
  CONSTRAINT `kelompok_rekening_akun_rekening_id_foreign` FOREIGN KEY (`akun_rekening_id`) REFERENCES `akun_rekening` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `kelompok_rekening` */

insert  into `kelompok_rekening`(`id`,`akun_rekening_id`,`kode`,`uraian_akun`,`deskripsi_akun`,`created_at`,`updated_at`) values 
(1,1,'1.1','PENDAPATAN DAERAH','bjkjlkdalksdamd kadnajknfasf','2022-12-09 16:23:33','2022-12-09 16:23:33');

/*Table structure for table `ket_sub_dpa` */

DROP TABLE IF EXISTS `ket_sub_dpa`;

CREATE TABLE `ket_sub_dpa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sub_dpa_id` bigint(20) unsigned NOT NULL,
  `akun` bigint(20) NOT NULL,
  `kelompok` bigint(20) NOT NULL,
  `jenis` bigint(20) NOT NULL,
  `objek` bigint(20) NOT NULL,
  `rincian_objek` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ket_sub_dpa_sub_dpa_id_foreign` (`sub_dpa_id`),
  CONSTRAINT `ket_sub_dpa_sub_dpa_id_foreign` FOREIGN KEY (`sub_dpa_id`) REFERENCES `sub_dpa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ket_sub_dpa` */

insert  into `ket_sub_dpa`(`id`,`sub_dpa_id`,`akun`,`kelompok`,`jenis`,`objek`,`rincian_objek`,`deleted_at`,`created_at`,`updated_at`) values 
(1,1,1,1,1,1,1,NULL,NULL,NULL);

/*Table structure for table `komponen_pembangunan` */

DROP TABLE IF EXISTS `komponen_pembangunan`;

CREATE TABLE `komponen_pembangunan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent` bigint(20) DEFAULT NULL,
  `komponen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `komponen_pembangunan` */

insert  into `komponen_pembangunan`(`id`,`parent`,`komponen`,`created_at`,`updated_at`) values 
(1,0,'Minim est sint elig','2022-12-09 16:25:55','2022-12-09 16:25:55'),
(2,0,'Ullamco qui sit sint','2022-12-09 16:26:05','2022-12-09 16:26:05'),
(3,1,'Unde dolorem quis ve','2022-12-09 16:26:14','2022-12-09 16:26:14'),
(4,2,'Perferendis voluptat','2022-12-09 16:26:24','2022-12-09 16:26:24'),
(5,2,'Occaecat in dolorem','2022-12-09 16:26:34','2022-12-09 16:26:34');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_100000_create_password_resets_table',1),
(2,'2019_08_19_000000_create_failed_jobs_table',1),
(3,'2019_12_14_000001_create_personal_access_tokens_table',1),
(4,'2022_11_25_132918_create_permission_tables',1),
(5,'2022_11_28_000455_create_tahun_table',1),
(6,'2022_11_28_000615_create_wilayah_table',1),
(7,'2022_11_28_044238_create_dinas_table',1),
(8,'2022_11_28_044252_create_users_table',1),
(9,'2022_11_30_232455_create_unit_table',1),
(10,'2022_11_30_232719_create_urusan_table',1),
(11,'2022_11_30_232739_create_bidang_table',1),
(12,'2022_11_30_232900_create_program_table',1),
(13,'2022_11_30_233111_create_kegiatan_table',1),
(14,'2022_11_30_233230_create_organisasi_table',1),
(15,'2022_11_30_234013_create_sumber_dana',1),
(16,'2022_11_30_234217_create_satuan_table',1),
(17,'2022_11_30_234416_create_sub_kegiatan_table',1),
(18,'2022_12_01_085308_create_akun_rekening_table',1),
(19,'2022_12_01_085456_create_kelompok_rekening_table',1),
(20,'2022_12_01_085607_create_jenis_rekening_table',1),
(21,'2022_12_01_085636_create_objek_rekening_table',1),
(22,'2022_12_01_085710_create_rincian_objek_rekening_table',1),
(23,'2022_12_01_085759_create_sub_rincian_objek_rekening_table',1),
(24,'2022_12_01_162229_create_dpa_table',1),
(25,'2022_12_02_193942_create_sub_dpa',1),
(26,'2022_12_05_073452_create_komponen_pembangunan',1),
(27,'2022_12_05_090848_create_ket_sub_dpa_table',1),
(28,'2022_12_05_090907_create_detail_ket_sub_dpa',1),
(29,'2022_12_07_045418_create_rencana_pembangunan',1),
(30,'2022_12_07_050134_create_det_rencana_pembangunan',1),
(31,'2022_12_09_110741_create_dokumentasi_pekerjaan_pembangunan',1);

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values 
(1,'App\\Models\\User',1);

/*Table structure for table `objek_rekening` */

DROP TABLE IF EXISTS `objek_rekening`;

CREATE TABLE `objek_rekening` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jenis_rekening_id` bigint(20) unsigned NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian_akun` text COLLATE utf8mb4_unicode_ci,
  `deskripsi_akun` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `objek_rekening_jenis_rekening_id_foreign` (`jenis_rekening_id`),
  CONSTRAINT `objek_rekening_jenis_rekening_id_foreign` FOREIGN KEY (`jenis_rekening_id`) REFERENCES `jenis_rekening` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `objek_rekening` */

insert  into `objek_rekening`(`id`,`jenis_rekening_id`,`kode`,`uraian_akun`,`deskripsi_akun`,`created_at`,`updated_at`) values 
(1,1,'1.1.01.05','PENDAPATAN DAERAH 9','Pellentesque in ipsum id orci porta dapibus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.','2022-12-09 16:24:08','2022-12-09 16:24:08');

/*Table structure for table `organisasi` */

DROP TABLE IF EXISTS `organisasi`;

CREATE TABLE `organisasi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bidang_id` bigint(20) unsigned NOT NULL,
  `kode` text COLLATE utf8mb4_unicode_ci,
  `nomenklatur` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organisasi_bidang_id_foreign` (`bidang_id`),
  CONSTRAINT `organisasi_bidang_id_foreign` FOREIGN KEY (`bidang_id`) REFERENCES `bidang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `organisasi` */

insert  into `organisasi`(`id`,`bidang_id`,`kode`,`nomenklatur`,`deleted_at`,`created_at`,`updated_at`) values 
(1,1,'1.01.0005.08.09','Sit dolore aperiam d',NULL,'2022-12-09 16:25:22','2022-12-09 16:25:22');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
(1,'permission-index','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(2,'permission-create','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(3,'permission-edit','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(4,'permission-delete','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(5,'role-index','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(6,'role-create','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(7,'role-edit','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(8,'role-detail','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(9,'role-delete','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(10,'user-index','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(11,'user-create','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(12,'user-edit','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(13,'user-delete','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(14,'tahun-index','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(15,'tahun-create','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(16,'tahun-edit','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(17,'tahun-delete','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(18,'wilayah-index','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(19,'wilayah-create','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(20,'wilayah-edit','web','2022-12-09 16:17:54','2022-12-09 16:17:54'),
(21,'wilayah-delete','web','2022-12-09 16:17:54','2022-12-09 16:17:54');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `program` */

DROP TABLE IF EXISTS `program`;

CREATE TABLE `program` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_bidang` bigint(20) unsigned NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomenklatur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `program_id_bidang_foreign` (`id_bidang`),
  CONSTRAINT `program_id_bidang_foreign` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `program` */

insert  into `program`(`id`,`id_bidang`,`kode`,`nomenklatur`,`deleted_at`,`created_at`,`updated_at`) values 
(1,1,'1.1.01','Sit dolore aperiam d',NULL,'2022-12-09 16:21:31','2022-12-09 16:21:31');

/*Table structure for table `rincian_objek_rekening` */

DROP TABLE IF EXISTS `rincian_objek_rekening`;

CREATE TABLE `rincian_objek_rekening` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `objek_rekening_id` bigint(20) unsigned NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian_akun` text COLLATE utf8mb4_unicode_ci,
  `deskripsi_akun` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rincian_objek_rekening_objek_rekening_id_foreign` (`objek_rekening_id`),
  CONSTRAINT `rincian_objek_rekening_objek_rekening_id_foreign` FOREIGN KEY (`objek_rekening_id`) REFERENCES `objek_rekening` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rincian_objek_rekening` */

insert  into `rincian_objek_rekening`(`id`,`objek_rekening_id`,`kode`,`uraian_akun`,`deskripsi_akun`,`created_at`,`updated_at`) values 
(1,1,'1.1.01.05.009','PENDAPATAN DAERAH 4','Est asperiores labo','2022-12-09 16:24:28','2022-12-09 16:24:28');

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`) values 
(1,1),
(2,1),
(3,1),
(4,1),
(5,1),
(6,1),
(7,1),
(8,1),
(9,1),
(10,1),
(11,1),
(12,1),
(13,1),
(14,1),
(15,1),
(16,1),
(17,1),
(18,1),
(19,1),
(20,1),
(21,1);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
(1,'admin','web','2022-12-09 16:17:54','2022-12-09 16:17:54');

/*Table structure for table `satuan` */

DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `satuan` */

insert  into `satuan`(`id`,`satuan`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Document',NULL,'2022-12-09 16:20:23','2022-12-09 16:20:23');

/*Table structure for table `sub_dpa` */

DROP TABLE IF EXISTS `sub_dpa`;

CREATE TABLE `sub_dpa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dpa_id` bigint(20) unsigned NOT NULL,
  `sub_kegiatan_id` bigint(20) unsigned NOT NULL,
  `sumber_dana_id` bigint(20) unsigned NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` int(11) NOT NULL,
  `waktu_pelaksanaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_dpa_dpa_id_foreign` (`dpa_id`),
  KEY `sub_dpa_sub_kegiatan_id_foreign` (`sub_kegiatan_id`),
  KEY `sub_dpa_sumber_dana_id_foreign` (`sumber_dana_id`),
  CONSTRAINT `sub_dpa_dpa_id_foreign` FOREIGN KEY (`dpa_id`) REFERENCES `dpa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sub_dpa_sub_kegiatan_id_foreign` FOREIGN KEY (`sub_kegiatan_id`) REFERENCES `sub_kegiatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sub_dpa_sumber_dana_id_foreign` FOREIGN KEY (`sumber_dana_id`) REFERENCES `sub_kegiatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sub_dpa` */

insert  into `sub_dpa`(`id`,`dpa_id`,`sub_kegiatan_id`,`sumber_dana_id`,`lokasi`,`target`,`waktu_pelaksanaan`,`keterangan`,`deleted_at`,`created_at`,`updated_at`) values 
(1,1,1,1,'jnfmksjd fsjfns dfjsfs fdlsdifj',100,'dkmsf','zsjhdfs fds ',NULL,NULL,NULL);

/*Table structure for table `sub_kegiatan` */

DROP TABLE IF EXISTS `sub_kegiatan`;

CREATE TABLE `sub_kegiatan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kegiatan_id` bigint(20) unsigned NOT NULL,
  `satuan_id` bigint(20) unsigned NOT NULL,
  `kode` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomenklatur` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `kinerja` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `indikator` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_kegiatan_kegiatan_id_foreign` (`kegiatan_id`),
  CONSTRAINT `sub_kegiatan_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sub_kegiatan` */

insert  into `sub_kegiatan`(`id`,`kegiatan_id`,`satuan_id`,`kode`,`nomenklatur`,`kinerja`,`indikator`,`created_at`,`updated_at`) values 
(1,1,1,'1.1.01.05.009','Ut numquam tempore jkmk kokm','Est dolor omnis labo','Totam excepturi aut','2022-12-09 16:22:13','2022-12-09 16:22:13');

/*Table structure for table `sub_rincian_objek_rekening` */

DROP TABLE IF EXISTS `sub_rincian_objek_rekening`;

CREATE TABLE `sub_rincian_objek_rekening` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rincian_objek_rekening_id` bigint(20) unsigned NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian_akun` text COLLATE utf8mb4_unicode_ci,
  `deskripsi_akun` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_rincian_objek_rekening_rincian_objek_rekening_id_foreign` (`rincian_objek_rekening_id`),
  CONSTRAINT `sub_rincian_objek_rekening_rincian_objek_rekening_id_foreign` FOREIGN KEY (`rincian_objek_rekening_id`) REFERENCES `rincian_objek_rekening` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sub_rincian_objek_rekening` */

insert  into `sub_rincian_objek_rekening`(`id`,`rincian_objek_rekening_id`,`kode`,`uraian_akun`,`deskripsi_akun`,`created_at`,`updated_at`) values 
(1,1,'1.1.01.05.009.100','PENDAPATAN DAERAH 5','Quis ipsum sint dolo','2022-12-09 16:24:52','2022-12-09 16:24:52');

/*Table structure for table `sumber_dana` */

DROP TABLE IF EXISTS `sumber_dana`;

CREATE TABLE `sumber_dana` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sumber_dana` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sumber_dana` */

insert  into `sumber_dana`(`id`,`sumber_dana`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'APBD',NULL,'2022-12-09 16:20:41','2022-12-09 16:20:41');

/*Table structure for table `tahun` */

DROP TABLE IF EXISTS `tahun`;

CREATE TABLE `tahun` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tahun` */

insert  into `tahun`(`id`,`tahun`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'2022',NULL,'2022-12-09 16:18:26','2022-12-09 16:18:26');

/*Table structure for table `unit` */

DROP TABLE IF EXISTS `unit`;

CREATE TABLE `unit` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `organisasi_id` bigint(20) unsigned NOT NULL,
  `kode` text COLLATE utf8mb4_unicode_ci,
  `nomenklatur` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `unit` */

insert  into `unit`(`id`,`organisasi_id`,`kode`,`nomenklatur`,`deleted_at`,`created_at`,`updated_at`) values 
(1,1,'1.1.01.05.09.009.90','Libero labore simili',NULL,'2022-12-09 16:25:39','2022-12-09 16:25:39');

/*Table structure for table `urusan` */

DROP TABLE IF EXISTS `urusan`;

CREATE TABLE `urusan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomenklatur` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `urusan` */

insert  into `urusan`(`id`,`kode`,`nomenklatur`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'1','URUSAN PEMERINTAHAN WAJIB  YANG BERKAITAN DENGAN PELAYANAN DASAR',NULL,'2022-12-09 16:21:04','2022-12-09 16:21:04');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dinas_id` bigint(20) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_dinas_id_foreign` (`dinas_id`),
  CONSTRAINT `users_dinas_id_foreign` FOREIGN KEY (`dinas_id`) REFERENCES `dinas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`dinas_id`,`remember_token`,`created_at`,`updated_at`) values 
(1,'admin','su@mail.com',NULL,'$2y$10$3kLmjR8vM4mPkWPX1qpiMuwwVybtfsc5oJ8Ooo9Sd0jbkkx27o2zS',1,NULL,'2022-12-09 16:17:54','2022-12-09 16:17:54');

/*Table structure for table `wilayah` */

DROP TABLE IF EXISTS `wilayah`;

CREATE TABLE `wilayah` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `wilayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wilayah` */

insert  into `wilayah`(`id`,`wilayah`,`deleted_at`,`created_at`,`updated_at`) values 
(1,'Lampung Barat',NULL,'2022-12-09 16:19:32','2022-12-09 16:19:32');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
