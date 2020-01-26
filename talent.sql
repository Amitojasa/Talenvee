-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2020 at 05:49 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `talent`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `comment` varchar(10000) NOT NULL,
  `postId` int(11) NOT NULL,
  `authorId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `postId`, `authorId`) VALUES
(44, 'asdhgsdaf', 15, 4),
(45, 'ddjklasjfkasjdf', 15, 6),
(46, 'dfsghfg @hel', 0, 1),
(47, 'dfhjh @am', 0, 1),
(48, 'jhfsaj @am', 0, 1),
(49, 'ljhdsfj @ami', 0, 1),
(50, 'djsfhjh @amito', 0, 1),
(51, 'jdsahfj @he', 0, 1),
(52, 'dsjfhj @he', 0, 1),
(53, 'adfkjahsfdj @he', 0, 1),
(54, 'sjadhfj AmitojASA1 sjajfhjdfh', 0, 1),
(55, 'jskfj @[8] kasjfkj', 15, 1),
(56, 'jjashfjdh @[5] djsfjasdfhj', 0, 1),
(57, 'sakhadfjh @[8] sadfhjasdf', 0, 1),
(58, 'asjfhj @[2] allsflsajjd', 0, 1),
(59, 'aksdghasdg @[4] dkfhdsjkfh', 0, 1),
(60, 'sakdfhj @[4] sajKDSH', 0, 1),
(61, 'sfjdskfj @[4] sdjjfkdsjfa', 0, 1),
(62, 'afjks @[4] lafjkfsjdf', 0, 1),
(63, 'jjhgjkdsf @[8]  sadfjksjafdkj', 18, 1),
(64, 'asjfkj @[2] askjfksaj', 18, 1),
(65, 'jaksjf @[5]  majsjfhd', 18, 1),
(68, 'asjfh @[7] sajdfhjsdahf', 15, 6);

-- --------------------------------------------------------

--
-- Table structure for table `competition`
--

CREATE TABLE IF NOT EXISTS `competition` (
`id` int(11) NOT NULL,
  `heading` varchar(1000) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `post1` int(11) NOT NULL,
  `post2` int(11) NOT NULL,
  `startTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `winner` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `tags` varchar(1000) NOT NULL DEFAULT '[]',
  `winPost` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `competition`
--

INSERT INTO `competition` (`id`, `heading`, `user1`, `user2`, `post1`, `post2`, `startTime`, `winner`, `status`, `tags`, `winPost`) VALUES
(1, 'beating', 6, 1, 19, 18, '2019-07-02 05:30:22', 1, 0, '{"1":"hello"}', 18),
(2, 'beating', 6, 1, 19, 18, '2019-07-02 11:30:22', 0, 1, '{"1":"hello"}', 0),
(3, 'beating', 6, 1, 19, 18, '0000-00-00 00:00:00', 1, 0, '{"1":"hello"}', 18),
(4, 'hjcgfbv', 1, 6, 15, 18, '2019-07-03 06:40:04', 0, 1, '[]', 0);

-- --------------------------------------------------------

--
-- Table structure for table `logintb`
--

