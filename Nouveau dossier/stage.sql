-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 30 août 2024 à 14:59
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `actors`
--

CREATE TABLE `actors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `article_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`) VALUES
(1, 'Analyse de Charmed', 'Cet article fournit une analyse approfondie de la série Charmed, en explorant ses personnages, intrigues et thèmes.'),
(2, 'Les secrets de Once Upon a Time', 'Découvrez les mystères et les intrigues qui se cachent derrière la série Once Upon a Time.'),
(3, 'Madame...Monsieur: Quand le drame urbain rencontre la réalité Camerounaise', 'Une analyse du drame urbain dans le contexte camerounais, mettant en lumière les enjeux sociaux et culturels.'),
(4, 'Les meilleurs moments de Bones', 'Revivez les moments les plus marquants de la série Bones, avec des scènes emblématiques et des résolutions de mystères.'),
(5, 'Suits: Avocats sur Mesure', 'Examinez la série Suits à travers ses intrigues juridiques et ses personnages charismatiques.'),
(6, 'Les moments inoubliables de Friends', 'Une rétrospective des moments les plus mémorables de la série Friends.');

-- --------------------------------------------------------

--
-- Structure de la table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `season_id` int(11) DEFAULT NULL,
  `episode_number` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `episodes`
--

INSERT INTO `episodes` (`id`, `season_id`, `episode_number`, `title`, `video_url`) VALUES
(1, 1, 1, 'Something Wicca This Way Comes', 'vidéos/shadowhunters SO1E01.mp4'),
(2, 1, 2, 'Ive Got You Under My Skin', 'vidéos/shadowhunters SO1E01.mp4'),
(3, 1, 3, 'Thank You for Not Morphing', 'vidéos/shadowhunters SO1E01.mp4'),
(4, 1, 4, 'The Witch Is Back', 'vidéos/shadowhunters SO1E01.mp4'),
(5, 1, 5, 'Dream Sorcerer', 'vidéos/shadowhunters SO1E01.mp4'),
(6, 1, 6, 'The Wedding from Hell', 'vidéos/shadowhunters SO1E01.mp4'),
(7, 1, 7, 'The Fourth Sister', 'vidéos/shadowhunters SO1E01.mp4'),
(8, 1, 8, 'The Truth Is Out There...', 'vidéos/shadowhunters SO1E01.mp4'),
(9, 1, 9, 'The Witch Is Back', 'vidéos/shadowhunters SO1E01.mp4'),
(10, 1, 10, 'Revelations', 'vidéos/shadowhunters SO1E01.mp4'),
(11, 1, 11, 'Wicca Envy', 'vidéos/shadowhunters SO1E01.mp4'),
(12, 1, 12, 'Feats of Clay', 'vidéos/shadowhunters SO1E01.mp4'),
(13, 1, 13, 'The Power of Two', 'vidéos/shadowhunters SO1E01.mp4'),
(14, 1, 14, 'The Power of Three Blondes', 'vidéos/shadowhunters SO1E01.mp4'),
(15, 1, 15, 'Is There a Woogy in the House?', 'vidéos/shadowhunters SO1E01.mp4'),
(16, 1, 16, 'Which Prue Is It, Anyway?', 'vidéos/shadowhunters SO1E01.mp4'),
(17, 1, 17, 'That 70s Episode', 'vidéos/shadowhunters SO1E01.mp4'),
(18, 1, 18, 'When Bad Warlocks Go Good', 'vidéos/shadowhunters SO1E01.mp4'),
(19, 1, 19, 'A Witchs Tail', 'vidéos/shadowhunters SO1E01.mp4'),
(20, 1, 20, 'Out of Sight', 'vidéos/shadowhunters SO1E01.mp4'),
(21, 1, 21, 'The Power of Three', 'vidéos/shadowhunters SO1E01.mp4'),
(22, 1, 22, 'Deja Vu All Over Again', 'vidéos/shadowhunters SO1E01.mp4'),
(23, 2, 1, 'The Source Awakens', 'vidéos/shadowhunters SO1E01.mp4'),
(24, 2, 2, 'The Good, The Bad, and The Cursed', 'vidéos/shadowhunters SO1E01.mp4'),
(25, 2, 3, 'The Devils Music', 'vidéos/shadowhunters SO1E01.mp4'),
(26, 2, 4, 'The Witchs Tail', 'vidéos/shadowhunters SO1E01.mp4'),
(27, 2, 5, 'Shes a Man, Baby, a Man!', 'vidéos/shadowhunters SO1E01.mp4'),
(28, 2, 6, 'That 70s Episode', 'vidéos/shadowhunters SO1E01.mp4'),
(29, 2, 7, 'Pardon My Past', 'vidéos/shadowhunters SO1E01.mp4'),
(30, 2, 8, 'The Truth Is Out There...', 'vidéos/shadowhunters SO1E01.mp4'),
(31, 2, 9, 'The Power of Two', 'vidéos/shadowhunters SO1E01.mp4'),
(32, 2, 10, 'Reckless Abandon', 'vidéos/shadowhunters SO1E01.mp4'),
(33, 2, 11, 'The Witchs Familiar', 'vidéos/shadowhunters SO1E01.mp4'),
(34, 2, 12, 'The Power of Three', 'vidéos/shadowhunters SO1E01.mp4'),
(35, 2, 13, 'The Good, The Bad, and The Cursed', 'vidéos/shadowhunters SO1E01.mp4'),
(36, 2, 14, 'The Source Awakens', 'vidéos/shadowhunters SO1E01.mp4'),
(37, 2, 15, 'Charmed Again: Part 1', 'vidéos/shadowhunters SO1E01.mp4'),
(38, 2, 16, 'Charmed Again: Part 2', 'vidéos/shadowhunters SO1E01.mp4'),
(39, 2, 17, 'A Wrong Days Journey into Right', 'vidéos/shadowhunters SO1E01.mp4'),
(40, 2, 18, 'The Devils Music', 'vidéos/shadowhunters SO1E01.mp4'),
(41, 2, 19, 'The Cursed Child', 'vidéos/shadowhunters SO1E01.mp4'),
(42, 2, 20, 'Be Careful What You Witch For', 'vidéos/shadowhunters SO1E01.mp4'),
(43, 2, 21, 'Witch Trial', 'vidéos/shadowhunters SO1E01.mp4'),
(44, 2, 22, 'All Halliwells Eve', 'vidéos/shadowhunters SO1E01.mp4'),
(45, 2, 4, 'The Witchs Tail', 'vidéos/shadowhunters SO1E02.mp4'),
(46, 2, 5, 'Shes a Man, Baby, a Man!', 'vidéos/shadowhunters SO1E02.mp4'),
(47, 2, 6, 'That 70s Episode', 'vidéos/shadowhunters SO1E02.mp4'),
(48, 2, 7, 'Pardon My Past', 'vidéos/shadowhunters SO1E02.mp4'),
(49, 2, 8, 'The Truth Is Out There...', 'vidéos/shadowhunters SO1E02.mp4'),
(50, 2, 9, 'The Power of Two', 'vidéos/shadowhunters SO1E02.mp4'),
(51, 2, 10, 'Reckless Abandon', 'vidéos/shadowhunters SO1E02.mp4'),
(52, 2, 11, 'The Witchs Familiar', 'vidéos/shadowhunters SO1E02.mp4'),
(53, 2, 12, 'The Power of Three', 'vidéos/shadowhunters SO1E02.mp4'),
(54, 2, 13, 'The Good, The Bad, and The Cursed', 'vidéos/shadowhunters SO1E02.mp4'),
(55, 2, 14, 'The Source Awakens', 'vidéos/shadowhunters SO1E02.mp4'),
(56, 2, 15, 'Charmed Again: Part 1', 'vidéos/shadowhunters SO1E02.mp4'),
(57, 2, 16, 'Charmed Again: Part 2', 'vidéos/shadowhunters SO1E02.mp4'),
(58, 2, 17, 'A Wrong Days Journey into Right', 'vidéos/shadowhunters SO1E02.mp4'),
(59, 2, 18, 'The Devils Music', 'vidéos/shadowhunters SO1E02.mp4'),
(60, 2, 19, 'The Cursed Child', 'vidéos/shadowhunters SO1E02.mp4'),
(61, 2, 20, 'Be Careful What You Witch For', 'vidéos/shadowhunters SO1E02.mp4'),
(62, 2, 21, 'Witch Trial', 'vidéos/shadowhunters SO1E02.mp4'),
(63, 2, 22, 'All Halliwells Eve', 'vidéos/shadowhunters SO1E02.mp4'),
(64, 3, 1, 'The Honeymoons Over', 'vidéos/shadowhunters SO1E02.mp4'),
(65, 3, 2, 'Magic Hour', 'vidéos/shadowhunters SO1E02.mp4'),
(66, 3, 3, 'Once Upon a Time', 'vidéos/shadowhunters SO1E02.mp4'),
(67, 3, 4, 'Mummy Dearest', 'vidéos/shadowhunters SO1E02.mp4'),
(68, 3, 5, 'Whistle While He Works', 'vidéos/shadowhunters SO1E02.mp4'),
(69, 3, 6, 'The Good, The Bad, And The Cursed', 'vidéos/shadowhunters SO1E02.mp4'),
(70, 3, 7, 'The Power of Three Blondes', 'vidéos/shadowhunters SO1E02.mp4'),
(71, 3, 8, 'Sleuthing with the Enemy', 'vidéos/shadowhunters SO1E02.mp4'),
(72, 3, 9, 'The Courtship of Wyatts Father', 'vidéos/shadowhunters SO1E02.mp4'),
(73, 3, 10, 'The Phantom Menace', 'vidéos/shadowhunters SO1E02.mp4'),
(74, 3, 11, 'The Power of Three', 'vidéos/shadowhunters SO1E02.mp4'),
(75, 3, 12, 'The Demon Who Came in from the Cold', 'vidéos/shadowhunters SO1E02.mp4'),
(76, 3, 13, 'The Eyes Have It', 'vidéos/shadowhunters SO1E02.mp4'),
(77, 3, 14, 'Bride and Gloom', 'vidéos/shadowhunters SO1E02.mp4'),
(78, 3, 15, 'The Witchs Tail', 'vidéos/shadowhunters SO1E02.mp4'),
(79, 3, 16, 'The Truth Is Out There', 'vidéos/shadowhunters SO1E02.mp4'),
(80, 3, 17, 'The Seven Year Witch', 'vidéos/shadowhunters SO1E02.mp4'),
(81, 3, 18, 'The Demon Who Came in from the Cold', 'vidéos/shadowhunters SO1E02.mp4'),
(82, 3, 19, 'The Three Faces of Phoebe', 'vidéos/shadowhunters SO1E02.mp4'),
(83, 3, 20, 'The New Witch in Town', 'vidéos/shadowhunters SO1E02.mp4'),
(84, 3, 21, 'The Witch is Back', 'vidéos/shadowhunters SO1E02.mp4'),
(85, 3, 22, 'The Return of the Guardian', 'vidéos/shadowhunters SO1E02.mp4'),
(86, 4, 1, 'Charmed Again (Part 1)', 'vidéos/shadowhunters SO1E02.mp4'),
(87, 4, 2, 'Charmed Again (Part 2)', 'vidéos/shadowhunters SO1E02.mp4'),
(88, 4, 3, 'Hell Hath No Fury', 'vidéos/shadowhunters SO1E02.mp4'),
(89, 4, 4, 'Size Matters', 'vidéos/shadowhunters SO1E02.mp4'),
(90, 4, 5, 'The Fifth Halliwell', 'vidéos/shadowhunters SO1E02.mp4'),
(91, 4, 6, 'Brain Drain', 'vidéos/shadowhunters SO1E02.mp4'),
(92, 4, 7, 'A Knight to Remember', 'vidéos/shadowhunters SO1E02.mp4'),
(93, 4, 8, 'I Dream of Phoebe', 'vidéos/shadowhunters SO1E02.mp4'),
(94, 4, 9, 'The Sword and the City', 'vidéos/shadowhunters SO1E02.mp4'),
(95, 4, 10, 'The Great Brunch', 'vidéos/shadowhunters SO1E02.mp4'),
(96, 4, 11, 'The Three Faces of Phoebe', 'vidéos/shadowhunters SO1E02.mp4'),
(97, 4, 12, 'Lost and Bound', 'vidéos/shadowhunters SO1E02.mp4'),
(98, 4, 13, 'Charmed and Dangerous', 'vidéos/shadowhunters SO1E02.mp4'),
(99, 4, 14, 'The Demon Who Came in from the Cold', 'vidéos/shadowhunters SO1E02.mp4'),
(100, 4, 15, 'The Witchs Tail (Part 1)', 'vidéos/shadowhunters SO1E02.mp4'),
(101, 4, 16, 'The Witchs Tail (Part 2)', 'vidéos/shadowhunters SO1E02.mp4'),
(102, 4, 17, 'The Magic Bullet', 'vidéos/shadowhunters SO1E02.mp4'),
(103, 4, 18, 'The Family Business', 'vidéos/shadowhunters SO1E02.mp4'),
(104, 4, 19, 'The Legend of Sleepy Halliwell', 'vidéos/shadowhunters SO1E02.mp4'),
(105, 4, 20, 'The Three Faces of Phoebe', 'vidéos/shadowhunters SO1E02.mp4'),
(106, 4, 21, 'The Power of Three', 'vidéos/shadowhunters SO1E02.mp4'),
(107, 4, 22, 'Forever Charmed', 'vidéos/shadowhunters SO1E02.mp4'),
(108, 5, 1, 'A Witchs Tail (Part 1)', 'vidéos/shadowhunters SO1E02.mp4'),
(109, 5, 2, 'A Witchs Tail (Part 2)', 'vidéos/shadowhunters SO1E02.mp4'),
(110, 5, 3, 'Charmageddon', 'vidéos/shadowhunters SO1E02.mp4'),
(111, 5, 4, 'The Eyes Have It', 'vidéos/shadowhunters SO1E02.mp4'),
(112, 5, 5, 'The Importance of Being Phoebe', 'vidéos/shadowhunters SO1E02.mp4'),
(113, 5, 6, 'Sam I Am', 'vidéos/shadowhunters SO1E02.mp4'),
(114, 5, 7, 'The Day the Magic Died', 'vidéos/shadowhunters SO1E02.mp4'),
(115, 5, 8, 'Rewitched', 'vidéos/shadowhunters SO1E02.mp4'),
(116, 5, 9, 'Coyote Piper', 'vidéos/shadowhunters SO1E02.mp4'),
(117, 5, 10, 'Nymphs Just Wanna Have Fun', 'vidéos/shadowhunters SO1E02.mp4'),
(118, 5, 11, 'Siren Song', 'vidéos/shadowhunters SO1E02.mp4'),
(119, 5, 12, 'The Ultimate Battle', 'vidéos/shadowhunters SO1E02.mp4'),
(120, 5, 13, 'House Call', 'vidéos/shadowhunters SO1E02.mp4'),
(121, 5, 14, 'The Seven Year Witch', 'vidéos/shadowhunters SO1E02.mp4'),
(122, 5, 15, 'The Power of Three Blondes', 'vidéos/shadowhunters SO1E02.mp4'),
(123, 5, 16, 'The Shining', 'vidéos/shadowhunters SO1E02.mp4'),
(124, 5, 17, 'The Professor', 'vidéos/shadowhunters SO1E02.mp4'),
(125, 5, 18, 'A Witchs Tail', 'vidéos/shadowhunters SO1E02.mp4'),
(126, 5, 19, 'The Return of the Ring', 'vidéos/shadowhunters SO1E02.mp4'),
(127, 5, 20, 'The Power of Three', 'vidéos/shadowhunters SO1E02.mp4'),
(128, 5, 21, 'Forever Charmed', 'vidéos/shadowhunters SO1E02.mp4'),
(129, 5, 22, 'Episode 22', 'vidéos/shadowhunters SO1E02.mp4'),
(130, 6, 1, 'The Haunted House', 'vidéos/shadowhunters SO1E02.mp4'),
(131, 6, 2, 'The Telling', 'vidéos/shadowhunters SO1E02.mp4'),
(132, 6, 3, 'Forget Me Not', 'vidéos/shadowhunters SO1E02.mp4'),
(133, 6, 4, 'The Courtship of Wyatts Father', 'vidéos/shadowhunters SO1E02.mp4'),
(134, 6, 5, 'The Legend of Sleepy Halliwell', 'vidéos/shadowhunters SO1E02.mp4'),
(135, 6, 6, 'A Witch in Time', 'vidéos/shadowhunters SO1E02.mp4'),
(136, 6, 7, 'Sword in the Stone', 'vidéos/shadowhunters SO1E02.mp4'),
(137, 6, 8, 'The Lost One', 'vidéos/shadowhunters SO1E02.mp4'),
(138, 6, 9, 'The Power of Three', 'vidéos/shadowhunters SO1E02.mp4'),
(139, 6, 10, 'A Wrong Days Journey into Right', 'vidéos/shadowhunters SO1E02.mp4'),
(140, 6, 11, 'The Good, The Bad, and the Cursed', 'vidéos/shadowhunters SO1E02.mp4'),
(141, 6, 12, 'I Dream of Phoebe', 'vidéos/shadowhunters SO1E02.mp4'),
(142, 6, 13, 'The Legend of the Seer', 'vidéos/shadowhunters SO1E02.mp4'),
(143, 6, 14, 'The Crucible', 'vidéos/shadowhunters SO1E02.mp4'),
(144, 6, 15, 'The Return of the Ring', 'vidéos/shadowhunters SO1E02.mp4'),
(145, 6, 16, 'The Last Temptation of Christy', 'vidéos/shadowhunters SO1E02.mp4'),
(146, 6, 17, 'The Truth is Out There', 'vidéos/shadowhunters SO1E02.mp4'),
(147, 6, 18, 'The Haunted Halliwell', 'vidéos/shadowhunters SO1E02.mp4'),
(148, 6, 19, 'Witchs Tale', 'vidéos/shadowhunters SO1E02.mp4'),
(149, 6, 20, 'A New Beginning', 'vidéos/shadowhunters SO1E02.mp4'),
(150, 6, 21, 'The Ultimate Battle', 'vidéos/shadowhunters SO1E02.mp4'),
(151, 6, 22, 'Episode 22', 'vidéos/shadowhunters SO1E02.mp4'),
(152, 7, 1, 'A Call to Arms', 'vidéos/shadowhunters SO1E02.mp4'),
(153, 7, 2, 'The Bare Witch Project', 'vidéos/shadowhunters SO1E02.mp4'),
(154, 7, 3, 'Cheaper by the Coven', 'vidéos/shadowhunters SO1E02.mp4'),
(155, 7, 4, 'Charrrmed!', 'vidéos/shadowhunters SO1E02.mp4'),
(156, 7, 5, 'The Eyes Have It', 'vidéos/shadowhunters SO1E02.mp4'),
(157, 7, 6, 'The Power of Three Blondes', 'vidéos/shadowhunters SO1E02.mp4'),
(158, 7, 7, 'The Seven Year Witch', 'vidéos/shadowhunters SO1E02.mp4'),
(159, 7, 8, 'The Lost One', 'vidéos/shadowhunters SO1E02.mp4'),
(160, 7, 9, 'Witchness Protection', 'vidéos/shadowhunters SO1E02.mp4'),
(161, 7, 10, 'Theres No Place Like Home', 'vidéos/shadowhunters SO1E02.mp4'),
(162, 7, 11, 'The Devils Music', 'vidéos/shadowhunters SO1E02.mp4'),
(163, 7, 12, 'The Last Temptation of Christy', 'vidéos/shadowhunters SO1E02.mp4'),
(164, 7, 13, 'The Truth is Out There', 'vidéos/shadowhunters SO1E02.mp4'),
(165, 7, 14, 'The Witch is Back', 'vidéos/shadowhunters SO1E02.mp4'),
(166, 7, 15, 'The Good, the Bad and the Cursed', 'vidéos/shadowhunters SO1E02.mp4'),
(167, 7, 16, 'The Ultimate Battle', 'vidéos/shadowhunters SO1E02.mp4'),
(168, 7, 17, 'The Return of the Seer', 'vidéos/shadowhunters SO1E02.mp4'),
(169, 7, 18, 'A Wrong Days Journey into Right', 'vidéos/shadowhunters SO1E02.mp4'),
(170, 7, 19, 'The Legend of Sleepy Halliwell', 'vidéos/shadowhunters SO1E02.mp4'),
(171, 7, 20, 'The Last Temptation of Christy', 'vidéos/shadowhunters SO1E02.mp4'),
(172, 7, 21, 'The Ultimate Battle', 'vidéos/shadowhunters SO1E02.mp4'),
(173, 7, 22, 'Episode 22', 'vidéos/shadowhunters SO1E02.mp4'),
(174, 8, 1, 'Still Charmed & Kicking', 'vidéos/shadowhunters SO1E02.mp4'),
(175, 8, 2, 'Malice in Wonderland', 'vidéos/shadowhunters SO1E02.mp4'),
(176, 8, 3, 'The Last Temptation of Christy', 'vidéos/shadowhunters SO1E02.mp4'),
(177, 8, 4, 'Desperate Housewitches', 'vidéos/shadowhunters SO1E02.mp4'),
(178, 8, 5, 'The Perfect Family', 'vidéos/shadowhunters SO1E02.mp4'),
(179, 8, 6, 'The Lost One', 'vidéos/shadowhunters SO1E02.mp4'),
(180, 8, 7, 'The Bare Witch Project', 'vidéos/shadowhunters SO1E02.mp4'),
(181, 8, 8, 'The Witch is Back', 'vidéos/shadowhunters SO1E02.mp4'),
(182, 8, 9, 'The Good, the Bad and the Cursed', 'vidéos/shadowhunters SO1E02.mp4'),
(183, 8, 10, 'The Truth is Out There', 'vidéos/shadowhunters SO1E02.mp4'),
(184, 8, 11, 'The Devils Music', 'vidéos/shadowhunters SO1E02.mp4'),
(185, 8, 12, 'The Seer', 'vidéos/shadowhunters SO1E02.mp4'),
(186, 8, 13, 'The Demon Who Came in from the Cold', 'vidéos/shadowhunters SO1E02.mp4'),
(187, 8, 14, 'The Return of the Seer', 'vidéos/shadowhunters SO1E02.mp4'),
(188, 8, 15, 'The Seven Year Witch', 'vidéos/shadowhunters SO1E02.mp4'),
(189, 8, 16, 'The Witchs Tale', 'vidéos/shadowhunters SO1E02.mp4'),
(190, 8, 17, 'The Ultimate Battle', 'vidéos/shadowhunters SO1E02.mp4'),
(191, 8, 18, 'The End is Near', 'vidéos/shadowhunters SO1E02.mp4'),
(192, 8, 19, 'The Goodbye Girl', 'vidéos/shadowhunters SO1E02.mp4'),
(193, 8, 20, 'The Final Chapter', 'vidéos/shadowhunters SO1E02.mp4'),
(194, 8, 21, 'The Last Temptation of Christy', 'vidéos/shadowhunters SO1E02.mp4'),
(195, 8, 22, 'Episode 22', 'vidéos/shadowhunters SO1E02.mp4'),
(219, 9, 2, 'Fastest Man Alive', 'vidéos/shadowhunters SO1E02.mp4'),
(220, 9, 3, 'Things You Can\'t Outrun', 'vidéos/shadowhunters SO1E02.mp4'),
(221, 9, 4, 'Going Rogue', 'vidéos/shadowhunters SO1E02.mp4'),
(222, 9, 5, 'Plastique', 'vidéos/shadowhunters SO1E02.mp4'),
(223, 9, 6, 'The Flash Is Born', 'vidéos/shadowhunters SO1E02.mp4'),
(224, 9, 7, 'Power Outage', 'vidéos/shadowhunters SO1E02.mp4'),
(225, 9, 8, 'Flash vs. Arrow', 'vidéos/shadowhunters SO1E02.mp4'),
(226, 9, 9, 'The Man in the Yellow Suit', 'vidéos/shadowhunters SO1E02.mp4'),
(227, 9, 10, 'Revenge of the Rogues', 'vidéos/shadowhunters SO1E02.mp4'),
(228, 9, 11, 'The Sound and the Fury', 'vidéos/shadowhunters SO1E02.mp4'),
(229, 9, 12, 'Crazy for You', 'vidéos/shadowhunters SO1E02.mp4'),
(230, 9, 13, 'The Nuclear Man', 'vidéos/shadowhunters SO1E02.mp4'),
(231, 9, 14, 'Fallout', 'vidéos/shadowhunters SO1E02.mp4'),
(232, 9, 15, 'Out of Time', 'vidéos/shadowhunters SO1E02.mp4'),
(233, 9, 16, 'Rogue Time', 'vidéos/shadowhunters SO1E02.mp4'),
(234, 9, 17, 'Tricksters', 'vidéos/shadowhunters SO1E02.mp4'),
(235, 9, 18, 'All Star Team Up', 'vidéos/shadowhunters SO1E02.mp4'),
(236, 9, 19, 'Who Is Harrison Wells?', 'vidéos/shadowhunters SO1E02.mp4'),
(237, 9, 20, 'The Trap', 'vidéos/shadowhunters SO1E02.mp4'),
(238, 9, 21, 'Grodd Lives', 'vidéos/shadowhunters SO1E02.mp4'),
(239, 9, 22, 'Rogue Air', 'vidéos/shadowhunters SO1E02.mp4'),
(240, 10, 1, 'The Man Who Saved Central City', 'vidéos/shadowhunters SO1E02.mp4'),
(241, 10, 2, 'Flash of Two Worlds', 'vidéos/shadowhunters SO1E02.mp4'),
(242, 10, 3, 'Family of Rogues', 'vidéos/shadowhunters SO1E02.mp4'),
(243, 10, 4, 'The Fury of Firestorm', 'vidéos/shadowhunters SO1E02.mp4'),
(244, 10, 5, 'The Darkness and the Light', 'vidéos/shadowhunters SO1E02.mp4'),
(245, 10, 6, 'Enter Zoom', 'vidéos/shadowhunters SO1E02.mp4'),
(246, 10, 7, 'Gorilla Warfare', 'vidéos/shadowhunters SO1E02.mp4'),
(247, 10, 8, 'Legends of Today', 'vidéos/shadowhunters SO1E02.mp4'),
(248, 10, 9, 'Legends of Yesterday', 'vidéos/shadowhunters SO1E02.mp4'),
(249, 10, 10, 'Potential Energy', 'vidéos/shadowhunters SO1E02.mp4'),
(250, 10, 11, 'The Reverse-Flash Returns', 'vidéos/shadowhunters SO1E02.mp4'),
(251, 10, 12, 'Fast Lane', 'vidéos/shadowhunters SO1E02.mp4'),
(252, 10, 13, 'Welcome to Earth-2', 'vidéos/shadowhunters SO1E02.mp4'),
(253, 10, 14, 'Escape from Earth-2', 'vidéos/shadowhunters SO1E02.mp4'),
(254, 10, 15, 'King Shark', 'vidéos/shadowhunters SO1E02.mp4'),
(255, 10, 16, 'Trajectory', 'vidéos/shadowhunters SO1E02.mp4'),
(256, 10, 17, 'Flash Back', 'vidéos/shadowhunters SO1E02.mp4'),
(257, 10, 18, 'Versus Zoom', 'vidéos/shadowhunters SO1E02.mp4'),
(258, 10, 19, 'Back to Normal', 'vidéos/shadowhunters SO1E02.mp4'),
(259, 10, 20, 'Rupture', 'vidéos/shadowhunters SO1E02.mp4'),
(260, 10, 21, 'The Runaway Dinosaur', 'vidéos/shadowhunters SO1E02.mp4'),
(261, 10, 22, 'Invincible', 'vidéos/shadowhunters SO1E02.mp4'),
(262, 11, 1, 'Flashpoint', 'vidéos/shadowhunters SO1E02.mp4'),
(263, 11, 2, 'Paradox', 'vidéos/shadowhunters SO1E02.mp4'),
(264, 11, 3, 'Magenta', 'vidéos/shadowhunters SO1E02.mp4'),
(265, 11, 4, 'The New Rogues', 'vidéos/shadowhunters SO1E02.mp4'),
(266, 11, 5, 'Monster', 'vidéos/shadowhunters SO1E02.mp4'),
(267, 11, 6, 'Shade', 'vidéos/shadowhunters SO1E02.mp4'),
(268, 11, 7, 'Killer Frost', 'vidéos/shadowhunters SO1E02.mp4'),
(269, 11, 8, 'Invasion!', 'vidéos/shadowhunters SO1E02.mp4'),
(270, 6, 9, 'The Power of Three', 'vidéos/shadowhunters SO1E02.mp4'),
(271, 11, 10, 'Borrowing Problems from the Future', 'vidéos/shadowhunters SO1E02.mp4'),
(272, 11, 11, 'Dead or Alive', 'vidéos/shadowhunters SO1E02.mp4'),
(273, 11, 12, 'Untouchable', 'vidéos/shadowhunters SO1E02.mp4'),
(274, 11, 13, 'Attack on Gorilla City', 'vidéos/shadowhunters SO1E02.mp4'),
(275, 11, 14, 'Attack on Central City', 'vidéos/shadowhunters SO1E02.mp4'),
(276, 11, 15, 'The Wrath of Savitar', 'vidéos/shadowhunters SO1E02.mp4'),
(277, 11, 16, 'Into the Speed Force', 'vidéos/shadowhunters SO1E02.mp4'),
(278, 11, 17, 'Duet', 'vidéos/shadowhunters SO1E02.mp4'),
(279, 11, 18, 'Abracadabra', 'vidéos/shadowhunters SO1E02.mp4'),
(280, 11, 19, 'Cause and Effect', 'vidéos/shadowhunters SO1E02.mp4'),
(281, 11, 20, 'I Know Who You Are', 'vidéos/shadowhunters SO1E02.mp4'),
(282, 11, 21, 'The Once and Future Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(283, 11, 22, 'Infantino Street', 'vidéos/shadowhunters SO1E02.mp4'),
(284, 12, 1, 'The Flash Reborn', 'vidéos/shadowhunters SO1E02.mp4'),
(285, 12, 2, 'Mixed Signals', 'vidéos/shadowhunters SO1E02.mp4'),
(286, 12, 3, 'Luck Be a Lady', 'vidéos/shadowhunters SO1E02.mp4'),
(287, 12, 4, 'Elongated Journey Into Night', 'vidéos/shadowhunters SO1E02.mp4'),
(288, 12, 5, 'The New Rogues', 'vidéos/shadowhunters SO1E02.mp4'),
(289, 12, 6, 'The Darkness and the Light', 'vidéos/shadowhunters SO1E02.mp4'),
(290, 12, 7, 'The Flash & The Furious', 'vidéos/shadowhunters SO1E02.mp4'),
(291, 12, 8, 'Crisis on Earth-X, Part 1', 'vidéos/shadowhunters SO1E02.mp4'),
(292, 12, 9, 'Crisis on Earth-X, Part 2', 'vidéos/shadowhunters SO1E02.mp4'),
(293, 12, 10, 'The Trial of The Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(294, 12, 11, 'The Elongated Man', 'vidéos/shadowhunters SO1E02.mp4'),
(295, 12, 12, 'Tales of the Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(296, 12, 13, 'The Once and Future Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(297, 12, 14, 'Attack on Central City', 'vidéos/shadowhunters SO1E02.mp4'),
(298, 12, 15, 'Enter Flashtime', 'vidéos/shadowhunters SO1E02.mp4'),
(299, 12, 16, 'Run, Iris, Run', 'vidéos/shadowhunters SO1E02.mp4'),
(300, 12, 17, 'The Flash & The Furious', 'vidéos/shadowhunters SO1E02.mp4'),
(301, 12, 18, 'Doomsday', 'vidéos/shadowhunters SO1E02.mp4'),
(302, 12, 19, 'We Are the Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(303, 12, 20, 'The Flash: The Elongated Man', 'vidéos/shadowhunters SO1E02.mp4'),
(304, 12, 21, 'The Elongated Man: Crisis', 'vidéos/shadowhunters SO1E02.mp4'),
(305, 12, 22, 'We Are the Flash: Part 2', 'vidéos/shadowhunters SO1E02.mp4'),
(306, 13, 1, 'Nora', 'vidéos/shadowhunters SO1E02.mp4'),
(307, 13, 2, 'Blocked', 'vidéos/shadowhunters SO1E02.mp4'),
(308, 13, 3, 'The Death of Vibe', 'vidéos/shadowhunters SO1E02.mp4'),
(309, 13, 4, 'News Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(310, 13, 5, 'The Beast of Saint Patricks Day', 'vidéos/shadowhunters SO1E02.mp4'),
(311, 13, 6, 'The Inheritance', 'vidéos/shadowhunters SO1E02.mp4'),
(312, 13, 7, 'The Death of Vibe', 'vidéos/shadowhunters SO1E02.mp4'),
(313, 13, 8, 'Crisis on Earth-X Part 1', 'vidéos/shadowhunters SO1E02.mp4'),
(314, 13, 9, 'Crisis on Earth-X, Part 2', 'vidéos/shadowhunters SO1E02.mp4'),
(315, 13, 10, 'The Trial of The Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(316, 13, 11, 'The Elongated Man', 'vidéos/shadowhunters SO1E02.mp4'),
(317, 13, 12, 'The Thinker', 'vidéos/shadowhunters SO1E02.mp4'),
(318, 13, 13, 'Memories', 'vidéos/shadowhunters SO1E02.mp4'),
(319, 13, 14, 'The Reverse-Flash Returns', 'vidéos/shadowhunters SO1E02.mp4'),
(320, 13, 15, 'King Shark vs. Gorilla Grodd', 'vidéos/shadowhunters SO1E02.mp4'),
(321, 13, 16, 'The Elongated Man', 'vidéos/shadowhunters SO1E02.mp4'),
(322, 13, 17, 'The Flash & The Furious', 'vidéos/shadowhunters SO1E02.mp4'),
(323, 13, 18, 'The Trial of The Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(324, 13, 19, 'Doomsday', 'vidéos/shadowhunters SO1E02.mp4'),
(325, 13, 20, 'We Are the Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(326, 13, 21, 'The Elongated Man: Crisis', 'vidéos/shadowhunters SO1E02.mp4'),
(327, 13, 22, 'We Are the Flash: Part 2', 'vidéos/shadowhunters SO1E02.mp4'),
(350, 18, 1, 'Sweet Tea and Sympathy', 'vidéos/shadowhunters SO1E02.mp4'),
(351, 18, 2, 'The Newcomer', 'vidéos/shadowhunters SO1E02.mp4'),
(352, 18, 3, 'The High Road', 'vidéos/shadowhunters SO1E02.mp4'),
(353, 18, 4, 'The Hero', 'vidéos/shadowhunters SO1E02.mp4'),
(354, 18, 5, 'The Homecoming', 'vidéos/shadowhunters SO1E02.mp4'),
(355, 18, 6, 'The Longest Day', 'vidéos/shadowhunters SO1E02.mp4'),
(356, 18, 7, 'The Truth', 'vidéos/shadowhunters SO1E02.mp4'),
(357, 18, 8, 'The Wedding', 'vidéos/shadowhunters SO1E02.mp4'),
(358, 18, 9, 'The Aftermath', 'vidéos/shadowhunters SO1E02.mp4'),
(359, 18, 10, 'The Rebuild', 'vidéos/shadowhunters SO1E02.mp4'),
(372, 19, 1, 'Sweet Tea and Second Chances', 'vidéos/shadowhunters SO1E02.mp4'),
(373, 19, 2, 'The Heart of the Matter', 'vidéos/shadowhunters SO1E02.mp4'),
(374, 19, 3, 'The Best of Friends', 'vidéos/shadowhunters SO1E02.mp4'),
(375, 19, 4, 'A New Leaf', 'vidéos/shadowhunters SO1E02.mp4'),
(376, 19, 5, 'The Truth Will Set You Free', 'vidéos/shadowhunters SO1E02.mp4'),
(377, 19, 6, 'Rebuilding Bridges', 'vidéos/shadowhunters SO1E02.mp4'),
(378, 19, 7, 'The Perfect Storm', 'vidéos/shadowhunters SO1E02.mp4'),
(379, 19, 8, 'The Choice', 'vidéos/shadowhunters SO1E02.mp4'),
(380, 19, 9, 'Facing the Future', 'vidéos/shadowhunters SO1E02.mp4'),
(381, 19, 10, 'The Light in the Dark', 'vidéos/shadowhunters SO1E02.mp4'),
(394, 20, 1, 'A New Chapter', 'vidéos/shadowhunters SO1E02.mp4'),
(395, 20, 2, 'Old Wounds', 'vidéos/shadowhunters SO1E02.mp4'),
(396, 20, 3, 'Choices', 'vidéos/shadowhunters SO1E02.mp4'),
(397, 20, 4, 'Building Bridges', 'vidéos/shadowhunters SO1E02.mp4'),
(398, 20, 5, 'Turning Points', 'vidéos/shadowhunters SO1E02.mp4'),
(399, 20, 6, 'Broken Promises', 'vidéos/shadowhunters SO1E02.mp4'),
(400, 20, 7, 'Growing Pains', 'vidéos/shadowhunters SO1E02.mp4'),
(401, 20, 8, 'A Leap of Faith', 'vidéos/shadowhunters SO1E02.mp4'),
(402, 20, 9, 'Unspoken Words', 'vidéos/shadowhunters SO1E02.mp4'),
(403, 20, 10, 'The Road Ahead', 'vidéos/shadowhunters SO1E02.mp4'),
(404, 20, 11, 'Episode 11', 'vidéos/shadowhunters SO1E02.mp4'),
(405, 20, 12, 'Episode 12', 'vidéos/shadowhunters SO1E02.mp4'),
(406, 20, 13, 'Episode 13', 'vidéos/shadowhunters SO1E02.mp4'),
(407, 20, 14, 'Episode 14', 'vidéos/shadowhunters SO1E02.mp4'),
(408, 20, 15, 'Episode 15', 'vidéos/shadowhunters SO1E02.mp4'),
(409, 20, 16, 'Episode 16', 'vidéos/shadowhunters SO1E02.mp4'),
(410, 20, 17, 'Episode 17', 'vidéos/shadowhunters SO1E02.mp4'),
(411, 20, 18, 'Episode 18', 'vidéos/shadowhunters SO1E02.mp4'),
(412, 20, 19, 'Episode 19', 'vidéos/shadowhunters SO1E02.mp4'),
(413, 20, 20, 'Episode 20', 'vidéos/shadowhunters SO1E02.mp4'),
(414, 20, 21, 'Episode 21', 'vidéos/shadowhunters SO1E02.mp4'),
(415, 20, 22, 'Episode 22', 'vidéos/shadowhunters SO1E02.mp4'),
(416, 14, 1, 'Into the Void', 'vidéos/shadowhunters SO1E02.mp4'),
(417, 14, 2, 'A Flash of the Lightning', 'vidéos/shadowhunters SO1E02.mp4'),
(418, 14, 3, 'The Trial of The Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(419, 14, 4, 'The Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(420, 14, 5, 'The Elongated Man', 'vidéos/shadowhunters SO1E02.mp4'),
(421, 14, 6, 'The Thinker', 'vidéos/shadowhunters SO1E02.mp4'),
(422, 14, 7, 'Memories', 'vidéos/shadowhunters SO1E02.mp4'),
(423, 14, 8, 'The Reverse-Flash Returns', 'vidéos/shadowhunters SO1E02.mp4'),
(424, 14, 9, 'The Flash & The Furious', 'vidéos/shadowhunters SO1E02.mp4'),
(425, 14, 10, 'The Elongated Man', 'vidéos/shadowhunters SO1E02.mp4'),
(426, 14, 11, 'King Shark vs. Gorilla Grodd', 'vidéos/shadowhunters SO1E02.mp4'),
(427, 14, 12, 'The Thinker', 'vidéos/shadowhunters SO1E02.mp4'),
(428, 14, 13, 'The Elongated Man: Crisis', 'vidéos/shadowhunters SO1E02.mp4'),
(429, 14, 14, 'We Are the Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(430, 14, 15, 'The End', 'vidéos/shadowhunters SO1E02.mp4'),
(431, 14, 16, 'The Flash: The Beginning', 'vidéos/shadowhunters SO1E02.mp4'),
(432, 14, 17, 'The Flash: Rebirth', 'vidéos/shadowhunters SO1E02.mp4'),
(433, 14, 18, 'The Flash: A New Dawn', 'vidéos/shadowhunters SO1E02.mp4'),
(434, 14, 19, 'The Flash: The Final Battle', 'vidéos/shadowhunters SO1E02.mp4'),
(435, 14, 20, 'The Flash: Endgame', 'vidéos/shadowhunters SO1E02.mp4'),
(436, 14, 21, 'The Flash: Resurrection', 'vidéos/shadowhunters SO1E02.mp4'),
(437, 14, 22, 'The Flash: Legacy', 'vidéos/shadowhunters SO1E02.mp4'),
(438, 15, 1, 'The Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(439, 15, 2, 'The Elongated Man', 'vidéos/shadowhunters SO1E02.mp4'),
(440, 15, 3, 'The Flash and the Furious', 'vidéos/shadowhunters SO1E02.mp4'),
(441, 15, 4, 'The Reverse-Flash Returns', 'vidéos/shadowhunters SO1E02.mp4'),
(442, 15, 5, 'The Trial of The Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(443, 15, 6, 'The Thinker', 'vidéos/shadowhunters SO1E02.mp4'),
(444, 15, 7, 'The Elongated Man', 'vidéos/shadowhunters SO1E02.mp4'),
(445, 15, 8, 'The Flash & The Furious', 'vidéos/shadowhunters SO1E02.mp4'),
(446, 15, 9, 'The Elongated Man: Crisis', 'vidéos/shadowhunters SO1E02.mp4'),
(447, 15, 10, 'The End', 'vidéos/shadowhunters SO1E02.mp4'),
(448, 15, 11, 'The Flash: The Beginning', 'vidéos/shadowhunters SO1E02.mp4'),
(449, 15, 12, 'The Flash: Rebirth', 'vidéos/shadowhunters SO1E02.mp4'),
(450, 15, 13, 'The Flash: A New Dawn', 'vidéos/shadowhunters SO1E02.mp4'),
(451, 15, 14, 'The Flash: The Final Battle', 'vidéos/shadowhunters SO1E02.mp4'),
(452, 15, 15, 'The Flash: Endgame', 'vidéos/shadowhunters SO1E02.mp4'),
(453, 15, 16, 'The Flash: Resurrection', 'vidéos/shadowhunters SO1E02.mp4'),
(454, 15, 17, 'The Flash: Legacy', 'vidéos/shadowhunters SO1E02.mp4'),
(455, 15, 18, 'The Flash: Crisis', 'vidéos/shadowhunters SO1E02.mp4'),
(456, 15, 19, 'The Flash: Redemption', 'vidéos/shadowhunters SO1E02.mp4'),
(457, 15, 20, 'The Flash: Legacy Part 2', 'vidéos/shadowhunters SO1E02.mp4'),
(458, 15, 21, 'The Flash: The Last Stand', 'vidéos/shadowhunters SO1E02.mp4'),
(459, 15, 22, 'The Flash: A New Hope', 'vidéos/shadowhunters SO1E02.mp4'),
(460, 16, 1, 'The Flash', 'vidéos/shadowhunters SO1E02.mp4'),
(461, 16, 2, 'The New Enemy', 'vidéos/shadowhunters SO1E02.mp4'),
(462, 16, 3, 'The Elongated Man Returns', 'vidéos/shadowhunters SO1E02.mp4'),
(463, 16, 4, 'The Speed Force', 'vidéos/shadowhunters SO1E02.mp4'),
(464, 16, 5, 'The Final Countdown', 'vidéos/shadowhunters SO1E02.mp4'),
(465, 16, 6, 'The Crisis Continues', 'vidéos/shadowhunters SO1E02.mp4'),
(466, 16, 7, 'The Flash and the Dark Speedster', 'vidéos/shadowhunters SO1E02.mp4'),
(467, 16, 8, 'The Flash: Rebirth', 'vidéos/shadowhunters SO1E02.mp4'),
(468, 16, 9, 'The Multiverse Crisis', 'vidéos/shadowhunters SO1E02.mp4'),
(469, 16, 10, 'The Last Stand', 'vidéos/shadowhunters SO1E02.mp4'),
(470, 16, 11, 'The Speed of Light', 'vidéos/shadowhunters SO1E02.mp4'),
(471, 16, 12, 'The Final Battle', 'vidéos/shadowhunters SO1E02.mp4'),
(472, 16, 13, 'The Flash: Legacy', 'vidéos/shadowhunters SO1E02.mp4'),
(473, 16, 14, 'The Speed Force Returns', 'vidéos/shadowhunters SO1E02.mp4'),
(474, 16, 15, 'The Crisis', 'vidéos/shadowhunters SO1E02.mp4'),
(475, 16, 16, 'The Flash: Endgame', 'vidéos/shadowhunters SO1E02.mp4'),
(476, 16, 17, 'The Last Hope', 'vidéos/shadowhunters SO1E02.mp4'),
(477, 16, 18, 'The Flash: A New Dawn', 'vidéos/shadowhunters SO1E02.mp4'),
(478, 16, 19, 'The Speedster Wars', 'vidéos/shadowhunters SO1E02.mp4'),
(479, 16, 20, 'The Final Farewell', 'vidéos/shadowhunters SO1E02.mp4'),
(480, 16, 21, 'The Legacy Continues', 'vidéos/shadowhunters SO1E02.mp4'),
(481, 16, 22, 'The Flash: The End', 'vidéos/shadowhunters SO1E02.mp4'),
(482, 17, 1, 'The Flash Returns', 'vidéos/shadowhunters SO1E02.mp4'),
(483, 17, 2, 'The Speed of Time', 'vidéos/shadowhunters SO1E02.mp4'),
(484, 17, 3, 'The New Speedster', 'vidéos/shadowhunters SO1E02.mp4'),
(485, 17, 4, 'The Time Paradox', 'vidéos/shadowhunters SO1E02.mp4'),
(486, 17, 5, 'The Dark Force', 'vidéos/shadowhunters SO1E02.mp4'),
(487, 17, 6, 'The Flash: Legacy', 'vidéos/shadowhunters SO1E02.mp4'),
(488, 17, 7, 'The Speed of Light', 'vidéos/shadowhunters SO1E02.mp4'),
(489, 17, 8, 'The Crisis Within', 'vidéos/shadowhunters SO1E02.mp4'),
(490, 17, 9, 'The New Enemy', 'vidéos/shadowhunters SO1E02.mp4'),
(491, 17, 10, 'The Speed Force Reborn', 'vidéos/shadowhunters SO1E02.mp4'),
(492, 17, 11, 'The Multiverse Strikes Back', 'vidéos/shadowhunters SO1E02.mp4'),
(493, 17, 12, 'The Final Battle Begins', 'vidéos/shadowhunters SO1E02.mp4'),
(494, 17, 13, 'The Flash: Redemption', 'vidéos/shadowhunters SO1E02.mp4'),
(495, 17, 14, 'The Speed War', 'vidéos/shadowhunters SO1E02.mp4'),
(496, 17, 15, 'The End of Time', 'vidéos/shadowhunters SO1E02.mp4'),
(497, 17, 16, 'The Flash: A New Era', 'vidéos/shadowhunters SO1E02.mp4'),
(498, 17, 17, 'The Last Hope', 'vidéos/shadowhunters SO1E02.mp4'),
(499, 17, 18, 'The Final Countdown', 'vidéos/shadowhunters SO1E02.mp4'),
(500, 17, 19, 'The Speedsters Legacy', 'vidéos/shadowhunters SO1E02.mp4'),
(501, 17, 20, 'The Flash: Endgame', 'vidéos/shadowhunters SO1E02.mp4'),
(502, 17, 21, 'The Last Farewell', 'vidéos/shadowhunters SO1E02.mp4'),
(503, 17, 22, 'The Flash: A New Dawn', 'vidéos/shadowhunters SO1E02.mp4'),
(504, 9, 23, 'Fast Enough', 'vidéos/shadowhunters SO1E02.mp4'),
(505, 10, 23, 'The Race of His Life', 'vidéos/shadowhunters SO1E02.mp4'),
(506, 11, 23, 'Finish Line', 'vidéos/shadowhunters SO1E02.mp4'),
(507, 12, 23, 'The Flash: The End', 'vidéos/shadowhunters SO1E02.mp4'),
(508, 13, 23, 'The Flash: The End', 'vidéos/shadowhunters SO1E02.mp4'),
(509, 21, 1, 'Pilot', 'vidéos/shadowhunters SO1E01.mp4'),
(510, 21, 2, 'The Thing You Love Most', 'vidéos/shadowhunters SO1E01.mp4'),
(511, 21, 3, 'Snow Falls', 'vidéos/shadowhunters SO1E01.mp4'),
(512, 21, 4, 'The Price of Gold', 'vidéos/shadowhunters SO1E01.mp4'),
(513, 21, 5, 'That Still Small Voice', 'vidéos/shadowhunters SO1E01.mp4'),
(514, 21, 6, 'The Shepherd', 'vidéos/shadowhunters SO1E01.mp4'),
(515, 21, 7, 'The Heart is a Lonely Hunter', 'vidéos/shadowhunters SO1E01.mp4'),
(516, 21, 8, 'Desperate Souls', 'vidéos/shadowhunters SO1E01.mp4'),
(517, 21, 9, 'True North', 'vidéos/shadowhunters SO1E01.mp4'),
(518, 21, 10, 'The Thing You Love Most', 'vidéos/shadowhunters SO1E01.mp4'),
(519, 21, 11, 'Fruit of the Poisonous Tree', 'vidéos/shadowhunters SO1E01.mp4'),
(520, 21, 12, 'Skin Deep', 'vidéos/shadowhunters SO1E01.mp4'),
(521, 21, 13, 'What Happened to Frederick', 'vidéos/shadowhunters SO1E01.mp4'),
(522, 21, 14, 'Dreamy', 'vidéos/shadowhunters SO1E01.mp4'),
(523, 21, 15, 'Red-Handed', 'vidéos/shadowhunters SO1E01.mp4'),
(524, 21, 16, 'Heart', 'vidéos/shadowhunters SO1E01.mp4'),
(525, 21, 17, 'Hat Trick', 'vidéos/shadowhunters SO1E01.mp4'),
(526, 21, 18, 'The Stranger', 'vidéos/shadowhunters SO1E01.mp4'),
(527, 21, 19, 'True North', 'vidéos/shadowhunters SO1E01.mp4'),
(528, 21, 20, 'The Return', 'vidéos/shadowhunters SO1E01.mp4'),
(529, 21, 21, 'The Stable Boy', 'vidéos/shadowhunters SO1E01.mp4'),
(530, 21, 22, 'A Land Without Magic', 'vidéos/shadowhunters SO1E01.mp4'),
(531, 22, 1, 'Broken', 'vidéos/shadowhunters SO1E01.mp4'),
(532, 22, 2, 'We Are Both', 'vidéos/shadowhunters SO1E01.mp4'),
(533, 22, 3, 'Lady of the Lake', 'vidéos/shadowhunters SO1E01.mp4'),
(534, 22, 4, 'The Doctor', 'vidéos/shadowhunters SO1E01.mp4'),
(535, 22, 5, 'The Doctor', 'vidéos/shadowhunters SO1E01.mp4'),
(536, 22, 6, 'Tallahassee', 'vidéos/shadowhunters SO1E01.mp4'),
(537, 22, 7, 'Child of the Moon', 'vidéos/shadowhunters SO1E01.mp4'),
(538, 22, 8, 'Into the Deep', 'vidéos/shadowhunters SO1E01.mp4'),
(539, 22, 9, 'Queen of Hearts', 'vidéos/shadowhunters SO1E01.mp4'),
(540, 22, 10, 'The Cricket Game', 'vidéos/shadowhunters SO1E01.mp4'),
(541, 22, 11, 'The Outsider', 'vidéos/shadowhunters SO1E01.mp4'),
(542, 22, 12, 'In the Name of the Brother', 'vidéos/shadowhunters SO1E01.mp4'),
(543, 22, 13, 'Tiny', 'vidéos/shadowhunters SO1E01.mp4'),
(544, 22, 14, 'Manhattan', 'vidéos/shadowhunters SO1E01.mp4'),
(545, 22, 15, 'The Queen is Dead', 'vidéos/shadowhunters SO1E01.mp4'),
(546, 22, 16, 'The Miller’s Daughter', 'vidéos/shadowhunters SO1E01.mp4'),
(547, 22, 17, 'Welcome to Storybrooke', 'vidéos/shadowhunters SO1E01.mp4'),
(548, 22, 18, 'The Evil Queen', 'vidéos/shadowhunters SO1E01.mp4'),
(549, 22, 19, 'Lacey', 'vidéos/shadowhunters SO1E01.mp4'),
(550, 22, 20, 'The Evil Queen', 'vidéos/shadowhunters SO1E01.mp4'),
(551, 22, 21, 'Second Star to the Right', 'vidéos/shadowhunters SO1E01.mp4'),
(552, 22, 22, 'And Straight on Til Morning', 'vidéos/shadowhunters SO1E01.mp4'),
(553, 23, 1, 'The Heart of the Truest Believer', 'vidéos/shadowhunters SO1E01.mp4'),
(554, 23, 2, 'Lost Girl', 'vidéos/shadowhunters SO1E01.mp4'),
(555, 23, 3, 'Quite a Common Fairy', 'vidéos/shadowhunters SO1E01.mp4'),
(556, 23, 4, 'Nasty Habits', 'vidéos/shadowhunters SO1E01.mp4'),
(557, 23, 5, 'Good Form', 'vidéos/shadowhunters SO1E01.mp4'),
(558, 23, 6, 'Ariel', 'vidéos/shadowhunters SO1E01.mp4'),
(559, 23, 7, 'Dark Hollow', 'vidéos/shadowhunters SO1E01.mp4'),
(560, 23, 8, 'Think Lovely Thoughts', 'vidéos/shadowhunters SO1E01.mp4'),
(561, 23, 9, 'Save Henry', 'vidéos/shadowhunters SO1E01.mp4'),
(562, 23, 10, 'The New Neverland', 'vidéos/shadowhunters SO1E01.mp4'),
(563, 23, 11, 'Going Home', 'vidéos/shadowhunters SO1E01.mp4'),
(564, 23, 12, 'New York City Serenade', 'vidéos/shadowhunters SO1E01.mp4'),
(565, 23, 13, 'Witch Hunt', 'vidéos/shadowhunters SO1E01.mp4'),
(566, 23, 14, 'The Tower', 'vidéos/shadowhunters SO1E01.mp4'),
(567, 23, 15, 'Quiet Minds', 'vidéos/shadowhunters SO1E01.mp4'),
(568, 23, 16, 'It’s Not Easy Being Green', 'vidéos/shadowhunters SO1E01.mp4'),
(569, 23, 17, 'The Jolly Roger', 'vidéos/shadowhunters SO1E01.mp4'),
(570, 23, 18, 'A Curious Thing', 'vidéos/shadowhunters SO1E01.mp4'),
(571, 23, 19, 'True Heroes', 'vidéos/shadowhunters SO1E01.mp4'),
(572, 23, 20, 'The Stranger', 'vidéos/shadowhunters SO1E01.mp4'),
(573, 23, 21, 'Kansas', 'vidéos/shadowhunters SO1E01.mp4'),
(574, 23, 22, 'Snow Drifts', 'vidéos/shadowhunters SO1E01.mp4'),
(575, 23, 23, 'The Final Battle', 'vidéos/shadowhunters SO1E01.mp4'),
(576, 24, 1, 'A Tale of Two Sisters', 'vidéos/shadowhunters SO1E01.mp4'),
(577, 24, 2, 'White Out', 'vidéos/shadowhunters SO1E01.mp4'),
(578, 24, 3, 'Rocky Road', 'vidéos/shadowhunters SO1E01.mp4'),
(579, 24, 4, 'The Apprentice', 'vidéos/shadowhunters SO1E01.mp4'),
(580, 24, 5, 'Breaking Glass', 'vidéos/shadowhunters SO1E01.mp4'),
(581, 24, 6, 'Family Business', 'vidéos/shadowhunters SO1E01.mp4'),
(582, 24, 7, 'The Snow Queen', 'vidéos/shadowhunters SO1E01.mp4'),
(583, 24, 8, 'Smash the Mirror', 'vidéos/shadowhunters SO1E01.mp4'),
(584, 24, 9, 'Fall', 'vidéos/shadowhunters SO1E01.mp4'),
(585, 24, 10, 'Shattered Sight', 'vidéos/shadowhunters SO1E01.mp4'),
(586, 24, 11, 'Heroes and Villains', 'vidéos/shadowhunters SO1E01.mp4'),
(587, 24, 12, 'The Snow Queen', 'vidéos/shadowhunters SO1E01.mp4'),
(588, 24, 13, 'The Brothers Jones', 'vidéos/shadowhunters SO1E01.mp4'),
(589, 24, 14, 'Unforgiven', 'vidéos/shadowhunters SO1E01.mp4'),
(590, 24, 15, 'The Frost', 'vidéos/shadowhunters SO1E01.mp4'),
(591, 24, 16, 'The Bear and the Bow', 'vidéos/shadowhunters SO1E01.mp4'),
(592, 24, 17, 'Poor Unfortunate Soul', 'vidéos/shadowhunters SO1E01.mp4'),
(593, 24, 18, 'Sympathy for the DeVil', 'vidéos/shadowhunters SO1E01.mp4'),
(594, 24, 19, 'Lily', 'vidéos/shadowhunters SO1E01.mp4'),
(595, 24, 20, 'The Apprentice', 'vidéos/shadowhunters SO1E01.mp4'),
(596, 24, 21, 'Mother', 'vidéos/shadowhunters SO1E01.mp4'),
(597, 24, 22, 'Operation Mongoose: Part 1', 'vidéos/shadowhunters SO1E01.mp4'),
(598, 24, 23, 'Operation Mongoose: Part 2', 'vidéos/shadowhunters SO1E01.mp4'),
(599, 25, 1, 'The Dark Swan', 'vidéos/shadowhunters SO1E01.mp4'),
(600, 25, 2, 'The Price', 'vidéos/shadowhunters SO1E01.mp4'),
(601, 25, 3, 'Siege Perilous', 'vidéos/shadowhunters SO1E01.mp4'),
(602, 25, 4, 'The Bear and the Bow', 'vidéos/shadowhunters SO1E01.mp4'),
(603, 25, 5, 'Dreamcatcher', 'vidéos/shadowhunters SO1E01.mp4'),
(604, 25, 6, 'The Broken Kingdom', 'vidéos/shadowhunters SO1E01.mp4'),
(605, 25, 7, 'Nimue', 'vidéos/shadowhunters SO1E01.mp4'),
(606, 25, 8, 'Birth', 'vidéos/shadowhunters SO1E01.mp4'),
(607, 25, 9, 'The Bear and the Bow', 'vidéos/shadowhunters SO1E01.mp4'),
(608, 25, 10, 'Broken Heart', 'vidéos/shadowhunters SO1E01.mp4'),
(609, 25, 11, 'Swan Song', 'vidéos/shadowhunters SO1E01.mp4'),
(610, 25, 12, 'The Brothers Jones', 'vidéos/shadowhunters SO1E01.mp4'),
(611, 25, 13, 'The Savior', 'vidéos/shadowhunters SO1E01.mp4'),
(612, 25, 14, 'Devil’s Deal', 'vidéos/shadowhunters SO1E01.mp4'),
(613, 25, 15, 'The Broken Kingdom', 'vidéos/shadowhunters SO1E01.mp4'),
(614, 25, 16, 'A Bitter Draught', 'vidéos/shadowhunters SO1E01.mp4'),
(615, 25, 17, 'Author', 'vidéos/shadowhunters SO1E01.mp4'),
(616, 25, 18, 'The Final Battle: Part 1', 'vidéos/shadowhunters SO1E01.mp4'),
(617, 25, 19, 'The Final Battle: Part 2', 'vidéos/shadowhunters SO1E01.mp4'),
(618, 25, 20, 'The Final Battle: Part 3', 'vidéos/shadowhunters SO1E01.mp4'),
(619, 25, 21, 'The Final Battle: Part 4', 'vidéos/shadowhunters SO1E01.mp4'),
(620, 25, 22, 'The Final Battle: Part 5', 'vidéos/shadowhunters SO1E01.mp4'),
(621, 26, 1, 'The Savior', 'vidéos/shadowhunters SO1E01.mp4'),
(622, 26, 2, 'A Bitter Draught', 'vidéos/shadowhunters SO1E01.mp4'),
(623, 26, 3, 'The Other Shoe', 'vidéos/shadowhunters SO1E01.mp4'),
(624, 26, 4, 'Strange Case', 'vidéos/shadowhunters SO1E01.mp4'),
(625, 26, 5, 'Street Rats', 'vidéos/shadowhunters SO1E01.mp4'),
(626, 26, 6, 'Dark Waters', 'vidéos/shadowhunters SO1E01.mp4'),
(627, 26, 7, 'Heartless', 'vidéos/shadowhunters SO1E01.mp4'),
(628, 26, 8, 'The Other Shoe', 'vidéos/shadowhunters SO1E01.mp4'),
(629, 26, 9, 'A Bitter Draught', 'vidéos/shadowhunters SO1E01.mp4'),
(630, 26, 10, 'Changelings', 'vidéos/shadowhunters SO1E01.mp4'),
(631, 26, 11, 'The Black Fairy', 'vidéos/shadowhunters SO1E01.mp4'),
(632, 26, 12, 'The Final Battle: Part 1', 'vidéos/shadowhunters SO1E01.mp4'),
(633, 26, 13, 'The Final Battle: Part 2', 'vidéos/shadowhunters SO1E01.mp4'),
(634, 26, 14, 'The Final Battle: Part 3', 'vidéos/shadowhunters SO1E01.mp4'),
(635, 26, 15, 'The Final Battle: Part 4', 'vidéos/shadowhunters SO1E01.mp4'),
(636, 26, 16, 'The Final Battle: Part 5', 'vidéos/shadowhunters SO1E01.mp4'),
(637, 26, 17, 'A Happy Ending', 'vidéos/shadowhunters SO1E01.mp4'),
(638, 26, 18, 'The Black Fairy', 'vidéos/shadowhunters SO1E01.mp4'),
(639, 26, 19, 'Changelings', 'vidéos/shadowhunters SO1E01.mp4'),
(640, 26, 20, 'The Other Shoe', 'vidéos/shadowhunters SO1E01.mp4'),
(641, 26, 21, 'Heartless', 'vidéos/shadowhunters SO1E01.mp4'),
(642, 26, 22, 'Street Rats', 'vidéos/shadowhunters SO1E01.mp4'),
(643, 27, 1, 'The Garden of Forking Paths', 'vidéos/shadowhunters SO1E01.mp4'),
(644, 27, 2, 'A Pirate Looks at Fifty', 'vidéos/shadowhunters SO1E01.mp4'),
(645, 27, 3, 'The Garden of Forking Paths', 'vidéos/shadowhunters SO1E01.mp4'),
(646, 27, 4, 'The Witching Hour', 'vidéos/shadowhunters SO1E01.mp4'),
(647, 27, 5, 'The End', 'vidéos/shadowhunters SO1E01.mp4'),
(648, 27, 6, 'The Last Supper', 'vidéos/shadowhunters SO1E01.mp4'),
(649, 27, 7, 'Beauty and the Beast', 'vidéos/shadowhunters SO1E01.mp4'),
(650, 27, 8, 'The Black Fairy', 'vidéos/shadowhunters SO1E01.mp4'),
(651, 27, 9, 'A Pirate Looks at Fifty', 'vidéos/shadowhunters SO1E01.mp4'),
(652, 27, 10, 'The Witching Hour', 'vidéos/shadowhunters SO1E01.mp4'),
(653, 27, 11, 'The Last Supper', 'vidéos/shadowhunters SO1E01.mp4'),
(654, 27, 12, 'The End', 'vidéos/shadowhunters SO1E01.mp4'),
(655, 27, 13, 'Beauty and the Beast', 'vidéos/shadowhunters SO1E01.mp4'),
(656, 27, 14, 'The Black Fairy', 'vidéos/shadowhunters SO1E01.mp4'),
(657, 27, 15, 'The Garden of Forking Paths', 'vidéos/shadowhunters SO1E01.mp4'),
(658, 27, 16, 'The End', 'vidéos/shadowhunters SO1E01.mp4'),
(659, 27, 17, 'The Last Supper', 'vidéos/shadowhunters SO1E01.mp4'),
(660, 27, 18, 'Beauty and the Beast', 'vidéos/shadowhunters SO1E01.mp4'),
(661, 27, 19, 'The Witching Hour', 'vidéos/shadowhunters SO1E01.mp4'),
(662, 27, 20, 'The Black Fairy', 'vidéos/shadowhunters SO1E01.mp4'),
(663, 27, 21, 'The End', 'vidéos/shadowhunters SO1E01.mp4'),
(664, 27, 22, 'The Final Battle', 'vidéos/shadowhunters SO1E01.mp4');

-- --------------------------------------------------------

--
-- Structure de la table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `poll_options`
--

CREATE TABLE `poll_options` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `option_text` varchar(255) DEFAULT NULL,
  `votes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `seasons`
