-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 24 Juin 2015 à 15:38
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
  `idx_name` varchar(250) NOT NULL,
  `category` int(11) unsigned DEFAULT NULL,
  `id_person` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `id_person` (`id_person`),
  KEY `idx_name` (`idx_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `catalogues`
--

INSERT INTO `catalogues` (`id`, `name`, `idx_name`, `category`, `id_person`) VALUES
(1, 'Dagon', 'Dagon', 4, 1),
(2, 'Nyarlathotep', 'Nyarlathotep', 5, 1),
(3, 'Innsmouth', 'Innsmouth', 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `catalogues_alias`
--

CREATE TABLE IF NOT EXISTS `catalogues_alias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `idx_name` varchar(250) NOT NULL,
  `id_catalogue` int(11) unsigned NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_catalogue` (`id_catalogue`),
  KEY `idx_name` (`idx_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `catalogues_alias`
--

INSERT INTO `catalogues_alias` (`id`, `name`, `idx_name`, `id_catalogue`, `note`) VALUES
(1, 'The Black Pharaoh', 'Black Pharaoh, The', 2, '<p>Referenced in "The Dream Quest Of unknown Kadath", Lovecraft Howard Philips.</p>');

-- --------------------------------------------------------

--
-- Structure de la table `catalogues_alias_trans`
--

CREATE TABLE IF NOT EXISTS `catalogues_alias_trans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_alias` int(11) unsigned NOT NULL,
  `iso_code` char(2) NOT NULL,
  `name_trans` varchar(250) NOT NULL,
  `idx_name_trans` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_alias` (`id_alias`,`iso_code`),
  KEY `idx_name_trans` (`idx_name_trans`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `catalogues_alias_trans`
--

INSERT INTO `catalogues_alias_trans` (`id`, `id_alias`, `iso_code`, `name_trans`, `idx_name_trans`) VALUES
(1, 1, 'de', 'Der Schwartze Pharao', 'Schwartze Pharao, Der'),
(2, 1, 'fr', 'Le pharaon noir', 'Pharaon noir, Le'),
(3, 1, 'ru', 'ðºðÁÐÇð¢Ðïð╣ Ðäð░ÐÇð░ð¥ð¢', 'ðºðÁÐÇð¢Ðïð╣ Ðäð░ÐÇð░ð¥ð¢');

-- --------------------------------------------------------

--
-- Structure de la table `catalogues_articles`
--

CREATE TABLE IF NOT EXISTS `catalogues_articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_catalogue` int(11) unsigned NOT NULL,
  `article_content` text,
  `iso_code` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `catalogues_articles`
--

INSERT INTO `catalogues_articles` (`id`, `id_catalogue`, `article_content`, `iso_code`) VALUES
(1, 2, '<p>And I''ll make a test in english just to be sure about the process</p>', 'en');

-- --------------------------------------------------------

--
-- Structure de la table `catalogues_categories`
--

CREATE TABLE IF NOT EXISTS `catalogues_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `catalogues_categories`
--

INSERT INTO `catalogues_categories` (`id`, `name`) VALUES
(4, 'Creatures'),
(5, 'Messenger'),
(6, 'Place'),
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
(4, 2, 'Creatures'),
(4, 1, 'Cr├®atures'),
(2, 1, 'Les Dieux Ext├®rieurs'),
(1, 1, 'Les Dieux Tr├¿s Anciens'),
(3, 1, 'Les Grands Anciens'),
(6, 1, 'Lieu'),
(5, 1, 'Messager'),
(5, 2, 'Messenger'),
(6, 2, 'Place'),
(1, 2, 'The Elder Gods'),
(3, 2, 'The Great Old Ones'),
(2, 2, 'The Outer Gods');

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

--
-- Contenu de la table `catalogues_oeuvres`
--

INSERT INTO `catalogues_oeuvres` (`id_oeuvre`, `id_catalogue`, `first_appearance`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `catalogues_related`
--

CREATE TABLE IF NOT EXISTS `catalogues_related` (
  `id_catalogue` int(11) unsigned NOT NULL,
  `id_related` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_catalogue`,`id_related`),
  KEY `id_related` (`id_related`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `catalogues_related`
--

INSERT INTO `catalogues_related` (`id_catalogue`, `id_related`) VALUES
(3, 1),
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `catalogues_trans`
--

CREATE TABLE IF NOT EXISTS `catalogues_trans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_catalogue` int(11) unsigned NOT NULL,
  `iso_code` char(2) NOT NULL,
  `name_trans` varchar(250) NOT NULL,
  `idx_name_trans` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_catalogue` (`id_catalogue`,`iso_code`),
  KEY `idx_name_trans` (`idx_name_trans`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `catalogues_trans`
--

INSERT INTO `catalogues_trans` (`id`, `id_catalogue`, `iso_code`, `name_trans`, `idx_name_trans`) VALUES
(1, 2, 'ru', 'ðØÐîÐÅÐÇð╗ð░ÐéÐàð¥ÐéðÁð┐', 'ðØÐîÐÅÐÇð╗ð░ÐéÐàð¥ÐéðÁð┐');

-- --------------------------------------------------------

--
-- Structure de la table `lang`
--

CREATE TABLE IF NOT EXISTS `lang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `iso_code` char(2) NOT NULL,
  `language_code` char(5) NOT NULL,
  `public` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `iso_code` (`iso_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `lang`
--

INSERT INTO `lang` (`id`, `name`, `iso_code`, `language_code`, `public`) VALUES
(1, 'Fran├ºais', 'fr', 'fr-fr', 1),
(2, 'English', 'en', 'en-us', 1),
(3, 'Deutsch', 'de', 'de-de', 0),
(4, 'Espa├▒ol', 'es', 'es-es', 0),
(5, 'ÐÇÐâÐüÐüð║ð©ð╣', 'ru', 'ru-ru', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `oeuvres`
--

INSERT INTO `oeuvres` (`id`, `name`, `date`, `format`) VALUES
(1, 'Dagon', 1917, 'Short Story'),
(2, 'Dagon', 2001, 'Movie');

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

--
-- Contenu de la table `oeuvres_persons`
--

INSERT INTO `oeuvres_persons` (`id_oeuvre`, `id_person`) VALUES
(1, 1);

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

--
-- Contenu de la table `oeuvres_publishing`
--

INSERT INTO `oeuvres_publishing` (`id_oeuvre`, `id_publishing`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `persons`
--

INSERT INTO `persons` (`id`, `name`) VALUES
(2, 'HOWARD, Robert E.'),
(1, 'LOVECRAFT, Howard Philips');

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
  `subtitle` varchar(250) DEFAULT NULL,
  `id_lang` int(11) unsigned DEFAULT NULL,
  `author` varchar(250) NOT NULL,
  `collection` varchar(250) DEFAULT NULL,
  `collection_number` varchar(100) DEFAULT NULL,
  `publisher` varchar(250) DEFAULT NULL,
  `publish_date` varchar(50) DEFAULT NULL,
  `publish_year` year(4) DEFAULT NULL,
  `classification` char(250) NOT NULL,
  `type_number` varchar(30) DEFAULT NULL,
  `ref_number` char(250) DEFAULT NULL,
  `comments` text,
  PRIMARY KEY (`id`),
  KEY `title` (`title`,`author`),
  KEY `id_lang` (`id_lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `publishing`
--

INSERT INTO `publishing` (`id`, `title`, `subtitle`, `id_lang`, `author`, `collection`, `collection_number`, `publisher`, `publish_date`, `publish_year`, `classification`, `type_number`, `ref_number`, `comments`) VALUES
(1, 'Oeuvres de H.P. Lovecraft - Tome 1', 'Les mythes de Cthulhu ; l├®gendes du mythe de Cthulhu ; premiers contes ; l''art d''├®crire selon Lovecraft', 1, 'Lovecraft H.P / Direction : Francis Lacassin', 'Bouquins', 'Tome 1', 'Robert Laffont', 'F├®vrier', 2010, 'Book', 'ISBN', '2221115880', NULL),
(2, 'Dagon', 'Et autres r├®cits de terreur', 1, 'Lovecraft H.P.', NULL, NULL, 'Pierre Belfond', '20. octobre', 1969, 'Book', NULL, NULL, 'Pr├®face : Fran├ºois Truchaud.\r\nTraduction : Paul P├®rez.\r\n\r\nAutres ├®dition :\r\nJ''ai Lu, 1972.');

-- --------------------------------------------------------

--
-- Structure de la table `tf_language`
--

CREATE TABLE IF NOT EXISTS `tf_language` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `str_language` varchar(50) NOT NULL,
  `str_iso_code` char(2) NOT NULL,
  `str_language_code` char(5) NOT NULL,
  `bol_public` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `str_iso_code` (`str_iso_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Functional table managing languages available for encyclopedia and translation' AUTO_INCREMENT=5 ;

--
-- Contenu de la table `tf_language`
--

INSERT INTO `tf_language` (`id`, `str_language`, `str_iso_code`, `str_language_code`, `bol_public`) VALUES
(1, 'English', 'en', 'en-us', 1),
(2, 'Français', 'fr', 'fr-fr', 1),
(3, 'Pусский', 'ru', 'ru-ru', 0),
(4, 'Deutsch', 'de', 'de-de', 0);

-- --------------------------------------------------------

--
-- Structure de la table `tj_lexicon_related`
--

CREATE TABLE IF NOT EXISTS `tj_lexicon_related` (
  `fk_lexicon` int(11) unsigned NOT NULL COMMENT 'foreign key to lexicon id primary key',
  `fk_related` int(11) unsigned NOT NULL COMMENT 'foreign key to lexicon id primary key',
  PRIMARY KEY (`fk_lexicon`,`fk_related`),
  KEY `fk_related` (`fk_related`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='join table storing lexicon terms related between them';

-- --------------------------------------------------------

--
-- Structure de la table `tr_lexicon`
--

CREATE TABLE IF NOT EXISTS `tr_lexicon` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_lexicon_category` int(11) unsigned DEFAULT NULL,
  `str_term` varchar(250) NOT NULL COMMENT 'default term',
  `idx_term` varchar(250) NOT NULL COMMENT 'indexed term',
  PRIMARY KEY (`id`),
  KEY `fk_lexicon_category` (`fk_lexicon_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Reference table storing terms for the lexicon' AUTO_INCREMENT=5 ;

--
-- Contenu de la table `tr_lexicon`
--

INSERT INTO `tr_lexicon` (`id`, `fk_lexicon_category`, `str_term`, `idx_term`) VALUES
(1, 7, 'Arkham', 'Arkham'),
(2, 5, 'Cultes des Goules', 'Cultes des Goules'),
(3, 5, 'Unaussprechlichen Kulten', 'Unaussprechlichen Kulten'),
(4, 3, 'Nyarlathotep', 'Nyarlathotep');

--
-- Déclencheurs `tr_lexicon`
--
DROP TRIGGER IF EXISTS `After_delete_tr_lexicon`;
DELIMITER //
CREATE TRIGGER `After_delete_tr_lexicon` AFTER DELETE ON `tr_lexicon`
 FOR EACH ROW DELETE FROM tr_lexicon_index WHERE fk_entity = OLD.id AND str_entity = "Lexicon"
//
DELIMITER ;
DROP TRIGGER IF EXISTS `After_insert_tr_lexicon`;
DELIMITER //
CREATE TRIGGER `After_insert_tr_lexicon` AFTER INSERT ON `tr_lexicon`
 FOR EACH ROW INSERT INTO 
tr_lexicon_index (
fk_entity, 
str_entity, 
str_idx_term
) 
VALUES (
NEW.id,
"Lexicon",
NEW.idx_term
)
//
DELIMITER ;
DROP TRIGGER IF EXISTS `After_update_tr_lexicon`;
DELIMITER //
CREATE TRIGGER `After_update_tr_lexicon` AFTER UPDATE ON `tr_lexicon`
 FOR EACH ROW UPDATE tr_lexicon_index
SET fk_entity = NEW.id,
str_idx_term = NEW.idx_term
WHERE fk_entity = OLD.id AND str_entity = "Lexicon"
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `tr_lexicon_alias`
--

CREATE TABLE IF NOT EXISTS `tr_lexicon_alias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_lexicon` int(11) unsigned NOT NULL,
  `str_term_alias` varchar(250) NOT NULL COMMENT 'default alias term',
  `idx_term_alias` varchar(250) NOT NULL COMMENT 'indexed alias term',
  PRIMARY KEY (`id`),
  KEY `fk_lexicon` (`fk_lexicon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Reference table storing alias for lexicon terms' AUTO_INCREMENT=1 ;

--
-- Déclencheurs `tr_lexicon_alias`
--
DROP TRIGGER IF EXISTS `After_delete_tr_lexicon_alias`;
DELIMITER //
CREATE TRIGGER `After_delete_tr_lexicon_alias` AFTER DELETE ON `tr_lexicon_alias`
 FOR EACH ROW DELETE FROM tr_lexicon_index WHERE fk_entity = OLD.id AND str_entity = "LexiconAlias"
//
DELIMITER ;
DROP TRIGGER IF EXISTS `After_insert_tr_lexicon_alias`;
DELIMITER //
CREATE TRIGGER `After_insert_tr_lexicon_alias` AFTER INSERT ON `tr_lexicon_alias`
 FOR EACH ROW INSERT INTO 
tr_lexicon_index (
fk_entity, 
str_entity, 
str_idx_term
) 
VALUES (
NEW.fk_lexicon,
"LexiconAlias",
NEW.idx_term_alias
)
//
DELIMITER ;
DROP TRIGGER IF EXISTS `After_update_tr_lexicon_alias`;
DELIMITER //
CREATE TRIGGER `After_update_tr_lexicon_alias` AFTER UPDATE ON `tr_lexicon_alias`
 FOR EACH ROW UPDATE tr_lexicon_index
SET fk_entity = NEW.fk_lexicon,
str_idx_term = NEW.idx_term_alias
WHERE fk_entity = OLD.fk_lexicon AND str_entity = "LexiconAlias"
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `tr_lexicon_category`
--

CREATE TABLE IF NOT EXISTS `tr_lexicon_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `str_category` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Reference table storing for lexicon category' AUTO_INCREMENT=9 ;

--
-- Contenu de la table `tr_lexicon_category`
--

INSERT INTO `tr_lexicon_category` (`id`, `str_category`) VALUES
(1, 'The Elder Gods'),
(2, 'The Great Old Ones'),
(3, 'The Outer Gods'),
(4, 'The Great Ones'),
(5, 'Books'),
(6, 'Characters'),
(7, 'Places'),
(8, 'Creatures');

-- --------------------------------------------------------

--
-- Structure de la table `tr_lexicon_definition`
--

CREATE TABLE IF NOT EXISTS `tr_lexicon_definition` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_lexicon` int(11) unsigned NOT NULL,
  `str_iso_code` char(2) NOT NULL,
  `text_definition` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lexicon` (`fk_lexicon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Reference table storing definition for lexicon terms' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tr_lexicon_index`
--

CREATE TABLE IF NOT EXISTS `tr_lexicon_index` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_entity` int(11) unsigned NOT NULL,
  `str_entity` varchar(50) NOT NULL,
  `str_idx_term` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `str_iso_code` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `tr_lexicon_index`
--

INSERT INTO `tr_lexicon_index` (`id`, `fk_entity`, `str_entity`, `str_idx_term`, `str_iso_code`) VALUES
(1, 1, 'Lexicon', 'Arkham', NULL),
(2, 2, 'Lexicon', 'Cultes des Goules', NULL),
(3, 3, 'Lexicon', 'Unaussprechlichen Kulten', NULL),
(4, 4, 'Lexicon', 'Nyarlathotep', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tr_reference`
--

CREATE TABLE IF NOT EXISTS `tr_reference` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `str_dft_title` varchar(250) NOT NULL COMMENT 'default title',
  `str_idx_title` varchar(250) NOT NULL COMMENT 'indexed title',
  `dte_release` year(4) DEFAULT NULL COMMENT 'date year',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Reference table storing referenced source for lexicon terms' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tt_lexicon`
--

CREATE TABLE IF NOT EXISTS `tt_lexicon` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_lexicon` int(11) unsigned NOT NULL COMMENT 'Foreign key to lexicon id primary key',
  `str_iso_code` char(2) NOT NULL,
  `str_trans_term` varchar(250) NOT NULL COMMENT 'default translation term',
  PRIMARY KEY (`id`),
  KEY `fk_lexicon` (`fk_lexicon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Translation Table storing translation for lexion term' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tt_lexicon_alias`
--

CREATE TABLE IF NOT EXISTS `tt_lexicon_alias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_lexicon_alias` int(11) unsigned NOT NULL,
  `fk_lexicon` int(11) unsigned NOT NULL,
  `str_iso_code` char(2) NOT NULL,
  `str_trans_term_alias` varchar(250) NOT NULL COMMENT 'default translation',
  PRIMARY KEY (`id`),
  KEY `fk_lexicon_alias` (`fk_lexicon_alias`),
  KEY `fk_lexicon` (`fk_lexicon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Translation Table storing translation for lexion term alias' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tt_lexicon_category`
--

CREATE TABLE IF NOT EXISTS `tt_lexicon_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_lexicon_category` int(11) unsigned NOT NULL,
  `fk_language` int(11) unsigned NOT NULL,
  `str_trans_category` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lexicon_category` (`fk_lexicon_category`),
  KEY `fk_language` (`fk_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Translation Table for lexicon category' AUTO_INCREMENT=17 ;

--
-- Contenu de la table `tt_lexicon_category`
--

INSERT INTO `tt_lexicon_category` (`id`, `fk_lexicon_category`, `fk_language`, `str_trans_category`) VALUES
(1, 1, 2, 'Les Anciens Dieux'),
(2, 2, 2, 'Les Grands Anciens'),
(3, 3, 2, 'Les Dieux Extérieurs'),
(4, 4, 2, 'Divinités mineurs'),
(5, 5, 2, 'Livres Impies'),
(6, 6, 2, 'Personnages'),
(7, 7, 2, 'Lieux'),
(8, 8, 2, 'Créatures'),
(9, 1, 1, 'The Elder Gods'),
(10, 2, 1, 'The Great Old Ones'),
(11, 3, 1, 'The Outer Gods'),
(12, 4, 1, 'The Great Ones'),
(13, 5, 1, 'Books'),
(14, 6, 1, 'Characters'),
(15, 7, 1, 'Places'),
(16, 8, 1, 'Creatures');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `catalogues`
--
ALTER TABLE `catalogues`
  ADD CONSTRAINT `catalogues_ibfk_1` FOREIGN KEY (`id_person`) REFERENCES `persons` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `catalogues_ibfk_2` FOREIGN KEY (`category`) REFERENCES `catalogues_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `catalogues_alias`
--
ALTER TABLE `catalogues_alias`
  ADD CONSTRAINT `catalogues_alias_ibfk_1` FOREIGN KEY (`id_catalogue`) REFERENCES `catalogues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `catalogues_alias_trans`
--
ALTER TABLE `catalogues_alias_trans`
  ADD CONSTRAINT `catalogues_alias_trans_ibfk_1` FOREIGN KEY (`id_alias`) REFERENCES `catalogues_alias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `catalogues_categories_trans`
--
ALTER TABLE `catalogues_categories_trans`
  ADD CONSTRAINT `catalogues_categories_trans_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `catalogues_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catalogues_categories_trans_ibfk_2` FOREIGN KEY (`id_lang`) REFERENCES `lang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `catalogues_oeuvres`
--
ALTER TABLE `catalogues_oeuvres`
  ADD CONSTRAINT `catalogues_oeuvres_ibfk_1` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catalogues_oeuvres_ibfk_2` FOREIGN KEY (`id_catalogue`) REFERENCES `catalogues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `catalogues_related`
--
ALTER TABLE `catalogues_related`
  ADD CONSTRAINT `catalogues_related_ibfk_1` FOREIGN KEY (`id_catalogue`) REFERENCES `catalogues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catalogues_related_ibfk_2` FOREIGN KEY (`id_related`) REFERENCES `catalogues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `catalogues_trans`
--
ALTER TABLE `catalogues_trans`
  ADD CONSTRAINT `catalogues_trans_ibfk_1` FOREIGN KEY (`id_catalogue`) REFERENCES `catalogues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `oeuvres_alias`
--
ALTER TABLE `oeuvres_alias`
  ADD CONSTRAINT `oeuvres_alias_ibfk_1` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oeuvres_alias_ibfk_2` FOREIGN KEY (`id_lang`) REFERENCES `lang` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `oeuvres_persons`
--
ALTER TABLE `oeuvres_persons`
  ADD CONSTRAINT `oeuvres_persons_ibfk_1` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oeuvres_persons_ibfk_2` FOREIGN KEY (`id_person`) REFERENCES `persons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `oeuvres_publishing`
--
ALTER TABLE `oeuvres_publishing`
  ADD CONSTRAINT `oeuvres_publishing_ibfk_1` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oeuvres_publishing_ibfk_2` FOREIGN KEY (`id_publishing`) REFERENCES `publishing` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Contraintes pour la table `tj_lexicon_related`
--
ALTER TABLE `tj_lexicon_related`
  ADD CONSTRAINT `tj_lexicon_related_ibfk_1` FOREIGN KEY (`fk_lexicon`) REFERENCES `tr_lexicon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_lexicon_related_ibfk_2` FOREIGN KEY (`fk_related`) REFERENCES `tr_lexicon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tr_lexicon`
--
ALTER TABLE `tr_lexicon`
  ADD CONSTRAINT `tr_lexicon_ibfk_2` FOREIGN KEY (`fk_lexicon_category`) REFERENCES `tr_lexicon_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `tr_lexicon_alias`
--
ALTER TABLE `tr_lexicon_alias`
  ADD CONSTRAINT `tr_lexicon_alias_ibfk_1` FOREIGN KEY (`fk_lexicon`) REFERENCES `tr_lexicon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tr_lexicon_definition`
--
ALTER TABLE `tr_lexicon_definition`
  ADD CONSTRAINT `tr_lexicon_definition_ibfk_1` FOREIGN KEY (`fk_lexicon`) REFERENCES `tr_lexicon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tt_lexicon_alias`
--
ALTER TABLE `tt_lexicon_alias`
  ADD CONSTRAINT `tt_lexicon_alias_ibfk_2` FOREIGN KEY (`fk_lexicon`) REFERENCES `tr_lexicon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tt_lexicon_alias_ibfk_1` FOREIGN KEY (`fk_lexicon_alias`) REFERENCES `tr_lexicon_alias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tt_lexicon_category`
--
ALTER TABLE `tt_lexicon_category`
  ADD CONSTRAINT `tt_lexicon_category_ibfk_1` FOREIGN KEY (`fk_lexicon_category`) REFERENCES `tr_lexicon_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tt_lexicon_category_ibfk_2` FOREIGN KEY (`fk_language`) REFERENCES `tf_language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
