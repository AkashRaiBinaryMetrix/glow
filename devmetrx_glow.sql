-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 24, 2022 at 07:35 PM
-- Server version: 10.1.48-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devmetrx_glow`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `is_deleted` enum('y','n') NOT NULL DEFAULT 'n',
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `image`, `status`, `is_deleted`, `created_at`) VALUES
(1, 'Celebrating', 'images/activity-ico-1.png', '1', 'n', NULL),
(2, 'Watching', 'images/activity-ico-2.png', '1', 'n', NULL),
(3, 'Worshiping', 'images/activity-ico-3.png', '1', 'n', NULL),
(4, 'Praying', 'images/activity-ico-4.png', '1', 'n', NULL),
(5, 'Attending', 'images/activity-ico-5.png', '1', 'n', NULL),
(6, 'Travelling to', 'images/activity-ico-6.png', '1', 'n', NULL),
(7, 'Listening to', 'images/activity-ico-7.png', '1', 'n', NULL),
(8, 'Looking for', 'images/activity-ico-8.png', '1', 'n', NULL),
(9, 'Thinking about', 'images/activity-ico-9.png', '1', 'n', NULL),
(10, 'Reading', 'images/activity-ico-10.png', '1', 'n', NULL),
(11, 'Playing', 'images/activity-ico-11.png', '1', 'n', NULL),
(12, 'Supporting', 'images/activity-ico-12.png', '1', 'n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `short_description` varchar(250) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `is_deleted` enum('y','n') NOT NULL DEFAULT 'n',
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `short_description`, `status`, `is_deleted`, `created_at`) VALUES
(1, 'banner-1.jpg', 'Sharing spiritual testimony of God’s grace and mercy through God’s Luving Own Words glowteam.org', '1', 'n', '2022-08-11 16:49'),
(2, 'banner-2.jpg', 'Sharing spiritual testimony of God’s grace and mercy through God’s Luving Own Words glowteam.org', '1', 'n', '2022-07-17 19:03'),
(3, 'banner-3.jpg', 'Sharing spiritual testimony of God’s grace and mercy through God’s Luving Own Words glowteam.org', '1', 'n', '2022-07-17 19:03');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` int(11) NOT NULL,
  `meta_title` text,
  `meta_description` text,
  `meta_keyword` text,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `long_description` text NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'n',
  `is_deleted` enum('y','n') NOT NULL DEFAULT 'n',
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `meta_title`, `meta_description`, `meta_keyword`, `title`, `slug`, `short_description`, `long_description`, `status`, `is_deleted`, `created_at`) VALUES
(1, NULL, NULL, NULL, 'About Us', 'about-us', 'About Us', '<p>About Us</p>', '1', 'n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `insprational_feed_id` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `comment` text,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `insprational_feed_id`, `parent_id`, `comment`, `created_at`) VALUES
(1, '1', '1', NULL, 'This is first comment on this post', '2022-07-27 18:43'),
(2, '1', '1', '1', 'I like your comment', '2022-07-27 18:52'),
(3, '4', '5', NULL, 'Very Nice Video', '2022-08-02 18:29'),
(4, '1', '5', NULL, 'prayer', '2022-08-03 17:33'),
(5, '1', '1', NULL, 'prayer', '2022-08-03 18:07'),
(6, '16', '5', NULL, 'prayer', '2022-08-03 18:15'),
(7, '16', '5', NULL, 'prayer', '2022-08-04 16:28'),
(8, '16', '5', '4', 'Thanks', '2022-08-05 19:49'),
(9, '16', '7', NULL, 'prayer', '2022-08-05 20:42'),
(10, '16', '1', NULL, 'Appreciated', '2022-08-05 21:22'),
(11, '16', '11', NULL, 'Nice Parrot', '2022-08-08 21:05'),
(12, '16', '10', NULL, 'prayer', '2022-08-17 15:58'),
(13, '16', '10', NULL, 'prayer', '2022-08-17 15:58'),
(14, '16', '8', NULL, 'Nice', '2022-08-17 16:00'),
(15, '16', NULL, NULL, NULL, '2022-08-17 16:00'),
(16, '16', '8', NULL, 'prayer', '2022-08-17 16:00'),
(17, '5', '11', '11', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry...', '2022-08-23 12:01'),
(18, '27', '11', '17', 'Green parrot species are the most common parrot breeds', '2022-08-24 12:31'),
(19, '27', '11', NULL, 'prayer', '2022-08-24 12:33');

-- --------------------------------------------------------

--
-- Table structure for table `comments_like`
--

CREATE TABLE `comments_like` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `comment_id` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments_like`
--

INSERT INTO `comments_like` (`id`, `user_id`, `comment_id`, `parent_id`, `created_at`) VALUES
(1, '1', '1', NULL, '2022-07-27 18:44'),
(2, '1', '2', '1', '2022-07-27 18:52'),
(3, '16', '12', NULL, '2022-08-18 15:06');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `long_description` text,
  `start_date_time` varchar(50) DEFAULT NULL,
  `end_date_time` varchar(50) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `is_deleted` enum('y','n') NOT NULL DEFAULT 'n',
  `created_at` varchar(50) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `privacy` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `image`, `short_description`, `long_description`, `start_date_time`, `end_date_time`, `status`, `is_deleted`, `created_at`, `created_by`, `privacy`, `location`) VALUES
(1, 'Testing event', '202206281840_deal-zone-2.jpg', NULL, 'Testing event', '2022-07-21 10:00', '2022-07-27 23:49', '1', 'n', '2022-07-19 18:15', '1', '', ''),
(2, 'test', '202207191813_photo2.jpg', NULL, 'test', '2022-07-22 10:30', '2022-07-25 19:07', '1', 'n', '2022-07-19 18:13', NULL, '', ''),
(3, 'Church Event', '202208052026_ct-events.png', NULL, 'We are thrilled about the possibility of meeting in-person for worship on Sundays. There’s something powerful and beautiful when we gather together as one family. We can\'t wait to see you in-person soon at our gatherings.\r\n\r\nIn order to make these gatherings safe and meaningful for everyone, we have these guidelines. Please read them carefully before you register for our services or events.\r\n\r\n1. Children below 10 years, adults above 65 years will not be permitted to attend according to MHA guidelines\r\n\r\n2. Only those who pre-register for worship service and events will be allowed entry. We have limited capacity to 35 attendees to maintain 3 feet seat distancing.\r\n\r\n3. Installing Aarogya Setu application on your mobile phones is mandatory.\r\n\r\n4. The venue will be thoroughly sanitized before and after events.\r\n\r\n5. Hand sanitizers will be available at various spots for use of attendees.\r\n\r\n6. Temperature check will be done at the entrance for all attendees.\r\n\r\n7. Masks are mandatory for all attendees and should be worn at all times.\r\n\r\n8. There will be no beverage or food served. Offering may be given online.\r\n\r\n9. The worship services will be in a shortened manner, including singing and the online option of joining via Zoom will continue.\r\n\r\n10. We will greet each other without handshakes or hugs and maintain social distancing.', '2022-08-07 13:00', '2022-08-08 02:10', '1', 'n', '2022-08-05 20:26', NULL, '', ''),
(4, 'IN-PERSON WORSHIP', '202208052035_national-day-of-prayer-event-ideas-article-600x400.jpg', NULL, 'In order to make these gatherings safe and meaningful for everyone, we have these guidelines. Please read them carefully before you register for our services or events.\r\n\r\n1. Children below 10 years, adults above 65 years will not be permitted to attend according to MHA guidelines\r\n\r\n2. Only those who pre-register for worship service and events will be allowed entry. We have limited capacity to 35 attendees to maintain 3 feet seat distancing.', '2022-08-13 05:00', '2022-08-14 05:00', '1', 'n', '2022-08-05 20:35', NULL, '', ''),
(5, 'DLF MAll', '202208171308_Tesla-01-1536x791.jpg', 'fsdfsfsf', 'fsdfsfsf', '2022-08-17T18:47', '2022-08-18T18:47', '1', 'n', '2022-08-17 13:08', '18', '6', 'DLF'),
(6, 'Morning Prayer Events', '202208171552_Picture1.jpg', '', '', '2022-08-19T00:34', '2022-08-21T00:34', '1', 'n', '2022-08-17 15:52', '16', '6', 'Chicago');

-- --------------------------------------------------------

--
-- Table structure for table `events_hide_report`
--

CREATE TABLE `events_hide_report` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `event_id` varchar(255) NOT NULL,
  `is_event_report` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_event_hide` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feelings`
--

CREATE TABLE `feelings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `is_deleted` enum('y','n') NOT NULL DEFAULT 'n',
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feelings`
--

INSERT INTO `feelings` (`id`, `name`, `image`, `status`, `is_deleted`, `created_at`) VALUES
(1, 'Happy', 'images/smily-1.png', '1', 'n', NULL),
(2, 'Blessed', 'images/smily-2.png', '1', 'n', NULL),
(3, 'Loved', 'images/smily-3.png', '1', 'n', NULL),
(4, 'Sad', 'images/smily-4.png', '1', 'n', NULL),
(5, 'Thankful', 'images/smily-6.png', '1', 'n', NULL),
(6, 'Excited', 'images/smily-7.png', '1', 'n', NULL),
(7, 'In love', 'images/smily-8.png', '1', 'n', NULL),
(8, 'Crazy', 'images/smily-9.png', '1', 'n', NULL),
(9, 'Greatful', 'images/smily-10.png', '1', 'n', NULL),
(10, 'Blissful', 'images/smily-11.png', '1', 'n', NULL),
(11, 'Fantastic', 'images/smily-14.png', '1', 'n', NULL),
(12, 'Silly', 'images/smily-15.png', '1', 'n', NULL),
(13, 'Festive', 'images/smily-16.png', '1', 'n', NULL),
(14, 'Wonderful', 'images/smily-17.png', '1', 'n', NULL),
(15, 'Cool', 'images/smily-18.png', '1', 'n', NULL),
(16, 'Amused', 'images/smily-19.png', '1', 'n', NULL),
(17, 'Relaxed', 'images/smily-20.png', '1', 'n', NULL),
(18, 'Positive', 'images/smily-21.png', '1', 'n', NULL),
(19, 'Chill', 'images/smily-22.png', '1', 'n', NULL),
(20, 'Hopeful', 'images/smily-23.png', '1', 'n', NULL),
(21, 'Joyful', 'images/smily-24.png', '1', 'n', NULL),
(22, 'Tired', 'images/smily-25.png', '1', 'n', NULL),
(23, 'Motivated', 'images/smily-26.png', '1', 'n', NULL),
(24, 'Proud', 'images/smily-27.png', '1', 'n', NULL),
(25, 'Alone', 'images/smily-28.png', '1', 'n', NULL),
(26, 'Thoughtful', 'images/smily-29.png', '1', 'n', NULL),
(27, 'OK', 'images/smily-30.png', '1', 'n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `group_type` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `is_deleted` enum('y','n') NOT NULL DEFAULT 'n',
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `user_id`, `name`, `group_type`, `image`, `description`, `status`, `is_deleted`, `created_at`) VALUES
(1, '1', 'Cricket', 'Public', '202207271724_photo1.jpg', 'You can cricket related information to this group', '1', 'n', '2022-07-27 17:24'),
(2, '4', 'BinaryMetrix Group', 'Public', '202207271914_banner3.jpg', 'This group for only for team binarymetrix', '1', 'n', '2022-07-27 19:14'),
(3, '16', 'bible verse about prayer', 'Public', '202208052037_4912530052b0b2fb89c4fcaaab1f0420.jpg', 'Prayer with the community is most powerful, for the Lord himself said: “Where two or three are gathered in my name I am in the midst of them” (Matthew 18:20). Finally, however, we need to bear in mind that the Lord answers all prayer.', '1', 'n', '2022-08-05 20:37'),
(4, '16', 'GLOW with US', 'Private', '202208052047_LOGO 4.jpeg', 'A GLOW with US is a group of lay people getting together for the purpose of prayer as a group. GLOW are typically conducted outside regular services by one or more members of the clergy or other forms of religious leadership, but they may also be initiated by decision of non-leadership members as well.', '1', 'n', '2022-08-05 20:47'),
(5, '18', 'Github', 'Public', '202208081348_what-is-github-1-1.png', '', '1', 'n', '2022-08-08 13:48');

-- --------------------------------------------------------

--
-- Table structure for table `insprational_feed`
--

CREATE TABLE `insprational_feed` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `whats_on_your_mind` text NOT NULL,
  `videos` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `feeling_id` varchar(255) DEFAULT NULL,
  `activity_id` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `is_deleted` enum('y','n') NOT NULL DEFAULT 'n',
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `insprational_feed`
--

INSERT INTO `insprational_feed` (`id`, `user_id`, `whats_on_your_mind`, `videos`, `photo`, `feeling_id`, `activity_id`, `status`, `is_deleted`, `created_at`) VALUES
(1, '1', 'This is very first post on this site', NULL, '202207271841_photo7.jpg', '1', '', '1', 'n', '2022-07-27 18:41'),
(2, '4', 'One of GLOW’s mission is to “Inspire Christians to fellowship and strengthentheir relationship with our amazing Lord Jesus Christ by empowering the Holy Spirit', NULL, '202207271923_newsfeed-pic.jpg', '', '', '1', 'n', '2022-07-27 19:23'),
(5, '1', 'Testing upload video', '202208021823_new_york_taxi_cabs_street_traffic_438.mp4', NULL, '', '', '1', 'n', '2022-08-02 18:23'),
(6, '4', 'This My fav Video', '202208021832_1610451139349.mp4', NULL, '', '', '1', 'n', '2022-08-02 18:32'),
(7, '16', 'When We Pray Together, We Experience God\'s Presence. Matthew 18:20 (NLT) For where two or three gather together as my followers, I am there among them.” Ephesians 3:12 (NLT) Because of Christ and our faith in him, we can now come boldly and confidently into God\'s presence.', NULL, '202208052042_national-day-of-prayer-event-ideas-article-600x400.jpg', '', '4', '1', 'n', '2022-08-05 20:42'),
(8, '16', 'Matthew: 21:12-14 \'\' And Jesus went into the temple of God, and cast out all them that sold and bought in the temple, and overthrew the tables of the moneychangers, and the seats of them that sold doves. And said to them, it is written, my house shall be called the house of prayer, but ye have made it a den of thieves', NULL, '202208052048_4912530052b0b2fb89c4fcaaab1f0420 (1).jpg', '', '', '1', 'n', '2022-08-05 20:48'),
(9, '16', 'Part of spiritual and emotional maturity is recognizing that it’s not like you’re going to try to fix yourself and become a different person. You remain the same person, but you become awakened.', NULL, NULL, '', '', '1', 'n', '2022-08-05 20:50'),
(10, '18', 'test', NULL, NULL, '1', '', '1', 'n', '2022-08-08 12:41'),
(11, '16', 'Hello Worlds', NULL, '202208082105_parrot.jpg', '', '', '1', 'n', '2022-08-08 21:05');

-- --------------------------------------------------------

--
-- Table structure for table `insprational_feed_hide_report`
--

CREATE TABLE `insprational_feed_hide_report` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `insprational_feed_id` varchar(255) NOT NULL,
  `is_insprational_feed_hide` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_insprational_feed_report` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `insprational_feed_hide_report`
--

INSERT INTO `insprational_feed_hide_report` (`id`, `user_id`, `insprational_feed_id`, `is_insprational_feed_hide`, `is_insprational_feed_report`, `created_at`) VALUES
(1, '27', '10', 'yes', 'no', '2022-08-11 16:58'),
(2, '16', '11', 'yes', 'no', '2022-08-16 10:53');

-- --------------------------------------------------------

--
-- Table structure for table `insprational_feed_like`
--

CREATE TABLE `insprational_feed_like` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `insprational_feed_id` varchar(255) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `insprational_feed_like`
--

INSERT INTO `insprational_feed_like` (`id`, `user_id`, `insprational_feed_id`, `created_at`) VALUES
(1, '1', '1', '2022-07-27 18:43'),
(2, '4', '1', '2022-07-27 19:20'),
(3, '5', '2', '2022-07-27 19:28'),
(4, '7', '3', '2022-07-29 06:26'),
(5, '4', '5', '2022-08-02 18:28'),
(6, '16', '6', '2022-08-02 20:53'),
(7, '16', '2', '2022-08-02 21:06'),
(8, '16', '5', '2022-08-02 21:07'),
(9, '16', '8', '2022-08-05 20:51'),
(10, '16', '1', '2022-08-05 21:21'),
(11, '18', '9', '2022-08-08 12:40'),
(12, '16', '11', '2022-08-08 21:05'),
(13, '16', '10', '2022-08-11 12:10'),
(14, '16', '9', '2022-08-17 20:40'),
(15, '5', '6', '2022-08-23 10:35'),
(16, '5', '11', '2022-08-23 12:10'),
(17, '27', '9', '2022-08-24 12:33'),
(18, '27', '11', '2022-08-24 14:32');

-- --------------------------------------------------------

--
-- Table structure for table `insprational_feed_share_on_timeline`
--

CREATE TABLE `insprational_feed_share_on_timeline` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `insprational_feed_id` varchar(255) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `insprational_feed_share_on_timeline`
--

INSERT INTO `insprational_feed_share_on_timeline` (`id`, `user_id`, `insprational_feed_id`, `created_at`) VALUES
(1, '1', '1', '2022-07-27 18:43'),
(2, '4', '1', '2022-07-27 19:20'),
(3, '4', '5', '2022-08-02 20:09'),
(4, '16', '5', '2022-08-02 21:07'),
(5, '16', '6', '2022-08-03 19:05'),
(6, '16', '9', '2022-08-05 20:51'),
(7, '18', '9', '2022-08-08 12:40'),
(8, '18', '10', '2022-08-08 12:52'),
(9, '16', '11', '2022-08-08 21:26'),
(10, '16', '10', '2022-08-17 15:58'),
(11, '16', '8', '2022-08-17 16:00');

-- --------------------------------------------------------

--
-- Table structure for table `pagination`
--

CREATE TABLE `pagination` (
  `id` int(11) NOT NULL,
  `per_page_record` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pagination`
--

INSERT INTO `pagination` (`id`, `per_page_record`) VALUES
(1, '10');

-- --------------------------------------------------------

--
-- Table structure for table `system_users`
--

CREATE TABLE `system_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `is_deleted` enum('y','n') NOT NULL DEFAULT 'n',
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_users`
--

INSERT INTO `system_users` (`id`, `name`, `email`, `contact_number`, `password`, `status`, `is_deleted`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '9811353900', 'eyJpdiI6IlNtdEU3SzI0TWpMVDhNL2xvVVhTbVE9PSIsInZhbHVlIjoiOEpPQTRoY1MweXQxVURVb0JONTZhZz09IiwibWFjIjoiNzY4NzU5OTAwYTdlZTI0NTYyODY2NjM3ZTc1MDcyNWRlM2Q1YjQ3NzYwNzg0NjYyYWZhYTgyMjQyNzk4MzM5OSIsInRhZyI6IiJ9', '1', 'n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userabout`
--

CREATE TABLE `userabout` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `studied_at` varchar(100) DEFAULT NULL,
  `lives_in` varchar(100) DEFAULT NULL,
  `from` varchar(100) DEFAULT NULL,
  `marital_status` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `about` text,
  `zipcode` varchar(10) DEFAULT NULL,
  `denomination` varchar(50) DEFAULT NULL,
  `member` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userabout`
--

INSERT INTO `userabout` (`id`, `user_id`, `studied_at`, `lives_in`, `from`, `marital_status`, `phone`, `about`, `zipcode`, `denomination`, `member`, `created_at`, `updated_at`) VALUES
(2, 18, 'Lucknow University', NULL, NULL, NULL, NULL, NULL, NULL, 'Denomination', 'Member', '2022-08-23 13:51:48', '2022-08-23 13:56:44'),
(3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(6, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(7, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(10, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(11, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(12, 16, 'Harvard University', 'Chicago', 'INDIA', 'Single', '3159953848', 'I am What i am', NULL, 'Denomination', 'Other Nonprofit Organization', '2022-08-23 13:51:48', '2022-08-23 15:32:36'),
(13, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(14, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(15, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(16, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(17, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(18, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-23 13:51:48', '2022-08-23 13:51:48'),
(19, 27, 'Oxford University', 'Chicago', 'INDIA', 'Single', '3159953848', 'I am what I am', '110012', 'Roman Catholic', 'Member', '2022-08-23 13:51:48', '2022-08-24 18:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `userfamily`
--

CREATE TABLE `userfamily` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `relation` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userfamily`
--

INSERT INTO `userfamily` (`id`, `user_id`, `image`, `name`, `relation`, `created_at`, `updated_at`) VALUES
(5, 18, '202208241502_1622812911010.jpg', 'Akash', 'Son', '2022-08-24 15:02:08', '2022-08-24 15:02:08'),
(6, 27, '202208241806_pp.jpg', 'Punit Garg', 'Brother', '2022-08-24 18:06:34', '2022-08-24 18:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `userplaces`
--

CREATE TABLE `userplaces` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `desc` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userplaces`
--

INSERT INTO `userplaces` (`id`, `user_id`, `updated_at`, `created_at`, `type`, `desc`) VALUES
(1, 27, '2022-08-24 17:10:50', '2022-08-24 17:10:50', 'Current town/city', 'Living In Chicago');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `login_type` varchar(255) DEFAULT NULL,
  `google_unique_id` varchar(255) DEFAULT NULL,
  `apple_unique_id` varchar(255) DEFAULT NULL,
  `facebook_unique_id` varchar(255) DEFAULT NULL,
  `instagram_unique_id` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `denomination` varchar(255) DEFAULT NULL,
  `church` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `is_deleted` enum('y','n') NOT NULL DEFAULT 'n',
  `created_at` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL,
  `languages` varchar(100) DEFAULT NULL,
  `interested_in` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `profile_pic`, `login_type`, `google_unique_id`, `apple_unique_id`, `facebook_unique_id`, `instagram_unique_id`, `password`, `zip_code`, `denomination`, `church`, `status`, `is_deleted`, `created_at`, `mobile`, `address`, `gender`, `dob`, `year`, `languages`, `interested_in`) VALUES
(1, 'Amit_*_Kumar', NULL, 'amit@gmail.com', '202208021822_photo8.jpg', NULL, NULL, NULL, NULL, NULL, 'eyJpdiI6IkFYRm1aY3UvSVJkZGJmZnBjdDJPS1E9PSIsInZhbHVlIjoieXpsbG80SlIxV3FaNzFFL095M3NwQT09IiwibWFjIjoiZDQyODQwYThlM2JlYjQwYWY5MmRlNzhlZWM0YmQwNmZhYzQ5ODUwZDVlZDVhNjVmOWIyYTdkMzlhY2UyY2M0NCIsInRhZyI6IiJ9', '201301', 'Roman Catholic', '', '1', 'n', '2022-06-16 18:12', '', '', '', '', '', '', ''),
(3, 'Mary_*_Delia', NULL, 'msmaryrdelia@icloud.com', NULL, NULL, NULL, NULL, NULL, NULL, 'eyJpdiI6ImdpM0RhQUl6SGJHczNUdzU0SFdrbUE9PSIsInZhbHVlIjoiRk4ycTJaTmxKRzlDM3QrdkFQMHZ0Zz09IiwibWFjIjoiOTBkZmE0ZmIxMmE1OGFhNDBiNTJlOTkwY2U0MTk4MDA0ZWI3MDc3YWQ1YTg4OGIyNzJlZWNkYzc0MTY1NzI3MSIsInRhZyI6IiJ9', '92688', 'Unaffiliated Christian', '', '1', 'n', '2022-07-05 22:48', '', '', '', '', '', '', ''),
(4, 'Oliver Queen', NULL, 'queen.vcube@gmail.com', '202208021828_pp.jpg', NULL, '105442762274394758554', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'n', NULL, '', '', '', '', '', '', ''),
(5, 'Hemant Sharma', NULL, 'webdesignerhoney@gmail.com', '202208231200_Online_Couples_Therapy_LP.jpg', NULL, '101200751842483729211', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'n', NULL, '', '', '', '', '', '', ''),
(6, 'Punit Garg', NULL, 'punitgarg07@gmail.com', NULL, NULL, '113199418176261344769', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'n', NULL, '', '', '', '', '', '', ''),
(7, 'binarymetrix', NULL, 'binarymetrix93@gmail.com', NULL, NULL, '117569462321187039177', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'n', NULL, '', '', '', '', '', '', ''),
(8, 'Oliver_*_Queen', 'oliver_vcube', 'oliver.vibrantcube@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'eyJpdiI6IkM2YjJvczNYRXA0UkVIc2oyVXl0QlE9PSIsInZhbHVlIjoieE1tTFNnaUxWbHp1aURuam5UWmN1UT09IiwibWFjIjoiZTVlZDk4NzViNjhjMjgyNzcxMzQ4OGQ4NzgzNzdmYmI4M2MxM2NlZDQ3ZjM4MmQwNjcyZjFhZjNkZjcyZmQ2MiIsInRhZyI6IiJ9', '110012', 'Baptist', 'BinaryMetrix Technologies', '1', 'y', '2022-08-02 17:25', '', '', '', '', '', '', ''),
(14, 'C_*_K', '', 'ck@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'eyJpdiI6ImM5cUo0L08rMnJURkN3aHBEWTFzRFE9PSIsInZhbHVlIjoiSEwzRVZ0Q0RDVHNlTXkwY09ab3Vidz09IiwibWFjIjoiZmQzMTJiYzAyYjJkYWNiOTA0OWExMTlhOGQ4NzljOTZiNzliMTVhZWJmNzQ4ZDkwMDM2MWY2Yjk4ZTA1ZjRiZSIsInRhZyI6IiJ9', '201301', 'Protestant', '', '1', 'n', '2022-08-02 19:09', '', '', '', '', '', '', ''),
(15, 'Oliver_*_Queen', 'oliver.binary', 'oliver.vibrantcube@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'eyJpdiI6IlBYeERDUnJhSng5Mmhrc0xkTUo4MFE9PSIsInZhbHVlIjoiZ29KZ051Tkk2WC9CSVRFd05lY3VLQT09IiwibWFjIjoiNGU0YWEzNGMwMzk1YmMxYTM2MjQyNDE3MjcxNmUyZmEwMGMyNTAwZGE0OWE0N2Q4YTkyMjBjZjkyMjBkNzkxNyIsInRhZyI6IiJ9', '110012', 'Lutheran', 'BinaryMetrix Technologies', '1', 'y', '2022-08-02 20:49', '', '', '', '', '', '', ''),
(16, 'Oliver_*_Queen', 'Oliver.BMT', 'oliver.vibrantcube@gmail.com', '202208031552_Kailash Pic.png', NULL, NULL, NULL, NULL, NULL, '', '112230', 'Orthodox', 'BinaryMetrix Technologies', '1', 'n', '2022-08-02 20:51', '', '', '', '', '', '', ''),
(17, NULL, 'afatabhusain786', NULL, NULL, NULL, NULL, NULL, NULL, '17841454174806890', NULL, NULL, NULL, NULL, '1', 'n', NULL, '', '', '', '', '', '', ''),
(18, 'Akash_*_Rai', 'akash@binarymetrix.com', 'akash@binarymetrix.com', '202208191305_1622812911010.jpg', NULL, NULL, NULL, NULL, NULL, 'eyJpdiI6IkpkcFVFRU85L0l0aDk2bnFRNGZ5N3c9PSIsInZhbHVlIjoiblArZEJyL2NCTXVHRkFuV3hESHpKdz09IiwibWFjIjoiZmRhYjJjYmFlNjYyMDlkNmJlYjRhMjgyNGM5ZWIwY2RmZDA1MWY3MTQ2ZDBjNGZjYWQ3OWQ4NjY1OWYyYjI5YSIsInRhZyI6IiJ9', '12345', 'Roman Catholic', '', '1', 'n', '2022-08-08 12:30', '6306259996', NULL, 'Male', '2022-08-24', '2022', 'fsfs', 'fsfs'),
(19, 'Info_*_GLOW', 'GLOWteam', 'info@godluv.org', NULL, NULL, NULL, NULL, NULL, NULL, 'eyJpdiI6ImM2K1lNWkt1V21kWXc1QnE0MHNlWHc9PSIsInZhbHVlIjoiWk9LTkNWWE9GYzV4VCtRM2E2SU8vQT09IiwibWFjIjoiZjBmY2Y5NzkyMjBiYzYwODNlYzViMThlNDExNzQxODNiNzNhY2QxZmI4YmQzODU4MDFkNjhiZTMyNTRiYTI1ZCIsInRhZyI6IiJ9', '92663', 'Protestant', 'Mariners Church', '1', 'n', '2022-08-10 20:51', '', '', '', '', '', '', ''),
(20, 'asdadd342@@@@@_*_sfsfs@@@@', 'test@gmail.com', 'test@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'eyJpdiI6IjJvZjhHOHBBY0RQK0R2dXVMK3ZBQnc9PSIsInZhbHVlIjoid0hMQTNuSG9EcXJqZnUvOW5GZTZkdz09IiwibWFjIjoiZDQzODFkYWFiNTJlZjA2YjQwMzVhMzdhMGEwMzA0MjQ1ODM4ODA2NjM2MTQ4ODQ0MzZjYzRjMjFiZTk0OTUwMSIsInRhZyI6IiJ9', '123456', 'Roman Catholic', '', '1', 'n', '2022-08-11 08:10', '', '', '', '', '', '', ''),
(21, 'daasd_*_ddasd', 'akash1@binarymetrix.com', 'akash@binarymetrix.com', NULL, NULL, NULL, NULL, NULL, NULL, 'eyJpdiI6Ik1BR0JWR09GYi9QZ1daWkZTMi9VL3c9PSIsInZhbHVlIjoiK01FaXhtT0lSVmt0dTFqR0ViRmJhdz09IiwibWFjIjoiMzI2ODU3ZWZiOTU5NzA5NzAzMjg1NmE0OWEwODBhYjlhODYzYTViZGM5Y2ZmZjEzMzc3M2Q4YjhkMmZhNDg1NyIsInRhZyI6IiJ9', '222222', 'Roman Catholic', '', '1', 'n', '2022-08-11 09:32', '', '', '', '', '', '', ''),
(25, 'Akash Rai', NULL, 'akashrai0806@gmail.com', NULL, NULL, '105408554844101064926', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'n', NULL, '', '', '', '', '', '', ''),
(26, 'Aakash Rai', NULL, 'rai.akash123yyyob@gmail.com', NULL, NULL, NULL, NULL, '5339859366097214', NULL, NULL, NULL, NULL, NULL, '1', 'n', NULL, '', '', '', '', '', '', ''),
(27, 'Oliver_*_Queen', 'oliverbinarymetrix', 'oliverbinarymetrix@gmail.com', '202208241703_Kailash pic.jpg', NULL, NULL, NULL, NULL, NULL, '', '110012', 'Roman Catholic', 'Church', '1', 'n', '2022-08-11 16:57', '3159953848', '209, iThum Tower, Sector 62, NOIDA', 'Male', '1995-12-20', '1995', 'English', 'Women'),
(28, 'Sam_*_Doe', 'samdoe', 'owner.igenwebapp@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'eyJpdiI6IjdweVhwck9TSkk1d25BN0wwdFd5a1E9PSIsInZhbHVlIjoiS3RWK1ZkUjY0SVprYzAxWkEwZWU3QT09IiwibWFjIjoiMzIxODZjOTFkYjNjODA0MzEzMDIwYjRlNzNhMGM3NGUzMmFjYjZiMjdmOThkZjMyYmZkMjZhYWIzYTljZGY1MyIsInRhZyI6IiJ9', '12345', 'Roman Catholic', '', '1', 'n', '2022-08-24 14:38', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_going_in_events`
--

CREATE TABLE `users_going_in_events` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `event_id` varchar(255) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_going_in_events`
--

INSERT INTO `users_going_in_events` (`id`, `user_id`, `event_id`, `created_at`) VALUES
(1, '4', '2', '2022-08-02 20:39'),
(2, '18', '4', '2022-08-08 13:49'),
(3, '16', '4', '2022-08-11 12:09'),
(4, '16', '5', '2022-08-17 15:31'),
(5, '16', '6', '2022-08-17 15:59');

-- --------------------------------------------------------

--
-- Table structure for table `users_interested_in_events`
--

CREATE TABLE `users_interested_in_events` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `event_id` varchar(255) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_interested_in_events`
--

INSERT INTO `users_interested_in_events` (`id`, `user_id`, `event_id`, `created_at`) VALUES
(1, '18', '4', '2022-08-08 13:49'),
(2, '16', '4', '2022-08-11 12:09'),
(3, '18', '5', '2022-08-17 13:08'),
(4, '16', '5', '2022-08-17 15:31'),
(5, '16', '6', '2022-08-17 15:58');

-- --------------------------------------------------------

--
-- Table structure for table `users_joined_group`
--

CREATE TABLE `users_joined_group` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `group_id` varchar(255) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_joined_group`
--

INSERT INTO `users_joined_group` (`id`, `user_id`, `group_id`, `created_at`) VALUES
(1, '4', '1', '2022-08-02 18:32'),
(2, '18', '4', '2022-08-08 12:41'),
(3, '18', '3', '2022-08-08 12:41'),
(4, '18', '2', '2022-08-08 12:41'),
(5, '18', '1', '2022-08-08 12:41'),
(6, '18', '4', '2022-08-08 12:41'),
(7, '18', '3', '2022-08-08 12:41'),
(8, '18', '2', '2022-08-08 12:41'),
(9, '18', '5', '2022-08-08 13:48');

-- --------------------------------------------------------

--
-- Table structure for table `userwork`
--

CREATE TABLE `userwork` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `description` text,
  `completion_year` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `joining_year` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userwork`
--

INSERT INTO `userwork` (`id`, `user_id`, `type`, `description`, `completion_year`, `created_at`, `updated_at`, `joining_year`) VALUES
(11, 18, 'High School', 'Hans Raj Model School', '2010-07-01', '2022-08-24 07:23:14', '2022-08-24 07:23:14', '2010-05-25'),
(10, 16, 'Work', 'Work at BinaryMetrix', '2022-08-23', '2022-08-23 15:24:55', '2022-08-23 15:24:55', '2022-08-01'),
(12, 27, 'Work', 'Working as a Sr. Consultant in BinaryMetrix Technologies', '2022-08-24', '2022-08-24 17:10:12', '2022-08-24 17:10:12', '2019-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `user_about`
--

CREATE TABLE `user_about` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `studied_at` varchar(100) DEFAULT NULL,
  `lives_in` varchar(100) DEFAULT NULL,
  `from` varchar(100) DEFAULT NULL,
  `marital_status` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `about` text,
  `zipcode` varchar(10) DEFAULT NULL,
  `denomination` varchar(50) DEFAULT NULL,
  `member` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments_like`
--
ALTER TABLE `comments_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_hide_report`
--
ALTER TABLE `events_hide_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feelings`
--
ALTER TABLE `feelings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insprational_feed`
--
ALTER TABLE `insprational_feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insprational_feed_hide_report`
--
ALTER TABLE `insprational_feed_hide_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insprational_feed_like`
--
ALTER TABLE `insprational_feed_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insprational_feed_share_on_timeline`
--
ALTER TABLE `insprational_feed_share_on_timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagination`
--
ALTER TABLE `pagination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_users`
--
ALTER TABLE `system_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userabout`
--
ALTER TABLE `userabout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userfamily`
--
ALTER TABLE `userfamily`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userplaces`
--
ALTER TABLE `userplaces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_going_in_events`
--
ALTER TABLE `users_going_in_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_interested_in_events`
--
ALTER TABLE `users_interested_in_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_joined_group`
--
ALTER TABLE `users_joined_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userwork`
--
ALTER TABLE `userwork`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_about`
--
ALTER TABLE `user_about`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comments_like`
--
ALTER TABLE `comments_like`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events_hide_report`
--
ALTER TABLE `events_hide_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feelings`
--
ALTER TABLE `feelings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `insprational_feed`
--
ALTER TABLE `insprational_feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `insprational_feed_hide_report`
--
ALTER TABLE `insprational_feed_hide_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `insprational_feed_like`
--
ALTER TABLE `insprational_feed_like`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `insprational_feed_share_on_timeline`
--
ALTER TABLE `insprational_feed_share_on_timeline`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pagination`
--
ALTER TABLE `pagination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_users`
--
ALTER TABLE `system_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userabout`
--
ALTER TABLE `userabout`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `userfamily`
--
ALTER TABLE `userfamily`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userplaces`
--
ALTER TABLE `userplaces`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users_going_in_events`
--
ALTER TABLE `users_going_in_events`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_interested_in_events`
--
ALTER TABLE `users_interested_in_events`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_joined_group`
--
ALTER TABLE `users_joined_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `userwork`
--
ALTER TABLE `userwork`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_about`
--
ALTER TABLE `user_about`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
