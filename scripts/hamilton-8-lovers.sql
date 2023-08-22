-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : Dim 20 août 2023 à 13:13
-- Version du serveur :  8.0.21-0ubuntu0.20.04.4
-- Version de PHP : 7.4.3-4ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hamilton-8-lovers`
--

-- --------------------------------------------------------

--
-- Structure de la table `Hikes`
--

CREATE TABLE `Hikes` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `distance` varchar(180) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `elevation_gain` varchar(10) DEFAULT NULL,
  `description` text,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Hikes`
--

INSERT INTO `Hikes` (`id`, `name`, `distance`, `duration`, `elevation_gain`, `description`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'rando becode', '8km', '2heures', '250.00', NULL, '2023-08-14', '2023-08-14', 8),
(3, 'Circuit de baumes', '13,58 km', '5h10', '451.00', 'n venant de Méjannes-le-Clap sur la D167, 2 km environ plus loin, prendre la route qui se transforme en piste sur la gauche et qui passe devant le Mas de la Taillade. Se garer à quelques mètres de la jonction avec une autre piste.\r\n\r\n(D/A) Revenir au croisement des deux pistes et prendre à gauche celle qui indique la direction de l\'Aven de Peyre Haute. À un croisement, aller tout droit et faire de même à l\'intersection suivante (cote 318). Quelques centaines de mètres après, atteindre une nouvelle intersection.\r\n\r\n(1) Emprunter un sentier sur la gauche qui mène tout d\'abord au niveau de la partie supérieure de l\'aven. Le sentier, entièrement sécurisé, en fait le tour. N.B. La trace GPS à cet endroit semble se chevaucher, ce qui est normal puisque en premier lieu, on se trouve sur la partie supérieure de l\'aven alors qu\'ensuite on se situe sur la partie inférieure. De retour sur le chemin, descendre sur la gauche pour atteindre l\'entrée de l\'aven et faire un aller-retour en se baissant au niveau de l\'entrée pour aller jusqu\'au fond. De retour sur le sentier, le suivre à gauche.', '2023-08-16', '2023-08-16', 3),
(4, 'hike test', '10km', '2h', '400m', 'this is a description', NULL, NULL, 3),
(5, 'hike test 2', '10km', '2h', '400m', 'this is a description', NULL, NULL, 3),
(6, 'hike test3', '10km', '2h', '400m', 'this is a description', NULL, NULL, 4),
(7, 'hike test4', '10km', '2h', '400m', 'this is a description', NULL, NULL, 4),
(8, 'becode2', '12', '3', '210', 'facile', NULL, NULL, 8);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Hikes`
--
ALTER TABLE `Hikes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relation user` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Hikes`
--
ALTER TABLE `Hikes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
