-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 12 Mars 2014 à 23:22
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bdprojetweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `idAdresse` int(3) NOT NULL AUTO_INCREMENT,
  `numVoieAdresse` int(3) DEFAULT NULL,
  `nomVoieAdresse` varchar(50) DEFAULT NULL,
  `cptAdresse` varchar(50) DEFAULT NULL,
  `codePostalAdresse` varchar(5) DEFAULT NULL,
  `villeAdresse` varchar(50) DEFAULT NULL,
  `dptAdresse` varchar(50) DEFAULT NULL,
  `regionAdresse` varchar(25) DEFAULT NULL,
  `paysAdresse` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idAdresse`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`idAdresse`, `numVoieAdresse`, `nomVoieAdresse`, `cptAdresse`, `codePostalAdresse`, `villeAdresse`, `dptAdresse`, `regionAdresse`, `paysAdresse`) VALUES
(16, 12, 'Rue du Coquelicot', 'TestCe', '64002', 'Bordeaux', 'Billa', 'Billo', 'Billu'),
(18, 12, 'Rue du Boloss', 'Boloss', '64020', 'B', 'A', 'T', 'O');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE IF NOT EXISTS `contenir` (
  `idEvent` int(5) NOT NULL AUTO_INCREMENT,
  `idImage` int(5) NOT NULL,
  PRIMARY KEY (`idEvent`,`idImage`),
  KEY `FK_Contenir_idImage` (`idImage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `envoyer`
--

