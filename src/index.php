<?php
require 'helpers/authenticate.php';
require_once 'helpers/database.php';
include_once 'helpers/paging.php';

$pdo = Database::connect();
$paginate = new paginate($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome, <?php echo $_SESSION['username'] ?></title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/clean-blog.css">
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
			<h1>
				<?php
				if(isset($_GET['user'])) {
					echo 'All posts by '.$_GET['user'];
				}
				else {
					echo 'All posts';
				}
				?>
			</h1>
		</div>
		<div class="row">
			<p>
				<?php
				if(isset($_GET['user'])) {
					echo '<a href="index.php" class="btn btn-warning">Back to homepage</a>';
				}
				?>
				<a href="create.php" class="btn btn-success">Create</a>
				<a href="logout.php" class="btn btn-danger">Log out</a>
			</p>
		</div>

		<div class="row">
			<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
					<?php
					$records_per_page = 3;
					if(isset($_GET['user'])) {
						$query = 'SELECT *
											FROM data.posts JOIN data.users
											ON data.posts.`USER_ID` = data.users.`USER_ID`
											WHERE data.users.`USERNAME` = ?
											ORDER BY `POST_ID` DESC';
						$newquery = $paginate->paging($query,$records_per_page,$_GET['user']);
						$paginate->dataview($newquery,$_GET['user']);
					}
					else {
						$query = 'SELECT *
											FROM data.posts JOIN data.users
											ON data.posts.`USER_ID` = data.users.`USER_ID`
											ORDER BY `POST_ID` DESC';
						$newquery = $paginate->paging($query,$records_per_page);
						$paginate->dataview($newquery);
					}




					?>
      </div>
		</div>
		<?php
		if(isset($_GET['user'])) {
    	$paginate->paginglink($query,$records_per_page,$_GET['user']);
    }

    else {
    	$paginate->paginglink($query,$records_per_page);
    }
		Database::disconnect();
		?>

	</div>
</body>
</html>



