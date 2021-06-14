-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 18 mai 2021 à 06:37
-- Version du serveur :  5.7.24
-- Version de PHP : 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mavix_twitter_github`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `body` text,
  `media` varchar(255) DEFAULT NULL,
  `tweet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `body`, `media`, `tweet_id`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 'Je t\'aime pas mais tu es bon', '', 10, 2, '2021-03-24 19:55:27', '2021-03-24 19:55:27'),
(7, 'Je sais', '', 10, 1, '2021-03-24 22:59:12', '2021-03-24 22:59:12'),
(9, 'HEY', '', 10, 2, '2021-03-26 18:43:26', '2021-03-26 18:43:26'),
(10, 'hey', '', 10, 1, '2021-03-27 07:45:35', '2021-03-27 07:45:35'),
(11, 'je suis comme je suis', '', 13, 5, '2021-03-30 14:53:29', '2021-03-30 14:53:29'),
(12, 'avec s', '', 13, 5, '2021-03-30 14:53:36', '2021-03-30 14:53:36'),
(13, 'some comment ehrerjkerhjekrhekjrjekhr', '6065adf8a61496065adf8a614e.jpg', 16, 8, '2021-04-01 13:25:07', '2021-04-01 13:25:07'),
(14, 'Irgib Africa music team', '', 13, 1, '2021-05-18 08:30:53', '2021-05-18 08:30:53');

-- --------------------------------------------------------

--
-- Structure de la table `comment_likes`
--

CREATE TABLE `comment_likes` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comment_likes`
--

INSERT INTO `comment_likes` (`id`, `comment_id`, `user_id`, `created_at`) VALUES
(4, 7, 2, '2021-03-26 15:34:23'),
(5, 14, 1, '2021-05-18 08:31:30');

-- --------------------------------------------------------

--
-- Structure de la table `follows`
--

CREATE TABLE `follows` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `following_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `follows`
--

INSERT INTO `follows` (`id`, `follower_id`, `following_id`, `created_at`) VALUES
(7, 2, 1, '2021-03-26 04:49:58'),
(12, 2, 3, '2021-03-26 21:01:13'),
(13, 1, 2, '2021-03-26 21:23:57'),
(15, 3, 1, '2021-03-26 21:52:09'),
(16, 1, 5, '2021-03-30 14:54:16'),
(17, 2, 8, '2021-04-01 13:21:48'),
(23, 1, 8, '2021-04-01 13:22:07'),
(24, 7, 1, '2021-05-18 08:22:26');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `tweet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `tweet_id`, `user_id`, `created_at`) VALUES
(321, 10, 1, '2021-03-24 00:50:50'),
(331, 10, 2, '2021-03-24 19:54:57'),
(349, 11, 3, '2021-03-27 07:39:03'),
(351, 13, 5, '2021-03-30 14:54:07'),
(352, 8, 5, '2021-04-01 08:18:45'),
(353, 16, 7, '2021-04-01 09:53:54'),
(355, 16, 8, '2021-04-01 13:24:45'),
(356, 14, 1, '2021-05-18 08:22:40'),
(357, 15, 1, '2021-05-18 08:22:43'),
(358, 13, 2, '2021-05-18 08:25:33'),
(359, 13, 1, '2021-05-18 08:29:08');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `text` text NOT NULL,
  `media` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `body` text,
  `media` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tweets`
--

INSERT INTO `tweets` (`id`, `body`, `media`, `user_id`, `created_at`, `updated_at`) VALUES
(8, 'je suis comme je suis', '', 2, '2021-03-23 23:23:35', NULL),
(10, 'Je serai la plus tendre.', '', 1, '2021-03-24 00:20:57', NULL),
(11, '', '605ed21c181b2605ed21c181b6.mp4', 3, '2021-03-27 07:35:08', NULL),
(12, 'chuit', '605ef65a4ca96605ef65a4ca9d.mp4', 3, '2021-03-27 10:09:46', NULL),
(13, 'Some post', '60631d6fbccf960631d6fbccfc.mp4', 5, '2021-03-30 14:45:35', NULL),
(14, 'Environnent setup for beat making', '60657a3c519a360657a3c519a7.jpg', 7, '2021-04-01 09:46:04', NULL),
(15, 'Le lion qui vendait la cocaine Ã  Juda', '60657abc575d460657abc575d7.jpg', 7, '2021-04-01 09:48:12', NULL),
(16, 'Good night !!!', '60657b1ea6d8e60657b1ea6d91.jpg', 7, '2021-04-01 09:49:50', NULL),
(17, 'Who are yous', '', 8, '2021-04-01 13:23:24', NULL),
(18, 'Nuit kabo', '', 8, '2021-04-01 13:23:42', NULL),
(19, 'je suis comme je suis', '', 8, '2021-04-01 13:27:35', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  `birthday` date NOT NULL,
  `profil_picture` varchar(255) DEFAULT 'avatar.png',
  `barners` varchar(255) DEFAULT NULL,
  `bio` text,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `password` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `fullname`, `verified`, `birthday`, `profil_picture`, `barners`, `bio`, `location`, `website`, `password`, `created_at`) VALUES
