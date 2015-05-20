-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2015 at 10:47 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iosyf`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
`UID` int(10) unsigned NOT NULL,
  `username` tinytext NOT NULL,
  `level` int(10) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`UID`, `username`, `level`) VALUES
(1, 'Hideyoshi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `ID-VN` int(10) unsigned NOT NULL,
  `ID-users` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `contents` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
`UID` int(10) unsigned NOT NULL,
  `dateposted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IDusers` int(10) unsigned NOT NULL,
  `topic` tinytext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`UID`, `dateposted`, `IDusers`, `topic`) VALUES
(1, '2015-05-16 00:00:00', 17, 'THis is a test FAQ no 1'),
(2, '2015-05-16 00:00:00', 17, 'This is no2'),
(3, '0000-00-00 00:00:00', 15, 'ANIME'),
(4, '2015-05-20 17:59:30', 15, 'NEW TOPIC'),
(5, '2015-05-20 18:03:03', 15, 'NEW NEW TOPIC'),
(6, '2015-05-20 19:34:14', 15, 'NEW NEW NEW TOPIC');

-- --------------------------------------------------------

--
-- Table structure for table `faqcomments`
--

CREATE TABLE IF NOT EXISTS `faqcomments` (
`UID` int(10) unsigned NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faqcomments`
--

INSERT INTO `faqcomments` (`UID`, `comment`) VALUES
(1, 'A comment'),
(2, 'A comment2'),
(3, 'NEW COMMENT'),
(4, 'MEH'),
(5, 'MEH'),
(6, 'MEH'),
(7, 'MEH'),
(8, 'MEH'),
(9, 'MEH'),
(10, 'dasdsadafaskjfaskvklafasvasbkfnasl fbasl fksa fas fsfkl bask fladd fkasf;asd;dfh ;adbf ladskf aslfb kasfd'),
(11, 'MEH'),
(12, 'A comment'),
(13, 'MEH'),
(14, 'MEH'),
(15, 'MEH'),
(16, 'MEH'),
(17, 'MEH'),
(18, 'MEH'),
(19, 'MEH'),
(20, 'MEH'),
(21, 'MEH');

-- --------------------------------------------------------

--
-- Table structure for table `faqxcomments`
--

