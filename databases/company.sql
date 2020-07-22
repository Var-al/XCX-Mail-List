-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- 主机： localhost:3306
-- 生成日期： 2020-07-21 15:02:46
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
(1, '餐饮');

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `pre_person`
--
ALTER TABLE `pre_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键', AUTO_INCREMENT=2;

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
