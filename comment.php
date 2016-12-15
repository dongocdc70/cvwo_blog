<?php
require 'database.php';
require 'authenticate.php';

// must provide param after comment.php
if (!empty($_GET['post_id'])) {
	$post_id = $_REQUEST['post_id'];
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//check if post_id exists
	$sql = "SELECT `POST_ID` FROM data.posts WHERE `POST_ID` = ? LIMIT 1";
	$q = $pdo->prepare($sql);
	$q->execute(array($post_id));
	if(!empty($q->fetch())) {
		//comment content must not be empty
		if(!empty($_POST)) {
			$commentError = null;

			$comment = $_POST['comment'];

			$valid = true;

			if(empty($comment)) {
				$commentError = 'Please enter comment';
				$valid = false;
			}

			if($valid) {
				$sql = "INSERT INTO data.comments (`USER_ID`, `POST_ID`, `COMMENT_CONTENT`, `DATE_COMMENTED`) VALUES (?, ?, ?, NOW())";
				$q = $pdo->prepare($sql);
				$q->execute(array($_SESSION['user_id'], $post_id, $comment));
				Database::disconnect();
				header("Location: index.php");
			}
		}
	}

	else {
		header("Location: index.php");
	}


}

// if no param after comment.php
else {
	header("Location: index.php");
}


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Write a comment</title>
	<link   href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="span10 offset1">
			<div class="row">
				<h3>Write a comment</h3>
			</div>

			<form action="comment.php?post_id=<?php echo $post_id; ?>" class="form-horizontal" method="post">
				<div class="form-group <?php echo !empty($commentError)?'error':''; ?>">
					<label for="comment">Comment</label>
					<input type="text" class="form-control" name="comment" placeholder="Comment" value="<?php echo !empty($comment)?$comment:''; ?>" required>
					<?php if(!empty($commentError)): ?>
						<span class="help-inline"><?php echo $commentError ?></span>
					<?php endif; ?>
				</div>

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Comment</button>
					<a href="index.php" class="btn">Back</a>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
