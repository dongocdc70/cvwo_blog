<?php
require 'helpers/database.php';
require 'helpers/authenticate.php';

// must provide param after view.php
if (!empty($_GET['post_id'])) {
	$post_id = $_REQUEST['post_id'];
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//check if post_id exists
	$sql = "SELECT *
					FROM data.posts JOIN data.users
					ON data.posts.`USER_ID` = data.users.`USER_ID`
					WHERE `POST_ID` = ? LIMIT 1";
	$q = $pdo->prepare($sql);
	$q->execute(array($post_id));
	$res = $q->fetch();
	if(!empty($res)) {


		Database::Disconnect();
	}

	else {
		header("Location: index.php");
	}


}

// if no param after view.php
else {
	header("Location: index.php");
}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/clean-blog.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<title><?php echo $res['TITLE']; ?></title>
</head>
<body>
	<!-- Page Header -->
	<!-- Set your background image for this header on the line below. -->
	<header class="intro-header" style="background-image: url('img/post-bg.jpg')">
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
	                <div class="post-heading" style="padding: 100px 0">
	                		<?php
	                		echo '<h1>'.$res['TITLE'].'</h1>';
	                		echo '<span class="meta">Posted by <a href="#">'.$res['USERNAME'].'</a> on '.date("F d, Y", strtotime($res['DATE_POSTED'])).'</span>';
	                		?>
	                </div>
	            </div>
	        </div>
	    </div>
	</header>

	<!-- Post Content -->
	<article>
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
	                <p><?php echo $res['CONTENT'] ?></p>
	            </div>
	        </div>
	    </div>
	</article>

	<hr>
</body>
</html>
