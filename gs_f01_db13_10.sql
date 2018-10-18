-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018 年 10 月 18 日 16:35
-- サーバのバージョン： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gs_f01_db13_10`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `area_table`
--

CREATE TABLE IF NOT EXISTS `area_table` (
`id` int(128) NOT NULL,
  `area` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `miniarea` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `user` int(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `area_table`
--

INSERT INTO `area_table` (`id`, `area`, `miniarea`, `url`, `user`) VALUES
(1, '名古屋', '名駅・庄内通周辺', 'https://beauty.hotpepper.jp/svcSC/macCA/salon/sacX096/', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `list_table`
--

CREATE TABLE IF NOT EXISTS `list_table` (
`id` int(255) NOT NULL,
  `shop` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `adress` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `area` int(128) NOT NULL,
  `url` int(128) NOT NULL,
  `link` int(12) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table`
--

CREATE TABLE IF NOT EXISTS `user_table` (
`id` int(12) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `pass` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area_table`
--
ALTER TABLE `area_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_table`
--
ALTER TABLE `list_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area_table`
--
ALTER TABLE `area_table`
MODIFY `id` int(128) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `list_table`
--
ALTER TABLE `list_table`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
