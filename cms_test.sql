-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-07-24 05:44:58
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_test`
--

-- --------------------------------------------------------

--
-- 表的结构 `cms_admin`
--

CREATE TABLE `cms_admin` (
  `admin_id` mediumint(6) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `lastloginip` varchar(15) DEFAULT '0',
  `lastlogintime` int(10) UNSIGNED DEFAULT '0',
  `email` varchar(40) DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_admin`
--

INSERT INTO `cms_admin` (`admin_id`, `username`, `password`, `lastloginip`, `lastlogintime`, `email`, `realname`, `status`) VALUES
(1, 'admin', '4519c60c32493bf2704d1f7d656a0def', '0', 1461135752, '', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `cms_finance`
--

CREATE TABLE `cms_finance` (
  `finance_id` mediumint(6) NOT NULL,
  `finance_name` varchar(40) CHARACTER SET utf8 NOT NULL,
  `entry_people` varchar(40) CHARACTER SET utf8 NOT NULL,
  `begin_time` varchar(40) CHARACTER SET utf8 NOT NULL,
  `over_time` varchar(40) CHARACTER SET utf8 NOT NULL,
  `total_salary` float NOT NULL DEFAULT '0',
  `total_bonus` float NOT NULL DEFAULT '0',
  `total_bonus1` float NOT NULL DEFAULT '0',
  `total_bonus2` float DEFAULT '0',
  `total_bonus3` float NOT NULL DEFAULT '0',
  `total_pay` float DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `cms_finance_content`
--

CREATE TABLE `cms_finance_content` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `finance_id` mediumint(6) NOT NULL,
  `memberid` mediumint(6) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `salary` float NOT NULL DEFAULT '0',
  `bonus` float NOT NULL DEFAULT '0',
  `bonus1` float NOT NULL DEFAULT '0',
  `bonus2` float NOT NULL DEFAULT '0',
  `bonus3` float NOT NULL DEFAULT '0',
  `pay` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `cms_grade`
--

CREATE TABLE `cms_grade` (
  `id` mediumint(6) NOT NULL,
  `grade1` float NOT NULL,
  `grade2` float NOT NULL,
  `grade3` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `cms_member`
--

CREATE TABLE `cms_member` (
  `id` mediumint(6) UNSIGNED NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `memberid` mediumint(6) NOT NULL,
  `parentid` mediumint(6) DEFAULT NULL,
  `parent2id` mediumint(6) DEFAULT NULL,
  `parent3id` mediumint(6) DEFAULT NULL,
  `child1number` int(6) UNSIGNED NOT NULL DEFAULT '0',
  `child2number` int(6) UNSIGNED NOT NULL DEFAULT '0',
  `child3number` int(6) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `paynumber` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `qq` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `sex` tinyint(1) NOT NULL,
  `wechat` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `info` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `jointime` varchar(20) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_admin`
--
ALTER TABLE `cms_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `cms_finance`
--
ALTER TABLE `cms_finance`
  ADD PRIMARY KEY (`finance_id`);

--
-- Indexes for table `cms_finance_content`
--
ALTER TABLE `cms_finance_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_grade`
--
ALTER TABLE `cms_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_member`
--
ALTER TABLE `cms_member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `memberid` (`memberid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cms_admin`
--
ALTER TABLE `cms_admin`
  MODIFY `admin_id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `cms_finance`
--
ALTER TABLE `cms_finance`
  MODIFY `finance_id` mediumint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- 使用表AUTO_INCREMENT `cms_finance_content`
--
ALTER TABLE `cms_finance_content`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;
--
-- 使用表AUTO_INCREMENT `cms_grade`
--
ALTER TABLE `cms_grade`
  MODIFY `id` mediumint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `cms_member`
--
ALTER TABLE `cms_member`
  MODIFY `id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
