-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 07 Décembre 2017 à 20:17
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pictionnary`
--

-- --------------------------------------------------------

--
-- Structure de la table `drawings`
--

CREATE TABLE `drawings` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `commande` text NOT NULL,
  `dessin` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(65) NOT NULL,
  `password` varchar(65) NOT NULL,
  `nom` varchar(65) DEFAULT NULL,
  `prenom` varchar(65) DEFAULT NULL,
  `tel` varchar(16) DEFAULT NULL,
  `website` varchar(65) DEFAULT NULL,
  `sexe` char(1) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `ville` varchar(65) DEFAULT NULL,
  `taille` smallint(6) DEFAULT NULL,
  `couleur` char(6) DEFAULT '000000',
  `profilepic` longblob
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `drawings`
--
ALTER TABLE `drawings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `drawings`
--
ALTER TABLE `drawings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
