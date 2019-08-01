#
# TABLE STRUCTURE FOR: blogs
#

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `blogs` (`id`, `author_id`, `title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created`, `updated`, `deleted`) VALUES (1, 0, 'Hello World', 'Hang the', 'Yar Meta Description', 'pages/page1.jpg', 'hello-world', 'Yar Meta Description', 'Keyword1, Keyword2', '1', '2018-10-04 09:55:24', '2019-01-23 16:01:42', 1);
INSERT INTO `blogs` (`id`, `author_id`, `title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created`, `updated`, `deleted`) VALUES (4, 0, 'My Page', 'Excepteura', '                                                                                                            <div style=\"text-align: center;\"><span style=\"font-size: 0.9375rem;\">#php echo \'php echo test\' php#</span></div><div class=\"container-fluid text-center bg-grey\">\r\n  <h2>Portfolio223</h2><br>\r\n  <h4>What we have created</h4>\r\n  <div class=\"row text-center\">\r\n    <div class=\"col-sm-4\">\r\n      <div class=\"thumbnail\">\r\n        \r\n        <p><img src=\"https://cdn.pixabay.com/photo/2018/11/29/21/19/hamburg-3846525_960_720.jpg\" style=\"width: 100%;\"><strong><br></strong></p><p><strong>Paris</strong></p>\r\n        <p>Yes, we built Paris</p>\r\n      </div>\r\n    </div>\r\n    <div class=\"col-sm-4\">\r\n      <div class=\"thumbnail\">\r\n        \r\n        <p><img style=\"width: 100%;\" src=\"https://image.shutterstock.com/image-photo/unesco-world-cultural-heritage-speicherstadt-450w-1242947317.jpg\"><strong><br></strong></p><p><strong>New York</strong></p>\r\n        <p>We built New York</p>\r\n      </div>\r\n    </div>\r\n    <div class=\"col-sm-4\">\r\n      <div class=\"thumbnail\">\r\n        \r\n        <p><img style=\"width:100%;\" src=\"https://cdn.pixabay.com/photo/2013/05/28/20/30/city-114290_960_720.jpg\"><strong><br></strong></p><p><strong>San Francisco</strong></p>\r\n        <p>Yes, San Fran is ours</p>\r\n      </div>\r\n    </div>\r\n  </div>\r\n</div>                                                                                                                                                                                                                                                                                                                                  ', 'uploads/blog/Mar_2019/1551885667.jpg', 'my-page', 'Eos12', 'Cupidatat', '1', '2019-01-22 04:50:39', '2019-01-22 04:50:39', 0);
INSERT INTO `blogs` (`id`, `author_id`, `title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created`, `updated`, `deleted`) VALUES (5, 0, 'nTestasd', 'nTest', '                                                                                                                                                <p>                                nTestnTestnTestnTest</p>                                                                                                                ', 'uploads/blog/Mar_2019/1551884275.jpg', 'nTest', 'nTest', 'nTest', '1', '2019-02-07 09:57:57', '2019-02-07 09:57:57', 0);


#
# TABLE STRUCTURE FOR: captcha
#

DROP TABLE IF EXISTS `captcha`;

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8;

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('126', 1537646878, '::1', 'AePcf');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('127', 1537646974, '::1', 'Ydu9B');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('128', 1537646989, '::1', 'Hf6g2');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('129', 1537647091, '::1', 'cBXDx');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('130', 1537647185, '::1', 'mYvZD');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('131', 1537647200, '::1', 'CB7PP');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('132', 1537647227, '::1', 'RDYzq');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('133', 1537647379, '::1', 'k3aMW');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('134', 1537647414, '::1', '5hrZn');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('135', 1537647531, '::1', 'BGPWV');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('136', 1537647636, '::1', 'B2DNE');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('137', 1537647687, '::1', 'zqvmr');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('138', 1537647704, '::1', 'c3YTf');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('139', 1537648822, '::1', '45YpQ');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('140', 1537648858, '::1', 'hMBZp');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('141', 1537648878, '::1', 'JXt4Q');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('142', 1537648885, '::1', 'f2n4h');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('143', 1537648911, '::1', 'Q7a9C');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('144', 1537648927, '::1', 'mqda9');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('145', 1537648955, '::1', 'Lu2tz');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('146', 1537649338, '::1', '9Psp4');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('147', 1537649792, '::1', 'HnG42');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('148', 1537649901, '::1', 'Lqynf');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('149', 1537649932, '::1', 'w5swK');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('150', 1537649948, '::1', 'Gd658');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('151', 1537650294, '::1', 'DTDqx');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('152', 1537650335, '::1', 'SpPYL');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('153', 1537650394, '::1', '9h8Sa');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('154', 1537650463, '::1', 'kdUSs');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('155', 1537650577, '::1', 'sGRCS');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('156', 1537650590, '::1', '56US7');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('157', 1537650620, '::1', 'h4Xub');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('158', 1537650628, '::1', 'pyr3q');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('159', 1537650659, '::1', 'HG2VV');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('160', 1537650729, '::1', '3FQud');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('161', 1537650740, '::1', 'XXYku');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('162', 1537650746, '::1', 'swEhW');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('163', 1537650759, '::1', 'Twmgu');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('164', 1537650780, '::1', 'd34ER');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('165', 1537650788, '::1', '9SbHH');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('166', 1537650802, '::1', 'n9QSn');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('167', 1537650808, '::1', 'V3nmm');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('168', 1537650867, '::1', 'bkRLC');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('169', 1537650901, '::1', 'zJCBc');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('170', 1537650931, '::1', 'bxdcx');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('171', 1537650935, '::1', 'BwSUF');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('172', 1537650937, '::1', 'ASKGr');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('173', 1537650947, '::1', '3M9Pq');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('174', 1537650990, '::1', 'EajzK');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('175', 1537650996, '::1', '6teC7');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('176', 1537651121, '::1', 'yCXCN');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('177', 1537651127, '::1', '2vJyA');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('178', 1537651207, '::1', 'H3QPg');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('179', 1537651218, '::1', 'TQy9T');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('180', 1537651533, '::1', 'aYrGg');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('181', 1537651600, '::1', 'zdcuW');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('182', 1537651616, '::1', 'uMPXa');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('183', 1537651629, '::1', 'XLTb7');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('184', 1537651716, '::1', 'Q7uNg');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('185', 1537651753, '::1', 'Qq5nZ');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('186', 1537651770, '::1', 'M3Ppz');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('187', 1537651788, '::1', 'enDek');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('188', 1537651797, '::1', 'MTftc');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('189', 1537651828, '::1', 'HwCuW');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('190', 1537651852, '::1', 'WHGkw');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('191', 1537651931, '::1', 'jX72k');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('192', 1537651946, '::1', 'M4egj');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('193', 1537651979, '::1', 'rGf8F');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('194', 1537651985, '::1', 'HKy3u');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('195', 1537652044, '::1', 'csJH8');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('196', 1537652071, '::1', 'LVvQh');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('197', 1537652076, '::1', 'D47mn');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('198', 1537652103, '::1', 'a22c4');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('199', 1537652117, '::1', 'UPNsq');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('200', 1537652130, '::1', 'TY2Lf');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('201', 1537652642, '::1', 'CUqA6');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('202', 1537652984, '::1', 'vf3F2');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('203', 1537653047, '::1', 'xwwLm');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('204', 1537653246, '::1', '9LJvs');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('205', 1537653270, '::1', '3fa8A');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('206', 1537653283, '::1', 'zAQPF');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('207', 1537653367, '::1', '8Rcte');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('208', 1537653410, '::1', '8KTeg');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('209', 1537653422, '::1', 'pjZ2W');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('210', 1537653433, '::1', 'MqsdZ');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('211', 1537653477, '::1', 'y3ZKV');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('212', 1537653926, '::1', 'Dja4k');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('213', 1537653949, '::1', 'jTbrK');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('214', 1537653960, '::1', 'LYLyX');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('215', 1537653988, '::1', 'SpvBk');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('216', 1537654015, '::1', 'yRLzE');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('217', 1537654033, '::1', 'yBSn3');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('218', 1537654179, '::1', 'p28Yp');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('219', 1537654207, '::1', 'LfDpm');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('220', 1537654226, '::1', 'wuAVD');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('221', 1537654284, '::1', 'XLD72');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('222', 1537654296, '::1', 'gxWCX');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('223', 1537654314, '::1', 'AqYEk');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('224', 1537654956, '::1', 'sGGp6');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('225', 1537654971, '::1', 'dsBZd');
INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('226', 1537655388, '::1', 'rjmVW');


