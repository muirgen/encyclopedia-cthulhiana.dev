-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 15 Mai 2014 à 16:34
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `cthulhiana`
--

-- --------------------------------------------------------

--
-- Structure de la table `catalogues`
--

CREATE TABLE IF NOT EXISTS `catalogues` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `category` int(11) unsigned DEFAULT NULL,
  `id_person` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `category` (`category`),
  KEY `id_person` (`id_person`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `catalogues_alias`
--

CREATE TABLE IF NOT EXISTS `catalogues_alias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `id_catalogue` int(11) unsigned NOT NULL,
  `id_lang` int(11) unsigned DEFAULT NULL,
  `description` text NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_catalogue` (`id_catalogue`),
  KEY `id_lang` (`id_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `catalogues_categories`
--

CREATE TABLE IF NOT EXISTS `catalogues_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `catalogues_categories`
--

INSERT INTO `catalogues_categories` (`id`, `name`) VALUES
(4, 'Creatures'),
(5, 'Messenger'),
(1, 'The Elder Gods'),
(3, 'The Great Old Ones'),
(2, 'The Outer Gods');

-- --------------------------------------------------------

--
-- Structure de la table `catalogues_categories_trans`
--

CREATE TABLE IF NOT EXISTS `catalogues_categories_trans` (
  `id_category` int(11) unsigned NOT NULL,
  `id_lang` int(11) unsigned NOT NULL,
  `name_trans` varchar(250) NOT NULL,
  PRIMARY KEY (`id_category`,`id_lang`),
  KEY `name_trans` (`name_trans`),
  KEY `id_lang` (`id_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `catalogues_categories_trans`
--

INSERT INTO `catalogues_categories_trans` (`id_category`, `id_lang`, `name_trans`) VALUES
(4, 1, 'Créatures'),
(2, 1, 'Les Dieux Extérieurs'),
(1, 1, 'Les Dieux Très Anciens'),
(3, 1, 'Les Grands Anciens'),
(5, 1, 'Messager');

-- --------------------------------------------------------

--
-- Structure de la table `catalogues_oeuvres`
--

CREATE TABLE IF NOT EXISTS `catalogues_oeuvres` (
  `id_oeuvre` int(11) unsigned NOT NULL,
  `id_catalogue` int(11) unsigned NOT NULL,
  `first_appearance` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_oeuvre`,`id_catalogue`),
  KEY `id_catalogue` (`id_catalogue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lang`
--

CREATE TABLE IF NOT EXISTS `lang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `iso_code` char(2) NOT NULL,
  `language_code` char(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iso_code` (`iso_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `lang`
--

INSERT INTO `lang` (`id`, `name`, `iso_code`, `language_code`) VALUES
(1, 'Français (French)', 'fr', 'fr-fr'),
(2, 'English (United States)', 'us', 'en-us');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres`
--

CREATE TABLE IF NOT EXISTS `oeuvres` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `date` year(4) DEFAULT NULL,
  `format` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_alias`
--

CREATE TABLE IF NOT EXISTS `oeuvres_alias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `id_oeuvre` int(11) unsigned NOT NULL,
  `id_lang` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `id_oeuvre` (`id_oeuvre`),
  KEY `id_lang` (`id_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_persons`
--

CREATE TABLE IF NOT EXISTS `oeuvres_persons` (
  `id_oeuvre` int(11) unsigned NOT NULL,
  `id_person` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_oeuvre`,`id_person`),
  KEY `id_person` (`id_person`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres_publishing`
--

CREATE TABLE IF NOT EXISTS `oeuvres_publishing` (
  `id_oeuvre` int(11) unsigned NOT NULL,
  `id_publishing` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_oeuvre`,`id_publishing`),
  KEY `id_publishing` (`id_publishing`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `persons`
--

INSERT INTO `persons` (`id`, `name`) VALUES
(1, 'Lovecraft, Howard Philips');

-- --------------------------------------------------------

--
-- Structure de la table `persons_alias`
--

CREATE TABLE IF NOT EXISTS `persons_alias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `id_person` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_person` (`id_person`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `persons_alias`
--

INSERT INTO `persons_alias` (`id`, `name`, `id_person`) VALUES
(1, 'HPL', 1);

-- --------------------------------------------------------

--
-- Structure de la table `publishing`
--

CREATE TABLE IF NOT EXISTS `publishing` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `id_lang` int(11) unsigned DEFAULT NULL,
  `author` varchar(250) NOT NULL,
  `editor` varchar(250) NOT NULL,
  `classification` char(250) NOT NULL,
  `type_number` varchar(30) DEFAULT NULL,
  `ref_number` char(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`,`author`),
  KEY `id_lang` (`id_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `catalogues`
--
ALTER TABLE `catalogues`
  ADD CONSTRAINT `catalogues_ibfk_2` FOREIGN KEY (`category`) REFERENCES `catalogues_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `catalogues_ibfk_1` FOREIGN KEY (`id_person`) REFERENCES `persons` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `catalogues_alias`
--
ALTER TABLE `catalogues_alias`
  ADD CONSTRAINT `catalogues_alias_ibfk_1` FOREIGN KEY (`id_catalogue`) REFERENCES `catalogues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catalogues_alias_ibfk_3` FOREIGN KEY (`id_lang`) REFERENCES `lang` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `catalogues_categories_trans`
--
ALTER TABLE `catalogues_categories_trans`
  ADD CONSTRAINT `catalogues_categories_trans_ibfk_2` FOREIGN KEY (`id_lang`) REFERENCES `lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catalogues_categories_trans_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `catalogues_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `catalogues_oeuvres`
--
ALTER TABLE `catalogues_oeuvres`
  ADD CONSTRAINT `catalogues_oeuvres_ibfk_2` FOREIGN KEY (`id_catalogue`) REFERENCES `catalogues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catalogues_oeuvres_ibfk_1` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `oeuvres_alias`
--
ALTER TABLE `oeuvres_alias`
  ADD CONSTRAINT `oeuvres_alias_ibfk_2` FOREIGN KEY (`id_lang`) REFERENCES `lang` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `oeuvres_alias_ibfk_1` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `oeuvres_persons`
--
ALTER TABLE `oeuvres_persons`
  ADD CONSTRAINT `oeuvres_persons_ibfk_2` FOREIGN KEY (`id_person`) REFERENCES `persons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oeuvres_persons_ibfk_1` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `oeuvres_publishing`
--
ALTER TABLE `oeuvres_publishing`
  ADD CONSTRAINT `oeuvres_publishing_ibfk_2` FOREIGN KEY (`id_publishing`) REFERENCES `publishing` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oeuvres_publishing_ibfk_1` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `persons_alias`
--
ALTER TABLE `persons_alias`
  ADD CONSTRAINT `persons_alias_ibfk_1` FOREIGN KEY (`id_person`) REFERENCES `persons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `publishing`
--
ALTER TABLE `publishing`
  ADD CONSTRAINT `publishing_ibfk_1` FOREIGN KEY (`id_lang`) REFERENCES `lang` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