CREATE TABLE IF NOT EXISTS `logintb` (
`id` int(11) NOT NULL,
  `emailId` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `linkUserId` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logintb`
--

INSERT INTO `logintb` (`id`, `emailId`, `password`, `linkUserId`) VALUES
(1, 'amitojsingh1990@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1),
(2, 'amitojsingh199@gmail.com', '25d55ad283aa400af464c76d713c07ad', 2),
(3, 'amitojsingh1991@gmail.com', '872cacff48ab5fd129c45d25bd472de0', 4),
(4, 'amitojvmc@gmail.com', '872cacff48ab5fd129c45d25bd472de0', 5),
(5, 'sasingh25@gmail.com', '25d55ad283aa400af464c76d713c07ad', 6),
(6, 'qqfioj@ksdfh.com', '25d55ad283aa400af464c76d713c07ad', 7),
(7, 'sjf@shfj.com', '040b7cf4a55014e185813e0644502ea9', 8);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(11) NOT NULL,
  `fromId` int(11) NOT NULL,
  `toId` int(11) NOT NULL,
  `message` varchar(10000) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `fromId`, `toId`, `message`, `time`, `status`) VALUES
(1, 6, 2, 'kkhgsdhfga', '2019-06-14 08:12:46', 1),
(2, 6, 2, 'jehjkhj', '2019-06-14 08:12:48', 1),
(3, 6, 2, 'khjerhjqhr', '2019-06-14 08:12:49', 1),
(4, 6, 2, 'dhfhasjhfjhasdf', '2019-06-15 06:08:32', 1),
(5, 6, 2, 'ljdsfklasjf', '2019-06-15 06:08:37', 1),
(6, 6, 2, 'jashdfjhadsf', '2019-06-15 06:10:04', 1),
(7, 6, 2, 'safjadshf', '2019-06-15 06:10:06', 1),
(8, 6, 2, 'ajsfdjfjsaflvndsfasf', '2019-06-15 06:10:08', 1),
(9, 6, 2, 'asdufyeqwquryewjhrewuyrebhfsadd', '2019-06-15 06:10:13', 1),
(10, 6, 2, 'ashdfjadsfh', '2019-06-15 06:10:15', 1),
(11, 6, 2, 'fkjhdasjf', '2019-06-15 06:10:15', 1),
(12, 6, 2, 'hjadlshfsd', '2019-06-15 06:10:16', 1),
(13, 6, 2, 'haslkfj', '2019-06-15 06:10:17', 1),
(14, 6, 2, 'hdlsafh', '2019-06-15 06:10:18', 1),
(15, 6, 2, 'dsfldaskjf', '2019-06-15 06:10:19', 1),
(16, 6, 2, 'dfjlkadsjf', '2019-06-15 06:10:20', 1),
(17, 6, 2, 'kajdsflkjdas', '2019-06-15 06:10:21', 1),
(18, 6, 2, ';kjadsffkjasd', '2019-06-15 06:10:22', 1),
(19, 6, 2, 'jrhetoreotert''safhdsghf', '2019-06-15 06:12:25', 1),
(20, 6, 2, 'dashfjsdfh', '2019-06-15 06:12:27', 1),
(21, 6, 2, 'sjafhs', '2019-06-15 06:12:29', 1),
(22, 6, 2, 'odfhasdjf4', '2019-06-15 06:26:47', 1),
(23, 6, 2, 'sdafjh', '2019-06-15 06:27:02', 1),
(24, 6, 2, 'akhhdfj', '2019-06-15 06:46:55', 1),
(25, 6, 2, 'jadsf', '2019-06-15 06:46:56', 1),
(26, 1, 2, 'aljlsdh', '2019-06-15 06:47:41', 1),
(27, 1, 2, 'asdn', '2019-06-15 06:47:42', 1),
(28, 6, 2, 'djfhas', '2019-06-15 06:47:50', 1),
(29, 6, 2, 'adfasbf', '2019-06-15 06:48:04', 1),
(30, 6, 2, 'ksahfh', '2019-06-15 06:48:09', 1),
(31, 1, 2, 'dashhfb', '2019-06-15 06:48:12', 1),
(32, 4, 2, 'jlfdsgj', '2019-06-15 06:50:15', 1),
(33, 4, 2, 'asfgsadfgjsahfkjadshfjadfuiyar', '2019-06-15 06:50:20', 1),
(34, 1, 2, 'vhbhmnk,', '2019-06-15 06:51:10', 1),
(35, 1, 2, 'akdsfhdsjafh', '2019-06-15 06:52:55', 1),
(36, 6, 2, 'hello', '2019-06-15 06:54:52', 1),
(37, 2, 6, 'helladsjf', '2019-06-15 06:58:53', 1),
(38, 4, 2, 'lajdhfjhads', '2019-06-15 06:59:00', 1),
(39, 2, 6, 'asdfh', '2019-06-15 06:59:14', 1),
(40, 6, 2, 'nsaf', '2019-06-15 07:00:28', 1),
(41, 2, 6, 'kadskfjdhsf', '2019-06-15 07:01:41', 1),
(42, 6, 2, 'jasdhfjhadsf', '2019-06-15 07:01:47', 1),
(43, 2, 6, 'asdfhjdsfh', '2019-06-15 07:01:50', 1),
(44, 2, 6, 'uadyfjasdhf', '2019-06-15 07:13:40', 1),
(45, 6, 2, 'dasjdhfjdashf', '2019-06-15 07:13:43', 1),
(46, 6, 2, 'hello', '2019-06-15 07:13:53', 1),
(47, 2, 6, 'hello', '2019-06-15 07:13:58', 1),
(48, 2, 6, 'how are you', '2019-06-15 07:14:02', 1),
(49, 6, 2, 'ahdsa', '2019-06-15 07:14:05', 1),
(50, 6, 2, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore, voluptatem quae natus nisi repellendus alias deleniti saepe quibusdam culpa sed consectetur est a recusandae minima consequuntur asperiores cum explicabo quis placeat dolor commodi accusantium numquam? Inventore facilis omnis itaque veniam, nisi ipsum maxime exercitationem culpa nam sed quidem illum. Maiores debitis nihil reiciendis commodi ex eligendi labore consectetur error reprehenderit saepe, minus quasi soluta possimus unde nobis sint explicabo eos dolorem officiis facilis fugiat. Asperiores, veniam nesciunt veritatis nihil laborum in enim quae excepturi cumque maiores rerum tempore vitae provident dolorem, ea ipsa saepe, illum blanditiis deserunt vel iste possimus.', '2019-06-15 08:50:14', 1),
(51, 2, 6, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore, voluptatem quae natus nisi repellendus alias deleniti saepe quibusdam culpa sed consectetur est a recusandae minima consequuntur asperiores cum explicabo quis placeat dolor commodi accusantium numquam? Inventore facilis omnis itaque veniam, nisi ipsum maxime exercitationem culpa nam sed quidem illum. Maiores debitis nihil reiciendis commodi ex eligendi labore consectetur error reprehenderit saepe, minus quasi soluta possimus unde nobis sint explicabo eos dolorem officiis facilis fugiat. Asperiores, veniam nesciunt veritatis nihil laborum in enim quae excepturi cumque maiores rerum tempore vitae provident dolorem, ea ipsa saepe, illum blanditiis deserunt vel iste possimus.', '2019-06-15 08:54:51', 1),
(52, 6, 2, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore, voluptatem quae natus nisi repellendus alias deleniti saepe quibusdam culpa sed consectetur est a recusandae minima consequuntur asperiores cum explicabo quis placeat dolor commodi accusantium numquam? Inventore facilis omnis itaque veniam, nisi ipsum maxime exercitationem culpa nam sed quidem illum. Maiores debitis nihil reiciendis commodi ex eligendi labore consectetur error reprehenderit saepe, minus quasi soluta possimus unde nobis sint explicabo eos dolorem officiis facilis fugiat. Asperiores, veniam nesciunt veritatis nihil laborum in enim quae excepturi cumque maiores rerum tempore vitae provident dolorem, ea ipsa saepe, illum blanditiis deserunt vel iste possimus.', '2019-06-15 08:55:19', 1),
(53, 2, 6, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore, voluptatem quae natus nisi repellendus alias deleniti saepe quibusdam culpa sed consectetur est a recusandae minima consequuntur asperiores cum explicabo quis placeat dolor commodi accusantium numquam? Inventore facilis omnis itaque veniam, nisi ipsum maxime exercitationem culpa nam sed quidem illum. Maiores debitis nihil reiciendis commodi ex eligendi labore consectetur error reprehenderit saepe, minus quasi soluta possimus unde nobis sint explicabo eos dolorem officiis facilis fugiat. Asperiores, veniam nesciunt veritatis nihil laborum in enim quae excepturi cumque maiores rerum tempore vitae provident dolorem, ea ipsa saepe, illum blanditiis deserunt vel iste possimus.', '2019-06-15 08:55:26', 1),
(54, 6, 2, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore, voluptatem quae natus nisi repellendus alias deleniti saepe quibusdam culpa sed consectetur est a recusandae minima consequuntur asperiores cum explicabo quis placeat dolor commodi accusantium numquam? Inventore facilis omnis itaque veniam, nisi ipsum maxime exercitationem culpa nam sed quidem illum. Maiores debitis nihil reiciendis commodi ex eligendi labore consectetur error reprehenderit saepe, minus quasi soluta possimus unde nobis sint explicabo eos dolorem officiis facilis fugiat. Asperiores, veniam nesciunt veritatis nihil laborum in enim quae excepturi cumque maiores rerum tempore vitae provident dolorem, ea ipsa saepe, illum blanditiis deserunt vel iste possimus.', '2019-06-15 08:55:52', 1),
(55, 2, 6, 'hello', '2019-06-15 08:55:56', 1),
(56, 6, 2, 'hello', '2019-06-15 08:56:00', 1),
(57, 2, 4, 'jhsfdjh', '2019-06-17 08:02:37', 0),
(58, 4, 2, 'adsfahdfjhadsf', '2019-06-17 08:03:38', 1),
(59, 4, 1, 'hlo', '2019-06-17 08:07:36', 1),
(60, 2, 4, 'http://localhost/talent/single.php?pid=18', '2019-06-17 08:14:54', 0),
(61, 2, 2, 'askdhfj', '2019-06-17 09:31:37', 0),
(62, 6, 1, 'hlo', '2019-06-17 09:43:55', 1),
(63, 1, 6, 'haha', '2019-06-17 09:44:00', 1),
(64, 1, 6, 'hi', '2019-06-17 09:44:04', 1),
(65, 6, 1, 'how are you', '2019-06-17 09:44:08', 1),
(66, 1, 6, 'im fine thankyou', '2019-06-17 09:44:24', 1),
(67, 6, 1, 'what about you', '2019-06-17 09:44:31', 1),
(68, 1, 6, 'nice', '2019-06-17 09:44:34', 1),
(69, 1, 6, 'having fun', '2019-06-17 09:44:41', 1),
(70, 6, 1, 'ya', '2019-06-17 09:44:47', 1),
(71, 6, 1, 'http://localhost/talent/single.php?pid=18', '2019-06-20 06:51:49', 1),
(72, 6, 1, 'http://localhost/talent/single.php?pid=18', '2019-06-20 06:52:02', 1),
(73, 6, 1, 'hlo', '2019-06-20 06:54:44', 1),
(74, 6, 1, 'hlo\n', '2019-06-20 06:58:34', 1),
(89, 6, 1, 'dsjfhjdsafhj', '2019-06-20 07:12:15', 1),
(90, 6, 1, 'dsjfhjdsafhj', '2019-06-20 07:12:22', 1),
(91, 6, 1, 'dfjkashf', '2019-06-20 07:13:11', 1),
(92, 6, 1, 'shfhs', '2019-06-20 07:25:58', 1),
(93, 6, 1, 'http://localhost/talent/chat.php', '2019-06-21 01:11:34', 1),
(94, 6, 7, 'jdkjfsadkjf', '2019-06-21 01:16:04', 1),
(95, 6, 7, 'http://localhost/talent/chat.php?user=Asad', '2019-06-22 05:26:11', 1),
(96, 6, 7, 'https://stackoverflow.com/questions/206059/php-validation-regex-for-url', '2019-06-22 05:27:37', 1),
(97, 6, 7, 'hlo', '2019-06-22 06:18:02', 1),
(98, 7, 6, 'hlo', '2019-06-22 06:18:27', 1),
(99, 7, 6, 'dfgghj', '2019-06-22 06:22:44', 1),
(100, 7, 6, 'dfgghj', '2019-06-22 06:22:55', 1),
(101, 7, 6, 'djfahsjkdfh', '2019-06-22 06:24:13', 1),
(102, 7, 6, '', '2019-06-22 06:24:16', 1),
(103, 7, 6, 'dasjfhasjkdfhs', '2019-06-22 06:24:19', 1),
(104, 7, 6, 'dasjfhasjkdfhskhsasdgf', '2019-06-22 06:24:21', 1),
(105, 7, 6, 'dasjfhasjkdfhskhsasdgf', '2019-06-22 06:24:24', 1),
(106, 7, 6, 'dasjfhasjkdfhskhsasdgf', '2019-06-22 06:24:25', 1),
(107, 7, 6, '', '2019-06-22 06:24:46', 1),
(108, 7, 6, 'SHADjk', '2019-06-22 06:24:58', 1),
(109, 6, 7, 'ghdhgdg', '2019-06-22 06:32:56', 1),
(110, 6, 7, 'vb', '2019-06-22 06:36:16', 1),
(111, 6, 7, 'fdgth', '2019-06-22 06:40:09', 1),
(112, 6, 1, 'jdashfjkahsfjh', '2019-06-22 08:44:53', 1),
(113, 2, 1, 'hdghsadgf', '2019-06-22 08:45:16', 1),
(114, 2, 1, 'jahhhdhfhds', '2019-06-22 08:45:38', 1),
(115, 2, 1, 'dfshdasjfh', '2019-06-22 08:45:50', 1),
(116, 2, 1, 'sdahfjhdsjcbdsb', '2019-06-22 08:46:05', 1),
(117, 2, 1, 'hhjadhfajsf''', '2019-06-22 08:46:09', 1),
(118, 1, 6, 'jafskdlfj4', '2019-06-22 08:46:39', 1),
(119, 1, 6, 'rqhwjrkh', '2019-06-22 08:47:26', 1),
(120, 1, 6, 'tyhgjk', '2019-06-22 12:05:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
`id` int(11) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `fromId` int(11) NOT NULL,
  `toId` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `commentId` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `msg`, `fromId`, `toId`, `time`, `commentId`, `status`) VALUES
(1, 'following', 6, 8, '2019-06-22 05:38:06', 0, 0),
(2, 'following', 6, 1, '2019-06-22 10:37:06', 0, 0),
(3, 'mentioned', 6, 8, '2019-06-24 07:07:18', 0, 0),
(4, 'mentioned', 6, 8, '2019-06-24 07:09:36', 0, 0),
(5, 'mentioned', 6, 2, '2019-06-24 07:09:36', 0, 0),
(6, 'mentioned', 6, 2, '2019-06-24 07:09:36', 0, 0),
(7, 'mentioned', 6, 5, '2019-06-24 07:17:50', 74, 0),
(8, 'mentioned', 6, 8, '2019-07-01 11:41:14', 75, 0),
(9, 'mentioned', 6, 2, '2019-07-02 12:26:00', 76, 0),
(10, 'mentioned', 6, 8, '2019-07-02 12:26:11', 77, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(11) NOT NULL,
  `imageSrc` varchar(10000) NOT NULL DEFAULT '',
  `videoSrc` varchar(10000) NOT NULL DEFAULT '',
  `caption` varchar(20000) NOT NULL DEFAULT '',
  `authorId` int(11) NOT NULL,
  `likes` varchar(10000) NOT NULL DEFAULT '[]',
  `tags` varchar(1000) NOT NULL DEFAULT '[]',
  `uploadTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` bigint(20) NOT NULL DEFAULT '0',
  `type` varchar(100) NOT NULL DEFAULT 'general'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `imageSrc`, `videoSrc`, `caption`, `authorId`, `likes`, `tags`, `uploadTime`, `rating`, `type`) VALUES
(15, 'createPost/uploads/1559810995_intro-img1.png', '', 'sdhasjdhasjhdafhdjsfhjasdf', 6, '["4"]', '{"1":"dgfhj","2":"uiytf","3":"try"}', '2019-06-06 08:49:55', 1, 'general'),
(18, '', 'createPost\\uploads\\1561714039_b51135a44b7b3ba27c4a97a3135ef81a.mp4', 'thanku', 6, '["6"]', '{"1":"tiktok","2":"gurpreet"}', '2019-06-12 07:06:50', 1, 'general'),
(19, 'createPost/uploads/1562065484_asa.JPG', '', '', 6, '["6"]', '{"1":"table"}', '2019-07-02 11:04:44', 1, 'compete');

-- --------------------------------------------------------

--
-- Table structure for table `userdetailstb`
--

CREATE TABLE IF NOT EXISTS `userdetailstb` (
`id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `emailAddress` varchar(100) NOT NULL,
  `contactNo1` varchar(15) NOT NULL,
  `country` varchar(10) NOT NULL DEFAULT 'India',
  `followers` varchar(10000) NOT NULL DEFAULT '[]',
  `following` varchar(10000) NOT NULL DEFAULT '[]',
  `posts` varchar(10000) NOT NULL DEFAULT '[]',
  `interests` varchar(10000) NOT NULL DEFAULT '[]',
  `profilepic` varchar(1000) NOT NULL DEFAULT 'no-image.jpg',
  `UserDesc` varchar(500) NOT NULL DEFAULT 'No Description'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetailstb`
--

INSERT INTO `userdetailstb` (`id`, `username`, `firstName`, `lastName`, `emailAddress`, `contactNo1`, `country`, `followers`, `following`, `posts`, `interests`, `profilepic`, `UserDesc`) VALUES
(1, 'AsAhuja', 'Amitoj Singh', 'Ahuja', 'amitojsingh1990@gmail.com', '9417171800', 'India', '["6"]', '["4","5","6"]', '[]', '["sports","jadsfh","dgfhjk","hello","nice"]', 'no-image.jpg', 'No description'),
(2, 'AmitojASA', 'Amitoj', 'Ahuja', 'amitojsingh199@gmail.com', '9417171800', 'India', '["6"]', '[]', '[]', '[]', 'no-image.jpg', ''),
(4, 'AmitojASA1', 'Amitoj', 'singh', 'amitojsingh1991@gmail.com', '9417171800', 'India', '["1","6"]', '[]', '[]', '["hello","adjlflhadf","potencia","Engineer"]', 'no-image.jpg', ''),
(5, 'AmitojASAA', 'Amitoj  Singh', 'Ahuja', 'amitojvmc@gmail.com', '9417171800', 'India', '["1"]', '[]', '[]', '[]', 'no-image.jpg', ''),
(6, 'Sasingh', 'Sarbjeet', 'Ahuja', 'sasingh25@gmail.com', '9417102100', 'India', '["6","1"]', '["2","4","6","8","1"]', '["18","15","19"]', '["dgfhjk","hgjbvgc","adsfghjkfghj","sports","fdgh","hdfhafd","ahdsga","alsdjkasj","try"]', '6_1559375442.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui iure possimus praesentium odit eveniet laboriosam fugiat amet id doloribus inventore.'),
(7, 'Asad', 'Aaidj', 'ashd', 'qqfioj@ksdfh.com', '845132598765', 'India', '[]', '[]', '[]', '["hello"]', 'no-image.jpg', ''),
(8, 'hello', 'jdfjkjs', 'kdjfkj', 'sjf@shfj.com', '9417171800', 'India', '["6"]', '[]', '[]', '["yo","nice"]', 'no-image.jpg', 'No Description');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `postId` (`postId`), ADD KEY `authorId` (`authorId`), ADD KEY `postId_2` (`postId`);

--
-- Indexes for table `competition`
--
ALTER TABLE `competition`
 ADD PRIMARY KEY (`id`), ADD KEY `user1` (`user1`), ADD KEY `user2` (`user2`), ADD KEY `post1` (`post1`), ADD KEY `post2` (`post2`), ADD KEY `winner` (`winner`), ADD KEY `winPost` (`winPost`);

--
-- Indexes for table `logintb`
--
ALTER TABLE `logintb`
 ADD PRIMARY KEY (`id`), ADD KEY `linkUserId` (`linkUserId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`), ADD KEY `from` (`fromId`,`toId`), ADD KEY `toId` (`toId`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
 ADD PRIMARY KEY (`id`), ADD KEY `from` (`fromId`,`toId`), ADD KEY `toId` (`toId`), ADD KEY `commentId` (`commentId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`), ADD KEY `authorId` (`authorId`);

--
-- Indexes for table `userdetailstb`
--
ALTER TABLE `userdetailstb`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `competition`
--
ALTER TABLE `competition`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `logintb`
--
ALTER TABLE `logintb`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `userdetailstb`
--
ALTER TABLE `userdetailstb`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `userdetailstb` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `logintb`
--
ALTER TABLE `logintb`
ADD CONSTRAINT `logintb_ibfk_1` FOREIGN KEY (`linkUserId`) REFERENCES `userdetailstb` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`fromId`) REFERENCES `userdetailstb` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`toId`) REFERENCES `userdetailstb` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`fromId`) REFERENCES `userdetailstb` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`toId`) REFERENCES `userdetailstb` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `userdetailstb` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
