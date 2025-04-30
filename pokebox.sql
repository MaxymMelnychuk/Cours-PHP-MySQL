-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 30 avr. 2025 à 17:02
-- Version du serveur : 8.4.3
-- Version de PHP : 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pokebox`
--

-- --------------------------------------------------------

--
-- Structure de la table `cards`
--

CREATE TABLE `cards` (
  `idcard` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `atk` int DEFAULT NULL,
  `def` int DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `cards`
--

INSERT INTO `cards` (`idcard`, `name`, `atk`, `def`, `description`) VALUES
(47, 'Pikachu', 55, 40, 'Un Pokémon électrique rapide et mignon.'),
(48, 'Bulbizarre', 49, 49, 'Un Pokémon plante/poison avec un bulbe sur le dos.'),
(49, 'Salamèche', 52, 43, 'Un Pokémon de type feu avec une flamme au bout de la queue.'),
(50, 'Carapuce', 48, 65, 'Un petit Pokémon eau avec une carapace protectrice.'),
(51, 'Rondoudou', 45, 20, 'Un Pokémon rose qui endort ses ennemis avec son chant.'),
(52, 'Dracaufeu', 84, 78, 'Un dragon cracheur de feu puissant et majestueux.'),
(53, 'Florizarre', 82, 83, 'Une évolution de Bulbizarre dotée d’une grande fleur.'),
(54, 'Tortank', 83, 100, 'Une tortue géante avec des canons à eau.'),
(55, 'Evoli', 55, 50, 'Un Pokémon adaptable avec de nombreuses évolutions.'),
(56, 'Mewtwo', 110, 90, 'Un Pokémon légendaire cloné doté de puissants pouvoirs psychiques.'),
(57, 'Noctali', 65, 110, 'Un Pokémon sombre et élégant qui excelle en défense.'),
(58, 'Mentali', 65, 60, 'Un Pokémon psychique rapide et intelligent.'),
(59, 'Dracolosse', 134, 95, 'Un puissant dragon au cœur doux et au vol impressionnant.'),
(60, 'Léviator', 125, 79, 'Un serpent de mer furieux à la puissance destructrice.'),
(61, 'Alakazam', 50, 45, 'Un maître des attaques psychiques à l’intelligence hors norme.'),
(62, 'Roucarnage', 80, 75, 'Un oiseau majestueux et rapide, maître des airs.'),
(63, 'Steelix', 85, 200, 'Un serpent de métal extrêmement résistant.'),
(64, 'Togekiss', 50, 95, 'Un Pokémon gracieux qui apporte chance et bonheur.'),
(65, 'Lucario', 110, 70, 'Un combattant doué d’aura, rapide et puissant.'),
(66, 'Tyranocif', 134, 110, 'Un géant de roche et ténèbres, aussi puissant que redouté.'),
(68, 'AZERTY', 23, 45, 'FFGRGERGER'),
(70, 'PIKACHU', 34, 55, 'JKKJHUI');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `iduser` int NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`iduser`, `email`, `password`, `username`) VALUES
(1, 'aka@df', '$2y$10$GI5jyonbg2ulGSAv3BJzDOu4q8OduYW2u.IqrLXgu3ZLf2hpwNRti', 'lolOKKKK');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`idcard`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cards`
--
ALTER TABLE `cards`
  MODIFY `idcard` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
