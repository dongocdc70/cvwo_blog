<?php
require 'database.php';
require 'authenticate.php';

if(!empty($_POST)) {
	$contentError = null;

	$content = $_POST['content'];

	$valid = true;

	if(empty($content)) {
		$contentError = 'Please enter blog content';
		$valid = false;
	}

	if($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO data.posts (USER_ID, CONTENT, DATE_POSTED) values(?,?,now())";
		$q = $pdo->prepare($sql);
		$q->execute(array($_SESSION['user_id'],$content));
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
