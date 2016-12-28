-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2016 at 07:19 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unique`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) UNSIGNED NOT NULL,
  `company_id` varchar(256) NOT NULL,
  `candidate_id` varchar(256) NOT NULL,
  `status` enum('assigned','in_process','selected','failed') NOT NULL DEFAULT 'assigned',
  `category_id` int(10) UNSIGNED NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `company_id`, `candidate_id`, `status`, `category_id`, `created`, `modified`) VALUES
(2, '1', '2', 'assigned', 1, '2016-12-28 16:59:53', '2016-12-28 17:02:53'),
(3, '1', '3', 'assigned', 1, '2016-12-28 16:59:53', '2016-12-28 17:02:57'),
(4, '3', '2', 'assigned', 8, '2016-12-28 17:12:32', '2016-12-28 11:42:32'),
(5, '3', '3', 'assigned', 8, '2016-12-28 17:12:32', '2016-12-28 11:42:32'),
(6, '3', '4', 'assigned', 8, '2016-12-28 17:12:32', '2016-12-28 11:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) UNSIGNED NOT NULL,
  `fname` varchar(256) NOT NULL,
  `lname` varchar(256) NOT NULL,
  `email_id` varchar(256) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `resume_file` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `fname`, `lname`, `email_id`, `phone`, `category_id`, `comment`, `resume_file`, `created`, `modified`) VALUES
(2, 'test', 'user', 'test@gmail.com', '9950162420', 1, 'dfdfdfdfdf', '1482550960_Rohan Julka CV build 1_24-Sep-11_10-04-54.docx', '2016-12-24 04:53:25', '2016-12-24 10:12:40'),
(3, 'yogesh', 'Patel', 'yogesh@gmail.com', '9950162420', 1, 'ererer', '1482632168_Rohan Julka CV build 1_24-Sep-11_10-04-54.docx', '2016-12-24 13:06:42', '2016-12-27 13:21:23'),
(4, 'Rohantest', 'Julkatest', 'rohan@gmail.com', '1234567890', 17, 'testing', '1482900152_ganpatchauhanResume.doc', '2016-12-28 16:42:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL,
  `email_id` varchar(256) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `about` text NOT NULL,
  `technologies` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email_id`, `phone`, `category_id`, `about`, `technologies`, `created`, `modified`) VALUES
(1, 'PSI', 'tst@g.com', '9950162420', 0, 'nbnbbn', 'a:2:{i:0;s:4:".net";i:1;s:9:"angularjs";}', '2016-12-27 17:55:56', '2016-12-28 12:26:58'),
(2, 'PWS', 'tst@g.com', '9950162420', 0, 'nbnbbn', 'a:2:{i:0;s:3:"php";i:1;s:6:"jquery";}', '2016-12-27 18:18:55', '2016-12-28 11:11:16'),
(3, 'A3 Logics', 'tst@g.com', '9950162420', 17, 'nbnbbn', 'a:1:{i:0;s:3:"php";}', '2016-12-27 18:20:10', '2016-12-28 12:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_groupid` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `company` varchar(50) DEFAULT NULL,
  `job_title` varchar(35) NOT NULL,
  `address` varchar(60) NOT NULL,
  `country_id` char(2) DEFAULT NULL,
  `state_id` int(10) UNSIGNED DEFAULT NULL,
  `city` varchar(35) NOT NULL,
  `zip` varchar(12) NOT NULL,
  `office_phone` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `note` text NOT NULL,
  `source` enum('webapp','gmail','csv') NOT NULL DEFAULT 'webapp',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `user_groupid`, `first_name`, `last_name`, `company`, `job_title`, `address`, `country_id`, `state_id`, `city`, `zip`, `office_phone`, `mobile`, `email`, `website`, `note`, `source`, `created`, `modified`) VALUES
(1, 115, 3, 'ipad', 'contact', 'a3logics', 'BA', 'street address', 'US', 18655, 'my city', '1111111', '100000', '2000000', 'ipadcon@mailimate.com', 'Abc.com', '', 'webapp', '2016-06-10 07:09:32', '2016-06-10 01:50:18'),
(2, 116, 3, 'Nexuse', 'Contact', 'A3logics', 'Qa', 'Sitapura', 'IN', 14691, 'Jaipur', '302032', '123456', '123456', 'nexus1@mailimate.com', 'www.web.com', '', 'webapp', '2016-06-10 07:10:04', '2016-06-10 01:50:52'),
(3, 118, 3, 'Web', 'Contact', '', 'QA', '', '', NULL, '', '', '', '', 'webcontact@mailimate.com', '', '', 'webapp', '2016-06-10 07:11:17', '2016-06-10 01:41:17'),
(4, 117, 3, 'Motog', 'Cntact', 'AS', 'As', 'Durgapura', 'AT', 12486, 'Jaipur', '65789', '', '', 'motog@mailimate.com', 'www.website.com', '', 'webapp', '2016-06-10 07:12:24', '2016-06-10 01:51:01'),
(5, 118, 3, 'web', 'contwo', 'You Bix', 'Analyst', 'Fulton', 'IN', 14691, 'My city', '522200', '5226555', '6652333', 'con1@mailimate.com', 'abc.com', 'hi from web', 'webapp', '2016-06-10 07:13:45', '2016-06-10 01:51:01'),
(6, 115, 3, 'ipad', 'two', '', 'Doctor', '', '', NULL, '', '', '', '', 'ipad2@mailimate.com', '', '', 'webapp', '2016-06-10 07:14:26', '2016-06-10 01:44:26'),
(7, 116, 3, 'S', 'D', '', 'Dev', '', '', 0, '', '', '', '', 'w@mailimate.com', '', '', 'webapp', '2016-06-10 07:14:46', '2016-06-10 01:44:46'),
(9, 115, 3, 'iPad', 'referral', 'referral company', 'actor', 'street address', 'AL', 12310, 'my city', '9998877', '0009900', '1117788', 'refipad@mailimate.com', 'Bach.com', '', 'webapp', '2016-06-10 08:14:29', '2016-06-10 02:44:29'),
(10, 116, 3, 'Nexus referal', 'Yy', '', 'Electronics', '', '', NULL, '', '', '', '', 'y@mail.com', '', '', 'webapp', '2016-06-10 08:14:36', '2016-06-10 02:44:36'),
(11, 117, 3, 'Moto referral', 'User', '', 'E', '', '', NULL, '', '', '', '', 'r@f.com', '', '', 'webapp', '2016-06-10 08:14:43', '2016-06-10 02:44:43'),
(12, 115, 3, 'test', 'one', '', 'ba', '', '', NULL, '', '', '', '', 'ba@mailimate.com', '', '', 'webapp', '2016-06-10 11:17:22', '2016-06-10 05:47:22'),
(13, 115, 3, 'Bahnu', 'Bhanu', 'Aopiuy', 'Ba', '', '', NULL, '', '', '', '', 'bhanu@mailimate.com', '', '', 'webapp', '2016-06-10 11:24:48', '2016-06-11 06:44:35'),
(14, 117, 3, 'Julka', 'Rohan', 'A3', 'F', '', '', NULL, '', '', '', '', 'f@nail.com', '', '', 'webapp', '2016-06-10 11:27:36', '2016-06-11 06:44:59'),
(15, 115, 3, 'demur', 'fropuy', 'fox', 'WA', '', '', NULL, '', '', '', '', 'qa@mailimate.com', '', '', 'webapp', '2016-06-10 11:32:31', '2016-06-10 06:02:31'),
(16, 116, 3, 'T', 'Y', 'Ad', 'A', '', '', NULL, '', '', '', '', 'd@mailimate.com', '', '', 'webapp', '2016-06-10 11:34:48', '2016-06-10 06:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `email_masters`
--

CREATE TABLE `email_masters` (
  `id` int(10) UNSIGNED NOT NULL,
  `email_type` enum('new_reg','group_change','newsletters','webcasts','announcements','reminder_emails','notifications','pass_reset','foxhopr_affiliate','cancel_plan','event_operations','user_kickoff','invite','group_activity','register','contact_us') NOT NULL,
  `email_type_name` varchar(256) NOT NULL,
  `email_from` varchar(256) NOT NULL,
  `from_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_masters`
--

INSERT INTO `email_masters` (`id`, `email_type`, `email_type_name`, `email_from`, `from_name`) VALUES
(1, 'newsletters', 'Newsletters', 'info@foxhopr.com', 'FoxHopr News1'),
(2, 'webcasts', 'Webcasts', 'info2@Foxhopr.com', 'FoxHopr News2'),
(3, 'announcements', 'Announcements', 'info3@Foxhopr.com', 'FoxHopr News3'),
(4, 'notifications', 'Notifications', 'info4@Foxhopr.com', 'FoxHopr DoNotReply4'),
(5, 'pass_reset', 'Password Reset', 'info5@Foxhopr.com', 'FoxHopr DoNotReply5'),
(6, 'new_reg', 'New User Registeration', 'info@Foxhopr.com', 'FoxHopr DoNotReply'),
(7, 'group_change', 'Group Changed', 'info@Foxhopr.com', 'FoxHopr DoNotReply'),
(8, 'foxhopr_affiliate', 'Foxhopr Affiliate', 'info@Foxhopr.com', 'FoxHopr DoNotReply'),
(9, 'cancel_plan', 'Cancel Plan', 'info@Foxhopr.com', 'FoxHopr DoNotReply'),
(10, 'event_operations', 'Event Actions', 'info@Foxhopr.com', 'FoxHopr DoNotReply'),
(11, 'invite', 'Invitation', 'info@Foxhopr.com', 'FoxHopr'),
(12, 'group_activity', 'Group Updation', 'info@Foxhopr.com', 'FoxHopr'),
(13, 'contact_us', 'Contact Us', 'info@Foxhopr.com', 'FoxHopr');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) UNSIGNED NOT NULL,
  `subject` varchar(65) NOT NULL,
  `content` text NOT NULL,
  `written_by_user` int(11) UNSIGNED NOT NULL,
  `recipient_users` varchar(1000) NOT NULL,
  `message_type` enum('message','message_comment','referral_comment','') NOT NULL DEFAULT 'message',
  `is_read` tinyint(1) NOT NULL DEFAULT '1',
  `is_archive` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `subject`, `content`, `written_by_user`, `recipient_users`, `message_type`, `is_read`, `is_archive`, `created`, `modified`) VALUES
