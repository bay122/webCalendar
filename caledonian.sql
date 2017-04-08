-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 31 Ekim 2013 saat 02:43:58
-- Sunucu sürümü: 5.1.30
-- PHP Sürümü: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Tablo yapısı: `caledonian_panel_notes`
--

CREATE TABLE IF NOT EXISTS `caledonian_panel_notes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `mynotes` text,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `note_icon` tinyint(2) NOT NULL DEFAULT '0',
  `ip_address` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
