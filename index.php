<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Blog</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<h3>All blog posts</h3>
		</div>
		<div class="row">
			<p>
				<a href="create.php" class="btn btn-success">Create</a>
			</p>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Username</th>
						<th>Post content</th>
						<th>Date posted</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include 'database.php';
					$pdo = Database::connect();
					$sql = 'SELECT * FROM data.posts ORDER BY `POST_ID`';
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>'.$row['USERNAME'].'</td>';
						echo '<td>'.$row['CONTENT'].'</td>';
						echo '<td>'.$row['DATE'].'</td>';
						echo '<tr>';
					}
					Database::disconnect();
					 ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>
