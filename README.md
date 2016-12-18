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
		* Go to http://localhost/cvwo_blog/src to login
		* These are the test accounts:
				user: dongocduc
				password: iamadmin

				user: user1
				password: user1

				user: user2
				password: user2

3. Main changelogs (according to git commits):
		* 13 Dec: set up database.php (PDO connection) and index.php (listing all posts)
		 					set up create.php (create a blog post)
		* 14 Dec: set up login.php (only registered users can access index.php)
							set up authenticate.php (session controls)
		* 15 Dec: set up logout.php
							fix create.php so that only registered users can create posts
							set up delete.php (delete posts)
							set up comment.php (comment on posts)
		* 18 Dec: set up pagination for post display
							reformat index.php to separate into own posts and others' posts.

4. To-do list (sorted by priority):
		* Beautify post display
		* Add filter own posts by date
		* Add filter posts by users
		* Support search for posts
		* Add multimedia (images, video) support to a blog post
		* Support user profiling (profile picture, name, age, sex, etc.)
		* Implement AJAX to user actions (create, delete, comment, filter, search) to improve UX


