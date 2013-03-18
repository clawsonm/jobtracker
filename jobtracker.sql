-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2013 at 04:08 AM
-- Server version: 5.5.30-log
-- PHP Version: 5.4.12--pl0-gentoo

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jobtracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE IF NOT EXISTS `building` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `abbreviation` varchar(5) NOT NULL,
  `removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`id`, `name`, `abbreviation`, `removed`) VALUES
(1, 'Building 1', 'B1', 0),
(2, 'Building 2', 'B2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uin` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `room` varchar(5) NOT NULL,
  `building_fkey` tinyint(3) unsigned NOT NULL,
  `email` varchar(40) NOT NULL,
  `homephone` varchar(11) NOT NULL,
  `workphone` varchar(11) NOT NULL,
  `cellphone` varchar(11) NOT NULL,
  `chair` tinyint(1) NOT NULL DEFAULT '0',
  `department_fkey` tinyint(3) unsigned NOT NULL,
  `consultant` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `team_fkey` int(10) unsigned DEFAULT NULL,
  `admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `notify` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `removed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `uin`, `username`, `password`, `lastname`, `firstname`, `room`, `building_fkey`, `email`, `homephone`, `workphone`, `cellphone`, `chair`, `department_fkey`, `consultant`, `team_fkey`, `admin`, `notify`, `removed`) VALUES
