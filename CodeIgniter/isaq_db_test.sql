-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 23 fév. 2019 à 12:07
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `isaq_db_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse_facturation`
--

CREATE TABLE `adresse_facturation` (
  `raison_sociale` varchar(50) NOT NULL,
  `fact_adresse_num_rue` varchar(10) NOT NULL,
  `fact_adresse_rue` varchar(30) NOT NULL,
  `fact_adresse_ville` varchar(30) NOT NULL,
  `fact_adresse_cp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `reference` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

CREATE TABLE `societe` (
  `ID` int(11) NOT NULL,
  `raison_sociale` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `adresse1` varchar(30) NOT NULL,
  `adresse2` varchar(30) NOT NULL,
  `adresse3` varchar(30) NOT NULL,
  `code_postal` int(5) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `pays` varchar(30) NOT NULL,
  `mail` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `societe`
--

INSERT INTO `societe` (`ID`, `raison_sociale`, `adresse`, `adresse1`, `adresse2`, `adresse3`, `code_postal`, `ville`, `pays`, `mail`) VALUES
(2, 'ISAQ', '31 ALLEE DES PERVENCHES', '', '', '', 91390, 'MORSANG', 'FRANCE', 0),
(5, 'ORANGE', '31 allee des pervenches', '', '', '', 91700, 'savigny', 'france', 0),
(6, 'ORANGE', '31 allee des pervenches', '', '', '', 91700, 'savigny', 'france', 0),
(7, 'tartempion', '31 allee des boulo', '', '', '', 1001, 'nice', 'france', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `raison_sociale` varchar(30) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `user_mdp` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID`, `nom`, `prenom`, `raison_sociale`, `mail`, `user_mdp`) VALUES
(62, 'MAGNAUDET', '', '', 'francois.magnaudet@orange.fr', 'a73220cceb2a2009ecceb1e84264b0dac576d59d');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `societe`
--
ALTER TABLE `societe`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `societe`
--
ALTER TABLE `societe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