(1, 'bon@gmail.com', 'bon', 'Bon', NULL, '2004-05-11', '605df09889caa605df09889cad.jpg', '605df0988a37a605df0988a37f.jpg', 'Bio', '', '', '$2y$10$dNFxwkeI//0xZGvkkq7pIeCeHDZ8q.IWKrdQ07NwcP28tNCWhgr0W', '2021-03-21 22:47:27'),
(2, 'jehovah@jicorami.com', 'Jehovah', 'Jehova', NULL, '2003-09-08', '605a6cad0674f605a6cad06755.jpg', '605def725a273605def725a277.jpg', 'Je suis comme je suis', '', '', '$2y$10$tzdCEj68qZdw9Dl9e9a.x.Jw6PneVr8O0yajagfgTENw2mSJnKx9C', '2021-03-22 00:39:44'),
(3, 'omar@gmail.com', 'el_hadj_Omar', 'El hadj Omar', NULL, '2021-01-01', '605e2bb6a8c15605e2bb6a8c1a.jpg', '605e2bb6a939b605e2bb6a939c.jpg', 'Je suis comme je suis', 'Key Red 08', 'htttps://www.omar.com', '$2y$10$ft1jpuJ/JG3YPUKKtUhkueJI6W4sBUvv7fU5x0Y716TLQcveSbEnO', '2021-03-23 23:14:28'),
(4, 'kali@linux.com', 'KaliLinux', 'Kali', NULL, '1992-07-16', 'avatar.png', NULL, NULL, NULL, NULL, '$2y$10$UEiZgmbOLuQv.LBiwoAAEOsTlIXoe.Fx5YPkzMZ37VkX3ARmN1RDu', '2021-03-29 10:01:47'),
(5, 'romario@hounsou.com', 'romario', 'Romario', NULL, '2000-08-22', '60631d14b939860631d14ba8dd.jpg', '60631d14bd7b860631d14bd7be.jpg', 'Savant mad', '', '', '$2y$10$tdNzUsptEVenL2ZZP28D4u4JOnKY8MjHzxFbBnMGTYnRThgtMMcnW', '2021-03-30 14:42:51'),
(6, 'reagan@test.com', 'TechReagan', 'Tech Reagan', NULL, '1995-02-01', '60656ad60893060656ad608934.png', NULL, 'Web developpers , Teachers', '', '', '$2y$10$ttBLIiEcobYLSwYNFz/8h.FmC5nqJTxGyEjKegb6M4CKDWjQP/CEi', '2021-04-01 08:39:14'),
(7, 'doct@mavix.com', 'DoctorMavix', 'Doctor Mavix', NULL, '2021-01-01', '60657998a2f7c60657998a2f7f.jpg', '6065794f7449f6065794f744a3.jpg', 'Web developpers', '', '', '$2y$10$DASk2rhip1BI6pxIZblRmu3AFPLLsWX5DCbZFMbRXVQSFIP03PPqm', '2021-04-01 09:08:48'),
(8, 'wusdum@test.com', 'Wusdum', 'Wusdum', NULL, '1986-05-13', '6065ad1435cad6065ad1435cb1.jpg', '6065ad143653d6065ad1436543.jpg', 'some bio', '', '', '$2y$10$wbCWXKHQAXXXCV9th/BMt.W.CLbv4VesofIfpx1qpNYGEVQL8Vgj6', '2021-04-01 13:21:16');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment` (`tweet_id`);

--
-- Index pour la table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_likes` (`comment_id`);

--
-- Index pour la table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follower_id` (`follower_id`),
  ADD KEY `follows_ibfk_2` (`following_id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `like_in_tweet` (`tweet_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiver_id` (`receiver`),
  ADD KEY `sender_id` (`sender`);

--
-- Index pour la table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tweet_by_user` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `comment_likes`
--
ALTER TABLE `comment_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD CONSTRAINT `comment_likes` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `like_in_tweet` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `receiver_id` FOREIGN KEY (`receiver`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sender_id` FOREIGN KEY (`sender`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `tweet_by_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
