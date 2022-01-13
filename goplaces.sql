-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 13 jan. 2022 à 12:21
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `goplaces`
--

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'tokyo'),
(2, 'kyoto');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `place_reserved` int(11) DEFAULT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `date`, `price`, `place_reserved`, `trip_id`, `user_id`) VALUES
(1, '2022-01-13 12:21:03', 2000, 2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `trip`
--

DROP TABLE IF EXISTS `trip`;
CREATE TABLE IF NOT EXISTS `trip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `date` datetime DEFAULT NULL,
  `place_available` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `trip`
--

INSERT INTO `trip` (`id`, `name`, `date`, `place_available`, `price`) VALUES
(1, 'Tokyo et ses alentours', '2022-01-13 12:09:30', 30, 2000);

-- --------------------------------------------------------

--
-- Structure de la table `trip_city`
--

DROP TABLE IF EXISTS `trip_city`;
CREATE TABLE IF NOT EXISTS `trip_city` (
  `trip_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  KEY `fk_trip_id` (`trip_id`),
  KEY `fk_city_id` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `trip_city`
--

INSERT INTO `trip_city` (`trip_id`, `city_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(512) NOT NULL,
  `role` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admin', 'ADMIN');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `trip_city`
--
ALTER TABLE `trip_city`
  ADD CONSTRAINT `fk_city_id` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `fk_trip_id` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
