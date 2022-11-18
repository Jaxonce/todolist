-- phpMyAdmin SQL Dump
-- version 5.0.4deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 18 nov. 2022 à 16:47
-- Version du serveur :  10.5.15-MariaDB-0+deb11u1
-- Version de PHP : 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbtrbarlet`
--

-- --------------------------------------------------------

--
-- Structure de la table `Tache`
--

CREATE TABLE `Tache` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `nom` varchar(50) NOT NULL,
                         `descriptionTache` varchar(200) DEFAULT NULL,
                         `importance` decimal(10,0) NOT NULL,
                         `dateCreation` date NOT NULL DEFAULT curdate(),
                         `dateModification` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Tache`
--

INSERT INTO `Tache` (`id`, `nom`, `descriptionTache`, `importance`, `dateCreation`, `dateModification`) VALUES
    (1, 'Faire le ménage', 'Faire le ménage de la maison', '1', '2022-11-08', '2022-11-08'),
    (2, 'Faire les courses', 'Faire les courses de la semaine', '3', '2022-11-08', '2022-11-08'),
    (3, 'Faire le repas', 'Faire le repas du soir', '2', '2022-11-08', '2022-11-08'),
    (4, 'Tondre', 'tondre le ptit coin au fond', '1', '2022-11-08', '2022-11-08'),
    (5, 'Manger', 'Les restes', '1', '2022-11-08', '2022-11-08'),
    (6, 'Dodo', NULL, '1', '2022-11-08', '2022-11-08'),
    (7, 'Mettre sa casquette', NULL, '1', '2022-11-08', '2022-11-08'),
    (8, 'réparer les pc', NULL, '1', '2022-11-08', '2022-11-08'),
    (9, 'Sortir les poubelles', NULL, '1', '2022-11-08', '2022-11-08'),
    (10, 'caresser le chien', NULL, '1', '2022-11-08', '2022-11-08'),

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Tache`
--
ALTER TABLE `Tache`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Tache`
--
ALTER TABLE `Tache`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;