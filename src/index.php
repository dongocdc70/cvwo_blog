<?php
require 'helpers/authenticate.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Blog</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
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
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Username</th>
						<th>Post content</th>
						<th>Date posted</th>
					</tr>
				</thead>
				<tbody>
					<?php
					require_once 'helpers/database.php';
					include_once 'helpers/paging.php';

					$pdo = Database::connect();
					$paginate = new paginate($pdo);

					$query = 'SELECT *
										FROM data.posts JOIN data.users
										ON data.posts.`USER_ID` = data.users.`USER_ID`
										ORDER BY `POST_ID`';
	        $records_per_page = 5;
	        $newquery = $paginate->paging($query,$records_per_page);
	        $paginate->dataview($newquery);
	        $paginate->paginglink($query,$records_per_page);
					Database::disconnect();
					 ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>




<!--
$sql = 'SELECT *
				FROM data.posts JOIN data.users
				ON data.posts.`USER_ID` = data.users.`USER_ID`
				ORDER BY `POST_ID`';
foreach ($pdo->query($sql) as $row) {
	echo '<tr class="success">';
	echo '<td>'.$row['USERNAME'].'</td>';
	echo '<td>'.$row['CONTENT'].'</td>';
	echo '<td>'.$row['DATE_POSTED'].'</td>';
	echo '<td style="background-color: white; border-color: transparent;">';
	echo '<a class="btn btn-primary" style="margin-right:10px;" href="comment.php?post_id='.$row['POST_ID'].'">Comment</a>';
	if($row['USERNAME'] == $_SESSION['username']) {
		echo '<a class="btn btn-danger delete" href="delete.php?post_id='.$row['POST_ID'].'">Delete</a>';
	}
	echo '</td>';
	echo '</tr>';

	$sqlcomment = $pdo->prepare('SELECT *
															 FROM data.comments JOIN data.users
															 ON data.comments.`USER_ID` = data.users.`USER_ID`
															 WHERE `POST_ID` = ?');
	$sqlcomment->execute(array($row['POST_ID']));

	$rowcomments = $sqlcomment->fetchAll();

	echo '<tr>';
	if(empty($rowcomments)) {
		echo '<td colspan="3"><em>No comments yet.</em></td>';
	}
	else {
		echo '<td colspan="3">';
		echo '<h4>Comments</h4>';
		echo '<ul>';
		foreach($rowcomments as $rowcomment) {
			echo '<li>'.$rowcomment['COMMENT_CONTENT'].' | '.$rowcomment['USERNAME'].' | '.$rowcomment['DATE_COMMENTED'].'</li>';
		}
		echo '</ul>';
		echo '</td>';
	}
	echo '</tr>';

}
 -->
