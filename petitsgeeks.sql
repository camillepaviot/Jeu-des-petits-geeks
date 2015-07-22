-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 22 Juillet 2015 à 16:05
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `petitsgeeks`
--

-- --------------------------------------------------------

--
-- Structure de la table `couleursgeek`
--

CREATE TABLE IF NOT EXISTS `couleursgeek` (
  `couleur_id` int(11) NOT NULL AUTO_INCREMENT,
  `couleur_lettre` varchar(255) NOT NULL,
  `couleur_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`couleur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `couleursgeek`
--

INSERT INTO `couleursgeek` (`couleur_id`, `couleur_lettre`, `couleur_desc`) VALUES
(1, 'B', 'Petit geek bleu'),
(2, 'J', 'Petit geek jaune'),
(3, 'V', 'Petit geek vert'),
(4, 'R', 'Petit geek rouge');

-- --------------------------------------------------------

--
-- Structure de la table `couleursuser`
--

CREATE TABLE IF NOT EXISTS `couleursuser` (
  `couleur_id` int(11) NOT NULL AUTO_INCREMENT,
  `couleur_hexa` varchar(255) NOT NULL,
  PRIMARY KEY (`couleur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `couleursuser`
--

INSERT INTO `couleursuser` (`couleur_id`, `couleur_hexa`) VALUES
(1, '#48b9c7'),
(2, '#fcb515'),
(3, '#57bc74'),
(4, '#ee3124');

-- --------------------------------------------------------

--
-- Structure de la table `geeks`
--

CREATE TABLE IF NOT EXISTS `geeks` (
  `geek_id` int(11) NOT NULL AUTO_INCREMENT,
  `geek_couleur` varchar(255) NOT NULL,
  `geek_partie` int(11) NOT NULL,
  `geek_user` int(11) NOT NULL,
  `geek_score` int(11) NOT NULL,
  `geek_ordi` int(11) NOT NULL,
  PRIMARY KEY (`geek_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- Contenu de la table `geeks`
--

INSERT INTO `geeks` (`geek_id`, `geek_couleur`, `geek_partie`, `geek_user`, `geek_score`, `geek_ordi`) VALUES
(3, '1', 3, 3, 0, 1),
(4, '2', 3, 3, 0, 0),
(5, '3', 3, 3, 0, 1),
(6, '4', 3, 3, 0, 1),
(7, '1', 4, 3, 0, 1),
(8, '2', 4, 3, 0, 1),
(9, '3', 4, 3, 0, 0),
(10, '4', 4, 3, 0, 1),
(11, '1', 5, 3, 0, 1),
(12, '2', 5, 3, 0, 0),
(13, '3', 5, 3, 0, 1),
(14, '4', 5, 3, 10, 1),
(15, '1', 6, 4, 0, 1),
(16, '2', 6, 4, 0, 1),
(17, '3', 6, 4, 10, 1),
(18, '4', 6, 4, 0, 0),
(19, '1', 7, 4, 0, 1),
(20, '2', 7, 4, 0, 1),
(21, '3', 7, 4, 0, 0),
(22, '4', 7, 4, 10, 1),
(23, '1', 8, 4, 0, 1),
(24, '2', 8, 4, 0, 0),
(25, '3', 8, 4, 0, 1),
(26, '4', 8, 4, 0, 1),
(27, '1', 9, 4, 0, 0),
(28, '2', 9, 4, 0, 1),
(29, '3', 9, 4, 0, 1),
(30, '4', 9, 4, 0, 1),
(31, '1', 10, 4, 0, 1),
(32, '2', 10, 4, 0, 1),
(33, '3', 10, 4, 0, 1),
(34, '4', 10, 4, 10, 0),
(35, '1', 11, 4, 0, 1),
(36, '2', 11, 4, 10, 0),
(37, '3', 11, 4, 0, 1),
(38, '4', 11, 4, 0, 1),
(39, '1', 12, 5, 0, 0),
(40, '2', 12, 5, 0, 1),
(41, '3', 12, 5, 0, 1),
(42, '4', 12, 5, 0, 1),
(43, '1', 13, 5, 0, 1),
(44, '2', 13, 5, 0, 1),
(45, '3', 13, 5, 10, 0),
(46, '4', 13, 5, 0, 1),
(47, '1', 14, 5, 0, 1),
(48, '2', 14, 5, 0, 1),
(49, '3', 14, 5, 0, 1),
(50, '4', 14, 5, 0, 0),
(51, '1', 15, 5, 10, 1),
(52, '2', 15, 5, 0, 0),
(53, '3', 15, 5, 0, 1),
(54, '4', 15, 5, 0, 1),
(55, '1', 16, 5, 0, 1),
(56, '2', 16, 5, 0, 1),
(57, '3', 16, 5, 10, 0),
(58, '4', 16, 5, 0, 1),
(59, '1', 17, 5, 0, 1),
(60, '2', 17, 5, 10, 0),
(61, '3', 17, 5, 0, 1),
(62, '4', 17, 5, 0, 1),
(63, '1', 18, 5, 0, 1),
(64, '2', 18, 5, 0, 1),
(65, '3', 18, 5, 10, 0),
(66, '4', 18, 5, 0, 1),
(67, '1', 19, 5, 0, 1),
(68, '2', 19, 5, 0, 1),
(69, '3', 19, 5, 10, 1),
(70, '4', 19, 5, 0, 0),
(71, '1', 20, 6, 0, 1),
(72, '2', 20, 6, 0, 1),
(73, '3', 20, 6, 10, 0),
(74, '4', 20, 6, 0, 1),
(75, '1', 21, 6, 0, 1),
(76, '2', 21, 6, 0, 0),
(77, '3', 21, 6, 0, 1),
(78, '4', 21, 6, 10, 1),
(79, '1', 22, 6, 0, 1),
(80, '2', 22, 6, 0, 1),
(81, '3', 22, 6, 0, 1),
(82, '4', 22, 6, 0, 0),
(83, '1', 23, 7, 0, 1),
(84, '2', 23, 7, 10, 0),
(85, '3', 23, 7, 0, 1),
(86, '4', 23, 7, 0, 1),
(87, '1', 24, 7, 0, 0),
(88, '2', 24, 7, 10, 1),
(89, '3', 24, 7, 0, 1),
(90, '4', 24, 7, 0, 1),
(91, '1', 25, 7, 0, 1),
(92, '2', 25, 7, 0, 1),
(93, '3', 25, 7, 0, 1),
(94, '4', 25, 7, 10, 0);

-- --------------------------------------------------------

--
-- Structure de la table `parties`
--

CREATE TABLE IF NOT EXISTS `parties` (
  `partie_id` int(11) NOT NULL AUTO_INCREMENT,
  `partie_etat` int(11) NOT NULL,
  `partie_type` int(11) NOT NULL,
  PRIMARY KEY (`partie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `parties`
--

INSERT INTO `parties` (`partie_id`, `partie_etat`, `partie_type`) VALUES
(3, 0, 3),
(4, 1, 1),
(5, 2, 1),
(6, 2, 3),
(7, 2, 2),
(8, 0, 1),
(9, 1, 3),
(10, 2, 2),
(11, 2, 1),
(12, 1, 2),
(13, 2, 1),
(14, 0, 3),
(15, 2, 3),
(16, 2, 1),
(17, 2, 2),
(18, 2, 1),
(19, 2, 3),
(20, 2, 2),
(21, 2, 2),
(22, 0, 1),
(23, 2, 1),
(24, 2, 2),
(25, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `sauvegardes`
--

CREATE TABLE IF NOT EXISTS `sauvegardes` (
  `sauvegarde_id` int(11) NOT NULL AUTO_INCREMENT,
  `sauvegarde_geek` int(11) NOT NULL,
  `sauvegarde_case` varchar(255) NOT NULL,
  `sauvegarde_classe` varchar(255) NOT NULL,
  `sauvegarde_partie` int(11) NOT NULL,
  PRIMARY KEY (`sauvegarde_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `sauvegardes`
--

INSERT INTO `sauvegardes` (`sauvegarde_id`, `sauvegarde_geek`, `sauvegarde_case`, `sauvegarde_classe`, `sauvegarde_partie`) VALUES
(3, 3, 'R0', ' ', 4),
(4, 4, 'B5', ' ', 4),
(5, 5, 'DV', ' enClasse', 4),
(6, 6, 'R2', '', 4),
(7, 3, 'R3', ' ', 5),
(8, 4, 'NJ1', ' tourComplet', 5),
(9, 5, 'J0', ' ', 5),
(10, 6, 'R0', ' tourComplet', 5),
(11, 3, 'B0', ' tourComplet', 6),
(12, 4, 'J0', ' tourComplet', 6),
(13, 5, 'J4', ' ', 6),
(14, 6, 'NR1', ' tourComplet', 6),
(15, 3, 'B0', ' tourComplet', 7),
(16, 4, 'B8', '', 7),
(17, 5, 'R4', '', 7),
(18, 6, 'R0', ' tourComplet', 7),
(19, 3, 'DB', ' enClasse', 9),
(20, 4, 'J1', '', 9),
(21, 5, 'DV', ' enClasse', 9),
(22, 6, 'DR', ' enClasse', 9),
(23, 3, 'B3', '', 10),
(24, 4, 'DJ', ' enClasse', 10),
(25, 5, 'V5', '', 10),
(26, 6, 'DR', ' enClasse', 10),
(27, 3, 'B1', '', 12),
(28, 4, 'V2', ' ', 12),
(29, 5, 'V9', '', 12),
(30, 6, 'R7', '', 12),
(31, 3, 'B7', '', 20),
(32, 4, 'DJ', ' enClasse', 20),
(33, 5, 'V1', '', 20),
(34, 6, 'DR', ' enClasse', 20);

-- --------------------------------------------------------

--
-- Structure de la table `typespartie`
--

CREATE TABLE IF NOT EXISTS `typespartie` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_desc` varchar(255) NOT NULL,
  `type_case` int(11) NOT NULL,
  `type_num` int(11) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `typespartie`
--

INSERT INTO `typespartie` (`type_id`, `type_desc`, `type_case`, `type_num`) VALUES
(1, 'Petit plateau', 5, 2),
(2, 'Moyen plateau', 9, 4),
(3, 'Grand plateau', 13, 6);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nom` varchar(255) NOT NULL,
  `user_prenom` varchar(255) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_mdp` varchar(255) NOT NULL,
  `user_pseudo` varchar(255) NOT NULL,
  `user_couleur` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `user_nom`, `user_prenom`, `user_mail`, `user_mdp`, `user_pseudo`, `user_couleur`) VALUES
(3, 'Paviot', 'Camille', 'camille.paviot@imie-rennes.fr', '3e07ffb13a8dccd6d8b2edb9c565151e005b424e', 'Kmille', 4),
(4, 'Test', 'Sylvain', 'syl.pav@hotmail.fr', '9cf95dacd226dcf43da376cdb6cbba7035218921', '', 2),
(5, 'Toto', 'La tÃªte Ã ', 'toto@gmail.com', '34c5d4c71bb4f4f78b5d001c6a8ac97af74b9044', '', 3),
(6, 'Kent', 'Clarke', 'superman@yahoo.fr', '3b1758e05c68885403e94f87ade6894198302bb5', 'Superman', 4),
(7, 'Snoopy', 'Le chien', 'snoop@laposte.net', 'd1cc3b98f0b0e7761d40bc5578805cf76c2b24df', 'Snoopy', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
