

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