(71, 'this is iPad. es sage', 'Msg from ipad', 115, 'Web Sydney, Moto G, Nexus Pad', 'message', 1, 0, '2016-06-10 08:19:10', '2016-06-10 05:07:29'),
(72, 'Nexus message', 'hi', 116, 'Web Sydney, Moto G, Eye Pad', 'message', 1, 0, '2016-06-10 08:19:22', '2016-06-10 02:49:22'),
(73, 'moto message', 'hi', 117, 'Web Sydney, Nexus Pad, Eye Pad', 'message', 1, 0, '2016-06-10 08:19:24', '2016-06-10 02:49:24'),
(74, 'iPad msg with attach', 'Hello chkmattchments', 115, 'Web Sydney, Moto G, Nexus Pad', 'message', 1, 0, '2016-06-10 08:20:39', '2016-06-10 03:41:31'),
(75, 'third msg', 'Hi', 115, 'Moto G, Nexus Pad, Web Sydney', 'message', 1, 0, '2016-06-10 08:21:59', '2016-06-10 03:41:31'),
(76, 'moto here', 'hi', 116, 'Moto G, Eye Pad, Web Sydney', 'message', 1, 0, '2016-06-10 08:22:26', '2016-06-10 03:38:46'),
(77, 'moto here', 'hi', 117, 'Eye Pad, Nexus Pad, Web Sydney', 'message', 1, 0, '2016-06-10 08:22:28', '2016-06-10 02:52:28'),
(78, 'You have received a new comment', 'A comment is posted by Eye Pad on message you sent.\r\n        &lt;br/&gt;\r\n        &lt;i&gt;&quot;Hi nexu&quot;&lt;/i&gt;\r\n        &lt;br/&gt;\r\n        Thanks,\r\n        Foxhopr Team', 115, 'Moto G,Nexus Pad,Web Sydney', 'message_comment', 0, 0, '2016-06-10 09:10:07', '2016-06-10 03:40:07'),
(79, 'You have received a new comment', 'A comment is posted by Eye Pad on referral you sent.\r\n        &lt;br/&gt;\r\n        &lt;br/&gt;\r\n        &lt;i&gt;&quot;Yyyy&quot;&lt;/i&gt;\r\n        &lt;br/&gt;\r\n        &lt;br/&gt;\r\n        Thanks,&lt;br/&gt;\r\n        Foxhopr Team', 115, 'Nexus Pad', 'referral_comment', 0, 0, '2016-06-10 10:29:46', '2016-06-10 04:59:46'),
(80, 'You have received a new comment', 'A comment is posted by Moto G on referral you sent.\r\n        &lt;br/&gt;\r\n        &lt;br/&gt;\r\n        &lt;i&gt;&quot;hi&quot;&lt;/i&gt;\r\n        &lt;br/&gt;\r\n        &lt;br/&gt;\r\n        Thanks,&lt;br/&gt;\r\n        Foxhopr Team', 117, 'Nexus Pad', 'referral_comment', 0, 0, '2016-06-10 11:06:28', '2016-06-10 05:36:28'),
(81, 'You have received a new comment', 'A comment is posted by Moto G on referral you sent.\r\n        &lt;br/&gt;\r\n        &lt;br/&gt;\r\n        &lt;i&gt;&quot;hi&quot;&lt;/i&gt;\r\n        &lt;br/&gt;\r\n        &lt;br/&gt;\r\n        Thanks,&lt;br/&gt;\r\n        Foxhopr Team', 117, 'Eye Pad', 'referral_comment', 0, 0, '2016-06-10 11:26:21', '2016-06-10 05:56:21'),
(82, 'You have received a new comment', 'A comment is posted by Nexus Pad on referral you sent.\r\n        &lt;br/&gt;\r\n        &lt;br/&gt;\r\n        &lt;i&gt;&quot;hi&quot;&lt;/i&gt;\r\n        &lt;br/&gt;\r\n        &lt;br/&gt;\r\n        Thanks,&lt;br/&gt;\r\n        Foxhopr Team', 116, 'Eye Pad', 'referral_comment', 0, 0, '2016-06-10 11:33:50', '2016-06-10 06:03:50'),
(83, 'sadfsafsadf', 'sdfsadfdsa', 120, 'Demo User', 'message', 1, 0, '2016-06-10 12:48:57', '2016-06-10 07:19:03'),
(84, 'Hfgghh', 'R', 115, 'G Moto, Pad Nexus, Sydney Web', 'message', 1, 0, '2016-06-11 12:20:40', '2016-06-11 06:50:40'),
(93, 'Hello All LEADERS', 'GO Foxhopping', 1, 'Ab Cd', 'message', 0, 0, '2016-06-12 10:27:13', '2016-06-12 04:57:13'),
(94, 'Hello All LEADERS', 'GO Foxhopping', 1, 'Demo User', 'message', 0, 0, '2016-06-12 10:27:13', '2016-06-12 04:57:13'),
(95, 'Hello All LEADERS', 'GO Foxhopping', 1, 'Eye Pad', 'message', 0, 0, '2016-06-12 10:27:14', '2016-06-12 04:57:14'),
(96, 'Hello All LEADERS', 'GO Foxhopping', 1, 'Group Test Two', 'message', 0, 0, '2016-06-12 10:27:15', '2016-06-12 04:57:15'),
(97, 'Hello All LEADERS', 'GO Foxhopping', 1, 'Group Test Four', 'message', 0, 0, '2016-06-12 10:27:15', '2016-06-12 04:57:15'),
(98, 'Hello All LEADERS', 'GO Foxhopping', 1, 'Mailer User', 'message', 0, 0, '2016-06-12 10:27:15', '2016-06-12 04:57:15'),
(99, 'Hello All LEADERS', 'GO Foxhopping', 1, 'Minusone User', 'message', 1, 0, '2016-06-12 10:27:15', '2016-06-12 05:00:56'),
(100, 'Hello All LEADERS', 'GO Foxhopping', 1, 'Rohan Julka', 'message', 1, 0, '2016-06-12 10:27:16', '2016-06-13 00:01:36'),
(101, 'Hello All LEADERS', 'Hello Admin This is Rohan', 122, 'Admin', 'message', 0, 0, '2016-06-12 10:28:40', '2016-06-12 04:58:40'),
(102, 'Hello All LEADERS', 'Hey Brother watsupp !', 126, 'Admin', 'message', 0, 0, '2016-06-12 10:30:52', '2016-06-12 05:00:52'),
(103, 'Adm def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WX', 'abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc d', 1, 'Minusone User', 'message', 0, 0, '2016-06-13 04:50:18', '2016-06-12 23:20:18'),
(104, 'Adm def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WX', 'abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc d', 1, 'Utkarsh Singh', 'message', 0, 0, '2016-06-13 04:50:19', '2016-06-12 23:20:19'),
(105, 'Gaurav Test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Ut varius tincidunt libero. Phasellus dolor. Maecenas vestibulum mollis diam. Pellentesque ut neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut non enim eleifend felis pretium feugiat. Vivamus quis mi. Phasellus a est. Phasellus magna. In hac habitasse platea dictumst. Curabitur at lacus ac velit ornare lobortis. Curabitur a felis in nunc fringilla tristique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem. Pellentesque libero tortor, tincidunt et, tincidunt eget, semper nec, quam. Sed hendrerit. Morbi ac felis. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Donec interdum, metus et hendrerit aliquet, dolor diam sagittis ligula, eget egestas libero turpis vel mi. Nunc nulla. Fusce risus nisl, viverra et, tempor et, pretium in, sapien. Donec venenatis vulputate lorem. Morbi nec metus. Phasellus blandit leo ut odio. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem. Sed magna purus, fermentum eu, tincidunt eu, varius ut, felis. In auctor lobortis lacus. Quisque libero metus, condimentum nec, tempor a, commodo mollis, magna. Vestibulum ullamcorper mauris at ligul', 1, 'Minusone User', 'message', 0, 0, '2016-06-13 05:28:21', '2016-06-12 23:58:21'),
(106, 'Gaurav Test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Ut varius tincidunt libero. Phasellus dolor. Maecenas vestibulum mollis diam. Pellentesque ut neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut non enim eleifend felis pretium feugiat. Vivamus quis mi. Phasellus a est. Phasellus magna. In hac habitasse platea dictumst. Curabitur at lacus ac velit ornare lobortis. Curabitur a felis in nunc fringilla tristique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem. Pellentesque libero tortor, tincidunt et, tincidunt eget, semper nec, quam. Sed hendrerit. Morbi ac felis. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Donec interdum, metus et hendrerit aliquet, dolor diam sagittis ligula, eget egestas libero turpis vel mi. Nunc nulla. Fusce risus nisl, viverra et, tempor et, pretium in, sapien. Donec venenatis vulputate lorem. Morbi nec metus. Phasellus blandit leo ut odio. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem. Sed magna purus, fermentum eu, tincidunt eu, varius ut, felis. In auctor lobortis lacus. Quisque libero metus, condimentum nec, tempor a, commodo mollis, magna. Vestibulum ullamcorper mauris at ligul', 1, 'Q Qq', 'message', 1, 0, '2016-06-13 05:28:22', '2016-06-13 00:01:20'),
(107, 'Gaurav Test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Ut varius tincidunt libero. Phasellus dolor. Maecenas vestibulum mollis diam. Pellentesque ut neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut non enim eleifend felis pretium feugiat. Vivamus quis mi. Phasellus a est. Phasellus magna. In hac habitasse platea dictumst. Curabitur at lacus ac velit ornare lobortis. Curabitur a felis in nunc fringilla tristique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem. Pellentesque libero tortor, tincidunt et, tincidunt eget, semper nec, quam. Sed hendrerit. Morbi ac felis. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Donec interdum, metus et hendrerit aliquet, dolor diam sagittis ligula, eget egestas libero turpis vel mi. Nunc nulla. Fusce risus nisl, viverra et, tempor et, pretium in, sapien. Donec venenatis vulputate lorem. Morbi nec metus. Phasellus blandit leo ut odio. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem. Sed magna purus, fermentum eu, tincidunt eu, varius ut, felis. In auctor lobortis lacus. Quisque libero metus, condimentum nec, tempor a, commodo mollis, magna. Vestibulum ullamcorper mauris at ligul', 1, 'Story Bug', 'message', 1, 0, '2016-06-13 05:28:22', '2016-06-12 23:59:13'),
(108, 'Gaurav Test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Ut varius tincidunt libero. Phasellus dolor. Maecenas vestibulum mollis diam. Pellentesque ut neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut non enim eleifend felis pretium feugiat. Vivamus quis mi. Phasellus a est. Phasellus magna. In hac habitasse platea dictumst. Curabitur at lacus ac velit ornare lobortis. Curabitur a felis in nunc fringilla tristique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem. Pellentesque libero tortor, tincidunt et, tincidunt eget, semper nec, quam. Sed hendrerit. Morbi ac felis. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Donec interdum, metus et hendrerit aliquet, dolor diam sagittis ligula, eget egestas libero turpis vel mi. Nunc nulla. Fusce risus nisl, viverra et, tempor et, pretium in, sapien. Donec venenatis vulputate lorem. Morbi nec metus. Phasellus blandit leo ut odio. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem. Sed magna purus, fermentum eu, tincidunt eu, varius ut, felis. In auctor lobortis lacus. Quisque libero metus, condimentum nec, tempor a, commodo mollis, magna. Vestibulum ullamcorper mauris at ligul', 1, 'Utkarsh Singh', 'message', 1, 0, '2016-06-13 05:28:23', '2016-06-13 00:44:20'),
(109, 'Gaurav Test', 'abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc dgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', 121, 'Admin', 'message', 0, 0, '2016-06-13 05:30:55', '2016-06-13 00:00:55'),
(110, 'Gaurav Test', 'abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ !"Â§ $%& /() =?* ''<> #|; Â²Â³~ @`Â´ Â©Â«Â» Â¤Â¼Ã— {} abc ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', 131, 'Admin', 'message', 0, 0, '2016-06-13 06:11:36', '2016-06-13 00:41:36');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` tinyint(2) UNSIGNED NOT NULL,
  `page_name` varchar(50) NOT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `meta_title` varchar(60) NOT NULL,
  `page_content` text NOT NULL,
  `page_media_file` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_desc` varchar(160) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `page_title`, `meta_title`, `page_content`, `page_media_file`, `meta_keywords`, `meta_desc`, `created`, `modified`) VALUES
