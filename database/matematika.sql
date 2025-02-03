/*
 Navicat Premium Dump SQL

 Source Server         : yoga
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : matematika

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 03/02/2025 22:42:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for history
-- ----------------------------
DROP TABLE IF EXISTS `history`;
CREATE TABLE `history`  (
  `id_history` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `hasil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `waktu` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_history`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 110 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of history
-- ----------------------------
INSERT INTO `history` VALUES (100, 1, 'L = 2 x 2 = 4', '2025-02-03 09:06:59');
INSERT INTO `history` VALUES (101, 31, 'L = 4 x 4 = 16', '2025-02-03 09:36:03');
INSERT INTO `history` VALUES (102, 31, 'L = L =4 × t =12 = 48', '2025-02-03 09:36:12');
INSERT INTO `history` VALUES (103, 31, 'V = 3³ = 27', '2025-02-03 09:36:20');
INSERT INTO `history` VALUES (104, 31, 'V = π × r² × t = π × (12²) × 20 = 9047.79', '2025-02-03 09:36:34');
INSERT INTO `history` VALUES (105, 31, 'Turunan dari fungsi 4x adalah: 4', '2025-02-03 09:36:41');
INSERT INTO `history` VALUES (106, 31, 'Turunan dari fungsi 4 adalah: 0', '2025-02-03 09:36:45');
INSERT INTO `history` VALUES (107, 31, 'Turunan dari fungsi 4x^4 adalah: 16*x^3', '2025-02-03 09:36:49');

-- ----------------------------
-- Table structure for rumus
-- ----------------------------
DROP TABLE IF EXISTS `rumus`;
CREATE TABLE `rumus`  (
  `id_rumus` int NOT NULL AUTO_INCREMENT,
  `nama_rumus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rumus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_rumus`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of rumus
-- ----------------------------
INSERT INTO `rumus` VALUES (1, 'Persegi', 's * s', NULL);

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
INSERT INTO `setting` VALUES (1, 'WEB MATEMATIKA', '1738597112_9b48b1230ddd6dfc4058.jpg', '1738597112_849ca114658ec3a0589b.jpg', '1738597112_f35f11593a891ad744e6.jpg', NULL, 1, NULL, NULL, '2025-02-03 09:38:32', NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` enum('admin','pengguna') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `backup_by` int NULL DEFAULT NULL,
  `backup_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', '1738595372_14b8a5a78994e6715333.jpg', NULL, 'admin', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (29, 'bobi123', 'c4ca4238a0b923820dcc509a6f75849b', NULL, 'bobi123@gmail.com', 'pengguna', NULL, NULL, NULL, NULL, 1, '2025-02-03 09:29:16');
INSERT INTO `user` VALUES (31, 'boba', 'c4ca4238a0b923820dcc509a6f75849b', NULL, 'boba@gmail.com', 'pengguna', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (32, 'boba kecap', 'c4ca4238a0b923820dcc509a6f75849b', NULL, 'bobakecap@gmail.com', 'pengguna', NULL, NULL, NULL, NULL, 1, '2025-02-03 09:37:55');

-- ----------------------------
-- Table structure for user_activity
-- ----------------------------
DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE `user_activity`  (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_log`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 113 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_activity
-- ----------------------------
INSERT INTO `user_activity` VALUES (1, 1, 'Masuk ke Dashboard', '2025-02-03 09:15:40');
INSERT INTO `user_activity` VALUES (2, 1, 'Masuk ke User', '2025-02-03 09:15:41');
INSERT INTO `user_activity` VALUES (3, 1, 'Masuk ke Rumus persegi', '2025-02-03 09:15:41');
INSERT INTO `user_activity` VALUES (4, 1, 'Masuk ke Log Activity', '2025-02-03 09:15:42');
INSERT INTO `user_activity` VALUES (5, 1, 'Masuk ke Log Activity', '2025-02-03 09:16:11');
INSERT INTO `user_activity` VALUES (6, 1, 'Masuk ke User', '2025-02-03 09:16:13');
INSERT INTO `user_activity` VALUES (7, 1, 'Masuk ke User', '2025-02-03 09:20:25');
INSERT INTO `user_activity` VALUES (8, 1, 'Masuk ke User', '2025-02-03 09:20:26');
INSERT INTO `user_activity` VALUES (9, 1, 'Masuk ke Soft Delete', '2025-02-03 09:20:44');
INSERT INTO `user_activity` VALUES (10, 1, 'Masuk ke User', '2025-02-03 09:21:06');
INSERT INTO `user_activity` VALUES (11, 1, 'Masuk ke User', '2025-02-03 09:22:54');
INSERT INTO `user_activity` VALUES (12, 1, 'Masuk ke Soft Delete', '2025-02-03 09:22:57');
INSERT INTO `user_activity` VALUES (13, 1, 'Masuk ke User', '2025-02-03 09:22:58');
INSERT INTO `user_activity` VALUES (14, 1, 'Masuk ke User', '2025-02-03 09:25:06');
INSERT INTO `user_activity` VALUES (15, 1, 'Masuk ke User', '2025-02-03 09:25:08');
INSERT INTO `user_activity` VALUES (16, 1, 'Masuk ke Soft Delete', '2025-02-03 09:25:09');
INSERT INTO `user_activity` VALUES (17, 1, 'Masuk ke Soft Delete', '2025-02-03 09:25:44');
INSERT INTO `user_activity` VALUES (18, 1, 'Masuk ke Soft Delete', '2025-02-03 09:25:45');
INSERT INTO `user_activity` VALUES (19, 1, 'Masuk ke Soft Delete', '2025-02-03 09:26:24');
INSERT INTO `user_activity` VALUES (20, 1, 'Masuk ke Soft Delete', '2025-02-03 09:26:26');
INSERT INTO `user_activity` VALUES (21, 1, 'Masuk ke Soft Delete', '2025-02-03 09:26:31');
INSERT INTO `user_activity` VALUES (22, 1, 'Masuk ke Soft Delete', '2025-02-03 09:26:31');
INSERT INTO `user_activity` VALUES (23, 1, 'Masuk ke Restore Edit User', '2025-02-03 09:26:32');
INSERT INTO `user_activity` VALUES (24, 1, 'Masuk ke Soft Delete', '2025-02-03 09:26:33');
INSERT INTO `user_activity` VALUES (25, 1, 'Masuk ke Restore Edit User', '2025-02-03 09:26:34');
INSERT INTO `user_activity` VALUES (26, 1, 'Masuk ke Soft Delete', '2025-02-03 09:26:34');
INSERT INTO `user_activity` VALUES (27, 1, 'Masuk ke User', '2025-02-03 09:26:35');
INSERT INTO `user_activity` VALUES (28, 1, 'Masuk ke Edit User', '2025-02-03 09:26:36');
INSERT INTO `user_activity` VALUES (29, 1, 'Masuk ke User', '2025-02-03 09:27:06');
INSERT INTO `user_activity` VALUES (30, 1, 'Masuk ke Edit User', '2025-02-03 09:27:08');
INSERT INTO `user_activity` VALUES (31, 1, 'Masuk ke User', '2025-02-03 09:27:29');
INSERT INTO `user_activity` VALUES (32, 1, 'Masuk ke Edit User', '2025-02-03 09:27:30');
INSERT INTO `user_activity` VALUES (33, 1, 'Masuk ke User', '2025-02-03 09:27:36');
INSERT INTO `user_activity` VALUES (34, 1, 'Masuk ke User', '2025-02-03 09:29:14');
INSERT INTO `user_activity` VALUES (35, 1, 'Masuk ke Edit User', '2025-02-03 09:29:14');
INSERT INTO `user_activity` VALUES (36, 1, 'Masuk ke User', '2025-02-03 09:29:16');
INSERT INTO `user_activity` VALUES (37, 1, 'Masuk ke Log Activity', '2025-02-03 09:29:18');
INSERT INTO `user_activity` VALUES (38, 1, 'Masuk ke Restore Edit User', '2025-02-03 09:29:19');
INSERT INTO `user_activity` VALUES (39, 1, 'Masuk ke User', '2025-02-03 09:29:31');
INSERT INTO `user_activity` VALUES (40, 1, 'Masuk ke Soft Delete', '2025-02-03 09:29:33');
INSERT INTO `user_activity` VALUES (41, 1, 'Masuk ke User', '2025-02-03 09:29:34');
INSERT INTO `user_activity` VALUES (42, 1, 'Masuk ke User', '2025-02-03 09:29:36');
INSERT INTO `user_activity` VALUES (43, 1, 'Masuk ke Soft Delete', '2025-02-03 09:29:37');
INSERT INTO `user_activity` VALUES (44, 1, 'Masuk ke User', '2025-02-03 09:29:38');
INSERT INTO `user_activity` VALUES (45, 1, 'Masuk ke Log Activity', '2025-02-03 09:29:40');
INSERT INTO `user_activity` VALUES (46, 1, 'Masuk ke Dashboard', '2025-02-03 09:29:42');
INSERT INTO `user_activity` VALUES (47, NULL, 'Masuk ke Login', '2025-02-03 09:30:02');
INSERT INTO `user_activity` VALUES (48, NULL, 'Masuk ke Register', '2025-02-03 09:30:03');
INSERT INTO `user_activity` VALUES (49, NULL, 'Masuk ke Register', '2025-02-03 09:31:17');
INSERT INTO `user_activity` VALUES (50, NULL, 'Masuk ke Register', '2025-02-03 09:31:33');
INSERT INTO `user_activity` VALUES (51, NULL, 'Masuk ke Register', '2025-02-03 09:32:05');
INSERT INTO `user_activity` VALUES (52, NULL, 'Masuk ke Register', '2025-02-03 09:32:33');
INSERT INTO `user_activity` VALUES (53, NULL, 'Masuk ke Login', '2025-02-03 09:32:35');
INSERT INTO `user_activity` VALUES (54, NULL, 'Masuk ke Login', '2025-02-03 09:32:35');
INSERT INTO `user_activity` VALUES (55, NULL, 'Masuk ke Register', '2025-02-03 09:33:42');
INSERT INTO `user_activity` VALUES (56, NULL, 'Masuk ke Login', '2025-02-03 09:33:51');
INSERT INTO `user_activity` VALUES (57, NULL, 'Masuk ke Login', '2025-02-03 09:34:45');
INSERT INTO `user_activity` VALUES (58, NULL, 'Masuk ke Register', '2025-02-03 09:35:29');
INSERT INTO `user_activity` VALUES (59, NULL, 'Masuk ke Login', '2025-02-03 09:35:37');
INSERT INTO `user_activity` VALUES (60, 31, 'Masuk ke Dashboard', '2025-02-03 09:35:41');
INSERT INTO `user_activity` VALUES (61, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:35:51');
INSERT INTO `user_activity` VALUES (62, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:35:51');
INSERT INTO `user_activity` VALUES (63, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:35:55');
INSERT INTO `user_activity` VALUES (64, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:35:55');
INSERT INTO `user_activity` VALUES (65, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:35:57');
INSERT INTO `user_activity` VALUES (66, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:35:57');
INSERT INTO `user_activity` VALUES (67, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:35:58');
INSERT INTO `user_activity` VALUES (68, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:35:58');
INSERT INTO `user_activity` VALUES (69, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:35:59');
INSERT INTO `user_activity` VALUES (70, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:35:59');
INSERT INTO `user_activity` VALUES (71, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:36:03');
INSERT INTO `user_activity` VALUES (72, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:36:03');
INSERT INTO `user_activity` VALUES (73, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:36:08');
INSERT INTO `user_activity` VALUES (74, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:36:08');
INSERT INTO `user_activity` VALUES (75, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:36:12');
INSERT INTO `user_activity` VALUES (76, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:36:12');
INSERT INTO `user_activity` VALUES (77, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:36:18');
INSERT INTO `user_activity` VALUES (78, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:36:18');
INSERT INTO `user_activity` VALUES (79, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:36:20');
INSERT INTO `user_activity` VALUES (80, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:36:20');
INSERT INTO `user_activity` VALUES (81, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:36:28');
INSERT INTO `user_activity` VALUES (82, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:36:28');
INSERT INTO `user_activity` VALUES (83, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:36:34');
INSERT INTO `user_activity` VALUES (84, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:36:34');
INSERT INTO `user_activity` VALUES (85, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:36:37');
INSERT INTO `user_activity` VALUES (86, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:36:37');
INSERT INTO `user_activity` VALUES (87, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:36:41');
INSERT INTO `user_activity` VALUES (88, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:36:45');
INSERT INTO `user_activity` VALUES (89, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:36:49');
INSERT INTO `user_activity` VALUES (90, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:36:52');
INSERT INTO `user_activity` VALUES (91, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:36:52');
INSERT INTO `user_activity` VALUES (92, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:36:59');
INSERT INTO `user_activity` VALUES (93, 31, 'Melihat History Perhitungan Luas Persegi', '2025-02-03 09:37:06');
INSERT INTO `user_activity` VALUES (94, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:37:11');
INSERT INTO `user_activity` VALUES (95, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:37:25');
INSERT INTO `user_activity` VALUES (96, 31, 'Masuk ke Rumus persegi', '2025-02-03 09:37:27');
INSERT INTO `user_activity` VALUES (97, NULL, 'Masuk ke Login', '2025-02-03 09:37:28');
INSERT INTO `user_activity` VALUES (98, 1, 'Masuk ke Dashboard', '2025-02-03 09:37:34');
INSERT INTO `user_activity` VALUES (99, 1, 'Masuk ke User', '2025-02-03 09:37:37');
INSERT INTO `user_activity` VALUES (100, 1, 'Masuk ke Tambah User', '2025-02-03 09:37:39');
INSERT INTO `user_activity` VALUES (101, 1, 'Masuk ke User', '2025-02-03 09:37:51');
INSERT INTO `user_activity` VALUES (102, 1, 'Masuk ke Edit User', '2025-02-03 09:37:53');
INSERT INTO `user_activity` VALUES (103, 1, 'Masuk ke User', '2025-02-03 09:37:55');
INSERT INTO `user_activity` VALUES (104, 1, 'Masuk ke Restore Edit User', '2025-02-03 09:37:57');
INSERT INTO `user_activity` VALUES (105, 1, 'Masuk ke User', '2025-02-03 09:37:59');
INSERT INTO `user_activity` VALUES (106, 1, 'Masuk ke User', '2025-02-03 09:38:01');
INSERT INTO `user_activity` VALUES (107, 1, 'Masuk ke Soft Delete', '2025-02-03 09:38:04');
INSERT INTO `user_activity` VALUES (108, 1, 'Masuk ke User', '2025-02-03 09:38:05');
INSERT INTO `user_activity` VALUES (109, 1, 'Masuk ke Log Activity', '2025-02-03 09:38:08');
INSERT INTO `user_activity` VALUES (110, 1, 'Masuk ke Setting', '2025-02-03 09:38:18');
INSERT INTO `user_activity` VALUES (111, 1, 'Masuk ke Setting', '2025-02-03 09:38:32');
INSERT INTO `user_activity` VALUES (112, NULL, 'Masuk ke Login', '2025-02-03 09:38:37');

-- ----------------------------
-- Table structure for user_backup
-- ----------------------------
DROP TABLE IF EXISTS `user_backup`;
CREATE TABLE `user_backup`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` enum('admin','pengguna') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `backup_by` int NULL DEFAULT NULL,
  `backup_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_backup
-- ----------------------------
INSERT INTO `user_backup` VALUES (29, 'bobi123', NULL, NULL, 'bobi123@gmail.com', 'pengguna', NULL, NULL, NULL, NULL);
INSERT INTO `user_backup` VALUES (32, 'boba kecap', NULL, NULL, 'bobakecap@gmail.com', 'pengguna', NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
