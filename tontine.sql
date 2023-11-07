-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 15 juin 2023 à 23:13
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tontine`
--

-- --------------------------------------------------------

--
-- Structure de la table `associations`
--

DROP TABLE IF EXISTS `associations`;
CREATE TABLE IF NOT EXISTS `associations` (
  `associations_ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `slogan` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `date_creation` date NOT NULL,
  `ville` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`associations_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `associations`
--

INSERT INTO `associations` (`associations_ID`, `nom`, `slogan`, `logo`, `localisation`, `date_creation`, `ville`, `email`) VALUES
(1, 'AJEBD', 'L\"union fais la force', 'AJEBD', 'Missoke', '2023-12-03', 'Douala', 'taneyemc@gmail.com'),
(2, 'ONE-MOp', '', '', 'Quartier-bafang', '2023-06-13', 'Buba-Penja', 'onemop@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `banques`
--

DROP TABLE IF EXISTS `banques`;
CREATE TABLE IF NOT EXISTS `banques` (
  `banques_ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom_banque` varchar(255) DEFAULT NULL,
  `montant_max` float DEFAULT NULL,
  `montant_min` float DEFAULT NULL,
  PRIMARY KEY (`banques_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `banques`
--

INSERT INTO `banques` (`banques_ID`, `nom_banque`, `montant_max`, `montant_min`) VALUES
(1, 'Banque scolaire', 2000, 30000);

-- --------------------------------------------------------

--
-- Structure de la table `caisses`
--