#
# TABLE STRUCTURE FOR: category
#

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf16_unicode_ci NOT NULL,
  `slug` varchar(500) COLLATE utf16_unicode_ci NOT NULL,
  `parent_category` int(11) NOT NULL DEFAULT '-1',
  `price` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `flag` int(11) DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  `sort_order` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

INSERT INTO `category` (`id`, `name`, `slug`, `parent_category`, `price`, `created`, `deleted`, `updated`, `flag`, `file_path`, `file_name`, `sort_order`) VALUES (1, 'Digital Marketing', 'digital-marketing-1', 7, 200, '2019-06-14 18:42:41', 0, '2019-06-14 02:42:41', NULL, 'uploads/category/May_2019/1557814502_14.png', '1557814502_14.png', 0);
INSERT INTO `category` (`id`, `name`, `slug`, `parent_category`, `price`, `created`, `deleted`, `updated`, `flag`, `file_path`, `file_name`, `sort_order`) VALUES (2, 'Writing & Translation', 'writing-translation-1', -1, 20, '2019-06-14 19:35:53', 0, '2019-06-14 03:35:53', NULL, 'uploads/category/May_2019/1557814525_14.png', '1557814525_14.png', 0);
INSERT INTO `category` (`id`, `name`, `slug`, `parent_category`, `price`, `created`, `deleted`, `updated`, `flag`, `file_path`, `file_name`, `sort_order`) VALUES (3, 'Programming & Tech', 'programming-tech-1', 11, 20, '2019-06-14 19:25:02', 0, '2019-06-14 03:25:02', NULL, 'uploads/category/May_2019/1557814547_14.png', '1557814547_14.png', 0);
INSERT INTO `category` (`id`, `name`, `slug`, `parent_category`, `price`, `created`, `deleted`, `updated`, `flag`, `file_path`, `file_name`, `sort_order`) VALUES (4, 'Business', 'business', -1, 100, '2019-06-17 16:34:49', 0, '2019-06-17 12:34:49', NULL, 'uploads/category/May_2019/1557814682_14.png', '1557814682_14.png', 0);
INSERT INTO `category` (`id`, `name`, `slug`, `parent_category`, `price`, `created`, `deleted`, `updated`, `flag`, `file_path`, `file_name`, `sort_order`) VALUES (6, 'Grapics', 'grapics-1', -1, 20, '2019-06-14 19:25:50', 1, '2019-06-14 15:25:50', NULL, 'uploads/category/Jun_2019/1560509748_14.jpg', '1560509748_14.jpg', 0);
INSERT INTO `category` (`id`, `name`, `slug`, `parent_category`, `price`, `created`, `deleted`, `updated`, `flag`, `file_path`, `file_name`, `sort_order`) VALUES (7, 'Social Media Marketing', 'social-media-marketing-1', -1, 100, '2019-06-17 16:36:56', 0, '2019-06-17 12:36:56', NULL, 'uploads/category/Jun_2019/1560515946_14.jpg', '1560515946_14.jpg', 0);
INSERT INTO `category` (`id`, `name`, `slug`, `parent_category`, `price`, `created`, `deleted`, `updated`, `flag`, `file_path`, `file_name`, `sort_order`) VALUES (8, 'Staff Support', 'staff-support-1', 9, 100, '2019-06-14 19:31:05', 1, '2019-06-14 15:31:05', NULL, 'uploads/category/Jun_2019/1560516364_14.jpg', '1560516364_14.jpg', 0);
INSERT INTO `category` (`id`, `name`, `slug`, `parent_category`, `price`, `created`, `deleted`, `updated`, `flag`, `file_path`, `file_name`, `sort_order`) VALUES (9, 'Support', 'support-1', -1, 200, '2019-06-14 19:03:00', 0, '2019-06-14 03:03:00', NULL, 'uploads/category/Jun_2019/1560516409_14.jpg', '1560516409_14.jpg', 0);
INSERT INTO `category` (`id`, `name`, `slug`, `parent_category`, `price`, `created`, `deleted`, `updated`, `flag`, `file_path`, `file_name`, `sort_order`) VALUES (10, 'Supoort', 'supoort-1', -1, 200, '2019-06-14 19:01:57', 1, '2019-06-14 15:01:57', NULL, 'uploads/category/Jun_2019/1560516409_14.jpg', '1560516409_14.jpg', 0);
INSERT INTO `category` (`id`, `name`, `slug`, `parent_category`, `price`, `created`, `deleted`, `updated`, `flag`, `file_path`, `file_name`, `sort_order`) VALUES (11, 'Web Development', 'web-development', -1, 500, '2019-06-17 16:34:57', 0, '2019-06-17 12:34:57', NULL, 'uploads/category/Jun_2019/1560518664_14.png', '1560518664_14.png', 1);
INSERT INTO `category` (`id`, `name`, `slug`, `parent_category`, `price`, `created`, `deleted`, `updated`, `flag`, `file_path`, `file_name`, `sort_order`) VALUES (12, 'Music & Audio', 'music-audio-1', -1, 500, '2019-06-17 16:35:16', 0, '2019-06-17 12:35:16', NULL, 'uploads/category/Jun_2019/1560519146_14.jpg', '1560519146_14.jpg', 5);
INSERT INTO `category` (`id`, `name`, `slug`, `parent_category`, `price`, `created`, `deleted`, `updated`, `flag`, `file_path`, `file_name`, `sort_order`) VALUES (13, 'Art & Design', 'art-design-1', -1, 200, '2019-06-14 19:51:37', 0, '2019-06-14 03:51:37', NULL, 'uploads/category/Jun_2019/1560519260_14.jpg', '1560519260_14.jpg', 10);
INSERT INTO `category` (`id`, `name`, `slug`, `parent_category`, `price`, `created`, `deleted`, `updated`, `flag`, `file_path`, `file_name`, `sort_order`) VALUES (14, 'Logo Design', 'logo-design', 13, 561, '2019-06-14 19:51:29', 0, '2019-06-14 03:51:29', NULL, 'uploads/category/Jun_2019/1560520147_14.jpg', '1560520147_14.jpg', 10);
INSERT INTO `category` (`id`, `name`, `slug`, `parent_category`, `price`, `created`, `deleted`, `updated`, `flag`, `file_path`, `file_name`, `sort_order`) VALUES (15, 'Deacon Hardin 100', 'deacon-hardin-100', 0, 11, '2019-06-17 16:19:32', 1, '2019-06-17 12:19:32', NULL, 'uploads/category/Jun_2019/1560766759_17.jpg', '1560766759_17.jpg', 10);


