-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2014 at 10:31 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `taigang`
--
CREATE DATABASE IF NOT EXISTS `taigang` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `taigang`;

-- --------------------------------------------------------

--
-- Table structure for table `tg_challenge`
--

CREATE TABLE IF NOT EXISTS `tg_challenge` (
  `challenge_id` int(8) NOT NULL AUTO_INCREMENT COMMENT '挑战的ID ',
  `video_id` int(8) NOT NULL COMMENT '挑战人发的视频ID',
  `be_video_id` int(8) NOT NULL COMMENT '被挑战的视频ID',
  `challenge_time` datetime NOT NULL,
  PRIMARY KEY (`challenge_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tg_challenge`
--

INSERT INTO `tg_challenge` (`challenge_id`, `video_id`, `be_video_id`, `challenge_time`) VALUES
(1, 2, 1, '2014-10-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tg_click`
--

CREATE TABLE IF NOT EXISTS `tg_click` (
  `click_id` int(8) NOT NULL AUTO_INCREMENT,
  `video_id` int(8) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '点赞人的ID',
  `click_time` datetime NOT NULL,
  PRIMARY KEY (`click_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tg_click`
--

INSERT INTO `tg_click` (`click_id`, `video_id`, `user_id`, `click_time`) VALUES
(1, 2, 1, '2014-10-30 00:00:00'),
(2, 1, 3, '2014-10-30 07:14:49'),
(3, 1, 3, '2014-10-30 07:15:14'),
(4, 1, 3, '2014-10-30 07:16:00'),
(5, 1, 3, '2014-10-30 07:16:40'),
(6, 1, 3, '2014-10-30 07:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `tg_friend`
--

CREATE TABLE IF NOT EXISTS `tg_friend` (
  `friend_id` int(8) NOT NULL AUTO_INCREMENT COMMENT '每条记录的id',
  `follow_id` int(8) NOT NULL COMMENT '被关注人id',
  `follower_id` int(8) NOT NULL COMMENT '粉丝id',
  `status` int(1) NOT NULL,
  PRIMARY KEY (`friend_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tg_friend`
--

INSERT INTO `tg_friend` (`friend_id`, `follow_id`, `follower_id`, `status`) VALUES
(1, 1, 2, 0),
(2, 1, 3, 1),
(3, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tg_tag`
--

CREATE TABLE IF NOT EXISTS `tg_tag` (
  `tag_record` int(8) NOT NULL AUTO_INCREMENT,
  `tag_id` int(8) NOT NULL,
  `video_id` int(8) NOT NULL,
  `tag_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`tag_record`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tg_tag`
--

INSERT INTO `tg_tag` (`tag_record`, `tag_id`, `video_id`, `tag_name`) VALUES
(4, 1, 1, 'kobe');

-- --------------------------------------------------------

--
-- Table structure for table `tg_theme`
--

CREATE TABLE IF NOT EXISTS `tg_theme` (
  `theme_id` int(8) NOT NULL AUTO_INCREMENT COMMENT '主题的ID',
  `theme_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '主题的名字',
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tg_theme`
--

INSERT INTO `tg_theme` (`theme_id`, `theme_name`) VALUES
(1, 'sports');

-- --------------------------------------------------------

--
-- Table structure for table `tg_user`
--

CREATE TABLE IF NOT EXISTS `tg_user` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(30) COLLATE utf8_bin NOT NULL,
  `nickname` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `gender` int(11) NOT NULL,
  `reg_time` date NOT NULL,
  `portrait` mediumblob NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`nickname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tg_user`
--

INSERT INTO `tg_user` (`id`, `username`, `password`, `nickname`, `email`, `gender`, `reg_time`, `portrait`) VALUES
(1, 'root', 'root', 'root', 'root@root.com', 1, '2014-10-27', ''),
(2, 'js', 'js', 'ale', 'js@js.com', 1, '2014-10-27', ''),
(3, 'long', 'long', 'long', 'long@long.com', 1, '0000-00-00', ''),
(5, 'long2', 'long2', 'long2', 'long2@long.com', 1, '0000-00-00', 0x7b706f7274726169747d);

-- --------------------------------------------------------

--
-- Table structure for table `tg_video`
--

CREATE TABLE IF NOT EXISTS `tg_video` (
  `video_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `video_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `video_intro` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `video_path` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `update_time` datetime NOT NULL,
  `video_theme` int(8) NOT NULL COMMENT '主题id',
  `video_cover` text NOT NULL,
  `status` int(1) NOT NULL COMMENT '1代表是你自己发的，',
  `video_type` int(1) NOT NULL COMMENT '1代表视频2代表音频',
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tg_video`
--

INSERT INTO `tg_video` (`video_id`, `user_id`, `video_name`, `video_intro`, `video_path`, `update_time`, `video_theme`, `video_cover`, `status`, `video_type`) VALUES
(1, 3, 'long test1', '', '', '2014-10-30 00:00:00', 1, '', 1, 1),
(2, 3, 'long test1', '', '', '2014-10-30 00:00:00', 1, '', 1, 1),
(3, 3, 'long test1', '', '', '2014-10-30 00:00:00', 1, '', 1, 1),
(4, 3, 'long test1', '', '', '2014-10-30 00:00:00', 1, '', 1, 1),
(5, 3, 'long test1', '', 'wait long 3', '2014-10-30 00:00:00', 1, '{video_cover}', 1, 1),
(6, 3, 'long test1', '', 'wait long 3', '2014-10-30 00:00:00', 1, 'coverlong3', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
