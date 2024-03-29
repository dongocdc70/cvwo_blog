## README                                                 ##
## git@bitbucket.org:dongocduc311997/cvwo_blog.git        ##
## An online working version of the blog is available on: ##
## http://cvwo-blog.freevnn.com                           ##


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
			- I can register for an account.
			- I can filter posts by users.
			- I can insert multimedia contents into my post.
			- I can search for posts
		* To be implemented:
			- I can filter my own posts by date posted.
			- I can have my profile page.

2. Main changelogs (according to git commits):
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
		* 20 Dec: beautify post view
							implement ajax comment
		* 23 Dec: implement registration
							implement filter post by user
							implement tinymce for adding multimedia content to blog post
							implement htmlpurifier to protect against xss
		* 24 Dec: implement strong password hashing
							implement responsive filemanager for uploading attachments to posts
		* 27 Dec: implement AJAX php live search

3. To-do list (sorted by priority):
		* Add filter own posts by date
		* Support user profiling (profile picture, name, age, sex, etc.)
		* Implement AJAX to user actions (create, delete, comment, filter, search) to improve UX


