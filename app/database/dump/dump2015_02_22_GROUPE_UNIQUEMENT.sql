-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 22 Février 2015 à 14:16
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `scolarite_nil`
--

-- --------------------------------------------------------

--
-- Structure de la table `_groupe`
--

CREATE TABLE IF NOT EXISTS `_groupe` (
`id` int(10) unsigned NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `semestre_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sous_groupe` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `_groupe`
--

INSERT INTO `_groupe` (`id`, `nom`, `semestre_id`, `sous_groupe`) VALUES
(1, 'A', 'sem00001', 1),
(2, 'B', 'sem00001', 2),
(3, 'C', 'sem00001', 3),
(4, 'D', 'sem00001', 0),
(5, 'E', 'sem00001', 0),
(6, 'Test', 'sem00001', 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `_groupe`
--
ALTER TABLE `_groupe`
 ADD PRIMARY KEY (`id`), ADD KEY `_groupe_semestre_id_foreign` (`semestre_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `_groupe`
--
ALTER TABLE `_groupe`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `_groupe`
--
ALTER TABLE `_groupe`
ADD CONSTRAINT `_groupe_semestre_id_foreign` FOREIGN KEY (`semestre_id`) REFERENCES `semestre` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
