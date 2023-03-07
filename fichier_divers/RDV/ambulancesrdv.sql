-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 04 avr. 2022 à 16:08
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ambulancesrdv`
--

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `rdv_id` int(10) NOT NULL AUTO_INCREMENT,
  `fk_user` int(10) NOT NULL,
  `rdv_date` date NOT NULL,
  `heure` time NOT NULL,
  `transport_type` tinyint(1) NOT NULL,
  `transport_kms` tinyint(1) NOT NULL,
  `rdv_raison` tinyint(1) NOT NULL,
  `ald` tinyint(1) NOT NULL,
  `pick_name` varchar(40) NOT NULL,
  `pick_adress` varchar(80) NOT NULL,
  `pick_zip` int(6) NOT NULL,
  `pick_ville` varchar(60) NOT NULL,
  `dest_name` varchar(40) NOT NULL,
  `dest_adress` varchar(80) NOT NULL,
  `dest_zip` int(6) NOT NULL,
  `dest_ville` varchar(60) NOT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rdv_id`),
  KEY `fk_user` (`fk_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rdv`
--

INSERT INTO `rdv` (`rdv_id`, `fk_user`, `rdv_date`, `heure`, `transport_type`, `transport_kms`, `rdv_raison`, `ald`, `pick_name`, `pick_adress`, `pick_zip`, `pick_ville`, `dest_name`, `dest_adress`, `dest_zip`, `dest_ville`, `statut`) VALUES
(1, 5, '2000-01-01', '10:01:00', 1, 0, 0, 0, 'ghg', 'fdg fgfdsg ', 13100, 'yhvuh', 'egffbg', 'fdgfdgfdg', 17200, 'sdsqd', 1),
(4, 6, '2000-01-01', '10:10:00', 1, 0, 0, 1, 'DDfdF', 'FGFDGFDGFGFD', 22000, 'qdsqdd', 'qsxsxQ', 'Qcsccc', 33000, 'DSDSF', 1),
(7, 6, '2000-01-01', '10:10:00', 1, 0, 0, 1, 'DDfdF', 'FGFDGFDGFGFD', 22000, 'qdsqdd', 'qsxsxQ', 'Qcsccc', 33000, 'DSDSF', 1),
(8, 6, '2022-04-08', '12:23:00', 0, 0, 1, 0, 'DDfdF', 'FGFDGFDGFGFD', 22000, 'qdsqdd', 'qsxsxQ', 'Qcsccc', 33000, 'DSDSF', 1),
(9, 5, '2022-04-08', '12:23:00', 0, 0, 1, 0, 'ukuykryk', '120 Rue Lucien Devaux', 17200, 'ST PALAIS SUR MER', 'uykuru', '138 AVENUE DE ROCHEFORT', 17200, 'ROYAN', 1),
(10, 5, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1),
(11, 5, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1),
(12, 5, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1),
(13, 5, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1),
(14, 5, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1),
(15, 5, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1),
(16, 5, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1),
(17, 5, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1),
(18, 7, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1),
(19, 7, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1),
(20, 7, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1),
(21, 5, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1),
(22, 5, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1),
(23, 5, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1),
(24, 5, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1),
(25, 5, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1),
(26, 5, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1),
(27, 5, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1),
(28, 5, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1),
(29, 5, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1),
(30, 5, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1),
(31, 5, '2022-04-15', '15:56:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'teztzaetaeztreza', '16 Av. du Dr Dieras', 17300, 'Rochefort', 1),
(32, 5, '2022-04-30', '20:00:00', 0, 0, 0, 0, 'aaaaaa', 'aaaaaaa', 11111, 'aaaaa', 'bbbbb', 'bbbbbbbb', 22222, 'bbbbb', 1),
(33, 5, '2022-04-21', '16:07:00', 0, 1, 1, 0, 'zzzzzzz', 'zzzzzzz', 11111, 'zzzzzz', 'wwwww', 'wwwwww', 33333, 'wwwww', 0),
(34, 5, '2022-04-21', '16:07:00', 0, 1, 1, 0, 'zzzzzzz', 'zzzzzzz', 11111, 'zzzzzz', 'wwwww', 'wwwwww', 33333, 'wwwww', 0),
(35, 5, '2022-04-21', '16:22:00', 0, 0, 0, 0, 'uuuuuuuu', 'uuuuuuuuu', 33333, 'uuuuuuu', 'rrrrrrr', 'rrrrrrrrr', 99999, 'ppppppp', 0),
(36, 9, '2023-10-11', '16:53:00', 0, 1, 0, 0, 'mmmmmmm', 'mmmmmmmmmm', 88888, 'mmmmmmmmm', 'nnnnnnnnnn', 'nnnnnnnnnnnn', 99999, 'nnnnnnnn', 0),
(37, 9, '2009-02-01', '17:05:00', 0, 1, 1, 0, 'tttttttttttttt', 'tttttttttttt', 44444, 'tttttttttttt', 'oooooooooo', 'oooooooooo', 33333, 'oooooooooo', 1),
(38, 9, '2022-04-08', '17:34:00', 0, 0, 0, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'iy;i-u', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `adress` text NOT NULL,
  `zip` int(8) NOT NULL,
  `ville` text NOT NULL,
  `tel` int(12) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `mdp` longtext NOT NULL,
  `profil` tinyint(1) NOT NULL DEFAULT '0',
  `anniv` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`user_id`, `nom`, `prenom`, `adress`, `zip`, `ville`, `tel`, `mail`, `mdp`, `profil`, `anniv`) VALUES
(5, 'VATEPO', 'Polo', '58 rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667215, 'service-achat@etoilesecours.fr', 'b61a6d542f9036550ba9c401c80f00ef', 0, '2001-06-14'),
(6, 'TREAZ', 'Faon', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667213, 'abc@abc.fr', 'ab4f63f9ac65152575886860dde480a1', 1, '1982-03-23'),
(7, 'popopo', 'popopo', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667213, 'test@etoilesecours.fr', 'b61a6d542f9036550ba9c401c80f00ef', 0, '1979-01-31'),
(8, 'ppppppppppp', 'NELLY', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667213, 'service-achathtrhrthyr@etoilesecours.fr', 'b61a6d542f9036550ba9c401c80f00ef', 0, '2022-04-08'),
(9, 'MONTEAUD', 'Nelly', '120 Rue Lucien Devaux', 17420, 'Saint-Palais-sur-Mer', 617667213, 'mikael.dejoie@etoilesecours.fr', 'b61a6d542f9036550ba9c401c80f00ef', 0, '2022-04-27'),
(10, 'MONTEAUD', 'NELLY', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667213, 'etoilesecours@gmail.com', 'b61a6d542f9036550ba9c401c80f00ef', 0, '2022-04-14');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `rdv_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `utilisateur` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
