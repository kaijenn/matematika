/*
 Navicat Premium Dump SQL

 Source Server         : yoga
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : hrd

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 02/02/2025 23:43:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for karyawan
-- ----------------------------
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan`  (
  `id_karyawan` int NOT NULL AUTO_INCREMENT,
  `id_pelamar` int NULL DEFAULT NULL,
  `id_user` int NULL DEFAULT NULL,
  `gaji` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
INSERT INTO `karyawan` VALUES (1, 13, 1, '2000000');
INSERT INTO `karyawan` VALUES (2, 17, 6, '30000000');
INSERT INTO `karyawan` VALUES (3, 19, 11, '20000000');
INSERT INTO `karyawan` VALUES (4, 18, 8, '22');

-- ----------------------------
-- Table structure for level
-- ----------------------------
DROP TABLE IF EXISTS `level`;
CREATE TABLE `level`  (
  `id_level` int NOT NULL AUTO_INCREMENT,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_level`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of level
-- ----------------------------
INSERT INTO `level` VALUES (1, 'admin');
INSERT INTO `level` VALUES (2, 'hrd');
INSERT INTO `level` VALUES (3, 'pelamar');
INSERT INTO `level` VALUES (4, 'karyawan');

-- ----------------------------
-- Table structure for lowongan
-- ----------------------------
DROP TABLE IF EXISTS `lowongan`;
CREATE TABLE `lowongan`  (
  `id_lowongan` int NOT NULL AUTO_INCREMENT,
  `nama_lowongan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `backup_by` int NULL DEFAULT NULL,
  `backup_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_lowongan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of lowongan
-- ----------------------------
INSERT INTO `lowongan` VALUES (3, 'Manajemen1', 'bisa bacot123', NULL, NULL, 1, '2025-01-24 10:37:00', NULL, NULL);
INSERT INTO `lowongan` VALUES (4, 'Programmer', 'minimal umur 20, b', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `lowongan` VALUES (5, 'satpam', 'Berotot\r\nkekar\r\nganteng', NULL, NULL, 1, '2025-01-23 08:30:56', NULL, NULL);
INSERT INTO `lowongan` VALUES (6, 'Pemusik', 'bisa semua alat musik', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `lowongan` VALUES (7, 'Kurir', 'BISA BAWA SEMUA', NULL, NULL, 1, '2025-01-23 09:41:21', NULL, NULL);
INSERT INTO `lowongan` VALUES (8, 'boleh', 'boleh', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `lowongan` VALUES (9, 'Programmer SPH Jaya', 'Programmer SPH Jaya', '2025-02-02 08:50:03', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `lowongan` VALUES (10, 'kurir', 'bisa bawa zetex', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for lowongan_backup
-- ----------------------------
DROP TABLE IF EXISTS `lowongan_backup`;
CREATE TABLE `lowongan_backup`  (
  `id_lowongan` int NOT NULL AUTO_INCREMENT,
  `nama_lowongan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `backup_by` int NULL DEFAULT NULL,
  `backup_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_lowongan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of lowongan_backup
-- ----------------------------
INSERT INTO `lowongan_backup` VALUES (3, 'Manajemen1', 'bisa bacot', NULL, NULL);
INSERT INTO `lowongan_backup` VALUES (5, 'satpam', 'Berotot\r\nkekar\r\nganteng', NULL, NULL);
INSERT INTO `lowongan_backup` VALUES (7, 'Kurir', 'BISA BAWA SEMUA', NULL, NULL);

-- ----------------------------
-- Table structure for pelamar
-- ----------------------------
DROP TABLE IF EXISTS `pelamar`;
CREATE TABLE `pelamar`  (
  `id_pelamar` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `id_lowongan` int NULL DEFAULT NULL,
  `nama_pelamar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `umur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` enum('Pending','Diterima','Ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelamar`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pelamar
-- ----------------------------
INSERT INTO `pelamar` VALUES (8, 1, NULL, 'akhirnyaaa', '22', 'sad', NULL, NULL, NULL);
INSERT INTO `pelamar` VALUES (9, 1, 0, 'lupi', '2222', 'Tibana', NULL, NULL, NULL);
INSERT INTO `pelamar` VALUES (10, 1, 0, 'ngantuk bg', '44', 'nagoya', NULL, NULL, NULL);
INSERT INTO `pelamar` VALUES (11, 1, 0, 'ad', '123', 'asdad', NULL, NULL, NULL);
INSERT INTO `pelamar` VALUES (12, 1, 3, 'asdasd', '1231', 'asdasd', NULL, NULL, NULL);
INSERT INTO `pelamar` VALUES (13, 1, 3, 'epan kecap pahit', '17', 'Palazzo', '1737557558_db23b307662d0384bac2.pdf', '1737556323_91e7ce89b82180b9f5d8.pdf', 'Diterima');
INSERT INTO `pelamar` VALUES (14, 1, 5, 'epan kecap jr sdsa', '122', 'palajo ', NULL, NULL, 'Diterima');
INSERT INTO `pelamar` VALUES (15, 1, 5, 'kecap epan manis', '2322', 'Tibanaaa', NULL, NULL, 'Diterima');
INSERT INTO `pelamar` VALUES (16, 2, 3, 'Leonardo Chiki', '17', 'Sandon F 35', '1737636284_e677995e2ffa714c2147.pdf', '1737636284_b7e02f2a24d6d83a88f7.pdf', 'Diterima');
INSERT INTO `pelamar` VALUES (17, 3, 5, 'Testing aja ', '21', 'seruni', '1737645098_4f4855d876d5ee294abe.pdf', '1737645098_c3dcbc007a62fc3d681c.pdf', 'Diterima');
INSERT INTO `pelamar` VALUES (18, 8, 3, 'asd', '213', 'as', '1737646619_9528dde15058068547d3.pdf', '1737646619_fe21cd3567a62ac3372c.pdf', 'Diterima');
INSERT INTO `pelamar` VALUES (19, 11, 6, 'boba kecap', '22', 'Tibana', '1737646810_999f537fb2c271ec7ac8.pdf', '1737646810_20db00538b17d7ca5859.pdf', 'Diterima');
INSERT INTO `pelamar` VALUES (21, 8, 6, 'yogurt kecap', '1', 'Buana Bengkuang', '1738507386_ba3ed24ced067ac69285.pdf', '1738507386_c7c7d77b6a4d804ba232.pdf', 'Ditolak');

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `logo_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tab_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `login_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, '123', '1738506964_caff3c4ae828bc2b9aa9.png', '1738506964_62b8be9620bdfb1cf2ef.png', '1738506964_97dbe7223200a794390a.png', NULL, 1, NULL, NULL, '2025-02-02 10:42:37', NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nohp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_level` int NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin1', 'c4ca4238a0b923820dcc509a6f75849b', 'yogagautama12@gmail.com', NULL, 1, '1738514395_f99f28fcf139677b32ff.png');
INSERT INTO `user` VALUES (2, 'Leonardo Chiki', 'c4ca4238a0b923820dcc509a6f75849b', 'zentosph@gmail.com', '6282222222', 2, NULL);
INSERT INTO `user` VALUES (8, 'bobi', 'c4ca4238a0b923820dcc509a6f75849b', 'kaizenesia@gmail.com', '089522747300', 3, NULL);
INSERT INTO `user` VALUES (11, 'boba', 'c4ca4238a0b923820dcc509a6f75849b', 'kaizenesia@gmail.com', '085157206615', 3, NULL);
INSERT INTO `user` VALUES (12, 'mantap123', 'c4ca4238a0b923820dcc509a6f75849b', 'mantap123@gmail.com', '123', 2, NULL);

-- ----------------------------
-- Table structure for user_activity
-- ----------------------------
DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE `user_activity`  (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `time` datetime NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_log`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1286 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_activity
-- ----------------------------
INSERT INTO `user_activity` VALUES (686, 1, 'Masuk ke Log Activity', '2025-01-23 08:52:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (687, 1, 'Masuk ke User', '2025-01-23 08:52:51', NULL, NULL);
INSERT INTO `user_activity` VALUES (688, 1, 'Masuk ke Log Activity', '2025-01-23 08:52:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (689, 1, 'Masuk ke Log Activity', '2025-01-23 08:55:28', NULL, NULL);
INSERT INTO `user_activity` VALUES (690, 1, 'Masuk ke Log Activity', '2025-01-23 08:55:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (691, 1, 'Masuk ke Log Activity', '2025-01-23 08:56:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (692, 1, 'Masuk ke Log Activity', '2025-01-23 08:56:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (693, 1, 'Masuk ke Log Activity', '2025-01-23 08:56:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (694, 1, 'Masuk ke Dashboard', '2025-01-23 08:56:11', NULL, NULL);
INSERT INTO `user_activity` VALUES (695, 1, 'Masuk ke Login', '2025-01-23 09:00:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (696, 1, 'Masuk ke Register', '2025-01-23 09:04:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (697, 1, 'Masuk ke Login', '2025-01-23 09:04:51', NULL, NULL);
INSERT INTO `user_activity` VALUES (698, 4, 'Masuk ke Dashboard', '2025-01-23 09:04:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (699, 4, 'Masuk ke Dashboard', '2025-01-23 09:06:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (700, 4, 'Masuk ke Dashboard', '2025-01-23 09:06:39', NULL, NULL);
INSERT INTO `user_activity` VALUES (701, 4, 'Masuk ke Dashboard', '2025-01-23 09:07:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (702, 4, 'Masuk ke Lowongan', '2025-01-23 09:07:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (703, 4, 'Masuk ke Lamaran', '2025-01-23 09:07:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (704, 4, 'Masuk ke Lowongan', '2025-01-23 09:07:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (705, 4, 'Masuk ke Dashboard', '2025-01-23 09:07:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (706, 4, 'Masuk ke Login', '2025-01-23 09:07:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (707, 4, 'Masuk ke Register', '2025-01-23 09:07:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (708, 4, 'Masuk ke Login', '2025-01-23 09:08:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (709, 5, 'Masuk ke Dashboard', '2025-01-23 09:08:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (710, 5, 'Masuk ke Lowongan', '2025-01-23 09:08:19', NULL, NULL);
INSERT INTO `user_activity` VALUES (711, 5, 'Masuk ke Lamaran', '2025-01-23 09:08:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (712, 5, 'Masuk ke Lowongan', '2025-01-23 09:08:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (713, 5, 'Masuk ke Lowongan', '2025-01-23 09:09:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (714, 5, 'Masuk ke Lowongan', '2025-01-23 09:09:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (715, 5, 'Masuk ke Lowongan', '2025-01-23 09:09:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (716, 5, 'Masuk ke Lowongan', '2025-01-23 09:09:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (717, 5, 'Masuk ke Lowongan', '2025-01-23 09:09:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (718, 5, 'Masuk ke Lowongan', '2025-01-23 09:09:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (719, 5, 'Masuk ke Dashboard', '2025-01-23 09:10:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (720, 5, 'Masuk ke Login', '2025-01-23 09:10:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (721, 5, 'Masuk ke Register', '2025-01-23 09:10:40', NULL, NULL);
INSERT INTO `user_activity` VALUES (722, 5, 'Masuk ke Login', '2025-01-23 09:10:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (723, 6, 'Masuk ke Dashboard', '2025-01-23 09:10:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (724, 6, 'Masuk ke Lowongan', '2025-01-23 09:10:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (725, 6, 'Masuk ke Lamaran', '2025-01-23 09:10:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (726, 6, 'Masuk ke Lowongan', '2025-01-23 09:10:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (727, 6, 'Masuk ke Lamaran', '2025-01-23 09:11:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (728, 6, 'Masuk ke Login', '2025-01-23 09:11:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (729, 1, 'Masuk ke Dashboard', '2025-01-23 09:11:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (730, 1, 'Masuk ke Lamaran', '2025-01-23 09:11:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (731, 1, 'Masuk ke Lamaran', '2025-01-23 09:12:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (732, 1, 'Masuk ke Karyawan', '2025-01-23 09:12:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (733, 1, 'Masuk ke Karyawan', '2025-01-23 09:12:41', NULL, NULL);
INSERT INTO `user_activity` VALUES (734, 1, 'Masuk ke Karyawan', '2025-01-23 09:12:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (735, 1, 'Masuk ke Lamaran', '2025-01-23 09:12:53', NULL, NULL);
INSERT INTO `user_activity` VALUES (736, 1, 'Masuk ke Lowongan', '2025-01-23 09:12:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (737, 1, 'Masuk ke Edit Lowongan', '2025-01-23 09:12:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (738, 1, 'Masuk ke Lowongan', '2025-01-23 09:13:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (739, 1, 'Masuk ke Restore Edit Lowongan', '2025-01-23 09:13:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (740, 1, 'Masuk ke Lowongan', '2025-01-23 09:13:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (741, 1, 'Masuk ke Lowongan', '2025-01-23 09:13:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (742, 1, 'Masuk ke Soft Delete', '2025-01-23 09:13:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (743, 1, 'Masuk ke Lowongan', '2025-01-23 09:13:18', NULL, NULL);
INSERT INTO `user_activity` VALUES (744, 1, 'Masuk ke Karyawan', '2025-01-23 09:13:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (745, 1, 'Masuk ke User', '2025-01-23 09:13:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (746, 1, 'Masuk ke Tambah User', '2025-01-23 09:13:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (747, 1, 'Masuk ke User', '2025-01-23 09:13:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (748, 1, 'Masuk ke Edit User', '2025-01-23 09:13:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (749, 1, 'Masuk ke User', '2025-01-23 09:13:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (750, 1, 'Masuk ke User', '2025-01-23 09:13:46', NULL, NULL);
INSERT INTO `user_activity` VALUES (751, 1, 'Masuk ke Log Activity', '2025-01-23 09:13:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (752, 1, 'Masuk ke Lowongan', '2025-01-23 09:14:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (753, 1, 'Masuk ke Tambah Lowongan', '2025-01-23 09:14:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (754, 1, 'Masuk ke Lowongan', '2025-01-23 09:14:18', NULL, NULL);
INSERT INTO `user_activity` VALUES (755, 1, 'Masuk ke Dashboard', '2025-01-23 09:14:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (756, 1, 'Masuk ke Karyawan', '2025-01-23 09:14:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (757, 1, 'Masuk ke User', '2025-01-23 09:14:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (758, 1, 'Masuk ke Karyawan', '2025-01-23 09:14:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (759, 1, 'Masuk ke Setting', '2025-01-23 09:14:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (760, 1, 'Masuk ke Setting', '2025-01-23 09:14:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (761, 1, 'Masuk ke Login', '2025-01-23 09:14:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (762, 1, 'Masuk ke Login', '2025-01-23 09:16:41', NULL, NULL);
INSERT INTO `user_activity` VALUES (763, 1, 'Masuk ke Dashboard', '2025-01-23 09:16:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (764, 1, 'Masuk ke Dashboard', '2025-01-23 09:17:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (765, NULL, 'Masuk ke Login', '2025-01-23 09:18:01', NULL, NULL);
INSERT INTO `user_activity` VALUES (766, 1, 'Masuk ke Dashboard', '2025-01-23 09:18:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (767, NULL, 'Masuk ke Login', '2025-01-23 09:18:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (768, NULL, 'Masuk ke Register', '2025-01-23 09:19:19', NULL, NULL);
INSERT INTO `user_activity` VALUES (769, NULL, 'Masuk ke Login', '2025-01-23 09:19:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (770, NULL, 'Masuk ke Login', '2025-01-23 09:19:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (771, NULL, 'Masuk ke Login', '2025-01-23 09:19:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (772, NULL, 'Masuk ke Login', '2025-01-23 09:19:46', NULL, NULL);
INSERT INTO `user_activity` VALUES (773, NULL, 'Masuk ke Register', '2025-01-23 09:20:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (774, NULL, 'Masuk ke Login', '2025-01-23 09:20:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (775, NULL, 'Masuk ke Register', '2025-01-23 09:20:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (776, NULL, 'Masuk ke Login', '2025-01-23 09:20:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (777, 1, 'Masuk ke Dashboard', '2025-01-23 09:20:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (778, NULL, 'Masuk ke Login', '2025-01-23 09:20:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (779, NULL, 'Masuk ke Register', '2025-01-23 09:20:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (780, NULL, 'Masuk ke Login', '2025-01-23 09:21:09', NULL, NULL);
INSERT INTO `user_activity` VALUES (781, NULL, 'Masuk ke Register', '2025-01-23 09:21:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (782, NULL, 'Masuk ke Login', '2025-01-23 09:21:23', NULL, NULL);
INSERT INTO `user_activity` VALUES (783, NULL, 'Masuk ke Login', '2025-01-23 09:22:01', NULL, NULL);
INSERT INTO `user_activity` VALUES (784, NULL, 'Masuk ke Register', '2025-01-23 09:22:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (785, NULL, 'Masuk ke Login', '2025-01-23 09:22:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (786, NULL, 'Masuk ke Login', '2025-01-23 09:22:18', NULL, NULL);
INSERT INTO `user_activity` VALUES (787, 1, 'Masuk ke Dashboard', '2025-01-23 09:24:41', NULL, NULL);
INSERT INTO `user_activity` VALUES (788, 1, 'Masuk ke Karyawan', '2025-01-23 09:24:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (789, 1, 'Masuk ke User', '2025-01-23 09:24:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (790, 1, 'Masuk ke Tambah User', '2025-01-23 09:24:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (791, 1, 'Masuk ke User', '2025-01-23 09:24:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (792, NULL, 'Masuk ke Login', '2025-01-23 09:24:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (793, NULL, 'Masuk ke Register', '2025-01-23 09:24:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (794, NULL, 'Masuk ke Login', '2025-01-23 09:25:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (795, NULL, 'Masuk ke Login', '2025-01-23 09:26:40', NULL, NULL);
INSERT INTO `user_activity` VALUES (796, NULL, 'Masuk ke Register', '2025-01-23 09:26:46', NULL, NULL);
INSERT INTO `user_activity` VALUES (797, NULL, 'Masuk ke Login', '2025-01-23 09:26:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (798, NULL, 'Masuk ke Register', '2025-01-23 09:29:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (799, NULL, 'Masuk ke Login', '2025-01-23 09:30:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (800, NULL, 'Masuk ke Login', '2025-01-23 09:30:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (801, NULL, 'Masuk ke Register', '2025-01-23 09:30:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (802, NULL, 'Masuk ke Login', '2025-01-23 09:30:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (803, 8, 'Masuk ke Dashboard', '2025-01-23 09:33:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (804, 8, 'Masuk ke Lowongan', '2025-01-23 09:33:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (805, 8, 'Masuk ke Lamaran', '2025-01-23 09:33:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (806, 8, 'Masuk ke Lamaran', '2025-01-23 09:33:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (807, 8, 'Masuk ke Lamaran', '2025-01-23 09:33:39', NULL, NULL);
INSERT INTO `user_activity` VALUES (808, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (809, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (810, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (811, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (812, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (813, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (814, NULL, 'Masuk ke Login', '2025-01-23 09:36:17', NULL, NULL);
INSERT INTO `user_activity` VALUES (815, 8, 'Masuk ke Dashboard', '2025-01-23 09:36:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (816, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:28', NULL, NULL);
INSERT INTO `user_activity` VALUES (817, 8, 'Masuk ke Lowongan', '2025-01-23 09:36:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (818, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (819, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:40', NULL, NULL);
INSERT INTO `user_activity` VALUES (820, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:41', NULL, NULL);
INSERT INTO `user_activity` VALUES (821, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (822, 8, 'Masuk ke Dashboard', '2025-01-23 09:36:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (823, 8, 'Masuk ke Lowongan', '2025-01-23 09:36:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (824, 8, 'Masuk ke Lamaran', '2025-01-23 09:36:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (825, 8, 'Masuk ke Dashboard', '2025-01-23 09:37:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (826, NULL, 'Masuk ke Login', '2025-01-23 09:37:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (827, NULL, 'Masuk ke Register', '2025-01-23 09:37:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (828, NULL, 'Masuk ke Login', '2025-01-23 09:38:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (829, 10, 'Masuk ke Dashboard', '2025-01-23 09:38:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (830, 10, 'Masuk ke Lowongan', '2025-01-23 09:38:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (831, 10, 'Masuk ke Lowongan', '2025-01-23 09:38:53', NULL, NULL);
INSERT INTO `user_activity` VALUES (832, 10, 'Masuk ke Dashboard', '2025-01-23 09:38:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (833, NULL, 'Masuk ke Login', '2025-01-23 09:39:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (834, NULL, 'Masuk ke Register', '2025-01-23 09:39:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (835, NULL, 'Masuk ke Login', '2025-01-23 09:39:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (836, 11, 'Masuk ke Dashboard', '2025-01-23 09:39:46', NULL, NULL);
INSERT INTO `user_activity` VALUES (837, 11, 'Masuk ke Lowongan', '2025-01-23 09:39:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (838, 11, 'Masuk ke Lamaran', '2025-01-23 09:39:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (839, 11, 'Masuk ke Lowongan', '2025-01-23 09:39:51', NULL, NULL);
INSERT INTO `user_activity` VALUES (840, 11, 'Masuk ke Lamaran', '2025-01-23 09:40:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (841, NULL, 'Masuk ke Login', '2025-01-23 09:40:19', NULL, NULL);
INSERT INTO `user_activity` VALUES (842, 1, 'Masuk ke Dashboard', '2025-01-23 09:40:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (843, 1, 'Masuk ke Lamaran', '2025-01-23 09:40:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (844, 1, 'Masuk ke Lamaran', '2025-01-23 09:40:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (845, 1, 'Masuk ke Lowongan', '2025-01-23 09:40:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (846, 1, 'Masuk ke Tambah Lowongan', '2025-01-23 09:40:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (847, 1, 'Masuk ke Lowongan', '2025-01-23 09:41:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (848, 1, 'Masuk ke Edit Lowongan', '2025-01-23 09:41:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (849, 1, 'Masuk ke Lowongan', '2025-01-23 09:41:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (850, 1, 'Masuk ke Restore Edit Lowongan', '2025-01-23 09:41:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (851, 1, 'Masuk ke Lowongan', '2025-01-23 09:41:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (852, 1, 'Masuk ke Lowongan', '2025-01-23 09:41:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (853, 1, 'Masuk ke Soft Delete', '2025-01-23 09:41:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (854, 1, 'Masuk ke Lowongan', '2025-01-23 09:41:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (855, 1, 'Masuk ke Karyawan', '2025-01-23 09:41:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (856, 1, 'Masuk ke Karyawan', '2025-01-23 09:41:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (857, 1, 'Masuk ke User', '2025-01-23 09:41:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (858, 1, 'Masuk ke Tambah User', '2025-01-23 09:41:51', NULL, NULL);
INSERT INTO `user_activity` VALUES (859, 1, 'Masuk ke User', '2025-01-23 09:42:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (860, 1, 'Masuk ke Edit User', '2025-01-23 09:42:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (861, 1, 'Masuk ke User', '2025-01-23 09:42:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (862, 1, 'Masuk ke Setting', '2025-01-23 09:42:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (863, 1, 'Masuk ke Setting', '2025-01-23 09:42:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (864, 1, 'Masuk ke Log Activity', '2025-01-23 09:42:35', NULL, NULL);
INSERT INTO `user_activity` VALUES (865, 1, 'Masuk ke Lamaran', '2025-01-23 09:42:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (866, 1, 'Masuk ke Lowongan', '2025-01-23 09:42:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (867, 1, 'Masuk ke Lamaran', '2025-01-23 09:42:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (868, 1, 'Masuk ke Karyawan', '2025-01-23 09:43:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (869, 1, 'Masuk ke User', '2025-01-23 09:43:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (870, 1, 'Masuk ke Setting', '2025-01-23 09:43:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (871, 1, 'Masuk ke Soft Delete', '2025-01-23 09:43:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (872, 1, 'Masuk ke Karyawan', '2025-01-23 09:43:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (873, 1, 'Masuk ke Dashboard', '2025-01-23 09:43:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (874, NULL, 'Masuk ke Dashboard', '2025-01-24 09:41:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (875, NULL, 'Masuk ke Login', '2025-01-24 09:57:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (876, 1, 'Masuk ke Dashboard', '2025-01-24 09:58:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (877, 1, 'Masuk ke Dashboard', '2025-01-24 10:07:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (878, 1, 'Masuk ke Dashboard', '2025-01-24 10:07:28', NULL, NULL);
INSERT INTO `user_activity` VALUES (879, 1, 'Masuk ke Dashboard', '2025-01-24 10:07:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (880, 1, 'Masuk ke Dashboard', '2025-01-24 10:08:23', NULL, NULL);
INSERT INTO `user_activity` VALUES (881, 1, 'Masuk ke Dashboard', '2025-01-24 10:08:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (882, 1, 'Masuk ke Dashboard', '2025-01-24 10:08:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (883, 1, 'Masuk ke Dashboard', '2025-01-24 10:09:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (884, 1, 'Masuk ke Dashboard', '2025-01-24 10:09:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (885, 1, 'Masuk ke Dashboard', '2025-01-24 10:09:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (886, 1, 'Masuk ke Dashboard', '2025-01-24 10:10:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (887, 1, 'Masuk ke Lowongan', '2025-01-24 10:10:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (888, 1, 'Masuk ke Lowongan', '2025-01-24 10:11:09', NULL, NULL);
INSERT INTO `user_activity` VALUES (889, 1, 'Masuk ke Lowongan', '2025-01-24 10:11:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (890, 1, 'Masuk ke Lowongan', '2025-01-24 10:11:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (891, 1, 'Masuk ke Lowongan', '2025-01-24 10:11:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (892, 1, 'Masuk ke Lowongan', '2025-01-24 10:11:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (893, 1, 'Masuk ke Lowongan', '2025-01-24 10:11:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (894, 1, 'Masuk ke Lowongan', '2025-01-24 10:11:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (895, 1, 'Masuk ke Tambah Lowongan', '2025-01-24 10:11:39', NULL, NULL);
INSERT INTO `user_activity` VALUES (896, 1, 'Masuk ke Dashboard', '2025-01-24 10:11:46', NULL, NULL);
INSERT INTO `user_activity` VALUES (897, 1, 'Masuk ke Dashboard', '2025-01-24 10:11:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (898, 1, 'Masuk ke Dashboard', '2025-01-24 10:11:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (899, 1, 'Masuk ke Dashboard', '2025-01-24 10:11:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (900, 1, 'Masuk ke Lowongan', '2025-01-24 10:11:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (901, 1, 'Masuk ke Dashboard', '2025-01-24 10:11:53', NULL, NULL);
INSERT INTO `user_activity` VALUES (902, 1, 'Masuk ke Dashboard', '2025-01-24 10:11:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (903, 1, 'Masuk ke Dashboard', '2025-01-24 10:11:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (904, 1, 'Masuk ke Dashboard', '2025-01-24 10:13:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (905, 1, 'Masuk ke Lowongan', '2025-01-24 10:13:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (906, 1, 'Masuk ke Tambah Lowongan', '2025-01-24 10:13:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (907, 1, 'Masuk ke Lowongan', '2025-01-24 10:13:18', NULL, NULL);
INSERT INTO `user_activity` VALUES (908, 1, 'Masuk ke Tambah Lowongan', '2025-01-24 10:13:41', NULL, NULL);
INSERT INTO `user_activity` VALUES (909, 1, 'Masuk ke Dashboard', '2025-01-24 10:13:51', NULL, NULL);
INSERT INTO `user_activity` VALUES (910, 1, 'Masuk ke Login', '2025-01-24 10:14:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (911, 1, 'Masuk ke Login', '2025-01-24 10:14:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (912, 1, 'Masuk ke Login', '2025-01-24 10:18:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (913, 1, 'Masuk ke Login', '2025-01-24 10:18:19', NULL, NULL);
INSERT INTO `user_activity` VALUES (914, 1, 'Masuk ke Login', '2025-01-24 10:18:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (915, 1, 'Masuk ke Login', '2025-01-24 10:18:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (916, 1, 'Masuk ke Login', '2025-01-24 10:19:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (917, 1, 'Masuk ke Login', '2025-01-24 10:19:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (918, 1, 'Masuk ke Login', '2025-01-24 10:19:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (919, 1, 'Masuk ke Login', '2025-01-24 10:19:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (920, 1, 'Masuk ke Login', '2025-01-24 10:19:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (921, 1, 'Masuk ke Login', '2025-01-24 10:20:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (922, 1, 'Masuk ke Login', '2025-01-24 10:20:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (923, 1, 'Masuk ke Login', '2025-01-24 10:21:09', NULL, NULL);
INSERT INTO `user_activity` VALUES (924, 1, 'Masuk ke Login', '2025-01-24 10:21:23', NULL, NULL);
INSERT INTO `user_activity` VALUES (925, 1, 'Masuk ke Login', '2025-01-24 10:21:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (926, 1, 'Masuk ke Login', '2025-01-24 10:22:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (927, 1, 'Masuk ke Login', '2025-01-24 10:23:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (928, 1, 'Masuk ke Login', '2025-01-24 10:23:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (929, 1, 'Masuk ke Login', '2025-01-24 10:23:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (930, 1, 'Masuk ke Login', '2025-01-24 10:23:18', NULL, NULL);
INSERT INTO `user_activity` VALUES (931, 1, 'Masuk ke Login', '2025-01-24 10:23:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (932, 1, 'Masuk ke Login', '2025-01-24 10:23:23', NULL, NULL);
INSERT INTO `user_activity` VALUES (933, 1, 'Masuk ke Login', '2025-01-24 10:24:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (934, 1, 'Masuk ke Login', '2025-01-24 10:24:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (935, 1, 'Masuk ke Login', '2025-01-24 10:24:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (936, 1, 'Masuk ke Login', '2025-01-24 10:24:39', NULL, NULL);
INSERT INTO `user_activity` VALUES (937, 1, 'Masuk ke Dashboard', '2025-01-24 10:24:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (938, 1, 'Masuk ke Dashboard', '2025-01-24 10:24:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (939, 1, 'Masuk ke Dashboard', '2025-01-24 10:24:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (940, 1, 'Masuk ke Lowongan', '2025-01-24 10:24:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (941, 1, 'Masuk ke Dashboard', '2025-01-24 10:24:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (942, 1, 'Masuk ke Dashboard', '2025-01-24 10:25:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (943, 1, 'Masuk ke Login', '2025-01-24 10:26:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (944, 1, 'Masuk ke Login', '2025-01-24 10:27:01', NULL, NULL);
INSERT INTO `user_activity` VALUES (945, 1, 'Masuk ke Dashboard', '2025-01-24 10:27:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (946, 1, 'Masuk ke Login', '2025-01-24 10:27:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (947, 1, 'Masuk ke Dashboard', '2025-01-24 10:27:09', NULL, NULL);
INSERT INTO `user_activity` VALUES (948, 1, 'Masuk ke Dashboard', '2025-01-24 10:27:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (949, 1, 'Masuk ke Dashboard', '2025-01-24 10:27:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (950, 1, 'Masuk ke Dashboard', '2025-01-24 10:27:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (951, 1, 'Masuk ke Dashboard', '2025-01-24 10:27:35', NULL, NULL);
INSERT INTO `user_activity` VALUES (952, 1, 'Masuk ke Dashboard', '2025-01-24 10:27:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (953, 1, 'Masuk ke Dashboard', '2025-01-24 10:27:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (954, 1, 'Masuk ke Dashboard', '2025-01-24 10:28:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (955, 1, 'Masuk ke Dashboard', '2025-01-24 10:28:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (956, 1, 'Masuk ke Lowongan', '2025-01-24 10:28:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (957, 1, 'Masuk ke Tambah Lowongan', '2025-01-24 10:28:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (958, 1, 'Masuk ke Lowongan', '2025-01-24 10:29:09', NULL, NULL);
INSERT INTO `user_activity` VALUES (959, 1, 'Masuk ke Tambah Lowongan', '2025-01-24 10:29:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (960, 1, 'Masuk ke Lowongan', '2025-01-24 10:29:23', NULL, NULL);
INSERT INTO `user_activity` VALUES (961, 1, 'Masuk ke Tambah Lowongan', '2025-01-24 10:29:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (962, 1, 'Masuk ke Lowongan', '2025-01-24 10:29:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (963, 1, 'Masuk ke Tambah Lowongan', '2025-01-24 10:29:41', NULL, NULL);
INSERT INTO `user_activity` VALUES (964, 1, 'Masuk ke Lowongan', '2025-01-24 10:29:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (965, 1, 'Masuk ke Lowongan', '2025-01-24 10:29:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (966, 1, 'Masuk ke Tambah Lowongan', '2025-01-24 10:29:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (967, 1, 'Masuk ke Lowongan', '2025-01-24 10:29:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (968, 1, 'Masuk ke Lowongan', '2025-01-24 10:30:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (969, 1, 'Masuk ke Lowongan', '2025-01-24 10:30:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (970, 1, 'Masuk ke Tambah Lowongan', '2025-01-24 10:30:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (971, 1, 'Masuk ke Lowongan', '2025-01-24 10:31:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (972, 1, 'Masuk ke Lowongan', '2025-01-24 10:31:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (973, 1, 'Masuk ke Lowongan', '2025-01-24 10:32:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (974, 1, 'Masuk ke Lowongan', '2025-01-24 10:32:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (975, 1, 'Masuk ke Lowongan', '2025-01-24 10:32:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (976, 1, 'Masuk ke Lowongan', '2025-01-24 10:32:28', NULL, NULL);
INSERT INTO `user_activity` VALUES (977, 1, 'Masuk ke Lowongan', '2025-01-24 10:33:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (978, 1, 'Masuk ke Lowongan', '2025-01-24 10:33:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (979, 1, 'Masuk ke Lowongan', '2025-01-24 10:34:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (980, 1, 'Masuk ke Lowongan', '2025-01-24 10:34:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (981, 1, 'Masuk ke Lowongan', '2025-01-24 10:34:53', NULL, NULL);
INSERT INTO `user_activity` VALUES (982, 1, 'Masuk ke Lowongan', '2025-01-24 10:34:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (983, 1, 'Masuk ke Lowongan', '2025-01-24 10:36:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (984, 1, 'Masuk ke Edit Lowongan', '2025-01-24 10:36:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (985, 1, 'Masuk ke Edit Lowongan', '2025-01-24 10:36:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (986, 1, 'Masuk ke Edit Lowongan', '2025-01-24 10:36:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (987, 1, 'Masuk ke Edit Lowongan', '2025-01-24 10:36:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (988, 1, 'Masuk ke Lowongan', '2025-01-24 10:37:00', NULL, NULL);
INSERT INTO `user_activity` VALUES (989, 1, 'Masuk ke Lowongan', '2025-01-24 10:37:22', NULL, NULL);
INSERT INTO `user_activity` VALUES (990, 1, 'Masuk ke Lowongan', '2025-01-24 10:37:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (991, 1, 'Masuk ke Lowongan', '2025-01-24 10:37:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (992, 1, 'Masuk ke Edit Lowongan', '2025-01-24 10:37:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (993, 1, 'Masuk ke Edit Lowongan', '2025-01-24 10:37:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (994, 1, 'Masuk ke Edit Lowongan', '2025-01-24 10:37:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (995, 1, 'Masuk ke Edit Lowongan', '2025-01-24 10:37:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (996, 1, 'Masuk ke Lowongan', '2025-01-24 10:37:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (997, 1, 'Masuk ke Lowongan', '2025-01-24 10:37:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (998, 1, 'Masuk ke Lowongan', '2025-01-24 10:37:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (999, 1, 'Masuk ke Lowongan', '2025-01-24 10:38:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (1000, 1, 'Masuk ke Lamaran', '2025-01-24 10:38:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (1001, 1, 'Masuk ke Lowongan', '2025-01-24 10:38:17', NULL, NULL);
INSERT INTO `user_activity` VALUES (1002, 1, 'Masuk ke Lamaran', '2025-01-24 10:38:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (1003, 1, 'Masuk ke Lamaran', '2025-01-24 10:39:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (1004, 1, 'Masuk ke Lamaran', '2025-01-24 10:40:22', NULL, NULL);
INSERT INTO `user_activity` VALUES (1005, 1, 'Masuk ke Lamaran', '2025-01-24 10:40:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (1006, 1, 'Masuk ke Edit Lamaran', '2025-01-24 10:40:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (1007, 1, 'Masuk ke Lowongan', '2025-01-24 10:40:51', NULL, NULL);
INSERT INTO `user_activity` VALUES (1008, 1, 'Masuk ke Lowongan', '2025-01-24 10:42:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (1009, 1, 'Masuk ke Lamaran', '2025-01-24 10:42:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (1010, 1, 'Masuk ke Lamaran', '2025-01-24 10:42:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (1011, 1, 'Masuk ke Lamaran', '2025-01-24 10:42:51', NULL, NULL);
INSERT INTO `user_activity` VALUES (1012, 1, 'Masuk ke Edit Lamaran', '2025-01-24 10:42:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (1013, 1, 'Masuk ke Edit Lamaran', '2025-01-24 10:42:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (1014, 1, 'Masuk ke Edit Lamaran', '2025-01-24 10:42:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (1015, 1, 'Masuk ke Edit Lamaran', '2025-01-24 10:42:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (1016, 1, 'Masuk ke Lamaran', '2025-01-24 10:42:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (1017, 1, 'Masuk ke Lamaran', '2025-01-24 10:43:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (1018, 1, 'Masuk ke Lamaran', '2025-01-24 10:43:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (1019, 1, 'Masuk ke Lamaran', '2025-01-24 10:44:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (1020, 1, 'Masuk ke Lamaran', '2025-01-24 10:44:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (1021, 1, 'Masuk ke Lamaran', '2025-01-24 10:44:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (1022, 1, 'Masuk ke Lamaran', '2025-01-24 10:45:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (1023, 1, 'Masuk ke Edit Lamaran', '2025-01-24 10:45:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (1024, 1, 'Masuk ke Edit Lamaran', '2025-01-24 10:45:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (1025, 1, 'Masuk ke Edit Lamaran', '2025-01-24 10:45:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (1026, 1, 'Masuk ke Edit Lamaran', '2025-01-24 10:45:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (1027, 1, 'Masuk ke Lamaran', '2025-01-24 10:45:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (1028, 1, 'Masuk ke Edit Lamaran', '2025-01-24 10:45:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (1029, 1, 'Masuk ke Edit Lamaran', '2025-01-24 10:45:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (1030, 1, 'Masuk ke Edit Lamaran', '2025-01-24 10:45:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (1031, 1, 'Masuk ke Edit Lamaran', '2025-01-24 10:45:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (1032, 1, 'Masuk ke Lamaran', '2025-01-24 10:45:18', NULL, NULL);
INSERT INTO `user_activity` VALUES (1033, 1, 'Masuk ke Lamaran', '2025-01-24 10:46:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (1034, 1, 'Masuk ke Lamaran', '2025-01-24 10:46:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (1035, 1, 'Masuk ke Lamaran', '2025-01-24 10:47:22', NULL, NULL);
INSERT INTO `user_activity` VALUES (1036, 1, 'Masuk ke Lamaran', '2025-01-24 10:47:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (1037, 1, 'Masuk ke Lamaran', '2025-01-24 10:47:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (1038, 1, 'Masuk ke Lamaran', '2025-01-24 10:48:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (1039, 1, 'Masuk ke Karyawan', '2025-01-24 10:48:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (1040, 1, 'Masuk ke Karyawan', '2025-01-24 10:48:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (1041, 1, 'Masuk ke Karyawan', '2025-01-24 10:48:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (1042, 1, 'Masuk ke Lamaran', '2025-01-24 10:48:46', NULL, NULL);
INSERT INTO `user_activity` VALUES (1043, 1, 'Masuk ke Lowongan', '2025-01-24 10:48:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (1044, 1, 'Masuk ke Lowongan', '2025-01-24 10:49:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (1045, 1, 'Masuk ke Karyawan', '2025-01-24 10:49:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (1046, 1, 'Masuk ke User', '2025-01-24 10:49:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (1047, 1, 'Masuk ke User', '2025-01-24 10:49:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (1048, 1, 'Masuk ke Tambah User', '2025-01-24 10:49:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (1049, 1, 'Masuk ke User', '2025-01-24 10:50:11', NULL, NULL);
INSERT INTO `user_activity` VALUES (1050, 1, 'Masuk ke Tambah User', '2025-01-24 10:50:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (1051, 1, 'Masuk ke Tambah User', '2025-01-24 10:50:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (1052, 1, 'Masuk ke User', '2025-01-24 10:50:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (1053, 1, 'Masuk ke User', '2025-01-24 10:52:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (1054, 1, 'Masuk ke Edit User', '2025-01-24 10:52:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (1055, 1, 'Masuk ke Edit User', '2025-01-24 10:52:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (1056, 1, 'Masuk ke Edit User', '2025-01-24 10:52:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (1057, 1, 'Masuk ke Edit User', '2025-01-24 10:52:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (1058, 1, 'Masuk ke User', '2025-01-24 10:52:40', NULL, NULL);
INSERT INTO `user_activity` VALUES (1059, 1, 'Masuk ke User', '2025-01-24 10:52:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (1060, 1, 'Masuk ke User', '2025-01-24 10:52:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (1061, 1, 'Masuk ke User', '2025-01-24 10:53:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (1062, 1, 'Masuk ke Setting', '2025-01-24 10:53:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (1063, 1, 'Masuk ke Setting', '2025-01-24 10:53:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (1064, 1, 'Masuk ke Setting', '2025-01-24 10:53:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (1065, 1, 'Masuk ke Setting', '2025-01-24 10:53:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (1066, 1, 'Masuk ke Setting', '2025-01-24 10:54:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (1067, 1, 'Masuk ke Setting', '2025-01-24 10:54:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (1068, 1, 'Masuk ke Soft Delete', '2025-01-24 10:54:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (1069, 1, 'Masuk ke Soft Delete', '2025-01-24 10:54:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (1070, 1, 'Masuk ke Soft Delete', '2025-01-24 10:55:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (1071, 1, 'Masuk ke Lowongan', '2025-01-24 10:55:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (1072, 1, 'Masuk ke Soft Delete', '2025-01-24 10:55:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (1073, 1, 'Masuk ke Soft Delete', '2025-01-24 10:55:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (1074, 1, 'Masuk ke Restore Edit Lowongan', '2025-01-24 10:55:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (1075, 1, 'Masuk ke Restore Edit Lowongan', '2025-01-24 10:56:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (1076, 1, 'Masuk ke Log Activity', '2025-01-24 10:56:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (1077, 1, 'Masuk ke Soft Delete', '2025-01-24 10:56:35', NULL, NULL);
INSERT INTO `user_activity` VALUES (1078, 1, 'Masuk ke Setting', '2025-01-24 10:56:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (1079, 1, 'Masuk ke User', '2025-01-24 10:56:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (1080, 1, 'Masuk ke User', '2025-01-24 10:57:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (1081, 1, 'Masuk ke User', '2025-01-24 10:57:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (1082, 1, 'Masuk ke Dashboard', '2025-01-24 10:57:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (1083, 1, 'Masuk ke Dashboard', '2025-01-24 10:57:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (1084, 1, 'Masuk ke Dashboard', '2025-01-24 10:58:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (1085, 1, 'Masuk ke Dashboard', '2025-01-24 10:58:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (1086, 1, 'Masuk ke Dashboard', '2025-01-24 10:58:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (1087, 1, 'Masuk ke Lowongan', '2025-01-24 10:58:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (1088, 1, 'Masuk ke Lowongan', '2025-01-24 10:59:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (1089, 1, 'Masuk ke Lowongan', '2025-01-24 10:59:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (1090, 1, 'Masuk ke Lamaran', '2025-01-24 10:59:22', NULL, NULL);
INSERT INTO `user_activity` VALUES (1091, 1, 'Masuk ke Karyawan', '2025-01-24 10:59:23', NULL, NULL);
INSERT INTO `user_activity` VALUES (1092, 1, 'Masuk ke Karyawan', '2025-01-24 11:00:00', NULL, NULL);
INSERT INTO `user_activity` VALUES (1093, 1, 'Masuk ke User', '2025-01-24 11:00:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (1094, 1, 'Masuk ke Setting', '2025-01-24 11:00:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (1095, 1, 'Masuk ke User', '2025-01-24 11:00:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (1096, 1, 'Masuk ke User', '2025-01-24 11:03:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (1097, 1, 'Masuk ke Dashboard', '2025-01-24 11:03:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (1098, 1, 'Masuk ke Lowongan', '2025-01-24 11:04:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (1099, 1, 'Masuk ke Lamaran', '2025-01-24 11:04:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (1100, 1, 'Masuk ke Karyawan', '2025-01-24 11:04:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (1101, 1, 'Masuk ke User', '2025-01-24 11:04:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (1102, 1, 'Masuk ke Setting', '2025-01-24 11:04:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (1103, 1, 'Masuk ke Dashboard', '2025-01-24 11:04:09', NULL, NULL);
INSERT INTO `user_activity` VALUES (1104, NULL, 'Masuk ke Login', '2025-02-01 07:05:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (1105, NULL, 'Masuk ke Dashboard', '2025-02-01 07:05:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (1106, NULL, 'Masuk ke Login', '2025-02-01 07:06:09', NULL, NULL);
INSERT INTO `user_activity` VALUES (1107, NULL, 'Masuk ke Login', '2025-02-01 07:08:11', NULL, NULL);
INSERT INTO `user_activity` VALUES (1108, NULL, 'Masuk ke Login', '2025-02-01 07:08:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (1109, 1, 'Masuk ke Dashboard', '2025-02-01 07:08:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (1110, 1, 'Masuk ke Lowongan', '2025-02-01 07:08:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (1111, 1, 'Masuk ke Karyawan', '2025-02-01 07:08:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (1112, 1, 'Masuk ke User', '2025-02-01 07:12:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (1113, 1, 'Masuk ke Setting', '2025-02-01 07:12:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (1114, NULL, 'Masuk ke Dashboard', '2025-02-02 08:34:23', NULL, NULL);
INSERT INTO `user_activity` VALUES (1115, NULL, 'Masuk ke Login', '2025-02-02 08:35:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (1116, NULL, 'Masuk ke Login', '2025-02-02 08:35:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (1117, NULL, 'Masuk ke Register', '2025-02-02 08:35:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (1118, NULL, 'Masuk ke Login', '2025-02-02 08:35:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (1119, NULL, 'Masuk ke Login', '2025-02-02 08:35:39', NULL, NULL);
INSERT INTO `user_activity` VALUES (1120, 1, 'Masuk ke Dashboard', '2025-02-02 08:35:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (1121, 1, 'Masuk ke Setting', '2025-02-02 08:35:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (1122, 1, 'Masuk ke Setting', '2025-02-02 08:36:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (1123, NULL, 'Masuk ke Login', '2025-02-02 08:36:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (1124, NULL, 'Masuk ke Register', '2025-02-02 08:36:23', NULL, NULL);
INSERT INTO `user_activity` VALUES (1125, NULL, 'Masuk ke Login', '2025-02-02 08:36:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (1126, 1, 'Masuk ke Dashboard', '2025-02-02 08:37:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (1127, 1, 'Masuk ke Lowongan', '2025-02-02 08:37:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (1128, 1, 'Masuk ke Tambah Lowongan', '2025-02-02 08:38:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (1129, 1, 'Masuk ke Edit Lowongan', '2025-02-02 08:39:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (1130, 1, 'Masuk ke Lowongan', '2025-02-02 08:39:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (1131, 1, 'Masuk ke Edit Lowongan', '2025-02-02 08:39:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (1132, 1, 'Masuk ke Lamaran', '2025-02-02 08:39:22', NULL, NULL);
INSERT INTO `user_activity` VALUES (1133, 1, 'Masuk ke Lowongan', '2025-02-02 08:39:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (1134, 1, 'Masuk ke Lamaran', '2025-02-02 08:39:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (1135, NULL, 'Masuk ke Login', '2025-02-02 08:39:41', NULL, NULL);
INSERT INTO `user_activity` VALUES (1136, 8, 'Masuk ke Dashboard', '2025-02-02 08:39:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (1137, 8, 'Masuk ke Lamaran', '2025-02-02 08:39:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (1138, 8, 'Masuk ke Edit Lamaran', '2025-02-02 08:40:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (1139, 8, 'Masuk ke Dashboard', '2025-02-02 08:40:39', NULL, NULL);
INSERT INTO `user_activity` VALUES (1140, 8, 'Masuk ke Lowongan', '2025-02-02 08:40:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (1141, 8, 'Masuk ke Lamaran', '2025-02-02 08:41:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (1142, 8, 'Masuk ke Edit Lamaran', '2025-02-02 08:41:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (1143, 8, 'Masuk ke Lowongan', '2025-02-02 08:42:41', NULL, NULL);
INSERT INTO `user_activity` VALUES (1144, 8, 'Masuk ke Lamaran', '2025-02-02 08:43:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (1145, NULL, 'Masuk ke Login', '2025-02-02 08:43:09', NULL, NULL);
INSERT INTO `user_activity` VALUES (1146, 1, 'Masuk ke Dashboard', '2025-02-02 08:43:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (1147, 1, 'Masuk ke Lamaran', '2025-02-02 08:43:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (1148, 1, 'Masuk ke Lamaran', '2025-02-02 08:43:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (1149, NULL, 'Masuk ke Login', '2025-02-02 08:44:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (1150, 8, 'Masuk ke Dashboard', '2025-02-02 08:44:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (1151, 8, 'Masuk ke Lamaran', '2025-02-02 08:44:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (1152, NULL, 'Masuk ke Login', '2025-02-02 08:45:00', NULL, NULL);
INSERT INTO `user_activity` VALUES (1153, 1, 'Masuk ke Dashboard', '2025-02-02 08:45:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (1154, 1, 'Masuk ke User', '2025-02-02 08:45:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (1155, 1, 'Masuk ke Karyawan', '2025-02-02 08:45:09', NULL, NULL);
INSERT INTO `user_activity` VALUES (1156, 1, 'Masuk ke Setting', '2025-02-02 08:48:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (1157, 1, 'Masuk ke User', '2025-02-02 08:48:11', NULL, NULL);
INSERT INTO `user_activity` VALUES (1158, 1, 'Masuk ke Tambah User', '2025-02-02 08:48:37', NULL, NULL);
INSERT INTO `user_activity` VALUES (1159, 1, 'Masuk ke Setting', '2025-02-02 08:49:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (1160, 1, 'Masuk ke User', '2025-02-02 08:49:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (1161, 1, 'Masuk ke Edit User', '2025-02-02 08:49:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (1162, 1, 'Masuk ke Setting', '2025-02-02 08:49:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (1163, 1, 'Masuk ke Soft Delete', '2025-02-02 08:49:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (1164, 1, 'Masuk ke Lowongan', '2025-02-02 08:50:00', NULL, NULL);
INSERT INTO `user_activity` VALUES (1165, 1, 'Masuk ke Lowongan', '2025-02-02 08:50:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (1166, 1, 'Masuk ke Soft Delete', '2025-02-02 08:50:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (1167, 1, 'Masuk ke Restore Edit Lowongan', '2025-02-02 08:50:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (1168, 1, 'Masuk ke Log Activity', '2025-02-02 08:50:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (1169, 1, 'Masuk ke Lowongan', '2025-02-02 09:03:09', NULL, NULL);
INSERT INTO `user_activity` VALUES (1170, 1, 'Masuk ke Lowongan', '2025-02-02 09:03:09', NULL, NULL);
INSERT INTO `user_activity` VALUES (1171, 1, 'Masuk ke Lamaran', '2025-02-02 09:05:01', NULL, NULL);
INSERT INTO `user_activity` VALUES (1172, 1, 'Masuk ke Lowongan', '2025-02-02 09:05:01', NULL, NULL);
INSERT INTO `user_activity` VALUES (1173, NULL, 'Masuk ke Login', '2025-02-02 09:05:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (1174, 8, 'Masuk ke Dashboard', '2025-02-02 09:05:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (1175, 8, 'Masuk ke Dashboard', '2025-02-02 09:05:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (1176, 8, 'Masuk ke Lowongan', '2025-02-02 09:05:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (1177, NULL, 'Masuk ke Login', '2025-02-02 10:07:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (1178, NULL, 'Masuk ke Register', '2025-02-02 10:07:22', NULL, NULL);
INSERT INTO `user_activity` VALUES (1179, NULL, 'Masuk ke Login', '2025-02-02 10:07:28', NULL, NULL);
INSERT INTO `user_activity` VALUES (1180, 1, 'Masuk ke Dashboard', '2025-02-02 10:07:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (1181, 1, 'Masuk ke Lowongan', '2025-02-02 10:07:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (1182, 1, 'Masuk ke Lamaran', '2025-02-02 10:07:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (1183, 1, 'Masuk ke Karyawan', '2025-02-02 10:07:37', NULL, NULL);
INSERT INTO `user_activity` VALUES (1184, 1, 'Masuk ke Karyawan', '2025-02-02 10:08:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (1185, 1, 'Masuk ke User', '2025-02-02 10:08:17', NULL, NULL);
INSERT INTO `user_activity` VALUES (1186, 1, 'Masuk ke Setting', '2025-02-02 10:08:18', NULL, NULL);
INSERT INTO `user_activity` VALUES (1187, 1, 'Masuk ke User', '2025-02-02 10:08:19', NULL, NULL);
INSERT INTO `user_activity` VALUES (1188, 1, 'Masuk ke Lamaran', '2025-02-02 10:08:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (1189, 1, 'Masuk ke Dashboard', '2025-02-02 10:08:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (1190, 1, 'Masuk ke Lamaran', '2025-02-02 10:08:35', NULL, NULL);
INSERT INTO `user_activity` VALUES (1191, 1, 'Masuk ke User', '2025-02-02 10:08:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (1192, 1, 'Masuk ke User', '2025-02-02 10:08:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (1193, 1, 'Masuk ke Lamaran', '2025-02-02 10:08:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (1194, 1, 'Masuk ke Lowongan', '2025-02-02 10:09:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (1195, 1, 'Masuk ke Lowongan', '2025-02-02 10:21:17', NULL, NULL);
INSERT INTO `user_activity` VALUES (1196, 1, 'Masuk ke Tambah Lowongan', '2025-02-02 10:21:19', NULL, NULL);
INSERT INTO `user_activity` VALUES (1197, 1, 'Masuk ke Lamaran', '2025-02-02 10:21:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (1198, 1, 'Masuk ke Lowongan', '2025-02-02 10:21:22', NULL, NULL);
INSERT INTO `user_activity` VALUES (1199, 1, 'Masuk ke Lowongan', '2025-02-02 10:21:23', NULL, NULL);
INSERT INTO `user_activity` VALUES (1200, 1, 'Masuk ke Tambah Lowongan', '2025-02-02 10:21:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (1201, 1, 'Masuk ke Lowongan', '2025-02-02 10:21:39', NULL, NULL);
INSERT INTO `user_activity` VALUES (1202, 1, 'Masuk ke Lowongan', '2025-02-02 10:22:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (1203, 1, 'Masuk ke Tambah Lowongan', '2025-02-02 10:22:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (1204, 1, 'Masuk ke Lowongan', '2025-02-02 10:23:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (1205, 1, 'Masuk ke Tambah Lowongan', '2025-02-02 10:23:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (1206, 1, 'Masuk ke Lowongan', '2025-02-02 10:23:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (1207, 1, 'Masuk ke Lamaran', '2025-02-02 10:23:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (1208, 1, 'Masuk ke User', '2025-02-02 10:23:28', NULL, NULL);
INSERT INTO `user_activity` VALUES (1209, 1, 'Masuk ke Lowongan', '2025-02-02 10:24:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (1210, 1, 'Masuk ke Lowongan', '2025-02-02 10:24:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (1211, 1, 'Masuk ke Lowongan', '2025-02-02 10:24:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (1212, 1, 'Masuk ke Lamaran', '2025-02-02 10:25:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (1213, 1, 'Masuk ke Lamaran', '2025-02-02 10:25:53', NULL, NULL);
INSERT INTO `user_activity` VALUES (1214, 1, 'Masuk ke User', '2025-02-02 10:25:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (1215, 1, 'Masuk ke Setting', '2025-02-02 10:26:11', NULL, NULL);
INSERT INTO `user_activity` VALUES (1216, 1, 'Masuk ke Soft Delete', '2025-02-02 10:26:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (1217, 1, 'Masuk ke Restore Edit Lowongan', '2025-02-02 10:26:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (1218, 1, 'Masuk ke Restore Edit Lowongan', '2025-02-02 10:26:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (1219, 1, 'Masuk ke Restore Edit Lowongan', '2025-02-02 10:26:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (1220, 1, 'Masuk ke Soft Delete', '2025-02-02 10:26:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (1221, 1, 'Masuk ke Log Activity', '2025-02-02 10:26:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (1222, 1, 'Masuk ke Restore Edit Lowongan', '2025-02-02 10:26:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (1223, 1, 'Masuk ke Setting', '2025-02-02 10:26:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (1224, 1, 'Masuk ke Dashboard', '2025-02-02 10:26:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (1225, 1, 'Masuk ke Lowongan', '2025-02-02 10:27:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (1226, 1, 'Masuk ke User', '2025-02-02 10:27:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (1227, 1, 'Masuk ke User', '2025-02-02 10:31:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (1228, 1, 'Masuk ke User', '2025-02-02 10:31:39', NULL, NULL);
INSERT INTO `user_activity` VALUES (1229, 1, 'Masuk ke User', '2025-02-02 10:33:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (1230, NULL, 'Masuk ke Login', '2025-02-02 10:34:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (1231, NULL, 'Masuk ke Login', '2025-02-02 10:34:09', NULL, NULL);
INSERT INTO `user_activity` VALUES (1232, 1, 'Masuk ke Dashboard', '2025-02-02 10:34:11', NULL, NULL);
INSERT INTO `user_activity` VALUES (1233, 1, 'Masuk ke User', '2025-02-02 10:34:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (1234, 1, 'Melakukan Reset Password', '2025-02-02 10:34:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (1235, 1, 'Masuk ke User', '2025-02-02 10:34:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (1236, NULL, 'Masuk ke Login', '2025-02-02 10:34:17', NULL, NULL);
INSERT INTO `user_activity` VALUES (1237, NULL, 'Masuk ke Login', '2025-02-02 10:34:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (1238, 1, 'Masuk ke Dashboard', '2025-02-02 10:34:41', NULL, NULL);
INSERT INTO `user_activity` VALUES (1239, 1, 'Masuk ke Setting', '2025-02-02 10:34:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (1240, 1, 'Masuk ke User', '2025-02-02 10:34:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (1241, 1, 'Masuk ke Lowongan', '2025-02-02 10:35:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (1242, 1, 'Masuk ke User', '2025-02-02 10:35:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (1243, 1, 'Masuk ke Setting', '2025-02-02 10:36:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (1244, 1, 'Masuk ke User', '2025-02-02 10:36:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (1245, 1, 'Masuk ke Lowongan', '2025-02-02 10:36:35', NULL, NULL);
INSERT INTO `user_activity` VALUES (1246, 1, 'Masuk ke User', '2025-02-02 10:36:35', NULL, NULL);
INSERT INTO `user_activity` VALUES (1247, 1, 'Masuk ke Lowongan', '2025-02-02 10:36:37', NULL, NULL);
INSERT INTO `user_activity` VALUES (1248, 1, 'Masuk ke Dashboard', '2025-02-02 10:36:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (1249, 1, 'Masuk ke Dashboard', '2025-02-02 10:37:35', NULL, NULL);
INSERT INTO `user_activity` VALUES (1250, 1, 'Masuk ke Dashboard', '2025-02-02 10:37:37', NULL, NULL);
INSERT INTO `user_activity` VALUES (1251, 1, 'Masuk ke Dashboard', '2025-02-02 10:38:51', NULL, NULL);
INSERT INTO `user_activity` VALUES (1252, 1, 'Masuk ke Dashboard', '2025-02-02 10:38:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (1253, 1, 'Masuk ke Dashboard', '2025-02-02 10:39:11', NULL, NULL);
INSERT INTO `user_activity` VALUES (1254, 1, 'Masuk ke Dashboard', '2025-02-02 10:40:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (1255, 1, 'Masuk ke Login', '2025-02-02 10:40:17', NULL, NULL);
INSERT INTO `user_activity` VALUES (1256, 1, 'Masuk ke Dashboard', '2025-02-02 10:40:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (1257, 1, 'Masuk ke Dashboard', '2025-02-02 10:40:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (1258, 1, 'Masuk ke Lowongan', '2025-02-02 10:40:51', NULL, NULL);
INSERT INTO `user_activity` VALUES (1259, 1, 'Masuk ke Lowongan', '2025-02-02 10:41:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (1260, 1, 'Masuk ke User', '2025-02-02 10:41:23', NULL, NULL);
INSERT INTO `user_activity` VALUES (1261, 1, 'Masuk ke Setting', '2025-02-02 10:41:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (1262, 1, 'Masuk ke Soft Delete', '2025-02-02 10:41:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (1263, 1, 'Masuk ke Restore Edit Lowongan', '2025-02-02 10:41:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (1264, 1, 'Masuk ke Log Activity', '2025-02-02 10:41:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (1265, 1, 'Masuk ke Dashboard', '2025-02-02 10:41:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (1266, 1, 'Masuk ke Lowongan', '2025-02-02 10:41:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (1267, 1, 'Masuk ke User', '2025-02-02 10:41:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (1268, 1, 'Masuk ke Setting', '2025-02-02 10:41:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (1269, 1, 'Masuk ke Soft Delete', '2025-02-02 10:41:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (1270, 1, 'Masuk ke Restore Edit Lowongan', '2025-02-02 10:41:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (1271, 1, 'Masuk ke Log Activity', '2025-02-02 10:41:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (1272, NULL, 'Masuk ke Login', '2025-02-02 10:41:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (1273, NULL, 'Masuk ke Login', '2025-02-02 10:41:37', NULL, NULL);
INSERT INTO `user_activity` VALUES (1274, 1, 'Masuk ke Dashboard', '2025-02-02 10:41:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (1275, 1, 'Masuk ke Lowongan', '2025-02-02 10:42:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (1276, 1, 'Masuk ke Lowongan', '2025-02-02 10:42:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (1277, 1, 'Masuk ke User', '2025-02-02 10:42:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (1278, 1, 'Masuk ke Dashboard', '2025-02-02 10:42:17', NULL, NULL);
INSERT INTO `user_activity` VALUES (1279, 1, 'Masuk ke Lowongan', '2025-02-02 10:42:17', NULL, NULL);
INSERT INTO `user_activity` VALUES (1280, 1, 'Masuk ke Setting', '2025-02-02 10:42:18', NULL, NULL);
INSERT INTO `user_activity` VALUES (1281, 1, 'Masuk ke User', '2025-02-02 10:42:18', NULL, NULL);
INSERT INTO `user_activity` VALUES (1282, 1, 'Masuk ke Setting', '2025-02-02 10:42:19', NULL, NULL);
INSERT INTO `user_activity` VALUES (1283, 1, 'Masuk ke User', '2025-02-02 10:42:19', NULL, NULL);
INSERT INTO `user_activity` VALUES (1284, 1, 'Masuk ke Setting', '2025-02-02 10:42:35', NULL, NULL);
INSERT INTO `user_activity` VALUES (1285, 1, 'Masuk ke Setting', '2025-02-02 10:42:37', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
