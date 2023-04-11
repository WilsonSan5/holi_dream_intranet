-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 11 avr. 2023 à 20:56
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
-- Base de données : `holi_dream`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

CREATE TABLE `achat` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `planning_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `date_achat` datetime NOT NULL,
  `quantite` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`) VALUES
(128, 'Europe', 'Vel voluptatum ea aspernatur ea sit.'),
(129, 'Asie', 'Praesentium reiciendis aut quisquam ut placeat ut quia.'),
(130, 'Amériques', 'Quis animi id voluptatum quo.'),
(131, 'Océanie', 'Omnis rerum asperiores eos provident molestiae.'),
(132, 'Afrique', 'Ea voluptas quis qui natus in quis veniam.'),
(133, 'Les plus visités', 'Impedit necessitatibus corporis vel quisquam labore sed quidem dolore.'),
(134, 'Les bons plans', 'Blanditiis sint commodi quam debitis saepe vel error.');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230408095720', '2023-04-08 12:03:15', 190);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE `planning` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `date_depart` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `planning`
--

INSERT INTO `planning` (`id`, `produit_id`, `prix`, `date_depart`, `date_fin`, `quantite`) VALUES
(728, 523, 1102, '2023-04-25 21:54:27', '2023-04-27 15:32:49', 33),
(729, 523, 1180, '2023-03-21 00:33:33', '2023-03-23 19:11:42', 16),
(730, 530, 1668, '2023-03-18 11:04:20', '2023-03-30 21:05:32', 16),
(731, 530, 2951, '2023-05-15 23:36:14', '2023-05-27 03:43:52', 26),
(732, 532, 2759, '2023-04-16 12:01:09', '2023-04-27 22:11:07', 12),
(733, 532, 848, '2023-04-11 12:14:21', '2023-04-17 17:22:47', 21),
(734, 533, 2334, '2023-03-28 10:42:39', '2023-04-01 04:23:26', 14),
(735, 533, 1289, '2023-05-12 22:48:15', '2023-05-28 14:46:22', 18),
(736, 534, 1667, '2023-04-03 21:38:20', '2023-04-21 03:38:10', 10),
(737, 534, 2890, '2023-03-13 20:49:20', '2023-04-01 12:15:56', 48),
(738, 534, 780, '2023-04-04 05:06:25', '2023-04-16 16:42:01', 15),
(739, 535, 791, '2023-03-30 03:11:00', '2023-04-11 14:23:48', 13),
(740, 537, 2547, '2023-03-25 01:00:27', '2023-04-06 04:17:47', 28),
(741, 538, 723, '2023-04-28 03:41:24', '2023-05-09 11:21:59', 50),
(742, 540, 468, '2023-04-17 10:54:35', '2023-05-03 22:42:10', 11),
(743, 541, 1855, '2023-04-18 11:24:21', '2023-05-04 21:26:57', 49),
(744, 541, 2053, '2023-03-26 22:14:05', '2023-04-03 05:07:51', 10),
(745, 541, 2524, '2023-04-26 17:43:11', '2023-05-08 18:18:27', 9);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `introduction` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `prix_defaut` int(11) NOT NULL,
  `nbr_jour` int(11) NOT NULL,
  `nbr_nuit` int(11) NOT NULL,
  `description_programme` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `prix_ttc` int(11) NOT NULL,
  `etat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `title`, `introduction`, `description`, `prix_defaut`, `nbr_jour`, `nbr_nuit`, `description_programme`, `image`, `prix_ttc`, `etat`) VALUES
(522, 'Heard et McDonald (Îles)', 'Eum ut magnam commodi harum laudantium.', 'Voluptatem aperiam cupiditate ullam qui quod ut beatae rem est repellendus quod dolorum autem recusandae minus et eaque maiores reiciendis est eligendi natus maiores cupiditate velit quas deserunt harum accusamus suscipit natus quaerat quia odio perferendis magni enim consectetur doloribus hic a consequatur dicta qui accusantium est rem iure error qui.', 1200, 14, 14, 'Sed ut voluptates illum amet.', '/images/produits/produit (24).jpg', 1440, 1),
(523, 'Lettonie', 'Ut corporis delectus rerum facilis velit at ut.', 'Dolor consequatur tenetur aut unde accusamus delectus nihil omnis omnis repellat rerum quia nostrum magni asperiores laboriosam dignissimos est dignissimos sed fuga nemo deserunt et cupiditate nam non quas nihil illo molestiae tenetur ipsa exercitationem eum ut qui officiis voluptatem ex et sequi modi nobis officiis culpa corrupti non nulla et quis odio et quod.', 561, 11, 11, 'Magnam rerum cumque impedit pariatur eligendi autem.', '/images/produits/produit (28).jpg', 673, 1),
(524, 'Nouvelle-Zélande', 'Placeat molestiae velit vero aut eaque.', 'Veniam velit dicta alias ut qui molestiae autem dolore aliquam dolorem aut nemo ea molestiae officia qui voluptas cum esse ut laudantium debitis ab nisi est quaerat quia ad accusantium autem sapiente ad quis eum enim voluptate sit veniam sunt corporis vero reprehenderit dolores quaerat autem eaque quae nostrum cupiditate sed eum quo voluptatibus magni dolores adipisci aut fuga quas consequatur dicta delectus assumenda commodi aut rerum voluptatum quidem nihil voluptas similique ratione eos dolorum ut sint velit laudantium at.', 346, 13, 13, 'Nihil aliquid consequatur dolores qui eos.', '/images/produits/produit (9).jpg', 415, 1),
(525, 'Bahamas', 'Id doloremque aut tempore quibusdam quisquam.', 'Voluptatibus et vel tempora doloremque sed eos ea corrupti vel perspiciatis reiciendis rerum sit eum perferendis nemo ipsa magni corporis aut consequatur architecto unde sed excepturi et ut dolorem aut earum similique ipsa suscipit tempore illo quod animi aut sint iste quasi.', 917, 14, 14, 'Beatae qui blanditiis aliquam adipisci sint inventore.', '/images/produits/produit (3).jpg', 1100, 1),
(526, 'Myanmar', 'Quas harum nihil et minus voluptates minima sit quas.', 'Dolorem dolor id sint quas odit quia exercitationem qui corrupti omnis soluta id non facilis corrupti incidunt officia quia voluptatibus harum nostrum corrupti fugit porro soluta est placeat alias culpa nisi similique velit facere qui id et est dolores vel distinctio sunt mollitia rerum cupiditate consequuntur soluta in aspernatur et qui laborum eveniet velit eum dolor necessitatibus ut asperiores pariatur eaque aspernatur aspernatur ea delectus error esse dolore animi quia et incidunt necessitatibus.', 425, 14, 14, 'In unde similique fugiat fuga temporibus et.', '/images/produits/produit (1).jpg', 510, 1),
(527, 'Koweit', 'Error occaecati placeat iste nobis.', 'Provident cumque nesciunt minima quis neque cupiditate unde autem sit inventore reprehenderit nisi tempora est id tempora ipsum ratione inventore dolore vel in earum voluptas rerum exercitationem magnam labore sed enim eligendi placeat earum natus reprehenderit nam est tempora qui nisi doloremque qui excepturi neque non aperiam id odit asperiores sed accusamus quae quos sint tempore nemo dolorum asperiores aliquid praesentium neque quia quibusdam est quis voluptates ex esse pariatur ut et reprehenderit dolorem eaque labore inventore nobis sint sunt et.', 786, 7, 7, 'Rerum vel sit ut rerum quia dolorem.', '/images/produits/produit (10).jpg', 943, 1),
(528, 'Sierra Leone', 'Dolore enim molestiae illum nesciunt minima.', 'Temporibus atque eius non culpa excepturi et possimus neque voluptas ut dolores quo facilis harum numquam pariatur veritatis voluptatem vel et hic est facilis deserunt quasi quod voluptates quos qui sed iste ut minus ipsum consequatur quos impedit distinctio est impedit quibusdam autem.', 114, 9, 9, 'Dolore sequi consequatur ratione aut eum.', '/images/produits/produit (24).jpg', 136, 1),
(529, 'Tonga', 'Ex rem et et laborum animi doloribus velit.', 'Unde quia minus dolores voluptates ab optio soluta odit architecto nam aut explicabo doloremque corrupti minima corrupti vel enim ducimus laboriosam ut sed excepturi dicta veritatis quae voluptates necessitatibus sequi nisi sunt sed cupiditate quia iste eligendi aut aut autem aut magnam id aut a adipisci quam et veritatis qui ea atque aut non amet qui nulla eveniet dolorum quia voluptatibus maxime illo accusamus excepturi ratione qui dolore eos et tempore velit assumenda ullam neque pariatur non.', 1732, 9, 9, 'Distinctio similique voluptates earum dolores expedita.', '/images/produits/produit (15).jpg', 2078, 1),
(530, 'Irlande', 'Et rerum hic repellat ut minus est ut.', 'Incidunt neque numquam sit nihil sequi ab incidunt laborum quis nihil vero et rem occaecati hic repellendus necessitatibus qui et blanditiis maiores reiciendis quisquam ut provident consequatur ipsam voluptatem hic voluptas et dolor similique officia at ab omnis consequatur similique odit iusto voluptatibus aut hic rerum nemo eos maiores cupiditate eos consectetur et.', 2399, 11, 11, 'Quas dolorum sed rem distinctio ex eos.', '/images/produits/produit (14).jpg', 2878, 1),
(531, 'Corée du Nord', 'Vel qui commodi nam facilis expedita dolorem.', 'Et necessitatibus perferendis quia quidem vel enim nostrum est velit voluptatem quibusdam qui pariatur dolore non aut quasi voluptatem ullam nihil ipsum et quas non debitis ducimus beatae dolor itaque dolor in sint aliquam eius nam quia qui placeat nesciunt et excepturi iure quia blanditiis qui omnis corporis unde ducimus quia aut reprehenderit aut cum autem qui.', 2341, 7, 7, 'Voluptas sit culpa omnis vel minus.', '/images/produits/produit (5).jpg', 2809, 1),
(532, 'Marshall (Îles)', 'Et sed qui non perferendis sit dicta voluptatibus.', 'Doloribus quam similique earum molestiae optio error ut est sint ratione est quo laborum voluptatem nam aut aperiam ratione et quo laboriosam quia facilis ut repellendus dolorem impedit perferendis laboriosam est et incidunt asperiores est reprehenderit nostrum qui aut unde officiis nam sed accusantium suscipit unde fuga facere ea rerum et voluptatem et aliquam animi ut at aliquam repudiandae sit cumque itaque dolorem est laborum iure sapiente.', 712, 9, 9, 'Nulla accusamus consequatur velit fuga.', '/images/produits/produit (7).jpg', 854, 1),
(533, 'Soudan', 'Omnis dignissimos quibusdam excepturi a quia et ab iure.', 'Omnis et error hic nemo alias omnis facilis sapiente cumque officia blanditiis quidem aut sed atque eaque maxime atque illo suscipit vel magnam rem est et aut inventore ut eligendi commodi sapiente numquam fugiat delectus aperiam necessitatibus soluta distinctio explicabo eum mollitia autem sed aut fugit est autem unde quae non impedit qui ut occaecati tenetur odit est nesciunt harum magni laudantium tenetur optio autem et reiciendis nulla animi provident nihil ut tenetur dolor alias accusamus perspiciatis dolorem eum dolor libero consequatur sed qui.', 2633, 11, 11, 'Et voluptas quos quibusdam ut temporibus expedita.', '/images/produits/produit (22).jpg', 3159, 1),
(534, 'Moldavie', 'Eveniet voluptate velit aliquid ut vel quia praesentium.', 'Ullam et quae quae omnis natus et quo et eligendi et deleniti voluptates maiores sed repellendus voluptas suscipit assumenda rerum reprehenderit architecto sit corporis nulla dolores laboriosam hic incidunt dolorum voluptatibus magnam eligendi quas reprehenderit numquam adipisci hic corrupti voluptatem eius explicabo dicta repudiandae sapiente aut ipsum cumque illo voluptatem excepturi dolor quae voluptate esse repudiandae ipsum similique sed quod ea nam consequatur voluptas sint deleniti eos dolorem omnis dolorum voluptates aliquid est numquam et et non est id et dicta sapiente dicta dolorem dolore.', 609, 11, 11, 'Nostrum natus nihil est consequatur similique sed.', '/images/produits/produit (21).jpg', 730, 1),
(535, 'Saint-Kitts et Nevis', 'Odio animi enim laboriosam ut animi corporis eos.', 'Modi laudantium eos eos voluptatibus laudantium amet tenetur cumque neque sit incidunt veniam commodi ea quibusdam molestias voluptates amet sint alias quia quidem quis dicta voluptatem rerum incidunt assumenda aperiam consequatur molestiae harum perferendis fugit et natus possimus eligendi et repellat hic consequatur repellendus possimus est blanditiis est hic tempora dolores facilis illum est laboriosam voluptas qui sed ipsa in enim ut eveniet rerum sit omnis praesentium officiis itaque corporis alias similique sit asperiores.', 1951, 8, 8, 'Animi ut ipsum omnis facere doloremque.', '/images/produits/produit (9).jpg', 2341, 1),
(536, 'Arabie saoudite', 'Quidem dolores et ipsum enim pariatur vero officia.', 'Ipsam delectus ratione ut esse tenetur tenetur ut mollitia mollitia architecto quis nihil odit vel alias molestiae voluptatem alias ratione perspiciatis facilis qui ea qui dolor earum repudiandae libero nemo natus saepe sed tempore et asperiores consectetur voluptatem sed pariatur voluptatibus numquam totam reiciendis et est qui aliquid aut odio eveniet beatae adipisci eveniet distinctio nulla placeat quis eveniet eius voluptate minima temporibus animi eaque.', 642, 12, 12, 'Quod minus optio dolore earum necessitatibus.', '/images/produits/produit (25).jpg', 770, 1),
(537, 'Rwanda', 'Laboriosam itaque sapiente quia et sapiente non.', 'Voluptatem veniam facilis est est id ducimus qui cupiditate accusantium consequuntur nesciunt autem sint illum atque provident quod odio accusamus et vel eius delectus voluptas et molestias molestias reiciendis sint sunt animi exercitationem qui hic sit enim repellat rerum dolores labore eos est.', 1689, 12, 12, 'Cum inventore quibusdam et quia et.', '/images/produits/produit (6).jpg', 2026, 1),
(538, 'Anguilla', 'Voluptatem modi impedit dolor sint officiis non inventore.', 'Id dolores ea nostrum voluptatibus quas harum sapiente recusandae eligendi enim accusamus quod quia voluptatum vel laudantium tenetur cupiditate hic voluptas aspernatur autem occaecati rerum voluptatem sed totam neque eum eos voluptas assumenda quisquam voluptas distinctio nesciunt ratione laudantium enim ut voluptate sed et explicabo consequatur sint eius rerum ea quaerat et eaque eos omnis temporibus quas aut est atque nesciunt ab quisquam iusto eum fugiat blanditiis eveniet voluptatem soluta maiores ut pariatur molestiae id aperiam repellendus.', 888, 13, 13, 'Rem animi ex est laudantium velit voluptatibus.', '/images/produits/produit (9).jpg', 1065, 1),
(539, 'Gibraltar', 'Nobis doloremque possimus et incidunt velit.', 'Voluptatem quia ut sint vitae aut et aspernatur tempore optio error minima ut ab est suscipit eos nemo itaque possimus ea nihil est ut nam consequuntur perspiciatis quas delectus ut quis eos voluptatem vitae cumque aut sed asperiores perspiciatis veritatis accusantium harum asperiores rerum et dolor architecto velit sed provident non totam.', 1113, 11, 11, 'Non animi temporibus optio.', '/images/produits/produit (24).jpg', 1335, 1),
(540, 'Antigua et Barbuda', 'Quidem sunt et et amet adipisci nostrum.', 'Tempore molestias ipsum asperiores sit rem in consectetur quos sit ab cupiditate consectetur explicabo sed velit est et delectus distinctio quae voluptatem consequatur minus vel explicabo vero perspiciatis assumenda magnam earum ut provident facere sunt est voluptatem cupiditate sed et similique et rerum eveniet et et quae aut veniam neque sunt sed omnis cum quia sit qui qui.', 1279, 13, 13, 'Eum aliquam hic deserunt ut.', '/images/produits/produit (28).jpg', 1534, 1),
(541, 'Samoa', 'Aut atque porro a.', 'Praesentium atque vel temporibus cumque dolorem id est suscipit libero consequatur tempore sunt repellat accusantium est illum numquam iusto quis nihil id sit harum deleniti libero non non quo quas iusto ut iusto incidunt officia voluptatibus sed molestiae beatae dolorem in velit doloremque cupiditate ut aut optio voluptate aut aliquid aliquid assumenda accusantium cumque quas quasi quisquam vitae officia in laboriosam nisi itaque accusamus sunt fugiat fugiat cumque modi dicta saepe debitis ducimus et.', 1118, 8, 8, 'Et quibusdam quisquam quia cumque.', '/images/produits/produit (24).jpg', 1341, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit_categorie`
--