(1, 'about us', 'about-us', 'FoxHopr - About Us', '<p>&nbsp;</p>\r\n\r\n<p>Foxhopr was founded in 2014 with the sole reason to help business grow and succeed.&nbsp; We felt there was a need for a dynamic web-based networking tool that did not exist.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We&rsquo;re big believers in the power of networking &ndash; we have it done it ourselves throughout our careers.&nbsp; To put it simply, we got tired of waking up at 5am once a week to meet our networking group &ndash; the same group week after week after week &ndash; and knew there had to be a better, cheaper and more modern and efficient way.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Our goals are to bring the world together via networking and for the last 2 years we have been working hard to bring you the first and only online networking platform with all the CRM tools you need.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We are focused on networking.&nbsp; Plain and simple.&nbsp; And we believe a great product speaks for itself.&nbsp; We are committed to helping you succeed and build your connections as an Entrepreneur, small or large business, Freelancer, and Moonlighter.&nbsp;&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Foxhopr</p>\r\n\r\n<p>PO Box 1859</p>\r\n\r\n<p>New York, NY 10010</p>\r\n\r\n<p>(212) 763-7721</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href="http://ec2-52-88-140-70.us-west-2.compute.amazonaws.com/pages/contactUs">Support</a></p>\r\n\r\n<p><a href="http://ec2-52-88-140-70.us-west-2.compute.amazonaws.com/pages/tour">Tour</a></p>\r\n\r\n<p>Want a Demo?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Suggestions? - We always have your best interest at heart so if you have any suggestions you can always drop a line here.&nbsp; We read and respond to every email.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href="http://ec2-52-88-140-70.us-west-2.compute.amazonaws.com/blog/">Blog</a></p>\r\n', NULL, 'About Us', 'This is dummy about us ', '2015-04-20 11:25:10', '2016-03-28 01:40:42'),
(2, 'Privacy Policy', 'privacy-policy', 'FoxHopr: Privacy Policy', '<p>&nbsp;</p>\r\n\r\n<p>This privacy policy discloses the privacy practices for&nbsp;Foxhopr.com.&nbsp; This privacy policy applies solely to information collected by this web site. It will notify you of the following:</p>\r\n\r\n<ol>\r\n	<li>What personally identifiable information is collected from you through the web site, how it is used and with whom it may be shared.</li>\r\n	<li>What choices are available to you regarding the use of your data.</li>\r\n	<li>The security procedures in place to protect the misuse of your information.</li>\r\n	<li>How you can correct any inaccuracies in the information.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Information Collection, Use, and Sharing</strong>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="line-height:1.6em">We are the sole owners of the information collected on this site. We only have access to/collect information that you voluntarily give us via email or other direct contact from you. We will not sell or rent this information to anyone.</span></p>\r\n\r\n<p>We will use your information to respond to you, regarding the reason you contacted us. We will not share your information with any third party outside of our organization, other</p>\r\n\r\n<p>than as necessary to fulfill your request, e.g. to ship an order.</p>\r\n\r\n<p>Unless you ask us not to, we may contact you via email in the future to tell you about specials, new products or services, or changes to this privacy policy.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Your Access to and Control Over Information</strong>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="line-height:1.6em">You may opt out of any future contacts from us at any time. You can do the following at any time by contacting us via the email address or phone number given on our website:</span></p>\r\n\r\n<ul>\r\n	<li>See what data we have about you, if any.</li>\r\n	<li>Change/correct any data we have about you.</li>\r\n	<li>Have us delete any data we have about you.</li>\r\n	<li>Express any concern you have about our use of your data.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Security</strong>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="line-height:1.6em">We take precautions to protect your information. When you submit sensitive information via the website, your information is protected both online and offline.</span></p>\r\n\r\n<p>Wherever we collect sensitive information (such as credit card data), that information is encrypted and transmitted to us in a secure way. You can verify this by looking for a closed lock icon at the bottom of your web browser, or looking for &quot;https&quot; at the beginning of the address of the web page.</p>\r\n\r\n<p>While we use encryption to protect sensitive information transmitted online, we also protect your information offline. Only employees who need the information to perform a specific job (for example, billing or customer service) are granted access to personally identifiable information. The computers/servers in which we store personally identifiable information are kept in a secure environment.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Registration</strong>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="line-height:1.6em">In order to use this website, a user must first complete the registration form.&nbsp; During</span></p>\r\n\r\n<p>registration a user is required to give certain information (such as name and email address). This information is used to contact you about the products/services on our site in which you have expressed interest. At your option, you may also provide demographic information (such as gender or age) about yourself, but it is not required.</p>\r\n\r\n<p><br />\r\n<strong><strong>Cookies</strong></strong>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="line-height:1.6em">We use &quot;cookies&quot; on this site. A cookie is a piece of data stored on a site visitor&#39;s hard drive to help us improve your access to our site and identify repeat visitors to our site. For instance, when we use a cookie to identify you, you would not have to log in a password more than once, thereby saving time while on our site. Cookies can also enable us to track and target the interests of our users to enhance the experience on our site. Usage of a cookie is in no way linked to any personally identifiable information on our site.</span></p>\r\n\r\n<p><span style="line-height:1.6em">Some of our business partners may use cookies on our site (for example, advertisers). However, we have no access to or control over these cookies.</span></p>\r\n\r\n<p><br />\r\n<strong><strong>Sharing</strong></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="line-height:1.6em">We share aggregated demographic information with our partners and advertisers. This is not linked to any personal information that can identify any individual person.</span></p>\r\n\r\n<p>And/or:&nbsp;</p>\r\n\r\n<p>We use an outside shipping company to ship orders, and a credit card processing company to bill users for goods and services. These companies do not retain, share, store or use personally identifiable information for any secondary purposes beyond filling your order.</p>\r\n\r\n<p>And/or:&nbsp;</p>\r\n\r\n<p>We partner with another party to provide specific services. When the user signs up for these services, we will share names, or other contact information that is necessary for the third party to provide these services. These parties are not allowed to use personally identifiable information except for the purpose of providing these services.</p>\r\n\r\n<p><br />\r\n<strong><strong>Links</strong></strong>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="line-height:1.6em">This web site contains links to other sites. Please be aware that we are not responsible for the content or privacy practices of such other sites. We encourage our users to be aware when they leave our site and to read the privacy statements of any other site that collects personally identifiable information.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Updates</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="line-height:1.6em">Our Privacy Policy may change from time to time and all updates will be posted on this page.&nbsp; </span><strong style="line-height:1.6em">If you feel that we are not abiding by this privacy policy, you should contact us immediately via telephone at&nbsp;212-763-7721 or via email.</strong></p>\r\n', NULL, 'Privacy, Policy, Privacy Policy', 'Meta Description Test', '2015-04-20 11:44:33', '2016-03-28 01:46:47'),
(3, 'Terms & Conditions', 'terms-and-conditions', 'Terms & Conditions', '<p>&nbsp;</p>\r\n\r\n<p><strong>Terms of Use for Informational Website and Privacy Policy</strong></p>\r\n\r\n<p>Welcome to Foxhopr (<em>the Website</em>).&nbsp; Foxhopr LLC is an informational website owned and operated at PO Box 1859, New York, NY, 10010.</p>\r\n\r\n<p><strong>PLEASE READ THESE TERMS OF USE CAREFULLY BEFORE USING THE WEBSITE.&nbsp; BY ACCESSING AND/OR USING THE WEBSITE (OTHER THAN TO READ THESE TERMS OF USE FOR THE FIRST TIME). YOU ARE AGREEING TO COMPLY WITH THESE TERMS OF USE, WHICH MAY CHANGE FROM TIME TO TIME AS SET FORTH IN SECTION XII BELOW. </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>INTELLECTUAL PROPERTY</strong></p>\r\n\r\n<p>The Website and included content (and any derivative works or enhancements of the same) including, but not limited to, all text, illustrations, files, images, software, scripts, graphics, photos, sounds, music, videos, information, content, materials, products, services, URLs, technology, documentation, and interactive features (collectively, the Website Content) and all intellectual property rights to the same are owned by Foxhopr LLC, our licensors, or both. Additionally, all trademarks, service marks, trade names and trade dress that may appear on the Website are owned by us, our licensors, or both. Except for the limited use rights granted to you in these Terms of Use, you shall not acquire any right, title or interest in the Website or any Website Content. Any rights not expressly granted in these Terms of Use are expressly reserved.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>WEBSITE ACCESS AND USE</strong></p>\r\n\r\n<p>Access to the Website including, without limitation, the Website Content is provided for your information and personal, non-commercial use only. When using the Website, you agree to comply with all applicable federal, state, and local laws including, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; without limitation copyright law. Except as expressly permitted in these Terms of Use, you may not use, reproduce, distribute, create derivative works based upon, publicly display, publicly perform, publish, transmit, or otherwise exploit Website Content for any purpose whatsoever without obtaining prior written consent from us or, in the case of third-party content, its respective owner. In certain instances, we may permit you to download or print Website Content or both. In such a case, you may download or print (as applicable) one copy of Website Content for your personal, non-commercial use only. You acknowledge that you do not acquire any ownership rights by downloading or printing Website Content.</p>\r\n\r\n<p>Except as expressly permitted in these Terms of Use, you may not:</p>\r\n\r\n<ol>\r\n	<li>Remove, alter, cover, or distort any copyright, trademark, or other proprietary rights notice on the Website or Website Content;</li>\r\n	<li>Circumvent, disable or otherwise interfere with security-related features of the Website including, without limitation, any features that prevent or restrict use or copying of any content or enforce limitations on the, use of the Website or Website Content;</li>\r\n	<li>Use an automatic device (such as a robot or spider) or manual process to copy or scrape the Website or Website Content for any purpose without the express written permission of Foxhopr LLC Notwithstanding the foregoing, Foxhopr LLC grants public search engine operators permission to use automatic devices (such as robots or spiders) to copy Website Content from the Website for the sole purpose of creating (and only to the extent necessary to create) a searchable index of Website Content that is available to the public. We reserve the right to revoke this permission (generally or specifically) at any time;</li>\r\n	<li>Collect or harvest any personally identifiable information from the Website including, without limitation, user names, passwords, email addresses and other personal log in information or personal background data;</li>\r\n	<li>Solicit other users to join our service or become members of our commercial online service or other organization without our prior written approval;</li>\r\n	<li>Attempt to or interfere with the proper working of the Website or impair, overburden, or disable the same;</li>\r\n	<li>Decompile, reverse engineer, or disassemble any portion of any the Website;</li>\r\n	<li>Use network-monitoring software to determine architecture of or extract usage data from the Website;</li>\r\n	<li>Encourage conduct that violates any local, state or federal law, either civil or criminal, or impersonate another user, person, or entity (e.g., using another person&rsquo;s Membership without permission, etc.);</li>\r\n	<li>Violate U.S. export laws, including, without limitation, violations of the Export Administration Act and the Export Administration Regulations administered by the Department of Commerce; or</li>\r\n	<li>Engage in any conduct that restricts or inhibits any other user from using or enjoying the Website.</li>\r\n	<li>You agree to cooperate fully with Foxhopr LLC to investigate any suspected or actual activity that is in breach of these Terms of Use.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>C</strong><strong>ONDITIONS FOR LINKING TO WEBSITE</strong></p>\r\n\r\n<p>Upon your acceptance of these Terms of Use as evidence by your clicking where indicated below your acceptance of an agreement to these terms, we hereby grant you a non-exclusive, limited license, revocable at our sole and exclusive discretion, for you to link to the Website home page from any site you own or control that is not commercially competitive with the Website and does not criticize or otherwise injure the Website, so long as the site where the link resides, and all other locations to which such site links, comply with all applicable laws and do not in any way abuse, defame, stalk, threaten or violate the rights of privacy, publicity, intellectual property or other legal rights of others or, in any way, post, publish, distribute, disseminate or facilitate any inappropriate, infringing, defamatory, profane, indecent, obscene or illegal/unlawful information, topic, name or other material or that violates the spirit of our mission. Such a link is not an endorsement of such other site(s) by us. All of our rights and remedies are expressly reserved and preserved and at no time waived or diminished in any manner.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>USER REGISTRATION </strong></p>\r\n\r\n<p>In order to access or use some features of the Website, you will have to become a registered user. If you are under the age of eighteen, then you are not permitted to register as a user or otherwise submit personal information to this Website. Anyone under the age of eighteen is not permitted to use this Website or download and/or copy any of the Website&rsquo;s content.</p>\r\n\r\n<p>If you become a registered user, you will provide true, accurate and complete registration information and, if such information changes, you will promptly update the relevant registration information. During registration, you will create a user name and password (a Membership), which may permit you access to certain areas of the Website not available to non-registered users. You are responsible for safeguarding and maintaining the confidentiality of your Membership. You are solely responsible for the activity that occurs under your Membership, whether or not you have authorized the activity. You agree to notify us immediately at info@foxhopr.com of any breach of security or unauthorized use of your Membership.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>USER <em>CONTENT</em></strong></p>\r\n\r\n<p>We may now or in the future permit users to post, upload, transmit through, or otherwise make available on the Website (collectively, submit) messages, text, illustrations, files, images, graphics, photos, comments, sounds, music, videos, information, content, and/or other materials (User Content). Subject to the rights and license you grant herein, you retain all right, title and interest in your User Content.&nbsp; We do not guarantee any confidentiality with respect to User Content even if it is not published on the Website. It is solely your responsibility to monitor and protect any intellectual property rights that you may have in your User Content, and we do not accept any responsibility for the same. You are not authorized to distribute any User Content on the Website that violates any federal, state or local law. You are further expressly prohibited from displaying or exchanging any pornographic materials, sexual solicitations or invitations for sexual favors and any content that involves gambling or the solicitation of gambling.</p>\r\n\r\n<p>You shall not submit any User Content protected by copyright, trademark, patent, trade secret, moral right, or other intellectual property, personal, contractual, proprietary or other third party right without the express written permission of the owner of the respective right. You are solely liable for any damage resulting from your failure toobtain such permission or from any other harm resulting from User Content that you submit.&nbsp; You agree to indemnify, defend and hold harmless Foxhopr LLC against any and all claims from third parties which claim that you have in any way acted inappropriately or without those third parties&rsquo; express written consent to use any of their content.</p>\r\n\r\n<p>You represent, warrant, and covenant that you will not submit any User Content that:</p>\r\n\r\n<ol>\r\n	<li>Violates or infringes in any way upon the rights of others, including, but not limited to, any copyright, trademark, patent, trade secret, moral right, or other intellectual property, personal, contractual, proprietary or other third party right of any person or entity;</li>\r\n	<li>Impersonates another or is unlawful, threatening, abusive, libelous, defamatory, invasive of privacy or publicity rights, vulgar, obscene, profane, pornographic, lewd, lascivious, filthy, excessively violent, harassing or otherwise objectionable;</li>\r\n	<li>Encourages conduct that would constitute a criminal offense, give rise to civil liability or otherwise violate any federal, state and/or local law;</li>\r\n	<li>Is an advertisement for goods or services or a solicitation of funds;</li>\r\n	<li>Includes personal information such as messages which identify phone numbers, social security numbers, account numbers, addresses, employer references or any other personal information that is not available to the public;</li>\r\n	<li>Contains a formula, instruction, or advice that could cause harm or injury;</li>\r\n	<li>Is a chain letter of any kind; or</li>\r\n	<li>The licensed use by us hereunder would result in us having any obligation or liability to any parties.</li>\r\n	<li><strong>Any conduct by a User that in our sole and exclusive discretion restricts or inhibits any other user from using or enjoying the Website will not be permitted and your membership will be immediately discontinued without any notice. </strong></li>\r\n</ol>\r\n\r\n<p>By submitting User Content to us, simultaneously with such posting you automatically grant, or warrant that the owner has expressly granted, to us a worldwide, royalty-free, perpetual, irrevocable, non-exclusive, fully licensable, and transferable right and license to use, record, sell, lease, reproduce, distribute, create derivative works based upon (including, without limitation, translations), publicly display, publicly perform, transmit, publish and otherwise exploit the User Content (in whole or in part) as we, in our sole and exclusive discretion, deem appropriate including, without limitation, (1) in connection with our business; and (2) in connection with the businesses of our affiliates, successors, parents, subsidiaries, and their related companies. We may exercise this grant in any format, media or technology now known or later developed for the full term of any copyright that may exist in such User Content. Furthermore, you also grant other user permission to access your User Content and to use, record, sell, lease, reproduce, distribute, create derivative works based upon, public display, public performance, transmission, publication and otherwise exploit your User Content for personal, non-commercial use as permitted by the functionality of the Website and these Terms of Use. The granted rights include the right to configure, host, index, cache, digitize, compress, optimize, modify, edit, adapt, and remove such content and combine same with other materials. Furthermore, we are free to use any ideas, concepts, know-how or techniques contained in any User Content you submit without any remuneration or obligation to you and with your express knowledge and consent.</p>\r\n\r\n<p>By submitting User Content, you also grant us the right, but not the obligation to use your biographical information including, without limitation, your name and &nbsp;&nbsp;&nbsp; geographical location in connection with broadcast, print, online, or other use or publication of your User Content.</p>\r\n\r\n<p>We reserve the right to display advertisements in connection with your User Content and to use your User Content for advertising and promotional purposes. You acknowledge and agree that your User Content may be included on the Websites and advertising networks of our distribution partners and third-party service providers (including their downstream users).</p>\r\n\r\n<p>We have the right, but not the obligation, to monitor User Content. Please exercise caution and common sense when viewing User Content. We have no obligation to post, maintain or otherwise make use of User Content and do not guarantee distribution of User Content. We may discontinue operation of the Website, or your use of the Website, in either case in whole or in part, in our sole, absolute and exclusive discretion. You have no right to maintain or access your User Content after you have placed it on the Website and we have no obligation to return your User Content or otherwise make it available to you.</p>\r\n\r\n<p>The rights granted by you hereunder may not be terminated, revoked or rescinded and are not subject to reversion. If you become aware that User Content you have submitted includes any material for which you lack the unrestricted right to grant us the rights set forth above without obligations or liability to any party, you agree to promptly provide us with detailed written notice thereof to Foxhopr LLC, P.O. Box 1859, New York, NY 10010 and <a href="mailto:info@foxhopr.com">info@foxhopr.com</a>.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>â€‹<strong>WEBSITE CONTENT &amp; THIRD PARTY LINKS </strong></p>\r\n\r\n<ol>\r\n	<li>We provide the Website including, without limitation Website Content for entertainment, educational and promotional purposes only. You may not rely on any information and opinions expressed on any of our Website for any other purpose. In all instances, it is your responsibility to evaluate the accuracy, timeliness, completeness, or usefulness of Website Content. Under no circumstances will we be liable for any loss or damage caused by your reliance on any Website Content.</li>\r\n	<li>In some instances, Website Content will include content posted by a third-party or will represent the opinions and judgments of a third-party. We do not endorse, warrant and are not responsible for the accuracy, timeliness, completeness, or reliability of any opinion, advice, or statement made on the Website by anyone other than authorized employees or spokespersons while acting in their official capacities.</li>\r\n	<li>The Website may contain links to other Websites maintained by third parties. We &nbsp; do not operate or control, in any respect, or necessarily endorse the content found on these third-party Websites. You assume sole responsibility for your use of third-party links. We are not responsible for any content posted on third-party Websites or liable to you for any loss or damage of any sort incurred as a result of your dealings with any third-party or their Website.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>INDEMNIFICATION</strong></p>\r\n\r\n<p>You agree to indemnify and hold harmless Foxhopr LLC and its employees, agents, distribution partners, affiliates, subsidiaries, and their related companies from and against any and all claims, liabilities, losses, damages, obligations, costs and expenses (including reasonable attorneys&rsquo; fees and costs) arising out of, related to, or that may arise in connection with: (i) your access to or use of the Website; (ii) User Content provided by you or through use of your Membership; (iii) any actual or alleged violation or breach by you of these Terms of Use; (iv) any actual or alleged breach of any representation, warranty, or covenant that you have made to us; or (v) your acts or omissions. You agree to cooperate fully with us in the defense of any claim that is the subject of your obligations hereunder.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>DISCLAIMERS </strong></p>\r\n\r\n<p><strong>YOU EXPRESSLY AGREE THAT USE OF THE WEBSITE IS AT YOUR SOLE RISK. THE WEBSITE AND WEBSITE CONTENT ARE PROVIDED ON AN &quot;AS IS&quot; AND &quot;AS AVAILABLE&quot; BASIS WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED. FOXHOPR LLC DISCLAIMS ANY AND ALL WARRANTIES INCLUDING ANY: (1) WARRANTIES THAT THE WEBSITE WILL MEET YOUR REQUIREMENTS; (2) WARRANTIES CONCERNING THE AVAILABILITY, ACCURACY, SECURITY, USEFULNESS, TIMELINESS, OR INFORMATIONAL CONTENT OF THE WEBSITE OR WEBSITE CONTENT; (3) WARRANTIES OF TITLE, NON-INFRINGEMENT, MERCHANTABILITY, OR FITNESS FOR A PARTICULAR PURPOSE; (4) WARRANTIES FOR SERVICES OR GOODS RECEIVED THROUGH OR ADVERTISED ON OUR WEBSITE OR ACCESSED THROUGH THE WEBSITE; (5) WARRANTIES CONCERNING THE ACCURACY OR RELIABILITY OF THE RESULTS THAT MAY BE OBTAINED FROM THE USE OF THE WEBSITE; (6) WARRANTIES THAT YOUR USE OF THE WEBSITE WILL BE SECURE OR UNINTERRUPTED; AND (7) WARRANTIES THAT ERRORS IN THE SOFTWARE WILL BE CORRECTED. </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>LIMITATION ON LIABILITY&nbsp;&nbsp; </strong></p>\r\n\r\n<ol>\r\n	<li><strong>UNDER NO CIRCUMSTANCES SHALL FOXHOPR LLC AND ITS OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, DISTRIBUTION PARTNERS, AFFILIATES, SUBSIDIARIES AND THEIR RELATED COMPANIES BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL OR EXEMPLARY DAMAGES ARISING OUT OF, RELATING TO, OR IN ANY WAY CONNECTED WITH THE WEBSITE OR THESE TERMS OF USE. YOUR SOLE REMEDY FOR DISSATISFACTION WITH THE WEBSITE INCLUDING, WITHOUT LIMITATION, THE WEBSITE CONTENT IS TO STOP USING THE WEBSITE. SUCH LIMITATION SHALL ALSO APPLY WITH RESPECT TO DAMAGES INCURRED BY REASON OF SERVICES OR PRODUCTS RECEIVED THROUGH OR ADVERTISED IN CONNECTION WITH ANY OF THE WEBSITE OR ANY LINKS ON THE WEBSITE, AS WELL AS BY REASON OF ANY INFORMATION OR ADVICE RECEIVED THROUGH OR ADVERTISED IN CONNECTION WITH ANY OF THE WEBSITE OR ANY LINKS ON THE WEBSITE. SUCH LIMITATION SHALL ALSO APPLY WITH RESPECT TO DAMAGES INCURRED BY REASON OF ANY CONTENT POSTED BY A THIRD-PARTY OR CONDUCT OF A THIRD-PARTY ON THE WEBSITE. </strong></li>\r\n	<li><strong>NOTWITHSTANDING ANYTHING TO THE CONTRARY CONTAINED HEREIN, IN NO EVENT SHALL THE CUMULATIVE LIABILITY OF FOXHOPR LLC AND ITS OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, DISTRIBUTION PARTNERS, AFFILIATES, SUBSIDIARIES AND THEIR RELATED COMPANIES EXCEED THE GREATER OF THE TOTAL PAYMENTS RECEIVED FROM YOU BY FOXHOPR LLC DURING THE PRECEDING TWELVE (12) MONTH PERIOD OR $100. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></li>\r\n	<li>In some jurisdictions limitations of liability are not permitted. In such jurisdictions, some of the foregoing limitations may not apply to you. These limitations shall apply to the fullest extent permitted by law.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>TERMINATION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p>\r\n\r\n<ol>\r\n	<li>We reserve the right in our sole discretion and at any time to terminate or suspend your Membership and/or block your access to the Website for any reason including, without limitation if you have failed to comply with the letter and spirit of these Terms of Use. You agree that Foxhopr LLC shall not be liable to you or any third party for any termination or suspension of your Membership or for blocking your access to the Website.</li>\r\n	<li>If you become a registered user, you may terminate your Membership at &nbsp;&nbsp;&nbsp; any time by sending an e-mail to info@foxhopr.com.</li>\r\n	<li>Any suspension or termination shall not affect your obligations to us under these Terms of Use. The provisions of these Terms of Use which by their nature should survive the suspension or termination of your Membership or these Terms of Use shall survive including, but not limited to the rights and licenses that you have granted hereunder, indemnities, releases, disclaimers, limitations on liability, and provisions related to choice of law,</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>CHOICE OF LAW</strong></p>\r\n\r\n<p>These Terms of Use shall be construed in accordance with the laws of the State of New York without regard to its conflict of laws rules.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>AMENDMENT; ADDITIONAL TERMS</strong></p>\r\n\r\n<ol>\r\n	<li>We reserve the right in our sole, absolute and exclusive discretion and at any time and for any reason, to modify or discontinue any aspect or feature of the Website or to modify these Terms of Use. In addition, we reserve the right to provide you with operating rules or Additional Terms that may govern your use of the Website generally, unique parts of the Website, or both (Additional Terms). Any Additional Terms that we may provide to you will be incorporated by reference into these Terms of Use. To the extent any Additional Terms conflict with these Terms of Use, the Additional Terms will control.</li>\r\n	<li>Modifications to these Terms of Use or Additional Terms will be effective immediately upon notice, either by posting on the Website or by notification by email or conventional mail. It is your responsibility to review the Terms of Use and the Website from time to time for any changes or Additional Terms. Your access and use of any the Website following any modification of these Terms of Use or the provision of Additional Terms will signify your assent to and acceptance of the same. If you object to any subsequent revision to the Terms of Use or to any Additional Terms, you may terminate your Membership as provided in Section X herein or, if you do not have an Membership, your only recourse is to immediately discontinue use of the Website.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>MISCELLANEOUS</strong></p>\r\n\r\n<ol>\r\n	<li>Any delay or failure on the part of us to exercise or enforce any rights under &nbsp;these Terms of Use to which we may be entitled shall not, in any event, be construed as a waiver of the right and privilege to do so at any subsequent time. You irrevocably agree that you waive any and all rights to injunctive or other equitable relief. The section headings used herein are for convenience only and shall not be given any legal import. If any provision of these Terms of Use is held to be invalid or unenforceable, the invalidity of such provision shall not affect the validity of the remaining provisions of the Terms of Use, which shall remain in full force and effect.</li>\r\n	<li>These Terms of Use (including the Privacy Policy and any Additional Terms incorporated by reference) constitute the entire agreement of the parties with respect to the subject matter hereof, and supersede all previous written or oral agreements between us with respect to such subject matter.</li>\r\n	<li>You may not assign these Terms of Use or assign any rights or delegate any obligations hereunder, in whole or in part, without our prior written consent. Any such purported assignment or delegation by you without the appropriate prior written consent will be null and void and of no force and effect.&nbsp;</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>PRIVACY STATEMENT</strong></p>\r\n\r\n<ol>\r\n	<li>When accessing our Website, Foxhopr LLC will learn certain information about you during your visit. How we will handle information we learn about you depends upon what you do when visiting our site. If you visit our site to read or download information on our pages, we collect and store only the following information about you:</li>\r\n</ol>\r\n\r\n<ul>\r\n	<li>The name of the domain from which you access the Internet;</li>\r\n	<li>The date and time you access our site; and</li>\r\n	<li>The Internet address of the Web site you used to link directly to our site.</li>\r\n</ul>\r\n\r\n<ol>\r\n	<li>If you identify yourself by sending us an e-mail containing personal information, then the information collected will be solely used to respond to your message. The information collected is for statistical purposes. FOXHOPR LLC uses software programs to create summary statistics, which are used for such purposes as assessing the number of visitors to the different sections of our site, what information is of most and least interest, determining technical design specifications, and identifying system performance or problem areas.</li>\r\n	<li>For site security purposes and to ensure that this service remains available to all &nbsp;&nbsp;&nbsp;&nbsp; users, Foxhopr LLC uses software programs to monitor network traffic to identify unauthorized attempts to upload or change information, or otherwise cause damage. Foxhopr LLC will not obtain personally-identifying information about you when you visit our site, unless you choose to provide such information to us, nor will such information be sold or otherwise transferred to unaffiliated third parties without the approval of the user at the time of collection.</li>\r\n</ol>\r\n\r\n<p><strong>California Privacy Rights </strong></p>\r\n\r\n<p>Residents of the State of California, under certain provisions of the California Civil Code, have the right to request from companies conducting business in California a list of all third parties to which the company has disclosed certain personally identifiable information as defined under California law during the preceding year for third party direct marketing purposes. You are limited to one request per calendar year. In your request, please attest to the fact that you are a California resident and provide a current California address for our response. You may request the information in writing at: Foxhopr, LLC, P.O. Box 1859, New York, NY , 10010 and info@foxhopr.com.</p>\r\n\r\n<p><strong>Third Party Ad Server Networks</strong></p>\r\n\r\n<p>The Website may use third parties such as network advertisers to serve advertisements on the Website and may use traffic measurement services to analyze traffic on the Website. Network advertisers are third parties that display advertisements based on your visits to the Website and other Websites you have visited. Third-party ad serving enables us to target advertisements to you for products and services in which you might be interested. The Website&#39;s third party ad network providers, the advertisers, the sponsors and/or traffic measurement services may themselves set and access their own cookies on your computer if you choose to have cookies enabled in your browser and track certain behavioral information regarding users of your computer via a Device Identifier. These third party cookies are set to, among other things: (a) help deliver advertisements to you that you might be interested in; (b) prevent you from seeing the same advertisements too many times; and (c) understand the usefulness to you of the advertisements that have been delivered to you. Note that any images (or any other parts of a web page) served by third parties in association with third party cookies may serve as web beacons, which enable third parties to carry out the previously described activities. Third party cookies and web beacons are governed by each third party&#39;s specific privacy policy, not this one.</p>\r\n\r\n<p><strong>Public Forums</strong></p>\r\n\r\n<p>We may offer chat rooms, message boards, bulletin boards, or similar public forums where you and other users of our Website can communicate. The protections described in this Privacy Policy do not apply when you provide information (including personal information) in connection with your use of these public forums. We may use personally identifiable and non-personal information about you to identify you with a posting in a public forum. Any information you share in a public forum is public information and may be seen or collected by anyone, including third parties that do not adhere to our Privacy Policy. We are not responsible for events arising from the distribution of any information you choose to publicly post or share through our Website.</p>\r\n\r\n<p><strong>Keeping Your Information Secure</strong></p>\r\n\r\n<p>We have implemented security measures we consider reasonable and appropriate to protect against the loss, misuse and alteration of the information under our control. Please be advised, however, that while we strive to protect your personally identifiable information and privacy, we cannot guarantee or warrant the security of any information you disclose or transmit to us online and are not responsible for the theft, destruction, or inadvertent disclosure of your personally identifiable information. In the unfortunate event that your &quot;personally identifiable information&quot; (as the term or similar terms are defined by any applicable law requiring notice upon a security breach) is compromised, we may notify you by e-mail (at our sole and absolute discretion) to the last e-mail address you have provided us in the most expedient time reasonable under the circumstances; provided, however, delays in notification may occur while we take necessary measures to determine the scope of the breach and restore reasonable integrity to the system as well as for the legitimate needs of law enforcement if notification would impede a criminal investigation. From time to time we evaluate new technology for protecting information, and when appropriate, we upgrade our information security systems.</p>\r\n\r\n<p><strong>Other Sites; Links</strong></p>\r\n\r\n<p>Our Website may link to or contain links to other third party Websites that we do not control or maintain, such as in connection with purchasing products referenced on our Website and banner advertisements. We are not responsible for the privacy practices employed by any third party Website. We encourage you to note when you leave our Website and to read the privacy statements of all third party Websites before submitting any personally identifiable information.</p>\r\n\r\n<p><strong>Contact and Opt-Out Information</strong></p>\r\n\r\n<p>You may contact us as at info@foxhopr.com if: (a) you have questions or comments about our Privacy Policy; (b) wish to make corrections to any personally identifiable information you have provided; (c) want to opt-out from receiving future commercial correspondence, including emails, from us or our affiliated companies; or (d) wish to withdraw your consent to sharing your personally identifiable information with others. We will respond to your request and, if applicable and appropriate, make the requested change in our active databases as soon as reasonably practicable. Please note that we may not be able to fulfill certain requests while allowing you access to certain benefits and features of our Website.</p>\r\n\r\n<p><strong>Sole Statement</strong></p>\r\n\r\n<p>This Privacy Policy as posted on this Website is the sole statement of our &nbsp;&nbsp; privacy policy with respect to this Website, and no summary, modification, restatement or other version thereof, or other privacy statement or policy, in any &nbsp; form, is valid unless we post a new or revised policy to the Website.</p>\r\n\r\n<p><strong>Illegality </strong></p>\r\n\r\n<p>If any provision of this Terms of Use shall be determined by the arbitrators or any Court having jurisdiction, to be invalid, illegal or unenforceable, the remainder of this Terms of Use shall not be affected thereby, but shall continue in full force and effect as though such invalid, illegal or unenforceable provision or provisions were not originally a part hereof.</p>\r\n\r\n<p><strong>Waiver</strong></p>\r\n\r\n<p>No waiver or modification of any of the provisions of this Terms of Use or any of the rights or remedies of the parties hereto shall be valid unless such change is in writing, signed by the party to be charged therewith. No waiver of any of the provisions of this Terms of Use shall be deemed a waiver of any other provision.</p>\r\n\r\n<p><strong>Arbitration </strong></p>\r\n\r\n<p>Any claim or controversy arising among or between the parties hereto pertaining to the Website, or any claim or controversy arising out of or respecting any matter contained in this Terms of Use or any differences as to the interpretation or performance of any of the provisions of this Terms of Use shall be settled by arbitration in [specify location] before three arbitrators of the American Arbitration Association under its then prevailing rules. In any arbitration involving this Terms of Use, the arbitrators shall not make any award which will alter, change, cancel or rescind any provision of this Terms of Use, and their award shall be consistent with the provisions of this Terms of Use. Any such arbitration must be commenced no later than one (1) year from the date such claim or controversy arose, or such claim shall be deemed to have been waived. The award of the arbitrators shall be final and binding and judgment may be entered thereon in any court of competent jurisdiction.</p>\r\n\r\n<p><strong>Headings&nbsp; </strong></p>\r\n\r\n<p>Headings in this Terms of Use are for convenience only and shall not be used to interpret or construe its provisions.</p>\r\n', NULL, 'Terms Page, Conditions Page', 'meta description goes here', '2015-04-20 11:45:12', '2016-03-28 03:45:41'),
(4, 'FAQ', 'faq', '<>', '<p>Q1: How to login?</p>\r\n\r\n<p>Ans:</p>\r\n', NULL, 'foxhopr; business portal; meetings;', 'Forxhopr meta tag description goes here, test', '2015-04-20 11:45:32', '2015-05-03 12:45:59');

