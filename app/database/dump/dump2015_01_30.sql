-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Ven 30 Janvier 2015 à 16:34
-- Version du serveur :  5.5.34
-- Version de PHP :  5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `scolarite_nil`
--
CREATE DATABASE IF NOT EXISTS `scolarite_nil` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `scolarite_nil`;

-- --------------------------------------------------------

--
-- Structure de la table `_financement`
--

DROP TABLE IF EXISTS `_financement`;
CREATE TABLE `_financement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `montant` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `_financement`
--

INSERT INTO `_financement` (`id`, `libelle`, `montant`) VALUES
(1, 'Financement #1', 20000),
(2, 'Financement #2', 6000),
(3, 'Financement #3', 200);
