<?php require 'authenticate.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Blog</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script language="javascript" type="text/javascript">
	$(document).ready(function(){
	    $("a.delete").click(function(e){
	        if(!confirm('Are you sure?')){
	            e.preventDefault();
	            return false;
	        }
	        return true;
	    });
	});
	</script>

</head>
<body>
	<div class="container">
		<div class="row">
			<h3>Welcome, <?php echo $_SESSION['username'] ?></h3>
		</div>
		<div class="row">
			<p>
				<a href="create.php" class="btn btn-success">Create</a>
				<a href="logout.php" class="btn btn-danger">Log out</a>
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
					require_once 'database.php';
					$pdo = Database::connect();
					$sql = 'SELECT *
									FROM data.posts JOIN data.users
									ON data.posts.`USER_ID` = data.users.`USER_ID`
									ORDER BY `POST_ID`';
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>'.$row['USERNAME'].'</td>';
						echo '<td>'.$row['CONTENT'].'</td>';
						echo '<td>'.$row['DATE_POSTED'].'</td>';
						if($row['USERNAME'] == $_SESSION['username']) {
							echo '<td>'.'<a class="btn btn-danger delete" href="delete.php?id='.$row['POST_ID'].'">Delete</a>'.'</td>';
						}
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