CREATE TABLE `produit_categorie` (
  `produit_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit_categorie`
--

INSERT INTO `produit_categorie` (`produit_id`, `categorie_id`) VALUES
(522, 130),
(522, 132),
(523, 128),
(524, 129),
(524, 133),
(525, 128),
(526, 132),
(526, 133),
(527, 129),
(528, 128),
(528, 131),
(529, 128),
(529, 129),
(530, 134),
(531, 132),
(532, 128),
(532, 133),
(533, 129),
(533, 134),
(534, 131),
(534, 133),
(535, 131),
(536, 133),
(537, 130),
(537, 134),
(538, 130),
(539, 128),
(539, 133),
(540, 130),
(540, 131),
(541, 128),
(541, 131);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `conseiller_id` int(11) DEFAULT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom_entreprise` varchar(255) DEFAULT NULL,
  `matricule` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `conseiller_id`, `email`, `roles`, `password`, `nom`, `prenom`, `nom_entreprise`, `matricule`) VALUES
(409, NULL, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$aT1AycuPuqJMlfbec0BnwulnjZ2TdRQRWe2PkWpKp8ygtmpmzby1u', 'Admin', 'Admin', NULL, NULL),
(410, 415, 'user11@gmail.com', '[\"ROLE_USER\"]', '$2y$13$lQzF.JifCjjjRzBumKk9W.9/vZac2.vwFr6lS5wxgxVyVfLS9K9n2', 'Dumont', 'Gabrielle', NULL, NULL),
(411, 415, 'user12@gmail.com', '[\"ROLE_USER\"]', '$2y$13$qW3o30Hz4TfAeMqOaHXZmu/9mvcM.bnYyMLbnMUNfUpp.ogtg8bSO', 'Samson', 'Alexandre', NULL, NULL),
(412, 415, 'user13@gmail.com', '[\"ROLE_USER\"]', '$2y$13$44qGU/E1R4sjzMavT2p4xOnZVRVQMDDDfaeq/tW7qszt3b03CYes.', 'Bazin', 'Anastasie', NULL, NULL),
(413, 415, 'user14@gmail.com', '[\"ROLE_USER\"]', '$2y$13$eF0dslV59imqhJ94zV80cO0WClShXLf21KZs/jQAkvs944Zt4cVfu', 'Pereira', 'Lucas', NULL, NULL),
(414, 415, 'user15@gmail.com', '[\"ROLE_USER\"]', '$2y$13$xiNbEs8jNoQCgJxOJ3WZlONnUvrZcENdqzc7wIyErAxTMmvP0skZq', 'Leger', 'Jeanne', NULL, NULL),
(415, NULL, 'emp1@gmail.com', '[\"ROLE_EMP\"]', '$2y$13$cggCJ5InEuTKZkDE.aqKI.guKZ3f10LVMviB1i6hxidSqVdXoiyle', 'Gregoire', 'Virginie', 'Ventalis', 'EMP1643579fc76d2a'),
(416, 417, 'user21@gmail.com', '[\"ROLE_USER\"]', '$2y$13$TkiAOd35/Q8sdPTKn6B5Xu3R1YFNpc.WAKzZa..gR99Ize60rPTIS', 'Neveu', 'Tristan', NULL, NULL),
(417, NULL, 'emp2@gmail.com', '[\"ROLE_EMP\"]', '$2y$13$PYaDWCT/vJyk0PPdGHFa5O3yx4FHcmTZyjWm5p.XkDmdm2v3Z7qKW', 'Clement', 'Simone', 'Ventalis', 'EMP2643579ff0fa99'),
(418, 420, 'user31@gmail.com', '[\"ROLE_USER\"]', '$2y$13$4Oaz5Lxbqfn8lXNzaOpf.ej7u2rdlKGZADOGrRgKH3pYtix/UdmMu', 'Renaud', 'Valérie', NULL, NULL),
(419, 420, 'user32@gmail.com', '[\"ROLE_USER\"]', '$2y$13$dXVzJZUHNRAru/CrnCW.7uKGPAz/BHXpfP.XJqk7EsZtHmpqg.JOi', 'Lefebvre', 'Xavier', NULL, NULL),
(420, NULL, 'emp3@gmail.com', '[\"ROLE_EMP\"]', '$2y$13$elOQMgRWhA4pKA0qRMErg.vkiTVXdSvfjajuMfXURbiSVASfWNdZC', 'Maury', 'Dominique', 'Ventalis', 'EMP3643579ffe207a'),
(421, 426, 'user41@gmail.com', '[\"ROLE_USER\"]', '$2y$13$WTe9sbpRdrjD1REc5PtkYOt3KQHDjColkmHTVfyibFFPXXXHCUU6m', 'Delannoy', 'Jacqueline', NULL, NULL),
(422, 426, 'user42@gmail.com', '[\"ROLE_USER\"]', '$2y$13$9lBCegSmSVdsF8mAOFCbTeFnv/67NVCETvO9/D7zrdp/gNPSqlrpS', 'Faivre', 'Chantal', NULL, NULL),
(423, 426, 'user43@gmail.com', '[\"ROLE_USER\"]', '$2y$13$pRDsxNySlHN/oDJvQtdqV.aLHyx4eW90y4OjGE.qD7wEzoB/9HX8W', 'Maillot', 'Roger', NULL, NULL),
(424, 426, 'user44@gmail.com', '[\"ROLE_USER\"]', '$2y$13$RO5sonOMCKsve6FIULk30Ou43CF/rYVvbPbqj1R6hKQ.UVUey0IOa', 'Guerin', 'Henriette', NULL, NULL),
(425, 426, 'user45@gmail.com', '[\"ROLE_USER\"]', '$2y$13$JsqiJ7h73VoLnXy03h/cU.rhtSUTJLONyMIuhbszhVCg8LVHaJ4kS', 'Marion', 'Michèle', NULL, NULL),
(426, NULL, 'emp4@gmail.com', '[\"ROLE_EMP\"]', '$2y$13$8Ji7jjju0n8akczsEg0b7uuD5.bL4k4CMBT2ihgLEYG5eOINeHINy', 'Cordier', 'Gilbert', 'Ventalis', 'EMP464357a0136103'),
(427, 429, 'user51@gmail.com', '[\"ROLE_USER\"]', '$2y$13$Ny6fkL6jxOMmQob7Ob0Ws.4T8ExBN4TvQEU44tSY7TBYaZrcoi332', 'Meunier', 'Brigitte', NULL, NULL),
(428, 429, 'user52@gmail.com', '[\"ROLE_USER\"]', '$2y$13$T1i6Yt58kxi6zBuokZgfA.gHJ68f4nsNC3B68bjRldJLlqNxEzQRC', 'Royer', 'Josette', NULL, NULL),
(429, NULL, 'emp5@gmail.com', '[\"ROLE_EMP\"]', '$2y$13$7OQCCnTJHgB9nAnXnGzlKuxNt.npwPwrI445DTmFTZ6hG5pPXx.fi', 'Martel', 'Honoré', 'Ventalis', 'EMP564357a03c1c03'),
(430, 432, 'user61@gmail.com', '[\"ROLE_USER\"]', '$2y$13$LC4t0y0Q/PYL8lr/ZxqBw.cTVvxpaVpBChO/Sv6woy45iYUJ/YQ3u', 'Marty', 'Maurice', NULL, NULL),
(431, 432, 'user62@gmail.com', '[\"ROLE_USER\"]', '$2y$13$ePRf4zFAlXpXIfRsm.TrW.HqxDXHRddqoHoPUdcA10CXqcFlgPuCy', 'Maillard', 'David', NULL, NULL),
(432, NULL, 'emp6@gmail.com', '[\"ROLE_EMP\"]', '$2y$13$OYm.eX1senGrz4ImQvSpo.hORHEuqcm2piRLTn1Z/CP6gxzi6fMkC', 'Marchal', 'Patrick', 'Ventalis', 'EMP664357a05145e8'),
(433, 436, 'user71@gmail.com', '[\"ROLE_USER\"]', '$2y$13$J1HMul.y7ARNWjFwxNeP8uu9YZUtEs6/sbgrgisyutY7phTkUBejO', 'Jacquot', 'Constance', NULL, NULL),
(434, 436, 'user72@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OoLznDoqBI1njM3my3hxNeO.yhCRxlDpxrgZW81zzBtOjThOzw7H.', 'Lebrun', 'Margaux', NULL, NULL),
(435, 436, 'user73@gmail.com', '[\"ROLE_USER\"]', '$2y$13$/kjV9bGcI/N7k236aIVO5Od2rgJy1iGDOlEbMEVRxvBnSMGkfDLcG', 'Gregoire', 'Vincent', NULL, NULL),
(436, NULL, 'emp7@gmail.com', '[\"ROLE_EMP\"]', '$2y$13$rqqjLU3dBV22JAN0RxwQIOSvVi1iANXeKC8N0NxLEUNhbFu4SIwni', 'Jacob', 'Gérard', 'Ventalis', 'EMP764357a06575e3'),
(437, 439, 'user81@gmail.com', '[\"ROLE_USER\"]', '$2y$13$Ca.K.PON/DxYZtIvTr1dR.XrboBqCQL82MhsUrx1/wGOhAgbGmbyC', 'Herve', 'Caroline', NULL, NULL),
(438, 439, 'user82@gmail.com', '[\"ROLE_USER\"]', '$2y$13$wcskeIkF9vwbePbTr.l5U.Az/zut8c64XqbUJCQ8mwLhpny.fs47S', 'Prevost', 'Stéphane', NULL, NULL),
(439, NULL, 'emp8@gmail.com', '[\"ROLE_EMP\"]', '$2y$13$qQ8ldRvFVymnX6HEwgddaujo7JCOL1W2CVcPoDJCIDD14b2CZ6hWW', 'Hernandez', 'Susan', 'Ventalis', 'EMP864357a080ef93'),
(440, 444, 'user91@gmail.com', '[\"ROLE_USER\"]', '$2y$13$79QlOYp2xMEbvJfto1WBeea9FELrMZKxqpKcFKebBuN6UbD.mUS2K', 'Fournier', 'Odette', NULL, NULL),
(441, 444, 'user92@gmail.com', '[\"ROLE_USER\"]', '$2y$13$IBnxT8Y9qI4tFlDXC96kJeTPwDBviYhErDoC/8Gx6PueNoM4gR//G', 'Foucher', 'Hugues', NULL, NULL),
(442, 444, 'user93@gmail.com', '[\"ROLE_USER\"]', '$2y$13$.0hEn5AucdBzd79/pPFX5OjIL8X5K/M1ABiYCo1ln.CUENSTJOrCS', 'Raymond', 'Jeanne', NULL, NULL),
(443, 444, 'user94@gmail.com', '[\"ROLE_USER\"]', '$2y$13$zu9zrXtuOz7d80D1WIrMSeYZ9hrr5o6zzYm9u6eFzHIpqCJBJkGmq', 'Bertin', 'Stéphane', NULL, NULL),
(444, NULL, 'emp9@gmail.com', '[\"ROLE_EMP\"]', '$2y$13$2AF2gInbcuG/c5wxxMAQheM28819.2TbjNinZjMBbu5M4ewCtJcs6', 'Gomez', 'Henri', 'Ventalis', 'EMP964357a0951d63');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achat`
--
ALTER TABLE `achat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_26A98456F347EFB` (`produit_id`),
  ADD KEY `IDX_26A984563D865311` (`planning_id`),
  ADD KEY `IDX_26A98456A76ED395` (`user_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D499BFF6F347EFB` (`produit_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit_categorie`
--
ALTER TABLE `produit_categorie`
  ADD PRIMARY KEY (`produit_id`,`categorie_id`),
  ADD KEY `IDX_CDEA88D8F347EFB` (`produit_id`),
  ADD KEY `IDX_CDEA88D8BCF5E72D` (`categorie_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D6491AC39A0D` (`conseiller_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achat`
--
ALTER TABLE `achat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `planning`
--
ALTER TABLE `planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=746;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=542;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=445;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `FK_26A984563D865311` FOREIGN KEY (`planning_id`) REFERENCES `planning` (`id`),
  ADD CONSTRAINT `FK_26A98456A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_26A98456F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `planning`
--
ALTER TABLE `planning`
  ADD CONSTRAINT `FK_D499BFF6F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit_categorie`
--
ALTER TABLE `produit_categorie`
  ADD CONSTRAINT `FK_CDEA88D8BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDEA88D8F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6491AC39A0D` FOREIGN KEY (`conseiller_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