DROP TABLE IF EXISTS `caisses`;
CREATE TABLE IF NOT EXISTS `caisses` (
  `caisses_ID` int(11) NOT NULL AUTO_INCREMENT,
  `associations_ID` int(11) NOT NULL,
  `nom_caisse` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`caisses_ID`),
  KEY `associations_ID` (`associations_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `caisses`
--

INSERT INTO `caisses` (`caisses_ID`, `associations_ID`, `nom_caisse`, `description`) VALUES
(1, 1, 'fon de fonctionnement', 'fond de fonctionnement');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `contenir_ID` int(11) NOT NULL,
  `membres_ID` int(11) NOT NULL,
  `sessionss_ID` int(11) NOT NULL,
  `montant_a_cotiser` float NOT NULL,
  `ordre_a_bouffer` int(11) DEFAULT NULL,
  `montant_bouffer` float NOT NULL,
  `reunions_ID` int(11) NOT NULL,
  PRIMARY KEY (`contenir_ID`),
  KEY `membres_ID` (`membres_ID`),
  KEY `sessionss_ID` (`sessionss_ID`),
  KEY `reunions_ID` (`reunions_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cotisations`
--

DROP TABLE IF EXISTS `cotisations`;
CREATE TABLE IF NOT EXISTS `cotisations` (
  `cotisations_ID` int(11) NOT NULL AUTO_INCREMENT,
  `reunions_ID` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `montant` float NOT NULL,
  `cotiser_ID` int(11) NOT NULL,
  `montant2` float NOT NULL,
  `numMontant` int(11) NOT NULL,
  PRIMARY KEY (`cotisations_ID`),
  KEY `reunions_ID` (`reunions_ID`),
  KEY `cotiser_ID` (`cotiser_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cotiser`
--

DROP TABLE IF EXISTS `cotiser`;
CREATE TABLE IF NOT EXISTS `cotiser` (
  `cotiser_ID` int(11) NOT NULL AUTO_INCREMENT,
  `montant` float NOT NULL,
  `reunions_ID` int(11) NOT NULL,
  `contenir_ID` int(11) NOT NULL,
  PRIMARY KEY (`cotiser_ID`),
  KEY `reunions_ID` (`reunions_ID`),
  KEY `contenir_ID` (`contenir_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `depots`
--

DROP TABLE IF EXISTS `depots`;
CREATE TABLE IF NOT EXISTS `depots` (
  `depos_ID` int(11) NOT NULL AUTO_INCREMENT,
  `membres_ID` int(11) NOT NULL,
  `sessions_banques_ID` int(11) NOT NULL,
  `montant` float NOT NULL,
  `reunions_ID` int(11) NOT NULL,
  `contenir_ID` int(11) NOT NULL,
  `caisses_ID` int(11) NOT NULL,
  PRIMARY KEY (`depos_ID`),
  KEY `membres_ID` (`membres_ID`),
  KEY `sessions_banque_ID` (`sessions_banques_ID`),
  KEY `reunions_ID` (`reunions_ID`),
  KEY `caisses_ID` (`caisses_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `license`
--

DROP TABLE IF EXISTS `license`;
CREATE TABLE IF NOT EXISTS `license` (
  `license_ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `durree` int(11) NOT NULL,
  PRIMARY KEY (`license_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `license`
--

INSERT INTO `license` (`license_ID`, `nom`, `prix`, `durree`) VALUES
(12, 'GOLD', 2000000, 2);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `membres_ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `telephone` int(11) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `fond` int(11) NOT NULL,
  `date_nais` date DEFAULT NULL,
  `statu` varchar(255) NOT NULL,
  `associations_ID` int(11) NOT NULL,
  PRIMARY KEY (`membres_ID`),
  KEY `associations_ID` (`associations_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`membres_ID`, `nom`, `prenom`, `telephone`, `ville`, `mail`, `genre`, `localisation`, `fond`, `date_nais`, `statu`, `associations_ID`) VALUES
(1, 'Teneyem', 'Desto', 679353205, 'Douala', 'teneyemdesto@gmail.com', 'masculin', 'missoke', 20000, '2000-04-04', 'membre', 1);

-- --------------------------------------------------------

--
-- Structure de la table `operations`
--

DROP TABLE IF EXISTS `operations`;
CREATE TABLE IF NOT EXISTS `operations` (
  `operations_ID` int(11) NOT NULL AUTO_INCREMENT,
  `montant_a_cotiser` int(11) NOT NULL,
  `date_operation` date NOT NULL,
  PRIMARY KEY (`operations_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

DROP TABLE IF EXISTS `participer`;
CREATE TABLE IF NOT EXISTS `participer` (
  `participer_ID` int(11) NOT NULL AUTO_INCREMENT,
  `membres_ID` int(11) NOT NULL,
  `reunion_ID` int(11) NOT NULL,
  `montant_a_cotiser` int(11) NOT NULL,
  `montant_a_bouffer` int(11) NOT NULL,
  PRIMARY KEY (`participer_ID`),
  KEY `membres_ID` (`membres_ID`),
  KEY `reunion_ID` (`reunion_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `prets`
--

DROP TABLE IF EXISTS `prets`;
CREATE TABLE IF NOT EXISTS `prets` (
  `prets_ID` int(11) NOT NULL AUTO_INCREMENT,
  `montant` float NOT NULL,
  `reunions_ID` int(11) NOT NULL,
  `contenir_ID` int(11) NOT NULL,
  `caisses_ID` int(11) NOT NULL,
  PRIMARY KEY (`prets_ID`),
  KEY `reunions_ID` (`reunions_ID`),
  KEY `contenir_ID` (`contenir_ID`),
  KEY `caisses_ID` (`caisses_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reunions`
--

DROP TABLE IF EXISTS `reunions`;
CREATE TABLE IF NOT EXISTS `reunions` (
  `reunions_ID` int(11) NOT NULL AUTO_INCREMENT,
  `sessionss_ID` int(11) DEFAULT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `total_cotisation` int(11) DEFAULT NULL,
  `localisation` varchar(255) NOT NULL,
  `date_reunion` date DEFAULT NULL,
  `associations_ID` int(11) NOT NULL,
  `titre_reunion` varchar(255) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `contenir_ID` int(11) NOT NULL,
  `contenir_ID2` varchar(255) NOT NULL,
  PRIMARY KEY (`reunions_ID`),
  UNIQUE KEY `contenir_ID2` (`reunions_ID`),
  UNIQUE KEY `membres_ID` (`reunions_ID`),
  KEY `sessionss_ID` (`sessionss_ID`),
  KEY `associations_ID` (`associations_ID`),
  KEY `contenir_ID` (`contenir_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reunions`
--

INSERT INTO `reunions` (`reunions_ID`, `sessionss_ID`, `heure_debut`, `heure_fin`, `total_cotisation`, `localisation`, `date_reunion`, `associations_ID`, `titre_reunion`, `commentaire`, `contenir_ID`, `contenir_ID2`) VALUES
(1, NULL, '23:26:00', '12:25:00', NULL, 'bepanda', '2023-06-13', 1, 'reunion2', 'Tous le monde etaient present', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `sanctions`
--

DROP TABLE IF EXISTS `sanctions`;
CREATE TABLE IF NOT EXISTS `sanctions` (
  `sanctions_ID` int(11) NOT NULL AUTO_INCREMENT,
  `associations_ID` int(11) NOT NULL,
  `cause` varchar(255) NOT NULL,
  `montant` int(11) NOT NULL,
  `statut` int(1) NOT NULL,
  `delait` date NOT NULL,
  PRIMARY KEY (`sanctions_ID`),
  KEY `associations_ID` (`associations_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sessionss`
--

DROP TABLE IF EXISTS `sessionss`;
CREATE TABLE IF NOT EXISTS `sessionss` (
  `sessionss_ID` int(11) NOT NULL AUTO_INCREMENT,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `durree` int(11) NOT NULL DEFAULT '1',
  `type_bouffe` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `associations_ID` int(11) NOT NULL,
  `nb_bouffer` int(11) NOT NULL,
  PRIMARY KEY (`sessionss_ID`),
  KEY `associations_ID` (`associations_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sessionss`
--

INSERT INTO `sessionss` (`sessionss_ID`, `date_debut`, `date_fin`, `durree`, `type_bouffe`, `titre`, `associations_ID`, `nb_bouffer`) VALUES
(6, '2023-06-01', '2023-08-01', 2, 'alphabetique', 'session2', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `session_banques`
--

DROP TABLE IF EXISTS `session_banques`;
CREATE TABLE IF NOT EXISTS `session_banques` (
  `session_banques_ID` int(11) NOT NULL AUTO_INCREMENT,
  `date_ouverture` date DEFAULT NULL,
  `date_fermeture` date DEFAULT NULL,
  `banques_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`session_banques_ID`),
  KEY `banques_ID` (`banques_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `souscrire`
--

DROP TABLE IF EXISTS `souscrire`;
CREATE TABLE IF NOT EXISTS `souscrire` (
  `souscrire_ID` int(11) NOT NULL AUTO_INCREMENT,
  `licenses_ID` int(11) NOT NULL,
  `associations_ID` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`souscrire_ID`),
  KEY `licenses_ID` (`licenses_ID`),
  KEY `associations_ID` (`associations_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `users_ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `localisation` varchar(255) DEFAULT NULL,
  `associations_ID` int(11) NOT NULL,
  `date_nais` date DEFAULT NULL,
  PRIMARY KEY (`users_ID`),
  KEY `associations_ID` (`associations_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`users_ID`, `nom`, `prenom`, `email`, `telephone`, `role`, `genre`, `mot_de_passe`, `localisation`, `associations_ID`, `date_nais`) VALUES
(9, 'Taneyem', 'capo', 'taneyemc@gmail.com', 679417229, 'admin', 'masculin', '$2y$10$hCpxj6Ia.D9WGDmO/UiVCODKzAM8FfZnO4ngsdU3JpnpnCW0/BgAK', 'missoke', 0, '2023-06-05'),
(10, 'Kuete', 'Fresnel', 'kuetefresnel@gmail.com', 680917974, 'user', 'masculin', '$2y$10$hCpxj6Ia.D9WGDmO/UiVCODKzAM8FfZnO4ngsdU3JpnpnCW0/BgAK', 'missoke', 1, '2004-04-04'),
(11, 'Siyapdje', 'rudel', 'siyapdjerudel@gmail.com', 679353205, 'Utilisateur', 'feminin', '$2y$10$1kJ04xFiR8GlB3JiJsSn4ehCGxGWmwZVTOK/D5vgnLSfREplJGIP.', 'Tompu', 2, '2023-06-21');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `reunions`
--
ALTER TABLE `reunions` ADD FULLTEXT KEY `contenir_ID2_2` (`contenir_ID2`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
