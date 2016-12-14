<?php
require 'database.php';
require 'authenticate.php';

if(!empty($_POST)) {
	$usernameError = null;
	$contentError = null;

	$username = $_POST['username'];
	$content = $_POST['content'];

	$valid = true;

	if(empty($username)) {
		$usernameError = 'Please enter Username';
		$valid = false;
	}

	if(empty($content)) {
		$contentError = 'Please enter blog content';
		$valid = false;
	}

	if($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO data.posts (USERNAME, CONTENT, DATE_POSTED) values(?,?,now())";
		$q = $pdo->prepare($sql);
		$q->execute(array($username,$content));
		Database::disconnect();
		header("Location: index.php");
	}
}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create a Post</title>
	<link   href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="span10 offset1">
			<div class="row">
				<h3>Create a Post</h3>
			</div>

			<form action="create.php" class="form-horizontal" method="post">
				<div class="form-group <?php echo !empty($contentError)?'error':''; ?>">
					<label for="username">Username</label>
					<input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo !empty($username)?$username:''; ?>">
					<?php if(!empty($usernameError)): ?>
						<span class="help-inline"><?php echo $usernameError ?></span>
					<?php endif; ?>
				</div>

				<div class="form-group <?php echo !empty($contentError)?'error':''; ?>">
					<label for="content">Content</label>
					<input type="text" class="form-control" name="content" placeholder="Content" value="<?php echo !empty($content)?$content:''; ?>">
					<?php if(!empty($contentError)): ?>
						<span class="help-inline"><?php echo $contentError ?></span>
					<?php endif; ?>
				</div>

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Create</button>
					<a href="index.php" class="btn">Back</a>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
