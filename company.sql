-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- 主机： localhost:3306
-- 生成日期： 2020-07-22 15:06:30
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `company`
--
CREATE DATABASE IF NOT EXISTS `company` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `company`;

-- --------------------------------------------------------

--
-- 表的结构 `pre_cate`
--

CREATE TABLE `pre_cate` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '主键',
  `name` varchar(255) NOT NULL COMMENT '分类名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类表';

--
-- 转存表中的数据 `pre_cate`
--

INSERT INTO `pre_cate` (`id`, `name`) VALUES
(1, '餐饮'),
(2, '手机'),
(3, '电脑'),
(4, '建材'),
(5, '家居');

-- --------------------------------------------------------

--
-- 表的结构 `pre_person`
--

CREATE TABLE `pre_person` (
  `id` int(11) NOT NULL COMMENT '主键',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `phone` varchar(150) NOT NULL COMMENT '手机号码',
  `content` text NOT NULL COMMENT '内容',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `cateid` int(11) UNSIGNED NOT NULL COMMENT '分类外键'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='通讯录表';

--
-- 转存表中的数据 `pre_person`
--

INSERT INTO `pre_person` (`id`, `username`, `phone`, `content`, `createtime`, `cateid`) VALUES
(1, '张三123', '13512566778', '奥术大师多', 1595387220, 1),
(2, '张三1', '13512566778', 'wqdasdasd', 1595387454, 2),
(3, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(4, 'adsdas', '13512677889', 'asdasdasd', 1595390129, 4),
(5, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(6, '李四123aa', '13512544667', 'asdasdasdas', 1595390062, 5),
(7, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(8, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(9, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(10, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(11, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(12, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(13, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(14, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(15, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(16, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(17, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(18, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(19, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(20, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(21, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(22, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(23, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(24, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(25, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(26, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(27, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(28, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(29, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(30, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(31, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(32, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(33, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(34, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(35, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(36, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(37, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(38, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(39, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(40, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(41, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(42, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(43, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(44, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(45, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(46, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(47, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(48, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(49, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(50, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(51, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(52, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(53, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(54, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(55, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(56, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(57, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(58, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(59, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(60, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(61, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(62, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(63, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(64, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(65, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(66, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(67, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(68, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(69, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(70, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(71, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(72, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(73, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(74, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(75, '李四', '13512544667', 'asdasdasdas', 1595390062, 3),
(76, '李四', '13512544667', 'asdasdasdas', 1595390062, 3);

--
-- 转储表的索引
--

--
-- 表的索引 `pre_cate`
--
ALTER TABLE `pre_cate`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `pre_person`
--
ALTER TABLE `pre_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key_cateid` (`cateid`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `pre_cate`
--
ALTER TABLE `pre_cate`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `pre_person`
--
ALTER TABLE `pre_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=77;

--
-- 限制导出的表
--

--
-- 限制表 `pre_person`
--
ALTER TABLE `pre_person`
  ADD CONSTRAINT `fk_cateid` FOREIGN KEY (`cateid`) REFERENCES `pre_cate` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