(1, 0, 'sysadmin', 'bf7e0d86b66cae5506ec4e138623ac6b6507b04c', 'Underdog', 'Me', '444', 1, 'bob@bob.com', '6605551234', '5555', '6605556789', 0, 5, 1, 2, 0, 0, 0),
(2, 0, 'admin', '3978d009748ef54ad6ef7bf851bd55491b1fe6bb', 'Boss', 'My', '555', 1, 'my_boss@bob.com', '', '5555', '8015551234', 1, 5, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `consultant`
--

CREATE TABLE IF NOT EXISTS `consultant` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `group_fkey` tinyint(10) unsigned NOT NULL,
  `admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `radio` tinyint(1) NOT NULL DEFAULT '1',
  `notify` tinyint(1) NOT NULL DEFAULT '0',
  `removed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `consultant`
--

INSERT INTO `consultant` (`id`, `group_fkey`, `admin`, `radio`, `notify`, `removed`) VALUES
(1, 2, 0, 1, 0, 0),
(2, 1, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `abbreviation` varchar(20) NOT NULL,
  `removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `abbreviation`, `removed`) VALUES
(1, 'College Services', 'CS', 0),
(5, 'College Computer Services', 'CCS', 0);

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE IF NOT EXISTS `entry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `task_fkey` int(10) unsigned NOT NULL,
  `consultant_fkey` tinyint(3) unsigned NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `entered` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `timespent` time NOT NULL,
  `description` text NOT NULL,
  `removed` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `entry`
--

INSERT INTO `entry` (`id`, `task_fkey`, `consultant_fkey`, `updated`, `entered`, `timespent`, `description`, `removed`) VALUES
(1, 2, 1, '2009-05-22 18:22:58', '2009-05-22 18:22:58', '00:05:00', 'printed out and on Johns wall', 0),
(2, 1, 1, '2009-07-22 01:15:00', '2009-05-22 18:24:57', '00:05:00', 'I updated the task description.  they should be on johns wall. :) test chars test chars test chars test chars test chars', 0),
(5, 2, 1, '2009-06-17 01:25:26', '2009-06-17 01:25:26', '00:01:00', 'I should complete tasks.', 0),
(7, 1, 1, '2009-08-06 17:36:13', '2009-07-24 00:06:15', '00:05:00', 'asdf', 1),
(8, 1, 1, '2009-08-06 17:35:32', '2009-07-24 00:11:03', '00:05:00', 'asdf2', 1),
(9, 3, 1, '2009-08-06 20:43:17', '2009-08-06 20:43:17', '00:25:00', 'installed AMP stack, set needed ini settings.', 0),
(10, 3, 1, '2009-08-06 20:47:11', '2009-08-06 20:46:34', '00:25:00', 'Tested basic AMP stack functionality.', 0),
(11, 1, 1, '2012-03-18 02:00:31', '2012-03-18 01:44:11', '00:00:23', 'asdf asdf ', 0),
(12, 11, 1, '2012-03-18 03:18:17', '2012-03-18 03:18:17', '00:00:02', 'Fixed. I had the header location set for creating a new task, but not for updating a task five lines further down the page.', 0),
(13, 8, 1, '2012-03-18 03:28:26', '2012-03-18 03:28:26', '00:00:05', 'hardcoded defaults into taskdetail.php.', 0),
(14, 13, 1, '2012-03-18 03:32:43', '2012-03-18 03:32:43', '00:00:05', 'modified taskdetail.php, so that when creating a new task it accepts a get parameter: ''parent'' and sets the new task''s parent_fkey.', 0),
(15, 12, 1, '2012-03-18 04:09:36', '2012-03-18 04:09:36', '00:00:15', 'add hide field to status table and status list, and edit status, and post status. also set completed and on hold to hide=true.', 0),
(16, 3, 1, '2012-06-27 04:14:10', '2012-06-27 03:59:42', '00:00:01', 'Apple servers are all out the door soon, so no need for this.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE IF NOT EXISTS `priority` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `icon` varchar(40) DEFAULT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `name`, `icon`, `weight`, `removed`) VALUES
(1, 'Low', NULL, 25, 0),
(2, 'Medium', NULL, 50, 0),
(3, 'High', 'files/red-exclamation-mark-icon.png', 75, 0),
(4, 'Urgent', 'files/red-exclamation-mark-icon.png', 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `icon` varchar(40) DEFAULT NULL,
  `weight` int(10) unsigned NOT NULL DEFAULT '0',
  `hidden` tinyint(1) NOT NULL DEFAULT '0',
  `removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `icon`, `weight`, `hidden`, `removed`) VALUES
(1, 'Current', '', 100, 0, 0),
(2, 'Completed', NULL, 80, 1, 0),
(3, 'Active', NULL, 40, 0, 0),
(4, 'Input Needed', NULL, 20, 0, 0),
(6, 'On Hold', 'files/clock.png', 60, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_fkey` int(10) unsigned NOT NULL,
  `secondary_client` int(10) unsigned DEFAULT NULL,
  `team_fkey` tinyint(3) unsigned NOT NULL,
  `enteredby` tinyint(3) unsigned NOT NULL,
  `assignedto` tinyint(3) unsigned DEFAULT NULL,
  `status_fkey` tinyint(3) unsigned NOT NULL,
  `priority_fkey` tinyint(3) unsigned NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `parent_fkey` int(10) unsigned DEFAULT NULL,
  `removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `client_fkey`, `secondary_client`, `team_fkey`, `enteredby`, `assignedto`, `status_fkey`, `priority_fkey`, `title`, `description`, `parent_fkey`, `removed`) VALUES
(1, 2, NULL, 2, 1, 0, 1, 3, 'emergency contact info', 'Get emergency contact info for John as required by BYU, and maybe the law.  Put it on Johns wall.', NULL, 0),
(2, 2, NULL, 2, 1, 1, 1, 3, 'michaels info', 'Michaels emergency contact info', 1, 0),
(3, 2, NULL, 2, 1, 1, 1, 1, 'integrate AMP on mac servers', 'integrate Apache, MySQL, PHP onto Lion servers', NULL, 0),
(4, 2, NULL, 2, 1, 1, 1, 3, 'fix redhat reboot', 'fix redhat reboot problem.  probably jealousy issues with all the hot macs around.', NULL, 0),
(5, 2, NULL, 1, 1, 2, 1, 2, 'new server', 'buy a new mac server for lab', NULL, 0),
(7, 1, NULL, 2, 1, 1, 1, 1, 'move checkusername to functions', 'move checkusername.php to functions', NULL, 0),
(6, 2, NULL, 2, 1, NULL, 1, 2, 'order Silly putty', 'to entertain kids at office. for grown up kids?', NULL, 0),
(8, 1, NULL, 2, 1, 1, 1, 1, 'default values', 'make it possible to have default values for status: current, priority: medium', NULL, 0),
(9, 1, NULL, 2, 1, 1, 1, 3, 'login names', 'make logins names case insensitive', NULL, 0),
(10, 1, NULL, 2, 1, 1, 1, 3, 'WHERE''s in functions', 'remove all the where clauses in function arguments.  instead pass the needed info and let the function decide.\r\nList:\r\nincludes/boxes/joblist.php', NULL, 0),
(11, 1, NULL, 2, 1, 1, 2, 3, 'fix update button', 'make the update button go back to the task list.', NULL, 0),
(12, 1, NULL, 2, 1, 1, 1, 3, 'completed tasks', 'add the functionality for viewing completed tasks.', NULL, 0),
(13, 1, NULL, 2, 1, 1, 1, 2, 'child tasks', 'add functionality to add/remove child tasks', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(40) NOT NULL,
  `name` varchar(10) NOT NULL,
  `removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `fullname`, `name`, `removed`) VALUES
(1, 'College Services IT Administrator', 'admin', 0),
(2, 'College Services Administration', 'sysadmin', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
