-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 14 avr. 2023 à 03:42
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pfe`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(3) NOT NULL,
  `nom_cat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `nom_cat`) VALUES
(1, 'cafe'),
(2, 'pizza'),
(3, 'sandwich'),
(4, 'plats');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id_c` int(3) NOT NULL,
  `total` int(20) NOT NULL,
  `serveur` varchar(20) NOT NULL,
  `isPaid` int(1) NOT NULL,
  `date_c` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id_c`, `total`, `serveur`, `isPaid`, `date_c`) VALUES
(1, 21, 'admin', 0, '2023-04-12 03:17:26'),
(2, 144, 'admin', 1, '2023-04-12 03:17:31'),
(3, 99, 'admin', 1, '2023-04-12 04:54:31'),
(4, 29, 'admin', 0, '2023-04-12 04:54:34'),
(5, 64, 'admin', 1, '2023-04-12 04:54:37'),
(6, 76, 'admin', 1, '2023-04-12 04:54:39'),
(7, 71, 'admin', 1, '2023-04-12 04:54:44'),
(8, 48, 'admin', 1, '2023-04-12 04:54:46'),
(9, 52, 'admin', 1, '2023-04-13 06:34:31'),
(10, 999, 'Wael', 1, '2023-03-01 06:46:56'),
(11, 999, 'Wael', 1, '2023-02-01 07:15:01'),
(12, 999, 'Wael', 1, '2023-01-01 07:16:38'),
(13, 34, 'admin', 1, '2023-04-14 01:01:43'),
(14, 37, 'admin', 1, '2023-04-14 01:41:40'),
(15, 64, 'admin', 1, '2023-04-14 01:41:43'),
(16, 29, 'admin', 1, '2023-04-14 01:41:46'),
(17, 416, 'admin', 1, '2023-04-14 01:41:51'),
(18, 93, 'admin', 1, '2023-04-14 02:33:33');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_p` int(3) NOT NULL,
  `nom_cat` varchar(20) NOT NULL,
  `nom_p` varchar(20) NOT NULL,
  `prix` decimal(7,0) NOT NULL,
  `photo` varchar(60) NOT NULL,
  `desc` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_p`, `nom_cat`, `nom_p`, `prix`, `photo`, `desc`) VALUES
(2, 'cafe', 'expresse', '3', '', ''),
(3, 'cafe', 'capucin', '4', '', ''),
(4, 'plats', 'loup', '30', 'loup.jpg', ''),
(5, 'plats', 'spaghetti bolonaise', '18', 'bolonaise.jpg', ''),
(6, 'plats', 'crunchy chicken', '22', 'crunchy.jpg', ''),
(7, 'pizza', 'pizza turc', '25', 'turc.jpg', ''),
(8, 'pizza', 'pizza fruit de mer', '28', 'fruit de mer.jpg', ''),
(9, 'pizza', 'pizza neptune', '18', 'neptune.jpg', '');

-- --------------------------------------------------------

--
-- Structure de la table `produit_commande`
--

CREATE TABLE `produit_commande` (
  `id_c` int(3) NOT NULL,
  `id_p` int(3) NOT NULL,
  `qte` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit_commande`
--

INSERT INTO `produit_commande` (`id_c`, `id_p`, `qte`) VALUES
(1, 2, 3),
(1, 3, 3),
(2, 4, 3),
(2, 5, 3),
(3, 2, 1),
(3, 4, 2),
(3, 5, 2),
(4, 3, 1),
(4, 2, 1),
(4, 6, 1),
(5, 8, 1),
(5, 5, 1),
(5, 9, 1),
(6, 5, 1),
(6, 4, 1),
(6, 8, 1),
(7, 9, 1),
(7, 8, 1),
(7, 7, 1),
(8, 5, 1),
(8, 4, 1),
(9, 4, 1),
(9, 3, 1),
(9, 5, 1),
(10, 5, 2),
(11, 5, 1),
(12, 5, 3),
(13, 3, 1),
(13, 4, 1),
(14, 4, 1),
(14, 3, 1),
(14, 2, 1),
(15, 9, 1),
(15, 8, 1),
(15, 5, 1),
(16, 3, 1),
(16, 7, 1),
(17, 9, 6),
(17, 8, 11),
(18, 2, 31);

-- --------------------------------------------------------

--
-- Structure de la table `tables`
--

CREATE TABLE `tables` (
  `id_table` int(3) NOT NULL,
  `nom_table` varchar(20) NOT NULL,
  `nb_place` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_uti` int(3) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  `isAdmin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_uti`, `nom`, `mdp`, `isAdmin`) VALUES
(1, 'admin', 'admin123', 1),
(2, 'aza', 'wael123', 1),
(3, 'test', 'wael123', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id_c`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `nom_cat` (`nom_cat`);

--
-- Index pour la table `produit_commande`
--
ALTER TABLE `produit_commande`
  ADD KEY `id_c` (`id_c`),
  ADD KEY `id_p` (`id_p`);

--
-- Index pour la table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id_table`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_uti`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_p` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `tables`
--
ALTER TABLE `tables`
  MODIFY `id_table` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_uti` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
