-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  ven. 05 juil. 2019 à 10:59
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `gestionClubEscrime`
--

-- --------------------------------------------------------

--
-- Structure de la table `arbitre`
--

CREATE TABLE `arbitre` (
  `id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `arme`
--

CREATE TABLE `arme` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `arme`
--

INSERT INTO `arme` (`id`, `nom`) VALUES
(1, 'epee'),
(2, 'fleuron'),
(4, 'sabre');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_lecon`
--

CREATE TABLE `commentaire_lecon` (
  `id` int(11) NOT NULL,
  `lecon_id` int(11) DEFAULT NULL,
  `ecrit_par_id` int(11) NOT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_objectif`
--

CREATE TABLE `commentaire_objectif` (
  `id` int(11) NOT NULL,
  `objectif_id` int(11) DEFAULT NULL,
  `ecrit_par_id` int(11) NOT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `competition`
--

CREATE TABLE `competition` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `competition`
--

INSERT INTO `competition` (`id`, `nom`, `date`, `ville`) VALUES
(1, 'competition Noel', '2020-01-01 00:00:00', 'Roubaix'),
(2, 'competition Noel', '2020-01-01 00:00:00', 'Roubaix'),
(3, 'competition Noel', '2020-01-01 00:00:00', 'Roubaix');

-- --------------------------------------------------------

--
-- Structure de la table `competition_arbitre`
--

CREATE TABLE `competition_arbitre` (
  `competition_id` int(11) NOT NULL,
  `arbitre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `competition_niveau`
--

CREATE TABLE `competition_niveau` (
  `competition_id` int(11) NOT NULL,
  `niveau_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `competition_niveau`
--

INSERT INTO `competition_niveau` (`competition_id`, `niveau_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `competition_tireur`
--

CREATE TABLE `competition_tireur` (
  `competition_id` int(11) NOT NULL,
  `tireur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `competition_tireur`
--

INSERT INTO `competition_tireur` (`competition_id`, `tireur_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `entrainement`
--

CREATE TABLE `entrainement` (
  `id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entrainement`
--

INSERT INTO `entrainement` (`id`, `groupe_id`, `date`) VALUES
(7, 1, '2014-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `entrainement_maitre_arme`
--

CREATE TABLE `entrainement_maitre_arme` (
  `entrainement_id` int(11) NOT NULL,
  `maitre_arme_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `entrainement_tireur`
--

CREATE TABLE `entrainement_tireur` (
  `entrainement_id` int(11) NOT NULL,
  `tireur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entrainement_tireur`
--

INSERT INTO `entrainement_tireur` (`entrainement_id`, `tireur_id`) VALUES
(7, 1),
(7, 2),
(7, 3),
(7, 4);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `nom`) VALUES
(1, 'elite'),
(2, 'loisir');

-- --------------------------------------------------------

--
-- Structure de la table `lecon`
--

CREATE TABLE `lecon` (
  `id` int(11) NOT NULL,
  `entrainement_id` int(11) NOT NULL,
  `entraineur_id` int(11) NOT NULL,
  `tireur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lecon`
--

INSERT INTO `lecon` (`id`, `entrainement_id`, `entraineur_id`, `tireur_id`) VALUES
(1, 7, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `maitre_arme`
--

CREATE TABLE `maitre_arme` (
  `id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `maitre_arme`
--

INSERT INTO `maitre_arme` (`id`, `membre_id`) VALUES
(1, 5),
(2, 6),
(3, 7);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_de_naissance` date NOT NULL,
  `sexe` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `date_de_naissance`, `sexe`, `is_admin`, `email`, `password`, `roles`) VALUES
(1, 'admin', 'admin', '1899-01-01', 'H', 0, 'admin@admin.admin', '$2y$13$A513MTY8W7LJZZ95xi5hdeABElFMeCN1EW7vCr7eoQ3gYGL1HBtfa', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(2, 'Captain', 'Morgan', '1899-01-01', 'H', 0, 'tireur@tireur.tireur', '$2y$13$fbmvqXO0jqvNzMw8cWNHHO2piMhOrcb.iPrTzHGZ9r4il8tvQ7mQS', 'a:1:{i:0;s:11:\"ROLE_TIREUR\";}'),
(3, 't2', 't2', '1899-01-01', 'H', 0, 't2@t2.t2', '$2y$13$tVplKxmLx5LLTfk1kki.dOlRGOe1noj1TOUGlk05i/wnpcGpCw/62', 'a:1:{i:0;s:11:\"ROLE_TIREUR\";}'),
(4, 'gggggg', 'gggggg', '1899-01-01', 'F', 0, 'g@g.g', '$2y$13$GCxLOj.k0MyCFG7JizOoAeSSQv2srZBtsZU8tbIL1X5xADOPfCq2y', 'a:1:{i:0;s:11:\"ROLE_TIREUR\";}'),
(5, 'Maitre1', 'Maitre', '1899-01-01', 'H', 0, 'm1@m1.m1', '$2y$13$4tAI3n56WVZMe5cLXKzn0Olf1afQdWZx6/yZPAtYcDFVgJpPECYtO', 'a:1:{i:0;s:16:\"ROLE_MAITRE_ARME\";}'),
(6, 'Maitre2', 'maitre', '1899-01-01', 'F', 0, 'm2@m2.m2', '$2y$13$3jvMqIMkocdF1VzJl9waLelMO7Gfom1kc7j30unmJ2V4eSOBvOX/W', 'a:1:{i:0;s:16:\"ROLE_MAITRE_ARME\";}'),
(7, 'Maitre3', 'Choji', '1899-01-01', 'H', 0, 'm3@m3.m3', '$2y$13$3G0DrEzHbLzlk.r./CNAFejKXo.2TLlYVwVm/MdBSFyHWOpTCrXoW', 'a:1:{i:0;s:16:\"ROLE_MAITRE_ARME\";}'),
(8, 'gov', 'dinesh', '1899-01-01', 'H', 0, 'dinesh@hotmail.fr', '$2y$13$Xs9JwR8gLLg.G3DZZl0NpuoEkquudgilpsD3K5NY/vSfvJKJVMjym', 'a:1:{i:0;s:11:\"ROLE_TIREUR\";}'),
(9, 'Cena', 'John', '1996-05-20', 'H', 0, 'd@d.d', '$2y$13$iRA6zg8pJ1oSLteYY5KbDuf7hF4Sgr.elyzLgzy1RHkeHtkYc0rOq', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}');

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `id` int(11) NOT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`id`, `categorie`) VALUES
(1, 'M11'),
(2, 'M12'),
(3, 'M13'),
(4, 'M15');

-- --------------------------------------------------------

--
-- Structure de la table `objectif`
--

CREATE TABLE `objectif` (
  `id` int(11) NOT NULL,
  `tireur_id` int(11) NOT NULL,
  `attribue_par_id` int(11) NOT NULL,
  `objectif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atteint` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `objectif`
--

INSERT INTO `objectif` (`id`, `tireur_id`, `attribue_par_id`, `objectif`, `atteint`) VALUES
(1, 1, 2, 'Objectif personnel 1', 1),
(2, 1, 2, 'Objectif personnel 2', 1),
(3, 1, 1, 'Objectif externe 1', 0),
(4, 3, 1, 'Objectif gggggg', 0),
(5, 1, 2, 'Faire 14 pompes', 1),
(6, 1, 2, 'Faire 10000000 abdos', 0);

-- --------------------------------------------------------

--
-- Structure de la table `presence`
--

CREATE TABLE `presence` (
  `id` int(11) NOT NULL,
  `entrainement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `presence`
--

INSERT INTO `presence` (`id`, `entrainement_id`) VALUES
(7, 7);

-- --------------------------------------------------------

--
-- Structure de la table `presence_tireur`
--

CREATE TABLE `presence_tireur` (
  `presence_id` int(11) NOT NULL,
  `tireur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `presence_tireur`
--

INSERT INTO `presence_tireur` (`presence_id`, `tireur_id`) VALUES
(7, 1),
(7, 3);

-- --------------------------------------------------------

--
-- Structure de la table `tireur`
--

CREATE TABLE `tireur` (
  `id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `niveau_id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL,
  `presence_id` int(11) DEFAULT NULL,
  `blason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_surclassement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tireur`
--

INSERT INTO `tireur` (`id`, `membre_id`, `niveau_id`, `groupe_id`, `presence_id`, `blason`, `niveau_surclassement`) VALUES
(1, 2, 1, 1, NULL, 'tireur', 2),
(2, 3, 1, 1, NULL, 'azerty', 3),
(3, 4, 1, 1, NULL, 'gggggg', 2),
(4, 8, 1, 1, NULL, 'dinesh', 2);

-- --------------------------------------------------------

--
-- Structure de la table `tireur_arme`
--

CREATE TABLE `tireur_arme` (
  `tireur_id` int(11) NOT NULL,
  `arme_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `arbitre`
--
ALTER TABLE `arbitre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_20B2E66E6A99F74A` (`membre_id`);

--
-- Index pour la table `arme`
--
ALTER TABLE `arme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire_lecon`
--
ALTER TABLE `commentaire_lecon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_116AEC32EC1308A5` (`lecon_id`),
  ADD KEY `IDX_116AEC32AAF6E29` (`ecrit_par_id`);

--
-- Index pour la table `commentaire_objectif`
--
ALTER TABLE `commentaire_objectif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_10E9A08D157D1AD4` (`objectif_id`),
  ADD KEY `IDX_10E9A08DAAF6E29` (`ecrit_par_id`);

--
-- Index pour la table `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `competition_arbitre`
--
ALTER TABLE `competition_arbitre`
  ADD PRIMARY KEY (`competition_id`,`arbitre_id`),
  ADD KEY `IDX_3F0726C07B39D312` (`competition_id`),
  ADD KEY `IDX_3F0726C0943A5F0` (`arbitre_id`);

--
-- Index pour la table `competition_niveau`
--
ALTER TABLE `competition_niveau`
  ADD PRIMARY KEY (`competition_id`,`niveau_id`),
  ADD KEY `IDX_249C33B87B39D312` (`competition_id`),
  ADD KEY `IDX_249C33B8B3E9C81` (`niveau_id`);

--
-- Index pour la table `competition_tireur`
--
ALTER TABLE `competition_tireur`
  ADD PRIMARY KEY (`competition_id`,`tireur_id`),
  ADD KEY `IDX_B979C7E47B39D312` (`competition_id`),
  ADD KEY `IDX_B979C7E4CE287986` (`tireur_id`);

--
-- Index pour la table `entrainement`
--
ALTER TABLE `entrainement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A27444E57A45358C` (`groupe_id`);

--
-- Index pour la table `entrainement_maitre_arme`
--
ALTER TABLE `entrainement_maitre_arme`
  ADD PRIMARY KEY (`entrainement_id`,`maitre_arme_id`),
  ADD KEY `IDX_6B3B257FA15E8FD` (`entrainement_id`),
  ADD KEY `IDX_6B3B257F35C6C1D6` (`maitre_arme_id`);

--
-- Index pour la table `entrainement_tireur`
--
ALTER TABLE `entrainement_tireur`
  ADD PRIMARY KEY (`entrainement_id`,`tireur_id`),
  ADD KEY `IDX_168B6FFA15E8FD` (`entrainement_id`),
  ADD KEY `IDX_168B6FFCE287986` (`tireur_id`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lecon`
--
ALTER TABLE `lecon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_94E6242EA15E8FD` (`entrainement_id`),
  ADD KEY `IDX_94E6242EF8478A1` (`entraineur_id`),
  ADD KEY `IDX_94E6242ECE287986` (`tireur_id`);

--
-- Index pour la table `maitre_arme`
--
ALTER TABLE `maitre_arme`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B6D1069C6A99F74A` (`membre_id`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4BDFF36B497DD634` (`categorie`);

--
-- Index pour la table `objectif`
--
ALTER TABLE `objectif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E2F86851CE287986` (`tireur_id`),
  ADD KEY `IDX_E2F8685193864229` (`attribue_par_id`);

--
-- Index pour la table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6977C7A5A15E8FD` (`entrainement_id`);

--
-- Index pour la table `presence_tireur`
--
ALTER TABLE `presence_tireur`
  ADD PRIMARY KEY (`presence_id`,`tireur_id`),
  ADD KEY `IDX_3BABB627F328FFC4` (`presence_id`),
  ADD KEY `IDX_3BABB627CE287986` (`tireur_id`);

--
-- Index pour la table `tireur`
--
ALTER TABLE `tireur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D63A07376A99F74A` (`membre_id`),
  ADD KEY `IDX_D63A0737B3E9C81` (`niveau_id`),
  ADD KEY `IDX_D63A07377A45358C` (`groupe_id`),
  ADD KEY `IDX_D63A0737F328FFC4` (`presence_id`);

--
-- Index pour la table `tireur_arme`
--
ALTER TABLE `tireur_arme`
  ADD PRIMARY KEY (`tireur_id`,`arme_id`),
  ADD KEY `IDX_354D5D92CE287986` (`tireur_id`),
  ADD KEY `IDX_354D5D9221D9C0A` (`arme_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `arbitre`
--
ALTER TABLE `arbitre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `arme`
--
ALTER TABLE `arme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commentaire_lecon`
--
ALTER TABLE `commentaire_lecon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaire_objectif`
--
ALTER TABLE `commentaire_objectif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `competition`
--
ALTER TABLE `competition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `entrainement`
--
ALTER TABLE `entrainement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `lecon`
--
ALTER TABLE `lecon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `maitre_arme`
--
ALTER TABLE `maitre_arme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `objectif`
--
ALTER TABLE `objectif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `presence`
--
ALTER TABLE `presence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `tireur`
--
ALTER TABLE `tireur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `arbitre`
--
ALTER TABLE `arbitre`
  ADD CONSTRAINT `FK_20B2E66E6A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `commentaire_lecon`
--
ALTER TABLE `commentaire_lecon`
  ADD CONSTRAINT `FK_116AEC32AAF6E29` FOREIGN KEY (`ecrit_par_id`) REFERENCES `membre` (`id`),
  ADD CONSTRAINT `FK_116AEC32EC1308A5` FOREIGN KEY (`lecon_id`) REFERENCES `lecon` (`id`);

--
-- Contraintes pour la table `commentaire_objectif`
--
ALTER TABLE `commentaire_objectif`
  ADD CONSTRAINT `FK_10E9A08D157D1AD4` FOREIGN KEY (`objectif_id`) REFERENCES `objectif` (`id`),
  ADD CONSTRAINT `FK_10E9A08DAAF6E29` FOREIGN KEY (`ecrit_par_id`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `competition_arbitre`
--
ALTER TABLE `competition_arbitre`
  ADD CONSTRAINT `FK_3F0726C07B39D312` FOREIGN KEY (`competition_id`) REFERENCES `competition` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3F0726C0943A5F0` FOREIGN KEY (`arbitre_id`) REFERENCES `arbitre` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `competition_niveau`
--
ALTER TABLE `competition_niveau`
  ADD CONSTRAINT `FK_249C33B87B39D312` FOREIGN KEY (`competition_id`) REFERENCES `competition` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_249C33B8B3E9C81` FOREIGN KEY (`niveau_id`) REFERENCES `niveau` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `competition_tireur`
--
ALTER TABLE `competition_tireur`
  ADD CONSTRAINT `FK_B979C7E47B39D312` FOREIGN KEY (`competition_id`) REFERENCES `competition` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B979C7E4CE287986` FOREIGN KEY (`tireur_id`) REFERENCES `tireur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `entrainement`
--
ALTER TABLE `entrainement`
  ADD CONSTRAINT `FK_A27444E57A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`);

--
-- Contraintes pour la table `entrainement_maitre_arme`
--
ALTER TABLE `entrainement_maitre_arme`
  ADD CONSTRAINT `FK_6B3B257F35C6C1D6` FOREIGN KEY (`maitre_arme_id`) REFERENCES `maitre_arme` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6B3B257FA15E8FD` FOREIGN KEY (`entrainement_id`) REFERENCES `entrainement` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `entrainement_tireur`
--
ALTER TABLE `entrainement_tireur`
  ADD CONSTRAINT `FK_168B6FFA15E8FD` FOREIGN KEY (`entrainement_id`) REFERENCES `entrainement` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_168B6FFCE287986` FOREIGN KEY (`tireur_id`) REFERENCES `tireur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `lecon`
--
ALTER TABLE `lecon`
  ADD CONSTRAINT `FK_94E6242EA15E8FD` FOREIGN KEY (`entrainement_id`) REFERENCES `entrainement` (`id`),
  ADD CONSTRAINT `FK_94E6242ECE287986` FOREIGN KEY (`tireur_id`) REFERENCES `tireur` (`id`),
  ADD CONSTRAINT `FK_94E6242EF8478A1` FOREIGN KEY (`entraineur_id`) REFERENCES `maitre_arme` (`id`);

--
-- Contraintes pour la table `maitre_arme`
--
ALTER TABLE `maitre_arme`
  ADD CONSTRAINT `FK_B6D1069C6A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `objectif`
--
ALTER TABLE `objectif`
  ADD CONSTRAINT `FK_E2F8685193864229` FOREIGN KEY (`attribue_par_id`) REFERENCES `membre` (`id`),
  ADD CONSTRAINT `FK_E2F86851CE287986` FOREIGN KEY (`tireur_id`) REFERENCES `tireur` (`id`);

--
-- Contraintes pour la table `presence`
--
ALTER TABLE `presence`
  ADD CONSTRAINT `FK_6977C7A5A15E8FD` FOREIGN KEY (`entrainement_id`) REFERENCES `entrainement` (`id`);

--
-- Contraintes pour la table `presence_tireur`
--
ALTER TABLE `presence_tireur`
  ADD CONSTRAINT `FK_3BABB627CE287986` FOREIGN KEY (`tireur_id`) REFERENCES `tireur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3BABB627F328FFC4` FOREIGN KEY (`presence_id`) REFERENCES `presence` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tireur`
--
ALTER TABLE `tireur`
  ADD CONSTRAINT `FK_D63A07376A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`),
  ADD CONSTRAINT `FK_D63A07377A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `FK_D63A0737B3E9C81` FOREIGN KEY (`niveau_id`) REFERENCES `niveau` (`id`),
  ADD CONSTRAINT `FK_D63A0737F328FFC4` FOREIGN KEY (`presence_id`) REFERENCES `presence` (`id`);

--
-- Contraintes pour la table `tireur_arme`
--
ALTER TABLE `tireur_arme`
  ADD CONSTRAINT `FK_354D5D9221D9C0A` FOREIGN KEY (`arme_id`) REFERENCES `arme` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_354D5D92CE287986` FOREIGN KEY (`tireur_id`) REFERENCES `tireur` (`id`) ON DELETE CASCADE;
