-- phpMyAdmin SQL Dump
-- version 3.4.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 07 2011 г., 12:38
-- Версия сервера: 5.5.17
-- Версия PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `clan`
--

-- --------------------------------------------------------

--
-- Структура таблицы `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account_id` int(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `server` varchar(2) NOT NULL,
  `reg` int(12) NOT NULL,
  `local` int(12) NOT NULL,
  `member_since` varchar(11) NOT NULL,
  `up` int(12) NOT NULL,
  `total` int(8) NOT NULL,
  `win` int(8) NOT NULL,
  `lose` int(8) NOT NULL,
  `alive` int(8) NOT NULL,
  `des` int(8) NOT NULL,
  `spot` int(8) NOT NULL,
  `accure` int(3) NOT NULL,
  `dmg` int(15) NOT NULL,
  `cap` int(12) NOT NULL,
  `def` int(12) NOT NULL,
  `exp` int(15) NOT NULL,
  `averag_exp` int(4) NOT NULL,
  `max_exp` int(4) NOT NULL,
  `gr_v` int(12) NOT NULL,
  `gr_p` int(12) NOT NULL,
  `wb_v` int(12) NOT NULL,
  `wb_p` int(12) NOT NULL,
  `eb_v` int(12) NOT NULL,
  `eb_p` int(12) NOT NULL,
  `win_v` int(12) NOT NULL,
  `win_p` int(12) NOT NULL,
  `gpl_v` int(12) NOT NULL,
  `gpl_p` int(12) NOT NULL,
  `cpt_p` int(12) NOT NULL,
  `cpt_v` int(12) NOT NULL,
  `dmg_p` int(12) NOT NULL,
  `dmg_v` int(12) NOT NULL,
  `dpt_p` int(12) NOT NULL,
  `dpt_v` int(12) NOT NULL,
  `frg_p` int(12) NOT NULL,
  `frg_v` int(12) NOT NULL,
  `spt_p` int(12) NOT NULL,
  `spt_v` int(12) NOT NULL,
  `exp_p` int(12) NOT NULL,
  `exp_v` int(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `server` (`server`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tanks`
--

CREATE TABLE IF NOT EXISTS `tanks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tank` varchar(40) NOT NULL,
  `nation` varchar(20) NOT NULL,
  `lvl` varchar(4) NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