--

CREATE TABLE `seasons` (
  `id` int(11) NOT NULL,
  `series_id` int(11) DEFAULT NULL,
  `season_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `seasons`
--

INSERT INTO `seasons` (`id`, `series_id`, `season_number`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 2, 1),
(10, 2, 2),
(11, 2, 3),
(12, 2, 4),
(13, 2, 5),
(14, 2, 6),
(15, 2, 7),
(16, 2, 8),
(17, 2, 9),
(18, 6, 1),
(19, 6, 2),
(20, 6, 3),
(21, 3, 1),
(22, 3, 2),
(23, 3, 3),
(24, 3, 4),
(25, 3, 5),
(26, 3, 6),
(27, 3, 7);

-- --------------------------------------------------------

--
-- Structure de la table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `series`
--

INSERT INTO `series` (`id`, `title`, `description`, `photo_url`) VALUES
(1, 'Charmed', 'Charmed est une série télévisée américaine qui raconte l\'histoire de trois sœurs qui découvrent qu\'elles sont des sorcières et doivent utiliser leurs pouvoirs pour lutter contre le mal.', 'images/charmed.png'),
(2, 'The Flash', '\"The Flash\" est une série télévisée américaine de science-fiction et de super-héros, adaptée des bandes dessinées DC Comics. Elle suit lhistoire de Barry Allen (interprété par Grant Gustin), un expert en criminalistique qui acquiert des pouvoirs de super-vitesse après un accident de laboratoire. En utilisant ses nouvelles capacités, Barry devient \"The Flash\", le héros qui court plus vite que la lumière.', 'images/20240210_085948.jpg'),
(3, 'Once Upon A Time', '\"Once Upon a Time\" est une série télévisée américaine qui réinvente les contes de fées classiques en les intégrant dans un univers moderne et fascinant. Créée par Edward Kitsis et Adam Horowitz, la série plonge les téléspectateurs dans le monde enchanteur de Storybrooke, une petite ville mystérieuse où les personnages de contes de fées vivent sous des identités humaines sans se souvenir de leur véritable nature.', 'images/once upon atime.jpg'),
(6, 'Sweet Magnolias', 'A l\'Ombre Des Magnolias', 'images/sweet_magnolias.jpg'),
(11, 'Bones', 'Bones est une série télévisée américaine qui mélange les genres policier et comédie dramatique. Créée par Hart Hanson, elle est inspirée des romans de Kathy Reichs, une anthropologue judiciaire. La série suit le Dr Temperance Brennan, une anthropologue judiciaire brillante mais socialement maladroite, interprétée par Emily Deschanel, et son partenaire, lagent spécial du FBI Seeley Booth, joué par David Boreanaz. Ensemble, ils résolvent des enquêtes criminelles complexes en analysant des restes humains. Bones est appréciée pour ses intrigues captivantes, son humour subtil, et la chimie entre les personnages principaux. La série a duré douze saisons, de 2005 à 2017.', 'images/bones.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `series_actors`
--

CREATE TABLE `series_actors` (
  `id` int(11) NOT NULL,
  `series_id` int(11) DEFAULT NULL,
  `actor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `series_articles`
--

CREATE TABLE `series_articles` (
  `id` int(11) NOT NULL,
  `series_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `series_streaming`
--

CREATE TABLE `series_streaming` (
  `id` int(11) NOT NULL,
  `series_id` int(11) DEFAULT NULL,
  `streaming_url` varchar(255) DEFAULT NULL,
  `nom_série` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `series_streaming`
--

INSERT INTO `series_streaming` (`id`, `series_id`, `streaming_url`, `nom_série`) VALUES
(1, 1, 'streaming.php?series_id=1&user_id=<?php echo htmlspecialchars($user_id); ?>', 'Charmed'),
(2, 2, 'streaming.php?series_id=2&user_id=<?php echo htmlspecialchars($user_id); ?>', 'The Flash');

-- --------------------------------------------------------

--
-- Structure de la table `streams`
--

CREATE TABLE `streams` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `streams`
--

INSERT INTO `streams` (`id`, `title`, `description`) VALUES
(1, 'Série 1', 'Description de la série 1. Découvrez les épisodes et les détails de cette série passionnante.'),
(2, 'Série 2', 'Plongez dans l\'univers de la série 2 avec cette description complète de ses épisodes et personnages.'),
(3, 'Série 3', 'Une série captivante à ne pas manquer, avec une description détaillée de l\'intrigue et des personnages.'),
(4, 'Série 4', 'Regardez la série 4 en streaming et découvrez sa description fascinante.');

-- --------------------------------------------------------

--
-- Structure de la table `survey`
--

CREATE TABLE `survey` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `surveys`
--

CREATE TABLE `surveys` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `surveys`
--

INSERT INTO `surveys` (`id`, `question`) VALUES
(1, 'Quel est votre genre de série préféré?'),
(2, 'Cest le temps des élections. Qui serait le meilleur président?'),
(3, 'Les examens approchent à grands pas... Qui appeler pour vous aider à réviser ?'),
(4, 'Quelle est votre série TV préférée 1?'),
(5, 'Quel est votre personnage principal préféré dans les séries télévisées ?'),
(6, 'Quelle série télévisée vous a le plus surpris par ses rebondissements ?'),
(7, 'Quel duo de personnages de série trouvez-vous le plus iconique ?'),
(8, 'Quelle série télévisée vous a fait le plus rire ?'),
(9, 'Quelle série télévisée vous a le plus ému ?'),
(10, 'Quel est le meilleur méchant dans une série télévisée ?'),
(11, 'Quelle série télévisée vous a le plus déçu à la fin ?'),
(12, 'Quelle série télévisée avez-vous binge-watchée le plus rapidement ?'),
(13, 'Quel personnage de série aimeriez-vous avoir comme ami ?'),
(14, 'Quelle série vous a le plus captivé dès le premier épisode ?'),
(15, 'Quel personnage secondaire de série mérite plus de reconnaissance ?');

-- --------------------------------------------------------

--
-- Structure de la table `survey_answers`
--

CREATE TABLE `survey_answers` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `votes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `survey_answers`
--

INSERT INTO `survey_answers` (`id`, `survey_id`, `answer`, `votes`) VALUES
(1, 1, 'Action', 0),
(2, 1, 'Mellie Grant (Scandal) ', 0),
(3, 1, 'Drame', 0),
(4, 1, 'Fantastique', 1),
(5, 2, 'David Palmer (24h Chrono)', 1),
(6, 2, 'Fitzerald Thomas Grant III (Scandal)', 0),
(7, 2, 'Lyndon B. Johnson (All the Way)', 1),
(8, 1, 'Mysytères', 1),
(9, 2, 'Thomas Adam Kirkman (Designated Survivor)', 1),
(10, 2, 'Paul Kincaid (Hostages)', 2),
(11, 2, 'Jed Bartlet (A la Maison Blanche)', 0),
(12, 2, 'Elias Martinez (The Event)', 2),
(13, 2, 'Hunter Franklin (The Oval)', 1),
(17, 3, 'Sheldon L. Cooper (The Big Bang Theory)', 1),
(18, 3, 'Spencer Reid (Criminal Minds)', 0),
(19, 3, 'Sherlock Holmes (Sherlock)', 0),
(20, 3, 'Lisa Simpson (Les Simpson)', 0),
(21, 3, 'Walter White (Breaking Bad)', 0),
(22, 3, 'Temperance Brennan (Bones)', 3),
(23, 3, 'Michael Scofield (Prison Break)', 0),
(24, 3, 'Le Professeur (La Casa De Papel)', 0),
(25, 3, 'Dr. House (House M.D.)', 0),
(26, 3, 'Hannibal Lecter (Hannibal)', 0),
(27, 3, 'Dexter Morgan (Dexter)', 0),
(28, 3, 'Walter Obrien (Scorpion)', 1),
(29, 2, 'Caroline Reynolds (Prison Break) ', 0),
(30, 2, 'Mellie Grant (Scandal) ', 1),
(31, 2, 'Olivia Marsdin (Supergirl) ', 0),
(32, 2, 'Claire Haas (Quantico) ', 1),
(33, 4, 'Game of Thrones', 0),
(34, 4, 'Stranger Things', 0),
(35, 4, 'Breaking Bad ', 0),
(36, 4, 'Charmed', 2),
(37, 4, 'Once Upon A Time', 1),
(38, 4, 'Scandal', 0),
(39, 4, 'Ma Grande Famille', 0),
(40, 4, 'Bridgerton', 0),
(41, 4, 'Suits: Avocats Sur Mesure', 1),
(42, 4, 'Bones', 0),
(43, 4, 'Lucifer', 0),
(44, 4, 'Madame...Monsieur', 0),
(45, 5, 'Onze (Stranger Things)', 0),
(46, 5, 'Sheldon L. Cooper (The Big Bang Theory)', 0),
(47, 5, 'Sherlock Holmes (Sherlock)', 0),
(48, 5, 'Jon Snow (Game of Thrones)', 1),
(49, 5, 'Temperance Brennan (Bones)', 1),
(50, 5, 'Michael Scofield (Prison Break)', 0),
(51, 5, 'Tokyo (La Casa De Papel)', 0),
(52, 5, 'Queen Elizabeth II (The Crown)', 1),
(53, 5, 'Hannibal Lecter (Hannibal)', 0),
(54, 5, 'Meredith Grey (Greys Anatomy)', 0),
(55, 5, 'Dexter Morgan (Dexter)', 0),
(56, 5, 'Walter Obrien (Scorpion)', 0),
(57, 6, 'Lost', 0),
(58, 6, 'Breaking Bad', 0),
(59, 6, 'Westworld', 0),
(60, 6, 'Game of Thrones', 0),
(61, 6, 'Black Mirror', 0),
(62, 6, 'The Walking Dead', 0),
(63, 6, 'Prison Break', 0),
(64, 6, 'Bates Motel', 0),
(65, 6, 'Sweet Magnolias', 1),
(66, 6, 'Homeland', 0),
(67, 6, '24 Heures chrono', 0),
(68, 6, 'La Casa de Papel', 0),
(69, 7, 'Walter White & Jesse Pinkman (Breaking Bad)', 0),
(70, 7, 'Sherlock Holmes & Dr. Watson (Sherlock)', 0),
(71, 7, 'Joey Tribbiani & Chandler Bing (Friends)', 0),
(72, 7, 'Michael Scott & Dwight Schrute (The Office)', 0),
(73, 7, 'Temperance Brennan & Siley Booth (Bones)', 1),
(74, 7, 'Monica Geller & Rachel Green (Friends)', 0),
(75, 7, 'Rick Grimes & Daryl Dixon (The Walking Dead)', 0),
(76, 7, 'Lorelai & Rory Gilmore (Gilmore Girls)', 0),
(77, 7, 'Mulder & Scully (The X-Files)', 0),
(78, 7, 'Buffy & Willow (Buffy contre les vampires)', 0),
(79, 7, 'Scully & Hitchcock (Brooklyn Nine-Nine)', 0),
(80, 7, 'Jace & Alec (Shadowhunters)', 2),
(81, 8, 'Friends', 1),
(82, 8, 'The Office', 0),
(83, 8, 'How I Met Your Mother', 0),
(84, 8, 'The Big Bang Theory', 0),
(85, 8, 'Brooklyn Nine-Nine', 0),
(86, 8, 'Parks and Recreation', 0),
(87, 8, 'Modern Family', 1),
(88, 8, 'Scrubs', 0),
(89, 8, 'Community', 0),
(90, 8, 'Arrested Development', 0),
(91, 8, 'New Girl', 0),
(92, 8, '30 Rock', 0),
(93, 9, 'This Is Us', 0),
(94, 9, 'Grey\'s Anatomy', 0),
(95, 9, 'Breaking Bad', 0),
(96, 9, 'The Leftovers', 0),
(97, 9, 'Six Feet Under', 0),
(98, 9, 'The Handmaid\'s Tale', 0),
(99, 9, 'Parenthood', 0),
(100, 9, 'Buffy contre les vampires', 0),
(101, 9, 'Downton Abbey', 0),
(102, 9, 'The OC (Newport Beach)', 1),
(103, 9, 'A Million Little Things', 0),
(104, 9, 'Les Frères Scott (One Tree Hill)', 0);

-- --------------------------------------------------------

--
-- Structure de la table `survey_options`
--

CREATE TABLE `survey_options` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `option_text` varchar(255) DEFAULT NULL,
  `votes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `survey_series`
--

CREATE TABLE `survey_series` (
  `id` int(11) NOT NULL,
  `series_id` int(11) DEFAULT NULL,
  `survey_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `survey_votes`
--

CREATE TABLE `survey_votes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `vote_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `survey_votes`
--

INSERT INTO `survey_votes` (`id`, `user_id`, `survey_id`, `option_id`, `vote_id`) VALUES
(4, 4, 2, NULL, NULL),
(10, 4, 3, NULL, 21),
(11, NULL, NULL, NULL, 19),
(12, NULL, NULL, NULL, 20),
(13, 12, 2, NULL, 10),
(14, 12, 3, NULL, 22),
(15, 7, 2, NULL, 5),
(16, 2, 2, NULL, 30),
(17, 2, 4, NULL, 36),
(18, 17, 3, NULL, 28),
(19, 17, 4, NULL, 41),
(20, 17, 2, NULL, 32),
(21, 17, 7, NULL, 73),
(22, 17, 5, NULL, 49),
(23, 20, 2, NULL, 10),
(24, 20, 5, NULL, 48),
(25, 20, 3, NULL, 22),
(26, 20, 4, NULL, 36),
(27, 21, 4, NULL, 37),
(28, 21, 8, NULL, 87),
(29, 21, 12, NULL, NULL),
(30, 21, 3, NULL, 17),
(31, 21, 7, NULL, 80),
(32, 2, 3, NULL, 22),
(33, 2, 5, NULL, 52),
(34, 2, 6, NULL, 65),
(35, 2, 7, NULL, 80),
(36, 2, 8, NULL, 81),
(37, 2, 9, NULL, 102);

-- --------------------------------------------------------

--
-- Structure de la table `série`
--

CREATE TABLE `série` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `streaming_page_url` varchar(255) DEFAULT NULL,
  `article_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `séries`
--

CREATE TABLE `séries` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `streaming_page_url` varchar(255) DEFAULT NULL,
  `article_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `preferred_genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `nickname`, `password`, `gender`, `preferred_genre`) VALUES
(1, 'Embong', 'Gaetan', 'Gaetano', 'E18N5S20I14e', 'MALE', ''),
(2, 'Halliwell', 'Wyatt', 'Wyatty', '$2y$10$aEQDP.yL6MCsyoKadLd4YuAfw549.6qivRojTRRX2kKvAsw6ZD6p6', 'male', ''),
(3, 'Halliwell', 'Wyatt', 'patty', '$2y$10$aVC141Kvx8BG5sSr851fhulq2KUL9/m9u1aFbmruHklTAVZ73ohfi', 'male', ''),
(4, 'Halliwell', 'Phoebe', 'Phoebe', '$2y$10$Fvy0QGSOBi4elq3C1h1laeS8HTenq0ZBt/DR3BYazy9Nk/evvyBPC', 'female', ''),
(5, 'Halliwell', 'Piper', 'PiperH', '$2y$10$DOy347EsjA76SK88p1GH1.aagCzcYpK9WO5xKzvY96U9LOVQl1oHG', 'female', ''),
(6, 'Halliwell', 'Paige', 'Paige', '$2y$10$R4m6Q.I43sDg3i/DmNfWAOUTqzN8WpE7s46s2VWMR1Nsfi3li9xMu', 'female', ''),
(7, 'Brennan', 'Temperance', 'Bones', '$2y$10$BcLtUDFhD3qU64LFybF7c.cXyPL6xDS1m1V0URtD/tIVRHWJY9JQG', 'female', ''),
(12, 'Cooper', 'Sheldon', 'Lee', '$2y$10$gOT/fsEVQ4bWL9nu96.7Jez.0GVrUaDFDdE69hS5ET13KVpz1AuBS', 'male', ''),
(14, '', '', 'ryan', '', '', ''),
(15, 'Mills', 'Abigail', 'Temoin1', '$2y$10$pRtWyUC3INHZigmTALxLpeE5xK1W1XrLBDbsU1TTXz4StIRx5zd/u', 'female', ''),
(17, 'Mills', 'Henry', 'author', '$2y$10$IQiTxkSK2rZk2Au8HNgWL.kSR1V6xr11wUJ4MEL3ssGP6nbGXFRz6', 'male', ''),
(18, 'Mills', 'Henry', 'auteur', '$2y$10$Ng19uilhhohgy/WlXZnb2.7uiQMsRApvV8TAg2gM5zJFdpVNoma8G', 'male', ''),
(20, 'Crane', 'Icabot', 'témoin2', '$2y$10$1G7iRQZwnZBJiVhmupvAtulLQgzdPaEyTZR6lpajNYhb63szHgc.m', 'male', ''),
(21, 'Suarez', 'Gabriella', 'La Patrona', '$2y$10$Wv5tQGlFrXk06eE1E6H1RuZxmOX.0eQTFvYU7cAYGgiD9pQ9rjzcy', 'female', '');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id` smallint(10) UNSIGNED NOT NULL,
  `titre` tinytext NOT NULL,
  `reponse` smallint(1) NOT NULL DEFAULT 0,
  `ip` varchar(15) NOT NULL DEFAULT '',
  `unix` varchar(25) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `user_ip` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vote_users`
--

CREATE TABLE `vote_users` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answers_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `season_id` (`season_id`);

--
-- Index pour la table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `poll_options`
--
ALTER TABLE `poll_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poll_id` (`poll_id`);

--
-- Index pour la table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `series_id` (`series_id`);

--
-- Index pour la table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `series_actors`
--
ALTER TABLE `series_actors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `series_id` (`series_id`),
  ADD KEY `actor_id` (`actor_id`);

--
-- Index pour la table `series_articles`
--
ALTER TABLE `series_articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `series_id` (`series_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Index pour la table `series_streaming`
--
ALTER TABLE `series_streaming`
  ADD PRIMARY KEY (`id`),
  ADD KEY `series_id` (`series_id`);

--
-- Index pour la table `streams`
--
ALTER TABLE `streams`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `survey_answers`
--
ALTER TABLE `survey_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Index pour la table `survey_options`
--
ALTER TABLE `survey_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Index pour la table `survey_series`
--
ALTER TABLE `survey_series`
  ADD PRIMARY KEY (`id`),
  ADD KEY `series_id` (`series_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Index pour la table `survey_votes`
--
ALTER TABLE `survey_votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `survey_id` (`survey_id`),
  ADD KEY `option_id` (`option_id`);

--
-- Index pour la table `série`
--
ALTER TABLE `série`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `séries`
--
ALTER TABLE `séries`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nickname` (`nickname`),
  ADD KEY `first_name` (`first_name`,`last_name`,`nickname`,`password`,`gender`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poll_id` (`poll_id`),
  ADD KEY `option_id` (`option_id`);

--
-- Index pour la table `vote_users`
--
ALTER TABLE `vote_users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=665;

--
-- AUTO_INCREMENT pour la table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `poll_options`
--
ALTER TABLE `poll_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `series_actors`
--
ALTER TABLE `series_actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `series_articles`
--
ALTER TABLE `series_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `series_streaming`
--
ALTER TABLE `series_streaming`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `streams`
--
ALTER TABLE `streams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `survey`
--
ALTER TABLE `survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `survey_answers`
--
ALTER TABLE `survey_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT pour la table `survey_options`
--
ALTER TABLE `survey_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `survey_series`
--
ALTER TABLE `survey_series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `survey_votes`
--
ALTER TABLE `survey_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `série`
--
ALTER TABLE `série`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `séries`
--
ALTER TABLE `séries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `episodes_ibfk_1` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `poll_options`
--
ALTER TABLE `poll_options`
  ADD CONSTRAINT `poll_options_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`);

--
-- Contraintes pour la table `seasons`
--
ALTER TABLE `seasons`
  ADD CONSTRAINT `seasons_ibfk_1` FOREIGN KEY (`series_id`) REFERENCES `series` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `series_actors`
--
ALTER TABLE `series_actors`
  ADD CONSTRAINT `series_actors_ibfk_1` FOREIGN KEY (`series_id`) REFERENCES `series` (`id`),
  ADD CONSTRAINT `series_actors_ibfk_2` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`id`);

--
-- Contraintes pour la table `series_articles`
--
ALTER TABLE `series_articles`
  ADD CONSTRAINT `series_articles_ibfk_1` FOREIGN KEY (`series_id`) REFERENCES `series` (`id`),
  ADD CONSTRAINT `series_articles_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`);

--
-- Contraintes pour la table `series_streaming`
--
ALTER TABLE `series_streaming`
  ADD CONSTRAINT `series_streaming_ibfk_1` FOREIGN KEY (`series_id`) REFERENCES `series` (`id`);

--
-- Contraintes pour la table `survey_answers`
--
ALTER TABLE `survey_answers`
  ADD CONSTRAINT `survey_answers_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`);

--
-- Contraintes pour la table `survey_options`
--
ALTER TABLE `survey_options`
  ADD CONSTRAINT `survey_options_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`);

--
-- Contraintes pour la table `survey_series`
--
ALTER TABLE `survey_series`
  ADD CONSTRAINT `survey_series_ibfk_1` FOREIGN KEY (`series_id`) REFERENCES `series` (`id`),
  ADD CONSTRAINT `survey_series_ibfk_2` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`);

--
-- Contraintes pour la table `survey_votes`
--
ALTER TABLE `survey_votes`
  ADD CONSTRAINT `survey_votes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `survey_votes_ibfk_2` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`),
  ADD CONSTRAINT `survey_votes_ibfk_3` FOREIGN KEY (`option_id`) REFERENCES `survey_options` (`id`);

--
-- Contraintes pour la table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`option_id`) REFERENCES `poll_options` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