-- --------------------------------------------------------

--
-- Table structure for table `professions`
--

CREATE TABLE `professions` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(10) NOT NULL,
  `profession_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_user_id` int(11) NOT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `professions`
--

INSERT INTO `professions` (`id`, `category_id`, `profession_name`, `is_active`, `created_user_id`, `modified_user_id`, `created`, `modified`) VALUES
(1, 1, 'Analyst', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:35'),
(2, 1, 'Auditor', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:35'),
(3, 1, 'Bookkeeper', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(4, 1, 'Budget Analyst', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(5, 1, 'Claims Adjustor', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(6, 1, 'Compliance Officer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(7, 1, 'Controller', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(8, 1, 'Cost Estimator', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(9, 1, 'CPA', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(10, 1, 'Tax Specialist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(11, 1, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(12, 2, 'Account Executive', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(13, 2, 'Brand Marketer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(14, 2, 'Copywriter', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(15, 2, 'Creative', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(16, 2, 'Digital', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(17, 2, 'Direct Mail', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(18, 2, 'Online Advertising', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(19, 2, 'Media Planner / Buyer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(20, 2, 'Producer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(21, 2, 'Project Manager', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(22, 2, 'Radio', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(23, 2, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:36'),
(24, 2, 'Search Engine Optimization', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(25, 2, 'Social Media', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(26, 2, 'Television Advertising', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(27, 2, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(28, 3, 'Alterations / Tailoring', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(29, 3, 'Clothing Retail', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(30, 3, 'Custom Apparel', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(31, 3, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(32, 4, 'Manufacturing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(33, 4, 'Repair', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(34, 4, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(35, 5, 'Antiques', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(36, 5, 'Business', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(37, 5, 'Estate', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(38, 5, 'Real Estate', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(39, 6, 'Architect - Commercial', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(40, 6, 'Architect - Government', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(41, 6, 'Architect - Industrial', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(42, 6, 'Architect - Landscape', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:37'),
(43, 6, 'Architect - Residential', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:38'),
(44, 6, 'CAD Designer / Drafter', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:38'),
(45, 6, 'Design - Green', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:38'),
(46, 6, 'Design - Interior', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:38'),
(47, 6, 'Engineer - Mechanical', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:38'),
(48, 6, 'Engineer - Environmental', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:38'),
(49, 6, 'Engineer - Aerospace & Aeronautics', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:38'),
(50, 6, 'Engineer - Structural', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:38'),
(51, 6, 'Engineer - Civil', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:38'),
(52, 6, 'Engineer - Geotechnical', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:38'),
(53, 7, 'Antiques', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:38'),
(54, 7, 'Art Gallery', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:38'),
(55, 7, 'Artist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:38'),
(56, 7, 'Picture Framing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(57, 7, 'Restoration', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(58, 7, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(59, 7, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(60, 8, 'Photographer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(61, 8, 'Voice-Over Artist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(62, 8, 'DJ', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(63, 8, 'Magician', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(64, 8, 'Musician', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(65, 8, 'Actor', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(66, 8, 'Cinemtaographer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(67, 8, 'Director', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(68, 8, 'Producer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(69, 9, 'Auctioneer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(70, 9, 'Organizer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(71, 10, 'Audio and Video Equipment ', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(72, 10, 'Audio Engineer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(73, 10, 'Composer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(74, 10, 'Editor Advertising', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(75, 10, 'Editor Film', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:39'),
(76, 10, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(77, 11, 'Auto Mechanic', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(78, 11, 'Auto Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(79, 11, 'Body Shop', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(80, 11, 'Detailing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(81, 11, 'Glass', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(82, 11, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(83, 11, 'Service/Rapair', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(84, 12, 'Analyst', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(85, 12, 'Asset Management', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(86, 12, 'Auditor', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(87, 12, 'Brokersage Services', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(88, 12, 'Business Loan', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(89, 12, 'Capital Risk', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(90, 12, 'Commerical Lender', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(91, 12, 'Compliance Officer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(92, 12, 'Consultant', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(93, 12, 'Credit Officer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:40'),
(94, 12, 'Credit Risk Analyst', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(95, 12, 'Financial Advisor', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(96, 12, 'Financial Advisor', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(97, 12, 'Financial Analyst', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(98, 12, 'Financial Analyst', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(99, 12, 'Investment Banker', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(100, 12, 'Investment Banker', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(101, 12, 'Mortage Loan', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(102, 12, 'Personal Banker', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(103, 12, 'Personal Finance Advisor', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(104, 12, 'Personal Loan', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(105, 12, 'Portfolio Strategist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(106, 12, 'Private Wealth Relationship Manager', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(107, 12, 'Retail Mortgage Banker', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(108, 12, 'Risk Officer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(109, 12, 'Trader', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(110, 12, 'Underwriter', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(111, 12, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(112, 13, 'Building Materials', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:41'),
(113, 14, 'Repair', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(114, 14, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(115, 14, 'Manufacturing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(116, 14, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(117, 15, 'Concierge', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(118, 16, 'Civic', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(119, 16, 'Commercial', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(120, 16, 'Construction Manager', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(121, 16, 'Cost Estimator', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(122, 16, 'Project Manager', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(123, 16, 'Residential', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(124, 16, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(125, 16, 'Trade - Boiler Mechanic', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(126, 16, 'Trade - Building Inspector', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(127, 16, 'Trade - Carpenter', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(128, 16, 'Trade - Carpet Layer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(129, 16, 'Trade - Cement Mason / Terrazzo', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(130, 16, 'Trade - Claning Air Ducts', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(131, 16, 'Trade - Demolition', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(132, 16, 'Trade - Electrician', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(133, 16, 'Trade - Elevator Mechanic', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:42'),
(134, 16, 'Trade - Excavation', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(135, 16, 'Trade - Fences & Decks', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(136, 16, 'Trade - Fire Protections', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(137, 16, 'Trade - Glazier', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(138, 16, 'Trade - Handyman', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(139, 16, 'Trade - Hazardous Materials Removal', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(140, 16, 'Home Inspector', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(141, 16, 'Trade - Landscaper', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(142, 16, 'Trade - Marble', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(143, 16, 'Trade - Mason', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(144, 16, 'Trade - Painter', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(145, 16, 'Trade - Paving', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(146, 16, 'Trade - Plasterer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(147, 16, 'Trade - Plumber', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(148, 16, 'Trade - Roofer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(149, 16, 'Trade - Siding', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:43'),
(150, 16, 'Trade - Tile Installer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(151, 16, 'Trade - Welder', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(152, 16, 'Trade - Windows', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(153, 16, 'Trade - Wood Flooring', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(154, 16, 'Trade - Woodworker', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(155, 16, 'Trade - HVAC', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(156, 16, 'Trade - Stone & Marble', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(157, 16, 'Trade - Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(158, 16, 'Trade - Wallpaper & Wallcovering', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(159, 17, 'Business Operations Manager', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(160, 17, 'Management', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(161, 17, 'Market Research Analyst', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(162, 17, 'Marketing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(163, 18, '3D Animation', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(164, 18, 'Animation', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(165, 18, 'Banner Ads', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(166, 18, 'Brochures & Presentations', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(167, 18, 'Cartoons & Comics', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(168, 18, 'Design Project Management', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(169, 18, 'Digital Image Editing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(170, 18, 'Emails & Newsletters', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:44'),
(171, 18, 'Graphic Design', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(172, 18, 'Illustration', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(173, 18, 'Label & Package Design', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(174, 18, 'Logos', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(175, 18, 'Mobile Design', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(176, 18, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(177, 18, 'Page & Book Design', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(178, 18, 'Videos', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(179, 18, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(180, 19, 'Tutor', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(181, 19, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(182, 20, 'Equipment Leasing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(183, 20, 'Equipment Repair', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(184, 20, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(185, 21, 'Solar', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(186, 22, 'Air Monitoring', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(187, 22, 'Asbestos Abatement', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(188, 22, 'Asbestos Removal', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(189, 22, 'Mold Inspection Removal', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(190, 22, 'Oil & Gas', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:45'),
(191, 22, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:46'),
(192, 23, 'Event Planner', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:46'),
(193, 23, 'Wedding Planner', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:46'),
(194, 23, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:46'),
(195, 24, 'Cleaning', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:46'),
(196, 24, 'Maintenance', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:46'),
(197, 24, 'Management', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:46'),
(198, 25, 'Curator', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:46'),
(199, 26, 'Baker', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:46'),
(200, 26, 'Caterer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:46'),
(201, 26, 'Chef', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:46'),
(202, 26, 'Wine Maker', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:46'),
(203, 26, 'Chef - Personal', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:46'),
(204, 26, 'Manufacturing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(205, 26, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(206, 26, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(207, 27, 'Design', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(208, 27, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(209, 27, 'Manufacturing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(210, 27, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(211, 28, 'Animation', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(212, 28, 'Creative Director', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(213, 28, 'Developer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(214, 28, 'Engineer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(215, 28, 'Game Design', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(216, 28, 'Producer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(217, 28, 'Product Manager', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(218, 28, 'Programmer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(219, 28, 'Quality Control', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(220, 28, 'Technical Artist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:47'),
(221, 28, 'Testing Q & A', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:48'),
(222, 28, 'Writing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:48'),
(223, 28, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:48'),
(224, 28, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:48'),
(225, 29, 'Medical Secretary', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:48'),
(226, 29, 'Paramedic', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:48'),
(227, 29, 'Pharmacist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:48'),
(228, 29, 'Accupuncturist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:48'),
(229, 29, 'Chiropractor', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:48'),
(230, 29, 'Dental Assistant', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:48'),
(231, 29, 'Dental Hygienist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:48'),
(232, 29, 'Dietician', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:48'),
(233, 29, 'Fitness Trainer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:48'),
(234, 29, 'Geriatric Personal Care Aide', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(235, 29, 'Health Care Facility', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(236, 29, 'Aide - Home Health', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(237, 29, 'Aide - Hospice', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(238, 29, 'Massage Therapist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(239, 29, 'Nurse', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(240, 29, 'Nutritionist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(241, 29, 'Occupational Therapist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(242, 29, 'Optician', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(243, 29, 'Physical Therapist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(244, 29, 'Retirement Community', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(245, 29, 'Speech Language Therapist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(246, 29, 'Substance Abuse Counselor', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(247, 29, 'Yoga Instructor', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(248, 30, 'HR - Compensation & Benefits', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(249, 30, 'HR - Generalist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(250, 30, 'Payroll Services', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(251, 30, 'HR - Training & Development', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:49'),
(252, 30, 'HR - Recruitment & Placement', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(253, 30, 'HR - HRIS Analyst', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(254, 30, 'HR - Labor Relations', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(255, 31, 'Insurance Appraiser', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(256, 31, 'Residential Insurance Inspector', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(257, 32, 'Life & Health', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(258, 32, 'Property & Casualty', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(259, 33, '3D Animator', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(260, 33, 'IT - Computer Hardware Engineer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(261, 33, 'IT - Computer Network Architect', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(262, 33, 'IT - Data Analysis', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(263, 33, 'IT - Data Engineering', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(264, 33, 'IT - Data Science', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(265, 33, 'IT - Database Development', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(266, 33, 'IT - Databe Adminisration', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(267, 33, 'IT - Developer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(268, 33, 'IT - Engineer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(269, 33, 'IT - Network Analyst', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(270, 33, 'IT - Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(271, 33, 'IT - Programmer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:50'),
(272, 33, 'IT - Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(273, 33, 'IT - Security', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(274, 33, 'IT - Software Engineer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(275, 33, 'IT - System Administrator', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(276, 33, 'IT - Technical Support', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(277, 33, 'IT - Training', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(278, 33, 'Mobile - Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(279, 33, 'Mobile - Developer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(280, 33, 'Mobile - Product Designer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(281, 33, 'Mobile - Project Manager', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(282, 33, 'Mobile - Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(283, 33, 'Mobile - Testing Q&A', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(284, 33, 'Mobile - User Experience & Design', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(285, 33, 'Mobile - Graphic Designer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(286, 33, 'Website - Consulting', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(287, 33, 'Website - Creative Director', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(288, 33, 'Website - Developer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(289, 33, 'Website - Graphic Designer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(290, 33, 'Website - Interactive Designer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(291, 33, 'Website - Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(292, 33, 'Website - Product Manager', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(293, 33, 'Website - Programming', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:51'),
(294, 33, 'Website - Project Manager', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(295, 33, 'Website - Search Engine Optimization', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(296, 34, 'Attorney - ADA ', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(297, 34, 'Attorney - Adoption ', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(298, 34, 'Attorney - Antitrust ', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(299, 34, 'Attorney - Appellate ', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(300, 34, 'Attorney - Arbitration ', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(301, 34, 'Attorney - Bankruptcy', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(302, 34, 'Attorney - Business & Corporate', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(303, 34, 'Attorney - Civil Rights', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(304, 34, 'Attorney - Class Action', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(305, 34, 'Attorney - Construction', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(306, 34, 'Attorney - Copyright', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(307, 34, 'Attorney - Criminal Defense', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(308, 34, 'Attorney - Discrminiation', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(309, 34, 'Attorney - DUI Attorney', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(310, 34, 'Attorney - Employment', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(311, 34, 'Attorney - Entertainment', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(312, 34, 'Attorney - Environmental', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(313, 34, 'Attorney - Family & Divorce', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:52'),
(314, 34, 'Attorney - General Practice', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(315, 34, 'Attorney - Government', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(316, 34, 'Attorney - Imimigration', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(317, 34, 'Attorney - Insurance', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(318, 34, 'Attorney - Litigation', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(319, 34, 'Attorney - Medical Malpractice', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(320, 34, 'Attorney - Mergers, Acquisition and Divestitures', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(321, 34, 'Attorney - Military', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(322, 34, 'Attorney - Non-Profit', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(323, 34, 'Attorney - Patent', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(324, 34, 'Attorney - Personal Injury', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(325, 34, 'Attorney - Real Estate', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(326, 34, 'Attorney - Tax', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(327, 34, 'Attorney - Tort', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(328, 34, 'Attorney - Trial', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(329, 34, 'Attorney - Wills & Probate', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(330, 34, 'Paralegal', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(331, 34, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(332, 35, 'Logistics & Supply Chain', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(333, 36, 'Management Consulting', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:53'),
(334, 37, 'CD / DVD Replication', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(335, 38, 'Manufacturing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(336, 38, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(337, 38, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(338, 39, 'Therapist - Marriage', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(339, 39, 'Therapist - Couples', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(340, 39, 'Counselor - Grief', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(341, 39, 'Counselor - Mental Health', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(342, 39, 'Psychoanalyst', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(343, 39, 'Social Worker', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(344, 39, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(345, 39, 'Therapist - Family', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(346, 40, 'Credit Card Processing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(347, 41, 'Manufacturing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(348, 41, 'Repair', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(349, 41, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(350, 42, 'Fund-Raising', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(351, 42, 'Management', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:54'),
(352, 43, 'Cabinet & Closet Organizer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(353, 43, 'Personal Organizer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(354, 44, 'Package / Freight Delivery', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(355, 45, 'Manufacturing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(356, 45, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(357, 46, 'Manufacturing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(358, 46, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(359, 47, 'Orthodontist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(360, 47, 'Allergist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(361, 47, 'Anestegiology', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(362, 47, 'Cardiologist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(363, 47, 'Dentist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(364, 47, 'Dermatologist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(365, 47, 'Endorcinologist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(366, 47, 'ENT', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(367, 47, 'Gastroenterologist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(368, 47, 'General Fmaily', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(369, 47, 'Gynecologist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(370, 47, 'Immunologist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(371, 47, 'Ineternal Medicine', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(372, 47, 'Infectious Disease', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:55'),
(373, 47, 'Neurologist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(374, 47, 'Newrosurgeon', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(375, 47, 'Obstetrician', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(376, 47, 'Oncologist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(377, 47, 'Pediatriaican', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(378, 47, 'Physiologist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(379, 47, 'Plastic Surgeon', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(380, 47, 'Plastic Surgeon', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(381, 47, 'Podiawtrist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(382, 47, 'Psychiatrist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(383, 47, 'Radiologist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(384, 47, 'Rheumatologist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(385, 47, 'Orthopedist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(386, 47, 'Surgeon', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(387, 47, 'Urologist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:56'),
(388, 48, 'Printing Services', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:57'),
(389, 49, 'Coach - Business', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:57'),
(390, 49, 'Coach - Career', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:57'),
(391, 49, 'Coach - Leadership Development', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:57'),
(392, 49, 'Coach - Personal Life', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:57'),
(393, 49, 'Credit Counselor', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:57'),
(394, 49, 'Dance', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:58'),
(395, 50, 'Promotional products', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:58'),
(396, 51, 'Publicist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:58'),
(397, 52, 'Book', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:58'),
(398, 52, 'Digital', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:58'),
(399, 52, 'Magazines', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:58'),
(400, 52, 'Newspapers', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:58'),
(401, 53, 'Property Developemnt', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:58'),
(402, 53, 'Property Management', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:58'),
(403, 53, 'Real Estate Agent', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:58'),
(404, 53, 'Title & Escrow', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:58'),
(405, 53, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:58'),
(406, 54, 'Executive Search', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:58'),
(407, 55, 'Medical Equipment Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:58'),
(408, 55, 'Office Equipment Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(409, 55, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(410, 55, 'Sales Manager', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(411, 56, 'Private Eye', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(412, 56, 'Security Systems', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(413, 56, 'Security Guard', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(414, 57, 'Data Entry', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(415, 57, 'Personal Assistant', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(416, 57, 'Archivist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(417, 57, 'Au Pair', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(418, 57, 'Auctioneer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(419, 57, 'Bicycle Mechanic', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(420, 57, 'Bill Collector', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(421, 57, 'Boats', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(422, 57, 'Cab Driver', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(423, 57, 'Chauffeur', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(424, 57, 'Cleaning Carpet / Upholsetry', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(425, 57, 'Clothing Pattern Maker', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:52:59'),
(426, 57, 'Collection Agency', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(427, 57, 'Credit Checker', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(428, 57, 'Exterminator', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(429, 57, 'Faux Painting', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(430, 57, 'Florist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(431, 57, 'Flower Arranger', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(432, 57, 'Funeral Planning Services', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(433, 57, 'Gift Baskets', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(434, 57, 'House Cleaner', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(435, 57, 'Interpreter', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(436, 57, 'Loan Officer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(437, 57, 'Locksmith', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(438, 57, 'Relocation Services', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(439, 57, 'Residential Cleaning', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(440, 57, 'Restoration', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(441, 57, 'Sign Makers', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(442, 57, 'Storage Company', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(443, 57, 'Tattoo Artist', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(444, 57, 'Travel Agent', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(445, 57, 'Window Treatments', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(446, 57, 'Wireless Serivce (Cellular)', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(447, 58, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(448, 59, 'Manufacturer', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:00'),
(449, 60, 'Executive Search', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(450, 61, 'Manufacturing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(451, 61, 'Repair', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(452, 61, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(453, 62, 'Manufacturing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(454, 62, 'Sales', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(455, 63, 'Transcription', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(456, 64, 'Moving Company', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(457, 65, 'Ventura Capital', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(458, 66, 'Animal Products', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(459, 66, 'Day Care', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(460, 66, 'Grooming', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(461, 66, 'Pet Sitting', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(462, 66, 'Veterinarian', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(463, 66, 'Walking', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(464, 67, 'Warehousing', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(465, 68, 'Writer - Blog', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(466, 68, 'Content Manager', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(467, 68, 'Writer - Copywriter', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(468, 68, 'Editor', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:01'),
(469, 68, 'Writer - Grant', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:02'),
(470, 68, 'Other', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:02'),
(471, 68, 'Writer - Press Release', 0, 0, NULL, '0000-00-00 00:00:00', '2016-03-03 00:49:31'),
(472, 68, 'Writer - Report', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:02'),
(473, 68, 'Writer - Script', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:02'),
(474, 68, 'Writer - Speeches', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:02'),
(475, 68, 'Writer - Sports', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:02'),
(476, 68, 'Writer - Technical', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:02'),
(477, 68, 'Translation', 0, 0, NULL, '0000-00-00 00:00:00', '2016-02-17 02:53:02'),
(489, 11, 'Racer', 0, 0, NULL, '2016-06-08 09:47:09', '2016-06-12 10:56:33'),
(490, 11, 'Mechanic', 0, 0, NULL, '2016-06-08 09:51:14', '2016-06-12 10:56:34'),
(493, 19, 'testeducation', 0, 0, NULL, '2016-06-08 10:18:32', '2016-06-12 10:56:34'),
(499, 70, 'Commerial pilot', 0, 0, NULL, '2016-06-09 05:29:44', '2016-06-12 10:56:35'),
(501, 70, 'Fighter Jet Pilot', 0, 0, NULL, '2016-06-09 05:40:13', '2016-06-12 10:56:35'),
(506, 70, 'Passenger Jet Pilot', 0, 0, NULL, '2016-06-09 08:58:05', '2016-06-12 10:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `profession_categories`
--

CREATE TABLE `profession_categories` (
  `id` int(10) NOT NULL,
  `name` varchar(35) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profession_categories`
--

INSERT INTO `profession_categories` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Accounting', '2016-03-03 16:20:01', '0000-00-00 00:00:00'),
(2, 'Advertising & Marketing', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Apparel & Fashion', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Appliance', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Appraisals', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Architecture, Engineering & Plannin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Art', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Arts & Entertainment', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Auctions', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Audio & Video', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Automotive', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Banking & Financial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Building Materials', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Business Supplies & Equipment', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Concierge', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Construction & General Contracting', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Consulting', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Design & Multimedia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Education', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Electronics', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Energy & Fuel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Environmental', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Events', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Facilities Services', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Fine Arts', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Food & Beverage', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Furniture & Home Furnishings', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Gaming', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Health & Wellness', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Human Resources & Payroll', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Insurance Inspection', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Insurance Sales', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'IT, Web & Mobile', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Legal Services', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Logistics & Supply Chain', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Management Consulting', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Media', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Medical Devices', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Mental Health', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Merchant Services', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Musical Instruments', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Non-Profit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Organizing Professional', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Package / Freight Delivery', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Packaging & Containers', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Paper Products', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Physican', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Printing Services', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Professional Training & Coaching', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Promotional products', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Public Relations & Communication', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Publishing', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Real Estate', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Recruiting', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Sales', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Security & Investigations', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Services', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Software', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Sporting Goods', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Staffing & Recruiting', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Telecommunications', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Textiles', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Transcription', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Trucking', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Venture Capital', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'Veterinary, Animals & Pets', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'Warehousing', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Writing & Translation', '0000-00-00 00:00:00', '2016-03-03 06:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `key_name` varchar(20) NOT NULL,
  `key_value` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key_name`, `key_value`) VALUES
(1, 'shuffling_criteria', '90:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `fname` varchar(256) NOT NULL,
  `lname` varchar(256) NOT NULL,
  `username` varchar(80) NOT NULL,
  `user_email` varchar(80) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `user_email`, `password`, `phone`, `created`, `modified`) VALUES
(1, '', '', 'Admin', 'admin@foxhopr.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', NULL, '2016-02-15 04:27:55'),
(115, '', '', 'ipadist@mailimate.com', 'ipadist@mailimate.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-10 06:35:38', '2016-06-10 06:01:01'),
(116, '', '', 'nexusest@mailimate.com', 'nexusest@mailimate.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-10 06:37:37', '2016-06-10 06:16:33'),
(117, '', '', 'motobst@mailimate.com', 'motobst@mailimate.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-10 06:42:25', '2016-06-10 06:16:04'),
(118, '', '', 'webaest@mailimate.com', 'webaest@mailimate.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-10 06:46:30', '2016-06-10 06:06:10'),
(119, '', '', 'demoios@mailimate.com', 'demoios@mailimate.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-10 10:19:43', '2016-06-10 04:52:22'),
(120, '', '', 'demoandroid@mailimate.com', 'demoandroid@mailimate.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-10 10:21:25', '2016-06-10 07:18:24'),
(121, '', '', 'utkarsh.singh@a3logics.in', 'utkarsh.singh@a3logics.in', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-10 13:13:42', '2016-06-12 02:12:14'),
(122, '', '', 'rohan.julka@a3logics.in', 'rohan.julka@a3logics.in', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-11 06:16:53', '2016-06-11 00:46:58'),
(123, '', '', 'ab@mailinator.com', 'ab@mailinator.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-11 07:44:26', '2016-06-11 02:14:31'),
(124, '', '', 'mailer@mailinator.com', 'mailer@mailinator.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-11 07:53:59', '2016-06-11 02:25:21'),
(125, '', '', 'queue@mailinator.com', 'queue@mailinator.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-11 07:56:30', '2016-06-11 02:26:34'),
(126, '', '', 'minus1@mailinator.com', 'minus1@mailinator.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-11 08:46:50', '2016-06-11 04:08:42'),
(127, '', '', 'gt1@mailinator.com', 'gt1@mailinator.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-11 09:42:38', '2016-06-11 04:18:11'),
(128, '', '', 'gp2@mailinator.com', 'gp2@mailinator.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-11 09:47:21', '2016-06-11 04:17:27'),
(129, '', '', 'gt3@mailinator.com', 'gt3@mailinator.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-11 09:52:02', '2016-06-11 04:25:22'),
(130, '', '', 'gp4@mailinator.com', 'gp4@mailinator.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-11 09:56:50', '2016-06-11 04:26:55'),
(131, '', '', 'q10@m.com', 'q10@m.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-12 08:44:12', '2016-06-12 03:14:17'),
(132, '', '', 'story4114@mail.com', 'story4114@mail.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-12 10:47:36', '2016-06-12 05:17:42'),
(133, '', '', 'harry@mailimate.com', 'harry@mailimate.com', 'bf1f135e2cf4440ddd4b4c209d9bb319206a406a', '', '2016-06-12 11:14:42', '2016-06-12 05:44:46'),
(137, 'Nancy', '', 'bhanu34@mailinator.com', 'bhanu34@mailinator.com', '', '9950162420', '2016-06-13 05:22:31', '2016-12-26 12:17:51'),
(138, 'rohan', 'julka', 'estt', 'tesutttttttttyuyt@gmail.com', '123456789', '9950162420', '2016-12-23 03:33:49', '2016-12-22 22:03:49'),
(139, 'Nancy', 'julka', 'test', 'tesutttttttttyuyt@gmail.com', 'edc1953d939fbbe667fadd6342fab1c0b5bf7bd7', '9950162420', '2016-12-23 03:38:40', '2016-12-22 22:16:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_masters`
--
ALTER TABLE `email_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index` (`profession_name`);

--
-- Indexes for table `profession_categories`
--
ALTER TABLE `profession_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `email_masters`
--
ALTER TABLE `email_masters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `professions`
--
ALTER TABLE `professions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=507;
--
-- AUTO_INCREMENT for table `profession_categories`
--
ALTER TABLE `profession_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
