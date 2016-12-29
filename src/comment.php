<?php
require 'helpers/database.php';
require 'helpers/authenticate.php';
require 'lib/htmlpurifier/purify_everything.php';

// must provide param after comment.php
if (isset($_POST['post_id']) && isset($_POST['comment'])) {
	$post_id = $_POST['post_id'];

	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbName = Database::$dbName;

	//check if post_id exists
	$sql = "SELECT `POST_ID` FROM $dbName.posts WHERE `POST_ID` = ? LIMIT 1";
	$q = $pdo->prepare($sql);
	$q->execute(array($post_id));

	if(!empty($q->fetch())) {
		//comment content must not be empty
		$commentError = null;
		$comment = $_POST['comment'];
		$comment = removeHTML($comment);
		$valid = true;

		if(empty($comment)) {
			$commentError = 'Please enter comment';
			$valid = false;
		}

		if($valid) {
			$sql = "INSERT INTO $dbName.comments (`USER_ID`, `POST_ID`, `COMMENT_CONTENT`, `DATE_COMMENTED`) VALUES (?, ?, ?, NOW())";
			$q = $pdo->prepare($sql);
			$q->execute(array($_SESSION['user_id'], $post_id, $comment));
			Database::disconnect();
			echo '<li class="media">';
			  echo '<div class="comment">';
			    echo '<div class="media-body">';
			      echo '<strong class="text-success">'.$_SESSION['username'].'&nbsp;</strong>';
			      echo '<span class="text-muted">';
			      echo '<small class="text-muted">Just now</small>';
			      echo '</span>';
			      echo '<p>';
			        echo $comment;
			      echo '</p>';
			    echo '</div>';
			    echo '<div class="clearfix"></div>';
			  echo '</div>';
			echo '</li>';
		}

		else {
			header('HTTP/1.1 400 Bad Request');
		}

	}

	else {
		header('HTTP/1.1 400 Bad Request');
	}


}

// if no param after comment.php
else {
	header('HTTP/1.1 400 Bad Request');
}


 ?>
