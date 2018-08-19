/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50719
Source Host           : 127.0.0.1:3306
Source Database       : project

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-08-19 12:56:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'gehuiqiang', 'gehuiqiang@163.com', '$2y$10$FO0Zcju4I2tkoKIUIFoTwO2xHwBeZ0TF61RIcJRoKfrj9ELbkf4WO', 'U76tiaXR3esfHv0Jf1kyOPclb1Dz4JjSdskyIRfgvW0NyTVRKsN7EvmcHFz0', null, null);
INSERT INTO `admins` VALUES ('4', 'quanxian1', 'quanxian1@1132.com', '$2y$10$MMrraMt79tPjatPfjdmgoO0EUJ1BJ0PO7mzb2wm/vTDP59OCrcFXq', null, '2018-08-12 16:37:09', '2018-08-12 16:37:09');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2018_08_04_180306_create_admins_table', '1');
INSERT INTO `migrations` VALUES ('4', '2018_08_06_135824_entrust_setup_tables', '2');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', 'system', '系统管理', '系统管理', '2018-08-11 17:36:16', '2018-08-11 17:37:33', '0');
INSERT INTO `permissions` VALUES ('2', 'version', '更新信息', 'APP版本更新', '2018-08-11 17:24:50', '2018-08-11 17:25:03', '5');
INSERT INTO `permissions` VALUES ('3', 'version.add', '新增', 'APP版本更新', '2018-08-11 17:24:53', '2018-08-11 17:25:07', '2');
INSERT INTO `permissions` VALUES ('4', 'version.update', '修改', 'APP版本更新', '2018-08-11 17:24:56', '2018-08-11 17:25:10', '2');
INSERT INTO `permissions` VALUES ('5', 'content', '内容管理', '内容管理', '2018-08-18 10:56:56', '2018-08-18 10:56:58', '0');
INSERT INTO `permissions` VALUES ('6', 'user', '用户管理', null, '2018-08-19 11:48:58', '2018-08-19 11:49:01', '1');
INSERT INTO `permissions` VALUES ('7', 'user.store', '添加', '用户添加', null, null, '6');
INSERT INTO `permissions` VALUES ('8', 'user.update', '更新', '用户更新', null, null, '6');
INSERT INTO `permissions` VALUES ('9', 'user.delete', '删除', '用户删除', null, null, '6');
INSERT INTO `permissions` VALUES ('10', 'role', '角色管理', null, null, null, '1');
INSERT INTO `permissions` VALUES ('11', 'role.store', '添加', '角色添加', null, null, '10');
INSERT INTO `permissions` VALUES ('12', 'role.update', '更新', '角色更新', null, null, '10');
INSERT INTO `permissions` VALUES ('13', 'role.delete', '删除', '角色删除', null, null, '10');

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES ('1', '7');
INSERT INTO `permission_role` VALUES ('2', '7');
INSERT INTO `permission_role` VALUES ('3', '7');
INSERT INTO `permission_role` VALUES ('4', '7');
INSERT INTO `permission_role` VALUES ('5', '7');
INSERT INTO `permission_role` VALUES ('6', '7');
INSERT INTO `permission_role` VALUES ('8', '7');
INSERT INTO `permission_role` VALUES ('9', '7');
INSERT INTO `permission_role` VALUES ('10', '7');
INSERT INTO `permission_role` VALUES ('11', '7');
INSERT INTO `permission_role` VALUES ('12', '7');
INSERT INTO `permission_role` VALUES ('13', '7');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'admin', '超级管理员', '系统的管理员', '2018-08-11 17:05:42', '2018-08-11 17:05:46');
INSERT INTO `roles` VALUES ('2', 'yunying', '运营经理', '运营人员', '2018-08-11 17:50:54', '2018-08-11 17:50:54');
INSERT INTO `roles` VALUES ('4', 'test', '测试人员', '测试人员', '2018-08-12 14:12:11', '2018-08-12 14:12:11');
INSERT INTO `roles` VALUES ('7', 'admin1', '管理员', '系统的管理员', '2018-08-12 15:12:08', '2018-08-12 15:12:08');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('1', '7');

-- ----------------------------
-- Table structure for t_app_version
-- ----------------------------
DROP TABLE IF EXISTS `t_app_version`;
CREATE TABLE `t_app_version` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `version` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '当前版本号',
  `update_version` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '更新版本号',
  `mandatory_update` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '是否强制更新: Y 强制更新 N 不强制更新',
  `os_type` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT ' 设备 1 IOS 2 Android',
  `content` varchar(500) CHARACTER SET utf8 DEFAULT NULL COMMENT '更新文案',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of t_app_version
-- ----------------------------
INSERT INTO `t_app_version` VALUES ('1', '5.6.2', '4.0.2', 'N', '2', '1.优化体验列表\r\n2.修复已知bug\r\n3.定义部分功能\r\n4.增加智慧投');
INSERT INTO `t_app_version` VALUES ('2', '5.6.3', '4.0.2', 'N', '1', '1.优化体验列表\r\n2.修复已知bug\r\n3.定义部分功能\r\n4.增加智慧投');
INSERT INTO `t_app_version` VALUES ('3', '5.6.4', '4.0.2', 'Y', '1', '1.优化体验列表\r\n2.修复已知bug\r\n3.定义部分功能\r\n4.增加智慧投');
INSERT INTO `t_app_version` VALUES ('4', '5.6.5', '4.0.2', 'N', '1', '1.优化体验列表\r\n2.修复已知bug\r\n3.定义部分功能\r\n4.增加智慧投');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'gehuiqiang', 'gehuiqiang@163.com', '$2y$10$FO0Zcju4I2tkoKIUIFoTwO2xHwBeZ0TF61RIcJRoKfrj9ELbkf4WO', 'V9YdLj2Wu7Ty9URBWOdDxQW053w9kxCgrFsv9KJpll584PBuADCDdcz6HjgA', null, null);
INSERT INTO `users` VALUES ('2', 'gehuiqiang', 'huiqiangg@163.com', '$2y$10$FO0Zcju4I2tkoKIUIFoTwO2xHwBeZ0TF61RIcJRoKfrj9ELbkf4WO', '3JlQQYskdeVXz5ap6YbJJ54Qnk8Tv14bm1bfVgf1VmUEeKhPBWs7QBpsdcHL', '2018-08-05 16:30:33', '2018-08-05 16:30:33');
