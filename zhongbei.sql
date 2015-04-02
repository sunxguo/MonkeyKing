#
# TABLE STRUCTURE FOR: comment
#

DROP TABLE IF EXISTS comment;

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_content` text NOT NULL,
  `comment_time` datetime NOT NULL,
  `comment_to_type` tinyint(1) NOT NULL COMMENT '回复的类型1：主贴（forum）2：跟帖/回复（comment）',
  `comment_to_id` int(11) NOT NULL,
  `comment_user_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  UNIQUE KEY `comment_id_UNIQUE` (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='跟帖&回复';

INSERT INTO comment (`comment_id`, `comment_content`, `comment_time`, `comment_to_type`, `comment_to_id`, `comment_user_id`) VALUES (1, '回复主楼', '2015-04-01 20:55:04', 1, 1, 3);
INSERT INTO comment (`comment_id`, `comment_content`, `comment_time`, `comment_to_type`, `comment_to_id`, `comment_user_id`) VALUES (2, '回复主楼2', '2015-04-01 20:56:12', 1, 1, 3);
INSERT INTO comment (`comment_id`, `comment_content`, `comment_time`, `comment_to_type`, `comment_to_id`, `comment_user_id`) VALUES (3, '回复“回复主楼2”', '2015-04-01 21:14:02', 2, 2, 3);
INSERT INTO comment (`comment_id`, `comment_content`, `comment_time`, `comment_to_type`, `comment_to_id`, `comment_user_id`) VALUES (4, '回复22楼', '2015-04-01 21:58:34', 2, 2, 3);
INSERT INTO comment (`comment_id`, `comment_content`, `comment_time`, `comment_to_type`, `comment_to_id`, `comment_user_id`) VALUES (5, '', '2015-04-02 08:42:53', 2, 2, 3);
INSERT INTO comment (`comment_id`, `comment_content`, `comment_time`, `comment_to_type`, `comment_to_id`, `comment_user_id`) VALUES (6, '方法', '2015-04-02 08:43:12', 2, 1, 3);


#
# TABLE STRUCTURE FOR: essay
#

DROP TABLE IF EXISTS essay;

CREATE TABLE `essay` (
  `essay_id` int(11) NOT NULL AUTO_INCREMENT,
  `essay_title` varchar(255) DEFAULT NULL,
  `essay_summary` varchar(255) DEFAULT NULL,
  `essay_content` longtext,
  `essay_author_type` tinyint(4) DEFAULT NULL COMMENT '操作用户的类型0:admin1:merchant2:user',
  `essay_author_id` int(11) DEFAULT NULL,
  `essay_create_time` datetime NOT NULL,
  `essay_lastmodify_time` datetime NOT NULL,
  `essay_thumbnail` longtext,
  `essay_state` tinyint(4) DEFAULT NULL COMMENT '0:发布1:草稿2:删除',
  `essay_visits` bigint(20) NOT NULL DEFAULT '0' COMMENT '访问量',
  `essay_column` int(11) NOT NULL COMMENT '所属 栏目',
  PRIMARY KEY (`essay_id`),
  UNIQUE KEY `essay_id_UNIQUE` (`essay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='文章';

INSERT INTO essay (`essay_id`, `essay_title`, `essay_summary`, `essay_content`, `essay_author_type`, `essay_author_id`, `essay_create_time`, `essay_lastmodify_time`, `essay_thumbnail`, `essay_state`, `essay_visits`, `essay_column`) VALUES (2, '测试3', '摘要', '内容', 0, 1, '2015-03-09 21:22:19', '2015-03-30 13:16:16', '[{\"src\":\"\\/uploads\\/image\\/20150309\\/20150309212208_42233.jpg\"},{\"src\":\"\\/uploads\\/image\\/20150311\\/20150311114938_65684.jpg\"},{\"src\":\"\\/uploads\\/image\\/20150311\\/20150311115050_25078.jpg\"}]', 0, 0, 1);
INSERT INTO essay (`essay_id`, `essay_title`, `essay_summary`, `essay_content`, `essay_author_type`, `essay_author_id`, `essay_create_time`, `essay_lastmodify_time`, `essay_thumbnail`, `essay_state`, `essay_visits`, `essay_column`) VALUES (3, '相关链接', '', '<a href=\"http://www.nuc.edu.cn\" target=\"_blank\"><span style=\"font-family:\'Microsoft YaHei\';font-size:16px;color:#337FE5;\">中北大学</span></a>', 0, 1, '2015-03-30 22:06:35', '2015-03-30 22:06:35', '[]', 0, 0, 15);


#
# TABLE STRUCTURE FOR: forum
#

DROP TABLE IF EXISTS forum;

CREATE TABLE `forum` (
  `forum_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_title` varchar(255) NOT NULL,
  `forum_create_time` datetime NOT NULL,
  `forum_lastmodify_time` datetime NOT NULL,
  `forum_author_id` int(11) NOT NULL,
  `forum_mark` int(11) DEFAULT NULL COMMENT '帖子标记 1:置顶 2:精华 3:火',
  `forum_content` longtext,
  `forum_column` int(11) DEFAULT NULL,
  `forum_visits` int(11) DEFAULT NULL,
  PRIMARY KEY (`forum_id`),
  UNIQUE KEY `forum_id_UNIQUE` (`forum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='帖子';

INSERT INTO forum (`forum_id`, `forum_title`, `forum_create_time`, `forum_lastmodify_time`, `forum_author_id`, `forum_mark`, `forum_content`, `forum_column`, `forum_visits`) VALUES (2, '标题', '2015-04-01 17:31:08', '2015-04-01 17:31:08', 3, NULL, '内容太', 16, 0);


#
# TABLE STRUCTURE FOR: image
#

DROP TABLE IF EXISTS image;

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_title` varchar(255) DEFAULT NULL,
  `image_summary` varchar(255) DEFAULT NULL,
  `image_src` text,
  `image_author_type` tinyint(4) DEFAULT NULL COMMENT '操作用户的类型0:admin1:merchant2:user',
  `image_author_id` int(11) DEFAULT NULL,
  `image_create_time` datetime NOT NULL,
  `image_lastmodify_time` datetime NOT NULL,
  `image_thumbnail` longtext,
  `image_state` tinyint(4) DEFAULT NULL COMMENT '0:发布1:草稿2:删除',
  `image_visits` bigint(20) NOT NULL DEFAULT '0' COMMENT '访问量',
  `image_column` int(11) NOT NULL,
  PRIMARY KEY (`image_id`),
  UNIQUE KEY `image_id_UNIQUE` (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO image (`image_id`, `image_title`, `image_summary`, `image_src`, `image_author_type`, `image_author_id`, `image_create_time`, `image_lastmodify_time`, `image_thumbnail`, `image_state`, `image_visits`, `image_column`) VALUES (1, '测试', '', '/uploads/image/20150330/20150330143418_64286.jpg', 0, 1, '2015-03-30 14:00:05', '2015-03-30 14:36:01', NULL, 0, 0, 4);
INSERT INTO image (`image_id`, `image_title`, `image_summary`, `image_src`, `image_author_type`, `image_author_id`, `image_create_time`, `image_lastmodify_time`, `image_thumbnail`, `image_state`, `image_visits`, `image_column`) VALUES (3, '滚动1', '', '/uploads/image/20150330/20150330161804_12315.jpg', 0, 1, '2015-03-30 16:18:07', '2015-03-30 16:18:07', NULL, 0, 0, 14);
INSERT INTO image (`image_id`, `image_title`, `image_summary`, `image_src`, `image_author_type`, `image_author_id`, `image_create_time`, `image_lastmodify_time`, `image_thumbnail`, `image_state`, `image_visits`, `image_column`) VALUES (4, '滚动2', '', '/uploads/image/20150330/20150330161818_80109.jpg', 0, 1, '2015-03-30 16:18:20', '2015-03-30 16:18:20', NULL, 0, 0, 14);
INSERT INTO image (`image_id`, `image_title`, `image_summary`, `image_src`, `image_author_type`, `image_author_id`, `image_create_time`, `image_lastmodify_time`, `image_thumbnail`, `image_state`, `image_visits`, `image_column`) VALUES (5, '滚动3', '', '/uploads/image/20150330/20150330161831_27377.jpg', 0, 1, '2015-03-30 16:18:32', '2015-03-30 16:18:32', NULL, 0, 0, 14);


#
# TABLE STRUCTURE FOR: log
#

DROP TABLE IF EXISTS log;

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_operation` text COMMENT '操作内容',
  `log_time` datetime NOT NULL,
  `log_user_type` int(11) NOT NULL COMMENT '操作用户的类型0:admin1:merchant2:user',
  `log_user_id` int(11) NOT NULL COMMENT '操作用户id',
  PRIMARY KEY (`log_id`),
  UNIQUE KEY `idlog_UNIQUE` (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='操作日志';

#
# TABLE STRUCTURE FOR: merchant
#

DROP TABLE IF EXISTS merchant;

CREATE TABLE `merchant` (
  `merchant_id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_username` varchar(45) NOT NULL,
  `merchant_pwd` varchar(45) NOT NULL,
  `merchant_grade` int(11) NOT NULL DEFAULT '1' COMMENT '用户等级 从1 开始',
  `merchant_email` varchar(45) DEFAULT NULL,
  `merchant_phone` varchar(45) DEFAULT NULL,
  `merchant_avatar` varchar(255) DEFAULT NULL,
  `merchant_gender` tinyint(4) NOT NULL COMMENT '0:male 1:female 2:unknown',
  `merchant_birthday` date DEFAULT NULL,
  `merchant_vip_grade` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'vip等级 0为不是vip',
  `merchant_state` tinyint(4) DEFAULT NULL COMMENT '0:正常1:冻结2:删除',
  `merchant_lastlogin_time` datetime DEFAULT NULL,
  `merchant_reg_time` datetime DEFAULT NULL,
  `merchant_corporation` varchar(127) DEFAULT NULL,
  `merchant_qq` varchar(45) DEFAULT NULL,
  `merchant_alipay` varchar(45) DEFAULT NULL,
  `merchant_paypal` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`merchant_id`),
  UNIQUE KEY `merchant_id_UNIQUE` (`merchant_id`),
  UNIQUE KEY `merchant_username_UNIQUE` (`merchant_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: mkadmin
#

DROP TABLE IF EXISTS mkadmin;

CREATE TABLE `mkadmin` (
  `mkadmin_id` int(11) NOT NULL AUTO_INCREMENT,
  `mkadmin_username` varchar(45) NOT NULL,
  `mkadmin_pwd` varchar(45) NOT NULL,
  `mkadmin_email` varchar(45) DEFAULT NULL,
  `mkadmin_phone` varchar(45) DEFAULT NULL,
  `mkadmin_lastlogintime` datetime NOT NULL,
  PRIMARY KEY (`mkadmin_id`),
  UNIQUE KEY `id_mkadmin_UNIQUE` (`mkadmin_id`),
  UNIQUE KEY `username_mkadmin_UNIQUE` (`mkadmin_username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员信息';

INSERT INTO mkadmin (`mkadmin_id`, `mkadmin_username`, `mkadmin_pwd`, `mkadmin_email`, `mkadmin_phone`, `mkadmin_lastlogintime`) VALUES (1, 'MonkeyKing', '00dba02a8949ee582b3b40cbab1ee568', 'sunxguo@163.com', '18734920576', '2015-03-03 17:09:20');


#
# TABLE STRUCTURE FOR: permission
#

DROP TABLE IF EXISTS permission;

CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(45) NOT NULL,
  PRIMARY KEY (`permission_id`),
  UNIQUE KEY `id_permissionadmin_UNIQUE` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员的权限列表';

#
# TABLE STRUCTURE FOR: permission_data
#

DROP TABLE IF EXISTS permission_data;

CREATE TABLE `permission_data` (
  `permission_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_data_admin_id` int(11) NOT NULL,
  `permission_data_per_id` int(11) NOT NULL,
  PRIMARY KEY (`permission_data_id`),
  UNIQUE KEY `PermissionData_ID_UNIQUE` (`permission_data_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员权限数据';

#
# TABLE STRUCTURE FOR: position
#

DROP TABLE IF EXISTS position;

CREATE TABLE `position` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_type` int(11) NOT NULL COMMENT '1:顶部菜单栏2:顶部滚动图3:侧边栏',
  `position_column` int(11) NOT NULL,
  `position_ordernum` int(11) DEFAULT '0',
  PRIMARY KEY (`position_id`),
  UNIQUE KEY `position_id_UNIQUE` (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

INSERT INTO position (`position_id`, `position_type`, `position_column`, `position_ordernum`) VALUES (9, 1, 3, 1);
INSERT INTO position (`position_id`, `position_type`, `position_column`, `position_ordernum`) VALUES (10, 3, 3, 1);
INSERT INTO position (`position_id`, `position_type`, `position_column`, `position_ordernum`) VALUES (11, 1, 2, 2);
INSERT INTO position (`position_id`, `position_type`, `position_column`, `position_ordernum`) VALUES (12, 3, 1, 2);
INSERT INTO position (`position_id`, `position_type`, `position_column`, `position_ordernum`) VALUES (13, 2, 14, 1);
INSERT INTO position (`position_id`, `position_type`, `position_column`, `position_ordernum`) VALUES (14, 4, 1, 1);
INSERT INTO position (`position_id`, `position_type`, `position_column`, `position_ordernum`) VALUES (16, 4, 2, 2);
INSERT INTO position (`position_id`, `position_type`, `position_column`, `position_ordernum`) VALUES (17, 4, 3, 3);
INSERT INTO position (`position_id`, `position_type`, `position_column`, `position_ordernum`) VALUES (19, 1, 16, 3);


#
# TABLE STRUCTURE FOR: user
#

DROP TABLE IF EXISTS user;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(45) NOT NULL,
  `user_pwd` varchar(45) NOT NULL,
  `user_email` varchar(45) DEFAULT NULL,
  `user_phone` varchar(45) DEFAULT NULL,
  `user_avatar` varchar(255) DEFAULT NULL,
  `user_gender` tinyint(4) NOT NULL COMMENT '0:male 1:female 2:unknown',
  `user_state` tinyint(4) NOT NULL COMMENT '0:正常1:冻结',
  `user_lastlogin_time` datetime DEFAULT NULL,
  `user_reg_time` datetime DEFAULT NULL,
  `user_birthday` date DEFAULT NULL,
  `user_grade` tinyint(4) NOT NULL DEFAULT '1' COMMENT '用户等级 从1 开始',
  `user_vip_grade` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'vip等级 0为不是vip',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户';

INSERT INTO user (`user_id`, `user_username`, `user_pwd`, `user_email`, `user_phone`, `user_avatar`, `user_gender`, `user_state`, `user_lastlogin_time`, `user_reg_time`, `user_birthday`, `user_grade`, `user_vip_grade`) VALUES (3, 'sunxguo', '4153a2e75da748519f0953a2d6a16c34', NULL, NULL, NULL, 0, 0, '2015-04-01 16:40:54', '2015-04-01 16:40:54', NULL, 1, 0);


#
# TABLE STRUCTURE FOR: websiteconfig
#

DROP TABLE IF EXISTS websiteconfig;

CREATE TABLE `websiteconfig` (
  `id_websiteconfig` int(11) NOT NULL AUTO_INCREMENT,
  `key_websiteconfig` varchar(45) NOT NULL,
  `value_websiteconfig` longtext,
  PRIMARY KEY (`id_websiteconfig`),
  UNIQUE KEY `id_websiteconfig_UNIQUE` (`id_websiteconfig`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='网站配置';

INSERT INTO websiteconfig (`id_websiteconfig`, `key_websiteconfig`, `value_websiteconfig`) VALUES (1, 'website_name', '网站名称');
INSERT INTO websiteconfig (`id_websiteconfig`, `key_websiteconfig`, `value_websiteconfig`) VALUES (2, 'last_backup_time', '2015-04-02 11:12:33');


