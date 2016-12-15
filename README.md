## README ##
## git@bitbucket.org:dongocduc311997/cvwo_blog.git ##

******************************
*  Name: Do Ngoc Duc         *
*  Matric number: A0160589U  *
******************************

1. User actions:
		* Implemented:
			- I can login to my account.
			- Only those with an account can use the blog.
			- I can write a post.
			- I can delete my own posts.
			- I can comment on others' posts.
			- I can see my own posts and others' posts.
		* To be implemented:
			- I can register for an account.
			- I can search for posts.
			- I can filter posts by users.
			- I can filter my own posts by date posted.
			- I can insert multimedia contents into my post.
			- I can have my profile page.

2. How to deploy:
		* In XAMPP Control Panel, turn on Apache and MySQL.
		* Open config.inc.php, locate the following:
				$cfg['Servers'][$i]['auth_type']
				and set it to:
				$cfg['Servers'][$i]['auth_type'] = 'http';
				(so that admin can login to sql server using web browser)
		* Go to http://localhost/phpmyadmin and using the following login:
				user: root
				password: root
		* Run the SQL commands as in file schema.sql to set up the database
		* Go to http://localhost/cvwo_blog to login
		* These are the test accounts:
				user: dongocduc
				password: iamadmin

				user: user1
				password: user1

				user: user2
				password: user2

3. SQL Schema:

		--
		-- Tables
		--

		CREATE DATABASE IF NOT EXISTS `data`;

		CREATE TABLE `comments` (
		  `COMMENT_ID` bigint(20) UNSIGNED NOT NULL,
		  `USER_ID` bigint(20) NOT NULL,
		  `POST_ID` bigint(20) NOT NULL,
		  `COMMENT_CONTENT` text NOT NULL,
		  `DATE_COMMENTED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)

		CREATE TABLE `posts` (
		  `POST_ID` bigint(20) UNSIGNED NOT NULL,
		  `USER_ID` bigint(20) UNSIGNED NOT NULL,
		  `CONTENT` longtext NOT NULL,
		  `DATE_POSTED` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
		)

		CREATE TABLE `sessions` (
		  `SESSION_ID` bigint(20) UNSIGNED NOT NULL,
		  `USER_ID` bigint(20) NOT NULL,
		  `SESSION_KEY` varchar(60) NOT NULL,
		  `SESSION_ADDRESS` varchar(100) NOT NULL,
		  `SESSION_USERAGENT` varchar(200) NOT NULL,
		  `SESSION_EXPIRES` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)

		CREATE TABLE `users` (
		  `USER_ID` bigint(20) UNSIGNED NOT NULL,
		  `USERNAME` varchar(100) NOT NULL,
		  `PASSWORD` varchar(64) NOT NULL,
		  `DATE_REGISTERED` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
		)

		--
		-- Primary keys and auto-incrementing
		--

		ALTER TABLE `comments`
		  ADD PRIMARY KEY (`COMMENT_ID`);

		ALTER TABLE `posts`
		  ADD PRIMARY KEY (`POST_ID`);

		ALTER TABLE `sessions`
		  ADD PRIMARY KEY (`SESSION_ID`),
		  ADD KEY `IDX_SESSION_KEY` (`SESSION_KEY`);

		ALTER TABLE `users`
		  ADD PRIMARY KEY (`USER_ID`),
		  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

		ALTER TABLE `comments`
		  MODIFY `COMMENT_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

		ALTER TABLE `posts`
		  MODIFY `POST_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

		ALTER TABLE `sessions`
		  MODIFY `SESSION_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

		ALTER TABLE `users`
		  MODIFY `USER_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

		--
		-- Relations table
		--

		INSERT INTO `pma__relation` (`master_db`, `master_table`, `master_field`, `foreign_db`, `foreign_table`, `foreign_field`) VALUES
			('data', 'comments', 'POST_ID', 'data', 'posts', 'POST_ID'),
			('data', 'comments', 'USER_ID', 'data', 'users', 'USER_ID'),
			('data', 'posts', 'USER_ID', 'data', 'users', 'USER_ID'),
			('data', 'sessions', 'USER_ID', 'data', 'users', 'USER_ID');


4. Main changelogs (according to git commits):
		* 13 Dec: set up database.php (PDO connection) and index.php (listing all posts)
		 					set up create.php (create a blog post)
		* 14 Dec: set up login.php (only registered users can access index.php)
							set up authenticate.php (session controls)
		* 15 Dec: set up logout.php
							fix create.php so that only registered users can create posts
							set up delete.php (delete posts)
							set up comment.php (comment on posts)

5. To-do list (sorted by priority):
		* Reformat index.php to separate into own posts and others' posts.
		* Add pagination
		* Add filter own posts by date
		* Add filter posts by users
		* Support search for posts
		* Add multimedia (images, video) support to a blog post
		* Support user profiling (profile picture, name, age, sex, etc.)
		* Implement AJAX to user actions (create, delete, comment, filter, search) to improve UX


