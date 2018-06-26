/*
Navicat MySQL Data Transfer

Source Server         : hcweb
Source Server Version : 100126
Source Host           : localhost:3306
Source Database       : n_fruit

Target Server Type    : MYSQL
Target Server Version : 100126
File Encoding         : 65001

Date: 2018-03-18 22:51:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blocks
-- ----------------------------
DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '自定义资料标题',
  `type` char(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'F文字|I图片|E编辑',
  `body` text COLLATE utf8_unicode_ci COMMENT '内容',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of blocks
-- ----------------------------
INSERT INTO `blocks` VALUES ('1', 'qq邮箱', 'F', '871328529@qq.com', null, null);
INSERT INTO `blocks` VALUES ('4', 'dwerwrew', 'I', null, null, null);
INSERT INTO `blocks` VALUES ('5', '的发个梵蒂冈梵蒂冈', 'E', '<p>电饭锅地方给对方给对方给对方发的地方电饭锅地方</p><p><img src=\"//fruit.hcweb.cc/storage/uploads/image/2018/03/18/6e847d68feadc0ac31e71202ac541a6e.png\" class=\"page_speed_644016520\" title=\"/uploads/image/2018/03/18/6e847d68feadc0ac31e71202ac541a6e.png\"/></p><p><img src=\"//fruit.hcweb.cc/storage/uploads/image/2018/03/18/4b0135d9c46c0b9f87e589ad2ebc98c5.png\" class=\"page_speed_644016520\" title=\"/uploads/image/2018/03/18/4b0135d9c46c0b9f87e589ad2ebc98c5.png\"/><img src=\"//img.baidu.com/hi/jx2/j_0003.gif\"/></p><p><img src=\"//fruit.hcweb.cc/storage/uploads/image/2018/03/18/d0cd1009f18d0485eb7a83ad48acca62.jpg\" class=\"page_speed_644016520\" title=\"/uploads/image/2018/03/18/d0cd1009f18d0485eb7a83ad48acca62.jpg\"/></p><p><img src=\"http://img.baidu.com/hi/jx2/j_0026.gif\"/></p>', null, null);
INSERT INTO `blocks` VALUES ('6', '时发生地方士大夫似的发的是发的是发生的', 'I', 'uploads/images/picture/201803/18/site__1521382050_smeJB16LxQ.jpg', null, null);

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of comments
-- ----------------------------

-- ----------------------------
-- Table structure for links
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of links
-- ----------------------------

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of members
-- ----------------------------

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '菜单标题',
  `route` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '菜单路由名称',
  `target` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '_self' COMMENT '菜单打开方式',
  `icon_class` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '菜单图标',
  `color` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '菜单颜色',
  `height_url` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '菜单高亮',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父类id',
  `order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '菜单排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of messages
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES ('2', '5', 'App\\Models\\User');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '权限名称',
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '权限别名',
  `describe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '权限描述',
  `menu_id` int(10) unsigned NOT NULL COMMENT '栏目名称,预留字段',
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`),
  UNIQUE KEY `permissions_alias_unique` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '角色名称',
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '角色别名',
  `describe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '角色描述',
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_alias_unique` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('2', 'admin', '超级管理员', '拥有网站的最高管理权限', 'web', '2018-03-16 21:41:43', '2018-03-16 21:41:43');
INSERT INTO `roles` VALUES ('3', 'edit', '网站编辑人员', null, 'web', '2018-03-16 21:42:44', '2018-03-16 21:42:44');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES ('21', '2');
INSERT INTO `role_has_permissions` VALUES ('21', '3');
INSERT INTO `role_has_permissions` VALUES ('22', '2');
INSERT INTO `role_has_permissions` VALUES ('23', '2');
INSERT INTO `role_has_permissions` VALUES ('24', '2');
INSERT INTO `role_has_permissions` VALUES ('25', '2');
INSERT INTO `role_has_permissions` VALUES ('26', '2');
INSERT INTO `role_has_permissions` VALUES ('27', '2');
INSERT INTO `role_has_permissions` VALUES ('27', '3');
INSERT INTO `role_has_permissions` VALUES ('28', '2');
INSERT INTO `role_has_permissions` VALUES ('29', '2');
INSERT INTO `role_has_permissions` VALUES ('30', '2');
INSERT INTO `role_has_permissions` VALUES ('31', '2');
INSERT INTO `role_has_permissions` VALUES ('33', '2');
INSERT INTO `role_has_permissions` VALUES ('33', '3');
INSERT INTO `role_has_permissions` VALUES ('34', '2');
INSERT INTO `role_has_permissions` VALUES ('35', '2');
INSERT INTO `role_has_permissions` VALUES ('36', '2');
INSERT INTO `role_has_permissions` VALUES ('37', '2');
INSERT INTO `role_has_permissions` VALUES ('38', '2');

-- ----------------------------
-- Table structure for systems
-- ----------------------------
DROP TABLE IF EXISTS `systems`;
CREATE TABLE `systems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '名称',
  `content` text COLLATE utf8_unicode_ci COMMENT '内容',
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `tips` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '类型',
  `value` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数值',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `systems_title_unique` (`title`),
  UNIQUE KEY `systems_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of systems
-- ----------------------------
INSERT INTO `systems` VALUES ('5', '网站标题', 'siteTitle', '馋猫优鲜', '0', null, 'input', '1', null, null);
INSERT INTO `systems` VALUES ('6', '网站描述', 'sitedes', '个地方给对方地方地方', '20', null, 'textarea', '1', null, null);
INSERT INTO `systems` VALUES ('7', '网站logo', 'siteLogoo', 'uploads/images/logo/201803/17/site__1521295401_jAAsaeFpA3.png', '0', null, 'image', '1', null, null);
INSERT INTO `systems` VALUES ('8', '网站状态', 'siteState', '1', '0', null, 'radio', '1', null, null);
INSERT INTO `systems` VALUES ('9', '网站关键字', 'siteKey', '个地方给对方地方地方', '0', null, 'textarea', '1', null, null);
INSERT INTO `systems` VALUES ('10', '网站版权', 'siteCopy', '© 2019恒创网络', '0', null, 'input', '1', null, null);
INSERT INTO `systems` VALUES ('11', '网站备案', 'siteIcp', '蜀ICP备12028237号', '0', null, 'input', '1', null, null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `avatar` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '/backend/img/profile-photos/avatar.png' COMMENT '用户头像',
  `tel` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户手机号',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户邮箱',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户密码',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('2', 'hcweb', '/backend/img/profile-photos/avatar.png', null, '871328529@qq.com', '$2y$10$WBohRy5ti7ldWFDtAYrFIupCkEwynX48gkeLRwHoia8U3jhuhZFJy', '1', 'w5A7OQDZYSnpVGrVv6QUys6LD5GSEqAFcbgqyWOBcRzJIWigQrTH3oByQwa3', '2018-03-16 11:32:29', '2018-03-16 11:32:29');
INSERT INTO `users` VALUES ('4', '李锐VIP', 'uploads/images/avatars/20180316/1521180214_iPvHYEjiba.jpg', '13577069756', 'ilaravel@163.com', '$2y$10$AUXx1V3OAT7q8XHe0tqH6eVIcYE3RyKUW2AyKbmJtS3HZ2pZ3LWG6', '1', null, '2018-03-16 14:04:06', '2018-03-16 14:04:06');
INSERT INTO `users` VALUES ('5', 'xtn', 'uploads/images/avatars/20180316/1521208113_Nuev7pjsl9.png', '13577069756', 'ilaravel_vip@163.com', '$2y$10$6TUIStRWgtUbybmf6HAhxeoNIM7cvGyNZlkd8G6uFOVA4l6PAjmty', '1', null, '2018-03-16 21:49:16', '2018-03-16 21:49:16');
