-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 18 juil. 2022 à 07:26
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
-- Structure de la table `ambu_emploi`
--

DROP TABLE IF EXISTS `ambu_emploi`;
CREATE TABLE IF NOT EXISTS `ambu_emploi` (
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ambu_emploi`
--

INSERT INTO `ambu_emploi` (`emploi_id`, `nom_emploi`, `description_emploi`, `obligation_emploi`, `contrat`, `temps`, `salaire_heure`, `fk_societe`, `statut`, `date`, `mail_alerte`) VALUES
(9, 'Ambulancier', 'conduire une ambulance', 'permis', 'CDI', 35, 15, 89, 1, '2022-06-16', 'candidature@etoilesecours.com');

-- --------------------------------------------------------

--
-- Structure de la table `ambu_postulant`
--

DROP TABLE IF EXISTS `ambu_postulant`;
CREATE TABLE IF NOT EXISTS `ambu_postulant` (
  `postulant_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_emploi` int(2) NOT NULL,
  `nom_postulant` varchar(30) NOT NULL,
  `prenom_postulant` varchar(30) NOT NULL,
  `mail_postulant` varchar(40) NOT NULL,
  `cv` varchar(50) NOT NULL,
  `motivation` varchar(80) NOT NULL,
  PRIMARY KEY (`postulant_id`),
  KEY `fk_emploi` (`fk_emploi`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ambu_postulant`
--

INSERT INTO `ambu_postulant` (`postulant_id`, `fk_emploi`, `nom_postulant`, `prenom_postulant`, `mail_postulant`, `cv`, `motivation`) VALUES
(20, 9, 'Pierre Pac', 'Pierre', 'pac.pierre@gmail.com', '9-cv-Pierre Pac-Pierre.docx', ''),
(21, 9, 'Pierre Pac', 'Pierre', 'pac.pierre@gmail.com', '9-cv-Pierre Pac-Pierre.docx', ''),
(22, 9, 'Pierre Pac', 'Pierre', 'pac.pierre@gmail.com', '9-cv-Pierre Pac-Pierredocx', ''),
(23, 9, 'Pierre Pac', 'Pierre', 'pac.pierre@gmail.com', '9-cv-Pierre Pac-Pierredocx', ''),
(24, 9, 'Pierre Pac', 'Pierre', 'pac.pierre@gmail.com', '9-cv-Pierre Pac-Pierredocx', '');

-- --------------------------------------------------------

--
-- Structure de la table `ambu_rdv`
--

DROP TABLE IF EXISTS `ambu_rdv`;
CREATE TABLE IF NOT EXISTS `ambu_rdv` (
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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ambu_rdv`
--

INSERT INTO `ambu_rdv` (`rdv_id`, `fk_user`, `rdv_date`, `heure`, `transport_type`, `transport_kms`, `rdv_raison`, `ald`, `pick_name`, `pick_adress`, `pick_zip`, `pick_ville`, `dest_name`, `dest_adress`, `dest_zip`, `dest_ville`, `statut`, `fk_societe`) VALUES
(1, 49, '2022-06-22', '15:15:00', 0, 0, 0, 0, 'maison', 'jlkjfklsdjfklj', 15550, 'qskjdfqlksjf', 'sdljfklsdjfls', 'sdfsdfsd', 15554, 'sdfsdfsd', 0, 89),
(39, 49, '2000-01-01', '10:01:00', 1, 0, 0, 0, 'ghg', 'fdg fgfdsg ', 13100, 'yhvuh', 'egffbg', 'fdgfdgfdg', 17200, 'sdsqd', 0, 37),
(40, 49, '2000-01-01', '10:10:00', 1, 0, 0, 1, 'DDfdF', 'FGFDGFDGFGFD', 22000, 'qdsqdd', 'qsxsxQ', 'Qcsccc', 33000, 'DSDSF', 0, 72),
(41, 49, '2000-01-01', '10:10:00', 1, 0, 0, 1, 'DDfdF', 'FGFDGFDGFGFD', 22000, 'qdsqdd', 'qsxsxQ', 'Qcsccc', 33000, 'DSDSF', 0, 79),
(42, 49, '2022-04-08', '12:23:00', 0, 0, 1, 0, 'DDfdF', 'FGFDGFDGFGFD', 22000, 'qdsqdd', 'qsxsxQ', 'Qcsccc', 33000, 'DSDSF', 0, 70),
(43, 49, '2022-04-08', '12:23:00', 0, 0, 1, 0, 'ukuykryk', '120 Rue Lucien Devaux', 17200, 'ST PALAIS SUR MER', 'uykuru', '138 AVENUE DE ROCHEFORT', 17200, 'ROYAN', 0, 80),
(44, 49, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 0, 82),
(45, 49, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 0, 80),
(46, 49, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 0, 79),
(47, 49, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 0, 78),
(48, 49, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 0, 78),
(49, 49, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 0, 77),
(50, 49, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 0, 77),
(51, 49, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 0, 80),
(52, 49, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 0, 78),
(53, 49, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 0, 79),
(54, 49, '2022-04-15', '07:53:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'uykuru', '2 rue de la Perouse', 17440, 'AYTRE', 0, 77),
(55, 49, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 0, 73),
(56, 49, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 0, 67),
(57, 49, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 0, 67),
(58, 49, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 0, 75),
(59, 49, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 0, 80),
(60, 49, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 0, 80),
(61, 49, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 0, 72),
(62, 49, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 0, 76),
(63, 49, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 0, 74),
(64, 49, '2022-04-02', '14:35:00', 0, 0, 0, 1, 'zfrz', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'pppp', '120 Rue Lucien Devaux', 17420, 'ST PALAIS SUR MER', 0, 89),
(65, 49, '2022-04-15', '15:56:00', 0, 0, 1, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'teztzaetaeztreza', '16 Av. du Dr Dieras', 17300, 'Rochefort', 0, 65),
(66, 49, '2022-04-30', '20:00:00', 0, 0, 0, 0, 'aaaaaa', 'aaaaaaa', 11111, 'aaaaa', 'bbbbb', 'bbbbbbbb', 22222, 'bbbbb', 0, 70),
(67, 49, '2022-04-21', '16:07:00', 0, 1, 1, 0, 'zzzzzzz', 'zzzzzzz', 11111, 'zzzzzz', 'wwwww', 'wwwwww', 33333, 'wwwww', 0, 76),
(68, 49, '2022-04-21', '16:07:00', 0, 1, 1, 0, 'zzzzzzz', 'zzzzzzz', 11111, 'zzzzzz', 'wwwww', 'wwwwww', 33333, 'wwwww', 0, 79),
(69, 49, '2022-04-21', '16:22:00', 0, 0, 0, 0, 'uuuuuuuu', 'uuuuuuuuu', 33333, 'uuuuuuu', 'rrrrrrr', 'rrrrrrrrr', 99999, 'ppppppp', 0, 78),
(70, 49, '2023-10-11', '16:53:00', 0, 1, 0, 0, 'mmmmmmm', 'mmmmmmmmmm', 88888, 'mmmmmmmmm', 'nnnnnnnnnn', 'nnnnnnnnnnnn', 99999, 'nnnnnnnn', 0, 74),
(71, 49, '2009-02-01', '17:05:00', 0, 1, 1, 0, 'tttttttttttttt', 'tttttttttttt', 44444, 'tttttttttttt', 'oooooooooo', 'oooooooooo', 33333, 'oooooooooo', 0, 69),
(72, 49, '2022-04-08', '17:34:00', 0, 0, 0, 0, 'ukuykryk', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 'iy;i-u', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 0, 66),
(73, 49, '2022-05-17', '17:30:00', 0, 0, 0, 0, 'Afpa', '57 Avenue Bernadottes', 17300, 'Rochefort', 'maison', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 0, 66),
(74, 49, '2022-05-18', '18:30:00', 0, 0, 0, 0, 'Afpa', '57 avenue Bernadotte', 17300, 'Rochefort', 'Maison', '25 rue Française', 12250, 'Tournemire', 0, 81),
(75, 49, '2022-05-17', '20:30:00', 0, 0, 0, 0, 'Afpa', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 'maison', '322 route de Caours', 80132, 'VAUCHELLES LES QUESNOY', 0, 72);

-- --------------------------------------------------------

--
-- Structure de la table `ambu_site_societe`
--

DROP TABLE IF EXISTS `ambu_site_societe`;
CREATE TABLE IF NOT EXISTS `ambu_site_societe` (
  `id_societe` int(9) NOT NULL AUTO_INCREMENT,
  `societe_nom` varchar(40) NOT NULL,
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
  `dossier` varchar(80) NOT NULL,
  PRIMARY KEY (`id_societe`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ambu_site_societe`
--

INSERT INTO `ambu_site_societe` (`id_societe`, `societe_nom`, `date_creation`, `societe_adress`, `societe_zip`, `societe_ville`, `societe_tel`, `societe_mail`, `story_1`, `story_2`, `img_1`, `img_2`, `img_3`, `slider_1`, `slider_2`, `slider_3`, `logo`, `map`, `template_id`, `active`, `dossier`) VALUES
(37, 'Ambulances ATLANTIQUE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'ATLANTIQUE'),
(64, 'Ambulances ASUR', '1986-07-01', '29B boulevard du Guedeau', 79300, 'Bressuire', 549651208, 'pac.pierre@gmail.com', 'Nos &eacute;quipes d&amp;#039;ambulanciers dipl&ocirc;m&eacute;s sont qualifi&eacute;es pour r&eacute;pondre &agrave; toutes les situations d&amp;#039;urgence. Nous sommes &agrave; votre &eacute;coute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de s&eacute;curit&eacute;.\r\n\r\nNos v&eacute;hicules climatis&eacute;s sont r&eacute;cents et &eacute;quip&eacute;s de tout le mat&eacute;riel n&eacute;cessaire au secours d&amp;#039;urgence.\r\n\r\nVous pouvez nous joindre 24h/24 7j/7 par t&eacute;l&eacute;phone.', 'story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 story2 ', 'rectangle.webp', 'carre.webp', 'carre.webp', 'rectangle.webp', 'rectangle.webp', 'rectangle.webp', 'carre.webp', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5580.678802522693!2d-1.0170524897353224!3d45.62391771865277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4801766f8e71c0d9%3A0xcf614f4f70730a0c!2sAmbulances%20Saint%20Bernard!5e0!3m2!1sfr!2sfr!4v1651141791374!5m2!1sfr!2sfr', 1, 1, 'ASUR'),
(65, 'Ambulances ATLANTIQUE', '1989-01-01', '2 rue de la Pérouse', 17440, 'Aytré', 546272519, 'mail@mail.fr', 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', 'bla bla', 'rectangle.webp', 'carre.webp', 'carre.webp', 'rectangle.webp', 'rectangle.webp', 'rectangle.webp', 'carre.webp', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5580.678802522693!2d-1.0170524897353224!3d45.62391771865277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4801766f8e71c0d9%3A0xcf614f4f70730a0c!2sAmbulances%20Saint%20Bernard!5e0!3m2!1sfr!2sfr!4v1651141791374!5m2!1sfr!2sfr', 1, 1, 'ATLANTIQUE'),
(66, 'Ambulances ATLANTIS', '1996-07-01', 'aa', 75000, 'Paris', 549057806, 'test@test.test', 'Nos &eacute;quipes d&amp;amp;#039;ambulanciers dipl&ocirc;m&eacute;s sont qualifi&eacute;es pour r&eacute;pondre &agrave; toutes les situations d&amp;amp;#039;urgence. Nous sommes &agrave; votre &eacute;coute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de s&eacute;curit&eacute;.  Nos v&eacute;hicules climatis&eacute;s sont r&eacute;cents et &eacute;quip&eacute;s de tout le mat&eacute;riel n&eacute;cessaire au secours d&amp;amp;#039;urgence.  Vous pouvez nous joindre 24h/24 7j/7 par t&eacute;l&eacute;phone .', 'Nos &eacute;quipes d&amp;amp;#039;ambulanciers dipl&ocirc;m&eacute;s sont qualifi&eacute;es pour r&eacute;pondre &agrave; toutes les situations d&amp;amp;#039;urgence. Nous sommes &agrave; votre &eacute;coute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de s&eacute;curit&eacute;.  Nos v&eacute;hicules climatis&eacute;s sont r&eacute;cents et &eacute;quip&eacute;s de tout le mat&eacute;riel n&eacute;cessaire au secours d&amp;amp;#039;urgence.  Vous pouvez nous joindre 24h/24 7j/7 par t&eacute;l&eacute;phone .', 'pexels-moses-londo-10434596.webp', '66-pexels-ryutaro-tsukata-5191376.webp', '66-pexels-cottonbro-4065156.webp', '', '', '', 'croix_ambulances.webp', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5580.678802522693!2d-1.0170524897353224!3d45.62391771865277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4801766f8e71c0d9%3A0xcf614f4f70730a0c!2sAmbulances%20Saint%20Bernard!5e0!3m2!1sfr!2sfr!4v1651141791374!5m2!1sfr!2sfr', 1, 1, 'ATLANTIS'),
(67, 'Ambulances AUBERT', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'AUBERT'),
(68, 'Ambulances AZUR', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'AZUR'),
(69, 'Ambulances BOURCIER DUMONTET', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'BOURCIERDUMONTET'),
(70, 'Ambulances COLBERT', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'COLBERT'),
(71, 'Ambulances COLLON VAILLANT', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'COLLONVAILLANT'),
(72, 'Ambulances COUTANT', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'COUTANT'),
(73, 'Ambulances DE CHATEL', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'DECHATEL'),
(74, 'Ambulances DUPE', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'DUPE'),
(75, 'Ambulances ETOILE', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'ETOILE'),
(76, 'Ambulances ETOILE BLEUE', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'ETOILEBLEUE'),
(77, 'Ambulances HELENE', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'HELENE'),
(78, 'Ambulances MAROTTA', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'MAROTTA'),
(79, 'Ambulances METIVIER', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'METIVIER'),
(80, 'Ambulances MOURRY', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'MOURRY'),
(81, 'Ambulances NOEL', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'NOEL'),
(82, 'Ambulances OUEST TOURRAINE', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'OUESTTOURRAINE'),
(83, 'Ambulances PACIFIQUE', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'PACIFIQUE'),
(84, 'Ambulances PRESQU\'ILE D\'ARVERT', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'PRESQUILEDARVERT'),
(85, 'Ambulances RAOULX', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'RAOULX'),
(86, 'Ambulances RETAISES', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'RETAISES'),
(87, 'Ambulances SERVICE', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'SERVICE'),
(88, 'Ambulances ST BERNARD', NULL, NULL, NULL, NULL, NULL, NULL, 'Nos équipes d\'ambulanciers diplômés sont qualifiées pour répondre à toutes les situations d\'urgence. Nous sommes à votre écoute pour satisfaire vos besoins et vous transporter dans des conditions optimales de confort et de sécurité.  Nos véhicules climatisés sont récents et équipés de tout le matériel nécessaire au secours d\'urgence.  Vous pouvez nous joindre 24h/24 7j/7 par téléphone .', NULL, NULL, NULL, '', '', '', '', '', '', 1, 1, 'STBERNARD'),
(89, 'Ambulances PAC', '1984-11-09', '1 rue des PIOUPIOU', 69690, 'Villefranche', 123456789, 'iuiuh@ojbhj.fr', 'iouyvcfgd opiujhgf mlkjhgf molkjhgf mlkjhgf', 'poikjuh poiujhg mlk,nb poiujh polkijh mlkj plok j', '89-img1-.webp', '89-img2-.webp', '89-img3-.webp', '89-slider_1-.webp', '89-slider_2-.webp', '89-slider_3-.webp', '89-logo-.webp', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5580.678802522693!2d-1.0170524897353224!3d45.62391771865277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4801766f8e71c0d9%3A0xcf614f4f70730a0c!2sAmbulances%20Saint%20Bernard!5e0!3m2!1sfr!2sfr!4v1651141791374!5m2!1sfr!2sfr', 4, 1, 'PAC');

-- --------------------------------------------------------

--
-- Structure de la table `ambu_utilisateur`
--

DROP TABLE IF EXISTS `ambu_utilisateur`;
CREATE TABLE IF NOT EXISTS `ambu_utilisateur` (
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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ambu_utilisateur`
--

INSERT INTO `ambu_utilisateur` (`user_id`, `nom`, `prenom`, `adress`, `zip`, `ville`, `tel`, `mail`, `mdp`, `profil`, `anniv`, `fk_societe`, `active`) VALUES
(43, 'Pac', 'Pierre', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 608112179, 'pac.pierre@gmail.com', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 2, '1984-11-09', NULL, 1),
(49, 'Pac', 'client', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 608112179, 'pac.pierre@gmail.com', '590c9f8430c7435807df8ba9a476e3f1295d46ef210f6efae2043a4c085a569e', 0, '1984-11-09', 89, 1),
(50, 'Pac', 'r&eacute;gulation', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 608112179, 'pac.pierre@gmail.com', '1b4f0e9851971998e732078544c96b36c3d01cedf7caa332359d6f1d83567014', 1, '1984-11-09', 89, 1),
(51, 'Pac', 'Pierre', '', 12250, 'TOURNEMIRE', 608112179, 'pac.pierre@gmail.com', 'fd61a03af4f77d870fc21e05e7e80678095c92d808cfb3b5c279ee04c74aca13', 3, '1984-11-09', NULL, 1),
(52, 'pac', 'pierre', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 608112179, 'pac.pierre@gmail.com', 'a4e624d686e03ed2767c0abd85c14426b0b1157d2ce81d27bb4fe4f6f01d688a', 4, '1984-11-09', NULL, 1),
(53, 'VATEPO', 'Polo', '58 rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667215, 'service-achat@etoilesecours.fr', 'b61a6d542f9036550ba9c401c80f00ef', 0, '2001-06-14', 81, 0),
(54, 'TREAZ', 'Faon', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667213, 'abc@abc.fr', 'ab4f63f9ac65152575886860dde480a1', 0, '1982-03-23', 73, 1),
(55, 'popopo', 'popopo', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667213, 'test@etoilesecours.fr', 'b61a6d542f9036550ba9c401c80f00ef', 0, '1979-01-31', 73, 1),
(56, 'ppppppppppp', 'NELLY', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667213, 'service-achathtrhrthyr@etoilesecours.fr', 'b61a6d542f9036550ba9c401c80f00ef', 0, '2022-04-08', 71, 1),
(57, 'MONTEAUD', 'Nelly', '120 Rue Lucien Devaux', 17420, 'Saint-Palais-sur-Mer', 617667213, 'mikael.dejoie@etoilesecours.fr', 'b61a6d542f9036550ba9c401c80f00ef', 0, '2022-04-27', 37, 1),
(58, 'MONTEAUD', 'NELLY', 'rue du Docteur Brillaud', 79300, 'BRESSUISE', 617667213, 'etoilesecours@gmail.com', 'b61a6d542f9036550ba9c401c80f00ef', 0, '2022-04-14', 64, 1),
(59, 'Pac', 'Pierre', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 608112179, 'pac.pierre@gmail.com', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 2, '1984-11-09', 77, 1),
(60, 'Pac', 'Pierre', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 608112179, 'pac.pierre@gmail.com', '8482918e4705c6be210084c9d94e0fe2f45fcf4e79f2d5013c76e44fe1c95d43', 1, '1984-11-09', 72, 1),
(61, 'Pac', 'Pierre', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 608112179, 'pac.pierre@gmail.com', '590c9f8430c7435807df8ba9a476e3f1295d46ef210f6efae2043a4c085a569e', 0, '0984-11-09', 76, 1),
(62, 'Pac', 'Pierre', '25 Rue Fran&ccedil;aise', 12250, 'TOURNEMIRE', 608112179, 'pac.pierre@gmail.com', 'fd61a03af4f77d870fc21e05e7e80678095c92d808cfb3b5c279ee04c74aca13', 3, '1984-11-09', 73, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ambu_emploi`
--
ALTER TABLE `ambu_emploi`
  ADD CONSTRAINT `ambu_emploi_ibfk_1` FOREIGN KEY (`fk_societe`) REFERENCES `ambu_site_societe` (`id_societe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ambu_postulant`
--
ALTER TABLE `ambu_postulant`
  ADD CONSTRAINT `ambu_postulant_ibfk_1` FOREIGN KEY (`fk_emploi`) REFERENCES `ambu_emploi` (`emploi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ambu_rdv`
--
ALTER TABLE `ambu_rdv`
  ADD CONSTRAINT `ambu_rdv_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `ambu_utilisateur` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ambu_rdv_ibfk_2` FOREIGN KEY (`fk_societe`) REFERENCES `ambu_site_societe` (`id_societe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ambu_utilisateur`
--
ALTER TABLE `ambu_utilisateur`
  ADD CONSTRAINT `ambu_utilisateur_ibfk_1` FOREIGN KEY (`fk_societe`) REFERENCES `ambu_site_societe` (`id_societe`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
