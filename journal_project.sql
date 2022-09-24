-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 23, 2022 at 07:25 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `journal_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `id` int(11) NOT NULL,
  `u_id` varchar(10) NOT NULL,
  `user_uid` varchar(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `text_content` text NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `weather` tinyint(4) DEFAULT NULL,
  `last_edited` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `u_id`, `user_uid`, `title`, `text_content`, `location`, `weather`, `last_edited`, `is_active`, `date_created`) VALUES
(4, 'bHPD5DRVWT', '7Si6mV15dH', 'text', 'text Content', '', 0, '2022-09-15 13:57:50', 1, '2022-09-15 13:57:50'),
(9, 'kLyN4Fy3Yz', '7Si6mV15dH', 'my entry', 'I like pumpkins', '', 0, '2022-09-15 15:49:39', 1, '2022-09-15 15:49:39'),
(10, 'FD3THJFT5Q', 'phwTdmTWKT', 'text', 'text content', '', 0, '2022-09-15 18:20:31', 1, '2022-09-15 18:20:31'),
(11, 'aXYmMMgwog', '6DXXS78zVT', 'fwafa', 'fwafawfawfwa', '', 0, '2022-09-16 12:18:25', 1, '2022-09-16 12:18:25'),
(12, 'p4JxmxiTUZ', '6DXXS78zVT', 'fwafa', 'fwafawfawfwa', '', 0, '2022-09-16 12:22:56', 1, '2022-09-16 12:22:56'),
(13, '8hLfZSJmP9', '6DXXS78zVT', 'fwafa', 'fwafawfawfwa', '', 0, '2022-09-16 12:24:00', 1, '2022-09-16 12:24:00'),
(14, 'Q7w94sAXGa', '6DXXS78zVT', 'feasfs', 'gesgsgs', '', 0, '2022-09-19 12:03:20', 1, '2022-09-19 12:03:20'),
(15, 'q2YC3JY6kC', '6DXXS78zVT', 'alberquerky', 'nice rack', '', 0, '2022-08-15 12:04:36', 1, '2022-09-19 12:04:36'),
(16, 'ejooGeMczB', '6DXXS78zVT', 'valid entry', 'you know it', '', 0, '2022-09-19 12:06:39', 1, '2022-09-19 12:06:39'),
(17, 'dDQ15fYjKs', '6DXXS78zVT', 'tester', 'you know what it is', '', 0, '2022-09-19 12:25:21', 1, '2022-09-19 12:25:21'),
(18, 'YakF1RZ1T5', '6DXXS78zVT', 'tester with lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit amet fringilla ex. Aliquam leo dui, egestas sodales sagittis sed, feugiat et nisi. Sed mollis lobortis quam, eget aliquet metus finibus ac. Fusce turpis dui, commodo vel pellentesque et, pretium eget lectus. Quisque viverra leo nulla, et ultricies sapien vulputate vitae. Vivamus eu laoreet arcu, sed accumsan est. Curabitur mattis consequat leo, nec elementum nibh scelerisque efficitur. Donec risus leo, congue sit amet laoreet in, luctus eu libero. Curabitur at iaculis mi.\r\n\r\nInteger pharetra commodo imperdiet. Donec condimentum orci nec euismod faucibus. Vivamus imperdiet mauris eu diam rhoncus gravida. Quisque iaculis neque sed metus elementum, quis pretium leo consectetur. Donec quis diam ut sapien porta fringilla non at felis. Etiam condimentum venenatis nisi, sit amet gravida risus porttitor eu. Mauris neque arcu, dignissim eget est id, tincidunt suscipit massa.\r\n\r\nCurabitur id nunc et libero fermentum suscipit. Nam quis purus vel elit ultrices cursus. Phasellus ac mi vulputate, semper dolor eu, aliquet tortor. Nullam semper purus a ultrices consequat. Phasellus rutrum magna eget erat bibendum, aliquet dignissim nisi maximus. Sed eget est luctus, aliquam ligula vel, varius leo. Cras a arcu scelerisque, finibus enim ac, placerat est. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vestibulum placerat fermentum enim, pharetra feugiat nisi egestas id. Sed vestibulum dolor at justo facilisis, ut cursus lacus pellentesque. Nullam mollis placerat dolor, eu pulvinar massa iaculis in. Vivamus eu sem ac mauris venenatis efficitur. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean vitae mattis massa, eget dapibus felis.\r\n\r\nPraesent vehicula pellentesque ipsum. Morbi ut faucibus enim. Ut nec vehicula erat. Quisque consectetur faucibus eros, eget luctus est congue ac. Nunc luctus bibendum tempor. Maecenas nunc nulla, bibendum vitae pharetra vitae, pulvinar vitae tortor. Sed quis augue lacus. Sed viverra tincidunt tellus, at rhoncus ipsum tincidunt in.\r\n\r\nMorbi ultrices finibus ligula, eget tincidunt arcu scelerisque sed. Etiam eget ornare odio. Morbi non eleifend lorem, vitae convallis lectus. Curabitur accumsan, lacus eu molestie pharetra, lectus tortor ornare dolor, vitae maximus est massa in ante. Donec sodales rutrum libero fermentum semper. Pellentesque accumsan arcu eu est iaculis, sed venenatis mauris auctor. Pellentesque vehicula dapibus mauris. Quisque sed leo vitae augue congue rutrum ac eget mauris. Sed vehicula lorem nec ex vehicula, vitae suscipit arcu tempus. Sed vitae dapibus mauris.\r\n\r\nAenean consequat urna augue. Praesent sit amet mollis nibh, a sollicitudin quam. Proin eros ligula, molestie ac faucibus vel, sollicitudin sed leo. Cras mollis nisi at cursus interdum. Vivamus feugiat metus elit, non luctus sem tincidunt eu. Aenean ac ligula a nulla scelerisque dapibus ut vitae dui. Nullam faucibus tempor urna, at consequat turpis malesuada eget. Proin lectus erat, fermentum sed auctor tincidunt, laoreet id risus. Cras rhoncus ullamcorper tellus vitae lobortis. Aliquam tristique egestas velit, sed auctor metus scelerisque quis. Cras fermentum ut sem non congue. Aenean porta ante nec aliquet sodales.\r\n\r\nDonec non nibh euismod, eleifend sem at, ultricies metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Morbi lorem felis, varius at facilisis eget, aliquam a velit. Vestibulum imperdiet nisi et fringilla malesuada. Aenean ac eros enim. Ut metus nisi, porta eu magna at, porttitor finibus sem. Donec eget pretium lorem. Mauris aliquam metus leo, ut sodales orci pharetra in. Fusce egestas efficitur erat, et scelerisque mauris accumsan quis. Fusce mattis mi neque, euismod dictum justo consequat vel. Nullam quis porttitor ante. Pellentesque aliquet vehicula posuere. Vestibulum non ligula vitae mauris scelerisque fringilla.\r\n\r\nDonec nec mi hendrerit, porta enim id, facilisis massa. Nulla pellentesque quam id augue varius pharetra. Maecenas rhoncus tempor ipsum in tristique. Aliquam in lectus eget turpis fringilla cursus. Proin ac magna a erat blandit placerat. Donec feugiat erat sit amet ullamcorper porttitor. Donec id dictum ex, sit amet luctus nisl. Pellentesque scelerisque auctor massa.\r\n\r\nAenean faucibus elit eu finibus gravida. Nunc venenatis felis a sodales volutpat. Vestibulum non aliquet urna. Pellentesque ullamcorper scelerisque nulla at varius. Proin vel enim eget elit dictum sagittis at sed turpis. Integer sollicitudin, ex dictum auctor finibus, nulla neque luctus arcu, in vestibulum nunc magna et est. Etiam luctus fringilla erat, eu condimentum orci molestie sit amet. Integer et vulputate tellus, vel tempus erat. Nunc id ipsum neque. Ut sit amet lacinia augue, a ultricies quam. Ut quis sollicitudin mauris. Ut pulvinar diam vel mi mollis elementum. Pellentesque consequat erat eu orci commodo tincidunt. Curabitur sed lacus a ex cursus dictum id in dolor. Ut ex sapien, pharetra sit amet massa ut, scelerisque malesuada ante. Sed dapibus venenatis ullamcorper.\r\n\r\nNullam eleifend odio nec efficitur blandit. Aliquam diam est, accumsan vel tincidunt ullamcorper, egestas at nisl. Proin at tortor nec nunc rhoncus suscipit vel ut felis. Sed sed lacus eu risus ultricies scelerisque id interdum magna. Duis interdum ullamcorper lorem eu venenatis. Nunc iaculis vehicula augue sit amet pharetra. Nam mattis nulla commodo, rhoncus tellus eget, pellentesque sem. Proin vitae urna ac nisi hendrerit ullamcorper in vitae sem. Sed vehicula elit lectus, quis vestibulum mi ullamcorper luctus. Maecenas consectetur in tellus ac rhoncus. Vivamus vitae sapien nec erat iaculis rhoncus eu varius justo. Praesent dictum eros nec odio rutrum, in finibus magna hendrerit. Sed mattis in quam id tincidunt. Etiam augue libero, mollis sit amet justo sed, cursus efficitur massa. Proin turpis ante, tincidunt a justo at, dictum convallis nulla. Vestibulum scelerisque sed diam ut bibendum.\r\n\r\nNam ultricies consectetur quam eu fringilla. Nullam porttitor, massa vitae pretium faucibus, velit neque facilisis tortor, vel porta enim sem vel tellus. Pellentesque a malesuada lorem. Fusce laoreet ante quis efficitur vehicula. Fusce iaculis ipsum ipsum, et dapibus ipsum facilisis a. Nam urna quam, faucibus at maximus eu, sagittis eu neque. Sed ornare volutpat ligula, vitae mollis tellus fringilla id. Nullam placerat ultricies ipsum, eget volutpat diam vestibulum vitae. Integer fermentum dui lacinia neque euismod commodo. Phasellus faucibus porttitor sem, eget elementum ipsum commodo vel. Suspendisse viverra porta dictum. Nulla commodo lobortis ipsum, et mattis metus egestas et.\r\n\r\nPhasellus eu aliquam dui, vitae imperdiet sem. Morbi luctus nec massa non congue. Nulla facilisi. Integer eu neque imperdiet, rutrum erat nec, interdum quam. Quisque pretium dapibus erat, non egestas eros porta bibendum. Maecenas nibh mi, convallis a viverra at, tincidunt at dui. Sed dictum, nisi et efficitur lobortis, ipsum diam consequat lectus, nec aliquet est est id lorem.', '', 0, '2022-09-20 16:03:30', 1, '2022-09-20 16:03:30'),
(21, '5MmxTELjhF', '6DXXS78zVT', 'Really really really long title', 'This was the tester', '', 0, '2022-09-19 16:08:16', 1, '2022-09-20 16:08:16'),
(23, 'tZbC5xMyC3', '6DXXS78zVT', 'tester to see if the error is still there', 'why does this keep breaking?!', '', 0, '2022-09-20 16:13:30', 1, '2022-09-20 16:13:30'),
(31, 'fCSTShsRQd', '6DXXS78zVT', 'tester', 'tesrter page\r\n', '', 0, '2022-07-13 16:27:21', 1, '2022-09-20 16:27:21'),
(32, 'YGEbupsQDw', '6DXXS78zVT', 'tester', 'tesrter page\r\n', '', 0, '2022-08-15 16:27:26', 1, '2022-09-20 16:27:26'),
(33, 'bfgCth8yKM', '6DXXS78zVT', 'entry stuff', 'idk what to type', '', 0, '2022-06-16 16:34:00', 1, '2022-09-20 16:34:00'),
(34, '4fFXURGgAj', '6DXXS78zVT', 'what happened?', 'Idk know', '', 0, '2022-09-20 16:34:34', 1, '2022-09-20 16:34:34'),
(35, 'aXLmArGYVT', '6DXXS78zVT', 'one more time', 'gonna celebrate', '', 0, '2022-08-19 16:35:52', 1, '2022-09-20 16:35:52'),
(36, 'JDFutQ6upb', '6DXXS78zVT', 'one more time', 'gonna celebrate', '', 0, '2022-07-21 16:36:30', 1, '2022-09-20 16:36:30'),
(37, 'do9ty5UjKr', '6DXXS78zVT', 'text', 'some stuff\r\n', '', 0, '2022-09-21 11:06:02', 1, '2022-09-21 11:06:02'),
(38, 'UV1SknQmJW', '6DXXS78zVT', 'text', 'some stuff\r\n', '', 0, '2022-05-17 11:06:40', 1, '2022-09-21 11:06:40'),
(39, 'Ek3Ei5y5kf', '6DXXS78zVT', 'text', 'title', '', 0, '2022-04-13 11:10:46', 1, '2022-09-21 11:10:46'),
(40, '9zyFi495R7', '6DXXS78zVT', 'something', 'something big', '', 0, '2022-08-10 11:32:25', 1, '2022-09-21 11:32:25'),
(41, 'RGRWLdzwSe', '2ksx1LkfZz', 'something', 'Something bad', NULL, 0, '2022-09-21 14:55:36', 1, '2022-09-21 14:55:36'),
(42, 'pbRh9DAYya', '2ksx1LkfZz', 'something', 'Don\'t look at the code plz', NULL, 0, '2022-09-21 18:47:14', 1, '2022-09-21 18:47:14'),
(43, 'MXrKBwer8C', '6DXXS78zVT', 'This is a test to see if the function works or not', 'Whoever broke this code better grab their ankles cause papa Michael\'s coming', NULL, 0, '2022-09-22 11:52:00', 1, '2022-09-22 11:52:00'),
(44, 'iE9yNFoVGm', 'UEihk4r4yw', 'Test 1', 'This is just a test. #1.\r\nI like pizza.', NULL, NULL, '2022-09-23 16:55:49', 1, '2022-09-23 16:55:49'),
(45, 'U256Ve6MNj', 'UEihk4r4yw', 'Test #2', 'This is another test. I want to go to New York', NULL, NULL, '2022-09-23 16:57:32', 1, '2022-09-23 16:57:32'),
(46, 'osDAPbHrNg', 'UEihk4r4yw', 'Test #3', 'This is a test to see the entry_uid. For some reason it was not correctly getting added to the entry_images table.', NULL, NULL, '2022-09-23 17:37:30', 1, '2022-09-23 17:37:30'),
(47, 'GsiCpUdBzb', 'UEihk4r4yw', 'Test #4', 'I found the bug. It was in the bindParam for the entry_uid. It was set to PDO::PARAM_INT. Changing it to PDO::PARAM_STR fixed it.', NULL, NULL, '2022-09-23 17:39:22', 1, '2022-09-23 17:39:22'),
(48, 'oDWsgwaHP9', 'UEihk4r4yw', 'Test #5', 'The last test uploaded the image correctly. But when viewing, the image size was far too large. For this test, I\'m going to upload multiple images to see if the size problem only arises when a single image is uploaded.', NULL, NULL, '2022-09-23 17:42:06', 1, '2022-09-23 17:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `entry_images`
--

CREATE TABLE `entry_images` (
  `id` int(11) NOT NULL,
  `entry_uid` varchar(10) NOT NULL,
  `path` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entry_images`
