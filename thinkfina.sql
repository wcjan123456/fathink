/*
Navicat MariaDB Data Transfer

Source Server         : local
Source Server Version : 100310
Source Host           : localhost:3306
Source Database       : thinkfina

Target Server Type    : MariaDB
Target Server Version : 100310
File Encoding         : 65001

Date: 2018-11-07 18:00:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for raw_authorize
-- ----------------------------
DROP TABLE IF EXISTS `raw_authorize`;
CREATE TABLE `raw_authorize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT 0,
  `title` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `display` int(11) DEFAULT 1,
  `is_common` int(11) DEFAULT 0,
  `order` int(11) DEFAULT 0,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of raw_authorize
-- ----------------------------
INSERT INTO `raw_authorize` VALUES ('1', '0', '首页概述', 'fa/index', 'am-icon-dashboard', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('2', '0', '项目管理', 'fa/projects', 'am-icon-tasks', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('3', '2', '项目列表', 'fa/projects/index', 'am-icon-tasks', '1', '1', '0', '1');
INSERT INTO `raw_authorize` VALUES ('4', '2', '项目报表', 'fa/projects/report', 'am-icon-bar-chart', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('5', '0', '财务管理', 'fa/finance', 'am-icon-paypal', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('6', '5', '收支记录', 'fa/finance/index', 'am-icon-list-ul', '1', '1', '5', '1');
INSERT INTO `raw_authorize` VALUES ('7', '5', '工时管理', 'fa/finance/man_hour', 'am-icon-coffee', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('8', '5', '资金流', 'fa/finance/management', 'am-icon-btc', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('9', '5', '财务报表', 'fa/finance/statements', 'am-icon-bar-chart', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('10', '0', '部门管理', 'fa/member', 'am-icon-graduation-cap', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('11', '0', '客户关系', 'fa/member/index', 'am-icon-sitemap', '1', '1', '0', '1');
INSERT INTO `raw_authorize` VALUES ('12', '0', '报价管理', 'fa/quoted', 'am-icon-rocket', '1', '1', '0', '1');
INSERT INTO `raw_authorize` VALUES ('13', '0', '文档管理', 'fa/documents', 'am-icon-folder-open-o', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('14', '0', '权限管理', 'fa/authorize', 'am-icon-sliders', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('15', '0', '全局设置', 'fa/settings', 'am-icon-cogs', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('16', '14', '权限菜单', 'fa/authorize/index', 'am-icon-bars', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('17', '14', '管理组', 'fa/authorize/groups', 'am-icon-users', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('18', '14', '管理日志', 'fa/authorize/index', 'am-icon-file-text-o', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('19', '10', '部门设置', 'fa/member/department', 'am-icon-home', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('20', '10', '员工列表', 'fa/member/index', 'am-icon-list', '1', '1', '1', '1');
INSERT INTO `raw_authorize` VALUES ('21', '5', '工资表', 'fa/finance/wages', 'am-icon-table', '1', '1', '3', '1');
INSERT INTO `raw_authorize` VALUES ('22', '12', '报价列表', 'fa/quoted/index', 'am-icon-list', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('23', '12', '新建报价', 'fa/quoted/create_item', 'am-icon-plus', '1', '0', '0', '1');
INSERT INTO `raw_authorize` VALUES ('24', '12', '产品报价', 'fa/quoted/products', 'am-icon-th-large', '1', '0', '0', '1');

-- ----------------------------
-- Table structure for raw_authorize_group
-- ----------------------------
DROP TABLE IF EXISTS `raw_authorize_group`;
CREATE TABLE `raw_authorize_group` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) DEFAULT NULL,
  `rules` text DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of raw_authorize_group
-- ----------------------------

-- ----------------------------
-- Table structure for raw_authorize_map
-- ----------------------------
DROP TABLE IF EXISTS `raw_authorize_map`;
CREATE TABLE `raw_authorize_map` (
  `map_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`map_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of raw_authorize_map
-- ----------------------------

-- ----------------------------
-- Table structure for raw_finance
-- ----------------------------
DROP TABLE IF EXISTS `raw_finance`;
CREATE TABLE `raw_finance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '经办人',
  `pid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT '',
  `money` decimal(10,2) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL COMMENT '支付方式',
  `payee` varchar(50) DEFAULT NULL COMMENT '收款方',
  `voucher` varchar(255) DEFAULT NULL COMMENT '收据 凭证',
  `dateline` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of raw_finance
-- ----------------------------
INSERT INTO `raw_finance` VALUES ('1', '5', '4', 'P2.5LED进货款', '20000.00', '2', '4', '云南强兴科技有限公司 ', '/attach/20181017/2a3024d3e98547dae682d63e9023913a.png', '1539767135', '1');
INSERT INTO `raw_finance` VALUES ('2', '5', '3', '制作安装款', '1800.00', '1', '2', '万维广告', '', '1540882810', '1');
INSERT INTO `raw_finance` VALUES ('3', '5', '5', '3x5镀锌 18根', '680.00', '2', '1', '荣申钢材', '', '1540883403', '1');
INSERT INTO `raw_finance` VALUES ('4', '5', '6', '门头牌 制作费用', '2790.00', '2', '2', '昆明发达广告', '', '1540884200', '1');
INSERT INTO `raw_finance` VALUES ('5', '5', '5', '铝塑板购买费用', '1650.00', '2', '2', '福通建材市场', '', '1541388843', '1');
INSERT INTO `raw_finance` VALUES ('6', '5', '5', '钢材 购买 2根', '76.00', '2', '2', '荣申钢材', '', '1541388873', '1');
INSERT INTO `raw_finance` VALUES ('7', '5', '5', '工人预支工资 ', '300.00', '2', '2', '工人', '', '1541388911', '1');
INSERT INTO `raw_finance` VALUES ('8', '5', '7', '法恩莎PVC刻字款', '100.00', '2', '1', '老街子', '', '1541389027', '1');
INSERT INTO `raw_finance` VALUES ('9', '5', '5', '奇睿科技门头结构胶玻璃胶', '370.00', '2', '2', '互惠胶业', '', '1541574437', '1');
INSERT INTO `raw_finance` VALUES ('10', '5', '5', '计时器 购买费用', '60.00', '2', '2', '人民西路', '', '1541574472', '1');

-- ----------------------------
-- Table structure for raw_member
-- ----------------------------
DROP TABLE IF EXISTS `raw_member`;
CREATE TABLE `raw_member` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hash` char(64) DEFAULT NULL,
  `username` char(50) NOT NULL,
  `mobile` char(50) DEFAULT NULL,
  `password` char(64) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `ticket` varchar(64) DEFAULT NULL,
  `department_id` int(255) DEFAULT NULL COMMENT '部门',
  `reg_time` int(11) DEFAULT NULL,
  `reg_ip` char(20) DEFAULT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  `last_login_ip` char(20) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `think_user_uid_openid_uindex` (`uid`,`hash`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户列表';

-- ----------------------------
-- Records of raw_member
-- ----------------------------
INSERT INTO `raw_member` VALUES ('1', '1qtHmKEn7VmE9645', 'admin', '17787937708', 'c1e00a7504e6ce17dbc111ba4679e75c9faac99e', null, 'WNsISq7C2TEG2341', '8', '1473672824', '127.0.0.1', '1528512366', '::1', '1');
INSERT INTO `raw_member` VALUES ('2', 'XrL0ksEPxmwi4678', '周海蔚', '17787922099', 'b70f98782608df1be90c831ca1d054df91289dc2', null, null, '7', null, null, null, null, '1');
INSERT INTO `raw_member` VALUES ('3', 'F0BCVzsFQMCV4853', '王建', '18083880499', '38b840e72e2d29235145727fff93b895d69643b7', null, 'Q9mrKKCaYk614853', '13', '1538234853', '::1', null, null, '1');
INSERT INTO `raw_member` VALUES ('4', 'y5rNQWky0Rt75305', '徐军', '14787279089', '2d6221dc7037cb17b588dcf9140d9cce4b3e00ad', null, 'fZMZ6tjAzSu55305', '14', '1538235305', '::1', null, null, '1');
INSERT INTO `raw_member` VALUES ('5', 'tDgbqM4M6PUz5337', '王斌', '17787937708', '1fa1e70711df1f612ddb4132c73089e114c772fb', null, 'tbZ523Qg7Csx5337', '8', '1538235337', '::1', null, null, '1');

-- ----------------------------
-- Table structure for raw_member_department
-- ----------------------------
DROP TABLE IF EXISTS `raw_member_department`;
CREATE TABLE `raw_member_department` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT 0,
  `department` varchar(50) DEFAULT NULL,
  `order` int(11) DEFAULT 0,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of raw_member_department
-- ----------------------------
INSERT INTO `raw_member_department` VALUES ('1', '0', '普洱万维广告有限公司', '0', '1');
INSERT INTO `raw_member_department` VALUES ('2', '0', '普洱简瑞科技有限公司', '0', '1');
INSERT INTO `raw_member_department` VALUES ('3', '2', '综合部', '0', '1');
INSERT INTO `raw_member_department` VALUES ('4', '2', '工程部', '0', '1');
INSERT INTO `raw_member_department` VALUES ('5', '1', '设计部', '0', '1');
INSERT INTO `raw_member_department` VALUES ('6', '1', '工程部', '0', '1');
INSERT INTO `raw_member_department` VALUES ('7', '1', '总经理', '0', '1');
INSERT INTO `raw_member_department` VALUES ('8', '5', '设计部总监', '0', '1');
INSERT INTO `raw_member_department` VALUES ('9', '5', '设计师', '0', '1');
INSERT INTO `raw_member_department` VALUES ('10', '6', '工程经理', '0', '1');
INSERT INTO `raw_member_department` VALUES ('11', '6', '工程部员工', '0', '1');
INSERT INTO `raw_member_department` VALUES ('12', '2', '总经理', '0', '1');
INSERT INTO `raw_member_department` VALUES ('13', '4', '工程总监', '0', '1');
INSERT INTO `raw_member_department` VALUES ('14', '4', '工程部员工', '0', '1');
INSERT INTO `raw_member_department` VALUES ('15', '3', '综合部主任', '0', '1');
INSERT INTO `raw_member_department` VALUES ('16', '3', '综合部员工', '0', '1');

-- ----------------------------
-- Table structure for raw_projects
-- ----------------------------
DROP TABLE IF EXISTS `raw_projects`;
CREATE TABLE `raw_projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(64) DEFAULT NULL,
  `subject` varchar(120) DEFAULT NULL COMMENT '项目名称',
  `customer` varchar(200) DEFAULT NULL COMMENT '甲方',
  `customer_pm` varchar(50) DEFAULT NULL COMMENT '甲方负责人',
  `customer_mobile` varchar(22) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `level` int(11) DEFAULT 3,
  `dateline` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `pm_id` int(11) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='项目列表';

-- ----------------------------
-- Records of raw_projects
-- ----------------------------
INSERT INTO `raw_projects` VALUES ('2', 'bz5hSrdpFY2M7540', '中梁壹号院喷绘围挡', '重庆贵华建筑有限公司', '张经理', '', '26000.00', '3', '1538237485', '1538842285', '2', '&lt;p&gt;喷绘，&lt;span style=&quot;font-size: 1rem;&quot;&gt;彩钢瓦围挡&lt;/span&gt;&lt;/p&gt;', '8');
INSERT INTO `raw_projects` VALUES ('3', 'lXZrtw8hVNwu3089', '高家寨主席哆咪嗦钢琴教师 喷绘 pvc字', '高家寨主席', '高家寨主席', '13987951556', '1848.00', '3', '1538064000', '1539747755', '2', '&lt;p&gt;PVC字+亚克力面板&lt;br&gt;喷绘布&amp;nbsp;侧边以前创文位置 380x450&lt;/p&gt;', '5');
INSERT INTO `raw_projects` VALUES ('4', 'wJN3JInB0LjT4541', '普洱奇睿科技有限公司P2.5电子屏', '普洱奇睿科技有限公司', '李总', '', '32133.00', '3', '1539744377', '1540349177', '2', '', '5');
INSERT INTO `raw_projects` VALUES ('5', 'J9tG8FtLbGUj3160', '普洱奇睿科技有限公司门头安装制作', '普洱奇睿科技有限公司', '李总', '', '14000.00', '3', '1540882969', '1541487769', '2', '', '6');
INSERT INTO `raw_projects` VALUES ('6', 'IPBuTrP32ryZ3214', '文一工程 泰临酒店', '普洱文一工程有限公司', '李总', '', '0.00', '3', '1540883168', '1541487968', '2', '', '8');
INSERT INTO `raw_projects` VALUES ('7', 'HXzRW0hSGBcC8983', '悅安居法恩莎 pvc刻字', '美标卫浴', '谢队', '', '200.00', '3', '1541388932', '1541993732', '5', '&amp;lt;p&amp;gt;智能除臭&amp;amp;nbsp;&amp;lt;/p&amp;gt;', '8');
INSERT INTO `raw_projects` VALUES ('8', 'U3rLXZMAGkSi4400', '亿达汽车服务中心门头', '亿达汽车服务中心门头', '黄总', '15154830003', '800.00', '3', '1541574351', '1542179151', '5', '&amp;lt;p&amp;gt;门头喷绘&amp;amp;nbsp;单透贴&amp;lt;/p&amp;gt;', '4');

-- ----------------------------
-- Table structure for raw_projects_item
-- ----------------------------
DROP TABLE IF EXISTS `raw_projects_item`;
CREATE TABLE `raw_projects_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_title` varchar(120) DEFAULT NULL COMMENT '项目名称',
  `material` varchar(200) DEFAULT NULL COMMENT '甲方',
  `specif` varchar(100) DEFAULT NULL COMMENT '甲方负责人',
  `nums` tinyint(22) DEFAULT NULL,
  `area` decimal(10,2) DEFAULT NULL,
  `univalent` decimal(10,2) DEFAULT 3.00,
  `total` decimal(10,2) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目制作清单';

-- ----------------------------
-- Records of raw_projects_item
-- ----------------------------

-- ----------------------------
-- Table structure for raw_projects_report
-- ----------------------------
DROP TABLE IF EXISTS `raw_projects_report`;
CREATE TABLE `raw_projects_report` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_title` varchar(120) DEFAULT NULL COMMENT '项目名称',
  `material` varchar(200) DEFAULT NULL COMMENT '甲方',
  `specif` varchar(100) DEFAULT NULL COMMENT '甲方负责人',
  `nums` tinyint(22) DEFAULT NULL,
  `area` decimal(10,2) DEFAULT NULL,
  `univalent` decimal(10,2) DEFAULT 3.00,
  `total` decimal(10,2) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目报表';

-- ----------------------------
-- Records of raw_projects_report
-- ----------------------------

-- ----------------------------
-- Table structure for raw_quoted
-- ----------------------------
DROP TABLE IF EXISTS `raw_quoted`;
CREATE TABLE `raw_quoted` (
  `qid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) DEFAULT NULL,
  `customer` varchar(200) DEFAULT NULL,
  `customer_mobile` varchar(50) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `pm_id` int(11) DEFAULT NULL,
  `dateline` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of raw_quoted
-- ----------------------------

-- ----------------------------
-- Table structure for raw_quoted_item
-- ----------------------------
DROP TABLE IF EXISTS `raw_quoted_item`;
CREATE TABLE `raw_quoted_item` (
  `item_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `qid` int(11) DEFAULT NULL,
  `item` varchar(120) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `spec` varchar(50) DEFAULT NULL,
  `nums` int(11) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of raw_quoted_item
-- ----------------------------

-- ----------------------------
-- Table structure for raw_quoted_products
-- ----------------------------
DROP TABLE IF EXISTS `raw_quoted_products`;
CREATE TABLE `raw_quoted_products` (
  `pid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) DEFAULT NULL,
  `in_price` decimal(10,2) DEFAULT NULL,
  `out_price` decimal(10,2) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `supplier` varchar(120) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of raw_quoted_products
-- ----------------------------
INSERT INTO `raw_quoted_products` VALUES ('1', '520喷绘布', '6.00', '18.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('2', '530喷绘布', '6.00', '20.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('3', '网格布', '15.00', '55.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('4', '刀刮布', '26.00', '75.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('5', '室内写真', '10.00', '40.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('6', '室内PP纸', '10.00', '45.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('7', '室内灯片', '16.00', '55.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('8', '户外写真', '15.00', '55.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('9', '户外PP纸', '15.00', '55.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('10', '户外灯片', '20.00', '60.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('11', '白胶车贴', '16.00', '55.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('12', '黑胶车贴', '18.00', '65.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('13', '单透贴', '16.00', '60.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('14', '反光膜', '25.00', '75.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('15', '金彩格', '28.00', '80.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('16', '室内写真KT板', '20.00', '75.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('17', '户外写真KT板', '26.00', '85.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('18', '超卡板', '13.00', '45.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('19', '5mmPVC', '30.00', '60.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('20', '8mmPVC板', '50.00', '100.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('21', '10mmPVC板', '60.00', '120.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('22', '15mmPVC板', '90.00', '180.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('23', '镶边条 小', '3.00', '9.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('24', '镶边条 大', '6.00', '18.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('25', '镶边条 金色', '6.00', '18.00', '㎡', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('26', '布标 70cm', '3.00', '25.00', 'm', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('27', '布标 90cm', '4.00', '30.00', 'm', '赓达数码', '1');
INSERT INTO `raw_quoted_products` VALUES ('28', '钢架扣板', '50.00', '120.00', '㎡', '昆明', '1');

-- ----------------------------
-- Table structure for raw_working_hours
-- ----------------------------
DROP TABLE IF EXISTS `raw_working_hours`;
CREATE TABLE `raw_working_hours` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '记录人',
  `pid` int(11) DEFAULT NULL COMMENT '项目ID',
  `hours` decimal(10,0) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL COMMENT '工价',
  `dateline` int(11) DEFAULT NULL COMMENT '时间',
  `status` int(255) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of raw_working_hours
-- ----------------------------
