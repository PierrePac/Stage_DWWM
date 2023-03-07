-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 25 mai 2022 à 10:27
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
-- Structure de la table `emploi`
--

DROP TABLE IF EXISTS `emploi`;
CREATE TABLE IF NOT EXISTS `emploi` (
  `emploi_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_emploi` varchar(30) NOT NULL,
  `description_emploi` longtext NOT NULL,
  `obligation_emploi` varchar(250) NOT NULL,
  `contrat` varchar(30) NOT NULL,
  `temps` int(3) NOT NULL,
  `salaire_heure` float NOT NULL,
  `fk_societe` int(11) NOT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT '1',
  `date` date NOT NULL,
  `mail_alerte` varchar(80) NOT NULL DEFAULT 'candidature@etoilesecours.com',
  PRIMARY KEY (`emploi_id`),
  KEY `fk_soc` (`fk_societe`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emploi`
--

INSERT INTO `emploi` (`emploi_id`, `nom_emploi`, `description_emploi`, `obligation_emploi`, `contrat`, `temps`, `salaire_heure`, `fk_societe`, `statut`, `date`, `mail_alerte`) VALUES
(1, 'test', 'test', 'test', 'test', 1, 1, 11, 1, '2022-05-01', 'candidature@etoilesecours.com'),
(2, 'Barbare', 'barbariser les geux', '', 'CDI', 40, 15, 12, 1, '2022-05-23', 'candidature@etoilesecours.com'),
(3, 'n&eacute;cromancien', 'ressusciter les d&eacute;funts', 'Vois les morts', 'CDD', 30, 13, 12, 1, '2022-05-23', 'candidature@etoilesecours.com'),
(4, 'Ambulancier', 'conduire une ambulance', 'Permis A', 'CDD', 30, 12, 12, 1, '2022-05-19', 'candidature@etoilesecours.com'),
(5, 'Ambulancier', 'conduire une ambulance', 'Permis C', 'CDD', 30, 12, 12, 1, '2022-05-19', 'candidature@etoilesecours.com');

-- --------------------------------------------------------

--
-- Structure de la table `postulant`
--

DROP TABLE IF EXISTS `postulant`;
CREATE TABLE IF NOT EXISTS `postulant` (
  `postulant_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_emploi` int(2) NOT NULL,
  `nom_postulant` varchar(30) NOT NULL,
  `prenom_postulant` varchar(30) NOT NULL,
  `mail_postulant` varchar(40) NOT NULL,
  `cv` varchar(50) NOT NULL,
  PRIMARY KEY (`postulant_id`),
  KEY `fk_emploi` (`fk_emploi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `fk_societe` int(3) DEFAULT NULL,
  PRIMARY KEY (`rdv_id`),
  KEY `fk_user` (`fk_user`) USING BTREE,
  KEY `fk_societe` (`fk_societe`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rdv`
--

INSERT INTO `rdv` (`rdv_id`, `fk_user`, `rdv_date`, `heure`, `transport_type`, `transport_kms`, `rdv_raison`, `ald`, `pick_name`, `pick_adress`, `pick_zip`, `pick_ville`, `dest_name`, `dest_adress`, `dest_zip`, `dest_ville`, `statut`, `fk_societe`) VALUES
(1, 45, '2000-01-01', '10:01:00', 1, 0, 0, 0, 'ghg', 'fdg fgfdsg ', 13100, 'yhvuh', 'egffbg', 'fdgfdgfdg', 17200, 'sdsqd', 1, 12),
(4, 6, '2000-01-01', '10:10:00', 1, 0, 0, 1, 'DDfdF', 'FGFDGFDGFGFD', 22000, 'qdsqdd', 'qsxsxQ', 'Qcsccc', 33000, 'DSDSF', 1, NULL),
(7, 6, '2000-01-01', '10:10:00', 1, 0, 0, 1, 'DDfdF', 'FGFDGFDGFGFD', 22000, 'qdsqdd', 'qsxsxQ', 'Qcsccc', 33000, 'DSDSF', 1, NULL),
(8, 6, '2022-04-08', '12:23:00', 0, 0, 1, 0, 'DDfdF', 'FGFDGFDGFGFD', 22000, 'qdsqdd', 'qsxsxQ', 'Qcsccc', 33000, 'DSDSF', 1, NULL),
(9, 45, '2022-04-08', '12:23:00', 0, 0, 1, 0, 'ukuykryk', '120 Rue Lucien Devaux', 17200, 'ST PALAIS SUR MER', 'uykuru', '138 AVENUE DE ROCHEFORT', 17200, 'ROYAN', 1, 12),
(10, 45, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1, 12),
(11, 45, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1, 12),
(12, 45, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1, 12),
(13, 45, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1, 12),
(14, 45, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1, 12),
(15, 45, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1, 12),
(16, 45, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1, 12),
(17, 45, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1, 12),
(18, 7, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1, NULL),
(19, 7, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1, NULL),
(20, 7, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 1, NULL),
(21, 45, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1, 12),
(22, 45, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1, 12),
(23, 45, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1, 12),
(24, 45, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1, 12),
(25, 45, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1, 12),
(26, 45, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1, 12),
(27, 45, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1, 12),
(28, 45, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1, 12),
(29, 45, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1, 12),
(30, 45, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 1, 12),
(31, 45, '2022-04-15', '15:56:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'teztzaetaeztreza', '16 Av. du Dr Dieras', 17300, 'Rochefort', 1, 12),
(32, 45, '2022-04-30', '20:00:00', 0, 0, 0, 0, 'aaaaaa', 'aaaaaaa', 11111, 'aaaaa', 'bbbbb', 'bbbbbbbb', 22222, 'bbbbb', 1, 11),
(33, 45, '2022-04-21', '16:07:00', 0, 1, 1, 0, 'zzzzzzz', 'zzzzzzz', 11111, 'zzzzzz', 'wwwww', 'wwwwww', 33333, 'wwwww', 0, 12),
(34, 45, '2022-04-21', '16:07:00', 0, 1, 1, 0, 'zzzzzzz', 'zzzzzzz', 11111, 'zzzzzz', 'wwwww', 'wwwwww', 33333, 'wwwww', 0, 12),
(35, 45, '2022-04-21', '16:22:00', 0, 0, 0, 0, 'uuuuuuuu', 'uuuuuuuuu', 33333, 'uuuuuuu', 'rrrrrrr', 'rrrrrrrrr', 99999, 'ppppppp', 0, 12),
(36, 9, '2023-10-11', '16:53:00', 0, 1, 0, 0, 'mmmmmmm', 'mmmmmmmmmm', 88888, 'mmmmmmmmm', 'nnnnnnnnnn', 'nnnnnnnnnnnn', 99999, 'nnnnnnnn', 0, NULL),
(37, 9, '2009-02-01', '17:05:00', 0, 1, 1, 0, 'tttttttttttttt', 'tttttttttttt', 44444, 'tttttttttttt', 'oooooooooo', 'oooooooooo', 33333, 'oooooooooo', 1, NULL),
(38, 9, '2022-04-08', '17:34:00', 0, 0, 0, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'iy;i-u', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 1, NULL),
(39, 45, '2022-05-17', '17:30:00', 0, 0, 0, 0, 'Afpa', '57 Avenue Bernadottes', 17300, 'Rochefort', 'maison', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 0, 12),
(40, 45, '2022-05-18', '18:30:00', 0, 0, 0, 0, 'Afpa', '57 avenue Bernadotte', 17300, 'Rochefort', 'Maison', '25 rue Française', 12250, 'Tournemire', 1, 12),
(41, 45, '2022-05-17', '20:30:00', 0, 0, 0, 0, 'Afpa', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 'maison', '322 route de Caours', 80132, 'VAUCHELLES LES QUESNOY', 0, 11);

-- --------------------------------------------------------

--
-- Structure de la table `site_societe`
--

DROP TABLE IF EXISTS `site_societe`;
CREATE TABLE IF NOT EXISTS `site_societe` (
  `id_societe` int(9) NOT NULL AUTO_INCREMENT,
  `societe_nom` varchar(40) NOT NULL,
  `societe_createur` text CHARACTER SET latin1,
  `date_creation` date DEFAULT NULL,
  `societe_adress` text CHARACTER SET latin1,
  `societe_zip` int(8) DEFAULT NULL,
  `societe_ville` text CHARACTER SET latin1,
  `societe_tel` int(12) DEFAULT NULL,
  `societe_mail` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `story_1` longtext CHARACTER SET latin1,
  `story_2` longtext CHARACTER SET latin1,
  `img_1` longtext CHARACTER SET latin1,
  `img_2` longtext CHARACTER SET latin1,
  `img_3` longtext CHARACTER SET latin1,
  `slider_1` varchar(80) DEFAULT NULL,
  `slider_2` varchar(80) DEFAULT NULL,
  `slider_3` varchar(80) DEFAULT NULL,
  `logo` varchar(80) DEFAULT NULL,
  `map` varchar(350) DEFAULT NULL,
  `template_id` int(9) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_societe`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `site_societe`
--

INSERT INTO `site_societe` (`id_societe`, `societe_nom`, `societe_createur`, `date_creation`, `societe_adress`, `societe_zip`, `societe_ville`, `societe_tel`, `societe_mail`, `story_1`, `story_2`, `img_1`, `img_2`, `img_3`, `slider_1`, `slider_2`, `slider_3`, `logo`, `map`, `template_id`, `active`) VALUES
(11, 'Ambulances ASUR', 'Bobby', '1984-11-09', '2 rue des rues', 12250, 'Tournemire', 234567891, 'pac.pierre@gmail.com', 'story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 story1 ', 'story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 ', 'rectangle.webp', 'carre.webp', 'carre.webp', 'rectangle.webp', 'rectangle.webp', 'rectangle.webp', 'carre.webp', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5580.678802522693!2d-1.0170524897353224!3d45.62391771865277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4801766f8e71c0d9%3A0xcf614f4f70730a0c!2sAmbulances%20Saint%20Bernard!5e0!3m2!1sfr!2sfr!4v1651141791374!5m2!1sfr!2sfr', 0, 1),
(12, 'Ambulances PAC', 'moi', '1984-11-09', '1 rue des rues', 17300, 'Rochefort', 123456789, 'mail@mail.fr', 'bla bla', 'bla bla', 'rectangle.webp', 'carre.webp', 'carre.webp', 'rectangle.webp', 'rectangle.webp', 'rectangle.webp', 'carre.webp', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5580.678802522693!2d-1.0170524897353224!3d45.62391771865277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4801766f8e71c0d9%3A0xcf614f4f70730a0c!2sAmbulances%20Saint%20Bernard!5e0!3m2!1sfr!2sfr!4v1651141791374!5m2!1sfr!2sfr', 0, 1),
(13, 'Ambulances ATLANTIS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(14, 'Ambulances AUBERT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(15, 'Ambulances AZUR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(16, 'Ambulances BOURCIER DUMONTET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(17, 'Ambulances COLBERT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(18, 'Ambulances COLLON VAILLANT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(19, 'Ambulances COUTANT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(20, 'Ambulances DE CHATEL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(21, 'Ambulances DUPE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(22, 'Ambulances ETOILE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(23, 'Ambulances ETOILE BLEUE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(24, 'Ambulances HELENE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(25, 'Ambulances MAROTTA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(26, 'Ambulances METIVIER', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(27, 'Ambulances MOURRY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(28, 'Ambulances NOEL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(29, 'Ambulances OUEST TOURRAINE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(30, 'Ambulances PACIFIQUE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(31, 'Ambulances PRESQU\'ILE D\'ARVERT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(32, 'Ambulances RAOULX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(33, 'Ambulances RETAISES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(34, 'Ambulances SERVICE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(35, 'Ambulances ST BERNARD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1),
(37, 'Ambulances ATLANTIQUE', 'Jean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, 1);

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
  `profil` tinyint(2) NOT NULL DEFAULT '0',
  `anniv` date DEFAULT NULL,
  `fk_societe` int(9) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  KEY `fk_societe` (`fk_societe`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`user_id`, `nom`, `prenom`, `adress`, `zip`, `ville`, `tel`, `mail`, `mdp`, `profil`, `anniv`, `fk_societe`, `active`) VALUES
(5, 'VATEPO', 'Polo', '58 rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667215, 'service-achat@etoilesecours.fr', 'b61a6d542f9036550ba9c401c80f00ef', 0, '2001-06-14', 11, 1),
(6, 'TREAZ', 'Faon', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667213, 'abc@abc.fr', 'ab4f63f9ac65152575886860dde480a1', 0, '1982-03-23', 12, 0),
(7, 'popopo', 'popopo', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667213, 'test@etoilesecours.fr', 'b61a6d542f9036550ba9c401c80f00ef', 0, '1979-01-31', 12, 1),
(8, 'ppppppppppp', 'NELLY', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667213, 'service-achathtrhrthyr@etoilesecours.fr', 'b61a6d542f9036550ba9c401c80f00ef', 0, '2022-04-08', 12, 1),
(9, 'MONTEAUD', 'Nelly', '120 Rue Lucien Devaux', 17420, 'Saint-Palais-sur-Mer', 617667213, 'mikael.dejoie@etoilesecours.fr', 'b61a6d542f9036550ba9c401c80f00ef', 0, '2022-04-27', 12, 1),
(10, 'MONTEAUD', 'NELLY', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667213, 'etoilesecours@gmail.com', 'b61a6d542f9036550ba9c401c80f00ef', 0, '2022-04-14', 12, 1),
(43, 'Pac', 'Pierre', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 608112179, 'pac.pierre@gmail.com', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 2, '1984-11-09', 11, 1),
(44, 'Pac', 'Pierre', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 608112179, 'pac.pierre@gmail.com', '8482918e4705c6be210084c9d94e0fe2f45fcf4e79f2d5013c76e44fe1c95d43', 1, '1984-11-09', 12, 1),
(45, 'Pac', 'Pierre', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 608112179, 'pac.pierre@gmail.com', '590c9f8430c7435807df8ba9a476e3f1295d46ef210f6efae2043a4c085a569e', 0, '0984-11-09', 12, 1),
(47, 'Pac', 'Pierre', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 608112179, 'pac.pierre@gmail.com', 'fd61a03af4f77d870fc21e05e7e80678095c92d808cfb3b5c279ee04c74aca13', 3, '1984-11-09', 12, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emploi`
--
ALTER TABLE `emploi`
  ADD CONSTRAINT `emploi_ibfk_1` FOREIGN KEY (`fk_societe`) REFERENCES `site_societe` (`id_societe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `postulant`
--
ALTER TABLE `postulant`
  ADD CONSTRAINT `postulant_ibfk_1` FOREIGN KEY (`fk_emploi`) REFERENCES `emploi` (`emploi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `rdv_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `utilisateur` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rdv_ibfk_2` FOREIGN KEY (`fk_societe`) REFERENCES `site_societe` (`id_societe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`fk_societe`) REFERENCES `site_societe` (`id_societe`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
