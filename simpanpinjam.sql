/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST MYSQL
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : simpanpinjam

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 17/09/2022 00:43:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sp_anggota
-- ----------------------------
DROP TABLE IF EXISTS `sp_anggota`;
CREATE TABLE `sp_anggota`  (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'idx primary',
  `nama_anggota` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_lahir_anggota` date NULL DEFAULT NULL,
  `alamat_anggota` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`idx`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sp_anggota
-- ----------------------------
INSERT INTO `sp_anggota` VALUES (1, 'Wawan Setiawan', '1990-01-10', 'kompleks Asia Serasi No 100');
INSERT INTO `sp_anggota` VALUES (2, 'Teguh Subiyantoro', '1991-01-10', 'Jalan Pemekaran No 99');
INSERT INTO `sp_anggota` VALUES (3, 'Zulfa Ahmad', '1992-03-10', 'Dusun Pisang Rt 10 Rw 20');
INSERT INTO `sp_anggota` VALUES (4, 'Uma', '2020-07-01', 'Jl. Terusan l');

-- ----------------------------
-- Table structure for sp_simpanan
-- ----------------------------
DROP TABLE IF EXISTS `sp_simpanan`;
CREATE TABLE `sp_simpanan`  (
  `idx_simpanan` int(11) NOT NULL AUTO_INCREMENT,
  `idx_anggota` int(11) NULL DEFAULT NULL,
  `jml_setor` int(7) NULL DEFAULT NULL,
  `jml_pinjam` int(7) NULL DEFAULT NULL,
  `tgl_pinjam` datetime(0) NULL DEFAULT NULL,
  `tgl_setor` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`idx_simpanan`) USING BTREE,
  INDEX `nama_anggota`(`idx_anggota`) USING BTREE,
  CONSTRAINT `nama_anggota` FOREIGN KEY (`idx_anggota`) REFERENCES `sp_anggota` (`idx`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sp_simpanan
-- ----------------------------
INSERT INTO `sp_simpanan` VALUES (1, 1, 1000000, NULL, NULL, '2020-08-17 00:00:00');
INSERT INTO `sp_simpanan` VALUES (2, 2, 5000000, NULL, NULL, '2020-08-18 00:00:00');
INSERT INTO `sp_simpanan` VALUES (3, 3, NULL, 2000000, '2020-09-30 00:00:00', NULL);
INSERT INTO `sp_simpanan` VALUES (4, 3, 1000000, NULL, NULL, '2020-11-10 00:00:00');
INSERT INTO `sp_simpanan` VALUES (5, 1, 5000000, NULL, NULL, '2020-12-01 00:00:00');
INSERT INTO `sp_simpanan` VALUES (6, 2, NULL, 2000000, NULL, '2020-12-01 00:00:00');

SET FOREIGN_KEY_CHECKS = 1;