#
# TABLE STRUCTURE FOR: ci_sessions
#

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  `tbl_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`tbl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=287 DEFAULT CHARSET=latin1;

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('o5lk9ncdcbhsj4qmem87c5l2ff7h4q5p', '::1', 1551714913, '__ci_last_regenerate|i:1551714913;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";logged_in|a:10:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:10:\"first_name\";s:4:\"Site\";s:9:\"last_name\";s:13:\"Administrator\";s:5:\"email\";s:15:\"admin@admin.com\";s:8:\"language\";s:7:\"english\";s:8:\"is_admin\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2013-01-01 00:00:00\";s:7:\"updated\";s:19:\"2018-09-22 22:28:14\";}referrer|s:85:\"http://localhost/voyager_junior/admin/portfolio?sort=status&dir=asc&limit=20&offset=0\";', 190);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('736l7mjhhmgbone8kl41uj7mvhset3b4', '::1', 1551788588, '__ci_last_regenerate|i:1551788527;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";logged_in|a:10:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:10:\"first_name\";s:4:\"Site\";s:9:\"last_name\";s:13:\"Administrator\";s:5:\"email\";s:15:\"admin@admin.com\";s:8:\"language\";s:7:\"english\";s:8:\"is_admin\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2013-01-01 00:00:00\";s:7:\"updated\";s:19:\"2018-09-22 22:28:14\";}', 192);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('ndenhhqfenr8k7jtilm092es04jngah5', '::1', 1551798446, '__ci_last_regenerate|i:1551798241;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";logged_in|a:10:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:10:\"first_name\";s:4:\"Site\";s:9:\"last_name\";s:13:\"Administrator\";s:5:\"email\";s:15:\"admin@admin.com\";s:8:\"language\";s:7:\"english\";s:8:\"is_admin\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2013-01-01 00:00:00\";s:7:\"updated\";s:19:\"2018-09-22 22:28:14\";}referrer|s:80:\"http://localhost/voyager_junior/admin/Pages?sort=title&dir=asc&limit=20&offset=0\";', 194);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('ajqte0qfqk28a4b08g5kuor0mvka2429', '::1', 1551864260, '__ci_last_regenerate|i:1551864260;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";', 195);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('rb6d2chbat20heam0pmlrdcjflv405sr', '::1', 1551887077, '__ci_last_regenerate|i:1551887013;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";logged_in|a:10:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:10:\"first_name\";s:4:\"Site\";s:9:\"last_name\";s:13:\"Administrator\";s:5:\"email\";s:15:\"admin@admin.com\";s:8:\"language\";s:7:\"english\";s:8:\"is_admin\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2013-01-01 00:00:00\";s:7:\"updated\";s:19:\"2018-09-22 22:28:14\";}referrer|s:79:\"http://localhost/voyager_junior/admin/blog?sort=title&dir=asc&limit=20&offset=0\";', 242);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('rb9tfgglsjr5iu4udi8i9gub5tpea2q1', '::1', 1562329779, '__ci_last_regenerate|i:1562329776;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";redirect|s:41:\"http://localhost/ci/project_manager/admin\";', 243);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('1vri4gbrecaskf1suensedc43m2ae6k8', '::1', 1562330097, '__ci_last_regenerate|i:1562330097;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";', 244);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('el3ig5viat52vi3242uqovr42bd23hbf', '::1', 1562330105, '__ci_last_regenerate|i:1562330105;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";', 245);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('puc95326t7hf1hjf3ojg636dpfcuuev2', '::1', 1562330130, '__ci_last_regenerate|i:1562330130;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";', 246);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('qalldlu69ajpi58pes99rl8b1krjdj5f', '::1', 1562330165, '__ci_last_regenerate|i:1562330165;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";', 247);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('5ijkkur803dc4m5fm4269valnsmpgdhi', '::1', 1562330229, '__ci_last_regenerate|i:1562330228;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";', 248);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('t37rthl1dtrgrg6hpgorevbmhh17h08k', '::1', 1562330234, '__ci_last_regenerate|i:1562330231;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";', 249);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('b3mlucsegbtme1fhp5kop55romcbug1m', '::1', 1562330238, '__ci_last_regenerate|i:1562330238;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";logged_in|a:13:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:10:\"first_name\";s:0:\"\";s:9:\"last_name\";s:13:\"Administrator\";s:5:\"email\";s:15:\"admin@admin.com\";s:9:\"user_type\";s:1:\"1\";s:11:\"profile_img\";s:19:\"admin1556803478.jpg\";s:8:\"language\";s:0:\"\";s:8:\"is_admin\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2013-01-01 00:00:00\";s:7:\"updated\";s:19:\"2019-05-02 19:24:38\";s:10:\"ip_address\";s:3:\"::1\";}', 250);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('st3pf67sp4q9vi1ua6s3nrfllg87ocol', '::1', 1562330314, '__ci_last_regenerate|i:1562330314;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";redirect|s:41:\"http://localhost/ci/project_manager/admin\";', 251);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('aq60q9spaiovg4cc965jsl8dp2o7ir74', '::1', 1562330320, '__ci_last_regenerate|i:1562330315;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";logged_in|a:13:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:10:\"first_name\";s:0:\"\";s:9:\"last_name\";s:13:\"Administrator\";s:5:\"email\";s:15:\"admin@admin.com\";s:9:\"user_type\";s:1:\"1\";s:11:\"profile_img\";s:19:\"admin1556803478.jpg\";s:8:\"language\";s:0:\"\";s:8:\"is_admin\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2013-01-01 00:00:00\";s:7:\"updated\";s:19:\"2019-05-02 19:24:38\";s:10:\"ip_address\";s:3:\"::1\";}', 252);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('4o3e2lp0dp2migmcl4j6e4qucgd7tv9r', '::1', 1562330320, '__ci_last_regenerate|i:1562330320;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";redirect|s:41:\"http://localhost/ci/project_manager/admin\";', 253);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('fj2huvf2d65qcvo89sb20i822ahrpgp8', '::1', 1562330330, '__ci_last_regenerate|i:1562330329;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";logged_in|a:13:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:10:\"first_name\";s:0:\"\";s:9:\"last_name\";s:13:\"Administrator\";s:5:\"email\";s:15:\"admin@admin.com\";s:9:\"user_type\";s:1:\"1\";s:11:\"profile_img\";s:19:\"admin1556803478.jpg\";s:8:\"language\";s:0:\"\";s:8:\"is_admin\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2013-01-01 00:00:00\";s:7:\"updated\";s:19:\"2019-05-02 19:24:38\";s:10:\"ip_address\";s:3:\"::1\";}', 254);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('31q7enveeadsc8g7849t8lhg5al1e1q4', '::1', 1562330395, '__ci_last_regenerate|i:1562330393;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";redirect|s:41:\"http://localhost/ci/project_manager/admin\";', 255);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('ji4ip9hcua1o7443tdnmfjgjt7926ihi', '::1', 1562330398, '__ci_last_regenerate|i:1562330397;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";logged_in|a:13:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:10:\"first_name\";s:0:\"\";s:9:\"last_name\";s:13:\"Administrator\";s:5:\"email\";s:15:\"admin@admin.com\";s:9:\"user_type\";s:1:\"1\";s:11:\"profile_img\";s:19:\"admin1556803478.jpg\";s:8:\"language\";s:0:\"\";s:8:\"is_admin\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2013-01-01 00:00:00\";s:7:\"updated\";s:19:\"2019-05-02 19:24:38\";s:10:\"ip_address\";s:3:\"::1\";}', 256);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('8a053a6b964ebpi9j3bkke6tvbbs8eg1', '::1', 1562330464, '__ci_last_regenerate|i:1562330460;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";logged_in|a:13:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:10:\"first_name\";s:0:\"\";s:9:\"last_name\";s:13:\"Administrator\";s:5:\"email\";s:15:\"admin@admin.com\";s:9:\"user_type\";s:1:\"1\";s:11:\"profile_img\";s:19:\"admin1556803478.jpg\";s:8:\"language\";s:0:\"\";s:8:\"is_admin\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2013-01-01 00:00:00\";s:7:\"updated\";s:19:\"2019-05-02 19:24:38\";s:10:\"ip_address\";s:3:\"::1\";}', 257);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('4ilm8ffku8dcvbjv9mmn4s28149blkel', '::1', 1562330473, '__ci_last_regenerate|i:1562330471;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";redirect|s:41:\"http://localhost/ci/project_manager/admin\";', 258);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('iga33g4cac63iilfrra63nullt8ofbui', '::1', 1562330476, '__ci_last_regenerate|i:1562330475;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";logged_in|a:13:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:10:\"first_name\";s:0:\"\";s:9:\"last_name\";s:13:\"Administrator\";s:5:\"email\";s:15:\"admin@admin.com\";s:9:\"user_type\";s:1:\"1\";s:11:\"profile_img\";s:19:\"admin1556803478.jpg\";s:8:\"language\";s:0:\"\";s:8:\"is_admin\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2013-01-01 00:00:00\";s:7:\"updated\";s:19:\"2019-05-02 19:24:38\";s:10:\"ip_address\";s:3:\"::1\";}', 259);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('gcosdcg3ismnodd0sdmdcqjq2o0lhq3h', '::1', 1562330498, '__ci_last_regenerate|i:1562330498;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";redirect|s:41:\"http://localhost/ci/project_manager/admin\";', 260);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('g6uflq1e4sr4l1g85oajs0iehmkan2rt', '::1', 1562340261, '__ci_last_regenerate|i:1562340261;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";logged_in|a:13:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:10:\"first_name\";s:0:\"\";s:9:\"last_name\";s:13:\"Administrator\";s:5:\"email\";s:15:\"admin@admin.com\";s:9:\"user_type\";s:1:\"1\";s:11:\"profile_img\";s:19:\"admin1556803478.jpg\";s:8:\"language\";s:0:\"\";s:8:\"is_admin\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2013-01-01 00:00:00\";s:7:\"updated\";s:19:\"2019-05-02 19:24:38\";s:10:\"ip_address\";s:3:\"::1\";}referrer|s:97:\"http://localhost/ci/project_manager/admin/category?sort=cat1.sort_order&dir=asc&limit=20&offset=0\";', 283);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `tbl_id`) VALUES ('bp8u096k5vcv70k72f96vq7tc9d15clm', '::1', 1562341369, '__ci_last_regenerate|i:1562341344;languages|a:1:{s:7:\"english\";s:7:\"English\";}language|s:7:\"english\";logged_in|a:13:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:10:\"first_name\";s:0:\"\";s:9:\"last_name\";s:13:\"Administrator\";s:5:\"email\";s:15:\"admin@admin.com\";s:9:\"user_type\";s:1:\"1\";s:11:\"profile_img\";s:19:\"admin1556803478.jpg\";s:8:\"language\";s:0:\"\";s:8:\"is_admin\";s:1:\"1\";s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2013-01-01 00:00:00\";s:7:\"updated\";s:19:\"2019-05-02 19:24:38\";s:10:\"ip_address\";s:3:\"::1\";}', 286);


