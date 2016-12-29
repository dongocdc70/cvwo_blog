-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2016 at 05:16 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `COMMENT_ID` bigint(20) UNSIGNED NOT NULL,
  `USER_ID` bigint(20) NOT NULL,
  `POST_ID` bigint(20) NOT NULL,
  `COMMENT_CONTENT` text NOT NULL,
  `DATE_COMMENTED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `POST_ID` bigint(20) UNSIGNED NOT NULL,
  `USER_ID` bigint(20) UNSIGNED NOT NULL,
  `TITLE` varchar(255) NOT NULL,
  `CONTENT` longtext NOT NULL,
  `DATE_POSTED` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`POST_ID`, `USER_ID`, `TITLE`, `CONTENT`, `DATE_POSTED`) VALUES
(38, 8, 'testing image', '<p><img src="http://www.myhappybirthdaywishes.com/wp-content/uploads/2016/03/happy-birthday-dog-funny-memes.jpg" alt="" width="600" height="386" /></p>', '2016-12-23 23:37:07'),
(39, 8, 'testing video', '<p><iframe src="//www.youtube.com/embed/3Uo0JAUWijM" width="560" height="314" allowfullscreen="allowfullscreen"></iframe></p>', '2016-12-23 23:37:51'),
(40, 8, 'testing responsive filemanager', '<p><a title="test_dongocduc" href="/cvwo_blog/src/uploads/source/dongocduc/test_dongocduc.txt">test_dongocduc</a></p>\r\n<p><img src="/cvwo_blog/src/uploads/source/dongocduc/EPS_complicated-answers.jpg?1482516035084" alt="EPS_complicated-answers" /></p>\r\n<p><a title="MA1102R-Assignment3" href="/cvwo_blog/src/uploads/source/dongocduc/MA1102R-Assignment3.pdf">MA1102R-Assignment3</a></p>', '2016-12-24 01:01:21'),
(41, 12, 'spam1', '<p><strong>spam1</strong></p>', '2016-12-24 01:56:51'),
(42, 12, 'spam2', '<p>spam2</p>\r\n<p>&nbsp;</p>', '2016-12-24 01:57:04'),
(43, 12, 'spam3', '<p><span style="text-decoration: underline;">spam3</span></p>', '2016-12-24 01:58:16'),
(44, 12, 'spam4', '<p>spam4</p>', '2016-12-24 01:58:29'),
(45, 12, 'long post', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis venenatis varius imperdiet. Aliquam ullamcorper justo tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque congue felis odio, id congue metus finibus et. Curabitur non turpis neque. Nullam imperdiet ornare ullamcorper. Etiam convallis finibus erat vel molestie. Cras lacinia aliquet tellus, sed egestas neque pellentesque vel. Vivamus velit ante, consequat eu quam in, gravida sodales nisi. Etiam scelerisque condimentum magna, vel ullamcorper mi convallis non. Mauris ipsum orci, cursus non laoreet sed, porttitor et diam. Ut et egestas odio.</p>\r\n<p>Ut tincidunt placerat felis nec lacinia. Vivamus malesuada ornare est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam condimentum nibh quis magna pretium, ut luctus orci rhoncus. Curabitur nec eros vitae arcu imperdiet porta vel a risus. In at turpis nulla. Etiam tincidunt venenatis tellus, ac ullamcorper felis rhoncus eu.</p>\r\n<p>Quisque non massa eu augue varius fermentum ut ut est. Sed tincidunt pulvinar posuere. Nam finibus interdum eros, sit amet pharetra urna interdum sed. Pellentesque tristique, lectus ut consequat egestas, urna tellus mollis lorem, nec tristique urna dui sit amet nulla. Curabitur eu aliquet enim. Duis cursus posuere nisl in ultricies. Nam consequat ornare accumsan.</p>\r\n<p>Duis sed turpis eget ex maximus facilisis sit amet vitae nulla. Maecenas accumsan vitae risus eget maximus. Pellentesque vitae mi sit amet lorem tincidunt congue vitae eu erat. Maecenas nec justo ex. Donec malesuada vitae urna tristique imperdiet. Donec sit amet purus congue, laoreet turpis eget, gravida justo. Integer fermentum a orci nec porttitor. Duis at magna id diam eleifend venenatis vitae sit amet neque. Pellentesque maximus dui enim, sit amet lobortis lacus porta nec. Cras venenatis volutpat enim sed feugiat. Aenean faucibus mattis ultricies. Nulla facilisi. Phasellus vulputate quam sit amet urna cursus, malesuada dapibus purus congue. Proin convallis augue non ultrices cursus.</p>\r\n<p>Donec neque risus, bibendum ut diam sit amet, gravida vehicula mauris. Quisque viverra lectus quis nisl gravida dictum. Morbi molestie dictum sem vel fermentum. Sed placerat, augue eu porttitor iaculis, nulla urna dapibus nisi, a dictum leo leo et nisl. Mauris scelerisque tempor orci a euismod. Phasellus ullamcorper, orci vitae ultrices sollicitudin, est justo fermentum augue, eu cursus arcu neque eu elit. Fusce in erat orci. Pellentesque facilisis ante in placerat volutpat. Maecenas est diam, finibus a lacus id, lobortis placerat ante. Quisque ac efficitur sem. Nulla auctor augue vitae leo sollicitudin, eu porta mauris pretium. Morbi porttitor nisi pretium quam aliquet, nec gravida arcu iaculis. Pellentesque lacinia porttitor lobortis.</p>', '2016-12-24 01:59:41'),
(46, 8, 'dummy 1', '<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>', '2016-12-26 23:19:15'),
(47, 8, 'dummy 2', '<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>\r\n<p>It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>', '2016-12-26 23:19:34'),
(48, 8, 'dummy 3', '<p>And if she hasn&rsquo;t been rewritten, then they are still using her. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One</p>', '2016-12-26 23:19:46'),
(49, 8, 'dummy 4', '<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>\r\n<p>It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>\r\n<p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn&rsquo;t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>\r\n<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way. On her way she met a copy.</p>\r\n<p>The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn&rsquo;t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their projects again and again.</p>', '2016-12-26 23:20:07'),
(50, 8, 'dummy 5', '<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>\r\n<p>It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>\r\n<p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn&rsquo;t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>\r\n<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way. On her way she met a copy.</p>\r\n<p>The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn&rsquo;t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their projects again and again.</p>\r\n<p>And if she hasn&rsquo;t been rewritten, then they are still using her. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One</p>', '2016-12-26 23:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `SESSION_ID` bigint(20) UNSIGNED NOT NULL,
  `USER_ID` bigint(20) NOT NULL,
  `SESSION_KEY` varchar(60) NOT NULL,
  `SESSION_ADDRESS` varchar(100) NOT NULL,
  `SESSION_USERAGENT` varchar(200) NOT NULL,
  `SESSION_EXPIRES` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`SESSION_ID`, `USER_ID`, `SESSION_KEY`, `SESSION_ADDRESS`, `SESSION_USERAGENT`, `SESSION_EXPIRES`) VALUES
(51, 8, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 19:59:57'),
(52, 8, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 17:18:32'),
(53, 8, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 17:20:45'),
(54, 9, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 17:24:44'),
(55, 9, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 17:25:20'),
(56, 8, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 17:25:34'),
(57, 8, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 17:36:23'),
(58, 9, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 18:42:52'),
(59, 8, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 18:56:09'),
(60, 8, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 18:59:13'),
(61, 9, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 19:04:38'),
(62, 12, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 19:39:32'),
(63, 14, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 19:50:31'),
(64, 12, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 19:55:16'),
(65, 12, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-23 19:59:12'),
(66, 8, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-26 09:32:11'),
(67, 8, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-26 08:47:20'),
(68, 8, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-26 12:01:36'),
(69, 8, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-26 19:54:15'),
(70, 8, 'vok3h035dqjq1dof65gshh9vh5', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/58.3.138 Chrome/52.3.2743.138 Safari/537.36', '2016-12-27 16:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` bigint(20) UNSIGNED NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `DATE_REGISTERED` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `USERNAME`, `PASSWORD`, `DATE_REGISTERED`) VALUES
(8, 'dongocduc', '$2y$10$eiTqiC28aA0YAdsQrxS5U.6ktkMx5Ke/dkL2MCPVP.fhlyRGqWnGS', '2016-12-23 22:55:26'),
(9, 'user1', '$2y$10$bdpOEQFOYxrPD4avx7ml1eEuA5LzJFUyMCWvDKHSYi1vZGiIQdEVq', '2016-12-23 23:24:38'),
(12, 'user2', '$2y$10$vOcPUgDfWwfJiXqIGyl72.Gi397VeKY1frQwAjgsreuimj5hl7XN.', '2016-12-24 01:39:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`COMMENT_ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`POST_ID`);
ALTER TABLE `posts` ADD FULLTEXT KEY `TITLE` (`TITLE`,`CONTENT`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`SESSION_ID`),
  ADD KEY `IDX_SESSION_KEY` (`SESSION_KEY`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `COMMENT_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `POST_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `SESSION_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
