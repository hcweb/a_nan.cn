/*
Navicat MySQL Data Transfer

Source Server         : phpstudy
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : a_nan

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-06-07 14:05:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blocks
-- ----------------------------
DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '自定义资料标题',
  `type` char(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'F文字|I图片|E编辑',
  `body` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of blocks
-- ----------------------------
INSERT INTO `blocks` VALUES ('5', '首页背景图', 'I', 'uploads/images/picture/201805/29/site__1527601630_x9pGghy5ek.png', null, null);
INSERT INTO `blocks` VALUES ('6', '个人头像', 'I', 'uploads/images/picture/201805/29/site__1527604326_FcPoa9hUK0.png', null, null);

-- ----------------------------
-- Table structure for categorys
-- ----------------------------
DROP TABLE IF EXISTS `categorys`;
CREATE TABLE `categorys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '栏目标题',
  `route` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '栏目路由名称',
  `target` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self' COMMENT '栏目打开方式',
  `icon_class` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '栏目图标',
  `color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '栏目颜色',
  `height_url` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '栏目高亮',
  `parent_id` int(11) unsigned DEFAULT NULL COMMENT '父类id',
  `order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '栏目排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `alias` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '调用别名',
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO标题',
  `seo_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO关健字',
  `seo_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO描述',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'URL链接,填写后直接跳转到该网址',
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '封面图片',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT '栏目描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `_lft` int(10) unsigned NOT NULL,
  `_rgt` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categorys_title_unique` (`title`),
  UNIQUE KEY `categorys_alias_unique` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of categorys
-- ----------------------------
INSERT INTO `categorys` VALUES ('10', '文章', 'category', '_self', null, null, null, null, '0', '1', 'article', null, null, null, null, null, null, '2018-05-27 16:41:11', '2018-05-27 16:41:11', '1', '8');
INSERT INTO `categorys` VALUES ('11', 'php', 'category/php', '_self', null, null, null, '10', '0', '1', 'php', null, null, null, null, null, null, '2018-05-27 20:02:53', '2018-05-27 20:02:53', '2', '3');
INSERT INTO `categorys` VALUES ('12', 'laravel', 'category/laravel', '_self', null, null, null, '10', '0', '1', 'laravel', null, null, null, null, null, null, '2018-05-27 20:03:22', '2018-05-27 20:03:22', '4', '5');
INSERT INTO `categorys` VALUES ('13', 'css3', 'category/css3', '_self', null, null, null, '10', '0', '1', 'css3', null, null, null, null, null, null, '2018-05-27 20:05:23', '2018-05-27 20:05:23', '6', '7');
INSERT INTO `categorys` VALUES ('14', '留言', 'message', '_self', null, null, null, null, '0', '1', 'leaving-a-message', null, null, null, null, null, null, '2018-05-27 20:06:09', '2018-05-27 20:06:09', '9', '10');
INSERT INTO `categorys` VALUES ('15', '实验室', 'laboratory', '_self', null, null, null, null, '0', '1', 'laboratory', null, null, null, null, null, null, '2018-05-27 20:06:44', '2018-05-27 20:06:44', '11', '12');
INSERT INTO `categorys` VALUES ('16', '关于', 'about', '_self', null, null, null, null, '0', '1', 'about', null, null, null, null, null, null, '2018-05-27 20:07:00', '2018-05-27 20:07:00', '13', '14');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '评论的标题',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '评论的内容',
  `visitor` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '地址',
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '所在城市',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '审核状态',
  `member_id` int(10) unsigned NOT NULL COMMENT '会员id',
  `post_id` int(10) unsigned NOT NULL COMMENT '会员id',
  `parent_id` int(10) unsigned DEFAULT NULL,
  `_lft` int(10) unsigned NOT NULL DEFAULT '0',
  `_rgt` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_member_id_foreign` (`member_id`),
  KEY `comments_post_id_foreign` (`post_id`),
  KEY `comments__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`),
  CONSTRAINT `comments_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('61', null, '<img src=/static/qqFace/arclist/9.gif border=0 >无限级评论实现 哈哈', '112.115.223.65', '云南.昆明', '1', '85', '6', null, '1', '10', '2018-05-26 23:48:46', '2018-05-26 23:48:46');
INSERT INTO `comments` VALUES ('62', null, '大神牛逼呀 呵呵', '112.115.223.65', '云南.昆明', '1', '83', '6', '61', '2', '9', '2018-05-26 23:55:03', '2018-05-26 23:55:03');
INSERT INTO `comments` VALUES ('63', null, '真好 哈哈哈哈哈哈哈', '112.115.223.65', '云南.昆明', '1', '84', '6', '62', '3', '6', '2018-05-26 23:56:06', '2018-05-26 23:56:06');
INSERT INTO `comments` VALUES ('64', null, '<img src=/static/qqFace/arclist/4.gif border=0 ><img src=/static/qqFace/arclist/41.gif border=0 >温热无若我认为认为认为认为认为认为', '112.115.223.65', '云南.昆明', '1', '84', '6', null, '11', '12', '2018-05-26 23:56:39', '2018-05-26 23:56:39');
INSERT INTO `comments` VALUES ('65', null, '所发生的发生的发生的发生的发生的发生的发生的发生的发生的', '112.115.223.65', '云南.昆明', '1', '85', '6', '63', '4', '5', '2018-05-26 23:58:34', '2018-05-26 23:58:34');
INSERT INTO `comments` VALUES ('66', null, '阿荣旗二却日期日期', '112.115.223.65', '云南.昆明', '1', '85', '6', '62', '7', '8', '2018-05-26 23:59:27', '2018-05-26 23:59:27');
INSERT INTO `comments` VALUES ('67', null, '博主牛逼呀', '218.63.137.67', '云南.昆明', '0', '84', '4', null, '13', '14', '2018-05-30 09:36:33', '2018-05-30 09:36:33');
INSERT INTO `comments` VALUES ('68', null, 'erterterterterterterter', '218.63.137.67', '云南.昆明', '0', '84', '6', null, '15', '16', '2018-05-30 12:24:23', '2018-05-30 12:24:23');

-- ----------------------------
-- Table structure for links
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '友情链接分类名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `links_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of links
-- ----------------------------
INSERT INTO `links` VALUES ('1', '前端博客', '2018-03-21 23:34:49', '2018-03-21 23:34:49');
INSERT INTO `links` VALUES ('2', '设计艺术', '2018-04-01 12:10:49', '2018-04-01 12:10:49');

-- ----------------------------
-- Table structure for link_items
-- ----------------------------
DROP TABLE IF EXISTS `link_items`;
CREATE TABLE `link_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link_id` int(10) unsigned NOT NULL COMMENT '友情链接分类',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '友情链接标题',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'url链接',
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '链接的logo',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '链接描述',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系人',
  `user_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系人手机',
  `user_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系人邮箱',
  `order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `link_items_title_unique` (`title`),
  KEY `link_items_link_id_foreign` (`link_id`),
  CONSTRAINT `link_items_link_id_foreign` FOREIGN KEY (`link_id`) REFERENCES `links` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of link_items
-- ----------------------------
INSERT INTO `link_items` VALUES ('1', '2', '网易用户体验设计中心', 'http://uedc.163.com/', 'uploads/images/link/201804/01/site__1522555932_tBs3PjalnD.png', null, '1', null, '13577069756', '871328529@qq.com', '0', '2018-04-01 12:12:53', '2018-04-01 12:12:53');

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '会员名称',
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '会员头像',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '会员邮箱',
  `tel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '会员手机',
  `visitor` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '最后登录IP',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '会员状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户密码',
  `platform` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '注册平台',
  `openid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_openid_unique` (`openid`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of members
-- ----------------------------
INSERT INTO `members` VALUES ('41', 'Chanel Wilderman', 'https://lorempixel.com/100/100/?97390', 'isaiah.williamson@yahoo.com', '448.490.7061', 'Rigobertoberg', '1', '2018-04-11 20:59:13', '2018-04-11 20:59:13', '$2y$10$KIVYux2W.S4rUazLZBk/nuwJ/ZYxB2nZEMBnXJq9i0e5pN/TF9mj.', null, null);
INSERT INTO `members` VALUES ('42', 'Dr. Nicola Sawayn II', 'https://lorempixel.com/100/100/?57822', 'xkozey@hahn.com', '+1 (865) 891-4370', 'South Jakeview', '1', '2018-04-11 20:59:14', '2018-04-11 20:59:14', '$2y$10$6cY3IzYIh/8WgdDgQOgpjOsuoenNiS6KHM/e47bCVcuqwtfHthZYe', null, null);
INSERT INTO `members` VALUES ('43', 'Matilde Gerlach', 'https://lorempixel.com/100/100/?77424', 'arlene.bauch@hotmail.com', '1-523-889-5060', 'Port Jeradbury', '1', '2018-04-11 20:59:14', '2018-04-11 20:59:14', '$2y$10$dIf9ts7q6iS7VtHIbEAjP.lXebQG2cDMZ4lG5kXvEYOhNULuriSeC', null, null);
INSERT INTO `members` VALUES ('44', 'Amanda Erdman', 'https://lorempixel.com/100/100/?43884', 'rashad86@hotmail.com', '+1-656-866-0368', 'Axelton', '1', '2018-04-11 20:59:14', '2018-04-11 20:59:14', '$2y$10$EwHE12FCKNDr7lbzDArBYeziKohBC0hIf9MAUGUPK2veT1ijlwbHW', null, null);
INSERT INTO `members` VALUES ('45', 'Adelle Spencer', 'https://lorempixel.com/100/100/?54070', 'moore.maxime@treutel.com', '250.951.9230 x485', 'Fionahaven', '1', '2018-04-11 20:59:14', '2018-04-11 20:59:14', '$2y$10$EKWQR8UwNASnHwiQ5lLqqeaZz.Mq2r0m6LFYPoIcHW0TwVbv4EzFC', null, null);
INSERT INTO `members` VALUES ('46', 'Delaney McKenzie', 'https://lorempixel.com/100/100/?14364', 'valerie.white@hotmail.com', '957.687.2815 x5800', 'South Elsa', '1', '2018-04-11 20:59:14', '2018-04-11 20:59:14', '$2y$10$ayVnnFxzfAWy40Fetq6s6u0sF6xVQjMFYZIbnjVbFgcFvLfob1Rc6', null, null);
INSERT INTO `members` VALUES ('47', 'Dr. Jayda Schiller', 'https://lorempixel.com/100/100/?21245', 'lebsack.simeon@hotmail.com', '1-548-969-1663', 'Harrishaven', '1', '2018-04-11 20:59:14', '2018-04-11 20:59:14', '$2y$10$nsyet0dzryzFme4zrO26E.QrcwzKAtSfDQR1agrpjMs6EqT/bo8Z.', null, null);
INSERT INTO `members` VALUES ('48', 'Ms. Lauriane Ankunding MD', 'https://lorempixel.com/100/100/?48903', 'jefferey21@willms.com', '(758) 529-1302', 'West Barton', '1', '2018-04-11 20:59:15', '2018-04-11 20:59:15', '$2y$10$YLbF7KULSmVokDtjCw7oXOmf5z9bLHg1eIMPU9AUnHt7VFX7B.CuO', null, null);
INSERT INTO `members` VALUES ('49', 'Wilber Kuphal', 'https://lorempixel.com/100/100/?31802', 'stehr.vida@ryan.com', '+1-228-801-6702', 'Vandervortburgh', '1', '2018-04-11 20:59:15', '2018-04-11 20:59:15', '$2y$10$WldZy6fkzjo/sjQs8huJCelzk3BkFE1S9guQ240amIj0PMr5y9e3G', null, null);
INSERT INTO `members` VALUES ('50', 'Bettie Grady DDS', 'https://lorempixel.com/100/100/?52545', 'zieme.efren@hotmail.com', '(407) 566-1977', 'Jerdeborough', '1', '2018-04-11 20:59:15', '2018-04-11 20:59:15', '$2y$10$HSn8Abo0q2UesD8d/8422OJgzOMxM5/odGaLEEyFA5Zug0ThpLSai', null, null);
INSERT INTO `members` VALUES ('51', 'Gerardo Rippin', 'https://lorempixel.com/100/100/?68865', 'windler.maribel@yahoo.com', '(762) 852-8346 x43989', 'Hermistonside', '1', '2018-04-11 20:59:15', '2018-04-11 20:59:15', '$2y$10$av5lyJ0hMnKs9cxd8mkhieXaQMCWpfcuJ5uT4aMa7bxwwfkDfsTti', null, null);
INSERT INTO `members` VALUES ('52', 'Myah Schaefer', 'https://lorempixel.com/100/100/?83866', 'vonrueden.eleonore@schultz.com', '+1 (981) 385-4319', 'South Abagail', '1', '2018-04-11 20:59:15', '2018-04-11 20:59:15', '$2y$10$zTEPP2R2MIW8vWR57ubEc.Hu5Czic/l/gSl657JXOVnZL.4XmTUk2', null, null);
INSERT INTO `members` VALUES ('53', 'Brionna Bechtelar V', 'https://lorempixel.com/100/100/?51485', 'vbarrows@raynor.com', '+19699624014', 'Port Hosea', '1', '2018-04-11 20:59:15', '2018-04-11 20:59:15', '$2y$10$L5KPrCKZHEv4QCoIo09HzuS2rdVbdmfbdhJclaRL4mrSeQo/78k32', null, null);
INSERT INTO `members` VALUES ('54', 'Nikko Lubowitz', 'https://lorempixel.com/100/100/?83470', 'erdman.delores@gmail.com', '(431) 561-1764', 'Lake Oraberg', '1', '2018-04-11 20:59:15', '2018-04-11 20:59:15', '$2y$10$qwTgPftd3ZnRHQrI/dm/fuUL3kFEEFA9E2.mcX0sb8uaieykbWQUC', null, null);
INSERT INTO `members` VALUES ('55', 'Esta Mills', 'https://lorempixel.com/100/100/?67297', 'gleason.trycia@yahoo.com', '1-713-987-9382', 'Cormierton', '1', '2018-04-11 20:59:15', '2018-04-11 20:59:15', '$2y$10$XgEefJjgypqM28DQT1gMsO1KE0vtYxjsB5Hnw7PiTqbbYkwnGbd6.', null, null);
INSERT INTO `members` VALUES ('56', 'Mrs. Kari Champlin', 'https://lorempixel.com/100/100/?72153', 'raynor.kyler@lesch.info', '295.883.0365 x384', 'Flossiehaven', '1', '2018-04-11 20:59:16', '2018-04-11 20:59:16', '$2y$10$oVEqhxlaC1rTarAsc16xKuImk6ZM2K8zVRfPGyg787c8.ocVbIxfq', null, null);
INSERT INTO `members` VALUES ('57', 'Dana Leuschke', 'https://lorempixel.com/100/100/?56114', 'lonie.paucek@yahoo.com', '(419) 954-6546', 'South Sigurdview', '1', '2018-04-11 20:59:16', '2018-04-11 20:59:16', '$2y$10$IWsYpCIutuRjHWiqAB5U/uAGhqHKGIePDfDB0zlOBm/768QuboagG', null, null);
INSERT INTO `members` VALUES ('58', 'Makayla Kreiger', 'https://lorempixel.com/100/100/?46998', 'jordyn.von@hotmail.com', '1-960-335-7635 x593', 'Kreigerhaven', '1', '2018-04-11 20:59:16', '2018-04-11 20:59:16', '$2y$10$9a0Zpwzl5Qumdn0D492xwuaLG3a092BHgebCodGVpoaauDp.pW0Pi', null, null);
INSERT INTO `members` VALUES ('59', 'Chesley Grady', 'https://lorempixel.com/100/100/?59524', 'lia55@reichert.com', '+1 (805) 735-3788', 'South Geovannystad', '1', '2018-04-11 20:59:16', '2018-04-11 20:59:16', '$2y$10$KPYDvROJ.ry25I3GARgdcuuSFq2BooaMsZB4F0Co5i.s7THUTgVXC', null, null);
INSERT INTO `members` VALUES ('60', 'Mr. Derrick Bode', 'https://lorempixel.com/100/100/?10734', 'reinger.jaquan@yahoo.com', '(557) 470-9843 x538', 'East Lonny', '1', '2018-04-11 20:59:16', '2018-04-11 20:59:16', '$2y$10$1rF1ggEj7komqXzBEzfXxOP5PNdJzbhkVjzEFod/gUBtTAQMSDkLe', null, null);
INSERT INTO `members` VALUES ('61', 'Mrs. Adaline Zulauf', 'https://lorempixel.com/100/100/?51794', 'schaefer.jesse@gmail.com', '709-780-0896 x2838', 'Lynchburgh', '1', '2018-04-11 21:00:01', '2018-04-11 21:00:01', '$2y$10$X1dnynbfVcOcFk25XFI66.DgycYxq2Zq3HZu5W5w6237hGvBz4eSi', null, null);
INSERT INTO `members` VALUES ('62', 'Anabelle Heidenreich', 'https://lorempixel.com/100/100/?81637', 'xbraun@hotmail.com', '284-503-3381 x744', 'Darianstad', '1', '2018-04-11 21:00:01', '2018-04-11 21:00:01', '$2y$10$il/s7LC561DXOTcETsV5VuRgutZ2jxdQJJMy3d/myxFfYXrrr8Leq', null, null);
INSERT INTO `members` VALUES ('63', 'Jimmy Treutel', 'https://lorempixel.com/100/100/?77029', 'sonya01@eichmann.biz', '1-359-988-9565 x19526', 'East Juwanton', '1', '2018-04-11 21:00:02', '2018-04-11 21:00:02', '$2y$10$Up0QjpmSrsemUpezF1wAyeZZatQD2.KXdFVvPxjmQsqdq40Cs14QC', null, null);
INSERT INTO `members` VALUES ('64', 'Amya Brakus I', 'https://lorempixel.com/100/100/?46008', 'purdy.reva@walsh.com', '1-712-465-9389 x75049', 'East Marinaborough', '1', '2018-04-11 21:00:02', '2018-04-11 21:00:02', '$2y$10$YTHgdhetek5qQWIJ0XdSzufR96hLOar3Dz7ERF.NSCMjB6wdxs2MW', null, null);
INSERT INTO `members` VALUES ('65', 'Alejandrin Mante III', 'https://lorempixel.com/100/100/?45446', 'kari53@gmail.com', '(702) 451-5125 x475', 'Stiedemannhaven', '1', '2018-04-11 21:00:02', '2018-04-11 21:00:02', '$2y$10$bjnOdprVCikq6IV.nRLRbeqtYlgFqgtfZbgkQ.aiRJBt5tIaMLkrG', null, null);
INSERT INTO `members` VALUES ('66', 'Olin Miller', 'https://lorempixel.com/100/100/?29686', 'elinor.skiles@gorczany.biz', '+1-545-735-7858', 'Lake Erling', '1', '2018-04-11 21:00:02', '2018-04-11 21:00:02', '$2y$10$yeZjgLbAz.4kwldXZR0wdeyjqSWLaX0ArS2aWgW5booYyqApmgCsO', null, null);
INSERT INTO `members` VALUES ('67', 'Ottis Kunze', 'https://lorempixel.com/100/100/?43011', 'ydooley@schmitt.org', '+1-976-255-0123', 'Moenchester', '1', '2018-04-11 21:00:02', '2018-04-11 21:00:02', '$2y$10$h2mAlj2C2pA8q9MiuGCWue5xJHcIX8RU8OOP/jMo4QYe9mlUWmhUe', null, null);
INSERT INTO `members` VALUES ('68', 'Ebba Hagenes DVM', 'https://lorempixel.com/100/100/?69737', 'twisoky@yahoo.com', '1-568-896-2962 x51451', 'Maggiemouth', '1', '2018-04-11 21:00:02', '2018-04-11 21:00:02', '$2y$10$hoRyhy3WMSlvFYDntraR7O6mfSF6jhBFKoNFiK6s4ZWzL/vlsm/gG', null, null);
INSERT INTO `members` VALUES ('69', 'Dr. Lea Parker', 'https://lorempixel.com/100/100/?36154', 'rrath@steuber.com', '206-258-5854', 'Gerdamouth', '1', '2018-04-11 21:00:02', '2018-04-11 21:00:02', '$2y$10$NCwSJDWRjOw.JXbMTiDC.upErMbUNMEgm7ZH/Hmbv2Ts6LWHO2l0m', null, null);
INSERT INTO `members` VALUES ('70', 'Mr. Zander Hane', 'https://lorempixel.com/100/100/?63467', 'shaun.rau@kris.org', '(463) 716-5389', 'Windlerside', '1', '2018-04-11 21:00:02', '2018-04-11 21:00:02', '$2y$10$KO1LiUOUh/lsxN1BTcsdBu3g93M3lc/Pi0hvcMTIO8JsrHjmPyw8C', null, null);
INSERT INTO `members` VALUES ('71', 'Darion Kuphal', 'https://lorempixel.com/100/100/?71712', 'frutherford@upton.com', '1-212-400-0349 x5612', 'West Tonishire', '1', '2018-04-11 21:00:03', '2018-04-11 21:00:03', '$2y$10$J2ZI.4MzvZbaUBgykeJf8OTNMV8YjTKBb/XznR/IBg4KZS1/MDSpu', null, null);
INSERT INTO `members` VALUES ('72', 'Prof. Sterling Jones', 'https://lorempixel.com/100/100/?35091', 'ruth.schowalter@hotmail.com', '1-341-810-0467', 'North Mavisfurt', '1', '2018-04-11 21:00:03', '2018-04-11 21:00:03', '$2y$10$8BYAEr3ZLKHfUbOJ23L0fOphICkxkCiAfLWgQOPsJithNEYT4.gRW', null, null);
INSERT INTO `members` VALUES ('73', 'Ignacio Hilll', 'https://lorempixel.com/100/100/?33778', 'kozey.mae@schinner.com', '396.670.2139 x03666', 'Lake Marcelino', '1', '2018-04-11 21:00:03', '2018-04-11 21:00:03', '$2y$10$XwqumYUMzpk054AjHqgAVeIBOGGNZWC7nD6g9vKmh6YWUCXFIjeEC', null, null);
INSERT INTO `members` VALUES ('74', 'Prof. Rosella Frami DVM', 'https://lorempixel.com/100/100/?38893', 'abbey.pfannerstill@bosco.com', '(406) 654-5915', 'West Lily', '1', '2018-04-11 21:00:03', '2018-04-11 21:00:03', '$2y$10$OaFpheLwWHSz6B8eAL6QzeMuCYJbAfvEPQYSkx/fueSEHB.gHj5KG', null, null);
INSERT INTO `members` VALUES ('75', 'Johnny Durgan I', 'https://lorempixel.com/100/100/?12732', 'cordie49@crist.com', '559-474-5457 x366', 'Port Aubreyton', '1', '2018-04-11 21:00:03', '2018-04-11 21:00:03', '$2y$10$shZnEfrLwGEXK5emixTL0ecu5friw7nv7PKxf18jvI5IeH6NI8/SO', null, null);
INSERT INTO `members` VALUES ('76', 'Mrs. Estell D\'Amore PhD', 'https://lorempixel.com/100/100/?81118', 'jo88@bahringer.net', '+1.392.232.3581', 'South Federicostad', '1', '2018-04-11 21:00:03', '2018-04-11 21:00:03', '$2y$10$3OTWHdAba/Ufu/R35gOCCeD6ZpWUUDF25W4ttfBnnvvyRikTWxCtu', null, null);
INSERT INTO `members` VALUES ('77', 'Haylee Leuschke', 'https://lorempixel.com/100/100/?20346', 'jaunita.gleason@gmail.com', '1-960-867-6862 x49810', 'Rueckerbury', '1', '2018-04-11 21:00:03', '2018-04-11 21:00:03', '$2y$10$AL/AqGUzlrDGGGg2BcHLROkYmXo8Qlfz4VRgFlqKZZ2/03kIDRn72', null, null);
INSERT INTO `members` VALUES ('78', 'Mr. Charlie Runolfsson', 'https://lorempixel.com/100/100/?30485', 'lullrich@yahoo.com', '551-252-9512 x5407', 'South Shadville', '1', '2018-04-11 21:00:04', '2018-04-11 21:00:04', '$2y$10$vzTK3/4Mvm12lJggPEIUCuNXYWN7fJwJrf2GJj13N2FUogmMoCen6', null, null);
INSERT INTO `members` VALUES ('79', 'Eveline Romaguera', 'https://lorempixel.com/100/100/?30573', 'xwyman@lind.com', '936-785-0270 x1473', 'Prohaskaborough', '1', '2018-04-11 21:00:04', '2018-04-11 21:00:04', '$2y$10$BgxszlWOj1T7kzWnenuUI.ozkX.n4i4EJ7KD4VqaGilGuug.leunG', null, null);
INSERT INTO `members` VALUES ('80', 'Toy Buckridge', 'https://lorempixel.com/100/100/?32543', 'franecki.wilfredo@buckridge.org', '(701) 820-0150 x1457', 'Brianaport', '1', '2018-04-11 21:00:04', '2018-04-11 21:00:04', '$2y$10$VbaQXU/BHU190b9/Cnp2uuc2vQbisQpvu7pf9wCZiFjOZpPmYu24G', null, null);
INSERT INTO `members` VALUES ('83', 'hcweb', 'https://avatars2.githubusercontent.com/u/12317944?v=4', null, null, null, '1', '2018-04-17 21:12:20', '2018-04-17 21:12:20', null, 'github', '12317944');
INSERT INTO `members` VALUES ('84', 'ωō╄→尛湳', 'http://thirdqq.qlogo.cn/qqapp/101474924/71212E2B7E3138B6CF0513768FD162CE/100', null, null, '182.245.79.130', '1', '2018-05-22 23:42:22', '2018-05-22 23:42:22', null, null, '71212E2B7E3138B6CF0513768FD162CE');
INSERT INTO `members` VALUES ('85', '恒创网络', 'http://thirdqq.qlogo.cn/qqapp/101474924/796092E60010E502CDDBE27DE57530BA/100', null, null, '112.115.223.65', '1', '2018-05-26 22:45:32', '2018-05-26 22:45:32', null, null, '796092E60010E502CDDBE27DE57530BA');

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '菜单标题',
  `route` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '菜单路由名称',
  `target` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self' COMMENT '菜单打开方式',
  `icon_class` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单图标',
  `color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单颜色',
  `height_url` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单高亮',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父类id',
  `order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '菜单排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('16', '控制面板', 'home', '_self', 'fa fa-home', null, null, '0', '0', '1', '2018-02-07 15:22:34', '2018-03-17 10:59:46');
INSERT INTO `menus` VALUES ('17', '用户管理', 'javascript:;', '_self', 'fa fa-users', null, null, '0', '0', '1', '2018-02-07 15:23:00', '2018-02-12 23:45:00');
INSERT INTO `menus` VALUES ('18', '系统用户', 'user.index', '_self', null, null, null, '17', '0', '1', '2018-02-07 15:23:28', '2018-02-07 15:23:28');
INSERT INTO `menus` VALUES ('19', '角色管理', 'role.index', '_self', null, null, null, '17', '0', '1', '2018-02-07 15:23:59', '2018-02-07 15:23:59');
INSERT INTO `menus` VALUES ('20', '权限管理', 'permission.index', '_self', null, null, null, '17', '0', '1', '2018-02-07 15:24:23', '2018-02-07 15:24:23');
INSERT INTO `menus` VALUES ('21', '站点管理', 'javascript:;', '_self', 'fa fa-globe', null, null, '0', '0', '1', '2018-02-07 15:25:17', '2018-03-15 16:47:29');
INSERT INTO `menus` VALUES ('22', '后台菜单', 'menu.index', '_self', null, null, null, '21', '0', '1', '2018-02-07 15:25:47', '2018-03-15 16:25:38');
INSERT INTO `menus` VALUES ('24', '系统配置', 'system.index', '_self', null, null, null, '21', '0', '1', '2018-03-15 15:46:14', '2018-03-15 16:33:13');
INSERT INTO `menus` VALUES ('25', '会员管理', 'member.index', '_self', null, null, null, '17', '0', '1', '2018-03-15 16:18:16', '2018-03-15 16:18:16');
INSERT INTO `menus` VALUES ('26', '内容管理', 'javascript:;', '_self', 'fa fa-book', null, null, '0', '0', '1', '2018-03-15 16:41:08', '2018-03-15 16:41:08');
INSERT INTO `menus` VALUES ('27', '自定义资料管理', 'block.index', '_self', null, null, null, '26', '0', '1', '2018-03-15 16:42:24', '2018-03-15 16:46:35');
INSERT INTO `menus` VALUES ('28', '文章管理', 'post.index', '_self', null, null, null, '26', '0', '1', '2018-03-15 16:43:18', '2018-03-15 16:43:18');
INSERT INTO `menus` VALUES ('29', '留言管理', 'message.index', '_self', null, null, null, '26', '0', '1', '2018-03-15 16:45:01', '2018-03-15 16:45:01');
INSERT INTO `menus` VALUES ('30', '评论管理', 'comment.index', '_self', null, null, null, '26', '0', '1', '2018-03-15 16:45:31', '2018-03-15 16:45:31');
INSERT INTO `menus` VALUES ('31', '前台菜单', 'category.index', '_self', null, null, null, '21', '0', '1', '2018-03-19 10:39:44', '2018-03-19 10:40:15');
INSERT INTO `menus` VALUES ('32', '友情链接', 'link.index', '_self', null, null, null, '26', '0', '1', '2018-03-20 19:49:55', '2018-03-20 19:49:55');
INSERT INTO `menus` VALUES ('33', '主题管理', 'theme.index', '_self', null, null, null, '21', '0', '1', '2018-03-25 12:25:47', '2018-03-25 12:25:47');
INSERT INTO `menus` VALUES ('34', '标签管理', 'tag.index', '_self', null, null, null, '26', '0', '1', '2018-03-27 20:44:36', '2018-03-27 20:44:36');

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '评论的标题',
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '评论的内容',
  `visitor` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '地址',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '审核状态',
  `reply` text COLLATE utf8mb4_unicode_ci COMMENT '回复内容',
  `reply_id` int(11) NOT NULL COMMENT '回复id主要是记录回复的本次的comment_id',
  `member_id` int(10) unsigned NOT NULL COMMENT '会员id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_member_id_foreign` (`member_id`),
  CONSTRAINT `messages_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of messages
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2018_01_25_065123_create_permission_tables', '1');
INSERT INTO `migrations` VALUES ('4', '2018_01_31_102112_create_menus_table', '1');
INSERT INTO `migrations` VALUES ('5', '2018_03_15_154853_create_systems_table', '1');
INSERT INTO `migrations` VALUES ('6', '2018_03_15_155446_create_blocks_table', '1');
INSERT INTO `migrations` VALUES ('7', '2018_03_15_155705_create_posts_table', '1');
INSERT INTO `migrations` VALUES ('8', '2018_03_15_155935_create_members_table', '1');
INSERT INTO `migrations` VALUES ('9', '2018_03_15_160403_create_links_table', '1');
INSERT INTO `migrations` VALUES ('10', '2018_03_15_160606_create_messages_table', '1');
INSERT INTO `migrations` VALUES ('11', '2018_03_15_160659_create_comments_table', '1');
INSERT INTO `migrations` VALUES ('12', '2018_03_19_103657_create_categories_table', '1');
INSERT INTO `migrations` VALUES ('13', '2018_03_21_160344_create_tags_table', '1');
INSERT INTO `migrations` VALUES ('14', '2018_03_21_162155_create_tag_post_table', '1');
INSERT INTO `migrations` VALUES ('17', '2018_03_25_122358_create_themes_table', '2');
INSERT INTO `migrations` VALUES ('18', '2018_04_10_235729_add_password_to_members_table', '3');
INSERT INTO `migrations` VALUES ('19', '2018_04_17_204027_add_regtype_to_members_table', '4');
INSERT INTO `migrations` VALUES ('20', '2018_04_20_214055_add_city_to_comments_table', '5');
INSERT INTO `migrations` VALUES ('22', '2018_04_20_215716_add_sort_to_comments_table', '6');
INSERT INTO `migrations` VALUES ('23', '2018_05_09_210202_add_nestedset_to_categories_table', '7');

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES ('1', '2', 'App\\Models\\User');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限名称',
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限别名',
  `describe` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限描述',
  `menu_id` int(10) unsigned NOT NULL COMMENT '栏目名称,预留字段',
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`),
  UNIQUE KEY `permissions_alias_unique` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('21', 'menu_index', '菜单列表', null, '22', 'web', '2018-03-14 14:00:07', '2018-03-14 14:00:07');
INSERT INTO `permissions` VALUES ('22', 'menu_create', '创建菜单', null, '22', 'web', '2018-03-14 14:00:33', '2018-03-14 14:05:08');
INSERT INTO `permissions` VALUES ('23', 'menu_show', '查看菜单', null, '22', 'web', '2018-03-14 14:01:26', '2018-03-14 14:06:41');
INSERT INTO `permissions` VALUES ('24', 'menu_edit', '编辑菜单', null, '22', 'web', '2018-03-14 14:01:51', '2018-03-14 14:07:51');
INSERT INTO `permissions` VALUES ('25', 'menu_destroy', '删除菜单', null, '22', 'web', '2018-03-14 14:02:15', '2018-03-14 14:05:30');
INSERT INTO `permissions` VALUES ('26', 'user_edit', '编辑用户', null, '18', 'web', '2018-03-14 14:08:24', '2018-03-14 14:08:24');
INSERT INTO `permissions` VALUES ('27', 'user_index', '用户列表', null, '18', 'web', '2018-03-14 14:08:59', '2018-03-14 14:08:59');
INSERT INTO `permissions` VALUES ('28', 'user_create', '创建用户', null, '18', 'web', '2018-03-14 14:09:26', '2018-03-14 14:11:57');
INSERT INTO `permissions` VALUES ('29', 'user_destroy', '删除用户', null, '18', 'web', '2018-03-14 14:11:42', '2018-03-14 14:11:42');
INSERT INTO `permissions` VALUES ('30', 'role_index', '角色列表', null, '19', 'web', '2018-03-14 14:12:33', '2018-03-14 14:12:33');
INSERT INTO `permissions` VALUES ('31', 'role_show', '查看角色', null, '19', 'web', '2018-03-14 14:13:02', '2018-03-14 14:13:02');
INSERT INTO `permissions` VALUES ('32', 'role_edit', '编辑角色', null, '19', 'web', '2018-03-14 14:13:24', '2018-03-14 14:13:35');
INSERT INTO `permissions` VALUES ('33', 'role_create', '创建角色', null, '19', 'web', '2018-03-14 14:14:17', '2018-03-14 14:14:17');
INSERT INTO `permissions` VALUES ('34', 'role_destroy', '删除角色', null, '19', 'web', '2018-03-14 14:14:56', '2018-03-14 14:14:56');
INSERT INTO `permissions` VALUES ('35', 'role_update', '更新角色', null, '0', 'web', '2018-03-14 14:15:25', '2018-03-14 14:15:25');
INSERT INTO `permissions` VALUES ('36', 'user_login', '用户登录', null, '18', 'web', '2018-03-14 14:58:21', '2018-03-14 14:58:21');
INSERT INTO `permissions` VALUES ('37', 'user_layout', '用户退出', null, '18', 'web', '2018-03-14 14:58:49', '2018-03-14 14:58:49');
INSERT INTO `permissions` VALUES ('38', 'permission_index', '权限列表', null, '20', 'web', '2018-03-15 10:57:23', '2018-03-15 10:57:23');

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL COMMENT '所属分类id',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章标题',
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章标题别名',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否发布',
  `is_comment` tinyint(1) DEFAULT '0' COMMENT '推荐类型 允许评论',
  `is_top` tinyint(1) DEFAULT '0' COMMENT '推荐类型 置顶 ',
  `is_hot` tinyint(1) DEFAULT '0' COMMENT '推荐类型 热门 ',
  `is_tuijian` tinyint(1) DEFAULT '0' COMMENT '推荐类型 推荐',
  `is_slide` tinyint(1) DEFAULT '0' COMMENT '推荐类型 幻灯片',
  `thumb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '封面图片',
  `order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `views` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `push_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '发布时间',
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'URL链接',
  `source` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '本站' COMMENT '信息来源',
  `author` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '管理员' COMMENT '文章作者',
  `summary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '内容摘要',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT '内容描述',
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO标题',
  `seo_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO关健字',
  `seo_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_title_unique` (`title`),
  UNIQUE KEY `posts_alias_unique` (`alias`),
  KEY `posts_category_id_foreign` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', '12', '百度新闻——全球最大的中文新闻平台', 'baidu-news-the-worlds-largest-chinese-news-platform', '1', '1', '1', '1', '1', '1', 'uploads/images/picture/201803/24/site__1521880497_bvIM7OPz6A.jpg', '0', '238', '2018-06-07 14:04:00', 'asdasd', '本站', '管理员', '从开启全面屏时代的X20全面屏手机，到科技领先全球的X20Plus屏幕指纹版，再到全球科技媒体盛赞的APEX™全面屏概念机，这一次vivo又带来了全新的X21，除了全面屏和屏幕指纹外，拍照也是此次X21的发力点', '<blockquote><p>这里有做好的老师！</p></blockquote><p>从开启全面屏时代的X20全面屏手机，到科技领先全球的X20Plus屏幕指纹版，再到全球科技媒体盛赞的APEX™全面屏概念机，这一次vivo又带来了全新的X21，除了全面屏和屏幕指纹外，拍照也是此次X21的发力点。<br/></p><p>众所周知vivo手机在手机逆光拍摄上一直表现很好，从图像魔方技术到DSP独立影像处理芯片再到月初在vivo APEX媒体沟通会上公布的Super HDR技术，vivo X21在逆光表现上依旧出色。</p><p>上图这种大光比场景，普通手机想要想拍清背景的话，拍出来的效果基本就是简影了，人脸几乎是一片漆黑，可以看到vivo X21拍摄的样张不仅拍清了背景，模特的面部细节也非常棒。更多逆光样张</p><p>另一个说到相机不得不提的就是双摄虚化，vivo X21的后置虚化拍摄，经过几代的技术更迭，如今的虚化算法已经很不错了，在边缘处理和背景虚化上都在向单反靠近。<br/></p><p>vivo X21在自拍上也做了优化，以上这些自拍样张均出自vivo X21手机，这效果简直了。</p><p>夜景拍摄也非常给力，这照片拍的我感觉我对不起手里的单反了，哈哈哈哈</p><p>vivo X21的拍照变现确实有很大的提升，尤其是在逆光拍摄上。这样的vivo X21你喜欢吗？</p><pre class=\"brush:html;toolbar:false;\">&lt;div&nbsp;class=&quot;links&quot;&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&lt;a&nbsp;href=&quot;https://laravel.com/docs&quot;&gt;Documentation&lt;/a&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&lt;a&nbsp;href=&quot;https://laracasts.com&quot;&gt;Laracasts&lt;/a&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&lt;a&nbsp;href=&quot;https://laravel-news.com&quot;&gt;News&lt;/a&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&lt;a&nbsp;href=&quot;https://forge.laravel.com&quot;&gt;Forge&lt;/a&gt;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&lt;a&nbsp;href=&quot;https://github.com/laravel/laravel&quot;&gt;GitHub&lt;/a&gt;\r\n&lt;/div&gt;</pre><p><br/></p><p><br/></p>', 'asdas', 'asdasd', 'asdas', '2018-03-21 22:21:05', '2018-06-07 14:04:00');
INSERT INTO `posts` VALUES ('4', '13', 'vivo携天猫搞事情 X21屏幕指纹版送福利', 'vivo-with-tmall-to-do-things-x21-screen-print-benefits', '1', '0', '1', '0', '0', '0', 'uploads/images/picture/201803/27/site__1522155984_Iv3NBLCerC.jpg', '0', '213', '2018-06-07 14:04:02', null, '本站', '管理员', 'vivo 在乌镇正式带来了新一代vivo X21，采用6.28英寸19：9 Super AMOLED异性屏，搭载高通骁龙多核神经网络加速芯片 660 AIE，6+128GB内存，2400万前置镜头，2400万+500万双摄，光学防抖，3200mAh，AK4376A HiFi芯片，全新的FuntouchOS 4.0。 ​', '<p><span class=\"page_speed_1250777451\"><span class=\"page_speed_1479951559\">vivo 在乌镇正式带来了新一代</span></span><span class=\"page_speed_1716901833\"><span class=\"page_speed_1479951559\">vivo X21</span></span><span class=\"page_speed_1250777451\"><span class=\"page_speed_1479951559\">，采用6.28英寸19：9 Super AMOLED异性屏，搭载高通骁龙多核神经网络加速芯片 660 AIE，6+128GB内存，2400万前置镜头，2400万+500万双摄，光学防抖，3200mAh，AK4376A HiFi芯片，全新的FuntouchOS 4.0。 </span></span><br/></p>', null, null, null, '2018-03-27 21:06:29', '2018-06-07 14:04:02');
INSERT INTO `posts` VALUES ('5', '12', '【vivo X21评测】屏幕指纹版今日正式发售，解锁原理大揭秘', 'vivo-x21-the-screen-print-edition-is-officially-sold-today-and-the-principle-of-unlocking-is-uncovered', '1', '1', '0', '1', '1', '1', 'uploads/images/picture/201804/01/site__1522594034_Gqq8SV5gim.jpg', '0', '215', '2018-06-07 08:44:11', null, '本站', '管理员', '3月28日，全面屏旗舰手机vivo X21屏幕指纹版正式发售，这款手机之所以备受关注是因为采用屏幕指纹解锁技术，这项技术似乎独树一帜，已牢牢攥在vivo手中，成为一战定乾坤的大杀器', '<p>3月28日，全面屏旗舰手机vivo X21屏幕指纹版正式发售，这款手机之所以备受关注是因为采用屏幕指纹解锁技术，这项技术似乎独树一帜，已牢牢攥在vivo手中，成为一战定乾坤的大杀器</p>', null, null, null, '2018-04-01 22:47:49', '2018-06-07 08:44:11');
INSERT INTO `posts` VALUES ('6', '13', '王者必备，尽情开黑！vivo X20 Plus月体验小结', 'the-king-must-have-the-black-vivo-x20-plus-months-experience-summary', '1', '0', '0', '1', '1', '0', 'uploads/images/picture/201804/01/site__1522594238_Tuy5Vw4Ih8.jpg', '0', '664', '2018-06-07 08:44:12', null, '本站', '管理员', '既苹果9月份发布IPhoneX手机以来，全面屏开始被手机厂商玩坏了，各手机品牌相继涌现出自己的全面屏旗舰手机，vivoX20就是vivo推出的最新全面屏旗舰机，当然此次和大家分享的是X20的升级版——X20 Plus，X20及其Plus版主打拍照，逆光拍照也清晰！相比之下，X20 Plus屏幕更大，体验更爽！', '<p>既苹果9月份发布IPhoneX手机以来，全面屏开始被手机厂商玩坏了，各手机品牌相继涌现出自己的全面屏旗舰手机，vivoX20就是vivo推出的最新全面屏旗舰机，当然此次和大家分享的是X20的升级版——X20 Plus，X20及其Plus版主打拍照，逆光拍照也清晰！相比之下，X20 Plus屏幕更大，体验更爽！</p><pre class=\"brush:php;toolbar:false\">/**\r\n&nbsp;*&nbsp;保存资料\r\n&nbsp;*&nbsp;@param&nbsp;&nbsp;BlockRequest&nbsp;$request\r\n&nbsp;*&nbsp;@return&nbsp;\\Illuminate\\Http\\Response\r\n&nbsp;*/\r\npublic&nbsp;function&nbsp;store(BlockRequest&nbsp;$request)\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;$data&nbsp;=&nbsp;[\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;title&#39;&nbsp;=&gt;&nbsp;$request-&gt;get(&#39;title&#39;),\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;type&#39;&nbsp;=&gt;&nbsp;$request-&gt;get(&#39;type&#39;),\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#39;body&#39;&nbsp;=&gt;&nbsp;array_get($request-&gt;get(&#39;body&#39;),&nbsp;$request-&gt;get(&#39;type&#39;))\r\n&nbsp;&nbsp;&nbsp;&nbsp;];\r\n&nbsp;&nbsp;&nbsp;&nbsp;if&nbsp;(Block::create($data))&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;alert()-&gt;success(config(&#39;json-tip.block.create_success&#39;));\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;redirect()-&gt;route(&#39;block.index&#39;);\r\n&nbsp;&nbsp;&nbsp;&nbsp;}\r\n&nbsp;&nbsp;&nbsp;&nbsp;alert()-&gt;error(config(&#39;json-tip.block.create_error&#39;));\r\n&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;redirect()-&gt;back();\r\n}</pre><p><br/></p>', null, null, null, '2018-04-01 22:50:40', '2018-06-07 08:44:12');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色名称',
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色别名',
  `describe` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '角色描述',
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_alias_unique` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'admin', '超级管理员', null, 'web', '2018-03-24 17:18:41', '2018-03-24 17:18:41');
INSERT INTO `roles` VALUES ('3', 'editer', '编辑人员', null, 'web', '2018-04-15 14:38:15', '2018-04-15 14:38:15');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES ('28', '1');
INSERT INTO `role_has_permissions` VALUES ('29', '1');
INSERT INTO `role_has_permissions` VALUES ('30', '1');
INSERT INTO `role_has_permissions` VALUES ('31', '1');
INSERT INTO `role_has_permissions` VALUES ('32', '1');
INSERT INTO `role_has_permissions` VALUES ('33', '1');
INSERT INTO `role_has_permissions` VALUES ('34', '1');
INSERT INTO `role_has_permissions` VALUES ('35', '1');
INSERT INTO `role_has_permissions` VALUES ('36', '1');
INSERT INTO `role_has_permissions` VALUES ('37', '1');
INSERT INTO `role_has_permissions` VALUES ('38', '1');
INSERT INTO `role_has_permissions` VALUES ('27', '3');

-- ----------------------------
-- Table structure for systems
-- ----------------------------
DROP TABLE IF EXISTS `systems`;
CREATE TABLE `systems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `tips` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型',
  `value` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数值',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `systems_title_unique` (`title`),
  UNIQUE KEY `systems_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of systems
-- ----------------------------
INSERT INTO `systems` VALUES ('5', '网站标题', 'siteTitle', '阿南网', '0', null, 'input', '1', null, null);
INSERT INTO `systems` VALUES ('6', '网站描述', 'sitedes', '个地方给对方地方地方', '20', null, 'textarea', '1', null, null);
INSERT INTO `systems` VALUES ('7', '网站logo', 'siteLogoo', 'uploads/images/picture/201805/29/site__1527605552_6kcaV3sE9v.png', '0', null, 'image', '1', null, null);
INSERT INTO `systems` VALUES ('8', '网站状态', 'siteState', '1', '0', null, 'radio', '1', null, null);
INSERT INTO `systems` VALUES ('9', '网站关键字', 'siteKey', '个地方给对方地方地方', '0', null, 'textarea', '1', null, null);
INSERT INTO `systems` VALUES ('10', '网站版权', 'siteCopy', '© 2019阿南网', '0', null, 'input', '1', null, null);
INSERT INTO `systems` VALUES ('11', '网站备案', 'siteIcp', '滇ICP备15001580号-2', '0', null, 'input', '1', null, null);
INSERT INTO `systems` VALUES ('12', '个人别名', 'personAlais', '阿南网', '0', null, 'input', '1', null, null);
INSERT INTO `systems` VALUES ('13', '个人技能', 'personSkill', 'Web前端 & Ui设计', '0', null, 'input', '1', null, null);
INSERT INTO `systems` VALUES ('14', '个人地址', 'personAddress', 'Kunming, China', '0', null, 'input', '1', null, null);
INSERT INTO `systems` VALUES ('16', '人生格言', 'siteMotto', 'ANAN · 游弋在代码里的人生！', '0', null, 'input', '1', null, null);

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('18', 'javascript', '2018-03-31 23:04:51', '2018-04-01 12:03:01');
INSERT INTO `tags` VALUES ('19', 'laravel', '2018-03-31 23:05:00', '2018-03-31 23:05:00');
INSERT INTO `tags` VALUES ('20', 'spring boot', '2018-03-31 23:05:09', '2018-03-31 23:05:09');
INSERT INTO `tags` VALUES ('21', 'java', '2018-03-31 23:05:15', '2018-03-31 23:05:15');
INSERT INTO `tags` VALUES ('22', 'thinkphp', '2018-04-02 22:49:20', '2018-04-02 22:49:20');
INSERT INTO `tags` VALUES ('23', 'mysql', '2018-04-02 22:49:31', '2018-04-02 22:49:31');
INSERT INTO `tags` VALUES ('24', 'css3', '2018-04-02 23:43:46', '2018-04-02 23:43:46');
INSERT INTO `tags` VALUES ('25', 'html:5', '2018-04-02 23:43:57', '2018-04-02 23:43:57');

-- ----------------------------
-- Table structure for tag_posts
-- ----------------------------
DROP TABLE IF EXISTS `tag_posts`;
CREATE TABLE `tag_posts` (
  `post_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `tag_posts_tag_id_foreign` (`tag_id`),
  CONSTRAINT `tag_posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `tag_posts_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tag_posts
-- ----------------------------
INSERT INTO `tag_posts` VALUES ('1', '19', null, null);
INSERT INTO `tag_posts` VALUES ('1', '21', null, null);
INSERT INTO `tag_posts` VALUES ('1', '23', null, null);
INSERT INTO `tag_posts` VALUES ('5', '19', null, null);
INSERT INTO `tag_posts` VALUES ('6', '20', null, null);
INSERT INTO `tag_posts` VALUES ('6', '21', null, null);

-- ----------------------------
-- Table structure for themes
-- ----------------------------
DROP TABLE IF EXISTS `themes`;
CREATE TABLE `themes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '主题名称',
  `theme` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '主题模板',
  `username` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'hcweb' COMMENT '模板用户名',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT '启用状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of themes
-- ----------------------------
INSERT INTO `themes` VALUES ('3', '商城模板', 'shop', 'hcweb', '1', '2018-03-25 14:40:35', '2018-05-22 23:17:43');
INSERT INTO `themes` VALUES ('5', '博客主题', 'blog', 'admin', '0', '2018-03-25 16:07:48', '2018-05-22 23:17:41');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/backend/img/profile-photos/avatar.png' COMMENT '用户头像',
  `tel` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户手机号',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户邮箱',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户密码',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('2', 'hcweb', '/backend/img/profile-photos/avatar.png', '13577069756', '871328529@qq.com', '$2y$10$WBohRy5ti7ldWFDtAYrFIupCkEwynX48gkeLRwHoia8U3jhuhZFJy', '1', 'cNjfR7fIBYSwL70Ww5wq3RsgXWZixWrYxW7MDdOnNZWwfCRAqvEv7AwTIAUv', '2018-03-16 11:32:29', '2018-04-15 14:36:28');
INSERT INTO `users` VALUES ('4', '李锐VIP', 'uploads/images/avatars/20180316/1521180214_iPvHYEjiba.jpg', '13577069756', 'ilaravel@163.com', '$2y$10$AUXx1V3OAT7q8XHe0tqH6eVIcYE3RyKUW2AyKbmJtS3HZ2pZ3LWG6', '1', null, '2018-03-16 14:04:06', '2018-03-16 14:04:06');
INSERT INTO `users` VALUES ('5', 'xtn', 'uploads/images/avatars/20180316/1521208113_Nuev7pjsl9.png', '13577069756', 'ilaravel_vip@163.com', '$2y$10$6TUIStRWgtUbybmf6HAhxeoNIM7cvGyNZlkd8G6uFOVA4l6PAjmty', '1', null, '2018-03-16 21:49:16', '2018-03-16 21:49:16');
