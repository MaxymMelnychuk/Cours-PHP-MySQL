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
-- Base de données : `library`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `idbook` int NOT NULL,
  `title` varchar(45) NOT NULL,
  `author` varchar(45) NOT NULL,
  `date_publication` date NOT NULL,
  `availability` int DEFAULT NULL
) ;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`idbook`, `title`, `author`, `date_publication`, `availability`) VALUES
(31, 'Le Petit Prince', 'Antoine de Saint-Exupéry', '1943-01-01', 7),
(33, 'Les Misérables', 'Victor Hugo', '1862-04-03', 15),
(34, 'L\'Étranger', 'Albert Camus', '1942-05-19', 24),
(35, 'Le Seigneur des Anneaux', 'J.R.R. Tolkien', '1954-07-29', 40),
(36, 'Harry Potter à l\'école des sorciers', 'J.K. Rowling', '1997-06-26', 28),
(37, 'Fahrenheit 451', 'Ray Bradbury', '1953-10-19', 17),
(38, 'Don Quichotte', 'Miguel de Cervantes', '1605-01-16', 12),
(39, 'La Peste', 'Albert Camus', '1947-06-10', 21),
(40, 'Crime et Châtiment', 'Fiodor Dostoïevski', '1866-01-01', 10),
(41, 'La Divine Comédie', 'Dante Alighieri', '1320-01-01', 11),
(42, 'Le Comte de Monte-Cristo', 'Alexandre Dumas', '1844-08-28', 26),
(43, 'À la recherche du temps perdu', 'Marcel Proust', '1913-11-14', 14),
(44, 'Le Nom de la rose', 'Umberto Eco', '1980-10-01', 19),
(45, 'Les Fleurs du mal', 'Charles Baudelaire', '1857-06-25', 33),
(46, 'Le Parfum', 'Patrick Süskind', '1985-10-01', 9),
(47, 'Le Meilleur des mondes', 'Aldous Huxley', '1932-01-01', 45),
(48, 'Jane Eyre', 'Charlotte Brontë', '1847-10-16', 20),
(49, 'L\'île mystérieuse', 'Jules Verne', '1874-01-01', 13),
(50, 'Orgueil et Préjugés', 'Jane Austen', '1813-01-28', 38),
(51, '1984', 'ok', '2025-04-03', 5);

-- --------------------------------------------------------

--
-- Structure de la table `table1`
--

CREATE TABLE `table1` (
  `idtable1` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `iduser` int NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`iduser`, `email`, `password`, `username`) VALUES
(1, 'rgergerg@gr', '$2y$10$ctTWbZ4YR5Hazh6jy3wCnuxJKsTxvD21xmMVF4Q1ITq26KhNJXrvK', NULL),
(2, 'rgergerg@gr', '$2y$10$nKcheMMGyvx3CVqD2KnlIOekP.TSK/n5/3.Axr/4MwSfJMaCv.eqi', NULL),
(3, 'dfgdfg', '$2y$10$SRsAhTJvm9oLYofgRfrUD.reETLVE.ZxVkq8raHOj.G5B.TxjAuNq', NULL),
(4, 'azerty', '$2y$10$WFkRJsNhn7isqAfJqoCZp.iMX97nd8AEvS4rRBhvBaPg9vPr2B5xW', NULL),
(5, 'dfgdf@fgdf', '$2y$10$5mb0bhipedWxqxYR7WFQLuvIZSFim1ggZqHhqixLCyKptsuCcWIPq', NULL),
(6, 'dfgd@dfg', '$2y$10$faNFEHr21t362Bt4NO0Je.8ka77QLswkMUkULZoBD.MQVvn89vbSy', NULL),
(7, 'dfgd@dfg', '$2y$10$qqux1oDSzwScMfsH2V1eNeDvIRkQDZCjzBj9Qzb7jSVbl7SmKf./W', NULL),
(8, 'dfgd@dfg', '$2y$10$0f4sopBIzw/.q.O0Wz4UX.phOOSD/TOQRSzHuM8dSQNJ8nkYuBDYi', NULL),
(9, 'dfgd@dfg', '$2y$10$nuuM.g706scf6E9fVHJs2O4nUgH9mLmlxAjxnNWMCrCF30cC9dp1y', NULL),
(10, 'aka@df', '$2y$10$LVLb4ZSbLDojnk3kLz0Wi.WfzS.Xp7cp9IK4PVD/MFmDadYUPBjIS', 'lolOKKKK'),
(11, 'yjtyj@tyj', '$2y$10$DHKlQL4PZkphaAbBElpqBuBxtnb4BdJUL9sunRNgTvbRkcI4OyEHa', 'azerty'),
(12, 'azerty@ok', '$2y$10$46nscCrzBsl1L/sU6uzP8e3ENkkAcELapaXf7ga4YMLwKPuuGAATK', 'azerty'),
(13, 'maxym@ok', '$2y$10$TcScvc2FJslIpJKrae8FgujR4BAYTi4FtmSSi.yDMOSAOOG3uIOgW', 'azerty');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`idbook`);

--
-- Index pour la table `table1`
--
ALTER TABLE `table1`
  ADD PRIMARY KEY (`idtable1`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `idbook` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `table1`
--
ALTER TABLE `table1`
  MODIFY `idtable1` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