CREATE TABLE IF NOT EXISTS `faqxcomments` (
  `IDuser` int(10) unsigned NOT NULL,
  `IDFaQ` int(10) unsigned NOT NULL,
  `IDcomment` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faqxcomments`
--

INSERT INTO `faqxcomments` (`IDuser`, `IDFaQ`, `IDcomment`) VALUES
(18, 1, 1),
(15, 1, 2),
(15, 1, 2),
(18, 2, 2),
(18, 2, 2),
(16, 3, 2),
(16, 3, 2),
(15, 5, 8),
(15, 5, 9),
(15, 5, 10),
(15, 5, 11),
(15, 5, 12),
(15, 5, 13),
(15, 5, 14),
(15, 5, 15),
(15, 5, 16),
(15, 5, 17),
(15, 5, 18),
(15, 5, 19),
(15, 5, 20),
(15, 5, 21),
(15, 5, 4),
(15, 6, 1),
(15, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `history_of_vns_played`
--

CREATE TABLE IF NOT EXISTS `history_of_vns_played` (
  `ID-user` int(10) unsigned NOT NULL,
  `ID-VN` int(10) unsigned NOT NULL,
  `ID-marked` int(10) unsigned NOT NULL,
  `raiting_given` int(10) unsigned DEFAULT NULL,
  `paid` int(10) unsigned DEFAULT NULL,
  `date-marked` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
`UID` int(10) unsigned NOT NULL,
  `name` tinytext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`UID`, `name`) VALUES
(1, 'english');

-- --------------------------------------------------------

--
-- Table structure for table `makers_of_the_vn`
--

CREATE TABLE IF NOT EXISTS `makers_of_the_vn` (
  `IDusers` int(11) unsigned NOT NULL,
  `IDVN` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `makers_of_the_vn`
--

INSERT INTO `makers_of_the_vn` (`IDusers`, `IDVN`) VALUES
(15, 1),
(17, 1),
(16, 16),
(17, 16),
(15, 18);

-- --------------------------------------------------------

--
-- Table structure for table `marked_as`
--

CREATE TABLE IF NOT EXISTS `marked_as` (
`UID` int(10) unsigned NOT NULL,
  `type_of_marking` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`UID` int(10) unsigned NOT NULL,
  `name` tinytext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`UID`, `name`) VALUES
(3, 'comedy'),
(4, 'action'),
(5, 'slice of life');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`UID` int(10) unsigned NOT NULL,
  `FN` text NOT NULL,
  `LN` text NOT NULL,
  `username` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `gender` tinytext,
  `picture` text
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `FN`, `LN`, `username`, `password`, `email`, `gender`, `picture`) VALUES
(15, 'Iosyf', 'Saleh', 'Hideyoshi', '$2y$10$lRcZTPcSag49B1QXTFsWQOz8yuYCHCFcfjC5FtR9mkleWWw2eUJFq', 'iosyf12345@abv.bg', NULL, NULL),
(16, 'qazw', 'qazw', 'qweqweqweqwe', '$2y$10$dtxhru.ZdOVrDdC9.VKLg.dhCgffqUZz9JMKAmeGE4dtz5DpOmlXe', 'iosyf123456@abv.bg', NULL, NULL),
(17, 'Iosyf', 'Iosyf', 'Iosyf', '$2y$10$Rm6F0g.1tdTSCMpWToAZOuyXVcZoFplfg/3pjx7uQkXdAnKJXqJBS', 'iosyf1234567@abv.bg', NULL, NULL),
(18, 'Vasil', 'Kolev', 'mrvbgf', '$2y$10$vQBlsNdBkcUlNx0FQfBjS.nay1SWHSIqyYMwHfOC6WnWYiepc/Ci2', 'vasil.v2@mail.bg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vn`
--

CREATE TABLE IF NOT EXISTS `vn` (
`UID` int(10) unsigned NOT NULL,
  `name` tinytext NOT NULL,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `length` tinytext NOT NULL,
  `description` text NOT NULL,
  `IDlanguage` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vn`
--

INSERT INTO `vn` (`UID`, `name`, `date_last_modified`, `length`, `description`, `IDlanguage`) VALUES
(1, 'testing', '2015-05-08 15:16:26', 'short', 'AN AWESOME VN. You should totally play it ;)', 0),
(2, 'testing2', '2015-04-21 00:21:53', 'long', 'a long vn sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssdasd asdfa sdfsssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssdasd asdfa sdfsssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssdasd asdfa sdfsssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssdasd asdfa sdfsssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssdasd asdfa sdf', 0),
(3, 'testing3', '2015-04-20 14:32:33', 'very long', 'a very long vn i think', 0),
(4, 'q', '2015-04-29 17:57:28', '', 'LAZY', 0),
(5, 'qq', '2015-04-29 17:57:34', '', 'LAZY', 0),
(6, 'qqq', '2015-04-29 17:57:38', '', 'LAZY', 0),
(7, 'qqqq', '2015-04-29 17:57:41', '', 'LAZY', 0),
(8, 'qqqqq', '2015-04-29 17:57:44', '', 'LAZY', 0),
(9, 'qqqqqq', '2015-04-29 17:57:50', '', 'LAZY', 0),
(10, 'qqqqqqq', '2015-04-29 17:58:11', '', 'LAZY', 0),
(11, 'qqqqqqqq', '2015-04-29 17:58:15', '', 'LAZY', 0),
(12, 'qqqqqqqqq', '2015-04-29 17:58:18', '', 'LAZY', 0),
(13, 'qqqqqqqqqq', '2015-04-29 17:58:21', '', 'LAZY', 0),
(14, 'qqqqqqqq132qq', '2015-04-29 17:58:41', '', 'LAZY', 0),
(15, 'qqqqqqqq132qq', '2015-05-17 18:15:40', '', 'LAZY', 0),
(16, 'IOSYF', '2015-05-20 14:57:08', '', '', 0),
(17, 'IOSYF', '2015-05-20 15:06:03', '', '', 0),
(18, 'IOSYF', '2015-05-20 20:19:56', '', 'dsadsadsa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vnxlanguages`
--

CREATE TABLE IF NOT EXISTS `vnxlanguages` (
  `IDVN` int(10) unsigned NOT NULL,
  `IDlanguages` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vnxlanguages`
--

INSERT INTO `vnxlanguages` (`IDVN`, `IDlanguages`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vnxtags`
--

CREATE TABLE IF NOT EXISTS `vnxtags` (
  `IDVN` int(10) unsigned NOT NULL,
  `IDtags` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vnxtags`
--

INSERT INTO `vnxtags` (`IDVN`, `IDtags`) VALUES
(3, 4),
(1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`UID`), ADD UNIQUE KEY `UID` (`UID`), ADD KEY `id-user` (`level`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD KEY `ID-VN` (`ID-VN`,`ID-users`), ADD KEY `ID-users` (`ID-users`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
 ADD PRIMARY KEY (`UID`), ADD UNIQUE KEY `UID` (`UID`), ADD UNIQUE KEY `UID_2` (`UID`), ADD KEY `ID-users` (`IDusers`);

--
-- Indexes for table `faqcomments`
--
ALTER TABLE `faqcomments`
 ADD PRIMARY KEY (`UID`);

--
-- Indexes for table `faqxcomments`
--
ALTER TABLE `faqxcomments`
 ADD KEY `ID-FaQ` (`IDFaQ`), ADD KEY `ID-user` (`IDuser`), ADD KEY `ID-comment` (`IDcomment`);

--
-- Indexes for table `history_of_vns_played`
--
ALTER TABLE `history_of_vns_played`
 ADD KEY `ID-user` (`ID-user`,`ID-VN`,`ID-marked`), ADD KEY `ID-marked` (`ID-marked`), ADD KEY `ID-VN` (`ID-VN`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
 ADD PRIMARY KEY (`UID`), ADD UNIQUE KEY `UID` (`UID`);

--
-- Indexes for table `makers_of_the_vn`
--
ALTER TABLE `makers_of_the_vn`
 ADD PRIMARY KEY (`IDusers`,`IDVN`), ADD KEY `ID-users` (`IDusers`,`IDVN`), ADD KEY `IDVN` (`IDVN`);

--
-- Indexes for table `marked_as`
--
ALTER TABLE `marked_as`
 ADD PRIMARY KEY (`UID`), ADD UNIQUE KEY `UID` (`UID`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`UID`), ADD UNIQUE KEY `UID` (`UID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`UID`);

--
-- Indexes for table `vn`
--
ALTER TABLE `vn`
 ADD PRIMARY KEY (`UID`), ADD UNIQUE KEY `UID` (`UID`), ADD KEY `IDlanguage` (`IDlanguage`);

--
-- Indexes for table `vnxlanguages`
--
ALTER TABLE `vnxlanguages`
 ADD KEY `IDVN` (`IDVN`,`IDlanguages`), ADD KEY `IDlanguages` (`IDlanguages`);

--
-- Indexes for table `vnxtags`
--
ALTER TABLE `vnxtags`
 ADD KEY `ID-VN_2` (`IDVN`), ADD KEY `ID-tags` (`IDtags`), ADD KEY `IDVN` (`IDVN`), ADD KEY `IDtags` (`IDtags`), ADD KEY `IDVN_2` (`IDVN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `faqcomments`
--
ALTER TABLE `faqcomments`
MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `marked_as`
--
ALTER TABLE `marked_as`
MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `vn`
--
ALTER TABLE `vn`
MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`ID-users`) REFERENCES `users` (`UID`),
ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`ID-VN`) REFERENCES `vn` (`UID`);

--
-- Constraints for table `faqxcomments`
--
ALTER TABLE `faqxcomments`
ADD CONSTRAINT `faqxcomments_ibfk_1` FOREIGN KEY (`IDuser`) REFERENCES `users` (`UID`),
ADD CONSTRAINT `faqxcomments_ibfk_2` FOREIGN KEY (`IDFaQ`) REFERENCES `faq` (`UID`),
ADD CONSTRAINT `faqxcomments_ibfk_3` FOREIGN KEY (`IDcomment`) REFERENCES `faqcomments` (`UID`);

--
-- Constraints for table `history_of_vns_played`
--
ALTER TABLE `history_of_vns_played`
ADD CONSTRAINT `history_of_vns_played_ibfk_1` FOREIGN KEY (`ID-user`) REFERENCES `users` (`UID`),
ADD CONSTRAINT `history_of_vns_played_ibfk_2` FOREIGN KEY (`ID-marked`) REFERENCES `marked_as` (`UID`),
ADD CONSTRAINT `history_of_vns_played_ibfk_3` FOREIGN KEY (`ID-VN`) REFERENCES `vn` (`UID`);

--
-- Constraints for table `makers_of_the_vn`
--
ALTER TABLE `makers_of_the_vn`
ADD CONSTRAINT `makers_of_the_vn_ibfk_1` FOREIGN KEY (`IDVN`) REFERENCES `vn` (`UID`),
ADD CONSTRAINT `makers_of_the_vn_ibfk_2` FOREIGN KEY (`IDusers`) REFERENCES `users` (`UID`);

--
-- Constraints for table `vnxlanguages`
--
ALTER TABLE `vnxlanguages`
ADD CONSTRAINT `vnxlanguages_ibfk_1` FOREIGN KEY (`IDVN`) REFERENCES `vn` (`UID`),
ADD CONSTRAINT `vnxlanguages_ibfk_2` FOREIGN KEY (`IDlanguages`) REFERENCES `languages` (`UID`);

--
-- Constraints for table `vnxtags`
--
ALTER TABLE `vnxtags`
ADD CONSTRAINT `vnxtags_ibfk_1` FOREIGN KEY (`IDtags`) REFERENCES `tags` (`UID`),
ADD CONSTRAINT `vnxtags_ibfk_2` FOREIGN KEY (`IDVN`) REFERENCES `vn` (`UID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
