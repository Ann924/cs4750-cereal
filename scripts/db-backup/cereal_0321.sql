-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 21, 2023 at 02:39 PM
-- Server version: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `al7gc_c`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `user_name` varchar(20) NOT NULL,
  `cereal_id` int(11) NOT NULL,
  `personalized_serving_size` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`user_name`, `cereal_id`, `personalized_serving_size`) VALUES
('ann', 15, 1),
('ann', 25, 3),
('lilian', 22, 1),
('oliver', 21, 9),
('user1', 17, 2),
('user13', 8, 2),
('user15', 22, 4),
('user16', 2, 3),
('user17', 2, 3),
('user2', 15, 2),
('user3', 7, 8),
('user4', 12, 11),
('user6', 26, 2),
('user7', 21, 3),
('user8', 26, 2),
('user9', 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `cereal_info`
--

CREATE TABLE `cereal_info` (
  `cereal_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cereal_info`
--

INSERT INTO `cereal_info` (`cereal_id`, `name`, `type`) VALUES
(1, '100% Bran', 'C'),
(2, '100% Natural Bran', 'C'),
(3, 'All-Bran', 'C'),
(4, 'All-Bran with Extra Fiber', 'C'),
(5, 'Almond Delight', 'C'),
(6, 'Apple Cinnamon Cheerios', 'C'),
(7, 'Apple Jacks', 'C'),
(8, 'Basic 4', 'C'),
(9, 'Bran Chex', 'C'),
(10, 'Bran Flakes', 'C'),
(11, 'Cap\'n\'Crunch', 'C'),
(12, 'Cheerios', 'C'),
(13, 'Cinnamon Toast Crunch', 'C'),
(14, 'Clusters', 'C'),
(15, 'Cocoa Puffs', 'C'),
(16, 'Corn Chex', 'C'),
(17, 'Corn Flakes', 'C'),
(18, 'Corn Pops', 'C'),
(19, 'Count Chocula', 'C'),
(20, 'Cracklin\' Oat Bran', 'C'),
(21, 'Cream of Wheat (Quick)', 'H'),
(22, 'Crispix', 'C'),
(23, 'Crispy Wheat & Raisins', 'C'),
(24, 'Double Chex', 'C'),
(25, 'Froot Loops', 'C'),
(26, 'Frosted Flakes', 'C'),
(27, 'Frosted Mini-Wheats', 'C'),
(28, 'Fruit & Fibre Dates; Walnuts; and Oats', 'C'),
(29, 'Fruitful Bran', 'C'),
(30, 'Fruity Pebbles', 'C'),
(31, 'Golden Crisp', 'C'),
(32, 'Golden Grahams', 'C'),
(33, 'Grape Nuts Flakes', 'C'),
(34, 'Grape-Nuts', 'C'),
(35, 'Great Grains Pecan', 'C'),
(36, 'Honey Graham Ohs', 'C'),
(37, 'Honey Nut Cheerios', 'C'),
(38, 'Honey-comb', 'C'),
(39, 'Just Right Crunchy  Nuggets', 'C'),
(40, 'Just Right Fruit & Nut', 'C'),
(41, 'Kix', 'C'),
(42, 'Life', 'C'),
(43, 'Lucky Charms', 'C'),
(44, 'Maypo', 'H'),
(45, 'Muesli Raisins; Dates; & Almonds', 'C'),
(46, 'Muesli Raisins; Peaches; & Pecans', 'C'),
(47, 'Mueslix Crispy Blend', 'C'),
(48, 'Multi-Grain Cheerios', 'C'),
(49, 'Nut&Honey Crunch', 'C'),
(50, 'Nutri-Grain Almond-Raisin', 'C'),
(51, 'Nutri-grain Wheat', 'C'),
(52, 'Oatmeal Raisin Crisp', 'C'),
(53, 'Post Nat. Raisin Bran', 'C'),
(54, 'Product 19', 'C'),
(55, 'Puffed Rice', 'C'),
(56, 'Puffed Wheat', 'C'),
(57, 'Quaker Oat Squares', 'C'),
(58, 'Quaker Oatmeal', 'H'),
(59, 'Raisin Bran', 'C'),
(60, 'Raisin Nut Bran', 'C'),
(61, 'Raisin Squares', 'C'),
(62, 'Rice Chex', 'C'),
(63, 'Rice Krispies', 'C'),
(64, 'Shredded Wheat', 'C'),
(65, 'Shredded Wheat \'n\'Bran', 'C'),
(66, 'Shredded Wheat spoon size', 'C'),
(67, 'Smacks', 'C'),
(68, 'Special K', 'C'),
(69, 'Strawberry Fruit Wheats', 'C'),
(70, 'Total Corn Flakes', 'C'),
(71, 'Total Raisin Bran', 'C'),
(72, 'Total Whole Grain', 'C'),
(73, 'Triples', 'C'),
(74, 'Trix', 'C'),
(75, 'Wheat Chex', 'C'),
(76, 'Wheaties', 'C'),
(77, 'Wheaties Honey Gold', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `cereal_manufacturer`
--

CREATE TABLE `cereal_manufacturer` (
  `name` varchar(100) NOT NULL,
  `manufacturer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cereal_manufacturer`
--

INSERT INTO `cereal_manufacturer` (`name`, `manufacturer`) VALUES
('100% Bran', 'Nabisco'),
('100% Natural Bran', 'Quaker Oats'),
('All-Bran', 'Kelloggs'),
('All-Bran with Extra Fiber', 'Kelloggs'),
('Almond Delight', 'Ralston Purina'),
('Apple Cinnamon Cheerios', 'General Mills'),
('Apple Jacks', 'Kelloggs'),
('Basic 4', 'General Mills'),
('Bran Chex', 'Ralston Purina'),
('Bran Flakes', 'Post'),
('Cap\'n\'Crunch', 'Quaker Oats'),
('Cheerios', 'General Mills'),
('Cinnamon Toast Crunch', 'General Mills'),
('Clusters', 'General Mills'),
('Cocoa Puffs', 'General Mills'),
('Corn Chex', 'Ralston Purina'),
('Corn Flakes', 'Kelloggs'),
('Corn Pops', 'Kelloggs'),
('Count Chocula', 'General Mills'),
('Cracklin\' Oat Bran', 'Kelloggs'),
('Cream of Wheat (Quick)', 'Nabisco'),
('Crispix', 'Kelloggs'),
('Crispy Wheat & Raisins', 'General Mills'),
('Double Chex', 'Ralston Purina'),
('Froot Loops', 'Kelloggs'),
('Frosted Flakes', 'Kelloggs'),
('Frosted Mini-Wheats', 'Kelloggs'),
('Fruit & Fibre Dates; Walnuts; and Oats', 'Post'),
('Fruitful Bran', 'Kelloggs'),
('Fruity Pebbles', 'Post'),
('Golden Crisp', 'Post'),
('Golden Grahams', 'General Mills'),
('Grape Nuts Flakes', 'Post'),
('Grape-Nuts', 'Post'),
('Great Grains Pecan', 'Post'),
('Honey Graham Ohs', 'Quaker Oats'),
('Honey Nut Cheerios', 'General Mills'),
('Honey-comb', 'Post'),
('Just Right Crunchy  Nuggets', 'Kelloggs'),
('Just Right Fruit & Nut', 'Kelloggs'),
('Kix', 'General Mills'),
('Life', 'Quaker Oats'),
('Lucky Charms', 'General Mills'),
('Maypo', 'American Home Food Products'),
('Muesli Raisins; Dates; & Almonds', 'Ralston Purina'),
('Muesli Raisins; Peaches; & Pecans', 'Ralston Purina'),
('Mueslix Crispy Blend', 'Kelloggs'),
('Multi-Grain Cheerios', 'General Mills'),
('Nut&Honey Crunch', 'Kelloggs'),
('Nutri-Grain Almond-Raisin', 'Kelloggs'),
('Nutri-grain Wheat', 'Kelloggs'),
('Oatmeal Raisin Crisp', 'General Mills'),
('Post Nat. Raisin Bran', 'Post'),
('Product 19', 'Kelloggs'),
('Puffed Rice', 'Quaker Oats'),
('Puffed Wheat', 'Quaker Oats'),
('Quaker Oat Squares', 'Quaker Oats'),
('Quaker Oatmeal', 'Quaker Oats'),
('Raisin Bran', 'Kelloggs'),
('Raisin Nut Bran', 'General Mills'),
('Raisin Squares', 'Kelloggs'),
('Rice Chex', 'Ralston Purina'),
('Rice Krispies', 'Kelloggs'),
('Shredded Wheat', 'Nabisco'),
('Shredded Wheat \'n\'Bran', 'Nabisco'),
('Shredded Wheat spoon size', 'Nabisco'),
('Smacks', 'Kelloggs'),
('Special K', 'Kelloggs'),
('Strawberry Fruit Wheats', 'Nabisco'),
('Total Corn Flakes', 'General Mills'),
('Total Raisin Bran', 'General Mills'),
('Total Whole Grain', 'General Mills'),
('Triples', 'General Mills'),
('Trix', 'General Mills'),
('Wheat Chex', 'Ralston Purina'),
('Wheaties', 'General Mills'),
('Wheaties Honey Gold', 'General Mills');

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `club_id` int(11) NOT NULL,
  `club_title` varchar(50) NOT NULL,
  `club_description` text DEFAULT '',
  `club_score` int(11) DEFAULT 0,
  `num_members` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`club_id`, `club_title`, `club_description`, `club_score`, `num_members`) VALUES
(1, 'MILK FIRST', 'The grand union of all cereal non-heathens that appreciate the true beauty of pouring milk first!', 2, 2),
(2, 'CEREAL FIRST', 'The true order of the world dictates cereal first.', 1, 1),
(3, 'No milk!', 'Cereal is a strong independent grain that don\'t need no milk.', 1, 1),
(4, 'Cereal Promotions', 'Greetings! Please join to stay updated on the latest cereal news!', 5, 5),
(5, 'Chocolate milk', 'Hey, welcome to the chocolate milk club! We support using chocolate milk in place of regular milk for added flavor and nutrition!', 3, 2),
(6, 'Orange juice', 'We are the orange juice club, and we seek one thing: world domination. Our goal is to convert everyone to using orange juice instead of milk in their cereal...or else....', 4, 2),
(7, 'Cereal unity', 'We think all cereal-enjoyers should respect each other\'s preferences and connect with each other through our shared love for cereal!', 5, 3),
(8, 'Cereal anarchy', 'We think peace between cereal clubs is overrated and we should all battle to the death over what cereal preparation is best', 6, 1),
(9, 'Dry cereal', 'While eating cereal, no liquid shall be consumed', 3, 3),
(10, 'testclub10', 'the 10th cereal club', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `user_name` varchar(20) NOT NULL,
  `cereal_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `text` text DEFAULT '',
  `date` date NOT NULL
) ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`user_name`, `cereal_id`, `comment_id`, `text`, `date`) VALUES
('ann', 15, 1, 'Where has this been all my life', '2023-03-20'),
('ann', 33, 1, 'People are sleeping on milk first with this one', '2023-03-20'),
('lilian', 22, 1, 'I got an A on a test after eating this cereal', '2023-03-20'),
('oliver', 15, 4, 'This cereal cured my acne!', '2023-03-20'),
('oliver', 21, 1, 'Love this cereal', '2023-03-20'),
('user1', 15, 2, 'You should try it with jam!', '2023-03-20'),
('user1', 15, 3, 'how do you write a comment', '2023-03-20'),
('user10', 24, 2, 'Could be improved', '2023-03-20'),
('user11', 1, 2, 'This cereal makes me sad :(', '2023-03-20'),
('user11', 24, 3, 'This cereal rocks!', '2023-03-20'),
('user12', 7, 1, 'this cereal is life changing', '2023-03-26'),
('user13', 8, 1, 'I became a CS god after eating this cereal', '2023-03-22'),
('user14', 15, 5, '*throws up*', '2023-03-23'),
('user15', 21, 2, 'I got an F on a test after eating this cereal', '2023-03-25'),
('user16', 2, 2, 'yum yum in my tum', '2023-03-24'),
('user17', 2, 1, 'I got food poisoning from this', '2023-03-21'),
('user2', 17, 1, 'This cereal gets soggy really fast', '2023-03-20'),
('user2', 73, 1, ':)', '2023-03-20'),
('user3', 1, 1, 'Everything about this is a mistake', '2023-03-20'),
('user3', 23, 1, 'I simply have no words! It\'s truly...atrocious', '2023-03-20'),
('user4', 24, 1, 'Only cereal heathens dislike this one', '2023-03-20'),
('user5', 28, 1, 'Some things are just not meant to be', '2023-03-20'),
('user6', 21, 2, 'This cereal is such a slay', '2023-03-20'),
('user6', 23, 2, 'How dare you even call this cereal', '2023-03-20'),
('user7', 19, 1, 'Could be better', '2023-03-20'),
('user8', 17, 2, 'I give it a 6/10', '2023-03-20'),
('user8', 35, 1, 'I\'d marry this cereal if I could', '2023-03-20'),
('user9', 26, 1, 'This cereal slaps', '2023-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `creates_cereal`
--

CREATE TABLE `creates_cereal` (
  `user_name` varchar(20) NOT NULL,
  `cereal_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `creates_cereal`
--

INSERT INTO `creates_cereal` (`user_name`, `cereal_id`, `date`) VALUES
('admin', 1, '2023-03-18'),
('admin', 2, '2023-03-18'),
('admin', 3, '2023-03-18'),
('admin', 4, '2023-03-18'),
('admin', 5, '2023-03-18'),
('admin', 6, '2023-03-18'),
('admin', 7, '2023-03-18'),
('admin', 8, '2023-03-18'),
('admin', 9, '2023-03-18'),
('admin', 10, '2023-03-18'),
('admin', 11, '2023-03-18'),
('admin', 12, '2023-03-18'),
('admin', 13, '2023-03-18'),
('admin', 14, '2023-03-18'),
('admin', 15, '2023-03-18'),
('admin', 16, '2023-03-18'),
('admin', 17, '2023-03-18'),
('admin', 18, '2023-03-18'),
('admin', 19, '2023-03-18'),
('admin', 20, '2023-03-18'),
('admin', 21, '2023-03-18'),
('admin', 22, '2023-03-18'),
('admin', 23, '2023-03-18'),
('admin', 24, '2023-03-18'),
('admin', 25, '2023-03-18'),
('admin', 26, '2023-03-18'),
('admin', 27, '2023-03-18'),
('admin', 28, '2023-03-18'),
('admin', 29, '2023-03-18'),
('admin', 30, '2023-03-18'),
('admin', 31, '2023-03-18'),
('admin', 32, '2023-03-18'),
('admin', 33, '2023-03-18'),
('admin', 34, '2023-03-18'),
('admin', 35, '2023-03-18'),
('admin', 36, '2023-03-18'),
('admin', 37, '2023-03-18'),
('admin', 38, '2023-03-18'),
('admin', 39, '2023-03-18'),
('admin', 40, '2023-03-18'),
('admin', 41, '2023-03-18'),
('admin', 42, '2023-03-18'),
('admin', 43, '2023-03-18'),
('admin', 44, '2023-03-18'),
('admin', 45, '2023-03-18'),
('admin', 46, '2023-03-18'),
('admin', 47, '2023-03-18'),
('admin', 48, '2023-03-18'),
('admin', 49, '2023-03-18'),
('admin', 50, '2023-03-18'),
('admin', 51, '2023-03-18'),
('admin', 52, '2023-03-18'),
('admin', 53, '2023-03-18'),
('admin', 54, '2023-03-18'),
('admin', 55, '2023-03-18'),
('admin', 56, '2023-03-18'),
('admin', 57, '2023-03-18'),
('ann', 72, '2023-03-19'),
('lilian', 58, '2023-03-18'),
('oliver', 65, '2023-03-18'),
('user1', 73, '2023-03-19'),
('user10', 70, '2023-03-18'),
('user11', 71, '2023-03-19'),
('user12', 59, '2023-03-18'),
('user13', 60, '2023-03-18'),
('user14', 61, '2023-03-18'),
('user15', 62, '2023-03-18'),
('user16', 63, '2023-03-18'),
('user17', 64, '2023-03-18'),
('user2', 74, '2023-03-19'),
('user3', 75, '2023-03-19'),
('user4', 76, '2023-03-19'),
('user5', 77, '2023-03-19'),
('user6', 66, '2023-03-18'),
('user7', 67, '2023-03-18'),
('user8', 68, '2023-03-18'),
('user9', 69, '2023-03-18');

-- --------------------------------------------------------

--
-- Table structure for table `creates_club`
--

CREATE TABLE `creates_club` (
  `club_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `creates_club`
--

INSERT INTO `creates_club` (`club_id`, `user_name`) VALUES
(1, 'admin'),
(2, 'admin'),
(3, 'ann'),
(4, 'user1'),
(5, 'oliver'),
(6, 'oliver'),
(7, 'user6'),
(8, 'user7'),
(9, 'lilian'),
(10, 'lilian');

--
-- Triggers `creates_club`
--
DELIMITER $$
CREATE TRIGGER `after_create_club` AFTER INSERT ON `creates_club` FOR EACH ROW BEGIN
		INSERT INTO joins_club(user_name, club_id) VALUES(new.user_name, new.club_id);
	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `joins_club`
--

CREATE TABLE `joins_club` (
  `user_name` varchar(20) NOT NULL,
  `club_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `joins_club`
--

INSERT INTO `joins_club` (`user_name`, `club_id`) VALUES
('admin', 1),
('admin', 2),
('ann', 1),
('ann', 2),
('ann', 3),
('lilian', 1),
('lilian', 9),
('oliver', 1),
('oliver', 3),
('user1', 4),
('user10', 7),
('user11', 7),
('user11', 8),
('user12', 9),
('user15', 9),
('user6', 2),
('user6', 3),
('user6', 5),
('user7', 1),
('user7', 2),
('user7', 6),
('user8', 7),
('user9', 5),
('user9', 6);

-- --------------------------------------------------------

--
-- Table structure for table `nutritional_statement`
--

CREATE TABLE `nutritional_statement` (
  `cereal_id` int(11) NOT NULL,
  `serving_size` float NOT NULL,
  `calories` int(11) NOT NULL,
  `protein` int(11) DEFAULT NULL,
  `fat` int(11) DEFAULT NULL,
  `sugars` int(11) DEFAULT NULL,
  `vitamins` int(11) DEFAULT NULL,
  `sodium` int(11) DEFAULT NULL,
  `fiber` int(11) DEFAULT NULL,
  `carbohydrate` int(11) DEFAULT NULL,
  `potassium` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nutritional_statement`
--

INSERT INTO `nutritional_statement` (`cereal_id`, `serving_size`, `calories`, `protein`, `fat`, `sugars`, `vitamins`, `sodium`, `fiber`, `carbohydrate`, `potassium`) VALUES
(1, 1, 70, 4, 1, 6, 25, 130, 10, 5, 280),
(2, 1, 120, 3, 5, 8, 0, 15, 2, 8, 135),
(3, 1, 70, 4, 1, 5, 25, 260, 9, 7, 320),
(4, 1, 50, 4, 0, 0, 25, 140, 14, 8, 330),
(5, 1, 110, 2, 2, 8, 25, 200, 1, 14, -1),
(6, 1, 110, 2, 2, 10, 25, 180, 2, 11, 70),
(7, 1, 110, 2, 0, 14, 25, 125, 1, 11, 30),
(8, 1.33, 130, 3, 2, 8, 25, 210, 2, 18, 100),
(9, 1, 90, 2, 1, 6, 25, 200, 4, 15, 125),
(10, 1, 90, 3, 0, 5, 25, 210, 5, 13, 190),
(11, 1, 120, 1, 2, 12, 25, 220, 0, 12, 35),
(12, 1, 110, 6, 2, 1, 25, 290, 2, 17, 105),
(13, 1, 120, 1, 3, 9, 25, 210, 0, 13, 45),
(14, 1, 110, 3, 2, 7, 25, 140, 2, 13, 105),
(15, 1, 110, 1, 1, 13, 25, 180, 0, 12, 55),
(16, 1, 110, 2, 0, 3, 25, 280, 0, 22, 25),
(17, 1, 100, 2, 0, 2, 25, 290, 1, 21, 35),
(18, 1, 110, 1, 0, 12, 25, 90, 1, 13, 20),
(19, 1, 110, 1, 1, 13, 25, 180, 0, 12, 65),
(20, 1, 110, 3, 3, 7, 25, 140, 4, 10, 160),
(21, 1, 100, 3, 0, 0, 0, 80, 1, 21, -1),
(22, 1, 110, 2, 0, 3, 25, 220, 1, 21, 30),
(23, 1, 100, 2, 1, 10, 25, 140, 2, 11, 120),
(24, 1, 100, 2, 0, 5, 25, 190, 1, 18, 80),
(25, 1, 110, 2, 1, 13, 25, 125, 1, 11, 30),
(26, 1, 110, 1, 0, 11, 25, 200, 1, 14, 25),
(27, 1, 100, 3, 0, 7, 25, 0, 3, 14, 100),
(28, 1.25, 120, 3, 2, 10, 25, 160, 5, 12, 200),
(29, 1.33, 120, 3, 0, 12, 25, 240, 5, 14, 190),
(30, 1, 110, 1, 1, 12, 25, 135, 0, 13, 25),
(31, 1, 100, 2, 0, 15, 25, 45, 0, 11, 40),
(32, 1, 110, 1, 1, 9, 25, 280, 0, 15, 45),
(33, 1, 100, 3, 1, 5, 25, 140, 3, 15, 85),
(34, 1, 110, 3, 0, 3, 25, 170, 3, 17, 90),
(35, 1, 120, 3, 3, 4, 25, 75, 3, 13, 100),
(36, 1, 120, 1, 2, 11, 25, 220, 1, 12, 45),
(37, 1, 110, 3, 1, 10, 25, 250, 2, 12, 90),
(38, 1, 110, 1, 0, 11, 25, 180, 0, 14, 35),
(39, 1, 110, 2, 1, 6, 100, 170, 1, 17, 60),
(40, 1.3, 140, 3, 1, 9, 100, 170, 2, 20, 95),
(41, 1, 110, 2, 1, 3, 25, 260, 0, 21, 40),
(42, 1, 100, 4, 2, 6, 25, 150, 2, 12, 95),
(43, 1, 110, 2, 1, 12, 25, 180, 0, 12, 55),
(44, 1, 100, 4, 1, 3, 25, 0, 0, 16, 95),
(45, 1, 150, 4, 3, 11, 25, 95, 3, 16, 170),
(46, 1, 150, 4, 3, 11, 25, 150, 3, 16, 170),
(47, 1.5, 160, 3, 2, 13, 25, 150, 3, 17, 160),
(48, 1, 100, 2, 1, 6, 25, 220, 2, 15, 90),
(49, 1, 120, 2, 1, 9, 25, 190, 0, 15, 40),
(50, 1.33, 140, 3, 2, 7, 25, 220, 3, 21, 130),
(51, 1, 90, 3, 0, 2, 25, 170, 3, 18, 90),
(52, 1.25, 130, 3, 2, 10, 25, 170, 2, 14, 120),
(53, 1.33, 120, 3, 1, 14, 25, 200, 6, 11, 260),
(54, 1, 100, 3, 0, 3, 100, 320, 1, 20, 45),
(55, 0.5, 50, 1, 0, 0, 0, 0, 0, 13, 15),
(56, 0.5, 50, 2, 0, 0, 0, 0, 1, 10, 50),
(57, 1, 100, 4, 1, 6, 25, 135, 2, 14, 110),
(58, 1, 100, 5, 2, -1, 0, 0, 3, -1, 110),
(59, 1.33, 120, 3, 1, 12, 25, 210, 5, 14, 240),
(60, 1, 100, 3, 2, 8, 25, 140, 3, 11, 140),
(61, 1, 90, 2, 0, 6, 25, 0, 2, 15, 110),
(62, 1, 110, 1, 0, 2, 25, 240, 0, 23, 30),
(63, 1, 110, 2, 0, 3, 25, 290, 0, 22, 35),
(64, 0.83, 80, 2, 0, 0, 0, 0, 3, 16, 95),
(65, 1, 90, 3, 0, 0, 0, 0, 4, 19, 140),
(66, 1, 90, 3, 0, 0, 0, 0, 3, 20, 120),
(67, 1, 110, 2, 1, 15, 25, 70, 1, 9, 40),
(68, 1, 110, 6, 0, 3, 25, 230, 1, 16, 55),
(69, 1, 90, 2, 0, 5, 25, 15, 3, 15, 90),
(70, 1, 110, 2, 1, 3, 100, 200, 0, 21, 35),
(71, 1.5, 140, 3, 1, 14, 100, 190, 4, 15, 230),
(72, 1, 100, 3, 1, 3, 100, 200, 3, 16, 110),
(73, 1, 110, 2, 1, 3, 25, 250, 0, 21, 60),
(74, 1, 110, 1, 1, 12, 25, 140, 0, 13, 25),
(75, 1, 100, 3, 1, 3, 25, 230, 3, 17, 115),
(76, 1, 100, 3, 1, 3, 25, 200, 3, 17, 110),
(77, 1, 110, 2, 1, 8, 25, 200, 1, 16, 60);

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `user_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`user_name`, `email`) VALUES
('admin', 'admin@gmail.com'),
('lilian', 'lilian@gmail.com'),
('ann', 'notmyemail@gmail.com'),
('oliver', 'oliver@gmail.com'),
('user10', 'user10@gmail.com'),
('user11', 'user11@gmail.com'),
('user12', 'user12@gmail.com'),
('user13', 'user13@gmail.com'),
('user14', 'user14@gmail.com'),
('user15', 'user15@gmail.com'),
('user16', 'user16@gmail.com'),
('user17', 'user17@gmail.com'),
('user18', 'user18@gmail.com'),
('user1', 'user1@gmail.com'),
('user2', 'user2@gmail.com'),
('user3', 'user3@gmail.com'),
('user4', 'user4@gmail.com'),
('user5', 'user5@gmail.com'),
('user6', 'user6@gmail.com'),
('user7', 'user7@gmail.com'),
('user8', 'user8@gmail.com'),
('user9', 'user9@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_validation`
--

CREATE TABLE `user_validation` (
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_validation`
--

INSERT INTO `user_validation` (`email`, `password`) VALUES
('admin@gmail.com', 'admin'),
('lilian@gmail.com', 'thisislilian'),
('notmyemail@gmail.com', 'thisisann'),
('oliver@gmail.com', 'thisisoliver'),
('user10@gmail.com', 'password10'),
('user11@gmail.com', 'password11'),
('user12@gmail.com', 'password12'),
('user13@gmail.com', 'password13'),
('user14@gmail.com', 'password14'),
('user15@gmail.com', 'password15'),
('user16@gmail.com', 'password16'),
('user17@gmail.com', 'password17'),
('user18@gmail.com', 'password18'),
('user1@gmail.com', 'password1'),
('user2@gmail.com', 'password2'),
('user3@gmail.com', 'password3'),
('user4@gmail.com', 'password4'),
('user5@gmail.com', 'password5'),
('user6@gmail.com', 'password6'),
('user7@gmail.com', 'password7'),
('user8@gmail.com', 'password8'),
('user9@gmail.com', 'password9');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `user_name` varchar(20) NOT NULL,
  `cereal_id` int(11) NOT NULL,
  `vote_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`user_name`, `cereal_id`, `vote_value`) VALUES
('ann', 2, -1),
('ann', 5, 1),
('ann', 15, 1),
('lilian', 15, 1),
('lilian', 22, 1),
('oliver', 19, -1),
('oliver', 21, 1),
('user1', 3, 1),
('user1', 8, -1),
('user10', 8, 1),
('user11', 7, 1),
('user11', 8, -1),
('user12', 7, 1),
('user12', 26, -1),
('user13', 8, 1),
('user14', 3, 1),
('user14', 15, -1),
('user15', 21, -1),
('user16', 2, 1),
('user17', 2, 1),
('user2', 3, -1),
('user2', 8, -1),
('user3', 15, 1),
('user4', 15, 1),
('user5', 4, -1),
('user6', 26, 1),
('user7', 21, 1),
('user8', 26, 1),
('user8', 35, -1),
('user9', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`user_name`,`cereal_id`),
  ADD KEY `cereal_id` (`cereal_id`);

--
-- Indexes for table `cereal_info`
--
ALTER TABLE `cereal_info`
  ADD PRIMARY KEY (`cereal_id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `cereal_manufacturer`
--
ALTER TABLE `cereal_manufacturer`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`club_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`user_name`,`cereal_id`,`comment_id`),
  ADD KEY `cereal_id` (`cereal_id`);

--
-- Indexes for table `creates_cereal`
--
ALTER TABLE `creates_cereal`
  ADD PRIMARY KEY (`user_name`,`cereal_id`),
  ADD KEY `cereal_id` (`cereal_id`);

--
-- Indexes for table `creates_club`
--
ALTER TABLE `creates_club`
  ADD PRIMARY KEY (`club_id`,`user_name`),
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `joins_club`
--
ALTER TABLE `joins_club`
  ADD PRIMARY KEY (`user_name`,`club_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `nutritional_statement`
--
ALTER TABLE `nutritional_statement`
  ADD PRIMARY KEY (`cereal_id`),
  ADD UNIQUE KEY `cereal_id` (`cereal_id`);

--
-- Indexes for table `user_information`
--
ALTER TABLE `user_information`
  ADD PRIMARY KEY (`user_name`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `user_validation`
--
ALTER TABLE `user_validation`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`user_name`,`cereal_id`),
  ADD KEY `cereal_id` (`cereal_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`cereal_id`) REFERENCES `cereal_info` (`cereal_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`user_name`) REFERENCES `user_information` (`user_name`) ON DELETE CASCADE;

--
-- Constraints for table `cereal_info`
--
ALTER TABLE `cereal_info`
  ADD CONSTRAINT `cereal_info_ibfk_1` FOREIGN KEY (`name`) REFERENCES `cereal_manufacturer` (`name`) ON DELETE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`cereal_id`) REFERENCES `cereal_info` (`cereal_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_name`) REFERENCES `user_information` (`user_name`) ON DELETE CASCADE;

--
-- Constraints for table `creates_cereal`
--
ALTER TABLE `creates_cereal`
  ADD CONSTRAINT `creates_cereal_ibfk_1` FOREIGN KEY (`cereal_id`) REFERENCES `cereal_info` (`cereal_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `creates_cereal_ibfk_2` FOREIGN KEY (`user_name`) REFERENCES `user_information` (`user_name`) ON DELETE CASCADE;

--
-- Constraints for table `creates_club`
--
ALTER TABLE `creates_club`
  ADD CONSTRAINT `creates_club_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `club` (`club_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `creates_club_ibfk_2` FOREIGN KEY (`user_name`) REFERENCES `user_information` (`user_name`) ON DELETE CASCADE;

--
-- Constraints for table `joins_club`
--
ALTER TABLE `joins_club`
  ADD CONSTRAINT `joins_club_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `club` (`club_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `joins_club_ibfk_2` FOREIGN KEY (`user_name`) REFERENCES `user_information` (`user_name`) ON DELETE CASCADE;

--
-- Constraints for table `user_information`
--
ALTER TABLE `user_information`
  ADD CONSTRAINT `user_information_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_validation` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`cereal_id`) REFERENCES `cereal_info` (`cereal_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`user_name`) REFERENCES `user_information` (`user_name`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