CREATE TABLE IF NOT EXISTS `envoyer` (
  `idEvent` int(5) NOT NULL AUTO_INCREMENT,
  `idMessage` int(5) NOT NULL,
  `loginUser` varchar(25) NOT NULL,
  PRIMARY KEY (`idEvent`,`idMessage`,`loginUser`),
  KEY `FK_Envoyer_idMessage` (`idMessage`),
  KEY `FK_Envoyer_loginUser` (`loginUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `idEvent` int(5) NOT NULL AUTO_INCREMENT,
  `nomEvent` varchar(25) DEFAULT NULL,
  `nbParticipantsMax` int(4) DEFAULT NULL,
  `nbParticipantsMin` int(4) DEFAULT NULL,
  `prixEvent` float DEFAULT NULL,
  `descriptionEvent` text,
  `debutEvent` datetime DEFAULT NULL,
  `finEvent` datetime DEFAULT NULL,
  `idAdresse` int(3) NOT NULL,
  PRIMARY KEY (`idEvent`),
  KEY `FK_EVENEMENT_idAdresse` (`idAdresse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `idImage` int(5) NOT NULL AUTO_INCREMENT,
  `nomImage` varchar(50) DEFAULT NULL,
  `cibleImage` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`idImage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`idImage`, `nomImage`, `cibleImage`) VALUES
(15, 'fa7f14062c371da18ec7c3e524fd35f7', './img/avatar./.fa7f14062c371da18ec7c3e524fd35f7.png'),
(17, 'd7849f7d214fe75fed753737f5ef6ad5', './img/avatar./.d7849f7d214fe75fed753737f5ef6ad5.png');

-- --------------------------------------------------------

--
-- Structure de la table `inscrire`
--

CREATE TABLE IF NOT EXISTS `inscrire` (
  `idParticipant` int(4) NOT NULL AUTO_INCREMENT,
  `idEvent` int(5) NOT NULL,
  `statutInscription` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`idParticipant`,`idEvent`),
  KEY `FK_Inscrire_idEvent` (`idEvent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `idMessage` int(5) NOT NULL AUTO_INCREMENT,
  `sujetMessage` varchar(100) DEFAULT NULL,
  `texteMessage` text,
  `dateMessage` date DEFAULT NULL,
  `heureMessage` time DEFAULT NULL,
  PRIMARY KEY (`idMessage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `organisateur`
--

CREATE TABLE IF NOT EXISTS `organisateur` (
  `idOrganisateur` int(3) NOT NULL AUTO_INCREMENT,
  `nomOrganisateur` varchar(25) DEFAULT NULL,
  `typeOrganisateur` varchar(25) DEFAULT NULL,
  `nomRef` varchar(25) DEFAULT NULL,
  `prenomRef` varchar(25) DEFAULT NULL,
  `telRef` varchar(10) DEFAULT NULL,
  `mailRef` varchar(50) DEFAULT NULL,
  `loginUser` varchar(25) NOT NULL,
  `idAdresse` int(3) NOT NULL,
  PRIMARY KEY (`idOrganisateur`),
  KEY `FK_ORGANISATEUR_loginUser` (`loginUser`),
  KEY `FK_ORGANISATEUR_idAdresse` (`idAdresse`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `organisateur`
--

INSERT INTO `organisateur` (`idOrganisateur`, `nomOrganisateur`, `typeOrganisateur`, `nomRef`, `prenomRef`, `telRef`, `mailRef`, `loginUser`, `idAdresse`) VALUES
(4, 'Toto', 'A', 'Laurent', 'Bouchard', '0559555025', 'laurentbouchard@org2.fr', 'testorganisateur2', 18);

-- --------------------------------------------------------

--
-- Structure de la table `organiser`
--

CREATE TABLE IF NOT EXISTS `organiser` (
  `idOrganisateur` int(3) NOT NULL AUTO_INCREMENT,
  `idEvent` int(5) NOT NULL,
  PRIMARY KEY (`idOrganisateur`,`idEvent`),
  KEY `FK_Organiser_idEvent` (`idEvent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
  `idParticipant` int(4) NOT NULL AUTO_INCREMENT,
  `nomParticipant` varchar(25) DEFAULT NULL,
  `prenomParticipant` varchar(25) DEFAULT NULL,
  `genreParticipant` varchar(1) DEFAULT NULL,
  `dateNaissanceParticipant` date DEFAULT NULL,
  `loginUser` varchar(25) NOT NULL,
  `idAdresse` int(3) NOT NULL,
  PRIMARY KEY (`idParticipant`),
  KEY `FK_PARTICIPANT_loginUser` (`loginUser`),
  KEY `FK_PARTICIPANT_idAdresse` (`idAdresse`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `participant`
--

INSERT INTO `participant` (`idParticipant`, `nomParticipant`, `prenomParticipant`, `genreParticipant`, `dateNaissanceParticipant`, `loginUser`, `idAdresse`) VALUES
(10, 'participant', 'test', NULL, '1993-11-02', 'testparticipant', 16);

-- --------------------------------------------------------

--
-- Structure de la table `regrouper`
--

CREATE TABLE IF NOT EXISTS `regrouper` (
  `idEvent` int(5) NOT NULL AUTO_INCREMENT,
  `idSport` int(4) NOT NULL,
  PRIMARY KEY (`idEvent`,`idSport`),
  KEY `FK_Regrouper_idSport` (`idSport`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sport`
--

CREATE TABLE IF NOT EXISTS `sport` (
  `idSport` int(4) NOT NULL AUTO_INCREMENT,
  `nomSport` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idSport`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `loginUser` varchar(25) NOT NULL,
  `mdpUser` varchar(128) DEFAULT NULL,
  `mailUser` varchar(50) DEFAULT NULL,
  `telUser` varchar(10) DEFAULT NULL,
  `descUser` text,
  `idImage` int(5) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  PRIMARY KEY (`loginUser`),
  KEY `FK_UTILISATEUR_idImage` (`idImage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`loginUser`, `mdpUser`, `mailUser`, `telUser`, `descUser`, `idImage`, `isAdmin`) VALUES
('testorganisateur2', '91bbdf7a18528fea4693549a2e7e48142f2476c9f948c2eec0b9e5da9e7bcffb56938c1981cac7c705e741bcbaf8feb89c4bdbf8a55e73b8fe75b2eb504e35d8', 'test@testorg2.fr', '0559555026', 'Super organisation', 17, 0),
('testparticipant', 'd38549abe9c821c1ee21c6511204d4427fb8c596fd8c3459ee38322390873598600add9be9409931427a5bbd0fb1c6bb3ffc109ebae041c0ee0a611b22daefda', 'test@test.fr', '0559555026', 'La vie c''est pas mal ;)', 15, 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_Contenir_idEvent` FOREIGN KEY (`idEvent`) REFERENCES `evenement` (`idEvent`),
  ADD CONSTRAINT `FK_Contenir_idImage` FOREIGN KEY (`idImage`) REFERENCES `image` (`idImage`);

--
-- Contraintes pour la table `envoyer`
--
ALTER TABLE `envoyer`
  ADD CONSTRAINT `FK_Envoyer_idEvent` FOREIGN KEY (`idEvent`) REFERENCES `evenement` (`idEvent`),
  ADD CONSTRAINT `FK_Envoyer_idMessage` FOREIGN KEY (`idMessage`) REFERENCES `message` (`idMessage`),
  ADD CONSTRAINT `FK_Envoyer_loginUser` FOREIGN KEY (`loginUser`) REFERENCES `utilisateur` (`loginUser`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `FK_EVENEMENT_idAdresse` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`idAdresse`);

--
-- Contraintes pour la table `inscrire`
--
ALTER TABLE `inscrire`
  ADD CONSTRAINT `FK_Inscrire_idEvent` FOREIGN KEY (`idEvent`) REFERENCES `evenement` (`idEvent`),
  ADD CONSTRAINT `FK_Inscrire_idParticipant` FOREIGN KEY (`idParticipant`) REFERENCES `participant` (`idParticipant`);

--
-- Contraintes pour la table `organisateur`
--
ALTER TABLE `organisateur`
  ADD CONSTRAINT `FK_ORGANISATEUR_idAdresse` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`idAdresse`),
  ADD CONSTRAINT `FK_ORGANISATEUR_loginUser` FOREIGN KEY (`loginUser`) REFERENCES `utilisateur` (`loginUser`);

--
-- Contraintes pour la table `organiser`
--
ALTER TABLE `organiser`
  ADD CONSTRAINT `FK_Organiser_idEvent` FOREIGN KEY (`idEvent`) REFERENCES `evenement` (`idEvent`),
  ADD CONSTRAINT `FK_Organiser_idOrganisateur` FOREIGN KEY (`idOrganisateur`) REFERENCES `organisateur` (`idOrganisateur`);

--
-- Contraintes pour la table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `FK_PARTICIPANT_idAdresse` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`idAdresse`),
  ADD CONSTRAINT `FK_PARTICIPANT_loginUser` FOREIGN KEY (`loginUser`) REFERENCES `utilisateur` (`loginUser`);

--
-- Contraintes pour la table `regrouper`
--
ALTER TABLE `regrouper`
  ADD CONSTRAINT `FK_Regrouper_idEvent` FOREIGN KEY (`idEvent`) REFERENCES `evenement` (`idEvent`),
  ADD CONSTRAINT `FK_Regrouper_idSport` FOREIGN KEY (`idSport`) REFERENCES `sport` (`idSport`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_UTILISATEUR_idImage` FOREIGN KEY (`idImage`) REFERENCES `image` (`idImage`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