#
# TABLE STRUCTURE FOR: emails
#

DROP TABLE IF EXISTS `emails`;

CREATE TABLE `emails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `email` varchar(256) NOT NULL,
  `message` text NOT NULL,
  `created` datetime NOT NULL,
  `read` datetime DEFAULT NULL,
  `read_by` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `created` (`created`),
  KEY `read` (`read`),
  KEY `read_by` (`read_by`),
  KEY `email` (`email`(78))
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (4, 'Quon Barber', 'xotegagy@mailinator.com', 'Dolorum autem eos est quidem dolor', '2018-09-20 15:31:57', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (5, 'Noah West', 'pema@mailinator.com', 'Id dolores laboriosam necessitatibus in est et et enim doloribus tempor cumque sunt qui exercitation', '2018-09-20 15:33:20', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (6, 'Claudia Francis', 'zipolehe@mailinator.net', 'Optio vitae cupiditate do aperiam aliqua Nesciunt', '2018-09-20 15:38:58', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (7, 'Wynne Garrett', 'cakesoxi@mailinator.com', 'Veniam nemo velit velit saepe nobis quo esse aut velit quibusdam eum quam ut et', '2018-09-20 15:40:07', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (8, 'Jael Walter', 'bulu@mailinator.com', 'Dolore exercitationem quia atque sed obcaecati enim', '2018-09-22 23:35:29', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (9, 'name', 'nakib.un@gmail.com', 'asdasdsaasdasd', '2019-03-06 19:58:50', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (10, 'name', 'lukman.nakib@gmail.com', 'asdsadsadsad', '2019-03-06 20:06:17', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (11, 'asd', 'nakib.un@gmail.com', 'asdasdasdasdsad', '2019-03-06 20:06:57', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (12, 'asd', 'asd@s.com', 'asdsadsadasd', '2019-03-06 20:07:20', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (13, 'asdasd', 'asd@s.com', 'asdsadasdasd', '2019-03-06 20:12:04', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (14, 'asdsad', 'rahat392@gmail.com', 'asdasdsadsad', '2019-03-06 20:17:18', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (15, 'asdasd', 'asd@s.com', 'asdsadasdasd', '2019-03-06 20:26:40', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (16, 'name', 'lukman.nakib@gmail.com', 'asdasdasdasdsad', '2019-03-06 20:28:12', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (17, 'asdasd', 'asd@s.com', 'asdasdasdasd', '2019-03-06 20:28:47', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (18, 'DJ Sunny', 'rahat392@gmail.com', 'asdasdsadsdsd', '2019-03-06 20:29:40', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (19, 'assasd asd', 'nakib.un@gmail.com', 'asdsadsadasd', '2019-03-06 20:30:07', NULL, NULL);
INSERT INTO `emails` (`id`, `name`, `email`, `message`, `created`, `read`, `read_by`) VALUES (20, 'asd', 'asd@s.com', 'asdsadasdsad', '2019-03-06 20:30:27', NULL, NULL);


#
# TABLE STRUCTURE FOR: login_attempts
#

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `ip` varchar(20) NOT NULL,
  `attempt` datetime NOT NULL,
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `login_attempts` (`ip`, `attempt`) VALUES ('::1', '2019-07-05 17:42:49');


#
# TABLE STRUCTURE FOR: menu
#

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` text,
  `menu_position` int(11) DEFAULT NULL,
  `menu_style` text,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_position`, `menu_style`, `status`) VALUES (1, 'Admin', 1, NULL, 1);
INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_position`, `menu_style`, `status`) VALUES (2, 'Category', 2, NULL, 1);
INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_position`, `menu_style`, `status`) VALUES (17, 'Footer Menu', 3, NULL, 1);


#
# TABLE STRUCTURE FOR: menu_content
#

DROP TABLE IF EXISTS `menu_content`;

CREATE TABLE `menu_content` (
  `menu_content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_type` text,
  `content_id` int(11) DEFAULT NULL,
  `menu_position` int(11) DEFAULT NULL,
  `menu_lavel` varchar(222) DEFAULT NULL,
  `link_url` varchar(250) DEFAULT NULL,
  `slug` text,
  `parents_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`menu_content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

INSERT INTO `menu_content` (`menu_content_id`, `content_type`, `content_id`, `menu_position`, `menu_lavel`, `link_url`, `slug`, `parents_id`, `menu_id`, `status`) VALUES (1, 'categories', 1, 5, 'আন্তর্জাতিক', '', 'International', 0, 1, 1);
INSERT INTO `menu_content` (`menu_content_id`, `content_type`, `content_id`, `menu_position`, `menu_lavel`, `link_url`, `slug`, `parents_id`, `menu_id`, `status`) VALUES (4, 'categories', 4, 14, ' প্রযুক্তি', '', 'Technology', 0, 1, 1);
INSERT INTO `menu_content` (`menu_content_id`, `content_type`, `content_id`, `menu_position`, `menu_lavel`, `link_url`, `slug`, `parents_id`, `menu_id`, `status`) VALUES (9, 'categories', 17, 9, 'খেলা', '', 'Sports', 0, 1, 1);
INSERT INTO `menu_content` (`menu_content_id`, `content_type`, `content_id`, `menu_position`, `menu_lavel`, `link_url`, `slug`, `parents_id`, `menu_id`, `status`) VALUES (11, 'categories', 1, 3, 'আন্তর্জাতিক', '', 'International', 0, 2, 1);
INSERT INTO `menu_content` (`menu_content_id`, `content_type`, `content_id`, `menu_position`, `menu_lavel`, `link_url`, `slug`, `parents_id`, `menu_id`, `status`) VALUES (16, 'categories', 6, 4, 'সম্পাদক নির্বাচিত', '', 'Editor-Choice', 0, 2, 1);
INSERT INTO `menu_content` (`menu_content_id`, `content_type`, `content_id`, `menu_position`, `menu_lavel`, `link_url`, `slug`, `parents_id`, `menu_id`, `status`) VALUES (23, 'links', 1, 4, 'SITEMAP', 'http://demonewspaper.bdtask.com/DemoNewsPaper-v1.5/sitemap.xml', NULL, 0, 17, 1);
INSERT INTO `menu_content` (`menu_content_id`, `content_type`, `content_id`, `menu_position`, `menu_lavel`, `link_url`, `slug`, `parents_id`, `menu_id`, `status`) VALUES (32, 'pages', 1, 1, 'ABOUT US', NULL, 'About-us', NULL, 17, 1);
INSERT INTO `menu_content` (`menu_content_id`, `content_type`, `content_id`, `menu_position`, `menu_lavel`, `link_url`, `slug`, `parents_id`, `menu_id`, `status`) VALUES (33, 'pages', 2, 2, 'PRIVACY POLICY', NULL, 'PRIVACY-POLICY', NULL, 17, 1);
INSERT INTO `menu_content` (`menu_content_id`, `content_type`, `content_id`, `menu_position`, `menu_lavel`, `link_url`, `slug`, `parents_id`, `menu_id`, `status`) VALUES (34, 'pages', 3, 3, 'TERMS OF USE', NULL, 'TERMS-OF', NULL, 17, 1);


#
# TABLE STRUCTURE FOR: permission_groups
#

DROP TABLE IF EXISTS `permission_groups`;

CREATE TABLE `permission_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupName` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

INSERT INTO `permission_groups` (`id`, `groupName`) VALUES (1, 'Super Admin');
INSERT INTO `permission_groups` (`id`, `groupName`) VALUES (2, 'Seller');
INSERT INTO `permission_groups` (`id`, `groupName`) VALUES (3, 'Buyer');


#
# TABLE STRUCTURE FOR: permission_map
#

DROP TABLE IF EXISTS `permission_map`;

CREATE TABLE `permission_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupID` int(11) NOT NULL,
  `permissionID` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (7, 1, 71, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (8, 1, 70, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (9, 1, 73, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (10, 1, 77, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (11, 1, 74, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (12, 1, 81, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (13, 1, 83, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (14, 1, 85, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (15, 1, 86, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (16, 1, 82, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (18, 3, 70, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (19, 3, 86, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (20, 3, 85, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (21, 2, 86, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (22, 3, 83, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (23, 2, 83, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (24, 1, 76, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (25, 1, 75, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (26, 1, 78, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (27, 1, 79, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (29, 1, 80, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (30, 1, 87, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (31, 1, 84, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (32, 1, 72, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (33, 1, 88, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (34, 2, 70, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (37, 2, 73, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (38, 2, 74, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (39, 2, 76, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (40, 2, 75, 1);
INSERT INTO `permission_map` (`id`, `groupID`, `permissionID`, `status`) VALUES (41, 2, 85, 1);


#
# TABLE STRUCTURE FOR: permissions
#

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(200) DEFAULT NULL,
  `key` varchar(100) DEFAULT NULL,
  `module_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (71, 'Read', 'projects_view', 'Projects');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (70, 'Read', 'dashboard_view', 'Admin Dashboard');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (87, 'Create', 'acl_create', 'User Access Control');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (72, 'Update', 'projects_update', 'Projects');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (73, 'Create', 'category_create', 'Category');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (74, 'Read', 'category_view', 'Category');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (75, 'Delete', 'category_delete', 'Category');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (76, 'Update', 'category_update', 'Category');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (77, 'Read', 'user_view', 'User');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (78, 'Create', 'user_create', 'User');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (79, 'Delete', 'user_delete', 'User');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (80, 'Update', 'user_update', 'User');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (81, 'Read', 'acl_view', 'User Access Control');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (82, 'Update', 'acl_update', 'User Access Control');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (83, 'Read', 'settings_view', 'Settings');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (84, 'Update', 'settings_update', 'Settings');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (85, 'Read', 'payment_view', 'Payment');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (86, 'Read', 'email_test_view', 'Email Test');
