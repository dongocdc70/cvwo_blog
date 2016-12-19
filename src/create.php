<?php
require 'helpers/database.php';
require 'helpers/authenticate.php';

if(!empty($_POST)) {
	$titleError = null;
	$contentError = null;

	$title = $_POST['title'];
	$content = $_POST['content'];

	$valid = true;

	if(empty($content)) {
		$contentError = 'Please enter blog content';
		$valid = false;
	}

	if(empty($title)) {
		$titleError = 'Please enter blog content';
		$valid = false;
	}

	if($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO data.posts (USER_ID, TITLE, CONTENT, DATE_POSTED) values(?, ?, ?,now())";
		$q = $pdo->prepare($sql);
		$q->execute(array($_SESSION['user_id'], $title, $content));
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
</head>
<body>
	<div class="container">
		<div class="span10 offset1">
			<div class="row">
				<h3>Create a Post</h3>
			</div>

			<form action="create.php" class="form-horizontal" method="post">
				<div class="form-group <?php echo !empty($titleError)?'error':''; ?>">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo !empty($title)?$title:''; ?>">
					<?php if(!empty($titleError)): ?>
						<span class="help-inline"><?php echo $titleError ?></span>
					<?php endif; ?>
				</div>

				<div class="form-group <?php echo !empty($contentError)?'error':''; ?>">
					<label for="content">Content</label>
					<textarea type="text" rows="10" cols="50" class="form-control" name="content" placeholder="Content" value="<?php echo !empty($content)?$content:''; ?>"></textarea>
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
