-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 08 jan. 2026 à 20:54
-- Version du serveur : 8.0.40
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mini_mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int NOT NULL,
  `nom` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Électronique', 'Produits électroniques et gadgets', '2025-12-17 13:26:06', '2025-12-17 13:26:06'),
(2, 'Vêtements', 'Vêtements et accessoires de mode', '2025-12-17 13:26:06', '2025-12-17 13:26:06'),
(3, 'Alimentation', 'Produits alimentaires et boissons', '2025-12-17 13:26:06', '2025-12-17 13:26:06'),
(4, 'Maison & Jardin', 'Articles pour la maison et le jardin', '2025-12-17 13:26:06', '2025-12-17 13:26:06');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `statut` enum('en_attente','validee','annulee') COLLATE utf8mb4_general_ci DEFAULT 'en_attente',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `user_id`, `statut`, `total`, `created_at`, `updated_at`) VALUES
(9, 1, 'validee', 20.00, '2026-01-08 20:10:08', '2026-01-08 20:10:08');

-- --------------------------------------------------------

--
-- Structure de la table `commande_produit`
--

CREATE TABLE `commande_produit` (
  `id` int NOT NULL,
  `commande_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantite` int NOT NULL DEFAULT '1',
  `prix_unitaire` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande_produit`
--

INSERT INTO `commande_produit` (`id`, `commande_id`, `product_id`, `quantite`, `prix_unitaire`, `created_at`) VALUES
(14, 9, 19, 1, 20.00, '2026-01-08 20:10:08');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantite` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int NOT NULL,
  `nom` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `prix` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `image_url` text COLLATE utf8mb4_general_ci NOT NULL,
  `categorie_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `description`, `prix`, `stock`, `image_url`, `categorie_id`) VALUES
(1, 'Barbecue ', 'Barbecue noir tendance', 242.00, 100, 'https://images.metro-marketplace.eu/item_image/efec04ab-61a6-4b7b-9e4c-6845702ff587?impolicy=pdp_main_gallery_preview&imwidth=1024', 4),
(2, 'Canapé de jardin', 'Canapé de jardin confortable', 465.00, 100, 'https://www.jardindechloe.com/cdn/shop/files/CANAPE-2PLACES-LOVY-zoom_22149bbf-add6-40b8-b980-816e8909b255.jpg?v=1765525453&width=1200', 4),
(3, 'Cabane de jardin', 'Cabane de jardin en bois de chêne', 589.00, 100, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUoCdt6xipubfwRompiQ2YheMVMzZ2BhPAeQ&s', 4),
(4, 'Ordinateur portable', 'Ordinateur portable haute performance', 1299.99, 100, 'https://static.fnac-static.com/multimedia/Images/FR/MDM/a1/14/52/22156449/1540-1/tsp20250801182017/PC-Portable-Lenovo-IdeaPad-Slim-3-15IAH8-15-6-Intel-Core-i5-16-Go-RAM-512-Go-D-Gris.jpg', 1),
(5, 'Souris', 'Souris pour PC', 40.00, 56, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQx3qARXQdkyZYhkR35oeGLmLoIWjODSqbNbA&s', 1),
(6, 'iPhone 17 Pro ', 'Iphone 128Go Gris Sidéral', 1367.00, 100, 'https://image.darty.com/darty?type=image&source=/market/2025/09/10/28739092_3723_1.jpg&width=497&height=330&quality=95&effects=Pad(CC,FFFFFF)', 1),
(7, 'Tasty Crousty', 'Tasty Crousty Sauce blanche sucrée ', 9.00, 200, 'https://i0.wp.com/clodonews.com/wp-content/uploads/2025/09/Tasty-Crousty-Argenteuil_9fe64870c12193928d96932ce49629ec.jpg?resize=616%2C821&ssl=1', 3),
(8, 'Pepe chicken', 'Offre spécial -20%', 8.90, 200, 'https://www.pepechicken.fr/wp-content/uploads/TasterPepeChicken_PepeBurger-1920x1280.jpg', 3),
(9, 'O\'BOWL otacos', '2 viandes', 7.00, 200, 'https://pub-3e289d306c7a4cbe92ad05c129a9823b.r2.dev/otacoscompose-bowl-420x325.png', 3),
(18, 'Chaussure Noir', 'Basket noir confortable', 30.00, 100, 'https://podoways.fr/cdn/shop/files/Basketsanslacetshommeconfortable.webp?v=1742161418&width=800', 2),
(19, 'Jean bleu', 'Jean bleu mignon', 20.00, 99, 'https://static3.degriffstock.com/297523-home_default/jean-slim-blue-denim-glenn-stretch-confort-homme-jack-jones.jpg', 2),
(20, 'Chapka', 'Chapka noir avec fourrure de bison et cuir d\'agneau', 25.00, 100, 'https://www.dt-collection.com/147-large_default/chapeau-chapka-victor-en-cuir-d-agneau-et-fourrure-de-lapin.jpg', 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `email`, `Password`) VALUES
(1, 'Beta', 'beta@test.com', '123');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_commande_user` (`user_id`);

--
-- Index pour la table `commande_produit`
--
ALTER TABLE `commande_produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_commande_produit_commande` (`commande_id`),
  ADD KEY `fk_commande_produit_produit` (`product_id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_product` (`user_id`,`product_id`),
  ADD KEY `fk_panier_produit` (`product_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produit_categorie` (`categorie_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `commande_produit`
--
ALTER TABLE `commande_produit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commande_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande_produit`
--
ALTER TABLE `commande_produit`
  ADD CONSTRAINT `fk_commande_produit_commande` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_commande_produit_produit` FOREIGN KEY (`product_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `fk_panier_produit` FOREIGN KEY (`product_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_panier_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `fk_produit_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