INSERT INTO `permissions` (`id`, `permission`, `key`, `module_name`) VALUES (88, 'Delete', 'acl_delete', 'User Access Control');


#
# TABLE STRUCTURE FOR: settings
#

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `input_type` enum('input','textarea','radio','dropdown','timezones','file') CHARACTER SET latin1 NOT NULL,
  `options` text COMMENT 'Use for radio and dropdown: key|value on each line',
  `is_numeric` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'forces numeric keypad on mobile devices',
  `show_editor` enum('0','1') NOT NULL DEFAULT '0',
  `input_size` enum('large','medium','small') DEFAULT NULL,
  `translate` enum('0','1') NOT NULL DEFAULT '0',
  `help_text` varchar(256) DEFAULT NULL,
  `validation` varchar(128) NOT NULL,
  `sort_order` tinyint(3) unsigned NOT NULL,
  `label` varchar(128) NOT NULL,
  `value` text COMMENT 'If translate is 1, just start with your default language',
  `last_update` datetime DEFAULT NULL,
  `updated_by` int(11) unsigned DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'general',
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (1, 'site_name', 'input', NULL, '0', '0', 'large', '0', NULL, 'required|trim|min_length[3]|max_length[128]', 10, 'Site Name', 'Hisenberg', '2019-07-05 15:45:14', 1, 'general', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (3, 'meta_keywords', 'input', NULL, '0', '0', 'large', '0', 'Comma-seperated list of site keywords', 'trim', 10, 'Meta Keywords', 'these, are, keywords', '2019-07-05 15:45:14', 1, 'general', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (4, 'meta_description', 'textarea', NULL, '0', '0', 'large', '0', 'Short description describing your site.', 'trim', 10, 'Meta Description', 'This is the site description from settings', '2019-07-05 15:45:14', 1, 'general', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (5, 'site_email', 'input', NULL, '0', '0', 'medium', '0', 'Email address all emails will be sent from.', 'required|trim|valid_email', 50, 'Site Email', 'email@yourdomain.com', '2019-07-05 15:45:15', 1, 'contact', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (7, 'welcome_message', 'textarea', NULL, '0', '1', 'large', '1', 'Message to display on home page.', 'trim', 10, 'Welcome message', '<h1 style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 4px; border: none; outline: 0px; vertical-align: baseline;\"><font face=\"Ek Mukta, sans-serif\"><b>Have a project in mind?</b></font></h1><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 4px; border: none; outline: 0px; vertical-align: baseline;\"><font face=\"Ek Mukta, sans-serif\">You can reach us by email!<br></font><font face=\"Ek Mukta, sans-serif\">Based in London. We push boundaries trough thinking not just about your brand, your website, or your digital marketing but how all of the digital elements of your business work togheter.</font></p><p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 4px; border: none; outline: 0px; vertical-align: baseline;\"><font face=\"Ek Mukta, sans-serif\"><b><br></b></font><font face=\"Ek Mukta, sans-serif\"><b>Through our best-in-class techniques and bespoke growth plans we assess digital problems and put in place strategies that lead to commercial success.</b></font></p>', '2019-07-05 15:45:14', 1, 'general', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (8, 'contact', 'input', NULL, '0', '0', NULL, '0', 'Your Contact Info', '', 50, 'Contact Info', '', '2019-07-05 15:45:15', 1, 'contact', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (9, 'owner_name', 'input', NULL, '0', '0', NULL, '0', NULL, '', 10, 'Owner Name', 'Masud Rana', '2019-07-05 15:45:14', 1, 'general', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (10, 'owner_mobile', 'input', NULL, '0', '0', NULL, '0', 'Owner Contact Number', '', 50, 'Contact Number', '+880714587993', '2019-07-05 15:45:15', 1, 'contact', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (11, 'facebook', 'input', NULL, '0', '0', NULL, '0', 'Fb Link', '', 100, 'Facebook', 'https://www.facebook.com/', '2019-07-05 15:45:15', 1, 'social', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (12, 'twitter', 'input', NULL, '0', '0', NULL, '0', 'Twitter Link', '', 100, 'Twitter ', '#', '2019-07-05 15:45:15', 1, 'social', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (13, 'instagram', 'input', NULL, '0', '0', NULL, '0', 'Instagram Link', '', 100, 'Instagram', '#', '2019-07-05 15:45:15', 1, 'social', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (14, 'address', 'textarea', NULL, '0', '0', NULL, '0', NULL, '', 50, 'Address', 'Zindabazar, Sylhet', '2019-07-05 15:45:15', 1, 'contact', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (15, 'per_page_limit', 'input', NULL, '0', '0', NULL, '0', 'per_page_limit', '', 10, 'per_page_limit', '20', '2019-07-05 15:45:14', 1, 'general', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (19, 'template', 'dropdown', 'default|Default\r\ndefault_2018|2018', '0', '0', NULL, '0', 'Website Theme', '', 10, 'Theme', 'default_2018', '2019-07-05 15:45:14', 1, 'general', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (20, 'logo1', 'file', '', '0', '0', NULL, '0', NULL, '', 5, 'Logo', 'uploads/logo/Jul_2019/logo1.jpg', '2019-07-05 15:45:15', 1, 'general', 0);
INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`, `type`, `deleted`) VALUES (21, 'footer', 'input', '', '0', '0', NULL, '0', '', 'trim', 10, 'Website Footer', 'Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Created <!-- <i class=\"icon-heart color-danger\" aria-hidden=\"true\"></i> --> by <a href=\"http://thedigitalavengers.com/\" target=\"_blank\"> The Digital Avengers </a>', '2019-07-05 15:45:15', 1, 'general', 0);


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(256) NOT NULL,
  `user_type` tinyint(2) NOT NULL DEFAULT '1',
  `mobile` varchar(12) NOT NULL,
  `salt` char(128) NOT NULL,
  `is_admin` enum('0','1') NOT NULL DEFAULT '0',
  `language` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `validation_code` varchar(50) DEFAULT NULL COMMENT 'Temporary code for opt-in registration',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `online` int(4) NOT NULL DEFAULT '0',
  `ip_address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `user_type`, `mobile`, `salt`, `is_admin`, `language`, `password`, `gender`, `status`, `deleted`, `validation_code`, `created`, `updated`, `profile_img`, `address`, `online`, `ip_address`) VALUES (1, 'admin', '', 'Administrator', 'admin@admin.com', 1, '', '66cb0ab1d9efe250b46e28ecb45eb33b3609f1efda37547409a113a2b84c3f94b6a0e738acc391e2dfa718676aa55adead05fcb12d2e32aee379e190511a3252', '1', '', 'ce516f215aa468c376736c9013e8b663f7b3c06226a87739bc6b32882f9278349a721ea725a156eecf9e3c1868904a77e4d42c783e0287a0909a8bbb97e1525f', '', '1', '0', NULL, '2013-01-01 00:00:00', '2019-05-02 19:24:38', 'admin1556803478.jpg', '', 1, '::1');
INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `user_type`, `mobile`, `salt`, `is_admin`, `language`, `password`, `gender`, `status`, `deleted`, `validation_code`, `created`, `updated`, `profile_img`, `address`, `online`, `ip_address`) VALUES (3, 'rahynoxori', '', 'Buckner', 'fogopiqymu@mailinator.com', 1, '', 'cda829ac751e44c9d89a5a5a4da8b7f626f8284351fb82ae5c830927251998d81548bdcb3e987bc2d40ec324e156dbc188ac06d3a1b32a88cbecc4878b29736b', '0', '', 'ab8ce45c74c2efc513baac7f02cc3836a87acaaf26a43b28e8a656f03443fda92db4e2dfaa488120bb9d0065a1a9e3577a1c6633cb220fee58bcbea3445ff256', '', '0', '1', NULL, '2019-01-15 15:11:20', '2019-01-15 15:11:29', NULL, '', 0, '');
INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `user_type`, `mobile`, `salt`, `is_admin`, `language`, `password`, `gender`, `status`, `deleted`, `validation_code`, `created`, `updated`, `profile_img`, `address`, `online`, `ip_address`) VALUES (4, 'maxytor', '', 'Carpenter', 'viki@mailinator.com', 1, '', '48860ba2d002c7566bec138f40ee3b6ce4b1b9645ecc7238cfa3832c4e5063dc4e921898073bc6d52a02c0c20fdeab33e18d9916c5d286ea45ad811eb765d04e', '0', '', '1bfe67addb9252e773d744961cc473a4bd2572821fc563ab6d3b2141c06f595896908893d5b4dc3befd02f6c6dfced142fd8b6858a452c36bbca142cadc104f3', '', '1', '0', NULL, '2019-01-21 15:54:26', '2019-01-21 15:54:26', NULL, '', 1, '');
INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `user_type`, `mobile`, `salt`, `is_admin`, `language`, `password`, `gender`, `status`, `deleted`, `validation_code`, `created`, `updated`, `profile_img`, `address`, `online`, `ip_address`) VALUES (7, 'test123', '', 'Byers', 'test@test.com', 1, '', '113237fa06126343e16d21363d84dd7e33fb976cc78aa40dd3ee8ee20425ab0cede9c61ca65eb7d23f326ff46f3edf7bed09b681f705e972274f1c388f08f871', '0', '', '968b805bacd0b61b25b81d439024cd514c1836fb840833f0c760667bf91d154ddbe8b2ca354a39649447b491362973c3d05344e04eb5f02eaaf6b30f38f15818', '', '0', '1', '06d56e38832ea9fb5d1956ab62e9ea08e5d2aebf', '2019-01-22 10:52:35', '2019-02-21 20:38:22', NULL, '', 0, '');
INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `user_type`, `mobile`, `salt`, `is_admin`, `language`, `password`, `gender`, `status`, `deleted`, `validation_code`, `created`, `updated`, `profile_img`, `address`, `online`, `ip_address`) VALUES (8, 'user1', '', 'Canray', 'lukman.nakib@gmail.com', 3, '', 'b01d3e94e3f92927f1a892ae3a72921458176c28c6bdb84378308f832e58002b85841cef29693313c7d3012eb960dd289f9222e76e89a35aba098cb37e02c844', '1', '', '4a0ccc54b275d3853881b6b17445e125add4b8fe7c5981031bce14960a9df3ebdb766a51f39b8e2699db71dd439ede1bb617a196cc16668e73192765ae8330c8', '', '1', '0', NULL, '2019-02-21 20:38:09', '2019-06-17 12:44:10', '', '', 0, '::1');
INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `user_type`, `mobile`, `salt`, `is_admin`, `language`, `password`, `gender`, `status`, `deleted`, `validation_code`, `created`, `updated`, `profile_img`, `address`, `online`, `ip_address`) VALUES (9, 'miran', '', 'last name', 'miran@mail.com', 3, '010410414141', '0fcba76b13871c2a0b9a937a76f31fe3dea75ee3c2bb4c8d6664eb4fca9684acd2a0be950018ccadb514a2894de09b01571620b1a006132996ebcf321134b5cf', '1', '', '1153eae0488995b6933b1b43f4d295c4c79b3998bb1ec3298ddacffacc740472b88a34a48efde806d1fab8925b95329eb93c37111d78d955cdbc3fff8d31eec6', 'm', '1', '0', '3cac74ea6632bdcff46e23460b7e3640e9e593cc', '2019-02-26 20:32:35', '2019-06-09 03:32:12', '1560071649_09.jpg', '', 0, '::1');
INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `user_type`, `mobile`, `salt`, `is_admin`, `language`, `password`, `gender`, `status`, `deleted`, `validation_code`, `created`, `updated`, `profile_img`, `address`, `online`, `ip_address`) VALUES (19, 'buyer', '', 'Accountent', 'lukman.nakib@gmail.com', 3, '11111121231', '9716336e90b1e1c89be33d62fb01c32c3d1d31a072b8126c463a37c608895543a5e152d6d91e07a3c119f19e864da93be1e405b483a273c36a07124355dfcff6', '1', '', '0dd232dbe0621f6d868f69803a35bd461e007c65ad47e3065aa6ee4aeac1476c024a310c10950d36d63f6961281852ac10d5552a63a89de843d14bd177a1009c', 'm', '1', '0', NULL, '2019-05-03 14:56:23', '2019-06-27 01:01:00', 'buyer1556874475.jpg', 'Sylhet, Bangladesh', 0, '::1');
INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `user_type`, `mobile`, `salt`, `is_admin`, `language`, `password`, `gender`, `status`, `deleted`, `validation_code`, `created`, `updated`, `profile_img`, `address`, `online`, `ip_address`) VALUES (20, 'seller1', '', 'Doe', 'test@gmail.com', 2, '01715928113', '5269550bf6b24e281bde75c9580a7f92ebe3cdfb78d84925f21c26e557021545823902a7d9dd51cbbe13e851a2e72ffc3e1cef05313c755a38875730987e2c44', '1', '', 'f418a8d7d2120e34783a0df344d1ea1d315a81aad882767abd8126cda0a0c226a517123e45229e739a2226e6c6b2174661ca4022ea1759389b89bbd9ea4f6375', '', '1', '0', '7d16158bbddf4d915792c611b83c5238ae14277f', '2019-05-03 15:24:27', '2019-05-28 12:47:37', '1559026057_28.jpg', '', 0, '::1');
INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `user_type`, `mobile`, `salt`, `is_admin`, `language`, `password`, `gender`, `status`, `deleted`, `validation_code`, `created`, `updated`, `profile_img`, `address`, `online`, `ip_address`) VALUES (21, 'seller2', '', 'Brav', 'gmsdev2@gmswebdesign.co.uk', 2, '011245579841', '771815f79295d93bcc039107ada615be5e53543a718f8cd9e83c94df580ce38c99a44cbff8fb6765ed7ae8ac16dc46dc1cfed825f62b37ab3b4a35f13a4a24a7', '1', '', '578723795f9f5bbcd250491c891d75210f837d0e1a27644cbda4a8de0cce536f60af2a3893495d919dae4fd143a6c4131b9bd9f4b19a114ef74d0f72aa015fd7', 'm', '1', '0', NULL, '2019-05-08 14:11:59', '2019-06-27 01:07:42', NULL, '86 Dorgah Moholla Rd, Sylhet, Bangladesh', 0, '::1');
INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `user_type`, `mobile`, `salt`, `is_admin`, `language`, `password`, `gender`, `status`, `deleted`, `validation_code`, `created`, `updated`, `profile_img`, `address`, `online`, `ip_address`) VALUES (22, 'tipigajuza', '', 'Foreman', 'wowevula@mailinator.com', 2, '', '598b3605a759f75c2da26a542271a6908a17bcf8ad63e44850a7236ea740fd89bab917d68047562ec24290eef0f62c519d71e5c65c3f924a0a555f5a63b3dc6f', '1', '', '55a8fe346b1dbba45c259f38f79f32e42e487f66de67ac1bf937c6fe89cbe07a8a41cafb52b10563ff8ea5b96cfb6951dbf050b667ed6f7bfaf3cf87f01d58a3', '', '1', '0', NULL, '2019-05-30 08:50:15', '2019-05-30 08:57:25', NULL, '', 0, '::1');