--

INSERT INTO `entry_images` (`id`, `entry_uid`, `path`, `is_active`, `date_created`) VALUES
(1, '0', './public/images/uploaded/1b/b0/42a05f0d74f8dd4a6178be8f828e.jpeg', 1, '2022-09-23 16:57:32'),
(2, '0', './public/images/uploaded/06/95/9e36fd466c27dade08ea7b0f39cd.png', 1, '2022-09-23 16:57:32'),
(3, '0', './public/images/uploaded/06/95/9e36fd466c27dade08ea7b0f39cd.png', 1, '2022-09-23 17:37:30'),
(4, 'GsiCpUdBzb', './public/images/uploaded/06/95/9e36fd466c27dade08ea7b0f39cd.png', 1, '2022-09-23 17:39:22'),
(5, 'oDWsgwaHP9', './public/images/uploaded/06/95/9e36fd466c27dade08ea7b0f39cd.png', 1, '2022-09-23 17:42:06'),
(6, 'oDWsgwaHP9', './public/images/uploaded/1b/b0/42a05f0d74f8dd4a6178be8f828e.jpeg', 1, '2022-09-23 17:42:06'),
(7, 'oDWsgwaHP9', './public/images/uploaded/16/96/06795eae39d27663a51b787ae4f4.png', 1, '2022-09-23 17:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `profile_images`
--

CREATE TABLE `profile_images` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tag_map`
--

CREATE TABLE `tag_map` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `u_id` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `last_active` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `u_id`, `username`, `email`, `password`, `last_active`, `is_active`, `date_created`) VALUES
(27, 'ESdxTm45gi', 'pumpkin', 'pumpkin@spice.com', '$2y$10$apmEssvVWxkd/gNRqSkwsOV/GIkQ8UL5XL06KOcPyZQn/O6xN/O3q', '2022-09-15 15:48:03', 1, '2022-09-15 15:46:34'),
(29, '6DXXS78zVT', 'sup', 'sup@sups.com', '$2y$10$bb1.L0EQyCYFQQ2jDQdSxu0SqSa4wF4Ouse/MCc6KitKfrzXbNoRu', '2022-09-23 11:47:26', 1, '2022-09-15 19:34:44'),
(39, 'd8CfxPD7ys', 'gem', 'gem@gem.com', '$2y$10$KTPJrrmemyhBoyRk4pWpK.4w5/5JHfhbjaDoyBX9XH2dpqh0RolCW', '2022-09-21 23:24:06', 1, '2022-09-21 18:55:15'),
(40, 'T1iyvpJxXN', 'mike.ko96@gmail.com', 'mike.ko96@gmail.com', NULL, '2022-09-22 12:14:15', 1, '2022-09-21 18:56:31'),
(41, 'UEihk4r4yw', 'johnniewalk6@gmail.com', 'johnniewalk6@gmail.com', NULL, '2022-09-23 19:20:30', 1, '2022-09-23 16:48:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_id` (`u_id`);

--
-- Indexes for table `entry_images`
--
ALTER TABLE `entry_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_images`
--
ALTER TABLE `profile_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_id` (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `entry_images`
--
ALTER TABLE `entry_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `profile_images`
--
ALTER TABLE `profile_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
