-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 12 sep. 2023 à 15:27
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_user`
--
CREATE DATABASE IF NOT EXISTS `projet_user` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `projet_user`;

-- --------------------------------------------------------

--
-- Structure de la table `likes_dislikes`
--

DROP TABLE IF EXISTS `likes_dislikes`;
CREATE TABLE IF NOT EXISTS `likes_dislikes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `item_id` int NOT NULL,
  `type` enum('like','dislike') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `likes_dislikes`
--

INSERT INTO `likes_dislikes` (`id`, `user_id`, `item_id`, `type`) VALUES
(1, 1, 2, 'dislike'),
(2, 1, 1, 'dislike');

-- --------------------------------------------------------

--
-- Structure de la table `likes_dislikes_commentaire`
--

DROP TABLE IF EXISTS `likes_dislikes_commentaire`;
CREATE TABLE IF NOT EXISTS `likes_dislikes_commentaire` (
  `id_com_likedislike` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `item_id` int NOT NULL,
  `type` enum('like','dislike') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_com_likedislike`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `likes_dislikes_commentaire`
--

INSERT INTO `likes_dislikes_commentaire` (`id_com_likedislike`, `user_id`, `item_id`, `type`) VALUES
(1, 14, 1, 'dislike'),
(2, 14, 2, 'dislike'),
(3, 1, 3, 'dislike'),
(4, 1, 4, 'dislike');

-- --------------------------------------------------------

--
-- Structure de la table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subscriber_id` int NOT NULL,
  `subscribed_to_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriber_id` (`subscriber_id`),
  KEY `subscribed_to_id` (`subscribed_to_id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `subscriber_id`, `subscribed_to_id`) VALUES
(29, 14, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mdp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nv_role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '20',
  `key_profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recup_mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'defauft.png',
  `profile_fond` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'defaut_fond.png',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `mdp`, `nv_role`, `key_profile`, `recup_mdp`, `profile_image`, `profile_fond`, `description`, `date`) VALUES
(1, 'Marlon', 'bastien.lecour2025@gmail.com', '70873e8580c9900986939611618d7b1e', '100', '09f02a3eaa189d55658b', 'a48bc2e584564c015c9a937783091c971163b9643eba6ffd7b5f6530d42f', 'Marlon_5e15fa32519ea96bccb8023f5e4dd7fc3060592d', 'Marlon_abb8e6541df4d81ea5f4bfdddbeaaf14746c0507.png', 'Salut tout le monde j\'aime faire des vidéo sur ce site j\'ai mis du temps a le faire donc merci pour vos retour', '2023-05-04'),
(2, 'Akina', 'mswietrich1507@gmail.com', '70873e8580c9900986939611618d7b1e', '40', '12837ab1a703837adb41', NULL, 'Akina_a4d67d828db439a4452f351f12dc9f4247f0a397.jpg', 'Akina_dc4f6ba7df233e6b5458b4e78563c826c8d2771d.jpg', 'j\'aime les chat, et la glace au chocolat, mais aussi j\'aime Loulou ', '2023-09-04'),
(3, 'luffy150610', 'guigui15.delanchy@gmail.com', '70873e8580c9900986939611618d7b1e', '20', 'df78e9c0e4ebc029c3b5', NULL, 'luffy150610_de419d949aba99d848fd6770f9382fa5bacdaa58.png', 'defauft_fond.png', 'J\'ai besois d\'argent donc merci de me faire des don, sur mon paypal', '2023-06-05'),
(4, 'TotoGros', 'Hugo.lecour@gmail.com', '70873e8580c9900986939611618d7b1e', '20', '38e379fa3a4b3bafb64a', NULL, 'TotoGros_6a677ecae97cd5053d2006f6a7d98e19189c44f6.jpg', 'defauft_fond.png', '', '2023-09-07'),
(5, 'kezouze', 'vincent-c51@hotmail.fr', '70873e8580c9900986939611618d7b1e', '20', '1f6075a7c4ffa11c7c55', NULL, 'kezouze_bb57c51f2adc1cf0ebd0c377f46c41118332fe0d.jpg', 'defauft_fond.png', '', '2023-09-02'),
(6, 'Aymeric', 'Bakshfkhsfjs@gmail.com', '70873e8580c9900986939611618d7b1e', '20', 'e7627b38f9a13b65205d', NULL, 'Aymeric_dc4f6ba7df233e6b5458b4e78563c826c8d2771d.jpg', 'defauft_fond.png', '', '2023-09-09'),
(7, 'yoloboy', 'yolo@yolo.com', 'c2f1366c51911b52369fe27df307ff84', '20', '8a6086b4365f227d1dcf', NULL, 'yoloboy_ca74412ecef72463c08498f316fcc505f42bb736.jpg', 'defauft_fond.png', '', '2023-08-10'),
(8, 'moi50', 'vincent-c52@hotmail.fr', '70873e8580c9900986939611618d7b1e', '20', 'edd131280ae695fb7623', NULL, 'defauft.png', 'defauft_fond.png', '', '2023-09-04'),
(9, 'Isabelle', 'isabelle.huet@gmail.com', '70873e8580c9900986939611618d7b1e', '20', '8aa1247b3791e1f9bf69', NULL, 'defauft.png', 'defauft_fond.png', '', '2023-09-04'),
(10, 'Spirou', 'Spirou.Chat@hotmail.com', '70873e8580c9900986939611618d7b1e', '20', '5b0d2a7937a14a28b5d8', NULL, 'defauft.png', 'defauft_fond.png', '', '2023-06-05'),
(11, 'SuperAK', 'SuperAK@gmail.com', '70873e8580c9900986939611618d7b1e', '20', '324d3715ab87b852a0f6', NULL, 'defauft.png', 'defauft_fond.png', '', '2023-09-09'),
(12, 'FuzeIII', 'FuzeIII@gmail.com', '70873e8580c9900986939611618d7b1e', '20', '07b65c516fa8bea10b41', NULL, 'defauft.png', 'defauft_fond.png', '', '2023-08-12'),
(13, 'Reims', 'Reims@gouv.fr', '70873e8580c9900986939611618d7b1e', '20', 'b1b36ee8c4c2d3a7e3f3', NULL, 'defauft.png', 'defauft_fond.png', '', '2023-09-05'),
(14, 'LuzAmity', 'Luz@gmail.com', '70873e8580c9900986939611618d7b1e', '100', '7e839b8cc2a508cc8ecb', 'NULL', 'LuzAmity_5998f0bd46c498b505fafac584f21ef7c432b22b.jpg', 'LuzAmity_c0c5d7ab4b9311851043340442317ff40d2dbe1c.jpg', 'Salut tout le monde je suis Luz', '2023-09-01'),
(15, 'moi15', 'moi@gmail.com', '70873e8580c9900986939611618d7b1e', '20', '092cc86e42e7b65db683', NULL, 'defauft.png', 'defauft_fond.png', '', '2023-09-02'),
(16, 'debug', 'debug@hotmail.com', '70873e8580c9900986939611618d7b1e', '20', '36149e532841bd39e8e4', NULL, 'defauft.png', 'defauft_fond.png', '', '2023-09-07'),
(17, 'quetin', 'quetin@homtial.com', '70873e8580c9900986939611618d7b1e', '20', 'b414b8098fd9eb582308', NULL, 'defauft.png', 'defauft_fond.png', '', '2023-09-09'),
(19, 'NanouS', 'super.nanousfou@gmail.com', '70873e8580c9900986939611618d7b1e', '20', '98b14748920ecfb28894', NULL, 'defauft.png', 'defaut_fond.png', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id_video` int NOT NULL AUTO_INCREMENT,
  `views_count` int NOT NULL DEFAULT '0',
  `video_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_lien` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date_upload` datetime DEFAULT NULL,
  `video_bannier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_video`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `videos`
--

INSERT INTO `videos` (`id_video`, `views_count`, `video_path`, `video_lien`, `titre`, `description`, `date_upload`, `video_bannier`, `user_id`) VALUES
(1, 20, '25d19306f0742a1ffb1e5e2d08609370d39ce952.mp4', '978e5180587189e5bed79ed41b2ebd', 'PaPY gRENIER 6 wORLD OF wARcRAFT', 'PaPY gRENIER 6 wORLD OF wARcRAFT', '2023-09-04 09:08:54', 'e31f22d7b85a2f2e0c75749e0e25cb0253f51410.jpg', '1'),
(2, 6, 'a5fb9007febff06e077fb11eb10998fc9be9efc8.mp4', '325015f3851ed27a6a3f41bbdb65bf', '[AMV] Anime Mix - Bienvenue dans la Secte', '[AMV] Anime Mix - Bienvenue dans la Secte', '2023-09-04 09:10:06', '1dcdc52ea5f7ce4034cd6def7c6c33e70e8eacc8.jpg', '2'),
(3, 21, '4c5fc887cb67df1fff4b82f30f6cd4823b44327b.mp4', 'd4f2f75211b385fabc4b5d4c252656', 'POUR LA FAIRE COURTE  Fortnite  Chapitre 2 (Toute lHistoire)', 'POUR LA FAIRE COURTE  Fortnite  Chapitre 2 (Toute lHistoire)', '2023-09-04 09:11:33', '337717510dbfc4edda227e361a7e11fe8d9cbe0e.jpg', '3'),
(4, 4, '4c5fc887cb67df1fff4b82f30f6cd4823b44327b.mp4', '818160042e66cfee7fb046385890c0', 'J\'aime biens les jeux vidéo', 'merci de like la video', '2023-09-04 09:13:53', 'ffa123bc2a8888345271ec2d20844bf3e74066ea.jpg', '14'),
(5, 6, 'a5fb9007febff06e077fb11eb10998fc9be9efc8.mp4', '3e94c75fdd5d04f3048e2098014fc1', 'Super video de spaziatube ?????', 'Super video de spaziatube ?????', '2023-09-07 08:58:58', '1dcdc52ea5f7ce4034cd6def7c6c33e70e8eacc8.jpg', '10'),
(6, 1, 'a5fb9007febff06e077fb11eb10998fc9be9efc8.mp4', 'c57919b0a5fdf40a3fa75c5cbd3d3d', '[AMV] Anime Mix - Bienvenue dans la Secte', 'sdqdsqdqsd\r\nqsd\r\nqs\r\ndqs\r\nd\r\nqsd\r\nqs\r\ndqs\r\nd\r\nqsd\r\nqs\r\ndq\r\nsd\r\nqs\r\ndqsd', '2023-09-11 11:26:27', '337717510dbfc4edda227e361a7e11fe8d9cbe0e.jpg', '14'),
(7, 0, 'a5fb9007febff06e077fb11eb10998fc9be9efc8.mp4', 'f5cf09311d1f16c8abc63119a37cd1', 'dfdsfdsfsfdsfdsfdsd', 'dgffddffdfg', '2023-09-11 11:42:46', 'eb2598b2ec04c7dd9a11c5a6c389eba65b65f92f.jpg', '14'),
(8, 0, 'a5fb9007febff06e077fb11eb10998fc9be9efc8.mp4', '1dae6f9d3751dd691c6a3194673d4d', 'sdqdqs', 'dsqdqsdqs', '2023-09-11 14:03:35', 'e31f22d7b85a2f2e0c75749e0e25cb0253f51410.jpg', '14');

-- --------------------------------------------------------

--
-- Structure de la table `video_commentaire`
--

DROP TABLE IF EXISTS `video_commentaire`;
CREATE TABLE IF NOT EXISTS `video_commentaire` (
  `id_com` int NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int NOT NULL,
  `id_video` int NOT NULL,
  `date_upload` datetime NOT NULL,
  PRIMARY KEY (`id_com`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video_commentaire`
--

INSERT INTO `video_commentaire` (`id_com`, `commentaire`, `id_user`, `id_video`, `date_upload`) VALUES
(1, 'qsQSqsqSqs', 14, 3, '2023-09-04 14:43:00'),
(2, 'super video merci a toi\na quand l\'autre papy grenier', 14, 1, '2023-09-04 14:49:16'),
(3, 'gdqsjgdhqsgh\nqsdhqsdhgqshqs\nqsdjkqskgdjqs\nqsdkqsjdqs', 1, 1, '2023-09-04 15:44:34'),
(4, 'test', 1, 1, '2023-09-04 16:27:40'),
(5, 'test', 10, 5, '2023-09-07 09:03:47');

-- --------------------------------------------------------

--
-- Structure de la table `video_signaler`
--

DROP TABLE IF EXISTS `video_signaler`;
CREATE TABLE IF NOT EXISTS `video_signaler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `video_id` int NOT NULL,
  `raison` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `raison_detail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_signale` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
